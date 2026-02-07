<?php
class Order
{
    private $conn;
    private $hasNoteColumn;

    public function __construct($connection)
    {
        $this->conn = $connection;
        $this->hasNoteColumn = null;
    }

    private function checkNoteColumn()
    {
        if ($this->hasNoteColumn !== null) {
            return $this->hasNoteColumn;
        }

        $result = $this->conn->query("SHOW COLUMNS FROM orders LIKE 'note'");
        $this->hasNoteColumn = ($result && $result->num_rows > 0);
        return $this->hasNoteColumn;
    }

    public function createOrder($userId, $totalPrice, $fullName, $phone, $address, $note, $status = 0)
    {
        $hasNote = $this->checkNoteColumn();

        if ($hasNote) {
            $sql = "INSERT INTO orders (user_id, total_price, full_name, phone, address, order_date, status, note)
                    VALUES (?, ?, ?, ?, ?, NOW(), ?, ?)";
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                return false;
            }
            $stmt->bind_param("idsssis", $userId, $totalPrice, $fullName, $phone, $address, $status, $note);
        } else {
            $sql = "INSERT INTO orders (user_id, total_price, full_name, phone, address, order_date, status)
                    VALUES (?, ?, ?, ?, ?, NOW(), ?)";
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                return false;
            }
            $stmt->bind_param("idsssi", $userId, $totalPrice, $fullName, $phone, $address, $status);
        }

        if (!$stmt->execute()) {
            $stmt->close();
            return false;
        }

        $orderId = $stmt->insert_id;
        $stmt->close();
        return $orderId;
    }

    public function addOrderDetail($orderId, $productId, $quantity, $price)
    {
        $sql = "INSERT INTO order_details (order_id, product_id, quantity, price)
                VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param("iiid", $orderId, $productId, $quantity, $price);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function createOrderFromCart($userId, $fullName, $phone, $address, $note, $cartItems, $status = 0)
    {
        if (empty($cartItems)) {
            return false;
        }

        $total = 0;
        foreach ($cartItems as $item) {
            $price = floatval($item['price']);
            $qty = intval($item['quantity']);
            $total += ($price * $qty);
        }

        $this->conn->begin_transaction();

        $orderId = $this->createOrder($userId, $total, $fullName, $phone, $address, $note, $status);
        if (!$orderId) {
            $this->conn->rollback();
            return false;
        }

        foreach ($cartItems as $item) {
            $productId = intval($item['id']);
            $qty = intval($item['quantity']);
            $price = floatval($item['price']);

            if (!$this->addOrderDetail($orderId, $productId, $qty, $price)) {
                $this->conn->rollback();
                return false;
            }
        }

        $this->conn->commit();
        return $orderId;
    }

    // Lấy danh sách đơn hàng của một User
    public function getOrdersByUserId($userId)
    {
        $orders = [];
        // Kiểm tra cột note để tránh lỗi SQL nếu DB chưa cập nhật
        $hasNote = $this->conn->query("SHOW COLUMNS FROM orders LIKE 'note'")->num_rows > 0;

        $sql = $hasNote
            ? "SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC"
            : "SELECT id, total_price, full_name, phone, address, order_date, status FROM orders WHERE user_id = ? ORDER BY order_date DESC";

        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $orders[] = $row;
            }
            $stmt->close();
        }
        return $orders;
    }

    // Lấy chi tiết các món hàng cho danh sách đơn hàng
    public function getOrderItemsForOrders($orderIds)
    {
        if (empty($orderIds)) return [];
        $orderItems = [];
        $placeholders = implode(',', array_fill(0, count($orderIds), '?'));
        $types = str_repeat('i', count($orderIds));

        $sql = "SELECT od.*, p.name, p.image 
                FROM order_details od 
                LEFT JOIN product p ON od.product_id = p.id 
                WHERE od.order_id IN ($placeholders) 
                ORDER BY od.order_id DESC";

        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param($types, ...$orderIds);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $orderItems[$row['order_id']][] = $row;
            }
            $stmt->close();
        }
        return $orderItems;
    }

    public function formatStatus($status)
    {
        $labels = [
            0 => "Chờ xác nhận",
            1 => "Đã thanh toán",
            2 => "Đang giao hàng",
            3 => "Hoàn thành"
        ];
        return $labels[intval($status)] ?? "Không rõ";
    }

    //Hàm cập nhật trạng thái đơn hàng (updateStatus)
    public function updateStatus($orderId, $newStatus)
    {
        $stmt = $this->conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
        if (!$stmt) return false;
        $stmt->bind_param("ii", $newStatus, $orderId);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    //Hàm lấy tất cả đơn hàng (getAllOrders)
    public function getAllOrders()
    {
        $orders = [];
        $hasNote = $this->checkNoteColumn();

        $sql = $hasNote
            ? "SELECT * FROM orders ORDER BY order_date DESC"
            : "SELECT id, user_id, total_price, full_name, phone, address, order_date, status FROM orders ORDER BY order_date DESC";

        $result = $this->conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $orders[] = $row;
            }
        }
        return $orders;
    }

    // Tính tổng doanh thu từ các đơn đã thanh toán (status 1) hoặc hoàn thành (status 3)
    public function getTotalRevenue()
    {
        $sql = "SELECT SUM(total_price) as total FROM orders WHERE status IN (1, 3)";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['total'] ?? 0;
    }

    // Thống kê số lượng đơn hàng theo từng trạng thái
    public function getCountByStatus()
    {
        $sql = "SELECT status, COUNT(*) as count FROM orders GROUP BY status";
        $result = $this->conn->query($sql);
        $stats = [];
        while ($row = $result->fetch_assoc()) {
            $stats[$row['status']] = $row['count'];
        }
        return $stats; // Trả về mảng dạng [0 => 5, 1 => 10, ...]
    }
}

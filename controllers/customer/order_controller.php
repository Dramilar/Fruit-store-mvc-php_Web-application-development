<?php
include(__DIR__ . "/../../includes/connect.php");
require_once(__DIR__ . "/../../models/clsOrder.php");

function getUserIdByUsername($conn, $username)
{
    $stmt = $conn->prepare("SELECT id FROM User WHERE Username = ? LIMIT 1");
    if (!$stmt) {
        return null;
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result ? $result->fetch_assoc() : null;
    $stmt->close();
    return $row ? intval($row['id']) : null;
}

$username = $_SESSION['username'] ?? null;
$userId = $username ? getUserIdByUsername($conn, $username) : null;

$cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = trim($_POST['full_name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $note = trim($_POST['note'] ?? '');

    if ($userId === null) {
        $error = "Không tìm thấy thông tin người dùng. Vui lòng đăng nhập lại.";
    } elseif (empty($cartItems)) {
        $error = "Giỏ hàng của bạn đang trống.";
    } elseif ($fullName === '' || $phone === '' || $address === '') {
        $error = "Vui lòng nhập đầy đủ thông tin bắt buộc.";
    } else {
        $orderModel = new Order($conn);
        $orderId = $orderModel->createOrderFromCart($userId, $fullName, $phone, $address, $note, $cartItems, 0);

        if ($orderId) {
            unset($_SESSION['cart']);
            header("Location: /Fruit/pages/payment_success.php?order_id=" . $orderId);
            exit;
        }

        $error = "Không thể tạo đơn hàng. Vui lòng thử lại.";
    }
}

$total = 0;
foreach ($cartItems as $item) {
    $total += floatval($item['price']) * intval($item['quantity']);
}

<?php
session_start();
include("../includes/connect.php");
require_once(__DIR__ . "/../../models/clsOrder.php");
include("../controllers/customer/auth_helper.php");
checkLoginAccess(); // Kiểm tra quyền truy cập



$orderModel = new Order($conn);

// Giả sử bạn đã có hàm lấy UserId từ session username
// Bạn nên đưa hàm getUserIdByUsername vào class User để chuẩn hơn
$username = $_SESSION['username'];
$stmt = $conn->prepare("SELECT id FROM User WHERE Username = ? LIMIT 1");
$stmt->bind_param("s", $username);
$stmt->execute();
$userId = $stmt->get_result()->fetch_assoc()['id'] ?? null;

$orders = [];
$orderItems = [];

if ($userId) {
    $orders = $orderModel->getOrdersByUserId($userId);
    if (!empty($orders)) {
        $orderIds = array_column($orders, 'id');
        $orderItems = $orderModel->getOrderItemsForOrders($orderIds);
    }
}

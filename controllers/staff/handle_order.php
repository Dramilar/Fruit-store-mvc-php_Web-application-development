<?php
session_start();
include("../../includes/connect.php");
require_once("../../models/clsOrder.php");
require_once("../customer/auth_helper.php");

checkStaffAccess(); // Chỉ nhân viên mới được chạy file này

if (isset($_GET['id']) && isset($_GET['status'])) {
    $orderId = intval($_GET['id']);
    $status = intval($_GET['status']);

    $orderModel = new Order($conn);
    if ($orderModel->updateStatus($orderId, $status)) {
        header("Location: ../../pages/admin/manager_order.php?msg=success");
    } else {
        header("Location: ../../pages/admin/manager_order.php?msg=error");
    }
    exit();
}

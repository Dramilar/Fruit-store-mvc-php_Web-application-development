<?php
require_once("../../controllers/customer/auth_helper.php");
require_once("../../models/clsOrder.php");
include("../../includes/connect.php");

checkStaffAccess(); // Bảo vệ trang

$orderModel = new Order($conn);
$revenue = $orderModel->getTotalRevenue();
$orderCounts = $orderModel->getCountByStatus();
?>

<div class="statistics-container">
    <h1>Báo cáo bán hàng</h1>

    <div class="stat-cards">
        <div class="card revenue">
            <h3>Tổng doanh thu thực tế</h3>
            <p><?= number_format($revenue, 0, ',', '.') ?>₫</p>
        </div>

        <div class="card pending">
            <h3>Đơn hàng chờ xác nhận</h3>
            <p><?= $orderCounts[0] ?? 0 ?> đơn</p>
        </div>

        <div class="card success">
            <h3>Đơn hàng đã hoàn thành</h3>
            <p><?= ($orderCounts[1] ?? 0) + ($orderCounts[3] ?? 0) ?> đơn</p>
        </div>
    </div>
</div>

<style>
    .stat-cards {
        display: flex;
        gap: 20px;
        margin-top: 20px;
    }

    .card {
        padding: 20px;
        border-radius: 8px;
        color: white;
        flex: 1;
        text-align: center;
    }

    .revenue {
        background-color: #28a745;
    }

    .pending {
        background-color: #ffc107;
        color: #000;
    }

    .success {
        background-color: #17a2b8;
    }

    .card p {
        font-size: 24px;
        font-weight: bold;
    }
</style>
<?php
require_once("../../controllers/customer/auth_helper.php");
include("../../includes/connect.php");
require_once("../../models/clsOrder.php");

// Kiểm tra quyền nhân viên
checkStaffAccess();

$orderModel = new Order($conn);
$orderCounts = $orderModel->getCountByStatus(); // Hàm thống kê số lượng đơn hàng
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - The Fruit Shop</title>
    <link rel="stylesheet" href="../../bin/css/bootstrap.css">
    <link rel="stylesheet" href="../../bin/css/style.css">
    <link rel="stylesheet" href="../../bin/css/banner.css">
    <style>
        .dashboard-container {
            padding: 40px;
        }

        .stat-card {
            border-radius: 10px;
            padding: 20px;
            color: white;
            margin-bottom: 20px;
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .bg-pending {
            background: #ffc107;
            color: #000;
        }

        .bg-shipping {
            background: #17a2b8;
        }

        .bg-success {
            background: #28a745;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .menu-item {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 30px;
            text-align: center;
            border-radius: 8px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .menu-item:hover {
            background: #e9ecef;
        }

        .menu-item i {
            font-size: 2rem;
            display: block;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <?php include("../../includes/header.php"); ?>
    <?php include("../../includes/banner_admin.php"); ?>

    <div class="dashboard-container container">
        <h2 class="mb-4">Chào mừng Nhân viên: <?= $_SESSION['username'] ?></h2>

        <div class="row">
            <div class="col-md-4">
                <div class="stat-card bg-pending">
                    <h4>Chờ xác nhận</h4>
                    <h2><?= $orderCounts[0] ?? 0 ?> đơn</h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card bg-shipping">
                    <h4>Đang giao hàng</h4>
                    <h2><?= $orderCounts[2] ?? 0 ?> đơn</h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card bg-success">
                    <h4>Đã hoàn thành</h4>
                    <h2><?= $orderCounts[3] ?? 0 ?> đơn</h2>
                </div>
            </div>
        </div>

        <hr>

        <h3 class="mt-4">Công cụ quản lý</h3>
        <div class="menu-grid">
            <a href="manager_order.php" class="menu-item">
                <span>📦</span> Quản lý đơn hàng
            </a>

            <a href="statistic_order.php" class="menu-item">
                <span>📊</span> Báo cáo & Thống kê
            </a>

            <a href="post_product.php" class="menu-item">
                <span>🍎</span> Quản lý sản phẩm
            </a>

            <a href="../../index.php" class="menu-item">
                <span>🏠</span> Về trang chủ cửa hàng
            </a>
        </div>
    </div>

    <?php include("../../includes/footer.php"); ?>
</body>

</html>
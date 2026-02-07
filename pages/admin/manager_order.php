<?php
// Đường dẫn từ pages/admin/dashboard.php
require_once("../../controllers/customer/auth_helper.php");
require_once("../../models/clsOrder.php");
include("../../includes/connect.php");

// Kiểm tra quyền nhân viên
checkStaffAccess();

$orderModel = new Order($conn);
$orders = $orderModel->getAllOrders();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Hệ thống Quản lý Đơn hàng</title>
    <link rel="stylesheet" href="../../bin/css/bootstrap.css">
    <link rel="stylesheet" href="../../bin/css/manager_order.css">
    <link rel="stylesheet" href="../../bin/css/style.css">
    <link rel="stylesheet" href="../../bin/css/banner.css"> <!-- //dùng chung css banner với trang user -->


</head>
<?php include("../../includes/header.php"); ?>
<?php include("../../includes/banner_admin.php"); ?>

<body>
    <div class="admin-container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>📦 Danh sách đơn hàng chờ xử lý</h2>
            <a href="../../index.php" class="btn btn-outline-secondary">Quay về trang chủ</a>
        </div>

        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Mã đơn</th>
                    <th>Khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($orders)): ?>
                    <tr>
                        <td colspan="5" class="text-center">Chưa có đơn hàng nào.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td>#<?= $order['id'] ?></td>
                            <td>
                                <strong><?= htmlspecialchars($order['full_name']) ?></strong><br>
                                <small><?= htmlspecialchars($order['phone']) ?></small>
                            </td>
                            <td><?= number_format($order['total_price'], 0, ',', '.') ?>₫</td>
                            <td>
                                <span class="status-<?= $order['status'] ?>">
                                    <?= $orderModel->formatStatus($order['status']) ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($order['status'] == 0): ?>
                                    <a href="../../controllers/staff/handle_order.php?id=<?= $order['id'] ?>&status=1"
                                        class="btn btn-sm btn-success">Xác nhận thanh toán</a>
                                <?php elseif ($order['status'] == 1): ?>
                                    <a href="../../controllers/staff/handle_order.php?id=<?= $order['id'] ?>&status=2"
                                        class="btn btn-sm btn-primary">Giao hàng</a>
                                <?php else: ?>
                                    <span class="badge badge-light">Đã xử lý</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
<?php include("../../includes/footer.php"); ?>

</html>
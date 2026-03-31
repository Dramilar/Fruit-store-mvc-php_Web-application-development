<?php
require_once("../../controllers/customer/auth_helper.php");
require_once("../../models/clsOrder.php");
include("../../includes/connect.php");

checkStaffAccess();

$orderModel = new Order($conn);
$orders = $orderModel->getAllOrders();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Quản lý đơn hàng</title>

    <link rel="stylesheet" href="../../bin/css/bootstrap.css">
    <link rel="stylesheet" href="../../bin/css/manager_order.css">
    <link rel="stylesheet" href="../../bin/css/style.css">
    <link rel="stylesheet" href="../../bin/css/banner.css">
</head>

<body>
<?php include("../../includes/header.php"); ?>
<?php include("../../includes/banner_admin.php"); ?>

<div class="admin-container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>📦 Quản lý đơn hàng</h2>
        <a href="../../index.php" class="btn btn-outline-secondary">Trang chủ</a>
    </div>

    <table class="table table-bordered table-hover text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Khách hàng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>

        <tbody>
        <?php if (empty($orders)): ?>
            <tr>
                <td colspan="5">Chưa có đơn hàng</td>
            </tr>
        <?php else: ?>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td>#<?= $order['id'] ?></td>

                    <td class="text-start">
                        <strong><?= htmlspecialchars($order['full_name']) ?></strong><br>
                        <small><?= htmlspecialchars($order['phone']) ?></small>
                    </td>

                    <td class="text-danger fw-bold">
                        <?= number_format($order['total_price'], 0, ',', '.') ?>₫
                    </td>

                    <!-- TRẠNG THÁI -->
                    <td>
                        <?php
                        switch ($order['status']) {
                            case 0:
                                echo "<span class='badge bg-warning text-dark'>Chờ xác nhận</span>";
                                break;
                            case 1:
                                echo "<span class='badge bg-info'>Đã thanh toán</span>";
                                break;
                            case 2:
                                echo "<span class='badge bg-primary'>Đang giao</span>";
                                break;
                            case 3:
                                echo "<span class='badge bg-success'>Hoàn thành</span>";
                                break;
                            default:
                                echo "<span class='badge bg-secondary'>Không xác định</span>";
                        }
                        ?>
                    </td>

                    <!-- HÀNH ĐỘNG -->
                    <td>
                        <?php if ($order['status'] == 0): ?>
                            <a href="../../controllers/staff/handle_order.php?id=<?= $order['id'] ?>&status=1"
                               class="btn btn-sm btn-success">
                               Xác nhận
                            </a>

                        <?php elseif ($order['status'] == 1): ?>
                            <a href="../../controllers/staff/handle_order.php?id=<?= $order['id'] ?>&status=2"
                               class="btn btn-sm btn-primary">
                               Giao hàng
                            </a>

                        <?php elseif ($order['status'] == 2): ?>
                            <a href="../../controllers/staff/handle_order.php?id=<?= $order['id'] ?>&status=3"
                               class="btn btn-sm btn-warning">
                               Hoàn thành
                            </a>

                        <?php else: ?>
                            <span class="badge bg-success">✔ Đã xong</span>
                        <?php endif; ?>
                    </td>

                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include("../../includes/footer.php"); ?>
</body>
</html>
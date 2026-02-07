<?php require_once("../controllers/customer/purcharse_history_controller.php"); ?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Lịch sử mua hàng</title>
    <link rel="stylesheet" href="/Fruit/bin/css/style.css">
    <link rel="stylesheet" href="/Fruit/bin/css/bootstrap.css">
    <link rel="stylesheet" href="/Fruit/bin/css/purchase_history.css">
    <link rel="stylesheet" href="/Fruit/bin/css/banner.css">
</head>

<body>
    <?php include("../includes/header.php"); ?>
    <?php include("../includes/banner.php"); ?>

    <div class="history-container">
        <h1>Lịch sử mua hàng</h1>

        <?php if (empty($orders)): ?>
            <div class="history-empty">Bạn chưa có đơn hàng nào. <a href="/Fruit/index.php">Mua ngay!</a></div>
        <?php else: ?>
            <?php foreach ($orders as $order): ?>
                <div class="history-card">
                    <div class="history-header">
                        <div>
                            <div class="history-order-id">Đơn hàng #<?= $order['id'] ?></div>
                            <div class="history-date"><?= $order['order_date'] ?></div>
                        </div>
                        <div class="status-label"><?= $orderModel->formatStatus($order['status']) ?></div>
                    </div>

                    <div class="history-items">
                        <?php if (isset($orderItems[$order['id']])): ?>
                            <?php foreach ($orderItems[$order['id']] as $item): ?>
                                <div class="history-item">
                                    <img src="/Fruit/bin/images/<?= $item['image'] ?>" alt="<?= $item['name'] ?>">
                                    <div class="item-info">
                                        <div class="name"><?= $item['name'] ?></div>
                                        <div class="meta">SL: <?= $item['quantity'] ?> | Giá: <?= number_format($item['price'], 0, ',', '.') ?>₫</div>
                                    </div>
                                    <div class="subtotal"><?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?>₫</div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div class="history-footer">
                        Tổng cộng: <strong><?= number_format($order['total_price'], 0, ',', '.') ?>₫</strong>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php include("../includes/footer.php"); ?>
</body>

</html>
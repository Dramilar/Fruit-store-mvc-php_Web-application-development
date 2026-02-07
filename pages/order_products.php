<?php
require_once(__DIR__ . "/../controllers/customer/order_controller.php");
include("../controllers/customer/auth_helper.php");
checkLoginAccess(); // Kiểm tra quyền truy cập
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thanh toán</title>
    <link rel="stylesheet" href="/Fruit/bin/css/style.css">
    <link rel="stylesheet" href="/Fruit/bin/css/bootstrap.css">
    <link rel="stylesheet" href="/Fruit/bin/css/banner.css">
    <link rel="stylesheet" href="/Fruit/bin/css/payment.css">
</head>

<body>
    <?php include("../includes/header.php"); ?>
    <?php include("../includes/banner.php"); ?>

    <div class="payment-container">
        <h1>Thanh toán</h1>

        <?php if ($error !== ''): ?>
            <div class="payment-alert error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <div class="payment-grid">
            <div class="payment-summary">
                <h2>Đơn hàng của bạn</h2>
                <?php if (!empty($cartItems)): ?>
                    <div class="summary-items">
                        <?php foreach ($cartItems as $item): ?>
                            <div class="summary-item">
                                <div class="summary-info">
                                    <span class="summary-name"><?php echo htmlspecialchars($item['name']); ?></span>
                                    <span class="summary-qty">x<?php echo intval($item['quantity']); ?></span>
                                </div>
                                <div class="summary-price">
                                    <?php echo number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?>₫
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="summary-total">
                        Tổng cộng: <strong><?php echo number_format($total, 0, ',', '.'); ?>₫</strong>
                    </div>
                    <div>
                        <h3>Vui lòng thanh toán tại đây</h3>
                    </div>
                <?php else: ?>
                    <p>Giỏ hàng của bạn đang trống. <a href="/Fruit/index.php">Tiếp tục mua sắm</a></p>
                <?php endif; ?>
            </div>

            <div class="payment-form">
                <h2>Thông tin giao hàng</h2>
                <form method="POST" id="payment-form">
                    <label for="full_name">Họ và tên *</label>
                    <input type="text" id="full_name" name="full_name" required value="<?php echo htmlspecialchars($_POST['full_name'] ?? ''); ?>">

                    <label for="phone">Số điện thoại *</label>
                    <input type="text" id="phone" name="phone" required value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>">

                    <label for="address">Địa chỉ *</label>
                    <textarea id="address" name="address" rows="3" required><?php echo htmlspecialchars($_POST['address'] ?? ''); ?></textarea>

                    <label for="note">Ghi chú</label>
                    <textarea id="note" name="note" rows="3"><?php echo htmlspecialchars($_POST['note'] ?? ''); ?></textarea>

                    <button type="submit" class="btn-submit" <?php echo empty($cartItems) ? 'disabled' : ''; ?>>
                        Đặt hàng
                    </button>
                </form>
            </div>
        </div>
    </div>

    <?php include("../includes/footer.php"); ?>
</body>

</html>
<script src="/Fruit/bin/js/jquery-3.7.1.js"></script>
<script src="/Fruit/bin/js/payment.js"></script>
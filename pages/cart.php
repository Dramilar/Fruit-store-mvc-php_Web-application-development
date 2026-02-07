<?php
include("../controllers/customer/auth_helper.php");
checkLoginAccess(); // Kiểm tra quyền truy cập
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="/Fruit/bin/css/style.css">
    <link rel="stylesheet" href="/Fruit/bin/css/bootstrap.css">
    <link rel="stylesheet" href="/Fruit/bin/css/banner.css">
</head>

<body>
    <?php include("../includes/header.php"); ?>
    <?php include("../includes/banner.php"); ?>

    <div style="padding: 20px;">
        <h1>🛒 Giỏ hàng của bạn</h1>

        <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
            <div class="cart-items" style="display: flex; flex-direction: column; gap: 15px;">
                <?php
                $total = 0;
                foreach ($_SESSION['cart'] as $item):
                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal;
                ?>
                    <div class="cart-item" style="display: flex; align-items: center; border: 1px solid #ddd; padding: 15px; border-radius: 8px;">
                        <img src="../images/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" style="width: 80px; height: 80px; object-fit: cover; margin-right: 15px;">
                        <div style="flex: 1;">
                            <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                            <p>Giá: <?php echo number_format($item['price'], 0, ',', '.'); ?>₫</p>
                            <p>Số lượng:
                                <button class="qty-btn decrease-qty" data-id="<?php echo $item['id']; ?>">-</button>
                                <span class="quantity"><?php echo $item['quantity']; ?></span>
                                <button class="qty-btn increase-qty" data-id="<?php echo $item['id']; ?>">+</button>
                            </p>
                            <p>Tổng: <?php echo number_format($subtotal, 0, ',', '.'); ?>₫</p>
                            <button class="remove-item" data-id="<?php echo $item['id']; ?>">Xóa</button>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="cart-total" style="border-top: 2px solid #333; padding-top: 15px; margin-top: 15px;">
                    <h2>Tổng cộng: <?php echo number_format($total, 0, ',', '.'); ?>₫</h2>
                    <a href="/Fruit/pages/order_products.php" class="btn btn-primary" style="margin-top: 10px;">Mua hàng</a>
                </div>
            </div>
        <?php else: ?>
            <p>Giỏ hàng của bạn đang trống. <a href="/Fruit/index.php">Tiếp tục mua sắm</a></p>
        <?php endif; ?>
    </div>

    <?php include("../includes/footer.php"); ?>
</body>

</html>
<script src="/Fruit/bin/js/main.js"></script>
<script src="/Fruit/bin/js/cart.js"></script>
<script src="/Fruit/bin/js/jquery-3.7.1.js"></script>
<?php
session_start();
include("../includes/connect.php");
require_once(__DIR__ . "/../models/clsProduct.php");

$productModel = new Product($conn);
$productId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$product = null;

if ($productId > 0) {
    $product = $productModel->getProductById($productId);
}

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Chi tiết sản phẩm</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/bin/css/style.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/bin/css/bootstrap.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/bin/css/leftstyle.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/bin/css/banner.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/bin/css/filter_product.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/bin/css/detail_products.css">

</head>

<body>
    <?php include("../includes/header.php"); ?>
    <?php include("../includes/banner.php"); ?>

    <div id="container">
        <div id="left"><?php include("../includes/left.php"); ?></div>
        <div id="right">
            <div class="detail-container">
                <?php if ($productId <= 0) : ?>
                    <div class="detail-error">
                        <h2>Không tìm thấy sản phẩm</h2>
                        <p>Vui lòng chọn một sản phẩm hợp lệ.</p>
                        <a class="detail-back" href="<?= BASE_URL ?>/index.php">Quay lại trang chủ</a>
                    </div>
                <?php elseif (!$product) : ?>
                    <div class="detail-error">
                        <h2>Không tìm thấy sản phẩm</h2>
                        <p>Sản phẩm bạn tìm không tồn tại hoặc đã bị xóa.</p>
                        <a class="detail-back" href="<?= BASE_URL ?>/index.php">Quay lại trang chủ</a>
                    </div>
                <?php else : ?>
                    <div class="detail-card">
                        <div class="detail-image">
                            <img src="<?= BASE_URL ?>/bin/images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        </div>
                        <div class="detail-info">
                            <h1><?php echo htmlspecialchars($product['name']); ?></h1>
                            <p class="detail-type">Loại: <?php echo htmlspecialchars($product['typename']); ?></p>
                            <p class="detail-price">
                                <?php echo number_format($product['price'], 0, ',', '.'); ?>₫/kg
                            </p>
                            <p class="detail-desc"><?php echo htmlspecialchars($product['description']); ?></p>
                            <div class="detail-actions">
                                <button type="button" class='add-to-cart btn btn-success' data-id='<?php echo $product['id']; ?>' data-name='<?php echo htmlspecialchars($product['name']); ?>' data-price='<?php echo $product['price']; ?>' data-image='<?php echo htmlspecialchars($product['image']); ?>'>
                                    🛒 Thêm vào giỏ
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="related-section">
                        <h2>Sản phẩm liên quan</h2>
                        <div class="related-grid">
                            <?php
                            $relatedShown = 0;
                            $relatedResult = $productModel->getProductsByType(intval($product['id_type']));

                            if ($relatedResult && $relatedResult->num_rows > 0) {
                                while ($row = $relatedResult->fetch_assoc()) {
                                    if ($row['id'] == $product['id']) {
                                        continue;
                                    }
                                    if ($relatedShown >= 4) {
                                        break;
                                    }
                                    $relatedShown++;
                            ?>
                                    <div class="related-card">
                                        <img src="<?= BASE_URL ?>/bin/images/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
                                        <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                                        <p class="related-price"><?php echo number_format($row['price'], 0, ',', '.'); ?>₫/kg</p>
                                        <a class="related-detail" href="<?= BASE_URL ?>/pages/detail_products.php?id=<?php echo $row['id']; ?>">Xem chi tiết</a>
                                    </div>
                            <?php
                                }
                            }

                            if ($relatedShown === 0) {
                                echo "<p class='related-empty'>Không có sản phẩm liên quan.</p>";
                            }
                            ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include("../includes/footer.php"); ?>
    <div id="toast-container" style="position: fixed; top: 20px; right: 20px; z-index: 10000;"></div>
</body>

</html>
<script src="<?= BASE_URL ?>/bin/js/jquery-3.7.1.js"></script>
<script src="<?= BASE_URL ?>/bin/js/main.js"></script>
<script src="<?= BASE_URL ?>/bin/js/cart.js"></script>
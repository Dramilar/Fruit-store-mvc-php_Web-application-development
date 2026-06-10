<?php include("includes/connect.php"); ?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/bin/css/style.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/bin/css/bootstrap.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/bin/css/filter_product.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/bin/css/leftsyle.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/bin/css/rightstyle.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/bin/css/banner.css">
</head>

<body>
    <?php include("includes/header.php"); ?>
    <?php include("includes/banner.php"); ?>


    <div id="container">
        <div id="left"><?php include("includes/left.php"); ?></div>
        <div id="right"><?php include("includes/right.php"); ?></div>
    </div>

    <?php include("includes/footer.php"); ?>
</body>

</html>
<script src="<?= BASE_URL ?>/bin/js/jquery-3.7.1.js"></script>
<div id="toast-container" style="position: fixed; top: 20px; right: 20px; z-index: 10000;"></div>
<script src="<?= BASE_URL ?>/bin/js/main.js"></script>
<script src="<?= BASE_URL ?>/bin/js/cart.js"></script>
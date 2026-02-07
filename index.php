<?php include("includes/connect.php"); ?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="/Fruit/bin/css/style.css">
    <link rel="stylesheet" href="/Fruit/bin/css/bootstrap.css">
    <link rel="stylesheet" href="/Fruit/bin/css/filter_product.css">
    <link rel="stylesheet" href="/Fruit/bin/css/leftsyle.css">
    <link rel="stylesheet" href="/Fruit/bin/css/rightstyle.css">
    <link rel="stylesheet" href="/Fruit/bin/css/banner.css">
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
<script src="Fruit/bin/js/jquery-3.7.1.js"></script>
<div id="toast-container" style="position: fixed; top: 20px; right: 20px; z-index: 10000;"></div>
<script src="/Fruit/bin/js/main.js"></script>
<script src="/Fruit/bin/js/cart.js"></script>
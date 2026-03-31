<?php
session_start();
include("../includes/connect.php");
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../bin/css/login.css">
    <style>

    </style>
</head>

<body>
    <div class="login-container">
        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="../controllers/customer/login_controller.php" method="POST">
            <h2>🔐 Đăng nhập</h2>
            <div class="form-group">
                <input type="text" name="username" required placeholder="👤 Tên đăng nhập">
            </div>
            <div class="form-group">
                <input type="password" name="password" required placeholder="🔑 Mật khẩu">
            </div>
            <button type="submit">Đăng nhập</button>
        </form>

        <div class="login-footer">
            <p>Chưa có tài khoản? <a href="register.php">Đăng ký tại đây</a></p>
        </div>
    </div>
</body>

</html>
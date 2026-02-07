<?php
include("../includes/connect.php");
session_start();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="../bin/css/login.css">
</head>

<body>
    <div class="login-container">
        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if (isset($success)): ?>
            <div class="success-message"><?php echo $success; ?></div>
        <?php endif; ?>

        <form action="../controllers/customer/register_controller.php" method="POST">
            <h2>📝 Đăng ký</h2>
            <div class="form-group">
                <input type="text" name="username" placeholder="👤 Tên đăng nhập" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="🔑 Mật khẩu" required>
            </div>
            <button type="submit">Đăng ký</button>
        </form>

        <div class="login-footer">
            <p>Đã có tài khoản? <a href="login.php">Đăng nhập tại đây</a></p>
        </div>
    </div>
</body>

</html>
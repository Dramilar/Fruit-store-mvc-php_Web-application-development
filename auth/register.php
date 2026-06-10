<?php
include("../includes/connect.php");
session_start();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản</title>
    <link rel="stylesheet" href="../bin/css/login.css">

    <style>
        body {
            background: linear-gradient(120deg, #f6d365, #fda085);
            font-family: Arial, sans-serif;
        }

        .login-container {
            width: 380px;
            margin: 80px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #28a745;
            border: none;
            color: #fff;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
        }

        button:hover {
            background: #218838;
        }

        .error-message {
            background: #ffdddd;
            color: red;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 10px;
        }

        .success-message {
            background: #ddffdd;
            color: green;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 10px;
        }

        .login-footer {
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <div class="login-container">

        <?php if (isset($_GET['error'])): ?>
            <div class="error-message"><?php echo $_GET['error']; ?></div>
        <?php endif; ?>

        <?php if (isset($_GET['success'])): ?>
            <div class="success-message"><?php echo $_GET['success']; ?></div>
        <?php endif; ?>

        <form action="../controllers/customer/register_controller.php" method="POST">
            <h2>📝 Đăng ký tài khoản</h2>

            <div class="form-group">
                <input type="text" name="username" placeholder="👤 Tên đăng nhập" required>
            </div>

            <div class="form-group">
                <input type="email" name="email" placeholder="📧 Email" required>
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="🔑 Mật khẩu" required>
            </div>

            <div class="form-group">
                <input type="password" name="confirm_password" placeholder="🔒 Nhập lại mật khẩu" required>
            </div>

            <button type="submit">Đăng ký</button>
        </form>

        <div class="login-footer">
            <p>Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
        </div>
    </div>
</body>

</html>
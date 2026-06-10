<?php
session_start();
require_once __DIR__ . '/../includes/config.php';

// Kiểm tra đăng nhập
if (!isset($_SESSION['username'])) {
    header("Location: " . BASE_URL . "/auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đổi mật khẩu</title>

    <!-- CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/bin/css/bootstrap.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/bin/css/style.css">
</head>
<body>

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card shadow-lg p-4" style="width: 400px; border-radius: 15px;">
        
        <h3 class="text-center mb-4">🔒 Đổi mật khẩu</h3>

        <!-- FORM -->
        <form method="POST" action="<?= BASE_URL ?>/controllers/UserController.php">
            <input type="hidden" name="action" value="change_password">

            <div class="mb-3">
                <label class="form-label">Mật khẩu cũ</label>
                <input type="password" name="old_password" class="form-control" placeholder="Nhập mật khẩu cũ" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mật khẩu mới</label>
                <input type="password" name="new_password" class="form-control" placeholder="Nhập mật khẩu mới" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Xác nhận mật khẩu</label>
                <input type="password" name="confirm_password" class="form-control" placeholder="Nhập lại mật khẩu" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                🔄 Đổi mật khẩu
            </button>
        </form>

        <!-- THÔNG BÁO -->
        <?php if (isset($_GET['msg'])) { ?>
            <div class="alert alert-danger mt-3 text-center">
                <?php echo $_GET['msg']; ?>
            </div>
        <?php } ?>

        <!-- BACK -->
        <div class="text-center mt-3">
            <a href="<?= BASE_URL ?>/index.php">⬅ Quay về trang chủ</a>
        </div>

    </div>
</div>

</body>
</html>
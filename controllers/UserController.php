<?php
session_start();

// load file
require_once(__DIR__ . "/../includes/connect.php");
require_once(__DIR__ . "/../models/clsUser.php");

// tạo kết nối DB


$userModel = new clsUser($conn);

if (isset($_POST['action']) && $_POST['action'] == 'change_password') {


    $username = $_SESSION['username'];
    $old = $_POST['old_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    // 1. Kiểm tra confirm
    if ($new !== $confirm) {
        header("Location: /Fruit/pages/change_password.php?msg=Mật khẩu không khớp");
        exit();
    }

    // 2. Kiểm tra mật khẩu cũ
    if (!$userModel->checkOldPassword($username, $old)) {
        header("Location: /Fruit/pages/change_password.php?msg=Mật khẩu cũ sai");
        exit();
    }

    // 3. Update mật khẩu
    $userModel->updatePassword($username, $new);

    header("Location: /Fruit/pages/change_password.php?msg=Đổi mật khẩu thành công");
    
}
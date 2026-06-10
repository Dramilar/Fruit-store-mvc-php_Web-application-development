<?php
session_start();
include("../../includes/connect.php");
require_once("../../models/clsUser.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $userModel = new clsUser($conn);

    if ($userModel->checkExists($username)) {
        $_SESSION['error'] = "Tài khoản đã tồn tại!";
        header("Location: " . BASE_URL . "/auth/register.php");
    } else {
        if ($userModel->register($username, $password)) {
            $_SESSION['success'] = "Đăng ký thành công! Đang chuyển hướng...";
            header("refresh:2;url=" . BASE_URL . "/auth/login.php");
        } else {
            $_SESSION['error'] = "Có lỗi xảy ra, vui lòng thử lại.";
            header("Location: " . BASE_URL . "/auth/register.php");
        }
    }
    exit;
}
if ($_POST['password'] !== $_POST['confirm_password']) {
    header("Location: ../../pages/register.php?error=Mật khẩu không khớp");
    exit();
}

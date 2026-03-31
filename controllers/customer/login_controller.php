<?php
session_start();
include("../../includes/connect.php");
require_once(__DIR__ . "/../../models/clsUser.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $userModel = new User($conn);
    $user = $userModel->login($username, $password);

    if ($user) {
        // Lưu thông tin vào Session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role']; // 0: Khách, 1: Nhân viên

        // Điều hướng dựa trên vai trò
        if ($user['role'] == 1) {
            header("Location: /Fruit/pages/admin/dashboard.php"); // Trang quản trị cho nhân viên
        } else {
            header("Location: /Fruit/index.php"); // Trang chủ cho khách hàng
        }
        exit;
    } else {
        $_SESSION['error'] = "Sai tài khoản hoặc mật khẩu!";
        header("Location: /Fruit/auth/login.php");
        exit;
    }
}

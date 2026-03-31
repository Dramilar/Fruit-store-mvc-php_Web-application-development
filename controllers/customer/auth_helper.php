<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Ngăn chặn khách hàng gõ địa chỉ vào trang của nhân viên
 */
function checkStaffAccess()
{
    // 1. Kiểm tra đã đăng nhập chưa
    if (!isset($_SESSION['user_id'])) {
        header("Location: /Fruit/auth/login.php");
        exit();
    }

    // 2. Kiểm tra role (1 là nhân viên, 2 là admin)
    if (!isset($_SESSION['role']) || $_SESSION['role'] < 1) {
        // Nếu là khách mà đòi vào trang nhân viên -> đá về trang chủ
        header("Location: /Fruit/index.php");
        exit();
    }
}

/**
 * Ngăn chặn người dùng chưa đăng nhập vào trang cá nhân/lịch sử
 */
function checkLoginAccess()
{
    if (!isset($_SESSION['user_id'])) {
        header("Location: /Fruit/auth/login.php");
        exit();
    }
}

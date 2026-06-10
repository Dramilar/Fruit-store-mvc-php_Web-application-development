<?php
session_start();
require_once __DIR__ . '/../includes/config.php';

class AuthController {
    public function logout() {
        // Hủy toàn bộ session
        session_unset();
        session_destroy();

        // Chuyển hướng về trang login
        header("Location: " . BASE_URL . "/auth/login.php");
        exit();
    }
}
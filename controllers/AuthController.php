<?php
session_start();

class AuthController {
    public function logout() {
        // Hủy toàn bộ session
        session_unset();
        session_destroy();

        // Chuyển hướng về trang login
        header("Location: /Fruit/auth/login.php");
        exit();
    }
}
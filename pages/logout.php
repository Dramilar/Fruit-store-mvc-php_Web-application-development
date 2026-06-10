<?php
ob_start(); // chống lỗi header

session_start();
require_once __DIR__ . '/../includes/config.php';

// Xóa toàn bộ session
$_SESSION = [];
session_destroy();

// Điều hướng về login
header("Location: " . BASE_URL . "/auth/login.php");
exit();
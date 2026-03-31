<?php
ob_start(); // chống lỗi header

session_start();

// Xóa toàn bộ session
$_SESSION = [];
session_destroy();

// Điều hướng về login
header("Location: /Fruit/auth/login.php");
exit();
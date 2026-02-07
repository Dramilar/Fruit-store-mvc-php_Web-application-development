<?php
$servername = "localhost";
$username = "fruit";
$password = "12345";
$dbname = "fruit";

// Kết nối
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

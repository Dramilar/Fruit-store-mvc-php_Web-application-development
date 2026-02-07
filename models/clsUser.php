<?php
class User
{
    private $conn;

    public function __construct($connection)
    {
        $this->conn = $connection;
    }

    // Đăng nhập: Trả về thông tin user hoặc false
    public function login($username, $password)
    {
        // Sử dụng Prepared Statement để chống SQL Injection
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE username = ? AND password = ? LIMIT 1");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {
            return $user;
        }
        return false;
    }

    // Kiểm tra username tồn tại
    public function checkExists($username)
    {
        $stmt = $this->conn->prepare("SELECT id FROM user WHERE username = ? LIMIT 1");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }

    // Đăng ký tài khoản khách hàng mặc định (role = 0)
    public function register($username, $password, $email = '')
    {
        $stmt = $this->conn->prepare("INSERT INTO user (username, password, email, role) VALUES (?, ?, ?, 0)");
        $stmt->bind_param("sss", $username, $password, $email);
        return $stmt->execute();
    }

    /**
     * Kiểm tra xem người dùng hiện tại có quyền nhân viên/admin không
     * @param int $userId
     * @param int $requiredRole (0: Khách, 1: Nhân viên, 2: Admin)
     */
    public function hasRole($userId, $requiredRole)
    {
        $stmt = $this->conn->prepare("SELECT role FROM user WHERE id = ? LIMIT 1");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($user = $result->fetch_assoc()) {
            return intval($user['role']) >= $requiredRole;
        }
        return false;
    }
}

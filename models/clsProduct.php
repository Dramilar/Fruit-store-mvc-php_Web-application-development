<?php
class Product
{
    private $conn;

    public function __construct($connection)
    {
        $this->conn = $connection;
    }

    // Hàm tìm kiếm sản phẩm theo tên, đặc điểm, và giá
    public function search($query)
    {
        if (empty($query)) {
            return null;
        }

        // Escape query để tránh SQL injection
        $query = $this->conn->real_escape_string($query);

        $sql = "SELECT p.*, t.typename
                FROM product p
                LEFT JOIN typeofproduct t ON p.id_type = t.id
                WHERE p.name LIKE '%$query%'
                   OR p.description LIKE '%$query%'
                   OR CAST(p.price AS CHAR) LIKE '%$query%'
                   OR t.typename LIKE '%$query%'
                ORDER BY p.name ASC";

        $result = $this->conn->query($sql);
        return $result;
    }

    // Hàm lấy tất cả sản phẩm
    public function getAllProducts()
    {
        $sql = "SELECT * FROM product ORDER BY name ASC";
        $result = $this->conn->query($sql);
        return $result;
    }

    // Hàm lấy sản phẩm theo loại
    public function getProductsByType($typeID)
    {
        if ($typeID <= 0) {
            return null;
        }

        $typeID = intval($typeID);
        $sql = "SELECT * FROM product WHERE id_type = $typeID ORDER BY name ASC";
        $result = $this->conn->query($sql);
        return $result;
    }

    // Hàm lấy chi tiết sản phẩm
    public function getProductById($productID)
    {
        if ($productID <= 0) {
            return null;
        }

        $productID = intval($productID);
        $sql = "SELECT p.*, t.typename
                FROM product p
                LEFT JOIN typeofproduct t ON p.id_type = t.id
                WHERE p.id = $productID";

        $result = $this->conn->query($sql);
        return $result ? $result->fetch_assoc() : null;
    }
}

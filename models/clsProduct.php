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
    // Thêm sản phẩm
public function insert($name, $price, $image, $id_type, $description)
{
    $name = $this->conn->real_escape_string($name);
    $price = intval($price);
    $image = $this->conn->real_escape_string($image);
    $id_type = intval($id_type);
    $description = $this->conn->real_escape_string($description);

    $sql = "INSERT INTO product(name, price, image, id_type, description)
            VALUES ('$name', $price, '$image', $id_type, '$description')";

    return $this->conn->query($sql);
}
// Sửa sản phẩm
public function update($id, $name, $price, $image, $id_type, $description)
{
    $id = intval($id);
    $name = $this->conn->real_escape_string($name);
    $price = intval($price);
    $image = $this->conn->real_escape_string($image);
    $id_type = intval($id_type);
    $description = $this->conn->real_escape_string($description);

    $sql = "UPDATE product SET 
                name='$name',
                price=$price,
                image='$image',
                id_type=$id_type,
                description='$description'
            WHERE id=$id";

    return $this->conn->query($sql);
}
// Xóa sản phẩm
public function delete($id)
{
    $id = intval($id);
    $sql = "DELETE FROM product WHERE id=$id";
    return $this->conn->query($sql);
}
}

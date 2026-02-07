<?php
include("../../includes/connect.php");
include_once(__DIR__ . "/../../models/clsProduct.php");
$typeID = isset($_GET['typeID']) ? intval($_GET['typeID']) : 0;

if ($typeID > 0) {
    $sql = "SELECT * FROM product WHERE id_type = $typeID";
} else {
    $sql = "SELECT * FROM product";
}

$result = $conn->query($sql);

// Bắt đầu vùng hiển thị sản phẩm
echo "<div class='content-right'>";
echo "<h2>📦 Sản Phẩm</h2>";

if ($result && $result->num_rows > 0) {
    // Thêm class 'product-grid' để điều khiển bằng CSS
    echo "<div class='product-grid'>";
    while ($row = $result->fetch_assoc()) {
        echo "<div class='product-item'>
            <div class='product-img'>
                <img src='../images/" . $row['image'] . "' alt='" . $row['name'] . "'>
            </div>
            <h3 class='product-name'>" . $row['name'] . "</h3>
            <p class='product-price'>" . number_format($row['price'], 0, ',', '.') . "₫</p>
            <a href='/Fruit/pages/detail_products.php?id=" . $row['id'] . "' class='btn-detail'>Xem chi tiết</a>
            <button class='add-to-cart btn btn-success' data-id='" . $row['id'] . "' data-name='" . htmlspecialchars($row['name']) . "' data-price='" . $row['price'] . "' data-image='" . htmlspecialchars($row['image']) . "'>
                🛒 Thêm vào giỏ
            </button>
          </div>";
    }
    echo "</div>"; // Đóng product-grid
} else {
    echo "<p>Không có sản phẩm nào thuộc loại này.</p>";
}
echo "</div>"; // Đóng content-right

<?php
include("../../includes/connect.php");
require_once("../../models/clsProduct.php");

$query = isset($_GET['query']) ? trim($_GET['query']) : '';

$product = new Product($conn);

// Bắt đầu vùng hiển thị kết quả tìm kiếm
echo "<div class='content-right'>";
echo "<h2>🔍 Kết quả tìm kiếm: <strong>" . htmlspecialchars($query) . "</strong></h2>";

if (!empty($query)) {
    $result = $product->search($query);
} else {
    $result = null;
}

if ($result && $result->num_rows > 0) {
    echo "<div class='product-grid'>";
    while ($row = $result->fetch_assoc()) {
        echo "<div class='product-item'>
            <div class='product-img'>
                <img src='../../images/" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "'>
            </div>
            <h3 class='product-name'>" . htmlspecialchars($row['name']) . "</h3>
            <p class='product-description'>" . htmlspecialchars($row['description']) . "</p>
            <p class='product-price'>Giá: " . number_format($row['price'], 0, ',', '.') . "₫/kg</p>
            <p class='product-type'>Loại: " . htmlspecialchars($row['typename']) . "</p>
            <button class='add-to-cart btn btn-success' data-id='" . $row['id'] . "' data-name='" . htmlspecialchars($row['name']) . "' data-price='" . $row['price'] . "' data-image='" . htmlspecialchars($row['image']) . "'>
                🛒 Thêm vào giỏ
            </button>
          </div>";
    }
    echo "</div>";
} else {
    echo "<p>Không tìm thấy sản phẩm nào phù hợp với từ khóa: <strong>" . htmlspecialchars($query) . "</strong></p>";
}

echo "</div>";

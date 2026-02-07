<?php
include("connect.php");
require_once(__DIR__ . "/../models/clsProduct.php");

$typeID = isset($_GET['typeID']) ? intval($_GET['typeID']) : 0;

$product = new Product($conn);

if ($typeID > 0) {
    $result = $product->getProductsByType($typeID);
} else {
    $result = $product->getAllProducts();
}

echo "<div class='product-list'>";

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='product'>
                <img src='images/" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "'>
                <h3>" . htmlspecialchars($row['name']) . "</h3>
                <p class='price'>Giá: " . number_format($row['price'], 0, ',', '.') . "₫/kg</p>
                <p style='font-size: 0.9em; color: #666;'>" . htmlspecialchars($row['description']) . "</p>
                <button class='add-to-cart btn btn-success' data-id='" . $row['id'] . "' data-name='" . htmlspecialchars($row['name']) . "' data-price='" . $row['price'] . "' data-image='" . htmlspecialchars($row['image']) . "'>
                    🛒 Thêm vào giỏ
                </button>
              </div>";
    }
} else {
    echo "<p>Không có sản phẩm nào trong danh mục này.</p>";
}

echo "</div>";
?>

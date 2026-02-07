<?php
include("connect.php");

// Sửa tên bảng thành 'typeofproduct' (viết thường giống database đã tạo)
$sql = "SELECT * FROM typeofproduct";
$result = $conn->query($sql);

echo "<div class='category-list'>";
echo "<h2>📌 Danh Mục Sản Phẩm</h2>";
echo "<ul>";

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Thay 'TypeID' bằng 'id' và 'TypeName' bằng 'typename'
        echo "<li>
                <a href='#' class='category-item' data-type='" . $row['id'] . "'>
                    🛍️ " . $row['typename'] . "
                </a>
              </li>";
    }
} else {
    echo "<li>Không có danh mục sản phẩm</li>";
}

echo "</ul>";
echo "</div>";

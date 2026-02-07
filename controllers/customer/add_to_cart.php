<?php
require_once '../../models/clsCart.php'; // Include the Cart model

$cart = new Cart(); // Initialize cart instance

// Handle POST request for adding to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $product_name = isset($_POST['product_name']) ? trim($_POST['product_name']) : '';
    $product_price = isset($_POST['product_price']) ? floatval($_POST['product_price']) : 0.0;
    $product_image = isset($_POST['product_image']) ? trim($_POST['product_image']) : '';
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    if ($product_id > 0 && !empty($product_name) && $product_price > 0) {
        $total_items = $cart->add($product_id, $product_name, $product_price, $product_image, $quantity);
        echo json_encode([
            'success' => true,
            'total_items' => $total_items,
            'message' => 'Đã thêm ' . $product_name . ' vào giỏ hàng!'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Dữ liệu sản phẩm không hợp lệ!'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Phương thức không được hỗ trợ!'
    ]);
}

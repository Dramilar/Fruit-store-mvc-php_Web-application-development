<?php
require_once '../../models/clsCart.php';

$cart = new Cart();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    if ($id > 0) {
        if ($action === 'increase') {
            $current_qty = isset($_SESSION['cart'][$id]['quantity']) ? $_SESSION['cart'][$id]['quantity'] : 0;
            $cart->updateQuantity($id, $current_qty + 1);
            echo json_encode(['success' => true, 'message' => 'Đã tăng số lượng!', 'total_items' => $cart->getTotalItems()]);
        } elseif ($action === 'decrease') {
            $current_qty = isset($_SESSION['cart'][$id]['quantity']) ? $_SESSION['cart'][$id]['quantity'] : 0;
            if ($current_qty > 1) {
                $cart->updateQuantity($id, $current_qty - 1);
                echo json_encode(['success' => true, 'message' => 'Đã giảm số lượng!', 'total_items' => $cart->getTotalItems()]);
            } else {
                $cart->remove($id);
                echo json_encode(['success' => true, 'message' => 'Đã xóa sản phẩm!', 'total_items' => $cart->getTotalItems()]);
            }
        } elseif ($action === 'remove') {
            $cart->remove($id);
            echo json_encode(['success' => true, 'message' => 'Đã xóa sản phẩm!', 'total_items' => $cart->getTotalItems()]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Hành động không hợp lệ!']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID sản phẩm không hợp lệ!']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Phương thức không được hỗ trợ!']);
}

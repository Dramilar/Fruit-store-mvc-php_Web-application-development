<?php
class Cart
{
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    // Hàm thêm sản phẩm
    public function add($id, $name, $price, $image, $quantity = 1)
    {
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity'] += $quantity;
        } else {
            $_SESSION['cart'][$id] = [
                'id' => $id,
                'name' => $name,
                'price' => $price,
                'image' => $image,
                'quantity' => $quantity
            ];
        }
        return $this->getTotalItems();
    }

    // Hàm cập nhật số lượng sản phẩm
    public function updateQuantity($id, $quantity)
    {
        if (isset($_SESSION['cart'][$id])) {
            if ($quantity > 0) {
                $_SESSION['cart'][$id]['quantity'] = $quantity;
            } else {
                unset($_SESSION['cart'][$id]);
            }
        }
    }

    // Hàm xóa sản phẩm
    public function remove($id)
    {
        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }
    }

    // Hàm lấy tổng số lượng sản phẩm (để hiện lên icon giỏ hàng)
    public function getTotalItems()
    {
        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['quantity'];
        }
        return $total;
    }

    // Hàm tính tổng tiền
    public function getTotalPrice()
    {
        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total += ($item['price'] * $item['quantity']);
        }
        return $total;
    }
}
$cart = new Cart();

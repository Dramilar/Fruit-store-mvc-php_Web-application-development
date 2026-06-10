<?php
session_start();

require_once __DIR__ . '/../../includes/connect.php';
require_once __DIR__ . '/../../models/clsProduct.php';

$product = new Product($conn);

// THÊM
if(isset($_POST['add'])){

    $name = $_POST['name'];
    $price = $_POST['price'];
    $id_type = $_POST['id_type'];
    $description = $_POST['description'];

    // xử lý upload ảnh
    $imageName = $_FILES['image']['name'];
    $tmpName = $_FILES['image']['tmp_name'];

    $uploadPath = "../../bin/images/" . $imageName;

    move_uploaded_file($tmpName, $uploadPath);

    $product->insert($name, $price, $imageName, $id_type, $description);

    header("Location: ../../pages/admin/manager_products.php");
}

// SỬA
if(isset($_POST['update'])){

    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $id_type = $_POST['id_type'];
    $description = $_POST['description'];

    $imageName = $_FILES['image']['name'];

    if($imageName != ""){
        $tmpName = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmpName, "../../bin/images/" . $imageName);
    } else {
        $imageName = $_POST['old_image'];
    }

    $product->update($id, $name, $price, $imageName, $id_type, $description);

    header("Location: ../../pages/admin/manager_products.php");
}

// XOÁ
if(isset($_GET['delete'])){
    $id = intval($_GET['delete']);

    // kiểm tra sản phẩm có trong đơn hàng không
    $check = $conn->query("SELECT * FROM order_details WHERE product_id = $id");

    if($check->num_rows > 0){
        echo "<script>
                alert('❌ Không thể xóa sản phẩm vì đã tồn tại trong đơn hàng!');
                window.location.href='<?= BASE_URL ?>/pages/admin/manager_products.php';
              </script>";
    } else {
        $product->delete($id);
        header("Location: " . BASE_URL . "/pages/admin/manager_products.php");
        exit();
    }
}
?>
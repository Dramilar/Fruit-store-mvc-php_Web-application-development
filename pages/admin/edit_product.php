<?php
include($_SERVER['DOCUMENT_ROOT'] . "/Fruit/includes/connect.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/Fruit/models/clsProduct.php");

$product = new Product($conn);

$id = $_GET['id'];
$row = $product->getProductById($id);
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container py-5">

    <div class="card shadow-lg border-0 rounded-4 p-4">

        <h3 class="mb-4">✏️ Sửa sản phẩm</h3>

        <form method="POST" 
              action="../../controllers/staff/product_controller.php"
              enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <input type="hidden" name="old_image" value="<?= htmlspecialchars($row['image']) ?>">

            <!-- TÊN -->
            <label class="fw-semibold">Tên sản phẩm</label>
            <input type="text" name="name" class="form-control mb-3"
                   value="<?= htmlspecialchars($row['name']) ?>" required>

            <!-- GIÁ -->
            <label class="fw-semibold">Giá</label>
            <input type="number" name="price" class="form-control mb-3"
                   value="<?= $row['price'] ?>" required>

            <!-- ẢNH -->
            <label class="fw-semibold">Ảnh hiện tại</label><br>
            <img id="preview"
                 src="/Fruit/bin/images/<?= htmlspecialchars($row['image']) ?>"
                 class="mb-3 product-img">

            <input type="file" name="image" class="form-control mb-3" onchange="previewImage(event)">

            <!-- LOẠI SẢN PHẨM -->
            <label class="fw-semibold">Loại sản phẩm</label>
            <select name="id_type" class="form-control mb-3" required>
                <?php for ($i = 1; $i <= 4; $i++): ?>
                    <option value="<?= $i ?>" <?= ($row['id_type'] == $i) ? 'selected' : '' ?>>
                        Loại <?= $i ?>
                    </option>
                <?php endfor; ?>
            </select>

            <!-- MÔ TẢ -->
            <label class="fw-semibold">Mô tả</label>
            <textarea name="description" class="form-control mb-3" rows="4"><?= htmlspecialchars($row['description']) ?></textarea>

            <!-- BUTTON -->
            <div class="d-flex gap-2">
                <button name="update" class="btn btn-warning px-4">Cập nhật</button>
                <a href="products.php" class="btn btn-secondary px-4">Quay lại</a>
            </div>

        </form>

    </div>
</div>

<style>
    body {
        background: #f4f6f9;
    }

    .product-img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 3px 8px rgba(0,0,0,0.1);
    }
</style>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            document.getElementById('preview').src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
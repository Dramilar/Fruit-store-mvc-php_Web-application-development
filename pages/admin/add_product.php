<?php include("../../includes/connect.php");
include("../../controllers/customer/auth_helper.php");
checkLoginAccess(); // Kiểm tra quyền truy cập
//session_start();
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?= BASE_URL ?>/bin/css/style.css">

<div class="container py-5">

    <div class="card shadow-lg border-0 rounded-4 p-4">

        <h3 class="mb-4">➕ Thêm sản phẩm</h3>

        <form method="POST"
            action="../../controllers/staff/product_controller.php"
            enctype="multipart/form-data">

            <!-- TÊN -->
            <label class="fw-semibold">Tên sản phẩm</label>
            <input type="text" name="name" class="form-control mb-3" required>

            <!-- GIÁ -->
            <label class="fw-semibold">Giá</label>
            <input type="number" name="price" class="form-control mb-3" required>

            <!-- ẢNH -->
            <label class="fw-semibold">Ảnh sản phẩm</label><br>
            <img id="preview"
                src="https://via.placeholder.com/100"
                class="mb-3 product-img">

            <input type="file" name="image" class="form-control mb-3" required onchange="previewImage(event)">

            <!-- LOẠI -->
            <label class="fw-semibold">Loại sản phẩm</label>
            <select name="id_type" class="form-control mb-3" required>
                <option value="">-- Chọn loại --</option>
                <?php for ($i = 1; $i <= 4; $i++): ?>
                    <option value="<?= $i ?>">Loại <?= $i ?></option>
                <?php endfor; ?>
            </select>

            <!-- MÔ TẢ -->
            <label class="fw-semibold">Mô tả</label>
            <textarea name="description" class="form-control mb-3" rows="4"></textarea>

            <!-- BUTTON -->
            <div class="d-flex gap-2">
                <button name="add" class="btn btn-success px-4">Thêm</button>
                <a href="manager_products.php" class="btn btn-secondary px-4">Quay lại</a>
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
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
    }
</style>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            document.getElementById('preview').src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
<?php
include("../../includes/connect.php");
require_once("../../models/clsProduct.php");

include("../../controllers/customer/auth_helper.php");
checkLoginAccess(); // Kiểm tra quyền truy cập
//session_start();


$product = new Product($conn);
$list = $product->getAllProducts();
$total = mysqli_num_rows($list);
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="../../bin/css/bootstrap.css">
<link rel="stylesheet" href="../../bin/css/style.css">
<link rel="stylesheet" href="../../bin/css/banner.css">

<?php include("../../includes/header.php"); ?>
<?php include("../../includes/banner_admin.php"); ?>

<div class="container py-5">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">📦 Quản lý sản phẩm</h2>
            <small class="text-muted">Tổng: <?= $total ?> sản phẩm</small>
        </div>

        <a href="add_product.php" class="btn btn-success rounded-pill px-4">
            + Thêm sản phẩm
        </a>
    </div>

    <!-- SEARCH -->
    <input type="text" id="searchInput" class="form-control mb-3" placeholder="🔍 Tìm sản phẩm...">

    <!-- TABLE -->
    <div class="card shadow border-0 rounded-4">
        <div class="table-responsive">

            <table class="table align-middle text-center mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th class="text-start">Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Ảnh</th>
                        <th>Hành động</th>
                    </tr>
                </thead>

                <tbody id="productTable">
                    <?php while ($row = mysqli_fetch_assoc($list)) { ?>
                        <tr>
                            <td>#<?= $row['id'] ?></td>

                            <td class="text-start fw-semibold">
                                <?= htmlspecialchars($row['name']) ?>
                            </td>

                            <td>
                                <span class="badge bg-danger fs-6">
                                    <?= number_format($row['price']) ?>₫
                                </span>
                            </td>

                            <td>
                                <img src="/Fruit/bin/images/<?= htmlspecialchars($row['image']) ?>"
                                    class="product-img">
                            </td>

                            <td>
                                <a href="edit_product.php?id=<?= $row['id'] ?>"
                                    class="btn btn-warning btn-sm rounded-pill px-3">
                                    ✏️
                                </a>

                                <a href="../../controllers/staff/product_controller.php?delete=<?= $row['id'] ?>"
                                    class="btn btn-danger btn-sm rounded-pill px-3"
                                    onclick="return confirm('Xóa sản phẩm này?')">
                                    🗑
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>

            </table>

        </div>
    </div>
</div>
<?php include("../../includes/footer.php"); ?>
<div style="color: red; font-style: italic; font-weight: bold;">
    <h2><a href="dashboard.php">Quay lại trang chủ</a></h2>
</div>

<style>
    body {
        background: #f4f6f9;
    }

    .product-img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 12px;
        transition: 0.3s;
    }

    .product-img:hover {
        transform: scale(1.2);
    }

    table tbody tr:hover {
        background: #f1f1f1;
    }

    .card {
        overflow: hidden;
    }
</style>

<script>
    // SEARCH realtime
    document.getElementById("searchInput").addEventListener("keyup", function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll("#productTable tr");

        rows.forEach(row => {
            let name = row.innerText.toLowerCase();
            row.style.display = name.includes(filter) ? "" : "none";
        });
    });
</script>
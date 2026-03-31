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
?>

<div class="container mt-4">
    <div class="row">

        <?php if ($result && $result->num_rows > 0): ?>

            <?php while ($row = $result->fetch_assoc()): ?>
                
                <div class="col-md-3 mb-4">
                    <div class="card h-100 shadow-sm">

                        <!-- ẢNH -->
                        <img src="/Fruit/bin/images/<?php echo htmlspecialchars($row['image']); ?>" 
                             class="card-img-top"
                             style="height: 200px; object-fit: cover;">

                        <div class="card-body d-flex flex-column text-center">

                            <!-- TÊN -->
                            <h5 class="card-title">
                                <?php echo htmlspecialchars($row['name']); ?>
                            </h5>

                            <!-- GIÁ -->
                            <p class="text-danger fw-bold">
                                <?php echo number_format($row['price'], 0, ',', '.'); ?>₫/kg
                            </p>

                            <!-- MÔ TẢ -->
                            <p class="card-text small text-muted">
                                <?php echo htmlspecialchars($row['description']); ?>
                            </p>

                            <!-- BUTTON -->
                            <button class="btn btn-success mt-auto add-to-cart"
                                data-id="<?php echo $row['id']; ?>"
                                data-name="<?php echo htmlspecialchars($row['name']); ?>"
                                data-price="<?php echo $row['price']; ?>"
                                data-image="<?php echo htmlspecialchars($row['image']); ?>">
                                🛒 Thêm vào giỏ
                            </button>

                        </div>
                    </div>
                </div>

            <?php endwhile; ?>

        <?php else: ?>
            <p>Không có sản phẩm nào trong danh mục này.</p>
        <?php endif; ?>

    </div>
</div>
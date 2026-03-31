<?php
include("../includes/connect.php");
include("../controllers/customer/auth_helper.php");
checkLoginAccess(); // Kiểm tra quyền truy cập

$orderId = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
$orderTotal = 0;

if ($orderId > 0) {
    $stmt = $conn->prepare("SELECT total_price FROM orders WHERE id = ? LIMIT 1");
    if ($stmt) {
        $stmt->bind_param("i", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result ? $result->fetch_assoc() : null;
        $stmt->close();
        if ($row) {
            $orderTotal = floatval($row['total_price']);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đặt hàng thành công</title>
    <link rel="stylesheet" href="/Fruit/bin/css/style.css">
    <link rel="stylesheet" href="/Fruit/bin/css/bootstrap.css">
    <link rel="stylesheet" href="/Fruit/bin/css/banner.css">
    <link rel="stylesheet" href="/Fruit/bin/css/payment.css">
</head>

<body>
    <?php include("../includes/header.php"); ?>
    <?php include("../includes/banner.php"); ?>

    <div class="payment-container">
        <div class="payment-summary">
            <h2>Đặt hàng thành công</h2>
            <p>Cảm ơn bạn đã mua hàng tại Fruit Shop.</p>
            <?php if ($orderId > 0 && $orderTotal > 0): ?>
                <p>Vui lòng thanh toán đơn hàng số <strong><?php echo htmlspecialchars($orderId); ?></strong> tại mã QR dưới đây</p>
                <img src="https://img.vietqr.io/image/vcb-9342637512-compact.png?amount=<?php echo htmlspecialchars($orderTotal); ?>&addInfo=FRUIT123&accountName=TranChiTien" alt="QR thanh toán">
                <!-- <img src="https://img.vietqr.io/image/vcb-9342637512-compact.png?amount=5000&addInfo=FRUIT123&accountName=TranChiTien%22" alt=""> -->
            <?php elseif ($orderId > 0): ?>
                <p>Không tìm thấy thông tin tổng tiền cho đơn hàng số <strong><?php echo htmlspecialchars($orderId); ?></strong>.</p>
            <?php endif; ?>
            <div style="margin-top: 15px;">
                <a href="/Fruit/index.php" class="btn btn-primary">Về trang chủ</a>
                <a href="/Fruit/pages/purchase_history.php" class="btn btn-secondary">Lịch sử mua hàng</a>
            </div>
        </div>
    </div>

    <?php include("../includes/footer.php"); ?>
</body>

</html>
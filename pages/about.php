<?php session_start();
require_once __DIR__ . '/../includes/config.php'; ?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Về Chúng Tôi</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/bin/css/style.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/bin/css/bootstrap.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/bin/css/about.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/bin/css/banner.css">
</head>

<body>
    <?php include("../includes/header.php"); ?>
    <?php include("../includes/banner.php"); ?>

    <div class="about-container">
        <div class="about-hero">
            <h1>🍎 Về Chúng Tôi</h1>
            <p class="subtitle">Chất lượng tự nhiên, hương vị thực</p>
        </div>

        <div class="about-content">
            <section class="about-section">
                <h2>📖 Câu Chuyện Của Chúng Tôi</h2>
                <div class="about-story">
                    <div class="story-image">
                        <img src="<?= BASE_URL ?>/bin/images/about.jpg" alt="Về chúng tôi" class="about-img">
                    </div>
                    <div class="story-text">
                        <p>
                            Chào mừng đến với <strong>Fruit Store</strong> - một nền tảng thương mại điện tử chuyên cung cấp trái cây tươi,
                            chất lượng cao từ những vùng nông nghiệp tốt nhất. Chúng tôi cam kết mang đến cho bạn những sản phẩm
                            tự nhiên, an toàn và giàu dinh dưỡng cho gia đình bạn.
                        </p>
                        <p>
                            Với hơn 10 năm kinh nghiệm trong lĩnh vực buôn bán trái cây, chúng tôi đã xây dựng được mối quan hệ
                            chặt chẽ với hàng trăm trang trại lớn trên khắp đất nước. Mục tiêu của chúng tôi là đem lại sự
                            hài lòng tối đa cho khách hàng thông qua các sản phẩm chất lượng cao và dịch vụ tuyệt vời.
                        </p>
                    </div>
                </div>
            </section>

            <section class="about-section">
                <h2>🎯 Sứ Mệnh Của Chúng Tôi</h2>
                <ul class="mission-list">
                    <li>✅ Cung cấp trái cây tươi, chất lượng cao với giá cạnh tranh</li>
                    <li>✅ Đảm bảo an toàn thực phẩm và vệ sinh tiêu chuẩn quốc tế</li>
                    <li>✅ Phục vụ khách hàng với tâm thế chuyên nghiệp và nhiệt tình</li>
                    <li>✅ Hỗ trợ nông dân địa phương và phát triển nông nghiệp bền vững</li>
                </ul>
            </section>

            <section class="about-section">
                <h2>🌟 Tại Sao Chọn Chúng Tôi?</h2>
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">🥗</div>
                        <h3>Tươi Mới 100%</h3>
                        <p>Trái cây được thu hoạch và gửi đến bạn trong 24 giờ</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">🚚</div>
                        <h3>Giao Hàng Nhanh</h3>
                        <p>Miễn phí giao hàng cho đơn hàng trên 200.000₫</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">💯</div>
                        <h3>Chất Lượng Đảm Bảo</h3>
                        <p>Tất cả sản phẩm đều qua kiểm tra chất lượng nghiêm ngặt</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">💰</div>
                        <h3>Giá Hợp Lý</h3>
                        <p>Mua trực tiếp từ người sản xuất, không qua trung gian</p>
                    </div>
                </div>
            </section>

            <section class="about-section">
                <h2>📞 Liên Hệ Chúng Tôi</h2>
                <div class="contact-info">
                    <p><strong>Địa chỉ:</strong> Xóm 3, thôn Vĩnh Hải, xã Vĩnh Hảo, huyện Tuy Phong, tỉnh Bình Thuận</p>
                    <p><strong>Điện thoại:</strong> 034 2637 512</p>
                    <p><strong>Email:</strong> info@fruitstore.com</p>
                    <p><strong>Giờ hoạt động:</strong> 7h00 - 21h00 (Hàng ngày)</p>
                </div>
            </section>
        </div>
    </div>

    <?php include("../includes/footer.php"); ?>
</body>

</html>
<script src="<?= BASE_URL ?>/bin/js/jquery-3.7.1.js"></script>
<script src="<?= BASE_URL ?>/bin/js/main.js"></script>
<div id="menu">
    <div id="menu-left">
        <ul>
            <li><a href="/Fruit/index.php">🏠 Home</a></li>
            <li>
                <form id="search-form">
                    <input type="text" id="search-input" placeholder="Tìm kiếm sản phẩm">
                    <button type="submit">🔍</button>
                </form>
            </li>
            <li><a href="/Fruit/news.php">📰 News</a></li>
            <li><a href="/Fruit/pages/about.php">ℹ️ About Us</a></li>
        </ul>
    </div>
    <div id="menu-right">
        <div class="dropdown">
            <button class="dropbtn" type="button">👤 Account</button>
            <div class="dropdown-content">
                <a href="/Fruit/pages/cart.php" id="cart-link">🛒 Shopping Cart (<span id="cart-count">0</span>)</a>
                <a href="/Fruit/pages/purchase_history.php">📜 Purchase History</a>
                <a href="/Fruit/pages/change_password.php">🔒 Change Password</a>
                <a href="/Fruit/pages/logout.php">🚪 Logout</a>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // 1. Xử lý Dropdown Account
        $('.dropbtn').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation(); // Ngăn sự kiện click lan ra ngoài làm đóng menu ngay lập tức

            // Đóng các dropdown khác nếu có và toggle cái hiện tại
            $('.dropdown-content').not($(this).next()).fadeOut(200);
            $(this).next('.dropdown-content').fadeToggle(200);
        });

        // 2. Click ra ngoài vùng menu thì đóng dropdown
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.dropdown').length) {
                $('.dropdown-content').fadeOut(200);
            }
        });

        // 3. Ngăn việc đóng menu khi click vào bên trong (trừ các link)
        $('.dropdown-content').on('click', function(e) {
            // Nếu click vào link thì cho phép chuyển trang, nếu không thì đứng yên
            if (!$(e.target).is('a')) {
                e.stopPropagation();
            }
        });

        // Các xử lý AJAX khác của bạn (Giỏ hàng, Tìm kiếm...) giữ nguyên bên dưới
    });
</script>
<script src="/Fruit/bin/js/jquery-3.7.1.js"></script>
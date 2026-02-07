$(document).ready(function () {
    // 1. Xử lý khi nhấn vào danh mục sản phẩm (Lọc)
    $(".category-item").click(function (e) {
        e.preventDefault();
        var typeID = $(this).data("type");
        console.log("Filter by typeID: " + typeID); // Debug
        $.ajax({
            url: "/Fruit/controllers/customer/filter_products.php",
            type: "GET",
            data: { typeID: typeID },
            success: function (response) {
                console.log("Response received"); // Debug
                $("#right").html(response);
            },
            error: function (xhr, status, error) {
                console.error("Error: " + error); // Debug
            }
        });
    });

    // 2. Xử lý tìm kiếm sản phẩm
    $("#search-form").submit(function (e) {
        e.preventDefault();
        var query = $("#search-input").val();
        $.ajax({
            url: "/Fruit/controllers/customer/search_products.php",
            type: "GET",
            data: { query: query },
            success: function (response) {
                $("#right").html(response);
            }
        });
    });

    // 3. Xử lý thêm vào giỏ hàng (Dùng $(document).on vì sản phẩm có thể load qua AJAX)
    $(document).on('click', '.add-to-cart', function (e) {
        e.preventDefault();
        var productId = $(this).data('id');
        var productName = $(this).data('name');
        var productPrice = $(this).data('price');
        var productImage = $(this).data('image');
        $.ajax({
            url: "/Fruit/controllers/customer/add_to_cart.php", // Updated to controller path
            type: "POST",
            data: {
                product_id: productId,
                product_name: productName,
                product_price: productPrice,
                product_image: productImage
            },
            success: function (response) {
                var result = JSON.parse(response);
                if (result.success) {
                    showToast(result.message, 'success');
                    updateCartCount(result.total_items);
                } else {
                    showToast(result.message, 'error');
                }
            },
            error: function () {
                showToast('Có lỗi xảy ra khi thêm vào giỏ hàng!', 'error');
            }
        });
    });
    // Hàm hiển thị toast notification
    function showToast(message, type = 'success') {
        const toast = $('<div class="toast-item"></div>').text(message).css({
            'background': type === 'success' ? '#27ae60' : '#e74c3c',
            'color': '#fff',
            'padding': '15px 25px',
            'border-radius': '5px',
            'box-shadow': '0 4px 6px rgba(0,0,0,0.2)',
            'min-width': '200px',
            'position': 'fixed',
            'top': '50%',
            'left': '50%',
            'transform': 'translate(-50%, -50%)',
            'z-index': '10001',
            'display': 'none',
            'text-align': 'center'
        });

        $('#toast-container').append(toast);
        toast.fadeIn(400).delay(2000).fadeOut(400, function () {
            $(this).remove(); // Xóa khỏi DOM sau khi ẩn
        });
    }

    // 4. Các hàm cập nhật giỏ hàng
    window.updateCartCount = function (count) {
        $('#cart-count').text(count);
    };

    function loadCartCount() {
        $.ajax({
            url: "/Fruit/includes/handler/customer/get_cart_count.php",
            type: "GET",
            success: function (response) {
                var result = JSON.parse(response);
                updateCartCount(result.total_items);
            }
        });
    }

    loadCartCount(); // Gọi ngay khi load trang
});
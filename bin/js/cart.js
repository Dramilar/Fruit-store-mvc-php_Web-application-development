$(document).ready(function () {
    // Xử lý tăng số lượng
    $(document).on('click', '.increase-qty', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        updateCart('increase', id);
    });

    // Xử lý giảm số lượng
    $(document).on('click', '.decrease-qty', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        updateCart('decrease', id);
    });

    // Xử lý xóa sản phẩm
    $(document).on('click', '.remove-item', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        updateCart('remove', id);
    });

    function updateCart(action, id) {
        $.ajax({
            url: '/Fruit/controllers/customer/update_cart.php',
            type: 'POST',
            data: {
                action: action,
                id: id
            },
            success: function (response) {
                var result = JSON.parse(response);
                if (result.success) {
                    // Update cart count
                    updateCartCount(result.total_items);

                    // Update DOM
                    var item = $('[data-id="' + id + '"]').closest('.cart-item');
                    if (action === 'remove') {
                        item.remove();
                    } else {
                        var qtySpan = item.find('.quantity');
                        var currentQty = parseInt(qtySpan.text());
                        if (action === 'increase') {
                            qtySpan.text(currentQty + 1);
                        } else if (action === 'decrease') {
                            if (currentQty > 1) {
                                qtySpan.text(currentQty - 1);
                            } else {
                                item.remove();
                            }
                        }

                        // Recalculate subtotal
                        var priceText = item.find('p').eq(0).text(); // Giá: 1000₫
                        var price = parseFloat(priceText.replace(/[^\d]/g, ''));
                        var qty = parseInt(qtySpan.text());
                        var subtotal = price * qty;
                        item.find('p').eq(2).text('Tổng: ' + subtotal.toLocaleString() + '₫');
                    }

                    // Recalculate total
                    var total = 0;
                    $('.cart-item').each(function () {
                        var subText = $(this).find('p').eq(2).text();
                        var sub = parseFloat(subText.replace(/[^\d]/g, ''));
                        total += sub;
                    });
                    $('.cart-total h2').text('Tổng cộng: ' + total.toLocaleString() + '₫');

                    // Check if cart is empty
                    if ($('.cart-item').length === 0) {
                        $('.cart-items').html('<p>Giỏ hàng của bạn đang trống. <a href="/Fruit/index.php">Tiếp tục mua sắm</a></p>');
                        $('.cart-total').hide();
                    }

                    showToast(result.message, 'success');
                } else {
                    showToast(result.message, 'error');
                }
            },
            error: function () {
                showToast('Có lỗi xảy ra!', 'error');
            }
        });
    }
});

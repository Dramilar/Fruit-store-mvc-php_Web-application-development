$(document).ready(function () {
    $('#payment-form').on('submit', function () {
        var fullName = $('#full_name').val().trim();
        var phone = $('#phone').val().trim();
        var address = $('#address').val().trim();

        if (!fullName || !phone || !address) {
            alert('Vui lòng nhập đầy đủ thông tin bắt buộc.');
            return false;
        }
        return true;
    });
});

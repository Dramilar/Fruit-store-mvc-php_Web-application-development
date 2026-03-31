<footer style="background: #333; color: white; text-align: center; padding: 20px; margin-top: 20px;">
    <p>&copy; 2026 Nhóm 12 PHP, DHHTTT19B, Đại Học Công Nghiệp. All rights reserved.</p>
</footer>
<script src="/Fruit/bin/js/jquery-3.7.1.js"></script>

<script>
    $(document).ready(function() {
        $('.dropbtn').on('click', function(e) {
            e.stopPropagation();
            $('.dropdown-content').fadeToggle(200);
        });
        $(document).on('click', function() {
            $('.dropdown-content').fadeOut(200);
        });
    });
</script>
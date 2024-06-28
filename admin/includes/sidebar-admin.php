<sidebar>
    <div class="sidebar-admin">
        <h1>Tất cả</h1>
        <nav>
            <ul>
                <li><a href="index.php"><i class="fa-solid fa-house"></i>Trang chủ</a></li>
                <li><a href="quanlytaikhoan.php"><i class="fa-solid fa-users"></i>Quản lý tài khoản</a></li>
                <li><a href="quanlydanhmuc.php"><i class="fa-solid fa-list"></i>Quản lý danh mục</a></li>
                <li><a href="quanlysanpham.php"><i class="fa-solid fa-gift"></i>Quản lý sản phẩm</a></li>
                <li><a href="quanlydonhang.php"><i class="fa-brands fa-shopify"></i>Quản lý đơn hàng</a></li>
                <li><a href="quanlythongke.php"><i class="fa-solid fa-chart-line"></i>Quản lý thống kê</a></li>
            </ul>
        </nav>
    </div>
</sidebar>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var currentPageUrl = window.location.href;
    var sidebarLinks = document.querySelectorAll(".sidebar-admin nav ul li a");

    sidebarLinks.forEach(function(link) {
        if (link.href === currentPageUrl) {
            link.parentNode.classList.add("active");
        }
    });
});
</script>
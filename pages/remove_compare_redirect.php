<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['removedproductID'])) {
    $removedproductID = $_GET['removedproductID'];

    // Lưu thông tin sách đã xóa vào session để hiển thị thông báo sau khi chuyển hướng
    $_SESSION['removedproductID'] = $removedproductID;

    // Chuyển hướng sang trang wishlist.php với phương thức GET
    header("Location: compare.php");
    exit();
} else {
    // Xử lý lỗi hoặc yêu cầu không hợp lệ
    echo "Lỗi: Yêu cầu không hợp lệ";
}
?>
<?php
session_start(); // Bắt đầu session

require_once "../config/config.php";

// Kiểm tra xem người dùng đã submit form đăng nhập chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy thông tin đăng nhập từ form
    $username = $_POST["username"];
    $password = $_POST["password"];


    // Tìm kiếm người dùng trong cơ sở dữ liệu
    $query = "SELECT * FROM users WHERE Username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $storedPassword = $user['Password'];

        if ($password === $storedPassword) {
            // Lưu thông tin người dùng vào session để sử dụng ở các trang khác
            $_SESSION['username'] = $username;

            // Chuyển hướng đến trang chính của người dùng
            header('Location: my_account.php');
            exit();
        } else {
            $_SESSION['error_message'] = 'Sai tên tài khoản hoặc mật khẩu *';
            header('Location: login_register.php');
            exit();
        }
    } else {
        $_SESSION['error_message'] = 'Sai tên tài khoản hoặc mật khẩu *';
        header('Location: login_register.php');
        exit();
    }
}
?>
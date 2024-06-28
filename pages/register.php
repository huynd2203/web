<?php
session_start();
require_once "../config/config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Kiểm tra xem tên đăng nhập đã được sử dụng chưa
  $sql = "SELECT * FROM users WHERE username='$username'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    header('Location: signup.php?dang_ky_that_bai');
    return;
  }

  // Thêm thông tin người dùng vào cơ sở dữ liệu
  $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

  if (mysqli_query($conn, $sql)) {
    header('Location: index_home.php');
    exit();
  } else {
    echo 'Đăng ký thất bại: ' . mysqli_error($conn);
  }
}
?>
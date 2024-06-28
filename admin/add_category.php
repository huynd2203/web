<?php

    require_once '../config/config.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $category_name = $_POST['category_name'];
        // Thêm dữ liệu vào CSDL
        $sql = "INSERT INTO categories (Name) VALUES ('$category_name')";
        if (mysqli_query($conn, $sql)) {
            header("Location: quanlydanhmuc.php");
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }
    }

?>
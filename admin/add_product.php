<?php
    // Kết nối đến CSDL
    require_once '../config/config.php';

    // Lấy dữ liệu từ form
    $name = $_POST['name'];
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $price = (float) $price;
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];

    // Upload hình ảnh lên server
    // Tạo thư mục nếu chưa tồn tại
    if (!file_exists('uploads')) {
        mkdir('uploads', 0777, true);
    }

    // Lưu thông tin sản phẩm vào CSDL
    $query = "INSERT INTO products (Name, Description, Price, CategoryID, CreatedAt) VALUES ('$name', '$description', '$price', '$category_id', NOW())";
    mysqli_query($conn, $query);

    // Lấy ID của sản phẩm vừa thêm vào CSDL
    $product_id = mysqli_insert_id($conn);

    // Lưu ảnh sản phẩm vào thư mục và đường dẫn vào CSDL
    $target_dir = "../uploads/";
    $images = $_FILES['images'];
    foreach ($images['tmp_name'] as $key => $tmp_name) {
        $target_file = $target_dir . basename($images['name'][$key]);
        move_uploaded_file($tmp_name, $target_file);
        $image_path = '' . $target_file;
        $query = "INSERT INTO products_images (ProductID, ImageURL) VALUES ('$product_id', '$image_path')";
        mysqli_query($conn, $query);
    }

    // Chuyển hướng đến trang chi tiết sản phẩm vừa thêm
    header("Location: quanlysanpham.php");
    exit;
?>
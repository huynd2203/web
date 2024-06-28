<?php
require_once '../config/config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../PHPMailer-master/src/PHPMailer.php';
require_once '../PHPMailer-master/src/Exception.php';
require_once '../PHPMailer-master/src/SMTP.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Good Food</title>
    <link rel="stylesheet" href="../pages/assets/css/cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- <script src="../pages/assets/js/home_pages.js"></script> -->
</head>

<body>
    <header id="header">
        <div class="header-top-container">
            <div class="header-top">
                <div class="top-left">
                    <ul>
                        <li><a href="index_home.php">Chào mừng đến với cửa hàng đồ ăn trực tuyến</a></li>
                    </ul>
                </div>
                <div class="top-right">
                    <ul>
                        <li><a href=""><i class="fa-solid fa-location-dot"></i>Vị trí</a></li>
                        <li><a href="">|<i class="fa-solid fa-truck-fast"></i>Theo dõi đơn hàng</a></li>
                        <li><a href="">|<i class="fa-solid fa-bag-shopping"></i>Cửa hàng</a></li>
                        <?php
                        session_start();
                        require_once "../config/config.php";
                        if(isset($_SESSION['username'])){?>
                        <li><a href="my_account.php">|<i class="fa-solid fa-user"></i>Tài khoản</a>
                            <?php } else{?>
                        <li><a href="login_register.php">|<i class="fa-solid fa-user"></i>Tài khoản</a>
                            <?php }?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="header-main-container">
            <div class="header-main">
                <div class="main-logo">
                    <div class="circle"></div>
                    <h1>GoodFood</h1>
                    <i class="fa-solid fa-bars"></i>
                </div>
                <div class="main-search">
                    <form action="category_details.php" method="GET">
                        <input id="input-header" type="text" placeholder="Tìm kiếm sách tại đây...">

                        <?php 

// Truy vấn để lấy danh sách các danh mục
$sql = "SELECT ID, Name FROM categories";
$result = $conn->query($sql);

// Kiểm tra và hiển thị danh mục trong thẻ select
if ($result->num_rows > 0) {
    echo '<select name="categories" id="categories">';
    echo '<option value="">Tất cả danh mục</option>';

    while ($row = $result->fetch_assoc()) {
        $categoryID = $row["ID"];
        $categoryName = $row["Name"];
        echo '<option value="' . $categoryID . '">' . $categoryName . '</option>';
    }

    echo '</select>';
} else {
    echo "Không có danh mục nào.";
}

?>


                        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
                <div class="main-contact">
                    <form method="post" action="compare.php">
                        <button type="submit" name="compare" class="tooltip" data-tooltip="So sánh"
                            style="border:none; background-color: transparent; cursor: pointer;"><i
                                class="fa-solid fa-code-compare"></i></button>
                    </form>
                    <div class="triangle"></div>
                    <form method="post" action="wishlist.php">
                        <button type="submit" name="wishlist" class="tooltip" data-tooltip="Yêu thích"
                            style="border:none; background-color: transparent; cursor: pointer;"><i
                                class="fa-regular fa-heart"></i></button>
                    </form> <?php
                        if(isset($_SESSION['username'])){?>
                    <button id="dropdown-account-active" onclick="showMenuAccount()"><i
                            class="fa-regular fa-user"></i></button>
                    <div id="dropdown-account" class="dropdown-account">
                        <a class="dropdown-account-a" href="my_account.php">Bảng điều khiển</a>
                        <a class="dropdown-account-a" href="">Đơn hàng</a>
                        <a class="dropdown-account-a" href="">Tải về</a>
                        <a class="dropdown-account-a" href="">Địa chỉ</a>
                        <a class="dropdown-account-a" href="">Thanh toán</a>
                        <a class="dropdown-account-a" href="">Hồ sơ cá nhân</a>
                        <a class="dropdown-account-a" href="logout.php">Đăng xuất</a>
                    </div>
                    <?php } else{?>
                    <a href="login_register.php" class="tooltip" data-tooltip="My Account"><i
                            class="fa-regular fa-user"></i></a>
                    <?php }?>

                    <div class="main-contact-cart">
                        <a href="../pages/cart.php" class="tooltip-cart" data-tooltip="Cart"><i
                                class="fa-solid fa-bag-shopping"></i></a>

                        <div class="quantity">
                            <p>0</p>
                        </div>

                        <p>0đ</p>
                    </div>

                </div>



            </div>
        </div>
        <div class="header-bottom-2">
            <div class="h-b-container">
                <ul>
                    <li><a href="index_home.php">Trang chủ<i class="fa-solid fa-chevron-down"></i></a></li>
                    <li><a href="category_details.php?categories=37">Mì ý<i class="fa-solid fa-chevron-down"></i></a>
                    </li>
                    <li><a href="category_details.php?categories=38">Pizza<i class="fa-solid fa-chevron-down"></i></a>
                    </li>
                    <li><a href="category_details.php?categories=39">Món gà<i class="fa-solid fa-chevron-down"></i></a>
                    </li>
                    <li><a href="category_details.php?categories=41">Ăn vặt<i class="fa-solid fa-chevron-down"></i></a>
                    </li>
                    <li><a href="category_details.php?categories=40">Trà sữa<i class="fa-solid fa-chevron-down"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        </div>

    </header>

    <main>

        <section id="check-process">

            <?php

if (isset($_POST['checkout'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $note = $_POST['note'];

    // Kiểm tra người dùng đã đăng nhập hay chưa
    if (!isset($_SESSION['username'])) {
        // Xử lý khi người dùng chưa đăng nhập
        header("login_register.php");
        exit();
    }

    $username = $_SESSION['username'];

    // Tìm kiếm ID dựa trên tên người dùng
    $query = "SELECT ID FROM users WHERE Username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $userID = $row['ID'];

        // Lưu đơn hàng vào bảng đơn hàng
        $total_price = 0;
        foreach ($_SESSION['cart'] as $item) {
            $subtotal = $item['product_price'] * $item['quantity'];
            $total_price += $subtotal;
        }
        $total_price1 = number_format($total_price  + 50000, 0, '.', ',') . ' đ';
        $status = 'Chưa thanh toán'; // Trạng thái mặc định là chưa thanh toán
        // Lấy thời gian hiện tại
        $currentDateTime = date('Y-m-d H:i:s');
        $total_price_final = $total_price + 50000;

        $sql = "INSERT INTO orders (CustomerName, Address, Phone, Email, TotalPrice, Status, UserID, OrderDate)
                VALUES ('$fname $lname', '$address', '$phone', '$email', $total_price_final, 'Pending', '$userID', '$currentDateTime')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            // Lấy ID đơn hàng vừa tạo
            $order_id = mysqli_insert_id($conn);


            // Lưu chi tiết đơn hàng vào bảng order_items
            foreach ($_SESSION['cart'] as $item) {
                $productID = $item['product_id'];
                $productName = $item['product_Name'];
                $productPrice = $item['product_price'];
                $quantity = $item['quantity'];
        
                $sql = "INSERT INTO order_items (OrderID, ProductID, ProductName, ProductPrice, Quantity)
                        VALUES ('$order_id', '$productID', '$productName', '$productPrice', '$quantity')";
        
                $result = mysqli_query($conn, $sql);
        
                // Check for errors in each insert statement
                if (!$result) {
                    echo "Error inserting order item: " . mysqli_error($conn);
                    break; // Exit the loop on error
                }
            }

            // // Xóa giỏ hàng sau khi đã đặt hàng
            // unset($_SESSION['cart']);

            // Gửi email thông báo đơn hàng cho khách hàng
            $mail = new PHPMailer(true);
            try {
                // Cấu hình server
                $mail->SMTPDebug = 0; // Bật chế độ debug
                $mail->isSMTP(); // Sử dụng SMTP
                $mail->Host = 'smtp.gmail.com'; // Địa chỉ SMTP server
                $mail->SMTPAuth = true; // Bật chế độ xác thực SMTP
                $mail->Username = 'huynd2203@gmail.com'; // Tên đăng nhập SMTP
                $mail->Password = 'meib qwxu wvji wpjd'; // Mật khẩu đăng nhập SMTP
                $mail->SMTPSecure = 'tls'; // Giao thức bảo mật
                $mail->Port = 587; // Cổng SMTP

                // Cấu hình email
                $mail->CharSet = 'UTF-8';
                $mail->setFrom('huynd2203@gmail.com', 'Good Food'); // Địa chỉ email và tên người gửi
                $mail->addAddress($email, $fname . ' ' . $lname); // Địa chỉ email và tên người nhận
                $mail->isHTML(true); // Gửi email dạng HTML
                $mail->Subject = 'Xác nhận đơn hàng từ Good Food'; // Tiêu đề email

                // Hàm sinh mã đơn hàng
                function generateOrderCode($order_id) {
                    // Lấy thời gian hiện tại
                    $current_time = date('YmdHis');

                    // Chuỗi ngẫu nhiên
                    $random_chars = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 4); // Lấy 4 chữ cái ngẫu nhiên

                    // Kết hợp thời gian và chuỗi ngẫu nhiên
                    $order_code =  $random_chars . $current_time . $order_id;

                    // Đảm bảo ký tự đầu tiên là chữ cái in hoa
                    $order_code = strtoupper(substr($order_code, 0, 1)) . substr($order_code, 1);

                    return $order_code;
                }

                // Sử dụng hàm để sinh mã đơn hàng
                $order_code = generateOrderCode($order_id);

                // Nội dung email
                $mail->Body = "Chào $fname $lname,<br><br>
                Cảm ơn bạn đã đặt hàng từ Good Food.<br>
                Đơn hàng của bạn có mã: $order_code.<br>
                <br>
                <h2>Chi tiết đơn hàng:</h2>
                <table style='border-collapse: collapse; width: 100%;'>
                    <thead>
                        <tr>
                            <th style='border: 1px solid #ddd; padding: 8px;'>Tên sản phẩm</th>
                            <th style='border: 1px solid #ddd; padding: 8px;'>Giá</th>
                            <th style='border: 1px solid #ddd; padding: 8px;'>Số lượng</th>
                        </tr>
                    </thead>
                    <tbody>";
                        foreach ($_SESSION['cart'] as $item) {
                            $productName = $item['product_Name'];
                            $productPrice = $item['product_price'];
                            $quantity = $item['quantity'];

                            // Thêm thông tin của từng sản phẩm vào bảng
                            $mail->Body .= "<tr>
                                                <td style='border: 1px solid #ddd; padding: 8px;'>$productName</td>
                                                <td style='border: 1px solid #ddd; padding: 8px;'>" . number_format($productPrice, 0, '.', ',') . "đ</td>
                                                <td style='border: 1px solid #ddd; padding: 8px;'>$quantity</td>
                                            </tr>";
                        }

                        $mail->Body .= "</tbody>
                                        </table>
                                        <p style='margin-top: 20px;'>Phí vận chuyển: 50,000 đ</p>
                                    <br>
                                    Tổng số tiền: $total_price1.<br>
                                    Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất để xác nhận và giao hàng.<br><br>
                                    Trân trọng,<br>
                                    Good Food Team";

                        // Xóa giỏ hàng sau khi đã đặt hàng
                        unset($_SESSION['cart']);



            // Gửi email
            if ($mail->send()) {
            echo '<div class="c-p-container">';
                echo '<i class="fa-solid fa-circle-check"></i>';
                echo '<h1>Đặt hàng thành công</h1>';
                echo '<h2>Vui lòng kiểm tra email của bạn để xem thông tin chi tiết đơn hàng.</h2>';
                echo '<a href="index_home.php">Tiếp tục đặt món ăn</a>';
                echo '</div>';
            } else {
            // Xử lý khi gửi email thất bại
            echo 'Đã xảy ra lỗi trong quá trình gửi email.';
            }
            } catch (Exception $e) {
            // Xử lý khi gặp lỗi trong quá trình gửi email
            echo 'Đã xảy ra lỗi trong quá trình gửi email: ' . $mail->ErrorInfo;
            }
            } else {
            // Xử lý khi không thể lưu đơn hàng vào cơ sở dữ liệu
            echo 'Đã xảy ra lỗi khi lưu đơn hàng.';
            }
            } else {
            // Xử lý khi không tìm thấy tên người dùng tương ứng
            echo 'Không tìm thấy tên người dùng.';
            }


            }
            ?>

        </section>
    </main>


    <?php include_once "../pages/includes/footer_pages.php"?>
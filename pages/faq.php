<?php require_once "../config/config.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Good Food</title>
    <link rel="stylesheet" href="../pages/assets/css/product_detail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="../pages/assets/js/home_pages.js"></script>
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
                        <input id="input-header" type="text" placeholder="Tìm kiếm món ăn tại đây...">

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

                        <?php
    // Kiểm tra xem 'cart' đã tồn tại trong $_SESSION hay chưa
    $totalQuantity = 0;
    if (isset($_SESSION['cart'])) {
        $totalQuantity = array_sum(array_column($_SESSION['cart'], 'quantity'));
    }
    ?>

                        <div class="quantity">
                            <p><?php echo $totalQuantity; ?></p>
                        </div>

                        <?php
    $totalPrice = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $product_price = floatval($item['product_price']);
            $quantity = intval($item['quantity']);
            $subtotal = $product_price * $quantity;
            $totalPrice += $subtotal;
        }
    }
    ?>
                        <p><?php echo number_format($totalPrice, 0, '.', ',') . 'đ'; ?></p>
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

        <section id="faq">
            <div class="f-container">
                <div class="f-t-container">
                    <a href="">Trang chủ</a>
                    <i class="fa-solid fa-chevron-right"></i>
                    <a href="">FAQ</a>
                </div>
                <div class="faq-title-main">
                    <h1>Các câu hỏi thường gặp</h1>
                    <p>Thỏa thuận này được sửa đổi lần cuối vào ngày 18 tháng 2 năm 2016</p>
                </div>
                <div class="f-shipping">
                    <h3>Thông tin vận chuyển</h3>
                </div>
                <div class="f-question">
                    <div class="f-q-column">
                        <h4>Phương thức vận chuyển nào có sẵn?</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sapien lorem, consectetur
                            et turpis id, blandit interdum metus. Morbi sed ligula id elit mollis efficitur ut nec
                            ligula. Proin erat magna, pellentesque at elementum at, eleifend a tortor.</p>
                        <h4>Làm cách nào để theo dõi đơn hàng của tôi?</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sapien lorem, consectetur
                            et turpis id, blandit interdum metus. Morbi sed ligula id elit mollis efficitur ut nec
                            ligula. Proin erat magna, pellentesque at elementum at, eleifend a tortor.</p>
                    </div>
                    <div class="f-q-column">
                        <h4>Mất bao lâu để nhận được gói hàng của tôi?</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sapien lorem, consectetur
                            et turpis id, blandit interdum metus. Morbi sed ligula id elit mollis efficitur ut nec
                            ligula. Proin erat magna, pellentesque at elementum at, eleifend a tortor.</p>
                        <h4>Tôi có cần một tài khoản để đặt hàng không?</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sapien lorem, consectetur
                            et turpis id, blandit interdum metus. Morbi sed ligula id elit mollis efficitur ut nec
                            ligula. Proin erat magna, pellentesque at elementum at, eleifend a tortor.</p>
                    </div>
                </div>
                <div class="faq-title-main1">
                    <h1>Các câu hỏi thường gặp thứ hai</h1>
                </div>
                <div class="f-second">
                    <div class="f-s-box">
                        <h3>Phương thức vận chuyển nào có sẵn?</h3>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="f-s-box">
                        <h3>Mất bao lâu để nhận được gói hàng của tôi?</h3>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="f-s-box">
                        <h3>Làm cách nào để theo dõi đơn hàng của tôi?</h3>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="f-s-box">
                        <h3>Tôi phải làm thế nào để đặt hàng?</h3>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="f-s-box">
                        <h3>Tôi nên liên hệ như thế nào nếu tôi có bất kỳ câu hỏi nào?</h3>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="f-s-box">
                        <h3>Tôi có cần một tài khoản để đặt hàng không?</h3>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                </div>
            </div>

        </section>



    </main>


    <?php include_once "../pages/includes/footer_pages.php"?>
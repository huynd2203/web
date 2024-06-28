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
        <section id="ab">
            <div class="ab-title">
                <h1>Giới thiệu</h1>
                <p>Niềm đam mê có thể là sự quan tâm thân thiện hoặc háo hức hoặc ngưỡng mộ đối với một đề xuất, nguyên
                    nhân, khám phá hoặc hoạt động hoặc tình yêu đối với cảm giác phấn khích bất thường.</p>
            </div>
        </section>
        <section id="feat">
            <div class="ft-container">
                <div class="ft-card">
                    <img src="../pages/images/ab2.jpg" alt="">
                    <h3>Chúng ta thực sự làm gì?</h3>
                    <p>Donec libero dolor, tincidunt id laoreet vitae,
                        ullamcorper eu tortor. Maecenas pellentesque,
                        dui vitae iaculis mattis, tortor nisi faucibus magna,
                        vitae ultrices lacus purus vitae metus.</p>
                </div>
                <div class="ft-card">
                    <img src="../pages/images/ab3.jpg" alt="">
                    <h3>Tầm nhìn của chúng tôi</h3>
                    <p>Donec libero dolor, tincidunt id laoreet vitae,
                        ullamcorper eu tortor. Maecenas pellentesque,
                        dui vitae iaculis mattis, tortor nisi faucibus magna,
                        vitae ultrices lacus purus vitae metus.</p>
                </div>
                <div class="ft-card">
                    <img src="../pages/images/ab4.jpg" alt="">
                    <h3>Lịch sử bắt đầu</h3>
                    <p>Donec libero dolor, tincidunt id laoreet vitae,
                        ullamcorper eu tortor. Maecenas pellentesque,
                        dui vitae iaculis mattis, tortor nisi faucibus magna,
                        vitae ultrices lacus purus vitae metus.</p>
                </div>
            </div>
        </section>

        <section id="hiring">
            <div class="hr-container">
                <div class="hr-card">
                    <img src="../pages/images/ab5.jpg" alt="">
                    <h3>Thomas Snow</h3>
                    <p>CEO/Founder</p>
                </div>
                <div class="hr-card">
                    <img src="../pages/images/ab6.jpg" alt="">
                    <h3>Anna Baranov</h3>
                    <p>Client Care</p>
                </div>
                <div class="hr-card">
                    <img src="../pages/images/ab7.jpg" alt="">
                    <h3>Andre Kowalsy</h3>
                    <p>Support Boss</p>
                </div>
                <div class="hr-card">
                    <img src="../pages/images/ab8.jpg" alt="">
                    <h3>Pamela Doe</h3>
                    <p>Delivery Driver</p>
                </div>
                <div class="hr-card">
                    <img src="../pages/images/ab9.jpg" alt="">
                    <h3>Susan McCain</h3>
                    <p>Packaging Girl</p>
                </div>
                <div class="hr-card">
                    <img src="../pages/images/ab10.png" alt="">
                    <a href="">Xem chi tiết</a>
                </div>
            </div>
        </section>

        <section id="details">
            <div class="dt-container">
                <div class="dt-column">
                    <h3>Chúng ta thực sự làm gì?</h3>
                    <p>Donec libero dolor, tincidunt id laoreet vitae, ullamcorper eu tra tấn. Maecenas pellentesque,
                        dui vitae iaculis mattis, tortor nisi faucibus magna, vitae ultrices lacus purus vitae metus. Ut
                        nec odio facilisis, ultricies nunc eget, fringilla orci.</p>
                    <h3>Lịch sử của Công ty</h3>
                    <p>Mauris rhoncus aliquet purus, a ornare nisi euismod in. Interdum et malesuada fames ac ante ipsum
                        primis in faucibus. Etiam imperdiet eu metus vel ornare. Nullam in risus vel orci feugiat
                        vestibulum. In sed aliquam mi. Nullam condimentum sollicitudin dui.</p>
                </div>
                <div class="dt-column">
                    <h3>Tầm nhìn của chúng tôi</h3>
                    <p>Donec libero dolor, tincidunt id laoreet vitae, ullamcorper eu tra tấn. Maecenas pellentesque,
                        dui vitae iaculis mattis, tortor nisi faucibus magna, vitae ultrices lacus purus vitae metus. Ut
                        nec odio facilisis, ultricies nunc eget, fringilla orci.</p>
                    <h3>Hợp tác với chúng tôi!</h3>
                    <p>Donec libero dolor, tincidunt id laoreet vitae, ullamcorper eu tortor. Maecenas pellentesque, dui
                        vitae iaculis mattis, tortor nisi faucibus magna, vitae ultrices lacus purus vitae metus. Ut nec
                        odio facilisis, ultricies nunc eget, fringilla orci.</p>
                </div>
                <div class="dt-column">
                    <h3>Chúng tôi có thể giúp gì cho bạn ?</h3>
                    <a href=""><i class="fa-solid fa-minus"></i>Hỗ trợ 24/7</a>
                    <p>Vestibulum velit nibh, egestas vel faucibus vitae, feugiat sollicitudin urna. Praesent iaculis id
                        ipsum sit amet pretium. Aliquam tristique sapien nec enim euismod, scelerisque facilisis arcu
                        consectetur.</p>
                    <a href=""><i class="fa-solid fa-plus"></i>Chất lượng tốt nhất</a>
                    <a href=""><i class="fa-solid fa-plus"></i>Chăm sóc khách hàng</a>
                    <a href=""><i class="fa-solid fa-plus"></i>Hơn 200 khách hàng hài lòng</a>
                </div>
            </div>
        </section>





    </main>


    <?php include_once "../pages/includes/footer_pages.php"?>
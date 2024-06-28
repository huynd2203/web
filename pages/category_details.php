<!-- <?php
require_once "../config/config.php";
?> -->

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
                    <a href="index_home.php">
                        <div class="circle"></div>
                        <h1 >GoodFood</h1>
                        <i class="fa-solid fa-bars"></i>
                    </a>
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

        <section id="product-details">

            <div class="p-d-container">

                <?php
$categoryID = $_GET['categories']; // Lấy giá trị categoryID từ tham số trên URL

// Truy vấn để lấy tên danh mục
$sqlCategory = "SELECT Name FROM categories WHERE ID = $categoryID";
$resultCategory = $conn->query($sqlCategory);

// Kiểm tra xem có kết quả từ truy vấn hay không
if ($resultCategory->num_rows > 0) {
    $rowCategory = $resultCategory->fetch_assoc();
    $categoryName = $rowCategory['Name'];

    // Truy vấn để lấy tổng số sách trong danh mục
    $sqlTotalproducts = "SELECT COUNT(*) AS totalproducts
                      FROM products
                      WHERE CategoryID = $categoryID";

    $resultTotalproducts = $conn->query($sqlTotalproducts);

    // Kiểm tra xem có kết quả từ truy vấn hay không
    if ($resultTotalproducts->num_rows > 0) {
        $rowTotalproducts = $resultTotalproducts->fetch_assoc();
        $totalproducts = $rowTotalproducts['totalproducts'];
    }
}

// Hiển thị tên danh mục và tổng số sản phẩm
if ($categoryName) {
?>

                <div class="p-d-c-title">
                    <a href="index_home.php">Trang chủ</a>
                    <h3><i class="fa-solid fa-angle-right"></i></h3>
                    <span><a href="">
                            <?php echo $categoryName; ?>
                        </a></span>
                    <h3><i class="fa-solid fa-angle-right"></i></h3>
                    <h3>
                        Tìm kiếm kết quả cho "
                        <?php echo $categoryName; ?>"
                    </h3>
                </div>
                <div class="p-d-c-main">
                    <div class="p-c-d-m-sidebar">
                        <ul class="p-d-c-m-s-showcate">
                            <li><a href="">Tất cả danh mục <i class="fa-solid fa-angle-right"></i></a></li>
                            <?php
} else {
}
?>
                        </ul>
                        <!-- <div class="p-d-c-m-s-banner">
                            <img src="../pages/images/banner.jpg" alt="">
                        </div> -->
                        <div class="p-d-c-m-s-last-pro">
                            <div class="p-d-c-m-s-last-pro-title">
                                <h2>Sản phẩm mới nhất</h2>
                                <div class="p-d-c-m-s-last-pro-title-line"></div>
                            </div>

                            <?php
      // Truy vấn để lấy 3 sản phẩm được thêm mới gần nhất
      $sqlNewProducts = "SELECT products.Name, products.Price, products_images.ImageURL
                         FROM products
                         JOIN products_images ON products.ID = products_images.productID
                         ORDER BY products.CreatedAt DESC
                         LIMIT 6";
      
      
      $resultNewProducts = $conn->query($sqlNewProducts);
      
      // Kiểm tra xem có kết quả từ truy vấn hay không
      if ($resultNewProducts->num_rows > 0) {
          while ($rowNewProduct = $resultNewProducts->fetch_assoc()) {
              $imageURL = $rowNewProduct['ImageURL'];
              $title = $rowNewProduct['Name'];
              $price = $rowNewProduct['Price'];
              ?>

                            <div class="p-d-c-m-s-last-pro-details">
                                <div class="p-d-c-m-s-last-pro-details-img">
                                    <img src="<?php echo $imageURL; ?>" alt="">
                                </div>
                                <div class="p-d-c-m-s-last-pro-content">
                                    <h4>
                                        <?php echo $title; ?>
                                    </h4>
                                    <div class="p-d-c-m-s-last-pro-content-rating">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <h5>
                                        <?php echo number_format($price, 0, '.', ',') . 'đ'; ?>
                                    </h5>
                                </div>
                            </div>

                            <?php } ?>
                            <?php } ?>

                        </div>
                    </div>
                    <div class="p-c-d-pro-container">
                        <div class="p-c-d-p-box-title">
                            <i id="cell-active" class="fa-solid fa-table-cells"></i>
                            <i class="fa-solid fa-bars"></i>
                            <i class="fa-solid fa-list"></i>
                        </div>
                        <div class="p-c-d-p-all-item">

                            <?php
        
        // Kiểm tra xem tham số "products" có được truyền vào không
        if (isset($_GET['categories'])) {
            $categoryID = $_GET['categories'];
        
            // Truy vấn để lấy thông tin về danh mục
            $categoryQuery = "SELECT Name FROM categories WHERE ID = " . $categoryID;
            $categoryResult = $conn->query($categoryQuery);
        
            if ($categoryResult->num_rows > 0) {
                $categoryRow = $categoryResult->fetch_assoc();
                $categoryName = $categoryRow['Name'];
                
                // Truy vấn SQL để lấy sản phẩm từ danh mục
                $sql = "SELECT categories.Name AS categoryName, products.ID, products.Name AS phoneName, products.Price, products.Discount, products_images.ImageURL
                        FROM categories
                        JOIN products ON categories.ID = products.CategoryID
                        JOIN products_images ON products.ID = products_images.productID
                        WHERE categories.ID = " . $categoryID;
        
                $result = $conn->query($sql);
        
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $discountedPrice = $row["Price"] - $row["Discount"]; // Tính giá sau giảm
                $isDiscounted = $row["Discount"] > 0; // Kiểm tra sản phẩm có giảm giá hay không
                        ?>
                            <div class="p-c-d-m-p-cards">
                                <h3>
                                    <?php echo $row['categoryName']; ?>
                                </h3>
                                <p>
                                    <?php echo $row['phoneName']; ?>
                                </p>
                                <img style="object-fit: cover;" src="<?php echo $row['ImageURL']; ?>" alt="">
                                <div class="details-money-shop">
                                    <!-- <?php if ($isDiscounted) { ?>
                                    <div class="d-m-shop-discount">
                                        <h4 class="discounted-price">
                                            <?php echo number_format($discountedPrice, 0, '.', ',') . ' đ'; ?>
                                        </h4>
                                        <span class="original-price">
                                            <?php echo number_format($row["Price"], 0, '.', ',') . ' đ'; ?>
                                        </span>
                                    </div>
                                    <?php } else { ?>
                                    <span class="original-price1">
                                        <?php echo number_format($row["Price"], 0, '.', ',') . ' đ'; ?>

                                    </span>
                                    <?php } ?> -->
                                    <span class="original-price1">

                                        <?php echo number_format($row["Price"], 0, '.', ',') . ' đ'; ?>
                                    </span>


                                    <a href="product_detail.php?ProductID=<?php echo $row['ID']; ?>"><i
                                            class="fa-solid fa-arrow-right"></i></a>

                                </div>
                                <div class="details-whislits">
                                    <div class="d-w-i">
                                        <div class="d-t-w-c">
                                            <!-- Trong wishlist.php -->
                                            <form method="post" action="wishlist.php">
                                                <button class="wishlist" type="submit" name="wishlist"
                                                    value="<?php echo $row['ID']; ?>"><i
                                                        class="fa-regular fa-heart"></i>Wishlist</button>
                                                <!-- ... -->
                                            </form>

                                            <!-- Trong compare.php -->
                                            <form method="POST" action="compare.php">
                                                <button class="compare" type="submit" name="compare"
                                                    value="<?php echo $row['ID']; ?>"><i
                                                        class="fa-solid fa-code-compare"></i>Compare</button>
                                                <!-- ... -->
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                  }
              } else {
                  echo "<p>Không có sản phẩm trong danh mục này.</p>";
              }
          } else {
              echo "<p>Danh mục không tồn tại.</p>";
          }
      } else {
          echo "<p>Không tìm thấy danh mục.</p>";
      }
      ?>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include_once "../pages/includes/footer_pages.php"?>
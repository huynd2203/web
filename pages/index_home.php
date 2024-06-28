<?php require_once "../config/config.php" ?>

<?php include_once "../pages/includes/header_pages.php"?>

<main>
    <section id="slider">
        <div class="light-dark">
            <button id="light-button" class="active">Light</button>
            <button id="dark-button">Dark</button>
        </div>
        <div class="slider-container">
            <div class="slider-content">
                <div class="content-left">
                    <ul id="content-left-ul">


                        <?php 
                            $sql = "SELECT * from categories";

                            $result = $conn->query($sql);
                            
                            if($result -> num_rows > 0) {
                                while($row = $result -> fetch_assoc()) {
                                    echo "<li><a href='category_details.php?categories=".$row['ID']."'>".$row["Name"]."<i class='fa-solid fa-angle-right'></i></a></li>";
                                }
                            }
                        ?>

                    </ul>
                </div>
                <div class="content-right">
                    <div class="slider-container">
                        <div class="content-right-slider">
                            <div class="slider-card">
                                <div class="slider-text">
                                    <div class="slider-text-details">
                                        <h1>Pizza Phô Mai Cao Cấp</h1>
                                        <h3>Với 3 lớp phô mai Mozzarella vàng óng quyến rũ</h3>
                                        <h4>33.000đ</h4>
                                        <a href="../pages/product_detail.php?ProductID=55">Bắt đầu lựa chọn</a>
                                    </div>
                                </div>
                                <div class="slider-img" data-aos="fade-left" data-aos-durantion="1000">
                                    <img src="../pages/images/piza.png" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="content-right-slider">
                            <div class="slider-card">
                                <div class="slider-text">
                                    <div class="slider-text-details">
                                        <h1>Mì Ý Hải Sản Sốt Phố</h1>
                                        <h3>Hòa quyện hương vị biển sâu và sự tinh tế của ẩm thực Ý</h3>
                                        <h4>199.000đ</h4>
                                        <a href="../pages/product_detail.php?ProductID=46">Bắt đầu lựa chọn</a>
                                    </div>
                                </div>
                                <div class="slider-img">
                                    <img src="../pages/images/mi-y-2.webp" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="content-right-slider">
                            <div class="slider-card">
                                <div class="slider-text">
                                    <div class="slider-text-details">
                                        <h1>Gà Rán Tenders Vị Nguyên Bản</h1>
                                        <h3>Hương vị tuyệt vời của gà rán được tái hiện một cách độc đáo</h3>
                                        <h4>28.000đ</h4>
                                        <a href="../pages/product_detail.php?ProductID=25">Bắt đầu lựa chọn</a>
                                    </div>
                                </div>
                                <div class="slider-img">
                                    <img src="../pages/images/ga-ran.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="slider-dots">
                        <span class="slider-dot active"></span>
                        <span class="slider-dot"></span>
                        <span class="slider-dot"></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="popular">
        <div class="popular-container">
            <div class="p-card">
                <div class="p-card-img">
                    <img src="../pages/images/mi-y-2.webp" alt="">
                </div>
                <div class="p-card-title">
                    <h2>MÌ Ý TUYỆT VỜI</h2>
                    <a href="category_details.php?categories=37">Xem ngay<i class="fa-solid fa-angle-right"></i></a>
                </div>
            </div>

            <div class="p-card">
                <div class="p-card-img">
                    <img src="../pages/images/piza-2.png" alt="">
                </div>
                <div class="p-card-title">
                    <h2>PIZZA NÓNG HỔI</h2>
                    <a href="category_details.php?categories=38">Xem ngay<i class="fa-solid fa-angle-right"></i></a>
                </div>
            </div>

            <div class="p-card">
                <div class="p-card-img">
                    <img src="../pages/images/ga-ran.png" alt="">
                </div>
                <div class="p-card-title">
                    <h2>MÓN GÀ NGON MIỆNG</h2>
                    <a href="category_details.php?categories=39">Xem ngay<i class="fa-solid fa-angle-right"></i></a>
                </div>
            </div>
            <div id="p-card-none" class="p-card">
                <div class="p-card-last-child">
                    <div class="p-card-img">
                        <img src="../pages/images/banh-bach-tuot.webp" alt="">
                    </div>
                    <div class="p-card-title">
                        <h2>ĂN VẶT ĐƯỜNG PHỐ</h2>
                        <a href="category_details.php?categories=41">Xem ngay<i class="fa-solid fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="features">
        <div class="features-container">
            <div class="features-left">
                <h2 style="text-align: center;">Ưu đãi đặc biệt</h2>
                <img src="../pages/images/mi-y-1.png" alt="">
                <p>Mì Ý Sốt Bò Bằm + 1 miếng gà rán + Khoai tây vừa + Nước ngọt
                </p>
                <h3>88.000đ</h3>
            </div>
            <div class="features-right">
                <div class="features-right-title">
                    <a class="tab active" data-category="1" href="">Món ăn hot<div class="tab-circle"></div>
                    </a>

                </div>
                <div id="products-container" class="features-right-product">

                    <?php 
$sql = "SELECT categories.Name AS categoryName, products.ID, products.Name AS phoneName, products.Price, products_images.ImageURL
FROM categories
JOIN products ON categories.ID = products.CategoryID
JOIN products_images ON products.ID = products_images.ProductID
ORDER BY RAND()
LIMIT 16
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
                    <div class="features-right-product-details category-1 active">
                        <h3><?php echo $row['categoryName']; ?></h3>
                        <p><?php echo $row['phoneName']; ?></p>
                        <img src="<?php echo $row['ImageURL']; ?>" alt="">
                        <div class="details-money-shop">
                            <h3><?php echo number_format($row["Price"], 0, '.', ',') . ' đ'; ?>
                            </h3>
                            <a href="product_detail.php?ProductID=<?php echo $row['ID']; ?>"><i
                                    class="fa-solid fa-arrow-right"></i></a>

                        </div>
                        <div class="details-whislits">
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
                    <?php
    }
}
?>



                    <?php
$sql = "SELECT categories.Name AS categoryName, products.ID, products.Name AS phoneName, products.Price, products.Discount, products_images.ImageURL
        FROM categories
        JOIN products ON categories.ID = products.CategoryID
        JOIN products_images ON products.ID = products_images.ProductID 
        AND products.Discount > 0
        LIMIT 8";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $discountedPrice = $row["Price"] - $row["Discount"]; // Tính giá sau giảm
        ?>
                    <div class="features-right-product-details category-2">
                        <h3><?php echo $row['categoryName']; ?></h3>
                        <p><?php echo $row['phoneName']; ?></p>
                        <img src="<?php echo $row['ImageURL']; ?>" alt="">
                        <div class="details-money-shop">
                            <div class="d-m-shop-discount">
                                <h4 class="discounted-price">
                                    <?php echo number_format($discountedPrice, 0, '.', ',') . ' đ'; ?></h4>
                                <span
                                    class="original-price"><?php echo number_format($row["Price"], 0, '.', ',') . ' đ'; ?></span>
                            </div>
                            <a href="product_detail.php?ProductID=<?php echo $row['ID']; ?>"><i
                                    class="fa-solid fa-arrow-right"></i></a>
                        </div>
                        <div class="details-whislits">
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
                    <?php
    }
}
?>



                    <div class="features-right-product-details category-3">
                        <h3>Sức mạnh của hiện tại</h3>
                        <p>Sức mạnh của hiện tại” của Eckhart Tolle có tên gốc là “The power of now”</p>
                        <img src="../pages/images/7-thoi-quen-hieu-qua_1200x1200.png" alt="">
                        <div class="details-money-shop">
                            <h3>199.000đ</h3>
                            <a href=""><i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                        <div class="details-whislits">
                            <i class="fa-regular fa-heart"></i><a href="">Wishlist</a>
                            <i class="fa-solid fa-code-compare"></i><a href="">Compare</a>
                        </div>
                    </div>
                    <div class="features-right-product-details category-3">
                        <h3>Sức mạnh của hiện tại</h3>
                        <p>Sức mạnh của hiện tại” của Eckhart Tolle có tên gốc là “The power of now”</p>
                        <img src="../pages/images/7-thoi-quen-hieu-qua_1200x1200.png" alt="">
                        <div class="details-money-shop">
                            <h3>199.000đ</h3>
                            <a href=""><i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                        <div class="details-whislits">
                            <i class="fa-regular fa-heart"></i><a href="">Wishlist</a>
                            <i class="fa-solid fa-code-compare"></i><a href="">Compare</a>
                        </div>
                    </div>
                    <div class="features-right-product-details category-3">
                        <h3>Sức mạnh của hiện tại</h3>
                        <p>Sức mạnh của hiện tại” của Eckhart Tolle có tên gốc là “The power of now”</p>
                        <img src="../pages/images/7-thoi-quen-hieu-qua_1200x1200.png" alt="">
                        <div class="details-money-shop">
                            <h3>199.000đ</h3>
                            <a href=""><i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                        <div class="details-whislits">
                            <i class="fa-regular fa-heart"></i><a href="">Wishlist</a>
                            <i class="fa-solid fa-code-compare"></i><a href="">Compare</a>
                        </div>
                    </div>
                    <div class="features-right-product-details category-3">
                        <h3>Sức mạnh của hiện tại</h3>
                        <p>Sức mạnh của hiện tại” của Eckhart Tolle có tên gốc là “The power of now”</p>
                        <img src="../pages/images/7-thoi-quen-hieu-qua_1200x1200.png" alt="">
                        <div class="details-money-shop">
                            <h3>199.000đ</h3>
                            <a href=""><i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                        <div class="details-whislits">
                            <i class="fa-regular fa-heart"></i><a href="">Wishlist</a>
                            <i class="fa-solid fa-code-compare"></i><a href="">Compare</a>
                        </div>
                    </div>
                    <div class="features-right-product-details category-3">
                        <h3>Sức mạnh của hiện tại</h3>
                        <p>Sức mạnh của hiện tại” của Eckhart Tolle có tên gốc là “The power of now”</p>
                        <img src="../pages/images/7-thoi-quen-hieu-qua_1200x1200.png" alt="">
                        <div class="details-money-shop">
                            <h3>199.000đ</h3>
                            <a href=""><i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                        <div class="details-whislits">
                            <i class="fa-regular fa-heart"></i><a href="">Wishlist</a>
                            <i class="fa-solid fa-code-compare"></i><a href="">Compare</a>
                        </div>
                    </div>
                    <div class="features-right-product-details category-3">
                        <h3>Sức mạnh của hiện tại</h3>
                        <p>Sức mạnh của hiện tại” của Eckhart Tolle có tên gốc là “The power of now”</p>
                        <img src="../pages/images/7-thoi-quen-hieu-qua_1200x1200.png" alt="">
                        <div class="details-money-shop">
                            <h3>199.000đ</h3>
                            <a href=""><i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                        <div class="details-whislits">
                            <i class="fa-regular fa-heart"></i><a href="">Wishlist</a>
                            <i class="fa-solid fa-code-compare"></i><a href="">Compare</a>
                        </div>
                    </div>
                    <div class="features-right-product-details category-3">
                        <h3>Sức mạnh của hiện tại</h3>
                        <p>Sức mạnh của hiện tại” của Eckhart Tolle có tên gốc là “The power of now”</p>
                        <img src="../pages/images/7-thoi-quen-hieu-qua_1200x1200.png" alt="">
                        <div class="details-money-shop">
                            <h3>199.000đ</h3>
                            <a href=""><i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                        <div class="details-whislits">
                            <i class="fa-regular fa-heart"></i><a href="">Wishlist</a>
                            <i class="fa-solid fa-code-compare"></i><a href="">Compare</a>
                        </div>
                    </div>
                    <div class="features-right-product-details category-3">
                        <h3>Sức mạnh của hiện tại</h3>
                        <p>Sức mạnh của hiện tại” của Eckhart Tolle có tên gốc là “The power of now”</p>
                        <img src="../pages/images/7-thoi-quen-hieu-qua_1200x1200.png" alt="">
                        <div class="details-money-shop">
                            <h3>199.000đ</h3>
                            <a href=""><i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                        <div class="details-whislits">
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
        </div>
    </section>

    <section id="best-deals">
        <div class="best-deals-container">
            <div class="b-d-c-title">
                <ul>
                    <li><a id="best-deals-active" href="">Mì ý hot<div class="best-deals-circle"></div></a>
                    </li>
                    <li><a href="category_details.php?categories=38">Pizza</a></li>
                    <li><a href="category_details.php?categories=39">Món gà hot</a></li>
                    <li><a href="category_details.php?categories=41">Ăn vặt</a></li>
                    <li><a href="category_details.php?categories=40">Trà sữa</a></li>
                </ul>
            </div>
            <div class="b-d-c-main">
                <div class="b-d-c-m-box-left">

                    <?php
                        // Truy vấn SQL để lấy 4 sản phẩm best deals từ sản phẩm thứ 2 đến 5
                        $sql = "SELECT categories.Name AS categoryName, products.ID, products.Name AS phoneName, products.Price, products.Discount, products_images.ImageURL
        FROM categories
        JOIN products ON categories.ID = products.CategoryID
        JOIN products_images ON products.ID = products_images.ProductID 
        WHERE categories.Name = 'Mì Ý'
        ORDER BY products.Discount DESC
        LIMIT 4";



                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Lặp qua các sản phẩm best deals và hiển thị thông tin
                            while ($row = $result->fetch_assoc()) {
                                $discountedPrice = $row["Price"] - $row["Discount"];
                                ?>
                    <div class="b-d-c-m-box-left-card">
                        <h3><?php echo $row['categoryName']; ?></h3>
                        <h4><?php echo $row['phoneName']; ?></h4>
                        <div class="b-d-c-b-l-c-img">
                            <img src="<?php echo $row['ImageURL']; ?>" alt="">
                        </div>
                        <div class="b-d-c-b-l-c-price">
                            <div class="b-d-c-b-l-c-p-discount">
                                <h5 class="discounted-price">
                                    <?php echo number_format($row['Price'], 0, '.', ',') . 'đ'; ?></h5>
                            </div>
                            <a href="product_detail.php?ProductID=<?php echo $row['ID']; ?>"><i
                                    class="fa-solid fa-arrow-right"></i></a>
                        </div>
                        <div class="b-d-c-b-l-c-wishlist">
                            <div class="b-d-c-b-l-c-wishlist-all">
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
                    <?php
                            }
                        } else {
                            echo "Không có sản phẩm best deals.";
                        }
                    ?>

                </div>

                <div class="b-d-c-m-box-center">
                    <?php
                        // Truy vấn SQL để lấy 1 sản phẩm giảm giá nhiều nhất
                        $sql = "SELECT categories.Name AS categoryName, products.ID, products.Name AS phoneName, products.Price, products.Discount, products_images.ImageURL
                        FROM categories
                        JOIN products ON categories.ID = products.CategoryID
                        JOIN products_images ON products.ID = products_images.ProductID 
                        WHERE categories.Name = 'Mì Ý'
                        ORDER BY products.Discount DESC
                        LIMIT 2, 1";
                
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Lấy thông tin sản phẩm
                            $row = $result->fetch_assoc();
                            $discountedPrice = $row["Price"] - $row["Discount"];
                            ?>
                    <div class="b-d-c-m-box-left-card-center">
                        <h3><?php echo $row['categoryName']; ?></h3>
                        <h4><?php echo $row['phoneName']; ?></h4>
                        <div class="b-d-c-b-l-c-img-center">
                            <img src="<?php echo $row['ImageURL']; ?>" alt="">
                        </div>
                        <div class="b-d-c-b-l-c-price-center">
                            <div class="b-d-c-b-l-c-p-discount-center">
                                <h5 class="discounted-price">
                                    <?php echo number_format($row['Price'], 0, '.', ',') . 'đ'; ?></h5>
                            </div>
                            <a href="product_detail.php?ProductID=<?php echo $row['ID']; ?>"><i
                                    class="fa-solid fa-arrow-right"></i></a>
                        </div>
                        <div class="b-d-c-b-l-c-wishlist-center">
                            <div class="b-d-c-b-l-c-wishlist-all">
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
                    <?php
                        } else {
                            echo "Không có sản phẩm.";
                        }
                    ?>
                </div>

                <div class="b-d-c-m-box-left">

                    <?php
                        // Truy vấn SQL để lấy 4 sản phẩm best deals từ sản phẩm thứ 6 đến 9
                        $sql = "SELECT categories.Name AS categoryName, products.ID, products.Name AS phoneName, products.Price, products.Discount, products_images.ImageURL
                        FROM categories
                        JOIN products ON categories.ID = products.CategoryID
                        JOIN products_images ON products.ID = products_images.ProductID 
                        WHERE categories.Name = 'Mì Ý'
                        ORDER BY products.Discount DESC
                        LIMIT 4, 4";


                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Lặp qua các sản phẩm best deals và hiển thị thông tin
                            while ($row = $result->fetch_assoc()) {
                                $discountedPrice = $row["Price"] - $row["Discount"];
                                ?>
                    <div class="b-d-c-m-box-left-card">
                        <h3><?php echo $row['categoryName']; ?></h3>
                        <h4><?php echo $row['phoneName']; ?></h4>
                        <div class="b-d-c-b-l-c-img">
                            <img src="<?php echo $row['ImageURL']; ?>" alt="">
                        </div>
                        <div class="b-d-c-b-l-c-price">
                            <div class="b-d-c-b-l-c-p-discount">
                                <h5 class="discounted-price">
                                    <?php echo number_format($row['Price'], 0, '.', ',') . 'đ'; ?></h5>
                            </div>
                            <a href="product_detail.php?ProductID=<?php echo $row['ID']; ?>"><i
                                    class="fa-solid fa-arrow-right"></i></a>
                        </div>
                        <div class="b-d-c-b-l-c-wishlist">
                            <div class="b-d-c-b-l-c-wishlist-all">
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
                    <?php
                            }
                        } else {
                            echo "Không có sản phẩm best deals.";
                        }
                    ?>

                </div>

            </div>
        </div>
    </section>

    <section id="best-sellers">
        <div class="best-sellers-container">
            <div class="best-sellers-title">
                <div class="b-s-title-left">
                    <ul>
                        <li><a href="">Bán chạy nhất</a></li>
                    </ul>
                </div>
                <div class="b-s-title-right">
                    <ul>
                        <li><a id="b-s-title-right-active" href="">Top 20</a></li>
                        <li><a href="category_details.php?categories=22">Mì ý hot</a></li>
                        <li><a href="category_details.php?categories=25">Pizza hot</a></li>
                        <li><a href="category_details.php?categories=26">Gà rán hot</a></li>
                    </ul>
                </div>
            </div>
            <div class="best-sellers-products-container">
                <div class="best-sellers-product-all">
                    <div class="best-sellers-product-all-card">
                        <div class="best-sellers-product-card-details">

                            <?php
                            // Truy vấn SQL để lấy 20 sản phẩm ngẫu nhiên và sắp xếp ngẫu nhiên
                            $sql = "SELECT categories.Name AS categoryName, products.ID, products.Name AS phoneName, products.Price, products.Discount, products_images.ImageURL
                                    FROM categories
                                    JOIN products ON categories.ID = products.CategoryID
                                    JOIN products_images ON products.ID = products_images.ProductID
                                    ORDER BY RAND()
                                    LIMIT 8";

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $discountedPrice = $row["Price"] - $row["Discount"];
                                    ?>
                            <div class="best-sellers-product-card-details-main">
                                <div class="b-s-p-c-d-m-img">
                                    <img src="<?php echo $row['ImageURL']; ?>" alt="">
                                </div>
                                <div class="b-s-p-c-d-m-content">
                                    <a href=""><?php echo $row['categoryName']; ?></a>
                                    <p><?php echo $row['phoneName']; ?></p>
                                    <div class="b-s-p-c-d-m-content-money">
                                        <h3><?php echo number_format($discountedPrice, 0, '.', ',') . 'đ'; ?></h3>
                                        <a href="product_detail.php?ProductID=<?php echo $row['ID']; ?>"><i
                                                class="fa-solid fa-arrow-right"></i></a>
                                    </div>
                                    <div class="b-s-details-whislits">
                                        <i class="fa-regular fa-heart"></i><a href="">Wishlist</a>
                                        <i class="fa-solid fa-code-compare"></i><a href="">Compare</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                                }
                            } else {
                                echo "Không có sản phẩm.";
                            }
                        ?>

                        </div>

                        <div class="best-sellers-product-card-details">

                            <?php
                            // Truy vấn SQL để lấy 20 sản phẩm ngẫu nhiên và sắp xếp ngẫu nhiên
                            $sql = "SELECT categories.Name AS categoryName, products.ID, products.Name AS phoneName, products.Price, products.Discount, products_images.ImageURL
                                    FROM categories
                                    JOIN products ON categories.ID = products.CategoryID
                                    JOIN products_images ON products.ID = products_images.ProductID
                                    ORDER BY RAND()
                                    LIMIT 8";

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $discountedPrice = $row["Price"] - $row["Discount"];
                                    ?>
                            <div class="best-sellers-product-card-details-main">
                                <div class="b-s-p-c-d-m-img">
                                    <img src="<?php echo $row['ImageURL']; ?>" alt="">
                                </div>
                                <div class="b-s-p-c-d-m-content">
                                    <a href=""><?php echo $row['categoryName']; ?></a>
                                    <p><?php echo $row['phoneName']; ?></p>
                                    <div class="b-s-p-c-d-m-content-money">
                                        <h3><?php echo number_format($discountedPrice, 0, '.', ',') . 'đ'; ?></h3>
                                        <a href="product_detail.php?ProductID=<?php echo $row['ID']; ?>"><i
                                                class="fa-solid fa-arrow-right"></i></a>
                                    </div>
                                    <div class="b-s-details-whislits">
                                        <i class="fa-regular fa-heart"></i><a href="">Wishlist</a>
                                        <i class="fa-solid fa-code-compare"></i><a href="">Compare</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                                }
                            } else {
                                echo "Không có sản phẩm.";
                            }
                        ?>
                            <div class="b-s-p-c-d-m-img">
                                <img src="../pages/images/sa3-removebg-preview.png" alt="">
                            </div>
                            <div class="b-s-p-c-d-m-content">
                                <a href="">Sức mạnh của hiện tại</a>
                                <p>Sức mạnh của hiện tại” của Eckhart Tolle</p>
                                <div class="b-s-p-c-d-m-content-money">
                                    <h3>199.000đ</h3>
                                    <a href=""><i class="fa-solid fa-arrow-right"></i></a>
                                </div>
                                <div class="b-s-details-whislits">
                                    <i class="fa-regular fa-heart"></i><a href="">Wishlist</a>
                                    <i class="fa-solid fa-code-compare"></i><a href="">Compare</a>
                                </div>
                            </div>
                        </div>




                        <div class="best-sellers-product-card-details">

                            <?php
                            // Truy vấn SQL để lấy 20 sản phẩm ngẫu nhiên và sắp xếp ngẫu nhiên
                            $sql = "SELECT categories.Name AS categoryName, products.ID, products.Name AS phoneName, products.Price, products.Discount, products_images.ImageURL
                                    FROM categories
                                    JOIN products ON categories.ID = products.CategoryID
                                    JOIN products_images ON products.ID = products_images.ProductID
                                    ORDER BY RAND()
                                    LIMIT 4";

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $discountedPrice = $row["Price"] - $row["Discount"];
                                    ?>
                            <div class="best-sellers-product-card-details-main">
                                <div class="b-s-p-c-d-m-img">
                                    <img src="<?php echo $row['ImageURL']; ?>" alt="">
                                </div>
                                <div class="b-s-p-c-d-m-content">
                                    <a href=""><?php echo $row['categoryName']; ?></a>
                                    <p><?php echo $row['phoneName']; ?></p>
                                    <div class="b-s-p-c-d-m-content-money">
                                        <h3><?php echo number_format($discountedPrice, 0, '.', ',') . 'đ'; ?></h3>
                                        <a href="product_detail.php?ProductID=<?php echo $row['ID']; ?>"><i
                                                class="fa-solid fa-arrow-right"></i></a>
                                    </div>
                                    <div class="b-s-details-whislits">
                                        <i class="fa-regular fa-heart"></i><a href="">Wishlist</a>
                                        <i class="fa-solid fa-code-compare"></i><a href="">Compare</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                                }
                            } else {
                                echo "Không có sản phẩm.";
                            }
                        ?>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="best-sellers-product-dots">
            <span class="b-s-p-dot active"></span>
            <span class="b-s-p-dot"></span>
            <span class="b-s-p-dot"></span>
        </div>
        </div>
        </div>
    </section>

    <section id="banner">
        <div class="b-container">
            <h1>Siêu giảm giá <span>lớn nhất</span> tháng qua</h1>
            <a href="">Giảm giá lớn</a>
            <img src="../pages/images/mi-y-1.png" alt="">
        </div>

    </section>

</main>

<?php include_once "../pages/includes/footer_pages.php"?>
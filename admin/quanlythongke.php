<?php

require_once "../config/config.php";

include_once "../admin/includes/header-admin.php";
include_once "../admin/includes/sidebar-admin.php";
include_once "../admin/includes/footer-admin.php";

?>

<article>
    <section id="section-quanlysanpham">
        <div id="form-add-product" class="add-product-container">
            <form id="qlsp-form" action="add_product.php" method="post" enctype="multipart/form-data">
                <h1>Thêm sản phẩm mới</h1>
                <h2>Thông tin</h2>
                <label for="name">Tên</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Điền tên món ăn..." required>

                
                <label for="name">Danh mục</label>
                <select name="category_id" id="category_slug">
                    <?php
                                            // Lấy danh sách các danh mục từ database
                                            $sql = "SELECT * FROM categories";
                                            $result = mysqli_query($conn, $sql);
                
                                            // Hiển thị danh sách các danh mục dưới dạng các tùy chọn trong thẻ select
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<option value="' . $row['ID'] . '">' . $row['Name'] . '</option>';
                                            }
                                            ?>
                </select>
                </br>

                <label id="mota-add-products" for="description">Mô tả</label>
                <textarea class="form-control" id="description" name="description" placeholder="Điền mô tả món ăn..."
                    required></textarea>
                <label for="price">Giá</label>
                <input type="text" class="form-control" id="price-input" name="price" min="0"
                    placeholder="Điền giá món ăn..." required>
                <h2>Hình ảnh</h2>
                <label id="choose-file" for="imageInput" class="custom-file-upload"><i
                        class="fa-solid fa-arrow-up-from-bracket"></i>Thêm ảnh</label>
                <input type="file" name="images[]" id="imageInput" multiple onchange="previewImageProduct(event)">
                <div id="imagePreviewContainer"></div>

                <div class="btn-add-or-discard">
                    <button type="button" id="btn-discard" class="btn btn-primary" onclick="cancelAddProduct()">Trở
                        về</button>
                    <button type="submit" id="btn-add" class="btn btn-primary">Lưu</button>
                </div>
            </form>

        </div>
        <div class="list-product-container">
            <div class="list-title1">
                <div class="quanlysanpham-title">
                    <h2>THỐNG KÊ</h2>
                </div>
            </div>
            



            <div class="table-products">

                <div class="container-statistical">
                    <?php
                                        $sql = "
                            SELECT
                                (SELECT COUNT(*) FROM users) AS num_users,
                                (SELECT COUNT(*) FROM products) AS num_products,
                                (SELECT COUNT(*) FROM orders) AS num_orders,
                                (SELECT SUM(TotalPrice) FROM orders) AS total_revenue
                        ";

                        $result = $conn->query($sql);

                        // Kiểm tra và hiển thị kết quả
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                        ?>
                    <div class="statistical-top">
                        <div class="statistical-top-item-1">
                            <h2>Người dùng</h2>
                            <h3><?php echo $row['num_users']; ?></h3>
                            <div class="item-icon-bg-1">
                                <i class="fa-solid fa-users"></i>
                            </div>
                            <a href="quanlytaikhoan.php">Xem tất cả</a>
                        </div>

                        <div class="statistical-top-item-2">
                            <h2>Sản phẩm</h2>
                            <h3><?php echo $row['num_products']; ?></h3>
                            <div class="item-icon-bg-2">
                                <i class="fa-solid fa-bag-shopping"></i>
                            </div>
                            <a href="quanlysanpham.php">Xem tất cả</a>
                        </div>

                        <div class="statistical-top-item-3">
                            <h2>Đơn hàng</h2>
                            <h3><?php echo $row['num_orders']; ?></h3>
                            <div class="item-icon-bg-3">
                                <i class="fa-brands fa-shopify"></i>
                            </div>
                            <a href="quanlydonhang.php">Xem tất cả</a>
                        </div>

                        <div class="statistical-top-item-4">
                            <h2>Doanh thu ước tính</h2>
                            <h3><?php echo number_format($row["total_revenue"], 0, '.', ','); ?>đ</h3>
                            <div class="item-icon-bg-4">
                                <i class="fa-solid fa-money-bill-trend-up"></i>
                            </div>
                            <a href="">Xem tất cả</a>
                        </div>
                    </div>
                    <?php
                    } else {
                        echo "Không có kết quả.";
                    }
                    ?>
                </div>
                <h1 style="margin-left: 20px;">#10 ĐƠN HÀNG MỚI NHẤT</h1>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên khách hàng</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Tổng tiền</th>
                            <th>Ngày đặt hàng</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
// Truy vấn danh sách danh mục từ bảng categories
$sql = "SELECT orders.ID, orders.CustomerName, orders.Phone, orders.Address, orders.TotalPrice, orders.OrderDate, orders.Status
FROM orders
ORDER BY orders.ID DESC
LIMIT 10;
";
$result = mysqli_query($conn, $sql);

// Hiển thị dữ liệu lấy được từ cơ sở dữ liệu
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
echo "<tr>";
echo "<td class='small-column'>" . $row["ID"] . "</td>";
echo "<td class='large-column'>" . $row["CustomerName"] . "</td>";
echo "<td class='small-column'>" . $row["Phone"] . "</td>";
echo "<td class='large-column'>" . $row["Address"] . "</td>";
echo "<td class='small-column'>" . number_format($row["TotalPrice"], 0, '.', ',') . ' đ' . "</td>";
echo "<td class='large-column'>" . date('d/m/Y', strtotime($row["OrderDate"])) . "</td>";
$status = $row["Status"];
if ($status == "Pending") {
echo "<td class='small-column'>Đã đặt hàng</td>";
} else {
echo "<td class='small-column'>" . $status . "</td>";
}
    }
} else {
echo "<tr><td colspan='3'>Không có đơn hàng nào.</td></tr>";
}
?>


                    </tbody>
                </table>
            </div>

            <div id="confirmDelete">
                <h3>Bạn có chắc chắn muốn xóa sản phẩm ?</h3>
                <h4>Nếu xóa sẽ không thể phục hồi.</h4>
                <button id="cancel-delete-btn" onclick="cancelDelete()">Trở về</button>
                <button type="submit" onclick="deleteProductConfirmed()"><i
                        class="fa-regular fa-trash-can"></i>Xóa</button>
            </div>
        </div>
    </section>
</article>
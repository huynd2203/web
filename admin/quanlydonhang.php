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
                <!-- <label for="color">Màu sắc</label>
                <input type="text" class="form-control" id="color" name="color" placeholder="Điền màu sắc..." required> -->
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
                    <h2>ĐƠN HÀNG</h2>
                </div>
            </div>
            <div class="list-title2">
                <div class="quanlysanpham-search">
                    <div class="all-sanpham">
                        <h3 id="all-product">Tất cả đơn hàng</h3>
                    </div>
                    <div class="find-all">
                        <i style="opacity: 0;" class="fa-solid fa-magnifying-glass" id="search-icon"></i>
                        <input style="opacity: 0;" type="search" placeholder="Tìm kiếm danh mục...">
                        <div style="opacity: 0;" class="btn-add-product">
                            <button type="button" onclick="showAddProduct1()"><i class="fa-solid fa-plus"
                                    id="add-icon"></i>THÊM SẢN PHẨM</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-products">



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
            ORDER BY orders.ID ASC";
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
                echo "<td class='small-column' style='color: green; font-weight: 700;'>Đã đặt hàng</td>";
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
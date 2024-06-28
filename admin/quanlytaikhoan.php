<?php

require_once "../config/config.php";

include_once "../admin/includes/header-admin.php";
include_once "../admin/includes/sidebar-admin.php";
include_once "../admin/includes/footer-admin.php";

?>

<article>
    <section id="section-quanlytaikhoan">
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
                    <h2>TÀI KHOẢN</h2>
                </div>
            </div>
            <div class="list-title2">
                <div class="quanlysanpham-search">
                    <div class="all-sanpham">
                        <h3 id="all-product">Tất cả tài khoản</h3>
                    </div>
                </div>
            </div>
            <div class="table-products">


                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên người dùng</th>
                            <th>Họ và tên</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <!-- <th>Thao tác</th> -->
                        </tr>
                    </thead>
                    <tbody>

                        <?php
    // Truy vấn danh sách danh mục từ bảng categories
    $sql = "SELECT users.ID, users.Username, users.FullName, users.Email, users.PhoneNumber, users.Address
            FROM users
            ORDER BY users.ID ASC";
    $result = mysqli_query($conn, $sql);

    // Hiển thị dữ liệu lấy được từ cơ sở dữ liệu
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td class='small-column'>" . $row["ID"] . "</td>";
            echo "<td class='small-column'>" . "<strong>" . $row["Username"] . "</strong>" . "</td>";
            echo "<td class='small-column'>" . ($row["FullName"] ? "<strong>" . $row["FullName"] . "</strong>" : "<i>Chưa cập nhật</i>") . "</td>";
            echo "<td class='small-column'>" . ($row["Email"] ? "<strong>" . $row["Email"] . "</strong>" : "<i>Chưa cập nhật</i>") . "</td>";
            echo "<td class='small-column'>" . ($row["PhoneNumber"] ? "<strong>" . $row["PhoneNumber"] . "</strong>" : "<i>Chưa cập nhật</i>") . "</td>";
            echo "<td class='large-column'>" . ($row["Address"] ? "<strong>" . $row["Address"] . "</strong>" : "<i>Chưa cập nhật</i>") . "</td>";
            // echo "<td class='small-column'><a id='product-edit-btn' href='edit_product.php?id=" . $row["ID"] . "'><i class='fa-solid fa-pen'></i></a>
            //       <button id='product-delete-btn' onclick='deleteProduct(" . $row["ID"] . ")'><i class='fa-solid fa-trash-can'></i></button></td>";
            // echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No categories found.</td></tr>";
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
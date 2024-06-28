<?php
require_once "../config/config.php";

include_once "../admin/includes/header-admin.php";
include_once "../admin/includes/sidebar-admin.php";
include_once "../admin/includes/footer-admin.php";

?>

<article>
    <section id="section-quanlysanpham">
        <div class="add-product-container1">

            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
                $product_id = $_GET['id'];

                // Truy vấn CSDL để lấy thông tin sản phẩm
                $sql = "SELECT * FROM products WHERE ID = '$product_id'";
                $result = mysqli_query($conn, $sql);

                // Kiểm tra xem có dữ liệu trả về hay không
                if (mysqli_num_rows($result) > 0) {
                    $product = mysqli_fetch_assoc($result);
            ?>

            <form id="qlsp-edit-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"
                enctype="multipart/form-data">
                <h1>Chỉnh sửa sản phẩm</h1>
                <input type="hidden" name="product_id" value="<?php echo $product['ID']; ?>">
                <h2>Thông tin</h2>
                <label for="product_name">Tên</label>
                <input type="text" class="form-control" id="product_name" name="product_name"
                    value="<?php echo $product['Name']; ?>" required>
                <label for="product_slug">Danh mục</label>
                <select name="category_id" id="category_slug">
                    <?php
                    // Lấy danh sách các danh mục từ database
                    $sql = "SELECT * FROM categories";
                    $result = mysqli_query($conn, $sql);

                    // Hiển thị danh sách các danh mục dưới dạng các tùy chọn trong thẻ select
                    while ($row = mysqli_fetch_assoc($result)) {
                        $selected = ($row['ID'] == $product['CategoryID']) ? 'selected' : '';
                        echo '<option value="' . $row['ID'] . '" ' . $selected . '>' . $row['Name'] . '</option>';
                    }
                    ?>
                </select>
                <br>
                <label for="product_description">Mô tả</label>
                <textarea class="form-control" id="product_description" name="product_description"
                    required><?php echo $product['Description']; ?></textarea>
                <label for="product_price">Giá</label>
                <input type="number" class="form-control" id="price-input" name="product_price"
                    value="<?php echo $product['Price']; ?>" min="1000" required>
                <h2>Hình ảnh mới</h2>
                <label id="choose-file" for="imageInputEdit" class="custom-file-upload"><i
                        class="fa-solid fa-arrow-up-from-bracket"></i>Thêm ảnh</label>
                <input type="file" id="imageInputEdit" name="images[]" multiple onchange="previewImageQLSPEdit(event)">
                <div id="imagePreviewContainer-qlsp-edit"></div>

                <div class="btn-edit-or-discard">
                    <button type="button" id="btn-discard-edit" class="btn btn-primary"
                        onclick="cancelEditProducts()">Trở về</button>
                    <button type="submit" id="btn-edit">Lưu</button>
                </div>
            </form>
            <?php
                } else {
                    echo "Không tìm thấy sản phẩm.";
                }
            }
            ?>
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Lấy dữ liệu từ form
                $product_id = $_POST['product_id'];
                $name = $_POST['product_name'];
                $price = $_POST['product_price'];
                $category_id = $_POST['category_id'];
                $description = $_POST['product_description'];

                // Cập nhật thông tin sách trong CSDL
                $query = "UPDATE products SET Name = '$name', Description = '$description', Price = '$price' WHERE ID = '$product_id'";
                $result = mysqli_query($conn, $query);

                if ($result) {
                    // Xóa các hình ảnh cũ của sách
                    $query_delete_images = "DELETE FROM products_images WHERE ProductID = '$product_id'";
                    mysqli_query($conn, $query_delete_images);

                    // Lưu các hình ảnh mới vào CSDL
                    $target_dir = "../uploads/";
                    $images = $_FILES['images'];
                    foreach ($images['tmp_name'] as $key => $tmp_name) {
                        $target_file = $target_dir . basename($images['name'][$key]);
                        move_uploaded_file($tmp_name, $target_file);
                        $image_path = $target_file;
                        $query_insert_image = "INSERT INTO products_images (ProductID, ImageURL) VALUES ('$product_id', '$image_path')";
                        mysqli_query($conn, $query_insert_image);
                    }

                    // Chuyển hướng đến trang chi tiết sản phẩm vừa chỉnh sửa
                    header("Location: quanlysanpham.php");
                    exit;
                } else {
                    echo 'Lỗi: ' . mysqli_error($conn);
                }
            }
            ?>

        </div>
    </section>
</article>
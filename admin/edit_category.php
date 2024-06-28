<?php

require_once "../config/config.php";

include_once "../admin/includes/header-admin.php";
include_once "../admin/includes/sidebar-admin.php";
include_once "../admin/includes/footer-admin.php";

?>


<article>
    <div class="content-container">
        <section id="section-quanlydanhmuc">
            <div class="form-qldm">
                <div class="form-qldm-container">


                    <?php
    
                        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                        // Lấy ID danh mục từ tham số truyền vào
                        $category_id = $_GET['id'];
    
                        // Truy vấn CSDL để lấy thông tin của danh mục
                        $sql = "SELECT * FROM categories WHERE ID = $category_id";
                        $result = mysqli_query($conn, $sql);
    
                        // Kiểm tra xem có dữ liệu trả về hay không
                        if (mysqli_num_rows($result) > 0) {
                        // Lấy thông tin của danh mục từ kết quả truy vấn
                        $category = mysqli_fetch_assoc($result);
                        ?>
                    <form id="form-edit-qldm" method="POST"
                        action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                        <h3>Chỉnh Sửa Danh mục</h3>
                        <label for="category_id">ID danh mục</label><br>
                        <input type="text" id="category_id" name="category_id" value="<?php echo $category['ID']; ?>"
                            readonly><br>
                        <label for="category_name">Tên danh mục mới</label><br>
                        <input type="text" id="category_name" name="category_name"
                            value="<?php echo $category['Name']; ?>"><br>

                        <div class="btn-edit-qldm">
                            <button type="submit" id="cancel-edit-category" name="cancel_edit_category"
                                onclick="cancelEditCategory()">Trở về</button>
                            <button type="submit" id="edit_category" name="edit_category">Cập nhật</button>
                        </div>
                    </form>
                    <?php
                        }
                    }
    ?>
                    <?php
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Lấy dữ liệu từ form
        $category_id = $_POST['category_id'];
        $category_name = $_POST['category_name'];
        // Lấy các trường thông tin khác tương ứng
    
        // Cập nhật dữ liệu vào CSDL
        $sql = "UPDATE categories SET Name = '$category_name' WHERE ID = $category_id";
        // Thực thi truy vấn SQL để cập nhật dữ liệu
        if (mysqli_query($conn, $sql)) {
            header('Location: quanlydanhmuc.php');
            exit();
        } else {
            echo 'Chỉnh sửa thất bại: ' . mysqli_error($conn);
        }
    }
    ?>

                </div>
            </div>
        </section>
    </div>
</article>

</div>
</div>
</section>
</div>
</article>
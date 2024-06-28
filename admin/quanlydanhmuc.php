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
                <div class="quanlydanhmuc-title">
                    <h2>DANH MỤC</h2>
                </div>
                <div class="quanlydanhmuc-search">
                    <div class="all-danhmuc">
                        <h3 id="all-cate">Tất cả danh mục</h3>
                    </div>
                    <div class="find-all">
                        <i style="opacity: 0;" class="fa-solid fa-magnifying-glass" id="search-icon"></i>
                        <input style="opacity: 0;" type="search" placeholder="Tìm kiếm danh mục...">
                        <div class="btn-add-category">
                            <button type="button" onclick="showAddCategory()"><i class="fa-solid fa-plus"
                                    id="add-icon"></i>THÊM DANH MỤC</button>
                        </div>
                    </div>

                </div>
                <div class="form-qldm-container">
                    <div id="form-add-category">
                        <form id="form-add-qldm" method="POST" action="add_category.php"
                            onsubmit="return validateFormAddCategory()" enctype="multipart/form-data">
                            <h3>Thêm Danh Mục Mới</h3>
                            <label for="category_name">Tên danh mục</label><br>
                            <input type="text" id="category_name" name="category_name"><br>
                            <div class="btn-add-qldm">
                                <button type="button" id="cancel_add_category" name="cancel_add_category"
                                    onclick="cancelAddCategory()">Trở về</button>
                                <button type="submit" id="add_category" name="add_category"><i
                                        class="fa-solid fa-check"></i>Lưu</button>
                            </div>
                        </form>
                    </div>


                    <div id="confirmDelete">
                        <h3>Bạn có chắc chắn muốn xóa danh mục ?</h3>
                        <h4>Nếu xóa sẽ không thể hồi phục.</h4>
                        <button id="cancel-delete-btn" onclick="cancelDelete()">Trở về</button>
                        <button onclick="deleteCategoryConfirmed()"><i class="fa-regular fa-trash-can"></i>Xóa</button>
                    </div>
                    <div class="table-category">
                        <?php
                                // Truy vấn danh sách danh mục từ bảng categories
                                $sql = "SELECT ID, Name, imageCaterogy FROM categories";
                                $result = mysqli_query($conn, $sql);?>
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th class="thaotac">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                // Hiển thị dữ liệu lấy được từ cơ sở dữ liệu
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td class='small-column'>" . $row["ID"] . "</td>";
                                        echo "<td class='large-column'>" . $row["Name"] . "</td>";
                                        echo "<td class='small-column'>
                                                <a id='actinon-edit-btn' href='edit_category.php?id=" . $row["ID"] . "'><i class='fa-solid fa-pen'></i></a>
                                                <button id='actinon-delete-btn' onclick='deleteCategory(" . $row["ID"] . ")'><i class='fa-solid fa-trash-can'></i></button></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='3'>Không có danh mục nào.</td></tr>";
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</article>
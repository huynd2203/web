<?php

// Kiểm tra URL nếu yêu cầu trang admin
if (isset($_GET['admin']) && $_GET['admin'] == true && $_SERVER['REQUEST_METHOD'] == 'GET' && empty($_POST)) {
  // Chuyển hướng đến trang admin
  header('Location: admin/index_admin.php');
  exit();
} else {
  // Chuyển hướng đến trang home
  header('Location: pages/index_home.php');
  exit();
}

?>
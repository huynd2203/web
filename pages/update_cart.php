<?php
session_start();
require_once "../config/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $product_price = $_POST['product_price'];
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    // Cập nhật số lượng sách trong giỏ hàng
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['product_id'] == $product_id) {
            $item['quantity'] = $quantity;
            break;
        }
    }

    header("Location: cart.php");
    exit();
}
?>
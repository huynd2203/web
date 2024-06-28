<?php

// Bắt đầu phiên đăng nhập
session_start();

    require_once "../config/config.php";

    if (!isset($_SESSION['username'])) {
    header("Location: login_admin.php");
    exit();
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN DASHBOARD</title>
    <link rel="stylesheet" href="../admin/assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script src="../admin/assets/js/javascript.js"></script>

</head>

<body>
    <header>
        <div class="header-container">
            <div class="head-logo">
                <a href="index.php">
                    <div class="main-logo">
                        <div class="circle"></div>
                        <h1>GoodFood</h1>
                    </div>
                    <h2>Admin Dashboard</h2>
                </a>
                <i class="fa-solid fa-bars"></i>
            </div>


            <div class="head-info">
                <div class="user-info">
                    <?php
                        if(isset($_SESSION['username'])) {
                            if($_SESSION['role'] === 'admin') {
                                echo "<h1>Xin chào, " . $_SESSION['username'] . "! </h1>";
				                echo "<button class='btn-logout' onclick=\"dangXuat()\">Đăng xuất</button>";
                            } else {
                                header ("Location: ../home/index.php");
                            }
                        }else {
                            echo "<button>Đăng nhập</button>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </header>
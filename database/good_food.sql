-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 22, 2024 lúc 10:39 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `good-food`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `imageCaterogy` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`ID`, `Name`, `imageCaterogy`) VALUES
(37, 'Mì ý', ''),
(38, 'Pizza', ''),
(39, 'Món gà hot', ''),
(40, 'Trà sữa', ''),
(41, 'Ăn vặt', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `OrderDate` timestamp NULL DEFAULT NULL,
  `TotalPrice` decimal(10,2) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `CustomerName` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`ID`, `UserID`, `OrderDate`, `TotalPrice`, `Status`, `CustomerName`, `Address`, `Phone`, `Email`) VALUES
(63, 1, '2024-05-22 03:32:33', 115000.00, 'Pending', 'Nguyễn Giang', 'Hồ Chí Minh', '0938737777', 'ntgiang01012023@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `ID` int(11) NOT NULL,
  `OrderID` int(11) DEFAULT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `ProductName` varchar(255) NOT NULL,
  `ProductPrice` decimal(10,2) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`ID`, `OrderID`, `ProductID`, `ProductName`, `ProductPrice`, `Quantity`) VALUES
(82, 63, 83, 'Bánh tráng trộn sa tế tôm', 35000.00, 1),
(83, 63, 77, 'Trà Sữa Matcha Váng Sữa - MayCha', 30000.00, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Color` varchar(100) DEFAULT NULL,
  `Description` text NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `images_phone` varchar(200) NOT NULL,
  `Discount` decimal(10,2) DEFAULT 0.00,
  `CreatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`ID`, `Name`, `Color`, `Description`, `Price`, `CategoryID`, `images_phone`, `Discount`, `CreatedAt`) VALUES
(67, 'Pizza Hut Hải Sản Hấp Dẫn', NULL, 'Pizza Hut Hải Sản Hấp Dẫn', 150000.00, 38, '', 50000.00, '2024-05-21 09:29:59'),
(68, 'Mì Ý Mama Rosa Spaghetti', NULL, 'Mì Ý Mama Rosa Spaghetti hấp dẫn', 120000.00, 37, '', 0.00, '2024-05-21 10:32:30'),
(69, 'Spaghetti Carbonara', NULL, 'Mì spaghetti với sốt carbonara kem béo và phô mai parmesan thơm ngon', 75000.00, 37, '', 0.00, '2024-05-21 10:34:59'),
(70, 'Mì ý Fettuccine Alfredo', NULL, 'Mì fettuccine dày và mềm kết hợp với sốt kem bơ và phô mai parmesan, tạo nên một món ăn đậm đà và ngon miệng', 80000.00, 37, '', 0.00, '2024-05-21 10:36:21'),
(71, 'Mì ý Penne Arrabbiata', NULL, 'Mì penne với sốt cà chua hảo hạng, tiêu cay và hành tỏi thơm nồng', 70000.00, 37, '', 0.00, '2024-05-21 10:37:07'),
(72, 'Mì ý Lasagna Bolognese', NULL, 'Lớp lớp mì lasagna dai ngon xen kẽ với sốt bolognese thơm lừng và phô mai mozzarella tan chảy', 85000.00, 37, '', 0.00, '2024-05-21 10:40:12'),
(73, 'Mỳ ý Ravioli ai Funghi', NULL, 'Ravioli nhồi nấm đầy ấn tượng, kết hợp với sốt nấm thơm ngon và hành tỏi', 90000.00, 37, '', 0.00, '2024-05-21 10:40:57'),
(74, 'Mì ý Gnocchi alla Sorrentina', NULL, 'Gnocchi mềm mịn với sốt cà chua, phô mai mozzarella và rau mùi tươi mát', 85000.00, 37, '', 0.00, '2024-05-21 10:42:23'),
(75, 'Mì ý Tagliatelle ai Frutti di Mare', NULL, 'Tagliatelle dẻo dai kết hợp với hải sản tươi ngon như tôm, mực và sò điệp, trong sốt cà chua thơm ngon', 95000.00, 37, '', 0.00, '2024-05-21 10:43:13'),
(76, 'Trà Sữa Trân Châu Hoàng Kim', NULL, 'Trà Sữa Trân Châu Hoàng Kim - Gong Cha Vietnam', 70000.00, 40, '', 0.00, '2024-05-22 13:45:22'),
(77, 'Trà Sữa Matcha Váng Sữa - MayCha', NULL, 'Trà Sữa Matcha Váng Sữa - MayCha', 30000.00, 40, '', 0.00, '2024-05-22 13:46:06'),
(78, 'Trà Sữa Truyền Thống Đài Loan – Xingfutang', NULL, 'Trà Sữa Truyền Thống Đài Loan – Xingfutang', 40000.00, 40, '', 0.00, '2024-05-22 13:46:42'),
(79, 'Combo gà rán + khoai tây + Pepsi', NULL, 'Combo gà rán + khoai tây + Pepsi', 88000.00, 39, '', 0.00, '2024-05-22 13:48:40'),
(80, 'Combo 2 đùi tỏi', NULL, 'Combo 2 đùi tỏi', 66000.00, 39, '', 0.00, '2024-05-22 13:49:28'),
(81, 'Mì Ý Sốt Bò Bằm + 1 miếng gà rán + Khoai tây vừa + Nước ngọt', NULL, 'Mì Ý Sốt Bò Bằm + 1 miếng gà rán + Khoai tây vừa + Nước ngọt', 120000.00, 39, '', 0.00, '2024-05-22 13:50:11'),
(82, 'Bánh tráng trộn Tây Ninh cuộn tôm hành (ly) 80gr', NULL, 'Bánh tráng trộn Tây Ninh cuộn tôm hành (ly) 80gr', 30000.00, 41, '', 0.00, '2024-05-22 13:51:32'),
(83, 'Bánh tráng trộn sa tế tôm', NULL, 'Bánh tráng trộn sa tế tôm', 35000.00, 41, '', 0.00, '2024-05-22 13:52:11'),
(84, 'Bánh tráng trộn sate chay (hộp) 80gr', NULL, 'Bánh tráng trộn sate chay (hộp) 80gr', 40000.00, 41, '', 0.00, '2024-05-22 13:53:01'),
(85, 'PIZZA TÔM VIỀN PHÔ MAI 3 VỊ', NULL, 'PIZZA TÔM VIỀN PHÔ MAI 3 VỊ', 299000.00, 38, '', 0.00, '2024-05-22 14:41:08'),
(86, 'PIZZA GÀ THẬP CẨM', NULL, 'PIZZA GÀ THẬP CẨM', 105000.00, 38, '', 0.00, '2024-05-22 14:41:52');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products_images`
--

CREATE TABLE `products_images` (
  `ID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `ImageURL` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products_images`
--

INSERT INTO `products_images` (`ID`, `ProductID`, `ImageURL`) VALUES
(113, 68, '../uploads/mi-y.png'),
(114, 69, '../uploads/my_lon_nc.png'),
(115, 70, '../uploads/image-huong-dan-cach-lam-trung-op-la-mi-soi-dep-thom-ngon-dung-chuan-164985105461045.png'),
(116, 71, '../uploads/resize-banh-cho-website-33_f9b22a601c084a5887955828c43c360a_c0f598a1f4094d0a95463c6ab89ea3b8.webp'),
(117, 72, '../uploads/90fpIkbEsTS4I.png'),
(118, 73, '../uploads/pngtree-pasta-with-bolognese-png-image_10207252.png'),
(119, 74, '../uploads/myybobam.png'),
(120, 75, '../uploads/0002257_spaghetti-shrimp-rose_500.png'),
(121, 76, '../uploads/ts1.png'),
(122, 77, '../uploads/ts2.png'),
(123, 78, '../uploads/ts3.png'),
(124, 79, '../uploads/gr1.png'),
(125, 80, '../uploads/gr2.png'),
(126, 81, '../uploads/gr3.png'),
(127, 82, '../uploads/av1.png'),
(128, 83, '../uploads/av2.png'),
(129, 84, '../uploads/av3.png'),
(130, 67, '../uploads/pz1.png'),
(131, 85, '../uploads/pz2.png'),
(133, 86, '../uploads/pz3.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `FullName` varchar(100) NOT NULL,
  `Address` varchar(200) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  `Role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`ID`, `Username`, `Password`, `Email`, `FullName`, `Address`, `PhoneNumber`, `Role`) VALUES
(1, 'admin', '123', '', '', '', '', 'admin'),
(2, 'giang', 'giang1123', 'ntgiang01012023@gmail.com', '', '', '', 'user'),
(3, 'maymay', '123', 'may@gmaul.com', '', '', '', 'user'),
(4, 'giang1', '123', 'giang1@gmail.com', '', '', '', 'user'),
(5, 'test', '123', 'test@gmail.com', '', '', '', 'user'),
(6, 'test1', '123', 'test1@gmail.com', '', '', '', 'user'),
(7, 'test2', '123', 'test2@gmail.com', '', '', '', 'user'),
(8, 'giang3', 'giang3', 'ntgiang01012023@gmail.com', '', '', '', 'user'),
(9, 'aaa', '123', 'g@gmail.com', '', '', '', 'user'),
(10, 'nguyenvana1', '123', 'nguyenvana1@gmail.com', '', '', '', 'user');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserID` (`UserID`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `OrderID` (`OrderID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_category` (`CategoryID`);

--
-- Chỉ mục cho bảng `products_images`
--
ALTER TABLE `products_images`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT cho bảng `products_images`
--
ALTER TABLE `products_images`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`);

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`ID`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ID`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`ID`);

--
-- Các ràng buộc cho bảng `products_images`
--
ALTER TABLE `products_images`
  ADD CONSTRAINT `products_images_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

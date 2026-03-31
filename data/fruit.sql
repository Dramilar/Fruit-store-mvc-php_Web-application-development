-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3307
-- Thời gian đã tạo: Th3 30, 2026 lúc 01:09 PM
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
-- Cơ sở dữ liệu: `fruit`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_price` double DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `status` int(11) DEFAULT 0 COMMENT '0 => "Chờ xác nhận",\r\n1 => "Đã thanh toán",\r\n2 => "Đang giao hàng",\r\n3 => "Hoàn thành"'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `full_name`, `phone`, `address`, `order_date`, `status`) VALUES
(1, 2, 720000, 'Tiến Trần', '0342637512', '58', '2026-02-06 16:52:43', 3),
(2, 2, 55000, 'Tiến Trần', '09055554443', 'LamDong', '2026-02-06 17:02:25', 3),
(3, 2, 55000, 'Tiến Trần', '0342637512', 'Binh Thuận', '2026-02-06 17:13:35', 3),
(4, 2, 1200000, 'Tiến Trần 123', '19000342', 'HCM', '2026-02-06 17:23:02', 3),
(11, 1, 150000, 'khang', '061490561651', 'Bentre', '2026-02-07 17:11:05', 3),
(12, 1, 165000, 'tien Ha', 'sadas', 'BinhPhuoc', '2026-02-07 17:22:22', 3),
(13, 6, 50000, 'Hà Mạnh Tiến', '0399310704', 'Bình Phước', '2026-03-30 17:19:59', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 13, 1, 220000),
(2, 1, 6, 1, 500000),
(3, 2, 8, 1, 55000),
(4, 3, 8, 1, 55000),
(5, 4, 15, 1, 1200000),
(13, 11, 9, 1, 150000),
(14, 12, 8, 3, 55000),
(15, 13, 17, 2, 25000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `id_type` int(11) NOT NULL,
  `price` double NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `id_type`, `price`, `image`, `description`) VALUES
(2, 'Thanh Long Ruột Đỏ', 1, 45000, 'prd14.webp', 'Thanh long Bình Thuận, ngọt thanh, tốt cho sức khỏe.'),
(3, 'Táo Envy Mỹ', 2, 120000, 'prd13.png', 'Táo giòn, ngọt đậm, nhập khẩu trực tiếp từ Mỹ.'),
(4, 'Nho Mẫu Đơn Hàn Quốc', 2, 450000, 'prd11.jpg', 'Nho sữa cao cấp, vị ngọt thơm như kẹo.'),
(5, 'Mít Sấy Giòn', 3, 55000, 'prd10.webp', 'Mít sấy tự nhiên, không đường, giòn tan.'),
(6, 'Giỏ Quà Ngũ Quả', 4, 500000, 'prd4.jpg', 'Giỏ quà sang trọng kết hợp 5 loại trái cây tươi.'),
(7, 'Vải Thiều Lục Ngạn', 1, 65000, 'prd15.png', 'Vải thiều Bắc Giang chính hiệu, quả to, hạt nhỏ, vị ngọt lịm.'),
(8, 'Bưởi năm roi', 1, 55000, 'prd3.jpg', 'Bưởi Năm Roi Vĩnh Long, ít hạt, vị ngọt thanh hơi chua nhẹ.'),
(9, 'Sầu Riêng Ri6', 1, 150000, 'prd12.jpg', 'Sầu riêng cơm vàng hạt lép, thơm nức, béo ngậy.'),
(11, 'Kiwi Vàng Zespri', 2, 140000, 'prd7.webp', 'Kiwi vàng New Zealand, vị ngọt đậm, chứa nhiều Vitamin C.'),
(12, 'Lê Hàn Quốc', 2, 95000, 'prd8.jpg', 'Lê nâu Hàn Quốc, quả to, mọng nước, ăn rất giòn.'),
(13, 'Hạt Điều Rang Muối', 3, 220000, 'prd6.webp', 'Hạt điều Bình Phước loại 1, giòn tan, bùi béo.'),
(15, 'Giỏ Quà Cao Cấp', 4, 1200000, 'prd4.webp', 'Sự kết hợp giữa Nho mẫu đơn, Táo Envy và Cherry nhập khẩu.'),
(17, 'Bưởi da xanh', 1, 25000, 'prd1.jpg', 'Bưởi da xanh ngon, ngọt'),
(18, 'Dưa hấu Long An', 1, 15000, 'prd16.webp', 'Dưa hấu Long An bao đỏ bao ngọt'),
(19, 'Dừa xiêm trọc Bến Tre', 1, 72000, 'prd9.webp', 'Dừa xiêm ngọt nước');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `typeofproduct`
--

CREATE TABLE `typeofproduct` (
  `id` int(11) NOT NULL,
  `typename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `typeofproduct`
--

INSERT INTO `typeofproduct` (`id`, `typename`) VALUES
(1, 'Trái cây nội địa'),
(2, 'Trái cây nhập khẩu'),
(3, 'Trái cây sấy khô'),
(4, 'Giỏ quà trái cây');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `role` tinyint(4) DEFAULT 0 COMMENT '0: Khách, 1: Nhân viên, 2: Admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `role`) VALUES
(1, 'admin', '1', 'admin@fruitshop.com', 1),
(2, 'khachhang1', '1', 'user1@gmail.com', 0),
(3, 'cus', '1', NULL, 0),
(4, 'cus1', '1', '', 0),
(5, 'hmt', '123456', '', 2),
(6, 'custien', '123456', '', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type` (`id_type`);

--
-- Chỉ mục cho bảng `typeofproduct`
--
ALTER TABLE `typeofproduct`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `typeofproduct`
--
ALTER TABLE `typeofproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `typeofproduct` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

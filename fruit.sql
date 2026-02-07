-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 07, 2026 lúc 02:45 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

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
(1, 2, 720000, 'Tiến Trần', '0342637512', '58', '2026-02-06 16:52:43', 0),
(2, 2, 55000, 'Tiến Trần', '09055554443', 'LamDong', '2026-02-06 17:02:25', 0),
(3, 2, 55000, 'Tiến Trần', '0342637512', 'Binh Thuận', '2026-02-06 17:13:35', 0),
(4, 2, 1200000, 'Tiến Trần 123', '19000342', 'HCM', '2026-02-06 17:23:02', 0),
(11, 1, 150000, 'khang', '061490561651', 'Bentre', '2026-02-07 17:11:05', 1),
(12, 1, 165000, 'tien Ha', 'sadas', 'BinhPhuoc', '2026-02-07 17:22:22', 2);

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
(14, 12, 8, 3, 55000);

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
(1, 'Xoài Cát Hòa Lộc', 1, 85000, 'xoai-cat.jpg', 'Xoài cát đặc sản Tiền Giang, thơm ngọt, thịt dày.'),
(2, 'Thanh Long Ruột Đỏ', 1, 45000, 'thanh-long.jpg', 'Thanh long Bình Thuận, ngọt thanh, tốt cho sức khỏe.'),
(3, 'Táo Envy Mỹ', 2, 120000, 'tao-envy.jpg', 'Táo giòn, ngọt đậm, nhập khẩu trực tiếp từ Mỹ.'),
(4, 'Nho Mẫu Đơn Hàn Quốc', 2, 450000, 'nho-mau-don.jpg', 'Nho sữa cao cấp, vị ngọt thơm như kẹo.'),
(5, 'Mít Sấy Giòn', 3, 55000, 'mit-say.jpg', 'Mít sấy tự nhiên, không đường, giòn tan.'),
(6, 'Giỏ Quà Ngũ Quả', 4, 500000, 'gio-qua-1.jpg', 'Giỏ quà sang trọng kết hợp 5 loại trái cây tươi.'),
(7, 'Vải Thiều Lục Ngạn', 1, 65000, 'vai-thieu.jpg', 'Vải thiều Bắc Giang chính hiệu, quả to, hạt nhỏ, vị ngọt lịm.'),
(8, 'Bưởi Năm Roi', 1, 55000, 'buoi-5-roi.jpg', 'Bưởi Năm Roi Vĩnh Long, ít hạt, vị ngọt thanh hơi chua nhẹ.'),
(9, 'Sầu Riêng Ri6', 1, 150000, 'sau-rieng-ri6.jpg', 'Sầu riêng cơm vàng hạt lép, thơm nức, béo ngậy.'),
(10, 'Việt Quất New Zealand', 2, 180000, 'viet-quat.jpg', 'Việt quất tươi nhập khẩu, giàu chất chống oxy hóa và vitamin.'),
(11, 'Kiwi Vàng Zespri', 2, 140000, 'kiwi-vang.jpg', 'Kiwi vàng New Zealand, vị ngọt đậm, chứa nhiều Vitamin C.'),
(12, 'Lê Hàn Quốc', 2, 95000, 'le-han-quoc.jpg', 'Lê nâu Hàn Quốc, quả to, mọng nước, ăn rất giòn.'),
(13, 'Hạt Điều Rang Muối', 3, 220000, 'hat-dieu.jpg', 'Hạt điều Bình Phước loại 1, giòn tan, bùi béo.'),
(14, 'Xoài Sấy Dẻo', 3, 75000, 'xoai-say-deo.jpg', 'Xoài cát sấy dẻo tự nhiên, không quá ngọt, giữ nguyên vị xoài.'),
(15, 'Giỏ Quà Cao Cấp', 4, 1200000, 'gio-qua-vip.jpg', 'Sự kết hợp giữa Nho mẫu đơn, Táo Envy và Cherry nhập khẩu.');

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
(4, 'cus1', '1', '', 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `typeofproduct`
--
ALTER TABLE `typeofproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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

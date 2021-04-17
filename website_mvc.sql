-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 17, 2021 lúc 05:25 PM
-- Phiên bản máy phục vụ: 10.4.6-MariaDB
-- Phiên bản PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `website_mvc`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminId` int(11) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminEmail` varchar(150) NOT NULL,
  `adminUser` varchar(255) NOT NULL,
  `adminPass` varchar(255) NOT NULL,
  `level` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminId`, `adminName`, `adminEmail`, `adminUser`, `adminPass`, `level`) VALUES
(1, 'huuanh', 'anh@gmail.com', 'anhadmin', 'e10adc3949ba59abbe56e057f20f883e', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brandId` int(11) NOT NULL,
  `brandName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_brand`
--

INSERT INTO `tbl_brand` (`brandId`, `brandName`) VALUES
(1, 'DELL'),
(2, 'SAMSUNG'),
(3, 'Apple'),
(4, 'Huawei'),
(9, 'ACER'),
(10, 'CANON'),
(11, 'SONY'),
(12, 'BITIS'),
(13, 'MAC'),
(14, 'NO BRAND'),
(15, 'PNJ'),
(16, 'Meteor Shower'),
(17, 'BKAV'),
(18, 'OEM');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category`
--

CREATE TABLE `tbl_category` (
  `catId` int(11) NOT NULL,
  `catName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_category`
--

INSERT INTO `tbl_category` (`catId`, `catName`) VALUES
(4, 'LAPTOP'),
(5, 'Desktop'),
(6, 'Mobile Phone'),
(7, 'Clothing'),
(8, 'Software'),
(9, 'Acessories'),
(10, 'Jewellery'),
(11, 'Toys Kids'),
(12, 'Home Decor'),
(13, 'Beauty Healthcare'),
(14, 'Shoes'),
(15, 'Tivi'),
(18, 'Other');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `zipcode` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `name`, `address`, `city`, `country`, `zipcode`, `phone`, `email`, `password`) VALUES
(9, 'hoangdinh', '6lk4b khu đô thị mỗ lao', 'hÃ  ná»™i', 'AR', '12331', '0945586004', 'dinh@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(10, 'thu thảo', '124 nguyễn trãi', 'hÃ  ná»™i', 'AR', '832412', '0937564982', 'thao@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(11, 'Quang Huy', '112 Quang Trung', 'SÃ i GÃ²n', 'AF', '5454534', '0945023423', 'huy@gmail.com', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `zipcode` varchar(30) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `time_order` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `customer_id`, `total`, `name`, `zipcode`, `address`, `phone`, `email`, `status`, `time_order`) VALUES
(16, 10, 49617000, 'thu thảo', '832412', '124 nguyễn trãi', '0937564982', 'thao@gmail.com', 1, '2021-04-17 03:03:11'),
(17, 9, 38700000, 'hoangdinh', '12331', '6lk4b khu đô thị mỗ lao', '0945586004', 'dinh@gmail.com', 1, '2021-04-17 03:05:19'),
(18, 9, 26181000, 'hoangdinh', '12331', '6lk4b khu đô thị mỗ lao', '0945586004', 'dinh@gmail.com', 0, '2021-04-17 03:05:52');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_orderdetails`
--

CREATE TABLE `tbl_orderdetails` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_orderdetails`
--

INSERT INTO `tbl_orderdetails` (`id`, `order_id`, `product_id`, `quantity`) VALUES
(16, 16, 17, 1),
(17, 16, 15, 2),
(18, 17, 12, 1),
(19, 18, 16, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product`
--

CREATE TABLE `tbl_product` (
  `productId` int(11) NOT NULL,
  `productName` text NOT NULL,
  `catId` int(11) NOT NULL,
  `brandId` int(11) NOT NULL,
  `product_desc` text NOT NULL,
  `type` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_product`
--

INSERT INTO `tbl_product` (`productId`, `productName`, `catId`, `brandId`, `product_desc`, `type`, `price`, `image`) VALUES
(12, 'iMac 27\'\' 2020 - 3.3GHz 6-Core I5 8GB 512GB Radeon Pro 5300 4GB', 5, 3, '3.3GHz 6-core 10th-generation Intel Core i5 processor\r\nTurbo Boost up to 4.8GHz\r\n8GB 2666MHz DDR4 memory\r\n512GB SSD storage\r\nRadeon Pro 5300 with 4GB of GDDR6 memory\r\nTwo Thunderbolt 3 ports\r\nRetina 5K 5120-by-2880 P3 display with True Tone', 1, '51800000', '2729b66c97.png'),
(13, 'Samsung Galaxy S9', 6, 2, 'Chiếc điện thoại hiện đại nhất của SAMSUNG', 0, '26300000', 'cca53d8297.jpg'),
(14, 'Máy ảnh Canon EOS 800D', 18, 10, 'Máy ảnh siêu đẹp', 0, '17290000', '2c8d4dfd3c.jpg'),
(15, 'Laptop Acer Nitro 5', 4, 9, 'Laptop hàng đầu đến từ ACER', 0, '19590000', '75aac86276.jpg'),
(16, 'Iphone 12 Pro Max', 6, 3, 'Siêu phẩm đến từ Apple', 0, '29090000', '6d93b5b901.jpg'),
(17, 'Tủ lạnh Samsung', 18, 2, 'Tủ lạnh hiện đại', 0, '15950000', 'b40924eb30.jpg'),
(18, 'Smart Tivi Sony 65 inch KD-65X7000G', 15, 11, 'Kiểu dáng sang trọng với chân đế kim loại, kích thước màn hình lớn 65 inch.\r\nĐộ phân giải 4K sắc nét đi kèm công nghệ HDR10 cho hình ảnh chân thật.\r\nHình ảnh có dải màu rộng, mang đến màu sắc rực rỡ, tự nhiên cùng công nghệ màn hình chấm lượng tử TRILUMINOS.\r\nNâng cấp hình ảnh độ phân giải thấp cho chất lượng sắc nét gần bằng 4K với công nghệ 4K X-Reality PRO.\r\nÂm thanh sống động, mạnh mẽ với công nghệ S-Force Front Surround.\r\nHệ điều hành Linux OS ổn định, dễ thao tác cùng nhiều ứng dụng giải trí phổ biến.\r\nHỗ trợ chiếu màn hình điện thoại android lên tivi với tính năng Screen Mirroring.', 1, '16900000', '2251e4c6e6.jpg'),
(19, 'Giày Thể Thao Nam Biti\'s Hunter Street - Hanoi Culture Patchwork Old Wall Yellow DSMH02503NAU', 14, 12, 'Tên sản phẩm: Giày Thể Thao Nam Biti\'s Hunter Street - Hanoi Culture Patchwork DSMH02503NAU\r\nThương hiệu:Biti\'s\r\nChính hãng 100%\r\nThời gian bảo hành:3 tháng\r\nĐổi size trong vòng 7 ngày\r\n', 1, '899000', '7e6d2691b9.png'),
(20, 'Son MAC Chili', 13, 13, '- Chất son lì không bóng.\r\n- Độ lên màu chuẩn.\r\n- Giữ màu lâu đến 5h.\r\n- Không lộ vân môi.', 1, '580000', '7e467ba202.png'),
(21, 'Kệ Sắt Đáy Gỗ Treo Tường Để Đồ Đa Năng,Trang Trí Nhà Cửa ,Decor Quán Xá - Tặng Kèm Đinh Và Miếng Dán Tường', 12, 14, 'Thông tin sản phẩm:Kệ Sắt Đáy Gỗ Treo Tường Để Đồ Đa Năng, Trang Trí Nhà Cửa , Quán Xá \r\n- Màu Sắc : Màu Đen\r\n- Chất liệu: kệ sắt + đáy gỗ \r\n- Thiết kế : Có Rào Chắn\r\n- Màu sắc: trắng, đen, hồng\r\n- Tặng đinh hoặc móc treo tường\r\n- Kích thước: \r\n+ Size L:  12*14* 45 cm\r\n+ Size M: 11*13* 35 cm\r\n+ Size S: 10*12* 25 cm\r\nĐặc điểm nổi bật:\r\n- Kiểu dáng hiện đại, thu hút người nhìn\r\n- Trang trí nhà cửa, phòng khách, phòng làm việc, quán trà, cafe, khách sạn,...\r\n- Dụng cụ trang trí cho các studio chụp hình, quay quảng cáo,...\r\n- Đựng dụng cụ gia đình, như vật dụng nhà bếp, nhà tắm, .....\r\n- Chịu lực tốt, độ bền cao\r\n- Có loại có thanh ngang giữ đồ giúp đồ không bị rơi vỡ\r\nShop Gia Linh Cam Kết : \r\n- Hình ảnh sản phẩm giống 100%.\r\n- Chất lượng sản phẩm tốt 100%.\r\n- Sản phẩm được kiểm tra kĩ càng, nghiêm ngặt trước khi giao hàng.\r\n- Sản phẩm luôn có sẵn trong kho hàng. \r\n- Giao hàng ngay khi nhận được đơn hàng.\r\n- Hoàn tiền ngay nếu sản phẩm không giống với mô tả.\r\n- Giao hàng toàn quốc, nhận hàng thanh toán. \r\n- Hỗ trợ đổi trả theo quy định.\r\n- Gửi hàng siêu tốc', 1, '125000', 'eed4f413c1.png'),
(22, 'Ô tô điều khiển từ xa siêu xe Lamborghini DK81003', 11, 14, '- Chất liệu: Nhựa ABS, không chứa hóa chất độc hại, không có viền sắc nhọn, an toàn cho bé\r\n\r\n- Tỉ lệ thiết kế xe: 1:18\r\n\r\n- Pin: 4 pin 1,5V, 2A\r\n\r\n- Độ tuổi: 6 tuổi trở lên\r\n\r\n- Xuất xứ: Trung Quốc\r\n\r\n- Chức năng: 4 chức năng: Tới – lùi - rẽ trái - rẽ phải\r\n\r\n- Xe được thiết kế mô phỏng theo xe thật với tỉ lệ 1:16, thiết kế mô phỏng theo siêu xe Lamborghini với đường nét thể thao, mạnh mẽ\r\n\r\n- Các chi tiết của xe được làm tỉ mỉ, công phu, không góc cạnh\r\n\r\n- Hệ thống điều khiển radio (R/C) ổn định hoạt động tốt ở khoảng cách xa.\r\n\r\n- Sử dụng 4 pin AA (Sản phẩm không kèm pin)\r\n\r\n- Xe được làm từ chất liệu nhựa an toàn với sức khỏe trẻ nhỏ, để phụ huynh an tâm khi bé vui chơi.', 1, '140000', '91747ae3d0.png'),
(23, 'Bộ trang sức Vàng 14K đính đá CZ PNJ 00132-00103', 10, 15, 'Thương hiệu:\r\nPNJ\r\n \r\nLoại đá chính:\r\nCZ\r\n \r\nMàu đá chính:\r\nTrắng\r\n \r\nHình dạng đá:\r\nTròn\r\n \r\nGiới tính:\r\nNữ\r\n \r\nDịp tặng quà:\r\nSinh nhật\r\nTình yêu\r\nNgày kỷ niệm\r\nCác dịp lễ tết\r\n \r\nQuà tặng cho người thân:\r\nCho Nàng\r\nCho Mẹ\r\n \r\nChủng loại:\r\nSản phẩm theo bộ', 1, '25659000', '2dd107916f.png'),
(24, 'Vòng Cổ Choker Da Pu Mặt Hình Mưa Sao Băng', 9, 16, 'choker đẹp giá rẻ', 1, '20000', 'c3728b63a0.jpg'),
(25, 'Phần Mềm Diệt Virus BKAV Profressional 12 Tháng - Hàng Chính Hãng', 8, 17, 'Ngăn chặn bị theo dõi bởi phần mềm gián điệp\r\nNgăn chặn đánh cắp tài khoản ngân hàng, đánh cắp mật khẩu\r\nQuét virus làm chậm máy\r\nSử dụng trí tuệ nhân tạo (AI), tích hợp công nghệ điện toán đám mây, bảo vệ đa lớp\r\nPhần Mềm Diệt Virus BKAV Profressional sử dụng Trí tuệ nhân tạo (AI) tổng hợp các dữ liệu được ghi nhận, phân tích và chỉ ra các mối nguy hiểm người sử dụng có thể gặp phải như bị xóa dữ liệu, bị theo dõi bởi phần mềm gián điệp hay bị mất cắp tài khoản… từ đó phát lệnh xử lý, ngăn chặn và tiêu diệt mã độc.\r\nBkav Pro Internet Security là phần mềm diệt virus tiên phong trong sử dụng công nghệ điện toán đám mây trong lĩnh vực bảo mật, là phần mềm tốt nhất do Hiệp hội An toàn thông tin Việt Nam bình chọn.\r\nBkav Pro được trang bị những công nghệ cao cấp, bảo vệ đa lớp, tự động phát hiện và tiêu diệt virus mà không cần cập nhật mẫu nhận diện mới.\r\nCác bản update được cập nhật liên tục từ máy chủ Bkav, đảm bảo phần mềm luôn có đầy đủ sức mạnh và tính năng mới nhất.\r\nSử dụng Bkav Pro giúp bảo vệ máy tính một cách toàn diện ngăn chặn các loại virus xóa dữ liệu, bị theo dõi bởi phần mềm gián điệp, bị đánh cắp tài khoản ngân hàng,…', 1, '194000', 'a4eaad81fa.png'),
(26, 'Áo khoác nữ Bomber bóng chày', 7, 18, 'ÁO KHOÁC NAM NỮ BOMBER BÓNG CHÀY NEW YORK XINH XẮN SIÊU HOT TREND', 1, '120000', '699ae3a451.png');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Chỉ mục cho bảng `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brandId`);

--
-- Chỉ mục cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`catId`);

--
-- Chỉ mục cho bảng `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Chỉ mục cho bảng `tbl_orderdetails`
--
ALTER TABLE `tbl_orderdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`productId`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brandId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `tbl_orderdetails`
--
ALTER TABLE `tbl_orderdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tbl_orderdetails`
--
ALTER TABLE `tbl_orderdetails`
  ADD CONSTRAINT `tbl_orderdetails_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `tbl_order` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_orderdetails_ibfk_4` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`productId`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

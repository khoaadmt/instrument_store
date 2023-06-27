-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 19, 2023 lúc 05:41 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `instrumentstore`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `productPrice` decimal(10,0) NOT NULL,
  `productImage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`id`, `userId`, `productId`, `qty`, `productName`, `productPrice`, `productImage`) VALUES
(40, 1, 6, 1, 'Essex EUP-123EA1', 230000000, '4c301f519e.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`) VALUES
(2, 'Piano', 1),
(4, 'Guitar', 1),
(5, 'Organ', 1),
(21, 'Sáo', 1),
(22, 'Ukulele', 1),
(23, 'Violin', 1),
(24, 'Kalimba', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `createdDate` date NOT NULL,
  `receivedDate` date DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `receiveAddress` varchar(255) NOT NULL,
  `SDT` varchar(11) NOT NULL,
  `receiveName` varchar(255) NOT NULL,
  `totalPrice` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `originalPrice` decimal(10,0) NOT NULL,
  `promotionPrice` decimal(10,0) NOT NULL,
  `image` varchar(50) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `createdDate` date NOT NULL,
  `cateId` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `des` varchar(1000) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `soldCount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `originalPrice`, `promotionPrice`, `image`, `createdBy`, `createdDate`, `cateId`, `qty`, `des`, `status`, `soldCount`) VALUES
(2, 'Kohler & Campbell KIG50D', 233000000, 220000000, '95548b09b3.jpg', 1, '0000-00-00', 2, 95, 'Với kích thước linh hoạt, giúp người chơi dễ dàng bố trí phù hợp cho mọi không gian. Giờ đây, người chơi sẽ không còn lo ngại với diện tích không gian chật hẹp. Từ phòng khách, sảnh nhà hàng, khách sạn,.. hay bất cứ đâu Kohler & Campbell KiG50D sẽ góp phần làm nổi bật không gian thêm phần sang trọng.', 1, 5),
(3, 'Kawai ND-21', 90500000, 85000000, '8d2e8819d7.jpg', 1, '0000-00-00', 2, 8, 'Đàn Piano Kawai ND-21 hiện thân cho vẻ đẹp của một cây Piano Acoustic ở phân khúc giá rẻ. Khoác bên ngoài vẻ đẹp sang trọng của một cây đàn upright piano.', 1, 2),
(4, 'Boston GP-156', 749000000, 749000000, 'a30bcd79d7.jpg', 1, '0000-00-00', 2, 18, 'Đàn piano Boston là một thương hiệu con của hãng Piano lừng danh Steinway & Sons, mang cùng một tiêu chuẩn xuất sắc của tất cả các công cụ được thiết kế bởi hãng này. GP-156 PE được thừa hưởng những thiết kế ưu việt của thương hiệu Steinway, mang âm sắc cổ điện với thiết kế tinh tế, đẹp và hiện đại.', 1, 2),
(5, 'Kohler & Campbell J310B', 98000000, 90000000, '109cc07e03.jpg', 1, '0000-00-00', 2, 6, 'Công ty Công nghiệp Kohler & Campbell, Inc đã được thành lập vào năm 1896 tại New York bởi 2 nhà đồng thời sáng lập là Charles Kohler và John Campbell. Campbell là một thợ máy đã phát minh ra một số máy chế biến gỗ và sắt và sau đó đã áp dụng vào việc chế tạo đàn piano.', 1, 4),
(6, 'Essex EUP-123EA1', 230000000, 230000000, '4c301f519e.jpg', 1, '0000-00-00', 2, 2, 'Piano Essex EUP-123E nổi bật với phong cách cổ điển, sang trọng. Cây đàn được thiết kế bởi thương hiệu Steinway & Sons, phối hợp với nhà thiết kế đồ nội thất nổi tiếng William Faber tạo nên sự đẳng cấp, tinh tế của cây đàn.aah', 1, 8),
(7, 'GUITAR YAMAHA CX40', 3190000, 3190000, 'd3ac08c33e.jpg', 1, '2021-12-07', 4, 7, 'Đàn Classic Guitar Yamaha CX40', 1, 3),
(8, 'Taylor 114E', 19000000, 19000000, 'cb50eef0d8.jpg', 1, '2021-12-07', 4, 5, 'Đàn guitar Taylor 114E là một dòng sản phẩm acoustic thuộc dòng series 1 của taylor với thiết kế độc đáo đó chính là khớp nối cần đàn và sử dụng gỗ sitka spruce tạo âm thanh vô cùng trong trẻo, sống động, giúp người chơi có thể cảm nhận được tốt hơn và đây cũng là ưu điểm nổi bật tạo lên sự thành công cho thương hiệu Taylor.', 1, 5),
(9, 'Takamine D2D', 4200000, 4200000, '758ded2800.jpg', 1, '2021-12-07', 4, 4, 'Đàn guitar Takamine D2D là sản phẩm nổi bật của thương hiệu Takamine Nhật Bản và được rất nhiều tín đồ săn đón trong thời gian gần đây. Không những mang đến một thiết kế dáng đàn đẹp mắt, vừa vặn với mọi dáng người mà âm thanh tuyệt vời mà bạn không thể chê vào đâu được.', 1, 6),
(10, 'Takamine ED2DCNAT', 6350000, 6200000, '1dfd0eec5c.jpg', 1, '2021-12-07', 4, 10, 'Đàn guitar Takamine ED2DCNAT là một sản phẩm được thiết kế hoàn hảo đến từng chi tiết với mặt đàn được làm từ gỗ Spruce, mặt sau và hông đàn được làm từ gỗ Mahogany, cùng hệ thống điện tử khuếch đại âm thanh để truyền tải âm thanh đến cho người nghe một cách rõ ràng và chân thật nhất.\r\n\r\nChắc hẳn, đây chính là cây đàn guitar tuyệt vời dành riên cho bạn, bất kể bạn là người mới học hay là người chơi đàn guitar có nhiều kinh nghiệm.', 1, 0),
(11, 'TAYLOR 150E 12 String', 21100000, 21100000, '9bc38b3364.jpg', 1, '2021-12-07', 4, 10, 'Đàn Guitar Taylor 150E 12 String là cây đàn acoustic sở hữu 12 dây đàn đã tạo ra âm thanh tốt, chuẩn xác, thiết kế độc đáo, tinh tế cùng với việc cân bằng ánh sáng octave sắc nét đã tạo ra tông màu tươi sáng, tốt và rõ ràng. Đây chắc hẳn là những tính năng nổi bật đã tạo nên sự khác biệt trong các loại đàn khác.', 1, 0),
(12, 'TAYLOR 214CE DLX', 34700000, 34700000, 'e235fe0bc6.jpg', 1, '2021-12-07', 4, 10, 'Đàn guitar Taylor 214CE DLX sở hữu thiết kế độc đáo với đường nét trên cơ thể mượt mà mang đến âm thanh trung thực, giai điệu rõ ràng và sử dụng chất liệu gỗ rosewood đem lại giai điệu tuyệt vời trong một loại nhạc cụ tuyệt đẹp.', 1, 0),
(13, 'Roland BK-9', 31000000, 31000000, 'bf843e62a9.jpg', 1, '2021-12-07', 5, 20, 'Đàn organ Roland BK-9 là công cụ hàng đầu mới trong loạt dòng BK nổi tiếng, mang lại âm thanh giật gân, nhịp điệu hàng đầu, và một lựa chọn đáng kinh ngạc của các tính năng cao cấp. Bạn có một thế giới âm nhạc dưới sự kiểm soát của ngón tay, với một lựa chọn âm thanh tuyệt vời - bao gồm âm thanh SuperNATURAL nổi tiếng của Roland - và một loạt các giai điệu đệm hoàn toàn remastered trong gần như mọi thể loại âm nhạc, từ cổ điển đến hiện đại.', 1, 0),
(14, 'Roland E-A7', 29000000, 29000000, 'd1a3f61f87.jpg', 1, '2021-12-07', 5, 14, 'Đàn organ Roland E-A7 là cây đàn cao cấp dùng để biểu diễn hoặc đi show với hơn 1.500 âm sắc nhạc cụ đến từ khắp nơi trên thế giới, 156 nút chuyên dụng để truy cập tức thì vào chức năng cho hiệu suất trình diễn mạnh mẽ.', 1, 1),
(15, 'Roland FA-06', 29500000, 29500000, '8f40bd6405.jpg', 1, '2021-12-07', 5, 10, 'Đàn organ Roland FA-06 là một sản phẩm cao cấp đến từ Roland với âm thanh tốt và nhiều tính năng hấp dẫn hỗ trợ người sử dụng để trình diễn trên sân khấu một cách xuất sắc nhất. Ngoài ra với thiết kế nhỏ gọn nên dễ dàng mang đi di chuyển để biểu diễn mà không lo cồng kềnh hư hỏng.', 1, 0),
(16, 'Roland FA-08', 44300000, 44300000, 'a12f8914dc.jpg', 1, '2021-12-07', 5, 10, 'Đàn organ Roland FA-08 sở hữu đầy đủ chức năng của một Music Workstation với thiết kế chắc chắn, tính linh hoat cao cùng với hiệu ứng Studio chất lượng cao, điều khiển thời gian thực, hỗ trợ chức năng Sampling và phát lại âm thanh ngay lập tức từ 16 mặt pad có trang bị đèn tín hiệu.', 1, 0),
(17, 'Roland AXSYNTH', 25100000, 25100000, '422b3a5da2.jpg', 1, '2021-12-07', 5, 18, 'Đàn organ Roland AXSYNTH mang một phong cách mới của Roland, với việc sử dụng âm thanh mạnh mẽ, phong cách solo mới nhất của Roland và có thể đeo lên vai thực hiện phần trình diễn được hiệu quả hơn trên sân khấu.', 1, 2),
(18, 'Roland GAIA SH-01', 14300000, 14300000, 'c43d221a7b.jpg', 1, '2021-12-07', 5, 5, 'Đàn organ Roland GAIA SH-01 cung cấp cho bạn một tấn hiệu ứng (reverb, biến dạng, lông tơ, tai nạn bit, flanger, phaser, pitch shifter, tăng thấp và trì hoãn) để khám phá âm những giới hạn âm thanh tuyệt vời, với những nút tính năng điều chỉnh dễ dàng mang lại sự sáng tạo vô biên của người chơi khi sử dụng cây đàn organ này.', 1, 0),
(25, 'TIÊU TRÚC VS5 HUN KHÓI – CHỐNG NỨT', 1050000, 1000000, '255f4b6f67.jpg', 1, '2023-06-19', 21, 25, 'Tiêu Trúc VS5 Hun Khói – Chống Nứt – Cây Tiêu Chơi chuyên nghiệp được Melody Mart chế tác dành riêng cho những nghệ sĩ muốn có một cây sáo hay xuất sắc, vang và trầm, đủ tiêu chuẩn để diễn với những dàn nhạc lớn.', 1, 0),
(31, 'SÁO BẦU NGỌC', 500000, 400000, 'bfab87f3c4.jpg', 1, '2023-06-19', 21, 25, 'Hình bên ngoài và kết cấu của Sáo Bầu rất đặc biệt, nó hoàn toàn là một quả bầu nguyên vẹn, cắm ba ống sáo và ba lưỡi gà kim loại lên quả bầu là thành Sáo Bầu. Đoạn cán quả bầu cắm ống sáo để thổi, thân bầu trở thành hộp âm của sáo, phần đáy quả bầu cắm ba ống sáo to nhỏ khác nhau, mỗi ống sáo gắn lưỡi gà bằng bạc hoặc bằng đồng, ống sáo giữa là to hơn cả, trên đó khoét bảy lỗ nhỏ, có thể thổi các giai điệu, hai ống sáo phụ chỉ có thể thổi hòa âm với cây sáo chính.\r\nCũng như các loại nhạc cụ sáo, âm lượng của nó tương đối nhỏ, song âm thanh của cây sáo chính rất êm dịu, dưới âm nền của hai cây sáo phụ, khiến người nghe có một cảm giác mang vẻ đẹp kín đáo, mông lung. Bởi vì âm thanh láy nền của nó mượt mà thướt tha như ̀ tiếng tơ lụa bay theo chiều gió, cho nên người ta còn gọi Sáo Bầu là “Sáo Bầu tơ”.\r\n\r\nDo sự khác biệt giữa các dân tộc ở các vùng khác nhau, cho nên hình dáng bên ngoài và phương pháp thổi Sáo Bầu của một số bà con dân tộc ', 1, 0),
(33, 'Đàn Ukulele Tenor BWS 26 inch B01-26', 600000, 600000, 'c05a085266.jpg', 1, '2023-06-19', 22, 15, 'Ukulele Tenor BWS là dòng Ukulele giá rẻ và được nhiều sự lựa chọn của khách hàng hiện nay, thiết kế nhỏ gọn và dây đàn nhẹ nên không chỉ người lớn mà ngay cả các bé thiếu nhi vẫn có thể chơi được.\r\nCó cấu tạo nhỏ gọn, nhẹ, tiện lợi, dễ dàng mang theo.Khi chơi, cảm giác âm thanh đàn rất ấm, vui tai.\r\nUkulele BWS là dòng đàn giá rẻ trên thị trường hiện nay kiểu dáng bên ngoài đẹp và giá thành hợp lý, đây là cây Ukulele phù hợp nhất ở khoảng giá.\r\nChất lượng bền tốt mẫu mẫu bắt mắt so với các sản phẩm cùng tầm giá. Màu gỗ vân sọc đặc trưng.', 1, 0),
(34, 'Đàn Ukulele Việt Nam Swallow Tenor UTMA1', 2799000, 2799000, '07aa32b0ac.jpg', 1, '2023-06-19', 22, 25, 'Đàn Ukulele Việt Nam Swallow Tenor UTMA1\r\n\r\n', 1, 0),
(36, 'Đàn Violin Cremona GCV V140 4/4', 4870000, 4000000, '00030bd92d.jpg', 1, '2023-06-19', 23, 23, 'Đàn Violin GCV V140 4/4', 1, 0),
(38, 'Đàn Kalimba Yael 17 Phím Gỗ Mahogany Y17M-U ', 400000, 269000, '2fa23edea8.jpg', 1, '2023-06-19', 24, 22, 'Đàn Kalimba Yael Y17M-U 100% chất liệu gỗ Mahigany nguyên tấm, cho chất lượng âm thanh trong trẻo, vang, thanh  tuyệt vời, mang lại cảm giác rất dễ chịu, thoải mái thư giản cho người nghe, chính vì vậy mà Kalimba được đánh giá là rất tốt cho việc cảm thụ Âm Nhạc của trẻ và các bạn mới chơi nhạc cụ  và giúp giảm stress do công việc học tập, có ích cho người mới học chơi Nhạc Cụ. nhỏ gọn tiện lợi dễ mang theo.\r\nThiết kế đàn Kalimba Yael 17 Phím Gỗ Mahogany Y17M-U với tone màu hồng  nổi bật , họa tiết vô cùng tỉ mỉ , các cạnh được nghệ nhân mài dũ tinh tế cho cảm giác cầm thoải mái nhất, kiểu dáng chắc chắn , bền, sang chảnh. hình các nhân vật cực kì dễ thương.\r\n', 1, 0),
(39, 'Đàn Kalimba Yael 17 Phím Gỗ Trúc Y17B-F ', 400000, 319000, 'e1c153cd9d.jpg', 1, '2023-06-19', 24, 36, 'Đàn Kalimba Yael Y17B-F cho giai điệu mềm mại, trong vang. Là loại nhạc cụ rất thú vị, dễ chơi và nhỏ gọn dễ dàng mang đi bất kì đâu\r\nSố phím: 17, \r\nTone: C chất liệu gỗ, bàn phím được sản xuất theo công thức độc quyền khi chỏi cho ra âm thanh trong, sáng, vang, ít tạp âm.', 1, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Normal');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `address` varchar(500) NOT NULL,
  `isConfirmed` tinyint(4) NOT NULL DEFAULT 0,
  `captcha` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `email`, `fullname`, `dob`, `password`, `role_id`, `status`, `address`, `isConfirmed`, `captcha`) VALUES
(1, 'admin@gmail.com', 'Nhóm 5', '2021-11-01', 'e10adc3949ba59abbe56e057f20f883e', 1, 1, '', 1, ''),
(31, 'lapankhuongnguyen@gmail.com', 'khuong nguyen', '2021-12-06', 'c4ca4238a0b923820dcc509a6f75849b', 2, 1, 'CanTho', 1, '56661');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`userId`),
  ADD KEY `product_id` (`productId`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`userId`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`orderId`),
  ADD KEY `product_id` (`productId`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cate_id` (`cateId`);

--
-- Chỉ mục cho bảng `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT cho bảng `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`orderId`) REFERENCES `orders` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cateId`) REFERENCES `categories` (`id`);

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

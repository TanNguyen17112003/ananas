-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3307
-- Thời gian đã tạo: Th12 06, 2023 lúc 11:45 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ltwdb`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `password`, `name`, `role`, `updated_at`) VALUES
(1, 'admin@hcmut.edu.vn', '$2y$10$.8c8OEDgbHEUM6lmB.mJk.vppsTxRyAvHcogQbjAvD/btY1Sr3NnW', 'Admin', 1, '2023-11-29 17:05:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Trà Đài Loan'),
(2, 'Trà Latte'),
(3, 'Trà chanh'),
(4, 'Trà sữa'),
(5, 'Trà Yakult');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` varchar(2000) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `contact`
--

INSERT INTO `contact` (`id`, `username`, `email`, `message`, `status`, `created_at`) VALUES
(9, 'Nguyễn Duy Tùng', 'tung.nguyen2k3hcmut@hcmut.edu.vn', 'Website rất tốt!', 0, '2023-12-06 02:12:55'),
(10, 'Lê Quang Hiển', 'hienlq16103@gmail.com', 'Nước gì mà ngon thế không biết nữa!', 0, '2023-12-06 04:59:16'),
(11, 'Nguyễn Đức Bình', 'binh.nguyenhelloworld@hcmut.edu.vn', 'Nhân viên quá xinh gái, nước rất ngon, 10 điểm không có nhưng!', 0, '2023-12-06 05:00:27'),
(12, 'Nguyễn Duy Tùng', 'tungxenga7@gmail.com', 'dffsd', 0, '2023-12-06 07:21:42');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_method` varchar(50) NOT NULL DEFAULT 'Tiền mặt khi nhận hàng',
  `payment` bigint(20) NOT NULL,
  `address_receiver` varchar(50) NOT NULL,
  `phone_receiver` varchar(50) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('Đang xử lý','Đang giao','Đã giao') NOT NULL DEFAULT 'Đang xử lý',
  `name_receiver` varchar(50) NOT NULL DEFAULT 'Đang xử lý'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order`
--

INSERT INTO `order` (`order_id`, `user_id`, `payment_method`, `payment`, `address_receiver`, `phone_receiver`, `updated_at`, `status`, `name_receiver`) VALUES
(23, 50, 'Tiền mặt khi nhận hàng', 95000, 'KTX Khu B, ĐHQG - TP. HCM', '0354304095', '2023-12-06 07:31:30', 'Đã giao', 'Nguyen Duy Tung'),
(24, 49, 'Tiền mặt khi nhận hàng', 57000, 'KTX Khu B, ĐHQG - TP. HCM', '0359110455', '2023-12-06 07:13:05', 'Đã giao', 'Lê Quang Hiển'),
(26, 51, 'Tiền mặt khi nhận hàng', 67000, 'KTX Khu A, ĐHQG - TP. HCM', '0359110455', '2023-12-06 07:40:47', 'Đang xử lý', 'Nguyen Duy Tung');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_item`
--

CREATE TABLE `order_item` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity_item` bigint(20) NOT NULL DEFAULT 1,
  `price` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_item`
--

INSERT INTO `order_item` (`order_id`, `product_id`, `quantity_item`, `price`) VALUES
(23, 10, 1, 19000),
(23, 26, 4, 19000),
(24, 18, 2, 19000),
(24, 23, 1, 19000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `content` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `post`
--

INSERT INTO `post` (`post_id`, `title`, `content`, `updated_at`, `image`) VALUES
(1, 'Nụ cười tràn đầy hy vọng', 'phá cỗ nhộn nhịp tùng dinh tùng phách. Đây cũng là dịp để gia đình sum vầy, trao nhau những món quà ý nghĩa. Tuy nhiên, không phải ai cũng có may mắn để trải qua một mùa trung thu thật trọn vẹn.\r\n\r\nNhìn vào hoàn cảnh khó khăn của các bé mồ côi, trẻ em bỏ rơi hay các em nhỏ sinh sống tại mái ấm Chùa Kỳ Quang và mái ấm Ánh Sáng, Hồng Trà Ngô Gia đã tổ chức một buổi ghé thăm phát quà trung thu để mang niềm vui đến cho các em vào ngày lễ đặc biệt này.', '2023-11-17 12:54:52', 'https://wujiateavn.com/files/upload2/files/Untitled-5.jpg'),
(2, 'CÔNG BỐ KẾT QUẢ KHÁCH HÀNG TRÚNG THƯỞNG | VÒNG QUAY MAY MẮN', 'Chúng ta đã cùng nhau tìm ra các khách hàng may mắn nhận được giải thưởng trong chương trình “Vòng Quay May Mắn”. Như vậy là các phần quà cũng đã tìm được chủ sở hữu của mình rồi., Hồng Trà Ngô Gia xin chúc mừng tất cả các bạn trúng thưởng, các bạn chưa may mắn trong lần này cũng đừng buồn nhen, hãy cùng Hồng Trà Ngô Gia đón chờ những chương trình tiếp theo nhé! \r\n\r\nDanh sách khách hàng may mắn nhận được giải thưởng sau:\r\n\r\n03 giải Nhất: Iphone 14 Promax 256G\r\n03 giải Nhì: Xe điện PEGA\r\n05 giải Ba: Loa Bluetooth JBL\r\n08 giải Tư: Nước hoa Chanel\r\n100 giải Năm: Hộp quà tặng Ngô Gia\r\nGiải Khuyến khích: dành tặng cho tất cả khách hàng', '2023-11-17 12:57:24', 'https://wujiateavn.com/files/upload2/files/gi%E1%BA%A3i%20nh%E1%BA%A5t%201.jpg'),
(3, 'THỬ HƯƠNG VỊ MỚI - RINH IPHONE 14 PROMAX VỀ NHÀ', 'Nhằm tri ân Fan của Hồng Trà Ngô Gia trong suốt những năm qua đã và luôn đồng hành, yêu quý Hồng Trà Ngô Gia. Hồng Trà Ngô Gia dành tặng cơn bão “thay mới dế yêu” với phần thưởng Iphone 14 Promax, Xe Máy Điện PEGA,... và nhiều phần quà hấp dẫn khác đang đợi Fan rinh về nhà.\r\nCơn bão thay mới “dế yêu” đang được diễn ra từ ngày 15/7/2023 đến hết 15/8/2023. Ngoài quà tặng là những chiếc Iphone 14 Promax 256GB, Hồng Trà Ngô Gia còn chuẩn bị nhiều phần quà hấp dẫn khác như: Xe Máy Điện PEGA, Loa Bluetooth JBL, Nước hoa Chanel,... khi khách hàng mua 1 trong 5 thức uống mới nằm trong chương trình ưu đãi, khách hàng sẽ nhận được 1 vòng bọc ly kèm phiếu cào trên mỗi ly thức uống. Và khi khách hàng sưu tầm đủ 9 kiểu vòng bọc ly khác nhau, khách hàng sẽ có cơ hội tham gia thay mới “dế yêu” và nhiều phần quà hấp dẫn khác.\r\nKhông dừng lại ở những quà tặng xịn sò trên, Hồng Trà Ngô Gia còn tặng kèm bộ lắp ráp Lego trên mỗi ly thức uống, nằm trong chương chương ưu đãi. Trên mỗi vòng bọc ly sẽ có kèm theo phiếu cào, khách hàng chỉ cần xé phiếu cào để đổi thưởng Lego trực tiếp tại quán. Một tin chấn động hơn, kích thước Lego có thể lên đến cực đại. Vậy nên Fan ơi, đừng bỏ qua cơ hội “thử hương vị mới - rinh quà tặng về nhà” nhé!\r\nCÁCH THỨC THAM GIA\r\n\r\nBước 1: Order 1 trong 5 ly thức uống mới để nhận vòng bọc ly kèm thẻ cào, gồm:\r\n\r\n- Trà Sữa Ba Anh Em\r\n\r\n- Aiyu Hồng Trà Kem Tươi Hoàng Kim\r\n\r\n- Sữa Dâu Tây Trân Châu Trắng\r\n\r\n- Bát Bảo Ngô Gia\r\n\r\n- Chè Sương Sáo Nước Cốt Dừa\r\n\r\nTrên mỗi ly thức uống trên, khách hàng sẽ nhận được 01 vòng bọc ly kèm thẻ cào. \r\nBước 2: Fan nhớ xé phần thẻ cào và cào đổi Lego trực tiếp tại cửa hàng. Giữ lại Vòng bọc ly.\r\nLưu ý: Thẻ cào 100% trúng Lego, Fan nhớ đổi trực tiếp tại cửa hàng nhé!\r\n\r\nBước 3: Fan sưu tầm đủ 9 kiểu vòng bọc ly khác nhau, sau đó đến cửa hàng điền thông tin phiếu “bốc thăm trúng thưởng”. Fan nhớ gửi “phiếu bốc thăm trúng thưởng” kèm 9 kiểu vòng bọc ly về cho Ngô Gia nhé!\r\nCƠ CẤU GIẢI THƯƠNG\r\n\r\nGiải nhất: 03 Iphone 14 pro max\r\n\r\nGiải nhì: 03 Xe điện PEGA\r\n\r\nGiải ba: 05 Loa Bluetooth JBL\r\n\r\nGiải tư: 08 chai Nước hoa Chanel\r\n\r\nGiải năm: 100 Hộp quà tặng Ngô Gia\r\n\r\nGiải khuyến khích: 2200 phiếu giảm giá 5.000đ\r\n\r\nKết quả được công bố trực tiếp trên sóng Livestream của Ngô Gia.', '2023-11-17 12:59:27', 'https://wujiateavn.com/files/upload2/files/1200X1200.jpg'),
(4, 'HỒNG TRÀ NGÔ GIA ĐẠT DANH HIỆU GIẢI THƯỞNG HƯƠNG VỊ XUẤT SẮC ITQI', 'Hồng Trà Ngô Gia là một thương hiệu trà nổi tiếng tại Việt Nam và có xuất xứ từ Đài Loan, được thành lập từ năm 1995. Với hơn 25 năm kinh nghiệm trong việc sản xuất và phân phối trà, Hồng Trà Ngô Gia đã trở thành một trong những thương hiệu trà hàng đầu tại Đài Loan. Trà của Hồng Trà Ngô Gia được sản xuất từ những lá trà tươi ngon, được thu hái từ các vùng trồng trà nổi tiếng. Nhờ sử dụng các nguyên liệu chất lượng cao và quy trình sản xuất hiện đại, trà của Hồng Trà Ngô Gia luôn đảm bảo độ tươi mới và hương vị nồng nàn đặc trưng của vị trà truyền thống của Đài Loan. \r\nHồng trà Ngô Gia là một trong những loại trà nổi tiếng của Đài Loan, được sản xuất tinh túy từ những lá trà tươi ngon nhất. Với quy trình chế biến đặc biệt cùng công nghệ tiên tiến, Hồng Trà Ngô Gia đã đạt được danh hiệu giải thưởng hương vị xuất sắc iTQi do Viện Thẩm định Hương vị Quốc Tế (International Taste & Quality Institute) tại Brussels, Bỉ.\r\n\r\n \r\n\r\nĐược biết đến là một trong những giải thưởng có uy tín nhất thế giới trong lĩnh vực đánh giá sản phẩm ăn uống, giải thưởng iTQi chỉ được trao cho các sản phẩm có chất lượng đỉnh cao và đạt chuẩn hương vị tuyệt vời. Với danh hiệu này, Hồng Trà Ngô Gia đã khẳng định vị trí của mình trong thị trường trà quốc tế và được rất nhiều người tiêu dùng tin tưởng sử dụng hàng ngày.\r\n\r\nHồng trà Ngô Gia có màu sắc đỏ nâu huyền thoại, hương thơm đậm đà ngọt ngào, vị đắng thanh mát, giúp làm dịu cảm giác mệt mỏi và tạo ra một trạng thái thư giãn cho người sử dụng. Cùng với độ tinh khiết cao và hương vị đặc biệt, Hồng Trà Ngô Gia đang trở thành lựa chọn yêu thích của rất nhiều người trên thế giới.', '2023-11-17 13:00:20', 'https://wujiateavn.com/files/upload2/images/z4280613958518_0ed7dc93b8774d9ae5d6cbaf41b459b6.jpg'),
(5, 'HỒNG TRÀ KEM TƯƠI | SỰ KẾT HỢP HOÀN HẢO GIỮA TRÀ VÀ KEM TƯƠI', 'HỒNG TRÀ KEM TƯƠI | SỰ KẾT HỢP HOÀN HẢO GIỮA TRÀ VÀ KEM TƯƠI\r\nHồng Trà Kem Tươi đây là một thức uống mới đầy hấp dẫn, được pha trộn tinh tế từ trà đen và kem tươi ngon tuyệt.\r\n\r\n\r\nTừ lâu, trà là một thức uống được yêu thích bởi nhiều người vì sự thanh mát, thư giãn và tác dụng tốt cho sức khỏe. Và gần đây, xu hướng uống trà kết hợp với kem tươi đang ngày càng trở nên phổ biến tại giới trẻ ở Việt Nam. Và hôm nay, chúng tôi xin giới thiệu đến bạn một loại thức uống mới - Hồng Trà Kem Tươi - một sự kết hợp hoàn hảo giữa trà đen và kem tươi.\r\n\r\nHồng Trà Kem Tươi là một trong những thức uống được yêu thích của Hồng Trà Ngô Gia tại Đài Loan và hôm nay đã chính thức được mở bán tại Việt Nam. Được chế biến từ lá trà tươi và kem tươi ngon miệng, sản phẩm này mang đến cho người dùng một trải nghiệm mới lạ và đầy hấp dẫn.\r\n\r\nVới hương vị nhẹ nhàng của trà đen và vị béo ngậy của kem tươi, Hồng Trà Kem Tươi sẽ khiến bạn thích thú ngay từ lần đầu tiên thưởng thức. Không những thế, sản phẩm còn được bổ sung thêm các thành phần tự nhiên tốt cho sức khỏe như đường và sữa tươi, giúp tăng cường hương vị và dinh dưỡng.\r\n\r\nHồng Trà Kem Tươi có hương vị đậm đà, mạnh mẽ từ trà đen, cùng vị ngọt mát, béo ngậy từ kem tươi. Thưởng thức Hồng Trà Kem Tươi, bạn sẽ cảm nhận được sự kết hợp hoàn hảo giữa hương vị truyền thống của trà đen chuẩn Đài Loan và vị béo ngậy của kem tươi. Bạn có thể thưởng thức sản phẩm này vào bất kỳ thời điểm nào trong ngày, từ buổi sáng để bắt đầu một ngày mới đầy năng lượng đến buổi tối để thư giãn sau một ngày làm việc mệt mỏi.\r\n\r\nNgoài ra, Hồng Trà Kem Tươi còn là một lựa chọn tuyệt vời cho các buổi họp mặt gia đình, bạn bè hoặc các sự kiện đặc biệt. Sản phẩm này sẽ khiến buổi họp mặt của bạn thêm phần thú vị. Với chất lượng tốt và giá cả phải chăng, Hồng Trà Kem Tươi đang trở thành một thức uống được yêu thích và được nhiều người lựa chọn. Chúng tôi hy vọng rằng sản phẩm này sẽ mang đến cho bạn những trải nghiệm thú vị và tuyệt vời nhất.', '2023-11-17 13:08:45', 'https://wujiateavn.com/files/upload2/images/Image_20230519095555.jpg'),
(6, 'SỮA DÂU TÂY | SẢN PHẨM MỚI CỦA HỒNG TRÀ NGÔ GIA NHƯ THẾ NÀO', 'Sữa dâu tây! Đây là một thức uống mới và đầy cảm hứng, được làm từ sữa tươi nguyên chất kết hợp với dâu tây đỏ ngọt ngào, tươi ngon. Bạn sẽ được trải nghiệm hương vị tuyệt vời của sự ngọt ngào và thơm ngon từ cả sữa và dâu tây.\r\n\r\nSữa dâu tây không chỉ thơm ngon mà còn giàu dinh dưỡng, chứa nhiều chất béo và protein cần thiết cho cơ thể. Thức uống này có thể đóng vai trò là thức uống bổ sung dinh dưỡng, giúp tăng cường sức khỏe và tăng cường động lượng cho cơ thể.\r\n\r\nSữa dâu tây là sự lựa chọn tuyệt vời cho tất cả các đối tượng từ trẻ em đến người lớn tuổi. Ngoài ra, Sữa Dâu Tây không làm từ trà nên sẽ không ảnh hướng đến giấc ngủ của bạn. Vì vậy nếu bạn đang tìm kiếm một loại thức uống mới lạ, thơm ngon và giàu dinh dưỡng, hãy đến với chúng tôi để trải nghiệm hương vị tuyệt vời của sữa dâu tây.', '2023-11-17 13:09:17', 'https://wujiateavn.com/files/upload2/files/Image_20230407150503.jpg'),
(7, 'MỪNG NGÀY 8 THÁNG 3 – HỒNG TRÀ NGÔ GIA GỬI TẶNG MÓN QUÀ TUYỆT VỜI CHO PHÁI ĐẸP', 'Nhân dịp kỷ niệm Ngày Quốc tế Phụ nữ 8 tháng 3, Hồng Trà Ngô Gia xin gửi đến quý khách hàng một chương trình đặc biệt và ý nghĩa. Trong ngày 8/3, khi quý khách nữ đến bất kỳ chi nhánh nào của Hồng Trà Ngô Gia và đặt một món đồ uống bất kỳ trong menu, sẽ được tặng kèm một cái Pudding Socola ngon tuyệt để thưởng thức.\r\n\r\nLà một trong những món Topping vừa được cho ra mắt gần đây tại Hồng Trà Ngô Gia, pudding socola đem lại hương vị ngọt ngào, hấp dẫn và rất thích hợp để làm quà tặng cho người phụ nữ thân yêu nhân dịp 8/3.\r\n\r\nHồng Trà Ngô Gia hy vọng rằng chương trình này sẽ giúp quý khách hàng thưởng thức những món ngon cùng không khí rộn ràng, ấm áp trong ngày 8/3.\r\n\r\nHãy đến Hồng Trà Ngô Gia để tận hưởng chương trình ưu đãi này và gửi lời chúc tốt đẹp đến người phụ nữ yêu thương của mình nhé!\r\n\r\nĐiều kiện áp dụng chương trình:\r\n\r\nÁp dụng khi mua hàng trực tiếp tại cửa hàng\r\nÁp dụng khi khách hàng nữ mua một đồ uống bất kỳ kèm Like và Comment bài viết trên Fanpage với nội dung “Vẫn là Hồng Trà Ngô Gia uống ngon nhất”\r\nThời gian diễn ra duy nhất trong ngày 08/03/2023', '2023-11-17 13:09:45', 'https://wujiateavn.com/files/upload2/files/h%C3%ACnh%207-3.jpg'),
(8, 'GRAND OPENING LINH ĐÔNG THỦ ĐỨC', 'Bắt đầu từ ngày 26/11 Hồng Trà Ngô Gia mời bạn đến tân gia chi nhánh mới tại 98B Linh Đông, Phường Linh Đông, Thủ Đức nà\r\n\r\nSiêu Ưu Đãi\r\n\r\nMUA 1 TẶNG 1 đến hết ngày 28/11/2022\r\nhương trình chỉ áp dụng tại cửa hàng đang khai trương\r\n\r\nMua 1 tặng 1 áp dụng trên toàn menu\r\n\r\nKhông áp dụng giao hàng và các chương trình khuyến mãi đang hoạt động khác.', '2023-11-17 13:10:23', 'https://wujiateavn.com/files/upload2/images/%E5%B8%A4%E6%A2%93%E6%9E%99-1.jpg'),
(9, 'TẬN HƯỞNG HƯƠNG VỊ MỚI CÙNG TRÀ SỮA SOCOLA VÀ TRÀ CHANH LÁ DỨA', 'Theo bạn thì hai món này kết hợp với Topping nào sẽ là tuyệt nhất? Cùng nhau chia sẻ kinh nghiệm ăn uống để mọi cùng tham khảo và thưởng thức thử nà!\r\n\r\nĐừng có quên nắm tay kéo vai đứa bạn thân đi cùng đó nha! Tag ngay hội bạn cùng đam mê vào hóng đi nà các bạn ơiiii', '2023-11-17 13:11:01', 'https://wujiateavn.com/files/upload2/images/ok-min.gif'),
(10, 'BẠN THỨC KHUYA SĂN SALE SỘP PEE CÒN TUI SĂN SALE HỒNG TRÀ NGÔ GIA', 'Chương trình chỉ áp dụng tại cửa hàng đang khai trương\r\n\r\nMua 1 tặng 1 áp dụng trên toàn menu\r\n\r\nKhông áp dụng giao hàng và các chương trình khuyến mãi đang hoạt động khác.\r\n\r\n-------\r\n\r\nTỚI QUẨY VỚI CHÚNG MÌNH NHOO CÁC BẠN OI\r\n\r\nĐịa chỉ :  763 Nguyễn Ảnh Thủ,P Trung Mỹ Tây, Q12\r\nHãy @tag thêm vài người bạn thân iu dấu của mình để nhận thêm nhiều ưu đãi nhaaa\r\n\r\n------\r\n\r\nWebsite: https://wujiateavn.com/\r\n\r\n#HongTraNgoGia\r\n\r\n#trasuadailoan\r\n\r\n#GrandOpening\r\n\r\n#NguyễnẢnhThủ\r\n\r\n#PhườngTrungMỹTây\r\n\r\n#Quận12\r\n', '2023-11-17 13:12:42', 'https://wujiateavn.com/files/upload/files/test.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `images` varchar(100) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` bigint(20) NOT NULL,
  `price_sale` bigint(20) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`product_id`, `name`, `category_id`, `description`, `images`, `quantity`, `price`, `price_sale`, `timestamp`) VALUES
(2, 'Trà bí đao Ngô Gia', 1, 'Trà bí đao là thức uống có thể giúp bạn giảm cân và thanh nhiệt cho cơ thể. Một ly trà bí đao vào ngày hè sẽ giúp bổ sung vitamin và lấy lại năng lượng.\r\n<ul>\r\n<li>Thanh lọc cơ thể, điều trị táo bón, nóng trong người.</li>\r\n<li>Giải nhiệt cơ thể và mang lại sự trẻ trung, rạng ngời cho làn da.</li>\r\n<li>Uống trà bí đao trước bữa ăn sẽ làm giảm cảm giác thèm ăn,  tránh việc hấp thụ các chất béo và tinh bột không cần thiết.</li>\r\n</ul>', 'tra-bi-dao-ngo-gia-q38efry9 (2).jpg', 10, 39000, 19000, '2023-11-30 00:10:48'),
(3, 'Hồng trà vải thiều', 1, 'Hồng Trà Vải thiều là sự kết hợp giữa hồng trà và vải thiều, nước trà có vị chát, vải thiều to tròn, căng mọng nước. Hồng trà không chỉ là một loại thức uống thơm ngon mà nó còn mang lại cho chúng ta nhiều công dụng rất tốt cho sức khỏe.\r\n<br>\r\nUống Hồng Trà Vải thiều giúp cải thiện sức khỏe tim mạch, hỗ trợ tiêu hóa và giúp giảm cân vì trong trà có chứa vitamin C làm kích thích quá trình trao đổi chất và đốt cháy lượng mỡ thừa nhanh hơn.\r\n\r\n\r\n', 'hong-tra-vai-thieu-2isu3y9o (2).jpg', 10, 39000, 19000, '2023-11-30 00:15:00'),
(4, 'Trà xanh hoa nhài', 1, 'Trà xanh hoa nhài với hương vị tự nhiên, thuần khiết.\r\n<ul>\r\n<li>Hỗ trợ giảm cân hiệu quả, Cải thiện làn da tươi trẻ mỗi ngày</li>\r\n<li>Chống oxy hóa cơ thể hằng ngày</li>\r\n<li>Điều hòa đường máu và Cân bằng đường huyết và huyết áp</li>\r\n<li>Giúp ngủ ngon sâu giấc hơn, cải thiện tình trạng mất ngủ</li>\r\n<li>Giúp giảm stress, lo âu…</li>\r\n<li>Dự phòng nguy cơ bị cảm lạnh, cúm</li>\r\n<ul>', 'tra-xanh-hoa-nhai-f2vkxmvu (2).jpg', 10, 39000, 19000, '2023-11-30 00:21:14'),
(5, 'Trà xanh bí đao', 1, 'là sự kết hợp giữa hợp hương vị chát nhẹ cùng với cảm giác tươi mát, sảng khoái của bí đao. Trà xanh bí đao mang lại một trải nghiệm vô cùng tươi mới.', 'tra-xanh-bi-dao-t9gm7g3c (2).jpg', 10, 39000, 19000, '2023-11-30 00:28:27'),
(6, 'Hồng trà bí đao', 1, 'Là sự hòa quyện của hồng trà và bí đao, thức uống hồng trà bí đao mang hương vị thơm nhẹ, ít chát hòa quyện với sự thanh mát của của bí đao.', 'hong-tra-bi-dao-sccrscoa (2).jpg', 10, 39000, 19000, '2023-11-30 00:30:26'),
(7, 'Trà sương sáo', 1, 'Trà sương sáo là loại trà đặc biệt được chế biến từ lá trà tươi và sương sáo tự nhiên mang đến hương vị thơm ngon thanh mát và tinh tế.', 'tra-suong-sao-4sm5ysso (2).png', 10, 39000, 19000, '2023-11-30 01:42:03'),
(8, 'Bí đao sương sáo', 1, 'Trà bí đao sương sáo là một loại nước giải khát thanh nhiệt. Được nhiều yêu thích bởi hương vị thơm ngon. Đây là một loại thức uống giải nhiệt tuyệt vời, thơm ngon tốt cho sức khỏe.\r\n', 'bi-dao-suong-sao-qb2cpm44 (2).png', 10, 39000, 19000, '2023-11-30 00:55:21'),
(9, 'Sương sáo latte', 2, 'Món Sương Sáo Latte không làm bạn mê nhưng đem lại cảm giác dễ chịu.<br>\r\nNguyên liệu đến từ thảo mộc thiên nhiên tạo nên một thức uống giải khát hiệu quả, kết hợp vị thơm béo của sữa tươi rất healthy và balance. Để thưởng thức trọn vẹn bạn nhớ khuấy đều cho hòa quyện vào nhau nhé! ', 'suong-sao-latte-as9ofqbf (2).png', 20, 39000, 16000, '2023-11-30 00:56:18'),
(10, 'Trân châu đường đen latte', 2, 'Trân châu đường đen latte - một sự kết hợp hài hòa giữa cà phê, sữa và đường đen.\r\n<br>\r\nKhi ngửi sẽ thấy ngay mùi thơm thoang thoảng của cà phê. Nhấp môi một chút thì sẽ nếm được vị ngọt thơm đúng chuẩn hương vị đường đen, xen vào đó là độ béo của sữa càng làm tăng thêm sự quyến rũ của loại latte này.', 'sua-tuoi-tran-chau-duong-den-5stas08q (2).jpg', 10, 39000, 19000, '2023-11-30 01:29:20'),
(11, 'Trà xanh latte', 2, 'Trà xanh Latte là món uống kết hợp giữa trà xanh và sữa tươi. Không lạnh băng như trà xanh đá xay, cũng không quá ngậy béo như trà xanh phủ kem tươi, Trà xanh Latte có vị ngon rất riêng. Không quá ngọt, không ngậy béo mà đậm hương thơm của trà, hấp dẫn với vị của sữa, đây chính là món uống hoàn hảo cho các tín đồ của trà xanh.', 'tra-xanh-latte-lbm6ltnr (2).jpg', 10, 39000, 19000, '2023-11-30 01:30:20'),
(12, 'Hồng trà latte vải thiều', 2, 'Sự kết hợp hài hòa giữa hồng trà, cafe latte và hương vị vải tự nhiên.', 'hong-tra-latte-vai-thieu-w3lcixhg (2).jpg', 10, 39000, 19000, '2023-11-30 01:32:37'),
(13, 'Bí đao latte', 2, 'Sự hòa quyện giữa latte và hương vị thanh mát của bí đao.', 'bi-dao-latte-dmzbutlw (2).jpg', 10, 239000, 19000, '2023-11-30 01:33:38'),
(14, 'Hồng trà latte Đài Loan', 2, 'Latte truyền thống vốn được làm từ cà phê, sữa tươi và bọt sữa nay kết hợp với Hồng trà mang hương thơm thanh mát, ngọt nhẹ sẽ làm ngây ngất những ai yêu trà và thức uống latte.', 'hong-tra-latte-dai-loan-kvmyjjtc (2).jpg', 10, 239000, 19000, '2023-11-30 01:36:31'),
(15, 'Trà xanh chanh', 3, 'Trà xanh kết hợp với chanh không chỉ tạo thành thức uống giải khát có vị thanh mát, chua dịu mà còn mang lại nhiều lợi ích cho sức khỏe của bạn.', 'tra-xanh-chanh-tolzbxkm (2).jpg', 10, 239000, 19000, '2023-11-30 01:37:37'),
(16, 'Hồng trà chanh vải thiều', 3, 'Hồng trà chanh với hương vị ngọt nhẹ của vải thiều.', 'hong-tra-chanh-vai-thieu-zlk6nqui (2).jpg', 10, 239000, 19000, '2023-11-30 01:38:44'),
(17, 'Trà chanh bí đao', 3, 'Trà chanh bí đao là sự kết hợp độc đáo giữa vị chát mà thanh của trà oolong cùng với vị chua chua của chanh và mùi thơm của vị bí đao mang đến cho bạn cảm giác mới lạ.', 'tra-xanh-bi-dao-t9gm7g3c (2).jpg', 10, 239000, 19000, '2023-11-30 01:39:38'),
(18, 'Trà sữa sương sáo', 4, 'Trà sữa sương sáo là một món trà sữa thanh mát, giúp giải nhiệt tuyệt vời trong những ngày hè nắng nóng.\r\n<br>\r\nLy trà sương sáo có mùi vị thơm ngon, tuyệt hảo. Hương vị ngọt thanh từ sữa đặc, béo ngậy, cộng thêm hương thơm ngát từ trà Ô Long và một chút dai dai từ sương sáo.', 'tra-sua-suong-sao-laessvwl (2).png', 10, 239000, 19000, '2023-11-30 01:41:06'),
(19, 'Trà xanh sữa', 4, 'Trà xanh sữa có vị trà xanh nhẹ nhàng kết hợp với sữa động vật, và cuối cùng là vị sữa đặc ngọt ngào', 'tra-xanh-sua-efbubhnb (2).jpg', 10, 239000, 19000, '2023-11-30 01:44:47'),
(20, 'Trà sữa vải thiều', 4, 'Trà sữa vải thiều mang đến một hương vị độc lạ cho những tín đồ đam mê trà sữa.', 'tra-sua-vai-thieu-mcpbo5wd (2).jpg', 10, 239000, 19000, '2023-11-30 01:45:56'),
(21, 'Trà sữa bí đao', 4, 'Trà sữa bí đao có hương vị vừa thơm ngậy vừa sảng khoái, có công dụng tuyệt vời với khả năng thanh nhiệt cơ thể.', 'tra-sua-bi-dao-qxo9y6dn (2).jpg', 10, 239000, 19000, '2023-11-30 01:47:48'),
(22, 'Trà sữa Đài Loan', 4, 'Trà sữa Đài Loan với hương vị truyền thống.', 'tra-sua-dai-loan-qlgi7h4z (2).jpg', 10, 239000, 19000, '2023-11-30 01:48:49'),
(23, 'Trà xanh Yakult', 5, 'Trà xanh yakult với hương vị thanh mát, chát nhẹ. Giúp giải nhiệt cơ thể và tăng cường hệ tiêu hóa.', 'tra-xanh-yakult-ciiwdu3q (2).jpg', 10, 239000, 19000, '2023-12-05 02:32:24'),
(24, 'Hồng trà Yakult', 5, 'Hương vị hồng trà truyền thông được làm mới bằng vị ngọt nhẹ của sữa chua uống yakult.', 'hong-tra-yakult-dai-loan-71tovysw (2).jpg', 10, 239000, 19000, '2023-12-05 02:32:30'),
(25, 'Bí đao Yakult Ngô Gia', 5, 'Bí đao yakult Ngô Gia - Bí đao thanh mát hòa quyện với yakult dịu ngọt, vừa giải nhiệt cơ thể vừa tăng cường hệ tiêu hóa.', 'bi-dao-yakult-ngo-gia-des0qgwx (2).jpg', 10, 239000, 19000, '2023-12-05 02:32:34'),
(26, 'Hồng trà Yakult Đài Loan', 5, 'Hồng trà yakult Đài Loan', 'hong-tra-yakult-vai-thieu-p2eqjjyy (2).jpg', 10, 239000, 19000, '2023-12-05 02:32:39');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL DEFAULT '',
  `content` text DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `avatar` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `verify_code` int(11) DEFAULT NULL,
  `active` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `name`, `avatar`, `phone`, `address`, `updated_at`, `verify_code`, `active`) VALUES
(49, 'hienlq16103@gmail.com', '$2y$10$o4HezDuYzhrAqrFWTl7.aOmoPOa3EBlOK1wi6ZkBX2iivk25vANOy', 'Lê Quang Hiển', NULL, '0359110455', 'KTX Khu B, ĐHQG - TP. HCM', '2023-12-05 03:10:46', 359032, b'1'),
(50, 'tung.nguyen2k3hcmut@hcmut.edu.vn', '$2y$10$/GHcGmvcwaOjD2pRcSknuOLdS8e.XvNJIL6NFiaLZq4nsrNufsfZ.', 'Nguyễn Duy Tùng', NULL, '0354304095', 'KTX Khu A, ĐHQG - TP. HCM', '2023-12-06 06:55:35', 355119, b'1'),
(51, 'binh.nguyenhelloworld@hcmut.edu.vn', '$2y$10$X7aTa1sHjqX266HvyT1C0.SDzE0Yl5MiHBGtW38LiJOb3Z0FYNpeK', 'Nguyễn Đức Bình', NULL, '0394433666', 'KTX Khu A, ĐHQG - TP. HCM', '2023-12-06 00:30:07', 109582, b'1'),
(53, 'tungnd.goat@gmail.com', '$2y$10$6QKSTVfZiYoEHM.Yc51qrOxqYGxaRQBn9FLyvNg5NOGk60eKua1nu', 'Tung Nguyen', NULL, '2332313543', 'dia chi ', '2023-12-06 07:27:08', 126110, b'1'),
(54, 'luan.nguyenexecutive@hcmut.edu.vn', '$2y$10$1vZqSwRuIR0PVPPuYSBJwuhf6J0yAJHwiu.kgdxy3vbK3YuLcEwUy', 'binh.nguyenhelloworld@hcmut.edu.vn', NULL, '0394433666', '1/9 Đồ Sơn, quận Tân Bình, TP. HCM', '2023-12-06 07:36:40', 496584, b'1');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `FK_order_user` (`user_id`);

--
-- Chỉ mục cho bảng `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `FK_order_item_product` (`product_id`);

--
-- Chỉ mục cho bảng `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `FK_product_category` (`category_id`);

--
-- Chỉ mục cho bảng `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `FK__product` (`product_id`),
  ADD KEY `FK__user` (`user_id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_order_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `FK_order_item_order` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_order_item_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_product_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `FK__product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK__user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

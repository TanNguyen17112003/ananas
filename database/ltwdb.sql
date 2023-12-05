-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2023 at 09:13 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ltwdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
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
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `password`, `name`, `role`, `updated_at`) VALUES
(1, 'hienlq16103@gmail.com', 'hienlqkt54', 'Le_Quang_Hien', 1, '2023-11-30 06:30:20'),
(2, 'binhnguyen3816@gmail.com', 'binhnguyen3816', 'Nguyen_Duc_Binh', 1, '2023-11-15 18:17:08'),
(3, 'ndtgoat@gmail.com', '123', 'Nguyen_Duy_Tung', 1, '2023-11-30 06:30:51'),
(4, 'luan.nguyenexecutive@hcmut.edu.vn', '123', 'Nguyễn Công Anh Luân', 1, '2023-11-30 06:30:51');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Trà Đài Loan'),
(2, 'Trà Latte'),
(3, 'Trà chanh'),
(4, 'Trà sữa'),
(5, 'Trà yakult');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
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
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `username`, `email`, `message`, `status`, `created_at`) VALUES
(1, 'Binh', 'binh381672943@gmail.com', 'Hi, thank you for your recent inquiry. Let us know how we did by completing this short survey. It takes less than a minute to complete.', 0, '2023-11-16 07:21:58'),
(2, 'Binh', 'binhnguyen3816@gmail.com', 'Binh, it’s been a while; we miss you! Let us know if there’s anything we can do to improve your experience or if you have any questions for us. We value you and would love to hear from you.', 0, '2023-11-16 07:22:35'),
(3, 'Binh', 'nguyenducbinh381672943@gmail.com', 'Hi, this is to confirm that your recent support ticket has been resolved and closed. We thank you for your patience.', 0, '2022-12-08 07:29:18'),
(4, 'Binh', 'binh.nguyenhelloworld@hcmut.edu.vn', 'Use these to celebrate customer anniversaries, an upcoming holiday, or birthday. “Happy Birthday Bình! As an extra-special thank you for being a loyal customer, here’s $50 on us. Use it toward any of your favorite products.', 0, '2023-11-16 07:49:39'),
(5, 'Nguyễn Đức Bình', 'binh381672943@gmail.com', 'đây là tin nhắn từ phần liên hệ', 0, '2023-11-23 05:54:52'),
(6, 'Nguyễn Đức Bình', 'binh381672943@gmail.com', 'this is a contact message', 0, '2023-11-23 07:36:10'),
(7, 'Nguyễn Đức Bình', 'binh381672943@gmail.com', 'this is a contact message', 0, '2023-11-23 07:36:34');

-- --------------------------------------------------------

--
-- Table structure for table `order`
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
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `user_id`, `payment_method`, `payment`, `address_receiver`, `phone_receiver`, `updated_at`, `status`, `name_receiver`) VALUES
(16, 38, 'Tiền mặt khi nhận hàng', 357000, 'Ký túc xá Khu A Đại học quốc gia', '0394433666', '2023-11-30 09:32:33', 'Đang xử lý', 'Nguyễn Đức Bình'),
(17, 38, 'Tiền mặt khi nhận hàng', 38000, 'ktz khu A', '0394433666', '2023-11-23 05:22:52', 'Đang xử lý', 'Nguyễn Đức Bình'),
(18, 38, 'Tiền mặt khi nhận hàng', 38000, 'ktz khu A', '0394433666', '2023-11-23 08:25:22', 'Đang xử lý', 'Nguyễn Đức Bình'),
(19, 46, 'Tiền mặt khi nhận hàng', 0, 'Ký túc xá Khu B Đại học quốc gia', '0359110455', '2023-11-30 09:33:52', 'Đang xử lý', 'Đang xử lý'),
(20, 53, 'Tiền mặt khi nhận hàng', 123, 'Ký túc xá Khu A Đại học quốc gia', '', '2023-11-30 09:44:35', 'Đang xử lý', 'Đang xử lý'),
(21, 54, 'Tiền mặt khi nhận hàng', 123, 'Ký túc xá Khu A Đại học quốc gia', '', '2023-11-30 09:45:44', 'Đang xử lý', 'Đang xử lý'),
(22, 52, 'Tiền mặt khi nhận hàng', 123, 'Ký túc xá Khu A Đại học quốc gia', '0359110455', '2023-11-30 09:46:22', 'Đang xử lý', 'Đang xử lý'),
(23, 38, 'Tiền mặt khi nhận hàng', 123, 'Ký túc xá Khu A Đại học quốc gia', '', '2023-11-30 09:47:02', 'Đang xử lý', 'Đang xử lý'),
(24, 47, 'Tiền mặt khi nhận hàng', 123, '12 Nguyễn Huệ', '', '2023-11-30 09:50:31', 'Đang xử lý', 'Đang xử lý'),
(25, 53, 'Tiền mặt khi nhận hàng', 123, 'Ký túc xá Khu A Đại học quốc gia', '', '2023-11-30 09:51:06', 'Đang xử lý', 'Đang xử lý');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity_item` bigint(20) NOT NULL DEFAULT 1,
  `price` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`order_id`, `product_id`, `quantity_item`, `price`) VALUES
(16, 1, 13, 16000),
(16, 2, 2, 19000),
(16, 3, 4, 19000),
(16, 6, 1, 35000),
(16, 9, 0, 16000),
(17, 2, 1, 19000),
(17, 3, 1, 19000),
(18, 2, 2, 19000),
(19, 1, 1, 19000),
(20, 16, 1, 19000),
(21, 16, 1, 19000),
(22, 17, 1, 19000),
(23, 10, 1, 19000),
(24, 22, 1, 19000),
(25, 22, 1, 19000);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `content` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `title`, `content`, `updated_at`, `image`) VALUES
(1, 'Nụ cười tràn đầy hy vọng', 'phá cỗ nhộn nhịp tùng dinh tùng phách. Đây cũng là dịp để gia đình sum vầy, trao nhau những món quà ý nghĩa. Tuy nhiên, không phải ai cũng có may mắn để trải qua một mùa trung thu thật trọn vẹn.\r\n\r\nNhìn vào hoàn cảnh khó khăn của các bé mồ côi, trẻ em bỏ rơi hay các em nhỏ sinh sống tại mái ấm Chùa Kỳ Quang và mái ấm Ánh Sáng, Hồng Trà Ngô Gia đã tổ chức một buổi ghé thăm phát quà trung thu để mang niềm vui đến cho các em vào ngày lễ đặc biệt này.', '2023-11-17 19:54:52', 'https://wujiateavn.com/files/upload2/files/Untitled-5.jpg'),
(2, 'CÔNG BỐ KẾT QUẢ KHÁCH HÀNG TRÚNG THƯỞNG | VÒNG QUAY MAY MẮN', 'Chúng ta đã cùng nhau tìm ra các khách hàng may mắn nhận được giải thưởng trong chương trình “Vòng Quay May Mắn”. Như vậy là các phần quà cũng đã tìm được chủ sở hữu của mình rồi., Hồng Trà Ngô Gia xin chúc mừng tất cả các bạn trúng thưởng, các bạn chưa may mắn trong lần này cũng đừng buồn nhen, hãy cùng Hồng Trà Ngô Gia đón chờ những chương trình tiếp theo nhé! \r\n\r\nDanh sách khách hàng may mắn nhận được giải thưởng sau:\r\n\r\n03 giải Nhất: Iphone 14 Promax 256G\r\n03 giải Nhì: Xe điện PEGA\r\n05 giải Ba: Loa Bluetooth JBL\r\n08 giải Tư: Nước hoa Chanel\r\n100 giải Năm: Hộp quà tặng Ngô Gia\r\nGiải Khuyến khích: dành tặng cho tất cả khách hàng', '2023-11-17 19:57:24', 'https://wujiateavn.com/files/upload2/files/gi%E1%BA%A3i%20nh%E1%BA%A5t%201.jpg'),
(3, 'THỬ HƯƠNG VỊ MỚI - RINH IPHONE 14 PROMAX VỀ NHÀ', 'Nhằm tri ân Fan của Hồng Trà Ngô Gia trong suốt những năm qua đã và luôn đồng hành, yêu quý Hồng Trà Ngô Gia. Hồng Trà Ngô Gia dành tặng cơn bão “thay mới dế yêu” với phần thưởng Iphone 14 Promax, Xe Máy Điện PEGA,... và nhiều phần quà hấp dẫn khác đang đợi Fan rinh về nhà.\r\nCơn bão thay mới “dế yêu” đang được diễn ra từ ngày 15/7/2023 đến hết 15/8/2023. Ngoài quà tặng là những chiếc Iphone 14 Promax 256GB, Hồng Trà Ngô Gia còn chuẩn bị nhiều phần quà hấp dẫn khác như: Xe Máy Điện PEGA, Loa Bluetooth JBL, Nước hoa Chanel,... khi khách hàng mua 1 trong 5 thức uống mới nằm trong chương trình ưu đãi, khách hàng sẽ nhận được 1 vòng bọc ly kèm phiếu cào trên mỗi ly thức uống. Và khi khách hàng sưu tầm đủ 9 kiểu vòng bọc ly khác nhau, khách hàng sẽ có cơ hội tham gia thay mới “dế yêu” và nhiều phần quà hấp dẫn khác.\r\nKhông dừng lại ở những quà tặng xịn sò trên, Hồng Trà Ngô Gia còn tặng kèm bộ lắp ráp Lego trên mỗi ly thức uống, nằm trong chương chương ưu đãi. Trên mỗi vòng bọc ly sẽ có kèm theo phiếu cào, khách hàng chỉ cần xé phiếu cào để đổi thưởng Lego trực tiếp tại quán. Một tin chấn động hơn, kích thước Lego có thể lên đến cực đại. Vậy nên Fan ơi, đừng bỏ qua cơ hội “thử hương vị mới - rinh quà tặng về nhà” nhé!\r\nCÁCH THỨC THAM GIA\r\n\r\nBước 1: Order 1 trong 5 ly thức uống mới để nhận vòng bọc ly kèm thẻ cào, gồm:\r\n\r\n- Trà Sữa Ba Anh Em\r\n\r\n- Aiyu Hồng Trà Kem Tươi Hoàng Kim\r\n\r\n- Sữa Dâu Tây Trân Châu Trắng\r\n\r\n- Bát Bảo Ngô Gia\r\n\r\n- Chè Sương Sáo Nước Cốt Dừa\r\n\r\nTrên mỗi ly thức uống trên, khách hàng sẽ nhận được 01 vòng bọc ly kèm thẻ cào. \r\nBước 2: Fan nhớ xé phần thẻ cào và cào đổi Lego trực tiếp tại cửa hàng. Giữ lại Vòng bọc ly.\r\nLưu ý: Thẻ cào 100% trúng Lego, Fan nhớ đổi trực tiếp tại cửa hàng nhé!\r\n\r\nBước 3: Fan sưu tầm đủ 9 kiểu vòng bọc ly khác nhau, sau đó đến cửa hàng điền thông tin phiếu “bốc thăm trúng thưởng”. Fan nhớ gửi “phiếu bốc thăm trúng thưởng” kèm 9 kiểu vòng bọc ly về cho Ngô Gia nhé!\r\nCƠ CẤU GIẢI THƯƠNG\r\n\r\nGiải nhất: 03 Iphone 14 pro max\r\n\r\nGiải nhì: 03 Xe điện PEGA\r\n\r\nGiải ba: 05 Loa Bluetooth JBL\r\n\r\nGiải tư: 08 chai Nước hoa Chanel\r\n\r\nGiải năm: 100 Hộp quà tặng Ngô Gia\r\n\r\nGiải khuyến khích: 2200 phiếu giảm giá 5.000đ\r\n\r\nKết quả được công bố trực tiếp trên sóng Livestream của Ngô Gia.', '2023-11-17 19:59:27', 'https://wujiateavn.com/files/upload2/files/1200X1200.jpg'),
(4, 'HỒNG TRÀ NGÔ GIA ĐẠT DANH HIỆU GIẢI THƯỞNG HƯƠNG VỊ XUẤT SẮC ITQI', 'Hồng Trà Ngô Gia là một thương hiệu trà nổi tiếng tại Việt Nam và có xuất xứ từ Đài Loan, được thành lập từ năm 1995. Với hơn 25 năm kinh nghiệm trong việc sản xuất và phân phối trà, Hồng Trà Ngô Gia đã trở thành một trong những thương hiệu trà hàng đầu tại Đài Loan. Trà của Hồng Trà Ngô Gia được sản xuất từ những lá trà tươi ngon, được thu hái từ các vùng trồng trà nổi tiếng. Nhờ sử dụng các nguyên liệu chất lượng cao và quy trình sản xuất hiện đại, trà của Hồng Trà Ngô Gia luôn đảm bảo độ tươi mới và hương vị nồng nàn đặc trưng của vị trà truyền thống của Đài Loan. \r\nHồng trà Ngô Gia là một trong những loại trà nổi tiếng của Đài Loan, được sản xuất tinh túy từ những lá trà tươi ngon nhất. Với quy trình chế biến đặc biệt cùng công nghệ tiên tiến, Hồng Trà Ngô Gia đã đạt được danh hiệu giải thưởng hương vị xuất sắc iTQi do Viện Thẩm định Hương vị Quốc Tế (International Taste & Quality Institute) tại Brussels, Bỉ.\r\n\r\n \r\n\r\nĐược biết đến là một trong những giải thưởng có uy tín nhất thế giới trong lĩnh vực đánh giá sản phẩm ăn uống, giải thưởng iTQi chỉ được trao cho các sản phẩm có chất lượng đỉnh cao và đạt chuẩn hương vị tuyệt vời. Với danh hiệu này, Hồng Trà Ngô Gia đã khẳng định vị trí của mình trong thị trường trà quốc tế và được rất nhiều người tiêu dùng tin tưởng sử dụng hàng ngày.\r\n\r\nHồng trà Ngô Gia có màu sắc đỏ nâu huyền thoại, hương thơm đậm đà ngọt ngào, vị đắng thanh mát, giúp làm dịu cảm giác mệt mỏi và tạo ra một trạng thái thư giãn cho người sử dụng. Cùng với độ tinh khiết cao và hương vị đặc biệt, Hồng Trà Ngô Gia đang trở thành lựa chọn yêu thích của rất nhiều người trên thế giới.', '2023-11-17 20:00:20', 'https://wujiateavn.com/files/upload2/images/z4280613958518_0ed7dc93b8774d9ae5d6cbaf41b459b6.jpg'),
(5, 'HỒNG TRÀ KEM TƯƠI | SỰ KẾT HỢP HOÀN HẢO GIỮA TRÀ VÀ KEM TƯƠI', 'HỒNG TRÀ KEM TƯƠI | SỰ KẾT HỢP HOÀN HẢO GIỮA TRÀ VÀ KEM TƯƠI\r\nHồng Trà Kem Tươi đây là một thức uống mới đầy hấp dẫn, được pha trộn tinh tế từ trà đen và kem tươi ngon tuyệt.\r\n\r\n\r\nTừ lâu, trà là một thức uống được yêu thích bởi nhiều người vì sự thanh mát, thư giãn và tác dụng tốt cho sức khỏe. Và gần đây, xu hướng uống trà kết hợp với kem tươi đang ngày càng trở nên phổ biến tại giới trẻ ở Việt Nam. Và hôm nay, chúng tôi xin giới thiệu đến bạn một loại thức uống mới - Hồng Trà Kem Tươi - một sự kết hợp hoàn hảo giữa trà đen và kem tươi.\r\n\r\nHồng Trà Kem Tươi là một trong những thức uống được yêu thích của Hồng Trà Ngô Gia tại Đài Loan và hôm nay đã chính thức được mở bán tại Việt Nam. Được chế biến từ lá trà tươi và kem tươi ngon miệng, sản phẩm này mang đến cho người dùng một trải nghiệm mới lạ và đầy hấp dẫn.\r\n\r\nVới hương vị nhẹ nhàng của trà đen và vị béo ngậy của kem tươi, Hồng Trà Kem Tươi sẽ khiến bạn thích thú ngay từ lần đầu tiên thưởng thức. Không những thế, sản phẩm còn được bổ sung thêm các thành phần tự nhiên tốt cho sức khỏe như đường và sữa tươi, giúp tăng cường hương vị và dinh dưỡng.\r\n\r\nHồng Trà Kem Tươi có hương vị đậm đà, mạnh mẽ từ trà đen, cùng vị ngọt mát, béo ngậy từ kem tươi. Thưởng thức Hồng Trà Kem Tươi, bạn sẽ cảm nhận được sự kết hợp hoàn hảo giữa hương vị truyền thống của trà đen chuẩn Đài Loan và vị béo ngậy của kem tươi. Bạn có thể thưởng thức sản phẩm này vào bất kỳ thời điểm nào trong ngày, từ buổi sáng để bắt đầu một ngày mới đầy năng lượng đến buổi tối để thư giãn sau một ngày làm việc mệt mỏi.\r\n\r\nNgoài ra, Hồng Trà Kem Tươi còn là một lựa chọn tuyệt vời cho các buổi họp mặt gia đình, bạn bè hoặc các sự kiện đặc biệt. Sản phẩm này sẽ khiến buổi họp mặt của bạn thêm phần thú vị. Với chất lượng tốt và giá cả phải chăng, Hồng Trà Kem Tươi đang trở thành một thức uống được yêu thích và được nhiều người lựa chọn. Chúng tôi hy vọng rằng sản phẩm này sẽ mang đến cho bạn những trải nghiệm thú vị và tuyệt vời nhất.', '2023-11-17 20:08:45', 'https://wujiateavn.com/files/upload2/images/Image_20230519095555.jpg'),
(6, 'SỮA DÂU TÂY | SẢN PHẨM MỚI CỦA HỒNG TRÀ NGÔ GIA NHƯ THẾ NÀO', 'Sữa dâu tây! Đây là một thức uống mới và đầy cảm hứng, được làm từ sữa tươi nguyên chất kết hợp với dâu tây đỏ ngọt ngào, tươi ngon. Bạn sẽ được trải nghiệm hương vị tuyệt vời của sự ngọt ngào và thơm ngon từ cả sữa và dâu tây.\r\n\r\nSữa dâu tây không chỉ thơm ngon mà còn giàu dinh dưỡng, chứa nhiều chất béo và protein cần thiết cho cơ thể. Thức uống này có thể đóng vai trò là thức uống bổ sung dinh dưỡng, giúp tăng cường sức khỏe và tăng cường động lượng cho cơ thể.\r\n\r\nSữa dâu tây là sự lựa chọn tuyệt vời cho tất cả các đối tượng từ trẻ em đến người lớn tuổi. Ngoài ra, Sữa Dâu Tây không làm từ trà nên sẽ không ảnh hướng đến giấc ngủ của bạn. Vì vậy nếu bạn đang tìm kiếm một loại thức uống mới lạ, thơm ngon và giàu dinh dưỡng, hãy đến với chúng tôi để trải nghiệm hương vị tuyệt vời của sữa dâu tây.', '2023-11-17 20:09:17', 'https://wujiateavn.com/files/upload2/files/Image_20230407150503.jpg'),
(7, 'MỪNG NGÀY 8 THÁNG 3 – HỒNG TRÀ NGÔ GIA GỬI TẶNG MÓN QUÀ TUYỆT VỜI CHO PHÁI ĐẸP', 'Nhân dịp kỷ niệm Ngày Quốc tế Phụ nữ 8 tháng 3, Hồng Trà Ngô Gia xin gửi đến quý khách hàng một chương trình đặc biệt và ý nghĩa. Trong ngày 8/3, khi quý khách nữ đến bất kỳ chi nhánh nào của Hồng Trà Ngô Gia và đặt một món đồ uống bất kỳ trong menu, sẽ được tặng kèm một cái Pudding Socola ngon tuyệt để thưởng thức.\r\n\r\nLà một trong những món Topping vừa được cho ra mắt gần đây tại Hồng Trà Ngô Gia, pudding socola đem lại hương vị ngọt ngào, hấp dẫn và rất thích hợp để làm quà tặng cho người phụ nữ thân yêu nhân dịp 8/3.\r\n\r\nHồng Trà Ngô Gia hy vọng rằng chương trình này sẽ giúp quý khách hàng thưởng thức những món ngon cùng không khí rộn ràng, ấm áp trong ngày 8/3.\r\n\r\nHãy đến Hồng Trà Ngô Gia để tận hưởng chương trình ưu đãi này và gửi lời chúc tốt đẹp đến người phụ nữ yêu thương của mình nhé!\r\n\r\nĐiều kiện áp dụng chương trình:\r\n\r\nÁp dụng khi mua hàng trực tiếp tại cửa hàng\r\nÁp dụng khi khách hàng nữ mua một đồ uống bất kỳ kèm Like và Comment bài viết trên Fanpage với nội dung “Vẫn là Hồng Trà Ngô Gia uống ngon nhất”\r\nThời gian diễn ra duy nhất trong ngày 08/03/2023', '2023-11-17 20:09:45', 'https://wujiateavn.com/files/upload2/files/h%C3%ACnh%207-3.jpg'),
(8, 'GRAND OPENING LINH ĐÔNG THỦ ĐỨC', 'Bắt đầu từ ngày 26/11 Hồng Trà Ngô Gia mời bạn đến tân gia chi nhánh mới tại 98B Linh Đông, Phường Linh Đông, Thủ Đức nà\r\n\r\nSiêu Ưu Đãi\r\n\r\nMUA 1 TẶNG 1 đến hết ngày 28/11/2022\r\nhương trình chỉ áp dụng tại cửa hàng đang khai trương\r\n\r\nMua 1 tặng 1 áp dụng trên toàn menu\r\n\r\nKhông áp dụng giao hàng và các chương trình khuyến mãi đang hoạt động khác.', '2023-11-17 20:10:23', 'https://wujiateavn.com/files/upload2/images/%E5%B8%A4%E6%A2%93%E6%9E%99-1.jpg'),
(9, 'TẬN HƯỞNG HƯƠNG VỊ MỚI CÙNG TRÀ SỮA SOCOLA VÀ TRÀ CHANH LÁ DỨA', 'Theo bạn thì hai món này kết hợp với Topping nào sẽ là tuyệt nhất? Cùng nhau chia sẻ kinh nghiệm ăn uống để mọi cùng tham khảo và thưởng thức thử nà!\r\n\r\nĐừng có quên nắm tay kéo vai đứa bạn thân đi cùng đó nha! Tag ngay hội bạn cùng đam mê vào hóng đi nà các bạn ơiiii', '2023-11-17 20:11:01', 'https://wujiateavn.com/files/upload2/images/ok-min.gif'),
(10, 'BẠN THỨC KHUYA SĂN SALE SỘP PEE CÒN TUI SĂN SALE HỒNG TRÀ NGÔ GIA', 'Chương trình chỉ áp dụng tại cửa hàng đang khai trương\r\n\r\nMua 1 tặng 1 áp dụng trên toàn menu\r\n\r\nKhông áp dụng giao hàng và các chương trình khuyến mãi đang hoạt động khác.\r\n\r\n-------\r\n\r\nTỚI QUẨY VỚI CHÚNG MÌNH NHOO CÁC BẠN OI\r\n\r\nĐịa chỉ :  763 Nguyễn Ảnh Thủ,P Trung Mỹ Tây, Q12\r\nHãy @tag thêm vài người bạn thân iu dấu của mình để nhận thêm nhiều ưu đãi nhaaa\r\n\r\n------\r\n\r\nWebsite: https://wujiateavn.com/\r\n\r\n#HongTraNgoGia\r\n\r\n#trasuadailoan\r\n\r\n#GrandOpening\r\n\r\n#NguyễnẢnhThủ\r\n\r\n#PhườngTrungMỹTây\r\n\r\n#Quận12\r\n', '2023-11-17 20:12:42', 'https://wujiateavn.com/files/upload/files/test.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product`
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
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `category_id`, `description`, `images`, `quantity`, `price`, `price_sale`, `timestamp`) VALUES
(1, 'Hồng trà Đài Loan', 1, 'Đài Loan là quốc đảo nổi tiếng về trà và đặc biệt là các dòng trà núi cao thượng phẩm. Nhắc tới trà thượng phẩm Đài Loan, không thể không nhắc tới dòng Hồng trà.\r\n<ul>\r\n<li>Hồng trà tốt cho tiêu hóa, tăng cảm giác thèm ăn, lợi tiểu, tiêu trừ phù nề.</li>\r\n<li>Tác dụng kháng axit, tiêu trừ các gốc tự do giúp ngăn ngừa bệnh ung thư và các bệnh tim mạch.</li>\r\n<li>Kích thích đại não, tạo sự hưng phấn, tập trung tinh thần, tăng cường trí nhớ, đẩy lùi cơn buồn ngủ. Vì vậy, uống hồng trà sẽ giúp tập trung học tập và làm việc có hiệu quả.</li>\r\n<li>Giúp chắc khỏe xương, ngăn ngừa bệnh loãng xương ở nữ giới.</li>\r\n</ul>\r\n\r\n\r\n\r\n\r\n\r\n', 'hong-tra-dai-loan-zvyjy3xt (2).jpg', 10, 39000, 16000, '2023-11-30 07:06:00'),
(2, 'Trà bí đao Ngô Gia', 1, 'Trà bí đao là thức uống có thể giúp bạn giảm cân và thanh nhiệt cho cơ thể. Một ly trà bí đao vào ngày hè sẽ giúp bổ sung vitamin và lấy lại năng lượng.\r\n<ul>\r\n<li>Thanh lọc cơ thể, điều trị táo bón, nóng trong người.</li>\r\n<li>Giải nhiệt cơ thể và mang lại sự trẻ trung, rạng ngời cho làn da.</li>\r\n<li>Uống trà bí đao trước bữa ăn sẽ làm giảm cảm giác thèm ăn,  tránh việc hấp thụ các chất béo và tinh bột không cần thiết.</li>\r\n</ul>', 'tra-bi-dao-ngo-gia-q38efry9 (2).jpg', 10, 39000, 19000, '2023-11-30 07:10:48'),
(3, 'Hồng trà vải thiều', 1, 'Hồng Trà Vải thiều là sự kết hợp giữa hồng trà và vải thiều, nước trà có vị chát, vải thiều to tròn, căng mọng nước. Hồng trà không chỉ là một loại thức uống thơm ngon mà nó còn mang lại cho chúng ta nhiều công dụng rất tốt cho sức khỏe.\r\n<br>\r\nUống Hồng Trà Vải thiều giúp cải thiện sức khỏe tim mạch, hỗ trợ tiêu hóa và giúp giảm cân vì trong trà có chứa vitamin C làm kích thích quá trình trao đổi chất và đốt cháy lượng mỡ thừa nhanh hơn.\r\n\r\n\r\n', 'hong-tra-vai-thieu-2isu3y9o (2).jpg', 10, 39000, 19000, '2023-11-30 07:15:00'),
(4, 'Trà xanh hoa nhài', 1, 'Trà xanh hoa nhài với hương vị tự nhiên, thuần khiết.\r\n<ul>\r\n<li>Hỗ trợ giảm cân hiệu quả, Cải thiện làn da tươi trẻ mỗi ngày</li>\r\n<li>Chống oxy hóa cơ thể hằng ngày</li>\r\n<li>Điều hòa đường máu và Cân bằng đường huyết và huyết áp</li>\r\n<li>Giúp ngủ ngon sâu giấc hơn, cải thiện tình trạng mất ngủ</li>\r\n<li>Giúp giảm stress, lo âu…</li>\r\n<li>Dự phòng nguy cơ bị cảm lạnh, cúm</li>\r\n<ul>', 'tra-xanh-hoa-nhai-f2vkxmvu (2).jpg', 10, 39000, 19000, '2023-11-30 07:21:14'),
(5, 'Trà xanh bí đao', 1, 'là sự kết hợp giữa hợp hương vị chát nhẹ cùng với cảm giác tươi mát, sảng khoái của bí đao. Trà xanh bí đao mang lại một trải nghiệm vô cùng tươi mới.', 'tra-xanh-bi-dao-t9gm7g3c (2).jpg', 10, 39000, 19000, '2023-11-30 07:28:27'),
(6, 'Hồng trà bí đao', 1, 'Là sự hòa quyện của hồng trà và bí đao, thức uống hồng trà bí đao mang hương vị thơm nhẹ, ít chát hòa quyện với sự thanh mát của của bí đao.', 'hong-tra-bi-dao-sccrscoa (2).jpg', 10, 39000, 19000, '2023-11-30 07:30:26'),
(7, 'Trà sương sáo', 1, 'Trà sương sáo là loại trà đặc biệt được chế biến từ lá trà tươi và sương sáo tự nhiên mang đến hương vị thơm ngon thanh mát và tinh tế.', 'tra-suong-sao-4sm5ysso (2).png', 10, 39000, 19000, '2023-11-30 08:42:03'),
(8, 'Bí đao sương sáo', 1, 'Trà bí đao sương sáo là một loại nước giải khát thanh nhiệt. Được nhiều yêu thích bởi hương vị thơm ngon. Đây là một loại thức uống giải nhiệt tuyệt vời, thơm ngon tốt cho sức khỏe.\r\n', 'bi-dao-suong-sao-qb2cpm44 (2).png', 10, 39000, 19000, '2023-11-30 07:55:21'),
(9, 'Sương sáo latte', 2, 'Món Sương Sáo Latte không làm bạn mê nhưng đem lại cảm giác dễ chịu.<br>\r\nNguyên liệu đến từ thảo mộc thiên nhiên tạo nên một thức uống giải khát hiệu quả, kết hợp vị thơm béo của sữa tươi rất healthy và balance. Để thưởng thức trọn vẹn bạn nhớ khuấy đều cho hòa quyện vào nhau nhé! ', 'suong-sao-latte-as9ofqbf (2).png', 20, 39000, 16000, '2023-11-30 07:56:18'),
(10, 'Trân châu đường đen latte', 2, 'Trân châu đường đen latte - một sự kết hợp hài hòa giữa cà phê, sữa và đường đen.\r\n<br>\r\nKhi ngửi sẽ thấy ngay mùi thơm thoang thoảng của cà phê. Nhấp môi một chút thì sẽ nếm được vị ngọt thơm đúng chuẩn hương vị đường đen, xen vào đó là độ béo của sữa càng làm tăng thêm sự quyến rũ của loại latte này.', 'sua-tuoi-tran-chau-duong-den-5stas08q (2).jpg', 10, 39000, 19000, '2023-11-30 08:29:20'),
(11, 'Trà xanh latte', 2, 'Trà xanh Latte là món uống kết hợp giữa trà xanh và sữa tươi. Không lạnh băng như trà xanh đá xay, cũng không quá ngậy béo như trà xanh phủ kem tươi, Trà xanh Latte có vị ngon rất riêng. Không quá ngọt, không ngậy béo mà đậm hương thơm của trà, hấp dẫn với vị của sữa, đây chính là món uống hoàn hảo cho các tín đồ của trà xanh.', 'tra-xanh-latte-lbm6ltnr (2).jpg', 10, 39000, 19000, '2023-11-30 08:30:20'),
(12, 'Hồng trà latte vải thiều', 2, 'Sự kết hợp hài hòa giữa hồng trà, cafe latte và hương vị vải tự nhiên.', 'hong-tra-latte-vai-thieu-w3lcixhg (2).jpg', 10, 39000, 19000, '2023-11-30 08:32:37'),
(13, 'Bí đao latte', 2, 'Sự hòa quyện giữa latte và hương vị thanh mát của bí đao.', 'bi-dao-latte-dmzbutlw (2).jpg', 10, 239000, 19000, '2023-11-30 08:33:38'),
(14, 'Hồng trà latte Đài Loan', 2, 'Latte truyền thống vốn được làm từ cà phê, sữa tươi và bọt sữa nay kết hợp với Hồng trà mang hương thơm thanh mát, ngọt nhẹ sẽ làm ngây ngất những ai yêu trà và thức uống latte.', 'hong-tra-latte-dai-loan-kvmyjjtc (2).jpg', 10, 239000, 19000, '2023-11-30 08:36:31'),
(15, 'Trà xanh chanh', 3, 'Trà xanh kết hợp với chanh không chỉ tạo thành thức uống giải khát có vị thanh mát, chua dịu mà còn mang lại nhiều lợi ích cho sức khỏe của bạn.', 'tra-xanh-chanh-tolzbxkm (2).jpg', 10, 239000, 19000, '2023-11-30 08:37:37'),
(16, 'Hồng trà chanh vải thiều', 3, 'Hồng trà chanh với hương vị ngọt nhẹ của vải thiều.', 'hong-tra-chanh-vai-thieu-zlk6nqui (2).jpg', 10, 239000, 19000, '2023-11-30 08:38:44'),
(17, 'Trà chanh bí đao', 3, 'Trà chanh bí đao là sự kết hợp độc đáo giữa vị chát mà thanh của trà oolong cùng với vị chua chua của chanh và mùi thơm của vị bí đao mang đến cho bạn cảm giác mới lạ.', 'tra-xanh-bi-dao-t9gm7g3c (2).jpg', 10, 239000, 19000, '2023-11-30 08:39:38'),
(18, 'Trà sữa sương sáo', 4, 'Trà sữa sương sáo là một món trà sữa thanh mát, giúp giải nhiệt tuyệt vời trong những ngày hè nắng nóng.\r\n<br>\r\nLy trà sương sáo có mùi vị thơm ngon, tuyệt hảo. Hương vị ngọt thanh từ sữa đặc, béo ngậy, cộng thêm hương thơm ngát từ trà Ô Long và một chút dai dai từ sương sáo.', 'tra-sua-suong-sao-laessvwl (2).png', 10, 239000, 19000, '2023-11-30 08:41:06'),
(19, 'Trà xanh sữa', 4, 'Trà xanh sữa có vị trà xanh nhẹ nhàng kết hợp với sữa động vật, và cuối cùng là vị sữa đặc ngọt ngào', 'tra-xanh-sua-efbubhnb (2).jpg', 10, 239000, 19000, '2023-11-30 08:44:47'),
(20, 'Trà sữa vải thiều', 4, 'Trà sữa vải thiều mang đến một hương vị độc lạ cho những tín đồ đam mê trà sữa.', 'tra-sua-vai-thieu-mcpbo5wd (2).jpg', 10, 239000, 19000, '2023-11-30 08:45:56'),
(21, 'Trà sữa bí đao', 4, 'Trà sữa bí đao có hương vị vừa thơm ngậy vừa sảng khoái, có công dụng tuyệt vời với khả năng thanh nhiệt cơ thể.', 'tra-sua-bi-dao-qxo9y6dn (2).jpg', 10, 239000, 19000, '2023-11-30 08:47:48'),
(22, 'Trà sữa Đài Loan', 4, 'Trà sữa Đài Loan với hương vị truyền thống.', 'tra-sua-dai-loan-qlgi7h4z (2).jpg', 10, 239000, 19000, '2023-11-30 08:48:49'),
(23, 'Trà xanh yakult', 5, 'Trà xanh yakult với hương vị thanh mát, chát nhẹ. Giúp giải nhiệt cơ thể và tăng cường hệ tiêu hóa.', 'tra-xanh-yakult-ciiwdu3q (2).jpg', 10, 239000, 19000, '2023-11-30 08:50:13'),
(24, 'Hồng trà yakult', 5, 'Hương vị hồng trà truyền thông được làm mới bằng vị ngọt nhẹ của sữa chua uống yakult.', 'hong-tra-yakult-dai-loan-71tovysw (2).jpg', 10, 239000, 19000, '2023-11-30 08:51:08'),
(25, 'Bí đao yakult Ngô Gia', 5, 'Bí đao yakult Ngô Gia - Bí đao thanh mát hòa quyện với yakult dịu ngọt, vừa giải nhiệt cơ thể vừa tăng cường hệ tiêu hóa.', 'bi-dao-yakult-ngo-gia-des0qgwx (2).jpg', 10, 239000, 19000, '2023-11-30 08:52:17'),
(26, 'Hồng trà yakult Đài Loan', 5, 'Hồng trà yakult Đài Loan', 'hong-tra-yakult-vai-thieu-p2eqjjyy (2).jpg', 10, 239000, 19000, '2023-11-17 21:53:16');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL DEFAULT '',
  `content` text DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `product_id`, `user_id`, `title`, `content`, `updated_at`) VALUES
(3, 1, 38, 'Đánh giá', 'vị trà đậm đà, độ ngọt vừa phải có thể tự gia giảm tuỳ ý, menu siêu nhiều món, giá cực kì hạt dẻ chỉ từ 15-35k', '2023-11-30 08:59:03'),
(4, 1, 46, 'Đánh giá', 'ly 960cc to đùng mà chỉ tầm 30k thui, uống bao phê', '2023-11-30 08:59:44'),
(5, 16, 54, 'Đánh giá', 'hồng trà thơm, ít ngọt, vị chanh chua nhẹ, must-try nha.', '2023-11-30 09:20:56'),
(6, 22, 53, 'Đánh giá', 'Đúng nghĩa là đập tan cơn khát với đủ các loại giải khát trên đời. Menu dòm khủng bố món nào cũng có. Trung bình một ly size 1 lít luôn topping chỉ 23-24k', '2023-11-30 09:22:20'),
(7, 22, 47, 'Đánh giá', 'hương vị chuẩn Đài Loan nguyên gốc, không pha tạp hay thay đổi tí gì so với thương hiệu mẹ ở Đài.', '2023-11-30 09:23:00'),
(8, 17, 52, 'Đánh giá', 'ly này có hậu vị chua nhẹ nhẹ, bí đao thơm bát ngát, vừa dễ uống vừa hổng lo béo ú còn trân châu khoai môn thì dai, dẻo, nhai nhai vui mà ngon nữa.', '2023-11-30 09:23:54'),
(9, 10, 38, 'Đánh giá', 'món này ngon làm sao khỏi khen thêm mà chất lượng ly nước tại NGÔ GIA thì như chân lý luôn á, ngon xịn rẻ nữa, ly siêu to mà 25k thôi đó, phải thử liền nghe tui đi!', '2023-11-30 09:25:21');

-- --------------------------------------------------------

--
-- Table structure for table `user`
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
  `active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `name`, `avatar`, `phone`, `address`, `updated_at`, `verify_code`, `active`) VALUES
(38, 'binhnguyen3816@gmail.com', 'bla', 'Nguyễn Đức Bình', NULL, '0394433666', 'https://www.facebook.com/nguyenducbinh2003', '2023-11-18 01:44:57', 246924778, 1),
(43, 'nguyenducbinh26092003@gmail.com', 'Bla2003@', 'Nguyễn Đức Bình', NULL, '0394433666', 'https://www.facebook.com/nguyenducbinh2003', '2023-11-18 02:01:07', 676336091, 1),
(44, 'binh381672943@gmail.com', 'Binh2003@', 'binh3816', NULL, '0394433666', 'https://www.facebook.com/nguyenducbinh2003', '2023-11-23 08:20:05', 338474221, NULL),
(45, 'bbinh381672943@gmail.com', 'Binh2003@', 'binh3816', NULL, '0394433666', 'https://www.facebook.com/nguyenducbinh2003', '2023-11-23 08:21:19', 275643456, NULL),
(46, 'hien.lequang@hcmut.edu.vn', 'sus16103', 'Lê Quang Hiển', NULL, '0359110455', 'Ký túc xá Khu B Đại học Quốc gia', '2023-11-30 06:37:20', NULL, NULL),
(47, 'levukhoinguyen@gmail.com', 'nguyen123', 'Lê Vũ Khôi Nguyên', NULL, NULL, '12 Nguyễn Huệ', '2023-11-30 09:07:28', NULL, NULL),
(48, 'khanh.lehcmut@hcmut.edu.vn', 'khanh123', 'Lê Bảo Khánh', NULL, NULL, NULL, '2023-11-30 09:08:43', NULL, NULL),
(49, 'anh.maikhmt23@hcmut.edu.vn', 'danh11111', 'Mai Hoàng Danh', NULL, NULL, NULL, '2023-11-30 09:10:09', NULL, NULL),
(50, 'duong.hathuy@hcmut.edu.vn ', 'something123', 'Hà Thùy Dương', NULL, NULL, 'Ký túc xá Khu A Đại học Quốc gia', '2023-11-30 09:12:32', NULL, NULL),
(51, 'thao.vonguyen@hcmut.edu.vn', '', 'Võ Nguyễn Đoan Thảo', NULL, NULL, 'Ký túc xá Bách khoa, 497 Hoà Hảo, Phường 7, Quận 10, Thành phố Hồ Chí Minh', '2023-11-30 09:18:47', NULL, NULL),
(52, 'quang.nguyensvk21@hcmut.edu.vn', 'quangti', 'Nguyễn Văn Ngọc Quang', 'https://www.facebook.com/photo/?fbid=1055547401987', NULL, 'Ký túc xá Khu A Đại học Quốc gia', '2023-11-30 09:16:21', NULL, NULL),
(53, 'ha.dinh2003@hcmut.edu.vn', 'ha123', 'Đinh Vũ Hà', NULL, NULL, NULL, '2023-11-30 09:16:12', NULL, NULL),
(54, 'tung.nguyen2k3hcmut@hcmut.edu.vn', 'tung_nguyen', 'Nguyễn Duy Tùng', NULL, NULL, 'Ký túc xá Khu B Đại học Quốc gia', '2023-11-30 09:17:19', NULL, NULL),
(55, ' ngan.lengan2003@hcmut.edu.vn', 'nganle_123', 'Lê Thị Kim Ngân', NULL, NULL, 'Ký túc xá Khu B Đại học quốc gia', '2023-11-30 09:19:55', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `FK_order_user` (`user_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `FK_order_item_product` (`product_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `FK_product_category` (`category_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `FK__product` (`product_id`),
  ADD KEY `FK__user` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_order_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `FK_order_item_order` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_order_item_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_product_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `FK__product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK__user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

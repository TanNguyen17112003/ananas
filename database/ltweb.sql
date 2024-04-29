-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 29, 2024 at 04:18 AM
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
-- Database: `ltweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(60) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `password`, `name`, `role`, `updated_at`) VALUES
(1, 'admin@hcmut.edu.vn', '$2y$10$XUJXtm3PcDgMXs2ebBUpe.ogB.4Vgv6RoR6rAo8H4XbOGo2/0QMne', 'Admin', 1, '2024-04-11 15:07:17');

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
(1, 'Low Top'),
(2, 'High Top'),
(3, 'Slip-On'),
(4, 'Mid Top'),
(5, 'Mule');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` varchar(200) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `username`, `email`, `message`, `status`, `created_at`) VALUES
(1, 'deft', 'duytan17112003@gmail.com', 'deft', 0, '2024-04-11 14:47:43'),
(2, 'Tan Nguyen', 'duytan17112003@gmail.com', 'defttt', 0, '2024-04-11 14:48:01'),
(3, 'Tan Nguyen', 'duytan17112003@gmail.com', 'deft', 0, '2024-04-11 14:52:18'),
(4, 'deft', 'duytan17112003@gmail.com', 'tan17112003', 0, '2024-04-11 14:57:17'),
(5, 'deft', 'duytan17112003@gmail.com', 'tan17112003', 0, '2024-04-11 14:57:47'),
(6, 'deft', 'duytan17112003@gmail.com', 'tan17112003', 0, '2024-04-11 14:58:14');

-- --------------------------------------------------------

--
-- Table structure for table `cost_range`
--

CREATE TABLE `cost_range` (
  `range_id` int(11) NOT NULL,
  `low_cost` int(11) DEFAULT NULL,
  `high_cost` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cost_range`
--

INSERT INTO `cost_range` (`range_id`, `low_cost`, `high_cost`) VALUES
(1, 600000, NULL),
(2, 500000, 599000),
(3, 400000, 499000),
(4, 300000, 399000),
(5, 200000, 299000),
(6, NULL, 200000);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name_receiver` varchar(50) NOT NULL DEFAULT 'Đang xử lý',
  `address_receiver` varchar(50) NOT NULL,
  `phone_receiver` varchar(50) NOT NULL,
  `payment` bigint(20) NOT NULL,
  `payment_method` varchar(50) NOT NULL DEFAULT 'Tiền mặt khi nhận hàng',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('Đang xử lý','Đang giao','Đã giao') NOT NULL DEFAULT 'Đang xử lý'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `user_id`, `name_receiver`, `address_receiver`, `phone_receiver`, `payment`, `payment_method`, `updated_at`, `status`) VALUES
(1, 1, 'aa', 'aaa', 'aa', 13130000, 'Tiền mặt khi nhận hàng', '2024-04-11 14:15:55', 'Đã giao'),
(2, 1, 'ss', 'dđ', 'ss', 10040000, 'Tiền mặt khi nhận hàng', '2024-04-08 22:21:56', 'Đang xử lý'),
(3, 1, 'aa', 'vv', 'aa', 10040000, 'Tiền mặt khi nhận hàng', '2024-04-08 22:22:13', 'Đang xử lý'),
(4, 1, 'aaa', 'ssss', 'ass', 13190000, 'Tiền mặt khi nhận hàng', '2024-04-08 23:18:24', 'Đang xử lý'),
(5, 5, 'Nguyễn Hoàng Duy Tân', 'Kỹ túc xá khu A, thành phố Hồ Chí Minh', '0862898859', 2940000, 'Tiền mặt khi nhận hàng', '2024-04-12 02:00:03', 'Đang xử lý'),
(6, 5, 'Nguyễn Hoàng Duy Tân', 'Kỹ túc xá khu A, thành phố Hồ Chí Minh', '0862898859', 2940000, 'Tiền mặt khi nhận hàng', '2024-04-12 02:01:01', 'Đang xử lý'),
(7, 5, 'Nguyễn Hoàng Duy Tân', 'nhà A20, Ký túc xá khu A, thành phố Hồ Chí Minh', '0862898859', 3120000, 'Tiền mặt khi nhận hàng', '2024-04-12 02:03:02', 'Đang xử lý'),
(8, 5, 'Tân Nguyễn', 'tòa A20, Thủ Đức, Thành phố Hồ Chí Minh', '0862898859', 12740000, 'Tiền mặt khi nhận hàng', '2024-04-12 02:05:18', 'Đang xử lý'),
(9, 5, 'dđ', 'ssss', 'aaa', 800000, 'Tiền mặt khi nhận hàng', '2024-04-12 14:42:58', 'Đang xử lý');

--
-- Triggers `order`
--
DELIMITER $$
CREATE TRIGGER `update_product_instock` AFTER UPDATE ON `order` FOR EACH ROW IF NEW.status = 'Đã giao' THEN
        UPDATE product_instock
        JOIN order_item ON order_item.product_id = product_instock.product_id AND order_item.size_item = product_instock.size
        SET product_instock.quantity = product_instock.quantity - order_item.quantity_item
        WHERE order_item.order_id = NEW.order_id;
 END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity_item` bigint(20) NOT NULL DEFAULT 1,
  `size_item` int(100) NOT NULL,
  `price` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`order_id`, `product_id`, `quantity_item`, `size_item`, `price`) VALUES
(1, 5, 5, 0, 490000),
(1, 65, 4, 0, 520000),
(1, 105, 5, 0, 450000),
(1, 171, 2, 0, 460000),
(1, 60001, 4, 0, 990000),
(2, 4, 8, 0, 520000),
(2, 5, 5, 0, 490000),
(3, 4, 8, 0, 520000),
(3, 5, 5, 0, 490000),
(4, 4, 8, 0, 520000),
(4, 5, 5, 0, 490000),
(4, 105, 7, 0, 450000),
(7, 4, 2, 35, 520000),
(7, 4, 4, 36, 520000),
(8, 5, 10, 37, 490000),
(8, 5, 13, 38, 490000),
(8, 5, 3, 41, 490000),
(9, 4, 4, 40, 200000);

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
(1, 'URBAS CORLURAY PACK\r\n- SẮC THU KHÓ CƯỠNG -', 'Urbas Corluray Pack đem đến lựa chọn “làm mới mình” với sự kết hợp 5 gam màu mang sắc thu; phù hợp với những người trẻ năng động, mong muốn thể hiện cá tính riêng biệt khó trùng lặp.', '2024-03-30 12:13:43', 'https://ananas.vn/wp-content/uploads/Corluray_bannerweb_desktop1920x1050.jpg'),
(2, 'VINTAS SAIGON 1980s', 'Với bộ 5 sản phẩm, Vintas Saigon 1980s Pack đem đến một sự lựa chọn “cũ kỹ thú vị” cho những người trẻ sống giữa thời hiện đại nhưng lại yêu nét bình dị của Sài Gòn ngày xưa ...', '2024-03-30 12:14:09', 'https://ananas.vn/wp-content/uploads/Blog-1980s_0.jpg'),
(3, 'SNEAKER FEST VIETNAM VÀ SỰ KẾT HỢP', 'Việc sử dụng dáng giày Vulcanized High Top của Ananas trong thiết kế và cảm hứng bắt nguồn từ linh vật Peeping - đại diện cho tinh thần xuyên suốt 6 năm qua Sneaker Fest Vietnam, chúng tôi tự tin đây sẽ là sản phẩm đáng mong chờ cho mọi “đầu giày” vào mùa hè năm nay...', '2024-03-30 12:12:00', 'https://ananas.vn/wp-content/uploads/peeping_pattas01.jpg'),
(4, '\"GIẢI PHẪU\" GIÀY VULCANIZED', 'Trong phạm vi bài viết ngắn, hãy cùng nhau tìm hiểu cấu tạo giày Vulcanized Sneaker - loại sản phẩm mà Ananas đã chọn làm \"cốt lõi\" để theo đuổi trong suốt hành trình của mình...', '2024-03-30 12:13:18', 'https://ananas.vn/wp-content/uploads/shoes-anatomy.jpg');

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
  `subimg_1` varchar(100) DEFAULT NULL,
  `subimg_2` varchar(100) DEFAULT NULL,
  `subimg_3` varchar(100) DEFAULT NULL,
  `status` enum('Limited Edition','Online Only','Sale Off','New Arrival') NOT NULL DEFAULT 'New Arrival',
  `gender` enum('Unisex','Male','Female') NOT NULL DEFAULT 'Unisex',
  `upper_material` varchar(20) NOT NULL,
  `outsole_material` varchar(20) NOT NULL,
  `price` bigint(20) NOT NULL,
  `price_sale` bigint(20) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `category_id`, `description`, `images`, `subimg_1`, `subimg_2`, `subimg_3`, `status`, `gender`, `upper_material`, `outsole_material`, `price`, `price_sale`, `timestamp`) VALUES
(4, 'BASAS BUMPER GUM NE - MULE - BLACK/GUM', 5, 'Thiết kế hở gót \"lạ lẫm\" mang lại trải nghiệm lên chân nhanh chóng chỉ trong chớp mắt (như dép) nhưng lại có thần thái \"gần sát\" với một đôi Sneakers. Basas Bumper Gum NE - Mule được ra đời với các chi tiết màu sắc đặc trưng của bộ sản phẩm Basas Bumper Gum quen thuộc, phù hợp nhiều kiểu phong cách nhẹ nhàng từ nhà ra phố, xứng đáng là một lựa chọn must have để làm đa dạng thêm tủ giày/dép của mày.', 'black_giay1.jpg', 'bmule_giay2.jpg', 'bmule_giay3.jpg', 'bmule_giay4.jpg', 'New Arrival', 'Unisex', 'Canvas', 'Rubber', 510001, 200000, '2024-04-12 14:45:31'),
(5, 'BASAS SIMPLE LIFE NE - MULE - WHITE', 2, 'Phù hợp hoàn hảo với nhịp sống mới của giới trẻ, Basas Simple Life NE - Mule tinh giản vấn đề thắt dây với chi tiết hở gót độc đáo, mang đến khả năng lên chân nhanh gọn nhưng vẫn đảm bảo trọn vẹn nét thanh lịch trong diện mạo, qua đó nhấn mạnh chất “Simple Life” đặc trưng của thiết kế. Với khả năng ứng dụng cao từ công năng đến phối màu, sản phẩm dễ dàng đáp ứng mọi tiêu chí của giới mộ điệu cho một item thiết yếu trong tủ giày/giép.', 'white_giay1.jpg', 'white_giay2.jpg', 'white_giay3.jpg', 'white_giay4.jpg', 'New Arrival', 'Unisex', 'Canvas', 'Rubber', 480000, 200000, '2024-04-12 03:41:08'),
(6, 'BASAS BUMPER GUM NE - MULE - OFFWHITE/GUM', 5, 'Thiết kế hở gót \"lạ lẫm\" mang lại trải nghiệm lên chân nhanh chóng chỉ trong chớp mắt (như dép) nhưng lại có thần thái \"gần sát\" với một đôi Sneakers. Basas Bumper Gum NE - Mule được ra đời với các chi tiết màu sắc đặc trưng của bộ sản phẩm Basas Bumper Gum quen thuộc, phù hợp nhiều kiểu phong cách nhẹ nhàng từ nhà ra phố, xứng đáng là một lựa chọn must have để làm đa dạng thêm tủ giày/dép của bạn.', 'wmule_giay1.jpg', 'wmule_giay2.jpg', 'wmule_giay3.jpg', 'wmule_giay4.jpg', 'New Arrival', 'Unisex', 'Canvas', 'Rubber', 520000, NULL, '2024-03-30 08:34:01'),
(9, 'TRACK 6 CLASS E - LOW TOP - CRAFTSMAN BLUE', 1, 'Track 6 Class E (Essential, Enthusiasm) là bộ sản phẩm mang trên mình những yếu tố cơ bản trong cuộc sống thường ngày. Được sử dụng những chất liệu thường có trên những đôi giày cao cấp với da Nappa nhẵn bóng, lưới mesh nhỏ mịn kết hợp Suede (da lộn) phủ màu tạo nên tổng thể vừa tinh tế, với màu sắc nhã nhặn. Điểm nhấn thú vị trên chi tiết màu “Craftsman Blue” thể hiện một phần yếu tố cần thiết, đại diện cho niềm đam mê chế tác của con người với những thú vui gắn cùng thiên nhiên. Track 6 Class E - Craftsman Blue xứng đáng là một must-have item đối với những ai yêu thích sáng tạo và mong muốn thể hiện cá tính độc lập.', 'craft_giay1.jpg', 'craft_giay2.jpg', 'craft_giay3.jpg', 'craft_giay4.jpg', 'New Arrival', 'Unisex', 'CSuede', 'Rubber', 1190000, NULL, '2024-03-30 09:17:32'),
(12, 'TRACK 6 I.S.E.E - PURE WHITE/ICY BLUE', 1, NULL, 'icy_giay1.jpg', 'icy_giay2.jpg', 'icy_giay3.jpg', 'icy_giay4.jpg', 'Limited Edition', 'Unisex', 'Suede', 'Rubber', 1490000, NULL, '2024-03-30 09:53:25'),
(16, 'TRACK 6 JAZICO - LOW TOP - ROYAL WHITE', 1, NULL, 'jaz_giay1.jpg', 'jaz_giay2.jpg', 'jaz_giay3.jpg', 'jaz_giay4.jpg', 'New Arrival', 'Unisex', 'Suede', 'Rubber', 1190000, NULL, '2024-03-30 09:57:42'),
(65, 'BASAS BUMPER GUM NE - LOW TOP - BLACK/GUM', 1, 'Đánh dấu một bước trưởng thành nữa, Basas Bumper Gum NE (New Episode) ra đời với những cải tiến nhẹ nhàng nhưng đủ tạo được sự thay đổi trong cảm nhận khi trải nghiệm. Vẫn giữ ngoại hình gần như không thay để phát huy đặc tính ứng dụng cao của dòng Basas vốn đã được chứng minh, phần đế màu Gum thú vị và /Foxing thân/ mới làm nền cho phần chất liệu Upper được nâng cấp. Đây được xem là một trong những phiên bản được chúng tôi kì vọng có thể bền vững vượt qua thời gian và không gian, chắc chắn đáng để thử.\r\n', 'bblt_giay1.jpg', 'bblt_giay2.jpg', 'bblt_giay3.jpg', 'bblt_giay4.jpg', 'New Arrival', 'Unisex', 'Canvas', 'Rubber', 520000, NULL, '2024-03-30 09:13:00'),
(98, '\r\nBASAS BUMPER GUM EXT NE - LOW TOP - BLACK/GUM', 1, 'Bumper Gum EXT (Extension) NE là bản nâng cấp được xếp vào dòng sản phẩm Basas, nhưng lại gây ấn tượng với diện mạo phá đi sự an toàn thường thấy. Với cách sắp xếp logo hoán đổi đầy ý tứ và mảng miếng da lộn (Suede) xuất hiện hợp lí trên chất vải canvas NE bền bỉ dày dặn nhấn nhá thêm bằng những sắc Gum dẻo dai. Tất cả làm nên 01 bộ sản phẩm với thiết kế đầy thoải mái trong trải nghiệm, đủ thanh lịch trong dáng vẻ.', 'bgum_giay1.jpg', 'bgum_giay2.jpg', 'bgum_giay3.jpg', 'bgum_giay4.jpg', 'New Arrival', 'Unisex', 'Suede', 'Rubber', 580000, NULL, '2024-03-30 09:19:57'),
(99, 'BASAS BUMPER GUM EXT NE - HIGH TOP - BLACK/GUM', 2, 'Bumper Gum EXT (Extension) NE là bản nâng cấp được xếp vào dòng sản phẩm Basas, nhưng lại gây ấn tượng với diện mạo phá đi sự an toàn thường thấy. Với cách sắp xếp logo hoán đổi đầy ý tứ và mảng miếng da lộn (Suede) xuất hiện hợp lí trên chất vải canvas NE bền bỉ dày dặn nhấn nhá thêm bằng những sắc Gum dẻo dai. Tất cả làm nên 01 bộ sản phẩm với thiết kế đầy thoải mái trong trải nghiệm, đủ thanh lịch trong dáng vẻ.', 'bahas_black_giay1.jpg', 'bahas_black_giay2.jpg', 'bahas_black_giay3.jpg', 'bahas_black_giay4.jpg', 'New Arrival', 'Unisex', 'Canvas', 'Rubber', 650000, NULL, '2024-03-30 07:38:23'),
(100, 'BASAS BUMPER GUM EXT NE - HIGH TOP - OFFWHITE/GUM', 2, 'Bumper Gum EXT (Extension) NE là bản nâng cấp được xếp vào dòng sản phẩm Basas, nhưng lại gây ấn tượng với diện mạo phá đi sự an toàn thường thấy. Với cách sắp xếp logo hoán đổi đầy ý tứ và mảng miếng da lộn (Suede) xuất hiện hợp lí trên chất vải canvas NE bền bỉ dày dặn nhấn nhá thêm bằng những sắc Gum dẻo dai. Tất cả làm nên 01 bộ sản phẩm với thiết kế đầy thoải mái trong trải nghiệm, đủ thanh lịch trong dáng vẻ.', 'bahas_white_giay1.jpg', 'bahas_white_giay2.jpg', 'bahas_white_giay3.jpg', 'bahas_white_giay4.jpg', 'New Arrival', 'Unisex', 'Canvas', 'Rubber', 650000, NULL, '2024-03-30 07:41:18'),
(104, 'URBAS IRRELEVANT NE - LOW TOP - STORM/A.GOLD', 1, 'Từ tinh thần sáng tạo ngẫu hứng, Urbas Irrelevant lắp ghép các mảng sắc tách biệt để tạo nên diện mạo tổng thể tương phản cá tính. Thiết kế có chút thay đổi trong chi tiết và sử dụng chất vải canvas NE để tạo nên bản nâng cấp so với phiên bản cũ, đem lại cảm giác lên chân tự tin trong mọi trải nghiệm “bay nhảy” thường ngày.', 'go_giay1.jpg', 'go_giay2.jpg', 'go_giay3.jpg', 'go_giay4.jpg', 'Sale Off', 'Unisex', 'Canvas', 'Rubber', 690000, 450000, '2024-03-30 09:32:08'),
(105, 'URBAS IRRELEVANT NE - LOW TOP - ANTARCTICA/RED ORA', 1, 'Từ tinh thần sáng tạo ngẫu hứng, Urbas Irrelevant lắp ghép các mảng sắc tách biệt để tạo nên diện mạo tổng thể tương phản cá tính. Thiết kế có chút thay đổi trong chi tiết và sử dụng chất vải canvas NE để tạo nên bản nâng cấp so với phiên bản cũ, đem lại cảm giác lên chân tự tin trong mọi trải nghiệm “bay nhảy” thường ngày.', 'ro_giay1.jpg', 'ro_giay2.jpg', 'ro_giay3.jpg', 'ro_giay4.jpg', 'Sale Off', 'Unisex', 'Canvas', 'Rubber', 690000, 450000, '2024-03-30 09:30:30'),
(112, 'VINTAS AUNTER - LOW TOP - SOYBEAN', 1, 'Kết hợp cùng diện mạo quai dán (hook loop) mới mẻ, Aunter chính là một bản phối lạ lẫm nhưng đầy thú vị lần đầu tiên xuất hiện của dòng Vintas. Vẫn là chất vải Canvas thường gặp, đi cặp cùng các lựa chọn màu sắc phong phú nhưng vẫn ẩn sâu bên trong nét điềm đạm. Tất cả làm nên điểm nhấn chững chạc tổng thể, dễ dàng tôn lên nét thu hút cần thiết mọi lần lên chân.', 'soybean_giay1.jpg', 'soybean_giay2.jpg', 'soybean_giay3.jpg', 'soybean_giay4.jpg', 'New Arrival', 'Unisex', 'Canvas', 'Rubber', 690000, NULL, '2024-03-30 09:25:24'),
(117, '\r\nVINTAS FLANNEL - LOW TOP - CEMENT', 1, 'Khoác lên thân giày một lớp áo mới theo đúng nghĩa đen với thiết kế đánh dấu sự xuất hiện lần đầu tiên của chất vải Flannel trên các dáng sản phẩm quen thuộc từ Ananas. Phát huy những ưu điểm thoải mái và bền bỉ từ chất vải Flannel “vạn người mê”, song hành cùng phối màu trầm ấm đặc trưng, Vintas Flannel Pack là lựa chọn thú vị dành cho những bạn trẻ ái mộ phong cách điềm đạm chững chạc nhưng vẫn đầy sức hút.', 'cem_giay1.jpg', 'cem_giay2.jpg', 'cem_giay3.jpg', 'cem_giay4.jpg', 'New Arrival', 'Unisex', 'Canvas', 'Rubber', 690000, NULL, '2024-03-30 09:15:14'),
(121, 'VINTAS AUNTER - LOW TOP - BOTANICAL GARDEN', 1, 'Kết hợp cùng diện mạo quai dán (hook loop) mới mẻ, Aunter chính là một bản phối lạ lẫm nhưng đầy thú vị lần đầu tiên xuất hiện của dòng Vintas. Vẫn là chất vải Canvas thường gặp, đi cặp cùng các lựa chọn màu sắc phong phú nhưng vẫn ẩn sâu bên trong nét điềm đạm. Tất cả làm nên điểm nhấn chững chạc tổng thể, dễ dàng tôn lên nét thu hút cần thiết mọi lần lên chân.', 'bo_giay1.jpg', 'bo_giay2.jpg', 'bo_giay3.jpg', 'bo_giay4.jpg', 'New Arrival', 'Unisex', 'Canvas', 'Rubber', 690000, NULL, '2024-03-30 09:27:55'),
(130, 'URBAS RETROSPECTIVE - MID TOP - POPULAR BLUE', 4, 'Với việc đưa những chiếc đế cao su \"xuyên thấu\" rực rỡ trở lại, kết hợp cùng phần upper bằng vải canvas với những màu sắc tươi rói, Urbas Retrospective đã khắc họa nên bức tranh đầy sinh động về một thời kỳ phát triển rực rỡ của thời trang và nghệ thuật của những thập kỉ trước. Đây chắc chắn sẽ là lựa chọn không thể thiếu trong tủ đồ đối với những bạn trẻ đang tìm kiếm nguồn cảm hứng cổ điển trong phong cách thời trang hiện đại và độc đáo của bản thân. Sự độc đáo này còn mạnh mẽ hơn trên một form dáng Mid Top hoàn toàn mới.', 'pblue_giay1.jpg', 'pblue_giay2.jpg', 'pblue_giay3.jpg', 'pblue_giay4.jpg', 'Sale Off', 'Unisex', 'Canvas', 'Rubber', 720000, 470000, '2024-03-30 08:20:00'),
(131, 'URBAS RETROSPECTIVE - MID TOP - YELLOW SUBMARINE', 4, 'Với việc đưa những chiếc đế cao su \"xuyên thấu\" rực rỡ trở lại, kết hợp cùng phần upper bằng vải canvas với những màu sắc tươi rói, Urbas Retrospective đã khắc họa nên bức tranh đầy sinh động về một thời kỳ phát triển rực rỡ của thời trang và nghệ thuật của những thập kỉ trước. Đây chắc chắn sẽ là lựa chọn không thể thiếu trong tủ đồ đối với những bạn trẻ đang tìm kiếm nguồn cảm hứng cổ điển trong phong cách thời trang hiện đại và độc đáo của bản thân. Sự độc đáo này còn mạnh mẽ hơn trên một form dáng Mid Top hoàn toàn mới.', 'pyel_giay1.jpg', 'pyel_giay2.jpg', 'pyel_giay3.jpg', 'pyel_giay4.jpg', 'Sale Off', 'Unisex', 'Canvas', 'Rubber', 720000, 470000, '2024-04-04 17:45:57'),
(132, 'PATTAS LIVING JOURNEY - LOW TOP - VAPOROUS GRAY', 1, NULL, 'li_giay1.jpg', 'li_giay2.jpg', 'li_giay3.jpg', 'li_giay4.jpg', 'New Arrival', 'Unisex', 'Canvas', 'Rubber', 720000, NULL, '2024-03-30 09:50:13'),
(133, 'PATTAS LIVING JOURNEY - HIGH TOP - VAPOROUS GRAY', 2, NULL, 'pattas_giay1.jpg', 'pattas_giay2.jpg', 'pattas_giay3.jpg', 'pattas_giay4.jpg', 'New Arrival', 'Unisex', 'Canvas', 'Rubber', 750000, NULL, '2024-04-04 17:44:40'),
(135, '\r\nBASAS RAW - LOW TOP - RUSTIC', 1, 'Phiên bản tối giản mới sử dụng chất liệu Canvas RAW với phần bề mặt được tiết chế tối đa các bước xử lý sau dệt, đem đến một cảm nhận thô ráp, dễ dàng cảm nhận nét bền bỉ, dày dặn đặc trưng nguyên bản chỉ từ ánh nhìn diện mạo. Với những điểm nhấn thay đổi trong thiết kế cùng với vài chọn lựa chi tiết khác hơn từ trong ra ngoài, Basas RAW mang trên mình sứ mệnh chào sân phiên bản /rập mới/ và cũng là nơi bắt đầu cho những nâng cấp này xuất hiện rộng rãi hơn trong tương lai. Như một tấm ảnh RAW với đầy đủ cảm xúc tự nhiên, hãy tự do ngẫu hứng nó theo cách của bạn.', 'rus_giay1.jpg', 'rus_giay2.jpg', 'rus_giay3.jpg', 'rus_giay4.jpg', 'New Arrival', 'Unisex', 'Canvas', 'Rubber', 610000, NULL, '2024-03-30 09:34:15'),
(142, 'BASAS EVERGREEN - LOW TOP - EVERGREEN', 1, 'Phiên bản tối giản mới sử dụng chất liệu Canvas RAW với phần bề mặt được tiết chế tối đa các bước xử lý sau dệt, đem đến một cảm nhận thô ráp, dễ dàng cảm nhận nét bền bỉ, dày dặn đặc trưng nguyên bản chỉ từ ánh nhìn diện mạo. Với những điểm nhấn thay đổi trong thiết kế cùng với vài chọn lựa chi tiết khác hơn từ trong ra ngoài, Basas RAW mang trên mình sứ mệnh chào sân phiên bản /rập mới/ và cũng là nơi bắt đầu cho những nâng cấp này xuất hiện rộng rãi hơn trong tương lai. Như một tấm ảnh RAW với đầy đủ cảm xúc tự nhiên, hãy tự do ngẫu hứng nó theo cách của bạn.', 'gr_giay1.jpg', 'gr_giay2.jpg', 'gr_giay3.jpg', 'gr_giay4.jpg', 'New Arrival', 'Unisex', 'Canvas', 'Rubber', 580000, NULL, '2024-03-30 09:35:40'),
(144, '\r\nBASAS EVERGREEN - MULE - EVERGREEN', 5, NULL, 'gmule_giay1.jpg', 'gmule_giay2.jpg', 'gmule_giay3.jpg', 'gmule_giay4.jpg', 'New Arrival', 'Unisex', 'Canvas', 'Rubber', 580000, NULL, '2024-03-30 08:35:55'),
(153, '\r\nVINTAS SODA POP - LOW TOP - EMERALD', 1, NULL, 'em_giay1.jpg', 'em_giay2.jpg', 'em_giay3.jpg', 'em_giay4.jpg', 'New Arrival', 'Unisex', 'Cordurory', 'Rubber', 680000, NULL, '2024-03-30 10:25:19'),
(154, 'VINTAS SODA POP - LOW TOP - AMPARO BLUE', 1, NULL, 'am_giay1.jpg', 'am_giay2.jpg', 'am_giay3.jpg', 'am_giay4.jpg', 'New Arrival', 'Unisex', 'Cordurory', 'Rubber', 680000, NULL, '2024-03-30 10:24:00'),
(155, 'VINTAS SODA POP - HIGH TOP - RED VIOLET', 2, NULL, 'vio_giay1.jpg', 'vio_giay2.jpg', 'vio_giay3.jpg', 'vio_giay4.jpg', '', 'Unisex', 'Canvas', 'Rubber', 720000, NULL, '2024-03-30 08:09:59'),
(159, '\r\nPATTAS POLKA DOTS - LOW TOP - CORAL ROSE', 1, NULL, 'rose_giay1.jpg', 'rose_giay2.jpg', 'rose_giay3.jpg', 'rose_giay4.jpg', 'Sale Off', 'Unisex', 'Canvas', 'Rubber', 720000, 480000, '2024-03-30 09:37:57'),
(167, 'URBAS CORLURAY MIX - HIGH TOP - CORLURAY MIX', 2, NULL, 'corluray_giay1.jpg', 'corluray_giay2.jpg', 'corluray_giay3.jpg', 'corluray_giay4.jpg', 'Online Only', 'Unisex', 'Corduroy', 'Rubber', 650000, NULL, '2024-03-30 07:54:30'),
(171, 'PATTAS POLKA DOTS - LOW TOP - TRUE BLUE', 1, NULL, 'tru_giay1.jpg', 'tru_giay2.jpg', 'tru_giay3.jpg', 'tru_giay4.jpg', 'Sale Off', 'Unisex', 'Canvas', 'Rubber', 720000, 460000, '2024-03-30 09:39:48'),
(172, 'PATTAS POLKA DOTS - HIGH TOP - JELLY BEAN', 2, NULL, 'gdot_giay1.jpg', 'gdot_giay2.jpg', 'gdot_giay3.jpg', 'gdot_giay4.jpg', 'Sale Off', 'Unisex', 'Canvas', 'Rubber', 750000, 49000, '2024-03-30 07:51:07'),
(173, 'VINTAS JAZICO - LOW TOP - ROYAL WHITE', 1, NULL, 'roj_giay1.jpg', 'roj_giay2.jpg', 'roj_giay3.jpg', 'roj_giay4.jpg', 'New Arrival', 'Unisex', 'Suede', 'Rubber', 720000, NULL, '2024-03-30 09:59:48'),
(174, 'VINTAS JAZICO - HIGH TOP - ROYAL WHITE', 2, NULL, 'royal_giay1.jpg', 'royal_giay2.jpg', 'royal_giay3.jpg', 'royal_giay4.jpg', '', 'Unisex', 'Leather', 'Rubber', 780000, NULL, '2024-03-30 08:12:32'),
(175, 'VINTAS LANDFORMS - LOW TOP - MARMALADE', 1, NULL, 'ma_giay1.jpg', 'ma_giay2.jpg', 'ma_giay3.jpg', 'ma_giay4.jpg', 'New Arrival', 'Unisex', 'Cordurory', 'Rubber', 720000, NULL, '2024-03-30 10:26:44'),
(180, 'PATTAS TOMO - LOW TOP - BLARNEY', 1, NULL, 'blar_giay1.jpg', 'blar_giay2.jpg', 'blar_giay3.jpg', 'blar_giay4.jpg', 'New Arrival', 'Unisex', 'Canvas', 'Rubber', 7200000, NULL, '2024-03-30 10:04:14'),
(181, 'PATTAS TOMO - MULE - PRIMROSE YELLOW', 5, NULL, 'ye_giay1.jpg', 'ye_giay2.jpg', 'ye_giay3.jpg', 'ye_giay4.jpg', 'New Arrival', 'Unisex', 'Canvas', 'Rubber', 720000, NULL, '2024-03-30 08:42:50'),
(188, 'PATTAS TOMO - HIGH TOP - OFFWHITE', 2, NULL, 'tomo_giay1.jpg', 'tomo_giay2.jpg', 'tomo_giay3.jpg', 'tomo_giay4.jpg', 'New Arrival', 'Unisex', 'Canvas', 'Rubber', 750000, NULL, '2024-03-30 07:43:45'),
(191, 'URBAS SC - HIGH TOP - DUSTY BLUE', 2, NULL, 'dublue_giay1.jpg', 'dublue_giay2.jpg', 'dublue_giay3.jpg', 'dublue_giay4.jpg', 'New Arrival', 'Unisex', 'Canvas', 'Rubber', 650000, NULL, '2024-03-30 08:02:08'),
(192, 'URBAS SC - HIGH TOP - CORNSILK', 2, NULL, 'corn_giay1.jpg', 'corn_giay2.jpg', 'corn_giay3.jpg', 'corn_giay4.jpg', 'New Arrival', 'Unisex', 'Canvas', 'Rubber', 650000, NULL, '2024-03-30 07:59:54'),
(194, 'URBAS SC - HIGH TOP - FOLIAGE', 2, NULL, 'fol_giay1.jpg', 'fol_giay2.jpg', 'fol_giay3.jpg', 'fol_giay4.jpg', 'New Arrival', 'Unisex', 'Canvas', 'Rubber', 650000, NULL, '2024-03-30 08:04:03'),
(195, 'URBAS SC - HIGH TOP - ALOE WASH', 2, NULL, 'urbassc_giay1.jpg', 'urbassc_giay2.jpg', 'urbassc_giay3.jpg', 'urbassc_giay4.jpg', 'Online Only', 'Unisex', 'Canvas', 'Rubber', 650000, NULL, '2024-03-30 07:57:21'),
(196, '\r\nURBAS SC - MULE - DUSTY BLUE', 5, NULL, 'bm_giay1.jpg', 'bm_giay2.jpg', 'bm_giay3.jpg', 'bm_giay4.jpg', 'New Arrival', 'Unisex', 'Canvas', 'Rubber', 580000, NULL, '2024-03-30 08:48:28'),
(198, 'URBAS SC - MULE - ALOE WASH', 5, NULL, 'aloe_giay1.jpg', 'aloe_giay2.jpg', 'aloe_giay3.jpg', 'aloe_giay4.jpg', 'New Arrival', 'Unisex', 'Canvas', 'Rubber', 580000, NULL, '2024-03-30 08:44:58'),
(204, 'VINTAS NAUDA EXT - HIGH TOP - MONK ROBE', 2, NULL, 'robe_giay1.jpg', 'robe_giay2.jpg', 'robe_giay3.jpg', 'robe_giay4.jpg', '', 'Unisex', 'Suede', 'Rubber', 720000, NULL, '2024-03-30 08:15:04'),
(205, 'VINTAS VIVU - LOW TOP - WARM SAND', 1, NULL, 'vivu_giay1.jpg', 'vivu_giay2.jpg', 'vivu_giay3.jpg', 'vivu_giay4.jpg', 'New Arrival', 'Unisex', 'Canvas', 'Rubber', 6200000, NULL, '2024-03-30 10:10:05'),
(206, 'VINTAS VIVU - LOW TOP - PLANTATION', 1, NULL, 'pla_giay1.jpg', 'pla_giay2.jpg', 'pla_giay3.jpg', 'pla_giay4.jpg', 'New Arrival', 'Unisex', 'Canvas', 'Rubber', 6200000, NULL, '2024-03-30 10:06:15'),
(207, 'VINTAS PUBLIC 2000S - LOW TOP - INSIGNIA BLUE', 1, NULL, 'ins_giay1.jpg', 'ins_giay2.jpg', 'ins_giay3.jpg', 'ins_giay4.jpg', 'New Arrival', 'Unisex', 'Canvas', 'Rubber', 6200000, NULL, '2024-03-30 10:14:40'),
(208, 'VINTAS PUBLIC 2000S - LOW TOP - BRINDLE', 1, NULL, 'bri_giay1.jpg', 'bri_giay2.jpg', 'bri_giay3.jpg', 'bri_giay4.jpg', 'New Arrival', 'Unisex', 'Canvas', 'Rubber', 6200000, NULL, '2024-03-30 10:13:12'),
(209, 'VINTAS PUBLIC 2000S - LOW TOP - CAVIAR BLACK', 1, NULL, 'cab_giay1.jpg', 'cab_giay2.jpg', 'cab_giay3.jpg', 'cab_giay4.jpg', 'New Arrival', 'Unisex', 'Canvas', 'Rubber', 6200000, NULL, '2024-03-30 10:11:38'),
(615, 'TRACK 6 2.BLUES - LOW TOP - BLUEWASH', 1, NULL, 'bluwa_giay1.jpg', 'bluwa_giay2.jpg', 'bluwa_giay3.jpg', 'bluwa_giay4.jpg', 'New Arrival', 'Unisex', 'Leather', 'Rubber', 1290000, NULL, '2024-03-30 10:01:50'),
(2023, '\r\nURBAS LOVE+ 23 - SLIP ON - OFFWHITE', 3, NULL, 'slip_giay1.jpg', 'slip_giay2.jpg', 'slip_giay3.jpg', 'slip_giay4.jpg', '', 'Unisex', 'Canvas', 'Rubber', 550000, NULL, '2024-03-30 08:26:47'),
(60001, 'TRACK 6 OG - LOW TOP - 70S WHITE', 1, 'Với cảm hứng từ Retro Sneakers và âm nhạc giai đoạn 1970s, Ananas Track 6 ra đời với danh hiệu là mẫu giày Cold Cement đầu tiên của Ananas - một thương hiệu giày Vulcanized. Chất liệu Storm Leather đáng giá \"càn quét\" toàn bộ bề mặt upper cùng những chi tiết thiết kế đặc trưng và mang nhiều ý nghĩa. Chắc rằng, Track 6 sẽ đem đến cho bạn sự tự nhiên thú vị như chính thông điệp bài hát Let it be của huyền thoại The Beatles gửi gắm.', 'og_giay1.jpg', 'og_giay2.jpg', 'og_giay3.jpg', 'og_giay4.jpg', 'New Arrival', 'Unisex', 'Leather', 'Rubber', 990000, NULL, '2024-03-30 08:54:57'),
(61002, 'TRACK 6 TRIPLE WHITE - LOW TOP - WHITE', 1, 'Với cảm hứng từ Retro Sneakers và âm nhạc giai đoạn 1970s, Ananas Track 6 ra đời với danh hiệu là mẫu giày Cold Cement đầu tiên của Ananas - một thương hiệu giày Vulcanized. Chất liệu Storm Leather đáng giá \"càn quét\" toàn bộ bề mặt upper cùng những chi tiết thiết kế đặc trưng và mang nhiều ý nghĩa. Chắc rằng, Track 6 sẽ đem đến cho bạn sự tự nhiên thú vị như chính thông điệp bài hát Let it be của huyền thoại The Beatles gửi gắm. Màu all white chắc nhiều bạn sẽ thích.', 'wlt_giay1.jpg', 'wlt_giay2.jpg', 'wlt_giay3.jpg', 'wlt_giay4.jpg', 'New Arrival', 'Unisex', 'Leather', 'Rubber', 990000, NULL, '2024-03-30 09:02:04'),
(61003, 'TRACK 6 TRIPLE BLACK - LOW TOP - BLACK', 1, 'Với cảm hứng từ Retro Sneakers và âm nhạc giai đoạn 1970s, Ananas Track 6 ra đời với danh hiệu là mẫu giày Cold Cement đầu tiên của Ananas - một thương hiệu giày Vulcanized. Chất liệu Storm Leather đáng giá \"càn quét\" toàn bộ bề mặt upper cùng những chi tiết thiết kế đặc trưng và mang nhiều ý nghĩa. Chắc rằng, Track 6 sẽ đem đến cho bạn sự tự nhiên thú vị như chính thông điệp bài hát Let it be của huyền thoại The Beatles gửi gắm. Màu all white chắc nhiều bạn sẽ thích.', 'blt_giay1.jpg', 'blt_giay2.jpg', 'blt_giay3.jpg', 'blt_giay4.jpg', 'New Arrival', 'Unisex', 'Leather', 'Rubber', 990000, NULL, '2024-03-30 09:03:34'),
(61008, 'TRACK 6 UTILITY GUM SOLE - LOW TOP - NAVY PEONY/GU', 1, 'Từ chất liệu da lộn (suede) quen thuộc, đặt nhẹ nhàng lên \"nền tảng\" cao su màu Gum nguyên khối, đem đến sự khác biệt mà vẫn hợp lý trên tổng thể. Tất cả chi tiết tạo nên một phiên bản Track 6 Utility Gum Sole cổ điển, đơn giản tiện dụng mà vẫn thu hút đối với những tín đồ thời trang khó tính nhất.', 'navy_giay1.jpg', 'navy_giay2.jpg', 'navy_giay3.jpg', 'navy_giay4.jpg', 'New Arrival', 'Unisex', 'Suede', 'Rubber', 1090000, NULL, '2024-03-30 09:05:57'),
(61011, 'TRACK 6 UNNAMED NO.1 IN C MINOR - LOW TOP - BLACK', 1, 'Việc sử dụng phương pháp ứng tấu (improvise) với đề bài sử dụng 5 chất liệu da khác loại, khác màu trên cùng một thiết kế là chìa khoá để tạo nên đôi giày Track 6 không tên số thứ 1 (đầu tiên). Vẻ ngoài toát lên hơi hướng đượm buồn trong màu giọng Đô thứ (Cm), Track 6 Unnamed No.1 in C Minor sẽ thật sự gây bất ngờ cho những ai yêu thích việc tìm thấy sự tích cực trong những giai đoạn nhiều cảm xúc lẫn lộn đan xen.', 'minor_giay1.jpg', 'minor_giay2.jpg', 'minor_giay3.jpg', 'minor_giay4.jpg', '', 'Unisex', 'Leather', 'Rubber', 1090000, NULL, '2024-03-30 09:08:07'),
(61039, '   VINTAS MISTER - LOW TOP - NARCISSUEDE', 1, 'Dáng Low Top truyền thống, kết hợp cùng phối màu gợi nét cổ điển, xưa cũ với chất liệu da Suede. Một sự lựa chọn của những ai muốn làm nổi bật lên sự chín chắn, tính điềm đạm cùng nét lịch thiệp cho bộ outfit của mình.', 'nar_giay1.jpg', 'nar_giay2.jpg', 'nar_giay3.jpg', 'nar_giay4.jpg', 'Sale Off', 'Unisex', 'Suede', 'Rubber', 580000, 350000, '2024-03-30 08:58:34'),
(61095, 'ANANAS X LUCKY LUKE PATTAS - HIGH TOP - DALTON YEL', 2, 'Phiên bản tượng trưng cho bộ tứ \"cán cộm\" nhất bang Arizona. Thiết kế nhấn mạnh màu sắc tương phản giữa đen và vàng, khắc hoạ đúng nét \"bộ áo truyền thống\" của anh em nhà Dalton. Với nét riêng đầy ấn tượng, đây sẽ là một bản collab không thể bỏ qua với những bạn đam mê những gangster một thời gắn bó với bộ truyện Lucky Luke.', 'lucky_giay1.jpg', 'lucky_giay2.jpg', 'lucky_giay3.jpg', 'lucky_giay4.jpg', 'Sale Off', 'Unisex', 'Canvas', 'Rubber', 850000, 425000, '2024-03-30 07:33:15'),
(61113, 'ANANAS X DORAEMON 50 YEARS PATTAS - WHITE/CORYDALI', 2, 'Ananas x Doraemon 50 Years Pattas thể hiện chân thật nét vẽ nguyên bản của bộ truyện từ cái nhìn đầu tiên. Sử dụng chất liệu Action Leather (da) phủ khắp thân giày, pha trộn cùng các chi tiết đắt giá được sắp đặt hợp lí. Ra mắt với số lượng đặc biệt giới hạn, phiên bản này phát hành với mục đích kỉ niệm, tôn vinh giá trị mà bộ truyện Doraemon đã mang lại suốt 50 năm qua.', 'doraemon_giay1.jpg', 'doraemon_giay2.jpg', 'doraemon_giay3.jpg', 'doraemon_giay4.jpg', 'Limited Edition', 'Unisex', 'Canvas', 'Rubber', 890000, NULL, '2024-03-30 07:28:06'),
(62008, 'BASAS BUMPER GUM NE - LOW TOP - OFFWHITE/GUM', 1, 'Đánh dấu một bước trưởng thành nữa, Basas Bumper Gum NE (New Episode) ra đời với những cải tiến nhẹ nhàng nhưng đủ tạo được sự thay đổi trong cảm nhận khi trải nghiệm. Vẫn giữ ngoại hình gần như không thay để phát huy đặc tính ứng dụng cao của dòng Basas vốn đã được chứng minh, phần đế màu Gum thú vị và /Foxing thân/ mới làm nền cho phần chất liệu Upper được nâng cấp. Đây được xem là một trong những phiên bản được chúng tôi kì vọng có thể bền vững vượt qua thời gian và không gian, chắc chắn đáng để thử.\r\n', 'gumlt_giay1.jpg', 'gumlt_giay2.jpg', 'gumlt_giay3.jpg', 'gumlt_giay4.jpg', 'New Arrival', 'Unisex', 'Canvas', 'Rubber', 520000, NULL, '2024-03-30 09:10:59'),
(81107, 'URBAS UNSETTLING - HIGH TOP - INSIGNIA/SULPHUR', 2, 'Sở hữu công thức pha màu \"khó chịu\". Urbas Unsettling tạo nên điểm nhấn mạnh mẽ, gây kích thích thị giác thông qua sự đối lập trong từng gam màu. Điểm chốt hạ cho một outfit đặc biệt thú vị, tách biệt khỏi sự trùng lặp thông thường.', 'sulphur_giay1.jpg', 'sulphur_giay2.jpg', 'sulphur_giay3.jpg', 'sulphur_giay4.jpg', 'Sale Off', 'Unisex', 'Canvas', 'Rubber', 550000, 350000, '2024-03-30 08:07:22');

-- --------------------------------------------------------

--
-- Table structure for table `product_instock`
--

CREATE TABLE `product_instock` (
  `product_id` int(11) NOT NULL,
  `size` int(100) NOT NULL,
  `quantity` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_instock`
--

INSERT INTO `product_instock` (`product_id`, `size`, `quantity`) VALUES
(4, 35, 13),
(4, 36, 15),
(4, 37, 16),
(4, 38, 17),
(4, 39, 18),
(4, 40, 10),
(4, 41, 30),
(4, 42, 10),
(4, 43, 20),
(4, 44, 10),
(4, 45, 12),
(4, 46, 10),
(5, 35, 10),
(5, 36, 15),
(5, 37, 12),
(5, 38, 17),
(5, 39, 18),
(5, 40, 10),
(5, 41, 30),
(5, 42, 10),
(5, 43, 20),
(5, 44, 10),
(5, 45, 12),
(5, 46, 10),
(6, 35, 10),
(6, 36, 15),
(6, 37, 16),
(6, 38, 17),
(6, 39, 18),
(6, 40, 10),
(6, 41, 30),
(6, 42, 10),
(6, 43, 20),
(6, 44, 10),
(6, 45, 12),
(6, 46, 10),
(9, 35, 10),
(9, 36, 15),
(9, 37, 16),
(9, 38, 17),
(9, 39, 18),
(9, 40, 10),
(9, 41, 30),
(9, 42, 10),
(9, 43, 20),
(9, 44, 10),
(9, 45, 12),
(9, 46, 10),
(12, 35, 10),
(12, 36, 15),
(12, 37, 16),
(12, 38, 17),
(12, 39, 18),
(12, 40, 10),
(12, 41, 30),
(12, 42, 10),
(12, 43, 20),
(12, 44, 10),
(12, 45, 12),
(12, 46, 10),
(16, 35, 10),
(16, 36, 15),
(16, 37, 16),
(16, 38, 17),
(16, 39, 18),
(16, 40, 10),
(16, 41, 30),
(16, 42, 10),
(16, 43, 20),
(16, 44, 10),
(16, 45, 11),
(16, 46, 10),
(65, 35, 10),
(65, 36, 15),
(65, 37, 65),
(65, 38, 17),
(65, 39, 18),
(65, 40, 10),
(65, 41, 30),
(65, 42, 10),
(65, 43, 20),
(65, 44, 10),
(65, 45, 11),
(65, 46, 10),
(98, 35, 10),
(98, 36, 15),
(98, 37, 98),
(98, 38, 17),
(98, 39, 18),
(98, 40, 10),
(98, 41, 30),
(98, 42, 10),
(98, 43, 20),
(98, 44, 10),
(98, 45, 11),
(98, 46, 10),
(99, 35, 10),
(99, 36, 15),
(99, 37, 10),
(99, 38, 17),
(99, 39, 18),
(99, 40, 10),
(99, 41, 30),
(99, 42, 10),
(99, 43, 20),
(99, 44, 10),
(99, 45, 11),
(99, 46, 10),
(100, 35, 10),
(100, 36, 15),
(100, 37, 100),
(100, 38, 17),
(100, 39, 18),
(100, 40, 10),
(100, 41, 30),
(100, 42, 10),
(100, 43, 20),
(100, 44, 10),
(100, 45, 11),
(100, 46, 10),
(104, 35, 10),
(104, 36, 15),
(104, 37, 104),
(104, 38, 17),
(104, 39, 18),
(104, 40, 10),
(104, 41, 30),
(104, 42, 10),
(104, 43, 20),
(104, 44, 10),
(104, 45, 11),
(104, 46, 10),
(105, 35, 10),
(105, 36, 15),
(105, 37, 10),
(105, 38, 17),
(105, 39, 18),
(105, 40, 10),
(105, 41, 30),
(105, 42, 10),
(105, 43, 20),
(105, 44, 10),
(105, 45, 11),
(105, 46, 10),
(112, 35, 10),
(112, 36, 15),
(112, 37, 112),
(112, 38, 17),
(112, 39, 18),
(112, 40, 10),
(112, 41, 30),
(112, 42, 10),
(112, 43, 20),
(112, 44, 10),
(112, 45, 11),
(112, 46, 10),
(117, 35, 10),
(117, 36, 15),
(117, 37, 10),
(117, 38, 17),
(117, 39, 18),
(117, 40, 10),
(117, 41, 30),
(117, 42, 10),
(117, 43, 20),
(117, 44, 10),
(117, 45, 11),
(117, 46, 10),
(121, 35, 10),
(121, 36, 15),
(121, 37, 10),
(121, 38, 17),
(121, 39, 18),
(121, 40, 10),
(121, 41, 30),
(121, 42, 10),
(121, 43, 20),
(121, 44, 10),
(121, 45, 11),
(121, 46, 10),
(130, 35, 10),
(130, 36, 15),
(130, 37, 10),
(130, 38, 17),
(130, 39, 18),
(130, 40, 10),
(130, 41, 30),
(130, 42, 10),
(130, 43, 20),
(130, 44, 10),
(130, 45, 11),
(130, 46, 10),
(131, 35, 10),
(131, 36, 15),
(131, 37, 10),
(131, 38, 17),
(131, 39, 18),
(131, 40, 10),
(131, 41, 30),
(131, 42, 10),
(131, 43, 20),
(131, 44, 10),
(131, 45, 11),
(131, 46, 10),
(132, 35, 10),
(132, 36, 15),
(132, 37, 10),
(132, 38, 17),
(132, 39, 18),
(132, 40, 10),
(132, 41, 30),
(132, 42, 10),
(132, 43, 20),
(132, 44, 10),
(132, 45, 11),
(132, 46, 10),
(133, 35, 10),
(133, 36, 15),
(133, 37, 10),
(133, 38, 17),
(133, 39, 18),
(133, 40, 10),
(133, 41, 30),
(133, 42, 10),
(133, 43, 20),
(133, 44, 10),
(133, 45, 11),
(133, 46, 10),
(135, 35, 10),
(135, 36, 15),
(135, 37, 10),
(135, 38, 17),
(135, 39, 18),
(135, 40, 10),
(135, 41, 30),
(135, 42, 10),
(135, 43, 20),
(135, 44, 10),
(135, 45, 11),
(135, 46, 10),
(142, 35, 10),
(142, 36, 15),
(142, 37, 10),
(142, 38, 17),
(142, 39, 18),
(142, 40, 10),
(142, 41, 30),
(142, 42, 10),
(142, 43, 20),
(142, 44, 10),
(142, 45, 11),
(142, 46, 10),
(144, 35, 10),
(144, 36, 15),
(144, 37, 10),
(144, 38, 17),
(144, 39, 18),
(144, 40, 10),
(144, 41, 30),
(144, 42, 10),
(144, 43, 20),
(144, 44, 10),
(144, 45, 11),
(144, 46, 10),
(153, 35, 10),
(153, 36, 15),
(153, 37, 10),
(153, 38, 17),
(153, 39, 18),
(153, 40, 10),
(153, 41, 30),
(153, 42, 10),
(153, 43, 20),
(153, 44, 10),
(153, 45, 11),
(153, 46, 10),
(154, 35, 10),
(154, 36, 15),
(154, 37, 10),
(154, 38, 17),
(154, 39, 18),
(154, 40, 10),
(154, 41, 30),
(154, 42, 10),
(154, 43, 20),
(154, 44, 10),
(154, 45, 11),
(154, 46, 10),
(155, 35, 10),
(155, 36, 15),
(155, 37, 10),
(155, 38, 17),
(155, 39, 18),
(155, 40, 10),
(155, 41, 30),
(155, 42, 10),
(155, 43, 20),
(155, 44, 10),
(155, 45, 11),
(155, 46, 10),
(159, 35, 10),
(159, 36, 15),
(159, 37, 10),
(159, 38, 17),
(159, 39, 18),
(159, 40, 10),
(159, 41, 30),
(159, 42, 10),
(159, 43, 20),
(159, 44, 10),
(159, 45, 11),
(159, 46, 10),
(167, 35, 10),
(167, 36, 15),
(167, 37, 10),
(167, 38, 17),
(167, 39, 18),
(167, 40, 10),
(167, 41, 30),
(167, 42, 10),
(167, 43, 20),
(167, 44, 10),
(167, 45, 11),
(167, 46, 10),
(171, 35, 10),
(171, 36, 15),
(171, 37, 10),
(171, 38, 17),
(171, 39, 18),
(171, 40, 10),
(171, 41, 30),
(171, 42, 10),
(171, 43, 20),
(171, 44, 10),
(171, 45, 11),
(171, 46, 10),
(172, 35, 10),
(172, 36, 15),
(172, 37, 10),
(172, 38, 17),
(172, 39, 18),
(172, 40, 10),
(172, 41, 30),
(172, 42, 10),
(172, 43, 20),
(172, 44, 10),
(172, 45, 11),
(172, 46, 10),
(173, 35, 10),
(173, 36, 15),
(173, 37, 10),
(173, 38, 17),
(173, 39, 18),
(173, 40, 10),
(173, 41, 30),
(173, 42, 10),
(173, 43, 20),
(173, 44, 10),
(173, 45, 11),
(173, 46, 10),
(174, 35, 10),
(174, 36, 15),
(174, 37, 10),
(174, 38, 17),
(174, 39, 18),
(174, 40, 10),
(174, 41, 30),
(174, 42, 10),
(174, 43, 20),
(174, 44, 10),
(174, 45, 11),
(174, 46, 10),
(175, 35, 10),
(175, 36, 15),
(175, 37, 10),
(175, 38, 17),
(175, 39, 18),
(175, 40, 10),
(175, 41, 30),
(175, 42, 10),
(175, 43, 20),
(175, 44, 10),
(175, 45, 11),
(175, 46, 10),
(180, 35, 10),
(180, 36, 15),
(180, 37, 10),
(180, 38, 17),
(180, 39, 18),
(180, 40, 10),
(180, 41, 30),
(180, 42, 10),
(180, 43, 20),
(180, 44, 10),
(180, 45, 11),
(180, 46, 10),
(181, 35, 10),
(181, 36, 15),
(181, 37, 10),
(181, 38, 17),
(181, 39, 18),
(181, 40, 10),
(181, 41, 30),
(181, 42, 10),
(181, 43, 20),
(181, 44, 10),
(181, 45, 11),
(181, 46, 10),
(188, 35, 10),
(188, 36, 15),
(188, 37, 10),
(188, 38, 17),
(188, 39, 18),
(188, 40, 10),
(188, 41, 30),
(188, 42, 10),
(188, 43, 20),
(188, 44, 10),
(188, 45, 11),
(188, 46, 10),
(191, 35, 10),
(191, 36, 15),
(191, 37, 10),
(191, 38, 17),
(191, 39, 18),
(191, 40, 10),
(191, 41, 30),
(191, 42, 10),
(191, 43, 20),
(191, 44, 10),
(191, 45, 11),
(191, 46, 10),
(192, 35, 10),
(192, 36, 15),
(192, 37, 10),
(192, 38, 17),
(192, 39, 18),
(192, 40, 10),
(192, 41, 30),
(192, 42, 10),
(192, 43, 20),
(192, 44, 10),
(192, 45, 11),
(192, 46, 10),
(194, 35, 10),
(194, 36, 15),
(194, 37, 10),
(194, 38, 17),
(194, 39, 18),
(194, 40, 10),
(194, 41, 30),
(194, 42, 10),
(194, 43, 20),
(194, 44, 10),
(194, 45, 11),
(194, 46, 10),
(195, 35, 10),
(195, 36, 15),
(195, 37, 10),
(195, 38, 17),
(195, 39, 18),
(195, 40, 10),
(195, 41, 30),
(195, 42, 10),
(195, 43, 20),
(195, 44, 10),
(195, 45, 11),
(195, 46, 10),
(196, 35, 10),
(196, 36, 15),
(196, 37, 10),
(196, 38, 17),
(196, 39, 18),
(196, 40, 10),
(196, 41, 30),
(196, 42, 10),
(196, 43, 20),
(196, 44, 10),
(196, 45, 11),
(196, 46, 10),
(198, 35, 10),
(198, 36, 15),
(198, 37, 10),
(198, 38, 17),
(198, 39, 18),
(198, 40, 10),
(198, 41, 30),
(198, 42, 10),
(198, 43, 20),
(198, 44, 10),
(198, 45, 11),
(198, 46, 10),
(204, 35, 10),
(204, 36, 15),
(204, 37, 10),
(204, 38, 17),
(204, 39, 18),
(204, 40, 10),
(204, 41, 30),
(204, 42, 10),
(204, 43, 20),
(204, 44, 10),
(204, 45, 11),
(204, 46, 10),
(205, 35, 10),
(205, 36, 15),
(205, 37, 10),
(205, 38, 17),
(205, 39, 18),
(205, 40, 10),
(205, 41, 30),
(205, 42, 10),
(205, 43, 20),
(205, 44, 10),
(205, 45, 11),
(205, 46, 10),
(206, 35, 10),
(206, 36, 15),
(206, 37, 10),
(206, 38, 17),
(206, 39, 18),
(206, 40, 10),
(206, 41, 30),
(206, 42, 10),
(206, 43, 20),
(206, 44, 10),
(206, 45, 11),
(206, 46, 10),
(207, 35, 10),
(207, 36, 15),
(207, 37, 10),
(207, 38, 17),
(207, 39, 18),
(207, 40, 10),
(207, 41, 30),
(207, 42, 10),
(207, 43, 20),
(207, 44, 10),
(207, 45, 11),
(207, 46, 10),
(208, 35, 10),
(208, 36, 15),
(208, 37, 10),
(208, 38, 17),
(208, 39, 18),
(208, 40, 10),
(208, 41, 30),
(208, 42, 10),
(208, 43, 20),
(208, 44, 10),
(208, 45, 11),
(208, 46, 10),
(209, 35, 10),
(209, 36, 15),
(209, 37, 10),
(209, 38, 17),
(209, 39, 18),
(209, 40, 10),
(209, 41, 30),
(209, 42, 10),
(209, 43, 20),
(209, 44, 10),
(209, 45, 11),
(209, 46, 10),
(615, 35, 10),
(615, 36, 15),
(615, 37, 10),
(615, 38, 17),
(615, 39, 18),
(615, 40, 10),
(615, 41, 30),
(615, 42, 10),
(615, 43, 20),
(615, 44, 10),
(615, 45, 11),
(615, 46, 10),
(2023, 35, 10),
(2023, 36, 15),
(2023, 37, 10),
(2023, 38, 17),
(2023, 39, 18),
(2023, 40, 10),
(2023, 41, 30),
(2023, 42, 10),
(2023, 43, 20),
(2023, 44, 10),
(2023, 45, 11),
(2023, 46, 10),
(60001, 35, 10),
(60001, 36, 15),
(60001, 37, 10),
(60001, 38, 17),
(60001, 39, 18),
(60001, 40, 10),
(60001, 41, 30),
(60001, 42, 10),
(60001, 43, 20),
(60001, 44, 10),
(60001, 45, 11),
(60001, 46, 10),
(61002, 35, 10),
(61002, 36, 15),
(61002, 37, 10),
(61002, 38, 17),
(61002, 39, 18),
(61002, 40, 10),
(61002, 41, 30),
(61002, 42, 10),
(61002, 43, 20),
(61002, 44, 10),
(61002, 45, 11),
(61002, 46, 10),
(61003, 35, 10),
(61003, 36, 15),
(61003, 37, 10),
(61003, 38, 17),
(61003, 39, 18),
(61003, 40, 10),
(61003, 41, 30),
(61003, 42, 10),
(61003, 43, 20),
(61003, 44, 10),
(61003, 45, 11),
(61003, 46, 10),
(61008, 35, 10),
(61008, 36, 15),
(61008, 37, 10),
(61008, 38, 17),
(61008, 39, 18),
(61008, 40, 10),
(61008, 41, 30),
(61008, 42, 10),
(61008, 43, 20),
(61008, 44, 10),
(61008, 45, 11),
(61008, 46, 10),
(61011, 35, 10),
(61011, 36, 15),
(61011, 37, 10),
(61011, 38, 17),
(61011, 39, 18),
(61011, 40, 10),
(61011, 41, 30),
(61011, 42, 10),
(61011, 43, 20),
(61011, 44, 10),
(61011, 45, 11),
(61011, 46, 10),
(61039, 35, 10),
(61039, 36, 15),
(61039, 37, 10),
(61039, 38, 17),
(61039, 39, 18),
(61039, 40, 10),
(61039, 41, 30),
(61039, 42, 10),
(61039, 43, 20),
(61039, 44, 10),
(61039, 45, 11),
(61039, 46, 10),
(61095, 35, 10),
(61095, 36, 15),
(61095, 37, 10),
(61095, 38, 17),
(61095, 39, 18),
(61095, 40, 10),
(61095, 41, 30),
(61095, 42, 10),
(61095, 43, 20),
(61095, 44, 10),
(61095, 45, 11),
(61095, 46, 10),
(61113, 35, 10),
(61113, 36, 15),
(61113, 37, 10),
(61113, 38, 17),
(61113, 39, 18),
(61113, 40, 10),
(61113, 41, 30),
(61113, 42, 10),
(61113, 43, 20),
(61113, 44, 10),
(61113, 45, 11),
(61113, 46, 10),
(62008, 35, 10),
(62008, 36, 15),
(62008, 37, 10),
(62008, 38, 17),
(62008, 39, 18),
(62008, 40, 10),
(62008, 41, 30),
(62008, 42, 10),
(62008, 43, 20),
(62008, 44, 10),
(62008, 45, 11),
(62008, 46, 10),
(81107, 35, 10),
(81107, 36, 15),
(81107, 37, 10),
(81107, 38, 17),
(81107, 39, 18),
(81107, 40, 10),
(81107, 41, 30),
(81107, 42, 10),
(81107, 43, 20),
(81107, 44, 10),
(81107, 45, 11),
(81107, 46, 10);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
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
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `name`, `avatar`, `phone`, `address`, `updated_at`, `verify_code`, `active`) VALUES
(1, 'loc.nguyenminh1605@hcmut.edu.vn', '$2y$10$siuK.ty2iGOGYRsVCfl.t.gh2qCENdUZHyW8OJuoC/kGfMJmsTkdq', 'Nguyễn Minh Lộc', NULL, '0379626794', 'Ký túc xá khu A, ĐHQG. Bình Dương, Hồ Chí Minh', '2024-04-06 21:03:16', 160503, b'1'),
(5, 'duytan17112003@gmail.com', '$2y$10$QaS71.RefQ0UKnmICzylReeTvp3bhIuBGScVS4G2YxSX5Dh4JjIBm', 'Defttt', NULL, '0944877824', 'thị trấn ialy, gia lai', '2024-04-11 08:09:51', 225935, b'1');

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
-- Indexes for table `cost_range`
--
ALTER TABLE `cost_range`
  ADD PRIMARY KEY (`range_id`);

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
  ADD PRIMARY KEY (`order_id`,`product_id`,`size_item`),
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
-- Indexes for table `product_instock`
--
ALTER TABLE `product_instock`
  ADD PRIMARY KEY (`product_id`,`size`,`quantity`),
  ADD KEY `FK_product` (`product_id`);

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
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cost_range`
--
ALTER TABLE `cost_range`
  MODIFY `range_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81108;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- Constraints for table `product_instock`
--
ALTER TABLE `product_instock`
  ADD CONSTRAINT `FK_product	` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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

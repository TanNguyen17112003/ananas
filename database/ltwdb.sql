-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2023 at 01:48 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
CREATE DATABASE ltwdb;
USE ltwdb;
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
(1, 'binh381672943@gmail.com', 'binh381672943', 'Binh_real', 1, '2023-11-16 01:16:07'),
(2, 'binhnguyen3816@gmail.com', 'binhnguyen3816', 'Nguyen_Duc_Binh', 1, '2023-11-16 01:17:08'),
(3, 'nguyenducbinh26092003@gmail.com', 'nguyenducbinh26092003', 'Admin', 1, '2023-11-16 18:34:23');

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
(1, 'Huy', 'huylg2109@gmail.com', 'Hi, thank you for your recent inquiry. Let us know how we did by completing this short survey. It takes less than a minute to complete.', 0, '2023-11-16 14:21:58'),
(2, 'Huy', 'huylg2109@gmail.com', 'Huy, it’s been a while; we miss you! Let us know if there’s anything we can do to improve your experience or if you have any questions for us. We value you and would love to hear from you.', 0, '2023-11-16 14:22:35'),
(3, 'Huân', 'huan@gmail.com', 'Hi, this is to confirm that your recent support ticket has been resolved and closed. We thank you for your patience.', 0, '2022-12-08 14:29:18'),
(4, 'Hậu', 'hau.nguyenbk8786@gmail.com', 'Use these to celebrate customer anniversaries, an upcoming holiday, or birthday. “Happy Birthday Hậu! As an extra-special thank you for being a loyal customer, here’s $50 on us. Use it toward any of your favorite products.', 0, '2023-11-16 14:49:39');

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
(1, 'HI-TEA HEALTHY: DA ĐẸP DÁNG XINH - RINH DEAL 0Đ', 'Mùa lễ hội đến gần, cần da đẹp dáng xinh phát mê, thì hổng được bỏ qua Hi-Tea Healthy bạn nha. Nhà còn có deal 0Đ dành tặng bạn nữa nè 💃💃\r\n💃\r\n\r\n\r\n🔸 Nhập mã: HITEADAY\r\n\r\n🔸 Thứ 3 hàng tuần: 13, 20, 27/12\r\n\r\n🔸 Áp dụng ly Hi-Tea thứ 2 giá 0đ, khi mua một ly Hi-Tea bất kỳ cho đơn Giao hàng\r\n\r\n👉 Mãi “biu tì”, chốt ngay Hi-Tea!\r\n\r\n', '2022-12-07 10:51:25', 'https://feed.thecoffeehouse.com//content/images/2022/12/NOTI--22-.jpg'),
(2, 'ĐẠI TIỆC LINH ĐÌNH - RINH DEAL MUA 1 TẶNG 1', 'Black Friday vừa qua, deal Nhà siêu to MUA 1 TẶNG 1 ở lại. Cùng bạn mở tiệc thiệt hoành tráng, mừng ngày “anh lương” ghé thăm 😜.\r\n\r\n\r\n🔸 Nhập mã: DAITIEC\r\n\r\n🔸 Thời gian: 02/12 - 07/12\r\n\r\n🔸 Áp dụng cho Hi-Tea/CloudTea/CloudFee/The Coffee House Sữa Đá cho đơn Giao hàng\r\n\r\n👉 Nhà hùn vốn rồi đó, còn khum mau mau chốt đơn!', '2022-12-07 11:11:19', 'https://feed.thecoffeehouse.com//content/images/2022/12/noti--19-.jpg'),
(3, 'BÁNH NƯỚC ĐỦ ĐẦY - CHỚP NGAY COMBO 3 MÓN CHỈ 99K', 'Cuối tuần rồi, chạy về nhà thôi. Nơi có ba có mẹ và trăm chuyện tỉ tê trên đời 👨‍👩‍👧‍👦\r\n\r\nNhà góp chút “ấm áp” để nhà mình thêm vui bạn nhé!\r\n\r\n\r\n🔸 Nhập mã: FAMILYDAY\r\n\r\n🔸 Thứ 7, CN hàng tuần: 10-11,17-18, 24-25/12\r\n\r\nMón 1: 01 Cà phê VN/CloudFee\r\nMón 2: 01 Hi-Tea/Trà trái cây/Trà sữa/CloudTea\r\nMón 3: 01 Chocolate hoặc bánh Mousse/Chà bông phô mai/Croissant trứng muối\r\n🔸 Áp dụng size M cho đơn Giao hàng\r\n\r\n👉 Chớp deal đi chờ chi!', '2022-12-07 11:13:45', 'https://feed.thecoffeehouse.com//content/images/2022/12/NOTI--16-.jpg'),
(4, 'GHÉ NHÀ MANG ĐI - RƯỚC DEAL MÊ LY', 'Biết bạn dạo này bận lắm, nhưng món nước yêu thích thì hổng thể thiếu 😢\r\n\r\nThương thương! Từ ngày 01/12 - 31/12, Nhà mời ngay 10% cho đơn Mang đi, để bạn không chỉ được thưởng thức món ngon mà còn tiện lợi nữa nè ^^\r\n\r\n\r\n🔸 Nhập mã: GHENHANHE\r\n\r\n🔸 Thời gian: 01/12 - 31/12\r\n\r\n🔸 Áp dụng cho đơn Mang đi từ 2 món bất kỳ\r\n\r\nGhé Nhà Mang đi nào bạn ơi!', '2022-12-07 11:13:50', 'https://feed.thecoffeehouse.com//content/images/2022/12/NOTI--18-.jpg'),
(5, 'NƯỚC NGON TUYỆT VỜI - NHÀ MỜI CHỈ TỪ 19K', 'Cầu được ước thấy! Món ghiền của bạn mỗi ngày, nay Nhà ưu đãi chỉ từ 19K ^^  Từ 01/12 - 31/12, bạn tranh thủ rước deal lia lịa nha: Cà phê 19K/ The Coffee House Sữa Đá 29K/Trà trái cây, CloudFee 39K\r\n\r\n🔸 Nhập mã: TUYETVOI\r\n\r\n🔸 Áp dụng size M khi mua cùng bánh bất kỳ, cho đơn Giao hàng.\r\n\r\n🔸  Không áp dụng cho nước đóng chai Fresh và topping\r\n\r\n🔸 Không áp dụng cho các chương trình khuyến mãi song song\r\n\r\n*Không áp dụng cho Bánh mì que\r\n\r\n👉 Xế Nhà giao ngay, chốt đơn liền tay!', '2022-12-07 11:14:45', 'https://feed.thecoffeehouse.com//content/images/2022/12/NOTI--17-.jpg'),
(6, 'SÁNG NO NÊ, BÁNH MÌ GẬY THIỆT MÊ CHỈ 9K', 'Nhà phát hiện dạo này có người hay bỏ bữa sáng lắm 😭\r\n\r\nNên từ ngày 01/12 - 31/12, Nhà ủ mưu lắp đầy chiếc bụng đói bằng Bánh mì Gậy ngon ngon, nhanh gọn chỉ với 9K thôi nè ^^\r\n\r\n\r\n🔸Nhập mã: ANSANG9K\r\n\r\n🔸Thời gian: 07:00 - 14:00\r\n\r\n🔸Áp dụng khi mua kèm 1 nước (size M, L) bất kỳ cho đơn Giao hàng\r\n\r\n🔸Không áp dụng cho nước đóng chai Fresh và topping\r\n\r\n🔸Không áp dụng cho các chương trình khuyến mãi song song\r\n\r\n👉 Có thực mới vực được deadline, chốt đơn ngay bạn nhé!', '2022-12-07 11:17:39', 'https://feed.thecoffeehouse.com//content/images/2022/12/noti--21-.jpg'),
(7, 'BÊN NHAU NHIỀU - NHÀ CHIỀU DEAL ĐẬM', 'Chỉ cần được bên bạn mỗi ngày, Nhà hổng ngại chiều deal đậm 😘\r\n\r\nTừ ngày 01/12 - 31/12, Nhà giảm lớn đến 70K, thoả thích thưởng thức bánh nước thơm ngon bạn nha ^^\r\n\r\n\r\n🔸 Giảm 35K đơn từ 169K\r\n\r\nNhập mã: BENNHAU35\r\n\r\n🔸 Giảm 70K đơn từ 289K\r\n\r\nNhập mã: BENNHAU70\r\n\r\n🔸 Áp dụng cho bánh, nước cho đơn Giao hàng.\r\n\r\n🔸 Không áp dụng cho nước đóng chai Fresh và topping\r\n\r\n🔸 Không áp dụng cho các chương trình khuyến mãi song song\r\n\r\n👉  Đặt đi, chờ chi!', '2022-12-07 11:18:23', 'https://feed.thecoffeehouse.com//content/images/2022/12/noti--20-.jpg'),
(8, 'MANG ĐI CÙNG NHÀ - GIẢM NGAY 15%', 'Biết bạn dù bận bịu nhưng nước ngon thì không thể thiếu 😜\r\n\r\n\r\nNên từ ngày 01/11 - 30/11, Nhà mời ngay deal 15% nè cho đơn Mang đi nè.\r\n\r\n🔸 Nhập mã: GHENHA\r\n\r\n🔸 Áp dụng đơn hàng từ 2 món\r\n\r\nMở app, mang đi rốp rẻng liền nha!', '2022-12-07 11:19:04', 'https://feed.thecoffeehouse.com//content/images/2022/11/NOTI--6-.jpg'),
(9, 'VITAMIN TỈNH TÁO - NHÀ KHAO DEAL CHỈ TỪ 25K', 'Xử gọn deadline, thứ 2 không còn ngập task. Vì có vitamin tỉnh táo, Nhà mời rồi đây 😍\r\n\r\n\r\nTừ ngày 01/11 - 30/11, bạn nhớ chớp ngay deal The Coffee House Sữa Đá, Coldbrew Phúc Bồn Tử chỉ 25K và Cà phê CloudFee chỉ 35K\r\n\r\n🔸 Nhập mã: CAPHEDAY\r\n\r\n🔸 Thứ 2 hàng tuần từ 07:00 - 13:00\r\n\r\n🔸 Áp dụng size M cho đơn Giao hàng\r\n\r\n👉 Mở app liền tay, chốt đơn lia lịa ngay!', '2022-12-07 11:20:00', 'https://feed.thecoffeehouse.com//content/images/2022/11/NOTI--1-.jpg'),
(10, 'ĐẠI TIỆC TRÀ - 3 LY CHỈ 99K', 'Thứ 6 rồi, mở tiệc linh đình thôi team mình ơi😍\r\n\r\nTừ ngày 01/11 - 30/11, Nhà mời ngay combo 3 ly trà chỉ 99K, để chúng mình thoải mái chill nước ngon đã đời, mà chẳng lo về giá ^^\r\n\r\n\r\n🔸 Nhập mã: PARTEADAY\r\n\r\n🔸 Thời gian: Thứ 6 hàng tuần (từ 01/11 - 30/11)\r\n\r\n🔸 Áp dụng Trà trái cây, Hi-Tea, Trà sữa, CloudTea (size M) cho đơn Giao hàng\r\n\r\nĐặt ngay đi chờ chi!', '2022-12-07 11:21:18', 'https://feed.thecoffeehouse.com//content/images/2022/11/noti--9-.jpg');

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
(1, 'Hồng trà Đài Loan', 1, 'Hồng trà đài loan', 'hong-tra-dai-loan-zvyjy3xt.jpg', 10, 39000, 16000, '2023-01-08 15:29:11'),
(2, 'Trà bí đao Ngô Gia', 1, 'Trà bí đao Ngô Gia', 'tra-bi-dao-ngo-gia-q38efry9.jpg', 10, 39000, 19000, '2023-01-08 15:29:11'),
(3, 'Hồng trà vải thiều', 1, 'Hồng trà vải thiều', 'hong-tra-vai-thieu-2isu3y9o.jpg', 10, 39000, 19000, '2023-01-08 15:29:11'),
(4, 'Trà xanh hoa nhài', 1, 'Trà xanh hoa nhài', 'tra-xanh-hoa-nhai-f2vkxmvu.jpg', 10, 39000, 19000, '2023-01-08 15:29:11'),
(5, 'Trà xanh bí đao', 1, 'Trà xanh bí đao', 'tra-xanh-bi-dao-t9gm7g3c.jpg', 10, 39000, 19000, '2023-01-08 15:29:11'),
(6, 'Hồng trà bí đao', 1, 'Hồng trà bí đao', 'hong-tra-bi-dao-sccrscoa.jpg', 10, 39000, 19000, '2023-01-08 15:29:11'),
(7, 'Trà sương sáo', 1, 'Trà sương sáo', 'tra-suong-sao-4sm5ysso.png', 10, 39000, 19000, '2023-01-08 15:29:11'),
(8, 'Bí đao sương sáo', 1, 'Bí đao sương sáo', 'bi-dao-suong-sao-qb2cpm44.png', 10, 39000, 19000, '2023-01-08 15:29:11'),
(9, 'Sương sáo latte', 2, 'Sương sáo latte', 'suong-sao-latte-as9ofqbf.png', 20, 39000, 16000, '2023-01-08 15:29:11'),
(10, 'Trân châu đường đen latte', 2, 'Trân châu đường đen latte', 'sua-tuoi-tran-chau-duong-den-5stas08q.jpg', 10, 39000, 19000, '2023-01-08 15:29:11'),
(11, 'Trà xanh latte', 2, 'Trà xanh latte', 'tra-xanh-latte-lbm6ltnr.jpg', 10, 39000, 19000, '2023-01-08 15:29:11'),
(12, 'Hồng trà latte vải thiều', 2, 'Hồng trà latte vải thiều', 'hong-tra-latte-vai-thieu-w3lcixhg.jpg', 10, 39000, 19000, '2023-01-08 15:29:11'),
(13, 'Bí đao latte', 2, 'Bí đao latte', 'bi-dao-latte-dmzbutlw.jpg', 10,239000, 19000, '2023-01-08 15:29:11'),
(14, 'Hồng trà latte Đài Loan', 2, 'Hồng trà latte Đài Loan', 'hong-tra-latte-dai-loan-kvmyjjtc.jpg', 10,239000, 19000, '2023-01-08 15:29:11'),
(15, 'Trà xanh chanh', 3, 'Trà xanh chanh', 'tra-xanh-chanh-tolzbxkm.jpg', 10,239000, 19000, '2023-01-08 15:29:11'),
(16, 'Hồng trà chanh vải thiều', 3, 'Hồng trà chanh vải thiều', 'hong-tra-chanh-vai-thieu-zlk6nqui.jpg', 10,239000, 19000, '2023-01-08 15:29:11'),
(17, 'Trà chanh bí đao', 3, 'Trà chanh bí đao', 'tra-bi-dao-chanh-iioyjqd0.jpg', 10,239000, 19000, '2023-01-08 15:29:11'),
(18, 'Trà sữa sương sáo', 4, 'Trà sữa sương sáo', 'tra-sua-suong-sao-laessvwl.png', 10,239000, 19000, '2023-01-08 15:29:11'),
(19, 'Trà xanh sữa', 4, 'Trà xanh sữa', 'tra-xanh-sua-efbubhnb.jpg', 10,239000, 19000, '2023-01-08 15:29:11'),
(20, 'Trà sữa vải thiều', 4, 'Trà sữa vải thiều', 'tra-sua-vai-thieu-mcpbo5wd.jpg', 10,239000, 19000, '2023-01-08 15:29:11'),
(21, 'Trà sữa bí đao', 4, 'Trà sữa bí đao', 'tra-sua-bi-dao-qxo9y6dn.jpg', 10,239000, 19000, '2023-01-08 15:29:11'),
(22, 'Trà sữa Đài Loan', 4, 'Trà sữa Đài Loan', 'tra-sua-dai-loan-qlgi7h4z.jpg', 10,239000, 19000, '2023-01-08 15:29:11'),
(23, 'Trà xanh yakult', 5, 'Trà xanh yakult', 'tra-xanh-yakult-ciiwdu3q.jpg', 10,239000, 19000, '2023-01-08 15:29:11'),
(24, 'Hồng trà yakult', 5, 'Hồng trà yakult', 'hong-tra-yakult-vai-thieu-p2eqjjyy.jpg', 10,239000, 19000, '2023-01-08 15:29:11'),
(25, 'Bí đao yakult Ngô Gia', 5, 'Bí đao yakult Ngô Gia', 'bi-dao-yakult-ngo-gia-des0qgwx.jpg', 10,239000, 19000, '2023-01-08 15:29:11'),
(26, 'Hồng trà yakult Đài Loan', 5, 'Hồng trà yakult Đài Loan', 'hong-tra-yakult-dai-loan-71tovysw.jpg', 10,239000, 19000, '2023-01-08 15:29:11');
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
(31, 'hau.nguyenbk8786@gmail.com', '53a627fac6f4700e04f4d9508fab393a', 'Nguyễn Đức Hậu', NULL, '0382848786', 'Kí túc xá Khu B, Đông Hòa, Dĩ An, Bình Dương', '2023-01-27 03:01:57', 111127377, 1),
(34, 'hau.nguyenbk19@hcmut.edu.vn', '43fb750eedc948a953f1985ed3bbdd55', 'GunKK', NULL, '0382848786', 'Kí túc xá Khu B, Đông Hòa, Dĩ An, Bình Dương', '2023-01-27 03:05:41', 181030442, 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

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

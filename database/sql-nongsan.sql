-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2022 at 05:46 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sql-nongsan`
--

-- --------------------------------------------------------

--
-- Table structure for table `chatbot`
--

CREATE TABLE `chatbot` (
  `ID` int(11) NOT NULL,
  `user` text NOT NULL,
  `chatbot` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chatbot`
--

INSERT INTO `chatbot` (`ID`, `user`, `chatbot`) VALUES
(1, 'da đẹp', 'Bạn nên ăn rau để có một làn da thật tươi mát!'),
(2, 'tất cả trái cây', 'Bạn vui lòng truy cập link: http://127.0.0.1:8000/danh-muc-san-pham/7 để lựa trái cây nhé'),
(3, 'cam', 'Bạn vui lòng truy cập link: http://127.0.0.1:8000/danh-muc-san-pham/7 để lựa cam nhé'),
(4, 'táo', 'Bạn vui lòng truy cập link: http://127.0.0.1:8000/danh-muc-san-pham/7 để lựa táo nhé'),
(5, 'nhà cung cấp', 'Rất chào mừng bạn thành nhà cung cấp của cửa hàng chúng tôi!');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `address`, `email`, `password`, `created_at`, `updated_at`, `phone`) VALUES
(6, 'Nguyễn Thùy Linh', '22/14 Phan Văn Hớn, Quận 12', 'thuylinh@gmail.com', '$2y$10$riJIpGiUCby/wECgIbeC/.hrXIexdJs5G5.5ycYBsZeOAPHkYXn9C', NULL, NULL, '123'),
(7, 'Nguyen Truong', 'Quận 12', 'hoangtruong188@gmail.com', '$2y$10$oHnvTWRGNX1kpj2N9eUPLezOnC5pW1WlN7uxD/Zb2AHx1BjJgph7y', NULL, NULL, '0704804311'),
(8, 'Nguyễn Hoàng Thanh', '25B Tô Vĩnh Diện', 'hoangthanh@gmail.com', '$2y$10$o4X5uVuleDftDge0MlKAxOsJ/9dCcwXtZACxrYT.DS4W6T9vS7Ei6', NULL, NULL, '0704804311'),
(9, 'Nguyễn Hoàng Thanh', 'hoangtruong1808@gmail.com', '25B Tô Vĩnh Diện', '$2y$10$N/yXpB.zE7gdzxkOKaEFQOwgOm0X8or3E4Cu/dStuKGhpwzbY0czi', NULL, NULL, '12334'),
(10, 'Nguyễn Hoàng Trường', '25B Tô Vĩnh Diện', 'truong123@gmail.com', '$2y$10$KKFsmJtDJq4bdWSkwfFqdOa3Z7iqeuW6QJMrf/UUlohxPaCifN0Um', NULL, NULL, '123456'),
(11, 'Tuấn', 'tuan', 'hoangtruong1808@gmail.com', '$2y$10$F/3w.EZpMVwkoo/xtr94weY8NeVZN3YxDZou5Lyu/wE9TwymH8VmC', NULL, NULL, '123'),
(13, 'Nguyễn Hoàng Trường', '25B Tô Vĩnh Diện', 'truong@gmail.com', '$2y$10$Ny13QqBI9jVHF00vqjYAw.DLpdJDYr8ih3Or6kDSF76e11wUbB/Iq', NULL, NULL, '0704804311'),
(14, 'Nguyễn Hoàng Trường', '25B Tô Vĩnh Diện', 'hoangtruong1808@gmail.com', '$2y$10$eWBV/R7m.sqQpmEZaZJ0eOmueRHAFDDmiD3WVuVjlnHd13NxdBXgy', NULL, NULL, '0704804311'),
(15, 'Nguyễn Hoàng Trường', '25B Tô Vĩnh Diện', 'hoangtruong1808@gmail.com', '$2y$10$U7Zl57PTRj/gp2xIeQ21AejC.u7pEtnddkhAGbfLFb5BwqhvCwtYu', NULL, NULL, '123456'),
(16, 'Nguyễn Hoàng Trường', '25B Tô Vĩnh Diện', 'hoangtruong1808@gmail.com', '$2y$10$U8FqBNEqSPYBhsjdg0VvjeGvTJPHkqCD7OJ7JVmbVh8uqC8OwYcIq', NULL, NULL, '0704804311'),
(9999, ' Khách vãng lai', ' ', ' ', ' ', NULL, NULL, ' ');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `active`, `created_at`, `updated_at`, `description`) VALUES
(6, 'Rau củ', 1, NULL, NULL, 'Để sản xuất rau sạch đảm bảo vệ sinh an toàn thực phẩm, chúng tôi đảm bảo các nguyên tắc sau: chọn đất, nước tưới, phân bón, giống, bảo vệ thực vật, thu hoạch và bao gói.'),
(7, 'Trái cây', 1, NULL, NULL, 'Trái cây tươi và sạch sẽ, đảm bảo an toàn vệ sinh thực phẩm cho Quý Khách Hàng.'),
(8, 'Thủy - hải sản', 1, NULL, NULL, 'Thủy hản sản đươc nuôi trồng và tiến hành theo quy trình nuôi trồng thủy sản dựa trên tiêu chuẩn vệ sinh nghiêm ngặc và với sự tôn trọng môi sinh.'),
(9, 'Đồ khô', 1, NULL, NULL, 'Có đặc tính tiện lợi, dễ chế biến, dễ bảo quản và để được lâu, có thể ăn dài ngày trong mùa dịch.');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `ID` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `time` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`ID`, `customer_id`, `content`, `time`, `status`) VALUES
(1, 11, 'Cam còn sản phẩm không ạ', '2021-12-24 02:07:21', 1),
(2, 11, 'Xin chào shop, mình muốn trở thành nhà cung cấp', '2021-12-24 02:07:21', 1),
(3, 11, 'Xin chào vegeefood', '2021-12-24 02:21:08', 1),
(4, 11, 'Tôi muốn ăn cam', '2021-12-24 02:21:18', 1),
(6, 13, 'Chất lượng rau cần cải thiện', '2021-12-24 02:23:09', 1),
(10, 11, 'Muốn da đẹp ăn gì', '2021-12-24 10:48:43', 1),
(12, 15, 'Các loại quả', '2021-12-31 07:14:37', 1),
(13, 16, 'Mình muốn mua cá khô', '2021-12-31 07:37:06', 1),
(14, 11, 'Tôi muốn mua trái cây', '2022-01-08 02:01:01', 0),
(15, 11, 'Tôi muốn mua cam', '2022-01-08 02:01:09', 0),
(16, 11, 'Ăn gì để da đẹp', '2022-01-08 02:03:07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_09_21_030430_create_menu_table', 1),
(6, '2021_09_21_040900_add_description_column_to_menu_table', 2),
(7, '2021_09_21_070847_create_product_table', 3),
(8, '2021_09_24_032204_add_type_column_to_product_table', 4),
(9, '2021_09_28_020539_add_columns_to_product_table', 5),
(10, '2021_10_01_084158_create_customer_table', 6),
(11, '2021_10_04_092038_create_shipping_table', 7),
(12, '2021_10_05_033054_add_phone_column_to_customer_table', 8),
(13, '2021_10_08_075754_create_order_table', 9),
(14, '2021_10_08_081045_create_order_detail_table', 9),
(15, '2021_10_08_083128_add_foreign_key_to_order_table', 10),
(16, '2021_10_08_083612_create_payment_table', 11),
(17, '2021_10_08_084253_add_foreign_key2_to_order_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shipping_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `customer_id`, `shipping_id`, `status`, `total`, `created_at`, `updated_at`, `payment_id`) VALUES
(5, 6, 14, 'Đã nhận hàng', 362250, '2021-10-08 02:16:15', NULL, 11),
(6, 8, 15, 'Đang xử lý', 422625, '2021-10-15 01:43:07', NULL, 12),
(7, 8, 16, 'Đang xử lý', 422625, '2021-10-15 01:46:49', NULL, 13),
(8, 9, 18, 'Đang xử lý', 134400, '2021-12-21 20:06:45', NULL, 14),
(9, 10, 19, 'Đang xử lý', 220500, '2021-12-22 18:19:15', NULL, 15),
(10, 10, 20, 'Đang xử lý', 224175, '2021-12-22 19:00:27', NULL, 16),
(11, 10, 21, 'Đang giao hàng', 3150, '2021-12-22 19:01:18', NULL, 17),
(12, 10, 22, 'Đang giao hàng', 16800, '2021-12-22 19:02:37', NULL, 18),
(13, 9, 23, 'Đang xử lý', 3570, '2021-12-22 19:06:08', NULL, 19),
(14, 9, 24, 'Đang xử lý', 0, '2021-12-22 19:06:29', NULL, 20),
(15, 11, 25, 'Đã nhận hàng', 4200, '2021-12-22 20:45:29', NULL, 21),
(16, 11, 26, 'Đã nhận hàng', 33600, '2021-12-22 21:05:31', NULL, 22),
(17, 11, 27, 'Đã nhận hàng', 1575, '2021-12-22 23:36:32', NULL, 23),
(18, 11, 28, 'Đã nhận hàng', 83475, '2021-12-23 05:15:22', NULL, 24),
(21, 14, 31, 'Đang giao hàng', 3150, '2021-12-30 20:44:55', NULL, 27),
(23, 14, 33, 'Đang xử lý', 5250, '2021-12-30 23:05:17', NULL, 29),
(24, 15, 34, 'Đã nhận hàng', 115500, '2021-12-31 00:10:19', NULL, 30),
(25, 16, 35, 'Đang xử lý', 1575, '2021-12-31 00:26:59', NULL, 31),
(26, 9999, 39, 'Đang xử lý', 165900, '2022-01-06 06:11:32', NULL, 35),
(27, 9999, 40, 'Đang xử lý', 0, '2022-01-06 06:11:53', NULL, 36),
(29, 9999, 42, 'Đang xử lý', 33600, '2022-01-06 06:18:44', NULL, 38),
(30, 11, 43, 'Đang xử lý', 50400, '2022-01-07 16:59:01', NULL, 39),
(31, 11, 44, 'Đang xử lý', 0, '2022-01-07 17:01:00', NULL, 40),
(32, 9999, 45, 'Đang xử lý', 31500, '2022-01-07 18:57:47', NULL, 41),
(33, 9999, 46, 'Đang xử lý', 0, '2022-01-07 18:58:03', NULL, 42);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `price` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `product_id`, `order_id`, `price`, `name`, `quantity`) VALUES
(7, 7, 5, 160000, 'Quýt đường', 1),
(8, 19, 5, 15000, 'Dưa hấu', 1),
(9, 18, 5, 250000, 'Cá bò khô Bá Kiến', 1),
(10, 5, 6, 25000, 'Rau muống', 3),
(11, 18, 6, 250000, 'Cá bò khô Bá Kiến', 1),
(12, 8, 6, 395000, 'Dâu tây Đà Lạt', 1),
(13, 5, 7, 25000, 'Rau muống', 3),
(14, 18, 7, 250000, 'Cá bò khô Bá Kiến', 1),
(15, 8, 7, 395000, 'Dâu tây Đà Lạt', 1),
(16, 7, 8, 160000, 'Quýt đường', 1),
(17, 17, 9, 420000, 'Cá hồi NaUy', 1),
(18, 7, 10, 160000, 'Quýt đường', 0),
(19, 6, 10, 350000, 'Cherry Canada', 0),
(20, 19, 10, 15000, 'Dưa hấu', 0),
(21, 8, 10, 395000, 'Dâu tây Đà Lạt', 0),
(22, 19, 11, 15000, 'Dưa hấu', 0),
(23, 7, 12, 160000, 'Quýt đường', 0),
(24, 9, 13, 17000, 'Cà rốt to', 0),
(25, 9, 15, 17000, 'Cà rốt to', 0),
(26, 10, 15, 6000, 'Cà chua Mộc Châu', 0),
(27, 7, 16, 160000, 'Quýt đường', 0.2),
(28, 19, 17, 15000, 'Dưa hấu', 0.1),
(29, 19, 18, 15000, 'Dưa hấu', 1.9),
(30, 9, 18, 17000, 'Cà rốt to', 3),
(33, 19, 21, 15000, 'Dưa hấu', 0.2),
(35, 5, 23, 25000, 'Rau muống', 0.2),
(36, 5, 24, 25000, 'Rau muống', 1.2),
(37, 7, 24, 160000, 'Quýt đường', 0.5),
(38, 19, 25, 15000, 'Dưa hấu', 0.1),
(39, 8, 26, 395000, 'Dâu tây Đà Lạt', 0.4),
(40, 7, 29, 160000, 'Quýt đường', 0.2),
(41, 7, 30, 160000, 'Quýt đường', 0.3),
(42, 5, 32, 25000, 'Rau muống', 1.2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `created_at`, `updated_at`, `method`, `status`) VALUES
(11, NULL, NULL, 'Chuyển tiền trực tiếp', 'Đang xử lý'),
(12, NULL, NULL, 'Thanh toán khi nhận hàng', 'Đang xử lý'),
(13, NULL, NULL, 'Chuyển tiền trực tiếp', 'Đang xử lý'),
(14, NULL, NULL, 'Chuyển tiền trực tiếp', 'Đang xử lý'),
(15, NULL, NULL, 'Chuyển tiền trực tiếp', 'Đang xử lý'),
(16, NULL, NULL, 'Chuyển tiền trực tiếp', 'Đang xử lý'),
(17, NULL, NULL, 'Thanh toán khi nhận hàng', 'Đang xử lý'),
(18, NULL, NULL, 'Thanh toán khi nhận hàng', 'Đang xử lý'),
(19, NULL, NULL, 'Chuyển tiền trực tiếp', 'Đang xử lý'),
(20, NULL, NULL, 'Chuyển tiền trực tiếp', 'Đang xử lý'),
(21, NULL, NULL, 'Chuyển tiền trực tiếp', 'Đang xử lý'),
(22, NULL, NULL, 'Chuyển tiền trực tiếp', 'Đang xử lý'),
(23, NULL, NULL, 'Thanh toán khi nhận hàng', 'Đang xử lý'),
(24, NULL, NULL, 'Chuyển tiền trực tiếp', 'Đang xử lý'),
(25, NULL, NULL, 'Chuyển tiền trực tiếp', 'Đang xử lý'),
(26, NULL, NULL, 'Chuyển tiền trực tiếp', 'Đang xử lý'),
(27, NULL, NULL, 'Thanh toán khi nhận hàng', 'Đang xử lý'),
(28, NULL, NULL, 'Thanh toán khi nhận hàng', 'Đang xử lý'),
(29, NULL, NULL, 'Chuyển tiền trực tiếp', 'Đang xử lý'),
(30, NULL, NULL, 'Thanh toán khi nhận hàng', 'Đang xử lý'),
(31, NULL, NULL, 'Chuyển tiền trực tiếp', 'Đang xử lý'),
(32, NULL, NULL, 'Chuyển tiền trực tiếp', 'Đang xử lý'),
(33, NULL, NULL, 'Chuyển tiền trực tiếp', 'Đang xử lý'),
(34, NULL, NULL, 'Chuyển tiền trực tiếp', 'Đang xử lý'),
(35, NULL, NULL, 'Chuyển tiền trực tiếp', 'Đang xử lý'),
(36, NULL, NULL, 'Chuyển tiền trực tiếp', 'Đang xử lý'),
(37, NULL, NULL, 'Chuyển tiền trực tiếp', 'Đang xử lý'),
(38, NULL, NULL, 'Chuyển tiền trực tiếp', 'Đang xử lý'),
(39, NULL, NULL, 'Chuyển tiền trực tiếp', 'Đang xử lý'),
(40, NULL, NULL, 'Chuyển tiền trực tiếp', 'Đang xử lý'),
(41, NULL, NULL, 'Chuyển tiền trực tiếp', 'Đang xử lý'),
(42, NULL, NULL, 'Thanh toán khi nhận hàng', 'Đang xử lý');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `product` varchar(255) DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  `group` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `averageyield` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `name`, `product`, `method`, `group`, `price`, `averageyield`, `note`, `customer_id`, `status`) VALUES
(1, 'Tài sản test', 'Trường', 'Cần bán', 'Thủy hải sản', '10000/kig', '25b', NULL, 11, 'Không được duyệt'),
(2, 'dqwd', 'dqwd', NULL, 'Chọn nhóm sản phẩm', 'dqwd', 'dqwd', 'dqw', 11, 'Không được duyệt'),
(3, 'ege', 'gege', 'Cần mua', 'Nông-thủy-hải sản chế biến', 'geg', 'gege', NULL, 11, 'Không được duyệt'),
(4, 'dqw', 'dwq', 'Cần mua', 'Lương thực', 'dqw', 'dq', NULL, 11, 'Không được duyệt'),
(5, 'Huỳnh Tấn Phong', 'Ếch thịt', 'Cần bán', 'Thủy hải sản', '50,000/Kg', '0 Kg/Ngày', NULL, 11, 'Đã duyệt'),
(6, 'Công ty cổ phần sinh thái nông nghiệp Ecovi', 'Bưởi đỏ Ecovi Hà Phong', 'Cần bán', 'Cây ăn trái', '35,000/Yến', '100 Yến/Năm', NULL, 11, 'Đã duyệt'),
(7, 'Thạnh Tôm Thẻ', 'Tôm Thẻ', 'Cần bán', 'Thủy hải sản', '220,000/Kg', '100 Kg/Ngày', NULL, 11, 'Đã duyệt'),
(8, 'Công ty cổ phần Hải Đăng', 'Bột sắn dây nguyên chất', 'Cần mua', 'Khác', '70,000/Kg', '1 Tấn/Tháng', NULL, 11, 'Đã duyệt'),
(9, 'QUILONG', 'Nấm Rơm', 'Cần mua', 'Lương thực', '50,000/Kg', '300 Kg/Ngày', NULL, 11, 'Đã duyệt'),
(10, 'Nguyễn Hoàng Trường', 'Bưởi đỏ Ecovi Hà Phong', 'Cần mua', 'Cây ăn trái', '50,000/Kg', '100 Yến/Năm', NULL, 11, 'Đã duyệt'),
(12, 'Tài sản test', 'Trường', 'Cần bán', 'Nông-thủy-hải sản chế biến', '10000/kig', '25b', NULL, 14, 'Đã duyệt'),
(13, 'Nguyễn Hoàng Trường', 'trái cây', 'Cần bán', 'Cây ăn trái', '10000/kg', '25 kg / năm', NULL, 15, 'Đã duyệt');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `price` int(11) DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) DEFAULT NULL,
  `thumb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thanhphan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `muavu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `donggoi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hansudung` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `xuatsu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `giaohang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `menu_id`, `price`, `unit`, `active`, `thumb`, `thanhphan`, `muavu`, `donggoi`, `hansudung`, `xuatsu`, `giaohang`) VALUES
(5, 'Rau muống', 'Rau muống  là loại rau có thể mọc cả trên cạn và dưới nước, thuộc chia đốt và thuộc loại cây thân bò. Bìm bìm nước là một tên gọi khác của rau muống.\r\n\r\nRau muống là loại rau có giá rất rẻ so với các loại rau khác nhưng lại đem lại lượng khoáng chất và vitamin dồi dào như protein, sắt, canxi, chất xơ, vitamin A... Những chất này là những dưỡng chất cần thiết cho cơ thể.', 6, 25000, 'kg', 1, '20190620_071443_522146_rau-muong.max-1800x1800.png', '100% rau muống sạch, an toàn, chất lượng , không chất bảo quản.', 'Quanh năm', 'Theo kí', 'In trên bao bì', 'TP.HCM', 'Giao hàng trong ngày tại TP.HCM'),
(6, 'Cherry Canada', 'So với các loại trái cây khác, trái cây Canada có hương vị cực kỳ thơm ngon tự nhiên. Có thể kể đến như dòng cherry Canada được đánh giá cao hơn hẳn so với các dòng cherry Mỹ về độ giòn và độ ngọt.', 7, 350000, 'kg', 1, 'trai-cay-nhap-khau-trai-cherry-bbg.jpg', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Quýt đường', 'Quýt là loại trái cây rất tốt cho sức khỏe, ngon - ngọt là trái cây rất yêu thích của nhiều người', 7, 160000, 'kg', 1, 'download.jfif', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Dâu tây Đà Lạt', 'Dâu tây Đà Lạt nổi tiếng thơm mát,tươi sạch là đặc sản của vùng cao nguyên này.Giá dâu tây của chúng tôi tốt nhất Thành phố', 7, 395000, 'kg', 1, 'dau-tay-da-lat.gif', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Cà rốt to', 'Cà rốt là loại rau củ được các chuyên gia dinh dưỡng khuyên dùng thường xuyên để bổ sung đầy đủ dinh dưỡng. Cà rốt bồi bổ sức khỏe, làm đẹp da và phòng chống các bệnh lí ung thư rất hiệu quả. Nước ép cà rốt giúp tăng sức đề kháng cho cơ thể, phòng chống bệnh cao huyết áp vô cùng tốt.', 6, 17000, 'kg', 1, 'images1818372_ca_rot_7222_1486343099.jpg', NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Cà chua Mộc Châu', 'Cà chua Mộc Châu - một loại rau an toàn được sử dụng rất phổ biến trong cuộc sống.Nó có tính lưu huyết, giải độc, chống khát nước, thông tiểu tiện và tốt cho hệ tiêu hóa. Không chỉ là thực phẩm ngon tuyệt vời trong các món ăn mà cà chua còn là cứu tinh cho chị em phụ nữ trong việc làm đẹp.Cà chua chứa nhiều vitamin C, E, hàm lượng chất chống oxy hóa cao cùng các dưỡng chất như carotene, kali, chất sắt… rất tốt cho da,giảm oxy hóa.', 6, 6000, 'kg', 1, 'img_8796.jpg', NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'Ớt Chuông Đà Lạt', 'Ớt chuông Đà Lạt được xếp là một trong những loại rau củ chứa nhiều chất xơ mà không có nguy cơ dư thừa lượng calo hấp thụ', 6, 60000, 'kg', 1, '171871525816.jpg', NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'Súp lơ xanh', 'Súp lơ xanh là loại thực phẩm rất tốt cho sức khỏe, tăng cường sức đề kháng cho các thành viên trong gia đình. Súp lơ xanh chứa nhiều vitamin A, C và E hơn bất cứ loại rau quả nào khác', 6, 45000, 'kg', 1, '8d27a83c538585fb0c7c4d2a1628d5d2.jpg', NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'Táo fuji', 'Táo Fuji tươi, dòn, vị ngọt có cảm giác như đang thưởng thức một cốc nước ép táo vô cùng sảng khoái.', 7, 25000, 'kg', 1, 'táo-fuji-mỹ.jpg', NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'Tỏi Lý sơn', 'Là dạng dễ dùng nhất, có thể ăn sống hoặc dầm vào nước chấm. Khi nhấm tỏi sống, các vi khuẩn có trong khoang miệng sẽ bị tiêu diệt. Mỗi ngày nên ăn 2 tép tỏi sống là đủ, ăn nhiều quá cũng không có lợi cho dạ dày và chất axilin có trong tỏi có thể gây chứng tan máu.', 6, 29000, 'kg', 1, 'toi-ly-son-1.jpg', NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'Ớt chỉ thiên', 'Là gia vị không thể thiếu trong mỗi bữa cơm gia đình', 6, 23000, 'kg', 1, 'ot-chi-thien-tapdoanvinasa-02.jpg', NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'Hành tím Lý Sơn', 'Hành tím Lý Sơn đã trở thành đặc sản của vùng biển đảo Lý Sơn  – Quảng Ngãi. Đây là vùng đất được hình thành do quá trình hoạt động núi lửa và sự bồi đắp của cát biển, đá san hô biển tạo nên, với sự đặc biệt về thổ nhưỡng và kinh nghiệm truyền thống bao đời từ khi khai sinh vùng đất đảo, đã làm cho hành Lý Sơn có hương vị riêng và đặc biệt. Hành tím của lý sơn có màu tím đặc trưng và đặc biệt có vị thơm.', 6, 25000, 'kg', 1, 'hanh-tim-1.jpg', NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'Cá hồi NaUy', 'Cá hồi NaUy được biết đến như một loại thực phẩm lành mạnh giàu protein,axit béo,omega -3 và vitamin D.Ăn thịt cá hồi mang lại nhiều lợi ích cho sức khỏe như: chống các dấu hiệu lão hóa, giảm mức cholesterol và huyết áp, kéo giảm nguy cơ bị đột quỵ, giúp giảm đau và cứng khớp gây ra bởi viêm khớp', 8, 420000, 'kg', 1, 'images.jfif', NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'Cá bò khô Bá Kiến', 'Cá bò khô là món ngon được rất nhiều người yêu thích bởi hương vị đặc trưng, cái dai dai, mặn mà, thêm chút ngọt thơm hòa quyện trong từng thớ thịt. Đối với cánh mày râu, đây còn là mồi nhấm cùng rượu hoặc bia tươi vô cùng lý tưởng. Cuộc vui bên bạn bè hay những người thân yêu sẽ hoàn hảo hơn rất nhiều nếu bạn tìm được địa chỉ mua cá bò khô uy tín và chất lượng', 9, 250000, 'kg', 1, 'IMG_7849-1-768x512.jpg', NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'Dưa hấu', 'Mùa hè đến là thời điểm lý tưởng để thưởng thức những trái dưa hấu đỏ ngọt, tươi mát. Dưa hấu không chỉ là một loại hoa quả hấp dẫn, nó còn có những tác dụng tích cực cho sức khỏe rất có thể bạn chưa biết hết. Quả dưa hấu có tên khoa học là Citrullus lanatus, vị ngọt mát, nhiều nước (hơn 90% trọng lượng dưa hấu là nước), đồng thời dưa hấu còn giúp cung cấp nhiều vitamin, các nguyên tố vi lượng cho cơ thể.\r\n\r\nDưa hấu chứa ít calo (46 Kcal mỗi cốc), chứa hàm lượng vitamin C và vitamin A cao (dưa hấu cung cấp 17% lượng vitamin A + 20% lượng vitamin C cần thiết mà cơ thể bạn cân/ ngày). Dưa hấu cũng rất giàu chất xơ và kali.', 7, 15000, 'kg', 1, 'duahau.jfif', 'Dưa hấu đỏ ngọt tươi mát', 'Quanh năm', 'Một quả', 'Thời hạn bảo quản 1 tuần trong tủ lạnh', 'miền Tây', 'Giao hàng toàn quốc'),
(20, 'Đậu xanh hạt gói 150g', 'Đậu xanh là một loại đậu dùng để chế biến rất nhiều món ngon cũng như cung cấp nhiều dưỡng chất tốt cho cơ thể. Thương hiệu VietFresh cung cấp cho chúng ta sản phẩm đậu xanh hạt cao cấp tươi mới.', 9, 100600, 'kg', 1, 'dau-xanh-hat-cao-cap-vietfresh-150g-202012092307410559.jpg', 'Đậu xanh hạt 100%', 'Hàng năm', 'Nơi khô thoáng, trong túi kín gió và tránh ánh nắng trực tiếp', '30 ngày', 'Giao ngẫu nhiên Naita hoặc Fresh', 'Giao hàng tận nơi'),
(21, 'Việt quất', 'Việt quất (hay còn gọi là Blueberry) là một loại trái cây nhập khẩu không còn quá xa lạ đối với người tiêu dùng Việt Nam. Đây không chỉ là loại trái cây có màu sắc bắt mắt mà còn chứa nhiều chất dinh dưỡng cùng công dụng tốt cho sức khoẻ. \r\nViệt quất thì quả khá tròn trịa, vỏ mỏng và trơn mịn. Đường kính trung bình dao động tầm 2 – 3 cm, một đầu có cuống và một đầu có phần đài quả. Quả thường có màu xanh sẫm gần như màu mực, một vài giống thì sẽ có màu đen hoặc đỏ. Việt quất mang vị ngọt thơm, khi mới ăn có thể thấy hơi chát nhưng sau quen rồi lại thấy rất hấp dẫn.', 7, 1490000, 'kg', 1, 'viet-quat-hop-125g-202101141115286393.jpg', '84% nước, 14% Cacbohydrat cùng nhiều khoáng chất thiết yếu khác như: Carotene, Anthocyanin, vitamin (A, C, K), Kali, Natri, Canxi, Magie, Photpho, Sắt,...', 'Hàng năm', 'Gói 125gram', '15/1/2022', 'Trái cây nhập khẩu từ Nhật Bản', 'Giao hàng tận nơi'),
(22, 'Táo mini', 'Táo được biết đến như một loại trái cây có lợi cho sắc đẹp và có tác dụng giảm cân, ngăn ngừa bệnh tim mạch. Với lượng dưỡng chất dồi dào, vị giòn ngọt, thanh mát, trái nhỏ. Táo Gala mini nhập khẩu New Zealand là trái cây nhập khẩu chất lượng an toàn, vừa tiết kiệm về giá, lại vừa vặn cho một lần ăn mà không gây ngán, không phải dự trữ lại.', 7, 43000, 'kg', 1, 'táo-mini.jpg', 'Táo mini', 'Hàng năm', 'Hộp 1kg', '1 tháng', 'Trái cây nhập khẩu từ Nhật Bản', 'Giao hàng tận nơi'),
(23, 'Chuối Laba', 'Chuối Laba (hay còn gọi là chuối Tiến Vua) là một trong những loại trái cây đặc sản Đà Lạt. Thoạt nhìn, chuối Laba có hình dáng tương tự với giống chuối già Nam Mỹ, tuy nhiên về chất lượng và hương vị thì hoàn toàn khác nhau. \r\nChuối Laba có quả thon dài, hơi cong, cuống to ngắn, buồng nhỏ, trái úp úp vào buồng như mảnh trăng lưỡi liềm, khoảng cách giữa các cuống dày và khít vào nhau. Thịt chuối Laba có màu vàng sánh, dẻo, vị ngọt đậm thơm ngon và có hương thơm đặc trưng. Ngoài ra, chuối Laba có hàm lượng đường cao hơn các loại chuối khác.', 7, 29000, 'kg', 1, 'chuoi-laba-tui-1kg-202101271611376661.jpg', 'Chuối chứa nhiều chất dinh dưỡng như kali, chất xơ, vitamin,...', 'Hàng năm', 'Hộp 1kg', '30 ngày', 'Đà Lạt', 'Giao hàng tận nơi'),
(24, 'Bưởi năm roi', 'Bưởi năm roi là một trong những đặc sản nổi tiếng của Việt Nam. Loại bưởi này không chỉ ngon, ngọt mà còn mang lại cho con người nhiều công dụng tốt cho sức khoẻ như cung cấp nguồn vitamin dồi dào. Bưởi năm roi tại Bách hoá XANH thích hợp cho những ngày nắng nóng với nhiều cách chế biến khác nhau.', 7, 29000, 'kg', 1, 'buoi-nam-roi-tui-1kg-202112251732267497.jpg', 'Bưởi năm roi', 'Hàng năm', 'Hộp 1kg', '30 ngày', 'miền Tây Nam Bộ', 'Giao hàng tận nơi'),
(25, 'Cà rốt và su su xào', 'Sản phẩm cà rốt và su su được làm sạch và sơ chế cắt sợi sẵn dễ dàng, thuận tiện cho bạn chế biến, tiết kiệm được nhiều thời gian nấu nướng. Cà rốt và su su xào khay 300g bao bì sạch sẽ, vệ sinh, cung cấp chất xơ và vitamin cần thiết cho cơ thể.', 6, 50000, 'kg', 1, 'ca-rot-va-su-su-xao-khay-300g-202201040747484286.jpg', 'Su su, cà rốt, cần tàu, hành lá, ớt', 'Hàng năm', 'Khay 300gram', '1 tháng', 'Trường An', 'Giao hàng tận nơi');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`id`, `created_at`, `updated_at`, `name`, `address`, `phone`, `email`, `note`) VALUES
(14, '2021-10-08 02:16:15', NULL, 'Nguyễn Hoàng Trường', '22/14 Phan Văn Hớn, Quận 12', '0704843311', 'hoangtruong@gmail.com', 'Đóng gói cẩn thận'),
(15, '2021-10-15 01:43:06', NULL, 'Nguyễn Hoàng Thanh', '25B Tô Vĩnh Diện', '0704804311', 'hoangthanh@gmail.com', 'Đóng gói cẩn thận'),
(16, '2021-10-15 01:46:49', NULL, 'Hoàng Trường', '25B Tô Vĩnh Diện', '0704804311', 'hoangthanh@gmail.com', NULL),
(17, '2021-12-21 20:06:37', NULL, 'Tài sản test', 'Đăng sản phẩm cần bán, cần mua', '123', 'hoangtruong1808@gmail.com', NULL),
(18, '2021-12-21 20:06:45', NULL, 'Tài sản test', 'Đăng sản phẩm cần bán, cần mua', '123', 'hoangtruong1808@gmail.com', NULL),
(19, '2021-12-22 18:19:15', NULL, 'Nguyễn Hoàng Trường', '25B Tô Vĩnh Diện', '123456', 'truong123@gmail.com', NULL),
(20, '2021-12-22 19:00:27', NULL, 'Nguyễn Hoàng Trường', '25B Tô Vĩnh Diện', '123456', 'truong123@gmail.com', NULL),
(21, '2021-12-22 19:01:18', NULL, 'Nguyễn Hoàng Trường', '25B Tô Vĩnh Diện', '123456', 'truong123@gmail.com', NULL),
(22, '2021-12-22 19:02:37', NULL, 'Nguyễn Hoàng Trường', '25B Tô Vĩnh Diện', '123456', 'truong123@gmail.com', NULL),
(23, '2021-12-22 19:06:08', NULL, 'Tài sản test', 'Đăng sản phẩm cần bán, cần mua', '123', 'hoangtruong1808@gmail.com', NULL),
(24, '2021-12-22 19:06:29', NULL, 'Tài sản test', 'Đăng sản phẩm cần bán, cần mua', '123', 'hoangtruong1808@gmail.com', NULL),
(25, '2021-12-22 20:45:29', NULL, 'Tuấn', 'tuan', '123', 'hoangtruong1808@gmail.com', NULL),
(26, '2021-12-22 21:05:31', NULL, 'Tuấn', 'tuan', '123', 'hoangtruong1808@gmail.com', NULL),
(27, '2021-12-22 23:36:32', NULL, 'Trường', 'tuan', '123', 'hoangtruong1808@gmail.com', NULL),
(28, '2021-12-23 05:15:22', NULL, 'Tuấn', 'tuan', '123', 'hoangtruong1808@gmail.com', NULL),
(29, '2021-12-30 20:42:32', NULL, 'Nguyễn Hoàng Trường', '25B Tô Vĩnh Diện', '0704804311', 'hoangtruong1808@gmail.com', NULL),
(30, '2021-12-30 20:42:40', NULL, 'Nguyễn Hoàng Trường', '25B Tô Vĩnh Diện', '0704804311', 'hoangtruong1808@gmail.com', NULL),
(31, '2021-12-30 20:44:55', NULL, 'Nguyễn Hoàng Trường', '25B Tô Vĩnh Diện', '0704804311', 'hoangtruong1808@gmail.com', NULL),
(32, '2021-12-30 21:23:21', NULL, 'Nguyễn Hoàng Trường', '25B Tô Vĩnh Diện', '0704804311', 'hoangtruong1808@gmail.com', NULL),
(33, '2021-12-30 23:05:17', NULL, 'Nguyễn Hoàng Trường', '25B Tô Vĩnh Diện', '0704804311', 'hoangtruong1808@gmail.com', NULL),
(34, '2021-12-31 00:10:19', NULL, 'Nguyễn Hoàng Trường', '25B Tô Vĩnh Diện', '123456', 'hoangtruong1808@gmail.com', NULL),
(35, '2021-12-31 00:26:59', NULL, 'Nguyễn Hoàng Quân', '1 Tô Vĩnh Diện', '0704804311', 'hoangtruong1808@gmail.com', NULL),
(36, '2022-01-06 06:06:54', NULL, 'Nguyễn Hoàng Trường', '123', '123', '123', NULL),
(37, '2022-01-06 06:09:31', NULL, 'Nguyễn Hoàng Trường', '123', '123', '123', NULL),
(38, '2022-01-06 06:09:46', NULL, 'Nguyễn Hoàng Trường', '123', '123', '123', NULL),
(39, '2022-01-06 06:11:32', NULL, 'Nguyễn Hoàng Trường', '123', '123', '123', NULL),
(40, '2022-01-06 06:11:53', NULL, 'Nguyễn Hoàng Trường', '123', '123', '123', NULL),
(41, '2022-01-06 06:16:00', NULL, 'bf', 'bf', '089', 'gr', NULL),
(42, '2022-01-06 06:18:44', NULL, 'bf', 'bf', '089', 'gr', NULL),
(43, '2022-01-07 16:59:01', NULL, 'Tuấn', 'tuan', '123', 'hoangtruong1808@gmail.com', NULL),
(44, '2022-01-07 17:01:00', NULL, 'Tuấn', 'tuan', '123', 'hoangtruong1808@gmail.com', NULL),
(45, '2022-01-07 18:57:47', NULL, 'Nguyễn Hoàng Trường', '25B Tô Vĩnh Diện', '0704804311', 'hoangtruong1808@gmail.com', NULL),
(46, '2022-01-07 18:58:03', NULL, 'Nguyễn Hoàng Trường', '25B Tô Vĩnh Diện', '0704804311', 'hoangtruong1808@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chatbot`
--
ALTER TABLE `chatbot`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_customer_id_foreign` (`customer_id`),
  ADD KEY `order_shipping_id_foreign` (`shipping_id`),
  ADD KEY `order_payment_id_foreign` (`payment_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_detail_product_id_foreign` (`product_id`),
  ADD KEY `order_detail_order_id_foreign` (`order_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chatbot`
--
ALTER TABLE `chatbot`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10000;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `order_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`id`),
  ADD CONSTRAINT `order_shipping_id_foreign` FOREIGN KEY (`shipping_id`) REFERENCES `shipping` (`id`);

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`),
  ADD CONSTRAINT `order_detail_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

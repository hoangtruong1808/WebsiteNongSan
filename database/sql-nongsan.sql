-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 21, 2021 lúc 09:38 AM
-- Phiên bản máy phục vụ: 10.4.16-MariaDB
-- Phiên bản PHP: 7.3.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `sql-nongsan`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
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
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`id`, `name`, `address`, `email`, `password`, `created_at`, `updated_at`, `phone`) VALUES
(1, 'Nguyen Truong', 'Quận 12', 'hoangtruong1808@gmail.com', '123', NULL, NULL, '123'),
(2, 'Nguyen Truong', 'Quận 12', 'hoangtruong1808@gmail.com', '123', NULL, NULL, '123'),
(3, 'Nguyen Truong', 'Quận 12', 'hoangtruong1808@gmail.com', '123', NULL, NULL, '123'),
(4, 'Nguyen Truong', 'Quận 12', 'hoangtruong1808@gmail.com', '$2y$10$7ps/1J/tA6hMyl3noy5bueYRoqQFzNJjvUqQ3cQpxMW72ZPwSAHkm', NULL, NULL, '123'),
(5, 'Nguyen Truong', 'Quận 12', 'hoangtruong@gmail.com', '$2y$10$T7xDCE8zthNyjygTdXe3RegED6A.jL1tMM3nvFh7ABLUT2k.sZGh6', NULL, NULL, '123'),
(6, 'Nguyễn Thùy Linh', '22/14 Phan Văn Hớn, Quận 12', 'thuylinh@gmail.com', '$2y$10$riJIpGiUCby/wECgIbeC/.hrXIexdJs5G5.5ycYBsZeOAPHkYXn9C', NULL, NULL, '123'),
(7, 'Nguyen Truong', 'Quận 12', 'hoangtruong188@gmail.com', '$2y$10$oHnvTWRGNX1kpj2N9eUPLezOnC5pW1WlN7uxD/Zb2AHx1BjJgph7y', NULL, NULL, '0704804311'),
(8, 'Nguyễn Hoàng Thanh', '25B Tô Vĩnh Diện', 'hoangthanh@gmail.com', '$2y$10$o4X5uVuleDftDge0MlKAxOsJ/9dCcwXtZACxrYT.DS4W6T9vS7Ei6', NULL, NULL, '0704804311');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
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
-- Cấu trúc bảng cho bảng `menu`
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
-- Đang đổ dữ liệu cho bảng `menu`
--

INSERT INTO `menu` (`id`, `name`, `active`, `created_at`, `updated_at`, `description`) VALUES
(5, 'Combo', 1, NULL, NULL, 'Bao gồm nhiều loại nông sản với giá thành ưu đãi'),
(6, 'Rau củ', 1, NULL, NULL, 'Để sản xuất rau sạch đảm bảo vệ sinh an toàn thực phẩm, chúng tôi đảm bảo các nguyên tắc sau: chọn đất, nước tưới, phân bón, giống, bảo vệ thực vật, thu hoạch và bao gói.'),
(7, 'Trái cây', 1, NULL, NULL, 'Trái cây tươi và sạch sẽ, đảm bảo an toàn vệ sinh thực phẩm cho Quý Khách Hàng.'),
(8, 'Thủy - hải sản', 1, NULL, NULL, 'Thủy hản sản đươc nuôi trồng và tiến hành theo quy trình nuôi trồng thủy sản dựa trên tiêu chuẩn vệ sinh nghiêm ngặc và với sự tôn trọng môi sinh.'),
(9, 'Đồ khô', 1, NULL, NULL, 'Có đặc tính tiện lợi, dễ chế biến, dễ bảo quản và để được lâu, có thể ăn dài ngày trong mùa dịch.');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
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
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `shipping_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order`
--

INSERT INTO `order` (`id`, `customer_id`, `shipping_id`, `status`, `total`, `created_at`, `updated_at`, `payment_id`) VALUES
(5, 6, 14, 'Đang xử lý', 362250, '2021-10-08 02:16:15', NULL, 11),
(6, 8, 15, 'Đang xử lý', 422625, '2021-10-15 01:43:07', NULL, 12),
(7, 8, 16, 'Đang xử lý', 422625, '2021-10-15 01:46:49', NULL, 13);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `price` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_detail`
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
(15, 8, 7, 395000, 'Dâu tây Đà Lạt', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payment`
--

CREATE TABLE `payment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `payment`
--

INSERT INTO `payment` (`id`, `created_at`, `updated_at`, `method`, `status`) VALUES
(11, NULL, NULL, 'Chuyển tiền trực tiếp', 'Đang xử lý'),
(12, NULL, NULL, 'Thanh toán khi nhận hàng', 'Đang xử lý'),
(13, NULL, NULL, 'Chuyển tiền trực tiếp', 'Đang xử lý');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
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
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `price` int(11) NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  `thumb` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thanhphan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `muavu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `donggoi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hansudung` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `xuatsu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `giaohang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `menu_id`, `price`, `unit`, `active`, `thumb`, `thanhphan`, `muavu`, `donggoi`, `hansudung`, `xuatsu`, `giaohang`) VALUES
(5, 'Rau muống', 'Rau muống  là loại rau có thể mọc cả trên cạn và dưới nước, thuộc chia đốt và thuộc loại cây thân bò. Bìm bìm nước là một tên gọi khác của rau muống.\r\n\r\nRau muống là loại rau có giá rất rẻ so với các loại rau khác nhưng lại đem lại lượng khoáng chất và vitamin dồi dào như protein, sắt, canxi, chất xơ, vitamin A... Những chất này là những dưỡng chất cần thiết cho cơ thể.', 6, 25000, 'kg', 1, 'RAU-MUONG.jpg', '100% rau muống sạch, an toàn, chất lượng , không chất bảo quản.', 'Quanh năm', 'Theo kí', 'In trên bao bì', 'TP.HCM', 'Giao hàng trong ngày tại TP.HCM'),
(6, 'Cherry Canada', 'So với các loại trái cây khác, trái cây Canada có hương vị cực kỳ thơm ngon tự nhiên. Có thể kể đến như dòng cherry Canada được đánh giá cao hơn hẳn so với các dòng cherry Mỹ về độ giòn và độ ngọt.', 7, 350000, 'kg', 1, 'cherry-cananda.jpg', '', '', '', '', '', ''),
(7, 'Quýt đường', 'Quýt là loại trái cây rất tốt cho sức khỏe, ngon - ngọt là trái cây rất yêu thích của nhiều người', 7, 160000, 'kg', 1, 'quyt.jpg', '', '', '', '', '', ''),
(8, 'Dâu tây Đà Lạt', 'Dâu tây Đà Lạt nổi tiếng thơm mát,tươi sạch là đặc sản của vùng cao nguyên này.Giá dâu tây của chúng tôi tốt nhất Thành phố', 7, 395000, 'kg', 1, 'dautay.jpg', '', '', '', '', '', ''),
(9, 'Cà rốt to', 'Cà rốt là loại rau củ được các chuyên gia dinh dưỡng khuyên dùng thường xuyên để bổ sung đầy đủ dinh dưỡng. Cà rốt bồi bổ sức khỏe, làm đẹp da và phòng chống các bệnh lí ung thư rất hiệu quả. Nước ép cà rốt giúp tăng sức đề kháng cho cơ thể, phòng chống bệnh cao huyết áp vô cùng tốt.', 6, 17000, 'kg', 1, 'carot.jpg', '', '', '', '', '', ''),
(10, 'Cà chua Mộc Châu', 'Cà chua Mộc Châu - một loại rau an toàn được sử dụng rất phổ biến trong cuộc sống.Nó có tính lưu huyết, giải độc, chống khát nước, thông tiểu tiện và tốt cho hệ tiêu hóa. Không chỉ là thực phẩm ngon tuyệt vời trong các món ăn mà cà chua còn là cứu tinh cho chị em phụ nữ trong việc làm đẹp.Cà chua chứa nhiều vitamin C, E, hàm lượng chất chống oxy hóa cao cùng các dưỡng chất như carotene, kali, chất sắt… rất tốt cho da,giảm oxy hóa.', 6, 6000, 'kg', 1, 'product-5.jpg', '', '', '', '', '', ''),
(11, 'Ớt Chuông Đà Lạt', 'Ớt chuông Đà Lạt được xếp là một trong những loại rau củ chứa nhiều chất xơ mà không có nguy cơ dư thừa lượng calo hấp thụ', 6, 60000, 'kg', 1, 'product-1.jpg', '', '', '', '', '', ''),
(12, 'Súp lơ xanh', 'Súp lơ xanh là loại thực phẩm rất tốt cho sức khỏe, tăng cường sức đề kháng cho các thành viên trong gia đình. Súp lơ xanh chứa nhiều vitamin A, C và E hơn bất cứ loại rau quả nào khác', 6, 45000, 'kg', 1, 'product-6.jpg', '', '', '', '', '', ''),
(13, 'Táo fuji', 'Táo Fuji tươi, dòn, vị ngọt có cảm giác như đang thưởng thức một cốc nước ép táo vô cùng sảng khoái.', 7, 25000, 'kg', 1, 'product-10.jpg', '', '', '', '', '', ''),
(14, 'Tỏi Lý sơn', 'Là dạng dễ dùng nhất, có thể ăn sống hoặc dầm vào nước chấm. Khi nhấm tỏi sống, các vi khuẩn có trong khoang miệng sẽ bị tiêu diệt. Mỗi ngày nên ăn 2 tép tỏi sống là đủ, ăn nhiều quá cũng không có lợi cho dạ dày và chất axilin có trong tỏi có thể gây chứng tan máu.', 6, 29000, 'kg', 1, 'product-11.jpg', '', '', '', '', '', ''),
(15, 'Ớt chỉ thiên', 'Là gia vị không thể thiếu trong mỗi bữa cơm gia đình', 6, 23000, 'kg', 1, 'product-12.jpg', '', '', '', '', '', ''),
(16, 'Hành tím Lý Sơn', 'Hành tím Lý Sơn đã trở thành đặc sản của vùng biển đảo Lý Sơn  – Quảng Ngãi. Đây là vùng đất được hình thành do quá trình hoạt động núi lửa và sự bồi đắp của cát biển, đá san hô biển tạo nên, với sự đặc biệt về thổ nhưỡng và kinh nghiệm truyền thống bao đời từ khi khai sinh vùng đất đảo, đã làm cho hành Lý Sơn có hương vị riêng và đặc biệt. Hành tím của lý sơn có màu tím đặc trưng và đặc biệt có vị thơm.', 6, 25000, 'kg', 1, 'product-9.jpg', '', '', '', '', '', ''),
(17, 'Cá hồi NaUy', 'Cá hồi NaUy được biết đến như một loại thực phẩm lành mạnh giàu protein,axit béo,omega -3 và vitamin D.Ăn thịt cá hồi mang lại nhiều lợi ích cho sức khỏe như: chống các dấu hiệu lão hóa, giảm mức cholesterol và huyết áp, kéo giảm nguy cơ bị đột quỵ, giúp giảm đau và cứng khớp gây ra bởi viêm khớp', 8, 420000, 'kg', 1, 'cahoi.jpg', '', '', '', '', '', ''),
(18, 'Cá bò khô Bá Kiến', 'Cá bò khô là món ngon được rất nhiều người yêu thích bởi hương vị đặc trưng, cái dai dai, mặn mà, thêm chút ngọt thơm hòa quyện trong từng thớ thịt. Đối với cánh mày râu, đây còn là mồi nhấm cùng rượu hoặc bia tươi vô cùng lý tưởng. Cuộc vui bên bạn bè hay những người thân yêu sẽ hoàn hảo hơn rất nhiều nếu bạn tìm được địa chỉ mua cá bò khô uy tín và chất lượng', 9, 250000, 'kg', 1, 'cabokho.jpg', '', '', '', '', '', ''),
(19, 'Dưa hấu', 'Mùa hè đến là thời điểm lý tưởng để thưởng thức những trái dưa hấu đỏ ngọt, tươi mát. Dưa hấu không chỉ là một loại hoa quả hấp dẫn, nó còn có những tác dụng tích cực cho sức khỏe rất có thể bạn chưa biết hết. Quả dưa hấu có tên khoa học là Citrullus lanatus, vị ngọt mát, nhiều nước (hơn 90% trọng lượng dưa hấu là nước), đồng thời dưa hấu còn giúp cung cấp nhiều vitamin, các nguyên tố vi lượng cho cơ thể.\r\n\r\nDưa hấu chứa ít calo (46 Kcal mỗi cốc), chứa hàm lượng vitamin C và vitamin A cao (dưa hấu cung cấp 17% lượng vitamin A + 20% lượng vitamin C cần thiết mà cơ thể bạn cân/ ngày). Dưa hấu cũng rất giàu chất xơ và kali.', 7, 15000, 'kg', 1, 'dua-hau.jpg', 'Dưa hấu đỏ ngọt tươi mát', 'Quanh năm', 'Một quả', 'Thời hạn bảo quản 1 tuần trong tủ lạnh', 'miền Tây', 'Giao hàng toàn quốc');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shipping`
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
-- Đang đổ dữ liệu cho bảng `shipping`
--

INSERT INTO `shipping` (`id`, `created_at`, `updated_at`, `name`, `address`, `phone`, `email`, `note`) VALUES
(14, '2021-10-08 02:16:15', NULL, 'Nguyễn Hoàng Trường', '22/14 Phan Văn Hớn, Quận 12', '0704843311', 'hoangtruong@gmail.com', 'Đóng gói cẩn thận'),
(15, '2021-10-15 01:43:06', NULL, 'Nguyễn Hoàng Thanh', '25B Tô Vĩnh Diện', '0704804311', 'hoangthanh@gmail.com', 'Đóng gói cẩn thận'),
(16, '2021-10-15 01:46:49', NULL, 'Hoàng Trường', '25B Tô Vĩnh Diện', '0704804311', 'hoangthanh@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
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
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_customer_id_foreign` (`customer_id`),
  ADD KEY `order_shipping_id_foreign` (`shipping_id`),
  ADD KEY `order_payment_id_foreign` (`payment_id`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_detail_product_id_foreign` (`product_id`),
  ADD KEY `order_detail_order_id_foreign` (`order_id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_menu_id_foreign` (`menu_id`);

--
-- Chỉ mục cho bảng `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `menu`
--
ALTER TABLE `menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `payment`
--
ALTER TABLE `payment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `shipping`
--
ALTER TABLE `shipping`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `order_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`id`),
  ADD CONSTRAINT `order_shipping_id_foreign` FOREIGN KEY (`shipping_id`) REFERENCES `shipping` (`id`);

--
-- Các ràng buộc cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`),
  ADD CONSTRAINT `order_detail_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

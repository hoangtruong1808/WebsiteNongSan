/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100421
 Source Host           : localhost:3306
 Source Schema         : cuahangnongsan

 Target Server Type    : MySQL
 Target Server Version : 100421
 File Encoding         : 65001

 Date: 14/05/2022 14:27:47
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment`  (
  `ID` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `is_deleted` int NULL DEFAULT 0,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  INDEX `customer_id`(`customer_id` ASC) USING BTREE,
  INDEX `product_id`(`product_id` ASC) USING BTREE,
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of comment
-- ----------------------------
INSERT INTO `comment` VALUES (8, 1, 29, '07/05/2022', 0, 'test');
INSERT INTO `comment` VALUES (9, 1, 29, '07/05/2022', 0, 'test');
INSERT INTO `comment` VALUES (10, 1, 29, '07/05/2022', 0, 'test');
INSERT INTO `comment` VALUES (11, 1, 29, '07/05/2022', 0, 'test');
INSERT INTO `comment` VALUES (12, 1, 29, '07/05/2022', 0, 'qưe');
INSERT INTO `comment` VALUES (13, 1, 29, '07/05/2022', 0, '213ddqdqdqdqdq');
INSERT INTO `comment` VALUES (14, 1, 29, '07/05/2022', 0, 'feqfq');
INSERT INTO `comment` VALUES (15, 2, 5, '09/05/2022', 0, 'Rau muốn rất ngon');
INSERT INTO `comment` VALUES (16, 4, 22, '09/05/2022', 0, 'Táo rất tươi!');
INSERT INTO `comment` VALUES (17, 5, 22, '10/05/2022', 0, 'Táo rất ngon');

-- ----------------------------
-- Table structure for customer
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rotate_quantity` int NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` int NULL DEFAULT 1,
  `customer_type` int NULL DEFAULT 2,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of customer
-- ----------------------------
INSERT INTO `customer` VALUES (1, 'Nguyễn Hoàng Trường', 'hoangtruong1808@gmail.com', 'hoangtruong1808@gmail.com', '$2y$10$Mc.P8RoPGndiCjv5tAGuJePmeBKk3tubanGKw7apfx.koe5ubMA/e', '0704804311', 'default-avatar.png', 1, NULL, NULL, 1, 2);
INSERT INTO `customer` VALUES (2, 'user-test', '25B Tô Vĩnh Diện', 'user-test@gmail.com', '$2y$10$H/DhDlMl7WnCu8tbmzDoYu9M509Hn/LDnXA42XPxIkqrJhrmd6ZSq', '123456', 'default-avatar.png', 1, NULL, NULL, 1, 2);
INSERT INTO `customer` VALUES (3, 'test', '123', 'test@gmail.com', '$2y$10$BkXUbGHbSjkGRzjPtD0/EeOPZ88UKkdxrZw2fBhwwc5A78yBgyIDS', '123', 'default-avatar.png', 0, NULL, NULL, 1, 2);
INSERT INTO `customer` VALUES (4, 'user-test', 'Đăng sản phẩm cần bán, cần mua', 'truong123@gmail.com', '$2y$10$X01PLcTFS/XY696QapqegOYVno6rEAL/K3RBSRICHsnBA4ODk6oXK', '07048043111', 'default-avatar.png', 0, NULL, NULL, 1, 2);
INSERT INTO `customer` VALUES (5, 'User01', '25B Tô Vĩnh Diện', 'User01@gmail.com', '$2y$10$FVnl/u3k9qNFUA0VlGrPgeWbO6N7yFbG8bjROjsQ.gp5R6KNF0X8S', '0704804312', 'default-avatar.png', 0, NULL, NULL, 1, 2);

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for import_goods
-- ----------------------------
DROP TABLE IF EXISTS `import_goods`;
CREATE TABLE `import_goods`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `import_date` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `staff_id` bigint UNSIGNED NOT NULL,
  `supplier_id` bigint UNSIGNED NOT NULL,
  `price` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `supplier_id`(`supplier_id` ASC) USING BTREE,
  INDEX `staff_id`(`staff_id` ASC) USING BTREE,
  CONSTRAINT `import_goods_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `import_goods_ibfk_3` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of import_goods
-- ----------------------------

-- ----------------------------
-- Table structure for import_goods_detail
-- ----------------------------
DROP TABLE IF EXISTS `import_goods_detail`;
CREATE TABLE `import_goods_detail`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `import_goods_id` bigint UNSIGNED NOT NULL,
  `warehouse_goods_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `unit` char(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `price` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `import_goods_id`(`import_goods_id` ASC) USING BTREE,
  INDEX `warehouse_goods_id`(`warehouse_goods_id` ASC) USING BTREE,
  CONSTRAINT `import_goods_detail_ibfk_1` FOREIGN KEY (`import_goods_id`) REFERENCES `import_goods` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `import_goods_detail_ibfk_2` FOREIGN KEY (`warehouse_goods_id`) REFERENCES `warehouse_goods` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of import_goods_detail
-- ----------------------------

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` int NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES (6, 'Rau củ', 1, 'Để sản xuất rau sạch đảm bảo vệ sinh an toàn thực phẩm, chúng tôi đảm bảo các nguyên tắc sau: chọn đất, nước tưới, phân bón, giống, bảo vệ thực vật, thu hoạch và bao gói.', NULL, NULL, 0);
INSERT INTO `menu` VALUES (7, 'Trái cây', 1, 'Trái cây tươi và sạch sẽ, đảm bảo an toàn vệ sinh thực phẩm cho Quý Khách Hàng.', NULL, NULL, 0);
INSERT INTO `menu` VALUES (8, 'Thủy - hải sản', 1, 'Thủy hản sản đươc nuôi trồng và tiến hành theo quy trình nuôi trồng thủy sản dựa trên tiêu chuẩn vệ sinh nghiêm ngặc và với sự tôn trọng môi sinh.', NULL, NULL, 0);
INSERT INTO `menu` VALUES (9, 'Đồ khô', 1, 'Có đặc tính tiện lợi, dễ chế biến, dễ bảo quản và để được lâu.', NULL, NULL, 0);
INSERT INTO `menu` VALUES (10, 'dq', 1, 'dq', NULL, NULL, 1);
INSERT INTO `menu` VALUES (11, 'qư', 1, 'qeq', NULL, NULL, 1);
INSERT INTO `menu` VALUES (12, 'dq', 1, 'dq', NULL, NULL, 1);
INSERT INTO `menu` VALUES (13, 'dqd', 1, 'dqd', NULL, NULL, 1);

-- ----------------------------
-- Table structure for message
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message`  (
  `ID` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `time` datetime NOT NULL,
  `status` int NOT NULL DEFAULT 0,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of message
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  INDEX `id`(`id` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of migrations
-- ----------------------------

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint UNSIGNED NOT NULL,
  `shipping_id` bigint UNSIGNED NOT NULL,
  `payment_id` bigint UNSIGNED NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id`(`id` ASC) USING BTREE,
  INDEX `customer_id`(`customer_id` ASC) USING BTREE,
  INDEX `shipping_id`(`shipping_id` ASC) USING BTREE,
  INDEX `payment_id`(`payment_id` ASC) USING BTREE,
  CONSTRAINT `order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `order_ibfk_2` FOREIGN KEY (`shipping_id`) REFERENCES `shipping` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `order_ibfk_3` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES (1, 1, 1, 1, 'Đang xử lý', 0, '2022-05-08 07:10:12', NULL);
INSERT INTO `order` VALUES (2, 1, 2, 2, 'Đang xử lý', 7500, '2022-05-08 07:41:53', NULL);
INSERT INTO `order` VALUES (3, 1, 3, 3, 'Đang xử lý', 9280, '2022-05-08 08:00:57', NULL);
INSERT INTO `order` VALUES (4, 1, 4, 4, 'Đang xử lý', 6960, '2022-05-08 08:18:19', NULL);
INSERT INTO `order` VALUES (5, 1, 5, 5, 'Đang xử lý', 12000, '2022-05-08 08:19:46', NULL);
INSERT INTO `order` VALUES (6, 1, 6, 6, 'Đang xử lý', 0, '2022-05-08 08:34:56', NULL);
INSERT INTO `order` VALUES (7, 1, 7, 7, 'Đang xử lý', 6960, '2022-05-08 08:41:12', NULL);
INSERT INTO `order` VALUES (8, 1, 8, 8, 'Đang xử lý', 0, '2022-05-08 08:42:39', NULL);
INSERT INTO `order` VALUES (9, 1, 9, 9, 'Đang xử lý', 0, '2022-05-08 08:44:58', NULL);
INSERT INTO `order` VALUES (11, 2, 11, 11, 'Đang xử lý', 20000, '2022-05-09 15:03:13', NULL);
INSERT INTO `order` VALUES (12, 2, 12, 12, 'Đang xử lý', 20000, '2022-05-09 15:04:16', NULL);
INSERT INTO `order` VALUES (13, 2, 13, 13, 'Đang xử lý', 20000, '2022-05-09 15:04:32', NULL);
INSERT INTO `order` VALUES (14, 2, 14, 14, 'Đang xử lý', 20000, '2022-05-09 15:06:36', NULL);
INSERT INTO `order` VALUES (15, 2, 15, 15, 'Đang xử lý', 27500, '2022-05-09 15:07:17', NULL);
INSERT INTO `order` VALUES (16, 2, 17, 17, 'Đang xử lý', 27500, '2022-05-09 15:08:25', NULL);
INSERT INTO `order` VALUES (17, 2, 18, 18, 'Đang xử lý', 27500, '2022-05-09 15:08:42', NULL);
INSERT INTO `order` VALUES (18, 2, 19, 19, 'Đang xử lý', 27500, '2022-05-09 15:09:07', NULL);
INSERT INTO `order` VALUES (19, 2, 20, 20, 'Đang xử lý', 27500, '2022-05-09 15:09:14', NULL);
INSERT INTO `order` VALUES (20, 2, 21, 21, 'Đang xử lý', 27500, '2022-05-09 15:10:17', NULL);
INSERT INTO `order` VALUES (21, 2, 22, 22, 'Đang xử lý', 27500, '2022-05-09 15:11:15', NULL);
INSERT INTO `order` VALUES (22, 2, 23, 23, 'Đang xử lý', 34000, '2022-05-09 15:14:01', NULL);
INSERT INTO `order` VALUES (23, 4, 24, 24, 'Đang xử lý', 12900, '2022-05-09 15:38:47', NULL);
INSERT INTO `order` VALUES (24, 4, 25, 25, 'Đang xử lý', 12900, '2022-05-09 15:41:40', NULL);
INSERT INTO `order` VALUES (25, 4, 26, 26, 'Đang xử lý', 12900, '2022-05-09 15:42:04', NULL);
INSERT INTO `order` VALUES (26, 4, 27, 27, 'Đang xử lý', 230000, '2022-05-09 15:43:32', NULL);
INSERT INTO `order` VALUES (27, 5, 28, 28, 'Đang xử lý', 86000, '2022-05-10 07:49:46', NULL);
INSERT INTO `order` VALUES (28, 5, 29, 29, 'Đang xử lý', 61000, '2022-05-10 07:52:00', NULL);

-- ----------------------------
-- Table structure for order_detail
-- ----------------------------
DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE `order_detail`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `price` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `product_id`(`product_id` ASC) USING BTREE,
  INDEX `order_id`(`order_id` ASC) USING BTREE,
  CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 39 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of order_detail
-- ----------------------------
INSERT INTO `order_detail` VALUES (1, 23, 1, 29000, 'Chuối Laba', 2);
INSERT INTO `order_detail` VALUES (2, 5, 2, 25000, 'Rau muống', 0);
INSERT INTO `order_detail` VALUES (3, 24, 3, 29000, 'Bưởi năm roi', 0);
INSERT INTO `order_detail` VALUES (4, 24, 4, 29000, 'Bưởi năm roi', 0);
INSERT INTO `order_detail` VALUES (5, 25, 5, 50000, 'Cà rốt và su su xào', 0);
INSERT INTO `order_detail` VALUES (6, 16, 6, 25000, 'Hành tím Lý Sơn', 0);
INSERT INTO `order_detail` VALUES (7, 24, 7, 29000, 'Bưởi năm roi', 0);
INSERT INTO `order_detail` VALUES (8, 24, 8, 29000, 'Bưởi năm roi', 0);
INSERT INTO `order_detail` VALUES (9, 24, 9, 29000, 'Bưởi năm roi', 0);
INSERT INTO `order_detail` VALUES (11, 5, 11, 25000, 'Rau muống', 1);
INSERT INTO `order_detail` VALUES (12, 5, 12, 25000, 'Rau muống', 1);
INSERT INTO `order_detail` VALUES (13, 5, 13, 25000, 'Rau muống', 1);
INSERT INTO `order_detail` VALUES (14, 5, 14, 25000, 'Rau muống', 1);
INSERT INTO `order_detail` VALUES (15, 5, 15, 25000, 'Rau muống', 1);
INSERT INTO `order_detail` VALUES (16, 16, 15, 25000, 'Hành tím Lý Sơn', 0);
INSERT INTO `order_detail` VALUES (17, 5, 16, 25000, 'Rau muống', 1);
INSERT INTO `order_detail` VALUES (18, 16, 16, 25000, 'Hành tím Lý Sơn', 0);
INSERT INTO `order_detail` VALUES (19, 5, 17, 25000, 'Rau muống', 1);
INSERT INTO `order_detail` VALUES (20, 16, 17, 25000, 'Hành tím Lý Sơn', 0);
INSERT INTO `order_detail` VALUES (21, 5, 18, 25000, 'Rau muống', 1);
INSERT INTO `order_detail` VALUES (22, 16, 18, 25000, 'Hành tím Lý Sơn', 0);
INSERT INTO `order_detail` VALUES (23, 5, 19, 25000, 'Rau muống', 1);
INSERT INTO `order_detail` VALUES (24, 16, 19, 25000, 'Hành tím Lý Sơn', 0);
INSERT INTO `order_detail` VALUES (25, 5, 20, 25000, 'Rau muống', 1);
INSERT INTO `order_detail` VALUES (26, 16, 20, 25000, 'Hành tím Lý Sơn', 0);
INSERT INTO `order_detail` VALUES (27, 5, 21, 25000, 'Rau muống', 1);
INSERT INTO `order_detail` VALUES (28, 16, 21, 25000, 'Hành tím Lý Sơn', 0);
INSERT INTO `order_detail` VALUES (29, 5, 22, 25000, 'Rau muống', 1);
INSERT INTO `order_detail` VALUES (30, 16, 22, 25000, 'Hành tím Lý Sơn', 0);
INSERT INTO `order_detail` VALUES (31, 25, 22, 50000, 'Cà rốt và su su xào', 0);
INSERT INTO `order_detail` VALUES (32, 22, 23, 43000, 'Táo mini', 0);
INSERT INTO `order_detail` VALUES (33, 22, 24, 43000, 'Táo mini', 0);
INSERT INTO `order_detail` VALUES (34, 22, 25, 43000, 'Táo mini', 0);
INSERT INTO `order_detail` VALUES (35, 16, 26, 25000, 'Hành tím Lý Sơn', 10);
INSERT INTO `order_detail` VALUES (36, 22, 27, 43000, 'Táo mini', 2);
INSERT INTO `order_detail` VALUES (37, 22, 28, 43000, 'Táo mini', 2);
INSERT INTO `order_detail` VALUES (38, 25, 28, 50000, 'Cà rốt và su su xào', 1);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for payment
-- ----------------------------
DROP TABLE IF EXISTS `payment`;
CREATE TABLE `payment`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id`(`id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of payment
-- ----------------------------
INSERT INTO `payment` VALUES (1, 'Thanh toán khi nhận hàng', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (2, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (3, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (4, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (5, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (6, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (7, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (8, 'Thanh toán khi nhận hàng', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (9, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (10, 'Thanh toán khi nhận hàng', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (11, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (12, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (13, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (14, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (15, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (16, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (17, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (18, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (19, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (20, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (21, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (22, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (23, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (24, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (25, 'Thanh toán khi nhận hàng', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (26, 'Thanh toán khi nhận hàng', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (27, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (28, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (29, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_id` bigint UNSIGNED NULL DEFAULT NULL,
  `price` int NULL DEFAULT NULL,
  `unit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `active` int NULL DEFAULT NULL,
  `thumb` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `thanhphan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `muavu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `donggoi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `hansudung` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `xuatsu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `giaohang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `is_deleted` int NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id`(`id` ASC) USING BTREE,
  INDEX `menu_id`(`menu_id` ASC) USING BTREE,
  INDEX `name`(`name`(191) ASC) USING BTREE,
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES (5, 'Rau muống', 'Rau muống  là loại rau có thể mọc cả trên cạn và dưới nước, thuộc chia đốt và thuộc loại cây thân bò. Bìm bìm nước là một tên gọi khác của rau muống.\r\n\r\nRau muống là loại rau có giá rất rẻ so với các loại rau khác nhưng lại đem lại lượng khoáng chất và vitamin dồi dào như protein, sắt, canxi, chất xơ, vitamin A... Những chất này là những dưỡng chất cần thiết cho cơ thể.', 6, 25000, 'kg', 1, '20190620_071443_522146_rau-muong.max-1800x1800.png', '100% rau muống sạch, an toàn, chất lượng , không chất bảo quản.', 'Quanh năm', 'Theo kí', 'In trên bao bì', 'TP.HCM', 'Giao hàng trong ngày tại TP.HCM', 0);
INSERT INTO `product` VALUES (6, 'Cherry Canada', 'So với các loại trái cây khác, trái cây Canada có hương vị cực kỳ thơm ngon tự nhiên. Có thể kể đến như dòng cherry Canada được đánh giá cao hơn hẳn so với các dòng cherry Mỹ về độ giòn và độ ngọt.', 7, 350000, 'kg', 1, 'trai-cay-nhap-khau-trai-cherry-bbg.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 0);
INSERT INTO `product` VALUES (7, 'Quýt đường', 'Quýt là loại trái cây rất tốt cho sức khỏe, ngon - ngọt là trái cây rất yêu thích của nhiều người', 7, 160000, 'kg', 1, 'download.jfif', NULL, NULL, NULL, NULL, NULL, NULL, 0);
INSERT INTO `product` VALUES (8, 'Dâu tây Đà Lạt', 'Dâu tây Đà Lạt nổi tiếng thơm mát,tươi sạch là đặc sản của vùng cao nguyên này.Giá dâu tây của chúng tôi tốt nhất Thành phố', 7, 395000, 'kg', 1, 'dau-tay-da-lat.gif', NULL, NULL, NULL, NULL, NULL, NULL, 0);
INSERT INTO `product` VALUES (9, 'Cà rốt to', 'Cà rốt là loại rau củ được các chuyên gia dinh dưỡng khuyên dùng thường xuyên để bổ sung đầy đủ dinh dưỡng. Cà rốt bồi bổ sức khỏe, làm đẹp da và phòng chống các bệnh lí ung thư rất hiệu quả. Nước ép cà rốt giúp tăng sức đề kháng cho cơ thể, phòng chống bệnh cao huyết áp vô cùng tốt.', 6, 17000, 'kg', 1, 'images1818372_ca_rot_7222_1486343099.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 0);
INSERT INTO `product` VALUES (10, 'Cà chua Mộc Châu', 'Cà chua Mộc Châu - một loại rau an toàn được sử dụng rất phổ biến trong cuộc sống.Nó có tính lưu huyết, giải độc, chống khát nước, thông tiểu tiện và tốt cho hệ tiêu hóa. Không chỉ là thực phẩm ngon tuyệt vời trong các món ăn mà cà chua còn là cứu tinh cho chị em phụ nữ trong việc làm đẹp.Cà chua chứa nhiều vitamin C, E, hàm lượng chất chống oxy hóa cao cùng các dưỡng chất như carotene, kali, chất sắt… rất tốt cho da,giảm oxy hóa.', 6, 6000, 'kg', 1, 'img_8796.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 0);
INSERT INTO `product` VALUES (11, 'Ớt Chuông Đà Lạt', 'Ớt chuông Đà Lạt được xếp là một trong những loại rau củ chứa nhiều chất xơ mà không có nguy cơ dư thừa lượng calo hấp thụ', 6, 60000, 'kg', 1, '171871525816.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 0);
INSERT INTO `product` VALUES (12, 'Súp lơ xanh', 'Súp lơ xanh là loại thực phẩm rất tốt cho sức khỏe, tăng cường sức đề kháng cho các thành viên trong gia đình. Súp lơ xanh chứa nhiều vitamin A, C và E hơn bất cứ loại rau quả nào khác', 6, 45000, 'kg', 1, '8d27a83c538585fb0c7c4d2a1628d5d2.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 0);
INSERT INTO `product` VALUES (13, 'Táo fuji', 'Táo Fuji tươi, dòn, vị ngọt có cảm giác như đang thưởng thức một cốc nước ép táo vô cùng sảng khoái.', 7, 25000, 'kg', 1, 'táo-fuji-mỹ.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 0);
INSERT INTO `product` VALUES (14, 'Tỏi Lý sơn', 'Là dạng dễ dùng nhất, có thể ăn sống hoặc dầm vào nước chấm. Khi nhấm tỏi sống, các vi khuẩn có trong khoang miệng sẽ bị tiêu diệt. Mỗi ngày nên ăn 2 tép tỏi sống là đủ, ăn nhiều quá cũng không có lợi cho dạ dày và chất axilin có trong tỏi có thể gây chứng tan máu.', 6, 29000, 'kg', 1, 'toi-ly-son-1.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 0);
INSERT INTO `product` VALUES (15, 'Ớt chỉ thiên', 'Là gia vị không thể thiếu trong mỗi bữa cơm gia đình', 6, 23000, 'kg', 1, 'ot-chi-thien-tapdoanvinasa-02.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 0);
INSERT INTO `product` VALUES (16, 'Hành tím Lý Sơn', 'Hành tím Lý Sơn đã trở thành đặc sản của vùng biển đảo Lý Sơn  – Quảng Ngãi. Đây là vùng đất được hình thành do quá trình hoạt động núi lửa và sự bồi đắp của cát biển, đá san hô biển tạo nên, với sự đặc biệt về thổ nhưỡng và kinh nghiệm truyền thống bao đời từ khi khai sinh vùng đất đảo, đã làm cho hành Lý Sơn có hương vị riêng và đặc biệt. Hành tím của lý sơn có màu tím đặc trưng và đặc biệt có vị thơm.', 6, 25000, 'kg', 1, 'hanh-tim-1.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 0);
INSERT INTO `product` VALUES (17, 'Cá hồi NaUy', 'Cá hồi NaUy được biết đến như một loại thực phẩm lành mạnh giàu protein,axit béo,omega -3 và vitamin D.Ăn thịt cá hồi mang lại nhiều lợi ích cho sức khỏe như: chống các dấu hiệu lão hóa, giảm mức cholesterol và huyết áp, kéo giảm nguy cơ bị đột quỵ, giúp giảm đau và cứng khớp gây ra bởi viêm khớp', 8, 420000, 'kg', 1, 'images.jfif', NULL, NULL, NULL, NULL, NULL, NULL, 0);
INSERT INTO `product` VALUES (18, 'Cá bò khô Bá Kiến', 'Cá bò khô là món ngon được rất nhiều người yêu thích bởi hương vị đặc trưng, cái dai dai, mặn mà, thêm chút ngọt thơm hòa quyện trong từng thớ thịt. Đối với cánh mày râu, đây còn là mồi nhấm cùng rượu hoặc bia tươi vô cùng lý tưởng. Cuộc vui bên bạn bè hay những người thân yêu sẽ hoàn hảo hơn rất nhiều nếu bạn tìm được địa chỉ mua cá bò khô uy tín và chất lượng', 9, 250000, 'kg', 1, 'IMG_7849-1-768x512.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 0);
INSERT INTO `product` VALUES (19, 'Dưa hấu', 'Mùa hè đến là thời điểm lý tưởng để thưởng thức những trái dưa hấu đỏ ngọt, tươi mát. Dưa hấu không chỉ là một loại hoa quả hấp dẫn, nó còn có những tác dụng tích cực cho sức khỏe rất có thể bạn chưa biết hết. Quả dưa hấu có tên khoa học là Citrullus lanatus, vị ngọt mát, nhiều nước (hơn 90% trọng lượng dưa hấu là nước), đồng thời dưa hấu còn giúp cung cấp nhiều vitamin, các nguyên tố vi lượng cho cơ thể.\r\n\r\nDưa hấu chứa ít calo (46 Kcal mỗi cốc), chứa hàm lượng vitamin C và vitamin A cao (dưa hấu cung cấp 17% lượng vitamin A + 20% lượng vitamin C cần thiết mà cơ thể bạn cân/ ngày). Dưa hấu cũng rất giàu chất xơ và kali.', 7, 15000, 'kg', 1, 'duahau.jfif', 'Dưa hấu đỏ ngọt tươi mát', 'Quanh năm', 'Một quả', 'Thời hạn bảo quản 1 tuần trong tủ lạnh', 'miền Tây', 'Giao hàng toàn quốc', 0);
INSERT INTO `product` VALUES (20, 'Đậu xanh hạt gói 150g', 'Đậu xanh là một loại đậu dùng để chế biến rất nhiều món ngon cũng như cung cấp nhiều dưỡng chất tốt cho cơ thể. Thương hiệu VietFresh cung cấp cho chúng ta sản phẩm đậu xanh hạt cao cấp tươi mới.', 9, 100600, 'kg', 1, 'dau-xanh-hat-cao-cap-vietfresh-150g-202012092307410559.jpg', 'Đậu xanh hạt 100%', 'Hàng năm', 'Nơi khô thoáng, trong túi kín gió và tránh ánh nắng trực tiếp', '30 ngày', 'Giao ngẫu nhiên Naita hoặc Fresh', 'Giao hàng tận nơi', 0);
INSERT INTO `product` VALUES (21, 'Việt quất', 'Việt quất (hay còn gọi là Blueberry) là một loại trái cây nhập khẩu không còn quá xa lạ đối với người tiêu dùng Việt Nam. Đây không chỉ là loại trái cây có màu sắc bắt mắt mà còn chứa nhiều chất dinh dưỡng cùng công dụng tốt cho sức khoẻ. \r\nViệt quất thì quả khá tròn trịa, vỏ mỏng và trơn mịn. Đường kính trung bình dao động tầm 2 – 3 cm, một đầu có cuống và một đầu có phần đài quả. Quả thường có màu xanh sẫm gần như màu mực, một vài giống thì sẽ có màu đen hoặc đỏ. Việt quất mang vị ngọt thơm, khi mới ăn có thể thấy hơi chát nhưng sau quen rồi lại thấy rất hấp dẫn.', 7, 1490000, 'kg', 1, 'viet-quat-hop-125g-202101141115286393.jpg', '84% nước, 14% Cacbohydrat cùng nhiều khoáng chất thiết yếu khác như: Carotene, Anthocyanin, vitamin (A, C, K), Kali, Natri, Canxi, Magie, Photpho, Sắt,...', 'Hàng năm', 'Gói 125gram', '15/1/2022', 'Trái cây nhập khẩu từ Nhật Bản', 'Giao hàng tận nơi', 0);
INSERT INTO `product` VALUES (22, 'Táo mini', 'Táo được biết đến như một loại trái cây có lợi cho sắc đẹp và có tác dụng giảm cân, ngăn ngừa bệnh tim mạch. Với lượng dưỡng chất dồi dào, vị giòn ngọt, thanh mát, trái nhỏ. Táo Gala mini nhập khẩu New Zealand là trái cây nhập khẩu chất lượng an toàn, vừa tiết kiệm về giá, lại vừa vặn cho một lần ăn mà không gây ngán, không phải dự trữ lại.', 7, 43000, 'kg', 1, 'táo-mini.jpg', 'Táo mini', 'Hàng năm', 'Hộp 1kg', '1 tháng', 'Trái cây nhập khẩu từ Nhật Bản', 'Giao hàng tận nơi', 0);
INSERT INTO `product` VALUES (23, 'Chuối Laba', 'Chuối Laba (hay còn gọi là chuối Tiến Vua) là một trong những loại trái cây đặc sản Đà Lạt. Thoạt nhìn, chuối Laba có hình dáng tương tự với giống chuối già Nam Mỹ, tuy nhiên về chất lượng và hương vị thì hoàn toàn khác nhau. \r\nChuối Laba có quả thon dài, hơi cong, cuống to ngắn, buồng nhỏ, trái úp úp vào buồng như mảnh trăng lưỡi liềm, khoảng cách giữa các cuống dày và khít vào nhau. Thịt chuối Laba có màu vàng sánh, dẻo, vị ngọt đậm thơm ngon và có hương thơm đặc trưng. Ngoài ra, chuối Laba có hàm lượng đường cao hơn các loại chuối khác.', 7, 29000, 'kg', 1, 'chuoi-laba-tui-1kg-202101271611376661.jpg', 'Chuối chứa nhiều chất dinh dưỡng như kali, chất xơ, vitamin,...', 'Hàng năm', 'Hộp 1kg', '30 ngày', 'Đà Lạt', 'Giao hàng tận nơi', 0);
INSERT INTO `product` VALUES (24, 'Bưởi năm roi', 'Bưởi năm roi là một trong những đặc sản nổi tiếng của Việt Nam. Loại bưởi này không chỉ ngon, ngọt mà còn mang lại cho con người nhiều công dụng tốt cho sức khoẻ như cung cấp nguồn vitamin dồi dào. Bưởi năm roi tại Bách hoá XANH thích hợp cho những ngày nắng nóng với nhiều cách chế biến khác nhau.', 7, 29000, 'kg', 1, 'buoi-nam-roi-tui-1kg-202112251732267497.jpg', 'Bưởi năm roi', 'Hàng năm', 'Hộp 1kg', '30 ngày', 'miền Tây Nam Bộ', 'Giao hàng tận nơi', 0);
INSERT INTO `product` VALUES (25, 'Cà rốt và su su xào', 'Sản phẩm cà rốt và su su được làm sạch và sơ chế cắt sợi sẵn dễ dàng, thuận tiện cho bạn chế biến, tiết kiệm được nhiều thời gian nấu nướng. Cà rốt và su su xào khay 300g bao bì sạch sẽ, vệ sinh, cung cấp chất xơ và vitamin cần thiết cho cơ thể.', 6, 50000, 'kg', 1, 'ca-rot-va-su-su-xao-khay-300g-202201040747484286.jpg', 'Su su, cà rốt, cần tàu, hành lá, ớt', 'Hàng năm', 'Khay 300gram', '1 tháng', 'Trường An', 'Giao hàng tận nơi', 0);
INSERT INTO `product` VALUES (29, 'Test', 'Test', 7, 100000, 'combo', 0, 'WIN_20220424_13_30_35_Pro.jpg', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 1);

-- ----------------------------
-- Table structure for rotate
-- ----------------------------
DROP TABLE IF EXISTS `rotate`;
CREATE TABLE `rotate`  (
  `ID` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint UNSIGNED NOT NULL,
  `voucher_id` bigint UNSIGNED NOT NULL,
  `rotate_at` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  INDEX `voucher_id`(`voucher_id` ASC) USING BTREE,
  INDEX `customer_id`(`customer_id` ASC) USING BTREE,
  CONSTRAINT `rotate_ibfk_2` FOREIGN KEY (`voucher_id`) REFERENCES `voucher` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `rotate_ibfk_3` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of rotate
-- ----------------------------
INSERT INTO `rotate` VALUES (1, 1, 7, '2022-05-07');
INSERT INTO `rotate` VALUES (2, 1, 8, '2022-05-07');
INSERT INTO `rotate` VALUES (3, 1, 9, '2022-05-07');
INSERT INTO `rotate` VALUES (4, 1, 10, '2022-05-07');
INSERT INTO `rotate` VALUES (5, 1, 11, '2022-05-07');
INSERT INTO `rotate` VALUES (6, 1, 12, '2022-05-07');
INSERT INTO `rotate` VALUES (7, 1, 13, '2022-05-07');
INSERT INTO `rotate` VALUES (8, 1, 15, '2022-05-07');
INSERT INTO `rotate` VALUES (9, 1, 16, '2022-05-07');
INSERT INTO `rotate` VALUES (10, 1, 17, '2022-05-07');
INSERT INTO `rotate` VALUES (11, 1, 18, '2022-05-07');
INSERT INTO `rotate` VALUES (12, 1, 19, '2022-05-07');
INSERT INTO `rotate` VALUES (13, 1, 20, '2022-05-08');
INSERT INTO `rotate` VALUES (14, 3, 21, '2022-05-09');
INSERT INTO `rotate` VALUES (15, 3, 22, '2022-05-09');
INSERT INTO `rotate` VALUES (16, 4, 23, '2022-05-09');
INSERT INTO `rotate` VALUES (17, 5, 24, '2022-05-10');

-- ----------------------------
-- Table structure for shipping
-- ----------------------------
DROP TABLE IF EXISTS `shipping`;
CREATE TABLE `shipping`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id`(`id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of shipping
-- ----------------------------
INSERT INTO `shipping` VALUES (1, '2022-05-08 07:10:12', NULL, 'Nguyễn Hoàng Trường', 'hoangtruong1808@gmail.com', '0704804311', 'hoangtruong1808@gmail.com', NULL);
INSERT INTO `shipping` VALUES (2, '2022-05-08 07:41:53', NULL, 'Nguyễn Hoàng Trường', 'hoangtruong1808@gmail.com', '0704804311', 'hoangtruong1808@gmail.com', NULL);
INSERT INTO `shipping` VALUES (3, '2022-05-08 08:00:57', NULL, 'Nguyễn Hoàng Trường', 'hoangtruong1808@gmail.com', '0704804311', 'hoangtruong1808@gmail.com', NULL);
INSERT INTO `shipping` VALUES (4, '2022-05-08 08:18:19', NULL, 'Nguyễn Hoàng Trường', 'hoangtruong1808@gmail.com', '0704804311', 'hoangtruong1808@gmail.com', NULL);
INSERT INTO `shipping` VALUES (5, '2022-05-08 08:19:46', NULL, 'Nguyễn Hoàng Trường', 'hoangtruong1808@gmail.com', '0704804311', 'hoangtruong1808@gmail.com', NULL);
INSERT INTO `shipping` VALUES (6, '2022-05-08 08:34:56', NULL, 'Nguyễn Hoàng Trường', 'hoangtruong1808@gmail.com', '0704804311', 'hoangtruong1808@gmail.com', NULL);
INSERT INTO `shipping` VALUES (7, '2022-05-08 08:41:12', NULL, 'Nguyễn Hoàng Trường', 'hoangtruong1808@gmail.com', '0704804311', 'hoangtruong1808@gmail.com', NULL);
INSERT INTO `shipping` VALUES (8, '2022-05-08 08:42:39', NULL, 'Nguyễn Hoàng Trường', 'hoangtruong1808@gmail.com', '0704804311', 'hoangtruong1808@gmail.com', NULL);
INSERT INTO `shipping` VALUES (9, '2022-05-08 08:44:58', NULL, 'Nguyễn Hoàng Trường', 'hoangtruong1808@gmail.com', '0704804311', 'hoangtruong1808@gmail.com', NULL);
INSERT INTO `shipping` VALUES (10, '2022-05-09 15:01:37', NULL, 'user-test', '25B Tô Vĩnh Diện', '123456', 'user-test@gmail.com', NULL);
INSERT INTO `shipping` VALUES (11, '2022-05-09 15:03:13', NULL, 'user-test', '25B Tô Vĩnh Diện', '123456', 'user-test@gmail.com', NULL);
INSERT INTO `shipping` VALUES (12, '2022-05-09 15:04:16', NULL, 'user-test', '25B Tô Vĩnh Diện', '123456', 'user-test@gmail.com', NULL);
INSERT INTO `shipping` VALUES (13, '2022-05-09 15:04:32', NULL, 'user-test', '25B Tô Vĩnh Diện', '123456', 'user-test@gmail.com', NULL);
INSERT INTO `shipping` VALUES (14, '2022-05-09 15:06:36', NULL, 'user-test', '25B Tô Vĩnh Diện', '123456', 'user-test@gmail.com', NULL);
INSERT INTO `shipping` VALUES (15, '2022-05-09 15:07:17', NULL, 'user-test', '25B Tô Vĩnh Diện', '123456', 'user-test@gmail.com', NULL);
INSERT INTO `shipping` VALUES (16, '2022-05-09 15:07:44', NULL, 'user-test', '25B Tô Vĩnh Diện', '123456', 'user-test@gmail.com', NULL);
INSERT INTO `shipping` VALUES (17, '2022-05-09 15:08:25', NULL, 'user-test', '25B Tô Vĩnh Diện', '123456', 'user-test@gmail.com', NULL);
INSERT INTO `shipping` VALUES (18, '2022-05-09 15:08:42', NULL, 'user-test', '25B Tô Vĩnh Diện', '123456', 'user-test@gmail.com', NULL);
INSERT INTO `shipping` VALUES (19, '2022-05-09 15:09:07', NULL, 'user-test', '25B Tô Vĩnh Diện', '123456', 'user-test@gmail.com', NULL);
INSERT INTO `shipping` VALUES (20, '2022-05-09 15:09:14', NULL, 'user-test', '25B Tô Vĩnh Diện', '123456', 'user-test@gmail.com', NULL);
INSERT INTO `shipping` VALUES (21, '2022-05-09 15:10:17', NULL, 'user-test', '25B Tô Vĩnh Diện', '123456', 'user-test@gmail.com', NULL);
INSERT INTO `shipping` VALUES (22, '2022-05-09 15:11:15', NULL, 'user-test', '25B Tô Vĩnh Diện', '123456', 'user-test@gmail.com', NULL);
INSERT INTO `shipping` VALUES (23, '2022-05-09 15:14:01', NULL, 'user-test', '25B Tô Vĩnh Diện', '123456', 'user-test@gmail.com', NULL);
INSERT INTO `shipping` VALUES (24, '2022-05-09 15:38:47', NULL, 'user-test', 'Đăng sản phẩm cần bán, cần mua', '07048043111', 'truong123@gmail.com', NULL);
INSERT INTO `shipping` VALUES (25, '2022-05-09 15:41:40', NULL, 'user-test', 'Đăng sản phẩm cần bán, cần mua', '07048043111', 'truong123@gmail.com', NULL);
INSERT INTO `shipping` VALUES (26, '2022-05-09 15:42:04', NULL, 'user-test', 'Đăng sản phẩm cần bán, cần mua', '07048043111', 'truong123@gmail.com', NULL);
INSERT INTO `shipping` VALUES (27, '2022-05-09 15:43:32', NULL, 'user-test', 'Đăng sản phẩm cần bán, cần mua', '07048043111', 'truong123@gmail.com', NULL);
INSERT INTO `shipping` VALUES (28, '2022-05-10 07:49:46', NULL, 'User01', '25B Tô Vĩnh Diện', '0704804312', 'User01@gmail.com', NULL);
INSERT INTO `shipping` VALUES (29, '2022-05-10 07:52:00', NULL, 'User01', '25B Tô Vĩnh Diện', '0704804312', 'User01@gmail.com', NULL);

-- ----------------------------
-- Table structure for staff
-- ----------------------------
DROP TABLE IF EXISTS `staff`;
CREATE TABLE `staff`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id`(`id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of staff
-- ----------------------------

-- ----------------------------
-- Table structure for staff_log
-- ----------------------------
DROP TABLE IF EXISTS `staff_log`;
CREATE TABLE `staff_log`  (
  `ID` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `action` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `staff_id` bigint UNSIGNED NOT NULL,
  `created_at` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  INDEX `staff_id`(`staff_id` ASC) USING BTREE,
  CONSTRAINT `staff_log_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of staff_log
-- ----------------------------

-- ----------------------------
-- Table structure for supplier
-- ----------------------------
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `address` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `mail` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `is_deleted` int UNSIGNED NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of supplier
-- ----------------------------

-- ----------------------------
-- Table structure for use_voucher
-- ----------------------------
DROP TABLE IF EXISTS `use_voucher`;
CREATE TABLE `use_voucher`  (
  `ID` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `voucher_id` bigint UNSIGNED NULL DEFAULT NULL,
  `use_at` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  INDEX `voucher_id`(`voucher_id` ASC) USING BTREE,
  INDEX `customer_id`(`customer_id` ASC) USING BTREE,
  INDEX `order_id`(`order_id` ASC) USING BTREE,
  CONSTRAINT `use_voucher_ibfk_3` FOREIGN KEY (`voucher_id`) REFERENCES `voucher` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `use_voucher_ibfk_4` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `use_voucher_ibfk_5` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of use_voucher
-- ----------------------------
INSERT INTO `use_voucher` VALUES (9, 2, 22, 1, NULL);

-- ----------------------------
-- Table structure for voucher
-- ----------------------------
DROP TABLE IF EXISTS `voucher`;
CREATE TABLE `voucher`  (
  `ID` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` char(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `value` int NOT NULL,
  `unit` varchar(10) CHARACTER SET utf32 COLLATE utf32_vietnamese_ci NULL DEFAULT NULL,
  `order_min` int NULL DEFAULT NULL,
  `order_max` int NULL DEFAULT NULL,
  `quantity` int NULL DEFAULT NULL,
  `quantity_per_account` int NULL DEFAULT NULL,
  `date_start` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_end` varchar(255) CHARACTER SET utf32 COLLATE utf32_vietnamese_ci NULL DEFAULT NULL,
  `describe` varchar(255) CHARACTER SET utf32 COLLATE utf32_vietnamese_ci NULL DEFAULT NULL,
  `customer_type` int NULL DEFAULT NULL,
  `active` int NULL DEFAULT 1,
  `is_deleted` int NULL DEFAULT 0,
  `created_at` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `voucher_type` int NULL DEFAULT 1,
  `customer_id` bigint UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of voucher
-- ----------------------------
INSERT INTO `voucher` VALUES (1, 'Svb8tJKX', 20, '%', 200000, 400000, -1, 14, '2022-05-26T21:03', '2022-05-28T21:03', '123', 0, 1, 0, '2022-05-07', 1, NULL);
INSERT INTO `voucher` VALUES (2, 'SndTe248', 123000, 'VNĐ', 1, 2, -1, NULL, '2022-05-07T21:18', '2022-05-06T21:18', NULL, 0, 1, 0, '2022-05-07', 1, NULL);
INSERT INTO `voucher` VALUES (3, 'KbkNBxHy', 20, '%', 200000, 3000000, NULL, NULL, '2022-05-19T21:24', '2022-05-07T21:24', NULL, 0, 1, 0, '2022-05-07', 1, NULL);
INSERT INTO `voucher` VALUES (4, 'Fgcaaz49', 11111, '%', NULL, NULL, NULL, NULL, '2022-05-13T21:26', '2022-05-26T21:27', NULL, 0, 1, 0, '2022-05-07', 1, NULL);
INSERT INTO `voucher` VALUES (5, 'Xq32O7TF', 20, '%', NULL, NULL, NULL, NULL, NULL, NULL, 'Tuần lễ vàng', 0, 1, 0, '2022-05-07', 1, NULL);
INSERT INTO `voucher` VALUES (6, '4l5CV6iY', 20000, 'VNĐ', 200000, 400000, 5, 2, '2022-05-13T22:13', '2022-05-19T22:13', 'ABC', NULL, 1, 0, '2022-05-07', 1, NULL);
INSERT INTO `voucher` VALUES (7, 'EzIWYgHL', 20000, 'VNĐ', NULL, NULL, 1, NULL, NULL, NULL, 'Mã khuyến mãi từ vòng quay may mắn', NULL, 1, 1, '2022-05-07', 2, NULL);
INSERT INTO `voucher` VALUES (8, 'cp3z2FBs', 10000, 'VNĐ', NULL, NULL, 1, NULL, NULL, NULL, 'Mã khuyến mãi từ vòng quay may mắn', NULL, 1, 1, '2022-05-07', 2, NULL);
INSERT INTO `voucher` VALUES (9, 'qVjKdewk', 20000, 'VNĐ', NULL, NULL, 1, NULL, NULL, NULL, 'Mã khuyến mãi từ vòng quay may mắn', NULL, 1, 1, '2022-05-07', 2, NULL);
INSERT INTO `voucher` VALUES (10, 'rAxLDNdM', 60000, 'VNĐ', NULL, NULL, 1, NULL, NULL, NULL, 'Mã khuyến mãi từ vòng quay may mắn', NULL, 1, 1, '2022-05-07', 2, NULL);
INSERT INTO `voucher` VALUES (11, 'aDYlIj2L', 40000, 'VNĐ', NULL, NULL, 1, NULL, NULL, NULL, 'Mã khuyến mãi từ vòng quay may mắn', NULL, 1, 1, '2022-05-07', 2, NULL);
INSERT INTO `voucher` VALUES (12, 'LpDc0grM', 50000, 'VNĐ', NULL, NULL, 1, NULL, NULL, NULL, 'Mã khuyến mãi từ vòng quay may mắn', NULL, 1, 1, '2022-05-07', 2, NULL);
INSERT INTO `voucher` VALUES (13, 'W24Mb0zy', 20000, 'VNĐ', NULL, NULL, 1, NULL, NULL, NULL, 'Mã khuyến mãi từ vòng quay may mắn', NULL, 1, 1, '2022-05-07', 2, NULL);
INSERT INTO `voucher` VALUES (14, 'ciC9CtWz', 50000, 'VNĐ', NULL, NULL, 1, NULL, NULL, NULL, 'Mã khuyến mãi từ vòng quay may mắn', NULL, 1, 1, '2022-05-07', 2, NULL);
INSERT INTO `voucher` VALUES (15, 'HuZoMivt', 20000, 'VNĐ', NULL, NULL, 1, NULL, NULL, NULL, 'Mã khuyến mãi từ vòng quay may mắn', NULL, 1, 1, '2022-05-07', 2, NULL);
INSERT INTO `voucher` VALUES (16, '1hfQnb8r', 40000, 'VNĐ', NULL, NULL, 1, NULL, NULL, NULL, 'Mã khuyến mãi từ vòng quay may mắn', NULL, 1, 1, '2022-05-07', 2, NULL);
INSERT INTO `voucher` VALUES (17, 'A1xDvZEu', 60000, 'VNĐ', NULL, NULL, 1, NULL, NULL, NULL, 'Mã khuyến mãi từ vòng quay may mắn', NULL, 1, 1, '2022-05-07', 2, NULL);
INSERT INTO `voucher` VALUES (18, 'rL9t73Ki', 60000, 'VNĐ', NULL, NULL, 1, NULL, NULL, NULL, 'Mã khuyến mãi từ vòng quay may mắn', NULL, 1, 1, '2022-05-07', 2, NULL);
INSERT INTO `voucher` VALUES (19, '1Epp7uIw', 30000, 'VNĐ', NULL, NULL, 1, NULL, NULL, NULL, 'Mã khuyến mãi từ vòng quay may mắn', NULL, 1, 1, '2022-05-07', 2, NULL);
INSERT INTO `voucher` VALUES (20, 'VqxfMmV6', 50000, 'VNĐ', NULL, NULL, -2, NULL, NULL, NULL, 'Mã khuyến mãi từ vòng quay may mắn', NULL, 1, 0, '2022-05-08', 2, 1);
INSERT INTO `voucher` VALUES (21, 'ApShAypR', 60000, 'VNĐ', NULL, NULL, 1, NULL, NULL, NULL, 'Mã khuyến mãi từ vòng quay may mắn', NULL, 1, 0, '2022-05-09', 2, 3);
INSERT INTO `voucher` VALUES (22, 'WtApTbMv', 40000, 'VNĐ', NULL, NULL, 1, NULL, NULL, NULL, 'Mã khuyến mãi từ vòng quay may mắn', NULL, 1, 0, '2022-05-09', 2, 3);
INSERT INTO `voucher` VALUES (23, 'xvmBH9NG', 20000, 'VNĐ', NULL, NULL, 1, NULL, NULL, NULL, 'Mã khuyến mãi từ vòng quay may mắn', NULL, 1, 0, '2022-05-09', 2, 4);
INSERT INTO `voucher` VALUES (24, 'DE20WoSr', 50000, 'VNĐ', NULL, NULL, 1, NULL, NULL, NULL, 'Mã khuyến mãi từ vòng quay may mắn', NULL, 1, 0, '2022-05-10', 2, 5);

-- ----------------------------
-- Table structure for warehouse_goods
-- ----------------------------
DROP TABLE IF EXISTS `warehouse_goods`;
CREATE TABLE `warehouse_goods`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint UNSIGNED NOT NULL,
  `inventory_quantity` int NULL DEFAULT NULL,
  `delivery_quantity` int NULL DEFAULT NULL,
  `wait_delivery_quantity` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `product_id`(`product_id` ASC) USING BTREE,
  CONSTRAINT `warehouse_goods_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of warehouse_goods
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;

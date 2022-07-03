/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100421
 Source Host           : localhost:3306
 Source Schema         : sql_cuahangnongsan

 Target Server Type    : MySQL
 Target Server Version : 100421
 File Encoding         : 65001

 Date: 03/07/2022 22:54:37
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
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of comment
-- ----------------------------
INSERT INTO `comment` VALUES (21, 10, 38, '30/06/2022', 0, 'Táo rất ngon');

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
  `is_deleted` int NULL DEFAULT 0,
  `customer_type` int NULL DEFAULT 2,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of customer
-- ----------------------------
INSERT INTO `customer` VALUES (0, 'Other customer', 'admin', 'admin@gmail.com', '$2y$10$FcDhgjVKUYsgXa9b2hO9H.XRJaVbm6IosjzdMWiOGPLTLraWltk8m', '01234567', 'default-avatar.png', 8, NULL, NULL, 0, 2);
INSERT INTO `customer` VALUES (10, 'Hoàng Trường', '25B Tô Vĩnh Diện, TP.Pleiku, Gia Lai', 'hoangtruong.test@outlook.com', '$2y$10$nI7QgpQWrb4b5Rldga5rj.k5h5olEp10fxDBV/T2VV36Mu4l/cQXS', '0704804311', 'default-avatar.png', 6, NULL, NULL, 0, 2);
INSERT INTO `customer` VALUES (12, 'Đỗ Gia Tuấn', 'Pleiku, Gia Lai', 'giatuando@gmail.com', '$2y$10$JmpWM..xL.6z8c5bzIScI.Pp78sjWGWpfTJUNLUCY9c6yxg1Ht/.W', '012345678', 'default-avatar.png', 1, NULL, NULL, 0, 2);
INSERT INTO `customer` VALUES (13, 'Trường test', '25B Tô Vĩnh Diện, TP.Pleiku, Gia Lai', 'n-truong@plott.co.jp', '$2y$10$U6zlawgCEd3b1j/B8poYtOXFIImjO6hyuwPPJKvA6xjmYU4vGdmqS', '0123456789', 'default-avatar.png', 1, NULL, NULL, 1, 2);
INSERT INTO `customer` VALUES (14, 'Nguyễn Hoàng Trường', '22.14 Phan Văn Hớn', 'hoangtruong.tes1t@outlook.com', '$2y$10$TUVMixP76h7E66MRgDTEa.gegVSSLDPpvzTfglSMMo/5nVswsl/Ee', '07048043111', 'default-avatar.png', 0, NULL, NULL, 0, 2);
INSERT INTO `customer` VALUES (15, 'Nguyễn Thị Hoàng Thư', '22.14 Phan Văn Hớn', 'hoangtruong1808@gmail.com', '$2y$10$1UW3vW4A/8Y8MbImZ8Pzxeafnruc17fjvdedgJZ4VY9AsWo1Pf/VG', '0388783394', 'default-avatar.png', 0, NULL, NULL, 0, 2);

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
-- Table structure for favorite
-- ----------------------------
DROP TABLE IF EXISTS `favorite`;
CREATE TABLE `favorite`  (
  `ID` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  INDEX `customer_id`(`customer_id` ASC) USING BTREE,
  INDEX `product_id`(`product_id` ASC) USING BTREE,
  CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `favorite_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 187 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of favorite
-- ----------------------------
INSERT INTO `favorite` VALUES (171, 10, 7);
INSERT INTO `favorite` VALUES (172, 10, 12);
INSERT INTO `favorite` VALUES (173, 12, 33);
INSERT INTO `favorite` VALUES (174, 12, 31);
INSERT INTO `favorite` VALUES (175, 12, 32);
INSERT INTO `favorite` VALUES (177, 12, 20);
INSERT INTO `favorite` VALUES (178, 10, 38);
INSERT INTO `favorite` VALUES (179, 10, 8);
INSERT INTO `favorite` VALUES (181, 14, 66);
INSERT INTO `favorite` VALUES (185, 15, 66);
INSERT INTO `favorite` VALUES (186, 15, 65);

-- ----------------------------
-- Table structure for import_goods
-- ----------------------------
DROP TABLE IF EXISTS `import_goods`;
CREATE TABLE `import_goods`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `staff_id` bigint UNSIGNED NOT NULL,
  `supplier_id` bigint UNSIGNED NOT NULL,
  `total` int NOT NULL,
  `import_date` datetime NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `supplier_id`(`supplier_id` ASC) USING BTREE,
  INDEX `staff_id`(`staff_id` ASC) USING BTREE,
  CONSTRAINT `import_goods_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `import_goods_ibfk_3` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of import_goods
-- ----------------------------
INSERT INTO `import_goods` VALUES (22, 6, 4, 1360000, '2022-06-29 19:59:06');
INSERT INTO `import_goods` VALUES (23, 6, 4, 1360000, '2022-06-29 20:02:14');
INSERT INTO `import_goods` VALUES (24, 6, 4, 6, '2022-06-29 20:04:13');
INSERT INTO `import_goods` VALUES (25, 6, 4, 2000000, '2022-06-29 20:06:24');
INSERT INTO `import_goods` VALUES (26, 6, 4, 110000, '2022-06-30 21:06:30');
INSERT INTO `import_goods` VALUES (27, 7, 5, 10000, '2022-07-02 10:25:33');
INSERT INTO `import_goods` VALUES (28, 7, 5, 10000, '2022-07-02 16:10:12');
INSERT INTO `import_goods` VALUES (29, 6, 5, 1, '2022-07-02 16:12:33');
INSERT INTO `import_goods` VALUES (30, 7, 5, 1000, '2022-07-02 16:24:22');
INSERT INTO `import_goods` VALUES (31, 7, 5, 1000, '2022-07-02 16:24:24');
INSERT INTO `import_goods` VALUES (32, 7, 4, 10000, '2022-07-03 21:30:13');
INSERT INTO `import_goods` VALUES (33, 7, 4, 10000, '2022-07-03 21:30:58');
INSERT INTO `import_goods` VALUES (34, 7, 5, 500000, '2022-07-03 22:46:36');

-- ----------------------------
-- Table structure for import_goods_detail
-- ----------------------------
DROP TABLE IF EXISTS `import_goods_detail`;
CREATE TABLE `import_goods_detail`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `import_goods_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `unit_price` char(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `price` int NOT NULL,
  `product_id` bigint NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `import_goods_id`(`import_goods_id` ASC) USING BTREE,
  CONSTRAINT `import_goods_detail_ibfk_1` FOREIGN KEY (`import_goods_id`) REFERENCES `import_goods` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 60 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of import_goods_detail
-- ----------------------------
INSERT INTO `import_goods_detail` VALUES (39, 22, 100, '10000', 1000000, 1);
INSERT INTO `import_goods_detail` VALUES (40, 22, 50, '5000', 250000, 2);
INSERT INTO `import_goods_detail` VALUES (41, 22, 100, '1000', 100000, 4);
INSERT INTO `import_goods_detail` VALUES (42, 22, 10, '1000', 10000, 5);
INSERT INTO `import_goods_detail` VALUES (43, 23, 100, '10000', 1000000, 1);
INSERT INTO `import_goods_detail` VALUES (44, 23, 50, '5000', 250000, 2);
INSERT INTO `import_goods_detail` VALUES (45, 23, 100, '1000', 100000, 4);
INSERT INTO `import_goods_detail` VALUES (46, 23, 10, '1000', 10000, 5);
INSERT INTO `import_goods_detail` VALUES (47, 24, 3, '2', 6, 2);
INSERT INTO `import_goods_detail` VALUES (48, 25, 100, '20000', 2000000, 2);
INSERT INTO `import_goods_detail` VALUES (49, 26, 3, '10000', 30000, 1);
INSERT INTO `import_goods_detail` VALUES (50, 26, 4, '20000', 80000, 3);
INSERT INTO `import_goods_detail` VALUES (51, 27, 1, '10000', 10000, 2);
INSERT INTO `import_goods_detail` VALUES (52, 28, 1, '10000', 10000, 2);
INSERT INTO `import_goods_detail` VALUES (54, 30, 1, '1000', 1000, 1);
INSERT INTO `import_goods_detail` VALUES (55, 31, 1, '1000', 1000, 1);
INSERT INTO `import_goods_detail` VALUES (56, 32, 1, '10000', 10000, 1);
INSERT INTO `import_goods_detail` VALUES (57, 33, 1, '10000', 10000, 1);
INSERT INTO `import_goods_detail` VALUES (58, 34, 3, '100000', 300000, 2);
INSERT INTO `import_goods_detail` VALUES (59, 34, 2, '100000', 200000, 3);

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
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES (6, 'Rau củ', 1, 'Để sản xuất rau sạch đảm bảo vệ sinh an toàn thực phẩm, chúng tôi đảm bảo các nguyên tắc sau: chọn đất, nước tưới, phân bón, giống, bảo vệ thực vật, thu hoạch và bao gói.', NULL, NULL, 0);
INSERT INTO `menu` VALUES (7, 'Trái cây', 1, 'Trái cây tươi và sạch sẽ, đảm bảo an toàn vệ sinh thực phẩm cho Quý Khách Hàng.', NULL, NULL, 0);
INSERT INTO `menu` VALUES (8, 'Thịt cá - hải sản', 1, 'Thủy hản sản đươc nuôi trồng và tiến hành theo quy trình nuôi trồng thủy sản dựa trên tiêu chuẩn vệ sinh nghiêm ngặc và với sự tôn trọng môi sinh.', NULL, NULL, 0);
INSERT INTO `menu` VALUES (9, 'Đồ khô', 1, 'Có đặc tính tiện lợi, dễ chế biến, dễ bảo quản và để được lâu.', NULL, NULL, 0);
INSERT INTO `menu` VALUES (14, 'Menu test', 1, 'menu test', NULL, NULL, 1);
INSERT INTO `menu` VALUES (15, 'Gạo', 1, 'Gạo ngon', NULL, NULL, 1);
INSERT INTO `menu` VALUES (16, 'abv', 1, 'abv', NULL, NULL, 1);
INSERT INTO `menu` VALUES (17, '123', 1, '123', NULL, NULL, 1);
INSERT INTO `menu` VALUES (18, 'Bánh kẹo', 1, 'Bánh kẹo', NULL, NULL, 1);

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
  `discount` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id`(`id` ASC) USING BTREE,
  INDEX `customer_id`(`customer_id` ASC) USING BTREE,
  INDEX `shipping_id`(`shipping_id` ASC) USING BTREE,
  INDEX `payment_id`(`payment_id` ASC) USING BTREE,
  CONSTRAINT `order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `order_ibfk_2` FOREIGN KEY (`shipping_id`) REFERENCES `shipping` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `order_ibfk_3` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 119 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES (74, 0, 77, 77, 'Đang giao hàng', 50000, '2022-05-27 21:00:55', NULL, NULL);
INSERT INTO `order` VALUES (75, 0, 78, 78, 'Đang xử lý', 10000, '2022-05-27 21:02:55', NULL, NULL);
INSERT INTO `order` VALUES (76, 10, 79, 79, 'Đang xử lý', 10000, '2022-06-27 21:05:34', NULL, NULL);
INSERT INTO `order` VALUES (77, 10, 80, 80, 'Đang xử lý', 10000, '2022-06-27 21:05:52', NULL, NULL);
INSERT INTO `order` VALUES (78, 10, 81, 81, 'Đang xử lý', 10000, '2022-06-27 21:08:33', NULL, NULL);
INSERT INTO `order` VALUES (79, 10, 82, 82, 'Đang xử lý', 10000, '2022-06-27 21:09:16', NULL, NULL);
INSERT INTO `order` VALUES (80, 10, 83, 83, 'Đơn hàng bị hủy', 10000, '2022-06-27 21:09:41', NULL, NULL);
INSERT INTO `order` VALUES (81, 10, 84, 84, 'Đang giao hàng', 30000, '2022-06-27 21:12:32', NULL, NULL);
INSERT INTO `order` VALUES (82, 10, 85, 85, 'Đang giao hàng', 60000, '2022-05-27 21:13:17', NULL, NULL);
INSERT INTO `order` VALUES (83, 0, 86, 86, 'Đã nhận hàng', 517500, '2022-06-28 12:49:12', NULL, NULL);
INSERT INTO `order` VALUES (84, 0, 87, 87, 'Đã nhận hàng', 517500, '2022-06-28 12:55:56', NULL, NULL);
INSERT INTO `order` VALUES (85, 0, 88, 88, 'Đã nhận hàng', 517500, '2022-06-28 12:59:25', NULL, NULL);
INSERT INTO `order` VALUES (86, 10, 89, 89, 'Đã nhận hàng', 470000, '2022-06-29 13:23:40', NULL, NULL);
INSERT INTO `order` VALUES (87, 10, 90, 90, 'Đã nhận hàng', 400000, '2022-05-29 13:49:34', NULL, NULL);
INSERT INTO `order` VALUES (88, 12, 91, 91, 'Đang xử lý', 570000, '2022-05-29 14:10:36', NULL, NULL);
INSERT INTO `order` VALUES (89, 10, 92, 92, 'Đang giao hàng', 12000, '2022-05-29 15:04:49', NULL, NULL);
INSERT INTO `order` VALUES (90, 13, 93, 93, 'Đang giao hàng', 10000, '2022-06-29 15:07:06', NULL, NULL);
INSERT INTO `order` VALUES (91, 13, 94, 94, 'Đang giao hàng', 24000, '2022-06-29 15:13:05', NULL, NULL);
INSERT INTO `order` VALUES (92, 13, 95, 95, 'Đơn hàng bị hủy', 30000, '2022-06-29 15:16:08', NULL, NULL);
INSERT INTO `order` VALUES (93, 10, 97, 96, 'Đang xử lý', 36000, '2022-06-29 15:54:15', NULL, NULL);
INSERT INTO `order` VALUES (94, 10, 98, 97, 'Đã nhận hàng', 1139600, '2022-06-30 12:21:26', NULL, NULL);
INSERT INTO `order` VALUES (95, 10, 99, 98, 'Đang giao hàng', 561000, '2022-06-30 12:35:22', NULL, NULL);
INSERT INTO `order` VALUES (96, 0, 100, 99, 'Đang giao hàng', 171800, '2022-06-30 13:26:26', NULL, NULL);
INSERT INTO `order` VALUES (97, 14, 101, 100, 'Đơn hàng bị hủy', 8300, '2022-06-30 13:30:33', NULL, NULL);
INSERT INTO `order` VALUES (98, 14, 102, 101, 'Đang giao hàng', 0, '2022-06-30 13:39:48', NULL, NULL);
INSERT INTO `order` VALUES (99, 14, 103, 102, 'Đang giao hàng', 336000, '2022-06-30 13:49:13', NULL, NULL);
INSERT INTO `order` VALUES (100, 10, 104, 103, 'Đã nhận hàng', 296000, '2022-07-02 10:08:46', NULL, NULL);
INSERT INTO `order` VALUES (101, 10, 105, 104, 'Đã nhận hàng', 113000, '2022-07-02 10:09:16', NULL, NULL);
INSERT INTO `order` VALUES (102, 10, 106, 105, 'Đã nhận hàng', 226000, '2022-07-02 10:15:56', NULL, NULL);
INSERT INTO `order` VALUES (103, 10, 107, 106, 'Đang xử lý', 123000, '2022-07-03 03:18:00', NULL, NULL);
INSERT INTO `order` VALUES (104, 10, 108, 107, 'Đang xử lý', 30000, '2022-07-03 03:32:33', NULL, NULL);
INSERT INTO `order` VALUES (105, 10, 109, 108, 'Đang xử lý', 30000, '2022-07-03 03:37:37', NULL, NULL);
INSERT INTO `order` VALUES (106, 10, 110, 109, 'Đang xử lý', 30000, '2022-07-03 03:37:46', NULL, NULL);
INSERT INTO `order` VALUES (107, 10, 111, 110, 'Đang xử lý', 30000, '2022-07-03 03:46:49', NULL, 100000);
INSERT INTO `order` VALUES (108, 10, 112, 111, 'Đã nhận hàng', 30000, '2022-07-03 03:53:30', NULL, 100000);
INSERT INTO `order` VALUES (109, 10, 113, 112, 'Đã nhận hàng', 30000, '2022-07-03 04:12:11', NULL, 100000);
INSERT INTO `order` VALUES (110, 10, 114, 113, 'Đang xử lý', 30000, '2022-07-03 04:15:24', NULL, 100000);
INSERT INTO `order` VALUES (111, 0, 115, 114, 'Đang xử lý', 888000, '2022-07-03 14:04:14', NULL, NULL);
INSERT INTO `order` VALUES (112, 0, 116, 115, 'Đã nhận hàng', 42000, '2022-07-03 14:12:06', NULL, NULL);
INSERT INTO `order` VALUES (113, 0, 117, 116, 'Đã nhận hàng', 42000, '2022-07-03 14:13:10', NULL, NULL);
INSERT INTO `order` VALUES (114, 10, 118, 117, 'Đang xử lý', 40000, '2022-07-03 14:17:39', NULL, NULL);
INSERT INTO `order` VALUES (115, 15, 119, 118, 'Đơn hàng bị hủy', 231000, '2022-07-03 15:22:32', NULL, NULL);
INSERT INTO `order` VALUES (116, 15, 120, 119, 'Đang xử lý', 48000, '2022-07-03 15:25:26', NULL, 60000);
INSERT INTO `order` VALUES (117, 15, 121, 120, 'Đang xử lý', 438000, '2022-07-03 15:30:30', NULL, NULL);
INSERT INTO `order` VALUES (118, 15, 122, 121, 'Đang giao hàng', 438000, '2022-07-03 15:31:13', NULL, NULL);

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
  `quantity` float NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `product_id`(`product_id` ASC) USING BTREE,
  INDEX `order_id`(`order_id` ASC) USING BTREE,
  CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 152 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of order_detail
-- ----------------------------
INSERT INTO `order_detail` VALUES (93, 21, 74, 25000, 'Cà rốt và su su xào 500g', 2);
INSERT INTO `order_detail` VALUES (94, 22, 75, 10000, 'Khổ qua Đà Lạt 500g', 1);
INSERT INTO `order_detail` VALUES (95, 22, 76, 10000, 'Khổ qua Đà Lạt 500g', 1);
INSERT INTO `order_detail` VALUES (96, 22, 77, 10000, 'Khổ qua Đà Lạt 500g', 1);
INSERT INTO `order_detail` VALUES (97, 22, 78, 10000, 'Khổ qua Đà Lạt 500g', 1);
INSERT INTO `order_detail` VALUES (98, 22, 79, 10000, 'Khổ qua Đà Lạt 500g', 1);
INSERT INTO `order_detail` VALUES (99, 22, 80, 10000, 'Khổ qua Đà Lạt 500g', 1);
INSERT INTO `order_detail` VALUES (100, 22, 81, 10000, 'Khổ qua Đà Lạt 500g', 3);
INSERT INTO `order_detail` VALUES (101, 22, 82, 10000, 'Khổ qua Đà Lạt 500g', 6);
INSERT INTO `order_detail` VALUES (102, 1, 83, 12500, 'Rau muống 500g', 15);
INSERT INTO `order_detail` VALUES (103, 1, 84, 12500, 'Rau muống 500g', 15);
INSERT INTO `order_detail` VALUES (104, 1, 85, 12500, 'Rau muống 500g', 15);
INSERT INTO `order_detail` VALUES (105, 6, 85, 3000, 'Cà chua Mộc Châu 500g', 10);
INSERT INTO `order_detail` VALUES (106, 15, 85, 30000, 'Dưa hấu 1 quả', 10);
INSERT INTO `order_detail` VALUES (107, 1, 86, 12000, 'Rau muống 500g', 10);
INSERT INTO `order_detail` VALUES (108, 19, 86, 15000, 'Chuối Laba 500g', 30);
INSERT INTO `order_detail` VALUES (109, 13, 87, 210000, 'Cá hồi NaUy 500g', 2);
INSERT INTO `order_detail` VALUES (110, 13, 88, 210000, 'Cá hồi NaUy 500g', 3);
INSERT INTO `order_detail` VALUES (111, 1, 89, 12000, 'Rau muống 500g', 1);
INSERT INTO `order_detail` VALUES (112, 22, 90, 10000, 'Khổ qua Đà Lạt 500g', 1);
INSERT INTO `order_detail` VALUES (113, 1, 91, 12000, 'Rau muống 500g', 2);
INSERT INTO `order_detail` VALUES (114, 19, 92, 15000, 'Chuối Laba 500g', 2);
INSERT INTO `order_detail` VALUES (115, 1, 93, 12000, 'Rau muống 500g', 3);
INSERT INTO `order_detail` VALUES (116, 38, 94, 139000, 'Táo Ambrosia nhập khẩu Canada hộp 1kg (4-7 trái)', 8);
INSERT INTO `order_detail` VALUES (117, 35, 94, 6900, 'Rau cải ngồng túi 300g', 4);
INSERT INTO `order_detail` VALUES (118, 55, 95, 105000, 'Cá kèo túi 500g', 5);
INSERT INTO `order_detail` VALUES (119, 1, 95, 12000, 'Rau muống 500g', 3);
INSERT INTO `order_detail` VALUES (120, 35, 96, 6900, 'Rau cải ngồng túi 300g', 2);
INSERT INTO `order_detail` VALUES (121, 39, 96, 79000, 'Bưởi da xanh trái từ 1.7kg trở lên', 2);
INSERT INTO `order_detail` VALUES (122, 35, 97, 6900, 'Rau cải ngồng túi 300g', 7);
INSERT INTO `order_detail` VALUES (123, 35, 98, 6900, 'Rau cải ngồng túi 300g', 1);
INSERT INTO `order_detail` VALUES (124, 1, 99, 12000, 'Rau muống 500g', 3);
INSERT INTO `order_detail` VALUES (125, 15, 99, 30000, 'Dưa hấu 1 quả', 10);
INSERT INTO `order_detail` VALUES (126, 50, 100, 74000, 'Nạc dăm heo túi 500g', 4);
INSERT INTO `order_detail` VALUES (127, 56, 101, 113000, 'Cá tai tượng nguyên con túi 1.2kg - 1.4kg', 1);
INSERT INTO `order_detail` VALUES (128, 56, 102, 113000, 'Cá tai tượng nguyên con túi 1.2kg - 1.4kg', 2);
INSERT INTO `order_detail` VALUES (129, 6, 103, 3000, 'Cà chua Mộc Châu 500g', 1);
INSERT INTO `order_detail` VALUES (130, 7, 103, 30000, 'Ớt Chuông Đà Lạt 500g', 1);
INSERT INTO `order_detail` VALUES (131, 1, 103, 12000, 'Rau muống 500g', 10);
INSERT INTO `order_detail` VALUES (132, 1, 104, 12000, 'Rau muống 500g', 1);
INSERT INTO `order_detail` VALUES (133, 19, 105, 15000, 'Chuối Laba 500g', 2);
INSERT INTO `order_detail` VALUES (134, 19, 106, 15000, 'Chuối Laba 500g', 2);
INSERT INTO `order_detail` VALUES (135, 1, 107, 12000, 'Rau muống 500g', 3);
INSERT INTO `order_detail` VALUES (136, 1, 108, 12000, 'Rau muống 500g', 3);
INSERT INTO `order_detail` VALUES (137, 12, 109, 13000, 'Hành tím Lý Sơn 500g', 1);
INSERT INTO `order_detail` VALUES (138, 46, 110, 9000, 'Trứng gà ác tiềm V.Food Gói 2 trứng', 2);
INSERT INTO `order_detail` VALUES (139, 1, 111, 12000, 'Rau muống 500g', 10);
INSERT INTO `order_detail` VALUES (140, 50, 111, 74000, 'Nạc dăm heo túi 500g', 6);
INSERT INTO `order_detail` VALUES (141, 45, 111, 27000, 'Mề gà túi 500g', 12);
INSERT INTO `order_detail` VALUES (142, 1, 112, 12000, 'Rau muống 500g', 1);
INSERT INTO `order_detail` VALUES (143, 1, 113, 12000, 'Rau muống 500g', 1);
INSERT INTO `order_detail` VALUES (144, 35, 114, 7000, 'Rau cải ngồng túi 300g', 1);
INSERT INTO `order_detail` VALUES (145, 6, 114, 3000, 'Cà chua Mộc Châu 500g', 1);
INSERT INTO `order_detail` VALUES (146, 56, 115, 113000, 'Cá tai tượng nguyên con túi 1.2kg - 1.4kg', 1);
INSERT INTO `order_detail` VALUES (147, 1, 115, 12000, 'Rau muống 500g', 2);
INSERT INTO `order_detail` VALUES (148, 52, 115, 32000, 'Đầu cá hồi khay 500g', 2);
INSERT INTO `order_detail` VALUES (149, 12, 116, 13000, 'Hành tím Lý Sơn 500g', 6);
INSERT INTO `order_detail` VALUES (150, 49, 117, 68000, 'Chân giò heo túi 500g', 6);
INSERT INTO `order_detail` VALUES (151, 49, 118, 68000, 'Chân giò heo túi 500g', 6);

-- ----------------------------
-- Table structure for password_reset
-- ----------------------------
DROP TABLE IF EXISTS `password_reset`;
CREATE TABLE `password_reset`  (
  `id` int NOT NULL,
  `code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `customer_id` bigint NOT NULL,
  `is_active` int NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of password_reset
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 122 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of payment
-- ----------------------------
INSERT INTO `payment` VALUES (76, 'Thanh toán khi nhận hàng', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (77, 'Thanh toán khi nhận hàng', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (78, 'Thanh toán khi nhận hàng', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (79, 'Thanh toán khi nhận hàng', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (80, 'Thanh toán khi nhận hàng', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (81, 'Thanh toán khi nhận hàng', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (82, 'Thanh toán khi nhận hàng', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (83, 'Thanh toán khi nhận hàng', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (84, 'Thanh toán khi nhận hàng', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (85, 'Thanh toán khi nhận hàng', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (86, 'Thanh toán khi nhận hàng', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (87, 'Thanh toán khi nhận hàng', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (88, 'Thanh toán khi nhận hàng', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (89, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (90, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (91, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (92, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (93, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (94, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (95, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (96, 'Thanh toán khi nhận hàng', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (97, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (98, 'Thanh toán khi nhận hàng', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (99, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (100, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (101, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (102, 'Thanh toán khi nhận hàng', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (103, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (104, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (105, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (106, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (107, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (108, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (109, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (110, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (111, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (112, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (113, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (114, 'Thanh toán khi nhận hàng', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (115, 'Thanh toán khi nhận hàng', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (116, 'Thanh toán khi nhận hàng', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (117, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (118, 'Chuyển tiền trực tiếp', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (119, 'Thanh toán khi nhận hàng', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (120, 'Thanh toán khi nhận hàng', 'Đang xử lý', NULL, NULL);
INSERT INTO `payment` VALUES (121, 'Thanh toán khi nhận hàng', 'Đang xử lý', NULL, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 71 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES (1, 'Rau muống', 'Rau muống  là loại rau có thể mọc cả trên cạn và dưới nước, thuộc chia đốt và thuộc loại cây thân bò. Bìm bìm nước là một tên gọi khác của rau muống.\r\n\r\nRau muống là loại rau có giá rất rẻ so với các loại rau khác nhưng lại đem lại lượng khoáng chất và vitamin dồi dào như protein, sắt, canxi, chất xơ, vitamin A... Những chất này là những dưỡng chất cần thiết cho cơ thể.', 6, 12000, '500g', 1, '20190620_071443_522146_rau-muong.max-1800x1800.png', '100% rau muống sạch, an toàn, chất lượng , không chất bảo quản.', 'Quanh năm', 'Theo kí', 'In trên bao bì', 'TP.Hồ Chí Minh', 'Giao hàng trong ngày tại TP.HCM', 0);
INSERT INTO `product` VALUES (2, 'Cherry Canada', 'So với các loại trái cây khác, trái cây Canada có hương vị cực kỳ thơm ngon tự nhiên. Có thể kể đến như dòng cherry Canada được đánh giá cao hơn hẳn so với các dòng cherry Mỹ về độ giòn và độ ngọt.', 7, 175000, '500g', 1, 'trai-cay-nhap-khau-trai-cherry-bbg.jpg', '100% nông sản tươi sạch, không hóa chất độc hại', 'Quanh năm', NULL, 'In trên bao bì', 'TP.Hồ Chí Minh', 'Giao hàng trong ngày tại TP.HCM', 0);
INSERT INTO `product` VALUES (3, 'Quýt đường', 'Quýt là loại trái cây rất tốt cho sức khỏe, ngon - ngọt là trái cây rất yêu thích của nhiều người', 7, 80000, '500g', 1, 'download.jfif', '100% nông sản tươi sạch, không hóa chất độc hại', 'Quanh năm', NULL, 'In trên bao bì', 'Đà Lạt', 'Giao hàng trong ngày tại TP.HCM', 0);
INSERT INTO `product` VALUES (4, 'Dâu tây Đà Lạt', 'Dâu tây Đà Lạt nổi tiếng thơm mát,tươi sạch là đặc sản của vùng cao nguyên này.Giá dâu tây của chúng tôi tốt nhất Thành phố', 7, 197000, '500g', 1, 'dau-tay-da-lat.gif', '100% nông sản tươi sạch, không hóa chất độc hại', 'Quanh năm', NULL, 'In trên bao bì', 'TP.Hồ Chí Minh', 'Giao hàng trong ngày tại TP.HCM', 0);
INSERT INTO `product` VALUES (5, 'Cà rốt to', 'Cà rốt là loại rau củ được các chuyên gia dinh dưỡng khuyên dùng thường xuyên để bổ sung đầy đủ dinh dưỡng. Cà rốt bồi bổ sức khỏe, làm đẹp da và phòng chống các bệnh lí ung thư rất hiệu quả. Nước ép cà rốt giúp tăng sức đề kháng cho cơ thể, phòng chống bệnh cao huyết áp vô cùng tốt.', 6, 8000, '500g', 1, 'images1818372_ca_rot_7222_1486343099.jpg', '100% nông sản tươi sạch, không hóa chất độc hại', 'Quanh năm', NULL, 'In trên bao bì', 'Đà Lạt', 'Giao hàng trong ngày tại TP.HCM', 0);
INSERT INTO `product` VALUES (6, 'Cà chua Mộc Châu', 'Cà chua Mộc Châu - một loại rau an toàn được sử dụng rất phổ biến trong cuộc sống.Nó có tính lưu huyết, giải độc, chống khát nước, thông tiểu tiện và tốt cho hệ tiêu hóa. Không chỉ là thực phẩm ngon tuyệt vời trong các món ăn mà cà chua còn là cứu tinh cho chị em phụ nữ trong việc làm đẹp.Cà chua chứa nhiều vitamin C, E, hàm lượng chất chống oxy hóa cao cùng các dưỡng chất như carotene, kali, chất sắt… rất tốt cho da,giảm oxy hóa.', 6, 3000, '500g', 1, 'img_8796.jpg', '100% nông sản tươi sạch, không hóa chất độc hại', 'Quanh năm', NULL, 'In trên bao bì', 'TP.Hồ Chí Minh', 'Giao hàng trong ngày tại TP.HCM', 0);
INSERT INTO `product` VALUES (7, 'Ớt Chuông Đà Lạt', 'Ớt chuông Đà Lạt được xếp là một trong những loại rau củ chứa nhiều chất xơ mà không có nguy cơ dư thừa lượng calo hấp thụ', 6, 30000, '500g', 1, '171871525816.jpg', '100% nông sản tươi sạch, không hóa chất độc hại', 'Quanh năm', NULL, 'In trên bao bì', 'TP.Hồ Chí Minh', 'Giao hàng trong ngày tại TP.HCM', 0);
INSERT INTO `product` VALUES (8, 'Súp lơ xanh', 'Súp lơ xanh là loại thực phẩm rất tốt cho sức khỏe, tăng cường sức đề kháng cho các thành viên trong gia đình. Súp lơ xanh chứa nhiều vitamin A, C và E hơn bất cứ loại rau quả nào khác', 6, 22000, '500g', 1, '8d27a83c538585fb0c7c4d2a1628d5d2.jpg', '100% nông sản tươi sạch, không hóa chất độc hại', 'Quanh năm', NULL, 'In trên bao bì', 'TP.Hồ Chí Minh', 'Giao hàng trong ngày tại TP.HCM', 0);
INSERT INTO `product` VALUES (9, 'Táo fuji', 'Táo Fuji tươi, dòn, vị ngọt có cảm giác như đang thưởng thức một cốc nước ép táo vô cùng sảng khoái.', 7, 13000, '500g', 1, 'táo-fuji-mỹ.jpg', '100% nông sản tươi sạch, không hóa chất độc hại', 'Quanh năm', NULL, 'In trên bao bì', 'miền Tây', 'Giao hàng trong ngày tại TP.HCM', 0);
INSERT INTO `product` VALUES (10, 'Tỏi Lý sơn', 'Là dạng dễ dùng nhất, có thể ăn sống hoặc dầm vào nước chấm. Khi nhấm tỏi sống, các vi khuẩn có trong khoang miệng sẽ bị tiêu diệt. Mỗi ngày nên ăn 2 tép tỏi sống là đủ, ăn nhiều quá cũng không có lợi cho dạ dày và chất axilin có trong tỏi có thể gây chứng tan máu.', 6, 15000, '500g', 1, 'toi-ly-son-1.jpg', '100% nông sản tươi sạch, không hóa chất độc hại', 'Quanh năm', NULL, 'In trên bao bì', 'miền Tây', 'Giao hàng trong ngày tại TP.HCM', 0);
INSERT INTO `product` VALUES (11, 'Ớt chỉ thiên', 'Là gia vị không thể thiếu trong mỗi bữa cơm gia đình', 6, 12000, '500g', 1, 'ot-chi-thien-tapdoanvinasa-02.jpg', '100% nông sản tươi sạch, không hóa chất độc hại', 'Quanh năm', NULL, 'In trên bao bì', 'miền Tây', 'Giao hàng trong ngày tại TP.HCM', 0);
INSERT INTO `product` VALUES (12, 'Hành tím Lý Sơn', 'Hành tím Lý Sơn đã trở thành đặc sản của vùng biển đảo Lý Sơn  – Quảng Ngãi. Đây là vùng đất được hình thành do quá trình hoạt động núi lửa và sự bồi đắp của cát biển, đá san hô biển tạo nên, với sự đặc biệt về thổ nhưỡng và kinh nghiệm truyền thống bao đời từ khi khai sinh vùng đất đảo, đã làm cho hành Lý Sơn có hương vị riêng và đặc biệt. Hành tím của lý sơn có màu tím đặc trưng và đặc biệt có vị thơm.', 6, 13000, '500g', 1, 'hanh-tim-1.jpg', '100% nông sản tươi sạch, không hóa chất độc hại', 'Quanh năm', NULL, 'In trên bao bì', 'miền Tây', 'Giao hàng trong ngày tại TP.HCM', 0);
INSERT INTO `product` VALUES (13, 'Cá hồi NaUy', 'Cá hồi NaUy được biết đến như một loại thực phẩm lành mạnh giàu protein,axit béo,omega -3 và vitamin D.Ăn thịt cá hồi mang lại nhiều lợi ích cho sức khỏe như: chống các dấu hiệu lão hóa, giảm mức cholesterol và huyết áp, kéo giảm nguy cơ bị đột quỵ, giúp giảm đau và cứng khớp gây ra bởi viêm khớp', 8, 210000, '500g', 1, 'images.jfif', '100% nông sản tươi sạch, không hóa chất độc hại', 'Quanh năm', NULL, 'In trên bao bì', 'Đà Lạt', 'Giao hàng trong ngày tại TP.HCM', 0);
INSERT INTO `product` VALUES (14, 'Cá bò khô Bá Kiến', 'Cá bò khô là món ngon được rất nhiều người yêu thích bởi hương vị đặc trưng, cái dai dai, mặn mà, thêm chút ngọt thơm hòa quyện trong từng thớ thịt. Đối với cánh mày râu, đây còn là mồi nhấm cùng rượu hoặc bia tươi vô cùng lý tưởng. Cuộc vui bên bạn bè hay những người thân yêu sẽ hoàn hảo hơn rất nhiều nếu bạn tìm được địa chỉ mua cá bò khô uy tín và chất lượng', 9, 125000, '500g', 1, 'IMG_7849-1-768x512.jpg', '100% nông sản tươi sạch, không hóa chất độc hại', 'Quanh năm', NULL, 'In trên bao bì', 'Nhập khẩu từ Nhật bản', 'Giao hàng trong ngày tại TP.HCM', 0);
INSERT INTO `product` VALUES (15, 'Dưa hấu', 'Mùa hè đến là thời điểm lý tưởng để thưởng thức những trái dưa hấu đỏ ngọt, tươi mát. Dưa hấu không chỉ là một loại hoa quả hấp dẫn, nó còn có những tác dụng tích cực cho sức khỏe rất có thể bạn chưa biết hết. Quả dưa hấu có tên khoa học là Citrullus lanatus, vị ngọt mát, nhiều nước (hơn 90% trọng lượng dưa hấu là nước), đồng thời dưa hấu còn giúp cung cấp nhiều vitamin, các nguyên tố vi lượng cho cơ thể.\r\n\r\nDưa hấu chứa ít calo (46 Kcal mỗi cốc), chứa hàm lượng vitamin C và vitamin A cao (dưa hấu cung cấp 17% lượng vitamin A + 20% lượng vitamin C cần thiết mà cơ thể bạn cân/ ngày). Dưa hấu cũng rất giàu chất xơ và kali.', 7, 30000, '1 quả', 1, 'duahau.jfif', 'Dưa hấu đỏ ngọt tươi mát', 'Quanh năm', 'Một quả', 'Thời hạn bảo quản 1 tuần trong tủ lạnh', 'miền Tây', 'Giao hàng toàn quốc', 0);
INSERT INTO `product` VALUES (16, 'Đậu xanh hạt', 'Đậu xanh là một loại đậu dùng để chế biến rất nhiều món ngon cũng như cung cấp nhiều dưỡng chất tốt cho cơ thể. Thương hiệu VietFresh cung cấp cho chúng ta sản phẩm đậu xanh hạt cao cấp tươi mới.', 9, 50000, 'gói 150g', 1, 'dau-xanh-hat-cao-cap-vietfresh-150g-202012092307410559.jpg', 'Đậu xanh hạt 100%', 'Hàng năm', 'Nơi khô thoáng, trong túi kín gió và tránh ánh nắng trực tiếp', '30 ngày', 'Giao ngẫu nhiên Naita hoặc Fresh', 'Giao hàng tận nơi', 0);
INSERT INTO `product` VALUES (17, 'Việt quất', 'Việt quất (hay còn gọi là Blueberry) là một loại trái cây nhập khẩu không còn quá xa lạ đối với người tiêu dùng Việt Nam. Đây không chỉ là loại trái cây có màu sắc bắt mắt mà còn chứa nhiều chất dinh dưỡng cùng công dụng tốt cho sức khoẻ. \r\nViệt quất thì quả khá tròn trịa, vỏ mỏng và trơn mịn. Đường kính trung bình dao động tầm 2 – 3 cm, một đầu có cuống và một đầu có phần đài quả. Quả thường có màu xanh sẫm gần như màu mực, một vài giống thì sẽ có màu đen hoặc đỏ. Việt quất mang vị ngọt thơm, khi mới ăn có thể thấy hơi chát nhưng sau quen rồi lại thấy rất hấp dẫn.', 7, 745000, '500g', 1, 'viet-quat-hop-125g-202101141115286393.jpg', '84% nước, 14% Cacbohydrat cùng nhiều khoáng chất thiết yếu khác như: Carotene, Anthocyanin, vitamin (A, C, K), Kali, Natri, Canxi, Magie, Photpho, Sắt,...', 'Hàng năm', 'Gói 125gram', '30 ngày', 'Trái cây nhập khẩu từ Nhật Bản', 'Giao hàng tận nơi', 0);
INSERT INTO `product` VALUES (18, 'Táo mini', 'Táo được biết đến như một loại trái cây có lợi cho sắc đẹp và có tác dụng giảm cân, ngăn ngừa bệnh tim mạch. Với lượng dưỡng chất dồi dào, vị giòn ngọt, thanh mát, trái nhỏ. Táo Gala mini nhập khẩu New Zealand là trái cây nhập khẩu chất lượng an toàn, vừa tiết kiệm về giá, lại vừa vặn cho một lần ăn mà không gây ngán, không phải dự trữ lại.', 7, 22000, '500g', 1, 'táo-mini.jpg', 'Táo mini', 'Hàng năm', 'Hộp 1kg', '1 tháng', 'Trái cây nhập khẩu từ Nhật Bản', 'Giao hàng tận nơi', 0);
INSERT INTO `product` VALUES (19, 'Chuối Laba', 'Chuối Laba (hay còn gọi là chuối Tiến Vua) là một trong những loại trái cây đặc sản Đà Lạt. Thoạt nhìn, chuối Laba có hình dáng tương tự với giống chuối già Nam Mỹ, tuy nhiên về chất lượng và hương vị thì hoàn toàn khác nhau. \r\nChuối Laba có quả thon dài, hơi cong, cuống to ngắn, buồng nhỏ, trái úp úp vào buồng như mảnh trăng lưỡi liềm, khoảng cách giữa các cuống dày và khít vào nhau. Thịt chuối Laba có màu vàng sánh, dẻo, vị ngọt đậm thơm ngon và có hương thơm đặc trưng. Ngoài ra, chuối Laba có hàm lượng đường cao hơn các loại chuối khác.', 7, 15000, '500g', 1, 'chuoi-laba-tui-1kg-202101271611376661.jpg', 'Chuối chứa nhiều chất dinh dưỡng như kali, chất xơ, vitamin,...', 'Hàng năm', 'Hộp 1kg', '30 ngày', 'Đà Lạt', 'Giao hàng tận nơi', 0);
INSERT INTO `product` VALUES (20, 'Bưởi năm roi', 'Bưởi năm roi là một trong những đặc sản nổi tiếng của Việt Nam. Loại bưởi này không chỉ ngon, ngọt mà còn mang lại cho con người nhiều công dụng tốt cho sức khoẻ như cung cấp nguồn vitamin dồi dào. Bưởi năm roi tại Bách hoá XANH thích hợp cho những ngày nắng nóng với nhiều cách chế biến khác nhau.', 7, 15000, '1 quả', 1, 'buoi-nam-roi-tui-1kg-202112251732267497.jpg', 'Bưởi năm roi', 'Hàng năm', 'Hộp 1kg', '30 ngày', 'miền Tây Nam Bộ', 'Giao hàng tận nơi', 0);
INSERT INTO `product` VALUES (21, 'Cà rốt và su su xào', 'Sản phẩm cà rốt và su su được làm sạch và sơ chế cắt sợi sẵn dễ dàng, thuận tiện cho bạn chế biến, tiết kiệm được nhiều thời gian nấu nướng. Cà rốt và su su xào khay 300g bao bì sạch sẽ, vệ sinh, cung cấp chất xơ và vitamin cần thiết cho cơ thể.', 6, 25000, '500g', 1, 'ca-rot-va-su-su-xao-khay-300g-202201040747484286.jpg', 'Su su, cà rốt, cần tàu, hành lá, ớt', 'Hàng năm', 'Khay 300gram', '1 tháng', 'Trường An', 'Giao hàng tận nơi', 0);
INSERT INTO `product` VALUES (22, 'Khổ qua Đà Lạt', 'Khổ qua Đà Lạt', 6, 10000, '500g', 1, 'KHOQUADALAT-1.jpg', '100% nông sản tươi sạch, không hóa chất độc hại', 'Quanh năm', NULL, 'In trên bao bì', 'Đà Lạt', 'Giao hàng trong ngày tại TP.HCM', 0);
INSERT INTO `product` VALUES (31, 'Thăn bò Úc tươi Trung Đồng hút chân không', 'Thăn bò Úc tươi hút chân không khay 250g có một lớp mỡ mỏng bao phủ bên ngoài phần nạc giúp cho phần thịt bò khi chế biến không bị khô. Bạn có thể mua thịt thăn bò úc về áp chảo với bơ, đảm bảo món ăn mềm mọng nước, cả nhà ai cũng thích', 8, 129000, 'khay 250g', 1, 'than-bo-uc-tuoi-hut-chan-khong-khay-250g-202112251848440848.jpg', 'Thịt thăn bò tươi ngon, thịt dai, chất lượng, mềm và ngọt.', NULL, NULL, NULL, 'thương hiệu thịt bò Trung Đồng', 'Đặt giao hàng nhanh', 0);
INSERT INTO `product` VALUES (32, 'Thịt đùi heo', 'Thịt đùi heo là phần thịt lóc ra từ phần đùi của con heo, phần thịt này có lớp bì, mỡ và thịt được phân tách rõ ràng, phần thịt nạc rất dày, không còn các phần gân, xương hay sụn. Là thực phẩm có chứa nhiều protein, lipit và các khoáng chất cần thiết cho cơ thể. Ngoài ra, trong thịt đùi còn cung cấp một lượng axit amin cần thiết giúp tái tạo cơ bắp và tăng cường hệ miễn dịch.', 8, 83000, 'Túi 500g', 1, 'thit-dui-heo-tui-500g-202012310003187490.jpg', 'Thịt  đảm bảo về chất lượng, độ tươi và ngon của thực phẩm, xuất xứ rõ ràng.', NULL, NULL, NULL, NULL, 'Giao hàng trong ngày tại TP.HCM', 0);
INSERT INTO `product` VALUES (33, 'Cải bẹ dún', 'Cải bẹ dún là loài thực vật họ cải, còn được gọi là cải dún, cải nhún, cải bẹ nhúng. Loại rau này chứa nhiều thành phần dinh dưỡng có lợi cho sức khỏe như vitamin C và nhiều nguyên tố vi lượng, có tác dụng làm mát gan, thanh lọc, giải nhiệt cơ thể, giảm cân, ngừa giảm trí nhớ...', 6, 15000, '400g', 1, 'cai-be-dun-tui-500g-202009292340408221.jpg', 'Cải bẹ dún của Nông Sản Việt được nuôi trồng và đóng gói theo những tiêu chuẩn nghiêm ngặt, bảo đảm các tiêu chuẩn xanh - sach, chất lượng và an toàn với người dùng.', 'Quanh năm', NULL, NULL, 'Cần Thơ', 'Giao hàng trong ngày tại TP.HCM', 0);
INSERT INTO `product` VALUES (34, 'Rong biển Hàn Quốc Miwon', 'Ngày nay, rong biển được xem một trong những nguồn thực phẩm sạch, mang đến nhiều công dụng tuyệt vời cho sức khỏe con người. Các loại rong biển đến từ thương hiệu Miwon là những sản phẩm được nhiều người tiêu dùng quan tâm và yêu thích, cụ thể là sản phẩm rong biển  Miwon.', 9, 20000, '20g', 1, 'rong-bien-cat-san-miwon-goi-20g-2-org.jpg', 'Rong biển tốt cho sức khỏe', NULL, NULL, '1 năm', 'Hàn Quốc', 'Giao hàng trong ngày tại TP.HCM', 0);
INSERT INTO `product` VALUES (35, 'Rau cải ngồng', 'Rau cải ngồng là một loại rau thường xuyên xuất hiện trong nhiều bữa ăn của các gia đình vì công dụng bổ dưỡng của nó. Cải ngồng rất giàu chất xơ và chứa nhiều loại vitamin A, B1, B2, B3, B5, B6, C, K,...giúp cơ thể và làn da của bạn luôn được tươi tắn, rạng rỡ, trắng sáng và tràn đầy sức sống, giúp gia tăng nhu động ruột, kích thích hệ bài tiết và hỗ trợ gan hoạt động mạnh mẽ hơn. ', 6, 7000, 'túi 300g', 1, 'cai-ngong-tui-300g-202012282228079486.jpg', '', 'Quanh năm', NULL, '', 'TP.Hồ Chí Minh', 'Giao hàng toàn quốc - Giao hàng trong ngày tại TP.Hồ Chí Minh', 0);
INSERT INTO `product` VALUES (36, 'Quả thơm mật', 'Thơm mật (hay dứa mật) là một trong những loại trái cây rất được yêu thích trong những ngày hè. Khác với trái thơm thường, thơm mật có quả hình trụ tròn, mắt nở nang, hốc mắt nông, lá không có gai. Khi bắt đầu chín có màu xanh lá mạ, khi chín 100% có màu vàng sáng, vỏ bóng láng. Khi cắt ra có 1 vòng màu vàng đậm, trong quả nhìn giống như bị dập tuy nhiên đây chính là phần ngọt nhất và tạo nên tên tuổi cho loại trái này.', 7, 7000, 'khay 200g (1-2 miếng)', 1, 'thom-mat-nguyen-vo-khay-200g-202102040916064155.jpg', 'Dứa tươi chứa nhiều chất  nước, giàu axit hữu cơ, canxi, photpho, sắt, và các loại vitamin khác như vitamin C, vitamin B1, vitamin B2,... ', 'Quanh năm', NULL, '', 'TP.Hồ Chí Minh', 'Giao hàng toàn quốc - Giao hàng trong ngày tại TP.Hồ Chí Minh', 0);
INSERT INTO `product` VALUES (37, 'Táo Ninh Thuận', 'Táo Ninh Thuận là trái cây có hình dáng khá tròn, nhỏ, giòn và có vị ngọt thanh. Táo chỉ cần rửa sạch, chấm với muối ớt hoặc muối tôm ăn bắt vị vô cùng. Bên cạnh đó táo Ninh Thuận còn rất nhiều lợi ích cho sức khỏe như đẹp da, tốt cho trí não, hệ tiêu hóa và hệ miễn dịch nên rất được ưa chuộng.', 7, 37000, 'túi 1kg (25 - 30 trái)', 1, 'tao-ninh-thuan-tui-1kg-25-30-trai-202205111931276191.jpg', 'Táo được đảm bảo nguồn gốc xuất xứ rõ ràng, túi 1kg từ 25 -30 quả.', 'Quanh năm', NULL, '', 'Ninh Thuận', 'Giao hàng toàn quốc - Giao hàng trong ngày tại TP.Hồ Chí Minh', 0);
INSERT INTO `product` VALUES (38, 'Táo Ambrosia nhập khẩu Canada', 'Táo Ambrosia là trái cây nhập khẩu Mỹ không hề có vị chua mà chỉ có vị ngọt thanh nhẹ nhàng cùng với phần thịt táo giòn, không xốp bột cùng với hương thơm đặc trưng đầy quyến rũ. Khi ăn, loại quả này sẽ kích thích vị giác và tốt cho sức khỏe người dùng.', 7, 139000, 'hộp 1kg (4-7 trái)', 1, 'tao-ambrosia-nhap-khau-tui-1kg-4-7-trai-202203130430203237.jpg', 'Táo được đảm bảo nguồn gốc xuất xứ rõ ràng, túi 1kg từ 4-7 quả.', 'Quanh năm', NULL, '', 'Canada', 'Giao hàng toàn quốc - Giao hàng trong ngày tại TP.Hồ Chí Minh', 0);
INSERT INTO `product` VALUES (39, 'Bưởi da xanh', 'Bưởi da xanh là một trong những trái cây đặc sản nổi tiếng của Việt Nam. Loại bưởi da xanh này không chỉ ngon, ngọt mà còn mang lại cho con người nhiều công dụng tốt cho sức khoẻ như cung cấp nguồn vitamin dồi dào. Bưởi da xanh thích hợp cho những ngày nắng nóng với nhiều cách chế biến.', 7, 79000, 'trái từ 1.7kg trở lên', 1, 'buoi-da-xanh-trai-tu-17kg-tro-len-202205111921599930.jpg', 'Bưởi da xanh được đảm bảo nguồn gốc xuất xứ rõ ràng, an tâm cho khách hàng chọn lựa. Khối lượng một trái từ 1,7kg trở lên.', 'Quanh năm', NULL, '', 'Miền Tây', 'Giao hàng toàn quốc - Giao hàng trong ngày tại TP.Hồ Chí Minh', 0);
INSERT INTO `product` VALUES (40, 'Nho đỏ', 'Với phần thịt dày mọng nước, vị ngọt xen lẫn chua nhẹ hài hoà, nho đỏ có hạt là loại trái cây được nhiều người yêu thích vào những ngày hè.', 7, 75000, 'hộp 500g', 1, 'nho-do-co-hat-hop-500g-202205272107172880.jpg', '', 'Quanh năm', NULL, '', 'Đà Lạt', 'Giao hàng toàn quốc - Giao hàng trong ngày tại TP.Hồ Chí Minh', 0);
INSERT INTO `product` VALUES (41, 'Trứng gà Happy Egg', 'Trứng gà của Happy Egg được đóng gói và bảo quản theo những tiêu chuẩn nghiêm ngặt về vệ sinh và an toàn thực phẩm, đảm bảo về chất lượng của thực phẩm.', 8, 34000, 'hộp 10 tặng 2 trứng', 1, 'hop-10-tang-2-trung-ga-tuoi-happy-egg-202202091045091724.jpg', '', 'Quanh năm', NULL, '', 'Thương hiệu Happy Egg', 'Giao hàng toàn quốc - Giao hàng trong ngày tại TP.Hồ Chí Minh', 0);
INSERT INTO `product` VALUES (42, 'Đùi tỏi gà', 'Đùi tỏi gà nhập khẩu đông lạnh với phương pháp cấp đông hiện đại, giúp lưu giữ hương vị tự nhiên, mang đến những món ăn ngon cho gia đình.', 8, 34000, 'túi 500g', 1, 'dui-toi-ga-nhap-khau-dong-lanh-khay-500g-4-6-cai-202203111046030691.jpeg', 'Đùi tỏi gà nhập khẩu từ Mỹ được đóng gói và bảo quản theo những tiêu chuẩn nghiêm ngặt về vệ sinh và an toàn thực phẩm, đảm bảo về chất lượng', '', NULL, '', 'Nhập khẩu từ Mỹ', 'Giao hàng toàn quốc - Giao hàng trong ngày tại TP.Hồ Chí Minh', 0);
INSERT INTO `product` VALUES (43, 'Ức gà có xương', 'Ức gà có xương được đóng gói và bảo quản theo những tiêu chuẩn nghiêm ngặt về vệ sinh và an toàn thực phẩm, đảm bảo về chất lượng, độ tươi và ngon của thực phẩm, xuất xứ rõ ràng', 8, 30000, 'túi 500g', 1, 'uc-ga-co-xuong-tui-1kg-202012302332534378.jpg', 'Thịt ức gà mềm, săn chắc, ngọt', '', NULL, '', 'Việt Nam', 'Giao hàng toàn quốc - Giao hàng trong ngày tại TP.Hồ Chí Minh', 0);
INSERT INTO `product` VALUES (44, 'Đùi gà', 'Đùi gà được đóng gói và bảo quản theo những tiêu chuẩn nghiêm ngặt về vệ sinh và an toàn thực phẩm, đảm bảo về chất lượng, độ tươi và ngon của thực phẩm, xuất xứ rõ ràng', 8, 24000, 'túi 500g', 1, 'dui-ga-goc-tu-nhap-khau-khay-500g-2-4-dui-202203111040119797.jpeg', 'Đùi gà mềm, săn chắc, ngọt', '', NULL, '', 'Việt Nam', 'Giao hàng toàn quốc - Giao hàng trong ngày tại TP.Hồ Chí Minh', 0);
INSERT INTO `product` VALUES (45, 'Mề gà', 'Mề gà được đóng gói và bảo quản theo những tiêu chuẩn nghiêm ngặt về vệ sinh và an toàn thực phẩm, đảm bảo về chất lượng, độ tươi và ngon của thực phẩm, xuất xứ rõ ràng', 8, 27000, 'túi 500g', 1, 'me-ga-nhap-khau-khay-300g-8-10-cai-202203111038583766.jpeg', 'Mề gà mềm, săn chắc, ngọt', '', NULL, '', 'Nhập khẩu từ Mỹ', 'Giao hàng toàn quốc - Giao hàng trong ngày tại TP.Hồ Chí Minh', 0);
INSERT INTO `product` VALUES (46, 'Trứng gà ác tiềm V.Food', 'Gói 2 trứng gà ác tiềm của V.Food được đóng gói và bảo quản theo những tiêu chuẩn nghiêm ngặt về vệ sinh và an toàn thực phẩm, đảm bảo về chất lượng của thực phẩm, xuất xứ rõ ràng.', 8, 9000, 'Gói 2 trứng', 1, 'goi-2-trung-ga-ac-tiem-vfood-202009181229293341.jpg', 'Trứng gà ác to tròn, đều.', '', NULL, '', 'Thương hiệu V.Food', 'Giao hàng toàn quốc - Giao hàng trong ngày tại TP.Hồ Chí Minh', 0);
INSERT INTO `product` VALUES (47, 'Ba rọi heo', 'Ba rọi heo được đóng gói và bảo quản theo những tiêu chuẩn nghiêm ngặt về vệ sinh và an toàn thực phẩm, đảm bảo về chất lượng, độ tươi và ngon của thực phẩm, xuất xứ rõ ràng', 8, 100000, 'túi 500g', 1, 'ba-roi-heo-tui-500g-202012302356060735.jpg', 'Tỉ lệ nạc mỡ tuyệt với, thịt săn chắc ngọt', '', NULL, '', 'Việt Nam', 'Giao hàng toàn quốc - Giao hàng trong ngày tại TP.Hồ Chí Minh', 0);
INSERT INTO `product` VALUES (48, 'Thịt đùi heo', 'Thịt đùi heo được đóng gói và bảo quản theo những tiêu chuẩn nghiêm ngặt về vệ sinh và an toàn thực phẩm, đảm bảo về chất lượng, độ tươi và ngon của thực phẩm, xuất xứ rõ ràng', 8, 83000, 'túi 500g', 1, 'thit-dui-heo-tui-500g-202012310003187490.jpg', 'Thịt săn chắc, ít mỡ', '', NULL, '', 'Việt Nam', 'Giao hàng toàn quốc - Giao hàng trong ngày tại TP.Hồ Chí Minh', 0);
INSERT INTO `product` VALUES (49, 'Chân giò heo', 'Chân giò heo được đóng gói và bảo quản theo những tiêu chuẩn nghiêm ngặt về vệ sinh và an toàn thực phẩm, đảm bảo về chất lượng, độ tươi và ngon của thực phẩm, xuất xứ rõ ràng', 8, 68000, 'túi 500g', 1, 'chan-gio-heo-tui-1kg-202012302247564830.jpg', 'Thịt chân giò săn chắc, có độ béo của gân và mỡ.', '', NULL, '', 'Việt Nam', 'Giao hàng toàn quốc - Giao hàng trong ngày tại TP.Hồ Chí Minh', 0);
INSERT INTO `product` VALUES (50, 'Nạc dăm heo', 'Nạc dăm heo được đóng gói và bảo quản theo những tiêu chuẩn nghiêm ngặt về vệ sinh và an toàn thực phẩm, đảm bảo về chất lượng, độ tươi và ngon của thực phẩm, xuất xứ rõ ràng.', 8, 74000, 'túi 500g', 1, 'nac-dam-heo-tui-500g-202110131440524685.jpeg', 'Bao gồm khối thịt nạc mềm, có các lớp mỡ mỏng và không đều nhau xen kẽ vào bên trong miếng thịt nhưng không tách thành lớp mỡ và lợp thịt nạc rõ ràng.', '', NULL, '', 'Việt Nam', 'Giao hàng toàn quốc - Giao hàng trong ngày tại TP.Hồ Chí Minh', 0);
INSERT INTO `product` VALUES (51, 'Mực ghim hấp', 'Mực ghim hấp hoàn toàn an toàn cho sức khoẻ, giúp các bà nội trợ có thể chế biến nhanh chóng thành các món ăn khác.', 8, 70000, 'khay 300g', 1, 'muc-gim-hap-khay-300g-202203121826248184.jpg', 'Mực đã được hấp chín.', '', NULL, '', 'Việt Nam', 'Giao hàng toàn quốc - Giao hàng trong ngày tại TP.Hồ Chí Minh', 0);
INSERT INTO `product` VALUES (52, 'Đầu cá hồi', 'Đầu cá hồi tươi đông lạnh có thể kéo dài thời gian bảo quản, thích hợp cho nhu cầu gia đình trong việc chế biến và mang đến những món ăn bổ dưỡng.', 8, 32000, 'khay 500g', 1, 'dau-ca-hoi-khay-500g-300g-500g-cai-202206140858201667.jpg', 'Chứa Omega-3 giàu EPA và DHA, protein cùng nhiều dưỡng chất thiết yếu khác như vitamin B, kali và selen,...', '', NULL, '', 'Việt Nam', 'Giao hàng toàn quốc - Giao hàng trong ngày tại TP.Hồ Chí Minh', 0);
INSERT INTO `product` VALUES (53, 'Đầu cá hồi', 'Đầu cá hồi tươi đông lạnh có thể kéo dài thời gian bảo quản, thích hợp cho nhu cầu gia đình trong việc chế biến và mang đến những món ăn bổ dưỡng.', 8, 32000, 'khay 500g', 1, 'dau-ca-hoi-khay-500g-300g-500g-cai-202206140858201667.jpg', 'Chứa Omega-3 giàu EPA và DHA, protein cùng nhiều dưỡng chất thiết yếu khác như vitamin B, kali và selen,...', '', NULL, '', 'Việt Nam', 'Giao hàng toàn quốc - Giao hàng trong ngày tại TP.Hồ Chí Minh', 0);
INSERT INTO `product` VALUES (54, 'Cá hồi cắt khúc', 'Cá hồi tươi đông lạnh có thể kéo dài thời gian bảo quản, thích hợp cho nhu cầu gia đình trong việc chế biến và mang đến những món ăn bổ dưỡng.', 8, 99000, 'túi 300g', 1, 'ca-hoi-cat-khuc-tui-300g-202203231029261430.jpg', 'Chứa Omega-3 giàu EPA và DHA, protein cùng nhiều dưỡng chất thiết yếu khác như vitamin B, kali và selen,...', '', NULL, '', 'Việt Nam', 'Giao hàng toàn quốc - Giao hàng trong ngày tại TP.Hồ Chí Minh', 0);
INSERT INTO `product` VALUES (55, 'Cá kèo', 'Cá kèo đông lạnh có thể kéo dài thời gian bảo quản, thích hợp cho nhu cầu gia đình trong việc chế biến và mang đến những món ăn bổ dưỡng.', 8, 105000, 'túi 500g', 1, 'ca-keo-tui-500g-18-25-con-202203231102294589.jpg', 'Ít béo, giàu protein, đảm bảo là nguyên liệu tuyệt vời cho bữa cơm của bạn', '', NULL, '', 'Việt Nam', 'Giao hàng toàn quốc - Giao hàng trong ngày tại TP.Hồ Chí Minh', 0);
INSERT INTO `product` VALUES (56, 'Cá tai tượng nguyên con', 'Cá tai tượng đông lạnh có thể kéo dài thời gian bảo quản, thích hợp cho nhu cầu gia đình trong việc chế biến và mang đến những món ăn bổ dưỡng.', 8, 113000, 'túi 1.2kg - 1.4kg', 1, 'ca-tai-tuong-nguyen-con-tui-12kg-202203152329355683.jpg', '', '', NULL, '', 'Việt Nam', 'Giao hàng toàn quốc - Giao hàng trong ngày tại TP.Hồ Chí Minh', 0);
INSERT INTO `product` VALUES (57, 'Lạp xưởng tôm Vissan', 'Lạp xưởng được chế biến an toàn, sạch sẽ mang đến sản phẩm thơm ngon, màu sắc đẹp mắt. Lạp xưởng bò Vissan 200g từ thịt bò, có thể chiên, nướng, hấp, ăn trực tiếp hoặc ăn kèm cơm, xôi, củ kiệu,...', 9, 70000, 'gói 200g', 1, 'lap-xuong-tom-vissan-goi-200g-202011170928206781.jpg', 'Thịt tôm, thịt heo, đường, muối, rượu, ruột khô', '', NULL, '', 'Việt Nam', 'Giao hàng toàn quốc - Giao hàng trong ngày tại TP.Hồ Chí Minh', 0);
INSERT INTO `product` VALUES (58, 'Lạp xưởng bò Vissan', 'Lạp xưởng được chế biến an toàn, sạch sẽ mang đến sản phẩm thơm ngon, màu sắc đẹp mắt. Lạp xưởng bò Vissan 200g từ thịt bò, có thể chiên, nướng, hấp, ăn trực tiếp hoặc ăn kèm cơm, xôi, củ kiệu,...', 9, 65000, 'gói 200g', 1, 'lap-xuong-bo-vissan-goi-200g-202011170926056208.jpg', 'Nạc bò Úc (31%), mỡ heo, nạc heo, ruột collagen, đường, muối, rượu,...', '', NULL, '', 'Việt Nam', 'Giao hàng toàn quốc - Giao hàng trong ngày tại TP.Hồ Chí Minh', 0);
INSERT INTO `product` VALUES (59, 'Xúc xích heo dinh dưỡng Vissan', 'Lạp xưởng được chế biến an toàn, sạch sẽ mang đến sản phẩm thơm ngon, màu sắc đẹp mắt. Lạp xưởng bò Vissan 200g từ thịt bò, có thể chiên, nướng, hấp, ăn trực tiếp hoặc ăn kèm cơm, xôi, củ kiệu,...', 9, 23000, 'gói 175g', 1, 'xuc-xich-dinh-duong-heo-vissan-goi-175g-2-org.jpg', 'Nạc heo, thịt gà, nước, protein đậu nành, protein sữa, chất ổn định, protein từ lúa mì, muối iot, chất làm ẩm, chất điều vị, đường,...', '', NULL, '', 'Việt Nam', 'Giao hàng toàn quốc - Giao hàng trong ngày tại TP.Hồ Chí Minh', 0);
INSERT INTO `product` VALUES (60, 'Gạo thơm A An ST21', 'Gạo thơm A An ST21 túi 5kg được thu hoạch từ giống lúa ST21 tự nhiên. Gạo A An được sản xuất trên dây chuyền hiện đại, cam kết không đấu trộn, không chất tạo mùi, mang lại sản phẩm gạo chất lượng, an toàn cho sức khoẻ người dùng', 9, 88000, 'túi 5kg', 1, 'gao-thom-a-an-st21-tui-5kg-202006061602569575.jpg', 'Giống lúa ST21', '', NULL, '', 'Việt Nam', 'Giao hàng toàn quốc - Giao hàng trong ngày tại TP.Hồ Chí Minh', 0);
INSERT INTO `product` VALUES (61, 'Gạo Nhật Japonica A An', 'Gạo giống Nhật Bản A An giống Nhật túi 5kg dẻo nhiều, cơm nhiều tạo cảm giác ngon miệng khi ăn.', 9, 88000, 'túi 5kg', 1, 'gao-nhat-japonica-a-an-tui-5kg-202111051553389653.jpg', 'loại gạo mềm thơm được trồng theo công nghệ hiện đại, tiên tiến không sử dụng chất kích thích tăng trưởng của A An', '', NULL, '', 'Nhật Bản', 'Giao hàng toàn quốc - Giao hàng trong ngày tại TP.Hồ Chí Minh', 0);
INSERT INTO `product` VALUES (62, 'Gạo thơm A An ST24', 'Gạo thơm A An ST24 túi 5kg được thu hoạch từ giống lúa ST24 tự nhiên. Gạo A An được sản xuất trên dây chuyền hiện đại, cam kết không đấu trộn, không chất tạo mùi, mang lại sản phẩm gạo chất lượng, an toàn cho sức khoẻ người dùng', 9, 144000, 'túi 5kg', 1, 'gao-thom-ngon-st24-tui-5kg-202101261415591064.jpg', 'Giống lúa ST24', '', NULL, '', 'Việt Nam', 'Giao hàng toàn quốc - Giao hàng trong ngày tại TP.Hồ Chí Minh', 0);
INSERT INTO `product` VALUES (63, 'Gạo thơm A An ST25', 'Gạo thơm A An ST25 túi 5kg được thu hoạch từ giống lúa ST25 tự nhiên. Gạo A An được sản xuất trên dây chuyền hiện đại, cam kết không đấu trộn, không chất tạo mùi, mang lại sản phẩm gạo chất lượng, an toàn cho sức khoẻ người dùng', 9, 144000, 'túi 5kg', 1, 'gao-thom-dac-san-neptune-st25-tui-5kg-202204181118516951_300x300.jpg', 'Giống lúa ST25', '', NULL, '', 'Việt Nam', 'Giao hàng toàn quốc - Giao hàng trong ngày tại TP.Hồ Chí Minh', 0);
INSERT INTO `product` VALUES (64, 'Gạo Lạc Việt hương lúa', 'Gạo Lạc Việt là hãng gạo uy tính, nổi tiếng tại thị trường gạo của Việt Nam, được rất nhiều khách hàng tin dùng chọn lựa bởi hương vị thơm ngon, dẻo mềm khó cưỡng.', 9, 99000, 'túi 5kg', 1, 'gao-lac-viet-huong-lua-tui-5kg-202205211714228400.jpg', '', '', NULL, '', 'Việt Nam', 'Giao hàng toàn quốc - Giao hàng trong ngày tại TP.Hồ Chí Minh', 0);
INSERT INTO `product` VALUES (65, 'Gạo Lạc Việt dẻo thơm ST5', 'Gạo Lạc Việt là hãng gạo uy tính, nổi tiếng tại thị trường gạo của Việt Nam, được rất nhiều khách hàng tin dùng chọn lựa bởi hương vị thơm ngon, dẻo mềm khó cưỡng.', 9, 110000, 'túi 5kg', 1, 'gao-lac-viet-deo-thom-st5-tui-5kg-202205211705549771.jpg', '', '', NULL, '', 'Việt Nam', 'Giao hàng toàn quốc - Giao hàng trong ngày tại TP.Hồ Chí Minh', 0);
INSERT INTO `product` VALUES (66, 'Củ khoai tây', 'hoai tây trồng tại Trung Quốc đã quá quen thuộc với mỗi chúng ta. Loại củ này được xuất hiện thường xuyên trên mâm cơm này có rất nhiều công dụng hữu ích', 6, 12000, 'túi 500g', 1, 'khoai-tay-tui-500g-3-7-cu-202205260854534847.jpg', 'Trong khoai tây chứa nhiều tinh bột, chất xơ, protein, đường, các vitamin C, vitamin K,...', 'Quanh năm', NULL, NULL, 'Trung Quốc', 'Giao hàng trong ngày tại TP.HCM', 0);
INSERT INTO `product` VALUES (67, 'Lá kim cuộn cơm', 'Lá kim cuộn cơm là dạng dát mỏng của rong biển và nó hoàn toàn chứa đầy đủ các thành phần cũng như chất dinh dưỡng từ rong biển.', 6, 25000, 'Gói', 1, 'la-kim-cuon-com-ofood-goi-10g-202007080910338920.jpg', 'Rong biển Hàn Quốc (100%)', NULL, NULL, NULL, 'Thương hiệu O\'food (Hàn Quốc)', 'Giao hàng trong ngày tại TP.HCM', 0);
INSERT INTO `product` VALUES (68, 'Rau cải', 'Rau cải tốt cho sức khỏe', 6, 10000, '1', 1, 'cai-be-dun-tui-500g-202009292340408221.jpg', NULL, NULL, NULL, NULL, 'Việt Nam', NULL, 1);
INSERT INTO `product` VALUES (69, '12', '123', 6, 123, NULL, 1, 'WIN_20220424_13_30_15_Pro.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO `product` VALUES (70, 'abc', 'abc', 6, -333, NULL, 1, 'WIN_20220424_13_30_15_Pro.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 1);

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
) ENGINE = InnoDB AUTO_INCREMENT = 38 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of rotate
-- ----------------------------
INSERT INTO `rotate` VALUES (32, 12, 40, '2022-06-29');
INSERT INTO `rotate` VALUES (33, 10, 41, '2022-06-29');
INSERT INTO `rotate` VALUES (34, 10, 42, '2022-06-29');
INSERT INTO `rotate` VALUES (35, 10, 43, '2022-06-30');
INSERT INTO `rotate` VALUES (36, 14, 44, '2022-06-30');
INSERT INTO `rotate` VALUES (37, 15, 46, '2022-07-03');

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
) ENGINE = InnoDB AUTO_INCREMENT = 123 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of shipping
-- ----------------------------
INSERT INTO `shipping` VALUES (76, '2022-06-27 20:57:16', NULL, 'Hoàng Trường', '22/14 Phan Văn Hớn, TP.Hồ Chí Minh', '012345678', 'hoangtruong1808@gmail.com', NULL);
INSERT INTO `shipping` VALUES (77, '2022-06-27 21:00:55', NULL, 'Hoàng Trường', '22/14 Phan Văn Hớn, TP.Hồ Chí Minh', '012345678', 'hoangtruong1808@gmail.com', NULL);
INSERT INTO `shipping` VALUES (78, '2022-06-27 21:02:55', NULL, 'Hoàng Trường', '22/14 Phan Văn Hớn, TP.Hồ Chí Minh', '012345678', 'hoangtruong1808@gmail.com', NULL);
INSERT INTO `shipping` VALUES (79, '2022-06-27 21:05:34', NULL, 'Hoàng Trường', '22/14 Phan Văn Hớn, TP.Hồ Chí Minh', '012345678', 'hoangtruong1808@gmail.com', NULL);
INSERT INTO `shipping` VALUES (80, '2022-06-27 21:05:52', NULL, 'Hoàng Trường', '22/14 Phan Văn Hớn, TP.Hồ Chí Minh', '012345678', 'hoangtruong1808@gmail.com', NULL);
INSERT INTO `shipping` VALUES (81, '2022-06-27 21:08:33', NULL, 'Hoàng Trường', '22/14 Phan Văn Hớn, TP.Hồ Chí Minh', '012345678', 'hoangtruong1808@gmail.com', NULL);
INSERT INTO `shipping` VALUES (82, '2022-06-27 21:09:16', NULL, 'Hoàng Trường', '22/14 Phan Văn Hớn, TP.Hồ Chí Minh', '012345678', 'hoangtruong1808@gmail.com', NULL);
INSERT INTO `shipping` VALUES (83, '2022-06-27 21:09:41', NULL, 'Hoàng Trường', '22/14 Phan Văn Hớn, TP.Hồ Chí Minh', '012345678', 'hoangtruong1808@gmail.com', NULL);
INSERT INTO `shipping` VALUES (84, '2022-06-27 21:12:32', NULL, 'Hoàng Trường', '22/14 Phan Văn Hớn, TP.Hồ Chí Minh', '012345678', 'hoangtruong1808@gmail.com', NULL);
INSERT INTO `shipping` VALUES (85, '2022-06-27 21:13:17', NULL, 'Hoàng Trường', '22/14 Phan Văn Hớn, TP.Hồ Chí Minh', '012345678', 'hoangtruong1808@gmail.com', NULL);
INSERT INTO `shipping` VALUES (86, '2022-06-28 12:49:12', NULL, 'Hoàng Trường', '22/14 Phan Văn Hớn, TP.Hồ Chí Minh', '0704804311', 'hoangtruong1808@gmail.com', NULL);
INSERT INTO `shipping` VALUES (87, '2022-06-28 12:55:56', NULL, 'Hoàng Trường', '22/14 Phan Văn Hớn, TP.Hồ Chí Minh', '012345678', 'hoangtruong.test@outlook.com', NULL);
INSERT INTO `shipping` VALUES (88, '2022-06-28 12:59:25', NULL, 'Hoàng Trường', '22/14 Phan Văn Hớn, TP.Hồ Chí Minh', '012345678', 'hoangtruong.test@outlook.com', NULL);
INSERT INTO `shipping` VALUES (89, '2022-06-29 13:23:40', NULL, 'Hoàng Trường', '25B Tô Vĩnh Diện, TP.Pleiku, Gia Lai', '0704804311', 'hoangtruong.test@outlook.com', NULL);
INSERT INTO `shipping` VALUES (90, '2022-06-29 13:49:34', NULL, 'Hoàng Trường', '25B Tô Vĩnh Diện, TP.Pleiku, Gia Lai', '0704804311', 'hoangtruong.test@outlook.com', NULL);
INSERT INTO `shipping` VALUES (91, '2022-06-29 14:10:36', NULL, 'Đỗ Gia Tuấn', 'Pleiku, Gia Lai', '012345678', 'giatuando@gmail.com', NULL);
INSERT INTO `shipping` VALUES (92, '2022-06-29 15:04:49', NULL, 'Hoàng Trường', '25B Tô Vĩnh Diện, TP.Pleiku, Gia Lai', '0704804311', 'hoangtruong.test@outlook.com', NULL);
INSERT INTO `shipping` VALUES (93, '2022-06-29 15:07:06', NULL, 'Trường test', '25B Tô Vĩnh Diện, TP.Pleiku, Gia Lai', '0123456789', 'n-truong@plott.co.jp', NULL);
INSERT INTO `shipping` VALUES (94, '2022-06-29 15:13:05', NULL, 'Trường test', '25B Tô Vĩnh Diện, TP.Pleiku, Gia Lai', '0123456789', 'n-truong@plott.co.jp', NULL);
INSERT INTO `shipping` VALUES (95, '2022-06-29 15:16:08', NULL, 'Trường test', '25B Tô Vĩnh Diện, TP.Pleiku, Gia Lai', '0123456789', 'n-truong@plott.co.jp', NULL);
INSERT INTO `shipping` VALUES (96, '2022-06-29 15:53:01', NULL, 'Hoàng Trường', '22/14 Phan Văn Hớn, TP.Hồ Chí Minh', '012345678', 'hoangtruong.test@outlook.com', NULL);
INSERT INTO `shipping` VALUES (97, '2022-06-29 15:54:15', NULL, 'Hoàng Trường', '22/14 Phan Văn Hớn, TP.Hồ Chí Minh', '012345678', 'hoangtruong.test@outlook.com', NULL);
INSERT INTO `shipping` VALUES (98, '2022-06-30 12:21:26', NULL, 'Hoàng Trường', '22.14 Phan Văn Hớn', '0704804311', 'hoangtruong.test@outlook1.com', NULL);
INSERT INTO `shipping` VALUES (99, '2022-06-30 12:35:22', NULL, 'Hoàng Trường', '25B Tô Vĩnh Diện', '0704804311', 'hoangtruong.test@outlook.com', NULL);
INSERT INTO `shipping` VALUES (100, '2022-06-30 13:26:26', NULL, 'Nguyễn Thị Hoàng Thư', '22.14 Phan Văn Hớn', '0388783394', 'admin@gmail.com', NULL);
INSERT INTO `shipping` VALUES (101, '2022-06-30 13:30:33', NULL, 'Hoàng Trường', '22.14 Phan Văn Hớn', '07048043111', 'hoangtruong.tes1t@outlook.com', NULL);
INSERT INTO `shipping` VALUES (102, '2022-06-30 13:39:48', NULL, 'Nguyễn Hoàng Trường', '22.14 Phan Văn Hớn', '07048043111', 'hoangtruong.tes1t@outlook.com', NULL);
INSERT INTO `shipping` VALUES (103, '2022-06-30 13:49:13', NULL, 'Hoàng Trường', '22/14 Phan Văn Hớn, TP.Hồ Chí Minh', '012345678', 'hoangtruong1808@gmail.com', NULL);
INSERT INTO `shipping` VALUES (104, '2022-07-02 10:08:46', NULL, 'Hoàng Trường', '60/32 Quốc Lộ 13, Quận Bình Thạnh', '0704804311', 'hoangtruong.test@outlook.com', NULL);
INSERT INTO `shipping` VALUES (105, '2022-07-02 10:09:16', NULL, 'Hoàng Trường', '25B Tô Vĩnh Diện, TP.Pleiku, Gia Lai', '0704804311', 'hoangtruong.test@outlook.com', NULL);
INSERT INTO `shipping` VALUES (106, '2022-07-02 10:15:56', NULL, 'Hoàng Trường', '25B Tô Vĩnh Diện, TP.Pleiku, Gia Lai', '0704804311', 'hoangtruong.test@outlook.com', NULL);
INSERT INTO `shipping` VALUES (107, '2022-07-03 03:18:00', NULL, 'Hoàng Trường', '25B Tô Vĩnh Diện, TP.Pleiku, Gia Lai', '0704804311', 'hoangtruong.test@outlook.com', NULL);
INSERT INTO `shipping` VALUES (108, '2022-07-03 03:32:33', NULL, 'Hoàng Trường', '25B Tô Vĩnh Diện, TP.Pleiku, Gia Lai', '0704804311', 'hoangtruong.test@outlook.com', NULL);
INSERT INTO `shipping` VALUES (109, '2022-07-03 03:37:37', NULL, 'Hoàng Trường', '25B Tô Vĩnh Diện, TP.Pleiku, Gia Lai', '0704804311', 'hoangtruong.test@outlook.com', NULL);
INSERT INTO `shipping` VALUES (110, '2022-07-03 03:37:46', NULL, 'Hoàng Trường', '25B Tô Vĩnh Diện, TP.Pleiku, Gia Lai', '0704804311', 'hoangtruong.test@outlook.com', NULL);
INSERT INTO `shipping` VALUES (111, '2022-07-03 03:46:48', NULL, 'Hoàng Trường', '25B Tô Vĩnh Diện, TP.Pleiku, Gia Lai', '0704804311', 'hoangtruong.test@outlook.com', NULL);
INSERT INTO `shipping` VALUES (112, '2022-07-03 03:53:30', NULL, 'Hoàng Trường', '25B Tô Vĩnh Diện, TP.Pleiku, Gia Lai', '0704804311', 'hoangtruong.test@outlook.com', NULL);
INSERT INTO `shipping` VALUES (113, '2022-07-03 04:12:11', NULL, 'Hoàng Trường', '25B Tô Vĩnh Diện, TP.Pleiku, Gia Lai', '0704804311', 'hoangtruong.test@outlook.com', NULL);
INSERT INTO `shipping` VALUES (114, '2022-07-03 04:15:24', NULL, 'Hoàng Trường', '25B Tô Vĩnh Diện, TP.Pleiku, Gia Lai', '0704804311', 'hoangtruong.test@outlook.com', NULL);
INSERT INTO `shipping` VALUES (115, '2022-07-03 14:04:14', NULL, 'Hoàng Trường', '22/14 Phan Văn Hớn, TP.Hồ Chí Minh', '012345678', 'hoangtruong1808@gmail.com', NULL);
INSERT INTO `shipping` VALUES (116, '2022-07-03 14:12:06', NULL, 'Hoàng Trường', '22/14 Phan Văn Hớn, TP.Hồ Chí Minh', '012345678', 'hoangtruong.test@outlook.com', NULL);
INSERT INTO `shipping` VALUES (117, '2022-07-03 14:13:10', NULL, 'Hoàng Trường', '22/14 Phan Văn Hớn, TP.Hồ Chí Minh', '012345678', 'hoangtruong1808@gmail.com', NULL);
INSERT INTO `shipping` VALUES (118, '2022-07-03 14:17:39', NULL, 'Hoàng Trường', '25B Tô Vĩnh Diện, TP.Pleiku, Gia Lai', '0704804311', 'hoangtruong.test@outlook.com', NULL);
INSERT INTO `shipping` VALUES (119, '2022-07-03 15:22:32', NULL, 'Nguyễn Thị Hoàng Thư', '22.14 Phan Văn Hớn', '0388783394', 'hoangtruong1808@gmail.com', NULL);
INSERT INTO `shipping` VALUES (120, '2022-07-03 15:25:26', NULL, 'Nguyễn Thị Hoàng Thư', '22.14 Phan Văn Hớn', '0388783394', 'hoangtruong1808@gmail.com', NULL);
INSERT INTO `shipping` VALUES (121, '2022-07-03 15:30:30', NULL, 'Hoàng Trường', '22/14 Phan Văn Hớn, TP.Hồ Chí Minh', '012345678', 'hoangtruong.test@outlook.com', NULL);
INSERT INTO `shipping` VALUES (122, '2022-07-03 15:31:13', NULL, 'Hoàng Trường', '22/14 Phan Văn Hớn, TP.Hồ Chí Minh', '012345678', 'hoangtruong.test@outlook.com', NULL);

-- ----------------------------
-- Table structure for staff
-- ----------------------------
DROP TABLE IF EXISTS `staff`;
CREATE TABLE `staff`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `is_deleted` int NOT NULL DEFAULT 0,
  `role` int NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id`(`id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of staff
-- ----------------------------
INSERT INTO `staff` VALUES (1, 'admin1', '01234567891', 'admin_address1', 'admin@gmail.com', '$2y$10$p/0f63LLUPQnHCNavvNYn.tCY1qdFsU/gjD9slWAj6E3D.V3XtY1W', NULL, NULL, 'test.jpg', 0, 2);
INSERT INTO `staff` VALUES (6, 'Hoàng Trường', '0704804311', 'Linh Xuân, Thủ Đức', 'hoangtruong1808@gmail.com', '$2y$10$p/0f63LLUPQnHCNavvNYn.tCY1qdFsU/gjD9slWAj6E3D.V3XtY1W', NULL, NULL, 'default-avatar.png', 0, 1);
INSERT INTO `staff` VALUES (7, 'An Thái', '01234566789', 'Hà Nội', 'anthai@gmail.com', '$2y$10$4WD9QWfsbgOubusXNjpiv.w.8kBD7/jrTT2NDk1H8t4dCt.zt8gJm', NULL, NULL, 'default-avatar.png', 0, 1);
INSERT INTO `staff` VALUES (8, 'Nguyễn Thị Hoàng Thư', '0388783394', '25B Tô Vĩnh Diện, TP.Pleiku, Gia Lai', 'hoangtruong1808@gmail.com', '$2y$10$/8SV3/SVBuKi6jxyk2oHKu8OmzX130UCo7RnJl1QYYG6H/KkOIeRC', NULL, NULL, 'la-kim-cuon-com-ofood-goi-10g-202007080910338920.jpg', 0, 1);

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
  `name` varchar(255) CHARACTER SET utf32 COLLATE utf32_vietnamese_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf32 COLLATE utf32_vietnamese_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `mail` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `is_deleted` int UNSIGNED NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of supplier
-- ----------------------------
INSERT INTO `supplier` VALUES (4, 'Nhà cung cấp Nông Trại Việt', 'Bình Phước, Việt Nam', '01245678', 'nongtraiviet@gmail.com', 0);
INSERT INTO `supplier` VALUES (5, 'Nhà cung cấp Vissan', 'Hồ Chí Minh', '012345678', 'vissan@gmail.com', 0);
INSERT INTO `supplier` VALUES (6, 'Hoàng Trường 1', '22.14 Phan Văn Hớn', '0388783394', 'hoangthu188@gmail.com', 1);
INSERT INTO `supplier` VALUES (7, '12', '123@gmailc.com', '3123', '123@gmailc.com', 1);

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
) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of use_voucher
-- ----------------------------
INSERT INTO `use_voucher` VALUES (29, 10, 109, 45, NULL);
INSERT INTO `use_voucher` VALUES (30, 10, 110, 39, NULL);
INSERT INTO `use_voucher` VALUES (31, 15, 116, 46, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 48 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of voucher
-- ----------------------------
INSERT INTO `voucher` VALUES (39, 'umLzMGqs', 100000, 'VNĐ', 500000, 1500000, 9, NULL, '2022-06-29T19:46', '2022-07-22T19:46', 'Mã giảm giá thành lập cửa hàng', NULL, 1, 0, '2022-07-03', 1, NULL);
INSERT INTO `voucher` VALUES (40, 'gLNaI3RQ', 60000, 'VNĐ', NULL, NULL, 0, NULL, NULL, NULL, 'Mã khuyến mãi từ vòng quay may mắn', NULL, 1, 0, '2022-06-29', 2, 12);
INSERT INTO `voucher` VALUES (41, 'FXP67ZUs', 20000, 'VNĐ', NULL, NULL, 0, NULL, NULL, NULL, 'Mã khuyến mãi từ vòng quay may mắn', NULL, 1, 0, '2022-06-29', 2, 10);
INSERT INTO `voucher` VALUES (42, 'yjYgHwvQ', 50000, 'VNĐ', NULL, NULL, 0, NULL, NULL, NULL, 'Mã khuyến mãi từ vòng quay may mắn', NULL, 1, 0, '2022-06-29', 2, 10);
INSERT INTO `voucher` VALUES (43, 'FGCLnMuA', 60000, 'VNĐ', NULL, NULL, 0, NULL, NULL, NULL, 'Mã khuyến mãi từ vòng quay may mắn', NULL, 1, 0, '2022-06-30', 2, 10);
INSERT INTO `voucher` VALUES (44, 'yC7ffbot', 40000, 'VNĐ', NULL, NULL, 0, NULL, NULL, NULL, 'Mã khuyến mãi từ vòng quay may mắn', NULL, 1, 0, '2022-06-30', 2, 14);
INSERT INTO `voucher` VALUES (45, 'hU3v7aKB', 100000, 'VNĐ', 500000, 1000000, 30, NULL, '2022-06-29T21:00', '2022-07-22T21:00', 'Kỉ niệm thành lập cửa hàng', NULL, 1, 0, '2022-07-03', 1, NULL);
INSERT INTO `voucher` VALUES (46, 'Lay0rdwd', 60000, 'VNĐ', NULL, NULL, 0, NULL, NULL, NULL, 'Mã khuyến mãi từ vòng quay may mắn', NULL, 1, 0, '2022-07-03', 2, 15);
INSERT INTO `voucher` VALUES (47, 'P5xrDVka', 100000, 'VNĐ', 500000, 1500000, 7, NULL, '2022-07-12T22:40', '2022-07-29T22:41', 'Quốc tế Lao Động', NULL, 3, 0, '2022-07-03', 1, NULL);

-- ----------------------------
-- Table structure for warehouse
-- ----------------------------
DROP TABLE IF EXISTS `warehouse`;
CREATE TABLE `warehouse`  (
  `warehouse_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint UNSIGNED NOT NULL,
  `inventory_quantity` int NULL DEFAULT 0,
  `delivery_quantity` int NULL DEFAULT 0,
  `wait_delivery_quantity` int NULL DEFAULT 0,
  `sold_quantity` int NULL DEFAULT 0,
  `cancel_quantity` int NULL DEFAULT 0,
  PRIMARY KEY (`warehouse_id`) USING BTREE,
  INDEX `product_id`(`product_id` ASC) USING BTREE,
  CONSTRAINT `warehouse_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 78 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of warehouse
-- ----------------------------
INSERT INTO `warehouse` VALUES (1, 5, 22, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (2, 6, 5, 0, 2, 0, 0);
INSERT INTO `warehouse` VALUES (4, 7, 3, 0, 1, 0, 0);
INSERT INTO `warehouse` VALUES (5, 8, 0, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (6, 9, 0, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (7, 10, 0, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (8, 11, 0, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (9, 12, 93, 0, 6, 1, 0);
INSERT INTO `warehouse` VALUES (10, 13, 95, 0, 0, 5, 0);
INSERT INTO `warehouse` VALUES (11, 14, 0, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (12, 15, 90, 10, 0, 0, 0);
INSERT INTO `warehouse` VALUES (13, 16, 100, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (14, 17, 100, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (15, 18, 0, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (16, 19, 68, 2, -66, 30, 0);
INSERT INTO `warehouse` VALUES (17, 20, 0, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (18, 21, 0, 2, 15, 0, 0);
INSERT INTO `warehouse` VALUES (19, 22, 0, 11, 15, 0, 0);
INSERT INTO `warehouse` VALUES (25, 1, 152, 21, 32, 30, 0);
INSERT INTO `warehouse` VALUES (26, 2, 208, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (27, 3, 6, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (28, 4, 200, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (32, 31, 0, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (33, 32, 0, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (34, 33, 0, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (35, 34, 0, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (36, 35, 85, 3, 8, 4, 0);
INSERT INTO `warehouse` VALUES (37, 36, 100, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (38, 37, 100, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (39, 38, 92, 0, 0, 8, 0);
INSERT INTO `warehouse` VALUES (40, 39, 98, 0, 2, 0, 0);
INSERT INTO `warehouse` VALUES (41, 40, 100, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (42, 41, 100, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (43, 42, 100, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (44, 43, 100, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (45, 44, 100, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (46, 45, 88, 0, 12, 0, 0);
INSERT INTO `warehouse` VALUES (47, 46, 98, 0, 2, 0, 0);
INSERT INTO `warehouse` VALUES (48, 47, 100, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (49, 48, 100, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (50, 49, 88, 6, 6, 0, 0);
INSERT INTO `warehouse` VALUES (51, 50, 90, 0, 10, 0, 0);
INSERT INTO `warehouse` VALUES (52, 51, 100, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (53, 52, 98, 0, 2, 0, 0);
INSERT INTO `warehouse` VALUES (54, 53, 100, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (55, 54, 100, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (56, 55, 95, 5, 0, 0, 0);
INSERT INTO `warehouse` VALUES (57, 56, 96, 0, 2, 2, 0);
INSERT INTO `warehouse` VALUES (58, 57, 100, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (59, 58, 100, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (60, 59, 100, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (61, 60, 100, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (62, 66, 0, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (63, 67, 0, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (64, 68, 3, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (65, 62, 0, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (66, 61, 0, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (67, 63, 0, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (68, 64, 0, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (69, 65, 0, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (76, 69, 0, 0, 0, 0, 0);
INSERT INTO `warehouse` VALUES (77, 70, 0, 0, 0, 0, 0);

SET FOREIGN_KEY_CHECKS = 1;

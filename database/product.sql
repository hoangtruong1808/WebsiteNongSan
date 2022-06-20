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

 Date: 20/06/2022 20:35:42
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

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
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = COMPACT;

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
INSERT INTO `product` VALUES (29, 'Test', 'Test', 7, 100000, 'combo', 0, 'WIN_20220424_13_30_35_Pro.jpg', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', NULL);
INSERT INTO `product` VALUES (30, 'Khổ qua Đà Lạt', 'Khổ qua Đà Lạt', 6, 20000, 'kg', 1, 'KHOQUADALAT-1.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 0);

SET FOREIGN_KEY_CHECKS = 1;

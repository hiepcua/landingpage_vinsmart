/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100138
 Source Host           : localhost:3306
 Source Schema         : db_vinsmart

 Target Server Type    : MySQL
 Target Server Version : 100138
 File Encoding         : 65001

 Date: 05/08/2022 22:28:27
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_configsite
-- ----------------------------
DROP TABLE IF EXISTS `tbl_configsite`;
CREATE TABLE `tbl_configsite`  (
  `config_id` int NOT NULL AUTO_INCREMENT,
  `tem_id` int NULL DEFAULT NULL,
  `company_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `intro` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `tel` varchar(120) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fax` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `notification` int NULL DEFAULT NULL,
  `work_time` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `website` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `banner` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `logo` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `meta_keyword` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `meta_descript` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `lang_id` int NOT NULL DEFAULT 0,
  `contact` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `footer` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nick_yahoo` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name_yahoo` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `skype1` varchar(70) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `skype2` varchar(70) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `twitter` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gplus` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `facebook` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `youtube` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email_notification` int NULL DEFAULT NULL,
  `sms_notification` int NULL DEFAULT NULL,
  `gg_analytic` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `script_header` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `script_footer` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  PRIMARY KEY (`config_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_configsite
-- ----------------------------
INSERT INTO `tbl_configsite` VALUES (1, 0, '', 'VIASM - Viện nghiên cứu cao cấp về toán', '', 'Số 8, Tăng Bạt Hổ, Hoàn Kiếm, Hà Nội', '096.954.9903', '096.954.9903', '', 'tranviethiepdz@gmail.com', 2, '8:00 - 17:30, Thứ Hai - Chủ Nhật', '', '', 'http://localhost/viasm.edu/images/1536805301441_500_8gn.jpg', '', 'VIASM - Viện nghiên cứu cao cấp về toán', 'VIASM - Viện nghiên cứu cao cấp về toán', 0, '', '', '', '', '', '', 'https://twitter.com/', 'https://plus.google.com/?hl=vi', 'https://www.facebook.com/', 'https://www.youtube.com/', NULL, NULL, '&lt;!-- Global site tag (gtag.js) - Google Analytics --&gt;\r\n&lt;script async src=&quot;https://www.googletagmanager.com/gtag/js?id=UA-154018274-1&quot;&gt;&lt;/script&gt;\r\n&lt;script&gt;\r\n  window.dataLayer = window.dataLayer || [];\r\n  function gtag(){dataLayer.push(arguments);}\r\n  gtag(\'js\', new Date());\r\n\r\n  gtag(\'config\', \'UA-154018274-1\');\r\n&lt;/script&gt;', '&lt;!-- Global site tag (gtag.js) - Google Analytics --&gt;\r\n&lt;script async src=&quot;https://www.googletagmanager.com/gtag/js?id=UA-154018274-1&quot;&gt;&lt;/script&gt;\r\n&lt;script&gt;\r\n  window.dataLayer = window.dataLayer || [];\r\n  function gtag(){dataLayer.push(arguments);}\r\n  gtag(\'js\', new Date());\r\n\r\n  gtag(\'config\', \'UA-154018274-1\');\r\n&lt;/script&gt;', '&lt;!-- Global site tag (gtag.js) - Google Analytics --&gt;\r\n&lt;script async src=&quot;https://www.googletagmanager.com/gtag/js?id=UA-154018274-1&quot;&gt;&lt;/script&gt;\r\n&lt;script&gt;\r\n  window.dataLayer = window.dataLayer || [];\r\n  function gtag(){dataLayer.push(arguments);}\r\n  gtag(\'js\', new Date());\r\n\r\n  gtag(\'config\', \'UA-154018274-1\');\r\n&lt;/script&gt;');

-- ----------------------------
-- Table structure for tbl_registration
-- ----------------------------
DROP TABLE IF EXISTS `tbl_registration`;
CREATE TABLE `tbl_registration`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `loai_canho` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `cdate` int NULL DEFAULT NULL,
  `order` int NULL DEFAULT NULL,
  `isactive` tinyint NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_registration
-- ----------------------------
INSERT INTO `tbl_registration` VALUES (10, '0969549903', 'tranviethiep69@gmail.com', '[\"CH1\",\"CH2\"]', 1617298047, NULL, 1);
INSERT INTO `tbl_registration` VALUES (11, '0969549901', 'tranviethiep94@gmail.com', '[\"CH1\"]', 1617298082, NULL, 1);
INSERT INTO `tbl_registration` VALUES (12, '0969549999', 'abc@gmail.com', '[\"CH6\",\"CH7\",\"CH8\"]', 1617303530, NULL, 1);
INSERT INTO `tbl_registration` VALUES (13, '0969549999', 'abc@gmail.com', '[\"CH6\",\"CH7\",\"CH8\"]', 1617303581, NULL, 1);

-- ----------------------------
-- Table structure for tbl_user_login
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user_login`;
CREATE TABLE `tbl_user_login`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `session` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `cdate` int NULL DEFAULT NULL,
  `isactive` tinyint NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx`(`isactive`, `username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 45 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_user_login
-- ----------------------------
INSERT INTO `tbl_user_login` VALUES (1, 'tranviethiepdz@gmail.com', '1608062914', 1608062914, 0);
INSERT INTO `tbl_user_login` VALUES (2, 'tranviethiepdz@gmail.com', '1608084139', 1608084139, 0);
INSERT INTO `tbl_user_login` VALUES (3, 'admin', '1608084327', 1608084327, 0);
INSERT INTO `tbl_user_login` VALUES (4, 'tranviethiepdz@gmail.com', '1608087393', 1608087393, 0);
INSERT INTO `tbl_user_login` VALUES (5, 'admin', '1608087973', 1608087973, 0);
INSERT INTO `tbl_user_login` VALUES (6, 'admin', '1608104013', 1608104013, 0);
INSERT INTO `tbl_user_login` VALUES (7, 'tranviethiepdz@gmail.com', '1608104576', 1608104576, 0);
INSERT INTO `tbl_user_login` VALUES (8, 'tranviethiepdz@gmail.com', '1608109637', 1608109637, 0);
INSERT INTO `tbl_user_login` VALUES (9, 'tranviethiepdz@gmail.com', '1609226448', 1609226448, 0);
INSERT INTO `tbl_user_login` VALUES (10, 'tranviethiepdz@gmail.com', '1609258262', 1609258262, 0);
INSERT INTO `tbl_user_login` VALUES (11, 'tranviethiepdz@gmail.com', '1609268818', 1609268818, 0);
INSERT INTO `tbl_user_login` VALUES (12, 'tranviethiepdz@gmail.com', '1609303853', 1609303853, 0);
INSERT INTO `tbl_user_login` VALUES (13, 'tranviethiepdz@gmail.com', '1609320341', 1609320341, 0);
INSERT INTO `tbl_user_login` VALUES (14, 'tranviethiepdz@gmail.com', '1609336797', 1609336797, 0);
INSERT INTO `tbl_user_login` VALUES (15, 'tranviethiepdz@gmail.com', '1609401396', 1609401396, 0);
INSERT INTO `tbl_user_login` VALUES (16, 'tranviethiepdz@gmail.com', '1609569917', 1609569917, 0);
INSERT INTO `tbl_user_login` VALUES (17, 'tranviethiepdz@gmail.com', '1609597080', 1609597080, 0);
INSERT INTO `tbl_user_login` VALUES (18, 'tranviethiepdz@gmail.com', '1609600986', 1609600986, 0);
INSERT INTO `tbl_user_login` VALUES (19, 'tranviethiepdz@gmail.com', '1609661817', 1609661817, 0);
INSERT INTO `tbl_user_login` VALUES (20, 'tranviethiepdz@gmail.com', '1609680844', 1609680844, 0);
INSERT INTO `tbl_user_login` VALUES (21, 'tranviethiepdz@gmail.com', '1609750425', 1609750425, 0);
INSERT INTO `tbl_user_login` VALUES (22, 'tranviethiepdz@gmail.com', '1609775164', 1609775164, 0);
INSERT INTO `tbl_user_login` VALUES (23, 'tranviethiepdz@gmail.com', '1611854454', 1611854454, 0);
INSERT INTO `tbl_user_login` VALUES (24, 'tranviethiepdz@gmail.com', '1612285752', 1612285752, 0);
INSERT INTO `tbl_user_login` VALUES (25, 'tranviethiepdz@gmail.com', '1612346465', 1612346465, 0);
INSERT INTO `tbl_user_login` VALUES (26, 'tranviethiepdz@gmail.com', '1612353132', 1612353132, 0);
INSERT INTO `tbl_user_login` VALUES (27, 'tranviethiepdz@gmail.com', '1612415201', 1612415201, 0);
INSERT INTO `tbl_user_login` VALUES (28, 'tranviethiepdz@gmail.com', '1612455674', 1612455674, 0);
INSERT INTO `tbl_user_login` VALUES (29, 'tranviethiepdz@gmail.com', '1612515322', 1612515322, 0);
INSERT INTO `tbl_user_login` VALUES (30, 'tranviethiepdz@gmail.com', '1612607971', 1612607971, 0);
INSERT INTO `tbl_user_login` VALUES (31, 'tranviethiepdz@gmail.com', '1612607973', 1612607973, 0);
INSERT INTO `tbl_user_login` VALUES (32, 'tranviethiepdz@gmail.com', '1613879608', 1613879608, 0);
INSERT INTO `tbl_user_login` VALUES (33, 'tranviethiepdz@gmail.com', '1614188242', 1614188242, 0);
INSERT INTO `tbl_user_login` VALUES (34, 'tranviethiepdz@gmail.com', '1614332578', 1614332578, 0);
INSERT INTO `tbl_user_login` VALUES (35, 'tranviethiepdz@gmail.com', '1614481936', 1614481936, 0);
INSERT INTO `tbl_user_login` VALUES (36, 'tranviethiepdz@gmail.com', '1614490508', 1614490508, 0);
INSERT INTO `tbl_user_login` VALUES (37, 'tranviethiepdz@gmail.com', '1614495922', 1614495922, 0);
INSERT INTO `tbl_user_login` VALUES (38, 'tranviethiepdz@gmail.com', '1614499020', 1614499020, 0);
INSERT INTO `tbl_user_login` VALUES (39, 'tranviethiepdz@gmail.com', '1614862630', 1614862630, 0);
INSERT INTO `tbl_user_login` VALUES (40, 'tranviethiepdz@gmail.com', '1615135806', 1615135806, 0);
INSERT INTO `tbl_user_login` VALUES (41, 'tranviethiepdz@gmail.com', '1615222724', 1615222724, 0);
INSERT INTO `tbl_user_login` VALUES (42, 'tranviethiepdz@gmail.com', '1617286935', 1617286935, 0);
INSERT INTO `tbl_user_login` VALUES (43, 'tranviethiepdz@gmail.com', '1617293249', 1617293249, 0);
INSERT INTO `tbl_user_login` VALUES (44, 'tranviethiepdz@gmail.com', '1617303645', 1617303645, 1);

-- ----------------------------
-- Table structure for tbl_users
-- ----------------------------
DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE `tbl_users`  (
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `fullname` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `phone` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `group` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT '',
  `site_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `gsecret` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `isfa2` tinyint NULL DEFAULT 0,
  `isadmin` tinyint NULL DEFAULT 0,
  `pseudonym` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT '',
  `permission` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `cdate` int NULL DEFAULT NULL,
  `is_trash` tinyint NULL DEFAULT 0,
  `isactive` tinyint NULL DEFAULT 1,
  PRIMARY KEY (`username`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_users
-- ----------------------------
INSERT INTO `tbl_users` VALUES ('admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918|cdf4a007e2b02a0c49fc9b7ccfbb8a10c644f635e1765dcf2a7ab794ddc7edac', 'Admin', '', 'abc@gmail.com1', '7', '', NULL, 0, 1, 'Admin', '[\"1001\",\"1002\",\"1003\",\"1004\",\"1005\",\"2001\",\"2002\",\"2003\",\"2004\",\"2005\",\"3001\",\"3002\",\"3003\",\"3004\",\"3005\",\"4001\",\"4002\",\"4003\",\"4004\",\"4005\",\"5001\",\"5002\",\"5003\",\"5004\",\"5005\",\"6001\",\"6002\",\"6003\",\"6004\",\"6005\",\"7001\",\"7002\",\"7003\",\"7004\",\"7005\",\"8001\",\"8002\",\"8003\",\"8004\",\"8005\",\"9001\",\"9002\",\"9003\",\"9004\",\"9005\",\"10001\",\"10002\",\"10003\",\"10004\",\"10005\",\"11001\",\"11002\",\"11003\",\"11004\",\"11005\"]', 1597778215, 0, 1);
INSERT INTO `tbl_users` VALUES ('tranviethiepdz@gmail.com', 'd93fc24a5f68f2d6621e2d3aff26b5600f38f1b6876ff04f0070b38a54b2d2f8|cdf4a007e2b02a0c49fc9b7ccfbb8a10c644f635e1765dcf2a7ab794ddc7edac', 'Trần Hiệp', '096.954.990', 'tranviethiepdz@gmail.com', '7', NULL, NULL, 0, 1, 'Trần Hiệp', '[\"1001\",\"1002\",\"1003\",\"1004\",\"1005\",\"2001\",\"2002\",\"2003\",\"2004\",\"2005\",\"3001\",\"3002\",\"3003\",\"3004\",\"3005\",\"4001\",\"4002\",\"4003\",\"4004\",\"4005\",\"5001\",\"5002\",\"5003\",\"5004\",\"5005\",\"6001\",\"6002\",\"6003\",\"6005\",\"6006\",\"7001\",\"7002\",\"7003\",\"7004\",\"7005\",\"8001\",\"8002\",\"8003\",\"8004\",\"8005\",\"9001\",\"9002\",\"9003\",\"9004\",\"9005\",\"10001\",\"10002\",\"10003\",\"10004\",\"10005\",\"11001\",\"11002\",\"11003\",\"11004\",\"11005\"]', 1591860947, 0, 1);

SET FOREIGN_KEY_CHECKS = 1;

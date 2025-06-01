/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100427
 Source Host           : localhost:3306
 Source Schema         : inventory_project

 Target Server Type    : MySQL
 Target Server Version : 100427
 File Encoding         : 65001

 Date: 01/06/2025 12:06:49
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for account
-- ----------------------------
DROP TABLE IF EXISTS `account`;
CREATE TABLE `account`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `emp_id` varchar(99) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ds` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `dc` date NULL DEFAULT NULL,
  `un` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ps` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `act` int NULL DEFAULT NULL,
  `admin` int NULL DEFAULT NULL,
  `account_details` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `avatar` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `full_access` int NULL DEFAULT NULL,
  `name` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  `department_id` int NULL DEFAULT NULL,
  `remember_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `last_login` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 38 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of account
-- ----------------------------
INSERT INTO `account` VALUES (2, '1', '', '2017-05-01', 'admin', '$2a$08$HMSs9g77UdvwR7QJDA8dwuzqOj5qb1UZeKNc0s9aR4QuH7TT8tExi', 0, 1, 'Super Admin', '656d695223630_face2.jpg', 0, 'Mon Butiong', 0, NULL, NULL, 3, '09f08665d46e4209f59a42270adbc8780d73bc9dc6425cd962162c6c5ce9b0ed', '2025-06-01 10:11:42');
INSERT INTO `account` VALUES (37, '', NULL, '2024-05-15', 'silambu', '$2a$08$j.FhunOL0ywwPrANlITow.mveuu/bCghDmEQGlCdBxKtElgkiprMC', 1, NULL, 'Accounts', NULL, 0, 'Silambu', 0, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for accounts_payable
-- ----------------------------
DROP TABLE IF EXISTS `accounts_payable`;
CREATE TABLE `accounts_payable`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `inventory_id` int NULL DEFAULT NULL,
  `amount` float(11, 2) NULL DEFAULT NULL,
  `receiving_report_id` int NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `cheque_number` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cheque_date` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `collection_date` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of accounts_payable
-- ----------------------------

-- ----------------------------
-- Table structure for audit_trail
-- ----------------------------
DROP TABLE IF EXISTS `audit_trail`;
CREATE TABLE `audit_trail`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NULL DEFAULT NULL,
  `module` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `dc` datetime NULL DEFAULT NULL,
  `option` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `log` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of audit_trail
-- ----------------------------
INSERT INTO `audit_trail` VALUES (1, 2, 'account page', 'logout to account.', '2025-02-18 10:38:43', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (2, 37, 'login page', 'login to account.', '2025-02-18 10:38:47', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (3, 2, 'login page', 'login to account.', '2025-02-19 08:10:27', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (4, 2, 'login page', 'login to account.', '2025-02-20 14:31:36', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (5, 2, 'login page', 'login to account.', '2025-05-14 15:38:54', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (6, 2, 'login page', 'login to account.', '2025-05-14 15:42:25', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (7, 2, 'login page', 'login to account.', '2025-05-21 08:41:41', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (8, 2, 'login page', 'login to account.', '2025-05-29 14:31:33', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (9, 2, 'login page', 'login to account.', '2025-05-31 13:54:17', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (10, 2, 'login page', 'login to account.', '2025-06-01 10:10:21', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (11, 2, 'account page', 'logout to account.', '2025-06-01 10:11:40', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (12, 2, 'login page', 'login to account.', '2025-06-01 10:11:42', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for clients
-- ----------------------------
DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `name` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `contact_person_1` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `contact_person_2` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `contact_number_1` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `contact_number_2` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `tin` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `terms_and_conditions` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `shipping_notes` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `email` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `attension_to` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `fax_no` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `code` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `website` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `qid` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 88 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of clients
-- ----------------------------
INSERT INTO `clients` VALUES (1, '', NULL, 0, '', NULL, '', NULL, 'LULWA SALMAN J D DARWISH', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CN100001', NULL, NULL);
INSERT INTO `clients` VALUES (2, '', NULL, 0, '', NULL, '', NULL, 'AMIRI GUARD', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CN100002', NULL, NULL);
INSERT INTO `clients` VALUES (3, '', NULL, 0, '', NULL, '', NULL, 'SOUND ON WHEELS', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00001', NULL, NULL);
INSERT INTO `clients` VALUES (4, '', NULL, 0, '', NULL, '', NULL, 'AL BORAQ AUTOMOBILES CO', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00002', NULL, NULL);
INSERT INTO `clients` VALUES (5, '', NULL, 0, '', NULL, '', NULL, 'JUAN MIGUEL RAMIREZ ESCALANTE', NULL, NULL, '', '33399601 ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00003', NULL, NULL);
INSERT INTO `clients` VALUES (6, '', NULL, 0, '', NULL, '', NULL, 'JUST FOR FUN LLC', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00004', NULL, NULL);
INSERT INTO `clients` VALUES (7, '', NULL, 0, '', NULL, '', NULL, 'DOHA OASIS REAL ESTATE INVESTMENT CO', NULL, NULL, '', ' ', '4928 AL KHALEEJ STREET, MUSHAIREB ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00005', NULL, NULL);
INSERT INTO `clients` VALUES (8, '', NULL, 0, '', NULL, '', NULL, 'TECHMAN SOLUTIONS', NULL, NULL, '44278078', ' ', '  QATAR', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00006', NULL, NULL);
INSERT INTO `clients` VALUES (9, '', NULL, 0, '', NULL, '', NULL, 'ALI ABDULRAHMAN A A AL-MOHANNADI', NULL, NULL, '', ' ', '  DOHA QATAR', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00007', NULL, NULL);
INSERT INTO `clients` VALUES (10, '', NULL, 0, '', NULL, '', NULL, 'QATAR MUSEUMS AUTHOR ITY', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00008', NULL, NULL);
INSERT INTO `clients` VALUES (11, '', NULL, 0, '', NULL, '', NULL, 'MODOLUCE', NULL, NULL, '', ' 33885343', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00009', NULL, NULL);
INSERT INTO `clients` VALUES (12, '', NULL, 0, '', NULL, '', NULL, 'QATAR ELECTRO MECHANICAL', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00010', NULL, NULL);
INSERT INTO `clients` VALUES (13, '', NULL, 0, '', NULL, '', NULL, 'IBRAHIM ALI CONSTRUC TION AND TRADING', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00011', NULL, NULL);
INSERT INTO `clients` VALUES (14, '', NULL, 0, '', NULL, '', NULL, 'M/S. MARCOMLUX EVENTS LLC', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00012', NULL, NULL);
INSERT INTO `clients` VALUES (15, '', NULL, 0, '', NULL, '', NULL, 'SHEIKH AHMAD BIN ALI AL THANI', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00013', NULL, NULL);
INSERT INTO `clients` VALUES (16, '', NULL, 0, '', NULL, '', NULL, 'M/S. CREATIVE COMMUNICATION GROUP', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00014', NULL, NULL);
INSERT INTO `clients` VALUES (17, '', NULL, 0, '', NULL, '', NULL, 'MRS. AISHA AL DARWISH', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00015', NULL, NULL);
INSERT INTO `clients` VALUES (18, '', NULL, 0, '', NULL, '', NULL, 'AL TAMYEZ SECURITY SYSTEMS', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00016', NULL, NULL);
INSERT INTO `clients` VALUES (19, '', NULL, 0, '', NULL, '', NULL, 'YOUSEF AL DARWISH', NULL, NULL, '', '70000321 ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00017', NULL, NULL);
INSERT INTO `clients` VALUES (20, '', NULL, 0, '', NULL, '', NULL, 'M/S. TECHNO BLUE', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00018', NULL, NULL);
INSERT INTO `clients` VALUES (21, '', NULL, 0, '', NULL, '', NULL, 'MR. ABDULLAH AL JAMI', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00019', NULL, NULL);
INSERT INTO `clients` VALUES (22, '', NULL, 0, '', NULL, '', NULL, 'MR. PAUL JOHN', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00020', NULL, NULL);
INSERT INTO `clients` VALUES (23, '', NULL, 0, '', NULL, '', NULL, 'MR. ADEL DARWISH', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00021', NULL, NULL);
INSERT INTO `clients` VALUES (24, '', NULL, 0, '', NULL, '', NULL, 'SHEIKH AHMED BIN HAMAD AL THANI', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00022', NULL, NULL);
INSERT INTO `clients` VALUES (25, '', NULL, 0, '', NULL, '', NULL, 'MR. MOHAMED SHAWQY', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00023', NULL, NULL);
INSERT INTO `clients` VALUES (26, '', NULL, 0, '', NULL, '', NULL, 'SUPREME COMMITTEE FO R DELIVERY &amp; LEGACY', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00024', NULL, NULL);
INSERT INTO `clients` VALUES (27, '', NULL, 0, '', NULL, '', NULL, 'MOHAMMED ALI NAMA TRADING &amp; CONTG EST', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00025', NULL, NULL);
INSERT INTO `clients` VALUES (28, '', NULL, 0, '', NULL, '', NULL, 'DR. HESHAM ALI A A AL-SALOOS', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00026', NULL, NULL);
INSERT INTO `clients` VALUES (29, '', NULL, 0, '', NULL, '', NULL, 'AL HARIB SECURITY SYSTEM', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00027', NULL, NULL);
INSERT INTO `clients` VALUES (30, '', NULL, 0, '', NULL, '', NULL, 'ARAB MERCHANTS TRADING', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00028', NULL, NULL);
INSERT INTO `clients` VALUES (31, '', NULL, 0, '', NULL, '', NULL, 'M/S. MAYFAIR HOSPITALITY', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00029', NULL, NULL);
INSERT INTO `clients` VALUES (32, '', NULL, 0, '', NULL, '', NULL, 'DIGITAL VISUAL SERVICES', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00030', NULL, NULL);
INSERT INTO `clients` VALUES (33, '', NULL, 0, '', NULL, '', NULL, 'M/S. QATAR SIGNALS AND SYSTEMS W.L.L', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00031', NULL, NULL);
INSERT INTO `clients` VALUES (34, '', NULL, 0, '', NULL, '', NULL, 'MR. YOUSUF DARWISH', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00032', NULL, NULL);
INSERT INTO `clients` VALUES (35, '', NULL, 0, '', NULL, '', NULL, 'FACILITY MANAGEMENT SERVICES', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00033', NULL, NULL);
INSERT INTO `clients` VALUES (36, '', NULL, 0, '', NULL, '', NULL, 'MARSA ARABIA RESORT', NULL, NULL, '', '44460005 ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00034', NULL, NULL);
INSERT INTO `clients` VALUES (37, '', NULL, 0, '', NULL, '', NULL, 'EZDAN HOLDING GROUP', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00035', NULL, NULL);
INSERT INTO `clients` VALUES (38, '', NULL, 0, '', NULL, '', NULL, 'QATAR SITE &amp; POWER WLL', NULL, NULL, '', '44405150 ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00036', NULL, NULL);
INSERT INTO `clients` VALUES (39, '', NULL, 0, '', NULL, '', NULL, 'SIDRA MEDICINE', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00037', NULL, NULL);
INSERT INTO `clients` VALUES (40, '', NULL, 0, '', NULL, '', NULL, 'INCLUSIVE TECHNOLOGI ES &amp; ENGINEERING CONTROLS WLL', NULL, NULL, '', '40290062 ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00038', NULL, NULL);
INSERT INTO `clients` VALUES (41, '', NULL, 0, '', NULL, '', NULL, 'AHMAD AL RAMEHI', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00039', NULL, NULL);
INSERT INTO `clients` VALUES (42, '', NULL, 0, '', NULL, '', NULL, 'PROMOFIX LLC', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00040', NULL, NULL);
INSERT INTO `clients` VALUES (43, '', NULL, 0, '', NULL, '', NULL, 'K &amp; H SONS OF M AL MANA CO.', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00041', NULL, NULL);
INSERT INTO `clients` VALUES (44, '', NULL, 0, '', NULL, '', NULL, 'VODAFONE QATAR P.Q.S.C', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00042', NULL, NULL);
INSERT INTO `clients` VALUES (45, '', NULL, 0, '', NULL, '', NULL, 'M/S. MOWASALAT', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00043', NULL, NULL);
INSERT INTO `clients` VALUES (46, '', NULL, 0, '', NULL, '', NULL, 'CONCORD COMPUTER TRADING &amp; MAINT.', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00044', NULL, NULL);
INSERT INTO `clients` VALUES (47, '', NULL, 0, '', NULL, '', NULL, 'GENERAL AUTHORITY OF CUSTOMS', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00045', NULL, NULL);
INSERT INTO `clients` VALUES (48, '', NULL, 0, '', NULL, '', NULL, 'ABDULRAHMAN DARWISH', NULL, NULL, '', ' 77712233', '  DOHA QATAR', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00046', NULL, NULL);
INSERT INTO `clients` VALUES (49, '', NULL, 0, '', NULL, '', NULL, 'QATAR LUXURY CO. WLL', NULL, NULL, '77712233', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00047', NULL, NULL);
INSERT INTO `clients` VALUES (50, '', NULL, 0, '', NULL, '', NULL, 'CONSTREITE QATAR FOR CONSTRUCTION MAINTE', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00048', NULL, NULL);
INSERT INTO `clients` VALUES (51, '', NULL, 0, '', NULL, '', NULL, 'H.E.AMER ABDULLA AL HEMAIDI', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00049', NULL, NULL);
INSERT INTO `clients` VALUES (52, '', NULL, 0, '', NULL, '', NULL, 'MRS. MARIYAM', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00050', NULL, NULL);
INSERT INTO `clients` VALUES (53, '', NULL, 0, '', NULL, '', NULL, 'LUCIA SHERATON HOTEL', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00051', NULL, NULL);
INSERT INTO `clients` VALUES (54, '', NULL, 0, '', NULL, '', NULL, 'AL MANA SERVICES', NULL, NULL, '', ' ', '1391  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00052', NULL, NULL);
INSERT INTO `clients` VALUES (55, '', NULL, 0, '', NULL, '', NULL, 'DARWISH ABDULLA D AL DARWISH', NULL, NULL, '', ' 55946292', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00053', NULL, NULL);
INSERT INTO `clients` VALUES (56, '', NULL, 0, '', NULL, '', NULL, 'POWER AND LIGHT CENTER WLL.', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00054', NULL, NULL);
INSERT INTO `clients` VALUES (57, '', NULL, 0, '', NULL, '', NULL, 'ABDUL RAHMAN AL DARWISH', NULL, NULL, '', ' 55512233', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00055', NULL, NULL);
INSERT INTO `clients` VALUES (58, '', NULL, 0, '', NULL, '', NULL, 'MR. KHALIFA SAEED AL SULAITI', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00056', NULL, NULL);
INSERT INTO `clients` VALUES (59, '', NULL, 0, '', NULL, '', NULL, 'AHLI BANK (Q.P.S.C)', NULL, NULL, '', '44232392 50910777', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00057', NULL, NULL);
INSERT INTO `clients` VALUES (60, '', NULL, 0, '', NULL, '', NULL, 'THE PEARL OWNERS CORPORATION', NULL, NULL, '44095217', ' ', '28886  DOHA', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00058', NULL, NULL);
INSERT INTO `clients` VALUES (61, '', NULL, 0, '', NULL, '', NULL, 'DAR ALKARAM', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00059', NULL, NULL);
INSERT INTO `clients` VALUES (62, '', NULL, 0, '', NULL, '', NULL, 'STYLE DE VIE', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00060', NULL, NULL);
INSERT INTO `clients` VALUES (63, '', NULL, 0, '', NULL, '', NULL, 'THE ST. REGIS MARSA ARABIA ISLAND', NULL, NULL, '40204444', ' ', '14875  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00061', NULL, NULL);
INSERT INTO `clients` VALUES (64, '', NULL, 0, '', NULL, '', NULL, 'ALFARDAN HOTELS &amp; RESORTS', NULL, NULL, '', ' ', '908  MUSCAT, OMAN', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00062', NULL, NULL);
INSERT INTO `clients` VALUES (65, '', NULL, 0, '', NULL, '', NULL, 'ALHAZM REAL ESTATE PROJ MANAG', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00063', NULL, NULL);
INSERT INTO `clients` VALUES (66, '', NULL, 0, '', NULL, '', NULL, 'POWERTECH', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00064', NULL, NULL);
INSERT INTO `clients` VALUES (67, '', NULL, 0, '', NULL, '', NULL, 'AL EMADI ENTERPRISES', NULL, NULL, '', ' 66707226', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00065', NULL, NULL);
INSERT INTO `clients` VALUES (68, '', NULL, 0, '', NULL, '', NULL, 'PREMIER SECURITY EQUIPMENT &amp; SEV.', NULL, NULL, '44519927', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00066', NULL, NULL);
INSERT INTO `clients` VALUES (69, '', NULL, 0, '', NULL, '', NULL, 'GULF CONTRACTING CO. WLL', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00067', NULL, NULL);
INSERT INTO `clients` VALUES (70, '', NULL, 0, '', NULL, '', NULL, 'AL BADER BAWASIR SALOON', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00068', NULL, NULL);
INSERT INTO `clients` VALUES (71, '', NULL, 0, '', NULL, '', NULL, 'MINISTRY OF INTERIOR', NULL, NULL, 'For Inquiry', '44849444 ', '4020  DOHA', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00069', NULL, NULL);
INSERT INTO `clients` VALUES (72, '', NULL, 0, '', NULL, '', NULL, 'SWEET HOUSE FOR DESIGN AND DECOR', NULL, NULL, '44775848', ' ', '4810 AL JAZEERA AL ARABIA STREET QATAR', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00070', NULL, NULL);
INSERT INTO `clients` VALUES (73, '', NULL, 0, '', NULL, '', NULL, 'LACASA ARCHITECTS &amp; ENGINEERING CONSULTA NTS', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00071', NULL, NULL);
INSERT INTO `clients` VALUES (74, '', NULL, 0, '', NULL, '', NULL, 'AMIRI GUARD', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00072', NULL, NULL);
INSERT INTO `clients` VALUES (75, '', NULL, 0, '', NULL, '', NULL, 'BANYAN TREE HOTELS AND RESORTS', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00073', NULL, NULL);
INSERT INTO `clients` VALUES (76, '', NULL, 0, '', NULL, '', NULL, 'BLUEPRINT', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00074', NULL, NULL);
INSERT INTO `clients` VALUES (77, '', NULL, 0, '', NULL, '', NULL, 'CARNEGIE MELLON UNIVERSITY', NULL, NULL, '', ' ', '24866  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00075', NULL, NULL);
INSERT INTO `clients` VALUES (78, '', NULL, 0, '', NULL, '', NULL, 'ASPIRE ZONE FOUNDATION', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00076', NULL, NULL);
INSERT INTO `clients` VALUES (79, '', NULL, 0, '', NULL, '', NULL, 'HYPERX COMPUTERS TRA DING &amp; MAINTENANCE', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00077', NULL, NULL);
INSERT INTO `clients` VALUES (80, '', NULL, 0, '', NULL, '', NULL, 'DONGLIANG HE', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00078', NULL, NULL);
INSERT INTO `clients` VALUES (81, '', NULL, 0, '', NULL, '', NULL, 'TAV TECHNOLOGIES WLL', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00079', NULL, NULL);
INSERT INTO `clients` VALUES (82, '', NULL, 0, '', NULL, '', NULL, 'KARMA LOUNGE', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00080', NULL, NULL);
INSERT INTO `clients` VALUES (83, '', NULL, 0, '', NULL, '', NULL, 'VENTUM TECH FOR SERVICES &amp; SEC', NULL, NULL, '', ' ', '23619  DOHA QATAR', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00081', NULL, NULL);
INSERT INTO `clients` VALUES (84, '', NULL, 0, '', NULL, '', NULL, 'BU HAMOUR FOODS', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00082', NULL, NULL);
INSERT INTO `clients` VALUES (85, '', NULL, 0, '', NULL, '', NULL, 'HILIGHT SUADI CO.', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00083', NULL, NULL);
INSERT INTO `clients` VALUES (86, '', NULL, 0, '', NULL, '', NULL, 'NUCTECH COMPANY LIMITED', NULL, NULL, '', ' 60054272', '  CHINA', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00084', NULL, NULL);
INSERT INTO `clients` VALUES (87, '', NULL, 0, '', NULL, '', NULL, 'ARTEVO CONSULTING', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '', 'CNO00085', NULL, NULL);

-- ----------------------------
-- Table structure for clients_documents
-- ----------------------------
DROP TABLE IF EXISTS `clients_documents`;
CREATE TABLE `clients_documents`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `client_id` int NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `attachments` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `document_type_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of clients_documents
-- ----------------------------

-- ----------------------------
-- Table structure for company
-- ----------------------------
DROP TABLE IF EXISTS `company`;
CREATE TABLE `company`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `name` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `crv_series` int NULL DEFAULT NULL,
  `code` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of company
-- ----------------------------
INSERT INTO `company` VALUES (1, '', NULL, 0, '', NULL, '', NULL, 'Ventum Tech for Services & Security', 3, 'VS');
INSERT INTO `company` VALUES (2, '', NULL, 0, '', NULL, '', NULL, 'Ventum Tech Trading and Contracting', 239, 'VT');

-- ----------------------------
-- Table structure for crv
-- ----------------------------
DROP TABLE IF EXISTS `crv`;
CREATE TABLE `crv`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `project_id` int NULL DEFAULT NULL,
  `client_id` int NULL DEFAULT NULL,
  `client_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `crv_date` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `payment_mode` int NULL DEFAULT NULL,
  `amount_received` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `bank_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `branch` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cheque_no` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `account_no` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `debit_credit_type_id` int NULL DEFAULT NULL,
  `ar_account_id` int NULL DEFAULT NULL,
  `cash_control_account_id` int NULL DEFAULT NULL,
  `crv_code` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `company` int NULL DEFAULT NULL,
  `reference` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `remarks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `last_print_review` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `last_printed` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `print_count` int NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 243 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of crv
-- ----------------------------
INSERT INTO `crv` VALUES (1, '2024-09-15', 37, 0, '', NULL, '', NULL, NULL, 1, NULL, '2024-09-15', 2, '2600000', 'DOHA BANK', '', '01000045', '', 0, NULL, NULL, 'CV100001VS', 1, '1ST IN', '1ST INVESTMENT IN VENTUM TECH SECURITY DOHA_CHEQ.01000045 DT:04.09.24', NULL, NULL, 0);
INSERT INTO `crv` VALUES (2, '2024-10-21', 37, 0, '', NULL, '', NULL, NULL, 2, NULL, '2024-10-21', 2, '28194.39', '', '', 'TRF', '', 0, NULL, NULL, 'CV100002VS', 1, 'ADV', 'BEING PAYMENT RECEIVED AGAINST THE INV.# INV-SN00686 DT.09.09.2024.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (3, '2022-09-01', 37, 0, '', NULL, '', NULL, NULL, 3, NULL, '2022-09-01', 2, '50000', 'CBQ', '', '01001423', '', 0, NULL, NULL, 'CV100001VT', 2, 'INVEST', 'INITIAL AMOUNT TO OPEN A VENTUM BANK ACCOUNT. CH# 01001423 DT. 04.04.2022', '2025-02-20 19:34:52', NULL, 0);
INSERT INTO `crv` VALUES (4, '2022-09-01', 37, 0, '', NULL, '', NULL, NULL, 4, NULL, '2022-09-01', 2, '500000', 'MASRAF AL RAYAN', '', '00010853', '', 0, NULL, NULL, 'CV100002VT', 2, 'INVET', 'INITIAL INVESTMENT BY ALBCH#00010853 DT.05.07.2022', NULL, NULL, 0);
INSERT INTO `crv` VALUES (5, '2022-09-01', 37, 0, '', NULL, '', NULL, NULL, 4, NULL, '2022-09-01', 2, '250000', 'MASRAF AL RAYAN', '', '00010919', '', 0, NULL, NULL, 'CV100003VT', 2, 'INVEST', '2ND INVESTMENT BY ALB. CH#00010919 DT.23.08.2022', NULL, NULL, 0);
INSERT INTO `crv` VALUES (6, '2022-09-01', 37, 0, '', NULL, '', NULL, NULL, 4, NULL, '2022-09-01', 2, '300000', 'MASRAF AL RAYAN', '', '00010939', '', 0, NULL, NULL, 'CV100004VT', 2, 'INVEST', '3RD INVESTMENT FOR BARCO PAYMENT, CH#00010939 DT.30.08.2022', '2025-02-20 19:34:54', NULL, 0);
INSERT INTO `crv` VALUES (7, '2022-09-01', 37, 0, '', NULL, '', NULL, NULL, 5, NULL, '2022-09-01', 2, '15200', 'CBQ', '', '01000092', '', 0, NULL, NULL, 'CV100005VT', 2, '304R2', '100% ADVANCE PAYMENT AGAINST QT.22/SD/785/AV/304-R2', NULL, NULL, 0);
INSERT INTO `crv` VALUES (8, '2022-09-07', 37, 0, '', NULL, '', NULL, NULL, 4, NULL, '2022-09-07', 1, '300000', '', '', '', '', 0, NULL, NULL, 'CV100006VT', 2, 'INVEST', '4TH INVESTMENT BY ALB CH#00010940 DT.01.09.2022', NULL, NULL, 0);
INSERT INTO `crv` VALUES (9, '2022-09-28', 37, 0, '', NULL, '', NULL, NULL, 4, NULL, '2022-09-28', 2, '300000', 'MASRAF AL RAYAN', '', '00010960', '', 0, NULL, NULL, 'CV100007VT', 2, 'INVEST', '5TH INVESTMENT FOR SHENZHEN PAYMENT. CH#00010960 DT.07.09.2022', '2025-02-20 19:34:58', NULL, 0);
INSERT INTO `crv` VALUES (10, '2022-09-28', 37, 0, '', NULL, '', NULL, NULL, 4, NULL, '2022-09-28', 2, '200000', 'QIIB', '', '697434', '', 0, NULL, NULL, 'CV100008VT', 2, 'INVEST', '6TH INVESTMENT BY ALB . CH# 697434 DT.22.09.2022', NULL, NULL, 0);
INSERT INTO `crv` VALUES (11, '2022-10-02', 37, 0, '', NULL, '', NULL, NULL, 6, NULL, '2022-10-02', 2, '150000', 'QNB', '', '00000003', '', 0, NULL, NULL, 'CV100009VT', 2, 'ADVANCE', '1ST PARTIAL PAYMENT AGAINST-SOUND SYSTEM ORDER (HIDE CLUB)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (12, '2022-10-03', 37, 0, '', NULL, '', NULL, NULL, 4, NULL, '2022-10-03', 2, '200000', 'MASRAF AL RAYAN', '', '00011089', '', 0, NULL, NULL, 'CV100010VT', 2, 'INVESTM', '7TH INVESTMENT BY ALBB. CH#00011089 DT:02.10.2022.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (13, '2022-10-09', 37, 0, '', NULL, '', NULL, NULL, 7, NULL, '2022-10-09', 2, '500000', 'QIB', '', '01036517', '', 0, NULL, NULL, 'CV100011VT', 2, 'PO#250', '1ST ADV. PAYMENT  QT REF# Q-VT-202209-10-1REV 2 PO# 250.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (14, '2022-10-17', 37, 0, '', NULL, '', NULL, NULL, 4, NULL, '2022-10-17', 2, '500000', 'MASRAF AL RAYAN', '', '00011118', '', 0, NULL, NULL, 'CV100012VT', 2, 'INVEST', 'BEING 8TH INVESTMENT FROM ALB. CH#00011118 DT-16.10.2022', NULL, NULL, 0);
INSERT INTO `crv` VALUES (15, '2022-10-19', 37, 0, '', NULL, '', NULL, NULL, 4, NULL, '2022-10-19', 2, '300000', 'QIB', '', '697437', '', 0, NULL, NULL, 'CV100013VT', 2, 'INVESTM', 'BEING 9TH INVESTMENT FROM ALB. QIB CHQ#697437 DT.18.10.2022', NULL, NULL, 0);
INSERT INTO `crv` VALUES (16, '2022-10-19', 37, 0, '', NULL, '', NULL, NULL, 4, NULL, '2022-10-19', 2, '200000', 'QIB', '', '697438', '', 0, NULL, NULL, 'CV100014VT', 2, 'INVESTM', 'BEING 10TH INVESTMENT FROM ALB. QIB CHQ#697438 DT. 18.10.2022', NULL, NULL, 0);
INSERT INTO `crv` VALUES (17, '2022-10-19', 37, 0, '', NULL, '', NULL, NULL, 6, NULL, '2022-10-19', 2, '200000', 'QNB', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100015VT', 2, '2ND PMT', '2ND PARTIAL PAYMENT AGAINST-SOUND SYSTEM ORDER (HIDE CLUB)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (18, '2022-10-24', 37, 0, '', NULL, '', NULL, NULL, 6, NULL, '2022-10-24', 2, '100000', 'QNB', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100016VT', 2, '3RD PMT', 'BEING 3RD PARTIAL PAYMENT AGAINST- SOUND SYSTEM ORDER (HIDE CLUB)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (19, '2022-10-27', 37, 0, '', NULL, '', NULL, NULL, 6, NULL, '2022-10-27', 2, '150000', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100017VT', 2, '4TH PAY', 'BEING 4TH PAYMENT AGAINST- SOUND SYSTEM ORDER (HIDE CLUB).', NULL, NULL, 0);
INSERT INTO `crv` VALUES (20, '2022-10-30', 37, 0, '', NULL, '', NULL, NULL, 8, NULL, '2022-10-30', 2, '3120', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100018VT', 2, 'QT#335R', 'BEING PARTIAL ADV. PAYMENT FOR QT# 22/SD/7798/GE/335R1.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (21, '2022-10-30', 37, 0, '', NULL, '', NULL, NULL, 6, NULL, '2022-10-30', 2, '100000', 'QNB', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100019VT', 2, '5TH PAY', 'BEING 5TH PAYMENT AGAINST- SOUND SYSTEM ORDER (HIDE CLUB)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (22, '2022-10-30', 37, 0, '', NULL, '', NULL, NULL, 8, NULL, '2022-10-30', 2, '2305', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100020VT', 2, 'QT#335R', 'BEING FINAL PAYMENT AGAINST-QT# 22/SD/798/GE/335R1', NULL, NULL, 0);
INSERT INTO `crv` VALUES (23, '2022-11-07', 37, 0, '', NULL, '', NULL, NULL, 6, NULL, '2022-11-07', 2, '100000', 'QNB', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100021VT', 2, '6TH PAY', 'BEING 6TH PAYMENT AGAINST- SOUND SYSTEMS ORDER (HIDE CLUB)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (24, '2022-11-15', 37, 0, '', NULL, '', NULL, NULL, 4, NULL, '2022-11-15', 2, '600000', 'MASRAF AL RAYAN', '', '00011185', '', 0, NULL, NULL, 'CV100022VT', 2, 'INVEST', 'BEING 11TH INVESTMENT FROM ALB. MASRAF CHQ# 00011185 DT:13.11.2022', NULL, NULL, 0);
INSERT INTO `crv` VALUES (25, '2022-11-17', 37, 0, '', NULL, '', NULL, NULL, 6, NULL, '2022-11-17', 2, '150000', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100023VT', 2, 'INVEST', 'BEING 7TH PAYMENT AGAINST - SOUND SYSTEMS (HIDE CLUB)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (26, '2022-11-20', 37, 0, '', NULL, '', NULL, NULL, 7, NULL, '2022-11-20', 2, '280000', 'QIB', '', '01036627', '', 0, NULL, NULL, 'CV100024VT', 2, 'PO#250', 'BEING 2ND PAYMENT QT REF# Q-VT-202209-10-1REV 2 PO# 250', NULL, NULL, 0);
INSERT INTO `crv` VALUES (27, '2022-11-24', 37, 0, '', NULL, '', NULL, NULL, 6, NULL, '2022-11-24', 2, '100000', 'QNB', '', '00000055', '', 0, NULL, NULL, 'CV100025VT', 2, '8TH PAY', 'BEINT 8TH PAYMENT AGAINST - SOUND SYSTEMS ORDER (HIDE CLUB)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (28, '2022-11-29', 37, 0, '', NULL, '', NULL, NULL, 9, NULL, '2022-11-29', 2, '9000', 'QIIB', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100026VT', 2, 'QT#340', 'BEING 100% ADV PAYMENT AGAINST QT#22/VT/442/AV/340 DT: 27.11.2022', NULL, NULL, 0);
INSERT INTO `crv` VALUES (29, '2022-11-30', 37, 0, '', NULL, '', NULL, NULL, 10, NULL, '2022-11-30', 2, '530005.45', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100027VT', 2, 'PO-7006', 'BEING 100% ADV PAYMENT AGAINST PI-VT-202202-11-003 (TENDER-2022-054R)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (30, '2022-12-01', 37, 0, '', NULL, '', NULL, NULL, 11, NULL, '2022-12-01', 1, '1900', '', '', '', '', 0, NULL, NULL, 'CV100028VT', 2, 'QT.350', 'SALES GRANDSTREAM GXV3380 - QT.22/SD/798/AV/350', NULL, NULL, 0);
INSERT INTO `crv` VALUES (31, '2022-12-04', 37, 0, '', NULL, '', NULL, NULL, 4, NULL, '2022-12-04', 2, '500000', 'MASRAF AL RAYAN', '', '00011203', '', 0, NULL, NULL, 'CV100029VT', 2, '12TH IN', 'BEING 12TH INVESTMENT FROM ALB. MASRAF CHQ# 00011203 DT: 21.11.2022', NULL, NULL, 0);
INSERT INTO `crv` VALUES (32, '2022-12-12', 37, 0, '', NULL, '', NULL, NULL, 6, NULL, '2022-12-12', 2, '100000', 'QNB', '', '00000061', '', 0, NULL, NULL, 'CV100030VT', 2, '9TH PAY', 'BEING 9TH PAYMENT AGAINST- SOUND SYSTEMS ORDER (HIDE CLUB)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (33, '2022-12-14', 37, 0, '', NULL, '', NULL, NULL, 12, NULL, '2022-12-14', 2, '5655', 'DOHA BANK', '', '010005420', '', 0, NULL, NULL, 'CV100031VT', 2, 'SN00665', 'BEING PAYMENT RECEIVED AGAINST REF.# SN0065 DT: 20.10.2022.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (34, '2022-12-14', 37, 0, '', NULL, '', NULL, NULL, 6, NULL, '2022-12-14', 2, '100000', 'QNB', '', '00000059', '', 0, NULL, NULL, 'CV100032VT', 2, '10TH', 'BEING 10TH PAYMENT AGAINST- SOUND SYSTEM ORDER (HIDE CLUB)', '2025-02-20 20:15:11', NULL, 0);
INSERT INTO `crv` VALUES (35, '2022-12-14', 37, 0, '', NULL, '', NULL, NULL, 13, NULL, '2022-12-14', 2, '8900', 'QIB', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100033VT', 2, 'QT#500', 'BEING 100% ADVANCE AGAINST QT#22/SD/798/AV/500 DT: 11.12.2022..', NULL, NULL, 0);
INSERT INTO `crv` VALUES (36, '2022-12-19', 37, 0, '', NULL, '', NULL, NULL, 14, NULL, '2022-12-19', 2, '1000', 'EMIRATES NBD', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100034VT', 2, '1ST ADV', '1ST PAYMENT AGAINST HUBLOT CLOSING EVENT FOR FIFA QATAR 2022', NULL, NULL, 0);
INSERT INTO `crv` VALUES (37, '2022-12-19', 37, 0, '', NULL, '', NULL, NULL, 15, NULL, '2022-12-19', 1, '25000', '', '', '', '', 0, NULL, NULL, 'CV100035VT', 2, '337-R2', '33.95% ADVANCE PAYMENT FOR 22/SD/798/AV/337-R2', NULL, NULL, 0);
INSERT INTO `crv` VALUES (38, '2022-12-21', 37, 0, '', NULL, '', NULL, NULL, 16, NULL, '2022-12-21', 2, '10526', 'CBQ', '', '01003205', '', 0, NULL, NULL, 'CV100036VT', 2, 'PI-20-2', 'BEING PAYMENT AGAINST PI-VT-202212-20-2 DT: 20.12.2022 (DJ EQUIP)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (39, '2022-12-29', 37, 0, '', NULL, '', NULL, NULL, 14, NULL, '2022-12-29', 2, '441754', 'EMIRATED NBD', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100037VT', 2, '2ND PAY', '2ND PAYMENT RECEIVED AGAINST HUBLOT CLOSING EVENT FOR FIFA QATAR 2022', NULL, NULL, 0);
INSERT INTO `crv` VALUES (40, '2023-01-04', 37, 0, '', NULL, '', NULL, NULL, 17, NULL, '2023-01-04', 1, '3400', '', '', '', '', 0, NULL, NULL, 'CV100038VT', 2, 'QT-344R', 'BEING PAYMENT RECV. AGAINST QT-344R1 &amp; INV-VT-2023-01-001', NULL, NULL, 0);
INSERT INTO `crv` VALUES (41, '2023-01-04', 37, 0, '', NULL, '', NULL, NULL, 17, NULL, '2023-01-04', 1, '750', '', '', '', '', 0, NULL, NULL, 'CV100039VT', 2, 'QT-344I', 'BEING PAYMENT RECV. AGAINST - QT-344 IP CAMERA INV-2023-01-002', NULL, NULL, 0);
INSERT INTO `crv` VALUES (42, '2023-01-08', 37, 0, '', NULL, '', NULL, NULL, 18, NULL, '2023-01-08', 2, '2750', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100040VT', 2, '504', 'PAYMENT AGAINST QT.22/SD/798/AV/504 DT.03.01.2023', NULL, NULL, 0);
INSERT INTO `crv` VALUES (43, '2023-01-10', 37, 0, '', NULL, '', NULL, NULL, 6, NULL, '2023-01-10', 2, '100000', 'QNB', '', '00000057', '', 0, NULL, NULL, 'CV100041VT', 2, '11TH', 'BEING 11TH PAYMENT AGAINST - SOUND SYSTEMS ORDER (HIDE CLUB)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (44, '2023-01-10', 37, 0, '', NULL, '', NULL, NULL, 6, NULL, '2023-01-10', 2, '100000', 'QNB', '', '00000058', '', 0, NULL, NULL, 'CV100042VT', 2, '12TH', 'BEING 12TH PAYMENT AGAINST - SOUND SYSTEMS ORDER (HIDE CLUB)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (45, '2023-01-24', 37, 0, '', NULL, '', NULL, NULL, 15, NULL, '2023-01-24', 2, '15000', 'MASRAF AL RAYAN', '', '00002849', '', 0, NULL, NULL, 'CV100043VT', 2, '337-R2', '2ND ADVANCE PAYMENT FOR 22/SD/798/AV/337-R2', NULL, NULL, 0);
INSERT INTO `crv` VALUES (46, '2023-01-29', 37, 0, '', NULL, '', NULL, NULL, 19, NULL, '2023-01-29', 2, '3495', 'CBQ', '', '010001465', '', 0, NULL, NULL, 'CV100044VT', 2, '02/R2', '100% ADVANCE PAYMENT AGAINST QT.22/VT/442/AV/002-R2', NULL, NULL, 0);
INSERT INTO `crv` VALUES (47, '2023-02-09', 37, 0, '', NULL, '', NULL, NULL, 20, NULL, '2023-02-09', 2, '1350', 'DOHA BANK', '', '1000648', '', 0, NULL, NULL, 'CV100045VT', 2, 'REFUND', 'BEING REFUND AGAINST EXCESS AMOUNT PAID. REF. VT-PO-001.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (48, '2023-02-12', 37, 0, '', NULL, '', NULL, NULL, 21, NULL, '2023-02-12', 1, '500', '', '', '', '', 0, NULL, NULL, 'CV100046VT', 2, 'QT#001', 'BEING 100% ADV PAYMENT AGAINST QT.#22/VT/442/AV/001 DT-16.12.2022', NULL, NULL, 0);
INSERT INTO `crv` VALUES (49, '2023-02-12', 37, 0, '', NULL, '', NULL, NULL, 22, NULL, '2023-02-12', 1, '3050', '', '', '', '', 0, NULL, NULL, 'CV100047VT', 2, 'QT#13', 'BEING 100% ADVANCE AGAINST QT# 23/SD/798/AV/13 DT-07.02.2023.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (50, '2023-02-16', 37, 0, '', NULL, '', NULL, NULL, 4, NULL, '2023-02-16', 2, '500000', 'MASRAF AL RAYAN', '', '00011249', '', 0, NULL, NULL, 'CV100048VT', 2, 'INVESTM', 'BEING 13TH INVESTMENT FROM ALB. MASRAF# 00011249 DT: 19.12.2022', NULL, NULL, 0);
INSERT INTO `crv` VALUES (51, '2023-02-16', 37, 0, '', NULL, '', NULL, NULL, 6, NULL, '2023-02-16', 2, '100000', '00000054', '', 'QNB', '', 0, NULL, NULL, 'CV100049VT', 2, '13TH', 'BEING 13TH PAYMENT AGAINST HIDE CLUB PROJECT.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (52, '2023-02-16', 37, 0, '', NULL, '', NULL, NULL, 6, NULL, '2023-02-16', 2, '100000', '00000056', '', 'QNB', '', 0, NULL, NULL, 'CV100050VT', 2, '14TH', 'BEING 14TH PAYMENT AGAINST HIDE CLUB PROJECT.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (53, '2023-02-20', 37, 0, '', NULL, '', NULL, NULL, 23, NULL, '2023-02-20', 1, '500', '', '', '', '', 0, NULL, NULL, 'CV100051VT', 2, 'QT.#17', 'BEING 100% ADVANCE AGAINST QT.#23/SD/798/CCTV/17 DT: 15.02.2023', NULL, NULL, 0);
INSERT INTO `crv` VALUES (54, '2023-02-28', 37, 0, '', NULL, '', NULL, NULL, 24, NULL, '2023-02-28', 2, '40400', 'MASRAF AL RAYAN', '', '00002928', '', 0, NULL, NULL, 'CV100052VT', 2, 'QT#337R', 'FINAL PAYMENT FOR QT#337R2 &amp; 100% ADV PAYMENT FOR QT.#18 (AV SYS).', NULL, NULL, 0);
INSERT INTO `crv` VALUES (55, '2023-02-28', 37, 0, '', NULL, '', NULL, NULL, 14, NULL, '2023-02-28', 2, '208293.76', 'EMIRATES NBD', '', 'TRF', '', 0, NULL, NULL, 'CV100053VT', 2, '3RD PAY', 'BEING 3RD PAYMENT AGAINST HUBLOT CLOSING EVENT FOR FIFA QATAR 2022.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (56, '2023-03-02', 37, 0, '', NULL, '', NULL, NULL, 14, NULL, '2023-03-02', 2, '208243.76', 'EMIRATES NBD', '', 'TRF', '', 0, NULL, NULL, 'CV100054VT', 2, '3RD', 'BEING 3RD PAYMENT AGAINST HUBLOT CLOSING EVENT FOR FIFA WC 2022.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (57, '2023-03-06', 37, 0, '', NULL, '', NULL, NULL, 25, NULL, '2023-03-06', 1, '1270', '', '', '', '', 0, NULL, NULL, 'CV100055VT', 2, 'QT#010', 'BEING PAYEMNT RECEIVED AGANST QT.# 23/VT/442/IT/010 DT: 01.03.2023.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (58, '2023-03-07', 37, 0, '', NULL, '', NULL, NULL, 26, NULL, '2023-03-07', 2, '2335200', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100056VT', 2, '2022122', 'BEING PAYMENT AGAINST INV-20221228 DT: 28.12.2022. AGREEMENT-60010057', NULL, NULL, 0);
INSERT INTO `crv` VALUES (59, '2023-03-08', 37, 0, '', NULL, '', NULL, NULL, 4, NULL, '2023-03-08', 2, '500000', 'MASRAF AL RAYAN', '', '00011408', '', 0, NULL, NULL, 'CV100057VT', 2, '14TH IN', 'BEING 14TH INVESTMENT FROM MASRAF CHEQ#00011408 DT: 02.03.2023', NULL, NULL, 0);
INSERT INTO `crv` VALUES (60, '2023-03-08', 37, 0, '', NULL, '', NULL, NULL, 27, NULL, '2023-03-08', 1, '1940', '', '', '', '', 0, NULL, NULL, 'CV100058VT', 2, 'SOW', 'BEING FINAL BAL PAYMENT FOR SOW INV-JN00236 DT: 28.12.2022 (RN00205)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (61, '2023-03-09', 37, 0, '', NULL, '', NULL, NULL, 28, NULL, '2023-03-09', 2, '30000', 'QIB', '', 'BANK TRANSFER', '', 0, NULL, NULL, 'CV100059VT', 2, 'SOW', 'BEING 2ND ADV PAYMENT FOR JOB NO-RN00136 (SOW QT.#210R1)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (62, '2023-04-09', 37, 0, '', NULL, '', NULL, NULL, 6, NULL, '2023-04-09', 2, '100000', 'QNB', '', '00000053', '', 0, NULL, NULL, 'CV100060VT', 2, '15TH PA', 'BEING 15TH PAYMENT AGAINST HIDE NIGHT CLUB PROJECT', NULL, NULL, 0);
INSERT INTO `crv` VALUES (63, '2023-04-09', 37, 0, '', NULL, '', NULL, NULL, 29, NULL, '2023-04-09', 2, '6500', 'DOHA BANK', '', '01006159', '', 0, NULL, NULL, 'CV100061VT', 2, 'QT-04R1', 'BEING 100% ADV AGAINST QT#004R1 &amp; PO REF.#AHSS1502023 DT:15.02.2023', NULL, NULL, 0);
INSERT INTO `crv` VALUES (64, '2023-04-12', 37, 0, '', NULL, '', NULL, NULL, 30, NULL, '2023-04-12', 1, '3400', '', '', '', '', 0, NULL, NULL, 'CV100062VT', 2, 'QT#11', 'BEING 100% ADVANCE AGAISNT QT.# 202304-11 DT: 11.04.2023.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (65, '2023-04-19', 37, 0, '', NULL, '', NULL, NULL, 26, NULL, '2023-04-19', 2, '1320', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100063VT', 2, 'REFUND', 'REFUND -OPERATORS MEALS REF.INV# 648. CN.NO-BS-2121 &amp; 2134.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (66, '2023-04-20', 37, 0, '', NULL, '', NULL, NULL, 24, NULL, '2023-04-20', 1, '1250', '', '', '', '', 0, NULL, NULL, 'CV100064VT', 2, 'QT-31', 'BEING 100% ADVANCE AGAINST QT.#23/SD/798/AV/31 DT:30.03.2023.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (67, '2023-05-02', 37, 0, '', NULL, '', NULL, NULL, 31, NULL, '2023-05-02', 2, '190731.86', 'QNB', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100065VT', 2, 'SPACE-3', 'BEING 50% ADV AGAINST QT# Q-SP31-120-202304-14-R DT-26.04.2023.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (68, '2023-05-03', 37, 0, '', NULL, '', NULL, NULL, 32, NULL, '2023-05-03', 2, '108866', 'QNB', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100066VT', 2, '001', 'BEING PAYMENT REC. AGAINST INV-VT-2022-11-001 PO#202205-31 (QPI', NULL, NULL, 0);
INSERT INTO `crv` VALUES (69, '2023-05-09', 37, 0, '', NULL, '', NULL, NULL, 33, NULL, '2023-05-09', 2, '437000', 'DUKHAN BANK', '', '00958753', '', 0, NULL, NULL, 'CV100067VT', 2, 'INV-9', '100% PDC AGAINST. INV# 9. PO#1690. CHEQ SUBJECT TO REALIZATION.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (70, '2023-05-17', 37, 0, '', NULL, '', NULL, NULL, 34, NULL, '2023-05-17', 2, '2500', 'QNB', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100068VT', 2, 'QT-15', '100% ADV AGAINST QT-YDV-150-202305-15 QT DT: 15.05.2023.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (71, '2023-05-22', 37, 0, '', NULL, '', NULL, NULL, 31, NULL, '2023-05-22', 2, '152585.49', 'QNB', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100069VT', 2, 'SPACE31', 'BEING (2ND) 40% ADV AGAINST QT# Q-SP31-120-202304-14-R DT-26.04.2023', NULL, NULL, 0);
INSERT INTO `crv` VALUES (72, '2023-05-22', 37, 0, '', NULL, '', NULL, NULL, 4, NULL, '2023-05-22', 2, '400000', 'MASRAF AL RAYAN', '', '00011610', '', 0, NULL, NULL, 'CV100070VT', 2, '15TH IN', 'BEING 15TH INVESTMENT FROM ALB. MASRAF CHQ.#00011610 DT: 18.05.2023.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (73, '2023-05-23', 37, 0, '', NULL, '', NULL, NULL, 35, NULL, '2023-05-23', 2, '13036.26', 'CBQ', '', '01006049', '', 0, NULL, NULL, 'CV100071VT', 2, '12476', 'BEING 100% ADV AGAINST PO- FM-012476 &amp; QT. REF# Q-SHELTER-202301-02', NULL, NULL, 0);
INSERT INTO `crv` VALUES (74, '2023-05-25', 37, 0, '', NULL, '', NULL, NULL, 35, NULL, '2023-05-25', 2, '2354', 'CBQ', '', '01006048', '', 0, NULL, NULL, 'CV100072VT', 2, '12477', '100% ADV AGAINST PO-FM-012477 &amp; QT REF.# Q-SHELTER-202301-03', NULL, NULL, 0);
INSERT INTO `crv` VALUES (75, '2023-06-08', 37, 0, '', NULL, '', NULL, NULL, 32, NULL, '2023-06-08', 2, '245000', 'TRANSFER', '', '', '', 0, NULL, NULL, 'CV100073VT', 2, 'UDC', '1ST PAYMENT AGAINST INV-20221231-4 (UDC TOWER PROJECT LED SCREEN).', NULL, NULL, 0);
INSERT INTO `crv` VALUES (76, '2023-06-15', 37, 0, '', NULL, '', NULL, NULL, 36, NULL, '2023-06-15', 2, '43000', 'CBQ', '', '01000645', '', 0, NULL, NULL, 'CV100074VT', 2, 'PO#463', 'PAYMENT AGAINST INV#20230613-13 FOR SOUND ALIGNMENT OF RESTAURANT', NULL, NULL, 0);
INSERT INTO `crv` VALUES (77, '2023-06-19', 37, 0, '', NULL, '', NULL, NULL, 37, NULL, '2023-06-19', 2, '39650', 'QIIB', '', '00989716', '', 0, NULL, NULL, 'CV100075VT', 2, 'REFUNDA', 'REFUNDABLE DEPOSIT FOR EZDAN 23(3 FLATS) &amp; EZDAN 24(5 FLATS)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (78, '2023-06-21', 37, 0, '', NULL, '', NULL, NULL, 38, NULL, '2023-06-21', 2, '195000', 'BNP PARIBAS', '', '01648656', '', 0, NULL, NULL, 'CV100076VT', 2, 'PO#1131', 'PAYMENT FOR ICONIC LICENSE RENEWAL PO#11310 DT.21.03.2023', NULL, NULL, 0);
INSERT INTO `crv` VALUES (79, '2023-06-21', 37, 0, '', NULL, '', NULL, NULL, 7, NULL, '2023-06-21', 2, '120000', 'QIB', '', '01037584', '', 0, NULL, NULL, 'CV100077VT', 2, 'IN#12', 'PAYMENT AGAINST INVOICE#20230607-12', NULL, NULL, 0);
INSERT INTO `crv` VALUES (80, '2023-06-22', 37, 0, '', NULL, '', NULL, NULL, 32, NULL, '2023-06-22', 2, '245000', '', '', 'TRF', '', 0, NULL, NULL, 'CV100078VT', 2, 'UDC', '2ND PAYMENT AGAINST INV-20221231-4 (UDC TOWER PROJECT LED SCREEN).', NULL, NULL, 0);
INSERT INTO `crv` VALUES (81, '2023-06-25', 37, 0, '', NULL, '', NULL, NULL, 21, NULL, '2023-06-25', 1, '500', '', '', '', '', 0, NULL, NULL, 'CV100079VT', 2, 'SERVICE', 'PAYMENT AGAINST SERVICE SUPPORT QT.Q-DAAAV-02-202306-04', NULL, NULL, 0);
INSERT INTO `crv` VALUES (82, '2023-07-10', 37, 0, '', NULL, '', NULL, NULL, 39, NULL, '2023-07-10', 2, '367.03', '', '', 'TRF', '', 0, NULL, NULL, 'CV100080VT', 2, 'INV-10', 'PAYMENT AGAINST INV.NO.20230508-10', NULL, NULL, 0);
INSERT INTO `crv` VALUES (83, '2023-07-10', 37, 0, '', NULL, '', NULL, NULL, 32, NULL, '2023-07-10', 2, '200000', '', '', 'TRF', '', 0, NULL, NULL, 'CV100081VT', 2, 'UDC', '3RD PAYMENT AGAINST INV#20221231-4 UDC PROJECT LED SCREEN', NULL, NULL, 0);
INSERT INTO `crv` VALUES (84, '2023-07-16', 37, 0, '', NULL, '', NULL, NULL, 40, NULL, '2023-07-16', 2, '28500', 'DOHA BANK', '', '01003087', '', 0, NULL, NULL, 'CV100082VT', 2, '3955', '10% ADVANCE PAYMENT AGAINST PO#3955 DT.27.06.2023', NULL, NULL, 0);
INSERT INTO `crv` VALUES (85, '2023-07-16', 37, 0, '', NULL, '', NULL, NULL, 41, NULL, '2023-07-16', 1, '1000', '', '', '', '', 0, NULL, NULL, 'CV100083VT', 2, '202307-', 'PAYMENT AGAINST Q-AR-05-202307-13 SUPPORT FOR GRANDSTREAM IP SUPPORT', NULL, NULL, 0);
INSERT INTO `crv` VALUES (86, '2023-07-17', 37, 0, '', NULL, '', NULL, NULL, 42, NULL, '2023-07-17', 2, '45000', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100084VT', 2, '202307-', '100% ADVANCE PAYMENT AGAINST QUOTE#Q-PM-161-202307-16', NULL, NULL, 0);
INSERT INTO `crv` VALUES (87, '2023-07-17', 37, 0, '', NULL, '', NULL, NULL, 32, NULL, '2023-07-17', 2, '200000', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100085VT', 2, 'UDC', '4TH PAYMENT AGAINST INV#20221231-4 UDC PROJECT LED SCREEN', NULL, NULL, 0);
INSERT INTO `crv` VALUES (88, '2023-08-14', 37, 0, '', NULL, '', NULL, NULL, 39, NULL, '2023-08-14', 2, '19.32', '', '', 'TRF', '', 0, NULL, NULL, 'CV100086VT', 2, 'INV-10', 'BALANCE PAYMENT AGAINST INV.NO-20230508-10 (CREDITED-09.08.2023)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (89, '2023-08-15', 37, 0, '', NULL, '', NULL, NULL, 4, NULL, '2023-08-15', 2, '300000', 'MASRAF AL RAYAN', '', '00011828', '', 0, NULL, NULL, 'CV100087VT', 2, '16TH IN', 'BEING 16TH INVESTMENT FROM ALB. MASRAF CHQ.#00011828 DT: 13.08.2023.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (90, '2023-08-24', 37, 0, '', NULL, '', NULL, NULL, 26, NULL, '2023-08-24', 2, '46200', '', '', 'TRF', '', 0, NULL, NULL, 'CV100088VT', 2, '2023021', 'BEING PAYMENT AGAINST INV.# 20230212VAR DT: 12.02.2023.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (91, '2023-08-24', 37, 0, '', NULL, '', NULL, NULL, 32, NULL, '2023-08-24', 2, '32373.1', '', '', 'TRF', '', 0, NULL, NULL, 'CV100089VT', 2, 'QF PROJ', 'BEING 10% ADVANCE PAYMENT AGAINST PI-1011-2023 DT: 20.08.2023', NULL, NULL, 0);
INSERT INTO `crv` VALUES (92, '2023-09-12', 37, 0, '', NULL, '', NULL, NULL, 43, NULL, '2023-09-12', 2, '126582', 'CBQ', '', '01010862', '', 0, NULL, NULL, 'CV100090VT', 2, 'QT-05R1', 'BEING 1ST PAY AGAINST PO.#20601 VT QUOT REF.#Q-AMS-272-202309-05-R1.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (93, '2023-09-13', 37, 0, '', NULL, '', NULL, NULL, 44, NULL, '2023-09-13', 2, '86812.68', '', '', 'TRF', '', 0, NULL, NULL, 'CV100091VT', 2, 'ADV.', 'BEING 50% ADVANCE AGAINST QT.Q-VQ-206-202306-20-R2 &amp; PO.#23/1616', NULL, NULL, 0);
INSERT INTO `crv` VALUES (94, '2023-09-18', 37, 0, '', NULL, '', NULL, NULL, 32, NULL, '2023-09-18', 2, '97121', '', '', 'TRF', '', 0, NULL, NULL, 'CV100092VT', 2, 'ADV', 'BEING 30% ADV UPON DATA CABLE PULLING (REF.# PI-1012-2023) QF-COUNT.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (95, '2023-09-28', 37, 0, '', NULL, '', NULL, NULL, 6, NULL, '2023-09-28', 2, '50000', '', '', 'BANK TRF', '', 0, NULL, NULL, 'CV100093VT', 2, '16TH PA', 'BEING 16TH PAYMENT AGAINST - SOUND SYSTEM ORDER (HIDE CLUB).', NULL, NULL, 0);
INSERT INTO `crv` VALUES (96, '2023-09-28', 37, 0, '', NULL, '', NULL, NULL, 40, NULL, '2023-09-28', 2, '100000', 'DOHA BANK', '', '01003268', '', 0, NULL, NULL, 'CV100094VT', 2, '3955', 'BEING 35.09% PAY AGAINST -PO_3955. (RCT VALID AFTER CHEQ REALISATION)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (97, '2023-09-28', 37, 0, '', NULL, '', NULL, NULL, 40, NULL, '2023-09-28', 2, '99500', 'DOHA BANK', '', '01003269', '', 0, NULL, NULL, 'CV100095VT', 2, '3955', 'BEING 34.91% PAY AGAINST -PO_3955. (RCT VALID AFTER CHEQ REALISATION)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (98, '2023-10-01', 37, 0, '', NULL, '', NULL, NULL, 46, NULL, '2023-10-01', 1, '1988', '', '', '', '', 0, NULL, NULL, 'CV100096VT', 2, 'REFUND', 'BEING REFUND AGAINST INVOICE- 5801/23 DT: 09.04.2023 (CN-73)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (99, '2023-10-03', 37, 0, '', NULL, '', NULL, NULL, 4, NULL, '2023-10-03', 2, '300000', 'MASRAF AL RAYAN', '', '00012020', '', 0, NULL, NULL, 'CV100097VT', 2, '17TH PA', 'BEING 17TH INVESTMENT FROM ALB. MASRAF CHQ.#00012020 DT: 02.10.2023', NULL, NULL, 0);
INSERT INTO `crv` VALUES (100, '2023-10-10', 37, 0, '', NULL, '', NULL, NULL, 47, NULL, '2023-10-10', 2, '19900', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100098VT', 2, 'ADVANCE', 'BEING 10% ADV. PAYMENT. LPO REF.# 20230103 DT: 23.08.2023 (X-RAY).', NULL, NULL, 0);
INSERT INTO `crv` VALUES (101, '2023-10-10', 37, 0, '', NULL, '', NULL, NULL, 44, NULL, '2023-10-10', 2, '69450.14', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100099VT', 2, '2ND PAY', 'BEING 2ND PAYMENT AGAINST PO.# 23/1616. LED VIDEO WALL INV-1015', NULL, NULL, 0);
INSERT INTO `crv` VALUES (102, '2023-10-11', 37, 0, '', NULL, '', NULL, NULL, 6, NULL, '2023-10-11', 2, '50000', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100100VT', 2, '17TH PA', 'BEING 17TH PAYMENT AGAINST - SOUND SYSTEMS ORDER (HIDE CLUB).', NULL, NULL, 0);
INSERT INTO `crv` VALUES (103, '2023-10-18', 37, 0, '', NULL, '', NULL, NULL, 48, NULL, '2023-10-18', 1, '908', '', '', '', '', 0, NULL, NULL, 'CV100101VT', 2, 'INV-31', 'BEING PAYMENT RECEIVED AGAINST INV-20231012-31 DT: 16.10.2023.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (104, '2023-10-29', 37, 0, '', NULL, '', NULL, NULL, 49, NULL, '2023-10-29', 2, '2833', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100102VT', 2, 'INV-32', 'BEING PAYMENT REC AGAINST INV-20231019-32 DT-19.10.2023.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (105, '2023-10-30', 37, 0, '', NULL, '', NULL, NULL, 4, NULL, '2023-10-30', 2, '200000', 'MASRAF AL RAYAN', '', '00012120', '', 0, NULL, NULL, 'CV100103VT', 2, '18TH PA', 'BEING 18TH INVESTMENT FROM ALB. MASRAF CHQ.#00012120 DT: 29.10.2023.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (106, '2023-10-31', 37, 0, '', NULL, '', NULL, NULL, 50, NULL, '2023-10-31', 1, '1100', '', '', '', '', 0, NULL, NULL, 'CV100104VT', 2, 'REFUND', 'REFUND AGAINST SEALANT WORK INV#CQ/2023/10144', NULL, NULL, 0);
INSERT INTO `crv` VALUES (107, '2023-11-07', 37, 0, '', NULL, '', NULL, NULL, 17, NULL, '2023-11-07', 1, '500', '', '', '', '', 0, NULL, NULL, 'CV100105VT', 2, 'INV-34', 'BEING PAYMENT RECEIVED AGAINST INV-20231106-34 DT-06.11.2023', NULL, NULL, 0);
INSERT INTO `crv` VALUES (108, '2023-11-08', 37, 0, '', NULL, '', NULL, NULL, 4, NULL, '2023-11-08', 2, '500000', 'MASRAF AL RAYAN', '', '00012129', '', 0, NULL, NULL, 'CV100106VT', 2, '19TH PA', 'BEING 19TH INVESTMENT FROM ALB. MASRAF CHQ.#00012129 DT: 02.11.2023', NULL, NULL, 0);
INSERT INTO `crv` VALUES (109, '2023-11-13', 37, 0, '', NULL, '', NULL, NULL, 51, NULL, '2023-11-13', 1, '500', '', '', '', '', 0, NULL, NULL, 'CV100107VT', 2, 'INV-36', 'BEING PAYMENT RECEIVED AGAINST -INV-20231108-36 DT-08.11.2023', NULL, NULL, 0);
INSERT INTO `crv` VALUES (110, '2023-11-14', 37, 0, '', NULL, '', NULL, NULL, 4, NULL, '2023-11-14', 2, '400000', 'MASRAF AL RAYAN', '', '00012146', '', 0, NULL, NULL, 'CV100108VT', 2, '20TH PA', 'BEING 20TH INVESTMENT FROM ALB. MASRAF CHQ.#00012146 DT: 13.11.2023', NULL, NULL, 0);
INSERT INTO `crv` VALUES (111, '2023-11-19', 37, 0, '', NULL, '', NULL, NULL, 52, NULL, '2023-11-19', 1, '500', '', '', '', '', 0, NULL, NULL, 'CV100109VT', 2, 'INV-37', 'BEING PAYMENT RECEIVED AGAISNT INV-20231119-37 DT: 19.11.2023', NULL, NULL, 0);
INSERT INTO `crv` VALUES (112, '2023-11-21', 37, 0, '', NULL, '', NULL, NULL, 14, NULL, '2023-11-21', 2, '15000', 'EMIRATES NBD', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100110VT', 2, 'INV-29', 'BEING PAYMENT AGAINST INV-20231004-29 DT: 04.10.2023 (LIGHT DESIGN)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (113, '2023-11-21', 37, 0, '', NULL, '', NULL, NULL, 4, NULL, '2023-11-21', 2, '300000', 'MASRAF AL RAYAN', '', '00012157', '', 0, NULL, NULL, 'CV100111VT', 2, '21ST PA', 'BEING 21ST INVESTMENT FROM ALB. MASRAF CHQ.#00012157 DT: 16.11.2023', NULL, NULL, 0);
INSERT INTO `crv` VALUES (114, '2023-11-21', 37, 0, '', NULL, '', NULL, NULL, 53, NULL, '2023-11-21', 2, '12583', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100112VT', 2, 'INV-35', 'BEING 50% PAYMENT RECV. AGAINST INV-20231108-35 DT-08.11.2023.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (115, '2023-12-10', 37, 0, '', NULL, '', NULL, NULL, 23, NULL, '2023-12-10', 1, '1900', '', '', '', '', 0, NULL, NULL, 'CV100113VT', 2, 'INV-39', 'BEING PAYMENT RECEIVED AGAINST INV-20231204-39 DT: 04.12.2023', NULL, NULL, 0);
INSERT INTO `crv` VALUES (116, '2023-12-19', 37, 0, '', NULL, '', NULL, NULL, 54, NULL, '2023-12-19', 2, '64485.28', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100114VT', 2, 'ADVANCE', 'BEING 50% ADV. PAYMENT UPON ORDER CONFIRMATION (REF#. PI-1021-202).', NULL, NULL, 0);
INSERT INTO `crv` VALUES (117, '2023-12-20', 37, 0, '', NULL, '', NULL, NULL, 55, NULL, '2023-12-20', 2, '1250', 'CBQ', '', '01004493', '', 0, NULL, NULL, 'CV100115VT', 2, 'INV-40', 'BEING PAYMENT AGAINST - INV-20231217-40 DT-17.12.2023', NULL, NULL, 0);
INSERT INTO `crv` VALUES (118, '2023-12-27', 37, 0, '', NULL, '', NULL, NULL, 44, NULL, '2023-12-27', 2, '6550', 'TRANSFER', '', '', '', 0, NULL, NULL, 'CV100116VT', 2, 'INV-102', 'BEING PAYMENT RECV. AGAINST INV-1020-2023 (LPO#2563).', NULL, NULL, 0);
INSERT INTO `crv` VALUES (119, '2023-12-27', 37, 0, '', NULL, '', NULL, NULL, 54, NULL, '2023-12-27', 2, '23052.87', 'TRANSFER', '', '', '', 0, NULL, NULL, 'CV100117VT', 2, 'PI-1024', 'BEING 50% ADV. PAY AGAINST QT-MHAM-361 (PI.#1024-2023)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (120, '2023-12-28', 37, 0, '', NULL, '', NULL, NULL, 47, NULL, '2023-12-28', 2, '59700', '', '', 'TARNSFER', '', 0, NULL, NULL, 'CV100118VT', 2, 'PI-1018', 'BEING 30% PAYMENT FOR (X-RAY MACHINE) -PO#20230103 &amp; REF.# PI-1018', NULL, NULL, 0);
INSERT INTO `crv` VALUES (121, '2023-12-31', 37, 0, '', NULL, '', NULL, NULL, 6, NULL, '2023-12-31', 2, '50000', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100119VT', 2, 'ON A/C', 'BEING ON A/C PAYMENT RECEIVED FOR PROJ. (CREDITED AS ON 10-12-2023).', NULL, NULL, 0);
INSERT INTO `crv` VALUES (122, '2023-12-31', 37, 0, '', NULL, '', NULL, NULL, 53, NULL, '2023-12-31', 2, '6000', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100120VT', 2, 'PI-1025', 'BEING 100% ADV PAYMENT RECEIVED AGAINST PI-1025-2023 DT-27.12.2023', NULL, NULL, 0);
INSERT INTO `crv` VALUES (123, '2024-01-07', 37, 0, '', NULL, '', NULL, NULL, 4, NULL, '2024-01-07', 2, '300000', 'MASRAF AL RAYAN', '', '00012272', '', 0, NULL, NULL, 'CV100121VT', 2, '22ND PA', 'BEING 22ND INVESTMENT FROM ALB. MASRAF CHQ.#00012272 DT-04.01.2024', NULL, NULL, 0);
INSERT INTO `crv` VALUES (124, '2024-01-10', 37, 0, '', NULL, '', NULL, NULL, 44, NULL, '2024-01-10', 2, '17362.54', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100122VT', 2, 'INV-54', 'BEING FINAL BALANCE PAYMENT FOR INV#20231226-54 (LPO#23/1616).', NULL, NULL, 0);
INSERT INTO `crv` VALUES (125, '2024-01-31', 37, 0, '', NULL, '', NULL, NULL, 44, NULL, '2024-01-31', 2, '3400', '', '', 'BANK TRF', '', 0, NULL, NULL, 'CV100123VT', 2, 'INV-50', 'BEING PAYMENT AGAINST INV-20231226-50 DT: 26.12.2023 (PO/23/2631)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (126, '2024-01-31', 37, 0, '', NULL, '', NULL, NULL, 56, NULL, '2024-01-31', 1, '1970', '', '', '', '', 0, NULL, NULL, 'CV100124VT', 2, 'PI-1002', 'BEING ADV. PAY AGAINST PI-1002-2024 DT:30.01.2024 &amp; LPO-003/24.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (127, '2024-02-04', 37, 0, '', NULL, '', NULL, NULL, 57, NULL, '2024-02-04', 1, '1058', '', '', '', '', 0, NULL, NULL, 'CV100125VT', 2, 'INV-02', 'BEING CASH RECV. AGAINST INV-20240124-02 DT:04.02.2024 (Q-ABDM-457)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (128, '2024-02-08', 37, 0, '', NULL, '', NULL, NULL, 4, NULL, '2024-02-08', 2, '300000', 'MASRAF AL RAYAN', '', '00012344', '', 0, NULL, NULL, 'CV100126VT', 2, '23RD PA', 'BEING 23RD INVETSMENT FROM ALB. MASRAF CHQ.#00012344 DT: 05.02.2024.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (129, '2024-02-08', 37, 0, '', NULL, '', NULL, NULL, 42, NULL, '2024-02-08', 2, '18000', 'QNB', '', 'BANK TRF', '', 0, NULL, NULL, 'CV100127VT', 2, 'PI-1026', 'BEING 100% ADV AGAINST PI-1026-2023 DT: 27.12.2023 (AL MAHA ISLAND)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (130, '2024-02-14', 37, 0, '', NULL, '', NULL, NULL, 58, NULL, '2024-02-14', 1, '1000', '', '', '', '', 0, NULL, NULL, 'CV100128VT', 2, 'INV-04', 'BEING CASH REC AGNST INV-20240224-04 DT-11.02.2024 (CCTV INSPECTION).', NULL, NULL, 0);
INSERT INTO `crv` VALUES (131, '2024-02-15', 37, 0, '', NULL, '', NULL, NULL, 59, NULL, '2024-02-15', 2, '9000', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100129VT', 2, 'INV-01', 'BEING TRF REC AGAINST INV-20240124-01 (PO-11016)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (132, '2024-02-18', 37, 0, '', NULL, '', NULL, NULL, 58, NULL, '2024-02-18', 1, '2000', '', '', '', '', 0, NULL, NULL, 'CV100130VT', 2, 'INV-05', 'BEING CASH RECEIVED AGAINST INV:20240224-05 DT: 15.02.2024.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (133, '2024-02-18', 37, 0, '', NULL, '', NULL, NULL, 40, NULL, '2024-02-18', 2, '57000', 'DOHA BANK', '', '01003439', '', 0, NULL, NULL, 'CV100131VT', 2, 'PI-1022', 'BEING FINAL 20% BAL PAY. PO-3955 (RCT VALID AFTER CHEQ REALISATION)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (134, '2024-02-21', 37, 0, '', NULL, '', NULL, NULL, 53, NULL, '2024-02-21', 2, '12583', 'CBQ', '', '01000085', '', 0, NULL, NULL, 'CV100132VT', 2, 'INV-35', 'BEING BALANCE PAYMENT RECV. AGAINST INV#20231108-35 DT.08.11.2023.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (135, '2024-02-21', 37, 0, '', NULL, '', NULL, NULL, 4, NULL, '2024-02-21', 2, '400000', 'MASRAF AL RAYAN', '', '00012401', '', 0, NULL, NULL, 'CV100133VT', 2, '24TH PA', 'BEING 24TH INVESTMENT FROM ALB. MASRAF CHEQ: 00012401 DT:20.02.2024', NULL, NULL, 0);
INSERT INTO `crv` VALUES (136, '2024-02-25', 37, 0, '', NULL, '', NULL, NULL, 48, NULL, '2024-02-25', 1, '3000', '', '', '', '', 0, NULL, NULL, 'CV100134VT', 2, 'INV-63', 'BEING CASH RECV. AGAINST INV-20240224-63 DT: 22.02.2024 (QT-ABDM-496)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (137, '2024-02-28', 37, 0, '', NULL, '', NULL, NULL, 60, NULL, '2024-02-28', 2, '8670', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100135VT', 2, 'INV-30', 'BEING PAYMENT RECV. AGAINST INV-20231004-30 DT: 04.10.2023 (PO-189-1)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (138, '2024-03-05', 37, 0, '', NULL, '', NULL, NULL, 57, NULL, '2024-03-05', 1, '4000', '', '', '', '', 0, NULL, NULL, 'CV100136VT', 2, 'INV-64', 'BEING CASH ECV. AGNST INV-20240224-64 DT: 02.03.2024 (QT_496-26R1)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (139, '2024-03-05', 37, 0, '', NULL, '', NULL, NULL, 4, NULL, '2024-03-05', 2, '250000', 'MASRAF AL RAYAN', '', '00012476', '', 0, NULL, NULL, 'CV100137VT', 2, '25TH IN', 'BEING 25TH INVESTMENT FROM ALB. MASRAF CHEQ: 00012476 DT: 04.03.2024.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (140, '2024-03-10', 37, 0, '', NULL, '', NULL, NULL, 61, NULL, '2024-03-10', 2, '2929', 'QIB', '', '00000307', '', 0, NULL, NULL, 'CV100138VT', 2, 'ADV', 'BEING 100% ADV AGAINST LPO-DAR-000004-1 DT: 25.02.2024.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (141, '2024-03-12', 37, 0, '', NULL, '', NULL, NULL, 4, NULL, '2024-03-12', 2, '500000', 'MASRAF AL RAYAN', '', '00012480', '', 0, NULL, NULL, 'CV100139VT', 2, '26TH IN', 'BEING 26TH INVESTMENT FROM ALB. MASRAF CHEQ.00012480 DT: 06.03.2024.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (142, '2024-03-18', 37, 0, '', NULL, '', NULL, NULL, 62, NULL, '2024-03-18', 2, '2929', 'QIB', '', '00001132', '', 0, NULL, NULL, 'CV100140VT', 2, 'TGM-23-', 'BEING PAYMENT RECVD. AGAINST PO-THG-000023-1 DT: 25.02.2024', NULL, NULL, 0);
INSERT INTO `crv` VALUES (143, '2024-03-24', 37, 0, '', NULL, '', NULL, NULL, 63, NULL, '2024-03-24', 2, '39700', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100141VT', 2, 'ADVANCE', 'BEING 20% ADV PAYMENT AGAINST PO-21246 DT: 22.02.2024 (Q-455_R.4)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (144, '2024-03-26', 37, 0, '', NULL, '', NULL, NULL, 6, NULL, '2024-03-26', 2, '100000', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100142VT', 2, 'ADVANCE', 'BEING 1ST ADV PMT AGAINST QT: Q-HU-516-202402-29 R.1 DT:04.03.2024.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (145, '2024-03-31', 37, 0, '', NULL, '', NULL, NULL, 4, NULL, '2024-03-31', 2, '800000', 'MASRAF AL RAYAN', '', '00012515', '', 0, NULL, NULL, 'CV100143VT', 2, '27TH IN', 'BEING 27TH INVESTMENT FROM ALB. MASRAF CHEQ.00012515 DT:26.03.2024', NULL, NULL, 0);
INSERT INTO `crv` VALUES (146, '2024-04-07', 37, 0, '', NULL, '', NULL, NULL, 63, NULL, '2024-04-07', 2, '59550', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100144VT', 2, 'ADVANCE', 'BEING 30% (2ND) PAYMENT AGNST PO-21246 DT: 22.02.2024 (Q-455R.4).', NULL, NULL, 0);
INSERT INTO `crv` VALUES (147, '2024-04-07', 37, 0, '', NULL, '', NULL, NULL, 64, NULL, '2024-04-07', 2, '23550', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100145VT', 2, 'ADVANCE', 'BEING 19.96% ADV PAYMENT AGAINST PO- 279 DT: 19.03.2024 (QT-458.R3).', NULL, NULL, 0);
INSERT INTO `crv` VALUES (148, '2024-04-07', 37, 0, '', NULL, '', NULL, NULL, 42, NULL, '2024-04-07', 2, '15000', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100146VT', 2, 'ADVANCE', 'BEING 100% ADV PAYMENT AGAINST PI-1044-2024 (QT-PM-161 DT.02.04.2024)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (149, '2024-04-07', 37, 0, '', NULL, '', NULL, NULL, 65, NULL, '2024-04-07', 2, '2929', 'QNB', '', '00001080', '', 0, NULL, NULL, 'CV100147VT', 2, 'MZI-01-', 'BEING 100% ADV AGAINST PO-MZI-000001-1 DT: 25.02.2024 (QT-AEE-498)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (150, '2024-04-18', 37, 0, '', NULL, '', NULL, NULL, 66, NULL, '2024-04-18', 1, '3', '', '', '', '', 0, NULL, NULL, 'CV100148VT', 2, 'REFUND', 'BEING CASH REFUND AGAINST CHEQ.01000501 DT: 25.03.2024', NULL, NULL, 0);
INSERT INTO `crv` VALUES (151, '2024-04-18', 37, 0, '', NULL, '', NULL, NULL, 53, NULL, '2024-04-18', 1, '750', '', '', '', '', 0, NULL, NULL, 'CV100149VT', 2, 'PI-1047', 'BEING CASH RECEIVED AGAINST PI-1047-2024  DT-17.04.2024 (Q-LSH-264).', NULL, NULL, 0);
INSERT INTO `crv` VALUES (152, '2024-04-22', 37, 0, '', NULL, '', NULL, NULL, 67, NULL, '2024-04-22', 2, '2929', 'DUKHAN BANK', '', '00004698', '', 0, NULL, NULL, 'CV100150VT', 2, 'ADV', 'BEING 100% ADV AGAINST LPO NO-00160 DT: 25.02.2024. QT RF: AEE-498.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (153, '2024-04-25', 37, 0, '', NULL, '', NULL, NULL, 28, NULL, '2024-04-25', 2, '5000', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100151VT', 2, 'PI-1035', 'BEING FINAL PAYMENT AGNST QT_210-R1 REF:PI-1035-2024 DT: 28.02.2024.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (154, '2024-04-30', 37, 0, '', NULL, '', NULL, NULL, 6, NULL, '2024-04-30', 2, '11605', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100152VT', 2, '18TH PA', 'BEING FINAL PAYMENT AGAINST - SOUND SYSTEMS ORDER (HIDE CLUB)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (155, '2024-05-05', 37, 0, '', NULL, '', NULL, NULL, 4, NULL, '2024-05-05', 2, '150000', 'MASRAF AL RAYAN', '', '00012589', '', 0, NULL, NULL, 'CV100153VT', 2, '28TH IN', 'BEING 28TH INVESTMENT FROM ALB. MASRAF CHEQ. 00012589 DT: 28.04.2024', NULL, NULL, 0);
INSERT INTO `crv` VALUES (156, '2024-05-14', 37, 0, '', NULL, '', NULL, NULL, 68, NULL, '2024-05-14', 2, '32759', 'CBQ', '', '01001546', '', 0, NULL, NULL, 'CV100154VT', 2, 'PI-1050', 'BEING 50% ADV. PAYMENT AGAINST PO/0620 DT: 09.05.2024 (PI-1050).', NULL, NULL, 0);
INSERT INTO `crv` VALUES (157, '2024-05-19', 37, 0, '', NULL, '', NULL, NULL, 63, NULL, '2024-05-19', 2, '99250', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100155VT', 2, 'BALANCE', 'BEING 50% BAL. PAYMENT AGNST PO-21246 / INV-20240423-74 DT: 23.04.24.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (158, '2024-06-06', 37, 0, '', NULL, '', NULL, NULL, 51, NULL, '2024-06-06', 1, '500', '', '', '', '', 0, NULL, NULL, 'CV100156VT', 2, 'INV-82', 'BEING CASH RECEIVED AGAINST INV-20240602-82 DT-02.06.2024', NULL, NULL, 0);
INSERT INTO `crv` VALUES (159, '2024-06-06', 37, 0, '', NULL, '', NULL, NULL, 54, NULL, '2024-06-06', 2, '87538.15', '', '', 'BANK TRF', '', 0, NULL, NULL, 'CV100157VT', 2, 'FINAL P', 'BEING FINAL BAL. PAYMENT AGAINST INV-20240306-65 &amp; 66.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (160, '2024-06-06', 37, 0, '', NULL, '', NULL, NULL, 32, NULL, '2024-06-06', 2, '200000', '', '', 'BANK TRF', '', 0, NULL, NULL, 'CV100158VT', 2, 'INV - 4', 'BEING PARTIAL PAYMENT AGAINST INV-20221231-4 DT-31.12.2022 (UDC TOWER', NULL, NULL, 0);
INSERT INTO `crv` VALUES (161, '2024-06-10', 37, 0, '', NULL, '', NULL, NULL, 69, NULL, '2024-06-10', 2, '50000', '', '', '01117434', '', 0, NULL, NULL, 'CV100159VT', 2, 'ADVANCE', 'BEING 1ST ADVANCE PAYMENT FOR AL MEERA PROJECT (HS-I24004/00012-REV01', NULL, NULL, 0);
INSERT INTO `crv` VALUES (162, '2024-06-12', 37, 0, '', NULL, '', NULL, NULL, 68, NULL, '2024-06-12', 2, '32759', '', '', '01001703', '', 0, NULL, NULL, 'CV100160VT', 2, 'FINAL', 'BEING FINAL PAYMENT AGAINST PO#/0620 DT.09.05.2024.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (163, '2024-06-30', 37, 0, '', NULL, '', NULL, NULL, 4, NULL, '2024-06-30', 2, '250000', '', '', '00012863', '', 0, NULL, NULL, 'CV100161VT', 2, '32ND IN', 'BEING 32 INVESTMENT IN VENTUM. MASRAF CHEQ,#00012863 DT: 26.06.2024', NULL, NULL, 0);
INSERT INTO `crv` VALUES (164, '2024-06-30', 37, 0, '', NULL, '', NULL, NULL, 32, NULL, '2024-06-30', 2, '75252', '', '', 'BANK TRF', '', 0, NULL, NULL, 'CV100162VT', 2, 'INV - 4', 'BEING PARTIAL PAYMENT AGAINST INV-20221231-4 DT-31.12.2022 (UDC TOWER', NULL, NULL, 0);
INSERT INTO `crv` VALUES (165, '2024-07-03', 37, 0, '', NULL, '', NULL, NULL, 4, NULL, '2024-07-03', 2, '300000', 'MASRAF AL RAYAN', '', '00012674', '', 0, NULL, NULL, 'CV100163VT', 2, '29TH IN', 'BEING 29TH INVESTMENT IN VENTUM. MASRAF CHEQ,#00012674 DT: 22.05.2024', NULL, NULL, 0);
INSERT INTO `crv` VALUES (166, '2024-07-03', 37, 0, '', NULL, '', NULL, NULL, 4, NULL, '2024-07-03', 2, '200000', 'MASRAF AL RAYAN', '', '00012678', '', 0, NULL, NULL, 'CV100164VT', 2, '30TH IN', 'BEING 30TH INVESTMENT IN VENTUM. MASRAF CHEQ,#00012678 DT: 26.05.2024', NULL, NULL, 0);
INSERT INTO `crv` VALUES (167, '2024-07-03', 37, 0, '', NULL, '', NULL, NULL, 4, NULL, '2024-07-03', 2, '250000', 'MASRAF AL RAYAN', '', '00012630', '', 0, NULL, NULL, 'CV100165VT', 2, '31ST', 'BEING 31ST INVESTMENT IN VENTUM. MASRAF CHEQ,#00012630 DT: 05.05.2024', NULL, NULL, 0);
INSERT INTO `crv` VALUES (168, '2024-07-08', 37, 0, '', NULL, '', NULL, NULL, 44, NULL, '2024-07-08', 2, '144438.5', '', '', 'BNK TRANSFER', '', 0, NULL, NULL, 'CV100166VT', 2, 'ADVANCE', '50% ADV PAYMENT FOR LED VIDEO WALL (PO-24/3567 DT: 24.03.2024)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (169, '2024-07-08', 37, 0, '', NULL, '', NULL, NULL, 10, NULL, '2024-07-08', 1, '500', '', '', '', '', 0, NULL, NULL, 'CV100167VT', 2, 'INV-83', 'BEING SERVICES CHARGES FOR SOUND SYSTEMS CHECKING 20240611-83', NULL, NULL, 0);
INSERT INTO `crv` VALUES (170, '2024-07-15', 37, 0, '', NULL, '', NULL, NULL, 58, NULL, '2024-07-15', 1, '3000', '', '', '', '', 0, NULL, NULL, 'CV100168VT', 2, 'INV-84', 'BEING CASH RECEIVED AGAINST INV-20240714-84 DT-14.07.2024.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (171, '2024-07-21', 37, 0, '', NULL, '', NULL, NULL, 47, NULL, '2024-07-21', 2, '162190', '', '', 'BANK TRANSFER', '', 0, NULL, NULL, 'CV100169VT', 2, 'PI-1017', 'BEING PAYMENT RECV AGNST PI-1017-2023 (LPO-220/2023) TENDER-134/2023.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (172, '2024-07-23', 37, 0, '', NULL, '', NULL, NULL, 70, NULL, '2024-07-23', 2, '1250', '', '', 'BANK TRANSFER', '', 0, NULL, NULL, 'CV100170VT', 2, 'INV-87', 'BEING PAYMENT RECV. AGAINST INV-20240721-87 DT: 21.07.2024', NULL, NULL, 0);
INSERT INTO `crv` VALUES (173, '2024-07-23', 37, 0, '', NULL, '', NULL, NULL, 64, NULL, '2024-07-23', 2, '94350', '', '', 'BANK TRANSFER', '', 0, NULL, NULL, 'CV100171VT', 2, 'PO-279', 'BEING PMT RECV FOR INV#20240625-85 FOR DJ &amp; MIC EQUIP DELIVERY-OMAN.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (174, '2024-07-23', 37, 0, '', NULL, '', NULL, NULL, 32, NULL, '2024-07-23', 2, '200000', '', '', 'BANK TRANSFER', '', 0, NULL, NULL, 'CV100172VT', 2, 'WO/570', '1ST ADV PAYMENT INV-20240506-79 (FOR UDC MUSIC SYSTEM PROJECT).', NULL, NULL, 0);
INSERT INTO `crv` VALUES (175, '2024-07-23', 37, 0, '', NULL, '', NULL, NULL, 47, NULL, '2024-07-23', 2, '162190', '', '', 'BANK TRANSFER', '', 0, NULL, NULL, 'CV100173VT', 2, 'TEN-134', '2ND ADV PAY FOR VISCERALS PROJECT PI#1028-2024 (LPO-220/2023)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (176, '2024-07-24', 37, 0, '', NULL, '', NULL, NULL, 32, NULL, '2024-07-24', 2, '200000', '', '', 'BANK TRANSFER', '', 0, NULL, NULL, 'CV100174VT', 2, 'WO/570', '2ND ADV PAYMENT FOR INV-20240506-79 (UDC MUSIC SYSTEM PROJECT).', NULL, NULL, 0);
INSERT INTO `crv` VALUES (177, '2024-07-25', 37, 0, '', NULL, '', NULL, NULL, 32, NULL, '2024-07-25', 2, '200000', '', '', 'BANK TRANSFER', '', 0, NULL, NULL, 'CV100175VT', 2, 'WO/570', 'BEING 3RD PAYMENT FOR INV-20240506-79 (UDC MUSIC SYSTEM PROJECT).', NULL, NULL, 0);
INSERT INTO `crv` VALUES (178, '2024-08-01', 37, 0, '', NULL, '', NULL, NULL, 32, NULL, '2024-08-01', 2, '116500', '', '', 'BANK TRANSFER', '', 0, NULL, NULL, 'CV100176VT', 2, 'WO/570', 'BEING 4TH PAYMENT FOR INV-20240506-79 (UDC MUSIC SYSTEM PROJECT).', NULL, NULL, 0);
INSERT INTO `crv` VALUES (179, '2024-08-01', 37, 0, '', NULL, '', NULL, NULL, 69, NULL, '2024-08-01', 2, '82800', 'CBQ', '', '01118027', '', 0, NULL, NULL, 'CV100177VT', 2, 'I24004', 'BEING PAYMENT RECVD AGAINST PI-1056-2024 (LOI-HS-I24004/00012-REV1)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (180, '2024-08-01', 37, 0, '', NULL, '', NULL, NULL, 28, NULL, '2024-08-01', 2, '2720', '', '', 'BANK TRANSFER', '', 0, NULL, NULL, 'CV100178VT', 2, 'INV-89', 'BEING PAYMENT RECEIVED AGAINST INV-20240730-89 DT: 30.07.2024.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (181, '2024-08-18', 37, 0, '', NULL, '', NULL, NULL, 63, NULL, '2024-08-18', 2, '2400', '', '', 'BANK TRANFER', '', 0, NULL, NULL, 'CV100179VT', 2, 'INV-75', 'BEING PMT REC.AGAINST 2 INV&#039;S-20240423-75 &amp; 76 (PO REF:24315 &amp; 25245)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (182, '2024-09-04', 37, 0, '', NULL, '', NULL, NULL, 4, NULL, '2024-09-04', 2, '400000', 'MASRAF AL RAYAN', '', '00012985', '', 0, NULL, NULL, 'CV100180VT', 2, '33RD IN', 'BEING 33RD INVESTMENT FROM ALB. MASRAF CHQ.#00012985 DT: 29.08.2024', NULL, NULL, 0);
INSERT INTO `crv` VALUES (183, '2024-09-05', 37, 0, '', NULL, '', NULL, NULL, 44, NULL, '2024-09-05', 2, '121935.8', '', '', 'BANK TRANSFER', '', 0, NULL, NULL, 'CV100181VT', 2, 'PO3567', 'BEING PYMT REC. AGNST INV-1051 &amp; 1052 (PO/24/3567 &amp; PO/24/4053).', NULL, NULL, 0);
INSERT INTO `crv` VALUES (184, '2024-09-05', 37, 0, '', NULL, '', NULL, NULL, 47, NULL, '2024-09-05', 2, '324380', '', '', 'BANK TRANSFER', '', 0, NULL, NULL, 'CV100182VT', 2, 'PO-220', 'BEING 20% ADV PYMT AGAINST PO-220/2023, PI_1029-2024(TENDER-134/2023)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (185, '2024-09-05', 37, 0, '', NULL, '', NULL, NULL, 47, NULL, '2024-09-05', 2, '162190', '', '', 'BANK TRANSFER', '', 0, NULL, NULL, 'CV100183VT', 2, 'PO-220', 'BEING 10% PYMT AGAINST PO-220/2023, PI_1039-2024(TENDER-134/2023).', NULL, NULL, 0);
INSERT INTO `crv` VALUES (186, '2024-09-05', 37, 0, '', NULL, '', NULL, NULL, 57, NULL, '2024-09-05', 1, '1496', '', '', '', '', 0, NULL, NULL, 'CV100184VT', 2, 'INV-96', 'BEING CASH RECV. AGAINST INV_20240902-96 DT: 03.09.2024 (Q-ABDM-761)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (187, '2024-09-10', 37, 0, '', NULL, '', NULL, NULL, 23, NULL, '2024-09-10', 1, '1000', '', '', '', '', 0, NULL, NULL, 'CV100185VT', 2, 'INV-97', 'BEING CASH RECV. AGAINST INV-20240908-97 DT: 08.09.2024.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (188, '2024-09-12', 37, 0, '', NULL, '', NULL, NULL, 32, NULL, '2024-09-12', 2, '194918.53', '', '', 'BANK TRANSFER', '', 0, NULL, NULL, 'CV100186VT', 2, 'WO/570', 'BEING PMT RECV. AGT INV-20240831-98 DT: 31.08.2024 (UDC MUSIC SYS)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (189, '2024-09-17', 37, 0, '', NULL, '', NULL, NULL, 4, NULL, '2024-09-17', 2, '500000', 'QIB', '', '697494', '', 0, NULL, NULL, 'CV100187VT', 2, '34TH IN', 'BEING 34TH INVESTMENT FROM ALB. QIB 697494 DT: 16.09.2024.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (190, '2024-09-18', 37, 0, '', NULL, '', NULL, NULL, 71, NULL, '2024-09-18', 2, '4443', '', '', 'BANK TRF', '', 0, NULL, NULL, 'CV100188VT', 2, 'L/1086', 'BEING PYMT RECV. AGAINST INV-20240818-93 DT: 18.08.2024 / L/1086/2024', NULL, NULL, 0);
INSERT INTO `crv` VALUES (191, '2024-09-24', 37, 0, '', NULL, '', NULL, NULL, 72, NULL, '2024-09-24', 2, '20856.54', 'QIIB', '', '00006539', '', 0, NULL, NULL, 'CV100189VT', 2, 'PI-1059', 'BEING PAYMENT AGAINST PI-1059-2024 DT:23.09.2024 (PO-SW00481/24)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (192, '2024-09-25', 37, 0, '', NULL, '', NULL, NULL, 51, NULL, '2024-09-25', 2, '4543', '', '', 'BANK TRF', '', 0, NULL, NULL, 'CV100190VT', 2, 'INV-100', 'BEING PMT RECV. AGAINST INV-20240909-100 DT: 23.09.2024', NULL, NULL, 0);
INSERT INTO `crv` VALUES (193, '2024-09-26', 37, 0, '', NULL, '', NULL, NULL, 69, NULL, '2024-09-26', 2, '288678.91', 'CBQ', '', '01118574', '', 0, NULL, NULL, 'CV100191VT', 2, 'I24004', 'BEING PAYMENT RECVD. AGAINST PI-1057-2024 (LOI-HS-I24004/00012-REV1).', NULL, NULL, 0);
INSERT INTO `crv` VALUES (194, '2024-09-30', 37, 0, '', NULL, '', NULL, NULL, 73, NULL, '2024-09-30', 2, '9000', 'MASRAF AL RAYAN', '', '00003300', '', 0, NULL, NULL, 'CV100192VT', 2, 'QA-791', 'BEING 20% ADVANCE PMT AGAINST QT.791-202409-24 / PI#1060-24', NULL, NULL, 0);
INSERT INTO `crv` VALUES (195, '2024-10-01', 37, 0, '', NULL, '', NULL, NULL, 74, NULL, '2024-10-01', 2, '677195', '', '', 'BANK TRF', '', 0, NULL, NULL, 'CV100193VT', 2, 'INV-94', 'BEING PAYMENT RECV AGAINST INV-20240819-94 / TENDER NO-H-150-24.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (196, '2024-10-03', 37, 0, '', NULL, '', NULL, NULL, 75, NULL, '2024-10-03', 1, '750', '', '', '', '', 0, NULL, NULL, 'CV100194VT', 2, 'INV-92', 'BEING CASH RECEIVED AGAINST INV-20240811-92 DT: 11.08.2024.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (197, '2024-10-07', 37, 0, '', NULL, '', NULL, NULL, 76, NULL, '2024-10-07', 2, '249200', '', '', 'BNK TRF', '', 0, NULL, NULL, 'CV100195VT', 2, 'PI-1061', 'BEING 40% ADV PAYMENT PI-1061-2024 DT-02.10.2024/ PO-FMBP 2024-4623.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (198, '2024-10-08', 37, 0, '', NULL, '', NULL, NULL, 32, NULL, '2024-10-08', 2, '42375', '', '', 'BNK TRF', '', 0, NULL, NULL, 'CV100196VT', 2, 'INV-99', 'BEING PAYMENT RECEIVED AGAINST INV-20240930-99 DT: 30.09.2024.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (199, '2024-10-08', 37, 0, '', NULL, '', NULL, NULL, 77, NULL, '2024-10-08', 2, '995000.27', '', '', 'BNK TRF', '', 0, NULL, NULL, 'CV100197VT', 2, 'PI-1058', 'BEING 50% ADV RECV AGAINST PO-30021803 DT: 14.08.2024 /PI-1058-2024.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (200, '2024-10-08', 37, 0, '', NULL, '', NULL, NULL, 53, NULL, '2024-10-08', 1, '1320', '', '', '', '', 0, NULL, NULL, 'CV100198VT', 2, 'INV-103', 'BEING PYMT RECV AGINST INVOICE INV-20241007-103. DT.07.10.2024.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (201, '2024-10-10', 37, 0, '', NULL, '', NULL, NULL, 43, NULL, '2024-10-10', 2, '31709', 'CBQ', '', '01011757', '', 0, NULL, NULL, 'CV100199VT', 2, 'QT-272', 'BEING PARTIAL PAYMENT FOR PDS4 LICENSE CENTRO MALL PROJECT', NULL, NULL, 0);
INSERT INTO `crv` VALUES (202, '2024-10-10', 37, 0, '', NULL, '', NULL, NULL, 53, NULL, '2024-10-10', 1, '1320', '', '', '', '', 0, NULL, NULL, 'CV100200VT', 2, 'INV-104', 'BEING PAYMENT AGAINST INV#20241007-104 DT.08.10.2024.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (203, '2024-10-14', 37, 0, '', NULL, '', NULL, NULL, 47, NULL, '2024-10-14', 2, '94525', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100201VT', 2, 'XRAY', 'BEING FINAL PAYMENT FOR X-RAY MACHINE - 20230103', '2025-02-20 19:34:42', NULL, 0);
INSERT INTO `crv` VALUES (204, '2024-10-14', 37, 0, '', NULL, '', NULL, NULL, 71, NULL, '2024-10-14', 2, '61028.87', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100202VT', 2, 'MOI', 'BEING FINAL PAYMENT AGAINST INV#20240825-95.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (205, '2024-10-14', 37, 0, '', NULL, '', NULL, NULL, 47, NULL, '2024-10-14', 2, '19521', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100203VT', 2, 'GAC', 'BEING PAYMENT RECEIVED AGAINST INV#20241006-101', '2025-02-20 19:34:45', NULL, 0);
INSERT INTO `crv` VALUES (206, '2024-10-14', 37, 0, '', NULL, '', NULL, NULL, 78, NULL, '2024-10-14', 2, '2781081.06', '', '', 'TRANSFE', '', 0, NULL, NULL, 'CV100204VT', 2, 'IPPA', 'BEING PARTIAL PAYMENT AGAINST INV#20240731-90', NULL, NULL, 0);
INSERT INTO `crv` VALUES (207, '2024-10-20', 37, 0, '', NULL, '', NULL, NULL, 31, NULL, '2024-10-20', 2, '5000', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100205VT', 2, 'QT.834', 'BEING ADVANCE PAYMENT FOR VT-001-834-SBD-QUO-00003-REV.000', NULL, NULL, 0);
INSERT INTO `crv` VALUES (208, '2024-10-20', 37, 0, '', NULL, '', NULL, NULL, 79, NULL, '2024-10-20', 1, '900', '', '', '', '', 0, NULL, NULL, 'CV100206VT', 2, 'REFUND', 'BEING REFUND RECEIVED AGAINST INV.9979 FOR WINDOWS LICENSE CANCEL.', '2025-02-20 19:34:47', NULL, 0);
INSERT INTO `crv` VALUES (209, '2024-10-20', 37, 0, '', NULL, '', NULL, NULL, 23, NULL, '2024-10-20', 1, '929', '', '', '', '', 0, NULL, NULL, 'CV100207VT', 2, 'QT.851', 'BEING PMT RECEIVED AGAINST INV#20241020-106 FOR REMOVE CCTV', NULL, NULL, 0);
INSERT INTO `crv` VALUES (210, '2024-10-31', 37, 0, '', NULL, '', NULL, NULL, 31, NULL, '2024-10-31', 2, '2100', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100208VT', 2, '1069', 'ADVANCE PAYMENT - AGAINST PI#1069-2024 FOR REPAIR LED MODULES', NULL, NULL, 0);
INSERT INTO `crv` VALUES (211, '2024-10-31', 37, 0, '', NULL, '', NULL, NULL, 73, NULL, '2024-10-31', 2, '12600', 'MASRAF ALRAYAN', '', '00003327', '', 0, NULL, NULL, 'CV100209VT', 2, '791', 'BEING 30% ADVANCE AGAINST PI#1071. INTERACTIVE DISPLAY INSTALLATION', NULL, NULL, 0);
INSERT INTO `crv` VALUES (212, '2024-11-06', 37, 0, '', NULL, '', NULL, NULL, 80, NULL, '2024-11-06', 1, '5000', '', '', '', '', 0, NULL, NULL, 'CV100210VT', 2, 'ADJ', 'SALARY ADJUSTMENT FOR THE MONTH OF OCT 2024.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (213, '2024-11-10', 37, 0, '', NULL, '', NULL, NULL, 81, NULL, '2024-11-10', 2, '2550000', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100211VT', 2, '1ST ADV', 'BEING 20% ADVANCE FOR HIA EXPANSION PROJECT.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (214, '2024-11-10', 37, 0, '', NULL, '', NULL, NULL, 73, NULL, '2024-11-10', 2, '20400', 'MASRAF AL RAYAN', '', '00003328', '', 0, NULL, NULL, 'CV100212VT', 2, 'LACAS', 'BEING FINAL PAYMENT FOR INTERACTIVE SCREEN INSTALLATION', NULL, NULL, 0);
INSERT INTO `crv` VALUES (215, '2024-11-14', 37, 0, '', NULL, '', NULL, NULL, 54, NULL, '2024-11-14', 2, '4450', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100213VT', 2, 'Q#272', 'BEING 50% ADVANCE PMT AGAINST VT-001-272-SBD-VQU-00001', NULL, NULL, 0);
INSERT INTO `crv` VALUES (216, '2024-11-17', 37, 0, '', NULL, '', NULL, NULL, 69, NULL, '2024-11-17', 2, '206979.92', 'CBQ', '', '01119000', '', 0, NULL, NULL, 'CV100214VT', 2, '1240024', 'BEING PART PAYMENT RECV. AGAINST INV-20241009-105 DT:09.10.2024.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (217, '2024-11-28', 37, 0, '', NULL, '', NULL, NULL, 80, NULL, '2024-11-28', 1, '5000', '', '', '', '', 0, NULL, NULL, 'CV100215VT', 2, 'SALARY', 'BEING SALARY ADJUSTMENT FOR THE MONTH OF NOV 2024', NULL, NULL, 0);
INSERT INTO `crv` VALUES (218, '2024-12-03', 37, 0, '', NULL, '', NULL, NULL, 78, NULL, '2024-12-03', 2, '1000000', '', '', 'BANK TRANSFER', '', 0, NULL, NULL, 'CV100216VT', 2, 'IPPA', 'BEING PARTIAL PAYMENT AGAINST INV-20240731-90 DT: 11.07.2024', NULL, NULL, 0);
INSERT INTO `crv` VALUES (219, '2024-12-09', 37, 0, '', NULL, '', NULL, NULL, 82, NULL, '2024-12-09', 2, '27000', 'CBQ', '', '01000078', '', 0, NULL, NULL, 'CV100217VT', 2, '043', 'BEING ADVANCE PAYMENT AGAINST PO#043-2024 FOR SHISHA LOUNGE', NULL, NULL, 0);
INSERT INTO `crv` VALUES (220, '2024-12-11', 37, 0, '', NULL, '', NULL, NULL, 6, NULL, '2024-12-11', 2, '50000', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100218VT', 2, 'JFF', 'BEING PARTIAL OUTSTANDING PAYMENT FOR PROJECT.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (221, '2024-12-17', 37, 0, '', NULL, '', NULL, NULL, 78, NULL, '2024-12-17', 2, '2012837.82', '', '', 'TRF', '', 0, NULL, NULL, 'CV100219VT', 2, 'IPPA', 'BEING PAYMENT FOR INV#20240731-90.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (222, '2024-12-23', 37, 0, '', NULL, '', NULL, NULL, 77, NULL, '2024-12-23', 2, '796000.21', '', '', 'BANK TRANSFER', '', 0, NULL, NULL, 'CV100220VT', 2, 'PI-1064', 'BEING 40% ADV PAYMENT RECEIVED AGAISNT PO-30021803 /PI-1064-2024.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (223, '2024-12-24', 37, 0, '', NULL, '', NULL, NULL, 83, NULL, '2024-12-24', 2, '2000000', 'QNB', '', '0000027', '', 0, NULL, NULL, 'CV100221VT', 2, 'INVEST', 'BEING FUNDS TRF FROM VTSS TO VT TRADING FOR UPCOMING PROJECT EXPENSES', NULL, NULL, 0);
INSERT INTO `crv` VALUES (224, '2024-12-26', 37, 0, '', NULL, '', NULL, NULL, 69, NULL, '2024-12-26', 2, '87316.4', 'CBQ', '', '01119464', '', 0, NULL, NULL, 'CV100222VT', 2, 'INV-110', 'BEING PMT RECVD. AGAINST INV-20241009-110 (LOI-HS-I24004/00012-REV01.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (225, '2025-01-05', 37, 0, '', NULL, '', NULL, NULL, 80, NULL, '2025-01-05', 1, '5000', '', '', '', '', 0, NULL, NULL, 'CV100223VT', 2, 'SALARY', 'BEING SALARY ADJUSTMENT FOR THE MONTH OF DEC 2024.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (226, '2025-01-09', 37, 0, '', NULL, '', NULL, NULL, 84, NULL, '2025-01-09', 2, '10200', '', '', 'TRANSFER', '', 0, NULL, NULL, 'CV100224VT', 2, 'ADV', 'BEING 50% PMT FOR INV#118 DT.23.12.24 &amp; 50% ADV FOR LPO#2025-31 DT.07', NULL, NULL, 0);
INSERT INTO `crv` VALUES (227, '2025-01-12', 37, 0, '', NULL, '', NULL, NULL, 4, NULL, '2025-01-12', 2, '500000', 'AHLI BANK', '', 'BANK  TRANSFER', '', 0, NULL, NULL, 'CV100225VT', 2, '35TH IN', 'BEING 35TH INVESTMENT FROM AL BORAQ AHLI BANK (REF: AB-A-24-229).', NULL, NULL, 0);
INSERT INTO `crv` VALUES (228, '2025-01-13', 37, 0, '', NULL, '', NULL, NULL, 44, NULL, '2025-01-13', 2, '28887.7', '', '', 'BANK TRANSFER', '', 0, NULL, NULL, 'CV100226VT', 2, 'INV-106', 'BEING FINAL PAYMENT AGAINST PO/24/3567. INVOICE-1063-2024.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (229, '2025-01-14', 37, 0, '', NULL, '', NULL, NULL, 82, NULL, '2025-01-14', 1, '20000', '', '', '', '', 0, NULL, NULL, 'CV100227VT', 2, '043', '2ND ADVANCE PMT AGAINST PO#43/2024.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (230, '2025-01-19', 37, 0, '', NULL, '', NULL, NULL, 85, NULL, '2025-01-19', 2, '368427.41', '', '', 'BANK TRANSFER', '', 0, NULL, NULL, 'CV100228VT', 2, 'PI-1004', 'BEING 100% PAYMENT AGAINST PO. HI-PO-001-25 DT: 15.01.2025 (PI-1004)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (231, '2025-01-26', 37, 0, '', NULL, '', NULL, NULL, 47, NULL, '2025-01-26', 2, '19900', '', '', 'BANK TRANSFER', '', 0, NULL, NULL, 'CV100229VT', 2, 'XRAY', 'FINAL PAYMENT FOR XRAY BAGGAGE SCANNER-PO#20230103 DT.23.08.2023.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (232, '2025-01-26', 37, 0, '', NULL, '', NULL, NULL, 31, NULL, '2025-01-26', 2, '750', '', '', 'BANK TRANSFER', '', 0, NULL, NULL, 'CV100230VT', 2, 'PI-1005', 'BEING PAYMENT RECEIVED. AGAINST PI-1005/25 DT:21.01.2025(OUTDOOR LED)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (233, '2025-01-26', 37, 0, '', NULL, '', NULL, NULL, 86, NULL, '2025-01-26', 1, '4224', '', '', '', '', 0, NULL, NULL, 'CV100231VT', 2, 'INV-108', 'BEING CASH RECV. AGAINST INV-20241021-108 DT: 21.10.2024 (PROF. SERV)', NULL, NULL, 0);
INSERT INTO `crv` VALUES (234, '2025-01-28', 37, 0, '', NULL, '', NULL, NULL, 85, NULL, '2025-01-28', 2, '17130.63', '', '', 'BANK TRANSFER', '', 0, NULL, NULL, 'CV100232VT', 2, 'ADV', 'BEING 100% ADV. PAYMENT AGAINST QUOTE#VT-001-0000-SBD-QUO-00001', NULL, NULL, 0);
INSERT INTO `crv` VALUES (235, '2025-01-28', 37, 0, '', NULL, '', NULL, NULL, 77, NULL, '2025-01-28', 2, '199000.05', '', '', 'BANK TRANSFER', '', 0, NULL, NULL, 'CV100233VT', 2, '1092', 'BEING FINAL PAYMENT FOR LPO#30021803 /  PI-1092-2024 DT: 05.12.2024.', '2025-02-20 19:34:11', NULL, 0);
INSERT INTO `crv` VALUES (236, '2025-01-29', 37, 0, '', NULL, '', NULL, NULL, 69, NULL, '2025-01-29', 2, '176548.02', 'CBQ', '', '01119730', '', 0, NULL, NULL, 'CV100234VT', 2, '1240024', '4TH PROGRESSIVE PMT FOR AL MEERA PROJECT.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (237, '2025-02-04', 37, 0, '', NULL, '', NULL, NULL, 85, NULL, '2025-02-04', 2, '17377.57', '', '', 'BANK TRANSFER', '', 0, NULL, NULL, 'CV100235VT', 2, 'INV-135', 'BEING PARTIAL PAYMENT RECVD. AGAINST INV-20250130-135 DT: 30.01.2025.', NULL, NULL, 0);
INSERT INTO `crv` VALUES (238, '2025-02-09', 37, 0, '', NULL, '', NULL, NULL, 87, NULL, '2025-02-09', 1, '47400', '', '', '', '', 0, NULL, NULL, 'CV100236VT', 2, '114', 'BEING 50% ADVANCE AGAINST PO#2025-114 FOR CHINGARI RESTAURANT', NULL, NULL, 0);
INSERT INTO `crv` VALUES (240, '2025-02-20 19:33:25', 2, 0, '', NULL, '', NULL, 0, 2, 'AMIRI GUARD', '2025-02-20', 3, '345.54', '', '', '', '', 1, NULL, NULL, 'CV100237VT', 2, '1234567890ABCD', 'xfsdfgds', '2025-02-20 20:15:23', NULL, 0);
INSERT INTO `crv` VALUES (241, '2025-02-12', 37, 0, '', NULL, '', NULL, NULL, 76, NULL, '2025-02-12', 2, '186900', '', '', 'BANK TRANSFER', '', 0, NULL, NULL, 'CV100237VT', 2, 'PI-1079', 'BEING 30% PMT UPON PRIOR SHIPPING. PI-1079-2024 / PO-FMBP-2024-4623.', '2025-02-20 19:34:08', NULL, 0);
INSERT INTO `crv` VALUES (242, '2025-02-20 20:18:05', 2, 0, '', NULL, '', NULL, 0, 1, 'LULWA SALMAN J D DARWISH', '2025-02-20', 1, '2344.67', '', '', '', '', 0, NULL, NULL, 'CV100238VT', 2, 'test 123', 'asd asd asd asd asd asd asd asd asd ', '2025-02-20 20:18:07', NULL, 0);

-- ----------------------------
-- Table structure for crv_print_logs
-- ----------------------------
DROP TABLE IF EXISTS `crv_print_logs`;
CREATE TABLE `crv_print_logs`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `crv_id` int NULL DEFAULT NULL,
  `type` int NULL DEFAULT NULL,
  `print_copy` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 55 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of crv_print_logs
-- ----------------------------
INSERT INTO `crv_print_logs` VALUES (1, '2025-02-18 16:40:41', 37, 0, '', NULL, '', NULL, 239, 1, 0);
INSERT INTO `crv_print_logs` VALUES (2, '2025-02-20 19:33:56', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (3, '2025-02-20 19:34:08', 2, 0, '', NULL, '', NULL, 239, 1, 0);
INSERT INTO `crv_print_logs` VALUES (4, '2025-02-20 19:34:11', 2, 0, '', NULL, '', NULL, 235, 1, 0);
INSERT INTO `crv_print_logs` VALUES (5, '2025-02-20 19:34:42', 2, 0, '', NULL, '', NULL, 203, 1, 0);
INSERT INTO `crv_print_logs` VALUES (6, '2025-02-20 19:34:45', 2, 0, '', NULL, '', NULL, 205, 1, 0);
INSERT INTO `crv_print_logs` VALUES (7, '2025-02-20 19:34:47', 2, 0, '', NULL, '', NULL, 208, 1, 0);
INSERT INTO `crv_print_logs` VALUES (8, '2025-02-20 19:34:52', 2, 0, '', NULL, '', NULL, 3, 1, 0);
INSERT INTO `crv_print_logs` VALUES (9, '2025-02-20 19:34:54', 2, 0, '', NULL, '', NULL, 6, 1, 0);
INSERT INTO `crv_print_logs` VALUES (10, '2025-02-20 19:34:58', 2, 0, '', NULL, '', NULL, 9, 1, 0);
INSERT INTO `crv_print_logs` VALUES (11, '2025-02-20 19:35:03', 2, 0, '', NULL, '', NULL, 34, 1, 0);
INSERT INTO `crv_print_logs` VALUES (12, '2025-02-20 19:35:20', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (13, '2025-02-20 19:36:10', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (14, '2025-02-20 19:40:06', 2, 0, '', NULL, '', NULL, 34, 1, 0);
INSERT INTO `crv_print_logs` VALUES (15, '2025-02-20 19:40:09', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (16, '2025-02-20 19:40:43', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (17, '2025-02-20 19:41:15', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (18, '2025-02-20 19:48:07', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (19, '2025-02-20 19:48:24', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (20, '2025-02-20 19:49:05', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (21, '2025-02-20 19:50:00', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (22, '2025-02-20 19:53:08', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (23, '2025-02-20 19:53:09', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (24, '2025-02-20 19:53:10', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (25, '2025-02-20 19:53:31', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (26, '2025-02-20 19:53:44', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (27, '2025-02-20 19:53:45', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (28, '2025-02-20 19:53:45', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (29, '2025-02-20 19:54:03', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (30, '2025-02-20 19:54:27', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (31, '2025-02-20 19:54:28', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (32, '2025-02-20 19:54:40', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (33, '2025-02-20 19:55:10', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (34, '2025-02-20 19:55:24', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (35, '2025-02-20 19:55:41', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (36, '2025-02-20 19:55:42', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (37, '2025-02-20 19:57:24', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (38, '2025-02-20 19:57:29', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (39, '2025-02-20 19:57:50', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (40, '2025-02-20 19:57:52', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (41, '2025-02-20 19:57:56', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (42, '2025-02-20 19:57:57', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (43, '2025-02-20 19:57:58', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (44, '2025-02-20 19:57:58', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (45, '2025-02-20 19:59:00', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (46, '2025-02-20 20:13:09', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (47, '2025-02-20 20:13:12', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (48, '2025-02-20 20:13:18', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (49, '2025-02-20 20:15:11', 2, 0, '', NULL, '', NULL, 34, 1, 0);
INSERT INTO `crv_print_logs` VALUES (50, '2025-02-20 20:15:14', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (51, '2025-02-20 20:15:15', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (52, '2025-02-20 20:15:18', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (53, '2025-02-20 20:15:23', 2, 0, '', NULL, '', NULL, 240, 1, 0);
INSERT INTO `crv_print_logs` VALUES (54, '2025-02-20 20:18:07', 2, 0, '', NULL, '', NULL, 242, 1, 0);

-- ----------------------------
-- Table structure for employee
-- ----------------------------
DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `last_name` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `first_name` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `middle_name` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `department_id` int NOT NULL,
  `designation_id` int NOT NULL,
  `birth_date` date NULL DEFAULT NULL,
  `gender` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `contact_no` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `address` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dc` date NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  `employee_number` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `deleted_by` int NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `rate` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `basic_amount` float(11, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of employee
-- ----------------------------

-- ----------------------------
-- Table structure for error_logging
-- ----------------------------
DROP TABLE IF EXISTS `error_logging`;
CREATE TABLE `error_logging`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `filename` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `error_dt` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  `line_number` int NULL DEFAULT NULL,
  `attended` int NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of error_logging
-- ----------------------------
INSERT INTO `error_logging` VALUES (1, 'ParseError', 'syntax error, unexpected token \"use\"', '/ventum/receipt/crv_records', '2025-02-18 11:37:45', 0, 424, 0);
INSERT INTO `error_logging` VALUES (2, '404', 'The page you requested was not found.', '/ventum/receipt_print/print_receipt/239/CV100237VT', '2025-02-18 11:40:21', 0, 0, 0);
INSERT INTO `error_logging` VALUES (3, '404', 'The page you requested was not found.', '/ventum/assets/themes/select2/select2-spinner.gif', '2025-05-29 15:06:15', 0, 0, 0);

-- ----------------------------
-- Table structure for fm_account_receivable
-- ----------------------------
DROP TABLE IF EXISTS `fm_account_receivable`;
CREATE TABLE `fm_account_receivable`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ds` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dc` date NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_account_receivable
-- ----------------------------
INSERT INTO `fm_account_receivable` VALUES (1, '400001070', 'A/R-Project Materials', '2024-04-24', 2);
INSERT INTO `fm_account_receivable` VALUES (2, '4000001201', 'A/R-Manpower', '2024-04-24', 2);
INSERT INTO `fm_account_receivable` VALUES (3, '4000007082', 'A/R-Assets', '2024-04-24', 2);

-- ----------------------------
-- Table structure for fm_adjustments_types
-- ----------------------------
DROP TABLE IF EXISTS `fm_adjustments_types`;
CREATE TABLE `fm_adjustments_types`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ds` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dc` date NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_adjustments_types
-- ----------------------------
INSERT INTO `fm_adjustments_types` VALUES (1, 'Returns and Damaged Goods', 'Returns and Damaged Goods', '2023-12-27', 2);
INSERT INTO `fm_adjustments_types` VALUES (2, 'Physical Count Discrepancies', 'Physical Count Discrepancies', '2023-12-27', 2);
INSERT INTO `fm_adjustments_types` VALUES (3, 'Obsolete or Expired Items', 'Obsolete or Expired Items', '2023-12-27', 2);
INSERT INTO `fm_adjustments_types` VALUES (4, 'Write-offs', 'Write-offs', '2023-12-27', 2);
INSERT INTO `fm_adjustments_types` VALUES (5, 'Seasonal Adjustments', 'Seasonal Adjustments', '2023-12-27', 2);

-- ----------------------------
-- Table structure for fm_cash_control_account
-- ----------------------------
DROP TABLE IF EXISTS `fm_cash_control_account`;
CREATE TABLE `fm_cash_control_account`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ds` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dc` date NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_cash_control_account
-- ----------------------------
INSERT INTO `fm_cash_control_account` VALUES (1, '40000006085', 'Cash on Hand (Main)', '2024-04-24', 2);
INSERT INTO `fm_cash_control_account` VALUES (2, '400008426', 'Cash Control - Labor', '2024-04-24', 2);
INSERT INTO `fm_cash_control_account` VALUES (3, '400008722', 'Cash Control - Project', '2024-04-24', 2);

-- ----------------------------
-- Table structure for fm_classification
-- ----------------------------
DROP TABLE IF EXISTS `fm_classification`;
CREATE TABLE `fm_classification`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ds` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dc` date NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_classification
-- ----------------------------
INSERT INTO `fm_classification` VALUES (1, 'Class1', 'Class1', '2022-06-22', 2);
INSERT INTO `fm_classification` VALUES (2, 'Class2', 'Class2', '2022-06-22', 2);
INSERT INTO `fm_classification` VALUES (3, '', '', '2022-12-19', 2);
INSERT INTO `fm_classification` VALUES (4, 'n/a', 'n/a', '2022-12-19', 2);

-- ----------------------------
-- Table structure for fm_client_category
-- ----------------------------
DROP TABLE IF EXISTS `fm_client_category`;
CREATE TABLE `fm_client_category`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ds` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dc` date NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_client_category
-- ----------------------------
INSERT INTO `fm_client_category` VALUES (1, 'Prospect Client', 'These are potential clients who have shown interest in your products or services but have not yet made a purchase.', '2023-09-02', 2);
INSERT INTO `fm_client_category` VALUES (2, 'Current Client', 'These are clients who are currently active and have ongoing business with your company. They have made at least one purchase or engaged in your services.', '2023-09-02', 2);
INSERT INTO `fm_client_category` VALUES (3, 'Inactive Client', 'These are clients who were once active but have not engaged with your business for a certain period. They might need re-engagement efforts.', '2023-09-02', 2);
INSERT INTO `fm_client_category` VALUES (4, 'Lost Client', 'These are clients who were previously active but are no longer doing business with your company. They might be considered lost opportunities.', '2023-09-02', 2);
INSERT INTO `fm_client_category` VALUES (5, 'VIP Client', 'These are high-value clients who generate significant revenue for your business. They might receive special treatment or offers.', '2023-09-02', 2);
INSERT INTO `fm_client_category` VALUES (6, 'New Client', 'These are clients who have recently joined your client base but have not yet engaged in significant business.', '2023-09-02', 2);
INSERT INTO `fm_client_category` VALUES (7, 'Pending Client', 'These are clients whose status is pending due to some specific action or verification.', '2023-09-02', 2);

-- ----------------------------
-- Table structure for fm_client_document_type
-- ----------------------------
DROP TABLE IF EXISTS `fm_client_document_type`;
CREATE TABLE `fm_client_document_type`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ds` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dc` date NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_client_document_type
-- ----------------------------
INSERT INTO `fm_client_document_type` VALUES (1, 'Contract', 'Contract', '2024-04-25', 2);
INSERT INTO `fm_client_document_type` VALUES (2, 'Registration', 'Registration', '2024-04-25', 2);
INSERT INTO `fm_client_document_type` VALUES (3, 'ID', 'ID', '2024-04-25', 2);
INSERT INTO `fm_client_document_type` VALUES (4, 'Proposal', 'Proposal', '2024-04-25', 2);

-- ----------------------------
-- Table structure for fm_client_progress_status
-- ----------------------------
DROP TABLE IF EXISTS `fm_client_progress_status`;
CREATE TABLE `fm_client_progress_status`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ds` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dc` date NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_client_progress_status
-- ----------------------------
INSERT INTO `fm_client_progress_status` VALUES (1, 'Lead', 'This status can be assigned to clients who have shown initial interest but haven\'t progressed beyond the lead stage.', '2023-09-02', 2);
INSERT INTO `fm_client_progress_status` VALUES (2, 'Contacted', 'Indicates that your team has made initial contact with the client, possibly through a phone call, email, or meeting.', '2023-09-02', 2);
INSERT INTO `fm_client_progress_status` VALUES (3, 'Meeting Scheduled', 'This status can be used when a meeting is scheduled with the client to discuss their needs or potential solutions.', '2023-09-02', 2);
INSERT INTO `fm_client_progress_status` VALUES (4, 'Proposal Sent', 'Shows that a formal proposal or quote has been sent to the client for their consideration.', '2023-09-02', 2);
INSERT INTO `fm_client_progress_status` VALUES (5, 'Follow-up Required', 'Clients in this status may need additional follow-up or clarification before they can move forward.', '2023-09-02', 2);
INSERT INTO `fm_client_progress_status` VALUES (6, 'Negotiation', 'Pending Approval', '2023-09-02', 2);
INSERT INTO `fm_client_progress_status` VALUES (7, 'Deal Signed', 'This status signifies that the deal has been successfully signed or the client has made a commitment.', '2023-09-02', 2);
INSERT INTO `fm_client_progress_status` VALUES (8, 'Waiting for Payment', 'Clients who have agreed to the deal but haven\'t made the payment yet.', '2023-09-02', 2);
INSERT INTO `fm_client_progress_status` VALUES (9, 'On Hold', 'Sometimes, clients might put projects on hold for various reasons. This status can be used to track such cases.', '2023-09-02', 2);
INSERT INTO `fm_client_progress_status` VALUES (10, 'Closed - Won', 'Indicates successful sales or project closure.', '2023-09-02', 2);
INSERT INTO `fm_client_progress_status` VALUES (11, 'Closed - Lost', 'Clients who decided not to move forward with your offer.', '2023-09-02', 2);
INSERT INTO `fm_client_progress_status` VALUES (12, 'Inactive', 'Clients who were once active but haven\'t responded or engaged for an extended period.', '2023-09-02', 2);
INSERT INTO `fm_client_progress_status` VALUES (13, 'Completed', 'For clients who have received the service or product and the project is completed.', '2023-09-02', 2);

-- ----------------------------
-- Table structure for fm_currency_rate
-- ----------------------------
DROP TABLE IF EXISTS `fm_currency_rate`;
CREATE TABLE `fm_currency_rate`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ds` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dc` date NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  `currency_symbol` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_currency_rate
-- ----------------------------
INSERT INTO `fm_currency_rate` VALUES (1, 'QAR', '1.000000', '2023-09-03', 2, 'QAR');
INSERT INTO `fm_currency_rate` VALUES (2, 'USD', '4.521300', '2023-09-03', 2, '$');
INSERT INTO `fm_currency_rate` VALUES (3, 'EUR', '5.320011', '2023-09-03', 2, '€');
INSERT INTO `fm_currency_rate` VALUES (4, 'UK', '6.43211', '2023-09-03', 2, '£');

-- ----------------------------
-- Table structure for fm_currency_type
-- ----------------------------
DROP TABLE IF EXISTS `fm_currency_type`;
CREATE TABLE `fm_currency_type`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ds` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dc` date NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  `vs_peso_rate` float(11, 8) NULL DEFAULT NULL,
  `is_peso` int NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_currency_type
-- ----------------------------
INSERT INTO `fm_currency_type` VALUES (7, 'PHP', 'Philippine Peso', '2022-06-22', 2, 1.00000000, 1);
INSERT INTO `fm_currency_type` VALUES (8, 'USD', 'US Dollar', '2022-12-23', 2, 54.44510269, 0);
INSERT INTO `fm_currency_type` VALUES (9, 'JPY', 'Japanese Yen', '2022-06-22', 2, 0.56822211, 0);

-- ----------------------------
-- Table structure for fm_debit_credit_type
-- ----------------------------
DROP TABLE IF EXISTS `fm_debit_credit_type`;
CREATE TABLE `fm_debit_credit_type`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ds` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dc` date NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_debit_credit_type
-- ----------------------------
INSERT INTO `fm_debit_credit_type` VALUES (1, 'NAPS', 'NAPS', '2024-04-24', 2);
INSERT INTO `fm_debit_credit_type` VALUES (2, 'VISA', 'VISA ', '2024-04-24', 2);
INSERT INTO `fm_debit_credit_type` VALUES (3, 'MASTER CARD', 'MASTER CARD', '2024-04-24', 2);

-- ----------------------------
-- Table structure for fm_delivery_place
-- ----------------------------
DROP TABLE IF EXISTS `fm_delivery_place`;
CREATE TABLE `fm_delivery_place`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ds` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dc` date NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_delivery_place
-- ----------------------------
INSERT INTO `fm_delivery_place` VALUES (12, 'JGM Philippines inc', 'JGM Philippines inc', '2022-05-30', 2);
INSERT INTO `fm_delivery_place` VALUES (13, 'Warehouse 1', 'Warehouse 1', '2022-05-30', 2);

-- ----------------------------
-- Table structure for fm_department
-- ----------------------------
DROP TABLE IF EXISTS `fm_department`;
CREATE TABLE `fm_department`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ds` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dc` date NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  `pr1` int NULL DEFAULT NULL,
  `pr2` int NULL DEFAULT NULL,
  `pr3` int NULL DEFAULT NULL,
  `po1` int NULL DEFAULT NULL,
  `po2` int NULL DEFAULT NULL,
  `po3` int NULL DEFAULT NULL,
  `pr_auto_approved` int NULL DEFAULT 0,
  `po_auto_approved` int NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_department
-- ----------------------------
INSERT INTO `fm_department` VALUES (1, 'MIS', 'IT Department', '2017-05-22', 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0);
INSERT INTO `fm_department` VALUES (2, 'Accounting', 'Accounting', '2017-05-22', 2, 2, 0, 8, 0, 8, 0, 1, 1);
INSERT INTO `fm_department` VALUES (3, 'HR', 'Human Resource', '2017-06-18', 2, 14, 16, 0, 2, 0, 0, 1, 1);
INSERT INTO `fm_department` VALUES (4, 'Production', 'Production', '2017-06-20', 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0);
INSERT INTO `fm_department` VALUES (5, 'Purchasing', 'Purchasing Department', '2017-06-20', 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0);
INSERT INTO `fm_department` VALUES (6, 'Warehouse', 'Warehouse', '2017-06-20', 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0);
INSERT INTO `fm_department` VALUES (7, 'Admin', 'Admin', '2017-06-20', 2, 11, 12, 0, 0, 0, 0, 1, 0);
INSERT INTO `fm_department` VALUES (8, 'Sales', 'Sales', '2023-06-08', 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0);
INSERT INTO `fm_department` VALUES (9, 'Design', 'Design', '2023-06-08', 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0);

-- ----------------------------
-- Table structure for fm_designation
-- ----------------------------
DROP TABLE IF EXISTS `fm_designation`;
CREATE TABLE `fm_designation`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ds` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dc` date NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_designation
-- ----------------------------
INSERT INTO `fm_designation` VALUES (3, 'Web Developer', 'PHP developer, web application\'s', '2017-05-22', 2);
INSERT INTO `fm_designation` VALUES (4, 'Accountant', 'Accounting Staff', '2017-05-22', 2);
INSERT INTO `fm_designation` VALUES (5, 'Department Manager', 'Department Manager', '2023-01-11', 2);

-- ----------------------------
-- Table structure for fm_foreign_charges
-- ----------------------------
DROP TABLE IF EXISTS `fm_foreign_charges`;
CREATE TABLE `fm_foreign_charges`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ds` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dc` date NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_foreign_charges
-- ----------------------------
INSERT INTO `fm_foreign_charges` VALUES (1, 'FREIGHT', 'FREIGHT', '2023-09-03', 2);
INSERT INTO `fm_foreign_charges` VALUES (2, 'HANDLING', 'HANDLING', '2023-09-03', 2);
INSERT INTO `fm_foreign_charges` VALUES (3, 'DOCUMENTATION', 'DOCUMENTATION', '2023-09-03', 2);
INSERT INTO `fm_foreign_charges` VALUES (4, 'INSURANCE', 'INSURANCE', '2023-09-03', 2);
INSERT INTO `fm_foreign_charges` VALUES (5, 'OTHERS', 'OTHERS', '2023-09-03', 2);
INSERT INTO `fm_foreign_charges` VALUES (6, 'SE FREIGHT', 'SE FREIGHT', '2023-09-03', 2);

-- ----------------------------
-- Table structure for fm_grv_transport
-- ----------------------------
DROP TABLE IF EXISTS `fm_grv_transport`;
CREATE TABLE `fm_grv_transport`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ds` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dc` date NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_grv_transport
-- ----------------------------
INSERT INTO `fm_grv_transport` VALUES (1, 'DHL', 'DHL', '2024-05-15', 2);
INSERT INTO `fm_grv_transport` VALUES (2, 'Talabat Express', 'Talabat Express', '2024-05-15', 2);

-- ----------------------------
-- Table structure for fm_local_charges
-- ----------------------------
DROP TABLE IF EXISTS `fm_local_charges`;
CREATE TABLE `fm_local_charges`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ds` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dc` date NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_local_charges
-- ----------------------------
INSERT INTO `fm_local_charges` VALUES (1, 'FREIGHT', 'FREIGHT', '2023-09-03', 2);
INSERT INTO `fm_local_charges` VALUES (2, 'HANDLING', 'HANDLING', '2023-09-03', 2);
INSERT INTO `fm_local_charges` VALUES (3, 'CLEARING', 'CLEARING', '2023-09-03', 2);
INSERT INTO `fm_local_charges` VALUES (4, 'TRANSPORT', 'TRANSPORT', '2023-09-03', 2);
INSERT INTO `fm_local_charges` VALUES (5, 'BANK', 'BANK', '2023-09-03', 2);
INSERT INTO `fm_local_charges` VALUES (6, 'DEMMURRAGE', 'DEMMURRAGE', '2023-09-03', 2);
INSERT INTO `fm_local_charges` VALUES (7, 'CUSTOMS DUTIES', 'CUSTOMS DUTIES', '2023-09-03', 2);
INSERT INTO `fm_local_charges` VALUES (8, 'CUSTOM CLEARANCE & DOCS', 'CUSTOM CLEARANCE & DOCS', '2023-09-03', 2);

-- ----------------------------
-- Table structure for fm_manpower
-- ----------------------------
DROP TABLE IF EXISTS `fm_manpower`;
CREATE TABLE `fm_manpower`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ds` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dc` date NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_manpower
-- ----------------------------
INSERT INTO `fm_manpower` VALUES (1, 'Projects Manager', '1200', '2023-09-11', 2);
INSERT INTO `fm_manpower` VALUES (2, 'Deputy Commissioning Manager', '800', '2023-09-11', 2);
INSERT INTO `fm_manpower` VALUES (3, 'Commissioning engineer', '650', '2023-09-11', 2);
INSERT INTO `fm_manpower` VALUES (4, 'Projects Engineer', '750', '2023-09-11', 2);
INSERT INTO `fm_manpower` VALUES (5, 'Maintenance Engineer', '650', '2023-09-11', 2);
INSERT INTO `fm_manpower` VALUES (6, 'Document Controller', '350', '2023-09-11', 2);
INSERT INTO `fm_manpower` VALUES (7, 'Installation Supervisor', '350', '2023-09-11', 2);
INSERT INTO `fm_manpower` VALUES (8, 'HSE Manager', '350', '2023-09-11', 2);
INSERT INTO `fm_manpower` VALUES (9, 'HSE Officer', '400', '2023-09-11', 2);
INSERT INTO `fm_manpower` VALUES (10, 'Draftsman', '200', '2023-09-11', 2);
INSERT INTO `fm_manpower` VALUES (11, 'Installation Technician (8 technician for 150 days)', '200', '2023-09-11', 2);
INSERT INTO `fm_manpower` VALUES (12, 'Installation Helper (8 Helpers for 150 days)', '200', '2023-09-11', 2);
INSERT INTO `fm_manpower` VALUES (13, 'Driver', '200', '2023-09-11', 2);
INSERT INTO `fm_manpower` VALUES (14, 'Maintenance Technician', '200', '2023-09-11', 2);

-- ----------------------------
-- Table structure for fm_manufacturers
-- ----------------------------
DROP TABLE IF EXISTS `fm_manufacturers`;
CREATE TABLE `fm_manufacturers`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ds` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dc` date NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_manufacturers
-- ----------------------------

-- ----------------------------
-- Table structure for fm_models
-- ----------------------------
DROP TABLE IF EXISTS `fm_models`;
CREATE TABLE `fm_models`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ds` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dc` date NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  `year_model` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_models
-- ----------------------------

-- ----------------------------
-- Table structure for fm_project_status
-- ----------------------------
DROP TABLE IF EXISTS `fm_project_status`;
CREATE TABLE `fm_project_status`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ds` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dc` date NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_project_status
-- ----------------------------
INSERT INTO `fm_project_status` VALUES (1, 'Quotation', 'For Quotation Only', '2023-03-17', 2);
INSERT INTO `fm_project_status` VALUES (2, 'In Progress', 'Projects that are in progress', '2023-03-17', 2);
INSERT INTO `fm_project_status` VALUES (3, 'Finished', 'Finished Project', '2023-04-14', 2);

-- ----------------------------
-- Table structure for inventory
-- ----------------------------
DROP TABLE IF EXISTS `inventory`;
CREATE TABLE `inventory`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `item_code` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `item_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `qty` int NULL DEFAULT 0,
  `added_from` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `unit_cost_price` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0',
  `unit_price` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0',
  `old_unit_cost_price` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0',
  `old_qty` int NULL DEFAULT 0,
  `receiving_history` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `issuance_history` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `manufacturer_price` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC STATS_AUTO_RECALC = 1;

-- ----------------------------
-- Records of inventory
-- ----------------------------
INSERT INTO `inventory` VALUES (1, '2025-05-29 20:05', 2, 0, '', NULL, '', NULL, '2345345', 'test part 1', 0, 'po', '0', '0', '0', 0, NULL, NULL, NULL);
INSERT INTO `inventory` VALUES (2, '2025-05-29 20:05', 2, 0, '', NULL, '', NULL, '65663345', 'test part 2', 0, 'po', '0', '0', '0', 0, NULL, NULL, NULL);
INSERT INTO `inventory` VALUES (3, '2025-05-29 20:05', 2, 0, '', NULL, '', NULL, '00978', 'test23', 0, 'po', '0', '0', '0', 0, NULL, NULL, NULL);
INSERT INTO `inventory` VALUES (4, '2025-05-29 20:10', 2, 0, '', NULL, '', NULL, '8789056435', 'sdfsdf gare', 0, 'po', '0', '0', '0', 0, NULL, NULL, NULL);
INSERT INTO `inventory` VALUES (5, '2025-05-29 20:10', 2, 0, '', NULL, '', NULL, '5675890006', 'tres ret 809', 0, 'po', '0', '0', '0', 0, NULL, NULL, NULL);
INSERT INTO `inventory` VALUES (6, '2025-05-29 20:10', 2, 0, '', NULL, '', NULL, '7800787', 'test desc', 0, 'po', '0', '0', '0', 0, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for inventory_adjustments
-- ----------------------------
DROP TABLE IF EXISTS `inventory_adjustments`;
CREATE TABLE `inventory_adjustments`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `remarks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `attachments` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `confirmed` int NULL DEFAULT 0,
  `confirmed_date` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `confirmed_by` int NULL DEFAULT NULL,
  `adjustment_type_id` int NULL DEFAULT NULL,
  `covered_date` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ref_no` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of inventory_adjustments
-- ----------------------------

-- ----------------------------
-- Table structure for inventory_adjustments_items
-- ----------------------------
DROP TABLE IF EXISTS `inventory_adjustments_items`;
CREATE TABLE `inventory_adjustments_items`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `remarks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `adjustment_id` int NULL DEFAULT NULL,
  `adj_qty` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `qty_before` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `qty_after` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `confirmed` int NULL DEFAULT 0,
  `inventory_id` int NULL DEFAULT NULL,
  `unit_cost_price` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of inventory_adjustments_items
-- ----------------------------

-- ----------------------------
-- Table structure for inventory_movement
-- ----------------------------
DROP TABLE IF EXISTS `inventory_movement`;
CREATE TABLE `inventory_movement`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `inventory_id` int NULL DEFAULT NULL,
  `movement_from` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `qty_before` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `qty` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `qty_after` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `addition` int NULL DEFAULT 1,
  `quotation_id` int NULL DEFAULT NULL,
  `ref_id` int NULL DEFAULT NULL,
  `project_id` int NULL DEFAULT NULL,
  `inventory_quotation_id` int NULL DEFAULT NULL,
  `unit_cost_price` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC STATS_AUTO_RECALC = 1;

-- ----------------------------
-- Records of inventory_movement
-- ----------------------------

-- ----------------------------
-- Table structure for inventory_quotation
-- ----------------------------
DROP TABLE IF EXISTS `inventory_quotation`;
CREATE TABLE `inventory_quotation`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `item_code` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `item_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `qty` int NULL DEFAULT 0,
  `quotation_id` int NULL DEFAULT NULL,
  `quotation_location_ids` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `suppliers` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `landed_cost_rate_ids` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `package_ids` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `unit_cost` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_local` int NULL DEFAULT 0,
  `inventory_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC STATS_AUTO_RECALC = 1;

-- ----------------------------
-- Records of inventory_quotation
-- ----------------------------

-- ----------------------------
-- Table structure for inventory_returns
-- ----------------------------
DROP TABLE IF EXISTS `inventory_returns`;
CREATE TABLE `inventory_returns`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `remarks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `confirmed` int NULL DEFAULT 0,
  `return_date` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `confirmed_by` int NULL DEFAULT NULL,
  `issuance_id` int NULL DEFAULT NULL,
  `ref_no` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `confirmed_date` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `project_id` int NULL DEFAULT NULL,
  `client_id` int NULL DEFAULT NULL,
  `job_order_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of inventory_returns
-- ----------------------------

-- ----------------------------
-- Table structure for inventory_returns_items
-- ----------------------------
DROP TABLE IF EXISTS `inventory_returns_items`;
CREATE TABLE `inventory_returns_items`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `remarks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `issuance_id` int NULL DEFAULT NULL,
  `qty` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `qty_before` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `qty_after` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `confirmed` int NULL DEFAULT 0,
  `inventory_id` int NULL DEFAULT NULL,
  `issuance_item_id` int NULL DEFAULT NULL,
  `return_id` int NULL DEFAULT NULL,
  `project_id` int NULL DEFAULT NULL,
  `client_id` int NULL DEFAULT NULL,
  `job_order_id` int NULL DEFAULT NULL,
  `date_issued` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `issued_qty` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of inventory_returns_items
-- ----------------------------

-- ----------------------------
-- Table structure for issuance
-- ----------------------------
DROP TABLE IF EXISTS `issuance`;
CREATE TABLE `issuance`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `ref_no` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `remarks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `project_id` int NULL DEFAULT NULL,
  `issued_date` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `confirmed` int NULL DEFAULT 0,
  `confirmed_date` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `confirmed_by` int NULL DEFAULT NULL,
  `client_id` int NULL DEFAULT NULL,
  `job_order_id` int NULL DEFAULT NULL,
  `quotation_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of issuance
-- ----------------------------

-- ----------------------------
-- Table structure for issuance_items
-- ----------------------------
DROP TABLE IF EXISTS `issuance_items`;
CREATE TABLE `issuance_items`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `project_id` int NULL DEFAULT NULL,
  `quotation_id` int NULL DEFAULT NULL,
  `issuance_id` int NULL DEFAULT NULL,
  `qty` int NULL DEFAULT NULL,
  `remarks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `inventory_id` int NULL DEFAULT NULL,
  `unit_cost_price` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `job_order_id` int NULL DEFAULT NULL,
  `unit_cost_price_orig` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of issuance_items
-- ----------------------------

-- ----------------------------
-- Table structure for landed_cost_rate
-- ----------------------------
DROP TABLE IF EXISTS `landed_cost_rate`;
CREATE TABLE `landed_cost_rate`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `landed_cost_rate` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `conversion_factor` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `freight_percent` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `custom_percent` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `landed_cost_factor` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `currency_symbol` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `local_purchase` int NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of landed_cost_rate
-- ----------------------------
INSERT INTO `landed_cost_rate` VALUES (1, '', NULL, 0, '', NULL, '', NULL, 'EX-WORKS US', '3.64', '8', '5', '4.11320', '$', 0);
INSERT INTO `landed_cost_rate` VALUES (2, '', NULL, 0, '', NULL, '', NULL, 'EX-WORKS EU-USD', '3.64', '8', '5', '4.11320', '$', 0);
INSERT INTO `landed_cost_rate` VALUES (3, '', NULL, 0, '', NULL, '', NULL, 'EX-WORKS EU-EURO', '4.00', '8', '5', '4.52000', '€', 0);
INSERT INTO `landed_cost_rate` VALUES (4, '', NULL, 0, '', NULL, '', NULL, 'EX-WORKS UK', '4.50', '8', '5', '5.08500', '£', 0);
INSERT INTO `landed_cost_rate` VALUES (5, '', NULL, 0, '', NULL, '', NULL, 'EX-WORKS DUBAI-USD', '3.64', '8', '5', '4.11320', '$', 0);
INSERT INTO `landed_cost_rate` VALUES (6, '', NULL, 0, '', NULL, '', NULL, 'EX-WORKS DUBAI', '1.00', '8', '5', '1.13000', 'AED', 0);
INSERT INTO `landed_cost_rate` VALUES (7, '', NULL, 0, '', NULL, '', NULL, 'LOCAL PURCHASE', '1.00', '0', '0', '1.00000', 'QAR', 1);
INSERT INTO `landed_cost_rate` VALUES (8, '', NULL, 0, '', NULL, '', NULL, 'DDP QATAR USD', '3.64', '0', '0', '3.64000', '$', 0);
INSERT INTO `landed_cost_rate` VALUES (9, '', NULL, 0, '', NULL, '', NULL, 'DDP QATAR EURO', '4.00', '0', '0', '4.00000', '€', 0);
INSERT INTO `landed_cost_rate` VALUES (10, '', NULL, 0, '', NULL, '', NULL, 'CNF QATAR AIRPORT-USD', '3.64', '0', '5', '3.82200', '$', 0);
INSERT INTO `landed_cost_rate` VALUES (11, '', NULL, 0, '', NULL, '', NULL, 'CNF QATAR AIRPORT-EURO', '4.00', '0', '5', '4.20000', '€', 0);

-- ----------------------------
-- Table structure for legalization_fees
-- ----------------------------
DROP TABLE IF EXISTS `legalization_fees`;
CREATE TABLE `legalization_fees`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `amount_from` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `amount_to` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `fees` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `percent_of_invoice_val` int NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of legalization_fees
-- ----------------------------
INSERT INTO `legalization_fees` VALUES (1, '', NULL, 0, '', NULL, '', NULL, '1', '15000', '920', 0);
INSERT INTO `legalization_fees` VALUES (2, '', NULL, 0, '', NULL, '', NULL, '15000.01', '100000', '1420', 0);
INSERT INTO `legalization_fees` VALUES (3, '', NULL, 0, '', NULL, '', NULL, '100000.01', '250000', '2920', 0);
INSERT INTO `legalization_fees` VALUES (4, '', NULL, 0, '', NULL, '', NULL, '250000.01', '1000000', '5150', 0);
INSERT INTO `legalization_fees` VALUES (5, '', NULL, 0, '', NULL, '', NULL, '1000000.01', '100000000', '0.006', 1);
INSERT INTO `legalization_fees` VALUES (6, '2023-12-06 18:32:21', 2, 0, '', NULL, '', NULL, '250000.01', '1000000', '5150.11', 0);
INSERT INTO `legalization_fees` VALUES (7, '2023-12-06 18:32:27', 2, 0, '', NULL, '', NULL, '250000.01', '1000000', '5150.00', 0);

-- ----------------------------
-- Table structure for menu_main
-- ----------------------------
DROP TABLE IF EXISTS `menu_main`;
CREATE TABLE `menu_main`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `module_description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `pri` int NULL DEFAULT NULL,
  `font_icon` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `url_link` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `act` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of menu_main
-- ----------------------------
INSERT INTO `menu_main` VALUES (1, 'Admin', NULL, 13, 'fa-star', 'admin/home', 1);
INSERT INTO `menu_main` VALUES (2, 'System Parameters', NULL, 11, 'fa-table', 'admin/file_maintenance', 0);
INSERT INTO `menu_main` VALUES (3, 'Purchasing', NULL, 4, 'fa-file', 'admin/employee', 1);
INSERT INTO `menu_main` VALUES (5, 'Reports', NULL, 9, 'fa-print', 'admin/fixed_asset_transfer', 0);
INSERT INTO `menu_main` VALUES (11, 'Parts Inventory', NULL, 8, 'fa-cubes', NULL, 1);
INSERT INTO `menu_main` VALUES (13, 'Accounts', NULL, 10, 'fa-money', NULL, 0);
INSERT INTO `menu_main` VALUES (15, 'HR', NULL, 8, 'fa-users', NULL, 0);
INSERT INTO `menu_main` VALUES (16, 'Receiving', NULL, 5, 'fa-arrow-down', NULL, 1);
INSERT INTO `menu_main` VALUES (17, 'Customer', NULL, 0, 'fa-users', NULL, 1);
INSERT INTO `menu_main` VALUES (18, 'Issuance', NULL, 6, 'fa-arrow-up', NULL, 1);
INSERT INTO `menu_main` VALUES (19, 'Vehicles', NULL, 3, 'fa-car', NULL, 1);
INSERT INTO `menu_main` VALUES (20, 'Receipt', NULL, 12, 'fa-money', NULL, 1);
INSERT INTO `menu_main` VALUES (21, 'Adjustments', NULL, 7, 'fa-adjust', NULL, 1);

-- ----------------------------
-- Table structure for menu_sub
-- ----------------------------
DROP TABLE IF EXISTS `menu_sub`;
CREATE TABLE `menu_sub`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `module_description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `pri` int NULL DEFAULT NULL,
  `font_icon` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `url_link` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `act` int NULL DEFAULT NULL,
  `main_menu_id` int NULL DEFAULT NULL,
  `border_top` int NULL DEFAULT 0,
  `group_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 143 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of menu_sub
-- ----------------------------
INSERT INTO `menu_sub` VALUES (6, 'Departments', NULL, 1, NULL, 'maintenance/table/department', 1, 15, 0, NULL);
INSERT INTO `menu_sub` VALUES (8, 'System Users', 'List of all administrator user in the system.', 3, NULL, 'home/system_users', 1, 1, 1, 'Administrator Transactions');
INSERT INTO `menu_sub` VALUES (11, 'Inventory Master List', NULL, 1, NULL, 'reports/inventory_masterlist', 0, 5, 0, NULL);
INSERT INTO `menu_sub` VALUES (24, 'Designation', NULL, 2, NULL, 'maintenance/table/designation', 1, 15, 0, NULL);
INSERT INTO `menu_sub` VALUES (25, 'Vendor Master List', NULL, 1, NULL, 'vendor/master_list', 1, 10, 0, NULL);
INSERT INTO `menu_sub` VALUES (30, 'Cutoff', NULL, 1, NULL, 'posting/cutoff', 1, 8, 0, NULL);
INSERT INTO `menu_sub` VALUES (45, 'Backup Databse', NULL, 6, NULL, 'bib/backup_database', 1, 1, 0, NULL);
INSERT INTO `menu_sub` VALUES (50, 'Inventory Masterlist', NULL, 1, NULL, 'inventory/masterlist', 1, 11, 1, 'Inventory');
INSERT INTO `menu_sub` VALUES (52, 'UOM Conversion', NULL, 5, NULL, 'inventory/uom', 0, 11, 0, NULL);
INSERT INTO `menu_sub` VALUES (57, 'Inventory Adjustments', NULL, 6, NULL, 'inventory/adjustments', 0, 11, 0, NULL);
INSERT INTO `menu_sub` VALUES (58, 'Inventory Movements', NULL, 3, NULL, 'reports/inventory_movement', 0, 5, 0, NULL);
INSERT INTO `menu_sub` VALUES (68, 'Upload', NULL, 7, NULL, 'inventory/upload', 0, 11, 0, NULL);
INSERT INTO `menu_sub` VALUES (69, 'Projects', NULL, 3, NULL, 'admin/projects', 1, 13, 0, NULL);
INSERT INTO `menu_sub` VALUES (76, 'Masterlist (Breakdown)', NULL, 2, NULL, 'inventory/inventory_masterlist_breakdown', 0, 11, 0, NULL);
INSERT INTO `menu_sub` VALUES (82, 'Inventory Report', NULL, 2, NULL, 'reports/inventory_report', 0, 5, 0, NULL);
INSERT INTO `menu_sub` VALUES (83, 'Employee', NULL, 4, NULL, 'employee/master_list', 1, 1, 0, NULL);
INSERT INTO `menu_sub` VALUES (84, 'Monitoring Of Materials', NULL, 1, NULL, 'reports/monitoring_of_materials', 1, 5, 0, NULL);
INSERT INTO `menu_sub` VALUES (86, 'Accounts Payable', NULL, 1, NULL, 'accounts/accounts_payable', 1, 13, 0, NULL);
INSERT INTO `menu_sub` VALUES (88, 'P.O. From Supplier Monitoring', NULL, 2, NULL, 'reports/po_supplier_monitoring', 1, 5, 0, NULL);
INSERT INTO `menu_sub` VALUES (89, 'Customer Masterlist', NULL, 1, NULL, 'crm/clients', 1, 17, 1, 'Clients Information');
INSERT INTO `menu_sub` VALUES (92, 'Inventory Monitoring', NULL, 2, NULL, 'inventory/inventory_monitoring', 0, 11, 0, NULL);
INSERT INTO `menu_sub` VALUES (94, 'Inventory - Project', NULL, 3, NULL, 'inventory/inventory_project', 0, 11, 0, NULL);
INSERT INTO `menu_sub` VALUES (95, 'Overhead Cost', NULL, 10, NULL, 'accounts/overhead_cost', 1, 13, 0, NULL);
INSERT INTO `menu_sub` VALUES (96, 'Overhead Cost', NULL, 3, NULL, 'reports/overhead_cost', 1, 5, 0, NULL);
INSERT INTO `menu_sub` VALUES (98, 'Inventory Cost', NULL, 4, NULL, 'inventory/inventory_cost', 0, 11, 0, NULL);
INSERT INTO `menu_sub` VALUES (100, 'Manpower', NULL, 11, NULL, 'reports/manpower', 1, 5, 0, NULL);
INSERT INTO `menu_sub` VALUES (105, 'Purchase Order', NULL, 3, NULL, 'purchasing/po_list', 1, 3, 0, NULL);
INSERT INTO `menu_sub` VALUES (106, 'Create P.O.', NULL, 2, NULL, 'purchasing/create_po', 1, 3, 1, 'Purchase Order Transactions');
INSERT INTO `menu_sub` VALUES (107, 'Confirmed P.O.', NULL, 5, NULL, 'purchasing/confirmed_po', 1, 3, 0, NULL);
INSERT INTO `menu_sub` VALUES (108, 'Create GRV', NULL, 4, NULL, 'receiving/create_receiving', 1, 16, 1, 'Receiving Transactions');
INSERT INTO `menu_sub` VALUES (109, 'GRV Records', NULL, 5, NULL, 'receiving/receiving_records', 1, 16, 0, NULL);
INSERT INTO `menu_sub` VALUES (110, 'Create Sales Order', NULL, 1, NULL, 'outgoing/create_issuance', 1, 18, 1, 'Issueance Transactions');
INSERT INTO `menu_sub` VALUES (111, 'Sales Order Records', NULL, 2, NULL, 'outgoing/issuance_records', 1, 18, 0, NULL);
INSERT INTO `menu_sub` VALUES (114, 'Currency Rates', NULL, 11, NULL, 'maintenance/table/currency_rate', 1, 16, 1, 'System Tables');
INSERT INTO `menu_sub` VALUES (115, 'Foreign Charges Types', NULL, 12, NULL, 'maintenance/table/foreign_charges', 1, 16, 0, NULL);
INSERT INTO `menu_sub` VALUES (116, 'Local Charges Types', NULL, 13, NULL, 'maintenance/table/local_charges', 1, 16, 0, NULL);
INSERT INTO `menu_sub` VALUES (117, 'Confirmed GRV', NULL, 6, NULL, 'receiving/confirmed_receiving_records', 1, 16, 0, NULL);
INSERT INTO `menu_sub` VALUES (118, 'Confirmed Sales Order', NULL, 3, NULL, 'outgoing/confirm_issuance_records', 1, 18, 0, NULL);
INSERT INTO `menu_sub` VALUES (119, 'Vehicle Masterlist', NULL, 1, NULL, 'vehicles/masterlist', 1, 19, 1, NULL);
INSERT INTO `menu_sub` VALUES (122, 'Terms and Condition Temaplates', NULL, 7, NULL, 'purchasing/terms_and_conditions', 1, 3, 1, 'System Tables');
INSERT INTO `menu_sub` VALUES (123, 'Suppliers', NULL, 6, NULL, 'purchasing/supplier_po', 1, 3, 1, 'Supplier Masterfile');
INSERT INTO `menu_sub` VALUES (124, 'Model', NULL, 2, NULL, 'maintenance/table/models', 1, 19, 0, NULL);
INSERT INTO `menu_sub` VALUES (126, 'Manufacturer', NULL, 3, NULL, 'maintenance/table/manufacturers', 1, 19, 0, NULL);
INSERT INTO `menu_sub` VALUES (127, 'Create Stock Adjustments', NULL, 2, NULL, 'inventory/create_stock_adjustments', 1, 21, 1, 'Adjustment Transactions');
INSERT INTO `menu_sub` VALUES (128, 'Stock Adjustments Records', NULL, 3, NULL, 'inventory/stock_adjustments', 1, 21, 0, NULL);
INSERT INTO `menu_sub` VALUES (129, 'Confirmed Stock Adjustments', NULL, 4, NULL, 'inventory/confirmed_stock_adjustments', 1, 21, 0, NULL);
INSERT INTO `menu_sub` VALUES (130, 'Adjustments Types', NULL, 5, NULL, 'maintenance/table/adjustments_types', 1, 21, 1, 'System Tables');
INSERT INTO `menu_sub` VALUES (131, 'Create Return Inventory', NULL, 6, NULL, 'inventory/create_returns', 1, 11, 1, 'Return Inventory Transactions');
INSERT INTO `menu_sub` VALUES (132, 'Return Inventory', NULL, 7, '', 'inventory/return_inventory', 1, 11, 0, NULL);
INSERT INTO `menu_sub` VALUES (133, 'Confirmed Return Inventory', NULL, 8, NULL, 'inventory/confirmed_return_inventory', 1, 11, 0, NULL);
INSERT INTO `menu_sub` VALUES (134, 'Create CRV', NULL, 1, NULL, 'receipt/create_crv', 1, 20, 1, 'Cash Receipt Voucher Transactions');
INSERT INTO `menu_sub` VALUES (135, 'CRV Records', NULL, 2, NULL, 'receipt/crv_records', 1, 20, 0, NULL);
INSERT INTO `menu_sub` VALUES (136, 'Debit/Credit Type', NULL, 4, NULL, 'maintenance/table/debit_credit_type', 1, 20, 1, 'System Tables');
INSERT INTO `menu_sub` VALUES (137, 'Account Receivable G/L Number', NULL, 5, NULL, 'maintenance/table/account_receivable', 0, 20, 0, NULL);
INSERT INTO `menu_sub` VALUES (138, 'Cash Control Account', NULL, 6, NULL, 'maintenance/table/cash_control_account', 0, 20, 0, NULL);
INSERT INTO `menu_sub` VALUES (141, 'GRV Transport', NULL, 20, NULL, 'maintenance/table/grv_transport', 1, 16, 0, NULL);
INSERT INTO `menu_sub` VALUES (142, 'Reports', NULL, 3, NULL, 'receipt/reports', 1, 20, 0, NULL);

-- ----------------------------
-- Table structure for projects
-- ----------------------------
DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `name` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `control_number` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `project_status_id` int NULL DEFAULT NULL,
  `project_category_id` int NULL DEFAULT NULL,
  `selling_price` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `project_ref` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `client_id` int NULL DEFAULT NULL,
  `contact_person` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `contact_number` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `project_manager` int NULL DEFAULT NULL,
  `notes` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `location` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of projects
-- ----------------------------

-- ----------------------------
-- Table structure for projects_documents
-- ----------------------------
DROP TABLE IF EXISTS `projects_documents`;
CREATE TABLE `projects_documents`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `project_id` int NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `attachments` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `document_type_id` int NULL DEFAULT NULL,
  `client_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of projects_documents
-- ----------------------------

-- ----------------------------
-- Table structure for projects_job_order
-- ----------------------------
DROP TABLE IF EXISTS `projects_job_order`;
CREATE TABLE `projects_job_order`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `title` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `quotation_id` int NULL DEFAULT NULL,
  `project_id` int NULL DEFAULT NULL,
  `client_id` int NULL DEFAULT NULL,
  `job_order_number` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of projects_job_order
-- ----------------------------

-- ----------------------------
-- Table structure for projects_job_order_clock_in
-- ----------------------------
DROP TABLE IF EXISTS `projects_job_order_clock_in`;
CREATE TABLE `projects_job_order_clock_in`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `job_order_id` int NULL DEFAULT NULL,
  `employee_id` int NULL DEFAULT NULL,
  `date` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `time_in` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '1',
  `time_out` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `comment` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `loc_in` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `loc_out` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of projects_job_order_clock_in
-- ----------------------------

-- ----------------------------
-- Table structure for projects_job_order_labor
-- ----------------------------
DROP TABLE IF EXISTS `projects_job_order_labor`;
CREATE TABLE `projects_job_order_labor`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `job_order_id` int NULL DEFAULT NULL,
  `quotation_item_id` int NULL DEFAULT NULL,
  `qty` int NULL DEFAULT NULL,
  `remarks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of projects_job_order_labor
-- ----------------------------

-- ----------------------------
-- Table structure for projects_progress
-- ----------------------------
DROP TABLE IF EXISTS `projects_progress`;
CREATE TABLE `projects_progress`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `project_id` int NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `date_cover` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `attachments` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `activity_type_id` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `client_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of projects_progress
-- ----------------------------

-- ----------------------------
-- Table structure for projects_recent
-- ----------------------------
DROP TABLE IF EXISTS `projects_recent`;
CREATE TABLE `projects_recent`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `project_id` int NULL DEFAULT NULL,
  `table` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `date_cover` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ref_id` int NULL DEFAULT NULL,
  `client_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of projects_recent
-- ----------------------------

-- ----------------------------
-- Table structure for purchase_order
-- ----------------------------
DROP TABLE IF EXISTS `purchase_order`;
CREATE TABLE `purchase_order`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `po_number` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `quotation_id` int NULL DEFAULT NULL,
  `project_id` int NULL DEFAULT NULL,
  `supplier_id` int NULL DEFAULT NULL,
  `supplier_email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `reference_no` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `terms_conditions` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `less_desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `less_amount` float(20, 6) NULL DEFAULT NULL,
  `att_to` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `confirmed` int NULL DEFAULT 0,
  `date_confirmed` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `confirmed_by` int NULL DEFAULT NULL,
  `rate_id` int NULL DEFAULT NULL,
  `print_logs` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `exchange_rate` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of purchase_order
-- ----------------------------
INSERT INTO `purchase_order` VALUES (1, '2025-05-29 20:05', 2, 0, '', NULL, '', NULL, 'PO000001', 0, NULL, 1, 'apple@gmail.com', '909874534', 'ttest', '<b><font color=\"#2697de\">Terms &amp; Conditions:&nbsp;</font></b><div><font color=\"#2697de\">1- </font>Invoices to be issued in the name of Ventum Tech Security Systems and Services.&nbsp;</div><div><font color=\"#2697de\">2-</font> Payment Terms: As per agreement&nbsp;</div><div><font color=\"#2697de\">3-</font> Delivery: Immediate&nbsp;</div><div><font color=\"#2697de\">4-</font> If no PO confirmation nor comments/remarks are received within 2 working days from official PO transmittal date, this PO including all its content is considered in effect.&nbsp;&nbsp;</div>', '', 0.000000, 'Mohammad Saleh', 1, '2025-05-29 20:05', 2, 1, NULL, '1.000000');
INSERT INTO `purchase_order` VALUES (2, '2025-05-29 20:10', 2, 0, '', NULL, '', NULL, 'PO000002', 0, NULL, 2, 'laccoustics@mail.com', '9675445345', 'twsad', '<font color=\"#2697de\">T<b>erms &amp; Conditions:&nbsp;</b></font><div>1- Invoices to be issued in the name of Ventum Tech Security Systems and Services.&nbsp;</div><div>2- Payment Terms: As per agreement&nbsp;</div><div>3- Delivery: Immediate&nbsp;</div><div>4- If no PO confirmation nor comments/remarks are received within 2 working days from official PO transmittal date, this PO including all its content is considered in effect.&nbsp;</div><div>5- Ventum Tech is not held responsible in any way for not accepting the goods or services described above if it proves to be not conforming to the agreement and specifications or late delivery.</div>', '', 0.000000, 'Mohhamad Fali', 1, '2025-05-29 20:10', 2, 2, NULL, '4.521300');

-- ----------------------------
-- Table structure for purchase_order_items
-- ----------------------------
DROP TABLE IF EXISTS `purchase_order_items`;
CREATE TABLE `purchase_order_items`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `po_id` int NULL DEFAULT NULL,
  `item_code` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `item_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `qty` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `price` float(20, 6) NULL DEFAULT NULL,
  `inventory_quotation_id` int NULL DEFAULT NULL,
  `quotation_id` int NULL DEFAULT NULL,
  `inventory_id` int NULL DEFAULT NULL,
  `rate_id` int NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of purchase_order_items
-- ----------------------------
INSERT INTO `purchase_order_items` VALUES (1, '2025-05-29 20:05', 2, 0, '', NULL, '', NULL, 1, '2345345', 'test part 1', '0', 344.000000, 2147483647, 0, 1, 1);
INSERT INTO `purchase_order_items` VALUES (2, '2025-05-29 20:05', 2, 0, '', NULL, '', NULL, 1, '65663345', 'test part 2', '19', 533.000000, 2147483647, 0, 2, 1);
INSERT INTO `purchase_order_items` VALUES (3, '2025-05-29 20:05', 2, 0, '', NULL, '', NULL, 1, '00978', 'test23', '13', 44.000000, 2147483647, 0, 3, 1);
INSERT INTO `purchase_order_items` VALUES (4, '2025-05-29 20:10', 2, 0, '', NULL, '', NULL, 2, '8789056435', 'sdfsdf gare', '54', 3454.000000, 2147483647, 0, 4, 2);
INSERT INTO `purchase_order_items` VALUES (5, '2025-05-29 20:10', 2, 0, '', NULL, '', NULL, 2, '5675890006', 'tres ret 809', '14', 233.000000, 2147483647, 0, 5, 2);
INSERT INTO `purchase_order_items` VALUES (6, '2025-05-29 20:10', 2, 0, '', NULL, '', NULL, 2, '7800787', 'test desc', '354', 343.000000, 2147483647, 0, 6, 2);

-- ----------------------------
-- Table structure for quotations
-- ----------------------------
DROP TABLE IF EXISTS `quotations`;
CREATE TABLE `quotations`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `quotation_id` int NULL DEFAULT 0,
  `project_id` int NULL DEFAULT NULL,
  `client_id` int NULL DEFAULT NULL,
  `att_to` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `validity` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `quotation_date` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `terms_and_conditions` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `margin` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `quotation_number` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `draft` int NULL DEFAULT 1,
  `version` int NULL DEFAULT 0,
  `confirmed` int NULL DEFAULT 0,
  `confirmed_by` int NULL DEFAULT NULL,
  `confirmed_date` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sla_desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sla_amount` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sla_margin` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `confirmed_hide` int NULL DEFAULT 0,
  `print_logs` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `completion_date` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `quotation_amount` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `master_confirmed` int NULL DEFAULT 0,
  `start_date` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of quotations
-- ----------------------------

-- ----------------------------
-- Table structure for quotations_items
-- ----------------------------
DROP TABLE IF EXISTS `quotations_items`;
CREATE TABLE `quotations_items`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `quotation_id` int NULL DEFAULT 0,
  `project_id` int NULL DEFAULT NULL,
  `item_code` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `item_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `brand` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `supplier` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `qty` int NULL DEFAULT NULL,
  `quotation_location_id` int NULL DEFAULT NULL,
  `unit_cost` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `discount_percentage` int NULL DEFAULT 0,
  `landed_cost_rate_id` int NULL DEFAULT NULL,
  `is_manpower` int NULL DEFAULT 0,
  `is_local` int NULL DEFAULT 0,
  `margin` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `inventory_id` int NULL DEFAULT NULL,
  `edited_margin` int NULL DEFAULT 0,
  `other` int NULL DEFAULT NULL,
  `package_id` int NULL DEFAULT NULL,
  `inventory_quotation_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of quotations_items
-- ----------------------------

-- ----------------------------
-- Table structure for quotations_landed_cost_rate
-- ----------------------------
DROP TABLE IF EXISTS `quotations_landed_cost_rate`;
CREATE TABLE `quotations_landed_cost_rate`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `landed_cost_rate` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `conversion_factor` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `freight_percent` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `custom_percent` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `landed_cost_factor` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `currency_symbol` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `local_purchase` int NULL DEFAULT 0,
  `quotation_id` int NULL DEFAULT NULL,
  `id_orig` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of quotations_landed_cost_rate
-- ----------------------------

-- ----------------------------
-- Table structure for quotations_legalization_fees
-- ----------------------------
DROP TABLE IF EXISTS `quotations_legalization_fees`;
CREATE TABLE `quotations_legalization_fees`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `amount_from` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `amount_to` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `fees` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `percent_of_invoice_val` int NULL DEFAULT 0,
  `quotation_id` int NULL DEFAULT NULL,
  `id_orig` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of quotations_legalization_fees
-- ----------------------------

-- ----------------------------
-- Table structure for quotations_locations
-- ----------------------------
DROP TABLE IF EXISTS `quotations_locations`;
CREATE TABLE `quotations_locations`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `quotation_id` int NULL DEFAULT 0,
  `project_id` int NULL DEFAULT NULL,
  `location_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of quotations_locations
-- ----------------------------

-- ----------------------------
-- Table structure for quotations_others
-- ----------------------------
DROP TABLE IF EXISTS `quotations_others`;
CREATE TABLE `quotations_others`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ds` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dc` date NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `amount` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `modified_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of quotations_others
-- ----------------------------
INSERT INTO `quotations_others` VALUES (1, 'Sub Contractor', 'Sub Contractor', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `quotations_others` VALUES (2, 'Tools', 'Tools', NULL, NULL, 0, '45', NULL, NULL, 2, '2024-05-11 16:01:45');
INSERT INTO `quotations_others` VALUES (3, 'External Manpower', 'External Manpower', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `quotations_others` VALUES (4, 'Royalties', 'Royalties', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for quotations_package
-- ----------------------------
DROP TABLE IF EXISTS `quotations_package`;
CREATE TABLE `quotations_package`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `package_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `quotation_id` int NULL DEFAULT NULL,
  `price` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `quotation_location_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of quotations_package
-- ----------------------------

-- ----------------------------
-- Table structure for quotations_package_items
-- ----------------------------
DROP TABLE IF EXISTS `quotations_package_items`;
CREATE TABLE `quotations_package_items`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `quotation_items_id` int NULL DEFAULT NULL,
  `quotation_id` int NULL DEFAULT NULL,
  `package_id` int NULL DEFAULT NULL,
  `quotation_location_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of quotations_package_items
-- ----------------------------

-- ----------------------------
-- Table structure for receiving
-- ----------------------------
DROP TABLE IF EXISTS `receiving`;
CREATE TABLE `receiving`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `po_ids` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dr_number` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `invoice_number` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `remarks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `attachments` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `project_ids` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `quotation_ids` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `delivery_date` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `invoice_date` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `lc_factor` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `exchange_rate` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `confirmed` int NULL DEFAULT 0,
  `confirmed_date` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `confirmed_by` int NULL DEFAULT NULL,
  `currency` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `supplier_id` int NULL DEFAULT NULL,
  `grv_transport_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of receiving
-- ----------------------------

-- ----------------------------
-- Table structure for receiving_fc
-- ----------------------------
DROP TABLE IF EXISTS `receiving_fc`;
CREATE TABLE `receiving_fc`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `fc_id` int NULL DEFAULT NULL,
  `amt` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `remarks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `receiving_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of receiving_fc
-- ----------------------------

-- ----------------------------
-- Table structure for receiving_items
-- ----------------------------
DROP TABLE IF EXISTS `receiving_items`;
CREATE TABLE `receiving_items`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `po_id` int NULL DEFAULT NULL,
  `project_id` int NULL DEFAULT NULL,
  `quotation_id` int NULL DEFAULT NULL,
  `receiving_id` int NULL DEFAULT NULL,
  `po_item_id` int NULL DEFAULT NULL,
  `qty` int NULL DEFAULT NULL,
  `remarks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `inventory_quotation_id` int NULL DEFAULT NULL,
  `inventory_id` int NULL DEFAULT NULL,
  `price` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `qty_out` int NULL DEFAULT 0,
  `unit_cost_price` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `bad_qty` int NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of receiving_items
-- ----------------------------

-- ----------------------------
-- Table structure for receiving_lc
-- ----------------------------
DROP TABLE IF EXISTS `receiving_lc`;
CREATE TABLE `receiving_lc`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `lc_id` int NULL DEFAULT NULL,
  `amt` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `remarks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `receiving_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of receiving_lc
-- ----------------------------

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `timezone` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `currency` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `language` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `depriciation_cutoff` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO `settings` VALUES (1, 'Asia/Manila', '8369;', '1', 0);

-- ----------------------------
-- Table structure for suppliers
-- ----------------------------
DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE `suppliers`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `name` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `contact_person_1` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `contact_person_2` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `contact_number_1` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `contact_number_2` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `tin` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `terms_and_conditions` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `shipping_notes` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `email` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `po_attension_to` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `fax_no` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `landed_cost_rate_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of suppliers
-- ----------------------------

-- ----------------------------
-- Table structure for suppliers_po
-- ----------------------------
DROP TABLE IF EXISTS `suppliers_po`;
CREATE TABLE `suppliers_po`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `name` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `contact_person_1` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `contact_person_2` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `contact_number_1` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `contact_number_2` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `tin` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `terms_and_conditions` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `shipping_notes` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `email` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `po_attension_to` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `fax_no` varchar(125) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of suppliers_po
-- ----------------------------
INSERT INTO `suppliers_po` VALUES (1, '2023-12-05 20:50:51', 2, 0, '', NULL, '', NULL, 'Supplier Test 1', '', '', '', '', '', NULL, NULL, NULL, 'apple@gmail.com', 'Mohammad Saleh', '');
INSERT INTO `suppliers_po` VALUES (2, '2023-12-05 20:52:01', 2, 0, '', NULL, '', NULL, 'Supplier Test 2', '', '', '', '', '', NULL, NULL, NULL, 'laccoustics@mail.com', 'Mohhamad Fali', '');

-- ----------------------------
-- Table structure for terms_and_conditions
-- ----------------------------
DROP TABLE IF EXISTS `terms_and_conditions`;
CREATE TABLE `terms_and_conditions`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `type` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of terms_and_conditions
-- ----------------------------
INSERT INTO `terms_and_conditions` VALUES (1, '2023-09-13', 2, 0, '', NULL, '2023-09-13', 2, '<div><font color=\"#2697de\"><span style=\"font-weight: 700;\">Terms and Conditions: </span></font></div><div><span style=\"font-weight: 700;\"><font color=\"#2697de\">1-</font></span> Supply, Delivery, Installation, Testing and Commission of the above AV system.</div><div><font color=\"#2697de\">2- </font>The above design is based on the provided layout drawing, BoQ, and specification.</div><div><font color=\"#2697de\"><span style=\"font-weight: 700;\">3- </span></font>Civil, structural works, conduits and cable pulling not mentioned on the quotes are excluded.</div><div><font color=\"#2697de\">5- </font>Any Changes in the mentioned quantity will be considered as a variation </div><div><font color=\"#2697de\"><span style=\"font-weight: 700;\">6- Payment: - </span></font>50% advance against order confirmation.</div><div>- 40% against material delivery to site.</div><div>- 10% immediately after completion. </div><div><font color=\"#2697de\"><span style=\"font-weight: 700;\">7-</span></font> Warranty: The sole warranty for the supplied material is the original equipment manufacturer warranty against manufacturing defects only. </div><div><span style=\"font-weight: 700;\"><font color=\"#2697de\">8-</font></span> Delivery: TBA as per project schedule. </div><div><span style=\"font-weight: 700;\"><font color=\"#2697de\">9-</font></span> All approvals and site access, scaffolding for Ventum to complete its scope of work is the client’s responsibility. </div><div><span style=\"font-weight: 700;\"><font color=\"#2697de\">10-</font></span> If PO is issued it cannot be revoked for any reason. Advance payments are not reimbursed. Ventum is not responsible for any delay that may occur due to material shortage or shipping equipment or no space availability.</div><div>12- The above prices are applicable to the above package offer. Individual items are priced differently. Errors and omissions are excluded.</div>', 'template 1', 'quotation');
INSERT INTO `terms_and_conditions` VALUES (2, '2023-09-13', 2, 0, '', NULL, '2023-09-13', 2, '<div><font color=\"#2697de\"><b>Terms and Conditions: </b></font></div><div><b><font color=\"#2697de\">1-</font></b> Supply, Delivery, Installation, Testing and Commission of the above AV system.</div><div><font color=\"#2697de\">2- </font>The above design is based on the provided layout drawing, BoQ, and specification.</div><div><font color=\"#2697de\"><b>3- </b></font>Civil, structural works, conduits and cable pulling not mentioned on the quotes are excluded.</div><div><font color=\"#2697de\">5- </font>Any Changes in the mentioned quantity will be considered as a variation </div><div><font color=\"#2697de\"><b>6- Payment: - </b></font>50% advance against order confirmation.</div><div>- 40% against material delivery to site.</div><div>- 10% immediately after completion. </div><div><font color=\"#2697de\"><b>7-</b></font> Warranty: The sole warranty for the supplied material is the original equipment manufacturer warranty against manufacturing defects only. <b><font color=\"#2697de\">8-</font></b> Delivery: TBA as per project schedule. </div><div><font color=\"#2697de\"><b> </b></font></div>', 'template 2', 'quotation');
INSERT INTO `terms_and_conditions` VALUES (3, '2023-09-13', 2, 0, '', NULL, '2023-09-13', 2, '<div><font color=\"#2697de\"><span style=\"font-weight: 700;\">Terms and Conditions: </span></font></div><div><span style=\"font-weight: 700;\"><font color=\"#2697de\">1-</font></span> Supply, Delivery, Installation, Testing and Commission of the above AV system.</div><div><font color=\"#2697de\">2- </font>The above design is based on the provided layout drawing, BoQ, and specification.</div><div><font color=\"#2697de\"><span style=\"font-weight: 700;\">3- </span></font>Civil, structural works, conduits and cable pulling not mentioned on the quotes are excluded.</div><div><font color=\"#2697de\"> </font></div>', 'template 3', 'quotation');
INSERT INTO `terms_and_conditions` VALUES (4, '2023-09-17', 2, 0, '', NULL, '2023-09-20', 2, '<font color=\"#2697de\">T<b>erms &amp; Conditions:&nbsp;</b></font><div>1- Invoices to be issued in the name of Ventum Tech Security Systems and Services.&nbsp;</div><div>2- Payment Terms: As per agreement&nbsp;</div><div>3- Delivery: Immediate&nbsp;</div><div>4- If no PO confirmation nor comments/remarks are received within 2 working days from official PO transmittal date, this PO including all its content is considered in effect.&nbsp;</div><div>5- Ventum Tech is not held responsible in any way for not accepting the goods or services described above if it proves to be not conforming to the agreement and specifications or late delivery.</div>', 'Template 1', 'po');
INSERT INTO `terms_and_conditions` VALUES (5, '2023-09-17', 2, 0, '', NULL, '2023-09-20', 2, '<b><font color=\"#2697de\">Terms &amp; Conditions:&nbsp;</font></b><div><font color=\"#2697de\">1- </font>Invoices to be issued in the name of Ventum Tech Security Systems and Services.&nbsp;</div><div><font color=\"#2697de\">2-</font> Payment Terms: As per agreement&nbsp;</div><div><font color=\"#2697de\">3-</font> Delivery: Immediate&nbsp;</div><div><font color=\"#2697de\">4-</font> If no PO confirmation nor comments/remarks are received within 2 working days from official PO transmittal date, this PO including all its content is considered in effect.&nbsp;&nbsp;</div>', 'Template 2', 'po');

-- ----------------------------
-- Table structure for theme
-- ----------------------------
DROP TABLE IF EXISTS `theme`;
CREATE TABLE `theme`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `bullets_bg` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `logo_bg` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `side_menu_1` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `side_menu_2` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `active_menu_1` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `active_menu_2` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `active_sub_menu_1` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `active_sub_menu_2` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `footer_bg` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `primary_btn` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `primary_border_btn` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `success_btn` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `success_border_btn` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `warning_btn` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `warning_border_btn` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `danger_btn` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `danger_border_btn` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `info_btn` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `info_border_btn` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `side_bar_drawer` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of theme
-- ----------------------------
INSERT INTO `theme` VALUES (1, '#0a1285', '#05057a', '#0e2581', '#05316b', '#254aa2', '#1a6dad', '#3b83b0', '#133d90', '#3f99de', '#699bdd', '#94a8e5', '#48a4f9', '#8d92aa', '#dfaf49', '#d2c46a', '#ea4d4d', '#990f0f', '#85c7f9', '#47bad7', 'sm');

-- ----------------------------
-- Table structure for user_roles
-- ----------------------------
DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE `user_roles`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `sub_menu_id` int NOT NULL,
  `main_menu_id` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2281 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user_roles
-- ----------------------------
INSERT INTO `user_roles` VALUES (494, 10, 7, 3);
INSERT INTO `user_roles` VALUES (495, 10, 43, 4);
INSERT INTO `user_roles` VALUES (496, 10, 53, 3);
INSERT INTO `user_roles` VALUES (497, 10, 54, 3);
INSERT INTO `user_roles` VALUES (498, 10, 77, 3);
INSERT INTO `user_roles` VALUES (499, 10, 79, 3);
INSERT INTO `user_roles` VALUES (500, 10, 88, 5);
INSERT INTO `user_roles` VALUES (501, 10, 100, 5);
INSERT INTO `user_roles` VALUES (502, 11, 6, 2);
INSERT INTO `user_roles` VALUES (503, 11, 7, 3);
INSERT INTO `user_roles` VALUES (504, 11, 8, 1);
INSERT INTO `user_roles` VALUES (505, 11, 14, 6);
INSERT INTO `user_roles` VALUES (506, 11, 24, 2);
INSERT INTO `user_roles` VALUES (507, 11, 43, 4);
INSERT INTO `user_roles` VALUES (508, 11, 44, 4);
INSERT INTO `user_roles` VALUES (509, 11, 45, 1);
INSERT INTO `user_roles` VALUES (510, 11, 50, 11);
INSERT INTO `user_roles` VALUES (511, 11, 52, 11);
INSERT INTO `user_roles` VALUES (512, 11, 53, 3);
INSERT INTO `user_roles` VALUES (513, 11, 54, 3);
INSERT INTO `user_roles` VALUES (514, 11, 56, 6);
INSERT INTO `user_roles` VALUES (515, 11, 57, 11);
INSERT INTO `user_roles` VALUES (516, 11, 60, 2);
INSERT INTO `user_roles` VALUES (517, 11, 61, 2);
INSERT INTO `user_roles` VALUES (518, 11, 62, 2);
INSERT INTO `user_roles` VALUES (519, 11, 63, 2);
INSERT INTO `user_roles` VALUES (520, 11, 64, 2);
INSERT INTO `user_roles` VALUES (521, 11, 66, 12);
INSERT INTO `user_roles` VALUES (522, 11, 67, 12);
INSERT INTO `user_roles` VALUES (523, 11, 68, 11);
INSERT INTO `user_roles` VALUES (524, 11, 69, 13);
INSERT INTO `user_roles` VALUES (525, 11, 70, 1);
INSERT INTO `user_roles` VALUES (526, 11, 71, 2);
INSERT INTO `user_roles` VALUES (527, 11, 72, 2);
INSERT INTO `user_roles` VALUES (528, 11, 73, 2);
INSERT INTO `user_roles` VALUES (529, 11, 74, 2);
INSERT INTO `user_roles` VALUES (530, 11, 75, 2);
INSERT INTO `user_roles` VALUES (531, 11, 77, 3);
INSERT INTO `user_roles` VALUES (532, 11, 78, 2);
INSERT INTO `user_roles` VALUES (533, 11, 79, 3);
INSERT INTO `user_roles` VALUES (534, 11, 80, 2);
INSERT INTO `user_roles` VALUES (535, 11, 81, 2);
INSERT INTO `user_roles` VALUES (536, 11, 83, 1);
INSERT INTO `user_roles` VALUES (537, 11, 84, 5);
INSERT INTO `user_roles` VALUES (538, 11, 85, 2);
INSERT INTO `user_roles` VALUES (539, 11, 86, 13);
INSERT INTO `user_roles` VALUES (540, 11, 87, 13);
INSERT INTO `user_roles` VALUES (541, 11, 88, 5);
INSERT INTO `user_roles` VALUES (542, 11, 89, 14);
INSERT INTO `user_roles` VALUES (543, 11, 90, 14);
INSERT INTO `user_roles` VALUES (544, 11, 91, 2);
INSERT INTO `user_roles` VALUES (545, 11, 92, 11);
INSERT INTO `user_roles` VALUES (546, 11, 93, 6);
INSERT INTO `user_roles` VALUES (547, 11, 94, 11);
INSERT INTO `user_roles` VALUES (548, 11, 95, 13);
INSERT INTO `user_roles` VALUES (549, 11, 96, 5);
INSERT INTO `user_roles` VALUES (550, 11, 97, 2);
INSERT INTO `user_roles` VALUES (551, 11, 98, 11);
INSERT INTO `user_roles` VALUES (552, 11, 99, 2);
INSERT INTO `user_roles` VALUES (553, 11, 100, 5);
INSERT INTO `user_roles` VALUES (554, 12, 6, 2);
INSERT INTO `user_roles` VALUES (555, 12, 7, 3);
INSERT INTO `user_roles` VALUES (556, 12, 8, 1);
INSERT INTO `user_roles` VALUES (557, 12, 14, 6);
INSERT INTO `user_roles` VALUES (558, 12, 24, 2);
INSERT INTO `user_roles` VALUES (559, 12, 43, 4);
INSERT INTO `user_roles` VALUES (560, 12, 44, 4);
INSERT INTO `user_roles` VALUES (561, 12, 45, 1);
INSERT INTO `user_roles` VALUES (562, 12, 50, 11);
INSERT INTO `user_roles` VALUES (563, 12, 52, 11);
INSERT INTO `user_roles` VALUES (564, 12, 53, 3);
INSERT INTO `user_roles` VALUES (565, 12, 54, 3);
INSERT INTO `user_roles` VALUES (566, 12, 56, 6);
INSERT INTO `user_roles` VALUES (567, 12, 57, 11);
INSERT INTO `user_roles` VALUES (568, 12, 60, 2);
INSERT INTO `user_roles` VALUES (569, 12, 61, 2);
INSERT INTO `user_roles` VALUES (570, 12, 62, 2);
INSERT INTO `user_roles` VALUES (571, 12, 63, 2);
INSERT INTO `user_roles` VALUES (572, 12, 64, 2);
INSERT INTO `user_roles` VALUES (573, 12, 66, 12);
INSERT INTO `user_roles` VALUES (574, 12, 67, 12);
INSERT INTO `user_roles` VALUES (575, 12, 68, 11);
INSERT INTO `user_roles` VALUES (576, 12, 69, 13);
INSERT INTO `user_roles` VALUES (577, 12, 70, 1);
INSERT INTO `user_roles` VALUES (578, 12, 71, 2);
INSERT INTO `user_roles` VALUES (579, 12, 72, 2);
INSERT INTO `user_roles` VALUES (580, 12, 73, 2);
INSERT INTO `user_roles` VALUES (581, 12, 74, 2);
INSERT INTO `user_roles` VALUES (582, 12, 75, 2);
INSERT INTO `user_roles` VALUES (583, 12, 77, 3);
INSERT INTO `user_roles` VALUES (584, 12, 78, 2);
INSERT INTO `user_roles` VALUES (585, 12, 79, 3);
INSERT INTO `user_roles` VALUES (586, 12, 80, 2);
INSERT INTO `user_roles` VALUES (587, 12, 81, 2);
INSERT INTO `user_roles` VALUES (588, 12, 83, 1);
INSERT INTO `user_roles` VALUES (589, 12, 84, 5);
INSERT INTO `user_roles` VALUES (590, 12, 85, 2);
INSERT INTO `user_roles` VALUES (591, 12, 86, 13);
INSERT INTO `user_roles` VALUES (592, 12, 87, 13);
INSERT INTO `user_roles` VALUES (593, 12, 88, 5);
INSERT INTO `user_roles` VALUES (594, 12, 89, 14);
INSERT INTO `user_roles` VALUES (595, 12, 90, 14);
INSERT INTO `user_roles` VALUES (596, 12, 91, 2);
INSERT INTO `user_roles` VALUES (597, 12, 92, 11);
INSERT INTO `user_roles` VALUES (598, 12, 93, 6);
INSERT INTO `user_roles` VALUES (599, 12, 94, 11);
INSERT INTO `user_roles` VALUES (600, 12, 95, 13);
INSERT INTO `user_roles` VALUES (601, 12, 96, 5);
INSERT INTO `user_roles` VALUES (602, 12, 97, 2);
INSERT INTO `user_roles` VALUES (603, 12, 98, 11);
INSERT INTO `user_roles` VALUES (604, 12, 99, 2);
INSERT INTO `user_roles` VALUES (605, 12, 100, 5);
INSERT INTO `user_roles` VALUES (606, 13, 6, 2);
INSERT INTO `user_roles` VALUES (607, 13, 7, 3);
INSERT INTO `user_roles` VALUES (608, 13, 14, 6);
INSERT INTO `user_roles` VALUES (609, 13, 24, 2);
INSERT INTO `user_roles` VALUES (610, 13, 53, 3);
INSERT INTO `user_roles` VALUES (611, 13, 54, 3);
INSERT INTO `user_roles` VALUES (612, 13, 56, 6);
INSERT INTO `user_roles` VALUES (613, 13, 60, 2);
INSERT INTO `user_roles` VALUES (614, 13, 61, 2);
INSERT INTO `user_roles` VALUES (615, 13, 62, 2);
INSERT INTO `user_roles` VALUES (616, 13, 63, 2);
INSERT INTO `user_roles` VALUES (617, 13, 64, 2);
INSERT INTO `user_roles` VALUES (618, 13, 69, 13);
INSERT INTO `user_roles` VALUES (619, 13, 71, 2);
INSERT INTO `user_roles` VALUES (620, 13, 72, 2);
INSERT INTO `user_roles` VALUES (621, 13, 73, 2);
INSERT INTO `user_roles` VALUES (622, 13, 74, 2);
INSERT INTO `user_roles` VALUES (623, 13, 75, 2);
INSERT INTO `user_roles` VALUES (624, 13, 77, 3);
INSERT INTO `user_roles` VALUES (625, 13, 78, 2);
INSERT INTO `user_roles` VALUES (626, 13, 79, 3);
INSERT INTO `user_roles` VALUES (627, 13, 80, 2);
INSERT INTO `user_roles` VALUES (628, 13, 81, 2);
INSERT INTO `user_roles` VALUES (629, 13, 85, 2);
INSERT INTO `user_roles` VALUES (630, 13, 86, 13);
INSERT INTO `user_roles` VALUES (631, 13, 87, 13);
INSERT INTO `user_roles` VALUES (632, 13, 91, 2);
INSERT INTO `user_roles` VALUES (633, 13, 93, 6);
INSERT INTO `user_roles` VALUES (634, 13, 97, 2);
INSERT INTO `user_roles` VALUES (635, 13, 99, 2);
INSERT INTO `user_roles` VALUES (636, 14, 69, 13);
INSERT INTO `user_roles` VALUES (637, 14, 89, 14);
INSERT INTO `user_roles` VALUES (638, 14, 90, 14);
INSERT INTO `user_roles` VALUES (639, 15, 69, 13);
INSERT INTO `user_roles` VALUES (640, 15, 89, 14);
INSERT INTO `user_roles` VALUES (641, 15, 90, 14);
INSERT INTO `user_roles` VALUES (642, 16, 43, 4);
INSERT INTO `user_roles` VALUES (643, 16, 44, 4);
INSERT INTO `user_roles` VALUES (644, 17, 43, 4);
INSERT INTO `user_roles` VALUES (645, 17, 44, 4);
INSERT INTO `user_roles` VALUES (646, 18, 43, 4);
INSERT INTO `user_roles` VALUES (647, 18, 44, 4);
INSERT INTO `user_roles` VALUES (648, 19, 43, 4);
INSERT INTO `user_roles` VALUES (649, 19, 44, 4);
INSERT INTO `user_roles` VALUES (650, 20, 43, 4);
INSERT INTO `user_roles` VALUES (651, 20, 44, 4);
INSERT INTO `user_roles` VALUES (652, 21, 86, 13);
INSERT INTO `user_roles` VALUES (653, 21, 87, 13);
INSERT INTO `user_roles` VALUES (654, 22, 86, 13);
INSERT INTO `user_roles` VALUES (655, 22, 87, 13);
INSERT INTO `user_roles` VALUES (656, 23, 14, 6);
INSERT INTO `user_roles` VALUES (657, 23, 56, 6);
INSERT INTO `user_roles` VALUES (658, 23, 66, 12);
INSERT INTO `user_roles` VALUES (659, 23, 67, 12);
INSERT INTO `user_roles` VALUES (660, 23, 93, 6);
INSERT INTO `user_roles` VALUES (661, 24, 14, 6);
INSERT INTO `user_roles` VALUES (662, 24, 56, 6);
INSERT INTO `user_roles` VALUES (663, 24, 66, 12);
INSERT INTO `user_roles` VALUES (664, 24, 67, 12);
INSERT INTO `user_roles` VALUES (665, 24, 93, 6);
INSERT INTO `user_roles` VALUES (666, 25, 14, 6);
INSERT INTO `user_roles` VALUES (667, 25, 56, 6);
INSERT INTO `user_roles` VALUES (668, 25, 66, 12);
INSERT INTO `user_roles` VALUES (669, 25, 67, 12);
INSERT INTO `user_roles` VALUES (670, 25, 93, 6);
INSERT INTO `user_roles` VALUES (671, 26, 6, 2);
INSERT INTO `user_roles` VALUES (672, 26, 7, 3);
INSERT INTO `user_roles` VALUES (673, 26, 8, 1);
INSERT INTO `user_roles` VALUES (674, 26, 14, 6);
INSERT INTO `user_roles` VALUES (675, 26, 24, 2);
INSERT INTO `user_roles` VALUES (676, 26, 43, 4);
INSERT INTO `user_roles` VALUES (677, 26, 44, 4);
INSERT INTO `user_roles` VALUES (678, 26, 45, 1);
INSERT INTO `user_roles` VALUES (679, 26, 50, 11);
INSERT INTO `user_roles` VALUES (680, 26, 52, 11);
INSERT INTO `user_roles` VALUES (681, 26, 53, 3);
INSERT INTO `user_roles` VALUES (682, 26, 54, 3);
INSERT INTO `user_roles` VALUES (683, 26, 56, 6);
INSERT INTO `user_roles` VALUES (684, 26, 57, 11);
INSERT INTO `user_roles` VALUES (685, 26, 60, 2);
INSERT INTO `user_roles` VALUES (686, 26, 61, 2);
INSERT INTO `user_roles` VALUES (687, 26, 62, 2);
INSERT INTO `user_roles` VALUES (688, 26, 63, 2);
INSERT INTO `user_roles` VALUES (689, 26, 64, 2);
INSERT INTO `user_roles` VALUES (690, 26, 66, 12);
INSERT INTO `user_roles` VALUES (691, 26, 67, 12);
INSERT INTO `user_roles` VALUES (692, 26, 68, 11);
INSERT INTO `user_roles` VALUES (693, 26, 69, 13);
INSERT INTO `user_roles` VALUES (694, 26, 70, 1);
INSERT INTO `user_roles` VALUES (695, 26, 71, 2);
INSERT INTO `user_roles` VALUES (696, 26, 72, 2);
INSERT INTO `user_roles` VALUES (697, 26, 73, 2);
INSERT INTO `user_roles` VALUES (698, 26, 74, 2);
INSERT INTO `user_roles` VALUES (699, 26, 75, 2);
INSERT INTO `user_roles` VALUES (700, 26, 77, 3);
INSERT INTO `user_roles` VALUES (701, 26, 78, 2);
INSERT INTO `user_roles` VALUES (702, 26, 79, 3);
INSERT INTO `user_roles` VALUES (703, 26, 80, 2);
INSERT INTO `user_roles` VALUES (704, 26, 81, 2);
INSERT INTO `user_roles` VALUES (705, 26, 83, 1);
INSERT INTO `user_roles` VALUES (706, 26, 84, 5);
INSERT INTO `user_roles` VALUES (707, 26, 85, 2);
INSERT INTO `user_roles` VALUES (708, 26, 86, 13);
INSERT INTO `user_roles` VALUES (709, 26, 87, 13);
INSERT INTO `user_roles` VALUES (710, 26, 88, 5);
INSERT INTO `user_roles` VALUES (711, 26, 89, 14);
INSERT INTO `user_roles` VALUES (712, 26, 90, 14);
INSERT INTO `user_roles` VALUES (713, 26, 91, 2);
INSERT INTO `user_roles` VALUES (714, 26, 92, 11);
INSERT INTO `user_roles` VALUES (715, 26, 93, 6);
INSERT INTO `user_roles` VALUES (716, 26, 94, 11);
INSERT INTO `user_roles` VALUES (717, 26, 95, 13);
INSERT INTO `user_roles` VALUES (718, 26, 96, 5);
INSERT INTO `user_roles` VALUES (719, 26, 97, 2);
INSERT INTO `user_roles` VALUES (720, 26, 98, 11);
INSERT INTO `user_roles` VALUES (721, 26, 99, 2);
INSERT INTO `user_roles` VALUES (722, 26, 100, 5);
INSERT INTO `user_roles` VALUES (1747, 28, 105, 3);
INSERT INTO `user_roles` VALUES (1748, 28, 106, 3);
INSERT INTO `user_roles` VALUES (1749, 28, 107, 3);
INSERT INTO `user_roles` VALUES (1750, 28, 119, 19);
INSERT INTO `user_roles` VALUES (1751, 28, 122, 3);
INSERT INTO `user_roles` VALUES (1752, 28, 123, 3);
INSERT INTO `user_roles` VALUES (1795, 30, 54, 14);
INSERT INTO `user_roles` VALUES (1796, 30, 89, 17);
INSERT INTO `user_roles` VALUES (1797, 30, 102, 14);
INSERT INTO `user_roles` VALUES (1798, 30, 103, 14);
INSERT INTO `user_roles` VALUES (1799, 30, 104, 14);
INSERT INTO `user_roles` VALUES (1800, 30, 120, 14);
INSERT INTO `user_roles` VALUES (1801, 30, 121, 14);
INSERT INTO `user_roles` VALUES (1802, 30, 125, 14);
INSERT INTO `user_roles` VALUES (1803, 30, 134, 20);
INSERT INTO `user_roles` VALUES (1804, 30, 135, 20);
INSERT INTO `user_roles` VALUES (1805, 30, 136, 20);
INSERT INTO `user_roles` VALUES (1806, 30, 139, 17);
INSERT INTO `user_roles` VALUES (1807, 30, 140, 17);
INSERT INTO `user_roles` VALUES (1825, 32, 50, 11);
INSERT INTO `user_roles` VALUES (1826, 32, 105, 3);
INSERT INTO `user_roles` VALUES (1827, 32, 106, 3);
INSERT INTO `user_roles` VALUES (1828, 32, 107, 3);
INSERT INTO `user_roles` VALUES (1829, 32, 122, 3);
INSERT INTO `user_roles` VALUES (1830, 32, 123, 3);
INSERT INTO `user_roles` VALUES (1831, 33, 54, 14);
INSERT INTO `user_roles` VALUES (1832, 33, 89, 17);
INSERT INTO `user_roles` VALUES (1833, 33, 90, 14);
INSERT INTO `user_roles` VALUES (1834, 33, 101, 14);
INSERT INTO `user_roles` VALUES (1835, 33, 102, 14);
INSERT INTO `user_roles` VALUES (1836, 33, 103, 14);
INSERT INTO `user_roles` VALUES (1837, 33, 104, 14);
INSERT INTO `user_roles` VALUES (1838, 33, 119, 19);
INSERT INTO `user_roles` VALUES (1839, 33, 120, 14);
INSERT INTO `user_roles` VALUES (1840, 33, 121, 14);
INSERT INTO `user_roles` VALUES (1841, 33, 124, 19);
INSERT INTO `user_roles` VALUES (1842, 33, 125, 14);
INSERT INTO `user_roles` VALUES (1843, 33, 126, 19);
INSERT INTO `user_roles` VALUES (1844, 33, 139, 17);
INSERT INTO `user_roles` VALUES (1845, 33, 140, 17);
INSERT INTO `user_roles` VALUES (1846, 34, 54, 14);
INSERT INTO `user_roles` VALUES (1847, 34, 83, 1);
INSERT INTO `user_roles` VALUES (1848, 34, 89, 17);
INSERT INTO `user_roles` VALUES (1849, 34, 90, 14);
INSERT INTO `user_roles` VALUES (1850, 34, 101, 14);
INSERT INTO `user_roles` VALUES (1851, 34, 102, 14);
INSERT INTO `user_roles` VALUES (1852, 34, 103, 14);
INSERT INTO `user_roles` VALUES (1853, 34, 104, 14);
INSERT INTO `user_roles` VALUES (1854, 34, 119, 19);
INSERT INTO `user_roles` VALUES (1855, 34, 120, 14);
INSERT INTO `user_roles` VALUES (1856, 34, 121, 14);
INSERT INTO `user_roles` VALUES (1857, 34, 124, 19);
INSERT INTO `user_roles` VALUES (1858, 34, 125, 14);
INSERT INTO `user_roles` VALUES (1859, 34, 126, 19);
INSERT INTO `user_roles` VALUES (1860, 34, 134, 20);
INSERT INTO `user_roles` VALUES (1861, 34, 135, 20);
INSERT INTO `user_roles` VALUES (1862, 34, 136, 20);
INSERT INTO `user_roles` VALUES (1863, 34, 139, 17);
INSERT INTO `user_roles` VALUES (1864, 34, 140, 17);
INSERT INTO `user_roles` VALUES (1865, 31, 50, 11);
INSERT INTO `user_roles` VALUES (1866, 31, 108, 16);
INSERT INTO `user_roles` VALUES (1867, 31, 109, 16);
INSERT INTO `user_roles` VALUES (1868, 31, 110, 18);
INSERT INTO `user_roles` VALUES (1869, 31, 111, 18);
INSERT INTO `user_roles` VALUES (1870, 31, 114, 16);
INSERT INTO `user_roles` VALUES (1871, 31, 115, 16);
INSERT INTO `user_roles` VALUES (1872, 31, 116, 16);
INSERT INTO `user_roles` VALUES (1873, 31, 117, 16);
INSERT INTO `user_roles` VALUES (1874, 31, 118, 18);
INSERT INTO `user_roles` VALUES (1875, 31, 127, 21);
INSERT INTO `user_roles` VALUES (1876, 31, 128, 21);
INSERT INTO `user_roles` VALUES (1877, 31, 129, 21);
INSERT INTO `user_roles` VALUES (1878, 31, 130, 21);
INSERT INTO `user_roles` VALUES (1879, 31, 131, 11);
INSERT INTO `user_roles` VALUES (1880, 31, 132, 11);
INSERT INTO `user_roles` VALUES (1881, 31, 133, 11);
INSERT INTO `user_roles` VALUES (2098, 35, 8, 1);
INSERT INTO `user_roles` VALUES (2099, 35, 45, 1);
INSERT INTO `user_roles` VALUES (2100, 35, 50, 11);
INSERT INTO `user_roles` VALUES (2101, 35, 54, 14);
INSERT INTO `user_roles` VALUES (2102, 35, 83, 1);
INSERT INTO `user_roles` VALUES (2103, 35, 89, 17);
INSERT INTO `user_roles` VALUES (2104, 35, 90, 14);
INSERT INTO `user_roles` VALUES (2105, 35, 101, 14);
INSERT INTO `user_roles` VALUES (2106, 35, 102, 14);
INSERT INTO `user_roles` VALUES (2107, 35, 103, 14);
INSERT INTO `user_roles` VALUES (2108, 35, 104, 14);
INSERT INTO `user_roles` VALUES (2109, 35, 105, 3);
INSERT INTO `user_roles` VALUES (2110, 35, 106, 3);
INSERT INTO `user_roles` VALUES (2111, 35, 107, 3);
INSERT INTO `user_roles` VALUES (2112, 35, 108, 16);
INSERT INTO `user_roles` VALUES (2113, 35, 109, 16);
INSERT INTO `user_roles` VALUES (2114, 35, 110, 18);
INSERT INTO `user_roles` VALUES (2115, 35, 111, 18);
INSERT INTO `user_roles` VALUES (2116, 35, 114, 16);
INSERT INTO `user_roles` VALUES (2117, 35, 115, 16);
INSERT INTO `user_roles` VALUES (2118, 35, 116, 16);
INSERT INTO `user_roles` VALUES (2119, 35, 117, 16);
INSERT INTO `user_roles` VALUES (2120, 35, 118, 18);
INSERT INTO `user_roles` VALUES (2121, 35, 119, 19);
INSERT INTO `user_roles` VALUES (2122, 35, 120, 14);
INSERT INTO `user_roles` VALUES (2123, 35, 121, 14);
INSERT INTO `user_roles` VALUES (2124, 35, 122, 3);
INSERT INTO `user_roles` VALUES (2125, 35, 123, 3);
INSERT INTO `user_roles` VALUES (2126, 35, 124, 19);
INSERT INTO `user_roles` VALUES (2127, 35, 125, 14);
INSERT INTO `user_roles` VALUES (2128, 35, 126, 19);
INSERT INTO `user_roles` VALUES (2129, 35, 127, 21);
INSERT INTO `user_roles` VALUES (2130, 35, 128, 21);
INSERT INTO `user_roles` VALUES (2131, 35, 129, 21);
INSERT INTO `user_roles` VALUES (2132, 35, 130, 21);
INSERT INTO `user_roles` VALUES (2133, 35, 131, 11);
INSERT INTO `user_roles` VALUES (2134, 35, 132, 11);
INSERT INTO `user_roles` VALUES (2135, 35, 133, 11);
INSERT INTO `user_roles` VALUES (2136, 35, 134, 20);
INSERT INTO `user_roles` VALUES (2137, 35, 135, 20);
INSERT INTO `user_roles` VALUES (2138, 35, 136, 20);
INSERT INTO `user_roles` VALUES (2139, 35, 139, 17);
INSERT INTO `user_roles` VALUES (2140, 35, 140, 17);
INSERT INTO `user_roles` VALUES (2141, 35, 141, 16);
INSERT INTO `user_roles` VALUES (2142, 36, 8, 1);
INSERT INTO `user_roles` VALUES (2143, 36, 45, 1);
INSERT INTO `user_roles` VALUES (2144, 36, 50, 11);
INSERT INTO `user_roles` VALUES (2145, 36, 54, 14);
INSERT INTO `user_roles` VALUES (2146, 36, 83, 1);
INSERT INTO `user_roles` VALUES (2147, 36, 89, 17);
INSERT INTO `user_roles` VALUES (2148, 36, 90, 14);
INSERT INTO `user_roles` VALUES (2149, 36, 101, 14);
INSERT INTO `user_roles` VALUES (2150, 36, 102, 14);
INSERT INTO `user_roles` VALUES (2151, 36, 103, 14);
INSERT INTO `user_roles` VALUES (2152, 36, 104, 14);
INSERT INTO `user_roles` VALUES (2153, 36, 105, 3);
INSERT INTO `user_roles` VALUES (2154, 36, 106, 3);
INSERT INTO `user_roles` VALUES (2155, 36, 107, 3);
INSERT INTO `user_roles` VALUES (2156, 36, 108, 16);
INSERT INTO `user_roles` VALUES (2157, 36, 109, 16);
INSERT INTO `user_roles` VALUES (2158, 36, 110, 18);
INSERT INTO `user_roles` VALUES (2159, 36, 111, 18);
INSERT INTO `user_roles` VALUES (2160, 36, 114, 16);
INSERT INTO `user_roles` VALUES (2161, 36, 115, 16);
INSERT INTO `user_roles` VALUES (2162, 36, 116, 16);
INSERT INTO `user_roles` VALUES (2163, 36, 117, 16);
INSERT INTO `user_roles` VALUES (2164, 36, 118, 18);
INSERT INTO `user_roles` VALUES (2165, 36, 119, 19);
INSERT INTO `user_roles` VALUES (2166, 36, 120, 14);
INSERT INTO `user_roles` VALUES (2167, 36, 121, 14);
INSERT INTO `user_roles` VALUES (2168, 36, 122, 3);
INSERT INTO `user_roles` VALUES (2169, 36, 123, 3);
INSERT INTO `user_roles` VALUES (2170, 36, 124, 19);
INSERT INTO `user_roles` VALUES (2171, 36, 125, 14);
INSERT INTO `user_roles` VALUES (2172, 36, 126, 19);
INSERT INTO `user_roles` VALUES (2173, 36, 127, 21);
INSERT INTO `user_roles` VALUES (2174, 36, 128, 21);
INSERT INTO `user_roles` VALUES (2175, 36, 129, 21);
INSERT INTO `user_roles` VALUES (2176, 36, 130, 21);
INSERT INTO `user_roles` VALUES (2177, 36, 131, 11);
INSERT INTO `user_roles` VALUES (2178, 36, 132, 11);
INSERT INTO `user_roles` VALUES (2179, 36, 133, 11);
INSERT INTO `user_roles` VALUES (2180, 36, 134, 20);
INSERT INTO `user_roles` VALUES (2181, 36, 135, 20);
INSERT INTO `user_roles` VALUES (2182, 36, 136, 20);
INSERT INTO `user_roles` VALUES (2183, 36, 139, 17);
INSERT INTO `user_roles` VALUES (2184, 36, 140, 17);
INSERT INTO `user_roles` VALUES (2185, 36, 141, 16);
INSERT INTO `user_roles` VALUES (2186, 29, 8, 1);
INSERT INTO `user_roles` VALUES (2187, 29, 45, 1);
INSERT INTO `user_roles` VALUES (2188, 29, 50, 11);
INSERT INTO `user_roles` VALUES (2189, 29, 54, 14);
INSERT INTO `user_roles` VALUES (2190, 29, 83, 1);
INSERT INTO `user_roles` VALUES (2191, 29, 89, 17);
INSERT INTO `user_roles` VALUES (2192, 29, 90, 14);
INSERT INTO `user_roles` VALUES (2193, 29, 101, 14);
INSERT INTO `user_roles` VALUES (2194, 29, 102, 14);
INSERT INTO `user_roles` VALUES (2195, 29, 103, 14);
INSERT INTO `user_roles` VALUES (2196, 29, 104, 14);
INSERT INTO `user_roles` VALUES (2197, 29, 105, 3);
INSERT INTO `user_roles` VALUES (2198, 29, 106, 3);
INSERT INTO `user_roles` VALUES (2199, 29, 107, 3);
INSERT INTO `user_roles` VALUES (2200, 29, 108, 16);
INSERT INTO `user_roles` VALUES (2201, 29, 109, 16);
INSERT INTO `user_roles` VALUES (2202, 29, 110, 18);
INSERT INTO `user_roles` VALUES (2203, 29, 111, 18);
INSERT INTO `user_roles` VALUES (2204, 29, 114, 16);
INSERT INTO `user_roles` VALUES (2205, 29, 115, 16);
INSERT INTO `user_roles` VALUES (2206, 29, 116, 16);
INSERT INTO `user_roles` VALUES (2207, 29, 117, 16);
INSERT INTO `user_roles` VALUES (2208, 29, 118, 18);
INSERT INTO `user_roles` VALUES (2209, 29, 119, 19);
INSERT INTO `user_roles` VALUES (2210, 29, 120, 14);
INSERT INTO `user_roles` VALUES (2211, 29, 121, 14);
INSERT INTO `user_roles` VALUES (2212, 29, 122, 3);
INSERT INTO `user_roles` VALUES (2213, 29, 123, 3);
INSERT INTO `user_roles` VALUES (2214, 29, 124, 19);
INSERT INTO `user_roles` VALUES (2215, 29, 125, 14);
INSERT INTO `user_roles` VALUES (2216, 29, 126, 19);
INSERT INTO `user_roles` VALUES (2217, 29, 127, 21);
INSERT INTO `user_roles` VALUES (2218, 29, 128, 21);
INSERT INTO `user_roles` VALUES (2219, 29, 129, 21);
INSERT INTO `user_roles` VALUES (2220, 29, 130, 21);
INSERT INTO `user_roles` VALUES (2221, 29, 131, 11);
INSERT INTO `user_roles` VALUES (2222, 29, 132, 11);
INSERT INTO `user_roles` VALUES (2223, 29, 133, 11);
INSERT INTO `user_roles` VALUES (2224, 29, 134, 20);
INSERT INTO `user_roles` VALUES (2225, 29, 135, 20);
INSERT INTO `user_roles` VALUES (2226, 29, 136, 20);
INSERT INTO `user_roles` VALUES (2227, 29, 139, 17);
INSERT INTO `user_roles` VALUES (2228, 29, 140, 17);
INSERT INTO `user_roles` VALUES (2229, 29, 142, 20);
INSERT INTO `user_roles` VALUES (2230, 2, 8, 1);
INSERT INTO `user_roles` VALUES (2231, 2, 45, 1);
INSERT INTO `user_roles` VALUES (2232, 2, 50, 11);
INSERT INTO `user_roles` VALUES (2233, 2, 54, 14);
INSERT INTO `user_roles` VALUES (2234, 2, 83, 1);
INSERT INTO `user_roles` VALUES (2235, 2, 89, 17);
INSERT INTO `user_roles` VALUES (2236, 2, 90, 14);
INSERT INTO `user_roles` VALUES (2237, 2, 101, 14);
INSERT INTO `user_roles` VALUES (2238, 2, 102, 14);
INSERT INTO `user_roles` VALUES (2239, 2, 103, 14);
INSERT INTO `user_roles` VALUES (2240, 2, 104, 14);
INSERT INTO `user_roles` VALUES (2241, 2, 105, 3);
INSERT INTO `user_roles` VALUES (2242, 2, 106, 3);
INSERT INTO `user_roles` VALUES (2243, 2, 107, 3);
INSERT INTO `user_roles` VALUES (2244, 2, 108, 16);
INSERT INTO `user_roles` VALUES (2245, 2, 109, 16);
INSERT INTO `user_roles` VALUES (2246, 2, 110, 18);
INSERT INTO `user_roles` VALUES (2247, 2, 111, 18);
INSERT INTO `user_roles` VALUES (2248, 2, 114, 16);
INSERT INTO `user_roles` VALUES (2249, 2, 115, 16);
INSERT INTO `user_roles` VALUES (2250, 2, 116, 16);
INSERT INTO `user_roles` VALUES (2251, 2, 117, 16);
INSERT INTO `user_roles` VALUES (2252, 2, 118, 18);
INSERT INTO `user_roles` VALUES (2253, 2, 119, 19);
INSERT INTO `user_roles` VALUES (2254, 2, 120, 14);
INSERT INTO `user_roles` VALUES (2255, 2, 121, 14);
INSERT INTO `user_roles` VALUES (2256, 2, 122, 3);
INSERT INTO `user_roles` VALUES (2257, 2, 123, 3);
INSERT INTO `user_roles` VALUES (2258, 2, 124, 19);
INSERT INTO `user_roles` VALUES (2259, 2, 125, 14);
INSERT INTO `user_roles` VALUES (2260, 2, 126, 19);
INSERT INTO `user_roles` VALUES (2261, 2, 127, 21);
INSERT INTO `user_roles` VALUES (2262, 2, 128, 21);
INSERT INTO `user_roles` VALUES (2263, 2, 129, 21);
INSERT INTO `user_roles` VALUES (2264, 2, 130, 21);
INSERT INTO `user_roles` VALUES (2265, 2, 131, 11);
INSERT INTO `user_roles` VALUES (2266, 2, 132, 11);
INSERT INTO `user_roles` VALUES (2267, 2, 133, 11);
INSERT INTO `user_roles` VALUES (2268, 2, 134, 20);
INSERT INTO `user_roles` VALUES (2269, 2, 135, 20);
INSERT INTO `user_roles` VALUES (2270, 2, 136, 20);
INSERT INTO `user_roles` VALUES (2271, 2, 139, 17);
INSERT INTO `user_roles` VALUES (2272, 2, 140, 17);
INSERT INTO `user_roles` VALUES (2273, 2, 141, 16);
INSERT INTO `user_roles` VALUES (2274, 2, 142, 20);
INSERT INTO `user_roles` VALUES (2275, 37, 89, 17);
INSERT INTO `user_roles` VALUES (2276, 37, 119, 19);
INSERT INTO `user_roles` VALUES (2277, 37, 134, 20);
INSERT INTO `user_roles` VALUES (2278, 37, 135, 20);
INSERT INTO `user_roles` VALUES (2279, 37, 136, 20);
INSERT INTO `user_roles` VALUES (2280, 37, 142, 20);

-- ----------------------------
-- Table structure for vehicles
-- ----------------------------
DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE `vehicles`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `customer_id` int NULL DEFAULT NULL,
  `vehicle_model_id` int NULL DEFAULT NULL,
  `manufacturer_id` int NULL DEFAULT NULL,
  `plate_number` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `vin` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `picture_1` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `picture_2` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `picture_3` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of vehicles
-- ----------------------------
INSERT INTO `vehicles` VALUES (1, '', NULL, 0, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `vehicles` VALUES (2, '', NULL, 0, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;

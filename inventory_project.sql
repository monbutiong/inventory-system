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

 Date: 18/06/2025 17:58:28
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
INSERT INTO `account` VALUES (2, '1', '', '2017-05-01', 'admin', '$2a$08$HMSs9g77UdvwR7QJDA8dwuzqOj5qb1UZeKNc0s9aR4QuH7TT8tExi', 1, 1, 'Super Admin', '656d695223630_face2.jpg', 0, 'Mon Butiong', 0, NULL, NULL, 3, '8e030b619005eb2bdec310a3bb3003393ed0de9658c0b1e1e6bfd145c7f92a1b', '2025-06-18 12:55:10');
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
) ENGINE = InnoDB AUTO_INCREMENT = 150 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

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
INSERT INTO `audit_trail` VALUES (13, 2, 'file maintenance > models > add new data', 'add new data in models maintenance table, id : 1', '2025-06-01 14:40:30', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (14, 2, 'file maintenance > models > add new data', 'add new data in models maintenance table, id : 2', '2025-06-01 14:40:42', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (15, 2, 'file maintenance > models > add new data', 'add new data in models maintenance table, id : 3', '2025-06-01 14:41:09', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (16, 2, 'file maintenance > manufacturers > add new data', 'add new data in manufacturers maintenance table, id : 1', '2025-06-01 14:41:33', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (17, 2, 'file maintenance > manufacturers > add new data', 'add new data in manufacturers maintenance table, id : 2', '2025-06-01 14:41:41', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (18, 2, 'file maintenance > manufacturers > add new data', 'add new data in manufacturers maintenance table, id : 3', '2025-06-01 14:41:50', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (19, 2, 'file maintenance > models > update data', 'update data in models , id : 1', '2025-06-01 15:21:39', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (20, 2, 'file maintenance > models > update data', 'update data in models , id : 2', '2025-06-01 15:21:49', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (21, 2, 'file maintenance > models > update data', 'update data in models , id : 3', '2025-06-01 15:24:29', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (22, 2, 'file maintenance > models > add new data', 'add new data in models maintenance table, id : 4', '2025-06-01 15:24:59', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (23, 2, 'file maintenance > models > add new data', 'add new data in models maintenance table, id : 5', '2025-06-01 15:25:35', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (24, 2, 'file maintenance > models > add new data', 'add new data in models maintenance table, id : 6', '2025-06-01 15:26:01', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (25, 2, 'file maintenance > models > add new data', 'add new data in models maintenance table, id : 7', '2025-06-01 15:26:46', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (26, 2, 'login page', 'login to account.', '2025-06-02 09:50:14', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (27, 2, 'login page', 'login to account.', '2025-06-04 07:54:53', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (28, 2, 'home > system user > update user roles', 'update system user restriction, user id : 37', '2025-06-04 09:37:29', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (29, 2, 'home > system user > update user roles', 'update system user restriction, user id : 2', '2025-06-04 09:39:16', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (30, 2, 'file maintenance > item category > add new data', 'add new data in item category maintenance table, id : 1', '2025-06-04 09:39:46', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (31, 2, 'file maintenance > item category > add new data', 'add new data in item category maintenance table, id : 2', '2025-06-04 09:39:58', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (32, 2, 'file maintenance > item category > add new data', 'add new data in item category maintenance table, id : 3', '2025-06-04 09:40:26', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (33, 2, 'file maintenance > item category > add new data', 'add new data in item category maintenance table, id : 4', '2025-06-04 09:40:38', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (34, 2, 'file maintenance > item category > add new data', 'add new data in item category maintenance table, id : 5', '2025-06-04 09:40:54', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (35, 2, 'file maintenance > item category > add new data', 'add new data in item category maintenance table, id : 6', '2025-06-04 09:41:09', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (36, 2, 'file maintenance > item category > add new data', 'add new data in item category maintenance table, id : 7', '2025-06-04 09:41:23', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (37, 2, 'file maintenance > item category > add new data', 'add new data in item category maintenance table, id : 8', '2025-06-04 09:41:48', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (38, 2, 'file maintenance > item category > add new data', 'add new data in item category maintenance table, id : 9', '2025-06-04 09:42:01', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (39, 2, 'file maintenance > item category > add new data', 'add new data in item category maintenance table, id : 10', '2025-06-04 09:42:13', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (40, 2, 'file maintenance > item category > add new data', 'add new data in item category maintenance table, id : 11', '2025-06-04 09:42:26', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (41, 2, 'file maintenance > item category > add new data', 'add new data in item category maintenance table, id : 12', '2025-06-04 09:42:36', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (42, 2, 'file maintenance > item category > add new data', 'add new data in item category maintenance table, id : 13', '2025-06-04 09:42:46', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (43, 2, 'file maintenance > item category > add new data', 'add new data in item category maintenance table, id : 14', '2025-06-04 09:42:57', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (44, 2, 'file maintenance > item category > add new data', 'add new data in item category maintenance table, id : 15', '2025-06-04 09:43:10', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (45, 2, 'file maintenance > item type > add new data', 'add new data in item type maintenance table, id : 1', '2025-06-04 09:43:30', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (46, 2, 'file maintenance > item type > add new data', 'add new data in item type maintenance table, id : 2', '2025-06-04 09:43:41', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (47, 2, 'file maintenance > item type > add new data', 'add new data in item type maintenance table, id : 3', '2025-06-04 09:43:51', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (48, 2, 'file maintenance > item type > add new data', 'add new data in item type maintenance table, id : 4', '2025-06-04 09:44:03', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (49, 2, 'file maintenance > item type > add new data', 'add new data in item type maintenance table, id : 5', '2025-06-04 09:44:15', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (50, 2, 'file maintenance > item type > add new data', 'add new data in item type maintenance table, id : 6', '2025-06-04 09:44:27', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (51, 2, 'file maintenance > item type > add new data', 'add new data in item type maintenance table, id : 7', '2025-06-04 09:44:40', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (52, 2, 'file maintenance > item type > add new data', 'add new data in item type maintenance table, id : 8', '2025-06-04 09:44:49', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (53, 2, 'file maintenance > item type > add new data', 'add new data in item type maintenance table, id : 9', '2025-06-04 09:44:58', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (54, 2, 'file maintenance > item type > add new data', 'add new data in item type maintenance table, id : 10', '2025-06-04 09:45:09', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (55, 2, 'file maintenance > item type > add new data', 'add new data in item type maintenance table, id : 11', '2025-06-04 09:45:19', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (56, 2, 'file maintenance > item type > add new data', 'add new data in item type maintenance table, id : 12', '2025-06-04 09:45:29', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (57, 2, 'file maintenance > item type > add new data', 'add new data in item type maintenance table, id : 13', '2025-06-04 09:45:39', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (58, 2, 'file maintenance > item type > add new data', 'add new data in item type maintenance table, id : 14', '2025-06-04 09:45:49', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (59, 2, 'file maintenance > item type > add new data', 'add new data in item type maintenance table, id : 15', '2025-06-04 09:46:02', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (60, 2, 'file maintenance > item type > add new data', 'add new data in item type maintenance table, id : 16', '2025-06-04 09:46:13', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (61, 2, 'file maintenance > item type > add new data', 'add new data in item type maintenance table, id : 17', '2025-06-04 09:46:24', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (62, 2, 'file maintenance > item type > add new data', 'add new data in item type maintenance table, id : 18', '2025-06-04 09:46:57', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (63, 2, 'file maintenance > item type > add new data', 'add new data in item type maintenance table, id : 19', '2025-06-04 09:47:06', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (64, 2, 'file maintenance > item type > add new data', 'add new data in item type maintenance table, id : 20', '2025-06-04 09:47:16', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (65, 2, 'home > system user > update user roles', 'update system user restriction, user id : 2', '2025-06-04 09:57:11', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (66, 2, 'file maintenance > item brand > add new data', 'add new data in item brand maintenance table, id : 1', '2025-06-04 09:57:43', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (67, 2, 'file maintenance > item brand > add new data', 'add new data in item brand maintenance table, id : 2', '2025-06-04 09:57:50', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (68, 2, 'file maintenance > item brand > add new data', 'add new data in item brand maintenance table, id : 3', '2025-06-04 09:57:56', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (69, 2, 'file maintenance > item brand > add new data', 'add new data in item brand maintenance table, id : 4', '2025-06-04 09:58:02', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (70, 2, 'file maintenance > item brand > add new data', 'add new data in item brand maintenance table, id : 5', '2025-06-04 09:58:08', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (71, 2, 'file maintenance > item brand > add new data', 'add new data in item brand maintenance table, id : 6', '2025-06-04 09:58:17', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (72, 2, 'file maintenance > item brand > add new data', 'add new data in item brand maintenance table, id : 7', '2025-06-04 09:58:24', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (73, 2, 'file maintenance > item brand > add new data', 'add new data in item brand maintenance table, id : 8', '2025-06-04 09:58:30', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (74, 2, 'file maintenance > item brand > add new data', 'add new data in item brand maintenance table, id : 9', '2025-06-04 09:58:36', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (75, 2, 'file maintenance > item brand > add new data', 'add new data in item brand maintenance table, id : 10', '2025-06-04 09:58:43', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (76, 2, 'file maintenance > item brand > add new data', 'add new data in item brand maintenance table, id : 11', '2025-06-04 09:58:49', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (77, 2, 'file maintenance > item brand > add new data', 'add new data in item brand maintenance table, id : 12', '2025-06-04 09:58:57', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (78, 2, 'file maintenance > item brand > add new data', 'add new data in item brand maintenance table, id : 13', '2025-06-04 09:59:03', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (79, 2, 'file maintenance > item brand > add new data', 'add new data in item brand maintenance table, id : 14', '2025-06-04 09:59:16', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (80, 2, 'file maintenance > item brand > add new data', 'add new data in item brand maintenance table, id : 15', '2025-06-04 09:59:23', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (81, 2, 'file maintenance > item brand > add new data', 'add new data in item brand maintenance table, id : 16', '2025-06-04 09:59:37', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (82, 2, 'file maintenance > item brand > add new data', 'add new data in item brand maintenance table, id : 17', '2025-06-04 09:59:47', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (83, 2, 'file maintenance > item brand > add new data', 'add new data in item brand maintenance table, id : 18', '2025-06-04 10:02:01', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (84, 2, 'file maintenance > item brand > add new data', 'add new data in item brand maintenance table, id : 19', '2025-06-04 10:02:11', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (85, 2, 'file maintenance > item brand > add new data', 'add new data in item brand maintenance table, id : 20', '2025-06-04 10:02:22', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (86, 2, 'file maintenance > item brand > add new data', 'add new data in item brand maintenance table, id : 21', '2025-06-04 10:02:33', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (87, 2, 'file maintenance > item brand > add new data', 'add new data in item brand maintenance table, id : 22', '2025-06-04 10:02:40', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (88, 2, 'file maintenance > item brand > add new data', 'add new data in item brand maintenance table, id : 23', '2025-06-04 10:02:48', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (89, 2, 'file maintenance > item brand > add new data', 'add new data in item brand maintenance table, id : 24', '2025-06-04 10:03:07', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (90, 2, 'file maintenance > item brand > add new data', 'add new data in item brand maintenance table, id : 25', '2025-06-04 10:03:14', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (91, 2, 'file maintenance > item brand > add new data', 'add new data in item brand maintenance table, id : 26', '2025-06-04 10:03:22', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (92, 2, 'file maintenance > item brand > add new data', 'add new data in item brand maintenance table, id : 27', '2025-06-04 10:03:29', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (93, 2, 'file maintenance > item brand > add new data', 'add new data in item brand maintenance table, id : 28', '2025-06-04 10:03:42', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (94, 2, 'login page', 'login to account.', '2025-06-04 11:59:50', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (95, 2, 'login page', 'login to account.', '2025-06-04 12:06:46', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (96, 2, 'login page', 'login to account.', '2025-06-04 14:26:03', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (97, 2, 'account page', 'logout to account.', '2025-06-04 14:26:59', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (98, 2, 'login page', 'login to account.', '2025-06-05 08:15:46', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (99, 2, 'login page', 'login to account.', '2025-06-05 09:19:49', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (100, 2, 'account page', 'logout to account.', '2025-06-05 14:59:46', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (101, 2, 'login page', 'login to account.', '2025-06-05 15:18:05', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (102, 2, 'account page', 'logout to account.', '2025-06-05 15:48:11', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (103, 2, 'login page', 'login to account.', '2025-06-05 15:50:57', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (104, 2, 'account page', 'logout to account.', '2025-06-05 15:51:19', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (105, 2, 'login page', 'login to account.', '2025-06-05 22:59:35', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (106, 2, 'login page', 'login to account.', '2025-06-06 07:24:19', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (107, 2, 'account page', 'logout to account.', '2025-06-06 07:50:51', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (108, 2, 'login page', 'login to account.', '2025-06-06 07:56:00', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (109, 2, 'login page', 'login to account.', '2025-06-06 23:02:29', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (110, 2, 'file maintenance > manufacturers > add new data', 'add new data in manufacturers maintenance table, id : 4', '2025-06-06 23:22:52', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (111, 2, 'file maintenance > manufacturers > delete data', 'delete data in manufacturers , id : 4', '2025-06-06 23:24:17', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (112, 2, 'file maintenance > manufacturers > add new data', 'add new data in manufacturers maintenance table, id : 5', '2025-06-06 23:24:46', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (113, 2, 'file maintenance > manufacturers > delete data', 'delete data in manufacturers , id : 5', '2025-06-06 23:24:51', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (114, 2, 'file maintenance > manufacturers > add new data', 'add new data in manufacturers maintenance table, id : 6', '2025-06-06 23:25:33', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (115, 2, 'file maintenance > manufacturers > add new data', 'add new data in manufacturers maintenance table, id : 7', '2025-06-06 23:25:48', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (116, 2, 'file maintenance > manufacturers > add new data', 'add new data in manufacturers maintenance table, id : 8', '2025-06-06 23:25:58', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (117, 2, 'file maintenance > models > add new data', 'add new data in models maintenance table, id : 8', '2025-06-06 23:26:26', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (118, 2, 'file maintenance > models > delete data', 'delete data in models , id : 8', '2025-06-06 23:26:31', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (119, 2, 'login page', 'login to account.', '2025-06-07 13:40:06', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (120, 2, 'account page', 'logout to account.', '2025-06-07 13:42:43', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (121, 2, 'login page', 'login to account.', '2025-06-07 13:44:23', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (122, 2, 'login page', 'login to account.', '2025-06-07 23:57:34', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (123, 2, 'login page', 'login to account.', '2025-06-08 10:46:20', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (124, 2, 'home > system user > update user roles', 'update system user restriction, user id : 2', '2025-06-08 15:18:48', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (125, 2, 'file maintenance > payment type > add new data', 'add new data in payment type maintenance table, id : 1', '2025-06-08 15:18:58', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (126, 2, 'file maintenance > payment type > add new data', 'add new data in payment type maintenance table, id : 2', '2025-06-08 15:19:20', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (127, 2, 'login page', 'login to account.', '2025-06-09 10:54:00', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (128, 2, 'login page', 'login to account.', '2025-06-10 22:12:42', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (129, 2, 'home > system user > update user roles', 'update system user restriction, user id : 2', '2025-06-10 22:16:12', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (130, 2, 'login page', 'login to account.', '2025-06-11 10:23:57', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (131, 2, 'login page', 'login to account.', '2025-06-11 10:23:58', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (132, 2, 'login page', 'login to account.', '2025-06-11 10:24:00', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (133, 2, 'login page', 'login to account.', '2025-06-12 08:22:23', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (134, 2, 'login page', 'login to account.', '2025-06-12 10:29:50', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (135, 2, 'file maintenance > currency rate > update data', 'update data in currency rate , id : 3', '2025-06-12 10:48:27', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (136, 2, 'account page', 'logout to account.', '2025-06-12 17:36:41', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (137, 2, 'login page', 'login to account.', '2025-06-14 09:55:10', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (138, 2, 'login page', 'login to account.', '2025-06-15 09:19:44', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (139, 2, 'home > system user > update user roles', 'update system user restriction, user id : 2', '2025-06-15 14:25:03', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (140, 2, 'home > system user > update user roles', 'update system user restriction, user id : 2', '2025-06-15 14:28:26', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (141, 2, 'home > system user > update user roles', 'update system user restriction, user id : 2', '2025-06-15 15:26:32', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (142, 2, 'home > system user > update user roles', 'update system user restriction, user id : 2', '2025-06-15 15:27:39', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (143, 2, 'login page', 'login to account.', '2025-06-16 09:17:09', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (144, 2, 'login page', 'login to account.', '2025-06-16 15:32:12', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (145, 2, 'login page', 'login to account.', '2025-06-17 09:00:33', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (146, 2, 'login page', 'login to account.', '2025-06-17 10:53:35', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (147, 2, 'login page', 'login to account.', '2025-06-17 17:37:05', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (148, 2, 'login page', 'login to account.', '2025-06-18 12:00:53', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (149, 2, 'login page', 'login to account.', '2025-06-18 12:55:10', NULL, NULL, NULL);

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
  `customer_type` int NULL DEFAULT 0,
  `business_registration_no` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 95 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of clients
-- ----------------------------
INSERT INTO `clients` VALUES (1, '', NULL, 1, '2025-06-01 18:08:42', 2, '', NULL, 'MOHAMMED AL-FARSI', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '454453', 'CN100001', NULL, '000328429', 0, NULL);
INSERT INTO `clients` VALUES (2, '', NULL, 0, '', NULL, '2025-06-05 16:23:01', 2, 'AHMED AUTO SHOP', 'REGGIE MILLER', 'EMMA STONE', '05415105', '44565265', 'DOHA QATAR STREET 23', NULL, NULL, NULL, 'suppert@autosho.com.qa', NULL, '834 0345', '5419631', 'CN100002', '', '', 1, '734004584');
INSERT INTO `clients` VALUES (3, '', NULL, 0, '', NULL, '', NULL, 'OMAR AL-HAMADI', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '435345t6', 'CNO00001', NULL, '40542944', 0, NULL);
INSERT INTO `clients` VALUES (4, '', NULL, 0, '', NULL, '2025-06-05 15:38:59', 2, 'ALI CAR SPECIALIST AXC', 'LENA FRENN', 'JONNY PANE', '394 2342', '342 3444', 'DOHA QATAR, INDUSTRIAL AREA', NULL, NULL, NULL, 'marketing@autogalla.com', NULL, '344-0034', '847 3242', 'CNO00002', 'WWW.MACHANIC1A.COM', '', 1, '34577570003');
INSERT INTO `clients` VALUES (5, '', NULL, 0, '', NULL, '', NULL, 'YOUSEF AL-NAJJAR', NULL, NULL, '', '33454535', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '5654564', 'CNO00003', NULL, '54353334', 0, NULL);
INSERT INTO `clients` VALUES (6, '', NULL, 0, '', NULL, '', NULL, 'HASSAN AL-RASHID', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '5434344', 'CNO00004', NULL, '345345345', 0, NULL);
INSERT INTO `clients` VALUES (7, '', NULL, 0, '', NULL, '', NULL, 'KHALID AL-JABARI', NULL, NULL, '', ' ', '4928 AL KHALEEJ STREET, MUSHAIREB ', NULL, NULL, NULL, NULL, NULL, NULL, '534534', 'CNO00005', NULL, '34234234', 0, NULL);
INSERT INTO `clients` VALUES (8, '', NULL, 0, '', NULL, '', NULL, 'FAISAL AL-AHMAD', NULL, NULL, '45534555', ' ', '  QATAR', NULL, NULL, NULL, NULL, NULL, NULL, '345453', 'CNO00006', NULL, '23423423', 0, NULL);
INSERT INTO `clients` VALUES (9, '', NULL, 0, '', NULL, '', NULL, 'SAEED AL-KARIM', NULL, NULL, '', ' ', '  DOHA QATAR', NULL, NULL, NULL, NULL, NULL, NULL, '3453345', 'CNO00007', NULL, '364622325', 0, NULL);
INSERT INTO `clients` VALUES (10, '', NULL, 0, '', NULL, '', NULL, 'IBRAHIM AL-FAHAD', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '34565656', 'CNO00008', NULL, '2342342', 0, NULL);
INSERT INTO `clients` VALUES (11, '', NULL, 0, '', NULL, '', NULL, 'TARIQ AL-HARBI', NULL, NULL, '', ' 4534534535', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '567565675', 'CNO00009', NULL, '2342342', 0, NULL);
INSERT INTO `clients` VALUES (12, '', NULL, 0, '', NULL, '', NULL, 'SALIM AL-DHAHERI', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '56456', 'CNO00010', NULL, '263463346', 0, NULL);
INSERT INTO `clients` VALUES (13, '', NULL, 0, '', NULL, '', NULL, 'MAJID AL-MUTAIRI', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '5675675', 'CNO00011', NULL, '433453453', 0, NULL);
INSERT INTO `clients` VALUES (14, '', NULL, 0, '', NULL, '', NULL, 'HAMAD AL-SHAMRANI', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '5645856', 'CNO00012', NULL, '345345345', 0, NULL);
INSERT INTO `clients` VALUES (15, '', NULL, 0, '', NULL, '', NULL, 'ABDULLAH AL-SABAH', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '856567', 'CNO00013', NULL, '234234', 0, NULL);
INSERT INTO `clients` VALUES (16, '', NULL, 0, '', NULL, '', NULL, 'WALEED AL-HASHIMI', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '6756456', 'CNO00014', NULL, '34234234', 0, NULL);
INSERT INTO `clients` VALUES (17, '', NULL, 0, '', NULL, '', NULL, 'NASSER AL-TAMIMI', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '4564564', 'CNO00015', NULL, '34234234', 0, NULL);
INSERT INTO `clients` VALUES (18, '', NULL, 0, '', NULL, '2025-06-05 15:39:17', 2, 'ZAYED MACHANIC AUTO SHOP', '', '', '', '', '', NULL, NULL, NULL, '', NULL, '', '56456', 'CNO00016', '', '', 1, '800000756');
INSERT INTO `clients` VALUES (19, '', NULL, 0, '', NULL, '2025-06-05 15:40:46', 2, 'RASHID HOP W.L.L.', 'MAGIC JOANSON', 'DANN WHITE', '734 3294', '342 3242', 'DOHA QATAR', NULL, NULL, NULL, 'test@sdgmail.com', NULL, '', '734 3243', 'CNO00017', '', '', 1, '78970000-6700');
INSERT INTO `clients` VALUES (20, '', NULL, 1, '2025-06-07 05:28:25', 2, '', NULL, 'ADEL AUTO SPORTS', NULL, NULL, '', ' ', '  ', NULL, NULL, NULL, NULL, NULL, NULL, '64564', 'CNO00018', NULL, NULL, 1, '9677900007');
INSERT INTO `clients` VALUES (88, '2025-06-05 15:14:19', 2, 1, '2025-06-05 15:40:59', 2, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4564564', NULL, NULL, '23423424', 0, NULL);
INSERT INTO `clients` VALUES (89, '2025-06-05 15:41:49', 2, 1, '2025-06-05 15:42:49', 2, '', NULL, '', '', '', '', '', '', NULL, NULL, NULL, '', NULL, '', '456456', 'CNO00019', '', '28262021452', 0, '');
INSERT INTO `clients` VALUES (90, '', NULL, 0, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, NULL);
INSERT INTO `clients` VALUES (91, '', NULL, 0, '', NULL, '', NULL, 'MAKE YANADF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '5435', 0, NULL);
INSERT INTO `clients` VALUES (92, '', NULL, 0, '', NULL, '', NULL, 'MANRW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '345345', 0, NULL);
INSERT INTO `clients` VALUES (93, '2025-06-11 16:50:31', 2, 0, '', NULL, '', NULL, 'GAAS REE', '', '', '', '', '', NULL, NULL, NULL, '', NULL, '', '', 'CNO00018', '', '151515151515', 0, '');
INSERT INTO `clients` VALUES (94, '2025-06-11 16:51:25', 2, 0, '', NULL, '', NULL, 'RAESWT YAWAS', '', '', '', '', '', NULL, NULL, NULL, '', NULL, '', '9098908', 'CNO00019', '', '1512315123', 0, '');

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of crv
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of crv_print_logs
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

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
INSERT INTO `fm_adjustments_types` VALUES (1, 'RETURNS AND DAMAGED GOODS', 'RETURNS AND DAMAGED GOODS', '2023-12-27', 2);
INSERT INTO `fm_adjustments_types` VALUES (2, 'PHYSICAL COUNT DISCREPANCIES', 'PHYSICAL COUNT DISCREPANCIES', '2023-12-27', 2);
INSERT INTO `fm_adjustments_types` VALUES (3, 'OBSOLETE OR EXPIRED ITEMS', 'OBSOLETE OR EXPIRED ITEMS', '2023-12-27', 2);
INSERT INTO `fm_adjustments_types` VALUES (4, 'WRITE-OFFS', 'WRITE-OFFS', '2023-12-27', 2);
INSERT INTO `fm_adjustments_types` VALUES (5, 'SEASONAL ADJUSTMENTS', 'SEASONAL ADJUSTMENTS', '2023-12-27', 2);

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
INSERT INTO `fm_currency_rate` VALUES (3, 'EUR', '4.5', '2025-06-12', 2, '€');
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
INSERT INTO `fm_grv_transport` VALUES (2, 'TALABAT EXPRESS', 'TALABAT EXPRESS', '2024-05-15', 2);

-- ----------------------------
-- Table structure for fm_item_brand
-- ----------------------------
DROP TABLE IF EXISTS `fm_item_brand`;
CREATE TABLE `fm_item_brand`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ds` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dc` date NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_item_brand
-- ----------------------------
INSERT INTO `fm_item_brand` VALUES (1, 'DENSO', 'DENSO', '2025-06-04', 2);
INSERT INTO `fm_item_brand` VALUES (2, 'NGK', 'NGK', '2025-06-04', 2);
INSERT INTO `fm_item_brand` VALUES (3, 'BOSCH', 'BOSCH', '2025-06-04', 2);
INSERT INTO `fm_item_brand` VALUES (4, 'MAHLE', 'MAHLE', '2025-06-04', 2);
INSERT INTO `fm_item_brand` VALUES (5, 'NPR', 'NPR', '2025-06-04', 2);
INSERT INTO `fm_item_brand` VALUES (6, 'FEDERAL-MOGUL', 'FEDERAL-MOGUL', '2025-06-04', 2);
INSERT INTO `fm_item_brand` VALUES (7, 'KYB', 'KYB', '2025-06-04', 2);
INSERT INTO `fm_item_brand` VALUES (8, 'MONROE', 'MONROE', '2025-06-04', 2);
INSERT INTO `fm_item_brand` VALUES (9, 'TRW', 'TRW', '2025-06-04', 2);
INSERT INTO `fm_item_brand` VALUES (10, 'LEMFÖRDER', 'LEMFÖRDER', '2025-06-04', 2);
INSERT INTO `fm_item_brand` VALUES (11, 'MOOG', 'MOOG', '2025-06-04', 2);
INSERT INTO `fm_item_brand` VALUES (12, 'BREMBO', 'BREMBO', '2025-06-04', 2);
INSERT INTO `fm_item_brand` VALUES (13, 'AKEBONO', 'AKEBONO', '2025-06-04', 2);
INSERT INTO `fm_item_brand` VALUES (14, 'ATE', 'ATE', '2025-06-04', 2);
INSERT INTO `fm_item_brand` VALUES (15, 'NISSIN', 'NISSIN', '2025-06-04', 2);
INSERT INTO `fm_item_brand` VALUES (16, 'SAKURA', 'SAKURA', '2025-06-04', 2);
INSERT INTO `fm_item_brand` VALUES (17, 'MANN', 'MANN', '2025-06-04', 2);
INSERT INTO `fm_item_brand` VALUES (18, 'ACDELCO', 'ACDELCO', '2025-06-04', 2);
INSERT INTO `fm_item_brand` VALUES (19, 'NISSENS', 'NISSENS', '2025-06-04', 2);
INSERT INTO `fm_item_brand` VALUES (20, 'VALEO', 'VALEO', '2025-06-04', 2);
INSERT INTO `fm_item_brand` VALUES (21, 'BEHR', 'BEHR', '2025-06-04', 2);
INSERT INTO `fm_item_brand` VALUES (22, 'DELPHI', 'DELPHI', '2025-06-04', 2);
INSERT INTO `fm_item_brand` VALUES (23, 'WALBRO', 'WALBRO', '2025-06-04', 2);
INSERT INTO `fm_item_brand` VALUES (24, 'TOYOTA GENUINE PARTS', 'TOYOTA GENUINE PARTS', '2025-06-04', 2);
INSERT INTO `fm_item_brand` VALUES (25, 'HONDA GENUINE PARTS', 'HONDA GENUINE PARTS', '2025-06-04', 2);
INSERT INTO `fm_item_brand` VALUES (26, 'MOPAR', 'MOPAR', '2025-06-04', 2);
INSERT INTO `fm_item_brand` VALUES (27, 'MOTORCRAFT', 'MOTORCRAFT', '2025-06-04', 2);
INSERT INTO `fm_item_brand` VALUES (28, 'HYUNDAI MOBIS', 'HYUNDAI MOBIS', '2025-06-04', 2);
INSERT INTO `fm_item_brand` VALUES (29, 'CCCCC1', 'CCCCC1', NULL, NULL);
INSERT INTO `fm_item_brand` VALUES (30, 'QQQQQ3', 'QQQQQ3', NULL, NULL);
INSERT INTO `fm_item_brand` VALUES (31, 'MMM3', 'MMM3', NULL, NULL);
INSERT INTO `fm_item_brand` VALUES (32, 'PORSCHE', 'PORSCHE', NULL, NULL);

-- ----------------------------
-- Table structure for fm_item_category
-- ----------------------------
DROP TABLE IF EXISTS `fm_item_category`;
CREATE TABLE `fm_item_category`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ds` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dc` date NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_item_category
-- ----------------------------
INSERT INTO `fm_item_category` VALUES (1, 'ENGINE COMPONENTS', 'ENGINE COMPONENTS', '2025-06-04', 2);
INSERT INTO `fm_item_category` VALUES (2, 'ELECTRICAL', 'ELECTRICAL', '2025-06-04', 2);
INSERT INTO `fm_item_category` VALUES (3, 'SUSPENSION & STEERING', 'SUSPENSION AND STEERING COMPONENTS', '2025-06-04', 2);
INSERT INTO `fm_item_category` VALUES (4, 'BRAKE SYSTEM', 'BRAKE-RELATED COMPONENTS', '2025-06-04', 2);
INSERT INTO `fm_item_category` VALUES (5, 'TRANSMISSION', 'GEARBOX, CLUTCH, ETC.', '2025-06-04', 2);
INSERT INTO `fm_item_category` VALUES (6, 'EXHAUST SYSTEM', 'EXHAUST PIPES, MUFFLERS, ETC.', '2025-06-04', 2);
INSERT INTO `fm_item_category` VALUES (7, 'COOLING SYSTEM', 'RADIATOR, THERMOSTAT, ETC.', '2025-06-04', 2);
INSERT INTO `fm_item_category` VALUES (8, 'FILTERS', 'AIR, FUEL, OIL FILTERS', '2025-06-04', 2);
INSERT INTO `fm_item_category` VALUES (9, 'BODY & TRIM', 'DOORS, LIGHTS, BUMPERS', '2025-06-04', 2);
INSERT INTO `fm_item_category` VALUES (10, 'TIRES & WHEELS', 'TIRES, RIMS, WHEEL ACCESSORIES', '2025-06-04', 2);
INSERT INTO `fm_item_category` VALUES (11, 'FUEL SYSTEM', 'FUEL PUMP, INJECTORS, LINES', '2025-06-04', 2);
INSERT INTO `fm_item_category` VALUES (12, 'LUBRICANTS & FLUIDS', 'OILS, BRAKE FLUID, COOLANTS', '2025-06-04', 2);
INSERT INTO `fm_item_category` VALUES (13, 'ACCESSORIES', 'FLOOR MATS, COVERS, ELECTRONICS', '2025-06-04', 2);
INSERT INTO `fm_item_category` VALUES (14, 'HVAC SYSTEM', 'AIR CONDITIONING, BLOWER MOTORS', '2025-06-04', 2);
INSERT INTO `fm_item_category` VALUES (15, 'TOOLS & EQUIPMENT', 'TOOLS USED IN SERVICING VEHICLES', '2025-06-04', 2);
INSERT INTO `fm_item_category` VALUES (16, 'AAAA1', 'AAAA1', NULL, NULL);
INSERT INTO `fm_item_category` VALUES (17, 'QQQQQ1', 'QQQQQ1', NULL, NULL);
INSERT INTO `fm_item_category` VALUES (18, 'MMM1', 'MMM1', NULL, NULL);

-- ----------------------------
-- Table structure for fm_item_type
-- ----------------------------
DROP TABLE IF EXISTS `fm_item_type`;
CREATE TABLE `fm_item_type`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ds` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dc` date NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_item_type
-- ----------------------------
INSERT INTO `fm_item_type` VALUES (1, 'OIL FILTER', 'REMOVES CONTAMINANTS FROM ENGINE OIL', '2025-06-04', 2);
INSERT INTO `fm_item_type` VALUES (2, 'AIR FILTER', 'FILTERS AIR GOING INTO ENGINE', '2025-06-04', 2);
INSERT INTO `fm_item_type` VALUES (3, 'BRAKE PAD', 'FRICTION PART FOR BRAKING', '2025-06-04', 2);
INSERT INTO `fm_item_type` VALUES (4, 'SPARK PLUG', 'IGNITES AIR-FUEL MIXTURE', '2025-06-04', 2);
INSERT INTO `fm_item_type` VALUES (5, 'TIMING BELT', 'SYNCHRONIZES ENGINE ROTATION', '2025-06-04', 2);
INSERT INTO `fm_item_type` VALUES (6, 'RADIATOR', 'COOLS ENGINE COOLANT', '2025-06-04', 2);
INSERT INTO `fm_item_type` VALUES (7, 'HEADLIGHT', 'FRONT LIGHTING', '2025-06-04', 2);
INSERT INTO `fm_item_type` VALUES (8, 'ALTERNATOR', 'GENERATES ELECTRICAL POWER', '2025-06-04', 2);
INSERT INTO `fm_item_type` VALUES (9, 'BATTERY', 'STORES ELECTRICAL ENERGY', '2025-06-04', 2);
INSERT INTO `fm_item_type` VALUES (10, 'SHOCK ABSORBER', 'PART OF SUSPENSION', '2025-06-04', 2);
INSERT INTO `fm_item_type` VALUES (11, 'CLUTCH DISC', 'CONNECTS ENGINE TO TRANSMISSION', '2025-06-04', 2);
INSERT INTO `fm_item_type` VALUES (12, 'MUFFLER', 'REDUCES ENGINE NOISE', '2025-06-04', 2);
INSERT INTO `fm_item_type` VALUES (13, 'WINDSHIELD WIPER BLADE', 'CLEARS WINDSHIELD', '2025-06-04', 2);
INSERT INTO `fm_item_type` VALUES (14, 'FUEL PUMP', 'PUMPS FUEL TO ENGINE', '2025-06-04', 2);
INSERT INTO `fm_item_type` VALUES (15, 'ENGINE OIL', 'LUBRICATES ENGINE', '2025-06-04', 2);
INSERT INTO `fm_item_type` VALUES (16, 'BRAKE FLUID', 'TRANSMITS BRAKING FORCE', '2025-06-04', 2);
INSERT INTO `fm_item_type` VALUES (17, 'AC COMPRESSOR', 'COMPRESSES REFRIGERANT', '2025-06-04', 2);
INSERT INTO `fm_item_type` VALUES (18, 'WHEEL BEARING', 'SUPPORTS WHEEL ROTATION', '2025-06-04', 2);
INSERT INTO `fm_item_type` VALUES (19, 'TIE ROD END', 'STEERING MECHANISM PART', '2025-06-04', 2);
INSERT INTO `fm_item_type` VALUES (20, 'FUSE BOX', 'HOUSES ELECTRICAL FUSES', '2025-06-04', 2);
INSERT INTO `fm_item_type` VALUES (21, 'BBBB1', 'BBBB1', NULL, NULL);
INSERT INTO `fm_item_type` VALUES (22, 'QQQQQ2', 'QQQQQ2', NULL, NULL);
INSERT INTO `fm_item_type` VALUES (23, 'MMM2', 'MMM2', NULL, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_manufacturers
-- ----------------------------
INSERT INTO `fm_manufacturers` VALUES (1, 'TOYOTA', 'TOYOTA', '2025-06-01', 2);
INSERT INTO `fm_manufacturers` VALUES (2, 'HONDA', 'HONDA', '2025-06-01', 2);
INSERT INTO `fm_manufacturers` VALUES (3, 'PORSCHE', 'PORSCHE', '2025-06-01', 2);
INSERT INTO `fm_manufacturers` VALUES (6, 'FERRARI', 'FERRARI', '2025-06-07', 2);
INSERT INTO `fm_manufacturers` VALUES (7, 'AUDI', 'AUDI', '2025-06-07', 2);
INSERT INTO `fm_manufacturers` VALUES (8, 'HYUNDAI', 'HYUNDAI', '2025-06-07', 2);

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
  `model_year` int NULL DEFAULT NULL,
  `manufacturer_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_models
-- ----------------------------
INSERT INTO `fm_models` VALUES (1, '911 TURBO', '911 TURBO', '2025-06-01', 2, 2024, 3);
INSERT INTO `fm_models` VALUES (2, '911 TURBO RS', '911 TURBO RS', '2025-06-01', 2, 2024, 3);
INSERT INTO `fm_models` VALUES (3, 'CAYANNE', 'CAYANNE', '2025-06-01', 2, 2024, 3);
INSERT INTO `fm_models` VALUES (4, 'YARIS', 'YARIS SEDAN', '2025-06-01', 2, 2022, 1);
INSERT INTO `fm_models` VALUES (5, 'INNOVA G', 'BASE MODEL OF INNOVA', '2025-06-01', 2, 2023, 1);
INSERT INTO `fm_models` VALUES (6, 'CIVIC RS', 'CIVIC RS', '2025-06-01', 2, 2023, 2);
INSERT INTO `fm_models` VALUES (7, 'CITY G', 'CITY G', '2025-06-01', 2, 2022, 2);

-- ----------------------------
-- Table structure for fm_payment_type
-- ----------------------------
DROP TABLE IF EXISTS `fm_payment_type`;
CREATE TABLE `fm_payment_type`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ds` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dc` date NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_payment_type
-- ----------------------------
INSERT INTO `fm_payment_type` VALUES (1, 'CASH', 'CASH', '2025-06-08', 2);
INSERT INTO `fm_payment_type` VALUES (2, 'CREDIT', 'CREDIT', '2025-06-08', 2);

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
  `retail_price` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0',
  `old_unit_cost_price` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0',
  `old_qty` int NULL DEFAULT 0,
  `receiving_history` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `issuance_history` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `supplier_price` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `applicable_vehicle_model_ids` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `cross_compatible_part_ids` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `item_type_id` int NULL DEFAULT NULL,
  `item_category_id` int NULL DEFAULT NULL,
  `item_brand_id` int NULL DEFAULT NULL,
  `bin_1` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `bin_2` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `bin_3` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `min_qty` int NULL DEFAULT NULL,
  `max_qty` int NULL DEFAULT NULL,
  `picture_1` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `picture_2` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `picture_3` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `primary_vehicle_model_id` int NULL DEFAULT NULL,
  `applicable_vehicle_model` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC STATS_AUTO_RECALC = 1;

-- ----------------------------
-- Records of inventory
-- ----------------------------
INSERT INTO `inventory` VALUES (1, '2025-06-17 10:53:12', 1, 0, NULL, NULL, '2025-06-17 10:53:12', 1, 'ITM0001', 'Item Name 1', 27, 'manual', '376.28', '712', '0', 31, '[{\"rr_id\":\"2\",\"date\":\"2025-06-17 16:13\",\"qty\":112,\"ucp\":148.23},{\"rr_id\":\"1\",\"date\":\"2025-06-17 16:24\",\"qty\":31,\"ucp\":362.19},{\"rr_id\":\"2\",\"date\":\"2025-06-17 16:37\",\"qty\":41,\"ucp\":3018.15},{\"rr_id\":\"1\",\"date\":\"2025-06-17 17:00\",\"qty\":31,\"ucp\":355},{\"rr_id\":\"2\",\"date\":\"2025-06-17 17:02\",\"qty\":82,\"ucp\":367.16},{\"rr_id\":\"1\",\"date\":\"2025-06-18 18:47\",\"qty\":31,\"ucp\":376.28}]', '[{\"ii_id\":1,\"date\":\"2025-06-17 17:09\",\"qty\":0,\"ucp\":\"367.16\"},{\"ii_id\":2,\"date\":\"2025-06-18 19:04\",\"qty\":27,\"ucp\":\"376.28\"}]', '355', '[1,2]', '[3,4]', 4, 2, 5, 'A1', 'B2', 'C3', 12, 51, '', '', '', 1, 'Sedan, SUV');
INSERT INTO `inventory` VALUES (2, '2025-06-17 10:53:12', 1, 0, NULL, NULL, '2025-06-17 10:53:12', 1, 'ITM0002', 'Item Name 2', 88, 'manual', '641.56', '985', '466.38', 94, '[{\"rr_id\":\"1\",\"date\":\"2025-06-17 15:59\",\"qty\":115,\"ucp\":346.39},{\"rr_id\":\"2\",\"date\":\"2025-06-17 16:13\",\"qty\":146,\"ucp\":443.4},{\"rr_id\":\"1\",\"date\":\"2025-06-17 16:24\",\"qty\":41,\"ucp\":448.91},{\"rr_id\":\"1\",\"date\":\"2025-06-17 16:36\",\"qty\":53,\"ucp\":796.68},{\"rr_id\":\"1\",\"date\":\"2025-06-17 17:00\",\"qty\":41,\"ucp\":440},{\"rr_id\":\"2\",\"date\":\"2025-06-17 17:02\",\"qty\":102,\"ucp\":456.85},{\"rr_id\":\"1\",\"date\":\"2025-06-18 18:47\",\"qty\":41,\"ucp\":466.38},{\"rr_id\":\"2\",\"date\":\"2025-06-18 18:47\",\"qty\":94,\"ucp\":641.56}]', '[{\"ii_id\":1,\"date\":\"2025-06-17 17:09\",\"qty\":0,\"ucp\":\"456.85\"},{\"ii_id\":2,\"date\":\"2025-06-18 19:04\",\"qty\":88,\"ucp\":\"641.56\"}]', '735', '[1,2]', '[3,4]', 4, 3, 2, 'A1', 'B2', 'C3', 12, 50, '', '', '', 10, 'Sedan, SUV');
INSERT INTO `inventory` VALUES (3, '2025-06-17 10:53:12', 1, 0, NULL, NULL, '2025-06-17 10:53:12', 1, 'ITM0003', 'Item Name 3', 47, 'manual', '455.78', '1042', '0', 51, '[{\"rr_id\":\"1\",\"date\":\"2025-06-17 16:24\",\"qty\":51,\"ucp\":438.71},{\"rr_id\":\"1\",\"date\":\"2025-06-17 17:00\",\"qty\":51,\"ucp\":430},{\"rr_id\":\"2\",\"date\":\"2025-06-17 17:02\",\"qty\":132,\"ucp\":446.9},{\"rr_id\":\"1\",\"date\":\"2025-06-18 18:47\",\"qty\":51,\"ucp\":455.78}]', '[{\"ii_id\":1,\"date\":\"2025-06-17 17:09\",\"qty\":0,\"ucp\":\"446.9\"},{\"ii_id\":2,\"date\":\"2025-06-18 19:04\",\"qty\":47,\"ucp\":\"455.78\"}]', '430', '[1,2]', '[3,4]', 2, 3, 3, 'A1', 'B2', 'C3', 7, 31, '', '', '', 4, 'Sedan, SUV');
INSERT INTO `inventory` VALUES (4, '2025-06-17 10:53:12', 1, 0, NULL, NULL, '2025-06-17 10:53:12', 1, 'ITM0004', 'Item Name 4', 0, 'manual', '0', '362', '0', 0, '[{\"rr_id\":\"2\",\"date\":\"2025-06-17 17:02\",\"qty\":71,\"ucp\":0}]', '', '0', '[1,2]', '[3,4]', 1, 4, 3, 'A1', 'B2', 'C3', 13, 42, '', '', '', 3, 'Sedan, SUV');
INSERT INTO `inventory` VALUES (5, '2025-06-17 10:53:12', 1, 0, NULL, NULL, '2025-06-17 10:53:12', 1, 'ITM0005', 'Item Name 5', 0, 'manual', '0', '1040', '0', 0, '[{\"rr_id\":\"2\",\"date\":\"2025-06-17 16:13\",\"qty\":69,\"ucp\":410.98},{\"rr_id\":\"2\",\"date\":\"2025-06-17 16:37\",\"qty\":61,\"ucp\":2103.56}]', '', '0', '[1,2]', '[3,4]', 3, 2, 5, 'A1', 'B2', 'C3', 7, 24, '', '', '', 10, 'Sedan, SUV');
INSERT INTO `inventory` VALUES (6, '2025-06-17 10:53:12', 1, 0, NULL, NULL, '2025-06-17 10:53:12', 1, 'ITM0006', 'Item Name 6', 61, 'manual', '360.38', '489', '0', 0, '[{\"rr_id\":\"2\",\"date\":\"2025-06-17 16:13\",\"qty\":61,\"ucp\":119.97},{\"rr_id\":\"1\",\"date\":\"2025-06-17 16:24\",\"qty\":61,\"ucp\":346.89},{\"rr_id\":\"1\",\"date\":\"2025-06-17 17:00\",\"qty\":61,\"ucp\":340},{\"rr_id\":\"1\",\"date\":\"2025-06-18 18:47\",\"qty\":61,\"ucp\":360.38}]', '', '340', '[1,2]', '[3,4]', 4, 4, 3, 'A1', 'B2', 'C3', 14, 53, '', '', '', 1, 'Sedan, SUV');
INSERT INTO `inventory` VALUES (7, '2025-06-17 10:53:12', 1, 0, NULL, NULL, '2025-06-17 10:53:12', 1, 'ITM0007', 'Item Name 7', 0, 'manual', '0', '952', '0', 0, '[{\"rr_id\":\"2\",\"date\":\"2025-06-17 16:37\",\"qty\":51,\"ucp\":2515.12}]', '', '0', '[1,2]', '[3,4]', 1, 3, 2, 'A1', 'B2', 'C3', 9, 46, '', '', '', 3, 'Sedan, SUV');
INSERT INTO `inventory` VALUES (8, '2025-06-17 10:53:12', 1, 0, NULL, NULL, '2025-06-17 10:53:12', 1, 'ITM0008', 'Item Name 8', 0, 'manual', '0', '962', '743', 20, '', '', '0', '[1,2]', '[3,4]', 2, 2, 3, 'A1', 'B2', 'C3', 10, 52, '', '', '', 3, 'Sedan, SUV');
INSERT INTO `inventory` VALUES (9, '2025-06-17 10:53:12', 1, 0, NULL, NULL, '2025-06-17 10:53:12', 1, 'ITM0009', 'Item Name 9', 0, 'manual', '0', '748', '478', 14, '', '', '0', '[1,2]', '[3,4]', 5, 4, 3, 'A1', 'B2', 'C3', 13, 39, '', '', '', 1, 'Sedan, SUV');
INSERT INTO `inventory` VALUES (10, '2025-06-17 10:53:12', 1, 0, NULL, NULL, '2025-06-17 10:53:12', 1, 'ITM0010', 'Item Name 10', 0, 'manual', '0', '849', '0', 16, '[{\"rr_id\":\"2\",\"date\":\"2025-06-17 16:13\",\"qty\":47,\"ucp\":503.88}]', '', '0', '[1,2]', '[3,4]', 5, 5, 5, 'A1', 'B2', 'C3', 5, 33, '', '', '', 8, 'Sedan, SUV');
INSERT INTO `inventory` VALUES (11, '2025-06-17 10:53:12', 1, 0, NULL, NULL, '2025-06-17 10:53:12', 1, 'ITM0011', 'Item Name 11', 0, 'manual', '0', '869', '623', 6, '', '', '0', '[1,2]', '[3,4]', 3, 4, 1, 'A1', 'B2', 'C3', 12, 28, '', '', '', 9, 'Sedan, SUV');
INSERT INTO `inventory` VALUES (12, '2025-06-17 10:53:12', 1, 0, NULL, NULL, '2025-06-17 10:53:12', 1, 'ITM0012', 'Item Name 12', 0, 'manual', '0', '308', '0', 80, '[{\"rr_id\":\"2\",\"date\":\"2025-06-17 16:13\",\"qty\":111,\"ucp\":46.7}]', '', '0', '[1,2]', '[3,4]', 4, 1, 4, 'A1', 'B2', 'C3', 7, 38, '', '', '', 6, 'Sedan, SUV');
INSERT INTO `inventory` VALUES (13, '2025-06-17 10:53:12', 1, 0, NULL, NULL, '2025-06-17 10:53:12', 1, 'ITM0013', 'Item Name 13', 0, 'manual', '0', '770', '463', 8, '', '', '0', '[1,2]', '[3,4]', 3, 1, 3, 'A1', 'B2', 'C3', 9, 45, '', '', '', 3, 'Sedan, SUV');
INSERT INTO `inventory` VALUES (14, '2025-06-17 10:53:12', 1, 0, NULL, NULL, '2025-06-17 10:53:12', 1, 'ITM0014', 'Item Name 14', 41, 'manual', '474.71', '747', '0', 0, '[{\"rr_id\":\"1\",\"date\":\"2025-06-17 15:59\",\"qty\":78,\"ucp\":241.35},{\"rr_id\":\"1\",\"date\":\"2025-06-17 16:36\",\"qty\":41,\"ucp\":486.68},{\"rr_id\":\"2\",\"date\":\"2025-06-18 18:47\",\"qty\":41,\"ucp\":474.71}]', '', '449', '[1,2]', '[3,4]', 4, 3, 1, 'A1', 'B2', 'C3', 6, 30, '', '', '', 5, 'Sedan, SUV');
INSERT INTO `inventory` VALUES (15, '2025-06-17 10:53:12', 1, 0, NULL, NULL, '2025-06-17 10:53:12', 1, 'ITM0015', 'Item Name 15', 0, 'manual', '0', '1117', '902', 0, '', '', '0', '[1,2]', '[3,4]', 5, 3, 2, 'A1', 'B2', 'C3', 6, 22, '', '', '', 7, 'Sedan, SUV');
INSERT INTO `inventory` VALUES (16, '2025-06-17 10:53:12', 1, 0, NULL, NULL, '2025-06-17 10:53:12', 1, 'ITM0016', 'Item Name 16', 0, 'manual', '0', '924', '792', 6, '', '', '0', '[1,2]', '[3,4]', 2, 1, 2, 'A1', 'B2', 'C3', 12, 60, '', '', '', 7, 'Sedan, SUV');
INSERT INTO `inventory` VALUES (17, '2025-06-17 10:53:12', 1, 0, NULL, NULL, '2025-06-17 10:53:12', 1, 'ITM0017', 'Item Name 17', 0, 'manual', '0', '893', '610', 6, '', '', '0', '[1,2]', '[3,4]', 2, 2, 3, 'A1', 'B2', 'C3', 15, 52, '', '', '', 6, 'Sedan, SUV');
INSERT INTO `inventory` VALUES (18, '2025-06-17 10:53:12', 1, 0, NULL, NULL, '2025-06-17 10:53:12', 1, 'ITM0018', 'Item Name 18', 0, 'manual', '0', '965', '626', 9, '', '', '0', '[1,2]', '[3,4]', 2, 3, 2, 'A1', 'B2', 'C3', 5, 16, '', '', '', 9, 'Sedan, SUV');
INSERT INTO `inventory` VALUES (19, '2025-06-17 10:53:12', 1, 0, NULL, NULL, '2025-06-17 10:53:12', 1, 'ITM0019', 'Item Name 19', 0, 'manual', '0', '349', '105', 1, '', '', '0', '[1,2]', '[3,4]', 5, 2, 5, 'A1', 'B2', 'C3', 5, 44, '', '', '', 8, 'Sedan, SUV');
INSERT INTO `inventory` VALUES (20, '2025-06-17 10:53:12', 1, 0, NULL, NULL, '2025-06-17 10:53:12', 1, 'ITM0020', 'Item Name 20', 0, 'manual', '0', '570', '424', 14, '', '', '0', '[1,2]', '[3,4]', 1, 5, 1, 'A1', 'B2', 'C3', 12, 54, '', '', '', 2, 'Sedan, SUV');
INSERT INTO `inventory` VALUES (21, '2025-06-17 10:53:12', 1, 0, NULL, NULL, '2025-06-17 10:53:12', 1, 'ITM0021', 'Item Name 21', 0, 'manual', '0', '687', '599', 8, '', '', '0', '[1,2]', '[3,4]', 4, 1, 3, 'A1', 'B2', 'C3', 15, 32, '', '', '', 8, 'Sedan, SUV');
INSERT INTO `inventory` VALUES (22, '2025-06-17 10:53:12', 1, 0, NULL, NULL, '2025-06-17 10:53:12', 1, 'ITM0022', 'Item Name 22', 0, 'manual', '0', '1262', '0', 49, '[{\"rr_id\":\"2\",\"date\":\"2025-06-17 16:13\",\"qty\":70,\"ucp\":318.04}]', '', '0', '[1,2]', '[3,4]', 1, 3, 2, 'A1', 'B2', 'C3', 5, 45, '', '', '', 7, 'Sedan, SUV');
INSERT INTO `inventory` VALUES (23, '2025-06-17 10:53:12', 1, 0, NULL, NULL, '2025-06-17 10:53:12', 1, 'ITM0023', 'Item Name 23', 52, 'manual', '454.54', '532', '445.18', 31, '[{\"rr_id\":\"1\",\"date\":\"2025-06-17 15:59\",\"qty\":51,\"ucp\":186.53},{\"rr_id\":\"1\",\"date\":\"2025-06-17 16:24\",\"qty\":31,\"ucp\":428.51},{\"rr_id\":\"1\",\"date\":\"2025-06-17 16:36\",\"qty\":21,\"ucp\":480.18},{\"rr_id\":\"1\",\"date\":\"2025-06-17 17:00\",\"qty\":31,\"ucp\":420},{\"rr_id\":\"1\",\"date\":\"2025-06-18 18:47\",\"qty\":31,\"ucp\":445.18},{\"rr_id\":\"2\",\"date\":\"2025-06-18 18:47\",\"qty\":52,\"ucp\":454.54}]', '', '443', '[1,2]', '[3,4]', 4, 1, 2, 'A1', 'B2', 'C3', 6, 42, '', '', '', 6, 'Sedan, SUV');
INSERT INTO `inventory` VALUES (24, '2025-06-17 10:53:12', 1, 0, NULL, NULL, '2025-06-17 10:53:12', 1, 'ITM0024', 'Item Name 24', 62, 'manual', '381.09', '672', '243.79', 41, '[{\"rr_id\":\"1\",\"date\":\"2025-06-17 15:59\",\"qty\":51,\"ucp\":258.54},{\"rr_id\":\"1\",\"date\":\"2025-06-17 16:24\",\"qty\":41,\"ucp\":234.66},{\"rr_id\":\"1\",\"date\":\"2025-06-17 16:36\",\"qty\":21,\"ucp\":665.53},{\"rr_id\":\"1\",\"date\":\"2025-06-17 17:00\",\"qty\":41,\"ucp\":230},{\"rr_id\":\"1\",\"date\":\"2025-06-18 18:47\",\"qty\":41,\"ucp\":243.79},{\"rr_id\":\"2\",\"date\":\"2025-06-18 18:47\",\"qty\":62,\"ucp\":381.09}]', '', '614', '[1,2]', '[3,4]', 5, 1, 2, 'A1', 'B2', 'C3', 13, 52, '', '', '', 4, 'Sedan, SUV');
INSERT INTO `inventory` VALUES (25, '2025-06-17 10:53:12', 1, 0, NULL, NULL, '2025-06-17 10:53:12', 1, 'ITM0025', 'Item Name 25', 0, 'manual', '0', '409', '0', 0, '[{\"rr_id\":\"2\",\"date\":\"2025-06-17 16:37\",\"qty\":71,\"ucp\":1509.07}]', '', '0', '[1,2]', '[3,4]', 3, 2, 5, 'A1', 'B2', 'C3', 11, 39, '', '', '', 3, 'Sedan, SUV');
INSERT INTO `inventory` VALUES (26, '2025-06-17 10:53:12', 1, 0, NULL, NULL, '2025-06-17 10:53:12', 1, 'ITM0026', 'Item Name 26', 0, 'manual', '0', '1173', '903', 6, '', '', '0', '[1,2]', '[3,4]', 4, 1, 2, 'A1', 'B2', 'C3', 9, 44, '', '', '', 1, 'Sedan, SUV');
INSERT INTO `inventory` VALUES (27, '2025-06-17 10:53:12', 1, 0, NULL, NULL, '2025-06-17 10:53:12', 1, 'ITM0027', 'Item Name 27', 0, 'manual', '0', '403', '218', 15, '', '', '0', '[1,2]', '[3,4]', 1, 3, 5, 'A1', 'B2', 'C3', 9, 43, '', '', '', 8, 'Sedan, SUV');
INSERT INTO `inventory` VALUES (28, '2025-06-17 10:53:12', 1, 0, NULL, NULL, '2025-06-17 10:53:12', 1, 'ITM0028', 'Item Name 28', 0, 'manual', '0', '438', '208', 1, '', '', '0', '[1,2]', '[3,4]', 4, 5, 5, 'A1', 'B2', 'C3', 6, 30, '', '', '', 7, 'Sedan, SUV');
INSERT INTO `inventory` VALUES (29, '2025-06-17 10:53:12', 1, 0, NULL, NULL, '2025-06-17 10:53:12', 1, 'ITM0029', 'Item Name 29', 0, 'manual', '0', '992', '693', 7, '', '', '0', '[1,2]', '[3,4]', 3, 5, 3, 'A1', 'B2', 'C3', 14, 37, '', '', '', 3, 'Sedan, SUV');
INSERT INTO `inventory` VALUES (30, '2025-06-17 10:53:12', 1, 0, NULL, NULL, '2025-06-17 10:53:12', 1, 'ITM0030', 'Item Name 30', 0, 'manual', '0', '1077', '0', 0, '[{\"rr_id\":\"2\",\"date\":\"2025-06-17 16:37\",\"qty\":51,\"ucp\":2012.1}]', '', '0', '[1,2]', '[3,4]', 3, 4, 5, 'A1', 'B2', 'C3', 9, 20, '', '', '', 2, 'Sedan, SUV');

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
  `issuance_item_id` int NULL DEFAULT NULL,
  `unit_cost_price` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `vehicle_id` int NULL DEFAULT NULL,
  `retail_price` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `customer_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC STATS_AUTO_RECALC = 1;

-- ----------------------------
-- Records of inventory_movement
-- ----------------------------
INSERT INTO `inventory_movement` VALUES (1, '2025-06-17 17:00', 2, 0, '', NULL, '', NULL, 1, 'receiving', '0', '31', '31', 1, NULL, 1, NULL, NULL, '355', 7, NULL, NULL);
INSERT INTO `inventory_movement` VALUES (2, '2025-06-17 17:00', 2, 0, '', NULL, '', NULL, 2, 'receiving', '0', '41', '41', 1, NULL, 1, NULL, NULL, '440', 7, NULL, NULL);
INSERT INTO `inventory_movement` VALUES (3, '2025-06-17 17:00', 2, 0, '', NULL, '', NULL, 3, 'receiving', '0', '51', '51', 1, NULL, 1, NULL, NULL, '430', 7, NULL, NULL);
INSERT INTO `inventory_movement` VALUES (4, '2025-06-17 17:00', 2, 0, '', NULL, '', NULL, 6, 'receiving', '0', '61', '61', 1, NULL, 1, NULL, NULL, '340', 7, NULL, NULL);
INSERT INTO `inventory_movement` VALUES (5, '2025-06-17 17:00', 2, 0, '', NULL, '', NULL, 24, 'receiving', '0', '41', '41', 1, NULL, 1, NULL, NULL, '230', 7, NULL, NULL);
INSERT INTO `inventory_movement` VALUES (6, '2025-06-17 17:00', 2, 0, '', NULL, '', NULL, 23, 'receiving', '0', '31', '31', 1, NULL, 1, NULL, NULL, '420', 7, NULL, NULL);
INSERT INTO `inventory_movement` VALUES (7, '2025-06-17 17:02', 2, 0, '', NULL, '', NULL, 1, 'receiving', '31', '51', '82', 1, NULL, 2, NULL, NULL, '367.16', 11, NULL, NULL);
INSERT INTO `inventory_movement` VALUES (8, '2025-06-17 17:02', 2, 0, '', NULL, '', NULL, 2, 'receiving', '41', '61', '102', 1, NULL, 2, NULL, NULL, '456.85', 11, NULL, NULL);
INSERT INTO `inventory_movement` VALUES (9, '2025-06-17 17:02', 2, 0, '', NULL, '', NULL, 3, 'receiving', '51', '81', '132', 1, NULL, 2, NULL, NULL, '446.9', 11, NULL, NULL);
INSERT INTO `inventory_movement` VALUES (10, '2025-06-17 17:02', 2, 0, '', NULL, '', NULL, 4, 'receiving', '0', '71', '71', 1, NULL, 2, NULL, NULL, '0', 11, NULL, NULL);
INSERT INTO `inventory_movement` VALUES (11, '2025-06-17 17:09', 2, 0, '', NULL, '', NULL, 1, 'sales order', '3', '3', '0', 0, NULL, 1, NULL, 1, '367.16', 10, '712', 90);
INSERT INTO `inventory_movement` VALUES (12, '2025-06-17 17:09', 2, 0, '', NULL, '', NULL, 2, 'sales order', '4', '4', '0', 0, NULL, 1, NULL, 2, '456.85', 10, '985', 90);
INSERT INTO `inventory_movement` VALUES (13, '2025-06-17 17:09', 2, 0, '', NULL, '', NULL, 3, 'sales order', '5', '5', '0', 0, NULL, 1, NULL, 3, '446.9', 10, '1042', 90);
INSERT INTO `inventory_movement` VALUES (14, '2025-06-18 18:47', 2, 0, '', NULL, '', NULL, 1, 'receiving', '0', '31', '31', 1, NULL, 1, NULL, NULL, '376.28', 7, NULL, NULL);
INSERT INTO `inventory_movement` VALUES (15, '2025-06-18 18:47', 2, 0, '', NULL, '', NULL, 2, 'receiving', '0', '41', '41', 1, NULL, 1, NULL, NULL, '466.38', 7, NULL, NULL);
INSERT INTO `inventory_movement` VALUES (16, '2025-06-18 18:47', 2, 0, '', NULL, '', NULL, 3, 'receiving', '0', '51', '51', 1, NULL, 1, NULL, NULL, '455.78', 7, NULL, NULL);
INSERT INTO `inventory_movement` VALUES (17, '2025-06-18 18:47', 2, 0, '', NULL, '', NULL, 6, 'receiving', '0', '61', '61', 1, NULL, 1, NULL, NULL, '360.38', 7, NULL, NULL);
INSERT INTO `inventory_movement` VALUES (18, '2025-06-18 18:47', 2, 0, '', NULL, '', NULL, 24, 'receiving', '0', '41', '41', 1, NULL, 1, NULL, NULL, '243.79', 7, NULL, NULL);
INSERT INTO `inventory_movement` VALUES (19, '2025-06-18 18:47', 2, 0, '', NULL, '', NULL, 23, 'receiving', '0', '31', '31', 1, NULL, 1, NULL, NULL, '445.18', 7, NULL, NULL);
INSERT INTO `inventory_movement` VALUES (20, '2025-06-18 18:47', 2, 0, '', NULL, '', NULL, 2, 'receiving', '41', '53', '94', 1, NULL, 2, NULL, NULL, '641.56', 12, NULL, NULL);
INSERT INTO `inventory_movement` VALUES (21, '2025-06-18 18:47', 2, 0, '', NULL, '', NULL, 24, 'receiving', '41', '21', '62', 1, NULL, 2, NULL, NULL, '381.09', 12, NULL, NULL);
INSERT INTO `inventory_movement` VALUES (22, '2025-06-18 18:47', 2, 0, '', NULL, '', NULL, 23, 'receiving', '31', '21', '52', 1, NULL, 2, NULL, NULL, '454.54', 12, NULL, NULL);
INSERT INTO `inventory_movement` VALUES (23, '2025-06-18 18:47', 2, 0, '', NULL, '', NULL, 14, 'receiving', '0', '41', '41', 1, NULL, 2, NULL, NULL, '474.71', 12, NULL, NULL);
INSERT INTO `inventory_movement` VALUES (24, '2025-06-18 19:04', 2, 0, '', NULL, '', NULL, 1, 'sales order', '31', '4', '27', 0, NULL, 2, NULL, 4, '376.28', 11, '712', 91);
INSERT INTO `inventory_movement` VALUES (25, '2025-06-18 19:04', 2, 0, '', NULL, '', NULL, 2, 'sales order', '94', '6', '88', 0, NULL, 2, NULL, 5, '641.56', 11, '985', 91);
INSERT INTO `inventory_movement` VALUES (26, '2025-06-18 19:04', 2, 0, '', NULL, '', NULL, 3, 'sales order', '51', '4', '47', 0, NULL, 2, NULL, 6, '455.78', 11, '1042', 91);

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
  `puchase_date` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `confirmed_date` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `customer_id` int NULL DEFAULT NULL,
  `vehicle_id` int NULL DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `grand_total_amt` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of inventory_returns
-- ----------------------------
INSERT INTO `inventory_returns` VALUES (1, '2025-06-18 22:47', 2, 0, '', NULL, '', NULL, 'TEST 1', 0, '2025-06-18', NULL, 2, '2025-06-18 19:04', NULL, 91, 11, '0789678554', '12532.00');

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
  `vehicle_id` int NULL DEFAULT NULL,
  `customer_id` int NULL DEFAULT NULL,
  `date_issued` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `issued_qty` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `discount_percentage` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `discount_amount` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `retail_price` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of inventory_returns_items
-- ----------------------------
INSERT INTO `inventory_returns_items` VALUES (1, '2025-06-18 22:47', 2, 0, '', NULL, '', NULL, 'FSD', NULL, '1', '27', '28', 0, 1, 1, 1, 11, 91, '2025-06-18 19:04', '4', '20.00', '569.60', '712');
INSERT INTO `inventory_returns_items` VALUES (2, '2025-06-18 22:47', 2, 0, '', NULL, '', NULL, 'WER', NULL, '1', '88', '89', 0, 2, 2, 1, 11, 91, '2025-06-18 19:04', '6', '20.00', '1182.00', '985');
INSERT INTO `inventory_returns_items` VALUES (3, '2025-06-18 22:47', 2, 0, '', NULL, '', NULL, 'SDF', NULL, '1', '47', '48', 0, 3, 3, 1, 11, 91, '2025-06-18 19:04', '4', '20.00', '833.60', '1042');

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
  `customer_id` int NULL DEFAULT NULL,
  `vehicle_id` int NULL DEFAULT NULL,
  `customer_type` int NULL DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `vin` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `plate_no` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `valid_until` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `customer_qid_bus` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `issuance_grand_total` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `attention_to` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `quotation_id` int NULL DEFAULT NULL,
  `pay_type_id` int NULL DEFAULT NULL,
  `discount_percentage_total` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `discount_amount_total` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of issuance
-- ----------------------------
INSERT INTO `issuance` VALUES (2, '2025-06-18 18:48:41', 2, 0, '', NULL, '', NULL, NULL, '', NULL, NULL, 1, '2025-06-18 19:04', 2, 91, 11, 1, '0789678554', 'SASDFSD234234234', '3455', NULL, '5435', '10340.80', NULL, 0, 1, '20.00', '2585.20');

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
  `vehicle_id` int NULL DEFAULT NULL,
  `issuance_id` int NULL DEFAULT NULL,
  `qty` int NULL DEFAULT NULL,
  `remarks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `inventory_id` int NULL DEFAULT NULL,
  `unit_cost_price` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `qoh` int NULL DEFAULT NULL,
  `discount_percentage` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `discount_amount` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `total` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `retail_price` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `customer_id` int NULL DEFAULT NULL,
  `supplier_price` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of issuance_items
-- ----------------------------
INSERT INTO `issuance_items` VALUES (4, '2025-06-18 18:48', 2, 0, '', NULL, '', NULL, NULL, 11, 2, 4, NULL, 1, '376.28', 31, '20.00', '569.60', NULL, '712', 91, NULL);
INSERT INTO `issuance_items` VALUES (5, '2025-06-18 18:48', 2, 0, '', NULL, '', NULL, NULL, 11, 2, 6, NULL, 2, '641.56', 94, '20.00', '1182.00', NULL, '985', 91, NULL);
INSERT INTO `issuance_items` VALUES (6, '2025-06-18 18:48', 2, 0, '', NULL, '', NULL, NULL, 11, 2, 4, NULL, 3, '455.78', 51, '20.00', '833.60', NULL, '1042', 91, NULL);

-- ----------------------------
-- Table structure for issuance_quotation
-- ----------------------------
DROP TABLE IF EXISTS `issuance_quotation`;
CREATE TABLE `issuance_quotation`  (
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
  `customer_id` int NULL DEFAULT NULL,
  `vehicle_id` int NULL DEFAULT NULL,
  `customer_type` int NULL DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `vin` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `plate_no` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `valid_until` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `customer_qid_bus` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `quotation_grand_total` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `attention_to` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `quotation_id` int NULL DEFAULT NULL,
  `discount_percentage_total` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `discount_amount_total` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of issuance_quotation
-- ----------------------------
INSERT INTO `issuance_quotation` VALUES (1, '2025-06-17 17:09:18', 2, 0, '', NULL, '', NULL, NULL, 'TEST', NULL, NULL, 1, NULL, NULL, 90, 10, 0, '856567', 'SASDFSD234234234', '3455', '2025-07-12', '234234', '7900.20', '', NULL, '30.00', '3385.80');

-- ----------------------------
-- Table structure for issuance_quotation_items
-- ----------------------------
DROP TABLE IF EXISTS `issuance_quotation_items`;
CREATE TABLE `issuance_quotation_items`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `user_id` int NULL DEFAULT NULL,
  `deleted` int NULL DEFAULT 0,
  `date_deleted` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `deleted_by` int NULL DEFAULT NULL,
  `date_modified` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `modified_by` int NULL DEFAULT NULL,
  `project_id` int NULL DEFAULT NULL,
  `vehicle_id` int NULL DEFAULT NULL,
  `issuance_quotation_id` int NULL DEFAULT NULL,
  `qty` int NULL DEFAULT NULL,
  `remarks` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `inventory_id` int NULL DEFAULT NULL,
  `unit_cost_price` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `qoh` int NULL DEFAULT NULL,
  `discount_percentage` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `discount_amount` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `total` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `retail_price` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `customer_id` int NULL DEFAULT NULL,
  `supplier_price` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of issuance_quotation_items
-- ----------------------------
INSERT INTO `issuance_quotation_items` VALUES (1, '2025-06-17 17:09', 2, 0, '', NULL, '', NULL, NULL, 10, 1, 3, NULL, 1, '367.16', 82, '30.00', '640.80', NULL, '712', 90, NULL);
INSERT INTO `issuance_quotation_items` VALUES (2, '2025-06-17 17:09', 2, 0, '', NULL, '', NULL, NULL, 10, 1, 4, NULL, 2, '456.85', 102, '30.00', '1182.00', NULL, '985', 90, NULL);
INSERT INTO `issuance_quotation_items` VALUES (3, '2025-06-17 17:09', 2, 0, '', NULL, '', NULL, NULL, 10, 1, 5, NULL, 3, '446.9', 132, '30.00', '1563.00', NULL, '1042', 90, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of menu_main
-- ----------------------------
INSERT INTO `menu_main` VALUES (1, 'Admin', NULL, 13, 'fa-star', 'admin/home', 1);
INSERT INTO `menu_main` VALUES (2, 'System Parameters', NULL, 11, 'fa-table', 'admin/file_maintenance', 0);
INSERT INTO `menu_main` VALUES (3, 'Purchasing-(P.O.)', NULL, 4, 'fa-file', 'admin/employee', 1);
INSERT INTO `menu_main` VALUES (5, 'Reports', NULL, 9, 'fa-print', 'admin/fixed_asset_transfer', 1);
INSERT INTO `menu_main` VALUES (11, 'Parts Inventory-(ITEMS)', NULL, 8, 'fa-cubes', NULL, 1);
INSERT INTO `menu_main` VALUES (13, 'Accounts', NULL, 10, 'fa-money', NULL, 0);
INSERT INTO `menu_main` VALUES (15, 'HR', NULL, 8, 'fa-users', NULL, 0);
INSERT INTO `menu_main` VALUES (16, 'Receiving-(G.R.V.)', NULL, 5, 'fa-arrow-down', NULL, 1);
INSERT INTO `menu_main` VALUES (17, 'Customer', NULL, 0, 'fa-users', NULL, 1);
INSERT INTO `menu_main` VALUES (18, 'Issuance-(S.O.)', NULL, 6, 'fa-arrow-up', NULL, 1);
INSERT INTO `menu_main` VALUES (19, 'Vehicles', NULL, 3, 'fa-car', NULL, 1);
INSERT INTO `menu_main` VALUES (20, 'Receipt', NULL, 12, 'fa-money-bill', NULL, 0);
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
) ENGINE = InnoDB AUTO_INCREMENT = 154 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of menu_sub
-- ----------------------------
INSERT INTO `menu_sub` VALUES (6, 'Departments', NULL, 1, NULL, 'maintenance/table/department', 1, 15, 0, NULL);
INSERT INTO `menu_sub` VALUES (8, 'System Users', 'List of all administrator user in the system.', 3, NULL, 'home/system_users', 1, 1, 1, 'Administrator Transactions');
INSERT INTO `menu_sub` VALUES (11, 'Inventory Master List', NULL, 1, NULL, 'reports/inventory_report', 1, 5, 0, NULL);
INSERT INTO `menu_sub` VALUES (24, 'Designation', NULL, 2, NULL, 'maintenance/table/designation', 1, 15, 0, NULL);
INSERT INTO `menu_sub` VALUES (25, 'Vendor Master List', NULL, 1, NULL, 'vendor/master_list', 1, 10, 0, NULL);
INSERT INTO `menu_sub` VALUES (30, 'Cutoff', NULL, 1, NULL, 'posting/cutoff', 1, 8, 0, NULL);
INSERT INTO `menu_sub` VALUES (45, 'Backup Databse', NULL, 6, NULL, 'bib/backup_database', 1, 1, 0, NULL);
INSERT INTO `menu_sub` VALUES (50, 'Inventory Masterlist', NULL, 1, NULL, 'inventory/masterlist', 1, 11, 0, 'Inventory');
INSERT INTO `menu_sub` VALUES (52, 'UOM Conversion', NULL, 5, NULL, 'inventory/uom', 0, 11, 0, NULL);
INSERT INTO `menu_sub` VALUES (57, 'Inventory Adjustments', NULL, 6, NULL, 'inventory/adjustments', 0, 11, 0, NULL);
INSERT INTO `menu_sub` VALUES (58, 'Inventory Movements', NULL, 3, NULL, 'reports/inventory_movement', 0, 5, 0, NULL);
INSERT INTO `menu_sub` VALUES (68, 'Upload', NULL, 7, NULL, 'inventory/upload', 0, 11, 0, NULL);
INSERT INTO `menu_sub` VALUES (69, 'Projects', NULL, 3, NULL, 'admin/projects', 1, 13, 0, NULL);
INSERT INTO `menu_sub` VALUES (76, 'Masterlist (Breakdown)', NULL, 2, NULL, 'inventory/inventory_masterlist_breakdown', 0, 11, 0, NULL);
INSERT INTO `menu_sub` VALUES (82, 'Purchase Order', NULL, 2, NULL, 'reports/po_report', 1, 5, 0, NULL);
INSERT INTO `menu_sub` VALUES (83, 'Employee', NULL, 4, NULL, 'employee/master_list', 0, 1, 0, NULL);
INSERT INTO `menu_sub` VALUES (86, 'Accounts Payable', NULL, 1, NULL, 'accounts/accounts_payable', 1, 13, 0, NULL);
INSERT INTO `menu_sub` VALUES (89, 'Customer Masterlist', NULL, 1, NULL, 'crm/clients', 1, 17, 0, 'Clients Information');
INSERT INTO `menu_sub` VALUES (92, 'Inventory Monitoring', NULL, 2, NULL, 'inventory/inventory_monitoring', 0, 11, 0, NULL);
INSERT INTO `menu_sub` VALUES (94, 'Inventory - Project', NULL, 3, NULL, 'inventory/inventory_project', 0, 11, 0, NULL);
INSERT INTO `menu_sub` VALUES (95, 'Overhead Cost', NULL, 10, NULL, 'accounts/overhead_cost', 1, 13, 0, NULL);
INSERT INTO `menu_sub` VALUES (98, 'Inventory Cost', NULL, 4, NULL, 'inventory/inventory_cost', 0, 11, 0, NULL);
INSERT INTO `menu_sub` VALUES (105, 'Unconfirmed P.O.', NULL, 3, NULL, 'purchasing/po_list', 1, 3, 0, NULL);
INSERT INTO `menu_sub` VALUES (106, 'Create P.O.', NULL, 2, NULL, 'purchasing/create_po', 1, 3, 0, 'Purchase Order Transactions');
INSERT INTO `menu_sub` VALUES (107, 'Confirmed P.O.', NULL, 5, NULL, 'purchasing/confirmed_po', 1, 3, 0, NULL);
INSERT INTO `menu_sub` VALUES (108, 'Create GRV', NULL, 4, NULL, 'receiving/create_receiving', 1, 16, 0, 'Receiving Transactions');
INSERT INTO `menu_sub` VALUES (109, 'Unconfirmed GRV', NULL, 5, NULL, 'receiving/receiving_records', 1, 16, 0, NULL);
INSERT INTO `menu_sub` VALUES (110, 'Create Sales Order', NULL, 3, NULL, 'outgoing/create_issuance', 1, 18, 1, 'Issueance Transactions');
INSERT INTO `menu_sub` VALUES (111, 'Unconfirmed Sales Order', NULL, 4, NULL, 'outgoing/issuance_records', 1, 18, 0, NULL);
INSERT INTO `menu_sub` VALUES (114, 'Currency Rates', NULL, 11, NULL, 'maintenance/table/currency_rate', 1, 16, 1, 'System Tables');
INSERT INTO `menu_sub` VALUES (115, 'Foreign Charges Types', NULL, 12, NULL, 'maintenance/table/foreign_charges', 1, 16, 0, NULL);
INSERT INTO `menu_sub` VALUES (116, 'Local Charges Types', NULL, 13, NULL, 'maintenance/table/local_charges', 1, 16, 0, NULL);
INSERT INTO `menu_sub` VALUES (117, 'Confirmed GRV', NULL, 6, NULL, 'receiving/confirmed_receiving_records', 1, 16, 0, NULL);
INSERT INTO `menu_sub` VALUES (118, 'Confirmed Sales Order', NULL, 5, NULL, 'outgoing/confirm_issuance_records', 1, 18, 0, NULL);
INSERT INTO `menu_sub` VALUES (119, 'Vehicle Masterlist', NULL, 1, NULL, 'vehicles/masterlist', 1, 19, 0, NULL);
INSERT INTO `menu_sub` VALUES (122, 'Terms and Condition Temaplates', NULL, 7, NULL, 'purchasing/terms_and_conditions', 0, 3, 1, 'System Tables');
INSERT INTO `menu_sub` VALUES (123, 'Suppliers', NULL, 6, NULL, 'purchasing/supplier_po', 1, 3, 1, 'Supplier Masterfile');
INSERT INTO `menu_sub` VALUES (124, 'Model', NULL, 3, NULL, 'maintenance/table/models', 1, 19, 0, NULL);
INSERT INTO `menu_sub` VALUES (126, 'Manufacturer', NULL, 2, NULL, 'maintenance/table/manufacturers', 1, 19, 0, NULL);
INSERT INTO `menu_sub` VALUES (127, 'Create Stock Adjustments', NULL, 2, NULL, 'inventory/create_stock_adjustments', 1, 21, 0, 'Adjustment Transactions');
INSERT INTO `menu_sub` VALUES (128, 'Stock Adjustments Records', NULL, 3, NULL, 'inventory/stock_adjustments', 1, 21, 0, NULL);
INSERT INTO `menu_sub` VALUES (129, 'Confirmed Stock Adjustments', NULL, 4, NULL, 'inventory/confirmed_stock_adjustments', 1, 21, 0, NULL);
INSERT INTO `menu_sub` VALUES (130, 'Adjustments Types', NULL, 5, NULL, 'maintenance/table/adjustments_types', 1, 21, 1, 'System Tables');
INSERT INTO `menu_sub` VALUES (131, 'Create Inventory Return', NULL, 6, NULL, 'inventory/create_returns', 1, 11, 1, 'Return Inventory Transactions');
INSERT INTO `menu_sub` VALUES (132, 'Unconfirm Inventory Returns', NULL, 7, '', 'inventory/return_inventory', 1, 11, 0, NULL);
INSERT INTO `menu_sub` VALUES (133, 'Confirmed Inventory Return', NULL, 8, NULL, 'inventory/confirmed_return_inventory', 1, 11, 0, NULL);
INSERT INTO `menu_sub` VALUES (134, 'Create CRV', NULL, 1, NULL, 'receipt/create_crv', 1, 20, 1, 'Cash Receipt Voucher Transactions');
INSERT INTO `menu_sub` VALUES (135, 'CRV Records', NULL, 2, NULL, 'receipt/crv_records', 1, 20, 0, NULL);
INSERT INTO `menu_sub` VALUES (136, 'Debit/Credit Type', NULL, 4, NULL, 'maintenance/table/debit_credit_type', 1, 20, 1, 'System Tables');
INSERT INTO `menu_sub` VALUES (137, 'Account Receivable G/L Number', NULL, 5, NULL, 'maintenance/table/account_receivable', 0, 20, 0, NULL);
INSERT INTO `menu_sub` VALUES (138, 'Cash Control Account', NULL, 6, NULL, 'maintenance/table/cash_control_account', 0, 20, 0, NULL);
INSERT INTO `menu_sub` VALUES (141, 'GRV Transport', NULL, 20, NULL, 'maintenance/table/grv_transport', 1, 16, 0, NULL);
INSERT INTO `menu_sub` VALUES (142, 'Reports', NULL, 3, NULL, 'receipt/reports', 1, 20, 0, NULL);
INSERT INTO `menu_sub` VALUES (143, 'Item Category', NULL, 9, NULL, 'maintenance/table/item_category', 1, 11, 1, NULL);
INSERT INTO `menu_sub` VALUES (144, 'Item Type', NULL, 10, NULL, 'maintenance/table/item_type', 1, 11, 0, NULL);
INSERT INTO `menu_sub` VALUES (145, 'Item Brand', NULL, 11, NULL, 'maintenance/table/item_brand', 1, 11, 0, NULL);
INSERT INTO `menu_sub` VALUES (146, 'Payment Type', NULL, 6, NULL, 'maintenance/table/payment_type', 1, 18, 1, NULL);
INSERT INTO `menu_sub` VALUES (147, 'Create Quotation', NULL, 1, NULL, 'outgoing/create_quotation', 1, 18, 0, NULL);
INSERT INTO `menu_sub` VALUES (148, 'Quotation List', NULL, 2, NULL, 'outgoing/quotation_list', 1, 18, 0, NULL);
INSERT INTO `menu_sub` VALUES (149, 'Goods Receipt Voucher', NULL, 3, NULL, 'reports/grv_reports', 1, 5, 0, NULL);
INSERT INTO `menu_sub` VALUES (150, 'Sales Order', NULL, 4, NULL, 'reports/so_reports', 1, 5, 0, NULL);
INSERT INTO `menu_sub` VALUES (151, 'Adjustment', NULL, 5, NULL, 'reports/adjustments_reports', 1, 5, 0, NULL);
INSERT INTO `menu_sub` VALUES (152, 'Inventory Returns', NULL, 6, NULL, 'reports/returns_reports', 1, 5, 0, NULL);
INSERT INTO `menu_sub` VALUES (153, 'Lost Sales', NULL, 7, NULL, 'reports/lost_reports', 1, 5, 0, NULL);

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
  `vehicle_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of purchase_order
-- ----------------------------
INSERT INTO `purchase_order` VALUES (1, '2025-06-17 15:55', 2, 0, '', NULL, '', NULL, '000001', NULL, NULL, 4, 'TEST@MAIL.COM', NULL, 'TEST PO 1', NULL, '', 550.000000, 'TEST', 1, '2025-06-17 15:55', 2, 1, NULL, '1.000000', 12);
INSERT INTO `purchase_order` VALUES (2, '2025-06-17 15:56', 2, 0, '', NULL, '', NULL, '000002', NULL, NULL, 4, 'YRA@SJHSAN', NULL, 'TEST POI 2', NULL, '', 0.000000, 'YMRAS', 1, '2025-06-17 15:56', 2, 1, NULL, '1.000000', 14);
INSERT INTO `purchase_order` VALUES (3, '2025-06-17 15:57', 2, 0, '', NULL, '', NULL, '000003', NULL, NULL, 0, 'FSSDF@DFG.GG', NULL, 'FGDF DFG DFG DFG', NULL, '', 60.000000, 'WWWEWE', 0, NULL, NULL, 1, NULL, '1.000000', 13);
INSERT INTO `purchase_order` VALUES (4, '2025-06-17 16:20', 2, 0, '', NULL, '', NULL, '000004', NULL, NULL, 1, 'EWR@SFSD', NULL, 'SDFSDFSDFSDF', NULL, '', 0.000000, 'DEEWR', 1, '2025-06-17 16:21', 2, 1, NULL, '1.000000', 7);
INSERT INTO `purchase_order` VALUES (5, '2025-06-17 16:22', 2, 0, '', NULL, '', NULL, '000005', NULL, NULL, 2, 'ERW@SDFS', NULL, 'TEST213', NULL, '', 450.000000, 'TESR', 1, '2025-06-17 16:22', 2, 2, NULL, '4.521300', 13);
INSERT INTO `purchase_order` VALUES (6, '2025-06-17 16:54', 2, 0, '', NULL, '', NULL, '000006', NULL, NULL, 2, 'FRREW@SDF', NULL, 'DSFS DFSDFSF ', NULL, '', 0.000000, 'EWRW WERWER', 0, NULL, NULL, 1, NULL, '1.000000', 8);
INSERT INTO `purchase_order` VALUES (7, '2025-06-17 17:01', 2, 0, '', NULL, '', NULL, '000007', NULL, NULL, 1, 'DFGDF@SDFSD', NULL, 'SDFSDF SDFS DFSDFS ', NULL, '', 440.000000, 'FGDF GDFGDFG', 1, '2025-06-17 17:01', 2, 1, NULL, '1.000000', 11);

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
  `price` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `inventory_quotation_id` int NULL DEFAULT NULL,
  `quotation_id` int NULL DEFAULT NULL,
  `inventory_id` int NULL DEFAULT NULL,
  `rate_id` int NULL DEFAULT 0,
  `vehicle_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 38 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of purchase_order_items
-- ----------------------------
INSERT INTO `purchase_order_items` VALUES (1, '2025-06-17 15:55', 2, 0, '', NULL, '', NULL, 1, 'ITM0002', 'Item Name 2', '53', '735', 0, NULL, 2, 1, 12);
INSERT INTO `purchase_order_items` VALUES (2, '2025-06-17 15:55', 2, 0, '', NULL, '', NULL, 1, 'ITM0024', 'Item Name 24', '21', '614', 0, NULL, 24, 1, 12);
INSERT INTO `purchase_order_items` VALUES (3, '2025-06-17 15:55', 2, 0, '', NULL, '', NULL, 1, 'ITM0023', 'Item Name 23', '21', '443', 0, NULL, 23, 1, 12);
INSERT INTO `purchase_order_items` VALUES (4, '2025-06-17 15:55', 2, 0, '', NULL, '', NULL, 1, 'ITM0014', 'Item Name 14', '41', '449', 0, NULL, 14, 1, 12);
INSERT INTO `purchase_order_items` VALUES (5, '2025-06-17 15:56', 2, 0, '', NULL, '', NULL, 2, 'ITM0002', 'Item Name 2', '31', '735', 0, NULL, 2, 1, 14);
INSERT INTO `purchase_order_items` VALUES (6, '2025-06-17 15:56', 2, 0, '', NULL, '', NULL, 2, 'ITM0022', 'Item Name 22', '21', '970', 0, NULL, 22, 1, 14);
INSERT INTO `purchase_order_items` VALUES (7, '2025-06-17 15:56', 2, 0, '', NULL, '', NULL, 2, 'ITM0012', 'Item Name 12', '31', '153', 0, NULL, 12, 1, 14);
INSERT INTO `purchase_order_items` VALUES (8, '2025-06-17 15:56', 2, 0, '', NULL, '', NULL, 2, 'ITM0006', 'Item Name 6', '31', '216', 0, NULL, 6, 1, 14);
INSERT INTO `purchase_order_items` VALUES (9, '2025-06-17 15:56', 2, 0, '', NULL, '', NULL, 2, 'ITM0005', 'Item Name 5', '31', '837', 0, NULL, 5, 1, 14);
INSERT INTO `purchase_order_items` VALUES (10, '2025-06-17 15:56', 2, 0, '', NULL, '', NULL, 2, 'ITM0010', 'Item Name 10', '31', '699', 0, NULL, 10, 1, 14);
INSERT INTO `purchase_order_items` VALUES (11, '2025-06-17 15:56', 2, 0, '', NULL, '', NULL, 2, 'ITM0001', 'Item Name 1', '31', '490', 0, NULL, 1, 1, 14);
INSERT INTO `purchase_order_items` VALUES (12, '2025-06-17 15:57', 2, 0, '', NULL, '', NULL, 3, 'ITM0001', 'Item Name 1', '1', '490', 0, NULL, 1, 1, 13);
INSERT INTO `purchase_order_items` VALUES (13, '2025-06-17 15:57', 2, 0, '', NULL, '', NULL, 3, 'ITM0002', 'Item Name 2', '1', '735', 0, NULL, 2, 1, 13);
INSERT INTO `purchase_order_items` VALUES (14, '2025-06-17 15:57', 2, 0, '', NULL, '', NULL, 3, 'ITM0003', 'Item Name 3', '1', '916', 0, NULL, 3, 1, 13);
INSERT INTO `purchase_order_items` VALUES (15, '2025-06-17 15:57', 2, 0, '', NULL, '', NULL, 3, 'ITM0004', 'Item Name 4', '1', '231', 0, NULL, 4, 1, 13);
INSERT INTO `purchase_order_items` VALUES (16, '2025-06-17 15:57', 2, 0, '', NULL, '', NULL, 3, 'ITM0011', 'Item Name 11', '1', '665', 0, NULL, 11, 1, 13);
INSERT INTO `purchase_order_items` VALUES (17, '2025-06-17 15:57', 2, 0, '', NULL, '', NULL, 3, 'ITM0012', 'Item Name 12', '1', '153', 0, NULL, 12, 1, 13);
INSERT INTO `purchase_order_items` VALUES (18, '2025-06-17 16:20', 2, 0, '', NULL, '', NULL, 4, 'ITM0001', 'Item Name 1', '31', '355', 0, NULL, 1, 1, 7);
INSERT INTO `purchase_order_items` VALUES (19, '2025-06-17 16:20', 2, 0, '', NULL, '', NULL, 4, 'ITM0002', 'Item Name 2', '41', '440', 0, NULL, 2, 1, 7);
INSERT INTO `purchase_order_items` VALUES (20, '2025-06-17 16:20', 2, 0, '', NULL, '', NULL, 4, 'ITM0003', 'Item Name 3', '51', '430', 0, NULL, 3, 1, 7);
INSERT INTO `purchase_order_items` VALUES (21, '2025-06-17 16:20', 2, 0, '', NULL, '', NULL, 4, 'ITM0006', 'Item Name 6', '61', '340', 0, NULL, 6, 1, 7);
INSERT INTO `purchase_order_items` VALUES (22, '2025-06-17 16:20', 2, 0, '', NULL, '', NULL, 4, 'ITM0024', 'Item Name 24', '41', '230', 0, NULL, 24, 1, 7);
INSERT INTO `purchase_order_items` VALUES (23, '2025-06-17 16:20', 2, 0, '', NULL, '', NULL, 4, 'ITM0023', 'Item Name 23', '31', '420', 0, NULL, 23, 1, 7);
INSERT INTO `purchase_order_items` VALUES (24, '2025-06-17 16:22', 2, 0, '', NULL, '', NULL, 5, 'ITM0001', 'Item Name 1', '41', '660', 0, NULL, 1, 2, 13);
INSERT INTO `purchase_order_items` VALUES (25, '2025-06-17 16:22', 2, 0, '', NULL, '', NULL, 5, 'ITM0007', 'Item Name 7', '51', '550', 0, NULL, 7, 2, 13);
INSERT INTO `purchase_order_items` VALUES (26, '2025-06-17 16:22', 2, 0, '', NULL, '', NULL, 5, 'ITM0005', 'Item Name 5', '61', '460', 0, NULL, 5, 2, 13);
INSERT INTO `purchase_order_items` VALUES (27, '2025-06-17 16:22', 2, 0, '', NULL, '', NULL, 5, 'ITM0025', 'Item Name 25', '71', '330', 0, NULL, 25, 2, 13);
INSERT INTO `purchase_order_items` VALUES (28, '2025-06-17 16:22', 2, 0, '', NULL, '', NULL, 5, 'ITM0030', 'Item Name 30', '51', '440', 0, NULL, 30, 2, 13);
INSERT INTO `purchase_order_items` VALUES (29, '2025-06-17 16:54', 2, 0, '', NULL, '', NULL, 6, 'ITM0001', 'Item Name 1', '26', '630', 0, NULL, 1, 1, 8);
INSERT INTO `purchase_order_items` VALUES (30, '2025-06-17 16:54', 2, 0, '', NULL, '', NULL, 6, 'ITM0003', 'Item Name 3', '45', '340', 0, NULL, 3, 1, 8);
INSERT INTO `purchase_order_items` VALUES (31, '2025-06-17 16:54', 2, 0, '', NULL, '', NULL, 6, 'ITM0004', 'Item Name 4', '43', '530', 0, NULL, 4, 1, 8);
INSERT INTO `purchase_order_items` VALUES (32, '2025-06-17 16:54', 2, 0, '', NULL, '', NULL, 6, 'ITM0002', 'Item Name 2', '34', '735', 0, NULL, 2, 1, 8);
INSERT INTO `purchase_order_items` VALUES (33, '2025-06-17 16:54', 2, 0, '', NULL, '', NULL, 6, 'ITM0005', 'Item Name 5', '67', '460', 0, NULL, 5, 1, 8);
INSERT INTO `purchase_order_items` VALUES (34, '2025-06-17 17:01', 2, 0, '', NULL, '', NULL, 7, 'ITM0001', 'Item Name 1', '51', '352', 0, NULL, 1, 1, 11);
INSERT INTO `purchase_order_items` VALUES (35, '2025-06-17 17:01', 2, 0, '', NULL, '', NULL, 7, 'ITM0002', 'Item Name 2', '61', '440', 0, NULL, 2, 1, 11);
INSERT INTO `purchase_order_items` VALUES (36, '2025-06-17 17:01', 2, 0, '', NULL, '', NULL, 7, 'ITM0003', 'Item Name 3', '81', '430', 0, NULL, 3, 1, 11);
INSERT INTO `purchase_order_items` VALUES (37, '2025-06-17 17:01', 2, 0, '', NULL, '', NULL, 7, 'ITM0004', 'Item Name 4', '71', '0', 0, NULL, 4, 1, 11);

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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of receiving
-- ----------------------------
INSERT INTO `receiving` VALUES (1, '2025-06-18 18:42', 2, 0, '', NULL, '', NULL, '[\"4\"]', '345EDGDF', 'DFDFGDFGDFG', 'SDF SDF SDF SD', NULL, NULL, NULL, '2025-06-19', '2025-06-18', '1.059948', '1.000000', 1, '2025-06-18 18:47', 2, 'QAR', 1, 1);
INSERT INTO `receiving` VALUES (2, '2025-06-18 18:47', 2, 0, '', NULL, '', NULL, '[\"1\"]', 'EWR', 'FSDF', 'TEST 123', NULL, NULL, NULL, '2025-06-19', '2025-06-26', '1.057252', '1.000000', 1, '2025-06-18 18:47', 2, 'QAR', 4, 1);

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
  `vehicle_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of receiving_items
-- ----------------------------
INSERT INTO `receiving_items` VALUES (1, '2025-06-18 18:42', 2, 0, '', NULL, '', NULL, 4, NULL, NULL, 1, 18, 31, '', NULL, 1, '355', 0, '376.28154', 0, 7);
INSERT INTO `receiving_items` VALUES (2, '2025-06-18 18:42', 2, 0, '', NULL, '', NULL, 4, NULL, NULL, 1, 19, 41, '', NULL, 2, '440', 0, '466.37712', 0, 7);
INSERT INTO `receiving_items` VALUES (3, '2025-06-18 18:42', 2, 0, '', NULL, '', NULL, 4, NULL, NULL, 1, 20, 51, '', NULL, 3, '430', 0, '455.77764', 0, 7);
INSERT INTO `receiving_items` VALUES (4, '2025-06-18 18:42', 2, 0, '', NULL, '', NULL, 4, NULL, NULL, 1, 21, 61, '', NULL, 6, '340', 0, '360.38232', 0, 7);
INSERT INTO `receiving_items` VALUES (5, '2025-06-18 18:42', 2, 0, '', NULL, '', NULL, 4, NULL, NULL, 1, 22, 41, '', NULL, 24, '230', 0, '243.78804', 0, 7);
INSERT INTO `receiving_items` VALUES (6, '2025-06-18 18:42', 2, 0, '', NULL, '', NULL, 4, NULL, NULL, 1, 23, 31, '', NULL, 23, '420', 0, '445.17816', 0, 7);
INSERT INTO `receiving_items` VALUES (7, '2025-06-18 18:47', 2, 0, '', NULL, '', NULL, 1, NULL, NULL, 2, 1, 53, '', NULL, 2, '735', 0, '777.08022', 0, 12);
INSERT INTO `receiving_items` VALUES (8, '2025-06-18 18:47', 2, 0, '', NULL, '', NULL, 1, NULL, NULL, 2, 2, 21, '', NULL, 24, '614', 0, '649.152728', 0, 12);
INSERT INTO `receiving_items` VALUES (9, '2025-06-18 18:47', 2, 0, '', NULL, '', NULL, 1, NULL, NULL, 2, 3, 21, '', NULL, 23, '443', 0, '468.362636', 0, 12);
INSERT INTO `receiving_items` VALUES (10, '2025-06-18 18:47', 2, 0, '', NULL, '', NULL, 1, NULL, NULL, 2, 4, 41, '', NULL, 14, '449', 0, '474.706148', 0, 12);

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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of receiving_lc
-- ----------------------------
INSERT INTO `receiving_lc` VALUES (1, '2025-06-18 18:42', 2, 0, '', NULL, '', NULL, 3, '5645', '', 1);
INSERT INTO `receiving_lc` VALUES (2, '2025-06-18 18:47', 2, 0, '', NULL, '', NULL, 7, '4555', '', 2);

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
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of suppliers_po
-- ----------------------------
INSERT INTO `suppliers_po` VALUES (1, '2023-12-05 20:50:51', 2, 0, '', NULL, '2025-06-06 15:25:07', 2, 'AUTO TECH W.L.L', 'MAITHA MITSUKA', 'JOHN BARRY', '343 3422', '941 2132', 'SAN DON DOAHA', NULL, NULL, NULL, 'apple@gmail.com', 'Mohammad Saleh', '344 3455');
INSERT INTO `suppliers_po` VALUES (2, '2023-12-05 20:52:01', 2, 0, '', NULL, '2025-06-06 15:25:27', 2, 'DOHA AUTO SPORTS W.L.L', 'MIKE KORRS', 'JOE ROGAAN', '344 7576', '435 4676', 'MARINA BAY', NULL, NULL, NULL, 'laccoustics@mail.com', 'Mohhamad Fali', '343 4577');
INSERT INTO `suppliers_po` VALUES (3, '2025-06-07 05:10:24', 2, 1, '2025-06-07 05:10:29', 2, '', NULL, 'SDFSD', 'FSDF', 'SDF', 'SDFSD', 'FSDF', 'SDFSDF', NULL, NULL, NULL, 'SDF@DSFG', 'SDFSDF', 'SDFSDF');
INSERT INTO `suppliers_po` VALUES (4, '2025-06-12 15:48:04', 2, 0, '', NULL, '', NULL, 'PORSCHE AG', '', '', '', '', '', NULL, NULL, NULL, '', '', '');

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
) ENGINE = InnoDB AUTO_INCREMENT = 2588 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

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
INSERT INTO `user_roles` VALUES (2281, 37, 50, 11);
INSERT INTO `user_roles` VALUES (2282, 37, 89, 17);
INSERT INTO `user_roles` VALUES (2283, 37, 119, 19);
INSERT INTO `user_roles` VALUES (2284, 37, 131, 11);
INSERT INTO `user_roles` VALUES (2285, 37, 132, 11);
INSERT INTO `user_roles` VALUES (2286, 37, 133, 11);
INSERT INTO `user_roles` VALUES (2287, 37, 134, 20);
INSERT INTO `user_roles` VALUES (2288, 37, 135, 20);
INSERT INTO `user_roles` VALUES (2289, 37, 136, 20);
INSERT INTO `user_roles` VALUES (2290, 37, 142, 20);
INSERT INTO `user_roles` VALUES (2291, 37, 143, 11);
INSERT INTO `user_roles` VALUES (2292, 37, 144, 11);
INSERT INTO `user_roles` VALUES (2547, 2, 8, 1);
INSERT INTO `user_roles` VALUES (2548, 2, 11, 5);
INSERT INTO `user_roles` VALUES (2549, 2, 45, 1);
INSERT INTO `user_roles` VALUES (2550, 2, 50, 11);
INSERT INTO `user_roles` VALUES (2551, 2, 82, 5);
INSERT INTO `user_roles` VALUES (2552, 2, 89, 17);
INSERT INTO `user_roles` VALUES (2553, 2, 105, 3);
INSERT INTO `user_roles` VALUES (2554, 2, 106, 3);
INSERT INTO `user_roles` VALUES (2555, 2, 107, 3);
INSERT INTO `user_roles` VALUES (2556, 2, 108, 16);
INSERT INTO `user_roles` VALUES (2557, 2, 109, 16);
INSERT INTO `user_roles` VALUES (2558, 2, 110, 18);
INSERT INTO `user_roles` VALUES (2559, 2, 111, 18);
INSERT INTO `user_roles` VALUES (2560, 2, 114, 16);
INSERT INTO `user_roles` VALUES (2561, 2, 115, 16);
INSERT INTO `user_roles` VALUES (2562, 2, 116, 16);
INSERT INTO `user_roles` VALUES (2563, 2, 117, 16);
INSERT INTO `user_roles` VALUES (2564, 2, 118, 18);
INSERT INTO `user_roles` VALUES (2565, 2, 119, 19);
INSERT INTO `user_roles` VALUES (2566, 2, 123, 3);
INSERT INTO `user_roles` VALUES (2567, 2, 124, 19);
INSERT INTO `user_roles` VALUES (2568, 2, 126, 19);
INSERT INTO `user_roles` VALUES (2569, 2, 127, 21);
INSERT INTO `user_roles` VALUES (2570, 2, 128, 21);
INSERT INTO `user_roles` VALUES (2571, 2, 129, 21);
INSERT INTO `user_roles` VALUES (2572, 2, 130, 21);
INSERT INTO `user_roles` VALUES (2573, 2, 131, 11);
INSERT INTO `user_roles` VALUES (2574, 2, 132, 11);
INSERT INTO `user_roles` VALUES (2575, 2, 133, 11);
INSERT INTO `user_roles` VALUES (2576, 2, 141, 16);
INSERT INTO `user_roles` VALUES (2577, 2, 143, 11);
INSERT INTO `user_roles` VALUES (2578, 2, 144, 11);
INSERT INTO `user_roles` VALUES (2579, 2, 145, 11);
INSERT INTO `user_roles` VALUES (2580, 2, 146, 18);
INSERT INTO `user_roles` VALUES (2581, 2, 147, 18);
INSERT INTO `user_roles` VALUES (2582, 2, 148, 18);
INSERT INTO `user_roles` VALUES (2583, 2, 149, 5);
INSERT INTO `user_roles` VALUES (2584, 2, 150, 5);
INSERT INTO `user_roles` VALUES (2585, 2, 151, 5);
INSERT INTO `user_roles` VALUES (2586, 2, 152, 5);
INSERT INTO `user_roles` VALUES (2587, 2, 153, 5);

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
  `plate_no` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `vin` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `picture_1` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `picture_2` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `picture_3` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `last_transactions` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 45 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of vehicles
-- ----------------------------
INSERT INTO `vehicles` VALUES (3, '2025-06-01 21:05:02', 2, 0, '', NULL, '2025-06-01 22:12:54', 2, 2, 6, 2, '554190', 'AD00430589223XAAA', 'LnyOpB8w7YmTEdPUQNf9.jpg', 'ohxGp2N013kHCeTIVafy.jpg', 'aZAn6PvI7VBdMm9NDl4S.jpg', NULL);
INSERT INTO `vehicles` VALUES (4, '2025-06-01 21:09:19', 2, 1, '2025-06-01 21:54:33', 2, '', NULL, 5, 4, 1, '88211', 'YOSD04358234922', NULL, NULL, NULL, NULL);
INSERT INTO `vehicles` VALUES (5, '2025-06-01 21:27:33', 2, 1, '2025-06-01 21:55:30', 2, '', NULL, 5, 3, 3, '9921', 'PIS23023928081', NULL, NULL, NULL, NULL);
INSERT INTO `vehicles` VALUES (6, '2025-06-01 21:29:33', 2, 1, '2025-06-05 15:01:49', 2, '', NULL, 4, 3, 3, '7214', 'JS0980578234', '9JO3DcbnU2AfIqeGwrpv.jpg', NULL, NULL, NULL);
INSERT INTO `vehicles` VALUES (7, '2025-06-01 21:56:58', 2, 0, '', NULL, '2025-06-05 20:40:01', 2, 9, 6, 2, '458844', 'C092793409007170927X2', 'Kocmlh2kXMYSRpqQ56E3.jpg', NULL, NULL, NULL);
INSERT INTO `vehicles` VALUES (8, '2025-06-09 03:48:19', 2, 0, '', NULL, '', NULL, 18, 3, 3, '8875', 'JSDF2342348900', 'W5htfMcmLj6iQ3gnC0oG.jpg', NULL, NULL, NULL);
INSERT INTO `vehicles` VALUES (9, '2025-06-09 03:48:44', 2, 0, '', NULL, '', NULL, 18, 3, 3, '8990', 'HIOO875635453453', '4GjAq8KdTgy73p6JbMOh.jpg', NULL, NULL, NULL);
INSERT INTO `vehicles` VALUES (10, '2025-06-11 14:38:54', 2, 0, '', NULL, '', NULL, 90, 4, 1, '3455', 'SASDFSD234234234', NULL, NULL, NULL, NULL);
INSERT INTO `vehicles` VALUES (11, '2025-06-11 14:39:16', 2, 0, '', NULL, '', NULL, 91, 4, 1, '3455', 'SASDFSD234234234', NULL, NULL, NULL, NULL);
INSERT INTO `vehicles` VALUES (12, '2025-06-11 14:40:05', 2, 0, '', NULL, '', NULL, 2, 0, 6, '808080', '99099990999', NULL, NULL, NULL, NULL);
INSERT INTO `vehicles` VALUES (13, '2025-06-11 14:47:49', 2, 0, '', NULL, '', NULL, 92, 0, 7, '707070707', '7777', NULL, NULL, NULL, NULL);
INSERT INTO `vehicles` VALUES (14, '2025-06-11 14:48:45', 2, 0, '', NULL, '', NULL, 92, 5, 1, '60606060', '6666', NULL, NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;

/*
 Navicat Premium Data Transfer

 Source Server         : LocalKo
 Source Server Type    : MySQL
 Source Server Version : 100432 (10.4.32-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : inventory_project

 Target Server Type    : MySQL
 Target Server Version : 100432 (10.4.32-MariaDB)
 File Encoding         : 65001

 Date: 18/06/2025 01:44:38
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
) ENGINE = InnoDB AUTO_INCREMENT = 39 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of account
-- ----------------------------
INSERT INTO `account` VALUES (2, '1', '', '2017-05-01', 'admin', '$2a$08$HMSs9g77UdvwR7QJDA8dwuzqOj5qb1UZeKNc0s9aR4QuH7TT8tExi', 1, 1, 'Super Admin', '656d695223630_face2.jpg', 0, 'Mon Butiong', 0, NULL, NULL, 3, 'fb46b5953702f22b9158f1911618ef04afff3ef3a72ed60c14d8318945935409', '2025-06-17 18:25:56');
INSERT INTO `account` VALUES (38, '', NULL, '2025-06-18', 'SHAHAD', '$2a$08$NC7nt917.eqURuIvwTT7qOma2SXyfiQ7naY9TvZE1JRXujcttaztS', 1, NULL, 'ADMINISTRATOR', NULL, 0, 'SHAHAD', 0, NULL, NULL, NULL, '21d92df77b50c90eaeab209612f99845f2ca089a429554c3fccfbd38117f0195', '2025-06-17 18:48:24');

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
) ENGINE = InnoDB AUTO_INCREMENT = 152 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

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
INSERT INTO `audit_trail` VALUES (147, 2, 'login page', 'login to account.', '2025-06-17 18:25:55', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (148, 2, 'home > system user', 'add new system user , user id : 38', '2025-06-17 18:46:59', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (149, 2, 'home > system user > update user roles', 'update system user restriction, user id : 38', '2025-06-17 18:47:34', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (150, 2, 'account page', 'logout to account.', '2025-06-17 18:47:40', NULL, NULL, NULL);
INSERT INTO `audit_trail` VALUES (151, 38, 'login page', 'login to account.', '2025-06-17 18:48:23', NULL, NULL, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of clients
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of error_logging
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_account_receivable
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_adjustments_types
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_cash_control_account
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_classification
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_client_category
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_client_document_type
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_client_progress_status
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_currency_rate
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_item_brand
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_item_category
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_item_type
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_local_charges
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fm_manpower
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC STATS_AUTO_RECALC = 1;

-- ----------------------------
-- Records of inventory
-- ----------------------------

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
  `puchase_date` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `confirmed_date` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `customer_id` int NULL DEFAULT NULL,
  `vehicle_id` int NULL DEFAULT NULL,
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
  `vehicle_id` int NULL DEFAULT NULL,
  `customer_id` int NULL DEFAULT NULL,
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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of issuance_items
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of issuance_quotation
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of issuance_quotation_items
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
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of menu_main
-- ----------------------------
INSERT INTO `menu_main` VALUES (1, 'Admin', NULL, 13, 'fa-star', 'admin/home', 1);
INSERT INTO `menu_main` VALUES (2, 'System Parameters', NULL, 11, 'fa-table', 'admin/file_maintenance', 0);
INSERT INTO `menu_main` VALUES (3, 'Purchasing-(P.O.)', NULL, 4, 'fa-file', 'admin/employee', 1);
INSERT INTO `menu_main` VALUES (5, 'Reports', NULL, 9, 'fa-print', 'admin/fixed_asset_transfer', 1);
INSERT INTO `menu_main` VALUES (11, 'Parts Inventory', NULL, 8, 'fa-cubes', NULL, 1);
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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of purchase_order
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of purchase_order_items
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
  `vehicle_id` int NULL DEFAULT NULL,
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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of suppliers_po
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of terms_and_conditions
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 2622 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

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
INSERT INTO `user_roles` VALUES (2588, 38, 8, 1);
INSERT INTO `user_roles` VALUES (2589, 38, 11, 5);
INSERT INTO `user_roles` VALUES (2590, 38, 50, 11);
INSERT INTO `user_roles` VALUES (2591, 38, 89, 17);
INSERT INTO `user_roles` VALUES (2592, 38, 105, 3);
INSERT INTO `user_roles` VALUES (2593, 38, 106, 3);
INSERT INTO `user_roles` VALUES (2594, 38, 107, 3);
INSERT INTO `user_roles` VALUES (2595, 38, 108, 16);
INSERT INTO `user_roles` VALUES (2596, 38, 109, 16);
INSERT INTO `user_roles` VALUES (2597, 38, 110, 18);
INSERT INTO `user_roles` VALUES (2598, 38, 111, 18);
INSERT INTO `user_roles` VALUES (2599, 38, 114, 16);
INSERT INTO `user_roles` VALUES (2600, 38, 115, 16);
INSERT INTO `user_roles` VALUES (2601, 38, 116, 16);
INSERT INTO `user_roles` VALUES (2602, 38, 117, 16);
INSERT INTO `user_roles` VALUES (2603, 38, 118, 18);
INSERT INTO `user_roles` VALUES (2604, 38, 119, 19);
INSERT INTO `user_roles` VALUES (2605, 38, 123, 3);
INSERT INTO `user_roles` VALUES (2606, 38, 124, 19);
INSERT INTO `user_roles` VALUES (2607, 38, 126, 19);
INSERT INTO `user_roles` VALUES (2608, 38, 127, 21);
INSERT INTO `user_roles` VALUES (2609, 38, 128, 21);
INSERT INTO `user_roles` VALUES (2610, 38, 129, 21);
INSERT INTO `user_roles` VALUES (2611, 38, 130, 21);
INSERT INTO `user_roles` VALUES (2612, 38, 131, 11);
INSERT INTO `user_roles` VALUES (2613, 38, 132, 11);
INSERT INTO `user_roles` VALUES (2614, 38, 133, 11);
INSERT INTO `user_roles` VALUES (2615, 38, 141, 16);
INSERT INTO `user_roles` VALUES (2616, 38, 143, 11);
INSERT INTO `user_roles` VALUES (2617, 38, 144, 11);
INSERT INTO `user_roles` VALUES (2618, 38, 145, 11);
INSERT INTO `user_roles` VALUES (2619, 38, 146, 18);
INSERT INTO `user_roles` VALUES (2620, 38, 147, 18);
INSERT INTO `user_roles` VALUES (2621, 38, 148, 18);

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of vehicles
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;

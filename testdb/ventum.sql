-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2024 at 02:21 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ventum`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(99) NOT NULL,
  `ds` text DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `un` varchar(225) NOT NULL,
  `ps` varchar(225) NOT NULL,
  `act` int(11) DEFAULT NULL,
  `admin` int(11) DEFAULT NULL,
  `account_details` varchar(225) DEFAULT NULL,
  `avatar` varchar(225) DEFAULT NULL,
  `full_access` int(11) DEFAULT NULL,
  `name` varchar(125) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `emp_id`, `ds`, `dc`, `un`, `ps`, `act`, `admin`, `account_details`, `avatar`, `full_access`, `name`, `deleted`, `date_deleted`, `deleted_by`, `department_id`) VALUES
(2, '1', '', '2017-05-01', 'adminxadmin', '$2a$08$HMSs9g77UdvwR7QJDA8dwuzqOj5qb1UZeKNc0s9aR4QuH7TT8tExi', 0, 1, 'Super Admin', '656d695223630_face2.jpg', 0, 'Mon Butiong', 0, NULL, NULL, 3),
(29, '', NULL, '2024-05-12', 'superadmin', '$2a$08$LkbTL6pFSsg7/euDx/BPOuQFCB7n5ib0gnCQWyF9u2S.H9NCCH9k6', 1, NULL, 'Superadmin', NULL, 0, 'Superadmin', 0, NULL, NULL, NULL),
(35, '', NULL, '2024-05-15', 'tarek', '$2a$08$etQDpCKaOTsSW0jzHg08RudIGuopJ1VMW.2iv5rtJ.8CTBvsvfRhO', 1, NULL, 'Administrator', NULL, 0, 'Tarek Mrad ', 0, NULL, NULL, NULL),
(36, '', NULL, '2024-05-15', 'antoine', '$2a$08$rqxCwBwUtuW2Wlw/jy.hzeZRLbWplRIYiBvHRAkgFWldqSy8fK5cS', 1, NULL, 'Administrator', NULL, 0, 'Antoine Saab', 0, NULL, NULL, NULL),
(37, '', NULL, '2024-08-11', 'georges', '$2a$08$DyDSl2oD.n3U6Ts705d7VOnUTLneon4Xpbh./qdwzPxmHlz2SJb8W', 1, NULL, 'Administrator', NULL, 0, 'georges', 0, NULL, NULL, NULL),
(38, '', NULL, '2024-08-12', 'Joe.lawless', '$2a$08$ZWxJSQ5m63k0Nsnp1Ykelu/gY71V3rJ8SsCfCBefJ1FU7pDimZegm', 1, NULL, 'Security', NULL, 0, 'Joe Lawless', 0, NULL, NULL, NULL),
(39, '', NULL, '2024-08-12', 'amit.pal', '$2a$08$eVVooPQvYMpch6sYdnX0me82x5Q2Irvyh8zN0UH1.a5i/W7y2hbgu', 1, NULL, 'Estimation', NULL, 0, 'Amit Pal', 0, NULL, NULL, NULL),
(40, '', NULL, '2024-08-12', 'billy', '$2a$08$osCNz3ZhosWSi0nv3j71B.fyTkrZA9/KKbUOtwhB26TYaEH6QiuV2', 1, NULL, 'Administration', NULL, 0, 'Billy', 0, NULL, NULL, NULL),
(41, '', NULL, '2024-09-01', 'Edwin.alverde', '$2a$08$cUuc.0tG.5C8Unhy.an1ROWdnjDnjd5hXabE2aItaaM8tGPeMQbPK', 1, NULL, 'Edwin Alverde', NULL, 0, 'Edwin Alverde', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `accounts_payable`
--

CREATE TABLE `accounts_payable` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `inventory_id` int(11) DEFAULT NULL,
  `amount` float(11,2) DEFAULT NULL,
  `receiving_report_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `cheque_number` varchar(50) DEFAULT NULL,
  `cheque_date` varchar(25) DEFAULT NULL,
  `collection_date` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `audit_trail`
--

CREATE TABLE `audit_trail` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `module` varchar(225) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `dc` datetime DEFAULT NULL,
  `option` varchar(225) DEFAULT NULL,
  `log` text DEFAULT NULL,
  `date_created` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `audit_trail`
--

INSERT INTO `audit_trail` (`id`, `user_id`, `module`, `description`, `dc`, `option`, `log`, `date_created`) VALUES
(1, 2, 'home > system user', 'add new system user , user id : 35', '2024-05-15 16:16:17', NULL, NULL, NULL),
(2, 2, 'home > system user', 'add new system user , user id : 36', '2024-05-15 16:16:53', NULL, NULL, NULL),
(3, 2, 'home > system user > update user roles', 'update system user restriction, user id : 35', '2024-05-15 16:17:24', NULL, NULL, NULL),
(4, 2, 'home > system user > update user roles', 'update system user restriction, user id : 36', '2024-05-15 16:17:58', NULL, NULL, NULL),
(5, 2, 'account page', 'logout to account.', '2024-05-15 16:19:13', NULL, NULL, NULL),
(6, 35, 'login page', 'login to account.', '2024-05-15 16:19:22', NULL, NULL, NULL),
(7, 35, 'account page', 'logout to account.', '2024-05-15 16:19:26', NULL, NULL, NULL),
(8, 36, 'login page', 'login to account.', '2024-05-15 16:19:38', NULL, NULL, NULL),
(9, 36, 'account page', 'logout to account.', '2024-05-15 16:19:43', NULL, NULL, NULL),
(10, 2, 'login page', 'login to account.', '2024-05-15 16:26:48', NULL, NULL, NULL),
(11, 2, 'login page', 'login to account.', '2024-05-16 09:07:51', NULL, NULL, NULL),
(12, 2, 'login page', 'login to account.', '2024-08-11 14:20:13', NULL, NULL, NULL),
(13, 2, 'home > system user > update user roles', 'update system user restriction, user id : 29', '2024-08-11 14:20:29', NULL, NULL, NULL),
(14, 2, 'home > system user > update user roles', 'update system user restriction, user id : 35', '2024-08-11 14:20:42', NULL, NULL, NULL),
(15, 2, 'home > system user > update user roles', 'update system user restriction, user id : 36', '2024-08-11 14:20:57', NULL, NULL, NULL),
(16, 2, 'account page', 'logout to account.', '2024-08-11 14:22:03', NULL, NULL, NULL),
(17, 2, 'login page', 'login to account.', '2024-08-11 14:37:05', NULL, NULL, NULL),
(18, 2, 'home > system user', 'add new system user , user id : 37', '2024-08-11 14:37:41', NULL, NULL, NULL),
(19, 2, 'home > system user > update user roles', 'update system user restriction, user id : 37', '2024-08-11 14:38:21', NULL, NULL, NULL),
(20, 2, 'account page', 'logout to account.', '2024-08-11 14:38:26', NULL, NULL, NULL),
(21, 37, 'login page', 'login to account.', '2024-08-11 14:38:52', NULL, NULL, NULL),
(22, 37, 'login page', 'login to account.', '2024-08-11 14:46:28', NULL, NULL, NULL),
(23, 37, 'home > system user > update user roles', 'update system user restriction, user id : 34', '2024-08-11 14:47:26', NULL, NULL, NULL),
(24, 37, 'account page', 'logout to account.', '2024-08-11 14:48:20', NULL, NULL, NULL),
(25, 37, 'account page', 'logout to account.', '2024-08-11 14:49:04', NULL, NULL, NULL),
(26, 37, 'login page', 'login to account.', '2024-08-11 14:52:26', NULL, NULL, NULL),
(27, 37, 'account page', 'logout to account.', '2024-08-11 14:52:32', NULL, NULL, NULL),
(28, 37, 'login page', 'login to account.', '2024-08-11 14:55:00', NULL, NULL, NULL),
(29, 37, 'account page', 'logout to account.', '2024-08-11 14:56:03', NULL, NULL, NULL),
(30, 36, 'login page', 'login to account.', '2024-08-11 16:44:40', NULL, NULL, NULL),
(31, 36, 'login page', 'login to account.', '2024-08-12 11:58:18', NULL, NULL, NULL),
(32, 36, 'home > system user > delete user', 'detele system user, user id : 33', '2024-08-12 11:58:48', NULL, NULL, NULL),
(33, 36, 'home > system user > delete user', 'detele system user, user id : 32', '2024-08-12 11:58:53', NULL, NULL, NULL),
(34, 36, 'home > system user > delete user', 'detele system user, user id : 31', '2024-08-12 11:58:59', NULL, NULL, NULL),
(35, 36, 'home > system user > delete user', 'detele system user, user id : 34', '2024-08-12 11:59:07', NULL, NULL, NULL),
(36, 36, 'home > system user', 'add new system user , user id : 38', '2024-08-12 12:00:00', NULL, NULL, NULL),
(37, 38, 'login page', 'login to account.', '2024-08-12 12:12:09', NULL, NULL, NULL),
(38, 36, 'home > system user > update user roles', 'update system user restriction, user id : 38', '2024-08-12 12:13:22', NULL, NULL, NULL),
(39, 36, 'home > system user', 'add new system user , user id : 39', '2024-08-12 12:38:29', NULL, NULL, NULL),
(40, 36, 'home > system user > update user roles', 'update system user restriction, user id : 39', '2024-08-12 12:39:05', NULL, NULL, NULL),
(41, 36, 'home > system user', 'add new system user , user id : 40', '2024-08-12 12:40:16', NULL, NULL, NULL),
(42, 36, 'home > system user > update user roles', 'update system user restriction, user id : 40', '2024-08-12 12:40:54', NULL, NULL, NULL),
(43, 40, 'login page', 'login to account.', '2024-08-12 12:43:03', NULL, NULL, NULL),
(44, 36, 'home > system user > update user roles', 'update system user restriction, user id : 36', '2024-08-12 12:51:55', NULL, NULL, NULL),
(45, 40, 'login page', 'login to account.', '2024-08-15 17:16:01', NULL, NULL, NULL),
(46, 36, 'login page', 'login to account.', '2024-09-01 16:59:53', NULL, NULL, NULL),
(47, 36, 'home > system user', 'add new system user , user id : 41', '2024-09-01 17:02:09', NULL, NULL, NULL),
(48, 36, 'home > system user > update user roles', 'update system user restriction, user id : 41', '2024-09-01 17:02:51', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `name` varchar(125) DEFAULT NULL,
  `contact_person_1` varchar(125) DEFAULT NULL,
  `contact_person_2` varchar(125) DEFAULT NULL,
  `contact_number_1` varchar(50) DEFAULT NULL,
  `contact_number_2` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `tin` varchar(50) DEFAULT NULL,
  `terms_and_conditions` text DEFAULT NULL,
  `shipping_notes` text DEFAULT NULL,
  `email` varchar(125) DEFAULT NULL,
  `attension_to` varchar(125) DEFAULT NULL,
  `fax_no` varchar(125) DEFAULT NULL,
  `phone` varchar(50) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `date_created`, `user_id`, `deleted`, `date_deleted`, `deleted_by`, `date_modified`, `modified_by`, `name`, `contact_person_1`, `contact_person_2`, `contact_number_1`, `contact_number_2`, `address`, `tin`, `terms_and_conditions`, `shipping_notes`, `email`, `attension_to`, `fax_no`, `phone`, `code`, `website`) VALUES
(1, '2024-08-12 18:45:37', 36, 0, '', NULL, '', NULL, 'Ashghal', 'Bahaa', '', '', '', '', NULL, NULL, NULL, '', 'Mr. Bahaa Alameddin', '', '', '1', ''),
(2, '2024-08-15 23:18:18', 40, 0, '', NULL, '', NULL, 'Al Boraq Automobile', 'Nevin Manoj', 'Jacob', '44599666', '44599666', 'P.O. Box 23619 \r\nMedina Centrale, The Pearl \r\nDoha, Qatar\r\n', NULL, NULL, NULL, 'manoj.nevin@boraq-porsche.com.qa', '', '', '44599666', 'ABQ', '');

-- --------------------------------------------------------

--
-- Table structure for table `clients_documents`
--

CREATE TABLE `clients_documents` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `attachments` text DEFAULT NULL,
  `document_type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `crv`
--

CREATE TABLE `crv` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `crv_date` varchar(25) DEFAULT NULL,
  `payment_mode` int(11) DEFAULT NULL,
  `amount_received` varchar(100) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `cheque_no` varchar(100) DEFAULT NULL,
  `account_no` varchar(25) DEFAULT NULL,
  `debit_credit_type_id` int(11) DEFAULT NULL,
  `ar_account_id` int(11) DEFAULT NULL,
  `cash_control_account_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `last_name` varchar(225) NOT NULL,
  `first_name` varchar(225) NOT NULL,
  `middle_name` varchar(225) DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `contact_no` varchar(255) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `employee_number` varchar(25) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `deleted_by` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `rate` varchar(25) DEFAULT NULL,
  `basic_amount` float(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `error_logging`
--

CREATE TABLE `error_logging` (
  `id` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `error_dt` varchar(30) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `line_number` int(11) DEFAULT NULL,
  `attended` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `error_logging`
--

INSERT INTO `error_logging` (`id`, `type`, `message`, `filename`, `error_dt`, `user_id`, `line_number`, `attended`) VALUES
(1, 'TypeError', 'Unsupported operand types: int + string', '/ventum/sales/edit_quotation/1', '2024-05-15 21:48:07', 2, 529, 0),
(2, 'TypeError', 'Unsupported operand types: int + string', '/ventum/sales/edit_quotation/1', '2024-05-15 21:48:13', 2, 529, 0),
(3, 'TypeError', 'Unsupported operand types: int + string', '/ventum/sales/edit_quotation/1', '2024-05-15 21:48:17', 2, 529, 0),
(4, 'TypeError', 'Unsupported operand types: int + string', '/ventum/sales/edit_quotation/1', '2024-05-15 21:48:38', 2, 529, 0),
(5, 'TypeError', 'Unsupported operand types: int + string', '/ventum/sales/edit_quotation/1', '2024-05-15 21:48:45', 2, 529, 0),
(6, 'TypeError', 'Unsupported operand types: string / int', '/ventum/sales/edit_quotation/1', '2024-05-15 21:50:39', 2, 530, 0),
(7, '404', 'The page you requested was not found.', '/favicon.ico', '2024-08-11 14:20:13', 0, 0, 0),
(8, '404', 'The page you requested was not found.', '/favicon.ico', '2024-08-11 14:38:52', 0, 0, 0),
(9, '404', 'The page you requested was not found.', '/favicon.ico', '2024-08-11 14:52:26', 0, 0, 0),
(10, '404', 'The page you requested was not found.', '/favicon.ico', '2024-08-11 14:55:00', 0, 0, 0),
(11, '404', 'The page you requested was not found.', '/apple-touch-icon-precomposed.png', '2024-08-11 16:44:10', 0, 0, 0),
(12, '404', 'The page you requested was not found.', '/apple-touch-icon.png', '2024-08-11 16:44:10', 0, 0, 0),
(13, '404', 'The page you requested was not found.', '/assets/themes/select2/select2x2.png', '2024-08-11 16:45:47', 0, 0, 0),
(14, '404', 'The page you requested was not found.', '/assets/themes/select2/select2x2.png', '2024-08-11 16:46:30', 0, 0, 0),
(15, '404', 'The page you requested was not found.', '/assets/themes/select2/select2x2.png', '2024-08-11 16:47:30', 0, 0, 0),
(16, '404', 'The page you requested was not found.', '/favicon.ico', '2024-08-12 12:12:09', 0, 0, 0),
(17, '404', 'The page you requested was not found.', '/assets/themes/select2/select2x2.png', '2024-08-12 12:14:01', 0, 0, 0),
(18, '404', 'The page you requested was not found.', '/favicon.ico', '2024-08-12 12:43:04', 0, 0, 0),
(19, '404', 'The page you requested was not found.', '/assets/images/clients/logo-1.png?1723459537', '2024-08-12 12:45:37', 0, 0, 0),
(20, '404', 'The page you requested was not found.', '/assets/themes/select2/select2x2.png', '2024-08-12 12:45:44', 0, 0, 0),
(21, 'TypeError', 'Sales::check_quote_no(): Argument #1 ($q) must be of type int, string given, called in C:xampphtdocssystemcoreCodeIgniter.php on line 529', '/sales/check_quote_no/Q000001', '2024-08-12 18:46:22', 36, 811, 0),
(22, 'TypeError', 'Sales::check_quote_no(): Argument #1 ($q) must be of type int, string given, called in C:xampphtdocssystemcoreCodeIgniter.php on line 529', '/sales/check_quote_no/Q000001', '2024-08-12 18:46:34', 36, 811, 0),
(23, '404', 'The page you requested was not found.', '/assets/themes/select2/select2x2.png', '2024-08-12 12:49:58', 0, 0, 0),
(24, '404', 'The page you requested was not found.', '/assets/themes/select2/select2x2.png', '2024-08-12 12:50:48', 0, 0, 0),
(25, '404', 'The page you requested was not found.', '/assets/images/clients/logo-1.png?1723459920', '2024-08-12 12:52:00', 0, 0, 0),
(26, '404', 'The page you requested was not found.', '/assets/images/clients/logo-1.png?1723459949', '2024-08-12 12:52:29', 0, 0, 0),
(27, '404', 'The page you requested was not found.', '/favicon.ico', '2024-08-15 17:15:31', 0, 0, 0),
(28, '404', 'The page you requested was not found.', '/assets/images/clients/logo-1.png?1723734970', '2024-08-15 17:16:10', 0, 0, 0),
(29, '404', 'The page you requested was not found.', '/assets/images/clients/logo-2.png?1723735098', '2024-08-15 17:18:18', 0, 0, 0),
(30, '404', 'The page you requested was not found.', '/assets/images/clients/logo-1.png?1723735098', '2024-08-15 17:18:18', 0, 0, 0),
(31, 'TypeError', 'Sales::check_quote_no(): Argument #1 ($q) must be of type int, string given, called in C:xampphtdocssystemcoreCodeIgniter.php on line 529', '/sales/check_quote_no/Q000002', '2024-08-15 23:21:48', 40, 811, 0),
(32, 'TypeError', 'Sales::check_quote_no(): Argument #1 ($q) must be of type int, string given, called in C:xampphtdocssystemcoreCodeIgniter.php on line 529', '/sales/check_quote_no/Q000002', '2024-08-15 23:21:48', 40, 811, 0),
(33, 'TypeError', 'Sales::check_quote_no(): Argument #1 ($q) must be of type int, string given, called in C:xampphtdocssystemcoreCodeIgniter.php on line 529', '/sales/check_quote_no/Q000002', '2024-08-15 23:21:50', 40, 811, 0),
(34, 'TypeError', 'Sales::check_quote_no(): Argument #1 ($q) must be of type int, string given, called in C:xampphtdocssystemcoreCodeIgniter.php on line 529', '/sales/check_quote_no/Q000002', '2024-08-15 23:21:50', 40, 811, 0),
(35, 'TypeError', 'Sales::check_quote_no(): Argument #1 ($q) must be of type int, string given, called in C:xampphtdocssystemcoreCodeIgniter.php on line 529', '/sales/check_quote_no/Q000002', '2024-08-15 23:21:53', 40, 811, 0),
(36, 'TypeError', 'Sales::check_quote_no(): Argument #1 ($q) must be of type int, string given, called in C:xampphtdocssystemcoreCodeIgniter.php on line 529', '/sales/check_quote_no/Q000002', '2024-08-15 23:21:53', 40, 811, 0),
(37, 'TypeError', 'Sales::check_quote_no(): Argument #1 ($q) must be of type int, string given, called in C:xampphtdocssystemcoreCodeIgniter.php on line 529', '/sales/check_quote_no/Q000002', '2024-08-15 23:21:53', 40, 811, 0),
(38, 'TypeError', 'Sales::check_quote_no(): Argument #1 ($q) must be of type int, string given, called in C:xampphtdocssystemcoreCodeIgniter.php on line 529', '/sales/check_quote_no/Q000002', '2024-08-15 23:22:02', 40, 811, 0),
(39, 'TypeError', 'Sales::check_quote_no(): Argument #1 ($q) must be of type int, string given, called in C:xampphtdocssystemcoreCodeIgniter.php on line 529', '/sales/check_quote_no/Q000002', '2024-08-15 23:22:02', 40, 811, 0),
(40, 'TypeError', 'ksort(): Argument #1 ($array) must be of type array, null given', '/sales/cost_summary/2', '2024-08-15 23:45:46', 40, 82, 0),
(41, 'TypeError', 'ksort(): Argument #1 ($array) must be of type array, null given', '/sales/cost_summary/2', '2024-08-15 23:45:47', 40, 82, 0),
(42, '404', 'The page you requested was not found.', '/apple-touch-icon-precomposed.png', '2024-09-01 09:47:12', 0, 0, 0),
(43, '404', 'The page you requested was not found.', '/apple-touch-icon.png', '2024-09-01 09:47:12', 0, 0, 0),
(44, '404', 'The page you requested was not found.', '/assets/images/clients/logo-1.png?1725202803', '2024-09-01 17:00:03', 0, 0, 0),
(45, '404', 'The page you requested was not found.', '/assets/images/clients/logo-2.png?1725202803', '2024-09-01 17:00:03', 0, 0, 0),
(46, '404', 'The page you requested was not found.', '/assets/themes/select2/select2x2.png', '2024-09-01 17:05:20', 0, 0, 0),
(47, '404', 'The page you requested was not found.', '/assets/themes/select2/select2x2.png', '2024-09-01 17:05:30', 0, 0, 0),
(48, '404', 'The page you requested was not found.', '/assets/themes/select2/select2x2.png', '2024-09-01 17:06:23', 0, 0, 0),
(49, '404', 'The page you requested was not found.', '/assets/themes/select2/select2x2.png', '2024-09-01 17:07:08', 0, 0, 0),
(50, '404', 'The page you requested was not found.', '/assets/images/clients/logo-1.png?1725203231', '2024-09-01 17:07:11', 0, 0, 0),
(51, '404', 'The page you requested was not found.', '/assets/images/clients/logo-2.png?1725203231', '2024-09-01 17:07:11', 0, 0, 0),
(52, '404', 'The page you requested was not found.', '/favicon.ico', '2024-09-02 15:22:32', 0, 0, 0),
(53, '404', 'The page you requested was not found.', '/favicon.ico', '2024-09-02 16:04:05', 0, 0, 0),
(54, '404', 'The page you requested was not found.', '/favicon.ico', '2024-09-05 12:13:54', 0, 0, 0),
(55, '404', 'The page you requested was not found.', '/apple-touch-icon-precomposed.png', '2024-09-08 07:30:31', 0, 0, 0),
(56, '404', 'The page you requested was not found.', '/apple-touch-icon.png', '2024-09-08 07:30:31', 0, 0, 0),
(57, '404', 'The page you requested was not found.', '/favicon.ico', '2024-09-23 14:20:41', 0, 0, 0),
(58, '404', 'The page you requested was not found.', '/favicon.ico', '2024-09-23 14:20:48', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fm_account_receivable`
--

CREATE TABLE `fm_account_receivable` (
  `id` int(11) NOT NULL,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `fm_account_receivable`
--

INSERT INTO `fm_account_receivable` (`id`, `title`, `ds`, `dc`, `user_id`) VALUES
(1, '400001070', 'A/R-Project Materials', '2024-04-24', 2),
(2, '4000001201', 'A/R-Manpower', '2024-04-24', 2),
(3, '4000007082', 'A/R-Assets', '2024-04-24', 2);

-- --------------------------------------------------------

--
-- Table structure for table `fm_adjustments_types`
--

CREATE TABLE `fm_adjustments_types` (
  `id` int(11) NOT NULL,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `fm_adjustments_types`
--

INSERT INTO `fm_adjustments_types` (`id`, `title`, `ds`, `dc`, `user_id`) VALUES
(1, 'Returns and Damaged Goods', 'Returns and Damaged Goods', '2023-12-27', 2),
(2, 'Physical Count Discrepancies', 'Physical Count Discrepancies', '2023-12-27', 2),
(3, 'Obsolete or Expired Items', 'Obsolete or Expired Items', '2023-12-27', 2),
(4, 'Write-offs', 'Write-offs', '2023-12-27', 2),
(5, 'Seasonal Adjustments', 'Seasonal Adjustments', '2023-12-27', 2);

-- --------------------------------------------------------

--
-- Table structure for table `fm_cash_control_account`
--

CREATE TABLE `fm_cash_control_account` (
  `id` int(11) NOT NULL,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `fm_cash_control_account`
--

INSERT INTO `fm_cash_control_account` (`id`, `title`, `ds`, `dc`, `user_id`) VALUES
(1, '40000006085', 'Cash on Hand (Main)', '2024-04-24', 2),
(2, '400008426', 'Cash Control - Labor', '2024-04-24', 2),
(3, '400008722', 'Cash Control - Project', '2024-04-24', 2);

-- --------------------------------------------------------

--
-- Table structure for table `fm_classification`
--

CREATE TABLE `fm_classification` (
  `id` int(11) NOT NULL,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `fm_classification`
--

INSERT INTO `fm_classification` (`id`, `title`, `ds`, `dc`, `user_id`) VALUES
(1, 'Class1', 'Class1', '2022-06-22', 2),
(2, 'Class2', 'Class2', '2022-06-22', 2),
(3, '', '', '2022-12-19', 2),
(4, 'n/a', 'n/a', '2022-12-19', 2);

-- --------------------------------------------------------

--
-- Table structure for table `fm_client_activity_type`
--

CREATE TABLE `fm_client_activity_type` (
  `id` int(11) NOT NULL,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `fm_client_activity_type`
--

INSERT INTO `fm_client_activity_type` (`id`, `title`, `ds`, `dc`, `user_id`) VALUES
(1, 'Onsite Meeting', 'Onsite Meeting', '2024-04-25', 2),
(2, 'Telephone', 'Telephone', '2024-04-25', 2),
(3, 'Online Meeting', 'Online Meeting', '2024-04-25', 2),
(4, 'Tour', 'Tour', '2024-04-25', 2),
(5, 'Contract Signing', 'Contract Signing', '2024-04-25', 2);

-- --------------------------------------------------------

--
-- Table structure for table `fm_client_category`
--

CREATE TABLE `fm_client_category` (
  `id` int(11) NOT NULL,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `fm_client_category`
--

INSERT INTO `fm_client_category` (`id`, `title`, `ds`, `dc`, `user_id`) VALUES
(1, 'Prospect Client', 'These are potential clients who have shown interest in your products or services but have not yet made a purchase.', '2023-09-02', 2),
(2, 'Current Client', 'These are clients who are currently active and have ongoing business with your company. They have made at least one purchase or engaged in your services.', '2023-09-02', 2),
(3, 'Inactive Client', 'These are clients who were once active but have not engaged with your business for a certain period. They might need re-engagement efforts.', '2023-09-02', 2),
(4, 'Lost Client', 'These are clients who were previously active but are no longer doing business with your company. They might be considered lost opportunities.', '2023-09-02', 2),
(5, 'VIP Client', 'These are high-value clients who generate significant revenue for your business. They might receive special treatment or offers.', '2023-09-02', 2),
(6, 'New Client', 'These are clients who have recently joined your client base but have not yet engaged in significant business.', '2023-09-02', 2),
(7, 'Pending Client', 'These are clients whose status is pending due to some specific action or verification.', '2023-09-02', 2);

-- --------------------------------------------------------

--
-- Table structure for table `fm_client_document_type`
--

CREATE TABLE `fm_client_document_type` (
  `id` int(11) NOT NULL,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `fm_client_document_type`
--

INSERT INTO `fm_client_document_type` (`id`, `title`, `ds`, `dc`, `user_id`) VALUES
(1, 'Contract', 'Contract', '2024-04-25', 2),
(2, 'Registration', 'Registration', '2024-04-25', 2),
(3, 'ID', 'ID', '2024-04-25', 2),
(4, 'Proposal', 'Proposal', '2024-04-25', 2);

-- --------------------------------------------------------

--
-- Table structure for table `fm_client_progress_status`
--

CREATE TABLE `fm_client_progress_status` (
  `id` int(11) NOT NULL,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `fm_client_progress_status`
--

INSERT INTO `fm_client_progress_status` (`id`, `title`, `ds`, `dc`, `user_id`) VALUES
(1, 'Lead', 'This status can be assigned to clients who have shown initial interest but haven\'t progressed beyond the lead stage.', '2023-09-02', 2),
(2, 'Contacted', 'Indicates that your team has made initial contact with the client, possibly through a phone call, email, or meeting.', '2023-09-02', 2),
(3, 'Meeting Scheduled', 'This status can be used when a meeting is scheduled with the client to discuss their needs or potential solutions.', '2023-09-02', 2),
(4, 'Proposal Sent', 'Shows that a formal proposal or quote has been sent to the client for their consideration.', '2023-09-02', 2),
(5, 'Follow-up Required', 'Clients in this status may need additional follow-up or clarification before they can move forward.', '2023-09-02', 2),
(6, 'Negotiation', 'Pending Approval', '2023-09-02', 2),
(7, 'Deal Signed', 'This status signifies that the deal has been successfully signed or the client has made a commitment.', '2023-09-02', 2),
(8, 'Waiting for Payment', 'Clients who have agreed to the deal but haven\'t made the payment yet.', '2023-09-02', 2),
(9, 'On Hold', 'Sometimes, clients might put projects on hold for various reasons. This status can be used to track such cases.', '2023-09-02', 2),
(10, 'Closed - Won', 'Indicates successful sales or project closure.', '2023-09-02', 2),
(11, 'Closed - Lost', 'Clients who decided not to move forward with your offer.', '2023-09-02', 2),
(12, 'Inactive', 'Clients who were once active but haven\'t responded or engaged for an extended period.', '2023-09-02', 2),
(13, 'Completed', 'For clients who have received the service or product and the project is completed.', '2023-09-02', 2);

-- --------------------------------------------------------

--
-- Table structure for table `fm_currency_rate`
--

CREATE TABLE `fm_currency_rate` (
  `id` int(11) NOT NULL,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `currency_symbol` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `fm_currency_rate`
--

INSERT INTO `fm_currency_rate` (`id`, `title`, `ds`, `dc`, `user_id`, `currency_symbol`) VALUES
(1, 'QAR', '1.000000', '2023-09-03', 2, 'QAR'),
(2, 'USD', '4.521300', '2023-09-03', 2, '$'),
(3, 'EUR', '5.320011', '2023-09-03', 2, '€'),
(4, 'UK', '6.43211', '2023-09-03', 2, '£');

-- --------------------------------------------------------

--
-- Table structure for table `fm_currency_type`
--

CREATE TABLE `fm_currency_type` (
  `id` int(11) NOT NULL,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `vs_peso_rate` float(11,8) DEFAULT NULL,
  `is_peso` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `fm_currency_type`
--

INSERT INTO `fm_currency_type` (`id`, `title`, `ds`, `dc`, `user_id`, `vs_peso_rate`, `is_peso`) VALUES
(7, 'PHP', 'Philippine Peso', '2022-06-22', 2, 1.00000000, 1),
(8, 'USD', 'US Dollar', '2022-12-23', 2, 54.44510269, 0),
(9, 'JPY', 'Japanese Yen', '2022-06-22', 2, 0.56822211, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fm_debit_credit_type`
--

CREATE TABLE `fm_debit_credit_type` (
  `id` int(11) NOT NULL,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `fm_debit_credit_type`
--

INSERT INTO `fm_debit_credit_type` (`id`, `title`, `ds`, `dc`, `user_id`) VALUES
(1, 'NAPS', 'NAPS', '2024-04-24', 2),
(2, 'VISA', 'VISA ', '2024-04-24', 2),
(3, 'MASTER CARD', 'MASTER CARD', '2024-04-24', 2);

-- --------------------------------------------------------

--
-- Table structure for table `fm_delivery_place`
--

CREATE TABLE `fm_delivery_place` (
  `id` int(11) NOT NULL,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `fm_delivery_place`
--

INSERT INTO `fm_delivery_place` (`id`, `title`, `ds`, `dc`, `user_id`) VALUES
(12, 'JGM Philippines inc', 'JGM Philippines inc', '2022-05-30', 2),
(13, 'Warehouse 1', 'Warehouse 1', '2022-05-30', 2);

-- --------------------------------------------------------

--
-- Table structure for table `fm_department`
--

CREATE TABLE `fm_department` (
  `id` int(11) NOT NULL,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pr1` int(11) DEFAULT NULL,
  `pr2` int(11) DEFAULT NULL,
  `pr3` int(11) DEFAULT NULL,
  `po1` int(11) DEFAULT NULL,
  `po2` int(11) DEFAULT NULL,
  `po3` int(11) DEFAULT NULL,
  `pr_auto_approved` int(11) DEFAULT 0,
  `po_auto_approved` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `fm_department`
--

INSERT INTO `fm_department` (`id`, `title`, `ds`, `dc`, `user_id`, `pr1`, `pr2`, `pr3`, `po1`, `po2`, `po3`, `pr_auto_approved`, `po_auto_approved`) VALUES
(1, 'MIS', 'IT Department', '2017-05-22', 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(2, 'Accounting', 'Accounting', '2017-05-22', 2, 2, 0, 8, 0, 8, 0, 1, 1),
(3, 'HR', 'Human Resource', '2017-06-18', 2, 14, 16, 0, 2, 0, 0, 1, 1),
(4, 'Production', 'Production', '2017-06-20', 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(5, 'Purchasing', 'Purchasing Department', '2017-06-20', 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(6, 'Warehouse', 'Warehouse', '2017-06-20', 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(7, 'Admin', 'Admin', '2017-06-20', 2, 11, 12, 0, 0, 0, 0, 1, 0),
(8, 'Sales', 'Sales', '2023-06-08', 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(9, 'Design', 'Design', '2023-06-08', 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fm_designation`
--

CREATE TABLE `fm_designation` (
  `id` int(11) NOT NULL,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `fm_designation`
--

INSERT INTO `fm_designation` (`id`, `title`, `ds`, `dc`, `user_id`) VALUES
(3, 'Web Developer', 'PHP developer, web application\'s', '2017-05-22', 2),
(4, 'Accountant', 'Accounting Staff', '2017-05-22', 2),
(5, 'Department Manager', 'Department Manager', '2023-01-11', 2);

-- --------------------------------------------------------

--
-- Table structure for table `fm_foreign_charges`
--

CREATE TABLE `fm_foreign_charges` (
  `id` int(11) NOT NULL,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `fm_foreign_charges`
--

INSERT INTO `fm_foreign_charges` (`id`, `title`, `ds`, `dc`, `user_id`) VALUES
(1, 'FREIGHT', 'FREIGHT', '2023-09-03', 2),
(2, 'HANDLING', 'HANDLING', '2023-09-03', 2),
(3, 'DOCUMENTATION', 'DOCUMENTATION', '2023-09-03', 2),
(4, 'INSURANCE', 'INSURANCE', '2023-09-03', 2),
(5, 'OTHERS', 'OTHERS', '2023-09-03', 2),
(6, 'SE FREIGHT', 'SE FREIGHT', '2023-09-03', 2);

-- --------------------------------------------------------

--
-- Table structure for table `fm_grv_transport`
--

CREATE TABLE `fm_grv_transport` (
  `id` int(11) NOT NULL,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `fm_grv_transport`
--

INSERT INTO `fm_grv_transport` (`id`, `title`, `ds`, `dc`, `user_id`) VALUES
(1, 'DHL', 'DHL', '2024-05-15', 2),
(2, 'Talabat Express', 'Talabat Express', '2024-05-15', 2);

-- --------------------------------------------------------

--
-- Table structure for table `fm_local_charges`
--

CREATE TABLE `fm_local_charges` (
  `id` int(11) NOT NULL,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `fm_local_charges`
--

INSERT INTO `fm_local_charges` (`id`, `title`, `ds`, `dc`, `user_id`) VALUES
(1, 'FREIGHT', 'FREIGHT', '2023-09-03', 2),
(2, 'HANDLING', 'HANDLING', '2023-09-03', 2),
(3, 'CLEARING', 'CLEARING', '2023-09-03', 2),
(4, 'TRANSPORT', 'TRANSPORT', '2023-09-03', 2),
(5, 'BANK', 'BANK', '2023-09-03', 2),
(6, 'DEMMURRAGE', 'DEMMURRAGE', '2023-09-03', 2),
(7, 'CUSTOMS DUTIES', 'CUSTOMS DUTIES', '2023-09-03', 2),
(8, 'CUSTOM CLEARANCE & DOCS', 'CUSTOM CLEARANCE & DOCS', '2023-09-03', 2);

-- --------------------------------------------------------

--
-- Table structure for table `fm_manpower`
--

CREATE TABLE `fm_manpower` (
  `id` int(11) NOT NULL,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `fm_manpower`
--

INSERT INTO `fm_manpower` (`id`, `title`, `ds`, `dc`, `user_id`) VALUES
(1, 'Projects Manager', '1200', '2023-09-11', 2),
(2, 'Deputy Commissioning Manager', '800', '2023-09-11', 2),
(3, 'Commissioning engineer', '650', '2023-09-11', 2),
(4, 'Projects Engineer', '750', '2023-09-11', 2),
(5, 'Maintenance Engineer', '650', '2023-09-11', 2),
(6, 'Document Controller', '350', '2023-09-11', 2),
(7, 'Installation Supervisor', '350', '2023-09-11', 2),
(8, 'HSE Manager', '350', '2023-09-11', 2),
(9, 'HSE Officer', '400', '2023-09-11', 2),
(10, 'Draftsman', '200', '2023-09-11', 2),
(11, 'Installation Technician (8 technician for 150 days)', '200', '2023-09-11', 2),
(12, 'Installation Helper (8 Helpers for 150 days)', '200', '2023-09-11', 2),
(13, 'Driver', '200', '2023-09-11', 2),
(14, 'Maintenance Technician', '200', '2023-09-11', 2);

-- --------------------------------------------------------

--
-- Table structure for table `fm_project_status`
--

CREATE TABLE `fm_project_status` (
  `id` int(11) NOT NULL,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `fm_project_status`
--

INSERT INTO `fm_project_status` (`id`, `title`, `ds`, `dc`, `user_id`) VALUES
(1, 'Quotation', 'For Quotation Only', '2023-03-17', 2),
(2, 'In Progress', 'Projects that are in progress', '2023-03-17', 2),
(3, 'Finished', 'Finished Project', '2023-04-14', 2);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `item_code` varchar(125) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT 0,
  `added_from` varchar(20) DEFAULT NULL,
  `unit_cost_price` varchar(50) DEFAULT '0',
  `unit_price` varchar(50) DEFAULT '0',
  `old_unit_cost_price` varchar(50) DEFAULT '0',
  `old_qty` int(11) DEFAULT 0,
  `receiving_history` text DEFAULT NULL,
  `issuance_history` text DEFAULT NULL,
  `manufacturer_price` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_adjustments`
--

CREATE TABLE `inventory_adjustments` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `attachments` text DEFAULT NULL,
  `confirmed` int(11) DEFAULT 0,
  `confirmed_date` varchar(25) DEFAULT NULL,
  `confirmed_by` int(11) DEFAULT NULL,
  `adjustment_type_id` int(11) DEFAULT NULL,
  `covered_date` varchar(25) DEFAULT NULL,
  `ref_no` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_adjustments_items`
--

CREATE TABLE `inventory_adjustments_items` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `adjustment_id` int(11) DEFAULT NULL,
  `adj_qty` varchar(50) DEFAULT NULL,
  `qty_before` varchar(50) DEFAULT NULL,
  `qty_after` varchar(50) DEFAULT NULL,
  `confirmed` int(11) DEFAULT 0,
  `inventory_id` int(11) DEFAULT NULL,
  `unit_cost_price` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_movement`
--

CREATE TABLE `inventory_movement` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `inventory_id` int(11) DEFAULT NULL,
  `movement_from` varchar(255) DEFAULT NULL,
  `qty_before` varchar(25) DEFAULT NULL,
  `qty` varchar(25) DEFAULT NULL,
  `qty_after` varchar(25) DEFAULT NULL,
  `addition` int(11) DEFAULT 1,
  `quotation_id` int(11) DEFAULT NULL,
  `ref_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `inventory_quotation_id` int(11) DEFAULT NULL,
  `unit_cost_price` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_quotation`
--

CREATE TABLE `inventory_quotation` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `item_code` varchar(125) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT 0,
  `quotation_id` int(11) DEFAULT NULL,
  `quotation_location_ids` varchar(255) DEFAULT NULL,
  `suppliers` varchar(255) DEFAULT NULL,
  `landed_cost_rate_ids` varchar(255) DEFAULT NULL,
  `package_ids` varchar(255) DEFAULT NULL,
  `unit_cost` varchar(100) DEFAULT NULL,
  `is_local` int(11) DEFAULT 0,
  `inventory_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_returns`
--

CREATE TABLE `inventory_returns` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `confirmed` int(11) DEFAULT 0,
  `return_date` varchar(25) DEFAULT NULL,
  `confirmed_by` int(11) DEFAULT NULL,
  `issuance_id` int(11) DEFAULT NULL,
  `ref_no` varchar(100) DEFAULT NULL,
  `confirmed_date` varchar(30) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `job_order_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_returns_items`
--

CREATE TABLE `inventory_returns_items` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `issuance_id` int(11) DEFAULT NULL,
  `qty` varchar(50) DEFAULT NULL,
  `qty_before` varchar(50) DEFAULT NULL,
  `qty_after` varchar(50) DEFAULT NULL,
  `confirmed` int(11) DEFAULT 0,
  `inventory_id` int(11) DEFAULT NULL,
  `issuance_item_id` int(11) DEFAULT NULL,
  `return_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `job_order_id` int(11) DEFAULT NULL,
  `date_issued` varchar(25) DEFAULT NULL,
  `issued_qty` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `issuance`
--

CREATE TABLE `issuance` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `ref_no` varchar(50) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `issued_date` varchar(25) DEFAULT NULL,
  `confirmed` int(11) DEFAULT 0,
  `confirmed_date` varchar(25) DEFAULT NULL,
  `confirmed_by` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `job_order_id` int(11) DEFAULT NULL,
  `quotation_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `issuance_items`
--

CREATE TABLE `issuance_items` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `quotation_id` int(11) DEFAULT NULL,
  `issuance_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `inventory_id` int(11) DEFAULT NULL,
  `unit_cost_price` varchar(50) DEFAULT NULL,
  `job_order_id` int(11) DEFAULT NULL,
  `unit_cost_price_orig` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `landed_cost_rate`
--

CREATE TABLE `landed_cost_rate` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `landed_cost_rate` varchar(125) DEFAULT NULL,
  `conversion_factor` varchar(25) DEFAULT NULL,
  `freight_percent` varchar(25) DEFAULT NULL,
  `custom_percent` varchar(25) DEFAULT NULL,
  `landed_cost_factor` varchar(25) DEFAULT NULL,
  `currency_symbol` varchar(25) DEFAULT NULL,
  `local_purchase` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `landed_cost_rate`
--

INSERT INTO `landed_cost_rate` (`id`, `date_created`, `user_id`, `deleted`, `date_deleted`, `deleted_by`, `date_modified`, `modified_by`, `landed_cost_rate`, `conversion_factor`, `freight_percent`, `custom_percent`, `landed_cost_factor`, `currency_symbol`, `local_purchase`) VALUES
(1, '', NULL, 0, '', NULL, '', NULL, 'EX-WORKS US', '3.64', '8', '5', '4.11320', '$', 0),
(2, '', NULL, 0, '', NULL, '', NULL, 'EX-WORKS EU-USD', '3.64', '8', '5', '4.11320', '$', 0),
(3, '', NULL, 0, '', NULL, '', NULL, 'EX-WORKS EU-EURO', '4.00', '8', '5', '4.52000', '€', 0),
(4, '', NULL, 0, '', NULL, '', NULL, 'EX-WORKS UK', '4.50', '8', '5', '5.08500', '£', 0),
(5, '', NULL, 0, '', NULL, '', NULL, 'EX-WORKS DUBAI-USD', '3.64', '8', '5', '4.11320', '$', 0),
(6, '', NULL, 0, '', NULL, '', NULL, 'EX-WORKS DUBAI', '1.00', '8', '5', '1.13000', 'AED', 0),
(7, '', NULL, 0, '', NULL, '', NULL, 'LOCAL PURCHASE', '1.00', '0', '0', '1.00000', 'QAR', 1),
(8, '', NULL, 0, '', NULL, '', NULL, 'DDP QATAR USD', '3.64', '0', '0', '3.64000', '$', 0),
(9, '', NULL, 0, '', NULL, '', NULL, 'DDP QATAR EURO', '4.00', '0', '0', '4.00000', '€', 0),
(10, '', NULL, 0, '', NULL, '', NULL, 'CNF QATAR AIRPORT-USD', '3.64', '0', '5', '3.82200', '$', 0),
(11, '', NULL, 0, '', NULL, '', NULL, 'CNF QATAR AIRPORT-EURO', '4.00', '0', '5', '4.20000', '€', 0);

-- --------------------------------------------------------

--
-- Table structure for table `legalization_fees`
--

CREATE TABLE `legalization_fees` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `amount_from` varchar(225) DEFAULT NULL,
  `amount_to` varchar(125) DEFAULT NULL,
  `fees` varchar(125) DEFAULT NULL,
  `percent_of_invoice_val` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `legalization_fees`
--

INSERT INTO `legalization_fees` (`id`, `date_created`, `user_id`, `deleted`, `date_deleted`, `deleted_by`, `date_modified`, `modified_by`, `amount_from`, `amount_to`, `fees`, `percent_of_invoice_val`) VALUES
(1, '', NULL, 0, '', NULL, '', NULL, '1', '15000', '920', 0),
(2, '', NULL, 0, '', NULL, '', NULL, '15000.01', '100000', '1420', 0),
(3, '', NULL, 0, '', NULL, '', NULL, '100000.01', '250000', '2920', 0),
(4, '', NULL, 0, '', NULL, '', NULL, '250000.01', '1000000', '5150', 0),
(5, '', NULL, 0, '', NULL, '', NULL, '1000000.01', '100000000', '0.006', 1),
(6, '2023-12-06 18:32:21', 2, 0, '', NULL, '', NULL, '250000.01', '1000000', '5150.11', 0),
(7, '2023-12-06 18:32:27', 2, 0, '', NULL, '', NULL, '250000.01', '1000000', '5150.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `menu_main`
--

CREATE TABLE `menu_main` (
  `id` int(11) NOT NULL,
  `title` varchar(225) DEFAULT NULL,
  `module_description` text DEFAULT NULL,
  `pri` int(11) DEFAULT NULL,
  `font_icon` varchar(225) DEFAULT NULL,
  `url_link` varchar(225) DEFAULT NULL,
  `act` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `menu_main`
--

INSERT INTO `menu_main` (`id`, `title`, `module_description`, `pri`, `font_icon`, `url_link`, `act`) VALUES
(1, 'Admin', NULL, 13, 'fa-star', 'admin/home', 1),
(2, 'System Parameters', NULL, 11, 'fa-table', 'admin/file_maintenance', 0),
(3, 'Purchasing', NULL, 4, 'fa-file-powerpoint-o ', 'admin/employee', 1),
(5, 'Reports', NULL, 9, 'fa-print', 'admin/fixed_asset_transfer', 0),
(11, 'Inventory', NULL, 8, 'fa-cubes', NULL, 1),
(13, 'Accounts', NULL, 10, 'fa-money', NULL, 0),
(14, 'Quotation', NULL, 1, 'fa-tags', NULL, 1),
(15, 'HR', NULL, 8, 'fa-users', NULL, 0),
(16, 'Receiving', NULL, 5, 'fa-arrow-left', NULL, 1),
(17, 'CRM', NULL, 0, 'fa-heart', NULL, 1),
(18, 'Issuance', NULL, 6, 'fa-arrow-right', NULL, 1),
(19, 'Project', NULL, 3, 'fa-building', NULL, 1),
(20, 'Receipt', NULL, 12, 'fa-money', NULL, 1),
(21, 'Adjustments', NULL, 7, 'fa-adjust', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_sub`
--

CREATE TABLE `menu_sub` (
  `id` int(11) NOT NULL,
  `title` varchar(225) DEFAULT NULL,
  `module_description` text DEFAULT NULL,
  `pri` int(11) DEFAULT NULL,
  `font_icon` varchar(225) DEFAULT NULL,
  `url_link` varchar(225) DEFAULT NULL,
  `act` int(11) DEFAULT NULL,
  `main_menu_id` int(11) DEFAULT NULL,
  `border_top` int(11) DEFAULT 0,
  `group_title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `menu_sub`
--

INSERT INTO `menu_sub` (`id`, `title`, `module_description`, `pri`, `font_icon`, `url_link`, `act`, `main_menu_id`, `border_top`, `group_title`) VALUES
(6, 'Departments', NULL, 1, NULL, 'maintenance/table/department', 1, 15, 0, NULL),
(8, 'System Users', 'List of all administrator user in the system.', 3, NULL, 'home/system_users', 1, 1, 1, 'Administrator Transactions'),
(11, 'Inventory Master List', NULL, 1, NULL, 'reports/inventory_masterlist', 0, 5, 0, NULL),
(24, 'Designation', NULL, 2, NULL, 'maintenance/table/designation', 1, 15, 0, NULL),
(25, 'Vendor Master List', NULL, 1, NULL, 'vendor/master_list', 1, 10, 0, NULL),
(30, 'Cutoff', NULL, 1, NULL, 'posting/cutoff', 1, 8, 0, NULL),
(45, 'Backup Databse', NULL, 6, NULL, 'bib/backup_database', 1, 1, 0, NULL),
(50, 'Inventory Masterlist', NULL, 1, NULL, 'inventory/masterlist', 1, 11, 1, 'Inventory'),
(52, 'UOM Conversion', NULL, 5, NULL, 'inventory/uom', 0, 11, 0, NULL),
(54, 'Suppliers', NULL, 5, NULL, 'purchasing/supplier', 1, 14, 1, 'Supplier Masterfile'),
(57, 'Inventory Adjustments', NULL, 6, NULL, 'inventory/adjustments', 0, 11, 0, NULL),
(58, 'Inventory Movements', NULL, 3, NULL, 'reports/inventory_movement', 0, 5, 0, NULL),
(68, 'Upload', NULL, 7, NULL, 'inventory/upload', 0, 11, 0, NULL),
(69, 'Projects', NULL, 3, NULL, 'admin/projects', 1, 13, 0, NULL),
(76, 'Masterlist (Breakdown)', NULL, 2, NULL, 'inventory/inventory_masterlist_breakdown', 0, 11, 0, NULL),
(82, 'Inventory Report', NULL, 2, NULL, 'reports/inventory_report', 0, 5, 0, NULL),
(83, 'Employee', NULL, 4, NULL, 'employee/master_list', 1, 1, 0, NULL),
(84, 'Monitoring Of Materials', NULL, 1, NULL, 'reports/monitoring_of_materials', 1, 5, 0, NULL),
(86, 'Accounts Payable', NULL, 1, NULL, 'accounts/accounts_payable', 1, 13, 0, NULL),
(88, 'P.O. From Supplier Monitoring', NULL, 2, NULL, 'reports/po_supplier_monitoring', 1, 5, 0, NULL),
(89, 'Clients', NULL, 1, NULL, 'crm/clients', 1, 17, 1, 'Clients Information'),
(90, 'Quotation List', NULL, 3, NULL, 'sales/quotations', 1, 14, 0, NULL),
(92, 'Inventory Monitoring', NULL, 2, NULL, 'inventory/inventory_monitoring', 0, 11, 0, NULL),
(94, 'Inventory - Project', NULL, 3, NULL, 'inventory/inventory_project', 0, 11, 0, NULL),
(95, 'Overhead Cost', NULL, 10, NULL, 'accounts/overhead_cost', 1, 13, 0, NULL),
(96, 'Overhead Cost', NULL, 3, NULL, 'reports/overhead_cost', 1, 5, 0, NULL),
(98, 'Inventory Cost', NULL, 4, NULL, 'inventory/inventory_cost', 0, 11, 0, NULL),
(100, 'Manpower', NULL, 11, NULL, 'reports/manpower', 1, 5, 0, NULL),
(101, 'New Quotation', NULL, 2, NULL, 'sales/new_quotation', 1, 14, 1, 'Quotation Transactions'),
(102, 'Legalization Fees', NULL, 7, NULL, 'sales/legalization_fees', 1, 14, 0, NULL),
(103, 'Landed Cost Rate', NULL, 6, NULL, 'sales/landed_cost_rate', 1, 14, 1, 'System Tables'),
(104, 'Confirmed Quotation', NULL, 4, NULL, 'sales/confirmed_quotation', 1, 14, 0, NULL),
(105, 'Purchase Order', NULL, 3, NULL, 'purchasing/po_list', 1, 3, 0, NULL),
(106, 'Create P.O.', NULL, 2, NULL, 'purchasing/create_po', 1, 3, 1, 'Purchase Order Transactions'),
(107, 'Confirmed P.O.', NULL, 5, NULL, 'purchasing/confirmed_po', 1, 3, 0, NULL),
(108, 'Create GRV', NULL, 4, NULL, 'receiving/create_receiving', 1, 16, 1, 'Receiving Transactions'),
(109, 'GRV Records', NULL, 5, NULL, 'receiving/receiving_records', 1, 16, 0, NULL),
(110, 'Create Sales Order', NULL, 1, NULL, 'outgoing/create_issuance', 1, 18, 1, 'Issueance Transactions'),
(111, 'Sales Order Records', NULL, 2, NULL, 'outgoing/issuance_records', 1, 18, 0, NULL),
(112, 'Client Category', NULL, 1, NULL, 'maintenance/table/client_category', 0, 17, 0, NULL),
(113, 'Project Progress Status', NULL, 2, NULL, 'maintenance/table/client_progress_status', 0, 17, 0, NULL),
(114, 'Currency Rates', NULL, 11, NULL, 'maintenance/table/currency_rate', 1, 16, 1, 'System Tables'),
(115, 'Foreign Charges Types', NULL, 12, NULL, 'maintenance/table/foreign_charges', 1, 16, 0, NULL),
(116, 'Local Charges Types', NULL, 13, NULL, 'maintenance/table/local_charges', 1, 16, 0, NULL),
(117, 'Confirmed GRV', NULL, 6, NULL, 'receiving/confirmed_receiving_records', 1, 16, 0, NULL),
(118, 'Confirmed Sales Order', NULL, 3, NULL, 'outgoing/confirm_issuance_records', 1, 18, 0, NULL),
(119, 'Projects Masterlist', NULL, 1, NULL, 'projects/masterlist', 1, 19, 1, 'Projects Transactions'),
(120, 'Manpower', NULL, 8, NULL, 'maintenance/table/manpower', 1, 14, 0, NULL),
(121, 'Terms and Condition Temaplates', NULL, 9, NULL, 'sales/terms_and_conditions', 1, 14, 0, NULL),
(122, 'Terms and Condition Temaplates', NULL, 7, NULL, 'purchasing/terms_and_conditions', 1, 3, 1, 'System Tables'),
(123, 'Suppliers', NULL, 6, NULL, 'purchasing/supplier_po', 1, 3, 1, 'Supplier Masterfile'),
(124, 'Job Order', NULL, 2, NULL, 'projects/job_order', 1, 19, 0, NULL),
(125, 'Financial Charges', NULL, 10, NULL, 'sales/financial_charges', 1, 14, 0, NULL),
(126, 'Clock In/Out', NULL, 3, NULL, 'projects/clock_in_out', 1, 19, 0, NULL),
(127, 'Create Stock Adjustments', NULL, 2, NULL, 'inventory/create_stock_adjustments', 1, 21, 1, 'Adjustment Transactions'),
(128, 'Stock Adjustments Records', NULL, 3, NULL, 'inventory/stock_adjustments', 1, 21, 0, NULL),
(129, 'Confirmed Stock Adjustments', NULL, 4, NULL, 'inventory/confirmed_stock_adjustments', 1, 21, 0, NULL),
(130, 'Adjustments Types', NULL, 5, NULL, 'maintenance/table/adjustments_types', 1, 21, 1, 'System Tables'),
(131, 'Create Return Inventory', NULL, 6, NULL, 'inventory/create_returns', 1, 11, 1, 'Return Inventory Transactions'),
(132, 'Return Inventory', NULL, 7, '', 'inventory/return_inventory', 1, 11, 0, NULL),
(133, 'Confirmed Return Inventory', NULL, 8, NULL, 'inventory/confirmed_return_inventory', 1, 11, 0, NULL),
(134, 'Create CRV', NULL, 1, NULL, 'receipt/create_crv', 1, 20, 1, 'Cash Receipt Voucher Transactions'),
(135, 'CRV Records', NULL, 2, NULL, 'receipt/crv_records', 1, 20, 0, NULL),
(136, 'Debit/Credit Type', NULL, 3, NULL, 'maintenance/table/debit_credit_type', 1, 20, 1, 'System Tables'),
(137, 'Account Receivable G/L Number', NULL, 4, NULL, 'maintenance/table/account_receivable', 0, 20, 0, NULL),
(138, 'Cash Control Account', NULL, 5, NULL, 'maintenance/table/cash_control_account', 0, 20, 0, NULL),
(139, 'Document Types', NULL, 2, NULL, 'maintenance/table/client_document_type', 1, 17, 1, 'System Tables'),
(140, 'Activity Type', NULL, 3, NULL, 'maintenance/table/client_activity_type', 1, 17, 0, NULL),
(141, 'GRV Transport', NULL, 20, NULL, 'maintenance/table/grv_transport', 1, 16, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `name` varchar(125) DEFAULT NULL,
  `control_number` varchar(125) DEFAULT NULL,
  `project_status_id` int(11) DEFAULT NULL,
  `project_category_id` int(11) DEFAULT NULL,
  `selling_price` varchar(50) DEFAULT NULL,
  `project_ref` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `contact_number` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `project_manager` int(11) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `location` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `date_created`, `user_id`, `deleted`, `date_deleted`, `deleted_by`, `date_modified`, `modified_by`, `name`, `control_number`, `project_status_id`, `project_category_id`, `selling_price`, `project_ref`, `description`, `client_id`, `contact_person`, `contact_number`, `email`, `project_manager`, `notes`, `location`) VALUES
(1, '2024-08-12 18:46:13', 36, 0, '', NULL, '', NULL, 'National Theatre', NULL, NULL, NULL, NULL, NULL, '', 1, 'Mohamad Shafik', '', '', 0, '', ''),
(2, '2024-08-15 23:19:55', 40, 0, '', NULL, '', NULL, 'Inventory stocking software system', NULL, NULL, NULL, NULL, NULL, '', 2, 'Nevin Manoj ', '44599666', 'manoj.nevin@boraq-porsche.com.qa', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `projects_documents`
--

CREATE TABLE `projects_documents` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `attachments` text DEFAULT NULL,
  `document_type_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `projects_job_order`
--

CREATE TABLE `projects_job_order` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `quotation_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `job_order_number` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `projects_job_order_clock_in`
--

CREATE TABLE `projects_job_order_clock_in` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `job_order_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `date` varchar(25) DEFAULT NULL,
  `time_in` varchar(25) DEFAULT '1',
  `time_out` varchar(25) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `loc_in` varchar(150) DEFAULT NULL,
  `loc_out` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `projects_job_order_labor`
--

CREATE TABLE `projects_job_order_labor` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `job_order_id` int(11) DEFAULT NULL,
  `quotation_item_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `projects_progress`
--

CREATE TABLE `projects_progress` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date_cover` varchar(25) DEFAULT NULL,
  `attachments` text DEFAULT NULL,
  `activity_type_id` varchar(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `projects_recent`
--

CREATE TABLE `projects_recent` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `table` varchar(25) DEFAULT NULL,
  `date_cover` varchar(25) DEFAULT NULL,
  `ref_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `projects_recent`
--

INSERT INTO `projects_recent` (`id`, `date_created`, `user_id`, `deleted`, `date_deleted`, `deleted_by`, `date_modified`, `modified_by`, `project_id`, `table`, `date_cover`, `ref_id`, `client_id`) VALUES
(1, '', NULL, 0, '', NULL, '', NULL, 1, 'quotations', '2024-08-12 18:47', 1, 1),
(2, '', NULL, 0, '', NULL, '', NULL, 2, 'quotations', '2024-08-15 23:40', 2, 2),
(3, '', NULL, 0, '', NULL, '', NULL, 1, 'quotations', '2024-09-01 23:06', 3, 1),
(4, '', NULL, 0, '', NULL, '', NULL, 1, 'quotations', '2024-09-01 23:06', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `po_number` varchar(125) DEFAULT NULL,
  `quotation_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `supplier_email` varchar(100) DEFAULT NULL,
  `reference_no` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `terms_conditions` text DEFAULT NULL,
  `less_desc` varchar(255) DEFAULT NULL,
  `less_amount` float(20,6) DEFAULT NULL,
  `att_to` varchar(100) DEFAULT NULL,
  `confirmed` int(11) DEFAULT 0,
  `date_confirmed` varchar(25) DEFAULT NULL,
  `confirmed_by` int(11) DEFAULT NULL,
  `rate_id` int(11) DEFAULT NULL,
  `print_logs` text DEFAULT NULL,
  `exchange_rate` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_items`
--

CREATE TABLE `purchase_order_items` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `po_id` int(11) DEFAULT NULL,
  `item_code` varchar(100) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `qty` varchar(100) DEFAULT NULL,
  `price` float(20,6) DEFAULT NULL,
  `inventory_quotation_id` int(11) DEFAULT NULL,
  `quotation_id` int(11) DEFAULT NULL,
  `inventory_id` int(11) DEFAULT NULL,
  `rate_id` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `quotations`
--

CREATE TABLE `quotations` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `quotation_id` int(11) DEFAULT 0,
  `project_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `att_to` varchar(225) DEFAULT NULL,
  `validity` varchar(125) DEFAULT NULL,
  `quotation_date` varchar(125) DEFAULT NULL,
  `description` varchar(125) DEFAULT NULL,
  `terms_and_conditions` text DEFAULT NULL,
  `margin` varchar(25) NOT NULL,
  `quotation_number` varchar(50) NOT NULL,
  `draft` int(11) DEFAULT 1,
  `version` int(11) DEFAULT 0,
  `confirmed` int(11) DEFAULT 0,
  `confirmed_by` int(11) DEFAULT NULL,
  `confirmed_date` varchar(25) DEFAULT NULL,
  `sla_desc` varchar(255) DEFAULT NULL,
  `sla_amount` varchar(25) DEFAULT NULL,
  `sla_margin` varchar(15) DEFAULT NULL,
  `confirmed_hide` int(11) DEFAULT 0,
  `print_logs` text DEFAULT NULL,
  `completion_date` varchar(25) DEFAULT NULL,
  `quotation_amount` varchar(25) DEFAULT NULL,
  `master_confirmed` int(11) DEFAULT 0,
  `start_date` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `quotations`
--

INSERT INTO `quotations` (`id`, `date_created`, `user_id`, `deleted`, `date_deleted`, `deleted_by`, `date_modified`, `modified_by`, `quotation_id`, `project_id`, `client_id`, `att_to`, `validity`, `quotation_date`, `description`, `terms_and_conditions`, `margin`, `quotation_number`, `draft`, `version`, `confirmed`, `confirmed_by`, `confirmed_date`, `sla_desc`, `sla_amount`, `sla_margin`, `confirmed_hide`, `print_logs`, `completion_date`, `quotation_amount`, `master_confirmed`, `start_date`) VALUES
(1, '2024-08-12 18:47', 36, 0, '', NULL, '', NULL, 0, 1, 1, 'Mr. Mohamed Shafik', '30', '2024-08-12', '', '<p style=\"margin-bottom: 0px; font-style: normal; font-variant-caps: normal; font-stretch: normal; font-size: 10px; line-height: normal; font-family: Times; font-size-adjust: none; font-kerning: auto; font-variant-alternates: normal; font-variant-ligatures: normal; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-position: normal; font-variant-emoji: normal; font-feature-settings: normal; font-optical-sizing: auto; font-variation-settings: normal;\"><b>1-&nbsp;</b>Design, Supply, Delivery, Installation, Testing and Commission of the above system.&nbsp;</p>\r\n<p style=\"margin-bottom: 0px; font-style: normal; font-variant-caps: normal; font-stretch: normal; font-size: 10px; line-height: normal; font-family: Times; font-size-adjust: none; font-kerning: auto; font-variant-alternates: normal; font-variant-ligatures: normal; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-position: normal; font-variant-emoji: normal; font-feature-settings: normal; font-optical-sizing: auto; font-variation-settings: normal;\"><b>2-&nbsp;</b>The above design is based on site visit&nbsp;</p>\r\n<p style=\"margin-bottom: 0px; font-style: normal; font-variant-caps: normal; font-stretch: normal; font-size: 10px; line-height: normal; font-family: Times; font-size-adjust: none; font-kerning: auto; font-variant-alternates: normal; font-variant-ligatures: normal; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-position: normal; font-variant-emoji: normal; font-feature-settings: normal; font-optical-sizing: auto; font-variation-settings: normal;\"><b>3-&nbsp;</b>Any Civil, Electrical, Network and structural works are excluded.&nbsp;</p>\r\n<p style=\"margin-bottom: 0px; font-style: normal; font-variant-caps: normal; font-stretch: normal; font-size: 10px; line-height: normal; font-family: Times; font-size-adjust: none; font-kerning: auto; font-variant-alternates: normal; font-variant-ligatures: normal; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-position: normal; font-variant-emoji: normal; font-feature-settings: normal; font-optical-sizing: auto; font-variation-settings: normal;\"><b>4-&nbsp;</b><b>Payment:&nbsp;</b></p>\r\n<p style=\"margin-bottom: 0px; font-style: normal; font-variant-caps: normal; font-stretch: normal; font-size: 10px; line-height: normal; font-family: Times; font-size-adjust: none; font-kerning: auto; font-variant-alternates: normal; font-variant-ligatures: normal; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-position: normal; font-variant-emoji: normal; font-feature-settings: normal; font-optical-sizing: auto; font-variation-settings: normal;\">- 20% advance against order confirmation.&nbsp;</p>\r\n<p style=\"margin-bottom: 0px; font-style: normal; font-variant-caps: normal; font-stretch: normal; font-size: 10px; line-height: normal; font-family: Times; font-size-adjust: none; font-kerning: auto; font-variant-alternates: normal; font-variant-ligatures: normal; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-position: normal; font-variant-emoji: normal; font-feature-settings: normal; font-optical-sizing: auto; font-variation-settings: normal;\">- 50% against material delivery to site.&nbsp;</p>\r\n<p style=\"margin-bottom: 0px; font-style: normal; font-variant-caps: normal; font-stretch: normal; font-size: 10px; line-height: normal; font-family: Times; font-size-adjust: none; font-kerning: auto; font-variant-alternates: normal; font-variant-ligatures: normal; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-position: normal; font-variant-emoji: normal; font-feature-settings: normal; font-optical-sizing: auto; font-variation-settings: normal;\">- 20% upon installation, testing and commissioning.&nbsp;</p>\r\n<p style=\"margin-bottom: 0px; font-style: normal; font-variant-caps: normal; font-stretch: normal; font-size: 10px; line-height: normal; font-family: Times; font-size-adjust: none; font-kerning: auto; font-variant-alternates: normal; font-variant-ligatures: normal; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-position: normal; font-variant-emoji: normal; font-feature-settings: normal; font-optical-sizing: auto; font-variation-settings: normal;\">- 10% upon successful completion and hand-over.&nbsp;</p>\r\n<p style=\"margin-bottom: 0px; font-style: normal; font-variant-caps: normal; font-stretch: normal; font-size: 10px; line-height: normal; font-family: Times; font-size-adjust: none; font-kerning: auto; font-variant-alternates: normal; font-variant-ligatures: normal; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-position: normal; font-variant-emoji: normal; font-feature-settings: normal; font-optical-sizing: auto; font-variation-settings: normal;\"><b>5- Warranty:&nbsp;</b></p>\r\n<p style=\"margin-bottom: 0px; font-style: normal; font-variant-caps: normal; font-stretch: normal; font-size: 10px; line-height: normal; font-family: Times; font-size-adjust: none; font-kerning: auto; font-variant-alternates: normal; font-variant-ligatures: normal; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-position: normal; font-variant-emoji: normal; font-feature-settings: normal; font-optical-sizing: auto; font-variation-settings: normal;\">The sole manufacturer warranty against manufacturing defects only.&nbsp;</p>\r\n<p style=\"margin-bottom: 0px; font-style: normal; font-variant-caps: normal; font-stretch: normal; font-size: 10px; line-height: normal; font-family: Times; font-size-adjust: none; font-kerning: auto; font-variant-alternates: normal; font-variant-ligatures: normal; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-position: normal; font-variant-emoji: normal; font-feature-settings: normal; font-optical-sizing: auto; font-variation-settings: normal;\"><b>6- Delivery:&nbsp;</b></p>\r\n<p style=\"margin-bottom: 0px; font-style: normal; font-variant-caps: normal; font-stretch: normal; font-size: 10px; line-height: normal; font-family: Times; font-size-adjust: none; font-kerning: auto; font-variant-alternates: normal; font-variant-ligatures: normal; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-position: normal; font-variant-emoji: normal; font-feature-settings: normal; font-optical-sizing: auto; font-variation-settings: normal;\">As per project timeline schedule.&nbsp;</p>\r\n<p style=\"margin-bottom: 0px; font-style: normal; font-variant-caps: normal; font-stretch: normal; font-size: 10px; line-height: normal; font-family: Times; font-size-adjust: none; font-kerning: auto; font-variant-alternates: normal; font-variant-ligatures: normal; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-position: normal; font-variant-emoji: normal; font-feature-settings: normal; font-optical-sizing: auto; font-variation-settings: normal;\"><b>7-&nbsp;</b>All approvals and site access, scaffolding for VT to complete its scope of work is the client’s responsibility.&nbsp;</p>\r\n<p style=\"margin-bottom: 0px; font-style: normal; font-variant-caps: normal; font-stretch: normal; font-size: 10px; line-height: normal; font-family: Times; font-size-adjust: none; font-kerning: auto; font-variant-alternates: normal; font-variant-ligatures: normal; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-position: normal; font-variant-emoji: normal; font-feature-settings: normal; font-optical-sizing: auto; font-variation-settings: normal;\"><b>8-&nbsp;</b>Power and data end points at the screen’s location are the client’s or main contractor’s responsibility; if&nbsp;</p>\r\n<p style=\"margin-bottom: 0px; font-style: normal; font-variant-caps: normal; font-stretch: normal; font-size: 10px; line-height: normal; font-family: Times; font-size-adjust: none; font-kerning: auto; font-variant-alternates: normal; font-variant-ligatures: normal; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-position: normal; font-variant-emoji: normal; font-feature-settings: normal; font-optical-sizing: auto; font-variation-settings: normal;\">required can be quoted separately.&nbsp;</p>\r\n<p style=\"margin-bottom: 0px; font-style: normal; font-variant-caps: normal; font-stretch: normal; font-size: 10px; line-height: normal; font-family: Times; font-size-adjust: none; font-kerning: auto; font-variant-alternates: normal; font-variant-ligatures: normal; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-position: normal; font-variant-emoji: normal; font-feature-settings: normal; font-optical-sizing: auto; font-variation-settings: normal;\"><b>9-&nbsp;</b>If PO is issued it cannot be revoked for any reason. Advance payments are not reimbursed.&nbsp;</p>\r\n<p style=\"margin-bottom: 0px; font-style: normal; font-variant-caps: normal; font-stretch: normal; font-size: 10px; line-height: normal; font-family: Times; font-size-adjust: none; font-kerning: auto; font-variant-alternates: normal; font-variant-ligatures: normal; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-position: normal; font-variant-emoji: normal; font-feature-settings: normal; font-optical-sizing: auto; font-variation-settings: normal;\"><b>10-&nbsp;</b>The above prices are applicable to the above package offer. Individual items are priced differently.&nbsp;</p>\r\n<p style=\"margin-bottom: 0px; font-style: normal; font-variant-caps: normal; font-stretch: normal; font-size: 10px; line-height: normal; font-family: Times; font-size-adjust: none; font-kerning: auto; font-variant-alternates: normal; font-variant-ligatures: normal; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-position: normal; font-variant-emoji: normal; font-feature-settings: normal; font-optical-sizing: auto; font-variation-settings: normal;\">Errors and omissions are excluded.&nbsp;</p>', '0', 'Q000001', 1, 0, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-11-12', NULL, 0, '2024-08-24'),
(2, '2024-08-15 23:40', 40, 0, '', NULL, '2024-08-15 23:45:12', 40, 0, 2, 2, 'Nevin Manoj', '30', '2024-08-15', 'Supply, Installation, Testing and Commissioning of Stock Inventory System ', '<b><span style=\"font-size:11.0pt;font-family:&quot;Calibri&quot;,sans-serif;\r\nmso-ascii-theme-font:minor-latin;mso-fareast-font-family:&quot;Times New Roman&quot;;\r\nmso-hansi-theme-font:minor-latin;mso-bidi-theme-font:minor-latin;mso-ansi-language:\r\nEN-GB;mso-fareast-language:EN-US;mso-bidi-language:AR-SA\">1-</span></b><span style=\"font-size:11.0pt;font-family:&quot;Calibri&quot;,sans-serif;mso-ascii-theme-font:\r\nminor-latin;mso-fareast-font-family:&quot;Times New Roman&quot;;mso-hansi-theme-font:\r\nminor-latin;mso-bidi-theme-font:minor-latin;mso-ansi-language:EN-GB;mso-fareast-language:\r\nEN-US;mso-bidi-language:AR-SA\"> <b>Payment: </b>100% advance upon approval.<br>\r\n<b>2-</b> <b>Delivery: </b>TBD.<br>\r\n<b>3- </b>All approvals and site access\r\nfor Ventum to complete its scope of work is the client’s responsibility.<br>\r\n<b>4- </b>If PO is issued it cannot be revoked for any reason. Advance payments\r\nare not reimbursable. <br>\r\n<b>5- </b>The above prices are applicable to the above package offer.\r\nIndividual items are priced differently. Errors and omissions are excluded.</span>', '0', 'Q000002', 1, 0, 0, NULL, NULL, NULL, NULL, '0', 0, NULL, '2024-08-15', NULL, 0, '2024-08-15'),
(3, '2024-09-01 23:06', 36, 0, '', NULL, '', NULL, 0, 1, 1, '', '30', '2024-09-01', '', '', '0', 'Q000003', 1, 0, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-12-11', NULL, 0, '2024-09-01'),
(4, '2024-09-01 23:06', 36, 0, '', NULL, '', NULL, 0, 1, 1, 'vsfdbvs', '30', '2024-09-01', '', 'vdsfvsfdbv&nbsp;', '0', 'Q000004', 1, 0, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-09-01', NULL, 0, '2024-09-01');

-- --------------------------------------------------------

--
-- Table structure for table `quotations_items`
--

CREATE TABLE `quotations_items` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `quotation_id` int(11) DEFAULT 0,
  `project_id` int(11) DEFAULT NULL,
  `item_code` varchar(100) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `supplier` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `quotation_location_id` int(11) DEFAULT NULL,
  `unit_cost` varchar(25) DEFAULT NULL,
  `discount_percentage` int(11) DEFAULT 0,
  `landed_cost_rate_id` int(11) DEFAULT NULL,
  `is_manpower` int(11) DEFAULT 0,
  `is_local` int(11) DEFAULT 0,
  `margin` varchar(25) DEFAULT NULL,
  `inventory_id` int(11) DEFAULT NULL,
  `edited_margin` int(11) DEFAULT 0,
  `other` int(11) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `inventory_quotation_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `quotations_landed_cost_rate`
--

CREATE TABLE `quotations_landed_cost_rate` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `landed_cost_rate` varchar(125) DEFAULT NULL,
  `conversion_factor` varchar(25) DEFAULT NULL,
  `freight_percent` varchar(25) DEFAULT NULL,
  `custom_percent` varchar(25) DEFAULT NULL,
  `landed_cost_factor` varchar(25) DEFAULT NULL,
  `currency_symbol` varchar(25) DEFAULT NULL,
  `local_purchase` int(11) DEFAULT 0,
  `quotation_id` int(11) DEFAULT NULL,
  `id_orig` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `quotations_landed_cost_rate`
--

INSERT INTO `quotations_landed_cost_rate` (`id`, `date_created`, `user_id`, `deleted`, `date_deleted`, `deleted_by`, `date_modified`, `modified_by`, `landed_cost_rate`, `conversion_factor`, `freight_percent`, `custom_percent`, `landed_cost_factor`, `currency_symbol`, `local_purchase`, `quotation_id`, `id_orig`) VALUES
(1, '', NULL, 0, '', NULL, '', NULL, 'EX-WORKS US', '3.64', '8', '5', '4.11320', '$', 0, 1, 1),
(2, '', NULL, 0, '', NULL, '', NULL, 'EX-WORKS EU-USD', '3.64', '8', '5', '4.11320', '$', 0, 1, 2),
(3, '', NULL, 0, '', NULL, '', NULL, 'EX-WORKS EU-EURO', '4.00', '8', '5', '4.52000', '€', 0, 1, 3),
(4, '', NULL, 0, '', NULL, '', NULL, 'EX-WORKS UK', '4.50', '8', '5', '5.08500', '£', 0, 1, 4),
(5, '', NULL, 0, '', NULL, '', NULL, 'EX-WORKS DUBAI-USD', '3.64', '8', '5', '4.11320', '$', 0, 1, 5),
(6, '', NULL, 0, '', NULL, '', NULL, 'EX-WORKS DUBAI', '1.00', '8', '5', '1.13000', 'AED', 0, 1, 6),
(7, '', NULL, 0, '', NULL, '', NULL, 'LOCAL PURCHASE', '1.00', '0', '0', '1.00000', 'QAR', 1, 1, 7),
(8, '', NULL, 0, '', NULL, '', NULL, 'DDP QATAR USD', '3.64', '0', '0', '3.64000', '$', 0, 1, 8),
(9, '', NULL, 0, '', NULL, '', NULL, 'DDP QATAR EURO', '4.00', '0', '0', '4.00000', '€', 0, 1, 9),
(10, '', NULL, 0, '', NULL, '', NULL, 'CNF QATAR AIRPORT-USD', '3.64', '0', '5', '3.82200', '$', 0, 1, 10),
(11, '', NULL, 0, '', NULL, '', NULL, 'CNF QATAR AIRPORT-EURO', '4.00', '0', '5', '4.20000', '€', 0, 1, 11),
(12, '', NULL, 0, '', NULL, '', NULL, 'EX-WORKS US', '3.64', '8', '5', '4.11320', '$', 0, 2, 1),
(13, '', NULL, 0, '', NULL, '', NULL, 'EX-WORKS EU-USD', '3.64', '8', '5', '4.11320', '$', 0, 2, 2),
(14, '', NULL, 0, '', NULL, '', NULL, 'EX-WORKS EU-EURO', '4.00', '8', '5', '4.52000', '€', 0, 2, 3),
(15, '', NULL, 0, '', NULL, '', NULL, 'EX-WORKS UK', '4.50', '8', '5', '5.08500', '£', 0, 2, 4),
(16, '', NULL, 0, '', NULL, '', NULL, 'EX-WORKS DUBAI-USD', '3.64', '8', '5', '4.11320', '$', 0, 2, 5),
(17, '', NULL, 0, '', NULL, '', NULL, 'EX-WORKS DUBAI', '1.00', '8', '5', '1.13000', 'AED', 0, 2, 6),
(18, '', NULL, 0, '', NULL, '', NULL, 'LOCAL PURCHASE', '1.00', '0', '0', '1.00000', 'QAR', 1, 2, 7),
(19, '', NULL, 0, '', NULL, '', NULL, 'DDP QATAR USD', '3.64', '0', '0', '3.64000', '$', 0, 2, 8),
(20, '', NULL, 0, '', NULL, '', NULL, 'DDP QATAR EURO', '4.00', '0', '0', '4.00000', '€', 0, 2, 9),
(21, '', NULL, 0, '', NULL, '', NULL, 'CNF QATAR AIRPORT-USD', '3.64', '0', '5', '3.82200', '$', 0, 2, 10),
(22, '', NULL, 0, '', NULL, '', NULL, 'CNF QATAR AIRPORT-EURO', '4.00', '0', '5', '4.20000', '€', 0, 2, 11),
(23, '', NULL, 0, '', NULL, '', NULL, 'EX-WORKS US', '3.64', '8', '5', '4.11320', '$', 0, 3, 1),
(24, '', NULL, 0, '', NULL, '', NULL, 'EX-WORKS EU-USD', '3.64', '8', '5', '4.11320', '$', 0, 3, 2),
(25, '', NULL, 0, '', NULL, '', NULL, 'EX-WORKS EU-EURO', '4.00', '8', '5', '4.52000', '€', 0, 3, 3),
(26, '', NULL, 0, '', NULL, '', NULL, 'EX-WORKS UK', '4.50', '8', '5', '5.08500', '£', 0, 3, 4),
(27, '', NULL, 0, '', NULL, '', NULL, 'EX-WORKS DUBAI-USD', '3.64', '8', '5', '4.11320', '$', 0, 3, 5),
(28, '', NULL, 0, '', NULL, '', NULL, 'EX-WORKS DUBAI', '1.00', '8', '5', '1.13000', 'AED', 0, 3, 6),
(29, '', NULL, 0, '', NULL, '', NULL, 'LOCAL PURCHASE', '1.00', '0', '0', '1.00000', 'QAR', 1, 3, 7),
(30, '', NULL, 0, '', NULL, '', NULL, 'DDP QATAR USD', '3.64', '0', '0', '3.64000', '$', 0, 3, 8),
(31, '', NULL, 0, '', NULL, '', NULL, 'DDP QATAR EURO', '4.00', '0', '0', '4.00000', '€', 0, 3, 9),
(32, '', NULL, 0, '', NULL, '', NULL, 'CNF QATAR AIRPORT-USD', '3.64', '0', '5', '3.82200', '$', 0, 3, 10),
(33, '', NULL, 0, '', NULL, '', NULL, 'CNF QATAR AIRPORT-EURO', '4.00', '0', '5', '4.20000', '€', 0, 3, 11),
(34, '', NULL, 0, '', NULL, '', NULL, 'EX-WORKS US', '3.64', '8', '5', '4.11320', '$', 0, 4, 1),
(35, '', NULL, 0, '', NULL, '', NULL, 'EX-WORKS EU-USD', '3.64', '8', '5', '4.11320', '$', 0, 4, 2),
(36, '', NULL, 0, '', NULL, '', NULL, 'EX-WORKS EU-EURO', '4.00', '8', '5', '4.52000', '€', 0, 4, 3),
(37, '', NULL, 0, '', NULL, '', NULL, 'EX-WORKS UK', '4.50', '8', '5', '5.08500', '£', 0, 4, 4),
(38, '', NULL, 0, '', NULL, '', NULL, 'EX-WORKS DUBAI-USD', '3.64', '8', '5', '4.11320', '$', 0, 4, 5),
(39, '', NULL, 0, '', NULL, '', NULL, 'EX-WORKS DUBAI', '1.00', '8', '5', '1.13000', 'AED', 0, 4, 6),
(40, '', NULL, 0, '', NULL, '', NULL, 'LOCAL PURCHASE', '1.00', '0', '0', '1.00000', 'QAR', 1, 4, 7),
(41, '', NULL, 0, '', NULL, '', NULL, 'DDP QATAR USD', '3.64', '0', '0', '3.64000', '$', 0, 4, 8),
(42, '', NULL, 0, '', NULL, '', NULL, 'DDP QATAR EURO', '4.00', '0', '0', '4.00000', '€', 0, 4, 9),
(43, '', NULL, 0, '', NULL, '', NULL, 'CNF QATAR AIRPORT-USD', '3.64', '0', '5', '3.82200', '$', 0, 4, 10),
(44, '', NULL, 0, '', NULL, '', NULL, 'CNF QATAR AIRPORT-EURO', '4.00', '0', '5', '4.20000', '€', 0, 4, 11);

-- --------------------------------------------------------

--
-- Table structure for table `quotations_legalization_fees`
--

CREATE TABLE `quotations_legalization_fees` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `amount_from` varchar(225) DEFAULT NULL,
  `amount_to` varchar(125) DEFAULT NULL,
  `fees` varchar(125) DEFAULT NULL,
  `percent_of_invoice_val` int(11) DEFAULT 0,
  `quotation_id` int(11) DEFAULT NULL,
  `id_orig` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `quotations_legalization_fees`
--

INSERT INTO `quotations_legalization_fees` (`id`, `date_created`, `user_id`, `deleted`, `date_deleted`, `deleted_by`, `date_modified`, `modified_by`, `amount_from`, `amount_to`, `fees`, `percent_of_invoice_val`, `quotation_id`, `id_orig`) VALUES
(1, '', NULL, 0, '', NULL, '', NULL, '1', '15000', '920', 0, 1, 1),
(2, '', NULL, 0, '', NULL, '', NULL, '15000.01', '100000', '1420', 0, 1, 2),
(3, '', NULL, 0, '', NULL, '', NULL, '100000.01', '250000', '2920', 0, 1, 3),
(4, '', NULL, 0, '', NULL, '', NULL, '250000.01', '1000000', '5150', 0, 1, 4),
(5, '', NULL, 0, '', NULL, '', NULL, '1000000.01', '100000000', '0.006', 1, 1, 5),
(6, '2023-12-06 18:32:21', 2, 0, '', NULL, '', NULL, '250000.01', '1000000', '5150.11', 0, 1, 6),
(7, '2023-12-06 18:32:27', 2, 0, '', NULL, '', NULL, '250000.01', '1000000', '5150.00', 0, 1, 7),
(8, '', NULL, 0, '', NULL, '', NULL, '1', '15000', '920', 0, 2, 1),
(9, '', NULL, 0, '', NULL, '', NULL, '15000.01', '100000', '1420', 0, 2, 2),
(10, '', NULL, 0, '', NULL, '', NULL, '100000.01', '250000', '2920', 0, 2, 3),
(11, '', NULL, 0, '', NULL, '', NULL, '250000.01', '1000000', '5150', 0, 2, 4),
(12, '', NULL, 0, '', NULL, '', NULL, '1000000.01', '100000000', '0.006', 1, 2, 5),
(13, '2023-12-06 18:32:21', 2, 0, '', NULL, '', NULL, '250000.01', '1000000', '5150.11', 0, 2, 6),
(14, '2023-12-06 18:32:27', 2, 0, '', NULL, '', NULL, '250000.01', '1000000', '5150.00', 0, 2, 7),
(15, '', NULL, 0, '', NULL, '', NULL, '1', '15000', '920', 0, 3, 1),
(16, '', NULL, 0, '', NULL, '', NULL, '15000.01', '100000', '1420', 0, 3, 2),
(17, '', NULL, 0, '', NULL, '', NULL, '100000.01', '250000', '2920', 0, 3, 3),
(18, '', NULL, 0, '', NULL, '', NULL, '250000.01', '1000000', '5150', 0, 3, 4),
(19, '', NULL, 0, '', NULL, '', NULL, '1000000.01', '100000000', '0.006', 1, 3, 5),
(20, '2023-12-06 18:32:21', 2, 0, '', NULL, '', NULL, '250000.01', '1000000', '5150.11', 0, 3, 6),
(21, '2023-12-06 18:32:27', 2, 0, '', NULL, '', NULL, '250000.01', '1000000', '5150.00', 0, 3, 7),
(22, '', NULL, 0, '', NULL, '', NULL, '1', '15000', '920', 0, 4, 1),
(23, '', NULL, 0, '', NULL, '', NULL, '15000.01', '100000', '1420', 0, 4, 2),
(24, '', NULL, 0, '', NULL, '', NULL, '100000.01', '250000', '2920', 0, 4, 3),
(25, '', NULL, 0, '', NULL, '', NULL, '250000.01', '1000000', '5150', 0, 4, 4),
(26, '', NULL, 0, '', NULL, '', NULL, '1000000.01', '100000000', '0.006', 1, 4, 5),
(27, '2023-12-06 18:32:21', 2, 0, '', NULL, '', NULL, '250000.01', '1000000', '5150.11', 0, 4, 6),
(28, '2023-12-06 18:32:27', 2, 0, '', NULL, '', NULL, '250000.01', '1000000', '5150.00', 0, 4, 7);

-- --------------------------------------------------------

--
-- Table structure for table `quotations_locations`
--

CREATE TABLE `quotations_locations` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `quotation_id` int(11) DEFAULT 0,
  `project_id` int(11) DEFAULT NULL,
  `location_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `quotations_others`
--

CREATE TABLE `quotations_others` (
  `id` int(11) NOT NULL,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `amount` varchar(25) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_created` varchar(25) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `quotations_others`
--

INSERT INTO `quotations_others` (`id`, `title`, `ds`, `dc`, `user_id`, `deleted`, `amount`, `created_by`, `date_created`, `modified_by`, `date_modified`) VALUES
(1, 'Sub Contractor', 'Sub Contractor', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
(2, 'Tools', 'Tools', NULL, NULL, 0, '45', NULL, NULL, 2, '2024-05-11 16:01:45'),
(3, 'External Manpower', 'External Manpower', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
(4, 'Royalties', 'Royalties', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quotations_package`
--

CREATE TABLE `quotations_package` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `package_name` varchar(255) DEFAULT NULL,
  `quotation_id` int(11) DEFAULT NULL,
  `price` varchar(25) DEFAULT NULL,
  `quotation_location_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `quotations_package_items`
--

CREATE TABLE `quotations_package_items` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `quotation_items_id` int(11) DEFAULT NULL,
  `quotation_id` int(11) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `quotation_location_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `receiving`
--

CREATE TABLE `receiving` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `po_ids` varchar(200) DEFAULT NULL,
  `dr_number` varchar(50) DEFAULT NULL,
  `invoice_number` varchar(50) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `attachments` text DEFAULT NULL,
  `project_ids` varchar(200) DEFAULT NULL,
  `quotation_ids` varchar(200) DEFAULT NULL,
  `delivery_date` varchar(25) DEFAULT NULL,
  `invoice_date` varchar(25) DEFAULT NULL,
  `lc_factor` varchar(25) DEFAULT NULL,
  `exchange_rate` varchar(25) DEFAULT NULL,
  `confirmed` int(11) DEFAULT 0,
  `confirmed_date` varchar(25) DEFAULT NULL,
  `confirmed_by` int(11) DEFAULT NULL,
  `currency` varchar(15) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `grv_transport_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `receiving_fc`
--

CREATE TABLE `receiving_fc` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `fc_id` int(11) DEFAULT NULL,
  `amt` varchar(25) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `receiving_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `receiving_items`
--

CREATE TABLE `receiving_items` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `po_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `quotation_id` int(11) DEFAULT NULL,
  `receiving_id` int(11) DEFAULT NULL,
  `po_item_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `inventory_quotation_id` int(11) DEFAULT NULL,
  `inventory_id` int(11) DEFAULT NULL,
  `price` varchar(25) DEFAULT NULL,
  `qty_out` int(11) DEFAULT 0,
  `unit_cost_price` varchar(25) DEFAULT NULL,
  `bad_qty` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `receiving_lc`
--

CREATE TABLE `receiving_lc` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `lc_id` int(11) DEFAULT NULL,
  `amt` varchar(25) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `receiving_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `timezone` varchar(225) DEFAULT NULL,
  `currency` varchar(225) DEFAULT NULL,
  `language` varchar(225) DEFAULT NULL,
  `depriciation_cutoff` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `timezone`, `currency`, `language`, `depriciation_cutoff`) VALUES
(1, 'Asia/Manila', '8369;', '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `name` varchar(125) DEFAULT NULL,
  `contact_person_1` varchar(125) DEFAULT NULL,
  `contact_person_2` varchar(125) DEFAULT NULL,
  `contact_number_1` varchar(50) DEFAULT NULL,
  `contact_number_2` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `tin` varchar(50) DEFAULT NULL,
  `terms_and_conditions` text DEFAULT NULL,
  `shipping_notes` text DEFAULT NULL,
  `email` varchar(125) DEFAULT NULL,
  `po_attension_to` varchar(125) DEFAULT NULL,
  `fax_no` varchar(125) DEFAULT NULL,
  `landed_cost_rate_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `date_created`, `user_id`, `deleted`, `date_deleted`, `deleted_by`, `date_modified`, `modified_by`, `name`, `contact_person_1`, `contact_person_2`, `contact_number_1`, `contact_number_2`, `address`, `tin`, `terms_and_conditions`, `shipping_notes`, `email`, `po_attension_to`, `fax_no`, `landed_cost_rate_id`) VALUES
(1, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Pan-Acoustics', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(2, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'QSC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(3, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'K&M', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(4, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Soundcraft', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(5, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Shure', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(6, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Denon', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(7, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Custom', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(8, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Peerless AV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(9, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Daktronics', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(10, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'TP-LINK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(11, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Lightware', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(12, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'LYNX TECHNIK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(13, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Mersive', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(14, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Logitech', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(15, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Aver', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(16, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Black Magic', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(17, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Luminex', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(18, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Apple', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(19, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'SDS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3),
(20, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Chamsys', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(21, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'PC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(22, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Chauvet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(23, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Middle Atlantic', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(24, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Canare', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(25, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Brightsign', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(26, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'LG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(27, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'ClearCom', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(28, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'ENTTEC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(29, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'LogicAV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(30, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Dell', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(31, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Olson', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(32, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Barco', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(33, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Sonifex', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(34, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Genelec', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(35, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Arista', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(36, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Audinate', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(37, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Lindy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(38, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'AppSpace', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8),
(39, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'TASCAM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(40, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'TOA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(41, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Autonomic', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(42, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'William AV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(43, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'SwimPro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(44, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Colorado Time Systems', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(45, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'L-Acoustics', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(46, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'AVFI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(47, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Epson', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(48, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Da-Lite', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(49, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Roland', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(50, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Gefen', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(51, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Ayrton', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(52, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Eurotruss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(53, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Chain Master', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(54, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'Percon', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(55, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'VDC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(56, '2023-12-05 19:17', 2, 0, '', NULL, '', NULL, 'CBT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, '2024-05-12 19:16', 2, 0, '', NULL, '', NULL, 'new', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58, '2024-05-12 19:17', 2, 0, '', NULL, '', NULL, 'new', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59, '2024-05-12 19:37', 2, 0, '', NULL, '', NULL, 'Supplier AAA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers_po`
--

CREATE TABLE `suppliers_po` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `name` varchar(125) DEFAULT NULL,
  `contact_person_1` varchar(125) DEFAULT NULL,
  `contact_person_2` varchar(125) DEFAULT NULL,
  `contact_number_1` varchar(50) DEFAULT NULL,
  `contact_number_2` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `tin` varchar(50) DEFAULT NULL,
  `terms_and_conditions` text DEFAULT NULL,
  `shipping_notes` text DEFAULT NULL,
  `email` varchar(125) DEFAULT NULL,
  `po_attension_to` varchar(125) DEFAULT NULL,
  `fax_no` varchar(125) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `suppliers_po`
--

INSERT INTO `suppliers_po` (`id`, `date_created`, `user_id`, `deleted`, `date_deleted`, `deleted_by`, `date_modified`, `modified_by`, `name`, `contact_person_1`, `contact_person_2`, `contact_number_1`, `contact_number_2`, `address`, `tin`, `terms_and_conditions`, `shipping_notes`, `email`, `po_attension_to`, `fax_no`) VALUES
(1, '2023-12-05 20:50:51', 2, 0, '', NULL, '', NULL, 'Supplier Test 1', '', '', '', '', '', NULL, NULL, NULL, 'apple@gmail.com', 'Mohammad Saleh', ''),
(2, '2023-12-05 20:52:01', 2, 0, '', NULL, '', NULL, 'Supplier Test 2', '', '', '', '', '', NULL, NULL, NULL, 'laccoustics@mail.com', 'Mohhamad Fali', '');

-- --------------------------------------------------------

--
-- Table structure for table `terms_and_conditions`
--

CREATE TABLE `terms_and_conditions` (
  `id` int(11) NOT NULL,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `type` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `terms_and_conditions`
--

INSERT INTO `terms_and_conditions` (`id`, `date_created`, `user_id`, `deleted`, `date_deleted`, `deleted_by`, `date_modified`, `modified_by`, `description`, `title`, `type`) VALUES
(1, '2023-09-13', 2, 0, '', NULL, '2023-09-13', 2, '<div><font color=\"#2697de\"><span style=\"font-weight: 700;\">Terms and Conditions: </span></font></div><div><span style=\"font-weight: 700;\"><font color=\"#2697de\">1-</font></span> Supply, Delivery, Installation, Testing and Commission of the above AV system.</div><div><font color=\"#2697de\">2- </font>The above design is based on the provided layout drawing, BoQ, and specification.</div><div><font color=\"#2697de\"><span style=\"font-weight: 700;\">3- </span></font>Civil, structural works, conduits and cable pulling not mentioned on the quotes are excluded.</div><div><font color=\"#2697de\">5- </font>Any Changes in the mentioned quantity will be considered as a variation </div><div><font color=\"#2697de\"><span style=\"font-weight: 700;\">6- Payment: - </span></font>50% advance against order confirmation.</div><div>- 40% against material delivery to site.</div><div>- 10% immediately after completion. </div><div><font color=\"#2697de\"><span style=\"font-weight: 700;\">7-</span></font> Warranty: The sole warranty for the supplied material is the original equipment manufacturer warranty against manufacturing defects only. </div><div><span style=\"font-weight: 700;\"><font color=\"#2697de\">8-</font></span> Delivery: TBA as per project schedule. </div><div><span style=\"font-weight: 700;\"><font color=\"#2697de\">9-</font></span> All approvals and site access, scaffolding for Ventum to complete its scope of work is the client’s responsibility. </div><div><span style=\"font-weight: 700;\"><font color=\"#2697de\">10-</font></span> If PO is issued it cannot be revoked for any reason. Advance payments are not reimbursed. Ventum is not responsible for any delay that may occur due to material shortage or shipping equipment or no space availability.</div><div>12- The above prices are applicable to the above package offer. Individual items are priced differently. Errors and omissions are excluded.</div>', 'template 1', 'quotation'),
(2, '2023-09-13', 2, 0, '', NULL, '2023-09-13', 2, '<div><font color=\"#2697de\"><b>Terms and Conditions: </b></font></div><div><b><font color=\"#2697de\">1-</font></b> Supply, Delivery, Installation, Testing and Commission of the above AV system.</div><div><font color=\"#2697de\">2- </font>The above design is based on the provided layout drawing, BoQ, and specification.</div><div><font color=\"#2697de\"><b>3- </b></font>Civil, structural works, conduits and cable pulling not mentioned on the quotes are excluded.</div><div><font color=\"#2697de\">5- </font>Any Changes in the mentioned quantity will be considered as a variation </div><div><font color=\"#2697de\"><b>6- Payment: - </b></font>50% advance against order confirmation.</div><div>- 40% against material delivery to site.</div><div>- 10% immediately after completion. </div><div><font color=\"#2697de\"><b>7-</b></font> Warranty: The sole warranty for the supplied material is the original equipment manufacturer warranty against manufacturing defects only. <b><font color=\"#2697de\">8-</font></b> Delivery: TBA as per project schedule. </div><div><font color=\"#2697de\"><b> </b></font></div>', 'template 2', 'quotation'),
(3, '2023-09-13', 2, 0, '', NULL, '2023-09-13', 2, '<div><font color=\"#2697de\"><span style=\"font-weight: 700;\">Terms and Conditions: </span></font></div><div><span style=\"font-weight: 700;\"><font color=\"#2697de\">1-</font></span> Supply, Delivery, Installation, Testing and Commission of the above AV system.</div><div><font color=\"#2697de\">2- </font>The above design is based on the provided layout drawing, BoQ, and specification.</div><div><font color=\"#2697de\"><span style=\"font-weight: 700;\">3- </span></font>Civil, structural works, conduits and cable pulling not mentioned on the quotes are excluded.</div><div><font color=\"#2697de\"> </font></div>', 'template 3', 'quotation'),
(4, '2023-09-17', 2, 0, '', NULL, '2023-09-20', 2, '<font color=\"#2697de\">T<b>erms &amp; Conditions:&nbsp;</b></font><div>1- Invoices to be issued in the name of Ventum Tech Security Systems and Services.&nbsp;</div><div>2- Payment Terms: As per agreement&nbsp;</div><div>3- Delivery: Immediate&nbsp;</div><div>4- If no PO confirmation nor comments/remarks are received within 2 working days from official PO transmittal date, this PO including all its content is considered in effect.&nbsp;</div><div>5- Ventum Tech is not held responsible in any way for not accepting the goods or services described above if it proves to be not conforming to the agreement and specifications or late delivery.</div>', 'Template 1', 'po'),
(5, '2023-09-17', 2, 0, '', NULL, '2023-09-20', 2, '<b><font color=\"#2697de\">Terms &amp; Conditions:&nbsp;</font></b><div><font color=\"#2697de\">1- </font>Invoices to be issued in the name of Ventum Tech Security Systems and Services.&nbsp;</div><div><font color=\"#2697de\">2-</font> Payment Terms: As per agreement&nbsp;</div><div><font color=\"#2697de\">3-</font> Delivery: Immediate&nbsp;</div><div><font color=\"#2697de\">4-</font> If no PO confirmation nor comments/remarks are received within 2 working days from official PO transmittal date, this PO including all its content is considered in effect.&nbsp;&nbsp;</div>', 'Template 2', 'po');

-- --------------------------------------------------------

--
-- Table structure for table `theme`
--

CREATE TABLE `theme` (
  `id` int(11) NOT NULL,
  `bullets_bg` varchar(25) DEFAULT NULL,
  `logo_bg` varchar(25) DEFAULT NULL,
  `side_menu_1` varchar(25) DEFAULT NULL,
  `side_menu_2` varchar(25) DEFAULT NULL,
  `active_menu_1` varchar(25) DEFAULT NULL,
  `active_menu_2` varchar(25) DEFAULT NULL,
  `active_sub_menu_1` varchar(25) DEFAULT NULL,
  `active_sub_menu_2` varchar(25) DEFAULT NULL,
  `footer_bg` varchar(25) DEFAULT NULL,
  `primary_btn` varchar(25) DEFAULT NULL,
  `primary_border_btn` varchar(25) DEFAULT NULL,
  `success_btn` varchar(25) DEFAULT NULL,
  `success_border_btn` varchar(25) DEFAULT NULL,
  `warning_btn` varchar(25) DEFAULT NULL,
  `warning_border_btn` varchar(25) DEFAULT NULL,
  `danger_btn` varchar(25) DEFAULT NULL,
  `danger_border_btn` varchar(25) DEFAULT NULL,
  `info_btn` varchar(25) DEFAULT NULL,
  `info_border_btn` varchar(25) DEFAULT NULL,
  `side_bar_drawer` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `theme`
--

INSERT INTO `theme` (`id`, `bullets_bg`, `logo_bg`, `side_menu_1`, `side_menu_2`, `active_menu_1`, `active_menu_2`, `active_sub_menu_1`, `active_sub_menu_2`, `footer_bg`, `primary_btn`, `primary_border_btn`, `success_btn`, `success_border_btn`, `warning_btn`, `warning_border_btn`, `danger_btn`, `danger_border_btn`, `info_btn`, `info_border_btn`, `side_bar_drawer`) VALUES
(1, '#0a1285', '#05057a', '#0e2581', '#05316b', '#254aa2', '#1a6dad', '#3b83b0', '#133d90', '#3f99de', '#699bdd', '#94a8e5', '#48a4f9', '#8d92aa', '#dfaf49', '#d2c46a', '#ea4d4d', '#990f0f', '#85c7f9', '#47bad7', 'sm');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sub_menu_id` int(11) NOT NULL,
  `main_menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `user_id`, `sub_menu_id`, `main_menu_id`) VALUES
(494, 10, 7, 3),
(495, 10, 43, 4),
(496, 10, 53, 3),
(497, 10, 54, 3),
(498, 10, 77, 3),
(499, 10, 79, 3),
(500, 10, 88, 5),
(501, 10, 100, 5),
(502, 11, 6, 2),
(503, 11, 7, 3),
(504, 11, 8, 1),
(505, 11, 14, 6),
(506, 11, 24, 2),
(507, 11, 43, 4),
(508, 11, 44, 4),
(509, 11, 45, 1),
(510, 11, 50, 11),
(511, 11, 52, 11),
(512, 11, 53, 3),
(513, 11, 54, 3),
(514, 11, 56, 6),
(515, 11, 57, 11),
(516, 11, 60, 2),
(517, 11, 61, 2),
(518, 11, 62, 2),
(519, 11, 63, 2),
(520, 11, 64, 2),
(521, 11, 66, 12),
(522, 11, 67, 12),
(523, 11, 68, 11),
(524, 11, 69, 13),
(525, 11, 70, 1),
(526, 11, 71, 2),
(527, 11, 72, 2),
(528, 11, 73, 2),
(529, 11, 74, 2),
(530, 11, 75, 2),
(531, 11, 77, 3),
(532, 11, 78, 2),
(533, 11, 79, 3),
(534, 11, 80, 2),
(535, 11, 81, 2),
(536, 11, 83, 1),
(537, 11, 84, 5),
(538, 11, 85, 2),
(539, 11, 86, 13),
(540, 11, 87, 13),
(541, 11, 88, 5),
(542, 11, 89, 14),
(543, 11, 90, 14),
(544, 11, 91, 2),
(545, 11, 92, 11),
(546, 11, 93, 6),
(547, 11, 94, 11),
(548, 11, 95, 13),
(549, 11, 96, 5),
(550, 11, 97, 2),
(551, 11, 98, 11),
(552, 11, 99, 2),
(553, 11, 100, 5),
(554, 12, 6, 2),
(555, 12, 7, 3),
(556, 12, 8, 1),
(557, 12, 14, 6),
(558, 12, 24, 2),
(559, 12, 43, 4),
(560, 12, 44, 4),
(561, 12, 45, 1),
(562, 12, 50, 11),
(563, 12, 52, 11),
(564, 12, 53, 3),
(565, 12, 54, 3),
(566, 12, 56, 6),
(567, 12, 57, 11),
(568, 12, 60, 2),
(569, 12, 61, 2),
(570, 12, 62, 2),
(571, 12, 63, 2),
(572, 12, 64, 2),
(573, 12, 66, 12),
(574, 12, 67, 12),
(575, 12, 68, 11),
(576, 12, 69, 13),
(577, 12, 70, 1),
(578, 12, 71, 2),
(579, 12, 72, 2),
(580, 12, 73, 2),
(581, 12, 74, 2),
(582, 12, 75, 2),
(583, 12, 77, 3),
(584, 12, 78, 2),
(585, 12, 79, 3),
(586, 12, 80, 2),
(587, 12, 81, 2),
(588, 12, 83, 1),
(589, 12, 84, 5),
(590, 12, 85, 2),
(591, 12, 86, 13),
(592, 12, 87, 13),
(593, 12, 88, 5),
(594, 12, 89, 14),
(595, 12, 90, 14),
(596, 12, 91, 2),
(597, 12, 92, 11),
(598, 12, 93, 6),
(599, 12, 94, 11),
(600, 12, 95, 13),
(601, 12, 96, 5),
(602, 12, 97, 2),
(603, 12, 98, 11),
(604, 12, 99, 2),
(605, 12, 100, 5),
(606, 13, 6, 2),
(607, 13, 7, 3),
(608, 13, 14, 6),
(609, 13, 24, 2),
(610, 13, 53, 3),
(611, 13, 54, 3),
(612, 13, 56, 6),
(613, 13, 60, 2),
(614, 13, 61, 2),
(615, 13, 62, 2),
(616, 13, 63, 2),
(617, 13, 64, 2),
(618, 13, 69, 13),
(619, 13, 71, 2),
(620, 13, 72, 2),
(621, 13, 73, 2),
(622, 13, 74, 2),
(623, 13, 75, 2),
(624, 13, 77, 3),
(625, 13, 78, 2),
(626, 13, 79, 3),
(627, 13, 80, 2),
(628, 13, 81, 2),
(629, 13, 85, 2),
(630, 13, 86, 13),
(631, 13, 87, 13),
(632, 13, 91, 2),
(633, 13, 93, 6),
(634, 13, 97, 2),
(635, 13, 99, 2),
(636, 14, 69, 13),
(637, 14, 89, 14),
(638, 14, 90, 14),
(639, 15, 69, 13),
(640, 15, 89, 14),
(641, 15, 90, 14),
(642, 16, 43, 4),
(643, 16, 44, 4),
(644, 17, 43, 4),
(645, 17, 44, 4),
(646, 18, 43, 4),
(647, 18, 44, 4),
(648, 19, 43, 4),
(649, 19, 44, 4),
(650, 20, 43, 4),
(651, 20, 44, 4),
(652, 21, 86, 13),
(653, 21, 87, 13),
(654, 22, 86, 13),
(655, 22, 87, 13),
(656, 23, 14, 6),
(657, 23, 56, 6),
(658, 23, 66, 12),
(659, 23, 67, 12),
(660, 23, 93, 6),
(661, 24, 14, 6),
(662, 24, 56, 6),
(663, 24, 66, 12),
(664, 24, 67, 12),
(665, 24, 93, 6),
(666, 25, 14, 6),
(667, 25, 56, 6),
(668, 25, 66, 12),
(669, 25, 67, 12),
(670, 25, 93, 6),
(671, 26, 6, 2),
(672, 26, 7, 3),
(673, 26, 8, 1),
(674, 26, 14, 6),
(675, 26, 24, 2),
(676, 26, 43, 4),
(677, 26, 44, 4),
(678, 26, 45, 1),
(679, 26, 50, 11),
(680, 26, 52, 11),
(681, 26, 53, 3),
(682, 26, 54, 3),
(683, 26, 56, 6),
(684, 26, 57, 11),
(685, 26, 60, 2),
(686, 26, 61, 2),
(687, 26, 62, 2),
(688, 26, 63, 2),
(689, 26, 64, 2),
(690, 26, 66, 12),
(691, 26, 67, 12),
(692, 26, 68, 11),
(693, 26, 69, 13),
(694, 26, 70, 1),
(695, 26, 71, 2),
(696, 26, 72, 2),
(697, 26, 73, 2),
(698, 26, 74, 2),
(699, 26, 75, 2),
(700, 26, 77, 3),
(701, 26, 78, 2),
(702, 26, 79, 3),
(703, 26, 80, 2),
(704, 26, 81, 2),
(705, 26, 83, 1),
(706, 26, 84, 5),
(707, 26, 85, 2),
(708, 26, 86, 13),
(709, 26, 87, 13),
(710, 26, 88, 5),
(711, 26, 89, 14),
(712, 26, 90, 14),
(713, 26, 91, 2),
(714, 26, 92, 11),
(715, 26, 93, 6),
(716, 26, 94, 11),
(717, 26, 95, 13),
(718, 26, 96, 5),
(719, 26, 97, 2),
(720, 26, 98, 11),
(721, 26, 99, 2),
(722, 26, 100, 5),
(1747, 28, 105, 3),
(1748, 28, 106, 3),
(1749, 28, 107, 3),
(1750, 28, 119, 19),
(1751, 28, 122, 3),
(1752, 28, 123, 3),
(1795, 30, 54, 14),
(1796, 30, 89, 17),
(1797, 30, 102, 14),
(1798, 30, 103, 14),
(1799, 30, 104, 14),
(1800, 30, 120, 14),
(1801, 30, 121, 14),
(1802, 30, 125, 14),
(1803, 30, 134, 20),
(1804, 30, 135, 20),
(1805, 30, 136, 20),
(1806, 30, 139, 17),
(1807, 30, 140, 17),
(1825, 32, 50, 11),
(1826, 32, 105, 3),
(1827, 32, 106, 3),
(1828, 32, 107, 3),
(1829, 32, 122, 3),
(1830, 32, 123, 3),
(1831, 33, 54, 14),
(1832, 33, 89, 17),
(1833, 33, 90, 14),
(1834, 33, 101, 14),
(1835, 33, 102, 14),
(1836, 33, 103, 14),
(1837, 33, 104, 14),
(1838, 33, 119, 19),
(1839, 33, 120, 14),
(1840, 33, 121, 14),
(1841, 33, 124, 19),
(1842, 33, 125, 14),
(1843, 33, 126, 19),
(1844, 33, 139, 17),
(1845, 33, 140, 17),
(1865, 31, 50, 11),
(1866, 31, 108, 16),
(1867, 31, 109, 16),
(1868, 31, 110, 18),
(1869, 31, 111, 18),
(1870, 31, 114, 16),
(1871, 31, 115, 16),
(1872, 31, 116, 16),
(1873, 31, 117, 16),
(1874, 31, 118, 18),
(1875, 31, 127, 21),
(1876, 31, 128, 21),
(1877, 31, 129, 21),
(1878, 31, 130, 21),
(1879, 31, 131, 11),
(1880, 31, 132, 11),
(1881, 31, 133, 11),
(1882, 2, 8, 1),
(1883, 2, 50, 11),
(1884, 2, 54, 14),
(1885, 2, 83, 1),
(1886, 2, 89, 17),
(1887, 2, 90, 14),
(1888, 2, 101, 14),
(1889, 2, 102, 14),
(1890, 2, 103, 14),
(1891, 2, 104, 14),
(1892, 2, 105, 3),
(1893, 2, 106, 3),
(1894, 2, 107, 3),
(1895, 2, 108, 16),
(1896, 2, 109, 16),
(1897, 2, 110, 18),
(1898, 2, 111, 18),
(1899, 2, 114, 16),
(1900, 2, 115, 16),
(1901, 2, 116, 16),
(1902, 2, 117, 16),
(1903, 2, 118, 18),
(1904, 2, 119, 19),
(1905, 2, 120, 14),
(1906, 2, 121, 14),
(1907, 2, 122, 3),
(1908, 2, 123, 3),
(1909, 2, 124, 19),
(1910, 2, 125, 14),
(1911, 2, 126, 19),
(1912, 2, 127, 21),
(1913, 2, 128, 21),
(1914, 2, 129, 21),
(1915, 2, 130, 21),
(1916, 2, 131, 11),
(1917, 2, 132, 11),
(1918, 2, 133, 11),
(1919, 2, 134, 20),
(1920, 2, 135, 20),
(1921, 2, 136, 20),
(1922, 2, 139, 17),
(1923, 2, 140, 17),
(1924, 2, 141, 16),
(2011, 29, 8, 1),
(2012, 29, 45, 1),
(2013, 29, 50, 11),
(2014, 29, 54, 14),
(2015, 29, 83, 1),
(2016, 29, 89, 17),
(2017, 29, 90, 14),
(2018, 29, 101, 14),
(2019, 29, 102, 14),
(2020, 29, 103, 14),
(2021, 29, 104, 14),
(2022, 29, 105, 3),
(2023, 29, 106, 3),
(2024, 29, 107, 3),
(2025, 29, 108, 16),
(2026, 29, 109, 16),
(2027, 29, 110, 18),
(2028, 29, 111, 18),
(2029, 29, 114, 16),
(2030, 29, 115, 16),
(2031, 29, 116, 16),
(2032, 29, 117, 16),
(2033, 29, 118, 18),
(2034, 29, 119, 19),
(2035, 29, 120, 14),
(2036, 29, 121, 14),
(2037, 29, 122, 3),
(2038, 29, 123, 3),
(2039, 29, 124, 19),
(2040, 29, 125, 14),
(2041, 29, 126, 19),
(2042, 29, 127, 21),
(2043, 29, 128, 21),
(2044, 29, 129, 21),
(2045, 29, 130, 21),
(2046, 29, 131, 11),
(2047, 29, 132, 11),
(2048, 29, 133, 11),
(2049, 29, 134, 20),
(2050, 29, 135, 20),
(2051, 29, 136, 20),
(2052, 29, 139, 17),
(2053, 29, 140, 17),
(2054, 35, 8, 1),
(2055, 35, 45, 1),
(2056, 35, 50, 11),
(2057, 35, 54, 14),
(2058, 35, 83, 1),
(2059, 35, 89, 17),
(2060, 35, 90, 14),
(2061, 35, 101, 14),
(2062, 35, 102, 14),
(2063, 35, 103, 14),
(2064, 35, 104, 14),
(2065, 35, 105, 3),
(2066, 35, 106, 3),
(2067, 35, 107, 3),
(2068, 35, 108, 16),
(2069, 35, 109, 16),
(2070, 35, 110, 18),
(2071, 35, 111, 18),
(2072, 35, 114, 16),
(2073, 35, 115, 16),
(2074, 35, 116, 16),
(2075, 35, 117, 16),
(2076, 35, 118, 18),
(2077, 35, 119, 19),
(2078, 35, 120, 14),
(2079, 35, 121, 14),
(2080, 35, 122, 3),
(2081, 35, 123, 3),
(2082, 35, 124, 19),
(2083, 35, 125, 14),
(2084, 35, 126, 19),
(2085, 35, 127, 21),
(2086, 35, 128, 21),
(2087, 35, 129, 21),
(2088, 35, 130, 21),
(2089, 35, 131, 11),
(2090, 35, 132, 11),
(2091, 35, 133, 11),
(2092, 35, 134, 20),
(2093, 35, 135, 20),
(2094, 35, 136, 20),
(2095, 35, 139, 17),
(2096, 35, 140, 17),
(2097, 35, 141, 16),
(2142, 37, 8, 1),
(2143, 37, 45, 1),
(2144, 37, 50, 11),
(2145, 37, 54, 14),
(2146, 37, 83, 1),
(2147, 37, 89, 17),
(2148, 37, 90, 14),
(2149, 37, 101, 14),
(2150, 37, 102, 14),
(2151, 37, 103, 14),
(2152, 37, 104, 14),
(2153, 37, 105, 3),
(2154, 37, 106, 3),
(2155, 37, 107, 3),
(2156, 37, 108, 16),
(2157, 37, 109, 16),
(2158, 37, 110, 18),
(2159, 37, 111, 18),
(2160, 37, 114, 16),
(2161, 37, 115, 16),
(2162, 37, 116, 16),
(2163, 37, 117, 16),
(2164, 37, 118, 18),
(2165, 37, 119, 19),
(2166, 37, 120, 14),
(2167, 37, 121, 14),
(2168, 37, 122, 3),
(2169, 37, 123, 3),
(2170, 37, 124, 19),
(2171, 37, 125, 14),
(2172, 37, 126, 19),
(2173, 37, 127, 21),
(2174, 37, 128, 21),
(2175, 37, 129, 21),
(2176, 37, 130, 21),
(2177, 37, 131, 11),
(2178, 37, 132, 11),
(2179, 37, 133, 11),
(2180, 37, 134, 20),
(2181, 37, 135, 20),
(2182, 37, 136, 20),
(2183, 37, 139, 17),
(2184, 37, 140, 17),
(2185, 37, 141, 16),
(2186, 34, 54, 14),
(2187, 34, 83, 1),
(2188, 34, 89, 17),
(2189, 34, 90, 14),
(2190, 34, 101, 14),
(2191, 34, 102, 14),
(2192, 34, 103, 14),
(2193, 34, 104, 14),
(2194, 34, 119, 19),
(2195, 34, 120, 14),
(2196, 34, 121, 14),
(2197, 34, 124, 19),
(2198, 34, 125, 14),
(2199, 34, 126, 19),
(2200, 34, 134, 20),
(2201, 34, 135, 20),
(2202, 34, 136, 20),
(2203, 34, 139, 17),
(2204, 34, 140, 17),
(2205, 38, 50, 11),
(2206, 38, 54, 14),
(2207, 38, 89, 17),
(2208, 38, 90, 14),
(2209, 38, 101, 14),
(2210, 38, 102, 14),
(2211, 38, 103, 14),
(2212, 38, 104, 14),
(2213, 38, 105, 3),
(2214, 38, 106, 3),
(2215, 38, 107, 3),
(2216, 38, 108, 16),
(2217, 38, 109, 16),
(2218, 38, 110, 18),
(2219, 38, 111, 18),
(2220, 38, 114, 16),
(2221, 38, 115, 16),
(2222, 38, 116, 16),
(2223, 38, 117, 16),
(2224, 38, 118, 18),
(2225, 38, 119, 19),
(2226, 38, 120, 14),
(2227, 38, 121, 14),
(2228, 38, 122, 3),
(2229, 38, 123, 3),
(2230, 38, 124, 19),
(2231, 38, 125, 14),
(2232, 38, 126, 19),
(2233, 38, 127, 21),
(2234, 38, 128, 21),
(2235, 38, 129, 21),
(2236, 38, 130, 21),
(2237, 38, 131, 11),
(2238, 38, 132, 11),
(2239, 38, 133, 11),
(2240, 38, 134, 20),
(2241, 38, 135, 20),
(2242, 38, 136, 20),
(2243, 38, 139, 17),
(2244, 38, 140, 17),
(2245, 38, 141, 16),
(2246, 39, 50, 11),
(2247, 39, 54, 14),
(2248, 39, 89, 17),
(2249, 39, 90, 14),
(2250, 39, 101, 14),
(2251, 39, 102, 14),
(2252, 39, 103, 14),
(2253, 39, 104, 14),
(2254, 39, 105, 3),
(2255, 39, 106, 3),
(2256, 39, 107, 3),
(2257, 39, 108, 16),
(2258, 39, 109, 16),
(2259, 39, 110, 18),
(2260, 39, 111, 18),
(2261, 39, 114, 16),
(2262, 39, 115, 16),
(2263, 39, 116, 16),
(2264, 39, 117, 16),
(2265, 39, 118, 18),
(2266, 39, 119, 19),
(2267, 39, 120, 14),
(2268, 39, 121, 14),
(2269, 39, 122, 3),
(2270, 39, 123, 3),
(2271, 39, 124, 19),
(2272, 39, 125, 14),
(2273, 39, 126, 19),
(2274, 39, 127, 21),
(2275, 39, 128, 21),
(2276, 39, 129, 21),
(2277, 39, 130, 21),
(2278, 39, 131, 11),
(2279, 39, 132, 11),
(2280, 39, 133, 11),
(2281, 39, 134, 20),
(2282, 39, 135, 20),
(2283, 39, 136, 20),
(2284, 39, 139, 17),
(2285, 39, 140, 17),
(2286, 39, 141, 16),
(2287, 40, 50, 11),
(2288, 40, 54, 14),
(2289, 40, 89, 17),
(2290, 40, 90, 14),
(2291, 40, 101, 14),
(2292, 40, 102, 14),
(2293, 40, 103, 14),
(2294, 40, 104, 14),
(2295, 40, 105, 3),
(2296, 40, 106, 3),
(2297, 40, 107, 3),
(2298, 40, 108, 16),
(2299, 40, 109, 16),
(2300, 40, 110, 18),
(2301, 40, 111, 18),
(2302, 40, 114, 16),
(2303, 40, 115, 16),
(2304, 40, 116, 16),
(2305, 40, 117, 16),
(2306, 40, 118, 18),
(2307, 40, 119, 19),
(2308, 40, 120, 14),
(2309, 40, 121, 14),
(2310, 40, 122, 3),
(2311, 40, 123, 3),
(2312, 40, 124, 19),
(2313, 40, 125, 14),
(2314, 40, 126, 19),
(2315, 40, 127, 21),
(2316, 40, 128, 21),
(2317, 40, 129, 21),
(2318, 40, 130, 21),
(2319, 40, 131, 11),
(2320, 40, 132, 11),
(2321, 40, 133, 11),
(2322, 40, 134, 20),
(2323, 40, 135, 20),
(2324, 40, 136, 20),
(2325, 40, 139, 17),
(2326, 40, 140, 17),
(2327, 40, 141, 16),
(2328, 36, 8, 1),
(2329, 36, 45, 1),
(2330, 36, 50, 11),
(2331, 36, 54, 14),
(2332, 36, 83, 1),
(2333, 36, 89, 17),
(2334, 36, 90, 14),
(2335, 36, 101, 14),
(2336, 36, 102, 14),
(2337, 36, 103, 14),
(2338, 36, 104, 14),
(2339, 36, 105, 3),
(2340, 36, 106, 3),
(2341, 36, 107, 3),
(2342, 36, 108, 16),
(2343, 36, 109, 16),
(2344, 36, 110, 18),
(2345, 36, 111, 18),
(2346, 36, 114, 16),
(2347, 36, 115, 16),
(2348, 36, 116, 16),
(2349, 36, 117, 16),
(2350, 36, 118, 18),
(2351, 36, 119, 19),
(2352, 36, 120, 14),
(2353, 36, 121, 14),
(2354, 36, 122, 3),
(2355, 36, 123, 3),
(2356, 36, 124, 19),
(2357, 36, 125, 14),
(2358, 36, 126, 19),
(2359, 36, 127, 21),
(2360, 36, 128, 21),
(2361, 36, 129, 21),
(2362, 36, 130, 21),
(2363, 36, 131, 11),
(2364, 36, 132, 11),
(2365, 36, 133, 11),
(2366, 36, 134, 20),
(2367, 36, 135, 20),
(2368, 36, 136, 20),
(2369, 36, 139, 17),
(2370, 36, 140, 17),
(2371, 36, 141, 16),
(2372, 41, 50, 11),
(2373, 41, 54, 14),
(2374, 41, 83, 1),
(2375, 41, 89, 17),
(2376, 41, 90, 14),
(2377, 41, 101, 14),
(2378, 41, 102, 14),
(2379, 41, 103, 14),
(2380, 41, 104, 14),
(2381, 41, 105, 3),
(2382, 41, 106, 3),
(2383, 41, 107, 3),
(2384, 41, 108, 16),
(2385, 41, 109, 16),
(2386, 41, 110, 18),
(2387, 41, 111, 18),
(2388, 41, 114, 16),
(2389, 41, 115, 16),
(2390, 41, 116, 16),
(2391, 41, 117, 16),
(2392, 41, 118, 18),
(2393, 41, 119, 19),
(2394, 41, 120, 14),
(2395, 41, 121, 14),
(2396, 41, 122, 3),
(2397, 41, 123, 3),
(2398, 41, 124, 19),
(2399, 41, 125, 14),
(2400, 41, 126, 19),
(2401, 41, 127, 21),
(2402, 41, 128, 21),
(2403, 41, 129, 21),
(2404, 41, 130, 21),
(2405, 41, 131, 11),
(2406, 41, 132, 11),
(2407, 41, 133, 11),
(2408, 41, 134, 20),
(2409, 41, 135, 20),
(2410, 41, 136, 20),
(2411, 41, 139, 17),
(2412, 41, 140, 17),
(2413, 41, 141, 16);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `accounts_payable`
--
ALTER TABLE `accounts_payable`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `audit_trail`
--
ALTER TABLE `audit_trail`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `clients_documents`
--
ALTER TABLE `clients_documents`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `crv`
--
ALTER TABLE `crv`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `error_logging`
--
ALTER TABLE `error_logging`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `fm_account_receivable`
--
ALTER TABLE `fm_account_receivable`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `fm_adjustments_types`
--
ALTER TABLE `fm_adjustments_types`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `fm_cash_control_account`
--
ALTER TABLE `fm_cash_control_account`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `fm_classification`
--
ALTER TABLE `fm_classification`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `fm_client_activity_type`
--
ALTER TABLE `fm_client_activity_type`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `fm_client_category`
--
ALTER TABLE `fm_client_category`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `fm_client_document_type`
--
ALTER TABLE `fm_client_document_type`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `fm_client_progress_status`
--
ALTER TABLE `fm_client_progress_status`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `fm_currency_rate`
--
ALTER TABLE `fm_currency_rate`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `fm_currency_type`
--
ALTER TABLE `fm_currency_type`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `fm_debit_credit_type`
--
ALTER TABLE `fm_debit_credit_type`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `fm_delivery_place`
--
ALTER TABLE `fm_delivery_place`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `fm_department`
--
ALTER TABLE `fm_department`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `fm_designation`
--
ALTER TABLE `fm_designation`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `fm_foreign_charges`
--
ALTER TABLE `fm_foreign_charges`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `fm_grv_transport`
--
ALTER TABLE `fm_grv_transport`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `fm_local_charges`
--
ALTER TABLE `fm_local_charges`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `fm_manpower`
--
ALTER TABLE `fm_manpower`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `fm_project_status`
--
ALTER TABLE `fm_project_status`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `inventory_adjustments`
--
ALTER TABLE `inventory_adjustments`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `inventory_adjustments_items`
--
ALTER TABLE `inventory_adjustments_items`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `inventory_movement`
--
ALTER TABLE `inventory_movement`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `inventory_quotation`
--
ALTER TABLE `inventory_quotation`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `inventory_returns`
--
ALTER TABLE `inventory_returns`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `inventory_returns_items`
--
ALTER TABLE `inventory_returns_items`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `issuance`
--
ALTER TABLE `issuance`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `issuance_items`
--
ALTER TABLE `issuance_items`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `landed_cost_rate`
--
ALTER TABLE `landed_cost_rate`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `legalization_fees`
--
ALTER TABLE `legalization_fees`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `menu_main`
--
ALTER TABLE `menu_main`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `menu_sub`
--
ALTER TABLE `menu_sub`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `projects_documents`
--
ALTER TABLE `projects_documents`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `projects_job_order`
--
ALTER TABLE `projects_job_order`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `projects_job_order_clock_in`
--
ALTER TABLE `projects_job_order_clock_in`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `projects_job_order_labor`
--
ALTER TABLE `projects_job_order_labor`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `projects_progress`
--
ALTER TABLE `projects_progress`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `projects_recent`
--
ALTER TABLE `projects_recent`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `quotations`
--
ALTER TABLE `quotations`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `quotations_items`
--
ALTER TABLE `quotations_items`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `quotations_landed_cost_rate`
--
ALTER TABLE `quotations_landed_cost_rate`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `quotations_legalization_fees`
--
ALTER TABLE `quotations_legalization_fees`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `quotations_locations`
--
ALTER TABLE `quotations_locations`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `quotations_others`
--
ALTER TABLE `quotations_others`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `quotations_package`
--
ALTER TABLE `quotations_package`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `quotations_package_items`
--
ALTER TABLE `quotations_package_items`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `receiving`
--
ALTER TABLE `receiving`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `receiving_fc`
--
ALTER TABLE `receiving_fc`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `receiving_items`
--
ALTER TABLE `receiving_items`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `receiving_lc`
--
ALTER TABLE `receiving_lc`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `suppliers_po`
--
ALTER TABLE `suppliers_po`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `terms_and_conditions`
--
ALTER TABLE `terms_and_conditions`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `accounts_payable`
--
ALTER TABLE `accounts_payable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `audit_trail`
--
ALTER TABLE `audit_trail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `clients_documents`
--
ALTER TABLE `clients_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crv`
--
ALTER TABLE `crv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `error_logging`
--
ALTER TABLE `error_logging`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `fm_account_receivable`
--
ALTER TABLE `fm_account_receivable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fm_adjustments_types`
--
ALTER TABLE `fm_adjustments_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fm_cash_control_account`
--
ALTER TABLE `fm_cash_control_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fm_classification`
--
ALTER TABLE `fm_classification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fm_client_activity_type`
--
ALTER TABLE `fm_client_activity_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fm_client_category`
--
ALTER TABLE `fm_client_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `fm_client_document_type`
--
ALTER TABLE `fm_client_document_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fm_client_progress_status`
--
ALTER TABLE `fm_client_progress_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `fm_currency_rate`
--
ALTER TABLE `fm_currency_rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fm_currency_type`
--
ALTER TABLE `fm_currency_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `fm_debit_credit_type`
--
ALTER TABLE `fm_debit_credit_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fm_delivery_place`
--
ALTER TABLE `fm_delivery_place`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `fm_department`
--
ALTER TABLE `fm_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `fm_designation`
--
ALTER TABLE `fm_designation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fm_foreign_charges`
--
ALTER TABLE `fm_foreign_charges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `fm_grv_transport`
--
ALTER TABLE `fm_grv_transport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fm_local_charges`
--
ALTER TABLE `fm_local_charges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `fm_manpower`
--
ALTER TABLE `fm_manpower`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `fm_project_status`
--
ALTER TABLE `fm_project_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_adjustments`
--
ALTER TABLE `inventory_adjustments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_adjustments_items`
--
ALTER TABLE `inventory_adjustments_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_movement`
--
ALTER TABLE `inventory_movement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_quotation`
--
ALTER TABLE `inventory_quotation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_returns`
--
ALTER TABLE `inventory_returns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_returns_items`
--
ALTER TABLE `inventory_returns_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issuance`
--
ALTER TABLE `issuance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issuance_items`
--
ALTER TABLE `issuance_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `landed_cost_rate`
--
ALTER TABLE `landed_cost_rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `legalization_fees`
--
ALTER TABLE `legalization_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `menu_main`
--
ALTER TABLE `menu_main`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `menu_sub`
--
ALTER TABLE `menu_sub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `projects_documents`
--
ALTER TABLE `projects_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects_job_order`
--
ALTER TABLE `projects_job_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects_job_order_clock_in`
--
ALTER TABLE `projects_job_order_clock_in`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects_job_order_labor`
--
ALTER TABLE `projects_job_order_labor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects_progress`
--
ALTER TABLE `projects_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects_recent`
--
ALTER TABLE `projects_recent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotations`
--
ALTER TABLE `quotations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `quotations_items`
--
ALTER TABLE `quotations_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotations_landed_cost_rate`
--
ALTER TABLE `quotations_landed_cost_rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `quotations_legalization_fees`
--
ALTER TABLE `quotations_legalization_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `quotations_locations`
--
ALTER TABLE `quotations_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotations_others`
--
ALTER TABLE `quotations_others`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `quotations_package`
--
ALTER TABLE `quotations_package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotations_package_items`
--
ALTER TABLE `quotations_package_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receiving`
--
ALTER TABLE `receiving`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receiving_fc`
--
ALTER TABLE `receiving_fc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receiving_items`
--
ALTER TABLE `receiving_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receiving_lc`
--
ALTER TABLE `receiving_lc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `suppliers_po`
--
ALTER TABLE `suppliers_po`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `terms_and_conditions`
--
ALTER TABLE `terms_and_conditions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `theme`
--
ALTER TABLE `theme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2414;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

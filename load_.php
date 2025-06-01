-- MariaDB dump 10.19  Distrib 10.4.27-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: ventum
-- ------------------------------------------------------
-- Server version	10.4.27-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `department_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES (2,'1','','2017-05-01','adminxadmin','$2a$08$HMSs9g77UdvwR7QJDA8dwuzqOj5qb1UZeKNc0s9aR4QuH7TT8tExi',0,1,'Super Admin','656d695223630_face2.jpg',0,'Mon Butiong',0,NULL,NULL,3),(29,'',NULL,'2024-05-12','superadmin','$2a$08$LkbTL6pFSsg7/euDx/BPOuQFCB7n5ib0gnCQWyF9u2S.H9NCCH9k6',1,NULL,'Superadmin',NULL,0,'Superadmin',0,NULL,NULL,NULL),(31,'',NULL,'2024-05-12','invcon','$2a$08$bXlXi1CEClMdeUEux5lqp.JF4lbmQPvPUI8dRdZK.wfTtiSZTeqE2',1,NULL,'Inventory Controller',NULL,0,'Inventory Controller',0,NULL,NULL,NULL),(32,'',NULL,'2024-05-13','purchasing','$2a$08$J.6DiCDnwtbTlA7yqxHCB.B/hiNAugLuRZYKSZ1gnE/X63yv0Arzu',1,NULL,'Purchasing',NULL,0,'Purchasing',0,NULL,NULL,NULL),(33,'',NULL,'2024-05-13','sales','$2a$08$2nfJqlBjFTn1Cr3Om3ybruX8ZstJt5nuWBinGAvrfMFEbXDNnvfKi',1,NULL,'Sales',NULL,0,'Sales',0,NULL,NULL,NULL),(34,'',NULL,'2024-05-13','accounts','$2a$08$vv/bvaIo/Mlcw5XCR95HwegnWia5byS8jwrdKlr3mSXV6Lm1H7Smu',1,NULL,'Accounts',NULL,0,'Accounts',0,NULL,NULL,NULL),(35,'',NULL,'2024-05-15','tarek','$2a$08$etQDpCKaOTsSW0jzHg08RudIGuopJ1VMW.2iv5rtJ.8CTBvsvfRhO',1,NULL,'Administrator',NULL,0,'Tarek Mrad ',0,NULL,NULL,NULL),(36,'',NULL,'2024-05-15','antoine','$2a$08$rqxCwBwUtuW2Wlw/jy.hzeZRLbWplRIYiBvHRAkgFWldqSy8fK5cS',1,NULL,'Administrator',NULL,0,'Antoine Saab',0,NULL,NULL,NULL);
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accounts_payable`
--

DROP TABLE IF EXISTS `accounts_payable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts_payable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `collection_date` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts_payable`
--

LOCK TABLES `accounts_payable` WRITE;
/*!40000 ALTER TABLE `accounts_payable` DISABLE KEYS */;
/*!40000 ALTER TABLE `accounts_payable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audit_trail`
--

DROP TABLE IF EXISTS `audit_trail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `audit_trail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `module` varchar(225) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `dc` datetime DEFAULT NULL,
  `option` varchar(225) DEFAULT NULL,
  `log` text DEFAULT NULL,
  `date_created` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_trail`
--

LOCK TABLES `audit_trail` WRITE;
/*!40000 ALTER TABLE `audit_trail` DISABLE KEYS */;
INSERT INTO `audit_trail` VALUES (1,2,'home > system user','add new system user , user id : 35','2024-05-15 16:16:17',NULL,NULL,NULL),(2,2,'home > system user','add new system user , user id : 36','2024-05-15 16:16:53',NULL,NULL,NULL),(3,2,'home > system user > update user roles','update system user restriction, user id : 35','2024-05-15 16:17:24',NULL,NULL,NULL),(4,2,'home > system user > update user roles','update system user restriction, user id : 36','2024-05-15 16:17:58',NULL,NULL,NULL),(5,2,'account page','logout to account.','2024-05-15 16:19:13',NULL,NULL,NULL),(6,35,'login page','login to account.','2024-05-15 16:19:22',NULL,NULL,NULL),(7,35,'account page','logout to account.','2024-05-15 16:19:26',NULL,NULL,NULL),(8,36,'login page','login to account.','2024-05-15 16:19:38',NULL,NULL,NULL),(9,36,'account page','logout to account.','2024-05-15 16:19:43',NULL,NULL,NULL),(10,2,'login page','login to account.','2024-05-15 16:26:48',NULL,NULL,NULL),(11,2,'login page','login to account.','2024-05-16 09:07:51',NULL,NULL,NULL),(12,2,'account page','logout to account.','2024-05-16 12:54:20',NULL,NULL,NULL),(13,35,'login page','login to account.','2024-05-16 12:54:51',NULL,NULL,NULL),(14,35,'account page','logout to account.','2024-05-16 12:54:55',NULL,NULL,NULL),(15,2,'login page','login to account.','2024-05-16 12:56:59',NULL,NULL,NULL),(16,29,'login page','login to account.','2024-05-20 15:11:17',NULL,NULL,NULL),(17,29,'login page','login to account.','2024-05-20 15:13:13',NULL,NULL,NULL),(18,29,'account page','logout to account.','2024-05-20 16:10:24',NULL,NULL,NULL);
/*!40000 ALTER TABLE `audit_trail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `website` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'2024-05-16 19:18:23',2,0,'',NULL,'',NULL,'client1','','','','','',NULL,NULL,NULL,'','','','','p1',NULL),(2,'2024-05-16 19:20:25',2,0,'',NULL,'',NULL,'client 2','','','','','',NULL,NULL,NULL,'','','','','c2',NULL);
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients_documents`
--

DROP TABLE IF EXISTS `clients_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients_documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `document_type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients_documents`
--

LOCK TABLES `clients_documents` WRITE;
/*!40000 ALTER TABLE `clients_documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `clients_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `crv`
--

DROP TABLE IF EXISTS `crv`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `crv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `cash_control_account_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `crv`
--

LOCK TABLES `crv` WRITE;
/*!40000 ALTER TABLE `crv` DISABLE KEYS */;
/*!40000 ALTER TABLE `crv` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `basic_amount` float(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `error_logging`
--

DROP TABLE IF EXISTS `error_logging`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `error_logging` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `error_dt` varchar(30) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `line_number` int(11) DEFAULT NULL,
  `attended` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `error_logging`
--

LOCK TABLES `error_logging` WRITE;
/*!40000 ALTER TABLE `error_logging` DISABLE KEYS */;
INSERT INTO `error_logging` VALUES (1,'TypeError','Unsupported operand types: int + string','/ventum/sales/edit_quotation/1','2024-05-15 21:48:07',2,529,0),(2,'TypeError','Unsupported operand types: int + string','/ventum/sales/edit_quotation/1','2024-05-15 21:48:13',2,529,0),(3,'TypeError','Unsupported operand types: int + string','/ventum/sales/edit_quotation/1','2024-05-15 21:48:17',2,529,0),(4,'TypeError','Unsupported operand types: int + string','/ventum/sales/edit_quotation/1','2024-05-15 21:48:38',2,529,0),(5,'TypeError','Unsupported operand types: int + string','/ventum/sales/edit_quotation/1','2024-05-15 21:48:45',2,529,0),(6,'TypeError','Unsupported operand types: string / int','/ventum/sales/edit_quotation/1','2024-05-15 21:50:39',2,530,0);
/*!40000 ALTER TABLE `error_logging` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fm_account_receivable`
--

DROP TABLE IF EXISTS `fm_account_receivable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fm_account_receivable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fm_account_receivable`
--

LOCK TABLES `fm_account_receivable` WRITE;
/*!40000 ALTER TABLE `fm_account_receivable` DISABLE KEYS */;
INSERT INTO `fm_account_receivable` VALUES (1,'400001070','A/R-Project Materials','2024-04-24',2),(2,'4000001201','A/R-Manpower','2024-04-24',2),(3,'4000007082','A/R-Assets','2024-04-24',2);
/*!40000 ALTER TABLE `fm_account_receivable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fm_adjustments_types`
--

DROP TABLE IF EXISTS `fm_adjustments_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fm_adjustments_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fm_adjustments_types`
--

LOCK TABLES `fm_adjustments_types` WRITE;
/*!40000 ALTER TABLE `fm_adjustments_types` DISABLE KEYS */;
INSERT INTO `fm_adjustments_types` VALUES (1,'Returns and Damaged Goods','Returns and Damaged Goods','2023-12-27',2),(2,'Physical Count Discrepancies','Physical Count Discrepancies','2023-12-27',2),(3,'Obsolete or Expired Items','Obsolete or Expired Items','2023-12-27',2),(4,'Write-offs','Write-offs','2023-12-27',2),(5,'Seasonal Adjustments','Seasonal Adjustments','2023-12-27',2);
/*!40000 ALTER TABLE `fm_adjustments_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fm_cash_control_account`
--

DROP TABLE IF EXISTS `fm_cash_control_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fm_cash_control_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fm_cash_control_account`
--

LOCK TABLES `fm_cash_control_account` WRITE;
/*!40000 ALTER TABLE `fm_cash_control_account` DISABLE KEYS */;
INSERT INTO `fm_cash_control_account` VALUES (1,'40000006085','Cash on Hand (Main)','2024-04-24',2),(2,'400008426','Cash Control - Labor','2024-04-24',2),(3,'400008722','Cash Control - Project','2024-04-24',2);
/*!40000 ALTER TABLE `fm_cash_control_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fm_classification`
--

DROP TABLE IF EXISTS `fm_classification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fm_classification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fm_classification`
--

LOCK TABLES `fm_classification` WRITE;
/*!40000 ALTER TABLE `fm_classification` DISABLE KEYS */;
INSERT INTO `fm_classification` VALUES (1,'Class1','Class1','2022-06-22',2),(2,'Class2','Class2','2022-06-22',2),(3,'','','2022-12-19',2),(4,'n/a','n/a','2022-12-19',2);
/*!40000 ALTER TABLE `fm_classification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fm_client_activity_type`
--

DROP TABLE IF EXISTS `fm_client_activity_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fm_client_activity_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fm_client_activity_type`
--

LOCK TABLES `fm_client_activity_type` WRITE;
/*!40000 ALTER TABLE `fm_client_activity_type` DISABLE KEYS */;
INSERT INTO `fm_client_activity_type` VALUES (1,'Onsite Meeting','Onsite Meeting','2024-04-25',2),(2,'Telephone','Telephone','2024-04-25',2),(3,'Online Meeting','Online Meeting','2024-04-25',2),(4,'Tour','Tour','2024-04-25',2),(5,'Contract Signing','Contract Signing','2024-04-25',2);
/*!40000 ALTER TABLE `fm_client_activity_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fm_client_category`
--

DROP TABLE IF EXISTS `fm_client_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fm_client_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fm_client_category`
--

LOCK TABLES `fm_client_category` WRITE;
/*!40000 ALTER TABLE `fm_client_category` DISABLE KEYS */;
INSERT INTO `fm_client_category` VALUES (1,'Prospect Client','These are potential clients who have shown interest in your products or services but have not yet made a purchase.','2023-09-02',2),(2,'Current Client','These are clients who are currently active and have ongoing business with your company. They have made at least one purchase or engaged in your services.','2023-09-02',2),(3,'Inactive Client','These are clients who were once active but have not engaged with your business for a certain period. They might need re-engagement efforts.','2023-09-02',2),(4,'Lost Client','These are clients who were previously active but are no longer doing business with your company. They might be considered lost opportunities.','2023-09-02',2),(5,'VIP Client','These are high-value clients who generate significant revenue for your business. They might receive special treatment or offers.','2023-09-02',2),(6,'New Client','These are clients who have recently joined your client base but have not yet engaged in significant business.','2023-09-02',2),(7,'Pending Client','These are clients whose status is pending due to some specific action or verification.','2023-09-02',2);
/*!40000 ALTER TABLE `fm_client_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fm_client_document_type`
--

DROP TABLE IF EXISTS `fm_client_document_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fm_client_document_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fm_client_document_type`
--

LOCK TABLES `fm_client_document_type` WRITE;
/*!40000 ALTER TABLE `fm_client_document_type` DISABLE KEYS */;
INSERT INTO `fm_client_document_type` VALUES (1,'Contract','Contract','2024-04-25',2),(2,'Registration','Registration','2024-04-25',2),(3,'ID','ID','2024-04-25',2),(4,'Proposal','Proposal','2024-04-25',2);
/*!40000 ALTER TABLE `fm_client_document_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fm_client_progress_status`
--

DROP TABLE IF EXISTS `fm_client_progress_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fm_client_progress_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fm_client_progress_status`
--

LOCK TABLES `fm_client_progress_status` WRITE;
/*!40000 ALTER TABLE `fm_client_progress_status` DISABLE KEYS */;
INSERT INTO `fm_client_progress_status` VALUES (1,'Lead','This status can be assigned to clients who have shown initial interest but haven\'t progressed beyond the lead stage.','2023-09-02',2),(2,'Contacted','Indicates that your team has made initial contact with the client, possibly through a phone call, email, or meeting.','2023-09-02',2),(3,'Meeting Scheduled','This status can be used when a meeting is scheduled with the client to discuss their needs or potential solutions.','2023-09-02',2),(4,'Proposal Sent','Shows that a formal proposal or quote has been sent to the client for their consideration.','2023-09-02',2),(5,'Follow-up Required','Clients in this status may need additional follow-up or clarification before they can move forward.','2023-09-02',2),(6,'Negotiation','Pending Approval','2023-09-02',2),(7,'Deal Signed','This status signifies that the deal has been successfully signed or the client has made a commitment.','2023-09-02',2),(8,'Waiting for Payment','Clients who have agreed to the deal but haven\'t made the payment yet.','2023-09-02',2),(9,'On Hold','Sometimes, clients might put projects on hold for various reasons. This status can be used to track such cases.','2023-09-02',2),(10,'Closed - Won','Indicates successful sales or project closure.','2023-09-02',2),(11,'Closed - Lost','Clients who decided not to move forward with your offer.','2023-09-02',2),(12,'Inactive','Clients who were once active but haven\'t responded or engaged for an extended period.','2023-09-02',2),(13,'Completed','For clients who have received the service or product and the project is completed.','2023-09-02',2);
/*!40000 ALTER TABLE `fm_client_progress_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fm_currency_rate`
--

DROP TABLE IF EXISTS `fm_currency_rate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fm_currency_rate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `currency_symbol` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fm_currency_rate`
--

LOCK TABLES `fm_currency_rate` WRITE;
/*!40000 ALTER TABLE `fm_currency_rate` DISABLE KEYS */;
INSERT INTO `fm_currency_rate` VALUES (1,'QAR','1.000000','2023-09-03',2,'QAR'),(2,'USD','4.521300','2023-09-03',2,'$'),(3,'EUR','5.320011','2023-09-03',2,'€'),(4,'UK','6.43211','2023-09-03',2,'£');
/*!40000 ALTER TABLE `fm_currency_rate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fm_currency_type`
--

DROP TABLE IF EXISTS `fm_currency_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fm_currency_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `vs_peso_rate` float(11,8) DEFAULT NULL,
  `is_peso` int(11) DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fm_currency_type`
--

LOCK TABLES `fm_currency_type` WRITE;
/*!40000 ALTER TABLE `fm_currency_type` DISABLE KEYS */;
INSERT INTO `fm_currency_type` VALUES (7,'PHP','Philippine Peso','2022-06-22',2,1.00000000,1),(8,'USD','US Dollar','2022-12-23',2,54.44510269,0),(9,'JPY','Japanese Yen','2022-06-22',2,0.56822211,0);
/*!40000 ALTER TABLE `fm_currency_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fm_debit_credit_type`
--

DROP TABLE IF EXISTS `fm_debit_credit_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fm_debit_credit_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fm_debit_credit_type`
--

LOCK TABLES `fm_debit_credit_type` WRITE;
/*!40000 ALTER TABLE `fm_debit_credit_type` DISABLE KEYS */;
INSERT INTO `fm_debit_credit_type` VALUES (1,'NAPS','NAPS','2024-04-24',2),(2,'VISA','VISA ','2024-04-24',2),(3,'MASTER CARD','MASTER CARD','2024-04-24',2);
/*!40000 ALTER TABLE `fm_debit_credit_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fm_delivery_place`
--

DROP TABLE IF EXISTS `fm_delivery_place`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fm_delivery_place` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fm_delivery_place`
--

LOCK TABLES `fm_delivery_place` WRITE;
/*!40000 ALTER TABLE `fm_delivery_place` DISABLE KEYS */;
INSERT INTO `fm_delivery_place` VALUES (12,'JGM Philippines inc','JGM Philippines inc','2022-05-30',2),(13,'Warehouse 1','Warehouse 1','2022-05-30',2);
/*!40000 ALTER TABLE `fm_delivery_place` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fm_department`
--

DROP TABLE IF EXISTS `fm_department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fm_department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `po_auto_approved` int(11) DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fm_department`
--

LOCK TABLES `fm_department` WRITE;
/*!40000 ALTER TABLE `fm_department` DISABLE KEYS */;
INSERT INTO `fm_department` VALUES (1,'MIS','IT Department','2017-05-22',2,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(2,'Accounting','Accounting','2017-05-22',2,2,0,8,0,8,0,1,1),(3,'HR','Human Resource','2017-06-18',2,14,16,0,2,0,0,1,1),(4,'Production','Production','2017-06-20',2,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(5,'Purchasing','Purchasing Department','2017-06-20',2,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(6,'Warehouse','Warehouse','2017-06-20',2,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(7,'Admin','Admin','2017-06-20',2,11,12,0,0,0,0,1,0),(8,'Sales','Sales','2023-06-08',2,NULL,NULL,NULL,NULL,NULL,NULL,0,0),(9,'Design','Design','2023-06-08',2,NULL,NULL,NULL,NULL,NULL,NULL,0,0);
/*!40000 ALTER TABLE `fm_department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fm_designation`
--

DROP TABLE IF EXISTS `fm_designation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fm_designation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fm_designation`
--

LOCK TABLES `fm_designation` WRITE;
/*!40000 ALTER TABLE `fm_designation` DISABLE KEYS */;
INSERT INTO `fm_designation` VALUES (3,'Web Developer','PHP developer, web application\'s','2017-05-22',2),(4,'Accountant','Accounting Staff','2017-05-22',2),(5,'Department Manager','Department Manager','2023-01-11',2);
/*!40000 ALTER TABLE `fm_designation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fm_foreign_charges`
--

DROP TABLE IF EXISTS `fm_foreign_charges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fm_foreign_charges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fm_foreign_charges`
--

LOCK TABLES `fm_foreign_charges` WRITE;
/*!40000 ALTER TABLE `fm_foreign_charges` DISABLE KEYS */;
INSERT INTO `fm_foreign_charges` VALUES (1,'FREIGHT','FREIGHT','2023-09-03',2),(2,'HANDLING','HANDLING','2023-09-03',2),(3,'DOCUMENTATION','DOCUMENTATION','2023-09-03',2),(4,'INSURANCE','INSURANCE','2023-09-03',2),(5,'OTHERS','OTHERS','2023-09-03',2),(6,'SE FREIGHT','SE FREIGHT','2023-09-03',2);
/*!40000 ALTER TABLE `fm_foreign_charges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fm_grv_transport`
--

DROP TABLE IF EXISTS `fm_grv_transport`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fm_grv_transport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fm_grv_transport`
--

LOCK TABLES `fm_grv_transport` WRITE;
/*!40000 ALTER TABLE `fm_grv_transport` DISABLE KEYS */;
INSERT INTO `fm_grv_transport` VALUES (1,'DHL','DHL','2024-05-15',2),(2,'Talabat Express','Talabat Express','2024-05-15',2);
/*!40000 ALTER TABLE `fm_grv_transport` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fm_local_charges`
--

DROP TABLE IF EXISTS `fm_local_charges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fm_local_charges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fm_local_charges`
--

LOCK TABLES `fm_local_charges` WRITE;
/*!40000 ALTER TABLE `fm_local_charges` DISABLE KEYS */;
INSERT INTO `fm_local_charges` VALUES (1,'FREIGHT','FREIGHT','2023-09-03',2),(2,'HANDLING','HANDLING','2023-09-03',2),(3,'CLEARING','CLEARING','2023-09-03',2),(4,'TRANSPORT','TRANSPORT','2023-09-03',2),(5,'BANK','BANK','2023-09-03',2),(6,'DEMMURRAGE','DEMMURRAGE','2023-09-03',2),(7,'CUSTOMS DUTIES','CUSTOMS DUTIES','2023-09-03',2),(8,'CUSTOM CLEARANCE & DOCS','CUSTOM CLEARANCE & DOCS','2023-09-03',2);
/*!40000 ALTER TABLE `fm_local_charges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fm_manpower`
--

DROP TABLE IF EXISTS `fm_manpower`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fm_manpower` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fm_manpower`
--

LOCK TABLES `fm_manpower` WRITE;
/*!40000 ALTER TABLE `fm_manpower` DISABLE KEYS */;
INSERT INTO `fm_manpower` VALUES (1,'Projects Manager','1200','2023-09-11',2),(2,'Deputy Commissioning Manager','800','2023-09-11',2),(3,'Commissioning engineer','650','2023-09-11',2),(4,'Projects Engineer','750','2023-09-11',2),(5,'Maintenance Engineer','650','2023-09-11',2),(6,'Document Controller','350','2023-09-11',2),(7,'Installation Supervisor','350','2023-09-11',2),(8,'HSE Manager','350','2023-09-11',2),(9,'HSE Officer','400','2023-09-11',2),(10,'Draftsman','200','2023-09-11',2),(11,'Installation Technician (8 technician for 150 days)','200','2023-09-11',2),(12,'Installation Helper (8 Helpers for 150 days)','200','2023-09-11',2),(13,'Driver','200','2023-09-11',2),(14,'Maintenance Technician','200','2023-09-11',2);
/*!40000 ALTER TABLE `fm_manpower` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fm_project_status`
--

DROP TABLE IF EXISTS `fm_project_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fm_project_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fm_project_status`
--

LOCK TABLES `fm_project_status` WRITE;
/*!40000 ALTER TABLE `fm_project_status` DISABLE KEYS */;
INSERT INTO `fm_project_status` VALUES (1,'Quotation','For Quotation Only','2023-03-17',2),(2,'In Progress','Projects that are in progress','2023-03-17',2),(3,'Finished','Finished Project','2023-04-14',2);
/*!40000 ALTER TABLE `fm_project_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `manufacturer_price` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci STATS_AUTO_RECALC=1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory`
--

LOCK TABLES `inventory` WRITE;
/*!40000 ALTER TABLE `inventory` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory_adjustments`
--

DROP TABLE IF EXISTS `inventory_adjustments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory_adjustments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `ref_no` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory_adjustments`
--

LOCK TABLES `inventory_adjustments` WRITE;
/*!40000 ALTER TABLE `inventory_adjustments` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory_adjustments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory_adjustments_items`
--

DROP TABLE IF EXISTS `inventory_adjustments_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory_adjustments_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `unit_cost_price` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory_adjustments_items`
--

LOCK TABLES `inventory_adjustments_items` WRITE;
/*!40000 ALTER TABLE `inventory_adjustments_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory_adjustments_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory_movement`
--

DROP TABLE IF EXISTS `inventory_movement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory_movement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `unit_cost_price` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci STATS_AUTO_RECALC=1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory_movement`
--

LOCK TABLES `inventory_movement` WRITE;
/*!40000 ALTER TABLE `inventory_movement` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory_movement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory_quotation`
--

DROP TABLE IF EXISTS `inventory_quotation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory_quotation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `inventory_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci STATS_AUTO_RECALC=1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory_quotation`
--

LOCK TABLES `inventory_quotation` WRITE;
/*!40000 ALTER TABLE `inventory_quotation` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory_quotation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory_returns`
--

DROP TABLE IF EXISTS `inventory_returns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory_returns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `job_order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory_returns`
--

LOCK TABLES `inventory_returns` WRITE;
/*!40000 ALTER TABLE `inventory_returns` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory_returns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory_returns_items`
--

DROP TABLE IF EXISTS `inventory_returns_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory_returns_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `issued_qty` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory_returns_items`
--

LOCK TABLES `inventory_returns_items` WRITE;
/*!40000 ALTER TABLE `inventory_returns_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory_returns_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `issuance`
--

DROP TABLE IF EXISTS `issuance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `issuance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `quotation_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `issuance`
--

LOCK TABLES `issuance` WRITE;
/*!40000 ALTER TABLE `issuance` DISABLE KEYS */;
/*!40000 ALTER TABLE `issuance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `issuance_items`
--

DROP TABLE IF EXISTS `issuance_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `issuance_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `unit_cost_price_orig` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `issuance_items`
--

LOCK TABLES `issuance_items` WRITE;
/*!40000 ALTER TABLE `issuance_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `issuance_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `landed_cost_rate`
--

DROP TABLE IF EXISTS `landed_cost_rate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `landed_cost_rate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `landed_cost_rate`
--

LOCK TABLES `landed_cost_rate` WRITE;
/*!40000 ALTER TABLE `landed_cost_rate` DISABLE KEYS */;
INSERT INTO `landed_cost_rate` VALUES (1,'',NULL,0,'',NULL,'',NULL,'EX-WORKS US','3.64','8','5','4.11320','$',0),(2,'',NULL,0,'',NULL,'',NULL,'EX-WORKS EU-USD','3.64','8','5','4.11320','$',0),(3,'',NULL,0,'',NULL,'',NULL,'EX-WORKS EU-EURO','4.00','8','5','4.52000','€',0),(4,'',NULL,0,'',NULL,'',NULL,'EX-WORKS UK','4.50','8','5','5.08500','£',0),(5,'',NULL,0,'',NULL,'',NULL,'EX-WORKS DUBAI-USD','3.64','8','5','4.11320','$',0),(6,'',NULL,0,'',NULL,'',NULL,'EX-WORKS DUBAI','1.00','8','5','1.13000','AED',0),(7,'',NULL,0,'',NULL,'',NULL,'LOCAL PURCHASE','1.00','0','0','1.00000','QAR',1),(8,'',NULL,0,'',NULL,'',NULL,'DDP QATAR USD','3.64','0','0','3.64000','$',0),(9,'',NULL,0,'',NULL,'',NULL,'DDP QATAR EURO','4.00','0','0','4.00000','€',0),(10,'',NULL,0,'',NULL,'',NULL,'CNF QATAR AIRPORT-USD','3.64','0','5','3.82200','$',0),(11,'',NULL,0,'',NULL,'',NULL,'CNF QATAR AIRPORT-EURO','4.00','0','5','4.20000','€',0);
/*!40000 ALTER TABLE `landed_cost_rate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `legalization_fees`
--

DROP TABLE IF EXISTS `legalization_fees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `legalization_fees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `legalization_fees`
--

LOCK TABLES `legalization_fees` WRITE;
/*!40000 ALTER TABLE `legalization_fees` DISABLE KEYS */;
INSERT INTO `legalization_fees` VALUES (1,'',NULL,0,'',NULL,'',NULL,'1','15000','920',0),(2,'',NULL,0,'',NULL,'',NULL,'15000.01','100000','1420',0),(3,'',NULL,0,'',NULL,'',NULL,'100000.01','250000','2920',0),(4,'',NULL,0,'',NULL,'',NULL,'250000.01','1000000','5150',0),(5,'',NULL,0,'',NULL,'',NULL,'1000000.01','100000000','0.006',1),(6,'2023-12-06 18:32:21',2,0,'',NULL,'',NULL,'250000.01','1000000','5150.11',0),(7,'2023-12-06 18:32:27',2,0,'',NULL,'',NULL,'250000.01','1000000','5150.00',0);
/*!40000 ALTER TABLE `legalization_fees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_main`
--

DROP TABLE IF EXISTS `menu_main`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_main` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) DEFAULT NULL,
  `module_description` text DEFAULT NULL,
  `pri` int(11) DEFAULT NULL,
  `font_icon` varchar(225) DEFAULT NULL,
  `url_link` varchar(225) DEFAULT NULL,
  `act` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_main`
--

LOCK TABLES `menu_main` WRITE;
/*!40000 ALTER TABLE `menu_main` DISABLE KEYS */;
INSERT INTO `menu_main` VALUES (1,'Admin',NULL,13,'fa-star','admin/home',1),(2,'System Parameters',NULL,11,'fa-table','admin/file_maintenance',0),(3,'Purchasing',NULL,4,'fa-file-powerpoint-o ','admin/employee',1),(5,'Reports',NULL,9,'fa-print','admin/fixed_asset_transfer',0),(11,'Inventory',NULL,8,'fa-cubes',NULL,1),(13,'Accounts',NULL,10,'fa-money',NULL,0),(14,'Quotation',NULL,1,'fa-tags',NULL,1),(15,'HR',NULL,8,'fa-users',NULL,0),(16,'Receiving',NULL,5,'fa-arrow-left',NULL,1),(17,'CRM',NULL,0,'fa-heart',NULL,1),(18,'Issuance',NULL,6,'fa-arrow-right',NULL,1),(19,'Project',NULL,3,'fa-building',NULL,1),(20,'Receipt',NULL,12,'fa-money',NULL,1),(21,'Adjustments',NULL,7,'fa-adjust',NULL,1);
/*!40000 ALTER TABLE `menu_main` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_sub`
--

DROP TABLE IF EXISTS `menu_sub`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_sub` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) DEFAULT NULL,
  `module_description` text DEFAULT NULL,
  `pri` int(11) DEFAULT NULL,
  `font_icon` varchar(225) DEFAULT NULL,
  `url_link` varchar(225) DEFAULT NULL,
  `act` int(11) DEFAULT NULL,
  `main_menu_id` int(11) DEFAULT NULL,
  `border_top` int(11) DEFAULT 0,
  `group_title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_sub`
--

LOCK TABLES `menu_sub` WRITE;
/*!40000 ALTER TABLE `menu_sub` DISABLE KEYS */;
INSERT INTO `menu_sub` VALUES (6,'Departments',NULL,1,NULL,'maintenance/table/department',1,15,0,NULL),(8,'System Users','List of all administrator user in the system.',3,NULL,'home/system_users',1,1,1,'Administrator Transactions'),(11,'Inventory Master List',NULL,1,NULL,'reports/inventory_masterlist',0,5,0,NULL),(24,'Designation',NULL,2,NULL,'maintenance/table/designation',1,15,0,NULL),(25,'Vendor Master List',NULL,1,NULL,'vendor/master_list',1,10,0,NULL),(30,'Cutoff',NULL,1,NULL,'posting/cutoff',1,8,0,NULL),(45,'Backup Databse',NULL,6,NULL,'bib/backup_database',0,1,0,NULL),(50,'Inventory Masterlist',NULL,1,NULL,'inventory/masterlist',1,11,1,'Inventory'),(52,'UOM Conversion',NULL,5,NULL,'inventory/uom',0,11,0,NULL),(54,'Suppliers',NULL,5,NULL,'purchasing/supplier',1,14,1,'Supplier Masterfile'),(57,'Inventory Adjustments',NULL,6,NULL,'inventory/adjustments',0,11,0,NULL),(58,'Inventory Movements',NULL,3,NULL,'reports/inventory_movement',0,5,0,NULL),(68,'Upload',NULL,7,NULL,'inventory/upload',0,11,0,NULL),(69,'Projects',NULL,3,NULL,'admin/projects',1,13,0,NULL),(76,'Masterlist (Breakdown)',NULL,2,NULL,'inventory/inventory_masterlist_breakdown',0,11,0,NULL),(82,'Inventory Report',NULL,2,NULL,'reports/inventory_report',0,5,0,NULL),(83,'Employee',NULL,4,NULL,'employee/master_list',1,1,0,NULL),(84,'Monitoring Of Materials',NULL,1,NULL,'reports/monitoring_of_materials',1,5,0,NULL),(86,'Accounts Payable',NULL,1,NULL,'accounts/accounts_payable',1,13,0,NULL),(88,'P.O. From Supplier Monitoring',NULL,2,NULL,'reports/po_supplier_monitoring',1,5,0,NULL),(89,'Clients',NULL,1,NULL,'crm/clients',1,17,1,'Clients Information'),(90,'Quotation List',NULL,3,NULL,'sales/quotations',1,14,0,NULL),(92,'Inventory Monitoring',NULL,2,NULL,'inventory/inventory_monitoring',0,11,0,NULL),(94,'Inventory - Project',NULL,3,NULL,'inventory/inventory_project',0,11,0,NULL),(95,'Overhead Cost',NULL,10,NULL,'accounts/overhead_cost',1,13,0,NULL),(96,'Overhead Cost',NULL,3,NULL,'reports/overhead_cost',1,5,0,NULL),(98,'Inventory Cost',NULL,4,NULL,'inventory/inventory_cost',0,11,0,NULL),(100,'Manpower',NULL,11,NULL,'reports/manpower',1,5,0,NULL),(101,'New Quotation',NULL,2,NULL,'sales/new_quotation',1,14,1,'Quotation Transactions'),(102,'Legalization Fees',NULL,7,NULL,'sales/legalization_fees',1,14,0,NULL),(103,'Landed Cost Rate',NULL,6,NULL,'sales/landed_cost_rate',1,14,1,'System Tables'),(104,'Confirmed Quotation',NULL,4,NULL,'sales/confirmed_quotation',1,14,0,NULL),(105,'Purchase Order',NULL,3,NULL,'purchasing/po_list',1,3,0,NULL),(106,'Create P.O.',NULL,2,NULL,'purchasing/create_po',1,3,1,'Purchase Order Transactions'),(107,'Confirmed P.O.',NULL,5,NULL,'purchasing/confirmed_po',1,3,0,NULL),(108,'Create GRV',NULL,4,NULL,'receiving/create_receiving',1,16,1,'Receiving Transactions'),(109,'GRV Records',NULL,5,NULL,'receiving/receiving_records',1,16,0,NULL),(110,'Create Sales Order',NULL,1,NULL,'outgoing/create_issuance',1,18,1,'Issueance Transactions'),(111,'Sales Order Records',NULL,2,NULL,'outgoing/issuance_records',1,18,0,NULL),(112,'Client Category',NULL,1,NULL,'maintenance/table/client_category',0,17,0,NULL),(113,'Project Progress Status',NULL,2,NULL,'maintenance/table/client_progress_status',0,17,0,NULL),(114,'Currency Rates',NULL,11,NULL,'maintenance/table/currency_rate',1,16,1,'System Tables'),(115,'Foreign Charges Types',NULL,12,NULL,'maintenance/table/foreign_charges',1,16,0,NULL),(116,'Local Charges Types',NULL,13,NULL,'maintenance/table/local_charges',1,16,0,NULL),(117,'Confirmed GRV',NULL,6,NULL,'receiving/confirmed_receiving_records',1,16,0,NULL),(118,'Confirmed Sales Order',NULL,3,NULL,'outgoing/confirm_issuance_records',1,18,0,NULL),(119,'Projects Masterlist',NULL,1,NULL,'projects/masterlist',1,19,1,'Projects Transactions'),(120,'Manpower',NULL,8,NULL,'maintenance/table/manpower',1,14,0,NULL),(121,'Terms and Condition Temaplates',NULL,9,NULL,'sales/terms_and_conditions',1,14,0,NULL),(122,'Terms and Condition Temaplates',NULL,7,NULL,'purchasing/terms_and_conditions',1,3,1,'System Tables'),(123,'Suppliers',NULL,6,NULL,'purchasing/supplier_po',1,3,1,'Supplier Masterfile'),(124,'Job Order',NULL,2,NULL,'projects/job_order',1,19,0,NULL),(125,'Financial Charges',NULL,10,NULL,'sales/financial_charges',1,14,0,NULL),(126,'Clock In/Out',NULL,3,NULL,'projects/clock_in_out',1,19,0,NULL),(127,'Create Stock Adjustments',NULL,2,NULL,'inventory/create_stock_adjustments',1,21,1,'Adjustment Transactions'),(128,'Stock Adjustments Records',NULL,3,NULL,'inventory/stock_adjustments',1,21,0,NULL),(129,'Confirmed Stock Adjustments',NULL,4,NULL,'inventory/confirmed_stock_adjustments',1,21,0,NULL),(130,'Adjustments Types',NULL,5,NULL,'maintenance/table/adjustments_types',1,21,1,'System Tables'),(131,'Create Return Inventory',NULL,6,NULL,'inventory/create_returns',1,11,1,'Return Inventory Transactions'),(132,'Return Inventory',NULL,7,'','inventory/return_inventory',1,11,0,NULL),(133,'Confirmed Return Inventory',NULL,8,NULL,'inventory/confirmed_return_inventory',1,11,0,NULL),(134,'Create CRV',NULL,1,NULL,'receipt/create_crv',1,20,1,'Cash Receipt Voucher Transactions'),(135,'CRV Records',NULL,2,NULL,'receipt/crv_records',1,20,0,NULL),(136,'Debit/Credit Type',NULL,3,NULL,'maintenance/table/debit_credit_type',1,20,1,'System Tables'),(137,'Account Receivable G/L Number',NULL,4,NULL,'maintenance/table/account_receivable',0,20,0,NULL),(138,'Cash Control Account',NULL,5,NULL,'maintenance/table/cash_control_account',0,20,0,NULL),(139,'Document Types',NULL,2,NULL,'maintenance/table/client_document_type',1,17,1,'System Tables'),(140,'Activity Type',NULL,3,NULL,'maintenance/table/client_activity_type',1,17,0,NULL),(141,'GRV Transport',NULL,20,NULL,'maintenance/table/grv_transport',1,16,0,NULL);
/*!40000 ALTER TABLE `menu_sub` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `location` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects_documents`
--

DROP TABLE IF EXISTS `projects_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects_documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `client_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects_documents`
--

LOCK TABLES `projects_documents` WRITE;
/*!40000 ALTER TABLE `projects_documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `projects_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects_job_order`
--

DROP TABLE IF EXISTS `projects_job_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects_job_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `status` int(11) DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects_job_order`
--

LOCK TABLES `projects_job_order` WRITE;
/*!40000 ALTER TABLE `projects_job_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `projects_job_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects_job_order_clock_in`
--

DROP TABLE IF EXISTS `projects_job_order_clock_in`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects_job_order_clock_in` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `loc_out` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects_job_order_clock_in`
--

LOCK TABLES `projects_job_order_clock_in` WRITE;
/*!40000 ALTER TABLE `projects_job_order_clock_in` DISABLE KEYS */;
/*!40000 ALTER TABLE `projects_job_order_clock_in` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects_job_order_labor`
--

DROP TABLE IF EXISTS `projects_job_order_labor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects_job_order_labor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `remarks` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects_job_order_labor`
--

LOCK TABLES `projects_job_order_labor` WRITE;
/*!40000 ALTER TABLE `projects_job_order_labor` DISABLE KEYS */;
/*!40000 ALTER TABLE `projects_job_order_labor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects_progress`
--

DROP TABLE IF EXISTS `projects_progress`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects_progress` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `client_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects_progress`
--

LOCK TABLES `projects_progress` WRITE;
/*!40000 ALTER TABLE `projects_progress` DISABLE KEYS */;
/*!40000 ALTER TABLE `projects_progress` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects_recent`
--

DROP TABLE IF EXISTS `projects_recent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects_recent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `client_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects_recent`
--

LOCK TABLES `projects_recent` WRITE;
/*!40000 ALTER TABLE `projects_recent` DISABLE KEYS */;
/*!40000 ALTER TABLE `projects_recent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_order`
--

DROP TABLE IF EXISTS `purchase_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `exchange_rate` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_order`
--

LOCK TABLES `purchase_order` WRITE;
/*!40000 ALTER TABLE `purchase_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchase_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_order_items`
--

DROP TABLE IF EXISTS `purchase_order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `rate_id` int(11) DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_order_items`
--

LOCK TABLES `purchase_order_items` WRITE;
/*!40000 ALTER TABLE `purchase_order_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchase_order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotations`
--

DROP TABLE IF EXISTS `quotations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `start_date` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotations`
--

LOCK TABLES `quotations` WRITE;
/*!40000 ALTER TABLE `quotations` DISABLE KEYS */;
/*!40000 ALTER TABLE `quotations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotations_items`
--

DROP TABLE IF EXISTS `quotations_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotations_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `inventory_quotation_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotations_items`
--

LOCK TABLES `quotations_items` WRITE;
/*!40000 ALTER TABLE `quotations_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `quotations_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotations_landed_cost_rate`
--

DROP TABLE IF EXISTS `quotations_landed_cost_rate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotations_landed_cost_rate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `id_orig` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotations_landed_cost_rate`
--

LOCK TABLES `quotations_landed_cost_rate` WRITE;
/*!40000 ALTER TABLE `quotations_landed_cost_rate` DISABLE KEYS */;
/*!40000 ALTER TABLE `quotations_landed_cost_rate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotations_legalization_fees`
--

DROP TABLE IF EXISTS `quotations_legalization_fees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotations_legalization_fees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `id_orig` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotations_legalization_fees`
--

LOCK TABLES `quotations_legalization_fees` WRITE;
/*!40000 ALTER TABLE `quotations_legalization_fees` DISABLE KEYS */;
/*!40000 ALTER TABLE `quotations_legalization_fees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotations_locations`
--

DROP TABLE IF EXISTS `quotations_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotations_locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotations_locations`
--

LOCK TABLES `quotations_locations` WRITE;
/*!40000 ALTER TABLE `quotations_locations` DISABLE KEYS */;
/*!40000 ALTER TABLE `quotations_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotations_others`
--

DROP TABLE IF EXISTS `quotations_others`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotations_others` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) DEFAULT NULL,
  `ds` varchar(225) DEFAULT NULL,
  `dc` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `amount` varchar(25) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_created` varchar(25) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotations_others`
--

LOCK TABLES `quotations_others` WRITE;
/*!40000 ALTER TABLE `quotations_others` DISABLE KEYS */;
INSERT INTO `quotations_others` VALUES (1,'Sub Contractor','Sub Contractor',NULL,NULL,0,NULL,NULL,NULL,NULL,NULL),(2,'Tools','Tools',NULL,NULL,0,'45',NULL,NULL,2,'2024-05-11 16:01:45'),(3,'External Manpower','External Manpower',NULL,NULL,0,NULL,NULL,NULL,NULL,NULL),(4,'Royalties','Royalties',NULL,NULL,0,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `quotations_others` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotations_package`
--

DROP TABLE IF EXISTS `quotations_package`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotations_package` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `quotation_location_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotations_package`
--

LOCK TABLES `quotations_package` WRITE;
/*!40000 ALTER TABLE `quotations_package` DISABLE KEYS */;
/*!40000 ALTER TABLE `quotations_package` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotations_package_items`
--

DROP TABLE IF EXISTS `quotations_package_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotations_package_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `quotation_location_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotations_package_items`
--

LOCK TABLES `quotations_package_items` WRITE;
/*!40000 ALTER TABLE `quotations_package_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `quotations_package_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receiving`
--

DROP TABLE IF EXISTS `receiving`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `receiving` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `grv_transport_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receiving`
--

LOCK TABLES `receiving` WRITE;
/*!40000 ALTER TABLE `receiving` DISABLE KEYS */;
/*!40000 ALTER TABLE `receiving` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receiving_fc`
--

DROP TABLE IF EXISTS `receiving_fc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `receiving_fc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `receiving_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receiving_fc`
--

LOCK TABLES `receiving_fc` WRITE;
/*!40000 ALTER TABLE `receiving_fc` DISABLE KEYS */;
/*!40000 ALTER TABLE `receiving_fc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receiving_items`
--

DROP TABLE IF EXISTS `receiving_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `receiving_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `bad_qty` int(11) DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receiving_items`
--

LOCK TABLES `receiving_items` WRITE;
/*!40000 ALTER TABLE `receiving_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `receiving_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receiving_lc`
--

DROP TABLE IF EXISTS `receiving_lc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `receiving_lc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `receiving_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receiving_lc`
--

LOCK TABLES `receiving_lc` WRITE;
/*!40000 ALTER TABLE `receiving_lc` DISABLE KEYS */;
/*!40000 ALTER TABLE `receiving_lc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timezone` varchar(225) DEFAULT NULL,
  `currency` varchar(225) DEFAULT NULL,
  `language` varchar(225) DEFAULT NULL,
  `depriciation_cutoff` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'Asia/Manila','8369;','1',0);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `landed_cost_rate_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliers`
--

LOCK TABLES `suppliers` WRITE;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
INSERT INTO `suppliers` VALUES (1,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Pan-Acoustics',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7),(2,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'QSC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7),(3,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'K&M',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7),(4,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Soundcraft',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7),(5,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Shure',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7),(6,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Denon',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7),(7,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Custom',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7),(8,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Peerless AV',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7),(9,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Daktronics',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(10,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'TP-LINK',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7),(11,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Lightware',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(12,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'LYNX TECHNIK',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(13,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Mersive',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7),(14,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Logitech',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7),(15,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Aver',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7),(16,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Black Magic',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(17,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Luminex',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7),(18,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Apple',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7),(19,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'SDS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3),(20,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Chamsys',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7),(21,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'PC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7),(22,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Chauvet',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7),(23,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Middle Atlantic',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7),(24,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Canare',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(25,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Brightsign',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7),(26,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'LG',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7),(27,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'ClearCom',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7),(28,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'ENTTEC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(29,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'LogicAV',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7),(30,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Dell',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7),(31,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Olson',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7),(32,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Barco',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7),(33,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Sonifex',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(34,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Genelec',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(35,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Arista',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(36,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Audinate',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(37,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Lindy',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7),(38,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'AppSpace',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,8),(39,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'TASCAM',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(40,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'TOA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7),(41,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Autonomic',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(42,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'William AV',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7),(43,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'SwimPro',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(44,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Colorado Time Systems',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(45,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'L-Acoustics',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7),(46,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'AVFI',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(47,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Epson',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7),(48,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Da-Lite',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7),(49,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Roland',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(50,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Gefen',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(51,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Ayrton',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7),(52,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Eurotruss',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7),(53,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Chain Master',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7),(54,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'Percon',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(55,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'VDC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(56,'2023-12-05 19:17',2,0,'',NULL,'',NULL,'CBT',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(57,'2024-05-12 19:16',2,0,'',NULL,'',NULL,'new',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(58,'2024-05-12 19:17',2,0,'',NULL,'',NULL,'new',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(59,'2024-05-12 19:37',2,0,'',NULL,'',NULL,'Supplier AAA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppliers_po`
--

DROP TABLE IF EXISTS `suppliers_po`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suppliers_po` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliers_po`
--

LOCK TABLES `suppliers_po` WRITE;
/*!40000 ALTER TABLE `suppliers_po` DISABLE KEYS */;
INSERT INTO `suppliers_po` VALUES (1,'2023-12-05 20:50:51',2,0,'',NULL,'',NULL,'Supplier Test 1','','','','','',NULL,NULL,NULL,'apple@gmail.com','Mohammad Saleh',''),(2,'2023-12-05 20:52:01',2,0,'',NULL,'',NULL,'Supplier Test 2','','','','','',NULL,NULL,NULL,'laccoustics@mail.com','Mohhamad Fali','');
/*!40000 ALTER TABLE `suppliers_po` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `terms_and_conditions`
--

DROP TABLE IF EXISTS `terms_and_conditions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `terms_and_conditions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_created` varchar(25) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0,
  `date_deleted` varchar(25) DEFAULT '',
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` varchar(25) DEFAULT '',
  `modified_by` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `type` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `terms_and_conditions`
--

LOCK TABLES `terms_and_conditions` WRITE;
/*!40000 ALTER TABLE `terms_and_conditions` DISABLE KEYS */;
INSERT INTO `terms_and_conditions` VALUES (1,'2023-09-13',2,0,'',NULL,'2023-09-13',2,'<div><font color=\"#2697de\"><span style=\"font-weight: 700;\">Terms and Conditions: </span></font></div><div><span style=\"font-weight: 700;\"><font color=\"#2697de\">1-</font></span> Supply, Delivery, Installation, Testing and Commission of the above AV system.</div><div><font color=\"#2697de\">2- </font>The above design is based on the provided layout drawing, BoQ, and specification.</div><div><font color=\"#2697de\"><span style=\"font-weight: 700;\">3- </span></font>Civil, structural works, conduits and cable pulling not mentioned on the quotes are excluded.</div><div><font color=\"#2697de\">5- </font>Any Changes in the mentioned quantity will be considered as a variation </div><div><font color=\"#2697de\"><span style=\"font-weight: 700;\">6- Payment: - </span></font>50% advance against order confirmation.</div><div>- 40% against material delivery to site.</div><div>- 10% immediately after completion. </div><div><font color=\"#2697de\"><span style=\"font-weight: 700;\">7-</span></font> Warranty: The sole warranty for the supplied material is the original equipment manufacturer warranty against manufacturing defects only. </div><div><span style=\"font-weight: 700;\"><font color=\"#2697de\">8-</font></span> Delivery: TBA as per project schedule. </div><div><span style=\"font-weight: 700;\"><font color=\"#2697de\">9-</font></span> All approvals and site access, scaffolding for Ventum to complete its scope of work is the client’s responsibility. </div><div><span style=\"font-weight: 700;\"><font color=\"#2697de\">10-</font></span> If PO is issued it cannot be revoked for any reason. Advance payments are not reimbursed. Ventum is not responsible for any delay that may occur due to material shortage or shipping equipment or no space availability.</div><div>12- The above prices are applicable to the above package offer. Individual items are priced differently. Errors and omissions are excluded.</div>','template 1','quotation'),(2,'2023-09-13',2,0,'',NULL,'2023-09-13',2,'<div><font color=\"#2697de\"><b>Terms and Conditions: </b></font></div><div><b><font color=\"#2697de\">1-</font></b> Supply, Delivery, Installation, Testing and Commission of the above AV system.</div><div><font color=\"#2697de\">2- </font>The above design is based on the provided layout drawing, BoQ, and specification.</div><div><font color=\"#2697de\"><b>3- </b></font>Civil, structural works, conduits and cable pulling not mentioned on the quotes are excluded.</div><div><font color=\"#2697de\">5- </font>Any Changes in the mentioned quantity will be considered as a variation </div><div><font color=\"#2697de\"><b>6- Payment: - </b></font>50% advance against order confirmation.</div><div>- 40% against material delivery to site.</div><div>- 10% immediately after completion. </div><div><font color=\"#2697de\"><b>7-</b></font> Warranty: The sole warranty for the supplied material is the original equipment manufacturer warranty against manufacturing defects only. <b><font color=\"#2697de\">8-</font></b> Delivery: TBA as per project schedule. </div><div><font color=\"#2697de\"><b> </b></font></div>','template 2','quotation'),(3,'2023-09-13',2,0,'',NULL,'2023-09-13',2,'<div><font color=\"#2697de\"><span style=\"font-weight: 700;\">Terms and Conditions: </span></font></div><div><span style=\"font-weight: 700;\"><font color=\"#2697de\">1-</font></span> Supply, Delivery, Installation, Testing and Commission of the above AV system.</div><div><font color=\"#2697de\">2- </font>The above design is based on the provided layout drawing, BoQ, and specification.</div><div><font color=\"#2697de\"><span style=\"font-weight: 700;\">3- </span></font>Civil, structural works, conduits and cable pulling not mentioned on the quotes are excluded.</div><div><font color=\"#2697de\"> </font></div>','template 3','quotation'),(4,'2023-09-17',2,0,'',NULL,'2023-09-20',2,'<font color=\"#2697de\">T<b>erms &amp; Conditions:&nbsp;</b></font><div>1- Invoices to be issued in the name of Ventum Tech Security Systems and Services.&nbsp;</div><div>2- Payment Terms: As per agreement&nbsp;</div><div>3- Delivery: Immediate&nbsp;</div><div>4- If no PO confirmation nor comments/remarks are received within 2 working days from official PO transmittal date, this PO including all its content is considered in effect.&nbsp;</div><div>5- Ventum Tech is not held responsible in any way for not accepting the goods or services described above if it proves to be not conforming to the agreement and specifications or late delivery.</div>','Template 1','po'),(5,'2023-09-17',2,0,'',NULL,'2023-09-20',2,'<b><font color=\"#2697de\">Terms &amp; Conditions:&nbsp;</font></b><div><font color=\"#2697de\">1- </font>Invoices to be issued in the name of Ventum Tech Security Systems and Services.&nbsp;</div><div><font color=\"#2697de\">2-</font> Payment Terms: As per agreement&nbsp;</div><div><font color=\"#2697de\">3-</font> Delivery: Immediate&nbsp;</div><div><font color=\"#2697de\">4-</font> If no PO confirmation nor comments/remarks are received within 2 working days from official PO transmittal date, this PO including all its content is considered in effect.&nbsp;&nbsp;</div>','Template 2','po');
/*!40000 ALTER TABLE `terms_and_conditions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `theme`
--

DROP TABLE IF EXISTS `theme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `side_bar_drawer` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `theme`
--

LOCK TABLES `theme` WRITE;
/*!40000 ALTER TABLE `theme` DISABLE KEYS */;
INSERT INTO `theme` VALUES (1,'#0a1285','#05057a','#0e2581','#05316b','#254aa2','#1a6dad','#3b83b0','#133d90','#3f99de','#699bdd','#94a8e5','#48a4f9','#8d92aa','#dfaf49','#d2c46a','#ea4d4d','#990f0f','#85c7f9','#47bad7','sm');
/*!40000 ALTER TABLE `theme` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `sub_menu_id` int(11) NOT NULL,
  `main_menu_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2011 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_roles`
--

LOCK TABLES `user_roles` WRITE;
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
INSERT INTO `user_roles` VALUES (494,10,7,3),(495,10,43,4),(496,10,53,3),(497,10,54,3),(498,10,77,3),(499,10,79,3),(500,10,88,5),(501,10,100,5),(502,11,6,2),(503,11,7,3),(504,11,8,1),(505,11,14,6),(506,11,24,2),(507,11,43,4),(508,11,44,4),(509,11,45,1),(510,11,50,11),(511,11,52,11),(512,11,53,3),(513,11,54,3),(514,11,56,6),(515,11,57,11),(516,11,60,2),(517,11,61,2),(518,11,62,2),(519,11,63,2),(520,11,64,2),(521,11,66,12),(522,11,67,12),(523,11,68,11),(524,11,69,13),(525,11,70,1),(526,11,71,2),(527,11,72,2),(528,11,73,2),(529,11,74,2),(530,11,75,2),(531,11,77,3),(532,11,78,2),(533,11,79,3),(534,11,80,2),(535,11,81,2),(536,11,83,1),(537,11,84,5),(538,11,85,2),(539,11,86,13),(540,11,87,13),(541,11,88,5),(542,11,89,14),(543,11,90,14),(544,11,91,2),(545,11,92,11),(546,11,93,6),(547,11,94,11),(548,11,95,13),(549,11,96,5),(550,11,97,2),(551,11,98,11),(552,11,99,2),(553,11,100,5),(554,12,6,2),(555,12,7,3),(556,12,8,1),(557,12,14,6),(558,12,24,2),(559,12,43,4),(560,12,44,4),(561,12,45,1),(562,12,50,11),(563,12,52,11),(564,12,53,3),(565,12,54,3),(566,12,56,6),(567,12,57,11),(568,12,60,2),(569,12,61,2),(570,12,62,2),(571,12,63,2),(572,12,64,2),(573,12,66,12),(574,12,67,12),(575,12,68,11),(576,12,69,13),(577,12,70,1),(578,12,71,2),(579,12,72,2),(580,12,73,2),(581,12,74,2),(582,12,75,2),(583,12,77,3),(584,12,78,2),(585,12,79,3),(586,12,80,2),(587,12,81,2),(588,12,83,1),(589,12,84,5),(590,12,85,2),(591,12,86,13),(592,12,87,13),(593,12,88,5),(594,12,89,14),(595,12,90,14),(596,12,91,2),(597,12,92,11),(598,12,93,6),(599,12,94,11),(600,12,95,13),(601,12,96,5),(602,12,97,2),(603,12,98,11),(604,12,99,2),(605,12,100,5),(606,13,6,2),(607,13,7,3),(608,13,14,6),(609,13,24,2),(610,13,53,3),(611,13,54,3),(612,13,56,6),(613,13,60,2),(614,13,61,2),(615,13,62,2),(616,13,63,2),(617,13,64,2),(618,13,69,13),(619,13,71,2),(620,13,72,2),(621,13,73,2),(622,13,74,2),(623,13,75,2),(624,13,77,3),(625,13,78,2),(626,13,79,3),(627,13,80,2),(628,13,81,2),(629,13,85,2),(630,13,86,13),(631,13,87,13),(632,13,91,2),(633,13,93,6),(634,13,97,2),(635,13,99,2),(636,14,69,13),(637,14,89,14),(638,14,90,14),(639,15,69,13),(640,15,89,14),(641,15,90,14),(642,16,43,4),(643,16,44,4),(644,17,43,4),(645,17,44,4),(646,18,43,4),(647,18,44,4),(648,19,43,4),(649,19,44,4),(650,20,43,4),(651,20,44,4),(652,21,86,13),(653,21,87,13),(654,22,86,13),(655,22,87,13),(656,23,14,6),(657,23,56,6),(658,23,66,12),(659,23,67,12),(660,23,93,6),(661,24,14,6),(662,24,56,6),(663,24,66,12),(664,24,67,12),(665,24,93,6),(666,25,14,6),(667,25,56,6),(668,25,66,12),(669,25,67,12),(670,25,93,6),(671,26,6,2),(672,26,7,3),(673,26,8,1),(674,26,14,6),(675,26,24,2),(676,26,43,4),(677,26,44,4),(678,26,45,1),(679,26,50,11),(680,26,52,11),(681,26,53,3),(682,26,54,3),(683,26,56,6),(684,26,57,11),(685,26,60,2),(686,26,61,2),(687,26,62,2),(688,26,63,2),(689,26,64,2),(690,26,66,12),(691,26,67,12),(692,26,68,11),(693,26,69,13),(694,26,70,1),(695,26,71,2),(696,26,72,2),(697,26,73,2),(698,26,74,2),(699,26,75,2),(700,26,77,3),(701,26,78,2),(702,26,79,3),(703,26,80,2),(704,26,81,2),(705,26,83,1),(706,26,84,5),(707,26,85,2),(708,26,86,13),(709,26,87,13),(710,26,88,5),(711,26,89,14),(712,26,90,14),(713,26,91,2),(714,26,92,11),(715,26,93,6),(716,26,94,11),(717,26,95,13),(718,26,96,5),(719,26,97,2),(720,26,98,11),(721,26,99,2),(722,26,100,5),(1747,28,105,3),(1748,28,106,3),(1749,28,107,3),(1750,28,119,19),(1751,28,122,3),(1752,28,123,3),(1753,29,8,1),(1754,29,50,11),(1755,29,54,14),(1756,29,83,1),(1757,29,89,17),(1758,29,90,14),(1759,29,101,14),(1760,29,102,14),(1761,29,103,14),(1762,29,104,14),(1763,29,105,3),(1764,29,106,3),(1765,29,107,3),(1766,29,108,16),(1767,29,109,16),(1768,29,110,18),(1769,29,111,18),(1770,29,114,16),(1771,29,115,16),(1772,29,116,16),(1773,29,117,16),(1774,29,118,18),(1775,29,119,19),(1776,29,120,14),(1777,29,121,14),(1778,29,122,3),(1779,29,123,3),(1780,29,124,19),(1781,29,125,14),(1782,29,126,19),(1783,29,127,21),(1784,29,128,21),(1785,29,129,21),(1786,29,130,21),(1787,29,131,11),(1788,29,132,11),(1789,29,133,11),(1790,29,134,20),(1791,29,135,20),(1792,29,136,20),(1793,29,139,17),(1794,29,140,17),(1795,30,54,14),(1796,30,89,17),(1797,30,102,14),(1798,30,103,14),(1799,30,104,14),(1800,30,120,14),(1801,30,121,14),(1802,30,125,14),(1803,30,134,20),(1804,30,135,20),(1805,30,136,20),(1806,30,139,17),(1807,30,140,17),(1825,32,50,11),(1826,32,105,3),(1827,32,106,3),(1828,32,107,3),(1829,32,122,3),(1830,32,123,3),(1831,33,54,14),(1832,33,89,17),(1833,33,90,14),(1834,33,101,14),(1835,33,102,14),(1836,33,103,14),(1837,33,104,14),(1838,33,119,19),(1839,33,120,14),(1840,33,121,14),(1841,33,124,19),(1842,33,125,14),(1843,33,126,19),(1844,33,139,17),(1845,33,140,17),(1846,34,54,14),(1847,34,83,1),(1848,34,89,17),(1849,34,90,14),(1850,34,101,14),(1851,34,102,14),(1852,34,103,14),(1853,34,104,14),(1854,34,119,19),(1855,34,120,14),(1856,34,121,14),(1857,34,124,19),(1858,34,125,14),(1859,34,126,19),(1860,34,134,20),(1861,34,135,20),(1862,34,136,20),(1863,34,139,17),(1864,34,140,17),(1865,31,50,11),(1866,31,108,16),(1867,31,109,16),(1868,31,110,18),(1869,31,111,18),(1870,31,114,16),(1871,31,115,16),(1872,31,116,16),(1873,31,117,16),(1874,31,118,18),(1875,31,127,21),(1876,31,128,21),(1877,31,129,21),(1878,31,130,21),(1879,31,131,11),(1880,31,132,11),(1881,31,133,11),(1882,2,8,1),(1883,2,50,11),(1884,2,54,14),(1885,2,83,1),(1886,2,89,17),(1887,2,90,14),(1888,2,101,14),(1889,2,102,14),(1890,2,103,14),(1891,2,104,14),(1892,2,105,3),(1893,2,106,3),(1894,2,107,3),(1895,2,108,16),(1896,2,109,16),(1897,2,110,18),(1898,2,111,18),(1899,2,114,16),(1900,2,115,16),(1901,2,116,16),(1902,2,117,16),(1903,2,118,18),(1904,2,119,19),(1905,2,120,14),(1906,2,121,14),(1907,2,122,3),(1908,2,123,3),(1909,2,124,19),(1910,2,125,14),(1911,2,126,19),(1912,2,127,21),(1913,2,128,21),(1914,2,129,21),(1915,2,130,21),(1916,2,131,11),(1917,2,132,11),(1918,2,133,11),(1919,2,134,20),(1920,2,135,20),(1921,2,136,20),(1922,2,139,17),(1923,2,140,17),(1924,2,141,16),(1925,35,8,1),(1926,35,50,11),(1927,35,54,14),(1928,35,83,1),(1929,35,89,17),(1930,35,90,14),(1931,35,101,14),(1932,35,102,14),(1933,35,103,14),(1934,35,104,14),(1935,35,105,3),(1936,35,106,3),(1937,35,107,3),(1938,35,108,16),(1939,35,109,16),(1940,35,110,18),(1941,35,111,18),(1942,35,114,16),(1943,35,115,16),(1944,35,116,16),(1945,35,117,16),(1946,35,118,18),(1947,35,119,19),(1948,35,120,14),(1949,35,121,14),(1950,35,122,3),(1951,35,123,3),(1952,35,124,19),(1953,35,125,14),(1954,35,126,19),(1955,35,127,21),(1956,35,128,21),(1957,35,129,21),(1958,35,130,21),(1959,35,131,11),(1960,35,132,11),(1961,35,133,11),(1962,35,134,20),(1963,35,135,20),(1964,35,136,20),(1965,35,139,17),(1966,35,140,17),(1967,35,141,16),(1968,36,8,1),(1969,36,50,11),(1970,36,54,14),(1971,36,83,1),(1972,36,89,17),(1973,36,90,14),(1974,36,101,14),(1975,36,102,14),(1976,36,103,14),(1977,36,104,14),(1978,36,105,3),(1979,36,106,3),(1980,36,107,3),(1981,36,108,16),(1982,36,109,16),(1983,36,110,18),(1984,36,111,18),(1985,36,114,16),(1986,36,115,16),(1987,36,116,16),(1988,36,117,16),(1989,36,118,18),(1990,36,119,19),(1991,36,120,14),(1992,36,121,14),(1993,36,122,3),(1994,36,123,3),(1995,36,124,19),(1996,36,125,14),(1997,36,126,19),(1998,36,127,21),(1999,36,128,21),(2000,36,129,21),(2001,36,130,21),(2002,36,131,11),(2003,36,132,11),(2004,36,133,11),(2005,36,134,20),(2006,36,135,20),(2007,36,136,20),(2008,36,139,17),(2009,36,140,17),(2010,36,141,16);
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-02 13:51:20

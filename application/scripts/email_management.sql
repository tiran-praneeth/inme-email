-- MySQL dump 10.13  Distrib 5.7.18, for Linux (x86_64)
--
-- Host: localhost    Database: email_management
-- ------------------------------------------------------
-- Server version	5.7.18-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `application`
--

DROP TABLE IF EXISTS `application`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `application` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_name` varchar(100) NOT NULL,
  `app_code` varchar(100) NOT NULL,
  `auth_code` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lastmodified_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `auth_code_UNIQUE` (`auth_code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application`
--

LOCK TABLES `application` WRITE;
/*!40000 ALTER TABLE `application` DISABLE KEYS */;
INSERT INTO `application` VALUES (1,'Online','001','7b5660e0b3a14cc94c26f155c3449995','2017-07-03 10:11:52',NULL,1),(2,'InsureMe','002','201ecd0115fe56ce8f912f4960862159','2017-07-03 10:11:52',NULL,1),(3,'Commercial Credit','003','8b881c70c36f50f54229d95fbaa79725','2017-07-03 10:11:52',NULL,1);
/*!40000 ALTER TABLE `application` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_function_template`
--

DROP TABLE IF EXISTS `email_function_template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_function_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_code` varchar(100) NOT NULL,
  `function_name` varchar(100) NOT NULL,
  `receiver_code` varchar(100) NOT NULL COMMENT 'INSURANCE / BROKER',
  `email_subject` varchar(100) DEFAULT NULL,
  `email_header` text,
  `email_body` text,
  `email_footer` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lastmodified_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_function_template`
--

LOCK TABLES `email_function_template` WRITE;
/*!40000 ALTER TABLE `email_function_template` DISABLE KEYS */;
INSERT INTO `email_function_template` VALUES (1,'001','CVN_SUCCESS_INSURANCE','INSURANCE','Cover Confirmation','assets/images/email/email_header.png','{\"lib_name\":\"covernote_insurance\",\"lib_function\":\"generate_covernote_success_html\",\"template_name\":\"insureme_template\"}','assets/images/email/email_footer.png','2017-02-02 06:37:59',NULL,1),(2,'001','CVN_SUCCESS_BROKER','BROKER','Cover Confirmation','assets/images/email/email_header.png','{\"lib_name\":\"covernote_insurance\",\"lib_function\":\"generate_covernote_success_html\",\"template_name\":\"insureme_template\"}','assets/images/email/email_footer.png','2017-02-02 06:39:18',NULL,1),(3,'001','CVN_SUCCESS_CUSTOMER','CUSTOMER','Cover Confirmation','assets/images/email/email_header.png','{\"lib_name\":\"covernote_customer\",\"lib_function\":\"generate_covernote_success_html\",\"template_name\":\"insureme_template\"}','assets/images/email/email_footer.png','2017-02-02 06:39:18',NULL,1),(4,'002','CVN_SUCCESS_INSURANCE','INSURANCE','Cover Confirmation','assets/images/email/email_header.png','{\"lib_name\":\"covernote_insurance\",\"lib_function\":\"generate_covernote_success_html\",\"template_name\":\"insureme_template\"}','assets/images/email/email_footer.png','2017-02-02 06:37:59',NULL,1),(5,'002','CVN_SUCCESS_BROKER','BROKER','Cover Confirmation','assets/images/email/email_header.png','{\"lib_name\":\"covernote_insurance\",\"lib_function\":\"generate_covernote_success_html\",\"template_name\":\"insureme_template\"}','assets/images/email/email_footer.png','2017-02-02 06:39:18',NULL,1),(6,'002','CVN_SUCCESS_CUSTOMER','CUSTOMER','Cover Confirmation','assets/images/email/email_header.png','{\"lib_name\":\"covernote_customer\",\"lib_function\":\"generate_covernote_success_html\",\"template_name\":\"insureme_template\"}','assets/images/email/email_footer.png','2017-02-02 06:39:18',NULL,1),(7,'001','QUO_BOOK_BROKER','BROKER','Booking Confirmation','assets/images/email/email_header.png','{\"lib_name\":\"booking_quotation_broker\",\"lib_function\":\"generate_Booking_quotation_html\",\"template_name\":\"insureme_template\"}','assets/images/email/email_footer.png','2017-02-02 06:39:18',NULL,1),(8,'001','QUO_BOOK_CUSTOMER','CUSTOMER','Booking Confirmation','assets/images/email/email_header.png','{\"lib_name\":\"booking_quotation_customer\",\"lib_function\":\"generate_Booking_quotation_html\",\"template_name\":\"insureme_template\"}','assets/images/email/email_footer.png','2017-02-02 06:39:18',NULL,1);
/*!40000 ALTER TABLE `email_function_template` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instant_email_queue`
--

DROP TABLE IF EXISTS `instant_email_queue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instant_email_queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_code` varchar(100) NOT NULL COMMENT 'application code',
  `email_template` varchar(100) NOT NULL COMMENT 'email template name',
  `primary_email` text NOT NULL COMMENT 'primary email json array',
  `cc_email` text COMMENT 'cc email json array',
  `bcc_email` text COMMENT 'bcc email json array',
  `email_data` text COMMENT 'email data json array',
  `attached_url` text COMMENT 'attached url json array',
  `email_batch_no` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = pending, 1 = delivered, 3 = failed',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instant_email_queue`
--

LOCK TABLES `instant_email_queue` WRITE;
/*!40000 ALTER TABLE `instant_email_queue` DISABLE KEYS */;
/*!40000 ALTER TABLE `instant_email_queue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seq_instant_email_no`
--

DROP TABLE IF EXISTS `seq_instant_email_no`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seq_instant_email_no` (
  `current_date` date NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`current_date`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seq_instant_email_no`
--

LOCK TABLES `seq_instant_email_no` WRITE;
/*!40000 ALTER TABLE `seq_instant_email_no` DISABLE KEYS */;
/*!40000 ALTER TABLE `seq_instant_email_no` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-07 13:00:57

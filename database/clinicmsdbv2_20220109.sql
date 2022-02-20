-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: clinicmsdbv2
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.14-MariaDB

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
-- Table structure for table `allergy_medication_history`
--

DROP TABLE IF EXISTS `allergy_medication_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `allergy_medication_history` (
  `allergy_medication_history_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `medical_history_id` bigint(20) DEFAULT NULL,
  `patient_id` bigint(20) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `reaction` text DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`allergy_medication_history_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `allergy_medication_history`
--

LOCK TABLES `allergy_medication_history` WRITE;
/*!40000 ALTER TABLE `allergy_medication_history` DISABLE KEYS */;
INSERT INTO `allergy_medication_history` VALUES (1,1,2,'test',NULL,0,'2022-01-09 02:51:16','2022-01-09 02:51:16'),(2,1,2,'test',NULL,0,'2022-01-09 02:51:16','2022-01-09 02:51:16'),(3,2,4,'test','test',0,'2022-01-09 02:55:50','2022-01-09 02:55:50');
/*!40000 ALTER TABLE `allergy_medication_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `announcements` (
  `announcement_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`announcement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcements`
--

LOCK TABLES `announcements` WRITE;
/*!40000 ALTER TABLE `announcements` DISABLE KEYS */;
/*!40000 ALTER TABLE `announcements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `care_equipments`
--

DROP TABLE IF EXISTS `care_equipments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_equipments` (
  `care_equipment_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `unit_id` bigint(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `reorder` int(11) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`care_equipment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `care_equipments`
--

LOCK TABLES `care_equipments` WRITE;
/*!40000 ALTER TABLE `care_equipments` DISABLE KEYS */;
INSERT INTO `care_equipments` VALUES (1,'Elastic Bandage',5,NULL,10,1000,0,'2022-01-01 13:52:20','2022-01-08 06:23:44'),(2,'Gauze Pad',5,NULL,NULL,NULL,0,'2022-01-01 13:52:33','2022-01-01 13:52:33'),(3,'Lysol Disinfectant Spray',4,NULL,NULL,NULL,0,'2022-01-01 13:52:50','2022-01-01 13:52:50'),(4,'Alcohol',4,NULL,NULL,NULL,0,'2022-01-01 13:53:06','2022-01-01 13:53:06'),(5,'Gloves',1,NULL,NULL,NULL,0,'2022-01-01 13:53:13','2022-01-01 13:53:13');
/*!40000 ALTER TABLE `care_equipments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `category_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'test2',1,'2022-01-08 05:54:50','2022-01-08 05:55:04'),(2,'test',0,'2022-01-08 05:55:00','2022-01-08 05:55:00');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `check_up_care_equipments`
--

DROP TABLE IF EXISTS `check_up_care_equipments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `check_up_care_equipments` (
  `check_up_care_equipment_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `check_up_id` bigint(20) DEFAULT NULL,
  `patient_id` bigint(20) DEFAULT NULL,
  `care_equipment_id` bigint(20) DEFAULT NULL,
  `quantity` decimal(15,2) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`check_up_care_equipment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `check_up_care_equipments`
--

LOCK TABLES `check_up_care_equipments` WRITE;
/*!40000 ALTER TABLE `check_up_care_equipments` DISABLE KEYS */;
INSERT INTO `check_up_care_equipments` VALUES (1,8,2,2,50.00,0,'2022-01-09 02:51:15','2022-01-09 02:51:15'),(2,9,4,2,5.00,0,'2022-01-09 02:55:49','2022-01-09 02:55:49');
/*!40000 ALTER TABLE `check_up_care_equipments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `check_up_medicines`
--

DROP TABLE IF EXISTS `check_up_medicines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `check_up_medicines` (
  `check_up_medicine_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `check_up_id` bigint(20) DEFAULT NULL,
  `patient_id` bigint(20) DEFAULT NULL,
  `medicine_id` bigint(20) DEFAULT NULL,
  `quantity` decimal(15,2) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`check_up_medicine_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `check_up_medicines`
--

LOCK TABLES `check_up_medicines` WRITE;
/*!40000 ALTER TABLE `check_up_medicines` DISABLE KEYS */;
INSERT INTO `check_up_medicines` VALUES (1,8,2,2,10.00,0,'2022-01-09 02:51:15','2022-01-09 02:51:15'),(2,9,4,3,10.00,0,'2022-01-09 02:55:49','2022-01-09 02:55:49'),(3,10,1,2,5.00,0,'2022-01-09 03:44:42','2022-01-09 03:44:42'),(4,10,1,4,5.00,0,'2022-01-09 03:44:42','2022-01-09 03:44:42');
/*!40000 ALTER TABLE `check_up_medicines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `check_up_treatments`
--

DROP TABLE IF EXISTS `check_up_treatments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `check_up_treatments` (
  `check_up_treatment_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `check_up_id` bigint(20) DEFAULT NULL,
  `tooth_number` int(11) DEFAULT NULL,
  `status` text DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`check_up_treatment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `check_up_treatments`
--

LOCK TABLES `check_up_treatments` WRITE;
/*!40000 ALTER TABLE `check_up_treatments` DISABLE KEYS */;
/*!40000 ALTER TABLE `check_up_treatments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `check_ups`
--

DROP TABLE IF EXISTS `check_ups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `check_ups` (
  `check_up_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `clinic_appointment_id` bigint(20) DEFAULT NULL,
  `service_id` bigint(20) DEFAULT NULL,
  `patient_id` bigint(20) DEFAULT NULL,
  `temperature` varchar(45) DEFAULT NULL,
  `pulse_rate` varchar(45) DEFAULT NULL,
  `respiratory_rate` varchar(45) DEFAULT NULL,
  `blood_pressure` varchar(45) DEFAULT NULL,
  `random_blood_sugar` varchar(45) DEFAULT NULL,
  `others` text DEFAULT NULL,
  `recommendation` text DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`check_up_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `check_ups`
--

LOCK TABLES `check_ups` WRITE;
/*!40000 ALTER TABLE `check_ups` DISABLE KEYS */;
INSERT INTO `check_ups` VALUES (1,5,1,2,'38.59','test','test','test','test','test','test',0,'2022-01-09 02:38:30','2022-01-09 02:38:30'),(2,5,1,2,'38.59','test','test','test','test','test','test',0,'2022-01-09 02:39:01','2022-01-09 02:39:01'),(3,5,1,2,'38.59','test','test','test','test','test','test',0,'2022-01-09 02:39:28','2022-01-09 02:39:28'),(4,5,1,2,'38.59','test','test','test','test','test','test',0,'2022-01-09 02:39:57','2022-01-09 02:39:57'),(5,5,1,2,'38.59','test','test','test','test','test','test',0,'2022-01-09 02:41:23','2022-01-09 02:41:23'),(6,5,1,2,'38.59','test','test','test','test','test','test',0,'2022-01-09 02:41:45','2022-01-09 02:41:45'),(7,5,1,2,'38.59','test','test','test','test','test','test',0,'2022-01-09 02:43:06','2022-01-09 02:43:06'),(8,5,1,2,'45.00','test','test','test','test','test','test',0,'2022-01-09 02:51:15','2022-01-09 02:51:15'),(9,4,1,4,'50.00','test','test','test','test','test','test',0,'2022-01-09 02:55:49','2022-01-09 02:55:49'),(10,0,3,1,'21.00','10','10','10','10','10','test',0,'2022-01-09 03:44:42','2022-01-09 03:44:42');
/*!40000 ALTER TABLE `check_ups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clinic_appointments`
--

DROP TABLE IF EXISTS `clinic_appointments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clinic_appointments` (
  `clinic_appointment_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `patient_id` bigint(20) DEFAULT NULL,
  `service_id` bigint(20) DEFAULT NULL,
  `purpose` text DEFAULT NULL,
  `date_appointment` date DEFAULT NULL,
  `is_done` int(11) DEFAULT 0,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`clinic_appointment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clinic_appointments`
--

LOCK TABLES `clinic_appointments` WRITE;
/*!40000 ALTER TABLE `clinic_appointments` DISABLE KEYS */;
INSERT INTO `clinic_appointments` VALUES (1,1,2,'TEST','2021-12-13',1,0,'2021-12-05 05:35:10','2022-01-05 12:35:31'),(2,1,2,'test','2021-12-03',0,1,'2021-12-05 11:49:28','2021-12-05 11:49:36'),(3,2,1,'test','2022-01-08',1,0,'2022-01-08 09:30:51','2022-01-08 09:30:59'),(4,4,1,'test','2022-01-09',1,0,'2022-01-09 00:53:21','2022-01-09 00:53:21'),(5,2,1,'tesst','2022-01-09',2,0,'2022-01-09 01:17:19','2022-01-09 04:24:55'),(6,2,1,'test','2022-01-19',0,1,'2022-01-09 02:43:07','2022-01-09 02:56:45'),(7,2,1,'test','2022-01-19',0,0,'2022-01-09 02:51:16','2022-01-09 02:51:16'),(8,4,1,'test','2022-01-10',0,0,'2022-01-09 02:55:50','2022-01-09 02:55:50');
/*!40000 ALTER TABLE `clinic_appointments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clinical_case_records`
--

DROP TABLE IF EXISTS `clinical_case_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clinical_case_records` (
  `clinical_case_record_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `check_up_id` bigint(20) DEFAULT NULL,
  `patient_id` bigint(20) DEFAULT NULL,
  `health_complaint` text DEFAULT NULL,
  `treatment` text DEFAULT NULL,
  `schedule` date DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`clinical_case_record_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clinical_case_records`
--

LOCK TABLES `clinical_case_records` WRITE;
/*!40000 ALTER TABLE `clinical_case_records` DISABLE KEYS */;
INSERT INTO `clinical_case_records` VALUES (1,8,2,'test','test','2022-01-19',0,'2022-01-09 02:51:16','2022-01-09 02:51:16'),(2,9,4,'test','test','2022-01-10',0,'2022-01-09 02:55:50','2022-01-09 02:55:50');
/*!40000 ALTER TABLE `clinical_case_records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses` (
  `course_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `abbreviation` varchar(45) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,'BSIT','Bachelor of Science Major in Information Technology',0,'2021-12-03 00:13:03','2021-12-03 00:13:03'),(2,'BSCpE','Bachelor of Science Major in Computer Engineering',0,'2021-12-03 00:13:03','2021-12-03 00:13:03'),(3,'BSECE','Bachelor of Science Major in Electronics',0,'2021-12-03 00:13:03','2021-12-03 00:13:03'),(4,'BSCS','Bachelor of Science Major in Computer Science',1,'2021-12-30 07:20:02','2021-12-30 07:20:57');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dental_certificates`
--

DROP TABLE IF EXISTS `dental_certificates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dental_certificates` (
  `dental_certificate_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `patient_id` bigint(20) DEFAULT NULL,
  `date_header` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `sign_name` varchar(45) DEFAULT NULL,
  `sign_note` varchar(255) DEFAULT NULL,
  `comment_name` varchar(45) DEFAULT NULL,
  `comment_note` varchar(255) DEFAULT NULL,
  `date_given` date DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`dental_certificate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dental_certificates`
--

LOCK TABLES `dental_certificates` WRITE;
/*!40000 ALTER TABLE `dental_certificates` DISABLE KEYS */;
INSERT INTO `dental_certificates` VALUES (1,1,'2021-12-07','test','sign3','test','comment3','test','2021-12-16',0,'2021-12-05 05:41:15','2021-12-05 05:41:15');
/*!40000 ALTER TABLE `dental_certificates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `first_aid_kits`
--

DROP TABLE IF EXISTS `first_aid_kits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `first_aid_kits` (
  `first_aid_kit_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `measurement` varchar(100) DEFAULT NULL,
  `quantity` decimal(15,2) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`first_aid_kit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `first_aid_kits`
--

LOCK TABLES `first_aid_kits` WRITE;
/*!40000 ALTER TABLE `first_aid_kits` DISABLE KEYS */;
INSERT INTO `first_aid_kits` VALUES (1,'test','test',400.00,0,'2021-12-05 06:03:19','2021-12-05 12:50:08'),(2,'TEST','test',10.00,0,'2021-12-05 12:49:39','2021-12-05 12:49:39');
/*!40000 ALTER TABLE `first_aid_kits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hospitalization_history`
--

DROP TABLE IF EXISTS `hospitalization_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hospitalization_history` (
  `hospitalization_history_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `medical_history_id` bigint(20) DEFAULT NULL,
  `patient_id` bigint(20) DEFAULT NULL,
  `year` varchar(50) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `hospital` text DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`hospitalization_history_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hospitalization_history`
--

LOCK TABLES `hospitalization_history` WRITE;
/*!40000 ALTER TABLE `hospitalization_history` DISABLE KEYS */;
INSERT INTO `hospitalization_history` VALUES (1,1,2,'test','test','test',0,'2022-01-09 02:51:16','2022-01-09 02:51:16'),(2,2,4,'test','test','test',0,'2022-01-09 02:55:50','2022-01-09 02:55:50');
/*!40000 ALTER TABLE `hospitalization_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `measurements`
--

DROP TABLE IF EXISTS `measurements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `measurements` (
  `measurement_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `abbreviation` varchar(45) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`measurement_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `measurements`
--

LOCK TABLES `measurements` WRITE;
/*!40000 ALTER TABLE `measurements` DISABLE KEYS */;
INSERT INTO `measurements` VALUES (1,'Kg','Kilogram',1,'2021-12-03 05:28:29','2021-12-30 07:15:16'),(2,'Mg','Miligram',1,'2021-12-03 05:28:29','2021-12-30 07:15:20'),(3,'Kg','Kilogram',0,'2021-12-30 07:15:32','2021-12-30 07:15:32'),(4,'mg','Milligram',0,'2021-12-30 07:15:43','2021-12-30 07:15:43'),(5,'inch','Inches',0,'2021-12-30 07:15:53','2021-12-30 07:16:06');
/*!40000 ALTER TABLE `measurements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medical_history`
--

DROP TABLE IF EXISTS `medical_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medical_history` (
  `medical_history_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `patient_id` bigint(20) DEFAULT NULL,
  `marital_status` varchar(100) DEFAULT NULL,
  `referring_doctors` text DEFAULT NULL,
  `last_physical_exam` date DEFAULT NULL,
  `is_vaccinated` varchar(50) DEFAULT NULL,
  `covid_patient` varchar(50) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`medical_history_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medical_history`
--

LOCK TABLES `medical_history` WRITE;
/*!40000 ALTER TABLE `medical_history` DISABLE KEYS */;
INSERT INTO `medical_history` VALUES (1,2,'Single','test','2022-02-02','Yes','Yes',0,'2022-01-09 02:51:15','2022-01-09 02:51:15'),(2,4,'Single','test','2022-01-06','Yes','Yes',0,'2022-01-09 02:55:49','2022-01-09 02:55:49');
/*!40000 ALTER TABLE `medical_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicine_transactions`
--

DROP TABLE IF EXISTS `medicine_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medicine_transactions` (
  `medicine_transaction_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `check_up_id` bigint(20) DEFAULT NULL,
  `medicine_id` bigint(20) DEFAULT NULL,
  `stocks` decimal(15,2) DEFAULT NULL,
  `quantity` decimal(15,2) DEFAULT NULL,
  `remaining` decimal(15,2) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`medicine_transaction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicine_transactions`
--

LOCK TABLES `medicine_transactions` WRITE;
/*!40000 ALTER TABLE `medicine_transactions` DISABLE KEYS */;
INSERT INTO `medicine_transactions` VALUES (1,1,1,100.00,50.00,50.00,0,'2021-12-05 05:39:20','2021-12-05 05:39:20'),(2,1,2,850.00,800.00,50.00,0,'2021-12-05 05:39:20','2021-12-05 05:39:20');
/*!40000 ALTER TABLE `medicine_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicines`
--

DROP TABLE IF EXISTS `medicines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medicines` (
  `medicine_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `unit_id` bigint(20) DEFAULT NULL,
  `measurement_id` bigint(20) DEFAULT NULL,
  `category_id` bigint(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `reorder` int(11) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`medicine_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicines`
--

LOCK TABLES `medicines` WRITE;
/*!40000 ALTER TABLE `medicines` DISABLE KEYS */;
INSERT INTO `medicines` VALUES (1,'Biogesic','',5,4,2,NULL,10,100,0,'2022-01-01 13:50:42','2022-01-08 06:27:18'),(2,'Neosep','',5,4,NULL,NULL,NULL,NULL,0,'2022-01-01 13:50:56','2022-01-01 13:50:56'),(3,'Buscupan','',5,4,2,NULL,NULL,NULL,0,'2022-01-01 13:51:09','2022-01-08 05:58:38'),(4,'Syndex Forte','',5,3,2,NULL,10,1000,0,'2022-01-01 13:51:25','2022-01-08 09:51:44'),(5,'Mefinamic Acid','',4,4,NULL,NULL,NULL,NULL,0,'2022-01-01 13:51:40','2022-01-01 13:51:40'),(6,'test2','test',1,3,2,NULL,NULL,NULL,1,'2022-01-08 06:01:28','2022-01-08 06:01:44');
/*!40000 ALTER TABLE `medicines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `office_supply`
--

DROP TABLE IF EXISTS `office_supply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `office_supply` (
  `office_supply_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `unit_id` bigint(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `reorder` int(11) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`office_supply_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `office_supply`
--

LOCK TABLES `office_supply` WRITE;
/*!40000 ALTER TABLE `office_supply` DISABLE KEYS */;
INSERT INTO `office_supply` VALUES (1,'Coupon Bond A4',1,NULL,NULL,NULL,0,'2022-01-01 13:53:38','2022-01-01 13:53:58'),(2,'Coupon Bond Long',1,NULL,NULL,NULL,0,'2022-01-01 13:53:52','2022-01-01 13:53:52'),(3,'Floder Long',1,NULL,NULL,NULL,0,'2022-01-01 13:54:07','2022-01-01 13:54:07'),(4,'Envelop Long',1,NULL,NULL,NULL,0,'2022-01-01 13:54:19','2022-01-01 13:54:19');
/*!40000 ALTER TABLE `office_supply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patient_type`
--

DROP TABLE IF EXISTS `patient_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patient_type` (
  `patient_type_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`patient_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COMMENT='1 - Faculty\n2 - Students\n3 - Others';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient_type`
--

LOCK TABLES `patient_type` WRITE;
/*!40000 ALTER TABLE `patient_type` DISABLE KEYS */;
INSERT INTO `patient_type` VALUES (1,'Faculty',0,'2021-12-02 04:58:27','2021-12-02 04:58:27'),(2,'Student',0,'2021-12-02 04:58:27','2021-12-02 04:58:27'),(3,'Non-Teaching',0,'2021-12-02 05:10:24','2021-12-04 18:12:25'),(4,'External Stakeholders',0,'2021-12-04 18:12:25','2021-12-04 18:12:25'),(5,'Others',0,'2021-12-04 18:12:34','2021-12-04 18:12:34');
/*!40000 ALTER TABLE `patient_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patients`
--

DROP TABLE IF EXISTS `patients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patients` (
  `patient_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `patient_code` varchar(45) DEFAULT NULL,
  `patient_type_id` bigint(20) DEFAULT NULL,
  `course_id` bigint(20) DEFAULT NULL,
  `year_id` bigint(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `suffix` varchar(45) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `section` varchar(45) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`patient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patients`
--

LOCK TABLES `patients` WRITE;
/*!40000 ALTER TABLE `patients` DISABLE KEYS */;
INSERT INTO `patients` VALUES (1,'16-2423',2,1,2,'johndoe@gmail.com','johndoe','John','Verdadero','Mapagmahal','',28,'Male','G',0,'2021-12-05 05:25:15','2022-01-08 09:13:57'),(2,'16-7500',2,1,3,'rjpinca@gmail.com','rjpinca','RJ','','Pinca','',25,'Male','25G',0,'2022-01-08 09:12:36','2022-01-08 09:12:36'),(3,'98-1569',1,0,0,'milesestacio@gmail.com','milesestacio','Miles','','Estacio','II',40,'Female','',0,'2022-01-08 09:14:47','2022-01-08 09:14:47'),(4,'16-2426',3,0,0,'arvingil@gmail.com','arvingil','Arvin','','Gil','',23,'Male','',0,'2022-01-08 09:26:58','2022-01-08 09:26:58');
/*!40000 ALTER TABLE `patients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_health_history`
--

DROP TABLE IF EXISTS `personal_health_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_health_history` (
  `personal_health_history_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `medical_history_id` bigint(20) DEFAULT NULL,
  `patient_id` bigint(20) DEFAULT NULL,
  `childhood_illness` text DEFAULT NULL,
  `immunization` text DEFAULT NULL,
  `medical_problems` text DEFAULT NULL,
  `blood_transmission` text DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`personal_health_history_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_health_history`
--

LOCK TABLES `personal_health_history` WRITE;
/*!40000 ALTER TABLE `personal_health_history` DISABLE KEYS */;
INSERT INTO `personal_health_history` VALUES (1,1,2,'Measles|Chickenpox|Rheumatic Fever','Measles|Chickenpox|Rheumatic Fever|Tetanus|Pheumonia|Hepatatis','test','Yes',0,'2022-01-09 02:51:15','2022-01-09 02:51:15'),(2,2,4,'Mumps','Mumps|Pheumonia','test','Yes',0,'2022-01-09 02:55:50','2022-01-09 02:55:50');
/*!40000 ALTER TABLE `personal_health_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prescribed_drug_history`
--

DROP TABLE IF EXISTS `prescribed_drug_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prescribed_drug_history` (
  `prescribed_drug_history_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `medical_history_id` bigint(20) DEFAULT NULL,
  `patient_id` bigint(20) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `strength` text DEFAULT NULL,
  `frequently_taken` text DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`prescribed_drug_history_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prescribed_drug_history`
--

LOCK TABLES `prescribed_drug_history` WRITE;
/*!40000 ALTER TABLE `prescribed_drug_history` DISABLE KEYS */;
INSERT INTO `prescribed_drug_history` VALUES (1,1,2,'test','test','test',0,'2022-01-09 02:51:16','2022-01-09 02:51:16'),(2,1,2,'test','test','test',0,'2022-01-09 02:51:16','2022-01-09 02:51:16'),(3,2,4,'test','test','test',0,'2022-01-09 02:55:50','2022-01-09 02:55:50'),(4,2,4,'test','test','test',0,'2022-01-09 02:55:50','2022-01-09 02:55:50');
/*!40000 ALTER TABLE `prescribed_drug_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_request`
--

DROP TABLE IF EXISTS `purchase_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_request` (
  `purchase_request_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`purchase_request_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_request`
--

LOCK TABLES `purchase_request` WRITE;
/*!40000 ALTER TABLE `purchase_request` DISABLE KEYS */;
INSERT INTO `purchase_request` VALUES (1,'PR-00001','',2,0,'2022-01-02 05:40:54','2022-01-02 10:24:39'),(2,'PR-00002','test',1,0,'2022-01-02 05:47:04','2022-01-02 10:25:02');
/*!40000 ALTER TABLE `purchase_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_request_care_equipment`
--

DROP TABLE IF EXISTS `purchase_request_care_equipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_request_care_equipment` (
  `purchase_request_care_equipment_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `purchase_request_id` bigint(20) DEFAULT NULL,
  `care_equipment_id` bigint(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit_cost` decimal(15,2) DEFAULT NULL,
  `total_cost` decimal(15,2) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`purchase_request_care_equipment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_request_care_equipment`
--

LOCK TABLES `purchase_request_care_equipment` WRITE;
/*!40000 ALTER TABLE `purchase_request_care_equipment` DISABLE KEYS */;
INSERT INTO `purchase_request_care_equipment` VALUES (1,1,1,10,100.00,1000.00,0,'2022-01-02 05:40:54','2022-01-02 05:40:54'),(2,1,2,10,200.00,2000.00,0,'2022-01-02 05:40:54','2022-01-02 05:40:54'),(3,1,3,10,300.00,3000.00,0,'2022-01-02 05:40:54','2022-01-02 05:40:54');
/*!40000 ALTER TABLE `purchase_request_care_equipment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_request_medicine`
--

DROP TABLE IF EXISTS `purchase_request_medicine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_request_medicine` (
  `purchase_request_medicine_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `purchase_request_id` bigint(20) DEFAULT NULL,
  `medicine_id` bigint(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit_cost` decimal(15,2) DEFAULT NULL,
  `total_cost` decimal(15,2) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`purchase_request_medicine_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_request_medicine`
--

LOCK TABLES `purchase_request_medicine` WRITE;
/*!40000 ALTER TABLE `purchase_request_medicine` DISABLE KEYS */;
INSERT INTO `purchase_request_medicine` VALUES (1,1,1,10,500.00,5000.00,0,'2022-01-02 05:40:54','2022-01-02 05:40:54'),(2,1,2,10,600.00,6000.00,0,'2022-01-02 05:40:54','2022-01-02 05:40:54'),(3,2,1,100,500.00,50000.00,0,'2022-01-02 05:47:04','2022-01-02 05:47:04');
/*!40000 ALTER TABLE `purchase_request_medicine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_request_office_supply`
--

DROP TABLE IF EXISTS `purchase_request_office_supply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_request_office_supply` (
  `purchase_request_office_supply_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `purchase_request_id` bigint(20) DEFAULT NULL,
  `office_supply_id` bigint(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit_cost` decimal(15,2) DEFAULT NULL,
  `total_cost` decimal(15,2) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`purchase_request_office_supply_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_request_office_supply`
--

LOCK TABLES `purchase_request_office_supply` WRITE;
/*!40000 ALTER TABLE `purchase_request_office_supply` DISABLE KEYS */;
INSERT INTO `purchase_request_office_supply` VALUES (1,1,1,100,50.00,5000.00,0,'2022-01-02 05:40:55','2022-01-02 05:40:55');
/*!40000 ALTER TABLE `purchase_request_office_supply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `refer_drug_history`
--

DROP TABLE IF EXISTS `refer_drug_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `refer_drug_history` (
  `refer_drug_history_id` bigint(20) NOT NULL,
  `medical_history_id` bigint(20) DEFAULT NULL,
  `patient_id` bigint(20) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `reaction` text DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`refer_drug_history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `refer_drug_history`
--

LOCK TABLES `refer_drug_history` WRITE;
/*!40000 ALTER TABLE `refer_drug_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `refer_drug_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `referral_forms`
--

DROP TABLE IF EXISTS `referral_forms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `referral_forms` (
  `referral_form_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `to_doctor` text DEFAULT NULL,
  `patient_id` bigint(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `chief_complaint` text DEFAULT NULL,
  `illness_history` text DEFAULT NULL,
  `medicine_given` text DEFAULT NULL,
  `impression` text DEFAULT NULL,
  `referral_reason` text DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`referral_form_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `referral_forms`
--

LOCK TABLES `referral_forms` WRITE;
/*!40000 ALTER TABLE `referral_forms` DISABLE KEYS */;
INSERT INTO `referral_forms` VALUES (1,'2022-01-22','test',2,'test','test','test','test','test','As requested by relatives of patient/patient',0,'2022-01-08 11:52:37','2022-01-08 11:54:32'),(2,'2022-02-04','test',4,'test','test','test','test','test','For further evaluation and management',1,'2022-01-08 11:55:02','2022-01-08 11:55:17');
/*!40000 ALTER TABLE `referral_forms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `role_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Nurse',0,'2021-12-04 11:13:57','2021-12-04 11:13:57'),(2,'Doctor',0,'2021-12-04 11:13:57','2021-12-04 11:13:57'),(3,'Dentist',0,'2021-12-04 11:13:57','2021-12-04 11:13:57'),(4,'Physician',0,'2021-12-04 11:13:57','2021-12-04 11:13:57');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sections` (
  `section_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) DEFAULT NULL,
  `year_id` bigint(20) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`section_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sections`
--

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` VALUES (1,1,2,'Ha?',1,'2021-12-30 07:43:17','2021-12-30 07:47:15'),(2,1,3,'2g',0,'2021-12-30 07:45:51','2021-12-30 07:45:51');
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `service_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='1 - Medical\n2 - Dental\n3 - Dispensing Medicine';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'Medical','Sample Description',0,'2021-12-04 00:49:07','2021-12-04 00:49:07'),(2,'Dental','Sample Description',1,'2021-12-04 00:49:07','2022-01-09 00:52:53'),(3,'Dispensing Medicine','Sample Description',0,'2021-12-04 04:52:19','2021-12-04 04:52:19');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_in`
--

DROP TABLE IF EXISTS `stock_in`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock_in` (
  `stock_in_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `purchase_request_id` bigint(20) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`stock_in_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_in`
--

LOCK TABLES `stock_in` WRITE;
/*!40000 ALTER TABLE `stock_in` DISABLE KEYS */;
INSERT INTO `stock_in` VALUES (1,0,'SI-00001','already have',0,'2022-01-01 13:56:30','2022-01-01 14:11:09'),(2,1,'SI-00002','test',0,'2022-01-02 08:20:54','2022-01-02 08:20:54'),(3,2,'SI-00003','test',0,'2022-01-02 10:42:45','2022-01-02 10:42:45'),(4,0,'SI-00004','test',0,'2022-01-08 02:07:29','2022-01-08 02:07:30'),(5,2,'SI-00005','',0,'2022-01-08 05:46:24','2022-01-08 05:46:25');
/*!40000 ALTER TABLE `stock_in` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_in_care_equipment`
--

DROP TABLE IF EXISTS `stock_in_care_equipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock_in_care_equipment` (
  `stock_in_care_equipment_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `stock_in_id` bigint(20) DEFAULT NULL,
  `care_equipment_id` bigint(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `remaining` int(11) DEFAULT NULL,
  `batch` varchar(100) DEFAULT NULL,
  `expiration` date DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`stock_in_care_equipment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_in_care_equipment`
--

LOCK TABLES `stock_in_care_equipment` WRITE;
/*!40000 ALTER TABLE `stock_in_care_equipment` DISABLE KEYS */;
INSERT INTO `stock_in_care_equipment` VALUES (1,1,1,100,100,'1','2022-02-05',0,'2022-01-01 13:56:30','2022-01-09 01:48:54'),(2,1,2,100,5,'1','2022-02-05',0,'2022-01-01 13:56:30','2022-01-09 02:55:49'),(3,1,3,100,100,'1','2022-02-05',0,'2022-01-01 13:56:30','2022-01-09 01:48:54'),(4,1,4,100,50,'1','2022-02-05',0,'2022-01-01 13:56:30','2022-01-09 02:43:07'),(5,1,5,100,100,'1','2022-02-05',0,'2022-01-01 13:56:30','2022-01-09 01:48:54'),(6,2,1,10,10,'','0000-00-00',0,'2022-01-02 08:20:55','2022-01-09 01:48:54'),(7,2,2,10,0,'','0000-00-00',0,'2022-01-02 08:20:55','2022-01-09 02:39:28'),(8,2,3,10,10,'','0000-00-00',0,'2022-01-02 08:20:55','2022-01-09 01:48:54'),(9,4,1,100,100,'1','2022-01-20',0,'2022-01-08 02:07:30','2022-01-08 02:07:30');
/*!40000 ALTER TABLE `stock_in_care_equipment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_in_medicine`
--

DROP TABLE IF EXISTS `stock_in_medicine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock_in_medicine` (
  `stock_in_medicine_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `stock_in_id` bigint(20) DEFAULT NULL,
  `medicine_id` bigint(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `remaining` int(11) DEFAULT NULL,
  `batch` varchar(100) DEFAULT NULL,
  `expiration` date DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`stock_in_medicine_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_in_medicine`
--

LOCK TABLES `stock_in_medicine` WRITE;
/*!40000 ALTER TABLE `stock_in_medicine` DISABLE KEYS */;
INSERT INTO `stock_in_medicine` VALUES (1,1,1,100,0,'1','2022-01-21',0,'2022-01-01 13:56:30','2022-01-08 04:03:16'),(2,1,2,100,95,'1','2022-01-21',0,'2022-01-01 13:56:30','2022-01-09 03:44:42'),(3,1,3,100,90,'1','2022-01-27',0,'2022-01-01 13:56:30','2022-01-09 02:55:49'),(4,1,4,100,25,'1','2022-01-20',0,'2022-01-01 13:56:30','2022-01-09 03:44:42'),(5,1,5,100,50,'1','2022-01-21',0,'2022-01-01 13:56:30','2022-01-08 04:47:19'),(6,2,1,1,0,'2','2022-01-21',0,'2022-01-02 08:20:54','2022-01-03 11:16:19'),(7,2,2,10,0,'2','0000-00-00',0,'2022-01-02 08:20:54','2022-01-09 02:51:15'),(8,3,1,5,0,'2','2022-01-23',0,'2022-01-02 10:42:45','2022-01-08 04:35:26'),(9,5,1,50,0,'1','0000-00-00',0,'2022-01-08 05:46:25','2022-01-09 02:39:57');
/*!40000 ALTER TABLE `stock_in_medicine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_in_office_supply`
--

DROP TABLE IF EXISTS `stock_in_office_supply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock_in_office_supply` (
  `stock_in_office_supply_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `stock_in_id` bigint(20) DEFAULT NULL,
  `office_supply_id` bigint(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `remaining` int(11) DEFAULT NULL,
  `batch` varchar(100) DEFAULT NULL,
  `expiration` date DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`stock_in_office_supply_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_in_office_supply`
--

LOCK TABLES `stock_in_office_supply` WRITE;
/*!40000 ALTER TABLE `stock_in_office_supply` DISABLE KEYS */;
INSERT INTO `stock_in_office_supply` VALUES (1,1,2,100,NULL,'1','2022-01-29',0,'2022-01-01 13:56:31','2022-01-01 13:56:31'),(2,1,3,100,NULL,'1','2022-01-07',0,'2022-01-01 13:56:31','2022-01-01 13:56:31'),(3,1,4,100,NULL,'1','2022-01-27',0,'2022-01-01 13:56:31','2022-01-01 13:56:31'),(4,1,1,100,NULL,'1','2022-01-28',0,'2022-01-01 13:56:31','2022-01-01 13:56:31'),(5,2,1,100,NULL,'','0000-00-00',0,'2022-01-02 08:20:55','2022-01-02 08:20:55');
/*!40000 ALTER TABLE `stock_in_office_supply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_out`
--

DROP TABLE IF EXISTS `stock_out`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock_out` (
  `stock_out_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`stock_out_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_out`
--

LOCK TABLES `stock_out` WRITE;
/*!40000 ALTER TABLE `stock_out` DISABLE KEYS */;
INSERT INTO `stock_out` VALUES (1,'SO-00001','',0,'2022-01-07 21:02:39','2022-01-08 04:02:39'),(2,'SO-00002','test',0,'2022-01-07 21:03:16','2022-01-08 04:03:16'),(3,'SO-00003','remove biogesic',0,'2022-01-07 21:35:25','2022-01-08 04:35:26'),(4,'SO-00004','mefenamic acid',0,'2022-01-07 21:47:19','2022-01-08 04:47:19'),(5,'SO-00005','biogesic',0,'2022-01-08 18:28:23','2022-01-09 01:28:23');
/*!40000 ALTER TABLE `stock_out` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_out_care_equipment`
--

DROP TABLE IF EXISTS `stock_out_care_equipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock_out_care_equipment` (
  `stock_out_care_equipment_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `stock_out_id` bigint(20) DEFAULT NULL,
  `stock_in_care_equipment_id` bigint(20) DEFAULT NULL,
  `check_up_id` bigint(20) DEFAULT NULL,
  `patient_id` bigint(20) DEFAULT NULL,
  `care_equipment_id` bigint(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `remaining` int(11) DEFAULT NULL,
  `batch` varchar(100) DEFAULT NULL,
  `expiration` date DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`stock_out_care_equipment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_out_care_equipment`
--

LOCK TABLES `stock_out_care_equipment` WRITE;
/*!40000 ALTER TABLE `stock_out_care_equipment` DISABLE KEYS */;
INSERT INTO `stock_out_care_equipment` VALUES (1,NULL,NULL,5,2,2,10,NULL,NULL,NULL,0,'2022-01-09 02:41:24','2022-01-09 02:41:24'),(2,NULL,NULL,5,2,4,10,NULL,NULL,NULL,0,'2022-01-09 02:41:24','2022-01-09 02:41:24'),(3,NULL,NULL,6,2,2,10,NULL,NULL,NULL,0,'2022-01-09 02:41:46','2022-01-09 02:41:46'),(4,NULL,NULL,6,2,4,10,NULL,NULL,NULL,0,'2022-01-09 02:41:46','2022-01-09 02:41:46'),(5,NULL,NULL,7,2,2,10,NULL,NULL,NULL,0,'2022-01-09 02:43:07','2022-01-09 02:43:07'),(6,NULL,NULL,7,2,4,10,NULL,NULL,NULL,0,'2022-01-09 02:43:07','2022-01-09 02:43:07'),(7,NULL,NULL,8,2,2,50,NULL,NULL,NULL,0,'2022-01-09 02:51:15','2022-01-09 02:51:15'),(8,NULL,NULL,9,4,2,5,NULL,NULL,NULL,0,'2022-01-09 02:55:49','2022-01-09 02:55:49');
/*!40000 ALTER TABLE `stock_out_care_equipment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_out_medicine`
--

DROP TABLE IF EXISTS `stock_out_medicine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock_out_medicine` (
  `stock_out_medicine_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `stock_out_id` bigint(20) DEFAULT NULL,
  `check_up_id` bigint(20) DEFAULT NULL,
  `patient_id` bigint(20) DEFAULT NULL,
  `medicine_id` bigint(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `remaining` int(11) DEFAULT NULL,
  `batch` varchar(100) DEFAULT NULL,
  `expiration` date DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`stock_out_medicine_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_out_medicine`
--

LOCK TABLES `stock_out_medicine` WRITE;
/*!40000 ALTER TABLE `stock_out_medicine` DISABLE KEYS */;
INSERT INTO `stock_out_medicine` VALUES (1,2,NULL,NULL,1,100,100,NULL,NULL,0,'2022-01-08 04:03:16','2022-01-08 04:03:16'),(2,3,NULL,NULL,1,5,5,NULL,NULL,0,'2022-01-08 04:35:26','2022-01-08 04:35:26'),(3,4,NULL,NULL,5,50,50,NULL,NULL,0,'2022-01-08 04:47:19','2022-01-08 04:47:19'),(4,5,NULL,NULL,1,10,10,NULL,NULL,0,'2022-01-09 01:28:24','2022-01-09 01:28:24'),(5,NULL,1,2,1,10,NULL,NULL,NULL,0,'2022-01-09 02:38:31','2022-01-09 02:38:31'),(6,NULL,1,2,4,10,NULL,NULL,NULL,0,'2022-01-09 02:38:31','2022-01-09 02:38:31'),(7,NULL,2,2,1,10,NULL,NULL,NULL,0,'2022-01-09 02:39:02','2022-01-09 02:39:02'),(8,NULL,2,2,4,10,NULL,NULL,NULL,0,'2022-01-09 02:39:02','2022-01-09 02:39:02'),(9,NULL,3,2,1,10,NULL,NULL,NULL,0,'2022-01-09 02:39:28','2022-01-09 02:39:28'),(10,NULL,3,2,4,10,NULL,NULL,NULL,0,'2022-01-09 02:39:28','2022-01-09 02:39:28'),(11,NULL,4,2,1,10,NULL,NULL,NULL,0,'2022-01-09 02:39:57','2022-01-09 02:39:57'),(12,NULL,4,2,4,10,NULL,NULL,NULL,0,'2022-01-09 02:39:57','2022-01-09 02:39:57'),(13,NULL,5,2,1,10,NULL,NULL,NULL,0,'2022-01-09 02:41:24','2022-01-09 02:41:24'),(14,NULL,5,2,4,10,NULL,NULL,NULL,0,'2022-01-09 02:41:24','2022-01-09 02:41:24'),(15,NULL,6,2,1,10,NULL,NULL,NULL,0,'2022-01-09 02:41:45','2022-01-09 02:41:45'),(16,NULL,6,2,4,10,NULL,NULL,NULL,0,'2022-01-09 02:41:45','2022-01-09 02:41:45'),(17,NULL,7,2,1,10,NULL,NULL,NULL,0,'2022-01-09 02:43:07','2022-01-09 02:43:07'),(18,NULL,7,2,4,10,NULL,NULL,NULL,0,'2022-01-09 02:43:07','2022-01-09 02:43:07'),(19,NULL,8,2,2,10,NULL,NULL,NULL,0,'2022-01-09 02:51:15','2022-01-09 02:51:15'),(20,NULL,9,4,3,10,NULL,NULL,NULL,0,'2022-01-09 02:55:49','2022-01-09 02:55:49'),(21,NULL,10,1,2,5,NULL,NULL,NULL,0,'2022-01-09 03:44:42','2022-01-09 03:44:42'),(22,NULL,10,1,4,5,NULL,NULL,NULL,0,'2022-01-09 03:44:42','2022-01-09 03:44:42');
/*!40000 ALTER TABLE `stock_out_medicine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_out_office_supply`
--

DROP TABLE IF EXISTS `stock_out_office_supply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock_out_office_supply` (
  `stock_out_office_supply_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `stock_out_id` bigint(20) DEFAULT NULL,
  `stock_in_office_supply_id` bigint(20) DEFAULT NULL,
  `office_supply_id` bigint(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `remaining` int(11) DEFAULT NULL,
  `batch` varchar(100) DEFAULT NULL,
  `expiration` date DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`stock_out_office_supply_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_out_office_supply`
--

LOCK TABLES `stock_out_office_supply` WRITE;
/*!40000 ALTER TABLE `stock_out_office_supply` DISABLE KEYS */;
/*!40000 ALTER TABLE `stock_out_office_supply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `surgery_history`
--

DROP TABLE IF EXISTS `surgery_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `surgery_history` (
  `surgery_history_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `medical_history_id` bigint(20) DEFAULT NULL,
  `patient_id` bigint(20) DEFAULT NULL,
  `year` varchar(50) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `hospital` text DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`surgery_history_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `surgery_history`
--

LOCK TABLES `surgery_history` WRITE;
/*!40000 ALTER TABLE `surgery_history` DISABLE KEYS */;
INSERT INTO `surgery_history` VALUES (1,1,2,'test','test','test',0,'2022-01-09 02:51:15','2022-01-09 02:51:15'),(2,1,2,'test','test','test',0,'2022-01-09 02:51:15','2022-01-09 02:51:15'),(3,2,4,'test','test','test',0,'2022-01-09 02:55:50','2022-01-09 02:55:50');
/*!40000 ALTER TABLE `surgery_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `surveys`
--

DROP TABLE IF EXISTS `surveys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `surveys` (
  `survey_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `check_up_id` bigint(20) DEFAULT NULL,
  `patient_id` bigint(20) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `q1` int(11) DEFAULT NULL,
  `q2` int(11) DEFAULT NULL,
  `q3` int(11) DEFAULT NULL,
  `q4` int(11) DEFAULT NULL,
  `q5` int(11) DEFAULT NULL,
  `q6` int(11) DEFAULT NULL,
  `q7` int(11) DEFAULT NULL,
  `q8` int(11) DEFAULT NULL,
  `q9` int(11) DEFAULT NULL,
  `q10` int(11) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`survey_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `surveys`
--

LOCK TABLES `surveys` WRITE;
/*!40000 ALTER TABLE `surveys` DISABLE KEYS */;
INSERT INTO `surveys` VALUES (1,1,1,1,5,4,3,2,1,2,3,4,5,4,NULL,0,'2021-12-05 05:39:20','2021-12-05 05:57:46'),(2,2,1,1,1,1,2,1,2,1,1,1,1,4,NULL,0,'2021-08-05 05:39:20','2021-12-05 11:35:43'),(3,7,2,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2022-01-09 02:43:07','2022-01-09 02:43:07'),(4,8,2,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2022-01-09 02:51:16','2022-01-09 02:51:16'),(5,9,4,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2022-01-09 02:55:50','2022-01-09 02:55:50'),(6,10,1,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2022-01-09 03:44:42','2022-01-09 03:44:42');
/*!40000 ALTER TABLE `surveys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_setup`
--

DROP TABLE IF EXISTS `system_setup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_setup` (
  `system_setup_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`system_setup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_setup`
--

LOCK TABLES `system_setup` WRITE;
/*!40000 ALTER TABLE `system_setup` DISABLE KEYS */;
INSERT INTO `system_setup` VALUES (1,'clinic@gmail.com',0,'2022-01-08 08:28:10','2022-01-09 00:51:29');
/*!40000 ALTER TABLE `system_setup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `units`
--

DROP TABLE IF EXISTS `units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `units` (
  `unit_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `abbreviation` varchar(45) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`unit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `units`
--

LOCK TABLES `units` WRITE;
/*!40000 ALTER TABLE `units` DISABLE KEYS */;
INSERT INTO `units` VALUES (1,'box','Boxes',0,'2021-12-30 06:56:30','2021-12-30 07:11:57'),(2,'gal','Gallons',1,'2021-12-30 07:09:55','2021-12-31 14:53:20'),(3,'321','Boxes',1,'2021-12-30 07:12:31','2021-12-30 07:12:57'),(4,'gal','Gallon',0,'2022-01-01 13:48:40','2022-01-01 13:48:40'),(5,'pcs','Pieces',0,'2022-01-01 13:50:18','2022-01-01 13:50:18');
/*!40000 ALTER TABLE `units` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_code` varchar(45) DEFAULT NULL,
  `role_id` bigint(20) DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `suffix` varchar(45) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `age` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'US-000001',1,'Akosin','','Admin','','Female','20','admin@gmail.com','admin',0,'2021-12-02 06:18:25','2021-12-04 15:32:32'),(2,NULL,NULL,'TEST','','Admin','','Male','18','test@gmail.com','test',1,'2021-12-04 11:33:02','2021-12-04 11:34:21');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `years`
--

DROP TABLE IF EXISTS `years`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `years` (
  `year_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`year_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `years`
--

LOCK TABLES `years` WRITE;
/*!40000 ALTER TABLE `years` DISABLE KEYS */;
INSERT INTO `years` VALUES (1,1,'101G',1,'2021-12-30 07:30:45','2021-12-30 07:31:07'),(2,1,'First Year',0,'2021-12-30 07:30:58','2021-12-30 07:44:00'),(3,1,'Second Year',0,'2021-12-30 07:31:17','2021-12-30 07:44:14');
/*!40000 ALTER TABLE `years` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'clinicmsdbv2'
--

--
-- Dumping routines for database 'clinicmsdbv2'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-01-09 12:30:42

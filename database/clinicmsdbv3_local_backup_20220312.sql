-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2022 at 03:42 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinicmsdbv3`
--

-- --------------------------------------------------------

--
-- Table structure for table `allergy_medication_history`
--

CREATE TABLE `allergy_medication_history` (
  `allergy_medication_history_id` bigint(20) NOT NULL,
  `medical_history_id` bigint(20) DEFAULT NULL,
  `patient_id` bigint(20) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `reaction` text DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `allergy_medication_history`
--

INSERT INTO `allergy_medication_history` (`allergy_medication_history_id`, `medical_history_id`, `patient_id`, `name`, `reaction`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'test', NULL, 0, '2022-01-09 02:51:16', '2022-01-09 02:51:16'),
(2, 1, 2, 'test', NULL, 0, '2022-01-09 02:51:16', '2022-01-09 02:51:16'),
(3, 2, 4, 'test', 'test', 0, '2022-01-09 02:55:50', '2022-01-09 02:55:50'),
(4, 3, 1, 'test', 'test', 0, '2022-02-25 08:56:09', '2022-02-25 08:56:09');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `announcement_id` bigint(20) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `care_equipments`
--

CREATE TABLE `care_equipments` (
  `care_equipment_id` bigint(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `unit_id` bigint(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `reorder` int(11) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `care_equipments`
--

INSERT INTO `care_equipments` (`care_equipment_id`, `name`, `unit_id`, `quantity`, `reorder`, `capacity`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Elastic Bandage', 5, NULL, 10, 1000, 0, '2022-01-01 13:52:20', '2022-01-08 06:23:44'),
(2, 'Gauze Pad', 5, NULL, NULL, NULL, 0, '2022-01-01 13:52:33', '2022-01-01 13:52:33'),
(3, 'Lysol Disinfectant Spray', 4, NULL, NULL, NULL, 0, '2022-01-01 13:52:50', '2022-01-01 13:52:50'),
(4, 'Alcohol', 4, NULL, NULL, NULL, 0, '2022-01-01 13:53:06', '2022-01-01 13:53:06'),
(5, 'Gloves', 1, NULL, NULL, NULL, 0, '2022-01-01 13:53:13', '2022-01-01 13:53:13');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` bigint(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'test2', 1, '2022-01-08 05:54:50', '2022-01-08 05:55:04'),
(2, 'test', 0, '2022-01-08 05:55:00', '2022-01-08 05:55:00');

-- --------------------------------------------------------

--
-- Table structure for table `check_ups`
--

CREATE TABLE `check_ups` (
  `check_up_id` bigint(20) NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `check_ups`
--

INSERT INTO `check_ups` (`check_up_id`, `clinic_appointment_id`, `service_id`, `patient_id`, `temperature`, `pulse_rate`, `respiratory_rate`, `blood_pressure`, `random_blood_sugar`, `others`, `recommendation`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 2, '38.59', 'test', 'test', 'test', 'test', 'test', 'test', 0, '2021-12-09 02:38:30', '2022-02-25 16:37:17'),
(2, 5, 1, 2, '38.59', 'test', 'test', 'test', 'test', 'test', 'test', 0, '2022-01-09 02:39:01', '2022-01-09 02:39:01'),
(3, 5, 1, 2, '38.59', 'test', 'test', 'test', 'test', 'test', 'test', 0, '2022-01-09 02:39:28', '2022-01-09 02:39:28'),
(4, 5, 1, 2, '38.59', 'test', 'test', 'test', 'test', 'test', 'test', 0, '2022-01-09 02:39:57', '2022-01-09 02:39:57'),
(5, 5, 1, 2, '38.59', 'test', 'test', 'test', 'test', 'test', 'test', 0, '2022-01-09 02:41:23', '2022-01-09 02:41:23'),
(6, 5, 1, 2, '38.59', 'test', 'test', 'test', 'test', 'test', 'test', 0, '2022-01-09 02:41:45', '2022-01-09 02:41:45'),
(7, 5, 1, 2, '38.59', 'test', 'test', 'test', 'test', 'test', 'test', 0, '2022-01-09 02:43:06', '2022-01-09 02:43:06'),
(8, 5, 1, 2, '45.00', 'test', 'test', 'test', 'test', 'test', 'test', 0, '2022-01-09 02:51:15', '2022-01-09 02:51:15'),
(9, 4, 1, 4, '50.00', 'test', 'test', 'test', 'test', 'test', 'test', 0, '2022-01-09 02:55:49', '2022-01-09 02:55:49'),
(11, 9, 1, 1, '38.95', '--', '--', '--', '--', '--', 'test', 0, '2022-02-25 08:56:09', '2022-02-25 08:56:09'),
(14, 9, 3, 1, '99.99', '--', '--', '--', '--', '--', '**', 0, '2022-02-25 10:54:07', '2022-02-25 10:54:07'),
(15, 11, 3, 2, '56.59', '--', '--', '--', '--', '--', 'test', 0, '2022-02-25 10:54:37', '2022-02-25 10:54:37'),
(16, 15, 1, 1, '40.00', '--', '--', '--', '--', '--', 'test', 0, '2022-02-28 11:28:32', '2022-02-28 11:28:32'),
(17, 15, 1, 1, '45.00', '--', '--', '--', '--', '--', '--', 0, '2022-02-28 11:32:30', '2022-02-28 11:32:30');

-- --------------------------------------------------------

--
-- Table structure for table `check_up_care_equipments`
--

CREATE TABLE `check_up_care_equipments` (
  `check_up_care_equipment_id` bigint(20) NOT NULL,
  `check_up_id` bigint(20) DEFAULT NULL,
  `patient_id` bigint(20) DEFAULT NULL,
  `care_equipment_id` bigint(20) DEFAULT NULL,
  `quantity` decimal(15,2) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `check_up_care_equipments`
--

INSERT INTO `check_up_care_equipments` (`check_up_care_equipment_id`, `check_up_id`, `patient_id`, `care_equipment_id`, `quantity`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 8, 2, 2, '50.00', 0, '2022-01-09 02:51:15', '2022-01-09 02:51:15'),
(2, 9, 4, 2, '5.00', 0, '2022-01-09 02:55:49', '2022-01-09 02:55:49');

-- --------------------------------------------------------

--
-- Table structure for table `check_up_medicines`
--

CREATE TABLE `check_up_medicines` (
  `check_up_medicine_id` bigint(20) NOT NULL,
  `check_up_id` bigint(20) DEFAULT NULL,
  `patient_id` bigint(20) DEFAULT NULL,
  `medicine_id` bigint(20) DEFAULT NULL,
  `quantity` decimal(15,2) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `check_up_medicines`
--

INSERT INTO `check_up_medicines` (`check_up_medicine_id`, `check_up_id`, `patient_id`, `medicine_id`, `quantity`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 8, 2, 2, '10.00', 0, '2022-01-09 02:51:15', '2022-01-09 02:51:15'),
(2, 9, 4, 3, '10.00', 0, '2022-01-09 02:55:49', '2022-01-09 02:55:49'),
(3, 10, 1, 2, '5.00', 0, '2022-01-09 03:44:42', '2022-01-09 03:44:42'),
(4, 10, 1, 4, '5.00', 0, '2022-01-09 03:44:42', '2022-01-09 03:44:42'),
(5, 11, 1, 2, '5.00', 0, '2022-02-25 08:56:09', '2022-02-25 08:56:09'),
(6, 15, 2, 1, '0.00', 0, '2022-02-25 10:54:37', '2022-02-25 10:54:37');

-- --------------------------------------------------------

--
-- Table structure for table `check_up_treatments`
--

CREATE TABLE `check_up_treatments` (
  `check_up_treatment_id` bigint(20) NOT NULL,
  `check_up_id` bigint(20) DEFAULT NULL,
  `tooth_number` int(11) DEFAULT NULL,
  `status` text DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `clinical_case_records`
--

CREATE TABLE `clinical_case_records` (
  `clinical_case_record_id` bigint(20) NOT NULL,
  `check_up_id` bigint(20) DEFAULT NULL,
  `patient_id` bigint(20) DEFAULT NULL,
  `health_complaint` text DEFAULT NULL,
  `treatment` text DEFAULT NULL,
  `schedule` date DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clinical_case_records`
--

INSERT INTO `clinical_case_records` (`clinical_case_record_id`, `check_up_id`, `patient_id`, `health_complaint`, `treatment`, `schedule`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 8, 2, 'test', 'test', '2022-01-19', 0, '2022-01-09 02:51:16', '2022-01-09 02:51:16'),
(2, 9, 4, 'test', 'test', '2022-01-10', 0, '2022-01-09 02:55:50', '2022-01-09 02:55:50'),
(3, 11, 1, 'test', 'test', '2022-02-27', 0, '2022-02-25 08:56:10', '2022-02-25 08:56:10');

-- --------------------------------------------------------

--
-- Table structure for table `clinic_appointments`
--

CREATE TABLE `clinic_appointments` (
  `clinic_appointment_id` bigint(20) NOT NULL,
  `patient_id` bigint(20) DEFAULT NULL,
  `service_id` bigint(20) DEFAULT NULL,
  `purpose` text DEFAULT NULL,
  `date_appointment` date DEFAULT NULL,
  `is_done` int(11) DEFAULT 0,
  `is_website` int(11) DEFAULT 0,
  `is_read` int(11) DEFAULT 1,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clinic_appointments`
--

INSERT INTO `clinic_appointments` (`clinic_appointment_id`, `patient_id`, `service_id`, `purpose`, `date_appointment`, `is_done`, `is_website`, `is_read`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'TEST', '2021-12-13', 1, 0, 1, 0, '2021-12-05 05:35:10', '2022-01-05 12:35:31'),
(2, 1, 2, 'test', '2021-12-03', 0, 0, 1, 1, '2021-12-05 11:49:28', '2021-12-05 11:49:36'),
(3, 2, 1, 'test', '2022-01-08', 1, 0, 1, 0, '2022-01-08 09:30:51', '2022-01-08 09:30:59'),
(4, 4, 1, 'test', '2022-01-09', 1, 0, 1, 0, '2022-01-09 00:53:21', '2022-01-09 00:53:21'),
(5, 2, 1, 'tesst', '2022-01-09', 2, 0, 1, 0, '2022-01-09 01:17:19', '2022-01-09 04:24:55'),
(6, 2, 1, 'test', '2022-01-19', 0, 0, 1, 1, '2022-01-09 02:43:07', '2022-01-09 02:56:45'),
(7, 2, 1, 'test', '2022-01-19', 0, 0, 1, 0, '2022-01-09 02:51:16', '2022-01-09 02:51:16'),
(8, 4, 1, 'test', '2022-01-10', 0, 0, 1, 0, '2022-01-09 02:55:50', '2022-01-09 02:55:50'),
(9, 1, 1, 'test', '2022-02-25', 1, 0, 1, 0, '2022-02-25 08:34:54', '2022-02-25 08:56:09'),
(10, 1, 1, 'test', '2022-02-27', 1, 0, 1, 0, '2022-02-25 08:56:10', '2022-02-27 05:29:45'),
(11, 2, 3, 'test', '2022-02-25', 1, 0, 1, 0, '2022-02-25 10:46:54', '2022-02-25 10:54:37'),
(12, 2, 1, 'test', '2022-02-25', 0, 1, 1, 0, '2022-02-25 12:52:25', '2022-02-25 14:03:26'),
(13, 1, 1, 'test', '2022-02-25', 0, 1, 1, 0, '2022-02-25 14:04:34', '2022-02-25 14:05:56'),
(14, 1, 1, 'test', '2022-02-27', 0, 1, 1, 0, '2022-02-27 12:44:49', '2022-02-27 12:45:04'),
(15, 1, 1, 'test', '2022-02-28', 1, 0, 1, 0, '2022-02-28 11:27:59', '2022-02-28 11:28:32'),
(16, 1, 3, '--', '2022-02-28', 0, 1, 1, 0, '2022-02-28 11:35:44', '2022-02-28 11:36:09');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` bigint(20) NOT NULL,
  `abbreviation` varchar(45) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `abbreviation`, `name`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'BSIT', 'Bachelor of Science Major in Information Technology', 0, '2021-12-03 00:13:03', '2021-12-03 00:13:03'),
(2, 'BSCpE', 'Bachelor of Science Major in Computer Engineering', 0, '2021-12-03 00:13:03', '2021-12-03 00:13:03'),
(3, 'BSECE', 'Bachelor of Science Major in Electronics', 0, '2021-12-03 00:13:03', '2021-12-03 00:13:03'),
(4, 'BSCS', 'Bachelor of Science Major in Computer Science', 1, '2021-12-30 07:20:02', '2021-12-30 07:20:57');

-- --------------------------------------------------------

--
-- Table structure for table `dental_certificates`
--

CREATE TABLE `dental_certificates` (
  `dental_certificate_id` bigint(20) NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dental_certificates`
--

INSERT INTO `dental_certificates` (`dental_certificate_id`, `patient_id`, `date_header`, `address`, `sign_name`, `sign_note`, `comment_name`, `comment_note`, `date_given`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, '2021-12-07', 'test', 'sign3', 'test', 'comment3', 'test', '2021-12-16', 0, '2021-12-05 05:41:15', '2021-12-05 05:41:15');

-- --------------------------------------------------------

--
-- Table structure for table `first_aid_kits`
--

CREATE TABLE `first_aid_kits` (
  `first_aid_kit_id` bigint(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `measurement` varchar(100) DEFAULT NULL,
  `quantity` decimal(15,2) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `first_aid_kits`
--

INSERT INTO `first_aid_kits` (`first_aid_kit_id`, `name`, `measurement`, `quantity`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test', '400.00', 0, '2021-12-05 06:03:19', '2021-12-05 12:50:08'),
(2, 'TEST', 'test', '10.00', 0, '2021-12-05 12:49:39', '2021-12-05 12:49:39');

-- --------------------------------------------------------

--
-- Table structure for table `hospitalization_history`
--

CREATE TABLE `hospitalization_history` (
  `hospitalization_history_id` bigint(20) NOT NULL,
  `medical_history_id` bigint(20) DEFAULT NULL,
  `patient_id` bigint(20) DEFAULT NULL,
  `year` varchar(50) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `hospital` text DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hospitalization_history`
--

INSERT INTO `hospitalization_history` (`hospitalization_history_id`, `medical_history_id`, `patient_id`, `year`, `reason`, `hospital`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'test', 'test', 'test', 0, '2022-01-09 02:51:16', '2022-01-09 02:51:16'),
(2, 2, 4, 'test', 'test', 'test', 0, '2022-01-09 02:55:50', '2022-01-09 02:55:50'),
(3, 3, 1, '', '', '', 0, '2022-02-25 08:56:09', '2022-02-25 08:56:09');

-- --------------------------------------------------------

--
-- Table structure for table `measurements`
--

CREATE TABLE `measurements` (
  `measurement_id` bigint(20) NOT NULL,
  `abbreviation` varchar(45) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `measurements`
--

INSERT INTO `measurements` (`measurement_id`, `abbreviation`, `name`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Kg', 'Kilogram', 1, '2021-12-03 05:28:29', '2021-12-30 07:15:16'),
(2, 'Mg', 'Miligram', 1, '2021-12-03 05:28:29', '2021-12-30 07:15:20'),
(3, 'Kg', 'Kilogram', 0, '2021-12-30 07:15:32', '2021-12-30 07:15:32'),
(4, 'mg', 'Milligram', 0, '2021-12-30 07:15:43', '2021-12-30 07:15:43'),
(5, 'inch', 'Inches', 0, '2021-12-30 07:15:53', '2021-12-30 07:16:06');

-- --------------------------------------------------------

--
-- Table structure for table `medical_history`
--

CREATE TABLE `medical_history` (
  `medical_history_id` bigint(20) NOT NULL,
  `patient_id` bigint(20) DEFAULT NULL,
  `marital_status` varchar(100) DEFAULT NULL,
  `referring_doctors` text DEFAULT NULL,
  `last_physical_exam` date DEFAULT NULL,
  `is_vaccinated` varchar(50) DEFAULT NULL,
  `covid_patient` varchar(50) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medical_history`
--

INSERT INTO `medical_history` (`medical_history_id`, `patient_id`, `marital_status`, `referring_doctors`, `last_physical_exam`, `is_vaccinated`, `covid_patient`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 2, 'Single', 'test', '2022-02-02', 'Yes', 'Yes', 0, '2022-01-09 02:51:15', '2022-01-09 02:51:15'),
(2, 4, 'Single', 'test', '2022-01-06', 'Yes', 'Yes', 0, '2022-01-09 02:55:49', '2022-01-09 02:55:49'),
(3, 1, 'Single', 'test', '2022-02-23', 'Yes', 'Yes', 0, '2022-02-25 08:56:09', '2022-02-25 08:56:09');

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `medicine_id` bigint(20) NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`medicine_id`, `name`, `brand`, `unit_id`, `measurement_id`, `category_id`, `quantity`, `reorder`, `capacity`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Biogesic', '', 5, 4, 2, NULL, 10, 100, 0, '2022-01-01 13:50:42', '2022-01-08 06:27:18'),
(2, 'Neosep', '', 5, 4, NULL, NULL, NULL, NULL, 0, '2022-01-01 13:50:56', '2022-01-01 13:50:56'),
(3, 'Buscupan', '', 5, 4, 2, NULL, NULL, NULL, 0, '2022-01-01 13:51:09', '2022-01-08 05:58:38'),
(4, 'Syndex Forte', '', 5, 3, 2, NULL, 10, 1000, 0, '2022-01-01 13:51:25', '2022-01-08 09:51:44'),
(5, 'Mefinamic Acid', '', 4, 4, NULL, NULL, NULL, NULL, 0, '2022-01-01 13:51:40', '2022-01-01 13:51:40'),
(6, 'test2', 'test', 1, 3, 2, NULL, NULL, NULL, 1, '2022-01-08 06:01:28', '2022-01-08 06:01:44');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_transactions`
--

CREATE TABLE `medicine_transactions` (
  `medicine_transaction_id` bigint(20) NOT NULL,
  `check_up_id` bigint(20) DEFAULT NULL,
  `medicine_id` bigint(20) DEFAULT NULL,
  `stocks` decimal(15,2) DEFAULT NULL,
  `quantity` decimal(15,2) DEFAULT NULL,
  `remaining` decimal(15,2) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicine_transactions`
--

INSERT INTO `medicine_transactions` (`medicine_transaction_id`, `check_up_id`, `medicine_id`, `stocks`, `quantity`, `remaining`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '100.00', '50.00', '50.00', 0, '2021-12-05 05:39:20', '2021-12-05 05:39:20'),
(2, 1, 2, '850.00', '800.00', '50.00', 0, '2021-12-05 05:39:20', '2021-12-05 05:39:20');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` bigint(20) NOT NULL,
  `is_admin` bigint(20) DEFAULT NULL,
  `patient_id` bigint(20) DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `is_read` int(11) DEFAULT 0,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `is_admin`, `patient_id`, `message`, `is_read`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'ako lang naglagay nya', 1, 0, '2022-02-27 12:45:45', '2022-02-27 12:45:59'),
(2, 0, 1, 'ano naman', 1, 0, '2022-02-27 12:45:59', '2022-02-27 12:46:03'),
(3, 1, 1, 'ha?', 1, 0, '2022-02-27 12:46:03', '2022-02-27 12:46:10'),
(4, 0, 1, 'test', 1, 0, '2022-02-27 12:46:10', '2022-02-27 12:46:21'),
(5, 1, 1, 'okay', 1, 0, '2022-02-27 12:46:20', '2022-02-28 11:24:20'),
(6, 0, 1, '.', 1, 0, '2022-02-28 11:24:20', '2022-02-28 11:26:50'),
(7, 0, 1, '.', 1, 0, '2022-02-28 11:24:23', '2022-02-28 11:26:50'),
(8, 0, 1, '.', 1, 0, '2022-02-28 11:24:26', '2022-02-28 11:26:50'),
(9, 0, 1, 'test', 1, 0, '2022-02-28 11:26:35', '2022-02-28 11:26:50'),
(10, 1, 1, 'test', 1, 0, '2022-02-28 11:26:50', '2022-03-07 10:51:41'),
(11, 1, 1, 'test', 1, 0, '2022-02-28 11:27:05', '2022-03-07 10:51:41'),
(12, 0, 1, 'test', 1, 0, '2022-03-07 10:51:40', '2022-03-10 11:21:43'),
(13, 0, 2, 'test', 1, 0, '2022-03-07 10:52:09', '2022-03-07 11:00:07'),
(14, 0, 1, 'test', 1, 0, '2022-03-07 10:58:33', '2022-03-10 11:21:43'),
(15, 0, 1, 'test', 1, 0, '2022-03-07 10:58:40', '2022-03-10 11:21:43'),
(16, 0, 1, 'ha', 1, 0, '2022-03-07 10:59:49', '2022-03-10 11:21:43'),
(17, 1, 2, 'test', 1, 0, '2022-03-07 11:00:07', '2022-03-07 11:01:09'),
(18, 0, 2, 'RJ', 1, 0, '2022-03-07 11:01:09', '2022-03-07 11:02:58'),
(19, 0, 1, '1st', 1, 0, '2022-03-07 11:01:18', '2022-03-10 11:21:43'),
(20, 0, 1, 'ta', 1, 0, '2022-03-07 11:01:29', '2022-03-10 11:21:43'),
(21, 0, 1, 'JOHN', 1, 0, '2022-03-07 11:02:50', '2022-03-10 11:21:43'),
(22, 1, 2, 'test', 1, 0, '2022-03-07 11:02:58', '2022-03-07 11:03:29'),
(23, 0, 2, '1st', 1, 0, '2022-03-07 11:03:29', '2022-03-10 10:27:52'),
(24, 0, 1, '1st', 1, 0, '2022-03-07 11:03:36', '2022-03-10 11:21:43'),
(25, 0, 4, 'test', 0, 0, '2022-03-10 10:27:32', '2022-03-10 10:27:32'),
(26, 1, 2, 'test', 1, 0, '2022-03-10 10:27:52', '2022-03-10 10:29:25'),
(27, 0, 2, 'ha', 0, 0, '2022-03-10 10:29:25', '2022-03-10 10:29:25'),
(28, 0, 2, 'who me', 0, 0, '2022-03-10 10:35:59', '2022-03-10 10:35:59'),
(29, 0, 2, 't6st', 0, 0, '2022-03-10 10:40:33', '2022-03-10 10:40:33'),
(30, 0, 2, 'test', 0, 0, '2022-03-10 10:54:34', '2022-03-10 10:54:34'),
(31, 0, 2, '123', 0, 0, '2022-03-10 10:57:44', '2022-03-10 10:57:44'),
(32, 0, 2, 'dsa', 0, 0, '2022-03-10 10:59:41', '2022-03-10 10:59:41'),
(33, 0, 2, 'test', 0, 0, '2022-03-10 11:00:50', '2022-03-10 11:00:50'),
(34, 0, 2, '12345', 0, 0, '2022-03-10 11:01:39', '2022-03-10 11:01:39'),
(35, 0, 1, 'get top', 1, 0, '2022-03-10 11:21:28', '2022-03-10 11:21:43'),
(36, 1, 1, 'okay', 1, 0, '2022-03-10 11:21:43', '2022-03-10 11:42:17'),
(37, 0, 4, 'get top', 0, 0, '2022-03-10 11:23:58', '2022-03-10 11:23:58'),
(38, 0, 1, 'OKI', 1, 0, '2022-03-10 11:42:17', '2022-03-10 11:46:20'),
(39, 1, 1, 'te', 0, 0, '2022-03-10 11:46:20', '2022-03-10 11:46:20'),
(40, 0, 2, '123', 0, 0, '2022-03-10 11:47:01', '2022-03-10 11:47:01'),
(41, 0, 2, '123', 0, 0, '2022-03-10 11:47:05', '2022-03-10 11:47:05'),
(42, 0, 2, 'dsa', 0, 0, '2022-03-10 11:47:16', '2022-03-10 11:47:16');

-- --------------------------------------------------------

--
-- Table structure for table `monitoring_forms`
--

CREATE TABLE `monitoring_forms` (
  `monitoring_form_id` bigint(20) NOT NULL,
  `check_up_id` bigint(20) DEFAULT NULL,
  `patient_id` bigint(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0 - Ongoing\n1 - Done\n2 - Cancelled',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `monitoring_forms`
--

INSERT INTO `monitoring_forms` (`monitoring_form_id`, `check_up_id`, `patient_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 16, 1, 1, '2022-02-28 11:29:17', '2022-02-28 11:31:12'),
(2, 17, 1, 0, '2022-02-28 11:32:38', '2022-02-28 11:32:38');

-- --------------------------------------------------------

--
-- Table structure for table `monitoring_form_items`
--

CREATE TABLE `monitoring_form_items` (
  `monitoring_form_item_id` bigint(20) NOT NULL,
  `monitoring_form_id` bigint(20) DEFAULT NULL,
  `patient_id` bigint(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `patient_case` text DEFAULT NULL,
  `activity` text DEFAULT NULL,
  `medicine_taken` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0 - Serious/Bad\n1 - Fair\n2 - Good',
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `monitoring_form_items`
--

INSERT INTO `monitoring_form_items` (`monitoring_form_item_id`, `monitoring_form_id`, `patient_id`, `date`, `time`, `patient_case`, `activity`, `medicine_taken`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-02-28', '01:00:00', 'test', 'tes', 'tes', 1, 0, '2022-02-28 11:30:28', '2022-02-28 11:30:28'),
(2, 1, 1, '2022-02-28', '16:00:00', '--', '--', '--', 2, 0, '2022-02-28 11:31:12', '2022-02-28 11:31:12');

-- --------------------------------------------------------

--
-- Table structure for table `office_supply`
--

CREATE TABLE `office_supply` (
  `office_supply_id` bigint(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `unit_id` bigint(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `reorder` int(11) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `office_supply`
--

INSERT INTO `office_supply` (`office_supply_id`, `name`, `unit_id`, `quantity`, `reorder`, `capacity`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Coupon Bond A4', 1, NULL, NULL, NULL, 0, '2022-01-01 13:53:38', '2022-01-01 13:53:58'),
(2, 'Coupon Bond Long', 1, NULL, NULL, NULL, 0, '2022-01-01 13:53:52', '2022-01-01 13:53:52'),
(3, 'Floder Long', 1, NULL, NULL, NULL, 0, '2022-01-01 13:54:07', '2022-01-01 13:54:07'),
(4, 'Envelop Long', 1, NULL, NULL, NULL, 0, '2022-01-01 13:54:19', '2022-01-01 13:54:19');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patient_id` bigint(20) NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patient_id`, `patient_code`, `patient_type_id`, `course_id`, `year_id`, `email`, `password`, `firstname`, `middlename`, `lastname`, `suffix`, `age`, `gender`, `section`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, '16-2423', 2, 1, 2, 'johndoe@gmail.com', 'johndoe', 'John', 'Verdadero', 'Mapagmahal', '', 28, 'Male', 'G', 0, '2021-12-05 05:25:15', '2022-01-08 09:13:57'),
(2, '16-7500', 2, 1, 3, 'rjpinca@gmail.com', 'rjpinca', 'RJ', '', 'Pinca', '', 25, 'Male', '25G', 0, '2022-01-08 09:12:36', '2022-01-08 09:12:36'),
(3, '98-1569', 1, 0, 0, 'milesestacio@gmail.com', 'milesestacio', 'Miles', '', 'Estacio', 'II', 40, 'Female', '', 0, '2022-01-08 09:14:47', '2022-01-08 09:14:47'),
(4, '16-2426', 3, 0, 0, 'arvin@gmail.com', 'arvin', 'Arvin', '', 'Gil', '', 23, 'Male', '', 0, '2022-01-08 09:26:58', '2022-03-10 10:27:13');

-- --------------------------------------------------------

--
-- Table structure for table `patient_type`
--

CREATE TABLE `patient_type` (
  `patient_type_id` bigint(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='1 - Faculty\n2 - Students\n3 - Others';

--
-- Dumping data for table `patient_type`
--

INSERT INTO `patient_type` (`patient_type_id`, `name`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Faculty', 0, '2021-12-02 04:58:27', '2021-12-02 04:58:27'),
(2, 'Student', 0, '2021-12-02 04:58:27', '2021-12-02 04:58:27'),
(3, 'Non-Teaching', 0, '2021-12-02 05:10:24', '2021-12-04 18:12:25'),
(4, 'External Stakeholders', 0, '2021-12-04 18:12:25', '2021-12-04 18:12:25'),
(5, 'Others', 0, '2021-12-04 18:12:34', '2021-12-04 18:12:34');

-- --------------------------------------------------------

--
-- Table structure for table `personal_health_history`
--

CREATE TABLE `personal_health_history` (
  `personal_health_history_id` bigint(20) NOT NULL,
  `medical_history_id` bigint(20) DEFAULT NULL,
  `patient_id` bigint(20) DEFAULT NULL,
  `childhood_illness` text DEFAULT NULL,
  `immunization` text DEFAULT NULL,
  `medical_problems` text DEFAULT NULL,
  `blood_transmission` text DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `personal_health_history`
--

INSERT INTO `personal_health_history` (`personal_health_history_id`, `medical_history_id`, `patient_id`, `childhood_illness`, `immunization`, `medical_problems`, `blood_transmission`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Measles|Chickenpox|Rheumatic Fever', 'Measles|Chickenpox|Rheumatic Fever|Tetanus|Pheumonia|Hepatatis', 'test', 'Yes', 0, '2022-01-09 02:51:15', '2022-01-09 02:51:15'),
(2, 2, 4, 'Mumps', 'Mumps|Pheumonia', 'test', 'Yes', 0, '2022-01-09 02:55:50', '2022-01-09 02:55:50'),
(3, 3, 1, 'Measles', 'Measles|Tetanus', 'test', 'Yes', 0, '2022-02-25 08:56:09', '2022-02-25 08:56:09');

-- --------------------------------------------------------

--
-- Table structure for table `prescribed_drug_history`
--

CREATE TABLE `prescribed_drug_history` (
  `prescribed_drug_history_id` bigint(20) NOT NULL,
  `medical_history_id` bigint(20) DEFAULT NULL,
  `patient_id` bigint(20) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `strength` text DEFAULT NULL,
  `frequently_taken` text DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prescribed_drug_history`
--

INSERT INTO `prescribed_drug_history` (`prescribed_drug_history_id`, `medical_history_id`, `patient_id`, `name`, `strength`, `frequently_taken`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'test', 'test', 'test', 0, '2022-01-09 02:51:16', '2022-01-09 02:51:16'),
(2, 1, 2, 'test', 'test', 'test', 0, '2022-01-09 02:51:16', '2022-01-09 02:51:16'),
(3, 2, 4, 'test', 'test', 'test', 0, '2022-01-09 02:55:50', '2022-01-09 02:55:50'),
(4, 2, 4, 'test', 'test', 'test', 0, '2022-01-09 02:55:50', '2022-01-09 02:55:50'),
(5, 3, 1, 'Gallon', 'test', 'test', 0, '2022-02-25 08:56:09', '2022-02-25 08:56:09');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_request`
--

CREATE TABLE `purchase_request` (
  `purchase_request_id` bigint(20) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_request`
--

INSERT INTO `purchase_request` (`purchase_request_id`, `code`, `reason`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'PR-00001', '', 2, 0, '2022-01-02 05:40:54', '2022-01-02 10:24:39'),
(2, 'PR-00002', 'test', 1, 0, '2022-01-02 05:47:04', '2022-01-02 10:25:02');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_request_care_equipment`
--

CREATE TABLE `purchase_request_care_equipment` (
  `purchase_request_care_equipment_id` bigint(20) NOT NULL,
  `purchase_request_id` bigint(20) DEFAULT NULL,
  `care_equipment_id` bigint(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit_cost` decimal(15,2) DEFAULT NULL,
  `total_cost` decimal(15,2) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_request_care_equipment`
--

INSERT INTO `purchase_request_care_equipment` (`purchase_request_care_equipment_id`, `purchase_request_id`, `care_equipment_id`, `quantity`, `unit_cost`, `total_cost`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 10, '100.00', '1000.00', 0, '2022-01-02 05:40:54', '2022-01-02 05:40:54'),
(2, 1, 2, 10, '200.00', '2000.00', 0, '2022-01-02 05:40:54', '2022-01-02 05:40:54'),
(3, 1, 3, 10, '300.00', '3000.00', 0, '2022-01-02 05:40:54', '2022-01-02 05:40:54');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_request_medicine`
--

CREATE TABLE `purchase_request_medicine` (
  `purchase_request_medicine_id` bigint(20) NOT NULL,
  `purchase_request_id` bigint(20) DEFAULT NULL,
  `medicine_id` bigint(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit_cost` decimal(15,2) DEFAULT NULL,
  `total_cost` decimal(15,2) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_request_medicine`
--

INSERT INTO `purchase_request_medicine` (`purchase_request_medicine_id`, `purchase_request_id`, `medicine_id`, `quantity`, `unit_cost`, `total_cost`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 10, '500.00', '5000.00', 0, '2022-01-02 05:40:54', '2022-01-02 05:40:54'),
(2, 1, 2, 10, '600.00', '6000.00', 0, '2022-01-02 05:40:54', '2022-01-02 05:40:54'),
(3, 2, 1, 100, '500.00', '50000.00', 0, '2022-01-02 05:47:04', '2022-01-02 05:47:04');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_request_office_supply`
--

CREATE TABLE `purchase_request_office_supply` (
  `purchase_request_office_supply_id` bigint(20) NOT NULL,
  `purchase_request_id` bigint(20) DEFAULT NULL,
  `office_supply_id` bigint(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit_cost` decimal(15,2) DEFAULT NULL,
  `total_cost` decimal(15,2) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_request_office_supply`
--

INSERT INTO `purchase_request_office_supply` (`purchase_request_office_supply_id`, `purchase_request_id`, `office_supply_id`, `quantity`, `unit_cost`, `total_cost`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 100, '50.00', '5000.00', 0, '2022-01-02 05:40:55', '2022-01-02 05:40:55');

-- --------------------------------------------------------

--
-- Table structure for table `referral_forms`
--

CREATE TABLE `referral_forms` (
  `referral_form_id` bigint(20) NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `referral_forms`
--

INSERT INTO `referral_forms` (`referral_form_id`, `date`, `to_doctor`, `patient_id`, `address`, `chief_complaint`, `illness_history`, `medicine_given`, `impression`, `referral_reason`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, '2022-01-22', 'test', 2, 'test', 'test', 'test', 'test', 'test', 'For further evaluation and management', 0, '2022-01-08 11:52:37', '2022-02-27 05:28:50'),
(2, '2022-02-04', 'test', 4, 'test', 'test', 'test', 'test', 'test', 'For further evaluation and management', 1, '2022-01-08 11:55:02', '2022-01-08 11:55:17');

-- --------------------------------------------------------

--
-- Table structure for table `refer_drug_history`
--

CREATE TABLE `refer_drug_history` (
  `refer_drug_history_id` bigint(20) NOT NULL,
  `medical_history_id` bigint(20) DEFAULT NULL,
  `patient_id` bigint(20) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `reaction` text DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` bigint(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `name`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Nurse', 0, '2021-12-04 11:13:57', '2021-12-04 11:13:57'),
(2, 'Doctor', 0, '2021-12-04 11:13:57', '2021-12-04 11:13:57'),
(3, 'Dentist', 0, '2021-12-04 11:13:57', '2021-12-04 11:13:57'),
(4, 'Physician', 0, '2021-12-04 11:13:57', '2021-12-04 11:13:57');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `section_id` bigint(20) NOT NULL,
  `course_id` bigint(20) DEFAULT NULL,
  `year_id` bigint(20) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`section_id`, `course_id`, `year_id`, `name`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Ha?', 1, '2021-12-30 07:43:17', '2021-12-30 07:47:15'),
(2, 1, 3, '2g', 0, '2021-12-30 07:45:51', '2021-12-30 07:45:51');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` bigint(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='1 - Medical\n2 - Dental\n3 - Dispensing Medicine';

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `name`, `description`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Medical', 'Sample Description', 0, '2021-12-04 00:49:07', '2021-12-04 00:49:07'),
(2, 'Dental', 'Sample Description', 1, '2021-12-04 00:49:07', '2022-01-09 00:52:53'),
(3, 'Dispensing Medicine', 'Sample Description', 0, '2021-12-04 04:52:19', '2021-12-04 04:52:19');

-- --------------------------------------------------------

--
-- Table structure for table `stock_in`
--

CREATE TABLE `stock_in` (
  `stock_in_id` bigint(20) NOT NULL,
  `purchase_request_id` bigint(20) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_in`
--

INSERT INTO `stock_in` (`stock_in_id`, `purchase_request_id`, `code`, `reason`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 0, 'SI-00001', 'already have', 0, '2022-01-01 13:56:30', '2022-01-01 14:11:09'),
(2, 1, 'SI-00002', 'test', 0, '2022-01-02 08:20:54', '2022-01-02 08:20:54'),
(3, 2, 'SI-00003', 'test', 0, '2022-01-02 10:42:45', '2022-01-02 10:42:45'),
(4, 0, 'SI-00004', 'test', 0, '2022-01-08 02:07:29', '2022-01-08 02:07:30'),
(5, 2, 'SI-00005', '', 0, '2022-01-08 05:46:24', '2022-01-08 05:46:25');

-- --------------------------------------------------------

--
-- Table structure for table `stock_in_care_equipment`
--

CREATE TABLE `stock_in_care_equipment` (
  `stock_in_care_equipment_id` bigint(20) NOT NULL,
  `stock_in_id` bigint(20) DEFAULT NULL,
  `care_equipment_id` bigint(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `remaining` int(11) DEFAULT NULL,
  `batch` varchar(100) DEFAULT NULL,
  `expiration` date DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_in_care_equipment`
--

INSERT INTO `stock_in_care_equipment` (`stock_in_care_equipment_id`, `stock_in_id`, `care_equipment_id`, `quantity`, `remaining`, `batch`, `expiration`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 100, 100, '1', '2022-02-05', 0, '2022-01-01 13:56:30', '2022-01-09 01:48:54'),
(2, 1, 2, 100, 5, '1', '2022-02-05', 0, '2022-01-01 13:56:30', '2022-01-09 02:55:49'),
(3, 1, 3, 100, 100, '1', '2022-02-05', 0, '2022-01-01 13:56:30', '2022-01-09 01:48:54'),
(4, 1, 4, 100, 50, '1', '2022-02-05', 0, '2022-01-01 13:56:30', '2022-01-09 02:43:07'),
(5, 1, 5, 100, 100, '1', '2022-02-05', 0, '2022-01-01 13:56:30', '2022-01-09 01:48:54'),
(6, 2, 1, 10, 10, '', '0000-00-00', 0, '2022-01-02 08:20:55', '2022-01-09 01:48:54'),
(7, 2, 2, 10, 0, '', '0000-00-00', 0, '2022-01-02 08:20:55', '2022-01-09 02:39:28'),
(8, 2, 3, 10, 10, '', '0000-00-00', 0, '2022-01-02 08:20:55', '2022-01-09 01:48:54'),
(9, 4, 1, 100, 100, '1', '2022-01-20', 0, '2022-01-08 02:07:30', '2022-01-08 02:07:30');

-- --------------------------------------------------------

--
-- Table structure for table `stock_in_medicine`
--

CREATE TABLE `stock_in_medicine` (
  `stock_in_medicine_id` bigint(20) NOT NULL,
  `stock_in_id` bigint(20) DEFAULT NULL,
  `medicine_id` bigint(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `remaining` int(11) DEFAULT NULL,
  `batch` varchar(100) DEFAULT NULL,
  `expiration` date DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_in_medicine`
--

INSERT INTO `stock_in_medicine` (`stock_in_medicine_id`, `stock_in_id`, `medicine_id`, `quantity`, `remaining`, `batch`, `expiration`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 100, 0, '1', '2022-01-21', 0, '2022-01-01 13:56:30', '2022-01-08 04:03:16'),
(2, 1, 2, 100, 90, '1', '2022-01-21', 0, '2022-01-01 13:56:30', '2022-02-25 08:56:09'),
(3, 1, 3, 100, 90, '1', '2022-01-27', 0, '2022-01-01 13:56:30', '2022-01-09 02:55:49'),
(4, 1, 4, 100, 25, '1', '2022-01-20', 0, '2022-01-01 13:56:30', '2022-01-09 03:44:42'),
(5, 1, 5, 100, 50, '1', '2022-01-21', 0, '2022-01-01 13:56:30', '2022-01-08 04:47:19'),
(6, 2, 1, 1, 0, '2', '2022-01-21', 0, '2022-01-02 08:20:54', '2022-01-03 11:16:19'),
(7, 2, 2, 10, 0, '2', '0000-00-00', 0, '2022-01-02 08:20:54', '2022-01-09 02:51:15'),
(8, 3, 1, 5, 0, '2', '2022-01-23', 0, '2022-01-02 10:42:45', '2022-01-08 04:35:26'),
(9, 5, 1, 50, 0, '1', '0000-00-00', 0, '2022-01-08 05:46:25', '2022-01-09 02:39:57');

-- --------------------------------------------------------

--
-- Table structure for table `stock_in_office_supply`
--

CREATE TABLE `stock_in_office_supply` (
  `stock_in_office_supply_id` bigint(20) NOT NULL,
  `stock_in_id` bigint(20) DEFAULT NULL,
  `office_supply_id` bigint(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `remaining` int(11) DEFAULT NULL,
  `batch` varchar(100) DEFAULT NULL,
  `expiration` date DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_in_office_supply`
--

INSERT INTO `stock_in_office_supply` (`stock_in_office_supply_id`, `stock_in_id`, `office_supply_id`, `quantity`, `remaining`, `batch`, `expiration`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 100, NULL, '1', '2022-01-29', 0, '2022-01-01 13:56:31', '2022-01-01 13:56:31'),
(2, 1, 3, 100, NULL, '1', '2022-01-07', 0, '2022-01-01 13:56:31', '2022-01-01 13:56:31'),
(3, 1, 4, 100, NULL, '1', '2022-01-27', 0, '2022-01-01 13:56:31', '2022-01-01 13:56:31'),
(4, 1, 1, 100, NULL, '1', '2022-01-28', 0, '2022-01-01 13:56:31', '2022-01-01 13:56:31'),
(5, 2, 1, 100, NULL, '', '0000-00-00', 0, '2022-01-02 08:20:55', '2022-01-02 08:20:55');

-- --------------------------------------------------------

--
-- Table structure for table `stock_out`
--

CREATE TABLE `stock_out` (
  `stock_out_id` bigint(20) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_out`
--

INSERT INTO `stock_out` (`stock_out_id`, `code`, `reason`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'SO-00001', '', 0, '2022-01-07 21:02:39', '2022-01-08 04:02:39'),
(2, 'SO-00002', 'test', 0, '2022-01-07 21:03:16', '2022-01-08 04:03:16'),
(3, 'SO-00003', 'remove biogesic', 0, '2022-01-07 21:35:25', '2022-01-08 04:35:26'),
(4, 'SO-00004', 'mefenamic acid', 0, '2022-01-07 21:47:19', '2022-01-08 04:47:19'),
(5, 'SO-00005', 'biogesic', 0, '2022-01-08 18:28:23', '2022-01-09 01:28:23');

-- --------------------------------------------------------

--
-- Table structure for table `stock_out_care_equipment`
--

CREATE TABLE `stock_out_care_equipment` (
  `stock_out_care_equipment_id` bigint(20) NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_out_care_equipment`
--

INSERT INTO `stock_out_care_equipment` (`stock_out_care_equipment_id`, `stock_out_id`, `stock_in_care_equipment_id`, `check_up_id`, `patient_id`, `care_equipment_id`, `quantity`, `remaining`, `batch`, `expiration`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 5, 2, 2, 10, NULL, NULL, NULL, 0, '2022-01-09 02:41:24', '2022-01-09 02:41:24'),
(2, NULL, NULL, 5, 2, 4, 10, NULL, NULL, NULL, 0, '2022-01-09 02:41:24', '2022-01-09 02:41:24'),
(3, NULL, NULL, 6, 2, 2, 10, NULL, NULL, NULL, 0, '2022-01-09 02:41:46', '2022-01-09 02:41:46'),
(4, NULL, NULL, 6, 2, 4, 10, NULL, NULL, NULL, 0, '2022-01-09 02:41:46', '2022-01-09 02:41:46'),
(5, NULL, NULL, 7, 2, 2, 10, NULL, NULL, NULL, 0, '2022-01-09 02:43:07', '2022-01-09 02:43:07'),
(6, NULL, NULL, 7, 2, 4, 10, NULL, NULL, NULL, 0, '2022-01-09 02:43:07', '2022-01-09 02:43:07'),
(7, NULL, NULL, 8, 2, 2, 50, NULL, NULL, NULL, 0, '2022-01-09 02:51:15', '2022-01-09 02:51:15'),
(8, NULL, NULL, 9, 4, 2, 5, NULL, NULL, NULL, 0, '2022-01-09 02:55:49', '2022-01-09 02:55:49');

-- --------------------------------------------------------

--
-- Table structure for table `stock_out_medicine`
--

CREATE TABLE `stock_out_medicine` (
  `stock_out_medicine_id` bigint(20) NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_out_medicine`
--

INSERT INTO `stock_out_medicine` (`stock_out_medicine_id`, `stock_out_id`, `check_up_id`, `patient_id`, `medicine_id`, `quantity`, `remaining`, `batch`, `expiration`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, NULL, 1, 100, 100, NULL, NULL, 0, '2022-01-08 04:03:16', '2022-01-08 04:03:16'),
(2, 3, NULL, NULL, 1, 5, 5, NULL, NULL, 0, '2022-01-08 04:35:26', '2022-01-08 04:35:26'),
(3, 4, NULL, NULL, 5, 50, 50, NULL, NULL, 0, '2022-01-08 04:47:19', '2022-01-08 04:47:19'),
(4, 5, NULL, NULL, 1, 10, 10, NULL, NULL, 0, '2022-01-09 01:28:24', '2022-01-09 01:28:24'),
(5, NULL, 1, 2, 1, 10, NULL, NULL, NULL, 0, '2022-01-09 02:38:31', '2022-01-09 02:38:31'),
(6, NULL, 1, 2, 4, 10, NULL, NULL, NULL, 0, '2022-01-09 02:38:31', '2022-01-09 02:38:31'),
(7, NULL, 2, 2, 1, 10, NULL, NULL, NULL, 0, '2022-01-09 02:39:02', '2022-01-09 02:39:02'),
(8, NULL, 2, 2, 4, 10, NULL, NULL, NULL, 0, '2022-01-09 02:39:02', '2022-01-09 02:39:02'),
(9, NULL, 3, 2, 1, 10, NULL, NULL, NULL, 0, '2022-01-09 02:39:28', '2022-01-09 02:39:28'),
(10, NULL, 3, 2, 4, 10, NULL, NULL, NULL, 0, '2022-01-09 02:39:28', '2022-01-09 02:39:28'),
(11, NULL, 4, 2, 1, 10, NULL, NULL, NULL, 0, '2022-01-09 02:39:57', '2022-01-09 02:39:57'),
(12, NULL, 4, 2, 4, 10, NULL, NULL, NULL, 0, '2022-01-09 02:39:57', '2022-01-09 02:39:57'),
(13, NULL, 5, 2, 1, 10, NULL, NULL, NULL, 0, '2022-01-09 02:41:24', '2022-01-09 02:41:24'),
(14, NULL, 5, 2, 4, 10, NULL, NULL, NULL, 0, '2022-01-09 02:41:24', '2022-01-09 02:41:24'),
(15, NULL, 6, 2, 1, 10, NULL, NULL, NULL, 0, '2022-01-09 02:41:45', '2022-01-09 02:41:45'),
(16, NULL, 6, 2, 4, 10, NULL, NULL, NULL, 0, '2022-01-09 02:41:45', '2022-01-09 02:41:45'),
(17, NULL, 7, 2, 1, 10, NULL, NULL, NULL, 0, '2022-01-09 02:43:07', '2022-01-09 02:43:07'),
(18, NULL, 7, 2, 4, 10, NULL, NULL, NULL, 0, '2022-01-09 02:43:07', '2022-01-09 02:43:07'),
(19, NULL, 8, 2, 2, 10, NULL, NULL, NULL, 0, '2022-01-09 02:51:15', '2022-01-09 02:51:15'),
(20, NULL, 9, 4, 3, 10, NULL, NULL, NULL, 0, '2022-01-09 02:55:49', '2022-01-09 02:55:49'),
(21, NULL, 10, 1, 2, 5, NULL, NULL, NULL, 0, '2022-01-09 03:44:42', '2022-01-09 03:44:42'),
(22, NULL, 10, 1, 4, 5, NULL, NULL, NULL, 0, '2022-01-09 03:44:42', '2022-01-09 03:44:42'),
(23, NULL, 11, 1, 2, 5, NULL, NULL, NULL, 0, '2022-02-25 08:56:09', '2022-02-25 08:56:09'),
(24, NULL, 15, 2, 1, 0, NULL, NULL, NULL, 0, '2022-02-25 10:54:37', '2022-02-25 10:54:37');

-- --------------------------------------------------------

--
-- Table structure for table `stock_out_office_supply`
--

CREATE TABLE `stock_out_office_supply` (
  `stock_out_office_supply_id` bigint(20) NOT NULL,
  `stock_out_id` bigint(20) DEFAULT NULL,
  `stock_in_office_supply_id` bigint(20) DEFAULT NULL,
  `office_supply_id` bigint(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `remaining` int(11) DEFAULT NULL,
  `batch` varchar(100) DEFAULT NULL,
  `expiration` date DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `surgery_history`
--

CREATE TABLE `surgery_history` (
  `surgery_history_id` bigint(20) NOT NULL,
  `medical_history_id` bigint(20) DEFAULT NULL,
  `patient_id` bigint(20) DEFAULT NULL,
  `year` varchar(50) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `hospital` text DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surgery_history`
--

INSERT INTO `surgery_history` (`surgery_history_id`, `medical_history_id`, `patient_id`, `year`, `reason`, `hospital`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'test', 'test', 'test', 0, '2022-01-09 02:51:15', '2022-01-09 02:51:15'),
(2, 1, 2, 'test', 'test', 'test', 0, '2022-01-09 02:51:15', '2022-01-09 02:51:15'),
(3, 2, 4, 'test', 'test', 'test', 0, '2022-01-09 02:55:50', '2022-01-09 02:55:50'),
(4, 3, 1, '1999', 'test', 'test', 0, '2022-02-25 08:56:09', '2022-02-25 08:56:09');

-- --------------------------------------------------------

--
-- Table structure for table `surveys`
--

CREATE TABLE `surveys` (
  `survey_id` bigint(20) NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surveys`
--

INSERT INTO `surveys` (`survey_id`, `check_up_id`, `patient_id`, `status`, `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `q7`, `q8`, `q9`, `q10`, `comments`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 5, 4, 3, 2, 1, 2, 3, 4, 5, 4, NULL, 0, '2021-12-05 05:39:20', '2021-12-05 05:57:46'),
(2, 2, 1, 1, 1, 1, 2, 1, 2, 1, 1, 1, 1, 4, NULL, 0, '2021-08-05 05:39:20', '2021-12-05 11:35:43'),
(3, 7, 2, 1, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, NULL, 0, '2022-01-09 02:43:07', '2022-02-27 05:30:23'),
(4, 8, 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2022-01-09 02:51:16', '2022-01-09 02:51:16'),
(5, 9, 4, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2022-01-09 02:55:50', '2022-01-09 02:55:50'),
(6, 10, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2022-01-09 03:44:42', '2022-01-09 03:44:42'),
(7, 11, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2022-02-25 08:56:10', '2022-02-25 08:56:10'),
(8, 12, 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2022-02-25 10:50:18', '2022-02-25 10:50:18'),
(9, 13, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2022-02-25 10:52:23', '2022-02-25 10:52:23'),
(10, 14, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2022-02-25 10:54:07', '2022-02-25 10:54:07'),
(11, 15, 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2022-02-25 10:54:37', '2022-02-25 10:54:37'),
(12, 16, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2022-02-28 11:28:32', '2022-02-28 11:28:32'),
(13, 17, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2022-02-28 11:32:30', '2022-02-28 11:32:30');

-- --------------------------------------------------------

--
-- Table structure for table `system_setup`
--

CREATE TABLE `system_setup` (
  `system_setup_id` bigint(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_setup`
--

INSERT INTO `system_setup` (`system_setup_id`, `email`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'clinic@gmail.com', 0, '2022-01-08 08:28:10', '2022-01-09 00:51:29');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `unit_id` bigint(20) NOT NULL,
  `abbreviation` varchar(45) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unit_id`, `abbreviation`, `name`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'box', 'Boxes', 0, '2021-12-30 06:56:30', '2021-12-30 07:11:57'),
(2, 'gal', 'Gallons', 1, '2021-12-30 07:09:55', '2021-12-31 14:53:20'),
(3, '321', 'Boxes', 1, '2021-12-30 07:12:31', '2021-12-30 07:12:57'),
(4, 'gal', 'Gallon', 0, '2022-01-01 13:48:40', '2022-01-01 13:48:40'),
(5, 'pcs', 'Pieces', 0, '2022-01-01 13:50:18', '2022-01-01 13:50:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_code`, `role_id`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `age`, `email`, `password`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'US-000001', 1, 'Akosin', '', 'Admin', '', 'Female', '20', 'admin@gmail.com', 'admin', 0, '2021-12-02 06:18:25', '2021-12-04 15:32:32'),
(2, NULL, NULL, 'TEST', '', 'Admin', '', 'Male', '18', 'test@gmail.com', 'test', 1, '2021-12-04 11:33:02', '2021-12-04 11:34:21');

-- --------------------------------------------------------

--
-- Table structure for table `years`
--

CREATE TABLE `years` (
  `year_id` bigint(20) NOT NULL,
  `course_id` bigint(20) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `years`
--

INSERT INTO `years` (`year_id`, `course_id`, `name`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, '101G', 1, '2021-12-30 07:30:45', '2021-12-30 07:31:07'),
(2, 1, 'First Year', 0, '2021-12-30 07:30:58', '2021-12-30 07:44:00'),
(3, 1, 'Second Year', 0, '2021-12-30 07:31:17', '2021-12-30 07:44:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allergy_medication_history`
--
ALTER TABLE `allergy_medication_history`
  ADD PRIMARY KEY (`allergy_medication_history_id`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`announcement_id`);

--
-- Indexes for table `care_equipments`
--
ALTER TABLE `care_equipments`
  ADD PRIMARY KEY (`care_equipment_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `check_ups`
--
ALTER TABLE `check_ups`
  ADD PRIMARY KEY (`check_up_id`);

--
-- Indexes for table `check_up_care_equipments`
--
ALTER TABLE `check_up_care_equipments`
  ADD PRIMARY KEY (`check_up_care_equipment_id`);

--
-- Indexes for table `check_up_medicines`
--
ALTER TABLE `check_up_medicines`
  ADD PRIMARY KEY (`check_up_medicine_id`);

--
-- Indexes for table `check_up_treatments`
--
ALTER TABLE `check_up_treatments`
  ADD PRIMARY KEY (`check_up_treatment_id`);

--
-- Indexes for table `clinical_case_records`
--
ALTER TABLE `clinical_case_records`
  ADD PRIMARY KEY (`clinical_case_record_id`);

--
-- Indexes for table `clinic_appointments`
--
ALTER TABLE `clinic_appointments`
  ADD PRIMARY KEY (`clinic_appointment_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `dental_certificates`
--
ALTER TABLE `dental_certificates`
  ADD PRIMARY KEY (`dental_certificate_id`);

--
-- Indexes for table `first_aid_kits`
--
ALTER TABLE `first_aid_kits`
  ADD PRIMARY KEY (`first_aid_kit_id`);

--
-- Indexes for table `hospitalization_history`
--
ALTER TABLE `hospitalization_history`
  ADD PRIMARY KEY (`hospitalization_history_id`);

--
-- Indexes for table `measurements`
--
ALTER TABLE `measurements`
  ADD PRIMARY KEY (`measurement_id`);

--
-- Indexes for table `medical_history`
--
ALTER TABLE `medical_history`
  ADD PRIMARY KEY (`medical_history_id`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`medicine_id`);

--
-- Indexes for table `medicine_transactions`
--
ALTER TABLE `medicine_transactions`
  ADD PRIMARY KEY (`medicine_transaction_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `monitoring_forms`
--
ALTER TABLE `monitoring_forms`
  ADD PRIMARY KEY (`monitoring_form_id`);

--
-- Indexes for table `monitoring_form_items`
--
ALTER TABLE `monitoring_form_items`
  ADD PRIMARY KEY (`monitoring_form_item_id`);

--
-- Indexes for table `office_supply`
--
ALTER TABLE `office_supply`
  ADD PRIMARY KEY (`office_supply_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `patient_type`
--
ALTER TABLE `patient_type`
  ADD PRIMARY KEY (`patient_type_id`);

--
-- Indexes for table `personal_health_history`
--
ALTER TABLE `personal_health_history`
  ADD PRIMARY KEY (`personal_health_history_id`);

--
-- Indexes for table `prescribed_drug_history`
--
ALTER TABLE `prescribed_drug_history`
  ADD PRIMARY KEY (`prescribed_drug_history_id`);

--
-- Indexes for table `purchase_request`
--
ALTER TABLE `purchase_request`
  ADD PRIMARY KEY (`purchase_request_id`);

--
-- Indexes for table `purchase_request_care_equipment`
--
ALTER TABLE `purchase_request_care_equipment`
  ADD PRIMARY KEY (`purchase_request_care_equipment_id`);

--
-- Indexes for table `purchase_request_medicine`
--
ALTER TABLE `purchase_request_medicine`
  ADD PRIMARY KEY (`purchase_request_medicine_id`);

--
-- Indexes for table `purchase_request_office_supply`
--
ALTER TABLE `purchase_request_office_supply`
  ADD PRIMARY KEY (`purchase_request_office_supply_id`);

--
-- Indexes for table `referral_forms`
--
ALTER TABLE `referral_forms`
  ADD PRIMARY KEY (`referral_form_id`);

--
-- Indexes for table `refer_drug_history`
--
ALTER TABLE `refer_drug_history`
  ADD PRIMARY KEY (`refer_drug_history_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `stock_in`
--
ALTER TABLE `stock_in`
  ADD PRIMARY KEY (`stock_in_id`);

--
-- Indexes for table `stock_in_care_equipment`
--
ALTER TABLE `stock_in_care_equipment`
  ADD PRIMARY KEY (`stock_in_care_equipment_id`);

--
-- Indexes for table `stock_in_medicine`
--
ALTER TABLE `stock_in_medicine`
  ADD PRIMARY KEY (`stock_in_medicine_id`);

--
-- Indexes for table `stock_in_office_supply`
--
ALTER TABLE `stock_in_office_supply`
  ADD PRIMARY KEY (`stock_in_office_supply_id`);

--
-- Indexes for table `stock_out`
--
ALTER TABLE `stock_out`
  ADD PRIMARY KEY (`stock_out_id`);

--
-- Indexes for table `stock_out_care_equipment`
--
ALTER TABLE `stock_out_care_equipment`
  ADD PRIMARY KEY (`stock_out_care_equipment_id`);

--
-- Indexes for table `stock_out_medicine`
--
ALTER TABLE `stock_out_medicine`
  ADD PRIMARY KEY (`stock_out_medicine_id`);

--
-- Indexes for table `stock_out_office_supply`
--
ALTER TABLE `stock_out_office_supply`
  ADD PRIMARY KEY (`stock_out_office_supply_id`);

--
-- Indexes for table `surgery_history`
--
ALTER TABLE `surgery_history`
  ADD PRIMARY KEY (`surgery_history_id`);

--
-- Indexes for table `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`survey_id`);

--
-- Indexes for table `system_setup`
--
ALTER TABLE `system_setup`
  ADD PRIMARY KEY (`system_setup_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `years`
--
ALTER TABLE `years`
  ADD PRIMARY KEY (`year_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allergy_medication_history`
--
ALTER TABLE `allergy_medication_history`
  MODIFY `allergy_medication_history_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `announcement_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `care_equipments`
--
ALTER TABLE `care_equipments`
  MODIFY `care_equipment_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `check_ups`
--
ALTER TABLE `check_ups`
  MODIFY `check_up_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `check_up_care_equipments`
--
ALTER TABLE `check_up_care_equipments`
  MODIFY `check_up_care_equipment_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `check_up_medicines`
--
ALTER TABLE `check_up_medicines`
  MODIFY `check_up_medicine_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `check_up_treatments`
--
ALTER TABLE `check_up_treatments`
  MODIFY `check_up_treatment_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clinical_case_records`
--
ALTER TABLE `clinical_case_records`
  MODIFY `clinical_case_record_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clinic_appointments`
--
ALTER TABLE `clinic_appointments`
  MODIFY `clinic_appointment_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dental_certificates`
--
ALTER TABLE `dental_certificates`
  MODIFY `dental_certificate_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `first_aid_kits`
--
ALTER TABLE `first_aid_kits`
  MODIFY `first_aid_kit_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hospitalization_history`
--
ALTER TABLE `hospitalization_history`
  MODIFY `hospitalization_history_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `measurements`
--
ALTER TABLE `measurements`
  MODIFY `measurement_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `medical_history`
--
ALTER TABLE `medical_history`
  MODIFY `medical_history_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `medicine_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `medicine_transactions`
--
ALTER TABLE `medicine_transactions`
  MODIFY `medicine_transaction_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `monitoring_forms`
--
ALTER TABLE `monitoring_forms`
  MODIFY `monitoring_form_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `monitoring_form_items`
--
ALTER TABLE `monitoring_form_items`
  MODIFY `monitoring_form_item_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `office_supply`
--
ALTER TABLE `office_supply`
  MODIFY `office_supply_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patient_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patient_type`
--
ALTER TABLE `patient_type`
  MODIFY `patient_type_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_health_history`
--
ALTER TABLE `personal_health_history`
  MODIFY `personal_health_history_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `prescribed_drug_history`
--
ALTER TABLE `prescribed_drug_history`
  MODIFY `prescribed_drug_history_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `purchase_request`
--
ALTER TABLE `purchase_request`
  MODIFY `purchase_request_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase_request_care_equipment`
--
ALTER TABLE `purchase_request_care_equipment`
  MODIFY `purchase_request_care_equipment_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchase_request_medicine`
--
ALTER TABLE `purchase_request_medicine`
  MODIFY `purchase_request_medicine_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchase_request_office_supply`
--
ALTER TABLE `purchase_request_office_supply`
  MODIFY `purchase_request_office_supply_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `referral_forms`
--
ALTER TABLE `referral_forms`
  MODIFY `referral_form_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `section_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stock_in`
--
ALTER TABLE `stock_in`
  MODIFY `stock_in_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stock_in_care_equipment`
--
ALTER TABLE `stock_in_care_equipment`
  MODIFY `stock_in_care_equipment_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `stock_in_medicine`
--
ALTER TABLE `stock_in_medicine`
  MODIFY `stock_in_medicine_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `stock_in_office_supply`
--
ALTER TABLE `stock_in_office_supply`
  MODIFY `stock_in_office_supply_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stock_out`
--
ALTER TABLE `stock_out`
  MODIFY `stock_out_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stock_out_care_equipment`
--
ALTER TABLE `stock_out_care_equipment`
  MODIFY `stock_out_care_equipment_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stock_out_medicine`
--
ALTER TABLE `stock_out_medicine`
  MODIFY `stock_out_medicine_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `stock_out_office_supply`
--
ALTER TABLE `stock_out_office_supply`
  MODIFY `stock_out_office_supply_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surgery_history`
--
ALTER TABLE `surgery_history`
  MODIFY `surgery_history_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `surveys`
--
ALTER TABLE `surveys`
  MODIFY `survey_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `system_setup`
--
ALTER TABLE `system_setup`
  MODIFY `system_setup_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unit_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `years`
--
ALTER TABLE `years`
  MODIFY `year_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

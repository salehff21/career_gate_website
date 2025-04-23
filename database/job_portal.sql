-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 22, 2025 at 12:34 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `job_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

DROP TABLE IF EXISTS `applications`;
CREATE TABLE IF NOT EXISTS `applications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `job_id` int NOT NULL,
  `applied_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) DEFAULT 'قيد المعالجة',
  PRIMARY KEY (`id`),
  KEY `student_id` (`user_id`),
  KEY `job_id` (`job_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `user_id`, `job_id`, `applied_at`, `status`) VALUES
(10, 10024, 4, '2025-04-22 00:27:49', 'مقبول'),
(9, 10023, 4, '2025-04-22 00:25:51', 'مرفوض');

-- --------------------------------------------------------

--
-- Table structure for table `job_posts`
--

DROP TABLE IF EXISTS `job_posts`;
CREATE TABLE IF NOT EXISTS `job_posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `company_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `required_specialty` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `location` varchar(255) DEFAULT NULL,
  `salary` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `job_posts`
--

INSERT INTO `job_posts` (`id`, `company_id`, `title`, `description`, `required_specialty`, `created_at`, `location`, `salary`) VALUES
(4, 10022, 'فني صيانة نظم ', 'فني صيانة نظم  ملم بقواغد بيانات ', '', '2025-04-22 00:20:35', 'جده ', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `resumes`
--

DROP TABLE IF EXISTS `resumes`;
CREATE TABLE IF NOT EXISTS `resumes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `student_id` int NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `uploaded_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `resumes`
--

INSERT INTO `resumes` (`id`, `student_id`, `file_path`, `uploaded_at`) VALUES
(5, 10024, '../uploads/resumes/10024_1745281653.pdf', '2025-04-22 00:27:33'),
(4, 10023, '../uploads/resumes/10023_1745281500.pdf', '2025-04-22 00:25:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('job_seeker','company','Admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `specialty` varchar(150) DEFAULT NULL,
  `interests` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `profile_picture` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `email_2` (`email`),
  KEY `user_type` (`user_type`)
) ENGINE=MyISAM AUTO_INCREMENT=10025 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `specialty`, `interests`, `created_at`, `profile_picture`) VALUES
(10023, 'ليان محمد القحطاني ', 'layan23@gmail.com', '$2y$10$AHTOUTLYKSrO3eUMOcMuf.SXbIRsP.qBhsH2mJFPEG.m7aD/5g.DG', 'job_seeker', 'بكلاريوس حاسب', 'شبكات سيرفرات ', '2025-04-22 00:21:50', '../uploads/469283296_1477299669606624_8126119705582711177_n.jpg'),
(10007, 'Mohammed Al-Zahrani', 'm.zahrani@example.com', '$2y$10$CdT1/GQWlHe96GkcWrNB3upGqJnwDzUGgZeeZWUejlClU/kvGLoxi', 'job_seeker', NULL, NULL, '2025-04-15 15:29:00', NULL),
(10008, 'Noura Al-Otaibi', 'noura.o@example.com', '$2y$10$CdT1/GQWlHe96GkcWrNB3upGqJnwDzUGgZeeZWUejlClU/kvGLoxi', 'company', NULL, NULL, '2025-04-15 15:29:00', NULL),
(10009, 'Omar Al-Shehri', 'omar.s@example.com', '$2y$10$CdT1/GQWlHe96GkcWrNB3upGqJnwDzUGgZeeZWUejlClU/kvGLoxi', 'job_seeker', NULL, NULL, '2025-04-15 15:29:00', NULL),
(10017, 'reem', 'reem.d@example.com', '$2y$10$m0TZRdBwy9bo6t/bAO3wbO274j/ZRlP5nFQgW5uRvKmIJ3fmBCCtm', 'company', NULL, NULL, '2025-04-21 01:15:28', NULL),
(10011, 'Khalid Al-Fahad', 'khalid.f@example.com', '$2y$10$CdT1/GQWlHe96GkcWrNB3upGqJnwDzUGgZeeZWUejlClU/kvGLoxi', 'job_seeker', NULL, NULL, '2025-04-15 15:29:00', NULL),
(10012, 'Layla Al-Shammari', 'layla.s@example.com', '$2y$10$CdT1/GQWlHe96GkcWrNB3upGqJnwDzUGgZeeZWUejlClU/kvGLoxi', 'job_seeker', NULL, NULL, '2025-04-15 15:29:00', NULL),
(10013, 'Admin User', 'admin@example.com', ' $2y$10$CdT1/GQWlHe96GkcWrNB3upGqJnwDzUGgZeeZWUejlClU/kvGLoxi', 'company', NULL, NULL, '2025-04-15 15:29:00', NULL),
(10014, 'mona23@gmail.com', 'mona23@gmail.com', '$2y$10$/UWQ33qBFryGWHGlYZxDyecGPHL9tHosxT6jTWA2AUD4Q/hs5HWHu', 'Admin', NULL, NULL, '2025-04-17 08:06:44', NULL),
(10024, 'سارة العلياتي ', 'sara23@gmail.com', '$2y$10$AymRhjnG6le1PPW1Gu3w6uXtHOE6sqCWmKJWDcUe28EmaZyHBSL3i', 'job_seeker', 'بكلاريوس اذارة', '', '2025-04-22 00:22:13', '../uploads/images (1).jpg'),
(10022, 'لايف سوفت للانظمة والاستشارات', 'saleh23@gmail.com', '$2y$10$rnqTKZQirqwIHwwFbfn9YO6fdy8NNUPBVb1bwqVV87dvtzu9VG2CW', 'company', NULL, NULL, '2025-04-22 00:18:43', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

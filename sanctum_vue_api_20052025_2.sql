-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2025 at 04:22 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sanctum_vue_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `is_present` tinyint(1) NOT NULL DEFAULT 0,
  `recorded_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `method` enum('Hadir','Walk-in') NOT NULL DEFAULT 'Hadir'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `program_id`, `user_id`, `date`, `is_present`, `recorded_by`, `created_at`, `updated_at`, `method`) VALUES
(15, 15, 2, '2025-04-03', 1, NULL, '2025-05-13 02:37:43', '2025-05-13 02:37:43', 'Hadir'),
(18, 32, 2, '2025-05-06', 1, NULL, '2025-05-13 02:52:28', '2025-05-13 02:52:28', 'Walk-in'),
(19, 15, 2, '2025-04-04', 1, NULL, '2025-05-14 22:43:09', '2025-05-14 22:43:09', 'Hadir'),
(23, 14, 15, '2025-04-02', 1, NULL, '2025-05-19 06:28:09', '2025-05-19 06:28:09', 'Hadir'),
(24, 14, 2, '2025-04-02', 1, NULL, '2025-05-19 07:05:29', '2025-05-19 07:05:29', 'Walk-in'),
(26, 14, 17, '2025-04-02', 1, NULL, '2025-05-19 21:00:16', '2025-05-19 21:00:16', 'Hadir');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_0fea8265b1b52b4f2fd23625b563f4a0', 'i:1;', 1745323628),
('laravel_cache_0fea8265b1b52b4f2fd23625b563f4a0:timer', 'i:1745323628;', 1745323628),
('laravel_cache_30990f0a07954806cdda144b1745a1c1', 'i:1;', 1745164806),
('laravel_cache_30990f0a07954806cdda144b1745a1c1:timer', 'i:1745164806;', 1745164806),
('laravel_cache_3e465974d6af0512d5cb67a6e8d7ec48', 'i:1;', 1745935779),
('laravel_cache_3e465974d6af0512d5cb67a6e8d7ec48:timer', 'i:1745935779;', 1745935779),
('laravel_cache_4db02c8abe198cf8f9c58a3c654d3212', 'i:1;', 1745642347),
('laravel_cache_4db02c8abe198cf8f9c58a3c654d3212:timer', 'i:1745642347;', 1745642347),
('laravel_cache_5274e39c8b297847e69c7cf8fd084606', 'i:1;', 1745142847),
('laravel_cache_5274e39c8b297847e69c7cf8fd084606:timer', 'i:1745142847;', 1745142847),
('laravel_cache_649a26258b4faba1ff9aaa6a91a03fc2', 'i:1;', 1745170495),
('laravel_cache_649a26258b4faba1ff9aaa6a91a03fc2:timer', 'i:1745170495;', 1745170495),
('laravel_cache_681a24e2670c57cf446cc6b53612ec2f', 'i:1;', 1745167379),
('laravel_cache_681a24e2670c57cf446cc6b53612ec2f:timer', 'i:1745167379;', 1745167379),
('laravel_cache_70740a1c4c31ca4ea820a4f002657f12', 'i:1;', 1745170774),
('laravel_cache_70740a1c4c31ca4ea820a4f002657f12:timer', 'i:1745170774;', 1745170774),
('laravel_cache_7d67b2510093c7ab81decd307efb7d07', 'i:1;', 1745169610),
('laravel_cache_7d67b2510093c7ab81decd307efb7d07:timer', 'i:1745169610;', 1745169610),
('laravel_cache_84112401525s5|127.0.0.1', 'i:1;', 1745326030),
('laravel_cache_84112401525s5|127.0.0.1:timer', 'i:1745326030;', 1745326030),
('laravel_cache_841124034534|127.0.0.1', 'i:1;', 1745326035),
('laravel_cache_841124034534|127.0.0.1:timer', 'i:1745326035;', 1745326035),
('laravel_cache_8427d98d7d31a558a993d4df4a9dc7e2', 'i:1;', 1747744072),
('laravel_cache_8427d98d7d31a558a993d4df4a9dc7e2:timer', 'i:1747744072;', 1747744072),
('laravel_cache_850225016555|127.0.0.1', 'i:1;', 1746019194),
('laravel_cache_850225016555|127.0.0.1:timer', 'i:1746019194;', 1746019194),
('laravel_cache_8654a3d1c68e19aeab9cef06b9276dcb', 'i:1;', 1745829444),
('laravel_cache_8654a3d1c68e19aeab9cef06b9276dcb:timer', 'i:1745829444;', 1745829444),
('laravel_cache_86f81049a882c4a9a785d435ad3447ca', 'i:1;', 1745504542),
('laravel_cache_86f81049a882c4a9a785d435ad3447ca:timer', 'i:1745504542;', 1745504542),
('laravel_cache_8815768616b9825371027d193fb2ffc9', 'i:1;', 1747749424),
('laravel_cache_8815768616b9825371027d193fb2ffc9:timer', 'i:1747749424;', 1747749424),
('laravel_cache_884343356925de86ac518a3ac5be5069', 'i:1;', 1746152280),
('laravel_cache_884343356925de86ac518a3ac5be5069:timer', 'i:1746152280;', 1746152280),
('laravel_cache_a303389dd57368af24d3d3daca9e2410', 'i:1;', 1746019194),
('laravel_cache_a303389dd57368af24d3d3daca9e2410:timer', 'i:1746019194;', 1746019194),
('laravel_cache_a5a4d04171ee8a4357798c987d296c97', 'i:1;', 1746928267),
('laravel_cache_a5a4d04171ee8a4357798c987d296c97:timer', 'i:1746928267;', 1746928267),
('laravel_cache_c3d7c59a734f2a5d90a82022c3996896', 'i:1;', 1747717245),
('laravel_cache_c3d7c59a734f2a5d90a82022c3996896:timer', 'i:1747717245;', 1747717245),
('laravel_cache_c674f0d22b558d306df9dd820585ed87', 'i:1;', 1745504416),
('laravel_cache_c674f0d22b558d306df9dd820585ed87:timer', 'i:1745504416;', 1745504416),
('laravel_cache_cb8dadb496979dd5fd9e0f25cf9f7c6f', 'i:2;', 1745164747),
('laravel_cache_cb8dadb496979dd5fd9e0f25cf9f7c6f:timer', 'i:1745164747;', 1745164747),
('laravel_cache_db32787d42175b2f32a838fd335b9c69', 'i:2;', 1745167909),
('laravel_cache_db32787d42175b2f32a838fd335b9c69:timer', 'i:1745167909;', 1745167909),
('laravel_cache_de85f8fd7027c102519e77873275c1d9', 'i:1;', 1745504574),
('laravel_cache_de85f8fd7027c102519e77873275c1d9:timer', 'i:1745504574;', 1745504574),
('laravel_cache_e00c155a15c05e3b4f95385e587cfc7d', 'i:1;', 1746019220),
('laravel_cache_e00c155a15c05e3b4f95385e587cfc7d:timer', 'i:1746019220;', 1746019220),
('laravel_cache_e79c9111d919b27ca25b0f6e63dc3fb9', 'i:1;', 1745326035),
('laravel_cache_e79c9111d919b27ca25b0f6e63dc3fb9:timer', 'i:1745326035;', 1745326035),
('laravel_cache_ed8c191c0b4531618f4353e922c61592', 'i:1;', 1745131641),
('laravel_cache_ed8c191c0b4531618f4353e922c61592:timer', 'i:1745131641;', 1745131641),
('laravel_cache_f32202936542e36743d3e402383e4d0a', 'i:1;', 1745829585),
('laravel_cache_f32202936542e36743d3e402383e4d0a:timer', 'i:1745829585;', 1745829585),
('laravel_cache_fdbc67e30d92ebdd8e5987b6f7433017', 'i:1;', 1745326030),
('laravel_cache_fdbc67e30d92ebdd8e5987b6f7433017:timer', 'i:1745326030;', 1745326030),
('laravel_cache_ramat@johor.gov.my|127.0.0.1', 'i:1;', 1745167379),
('laravel_cache_ramat@johor.gov.my|127.0.0.1:timer', 'i:1745167379;', 1745167379),
('laravel_cache_sukik@yahoo.com|127.0.0.1', 'i:1;', 1745131641),
('laravel_cache_sukik@yahoo.com|127.0.0.1:timer', 'i:1745131641;', 1745131641);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_04_08_152232_create_personal_access_tokens_table', 1),
(5, '2025_04_08_153903_add_two_factor_columns_to_users_table', 1),
(6, '2025_04_13_134313_create_classes_table', 1),
(7, '2025_04_13_134613_create_sections_table', 1),
(8, '2025_04_13_134627_create_students_table', 1),
(9, '2025_04_15_032309_create_roles_table', 1),
(10, '2025_04_15_032346_add_role_id_to_users_table', 1),
(11, '2025_04_15_044744_create_role_user_table', 1),
(12, '2025_04_16_164321_add_unique_constraint_to_ic_no', 1),
(13, '2025_04_19_061453_create_units_table', 1),
(14, '2025_04_19_165350_create_programs_table', 1),
(15, '2025_04_19_165354_create_program_materials_table', 1),
(16, '2025_04_19_165358_create_participants_table', 1),
(17, '2025_04_19_165401_create_attendances_table', 1),
(18, '2025_04_19_175844_add_unit_id_to_users_table', 2),
(19, '2025_04_28_124327_create_attendances_table', 3),
(20, '2025_05_15_081031_add_is_certificate_to_programs_table', 4),
(21, '2025_05_15_141341_add_certificate_code_to_participants_table', 5),
(22, '2025_05_19_123500_add_is_walkin_to_participants_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `certificate_code` varchar(255) DEFAULT NULL,
  `is_walkin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`id`, `user_id`, `program_id`, `created_at`, `updated_at`, `certificate_code`, `is_walkin`) VALUES
(1, 2, 16, '2025-04-23 17:08:03', '2025-04-23 17:08:03', NULL, 0),
(2, 2, 19, '2025-04-23 18:59:02', '2025-04-23 18:59:02', NULL, 0),
(3, 7, 16, '2025-04-24 05:04:55', '2025-04-24 05:04:55', NULL, 0),
(4, 11, 20, '2025-04-24 06:26:10', '2025-04-24 06:26:10', NULL, 0),
(6, 15, 14, '2025-04-30 05:19:25', '2025-04-30 05:19:25', NULL, 0),
(8, 2, 15, '2025-05-13 02:29:51', '2025-05-13 02:29:51', NULL, 0),
(9, 2, 14, '2025-05-19 05:41:09', '2025-05-19 07:54:06', 'SJL-QMUD92XZEE', 1),
(10, 17, 14, '2025-05-19 19:28:59', '2025-05-19 21:00:28', 'SJL-DRQALP2RQT', 0);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `by_unit` varchar(255) NOT NULL,
  `program_name` varchar(255) NOT NULL,
  `program_desc` text DEFAULT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `location` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `isCertificate` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `created_by`, `by_unit`, `program_name`, `program_desc`, `date_from`, `date_to`, `location`, `url`, `created_at`, `updated_at`, `isCertificate`) VALUES
(14, 1, '1', 'Bengkel Tatacara Kewangan Modul Terimaan', 'Penerangan Mengenai Tatacara Kewangan dalam Modul Terimaan', '2025-04-02', '2025-04-02', 'Dewan Blok C', '40', '2025-04-20 01:11:33', '2025-05-19 20:59:51', 1),
(15, 4, '2', 'Kursus Protokol 2025', 'Untuk kakitangan awam', '2025-04-03', '2025-04-04', 'Bilik Mesyuarat', '50', '2025-04-20 01:53:53', '2025-04-22 16:00:46', 0),
(16, 4, '2', 'Kursus Bina Semangat', 'Kursus berkaitan motivasi', '2025-03-31', '2025-04-01', 'Desaru', '30', '2025-04-20 02:23:44', '2025-04-20 02:23:44', 0),
(17, 4, '2', 'Taklimat Penggunaan Fail', 'Penerangan mengenai Penggunaan Fail', '2025-03-31', '2025-04-01', 'Bilik Mesyuarat Utama', '45', '2025-04-20 02:24:32', '2025-04-24 05:14:49', 0),
(19, 1, '1', 'Bengkel Penggantian Server', 'Bengkel utk ganti server iSpeks', '2025-04-30', '2025-05-02', 'Putrajaya', '30', '2025-04-22 16:04:01', '2025-05-15 05:55:23', 1),
(20, 12, '3', 'Bengkel Pembayaran Secara Online', 'Bengkel untuk mendapatkan maklumat', '2025-03-01', '2025-03-04', 'Hotel Trove', '40', '2025-04-24 06:13:28', '2025-04-24 06:13:41', 0),
(32, 16, '1', 'Bengkel Ai 2025', 'Bengkel Ai untuk semua', '2025-05-06', '2025-05-06', 'Hotel Freser', '20', '2025-05-01 18:12:30', '2025-05-01 18:13:09', 0);

-- --------------------------------------------------------

--
-- Table structure for table `program_materials`
--

CREATE TABLE `program_materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `material_name` varchar(255) NOT NULL,
  `file_url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `program_materials`
--

INSERT INTO `program_materials` (`id`, `program_id`, `material_name`, `file_url`, `created_at`, `updated_at`) VALUES
(1, 14, 'nota', 'materials/4CKlufxbdTh4L7xtwtyE6O3yPW2J79n3yWnt4bZK.pdf', '2025-05-20 04:40:50', '2025-05-20 04:40:50'),
(6, 14, 'Slide Bengkel', 'materials/pN7AWD28nVnIQgGD2Y1T8FhZHIAUSgvJr5CWUOD3.pdf', '2025-05-20 05:23:35', '2025-05-20 05:23:35'),
(8, 14, 'sadassad', 'materials/PpMvg0UzVnUhgkzzJRu1K8Ld1GTTHYPrk5EX06wT.pdf', '2025-05-20 05:24:35', '2025-05-20 05:24:35'),
(9, 14, 'Jadual Taklimat', 'materials/1W8UaJ17j9xnp5NZxqAxxurOHoEHPz5n5ZEpYRJ6.pdf', '2025-05-20 05:53:10', '2025-05-20 05:53:10'),
(10, 19, 'Nota Ringkas', 'materials/W5l2ILljdbqSSTtPMHFzEQ9zqxeyQAhCK0N6ag9z.pdf', '2025-05-20 05:53:45', '2025-05-20 05:53:45');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Peserta', NULL, NULL),
(2, 'Penganjur', NULL, NULL),
(3, 'Pentadbir Sistem', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(3, 2, 1, NULL, NULL),
(4, 3, 3, NULL, NULL),
(5, 1, 2, NULL, NULL),
(6, 4, 2, NULL, NULL),
(8, 6, 1, NULL, NULL),
(9, 7, 1, NULL, NULL),
(10, 4, 1, NULL, NULL),
(11, 8, 1, NULL, NULL),
(12, 9, 1, NULL, NULL),
(14, 11, 1, NULL, NULL),
(15, 12, 2, NULL, NULL),
(16, 13, 1, NULL, NULL),
(17, 8, 2, NULL, NULL),
(18, 14, 1, NULL, NULL),
(19, 15, 1, NULL, NULL),
(20, 16, 1, NULL, NULL),
(21, 16, 2, NULL, NULL),
(22, 17, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0AtrW8B8gJtXBHjQccYfE3VwNNlYTI5KrmjRQWYv', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYVF2SmR4ZGdSQjdEU2NLU1FveXpzU1NYRHdqeVNKZzZjVXY1OEs5VyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly9wc20tYi50ZXN0L2FwaS91c2VyIjt9fQ==', 1747750792);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `unit`, `created_at`, `updated_at`) VALUES
(1, 'Unit Naziran iSPEKS', NULL, NULL),
(2, 'Unit Pengurusan dan Sumber Manusia', NULL, NULL),
(3, 'Unit Audit Terimaan', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ic_no` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `unit_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `ic_no`, `position`, `department`, `phone_no`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`, `unit_id`) VALUES
(1, 'Hairul Azhan bin Nordin', 'hairul@johor.gov.my', '841125015244', 'Penolong Akauntan', 'Perbendaharaan Negeri Johor', '0197544114', NULL, '$2y$12$aVqCIbWM0yqdtKiG11EafuLdPZm5dzNUhzy0aRFGE7wftyJEBwKta', NULL, NULL, NULL, NULL, NULL, '2025-05-19 20:57:55', 1),
(2, 'Mishazli bin Syuib', 'mishazli@johor.gov.my', '841124015255', 'Penolong Akauntan', 'Perhutanan Johor', '0167544411', NULL, '$2y$12$aVqCIbWM0yqdtKiG11EafuLdPZm5dzNUhzy0aRFGE7wftyJEBwKta', NULL, NULL, NULL, NULL, NULL, '2025-05-12 22:59:33', NULL),
(3, 'Mohammed Satippiddin Safid bin Hamzah', 'satippiddin@johor.gov.my', '841129015403', 'Penolong Pegawai Teknologi Maklumat', 'Perbendaharaan Negeri Johor', '0197588545', NULL, '$2y$12$aVqCIbWM0yqdtKiG11EafuLdPZm5dzNUhzy0aRFGE7wftyJEBwKta', NULL, NULL, NULL, NULL, '2025-04-19 09:34:56', '2025-04-29 05:05:41', NULL),
(4, 'Rahmat Fitri bin Sulaiman', 'rahmat@johor.gov.my', '781201015255', 'Penolong Pegawai Tadbir', 'Perbendaharaan Negeri Johor', '0197564455', NULL, '$2y$12$aVqCIbWM0yqdtKiG11EafuLdPZm5dzNUhzy0aRFGE7wftyJEBwKta', NULL, NULL, NULL, NULL, '2025-04-20 01:52:46', '2025-04-22 16:12:36', 1),
(6, 'Ali Hamka bin Abdul Rahman', 'ali.hamka@johor.gov.my', '850225016555', 'Penolong Pegawai Tadbir', 'Pejabat Daerah Segamat', '0197855544', NULL, '$2y$12$hwtnxwPw/0tzlo4XhT3XIOlGIp9WNN4S/OUqfab/lO6Bf39oPqbba', NULL, NULL, NULL, NULL, '2025-04-20 09:38:05', '2025-04-20 09:38:58', NULL),
(7, 'Abu Bakar bin Abu Mutalib Harun', 'abu.bakar@johor.gov.my', '541115235403', 'Pembantu Tadbir', 'Pejabat Pertanian Negeri Johor', '0163537145', NULL, '$2y$12$aVqCIbWM0yqdtKiG11EafuLdPZm5dzNUhzy0aRFGE7wftyJEBwKta', NULL, NULL, NULL, NULL, '2025-04-22 04:48:35', '2025-04-25 20:37:48', NULL),
(8, 'Kamarul Siddiq bin Nasir', 'kamarul@johor.gov.my', '780120015634', 'Penolong Akauntan', 'Perbendaharaan Negeri Johor', '0167854454', NULL, '$2y$12$NPGcWSteEBnzsfdHjjarc.qt.r58dBz68uH7tU0roKUY0bvqv.k.G', NULL, NULL, NULL, NULL, '2025-04-22 16:16:15', '2025-04-25 20:40:43', 3),
(9, 'Satip2', 'satip2@johor.gov.my', '841129015434', 'Penolong Akauntan', 'Perbendaharaan Negeri Johor', '0197588545', NULL, '$2y$12$KOnxFIOjfFIAO51fQ07ouem1.PrZm4M00JQxHJJztoQX0pIfbM6JW', NULL, NULL, NULL, NULL, '2025-04-23 06:24:50', '2025-04-23 06:24:50', NULL),
(11, 'Ahmad Syafiq bin Marakan Update', 'syafiq@johor.gov.my', '901112015422', 'Pembantu Tadbir', 'Pejabat Agama Negeri Johor', '0167571254', NULL, '$2y$12$sUY4F5jLniB.rq7tHtLsgOch2fnMJUjCNDa60ijaTJYi0R95LIVYa', NULL, NULL, NULL, NULL, '2025-04-24 06:05:24', '2025-04-24 06:07:50', NULL),
(12, 'Liza binti Abdullah', 'liza@johor.gov.my', '941202015634', 'Penolong Akauntan', 'Perbendaharaan Negeri Johor', '0167548575', NULL, '$2y$12$sUY4F5jLniB.rq7tHtLsgOch2fnMJUjCNDa60ijaTJYi0R95LIVYa', NULL, NULL, NULL, NULL, '2025-04-24 06:10:28', '2025-04-24 06:10:28', 3),
(13, 'zamani', 'sa@johor.gov.my', '784514015244', 'asdasda', 'asdasd', '01560156', NULL, '$2y$12$q8zdaeKp9UVE7kR2jCKlvu71x7lqxB1X7bWUtkbJ7etsOplTcTdAa', NULL, NULL, NULL, NULL, '2025-04-24 06:20:55', '2025-04-24 06:20:55', NULL),
(14, 'Razak bin Husin', 'razak@johor.gov.my', '790110015255', 'Pembantu Kewangan', 'Pertanian Negeri Johor', '0177564558', NULL, '$2y$12$tjU9BxPZZTbMZzf2FJh6/u/OyzZq3Drb5pgbBCo4PS4dGhXJmjm2O', NULL, NULL, NULL, NULL, '2025-04-29 05:05:25', '2025-04-29 05:05:25', NULL),
(15, 'Syafiq Ahmad bin Tajul', 'syafiq.tajul@johor.gov.my', '921203015366', 'Pembantu Tadbir Kewangan', 'Setiausaha Kerajaan Negeri Johor', '0187544551', NULL, '$2y$12$6.pEtAaLZFdc6CT8lSH19efKBkh5AiMYWS8Frqsbm1EtU84M08LXm', NULL, NULL, NULL, NULL, '2025-04-29 05:57:40', '2025-04-29 06:07:14', NULL),
(16, 'Ismail Fauzi bin Isnin Update2', 'ismail@johor.gov.my', '780124015403', 'Pegawai Tadbir', 'Setiausaha Kerajaan Johor', '0197561144', NULL, '$2y$12$Ecf47Lut5dMxlfwY/bRRgeF7kD0ful2cKUNSJhwxK/aMbfJvJ4gzS', NULL, NULL, NULL, NULL, '2025-05-01 18:05:10', '2025-05-01 18:09:01', 1),
(17, 'Rezeki bin Esa', 'rezeki@johor.gov.my', '111111225555', 'sdaf', 'dsfa', '2321', NULL, '$2y$12$i2P2ECdYUT2XOD3TU4T0lujYaqcnMpVZs6I5bM.qsE64qulhmDvSu', NULL, NULL, NULL, NULL, '2025-05-19 19:27:16', '2025-05-19 19:27:51', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `participants_certificate_code_unique` (`certificate_code`),
  ADD KEY `participants_user_id_foreign` (`user_id`),
  ADD KEY `participants_program_id_foreign` (`program_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program_materials`
--
ALTER TABLE `program_materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `program_materials_program_id_foreign` (`program_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_role_unique` (`role`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_user_user_id_role_id_unique` (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sections_class_id_foreign` (`class_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_email_unique` (`email`),
  ADD KEY `students_class_id_foreign` (`class_id`),
  ADD KEY `students_section_id_foreign` (`section_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `ic_no` (`ic_no`),
  ADD KEY `users_unit_id_foreign` (`unit_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `program_materials`
--
ALTER TABLE `program_materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendances_recorded_by_foreign` FOREIGN KEY (`recorded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `participants`
--
ALTER TABLE `participants`
  ADD CONSTRAINT `participants_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `participants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `program_materials`
--
ALTER TABLE `program_materials`
  ADD CONSTRAINT `program_materials_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `students_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

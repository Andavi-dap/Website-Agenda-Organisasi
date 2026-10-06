-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2026 at 02:59 PM
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
-- Database: `db_organisasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `kegiatans`
--

CREATE TABLE `kegiatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kegiatans`
--

INSERT INTO `kegiatans` (`id`, `nama_kegiatan`, `deskripsi`, `tanggal`, `waktu`, `lokasi`, `status`, `created_at`, `updated_at`) VALUES
(1, 'TUMISS', NULL, '2026-04-15', '15:00:00', 'Polimedia Gedung E, Lt 2.9 & 2.10', 'selesai', '2026-04-19 00:33:02', '2026-04-19 00:33:02'),
(3, 'BANK ASPIRASI 1', NULL, '2026-02-10', '15:00:00', 'Whats App', 'selesai', '2026-04-19 01:29:09', '2026-04-19 01:29:09'),
(4, 'FOTO KABINET', NULL, '2026-02-21', '10:00:00', 'Polimedia Pusgiwa Lt.2', 'selesai', '2026-04-19 01:29:41', '2026-04-19 01:29:41'),
(5, 'STUDI BANDING', NULL, '2026-02-25', '16:00:00', 'Polimedia Hall Gedung E', 'selesai', '2026-04-19 01:30:45', '2026-04-19 01:30:45'),
(7, 'TNT 3', NULL, '2026-04-19', '16:00:00', 'Instagram @himedia.jkt', 'selesai', '2026-04-19 01:33:29', '2026-04-19 01:33:29'),
(8, 'TRIVIA 2', NULL, '2026-04-20', '16:00:00', 'Instagram @himedia.jkt', 'akan datang', '2026-04-19 01:34:12', '2026-04-19 01:34:12'),
(9, 'KOMIK 1', NULL, '2026-03-02', '10:00:00', 'Polimedia Gedung E, Kelas', 'selesai', '2026-04-19 02:13:00', '2026-04-19 02:13:00'),
(10, 'AMUBA 13', NULL, '2026-05-09', '08:00:00', 'Panti Asuhan', 'akan datang', '2026-04-19 03:40:04', '2026-05-02 03:55:15'),
(11, 'RGB', NULL, '2026-02-26', '15:00:00', 'Polimedia Kantin Baru', 'selesai', '2026-04-20 20:44:57', '2026-04-20 20:44:57'),
(12, 'MUJAJIL', NULL, '2026-03-03', '16:00:00', 'Polimedia Jakarta, Srengseng Sawah', 'selesai', '2026-04-30 20:42:44', '2026-04-30 20:42:44'),
(13, 'MUJAJIL', NULL, '2026-03-04', '16:00:00', 'Polimedia Jakarta, Srengseng Sawah', 'selesai', '2026-04-30 20:43:26', '2026-04-30 20:43:26'),
(14, 'MUGJIL', NULL, '2026-03-05', '16:00:00', 'Polimedia Jakarta, Srengseng Sawah', 'selesai', '2026-04-30 20:43:51', '2026-04-30 20:43:51'),
(15, 'IMAJI', NULL, '2026-03-07', '16:00:00', 'Teras Atas Depok', 'selesai', '2026-04-30 20:44:51', '2026-04-30 20:44:51'),
(16, 'BANK ASPIRASI 2', NULL, '2026-03-10', '12:00:00', 'Whats App', 'selesai', '2026-04-30 20:45:38', '2026-04-30 20:45:38'),
(17, 'STUBAN (Teknik)', NULL, '2026-03-12', '16:00:00', 'Polimedia Pusgiwa Lt.2', 'selesai', '2026-04-30 20:46:10', '2026-04-30 20:46:10'),
(18, 'UPGRADING 1', NULL, '2026-03-13', '13:00:00', 'Polimedia Gedung E, Lt 2.9 & 2.10', 'selesai', '2026-04-30 20:46:52', '2026-04-30 20:46:52'),
(19, 'FRAME 1', NULL, '2026-03-14', '16:00:00', 'Instagram @himedia.jkt', 'selesai', '2026-04-30 20:47:18', '2026-04-30 20:47:18'),
(20, 'KEMASAN 1', NULL, '2026-03-15', '16:00:00', 'Instagram @himedia.jkt', 'selesai', '2026-04-30 20:47:48', '2026-04-30 20:47:48'),
(21, 'TNT 1', NULL, '2026-03-19', '16:00:00', 'Instagram @himedia.jkt', 'selesai', '2026-04-30 20:48:12', '2026-04-30 20:48:12'),
(22, 'TRIVIA 1', NULL, '2026-03-20', '16:00:00', 'Instagram @himedia.jkt', 'selesai', '2026-04-30 20:48:34', '2026-04-30 20:48:34'),
(23, 'AOTM 1', NULL, '2026-03-23', '16:00:00', 'Instagram @himedia.jkt', 'selesai', '2026-04-30 20:48:59', '2026-04-30 20:48:59'),
(24, 'TNT 2', NULL, '2026-03-25', '16:00:00', 'Instagram @himedia.jkt', 'selesai', '2026-04-30 20:49:22', '2026-04-30 20:49:22'),
(25, 'OBAMA 1', NULL, '2026-03-31', '16:00:00', 'Kolam Renang Batoe 54', 'selesai', '2026-04-30 20:49:50', '2026-04-30 20:49:50'),
(26, 'ALAM 1', NULL, '2026-03-31', '16:00:00', 'Instagram @himedia.jkt', 'selesai', '2026-04-30 20:50:10', '2026-04-30 20:50:10'),
(27, 'KOMIK 2', NULL, '2026-04-01', '12:00:00', 'Polimedia Jakarta, Srengseng Sawah', 'selesai', '2026-04-30 20:54:05', '2026-04-30 20:54:05'),
(28, 'MUTER 1', NULL, '2026-04-09', '12:00:00', 'Polimedia Jakarta, Srengseng Sawah', 'selesai', '2026-04-30 20:54:33', '2026-04-30 20:54:33'),
(29, 'BANK ASPIRASI 3', NULL, '2026-04-10', '12:00:00', 'Whats App', 'selesai', '2026-04-30 20:58:16', '2026-04-30 20:58:16'),
(30, 'BESAN 1', NULL, '2026-04-12', '16:00:00', 'Instagram @himedia.jkt', 'selesai', '2026-04-30 20:58:43', '2026-04-30 20:58:43'),
(31, 'FRAME 2', NULL, '2026-04-14', '16:00:00', 'Instagram @himedia.jkt', 'selesai', '2026-04-30 20:59:12', '2026-04-30 20:59:12'),
(32, 'KEMASAN 2', NULL, '2026-04-15', '16:00:00', 'Instagram @himedia.jkt', 'selesai', '2026-04-30 20:59:40', '2026-04-30 20:59:40'),
(33, 'KOMED', NULL, '2026-04-23', '16:00:00', 'Polimedia Jakarta, Srengseng Sawah', 'selesai', '2026-04-30 21:00:34', '2026-04-30 21:00:34'),
(34, 'AOTM 2', NULL, '2026-04-23', '16:00:00', 'Instagram @himedia.jkt', 'selesai', '2026-04-30 21:01:08', '2026-04-30 21:01:08'),
(35, 'TNT 4', NULL, '2026-04-25', '16:00:00', 'Instagram @himedia.jkt', 'selesai', '2026-04-30 21:01:39', '2026-04-30 21:01:39'),
(36, 'MARJAN 1', NULL, '2026-05-04', '16:00:00', 'YouTube @himedia.jkt', 'akan datang', '2026-04-30 21:02:21', '2026-04-30 21:02:21'),
(37, 'MUTER 2', NULL, '2026-05-09', '12:00:00', 'Polimedia Jakarta, Srengseng Sawah', 'akan datang', '2026-04-30 21:02:51', '2026-04-30 21:02:51'),
(38, 'BANK ASPIRASI 4', NULL, '2026-05-10', '16:00:00', 'Whats App', 'akan datang', '2026-04-30 21:08:00', '2026-04-30 21:08:00'),
(39, 'KOMIK 3', NULL, '2026-05-12', '12:00:00', 'Polimedia Jakarta, Srengseng Sawah', 'akan datang', '2026-04-30 21:08:34', '2026-04-30 21:08:34'),
(40, 'HIMEDIA PLAYBOOK', NULL, '2026-05-14', '16:00:00', 'Website @himediajkt', 'akan datang', '2026-04-30 21:09:21', '2026-04-30 21:09:21'),
(41, 'FRAME 3', NULL, '2026-05-14', '16:00:00', 'Instagram @himedia.jkt', 'akan datang', '2026-04-30 21:09:50', '2026-04-30 21:09:50'),
(42, 'KEMASAN 3', NULL, '2026-05-15', '16:00:00', 'Instagram @himedia.jkt', 'akan datang', '2026-04-30 21:10:17', '2026-04-30 21:10:17'),
(43, 'MENTION 1', NULL, '2026-05-16', '16:00:00', 'Polimedia Pusgiwa Lt.2', 'akan datang', '2026-04-30 21:10:37', '2026-04-30 21:10:37'),
(44, 'TNT 5', NULL, '2026-05-19', '16:00:00', 'Instagram @himedia.jkt', 'akan datang', '2026-04-30 21:11:03', '2026-04-30 21:11:03'),
(45, 'UPGRADING 2', NULL, '2026-05-21', '16:00:00', 'Polimedia Gedung E, Lt 2.9 & 2.10', 'akan datang', '2026-04-30 21:11:27', '2026-04-30 21:11:27'),
(46, 'AOTM 3', NULL, '2026-05-23', '16:00:00', 'Instagram @himedia.jkt', 'akan datang', '2026-04-30 21:11:48', '2026-04-30 21:11:48'),
(47, 'TNT 6', NULL, '2026-05-25', '16:00:00', 'Instagram @himedia.jkt', 'akan datang', '2026-04-30 21:12:22', '2026-04-30 21:12:22'),
(48, 'OBAMA 2', NULL, '2026-05-29', '16:00:00', 'TBA', 'akan datang', '2026-04-30 21:13:03', '2026-04-30 21:13:03'),
(49, 'KEMUL 1', NULL, '2026-05-30', '16:00:00', 'Instagram @himedia.jkt', 'akan datang', '2026-04-30 21:13:30', '2026-04-30 21:13:30'),
(50, 'ALAM 2', NULL, '2026-05-31', '16:00:00', 'Instagram @himedia.jkt', 'akan datang', '2026-04-30 21:14:02', '2026-04-30 21:14:02'),
(51, 'KOMIK 4', NULL, '2026-06-02', '12:00:00', 'Polimedia Jakarta, Srengseng Sawah', 'akan datang', '2026-05-11 17:44:59', '2026-05-11 17:44:59'),
(52, 'TUMISS', NULL, '2026-05-14', '08:44:00', 'Polimedia Jakarta, Srengseng Sawah', 'akan datang', '2026-05-11 18:45:18', '2026-05-11 18:45:18');

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
(4, '2026_04_18_002317_create_kegiatans_table', 1);

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
('6VACvTmta1z7AseNri0VuvWnZMW1Wft5JKsQ6rGq', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiZTZpMEFQY0UzaHFnUEFXbklOYWk5T1ZhcWIySkJ0YmpKdUpIWkxsRyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1776582673);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

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
-- Indexes for table `kegiatans`
--
ALTER TABLE `kegiatans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

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
-- AUTO_INCREMENT for table `kegiatans`
--
ALTER TABLE `kegiatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

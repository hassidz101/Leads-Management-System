-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2023 at 05:09 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cryptodvice_db`
--

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
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `id` int(11) UNSIGNED NOT NULL,
  `agent_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `investment_amount` varchar(255) DEFAULT NULL,
  `reachability` text DEFAULT NULL,
  `interested_in` text DEFAULT NULL,
  `notice` text DEFAULT NULL,
  `lead_status` varchar(255) DEFAULT NULL,
  `is_pdf_generated` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`id`, `agent_id`, `first_name`, `last_name`, `email`, `phone`, `gender`, `investment_amount`, `reachability`, `interested_in`, `notice`, `lead_status`, `is_pdf_generated`, `created_at`, `updated_at`) VALUES
(2, 5, 'John', 'Wick 2', 'john@gmail.com', '123456789', 'Herr', '10\'000 - 20\'000', 'Morning', NULL, NULL, 'Unprocessed', 0, '2023-02-07 18:55:51', '2023-02-09 12:32:36'),
(3, 2, 'John', 'Wick 3', 'john@gmail.com', '123456789', 'Herr', '10\'000 - 20\'000', 'Nachmittags', 'Investments in Krypto,Kostenlose Krypto-Beratung', 'testingggggggggg', 'unprocessed', 0, '2023-02-07 18:55:51', '2023-02-09 12:06:59'),
(4, 4, 'John', 'Wick 4', 'john@gmail.com', '123456789', 'Herr', '10\'000 - 20\'000', 'Nachmittags', 'Investments in Krypto,Kostenlose Krypto-Beratung', NULL, 'deadline', 0, '2023-02-07 18:55:51', '2023-02-08 12:29:37'),
(5, NULL, 'John', 'Wick 5', 'john@gmail.com', '123456789', 'Herr', '10\'000 - 20\'000', 'Nachmittags', 'Kostenlose Krypto-Beratung', 'testing', 'not_closed', 0, '2023-02-07 18:55:51', '2023-02-08 12:30:38'),
(6, 5, 'Joe', 'Biden', 'albert@gmail.com', '3456345645', 'Frau', '50\'000 - 100\'000', 'Abends', 'Investments in NFTs,Investments in Krypto,Kostenlose Krypto-Beratung', 'This is a testing notices', 'not_reached_3', 1, '2023-02-08 11:10:58', '2023-02-09 13:07:56'),
(10, 4, 'Joe', 'Walk', 'admin@admin.com', '3456345645', 'Frau', '50\'000 - 100\'000', 'Nachmittags', 'Investments in NFTs,Kostenlose NFT-Beratung', 'testing', 'appointment', 1, '2023-02-09 12:31:10', '2023-02-09 13:15:57'),
(11, 4, 'Support', 'leather', 'support@leatherpiks.com', '3456345645', 'Herr', '> 100\'000', 'Nachmittags,Abends', 'Investments in einen PreSale', 'testing', 'appointment', 0, '2023-02-09 12:46:19', '2023-02-10 10:50:27');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` enum('admin','agent') DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `profile_img` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `username`, `name`, `surname`, `phone`, `is_active`, `email`, `email_verified_at`, `password`, `profile_img`, `remember_token`, `last_activity`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'superadmin', 'Super', 'Admin', '3242352345', 1, 'admin@admin.com', NULL, '$2y$10$/0aWEW2D8Ke3X35f43HCYeyS7nI1gWyV5Qvp05.bKoi2fXN1WnKI6', '0e3d986ef941b9b28fda2095ec5fc02f1675963811.svg', NULL, '2023-02-10 16:08:58', NULL, '2023-02-10 11:08:58'),
(2, 'agent', 'agent1', 'Agent', 'One', '3242352345', 1, 'agent@agent.com', NULL, '$2y$10$/0aWEW2D8Ke3X35f43HCYeyS7nI1gWyV5Qvp05.bKoi2fXN1WnKI6', NULL, NULL, '2023-02-09 17:28:02', '2023-02-07 19:39:33', '2023-02-09 12:28:02'),
(4, 'agent', 'agent', 'Asim', 'Raza', '3456345645', 1, 'agent@gmail.com', NULL, '$2y$10$UANFg9oomN3dQ6ydrYFEx.ZXXadJFtFMm0KG5oRfQkBoVcxMPJW9m', '74ca18f6e255f3402ee9eae5402ceee11675812942.png', NULL, '2023-02-09 18:20:29', '2023-02-07 17:58:01', '2023-02-09 13:20:29'),
(5, 'agent', 'johnwick12', 'john', 'wicks', '346345653', 1, 'johnwick@gmail.com', NULL, '$2y$10$vQmXaUy8VNV33AH8mA7D..GQyuB.CaePWgPRlOPnqpmCs1F6mrUp.', 'a7a97396417d854d032bd854c693655a1675815032.png', NULL, '2023-02-09 16:42:24', '2023-02-07 18:35:42', '2023-02-07 19:53:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

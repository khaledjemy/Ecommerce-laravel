-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2024 at 03:50 PM
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
-- Database: `ecommerce`
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

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('amina|127.0.0.1', 'i:1;', 1729896602),
('amina|127.0.0.1:timer', 'i:1729896602;', 1729896602),
('angham@gmail.com|127.0.0.1', 'i:1;', 1729895907),
('angham@gmail.com|127.0.0.1:timer', 'i:1729895907;', 1729895907),
('b1d5781111d84f7b3fe45a0852e59758cd7a87e5', 'i:1;', 1731359996),
('b1d5781111d84f7b3fe45a0852e59758cd7a87e5:timer', 'i:1731359996;', 1731359996),
('da4b9237bacccdf19c0760cab7aec4a8359010b0', 'i:2;', 1729895129),
('da4b9237bacccdf19c0760cab7aec4a8359010b0:timer', 'i:1729895129;', 1729895129),
('sara55|127.0.0.1', 'i:1;', 1731359783),
('sara55|127.0.0.1:timer', 'i:1731359783;', 1731359783);

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
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 1, '2024-10-25 21:17:10', '2024-10-25 21:17:10'),
(2, 7, 9, 2, '2024-11-10 17:22:14', '2024-11-10 17:22:14'),
(3, 7, 8, 3, '2024-11-10 18:48:45', '2024-11-10 19:02:53');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `description`, `image`, `published`, `created_at`, `updated_at`) VALUES
(1, 'men1', 'hello', '1729884895.jpg', 1, '2024-10-25 17:26:44', '2024-11-10 18:11:39'),
(2, 'women', 'good', '1729884535.jpg', 1, '2024-10-25 17:27:09', '2024-10-25 17:28:55'),
(3, 'accessories', 'good', '1729884600.jpg', 1, '2024-10-25 17:28:08', '2024-10-25 17:30:00'),
(4, 'kids', 'kids', '1729884647.jpg', 1, '2024-10-25 17:30:47', '2024-10-25 17:30:47'),
(6, 'iman', 'hello', '1731265200.png', 1, '2024-11-10 17:00:00', '2024-11-10 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL DEFAULT 'null',
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
(4, '2024_10_15_201620_create_categories_table', 1),
(5, '2024_10_15_202346_create_products_table', 1),
(6, '2024_10_16_141441_create_personal_access_tokens_table', 1),
(7, '2024_10_22_163934_create_carts_table', 1),
(8, '2024_10_23_134404_create_contacts_table', 1);

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

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 7, 'auth_token', 'de64115a8fe0498ba96cd513bebc8e1d874f53da4195a7608548f13f19795835', '[\"*\"]', '2024-11-10 17:07:32', NULL, '2024-11-10 17:06:22', '2024-11-10 17:07:32');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `rate` double NOT NULL,
  `image` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `rate`, `image`, `published`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'men', 300, 2, '1729884958.jpg', 1, 1, '2024-10-25 17:35:58', '2024-10-25 17:35:58'),
(2, 'winter men', 400, 4, '1729887559.jpg', 0, 1, '2024-10-25 17:36:27', '2024-10-25 18:19:19'),
(3, 'clothes men', 300, 4, '1729885581.jpg', 1, 1, '2024-10-25 17:37:01', '2024-10-25 17:46:21'),
(4, 'men1', 300, 2, '1729887590.jpg', 1, 1, '2024-10-25 17:35:58', '2024-10-25 18:20:31'),
(5, 'winter men', 400, 4, '1729885547.jpg', 1, 1, '2024-10-25 17:36:27', '2024-10-25 17:45:47'),
(6, 'clothes men', 300, 4, '1729885021.jpg', 1, 1, '2024-10-25 17:37:01', '2024-10-25 17:37:01'),
(7, 'women', 700, 5, '1729885738.jpg', 1, 2, '2024-10-25 17:48:58', '2024-10-25 17:48:58'),
(8, 'women collection', 700, 5, '1729885766.jpg', 1, 2, '2024-10-25 17:49:26', '2024-10-25 17:49:26'),
(9, 'women 1', 600, 5, '1729885805.jpg', 1, 2, '2024-10-25 17:50:05', '2024-10-25 17:50:05'),
(10, 'women 1', 600, 5, '1729886126.jpg', 1, 2, '2024-10-25 17:52:33', '2024-10-25 17:55:26'),
(11, 'winter women', 600, 5, '1729885977.jpg', 1, 2, '2024-10-25 17:52:57', '2024-10-25 17:52:57'),
(12, 'women collection', 600, 5, '1729886040.jpg', 1, 2, '2024-10-25 17:54:00', '2024-10-25 17:54:00'),
(13, 'kids', 900, 6, '1729886335.jpg', 1, 4, '2024-10-25 17:58:55', '2024-10-25 17:58:55'),
(14, 'winter kids', 500, 6, '1729886365.jpg', 1, 4, '2024-10-25 17:59:25', '2024-10-25 17:59:25'),
(15, 'kids collection', 500, 30, '1729886468.jpg', 1, 4, '2024-10-25 18:01:08', '2024-10-25 18:01:08'),
(16, 'kids collection', 500, 30, '1729886543.jpg', 1, 4, '2024-10-25 18:02:23', '2024-10-25 18:02:23'),
(17, 'kids', 500, 30, '1729886562.jpg', 1, 4, '2024-10-25 18:02:42', '2024-10-25 18:02:42'),
(19, 'sara', 300, 7, '1731359196.jpg', 1, 2, '2024-11-11 19:06:36', '2024-11-11 19:06:36');

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
('eGIb8pxy3tQsrrwHQj64PICS8X8J2ZE9A7ZxbKwF', 10, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiR3pTRUJjY0RzaENRSjFLVFF3NHJnd3VDcksyMWtCVElHYno5VEVlUCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyL2luZGV4Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTA7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzMxMzYwMDU3O319', 1731360980);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `active` varchar(255) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `email_verified_at`, `password`, `active`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'amina', 'abdo', 'mony', 'amina@gmail.com', '2024-10-25 20:24:58', '$2y$12$lwBcadhEQEMdSbOU56OpYuiMcSquj/cgBObVZ.V.Dhs1IUAzuZkpG', '1', NULL, '2024-10-25 20:24:16', '2024-11-10 18:10:37'),
(3, 'angham', 'hedia', 'nana', 'angham@gmail.com', '2024-10-01 23:36:45', '$2y$12$c8X9V6VwAhrPv7dJRhoFw.HZxtLeeD98SHq.24PY7VEG6u1RpANEi', '1', NULL, '2024-10-25 20:36:28', '2024-10-25 20:36:28'),
(4, 'esraa', 'hedia', 'soso', 'esraahedia33@gmail.com', '2024-10-09 21:07:44', '$2y$12$BQjijW/p6JpM.SpRDOnYDONTH8P9.d4g62Jg8YKbtIVlP1BUwLcTu', '0', NULL, '2024-10-25 21:49:41', '2024-10-25 21:49:41'),
(5, 'amani', 'ali', 'mona', 'amani@gmail.com', NULL, '$2y$12$rlP9T75nXfZmGOeMsJPpXeXHSOoit.Yp.k2SqXHaWqe6S3.iTwZ0q', '0', NULL, '2024-10-25 21:59:56', '2024-10-25 21:59:56'),
(6, 'mona', 'ali', 'mona33', 'mona@gmail.com', '2024-10-08 01:07:27', '$2y$12$6SEZSAh9.gP9uIr1cbweK.VavXO4g8IE7AhLsBHBLeiLRJKpnyJ4K', '1', NULL, '2024-10-25 22:02:01', '2024-10-25 22:23:07'),
(7, 'mama', 'hedia', 'mama', 'aida@gmail.com', '2024-10-08 21:10:49', '$2y$12$34wGgH0Y2YQqhQ9fLTsCRe8hUd6CliMEWjRBIQ7FY0SY..nCnvxQ2', '1', NULL, '2024-10-28 18:10:03', '2024-10-28 18:10:03'),
(8, 'ahmed', 'ali', 'ali', 'ahmed@gmail.com', NULL, '$2y$12$N6ftZA2ByoO0TnqFcgpqQeTr31VMln.Q1k5dvFSjrDuZO7tdWX2Ry', '0', NULL, '2024-11-10 17:17:05', '2024-11-10 17:17:05'),
(9, 'sara', 'ali', 'sara55', 'sara55@gmail.com', '2024-11-04 21:10:42', '$2y$12$P3QqGiQvYvbvhXQDXuFEIeMOxrMeJhv/PCV2/Q/Vu/k9yHOVACrCa', '1', NULL, '2024-11-11 19:09:40', '2024-11-11 19:09:52'),
(10, 'saly', 'ali', 'saly', 'saly@gmail.com', '2024-11-13 21:18:42', '$2y$12$2VpQvYVMCAwHTA7nDW7MdeC164Agb9woWs/zjmIjcadcKE.5cCP4a', '0', NULL, '2024-11-11 19:18:19', '2024-11-11 19:29:37'),
(11, 'iman', 'hedia', 'memo', 'iman66@gmail.com', NULL, '$2y$12$AS30oXQDxTGMjGG8Vg3..u4hZbGvVeF5mnD4dyR0srUybEp33BiPu', '0', NULL, '2024-11-11 19:35:53', '2024-11-11 19:35:53');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

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
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

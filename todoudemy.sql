-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2018 at 01:42 AM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myfirsttodo`
--

-- --------------------------------------------------------

--
-- Table structure for table `invitations`
--

CREATE TABLE `invitations` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL,
  `accepted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invitations`
--

INSERT INTO `invitations` (`id`, `admin_id`, `worker_id`, `accepted`, `created_at`, `updated_at`) VALUES
(2, 1, 2, 1, '2018-09-02 13:54:12', '2018-09-02 13:54:25');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2014_10_12_000000_create_users_table', 1),
(4, '2014_10_12_100000_create_password_resets_table', 1),
(5, '2018_08_29_161234_create_tasks_table', 2),
(6, '2018_09_01_160505_create_invitations_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `content` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `admin_id`, `status`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'Go to Gym', '2018-08-29 15:47:42', '2018-08-29 16:49:04'),
(2, 1, 1, 0, 'Coding our own Project', '2018-08-29 15:48:12', '2018-09-02 14:22:39'),
(3, 2, NULL, 0, 'PlayStation', '2018-08-29 15:58:45', '2018-08-29 16:34:18'),
(5, 2, NULL, 0, 'Call Moataz', '2018-08-29 16:49:18', '2018-08-29 16:49:18'),
(6, 2, NULL, 0, 'Take Medcine', '2018-08-29 16:49:26', '2018-08-29 16:49:26'),
(7, 2, NULL, 0, 'Code in Vuejs', '2018-09-01 13:34:36', '2018-09-01 13:34:36'),
(8, 2, NULL, 0, 'Job Meeting', '2018-09-01 14:36:41', '2018-09-01 14:36:41'),
(9, 1, 1, 0, 'Go wedding', '2018-09-01 15:48:14', '2018-09-01 15:48:38'),
(15, 4, NULL, 0, 'Go Alexander', '2018-09-02 09:57:28', '2018-09-02 09:57:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Hesham Yahia', 'hesham14yahia@gmail.com', '$2y$10$LAUgx60fOnWK7zpjHcnz4.BKOXfu3.zcmLb5yaIJa5HzHONqFmEgy', 1, 'uz584gy7Oliswez7EjEsyxUZ2dgipNLK2s3Zz5LfvO3ZnkldJlP9bdpfLAeb', '2018-08-29 08:47:31', '2018-08-29 08:47:31'),
(2, 'Titlo Jarves', 'titojarves@gmail.com', '$2y$10$u5FqKPAWaoMFPguIHThy7e9h4TeICS3XvqktoeYwDaAQOPjUgaAk2', 0, 'Pw66QhmbiN8ZgUsQ2NqduFhg4b48WNoBGR78whDVpbNFnO5Rv9yrUNjOCZw7', '2018-08-29 09:11:48', '2018-08-29 09:11:48'),
(3, 'Mostafa Yahia', 'moyahia@gmail.com', '$2y$10$H7bx0Ez6wDlAd661sUItIehZlxihy8XDV9MB3bXsgFR7/XptGMbpi', 1, 'awY0Qi6wCwtq0S3Rha4qpt8kGK0mtjqFppw5VH7Mc2f7cjTzTAYJ0oNE5npM', '2018-09-02 08:45:33', '2018-09-02 08:45:33'),
(4, 'Mohamed Yahia', 'mohyahia@gmail.com', '$2y$10$oAHkQqVEwPdjhvKjpkOpE.9KPiVGD.j4Ias5dm1cakyOHDW6Dsf3q', 0, 'x7ue2ur0Dw3O5EJzXzIegSsREx5tq1bcsDR4CyEwFsfOKB9pNOZM47YYAlo9', '2018-09-02 08:46:38', '2018-09-02 08:46:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invitations`
--
ALTER TABLE `invitations`
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
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `invitations`
--
ALTER TABLE `invitations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

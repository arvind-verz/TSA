-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2018 at 06:19 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_type_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delete_status` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `first_name`, `last_name`, `email`, `role_type_id`, `password`, `remember_token`, `delete_status`, `created_at`, `updated_at`) VALUES
(1, 'Super', 'Admin', 'admin@speedo.com.sg', '1', '$2y$10$LsjCAxJAhCr7My3H2d9gKuV0zh3UfDxdaWO5eldKMeEGB85ruMh4m', 'Kbl7EyOPn5d0vWaJTXZfzk8R7AulukD68NVstQajDl3mvZlYqzfuVKAa5uAY', 0, '2018-01-28 11:41:26', '2018-05-01 03:40:05'),
(2, 'Nikunj', NULL, 'nicckk.verz@gmail.com', '2', '$2y$10$Xn4paC/zTL3JVoyCtvaBnO4KxlECjFwHJxabjPXEmDFPtMz/hBqAO', 'Ss5MELiT8oT9kP699CgEdowkj7rKTE2hdH9xcdmvN45whHRqelr9J9PWvYXt', 0, '2018-02-18 23:28:18', '2018-05-03 04:22:19'),
(3, 'admin', NULL, 'admin@speedo-marine.com', NULL, '$2y$10$wtjQchx3G18lwNrm1xGigucs6d7xAHb09mxqHV3qw/WVrH9AcgMWi', 'mphRKu4h4zcJWEyZXYJC5dJcyPIOnovgLj5dgIeLsOTLgKfgP2ShQKOsusQv', 0, '2018-01-28 11:41:26', '2018-01-28 11:41:26'),
(4, 'Nikunj', NULL, 'nicckk123@gmail.com', NULL, '$2y$10$Qwznhe5MFIq/3w7JpX9ig.V3Hi62xn3w9TnaqG92bk01jcT9m23ua', NULL, 0, '2018-04-24 07:53:35', '2018-04-24 07:53:35'),
(6, 'Nikunj', 'Patel', 'nicckk3@gmail.com', '1', '$2y$10$KeYxg9JNS.ZO0Z7g8XtaZeNKBY1HgC1aWd5xy.2fTP.MM/9ryvtqu', 'ger4eGah0M4Ctk3pQYqJeWrgWcnGWBY3JAtXxgzb68HgnUSQXTf0SWnLAjKb', 0, '2018-04-25 03:25:29', '2018-06-28 03:17:24'),
(7, 'Nikunj', 'Patel', 'nicckk1@gmail.com', '2', '$2y$10$uKhTYA524rBEF6ipRjeQG.iRhXr.PdnHNwRpbbLmjBBbyX7iwc9g2', NULL, 0, '2018-04-25 03:26:30', '2018-04-25 03:26:30'),
(8, 'Akki', NULL, 'nicckk2@gmail.com', '2', '$2y$10$2GxTFdtzZ7HNBZcgJLoxxebbGOxbvQPOW7TlcRgng3Sw4hh.jm45S', '5Cq0PErlK5DySFf22PPqkOIKgl2La1e8uPGXN1AXZY5diqb2HTbdF5QeEI56', 1, '2018-04-25 03:34:25', '2018-04-25 03:48:18'),
(9, 'Lay Hoon', 'Choo', 'layhoon.choo@speedo.com.sg', '3', '$2y$10$PpVvGmGRItr4aClbTzWIqO7rq4D7D27rqNOOZJCx.vMVWvXcJbqaC', 'lIizUpKdCC9VGSokQYLqsGOJcRRztcDmUYBCw2WC4NtiFevPXmmjXpmid05K', 0, '2018-05-14 07:12:57', '2018-05-14 07:12:57'),
(10, 'OCBC', 'Test Account', 'ocbc@speedo.com.sg', '2', '$2y$10$ciDoQbvmV2jgHDTaSSPI6.ns9gYAzAVnDqzDZt7HYh0BmqsKlgnE2', NULL, 0, '2018-06-29 07:02:03', '2018-06-29 07:02:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

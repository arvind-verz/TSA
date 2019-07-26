-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2018 at 06:02 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tsa`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) UNSIGNED NOT NULL,
  `page_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `position` varchar(250) NOT NULL,
  `menu_title` varchar(60) NOT NULL,
  `menu_position` varchar(10) NOT NULL,
  `external_url` varchar(250) NOT NULL,
  `link_type` enum('internal','external') NOT NULL DEFAULT 'internal',
  `link_target` enum('self','new_tab') NOT NULL DEFAULT 'self',
  `sort_order` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `page_id`, `parent_id`, `position`, `menu_title`, `menu_position`, `external_url`, `link_type`, `link_target`, `sort_order`) VALUES
(2, 3, 0, 'MainMenu', 'About Us', '', '0', 'internal', 'self', 2),
(3, 6, 0, 'MainMenu', 'Contact Us', '', '0', 'internal', 'self', 2),
(4, 2, 0, 'MainMenu', 'Home', '', '0', 'internal', 'self', 1),
(5, 3, 2, 'MainMenu', 'The Science Academy', '', '0', 'internal', 'self', 7),
(6, 4, 2, 'MainMenu', 'Mission &amp; Vision', '', '0', 'internal', 'self', 8),
(7, 5, 2, 'MainMenu', 'Our Core Team', '', '0', 'internal', 'self', 9),
(8, 7, 0, 'footerBottom', 'Thank You', '', '0', 'internal', 'self', 1),
(9, 8, 0, 'MainMenu', 'Subjects', '', '0', 'internal', 'self', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

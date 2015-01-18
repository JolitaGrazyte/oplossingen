-- phpMyAdmin SQL Dump
-- version 4.2.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 18, 2015 at 06:16 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `todoLaravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2015_01_12_190806_create_users_table', 1),
('2015_01_12_193621_create_users_table', 2),
('2015_01_12_194252_create_users_table', 3),
('2015_01_12_194449_create_todos_table', 4),
('2015_01_14_145013_create_users_table', 5),
('2015_01_14_184219_add_remember_token_to_users_table', 6),
('2015_01_15_082608_add_activateCode_to_users', 7);

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

CREATE TABLE IF NOT EXISTS `todos` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `archived` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=66 ;

--
-- Dumping data for table `todos`
--

INSERT INTO `todos` (`id`, `name`, `status`, `archived`, `created_at`, `updated_at`, `user_id`) VALUES
(63, 'job 1', 1, 1, '2015-01-18 16:14:48', '2015-01-18 16:15:04', '46'),
(64, 'job 2', 1, 0, '2015-01-18 16:14:53', '2015-01-18 16:15:02', '46'),
(65, 'job 3', 0, 0, '2015-01-18 16:14:57', '0000-00-00 00:00:00', '46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password-temp` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'null',
  `activateCode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=47 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `password-temp`, `activateCode`, `active`, `created_at`, `updated_at`, `remember_token`) VALUES
(10, 'jolita@wgwstore.com', '$2y$10$qIXrVnAFTlmS4jCTZNbgvuv7eNRBLji4ZcKjKdzh5/CPlCgM7Cu5.', 'null', '', 1, '2015-01-14 15:43:56', '2015-01-18 16:09:23', 'PkaK2GrUSkPwZlJw94vzmn7ve02ivNOJDhzvkkO0BD5zGK5M1pfB7MYSIzfs'),
(46, 'jolita.grazyte@student.kdg.be', '$2y$10$kA6uqlLAq8on4TJo1qII.uuizG0BdFgA.2R7KnYSSTjPI4Y5KBNJq', 'null', '', 1, '2015-01-18 16:09:54', '2015-01-18 16:15:09', 'HNoigYeWaFM49ZqWAO1Rtpy3yQ90l0klq59J6s7uvo6cG7WB4cxH9SVwWJEe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `todos`
--
ALTER TABLE `todos`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `todos`
--
ALTER TABLE `todos`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

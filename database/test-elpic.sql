-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2018 at 06:30 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test-elpic`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `img_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `visibility` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`img_id`, `user_id`, `title`, `description`, `visibility`, `created_at`) VALUES
(2, 21, 'FASDWASDAS.png', 'ASD', 0, '2018-05-21 22:08:30'),
(3, 21, 'laravel.png', 'asdwasd', 0, '2018-05-21 22:10:59'),
(4, 21, 'newebar.png', 'asdasd', 0, '2018-05-21 22:35:58'),
(5, 21, 'finalssd.png', 'wdasd', 0, '2018-05-21 22:37:43'),
(6, 21, 'privatepic.png', 'aeta private', 1, '2018-05-21 23:08:16'),
(7, 21, 'swiftprivate.png', 'asdasd', 1, '2018-05-21 23:29:48'),
(8, 21, 'springbot.png', 'asdasd', 1, '2018-05-21 23:30:56'),
(9, 21, 'imagenowjpg.jpg', 'jpg image', 1, '2018-05-23 11:29:17');

-- --------------------------------------------------------

--
-- Table structure for table `invites`
--

CREATE TABLE `invites` (
  `invite_id` int(11) NOT NULL,
  `invited_by_id` int(11) NOT NULL,
  `invited_to_email` text NOT NULL,
  `img_id` int(11) NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invites`
--

INSERT INTO `invites` (`invite_id`, `invited_by_id`, `invited_to_email`, `img_id`, `token`, `status`, `created_at`) VALUES
(3, 21, 'im_fahim@yahoo.com', 4, 'rG4nDUAumHJjl303wA20VyVwM', 0, '2018-05-22 08:37:55'),
(4, 21, 'im_fahim@yahoo.com', 3, 'tb9cM9Q64G9OG5g2Zun8FJkxC', 0, '2018-05-22 13:56:27'),
(5, 21, 'im_fahim@yahoo.com', 7, 'PkpsD7vb1VeEoLHmydL89jSKc', 0, '2018-05-22 14:20:02'),
(6, 21, 'im_fahim@yahoo.com', 9, 'CldLAVpfBXHjAET6hCdWBT37F', 0, '2018-05-23 11:32:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `mobile_number` text NOT NULL,
  `address` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `mobile_number`, `address`, `status`, `remember_token`, `created_at`) VALUES
(1, 'fahim', 'aka@gm.com', '$2y$10$1ZgmBTyM4TAqNi.acFR4PO9iS1Fx5FqDwKcig8Ihbv9YQdaFy/aMe', '123121', 'adsad', 1, NULL, '2018-05-17 23:01:31'),
(21, 'Fahim Khan', 'im_fahim@yahoo.com', '$2y$10$1ZgmBTyM4TAqNi.acFR4PO9iS1Fx5FqDwKcig8Ihbv9YQdaFy/aMe', '123121', 'ad', 1, NULL, '2018-05-18 15:47:50'),
(22, 'newhashpassword', 'asdwasd@gmail.com', '$2y$10$1ZgmBTyM4TAqNi.acFR4PO9iS1Fx5FqDwKcig8Ihbv9YQdaFy/aMe', '321564654', 'banasree, rampura', 0, NULL, '2018-05-23 12:15:27');

-- --------------------------------------------------------

--
-- Table structure for table `verify_users`
--

CREATE TABLE `verify_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `verify_users`
--

INSERT INTO `verify_users` (`id`, `user_id`, `token`, `created_at`, `updated_at`) VALUES
(20, 21, 'lwWvtYk7SRbAKcQIQSBfUHtT3', '2018-05-18 15:47:50', NULL),
(21, 22, 'W0EUr9Sx1a5O9sH85zOxMLBLU', '2018-05-23 12:15:27', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`img_id`);

--
-- Indexes for table `invites`
--
ALTER TABLE `invites`
  ADD PRIMARY KEY (`invite_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verify_users`
--
ALTER TABLE `verify_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `invites`
--
ALTER TABLE `invites`
  MODIFY `invite_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `verify_users`
--
ALTER TABLE `verify_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

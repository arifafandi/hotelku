-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2021 at 09:26 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotelku`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', '2021-07-14 14:24:21', '2021-07-14 14:24:21'),
(2, 'member', 'Member', '2021-07-15 10:11:22', '2021-07-15 10:11:22');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `display` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `url`, `icon`, `display`) VALUES
(1, 'Home', '/', 'feather icon-home', '1'),
(2, 'History', 'histori', 'feather icon-file-text', '1');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `status` enum('booked','unbooked') NOT NULL DEFAULT 'unbooked',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `id_type`, `number`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 10, 'unbooked', '2021-07-10 13:29:53', '2021-07-10 13:29:53'),
(2, 2, 11, 'unbooked', '2021-07-10 13:29:53', '2021-07-10 13:29:53'),
(3, 3, 13, 'booked', '2021-07-10 13:59:24', '2021-07-10 13:59:24'),
(4, 2, 14, 'unbooked', '2021-07-10 14:03:49', '2021-07-10 14:03:49'),
(5, 3, 15, 'unbooked', '2021-07-10 14:04:32', '2021-07-10 14:04:32'),
(6, 4, 16, 'booked', '2021-07-10 23:04:28', '2021-07-10 23:04:28'),
(7, 4, 17, 'unbooked', '2021-07-10 23:04:34', '2021-07-10 23:04:34'),
(8, 3, 21, 'booked', '2021-07-12 10:01:33', '2021-07-12 10:01:33');

-- --------------------------------------------------------

--
-- Table structure for table `rooms_type`
--

CREATE TABLE `rooms_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `price` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms_type`
--

INSERT INTO `rooms_type` (`id`, `name`, `description`, `image`, `price`, `created_at`, `updated_at`) VALUES
(2, 'Deluxe', 'King Bed', 'f88d3527e16da2759dc26278401f77fa.jpg', '300000', '2021-07-10 06:29:48', '2021-07-12 09:58:48'),
(3, 'Superior', '', 'e52e5c19856a7f144c3be4d4154d0cd2.jpg', '500000', '2021-07-10 13:45:52', '2021-07-10 23:03:35'),
(4, 'Standart', 'TEST', '160f33f3d8a221d5203953bf74892dba.jpg', '150000', '2021-07-10 23:04:06', '2021-07-10 23:14:58');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `id_room` int(11) DEFAULT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `price` text NOT NULL,
  `status` enum('UNPAID','PENDING','SUCCESS') NOT NULL DEFAULT 'UNPAID',
  `payment_proof` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `id_user`, `id_type`, `id_room`, `check_in`, `check_out`, `price`, `status`, `payment_proof`, `created_at`, `updated_at`) VALUES
(5, 2, 4, 6, '2021-07-11', '2021-07-20', '1350000', 'SUCCESS', '097597013903a0ed1a9a56dac625b7d7.png', '2021-07-11 19:55:59', '2021-07-11 19:55:59'),
(6, 2, 3, NULL, '2021-07-05', '2021-07-12', '3500000', 'PENDING', '481eb6b6b2649f9149d44ef29d9778fe.png', '2021-07-11 21:07:14', '2021-07-11 21:07:14'),
(7, 2, 2, NULL, '2021-07-13', '2021-07-15', '600000', 'UNPAID', NULL, '2021-07-12 09:00:47', '2021-07-12 09:00:47'),
(8, 2, 4, NULL, '2021-07-12', '2021-07-14', '300000', 'UNPAID', NULL, '2021-07-12 09:32:05', '2021-07-12 09:32:05'),
(9, 3, 3, 8, '2021-07-14', '2021-07-16', '1000000', 'SUCCESS', '4c1d23d73f334e1cae01d01addc8f798.png', '2021-07-12 09:57:03', '2021-07-12 09:57:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `id_group` enum('1','2') DEFAULT '2' COMMENT '''1 = Admin'', ''2 = Member''',
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `identity_number` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_group`, `name`, `email`, `password`, `identity_number`, `city`, `phone`, `created_at`, `updated_at`) VALUES
(1, '2', 'Muhammad Arif Afandi', 'arifafandi242@gmail.com', '25d55ad283aa400af464c76d713c07ad', '1343423', 'Malang', '085325315432', '2021-07-11 14:50:09', '2021-07-11 14:50:09'),
(2, '1', 'Administrator', 'admin@mail.com', '21232f297a57a5a743894a0e4a801fc3', '12345678', 'malang', '908021484', '2021-07-11 15:29:38', '2021-07-11 15:29:38'),
(3, '2', 'orang', 'rpl18@mail.com', '61ed5ddafed8497c9a6270d6b1949488', '678889477738', 'Malang', '082637366478', '2021-07-12 09:56:28', '2021-07-12 09:56:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type` (`id_type`);

--
-- Indexes for table `rooms_type`
--
ALTER TABLE `rooms_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_type` (`id_type`),
  ADD KEY `id_room` (`id_room`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rooms_type`
--
ALTER TABLE `rooms_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `rooms_type` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`id_type`) REFERENCES `rooms_type` (`id`),
  ADD CONSTRAINT `transactions_ibfk_3` FOREIGN KEY (`id_room`) REFERENCES `rooms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

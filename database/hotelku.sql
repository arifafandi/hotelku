-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2021 at 07:50 AM
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
  `role` enum('member','admin') DEFAULT 'member',
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

INSERT INTO `users` (`id`, `role`, `name`, `email`, `password`, `identity_number`, `city`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'member', 'Muhammad Arif Afandi', 'arifafandi242@gmail.com', '25d55ad283aa400af464c76d713c07ad', '1343423', 'Malang', '085325315432', '2021-07-11 14:50:09', '2021-07-11 14:50:09'),
(2, 'admin', 'Administrator', 'admin@mail.com', '21232f297a57a5a743894a0e4a801fc3', '12345678', 'malang', '908021484', '2021-07-11 15:29:38', '2021-07-11 15:29:38'),
(3, 'member', 'Kelompok 18', 'rpl18@mail.com', '25d55ad283aa400af464c76d713c07ad', '678889477738', 'Malang', '082637366478', '2021-07-12 09:56:28', '2021-07-12 09:56:28');

--
-- Indexes for dumped tables
--

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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

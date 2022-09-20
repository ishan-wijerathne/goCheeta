-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 20, 2022 at 08:44 AM
-- Server version: 8.0.27
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gocheeta`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_id` int NOT NULL,
  `vehicle_id` int NOT NULL,
  `pickup_location` int NOT NULL,
  `pickup_address` varchar(255) NOT NULL,
  `drop_location` int NOT NULL,
  `drop_address` varchar(255) NOT NULL,
  `pickup_date` date NOT NULL,
  `pickup_time` time NOT NULL,
  `status` varchar(25) NOT NULL,
  `feedback` text NOT NULL,
  `modified_by` int NOT NULL,
  `modified_date` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `client_id`, `vehicle_id`, `pickup_location`, `pickup_address`, `drop_location`, `drop_address`, `pickup_date`, `pickup_time`, `status`, `feedback`, `modified_by`, `modified_date`) VALUES
(1, 2, 2, 2, 'dalada street', 1, 'colombo 07', '2022-09-20', '22:00:00', 'Cancelled', 'My program postponed', 2, '2022-09-20 07:57:02'),
(2, 2, 1, 2, 'Dalada street', 4, 'Temple Road', '2022-09-20', '13:10:00', 'Trip Completed', 'Fantastic service. Driver on time despite very very tricky hotel location. Would defiantly recommend 100%.', 2, '2022-09-20 07:43:32'),
(3, 2, 4, 1, 'Colombo 7', 3, 'Main Street', '2022-09-30', '14:20:00', 'Processing', '', 2, '2022-09-20 07:53:10'),
(4, 4, 3, 1, 'Colombo 7', 2, 'Main Street', '2022-09-23', '14:30:00', 'Processing', '', 4, '2022-09-20 07:58:38');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
CREATE TABLE IF NOT EXISTS `branches` (
  `id` int NOT NULL AUTO_INCREMENT,
  `branch` varchar(55) NOT NULL,
  `modified_by` int NOT NULL,
  `modified_date` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `branch`, `modified_by`, `modified_date`) VALUES
(1, 'Colombo', 51, '2022-09-19 19:06:33'),
(2, 'Kandy', 51, '2022-09-19 19:06:38'),
(3, 'Kurunegala', 51, '2022-09-19 19:06:45'),
(4, 'Kalutara', 51, '2022-09-19 19:06:51');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(55) NOT NULL,
  `icon` varchar(55) NOT NULL,
  `modified_by` int NOT NULL,
  `modified_date` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `icon`, `modified_by`, `modified_date`) VALUES
(1, 'Mini Car', 'mini-car.png', 1, '2022-09-19 11:55:42'),
(2, 'Car', 'car.png', 1, '2022-09-19 11:56:05'),
(3, 'VIP', 'luxury-car.png', 1, '2022-09-19 11:57:35'),
(4, 'Van', 'van.png', 1, '2022-09-19 11:56:24');

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

DROP TABLE IF EXISTS `rates`;
CREATE TABLE IF NOT EXISTS `rates` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `branch_from` int NOT NULL,
  `branch_to` int NOT NULL,
  `milage` double NOT NULL,
  `rate` double NOT NULL,
  `modified_by` int NOT NULL,
  `modified_date` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`id`, `category_id`, `branch_from`, `branch_to`, `milage`, `rate`, `modified_by`, `modified_date`) VALUES
(1, 1, 1, 4, 50, 5000, 1, '2022-09-16 19:35:05'),
(2, 1, 1, 2, 123, 12300, 1, '2022-09-16 19:35:44'),
(3, 1, 1, 3, 104, 10400, 1, '2022-09-16 19:36:27'),
(4, 1, 4, 2, 159, 15900, 1, '2022-09-16 19:37:02'),
(5, 1, 4, 3, 132, 13200, 1, '2022-09-16 19:37:25'),
(6, 1, 2, 3, 43, 4300, 1, '2022-09-16 19:48:41'),
(7, 2, 1, 4, 50, 6500, 1, '2022-09-19 12:09:12'),
(8, 2, 1, 2, 123, 15990, 1, '2022-09-19 12:09:31'),
(9, 2, 1, 3, 104, 13520, 1, '2022-09-19 12:09:48'),
(10, 2, 4, 2, 159, 20670, 1, '2022-09-19 12:10:03'),
(11, 2, 4, 3, 132, 17160, 1, '2022-09-19 12:10:18'),
(12, 2, 2, 3, 43, 5590, 1, '2022-09-19 12:10:34'),
(13, 4, 1, 4, 50, 8500, 1, '2022-09-19 12:11:15'),
(14, 4, 1, 2, 123, 20910, 1, '2022-09-19 12:11:31'),
(15, 4, 1, 3, 104, 17680, 1, '2022-09-19 12:11:43'),
(16, 4, 4, 2, 159, 27030, 1, '2022-09-19 12:11:57'),
(17, 4, 4, 3, 132, 22440, 1, '2022-09-19 12:12:10'),
(18, 4, 2, 3, 43, 7310, 1, '2022-09-19 12:12:24'),
(19, 3, 1, 4, 50, 12500, 1, '2022-09-19 12:13:34'),
(20, 3, 1, 2, 123, 30750, 1, '2022-09-19 12:13:43'),
(21, 3, 1, 3, 104, 26000, 1, '2022-09-19 12:14:01'),
(22, 3, 4, 2, 159, 39750, 1, '2022-09-19 12:14:18'),
(23, 3, 4, 3, 132, 33000, 1, '2022-09-19 12:14:43'),
(24, 3, 2, 3, 43, 10750, 1, '2022-09-19 12:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` text CHARACTER SET utf8 COLLATE utf8_bin,
  `password` text CHARACTER SET utf8 COLLATE utf8_bin,
  `password_token` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `first_name` text CHARACTER SET utf8 COLLATE utf8_bin,
  `last_name` text CHARACTER SET utf8 COLLATE utf8_bin,
  `email` text CHARACTER SET utf8 COLLATE utf8_bin,
  `telephone` text CHARACTER SET utf8 COLLATE utf8_bin,
  `user_type` text CHARACTER SET utf8 COLLATE utf8_bin,
  `status` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `password_token`, `first_name`, `last_name`, `email`, `telephone`, `user_type`, `status`) VALUES
(1, 'admin', '$2y$10$SpH8R/t6e/CEZ56uS1nwhudFCl3Sw3vcau9xYAuznylJZqxQ.4CJO', NULL, 'Udayanga', 'Wijerathne', 'admin@gocheeta.lk', '0712616673', 'Admin', 'Active'),
(2, 'client1', '$2y$10$L2p.r91xaYCiMJ5nqoPgo.PKgIjCFW3WaYr.7bhmLTNtSIepY4vrq', NULL, 'Amal', 'Perera', 'client1@test.lk', '0715465464', 'Client', 'Active'),
(3, 'staff', '$2y$10$uxB2PQKZCWsRg4eW8MEKpeIvLU9ZP6ANGpXUvDlLVHOptccl5/Jmq', NULL, 'Nayomi', 'Thakshila', 'nayomi@gocheeta.lk', '0712546857', 'Staff', 'Active'),
(4, 'client2', '$2y$10$EnsgNFE9XqN8l26YmpCSP.soSTrgzp.flhs.oyfhukJEFbbqIrove', NULL, 'Nuwan', 'Indika', 'nuwan@test.lk', '0715654545', 'Client', 'Active'),
(5, 'client3', '$2y$10$DhTXPdcmkKjlO0i7WHmYlOqARaHXskGqltR2Ocxvu7trfUpPaGktC', NULL, 'Aruni', 'Fernando', 'aruni@test.com', '0774545654', 'Client', 'Active'),
(6, 'driver1', '$2y$10$6o6PC0AUtrNaubQn0fwLzOc8LEvPrDEvc7hoKuCelrenEUM3w8G8.', NULL, 'Ruwan', 'Asanka', 'ruwan@gocheeta.lk', '0752565654', 'Driver', 'Active'),
(7, 'driver2', '$2y$10$aqTzDvMZvN8DpIy87oZgceX0j0TUJkuxE3ETQAVH9uNYyv5hbpIgi', NULL, 'Harin', 'Jayalath', 'harin@gocheeta.lk', '0702254154', 'Driver', 'Active'),
(8, 'driver3', '$2y$10$fkpuH2gKMkjMExOpe2YY/O4NId0k6kvCmzyb2VHn3wsRSiOGezdeS', NULL, 'Jayan', 'Maduranga', 'jayan@gocheeta.lk', '0754512645', 'Driver', 'Active'),
(9, 'driver4', '$2y$10$zrB8xeSy7fhsLRTXUgLwOOMHugwlLxmWdNFFPSKX1sC6XKv8ZfIi2', NULL, 'Mahesh', 'Darshana', 'mahesh@gocheeta.lk', '0772354545', 'Driver', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE IF NOT EXISTS `vehicles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `branch_id` int NOT NULL,
  `driver_id` int NOT NULL,
  `category_id` int NOT NULL,
  `plate_no` varchar(20) NOT NULL,
  `model` varchar(55) NOT NULL,
  `passengers` int NOT NULL,
  `modified_by` int NOT NULL,
  `modified_date` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `branch_id`, `driver_id`, `category_id`, `plate_no`, `model`, `passengers`, `modified_by`, `modified_date`) VALUES
(1, 2, 6, 2, 'CP KS-5522', 'Toyota Prius', 4, 0, '2022-09-20 07:11:19'),
(2, 2, 7, 1, 'CP KJ-2568', 'Suzuki Alto', 3, 0, '2022-09-20 07:13:48'),
(3, 1, 8, 4, 'WP PQ-5652', 'Toyota Hiace', 10, 0, '2022-09-20 07:19:30'),
(4, 1, 9, 3, 'WP KX-5555', 'bmw X1', 4, 0, '2022-09-20 07:22:04');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

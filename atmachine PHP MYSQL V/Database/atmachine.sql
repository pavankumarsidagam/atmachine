-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2023 at 06:41 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `atmachine`
--

-- --------------------------------------------------------

--
-- Table structure for table `atm_manchine`
--

CREATE TABLE `atm_manchine` (
  `atm_id` int(10) NOT NULL,
  `atm_blnc` varchar(1000) DEFAULT NULL,
  `note_500` varchar(11) DEFAULT NULL,
  `note_200` varchar(11) DEFAULT NULL,
  `note_100` varchar(11) DEFAULT NULL,
  `status_` enum('0','1') NOT NULL DEFAULT '1',
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `atm_manchine`
--

INSERT INTO `atm_manchine` (`atm_id`, `atm_blnc`, `note_500`, `note_200`, `note_100`, `status_`, `time_stamp`) VALUES
(1, '113800', '143', '149', '125', '1', '2023-11-19 02:14:35');

-- --------------------------------------------------------

--
-- Table structure for table `atm_transactions`
--

CREATE TABLE `atm_transactions` (
  `transaction_id` int(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_type` varchar(30) DEFAULT NULL,
  `amount` varchar(30) DEFAULT NULL,
  `date_` date DEFAULT curdate(),
  `status_` enum('0','1') DEFAULT '1',
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `atm_transactions`
--

INSERT INTO `atm_transactions` (`transaction_id`, `user_id`, `transaction_type`, `amount`, `date_`, `status_`, `time_stamp`) VALUES
(1, 1, 'withdraw', '3000-', '2023-11-19', '1', '2023-11-18 23:56:20'),
(2, 1, 'deposit', '3000+', '2023-11-19', '1', '2023-11-18 23:56:41'),
(3, 2, 'withdraw', '4000-', '2023-11-19', '1', '2023-11-19 00:26:06'),
(4, 2, 'deposit', '4000+', '0000-00-00', '1', '2023-11-19 00:28:21'),
(5, 1, 'deposit', '160100+', '2023-11-19', '1', '2023-11-19 01:55:47'),
(6, 1, 'deposit', '3000+', '2023-11-19', '1', '2023-11-19 01:56:54'),
(7, 1, 'deposit', '5000+', '2023-11-19', '1', '2023-11-19 02:26:29'),
(8, 1, 'deposit', '5000+', '2023-11-19', '1', '2023-11-19 02:31:53'),
(9, 1, 'deposit', '5000+', '2023-11-19', '1', '2023-11-19 02:33:55'),
(10, 1, 'deposit', '1000+', '2023-11-19', '1', '2023-11-19 02:41:30'),
(11, 1, 'deposit', '200+', '2023-11-19', '1', '2023-11-19 02:50:57'),
(12, 1, 'deposit', '400+', '2023-11-19', '1', '2023-11-19 02:55:19'),
(13, 1, 'deposit', '500+', '2023-11-19', '1', '2023-11-19 07:24:53'),
(14, 1, 'withdraw', '500-', '2023-11-19', '1', '2023-11-19 10:47:12'),
(15, 1, 'withdraw', '700-', '2023-11-19', '1', '2023-11-19 10:48:25'),
(16, 1, 'withdraw', '100-', '2023-11-19', '1', '2023-11-19 10:50:06'),
(17, 1, 'withdraw', '100-', '2023-11-19', '1', '2023-11-19 10:50:58'),
(18, 1, 'withdraw', '200-', '2023-11-19', '1', '2023-11-19 10:55:46'),
(19, 1, 'withdraw', '200-', '2023-11-19', '1', '2023-11-19 10:56:14'),
(20, 1, 'withdraw', '100-', '2023-11-19', '1', '2023-11-19 11:09:18'),
(21, 1, 'withdraw', '100-', '2023-11-19', '1', '2023-11-19 11:10:58'),
(22, 1, 'withdraw', '100-', '2023-11-19', '1', '2023-11-19 11:12:16'),
(23, 1, 'withdraw', '100-', '2023-11-19', '1', '2023-11-19 11:13:04'),
(26, 1, 'withdraw', '100-', '2023-11-19', '1', '2023-11-19 11:42:36'),
(27, 1, 'withdraw', '100-', '2023-11-19', '1', '2023-11-19 12:09:02'),
(28, 0, 'withdraw', '100-', '2023-11-19', '1', '2023-11-19 12:11:52'),
(29, 0, 'withdraw', '100-', '2023-11-19', '1', '2023-11-19 12:13:00'),
(30, 1, 'deposit', '1000+', '2023-11-19', '1', '2023-11-19 12:18:38'),
(31, 1, 'withdraw', '100-', '2023-11-19', '1', '2023-11-19 12:19:04'),
(32, 1, 'withdraw', '100-', '2023-11-19', '1', '2023-11-19 12:40:06'),
(33, 1, 'deposit', '1000+', '2023-11-19', '1', '2023-11-19 12:45:09'),
(34, 1, 'withdraw', '100-', '2023-11-19', '1', '2023-11-19 12:59:52'),
(35, 2, 'withdraw', '100-', '2023-11-19', '1', '2023-11-19 13:04:09'),
(36, 2, 'withdraw', '100-', '2023-11-19', '1', '2023-11-19 13:08:11'),
(37, 0, 'withdraw', '100-', '2023-11-19', '1', '2023-11-19 13:14:37'),
(38, 1, 'withdraw', '100-', '2023-11-19', '1', '2023-11-19 13:18:55'),
(39, 2, 'withdraw', '100-', '2023-11-19', '1', '2023-11-19 13:20:18'),
(40, 1, 'withdraw', '200-', '2023-11-19', '1', '2023-11-19 13:35:50'),
(41, 1, 'deposit', '100+', '2023-11-20', '1', '2023-11-19 23:49:25'),
(42, 1, 'deposit', '5000+', '2023-11-20', '1', '2023-11-20 04:25:21'),
(43, 1, 'deposit', '1000+', '2023-11-20', '1', '2023-11-20 04:29:39'),
(44, 1, 'deposit', '1000', '2023-11-20', '1', '2023-11-20 04:32:09'),
(45, 1, 'deposit', '1000+', '2023-11-20', '1', '2023-11-20 04:34:37'),
(46, 1, 'deposit', '1000+', '2023-11-20', '1', '2023-11-20 04:34:54'),
(47, 1, 'deposit', '1000+', '2023-11-20', '1', '2023-11-20 04:37:32'),
(48, 2, 'deposit', '1000+', '2023-11-20', '1', '2023-11-20 04:43:47'),
(49, 2, 'deposit', '1000+', '2023-11-20', '1', '2023-11-20 04:45:39'),
(50, 2, 'deposit', '100', '2023-11-20', '1', '2023-11-20 04:53:24'),
(51, 2, 'withdraw', '100-', '2023-11-20', '1', '2023-11-20 04:54:37'),
(52, 2, 'withdraw', '100-', '2023-11-20', '1', '2023-11-20 05:03:10'),
(53, 2, 'withdraw', '100-', '2023-11-20', '1', '2023-11-20 05:04:26'),
(55, 1, 'withdraw', '100-', '2023-11-20', '1', '2023-11-20 13:23:30'),
(56, 1, 'withdraw', '100-', '2023-11-20', '1', '2023-11-20 13:24:05'),
(57, 1, 'withdraw', '100-', '2023-11-20', '1', '2023-11-20 13:24:31'),
(60, 2, 'withdraw', '100-', '2023-11-20', '1', '2023-11-20 14:03:29'),
(61, 2, 'deposit', '10000', '2023-11-20', '1', '2023-11-20 14:06:16'),
(62, 1, 'deposit', '1000+', '2023-11-21', '1', '2023-11-21 00:27:37'),
(63, 1, 'deposit', '5000+', '2023-11-21', '1', '2023-11-21 00:33:19'),
(64, 1, 'withdraw', '1000-', '2023-11-21', '1', '2023-11-21 00:35:11'),
(65, 2, 'deposit', '100+', '2023-11-21', '1', '2023-11-21 02:56:50'),
(66, 2, 'deposit', '1000+', '2023-11-21', '1', '2023-11-21 02:57:20'),
(67, 2, 'withdraw', '100-', '2023-11-21', '1', '2023-11-21 02:57:54'),
(68, 2, 'deposit', '100+', '2023-11-21', '1', '2023-11-21 03:02:51'),
(69, 1, 'deposit', '1000+', '2023-11-22', '1', '2023-11-22 04:45:24'),
(70, 1, 'withdraw', '1000-', '2023-11-22', '1', '2023-11-22 04:46:19'),
(71, 1, 'withdraw', '1000-', '2023-11-22', '1', '2023-11-22 04:48:46'),
(72, 1, 'withdraw', '1000-', '2023-11-22', '1', '2023-11-22 04:56:17'),
(73, 1, 'withdraw', '100-', '2023-11-22', '1', '2023-11-22 06:04:43'),
(74, 2, 'withdraw', '100-', '2023-11-23', '1', '2023-11-23 04:08:20'),
(75, 1, 'deposit', '1000+', '2023-11-23', '1', '2023-11-23 15:15:07'),
(76, 1, 'withdraw', '10000-', '2023-11-23', '1', '2023-11-23 15:15:41'),
(77, 1, 'withdraw', '100-', '2023-11-27', '1', '2023-11-27 15:50:48'),
(78, 1, 'deposit', '500+', '2023-11-27', '1', '2023-11-27 15:51:28');

-- --------------------------------------------------------

--
-- Table structure for table `users_table`
--

CREATE TABLE `users_table` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `phonenumber` varchar(30) DEFAULT NULL,
  `gender` enum('male','female','others') DEFAULT NULL,
  `email_id` varchar(30) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password_` mediumtext DEFAULT NULL,
  `account_number` varchar(30) DEFAULT NULL,
  `atm_pin` varchar(10) DEFAULT NULL,
  `account_blnc` varchar(50) DEFAULT NULL,
  `status_` enum('0','1') DEFAULT '1',
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_table`
--

INSERT INTO `users_table` (`user_id`, `first_name`, `last_name`, `date_of_birth`, `phonenumber`, `gender`, `email_id`, `username`, `password_`, `account_number`, `atm_pin`, `account_blnc`, `status_`, `time_stamp`) VALUES
(1, 'pavan', 'kumar', '2001-12-09', '9652824471', 'male', 'pavankumar@gmail.com', 'pavankumar', '6c350ae1dd6e057d4231788fe56d6796', '7453085102', '0000', '163000', '1', '2023-11-17 13:47:30'),
(2, 'mohan', 'kumar', '1999-06-19', '7661084369', 'male', 'mohankumar@gmail.com', 'mohankumar', '1a9d3f3a4b6de5fc66dc3e66d3f4ad2c', '4694404690', '0000', '62400', '1', '2023-11-19 00:14:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atm_manchine`
--
ALTER TABLE `atm_manchine`
  ADD PRIMARY KEY (`atm_id`);

--
-- Indexes for table `atm_transactions`
--
ALTER TABLE `atm_transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atm_manchine`
--
ALTER TABLE `atm_manchine`
  MODIFY `atm_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `atm_transactions`
--
ALTER TABLE `atm_transactions`
  MODIFY `transaction_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `users_table`
--
ALTER TABLE `users_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

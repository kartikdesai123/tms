-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2018 at 05:08 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tms`
--

-- --------------------------------------------------------

--
-- Table structure for table `timesheet`
--

CREATE TABLE `timesheet` (
  `id` int(255) NOT NULL,
  `worker_id` int(255) NOT NULL,
  `c_date` date DEFAULT NULL,
  `workplaces` varchar(255) DEFAULT NULL,
  `start_time` varchar(255) DEFAULT NULL,
  `end_time` varchar(255) DEFAULT NULL,
  `pause_time` varchar(255) DEFAULT NULL,
  `total_time` varchar(255) DEFAULT NULL,
  `missing_hour` varchar(255) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timesheet`
--

INSERT INTO `timesheet` (`id`, `worker_id`, `c_date`, `workplaces`, `start_time`, `end_time`, `pause_time`, `total_time`, `missing_hour`, `reason`, `created_at`, `updated_at`) VALUES
(1, 12, '2018-08-29', 'Reliance Industries', '10:00', '18:00', '01:00', '8:00', '1:00', NULL, '2018-08-29 07:00:57', '2018-08-29 07:00:57'),
(2, 2, '2018-08-24', 'Reliance Industries', '10:00:00', '18:00:00', '00:15:00', '04:15:00', '12:15:00', NULL, '2018-08-29 06:36:51', '2018-08-24 01:01:54'),
(11, 11, '2018-08-29', 'Reliance Industries', '10:00:00', '19:00:00', '01:00:00', '09:00:00', '00:00:00', NULL, '2018-08-29 01:11:12', '2018-08-29 01:11:12'),
(12, 3, '2018-08-29', 'Reliance Industries', '10:00:00', '18:00:00', '01:00:00', '08:00:00', '01:00:00', NULL, '2018-08-29 01:18:31', '2018-08-29 01:18:31'),
(13, 3, '2018-08-30', 'other', '10:00', '18:00', '01:00', '8:00', '1:00', 'Going To Other Workplaces', '2018-08-30 04:08:14', '2018-08-30 04:08:14'),
(14, 2, '2018-08-30', 'Oil and Natural Gas Corporation', '10:00', '18:00', '01:00', '8:00', '1:00', NULL, '2018-08-30 04:20:37', '2018-08-30 04:20:37'),
(18, 2, '2018-09-06', 'other', '10:00', '19:00', '01:00', '9:00', '0:00', 'going to birth party', '2018-09-06 01:50:52', '2018-09-06 01:50:52'),
(19, 2, '2018-09-06', 'other', '10:00', '19:00', '01:00', '9:00', '0:00', NULL, '2018-09-06 01:56:19', '2018-09-06 01:56:19'),
(20, 3, '2018-09-06', 'other', '10:00', '19:00', '01:00', '9:00', '0:00', 'going to birth party', '2018-09-06 03:54:08', '2018-09-06 03:54:08'),
(21, 11, '2018-09-06', 'other', '09:00', '18:00', '01:00', '9:00', '0:00', 'Going To Other Workplaces', '2018-09-06 06:48:48', '2018-09-06 06:48:48'),
(22, 2, '2018-09-07', 'other', '10:00', '18:00', '01:00', '8:00', '1:00', 'Going To Other Workplaces', '2018-09-06 23:54:38', '2018-09-06 23:54:38'),
(23, 2, '2018-09-07', 'other', '10:00', '19:00', '01:00', '9:00', '0:00', NULL, '2018-09-07 00:41:25', '2018-09-07 00:41:25'),
(24, 2, '2018-09-10', 'other', '10:00', '18:00', '01:00', '8:00', '1:00', 'going to birth party', '2018-09-10 01:39:14', '2018-09-10 01:39:14'),
(25, 2, '2018-09-10', 'Reliance Industries', '10:00', '19:00', '01:00', '9:00', '0:00', 'Going To Other Workplaces', '2018-09-10 01:40:09', '2018-09-10 01:40:09'),
(26, 2, '2018-09-10', 'Reliance Industries', '10:00', '19:00', '01:00', '9:00', '0:00', 'Going To Other Workplaces', '2018-09-10 01:41:38', '2018-09-10 01:41:38'),
(27, 14, '2018-09-10', 'other', '10:00', '19:00', '01:00', '9:00', '0:00', NULL, '2018-09-10 06:09:55', '2018-09-10 06:09:55'),
(28, 11, '2018-09-10', 'other', '10:00', '19:00', '01:00', '9:00', '0:00', NULL, '2018-09-10 06:18:22', '2018-09-10 06:18:22'),
(29, 3, '2018-09-10', 'other', '10:00', '19:00', '01:00', '9:00', '0:00', NULL, '2018-09-10 06:18:50', '2018-09-10 06:18:50'),
(30, 15, '2018-09-11', 'other', '10:00', '17:00', '01:00', '7:00', '2:00', 'going to birth party', '2018-09-11 10:04:10', '2018-09-11 10:04:10'),
(31, 15, '2018-09-11', 'Elsoner Pvt Ltd', '09:00', '19:00', '01:00', '10:00', '1:00', 'Going To Other Workplaces', '2018-09-11 04:44:16', '2018-09-11 04:44:16'),
(32, 3, '2018-09-11', 'other', '10:00', '19:00', '01:00', '9:00', '0:00', 'going to birth party', '2018-09-11 04:47:29', '2018-09-11 04:47:29'),
(33, 3, '2018-09-11', 'other', '09:00', '19:00', '01:00', '10:00', '1:00', NULL, '2018-09-11 04:48:09', '2018-09-11 04:48:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `staffnumber` int(255) NOT NULL DEFAULT '1000',
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('ADMIN','SUPERVISOR','WORKER') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'WORKER' COMMENT '''0'' => ''WORKER'', ''1'' => ''SUPERVISOR'', ''2'' => ''Admin''',
  `workplaces` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `customer_number` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `staffnumber`, `password`, `type`, `workplaces`, `remember_token`, `created_at`, `updated_at`, `customer_number`) VALUES
(1, 'Mayank', 'Patel', 1001, '$2y$12$SVnRH9z4fFbwGVAslC0umeId8nm6GeG2sitYuYn.cSAJ2REvv3z8G', 'ADMIN', '', '59pvNaXBRK1MGn50CW6dO5WimyfSqYHOVFDcBC3ymRyZTKezzoXoks4dLdF1', '2018-08-23 01:36:32', '2018-08-23 01:36:32', 0),
(2, 'Pratik', 'Shahd', 1002, '$2y$12$SVnRH9z4fFbwGVAslC0umeId8nm6GeG2sitYuYn.cSAJ2REvv3z8G', 'WORKER', 'Reliance Industries', 'FQmfiXESYO0qW2k7h4F6hgXIew8CJAojmMJofJygEW6xhQhQGmYt2zkRSFfb', '2018-09-11 04:24:50', '2018-09-11 04:24:50', 0),
(3, 'bhagyesh', 'chavda', 1003, '$2y$10$0Sj6mD6nSbHde13MFk1iIu4qR6SFsbH.W4a2k8mnyKI15x7Qnrawm', 'SUPERVISOR', 'Tata Consultancy Services,Oil and Natural Gas Corporation,Sun Pharmaceutical Industries Ltd', 'AdYjWV9fH9h35qbBeotapd2ImE5w67eG0hMXBafiDP79V5hqATl8nqVA6epS', '2018-09-11 04:40:41', '2018-09-11 04:40:41', 0),
(11, 'nimesh', 'Patel', 1004, '$2y$10$x4CwwJf2c940UzkSK.FBG.r277Uf8NzYa1NRkPxE2X8/qawkVe23.', 'WORKER', 'Reliance Industries,HDFC Bank', 'C3Pa3NGGSCdDAFFqjHIvLXK0d97bECP2ORN8leNPhbL6EtmD5PpDe7dY6joe', '2018-09-11 04:40:07', '2018-09-11 04:40:07', 0),
(12, 'mayuri', 'patel', 1005, '$2y$10$j3yLR6ANHUJRuKMe6VatS.O7mbr7Bw/Y/s8GOLF0g3KENPEFdBCN.', 'WORKER', 'HDFC Bank,Elsoner Pvt Ltd', 'uHp8bh9I7ZzIOibrSVKxG6zrY1RZK8fcGRiMFamsX3CHOx0PFwAgmwRj6RgD', '2018-09-11 04:40:19', '2018-09-11 04:40:19', 0),
(13, 'mithilesh', 'patel', 1006, '$2y$10$zmvEdMCxYCouAqPUoVng8.DQ4Gjzzw6PviG0k88EfJYcNq/4DeBr.', 'WORKER', '', 'GgmT5StRF176AdHRCjtwkpFLdDAnmpeH8UzNxLrVpNlfEVw8ZuJU0utshNUr', '2018-08-31 03:54:15', '2018-08-31 03:54:15', 0),
(14, 'mehul', 'patel', 1007, '$2y$10$f8pMNe5FxSNtx/mblQ7mPudxN8Fk9n8/9N2hUbYLh3antCPJyxwgW', 'WORKER', 'Elsoner Pvt Ltd', 'e1Q12qrhuRcFzYIl0ke8Cz9IicSXmxQ5A2bm58TokBdgOEtF9fRpx3enBQ5l', '2018-09-11 04:39:48', '2018-09-11 04:39:48', 0),
(15, 'Ravi', 'Shah', 1008, '$2y$10$5YEb7x1j0FG/5wW9cVAIfuAgW5uKeIjrt1OB6aqWbwn3rclmyjp6S', 'WORKER', 'Tata Consultancy Services,Reliance Industries,Oil and Natural Gas Corporation,HDFC Bank,Sun Pharmaceutical Industries Ltd,Elsoner Pvt Ltd', 'wHreUFObs48hewQBdimxudJEBemUEouacStZW7yC0OT9nFRGpIJM5hDREind', '2018-09-11 05:13:47', '2018-09-11 05:13:47', 0);

-- --------------------------------------------------------

--
-- Table structure for table `workplaces`
--

CREATE TABLE `workplaces` (
  `id` int(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `adresses` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workplaces`
--

INSERT INTO `workplaces` (`id`, `company`, `adresses`) VALUES
(16, 'Tata Consultancy Services', 'Garima Park, DA IICT Road, Gandhinagar, Gujarat 382421'),
(17, 'Reliance Industries', 'Corporate office. Reliance Industries Limited Maker Chambers - IV Nariman Point Mumbai 400 021, India'),
(18, 'Oil and Natural Gas Corporation', '701 - Parshwanath ESquare, Corporate Road, Prahladnagar, Satellite, Ahmedabad, Gujarat 380015'),
(19, 'HDFC Bank', 'Senapati Bapat Marg, Lower Parel, Mumbai - 400 013'),
(20, 'Sun Pharmaceutical Industries Ltd', 'Sun Pharmacy, Surendra Mangaldas Road, Bimanagar, Satellite, Amdavad, Gujarat, India'),
(21, 'Elsoner Pvt Ltd', 'Amhedabad');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `timesheet`
--
ALTER TABLE `timesheet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staffnumber` (`staffnumber`);

--
-- Indexes for table `workplaces`
--
ALTER TABLE `workplaces`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `timesheet`
--
ALTER TABLE `timesheet`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `workplaces`
--
ALTER TABLE `workplaces`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

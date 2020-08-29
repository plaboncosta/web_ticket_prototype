-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2020 at 06:12 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_ticket_demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `ticket_search`
--

CREATE TABLE `ticket_search` (
  `id` int(11) NOT NULL,
  `departure` varchar(63) DEFAULT NULL,
  `arrival` varchar(63) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `class` varchar(63) DEFAULT NULL,
  `passenger_no` varchar(11) DEFAULT NULL,
  `child_no` varchar(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket_search`
--

INSERT INTO `ticket_search` (`id`, `departure`, `arrival`, `date`, `class`, `passenger_no`, `child_no`, `created_at`, `updated_at`) VALUES
(7, 'Dhaka', 'Khulna', '2020-09-04', 'S_CHAIR', '01', '', '2020-08-29 05:22:28', '2020-08-29 05:42:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(63) DEFAULT NULL,
  `last_name` varchar(63) DEFAULT NULL,
  `email` varchar(63) DEFAULT NULL,
  `national_id` varchar(23) DEFAULT NULL,
  `password` varchar(63) DEFAULT NULL,
  `phone_number` varchar(17) DEFAULT NULL,
  `terms_of_service` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `national_id`, `password`, `phone_number`, `terms_of_service`, `created_at`) VALUES
(3, 'Plabon', 'Costa', 'plabon@pentabd.com', '03950648069809468', '123456', '01792839480', 1, '2020-08-29 05:06:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ticket_search`
--
ALTER TABLE `ticket_search`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ticket_search`
--
ALTER TABLE `ticket_search`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

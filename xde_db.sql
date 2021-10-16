-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2021 at 04:41 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xde_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `xde_table`
--

CREATE TABLE `xde_table` (
  `xde_id` int(11) NOT NULL,
  `client` varchar(50) DEFAULT NULL,
  `tracking _number` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `payment_type` varchar(20) DEFAULT NULL,
  `total_price` double DEFAULT NULL,
  `declared_value` double DEFAULT NULL,
  `package_length` double DEFAULT NULL,
  `package_width` double DEFAULT NULL,
  `package_height` double DEFAULT NULL,
  `package_weight` double DEFAULT NULL,
  `shipping_type` varchar(50) DEFAULT NULL,
  `first_attempt_status` varchar(50) DEFAULT NULL,
  `first_attempt_date` datetime DEFAULT NULL,
  `first_attempt_description` varchar(100) DEFAULT NULL,
  `second_attempt_description` varchar(100) DEFAULT NULL,
  `third_attempt_description` varchar(100) DEFAULT NULL,
  `transfer_date` datetime DEFAULT NULL,
  `last_status_date` datetime DEFAULT NULL,
  `picked_date` datetime DEFAULT NULL,
  `last_delivery_date` datetime DEFAULT NULL,
  `handover_date` datetime DEFAULT NULL,
  `location` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `consignee_province` varchar(50) DEFAULT NULL,
  `consignee_city` varchar(50) DEFAULT NULL,
  `consignee_barangay` varchar(50) DEFAULT NULL,
  `port` varchar(50) DEFAULT NULL,
  `area` varchar(20) DEFAULT NULL,
  `area2` varchar(20) DEFAULT NULL,
  `lh` int(11) DEFAULT NULL,
  `sla` double DEFAULT NULL,
  `plus_sla` double DEFAULT NULL,
  `total_sla` double DEFAULT NULL,
  `volume` int(11) DEFAULT NULL,
  `delivered` int(11) DEFAULT NULL,
  `lt` double DEFAULT NULL,
  `otp` int(11) DEFAULT NULL,
  `first_attempt_within_lt` int(11) DEFAULT NULL,
  `first_attempt_dispatch_vol` int(11) DEFAULT NULL,
  `transfer` int(11) DEFAULT NULL,
  `fd` int(11) DEFAULT NULL,
  `fd_reason` text DEFAULT NULL,
  `open` int(11) DEFAULT NULL,
  `claims` int(11) DEFAULT NULL,
  `pickup_to_ho_lt` double DEFAULT NULL,
  `lh_lt` double DEFAULT NULL,
  `lm_dispatch_lt` double DEFAULT NULL,
  `week_no` varchar(20) DEFAULT NULL,
  `handover_date2` date DEFAULT NULL,
  `month` varchar(20) DEFAULT NULL,
  `year` varchar(20) DEFAULT NULL,
  `m_and_y` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `xde_table`
--
ALTER TABLE `xde_table`
  ADD PRIMARY KEY (`xde_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `xde_table`
--
ALTER TABLE `xde_table`
  MODIFY `xde_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

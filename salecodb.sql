-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2025 at 02:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salecodb`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cus_code` int(11) NOT NULL,
  `cus_lname` varchar(15) DEFAULT NULL,
  `cus_fname` varchar(15) DEFAULT NULL,
  `cus_initial` varchar(1) DEFAULT NULL,
  `cus_areacode` varchar(3) DEFAULT NULL,
  `cus_phone` varchar(8) DEFAULT NULL,
  `cus_balance` double DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cus_code`, `cus_lname`, `cus_fname`, `cus_initial`, `cus_areacode`, `cus_phone`, `cus_balance`) VALUES
(10010, 'Ramas', 'Alfred', 'A', '615', '844-2573', 0),
(10011, 'Dunne', 'Leona', 'K', '713', '894-1238', 0),
(10012, 'Smith', 'Kathy', 'W', '615', '894-2285', 345.86),
(10013, 'Olowski', 'Paul', 'F', '615', '894-2180', 536.75),
(10014, 'Orlando', 'Myron', NULL, '615', '222-1672', 0),
(10015, 'O\'Brian', 'Amy', 'B', '713', '442-3381', 0),
(10016, 'Brown', 'James', 'G', '615', '297-1228', 221.19),
(10017, 'Williams', 'George', NULL, '615', '290-2556', 768.93),
(10018, 'Farriss', 'Anne', 'G', '713', '382-7185', 216.55);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `inv_number` int(11) NOT NULL,
  `cus_code` int(11) DEFAULT 0,
  `inv_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `inv_subtotal` double DEFAULT 0,
  `inv_tax` double DEFAULT 0,
  `inv_total` double DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`inv_number`, `cus_code`, `inv_date`, `inv_subtotal`, `inv_tax`, `inv_total`) VALUES
(1001, 10014, '2008-01-15 16:00:00', 24.9, 1.99, 26.89),
(1002, 10011, '2008-01-15 16:00:00', 9.98, 0.8, 10.78),
(1003, 10012, '2008-01-15 16:00:00', 153.85, 12.31, 166.16),
(1004, 10011, '2008-01-16 16:00:00', 34.97, 2.8, 37.77),
(1005, 10018, '2008-01-16 16:00:00', 70.44, 5.64, 76.08),
(1006, 10014, '2008-01-16 16:00:00', 397.83, 31.83, 429.66),
(1007, 10015, '2008-01-16 16:00:00', 34.97, 2.8, 37.77),
(1008, 10011, '2008-01-16 16:00:00', 399.15, 31.93, 431.08);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `p_code` int(11) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `p_vendor` int(11) NOT NULL,
  `p_descript` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `p_qoh` int(11) NOT NULL,
  `p_price` decimal(10,0) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`p_code`, `p_name`, `p_vendor`, `p_descript`, `p_qoh`, `p_price`, `created_at`) VALUES
(6790, 'test', 10000, 'Test', 0, 0, '2025-12-03 06:31:11'),
(6791, 'test', 10001, 'Test', 12, 300, '2025-12-03 06:31:37'),
(6792, 'test', 10000, 'Test', 12, 455, '2025-12-03 07:30:03');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(11) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `initial` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `last_name`, `first_name`, `initial`, `contact`, `created_at`) VALUES
(10000, 'Smith', 'Mark', 'D', '', '2025-12-03 03:29:17'),
(10001, 'Irving', 'Kevin', 'S', '', '2025-12-03 03:31:03'),
(10002, 'test', 'test', 'test', 'test', '2025-12-03 08:20:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cus_code`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`inv_number`),
  ADD KEY `reference3` (`cus_code`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`p_code`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cus_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10028;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `inv_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1012;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `p_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6797;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10006;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `reference3_cus_code_customer_cus_code` FOREIGN KEY (`cus_code`) REFERENCES `customer` (`cus_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 29, 2023 at 01:12 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rtw_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(50) DEFAULT NULL,
  `customer_email` varchar(100) DEFAULT NULL,
  `customer_phone` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_email`, `customer_phone`, `created_at`, `updated_at`) VALUES
(4, 'q', 'shin@gamil.com', 'nona', NULL, NULL),
(5, 'shintaro', 'shintaro', 'shintoa', NULL, NULL),
(7, 'richie', 'rich@gmail.com', '1234', NULL, NULL),
(9, 'dodongrhey', 'dodong@gmail.com', '0987654', NULL, NULL),
(12, 'test pink', 'test@gmail.com', '2222', NULL, NULL),
(13, 'mar', 'mar@gmail.com', '09556246754', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shoporder`
--

CREATE TABLE `shoporder` (
  `order_id` int(11) NOT NULL,
  `customer_name` varchar(50) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `stocks_id` int(20) DEFAULT NULL,
  `product_name` varchar(50) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shoporder`
--

INSERT INTO `shoporder` (`order_id`, `customer_name`, `customer_id`, `stocks_id`, `product_name`, `quantity`, `order_date`, `created_at`, `updated_at`) VALUES
(19, 'dodongrhey', 9, NULL, 'Bag', 1, '2023-06-29', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `stocks_id` int(20) NOT NULL,
  `stock_name` varchar(50) DEFAULT NULL,
  `stock_price` int(20) DEFAULT NULL,
  `stock_retail` int(20) DEFAULT NULL,
  `stock_quantity` int(20) DEFAULT NULL,
  `stock_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`stocks_id`, `stock_name`, `stock_price`, `stock_retail`, `stock_quantity`, `stock_date`) VALUES
(3, 'Bag', 300, 500, 90, '2023-06-28'),
(4, 'Box', 10, 15, 100, '2023-06-12'),
(6, 'charger', 100, 150, 193, '2023-06-13'),
(8, 'paper', 50, 60, 300, '2023-06-13');

-- --------------------------------------------------------

--
-- Table structure for table `transaction1`
--

CREATE TABLE `transaction1` (
  `transaction_Id` int(20) NOT NULL,
  `order_id` int(10) NOT NULL,
  `customer_id` int(20) DEFAULT NULL,
  `product_name` varchar(20) NOT NULL,
  `stock_price` int(30) NOT NULL,
  `retail` int(30) NOT NULL,
  `quantity` int(30) NOT NULL,
  `profit` int(30) NOT NULL,
  `customer_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction1`
--

INSERT INTO `transaction1` (`transaction_Id`, `order_id`, `customer_id`, `product_name`, `stock_price`, `retail`, `quantity`, `profit`, `customer_name`) VALUES
(13, 12, NULL, 'Bag', 300, 500, 10, 2000, 'rheymar'),
(14, 17, NULL, 'Bag', 300, 500, 9, 1800, 'rheymar'),
(15, 20, NULL, 'charger', 100, 150, 5, 250, 'dodongrhey'),
(19, 23, NULL, 'charger', 100, 150, 2, 100, 'mar');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `shoporder`
--
ALTER TABLE `shoporder`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `stocks_id` (`stocks_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`stocks_id`);

--
-- Indexes for table `transaction1`
--
ALTER TABLE `transaction1`
  ADD PRIMARY KEY (`transaction_Id`),
  ADD UNIQUE KEY `order_id` (`order_id`),
  ADD UNIQUE KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `shoporder`
--
ALTER TABLE `shoporder`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `stocks_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transaction1`
--
ALTER TABLE `transaction1`
  MODIFY `transaction_Id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `shoporder`
--
ALTER TABLE `shoporder`
  ADD CONSTRAINT `shoporder_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `shoporder_ibfk_3` FOREIGN KEY (`stocks_id`) REFERENCES `stocks` (`stocks_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `transaction1`
--
ALTER TABLE `transaction1`
  ADD CONSTRAINT `transaction1_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

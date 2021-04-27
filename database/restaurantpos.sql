-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2021 at 01:03 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurantpos`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_table`
--

CREATE TABLE `booking_table` (
  `id` int(11) NOT NULL,
  `shape` varchar(255) NOT NULL,
  `person` int(11) NOT NULL,
  `status` int(3) DEFAULT NULL,
  `table_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking_table`
--

INSERT INTO `booking_table` (`id`, `shape`, `person`, `status`, `table_number`) VALUES
(2, 'Square', 7, 1, 2),
(3, 'Round', 4, 0, 3),
(4, 'Square', 2, 0, 4),
(5, 'Round', 3, 1, 5),
(6, 'Square', 3, 0, 9);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`) VALUES
(1, 'Fixed Menu'),
(2, 'Hearty Soups');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `id` int(11) NOT NULL,
  `customer` varchar(255) NOT NULL,
  `item_id` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `payment_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`id`, `customer`, `item_id`, `qty`, `address`, `payment_id`) VALUES
(4, 'test', '1', '3', 'test', 9);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `item`, `price`, `category_id`) VALUES
(1, 'Shahi Taj', 30, 1),
(4, 'Taj Special', 27, 1),
(6, 'Taj Non Vegetarian', 22, 1),
(7, 'Taj vegetarian', 21, 1),
(8, 'Muligatawny Soup', 3.7, 2),
(9, 'Madras Soup', 3.7, 2),
(11, 'Dal Soup', 3.7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `price` float NOT NULL,
  `tax` float NOT NULL,
  `status` int(3) NOT NULL,
  `date` date NOT NULL,
  `notes` text NOT NULL,
  `total_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `price`, `tax`, `status`, `date`, `notes`, `total_price`) VALUES
(2, 52, 4.68, 1, '2020-10-06', 'testing', 56.68),
(3, 43, 3.87, 1, '2020-10-06', 'testin', 46.87),
(4, 63.7, 5.73, 1, '2020-10-06', 'test', 69.45),
(5, 30, 2.7, 1, '2020-10-12', 'testinggggg', 32.7),
(7, 63.7, 5.73, 2, '2020-10-06', 'test', 69.43),
(8, 63.7, 5.73, 2, '2020-10-12', 'testtting', 69.43),
(9, 90, 8.1, 3, '2020-10-12', 'testtttt', 98.1);

-- --------------------------------------------------------

--
-- Table structure for table `place_order`
--

CREATE TABLE `place_order` (
  `id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `item_id` varchar(255) NOT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `place_order`
--

INSERT INTO `place_order` (`id`, `table_id`, `item_id`, `qty`, `payment_id`) VALUES
(15, 2, '1', '1', 2),
(16, 2, '6', '1', 2),
(17, 6, '6', '1', 3),
(18, 6, '7', '1', 3),
(19, 3, '1', '2', 4),
(20, 3, '11', '1', 4),
(33, 5, '1', '1', 5);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `table_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `customer_name`, `date`, `time`, `table_id`) VALUES
(4, 'test', '2020-09-11', '23:58:00', 5);

-- --------------------------------------------------------

--
-- Table structure for table `takeaway`
--

CREATE TABLE `takeaway` (
  `id` int(11) NOT NULL,
  `customer` varchar(255) NOT NULL,
  `item_id` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `payment_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `takeaway`
--

INSERT INTO `takeaway` (`id`, `customer`, `item_id`, `qty`, `payment_id`) VALUES
(2, 'test', '1', '2', 7),
(3, 'test', '8', '1', 7),
(6, 'Salman', '1', '2', 8),
(7, 'Salman', '9', '1', 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'Admin', 'admin@admin.com', 'admin123', 1),
(3, 'Jack', 'jack@gmail.com', 'jack123', 2),
(4, 'Smith', 'smith@gmail.com', 'smith123', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_table`
--
ALTER TABLE `booking_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `place_order`
--
ALTER TABLE `place_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `takeaway`
--
ALTER TABLE `takeaway`
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
-- AUTO_INCREMENT for table `booking_table`
--
ALTER TABLE `booking_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `place_order`
--
ALTER TABLE `place_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `takeaway`
--
ALTER TABLE `takeaway`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

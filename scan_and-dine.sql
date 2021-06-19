-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2021 at 09:15 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scan_and-dine`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_phonenum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`, `admin_phonenum`) VALUES
(4, 'merlyn', 'mer@gmail.com', '1adba86c435b5fe0f7ea043370b1636b', 123456780),
(8, 'stella', 'stella@gmail.com', '172522ec1028ab781d9dfd17eaca4427', 1234567890),
(9, 'david', 'davidsamuel@gmail.com', '430244540aa38ff181545cb0d539f038', 1234567890),
(10, 'test', 'test@gmail.com', 'cc03e747a6afbbcbf8be7668acfebee5', 1234567890),
(11, 'egivenia', 'egiveniasukhwir@gmail.com', 'b2f7d28f741d8a6094cec4a68213375b', 987654321),
(12, 'jane', 'jane@gmail.com', '5844a15e76563fedd11840fd6f40ea7b', 1234567890);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_image_name` varchar(255) NOT NULL,
  `category_featured` varchar(10) NOT NULL,
  `category_active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`, `category_image_name`, `category_featured`, `category_active`) VALUES
(5, 'Pizza', 'food_category_157.jpg', 'Yes', 'Yes'),
(6, 'Momo', 'food_category_278.jpg', 'Yes', 'Yes'),
(8, 'Burger', 'food_category_376.jpg', 'Yes', 'Yes'),
(9, 'Sandwich', 'food_category_925.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `menu_id` int(11) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `menu_description` varchar(255) NOT NULL,
  `menu_price` decimal(10,2) NOT NULL,
  `menu_image_name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `menu_featured` varchar(10) NOT NULL,
  `menu_active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`menu_id`, `menu_name`, `menu_description`, `menu_price`, `menu_image_name`, `category_id`, `menu_featured`, `menu_active`) VALUES
(18, 'cheese burger', 'delicious fresh burger', '5.00', 'food_menu_7591.jpg', 9, 'Yes', 'Yes'),
(19, 'Dumplings', 'Steamy delicious dumplings freshly made', '3.00', 'food_menu_2984.jpg', 6, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reservation`
--

CREATE TABLE `tbl_reservation` (
  `reservation_id` int(11) NOT NULL,
  `reservation_date` date NOT NULL,
  `reservation_time` time NOT NULL,
  `reservation_table` int(11) NOT NULL,
  `reservation_code` int(11) NOT NULL,
  `reservation_user_id` int(11) NOT NULL,
  `reservation_name` varchar(255) NOT NULL,
  `reservation_phonenum` int(11) NOT NULL,
  `reservation_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_reservation`
--

INSERT INTO `tbl_reservation` (`reservation_id`, `reservation_date`, `reservation_time`, `reservation_table`, `reservation_code`, `reservation_user_id`, `reservation_name`, `reservation_phonenum`, `reservation_status`) VALUES
(23, '2021-06-19', '11:10:00', 2, 9357, 1, 'john doe', 875484933, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_table`
--

CREATE TABLE `tbl_table` (
  `table_id` int(11) NOT NULL,
  `table_capacity` int(11) NOT NULL,
  `table_availability` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_table`
--

INSERT INTO `tbl_table` (`table_id`, `table_capacity`, `table_availability`) VALUES
(1, 0, 'Yes'),
(2, 0, 'Yes'),
(3, 0, 'Yes'),
(4, 0, 'Yes'),
(5, 0, 'Yes'),
(6, 0, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction`
--

CREATE TABLE `tbl_transaction` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `transaction_time` time NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `transaction_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transaction`
--

INSERT INTO `tbl_transaction` (`transaction_id`, `user_id`, `transaction_date`, `transaction_time`, `payment_method`, `transaction_status`) VALUES
(24, 1, '2021-06-19', '11:10:00', 'Cash', 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction_det`
--

CREATE TABLE `tbl_transaction_det` (
  `transaction_detail_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transaction_det`
--

INSERT INTO `tbl_transaction_det` (`transaction_detail_id`, `transaction_id`, `menu_id`, `quantity`) VALUES
(18, 24, 18, 1),
(19, 24, 19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_phonenum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_email`, `user_password`, `user_phonenum`) VALUES
(1, 'john doe', 'john@gmail.com', '527bd5b5d689e2c32ae974c6229ff785', 875484933),
(2, 'jane doe', 'jane@gmail.com', '5844a15e76563fedd11840fd6f40ea7b', 2147483647);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `tbl_reservation`
--
ALTER TABLE `tbl_reservation`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Indexes for table `tbl_table`
--
ALTER TABLE `tbl_table`
  ADD PRIMARY KEY (`table_id`);

--
-- Indexes for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `FK_userID` (`user_id`);

--
-- Indexes for table `tbl_transaction_det`
--
ALTER TABLE `tbl_transaction_det`
  ADD PRIMARY KEY (`transaction_detail_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_reservation`
--
ALTER TABLE `tbl_reservation`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_table`
--
ALTER TABLE `tbl_table`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_transaction_det`
--
ALTER TABLE `tbl_transaction_det`
  MODIFY `transaction_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  ADD CONSTRAINT `FK_userID` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

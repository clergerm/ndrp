-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2021 at 03:36 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ndrp`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `acc_id` int(11) NOT NULL,
  `acc_email` varchar(255) NOT NULL,
  `acc_password` varchar(255) NOT NULL,
  `acc_date` date NOT NULL,
  `acc_type` char(15) NOT NULL,
  `acc_status` char(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `assistance_request`
--

CREATE TABLE `assistance_request` (
  `ass_req_id` int(11) NOT NULL,
  `ass_req_date` date NOT NULL,
  `ass_req_status` varchar(25) NOT NULL,
  `ass_req_comment` varchar(700) NOT NULL,
  `cli_id` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `assistance_request_product`
--

CREATE TABLE `assistance_request_product` (
  `ass_req_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `cli_id` int(11) NOT NULL,
  `cli_first_name` varchar(50) NOT NULL,
  `cli_last_name` varchar(50) NOT NULL,
  `cli_address` varchar(255) NOT NULL,
  `cli_city` varchar(50) NOT NULL,
  `cli_state` char(2) NOT NULL,
  `cli_zip_code` varchar(10) NOT NULL,
  `cli_home_phone` varchar(25) NOT NULL,
  `cli_cell_phone` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(11) NOT NULL,
  `emp_first_name` varchar(50) NOT NULL,
  `emp_last_name` varchar(50) NOT NULL,
  `emp_address` varchar(255) NOT NULL,
  `emp_city` varchar(50) NOT NULL,
  `emp_state` char(2) NOT NULL,
  `emp_zip_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prod_id` int(11) NOT NULL,
  `prod_name` varchar(160) NOT NULL,
  `prod_desc` varchar(700) NOT NULL,
  `prod_type` varchar(7) NOT NULL,
  `prod_status` varchar(8) NOT NULL,
  `prod_price` decimal(6,2) NOT NULL,
  `prod_date` date NOT NULL,
  `cat_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_goods`
--

CREATE TABLE `product_goods` (
  `prod_goods_id` int(11) NOT NULL,
  `prod_goods_qty_in_stock` smallint(6) NOT NULL,
  `prod_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `assistance_request`
--
ALTER TABLE `assistance_request`
  ADD PRIMARY KEY (`ass_req_id`),
  ADD KEY `cli_id` (`cli_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `assistance_request_product`
--
ALTER TABLE `assistance_request_product`
  ADD PRIMARY KEY (`ass_req_id`,`prod_id`),
  ADD KEY `ass_req_id` (`ass_req_id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`cli_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prod_id`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `product_goods`
--
ALTER TABLE `product_goods`
  ADD PRIMARY KEY (`prod_goods_id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assistance_request`
--
ALTER TABLE `assistance_request`
  MODIFY `ass_req_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_goods`
--
ALTER TABLE `product_goods`
  MODIFY `prod_goods_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assistance_request`
--
ALTER TABLE `assistance_request`
  ADD CONSTRAINT `fk_ass_req_ref_cli` FOREIGN KEY (`cli_id`) REFERENCES `client` (`cli_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ass_req_ref_emp` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assistance_request_product`
--
ALTER TABLE `assistance_request_product`
  ADD CONSTRAINT `fk_ass_req_prod_ref_ass_req` FOREIGN KEY (`ass_req_id`) REFERENCES `assistance_request` (`ass_req_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ass_req_prod_ref_prod` FOREIGN KEY (`prod_id`) REFERENCES `product` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `fk_cli_ref_acc` FOREIGN KEY (`cli_id`) REFERENCES `account` (`acc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `fk_emp_ref_acc` FOREIGN KEY (`emp_id`) REFERENCES `account` (`acc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_prod_ref_cat` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_prod_ref_emp` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_goods`
--
ALTER TABLE `product_goods`
  ADD CONSTRAINT `fk_prod_goods_ref_prod` FOREIGN KEY (`prod_id`) REFERENCES `product` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

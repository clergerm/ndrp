-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2021 at 05:11 PM
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
  `acc_pwd` varchar(255) NOT NULL,
  `acc_date` date NOT NULL,
  `acc_type` char(15) NOT NULL,
  `acc_status` char(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`acc_id`, `acc_email`, `acc_pwd`, `acc_date`, `acc_type`, `acc_status`) VALUES
(1, 'john@gmail.com', '12345678', '2021-02-23', 'Client', 'Active'),
(7, 'clergerm@gmail.com', '12345678', '2021-02-24', 'Employee', 'Active'),
(19, 'mdc@gmail.com', '12345678', '2021-03-08', 'Client', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `assistance_request`
--

CREATE TABLE `assistance_request` (
  `ass_req_id` int(11) NOT NULL,
  `ass_req_date` date NOT NULL,
  `ass_req_status_id` tinyint(4) NOT NULL,
  `ass_req_comment` varchar(700) NOT NULL,
  `cli_id` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assistance_request`
--

INSERT INTO `assistance_request` (`ass_req_id`, `ass_req_date`, `ass_req_status_id`, `ass_req_comment`, `cli_id`, `emp_id`) VALUES
(6, '2021-03-05', 1, 'I want to reuqest 3 T-shirts and 2 bags of rice 25 lbs.                                       ', 1, NULL),
(7, '2021-03-05', 1, 'Request for shelter and money                                         ', 1, NULL),
(8, '2021-03-06', 1, '                                                    ', 1, NULL),
(9, '2021-03-06', 1, 'Would like to get more than one pack.                             ', 1, NULL),
(10, '2021-03-06', 1, 'There more items that I need but you don\'t offer them.                  ', 1, NULL),
(11, '2021-03-08', 1, 'Would like to choose more goods, but some are missing..                           ', 19, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `assistance_request_product`
--

CREATE TABLE `assistance_request_product` (
  `ass_req_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assistance_request_product`
--

INSERT INTO `assistance_request_product` (`ass_req_id`, `prod_id`) VALUES
(6, 7),
(6, 8),
(7, 6),
(7, 9),
(8, 7),
(8, 8),
(8, 9),
(8, 10),
(9, 11),
(10, 11),
(10, 12),
(11, 9),
(11, 10),
(11, 11),
(11, 12),
(11, 13);

-- --------------------------------------------------------

--
-- Table structure for table `assistance_request_status`
--

CREATE TABLE `assistance_request_status` (
  `ass_req_status_id` tinyint(4) NOT NULL,
  `ass_req_status_name` char(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assistance_request_status`
--

INSERT INTO `assistance_request_status` (`ass_req_status_id`, `ass_req_status_name`) VALUES
(1, 'New'),
(2, 'Read'),
(3, 'Accepted'),
(4, 'Rejected'),
(5, 'Processed'),
(6, 'Shipped'),
(7, 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(1, 'Food'),
(2, 'Clothing'),
(3, 'Material'),
(4, 'Shelter'),
(5, 'Money');

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
  `cli_cell_phone` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`cli_id`, `cli_first_name`, `cli_last_name`, `cli_address`, `cli_city`, `cli_state`, `cli_zip_code`, `cli_home_phone`, `cli_cell_phone`) VALUES
(1, 'John', 'Axis', '245 NW 133RD ST', 'North Miami', 'Te', '33168', '(786) 385-5314', '(786) 385-5314'),
(19, 'Capstone', 'Spring 2021', '245 NW 145 ST', 'N Miami', 'FL', '33168', '(786)562-5645', '');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(11) NOT NULL,
  `emp_first_name` varchar(50) NOT NULL,
  `emp_last_name` varchar(50) NOT NULL,
  `emp_home_phone` varchar(25) NOT NULL,
  `emp_cell_phone` varchar(25) NOT NULL,
  `emp_address` varchar(255) NOT NULL,
  `emp_city` varchar(50) NOT NULL,
  `emp_state` char(2) NOT NULL,
  `emp_zip_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `emp_first_name`, `emp_last_name`, `emp_home_phone`, `emp_cell_phone`, `emp_address`, `emp_city`, `emp_state`, `emp_zip_code`) VALUES
(7, 'Martin', 'Clerger', '', '', '124 NW 154 ST', 'NM', 'FL', '33168');

-- --------------------------------------------------------

--
-- Table structure for table `employee_role`
--

CREATE TABLE `employee_role` (
  `emp_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `perm_id` int(11) NOT NULL,
  `perm_name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prod_id` int(11) NOT NULL,
  `prod_name` varchar(160) NOT NULL,
  `prod_desc` varchar(700) NOT NULL,
  `prod_type_id` tinyint(4) NOT NULL,
  `prod_status_id` tinyint(4) NOT NULL,
  `prod_price` decimal(6,2) NOT NULL,
  `prod_date` date NOT NULL,
  `cat_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prod_id`, `prod_name`, `prod_desc`, `prod_type_id`, `prod_status_id`, `prod_price`, `prod_date`, `cat_id`, `emp_id`) VALUES
(6, 'Shelter', 'Shelter is available for familly of any size. Please note that registration is required. To register, please at: (786) 347-5000', 2, 1, '0.00', '2021-03-03', 4, 7),
(7, 'T-shirt', 'T-shirt is simply dummy text of the printing and typesetting industry.', 1, 1, '0.00', '2021-03-04', 2, 7),
(8, 'Bag of rice', '1 bag of rice for everyone', 1, 1, '0.00', '2021-03-04', 1, 7),
(9, 'Money', 'Money desc    u    p', 2, 1, '0.00', '2021-03-04', 5, 7),
(10, 'FlashLight', 'FlashLight needed in case of power outages.   upd', 1, 1, '0.00', '2021-03-06', 3, 7),
(11, 'Water', 'A pack of 24 bottle of water', 1, 1, '0.00', '2021-03-06', 1, 7),
(12, 'Batteries', 'Six AA batteries', 1, 1, '0.00', '2021-03-06', 3, 7),
(13, 'PlyWood', 'Plywoood is important in case their is big wind..', 1, 1, '0.00', '2021-03-08', 3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `product_goods`
--

CREATE TABLE `product_goods` (
  `prod_goods_id` int(11) NOT NULL,
  `prod_goods_qty_in_stock` smallint(6) NOT NULL,
  `prod_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_status`
--

CREATE TABLE `product_status` (
  `prod_status_id` tinyint(4) NOT NULL,
  `prod_status_name` char(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_status`
--

INSERT INTO `product_status` (`prod_status_id`, `prod_status_name`) VALUES
(1, 'Active'),
(2, 'Disable');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `prod_type_id` tinyint(4) NOT NULL,
  `prod_type_name` char(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`prod_type_id`, `prod_type_name`) VALUES
(1, 'Goods'),
(2, 'Service');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` char(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

CREATE TABLE `role_permission` (
  `role_id` int(11) NOT NULL,
  `perm_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `state_id` int(11) NOT NULL,
  `state_name` varchar(32) DEFAULT NULL,
  `state_abbr` char(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `state_name`, `state_abbr`) VALUES
(1, 'Alabama', 'AL'),
(2, 'Alaska', 'AK'),
(3, 'Arizona', 'AZ'),
(4, 'Arkansas', 'AR'),
(5, 'California', 'CA'),
(6, 'Colorado', 'CO'),
(7, 'Connecticut', 'CT'),
(8, 'Delaware', 'DE'),
(9, 'District of Columbia', 'DC'),
(10, 'Florida', 'FL'),
(11, 'Georgia', 'GA'),
(12, 'Hawaii', 'HI'),
(13, 'Idaho', 'ID'),
(14, 'Illinois', 'IL'),
(15, 'Indiana', 'IN'),
(16, 'Iowa', 'IA'),
(17, 'Kansas', 'KS'),
(18, 'Kentucky', 'KY'),
(19, 'Louisiana', 'LA'),
(20, 'Maine', 'ME'),
(21, 'Maryland', 'MD'),
(22, 'Massachusetts', 'MA'),
(23, 'Michigan', 'MI'),
(24, 'Minnesota', 'MN'),
(25, 'Mississippi', 'MS'),
(26, 'Missouri', 'MO'),
(27, 'Montana', 'MT'),
(28, 'Nebraska', 'NE'),
(29, 'Nevada', 'NV'),
(30, 'New Hampshire', 'NH'),
(31, 'New Jersey', 'NJ'),
(32, 'New Mexico', 'NM'),
(33, 'New York', 'NY'),
(34, 'North Carolina', 'NC'),
(35, 'North Dakota', 'ND'),
(36, 'Ohio', 'OH'),
(37, 'Oklahoma', 'OK'),
(38, 'Oregon', 'OR'),
(39, 'Pennsylvania', 'PA'),
(40, 'Rhode Island', 'RI'),
(41, 'South Carolina', 'SC'),
(42, 'South Dakota', 'SD'),
(43, 'Tennessee', 'TN'),
(44, 'Texas', 'TX'),
(45, 'Utah', 'UT'),
(46, 'Vermont', 'VT'),
(47, 'Virginia', 'VA'),
(48, 'Washington', 'WA'),
(49, 'West Virginia', 'WV'),
(50, 'Wisconsin', 'WI'),
(51, 'Wyoming', 'WY');

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
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `ass_req_status_id` (`ass_req_status_id`);

--
-- Indexes for table `assistance_request_product`
--
ALTER TABLE `assistance_request_product`
  ADD PRIMARY KEY (`ass_req_id`,`prod_id`),
  ADD KEY `ass_req_id` (`ass_req_id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- Indexes for table `assistance_request_status`
--
ALTER TABLE `assistance_request_status`
  ADD PRIMARY KEY (`ass_req_status_id`);

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
-- Indexes for table `employee_role`
--
ALTER TABLE `employee_role`
  ADD PRIMARY KEY (`emp_id`,`role_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`perm_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prod_id`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `prod_type_id` (`prod_type_id`),
  ADD KEY `prod_status_id` (`prod_status_id`);

--
-- Indexes for table `product_goods`
--
ALTER TABLE `product_goods`
  ADD PRIMARY KEY (`prod_goods_id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- Indexes for table `product_status`
--
ALTER TABLE `product_status`
  ADD PRIMARY KEY (`prod_status_id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`prod_type_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`role_id`,`perm_id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `perm_id` (`perm_id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`state_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `assistance_request`
--
ALTER TABLE `assistance_request`
  MODIFY `ass_req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `assistance_request_status`
--
ALTER TABLE `assistance_request_status`
  MODIFY `ass_req_status_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `perm_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_goods`
--
ALTER TABLE `product_goods`
  MODIFY `prod_goods_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_status`
--
ALTER TABLE `product_status`
  MODIFY `prod_status_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `prod_type_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assistance_request`
--
ALTER TABLE `assistance_request`
  ADD CONSTRAINT `fk_ass_req_ref_ass_req_status` FOREIGN KEY (`ass_req_status_id`) REFERENCES `assistance_request_status` (`ass_req_status_id`) ON DELETE CASCADE ON UPDATE CASCADE,
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
-- Constraints for table `employee_role`
--
ALTER TABLE `employee_role`
  ADD CONSTRAINT `fk_emp_role_ref_emp` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_emp_role_ref_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_prod_ref_cat` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_prod_ref_emp` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_prod_ref_prod_status` FOREIGN KEY (`prod_status_id`) REFERENCES `product_status` (`prod_status_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_prod_ref_prod_type` FOREIGN KEY (`prod_type_id`) REFERENCES `product_type` (`prod_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_goods`
--
ALTER TABLE `product_goods`
  ADD CONSTRAINT `fk_prod_goods_ref_prod` FOREIGN KEY (`prod_id`) REFERENCES `product` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD CONSTRAINT `fk_role_perm_ref_perm` FOREIGN KEY (`perm_id`) REFERENCES `permission` (`perm_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_role_perm_ref_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

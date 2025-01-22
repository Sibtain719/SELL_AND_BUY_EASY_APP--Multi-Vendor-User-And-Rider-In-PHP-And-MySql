-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2024 at 08:10 PM
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
-- Database: `food_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL,
  `c_name` varchar(50) DEFAULT NULL,
  `picture` varchar(200) DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `createddate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `c_name`, `picture`, `createdby`, `createddate`) VALUES
(1, 'Dal', 'download.jpg', 4, '2024-02-15'),
(2, 'Rice', 'chawal.jpg', 3, '2024-02-15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `id` int(11) NOT NULL,
  `feedback` varchar(5000) NOT NULL,
  `fddate` date NOT NULL,
  `fdtime` time NOT NULL,
  `feedbackby` int(11) NOT NULL,
  `invoice_order` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_items`
--

CREATE TABLE `tbl_items` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `itemname` varchar(50) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `picture` varchar(200) DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `createddate` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_items`
--

INSERT INTO `tbl_items` (`id`, `category_id`, `itemname`, `price`, `qty`, `picture`, `createdby`, `createddate`, `status`) VALUES
(37, 0, 'Apricot', 100, 0, 'apricot.jfif', 1, '2024-09-12', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `orderid` int(11) NOT NULL,
  `orderdate` date DEFAULT NULL,
  `invoice` varchar(100) DEFAULT NULL,
  `paymentmethod` varchar(50) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `cus_lat` varchar(1000) NOT NULL,
  `cus_lng` varchar(1000) NOT NULL,
  `deliver_address` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`orderid`, `orderdate`, `invoice`, `paymentmethod`, `amount`, `status`, `cus_lat`, `cus_lng`, `deliver_address`) VALUES
(10, '2024-09-26', '1001', 'cash', 100, 'In Process', '0', '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orderitems`
--

CREATE TABLE `tbl_orderitems` (
  `orderitemid` int(11) NOT NULL,
  `invoice` varchar(50) DEFAULT NULL,
  `itemid` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `customerid` int(11) DEFAULT NULL,
  `orderitemdate` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `ordergeneratedby` int(11) DEFAULT NULL,
  `ordercreateddate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_orderitems`
--

INSERT INTO `tbl_orderitems` (`orderitemid`, `invoice`, `itemid`, `price`, `qty`, `amount`, `customerid`, `orderitemdate`, `status`, `ordergeneratedby`, `ordercreateddate`) VALUES
(16, '1001', 37, 100, 1, 100, 26, '2024-09-26', 'Ordered', 1, '2024-09-26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ratings`
--

CREATE TABLE `tbl_ratings` (
  `id` int(11) NOT NULL,
  `rating` float NOT NULL,
  `customer_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `created_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_ratings`
--

INSERT INTO `tbl_ratings` (`id`, `rating`, `customer_id`, `shop_id`, `created_date`) VALUES
(1, 3.5, 2, 3, '2024-02-19'),
(2, 2, 2, 3, '2024-02-19'),
(3, 2.5, 2, 3, '2024-02-19'),
(4, 4.5, 2, 3, '2024-02-19'),
(5, 4.5, 2, 3, '2024-02-19'),
(6, 4.5, 2, 3, '2024-02-19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_riderorder`
--

CREATE TABLE `tbl_riderorder` (
  `id` int(11) NOT NULL,
  `oredrinvoice` varchar(50) DEFAULT NULL,
  `customerid` int(11) DEFAULT NULL,
  `riderid` int(11) DEFAULT NULL,
  `assignby` int(11) DEFAULT NULL,
  `assigndate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_riderorder`
--

INSERT INTO `tbl_riderorder` (`id`, `oredrinvoice`, `customerid`, `riderid`, `assignby`, `assigndate`) VALUES
(1, '1001', 2, 5, 3, '2024-02-20'),
(2, '1005', 26, 5, 1, '2024-09-08'),
(3, '1009', 26, 5, 1, '2024-09-25'),
(4, '1001', 26, 5, 1, '2024-09-26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `rid` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`rid`, `name`) VALUES
(1, 'Admin'),
(2, 'Customer'),
(3, 'Vendor'),
(4, 'Rider');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `uid` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `contact` varchar(16) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `picture` varchar(200) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `logo` varchar(200) DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `createddate` date DEFAULT NULL,
  `address` varchar(500) NOT NULL,
  `latitude_val` varchar(1000) NOT NULL,
  `longitude_val` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`uid`, `role_id`, `name`, `email`, `contact`, `username`, `password`, `picture`, `status`, `logo`, `createdby`, `createddate`, `address`, `latitude_val`, `longitude_val`) VALUES
(1, 3, 'Taseer Bakery', 'Taseer@live.com', '1000000001', 'taseer', '123', '1724976826.png', 'active', 'dennis-siqueira-QnMeRW36-zY-unsplash.jpg', 0, '2024-02-15', 'Main bazar Area Nomal', '24.952244124181217', '67.07637289842135'),
(2, 1, 'Sibtain Ali', 'sibtainali197@gmail.com', '03142049021', 'sh', '12345', '2.jpg', 'active', NULL, 0, '2024-02-15', 'Main Bazar Area Nomal', '24.898655713787285', '67.17277483811172'),
(3, 3, 'Kareem General Store', 'kareem@live.com', '12345123451', 'Kareem', '123', '1645351391.png', 'active', 'images2.jpg', 0, '2024-02-15', 'Main Bazar Area Nomal', '24.919538113888443', '67.10559084074961'),
(4, 3, 'Naseem General Store', 'naseem@gmail.com', '123', 'naseem', '123', '1644948220.png', 'active', 'kareem.jpg', 0, '2024-02-15', 'Main Bazar Area Nomal', '24.951130606484774', '67.07736866958597'),
(5, 4, 'Tariq 11', 'tariq@live.com', '1234', 'tariq', '123', NULL, 'active', NULL, 0, '2024-02-15', 'Main Bazar Area nomal', '24.892672792749778', '67.17364981381085'),
(18, 3, 'Mansoor ', 'Mansoor99@gmail.com', '03170026700', '@mansoor', '12345678', NULL, 'active', 'IMG_20220220_164600_893.jpg', 0, '2024-02-20', 'Main Bazar Area Nomal', '', ''),
(20, 3, 'Agah General Store', 'agha98@gmail.com', '03452225832', 'agha', '123456789', NULL, 'active', 'IMG_20220220_170448_781.jpg', 0, '2024-02-20', 'Main Bazar Area Nomal', '', ''),
(21, 4, 'ddd', 'ss@i.com', '33333333332', 'vvv', '1111111111', NULL, 'active', NULL, 0, '2024-07-27', 'zzzz', '', ''),
(22, 3, 'Sibtain', 'sibalee987@gmail.com', '44444444444', 'sibb', '12345678', '1723968324.JPG', 'active', 'dennis-siqueira-QnMeRW36-zY-unsplash.jpg', 0, '2024-08-18', 'asdf', '', ''),
(26, 2, 'Ali', 'ali@live.com', '33333333333', 'aly', '12345678', '26.JPG', 'active', NULL, 0, '2024-09-03', 'Karakurum International University Gilgit', '', ''),
(27, 2, 'sibtain store', 'sibtainali896@gmail.com', '00000000000', 'sibtainali', '12345678', NULL, 'active', NULL, 0, '2024-09-04', 'Hunza', '', ''),
(28, 2, 'Asad', 'abc@live.com', '03323451234', 'Asad', 'abc12345', '28.jpg', 'active', NULL, 0, '2024-09-07', 'abc colony', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_items`
--
ALTER TABLE `tbl_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`orderid`);

--
-- Indexes for table `tbl_orderitems`
--
ALTER TABLE `tbl_orderitems`
  ADD PRIMARY KEY (`orderitemid`);

--
-- Indexes for table `tbl_ratings`
--
ALTER TABLE `tbl_ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_riderorder`
--
ALTER TABLE `tbl_riderorder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `contact` (`contact`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_items`
--
ALTER TABLE `tbl_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `orderid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_orderitems`
--
ALTER TABLE `tbl_orderitems`
  MODIFY `orderitemid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_ratings`
--
ALTER TABLE `tbl_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_riderorder`
--
ALTER TABLE `tbl_riderorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

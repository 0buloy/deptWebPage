-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2023 at 05:21 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `comshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminacc`
--

CREATE TABLE `adminacc` (
  `ID` int(3) NOT NULL,
  `user` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminacc`
--

INSERT INTO `adminacc` (`ID`, `user`, `pass`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `ID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `productid` int(3) NOT NULL,
  `productname` varchar(50) NOT NULL,
  `quantity` int(6) NOT NULL,
  `totalprice` int(6) NOT NULL,
  `price` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `ID` int(5) NOT NULL,
  `date` varchar(30) NOT NULL,
  `time` varchar(30) NOT NULL,
  `username` varchar(50) NOT NULL,
  `status` varchar(30) NOT NULL,
  `payment` varchar(10) NOT NULL,
  `fee` int(6) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `landmark` varchar(30) NOT NULL,
  `course` varchar(30) NOT NULL,
  `yearsection` varchar(30) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `action` varchar(20) NOT NULL DEFAULT 'pending',
  `UserId` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`ID`, `date`, `time`, `username`, `status`, `payment`, `fee`, `fullname`, `email`, `phone`, `landmark`, `course`, `yearsection`, `gender`, `action`, `UserId`) VALUES
(21, '07/18/2023', '11:08 PM', 'costumer', 'onroute', '350', 0, 'Lauwrence kurt Palomo', 'palomolauwrence@gmail.com', '09185637861', '1231', '123123', '12313', 'Male', 'pending', 1),
(22, '07/18/2023', '11:19 PM', 'costumer', 'onroute', '350', 0, 'Lauwrence kurt Palomo', 'palomolauwrence@gmail.com', '09185637861', '123', '123', '123', 'Male', 'pending', 0);

-- --------------------------------------------------------

--
-- Table structure for table `deliveryitems`
--

CREATE TABLE `deliveryitems` (
  `ID` int(4) NOT NULL,
  `itemid` int(6) NOT NULL,
  `ItemName` varchar(30) NOT NULL,
  `Price` int(6) NOT NULL,
  `Quantity` int(6) NOT NULL,
  `Total` int(6) NOT NULL,
  `deliveryid` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deliveryitems`
--

INSERT INTO `deliveryitems` (`ID`, `itemid`, `ItemName`, `Price`, `Quantity`, `Total`, `deliveryid`) VALUES
(37, 10, 'ComSoc Bag', 350, 1, 350, 21),
(38, 10, 'ComSoc Bag', 350, 1, 350, 22);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `ID` int(11) NOT NULL,
  `picture` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(5) NOT NULL,
  `category` varchar(30) NOT NULL,
  `stock` int(6) NOT NULL,
  `description` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`ID`, `picture`, `name`, `price`, `category`, `stock`, `description`) VALUES
(6, 'Jul092023180405000000.png', 'ComSoc T-Shirt (White)', 500, 'T-Shirt', 92, 'A white clean shirt'),
(7, 'Jul092023180520000000.png', 'ComSoc T-Shirt (Black)', 500, 'T-Shirt', 99, 'Black Shirt'),
(8, 'Jul092023180551000000.png', 'ComSoc T-Shirt (Yellow)	', 500, 'T-Shirt', 100, 'A yellow shirt'),
(9, 'Jul092023180634000000.png', 'ComSoc T-Shirt (Black)	', 500, 'T-Shirt', 99, 'very very green hehe'),
(10, 'Jul092023181607000000.png', 'ComSoc Bag', 350, 'Limited Items', 41, 'bagbatgabgabag'),
(11, 'Jul092023181917000000.png', 'Laptop Bag', 250, 'Limited Items', 247, 'Grey bag with free laptop'),
(12, 'Jul092023181958000000.png', 'ComSoc Pen', 20, 'Limited Items', 120, 'panulat haha'),
(13, 'Jul092023182031000000.png', 'Power Bank', 999, 'Limited Items', 50, 'more power more happy hahaha'),
(14, 'Jul092023182059000000.png', 'ComSoc Flask', 1299, 'Limited Items', 80, 'para di ka mauhaw'),
(15, 'Jul092023182148000000.png', 'ComSoc Flash Drive (64GB)', 199, 'Limited Items', 78, 'lagayan ng bold hahahahha'),
(16, 'Jul092023182223000000.png', 'ComSoc Fan', 120, 'Limited Items', 104, 'mabanas kasi sa room ng pup');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(3) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `company` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `date` varchar(20) NOT NULL,
  `phone` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `password`, `fname`, `lname`, `company`, `email`, `date`, `phone`) VALUES
(1, 'costumer', '1234', 'Lauwrence kurt', 'Palomo', 'treu', 'palomolauwrence@gmail.com', 'Jul 18, 2023', '09185637861');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminacc`
--
ALTER TABLE `adminacc`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `deliveryitems`
--
ALTER TABLE `deliveryitems`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminacc`
--
ALTER TABLE `adminacc`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `deliveryitems`
--
ALTER TABLE `deliveryitems`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

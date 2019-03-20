-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 20, 2019 at 05:47 PM
-- Server version: 10.2.17-MariaDB
-- PHP Version: 7.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u463135857_yxuq`
--

-- --------------------------------------------------------

--
-- Table structure for table `business_page`
--

CREATE TABLE `business_page` (
  `bus_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `owner_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `heading` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `business_page`
--

INSERT INTO `business_page` (`bus_name`, `owner_name`, `heading`, `description`) VALUES
('sid', 'manager', '', 'this is my project'),
('sid', 'manager', 'Hello everybody', ''),
('sid', 'manager', '', 'this is my project'),
('rakshith', 'manager', 'Rakshiths Business', ''),
('rakshith', 'manager', '', 'Hello this is my business.'),
('Khalids hotel', 'khalid', 'Hello Khalid', ''),
('Khalids hotel', 'khalid', '', 'My name is khalid and this is my business.');

-- --------------------------------------------------------

--
-- Table structure for table `business_product`
--

CREATE TABLE `business_product` (
  `bus_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `owner_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `product_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `product_description` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `product_price` int(10) NOT NULL,
  `product_link` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `business_product`
--

INSERT INTO `business_product` (`bus_name`, `owner_name`, `product_name`, `product_description`, `product_price`, `product_link`) VALUES
('sid', 'manager', 'chips', 'potato chips', 10, 'https://image.shutterstock.com/image-photo/isolated-chips-group-potato-on-450w-751118227.jpg'),
('sid', 'manager', 'Pepsi', 'A cold bottle of pepsi', 20, 'https://image.shutterstock.com/image-photo/cola-cold-drink-450w-787146463.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `business_reg`
--

CREATE TABLE `business_reg` (
  `bus_name` text COLLATE utf8_unicode_ci NOT NULL,
  `owner_name` text COLLATE utf8_unicode_ci NOT NULL,
  `owner_contact` int(10) NOT NULL,
  `owner_address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `business_type` text COLLATE utf8_unicode_ci NOT NULL,
  `page_link` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `business_reg`
--

INSERT INTO `business_reg` (`bus_name`, `owner_name`, `owner_contact`, `owner_address`, `business_type`, `page_link`) VALUES
('sid', 'manager', 1211, 'ds max', 'hotel', 'business/sidmanager/sidmanager.php'),
('rakshith', 'manager', 12121, 'awdada', 'service', 'business/rakshithmanager/rakshithmanager.php'),
('Khalids hotel', 'khalid', 1212, 'wadaw', 'hotel', 'business/Khalids hotelkhalid/Khalids hotelkhalid.php');

-- --------------------------------------------------------

--
-- Table structure for table `business_vars`
--

CREATE TABLE `business_vars` (
  `bus_name` text COLLATE utf8_unicode_ci NOT NULL,
  `owner_name` text COLLATE utf8_unicode_ci NOT NULL,
  `vars_link` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `business_vars`
--

INSERT INTO `business_vars` (`bus_name`, `owner_name`, `vars_link`) VALUES
('sid', 'manager', 'business/sidmanager/vars.php'),
('rakshith', 'manager', 'business/rakshithmanager/vars.php'),
('Khalids hotel', 'khalid', 'business/Khalids hotelkhalid/vars.php');

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `user_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`user_id`, `pass`) VALUES
('manager', 'manager'),
('sid', 'sid'),
('khalid', 'khalid');

-- --------------------------------------------------------

--
-- Table structure for table `recs_employees_details`
--

CREATE TABLE `recs_employees_details` (
  `bus_name` text COLLATE utf8_unicode_ci NOT NULL,
  `owner_name` text COLLATE utf8_unicode_ci NOT NULL,
  `emp_name` text COLLATE utf8_unicode_ci NOT NULL,
  `emp_phone` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `recs_employees_details`
--

INSERT INTO `recs_employees_details` (`bus_name`, `owner_name`, `emp_name`, `emp_phone`) VALUES
('sid', 'manager', 'sid', 123);

-- --------------------------------------------------------

--
-- Table structure for table `view_business`
--

CREATE TABLE `view_business` (
  `bus_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `owner_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `cpanel_link` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `view_business`
--

INSERT INTO `view_business` (`bus_name`, `owner_name`, `cpanel_link`) VALUES
('sid', 'manager', 'business/sidmanager/sidmanagercpanel.php'),
('rakshith', 'manager', 'business/rakshithmanager/rakshithmanagercpanel.php'),
('Khalids hotel', 'khalid', 'business/Khalids hotelkhalid/Khalids hotelkhalidcpanel.php');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

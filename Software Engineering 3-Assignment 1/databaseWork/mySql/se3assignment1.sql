-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2019 at 04:54 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `se3assignment1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(5) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `emailAddress` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `registeredDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `fullname`, `username`, `gender`, `emailAddress`, `password`, `registeredDate`) VALUES
(12, 'Max Fotheby', 'MaxFotheby', 'Male', 'maxfotheby@gmail.com', '$2y$10$xevdUeuU23TsUoPrlpXZp.xYqGOTBRTYuuWz79VEDKhnFSj6dbf.q', '2019-05-04 08:14:50');

-- --------------------------------------------------------

--
-- Table structure for table `auctions`
--

CREATE TABLE `auctions` (
  `auction_id` int(5) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `lot_number` int(8) NOT NULL,
  `title` varchar(255) NOT NULL,
  `piece_title` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `auction_image` varchar(200) NOT NULL,
  `location` varchar(255) NOT NULL,
  `artist` varchar(50) NOT NULL,
  `work_produced_year` date NOT NULL,
  `classification` int(11) NOT NULL,
  `description` text NOT NULL,
  `auction_date` date NOT NULL,
  `period` varchar(255) NOT NULL,
  `estimated_price` int(11) NOT NULL,
  `archive` int(1) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auctions`
--

INSERT INTO `auctions` (`auction_id`, `admin_id`, `lot_number`, `title`, `piece_title`, `category_id`, `auction_image`, `location`, `artist`, `work_produced_year`, `classification`, `description`, `auction_date`, `period`, `estimated_price`, `archive`, `timestamp`) VALUES
(22, 0, 10000001, 'Photograph of NAMI student enjoying sunny day.', 'Friendship', 5, '621118488.jpg', 'Pokhara', 'Picaso', '2005-02-16', 2, 'This is a photograph clicked by picaso', '2019-07-22', 'Evening', 1700, 0, '2019-04-18 11:01:12'),
(23, 0, 10000002, 'Amazing photograph of a boy with statue of hanuman.', 'Awesome picture', 5, '1986667137.jpg', 'London', 'Picaso', '2012-03-18', 3, 'My Photo', '2019-05-18', 'Afternoon', 1800, 0, '2019-04-18 11:04:27'),
(24, 0, 10000003, 'Dashain festival.', 'Celebrations', 5, '913032305.jpg', 'Kathmandu', 'Sujan', '2016-04-18', 5, 'This is a image of my mom celebrating Dashain. yo.', '2019-06-18', 'Afternoon', 1300, 0, '2019-04-18 12:39:10'),
(25, 0, 10000004, 'Picture of mom', 'Mother', 5, '1909118816.jpg', 'Nepal', 'Anjay', '2019-04-27', 2, 'photo', '2019-07-27', 'Afternoon', 1000, 0, '2019-04-27 02:55:52'),
(26, 0, 10000005, 'Amaging photograph', 'Granmom and me', 5, '1046595177.jpg', 'Bhandara', 'Anjay', '2017-04-27', 2, 'Celebrating dashain', '2019-07-27', 'Afternoon', 800, 0, '2019-04-27 04:09:25'),
(28, 0, 10000006, 'Amazing photograph', 'Awesome', 5, '1938232398.jpg', 'Brazil', 'Sujan', '2016-04-27', 2, 'Enjoying.', '2019-07-27', 'Afternoon', 1200, 0, '2019-04-27 05:20:32'),
(32, 0, 10000028, 'Hero', 'Hero', 7, '561938621.jpg', 'Kathmandu', 'Bijay', '2019-04-27', 10, 'aaaaaaaaaaaaa', '2019-07-27', 'Afternoon', 12000, 0, '2019-04-27 09:11:05');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(5) NOT NULL,
  `admin_id` int(5) NOT NULL,
  `category` varchar(50) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `admin_id`, `category`, `timestamp`) VALUES
(2, 3, 'Paintings', '2019-04-12 16:19:07'),
(3, 3, 'Drawings', '2019-04-12 16:19:44'),
(5, 3, 'Photographic images', '2019-04-12 16:23:08'),
(6, 3, 'Sculptures', '2019-04-12 16:23:20'),
(7, 3, 'Carving', '2019-04-12 16:23:30');

-- --------------------------------------------------------

--
-- Table structure for table `classification`
--

CREATE TABLE `classification` (
  `classification_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `classification` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classification`
--

INSERT INTO `classification` (`classification_id`, `admin_id`, `classification`, `timestamp`) VALUES
(1, 3, 'Nude', '2019-04-27 01:42:39'),
(2, 3, 'Landscape', '2019-04-27 01:46:04'),
(3, 3, 'Seascape', '2019-04-27 01:46:15'),
(4, 3, 'Portrait', '2019-04-27 01:46:25'),
(5, 3, 'Figure', '2019-04-27 01:46:34'),
(7, 3, 'Animal', '2019-04-27 01:46:52'),
(8, 3, 'Abstract', '2019-04-27 01:47:06'),
(10, 3, 'Still life', '2019-04-27 01:48:18');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL,
  `emKey` varchar(500) NOT NULL,
  `emailVerify` int(11) NOT NULL,
  `adminApprove` int(11) NOT NULL,
  `applied` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `auctions`
--
ALTER TABLE `auctions`
  ADD PRIMARY KEY (`auction_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `classification`
--
ALTER TABLE `classification`
  ADD PRIMARY KEY (`classification_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `auctions`
--
ALTER TABLE `auctions`
  MODIFY `auction_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `classification`
--
ALTER TABLE `classification`
  MODIFY `classification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

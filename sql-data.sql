-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2023 at 04:06 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--
CREATE DATABASE IF NOT EXISTS `cms` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cms`;

-- --------------------------------------------------------

--
-- Table structure for table `background`
--

CREATE TABLE `background` (
  `id` int(11) NOT NULL,
  `Image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `background`
--

INSERT INTO `background` (`id`, `Image`) VALUES
(1, 'backgrounds/bg-2.png');

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `id` int(11) NOT NULL,
  `darkColor` varchar(20) NOT NULL,
  `lightColor` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`id`, `darkColor`, `lightColor`) VALUES
(1, '#353c44', '#ffffff');

-- --------------------------------------------------------

--
-- Table structure for table `logo`
--

CREATE TABLE `logo` (
  `id` int(11) NOT NULL,
  `Image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logo`
--

INSERT INTO `logo` (`id`, `Image`) VALUES
(1, 'logo/logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `slideshow`
--

CREATE TABLE `slideshow` (
  `id` int(11) NOT NULL,
  `Image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slideshow`
--

INSERT INTO `slideshow` (`id`, `Image`) VALUES
(12, 'slideshowImages/sunwear.jpg'),
(13, 'slideshowImages/virtual-tryon.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `background`
--
ALTER TABLE `background`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logo`
--
ALTER TABLE `logo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slideshow`
--
ALTER TABLE `slideshow`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `background`
--
ALTER TABLE `background`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `logo`
--
ALTER TABLE `logo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `slideshow`
--
ALTER TABLE `slideshow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Database: `contact`
--
CREATE DATABASE IF NOT EXISTS `contact` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `contact`;

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `ID` int(11) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Birthday` date NOT NULL,
  `Gender` varchar(6) NOT NULL,
  `EmailAddress` varchar(50) NOT NULL,
  `Phone` varchar(11) NOT NULL,
  `PurposeOfVisit` text NOT NULL,
  `Other` text NOT NULL,
  `PreferredSchedule1` date NOT NULL,
  `PreferredSchedule2` date NOT NULL,
  `Status` varchar(10) NOT NULL,
  `Message` text NOT NULL,
  `SubmissionDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`ID`, `FirstName`, `LastName`, `Birthday`, `Gender`, `EmailAddress`, `Phone`, `PurposeOfVisit`, `Other`, `PreferredSchedule1`, `PreferredSchedule2`, `Status`, `Message`, `SubmissionDate`) VALUES
(1, 'Maricel', 'Montuya', '2003-06-27', 'Female', 'montuyamaricela@gmail.com', '09276565832', 'Optical and Contact Lens Services', '', '2023-11-21', '0000-00-00', 'Cancelled', '', '2023-11-05'),
(2, 'Maricel', 'Montuya', '2023-11-01', 'Female', 'mmontuya.cel@gmail.com', '09276565832', 'General Eye Check Up', '', '2023-11-22', '0000-00-00', 'Cancelled', '', '2023-11-05'),
(3, 'Mae', 'Reyes', '2003-10-30', 'Female', 'mmaerys@gmail.com', '09276565832', 'Lasik Screening', '', '2023-12-05', '2023-12-06', 'Confirmed', '', '2023-11-05'),
(4, 'Maricel', 'Montuya', '2003-06-27', 'Female', 'montuyamaricela@gmail.com', '09276565832', 'Optical and Contact Lens Services', '', '2023-11-23', '0000-00-00', 'Confirmed', '', '2023-11-05'),
(5, 'Maricel', 'Montuya', '2003-06-27', 'Female', 'montuyamaricela@gmail.com', '09276565832', 'Optical and Contact Lens Services', '', '2023-11-23', '0000-00-00', 'Cancelled', '', '2023-11-05'),
(6, 'Maricel', 'Montuya', '2003-06-27', 'Female', 'montuyamaricela@gmail.com', '09276565832', 'Optical and Contact Lens Services', '', '2023-11-23', '0000-00-00', 'Cancelled', '', '2023-11-05'),
(7, 'Maricel', 'Montuya', '2003-03-20', 'Male', 'montuyamaricela@gmail.com', '09276565832', 'General Eye Check Up', '', '2023-11-11', '0000-00-00', 'Cancelled', '', '2023-11-05'),
(8, 'Maricel', 'Montuya', '2023-11-03', 'Female', 'montuyamaricela@gmail.com', '09276565832', 'Optical and Contact Lens Services', '', '2023-11-23', '0000-00-00', 'Cancelled', '', '2023-11-05'),
(9, 'Maricel', 'Montuya', '2023-11-02', 'Female', 'montuyamaricela@gmail.com', '09276565832', 'Optical and Contact Lens Services', '', '2023-11-22', '0000-00-00', 'Cancelled', '', '2023-11-05'),
(10, 'Maricel', 'Montuya', '2023-10-30', 'Female', 'montuyamaricela@gmail.com', '09276565832', 'General Eye Check Up', '', '0000-00-00', '0000-00-00', 'Cancelled', '', '2023-11-05');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`ID`, `Name`, `Email`, `Message`) VALUES
(27, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(28, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(29, 'asd', 'asdadada@gmail.com', 'asdsa'),
(30, 'asd', 'asdadada@gmail.com', 'asdsa'),
(31, 'asdsa', 'asdsad@gmail.com', 'asdsadsa'),
(32, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsa'),
(33, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsa'),
(34, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsa'),
(35, 'Maricel Montuya', 'montuyamaricela@gmail.com', '123'),
(36, 'asda', 'montuyamaricela@gmail.com', 'asdsa'),
(37, 'asda', 'montuyamaricela@gmail.com', 'asdsa'),
(38, 'asda', 'montuyamaricela@gmail.com', 'asdsa'),
(39, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsa'),
(40, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsa'),
(41, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'test'),
(42, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdad'),
(43, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdad'),
(44, 'asdsad', 'asdadada@gmail.com', 'asdasdas'),
(45, 'asdsad', 'asdadada@gmail.com', 'asdasdas'),
(46, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdad'),
(47, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdad'),
(48, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(49, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(50, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(51, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(52, 'asda', 'dadasdasd@gmail.com', 'asdsad'),
(53, 'asda', 'dadasdasd@gmail.com', 'asdsad'),
(54, 'asda', 'dadasdasd@gmail.com', 'asdsad'),
(55, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(56, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(57, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(58, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(59, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(60, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(61, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(62, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(63, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(64, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(65, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(66, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(67, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(68, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(69, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(70, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(71, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(72, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(73, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(74, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(75, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(76, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(77, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(78, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(79, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(80, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(81, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(82, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(83, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(84, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(85, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(86, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(87, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(88, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(89, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(90, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(91, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsad'),
(92, 'Testing', 'Testing@gmail.com', 'asdadas'),
(93, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsadas'),
(94, 'Maricel Montuya', 'montuyamaricela@gmail.com', 'asdsadas'),
(95, 'asdad', 'asdsad@gmail.com', 'asda'),
(96, 'montuyamaricela@gmail.com', 'montuyamaricela@gmail.com', 'maricela ekalvuash');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
--
-- Database: `product`
--
CREATE DATABASE IF NOT EXISTS `product` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `product`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `ID` int(11) NOT NULL,
  `Category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ID`, `Category_name`) VALUES
(1, 'Glasses'),
(2, 'Contact Lenses'),
(3, 'Accessories');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ID` varchar(10) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Price` varchar(5) NOT NULL,
  `Color` varchar(20) NOT NULL,
  `Category` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `Stock` int(11) NOT NULL,
  `Image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `Name`, `Price`, `Color`, `Category`, `Description`, `Stock`, `Image`) VALUES
('A-001', 'Eyeglasses Handcrafted Cord Balaan', '298', 'Clear/white', 'Accessories', 'Suitable for eyeglasses, reading glasses, sunglasses\r\nAnti-slip hooks for a secure and firm grip on your eyeglasses\r\n', 10, 'products/accessory1.jpg'),
('A-002', 'Eyeglasses Cord Leather', '120', 'Brown', 'Accessories', 'Comfortable and stylish design Suitable for eyeglasses, reading glasses, sunglasses Anti-slip hooks for a secure and firm grip on your eyeglasses', 4, 'products/accessory2.jpg'),
('A-003', 'Eyeglasses Cord Acrylic', '280', 'Pink', 'Accessories', 'Eyeglasses Cord E017 Acrylic’s modern-chic chain design is a perfect choice for your basic and funky outfit.', 4, 'products/accessory3.jpg'),
('A-004', 'CL Case', '50', 'Pink', 'Accessories', 'A lightweight container designed to keep your contact lenses safe and secure, complete with a color label to avoid confusion.', 13, 'products/accessory4.jpg'),
('A-005', 'Eyeglasses Cord', '190', 'Black', 'Accessories', 'Eyeglasses cord is the perfect way to add a pop of color or texture to your look. Designed specifically for keeping your eyeglasses and sunglasses within reach, this accessory will also add a statement piece to your outfit.', 6, 'products/accessory5.jpg'),
('A-006', 'Eyeglasses Cord', '190', 'Orange', 'Accessories', 'Eyeglasses cord is the perfect way to add a pop of color or texture to your look. Designed specifically for keeping your eyeglasses and sunglasses within reach, this accessory will also add a statement piece to your outfit.', 6, 'products/accessory6.jpg'),
('A-007', 'CL CASE ', '50', 'Clear/white', 'Accessories', 'A lightweight container designed to keep your contact lenses safe and secure, complete with a sturdy cover that perfectly seals.', 25, 'products/accessory7.jpg'),
('A-008', 'Nosepads For Acetate Frame ', '100', 'Clear/white', 'Accessories', 'Eyeglasses Anti-Slip Silicone Nose Pad - 1 Pair\n\nSecure your eyewear with anti-slip! ', 2, 'products/accessory9.jpg'),
('A-009', 'Anti Fog Eyeglasses Cleaning Cloth', '125', 'Black', 'Accessories', 'ANTIFOG Cleaning Cloth is perfect for any kind of lens in cold weather or moist environments. It features a special anti-fog formula that is embedded into the cloth.', 26, 'products/accessory8.jpg'),
('G-001', 'Glasses 1', '999', 'Black', 'Glasses', 'Eyestyles is a collection of eyewear designed with a minimalist and sophisticated style, making it a perfect addition to any outfit. The collection features a range of eyeglasses made with high-quality materials and attention to detail, ensuring both durability and comfort. Freebies: Hard case and wiper', 5, 'products/EO-EYEWEAR-removebg-preview (1).png'),
('G-002', 'Glasses 2', '799', 'Silver', 'Glasses', 'Desc...', 4, 'products/VISUALITIES_HOVER.jpg'),
('G-003', 'Glasses 3', '899', 'Black', 'Glasses', 'Description....', 4, 'products/EYESTYLES_HOVER.jpg'),
('G-004', 'Glasses 4', '999', 'Silver', 'Glasses', 'Description', 5, 'products/EO-EYEWEAR_HOVER.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Database: `user`
--
CREATE DATABASE IF NOT EXISTS `user` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `user`;

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Status` varchar(15) NOT NULL,
  `LoginAttempt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`ID`, `Name`, `Email`, `Password`, `Status`, `LoginAttempt`) VALUES
(2, 'Maricel Montuya', 'montuyamaricela@gmail.com', '12345678', 'Verified', 0),
(3, 'Maricel Montuya', 'tjuicyhatdog@gmail.com', 'youwant2play?', 'Not Verified', 0),
(4, 'Maricel Montuya', 'bjalex@hehe.com', 'bjalexhihi', 'Blocked', 0),
(5, 'Maricel Montuya', 'rm@gmail.com', 'bts', 'Verified', 1),
(7, 'Maricel Montuya', 'montuyamarcel92@gmail.com', '251654', 'Verified', 0),
(8, 'Maricel Montuya', 'montuya.cel@gmail.com', '06272003', 'Not Verified', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `ID` int(11) NOT NULL,
  `Product_ID` varchar(10) NOT NULL,
  `Product_name` text NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Total` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `User_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`ID`, `Product_ID`, `Product_name`, `Quantity`, `Total`, `User_id`, `User_name`) VALUES
(62, 'A-002', 'Eyeglasses Cord Leather', 1, 120, 2, 'Maricel Montuya'),
(63, 'G-002', 'Glasses 2', 1, 799, 2, 'Maricel Montuya');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` varchar(10) NOT NULL,
  `Product_ID` varchar(10) NOT NULL,
  `Product_name` varchar(50) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` varchar(5) NOT NULL,
  `User_id` int(11) NOT NULL,
  `User_name` varchar(50) NOT NULL,
  `User_email` varchar(50) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Address` text NOT NULL,
  `Note` text NOT NULL,
  `Status` varchar(15) NOT NULL,
  `DateOrdered` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `Product_ID`, `Product_name`, `Quantity`, `Price`, `User_id`, `User_name`, `User_email`, `Phone`, `Address`, `Note`, `Status`, `DateOrdered`) VALUES
('7327136882', 'A-006', 'Eyeglasses Cord', 2, '380', 2, 'Maricel Montuya', 'montuyamaricela@gmail.com', '09276565832', '070, Mulawin street brgy Cupang', '', 'Order Pending', '2023-12-05 22:18:07'),
('7327136882', 'G-003', 'Glasses 3', 2, '1798', 2, 'Maricel Montuya', 'montuyamaricela@gmail.com', '09276565832', '070, Mulawin street brgy Cupang', '', 'Order Pending', '2023-12-05 22:18:07'),
('7502767158', 'A-004', 'CL Case', 1, '50', 2, 'Maricel Montuya', 'montuyamaricela@gmail.com', '09276565832', '070, Mulawin street brgy Cupang', '', 'Order Pending', '2023-12-05 22:27:28'),
('6806277673', 'A-002', 'Eyeglasses Cord Leather', 3, '360', 2, 'Maricel Montuya', 'montuyamaricela@gmail.com', '09276565832', '070, Mulawin street brgy Cupang', '', 'Order Pending', '2023-12-06 16:55:02'),
('3893729438', 'G-003', 'Glasses 3', 1, '899', 2, 'Maricel Montuya', 'montuyamaricela@gmail.com', '09276565832', '070, Mulawin street brgy Cupang', '', 'Order Pending', '2023-12-06 16:56:12'),
('7514972724', 'G-002', 'Glasses 2', 1, '799', 2, 'Maricel Montuya', 'montuyamaricela@gmail.com', '09276565832', '070, Mulawin street brgy Cupang', '', 'Order Pending', '2023-12-06 16:56:41');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Address` text NOT NULL,
  `Avatar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`ID`, `Name`, `Email`, `Phone`, `Address`, `Avatar`) VALUES
(2, 'Maricel Montuya', 'montuyamaricela@gmail.com', '09276565832', '070, Mulawin street brgy Cupang', 'userProfile/Mari.jpg'),
(3, 'Chamber', 'tjuicyhatdog@gmail.com', '12345678901', 'Banorant', 'userProfile/unknown.png'),
(4, 'BJ ALEX', 'bjalex@hehe.com', '09276565832', 'Jan sa gilid gilid', 'userProfile/𝑩𝑱 𝑨𝑳𝑬𝑿࿐.jpg'),
(5, 'Kim Namjoon', 'rm@gmail.com', '-', 'Korea', 'userProfile/방탄소년단 on Twitter.jpg'),
(7, 'Marcel Montuya', 'montuyamarcel92@gmail.com', '09276565832', '070, Mulawin street brgy Cupang', 'userProfile/♡.jpg'),
(8, 'Mari', 'montuya.cel@gmail.com', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `ID` int(11) NOT NULL,
  `Product_ID` varchar(10) NOT NULL,
  `Product_name` text NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`ID`, `Product_ID`, `Product_name`, `user_id`) VALUES
(14, 'G-002', 'Glasses 2', 3),
(15, 'A-004', 'CL Case', 3),
(17, 'G-004', 'Glasses 4', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

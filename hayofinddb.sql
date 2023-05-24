-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2023 at 04:08 AM
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
-- Database: `hayofinddb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `created_at`) VALUES
('admin', 'admin', '2023-05-20 06:05:50'),
('admin', 'admin', '2023-05-20 06:05:50');

-- --------------------------------------------------------

--
-- Table structure for table `buyers`
--

CREATE TABLE `buyers` (
  `id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `phoneNumber` varchar(15) NOT NULL,
  `email` varchar(256) NOT NULL,
  `gender` varchar(256) NOT NULL,
  `address` varchar(500) NOT NULL,
  `dob` date DEFAULT NULL,
  `valid_ID` varchar(999) NOT NULL,
  `image` varchar(999) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buyers`
--

INSERT INTO `buyers` (`id`, `fname`, `lname`, `phoneNumber`, `email`, `gender`, `address`, `dob`, `valid_ID`, `image`, `username`, `password`) VALUES
(32, 'Zabby', 'Bartolbok', '09124324152', '', '', '93 Juana Osmeña St., Cebu City', '0000-00-00', '', '', 'ZBartolbok152', '794aad24cbd58461011ed9094b7fa212'),
(33, 'Xymer', 'talaba', '09991830304', 'xymerserna@yahoo.com', 'Male', 'Sanciangko St., Cebu City', '0000-00-00', 'uploads/valid-id.jpg', 'uploads/mt.jpg', 'srubio304', '202cb962ac59075b964b07152d234b70');

--
-- Triggers `buyers`
--
DELIMITER $$
CREATE TRIGGER `generate_username1` BEFORE INSERT ON `buyers` FOR EACH ROW SET NEW.username = CONCAT(LEFT(NEW.fname, 1), NEW.lname, RIGHT(NEW.phoneNumber, 3))
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `buyer_verification`
--

CREATE TABLE `buyer_verification` (
  `id` int(11) NOT NULL,
  `verification_status` varchar(256) NOT NULL,
  `buyer_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buyer_verification`
--

INSERT INTO `buyer_verification` (`id`, `verification_status`, `buyer_ID`) VALUES
(2, 'Not verified', 32),
(3, 'Verified', 33);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_ID` int(5) UNSIGNED NOT NULL,
  `seller_ID` int(11) NOT NULL,
  `product_ID` int(11) NOT NULL,
  `buyer_ID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `dateAdd` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_details`
--

CREATE TABLE `delivery_details` (
  `id` int(11) NOT NULL,
  `order_ID` int(11) DEFAULT NULL,
  `deliveryName` varchar(256) DEFAULT NULL,
  `deliveryPhoneNumber` varchar(15) DEFAULT NULL,
  `deliveryTime` int(11) DEFAULT NULL,
  `dateTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_details`
--

INSERT INTO `delivery_details` (`id`, `order_ID`, `deliveryName`, `deliveryPhoneNumber`, `deliveryTime`, `dateTime`) VALUES
(3, 12, 'Rubio Rider', '09233420021', 19, '2023-05-24 09:45:28');

-- --------------------------------------------------------

--
-- Table structure for table `merchants`
--

CREATE TABLE `merchants` (
  `id` int(5) UNSIGNED NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `phoneNumber` varchar(15) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(999) NOT NULL,
  `img` varchar(999) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `dob` date DEFAULT NULL,
  `documents` varchar(999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `merchants`
--

INSERT INTO `merchants` (`id`, `fname`, `lname`, `phoneNumber`, `username`, `password`, `img`, `email`, `gender`, `address`, `dob`, `documents`) VALUES
(55, 'Sean', 'Rubio', '09606077367', 'SRubio367', '908563cabd95885ff63516e8a3155625', '', '', '', '', NULL, ''),
(56, 'Xymer', 'Serna', '09233420027', 'XSerna027', '64c9ac2bb5fe46c3ac32844bb97be6bc', '', '', '', '', NULL, '');

--
-- Triggers `merchants`
--
DELIMITER $$
CREATE TRIGGER `generate_username` BEFORE INSERT ON `merchants` FOR EACH ROW SET NEW.username = CONCAT(LEFT(NEW.fname, 1), NEW.lname, RIGHT(NEW.phoneNumber, 3))
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `merchant_verification`
--

CREATE TABLE `merchant_verification` (
  `id` int(11) NOT NULL,
  `verification_status` varchar(256) NOT NULL,
  `seller_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `merchant_verification`
--

INSERT INTO `merchant_verification` (`id`, `verification_status`, `seller_ID`) VALUES
(6, 'Not verified', 55),
(7, 'Not verified', 56);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_ID` int(11) NOT NULL,
  `seller_ID` int(11) NOT NULL,
  `product_ID` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_ID`, `seller_ID`, `product_ID`, `product_quantity`) VALUES
(15, 12, 55, 95, 3);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_ID` int(10) UNSIGNED NOT NULL,
  `seller_ID` int(11) NOT NULL,
  `buyer_ID` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_method` varchar(256) NOT NULL,
  `order_date` date NOT NULL,
  `order_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_ID`, `seller_ID`, `buyer_ID`, `amount`, `payment_method`, `order_date`, `order_status`) VALUES
(12, 55, 33, 16700, 'Cash on delivery', '2023-05-24', 6);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `merchantsID_fk` int(5) UNSIGNED NOT NULL,
  `item_ID` int(10) UNSIGNED NOT NULL,
  `item_IMG` varchar(999) NOT NULL,
  `item_Name` varchar(150) NOT NULL,
  `item_Age` int(11) NOT NULL,
  `item_Breed` varchar(150) NOT NULL,
  `item_Price` decimal(10,2) NOT NULL,
  `item_Weight` decimal(10,2) NOT NULL,
  `item_Desc` varchar(999) NOT NULL,
  `item_Stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`merchantsID_fk`, `item_ID`, `item_IMG`, `item_Name`, `item_Age`, `item_Breed`, `item_Price`, `item_Weight`, `item_Desc`, `item_Stock`) VALUES
(55, 94, 'uploads/cattle.jpg', 'Cattle Ne', 25, 'Catthor', 25000.00, 120.00, 'cattle, domesticated bovine farm animals that are raised for their meat, milk, or hides or for draft purposes. The animals most often included under the term are the Western or European domesticated cattle as well as the Indian and African domesticated cattle.', 5),
(55, 95, 'uploads/pig.jpg', 'Piggy Ne', 15, 'Half Pig', 5500.00, 60.00, 'A pig is a mammal of the family Suidae that has short legs, hooves with two weight-bearing toes, a cartilaginous snout, and bristly hair.', 3),
(55, 96, 'uploads/cow.jpg', 'Cowwy Ne', 30, 'Horny Cow', 25000.00, 190.00, 'Cows come in many shapes and sizes. They are large, hoofed mammals, though people have bred “dwarf” breeds in smaller sizes.', 5),
(55, 97, 'uploads/chicken.jpg', 'Chicken Ne', 16, 'Chickenini', 25000.00, 30.00, 'A chicken with color green background.', 10),
(55, 99, 'uploads/horse.jpg', 'Horse Brown', 12, 'Normal', 25000.00, 190.00, 'Testdadadada', 5);

-- --------------------------------------------------------

--
-- Table structure for table `product_kind`
--

CREATE TABLE `product_kind` (
  `prim_id` int(11) NOT NULL,
  `id` int(10) UNSIGNED NOT NULL,
  `item_Kind` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_kind`
--

INSERT INTO `product_kind` (`prim_id`, `id`, `item_Kind`) VALUES
(31, 94, 'Cattle'),
(32, 95, 'Pig'),
(33, 96, 'Cow'),
(34, 97, 'Chicken'),
(36, 99, 'Horse');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buyers`
--
ALTER TABLE `buyers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `buyer_verification`
--
ALTER TABLE `buyer_verification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_ID`);

--
-- Indexes for table `delivery_details`
--
ALTER TABLE `delivery_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merchants`
--
ALTER TABLE `merchants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merchant_verification`
--
ALTER TABLE `merchant_verification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`item_ID`),
  ADD KEY `merchantsID_fk` (`merchantsID_fk`);

--
-- Indexes for table `product_kind`
--
ALTER TABLE `product_kind`
  ADD PRIMARY KEY (`prim_id`),
  ADD KEY `item_id_fk` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buyers`
--
ALTER TABLE `buyers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `buyer_verification`
--
ALTER TABLE `buyer_verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `delivery_details`
--
ALTER TABLE `delivery_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `merchants`
--
ALTER TABLE `merchants`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `merchant_verification`
--
ALTER TABLE `merchant_verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `item_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `product_kind`
--
ALTER TABLE `product_kind`
  MODIFY `prim_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

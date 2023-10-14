-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 14, 2023 at 08:56 PM
-- Server version: 8.0.20-0ubuntu0.19.10.1
-- PHP Version: 7.3.11-0ubuntu0.19.10.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web66_65011212228`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartid` int NOT NULL,
  `uid` int NOT NULL,
  `pid` int NOT NULL,
  `oid` int NOT NULL,
  `price` int NOT NULL,
  `amount` int NOT NULL,
  `cid` int NOT NULL,
  `sid` int NOT NULL,
  `status` enum('ยังไม่สั่ง','สั่งแล้ว') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartid`, `uid`, `pid`, `oid`, `price`, `amount`, `cid`, `sid`, `status`) VALUES
(190, 2, 2, 264, 379, 1, 1, 1, 'สั่งแล้ว'),
(191, 3, 1, 270, 698, 2, 1, 1, 'สั่งแล้ว'),
(192, 3, 4, 271, 738, 2, 2, 2, 'สั่งแล้ว'),
(193, 3, 2, 270, 758, 2, 1, 1, 'ยังไม่สั่ง');

-- --------------------------------------------------------

--
-- Table structure for table `crust`
--

CREATE TABLE `crust` (
  `cid` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `crust`
--

INSERT INTO `crust` (`cid`, `name`, `price`) VALUES
(1, 'บางกรอบ', 0),
(2, 'หนานุ่ม', 60),
(3, 'ขอบชีท', 80);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `oid` int NOT NULL,
  `uid` int NOT NULL,
  `total_price` int NOT NULL,
  `adress` varchar(3000) NOT NULL,
  `fdate` varchar(30) NOT NULL,
  `odate` varchar(30) NOT NULL,
  `status` enum('กำลังเตรียมออเดอร์','กำลังส่ง','ส่งแล้ว','ยกเลิก') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`oid`, `uid`, `total_price`, `adress`, `fdate`, `odate`, `status`) VALUES
(264, 2, 0, 'address', 'null', '', 'กำลังเตรียมออเดอร์'),
(265, 2, 0, 'address', 'null', '', 'กำลังเตรียมออเดอร์'),
(266, 2, 0, 'address', 'null', 'null', 'กำลังเตรียมออเดอร์'),
(267, 2, 0, 'address', 'null', 'null', 'กำลังเตรียมออเดอร์'),
(268, 2, 0, 'address', 'null', 'null', 'กำลังเตรียมออเดอร์'),
(269, 2, 0, 'address', 'null', 'null', 'กำลังเตรียมออเดอร์'),
(270, 3, 0, 'address', 'null', '10', 'กำลังเตรียมออเดอร์'),
(271, 3, 0, 'address', 'null', 'null', 'กำลังเตรียมออเดอร์'),
(272, 3, 0, 'address', 'null', '10', 'กำลังเตรียมออเดอร์');

-- --------------------------------------------------------

--
-- Table structure for table `pizza`
--

CREATE TABLE `pizza` (
  `pid` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int NOT NULL,
  `image` longtext NOT NULL,
  `description` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pizza`
--

INSERT INTO `pizza` (`pid`, `name`, `price`, `image`, `description`) VALUES
(1, 'ฮาวายเอี้ยน', 349, 'https://cdn.1112.com/1112/public//images/products/pizza/Topping/102204.png', 'ชีส, สับปะรด, แฮมหมู, เบคอน และซอสพิซซ่า'),
(2, 'แฮม & ชีส', 379, '	https://cdn.1112.com/1112/public//images/products/pizza/Topping/102208.png', 'ชีส, แฮมหมู, ชีสไดซ์, สับปะรด และซอสเทาซันด์ไอแลนด์'),
(3, 'ซีฟู้ด & ฮอกไกโด ชีส', 499, '	https://cdn.1112.com/1112/public//images/products/pizza/Topping/102228.png', 'ชีส, กุ้ง, ปูอัด, เห็ด, สับปะรด และซอสเทาซันด์ไอแลนด์'),
(4, 'นิวออร์ลีนส์ & ซอสเซจ', 279, 'https://cdn.1112delivery.com/1112one/public/images/products/pizza/Topping/162216.png', 'ชีส, ไก่นิวออร์ลีนส์, ไส้กรอกไก่, สับปะรด และซอสเทาซันด์ไอแลนด์'),
(5, 'ทริโอ้ ชิกเก้น บาร์บีคิว', 456, 'https://cdn.1112.com/1112/public//images/products/pizza/Topping/102725.png', 'ชีส, ไก่นิวออร์ลีนส์, ไก่รมควัน, ไส้กรอกไก่, สับปะรด, พริกหวาน, หัวหอม และซอสสไปซี่บาร์บีคิว'),
(6, 'หม่าล่าหมูสไลซ์', 456, 'https://cdn.1112.com/1112/public//images/products/pizza/Aug23/102783.png', 'เนื้อหมูสไลซ์, น้ำมันฮวาเจียว, พริกแห้งอบ, ต้นหอม, ผักมิกซ์, มอสซาเรลล่าชีส และซอสหม่าล่า\r\n'),
(7, 'ค็อกเทลกุ้ง', 559, '	https://cdn.1112.com/1112/public//images/products/pizza/Topping/102209.png', 'กุ้ง, เห็ด, สับปะรด, มะเขือเทศ, มอสซาเรลล่าชีส และซอสเทาซันไอส์แลนด์'),
(8, 'ต้มยำกุ้ง', 349, '	https://cdn.1112.com/1112/public/images/products/pizza/Topping/102212.png', 'กุ้ง, ปลาหมึก, เห็ด, มอสซาเรลล่าชีส และซอสต้มยำ');

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `sid` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`sid`, `name`, `price`) VALUES
(1, 'S', 0),
(2, 'M', 30),
(3, 'L', 40),
(4, 'XL', 60);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `Address` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `picture` mediumtext NOT NULL,
  `type` enum('ลูกค้า','เจ้าของร้าน') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `name`, `phone`, `Address`, `email`, `password`, `picture`, `type`) VALUES
(1, 'Jin', '0648112543', 'bkk 14', 'Jin@hotmail.com', '$2y$10$uuXw/3GiCftB5bAONBYcAucfZBTM/h2i1SawxErjg34X841IWcv7G', 'https://i.pinimg.com/564x/b5/2d/83/b52d83cabaf61e8cedbc857252bb4db4.jpg', 'ลูกค้า'),
(2, 'Ning Ning', '0980048711', 'kk 81', 'shongning@hotmail.com', '$2y$10$uuXw/3GiCftB5bAONBYcAucfZBTM/h2i1SawxErjg34X841IWcv7G', 'https://kpopping.com/documents/a8/1/1000/230601-aespa-NingNing-Knowing-Bros-Commute-documents-1.jpeg?v=9834a', 'ลูกค้า'),
(3, 'moo too', '0876991433', 'nk 6', 'mootoo@hotdog.com', '$2y$10$uuXw/3GiCftB5bAONBYcAucfZBTM/h2i1SawxErjg34X841IWcv7G', 'https://profile.line-scdn.net/0hfCGHnFnAOWx6MSzhRRVGO0Z0NwENHz8kAlchXQsyMF9UAnwzTwMlA1sxb14DCX0-T1V1Dgs3Y11V', 'ลูกค้า'),
(4, 'Danielle', '0948761279', 'bkk 12', 'Danielle@hotmail.com', '$2y$10$uuXw/3GiCftB5bAONBYcAucfZBTM/h2i1SawxErjg34X841IWcv7G', 'https://kpopping.com/documents/53/4/Danielle-fullBodyPicture(5).webp?v=d0a13', 'ลูกค้า'),
(5, 'test', '1234567890', 'LA 16', 'test@gmail.com', '$2y$10$uuXw/3GiCftB5bAONBYcAucfZBTM/h2i1SawxErjg34X841IWcv7G', 'https://i.pinimg.com/564x/f1/1f/eb/f11feb2444b738fdbf5fb47a9cfc905f.jpg', 'เจ้าของร้าน');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartid`),
  ADD KEY `uid` (`uid`),
  ADD KEY `sid` (`sid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `pid` (`pid`),
  ADD KEY `oid` (`oid`);

--
-- Indexes for table `crust`
--
ALTER TABLE `crust`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`oid`),
  ADD KEY `user_id` (`uid`);

--
-- Indexes for table `pizza`
--
ALTER TABLE `pizza`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

--
-- AUTO_INCREMENT for table `crust`
--
ALTER TABLE `crust`
  MODIFY `cid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `oid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;

--
-- AUTO_INCREMENT for table `pizza`
--
ALTER TABLE `pizza`
  MODIFY `pid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `sid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cid` FOREIGN KEY (`cid`) REFERENCES `crust` (`cid`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `oid` FOREIGN KEY (`oid`) REFERENCES `order` (`oid`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `pid` FOREIGN KEY (`pid`) REFERENCES `pizza` (`pid`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `sid` FOREIGN KEY (`sid`) REFERENCES `size` (`sid`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `uid` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

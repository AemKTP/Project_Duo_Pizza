-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 12, 2023 at 02:09 PM
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
  `oid` int NOT NULL,
  `pid` int NOT NULL,
  `price` int NOT NULL,
  `amount` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `status` enum('กำลังเตรียมออเดอร์','กำลังส่ง','ส่งแล้ว','ยกเลิก') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`oid`, `uid`, `total_price`, `adress`, `fdate`, `odate`, `status`, `pid`) VALUES
(169, 3, 0, 'address', '2023-10-06 10:05:59', '2023-10-06 10:05:59', 'กำลังเตรียมออเดอร์', 2),
(170, 3, 0, 'address', '2023-10-06 10:05:59', '2023-10-06 10:05:59', 'กำลังเตรียมออเดอร์', 1),
(171, 3, 0, 'address', '2023-10-06 10:05:59', '2023-10-06 10:05:59', 'กำลังเตรียมออเดอร์', 1),
(173, 3, 0, 'address', '2023-10-06 10:05:59', '2023-10-06 10:05:59', 'กำลังเตรียมออเดอร์', 4),
(174, 3, 0, 'address', '2023-10-06 10:05:59', '2023-10-06 10:05:59', 'กำลังเตรียมออเดอร์', 1),
(175, 3, 0, 'address', '2023-10-06 10:05:59', '2023-10-06 10:05:59', 'กำลังเตรียมออเดอร์', 6),
(176, 3, 0, 'address', '2023-10-06 10:05:59', '2023-10-06 10:05:59', 'กำลังเตรียมออเดอร์', 1),
(177, 3, 0, 'address', '2023-10-06 10:05:59', '2023-10-06 10:05:59', 'กำลังเตรียมออเดอร์', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pizza`
--

CREATE TABLE `pizza` (
  `pid` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int NOT NULL,
  `image` longtext NOT NULL,
  `description` mediumtext NOT NULL,
  `cid` int NOT NULL,
  `sid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pizza`
--

INSERT INTO `pizza` (`pid`, `name`, `price`, `image`, `description`, `cid`, `sid`) VALUES
(1, 'ฮาวายเอี้ยน', 349, 'https://cdn.1112.com/1112/public//images/products/pizza/Topping/102204.png', 'ชีส, สับปะรด, แฮมหมู, เบคอน และซอสพิซซ่า', 1, 1),
(2, 'แฮม & ชีส', 379, '	https://cdn.1112.com/1112/public//images/products/pizza/Topping/102208.png', 'ชีส, แฮมหมู, ชีสไดซ์, สับปะรด และซอสเทาซันด์ไอแลนด์', 1, 2),
(3, 'ซีฟู้ด & ฮอกไกโด ชีส', 499, '	https://cdn.1112.com/1112/public//images/products/pizza/Topping/102228.png', 'ชีส, กุ้ง, ปูอัด, เห็ด, สับปะรด และซอสเทาซันด์ไอแลนด์', 1, 3),
(4, 'นิวออร์ลีนส์ & ซอสเซจ', 279, 'https://cdn.1112delivery.com/1112one/public/images/products/pizza/Topping/162216.png', 'ชีส, ไก่นิวออร์ลีนส์, ไส้กรอกไก่, สับปะรด และซอสเทาซันด์ไอแลนด์', 2, 2),
(5, 'ทริโอ้ ชิกเก้น บาร์บีคิว', 456, 'https://cdn.1112.com/1112/public//images/products/pizza/Topping/102725.png', 'ชีส, ไก่นิวออร์ลีนส์, ไก่รมควัน, ไส้กรอกไก่, สับปะรด, พริกหวาน, หัวหอม และซอสสไปซี่บาร์บีคิว', 2, 1),
(6, 'หม่าล่าหมูสไลซ์', 456, 'https://cdn.1112.com/1112/public//images/products/pizza/Aug23/102783.png', 'เนื้อหมูสไลซ์, น้ำมันฮวาเจียว, พริกแห้งอบ, ต้นหอม, ผักมิกซ์, มอสซาเรลล่าชีส และซอสหม่าล่า\r\n', 2, 1),
(7, 'ค็อกเทลกุ้ง', 559, '	https://cdn.1112.com/1112/public//images/products/pizza/Topping/102209.png', 'กุ้ง, เห็ด, สับปะรด, มะเขือเทศ, มอสซาเรลล่าชีส และซอสเทาซันไอส์แลนด์', 2, 1),
(8, 'ต้มยำกุ้ง', 349, '	https://cdn.1112.com/1112/public/images/products/pizza/Topping/102212.png', 'กุ้ง, ปลาหมึก, เห็ด, มอสซาเรลล่าชีส และซอสต้มยำ', 3, 1);

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
  ADD KEY `user_id` (`uid`),
  ADD KEY `oid` (`oid`),
  ADD KEY `pid` (`pid`);

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
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `pizza`
--
ALTER TABLE `pizza`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `sid` (`sid`);

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
  MODIFY `cartid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `crust`
--
ALTER TABLE `crust`
  MODIFY `cid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `oid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

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
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `pizza` (`pid`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `uid` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `pizza`
--
ALTER TABLE `pizza`
  ADD CONSTRAINT `cid` FOREIGN KEY (`cid`) REFERENCES `crust` (`cid`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `sid` FOREIGN KEY (`sid`) REFERENCES `size` (`sid`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

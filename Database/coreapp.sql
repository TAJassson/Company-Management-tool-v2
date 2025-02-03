-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2025 at 08:49 AM
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
-- Database: `coreapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `4pl_warehouse`
--

CREATE TABLE `4pl_warehouse` (
  `record_id` int(10) NOT NULL,
  `whs_name` varchar(1000) NOT NULL,
  `whs_address` varchar(1000) NOT NULL,
  `whs_token` varchar(1000) NOT NULL,
  `p_id` int(50) NOT NULL,
  `p_name` varchar(50) NOT NULL,
  `p_stock` int(255) NOT NULL,
  `p_img` varchar(100) NOT NULL,
  `p_cashpoint` int(255) NOT NULL,
  `p_state` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `4pl_warehouse`
--

INSERT INTO `4pl_warehouse` (`record_id`, `whs_name`, `whs_address`, `whs_token`, `p_id`, `p_name`, `p_stock`, `p_img`, `p_cashpoint`, `p_state`) VALUES
(1, 'Saint-Gobain Hong Kong Limited', '7 Wang Lok Street, Yuen Long', '48b3c5a4117a50c48d50dcc9e8b81138dbadfc31b7ffaca33913cd26a2f629bb', 1000, 'Saint-Gobain Weber : Easi Render 40KG', 150, 'img/4PL/P1.png', 12, 'enable'),
(2, 'Saint-Gobain Hong Kong Limited', '7 Wang Lok Street, Yuen Long', '48b3c5a4117a50c48d50dcc9e8b81138dbadfc31b7ffaca33913cd26a2f629bb', 1001, 'Saint-Gobain Weber : weberbase thick render', 150, 'img/4PL/P2.png', 12, 'enable'),
(3, 'Saint-Gobain Hong Kong Limited', '7 Wang Lok Street, Yuen Long', '48b3c5a4117a50c48d50dcc9e8b81138dbadfc31b7ffaca33913cd26a2f629bb', 1002, 'Saint-Gobain Weber : weberdry WP render coarse', 150, 'img/4PL/P3.png', 12, 'enable'),
(4, 'Saint-Gobain Hong Kong Limited', '7 Wang Lok Street, Yuen Long', '48b3c5a4117a50c48d50dcc9e8b81138dbadfc31b7ffaca33913cd26a2f629bb', 1003, 'Saint-Gobain Weber : weberfloor easi screed', 150, 'img/4PL/P4.png', 12, 'enable'),
(5, 'Saint-Gobain Hong Kong Limited', '7 Wang Lok Street, Yuen Long', '48b3c5a4117a50c48d50dcc9e8b81138dbadfc31b7ffaca33913cd26a2f629bb', 1004, 'Saint-Gobain Weber : weberdry wp screed', 150, 'img/4PL/P5.png', 950, 'enable'),
(6, 'Saint-Gobain Hong Kong Limited', '7 Wang Lok Street, Yuen Long', '48b3c5a4117a50c48d50dcc9e8b81138dbadfc31b7ffaca33913cd26a2f629bb', 1006, 'Saint-Gobain Weber : webergrout fine', 150, 'img/4PL/p6.png', 130, 'enable'),
(7, 'Saint-Gobain Hong Kong Limited', '7 Wang Lok Street, Yuen Long', '48b3c5a4117a50c48d50dcc9e8b81138dbadfc31b7ffaca33913cd26a2f629bb', 1007, 'Saint-Gobain Weber : weberfloor 550', 150, 'img/4PL/p7.png', 130, 'enable'),
(8, 'Saint-Gobain Hong Kong Limited', '7 Wang Lok Street, Yuen Long', '48b3c5a4117a50c48d50dcc9e8b81138dbadfc31b7ffaca33913cd26a2f629bb', 1008, 'Saint-Gobain Weber : weberep patchbond 25', 150, 'img/4PL/p8.png', 130, 'enable'),
(9, 'Saint-Gobain Hong Kong Limited', '7 Wang Lok Street, Yuen Long', '48b3c5a4117a50c48d50dcc9e8b81138dbadfc31b7ffaca33913cd26a2f629bb', 1009, 'Saint-Gobain Weber : weberep patchbond 40', 150, 'img/4PL/p9.png', 130, 'enable'),
(10, 'Saint-Gobain Hong Kong Limited', '7 Wang Lok Street, Yuen Long', '48b3c5a4117a50c48d50dcc9e8b81138dbadfc31b7ffaca33913cd26a2f629bb', 1010, 'Saint-Gobain Weber : weberdeko base (White)', 150, 'img/4PL/p10.png', 130, 'enable'),
(11, 'Saint-Gobain Hong Kong Limited', '7 Wang Lok Street, Yuen Long', '48b3c5a4117a50c48d50dcc9e8b81138dbadfc31b7ffaca33913cd26a2f629bb', 1011, 'Saint-Gobain Weber : weberdeko finish (White)', 150, 'img/4PL/p11.png', 130, 'enable'),
(15, 'Saint-Gobain Hong Kong Limited', '7 Wang Lok Street, Yuen Long', '48b3c5a4117a50c48d50dcc9e8b81138dbadfc31b7ffaca33913cd26a2f629bb', 1012, 'Saint-Gobain Weber : weberdeko putty', 150, 'img/4PL/p12.png', 130, 'enable'),
(16, 'Saint-Gobain Hong Kong Limited', '7 Wang Lok Street, Yuen Long', '48b3c5a4117a50c48d50dcc9e8b81138dbadfc31b7ffaca33913cd26a2f629bb', 1013, 'Saint-Gobain Weber : weberdeko putty', 150, 'img/4PL/p13.png', 130, 'enable'),
(17, 'Saint-Gobain Hong Kong Limited', '7 Wang Lok Street, Yuen Long', '48b3c5a4117a50c48d50dcc9e8b81138dbadfc31b7ffaca33913cd26a2f629bb', 1014, 'Saint-Gobain Weber : weberfloor 860', 150, 'img/4PL/p14.png', 130, 'enable'),
(18, 'Saint-Gobain Hong Kong Limited', '7 Wang Lok Street, Yuen Long', '48b3c5a4117a50c48d50dcc9e8b81138dbadfc31b7ffaca33913cd26a2f629bb', 1015, 'Saint-Gobain Weber : weberdeko rapifast HY', 150, 'img/4PL/p15.png', 130, 'enable');

-- --------------------------------------------------------

--
-- Table structure for table `branches_address`
--

CREATE TABLE `branches_address` (
  `b_location` varchar(50) NOT NULL,
  `b_address` varchar(200) NOT NULL,
  `b_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branches_address`
--

INSERT INTO `branches_address` (`b_location`, `b_address`, `b_id`) VALUES
('Tuen Mun', 'Room 103, 1/F, Block B<br>Hang Wai Industrial Centre<br>6 Kin Tai Street<br>TUEN MUN<br>NEW TERRITORIES', 1),
('Chai Wan', 'Flat 703, 7/F, Block A<br>Kailey Industrial Centre<br>CHAI WAN<br>HONG KONG', 2),
('Tseung Kwan O', 'Unit B11, PL1/F, Shopping Arcade<br>Nan Fung Plaza<br>TSEUNG KWAN O<br>NEW TERRITORIES', 4),
('Sha Tin', 'Shop 502, 5/F, Shopping Arcade<br>Grand Central Plaza<br>138 Sha Tin Rural Committee Road<br>SHA TIN<br>NEW TERRITORIES', 5),
('Yuen long (SGHK)', '7 Wang Lok Street, Yuen Long', 6);

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `name` varchar(100) NOT NULL,
  `phone` int(8) NOT NULL,
  `email` varchar(100) NOT NULL,
  `textarea` varchar(10000) NOT NULL,
  `id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `livechat_connected`
--

CREATE TABLE `livechat_connected` (
  `Connected` int(3) DEFAULT NULL,
  `Connected_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `livechat_connected`
--

INSERT INTO `livechat_connected` (`Connected`, `Connected_ID`) VALUES
(0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `livechat_user`
--

CREATE TABLE `livechat_user` (
  `UID` int(100) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(1000) NOT NULL,
  `Photo` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `livechat_user`
--

INSERT INTO `livechat_user` (`UID`, `Username`, `Email`, `Password`, `Photo`) VALUES
(2, 'Po Lam', 'Polam@gbm.com.hk', '67727a41b5b1d4dfca981e4045b1bb2f1e7fef0e3e8825c028949d186cad4c00', ''),
(9, 'Jason Tse', 'jason.tse@gmail.com', '', ''),
(10, 'Tony', 'Tony.l@123.com', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `product_info`
--

CREATE TABLE `product_info` (
  `p_id` int(10) NOT NULL,
  `p_name` varchar(50) NOT NULL,
  `p_description` varchar(50) NOT NULL,
  `p_category` varchar(50) NOT NULL,
  `p_cashpoint` int(10) NOT NULL,
  `p_img` varchar(50) NOT NULL,
  `p_state` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_info`
--

INSERT INTO `product_info` (`p_id`, `p_name`, `p_description`, `p_category`, `p_cashpoint`, `p_img`, `p_state`) VALUES
(1000, 'Saint-Gobain Weber : Easi Render 40KG', 'Render', 'Render', 150, 'img/4PL/P1.png', 'enable'),
(1001, 'Saint-Gobain Weber : weberbase thick render', 'Render', 'Render', 150, 'img/4PL/P2.png', 'enable'),
(1002, 'Saint-Gobain Weber : weberdry WP render coarse', 'Render', 'Render', 150, 'img/4PL/P3.png', 'enable'),
(1003, 'Saint-Gobain Weber : weberfloor easi screed', 'Screed', 'Screed', 150, 'img/4PL/P4.png', 'enable'),
(1004, 'Saint-Gobain Weber : weberdry wp screed', 'Screed', 'Screed', 150, 'img/4PL/P5.png', 'enable'),
(1005, 'Saint-Gobain Weber : webergrout fine', 'Grout', 'Grout', 150, 'img/4PL/p6.png', 'enable'),
(1006, 'Saint-Gobain Weber : weberfloor 550', 'Screed', 'Screed', 150, 'img/4PL/p7.png', 'enable'),
(1007, 'Saint-Gobain Weber : weberep patchbond 25', 'Patchbond', 'Patchbond', 150, 'img/4PL/p8.png', 'enable'),
(1008, 'Saint-Gobain Weber : weberep patchbond 40', 'Patchbond', 'Patchbond', 150, 'img/4PL/p9.png', 'enable'),
(1009, 'Saint-Gobain Weber : weberdeko base (White)', 'Deko', 'Deko', 150, 'img/4PL/p10.png', 'enable'),
(1010, 'Saint-Gobain Weber : weberdeko finish (White)', 'Deko', 'Deko', 150, 'img/4PL/p11.png', 'enable'),
(10000, 'Ascolite Ready Mix Mortar (40KG)', 'Mortar', 'Mortar', 50, 'img/P1.png', 'enable'),
(10002, 'Mapei Keraflex SG Mortar (20KG)', 'Mortar', 'Mortar', 38, 'img/P2.png', 'enable'),
(10005, 'RI-BOND Block Joint Mortar', 'Mortar', 'Mortar', 36, 'img/P3.png', 'enable'),
(10007, 'Emixi Mortar (40KG)', 'Mortar ', 'Mortar ', 37, 'img/P4.png', 'enable'),
(10015, 'PYE Tile Adhesive', 'Tile Adhesive', 'Adhesive', 15, 'img/P5.png', 'enable');

-- --------------------------------------------------------

--
-- Table structure for table `shoppingcart`
--

CREATE TABLE `shoppingcart` (
  `userID` int(10) NOT NULL,
  `p_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_info`
--

CREATE TABLE `stock_info` (
  `p_id` int(10) NOT NULL,
  `p_name` varchar(50) NOT NULL,
  `p_category` varchar(50) NOT NULL,
  `p_stock` int(255) NOT NULL,
  `p_img` varchar(1000) NOT NULL,
  `p_state` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_info`
--

INSERT INTO `stock_info` (`p_id`, `p_name`, `p_category`, `p_stock`, `p_img`, `p_state`) VALUES
(1000, 'Saint-Gobain Weber : Easi Render 40KG', 'Render', 1000, 'img/4PL/P1.png', 'enable'),
(1001, 'Saint-Gobain Weber : weberbase thick render', 'Render', 1000, 'img/4PL/P2.png', 'enable'),
(1002, 'Saint-Gobain Weber : weberdry WP render coarse', 'Render', 1000, 'img/4PL/P3.png', 'enable'),
(1003, 'Saint-Gobain Weber : weberfloor easi screed', 'Screed', 1000, 'img/4PL/P4.png', 'enable'),
(1004, 'Saint-Gobain Weber : weberdry wp screed', 'Screed', 1000, 'img/4PL/P5.png', 'enable'),
(1005, 'Saint-Gobain Weber : webergrout fine', 'Grout', 1000, 'img/4PL/p6.png', 'enable'),
(1006, 'Saint-Gobain Weber : weberfloor 550', 'Screed', 1000, 'img/4PL/p7.png', 'enable'),
(1007, 'Saint-Gobain Weber : weberep patchbond 25', 'Patchbond', 1000, 'img/4PL/p8.png', 'enable'),
(1008, 'Saint-Gobain Weber : weberep patchbond 40', 'Patchbond', 1000, 'img/4PL/p9.png', 'enable'),
(1009, 'Saint-Gobain Weber : weberdeko base (White)', 'Deko', 1000, 'img/4PL/p10.png', 'enable'),
(1010, 'Saint-Gobain Weber : weberdeko finish (White)', 'Deko', 1000, 'img/4PL/p11.png', 'enable'),
(10000, 'Ascolite Ready Mix Mortar (40KG)', 'Mortar', 1000, 'img/P1.png', 'enable'),
(10002, 'Mapei Keraflex SG Mortar (20KG)', 'Mortar', 1000, 'img/P2.png', 'enable'),
(10005, 'RI-BOND Block Joint Mortar', 'Mortar', 1000, 'img/P3.png', 'enable'),
(10007, 'Emixi Mortar (40KG)', 'Mortar', 1000, 'img/P4.png', 'enable'),
(10015, 'PYE Tile Adhesive', 'Adhesive', 1000, 'img/P5.png', 'enable'),
(10033, 'Optmix BP126 Base Plaster', 'Plaster', 1000, 'img/p6.jpg', 'enable'),
(10034, 'Optmix BP138 Base Plaster Waterproof', 'Plaster', 1000, 'img/p7.jpg', 'enable'),
(10035, 'Optmix FS161 Floor Screed (waterproofing)', 'Screed', 1000, 'img/p8.jpg', 'enable'),
(10036, 'Optmix FS161 Non-Shrink Grout', 'Grout', 1000, 'img/p9.jpg', 'enable'),
(10037, 'Optmix BP126 Base Plaster', 'Plaster', 1000, 'img/p6.jpg', 'enable'),
(10038, 'Optmix BP138 Base Plaster Waterproof', 'Plaster', 1000, 'img/p7.jpg', 'enable'),
(10039, 'Optmix FS161 Floor Screed (waterproofing)', 'Screed', 1000, 'img/p8.jpg', 'enable'),
(10040, 'Optmix FS161 Non-Shrink Grout', 'Grout', 1000, 'img/p9.jpg', 'enable');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `userID` int(10) NOT NULL,
  `role` char(1) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` mediumtext NOT NULL,
  `cashpoint` int(10) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone` int(8) NOT NULL,
  `email` varchar(50) NOT NULL,
  `br` varchar(8) DEFAULT NULL,
  `bank` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`userID`, `role`, `username`, `password`, `cashpoint`, `address`, `phone`, `email`, `br`, `bank`, `status`) VALUES
(7, '', 'manager', '', 0, '0', 0, '0', '0', '0', '0'),
(8, '1', 'warehouse', '', 0, '0', 0, '0', '0', '0', '0'),
(1027, '1', 'Jason Tse', 'aa41ed56f318abcde8e5561b756a094a346bb0795f4c18243ca030550589f275', 100000, 'Build King Hong Kong Limited<br>14<br>6/F, Tower B, Manulife Financial Centre, 223 Wai Yip Street<br>Kwun Tong, Kowloon, Hong Kong<br>Hong Kong', 33031320, 'jason.tse@buildking.hk', '2500443', '931-198770-346', 'enable'),
(1028, '1', 'Jason Nick', 'b65f6dc1d86e9565efa6863b03f0c8ed6bbcde630b9757257d4ad1cac1ee3b43', 68650, 'Gammon Construction Limited<br>22/F, Harbourfront Tower 1<br>77 Hoi Bun Road<br>Kwun Tong, Kowloon, Hong Kong<br>Hong Kong', 33304567, 'Jason.Nick@Gammon.com.hk', '12344213', '123-666734-1334', 'enable'),
(1029, '1', 'Nick Lau 1', '67727a41b5b1d4dfca981e4045b1bb2f1e7fef0e3e8825c028949d186cad4c00', 70000, 'Build King Hong Kong Limited<br>6/F, Tower B, Manulife Financial Centre<br>223 Wai Yip Street<br>Kwun Tong, Kowloon<br>Hong Kong', 33331320, 'Nick.lau1@buildking.hk', '2500443', '931-198770-346', 'enable');

-- --------------------------------------------------------

--
-- Table structure for table `user_order`
--

CREATE TABLE `user_order` (
  `orderID` int(10) NOT NULL,
  `userID` int(10) NOT NULL,
  `type_name` varchar(50) NOT NULL,
  `p_id` varchar(200) NOT NULL,
  `quantity` varchar(200) NOT NULL,
  `cashpoint` varchar(200) NOT NULL,
  `totalPrice` int(10) NOT NULL,
  `discount` int(10) NOT NULL,
  `n_totalPrice` int(10) NOT NULL,
  `b_name` varchar(50) NOT NULL,
  `b_address` varchar(200) NOT NULL,
  `user_address` varchar(200) NOT NULL,
  `order_time` datetime(6) NOT NULL,
  `getDate` date NOT NULL,
  `getTime` time(6) NOT NULL,
  `order_status` varchar(20) NOT NULL,
  `p_img` varchar(1000) NOT NULL,
  `p_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_order`
--

INSERT INTO `user_order` (`orderID`, `userID`, `type_name`, `p_id`, `quantity`, `cashpoint`, `totalPrice`, `discount`, `n_totalPrice`, `b_name`, `b_address`, `user_address`, `order_time`, `getDate`, `getTime`, `order_status`, `p_img`, `p_name`) VALUES
(202400037, 1028, 'Delivery', '1000<br>1002<br>1007', '1<br>1<br>1<br>', '150<br>150<br>150', 450, 0, 450, '', '', 'Gammon Construction Limited<br>22/F, Harbourfront Tower 1<br>77 Hoi Bun Road<br>Kwun Tong, Kowloon, Hong Kong<br>Hong Kong', '2025-01-26 14:13:54.000000', '2025-02-05', '12:00:00.000000', 'delivered', 'img/4PL/P1.png<br>img/4PL/P3.png<br>img/4PL/p8.png', 'Saint-Gobain Weber : weberep patchbond 25'),
(202400038, 1028, 'Delivery', '1000', '1<br>', '150', 150, 0, 150, '', '', '<br />\r\n<b>Warning</b>:  Undefined variable $address in <b>C:xampphtdocsconfirm.php</b> on line <b>265</b><br />\r\n', '2025-01-26 14:15:13.000000', '0000-00-00', '00:00:00.000000', 'delivered', 'img/4PL/P1.png', 'Saint-Gobain Weber : Easi Render 40KG'),
(202400039, 1029, 'Delivery', '1000', '100<br>', '150', 15000, 0, 15000, '', '', 'Build King Hong Kong Limited<br>6/F, Tower B, Manulife Financial Centre<br>223 Wai Yip Street<br>Kwun Tong, Kowloon<br>Hong Kong', '2025-01-26 14:46:44.000000', '2025-02-21', '15:46:00.000000', 'delivered', 'img/4PL/P1.png', 'Saint-Gobain Weber : Easi Render 40KG'),
(202400040, 1029, 'Delivery', '1000', '100<br>', '150', 15000, 0, 15000, '', '', 'Build King Hong Kong Limited<br>6/F, Tower B, Manulife Financial Centre<br>223 Wai Yip Street<br>Kwun Tong, Kowloon<br>Hong Kong', '2025-01-26 15:19:08.000000', '2025-01-31', '16:19:00.000000', 'delivered', 'img/4PL/P1.png', 'Saint-Gobain Weber : Easi Render 40KG'),
(202400041, 1028, 'Delivery', '1000', '100<br>', '150', 15000, 0, 15000, '', '', 'Gammon Construction Limited<br>22/F, Harbourfront Tower 1<br>77 Hoi Bun Road<br>Kwun Tong, Kowloon, Hong Kong<br>Hong Kong', '2025-01-26 15:24:50.000000', '2025-02-13', '15:24:00.000000', 'delivered', 'img/4PL/P1.png', 'Saint-Gobain Weber : Easi Render 40KG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `4pl_warehouse`
--
ALTER TABLE `4pl_warehouse`
  ADD PRIMARY KEY (`record_id`);

--
-- Indexes for table `branches_address`
--
ALTER TABLE `branches_address`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `livechat_connected`
--
ALTER TABLE `livechat_connected`
  ADD PRIMARY KEY (`Connected_ID`);

--
-- Indexes for table `livechat_user`
--
ALTER TABLE `livechat_user`
  ADD PRIMARY KEY (`UID`);

--
-- Indexes for table `product_info`
--
ALTER TABLE `product_info`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`userID`,`p_id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `stock_info`
--
ALTER TABLE `stock_info`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `user_order`
--
ALTER TABLE `user_order`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `userID` (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `4pl_warehouse`
--
ALTER TABLE `4pl_warehouse`
  MODIFY `record_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `branches_address`
--
ALTER TABLE `branches_address`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100013;

--
-- AUTO_INCREMENT for table `livechat_connected`
--
ALTER TABLE `livechat_connected`
  MODIFY `Connected_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `livechat_user`
--
ALTER TABLE `livechat_user`
  MODIFY `UID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_info`
--
ALTER TABLE `product_info`
  MODIFY `p_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10016;

--
-- AUTO_INCREMENT for table `stock_info`
--
ALTER TABLE `stock_info`
  MODIFY `p_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10041;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1030;

--
-- AUTO_INCREMENT for table `user_order`
--
ALTER TABLE `user_order`
  MODIFY `orderID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202400042;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD CONSTRAINT `shoppingcart_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user_info` (`userID`),
  ADD CONSTRAINT `shoppingcart_ibfk_2` FOREIGN KEY (`p_id`) REFERENCES `product_info` (`p_id`);

--
-- Constraints for table `user_order`
--
ALTER TABLE `user_order`
  ADD CONSTRAINT `user_order_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user_info` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

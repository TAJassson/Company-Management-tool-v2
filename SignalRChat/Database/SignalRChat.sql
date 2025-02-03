-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2022 at 04:14 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

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
CREATE DATABASE IF NOT EXISTS `coreapp` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `coreapp`;

-- --------------------------------------------------------

--
-- Table structure for table `livechat_user`
--

DROP TABLE IF EXISTS `livechat_user`;
CREATE TABLE `livechat_user` (
  `UID` int(100) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Username` varchar(500) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Photo` varchar(1000) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `livechat_connected`;
CREATE TABLE `livechat_user` (
  `Connected_ID` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Connected` int(10) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
--
-- Indexes for dumped tables
--

--
-- Indexes for table `atm`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

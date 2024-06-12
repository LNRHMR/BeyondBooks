-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2024 at 05:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beyondbooks`
--

-- --------------------------------------------------------

--
-- Table structure for table `approved`
--

CREATE TABLE `approved` (
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `studentnum` varchar(80) NOT NULL,
  `lastname` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `folderlocation` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `approved`
--

INSERT INTO `approved` (`date`, `studentnum`, `lastname`, `email`, `filename`, `folderlocation`) VALUES
('2024-06-09 15:40:46', '22-08556', 'Lunar', 'jomerlunar999@gmail.com', '22-08556_1717947646_Lunar - Cloud Computing.pdf', 'uploads/pdf'),
('2024-06-09 16:38:35', '22-06667', 'Eslita', 'eslita@gmail.com', '22-06667_1717951115_A-Deep-Dive-into-Firewalls.pdf', 'uploads/pdf'),
('2024-06-09 16:40:29', '22-08555', 'De Leon', 'deleon@gmail.com', '22-08555_1717951229_JAVA-SWING-GUI-module.docx', 'uploads/documents'),
('2024-06-10 12:08:55', '23-12400', 'Goza', 'goza@gmail.com', '23-12400_1718021335_IPS-Report.docx', 'uploads/documents'),
('2024-06-10 12:10:11', '22-08556', 'Lunar', 'jomerlunar999@gmail.com', '22-08556_1718021411_Describing Data - Quameth.xlsx', 'uploads/spreadsheets'),
('2024-06-10 12:18:31', '18-0623', 'Litada', 'litada@gmail.com', '18-0623_1718021911_Web Development Process Infographics.jpg', 'uploads/images');

-- --------------------------------------------------------

--
-- Table structure for table `declined`
--

CREATE TABLE `declined` (
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `studentnum` varchar(80) NOT NULL,
  `lastname` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `folderlocation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registered-user`
--

CREATE TABLE `registered-user` (
  `studentnum` varchar(80) NOT NULL,
  `lastname` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `pass` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registered-user`
--

INSERT INTO `registered-user` (`studentnum`, `lastname`, `email`, `pass`) VALUES
('18-0623', 'Litada', 'litada@gmail.com', 'litada18-0623'),
('22-06667', 'Eslita', 'eslita@gmail.com', 'eslita22-06667'),
('22-08555', 'De Leon', 'deleon@gmail.com', 'deleon22-08555'),
('22-08556', 'Lunar', 'jomerlunar999@gmail.com', 'lunar22-08556'),
('23-12400', 'Goza', 'goza@gmail.com', 'goza23-12400');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `studentnum` varchar(80) NOT NULL,
  `lastname` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `folderlocation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registered-user`
--
ALTER TABLE `registered-user`
  ADD PRIMARY KEY (`studentnum`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

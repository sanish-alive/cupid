-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2023 at 10:06 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cupid_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tb`
--

CREATE TABLE `admin_tb` (
  `email` text NOT NULL,
  `pwd` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_tb`
--

INSERT INTO `admin_tb` (`email`, `pwd`) VALUES
('admin@gmail.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `user_img`
--

CREATE TABLE `user_img` (
  `userid` int(5) NOT NULL,
  `image1` text NOT NULL,
  `image2` text NOT NULL,
  `image3` text NOT NULL,
  `image4` text NOT NULL,
  `image5` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_img`
--

INSERT INTO `user_img` (`userid`, `image1`, `image2`, `image3`, `image4`, `image5`) VALUES
(3, '1660925367.jpg', '0', '0', '0', '0'),
(4, '1660982073.jpg', '1662459320.png', '1662691605.jpg', '0', '0'),
(5, '0', '0', '0', '0', '0'),
(6, '1662289375.jpg', '1662289408.jpg', '0', '0', '0'),
(7, '0', '0', '0', '0', '0'),
(8, '0', '0', '0', '0', '0'),
(9, '0', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `user_match`
--

CREATE TABLE `user_match` (
  `user1` int(5) NOT NULL,
  `user2` int(5) NOT NULL,
  `matches` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_match`
--

INSERT INTO `user_match` (`user1`, `user2`, `matches`) VALUES
(4, 7, 'matched');

-- --------------------------------------------------------

--
-- Table structure for table `user_tb`
--

CREATE TABLE `user_tb` (
  `userid` int(10) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `email` text NOT NULL,
  `pass` text NOT NULL,
  `gender` varchar(7) NOT NULL,
  `height` int(5) NOT NULL,
  `age` int(3) NOT NULL,
  `bio` text NOT NULL,
  `profileImg` text NOT NULL,
  `oldSession` text NOT NULL,
  `alreadyvisited` int(10) NOT NULL,
  `block` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_tb`
--

INSERT INTO `user_tb` (`userid`, `firstname`, `lastname`, `email`, `pass`, `gender`, `height`, `age`, `bio`, `profileImg`, `oldSession`, `alreadyvisited`, `block`) VALUES
(3, 'hello', 'welcome', 'abc@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'Male', 646, 21, 'ytdnygfd', '1660925001.jpg', 'aka63ft6kfp8hnbufs7utthsj1', 0, 'block'),
(4, 'tsuki', 'bkkk', 'tsuki@gmail.com', '2904e9058d4aea14655d6b524112136b', 'Female', 153, 21, 'i am tsuki hello', '1660981925.jpg', '8p20rvo991jqsapdkljbf40tu9', 0, 'block'),
(5, 'akriti', 'kljjhgkj', 'akriti@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Female', 160, 21, 'hello my name is akiti', '1661006767.png', '', 0, 'block'),
(6, 'Gomin', 'Ham', 'gomin@gmail.com', '7ea92680ce158e7bfae71e3b0390cbdc', 'Male', 167, 21, 'home sweet home?\r\nEverest', '1662289228.jpg', 'g2q4i6cj2skb8klnsbtjsoaocs', 5, 'block'),
(7, 'test', 't', 'test@gmail.com', 'cc03e747a6afbbcbf8be7668acfebee5', 'Male', 156, 22, '', '1662687016.jpg', '8p20rvo991jqsapdkljbf40tu9', 5, 'block'),
(8, 'sanish', 'shrestha', 'shrestha@gmail.com', '22be6dbe4df26efa104cca3400d3d6b9', 'Male', 181, 21, 'hello my name is sanish...', '1667285851.jpg', 'k71lkccgeh5i766nvi8195u56p', 5, 'blk'),
(9, 'sanish', 'shrestha', 'sanish@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Male', 546, 21, 'hello everyone...', '1671879753.jpg', 'mhubdrf952rnitsmcjattsln4u', 0, 'blk');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tb`
--
ALTER TABLE `admin_tb`
  ADD PRIMARY KEY (`email`(50));

--
-- Indexes for table `user_img`
--
ALTER TABLE `user_img`
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `user_match`
--
ALTER TABLE `user_match`
  ADD PRIMARY KEY (`user1`);

--
-- Indexes for table `user_tb`
--
ALTER TABLE `user_tb`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_tb`
--
ALTER TABLE `user_tb`
  MODIFY `userid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_img`
--
ALTER TABLE `user_img`
  ADD CONSTRAINT `user_img_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user_tb` (`userid`);

--
-- Constraints for table `user_match`
--
ALTER TABLE `user_match`
  ADD CONSTRAINT `user_match_ibfk_1` FOREIGN KEY (`user1`) REFERENCES `user_tb` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

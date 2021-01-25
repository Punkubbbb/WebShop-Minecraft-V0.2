-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2019 at 01:51 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minecraft`
--

-- --------------------------------------------------------

--
-- Table structure for table `authme`
--

CREATE TABLE `authme` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `realname` varchar(255) NOT NULL,
  `password` varchar(255) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `ip` varchar(40) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL,
  `lastlogin` bigint(20) DEFAULT NULL,
  `x` double NOT NULL DEFAULT 0,
  `y` double NOT NULL DEFAULT 0,
  `z` double NOT NULL DEFAULT 0,
  `world` varchar(255) NOT NULL DEFAULT 'world',
  `regdate` bigint(20) NOT NULL DEFAULT 0,
  `regip` varchar(40) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL,
  `yaw` float DEFAULT NULL,
  `pitch` float DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `isLogged` smallint(6) NOT NULL DEFAULT 0,
  `hasSession` smallint(6) NOT NULL DEFAULT 0,
  `point` int(255) NOT NULL DEFAULT 0,
  `topup` int(255) NOT NULL DEFAULT 0,
  `rank` varchar(255) NOT NULL DEFAULT 'member'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `random_box`
--

CREATE TABLE `random_box` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `info` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `random_box`
--

INSERT INTO `random_box` (`id`, `name`, `info`, `price`, `image`) VALUES
(1, 'กล่องสุ่มเพรช', 'อิอิ', '50', 'coin.png');

-- --------------------------------------------------------

--
-- Table structure for table `random_item`
--

CREATE TABLE `random_item` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `percent` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `cmd` varchar(255) DEFAULT NULL,
  `point` varchar(255) DEFAULT NULL,
  `idbox` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `random_item`
--

INSERT INTO `random_item` (`id`, `name`, `percent`, `type`, `cmd`, `point`, `idbox`, `image`) VALUES
(1, 'Diamond', 60, 'point', '', '5', '1', 'logo.png'),
(2, 'Diamond2', 30, 'point', '', '5', '1', 'discord.png'),
(3, 'Diamond3', 10, 'point', '', '5', '1', 'coin.png');

-- --------------------------------------------------------

--
-- Table structure for table `site_logs`
--

CREATE TABLE `site_logs` (
  `id` int(11) NOT NULL,
  `tran` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `site_news`
--

CREATE TABLE `site_news` (
  `id` int(11) NOT NULL,
  `bg` varchar(255) NOT NULL,
  `text` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `site_news`
--

INSERT INTO `site_news` (`id`, `bg`, `text`, `date`) VALUES
(12, 'success', 'แก้ไข้ได้ที่หลังร้านครับ', '24/11/2019 19:36');

-- --------------------------------------------------------

--
-- Table structure for table `site_redeem`
--

CREATE TABLE `site_redeem` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `cmd` text DEFAULT NULL,
  `point` varchar(255) DEFAULT NULL,
  `claim` varchar(255) DEFAULT NULL,
  `server` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `site_redeem`
--

INSERT INTO `site_redeem` (`id`, `code`, `type`, `cmd`, `point`, `claim`, `server`) VALUES
(2, '1234', 'point', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `site_server`
--

CREATE TABLE `site_server` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ip_rcon` varchar(255) NOT NULL,
  `port_rcon` varchar(255) NOT NULL,
  `password_rcon` varchar(255) NOT NULL,
  `info` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `site_server`
--

INSERT INTO `site_server` (`id`, `name`, `ip_rcon`, `port_rcon`, `password_rcon`, `info`) VALUES
(6, 'Survival', '127.0.0.1', '25575', '123456', 'SERVER BUNGEE');

-- --------------------------------------------------------

--
-- Table structure for table `site_shop`
--

CREATE TABLE `site_shop` (
  `id` int(11) NOT NULL,
  `server` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `cmd` text NOT NULL,
  `price` varchar(255) NOT NULL DEFAULT '0',
  `count` varchar(255) NOT NULL DEFAULT '1',
  `image` varchar(255) NOT NULL,
  `buycount` int(11) NOT NULL DEFAULT 0,
  `info` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authme`
--
ALTER TABLE `authme`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `random_box`
--
ALTER TABLE `random_box`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `random_item`
--
ALTER TABLE `random_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_logs`
--
ALTER TABLE `site_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_news`
--
ALTER TABLE `site_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_redeem`
--
ALTER TABLE `site_redeem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_server`
--
ALTER TABLE `site_server`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_shop`
--
ALTER TABLE `site_shop`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authme`
--
ALTER TABLE `authme`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=599;

--
-- AUTO_INCREMENT for table `random_box`
--
ALTER TABLE `random_box`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `random_item`
--
ALTER TABLE `random_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `site_logs`
--
ALTER TABLE `site_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `site_news`
--
ALTER TABLE `site_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `site_redeem`
--
ALTER TABLE `site_redeem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `site_server`
--
ALTER TABLE `site_server`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `site_shop`
--
ALTER TABLE `site_shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

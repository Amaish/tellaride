-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 02, 2018 at 11:25 am
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tappsRide`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(5) NOT NULL,
  `phonenumber` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `phonenumber`, `password`, `name`) VALUES
(3, '+254716606563', '', '0'),
(4, '+254790807760', '', '0'),
(5, '+254727417454', '90bd4a843406d52b3f6f36f7c7c5f669f70359fb', 'Maina');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` int(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `phonenumber` varchar(15) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `session_id` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `trips` int(5) NOT NULL,
  `regno` varchar(7) NOT NULL,
  `engineSize` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `name`, `phonenumber`, `status`, `session_id`, `location`, `trips`, `regno`, `engineSize`) VALUES
(36, 'Limo', '+254780939303', 0, 'ATUid_d5b2acab58149c090963be48a8422cd7', 'Kasarani', 2, '', 0),
(37, 'noman', '+254724366469', 0, 'ATUid_ee2cb18cebee271b5768ef4fbcf695cd', 'Yaya Center', 2, '', 0),
(41, 'zaheer', '+254722514888', 1, 'ATUid_159deb8f177c798407dd52fc3a840425', 'Upper Hill', 0, '', 0),
(46, 'cindy', '+254722234673', 1, 'ATUid_428d28574d6460e90664dc6853e7b41d', 'Westlands', 0, '', 0),
(47, 'chair', '+254720985997', 0, 'ATUid_52f4c33751fae7e5fdd0535ffd1707fe', '', 0, '', 0),
(50, 'Anderson', '+254722471155', 0, 'ATUid_96165bc0c110856d02c85bd7d1eed989', '', 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `riders`
--

CREATE TABLE `riders` (
  `id` int(5) NOT NULL,
  `session_id` varchar(50) NOT NULL,
  `drivernumber` varchar(15) NOT NULL,
  `drivername` varchar(20) NOT NULL,
  `location` varchar(20) NOT NULL,
  `distance` varchar(5) NOT NULL,
  `time` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP
) ;

--
-- Dumping data for table `riders`
--

INSERT INTO `riders` (`id`, `session_id`, `drivernumber`, `drivername`, `location`, `distance`, `time`) VALUES
(7, 'ATUid_75c213b3cbbb2a820cbbd6be0b290b1a', '+254722514888', 'Zaheer', 'Kasarani', '0 KM', '2018-07-23 09:26:09.363926'),
(8, 'ATUid_ab84dbfcd4ecb5d177575a570f605a8c', '+254713454529', 'Tinny', 'Kasarani', '0 KM', '2018-07-23 09:55:09.970225'),
(9, 'ATUid_0c203ab1977f769df508ab5cb905f0f7', '+254727417454', 'Zaheer', 'Kasarani', '0 KM', '2018-07-23 09:32:29.379712'),
(11, 'ATUid_42f8426478920cfcc0be788f8fa3fae7', '+254780939303', 'Limo', 'Kasarani', '0 KM', '2018-08-01 06:57:41.084845'),
(12, 'ATUid_b9475681fab5fa40e748ac1eb370a387', '+254724366469', 'noman', '', '18 KM', '2018-07-24 18:48:19.023615'),
(13, 'ATUid_95db07349958237e74e8d0623fe6ea1e', '+254', 'Cindy', '', '4 KM', '2018-07-28 18:47:43.993959');

-- --------------------------------------------------------

--
-- Table structure for table `session_levels`
--

CREATE TABLE `session_levels` (
  `id` int(6) NOT NULL,
  `phonenumber` varchar(15) NOT NULL,
  `level` tinyint(1) NOT NULL,
  `session_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `session_levels`
--

INSERT INTO `session_levels` (`id`, `phonenumber`, `level`, `session_id`) VALUES
(5, '+254790807760', 0, 'ATUid_db3e3a70e070eb033a4fcfac7a75ea7f'),
(6, '+254713454529', 0, 'ATUid_6899de8475237ebe5eb82ee0817aae99'),
(7, '+254722514888', 1, 'ATUid_b9d749d5ecc8ed5732f374a0d5013218'),
(8, '+254718979084', 0, 'ATUid_ae6591e4de9052c79b1bac875490f5fc'),
(9, '+254727417454', 0, 'ATUid_a0b4441512e5ad3ba4c5bfdaa46f7932'),
(10, '+254722471155', 0, 'ATUid_b7db8b3e27cbe44c72c3d66490eecaaa'),
(11, '+254722390326', 0, 'ATUid_f7f375641e6cb92a5ed8dd4a180fb3fe'),
(12, '+254724587654', 0, 'ATUid_0c203ab1977f769df508ab5cb905f0f7'),
(13, '+254716606563', 1, 'ATUid_5cd7512f6865cc483423090ad4dcff04'),
(14, '+254703909510', 0, 'ATUid_15137b878bb11ca155562adacf6e1b46'),
(15, '+254797690350', 0, 'ATUid_b9475681fab5fa40e748ac1eb370a387'),
(16, '+254724366469', 0, 'ATUid_214d9efffa0f5838698571ccb08fd549'),
(17, '+254722523667', 0, 'ATUid_1e38a6dec09fd2cb90794dfec58fecc5'),
(18, '+254722234673', 0, 'ATUid_95db07349958237e74e8d0623fe6ea1e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `session_levels`
--
ALTER TABLE `session_levels`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `riders`
--
ALTER TABLE `riders`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `session_levels`
--
ALTER TABLE `session_levels`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

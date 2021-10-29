-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 20, 2021 at 09:02 AM
-- Server version: 5.7.33-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `checkusertyt`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorysg`
--

CREATE TABLE `categorysg` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL DEFAULT '0',
  `subAdmin` varchar(50) NOT NULL DEFAULT '0',
  `subAdmin2` varchar(50) NOT NULL DEFAULT '0',
  `subAdmin3` varchar(50) NOT NULL DEFAULT '0',
  `subAdmin4` varchar(50) NOT NULL DEFAULT '0',
  `subAdmin5` varchar(50) NOT NULL DEFAULT '0',
  `date` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categorysg`
--

INSERT INTO `categorysg` (`id`, `category`, `subAdmin`, `subAdmin2`, `subAdmin3`, `subAdmin4`, `subAdmin5`, `date`) VALUES
(34, 'Withdraw-Problem', 'withdraw', 'Problem solved', '0', '0', '0', '04 Jul 21 08:40 PM'),
(31, 'Deposit-Problem', 'Dproblem', 'Problem solved', '0', '0', '0', '04 Jul 21 06:35 PM'),
(33, 'Bet-Result-Problem', 'Bet solved', 'Problem solved', '0', '0', '0', '04 Jul 21 06:36 PM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorysg`
--
ALTER TABLE `categorysg`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorysg`
--
ALTER TABLE `categorysg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

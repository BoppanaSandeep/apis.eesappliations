-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2018 at 02:57 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ees`
--

-- --------------------------------------------------------

--
-- Table structure for table `eesalogin`
--

CREATE TABLE `eesalogin` (
  `eesaId` int(255) NOT NULL,
  `name` text NOT NULL,
  `emailId` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `addedDate` datetime NOT NULL,
  `editedDate` datetime NOT NULL,
  `ipaddress` varchar(255) NOT NULL,
  `status` int(10) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eesalogin`
--

INSERT INTO `eesalogin` (`eesaId`, `name`, `emailId`, `password`, `addedDate`, `editedDate`, `ipaddress`, `status`) VALUES
(1, 'Sandeep', 'sandeepb@eesapplications.website', '$2y$10$6ix2P9n5jJNtep1jfcddr.r1w5l3iqs2jHN9uI.ng.FVWGt6xhzLy', '2018-10-19 17:16:54', '0000-00-00 00:00:00', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eesalogin`
--
ALTER TABLE `eesalogin`
  ADD PRIMARY KEY (`eesaId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eesalogin`
--
ALTER TABLE `eesalogin`
  MODIFY `eesaId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 19, 2022 at 06:22 PM
-- Server version: 10.3.34-MariaDB-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tparlap_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `CREDENTIALS`
--

CREATE TABLE IF NOT EXISTS `CREDENTIALS` (
  `IuEmail` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  PRIMARY KEY (`IuEmail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `RIDER`
--

CREATE TABLE IF NOT EXISTS `RIDER` (
  `IuEmail` varchar(50) NOT NULL,
  `Date` varchar(50) NOT NULL,
  `PickupPoint` varchar(50) NOT NULL,
  `Time` varchar(50) NOT NULL,
  `AvailableSeats` varchar(50) NOT NULL,
  `Description` varchar(50) NOT NULL,
  PRIMARY KEY (`IuEmail`,`Date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `USER`
--

CREATE TABLE IF NOT EXISTS `USER` (
  `IuEmail` varchar(50) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `UserPhone` varchar(50) NOT NULL,
  `UserAddress` varchar(50) NOT NULL,
  PRIMARY KEY (`IuEmail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

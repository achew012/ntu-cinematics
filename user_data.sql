-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2018 at 03:14 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `current_movies`
--

CREATE TABLE `current_movies` (
  `MOVIE_ID` text NOT NULL,
  `MOVIE_NAME` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `current_movies`
--

INSERT INTO `current_movies` (`MOVIE_ID`, `MOVIE_NAME`) VALUES
('001', 'CRAZY RICH ASIANS'),
('002', 'THE FIRST PURGE'),
('003', 'DOWN A DARK HALL');

-- --------------------------------------------------------

--
-- Table structure for table `loc_address`
--

CREATE TABLE `loc_address` (
  `MOVIE_ID` text NOT NULL,
  `MOVIE_NAME` text NOT NULL,
  `CINEMA_ID` text NOT NULL,
  `CINEMA` text NOT NULL,
  `DAY` text NOT NULL,
  `TIME` text NOT NULL,
  `TIMESTAMP` text NOT NULL,
  `UNIQUE_ID` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loc_address`
--

INSERT INTO `loc_address` (`MOVIE_ID`, `MOVIE_NAME`, `CINEMA_ID`, `CINEMA`, `DAY`, `TIME`, `TIMESTAMP`, `UNIQUE_ID`) VALUES
('001', 'CRAZY RICH ASIANS', '001', 'JURONG', '001', '001', '10:00:00', '001001001001'),
('001', 'CRAZY RICH ASIANS', '001', 'JURONG', '001', '002', '12:30:00', '001001001002'),
('001', 'CRAZY RICH ASIANS', '001', 'JURONG', '001', '003', '15:30:00', '001001001003'),
('001', 'CRAZY RICH ASIANS', '001', 'JURONG', '001', '004', '17:00:00', '001001001004'),
('001', 'CRAZY RICH ASIANS', '001', 'JURONG', '002', '001', '11:15:00', '001001002001'),
('001', 'CRAZY RICH ASIANS', '001', 'JURONG', '002', '002', '12:50:00', '001001002002'),
('001', 'CRAZY RICH ASIANS', '001', 'JURONG', '002', '003', '15:50:00', '001001002003'),
('001', 'CRAZY RICH ASIANS', '001', 'JURONG', '002', '004', '17:00:00', '001001002004'),
('001', 'CRAZY RICH ASIANS', '002', 'YISHUN', '001', '001', '11:25:00', '001002001001'),
('001', 'CRAZY RICH ASIANS', '002', 'YISHUN', '001', '002', '13:50:00', '001002001002'),
('001', 'CRAZY RICH ASIANS', '002', 'YISHUN', '001', '003', '16:00:00', '001002001003'),
('001', 'CRAZY RICH ASIANS', '002', 'YISHUN', '001', '004', '17:30:00', '001002001004'),
('001', 'CRAZY RICH ASIANS', '002', 'YISHUN', '002', '001', '11:25:00', '001002002001'),
('001', 'CRAZY RICH ASIANS', '002', 'YISHUN', '002', '002', '13:50:00', '001002002002'),
('001', 'CRAZY RICH ASIANS', '002', 'YISHUN', '002', '003', '16:00:00', '001002002003'),
('001', 'CRAZY RICH ASIANS', '002', 'YISHUN', '002', '004', '17:30:00', '001002002004'),
('002', 'THE FIRST PURGE', '001', 'JURONG', '001', '001', '11:25:00', '002001001001'),
('002', 'THE FIRST PURGE', '001', 'JURONG', '001', '002', '13:50:00', '002001001002'),
('002', 'THE FIRST PURGE', '001', 'JURONG', '001', '003', '16:00:00', '002001001003'),
('002', 'THE FIRST PURGE', '001', 'JURONG', '001', '004', '17:30:00', '002001001004'),
('002', 'THE FIRST PURGE', '001', 'JURONG', '002', '001', '11:55:00', '002001002001'),
('002', 'THE FIRST PURGE', '001', 'JURONG', '002', '002', '14:00:00', '002001002002'),
('002', 'THE FIRST PURGE', '001', 'JURONG', '002', '003', '15:40:00', '002001002003'),
('002', 'THE FIRST PURGE', '001', 'JURONG', '002', '004', '17:20:00', '002001002004'),
('002', 'THE FIRST PURGE', '002', 'YISHUN', '001', '001', '11:05:00', '002002001001'),
('002', 'THE FIRST PURGE', '002', 'YISHUN', '001', '002', '13:00:00', '002002001002'),
('002', 'THE FIRST PURGE', '002', 'YISHUN', '001', '003', '14:20:00', '002002001003'),
('002', 'THE FIRST PURGE', '002', 'YISHUN', '001', '004', '17:00:00', '002002001004'),
('002', 'THE FIRST PURGE', '002', 'YISHUN', '002', '001', '11:25:00', '002002002001'),
('002', 'THE FIRST PURGE', '002', 'YISHUN', '002', '002', '12:50:00', '002002002002'),
('002', 'THE FIRST PURGE', '002', 'YISHUN', '002', '003', '15:00:00', '002002002003'),
('002', 'THE FIRST PURGE', '002', 'YISHUN', '002', '004', '18:30:00', '002002002004');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_history`
--

CREATE TABLE `purchase_history` (
  `userid` text NOT NULL,
  `purchasedate` text NOT NULL,
  `moviedate` text NOT NULL,
  `quantity` text NOT NULL,
  `purchasevalue` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `unique_seats`
--

CREATE TABLE `unique_seats` (
  `UNIQUE_ID` text NOT NULL,
  `SEAT_NO` text NOT NULL,
  `DATETIME` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unique_seats`
--

INSERT INTO `unique_seats` (`UNIQUE_ID`, `SEAT_NO`, `DATETIME`) VALUES
('001001001001', '0', '2018-10-21 10:00:00'),
('001001001001', '1', '2018-10-21 10:00:00'),
('001001001001', '2', '2018-10-21 10:00:00'),
('001001001002', '3', '2018-10-21 12:30:00'),
('001001001002', '13', '2018-10-21 12:30:00'),
('001001001002', '4', '2018-10-21 12:30:00'),
('001001001002', '12', '2018-10-21 12:30:00'),
('001001002003', '1', '2018-10-21 15:50:00'),
('001001002003', '12', '2018-10-21 15:50:00'),
('001001002003', '0', '2018-10-21 15:50:00'),
('001001002003', '16', '2018-10-21 15:50:00'),
('001001002003', '13', '2018-10-21 15:50:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `userid` text NOT NULL,
  `name` text NOT NULL,
  `password` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `cardno` text NOT NULL,
  `address` text NOT NULL,
  `ccv` text NOT NULL,
  `registerdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cardtype` varchar(10) DEFAULT NULL,
  `postalcode` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`userid`, `name`, `password`, `email`, `cardno`, `address`, `ccv`, `registerdate`, `cardtype`, `postalcode`) VALUES
('ar2or', 'Aaron', '123456', 'arop999@hotmail.com', 'NTUHALL10', '1234567890123456', '111', '2018-10-02 16:31:00', NULL, NULL),
('aa2ii', 'Kai', '123456', 'kai@yen.com', 'crescent', '1234567890123456', '123', '2018-10-03 10:57:24', NULL, NULL),
('ii2@c', 'yicongfaggy', '123456', 'yi@cong.com', 'tanjonghall', '1234567890123456', '123', '2018-10-03 13:18:36', NULL, NULL),
('0aa73acded4fe0b62e573718e5f57d0a88bca0b8', 'yicong', '123123', 'ohyicong123@hotmail.com', 'asdasd', '1234512345123451', '123', '2018-10-19 11:11:57', '', NULL),
('1231123123123', 'yicong', 'asdasd', 'asdjkjk@hotmail.com', '123123123', 'asdasdsdaasd', '123', '2018-10-19 11:11:57', 'mastercard', NULL),
('84bd79cf88d070964dc8b955357ff6352299a55a', 'yicong', '123123', 'ohyicong1123@hotmail.com', 'asdasdasd', '1234512345123451', '123', '2018-10-19 11:21:38', 'Mastercard', NULL),
('0aa73acded4fe0b62e573718e5f57d0a88bca0b8', 'yicong', '123123', 'ohyicong123@hotmail.com', 'asdasd', '1234512345123451', '123', '2018-10-19 11:22:43', '', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

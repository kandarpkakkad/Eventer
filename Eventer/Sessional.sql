-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 19, 2020 at 04:27 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Sessional`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `uname` varchar(40) NOT NULL,
  `pswd` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`uname`, `pswd`) VALUES
('admin', '$1$somethin$7on2JM7JeqSXcukty0bPq.'),
('admin2', '$1$somethin$NVaMmYiyimlmX7mkKqs9J1');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `ename` varchar(40) NOT NULL,
  `description` varchar(255) NOT NULL,
  `edate` date NOT NULL,
  `etime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`ename`, `description`, `edate`, `etime`) VALUES
('Event1', 'Sports event', '2020-06-10', '19:00:00'),
('Event3', 'This is Event 3', '2020-12-15', '18:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `fname` varchar(40) NOT NULL,
  `lname` varchar(40) NOT NULL,
  `bdate` date NOT NULL,
  `uname` varchar(40) NOT NULL,
  `pswd` varchar(40) NOT NULL,
  `rno` varchar(40) NOT NULL,
  `emailid` varchar(40) NOT NULL,
  `e1` varchar(40) NOT NULL DEFAULT '0',
  `e2` varchar(40) NOT NULL DEFAULT '0',
  `e3` varchar(40) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`fname`, `lname`, `bdate`, `uname`, `pswd`, `rno`, `emailid`, `e1`, `e2`, `e3`) VALUES
('Kandarp', 'Kakkad', '1998-12-05', 'kandarpbkakkad', '$1$somethin$w3SfTt2UsaOJINTsjw30w/', '17BIT034', '17bit034@nirmauni.ac.in', 'Event1', 'Event3', '0'),
('Siddharth', 'Marvania', '1998-12-15', 'sjmarvania', '$1$somethin$geb0tMjOlpGx.Mlqvysh..', '17BIT046', '17bit046@nirmauni.ac.in', 'Event1', '0', '0');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2016 at 08:03 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `try`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE IF NOT EXISTS `bank` (
  `Name` varchar(30) NOT NULL,
  `email_id` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `Card` varchar(50) NOT NULL,
  `CVV` int(3) NOT NULL,
  `Expiry` year(4) NOT NULL,
  `Amount` int(15) DEFAULT NULL,
  `otp` varchar(10) NOT NULL DEFAULT '454545'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`Name`, `email_id`, `password`, `Card`, `CVV`, `Expiry`, `Amount`, `otp`) VALUES
('Abhishek Bishnoi', 'abhi.bishnoi1212@gmail.com', 'abhishek', '4591520036541259', 124, 2021, 100, '454545'),
('rait', 'as@rait.com', 'rait', '4512', 341, 2022, 2500, '454545'),
('Rohan Mandloi', 'mandloi.rohan@gmail.com', 'rohan', '4591510053914581', 341, 2018, 2000, '97149b');

-- --------------------------------------------------------

--
-- Table structure for table `fixed`
--

CREATE TABLE IF NOT EXISTS `fixed` (
  `type` varchar(50) NOT NULL,
  `cost` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fixed`
--

INSERT INTO `fixed` (`type`, `cost`) VALUES
('exam', 560),
('kt', 500),
('bundles', 45),
('files', 15),
('id', 500);

-- --------------------------------------------------------

--
-- Table structure for table `stationary`
--

CREATE TABLE IF NOT EXISTS `stationary` (
  `SEM` varchar(15) NOT NULL,
  `DEPARTMENT` varchar(30) NOT NULL,
  `cost` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stationary`
--

INSERT INTO `stationary` (`SEM`, `DEPARTMENT`, `cost`) VALUES
('5', 'Computer Engineering', 700);

-- --------------------------------------------------------

--
-- Table structure for table `studentdetail`
--

CREATE TABLE IF NOT EXISTS `studentdetail` (
  `ID` varchar(11) NOT NULL,
  `FIRSTNAME` varchar(255) NOT NULL,
  `LASTNAME` varchar(255) NOT NULL,
  `YEAR` int(10) NOT NULL,
  `DEPARTMENT` varchar(255) NOT NULL,
  `TELEPHONENO` int(50) NOT NULL,
  `TYPE` varchar(20) NOT NULL DEFAULT 'General',
  `BATCH` int(10) NOT NULL,
  `SEMESTER` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentdetail`
--

INSERT INTO `studentdetail` (`ID`, `FIRSTNAME`, `LASTNAME`, `YEAR`, `DEPARTMENT`, `TELEPHONENO`, `TYPE`, `BATCH`, `SEMESTER`, `password`) VALUES
('11EE4567', 'Rajkumar', 'Shinde', 4, 'Electrical Engineering', 2147483647, 'OBC', 2011, '6', 'rajkumar'),
('12CE1022', 'Mohit', 'Gulla', 3, 'Information Technology', 2147483647, 'SC', 2012, '', 'mohit'),
('12CE4562', 'Aditya', 'Rao', 3, 'Computer Engineering', 2147483647, 'General', 2012, '5', 'aditya');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
`ID` int(10) NOT NULL,
  `Roll_no` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Amount` int(10) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tutionfee`
--

CREATE TABLE IF NOT EXISTS `tutionfee` (
  `BATCH` int(10) NOT NULL,
  `TYPE` varchar(255) NOT NULL DEFAULT 'General',
  `YEAR` int(10) NOT NULL,
  `COST` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tutionfee`
--

INSERT INTO `tutionfee` (`BATCH`, `TYPE`, `YEAR`, `COST`) VALUES
(2012, 'SC', 3, 26548),
(2011, 'OBC', 3, 45678),
(2011, 'OBC', 4, 45675);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
 ADD PRIMARY KEY (`email_id`), ADD UNIQUE KEY `Card` (`Card`);

--
-- Indexes for table `studentdetail`
--
ALTER TABLE `studentdetail`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
 ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

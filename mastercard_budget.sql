-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2015 at 03:39 PM
-- Server version: 5.5.44-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mastercard_budget`
--

-- --------------------------------------------------------

--
-- Table structure for table `Budget`
--

CREATE TABLE IF NOT EXISTS `Budget` (
  `budget_id` int(40) NOT NULL,
  `total` int(255) DEFAULT NULL,
  `Food` int(255) DEFAULT NULL,
  `Rent` int(255) DEFAULT NULL,
  `Utility` int(255) DEFAULT NULL,
  `Transport` int(255) DEFAULT NULL,
  `Other` int(255) DEFAULT NULL,
  PRIMARY KEY (`budget_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Budget`
--

INSERT INTO `Budget` (`budget_id`, `total`, `Food`, `Rent`, `Utility`, `Transport`, `Other`) VALUES
(0, NULL, 300, 1500, 300, 100, 200),
(2, 5000, 1000, 2000, 1000, 200, 500),
(3, 10000, 8287, 8, 848, 847, 838);

-- --------------------------------------------------------

--
-- Table structure for table `Profile`
--

CREATE TABLE IF NOT EXISTS `Profile` (
  `user_id` int(40) NOT NULL,
  `budget_id` int(40) NOT NULL,
  `cycle` varchar(10) NOT NULL DEFAULT 'B'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Profile`
--

INSERT INTO `Profile` (`user_id`, `budget_id`, `cycle`) VALUES
(0, 0, 'B'),
(4, 2, 'B'),
(5, 3, 'B');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `user_id` int(40) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `fname` varchar(20) DEFAULT NULL,
  `lname` varchar(20) DEFAULT NULL,
  `salary` int(255) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`user_id`, `username`, `password`, `fname`, `lname`, `salary`, `email`) VALUES
(0, 'admin', 'password', 'a', 'b', NULL, 'example@gmail.com'),
(4, 'jimmyyuan', '$2y$10$HyIkS0ZKWuHYupLGASVWc.l607er6NfjgPiQpO693znKyJzkcH9/q', 'Jimmy', 'Yuan', NULL, 'jimmixrulez@gmail.com'),
(5, 'minling1', '$2y$10$VPPBFZhI60mYT3iBYV5if.PhhTZE42ET69it1G7oAwlvTorzzPzE.', 'minling2', 'zhao', NULL, 'minling@gmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

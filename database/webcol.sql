-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 23, 2016 at 02:23 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `webcol`
--

-- --------------------------------------------------------

--
-- Table structure for table `fe`
--

CREATE TABLE IF NOT EXISTS `fe` (
  `serial_division` int(11) NOT NULL AUTO_INCREMENT,
  `division` varchar(255) NOT NULL,
  `serial_sub_div` int(11) NOT NULL,
  `practical` varchar(11) DEFAULT NULL,
  `assignment` varchar(11) DEFAULT NULL,
  `ppt` varchar(11) DEFAULT NULL,
  `qb` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`serial_division`),
  KEY `serial_sub_div` (`serial_sub_div`,`practical`,`assignment`,`ppt`,`qb`),
  KEY `division` (`division`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `fe`
--


-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `serial_files` int(11) NOT NULL AUTO_INCREMENT,
  `serial` int(11) NOT NULL,
  `serial_sub_div` int(11) NOT NULL,
  `serial_division` int(11) NOT NULL,
  `practical_url` varchar(255) NOT NULL,
  `assignment_url` varchar(255) NOT NULL,
  `ppt_url` varchar(255) NOT NULL,
  `qb_url` varchar(255) NOT NULL,
  PRIMARY KEY (`serial_files`),
  KEY `serial` (`serial`,`serial_sub_div`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `files`
--


-- --------------------------------------------------------

--
-- Table structure for table `relation`
--

CREATE TABLE IF NOT EXISTS `relation` (
  `serial_sub_div` int(11) NOT NULL AUTO_INCREMENT,
  `serial` int(11) NOT NULL,
  `PID` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  PRIMARY KEY (`serial_sub_div`),
  KEY `serial` (`serial`,`class`),
  KEY `PID` (`PID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `relation`
--


-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `serial` int(11) NOT NULL AUTO_INCREMENT,
  `yrdiv` varchar(255) NOT NULL,
  `sem` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`serial`),
  KEY `sem` (`sem`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`serial`, `yrdiv`, `sem`, `name`) VALUES
(1, 'fe', 1, 'Applied Maths 1'),
(2, 'fe', 1, 'Applied Physics 1'),
(3, 'fe', 1, 'Applied Chemistry 1'),
(4, 'fe', 1, 'Engineering Mechanics'),
(5, 'fe', 1, 'BEE'),
(6, 'fe', 1, 'Environmental Studies'),
(7, 'fe', 2, 'Applied  Mathematics 2'),
(8, 'fe', 2, 'Applied Physics 2'),
(9, 'fe', 2, 'Applied Chemistry 2'),
(10, 'fe', 2, 'Engineering Drawing'),
(11, 'fe', 2, 'Structured Programming Approach'),
(12, 'fe', 2, 'Communication Skills'),
(13, 'seit', 3, 'Applied Mathematics 3'),
(14, 'seit', 3, 'Data Structure and Algorithm Analysis'),
(15, 'seit', 3, 'Object Oriented Programming  Methodology'),
(16, 'seit', 3, 'Analog and Digital Circuits'),
(17, 'seit', 3, 'Database Management  Systems'),
(18, 'seit', 3, 'Principles Of Analog And  Digital Communication');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `serial` int(11) NOT NULL AUTO_INCREMENT,
  `PID` varchar(255) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL DEFAULT 'photo/admin.jpg',
  `timestamp` varchar(255) NOT NULL,
  PRIMARY KEY (`serial`),
  UNIQUE KEY `username` (`username`),
  KEY `PID` (`PID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `user`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `fe`
--
ALTER TABLE `fe`
  ADD CONSTRAINT `fe_ibfk_1` FOREIGN KEY (`serial_sub_div`) REFERENCES `relation` (`serial_sub_div`);

--
-- Constraints for table `relation`
--
ALTER TABLE `relation`
  ADD CONSTRAINT `relation_ibfk_3` FOREIGN KEY (`serial`) REFERENCES `subject` (`serial`),
  ADD CONSTRAINT `relation_ibfk_4` FOREIGN KEY (`PID`) REFERENCES `user` (`PID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

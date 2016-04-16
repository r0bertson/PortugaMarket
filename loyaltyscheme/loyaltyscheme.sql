-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 15, 2011 at 01:00 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `loyaltyscheme`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `ID` INT(8) ZEROFILL NOT NULL PRIMARY KEY auto_increment,
  `pwd` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `firstname` VARCHAR(40) NOT NULL,
  `lastname` VARCHAR(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `history` (
  `ID` INT(8)  NOT NULL PRIMARY KEY,
  `date` date NOT NULL,
  `points` varchar(40) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Table structure for table `creditCard`
--
CREATE TABLE IF NOT EXISTS `creditCard` (
  `ID` INT(8) ZEROFILL NOT NULL PRIMARY KEY auto_increment,
  `cardNumber` INT(16) NOT NULL,
  `confCode` INT (3) NOT NULL,
  `monthvalid` INT(2) NOT NULL,
  `yearvalid` INT (4) NOT NULL,
  `pwd` varchar(15) NOT NULL,
  `firstname` VARCHAR(40) NOT NULL,
  `lastname` VARCHAR(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


--
-- Table structure for table `payPal`
--
CREATE TABLE IF NOT EXISTS `payPal` (
  `ID` INT(8) ZEROFILL NOT NULL PRIMARY KEY auto_increment,
  `email` varchar(40) NOT NULL,
  `pwd` varchar(15) NOT NULL,
  `firstname` VARCHAR(40) NOT NULL,
  `lastname` VARCHAR(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Inserting initial data for table `clients`
--
INSERT INTO `clients` (`ID`, `email`, `pwd`, `firstname`, `lastname`) VALUES
(NULL, 'kingarthur@uwl.ac.uk', 'england', 'king', 'arthur'),
(NULL, 'adele@uwl.ac.uk', 'hello', 'the', 'adele');

--
-- Inserting initial data for table `creditCard`
--
INSERT INTO `creditCard` (`ID`, `cardNumber`, `confCode`, `monthvalid`, `yearvalid`, `pwd`, `firstname` , `lastname`) VALUES
(NULL, '4004982711226988', '882', '01', '2018', 'england', 'king', 'arthur'),
(NULL, '7229982715677261', '121', '10', '2020', 'hello', 'the', 'adele');

--
-- Inserting initial data for table `payPal`
--
INSERT INTO `payPal` (`ID`, `email`, `pwd`, `firstname`, `lastname`) VALUES
(NULL, 'kingarthur@uwl.ac.uk', 'england', 'king', 'arthur'),
(NULL, 'adele@uwl.ac.uk', 'hello', 'the', 'adele');





/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

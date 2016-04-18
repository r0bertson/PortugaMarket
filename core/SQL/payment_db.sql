-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 16-Abr-2016 às 16:28
-- Versão do servidor: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payment_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `creditcard`
--

DROP TABLE IF EXISTS `creditcard`;
CREATE TABLE IF NOT EXISTS `creditcard` (
  `cardnumber` varchar(16) DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `expiration` int(4) DEFAULT NULL,
  `security` varchar(3) DEFAULT NULL,
  `credit_total` int(11) DEFAULT NULL,
  `credit_available` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `creditcard`
--

INSERT INTO `creditcard` (`cardnumber`, `name`, `expiration`, `security`, `credit_total`, `credit_available`) VALUES
('1234123412341234', 'robertson lima', 2020, '111', 2000, 1980);

-- --------------------------------------------------------

--
-- Estrutura da tabela `paypal`
--

DROP TABLE IF EXISTS `paypal`;
CREATE TABLE IF NOT EXISTS `paypal` (
  `email` varchar(60) DEFAULT NULL,
  `pwd` varchar(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `paypal`
--

INSERT INTO `paypal` (`email`, `pwd`) VALUES
('adele@uwl.ac.uk', 'hello');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

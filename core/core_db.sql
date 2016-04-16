-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 04-Abr-2016 às 10:53
-- Versão do servidor: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `core_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `ID` int(1) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `category`
--

INSERT INTO `category` (`ID`, `name`) VALUES
(1, 'Fresh Food'),
(2, 'Drinks'),
(3, 'Clothing');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `ID` int(8) NOT NULL AUTO_INCREMENT,
  `pwd` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `clients`
--

INSERT INTO `clients` (`ID`, `pwd`, `email`, `firstname`, `lastname`) VALUES
(1, '123', 'arthur@uwl.ac.uk', 'arthur', 'smith'),
(2, '123', 'john@uwl.ac.uk', 'john', 'lewis'),
(3, '123', 'ellie@uwl.ac.uk', 'ellie', 'jones'),
(4, '123', 'arthur@uwl.ac.uk', 'arthur', 'smith'),
(5, '123', 'john@uwl.ac.uk', 'john', 'lewis'),
(6, '123', 'ellie@uwl.ac.uk', 'ellie', 'jones'),
(7, '123', 'arthur@uwl.ac.uk', 'arthur', 'smith'),
(8, '123', 'john@uwl.ac.uk', 'john', 'lewis'),
(9, '123', 'ellie@uwl.ac.uk', 'ellie', 'jones'),
(10, '123', 'arthur@uwl.ac.uk', 'arthur', 'smith'),
(11, '123', 'john@uwl.ac.uk', 'john', 'lewis'),
(12, '123', 'ellie@uwl.ac.uk', 'ellie', 'jones'),
(13, '123', 'arthur@uwl.ac.uk', 'arthur', 'smith'),
(14, '123', 'john@uwl.ac.uk', 'john', 'lewis'),
(15, '123', 'ellie@uwl.ac.uk', 'ellie', 'jones'),
(16, '123', 'arthur@uwl.ac.uk', 'arthur', 'smith'),
(17, '123', 'john@uwl.ac.uk', 'john', 'lewis'),
(18, '123', 'ellie@uwl.ac.uk', 'ellie', 'jones'),
(19, '123', 'arthur@uwl.ac.uk', 'arthur', 'smith'),
(20, '123', 'john@uwl.ac.uk', 'john', 'lewis'),
(21, '123', 'ellie@uwl.ac.uk', 'ellie', 'jones'),
(22, '123', 'arthur@uwl.ac.uk', 'arthur', 'smith'),
(23, '123', 'john@uwl.ac.uk', 'john', 'lewis'),
(24, '123', 'ellie@uwl.ac.uk', 'ellie', 'jones'),
(25, '123', 'arthur@uwl.ac.uk', 'arthur', 'smith'),
(26, '123', 'john@uwl.ac.uk', 'john', 'lewis'),
(27, '123', 'ellie@uwl.ac.uk', 'ellie', 'jones'),
(28, '123', 'arthur@uwl.ac.uk', 'arthur', 'smith'),
(29, '123', 'john@uwl.ac.uk', 'john', 'lewis'),
(30, '123', 'ellie@uwl.ac.uk', 'ellie', 'jones'),
(31, '123', 'arthur@uwl.ac.uk', 'arthur', 'smith'),
(32, '123', 'john@uwl.ac.uk', 'john', 'lewis'),
(33, '123', 'ellie@uwl.ac.uk', 'ellie', 'jones'),
(34, '123', 'arthur@uwl.ac.uk', 'arthur', 'smith'),
(35, '123', 'john@uwl.ac.uk', 'john', 'lewis'),
(36, '123', 'ellie@uwl.ac.uk', 'ellie', 'jones'),
(37, '123', 'arthur@uwl.ac.uk', 'arthur', 'smith'),
(38, '123', 'john@uwl.ac.uk', 'john', 'lewis'),
(39, '123', 'ellie@uwl.ac.uk', 'ellie', 'jones'),
(40, '123', 'arthur@uwl.ac.uk', 'arthur', 'smith'),
(41, '123', 'john@uwl.ac.uk', 'john', 'lewis'),
(42, '123', 'ellie@uwl.ac.uk', 'ellie', 'jones');

-- --------------------------------------------------------

--
-- Estrutura da tabela `nationality`
--

DROP TABLE IF EXISTS `nationality`;
CREATE TABLE IF NOT EXISTS `nationality` (
  `ID` int(1) NOT NULL AUTO_INCREMENT,
  `country` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `nationality`
--

INSERT INTO `nationality` (`ID`, `country`) VALUES
(1, 'Brazil'),
(2, 'Portugal');

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `ID` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `weight` varchar(20) NOT NULL,
  `quantity` int(5) NOT NULL,
  `specialoffer` int(5) NOT NULL,
  `nationality` int(1) NOT NULL,
  `category` int(1) NOT NULL,
  `emailSuplier` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`ID`, `name`, `description`, `weight`, `quantity`, `specialoffer`, `nationality`, `category`) VALUES
(000001, 'Bananas', 'Six bananas from Brazil', '500g', 20, 0, 0, 0, 'bananas@gmail.com'),
(000002, 'Papaya', 'one papaya from Brazil', '150g', 20, 0, 0, 0, 'papaya@gmail.com'),
(000003, 'Açai cream', 'delicious healthy ice cream made of açai, a fruit only cultivated in amazonia forest', '1L', 20, 0, 0, 0, 'acaicream@gmail.com'),
(000004, 'Cachaça', 'strong alcooholic drink made with sugar kane', '1L', 20, 0, 0, 0, 'cachaca@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `specialoffers`
--

DROP TABLE IF EXISTS `specialoffers`;
CREATE TABLE IF NOT EXISTS `specialoffers` (
  `ID` int(1) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `specialoffers`
--

INSERT INTO `specialoffers` (`ID`, `name`) VALUES
(1, 'None'),
(2, '3-for-2'),
(3, 'Buy-1-get-1-free'),
(4, 'Half price'),
(5, '100 Loyalty Points');


--
-- Estrutura da tabela `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `ID` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `weight` varchar(20) NOT NULL,
  `quantity` int(5) NOT NULL,
  `specialoffer` int(5) NOT NULL,
  `nationality` int(1) NOT NULL,
  `category` int(1) NOT NULL,
  `emailSuplier` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- 
-- Estrutura da tabela `creditCard`
--
DROP TABLE IF EXISTS `creditCard`;
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

INSERT INTO `creditCard` (`ID`, `cardNumber`, `confCode`, `monthvalid`, `yearvalid`, `pwd`, `firstname` , `lastname`) VALUES
(NULL, '4004982711226988', '882', '01', '2018', 'england', 'king', 'arthur'),
(NULL, '7229982715677261', '121', '10', '2020', 'hello', 'the', 'adele');

--
-- Estrutura da tabela `payPal`
--
DROP TABLE IF EXISTS `payPal`;
CREATE TABLE IF NOT EXISTS `payPal` (
  `ID` INT(8) ZEROFILL NOT NULL PRIMARY KEY auto_increment,
  `email` varchar(40) NOT NULL,
  `pwd` varchar(15) NOT NULL,
  `firstname` VARCHAR(40) NOT NULL,
  `lastname` VARCHAR(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

INSERT INTO `paypal` (`ID`, `email`, `pwd`, `firstname` , `lastname`) VALUES
(NULL, 'kingarthur@uwl.ac.uk', 'england', 'king', 'arthur'),
(NULL, 'adele@uwl.ac.uk', 'hello', 'the', 'adele');




/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

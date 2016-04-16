-- phpMyAdmin SQL Dump

-- version 4.5.2

-- http://www.phpmyadmin.net

--
-- Host: 127.0.0.1

-- Generation Time: 16-Abr-2016 às 16:26

-- Versão do servidor: 5.7.9

-- PHP Version: 5.6.16

SET 
SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

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
-- 
Estrutura da tabela `category`
--


DROP TABLE IF EXISTS `category`;

CREATE TABLE IF NOT EXISTS `category` 
(
  `ID` int(1) NOT NULL AUTO_INCREMENT,
  
`name` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`)
) 
ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;



--
-- Extraindo dados da tabela `category`
--


INSERT INTO `category` (`ID`, `name`) VALUES
(1, 'Fresh Food'),
(2, 'Drinks'),
(3, 'Clothing');

-

- --------------------------------------------------------

--
-- 
Estrutura da tabela `clients`
--


DROP TABLE IF EXISTS `clients`;

CREATE TABLE IF NOT EXISTS `clients` (
  `ID` int(8) NOT NULL AUTO_INCREMENT,

  `pwd` varchar(15) NOT NULL,
 
 `email` varchar(40) NOT NULL,

  `firstname` varchar(40) NOT NULL,

  `lastname` varchar(40) NOT NULL,

  `loyalnumber` varchar(8) NOT NULL,
 
   PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;



--
-- Extraindo dados da tabela `clients`
--

INSERT INTO `clients` (`ID`, `pwd`, `email`, `firstname`, `lastname`, `loyalnumber`) 
VALUES
(1, 'hello', 'adele@uwl.ac.uk', 'adele', 'singer', '00000002'),

(2, '123', 'john@uwl.ac.uk', 'john', 'lewis', ''),

(3, '123', 'ellie@uwl.ac.uk', 'ellie', 'jones', '');



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
  
`price` double NOT NULL,

  `emailSuplier` varchar(40) NOT NULL,
 PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;



--
-- Extraindo dados da tabela `products`
--


INSERT INTO `products` (`ID`, `name`, `description`, `weight`, `quantity`, `specialoffer`, `nationality`, `category`, `price`) 
VALUES

(000001, 'Bananas', 'Six bananas from Brazil', '500g', 20, 0, 0, 0, 'bananas@gmail.com'),
(000002, 'Papaya', 'one papaya from Brazil', '150g', 20, 0, 0, 0, 'papaya@gmail.com'),
(000003, 'Açai cream', 'delicious healthy ice cream made of açai, a fruit only cultivated in amazonia forest', '1L', 20, 0, 0, 0, 'acaicream@gmail.com'),
(000004, 'Cachaça', 'strong alcooholic drink made with sugar kane', '1L', 20, 0, 0, 0, 'cachaca@gmail.com');
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



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 02-Maio-2016 às 15:43
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
CREATE DATABASE IF NOT EXISTS `core_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `core_db`;

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
  `loyalnumber` varchar(8) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `clients`
--

INSERT INTO `clients` (`ID`, `pwd`, `email`, `firstname`, `lastname`, `loyalnumber`) VALUES
(1, 'hello', 'adele@uwl.ac.uk', 'adele', 'singer', '00000002'),
(2, '123', 'john@uwl.ac.uk', 'john', 'lewis', ''),
(3, '123', 'ellie@uwl.ac.uk', 'ellie', 'jones', ''),
(47, '123456', 'aaaa@mmm.com', 'aaa', 'bbb', '00000006'),
(46, '111', 'peter@gmail.com', 'peter', 'parker', '00000005'),
(45, '111', 'rob@rob.com', 'Robertson', 'Lima', '00000004'),
(44, '111', 'paul@gmail.com', 'paul', 'lenon', '0000002'),
(43, '111', 'rob@gmail.com', 'robertson', 'lima', '0000001');

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
  `description` varchar(500) NOT NULL,
  `weight` varchar(20) NOT NULL,
  `quantity` int(5) NOT NULL,
  `specialoffer` int(5) NOT NULL,
  `nationality` int(1) NOT NULL,
  `category` int(1) NOT NULL,
  `price` double NOT NULL,
  `emailSupplier` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`ID`, `name`, `description`, `weight`, `quantity`, `specialoffer`, `nationality`, `category`, `price`, `emailSupplier`) VALUES
(000001, 'Bananas', 'Six bananas from Brazil', '500g', 19, 1, 1, 1, 1.5, 'carol25kle@gmail.com'),
(000002, 'Papaya', 'one papaya from Brazil', '150g', 16, 1, 1, 1, 0.85, 'carol25kle@gmail.com'),
(000003, 'Acai cream', 'Delicious healthy ice cream made of acai, a fruit only cultivated in amazonia forest.', '1L', 14, 2, 1, 1, 3.25, 'carol25kle@gmail.com'),
(000004, 'Cachaca', 'strong alcooholic drink made with sugar kane', '1L', 19, 4, 1, 2, 20, 'carol25kle@gmail.com'),
(000005, 'Male Brazil Shirt', 'The male version of Brazilian soccer team. Size M', '300g', 9, 5, 1, 3, 100, 'cbf@gmail.com'),
(000006, 'Female Brazil Shirt', 'The female version of Brazilian soccer team. Size S', '300g', 20, 5, 1, 3, 100, 'cbf@gmail.com'),
(000007, 'Male Portugal Shirt', 'The male version of Portugal soccer team. Size L.', '330g', 20, 5, 2, 3, 110, 'portugal@gmail.com'),
(000008, 'Pack of oranges', 'Pack with at least 6 oranges from Portugal.', '1kg', 14, 2, 2, 1, 3, 'portugal@gmail.com'),
(000009, 'Fresh Milk', 'Fresh Milk from Brazil.', '1l', 50, 1, 1, 1, 0.9, 'milk@gmail.com'),
(000010, 'Red Wine', 'Red wine made with brazilian grapes', '1l', 50, 1, 1, 2, 5, 'milk@gmail.com'),
(000011, 'Port Wine', 'A rich, fruity port with black fruit flavours, complex light clove spice aromas and a long, powerful, structured finish. Made from local Portuguese grape varieties grown in the Douro valley.', '1l', 28, 3, 2, 2, 15, 'portugal@gmail.com');

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

-- --------------------------------------------------------

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
  `price` double NOT NULL,
  `emailSupplier` varchar(20) NOT NULL,
  `IDproduct` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
--
-- Database: `loyaltyscheme`
--
CREATE DATABASE IF NOT EXISTS `loyaltyscheme` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `loyaltyscheme`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `ID` int(8) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `pwd` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `points` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `clients`
--

INSERT INTO `clients` (`ID`, `pwd`, `email`, `firstname`, `lastname`, `points`) VALUES
(00000001, 'england', 'kingarthur@uwl.ac.uk', 'king', 'arthur', 0),
(00000002, 'hello', 'adele@uwl.ac.uk', 'the', 'adele', 204),
(00000003, '123', 'paul@john.com', 'Paul', 'John', 0),
(00000004, '111', 'rob@rob.com', 'Robertson', 'Lima', 9076),
(00000005, '111', 'peter@gmail.com', 'peter', 'parker', 0),
(00000006, '123456', 'aaaa@mmm.com', 'aaa', 'bbb', 221);

-- --------------------------------------------------------

--
-- Estrutura da tabela `history`
--

DROP TABLE IF EXISTS `history`;
CREATE TABLE IF NOT EXISTS `history` (
  `ID` int(8) UNSIGNED ZEROFILL NOT NULL,
  `points` int(11) NOT NULL,
  `date` varchar(30) NOT NULL,
  `history_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`history_id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `history`
--

INSERT INTO `history` (`ID`, `points`, `date`, `history_id`) VALUES
(00000002, 20, '04.16.16', 1),
(00000002, 8, '04.16.16', 2),
(00000002, 0, '04.17.16', 3),
(00000002, 0, '04.17.16', 4),
(00000002, 0, '04.17.16', 5),
(00000002, 8, '04.17.16', 6),
(00000002, 8, '04.17.16', 7),
(00000002, 8, '04.17.16', 8),
(00000002, 15, '04.17.16', 9),
(00000002, 15, '04.18.16', 10),
(00000002, 19, '04.18.16', 11),
(00000002, 19, '04.18.16', 12),
(00000002, 10, '04.18.16', 13),
(00000004, 200, '04.18.16', 14),
(00000004, 13, '04.18.16', 15),
(00000004, -213, '04.18.16', 16),
(00000004, 210, '04.18.16', 17),
(00000004, -210, '04.18.16', 18),
(00000004, 197, '04.18.16', 19),
(00000004, 400, '04.18.16', 20),
(00000004, 500, '04.18.16', 21),
(00000004, 1000, '04.18.16', 22),
(00000004, 1000, '04.18.16', 23),
(00000004, 1000, '04.18.16', 24),
(00000004, 1000, '04.18.16', 25),
(00000004, 1200, '04.18.16', 26),
(00000004, 1200, '04.18.16', 27),
(00000004, 1400, '04.18.16', 28),
(00000004, 15, '04.18.16', 29),
(00000004, 15, '04.18.16', 30),
(00000004, 15, '04.18.16', 31),
(00000004, 30, '04.18.16', 32),
(00000004, 30, '04.18.16', 33),
(00000004, 30, '04.18.16', 34),
(00000004, 30, '04.18.16', 35),
(00000004, 7, '04.18.16', 36),
(00000004, 7, '04.18.16', 37),
(00000006, 206, '04.18.16', 38),
(00000006, 1, '04.18.16', 39),
(00000006, 7, '04.18.16', 40),
(00000006, 7, '04.18.16', 41),
(00000002, -110, '04.27.16', 42),
(00000002, 204, '04.27.16', 43);
--
-- Database: `payment_db`
--
CREATE DATABASE IF NOT EXISTS `payment_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `payment_db`;

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
('1234123412341234', 'robertson lima', 2020, '111', 2000, 1874),
('1111111111111111', 'carol', 2020, '111', 2000, 1);

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
('adele@uwl.ac.uk', 'hello'),
('professor@uwl.co.uk', '123');
--
-- Database: `scuba2u`
--
CREATE DATABASE IF NOT EXISTS `scuba2u` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `scuba2u`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `countryID` int(4) NOT NULL AUTO_INCREMENT,
  `countryName` varchar(50) NOT NULL,
  PRIMARY KEY (`countryID`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `countries`
--

INSERT INTO `countries` (`countryID`, `countryName`) VALUES
(1, 'Mexico'),
(2, 'Fiji'),
(3, 'Bahamas'),
(4, 'Turks & Caicos'),
(5, 'US'),
(6, 'Bonairs'),
(7, 'Australia'),
(8, 'Costa Rica'),
(9, 'Galapagos Islands'),
(10, 'Curacao'),
(11, 'Honduras'),
(12, 'British Virgin Islands'),
(13, 'Thailand'),
(14, 'Cayman Islands'),
(15, 'Belize'),
(16, 'Papua New Guinea'),
(17, 'Tahiti'),
(18, 'Palau'),
(19, 'Yap'),
(20, 'Venezuela'),
(21, 'Antarctica'),
(22, 'New Zealand'),
(23, 'Komodo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `difficulty`
--

DROP TABLE IF EXISTS `difficulty`;
CREATE TABLE IF NOT EXISTS `difficulty` (
  `difficultyID` int(4) NOT NULL AUTO_INCREMENT,
  `level` varchar(20) NOT NULL,
  PRIMARY KEY (`difficultyID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `difficulty`
--

INSERT INTO `difficulty` (`difficultyID`, `level`) VALUES
(1, 'beginner'),
(2, 'intermediate'),
(3, 'advanced'),
(4, 'technical');

-- --------------------------------------------------------

--
-- Estrutura da tabela `divetype`
--

DROP TABLE IF EXISTS `divetype`;
CREATE TABLE IF NOT EXISTS `divetype` (
  `typeID` int(4) NOT NULL AUTO_INCREMENT,
  `type` varchar(25) NOT NULL,
  PRIMARY KEY (`typeID`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `divetype`
--

INSERT INTO `divetype` (`typeID`, `type`) VALUES
(1, 'shore dives'),
(2, 'drift dives'),
(3, 'reef dives'),
(4, 'big animals'),
(5, 'sharks'),
(6, 'soft corals'),
(7, 'wrecks'),
(8, 'night dives'),
(9, 'technical dives'),
(10, 'boat dives');

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `userID` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `pwd` varchar(15) NOT NULL,
  `role` varchar(10) NOT NULL,
  `firstname` int(40) NOT NULL,
  `lastname` int(11) NOT NULL,
  `country` int(11) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`userID`, `username`, `pwd`, `role`, `firstname`, `lastname`, `country`) VALUES
(1, 'candyce@uniquevacations.com', 'candyce', 'admin', 0, 0, 0),
(2, 'bob@uniquevacations.com', 'bob', 'admin', 0, 0, 0),
(3, 'john@somesite.com', 'john', 'guest', 0, 0, 0),
(4, 'sue@anothersite.com', 'sue', 'guest', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tours`
--

DROP TABLE IF EXISTS `tours`;
CREATE TABLE IF NOT EXISTS `tours` (
  `tourID` int(4) NOT NULL AUTO_INCREMENT,
  `countryID` int(4) NOT NULL,
  `tourName` varchar(60) NOT NULL,
  `tourDescription` varchar(255) NOT NULL,
  `totalDays` int(3) NOT NULL,
  `daysDiving` int(3) NOT NULL,
  `diverCost` int(5) NOT NULL,
  `nonDiverCost` int(5) NOT NULL,
  `mealsIncluded` varchar(3) NOT NULL,
  `liveaboard` tinyint(1) NOT NULL,
  PRIMARY KEY (`tourID`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tours`
--

INSERT INTO `tours` (`tourID`, `countryID`, `tourName`, `tourDescription`, `totalDays`, `daysDiving`, `diverCost`, `nonDiverCost`, `mealsIncluded`, `liveaboard`) VALUES
(1, 6, 'Dive the Keys', 'Dive John Pennekamp Park for the best diving in the US.', 7, 5, 599, 499, 'yes', 0),
(2, 1, 'Dive Cozumel', 'Enjoy the wonderful diving in this great location.', 7, 5, 799, 699, 'yes', 0),
(3, 1, 'Dive Cancun', 'Visit this fun locations and get the best of the Yucatan Peninsula.', 7, 5, 799, 699, 'yes', 0),
(4, 3, 'Grand Bahamas Diving', 'Enjoy a wide variety of diving in this beautiful location.', 7, 5, 899, 799, 'no', 0),
(5, 8, 'Bonaire', 'Visit one of the best shore diving locations in the world.', 8, 6, 799, 699, 'no', 0),
(6, 9, 'Great Barrier Reef', 'The Great Barrier Reef is a must see for all diving enthusiasts.', 10, 7, 1299, 1199, 'no', 1),
(7, 10, 'Costa Rica', 'Enjoy the quantity of wildlife in Costa Rica along with the diving.', 10, 7, 799, 699, 'yes', 0),
(8, 4, 'Turks & Caicos', 'The Turks & Caicos Islands offer great diving in the Caribbean.', 7, 5, 899, 699, 'yes', 0),
(9, 2, 'Best of the Fijian Islands', 'Dive the beautiful soft corals from the same island known for the fire walkers.', 10, 8, 1299, 1099, 'yes', 1),
(10, 11, 'Dive the Galapagos Islands', 'Dive the exciting islands of the Galapagos to see big game such as tuna and great white sharks.', 12, 8, 2499, 2299, 'yes', 1),
(11, 13, 'The Whale Sharks of the Honduras', 'Dive with the whale sharks of the Honduras and discover these amazing creatures.', 10, 7, 1399, 1199, 'yes', 0),
(12, 14, 'Diving in the British Virgin Islands', 'Enjoy beautiful diving in the British Virgin Islands', 8, 6, 1099, 899, 'no', 0),
(13, 1, 'Islas Revillagigedos', 'San Benedicto & Socorro Islands are an amazing location to see scalloped hammerhead sharks.', 9, 7, 1599, 1299, 'yes', 1),
(14, 10, 'Cocos Islands', 'Enjoy the abundance of wildlife in the Cocos Islands of Costa Rica.', 9, 7, 1499, 1299, 'yes', 1),
(15, 15, 'Andaman Sea Thailand & Burma', 'This area is well known for its luxurious marine life including whale sharks.', 10, 7, 1699, 1499, 'yes', 1),
(16, 16, 'Cayman Islands', 'dive Little Cayman in the beautiful Caribbean.', 7, 6, 1399, 1099, 'no', 0),
(17, 17, 'Dive Belize', 'Dive Belize, one of the most beautiful dive spots in the world.', 9, 7, 1299, 1099, 'yes', 1),
(18, 13, 'Dive Roatan', 'Enjoy diving in the Honduras.', 8, 6, 1099, 899, 'no', 0),
(19, 13, 'Dive Utila', 'Dive this lesser known location in the Honduras.', 7, 6, 899, 799, 'no', 0),
(20, 22, 'Dive the Venezuelan Caribbean', 'Dive the Lost Roques Islands for great swarms of fish life.', 10, 8, 1299, 1099, 'no', 0),
(21, 20, 'Dive Palau', 'Dive one of the world''s last untamed destinations.', 12, 9, 1899, 1699, 'yes', 1),
(22, 19, 'Dive Exotic Tahiti', 'Enjoy diving in one of the most beautiful destinations in the world.', 12, 9, 1999, 1799, 'no', 0),
(23, 6, 'New Jersey Wreck Diving', 'Dive the Atlantis off the coast of New Jersey.', 7, 5, 799, 599, 'no', 0),
(24, 21, 'Dive the Yap Islands', 'Enjoy some amazing diving with mantas in Yap.', 10, 7, 1599, 1399, 'yes', 1),
(25, 9, 'Liveaboard Australia', 'Enjoy our liveaboard and dive the Coral Sea & the Great Barrier Reef', 12, 9, 1899, 1699, 'yes', 1),
(26, 1, 'Guadalupe Mexico', 'View and dive with white sharks in the Guadalupe Islands.', 8, 6, 1099, 899, 'yes', 1),
(27, 23, 'Antarctica', 'Dive in the Arctic Circle for a dive experience unlike any other.', 9, 6, 1699, 1499, 'yes', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

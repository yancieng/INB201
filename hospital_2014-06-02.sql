-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2014 at 05:27 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hospital`
--
CREATE DATABASE IF NOT EXISTS `hospital` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `hospital`;

-- --------------------------------------------------------

--
-- Table structure for table `beds`
--

CREATE TABLE IF NOT EXISTS `beds` (
  `bedNumber` varchar(7) NOT NULL,
  `patientID` int(7) unsigned zerofill DEFAULT NULL,
  PRIMARY KEY (`bedNumber`),
  UNIQUE KEY `patientID` (`patientID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `beds`
--

INSERT INTO `beds` (`bedNumber`, `patientID`) VALUES
('A103-01', NULL),
('A104-01', NULL),
('B101-02', NULL),
('B101-01', 0000001),
('A101-01', 0000002),
('A102-01', 0000007),
('B102-02', 0000010),
('R302-02', 0000011),
('B102-01', 0000025);

-- --------------------------------------------------------

--
-- Table structure for table `checkups`
--

CREATE TABLE IF NOT EXISTS `checkups` (
  `checkupID` int(7) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `temperature` varchar(10) DEFAULT NULL,
  `bloodPressure` varchar(10) DEFAULT NULL,
  `pulse` varchar(10) DEFAULT NULL,
  `eyeSightLeft` varchar(10) DEFAULT NULL,
  `eyeSightRight` varchar(10) DEFAULT NULL,
  `bloodSugar` varchar(10) DEFAULT NULL,
  `height` varchar(10) DEFAULT NULL,
  `weight` varchar(10) DEFAULT NULL,
  `bloodType` enum('O+','O-','A+','A-','B+','B-','AB+','AB-') DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `patientID` int(7) unsigned zerofill NOT NULL,
  PRIMARY KEY (`checkupID`),
  KEY `patientID` (`patientID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `checkups`
--

INSERT INTO `checkups` (`checkupID`, `temperature`, `bloodPressure`, `pulse`, `eyeSightLeft`, `eyeSightRight`, `bloodSugar`, `height`, `weight`, `bloodType`, `timestamp`, `patientID`) VALUES
(0000001, NULL, NULL, NULL, NULL, NULL, NULL, '114', '26', 'A-', '2014-05-16 02:56:33', 0000011),
(0000002, NULL, NULL, NULL, NULL, NULL, NULL, '120', NULL, NULL, '2014-05-16 02:56:33', 0000001),
(0000003, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '39', NULL, '2014-05-16 02:56:33', 0000001),
(0000004, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', '2014-05-09 14:00:00', 0000001),
(0000005, '38.5', '120/81', '71', '-1', '-1.5', '75', NULL, NULL, NULL, '2014-05-16 01:05:53', 0000011),
(0000006, '39', '120/80', '65', '+1', '-1', '80', '140', '50', 'A-', '2014-05-16 02:56:33', 0000002);

-- --------------------------------------------------------

--
-- Table structure for table `conditions`
--

CREATE TABLE IF NOT EXISTS `conditions` (
  `conditionID` int(7) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `condition` varchar(200) DEFAULT NULL,
  `conditionDate` date DEFAULT NULL,
  `medication` varchar(200) DEFAULT NULL,
  `allergy` varchar(200) DEFAULT NULL,
  `allergyDate` date DEFAULT NULL,
  `allergySeverity` varchar(200) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `patientID` int(7) unsigned zerofill NOT NULL,
  PRIMARY KEY (`conditionID`),
  KEY `patientID` (`patientID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `conditions`
--

INSERT INTO `conditions` (`conditionID`, `condition`, `conditionDate`, `medication`, `allergy`, `allergyDate`, `allergySeverity`, `timestamp`, `patientID`) VALUES
(0000001, 'Bad rash', '2014-05-15', 'Ointment', 'Pollen', '2014-05-15', 'Not Serious', '2014-05-15 09:36:13', 0000011),
(0000003, 'Inflamed Nostrils', '2014-05-16', 'None', NULL, NULL, NULL, '2014-05-16 03:10:02', 0000002),
(0000004, NULL, NULL, NULL, 'Pollen', '2014-05-16', 'Really bad', '2014-05-16 03:12:57', 0000002);

-- --------------------------------------------------------

--
-- Table structure for table `guardians`
--

CREATE TABLE IF NOT EXISTS `guardians` (
  `guardianID` int(7) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `firstName` varchar(40) NOT NULL,
  `lastName` varchar(40) NOT NULL,
  `title` enum('Mr.','Mrs.','Miss','Ms.') NOT NULL,
  `contactNumber` varchar(15) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `photo` varchar(200) NOT NULL DEFAULT '<img src="../images/none.png" alt="Guardian Picture">',
  PRIMARY KEY (`guardianID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=97 ;

--
-- Dumping data for table `guardians`
--

INSERT INTO `guardians` (`guardianID`, `firstName`, `lastName`, `title`, `contactNumber`, `email`, `address`, `photo`) VALUES
(0000001, 'Benson', 'Usang', 'Mr.', '01421234', 'bensonusa@hotmail.com', '1105/82 Vendor St, Brisbane, 4000', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000002, 'Sheree', 'Ackbar', 'Mrs.', '48535726', 'ackbars@gmail.com', '5 Brinkley St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000003, 'Reanna', 'Adams', 'Mrs.', '45105705', 'adamsR@hotmail.com', '12 Ella Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000004, 'Rona', 'Attinborough', 'Miss', '46128638', 'rattinborough@gmail.com', '11 Lokyer Pl', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000005, 'Cassandra', 'Barnes', 'Ms.', '44572338', 'barnseyc@gmail.com', '5 Chapple St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000006, 'Staci', 'Brown', 'Miss', '47284802', 'missbrown@hotmail.com', '19 Elford Pl', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000007, 'Archibald', 'Carson', 'Mr.', '44783001', 'carsona@gmail.com', '17 Kiandra Pl', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000008, 'Nicholas', 'Craig', 'Mr.', '48783468', 'NCraig@hotmail.com', '16 Timbury Way', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000009, 'Yolanda', 'Coleman', 'Mrs.', '44641922', 'ycolemany@hotmail.com', '4 Kallandra St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000010, 'Lauraine', 'Davids', 'Mrs.', '43403132', 'Lavids@hotmail.com', '6 St Albans Rd', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000011, 'Katherine', 'Erickson', 'Mrs.', '45620853', 'ericksonk@gmail.com', '25 Karanya St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000012, 'William', 'Mitchell', 'Mr.', '44315415', 'witchell@hotmail.com', '12 Oldland St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000013, 'Robert', 'Smith', 'Mr.', '45223754', 'Robsmith@hotmail.com', '13 Vuji Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000014, 'John', 'Rodriguez', 'Mr.', '46824491', 'JRodriguez@hotmail.com', '17 St Albans Rd', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000015, 'Lisa', 'Perez', 'Mrs.', '47313845', 'LPerez@hotmail.com', '22 Karanya St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000016, 'Louise', 'Griffin', 'Mrs.', '47224855', 'LGriffin@hotmail.com', '1 Hastings St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000017, 'Phillip', 'Kelly', 'Mr.', '43403430', 'Kellyp@hotmail.com', '3 Pankina St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000018, 'Nigel', 'Adams', 'Mr.', '47911137', 'Nadams@hotmail.com', '5 Tilanus St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000019, 'Sandy', 'Collins', 'Mrs.', '45244652', 'SCollins@gmail.com', '7 McBride St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000020, 'James', 'Cook', 'Mr.', '47223485', 'CJames@hotmail.com', '3 Perisher Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000021, 'Lucy', 'Howard', 'Mrs.', '48100132', 'HowardL@gmail.com', '24 Ella Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000022, 'Robert', 'Brown', 'Mr.', '43954794', 'BrownR@hotmail.com', '2 Cromwell Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000023, 'John', 'Brown', 'Mr.', '48792280', 'JBrown@hotmail.com', '7 Minaret Way', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000024, 'Bruce', 'Brown', 'Mr.', '47312711', 'BBrown@hotmail.com', '11 Vuji Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000025, 'Kaitlyn', 'Brown', 'Mrs.', '48851773', 'KBrown@Gmail.com', '19 Perisher Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000026, 'Christian', 'Evans', 'Mr.', '46582281', 'CEvans@hotmail.com', '29 Buchan St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000027, 'Hubert', 'Farmsworth', 'Mr.', '48929804', 'Goodnewseveryone@hotmail.com', '13 Hastings St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000028, 'Abigail', 'Fennell', 'Mrs.', '43973893', 'AbbyFennel@hotmail.com', '17 Panika St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000029, 'William', 'Ferrel', 'Mr.', '47359063', 'wferrel@hotmail.com', '12 Boyes Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000030, 'Robert', 'Floyd', 'Mr.', '4449868', 'RFloyd@hotmail.com', '14 Adams St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000031, 'Michael', 'Fox', 'Mr.', '44649204', 'MikeFox@gmail.com', '4 Marsh St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000032, 'Phillip', 'Fry', 'Mr.', '43235030', 'TheFuturamaGuy@hotmail.com', '8 Mott St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000033, 'Peter', 'Gabriel', 'Mr.', '46919959', 'GPeter@hotmail.com', '9 Thorley St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000034, 'Guy', 'Gardner', 'Mr.', '48240616', 'GGardner@hotmail.com', '2 Tilanus St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000035, 'Natasha', 'Gerard', 'Miss', '43010762', 'NGerard@hotmail.com', '23 McBride St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000036, 'Tina', 'Godfrey', 'Mrs.', '47669116', 'TGodfrey@hotmail.com', '24 Camara St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000037, 'Isabel', 'Hammond', 'Mrs.', '47006331', 'IHammond@hotmail.com', '17 Elmiatta Ave', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000038, 'Rachel', 'Hawkin', 'Miss', '48793432', 'RHawkin@hotmail.com', '13 Baralga St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000039, 'Stephen', 'Hendrix', 'Mr.', '44865180', 'SHendrix@hotmail.com', '14 Finlay Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000040, 'Charlotte', 'Hitchcock', 'Mrs.', '46153996', 'CHitchcock@hotmail.com', '5 Cavill Ave', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000041, 'Oliver', 'Hogan', 'Mr.', '46353427', 'OHogan@hotmail.com', '2 Wheeler Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000042, 'William', 'Holliday', 'Mr.', '46867202', 'WHolliday@hotmail.com', '6 Milgate Cres', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000043, 'Peter', 'Hooker', 'Mr.', '46268782', 'PHooker@hotmail.com', '11 Sheldon Pl', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000044, 'Caleb', 'Howard', 'Mr.', '44299052', 'CHoward@hotmail.com', '7 Sullivan Pl', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000045, 'Jessica', 'Hunt', 'Mrs.', '45962890', 'JHunt@hotmail.com', '4 Shepard Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000046, 'Peter', 'Jackson', 'Mr.', '46845374', 'PJackson@hotmail.com', '9 Courtney St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000047, 'Bridget', 'Jeffries', 'Mrs.', '43807793', 'BJeffries@hotmail.com', '5 Fenner St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000048, 'John', 'Johnson', 'Mr.', '45000592', 'JJohnson@hotmail.com', '7 Durack St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000049, 'Martha', 'Kent', 'Mrs.', '48066864', 'MarthaK@hotmail.com', '2 Brent St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000050, 'Mario', 'Kirby', 'Mr.', '46749892', 'MKirby@hotmail.com', '1 Keesing Rd', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000051, 'Quentin', 'Lance', 'Mr.', '45309881', 'QLance@hotmail.com', '3 Klewarra Boulevard', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000052, 'Jacob', 'Lawrence', 'Mr.', '46208804', 'JLawrence@hotmail.com', '23 Coorabin Ave', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000053, 'Victoria', 'Lincoln', 'Mrs.', '47930042', 'VLincoln@hotmail.com', '7 Smith Rd', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000054, 'Riley', 'Luthor', 'Mr.', '48973145', 'RLuthor@hotmail.com', '5 Edinburgh Ave', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000055, 'James', 'Macdonald', 'Mr.', '44489363', 'JMacdonald@hotmail.com', '16 Music Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000056, 'Zelda', 'Mackay', 'Mrs.', '43454321', 'ZMackay@hotmail.com', '6 Gibbard St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000057, 'Nicholas', 'Markham', 'Mr.', '47615602', 'NMarkham@hotmail.com', '8 Smith Rd', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000058, 'Harold', 'Mathews', 'Mr.', '45272648', 'HaroldM@hotmail.com', '6 Brinkley Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000059, 'Kaitlyn', 'McCallister', 'Mrs.', '46373624', 'KMcCallister@hotmail.com', '13 Ella Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000060, 'Robert', 'Mendez', 'Mr.', '46157441', 'RMendez@hotmail.com', '12 Lokyer Pl', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000061, 'Archibald', 'Mills', 'Mr.', '45917386', 'Amills@hotmail.com', '20 Elford Pl', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000062, 'Michelle', 'Monroe', 'Miss', '46602942', 'MMonroe@hotmail.com', '3 Cromwell Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000063, 'Christopher', 'Morrison', 'Mr.', '46115473', 'CMorrison@hotmail.com', '8 Minaret Way', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000064, 'Nolan', 'Murphy', 'Mr.', '46925187', 'NMurphy@hotmail.com', '12 Vuji Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000065, 'Morgan', 'Nelson', 'Mr.', '45116161', 'NMorgan@hotmail.com', '20 Perisher Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000066, 'Allen', 'Nesbit', 'Mr.', '48735123', 'AllanN@hotmail.com', '18 Kiandra Pl', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000067, 'John', 'Newman', 'Mr.', '43780992', 'JNewman@hotmail.com', '17 Timburry Way', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000068, 'Jill', 'Nielson', 'Mrs.', '45887442', 'JNielson@hotmail.com', '5 Kallanda St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000069, 'Stacey', 'Nixon', 'Miss', '47526407', 'SNixon@hotmail.com', '7 St Albans Rd', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000070, 'Gertrude', 'Nye', 'Mr.', '45330810', 'GertrudeN@hotmail.com', '26 Karanya St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000071, 'Nolan', 'Odonnell', 'Mr.', '46612313', 'NOdonnel@hotmail.com', '30 Buchan St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000072, 'Phillip', 'Olson', 'Mr.', '43573926', 'POlson@hotmail.com', '14 Hastings St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000073, 'Norman', 'Osborne', 'Mr.', '48593855', 'NOsborne@hotmail.com', '18 Pankina St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000074, 'Sharron', 'Osullivan', 'Mrs.', '46121372', 'SOsullivan@hotmail.com', '13 Boyes Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000075, 'Luke', 'Owens', 'Mr.', '43075133', 'LukeOwens@hotmail.com', '15 Adams St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000076, 'Bruce', 'Page', 'Mr.', '48945635', 'BruceP@hotmail.com', '5 Marsh St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000077, 'Caleb', 'Parks', 'Mr.', '48748298', 'CalebP@hotmail.com', '9 Mott St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000078, 'May', 'Peterson', 'Mrs.', '48050073', 'MPeterson@hotmail.com', '10 Thorley St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000079, 'Percy', 'Phillips', 'Mr.', '47701935', 'PPhillips@hotmail.com', '3 Tilanus St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000080, 'Natasha', 'Pratt', 'Mrs.', '47259369', 'NPratt@hotmail.com', '24 McBride St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000081, 'Lucas', 'Reagan', 'Mr.', '46540880', 'LReagan@hotmail.com', '25 Camara St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000082, 'Olivia', 'Richardson', 'Mrs.', '45030629', 'ORichardson@hotmail.com', '18 Elmiatta Ave', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000083, 'Nathan', 'Roberts', 'Mr.', '46697543', 'NRoberts@hotmail.com', '14 Baralga St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000084, 'Laurel', 'Sanderson', 'Miss', '44797018', 'LSanderson@hotmail.com', '15 Finlay Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000085, 'John', 'Shepherd', 'Mr.', '46189590', 'JShepard@hotmail.com', '6 Cavill Ave', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000086, 'Bruce', 'Smith', 'Mr.', '48687548', 'BSmith@hotmail.com', '3 Wheeler Circuit', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000087, 'Bridget', 'Smith', 'Mrs.', '48710022', 'BridgetSmith@hotmail.com', '7 Milgate Cres', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000088, 'Christina', 'Smith', 'Mrs.', '48695032', 'CSmith@hotmail.com', '12 Sheldon Pl', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000089, 'Robert', 'Stark', 'Mr.', '48262965', 'Iron_Mans_Dad@hotmail.com', '8 Sullivan Pl', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000090, 'Margaret', 'Stephenson', 'Mrs.', '48436694', 'MStephenson@hotmail.com', '5 Sheperd Circuit', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000091, 'Peter', 'Thompson', 'Mr.', '46166419', 'PThomson@hotmail.com', '10 Courtney St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000092, 'Timothy', 'Turner', 'Mr.', '46132145', 'TimmyTurner@hotmail.com', '6 Fenner St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000093, 'Alfred', 'Wayne', 'Mr.', '43854349', 'AlfredWayne@hotmail.com', '8 Durack St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000094, 'Christian', 'West', 'Mr.', '48110289', 'ChristianWest@hotmail.com', '3 Brent St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000095, 'Samantha', 'Worthington', 'Miss', '45918126', 'SamWorthington@hotmail.com', '2 Keesing Rd', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000096, 'Margaret', 'Xavier', 'Mrs.', '46891036', 'MargeX@gmail.com', '4 Klewarra Boulevard', '<img src="../images/none.png" alt="Guardian Picture">');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE IF NOT EXISTS `notes` (
  `noteID` int(7) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `datetimeWritten` datetime NOT NULL,
  `note` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `staffID` int(4) unsigned zerofill NOT NULL,
  PRIMARY KEY (`noteID`),
  KEY `staffID_idx` (`staffID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`noteID`, `datetimeWritten`, `note`, `image`, `staffID`) VALUES
(0000001, '2014-03-18 15:52:00', 'This is just a test. Test. Test.', '', 0001);

-- --------------------------------------------------------

--
-- Table structure for table `observations`
--

CREATE TABLE IF NOT EXISTS `observations` (
  `observationID` int(7) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `observationTitle` varchar(40) NOT NULL,
  `observation` text NOT NULL,
  `patientID` int(7) unsigned zerofill NOT NULL,
  `staffID` int(4) unsigned zerofill NOT NULL,
  PRIMARY KEY (`observationID`),
  KEY `patientID` (`patientID`),
  KEY `staffID` (`staffID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `observations`
--

INSERT INTO `observations` (`observationID`, `timestamp`, `observationTitle`, `observation`, `patientID`, `staffID`) VALUES
(0000001, '2014-03-12 14:00:00', 'Bad Appetite', 'Patient wouldn''t eat his dinner.', 0000011, 0003),
(0000002, '2014-05-16 03:49:13', 'Box is too large', 'It''s huge! How long are nurse''s observations supposed to be?', 0000002, 0003);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE IF NOT EXISTS `patients` (
  `patientID` int(7) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `firstName` varchar(40) NOT NULL,
  `lastName` varchar(40) NOT NULL,
  `DOB` date NOT NULL,
  `photo` varchar(200) NOT NULL DEFAULT '<img src="../images/none.png" alt="Patient Picture">',
  PRIMARY KEY (`patientID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=98 ;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patientID`, `firstName`, `lastName`, `DOB`, `photo`) VALUES
(0000001, 'Theresa', 'Mitchell', '2008-05-07', '<img src="../images/none.png" alt="Patient Picture">'),
(0000002, 'Randy', 'Smith', '2003-09-25', '<img src="../images/none.png" alt="Patient Picture">'),
(0000003, 'Victor', 'Rodriguez', '1997-02-19', '<img src="../images/none.png" alt="Patient Picture">'),
(0000004, 'Harold', 'Perez', '1997-10-13', '<img src="../images/none.png" alt="Patient Picture">'),
(0000005, 'Marilyn', 'Griffin', '2004-03-23', '<img src="../images/none.png" alt="Patient Picture">'),
(0000006, 'Ashley', 'Kelly', '2009-09-20', '<img src="../images/none.png" alt="Patient Picture">'),
(0000007, 'Michael', 'Adams', '2009-09-17', '<img src="../images/none.png" alt="Patient Picture">'),
(0000008, 'Evelyn', 'Collins', '2005-09-19', '<img src="../images/none.png" alt="Patient Picture">'),
(0000009, 'Timothy', 'Cook', '2003-04-29', '<img src="../images/none.png" alt="Patient Picture">'),
(0000010, 'Christine', 'Howard', '2004-07-06', '<img src="../images/none.png" alt="Patient Picture">'),
(0000011, 'Jason', 'Usang', '2006-04-30', '<img src="../images/none.png" alt="Patient Picture">'),
(0000012, 'Garry', 'Ackbar', '2005-07-15', '<img src="../images/none.png" alt="Patient Picture">'),
(0000013, 'Joanne', 'Adams', '1997-03-06', '<img src="../images/none.png" alt="Patient Picture">'),
(0000014, 'Nicholas', 'Attinborough', '1997-07-01', '<img src="../images/none.png" alt="Patient Picture">'),
(0000015, 'James', 'Barnes', '1999-05-18', '<img src="../images/none.png" alt="Patient Picture">'),
(0000016, 'Julia', 'Barnes', '1999-05-18', '<img src="../images/none.png" alt="Patient Picture">'),
(0000017, 'Arthur', 'Brown', '1999-07-27', '<img src="../images/none.png" alt="Patient Picture">'),
(0000018, 'Jackie', 'Brown', '1999-12-17', '<img src="../images/none.png" alt="Patient Picture">'),
(0000019, 'Redman', 'Brown', '1999-12-24', '<img src="../images/none.png" alt="Patient Picture">'),
(0000020, 'Ron', 'Brown', '2000-08-07', '<img src="../images/none.png" alt="Patient Picture">'),
(0000021, 'Steven', 'Brown', '2001-02-21', '<img src="../images/none.png" alt="Patient Picture">'),
(0000022, 'Leonard', 'Carson', '2001-06-13', '<img src="../images/none.png" alt="Patient Picture">'),
(0000023, 'William', 'Craig', '2001-09-02', '<img src="../images/none.png" alt="Patient Picture">'),
(0000024, 'Richard', 'Coleman', '2001-09-24', '<img src="../images/none.png" alt="Patient Picture">'),
(0000025, 'Grant', 'Davids', '2001-04-06', '<img src="../images/none.png" alt="Patient Picture">'),
(0000026, 'Josephine', 'Erickson', '2001-04-09', '<img src="../images/none.png" alt="Patient Picture">'),
(0000027, 'David', 'Evans', '2005-09-29', '<img src="../images/none.png" alt="Patient Picture">'),
(0000028, 'Hugo', 'Farmsworth', '2006-06-04', '<img src="../images/none.png" alt="Patient Picture">'),
(0000029, 'Judy', 'Fennell', '2006-12-20', '<img src="../images/none.png" alt="Patient Picture">'),
(0000030, 'Susan', 'Ferrel', '2007-03-15', '<img src="../images/none.png" alt="Patient Picture">'),
(0000031, 'Darryl', 'Floyd', '2007-05-03', '<img src="../images/none.png" alt="Patient Picture">'),
(0000032, 'Coleen', 'Fox', '2007-10-23', '<img src="../images/none.png" alt="Patient Picture">'),
(0000033, 'Hubert', 'Fry', '2008-03-26', '<img src="../images/none.png" alt="Patient Picture">'),
(0000034, 'Jeff', 'Gabriel', '2008-04-11', '<img src="../images/none.png" alt="Patient Picture">'),
(0000035, 'Ebony', 'Gardner', '2099-11-23', '<img src="../images/none.png" alt="Patient Picture">'),
(0000036, 'Linda', 'Gerard', '2099-12-17', '<img src="../images/none.png" alt="Patient Picture">'),
(0000037, 'Alberto', 'Godfrey', '2012-09-20', '<img src="../images/none.png" alt="Patient Picture">'),
(0000038, 'Gladys', 'Hammond', '2012-10-30', '<img src="../images/none.png" alt="Patient Picture">'),
(0000039, 'Jody', 'Hawkin', '2013-06-22', '<img src="../images/none.png" alt="Patient Picture">'),
(0000040, 'Jenny', 'Hendrix', '1994-10-26', '<img src="../images/none.png" alt="Patient Picture">'),
(0000041, 'Tyrone', 'Hitchcock', '1995-01-05', '<img src="../images/none.png" alt="Patient Picture">'),
(0000042, 'Alison', 'Hogan', '1996-09-21', '<img src="../images/none.png" alt="Patient Picture">'),
(0000043, 'Curtis', 'Holliday', '1996-10-12', '<img src="../images/none.png" alt="Patient Picture">'),
(0000044, 'Lee', 'Hooker', '1997-03-27', '<img src="../images/none.png" alt="Patient Picture">'),
(0000045, 'Elizabeth', 'Howard', '2000-05-23', '<img src="../images/none.png" alt="Patient Picture">'),
(0000046, 'Billy', 'Hunt', '2000-11-29', '<img src="../images/none.png" alt="Patient Picture">'),
(0000047, 'Nicholas', 'Jackson', '2001-04-11', '<img src="../images/none.png" alt="Patient Picture">'),
(0000048, 'Dominic', 'Jeffries', '2002-05-26', '<img src="../images/none.png" alt="Patient Picture">'),
(0000049, 'Mattie', 'Johnson', '2002-12-20', '<img src="../images/none.png" alt="Patient Picture">'),
(0000050, 'Connor', 'Kent', '2004-02-17', '<img src="../images/none.png" alt="Patient Picture">'),
(0000051, 'Hannah', 'Kirby', '2004-03-06', '<img src="../images/none.png" alt="Patient Picture">'),
(0000052, 'Sarah', 'Lance', '2004-07-08', '<img src="../images/none.png" alt="Patient Picture">'),
(0000053, 'Tricia', 'Lawrence', '2004-08-01', '<img src="../images/none.png" alt="Patient Picture">'),
(0000054, 'Bryan', 'Lincoln', '2005-08-03', '<img src="../images/none.png" alt="Patient Picture">'),
(0000055, 'Alexander', 'Luthor', '2005-08-23', '<img src="../images/none.png" alt="Patient Picture">'),
(0000056, 'Cory', 'Macdonald', '2009-03-24', '<img src="../images/none.png" alt="Patient Picture">'),
(0000057, 'Leroy', 'Mackay', '2009-12-01', '<img src="../images/none.png" alt="Patient Picture">'),
(0000058, 'Nancy', 'Markham', '2010-07-15', '<img src="../images/none.png" alt="Patient Picture">'),
(0000059, 'Cornelius', 'Mathews', '2010-08-03', '<img src="../images/none.png" alt="Patient Picture">'),
(0000060, 'Beatrice', 'McCallister', '2011-03-13', '<img src="../images/none.png" alt="Patient Picture">'),
(0000061, 'Luke', 'Mendez', '2012-03-13', '<img src="../images/none.png" alt="Patient Picture">'),
(0000062, 'Allan', 'Mills', '2012-05-03', '<img src="../images/none.png" alt="Patient Picture">'),
(0000063, 'Christina', 'Monroe', '2013-02-15', '<img src="../images/none.png" alt="Patient Picture">'),
(0000064, 'Martha', 'Morrison', '2013-12-11', '<img src="../images/none.png" alt="Patient Picture">'),
(0000065, 'Trevor', 'Murphy', '1995-04-21', '<img src="../images/none.png" alt="Patient Picture">'),
(0000066, 'Dorothy', 'Nelson', '1995-12-09', '<img src="../images/none.png" alt="Patient Picture">'),
(0000067, 'Timothy', 'Nesbit', '1996-01-11', '<img src="../images/none.png" alt="Patient Picture">'),
(0000068, 'Christina', 'Newman', '1997-02-22', '<img src="../images/none.png" alt="Patient Picture">'),
(0000069, 'Tabitha', 'Nielson', '1997-09-19', '<img src="../images/none.png" alt="Patient Picture">'),
(0000070, 'Sean', 'Nixon', '1998-03-29', '<img src="../images/none.png" alt="Patient Picture">'),
(0000071, 'Krystal', 'Nye', '1998-08-20', '<img src="../images/none.png" alt="Patient Picture">'),
(0000072, 'Jarred', 'Odonnell', '1999-02-07', '<img src="../images/none.png" alt="Patient Picture">'),
(0000073, 'Jasmine', 'Olson', '1999-07-18', '<img src="../images/none.png" alt="Patient Picture">'),
(0000074, 'Alan', 'Osbourne', '1999-08-29', '<img src="../images/none.png" alt="Patient Picture">'),
(0000075, 'Melvin', 'Osullivan', '2000-06-01', '<img src="../images/none.png" alt="Patient Picture">'),
(0000076, 'Lionel', 'Owens', '2001-03-02', '<img src="../images/none.png" alt="Patient Picture">'),
(0000077, 'Freddie', 'Page', '2001-08-13', '<img src="../images/none.png" alt="Patient Picture">'),
(0000078, 'Ellen', 'Parks', '2003-09-11', '<img src="../images/none.png" alt="Patient Picture">'),
(0000079, 'Parker', 'Peterson', '2003-09-27', '<img src="../images/none.png" alt="Patient Picture">'),
(0000080, 'Wanda', 'Phillips', '2004-11-24', '<img src="../images/none.png" alt="Patient Picture">'),
(0000081, 'Richard', 'Pratt', '2005-11-14', '<img src="../images/none.png" alt="Patient Picture">'),
(0000082, 'Marlon', 'Reagan', '2006-04-19', '<img src="../images/none.png" alt="Patient Picture">'),
(0000083, 'Daisy', 'Richardson', '2006-06-05', '<img src="../images/none.png" alt="Patient Picture">'),
(0000084, 'Jacqueline', 'Roberts', '2007-06-05', '<img src="../images/none.png" alt="Patient Picture">'),
(0000085, 'Franklin', 'Sanderson', '2007-11-08', '<img src="../images/none.png" alt="Patient Picture">'),
(0000086, 'Lindsey', 'Shephard', '2009-03-28', '<img src="../images/none.png" alt="Patient Picture">'),
(0000087, 'Brandon', 'Smith', '2011-05-26', '<img src="../images/none.png" alt="Patient Picture">'),
(0000088, 'Max', 'Smith', '2011-12-22', '<img src="../images/none.png" alt="Patient Picture">'),
(0000089, 'Peter', 'Smith', '2012-09-08', '<img src="../images/none.png" alt="Patient Picture">'),
(0000090, 'Robert', 'Stark', '1995-12-12', '<img src="../images/none.png" alt="Patient Picture">'),
(0000091, 'Jeffrey', 'Stephenson', '1997-06-30', '<img src="../images/none.png" alt="Patient Picture">'),
(0000092, 'Isabel', 'Thompson', '1997-10-31', '<img src="../images/none.png" alt="Patient Picture">'),
(0000093, 'Annie', 'Turner', '1999-06-04', '<img src="../images/none.png" alt="Patient Picture">'),
(0000094, 'Adam', 'Wayne', '1999-09-03', '<img src="../images/none.png" alt="Patient Picture">'),
(0000095, 'Burce', 'West', '1999-09-03', '<img src="../images/none.png" alt="Patient Picture">'),
(0000096, 'Helen', 'Worthington', '1999-11-07', '<img src="../images/none.png" alt="Patient Picture">'),
(0000097, 'Charles', 'Xavier', '1999-12-16', '<img src="../images/none.png" alt="Patient Picture">');

-- --------------------------------------------------------

--
-- Table structure for table `patients_guardians`
--

CREATE TABLE IF NOT EXISTS `patients_guardians` (
  `patientID` int(7) NOT NULL,
  `guardianID` int(7) NOT NULL,
  `relation` varchar(40) NOT NULL,
  PRIMARY KEY (`patientID`,`guardianID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patients_guardians`
--

INSERT INTO `patients_guardians` (`patientID`, `guardianID`, `relation`) VALUES
(1, 12, 'Father'),
(2, 10, 'Not related'),
(3, 14, 'Brother'),
(4, 15, 'Mother'),
(5, 15, 'Mother'),
(6, 16, 'Uncle'),
(7, 3, 'Mother'),
(8, 18, 'Mother'),
(9, 19, 'Father'),
(10, 20, 'Grandmother'),
(11, 1, 'Father'),
(12, 2, 'Mother'),
(13, 3, 'Mother'),
(14, 4, 'Mother'),
(15, 5, 'Mother'),
(16, 5, 'Mother'),
(17, 6, 'Mother'),
(18, 6, 'Mother'),
(18, 21, 'Father'),
(19, 6, 'Mother'),
(19, 22, 'Grandfather'),
(20, 6, 'Mother'),
(20, 23, 'Father'),
(21, 6, 'Mother'),
(21, 24, 'Aunt'),
(22, 7, 'Grandfather'),
(23, 8, 'Father'),
(24, 9, 'Mother'),
(25, 10, 'Grandmother'),
(26, 11, 'Mother'),
(27, 26, 'Father'),
(28, 27, 'Uncle'),
(29, 28, 'Mother'),
(30, 29, 'Father'),
(31, 30, 'Brother'),
(32, 31, 'Father'),
(33, 32, 'Brother'),
(34, 33, 'Father'),
(35, 34, 'Uncle'),
(36, 35, 'Sister'),
(37, 36, 'Mother'),
(38, 37, 'Grandmother'),
(39, 38, 'Sister'),
(40, 39, 'Grandfather'),
(41, 40, 'Aunt'),
(42, 41, 'Father'),
(43, 42, 'Father'),
(44, 43, 'Brother'),
(45, 44, 'Father'),
(46, 45, 'Grandmother'),
(47, 46, 'Father'),
(48, 47, 'Mother'),
(49, 48, 'Uncle'),
(50, 49, 'Grandmother'),
(51, 50, 'Brother'),
(52, 51, 'Father'),
(53, 52, 'Grandfather'),
(54, 53, 'Aunt'),
(55, 54, 'Brother'),
(56, 55, 'Father'),
(57, 56, 'Grandmother'),
(58, 57, 'Father'),
(59, 58, 'Brother'),
(60, 59, 'Aunt'),
(61, 60, 'Father'),
(62, 61, 'Grandfather'),
(63, 62, 'Sister'),
(64, 63, 'Grandfather'),
(65, 64, 'Father'),
(66, 65, 'Uncle'),
(67, 66, 'Brother'),
(68, 67, 'Father'),
(69, 68, 'Grandmother'),
(70, 69, 'Sister'),
(71, 70, 'Grandmother'),
(72, 71, 'Father'),
(73, 72, 'Brother'),
(74, 73, 'Father'),
(75, 74, 'Aunt'),
(76, 75, 'Grandfather'),
(77, 76, 'Father'),
(78, 77, 'Uncle'),
(79, 78, 'Aunt'),
(80, 79, 'Father'),
(81, 80, 'Grandmother'),
(82, 81, 'Father'),
(83, 82, 'Grandmother'),
(84, 83, 'Father'),
(85, 84, 'Sister'),
(86, 85, 'Brother'),
(87, 86, 'Father'),
(88, 87, 'Grandmother'),
(89, 88, 'Aunt'),
(90, 89, 'Father'),
(91, 90, 'Mother'),
(92, 91, 'Grandfather'),
(93, 92, 'Uncle'),
(94, 93, 'Grandmother'),
(95, 94, 'Father'),
(96, 95, 'Sister'),
(97, 96, 'Mother');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `paymentID` int(7) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `admissionDate` date NOT NULL,
  `releaseDate` date DEFAULT NULL,
  `cost` varchar(10) DEFAULT NULL,
  `paymentMethod` varchar(20) DEFAULT NULL,
  `rebuff` varchar(10) DEFAULT NULL,
  `patientID` int(7) unsigned zerofill NOT NULL,
  PRIMARY KEY (`paymentID`),
  KEY `patientID_idx` (`patientID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`paymentID`, `admissionDate`, `releaseDate`, `cost`, `paymentMethod`, `rebuff`, `patientID`) VALUES
(0000001, '2014-03-02', '2014-03-18', '$2000.00', 'Cash Payment', '$1000.00', 0000010);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE IF NOT EXISTS `schedules` (
  `scheduleID` int(7) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `details` varchar(255) NOT NULL,
  `room` varchar(7) NOT NULL,
  `startTime` datetime NOT NULL,
  `endTime` datetime NOT NULL,
  `patientID` int(7) unsigned zerofill NOT NULL,
  PRIMARY KEY (`scheduleID`),
  KEY `patientID_idx` (`patientID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`scheduleID`, `details`, `room`, `startTime`, `endTime`, `patientID`) VALUES
(0000001, 'Doctor''s Checkup.', 'W204', '2014-06-07 15:00:00', '2014-06-07 16:00:00', 0000011);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `staffID` int(4) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `firstName` varchar(40) NOT NULL,
  `lastName` varchar(40) NOT NULL,
  `title` int(1) NOT NULL,
  `password` varchar(64) NOT NULL,
  `specialties` varchar(40) DEFAULT NULL,
  `photo` varchar(200) NOT NULL DEFAULT '<img src="../images/none.png" alt="Profile picture" />',
  PRIMARY KEY (`staffID`),
  KEY `title_idx` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffID`, `firstName`, `lastName`, `title`, `password`, `specialties`, `photo`) VALUES
(0001, 'Marco', 'Simon', 1, '72f4be89d6ebab1496e21e38bcd7c8ca0a68928af3081ad7dff87e772eb350c2', 'Cardiologists', '<img src="../images/profile.jpg" alt="Profile picture" />'),
(0002, 'Terry', 'Walker', 3, '849f10fbdbd58feec169787af0896866ea7aa812aa189baf96f7b024ecddbfbc', NULL, '<img src="../images/none.png" alt="Profile picture" />'),
(0003, 'Lynne', 'Peterson', 2, '781e5116a1e14a34eada50159d589e690c81ec4c5063115ea1f10b99441d5b94', NULL, '<img src="../images/none.png" alt="Profile picture" />'),
(0004, 'Glenn', 'Cobb', 4, 'c3bca14c650063bb88e5a82f757c11defaf4ea06c18368c9c9b70c5d77933dd3', NULL, '<img src="../images/none.png" alt="Profile picture" />'),
(0005, 'Ora', 'Elliot', 5, '4194d1706ed1f408d5e02d672777019f4d5385c766a8c6ca8acba3167d36a7b9', NULL, '<img src="../images/none.png" alt="Profile picture" />'),
(0009, 'Fred', 'Law', 5, '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', '', '<img src="../images/none.png" alt="Profile picture" />');

-- --------------------------------------------------------

--
-- Table structure for table `titles`
--

CREATE TABLE IF NOT EXISTS `titles` (
  `titleID` int(1) NOT NULL,
  `title` varchar(20) NOT NULL,
  PRIMARY KEY (`titleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `titles`
--

INSERT INTO `titles` (`titleID`, `title`) VALUES
(1, 'Doctor'),
(2, 'Nurse'),
(3, 'Medical Technician'),
(4, 'Receptionist'),
(5, 'Administrator');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `beds`
--
ALTER TABLE `beds`
  ADD CONSTRAINT `bedsPatientID` FOREIGN KEY (`patientID`) REFERENCES `patients` (`patientID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `checkups`
--
ALTER TABLE `checkups`
  ADD CONSTRAINT `patientsCheckup` FOREIGN KEY (`patientID`) REFERENCES `patients` (`patientID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `conditions`
--
ALTER TABLE `conditions`
  ADD CONSTRAINT `conditionPatient` FOREIGN KEY (`patientID`) REFERENCES `patients` (`patientID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notesStaffID` FOREIGN KEY (`staffID`) REFERENCES `staff` (`staffID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `observations`
--
ALTER TABLE `observations`
  ADD CONSTRAINT `observationPatient` FOREIGN KEY (`patientID`) REFERENCES `patients` (`patientID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `observationStaff` FOREIGN KEY (`staffID`) REFERENCES `staff` (`staffID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `paymentsPatientID` FOREIGN KEY (`patientID`) REFERENCES `patients` (`patientID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedulesPatientID` FOREIGN KEY (`patientID`) REFERENCES `patients` (`patientID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staffTitle` FOREIGN KEY (`title`) REFERENCES `titles` (`titleID`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

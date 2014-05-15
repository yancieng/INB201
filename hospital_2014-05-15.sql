-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2014 at 12:21 PM
-- Server version: 5.5.36
-- PHP Version: 5.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hospital`
--
CREATE DATABASE IF NOT EXISTS `hospital` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
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
('B102-01', NULL),
('B102-02', NULL),
('B101-01', 0000001),
('A101-01', 0000002),
('A102-01', 0000007),
('R302-02', 0000011);

-- --------------------------------------------------------

--
-- Table structure for table `checkups`
--

CREATE TABLE IF NOT EXISTS `checkups` (
  `checkupID` int(7) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `temperature` varchar(10) DEFAULT NULL,
  `bloodPressure` varchar(10) DEFAULT NULL,
  `eyeSight` varchar(10) DEFAULT NULL,
  `bloodSugar` varchar(10) DEFAULT NULL,
  `height` varchar(10) DEFAULT NULL,
  `weight` varchar(10) DEFAULT NULL,
  `bloodType` enum('O+','O-','A+','A-','B+','B-','AB+','AB-') DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `patientID` int(7) unsigned zerofill NOT NULL,
  PRIMARY KEY (`checkupID`),
  KEY `patientID` (`patientID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `checkups`
--

INSERT INTO `checkups` (`checkupID`, `temperature`, `bloodPressure`, `eyeSight`, `bloodSugar`, `height`, `weight`, `bloodType`, `timestamp`, `patientID`) VALUES
(0000001, NULL, NULL, NULL, NULL, '114 cm', '26 kg', 'A-', '2014-05-12 02:31:25', 0000011),
(0000002, NULL, NULL, NULL, NULL, '120 cm', NULL, NULL, '2014-05-07 14:00:00', 0000001),
(0000003, NULL, NULL, NULL, NULL, NULL, '39 kg', NULL, '2014-05-08 14:00:00', 0000001),
(0000004, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', '2014-05-09 14:00:00', 0000001);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `conditions`
--

INSERT INTO `conditions` (`conditionID`, `condition`, `conditionDate`, `medication`, `allergy`, `allergyDate`, `allergySeverity`, `timestamp`, `patientID`) VALUES
(0000001, 'Bad rash', '2014-05-15', 'Ointment', 'Pollen', '2014-05-15', 'Not too bad', '2014-05-15 09:36:13', 0000011);

-- --------------------------------------------------------

--
-- Table structure for table `guardians`
--

CREATE TABLE IF NOT EXISTS `guardians` (
  `guardianID` int(7) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `firstName` varchar(40) NOT NULL,
  `lastName` varchar(40) NOT NULL,
  `title` enum('Mr.','Mrs.','Miss','Ms.') NOT NULL,
  `relation` varchar(40) NOT NULL,
  `contactNumber` varchar(15) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `photo` varchar(200) NOT NULL DEFAULT '<img src="../images/none.png" alt="Guardian Picture">',
  PRIMARY KEY (`guardianID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `guardians`
--

INSERT INTO `guardians` (`guardianID`, `firstName`, `lastName`, `title`, `relation`, `contactNumber`, `email`, `address`, `photo`) VALUES
('p0001', 'Benson', 'Usang', 'Mr.', 'Father', '01421234', 'bensonusa@hotmail.com', '1105/82 Vendor St, Brisbane, 4000', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0002', 'Sheree', 'Ackbar', 'Mrs.', 'Mother', '48535726', 'ackbars@gmail.com', '5 Brinkley St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0003', 'Reanna', 'Adams', 'Mrs.', 'Mother', '45105705', 'adamsR@hotmail.com', '12 Ella Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0004', 'Rona', 'Attinborough', 'Miss', 'Mother', '46128638', 'rattinborough@gmail.com', '11 Lokyer Pl', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0005', 'Cassandra', 'Barnes', 'Ms.', 'Mother', '44572338', 'barnseyc@gmail.com', '5 Chapple St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0006', 'Staci', 'Brown', 'Miss', 'Mother', '47284802', 'missbrown@hotmail.com', '19 Elford Pl', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0007', 'Archibald', 'Carson', 'Mr.', 'Grandfather', '44783001', 'carsona@gmail.com', '17 Kiandra Pl', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0008', 'Nicholas', 'Craig', 'Mr.', 'Father', '48783468', 'NCraig@hotmail.com', '16 Timbury Way', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0009', 'Yolanda', 'Coleman', 'Mrs.', 'Mother', '44641922', 'ycolemany@hotmail.com', '4 Kallandra St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0010', 'Lauraine', 'Davids', 'Mrs.', 'Grandmother', '43403132', 'Lavids@hotmail.com', '6 St Albans Rd', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0011', 'Katherine', 'Erickson', 'Mrs.', 'Mother', '45620853', 'ericksonk@gmail.com', '25 Karanya St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0012', 'William', 'Mitchell', 'Mr.', 'Brother', '44315415', 'witchell@hotmail.com', '12 Oldland St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0013', 'Robert', 'Smith', 'Mr.', 'Father', '45223754', 'Robsmith@hotmail.com', '13 Vuji Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0014', 'John', 'Rodriguez', 'Mr.', 'Brother', '46824491', 'JRodriguez@hotmail.com', '17 St Albans Rd', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0015', 'Lisa', 'Perez', 'Mrs.', 'Mother', '47313845', 'LPerez@hotmail.com', '22 Karanya St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0016', 'Louise', 'Griffin', 'Mrs.', 'Mother', '47224855', 'LGriffin@hotmail.com', '1 Hastings St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0017', 'Phillip', 'Kelly', 'Mr.', 'Uncle', '43403430', 'Kellyp@hotmail.com', '3 Pankina St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0018', 'Nigel', 'Adams', 'Mr.', 'Grandfather', '47911137', 'Nadams@hotmail.com', '5 Tilanus St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0019', 'Sandy', 'Collins', 'Mrs.', 'Mother', '45244652', 'SCollins@gmail.com', '7 McBride St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0020', 'James', 'Cook', 'Mr.', 'Father', '47223485', 'CJames@hotmail.com', '3 Perisher Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0021', 'Lucy', 'Howard', 'Mrs.', 'Grandmother', '48100132', 'HowardL@gmail.com', '24 Ella Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0022', 'Robert', 'Brown', 'Mr.', 'Father', '43954794', 'BrownR@hotmail.com', '2 Cromwell Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0023', 'John', 'Brown', 'Mr.', 'Grandfather', '48792280', 'JBrown@hotmail.com', '7 Minaret Way', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0024', 'Bruce', 'Brown', 'Mr.', 'Father', '47312711', 'BBrown@hotmail.com', '11 Vuji Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0025', 'Kaitlyn', 'Brown', 'Mrs.', 'Aunt', '48851773', 'KBrown@Gmail.com', '19 Perisher Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0026', 'Christian', 'Evans', 'Mr.', 'Father', '46582281', 'CEvans@hotmail.com', '29 Buchan St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0027', 'Hubert', 'Farmsworth', 'Mr.', 'Uncle', '48929804', 'Goodnewseveryone@hotmail.com', '13 Hastings St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0028', 'Abigail', 'Fennell', 'Mrs.', 'Mother', '43973893', 'AbbyFennel@hotmail.com', '17 Panika St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0029', 'William', 'Ferrel', 'Mr.', 'Father', '47359063', 'wferrel@hotmail.com', '12 Boyes Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0030', 'Robert', 'Floyd', 'Mr.', 'Brother', '4449868', 'RFloyd@hotmail.com', '14 Adams St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0031', 'Michael', 'Fox', 'Mr.', 'Father', '44649204', 'MikeFox@gmail.com', '4 Marsh St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0032', 'Phillip', 'Fry', 'Mr.', 'Brother', '43235030', 'TheFuturamaGuy@hotmail.com', '8 Mott St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0033', 'Peter', 'Gabriel', 'Mr.', 'Father', '46919959', 'GPeter@hotmail.com', '9 Thorley St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0034', 'Guy', 'Gardner', 'Mr.', 'Uncle', '48240616', 'GGardner@hotmail.com', '2 Tilanus St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0035', 'Natasha', 'Gerard', 'Miss', 'Sister', '43010762', 'NGerard@hotmail.com', '23 McBride St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0036', 'Tina', 'Godfrey', 'Mrs.', 'Mother', '47669116', 'TGodfrey@hotmail.com', '24 Camara St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0037', 'Isabel', 'Hammond', 'Mrs.', 'Grandmother', '47006331', 'IHammond@hotmail.com', '17 Elmiatta Ave', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0038', 'Rachel', 'Hawkin', 'Miss', 'Sister', '48793432', 'RHawkin@hotmail.com', '13 Baralga St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0039', 'Stephen', 'Hendrix', 'Mr.', 'Grandfather', '44865180', 'SHendrix@hotmail.com', '14 Finlay Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0040', 'Charlotte', 'Hitchcock', 'Mrs.', 'Aunt', '46153996', 'CHitchcock@hotmail.com', '5 Cavill Ave', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0041', 'Oliver', 'Hogan', 'Mr.', 'Father', '46353427', 'OHogan@hotmail.com', '2 Wheeler Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0042', 'William', 'Holliday', 'Mr.', 'Father', '46867202', 'WHolliday@hotmail.com', '6 Milgate Cres', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0043', 'Peter', 'Hooker', 'Mr.', 'Brother', '46268782', 'PHooker@hotmail.com', '11 Sheldon Pl', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0044', 'Caleb', 'Howard', 'Mr.', 'Father', '44299052', 'CHoward@hotmail.com', '7 Sullivan Pl', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0045', 'Jessica', 'Hunt', 'Mrs.', 'Grandmother', '45962890', 'JHunt@hotmail.com', '4 Shepard Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0046', 'Peter', 'Jackson', 'Mr.', 'Father', '46845374', 'PJackson@hotmail.com', '9 Courtney St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0047', 'Bridget', 'Jeffries', 'Mrs.', 'Mother', '43807793', 'BJeffries@hotmail.com', '5 Fenner St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0048', 'John', 'Johnson', 'Mr.', 'Uncle', '45000592', 'JJohnson@hotmail.com', '7 Durack St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0049', 'Martha', 'Kent', 'Mrs.', 'Grandmother', '48066864', 'MarthaK@hotmail.com', '2 Brent St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0050', 'Mario', 'Kirby', 'Mr.', 'Brother', '46749892', 'MKirby@hotmail.com', '1 Keesing Rd', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0051', 'Quentin', 'Lance', 'Mr.', 'Father', '45309881', 'QLance@hotmail.com', '3 Klewarra Boulevard', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0052', 'Jacob', 'Lawrence', 'Mr.', 'Grandfather', '46208804', 'JLawrence@hotmail.com', '23 Coorabin Ave', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0053', 'Victoria', 'Lincoln', 'Mrs.', 'Aunt', '47930042', 'VLincoln@hotmail.com', '7 Smith Rd', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0054', 'Riley', 'Luthor', 'Mr.', 'Brother', '48973145', 'RLuthor@hotmail.com', '5 Edinburgh Ave', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0055', 'James', 'Macdonald', 'Mr.', 'Father', '44489363', 'JMacdonald@hotmail.com', '16 Music Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0056', 'Zelda', 'Mackay', 'Mrs.', 'Grandmother', '43454321', 'ZMackay@hotmail.com', '6 Gibbard St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0057', 'Nicholas', 'Markham', 'Mr.', 'Father', '47615602', 'NMarkham@hotmail.com', '8 Smith Rd', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0058', 'Harold', 'Mathews', 'Mr.', 'Brother', '45272648', 'HaroldM@hotmail.com', '6 Brinkley Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0059', 'Kaitlyn', 'McCallister', 'Mrs.', 'Aunt', '46373624', 'KMcCallister@hotmail.com', '13 Ella Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0060', 'Robert', 'Mendez', 'Mr.', 'Father', '46157441', 'RMendez@hotmail.com', '12 Lokyer Pl', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0061', 'Archibald', 'Mills', 'Mr.', 'Grandfather', '45917386', 'Amills@hotmail.com', '20 Elford Pl', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0062', 'Michelle', 'Monroe', 'Miss', 'Sister', '46602942', 'MMonroe@hotmail.com', '3 Cromwell Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0063', 'Christopher', 'Morrison', 'Mr.', 'Grandfather', '46115473', 'CMorrison@hotmail.com', '8 Minaret Way', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0064', 'Nolan', 'Murphy', 'Mr.', 'Father', '46925187', 'NMurphy@hotmail.com', '12 Vuji Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0065', 'Morgan', 'Nelson', 'Mr.', 'Uncle', '45116161', 'NMorgan@hotmail.com', '20 Perisher Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0066', 'Allen', 'Nesbit', 'Mr.', 'Brother', '48735123', 'AllanN@hotmail.com', '18 Kiandra Pl', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0067', 'John', 'Newman', 'Mr.', 'Father', '43780992', 'JNewman@hotmail.com', '17 Timburry Way', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0068', 'Jill', 'Nielson', 'Mrs.', 'Grandmother', '45887442', 'JNielson@hotmail.com', '5 Kallanda St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0069', 'Stacey', 'Nixon', 'Miss', 'Sister', '47526407', 'SNixon@hotmail.com', '7 St Albans Rd', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0070', 'Gertrude', 'Nye', 'Mr.', 'Grandmother', '45330810', 'GertrudeN@hotmail.com', '26 Karanya St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0071', 'Nolan', 'Odonnell', 'Mr.', 'Father', '46612313', 'NOdonnel@hotmail.com', '30 Buchan St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0072', 'Phillip', 'Olson', 'Mr.', 'Brother', '43573926', 'POlson@hotmail.com', '14 Hastings St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0073', 'Norman', 'Osborne', 'Mr.', 'Father', '48593855', 'NOsborne@hotmail.com', '18 Pankina St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0074', 'Sharron', 'Osullivan', 'Mrs.', 'Aunt', '46121372', 'SOsullivan@hotmail.com', '13 Boyes Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0075', 'Luke', 'Owens', 'Mr.', 'Grandfather', '43075133', 'LukeOwens@hotmail.com', '15 Adams St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0076', 'Bruce', 'Page', 'Mr.', 'Father', '48945635', 'BruceP@hotmail.com', '5 Marsh St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0077', 'Caleb', 'Parks', 'Mr.', 'Uncle', '48748298', 'CalebP@hotmail.com', '9 Mott St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0078', 'May', 'Peterson', 'Mrs.', 'Aunt', '48050073', 'MPeterson@hotmail.com', '10 Thorley St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0079', 'Percy', 'Phillips', 'Mr.', 'Father', '47701935', 'PPhillips@hotmail.com', '3 Tilanus St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0080', 'Natasha', 'Pratt', 'Mrs.', 'Grandmother', '47259369', 'NPratt@hotmail.com', '24 McBride St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0081', 'Lucas', 'Reagan', 'Mr.', 'Father', '46540880', 'LReagan@hotmail.com', '25 Camara St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0082', 'Olivia', 'Richardson', 'Mrs.', 'Grandmother', '45030629', 'ORichardson@hotmail.com', '18 Elmiatta Ave', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0083', 'Nathan', 'Roberts', 'Mr.', 'Father', '46697543', 'NRoberts@hotmail.com', '14 Baralga St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0084', 'Laurel', 'Sanderson', 'Miss', 'Sister', '44797018', 'LSanderson@hotmail.com', '15 Finlay Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0085', 'John', 'Shepherd', 'Mr.', 'Brother', '46189590', 'JShepard@hotmail.com', '6 Cavill Ave', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0086', 'Bruce', 'Smith', 'Mr.', 'Father', '48687548', 'BSmith@hotmail.com', '3 Wheeler Circuit', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0087', 'Bridget', 'Smith', 'Mrs.', 'Grandmother', '48710022', 'BridgetSmith@hotmail.com', '7 Milgate Cres', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0088', 'Christina', 'Smith', 'Mrs.', 'Aunt', '48695032', 'CSmith@hotmail.com', '12 Sheldon Pl', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0089', 'Robert', 'Stark', 'Mr.', 'Father', '48262965', 'Iron_Mans_Dad@hotmail.com', '8 Sullivan Pl', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0090', 'Margaret', 'Stephenson', 'Mrs.', 'Mother', '48436694', 'MStephenson@hotmail.com', '5 Sheperd Circuit', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0091', 'Peter', 'Thompson', 'Mr.', 'Grandfather', '46166419', 'PThomson@hotmail.com', '10 Courtney St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0092', 'Timothy', 'Turner', 'Mr.', 'Uncle', '46132145', 'TimmyTurner@hotmail.com', '6 Fenner St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0093', 'Alfred', 'Wayne', 'Mr.', 'Grandfather', '43854349', 'AlfredWayne@hotmail.com', '8 Durack St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0094', 'Christian', 'West', 'Mr.', 'Father', '48110289', 'ChristianWest@hotmail.com', '3 Brent St', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0095', 'Samantha', 'Worthington', 'Miss', 'Sister', '45918126', 'SamWorthington@hotmail.com', '2 Keesing Rd', '<img src="../images/none.png" alt="Guardian Picture">'),
('p0096', 'Margaret', 'Xavier', 'Mrs.', 'Mother', '46891036', 'MargeX@hotmail.com', '4 Klewarra Boulevard', '<img src="../images/none.png" alt="Guardian Picture">');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE IF NOT EXISTS `notes` (
  `noteID` int(7) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `datetimeWritten` datetime NOT NULL,
  `note` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `patientID` int(7) unsigned zerofill NOT NULL,
  `staffID` int(4) unsigned zerofill NOT NULL,
  PRIMARY KEY (`noteID`),
  KEY `patientID_idx` (`patientID`),
  KEY `staffID_idx` (`staffID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`noteID`, `datetimeWritten`, `note`, `image`, `patientID`, `staffID`) VALUES
(0000001, '2014-03-18 15:52:00', 'This is just a test.', NULL, 0000001, 0001);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `observations`
--

INSERT INTO `observations` (`observationID`, `timestamp`, `observationTitle`, `observation`, `patientID`, `staffID`) VALUES
(0000001, '2014-03-12 14:00:00', 'Bad Appetite', 'Patient wouldn''t eat his dinner. Told me to "shove it". How rude!', 0000011, 0003);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE IF NOT EXISTS `patients` (
  `patientID` varchar(5) NOT NULL,
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
('p0001', 'Theresa', 'Mitchell', '2008-05-07', '<img src="../images/none.png" alt="Patient Picture">'),
('p0002', 'Randy', 'Smith', '2003-09-25', '<img src="../images/none.png" alt="Patient Picture">'),
('p0003', 'Victor', 'Rodriguez', '1997-02-19', '<img src="../images/none.png" alt="Patient Picture">'),
('p0004', 'Harold', 'Perez', '1997-10-13', '<img src="../images/none.png" alt="Patient Picture">'),
('p0005', 'Marilyn', 'Griffin', '2004-03-23', '<img src="../images/none.png" alt="Patient Picture">'),
('p0006', 'Ashley', 'Kelly', '2009-09-20', '<img src="../images/none.png" alt="Patient Picture">'),
('p0007', 'Michael', 'Adams', '2009-09-17', '<img src="../images/none.png" alt="Patient Picture">'),
('p0008', 'Evelyn', 'Collins', '2005-09-19', '<img src="../images/none.png" alt="Patient Picture">'),
('p0009', 'Timothy', 'Cook', '2003-04-29', '<img src="../images/none.png" alt="Patient Picture">'),
('p0010', 'Christine', 'Howard', '2004-07-06', '<img src="../images/none.png" alt="Patient Picture">'),
('p0011', 'Jason', 'Usang', '2006-04-30', '<img src="../images/none.png" alt="Patient Picture">'),
('p0012', 'Garry', 'Ackbar', '2005-07-15', '<img src="../images/none.png" alt="Patient Picture">'),
('p0013', 'Joanne', 'Adams', '1997-03-06', '<img src="../images/none.png" alt="Patient Picture">'),
('p0014', 'Nicholas', 'Attinborough', '1997-07-01', '<img src="../images/none.png" alt="Patient Picture">'),
('p0015', 'James', 'Barnes', '1999-05-18', '<img src="../images/none.png" alt="Patient Picture">'),
('p0016', 'Julia', 'Barnes', '1999-05-18', '<img src="../images/none.png" alt="Patient Picture">'),
('p0017', 'Arthur', 'Brown', '1999-07-27', '<img src="../images/none.png" alt="Patient Picture">'),
('p0018', 'Jackie', 'Brown', '1999-12-17', '<img src="../images/none.png" alt="Patient Picture">'),
('p0019', 'Redman', 'Brown', '1999-12-24', '<img src="../images/none.png" alt="Patient Picture">'),
('p0020', 'Ron', 'Brown', '2000-08-07', '<img src="../images/none.png" alt="Patient Picture">'),
('p0021', 'Steven', 'Brown', '2001-02-21', '<img src="../images/none.png" alt="Patient Picture">'),
('p0022', 'Leonard', 'Carson', '2001-06-13', '<img src="../images/none.png" alt="Patient Picture">'),
('p0023', 'William', 'Craig', '2001-09-02', '<img src="../images/none.png" alt="Patient Picture">'),
('p0024', 'Richard', 'Coleman', '2001-09-24', '<img src="../images/none.png" alt="Patient Picture">'),
('p0025', 'Grant', 'Davids', '2001-04-06', '<img src="../images/none.png" alt="Patient Picture">'),
('p0026', 'Josephine', 'Erickson', '2001-04-09', '<img src="../images/none.png" alt="Patient Picture">'),
('p0027', 'David', 'Evans', '2005-09-29', '<img src="../images/none.png" alt="Patient Picture">'),
('p0028', 'Hugo', 'Farmsworth', '2006-06-04', '<img src="../images/none.png" alt="Patient Picture">'),
('p0029', 'Judy', 'Fennell', '2006-12-20', '<img src="../images/none.png" alt="Patient Picture">'),
('p0030', 'Susan', 'Ferrel', '2007-03-15', '<img src="../images/none.png" alt="Patient Picture">'),
('p0031', 'Darryl', 'Floyd', '2007-05-03', '<img src="../images/none.png" alt="Patient Picture">'),
('p0032', 'Coleen', 'Fox', '2007-10-23', '<img src="../images/none.png" alt="Patient Picture">'),
('p0033', 'Hubert', 'Fry', '2008-03-26', '<img src="../images/none.png" alt="Patient Picture">'),
('p0034', 'Jeff', 'Gabriel', '2008-04-11', '<img src="../images/none.png" alt="Patient Picture">'),
('p0035', 'Ebony', 'Gardner', '2099-11-23', '<img src="../images/none.png" alt="Patient Picture">'),
('p0036', 'Linda', 'Gerard', '2099-12-17', '<img src="../images/none.png" alt="Patient Picture">'),
('p0037', 'Alberto', 'Godfrey', '2012-09-20', '<img src="../images/none.png" alt="Patient Picture">'),
('p0038', 'Gladys', 'Hammond', '2012-10-30', '<img src="../images/none.png" alt="Patient Picture">'),
('p0039', 'Jody', 'Hawkin', '2013-06-22', '<img src="../images/none.png" alt="Patient Picture">'),
('p0040', 'Jenny', 'Hendrix', '1994-10-26', '<img src="../images/none.png" alt="Patient Picture">'),
('p0041', 'Tyrone', 'Hitchcock', '1995-01-05', '<img src="../images/none.png" alt="Patient Picture">'),
('p0042', 'Alison', 'Hogan', '1996-09-21', '<img src="../images/none.png" alt="Patient Picture">'),
('p0043', 'Curtis', 'Holliday', '1996-10-12', '<img src="../images/none.png" alt="Patient Picture">'),
('p0044', 'Lee', 'Hooker', '1997-03-27', '<img src="../images/none.png" alt="Patient Picture">'),
('p0045', 'Elizabeth', 'Howard', '2000-05-23', '<img src="../images/none.png" alt="Patient Picture">'),
('p0046', 'Billy', 'Hunt', '2000-11-29', '<img src="../images/none.png" alt="Patient Picture">'),
('p0047', 'Nicholas', 'Jackson', '2001-04-11', '<img src="../images/none.png" alt="Patient Picture">'),
('p0048', 'Dominic', 'Jeffries', '2002-05-26', '<img src="../images/none.png" alt="Patient Picture">'),
('p0049', 'Mattie', 'Johnson', '2002-12-20', '<img src="../images/none.png" alt="Patient Picture">'),
('p0050', 'Connor', 'Kent', '2004-02-17', '<img src="../images/none.png" alt="Patient Picture">'),
('p0051', 'Hannah', 'Kirby', '2004-03-06', '<img src="../images/none.png" alt="Patient Picture">'),
('p0052', 'Sarah', 'Lance', '2004-07-08', '<img src="../images/none.png" alt="Patient Picture">'),
('p0053', 'Tricia', 'Lawrence', '2004-08-01', '<img src="../images/none.png" alt="Patient Picture">'),
('p0054', 'Bryan', 'Lincoln', '2005-08-03', '<img src="../images/none.png" alt="Patient Picture">'),
('p0055', 'Alexander', 'Luthor', '2005-08-23', '<img src="../images/none.png" alt="Patient Picture">'),
('p0056', 'Cory', 'Macdonald', '2009-03-24', '<img src="../images/none.png" alt="Patient Picture">'),
('p0057', 'Leroy', 'Mackay', '2009-12-01', '<img src="../images/none.png" alt="Patient Picture">'),
('p0058', 'Nancy', 'Markham', '2010-07-15', '<img src="../images/none.png" alt="Patient Picture">'),
('p0059', 'Cornelius', 'Mathews', '2010-08-03', '<img src="../images/none.png" alt="Patient Picture">'),
('p0060', 'Beatrice', 'McCallister', '2011-03-13', '<img src="../images/none.png" alt="Patient Picture">'),
('p0061', 'Luke', 'Mendez', '2012-03-13', '<img src="../images/none.png" alt="Patient Picture">'),
('p0062', 'Allan', 'Mills', '2012-05-03', '<img src="../images/none.png" alt="Patient Picture">'),
('p0063', 'Christina', 'Monroe', '2013-02-15', '<img src="../images/none.png" alt="Patient Picture">'),
('p0064', 'Martha', 'Morrison', '2013-12-11', '<img src="../images/none.png" alt="Patient Picture">'),
('p0065', 'Trevor', 'Murphy', '1995-04-21', '<img src="../images/none.png" alt="Patient Picture">'),
('p0066', 'Dorothy', 'Nelson', '1995-12-09', '<img src="../images/none.png" alt="Patient Picture">'),
('p0067', 'Timothy', 'Nesbit', '1996-01-11', '<img src="../images/none.png" alt="Patient Picture">'),
('p0068', 'Christina', 'Newman', '1997-02-22', '<img src="../images/none.png" alt="Patient Picture">'),
('p0069', 'Tabitha', 'Nielson', '1997-09-19', '<img src="../images/none.png" alt="Patient Picture">'),
('p0070', 'Sean', 'Nixon', '1998-03-29', '<img src="../images/none.png" alt="Patient Picture">'),
('p0071', 'Krystal', 'Nye', '1998-08-20', '<img src="../images/none.png" alt="Patient Picture">'),
('p0072', 'Jarred', 'Odonnell', '1999-02-07', '<img src="../images/none.png" alt="Patient Picture">'),
('p0073', 'Jasmine', 'Olson', '1999-07-18', '<img src="../images/none.png" alt="Patient Picture">'),
('p0074', 'Alan', 'Osbourne', '1999-08-29', '<img src="../images/none.png" alt="Patient Picture">'),
('p0075', 'Melvin', 'Osullivan', '2000-06-01', '<img src="../images/none.png" alt="Patient Picture">'),
('p0076', 'Lionel', 'Owens', '2001-03-02', '<img src="../images/none.png" alt="Patient Picture">'),
('p0077', 'Freddie', 'Page', '2001-08-13', '<img src="../images/none.png" alt="Patient Picture">'),
('p0078', 'Ellen', 'Parks', '2003-09-11', '<img src="../images/none.png" alt="Patient Picture">'),
('p0079', 'Parker', 'Peterson', '2003-09-27', '<img src="../images/none.png" alt="Patient Picture">'),
('p0080', 'Wanda', 'Phillips', '2004-11-24', '<img src="../images/none.png" alt="Patient Picture">'),
('p0081', 'Richard', 'Pratt', '2005-11-14', '<img src="../images/none.png" alt="Patient Picture">'),
('p0082', 'Marlon', 'Reagan', '2006-04-19', '<img src="../images/none.png" alt="Patient Picture">'),
('p0083', 'Daisy', 'Richardson', '2006-06-05', '<img src="../images/none.png" alt="Patient Picture">'),
('p0084', 'Jacqueline', 'Roberts', '2007-06-05', '<img src="../images/none.png" alt="Patient Picture">'),
('p0085', 'Franklin', 'Sanderson', '2007-11-08', '<img src="../images/none.png" alt="Patient Picture">'),
('p0086', 'Lindsey', 'Shephard', '2009-03-28', '<img src="../images/none.png" alt="Patient Picture">'),
('p0087', 'Brandon', 'Smith', '2011-05-26', '<img src="../images/none.png" alt="Patient Picture">'),
('p0088', 'Max', 'Smith', '2011-12-22', '<img src="../images/none.png" alt="Patient Picture">'),
('p0089', 'Peter', 'Smith', '2012-09-08', '<img src="../images/none.png" alt="Patient Picture">'),
('p0090', 'Robert', 'Stark', '1995-12-12', '<img src="../images/none.png" alt="Patient Picture">'),
('p0091', 'Jeffrey', 'Stephenson', '1997-06-30', '<img src="../images/none.png" alt="Patient Picture">'),
('p0092', 'Isabel', 'Thompson', '1997-10-31', '<img src="../images/none.png" alt="Patient Picture">'),
('p0093', 'Annie', 'Turner', '1999-06-04', '<img src="../images/none.png" alt="Patient Picture">'),
('p0094', 'Adam', 'Wayne', '1999-09-03', '<img src="../images/none.png" alt="Patient Picture">'),
('p0095', 'Burce', 'West', '1999-09-03', '<img src="../images/none.png" alt="Patient Picture">'),
('p0096', 'Helen', 'Worthington', '1999-11-07', '<img src="../images/none.png" alt="Patient Picture">'),
('p0097', 'Charles', 'Xavier', '1999-12-17', '<img src="../images/none.png" alt="Patient Picture">');

-- --------------------------------------------------------

--
-- Table structure for table `patients_guardians`
--
CREATE TABLE IF NOT EXISTS `patients_guardians` (
  `patientID` varchar(5) NOT NULL,
  `guardianID` varchar(5) NOT NULL,
  `relation` varchar(40) NOT NULL,
  PRIMARY KEY (`patientID`,`guardianID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patients_guardians`
--

INSERT INTO `patients_guardians` (`patientID`, `guardianID`, `relation`) VALUES
<<<<<<< HEAD:hospital_2014-05-15.sql
(1, 12, 'Father'),
(2, 10, 'Not related'),
(7, 3, 'Mother'),
(11, 1, 'Father'),
(12, 2, 'Mother'),
(13, 3, 'Mother'),
(14, 4, 'Mother'),
(15, 5, 'Mother'),
(16, 5, 'Mother'),
(17, 6, 'Mother'),
(18, 6, 'Mother'),
(19, 6, 'Mother'),
(20, 6, 'Mother'),
(21, 6, 'Mother'),
(22, 7, 'Grandfather'),
(23, 8, 'Father'),
(24, 9, 'Mother'),
(25, 10, 'Grandmother'),
(26, 11, 'Mother');
=======
('p0011', 'g0001', 'Father'),
('p0012', 'g0002', 'Mother'),
('p0013', 'g0003', 'Mother'),
('p0014', 'g0004', 'Mother'),
('p0015', 'g0005', 'Mother'),
('p0016', 'g0005', 'Mother'),
('p0017', 'g0006', 'Mother'),
('p0022', 'g0007', 'Grandfather'),
('p0023', 'g0008', 'Father'),
('p0024', 'g0009', 'Mother'),
('p0025', 'g0010', 'Grandmother'),
('p0026', 'g0011', 'Mother'),
('p0001', 'g0012', 'Brother'),
('p0002', 'g0013', 'Father'),
('p0003', 'g0014', 'Brother'),
('p0004', 'g0015', 'Mother'),
('p0005', 'g0015', 'Mother'),
('p0006', 'g0016', 'Uncle'),
('p0007', 'g0017', 'Grandfather'),
('p0008', 'g0018', 'Mother'),
('p0009', 'g0019', 'Father'),
('p0010', 'g0020', 'Grandmother'),
('p0018', 'g0021', 'Father'),
('p0019', 'g0022', 'Grandfather'),
('p0020', 'g0023', 'Father'),
('p0021', 'g0024', 'Aunt'),
('p0027', 'g0026', 'Father'),
('p0028', 'g0027', 'Uncle'),
('p0029', 'g0028', 'Mother'),
('p0030', 'g0029', 'Father'),
('p0031', 'g0030', 'Brother'),
('p0032', 'g0031', 'Father'),
('p0033', 'g0032', 'Brother'),
('p0034', 'g0033', 'Father'),
('p0035', 'g0034', 'Uncle'),
('p0036', 'g0035', 'Sister'),
('p0037', 'g0036', 'Mother'),
('p0038', 'g0037', 'Grandmother'),
('p0039', 'g0038', 'Sister'),
('p0040', 'g0039', 'Grandfather'
('p0041', 'g0040', 'Aunt'),
('p0042', 'g0041', 'Father'),
('p0043', 'g0042', 'Father'),
('p0044', 'g0043', 'Brother'),
('p0045', 'g0044', 'Father'),
('p0046', 'g0045', 'Grandmother'),
('p0047', 'g0046', 'Father'),
('p0048', 'g0047', 'Mother'),
('p0049', 'g0048', 'Uncle'),
('p0050', 'g0049', 'Grandmother'),
('p0051', 'g0050', 'Brother'),
('p0052', 'g0051', 'Father'),
('p0053', 'g0052', 'Grandfather'),
('p0054', 'g0053', 'Aunt'),
('p0055', 'g0054', 'Brother'),
('p0056', 'g0055', 'Father'),
('p0057', 'g0056', 'Grandmother'),
('p0058', 'g0057', 'Father'),
('p0059', 'g0058', 'Brother'),
('p0060', 'g0059', 'Aunt'),
('p0061', 'g0060', 'Father'),
('p0062', 'g0061', 'Grandfather'),
('p0063', 'g0062', 'Sister'),
('p0064', 'g0063', 'Grandfather'),
('p0065', 'g0064', 'Father'),
('p0066', 'g0065', 'Uncle'),
('p0067', 'g0066', 'Brother'),
('p0068', 'g0067', 'Father'),
('p0069', 'g0068', 'Grandmother'),
('p0070', 'g0069', 'Sister'),
('p0071', 'g0070', 'Grandmother'),
('p0072', 'g0071', 'Father'),
('p0073', 'g0072', 'Brother'),
('p0074', 'g0073', 'Father'),
('p0075', 'g0074', 'Aunt'),
('p0076', 'g0075', 'Grandfather'),
('p0077', 'g0076', 'Father'),
('p0078', 'g0077', 'Uncle'),
('p0079', 'g0078', 'Aunt'),
('p0080', 'g0079', 'Father'),
('p0081', 'g0080', 'Grandmother'),
('p0082', 'g0081', 'Father'),
('p0083', 'g0082', 'Grandmother'),
('p0084', 'g0083', 'Father'),
('p0085', 'g0084', 'Sister'),
('p0086', 'g0085', 'Brother'),
('p0087', 'g0086', 'Father'),
('p0088', 'g0087', 'Grandmother'),
('p0089', 'g0088', 'Aunt'),
('p0090', 'g0089', 'Father'),
('p0091', 'g0090', 'Mother'),
('p0092', 'g0091', 'Grandfather'),
('p0093', 'g0092', 'Uncle'),
('p0094', 'g0093', 'Grandmother'),
('p0095', 'g0094', 'Father'),
('p0096', 'g0095', 'Sister'),
('p0097', 'g0096', 'Mother'),
>>>>>>> 718fb1d8dd3192ea0605080d5d0d63e0b430a687:hospital_2014-05-12.sql

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
(0000001, '2014-03-02', '2014-03-18', '$2000.00', 'MasterCard', '$1000.00', 0000010);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE IF NOT EXISTS `schedules` (
  `scheduleID` int(7) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `scheduledFor` varchar(255) NOT NULL,
  `scheduledTime` datetime NOT NULL,
  `patientID` int(7) unsigned zerofill NOT NULL,
  PRIMARY KEY (`scheduleID`),
  KEY `patientID_idx` (`patientID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`scheduleID`, `scheduledFor`, `scheduledTime`, `patientID`) VALUES
(0000001, 'MRI. Room 2W04.', '2014-03-10 15:00:00', 0000002);

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
(0009, 'Mr', 'Admin', 5, '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', NULL, '<img src="../images/none.png" alt="Profile picture" />');

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
  ADD CONSTRAINT `notesStaffID` FOREIGN KEY (`staffID`) REFERENCES `staff` (`staffID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `notesPatientID` FOREIGN KEY (`patientID`) REFERENCES `patients` (`patientID`) ON DELETE NO ACTION ON UPDATE CASCADE;

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

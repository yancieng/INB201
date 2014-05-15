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
(0000001, 'Benson', 'Usang', 'Mr.', 'Father', '01421234', 'bensonusa@hotmail.com', '1105/82 Vendor St, Brisbane, 4000', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000002, 'Sheree', 'Ackbar', 'Mrs.', 'Mother', '48535726', 'ackbars@gmail.com', '5 Brinkley St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000003, 'Reanna', 'Adams', 'Mrs.', 'Mother', '45105705', 'adamsR@hotmail.com', '12 Ella Ct', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000004, 'Rona', 'Attinborough', 'Miss', 'Mother', '46128638', 'rattinborough@gmail.com', '11 Lokyer Pl', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000005, 'Cassandra', 'Barnes', 'Ms.', 'Mother', '44572338', 'barnseyc@gmail.com', '5 Chapple St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000006, 'Staci', 'Brown', 'Miss', 'Mother', '47284802', 'missbrown@hotmail.com', '19 Elford Pl', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000007, 'Archibald', 'Carson', 'Mr.', 'Grandfather', '44783001', 'carsona@gmail.com', '17 Kiandra Pl', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000008, 'Nicholas', 'Craig', 'Mr.', 'Father', '48783468', 'NCraig@hotmail.com', '16 Timbury Way', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000009, 'Yolanda', 'Coleman', 'Mrs.', 'Mother', '44641922', 'ycolemany@hotmail.com', '4 Kallandra St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000010, 'Lauraine', 'Davids', 'Mrs.', 'Grandmother', '43403132', 'Lavids@hotmail.com', '6 St Albans Rd', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000011, 'Katherine', 'Erickson', 'Mrs.', 'Mother', '45620853', 'ericksonk@gmail.com', '25 Karanya St', '<img src="../images/none.png" alt="Guardian Picture">'),
(0000012, 'William', 'Mitchell', 'Mr.', '', '44315415', 'witchell@hotmail.com', '12 Oldland St', '<img src="../images/none.png" alt="Guardian Picture">');

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
(0000097, 'Charles', 'Xavier', '1999-12-17', '<img src="../images/none.png" alt="Patient Picture">');

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

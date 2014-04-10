-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2014 at 04:22 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `beds`
--

CREATE TABLE IF NOT EXISTS `beds` (
  `bedNumber` varchar(5) NOT NULL,
  `patientID` int(7) unsigned zerofill DEFAULT NULL,
  PRIMARY KEY (`bedNumber`),
  UNIQUE KEY `patientID` (`patientID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `beds`
--

INSERT INTO `beds` (`bedNumber`, `patientID`) VALUES
('1A03', NULL),
('1A04', NULL),
('1B01b', NULL),
('1B02a', NULL),
('1B02b', NULL),
('1B01a', 0000001),
('1A01', 0000002),
('1A02', 0000007);

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
-- Table structure for table `patients`
--

CREATE TABLE IF NOT EXISTS `patients` (
  `patientID` int(7) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `firstName` varchar(40) NOT NULL,
  `lastName` varchar(40) NOT NULL,
  `address` varchar(255) NOT NULL,
  `DOB` date NOT NULL,
  `contactNumber` varchar(15) NOT NULL,
  `emergencyNumber` varchar(15) DEFAULT NULL,
  `caregiverNumber` varchar(15) DEFAULT NULL,
  `bloodType` char(3) NOT NULL,
  `previousNotes` text,
  PRIMARY KEY (`patientID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patientID`, `firstName`, `lastName`, `address`, `DOB`, `contactNumber`, `emergencyNumber`, `caregiverNumber`, `bloodType`, `previousNotes`) VALUES
(0000001, 'Theresa', 'Mitchell', '49 Guildford Road', '2008-05-07', '33478453', NULL, NULL, 'B+', NULL),
(0000002, 'Randy', 'Smith', '40A Portland Place', '2003-09-25', '33164785', NULL, NULL, 'B-', NULL),
(0000003, 'Victor', 'Rodriguez', '5 Stoneleigh Avenue', '1997-02-19', '33172191', NULL, NULL, 'O+', NULL),
(0000004, 'Harold', 'Perez', '7 Trefleur Close', '1997-10-13', '33818687', NULL, NULL, 'O-', NULL),
(0000005, 'Marilyn', 'Griffin', '2 Edward Jermyn Drive', '2004-03-23', '33474186', NULL, NULL, 'AB+', NULL),
(0000006, 'Ashley', 'Kelly', '4 Edenside Drive', '2009-09-20', '33154216', NULL, NULL, 'O-', NULL),
(0000007, 'Michael', 'Adams', '3 Miners Row', '2009-09-17', '33987654', NULL, NULL, 'AB+', NULL),
(0000008, 'Evelyn', 'Collins', '12 Broomhouse Gardens West', '2005-09-19', '33124578', NULL, NULL, 'A-', NULL),
(0000009, 'Timothy', 'Cook', '49 Kewstone Road', '2003-04-29', '33618864', NULL, NULL, 'B+', NULL),
(0000010, 'Christine', 'Howard', '84 Grange Road', '2004-07-06', '33684714', NULL, NULL, 'O+', NULL);

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
  PRIMARY KEY (`staffID`),
  KEY `title_idx` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffID`, `firstName`, `lastName`, `title`, `password`) VALUES
(0001, 'Marco', 'Simon', 1, '72f4be89d6ebab1496e21e38bcd7c8ca0a68928af3081ad7dff87e772eb350c2'),
(0002, 'Terry', 'Walker', 3, '849f10fbdbd58feec169787af0896866ea7aa812aa189baf96f7b024ecddbfbc'),
(0003, 'Lynne', 'Peterson', 2, '781e5116a1e14a34eada50159d589e690c81ec4c5063115ea1f10b99441d5b94'),
(0004, 'Glenn', 'Cobb', 4, 'c3bca14c650063bb88e5a82f757c11defaf4ea06c18368c9c9b70c5d77933dd3'),
(0005, 'Ora', 'Elliot', 5, '4194d1706ed1f408d5e02d672777019f4d5385c766a8c6ca8acba3167d36a7b9'),
(0009, 'Mr', 'Admin', 5, '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8');

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
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notesStaffID` FOREIGN KEY (`staffID`) REFERENCES `staff` (`staffID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `notesPatientID` FOREIGN KEY (`patientID`) REFERENCES `patients` (`patientID`) ON DELETE NO ACTION ON UPDATE CASCADE;

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

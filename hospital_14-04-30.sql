-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2014 at 05:40 AM
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
  `checkupTime` datetime NOT NULL,
  `height` float DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `temperature` float DEFAULT NULL,
  `eyesightLeft` float DEFAULT NULL,
  `eyesightRight` float DEFAULT NULL,
  `bloodPressure` varchar(7) DEFAULT NULL,
  `bloodSugar` float DEFAULT NULL,
  `conditionAllergy` varchar(40) DEFAULT NULL,
  `medication` varchar(40) DEFAULT NULL,
  `patientID` int(7) unsigned zerofill NOT NULL,
  PRIMARY KEY (`checkupID`),
  KEY `patientID` (`patientID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `checkups`
--

INSERT INTO `checkups` (`checkupID`, `checkupTime`, `height`, `weight`, `temperature`, `eyesightLeft`, `eyesightRight`, `bloodPressure`, `bloodSugar`, `conditionAllergy`, `medication`, `patientID`) VALUES
(0000001, '2014-04-28 12:56:00', 114, 26, 38.5, 1, 1.5, '120/81', 75, NULL, NULL, 0000011);

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
  PRIMARY KEY (`guardianID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `guardians`
--

INSERT INTO `guardians` (`guardianID`, `firstName`, `lastName`, `title`, `relation`, `contactNumber`, `email`, `address`) VALUES
(0000001, 'Benson', 'Usang', 'Mr.', 'Father / Son', '01421234', 'bensonusa@hotmail.com', '1105/82 Vendor St, Brisbane, 4000');

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
  `observationDate` date NOT NULL,
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

INSERT INTO `observations` (`observationID`, `observationDate`, `observationTitle`, `observation`, `patientID`, `staffID`) VALUES
(0000001, '2014-03-13', 'Bad Appetite', 'Patient wouldn''t eat his dinner. Told me to "shove it". How rude!', 0000011, 0003);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE IF NOT EXISTS `patients` (
  `patientID` int(7) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `firstName` varchar(40) NOT NULL,
  `lastName` varchar(40) NOT NULL,
  `DOB` date NOT NULL,
  `bloodType` enum('O+','O-','A+','A-','B+','B-','AB+','AB-') NOT NULL,
  `previousNotes` text,
  `guardianID` int(7) unsigned zerofill DEFAULT NULL,
  PRIMARY KEY (`patientID`),
  KEY `guardianID` (`guardianID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patientID`, `firstName`, `lastName`, `DOB`, `bloodType`, `previousNotes`, `guardianID`) VALUES
(0000001, 'Theresa', 'Mitchell', '2008-05-07', 'B+', NULL, NULL),
(0000002, 'Randy', 'Smith', '2003-09-25', 'B-', NULL, NULL),
(0000003, 'Victor', 'Rodriguez', '1997-02-19', 'O+', NULL, NULL),
(0000004, 'Harold', 'Perez', '1997-10-13', 'O-', NULL, NULL),
(0000005, 'Marilyn', 'Griffin', '2004-03-23', 'AB+', NULL, NULL),
(0000006, 'Ashley', 'Kelly', '2009-09-20', 'O-', NULL, NULL),
(0000007, 'Michael', 'Adams', '2009-09-17', 'AB+', NULL, NULL),
(0000008, 'Evelyn', 'Collins', '2005-09-19', 'A-', NULL, NULL),
(0000009, 'Timothy', 'Cook', '2003-04-29', 'B+', NULL, NULL),
(0000010, 'Christine', 'Howard', '2004-07-06', 'O+', NULL, NULL),
(0000011, 'Jason', 'Usang', '2006-04-30', 'A-', NULL, 0000001);

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
  `photo` varchar(200) DEFAULT NULL,
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
  ADD CONSTRAINT `checkupPatient` FOREIGN KEY (`patientID`) REFERENCES `patients` (`patientID`) ON DELETE NO ACTION ON UPDATE CASCADE;

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
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patientsGuardian` FOREIGN KEY (`guardianID`) REFERENCES `guardians` (`guardianID`) ON DELETE NO ACTION ON UPDATE CASCADE;

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

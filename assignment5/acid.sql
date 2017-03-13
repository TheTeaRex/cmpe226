-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 27, 2017 at 02:21 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acid`
--

-- --------------------------------------------------------

--
-- Table structure for table `Building`
--

CREATE TABLE `Building` (
  `BuildingID` varchar(11) NOT NULL,
  `BuildingName` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Building`
--

INSERT INTO `Building` (`BuildingID`, `BuildingName`) VALUES
('E1', 'Engineering Building I'),
('MH', 'Music Hall'),
('SU', 'Student Union');

-- --------------------------------------------------------

--
-- Table structure for table `Class`
--

CREATE TABLE `Class` (
  `ClassID` int(11) NOT NULL,
  `ClassName` varchar(20) NOT NULL,
  `ClassTime` varchar(20) NOT NULL,
  `TeacherID` int(11) NOT NULL,
  `RoomNum` int(11) NOT NULL,
  `BuildingID` varchar(11) NOT NULL,
  `LabID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Class`
--

INSERT INTO `Class` (`ClassID`, `ClassName`, `ClassTime`, `TeacherID`, `RoomNum`, `BuildingID`, `LabID`) VALUES
(128, 'Microcomputer Design', 'Mon', 2364558, 104, 'E1', NULL),
(224, 'Information Security', 'Tue', 1123453, 101, 'E1', NULL),
(281, 'Cloud Computing', 'Wed', 1648576, 127, 'E1', NULL),
(321, 'Database', 'Fri', 9876543, 104, 'E1', 321);

-- --------------------------------------------------------

--
-- Table structure for table `Classroom`
--

CREATE TABLE `Classroom` (
  `BuildingID` varchar(11) NOT NULL,
  `RoomNum` int(11) NOT NULL,
  `NoOfSeats` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Classroom`
--

INSERT INTO `Classroom` (`BuildingID`, `RoomNum`, `NoOfSeats`) VALUES
('E1', 100, 60),
('E1', 101, 32),
('E1', 102, 50),
('E1', 103, 34),
('E1', 104, 50),
('E1', 105, 60),
('E1', 107, 60),
('SU', 110, 60),
('E1', 127, 33),
('MH', 210, 100);

-- --------------------------------------------------------

--
-- Table structure for table `Deparment`
--

CREATE TABLE `Deparment` (
  `DeptID` int(11) NOT NULL,
  `DeptName` varchar(80) NOT NULL,
  `InstID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Deparment`
--

INSERT INTO `Deparment` (`DeptID`, `DeptName`, `InstID`) VALUES
(1, 'College of Arts', 1),
(2, 'Lucas College and Graduate School of Business', 1),
(3, 'Connie L. Lurie College of Education', 1),
(4, 'Charles W. Davidson College of Engineering', 1),
(5, 'College of Science', 1);

-- --------------------------------------------------------

--
-- Table structure for table `enrolls`
--

CREATE TABLE `enrolls` (
  `StuID` int(11) NOT NULL,
  `ClassID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrolls`
--

INSERT INTO `enrolls` (`StuID`, `ClassID`) VALUES
(11374625, 281),
(11374625, 321),
(11385634, 224),
(11385634, 321),
(11497777, 128),
(11497777, 321),
(11596554, 128),
(11596554, 321);

-- --------------------------------------------------------

--
-- Table structure for table `Insitution`
--

CREATE TABLE `Insitution` (
  `InstID` int(11) NOT NULL,
  `InName` varchar(40) NOT NULL,
  `Abbre` varchar(20) NOT NULL,
  `Street` varchar(40) NOT NULL,
  `HouseNo` int(11) NOT NULL,
  `City` varchar(20) NOT NULL,
  `State` varchar(20) NOT NULL,
  `ZipCode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Insitution`
--

INSERT INTO `Insitution` (`InstID`, `InName`, `Abbre`, `Street`, `HouseNo`, `City`, `State`, `ZipCode`) VALUES
(1, 'San Jose State University', 'SJSU', '1 Washington Sq', 0, 'San Jose', 'CA', 95192);

-- --------------------------------------------------------

--
-- Table structure for table `joins`
--

CREATE TABLE `joins` (
  `StuID` int(11) NOT NULL,
  `GroupID` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `joins`
--

INSERT INTO `joins` (`StuID`, `GroupID`) VALUES
(11374625, 'S123');

-- --------------------------------------------------------

--
-- Table structure for table `Lab`
--

CREATE TABLE `Lab` (
  `LabID` int(11) NOT NULL,
  `LabName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Lab`
--

INSERT INTO `Lab` (`LabID`, `LabName`) VALUES
(321, 'Computer Lab I');

-- --------------------------------------------------------

--
-- Table structure for table `Position`
--

CREATE TABLE `Position` (
  `PosID` int(11) NOT NULL,
  `PosName` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Position`
--

INSERT INTO `Position` (`PosID`, `PosName`) VALUES
(0, 'undergraduate'),
(1, 'graduate'),
(2, 'phd'),
(3, 'lecture'),
(4, 'associate professor'),
(5, 'professor');

-- --------------------------------------------------------

--
-- Table structure for table `Student`
--

CREATE TABLE `Student` (
  `StuID` int(11) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `Gender` varchar(1) NOT NULL,
  `Scholarship` varchar(11) DEFAULT NULL,
  `Age` int(3) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Major` varchar(40) NOT NULL,
  `AttendYear` year(4) NOT NULL,
  `PosID` int(11) NOT NULL,
  `DeptID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Student`
--

INSERT INTO `Student` (`StuID`, `FirstName`, `LastName`, `Gender`, `Scholarship`, `Age`, `Email`, `Major`, `AttendYear`, `PosID`, `DeptID`) VALUES
(11348573, 'Claire', 'Beech', 'M', NULL, 28, 'clair.beech@sjsu.edu', 'Mathmatics', 2013, 1, 5),
(11374625, 'Aria', 'Bail', 'F', 'TA', 25, 'aria.bail@sjsu.edu', 'Software Engineering', 2016, 1, 4),
(11385634, 'Ken', 'Web', 'M', NULL, 24, 'ken.web@sjsu.edu', 'Computer Science', 2016, 0, 4),
(11475432, 'Lucy', 'Lee', 'F', 'RA', 26, 'lucy.lee@sjsu.edu', 'International Education', 2016, 0, 3),
(11497777, 'Dylan', 'Bandy', 'M', NULL, 28, 'dylan.bandy@gmail.com', 'Electrical Engineering', 1985, 2, 4),
(11596554, 'Nora', 'Banford', 'F', NULL, 25, 'nora.banford@sjsu.edu', 'Electrical Engineering', 2014, 2, 4),
(11735467, 'Jimmy', 'Chou', 'M', NULL, 23, 'jimmy.chou@sjsu.edu', 'International Finance', 1996, 0, 2),
(11763548, 'Mila', 'Bear', 'F', NULL, 23, 'mila.bear@sjsu.edu', 'Music', 1987, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `StuGroup`
--

CREATE TABLE `StuGroup` (
  `GroupID` varchar(11) NOT NULL,
  `GroupType` varchar(11) NOT NULL,
  `GroupAnnualBudget` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `StuGroup`
--

INSERT INTO `StuGroup` (`GroupID`, `GroupType`, `GroupAnnualBudget`) VALUES
('S123', 'Dance', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `TeacherID` int(11) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `Gender` varchar(1) NOT NULL,
  `Age` int(3) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `AttendYear` year(4) NOT NULL,
  `DeptID` int(11) NOT NULL,
  `PosID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`TeacherID`, `FirstName`, `LastName`, `Gender`, `Age`, `Email`, `AttendYear`, `DeptID`, `PosID`) VALUES
(1123453, 'Mia', 'Abney', 'F', 29, 'mia.abney@sjsu.edu', 2000, 4, 3),
(1187863, 'Lily', 'Adcock', 'F', 57, 'lily.adcock@sjsu.edu', 2008, 3, 5),
(1538764, 'Angel', 'Ann', 'F', 45, 'angel.ann@sjsu.edu', 2014, 3, 3),
(1648576, 'Steven', 'White', 'M', 31, 'steven.white@sjsu.edu', 2003, 4, 3),
(1847364, 'Mark', 'Martin', 'M', 53, 'mark.martin@sjsu.edu', 2006, 2, 4),
(2364558, 'Thomas', 'Lee', 'M', 66, 'thomas.lee@sjsu.edu', 2000, 5, 3),
(3847561, 'Emma', 'Adams', 'F', 67, 'emma.adams@sjsu.edu', 1981, 5, 4),
(3847562, 'Sophia', 'Abram', 'F', 43, 'sophia.abram@sjsu.edu', 2043, 4, 4),
(6384756, 'John', 'Smith', 'M', 54, 'john.smith@gmail.com', 1987, 3, 5),
(9876543, 'Robert', 'Williams', 'M', 35, 'robert.williams@sjsu.edu', 1990, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_phonenum`
--

CREATE TABLE `teacher_phonenum` (
  `PhoneNum` bigint(10) NOT NULL,
  `TeacherID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `teacher_phonenum`
--

INSERT INTO `teacher_phonenum` (`PhoneNum`, `TeacherID`) VALUES
(1234325432, 1187863),
(1765432876, 1187863),
(4572463423, 3847562),
(5305436543, 1648576),
(5465768435, 9876543),
(6543827364, 1123453),
(7653849253, 2364558),
(7659872416, 1123453);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Building`
--
ALTER TABLE `Building`
  ADD PRIMARY KEY (`BuildingID`);

--
-- Indexes for table `Class`
--
ALTER TABLE `Class`
  ADD PRIMARY KEY (`ClassID`),
  ADD KEY `LabID` (`LabID`),
  ADD KEY `class_ibfk_1` (`TeacherID`),
  ADD KEY `BuildingID` (`BuildingID`),
  ADD KEY `RoomNum` (`RoomNum`,`BuildingID`);

--
-- Indexes for table `Classroom`
--
ALTER TABLE `Classroom`
  ADD PRIMARY KEY (`RoomNum`,`BuildingID`),
  ADD KEY `BuildingID` (`BuildingID`);

--
-- Indexes for table `Deparment`
--
ALTER TABLE `Deparment`
  ADD PRIMARY KEY (`DeptID`),
  ADD KEY `InstID` (`InstID`);

--
-- Indexes for table `enrolls`
--
ALTER TABLE `enrolls`
  ADD PRIMARY KEY (`StuID`,`ClassID`),
  ADD KEY `ClassID` (`ClassID`);

--
-- Indexes for table `Insitution`
--
ALTER TABLE `Insitution`
  ADD PRIMARY KEY (`InstID`);

--
-- Indexes for table `joins`
--
ALTER TABLE `joins`
  ADD PRIMARY KEY (`StuID`,`GroupID`),
  ADD KEY `GroupID` (`GroupID`);

--
-- Indexes for table `Lab`
--
ALTER TABLE `Lab`
  ADD PRIMARY KEY (`LabID`);

--
-- Indexes for table `Position`
--
ALTER TABLE `Position`
  ADD PRIMARY KEY (`PosID`);

--
-- Indexes for table `Student`
--
ALTER TABLE `Student`
  ADD PRIMARY KEY (`StuID`) USING BTREE,
  ADD KEY `student_ibfk_1` (`PosID`),
  ADD KEY `DeptID` (`DeptID`);

--
-- Indexes for table `StuGroup`
--
ALTER TABLE `StuGroup`
  ADD PRIMARY KEY (`GroupID`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`TeacherID`),
  ADD KEY `DeptID` (`DeptID`),
  ADD KEY `teacher_ibfk_1` (`PosID`);

--
-- Indexes for table `teacher_phonenum`
--
ALTER TABLE `teacher_phonenum`
  ADD PRIMARY KEY (`PhoneNum`,`TeacherID`),
  ADD KEY `TeacherID` (`TeacherID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Class`
--
ALTER TABLE `Class`
  ADD CONSTRAINT `class_ibfk_1` FOREIGN KEY (`TeacherID`) REFERENCES `teacher` (`TeacherID`),
  ADD CONSTRAINT `class_ibfk_3` FOREIGN KEY (`LabID`) REFERENCES `Lab` (`LabID`),
  ADD CONSTRAINT `class_ibfk_4` FOREIGN KEY (`RoomNum`,`BuildingID`) REFERENCES `Classroom` (`RoomNum`, `BuildingID`);

--
-- Constraints for table `Classroom`
--
ALTER TABLE `Classroom`
  ADD CONSTRAINT `classroom_ibfk_1` FOREIGN KEY (`BuildingID`) REFERENCES `Building` (`BuildingID`);

--
-- Constraints for table `Deparment`
--
ALTER TABLE `Deparment`
  ADD CONSTRAINT `deparment_ibfk_1` FOREIGN KEY (`InstID`) REFERENCES `Insitution` (`InstID`);

--
-- Constraints for table `enrolls`
--
ALTER TABLE `enrolls`
  ADD CONSTRAINT `enrolls_ibfk_1` FOREIGN KEY (`StuID`) REFERENCES `Student` (`StuID`),
  ADD CONSTRAINT `enrolls_ibfk_2` FOREIGN KEY (`ClassID`) REFERENCES `Class` (`ClassID`);

--
-- Constraints for table `joins`
--
ALTER TABLE `joins`
  ADD CONSTRAINT `joins_ibfk_1` FOREIGN KEY (`StuID`) REFERENCES `Student` (`StuID`),
  ADD CONSTRAINT `joins_ibfk_2` FOREIGN KEY (`GroupID`) REFERENCES `StuGroup` (`GroupID`);

--
-- Constraints for table `Student`
--
ALTER TABLE `Student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`PosID`) REFERENCES `Position` (`PosID`),
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`DeptID`) REFERENCES `Deparment` (`DeptID`);

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`PosID`) REFERENCES `Position` (`PosID`),
  ADD CONSTRAINT `teacher_ibfk_2` FOREIGN KEY (`DeptID`) REFERENCES `Deparment` (`DeptID`);

--
-- Constraints for table `teacher_phonenum`
--
ALTER TABLE `teacher_phonenum`
  ADD CONSTRAINT `teacher_phonenum_ibfk_1` FOREIGN KEY (`TeacherID`) REFERENCES `teacher` (`TeacherID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

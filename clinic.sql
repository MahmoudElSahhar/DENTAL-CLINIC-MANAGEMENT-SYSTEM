-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2019 at 02:51 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `analysis`
--

CREATE TABLE `analysis` (
  `ID` int(11) NOT NULL,
  `PatientID` int(11) NOT NULL,
  `Content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `analysis`
--

INSERT INTO `analysis` (`ID`, `PatientID`, `Content`) VALUES
(2, 87, 'yes'),
(3, 97, 'Untitled3.png'),
(4, 97, 'Untitled2.png'),
(5, 97, 'Untitled10.png');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `ID` int(11) NOT NULL,
  `DoctorID` int(11) NOT NULL,
  `PatientID` int(11) NOT NULL,
  `PrescriptionID` int(11) DEFAULT NULL,
  `BillID` int(11) DEFAULT NULL,
  `Date` date NOT NULL,
  `Type` varchar(25) NOT NULL,
  `StartTime` time NOT NULL,
  `EndTime` time NOT NULL,
  `Confirmed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`ID`, `DoctorID`, `PatientID`, `PrescriptionID`, `BillID`, `Date`, `Type`, `StartTime`, `EndTime`, `Confirmed`) VALUES
(3, 80, 17, 30, 3, '2018-12-11', 'visit', '08:00:00', '08:30:00', 1),
(4, 80, 17, 24, 4, '2018-12-12', 'visit', '10:00:00', '10:30:00', 0),
(5, 80, 17, 31, NULL, '2018-12-13', 'visit', '12:00:00', '12:30:00', 1),
(6, 80, 17, NULL, NULL, '2018-12-14', 'visit', '14:00:00', '14:30:00', 0),
(7, 80, 17, NULL, NULL, '2018-12-15', 'visit', '17:00:00', '17:30:00', 0),
(9, 81, 87, NULL, NULL, '2018-12-25', 'check', '10:00:00', '10:30:00', 0),
(26, 80, 97, NULL, 2, '2019-01-05', 'check', '04:00:00', '04:30:00', 1),
(29, 80, 97, NULL, NULL, '2019-01-06', 'check', '09:00:00', '11:00:00', 1),
(34, 80, 97, NULL, NULL, '2019-01-06', 'check', '15:30:00', '16:00:00', 0),
(35, 80, 97, NULL, NULL, '2019-01-09', 'check', '13:30:00', '15:00:00', 0),
(36, 80, 87, NULL, NULL, '2019-01-12', 'check', '14:00:00', '15:00:00', 0),
(37, 80, 97, NULL, NULL, '2019-01-09', 'visit', '12:00:00', '14:30:00', 0),
(38, 80, 97, NULL, NULL, '2019-01-16', 'check', '11:00:00', '13:00:00', 0),
(39, 80, 87, NULL, NULL, '2019-01-13', 'check', '08:00:00', '09:30:00', 0),
(40, 80, 87, NULL, NULL, '2019-01-14', 'check', '12:00:00', '13:30:00', 0),
(42, 80, 87, NULL, NULL, '2019-01-14', 'check', '15:30:00', '17:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `ID` int(11) NOT NULL,
  `Cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`ID`, `Cost`) VALUES
(1, 200),
(2, 26),
(3, 500),
(4, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_availability`
--

CREATE TABLE `doctor_availability` (
  `ID` int(11) NOT NULL,
  `DoctorID` int(11) NOT NULL,
  `Day` varchar(10) NOT NULL,
  `StartTime` time NOT NULL,
  `EndTime` time NOT NULL,
  `Until` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_availability`
--

INSERT INTO `doctor_availability` (`ID`, `DoctorID`, `Day`, `StartTime`, `EndTime`, `Until`) VALUES
(378, 80, '2', '10:00:00', '14:00:00', NULL),
(379, 80, '5', '14:00:00', '15:00:00', NULL),
(391, 81, '4', '09:00:00', '10:00:00', NULL),
(392, 81, '5', '11:00:00', '12:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_excuse`
--

CREATE TABLE `doctor_excuse` (
  `ID` int(11) NOT NULL,
  `DoctorID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `StartTime` time NOT NULL,
  `EndTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_excuse`
--

INSERT INTO `doctor_excuse` (`ID`, `DoctorID`, `Date`, `StartTime`, `EndTime`) VALUES
(23, 80, '2018-12-12', '12:00:00', '14:00:00'),
(25, 80, '2018-12-18', '13:00:00', '18:00:00'),
(27, 80, '2019-01-02', '10:00:00', '14:00:00'),
(29, 80, '2019-01-01', '14:00:00', '15:00:00'),
(30, 80, '2019-01-02', '09:00:00', '18:00:00'),
(32, 80, '2019-01-05', '14:00:00', '16:00:00'),
(35, 80, '2019-01-06', '08:00:00', '09:00:00'),
(36, 80, '2019-01-06', '12:00:00', '15:00:00'),
(37, 80, '2019-01-06', '16:00:00', '17:00:00'),
(38, 80, '2019-01-07', '13:00:00', '15:00:00'),
(39, 80, '2019-01-09', '12:00:00', '14:00:00'),
(40, 80, '2019-01-23', '10:00:00', '13:00:00'),
(41, 80, '2019-01-07', '13:00:00', '14:00:00'),
(42, 80, '2019-01-14', '14:00:00', '15:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `ID` int(11) NOT NULL,
  `PatientID` int(11) NOT NULL,
  `ReseptionistID` int(11) DEFAULT NULL,
  `InquiryContent` text NOT NULL,
  `Respond` text,
  `Answered` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inquiry`
--

INSERT INTO `inquiry` (`ID`, `PatientID`, `ReseptionistID`, `InquiryContent`, `Respond`, `Answered`) VALUES
(4, 87, 99, 'yessss', 'hu', 1),
(5, 97, 99, 'what the hell is that', 'jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj', 1),
(6, 97, 99, 'what the hell is that 2', 'hhujj', 1),
(7, 97, NULL, 'helllllllllllllllllllllloooooooooooooooooooooooooooooooooooooooooooo', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `ID` int(11) NOT NULL,
  `Content` text NOT NULL,
  `PatientID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`ID`, `Content`, `PatientID`) VALUES
(1, 'Medicines names', NULL),
(2, 'Welcome', NULL),
(6, 'Happy Hunger Games', NULL),
(8, 'Happy Hunger Games2', NULL),
(14, 'helllllllooooooooooooooooooooooooooo', NULL),
(17, 'Happy Hunger Games', NULL),
(19, 'yeswhat22', NULL),
(22, 'hhhhhhhhhhhhh', NULL),
(24, 'Good', NULL),
(28, 'Bad', NULL),
(30, 'Good Day', NULL),
(31, 'hello', NULL),
(32, 'Untitled3.png', NULL),
(33, 'Untitled2.png', NULL),
(34, 'Texting-Driving.jpg', NULL),
(35, 'Untitled.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `FullName` varchar(50) NOT NULL,
  `DOB` date NOT NULL,
  `Telephone` varchar(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `UserType` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `FullName`, `DOB`, `Telephone`, `Username`, `Password`, `Email`, `UserType`) VALUES
(17, 'KKK', '2017-11-12', '010', 'bc', '12333\r\n        ', 'kkk@gmail.com', 2),
(23, 'Daniel Nagy', '1980-07-16', '01500', 'dani', '', 'dani@yahoo.com', 1),
(80, 'Youssef Talaat', '1950-02-07', '0101010', 'youssef', '123', 'youssef@yahoo.com', 1),
(81, 'Youssef Talaat', '2018-12-09', '010', 'youssef2', '456', 'youssef@yahoo.com', 1),
(87, 'Mahmoud Sahhar', '1991-06-04', '012', 'sa77ar', '789', 'sa77ar@yahoo.com', 2),
(97, 'Mahmoud Sahhar', '2000-11-26', '1056', 'mahmoud', '456', 'mahmoud@ymail.com', 2),
(99, 'YoussefTalaat', '2018-12-04', '015', 'recep', '123', 'youssef@yahoo.com', 3),
(100, 'YoussefTalaat', '2018-12-04', '05', 'admin', 'admin', 'youssef@yahoo.com', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `ID` int(11) NOT NULL,
  `UserType` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`ID`, `UserType`) VALUES
(1, 'Doctor'),
(2, 'Patient'),
(3, 'Receptionist'),
(4, 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analysis`
--
ALTER TABLE `analysis`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `PatientID` (`PatientID`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `DoctorID` (`DoctorID`,`PatientID`,`PrescriptionID`,`BillID`),
  ADD KEY `PatientID` (`PatientID`),
  ADD KEY `PrescriptionID` (`PrescriptionID`),
  ADD KEY `BillID` (`BillID`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `doctor_availability`
--
ALTER TABLE `doctor_availability`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `DoctorID` (`DoctorID`);

--
-- Indexes for table `doctor_excuse`
--
ALTER TABLE `doctor_excuse`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `DoctorID` (`DoctorID`);

--
-- Indexes for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `PatientID` (`PatientID`,`ReseptionistID`),
  ADD KEY `ReseptionistID` (`ReseptionistID`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Username_2` (`Username`),
  ADD UNIQUE KEY `Username_3` (`Username`),
  ADD KEY `UserType` (`UserType`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `analysis`
--
ALTER TABLE `analysis`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `doctor_availability`
--
ALTER TABLE `doctor_availability`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=393;

--
-- AUTO_INCREMENT for table `doctor_excuse`
--
ALTER TABLE `doctor_excuse`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `analysis`
--
ALTER TABLE `analysis`
  ADD CONSTRAINT `analysis_ibfk_1` FOREIGN KEY (`PatientID`) REFERENCES `user` (`ID`);

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`DoctorID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`PatientID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `appointment_ibfk_3` FOREIGN KEY (`PrescriptionID`) REFERENCES `prescription` (`ID`),
  ADD CONSTRAINT `appointment_ibfk_4` FOREIGN KEY (`BillID`) REFERENCES `bill` (`ID`);

--
-- Constraints for table `doctor_availability`
--
ALTER TABLE `doctor_availability`
  ADD CONSTRAINT `doctor_availability_ibfk_1` FOREIGN KEY (`DoctorID`) REFERENCES `user` (`ID`);

--
-- Constraints for table `doctor_excuse`
--
ALTER TABLE `doctor_excuse`
  ADD CONSTRAINT `doctor_excuse_ibfk_1` FOREIGN KEY (`DoctorID`) REFERENCES `user` (`ID`);

--
-- Constraints for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD CONSTRAINT `inquiry_ibfk_1` FOREIGN KEY (`PatientID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `inquiry_ibfk_2` FOREIGN KEY (`ReseptionistID`) REFERENCES `user` (`ID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`UserType`) REFERENCES `user_type` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

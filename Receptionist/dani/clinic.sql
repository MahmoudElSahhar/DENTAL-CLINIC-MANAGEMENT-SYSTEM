-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2018 at 07:46 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

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
(7, 12, 'Text');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `ID` int(11) NOT NULL,
  `DoctorID` int(11) NOT NULL,
  `PatientID` int(11) NOT NULL,
  `PrescriptionID` int(11) NOT NULL,
  `BillID` int(11) NOT NULL,
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
(1, 4, 12, 1, 1, '2018-12-12', 'check', '09:00:00', '09:30:00', 0);

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
(1, 200);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_availability`
--

CREATE TABLE `doctor_availability` (
  `ID` int(11) NOT NULL,
  `DoctorID` int(11) NOT NULL,
  `Day` varchar(10) NOT NULL,
  `StartTime` time NOT NULL,
  `EndTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_excuse`
--

CREATE TABLE `doctor_excuse` (
  `ID` int(11) NOT NULL,
  `DoctorID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Day` varchar(10) NOT NULL,
  `StartTime` time NOT NULL,
  `EndTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `ID` int(11) NOT NULL,
  `PatientID` int(11) NOT NULL,
  `ReseptionistID` int(11) NOT NULL,
  `InquiryContent` text NOT NULL,
  `Respond` text NOT NULL,
  `Answered` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inquiry`
--

INSERT INTO `inquiry` (`ID`, `PatientID`, `ReseptionistID`, `InquiryContent`, `Respond`, `Answered`) VALUES
(1, 12, 14, 'Question', 'Answer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `ID` int(11) NOT NULL,
  `Content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`ID`, `Content`) VALUES
(1, 'Medicines names'),
(2, 'Welcome');

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
(4, 'Ali Omar', '1995-12-08', '010894624', 'abc', '123', 'ali@gmail.com', 1),
(12, 'Ahmed Khaled', '1970-05-02', '010458673', 'abc', '123', 'ahmed@gmail.com', 2),
(14, 'Mahmoud Ahmed', '1980-04-16', '0117965463', 'abc', '123', 'mhmoud@gmail.com', 3),
(17, 'KKK', '2017-11-12', '010', 'bc', '12333\r\n        ', 'kkk@gmail.com', 2);

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
(3, 'Receptionist');

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `doctor_availability`
--
ALTER TABLE `doctor_availability`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor_excuse`
--
ALTER TABLE `doctor_excuse`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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

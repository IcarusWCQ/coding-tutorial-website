-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2024 at 04:49 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_ID` int(11) NOT NULL COMMENT 'Admin''s ID',
  `Admin_Name` varchar(100) DEFAULT NULL COMMENT 'Admin''s Name',
  `Admin_Email` varchar(50) DEFAULT NULL COMMENT 'Admin''s Email',
  `Admin_Password` varchar(50) DEFAULT NULL COMMENT 'Admin''s Password'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_ID`, `Admin_Name`, `Admin_Email`, `Admin_Password`) VALUES
(4, 'Icarus', 'icaruswong1@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `option`
--

CREATE TABLE `option` (
  `Option_ID` int(11) NOT NULL,
  `Question_ID` int(11) NOT NULL,
  `Option_Text` text NOT NULL,
  `Is_Correct` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `option`
--

INSERT INTO `option` (`Option_ID`, `Question_ID`, `Option_Text`, `Is_Correct`) VALUES
(5, 4, 'a', 1),
(6, 4, 'b', 0),
(7, 4, 'c', 0),
(8, 4, 'd', 0),
(9, 5, 'a2', 0),
(10, 5, 'b2', 1),
(11, 5, 'c2', 0),
(12, 5, 'd2', 0),
(13, 6, 'a', 1),
(14, 6, 'b', 0),
(15, 6, 'c', 0),
(16, 6, 'd', 0),
(17, 7, 'q', 0),
(18, 7, 'w', 1),
(19, 7, 'r', 0),
(20, 7, 't', 0);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `Question_ID` int(11) NOT NULL,
  `Quiz_ID` int(11) NOT NULL,
  `Question_Text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`Question_ID`, `Quiz_ID`, `Question_Text`) VALUES
(4, 9, '1. A'),
(5, 9, '2. B'),
(6, 10, '1'),
(7, 10, '2');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `Quiz_ID` int(11) NOT NULL,
  `Quiz_Title` varchar(255) NOT NULL,
  `Admin_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`Quiz_ID`, `Quiz_Title`, `Admin_ID`) VALUES
(9, 'C Basics', 4),
(10, 'A', 4),
(14, 'f', 4);

-- --------------------------------------------------------

--
-- Table structure for table `response`
--

CREATE TABLE `response` (
  `Response_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Quiz_ID` int(11) NOT NULL,
  `Question_ID` int(11) NOT NULL,
  `Option_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `response`
--

INSERT INTO `response` (`Response_ID`, `User_ID`, `Quiz_ID`, `Question_ID`, `Option_ID`) VALUES
(14, 9, 9, 4, 5),
(15, 9, 9, 5, 10);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_ID` int(11) NOT NULL COMMENT 'User''s ID',
  `User_Name` varchar(100) DEFAULT NULL COMMENT 'User''s Name',
  `User_Email` varchar(50) DEFAULT NULL COMMENT 'User''s Email',
  `User_Password` varchar(50) DEFAULT NULL COMMENT 'User''s Password'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_ID`, `User_Name`, `User_Email`, `User_Password`) VALUES
(9, 'Icarus', 'icaruswong1@gmail.com', '123'),
(10, 'Imran', 'imran@gmail.com', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `option`
--
ALTER TABLE `option`
  ADD PRIMARY KEY (`Option_ID`),
  ADD KEY `Question_ID` (`Question_ID`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`Question_ID`),
  ADD KEY `Quiz_ID` (`Quiz_ID`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`Quiz_ID`),
  ADD KEY `Admin_ID` (`Admin_ID`);

--
-- Indexes for table `response`
--
ALTER TABLE `response`
  ADD PRIMARY KEY (`Response_ID`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `Quiz_ID` (`Quiz_ID`),
  ADD KEY `Question_ID` (`Question_ID`),
  ADD KEY `Option_ID` (`Option_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Admin''s ID', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `option`
--
ALTER TABLE `option`
  MODIFY `Option_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `Question_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `Quiz_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `response`
--
ALTER TABLE `response`
  MODIFY `Response_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'User''s ID', AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `option`
--
ALTER TABLE `option`
  ADD CONSTRAINT `option_ibfk_1` FOREIGN KEY (`Question_ID`) REFERENCES `question` (`Question_ID`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`Quiz_ID`) REFERENCES `quiz` (`Quiz_ID`);

--
-- Constraints for table `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `quiz_ibfk_1` FOREIGN KEY (`Admin_ID`) REFERENCES `admin` (`Admin_ID`);

--
-- Constraints for table `response`
--
ALTER TABLE `response`
  ADD CONSTRAINT `response_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`),
  ADD CONSTRAINT `response_ibfk_2` FOREIGN KEY (`Quiz_ID`) REFERENCES `quiz` (`Quiz_ID`),
  ADD CONSTRAINT `response_ibfk_3` FOREIGN KEY (`Question_ID`) REFERENCES `question` (`Question_ID`),
  ADD CONSTRAINT `response_ibfk_4` FOREIGN KEY (`Option_ID`) REFERENCES `option` (`Option_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

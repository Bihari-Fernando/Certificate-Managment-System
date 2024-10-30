-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2024 at 06:20 PM
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
-- Database: `certificate`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(25) NOT NULL,
  `department` varchar(100) NOT NULL,
  `employeeID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`username`, `password`, `type`, `department`, `employeeID`) VALUES
('admin', 'admin123', 'Admin', '', '12341'),
('Authenticator', 'authenticator123', 'Authenticator', '', '12349'),
('CIS', 'cis123', 'CIS Chapter Admin', '', '13333'),
('CS', 'cs123', 'CS chapter Admin', '', '12222'),
('examAdmin', 'examAdmin123', 'Exam Admin', '', '12340'),
('Internship', 'internship123', 'Internship Admin', '', '12347'),
('topGraded', 'topGraded123', 'Top Graded', '', '12345'),
('WIE', 'wie123', 'WIE Chapter Admin', '', '14444');

-- --------------------------------------------------------

--
-- Table structure for table `cis`
--

CREATE TABLE `cis` (
  `fullName` varchar(100) NOT NULL,
  `regNo` varchar(100) NOT NULL,
  `membership` enum('Yes','No','','') NOT NULL,
  `membershipNo` int(255) NOT NULL,
  `sessionName` varchar(200) NOT NULL,
  `sessionDate` date NOT NULL,
  `effectiveDate` date NOT NULL,
  `status` varchar(100) NOT NULL,
  `certificateID` int(11) NOT NULL,
  `problems` varchar(255) DEFAULT NULL,
  `responses` varchar(255) DEFAULT NULL,
  `problem_status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cis`
--

INSERT INTO `cis` (`fullName`, `regNo`, `membership`, `membershipNo`, `sessionName`, `sessionDate`, `effectiveDate`, `status`, `certificateID`, `problems`, `responses`, `problem_status`) VALUES
('bihari fernando', '2021csc006', 'Yes', 122334444, 'machine learning', '2024-10-15', '0000-00-00', 'V', 1, NULL, NULL, NULL),
('bihari fernando', '2021csc006', 'Yes', 1223344, 'machine learning', '2024-10-07', '0000-00-00', 'V', 4, NULL, NULL, NULL),
('LIGLIG', '2021CSC006', '', 0, 'jhkjhj', '0000-00-00', '0000-00-00', 'V', 6, NULL, NULL, NULL),
('Imasha Hashini', '2021CSC000', 'Yes', 2345675, 'Machine Learning', '2024-10-01', '2024-10-24', '', 7, 'hello', NULL, NULL),
('', '', 'Yes', 0, '', '0000-00-00', '0000-00-00', '', 8, 'hello world', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `regNo` varchar(30) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`regNo`, `fullName`, `description`) VALUES
('<br /><b>Warning</b>:  Undefin', 'bihari', 'qwertyuiop'),
('2021CSC006', 'bihari fernando', 'hi');

-- --------------------------------------------------------

--
-- Table structure for table `complaintss`
--

CREATE TABLE `complaintss` (
  `regNo` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaintss`
--

INSERT INTO `complaintss` (`regNo`, `name`, `contact`, `description`) VALUES
('2021csc006', 'bihari', '0701282299', 'odscgvsidhcskhcbdb');

-- --------------------------------------------------------

--
-- Table structure for table `cs`
--

CREATE TABLE `cs` (
  `fullName` varchar(100) NOT NULL,
  `regNo` varchar(100) NOT NULL,
  `membership` enum('Yes','No','','') NOT NULL,
  `membershipNo` int(255) NOT NULL,
  `sessionName` varchar(200) NOT NULL,
  `sessionDate` date NOT NULL,
  `effectiveDate` date NOT NULL,
  `status` varchar(100) NOT NULL,
  `certificateID` int(11) NOT NULL,
  `problems` varchar(255) DEFAULT NULL,
  `problem_status` varchar(10) DEFAULT NULL,
  `responses` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cs`
--

INSERT INTO `cs` (`fullName`, `regNo`, `membership`, `membershipNo`, `sessionName`, `sessionDate`, `effectiveDate`, `status`, `certificateID`, `problems`, `problem_status`, `responses`) VALUES
('bihari fernando', '2021csc006', 'Yes', 1223344, 'machine learning', '2024-10-21', '0000-00-00', '', 1, NULL, 'V', 'hello'),
('Imasha Hashini', '2021CSC000', 'No', 0, 'Artificial Intelligence for beginners', '2024-10-10', '2024-10-16', 'V', 2, NULL, NULL, NULL),
('', '', 'Yes', 0, '', '0000-00-00', '0000-00-00', '', 3, 'hello world', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `internship`
--

CREATE TABLE `internship` (
  `fullName` varchar(100) NOT NULL,
  `regNo` varchar(100) NOT NULL,
  `companyName` varchar(100) NOT NULL,
  `duration` varchar(10) NOT NULL,
  `certificateID` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  `problems` varchar(255) DEFAULT NULL,
  `responses` varchar(255) DEFAULT NULL,
  `problem_status` varchar(100) DEFAULT NULL,
  `effectiveDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `internship`
--

INSERT INTO `internship` (`fullName`, `regNo`, `companyName`, `duration`, `certificateID`, `status`, `problems`, `responses`, `problem_status`, `effectiveDate`) VALUES
('bihari fernando', '2021CSC006', 'vertusa', '6 months', '', 'V', 'hello', 'hello back', 'V', NULL),
('Imasha Hashini', '2021CSC000', 'Vertusa', '6 months', '', 'V', 'The details on my internship certificate, such as my name, internship dates, or position, are incorrect.', 'Dear Imasha,\r\n\r\nThank you for informing us about the incorrect details on your internship certificate. We are currently reviewing the information and will issue a corrected certificate shortly. \r\n\r\nThank you for your patience.\r\n\r\nBest regards,  \r\nAdmin', 'V', '2024-10-15'),
('ABCD', '2021CSC001', 'skhdci', '6 months', '', 'V', 'hiiii', NULL, NULL, NULL),
('lasnjasjcajlaks', '2021csc007', 'ljhouh', '6 months', '', '', NULL, NULL, NULL, NULL),
('lasnjasjcajlaks', '2021csc007', 'ljhouh', '6 months', '', '', NULL, NULL, NULL, NULL),
('', '', '', '', '', '', 'hello world', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`) VALUES
('2021csc006', 'bi123');

-- --------------------------------------------------------

--
-- Table structure for table `problems`
--

CREATE TABLE `problems` (
  `regNo` varchar(100) NOT NULL,
  `fullName` varchar(200) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `response` varchar(255) NOT NULL,
  `id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `problems`
--

INSERT INTO `problems` (`regNo`, `fullName`, `contact`, `description`, `response`, `id`) VALUES
('2021CSC006', 'bihari fernando', '0786543456', 'hi', '', 1),
('', '', '', 'hello world', '', 2),
('', '', '', 'hello world', '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `regNo` varchar(50) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `faculty` varchar(100) NOT NULL,
  `studyProgram` varchar(150) NOT NULL,
  `indexNo` varchar(15) NOT NULL,
  `nic` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contactNo` int(20) NOT NULL,
  `email` varchar(60) NOT NULL,
  `academicYear` varchar(20) NOT NULL,
  `studyType` varchar(60) NOT NULL,
  `ogpa` varchar(10) NOT NULL,
  `degreeClass` varchar(50) NOT NULL,
  `effectiveDate` varchar(15) NOT NULL,
  `status` varchar(15) NOT NULL,
  `fileName` varchar(150) NOT NULL,
  `certificateID` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`regNo`, `fullName`, `faculty`, `studyProgram`, `indexNo`, `nic`, `address`, `contactNo`, `email`, `academicYear`, `studyType`, `ogpa`, `degreeClass`, `effectiveDate`, `status`, `fileName`, `certificateID`) VALUES
('2021csc006', 'bihari fernando', 'anslihcbsodidc', 'hihvpugivgou', 'S114762', '200023456799', 'jsbxaobsxpihasx', 786543234, 'bihari@gamil.com', '20/21', '1 year', '2.22', 'first', '2024/08/12', 'V', ' ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `fullName` varchar(100) NOT NULL,
  `regNo` varchar(100) NOT NULL,
  `nic` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contactNo` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `batchNo` varchar(255) NOT NULL,
  `currentLevel` varchar(10) NOT NULL,
  `gender` enum('Male','Female','','') NOT NULL,
  `admissionDate` date NOT NULL,
  `indexNo` varchar(100) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT 'uploads/default.png',
  `faculty` varchar(100) DEFAULT NULL,
  `studyProgram` varchar(150) NOT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`fullName`, `regNo`, `nic`, `email`, `contactNo`, `address`, `batchNo`, `currentLevel`, `gender`, `admissionDate`, `indexNo`, `profile_picture`, `faculty`, `studyProgram`, `password`) VALUES
('Imasha Hashini', '2021CSC000', '200087654532', 'imasha@gmail.com', '0786543234', 'Ramanathan Road,Thirunelvely,Jaffna', '16CSC', '2S', 'Female', '2021-10-20', 'S12345', 'uploads/default.png', 'Science', 'DirectIntake', '123');

-- --------------------------------------------------------

--
-- Table structure for table `topstudents`
--

CREATE TABLE `topstudents` (
  `regNo` varchar(10) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `gpa` varchar(10) NOT NULL,
  `academicYear` varchar(20) NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  `indexNo` varchar(100) DEFAULT NULL,
  `certificateID` int(11) NOT NULL,
  `problems` varchar(255) DEFAULT NULL,
  `responses` varchar(100) DEFAULT NULL,
  `problem_status` varchar(10) DEFAULT NULL,
  `effectiveDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `topstudents`
--

INSERT INTO `topstudents` (`regNo`, `fullName`, `gpa`, `academicYear`, `status`, `indexNo`, `certificateID`, `problems`, `responses`, `problem_status`, `effectiveDate`) VALUES
('2021csc006', 'sal/jdbcca', '2.01', '2', 'V', NULL, 1, NULL, NULL, NULL, NULL),
('2021CSC000', 'Imasha Hashini', '3.78', '2', NULL, 'S12334', 5, 'The formatting of my certificate is misaligned, or the font size is inconsistent.', NULL, NULL, '2024-10-16'),
('2021csc007', 'lasnjasjcajlaks', '3.33', '1', NULL, '9723r234', 6, NULL, NULL, NULL, NULL),
('2021csc007', 'lasnjasjcajlaks', '3.33', '1', NULL, '9723r234', 7, NULL, NULL, NULL, NULL),
('2021csc007', 'lasnjasjcajlaks', '3.33', '1', NULL, '9723r234', 8, NULL, NULL, NULL, NULL),
('2021csc007', 'lasnjasjcajlaks', '3.33', '1', NULL, '9723r234', 9, NULL, NULL, NULL, NULL),
('2021csc007', 'lasnjasjcajlaks', '3.33', '1', NULL, '9723r234', 10, NULL, NULL, NULL, NULL),
('2021csc007', 'lasnjasjcajlaks', '3.33', '1', NULL, '9723r234', 11, NULL, NULL, NULL, NULL),
('2021csc007', 'lasnjasjcajlaks', '3.33', '1', NULL, '9723r234', 12, NULL, NULL, NULL, NULL),
('2021csc007', 'lasnjasjcajlaks', '3.33', '1', NULL, '9723r234', 13, NULL, NULL, NULL, NULL),
('2021csc007', 'lasnjasjcajlaks', '3.33', '1', NULL, '9723r234', 14, NULL, NULL, NULL, NULL),
('', '', '', '', NULL, NULL, 15, 'hello world', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wie`
--

CREATE TABLE `wie` (
  `fullName` varchar(100) NOT NULL,
  `regNo` varchar(100) NOT NULL,
  `membership` enum('Yes','No','','') NOT NULL,
  `membershipNo` int(255) NOT NULL,
  `sessionName` varchar(200) NOT NULL,
  `sessionDate` date NOT NULL,
  `effectiveDate` date NOT NULL,
  `status` varchar(100) NOT NULL,
  `certificateID` int(11) NOT NULL,
  `problems` varchar(255) DEFAULT NULL,
  `problem_status` varchar(10) DEFAULT NULL,
  `responses` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wie`
--

INSERT INTO `wie` (`fullName`, `regNo`, `membership`, `membershipNo`, `sessionName`, `sessionDate`, `effectiveDate`, `status`, `certificateID`, `problems`, `problem_status`, `responses`) VALUES
('bihari fernando', '2021csc006', 'Yes', 1223344, 'machine learning', '2024-10-22', '0000-00-00', 'V', 1, NULL, 'V', 'hiii'),
('', '', 'Yes', 0, '', '0000-00-00', '0000-00-00', '', 2, 'hello world', NULL, NULL),
('Imasha', '2021CSC006', 'Yes', 8595696, 'JGCKUT', '2024-10-08', '2024-10-13', '', 3, 'problem', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `cis`
--
ALTER TABLE `cis`
  ADD PRIMARY KEY (`certificateID`);

--
-- Indexes for table `cs`
--
ALTER TABLE `cs`
  ADD PRIMARY KEY (`certificateID`);

--
-- Indexes for table `problems`
--
ALTER TABLE `problems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`regNo`);

--
-- Indexes for table `topstudents`
--
ALTER TABLE `topstudents`
  ADD PRIMARY KEY (`certificateID`);

--
-- Indexes for table `wie`
--
ALTER TABLE `wie`
  ADD PRIMARY KEY (`certificateID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cis`
--
ALTER TABLE `cis`
  MODIFY `certificateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cs`
--
ALTER TABLE `cs`
  MODIFY `certificateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `problems`
--
ALTER TABLE `problems`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `topstudents`
--
ALTER TABLE `topstudents`
  MODIFY `certificateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `wie`
--
ALTER TABLE `wie`
  MODIFY `certificateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2024 at 01:25 PM
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
-- Database: `mict`
--

-- --------------------------------------------------------

--
-- Table structure for table `academicrecord`
--

CREATE TABLE `academicrecord` (
  `academicRecordID` int(11) NOT NULL,
  `id_number` varchar(13) NOT NULL,
  `graduationYear` int(4) NOT NULL,
  `institution` varchar(255) NOT NULL,
  `studyField` varchar(255) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `specifyInstitution` varchar(255) NOT NULL,
  `specifyQualification` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academicrecord`
--

INSERT INTO `academicrecord` (`academicRecordID`, `id_number`, `graduationYear`, `institution`, `studyField`, `qualification`, `specifyInstitution`, `specifyQualification`) VALUES
(35, '0', 2000, 'University of Johannesburg', 'LOGISTS', 'Doctorate', '', ''),
(36, '0', 2020, 'University of Fort Hare', 'Logists', 'Diploma', '', ''),
(37, '0', 2005, 'Cape Peninsula University of Technology', 'Software', 'Honours', '', ''),
(38, '0', 2008, 'North-West University', 'KK', 'Bachelors', '', ''),
(39, '2147483647', 2000, 'Cape Peninsula University of Technology', 'Law', 'Diploma', '', ''),
(40, '0111135542087', 2000, 'Cape Peninsula University of Technology', 'Law', 'Diploma', '', ''),
(41, '0111135542087', 2000, 'Cape Peninsula University of Technology', 'Law', 'Diploma', '', ''),
(42, '0111135542087', 2000, 'Cape Peninsula University of Technology', 'Law', 'Diploma', '', ''),
(43, '0111135542087', 2000, 'Cape Peninsula University of Technology', 'Law', 'Diploma', '', ''),
(44, '0111135542087', 2000, 'Cape Peninsula University of Technology', 'Law', 'Diploma', '', ''),
(45, '0111135542087', 2000, 'Cape Peninsula University of Technology', 'Law', 'Diploma', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `applicant`
--

CREATE TABLE `applicant` (
  `applicantID` int(11) NOT NULL,
  `id_number` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicant`
--

INSERT INTO `applicant` (`applicantID`, `id_number`, `email`, `password`, `reset_token`, `token_expiry`) VALUES
(25, '0111135542087', 'karabomollo84@gmail.com', '$2y$10$KyoI1Bm.zXboMJ.YMaCgu.HMex.dI16ByA26zGOP0SdPM0Vj31hYK', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `appliedjobs`
--

CREATE TABLE `appliedjobs` (
  `jobID` int(11) NOT NULL,
  `id_number` varchar(13) NOT NULL,
  `jobTitle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appliedjobs`
--

INSERT INTO `appliedjobs` (`jobID`, `id_number`, `jobTitle`) VALUES
(1, '0', 'Developer');

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `qualification_status` enum('qualified','underqualified') NOT NULL,
  `interview_scheduled` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currentemployment`
--

CREATE TABLE `currentemployment` (
  `currentEmploymentID` int(11) NOT NULL,
  `employer` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `salary` int(11) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `startDate` date NOT NULL,
  `contact` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employeer`
--

CREATE TABLE `employeer` (
  `employeerID` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employeer`
--

INSERT INTO `employeer` (`employeerID`, `email`, `password`, `position`) VALUES
(1, 'admin@mict.seta.ac.za', 'admin123', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `hr`
--

CREATE TABLE `hr` (
  `hr_ID` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hr`
--

INSERT INTO `hr` (`hr_ID`, `email`, `password`, `reset_token`, `token_expiry`) VALUES
(1, 'admin@mict.org.za', 'admin123', NULL, NULL),
(2, 'HR@mict.org.za', '$2y$10$4xAwg/27YUIi/77o7NP/zu9NFsJ7jCauOsDVSXbR5mL3nSku2KokS', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `interviews`
--

CREATE TABLE `interviews` (
  `id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `interview_date` date NOT NULL,
  `interview_time` time NOT NULL,
  `location` enum('online','in-office') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `languageID` int(11) NOT NULL,
  `id_number` varchar(20) NOT NULL,
  `language` varchar(255) NOT NULL,
  `speak` varchar(255) NOT NULL,
  `writing` varchar(255) NOT NULL,
  `reading` varchar(255) NOT NULL,
  `updateid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `postjob`
--

CREATE TABLE `postjob` (
  `postjobID` int(11) NOT NULL,
  `jobtype` varchar(255) NOT NULL,
  `division` varchar(255) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `vacancies` int(11) NOT NULL,
  `emptype` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `renumeration` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `requirement` varchar(255) NOT NULL,
  `system_skills` varchar(255) NOT NULL,
  `behavioural_competencies` varchar(255) NOT NULL,
  `functional_competencies` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `postjob`
--

INSERT INTO `postjob` (`postjobID`, `jobtype`, `division`, `reference`, `position`, `vacancies`, `emptype`, `location`, `startDate`, `endDate`, `renumeration`, `description`, `requirement`, `system_skills`, `behavioural_competencies`, `functional_competencies`) VALUES
(1, 'internal', 'IT', '764356789', 'ygggjkhg', 2, 'internal', 'head_office', '2023-11-12', '2024-11-12', 0, 'makes', 'Dip', 'Microsoft', 'vdjfukl', 'dyuijm'),
(2, 'internal', 'IT', '764356789', 'ygggjkhg', 2, 'internal', 'head_office', '2023-11-12', '2024-11-12', 0, 'makes', 'Dip', 'Microsoft', 'vdjfukl', 'dyuijm'),
(3, 'internal', 'IT', '764356789', 'ygggjkhg', 2, 'internal', 'head_office', '2023-11-12', '2024-11-12', 0, 'makes', 'Dip', 'Microsoft', 'vdjfukl', 'dyuijm'),
(4, 'internal', 'IT', '764356789', 'ygggjkhg', 2, 'internal', 'head_office', '2023-11-12', '2024-11-12', 0, 'makes', 'Dip', 'Microsoft', 'vdjfukl', 'dyuijm'),
(5, 'internal', 'IT', '653456789', 'mnbgfdf', 3, 'external', 'internal', '2023-10-11', '2024-12-11', 450000, 'Manager', 'Honours', 'Java', 'Problem-solving skills', 'Ambitous');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `profileID` int(11) NOT NULL,
  `id_number` varchar(13) NOT NULL,
  `title` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `initials` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `suburb` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postalCode` int(10) NOT NULL,
  `province` varchar(255) NOT NULL,
  `phoneNumber` int(15) NOT NULL,
  `alternativeNumber` int(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `citizenship` varchar(255) NOT NULL,
  `race` varchar(255) NOT NULL,
  `otherRace` varchar(255) NOT NULL,
  `maritalStatus` varchar(255) NOT NULL,
  `disability` varchar(255) NOT NULL,
  `disability_type` varchar(255) NOT NULL,
  `disability_other` varchar(255) NOT NULL,
  `terms` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reference`
--

CREATE TABLE `reference` (
  `referenceID` int(11) NOT NULL,
  `id_number` varchar(20) NOT NULL,
  `referenceName` varchar(255) NOT NULL,
  `relationship` varchar(255) NOT NULL,
  `years` int(4) NOT NULL,
  `phoneNumber` int(12) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `softskills`
--

CREATE TABLE `softskills` (
  `softSkillsID` int(11) NOT NULL,
  `id_number` varchar(20) NOT NULL,
  `skills` varchar(255) NOT NULL,
  `rating` varchar(255) NOT NULL,
  `otherSkills` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE `upload` (
  `id` int(11) NOT NULL,
  `id_number` int(13) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `upload`
--

INSERT INTO `upload` (`id`, `id_number`, `file_name`, `file_path`) VALUES
(56, 0, 'CV_ThabangLedwaba.pdf', 'Documents/CV_ThabangLedwaba.pdf'),
(57, 0, 'ID.pdf', 'Documents/ID.pdf'),
(58, 0, 'Fees.pdf', 'Documents/Fees.pdf'),
(59, 0, 'CV_ThabangLedwaba.pdf', 'Documents/CV_ThabangLedwaba.pdf'),
(60, 0, 'ID.pdf', 'Documents/ID.pdf'),
(61, 0, 'Fees.pdf', 'Documents/Fees.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `workexperience`
--

CREATE TABLE `workexperience` (
  `workExperienceID` int(11) NOT NULL,
  `id_number` varchar(20) NOT NULL,
  `company` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `industry` varchar(255) NOT NULL,
  `salary` int(11) NOT NULL,
  `reasonleaving` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `employmentStatus` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academicrecord`
--
ALTER TABLE `academicrecord`
  ADD PRIMARY KEY (`academicRecordID`);

--
-- Indexes for table `applicant`
--
ALTER TABLE `applicant`
  ADD PRIMARY KEY (`applicantID`);

--
-- Indexes for table `appliedjobs`
--
ALTER TABLE `appliedjobs`
  ADD PRIMARY KEY (`jobID`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currentemployment`
--
ALTER TABLE `currentemployment`
  ADD PRIMARY KEY (`currentEmploymentID`);

--
-- Indexes for table `employeer`
--
ALTER TABLE `employeer`
  ADD PRIMARY KEY (`employeerID`);

--
-- Indexes for table `hr`
--
ALTER TABLE `hr`
  ADD PRIMARY KEY (`hr_ID`);

--
-- Indexes for table `interviews`
--
ALTER TABLE `interviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `candidate_id` (`candidate_id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`languageID`);

--
-- Indexes for table `postjob`
--
ALTER TABLE `postjob`
  ADD PRIMARY KEY (`postjobID`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`profileID`);

--
-- Indexes for table `reference`
--
ALTER TABLE `reference`
  ADD PRIMARY KEY (`referenceID`);

--
-- Indexes for table `softskills`
--
ALTER TABLE `softskills`
  ADD PRIMARY KEY (`softSkillsID`);

--
-- Indexes for table `upload`
--
ALTER TABLE `upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workexperience`
--
ALTER TABLE `workexperience`
  ADD PRIMARY KEY (`workExperienceID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academicrecord`
--
ALTER TABLE `academicrecord`
  MODIFY `academicRecordID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `applicant`
--
ALTER TABLE `applicant`
  MODIFY `applicantID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `appliedjobs`
--
ALTER TABLE `appliedjobs`
  MODIFY `jobID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currentemployment`
--
ALTER TABLE `currentemployment`
  MODIFY `currentEmploymentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employeer`
--
ALTER TABLE `employeer`
  MODIFY `employeerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hr`
--
ALTER TABLE `hr`
  MODIFY `hr_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `interviews`
--
ALTER TABLE `interviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `languageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `postjob`
--
ALTER TABLE `postjob`
  MODIFY `postjobID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `profileID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `reference`
--
ALTER TABLE `reference`
  MODIFY `referenceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `softskills`
--
ALTER TABLE `softskills`
  MODIFY `softSkillsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `upload`
--
ALTER TABLE `upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `workexperience`
--
ALTER TABLE `workexperience`
  MODIFY `workExperienceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `interviews`
--
ALTER TABLE `interviews`
  ADD CONSTRAINT `interviews_ibfk_1` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

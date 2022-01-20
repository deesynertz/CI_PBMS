-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2021 at 09:06 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pbms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_activities`
--

CREATE TABLE `tb_activities` (
  `ID` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `status` enum('complete','cancelled','on hold') NOT NULL DEFAULT 'on hold',
  `amount` decimal(12,2) NOT NULL,
  `projectID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_activities`
--

INSERT INTO `tb_activities` (`ID`, `content`, `status`, `amount`, `projectID`) VALUES
(1, 'Kupalilia', 'complete', '3000.00', 4),
(2, 'Kupanda', 'on hold', '4000.00', 4),
(3, 'Kuvuna', 'on hold', '3000.00', 4),
(4, 'Kununua Mbegu', 'complete', '10000.00', 1),
(5, 'Kujenga', 'complete', '2000.00', 5),
(6, 'kupaua', 'complete', '5000.00', 5),
(7, 'Kuezeka', 'on hold', '3000.00', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_details`
--

CREATE TABLE `tb_details` (
  `ID` int(11) NOT NULL,
  `education` varchar(255) DEFAULT NULL,
  `skill` varchar(255) DEFAULT NULL,
  `location` varchar(900) DEFAULT NULL,
  `experience` varchar(900) DEFAULT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_details`
--

INSERT INTO `tb_details` (`ID`, `education`, `skill`, `location`, `experience`, `userID`) VALUES
(4, 'LCT', 'DB ADMIN', 'mzumbe', 'working with TCRA for 5year									', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_expenditure`
--

CREATE TABLE `tb_expenditure` (
  `ID` int(11) NOT NULL,
  `activityID` int(11) NOT NULL,
  `spentAmount` decimal(12,2) NOT NULL,
  `forWhat` varchar(255) DEFAULT '',
  `info` text NOT NULL,
  `spentOn` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_expenditure`
--

INSERT INTO `tb_expenditure` (`ID`, `activityID`, `spentAmount`, `forWhat`, `info`, `spentOn`) VALUES
(1, 1, '1000.00', 'material', 'buying internet bandle', '2021-05-13'),
(2, 1, '1000.00', 'material', 'Material', '2021-06-30'),
(3, 2, '600.00', 'material', 'dfzdgdfgd', '2021-06-30'),
(4, 2, '900.00', 'material', 'dsvdhgvdh sudfdgf uvaeuife \r\nhghcgdhcaedfie iuefeuiyfeuyu\r\naefaeufueadfu ayuefyuaeyfueyudyf aeufyaeuyfueyuy', '2021-06-30'),
(5, 2, '1000.00', 'salary', 'any', '2021-07-01'),
(6, 2, '500.00', 'material', 'hghghg ffyg yygyg', '2021-07-25'),
(7, 4, '1000.00', 'material', 'sdjkdhs sdgsduigfud', '2021-07-21'),
(8, 4, '7576.00', 'salary', 'hjgjhghg tytyty', '2021-07-29'),
(9, 5, '500.00', 'material', 'uiyuiyuy uyuuy', '2021-07-29'),
(11, 4, '700.00', 'material', 'zdjhguksdh gusryguiysu', '2021-07-31'),
(12, 1, '200.00', 'material', 'adfuh sdyfguysd sdufgiysd gsiduygfisd ', '2021-08-02'),
(13, 3, '1000.00', 'salary', 'zfu adufyaef aeuyfae ufyaefu ', '2021-08-02'),
(14, 3, '1000.00', 'salary', 'eruy aiuefyue ', '2021-08-02'),
(15, 7, '1000.00', 'material', 'jjhjkhjh', '2021-08-02');

-- --------------------------------------------------------

--
-- Table structure for table `tb_project`
--

CREATE TABLE `tb_project` (
  `ID` int(11) NOT NULL,
  `projectName` varchar(255) NOT NULL,
  `owner` int(11) NOT NULL,
  `leader` varchar(255) NOT NULL,
  `contact` varchar(14) NOT NULL,
  `duration` int(11) NOT NULL,
  `budget` decimal(12,2) NOT NULL,
  `description` varchar(900) DEFAULT NULL,
  `compName` varchar(900) DEFAULT NULL,
  `projectStatus` enum('1','2','3','4') NOT NULL DEFAULT '1',
  `budget_purpose` text NOT NULL,
  `createdOn` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_project`
--

INSERT INTO `tb_project` (`ID`, `projectName`, `owner`, `leader`, `contact`, `duration`, `budget`, `description`, `compName`, `projectStatus`, `budget_purpose`, `createdOn`) VALUES
(1, 'MBOGA MBOGA', 2, 'Alison Deogratias', '0744004897', 100, '20000.00', 'now a testing if the ad porject module is working in this systsm so that i can continue with another module																																																																																																																																																			', 'HJK', '4', 'a:2:{i:0;s:8:\"material\";i:1;s:6:\"salary\";}', '2021-06-13'),
(2, 'JIRANI SITE APP', 3, 'uuyuyuyu', '9789986869868', 366, '89797878.00', 'YYTY  TRTRty trt tyrtrtrty ytrytr																																																																													', 'ytgyutyu yutytut', '2', 'a:2:{i:0;s:8:\"material\";i:1;s:4:\"risk\";}', '2021-05-13'),
(3, 'yutyuty', 3, 'ygyytyyyty', '0980989899', 67, '67677677.00', 'guytyutyutytyy																																																																													', 'ytytytytty', '2', 'a:2:{i:0;s:6:\"salary\";i:1;s:6:\"others\";}', '2021-06-30'),
(4, 'uitgliuguigu', 2, 'gygygyg', '0987654321', 100, '10000.00', 'vjhfthfyu6tytyuty yuyuiyui														', 'uyuytu', '2', 'a:4:{i:0;s:8:\"material\";i:1;s:4:\"risk\";i:2;s:6:\"salary\";i:3;s:6:\"others\";}', '2021-06-27'),
(5, 'test activity', 2, 'dfuydfyd dyfud', '0987654321', 20, '10000.00', ' kfg sisuise usius iutseiufise																																														', 'adfuhdu uysfuyd', '2', 'a:2:{i:0;s:8:\"material\";i:1;s:6:\"salary\";}', '2021-07-29'),
(6, 'shgivsfh gsryuigyu', 2, 'shegfyue sfgye', '165431234', 27, '1000.00', 'jksfhguihsru															', 'sgfusrygus', '1', 'a:2:{i:0;s:4:\"risk\";i:1;s:6:\"salary\";}', '2021-07-31'),
(7, 'sdiugys gsryu', 2, 'diuhgs uyhgui ysdu', '1234567897', 10, '10000.00', 'xfvhxfiu xfuibvyxf bxfy bxfubyufx byfuzy																			', 'useafgy seugyuser', '1', 'a:1:{i:0;s:6:\"salary\";}', '2021-08-02');

-- --------------------------------------------------------

--
-- Table structure for table `tb_project_files`
--

CREATE TABLE `tb_project_files` (
  `ID` int(11) NOT NULL,
  `projectID` int(11) NOT NULL,
  `path` varchar(900) NOT NULL,
  `docType` varchar(12) NOT NULL,
  `uploadedDate` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_project_files`
--

INSERT INTO `tb_project_files` (`ID`, `projectID`, `path`, `docType`, `uploadedDate`) VALUES
(1, 2, 'Cryptography.pdf', '.pdf', '2021-07-25'),
(2, 2, 'Block_Cipher.pdf', '.pdf', '2021-07-25');

-- --------------------------------------------------------

--
-- Table structure for table `tb_role`
--

CREATE TABLE `tb_role` (
  `ID` int(11) NOT NULL,
  `roleName` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_role`
--

INSERT INTO `tb_role` (`ID`, `roleName`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `ID` int(11) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(900) NOT NULL,
  `userPic` varchar(900) DEFAULT NULL,
  `roleID` int(11) NOT NULL,
  `permission_status` enum('active','request','domant') NOT NULL DEFAULT 'request',
  `registeredOn` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`ID`, `fullName`, `email`, `password`, `userPic`, `roleID`, `permission_status`, `registeredOn`) VALUES
(1, 'Deesynertz', 'admin@g.c', '8cb2237d0679ca88db6464eac60da96345513964', 'default_avatar.jpg', 1, 'active', '2021-04-30'),
(2, 'Annah Kweka', 'annah@g.c', '8cb2237d0679ca88db6464eac60da96345513964', 'default_avatar.jpg', 2, 'active', '2021-05-13'),
(3, 'Alison Deogratias', 'deo@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'default_avatar.jpg', 2, 'domant', '2021-07-24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_activities`
--
ALTER TABLE `tb_activities`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `tb_activities_ibfk_1` (`projectID`);

--
-- Indexes for table `tb_details`
--
ALTER TABLE `tb_details`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `tb_expenditure`
--
ALTER TABLE `tb_expenditure`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `projectID` (`activityID`);

--
-- Indexes for table `tb_project`
--
ALTER TABLE `tb_project`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `owner` (`owner`);

--
-- Indexes for table `tb_project_files`
--
ALTER TABLE `tb_project_files`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `projectID` (`projectID`);

--
-- Indexes for table `tb_role`
--
ALTER TABLE `tb_role`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `roleID` (`roleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_activities`
--
ALTER TABLE `tb_activities`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_details`
--
ALTER TABLE `tb_details`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_expenditure`
--
ALTER TABLE `tb_expenditure`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_project`
--
ALTER TABLE `tb_project`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_project_files`
--
ALTER TABLE `tb_project_files`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_role`
--
ALTER TABLE `tb_role`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_activities`
--
ALTER TABLE `tb_activities`
  ADD CONSTRAINT `tb_activities_ibfk_1` FOREIGN KEY (`projectID`) REFERENCES `tb_project` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_details`
--
ALTER TABLE `tb_details`
  ADD CONSTRAINT `tb_details_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `tb_user` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_expenditure`
--
ALTER TABLE `tb_expenditure`
  ADD CONSTRAINT `tb_expenditure_ibfk_1` FOREIGN KEY (`activityID`) REFERENCES `tb_activities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_project`
--
ALTER TABLE `tb_project`
  ADD CONSTRAINT `tb_project_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `tb_user` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_project_files`
--
ALTER TABLE `tb_project_files`
  ADD CONSTRAINT `tb_project_files_ibfk_1` FOREIGN KEY (`projectID`) REFERENCES `tb_project` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`roleID`) REFERENCES `tb_role` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

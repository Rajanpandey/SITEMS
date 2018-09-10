-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2018 at 04:52 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sitems`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `eventId` tinyint(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `department` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `incharge` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `eventDescribe` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `achievements` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `attendees` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `eventFor` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `resourceName` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `resourceDesignation` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `media` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `userId` tinyint(11) NOT NULL,
  `url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `approvalStatus` tinyint(4) DEFAULT NULL,
  `declineReply` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `viewedNotification` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventId`, `name`, `department`, `incharge`, `date`, `type`, `eventDescribe`, `achievements`, `attendees`, `eventFor`, `resourceName`, `resourceDesignation`, `category`, `media`, `userId`, `url`, `approvalStatus`, `declineReply`, `viewedNotification`) VALUES
(34, 'SkyHack', 'CSIT', 'SkyHackSkyHack', '2018-09-06', 'Curricular Activity', 'SkyHackSkyHack', 'SkyHackSkyHack', 'Staff', 'B.Tech', '', '', 'Seminar', '2018/CSIT/September - Seminar/SkyHack/Screenshot (69).png,2018/CSIT/September - Seminar/SkyHack/Screenshot (70).png,2018/CSIT/September - Seminar/SkyHack/Screenshot (71).png', 1, 'skyhack', -1, 'Delete the reverb thing and cmake adsaf . Then do this . adfanma ke , add this this racher., meet me soon', 1),
(35, 'Hackathon', 'EnTc', 'HackathonHackathon', '2018-09-05', 'Co-Curricular Activity', 'Hackathon', 'Hackathon', 'Faculty', 'B.Tech,M.Tech', '', '', 'Annual College Gathering Fest', '2018/EnTc/September - AnnualCollegeGatheringFest/Hackathon/Screenshot (69).png', 1, 'hackathon', -1, 'asd', 1),
(36, 'Football Match', 'Techfest', 'Footbal MatchFootbal Match', '2018-09-07', 'Curricular Activity', 'Footbal MatchFootbal Match', 'Footbal MatchFootbal Match', 'Staff', 'B.Tech', '', '', 'Faculty Development Programme', '2018/Techfest/September - FacultyDevelopmentProgramme/Footbal Match/', 1, 'footbal-match', -1, 'You\'re fired', NULL),
(40, '2', 'Mech', '2', '2018-09-04', 'Curricular Activity', '2', '2', 'Faculty', 'B.Tech', '', '', 'Faculty Development Programme', '2018/Mech/September - FacultyDevelopmentProgramme/2/Screenshot (71).png', 1, '2', -1, '3', NULL),
(42, '4', 'Mech', '4', '2018-09-08', 'Curricular Activity', '4', '4', 'Staff', 'B.Tech', '', '', 'Alumni Activity', '2018/Mech/September - AlumniActivity/4/Screenshot (69).png', 1, '4', -1, '6', NULL),
(43, '5', 'Civil', '5', '0005-05-05', 'Co-Curricular Activity', '5', '5', 'Staff', 'B.Tech', '', '', 'Industrial Visit', '1970/Civil/January - IndustrialVisit/5/Screenshot (70).png', 1, '5', -1, NULL, NULL),
(44, '6', 'Mech', '6', '0006-06-06', 'Curricular Activity', '6', '6', 'Faculty', 'M.Tech', '', '', 'Workshop-Student Training', '1970/Mech/January - Workshop-StudentTraining/6/Screenshot (71).png', 1, '6', -1, NULL, NULL),
(45, '45', 'EnTc', '45', '0001-01-01', 'Curricular Activity', '45', '45', 'Staff', 'B.Tech', '', '', 'Spons Activity Event', '1970/EnTc/January - SponsActivityEvent/45/Screenshot (69).png', 1, '45', -1, NULL, NULL),
(46, '46', 'EPIC', '46', '0001-01-01', 'Curricular Activity', '46', '46', 'Staff', 'B.Tech', '', '', 'Spons Activity Event', '1970/EPIC/January - SponsActivityEvent/46/Screenshot (69).png', 1, '46', -1, NULL, NULL),
(47, '47', 'EPIC', '47', '0001-01-01', 'Co-Curricular Activity', '47', '47', 'Staff', 'B.Tech', '', '', 'Faculty Development Programme', '1970/EPIC/January - FacultyDevelopmentProgramme/47/Screenshot (71).png', 1, '47', 1, NULL, 1),
(48, '48', 'Civil', '48', '0001-01-01', 'Co-Curricular Activity', '48', '48', 'Staff', 'B.Tech', '', '', 'Seminar', '1970/Civil/January - Seminar/48/Screenshot (69).png', 1, '48', -1, NULL, 1),
(49, '49', 'Applied Science', '49', '0001-01-01', 'Curricular Activity', '49', '49', 'Staff', 'B.Tech', '', '', 'Faculty Development Programme', '1970/AppliedScience/January - FacultyDevelopmentProgramme/49/Screenshot (69).png', 1, '49', 1, NULL, 1),
(50, '50', 'Mech', '505050', '2018-09-03', 'Curricular Activity', '505050', '50505050505050505050505050', 'Staff,Faculty', 'M.Tech', '', '', 'Workshop-Student Training', '2018/Mech/September - Workshop-StudentTraining/50/Screenshot (71).png,2018', 1, '50-2', -1, '515151', NULL),
(51, '51', 'CSIT', '515151', '2016-01-01', 'Co-Curricular Activity', '51', '515151', 'Staff,Student', 'B.Tech', '', '', 'Industry-Institute Interaction Activity', '2016/CSIT/January - Industry-InstituteInteractionActivity/51/,1970/CSIT/January - Industry-InstituteInteractionActivity/51/Screenshot (70).png,1970/CSIT/January - Industry-InstituteInteractionActivity/51/Screenshot (69).png', 1, '51', NULL, NULL, 1),
(55, '10th', 'EnTc', '10th', '2018-09-10', 'Co-Curricular Activity', '10th10th', '10th10th', 'Staff', 'B.Tech,M.Tech', 'Rajan, Ashwin', 'Dev, Test', 'Annual College Gathering Fest', '2018/EnTc/September - AnnualCollegeGatheringFest/10th/Screenshot (69).png', 1, '10th', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `email`, `password`, `name`, `type`) VALUES
(1, 'rajan.pandey@sitpune.edu.in', 'rkp12345', 'Rajan Pandey', 'faculty'),
(2, 'ashwin.kolhatkar@sitpune.edu.in', 'ashwin12345', 'Ashwin Kolhatkar', 'informationOfficer'),
(3, 'bhumika.saini@sitpune.edu.in', 'bhumika12345', 'Bhumika Saini', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eventId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `eventId` tinyint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

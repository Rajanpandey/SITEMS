-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2018 at 10:49 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

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
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `department` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `incharge` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `year` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
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
  `viewedNotification` tinyint(4) DEFAULT NULL,
  `archive` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `draft` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventId`, `name`, `department`, `incharge`, `date`, `year`, `type`, `eventDescribe`, `achievements`, `attendees`, `eventFor`, `resourceName`, `resourceDesignation`, `category`, `media`, `userId`, `url`, `approvalStatus`, `declineReply`, `viewedNotification`, `archive`, `draft`, `time`) VALUES
(34, 'SkyHack', 'CSIT', 'SkyHackSkyHack', '2018-09-06', '0', 'Curricular Activity', 'SkyHackSkyHack', 'SkyHackSkyHack', 'Staff', 'B.Tech', '', '', 'Seminar', '2018/CSIT/September - Seminar/SkyHack/Screenshot (69).png,2018/CSIT/September - Seminar/SkyHack/Screenshot (70).png,2018/CSIT/September - Seminar/SkyHack/Screenshot (71).png', 1, 'skyhack', -1, 'Delete the reverb thing and cmake adsaf . Then do this . adfanma ke , add this this racher., meet me soon', 1, NULL, NULL, '2018-09-16 13:59:15'),
(35, 'Hackathon', 'EnTc', 'HackathonHackathon', '2018-09-05', '0', 'Co-Curricular Activity', 'Hackathon', 'Hackathon', 'Faculty', 'B.Tech,M.Tech', '', '', 'Annual College Gathering Fest', '2018/EnTc/September - AnnualCollegeGatheringFest/Hackathon/Screenshot (69).png', 1, 'hackathon', -1, 'asd', 1, NULL, NULL, '2018-09-16 13:59:15'),
(36, 'Football Match', 'Techfest', 'Footbal MatchFootbal Match', '2018-09-07', '0', 'Curricular Activity', 'Footbal MatchFootbal Match', 'Footbal MatchFootbal Match', 'Staff', 'B.Tech', '', '', 'Faculty Development Programme', '2018/Techfest/September - FacultyDevelopmentProgramme/Footbal Match/', 1, 'footbal-match', -1, 'You\'re fired', 1, NULL, NULL, '2018-09-16 13:59:15'),
(40, '2', 'Mech', '2', '2018-09-04', '0', 'Curricular Activity', '2', '2', 'Faculty', 'B.Tech', '', '', 'Faculty Development Programme', '2018/Mech/September - FacultyDevelopmentProgramme/2/Screenshot (71).png', 1, '2', -1, '3', 1, NULL, NULL, '2018-09-16 13:59:15'),
(42, '4', 'Mech', '4', '2018-09-08', '0', 'Curricular Activity', '4', '4', 'Staff', 'B.Tech', '', '', 'Alumni Activity', '2018/Mech/September - AlumniActivity/4/Screenshot (69).png', 1, '4', -1, '6', 1, NULL, NULL, '2018-09-16 13:59:15'),
(43, '5', 'Civil', '5', '0005-05-05', '0', 'Co-Curricular Activity', '5', '5', 'Staff', 'B.Tech', '', '', 'Industrial Visit', '1970/Civil/January - IndustrialVisit/5/Screenshot (70).png', 1, '5', -1, NULL, NULL, NULL, NULL, '2018-09-16 13:59:15'),
(44, '6', 'Mech', '6', '0006-06-06', '0', 'Curricular Activity', '6', '6', 'Faculty', 'M.Tech', '', '', 'Workshop-Student Training', '1970/Mech/January - Workshop-StudentTraining/6/Screenshot (71).png', 1, '6', -1, NULL, NULL, NULL, NULL, '2018-09-16 13:59:15'),
(45, '45', 'EnTc', '45', '0001-01-01', '0', 'Curricular Activity', '45', '45', 'Staff', 'B.Tech', '', '', 'Spons Activity Event', '1970/EnTc/January - SponsActivityEvent/45/Screenshot (69).png', 1, '45', -1, NULL, NULL, NULL, NULL, '2018-09-16 13:59:15'),
(46, '46', 'EPIC', '46', '0001-01-01', '0', 'Curricular Activity', '46', '46', 'Staff', 'B.Tech', '', '', 'Spons Activity Event', '1970/EPIC/January - SponsActivityEvent/46/Screenshot (69).png', 1, '46', -1, NULL, NULL, NULL, NULL, '2018-09-16 13:59:15'),
(48, '48', 'Civil', '48', '0001-01-01', '0', 'Co-Curricular Activity', '48', '48', 'Staff', 'B.Tech', '', '', 'Seminar', '1970/Civil/January - Seminar/48/Screenshot (69).png', 1, '48', -1, NULL, 1, NULL, NULL, '2018-09-16 13:59:15'),
(50, '50', 'Mech', '505050', '2018-09-03', '0', 'Curricular Activity', '505050', '50505050505050505050505050', 'Staff,Faculty', 'M.Tech', '', '', 'Workshop-Student Training', '2018/Mech/September - Workshop-StudentTraining/50/Screenshot (71).png,2018', 1, '50-2', -1, '515151', 1, NULL, NULL, '2018-09-16 13:59:15'),
(51, '51', 'CSIT', '515151', '2016-01-01', '0', 'Co-Curricular Activity', '51', '515151', 'Staff,Student', 'B.Tech', '', '', 'Industry-Institute Interaction Activity', '2016/CSIT/January - Industry-InstituteInteractionActivity/51/,1970/CSIT/January - Industry-InstituteInteractionActivity/51/Screenshot (70).png,1970/CSIT/January - Industry-InstituteInteractionActivity/51/Screenshot (69).png', 1, '51', -1, 'fdg fdg df gdfhfgh dfh df df hgdfhgdf fdg fdg df gdfhfgh dfh df df hgdfhgdf fdg fdg df gdfhfgh dfh df df hgdfhgdf fdg fdg df gdfhfgh dfh df df hgdfhgdf fdg fdg df gdfhfgh dfh df df hgdfhgdf fdg fdg df gdfhfgh dfh df df hgdfhgdf fdg fdg df gdfhfgh dfh df df hgdfhgdf fdg fdg df gdfhfgh dfh df df hgdfhgdf ', 1, NULL, NULL, '2018-09-16 13:59:15'),
(55, '10th', 'EnTc', '10th', '2018-09-10', '0', 'Co-Curricular Activity', '10th10th', '10th10th', 'Staff', 'B.Tech,M.Tech', 'Rajan, Ashwin', 'Dev, Test', 'Annual College Gathering Fest', '2018/EnTc/September - AnnualCollegeGatheringFest/10th/Screenshot (69).png', 1, '10th', -1, 'fdg fdg df gdfhfgh dfh df df hgdfhgdf fdg fdg df gdfhfgh dfh df df hgdfhgdf fdg fdg df gdfhfgh dfh df df hgdfhgdf fdg fdg df gdfhfgh dfh df df hgdfhgdf fdg fdg df gdfhfgh dfh df df hgdfhgdf fdg fdg df gdfhfgh dfh df df hgdfhgdf fdg fdg df gdfhfgh dfh df df hgdfhgdf fdg fdg df gdfhfgh dfh df df hgdfhgdf fdg fdg df gdfhfgh dfh df df hgdfhgdf fdg fdg df gdfhfgh dfh df df hgdfhgdf fdg fdg df gdfhfgh dfh df df hgdfhgdf fdg fdg df gdfhfgh dfh df df hgdfhgdf fdg fdg df gdfhfgh dfh df df hgdfhgdf ', 1, NULL, NULL, '2018-09-16 13:59:15'),
(56, '56', 'Mech', '56', '2018-09-13', '0', 'Co-Curricular Activity', '5656', '5656', 'Staff', 'B.Tech,M.Tech', '56sfsd', '56a', 'Annual College Gathering Fest', '2018/Mech/September - AnnualCollegeGatheringFest/56/Screenshot (69).png', 1, '56', -1, 'dd', 1, NULL, NULL, '2018-09-16 13:59:15'),
(57, '57', 'Mech', '57', '0001-01-01', '0', 'Co-Curricular Activity', '5757', '57', 'Staff', 'B.Tech', '57, 12', '57, 213', 'Faculty Development Programme', '1970/Mech/January - FacultyDevelopmentProgramme/57/Screenshot (70).png', 1, '57', -1, 'asd dasfas a fadsf fds fdsfs asd dasfas a fadsf fds fdsfs asd dasfas a fadsf fds fdsfs asd dasfas a fadsf fds fdsfs asd dasfas a fadsf fds fdsfs asd dasfas a fadsf fds fdsfs asd dasfas a fadsf fds fdsfs asd dasfas a fadsf fds fdsfs asd dasfas a fadsf fds fdsfs asd dasfas a fadsf fds fdsfs asd dasfas a fadsf fds fdsfs asd dasfas a fadsf fds fdsfs asd dasfas a fadsf fds fdsfs asd dasfas a fadsf fds fdsfs asd dasfas a fadsf fds fdsfs asd dasfas a fadsf fds fdsfs asd dasfas a fadsf fds fdsfs asd dasfas a fadsf fds fdsfs asd dasfas a fadsf fds fdsfs asd dasfas a fadsf fds fdsfs asd dasfas a fadsf fds fdsfs asd dasfas a fadsf fds fdsfs asd dasfas a fadsf fds fdsfs asd dasfas a fadsf fds fdsfs asd dasfas a fadsf fds fdsfs ', 1, NULL, NULL, '2018-09-16 13:59:15'),
(58, '58', 'Civil', '58', '0002-02-02', '0', 'Co-Curricular Activity', '58', '58', 'Staff', 'M.Tech', '58', '58', 'Workshop-Student Training', '1970/Civil/January - Workshop-StudentTraining/58/Screenshot (69).png', 1, '58', -1, 'a', 1, NULL, NULL, '2018-09-16 13:59:15'),
(59, '111111', 'Mech', '111111', '0001-01-01', '0', 'Co-Curricular Activity', '111111111111', '111111111111111111', '', 'B.Tech', '111111111111', '111111', 'Spons Activity Event', '1970/Mech/January - SponsActivityEvent/111111/Screenshot (70).png', 1, '111111', -1, '111111111111111111', 1, NULL, NULL, '2018-09-16 13:59:15'),
(60, 'test', 'Civil', '57', '0001-01-01', '0', 'Curricular Activity', 'test', 'testtest', 'Staff', 'B.Tech', 'testtest11,testtest13', 'test22,test3131', 'Annual College Gathering Fest', '1970/Civil/January - AnnualCollegeGatheringFest/test/Screenshot (69).png', 1, 'test', 1, NULL, 1, NULL, NULL, '2018-09-18 07:25:43'),
(61, 'iotest', 'iotest', 'iotest', '0002-03-12', '0', 'Curricular Activity', 'iotest', 'iotest', 'Staff,Student', 'B.Tech,M.Tech', 'iotest,iotest', 'iotest,iotest', '', '1970iotestJanuary/iotest/Screenshot (69).png', 2, 'iotest', 1, NULL, 1, NULL, NULL, '2018-09-18 07:26:11'),
(62, 'aat', 'CSIT', 'aa', '0002-01-01', '0', 'Co-Curricular Activity', 'a', 'a', 'Staff', 'B.Tech', 'a', 'a', 'Industry-Institute Interaction Activity', '1970/CSIT/January - Industry-InstituteInteractionActivity/aat/Screenshot (69).png', 1, 'aat', 1, NULL, 1, NULL, NULL, '2018-09-18 07:26:11'),
(63, '11', '11', '11', '0001-01-01', '0', 'Curricular Activity', '11', '11', 'Staff', 'B.Tech', '11', '11', '11', '1970/11/January - 11/11/Screenshot (69).png', 1, '11', -1, 'aa', 1, NULL, NULL, '2018-09-16 13:59:15'),
(64, '64', 'othersssss', '64', '0001-01-01', '0', 'Curricular Activity', '64', '64', 'Staff,Faculty', 'B.Tech', '64', '64', 'Conference', '1970/othersssss/January - Conference/64/Screenshot (69).png', 1, '64', -1, 'no', 1, NULL, NULL, '2018-09-16 13:59:15'),
(65, '65', 'dsa', '65', '0001-01-01', '0', 'Curricular Activity', '65', '65', 'Staff', 'B.Tech', '65', '65', 'asdas', '1970/dsa/January - asdas/65/,1970/aa/January - bb/65/Screenshot (69).png', 1, '65-2', -1, 'k', 1, NULL, NULL, '2018-09-16 13:59:15'),
(66, '66', '66', '66', '0001-01-01', '0', 'Curricular Activity', '66', '66', 'Staff,Faculty,Student', 'B.Tech,M.Tech', '66', '66', 'Conference', '1970/66/January - Conference/66/Screenshot (69).png', 1, '66', -1, '666666', 1, NULL, NULL, '2018-09-16 13:59:15'),
(67, 'Rajan Pandey', 'EnTc', 'aa', '0001-01-01', '1', 'Curricular Activity', '1', '1', 'Staff', 'M.Tech', '1', '1', 'Workshop-Student Training', '1970/EnTc/January - Workshop-StudentTraining/Rajan Pandey/Screenshot (69).png', 1, 'rajan-pandey', 1, NULL, 1, NULL, NULL, '2018-09-18 07:25:43'),
(69, 'tt', 'EnTc', 'tt', '0001-01-01', '0001', 'Co-Curricular Activity', 'tt', 'tt', 'Staff', 'B.Tech', 'tt', 'tt', 'Workshop-Student Training', '1970/EnTc/January - Workshop-StudentTraining/tt/600255.jpg,1970/EnTc/January - Workshop-StudentTraining/tt/Space Galaxy Red Stars Wallpapers.jpg,1970/EnTc/January - Workshop-StudentTraining/tt/Gayle_McDowell_CareerCup_Sample_Resume.doc,1970/EnTc/January - Workshop-StudentTraining/tt/CV - Anupama Vinod Pandey.doc', 1, 'tt', 1, NULL, 1, NULL, NULL, '2018-09-18 07:25:43'),
(70, 'Rajan Pandey', 'CSIT', '10th', '0001-01-01', '0001', 'Curricular Activity', '1', '1', 'Staff', 'B.Tech', '1', '1', 'Workshop-Student Training', '1970/CSIT/January - Workshop-StudentTraining/Rajan Pandey/Gayle_McDowell_CareerCup_Sample_Resume.doc', 1, 'rajan-pandey-2', 1, NULL, 1, NULL, NULL, '2018-09-18 07:25:43'),
(71, '11', 'EnTc', '1', '0001-01-01', '0001', 'Co-Curricular Activity', '1', '1', 'Staff', 'B.Tech', '1', '1', 'Guest Lecture', '1970/EnTc/January - GuestLecture/11/Gayle_McDowell_CareerCup_Sample_Resume.doc', 1, '11-3', 1, NULL, 1, NULL, NULL, '2018-09-18 07:25:43'),
(72, '1112313', 'Mech', '12321', '0011-01-01', '0011', 'Curricular Activity', '213', '213', 'Staff', 'B.Tech', '213', '213', 'Spons Activity Event', '1970/Mech/January - SponsActivityEvent/1112313/542508.jpg,1970/Mech/January - SponsActivityEvent/1112313/Space Galaxy Red Stars Wallpapers.jpg,1970/Mech/January - SponsActivityEvent/1112313/CV - Anupama Vinod Pandey.doc', 1, '1112313', 1, NULL, 1, NULL, NULL, '2018-09-16 13:59:15'),
(73, '213asd', 'EnTc', 'asd', '2123-01-01', '2123', 'Curricular Activity', 'dq', 'qdw', 'Staff', 'B.Tech', 'dq', 'qwde', 'Cultural Events', '1970/EnTc/January - CulturalEvents/213asd/Space Galaxy Red Stars Wallpapers.jpg,1970/EnTc/January - CulturalEvents/213asd/CV - Anupama Vinod Pandey.doc', 1, '213asd', 1, NULL, 1, NULL, NULL, '2018-09-16 13:59:15'),
(75, 'dasd', 'EnTc', 'fasf', '0001-01-01', '0001', 'Curricular Activity', 'sdfgsf', 'sgdfg', 'Staff', 'M.Tech', 'afa', 'afdasf', 'Faculty Development Programme', '1970/EnTc/January - FacultyDevelopmentProgramme/dasd/Space Galaxy Red Stars Wallpapers.jpg,1970/EnTc/January - FacultyDevelopmentProgramme/dasd/Gayle_McDowell_CareerCup_Sample_Resume.doc,1970/EnTc/January - FacultyDevelopmentProgramme/dasd/CV - Anupama Vinod Pandey.doc', 1, 'dasd', 1, NULL, 1, NULL, NULL, '2018-09-18 07:25:43'),
(76, 'adas', 'EnTc', 'sdfsd', '0001-01-01', '0001', 'Co-Curricular Activity', 'wefwef', 'ewfwe', 'Staff', 'B.Tech', 'fwe', 'fwef', 'Cultural Events', '1970/EnTc/January - CulturalEvents/adas/709074.jpg', 1, 'adas', 1, NULL, 1, NULL, NULL, '2018-09-18 07:25:43'),
(77, 'aweq', 'CSIT', '1', '0001-01-01', '0001', 'Curricular Activity', 'fsd', 'sdfsd', 'Staff', 'B.Tech', 'sdfsd', 'fsdfsd', 'Entrepreneurship Initiatives', '1970/CSIT/January - EntrepreneurshipInitiatives/aweq/Space Galaxy Red Stars Wallpapers.jpg,1970/CSIT/January - EntrepreneurshipInitiatives/aweq/Gayle_McDowell_CareerCup_Sample_Resume.doc,1970/CSIT/January - EntrepreneurshipInitiatives/aweq/CV - Anupama Vinod Pandey.doc', 1, 'aweq', 1, NULL, 1, NULL, NULL, '2018-09-18 07:25:43'),
(78, 'rqwe', 'EnTc', 'qdfq', '0001-01-01', '0001', 'Curricular Activity', 'dasf', 'sdf', 'Staff', 'B.Tech', 'asfd', '57', 'Annual College Technical Fest', '1970/EnTc/January - AnnualCollegeTechnicalFest/rqwe/Space Galaxy Red Stars Wallpapers.jpg', 1, 'rqwe', 1, NULL, 1, NULL, NULL, '2018-09-18 07:25:43'),
(79, 'saf', 'EnTc', 'sdfsd', '0001-01-01', '0001', 'Curricular Activity', 'dfgfd', 'gdfg', 'Staff', 'B.Tech', 'fsdg', 'gdfg', 'Annual College Gathering Fest', '1970/EnTc/January - AnnualCollegeGatheringFest/saf/587508.png', 1, 'saf', 1, NULL, 1, NULL, NULL, '2018-09-18 07:25:43'),
(80, 'fsdfsd', 'EnTc', 'sdfds', '0001-01-01', '0001', 'Curricular Activity', 'sdgsd', 'gsdg', 'Staff', 'B.Tech', 'dsfs', 'gsdg', 'Seminar', '1970/EnTc/January - Seminar/fsdfsd/8K Ghosts.jpg', 1, 'fsdfsd', 1, NULL, 1, NULL, NULL, '2018-09-18 07:25:43'),
(81, 'fsdfsd', 'Civil', 'sdfsd', '0001-01-01', '0001', 'Curricular Activity', 'sdf', 'sdfs', 'Staff', 'B.Tech', 'sdf', 'sdf', 'Industrial Visit', '1970/Civil/January - IndustrialVisit/fsdfsd/Cracking the Coding Interview, 6th Edition.pdf', 1, 'fsdfsd-2', 1, NULL, 1, NULL, NULL, '2018-09-18 07:25:43'),
(82, 'ttt', 'EnTc', 'ttt', '0001-01-01', '0001', 'Co-Curricular Activity', 'tttttt', 'tttttt', '', 'B.Tech', 'ttt,ttt', 'ttt,ttt', 'Cultural Events', '1970/EnTc/January - CulturalEvents/ttt/Space Galaxy Red Stars Wallpapers.jpg,1970/EnTc/January - CulturalEvents/ttt/Gayle_McDowell_CareerCup_Sample_Resume.doc', 1, 'ttt', -1, 'bad post', 1, NULL, NULL, '2018-09-18 06:31:19'),
(83, '1', 'EnTc', '1', '0001-01-01', '0001', 'Curricular Activity', 'dfg', 'fdg', 'Staff', 'B.Tech', 'dfg', 'dfg', 'Workshop-Student Training', '1970/EnTc/January - Workshop-StudentTraining/1/dark-galaxy-wallpaper-night-32237.jpg', 1, '1', -1, 'dfgdf', 1, NULL, NULL, '2018-09-18 06:31:19'),
(89, 'hrth', 'Reverb', 'trhrth', '0001-01-01', '0001', 'Curricular Activity', 'sdfds', 'sdfds', 'Faculty', 'B.Tech', 'sdf', 'sdfs', 'Faculty Development Programme', '1970/Reverb/January - FacultyDevelopmentProgramme/hrth/,1970/Reverb/January - FacultyDevelopmentProgramme/hrth/1 (1).docx', 1, 'hrth-2', NULL, NULL, NULL, NULL, NULL, '2018-09-18 09:16:37'),
(91, 'Workshop on Android', 'CSIT', 'Ms. Smita Mahajan', '2018-08-12', '2018', 'Curricular Activity', 'Empowering students with android skills', '5 apps made by each attendee', 'Student', 'B.Tech', 'Bhumika Saini,Manas Ojha,Arpan Srivastava', 'Tutor,Tutor,Tutor', 'Workshop-Student Training', '2018/CSIT/August - Workshop-StudentTraining/Workshop on Android/New-3D-Android-Wallpaper-Full-HD.png', 1, 'workshop-on-android', NULL, NULL, NULL, NULL, NULL, '2018-09-18 06:35:11'),
(92, 'Food Fight', 'Reverb', 'Ismail Akhbani', '2018-06-07', '2018', 'Co-Curricular Activity', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor \r\n', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Netus et malesuada fames ac turpis egestas sed. Amet justo donec enim diam vulputate ut pharetra sit. Augue neque gravida in fermentum et sollicitudin. Eget dolor morbi non arcu. Morbi tincidunt augue interdum velit euismod in pellentesque. Odio morbi quis commodo odio aenean sed adipiscing diam. In est ante in nibh mauris cursus mattis molestie a. Enim praesent elementum f', 'Student', 'B.Tech', 'Rajan,Ashwin', 'Student,Student', 'Annual College Gathering Fest', '2018/Reverb/June - AnnualCollegeGatheringFest/Food Fight/architecture-autumn-avenue-773471.jpg', 1, 'food-fight', NULL, NULL, NULL, NULL, '1', '2018-09-18 07:12:26'),
(93, 'Introduction to ML', 'CSIT', 'Mrs. Madhura', '2018-08-20', '2018', 'Curricular Activity', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Student', 'B.Tech', 'Anirudhha Panth', 'Co-founder AlgoAnalytics', 'Guest Lecture', '2018/CSIT/August - GuestLecture/Introduction to ML/,2018/CSIT/August - GuestLecture/Introduction to Machine Learning/New-3D-Android-Wallpaper-Full-HD.png', 1, 'introduction-to-ml', NULL, NULL, NULL, NULL, NULL, '2018-09-18 07:12:31'),
(94, 'StartUp Con 2018', 'EPIC', 'Ismail Akbani', '2018-09-04', '2018', 'Co-Curricular Activity', 'Startup Con was amazing this year. Alumni came and presented their innovative ideas.\r\nLorem ipsum dolor sit amet, nihil nominavi id vix, ne cetero eripuit splendide per. Id inermis alienum duo, eos harum consequat an. Id vero solet praesent pri, pro cu alterum ullamcorper, regione nostrum cu vis. Id ius noster dissentiunt, facer possit scripta pro te, pro id pa', 'Cetero eripuit splendide per. Id inermis alienum duo, eos harum consequat an. Id vero solet praesent pri, pro cu alterum ullamcorper, regione nostrum cu vis. Id ius noster dissentiunt, facer possit scripta pro te, pro id pa', 'Student', 'B.Tech', 'Ismail Akbani', 'X Head', 'Entrepreneurship Initiatives', '2018/EPIC/September - EntrepreneurshipInitiatives/StartUp Con 2018/Sample_Submission_Zxs5Ys1.csv', 1, 'startup-con-2018', NULL, NULL, NULL, NULL, NULL, '2018-09-18 06:40:49'),
(95, 'AIT Hackathon', 'Applied Science', 'Rajan Pandey', '2018-09-11', '2018', 'Curricular Activity', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Netus et malesuada fames ac turpis egestas sed. Amet justo donec enim diam vulputate ut pharetra sit. Augue neque gravida in fermentum et sollicitudin. Eget dolor morbi non arcu. Morbi tincidunt augue interdum velit euismod in pellentesque. Odio morbi quis commodo odio aenean sed adipiscing diam. In est ante in nibh mauris cursus mattis molestie a. Enim praesent elementum f', 'Faculty,Student', 'B.Tech', 'Rajan', 'Srudent', 'Cultural Events', '2018/AppliedScience/September - CulturalEvents/AIT Hackathon/architecture-autumn-avenue-773471.jpg', 1, 'ait-hackathon', NULL, NULL, NULL, NULL, '1', '2018-09-18 07:12:35'),
(96, 'Protathlitis 2017', 'SIT Sports Club', 'John Doe', '2017-10-10', '2017', 'Co-Curricular Activity', 'Protathlitis 2017 was a huge success, where all students, staff and faculty of SIT played a wide range of sports and learnt value of Team work.', '1. Volleyball Tournament winners: TYCS\r\n2. Football Tournament Winners: TYCS', 'Staff,Faculty,Student', 'B.Tech,M.Tech', 'Kshitiz Kalra', 'Event Organizer', '', '2017/SITSportsClub/October - /Protathlitis 2017/Sample_Submission_Zxs5Ys1.csv', 1, 'protathlitis-2017', NULL, NULL, NULL, NULL, NULL, '2018-09-18 06:47:04'),
(97, 'TCS DISQ', 'CSIT', 'Mrs. Nilisha', '2018-08-02', '2018', 'Co-Curricular Activity', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Student', 'B.Tech', 'Lorem', 'Ipsum', 'Guest Lecture', '2018/CSIT/August - GuestLecture/TCS DISQ/eischmann-IMGP7448bfed.png', 1, 'tcs-disq', NULL, NULL, NULL, NULL, NULL, '2018-09-18 07:12:47'),
(98, 'BYJU\'s for Higher Edu', 'CSIT', 'Mrs. Shruti', '2018-08-01', '2018', 'Co-Curricular Activity', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Student', 'B.Tech,M.Tech', 'Yanny Laurel', 'Confusion', 'Industry-Institute Interaction Activity', '2018/CSIT/August - Industry-InstituteInteractionActivity/BYJU\'s for Higher Edu/eischmann-IMGP7448bfed.png', 1, 'byju-s-for-higher-edu', NULL, NULL, NULL, NULL, NULL, '2018-09-18 07:12:50'),
(99, 'Seminar on Modern Concrete Technologies', 'Civil', 'Meena Laad', '2016-02-03', '2016', 'Curricular Activity', 'Mr. Anurag Panse, gave a fantastic talk on the modern methods and techniques of Concrete Manufacturing Process.', '-', 'Faculty,Student', 'M.Tech', 'Sagar Kolekar', 'Seminar Coordinator', 'Guest Lecture', '2016/Civil/February - GuestLecture/Seminar on Modern Concrete Technologies/Sample_Submission_Zxs5Ys1.csv', 1, 'seminar-on-modern-concrete-technologies', NULL, NULL, NULL, NULL, NULL, '2018-09-18 06:50:49'),
(100, 'Mr and Miss SIT', 'EPIC', 'Bhumika Saini', '2018-09-07', '2018', 'Co-Curricular Activity', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Varius duis at consectetur lorem donec massa sapien faucibus.', 'Student', 'B.Tech', 'Bhumika,Shreya', 'Model,Model', 'Cultural Events', '2018/EPIC/September - CulturalEvents/Mr and Miss SIT/architecture-autumn-avenue-773471.jpg,2018/EPIC/September - CulturalEvents/Mr and Miss SIT/download (1).xls', 1, 'mr-and-miss-sit', 1, NULL, NULL, NULL, NULL, '2018-09-18 09:43:43'),
(101, 'Poetry Slam 2009', 'Reverb', 'Fiona D\'souza', '2018-09-06', '2018', 'Co-Curricular Activity', 'We got to hear the magic of words through poetry.', '1. Best Poem: Rajan Pandey', 'Faculty,Student', 'B.Tech', 'Gokul Nadar', 'Event Organizer', 'Cultural Events', '2018/Reverb/September - CulturalEvents/Poetry Slam 2009/gender_submission.csv', 1, 'poetry-slam-2009', -1, 'Please add more information about the poetry. Please upload pictures.', 1, NULL, NULL, '2018-09-18 09:05:33'),
(102, 'Mariachi Bands', 'Reverb', 'Lorem Ipsum', '2017-05-04', '2017', 'Co-Curricular Activity', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Student', 'B.Tech,M.Tech', 'Lorem Ipsum Ipsum', 'Lorem Lorem', 'Cultural Events', '2017/Reverb/May - CulturalEvents/Mariachi Bands/New-3D-Android-Wallpaper-Full-HD.png', 1, 'mariachi-bands', NULL, NULL, NULL, NULL, NULL, '2018-09-18 07:13:00'),
(103, 'Visit to Tech Mahindra', 'Reverb', 'Chinmay Kodagnaur', '2018-09-17', '2018', 'Co-Curricular Activity', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Varius duis at consectetur lorem donec massa sapien faucibus.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Varius duis at consectetur lorem donec massa sapien faucibus.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Va', 'Student', 'B.Tech', 'Rajan', 'Staff', 'Industrial Visit', '2018/Reverb/September - IndustrialVisit/Visit to Tech Mahindra/architecture-autumn-avenue-773471.jpg', 1, 'visit-to-tech-mahindra', 1, NULL, NULL, NULL, NULL, '2018-09-18 09:17:03'),
(104, 'Workshop on FORTRAN', 'Techfest', 'John Doe', '2010-09-20', '2010', 'Curricular Activity', 'Workshop on the amazing new technology, the revolutionary FORTRAN language. With state-of-the art punch cards.', '1. Best Program: Kiran Patil', 'Faculty,Student', 'M.Tech', 'Meghna Gulzar,Alia Bhatt', 'Technical Requirements specialist,Celebrity Presence', 'Workshop-Student Training', '2010/Techfest/September - Workshop-StudentTraining/Workshop on FORTRAN/gender_submission.csv', 1, 'workshop-on-fortran', NULL, NULL, NULL, NULL, NULL, '2018-09-18 06:59:24'),
(105, 'Startup Con 2016', 'EPIC', 'Ismail Sir', '2016-09-16', '2016', 'Co-Curricular Activity', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor h', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Varius duis at consectetur lorem donec massa sapien faucibus.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Varius duis at consectetur lorem donec massa sapien faucibus.', 'Faculty,Student', 'B.Tech', 'Ismail Sir', 'Sir', 'Entrepreneurship Initiatives', '2016/EPIC/September - EntrepreneurshipInitiatives/Startup Con 2016/,2016EPICSeptemberEntrepreneurshipInitiatives/StartupCon2016/architecture-autumn-avenue-773471.jpg', 2, 'startup-con-2016-2', NULL, NULL, NULL, NULL, NULL, '2018-09-18 07:28:05'),
(106, 'Tree Plantation Drive', 'CSR', 'Ohio Ohio gozaimasu!', '2017-09-14', '2017', 'Curricular Activity', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor g', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 'Faculty', 'B.Tech', 'Yanny Laurel', 'Yanny', 'Faculty Development Programme', '2017/CSR/September - FacultyDevelopmentProgramme/Tree Plantation Drive/,2017CSRSeptemberFacultyDevelopmentProgramme/LoremIpsum/eischmann-IMGP7448bfed.png,2017CSRSeptemberFacultyDevelopmentProgramme/LoremIpsum/New-3D-Android-Wallpaper-Full-HD.png', 2, 'tree-plantation-drive', NULL, NULL, NULL, NULL, NULL, '2018-09-18 07:27:30'),
(107, 'SIT Engineering Entrance Examinations', 'Admissions Department', 'Shruti Patil', '2018-07-10', '2018', 'Curricular Activity', 'SITEEE was organisation.', '-', 'Staff,Student', 'B.Tech', 'Shruti Patil', 'Coordinator, SITEEE', 'Entrance Examination', '2018/AdmissionsDepartment/July - EntranceExamination/SIT Engineering Entrance Examinations/train.csv', 1, 'sit-engineering-entrance-examinations', -1, 'dfdfaoi', NULL, NULL, NULL, '2018-09-18 09:27:14'),
(108, 'NAAC Committee Meeting', 'Applied Science', 'Lorem Ipsum', '2016-07-20', '2016', 'Curricular Activity', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor hhh', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 'Staff,Faculty', 'B.Tech,M.Tech', 'Yanny Laurel', 'Lorem Lorem', 'Conference', '2016/AppliedScience/July - Conference/NAAC Committee Meeting/,2016/AppliedScience/July - Conference/NAAC Committee Meeting/,2016/AppliedScience/July - Conference/NAAC Committee Meeting/,2016AppliedScienceJulyConference/NAACCommitteeMeeting/eischmann-IMGP7448bfed.png', 2, 'naac-committee-meeting-2', 1, NULL, 1, NULL, NULL, '2018-09-18 07:33:50'),
(109, 'PhD Dissertations 2018', 'CSIT', 'John Doe', '2018-09-13', '2018', 'Curricular Activity', 'PhD. Dissertations have been presented in Computer Networks Lab. 28 PhD. Candidates presented their dissertations. Attached files contain data of dissertations.', '1. Best Dissertation: Bhumika Saini\r\n2. Runner Up: Ashwin Kolhatkar', 'Faculty,Student', 'M.Tech', 'Rajan Pandey', 'Event Organizer', 'Conference', '2018/CSIT/September - Conference/PhD Dissertations 2018/gender_submission.csv', 1, 'phd-dissertations-2018', -1, 'dfdfaoi', 1, NULL, NULL, '2018-09-18 09:44:12'),
(110, 'CodeWars', 'CSIT', 'sdkjfhsd', '2018-09-18', '2018', 'Curricular Activity', 'dsfsdfsdfs', 'gdfgdf', 'Staff', 'B.Tech', 'Ashwin,Bhumika', 'sdfsdfd,dfgd', 'Annual College Gathering Fest', '2018/CSIT/September - AnnualCollegeGatheringFest/CodeWars/,2018/CSIT/September - AnnualCollegeGatheringFest/CodeWars/architecture-autumn-avenue-773471.jpg', 1, 'codewars-2', 1, NULL, NULL, NULL, NULL, '2018-09-18 09:00:57');

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
(2, 'kolhatkar.ashwin@sitpune.edu.in', 'ashwin12345', 'Ashwin Kolhatkar', 'informationOfficer'),
(3, 'bhumika.saini@sitpune.edu.in', 'bhu', 'Bhumika Saini', 'admin'),
(4, 'aaa.bbb@sitpune.edu.in', 'abcabc', 'Aaa Baa', 'faculty'),
(5, 'temp.user@sitpune.edu.in', 'tempuser', 'Temp User', 'faculty');

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
  MODIFY `eventId` tinyint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

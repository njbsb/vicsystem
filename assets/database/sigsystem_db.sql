-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2020 at 09:53 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sigsystem_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `academicplan`
--

CREATE TABLE `academicplan` (
  `student_matric` varchar(8) NOT NULL,
  `acadsession_id` int(11) NOT NULL,
  `gpa_target` decimal(3,2) DEFAULT NULL,
  `gpa_achieved` decimal(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `academicplan`
--

INSERT INTO `academicplan` (`student_matric`, `acadsession_id`, `gpa_target`, `gpa_achieved`) VALUES
('A160000', 1, '3.67', '3.75'),
('A160000', 2, '3.85', '0.00'),
('A160000', 4, '3.90', NULL),
('A160001', 4, '3.56', NULL),
('A160005', 4, NULL, NULL),
('A160004', 4, NULL, NULL),
('A160002', 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `academicsession`
--

CREATE TABLE `academicsession` (
  `id` int(11) NOT NULL,
  `acadyear_id` int(11) NOT NULL,
  `semester_id` int(11) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `academicsession`
--

INSERT INTO `academicsession` (`id`, `acadyear_id`, `semester_id`, `slug`, `status`) VALUES
(1, 1, 1, '20162017-1', 'inactive'),
(2, 1, 2, '20162017-2', 'inactive'),
(3, 1, 3, '20162017-3', 'inactive'),
(4, 2, 1, '20172018-1', 'active'),
(5, 2, 2, '20172018-2', 'inactive'),
(6, 3, 1, '20182019-1', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `academicyear`
--

CREATE TABLE `academicyear` (
  `id` int(2) NOT NULL,
  `acadyear` varchar(9) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `academicyear`
--

INSERT INTO `academicyear` (`id`, `acadyear`, `status`) VALUES
(1, '2016/2017', 'inactive'),
(2, '2017/2018', 'active'),
(3, '2018/2019', 'inactive'),
(4, '2019/2020', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `activity_name` varchar(255) NOT NULL,
  `activity_desc` text NOT NULL,
  `activitycategory_id` int(11) DEFAULT NULL,
  `acadsession_id` int(11) DEFAULT NULL,
  `sig_id` int(11) DEFAULT NULL,
  `advisor_matric` varchar(8) DEFAULT NULL,
  `datetime_start` datetime DEFAULT NULL,
  `datetime_end` datetime DEFAULT NULL,
  `venue` varchar(255) DEFAULT NULL,
  `theme` varchar(255) NOT NULL,
  `author_matric` varchar(8) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `paperwork_file` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `activity_name`, `activity_desc`, `activitycategory_id`, `acadsession_id`, `sig_id`, `advisor_matric`, `datetime_start`, `datetime_end`, `venue`, `theme`, `author_matric`, `slug`, `photo_path`, `paperwork_file`, `created_at`, `updated_at`) VALUES
(1, 'VIC Bonding 2016', '<p>Bonding session with the member of the club at Port Dickson, Negeri Sembilan</p>\r\n', 1, 1, 1, 'K003', '2020-08-01 08:26:28', '2020-08-01 16:26:28', NULL, '', NULL, 'VIC-Bonding-2016', '', '', '2020-09-02 07:06:21', '2020-09-04 08:47:39'),
(3, 'Meeting 1234', '<p>hehe</p>\r\n', 1, 1, 1, 'K003', '2020-09-02 22:45:00', '2020-09-10 22:45:00', 'MR 1', 'Meeting sampai esok', NULL, 'Meeting-1234', '', '', '2020-09-06 07:05:46', '2020-09-04 08:47:39'),
(4, 'Onboarding with HRM', '<p>Invite new intern</p>\r\n', 1, 1, 6, 'K001', '2020-09-10 00:01:00', '2020-09-19 00:01:00', NULL, '', NULL, 'Onboarding-with-HRM', '', '', '2020-09-06 07:05:46', '2020-09-04 08:47:39'),
(5, 'Meeting 4', '<p>meettttt bersama tunku taufiq</p>\r\n', 2, 4, 10, 'K003', '2020-09-04 00:17:00', '2020-09-05 00:17:00', NULL, '', NULL, 'Meeting-4', '', '', '2020-09-06 07:05:46', '2020-09-04 08:47:39'),
(6, 'Lawatan to Media Prima', '<p>This visit to media prima is to enhance our club member on how media production is conducted within the real world</p>\r\n', 2, 4, 1, 'K001', '2020-09-03 11:37:00', '2020-09-04 11:37:00', 'Media Prima', 'Biar orang buat kita, kita buat website', NULL, 'Lawatan-to-Media-Prima', '', '', '2020-09-06 07:05:46', '2020-09-04 08:47:39'),
(10, 'Dinner 2.0', '<p>Dinner 2.0</p>\r\n', 1, 1, 1, 'K001', '2020-10-02 16:05:00', '2020-10-03 16:05:00', 'BGR', 'takde', NULL, 'Dinner-20', '', '', '2020-10-02 08:03:25', '2020-10-02 08:03:25'),
(13, 'Act456', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n', 1, 4, 1, 'K001', '2020-10-09 11:08:00', '2020-10-09 11:08:00', 'pos', 'Maqon2', NULL, 'Act456', 'Act456-afd135523e.jpg', '', '2020-10-09 03:08:59', '2020-10-09 03:08:59'),
(14, 'Bengkel 1617 sem 2', '', 2, 2, 1, 'K001', '2020-11-05 18:53:07', '2020-11-06 18:53:07', NULL, '', NULL, '', NULL, '', '2020-11-05 10:54:07', '2020-11-05 10:54:07'),
(16, '12112020 Test', '<p>Testing</p>\r\n', 1, 4, 1, 'K001', '2020-11-01 00:00:00', '2020-11-03 00:00:00', 'Hall', 'Exam', NULL, '12112020-Test', '', '', '2020-11-12 14:47:23', '2020-11-12 14:47:23');

-- --------------------------------------------------------

--
-- Table structure for table `activity_budget`
--

CREATE TABLE `activity_budget` (
  `id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `sponsor_amount` int(11) NOT NULL,
  `expense_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `activity_category`
--

CREATE TABLE `activity_category` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity_category`
--

INSERT INTO `activity_category` (`id`, `category`, `code`) VALUES
(1, 'Activity', 'A'),
(2, 'Workshop', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `activity_committee`
--

CREATE TABLE `activity_committee` (
  `activity_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `student_matric` varchar(8) DEFAULT NULL,
  `role_desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity_committee`
--

INSERT INTO `activity_committee` (`activity_id`, `role_id`, `student_matric`, `role_desc`) VALUES
(1, 11, 'A160000', 'Makanan'),
(6, 9, NULL, ''),
(1, 5, 'A160001', ''),
(10, 5, 'A160003', ''),
(10, 6, 'A160002', ''),
(10, 9, 'A160001', ''),
(10, 7, 'A160000', ''),
(13, 5, 'A160004', ''),
(13, 6, 'A160003', ''),
(13, 9, 'A160003', ''),
(16, 5, 'A160000', ''),
(16, 6, 'A160001', ''),
(16, 7, 'A160002', ''),
(16, 9, 'A160003', ''),
(16, 8, 'A160004', '');

-- --------------------------------------------------------

--
-- Table structure for table `activity_type`
--

CREATE TABLE `activity_type` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity_type`
--

INSERT INTO `activity_type` (`id`, `type`, `category_id`) VALUES
(1, 'Digital Challenge', 1),
(2, 'Travelogue', 1),
(3, 'Social Activity', 1),
(4, 'School@UKM', 1),
(5, 'Workshop', 2);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` varchar(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`) VALUES
('admin', 'najibsuib');

-- --------------------------------------------------------

--
-- Table structure for table `citra`
--

CREATE TABLE `citra` (
  `code` varchar(8) NOT NULL,
  `name_bm` varchar(50) NOT NULL,
  `name_en` varchar(50) NOT NULL,
  `citra_level` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `citra`
--

INSERT INTO `citra` (`code`, `name_bm`, `name_en`, `citra_level`) VALUES
('LMCK1331', 'Komunikasi Efektif', 'Effective Communication', 'C2'),
('LMCK1421', 'Pemikiran Kritikal dan Penyelesaian Masalah', 'Critical Thinking and Problem Solving', 'C3'),
('LMCK1531', 'Kepimpinan dan Kreativiti', 'Leadership and Creativity', 'C4'),
('LMCK1621', 'Etika dan Profesional', 'Ethics and Professionalism', 'C1'),
('LMCK2711', 'Tanggungjawab Alam Sekitar', 'Environmental Responsibility', 'C5'),
('LMCK2811', 'Sosial dan Kebertanggungjawaban', 'Social and Responsibilities', 'C6');

-- --------------------------------------------------------

--
-- Table structure for table `citra_registration`
--

CREATE TABLE `citra_registration` (
  `student_matric` varchar(8) NOT NULL,
  `acadsession_id` int(11) NOT NULL,
  `citra_code` varchar(8) NOT NULL,
  `grade_id` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `citra_registration`
--

INSERT INTO `citra_registration` (`student_matric`, `acadsession_id`, `citra_code`, `grade_id`) VALUES
('A160000', 1, 'LMCK1331', NULL),
('A160000', 1, 'LMCK1421', NULL),
('A160001', 1, 'LMCK1531', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `collaborator`
--

CREATE TABLE `collaborator` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `background` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `collaborator`
--

INSERT INTO `collaborator` (`id`, `name`, `background`, `logo`) VALUES
(1, 'KRU', '444', NULL),
(2, 'KRU', '333', 'defaultlogo.png'),
(3, 'KRU2', '555', 'kru.png'),
(4, 'HUHEU', 'fdfd', 'HUHEU-6795997c0e.png');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `activity_id` int(11) NOT NULL,
  `student_matric` varchar(8) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `comment` varchar(255) NOT NULL,
  `commented_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`activity_id`, `student_matric`, `role_id`, `comment`, `commented_at`, `category_id`) VALUES
(1, 'A160000', 5, 'Best', '2020-09-03 05:39:46', 1),
(1, 'A160002', 9, 'HUHUHU', '2020-09-03 05:39:46', 1),
(6, 'A160002', 12, '<p>komenkomen</p>\r\n', '2020-09-03 06:37:03', 1),
(6, 'A160002', 12, 'try', '2020-09-03 09:24:29', 1),
(6, 'A160002', 12, 'try', '2020-09-03 09:24:32', 1),
(4, 'A160002', 12, 'test onboarding', '2020-09-03 09:31:45', 1),
(6, 'A160002', 12, 'pass', '2020-09-23 08:16:13', 1),
(6, 'A160002', 12, 'helo', '2020-09-23 08:21:15', 1),
(3, 'A160000', 12, 'No food dowan come', '2020-09-28 16:31:47', 1),
(6, 'A160000', NULL, 'Venue isnt good', '2020-10-01 22:31:23', 2);

-- --------------------------------------------------------

--
-- Table structure for table `comment_category`
--

CREATE TABLE `comment_category` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment_category`
--

INSERT INTO `comment_category` (`id`, `category`) VALUES
(1, 'General'),
(2, 'Venue');

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `id` int(2) NOT NULL,
  `grade` varchar(2) NOT NULL,
  `value` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`id`, `grade`, `value`) VALUES
(1, 'A', '4.00'),
(2, 'A-', '3.67'),
(3, 'B+', '3.33'),
(4, 'B', '3.00'),
(5, 'B-', '2.67'),
(6, 'C+', '2.33'),
(7, 'C', '2.00'),
(8, 'C-', '1.67'),
(9, 'D+', '1.33'),
(10, 'D', '1.00'),
(11, 'E', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE `lecturer` (
  `matric` varchar(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `room` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `levelscore`
--

CREATE TABLE `levelscore` (
  `id` int(11) NOT NULL,
  `level` varchar(50) NOT NULL,
  `percentage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `levelscore`
--

INSERT INTO `levelscore` (`id`, `level`, `percentage`) VALUES
(1, 'A1', 15),
(2, 'A2', 15),
(3, 'B1', 10);

-- --------------------------------------------------------

--
-- Table structure for table `mentor`
--

CREATE TABLE `mentor` (
  `matric` varchar(8) NOT NULL,
  `position` varchar(60) NOT NULL,
  `roomnum` varchar(50) NOT NULL,
  `orgrole_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mentor`
--

INSERT INTO `mentor` (`matric`, `position`, `roomnum`, `orgrole_id`) VALUES
('K001', 'Head of CAIT', 'E-12-13', 1),
('K002', 'Head of Masters Programme', 'E-1-2', 2),
('K003', 'Teaching Instructor', '', 1),
('K004', 'Dr Astronomy', 'Z-1-2', 1),
('K005', 'Head of Tail', 'B-1-1', 1),
('KL01', 'Head of AI Research', 'G-12-13', 2),
('L001', 'Dr of Mobile App', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `org_committee`
--

CREATE TABLE `org_committee` (
  `acadyear_id` int(2) DEFAULT NULL,
  `sig_id` int(2) DEFAULT NULL,
  `student_matric` varchar(8) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `role_desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `org_committee`
--

INSERT INTO `org_committee` (`acadyear_id`, `sig_id`, `student_matric`, `role_id`, `role_desc`) VALUES
(1, 1, 'A160000', 3, ''),
(1, 1, 'A160001', 4, ''),
(1, 1, 'A160002', 9, ''),
(1, 1, 'A160003', 7, ''),
(1, 1, 'A160002', 11, ''),
(2, 1, 'A160003', 11, 'Workshop'),
(2, 1, 'A160004', 7, '');

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `code` varchar(4) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`code`, `name`) VALUES
('CS', 'Computer Science'),
('IT', 'Information Technology'),
('SEIS', 'Software Engineering (Information)'),
('SEMM', 'Software Engineering (Multimedia)');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `rolename` varchar(50) NOT NULL,
  `keyword` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `rolename`, `keyword`) VALUES
(1, 'Club Manager', 'org'),
(2, 'Club Advisor', 'org'),
(3, 'President', 'org, highcom'),
(4, 'Deputy President', 'org, highcom'),
(5, 'Project Director', 'activity, highcom'),
(6, 'Deputy Project Director', 'activity, highcom'),
(7, 'Treasurer', 'org, activity, highcom'),
(8, 'Assistant Treasurer', 'org, activity'),
(9, 'Secretary', 'org, activity, highcom'),
(10, 'Assistant Secretary', 'org, activity'),
(11, 'Committee Member', 'org, activity'),
(12, 'Member', 'org, activity');

-- --------------------------------------------------------

--
-- Table structure for table `scattendance`
--

CREATE TABLE `scattendance` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scattendance`
--

INSERT INTO `scattendance` (`id`, `description`, `score`) VALUES
(1, 'Present', 5),
(2, 'Absent/MC', 1),
(3, 'Total Absent', 0);

-- --------------------------------------------------------

--
-- Table structure for table `scdigitalcv`
--

CREATE TABLE `scdigitalcv` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scdigitalcv`
--

INSERT INTO `scdigitalcv` (`id`, `description`, `score`) VALUES
(1, 'Very attractive design and very informative', 5),
(2, 'Attractive design and informative', 4),
(3, 'Moderate design and information', 3),
(4, 'No activity of current year', 2),
(5, 'No update since previous year', 1),
(6, 'No digital CV', 0);

-- --------------------------------------------------------

--
-- Table structure for table `scinvolvement`
--

CREATE TABLE `scinvolvement` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scinvolvement`
--

INSERT INTO `scinvolvement` (`id`, `description`, `score`) VALUES
(1, 'Fully Active', 7),
(2, 'Moderately Active', 5),
(3, 'Less Active', 3),
(4, 'Not Active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `scleadership`
--

CREATE TABLE `scleadership` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scleadership`
--

INSERT INTO `scleadership` (`id`, `description`, `score`) VALUES
(1, 'Very good', 5),
(2, 'Good', 4),
(3, 'Moderate', 3),
(4, 'Very little', 1),
(5, 'No leadership', 0);

-- --------------------------------------------------------

--
-- Table structure for table `scmeeting`
--

CREATE TABLE `scmeeting` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scmeeting`
--

INSERT INTO `scmeeting` (`id`, `description`, `score`) VALUES
(1, 'Full', 3),
(2, 'Partially full', 2),
(3, 'Seldom', 1);

-- --------------------------------------------------------

--
-- Table structure for table `scorecomp`
--

CREATE TABLE `scorecomp` (
  `acadsession_id` int(11) NOT NULL,
  `student_matric` varchar(8) NOT NULL,
  `marker_matric` varchar(8) DEFAULT NULL,
  `digitalcv` int(11) NOT NULL,
  `leadership` int(11) NOT NULL,
  `volunteer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scorecomp`
--

INSERT INTO `scorecomp` (`acadsession_id`, `student_matric`, `marker_matric`, `digitalcv`, `leadership`, `volunteer`) VALUES
(1, 'A160000', 'K001', 2, 4, 2),
(2, 'A160000', 'K002', 2, 5, 5),
(4, 'A160000', NULL, 4, 3, 2),
(4, 'A160001', NULL, 3, 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `scorelevel`
--

CREATE TABLE `scorelevel` (
  `student_matric` varchar(8) NOT NULL,
  `scoreplan_id` int(11) DEFAULT NULL,
  `marker_matric` varchar(8) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `meeting` int(11) DEFAULT NULL,
  `attendance` int(11) DEFAULT NULL,
  `involvement` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scorelevel`
--

INSERT INTO `scorelevel` (`student_matric`, `scoreplan_id`, `marker_matric`, `position`, `meeting`, `attendance`, `involvement`) VALUES
('A160000', NULL, 'K001', 2, 5, 0, 0),
('A160000', NULL, 'K001', 4, 0, 0, 0),
('A160000', NULL, 'K001', 3, 0, 2, 0),
('A160000', NULL, 'K001', 5, 3, 5, 7),
('A160000', NULL, 'K003', 5, 3, 4, 6),
('A160000', NULL, 'K005', 5, 2, 4, 5),
('A160000', NULL, NULL, 5, 3, 5, 7),
('A160000', NULL, NULL, 4, 2, 1, 7),
('A160000', NULL, NULL, 3, 3, 5, 5),
('A160000', 4, 'K001', 4, 3, 5, 7),
('A160000', 5, NULL, 5, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `scoringplan`
--

CREATE TABLE `scoringplan` (
  `id` int(11) NOT NULL,
  `sig_id` int(11) DEFAULT NULL,
  `acadsession_id` int(11) NOT NULL,
  `activitycategory_id` int(11) DEFAULT NULL,
  `activity_id` int(11) DEFAULT NULL,
  `label` varchar(10) NOT NULL,
  `percentweightage` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scoringplan`
--

INSERT INTO `scoringplan` (`id`, `sig_id`, `acadsession_id`, `activitycategory_id`, `activity_id`, `label`, `percentweightage`) VALUES
(1, 1, 1, 1, 10, 'A1', 10),
(2, 1, 1, 1, 3, 'A2', 10),
(3, 1, 1, 2, 5, 'B1', 12),
(4, 1, 4, 1, 13, 'A1', 10),
(5, 1, 4, 2, 10, 'B1', 15),
(12, 1, 4, 2, 6, 'B2', 11),
(13, 1, 2, 2, 14, 'B1', 15);

-- --------------------------------------------------------

--
-- Table structure for table `scposition`
--

CREATE TABLE `scposition` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scposition`
--

INSERT INTO `scposition` (`id`, `description`, `score`) VALUES
(1, 'Project Director', 5),
(2, 'Deputy Project Director', 4),
(3, 'Secretary', 3),
(4, 'Treasurer', 3),
(5, 'Others', 2);

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id` int(11) NOT NULL,
  `semester` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id`, `semester`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sig`
--

CREATE TABLE `sig` (
  `id` int(2) NOT NULL,
  `code` varchar(6) NOT NULL,
  `signame` varchar(100) NOT NULL,
  `logo_path` varchar(255) NOT NULL DEFAULT 'default_logo.png',
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sig`
--

INSERT INTO `sig` (`id`, `code`, `signame`, `logo_path`, `description`) VALUES
(1, 'VIC', 'Video Innovation Club', 'default_logo.png', ''),
(2, 'CE', 'Cyber Ethics', 'default_logo.png', ''),
(3, 'IC', 'Imagine Cup', 'default_logo.png', ''),
(4, 'IMC', 'Intelligence Machines Club', 'default_logo.png', ''),
(5, 'IMEC', 'Interactive Multimedia Club', 'default_logo.png', ''),
(6, 'PCC', 'Programming Challenge Club', 'default_logo.png', ''),
(7, 'LI', 'Lensa Informatics', 'default_logo.png', ''),
(8, 'MAD', 'Mobile Application Development Club', 'default_logo.png', ''),
(9, 'NUMOSS', 'National University of Malaysia Open Source Society', 'default_logo.png', ''),
(10, 'RC', 'Robotics Club', 'default_logo.png', ''),
(11, 'ARVIS', 'Autonomous Robot and Vision Systems Lab', 'default_logo.png', ''),
(12, 'IBC', 'i-BISNES Club', 'default_logo.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `matric` varchar(8) NOT NULL,
  `phonenum` varchar(12) NOT NULL,
  `program_code` varchar(4) DEFAULT NULL,
  `year_joined` year(4) NOT NULL DEFAULT current_timestamp(),
  `mentor_matric` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`matric`, `phonenum`, `program_code`, `year_joined`, `mentor_matric`) VALUES
('A123', '0011', 'SEIS', 2020, NULL),
('A160000', '0123456780', 'SEMM', 2020, 'K004'),
('A160001', '0123335555', 'SEIS', 2020, 'K003'),
('A160002', '011-2228888', 'SEMM', 2020, 'K003'),
('A160003', '013-1212333', 'IT', 2016, 'K001'),
('A160004', '014-4440000', 'CS', 2020, 'K002'),
('A160005', '0', 'IT', 2020, 'K003');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` varchar(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype_id` int(11) NOT NULL,
  `sig_id` int(11) DEFAULT NULL,
  `profile_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `userstatus_id` int(11) DEFAULT 1,
  `dob` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `usertype_id`, `sig_id`, `profile_image`, `created_at`, `userstatus_id`, `dob`) VALUES
('A160000', 'Khairul Anu AR', 'a160000@siswa.my', '5f4dcc3b5aa765d61d8327deb882cf99', 3, 1, 'A160000-891243ce24.jpg', '2020-09-04 08:14:26', 2, '2020-10-01'),
('A160001', 'Farhan', 'A160001@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 3, 1, '', '2020-09-26 10:42:51', 2, '1992-06-06'),
('A160002', 'Minmin', 'A160002@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 3, 1, 'A160002-ef06197502.jpg', '2020-09-26 11:03:24', 2, NULL),
('A160003', 'YinYin', 'A160003@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 3, 1, '', '2020-09-26 11:05:18', 2, '1999-12-02'),
('A160004', 'Luqman Podol', 'a160004@siswa.com', '5f4dcc3b5aa765d61d8327deb882cf99', 3, 1, '', '2020-10-05 05:11:59', 2, '1994-04-04'),
('A160005', 'A160005', 'A160005@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 3, 1, '', '2020-10-09 07:06:56', 3, '2020-10-09'),
('admin', 'Admin1', 'admin@gmail.com', 'admin123', 1, NULL, '', '2020-09-07 07:39:53', 2, NULL),
('K001', 'Dr Syahanim bte', 'syahanim@ukm.my', '5f4dcc3b5aa765d61d8327deb882cf99', 2, 1, 'K001-53a0eed357.jpg', '2020-09-26 11:06:40', 2, NULL),
('K002', 'Assoc Prof. Dr. Tengku Meriam', 'tsmeriam@ukm.edu.my', 'password', 2, 1, 'tengku.png', '2020-09-26 19:15:31', 2, NULL),
('K003', 'Masura bt Rahmat', 'masura@ukm.edu.my', 'password', 2, 1, 'masura.png', '2020-09-26 19:14:23', 2, NULL),
('K004', 'Dr AffenD', 'k004@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 2, 1, '', '2020-09-27 05:17:13', 2, '1996-05-05'),
('K005', 'K005', 'k005@ukm.my', '5f4dcc3b5aa765d61d8327deb882cf99', 2, 1, '', '2020-10-05 05:18:17', 2, '1985-05-05'),
('KL01', 'Robert`', 'robert@usm.com', '5f4dcc3b5aa765d61d8327deb882cf99', 2, 8, '', '2020-11-15 07:16:21', 2, '1997-01-15'),
('L001', 'Extra VIC Mentor', 'mrloo1@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 2, 1, '', '2020-09-26 20:38:24', 2, '1990-12-05');

-- --------------------------------------------------------

--
-- Table structure for table `userstatus`
--

CREATE TABLE `userstatus` (
  `id` int(11) NOT NULL,
  `userstatus` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userstatus`
--

INSERT INTO `userstatus` (`id`, `userstatus`) VALUES
(1, 'pending'),
(2, 'active'),
(3, 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `id` int(11) NOT NULL,
  `usertype` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`id`, `usertype`) VALUES
(1, 'admin'),
(2, 'mentor'),
(3, 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academicplan`
--
ALTER TABLE `academicplan`
  ADD KEY `tbl_academicplan_ibfk_1` (`student_matric`),
  ADD KEY `acadsession_id` (`acadsession_id`);

--
-- Indexes for table `academicsession`
--
ALTER TABLE `academicsession`
  ADD PRIMARY KEY (`id`),
  ADD KEY `acadyear_id` (`acadyear_id`),
  ADD KEY `academicsession_ibfk_2` (`semester_id`);

--
-- Indexes for table `academicyear`
--
ALTER TABLE `academicyear`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sig_id` (`sig_id`),
  ADD KEY `acadsession_id` (`acadsession_id`),
  ADD KEY `author_matric` (`author_matric`),
  ADD KEY `advisor_matric` (`advisor_matric`),
  ADD KEY `activitycategory_id` (`activitycategory_id`);

--
-- Indexes for table `activity_budget`
--
ALTER TABLE `activity_budget`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_category`
--
ALTER TABLE `activity_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_committee`
--
ALTER TABLE `activity_committee`
  ADD KEY `student_matric` (`student_matric`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `tbl_activity_committee_ibfk_1` (`activity_id`);

--
-- Indexes for table `activity_type`
--
ALTER TABLE `activity_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `citra`
--
ALTER TABLE `citra`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `citra_registration`
--
ALTER TABLE `citra_registration`
  ADD KEY `student_matric` (`student_matric`),
  ADD KEY `citra_code` (`citra_code`),
  ADD KEY `grade_id` (`grade_id`),
  ADD KEY `tbl_citra_registration_ibfk_7` (`acadsession_id`);

--
-- Indexes for table `collaborator`
--
ALTER TABLE `collaborator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD KEY `tbl_comment_ibfk_2` (`student_matric`),
  ADD KEY `tbl_comment_ibfk_4` (`category_id`),
  ADD KEY `tbl_comment_ibfk_3` (`role_id`),
  ADD KEY `tbl_comment_ibfk_1` (`activity_id`);

--
-- Indexes for table `comment_category`
--
ALTER TABLE `comment_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD PRIMARY KEY (`matric`);

--
-- Indexes for table `levelscore`
--
ALTER TABLE `levelscore`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mentor`
--
ALTER TABLE `mentor`
  ADD PRIMARY KEY (`matric`),
  ADD KEY `orgrole_id` (`orgrole_id`);

--
-- Indexes for table `org_committee`
--
ALTER TABLE `org_committee`
  ADD KEY `sig_id` (`sig_id`),
  ADD KEY `acadyear_id` (`acadyear_id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `tbl_org_committee_ibfk_2` (`student_matric`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scattendance`
--
ALTER TABLE `scattendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scdigitalcv`
--
ALTER TABLE `scdigitalcv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scinvolvement`
--
ALTER TABLE `scinvolvement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scleadership`
--
ALTER TABLE `scleadership`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scmeeting`
--
ALTER TABLE `scmeeting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scorecomp`
--
ALTER TABLE `scorecomp`
  ADD KEY `student_matric` (`student_matric`),
  ADD KEY `marker_matric` (`marker_matric`),
  ADD KEY `tbl_scorecomp_ibfk_1` (`acadsession_id`);

--
-- Indexes for table `scorelevel`
--
ALTER TABLE `scorelevel`
  ADD KEY `student_matric` (`student_matric`),
  ADD KEY `marker_matric` (`marker_matric`),
  ADD KEY `scoreplan_id` (`scoreplan_id`);

--
-- Indexes for table `scoringplan`
--
ALTER TABLE `scoringplan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `acadsession_id` (`acadsession_id`),
  ADD KEY `activitycategory_id` (`activitycategory_id`),
  ADD KEY `activity_id` (`activity_id`),
  ADD KEY `sig_id` (`sig_id`);

--
-- Indexes for table `scposition`
--
ALTER TABLE `scposition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sig`
--
ALTER TABLE `sig`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`matric`),
  ADD KEY `program_code` (`program_code`),
  ADD KEY `mentor_matric` (`mentor_matric`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usertype_id` (`usertype_id`),
  ADD KEY `sig_id` (`sig_id`),
  ADD KEY `tbl_user_ibfk_2` (`userstatus_id`);

--
-- Indexes for table `userstatus`
--
ALTER TABLE `userstatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academicsession`
--
ALTER TABLE `academicsession`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `academicyear`
--
ALTER TABLE `academicyear`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `activity_budget`
--
ALTER TABLE `activity_budget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `activity_category`
--
ALTER TABLE `activity_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `activity_type`
--
ALTER TABLE `activity_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `collaborator`
--
ALTER TABLE `collaborator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comment_category`
--
ALTER TABLE `comment_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `levelscore`
--
ALTER TABLE `levelscore`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `scattendance`
--
ALTER TABLE `scattendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `scdigitalcv`
--
ALTER TABLE `scdigitalcv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `scinvolvement`
--
ALTER TABLE `scinvolvement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `scleadership`
--
ALTER TABLE `scleadership`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `scmeeting`
--
ALTER TABLE `scmeeting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `scoringplan`
--
ALTER TABLE `scoringplan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `scposition`
--
ALTER TABLE `scposition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sig`
--
ALTER TABLE `sig`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `userstatus`
--
ALTER TABLE `userstatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `academicplan`
--
ALTER TABLE `academicplan`
  ADD CONSTRAINT `academicplan_ibfk_1` FOREIGN KEY (`student_matric`) REFERENCES `student` (`matric`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `academicplan_ibfk_2` FOREIGN KEY (`acadsession_id`) REFERENCES `academicsession` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `academicsession`
--
ALTER TABLE `academicsession`
  ADD CONSTRAINT `academicsession_ibfk_1` FOREIGN KEY (`acadyear_id`) REFERENCES `academicyear` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `academicsession_ibfk_2` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `activity_ibfk_1` FOREIGN KEY (`sig_id`) REFERENCES `sig` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `activity_ibfk_2` FOREIGN KEY (`acadsession_id`) REFERENCES `academicsession` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `activity_ibfk_3` FOREIGN KEY (`author_matric`) REFERENCES `student` (`matric`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `activity_ibfk_4` FOREIGN KEY (`advisor_matric`) REFERENCES `mentor` (`matric`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `activity_ibfk_5` FOREIGN KEY (`activitycategory_id`) REFERENCES `activity_category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `activity_committee`
--
ALTER TABLE `activity_committee`
  ADD CONSTRAINT `activity_committee_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `activity_committee_ibfk_2` FOREIGN KEY (`student_matric`) REFERENCES `student` (`matric`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `activity_committee_ibfk_3` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `citra_registration`
--
ALTER TABLE `citra_registration`
  ADD CONSTRAINT `citra_registration_ibfk_1` FOREIGN KEY (`student_matric`) REFERENCES `student` (`matric`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `citra_registration_ibfk_3` FOREIGN KEY (`citra_code`) REFERENCES `citra` (`code`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `citra_registration_ibfk_4` FOREIGN KEY (`grade_id`) REFERENCES `grade` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `citra_registration_ibfk_7` FOREIGN KEY (`acadsession_id`) REFERENCES `academicsession` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`student_matric`) REFERENCES `student` (`matric`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_3` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_4` FOREIGN KEY (`category_id`) REFERENCES `comment_category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `mentor`
--
ALTER TABLE `mentor`
  ADD CONSTRAINT `mentor_ibfk_2` FOREIGN KEY (`orgrole_id`) REFERENCES `role` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `mentor_ibfk_3` FOREIGN KEY (`matric`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `org_committee`
--
ALTER TABLE `org_committee`
  ADD CONSTRAINT `org_committee_ibfk_1` FOREIGN KEY (`sig_id`) REFERENCES `sig` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `org_committee_ibfk_2` FOREIGN KEY (`student_matric`) REFERENCES `student` (`matric`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `org_committee_ibfk_3` FOREIGN KEY (`acadyear_id`) REFERENCES `academicyear` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `org_committee_ibfk_4` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `scorecomp`
--
ALTER TABLE `scorecomp`
  ADD CONSTRAINT `scorecomp_ibfk_1` FOREIGN KEY (`acadsession_id`) REFERENCES `academicsession` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `scorecomp_ibfk_4` FOREIGN KEY (`student_matric`) REFERENCES `student` (`matric`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `scorecomp_ibfk_5` FOREIGN KEY (`marker_matric`) REFERENCES `mentor` (`matric`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `scorelevel`
--
ALTER TABLE `scorelevel`
  ADD CONSTRAINT `scorelevel_ibfk_4` FOREIGN KEY (`student_matric`) REFERENCES `student` (`matric`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `scorelevel_ibfk_5` FOREIGN KEY (`marker_matric`) REFERENCES `mentor` (`matric`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `scorelevel_ibfk_8` FOREIGN KEY (`scoreplan_id`) REFERENCES `scoringplan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `scoringplan`
--
ALTER TABLE `scoringplan`
  ADD CONSTRAINT `scoringplan_ibfk_1` FOREIGN KEY (`acadsession_id`) REFERENCES `academicsession` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `scoringplan_ibfk_2` FOREIGN KEY (`activitycategory_id`) REFERENCES `activity_category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `scoringplan_ibfk_3` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `scoringplan_ibfk_4` FOREIGN KEY (`sig_id`) REFERENCES `sig` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`program_code`) REFERENCES `program` (`code`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `student_ibfk_3` FOREIGN KEY (`mentor_matric`) REFERENCES `mentor` (`matric`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`usertype_id`) REFERENCES `usertype` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`userstatus_id`) REFERENCES `userstatus` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_3` FOREIGN KEY (`sig_id`) REFERENCES `sig` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

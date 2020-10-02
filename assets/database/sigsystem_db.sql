-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2020 at 10:09 AM
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
-- Table structure for table `tbl_academicplan`
--

CREATE TABLE `tbl_academicplan` (
  `student_matric` varchar(8) NOT NULL,
  `acadsession_id` int(11) NOT NULL,
  `cgpa_target` decimal(3,2) DEFAULT NULL,
  `cgpa_achieved` decimal(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_academicplan`
--

INSERT INTO `tbl_academicplan` (`student_matric`, `acadsession_id`, `cgpa_target`, `cgpa_achieved`) VALUES
('A160000', 1, '3.67', '0.00'),
('A160000', 2, '3.85', '0.00'),
('A160001', 1, '3.89', '4.00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_academicsession`
--

CREATE TABLE `tbl_academicsession` (
  `id` int(11) NOT NULL,
  `acadyear_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_academicsession`
--

INSERT INTO `tbl_academicsession` (`id`, `acadyear_id`, `semester_id`, `status`) VALUES
(1, 1, 1, 'active'),
(2, 1, 2, 'inactive'),
(3, 1, 3, 'inactive'),
(4, 2, 1, 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_academicyear`
--

CREATE TABLE `tbl_academicyear` (
  `id` int(2) NOT NULL,
  `acadyear` varchar(9) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_academicyear`
--

INSERT INTO `tbl_academicyear` (`id`, `acadyear`, `status`) VALUES
(1, '2016/2017', 'active'),
(2, '2017/2018', 'inactive'),
(3, '2018/2019', 'inactive'),
(4, '2019/2020', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_activity`
--

CREATE TABLE `tbl_activity` (
  `id` int(11) NOT NULL,
  `activity_name` varchar(255) NOT NULL,
  `activity_desc` text NOT NULL,
  `acadsession_id` int(11) DEFAULT NULL,
  `sig_id` int(11) DEFAULT NULL,
  `advisor_matric` varchar(8) DEFAULT NULL,
  `datetime_start` datetime DEFAULT NULL,
  `datetime_end` datetime DEFAULT NULL,
  `venue` varchar(255) DEFAULT NULL,
  `theme` varchar(255) NOT NULL,
  `actbudget_id` int(11) DEFAULT NULL,
  `author_matric` varchar(8) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `paperwork_file` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_activity`
--

INSERT INTO `tbl_activity` (`id`, `activity_name`, `activity_desc`, `acadsession_id`, `sig_id`, `advisor_matric`, `datetime_start`, `datetime_end`, `venue`, `theme`, `actbudget_id`, `author_matric`, `slug`, `photo_path`, `paperwork_file`, `created_at`, `updated_at`) VALUES
(1, 'VIC Bonding 2016', '<p>Bonding session with the member of the club at Port Dickson, Negeri Sembilan</p>\r\n', 1, 1, 'K003', '2020-08-01 08:26:28', '2020-08-01 16:26:28', NULL, '', NULL, NULL, 'VIC-Bonding-2016', '', '', '2020-09-02 07:06:21', '2020-09-04 08:47:39'),
(3, 'Meeting 1234', '<p>hehe</p>\r\n', 1, 4, 'K003', '2020-09-02 22:45:00', '2020-09-10 22:45:00', 'MR 1', 'Meeting sampai esok', NULL, NULL, 'Meeting-1234', '', '', '2020-09-06 07:05:46', '2020-09-04 08:47:39'),
(4, 'Onboarding with HRM', '<p>Invite new intern</p>\r\n', 2, 6, 'K001', '2020-09-10 00:01:00', '2020-09-19 00:01:00', NULL, '', NULL, NULL, 'Onboarding-with-HRM', '', '', '2020-09-06 07:05:46', '2020-09-04 08:47:39'),
(5, 'Meeting 4', '<p>meettttt bersama tunku taufiq</p>\r\n', 1, 10, 'K003', '2020-09-04 00:17:00', '2020-09-05 00:17:00', NULL, '', NULL, NULL, 'Meeting-4', '', '', '2020-09-06 07:05:46', '2020-09-04 08:47:39'),
(6, 'Lawatan to Media Prima', '<p>This visit to media prima is to enhance our club member on how media production is conducted within the real world</p>\r\n', 1, 1, 'K001', '2020-09-03 11:37:00', '2020-09-04 11:37:00', 'Media Prima', 'Biar orang buat kita, kita buat website', NULL, NULL, 'Lawatan-to-Media-Prima', '', '', '2020-09-06 07:05:46', '2020-09-04 08:47:39'),
(8, 'Sample Activity', '<p>In a small group, you will create a raft from an 8-inch-by-8-inch piece of aluminum foil and four plastic straws; the goal for the raft is to hold as many pennies as possible. All materials will be provided for you, and you cannot use any outside materials.</p>\r\n', 1, 1, 'K004', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '', NULL, NULL, 'Sample-Activity', '', '', '2020-09-06 08:01:39', '2020-09-06 08:01:39'),
(9, 'Dinner', '<p>Dinner with the whole batch of the club</p>\r\n', 1, 1, 'K003', '2020-10-02 20:00:00', '2020-10-02 20:30:00', 'Tenera Tenera 2', 'Maqon', NULL, NULL, 'Dinner', '', '', '2020-10-02 07:19:49', '2020-10-02 07:19:49'),
(10, 'Dinner 2.0', '<p>Dinner 2.0</p>\r\n', 1, 1, 'K001', '2020-10-02 16:05:00', '2020-10-03 16:05:00', 'BGR', 'takde', NULL, NULL, 'Dinner-20', '', '', '2020-10-02 08:03:25', '2020-10-02 08:03:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_activity_budget`
--

CREATE TABLE `tbl_activity_budget` (
  `id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `sponsor_amount` int(11) NOT NULL,
  `expense_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_activity_committee`
--

CREATE TABLE `tbl_activity_committee` (
  `activity_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `student_matric` varchar(8) DEFAULT NULL,
  `role_desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_activity_committee`
--

INSERT INTO `tbl_activity_committee` (`activity_id`, `role_id`, `student_matric`, `role_desc`) VALUES
(1, 11, 'A160000', 'Makanan'),
(6, 9, NULL, ''),
(1, 5, 'A160001', ''),
(9, 5, NULL, ''),
(9, 6, NULL, ''),
(9, 9, NULL, ''),
(10, 5, 'A160003', ''),
(10, 6, 'A160002', ''),
(10, 9, 'A160001', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` varchar(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `name`) VALUES
('admin', 'najibsuib');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_citra`
--

CREATE TABLE `tbl_citra` (
  `code` varchar(8) NOT NULL,
  `name_bm` varchar(50) NOT NULL,
  `name_en` varchar(50) NOT NULL,
  `citra_level` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_citra`
--

INSERT INTO `tbl_citra` (`code`, `name_bm`, `name_en`, `citra_level`) VALUES
('LMCK1331', 'Komunikasi Efektif', 'Effective Communication', 'C2'),
('LMCK1421', 'Pemikiran Kritikal dan Penyelesaian Masalah', 'Critical Thinking and Problem Solving', 'C3'),
('LMCK1531', 'Kepimpinan dan Kreativiti', 'Leadership and Creativity', 'C4'),
('LMCK1621', 'Etika dan Profesional', 'Ethics and Professionalism', 'C1'),
('LMCK2711', 'Tanggungjawab Alam Sekitar', 'Environmental Responsibility', 'C5'),
('LMCK2811', 'Sosial dan Kebertanggungjawaban', 'Social and Responsibilities', 'C6');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_citra_registration`
--

CREATE TABLE `tbl_citra_registration` (
  `student_matric` varchar(8) NOT NULL,
  `acadsession_id` int(11) NOT NULL,
  `citra_code` varchar(8) NOT NULL,
  `grade_id` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_citra_registration`
--

INSERT INTO `tbl_citra_registration` (`student_matric`, `acadsession_id`, `citra_code`, `grade_id`) VALUES
('A160000', 1, 'LMCK1331', NULL),
('A160000', 1, 'LMCK1421', NULL),
('A160001', 1, 'LMCK1531', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_collaborator`
--

CREATE TABLE `tbl_collaborator` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `background` varchar(255) NOT NULL,
  `activity_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment`
--

CREATE TABLE `tbl_comment` (
  `activity_id` int(11) NOT NULL,
  `student_matric` varchar(8) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `comment` varchar(255) NOT NULL,
  `commented_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_comment`
--

INSERT INTO `tbl_comment` (`activity_id`, `student_matric`, `role_id`, `comment`, `commented_at`, `category_id`) VALUES
(1, 'A160000', 5, 'Best', '2020-09-03 05:39:46', 1),
(1, 'A160002', 9, 'HUHUHU', '2020-09-03 05:39:46', 1),
(6, 'A160002', 12, '<p>komenkomen</p>\r\n', '2020-09-03 06:37:03', 1),
(6, 'A160002', 12, 'try', '2020-09-03 09:24:29', 1),
(6, 'A160002', 12, 'try', '2020-09-03 09:24:32', 1),
(4, 'A160002', 12, 'test onboarding', '2020-09-03 09:31:45', 1),
(8, 'A160002', 12, 'Sample comment', '2020-09-06 08:02:18', 1),
(6, 'A160002', 12, 'pass', '2020-09-23 08:16:13', 1),
(6, 'A160002', 12, 'helo', '2020-09-23 08:21:15', 1),
(3, 'A160000', 12, 'No food dowan come', '2020-09-28 16:31:47', 1),
(6, 'A160000', NULL, 'Venue isnt good', '2020-10-01 22:31:23', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment_category`
--

CREATE TABLE `tbl_comment_category` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_comment_category`
--

INSERT INTO `tbl_comment_category` (`id`, `category`) VALUES
(1, 'General'),
(2, 'Venue');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grade`
--

CREATE TABLE `tbl_grade` (
  `id` int(2) NOT NULL,
  `grade` varchar(2) NOT NULL,
  `value` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_grade`
--

INSERT INTO `tbl_grade` (`id`, `grade`, `value`) VALUES
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
-- Table structure for table `tbl_lecturer`
--

CREATE TABLE `tbl_lecturer` (
  `matric` varchar(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `room` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_levelscore`
--

CREATE TABLE `tbl_levelscore` (
  `id` int(11) NOT NULL,
  `level` varchar(50) NOT NULL,
  `percentage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_levelscore`
--

INSERT INTO `tbl_levelscore` (`id`, `level`, `percentage`) VALUES
(1, 'A1', 15),
(2, 'A2', 15),
(3, 'B1', 10),
(4, 'COMP', 15);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mentor`
--

CREATE TABLE `tbl_mentor` (
  `matric` varchar(8) NOT NULL,
  `position` varchar(60) NOT NULL,
  `roomnum` varchar(50) NOT NULL,
  `orgrole_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_mentor`
--

INSERT INTO `tbl_mentor` (`matric`, `position`, `roomnum`, `orgrole_id`) VALUES
('K001', 'Head of CAIT', 'E-12-12', 1),
('K002', 'Head of Masters Programme', 'E-1-2', 2),
('K003', 'Teaching Instructor', '', 1),
('K004', 'Dr Astronomy', '', 1),
('L001', 'Dr of Mobile App', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_org_committee`
--

CREATE TABLE `tbl_org_committee` (
  `sig_id` int(2) DEFAULT NULL,
  `student_matric` varchar(8) DEFAULT NULL,
  `acadyear_id` int(2) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `role_desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_org_committee`
--

INSERT INTO `tbl_org_committee` (`sig_id`, `student_matric`, `acadyear_id`, `role_id`, `role_desc`) VALUES
(1, 'A160000', 1, 3, ''),
(1, 'A160001', 1, 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_program`
--

CREATE TABLE `tbl_program` (
  `code` varchar(4) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_program`
--

INSERT INTO `tbl_program` (`code`, `name`) VALUES
('CS', 'Computer Science'),
('IT', 'Information Technology'),
('SEIS', 'Software Engineering (Information)'),
('SEMM', 'Software Engineering (Multimedia)');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `id` int(11) NOT NULL,
  `rolename` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`id`, `rolename`) VALUES
(1, 'Club Manager'),
(2, 'Club Advisor'),
(3, 'President'),
(4, 'Deputy President'),
(5, 'Project Director'),
(6, 'Deputy Project Director'),
(7, 'Treasurer'),
(8, 'Assistant Treasurer'),
(9, 'Secretary'),
(10, 'Assistant Secretary'),
(11, 'Committee Member (AJK)'),
(12, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_scattendance`
--

CREATE TABLE `tbl_scattendance` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_scattendance`
--

INSERT INTO `tbl_scattendance` (`id`, `name`, `score`) VALUES
(1, 'Present', 5),
(2, 'Absent - MC', 1),
(3, 'Total Absent', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_scdigitalcv`
--

CREATE TABLE `tbl_scdigitalcv` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_scdigitalcv`
--

INSERT INTO `tbl_scdigitalcv` (`id`, `name`, `score`) VALUES
(1, 'Very attractive design and very informative', 5),
(2, 'Attractive design and informative', 4),
(3, 'Moderate design and information', 3),
(4, 'No activity of current year', 2),
(5, 'No update since previous year', 1),
(6, 'No digital CV', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_scinvolvement`
--

CREATE TABLE `tbl_scinvolvement` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_scinvolvement`
--

INSERT INTO `tbl_scinvolvement` (`id`, `name`, `score`) VALUES
(1, 'Fully Active', 7),
(2, 'Moderately Active', 5),
(3, 'Less Active', 3),
(4, 'Not Active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_scleadership`
--

CREATE TABLE `tbl_scleadership` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_scleadership`
--

INSERT INTO `tbl_scleadership` (`id`, `name`, `score`) VALUES
(1, 'Very good', 5),
(2, 'Good', 4),
(3, 'Moderate', 3),
(4, 'Very little', 1),
(5, 'No leadership', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_scmeeting`
--

CREATE TABLE `tbl_scmeeting` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_scmeeting`
--

INSERT INTO `tbl_scmeeting` (`id`, `name`, `score`) VALUES
(1, 'Full', 3),
(2, 'Partially full', 2),
(3, 'Seldom', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_scorecomp`
--

CREATE TABLE `tbl_scorecomp` (
  `acadsession_id` int(11) NOT NULL,
  `student_matric` varchar(8) NOT NULL,
  `marker_matric` varchar(8) NOT NULL,
  `levelscore_id` int(11) NOT NULL,
  `sc_digitalcv` int(11) NOT NULL,
  `sc_leadership` int(11) NOT NULL,
  `sc_volunteer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_scorecomp`
--

INSERT INTO `tbl_scorecomp` (`acadsession_id`, `student_matric`, `marker_matric`, `levelscore_id`, `sc_digitalcv`, `sc_leadership`, `sc_volunteer`) VALUES
(1, 'A160000', 'K001', 4, 2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_scorelevel`
--

CREATE TABLE `tbl_scorelevel` (
  `acadsession_id` int(11) NOT NULL,
  `student_matric` varchar(8) NOT NULL,
  `marker_matric` varchar(8) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `levelscore_id` int(11) NOT NULL,
  `sc_position` int(11) DEFAULT NULL,
  `sc_meeting` int(11) DEFAULT NULL,
  `sc_attendance` int(11) DEFAULT NULL,
  `sc_involvement` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_scorelevel`
--

INSERT INTO `tbl_scorelevel` (`acadsession_id`, `student_matric`, `marker_matric`, `activity_id`, `levelscore_id`, `sc_position`, `sc_meeting`, `sc_attendance`, `sc_involvement`) VALUES
(1, 'A160000', 'K001', 6, 1, 2, 5, NULL, NULL),
(1, 'A160000', 'K001', 5, 2, 4, NULL, NULL, NULL),
(1, 'A160000', 'K001', 3, 3, 3, NULL, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_scposition`
--

CREATE TABLE `tbl_scposition` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_scposition`
--

INSERT INTO `tbl_scposition` (`id`, `name`, `score`) VALUES
(1, 'Project Director', 5),
(2, 'Deputy Project Director', 4),
(3, 'Secretary', 3),
(4, 'Treasurer', 3),
(5, 'Others', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_semester`
--

CREATE TABLE `tbl_semester` (
  `id` int(11) NOT NULL,
  `semester` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_semester`
--

INSERT INTO `tbl_semester` (`id`, `semester`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sig`
--

CREATE TABLE `tbl_sig` (
  `id` int(2) NOT NULL,
  `code` varchar(6) NOT NULL,
  `signame` varchar(100) NOT NULL,
  `logo_path` varchar(255) NOT NULL DEFAULT 'default_logo.png',
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sig`
--

INSERT INTO `tbl_sig` (`id`, `code`, `signame`, `logo_path`, `description`) VALUES
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
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `matric` varchar(8) NOT NULL,
  `phonenum` varchar(12) NOT NULL,
  `program_code` varchar(4) DEFAULT NULL,
  `joined_sig` year(4) DEFAULT NULL,
  `mentor_matric` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`matric`, `phonenum`, `program_code`, `joined_sig`, `mentor_matric`) VALUES
('A123', '0011', 'SEIS', NULL, NULL),
('A160000', '0123456789', 'SEMM', NULL, 'K004'),
('A160001', '0123334444', 'SEIS', NULL, 'K003'),
('A160002', '011-2228888', 'SEMM', NULL, 'K003'),
('A160003', '013-1212333', 'IT', NULL, 'K001');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` varchar(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype_id` int(11) NOT NULL,
  `sig_id` int(11) DEFAULT NULL,
  `profile_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `userstatus_id` int(11) DEFAULT NULL,
  `dob` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `name`, `email`, `password`, `usertype_id`, `sig_id`, `profile_image`, `created_at`, `userstatus_id`, `dob`) VALUES
('A160000', 'Khairul Anu AR', 'a160000@siswa.my', 'password', 3, 1, '', '2020-09-04 08:14:26', 2, NULL),
('A160001', 'Farhan Kamal', 'A160001@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 3, 1, '', '2020-09-26 10:42:51', 2, '1992-06-06'),
('A160002', 'Minmin', 'A160002@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 3, 1, '', '2020-09-26 11:03:24', 2, '1997-05-05'),
('A160003', 'YinYin', 'A160003@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 3, 1, '', '2020-09-26 11:05:18', 2, '1999-12-02'),
('admin', 'Admin1', 'admin@gmail.com', 'admin123', 1, NULL, '', '2020-09-07 07:39:53', 2, NULL),
('K001', 'Dr Syahanim bte', 'syahanim@ukm.my', '5f4dcc3b5aa765d61d8327deb882cf99', 2, 1, 'anim.png', '2020-09-26 11:06:40', 2, NULL),
('K002', 'Assoc Prof. Dr. Tengku Meriam', 'tsmeriam@ukm.edu.my', 'password', 2, 1, 'tengku.png', '2020-09-26 19:15:31', 2, NULL),
('K003', 'Masura bt Rahmat', 'masura@ukm.edu.my', 'password', 2, 1, 'masura.png', '2020-09-26 19:14:23', 2, NULL),
('K004', 'Dr AffenD', 'k004@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 2, 1, '', '2020-09-27 05:17:13', 2, '1996-05-05'),
('L001', 'Extra VIC Mentor', 'mrloo1@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 2, 1, '', '2020-09-26 20:38:24', 2, '1990-12-05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userstatus`
--

CREATE TABLE `tbl_userstatus` (
  `id` int(11) NOT NULL,
  `userstatus` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_userstatus`
--

INSERT INTO `tbl_userstatus` (`id`, `userstatus`) VALUES
(1, 'pending'),
(2, 'active'),
(3, 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_usertype`
--

CREATE TABLE `tbl_usertype` (
  `id` int(11) NOT NULL,
  `usertype` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_usertype`
--

INSERT INTO `tbl_usertype` (`id`, `usertype`) VALUES
(1, 'admin'),
(2, 'mentor'),
(3, 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_academicplan`
--
ALTER TABLE `tbl_academicplan`
  ADD KEY `tbl_academicplan_ibfk_1` (`student_matric`),
  ADD KEY `acadsession_id` (`acadsession_id`);

--
-- Indexes for table `tbl_academicsession`
--
ALTER TABLE `tbl_academicsession`
  ADD PRIMARY KEY (`id`),
  ADD KEY `acadyear_id` (`acadyear_id`),
  ADD KEY `semester_id` (`semester_id`);

--
-- Indexes for table `tbl_academicyear`
--
ALTER TABLE `tbl_academicyear`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_activity`
--
ALTER TABLE `tbl_activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sig_id` (`sig_id`),
  ADD KEY `acadsession_id` (`acadsession_id`),
  ADD KEY `author_matric` (`author_matric`),
  ADD KEY `advisor_matric` (`advisor_matric`);

--
-- Indexes for table `tbl_activity_budget`
--
ALTER TABLE `tbl_activity_budget`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_activity_committee`
--
ALTER TABLE `tbl_activity_committee`
  ADD KEY `student_matric` (`student_matric`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `tbl_activity_committee_ibfk_1` (`activity_id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_citra`
--
ALTER TABLE `tbl_citra`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `tbl_citra_registration`
--
ALTER TABLE `tbl_citra_registration`
  ADD KEY `student_matric` (`student_matric`),
  ADD KEY `citra_code` (`citra_code`),
  ADD KEY `grade_id` (`grade_id`),
  ADD KEY `tbl_citra_registration_ibfk_7` (`acadsession_id`);

--
-- Indexes for table `tbl_collaborator`
--
ALTER TABLE `tbl_collaborator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD KEY `activity_id` (`activity_id`),
  ADD KEY `tbl_comment_ibfk_2` (`student_matric`),
  ADD KEY `tbl_comment_ibfk_4` (`category_id`),
  ADD KEY `tbl_comment_ibfk_3` (`role_id`);

--
-- Indexes for table `tbl_comment_category`
--
ALTER TABLE `tbl_comment_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_grade`
--
ALTER TABLE `tbl_grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_lecturer`
--
ALTER TABLE `tbl_lecturer`
  ADD PRIMARY KEY (`matric`);

--
-- Indexes for table `tbl_levelscore`
--
ALTER TABLE `tbl_levelscore`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_mentor`
--
ALTER TABLE `tbl_mentor`
  ADD PRIMARY KEY (`matric`),
  ADD KEY `orgrole_id` (`orgrole_id`);

--
-- Indexes for table `tbl_org_committee`
--
ALTER TABLE `tbl_org_committee`
  ADD KEY `sig_id` (`sig_id`),
  ADD KEY `student_matric` (`student_matric`),
  ADD KEY `acadyear_id` (`acadyear_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `tbl_program`
--
ALTER TABLE `tbl_program`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_scattendance`
--
ALTER TABLE `tbl_scattendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_scdigitalcv`
--
ALTER TABLE `tbl_scdigitalcv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_scinvolvement`
--
ALTER TABLE `tbl_scinvolvement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_scleadership`
--
ALTER TABLE `tbl_scleadership`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_scmeeting`
--
ALTER TABLE `tbl_scmeeting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_scorecomp`
--
ALTER TABLE `tbl_scorecomp`
  ADD KEY `levelscore_id` (`levelscore_id`),
  ADD KEY `student_matric` (`student_matric`),
  ADD KEY `marker_matric` (`marker_matric`),
  ADD KEY `tbl_scorecomp_ibfk_1` (`acadsession_id`);

--
-- Indexes for table `tbl_scorelevel`
--
ALTER TABLE `tbl_scorelevel`
  ADD KEY `activity_id` (`activity_id`),
  ADD KEY `student_matric` (`student_matric`),
  ADD KEY `marker_matric` (`marker_matric`),
  ADD KEY `levelscore_id` (`levelscore_id`),
  ADD KEY `tbl_scorelevel_ibfk_1` (`acadsession_id`);

--
-- Indexes for table `tbl_scposition`
--
ALTER TABLE `tbl_scposition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_semester`
--
ALTER TABLE `tbl_semester`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sig`
--
ALTER TABLE `tbl_sig`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`matric`),
  ADD KEY `program_code` (`program_code`),
  ADD KEY `mentor_matric` (`mentor_matric`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usertype_id` (`usertype_id`),
  ADD KEY `userstatus_id` (`userstatus_id`),
  ADD KEY `sig_id` (`sig_id`);

--
-- Indexes for table `tbl_userstatus`
--
ALTER TABLE `tbl_userstatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_usertype`
--
ALTER TABLE `tbl_usertype`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_academicsession`
--
ALTER TABLE `tbl_academicsession`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_academicyear`
--
ALTER TABLE `tbl_academicyear`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_activity`
--
ALTER TABLE `tbl_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_activity_budget`
--
ALTER TABLE `tbl_activity_budget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_collaborator`
--
ALTER TABLE `tbl_collaborator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_comment_category`
--
ALTER TABLE `tbl_comment_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_grade`
--
ALTER TABLE `tbl_grade`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_levelscore`
--
ALTER TABLE `tbl_levelscore`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_scattendance`
--
ALTER TABLE `tbl_scattendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_scdigitalcv`
--
ALTER TABLE `tbl_scdigitalcv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_scinvolvement`
--
ALTER TABLE `tbl_scinvolvement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_scleadership`
--
ALTER TABLE `tbl_scleadership`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_scmeeting`
--
ALTER TABLE `tbl_scmeeting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_scposition`
--
ALTER TABLE `tbl_scposition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_semester`
--
ALTER TABLE `tbl_semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_sig`
--
ALTER TABLE `tbl_sig`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_userstatus`
--
ALTER TABLE `tbl_userstatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_usertype`
--
ALTER TABLE `tbl_usertype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_academicplan`
--
ALTER TABLE `tbl_academicplan`
  ADD CONSTRAINT `tbl_academicplan_ibfk_1` FOREIGN KEY (`student_matric`) REFERENCES `tbl_student` (`matric`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_academicplan_ibfk_2` FOREIGN KEY (`acadsession_id`) REFERENCES `tbl_academicsession` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_academicsession`
--
ALTER TABLE `tbl_academicsession`
  ADD CONSTRAINT `tbl_academicsession_ibfk_1` FOREIGN KEY (`acadyear_id`) REFERENCES `tbl_academicyear` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_academicsession_ibfk_2` FOREIGN KEY (`semester_id`) REFERENCES `tbl_semester` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tbl_activity`
--
ALTER TABLE `tbl_activity`
  ADD CONSTRAINT `tbl_activity_ibfk_1` FOREIGN KEY (`sig_id`) REFERENCES `tbl_sig` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_activity_ibfk_2` FOREIGN KEY (`acadsession_id`) REFERENCES `tbl_academicsession` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_activity_ibfk_3` FOREIGN KEY (`author_matric`) REFERENCES `tbl_student` (`matric`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_activity_ibfk_4` FOREIGN KEY (`advisor_matric`) REFERENCES `tbl_mentor` (`matric`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_activity_committee`
--
ALTER TABLE `tbl_activity_committee`
  ADD CONSTRAINT `tbl_activity_committee_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `tbl_activity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_activity_committee_ibfk_2` FOREIGN KEY (`student_matric`) REFERENCES `tbl_student` (`matric`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_activity_committee_ibfk_3` FOREIGN KEY (`role_id`) REFERENCES `tbl_role` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_citra_registration`
--
ALTER TABLE `tbl_citra_registration`
  ADD CONSTRAINT `tbl_citra_registration_ibfk_1` FOREIGN KEY (`student_matric`) REFERENCES `tbl_student` (`matric`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_citra_registration_ibfk_3` FOREIGN KEY (`citra_code`) REFERENCES `tbl_citra` (`code`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_citra_registration_ibfk_4` FOREIGN KEY (`grade_id`) REFERENCES `tbl_grade` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_citra_registration_ibfk_7` FOREIGN KEY (`acadsession_id`) REFERENCES `tbl_academicsession` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD CONSTRAINT `tbl_comment_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `tbl_activity` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_comment_ibfk_2` FOREIGN KEY (`student_matric`) REFERENCES `tbl_student` (`matric`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_comment_ibfk_3` FOREIGN KEY (`role_id`) REFERENCES `tbl_role` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_comment_ibfk_4` FOREIGN KEY (`category_id`) REFERENCES `tbl_comment_category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_mentor`
--
ALTER TABLE `tbl_mentor`
  ADD CONSTRAINT `tbl_mentor_ibfk_2` FOREIGN KEY (`orgrole_id`) REFERENCES `tbl_role` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_mentor_ibfk_3` FOREIGN KEY (`matric`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tbl_org_committee`
--
ALTER TABLE `tbl_org_committee`
  ADD CONSTRAINT `tbl_org_committee_ibfk_1` FOREIGN KEY (`sig_id`) REFERENCES `tbl_sig` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_org_committee_ibfk_2` FOREIGN KEY (`student_matric`) REFERENCES `tbl_student` (`matric`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_org_committee_ibfk_3` FOREIGN KEY (`acadyear_id`) REFERENCES `tbl_academicyear` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_org_committee_ibfk_4` FOREIGN KEY (`role_id`) REFERENCES `tbl_role` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_scorecomp`
--
ALTER TABLE `tbl_scorecomp`
  ADD CONSTRAINT `tbl_scorecomp_ibfk_1` FOREIGN KEY (`acadsession_id`) REFERENCES `tbl_academicsession` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_scorecomp_ibfk_2` FOREIGN KEY (`levelscore_id`) REFERENCES `tbl_levelscore` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_scorecomp_ibfk_4` FOREIGN KEY (`student_matric`) REFERENCES `tbl_student` (`matric`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_scorecomp_ibfk_5` FOREIGN KEY (`marker_matric`) REFERENCES `tbl_mentor` (`matric`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tbl_scorelevel`
--
ALTER TABLE `tbl_scorelevel`
  ADD CONSTRAINT `tbl_scorelevel_ibfk_1` FOREIGN KEY (`acadsession_id`) REFERENCES `tbl_academicsession` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_scorelevel_ibfk_3` FOREIGN KEY (`activity_id`) REFERENCES `tbl_activity` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_scorelevel_ibfk_4` FOREIGN KEY (`student_matric`) REFERENCES `tbl_student` (`matric`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_scorelevel_ibfk_5` FOREIGN KEY (`marker_matric`) REFERENCES `tbl_mentor` (`matric`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_scorelevel_ibfk_6` FOREIGN KEY (`levelscore_id`) REFERENCES `tbl_levelscore` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD CONSTRAINT `tbl_student_ibfk_1` FOREIGN KEY (`program_code`) REFERENCES `tbl_program` (`code`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_student_ibfk_3` FOREIGN KEY (`mentor_matric`) REFERENCES `tbl_mentor` (`matric`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`usertype_id`) REFERENCES `tbl_usertype` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_user_ibfk_2` FOREIGN KEY (`userstatus_id`) REFERENCES `tbl_userstatus` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_user_ibfk_3` FOREIGN KEY (`sig_id`) REFERENCES `tbl_sig` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

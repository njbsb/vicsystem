-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2020 at 07:09 PM
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
-- Table structure for table `tbl_academic_plan`
--

CREATE TABLE `tbl_academic_plan` (
  `student_matric` varchar(8) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `cgpa_target` decimal(3,2) NOT NULL,
  `cgpa_achieved` decimal(3,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_academic_session`
--

CREATE TABLE `tbl_academic_session` (
  `id` int(2) NOT NULL,
  `session` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_academic_session`
--

INSERT INTO `tbl_academic_session` (`id`, `session`) VALUES
(1, '2016/2017'),
(2, '2017/2018'),
(3, '2018/2019');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_activity`
--

CREATE TABLE `tbl_activity` (
  `id` int(11) NOT NULL,
  `activity_name` varchar(255) NOT NULL,
  `activity_desc` text NOT NULL,
  `acad_session_fk` int(2) DEFAULT NULL,
  `semester_fk` int(1) NOT NULL,
  `sig_id_fk` int(2) DEFAULT NULL,
  `advisor_matric_fk` varchar(8) DEFAULT NULL,
  `datetime_start` datetime DEFAULT NULL,
  `datetime_end` datetime DEFAULT NULL,
  `author_matric_fk` varchar(8) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_activity`
--

INSERT INTO `tbl_activity` (`id`, `activity_name`, `activity_desc`, `acad_session_fk`, `semester_fk`, `sig_id_fk`, `advisor_matric_fk`, `datetime_start`, `datetime_end`, `author_matric_fk`, `slug`, `photo_path`, `updated_at`) VALUES
(1, 'VIC Bonding 2016', 'Bonding session with the member of the club at Port Dickson, Negeri Sembilan', 2, 2, 2, 'K0213', '2020-08-01 08:26:28', '2020-08-01 16:26:28', '', 'vic-bonding-2016', NULL, '2020-09-04 08:47:39'),
(3, 'meeting 1', 'hehe', 3, 3, 4, 'K0213', '2020-09-02 22:45:00', '2020-09-10 22:45:00', NULL, 'meeting-1', '', '2020-09-04 08:47:39'),
(4, 'Onboarding with HRM', '<p>Invite new intern</p>\r\n', 3, 2, 6, 'K1111', '2020-09-10 00:01:00', '2020-09-19 00:01:00', NULL, 'Onboarding-with-HRM', '', '2020-09-04 08:47:39'),
(5, 'Meeting 4', '<p>meettttt bersama tunku taufiq</p>\r\n', 1, 2, 10, 'K0213', '2020-09-04 00:17:00', '2020-09-05 00:17:00', NULL, 'Meeting-4', '', '2020-09-04 08:47:39'),
(6, 'Berita Harian', '<p>PUTRAJAYA: Seramai 48 individu yang ingkar arahan Perintah Kawalan Pergerakan (PKP) ditahan pihak berkuasa, semalam.</p>\r\n\r\n<p>Daripada jumlah itu, Menteri Kanan (Keselamatan), Datuk Seri Ismail Sabri Yaakob, berkata seramai 47 individu dikompaun dan seorang dijamin.</p>\r\n\r\n<p>&quot;Antara kesalahan ingkar arahan PKP termasuk 12 individu yang gagal menyediakan peralatan dan catatan keluar masuk, 17 individu yang tidak memakai pelitup muka, premis beroperasi lebih masa (13), langgar perintah kuarantin (seorang), dan aktiviti membabitkan kehadiran orang ramai yang menyukarkan penjarakan fizikal (lima).</p>\r\n\r\n<p>&quot;Task Force Operasi Pematuhan yang diketuai Polis Diraja Malaysia (PDRM) membuat 58,050 pemeriksaan semalam bagi memantau dan menguat kuasa pematuhan prosedur operasi standard (SOP) Perintah Kawalan Pergerakan Pemulihan (PKPP).</p>\r\n\r\n<p>&quot;Sebanyak 3,059 pasukan pematuhan dengan 13,042 anggota membuat pemantauan di 3,703 pasar raya, 4,955 restoran serta 1,255 penjaja, 1,137 kilang, 3,863 bank dan 1,039 pejabat kerajaan,&quot; katanya dalam kenyataan media, hari ini.</p>\r\n', 2, 3, 9, 'K1111', '2020-09-03 11:37:00', '2020-09-04 11:37:00', NULL, 'Berita-Harian', '', '2020-09-04 08:47:39');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_activity_comment`
--

CREATE TABLE `tbl_activity_comment` (
  `activity_id_fk` int(11) NOT NULL,
  `student_matric_fk` varchar(8) NOT NULL,
  `role_id_fk` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `commented_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_activity_comment`
--

INSERT INTO `tbl_activity_comment` (`activity_id_fk`, `student_matric_fk`, `role_id_fk`, `comment`, `commented_at`) VALUES
(1, 'A160000', 5, 'Best', '2020-09-03 05:39:46'),
(1, 'A166666', 9, 'HUHUHU', '2020-09-03 05:39:46'),
(6, 'A166666', 12, '<p>komenkomen</p>\r\n', '2020-09-03 06:37:03'),
(6, 'A166666', 12, 'try', '2020-09-03 09:24:29'),
(6, 'A166666', 12, 'try', '2020-09-03 09:24:32'),
(4, 'A166666', 12, 'test onboarding', '2020-09-03 09:31:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_activity_role`
--

CREATE TABLE `tbl_activity_role` (
  `activity_id_fk` int(11) DEFAULT NULL,
  `student_id_fk` varchar(8) DEFAULT NULL,
  `role_id_fk` int(11) DEFAULT NULL,
  `role_desc` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_activity_role`
--

INSERT INTO `tbl_activity_role` (`activity_id_fk`, `student_id_fk`, `role_id_fk`, `role_desc`) VALUES
(1, 'A160000', 11, 'Makanan'),
(6, 'A166666', 9, NULL);

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
-- Table structure for table `tbl_citra_student`
--

CREATE TABLE `tbl_citra_student` (
  `student_matric` varchar(8) NOT NULL,
  `session_id` int(11) NOT NULL,
  `semester_id` int(1) NOT NULL,
  `citra_code` varchar(8) NOT NULL,
  `grade_id` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Table structure for table `tbl_mark_level`
--

CREATE TABLE `tbl_mark_level` (
  `level_code` varchar(3) NOT NULL,
  `mark_percentage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_mark_level`
--

INSERT INTO `tbl_mark_level` (`level_code`, `mark_percentage`) VALUES
('A1', 15),
('A2', 15),
('B', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mentor`
--

CREATE TABLE `tbl_mentor` (
  `matric` varchar(8) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `position` varchar(60) NOT NULL,
  `sig_id_fk` int(2) DEFAULT NULL,
  `org_role_id_fk` int(11) DEFAULT NULL,
  `photo_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_mentor`
--

INSERT INTO `tbl_mentor` (`matric`, `name`, `email`, `password`, `position`, `sig_id_fk`, `org_role_id_fk`, `photo_path`) VALUES
('K0000', 'Test_user_mentor', 'usermentor1@mail.com', 'password', 'Head', 3, 1, 'affendi.jpg'),
('K0011', 'Dr. Syahanim bt Mohd Salleh', 'syahanim@ukm.edu.my', 'password', 'Programming Language Technology', 1, 2, 'anim.png'),
('K0213', 'Masura bt Rahmat', 'masura@ukm.edu.my', 'password', 'Teaching Instructor', 1, 1, 'masura.png'),
('K1111', 'Afendy', 'fendy@mail.com', 'yes', 'Dr', 1, 1, 'affendi.jpg'),
('K1234', 'Dr. Tengku Meriam bt Tengku Wook', 'tsmeriam@ukm.edu.my', 'password', 'Head of Masters Programme', 1, 2, 'tengku.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_organisation_role`
--

CREATE TABLE `tbl_organisation_role` (
  `sig_id_fk` int(2) DEFAULT NULL,
  `member_matric_fk` varchar(8) DEFAULT NULL,
  `acad_session_id_fk` int(2) DEFAULT NULL,
  `role_id_fk` int(11) DEFAULT NULL,
  `role_desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_organisation_role`
--

INSERT INTO `tbl_organisation_role` (`sig_id_fk`, `member_matric_fk`, `acad_session_id_fk`, `role_id_fk`, `role_desc`) VALUES
(1, 'A160000', 1, 3, '');

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
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`id`, `role_name`) VALUES
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
  `signame` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sig`
--

INSERT INTO `tbl_sig` (`id`, `code`, `signame`) VALUES
(1, 'VIC', 'Video Innovation Club'),
(2, 'CE', 'Cyber Ethics'),
(3, 'IC', 'Imagine Cup'),
(4, 'IMC', 'Intelligence Machines Club'),
(5, 'IMEC', 'Interactive Multimedia Club'),
(6, 'PCC', 'Programming Challenge Club'),
(7, 'LI', 'Lensa Informatics'),
(8, 'MAD', 'Mobile Application Development Club'),
(9, 'NUMOSS', 'National University of Malaysia Open Source Society'),
(10, 'RC', 'Robotics Club'),
(11, 'ARVIS', 'Autonomous Robot and Vision Systems Lab'),
(12, 'IBC', 'i-BISNES Club');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `matric` varchar(8) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phonenum` varchar(12) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) DEFAULT NULL,
  `program_code_fk` varchar(4) DEFAULT NULL,
  `sig_id_fk` int(2) DEFAULT NULL,
  `mentor_id_fk` varchar(8) DEFAULT NULL,
  `photo_path` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`matric`, `name`, `phonenum`, `email`, `password`, `program_code_fk`, `sig_id_fk`, `mentor_id_fk`, `photo_path`) VALUES
('A000000', 'User_student', '0130030003', 'user_student@mail.com', 'password', 'CS', 1, 'K0011', 'affendi.jpg'),
('A160000', 'Amin Ariff', '0123456789', 'a1600000@siswa.ukm.edu.my', 'password', 'SEMM', 1, 'K1234', ''),
('A160001', 'Khairul Anuar', '0123334444', 'a160001@siswa.ukm.edu.my', 'password', 'SEMM', 1, 'K0213', ''),
('A166666', 'Yin', '0112223333', 'yin@ukm.my', 'password', 'CS', 1, 'K0011', 'facebook.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_matric` varchar(8) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_matric`, `password`, `usertype_id`, `created_at`) VALUES
('A000000', 'password', 3, '2020-09-04 08:14:26'),
('A160000', 'password', 3, '2020-09-04 08:14:26'),
('K0000', 'password', 2, '2020-09-04 08:17:25');

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
-- Indexes for table `tbl_academic_plan`
--
ALTER TABLE `tbl_academic_plan`
  ADD KEY `student_matric` (`student_matric`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `semester_id` (`semester_id`);

--
-- Indexes for table `tbl_academic_session`
--
ALTER TABLE `tbl_academic_session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_activity`
--
ALTER TABLE `tbl_activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `acad_session_fk` (`acad_session_fk`),
  ADD KEY `advisor_mentor_fk` (`advisor_matric_fk`),
  ADD KEY `sig_id_fk` (`sig_id_fk`),
  ADD KEY `semester_fk` (`semester_fk`);

--
-- Indexes for table `tbl_activity_comment`
--
ALTER TABLE `tbl_activity_comment`
  ADD KEY `activity_id_fk` (`activity_id_fk`),
  ADD KEY `student_matric_fk` (`student_matric_fk`),
  ADD KEY `role_id_fk` (`role_id_fk`);

--
-- Indexes for table `tbl_activity_role`
--
ALTER TABLE `tbl_activity_role`
  ADD KEY `activity_id_fk` (`activity_id_fk`),
  ADD KEY `student_id_fk` (`student_id_fk`),
  ADD KEY `role_id_fk` (`role_id_fk`);

--
-- Indexes for table `tbl_citra`
--
ALTER TABLE `tbl_citra`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `tbl_citra_student`
--
ALTER TABLE `tbl_citra_student`
  ADD KEY `student_matric` (`student_matric`),
  ADD KEY `citra_code` (`citra_code`),
  ADD KEY `grade_id` (`grade_id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `semester_id` (`semester_id`);

--
-- Indexes for table `tbl_grade`
--
ALTER TABLE `tbl_grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_mark_level`
--
ALTER TABLE `tbl_mark_level`
  ADD PRIMARY KEY (`level_code`);

--
-- Indexes for table `tbl_mentor`
--
ALTER TABLE `tbl_mentor`
  ADD PRIMARY KEY (`matric`),
  ADD KEY `org_role_id_fk` (`org_role_id_fk`),
  ADD KEY `sig_id_fk` (`sig_id_fk`);

--
-- Indexes for table `tbl_organisation_role`
--
ALTER TABLE `tbl_organisation_role`
  ADD KEY `acad_session_id_fk` (`acad_session_id_fk`),
  ADD KEY `member_matric_fk` (`member_matric_fk`),
  ADD KEY `sig_id_fk` (`sig_id_fk`),
  ADD KEY `role_id_fk` (`role_id_fk`);

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
  ADD KEY `mentor_id_fk` (`mentor_id_fk`),
  ADD KEY `program_code_fk` (`program_code_fk`),
  ADD KEY `sig_id_fk` (`sig_id_fk`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_matric`),
  ADD KEY `usertype_id` (`usertype_id`);

--
-- Indexes for table `tbl_usertype`
--
ALTER TABLE `tbl_usertype`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_academic_session`
--
ALTER TABLE `tbl_academic_session`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_activity`
--
ALTER TABLE `tbl_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_grade`
--
ALTER TABLE `tbl_grade`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- AUTO_INCREMENT for table `tbl_usertype`
--
ALTER TABLE `tbl_usertype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_academic_plan`
--
ALTER TABLE `tbl_academic_plan`
  ADD CONSTRAINT `tbl_academic_plan_ibfk_1` FOREIGN KEY (`student_matric`) REFERENCES `tbl_student` (`matric`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_academic_plan_ibfk_2` FOREIGN KEY (`session_id`) REFERENCES `tbl_academic_session` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_academic_plan_ibfk_3` FOREIGN KEY (`semester_id`) REFERENCES `tbl_semester` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tbl_activity`
--
ALTER TABLE `tbl_activity`
  ADD CONSTRAINT `tbl_activity_ibfk_1` FOREIGN KEY (`acad_session_fk`) REFERENCES `tbl_academic_session` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_activity_ibfk_2` FOREIGN KEY (`advisor_matric_fk`) REFERENCES `tbl_mentor` (`matric`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_activity_ibfk_3` FOREIGN KEY (`sig_id_fk`) REFERENCES `tbl_sig` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_activity_ibfk_4` FOREIGN KEY (`semester_fk`) REFERENCES `tbl_semester` (`id`);

--
-- Constraints for table `tbl_activity_comment`
--
ALTER TABLE `tbl_activity_comment`
  ADD CONSTRAINT `tbl_activity_comment_ibfk_1` FOREIGN KEY (`activity_id_fk`) REFERENCES `tbl_activity` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_activity_comment_ibfk_2` FOREIGN KEY (`student_matric_fk`) REFERENCES `tbl_student` (`matric`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_activity_comment_ibfk_3` FOREIGN KEY (`role_id_fk`) REFERENCES `tbl_role` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tbl_activity_role`
--
ALTER TABLE `tbl_activity_role`
  ADD CONSTRAINT `tbl_activity_role_ibfk_1` FOREIGN KEY (`activity_id_fk`) REFERENCES `tbl_activity` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_activity_role_ibfk_2` FOREIGN KEY (`student_id_fk`) REFERENCES `tbl_student` (`matric`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_activity_role_ibfk_3` FOREIGN KEY (`role_id_fk`) REFERENCES `tbl_role` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tbl_citra_student`
--
ALTER TABLE `tbl_citra_student`
  ADD CONSTRAINT `tbl_citra_student_ibfk_1` FOREIGN KEY (`student_matric`) REFERENCES `tbl_student` (`matric`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_citra_student_ibfk_3` FOREIGN KEY (`citra_code`) REFERENCES `tbl_citra` (`code`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_citra_student_ibfk_4` FOREIGN KEY (`grade_id`) REFERENCES `tbl_grade` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_citra_student_ibfk_5` FOREIGN KEY (`session_id`) REFERENCES `tbl_academic_session` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_citra_student_ibfk_6` FOREIGN KEY (`semester_id`) REFERENCES `tbl_semester` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tbl_mentor`
--
ALTER TABLE `tbl_mentor`
  ADD CONSTRAINT `tbl_mentor_ibfk_2` FOREIGN KEY (`org_role_id_fk`) REFERENCES `tbl_role` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_mentor_ibfk_3` FOREIGN KEY (`sig_id_fk`) REFERENCES `tbl_sig` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_organisation_role`
--
ALTER TABLE `tbl_organisation_role`
  ADD CONSTRAINT `tbl_organisation_role_ibfk_1` FOREIGN KEY (`acad_session_id_fk`) REFERENCES `tbl_academic_session` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_organisation_role_ibfk_2` FOREIGN KEY (`member_matric_fk`) REFERENCES `tbl_student` (`matric`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_organisation_role_ibfk_3` FOREIGN KEY (`sig_id_fk`) REFERENCES `tbl_sig` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_organisation_role_ibfk_4` FOREIGN KEY (`role_id_fk`) REFERENCES `tbl_role` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD CONSTRAINT `tbl_student_ibfk_1` FOREIGN KEY (`mentor_id_fk`) REFERENCES `tbl_mentor` (`matric`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_student_ibfk_2` FOREIGN KEY (`program_code_fk`) REFERENCES `tbl_program` (`code`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_student_ibfk_3` FOREIGN KEY (`sig_id_fk`) REFERENCES `tbl_sig` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`usertype_id`) REFERENCES `tbl_usertype` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

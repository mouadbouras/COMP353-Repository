-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 28, 2016 at 08:26 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crsmgrFSS`
--
CREATE DATABASE IF NOT EXISTS `crsmgrFSS` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `crsmgrFSS`;

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(65) NOT NULL,
  `section_id` int(11) UNSIGNED NOT NULL,
  `due_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `name`, `section_id`, `due_date`) VALUES
(1, 'Database assignment 1', 1, '2016-07-24 23:59:00'),
(2, 'Database assignment 2', 1, '2016-07-24 23:59:00'),
(3, 'Database assignment 3', 2, '2016-07-24 23:59:00');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`) VALUES
(1, 'COMP353'),
(2, 'COMP345');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(65) NOT NULL,
  `size_bytes` int(11) UNSIGNED NOT NULL,
  `checksum` varchar(65) NOT NULL,
  `upload_date` datetime NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(65) NOT NULL,
  `version_number` int(2) UNSIGNED NOT NULL,
  `file_name` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `name`, `size_bytes`, `checksum`, `upload_date`, `user_id`, `ip_address`, `version_number`, `file_name`) VALUES
(30, 'mouad assignment 1', 0, '', '2016-07-27 19:53:53', 4, '', 1, '14696492334tnaoja527qgj124gi6isdcgco4.docx'),
(31, 'mouad assignment 1', 0, '', '2016-07-27 19:54:05', 4, '', 2, '14696492454tnaoja527qgj124gi6isdcgco4.docx'),
(32, 'mouad assignment 1', 0, '', '2016-07-27 19:54:23', 4, '', 3, '14696492634tnaoja527qgj124gi6isdcgco4.docx'),
(33, 'mouad assignment 1', 0, '', '2016-07-27 20:12:34', 4, '', 4, '14696503544tnaoja527qgj124gi6isdcgco4.docx'),
(34, 'testing download', 0, '', '2016-07-28 18:23:43', 4, '', 1, '14697302244g9n5u3rsbgl4hvtjbvb5pje7c5.docx');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) UNSIGNED NOT NULL,
  `course_id` int(11) UNSIGNED NOT NULL,
  `semester_id` int(11) UNSIGNED NOT NULL,
  `ta_user_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `course_id`, `semester_id`, `ta_user_id`) VALUES
(1, 1, 1, 6),
(2, 1, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` int(11) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `start_date`, `end_date`) VALUES
(1, '2016-07-01', '2016-08-18'),
(2, '2016-04-01', '2016-06-24');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `section_id` int(11) UNSIGNED NOT NULL,
  `team_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`user_id`, `section_id`, `team_id`) VALUES
(4, 1, 1),
(5, 1, 1),
(7, 1, 1),
(10, 1, 1),
(8, 1, 2),
(9, 1, 2),
(11, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `assignment_id` int(11) UNSIGNED NOT NULL,
  `team_id` int(11) UNSIGNED NOT NULL,
  `file_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`id`, `assignment_id`, `team_id`, `file_id`) VALUES
(26, 1, 1, 30),
(27, 1, 1, 31),
(28, 1, 1, 32),
(29, 1, 1, 33),
(30, 1, 1, 34);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) UNSIGNED NOT NULL,
  `leader_user_id` int(11) UNSIGNED DEFAULT NULL,
  `section_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `leader_user_id`, `section_id`) VALUES
(1, NULL, 1),
(2, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(65) NOT NULL,
  `password` varchar(65) NOT NULL,
  `email` varchar(65) NOT NULL,
  `first_name` varchar(65) DEFAULT NULL,
  `last_name` varchar(65) DEFAULT NULL,
  `crsmgrid` int(11) UNSIGNED NOT NULL,
  `permission_level` int(2) UNSIGNED NOT NULL DEFAULT '10'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `first_name`, `last_name`, `crsmgrid`, `permission_level`) VALUES
(4, 'mouad', '$2y$10$/5Mofw/MtWIlqRVrSxW4ne2Wd1fw91O7oD/kHJpSo2dFEMcCScwWi', 'mouad@emmail.com', 'mouad', 'bour', 23, 2),
(5, 'test', '$2y$10$NX9NbuEjlYMu8ddMbgKZ9OS3CGiwggV/j0LQhcslogAnX.6Lu8qMG', 'test@email.com', 'test', 'test', 1, 1),
(6, 'ta', '$2y$10$591uPUjq8Kmccp6IF1CmNODV0KbCACiy/WdmsJ3feNDXnnSgkRD6e', 'ta@email.com', 'ta', 'ta', 1, 3),
(7, 'jesse', '$2y$10$wg/NYXnniwwLwA2Nm3rYm.zzUmCkQ8XVIdyKZ8cV8/vl859zUk3pO', 'jesse@email.com', 'jesse', 'des', 1, 1),
(8, 'viv', '$2y$10$uCRcCayS4YadJ9lhUgTdP.zt3z4LkVoVyUChxCDJwehxqvGt5kPUy', 'viv@email.com', 'viv', 'yao', 232, 1),
(9, 'stel', '$2y$10$9xQ.bNUPPc7v9J72dcDPEOJIHFvHgVCp.gaO0djez4B4BmCA2.UFy', 'stel@email.com', 'stel', 'stel', 123123, 1),
(10, 'raz', '$2y$10$bP2g6SEp2EE.fgokBkrr8uKdyiXNxboTy4sTsYt1wlBYO3WLqVEme', 'raz@email.com', 'raz', 'r', 342, 1),
(11, 'mindi', '$2y$10$uD/4HGI9qtxd4a1G8Po3Ju7T72Fcf/G5lidZxCVyoE4y.dFIl5.ze', 'mindi@email.com', 'mindi', 'mi', 2343, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_assignments_section_id` (`section_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_files_user_id` (`user_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sections_course_id` (`course_id`),
  ADD KEY `fk_sections_semester_id` (`semester_id`),
  ADD KEY `fk_sections_user_id` (`ta_user_id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`user_id`,`section_id`),
  ADD KEY `fk_students_team_id` (`team_id`),
  ADD KEY `fk_students_section_id` (`section_id`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_submissions_assignment_id` (`assignment_id`),
  ADD KEY `fk_submissions_team_id` (`team_id`),
  ADD KEY `fk_submissions_file_id` (`file_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_teams_user_id` (`leader_user_id`),
  ADD KEY `fk_teams_section_id` (`section_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `fk_assignments_section_id` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`);

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `fk_files_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `fk_sections_course_id` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `fk_sections_semester_id` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`),
  ADD CONSTRAINT `fk_sections_user_id` FOREIGN KEY (`ta_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `fk_students_section_id` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`),
  ADD CONSTRAINT `fk_students_team_id` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`),
  ADD CONSTRAINT `fk_students_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `submissions`
--
ALTER TABLE `submissions`
  ADD CONSTRAINT `fk_submissions_assignment_id` FOREIGN KEY (`assignment_id`) REFERENCES `assignments` (`id`),
  ADD CONSTRAINT `fk_submissions_file_id` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`),
  ADD CONSTRAINT `fk_submissions_team_id` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`);

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `fk_teams_section_id` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`),
  ADD CONSTRAINT `fk_teams_user_id` FOREIGN KEY (`leader_user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

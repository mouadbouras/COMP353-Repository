-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 07, 2016 at 12:54 AM
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
(1, 'Assignment 1', 5, '2016-08-31 00:00:00'),
(2, 'assingment 2', 5, '2016-08-06 23:59:00'),
(4, 'test123', 5, '2019-01-02 06:02:00'),
(5, 'Assignment1', 6, '2016-08-11 01:39:00'),
(6, 'test1233', 5, '2016-09-06 22:12:00');

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
(2, 'COMP345'),
(3, 'super'),
(5, 'Databases'),
(6, 'Engineering'),
(7, 'Mathematics'),
(8, 'Computers'),
(9, 'Electronics'),
(10, 'Elective');

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
(2, 'test', 0, '0b6a00b6f6ddb36c950a710ec088c69a', '2016-08-04 18:56:32', 2, '192.168.101.100', 1, '1470336992m349v2d2bguam1hnk4c1oh8el0.pdf'),
(5, 'my File', 8519, '0b6a00b6f6ddb36c950a710ec088c69a', '2016-08-04 19:14:06', 2, '::1', 2, '14703380462m349v2d2bguam1hnk4c1oh8el0.pdf'),
(6, 'testnew', 8519, '0b6a00b6f6ddb36c950a710ec088c69a', '2016-08-04 19:50:17', 2, '::1', 4, '14703402172m349v2d2bguam1hnk4c1oh8el0.pdf'),
(7, 'newsub', 8519, '0b6a00b6f6ddb36c950a710ec088c69a', '2016-08-06 02:37:52', 2, '::1', 5, '14704510722ncum51aff7t5nct884u1ijrii6.pdf'),
(8, 'newbew', 8519, '0b6a00b6f6ddb36c950a710ec088c69a', '2016-08-06 02:42:27', 2, '::1', 6, '14704513472ncum51aff7t5nct884u1ijrii6.pdf'),
(9, 'tesss', 8519, '0b6a00b6f6ddb36c950a710ec088c69a', '2016-08-06 02:43:16', 2, '::1', 12, '14704513962ncum51aff7t5nct884u1ijrii6.pdf'),
(10, 'test', 8519, '0b6a00b6f6ddb36c950a710ec088c69a', '2016-08-06 02:43:32', 2, '::1', 123, '14704514132ncum51aff7t5nct884u1ijrii6.pdf'),
(12, 'est', 8519, '0b6a00b6f6ddb36c950a710ec088c69a', '2016-08-06 20:50:06', 2, '::1', 1, '14705166062bhud4bc0lt7dpqoahrk9ltkcd1.pdf'),
(13, 'test', 8519, '0b6a00b6f6ddb36c950a710ec088c69a', '2016-08-06 22:13:36', 2, '::1', 3, '14705216162bb2gmps098l3kquo7qhnpokv10.pdf'),
(14, 'test', 8519, '0b6a00b6f6ddb36c950a710ec088c69a', '2016-08-06 22:24:13', 1, '::1', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) UNSIGNED NOT NULL,
  `course_id` int(11) UNSIGNED NOT NULL,
  `semester_id` int(11) UNSIGNED NOT NULL,
  `ta_user_id` int(11) UNSIGNED DEFAULT NULL,
  `instructor_user_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `course_id`, `semester_id`, `ta_user_id`, `instructor_user_id`) VALUES
(5, 1, 1, 1, 4),
(6, 1, 1, 1, NULL),
(8, 3, 1, 1, 4),
(9, 7, 1, 6, NULL),
(10, 10, 1, 1, NULL),
(11, 10, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `name`, `start_date`, `end_date`) VALUES
(1, 'Summer 2016', '2016-07-01', '2016-08-18'),
(3, 'fall 2015', '2015-08-01', '2015-12-08'),
(4, 'winter 2016', '2016-01-10', '2016-05-10');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `section_id` int(11) UNSIGNED NOT NULL,
  `team_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`user_id`, `section_id`, `team_id`) VALUES
(1, 5, NULL),
(13, 5, NULL),
(14, 5, NULL),
(15, 5, NULL),
(2, 5, 4),
(9, 5, 4),
(8, 8, 5),
(11, 5, 8),
(12, 5, 8);

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `assignment_id` int(11) UNSIGNED NOT NULL,
  `team_id` int(11) UNSIGNED NOT NULL,
  `file_id` int(11) UNSIGNED NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deletion_date` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`id`, `assignment_id`, `team_id`, `file_id`, `is_deleted`, `deletion_date`, `is_active`) VALUES
(1, 1, 4, 2, 0, NULL, 1),
(4, 1, 4, 5, 0, NULL, 0),
(5, 1, 4, 6, 0, NULL, 0),
(6, 1, 4, 7, 1, '2016-08-05 23:00:49', 0),
(8, 1, 4, 8, 0, NULL, 0),
(9, 1, 4, 9, 0, NULL, 0),
(10, 1, 4, 10, 1, '2016-08-05 23:00:43', 0),
(12, 4, 4, 12, 0, NULL, 0),
(13, 6, 4, 13, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) UNSIGNED NOT NULL,
  `leader_user_id` int(11) UNSIGNED DEFAULT NULL,
  `section_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `leader_user_id`, `section_id`) VALUES
(4, 2, 5),
(5, NULL, 8),
(6, NULL, 8),
(7, NULL, 8),
(8, NULL, 5);

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
(1, 'raz', '$2y$10$itcxI9jf3ZzBkdWJEA5HROhI/7KwQ9jm8rMbzqxxVmqblvncSo9Ra', 'raz@email.com', 'raz', 'r', 342, 4),
(2, 'mouad', '$2y$10$trnTlM5diWeDGUU1JFcJme/gYS6GFOav/yXFu5iJywFtkXbAoPYhi', 'mouad@email.com', 'mouad', 'bro', 276, 1),
(5, 'onlystudent', '$2y$10$4.46ZgHmbiRZhBR73amxTeDfcbm1F9nThef5Y8rD/tkkCUQtANSt2', 'onlystudent@mail.com', 'OnlyA', 'Student', 1, 1),
(6, 'onlyta', '$2y$10$NZwR0Ep1BICByDqmP7rrOebRTRTUO79ttOeKOJcg48GC2TuukpxVS', 'onlyta@mail.com', 'OnlyA', 'TA', 2, 1),
(7, 'onlyinstructor', '$2y$10$TCTLIaWRyJpTdX8rlzxCPOLXE/eZjux6.B2b2CkbajuAS/.BfH31e', 'onlyinstructor@mail.com', 'OnlyA', 'Instructor', 3, 1),
(8, 'onlyadmin', '$2y$10$yzdjsjAxxgN1PKc6QKwhseEh0j7NFQZCZtr3DyCwBj2eIJzJk0yoK', 'onlyadmin@mail.com', 'OnlyA', 'Admin', 4, 4),
(9, 'mindi', '$2y$10$ffulV3wL1BrlAqeWsqajvOHNw6OhAVWlobie5t14v5Qf2yiErp8N6', 'mindi@email.com', 'mindi', 'rat', 66, 1),
(10, 'admin', '$2y$10$itcxI9jf3ZzBkdWJEA5HROhI/7KwQ9jm8rMbzqxxVmqblvncSo9Ra', 'onlyadmin@mail.com', 'OnlyA', 'Admin', 4, 4),
(11, 'section5student1', '$2y$10$itcxI9jf3ZzBkdWJEA5HROhI/7KwQ9jm8rMbzqxxVmqblvncSo9Ra', 's5@email.com', 'student1', 'r', 1, 1),
(12, 'section5student2', '$2y$10$itcxI9jf3ZzBkdWJEA5HROhI/7KwQ9jm8rMbzqxxVmqblvncSo9Ra', 's5@email.com', 'student2', 'r', 1, 1),
(13, 'section5student3', '$2y$10$itcxI9jf3ZzBkdWJEA5HROhI/7KwQ9jm8rMbzqxxVmqblvncSo9Ra', 's5@email.com', 'student3', 'r', 1, 1),
(14, 'section5student4', '$2y$10$itcxI9jf3ZzBkdWJEA5HROhI/7KwQ9jm8rMbzqxxVmqblvncSo9Ra', 's5@email.com', 'student4', 'r', 1, 1),
(15, 'section5student5', '$2y$10$itcxI9jf3ZzBkdWJEA5HROhI/7KwQ9jm8rMbzqxxVmqblvncSo9Ra', 's5@email.com', 'student5', 'r', 1, 1);

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
  ADD KEY `fk_sections_user_id` (`ta_user_id`),
  ADD KEY `instructor_user_id` (`instructor_user_id`);

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
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
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `fk_teams_section_id` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`),
  ADD CONSTRAINT `fk_teams_user_id` FOREIGN KEY (`leader_user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

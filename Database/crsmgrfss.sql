SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


DROP TABLE IF EXISTS `assignments`;
CREATE TABLE IF NOT EXISTS `assignments` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(65) NOT NULL,
  `section_id` int(11) UNSIGNED NOT NULL,
  `due_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_assignments_section_id` (`section_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO `assignments` (`id`, `name`, `section_id`, `due_date`) VALUES
(1, 'Assignment 1', 1, '2016-08-31 00:00:00'),
(2, 'Assingment 2', 1, '2016-08-06 23:59:00'),
(4, 'Project 1', 1, '2019-01-02 06:02:00'),
(5, 'Assignment1', 6, '2016-08-11 01:39:00'),
(6, 'Project 2', 1, '2016-09-06 22:12:00'),
(7, 'Assignment 2', 6, '2016-09-08 05:29:00'),
(8, 'Assignment 1', 2, '2016-09-08 06:58:00'),
(9, 'Project 1', 2, '2016-09-08 06:59:00'),
(10, 'asg-test1', 12, '2016-08-08 14:46:00');

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(65) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO `courses` (`id`, `name`) VALUES
(1, 'COMP353'),
(2, 'COMP345'),
(3, 'COMP 352'),
(5, 'Databases'),
(6, 'Engineering'),
(7, 'Mathematics'),
(8, 'Computers'),
(9, 'Electronics'),
(10, 'Elective');

DROP TABLE IF EXISTS `files`;
CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(65) NOT NULL,
  `size_bytes` int(11) UNSIGNED NOT NULL,
  `checksum` varchar(65) NOT NULL,
  `upload_date` datetime NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(65) NOT NULL,
  `version_number` int(2) UNSIGNED NOT NULL,
  `file_name` varchar(65) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_files_user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

INSERT INTO `files` (`id`, `name`, `size_bytes`, `checksum`, `upload_date`, `user_id`, `ip_address`, `version_number`, `file_name`) VALUES
(55, 'asg1', 123124, 'a7f02a4cd09ed438d740fd47a752de68', '2016-08-12 06:46:44', 2, '::1', 1, '14709844042jqse3h0b2obp3fsn45j0eaqgd1.pdf'),
(56, 'as1_new', 717828, '93c12910f197c7cc3244a62e877e4770', '2016-08-12 06:48:13', 9, '::1', 2, '1470984493950hbfe8ejkgg0e4ldai7h6a2b1.pdf'),
(57, 'as2', 511928, 'f8303bba86ef24317130688e9d7edc66', '2016-08-12 06:48:34', 9, '::1', 1, '1470984514950hbfe8ejkgg0e4ldai7h6a2b1.pdf');

DROP TABLE IF EXISTS `interactions`;
CREATE TABLE IF NOT EXISTS `interactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action_code` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `team_id` int(11) DEFAULT NULL,
  `file_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

INSERT INTO `interactions` (`id`, `action_code`, `user_id`, `team_id`, `file_id`) VALUES
(13, 1, 2, 4, 55),
(14, 1, 9, 4, 56),
(15, 1, 9, 4, 57),
(16, 0, 2, 4, 56);

DROP TABLE IF EXISTS `sections`;
CREATE TABLE IF NOT EXISTS `sections` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `course_id` int(11) UNSIGNED NOT NULL,
  `semester_id` int(11) UNSIGNED NOT NULL,
  `ta_user_id` int(11) UNSIGNED DEFAULT NULL,
  `instructor_user_id` int(11) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sections_course_id` (`course_id`),
  KEY `fk_sections_semester_id` (`semester_id`),
  KEY `fk_sections_user_id` (`ta_user_id`),
  KEY `instructor_user_id` (`instructor_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO `sections` (`id`, `course_id`, `semester_id`, `ta_user_id`, `instructor_user_id`) VALUES
(1, 1, 1, 1, 4),
(2, 2, 1, NULL, 1),
(6, 1, 1, 1, NULL),
(8, 3, 1, 1, 4),
(9, 7, 1, 6, NULL),
(10, 10, 1, 1, NULL),
(11, 10, 1, 1, NULL),
(12, 1, 1, 1, 4);

DROP TABLE IF EXISTS `semesters`;
CREATE TABLE IF NOT EXISTS `semesters` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `semesters` (`id`, `name`, `start_date`, `end_date`) VALUES
(1, 'Summer 2016', '2016-07-01', '2016-08-18'),
(2, 'Fall 2015', '2015-09-01', '2015-12-08'),
(3, 'Winter 2016', '2016-01-10', '2016-05-10');

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `SID` int(7) NOT NULL,
  `SNAME` varchar(20) DEFAULT NULL,
  `major` char(4) DEFAULT NULL,
  `year` int(1) DEFAULT NULL,
  `bdate` date DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`SID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `student` (`SID`, `SNAME`, `major`, `year`, `bdate`, `password`) VALUES
(8, 'Brenda', 'COMP', 2, '1977-08-13', 'abc123'),
(10, 'Dupont', 'ENGL', 1, '1980-05-13', 'abc123');

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `section_id` int(11) UNSIGNED NOT NULL,
  `team_id` int(11) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`user_id`,`section_id`),
  KEY `fk_students_team_id` (`team_id`),
  KEY `fk_students_section_id` (`section_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `students` (`user_id`, `section_id`, `team_id`) VALUES
(8, 1, NULL),
(13, 1, NULL),
(14, 1, NULL),
(15, 1, NULL),
(2, 1, 4),
(9, 1, 4),
(8, 8, 5),
(11, 1, 8),
(12, 1, 8),
(2, 2, 12);

DROP TABLE IF EXISTS `submissions`;
CREATE TABLE IF NOT EXISTS `submissions` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `assignment_id` int(11) UNSIGNED NOT NULL,
  `team_id` int(11) UNSIGNED NOT NULL,
  `file_id` int(11) UNSIGNED NOT NULL,
  `size_change` bigint(20) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deletion_date` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_submissions_assignment_id` (`assignment_id`),
  KEY `fk_submissions_team_id` (`team_id`),
  KEY `fk_submissions_file_id` (`file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

INSERT INTO `submissions` (`id`, `assignment_id`, `team_id`, `file_id`, `size_change`, `is_deleted`, `deletion_date`, `is_active`) VALUES
(30, 1, 4, 55, 123124, 0, NULL, 0),
(31, 1, 4, 56, 594704, 0, NULL, 0),
(32, 2, 4, 57, 511928, 0, NULL, 0);
DROP TRIGGER IF EXISTS `upload_interact`;
DELIMITER $$
CREATE TRIGGER `upload_interact` AFTER INSERT ON `submissions` FOR EACH ROW BEGIN
	DECLARE _uid INT(11);
	SELECT user_id INTO _uid
	FROM files WHERE id = new.file_id;

	INSERT INTO interactions(action_code, user_id, team_id, file_id)
	VALUES (1, _uid, new.team_id, new.file_id);
END
$$
DELIMITER ;

DROP TABLE IF EXISTS `teams`;
CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `leader_user_id` int(11) UNSIGNED DEFAULT NULL,
  `section_id` int(11) UNSIGNED NOT NULL,
  `size_limit` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_teams_user_id` (`leader_user_id`),
  KEY `fk_teams_section_id` (`section_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

INSERT INTO `teams` (`id`, `leader_user_id`, `section_id`, `size_limit`) VALUES
(4, 2, 1, 10000000),
(5, NULL, 8, NULL),
(6, NULL, 8, NULL),
(7, NULL, 8, NULL),
(8, NULL, 1, NULL),
(10, NULL, 1, NULL),
(11, NULL, 6, NULL),
(12, NULL, 2, NULL),
(13, NULL, 12, NULL);

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(65) NOT NULL,
  `password` varchar(65) NOT NULL,
  `email` varchar(65) NOT NULL,
  `first_name` varchar(65) DEFAULT NULL,
  `last_name` varchar(65) DEFAULT NULL,
  `crsmgrid` int(11) UNSIGNED NOT NULL,
  `permission_level` int(2) UNSIGNED NOT NULL DEFAULT '10',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `username`, `password`, `email`, `first_name`, `last_name`, `crsmgrid`, `permission_level`) VALUES
(1, 'raz', '$2y$10$itcxI9jf3ZzBkdWJEA5HROhI/7KwQ9jm8rMbzqxxVmqblvncSo9Ra', 'raz@email.com', 'raz', 'r', 342, 4),
(2, 'mouad', '$2y$10$trnTlM5diWeDGUU1JFcJme/gYS6GFOav/yXFu5iJywFtkXbAoPYhi', 'mouad@email.com', 'mouad', 'bro', 276, 1),
(5, 'onlystudent', '$2y$10$4.46ZgHmbiRZhBR73amxTeDfcbm1F9nThef5Y8rD/tkkCUQtANSt2', 'onlystudent@mail.com', 'OnlyA', 'Student', 1, 1),
(6, 'onlyta', '$2y$10$NZwR0Ep1BICByDqmP7rrOebRTRTUO79ttOeKOJcg48GC2TuukpxVS', 'onlyta@mail.com', 'OnlyA', 'TA', 2, 1),
(7, 'onlyinstructor', '$2y$10$TCTLIaWRyJpTdX8rlzxCPOLXE/eZjux6.B2b2CkbajuAS/.BfH31e', 'onlyinstructor@mail.com', 'OnlyA', 'Instructor', 3, 1),
(8, 'onlyadmin', '$2y$10$yzdjsjAxxgN1PKc6QKwhseEh0j7NFQZCZtr3DyCwBj2eIJzJk0yoK', 'onlyadmin@mail.com', 'OnlyA', 'Admin', 4, 4),
(9, 'mindi', '$2y$10$ffulV3wL1BrlAqeWsqajvOHNw6OhAVWlobie5t14v5Qf2yiErp8N6', 'mindi@email.com', 'mindi', 'rat', 66, 1),
(10, 'admin', '$2y$10$itcxI9jf3ZzBkdWJEA5HROhI/7KwQ9jm8rMbzqxxVmqblvncSo9Ra', 'onlyadmin@mail.com', 'OnlyA', 'Admin', 4, 4),
(11, 'section1student1', '$2y$10$itcxI9jf3ZzBkdWJEA5HROhI/7KwQ9jm8rMbzqxxVmqblvncSo9Ra', 's5@email.com', 'student1', 'r', 1, 1),
(12, 'section1student2', '$2y$10$itcxI9jf3ZzBkdWJEA5HROhI/7KwQ9jm8rMbzqxxVmqblvncSo9Ra', 's5@email.com', 'student2', 'r', 1, 1),
(13, 'section1student3', '$2y$10$itcxI9jf3ZzBkdWJEA5HROhI/7KwQ9jm8rMbzqxxVmqblvncSo9Ra', 's5@email.com', 'student3', 'r', 1, 1),
(14, 'section1student4', '$2y$10$itcxI9jf3ZzBkdWJEA5HROhI/7KwQ9jm8rMbzqxxVmqblvncSo9Ra', 's5@email.com', 'student4', 'r', 1, 1),
(15, 'section1student5', '$2y$10$itcxI9jf3ZzBkdWJEA5HROhI/7KwQ9jm8rMbzqxxVmqblvncSo9Ra', 's5@email.com', 'student5', 'r', 1, 1);


ALTER TABLE `assignments`
  ADD CONSTRAINT `fk_assignments_section_id` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`);

ALTER TABLE `files`
  ADD CONSTRAINT `fk_files_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `sections`
  ADD CONSTRAINT `fk_sections_course_id` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `fk_sections_semester_id` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`),
  ADD CONSTRAINT `fk_sections_user_id` FOREIGN KEY (`ta_user_id`) REFERENCES `users` (`id`);

ALTER TABLE `students`
  ADD CONSTRAINT `fk_students_section_id` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`),
  ADD CONSTRAINT `fk_students_team_id` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`),
  ADD CONSTRAINT `fk_students_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `teams`
  ADD CONSTRAINT `fk_teams_section_id` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`),
  ADD CONSTRAINT `fk_teams_user_id` FOREIGN KEY (`leader_user_id`) REFERENCES `users` (`id`);
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

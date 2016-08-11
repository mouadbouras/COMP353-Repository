
-- MySQL dump 10.13  Distrib 5.6.17, for Linux (x86_64)
--
-- Host: bpc353_1.encs.concordia.ca    Database: bpc353_1
-- ------------------------------------------------------
-- Server version       5.6.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `archive_files`;

DROP TABLE IF EXISTS `archive_submissions`;

--
-- Table structure for table `assignments`
--

DROP TABLE IF EXISTS `assignments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assignments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(65) NOT NULL,
  `section_id` int(11) unsigned NOT NULL,
  `due_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_assignments_section_id` (`section_id`),
  CONSTRAINT `fk_assignments_section_id` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assignments`
--

LOCK TABLES `assignments` WRITE;
/*!40000 ALTER TABLE `assignments` DISABLE KEYS */;
INSERT INTO `assignments` VALUES (1,'Assignment 1',1,'2016-08-31 00:00:00'),(2,'Assingment 2',1,'2016-08-06 23:59:00'),(4,'Project 1',1,'2019-01-02 06:02:00'),(5,'Assignment1',6,'2016-08-11 01:39:00'),(6,'Project 2',1,'2016-09-06 22:12:00'),(7,'Assignment 2',6,'2016-09-08 05:29:00'),(8,'Assignment 1',2,'2016-09-08 06:58:00'),(9,'Project 1',2,'2016-09-08 06:59:00'),(10,'asg-test1',12,'2016-08-08 14:46:00');
/*!40000 ALTER TABLE `assignments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(65) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,'COMP353'),(2,'COMP345'),(3,'COMP 352'),(5,'Databases'),(6,'Engineering'),(7,'Mathematics'),(8,'Computers'),(9,'Electronics'),(10,'Elective');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(65) NOT NULL,
  `size_bytes` int(11) unsigned NOT NULL,
  `checksum` varchar(65) NOT NULL,
  `upload_date` datetime NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `ip_address` varchar(65) NOT NULL,
  `version_number` int(2) unsigned NOT NULL,
  `file_name` varchar(65) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_files_user_id` (`user_id`),
  CONSTRAINT `fk_files_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` VALUES (39,'test',22528,'66e9dc135291bff6fc6f49389b6874fb','2016-08-08 14:54:00',2,'132.205.46.192',1,'14706680402a3b41eec6818e668e251cae06d3e2a53.doc'),(40,'project 1 attempt1',81169,'5aa5fb51e6065163b8600d28b325b7ae','2016-08-08 14:56:06',2,'132.205.46.192',1,'14706681662117a45b7511f6ddb9473e2c18d567036.pdf'),(41,'attempt 2',81169,'5aa5fb51e6065163b8600d28b325b7ae','2016-08-08 14:56:39',2,'132.205.46.192',100,'14706681992117a45b7511f6ddb9473e2c18d567036.pdf'),(42,'second att',22528,'66e9dc135291bff6fc6f49389b6874fb','2016-08-08 14:58:15',2,'132.205.46.192',100,'14706682952117a45b7511f6ddb9473e2c18d567036.doc'),(43,'test',81169,'5aa5fb51e6065163b8600d28b325b7ae','2016-08-08 15:17:21',9,'132.205.46.192',1,'14706694419ceed5ed1eff85698308fd12ecca711ef.pdf'),(44,'test 2 ',81169,'5aa5fb51e6065163b8600d28b325b7ae','2016-08-08 15:17:31',9,'132.205.46.192',2,'14706694519ceed5ed1eff85698308fd12ecca711ef.pdf');
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sections` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(11) unsigned NOT NULL,
  `semester_id` int(11) unsigned NOT NULL,
  `ta_user_id` int(11) unsigned DEFAULT NULL,
  `instructor_user_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sections_course_id` (`course_id`),
  KEY `fk_sections_semester_id` (`semester_id`),
  KEY `fk_sections_user_id` (`ta_user_id`),
  KEY `instructor_user_id` (`instructor_user_id`),
  CONSTRAINT `fk_sections_course_id` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  CONSTRAINT `fk_sections_semester_id` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`),
  CONSTRAINT `fk_sections_user_id` FOREIGN KEY (`ta_user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sections`
--

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` VALUES (1,1,1,1,4),(2,2,1,NULL,1),(6,1,1,1,NULL),(8,3,1,1,4),(9,7,1,6,NULL),(10,10,1,1,NULL),(11,10,1,1,NULL),(12,1,3,1,4);
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `semesters`
--

DROP TABLE IF EXISTS `semesters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `semesters` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `semesters`
--

LOCK TABLES `semesters` WRITE;
/*!40000 ALTER TABLE `semesters` DISABLE KEYS */;
INSERT INTO `semesters` VALUES (1,'Summer 2016','2016-07-01','2016-08-18'),(2,'Fall 2015','2015-09-01','2015-12-08'),(3,'Winter 2016','2016-01-10','2016-05-10');
/*!40000 ALTER TABLE `semesters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `SID` int(7) NOT NULL,
  `SNAME` varchar(20) DEFAULT NULL,
  `major` char(4) DEFAULT NULL,
  `year` int(1) DEFAULT NULL,
  `bdate` date DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`SID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (8,'Brenda','COMP',2,'1977-08-13','abc123'),(10,'Dupont','ENGL',1,'1980-05-13','abc123');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students` (
  `user_id` int(11) unsigned NOT NULL,
  `section_id` int(11) unsigned NOT NULL,
  `team_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`user_id`,`section_id`),
  KEY `fk_students_team_id` (`team_id`),
  KEY `fk_students_section_id` (`section_id`),
  CONSTRAINT `fk_students_section_id` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`),
  CONSTRAINT `fk_students_team_id` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`),
  CONSTRAINT `fk_students_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (8,1,NULL),(13,1,NULL),(14,1,NULL),(15,1,NULL),(2,1,4),(9,1,4),(8,8,5),(11,1,8),(12,1,8),(2,2,12);
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `submissions`
--

DROP TABLE IF EXISTS `submissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `submissions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `assignment_id` int(11) unsigned NOT NULL,
  `team_id` int(11) unsigned NOT NULL,
  `file_id` int(11) unsigned NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deletion_date` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_submissions_assignment_id` (`assignment_id`),
  KEY `fk_submissions_team_id` (`team_id`),
  KEY `fk_submissions_file_id` (`file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `submissions`
--

LOCK TABLES `submissions` WRITE;
/*!40000 ALTER TABLE `submissions` DISABLE KEYS */;
INSERT INTO `submissions` VALUES (1,1,4,2,1,'2016-08-07 22:32:04',0),(4,1,4,5,0,NULL,0),(5,1,4,6,0,NULL,0),(6,1,4,7,1,'2016-08-05 23:00:49',0),(8,1,4,8,0,NULL,0),(9,1,4,9,0,NULL,0),(10,1,4,10,1,'2016-08-05 23:00:43',0),(12,4,4,12,0,NULL,0),(13,6,4,13,0,NULL,0),(14,2,4,39,0,NULL,0),(15,4,4,40,0,NULL,0),(16,4,4,41,0,NULL,0),(17,4,4,42,0,NULL,1),(18,4,4,43,0,NULL,0),(19,4,4,44,0,NULL,0);
/*!40000 ALTER TABLE `submissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teams` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `leader_user_id` int(11) unsigned DEFAULT NULL,
  `section_id` int(11) unsigned NOT NULL,
  `size_limit` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_teams_user_id` (`leader_user_id`),
  KEY `fk_teams_section_id` (`section_id`),
  CONSTRAINT `fk_teams_section_id` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`),
  CONSTRAINT `fk_teams_user_id` FOREIGN KEY (`leader_user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` VALUES (4,2,1,10000000),(5,NULL,8,NULL),(6,NULL,8,NULL),(7,NULL,8,NULL),(8,NULL,1,NULL),(10,NULL,1,NULL),(11,NULL,6,NULL),(12,NULL,2,NULL),(13,NULL,12,NULL);
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(65) NOT NULL,
  `password` varchar(65) NOT NULL,
  `email` varchar(65) NOT NULL,
  `first_name` varchar(65) DEFAULT NULL,
  `last_name` varchar(65) DEFAULT NULL,
  `crsmgrid` int(11) unsigned NOT NULL,
  `permission_level` int(2) unsigned NOT NULL DEFAULT '10',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'raz','$2y$10$itcxI9jf3ZzBkdWJEA5HROhI/7KwQ9jm8rMbzqxxVmqblvncSo9Ra','raz@email.com','raz','r',342,4),(2,'mouad','$2y$10$trnTlM5diWeDGUU1JFcJme/gYS6GFOav/yXFu5iJywFtkXbAoPYhi','mouad@email.com','mouad','bro',276,1),(5,'onlystudent','$2y$10$4.46ZgHmbiRZhBR73amxTeDfcbm1F9nThef5Y8rD/tkkCUQtANSt2','onlystudent@mail.com','OnlyA','Student',1,1),(6,'onlyta','$2y$10$NZwR0Ep1BICByDqmP7rrOebRTRTUO79ttOeKOJcg48GC2TuukpxVS','onlyta@mail.com','OnlyA','TA',2,1),(7,'onlyinstructor','$2y$10$TCTLIaWRyJpTdX8rlzxCPOLXE/eZjux6.B2b2CkbajuAS/.BfH31e','onlyinstructor@mail.com','OnlyA','Instructor',3,1),(8,'onlyadmin','$2y$10$yzdjsjAxxgN1PKc6QKwhseEh0j7NFQZCZtr3DyCwBj2eIJzJk0yoK','onlyadmin@mail.com','OnlyA','Admin',4,4),(9,'mindi','$2y$10$ffulV3wL1BrlAqeWsqajvOHNw6OhAVWlobie5t14v5Qf2yiErp8N6','mindi@email.com','mindi','rat',66,1),(10,'admin','$2y$10$itcxI9jf3ZzBkdWJEA5HROhI/7KwQ9jm8rMbzqxxVmqblvncSo9Ra','onlyadmin@mail.com','OnlyA','Admin',4,4),(11,'section1student1','$2y$10$itcxI9jf3ZzBkdWJEA5HROhI/7KwQ9jm8rMbzqxxVmqblvncSo9Ra','s5@email.com','student1','r',1,1),(12,'section1student2','$2y$10$itcxI9jf3ZzBkdWJEA5HROhI/7KwQ9jm8rMbzqxxVmqblvncSo9Ra','s5@email.com','student2','r',1,1),(13,'section1student3','$2y$10$itcxI9jf3ZzBkdWJEA5HROhI/7KwQ9jm8rMbzqxxVmqblvncSo9Ra','s5@email.com','student3','r',1,1),(14,'section1student4','$2y$10$itcxI9jf3ZzBkdWJEA5HROhI/7KwQ9jm8rMbzqxxVmqblvncSo9Ra','s5@email.com','student4','r',1,1),(15,'section1student5','$2y$10$itcxI9jf3ZzBkdWJEA5HROhI/7KwQ9jm8rMbzqxxVmqblvncSo9Ra','s5@email.com','student5','r',1,1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-08-11 14:59:52

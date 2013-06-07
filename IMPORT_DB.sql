-- MySQL dump 10.13  Distrib 5.5.31, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: bedmath
-- ------------------------------------------------------
-- Server version	5.5.31-0ubuntu0.12.10.1

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

--
-- Table structure for table `g0g1_answers`
--

DROP TABLE IF EXISTS `g0g1_answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g0g1_answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `full_text` varchar(5012) NOT NULL,
  `time` int(13) NOT NULL,
  `votes` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL,
  `accepted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_answers`
--

LOCK TABLES `g0g1_answers` WRITE;
/*!40000 ALTER TABLE `g0g1_answers` DISABLE KEYS */;
INSERT INTO `g0g1_answers` VALUES (7,26,28,'The vector (1,âˆ’2) is also neither positive nor negative, yet there is value in having the operation âˆ’(1,âˆ’2)=(âˆ’1,2).\r\n\r\nNote: there is no natural meaning for \"positive\" for vectors, this is just an analogy.',1370637198,0,1,0),(8,26,32,'The imaginary number i was discovered/invented/revealed as a solution the equation\r\nx2+1=0(âˆ—)\r\nThat equation, and that equation alone, is the link between i and the reals. However, there is another solution to (âˆ—): âˆ’i=âˆ’1Ã—i also satisfies (âˆ—). Basically, this is because (âˆ’1)2=1.\r\n\r\nSince the link between i and the reals is the same equation that is satisfied by âˆ’i, one can easily wonder, \"which is which?\" When we choose a solution to (âˆ—), do we get i or âˆ’i? In a sense, it doesn\'t matter; both satisfy (âˆ—) and i2=âˆ’1 is the property we use to do math in C.\r\n\r\nOn the other hand, complex conjugation, swapping iâ†”âˆ’i, is an important isomorphism of C. For instance, any polynomial with real coefficients that has x+iy as a root, must also have xâˆ’iy as a root. There are many ways to show this, but one of the most basic is by swapping iâ†”âˆ’i. This isomorphism does not affect the real coefficients of the polynomial, but it swaps x+iyâ†”xâˆ’iy.\r\n\r\nIn the end, we call one root of (âˆ—), i, and the other, âˆ’i; it really doesn\'t matter which. They both satisfy (âˆ—) and that is what is important.\r\n',1370637276,0,1,0);
/*!40000 ALTER TABLE `g0g1_answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g0g1_bans`
--

DROP TABLE IF EXISTS `g0g1_bans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g0g1_bans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` int(14) NOT NULL,
  `expires` int(11) NOT NULL,
  `comments` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_bans`
--

LOCK TABLES `g0g1_bans` WRITE;
/*!40000 ALTER TABLE `g0g1_bans` DISABLE KEYS */;
/*!40000 ALTER TABLE `g0g1_bans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g0g1_category`
--

DROP TABLE IF EXISTS `g0g1_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g0g1_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_category`
--

LOCK TABLES `g0g1_category` WRITE;
/*!40000 ALTER TABLE `g0g1_category` DISABLE KEYS */;
INSERT INTO `g0g1_category` VALUES (3,1,1,'Arithmetic'),(4,2,2,'Geometry'),(5,3,3,'Algebra'),(6,4,4,'Trigonometry'),(7,5,5,'Calculus');
/*!40000 ALTER TABLE `g0g1_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g0g1_image`
--

DROP TABLE IF EXISTS `g0g1_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g0g1_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(2) NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_image`
--

LOCK TABLES `g0g1_image` WRITE;
/*!40000 ALTER TABLE `g0g1_image` DISABLE KEYS */;
INSERT INTO `g0g1_image` VALUES (1,1,'placeholder','Used as a filler for image locations with nothing placed.'),(2,2,'writing-thumbnail','Little thumbnail image associated with written content. Displays as a preview. '),(3,3,'avatar','Profile image identifying user'),(4,4,'math_topic','Relating to the supported mathematics topics on site');
/*!40000 ALTER TABLE `g0g1_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g0g1_image_log`
--

DROP TABLE IF EXISTS `g0g1_image_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g0g1_image_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` int(2) NOT NULL,
  `content_id` int(11) NOT NULL,
  `order` int(3) NOT NULL,
  `image_name` varchar(50) NOT NULL,
  `file_type` varchar(31) NOT NULL,
  `upload_time` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=766 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_image_log`
--

LOCK TABLES `g0g1_image_log` WRITE;
/*!40000 ALTER TABLE `g0g1_image_log` DISABLE KEYS */;
INSERT INTO `g0g1_image_log` VALUES (725,0,3,7,1,'128','jpg','51235'),(723,0,3,5,1,'1612','png','587125'),(721,0,3,4,1,'6125612','jpg','1512'),(724,0,3,6,1,'189712','png','509182'),(716,0,3,1,1,'15125','png','12512'),(720,0,3,3,1,'2372','png','12512'),(719,0,3,2,1,'1612','jpg','5125125'),(758,15,2,3,0,'1362098521494','','1362098521'),(759,15,2,4,0,'136210082780','','1362100827'),(760,15,2,0,0,'136210130014','','1362101300'),(761,15,2,5,0,'1362101497608','','1362101497'),(762,15,2,6,0,'1362101627228','','1362101627'),(763,15,2,7,0,'1362102615654','','1362102615'),(764,15,2,8,0,'1362613256988','','1362613256'),(765,15,2,9,0,'1362613315415','','1362613315');
/*!40000 ALTER TABLE `g0g1_image_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g0g1_locking`
--

DROP TABLE IF EXISTS `g0g1_locking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g0g1_locking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_id` int(11) NOT NULL,
  `unlocked_by` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_locking`
--

LOCK TABLES `g0g1_locking` WRITE;
/*!40000 ALTER TABLE `g0g1_locking` DISABLE KEYS */;
INSERT INTO `g0g1_locking` VALUES (1,3,7,1362098555);
/*!40000 ALTER TABLE `g0g1_locking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g0g1_mail`
--

DROP TABLE IF EXISTS `g0g1_mail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g0g1_mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail_id` int(11) NOT NULL,
  `content` varchar(1080) NOT NULL,
  `subject` varchar(320) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_mail`
--

LOCK TABLES `g0g1_mail` WRITE;
/*!40000 ALTER TABLE `g0g1_mail` DISABLE KEYS */;
INSERT INTO `g0g1_mail` VALUES (1,1,'Hello [USERNAME], this is a default testing message using the GlobeOfGeek mailing system. Hopefully you received a message! ',''),(2,2,'Hello there [USERNAME] you currently have [CURRENT_POINTS] points on the site! We suggest you get your butt back on there and earn more!','You have points with GlobeOfGeek!'),(3,3,'Hello there! You have been invited to GlobeOfGeek, a platform in which pays you to submit and share content you\'ve created! This could be writing done in school, a story written during free time, or more! GlobeOfGeek wishes to combine \'work\' with the act of learning, so that you can develop further knowledge while making some cash online! Come take a look by clicking the link below, we welcome you to the community pal! globeofgeek.com/register/r/[USERNAME]','You have been invited to GlobeOfGeek.'),(4,4,'This is an account recovery sent from GlobeOfGeek.com, if you are trying to recover lost account settings then follow the link: www.globeofgeek.com/recover/validate/[USER_ID]/[EMAIL_RECOVERY_CODE]','Account Recovery');
/*!40000 ALTER TABLE `g0g1_mail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g0g1_mail_log`
--

DROP TABLE IF EXISTS `g0g1_mail_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g0g1_mail_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(32) NOT NULL,
  `default_id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `receiver_email` varchar(1080) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_mail_log`
--

LOCK TABLES `g0g1_mail_log` WRITE;
/*!40000 ALTER TABLE `g0g1_mail_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `g0g1_mail_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g0g1_points`
--

DROP TABLE IF EXISTS `g0g1_points`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g0g1_points` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_points`
--

LOCK TABLES `g0g1_points` WRITE;
/*!40000 ALTER TABLE `g0g1_points` DISABLE KEYS */;
INSERT INTO `g0g1_points` VALUES (1,1,'System Reward','Points rewarded by system.'),(2,2,'System Deduction','Points removed by system.'),(3,3,'PPS Reward','Content submitted as PayPerSubmit was accepted. '),(4,4,'PPU Reward','PPU content was unlocked by another user. '),(5,5,'PPU Deduction','Unlocked PPU content'),(6,6,'Points Purchase','User successfully purchased points!'),(7,7,'Donation Sent','Sent points to another user.'),(8,8,'Donation Received','Received points from another user. '),(9,9,'New User','User obtained some free points for successfully creating an account!'),(10,10,'Successful Invite','Influenced 1 new user to join the site!'),(11,11,'Answered Question','Tutor has been selected for their support on a question and receives the bid'),(12,12,'Asked Question','User asked question and places bid');
/*!40000 ALTER TABLE `g0g1_points` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g0g1_points_log`
--

DROP TABLE IF EXISTS `g0g1_points_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g0g1_points_log` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_type` int(11) NOT NULL,
  `subject` int(11) DEFAULT NULL,
  `object` int(11) DEFAULT NULL,
  `points` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_points_log`
--

LOCK TABLES `g0g1_points_log` WRITE;
/*!40000 ALTER TABLE `g0g1_points_log` DISABLE KEYS */;
INSERT INTO `g0g1_points_log` VALUES (72,12,NULL,0,-200,1370637125),(73,12,27,0,-205,1370637153),(74,10,27,0,25,1370637260),(75,9,32,0,10,1370637260),(76,12,27,0,-185,1370637428);
/*!40000 ALTER TABLE `g0g1_points_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g0g1_questions`
--

DROP TABLE IF EXISTS `g0g1_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g0g1_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topic` int(3) NOT NULL,
  `title` varchar(64) NOT NULL,
  `full` varchar(1024) NOT NULL,
  `bid` int(11) NOT NULL,
  `asked_by` int(11) NOT NULL,
  `answer` int(11) NOT NULL,
  `asked_time` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_questions`
--

LOCK TABLES `g0g1_questions` WRITE;
/*!40000 ALTER TABLE `g0g1_questions` DISABLE KEYS */;
INSERT INTO `g0g1_questions` VALUES (26,3,'What is âˆ’i exactly?','\r\n\r\nWe all know that i doesn\'t have any sign: it is neither positive nor negative. Then how can people use âˆ’i for anything?\r\n\r\nAlso, we define i a number such that i2=âˆ’1. But it can also be seen that (âˆ’i)2=âˆ’1. Then in what way is âˆ’i different from i? If it isn\'t, then why do we even have something like a âˆ’i?\r\n',205,27,0,1370637153,1),(27,3,'Is it possible to make integers a field?','\r\n\r\nIs it possible to define addition and/or multiplication on the set of\r\n\r\na) natural numbers (including 0: 0,1,2,3,...)\r\n\r\nb) integers (...,âˆ’2,âˆ’1,0,1,2,...)\r\n\r\nin such way that they will become fields?\r\n\r\nThanks in advance.\r\n',185,27,0,1370637428,1);
/*!40000 ALTER TABLE `g0g1_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g0g1_redeem`
--

DROP TABLE IF EXISTS `g0g1_redeem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g0g1_redeem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request_code` int(32) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `time` int(13) NOT NULL,
  `status` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_redeem`
--

LOCK TABLES `g0g1_redeem` WRITE;
/*!40000 ALTER TABLE `g0g1_redeem` DISABLE KEYS */;
INSERT INTO `g0g1_redeem` VALUES (8,2147483647,7,1000,1366591215,'pending'),(9,2147483647,7,1000,1366591294,'pending'),(10,2147483647,7,1000,1366591783,'pending'),(11,2147483647,7,4000,1366591787,'pending'),(12,2147483647,7,6000,1367271199,'pending'),(13,2147483647,7,5000,1367271201,'pending'),(14,2147483647,7,1000,1367271215,'pending'),(15,2147483647,8,9000,1367508454,'pending');
/*!40000 ALTER TABLE `g0g1_redeem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g0g1_rep_log`
--

DROP TABLE IF EXISTS `g0g1_rep_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g0g1_rep_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rule` int(11) NOT NULL,
  `topic` int(11) NOT NULL,
  `subject` varchar(32) NOT NULL,
  `object` varchar(32) NOT NULL,
  `time` int(13) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_rep_log`
--

LOCK TABLES `g0g1_rep_log` WRITE;
/*!40000 ALTER TABLE `g0g1_rep_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `g0g1_rep_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g0g1_rep_rules`
--

DROP TABLE IF EXISTS `g0g1_rep_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g0g1_rep_rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rule_id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `description` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_rep_rules`
--

LOCK TABLES `g0g1_rep_rules` WRITE;
/*!40000 ALTER TABLE `g0g1_rep_rules` DISABLE KEYS */;
INSERT INTO `g0g1_rep_rules` VALUES (1,1,'Accepted Answer','Tutor posted an answer in which was accepted. ');
/*!40000 ALTER TABLE `g0g1_rep_rules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g0g1_report`
--

DROP TABLE IF EXISTS `g0g1_report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g0g1_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_report`
--

LOCK TABLES `g0g1_report` WRITE;
/*!40000 ALTER TABLE `g0g1_report` DISABLE KEYS */;
INSERT INTO `g0g1_report` VALUES (1,1,'User','Members on the site'),(2,2,'Writing','Content submitted by user'),(3,3,'Question','Question posted by another user');
/*!40000 ALTER TABLE `g0g1_report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g0g1_report_log`
--

DROP TABLE IF EXISTS `g0g1_report_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g0g1_report_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state` tinyint(1) NOT NULL,
  `type` int(11) NOT NULL,
  `content_id` int(11) NOT NULL,
  `reporter` int(11) NOT NULL,
  `reason` int(11) NOT NULL,
  `evidence` varchar(512) NOT NULL,
  `comments` varchar(512) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_report_log`
--

LOCK TABLES `g0g1_report_log` WRITE;
/*!40000 ALTER TABLE `g0g1_report_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `g0g1_report_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g0g1_report_reason`
--

DROP TABLE IF EXISTS `g0g1_report_reason`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g0g1_report_reason` (
  `id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `description` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_report_reason`
--

LOCK TABLES `g0g1_report_reason` WRITE;
/*!40000 ALTER TABLE `g0g1_report_reason` DISABLE KEYS */;
INSERT INTO `g0g1_report_reason` VALUES (0,3,'Inappropriate','Content is no suitiable as a mathematics question'),(1,2,'Plagarism','Content is taken directory from a location outside Globe Of Geek without proper citation/credit given '),(2,2,'Misleading','Content is not delivered properly and gives false information that may confuse the user. '),(3,2,'Outdated','Content is no longer updated on the topic is covers and must notify the viewers of this. '),(4,2,'Inappropriate ','Content is just straight up naughty, not for out viewers. '),(5,1,'Inappropriate','Profile contains information not appropriate for the GlobeOfGeek community.'),(6,1,'Impersonation','User is clearly ripping off/copying the identity of someone else to receive personal gain. '),(7,3,'Stupid','The question is completely undefined and/or does nothing more than waste time of a tutor');
/*!40000 ALTER TABLE `g0g1_report_reason` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g0g1_sessions`
--

DROP TABLE IF EXISTS `g0g1_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g0g1_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(26) DEFAULT NULL,
  `type` varchar(32) DEFAULT NULL,
  `ip` varchar(40) DEFAULT NULL,
  `useragent` varchar(100) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `expires` int(14) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=188 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_sessions`
--

LOCK TABLES `g0g1_sessions` WRITE;
/*!40000 ALTER TABLE `g0g1_sessions` DISABLE KEYS */;
INSERT INTO `g0g1_sessions` VALUES (180,'rfsof5nd23hh51f36k95iq3se5','loggedin','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:16.0) Gecko/20100101 Firefox/16.0',1,27,1370636341),(181,'r1q7ggr67guj325me9utsr7mu0','loggedin','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:16.0) Gecko/20100101 Firefox/16.0',0,27,1370636508),(182,'ul75dnq2vk1sgibt9vu054lc56','loggedin','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:16.0) Gecko/20100101 Firefox/16.0',0,27,1370637106),(183,'6k49h2tbe9k3sdmqggjtqj8727','loggedin','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:16.0) Gecko/20100101 Firefox/16.0',0,27,1370637293),(184,'nsksivih6l3uqt4v2jmaptc9l7','loggedin','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:16.0) Gecko/20100101 Firefox/16.0',0,28,1370637322),(185,'sb3esf3gli9m9gn5n90r7knjs2','loggedin','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:16.0) Gecko/20100101 Firefox/16.0',0,27,1370637345),(186,'b97sp2imm3ftbi6g1vicifni46','loggedin','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:16.0) Gecko/20100101 Firefox/16.0',0,32,1370637415),(187,'idnjne41ueub523gf4srbsfsa0','loggedin','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:16.0) Gecko/20100101 Firefox/16.0',0,27,1370637551);
/*!40000 ALTER TABLE `g0g1_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g0g1_user_levels`
--

DROP TABLE IF EXISTS `g0g1_user_levels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g0g1_user_levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_user_levels`
--

LOCK TABLES `g0g1_user_levels` WRITE;
/*!40000 ALTER TABLE `g0g1_user_levels` DISABLE KEYS */;
INSERT INTO `g0g1_user_levels` VALUES (1,0,'Banned','Account is restricted due to moderator decision. '),(2,1,'Public','Account is not registered, visitor access. '),(3,2,'Registered','Account is registered. '),(4,3,'Moderator','Oversees front end activity to ensure a healthy community environment. '),(5,4,'Administrator','Manages backend activity and conducts large scale decisions on site direction'),(6,5,'Owner','Project owner/manager. ');
/*!40000 ALTER TABLE `g0g1_user_levels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g0g1_users`
--

DROP TABLE IF EXISTS `g0g1_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g0g1_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(24) NOT NULL,
  `password` varchar(40) DEFAULT NULL,
  `salt` varchar(32) DEFAULT NULL,
  `points` int(11) NOT NULL,
  `join_date` int(255) NOT NULL,
  `email` varchar(1044) NOT NULL,
  `activate_code` varchar(32) DEFAULT NULL,
  `activated` int(2) NOT NULL,
  `user_level` int(3) NOT NULL DEFAULT '2',
  `avatar_id` int(11) NOT NULL,
  `invited_by` int(11) NOT NULL,
  `invites` int(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  FULLTEXT KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_users`
--

LOCK TABLES `g0g1_users` WRITE;
/*!40000 ALTER TABLE `g0g1_users` DISABLE KEYS */;
INSERT INTO `g0g1_users` VALUES (27,'Kyle','8d424733d7d20e5c0fdb12abbaba0797aaea9e2e','EÙ8æaoY;\0²[Ìò8¡vÂPs6TöuS',-158,1370116850,'apsdiofj@gmail.com',NULL,1,5,6,0,4),(28,'Kyle2','0c571551c7c36e63461f5c01d3c6ee9b8b577d7b','~`=k©&èu°ißü›½0Vö»Em_içãTw',207,1370119294,'asdf@gmail.com',NULL,1,2,1,27,0),(29,'Kyle3','98afe445e7e56b8efb3e2f07883682e69530902f','´Û½4¸£=wý8ÁFûÊ0XOÐ®»L—M$‘ ý’',207,1370121425,'aspdiof@gmail.com',NULL,1,2,1,27,0),(30,'Kyle9','af4fdcbf3e3065fc00d4483705cdef078f410d6a','ÔÖm(bO©1ØÀ¾×æ.GU›¿ê™7opAG',207,1370126728,'aposidjf@gmail.com',NULL,1,2,1,0,0),(31,'Kyle12','8021fe55cd8256f2e90396eaf72b09eac5cc98bb','@rË˜¹Ü0°=ÑÏ ®ö•äÞà-mxMG‰î¦îf/,',207,1370145330,'asdpiofj@gmail.com',NULL,1,2,1,27,0),(32,'John','d12f94fcecc1ad046bce6a3b775038d75699fae0','ï¦ùC¿.RÿH¦Ê}ÍÐÞº… Ðà_ª_ »G4ø%',10,1370637260,'aposidjf@gmail.com',NULL,1,2,1,27,0);
/*!40000 ALTER TABLE `g0g1_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g0g1_writing`
--

DROP TABLE IF EXISTS `g0g1_writing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g0g1_writing` (
  `content_id` int(11) NOT NULL AUTO_INCREMENT,
  `publisher_id` int(11) NOT NULL,
  `created` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(1080) NOT NULL,
  `full_text` mediumtext NOT NULL,
  `category` int(3) NOT NULL DEFAULT '0',
  `tags` varchar(256) NOT NULL,
  `type` int(11) NOT NULL,
  `published` int(1) NOT NULL DEFAULT '0',
  `activated` int(2) NOT NULL DEFAULT '0',
  `earn_type` varchar(11) NOT NULL,
  `reward_amount` int(11) NOT NULL,
  `lock_price` int(11) NOT NULL,
  `unlock_count` int(2) NOT NULL,
  `views` int(11) NOT NULL,
  `access_level` int(2) NOT NULL DEFAULT '2',
  PRIMARY KEY (`content_id`),
  FULLTEXT KEY `title` (`title`,`description`,`full_text`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_writing`
--

LOCK TABLES `g0g1_writing` WRITE;
/*!40000 ALTER TABLE `g0g1_writing` DISABLE KEYS */;
INSERT INTO `g0g1_writing` VALUES (1,0,1359684917,'Content Title','Description Here    ','thisis a testing preview to see just how much content may be displayed at first. As I continue writing I hope to get passed 100 letters in order to truly test the functionality of this awesome php page coded by none other than myself, gog!\r\nthisis a testing preview to see just how much content may be displayed at first. As I continue writing I hope to get passed 100 letters in order to truly test the functionality of this awesome php page coded by none other than myself, gog!\r\nthisis a testing preview to see just how much content may be displayed at first. As I continue writing I hope to get passed 100 letters in order to truly test the functionality of this awesome php page coded by none other than myself, gog!\r\nthisis a testing preview to see just how much content may be displayed at first. As I continue writing I hope to get passed 100 letters in order to truly test the functionality of this awesome php page coded by none other than myself, gog!thisis a testing preview to see just how much content may be displayed at first. As I continue writing I hope to get passed 100 letters in order to truly test the functionality of this awesome php page coded by none other than myself, gog!\r\nthisis a testing preview to see just how much content may be displayed at first. As I continue writing I hope to get passed 100 letters in order to truly test the functionality of this awesome php page coded by none other than myself, gog!\r\nthisis a testing preview to see just how much content may be displayed at first. As I continue writing I hope to get passed 100 letters in order to truly test the functionality of this awesome php page coded by none other than myself, gog!\r\nthisis a testing preview to see just how much content may be displayed at first. As I continue writing I hope to get passed 100 letters in order to truly test the functionality of this awesome php page coded by none other than myself, gog!',5,'',6,1,1,'ppu',0,125,4,20,1),(2,7,1359739382,'Content Title','Description Here    ','Content Here    ',3,'',3,1,1,'ppu',123,125,2,7,1),(3,7,1362098521,'test','<b>    ','<b>test</b>',5,'',3,1,1,'ppu',0,5,1,22,1),(4,7,1362100827,'Content Title','Description Here    ','<b>haxlol</b>    ',1,'',1,1,1,'pps',2,21,0,15,1),(5,7,1362101497,'Content Title','Description Here    ','<;iajsdf\'\'km;asdf,mas;\'m\';mq<br>br<.mfd.<haxk    ',1,'',1,1,1,'pps',21,21,0,11,2),(6,7,1362101627,'\",br>\'as;df\"','\":DSJDescription Here    ','\':LZJKs    ',5,'',7,1,1,'pps',21,21,0,2,2),(7,7,1362102615,'\'/>test<br>bkfajs','\'/>test    ','test    ',1,'',1,1,1,'pps',21,0,0,7,2),(8,7,1362613256,'Content Title','Description Here','',0,'',0,0,0,'pps',0,0,0,0,2),(9,7,1362613315,'Content Title','Description Here','',0,'',0,0,0,'ppu',0,5,0,0,2);
/*!40000 ALTER TABLE `g0g1_writing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g0g1_writing_type`
--

DROP TABLE IF EXISTS `g0g1_writing_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g0g1_writing_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_writing_type`
--

LOCK TABLES `g0g1_writing_type` WRITE;
/*!40000 ALTER TABLE `g0g1_writing_type` DISABLE KEYS */;
INSERT INTO `g0g1_writing_type` VALUES (1,1,'Essay',''),(2,2,'Response',''),(3,3,'Report',''),(4,4,'Review',''),(5,5,'Story',''),(6,6,'Tutorial',''),(7,7,'Other','');
/*!40000 ALTER TABLE `g0g1_writing_type` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-06-07 15:55:04

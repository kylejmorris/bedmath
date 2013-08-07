-- MySQL dump 10.13  Distrib 5.5.31, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: bedmath
-- ------------------------------------------------------
-- Server version	5.5.31-0ubuntu0.13.04.1

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
  `published` tinyint(1) NOT NULL,
  `accepted` tinyint(1) NOT NULL,
  `activated` tinyint(1) DEFAULT '1',
  `edit_time` int(13) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_answers`
--

LOCK TABLES `g0g1_answers` WRITE;
/*!40000 ALTER TABLE `g0g1_answers` DISABLE KEYS */;
INSERT INTO `g0g1_answers` VALUES (4,19,2,'<p>I have discovered a truly marvelous proof of this, which this answer&nbsp;is too narrow to contain.</p>',1375902737,1,0,1,0);
/*!40000 ALTER TABLE `g0g1_answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g0g1_answers_log`
--

DROP TABLE IF EXISTS `g0g1_answers_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g0g1_answers_log` (
  `id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  `full_text` varchar(5012) DEFAULT NULL,
  `time` int(13) DEFAULT NULL,
  `published` tinyint(1) DEFAULT NULL,
  `accepted` tinyint(1) DEFAULT NULL,
  `version` int(11) DEFAULT NULL,
  `edit_time` int(13) DEFAULT NULL,
  `activated` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_answers_log`
--

LOCK TABLES `g0g1_answers_log` WRITE;
/*!40000 ALTER TABLE `g0g1_answers_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `g0g1_answers_log` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_locking`
--

LOCK TABLES `g0g1_locking` WRITE;
/*!40000 ALTER TABLE `g0g1_locking` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_mail`
--

LOCK TABLES `g0g1_mail` WRITE;
/*!40000 ALTER TABLE `g0g1_mail` DISABLE KEYS */;
INSERT INTO `g0g1_mail` VALUES (1,1,'Hello [USERNAME], this is a default testing message using the GlobeOfGeek mailing system. Hopefully you received a message! ',''),(2,2,'Hello there [USERNAME] you currently have [CURRENT_POINTS] points on the site! We suggest you get your butt back on there and earn more!','You have points with GlobeOfGeek!'),(4,4,'This is an account recovery sent from GlobeOfGeek.com, if you are trying to recover lost account settings then follow the link: www.globeofgeek.com/recover/validate/[USER_ID]/[EMAIL_RECOVERY_CODE]','Account Recovery'),(5,3,'Hey [USERNAME], this is a notification clarifying that your redeem request has been accepted! This means that you will receive payment during the next cash out, which will take place within 48 hours. Thanks for your support on Bedmath, pal!','Redeem Request Accepted! Awaiting payout'),(6,5,'Hello [USERNAME], this is a notification stating that your redeem request has been denied during the review process. Please check over your account standing and make sure you meet the checks. Once your account meets the site requirments you may send another redeem request. Thanks for understanding, we hope everything works out smoothly! If you have any questions feel free to contact us or leave a report if you think this was an error.','Redeem Request Denied: Please check your account standing'),(7,6,'You have been invited to Bedmath: an online platform that lets students get help in math quickly, and for a price that is actually realistic! But wait up, if you happen to be good with mathematics, you can also be a tutor! Being a tutor lets you answer questions posted by others and get paid. Come take a look, it seems you have got some friends waiting for you pal.','You have been invited to Bedmath'),(8,7,'This is an activation request for your Bedmath account. Please follow the link below to confirm this email. Thankyou. http://bedmath.com/activate/validate/[USER_ID]/[EMAIL_RECOVERY_CODE]/','Activate Your Bedmath Account');
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
  `default_id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `receiver_email` varchar(1080) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8;
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
INSERT INTO `g0g1_points` VALUES (1,1,'System Reward','Points rewarded by system.'),(2,2,'System Deduction','Points removed by system.'),(6,6,'Points Purchase','User successfully purchased points!'),(7,7,'Donation Sent','Sent points to another user.'),(8,8,'Donation Received','Received points from another user. '),(9,9,'New User','User obtained some free points for successfully creating an account!'),(10,10,'Successful Invite','Influenced 1 new user to join the site!'),(11,11,'Answered Question','Tutor has been selected for their support on a question and receives the bid'),(12,12,'Asked Question','User asked question and places bid');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_points_log`
--

LOCK TABLES `g0g1_points_log` WRITE;
/*!40000 ALTER TABLE `g0g1_points_log` DISABLE KEYS */;
INSERT INTO `g0g1_points_log` VALUES (2,12,1,0,-10,1375902657);
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
  `activated` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_questions`
--

LOCK TABLES `g0g1_questions` WRITE;
/*!40000 ALTER TABLE `g0g1_questions` DISABLE KEYS */;
INSERT INTO `g0g1_questions` VALUES (19,1,'Interesting Question','<p>I heard that [math]a^n+b^n=c^n[/math] cannot be satisfied when n is a real value greater than 2. How could I prove this though?&nbsp;</p>',10,1,0,1375902657,1,1);
/*!40000 ALTER TABLE `g0g1_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g0g1_questions_log`
--

DROP TABLE IF EXISTS `g0g1_questions_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g0g1_questions_log` (
  `question_id` int(11) NOT NULL DEFAULT '0',
  `topic` int(3) DEFAULT NULL,
  `title` varchar(64) DEFAULT NULL,
  `full` varchar(1024) DEFAULT NULL,
  `bid` int(11) DEFAULT NULL,
  `asked_by` int(11) DEFAULT NULL,
  `answer` int(11) DEFAULT NULL,
  `asked_time` int(11) DEFAULT NULL,
  `published` tinyint(1) DEFAULT NULL,
  `version` int(11) DEFAULT NULL,
  `edit_time` int(11) DEFAULT NULL,
  `activated` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_questions_log`
--

LOCK TABLES `g0g1_questions_log` WRITE;
/*!40000 ALTER TABLE `g0g1_questions_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `g0g1_questions_log` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_redeem`
--

LOCK TABLES `g0g1_redeem` WRITE;
/*!40000 ALTER TABLE `g0g1_redeem` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
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
-- Table structure for table `g0g1_replies`
--

DROP TABLE IF EXISTS `g0g1_replies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g0g1_replies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `answer_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `full_text` varchar(5012) DEFAULT NULL,
  `time` int(13) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_replies`
--

LOCK TABLES `g0g1_replies` WRITE;
/*!40000 ALTER TABLE `g0g1_replies` DISABLE KEYS */;
INSERT INTO `g0g1_replies` VALUES (10,4,1,'Yeah, well I don\'t have 300 years to wait. My test is tomorrow!',1375902757,19);
/*!40000 ALTER TABLE `g0g1_replies` ENABLE KEYS */;
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
  `state` varchar(32) DEFAULT NULL,
  `type` int(11) NOT NULL,
  `content_id` int(11) NOT NULL,
  `reporter` int(11) NOT NULL,
  `reason` int(11) NOT NULL,
  `evidence` varchar(512) NOT NULL,
  `comments` varchar(512) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
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
) ENGINE=InnoDB AUTO_INCREMENT=210 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_sessions`
--

LOCK TABLES `g0g1_sessions` WRITE;
/*!40000 ALTER TABLE `g0g1_sessions` DISABLE KEYS */;
INSERT INTO `g0g1_sessions` VALUES (207,'hfjfj0gp4g33p453lgp7jovq12','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,1,1375902784),(208,'kcoea101autdcgado5ps4u17l2','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,2,1375902860),(209,'c95679ts6s773fdgr85fla06o7','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',1,1,1375902886);
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
  `activated` int(2) NOT NULL DEFAULT '0',
  `user_level` int(3) NOT NULL DEFAULT '2',
  `avatar_id` int(11) NOT NULL,
  `invited_by` int(11) NOT NULL,
  `invites` int(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  FULLTEXT KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_users`
--

LOCK TABLES `g0g1_users` WRITE;
/*!40000 ALTER TABLE `g0g1_users` DISABLE KEYS */;
INSERT INTO `g0g1_users` VALUES (1,'Kyle','c533a50579588339035a5701e456a85a62ec941d','ãW™RQ5ðáí\0õ	^íM7÷uV­¨Q\0?žøM',20,1374261996,'greyeverest@gmail.com','1d3dc6c5a164e38f5b6b2115a30cc1ef',0,5,1,0,5),(2,'Keith','72f89e3e2244f4f7b23399675a955e013c563fcd','¤=. q¤Ñ!½nBæ®cbÎ¡Ù†µ’ažÿH¬œ',-171,1374262020,'paosidjf@gmail.com','c6d6b70f06fdcee31d685b2be01b1a79',0,4,1,1,0),(3,'Ethan','310b47e0b5af4643837a55dc6ade44fe0bf32400','Æñœ‡‘Çºƒ\n\r¿@\'~]> Õ}«òÍ¦ekáÈK™Ú',-171,1374262031,'paosidjf@gmail.com','f0bffc75466a5c6991fe7bda1d5b85d5',0,3,1,1,0),(4,'Juriaan','de145c12778bfac317285b380ac8b51f918c9ef4','kŸÍ2k6YÛ\0¾ê³!ý—eÌVZË)xíô¨„M[¯Ú?',-171,1374262043,'apsiodjfa@gmail.com',NULL,0,2,1,1,0),(5,'Kyle2','2d69971cafa812010bfb8b2b67931b54d3ccf7d4','‡¸j‚œ`\0¡4Õk.³{¹G8rI\0Û0: <ßE\rü7',-171,1375140899,'est@gmail.com',NULL,1,2,1,0,0),(6,'Jur','4797e11d798a152e748124f2eaf2e86c08ddeb3a','CC×`^ç¬\0SRÇN.#£@Y_/ò)£˜y4Ë2†',-171,1375140931,'veli-juri@hotmail.nl',NULL,1,2,1,1,0),(7,'tasdpfoij','21150bda497d58b7dc5f8357570285755c05c2e4','ñÌyY9fûÃ±Ö>iŽ:\Z¥v¹Œ‡ –êaóFÏ¬',-171,1375141398,'test@edu.hooghelandt.nl',NULL,1,2,1,0,0),(8,'Johnny','0d5ac106ec2507ce2560011805e5a6a9f8920a08','®Ý£WBB€›×\nA{MÝ¨(ŠLîiàëXª~!;Þ',-45,1375423494,'aposidjf@gmail.com',NULL,1,2,1,1,0);
/*!40000 ALTER TABLE `g0g1_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-08-07 14:13:40

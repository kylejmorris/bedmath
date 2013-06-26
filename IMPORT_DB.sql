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
  `votes` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL,
  `accepted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_answers`
--

LOCK TABLES `g0g1_answers` WRITE;
/*!40000 ALTER TABLE `g0g1_answers` DISABLE KEYS */;
INSERT INTO `g0g1_answers` VALUES (26,152,27,'this is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololo',1372215164,0,0,0),(27,153,27,'this is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololo',1372215169,0,0,0),(28,154,27,'this is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololothis is now edited lolololo',1372215175,0,0,0);
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
  `edit_time` int(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_answers_log`
--

LOCK TABLES `g0g1_answers_log` WRITE;
/*!40000 ALTER TABLE `g0g1_answers_log` DISABLE KEYS */;
INSERT INTO `g0g1_answers_log` VALUES (26,152,27,'NEWNEWNEWNEWNEWNEWNEWNEWNEWNEWNEWNEWNEWNEWNEWNEWNEWNEWNEWNEWNEWNEWNEWNEWNEWNEWNEWNEWNEWNEWNEWNEWNEWNEWNEWNEWNEWNEWNEWNEW',1372215164,1,NULL,1,1372272260),(26,152,27,'aosidjfaosidjfaosidjfaosidjfaosidjfaosidjfaosidjfaosidjfaosidjfaosidjfaosidjfaosidjfaosidjfaosidjfaosidjfaosidjfaosidjfaosidjfaosidjfaosidjfaosidjfaosidjfaosidjfaosidjfaosidjfaosidjfaosidjfaosidjfaosidjfaosidjfaosidjfaosidjfaosidjfaosidjfv',1372215164,0,NULL,2,1372272275),(27,153,27,'ANOTHER EDITANOTHER EDITANOTHER EDITANOTHER EDITANOTHER EDITANOTHER EDITANOTHER EDITANOTHER EDITANOTHER EDITANOTHER EDITANOTHER EDITANOTHER EDITANOTHER EDITANOTHER EDITANOTHER EDITANOTHER EDITANOTHER EDITANOTHER EDITANOTHER EDITANOTHER EDITANOTHER EDITANOTHER EDITANOTHER EDITANOTHER EDITANOTHER EDIT',1372215169,1,NULL,1,1372272564);
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
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_points_log`
--

LOCK TABLES `g0g1_points_log` WRITE;
/*!40000 ALTER TABLE `g0g1_points_log` DISABLE KEYS */;
INSERT INTO `g0g1_points_log` VALUES (72,12,NULL,0,-200,1370637125),(73,12,27,0,-205,1370637153),(74,10,27,0,25,1370637260),(75,9,32,0,10,1370637260),(76,12,27,0,-185,1370637428),(77,12,27,0,-51,1371235404),(78,10,27,0,25,1371239429),(79,9,33,0,10,1371239429),(80,10,27,0,25,1371411449),(81,9,34,0,10,1371411449),(82,11,32,27,205,1371413715),(83,11,33,27,185,1371420416),(84,11,33,27,51,1371420425),(85,12,27,0,-512,1371424069),(86,12,27,0,-166,1371424075),(87,12,27,0,-111,1371424081),(88,12,27,0,-125,1371424092),(89,11,28,27,125,1371424122),(90,11,28,27,111,1371424127),(91,11,28,27,166,1371424132),(92,11,28,27,512,1371424135),(93,11,28,27,828,1371843362),(94,12,27,0,-555,1372193654);
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
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_questions`
--

LOCK TABLES `g0g1_questions` WRITE;
/*!40000 ALTER TABLE `g0g1_questions` DISABLE KEYS */;
INSERT INTO `g0g1_questions` VALUES (144,3,'DEFAULT TITLE','',840,31,0,1372196938,1),(145,3,'DEFAULT TITLE','',268,29,0,1372196938,1),(146,3,'DEFAULT TITLE','',674,28,0,1372196938,1),(147,3,'DEFAULT TITLE','',411,34,0,1372196938,1),(148,3,'DEFAULT TITLE','',110,30,0,1372196938,1),(149,3,'DEFAULT TITLE','',98,27,0,1372196938,1),(150,3,'DEFAULT TITLE','',1220,33,0,1372196938,1),(151,3,'DEFAULT TITLE','',938,28,0,1372196938,1),(152,3,'DEFAULT TITLE','',671,28,0,1372196939,1),(153,3,'DEFAULT TITLE','',263,31,0,1372196939,1),(154,3,'DEFAULT TITLE','',1191,29,0,1372196939,1),(155,3,'DEFAULT TITLE','',89,31,0,1372196939,1),(156,3,'DEFAULT TITLE','',1110,28,0,1372196939,1),(157,4,'DEFAULT TITLE','fasdfasdf',287,27,0,1372196939,1),(158,2,'DEFAULT TITLE','THIS IS EDITED',1207,27,0,1372196939,1),(159,3,'DEFAULT TITLE','',332,31,0,1372196939,1),(160,3,'DEFAULT TITLE','',596,34,0,1372196939,1),(161,3,'DEFAULT TITLE','',347,28,0,1372196939,1),(162,3,'DEFAULT TITLE','',870,31,0,1372196939,1),(163,3,'DEFAULT TITLE','',556,29,0,1372196939,1);
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
  `edit_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_questions_log`
--

LOCK TABLES `g0g1_questions_log` WRITE;
/*!40000 ALTER TABLE `g0g1_questions_log` DISABLE KEYS */;
INSERT INTO `g0g1_questions_log` VALUES (157,4,'another update','UPDATE 2',287,27,0,1372196939,0,1,1372197980),(157,4,'another update','PUBLISHED NOW',287,27,0,1372196939,1,2,1372198005),(158,3,'New title','new text111',1208,27,0,1372196939,1,1,1372213360),(158,3,'DEFAULT TITLE','new text111',1208,27,0,1372196939,0,2,1372270881);
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_rep_log`
--

LOCK TABLES `g0g1_rep_log` WRITE;
/*!40000 ALTER TABLE `g0g1_rep_log` DISABLE KEYS */;
INSERT INTO `g0g1_rep_log` VALUES (1,1,3,'32','27',1371413716,1,1),(2,1,3,'33','27',1371420416,1,1),(3,1,2,'33','27',1371420425,1,1),(4,1,1,'28','27',1371424122,1,1),(5,1,5,'28','27',1371424127,1,1),(6,1,4,'28','27',1371424132,1,1),(7,1,2,'28','27',1371424136,1,1),(8,1,3,'28','27',1371843362,1,1);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
) ENGINE=InnoDB AUTO_INCREMENT=247 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_sessions`
--

LOCK TABLES `g0g1_sessions` WRITE;
/*!40000 ALTER TABLE `g0g1_sessions` DISABLE KEYS */;
INSERT INTO `g0g1_sessions` VALUES (180,'rfsof5nd23hh51f36k95iq3se5','loggedin','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:16.0) Gecko/20100101 Firefox/16.0',1,27,1370636341),(181,'r1q7ggr67guj325me9utsr7mu0','loggedin','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:16.0) Gecko/20100101 Firefox/16.0',0,27,1370636508),(182,'ul75dnq2vk1sgibt9vu054lc56','loggedin','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:16.0) Gecko/20100101 Firefox/16.0',0,27,1370637106),(183,'6k49h2tbe9k3sdmqggjtqj8727','loggedin','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:16.0) Gecko/20100101 Firefox/16.0',0,27,1370637293),(184,'nsksivih6l3uqt4v2jmaptc9l7','loggedin','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:16.0) Gecko/20100101 Firefox/16.0',0,28,1370637322),(185,'sb3esf3gli9m9gn5n90r7knjs2','loggedin','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:16.0) Gecko/20100101 Firefox/16.0',0,27,1370637345),(186,'b97sp2imm3ftbi6g1vicifni46','loggedin','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:16.0) Gecko/20100101 Firefox/16.0',0,32,1370637415),(187,'idnjne41ueub523gf4srbsfsa0','loggedin','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:16.0) Gecko/20100101 Firefox/16.0',0,27,1370637551),(188,'6c7vvegsbg0jtmpbu6d2oahqi3','loggedin','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:20.0) Gecko/20100101 Firefox/20.0',0,27,1371074667),(189,'bntjqudbo052k0k6tqu1lj4mh0','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1371143431),(190,'8k79pfcc713v5oksarg3ri9ib5','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1371144111),(191,'nvcoolvhtdlmfldammkil9mfl1','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1371228730),(192,'u3lcjfocstlocke31a1jakdal4','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1371235603),(193,'nmbmmeekqub0t2b414l41d6b52','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1371239526),(194,'jp28grssp6l695ga55iue016m7','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,33,1371239597),(195,'mu8f1pk24aiod1dkts8g2smr34','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1371241575),(196,'a1n5i1sg534tpcsbd1nttkm9d7','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1371253087),(197,'94m0gv1qimfvpn7npo1dl7o197','loggedin','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:20.0) Gecko/20100101 Firefox/20.0',1,27,1371339207),(198,'07vls2n985jo6q8jgf6kqrvfd0','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,34,1371411571),(199,'702m6o422hhr4ph0rviovg1h13','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1371413847),(200,'c28aqim7seu1sciieibuskho82','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1371420571),(201,'l8t7nmlbvg95nah3908m9gho54','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1371424043),(202,'80338c1074adm24ieotcpbi7r3','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,28,1371424164),(203,'h91boerr9jcn4ja1oea51hd0b2','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1371424213),(204,'oiohu1hk4ckpfhuaia1a2t0164','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,28,1371424233),(205,'4vden2fqh3u5u22hn1uqv36m04','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1371424403),(206,'0n1kknos6f1lisbtgti1hg6gg6','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1371428623),(207,'6mvib0q39qv8paadl4m03o73q5','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1371429170),(208,'5ip5aemccq5f43gb9s3jn0rif0','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1371429832),(209,'4cuk884l95i9ne6tuu9nnlgul7','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1371432143),(210,'4cuk884l95i9ne6tuu9nnlgul7','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1371439028),(211,'cj8fd74ng932j4279381uejj42','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1371440484),(212,'ij4dln08jb0p5nicveob67p317','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1371442065),(213,'ij4dln08jb0p5nicveob67p317','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1371452440),(214,'v3s61fu5tul1tl27qj4e30uro3','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1371494036),(215,'du848tasnbc3gaovofnochd9h1','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1371494344),(216,'vs0j1iutnn664oi08e4b0bbtq5','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1371503055),(217,'pe3d6pn2gjpuoquevt3p5m1e92','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,28,1371503072),(218,'r8kiku8mbe6dsfs279j79d20s0','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1371506191),(219,'rmiluqftu80b1oflcn3mcreef5','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1371667094),(220,'ksesu3ej793d6hba0a8446cem6','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,28,1371843459),(221,'tlsla8m3ubscn3nqvh0mevl4b0','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1371843512),(222,'ivarvlu3qid4t9cr2igs5qts50','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1372024417),(223,'sofs54en8q07qjo7060p0m0qt4','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1372027497),(224,'0jktpmki32amjs2r2m72os9p55','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1372102050),(225,'0o9nq958b40eklpbhs1sm9ppl1','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',1,27,1372112141),(226,'5qgufijm52495a1hlkua8l4pt3','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1372191153),(227,'oo5uurpgv1nsckikvcu99f4tn2','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1372191914),(228,'a1hi3fqj48cdqq2003ne4uigl6','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1372194491),(229,'b4ft65vk5fp69obii9djpiv7e1','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1372194664),(230,'lta3dbr5eq6qm6vf4kr6offbn2','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1372195762),(231,'u6j1t069t7ri3akn71no367fg4','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1372196366),(232,'sekq09pcploatd1iihhku21o26','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1372197281),(233,'3497kg8mk5ommv29u4i4la5jd1','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1372197796),(234,'ann4k9296vhchpc37fl25fvnt0','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1372198214),(235,'uosmpd74kn381bvoaauplk1g60','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1372198419),(236,'6kl5g98ucnsv0fp5uibe5itai0','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1372198950),(237,'6kl5g98ucnsv0fp5uibe5itai0','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1372202904),(238,'p6qg5e5t258arosh4sp3uhcg54','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1372203030),(239,'ct9k1m6qrrij081o6c9hl43od7','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1372213206),(240,'eg611cln83b3fnd5f0qf1d21d0','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1372213610),(241,'1bnst0jbdiut0271bob51kv295','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1372213911),(242,'t0indk7tt1ks1k4jptjqdc35v2','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1372233609),(243,'t0indk7tt1ks1k4jptjqdc35v2','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1372243680),(244,'lcmghr8t0b2jc45m2nrbm1q6l6','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1372243707),(245,'lcmghr8t0b2jc45m2nrbm1q6l6','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',0,27,1372278545),(246,'eujfq779gdh7uioc78nth510a0','loggedin','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/5',1,27,1372282670);
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
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g0g1_users`
--

LOCK TABLES `g0g1_users` WRITE;
/*!40000 ALTER TABLE `g0g1_users` DISABLE KEYS */;
INSERT INTO `g0g1_users` VALUES (27,'Kyle','8d424733d7d20e5c0fdb12abbaba0797aaea9e2e','EÙ8æaoY;\0²[Ìò8¡vÂPs6TöuS',-1628,1370116850,'apsdiofj@gmail.com',NULL,1,5,6,0,6),(28,'Kyle2','0c571551c7c36e63461f5c01d3c6ee9b8b577d7b','~`=k©&èu°ißü›½0Vö»Em_içãTw',1949,1370119294,'asdf@gmail.com',NULL,1,2,1,27,0),(29,'Kyle3','98afe445e7e56b8efb3e2f07883682e69530902f','´Û½4¸£=wý8ÁFûÊ0XOÐ®»L—M$‘ ý’',207,1370121425,'aspdiof@gmail.com',NULL,1,2,1,27,0),(30,'Kyle9','af4fdcbf3e3065fc00d4483705cdef078f410d6a','ÔÖm(bO©1ØÀ¾×æ.GU›¿ê™7opAG',207,1370126728,'aposidjf@gmail.com',NULL,1,2,1,0,0),(31,'Kyle12','8021fe55cd8256f2e90396eaf72b09eac5cc98bb','@rË˜¹Ü0°=ÑÏ ®ö•äÞà-mxMG‰î¦îf/,',207,1370145330,'asdpiofj@gmail.com',NULL,1,2,1,27,0),(32,'John','d12f94fcecc1ad046bce6a3b775038d75699fae0','ï¦ùC¿.RÿH¦Ê}ÍÐÞº… Ðà_ª_ »G4ø%',215,1370637260,'aposidjf@gmail.com',NULL,1,2,1,27,0),(33,'wooohoo','6f71e06d774a80ba9f9b5a162d927fd9a5a133ce','å˜(61AËó>YPsºÉ4¦šúX.2ªPoZ¸',246,1371239428,'aposidf@gmail.com',NULL,1,2,1,27,0),(34,'Bobbeh','e98918dbadf1e76b07058f439ac321ef2d5c9b13','G;ñtxTÀ<¡–Lc‰UÓ`ÕÝîªöÖnZµ•çsÞ',10,1371411448,'apsodifj@gmail.com',NULL,1,2,1,27,0);
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

-- Dump completed on 2013-06-26 13:53:10

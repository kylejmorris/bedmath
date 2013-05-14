-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 11, 2013 at 01:21 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bedmath`
--

-- --------------------------------------------------------

--
-- Table structure for table `g0g1_answers`
--

CREATE TABLE IF NOT EXISTS `g0g1_answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `full_text` varchar(5012) NOT NULL,
  `time` int(13) NOT NULL,
  `votes` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL,
  `accepted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `g0g1_answers`
--

INSERT INTO `g0g1_answers` (`id`, `question_id`, `user`, `full_text`, `time`, `votes`, `published`, `accepted`) VALUES
(31, 20, 6, 'The "A^2 + B^2 = C^2" that you are thinking of is only for right triangles. If you know an angle (such as C) tangent to the side in question, you can then use the cosine law which looks like this: c^2 = a^2 + b^2 - 2ab cos(C).\r\n\r\nHope this helps, let me know if you have any further concerns on this topic!', 1367510416, 0, 1, 0),
(32, 21, 5, 'Hey. Sounds like you are talking about "chords". If you draw a perpendicular line through the midpoint, it will be tangent to the center! Pretty cool huh?', 1367510628, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `g0g1_bans`
--

CREATE TABLE IF NOT EXISTS `g0g1_bans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` int(14) NOT NULL,
  `expires` int(11) NOT NULL,
  `comments` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `g0g1_bans`
--

INSERT INTO `g0g1_bans` (`id`, `user_id`, `created_by`, `created_time`, `expires`, `comments`) VALUES
(1, 9, 7, 1367509989, 1367769189, 'You have posed as a threat to healthy economy.');

-- --------------------------------------------------------

--
-- Table structure for table `g0g1_category`
--

CREATE TABLE IF NOT EXISTS `g0g1_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `g0g1_category`
--

INSERT INTO `g0g1_category` (`id`, `order`, `cat_id`, `name`) VALUES
(3, 1, 1, 'Arithmetic'),
(4, 2, 2, 'Geometry'),
(5, 3, 3, 'Algebra'),
(6, 4, 4, 'Trigonometry'),
(7, 5, 5, 'Calculus');

-- --------------------------------------------------------

--
-- Table structure for table `g0g1_image`
--

CREATE TABLE IF NOT EXISTS `g0g1_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(2) NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `g0g1_image`
--

INSERT INTO `g0g1_image` (`id`, `type_id`, `name`, `description`) VALUES
(1, 1, 'placeholder', 'Used as a filler for image locations with nothing placed.'),
(2, 2, 'writing-thumbnail', 'Little thumbnail image associated with written content. Displays as a preview. '),
(3, 3, 'avatar', 'Profile image identifying user');

-- --------------------------------------------------------

--
-- Table structure for table `g0g1_image_log`
--

CREATE TABLE IF NOT EXISTS `g0g1_image_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` int(2) NOT NULL,
  `content_id` int(11) NOT NULL,
  `order` int(3) NOT NULL,
  `image_name` varchar(50) NOT NULL,
  `file_type` varchar(31) NOT NULL,
  `upload_time` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=766 ;

--
-- Dumping data for table `g0g1_image_log`
--

INSERT INTO `g0g1_image_log` (`id`, `user_id`, `type`, `content_id`, `order`, `image_name`, `file_type`, `upload_time`) VALUES
(725, 0, 3, 7, 1, '128', 'jpg', '51235'),
(723, 0, 3, 5, 1, '1612', 'png', '587125'),
(721, 0, 3, 4, 1, '6125612', 'jpg', '1512'),
(724, 0, 3, 6, 1, '189712', 'png', '509182'),
(716, 0, 3, 1, 1, '15125', 'png', '12512'),
(720, 0, 3, 3, 1, '2372', 'png', '12512'),
(719, 0, 3, 2, 1, '1612', 'jpg', '5125125'),
(758, 15, 2, 3, 0, '1362098521494', '', '1362098521'),
(759, 15, 2, 4, 0, '136210082780', '', '1362100827'),
(760, 15, 2, 0, 0, '136210130014', '', '1362101300'),
(761, 15, 2, 5, 0, '1362101497608', '', '1362101497'),
(762, 15, 2, 6, 0, '1362101627228', '', '1362101627'),
(763, 15, 2, 7, 0, '1362102615654', '', '1362102615'),
(764, 15, 2, 8, 0, '1362613256988', '', '1362613256'),
(765, 15, 2, 9, 0, '1362613315415', '', '1362613315');

-- --------------------------------------------------------

--
-- Table structure for table `g0g1_locking`
--

CREATE TABLE IF NOT EXISTS `g0g1_locking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_id` int(11) NOT NULL,
  `unlocked_by` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `g0g1_locking`
--

INSERT INTO `g0g1_locking` (`id`, `content_id`, `unlocked_by`, `time`) VALUES
(1, 3, 7, 1362098555);

-- --------------------------------------------------------

--
-- Table structure for table `g0g1_mail`
--

CREATE TABLE IF NOT EXISTS `g0g1_mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail_id` int(11) NOT NULL,
  `content` varchar(1080) NOT NULL,
  `subject` varchar(320) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `g0g1_mail`
--

INSERT INTO `g0g1_mail` (`id`, `mail_id`, `content`, `subject`) VALUES
(1, 1, 'Hello [USERNAME], this is a default testing message using the GlobeOfGeek mailing system. Hopefully you received a message! ', ''),
(2, 2, 'Hello there [USERNAME] you currently have [CURRENT_POINTS] points on the site! We suggest you get your butt back on there and earn more!', 'You have points with GlobeOfGeek!'),
(3, 3, 'Hello there! You have been invited to GlobeOfGeek, a platform in which pays you to submit and share content you''ve created! This could be writing done in school, a story written during free time, or more! GlobeOfGeek wishes to combine ''work'' with the act of learning, so that you can develop further knowledge while making some cash online! Come take a look by clicking the link below, we welcome you to the community pal! globeofgeek.com/register/r/[USERNAME]', 'You have been invited to GlobeOfGeek.'),
(4, 4, 'This is an account recovery sent from GlobeOfGeek.com, if you are trying to recover lost account settings then follow the link: www.globeofgeek.com/recover/validate/[USER_ID]/[EMAIL_RECOVERY_CODE]', 'Account Recovery');

-- --------------------------------------------------------

--
-- Table structure for table `g0g1_mail_log`
--

CREATE TABLE IF NOT EXISTS `g0g1_mail_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(32) NOT NULL,
  `default_id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `receiver_email` varchar(1080) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `g0g1_mail_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `g0g1_points`
--

CREATE TABLE IF NOT EXISTS `g0g1_points` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `g0g1_points`
--

INSERT INTO `g0g1_points` (`id`, `type_id`, `name`, `description`) VALUES
(1, 1, 'System Reward', 'Points rewarded by system.'),
(2, 2, 'System Deduction', 'Points removed by system.'),
(3, 3, 'PPS Reward', 'Content submitted as PayPerSubmit was accepted. '),
(4, 4, 'PPU Reward', 'PPU content was unlocked by another user. '),
(5, 5, 'PPU Deduction', 'Unlocked PPU content'),
(6, 6, 'Points Purchase', 'User successfully purchased points!'),
(7, 7, 'Donation Sent', 'Sent points to another user.'),
(8, 8, 'Donation Received', 'Received points from another user. '),
(9, 9, 'New User', 'User obtained some free points for successfully creating an account!'),
(10, 10, 'Successful Invite', 'Influenced 1 new user to join the site!');

-- --------------------------------------------------------

--
-- Table structure for table `g0g1_points_log`
--

CREATE TABLE IF NOT EXISTS `g0g1_points_log` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_type` int(11) NOT NULL,
  `subject` int(11) DEFAULT NULL,
  `object` int(11) DEFAULT NULL,
  `points` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `g0g1_points_log`
--

INSERT INTO `g0g1_points_log` (`transaction_id`, `transaction_type`, `subject`, `object`, `points`, `time`) VALUES
(1, 5, 7, 7, -5, 1362098555),
(2, 4, 7, 7, 4, 1362098555),
(3, 3, 7, 0, 2, 1362100836),
(4, 7, 7, 1, -512, 1362109391),
(5, 8, 1, 7, 461, 1362109391),
(6, 7, 7, 1, -1, 1362612849),
(7, 8, 1, 7, 1, 1362612849),
(8, 7, 7, 1, -2, 1365721329),
(9, 8, 1, 7, 2, 1365721329),
(10, 2, 1, 0, -616, 1367270999),
(11, 1, 1, 0, 1699, 1367271016),
(12, 2, 1, 0, -2932, 1367271023),
(13, 1, 1, 0, 2932, 1367271028),
(14, 2, 1, 0, -2939, 1367271036),
(15, 1, 1, 0, 2946, 1367271040),
(16, 2, 1, 0, -2946, 1367271045),
(17, 1, 1, 0, 2946, 1367271050),
(18, 1, 7, 0, 1, 1367271061),
(19, 1, 7, 0, 183, 1367271075),
(20, 1, 7, 0, 996816, 1367271083),
(21, 1, 2, 0, 50, 1367271121),
(22, 2, 2, 0, -103, 1367271160),
(23, 2, 5, 0, -17, 1367271169),
(24, 7, 7, 3, -51, 1367375845),
(25, 8, 3, 7, 46, 1367375845),
(26, 7, 7, 3, -512, 1367376063),
(27, 8, 3, 7, 461, 1367376063),
(28, 10, 7, 0, 25, 1367507797),
(29, 9, 8, 0, 10, 1367507797),
(30, 10, 7, 0, 25, 1367510908),
(31, 10, 7, 0, 25, 1367510925),
(32, 9, 10, 0, 10, 1367510925),
(33, 10, 7, 0, 25, 1367518635),
(34, 9, 11, 0, 10, 1367518636),
(35, 10, 7, 0, 25, 1367519599),
(36, 9, 12, 0, 10, 1367519599),
(37, 10, 7, 0, 25, 1367520617),
(38, 9, 13, 0, 10, 1367520617),
(39, 7, 13, 7, -5, 1367520771),
(40, 8, 7, 13, 5, 1367520771),
(41, 10, 7, 0, 25, 1367521328),
(42, 9, 14, 0, 10, 1367521328),
(43, 10, 7, 0, 25, 1367522791),
(44, 9, 15, 0, 10, 1367522791),
(45, 10, 7, 0, 25, 1367523251),
(46, 9, 16, 0, 10, 1367523251);

-- --------------------------------------------------------

--
-- Table structure for table `g0g1_questions`
--

CREATE TABLE IF NOT EXISTS `g0g1_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topic` int(3) NOT NULL,
  `title` varchar(64) NOT NULL,
  `full` varchar(1024) NOT NULL,
  `bid` int(11) NOT NULL,
  `asked_by` int(11) NOT NULL,
  `solved` tinyint(1) NOT NULL,
  `answer` int(11) NOT NULL,
  `asked_time` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `g0g1_questions`
--

INSERT INTO `g0g1_questions` (`id`, `topic`, `title`, `full`, `bid`, `asked_by`, `solved`, `answer`, `asked_time`, `published`) VALUES
(4, 3, 'Differential Equation and Picard Iteration', '[Mind boggling question situated here]', 51, 1, 1, 2, 1367508762, 0),
(20, 4, 'Help with pythagorian theorum', 'Ok so I am trying to use the pytagorian theorum but I forgot what A,  B, and C are on a triangle without a right angle. . . . Please help', 109, 7, 0, 0, 1367510210, 1),
(21, 2, 'SOO confused right now (grade 10)', 'Alright so my teacher talked about lines going through circles, and I do not even know what I was supposed to do with them.', 300, 6, 0, 0, 1367510536, 1);

-- --------------------------------------------------------

--
-- Table structure for table `g0g1_redeem`
--

CREATE TABLE IF NOT EXISTS `g0g1_redeem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request_code` int(32) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `time` int(13) NOT NULL,
  `status` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `g0g1_redeem`
--

INSERT INTO `g0g1_redeem` (`id`, `request_code`, `user_id`, `amount`, `time`, `status`) VALUES
(8, 2147483647, 7, 1000, 1366591215, 'pending'),
(9, 2147483647, 7, 1000, 1366591294, 'pending'),
(10, 2147483647, 7, 1000, 1366591783, 'pending'),
(11, 2147483647, 7, 4000, 1366591787, 'pending'),
(12, 2147483647, 7, 6000, 1367271199, 'pending'),
(13, 2147483647, 7, 5000, 1367271201, 'pending'),
(14, 2147483647, 7, 1000, 1367271215, 'pending'),
(15, 2147483647, 8, 9000, 1367508454, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `g0g1_report`
--

CREATE TABLE IF NOT EXISTS `g0g1_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `g0g1_report`
--

INSERT INTO `g0g1_report` (`id`, `type_id`, `name`, `description`) VALUES
(1, 1, 'User', 'Members on the site'),
(2, 2, 'Writing', 'Content submitted by user');

-- --------------------------------------------------------

--
-- Table structure for table `g0g1_report_log`
--

CREATE TABLE IF NOT EXISTS `g0g1_report_log` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `g0g1_report_log`
--

INSERT INTO `g0g1_report_log` (`id`, `state`, `type`, `content_id`, `reporter`, `reason`, `evidence`, `comments`, `time`) VALUES
(1, 2, 2, 5, 7, 3, 'Supply evidence/description on the report', 'Any comments on this?', 1362612502),
(2, 2, 1, 5, 7, 6, 'This man is clearly not Julius Caesar', 'Last time I checked he passed away. ', 1367511871);

-- --------------------------------------------------------

--
-- Table structure for table `g0g1_report_reason`
--

CREATE TABLE IF NOT EXISTS `g0g1_report_reason` (
  `id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `description` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `g0g1_report_reason`
--

INSERT INTO `g0g1_report_reason` (`id`, `type_id`, `name`, `description`) VALUES
(1, 2, 'Plagarism', 'Content is taken directory from a location outside Globe Of Geek without proper citation/credit given '),
(2, 2, 'Misleading', 'Content is not delivered properly and gives false information that may confuse the user. '),
(3, 2, 'Outdated', 'Content is no longer updated on the topic is covers and must notify the viewers of this. '),
(4, 2, 'Inappropriate ', 'Content is just straight up naughty, not for out viewers. '),
(5, 1, 'Inappropriate', 'Profile contains information not appropriate for the GlobeOfGeek community.'),
(6, 1, 'Impersonation', 'User is clearly ripping off/copying the identity of someone else to receive personal gain. ');

-- --------------------------------------------------------

--
-- Table structure for table `g0g1_rep_log`
--

CREATE TABLE IF NOT EXISTS `g0g1_rep_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rule` int(11) NOT NULL,
  `topic` int(11) NOT NULL,
  `subject` varchar(32) NOT NULL,
  `object` varchar(32) NOT NULL,
  `time` int(13) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `g0g1_rep_log`
--

INSERT INTO `g0g1_rep_log` (`id`, `rule`, `topic`, `subject`, `object`, `time`, `amount`, `status`) VALUES
(1, 1, 1, '1', '3', 123414, 12, 1),
(2, 1, 1, '1', '7', 512351, 51, 1),
(3, 1, 1, '1', '7', 151251, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `g0g1_rep_rules`
--

CREATE TABLE IF NOT EXISTS `g0g1_rep_rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rule_id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `description` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `g0g1_rep_rules`
--

INSERT INTO `g0g1_rep_rules` (`id`, `rule_id`, `title`, `description`) VALUES
(1, 1, 'Accepted Answer', 'Tutor posted an answer in which was accepted. ');

-- --------------------------------------------------------

--
-- Table structure for table `g0g1_users`
--

CREATE TABLE IF NOT EXISTS `g0g1_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(24) NOT NULL,
  `password` varchar(32) NOT NULL,
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `g0g1_users`
--

INSERT INTO `g0g1_users` (`user_id`, `username`, `password`, `points`, `join_date`, `email`, `activate_code`, `activated`, `user_level`, `avatar_id`, `invited_by`, `invites`) VALUES
(9, 'Romney', 'testaccount3', 991, 1327512362, 'justice_4evar@gmail.com', NULL, 1, 0, 1, 0, 0),
(3, 'Plato ', 'testaccount1', 714, 1367512362, 'asdfads@gmail.com', NULL, 1, 2, 3, 0, 0),
(4, 'Socrates ', 'testaccount2', 230, 1367412362, 'gaposidjfad@gmail.com', NULL, 1, 2, 4, 0, 0),
(5, 'Julius', 'testaccount4', 15, 1367512362, '52351@gmail.com', NULL, 1, 2, 6, 0, 0),
(6, 'Aristotle', 'testaccount5', 662, 1367512362, 'asdfad@gmail.com', NULL, 1, 4, 7, 0, 0),
(7, 'Kyle', 'testaccount6', 1996482, 1366512362, 'tesdtf@gmail.com', '0fb95cce484c8646ec61a619f613ac4b', 1, 5, 5, 0, 25),
(10, 'Bobby1', 'oasidjfad', 10, 1367510925, 'asdfasdf@gmail.com', NULL, 0, 2, 2, 7, 0),
(11, 'tommy6', 'globeofgeek12', 10, 1367518635, 'gaspodjf@gmail.com', NULL, 0, 2, 1, 7, 0),
(12, 'Nathan', 'globeofgeek12', 10, 1367519599, 'ilovemath@gmail.com', NULL, 0, 2, 1, 7, 0),
(13, 'nonny', 'globeofgeek12', 5, 1367520617, 'asdfasdf@gmail.com', NULL, 0, 2, 1, 7, 0),
(14, 'johnneh', 'globeofgeek12', 10, 1367521328, 'qwefasdfaf@gmail.com', NULL, 0, 2, 1, 7, 0),
(15, 'amy123', 'globeofgeek12', 10, 1367522791, 'asdfasdfasdf@gmail.com', NULL, 0, 2, 1, 7, 0),
(16, 'Algebra', 'globeofgeek12', 10, 1367523251, 'apowiefawef@gmail.com', NULL, 0, 2, 1, 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `g0g1_user_levels`
--

CREATE TABLE IF NOT EXISTS `g0g1_user_levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `g0g1_user_levels`
--

INSERT INTO `g0g1_user_levels` (`id`, `level`, `title`, `description`) VALUES
(1, 0, 'Banned', 'Account is restricted due to moderator decision. '),
(2, 1, 'Public', 'Account is not registered, visitor access. '),
(3, 2, 'Registered', 'Account is registered. '),
(4, 3, 'Moderator', 'Oversees front end activity to ensure a healthy community environment. '),
(5, 4, 'Administrator', 'Manages backend activity and conducts large scale decisions on site direction'),
(6, 5, 'Owner', 'Project owner/manager. ');

-- --------------------------------------------------------

--
-- Table structure for table `g0g1_writing`
--

CREATE TABLE IF NOT EXISTS `g0g1_writing` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `g0g1_writing`
--

INSERT INTO `g0g1_writing` (`content_id`, `publisher_id`, `created`, `title`, `description`, `full_text`, `category`, `tags`, `type`, `published`, `activated`, `earn_type`, `reward_amount`, `lock_price`, `unlock_count`, `views`, `access_level`) VALUES
(1, 0, 1359684917, 'Content Title', 'Description Here    ', 'thisis a testing preview to see just how much content may be displayed at first. As I continue writing I hope to get passed 100 letters in order to truly test the functionality of this awesome php page coded by none other than myself, gog!\r\nthisis a testing preview to see just how much content may be displayed at first. As I continue writing I hope to get passed 100 letters in order to truly test the functionality of this awesome php page coded by none other than myself, gog!\r\nthisis a testing preview to see just how much content may be displayed at first. As I continue writing I hope to get passed 100 letters in order to truly test the functionality of this awesome php page coded by none other than myself, gog!\r\nthisis a testing preview to see just how much content may be displayed at first. As I continue writing I hope to get passed 100 letters in order to truly test the functionality of this awesome php page coded by none other than myself, gog!thisis a testing preview to see just how much content may be displayed at first. As I continue writing I hope to get passed 100 letters in order to truly test the functionality of this awesome php page coded by none other than myself, gog!\r\nthisis a testing preview to see just how much content may be displayed at first. As I continue writing I hope to get passed 100 letters in order to truly test the functionality of this awesome php page coded by none other than myself, gog!\r\nthisis a testing preview to see just how much content may be displayed at first. As I continue writing I hope to get passed 100 letters in order to truly test the functionality of this awesome php page coded by none other than myself, gog!\r\nthisis a testing preview to see just how much content may be displayed at first. As I continue writing I hope to get passed 100 letters in order to truly test the functionality of this awesome php page coded by none other than myself, gog!', 5, '', 6, 1, 1, 'ppu', 0, 125, 4, 20, 1),
(2, 7, 1359739382, 'Content Title', 'Description Here    ', 'Content Here    ', 3, '', 3, 1, 1, 'ppu', 123, 125, 2, 7, 1),
(3, 7, 1362098521, 'test', '<b>    ', '<b>test</b>', 5, '', 3, 1, 1, 'ppu', 0, 5, 1, 22, 1),
(4, 7, 1362100827, 'Content Title', 'Description Here    ', '<b>haxlol</b>    ', 1, '', 1, 1, 1, 'pps', 2, 21, 0, 15, 1),
(5, 7, 1362101497, 'Content Title', 'Description Here    ', '<;iajsdf''''km;asdf,mas;''m'';mq<br>br<.mfd.<haxk    ', 1, '', 1, 1, 1, 'pps', 21, 21, 0, 11, 2),
(6, 7, 1362101627, '",br>''as;df"', '":DSJDescription Here    ', ''':LZJKs    ', 5, '', 7, 1, 1, 'pps', 21, 21, 0, 2, 2),
(7, 7, 1362102615, '''/>test<br>bkfajs', '''/>test    ', 'test    ', 1, '', 1, 1, 1, 'pps', 21, 0, 0, 7, 2),
(8, 7, 1362613256, 'Content Title', 'Description Here', '', 0, '', 0, 0, 0, 'pps', 0, 0, 0, 0, 2),
(9, 7, 1362613315, 'Content Title', 'Description Here', '', 0, '', 0, 0, 0, 'ppu', 0, 5, 0, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `g0g1_writing_type`
--

CREATE TABLE IF NOT EXISTS `g0g1_writing_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `g0g1_writing_type`
--

INSERT INTO `g0g1_writing_type` (`id`, `type_id`, `name`, `description`) VALUES
(1, 1, 'Essay', ''),
(2, 2, 'Response', ''),
(3, 3, 'Report', ''),
(4, 4, 'Review', ''),
(5, 5, 'Story', ''),
(6, 6, 'Tutorial', ''),
(7, 7, 'Other', '');

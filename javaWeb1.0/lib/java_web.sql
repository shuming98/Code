-- MySQL dump 10.13  Distrib 5.7.24, for macos10.14 (x86_64)
--
-- Host: localhost    Database: java_web
-- ------------------------------------------------------
-- Server version	5.7.24-log

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
-- Current Database: `java_web`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `java_web` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `java_web`;

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `art_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `user_account` char(30) NOT NULL DEFAULT '',
  `dirname_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `art_title` varchar(50) NOT NULL DEFAULT '',
  `art_content` text,
  `pubtime` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`art_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `choice_test`
--

DROP TABLE IF EXISTS `choice_test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `choice_test` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `test_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `question` varchar(255) NOT NULL DEFAULT '',
  `A` varchar(255) NOT NULL DEFAULT '',
  `B` varchar(255) NOT NULL DEFAULT '',
  `C` varchar(255) NOT NULL DEFAULT '',
  `D` varchar(255) NOT NULL DEFAULT '',
  `answer` char(5) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `choice_test`
--

LOCK TABLES `choice_test` WRITE;
/*!40000 ALTER TABLE `choice_test` DISABLE KEYS */;
/*!40000 ALTER TABLE `choice_test` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `excellent`
--

DROP TABLE IF EXISTS `excellent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `excellent` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `identify` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `name` char(5) NOT NULL DEFAULT '',
  `pic_path` varchar(255) NOT NULL DEFAULT '/images/icon/user.png',
  `pubtime` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `excellent`
--

LOCK TABLES `excellent` WRITE;
/*!40000 ALTER TABLE `excellent` DISABLE KEYS */;
/*!40000 ALTER TABLE `excellent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forum_cat`
--

DROP TABLE IF EXISTS `forum_cat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forum_cat` (
  `cat_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `cat_name` char(10) NOT NULL DEFAULT '',
  `post_sum` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forum_cat`
--

LOCK TABLES `forum_cat` WRITE;
/*!40000 ALTER TABLE `forum_cat` DISABLE KEYS */;
INSERT INTO `forum_cat` VALUES (1,'公告',0),(2,'精品',0),(3,'求助',0),(4,'分享',0);
/*!40000 ALTER TABLE `forum_cat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forum_comment`
--

DROP TABLE IF EXISTS `forum_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forum_comment` (
  `com_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL DEFAULT '0',
  `floor_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `user_account` char(30) NOT NULL DEFAULT '',
  `content` text,
  `pubtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`com_id`),
  KEY `post_id` (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forum_comment`
--

LOCK TABLES `forum_comment` WRITE;
/*!40000 ALTER TABLE `forum_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `forum_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forum_post`
--

DROP TABLE IF EXISTS `forum_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forum_post` (
  `post_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_account` char(30) NOT NULL DEFAULT '',
  `post_title` varchar(50) NOT NULL DEFAULT '',
  `cat_name` char(10) NOT NULL DEFAULT '',
  `post_content` text,
  `pubtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forum_post`
--

LOCK TABLES `forum_post` WRITE;
/*!40000 ALTER TABLE `forum_post` DISABLE KEYS */;
/*!40000 ALTER TABLE `forum_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forum_reply`
--

DROP TABLE IF EXISTS `forum_reply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forum_reply` (
  `com_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL DEFAULT '0',
  `floor_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `user_account` char(30) NOT NULL DEFAULT '',
  `content` text,
  `pubtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`com_id`),
  KEY `floor_id` (`floor_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forum_reply`
--

LOCK TABLES `forum_reply` WRITE;
/*!40000 ALTER TABLE `forum_reply` DISABLE KEYS */;
/*!40000 ALTER TABLE `forum_reply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `give_a_like`
--

DROP TABLE IF EXISTS `give_a_like`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `give_a_like` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL DEFAULT '0',
  `user_account` char(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `give_a_like`
--

LOCK TABLES `give_a_like` WRITE;
/*!40000 ALTER TABLE `give_a_like` DISABLE KEYS */;
/*!40000 ALTER TABLE `give_a_like` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `home_news`
--

DROP TABLE IF EXISTS `home_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `home_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '',
  `cat_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `link` varchar(255) NOT NULL DEFAULT '',
  `content` text,
  `pubtime` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `home_news`
--

LOCK TABLES `home_news` WRITE;
/*!40000 ALTER TABLE `home_news` DISABLE KEYS */;
/*!40000 ALTER TABLE `home_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `issue_work`
--

DROP TABLE IF EXISTS `issue_work`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `issue_work` (
  `work_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_account` char(30) NOT NULL DEFAULT '0',
  `class` char(20) NOT NULL DEFAULT '',
  `work_title` varchar(50) NOT NULL DEFAULT '作业',
  `work_content` text,
  `work_filepath` varchar(255) NOT NULL DEFAULT '',
  `issue_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `deadline` datetime DEFAULT NULL,
  PRIMARY KEY (`work_id`),
  KEY `user_account` (`user_account`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `issue_work`
--

LOCK TABLES `issue_work` WRITE;
/*!40000 ALTER TABLE `issue_work` DISABLE KEYS */;
/*!40000 ALTER TABLE `issue_work` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news_cat`
--

DROP TABLE IF EXISTS `news_cat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news_cat` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `cat_name` char(20) NOT NULL DEFAULT '',
  `news_num` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news_cat`
--

LOCK TABLES `news_cat` WRITE;
/*!40000 ALTER TABLE `news_cat` DISABLE KEYS */;
INSERT INTO `news_cat` VALUES (1,'最新资讯',0),(2,'学生优秀作品',0),(3,'站外资讯',0);
/*!40000 ALTER TABLE `news_cat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pageview`
--

DROP TABLE IF EXISTS `pageview`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pageview` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `symbol` char(10) NOT NULL DEFAULT '',
  `ip` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `symbol` (`symbol`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pageview`
--

LOCK TABLES `pageview` WRITE;
/*!40000 ALTER TABLE `pageview` DISABLE KEYS */;
/*!40000 ALTER TABLE `pageview` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resource`
--

DROP TABLE IF EXISTS `resource`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resource` (
  `resource_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tag_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `user_account` char(30) NOT NULL DEFAULT '',
  `resource_name` char(50) NOT NULL DEFAULT '请叫我资源',
  `resource_type` char(10) NOT NULL DEFAULT '',
  `resource_path` varchar(255) NOT NULL DEFAULT '',
  `update_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `click_count` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`resource_id`),
  KEY `tag_id` (`tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resource`
--

LOCK TABLES `resource` WRITE;
/*!40000 ALTER TABLE `resource` DISABLE KEYS */;
/*!40000 ALTER TABLE `resource` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resource_tag`
--

DROP TABLE IF EXISTS `resource_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resource_tag` (
  `tag_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `user_account` char(30) NOT NULL DEFAULT '',
  `tag_name` char(20) NOT NULL DEFAULT '',
  `resource_sum` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resource_tag`
--

LOCK TABLES `resource_tag` WRITE;
/*!40000 ALTER TABLE `resource_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `resource_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slideshow`
--

DROP TABLE IF EXISTS `slideshow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slideshow` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL DEFAULT '',
  `pic_path` varchar(255) NOT NULL DEFAULT '',
  `pubtime` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slideshow`
--

LOCK TABLES `slideshow` WRITE;
/*!40000 ALTER TABLE `slideshow` DISABLE KEYS */;
/*!40000 ALTER TABLE `slideshow` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `study_dir`
--

DROP TABLE IF EXISTS `study_dir`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `study_dir` (
  `dirname_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `user_account` char(30) NOT NULL DEFAULT '',
  `dirname` char(20) NOT NULL DEFAULT '',
  `article_sum` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`dirname_id`),
  KEY `dirname` (`dirname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `study_dir`
--

LOCK TABLES `study_dir` WRITE;
/*!40000 ALTER TABLE `study_dir` DISABLE KEYS */;
/*!40000 ALTER TABLE `study_dir` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `submit_work`
--

DROP TABLE IF EXISTS `submit_work`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `submit_work` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `work_id` int(10) unsigned NOT NULL DEFAULT '0',
  `user_account` char(30) NOT NULL DEFAULT '',
  `work_content` text,
  `work_filepath` varchar(255) NOT NULL DEFAULT '',
  `submit_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `score` char(10) NOT NULL DEFAULT '',
  `comment` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `work_id` (`work_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `submit_work`
--

LOCK TABLES `submit_work` WRITE;
/*!40000 ALTER TABLE `submit_work` DISABLE KEYS */;
/*!40000 ALTER TABLE `submit_work` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teacher`
--

DROP TABLE IF EXISTS `teacher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teacher` (
  `teacher_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `user_account` char(30) NOT NULL DEFAULT '',
  `t_name` char(20) NOT NULL DEFAULT '',
  `t_class` char(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`teacher_id`),
  KEY `user_account` (`user_account`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teacher`
--

LOCK TABLES `teacher` WRITE;
/*!40000 ALTER TABLE `teacher` DISABLE KEYS */;
/*!40000 ALTER TABLE `teacher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test` (
  `test_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `user_account` char(30) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `pubtime` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`test_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test`
--

LOCK TABLES `test` WRITE;
/*!40000 ALTER TABLE `test` DISABLE KEYS */;
/*!40000 ALTER TABLE `test` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `user_account` char(30) NOT NULL DEFAULT '',
  `user_password` char(40) NOT NULL DEFAULT '',
  `permission_id` tinyint(4) NOT NULL DEFAULT '3',
  `lastlogin` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'root','f71493380c7f1a60976558ff8fb3cf54',1,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_data`
--

DROP TABLE IF EXISTS `user_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_data` (
  `user_account` char(30) NOT NULL DEFAULT '',
  `user_nick` char(20) NOT NULL DEFAULT '匿名',
  `gender` char(2) NOT NULL DEFAULT '',
  `tel` char(20) NOT NULL DEFAULT '',
  `class` char(20) NOT NULL DEFAULT '',
  `pic_path` varchar(255) NOT NULL DEFAULT '/images/icon/user.png',
  KEY `user_account` (`user_account`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_data`
--

LOCK TABLES `user_data` WRITE;
/*!40000 ALTER TABLE `user_data` DISABLE KEYS */;
INSERT INTO `user_data` VALUES ('root','超级管理员','','','','/images/icon/user.png');
/*!40000 ALTER TABLE `user_data` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-29  0:15:43

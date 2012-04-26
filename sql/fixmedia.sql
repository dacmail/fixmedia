# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.0.45)
# Database: fixmedia
# Generation Time: 2012-04-26 16:35:57 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `comment_id` bigint(20) unsigned NOT NULL auto_increment,
  `user_id` bigint(20) default NULL,
  `report_id` bigint(20) default NULL,
  `content` text,
  `PARENT` bigint(20) default NULL,
  `IP` char(24) default NULL,
  `created_at` timestamp NULL default NULL,
  PRIMARY KEY  (`comment_id`),
  KEY `user_id` (`user_id`),
  KEY `report_id` (`report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table fixs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fixs`;

CREATE TABLE `fixs` (
  `fix_id` bigint(20) unsigned NOT NULL auto_increment,
  `user_id` bigint(20) default NULL,
  `report_id` bigint(20) default NULL,
  `ip` char(24) default NULL,
  `created_at` timestamp NULL default NULL,
  PRIMARY KEY  (`fix_id`),
  UNIQUE KEY `ip` (`ip`,`report_id`),
  UNIQUE KEY `report_id_2` (`report_id`,`user_id`),
  KEY `user_id` (`user_id`),
  KEY `report_id` (`report_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table reports
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reports`;

CREATE TABLE `reports` (
  `report_id` bigint(20) unsigned NOT NULL auto_increment,
  `user_id` bigint(20) unsigned NOT NULL,
  `url` varchar(250) NOT NULL default '',
  `title` text NOT NULL,
  `screenshot` varchar(100) default NULL,
  `author_id` int(10) unsigned default NULL,
  `author_approved` tinyint(4) default NULL,
  `created_at` timestamp NULL default NULL,
  PRIMARY KEY  (`report_id`),
  KEY `user_id` (`user_id`),
  KEY `url` (`url`),
  KEY `author_id` (`author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `reports` WRITE;
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;

INSERT INTO `reports` (`report_id`, `user_id`, `url`, `title`, `screenshot`, `author_id`, `author_approved`, `created_at`)
VALUES
	(1,1,'http://fixmedia.org','Fixmedia.org, mejora las noticias',NULL,NULL,NULL,NULL);

/*!40000 ALTER TABLE `reports` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table reports_data
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reports_data`;

CREATE TABLE `reports_data` (
  `report_data_id` bigint(20) unsigned NOT NULL auto_increment,
  `report_id` bigint(20) default NULL,
  `type` varchar(100) default NULL,
  `type_info` varchar(100) default NULL,
  `title` varchar(100) default '',
  `content` text,
  `urls` text,
  `created_at` timestamp NULL default NULL,
  PRIMARY KEY  (`report_data_id`),
  KEY `report_id` (`report_id`),
  KEY `type` (`type`),
  KEY `type_info` (`type_info`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table reports_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reports_types`;

CREATE TABLE `reports_types` (
  `report_type_id` int(11) unsigned NOT NULL auto_increment,
  `type` varchar(100) default NULL,
  `parent` int(11) default NULL,
  PRIMARY KEY  (`report_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

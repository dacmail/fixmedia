# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.0.45)
# Database: fixmedia
# Generation Time: 2012-05-02 08:50:33 +0000
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
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `user_id` bigint(20) default NULL,
  `report_id` bigint(20) default NULL,
  `content` text,
  `parent` bigint(20) default NULL,
  `IP` char(24) default NULL,
  `created_at` timestamp NULL default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `report_id` (`report_id`),
  KEY `parent` (`parent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table fixs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fixs`;

CREATE TABLE `fixs` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `user_id` bigint(20) default NULL,
  `report_id` bigint(20) default NULL,
  `ip` char(24) default NULL,
  `created_at` timestamp NULL default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `ip` (`ip`,`report_id`),
  UNIQUE KEY `report_id_2` (`report_id`,`user_id`),
  KEY `user_id` (`user_id`),
  KEY `report_id` (`report_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;

INSERT INTO `groups` (`id`, `name`, `description`)
VALUES
	(1,'admin','Administrator'),
	(2,'members','General User');

/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table reports
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reports`;

CREATE TABLE `reports` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `user_id` bigint(20) unsigned NOT NULL,
  `url` varchar(250) NOT NULL default '',
  `title` text NOT NULL,
  `screenshot` varchar(100) default NULL,
  `slug` varchar(250) default NULL,
  `author_id` int(10) unsigned default NULL,
  `author_approved` tinyint(4) default NULL,
  `created_at` timestamp NULL default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `user_id` (`user_id`),
  KEY `url` (`url`),
  KEY `author_id` (`author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `reports` WRITE;
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;

INSERT INTO `reports` (`id`, `user_id`, `url`, `title`, `screenshot`, `slug`, `author_id`, `author_approved`, `created_at`)
VALUES
	(1,1,'http://fixmedia.org','Fixmedia.org, mejora las noticias',NULL,'fixmedia-org-mejora-las-noticias',NULL,NULL,NULL),
	(2,1,'http://bottup.com/201204288358/Mexico/la-abolicion-de-las-corridas-en-df.html','La abolición de las corridas en DF no se votará',NULL,'la-abolicin-de-las-corridas-en-df-no-se-votar',NULL,NULL,'2012-05-02 09:44:17'),
	(5,1,'http://codeigniter.com/user_guide/helpers/url_helper.html','URL Helper : CodeIgniter User Guide',NULL,'url-helper-codeigniter-user-guide',NULL,NULL,'2012-05-02 10:21:27'),
	(6,1,'http://community-auth.com/','Community Auth - Open Source CodeIgniter Authentication',NULL,'community-auth-open-source-codeigniter-authentication',NULL,NULL,'2012-05-02 10:32:59');

/*!40000 ALTER TABLE `reports` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table reports_data
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reports_data`;

CREATE TABLE `reports_data` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `report_id` bigint(20) default NULL,
  `type` varchar(100) default NULL,
  `type_info` varchar(100) default NULL,
  `title` varchar(100) default '',
  `content` text,
  `urls` text,
  `created_at` timestamp NULL default NULL,
  PRIMARY KEY  (`id`),
  KEY `report_id` (`report_id`),
  KEY `type` (`type`),
  KEY `type_info` (`type_info`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `reports_data` WRITE;
/*!40000 ALTER TABLE `reports_data` DISABLE KEYS */;

INSERT INTO `reports_data` (`id`, `report_id`, `type`, `type_info`, `title`, `content`, `urls`, `created_at`)
VALUES
	(1,2,'Correccion','Introducción de opinión en textos informativos','Valor de prueba','Texto por defecto','Valor de prueba','2012-05-02 09:44:18'),
	(2,2,'Ampliación','Añadir autoría de citas, declaraciones, imágenes, gráficos, etc.\n','Valor de prueba','Texto por defecto','Valor de prueba','2012-05-02 09:44:18'),
	(3,3,'Correccion','Introducción de opinión en textos informativos','Valor de prueba','Texto por defecto','Valor de prueba','2012-05-02 09:48:07'),
	(4,3,'Ampliación','Añadir autoría de citas, declaraciones, imágenes, gráficos, etc.\n','Valor de prueba','Texto por defecto','Valor de prueba','2012-05-02 09:48:07'),
	(5,4,'Correccion','Introducción de opinión en textos informativos','Valor de prueba','Texto por defecto','Valor de prueba','2012-05-02 09:48:28'),
	(6,4,'Ampliación','Añadir autoría de citas, declaraciones, imágenes, gráficos, etc.\n','Valor de prueba','Texto por defecto','Valor de prueba','2012-05-02 09:48:28'),
	(7,5,'Correccion','Introducción de opinión en textos informativos','Valor de prueba','Texto por defecto','Valor de prueba','2012-05-02 10:21:27'),
	(8,5,'Correccion','Corrigiendo datos, cifras, declaraciones, autorías, atribuciones, etc.','Valor de prueba','Texto por defecto','Valor de prueba','2012-05-02 10:21:27'),
	(9,6,'Ampliación','Añadir versiones diferentes a la expuesta en la noticia\n','Valor de prueba','Texto por defecto','Valor de prueba','2012-05-02 10:32:59'),
	(10,6,'Correccion','Introducción de opinión en textos informativos','Valor de prueba','Texto por defecto','Valor de prueba','2012-05-02 10:32:59');

/*!40000 ALTER TABLE `reports_data` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table reports_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reports_types`;

CREATE TABLE `reports_types` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `type` varchar(100) default NULL,
  `parent` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `parent` (`parent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `reports_types` WRITE;
/*!40000 ALTER TABLE `reports_types` DISABLE KEYS */;

INSERT INTO `reports_types` (`id`, `type`, `parent`)
VALUES
	(1,'Correccion',0),
	(2,'Ampliación',0),
	(3,'Corrigiendo datos, cifras, declaraciones, autorías, atribuciones, etc.',1),
	(4,'Desvinculación de titular y contenido: cuando el titular no se ajusta al contenido de la noticia.\n',1),
	(5,'Introducción de opinión en textos informativos',1),
	(6,'Léxico incorrecto: económico, jurídico, étnias, religiones, tendencias sexuales, etc',1),
	(7,'Errores gramaticales, sintácticos, ortográficos, de puntuación, léxicos, semánticos, etc.\n',1),
	(8,'Errores de argumentación\n',1),
	(9,'Añadir imagen o vídeo\n',2),
	(10,'Añadir documentación, PDF\n',2),
	(11,'Añadir cifras o datos concretos\n',2),
	(12,'Añadir enlaces que amplíen o complemente la información.\n',2),
	(13,'Añadir versiones diferentes a la expuesta en la noticia\n',2),
	(14,'Añadir autoría de citas, declaraciones, imágenes, gráficos, etc.\n',2),
	(15,'En caso de informar sobre un conflicto: si solo aparece una de las reacciones, aportar la contraria ',2),
	(16,'Aportar url para la elaboración de Storify relacionado',2);

/*!40000 ALTER TABLE `reports_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `ip_address` int(10) unsigned NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(40) default NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) default NULL,
  `forgotten_password_code` varchar(40) default NULL,
  `forgotten_password_time` int(11) unsigned default NULL,
  `remember_code` varchar(40) default NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned default NULL,
  `active` tinyint(1) unsigned default NULL,
  `first_name` varchar(50) default NULL,
  `last_name` varchar(50) default NULL,
  `company` varchar(100) default NULL,
  `phone` varchar(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`)
VALUES
	(1,2130706433,'administrator','59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4','9462e8eee0','admin@admin.com','',NULL,NULL,NULL,1268889823,1268889823,1,'Admin','istrator','ADMIN','0'),
	(2,2130706433,'edipotrebol@gmail.com','7ebfdbfc4c2f55b885641ba35235e6a671684bea',NULL,'benedmunds','46ce73f7a4a51145d077655426fbe336334c1527',NULL,NULL,NULL,1335943567,1335943567,0,NULL,NULL,NULL,NULL),
	(3,2130706433,'dacmail@gmail.com','de0b16f933e9bf6e15fa7db6ad7b62e22b8b51b4',NULL,'dacmail@gmail.com','beb45eac977a7561feb86f5c34a00a2a6a47f061',NULL,NULL,NULL,1335943651,1335943651,0,NULL,NULL,NULL,NULL);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users_groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users_groups`;

CREATE TABLE `users_groups` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `users_groups` WRITE;
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`)
VALUES
	(1,1,1),
	(2,1,2),
	(3,2,2),
	(4,3,2);

/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

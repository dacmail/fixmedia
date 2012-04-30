-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 30-04-2012 a las 21:38:18
-- Versión del servidor: 5.5.9
-- Versión de PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de datos: `fixmedia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `report_id` bigint(20) DEFAULT NULL,
  `content` text,
  `parent` bigint(20) DEFAULT NULL,
  `IP` char(24) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `report_id` (`report_id`),
  KEY `parent` (`parent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `comments`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fixs`
--

DROP TABLE IF EXISTS `fixs`;
CREATE TABLE IF NOT EXISTS `fixs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `report_id` bigint(20) DEFAULT NULL,
  `ip` char(24) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ip` (`ip`,`report_id`),
  UNIQUE KEY `report_id_2` (`report_id`,`user_id`),
  KEY `user_id` (`user_id`),
  KEY `report_id` (`report_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `fixs`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `groups`
--

INSERT INTO `groups` VALUES(1, 'admin', 'Administrator');
INSERT INTO `groups` VALUES(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reports`
--

DROP TABLE IF EXISTS `reports`;
CREATE TABLE IF NOT EXISTS `reports` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `url` varchar(250) NOT NULL DEFAULT '',
  `title` text NOT NULL,
  `screenshot` varchar(100) DEFAULT NULL,
  `author_id` int(10) unsigned DEFAULT NULL,
  `author_approved` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `url` (`url`),
  KEY `author_id` (`author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `reports`
--

INSERT INTO `reports` VALUES(1, 1, 'http://fixmedia.org', 'Fixmedia.org, mejora las noticias', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reports_data`
--

DROP TABLE IF EXISTS `reports_data`;
CREATE TABLE IF NOT EXISTS `reports_data` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `report_id` bigint(20) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `type_info` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT '',
  `content` text,
  `urls` text,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `report_id` (`report_id`),
  KEY `type` (`type`),
  KEY `type_info` (`type_info`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `reports_data`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reports_types`
--

DROP TABLE IF EXISTS `reports_types`;
CREATE TABLE IF NOT EXISTS `reports_types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(100) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Volcar la base de datos para la tabla `reports_types`
--

INSERT INTO `reports_types` VALUES(1, 'Correccion', 0);
INSERT INTO `reports_types` VALUES(2, 'Ampliación', 0);
INSERT INTO `reports_types` VALUES(3, 'Corrigiendo datos, cifras, declaraciones, autorías, atribuciones, etc.', 1);
INSERT INTO `reports_types` VALUES(4, 'Desvinculación de titular y contenido: cuando el titular no se ajusta al contenido de la noticia.\n', 1);
INSERT INTO `reports_types` VALUES(5, 'Introducción de opinión en textos informativos', 1);
INSERT INTO `reports_types` VALUES(6, 'Léxico incorrecto: económico, jurídico, étnias, religiones, tendencias sexuales, etc', 1);
INSERT INTO `reports_types` VALUES(7, 'Errores gramaticales, sintácticos, ortográficos, de puntuación, léxicos, semánticos, etc.\n', 1);
INSERT INTO `reports_types` VALUES(8, 'Errores de argumentación\n', 1);
INSERT INTO `reports_types` VALUES(9, 'Añadir imagen o vídeo\n', 2);
INSERT INTO `reports_types` VALUES(10, 'Añadir documentación, PDF\n', 2);
INSERT INTO `reports_types` VALUES(11, 'Añadir cifras o datos concretos\n', 2);
INSERT INTO `reports_types` VALUES(12, 'Añadir enlaces que amplíen o complemente la información.\n', 2);
INSERT INTO `reports_types` VALUES(13, 'Añadir versiones diferentes a la expuesta en la noticia\n', 2);
INSERT INTO `reports_types` VALUES(14, 'Añadir autoría de citas, declaraciones, imágenes, gráficos, etc.\n', 2);
INSERT INTO `reports_types` VALUES(15, 'En caso de informar sobre un conflicto: si solo aparece una de las reacciones, aportar la contraria ', 2);
INSERT INTO `reports_types` VALUES(16, 'Aportar url para la elaboración de Storify relacionado', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` int(10) unsigned NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `users`
--

INSERT INTO `users` VALUES(1, 2130706433, 'administrator', '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4', '9462e8eee0', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Admin', 'istrator', 'ADMIN', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_groups`
--

DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `users_groups`
--

INSERT INTO `users_groups` VALUES(1, 1, 1);
INSERT INTO `users_groups` VALUES(2, 1, 2);

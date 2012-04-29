-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 29-04-2012 a las 20:53:28
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
  `comment_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `report_id` bigint(20) DEFAULT NULL,
  `content` text,
  `parent` bigint(20) DEFAULT NULL,
  `IP` char(24) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`comment_id`),
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
  `fix_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `report_id` bigint(20) DEFAULT NULL,
  `ip` char(24) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`fix_id`),
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
-- Estructura de tabla para la tabla `reports`
--

DROP TABLE IF EXISTS `reports`;
CREATE TABLE IF NOT EXISTS `reports` (
  `report_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `url` varchar(250) NOT NULL DEFAULT '',
  `title` text NOT NULL,
  `screenshot` varchar(100) DEFAULT NULL,
  `author_id` int(10) unsigned DEFAULT NULL,
  `author_approved` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`report_id`),
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
  `report_data_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `report_id` bigint(20) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `type_info` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT '',
  `content` text,
  `urls` text,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`report_data_id`),
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
  `report_type_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(100) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`report_type_id`),
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
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8 NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 NOT NULL,
  `nickname` varchar(20) CHARACTER SET utf8 NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `url` varchar(200) CHARACTER SET utf8 NOT NULL,
  `activation_code` varchar(50) CHARACTER SET utf8 NOT NULL,
  `forgotten_password_code` varchar(50) CHARACTER SET utf8 NOT NULL,
  `remember_code` varchar(50) CHARACTER SET utf8 NOT NULL,
  `status` tinyint(4) NOT NULL,
  `role` varchar(10) CHARACTER SET utf8 NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  KEY `nickname` (`nickname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `users`
--


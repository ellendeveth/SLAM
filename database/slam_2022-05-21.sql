# ************************************************************
# Sequel Ace SQL dump
# Version 20033
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: 127.0.0.1 (MySQL 5.7.34)
# Database: slam
# Generation Time: 2022-05-21 13:14:27 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table competences
# ------------------------------------------------------------

DROP TABLE IF EXISTS `competences`;

CREATE TABLE `competences` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(300) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `competences` WRITE;
/*!40000 ALTER TABLE `competences` DISABLE KEYS */;

INSERT INTO `competences` (`id`, `name`, `user_id`, `post_id`)
VALUES
	(1,'Design',NULL,9),
	(2,'UI',NULL,9),
	(3,'UX',NULL,9),
	(4,'frontend development',NULL,9),
	(5,'backend development',NULL,9),
	(6,'Onderwijs',NULL,12),
	(7,'klasplanning',NULL,12),
	(8,'kinderbegeleiding',NULL,12);

/*!40000 ALTER TABLE `competences` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table documents
# ------------------------------------------------------------

DROP TABLE IF EXISTS `documents`;

CREATE TABLE `documents` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `link` varchar(300) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table messages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `message` varchar(300) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `sender_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(300) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;

INSERT INTO `posts` (`id`, `title`, `description`, `date`, `user_id`)
VALUES
	(9,'Ontwikkeling website','VZW De Kleine Vos heeft dringend een nieuwe website nodig. Hun huidige website is te ouderwets en informeert de bezoekers niet op een efficiënte of vlotte manier. Er moet dus eerst een nieuw design gemaakt worden met bijpassende branding (brandbook) en vervolgens de ontwikkeling hiervan.','2022-05-18 13:47:28',5),
	(12,'Begeleiding kansarme kinderen','De vrijwilligers van vzw Auxilia bieden kinderen, jongeren en volwassenen individuele hulp bij het leren wanneer zij nergens anders terecht kunnen. We werken samen met scholen, voorzieningen, clb’s en partners.','2022-05-21 09:49:55',7);

/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table reset_password
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reset_password`;

CREATE TABLE `reset_password` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(300) DEFAULT NULL,
  `email` varchar(300) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table tasks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tasks`;

CREATE TABLE `tasks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `task` varchar(300) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;

INSERT INTO `tasks` (`id`, `task`, `user_id`, `post_id`)
VALUES
	(2,'hallo',1,9),
	(31,'cool',1,9);

/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table team
# ------------------------------------------------------------

DROP TABLE IF EXISTS `team`;

CREATE TABLE `team` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `team` WRITE;
/*!40000 ALTER TABLE `team` DISABLE KEYS */;

INSERT INTO `team` (`id`, `post_id`, `user_id`)
VALUES
	(1,9,NULL),
	(2,9,1),
	(3,9,6);

/*!40000 ALTER TABLE `team` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(300) DEFAULT NULL,
  `last_name` varchar(300) DEFAULT NULL,
  `email` varchar(300) DEFAULT NULL,
  `school` varchar(300) DEFAULT NULL,
  `education` varchar(300) DEFAULT NULL,
  `description_vzw` varchar(300) DEFAULT NULL,
  `password` varchar(300) DEFAULT NULL,
  `is_student` tinyint(1) DEFAULT NULL,
  `profile_pic` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `school`, `education`, `description_vzw`, `password`, `is_student`, `profile_pic`)
VALUES
	(1,'Ellen','de Veth','ellen.deveth@hotmail.com','Thomas More','Interactive Multimedia Design',NULL,'$2y$12$Y4R9LIB7gYa0/QAjXxdlVuWUtHdKSEKuqiTO7LCEmLerJhPhC3Nvu',1,'me.jpeg'),
	(5,'De Kleine Vos',NULL,'dekleinevos@gmail.com',NULL,NULL,'Binnen vzw De Kleine Vos zien wij het als onze opdracht en onze maatschappelijke verantwoordelijkheid om de levenskwaliteit van gezinnen met kinderen tussen 0 en 12 jaar te ondersteunen of te verbeteren.\r\n\r\n','$2y$12$NRfqJ5ZyWffccd4JQO39ceZ.quoETarfQPZs/n6YULXOtBRZ/FqN6',0,'kleinevos.png'),
	(6,'Alejandro','De Wolf','alejandro@dewolf.be','thomas more','Interactive multimedia design',NULL,'$2y$12$NmjWxofhB3eWcV6weu4BU.zEVG/3De5xSNdTZYlER1oFsreA9.qpi',1,'alejandro.jpeg'),
	(7,'Auxilia',NULL,'auxilia@gmail.com',NULL,NULL,'De vrijwilligers van vzw Auxilia bieden kinderen, jongeren en volwassenen individuele hulp bij het leren wanneer zij nergens anders terecht kunnen.','$2y$12$rv6Lx/pTWmD2Wk77WuWCIeUHS9M7n2lKa5O7JU/4FXcjnZAx7ZqdK',0,'auxilia.png');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

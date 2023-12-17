-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour momie
CREATE DATABASE IF NOT EXISTS `momie` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `momie`;

-- Listage de la structure de table momie. messages
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `sendBy` bigint NOT NULL,
  `receivedBy` bigint NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sendBy` (`sendBy`),
  KEY `receivedBy` (`receivedBy`),
  CONSTRAINT `FK__users` FOREIGN KEY (`sendBy`) REFERENCES `users` (`id`),
  CONSTRAINT `FK__users_2` FOREIGN KEY (`receivedBy`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table momie.messages : ~3 rows (environ)
INSERT INTO `messages` (`id`, `sendBy`, `receivedBy`, `content`) VALUES
	(1, 1, 2, 'Bienvenue chez MCH ! Amusez vous bien sur nos serveurs FTP !'),
	(2, 1, 3, 'Bienvenue chez MCH ! Amusez vous bien sur nos serveurs FTP !'),
	(3, 1, 4, 'Bienvenue chez MCH ! Amusez vous bien sur nos serveurs FTP !'),
	(4, 1, 5, 'Bienvenue chez MCH ! Amusez vous bien sur nos serveurs FTP !');

-- Listage de la structure de table momie. servers
CREATE TABLE IF NOT EXISTS `servers` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `host` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `port` bigint DEFAULT NULL,
  `user` bigint DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  CONSTRAINT `FK_servers_users` FOREIGN KEY (`user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table momie.servers : ~0 rows (environ)
INSERT INTO `servers` (`id`, `host`, `port`, `user`) VALUES
	(1, 'ho-ftpserver', 21, 5);

-- Listage de la structure de table momie. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `firstname` varchar(80) COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(80) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(80) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table momie.users : ~4 rows (environ)
INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `role`) VALUES
	(1, 'Bobby', 'Sixkiller', 'bobby@mch.fr', '$2y$10$QWuhRem2245psxhMkX0c4eu.q8BbAAtqRFYg3tnpgUN4JwFxABtXi', 'admin'),
	(2, 'Joe', 'Lindien', 'joe@yopmail.fr', '$2y$10$dkoSamGKpty3LYmZpJbLXuB2i.620ozPs5B1rcKpEljJBeRqyLlIG', 'user'),
	(3, 'Cyril', 'Complete', 'cyrhades@yopmail.fr', '$2y$10$liZwxT0Rj7lFfu9xrX.7kuok4OigdQ7Ri.oMqK2GPD5GD7Z9VgMN2', 'user'),
	(4, 'Spi', 'Rule', 'spirule@yopmail.fr', '$2y$10$yVkRGjs/MbYnMcTcUQP0nOsSn0youqq.GGdtO741Nggq01K62AGrq', 'user'),
	(5, 'Kevin', 'Lupin', 'k.lupin@secretmail.io', '$2y$10$8Ls2d2RUekwwHyehjtO4lu3UjDZu1ZJ.n7wrkPF6CWX0NyyC55wKq', 'user');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

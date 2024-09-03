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


-- Listage de la structure de la base pour sf-api-pressing
CREATE DATABASE IF NOT EXISTS `sf-api-pressing` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sf-api-pressing`;

-- Listage de la structure de table sf-api-pressing. category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_64C19C1727ACA70` (`parent_id`),
  CONSTRAINT `FK_64C19C1727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table sf-api-pressing.category : ~18 rows (environ)
INSERT INTO `category` (`id`, `name`, `image`, `parent_id`) VALUES
	(1, 'T-shirt', 't-shirt.png', 1),
	(2, 'Chemise', 'Chemise-homme.jpg', 2),
	(3, 'Pantalon', 'pantalon.png', 3),
	(4, 'Jupe', 'jupe.jpg', NULL),
	(5, 'Robe', 'robe.jpg', NULL),
	(6, 'Short', 'short.png', NULL),
	(7, 'Manteau', 'manteau.jpg', NULL),
	(8, 'Pull', 'pull.png', NULL),
	(9, 'Cardigan', 'cardigan.png', NULL),
	(10, 'Sweat-shirt', 'sweat-shirt.png', NULL),
	(11, 'Polo', 'pollo.png', NULL),
	(12, 'Blazer', 'blazer.png', NULL),
	(13, 'Gilet', 'blazer.png', NULL),
	(14, 'Pyjama', 'pyjama.png', NULL),
	(15, 'Chemisier', 'Blouse-Chemisier.jpg', NULL),
	(16, 'Legging', 'Legging.png', NULL),
	(17, 'Combinaison', 'combinaison.jpg', NULL),
	(18, 'Trench-coat', 'trench-coat.jpg', NULL);

-- Listage de la structure de table sf-api-pressing. client
CREATE TABLE IF NOT EXISTS `client` (
  `client_number` varchar(255) NOT NULL,
  `premium` tinyint(1) DEFAULT NULL,
  `id` int NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_C7440455BF396750` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table sf-api-pressing.client : ~5 rows (environ)
INSERT INTO `client` (`client_number`, `premium`, `id`) VALUES
	('1', 1, 6),
	('1', 1, 7),
	('1', 1, 8),
	('1', 1, 9),
	('1', 0, 10),
	('2', NULL, 22);

-- Listage de la structure de table sf-api-pressing. commande
CREATE TABLE IF NOT EXISTS `commande` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ref` varchar(10) NOT NULL,
  `filing_date` datetime NOT NULL,
  `return_date` datetime NOT NULL,
  `payment_date` datetime NOT NULL,
  `client_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6EEAA67D19EB6921` (`client_id`),
  CONSTRAINT `FK_6EEAA67D19EB6921` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table sf-api-pressing.commande : ~11 rows (environ)
INSERT INTO `commande` (`id`, `ref`, `filing_date`, `return_date`, `payment_date`, `client_id`) VALUES
	(1, '00001', '2023-05-01 00:00:00', '2023-05-08 00:00:00', '2023-05-01 14:00:00', 9),
	(2, '2', '2023-05-02 00:00:00', '2023-05-09 00:00:00', '2023-05-02 14:00:00', 8),
	(3, '3', '2023-05-03 00:00:00', '2023-05-10 00:00:00', '2023-05-03 14:00:00', 7),
	(4, '4', '2023-05-04 00:00:00', '2023-05-11 00:00:00', '2023-05-04 14:00:00', 10),
	(5, '5', '2023-05-05 00:00:00', '2023-05-12 00:00:00', '2023-05-05 14:00:00', 9),
	(6, '6', '2023-05-06 00:00:00', '2023-05-13 00:00:00', '2023-05-06 14:00:00', 8),
	(7, '7', '2023-05-07 00:00:00', '2023-05-14 00:00:00', '2023-05-07 14:00:00', 8),
	(8, '1', '2023-05-08 00:00:00', '2023-05-15 00:00:00', '2023-05-08 14:00:00', 10),
	(9, '1', '2023-05-09 00:00:00', '2023-05-16 00:00:00', '2023-05-09 14:00:00', 9),
	(10, '1', '2023-05-10 00:00:00', '2023-05-17 00:00:00', '2023-05-10 14:00:00', 8),
	(11, '2', '2024-08-15 18:32:23', '2024-08-15 18:32:23', '2024-08-15 18:32:23', 6);

-- Listage de la structure de table sf-api-pressing. doctrine_migration_versions
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table sf-api-pressing.doctrine_migration_versions : ~8 rows (environ)
INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
	('DoctrineMigrations\\Version20240812161831', '2024-08-15 10:47:42', 183),
	('DoctrineMigrations\\Version20240813140635', '2024-08-15 10:47:42', 14),
	('DoctrineMigrations\\Version20240815101702', '2024-08-15 10:47:42', 29),
	('DoctrineMigrations\\Version20240815112331', '2024-08-15 11:23:45', 33),
	('DoctrineMigrations\\Version20240818140620', '2024-08-18 14:06:37', 37),
	('DoctrineMigrations\\Version20240818140909', '2024-08-18 14:09:15', 31),
	('DoctrineMigrations\\Version20240818141116', '2024-08-18 14:11:21', 39),
	('DoctrineMigrations\\Version20240818142938', '2024-08-18 14:29:49', 64);

-- Listage de la structure de table sf-api-pressing. employee
CREATE TABLE IF NOT EXISTS `employee` (
  `emp_number` varchar(255) DEFAULT NULL,
  `id` int NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_5D9F75A1BF396750` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table sf-api-pressing.employee : ~5 rows (environ)
INSERT INTO `employee` (`emp_number`, `id`) VALUES
	('183172', 1),
	('300460', 2),
	('911292', 3),
	('761476', 4),
	('866191', 5);

-- Listage de la structure de table sf-api-pressing. item
CREATE TABLE IF NOT EXISTS `item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `detail_item` longtext,
  `price` double NOT NULL,
  `quantity` smallint NOT NULL,
  `service_id` int DEFAULT NULL,
  `commande_id` int DEFAULT NULL,
  `item_status_id` int DEFAULT NULL,
  `employee_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1F1B251EED5CA9E6` (`service_id`),
  KEY `IDX_1F1B251E82EA2E54` (`commande_id`),
  KEY `IDX_1F1B251E672D164D` (`item_status_id`),
  KEY `IDX_1F1B251E8C03F15C` (`employee_id`),
  KEY `IDX_1F1B251E12469DE2` (`category_id`),
  CONSTRAINT `FK_1F1B251E12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `FK_1F1B251E672D164D` FOREIGN KEY (`item_status_id`) REFERENCES `item_status` (`id`),
  CONSTRAINT `FK_1F1B251E82EA2E54` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`id`),
  CONSTRAINT `FK_1F1B251E8C03F15C` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`),
  CONSTRAINT `FK_1F1B251EED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table sf-api-pressing.item : ~25 rows (environ)
INSERT INTO `item` (`id`, `detail_item`, `price`, `quantity`, `service_id`, `commande_id`, `item_status_id`, `employee_id`, `category_id`) VALUES
	(1, '<div>Rien a signalé</div>', 9.84, 5, 12, 2, 1, 4, 12),
	(2, ' Rien a signalé', 6.81, 5, 2, 3, 2, 3, 3),
	(3, '<div>Rien a signalé</div>', 14.26, 5, 1, 3, 1, 3, 9),
	(4, '<div>Rien a signalé</div>', 14.26, 5, 1, 3, 1, 3, 2),
	(6, '<div>Rien a signalé</div>', 14.26, 5, 1, 7, 1, 3, 2),
	(7, ' Rien a signalé', 14.26, 5, 1, 7, 3, 3, 2),
	(8, ' Rien a signalé', 14.26, 5, 1, 7, 3, 3, 2),
	(9, ' Rien a signalé', 14.26, 5, 1, 7, 3, 3, 2),
	(10, ' Rien a signalé', 14.26, 5, 1, 7, 3, 3, 2),
	(11, ' Rien a signalé', 14.26, 5, 1, 7, 3, 3, 2),
	(12, ' Rien a signalé', 14.26, 5, 1, 7, 3, 3, 2),
	(13, ' Rien a signalé', 14.26, 5, 1, 7, 3, 3, 2),
	(14, ' Rien a signalé', 14.26, 5, 1, 7, 3, 3, 2),
	(15, ' Rien a signalé', 14.26, 5, 1, 7, 3, 3, 2),
	(16, ' Rien a signalé', 14.26, 5, 1, 7, 3, 3, 2),
	(17, ' Rien a signalé', 14.26, 5, 1, 7, 3, 3, 2),
	(18, ' Rien a signalé', 14.26, 5, 1, 7, 3, 3, 2),
	(19, ' Rien a signalé', 14.26, 5, 1, 7, 3, 3, 2),
	(20, ' Rien a signalé', 14.26, 5, 1, 7, 3, 3, 2),
	(21, 'Rien\r\n', 10, 5, 2, 1, 1, NULL, 8),
	(22, 'Rien\r\n', 10, 5, 2, 1, 1, NULL, 8),
	(23, 'Rien\r\n', 10, 5, 2, 1, 1, NULL, 8),
	(24, 'Rien\r\n', 10, 5, 2, 1, 1, NULL, 8),
	(25, 'Rien\r\n', 10, 5, 2, 1, 1, NULL, 8),
	(26, 'Rien\r\n', 10, 5, 2, 1, 1, NULL, 8);

-- Listage de la structure de table sf-api-pressing. item_status
CREATE TABLE IF NOT EXISTS `item_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table sf-api-pressing.item_status : ~2 rows (environ)
INSERT INTO `item_status` (`id`, `name`) VALUES
	(1, 'En attente'),
	(2, 'En cours'),
	(3, 'Terminé');

-- Listage de la structure de table sf-api-pressing. service
CREATE TABLE IF NOT EXISTS `service` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` double DEFAULT NULL,
  `description` longtext,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table sf-api-pressing.service : ~20 rows (environ)
INSERT INTO `service` (`id`, `name`, `price`, `description`, `image`) VALUES
	(1, 'Nettoyage à sec', 16, 'Nettoyage à sec pour vêtements délicats.', 'nettoyage-a-sec.webp'),
	(2, 'Lavage et pliage', 11, 'Service de lavage, séchage et pliage.', 'lavage-pliage.webp'),
	(3, 'Repassage', 1000, 'Repassage professionnel pour vos vêtements.', 'repassage.png'),
	(4, 'Restauration de vêtement', 1000, 'Restauration et réparation de vêtements endommagés.', 'restauration-vetement.png'),
	(5, 'Traitement anti-tache', 12, 'Élimination des taches difficiles.', 'traitement_anti_tache.jpg'),
	(6, 'Imperméabilisation', 20, 'Services d\'imperméabilisation pour vêtements et tissus.', 'impermeabilisation.jpg'),
	(7, 'Teinture textile', 30, 'Teinture professionnelle pour changer ou restaurer la couleur.', 'teinture_textile.jpg'),
	(8, 'Nettoyage de tapis', 35, 'Nettoyage en profondeur de différents types de tapis.', 'nettoyage_tapis.jpg'),
	(9, 'Nettoyage de rideaux', 40, 'Nettoyage et rafraîchissement de rideaux.', 'nettoyage_rideaux.jpg'),
	(10, 'Nettoyage de cuir', 50, 'Soins spécialisés pour articles en cuir.', 'nettoyage_cuir.jpg'),
	(11, 'Nettoyage de daim', 55, 'Nettoyage et soin pour articles en daim.', 'nettoyage_daim.jpg'),
	(12, 'Lustrage de chaussures', 8, 'Lustrage professionnel pour chaussures.', 'lustrage_chaussures.jpg'),
	(13, 'Nettoyage de sacs à main', 45, 'Nettoyage et restauration de sacs à main.', 'nettoyage_sacs.jpg'),
	(14, 'Nettoyage de vêtements de sport', 18, 'Nettoyage spécialisé pour équipements sportifs.', 'nettoyage_sport.jpg'),
	(15, 'Nettoyage de fourrure', 70, 'Nettoyage délicat pour vêtements en fourrure.', 'nettoyage_fourrure.jpg'),
	(16, 'Services de blanchisserie pour hôtels', 100, 'Services de blanchisserie complets pour hôtels.', 'blanchisserie_hotels.jpg'),
	(17, 'Nettoyage de couettes et oreillers', 25, 'Nettoyage de couettes, oreillers et literie.', 'nettoyage_couettes.jpg'),
	(18, 'Nettoyage de robes de mariée', 150, 'Nettoyage et conservation de robes de mariée.', 'nettoyage_robes_mariée.jpg'),
	(19, 'Repassage de draps et nappes', 10, 'Repassage de draps, nappes et grandes pièces de linge.', 'repassage_draps.jpg'),
	(20, 'Désinfection et stérilisation', 20, 'Services de désinfection et stérilisation pour vêtements et textiles.', 'desinfection_sterilisation.jpg');

-- Listage de la structure de table sf-api-pressing. service_category
CREATE TABLE IF NOT EXISTS `service_category` (
  `service_id` int NOT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`service_id`,`category_id`),
  KEY `IDX_FF3A42FCED5CA9E6` (`service_id`),
  KEY `IDX_FF3A42FC12469DE2` (`category_id`),
  CONSTRAINT `FK_FF3A42FC12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_FF3A42FCED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table sf-api-pressing.service_category : ~18 rows (environ)
INSERT INTO `service_category` (`service_id`, `category_id`) VALUES
	(2, 5),
	(2, 11),
	(2, 18),
	(3, 16),
	(3, 17),
	(6, 6),
	(8, 12),
	(9, 13),
	(10, 7),
	(10, 10),
	(12, 4),
	(13, 14),
	(14, 2),
	(14, 3),
	(16, 8),
	(19, 15),
	(20, 1),
	(20, 9);

-- Listage de la structure de table sf-api-pressing. user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `mobilephone` varchar(13) DEFAULT NULL,
  `phone` varchar(13) DEFAULT NULL,
  `dateborn` date DEFAULT NULL,
  `numadrs` smallint DEFAULT NULL,
  `adrs` varchar(255) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `zipcode` varchar(6) DEFAULT NULL,
  `country` varchar(6) DEFAULT NULL,
  `discr` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table sf-api-pressing.user : ~11 rows (environ)
INSERT INTO `user` (`id`, `email`, `roles`, `password`, `firstname`, `lastname`, `mobilephone`, `phone`, `dateborn`, `numadrs`, `adrs`, `city`, `zipcode`, `country`, `discr`) VALUES
	(1, 'admin@gmail.com', '["ROLE_ADMIN"]', '$2y$13$7wIXoA6rmjKF96E7EPtKBeNdCNxeY0IxrJunO/lBAHPrVbLm8ZnYG', 'Jean', 'Dupont', '0612345678', '0156789012', '1985-10-15', 123, 'Rue de l\'Exemple', 'Limoges', '87000', 'France', 'employee'),
	(2, 'jane.doe@gmail.com', '["ROLE_EMPLOYEE"]', '$2y$13$v/yQMv.TmU9xMmu.L43uaOWWz9UcJ948K.2WeT28Uw2T.PNVEIE06', 'Jane', 'Doe', '0623456789', '0156789013', '1990-06-20', 456, 'Avenue des Champs', 'Paris', '75008', 'France', 'employee'),
	(3, 'john.smith@gmail.com', '["ROLE_EMPLOYEE"]', '$2y$13$pG1zp/C8HOM16a8FibvmLOUfb.IV.uSwiyAu1.bnByNFa8/KuVZYy', 'John', 'Smith', '0634567890', '0156789014', '1982-12-10', 789, 'Boulevard Saint-Germain', 'Paris', '75006', 'France', 'employee'),
	(4, 'lucy.liu@gmail.com', '["ROLE_EMPLOYEE"]', '$2y$13$lBz8AaxJ9i5kg4s7CSXL0eVKl9kg2rCRNqqGC/Mm18naeO3ToLplC', 'Lucy', 'Liu', '0645678901', '0156789015', '1995-04-25', 101, 'Rue de Rivoli', 'Paris', '75004', 'France', 'employee'),
	(5, 'marc.johnson@gmail.com', '["ROLE_ADMIN"]', '$2y$13$ohOcj.durL9Bu2MZFqzuiOEC62B.vS6J7yEMHnnxC.xL0FjbhR512', 'Marc', 'Johnson', '0656789012', '0156789016', '1987-07-30', 202, 'Rue de la Paix', 'Nice', '06000', 'France', 'employee'),
	(6, 'emma.wilson@gmail.com', '["ROLE_CLIENT"]', '$2y$13$42lU3M/pQaBWEgyCfDaITezUBK.9lzfY0c9Mbm1RqXmw7WwBHJ/dC', 'Emma', 'Wilson', '0667890123', '0156789017', '1992-09-15', 303, 'Avenue Jean Médecin', 'Nice', '06000', 'France', 'client'),
	(7, 'noah.brown@gmail.com', '["ROLE_CLIENT"]', '$2y$13$QOjrco9q41g45bAZ3JZ7Wu3Pe4gxfeXqgbxgYjuXmgPn0uYZSj4I.', 'Noah', 'Brown', '0678901234', '0156789018', '1983-11-20', 404, 'Cours Saleya', 'Nice', '06000', 'France', 'client'),
	(8, 'olivia.martin@gmail.com', '["ROLE_CLIENT"]', '$2y$13$JDmW5I9Kf8bhWn32SbzWQe61SD23awTZnHwzjzl11nVkcnqImIEYq', 'Olivia', 'Martin', '0689012345', '0156789019', '1991-01-10', 505, 'Rue Massena', 'Nice', '06000', 'France', 'client'),
	(9, 'liam.davis@gmail.com', '["ROLE_CLIENT"]', '$2y$13$P/hf.MGS0jwaWd7v4ieY6OXcTKcFjGp26v4ppUhgE966C1fmcijHS', 'Liam', 'Davis', '0690123456', '0156789020', '1986-03-05', 606, 'Boulevard Gambetta', 'Lyon', '69001', 'France', 'client'),
	(10, 'sophia2.moore@gmail.com', '{"1": "ROLE_EMPLOYEE"}', '$2y$13$965GfiEr7nD15WoWG5vqFufd4Wfir72/P7aIuG4SHR/YVwTguWSky', 'Sophia', 'Moore', '0612345678', '0156789021', '1988-05-25', 707, 'Place Bellecour', 'Lyon', '69002', 'France', 'client'),
	(22, 'anthony@gmail.com', '["ROLE_CLIENT"]', '$2y$13$Wzouj4m3wDsTmP2jxaSuyeuEMJVlX6qQBZInzdfMiTGrzCtVsa6g6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'client');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

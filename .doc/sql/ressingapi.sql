-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE = @@TIME_ZONE */;
/*!40103 SET TIME_ZONE = '+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0 */;
/*!40101 SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES = @@SQL_NOTES, SQL_NOTES = 0 */;


-- Listage de la structure de la base pour bcapipressing
CREATE DATABASE IF NOT EXISTS `bcapipressing` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION = 'N' */;
USE `bcapipressing`;

-- Listage de la structure de table bcapipressing. article
CREATE TABLE IF NOT EXISTS `article`
(
    `id`          int         NOT NULL AUTO_INCREMENT,
    `name`        varchar(50) NOT NULL,
    `urlimage`    varchar(255) DEFAULT NULL,
    `category_id` int         NOT NULL,
    PRIMARY KEY (`id`),
    KEY `IDX_23A0E6612469DE2` (`category_id`),
    CONSTRAINT `FK_23A0E6612469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

-- Listage des données de la table bcapipressing.article : ~0 rows (environ)

-- Listage de la structure de table bcapipressing. category
CREATE TABLE IF NOT EXISTS `category`
(
    `id`        int         NOT NULL AUTO_INCREMENT,
    `name`      varchar(50) NOT NULL,
    `parent_id` int DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `IDX_64C19C1727ACA70` (`parent_id`),
    CONSTRAINT `FK_64C19C1727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

-- Listage des données de la table bcapipressing.category : ~0 rows (environ)

-- Listage de la structure de table bcapipressing. commande
CREATE TABLE IF NOT EXISTS `commande`
(
    `id`               int         NOT NULL AUTO_INCREMENT,
    `ref`              varchar(10) NOT NULL,
    `filing_date`      date        NOT NULL,
    `return_date`      date        NOT NULL,
    `payment_date`     date        NOT NULL,
    `user_id`          int DEFAULT NULL,
    `means_payment_id` int         NOT NULL,
    PRIMARY KEY (`id`),
    KEY `IDX_6EEAA67DA76ED395` (`user_id`),
    KEY `IDX_6EEAA67D17157679` (`means_payment_id`),
    CONSTRAINT `FK_6EEAA67D17157679` FOREIGN KEY (`means_payment_id`) REFERENCES `meansofpayment` (`id`),
    CONSTRAINT `FK_6EEAA67DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

-- Listage des données de la table bcapipressing.commande : ~0 rows (environ)

-- Listage de la structure de table bcapipressing. doctrine_migration_versions
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions`
(
    `version`        varchar(191) NOT NULL,
    `executed_at`    datetime DEFAULT NULL,
    `execution_time` int      DEFAULT NULL,
    PRIMARY KEY (`version`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

-- Listage des données de la table bcapipressing.doctrine_migration_versions : ~1 rows (environ)
INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`)
VALUES ('DoctrineMigrations\\Version20240622205340', '2024-06-22 20:53:55', 245);

-- Listage de la structure de table bcapipressing. item
CREATE TABLE IF NOT EXISTS `item`
(
    `id`                int NOT NULL AUTO_INCREMENT,
    `detail_item`       longtext,
    `article_id`        int NOT NULL,
    `service_id`        int NOT NULL,
    `material_id`       int NOT NULL,
    `user_id`           int NOT NULL,
    `item_etat_id`      int NOT NULL,
    `commande_id`       int NOT NULL,
    `service_status_id` int NOT NULL,
    PRIMARY KEY (`id`),
    KEY `IDX_1F1B251E7294869C` (`article_id`),
    KEY `IDX_1F1B251EED5CA9E6` (`service_id`),
    KEY `IDX_1F1B251EE308AC6F` (`material_id`),
    KEY `IDX_1F1B251EA76ED395` (`user_id`),
    KEY `IDX_1F1B251E603A0AB` (`item_etat_id`),
    KEY `IDX_1F1B251E82EA2E54` (`commande_id`),
    KEY `IDX_1F1B251E33663AF7` (`service_status_id`),
    CONSTRAINT `FK_1F1B251E33663AF7` FOREIGN KEY (`service_status_id`) REFERENCES `service_status` (`id`),
    CONSTRAINT `FK_1F1B251E603A0AB` FOREIGN KEY (`item_etat_id`) REFERENCES `item_etat` (`id`),
    CONSTRAINT `FK_1F1B251E7294869C` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`),
    CONSTRAINT `FK_1F1B251E82EA2E54` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`id`),
    CONSTRAINT `FK_1F1B251EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
    CONSTRAINT `FK_1F1B251EE308AC6F` FOREIGN KEY (`material_id`) REFERENCES `material` (`id`),
    CONSTRAINT `FK_1F1B251EED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

-- Listage des données de la table bcapipressing.item : ~0 rows (environ)

-- Listage de la structure de table bcapipressing. item_etat
CREATE TABLE IF NOT EXISTS `item_etat`
(
    `id`    int          NOT NULL AUTO_INCREMENT,
    `name`  varchar(100) NOT NULL,
    `coeff` double       NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

-- Listage des données de la table bcapipressing.item_etat : ~0 rows (environ)

-- Listage de la structure de table bcapipressing. material
CREATE TABLE IF NOT EXISTS `material`
(
    `id`    int          NOT NULL AUTO_INCREMENT,
    `name`  varchar(100) NOT NULL,
    `coeff` double       NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

-- Listage des données de la table bcapipressing.material : ~0 rows (environ)

-- Listage de la structure de table bcapipressing. meansofpayment
CREATE TABLE IF NOT EXISTS `meansofpayment`
(
    `id`   int          NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

-- Listage des données de la table bcapipressing.meansofpayment : ~0 rows (environ)

-- Listage de la structure de table bcapipressing. service
CREATE TABLE IF NOT EXISTS `service`
(
    `id`          int          NOT NULL AUTO_INCREMENT,
    `name`        varchar(100) NOT NULL,
    `price`       double       NOT NULL,
    `description` longtext,
    `image`       varchar(255) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

-- Listage des données de la table bcapipressing.service : ~0 rows (environ)

-- Listage de la structure de table bcapipressing. service_status
CREATE TABLE IF NOT EXISTS `service_status`
(
    `id`   int          NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

-- Listage des données de la table bcapipressing.service_status : ~0 rows (environ)

-- Listage de la structure de table bcapipressing. user
CREATE TABLE IF NOT EXISTS `user`
(
    `id`          int          NOT NULL AUTO_INCREMENT,
    `email`       varchar(180) NOT NULL,
    `roles`       json         NOT NULL,
    `password`    varchar(255) NOT NULL,
    `firstname`   varchar(100) NOT NULL,
    `lastname`    varchar(100) NOT NULL,
    `mobilephone` varchar(13) DEFAULT NULL,
    `phone`       varchar(13) DEFAULT NULL,
    `pwd`         varchar(255) NOT NULL,
    `dateborn`    date        DEFAULT NULL,
    `numadrs`     smallint     NOT NULL,
    `adrs`        varchar(255) NOT NULL,
    `city`        varchar(50)  NOT NULL,
    `zipcode`     varchar(6)   NOT NULL,
    `country`     varchar(6)   NOT NULL,
    `created_at`  datetime     NOT NULL,
    `update_at`   datetime     NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

-- Listage des données de la table bcapipressing.user : ~0 rows (environ)

/*!40103 SET TIME_ZONE = IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE = IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS = IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES = IFNULL(@OLD_SQL_NOTES, 1) */;

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


-- Listage de la structure de la base pour sf-api-pressing
CREATE DATABASE IF NOT EXISTS `sf-api-pressing` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION = 'N' */;
USE `sf-api-pressing`;

-- Listage de la structure de table sf-api-pressing. category
CREATE TABLE IF NOT EXISTS `category`
(
    `id`        int         NOT NULL AUTO_INCREMENT,
    `name`      varchar(50) NOT NULL,
    `image`     varchar(255) DEFAULT NULL,
    `parent_id` int          DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `IDX_64C19C1727ACA70` (`parent_id`),
    CONSTRAINT `FK_64C19C1727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 19
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table sf-api-pressing. client
CREATE TABLE IF NOT EXISTS `client`
(
    `client_number` varchar(255) NOT NULL,
    `premium`       tinyint(1) DEFAULT NULL,
    `id`            int          NOT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `FK_C7440455BF396750` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table sf-api-pressing. commande
CREATE TABLE IF NOT EXISTS `commande`
(
    `id`           int         NOT NULL AUTO_INCREMENT,
    `ref`          varchar(10) NOT NULL,
    `filing_date`  datetime    NOT NULL,
    `return_date`  datetime    NOT NULL,
    `payment_date` datetime    NOT NULL,
    `client_id`    int DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `IDX_6EEAA67D19EB6921` (`client_id`),
    CONSTRAINT `FK_6EEAA67D19EB6921` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 12
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table sf-api-pressing. doctrine_migration_versions
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions`
(
    `version`        varchar(191) NOT NULL,
    `executed_at`    datetime DEFAULT NULL,
    `execution_time` int      DEFAULT NULL,
    PRIMARY KEY (`version`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table sf-api-pressing. employee
CREATE TABLE IF NOT EXISTS `employee`
(
    `emp_number` varchar(255) DEFAULT NULL,
    `id`         int NOT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `FK_5D9F75A1BF396750` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table sf-api-pressing. item
CREATE TABLE IF NOT EXISTS `item`
(
    `id`             int      NOT NULL AUTO_INCREMENT,
    `detail_item`    longtext,
    `price`          double   NOT NULL,
    `quantity`       smallint NOT NULL,
    `service_id`     int      NOT NULL,
    `commande_id`    int      NOT NULL,
    `item_status_id` int      NOT NULL,
    `employee_id`    int DEFAULT NULL,
    `category_id`    int DEFAULT NULL,
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
) ENGINE = InnoDB
  AUTO_INCREMENT = 27
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table sf-api-pressing. item_status
CREATE TABLE IF NOT EXISTS `item_status`
(
    `id`   int          NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 4
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table sf-api-pressing. service
CREATE TABLE IF NOT EXISTS `service`
(
    `id`          int          NOT NULL AUTO_INCREMENT,
    `name`        varchar(100) NOT NULL,
    `price`       double       NOT NULL,
    `description` longtext,
    `image`       varchar(255) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 21
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table sf-api-pressing. service_category
CREATE TABLE IF NOT EXISTS `service_category`
(
    `service_id`  int NOT NULL,
    `category_id` int NOT NULL,
    PRIMARY KEY (`service_id`, `category_id`),
    KEY `IDX_FF3A42FCED5CA9E6` (`service_id`),
    KEY `IDX_FF3A42FC12469DE2` (`category_id`),
    CONSTRAINT `FK_FF3A42FC12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
    CONSTRAINT `FK_FF3A42FCED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table sf-api-pressing. user
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
    `dateborn`    date        DEFAULT NULL,
    `numadrs`     smallint     NOT NULL,
    `adrs`        varchar(255) NOT NULL,
    `city`        varchar(50)  NOT NULL,
    `zipcode`     varchar(6)   NOT NULL,
    `country`     varchar(6)   NOT NULL,
    `discr`       varchar(255) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 11
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

/*!40103 SET TIME_ZONE = IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE = IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS = IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES = IFNULL(@OLD_SQL_NOTES, 1) */;

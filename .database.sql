--DROP DATABASE `dev_atlsoftware`;

CREATE DATABASE `dev_atlsoftware` /*!40100 COLLATE 'utf8mb4_unicode_ci' */

USE `dev_atlsoftware`;

CREATE TABLE `dev_atlsoftware`.`Contacts` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(250) NOT NULL,
	`lastname` VARCHAR(250) NULL DEFAULT NULL,
	`email` VARCHAR(100) NULL DEFAULT NULL,
	`created_at` DATETIME NOT NULL,
	`updated_at` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	CONSTRAINT `UC_Email` UNIQUE (`email`)
)
COLLATE='utf8mb4_unicode_ci'
;

CREATE TABLE `dev_atlsoftware`.`phones` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`contact_id` INT NOT NULL,
	`code` INT(4) NULL DEFAULT NULL,
	`number` INT(11) NOT NULL,
	`ext` INT(4) NULL DEFAULT NULL,
	`created_at` DATETIME NOT NULL,
	`updated_at` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	CONSTRAINT `FK1_Contact_id` FOREIGN KEY (`contact_id`) REFERENCES `dev_atlsoftware`.`contacts` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
)
COLLATE='utf8mb4_unicode_ci'
;

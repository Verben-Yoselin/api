-- CREATE DATABASE db_verben;
USE db_verben;

DROP TABLE IF EXISTS `order_detail` CASCADE;
DROP TABLE IF EXISTS `orders` CASCADE;
DROP TABLE IF EXISTS `products` CASCADE;
DROP TABLE IF EXISTS `category_products` CASCADE;
DROP TABLE IF EXISTS `clients` CASCADE;
DROP TABLE IF EXISTS `users` CASCADE;
DROP TABLE IF EXISTS `persons` CASCADE;

SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `persons`
(
	`id` BIGINT NOT NULL PRIMARY KEY,
	`name` VARCHAR(50) NOT NULL,
	`pat_surname` VARCHAR(50) NULL,
	`mat_surname` VARCHAR(50) NULL,
	`fullname` VARCHAR(152) NULL, -- calculated
	`ci` BIGINT NOT NULL UNIQUE,
	`birthdate` DATE NULL,
	`phone_number` BIGINT NULL,
	`direction` TEXT NULL,
	`coordinates` TEXT NULL, -- json
	`url_picture` VARCHAR(200) NULL
);

CREATE TABLE `users`
(
    `id` BIGINT NOT NULL,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `email_verified_at` TIMESTAMP NULL,
    `password` VARCHAR(255) NOT NULL,
    `remember_token` VARCHAR(100) NULL,
    PRIMARY KEY(`id`),
    FOREIGN KEY (`id`) REFERENCES `persons`(`id`) ON DELETE CASCADE
);

CREATE TABLE `clients`
(
    `id` BIGINT NOT NULL,
    `join_date_time` DATETIME NOT NULL,
    PRIMARY KEY(`id`),
    FOREIGN KEY (`id`) REFERENCES `persons`(`id`) ON DELETE CASCADE
);

CREATE TABLE `category_products`
(
	`id` BIGINT NOT NULL PRIMARY KEY,
	`name` VARCHAR(128) NOT NULL,
	`description` TEXT NULL
);

CREATE TABLE `products`
(
	`id` BIGINT NOT NULL PRIMARY KEY,
	`name` VARCHAR(128) NOT NULL,
	`description` TEXT NULL,
	`url_picture` VARCHAR(200) NULL,
	`category_id` BIGINT NOT NULL,
	`stock` BIGINT NULL,
	FOREIGN KEY (`category_id`) REFERENCES `category_products`(`id`) ON DELETE RESTRICT
);

CREATE TABLE `orders`
(
	`id` BIGINT NOT NULL PRIMARY KEY,
	`date_time` DATETIME NOT NULL,
	`client_id` BIGINT NOT NULL,
	`vendor_id` BIGINT NOT NULL,
	`total` BIGINT NULL, -- calculated
	FOREIGN KEY (`client_id`) REFERENCES `clients`(`id`) ON DELETE CASCADE,
	FOREIGN KEY (`vendor_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
);

CREATE TABLE `order_detail`
(
	`order_id` BIGINT NOT NULL,
	`product_id` BIGINT NOT NULL,
	`amount` BIGINT NOT NULL,
	`price` BIGINT NOT NULL,
	 PRIMARY KEY(`order_id`, `product_id`),
	 FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE,
	 FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE RESTRICT
);

SET FOREIGN_KEY_CHECKS=1;


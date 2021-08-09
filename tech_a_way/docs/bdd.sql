-- Adminer 4.8.1 MySQL 8.0.26-0ubuntu0.20.04.2 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` int NOT NULL,
  `city` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_id` int NOT NULL,
  `delivery` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D4E6F81A76ED395` (`user_id`),
  CONSTRAINT `FK_D4E6F81A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `address` (`id`, `type`, `street`, `zipcode`, `city`, `created_at`, `updated_at`, `user_id`, `delivery`) VALUES
(1,	'Livraison',	'15 rue de la Beauce',	45000,	'Orléans',	'2021-08-03 15:12:48',	'2021-08-03 15:12:48',	1,	NULL),
(2,	'Facturation',	'3 rue Montmartre',	75015,	'PARIS',	'2021-08-03 15:13:25',	'2021-08-03 15:13:25',	2,	NULL),
(3,	'Livraison',	'5 rue Marie Currie',	28000,	'Chartres',	'2021-08-03 15:17:01',	'2021-08-03 15:17:01',	6,	NULL),
(4,	'Facturation',	'15 rue de la Courneuve',	78990,	'Elancourt',	'2021-08-03 15:18:35',	'2021-08-03 15:18:35',	8,	NULL),
(5,	'Livraison',	'15 rue de la Courneuve',	78990,	'Elancourt',	'2021-08-03 15:18:35',	'2021-08-03 15:18:35',	8,	NULL),
(7,	'Facturation',	'25 rue du Sapin',	75020,	'Paris',	'2021-08-05 04:52:34',	'2021-08-05 04:52:34',	3,	NULL),
(8,	'Livraison',	'25 rue du Sapin',	75020,	'Paris',	'2021-08-05 04:52:54',	'2021-08-05 04:52:54',	3,	NULL),
(9,	'Facturation',	'2 rue des petits Pres',	78000,	'Versailles',	'2021-08-05 08:57:44',	'2021-08-05 08:57:44',	9,	NULL),
(10,	'Livraison',	'2 rue des petits Pres',	78000,	'Versailles',	'2021-08-05 08:57:44',	'2021-08-05 08:57:44',	9,	NULL),
(11,	'Facturation',	'26 rue Jacob',	75020,	'Paris',	'2021-08-05 10:35:44',	'2021-08-05 10:35:44',	10,	NULL),
(12,	'Livraison',	'15 rue Gaston',	75018,	'Paris',	'2021-08-05 10:35:44',	'2021-08-05 10:35:44',	10,	NULL),
(13,	'Facturation',	'15 rue titi',	75015,	'Paris',	'2021-08-05 12:16:52',	'2021-08-05 12:16:52',	11,	NULL),
(14,	'Livraison',	'15 rue toto',	75015,	'Paris',	'2021-08-05 12:16:52',	'2021-08-05 12:16:52',	11,	NULL),
(15,	'Livraison',	'ssddsds',	78120,	'sddsds',	'2021-08-09 07:09:15',	'2021-08-09 07:09:15',	2,	'Relais colis'),
(16,	'Facturation',	'marielller',	35270,	'breisue',	'2021-08-09 07:54:53',	'2021-08-09 07:54:53',	5,	NULL),
(17,	'Livraison',	'lqkjdhf',	35080,	'dsdf',	'2021-08-09 07:55:14',	'2021-08-09 07:55:14',	5,	NULL),
(18,	'Facturation',	'15 RUE JJ',	45700,	'Nantes',	'2021-08-09 08:25:55',	'2021-08-09 08:25:55',	12,	NULL),
(19,	'Livraison',	'15 RUE JJ',	45700,	'Nantes',	'2021-08-09 08:25:55',	'2021-08-09 08:25:55',	12,	NULL);

DROP TABLE IF EXISTS `brand`;
CREATE TABLE `brand` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `brand` (`id`, `name`, `logo`, `created_at`, `updated_at`) VALUES
(1,	'Acer',	'acer-61093a7c1aeb3.png',	'2021-08-03 14:45:48',	'2021-08-03 14:45:48'),
(2,	'Apple',	'apple-61093a8bec359.jpg',	'2021-08-03 14:46:03',	'2021-08-03 14:46:03'),
(3,	'Asus',	'asus-61093a9689dfc.png',	'2021-08-03 14:46:14',	'2021-08-03 14:46:14'),
(4,	'Dell',	'dell-61093aa09ae2e.png',	'2021-08-03 14:46:24',	'2021-08-03 14:46:24'),
(5,	'LG',	'lg-61093aa9ddbed.jpg',	'2021-08-03 14:46:33',	'2021-08-03 14:46:33'),
(6,	'Nokia',	'nokia-61093ab3d1310.png',	'2021-08-03 14:46:43',	'2021-08-03 14:46:43'),
(7,	'Panasonic',	'panasonic-61093abf1ca91.png',	'2021-08-03 14:46:55',	'2021-08-03 14:46:55'),
(8,	'Philips',	'philips-61093ac877745.png',	'2021-08-03 14:47:04',	'2021-08-03 14:47:04'),
(9,	'Samsung',	'samsung-61093aef1a612.png',	'2021-08-03 14:47:43',	'2021-08-03 14:47:43'),
(10,	'Sony',	'sony-61093af9c8c57.jpg',	'2021-08-03 14:47:53',	'2021-08-03 14:47:53'),
(11,	'Toshiba',	'toshiba-61093b0414592.jpg',	'2021-08-03 14:48:04',	'2021-08-03 14:48:04'),
(12,	'Xiaomi',	'xiaomi-61093b0d62c45.png',	'2021-08-03 14:48:13',	'2021-08-03 14:48:13'),
(13,	'Logitech',	'logitech-610b362ab54e7.png',	'2021-08-05 02:51:54',	'2021-08-05 02:51:54'),
(14,	'JBL',	'JBL-610b37b636764.png',	'2021-08-05 02:58:30',	'2021-08-05 02:58:30'),
(15,	'Ryzen',	'Ryzen-610b3c2e3c86d.jpg',	'2021-08-05 03:17:34',	'2021-08-05 03:17:34'),
(16,	'Tp-Link',	'tplink-610b4102a2309.jpg',	'2021-08-05 03:38:10',	'2021-08-05 03:38:10'),
(17,	'Epson',	'Epson-Logo-610b4337a5efa.png',	'2021-08-05 03:47:35',	'2021-08-05 03:47:35'),
(18,	'Hp',	'hp-610bbb65d5d6f.png',	'2021-08-05 12:20:21',	'2021-08-05 12:20:21');

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_64C19C112469DE2` (`category_id`),
  CONSTRAINT `FK_64C19C112469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `category` (`id`, `name`, `subtitle`, `picture`, `created_at`, `updated_at`, `category_id`) VALUES
(16,	'Son/Image',	NULL,	NULL,	'2021-08-01 15:35:07',	'2021-08-01 15:35:07',	NULL),
(17,	'Informatique',	NULL,	NULL,	'2021-08-01 15:35:50',	'2021-08-01 15:35:50',	NULL),
(18,	'Objets Connectés',	NULL,	NULL,	'2021-08-01 15:36:06',	'2021-08-01 15:36:06',	NULL),
(19,	'Téléphonie',	NULL,	NULL,	'2021-08-01 15:36:17',	'2021-08-01 15:36:17',	NULL),
(20,	'Périphériques',	NULL,	NULL,	'2021-08-01 15:36:39',	'2021-08-01 15:36:39',	17),
(25,	'Portables',	NULL,	NULL,	'2021-08-01 16:24:57',	'2021-08-01 16:24:57',	17),
(26,	'Ordinateurs fixes',	NULL,	NULL,	'2021-08-01 16:25:14',	'2021-08-01 16:25:14',	17),
(27,	'Ecrans PC',	NULL,	NULL,	'2021-08-01 16:25:28',	'2021-08-01 16:25:28',	20),
(28,	'Clavier/Souris',	NULL,	NULL,	'2021-08-01 16:25:40',	'2021-08-01 16:25:40',	20),
(29,	'Disques durs',	NULL,	NULL,	'2021-08-01 16:25:56',	'2021-08-01 16:25:56',	20),
(30,	'Imprimante/Scanner',	NULL,	NULL,	'2021-08-01 16:26:12',	'2021-08-01 16:26:12',	20),
(31,	'port-Neuf',	NULL,	NULL,	'2021-08-01 16:26:45',	'2021-08-01 16:26:45',	25),
(32,	'port-Reconditionné',	NULL,	NULL,	'2021-08-01 16:26:59',	'2021-08-01 16:26:59',	25),
(33,	'port-Station d\'accueil',	NULL,	NULL,	'2021-08-01 16:27:15',	'2021-08-01 16:27:15',	25),
(34,	'port-Sacoches',	NULL,	NULL,	'2021-08-01 16:27:27',	'2021-08-01 16:27:27',	25),
(35,	'ordi-Neuf',	NULL,	NULL,	'2021-08-01 16:28:03',	'2021-08-01 16:28:03',	26),
(36,	'ordi-Reconditionné',	NULL,	NULL,	'2021-08-01 16:28:12',	'2021-08-01 16:28:12',	26),
(37,	'Tours',	NULL,	NULL,	'2021-08-01 16:28:29',	'2021-08-01 16:28:29',	26),
(38,	'Maison',	NULL,	NULL,	'2021-08-01 16:29:05',	'2021-08-01 16:29:05',	18),
(39,	'Sport',	NULL,	NULL,	'2021-08-01 16:29:20',	'2021-08-01 16:29:20',	18),
(40,	'Sécurité',	NULL,	NULL,	'2021-08-01 16:29:55',	'2021-08-01 16:29:55',	18),
(41,	'Ampoules Connectées',	NULL,	NULL,	'2021-08-01 16:30:17',	'2021-08-01 16:30:17',	38),
(42,	'Prises connectées',	NULL,	NULL,	'2021-08-01 16:30:36',	'2021-08-01 16:30:36',	38),
(43,	'Aspirateurs connectés',	NULL,	NULL,	'2021-08-01 16:31:02',	'2021-08-01 16:31:02',	38),
(44,	'Montres connectées',	NULL,	NULL,	'2021-08-01 16:31:17',	'2021-08-01 16:31:17',	39),
(45,	'Drones',	NULL,	NULL,	'2021-08-01 16:31:36',	'2021-08-01 16:31:36',	39),
(46,	'Balance connectée',	NULL,	NULL,	'2021-08-01 16:31:50',	'2021-08-01 16:31:50',	39),
(47,	'Caméras de surveillance',	NULL,	NULL,	'2021-08-01 16:32:27',	'2021-08-01 16:32:27',	40),
(48,	'Alarme',	NULL,	NULL,	'2021-08-01 16:32:42',	'2021-08-01 16:32:42',	40),
(49,	'Traitement de l\'air',	NULL,	NULL,	'2021-08-01 16:32:59',	'2021-08-01 16:32:59',	38),
(50,	'Détecteurs de fumée',	NULL,	NULL,	'2021-08-01 16:33:19',	'2021-08-01 16:33:19',	40),
(51,	'Interphones connectés',	NULL,	NULL,	'2021-08-01 16:33:43',	'2021-08-01 16:33:43',	40),
(52,	'Mobiles',	NULL,	NULL,	'2021-08-01 16:33:55',	'2021-08-01 16:33:55',	19),
(53,	'Fixes',	NULL,	NULL,	'2021-08-01 16:34:05',	'2021-08-01 16:34:05',	19),
(54,	'Smartphones neufs',	NULL,	NULL,	'2021-08-01 16:34:23',	'2021-08-01 16:34:23',	52),
(55,	'Smartphones reconditionnés',	NULL,	NULL,	'2021-08-01 16:34:55',	'2021-08-01 16:34:55',	52),
(56,	'Protection',	NULL,	NULL,	'2021-08-01 16:35:21',	'2021-08-01 16:35:21',	52),
(57,	'Chargeurs/Cables',	NULL,	NULL,	'2021-08-01 16:35:35',	'2021-08-01 16:35:35',	16),
(58,	'Sans fil',	NULL,	NULL,	'2021-08-01 16:38:48',	'2021-08-01 16:38:48',	53),
(59,	'Filaires',	NULL,	NULL,	'2021-08-01 16:39:01',	'2021-08-01 16:39:01',	53),
(60,	'Son',	NULL,	NULL,	'2021-08-01 16:39:40',	'2021-08-01 16:39:40',	16),
(61,	'Images',	NULL,	NULL,	'2021-08-01 16:39:47',	'2021-08-01 16:39:47',	16),
(62,	'Homecinema',	NULL,	NULL,	'2021-08-01 16:40:33',	'2021-08-01 16:40:33',	60),
(63,	'Barres de son',	NULL,	NULL,	'2021-08-01 16:40:56',	'2021-08-01 16:40:56',	60),
(64,	'Enceintes',	NULL,	NULL,	'2021-08-01 16:41:27',	'2021-08-01 16:41:27',	60),
(65,	'Casques/Ecouteurs',	NULL,	NULL,	'2021-08-01 16:41:45',	'2021-08-01 16:41:45',	60),
(66,	'Télévisions',	NULL,	NULL,	'2021-08-01 16:42:05',	'2021-08-01 16:42:05',	61),
(67,	'Vidéoprojecteurs',	NULL,	NULL,	'2021-08-01 16:42:20',	'2021-08-01 16:42:20',	61),
(68,	'Caméras',	NULL,	NULL,	'2021-08-01 16:42:48',	'2021-08-01 16:42:48',	61),
(69,	'Photo',	NULL,	NULL,	'2021-08-01 16:42:58',	'2021-08-01 16:42:58',	61),
(70,	'Accessoires',	NULL,	NULL,	'2021-08-05 12:21:12',	'2021-08-05 12:21:12',	17);

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210721103629',	'2021-07-31 11:59:52',	23),
('DoctrineMigrations\\Version20210721120600',	'2021-07-31 11:59:52',	4),
('DoctrineMigrations\\Version20210721121823',	'2021-07-31 11:59:52',	4),
('DoctrineMigrations\\Version20210721122948',	'2021-07-31 11:59:52',	4),
('DoctrineMigrations\\Version20210721123330',	'2021-07-31 11:59:52',	3),
('DoctrineMigrations\\Version20210721124226',	'2021-07-31 11:59:52',	4),
('DoctrineMigrations\\Version20210721124813',	'2021-07-31 11:59:52',	510),
('DoctrineMigrations\\Version20210721125130',	'2021-07-31 11:59:53',	17),
('DoctrineMigrations\\Version20210721125653',	'2021-07-31 11:59:53',	4),
('DoctrineMigrations\\Version20210721125936',	'2021-07-31 11:59:53',	4),
('DoctrineMigrations\\Version20210721151631',	'2021-07-31 11:59:53',	14),
('DoctrineMigrations\\Version20210721160532',	'2021-07-31 11:59:53',	13),
('DoctrineMigrations\\Version20210721164416',	'2021-07-31 11:59:53',	284),
('DoctrineMigrations\\Version20210721174621',	'2021-07-31 11:59:53',	15),
('DoctrineMigrations\\Version20210721181728',	'2021-07-31 11:59:53',	14),
('DoctrineMigrations\\Version20210721182554',	'2021-07-31 11:59:53',	14),
('DoctrineMigrations\\Version20210721203856',	'2021-07-31 11:59:53',	14),
('DoctrineMigrations\\Version20210721204257',	'2021-07-31 11:59:53',	16),
('DoctrineMigrations\\Version20210721204835',	'2021-07-31 11:59:53',	515),
('DoctrineMigrations\\Version20210723102925',	'2021-07-31 11:59:54',	21),
('DoctrineMigrations\\Version20210725105058',	'2021-07-31 11:59:54',	15),
('DoctrineMigrations\\Version20210727123211',	'2021-07-31 11:59:54',	8),
('DoctrineMigrations\\Version20210727175029',	'2021-07-31 11:59:54',	1),
('DoctrineMigrations\\Version20210730131941',	'2021-07-31 11:59:54',	337),
('DoctrineMigrations\\Version20210808123542',	'2021-08-08 18:45:31',	48);

DROP TABLE IF EXISTS `mode_of_payment`;
CREATE TABLE `mode_of_payment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `mode_of_payment` (`id`, `type`) VALUES
(1,	'American Express'),
(3,	'Bitcoin'),
(4,	'Paypal'),
(5,	'Mastercard'),
(6,	'Visa Electron'),
(7,	'Visa');

DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type_delivery` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `street_delivery` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode_delivery` int NOT NULL,
  `city_delivery` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `street_bill` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode_bill` int NOT NULL,
  `city_bill` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status_id` int NOT NULL,
  `mode_of_payment_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F52993986BF700BD` (`status_id`),
  KEY `IDX_F5299398C9A9CD82` (`mode_of_payment_id`),
  KEY `IDX_F5299398A76ED395` (`user_id`),
  CONSTRAINT `FK_F52993986BF700BD` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `FK_F5299398A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_F5299398C9A9CD82` FOREIGN KEY (`mode_of_payment_id`) REFERENCES `mode_of_payment` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `order` (`id`, `type_delivery`, `street_delivery`, `zipcode_delivery`, `city_delivery`, `street_bill`, `zipcode_bill`, `city_bill`, `created_at`, `updated_at`, `status_id`, `mode_of_payment_id`, `user_id`) VALUES
(1,	'Chronopost',	'15 rue de la Beauce',	45000,	'Orléans',	'15 rue de la Beauce',	45000,	'Orléans',	'2021-08-05 04:36:09',	NULL,	2,	5,	1),
(2,	'Colissimo',	'15 rue de la Courneuve',	78990,	'Elancourt',	'15 rue de la Courneuve',	78990,	'Elancourt',	'2021-08-05 04:41:35',	NULL,	3,	6,	8),
(3,	'Chronopost',	'15 rue de la Courneuve',	78990,	'Elancourt',	'15 rue de la Courneuve',	78990,	'Elancourt',	'2021-08-05 04:44:37',	NULL,	3,	4,	8),
(4,	'Colissimo',	'15 rue de la Courneuve',	78990,	'Elancourt',	'15 rue de la Courneuve',	78990,	'Elancourt',	'2021-08-05 04:48:23',	NULL,	2,	3,	8),
(5,	'Relais colis',	'ssddsds',	78120,	'sddsds',	'3 rue Montmartre',	75015,	'PARIS',	'2021-08-09 07:09:39',	'2021-08-09 07:09:39',	1,	4,	2),
(6,	'Colissimo',	'lqkjdhf',	35080,	'dsdf',	'marielller',	35270,	'breisue',	'2021-08-09 07:55:22',	'2021-08-09 07:55:22',	1,	3,	5);

DROP TABLE IF EXISTS `order_line`;
CREATE TABLE `order_line` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `excl_taxes_unit_price` double NOT NULL,
  `sales_tax` smallint NOT NULL,
  `incl_taxes_unit_price` double NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `an_order_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9CE58EE170A5F021` (`an_order_id`),
  CONSTRAINT `FK_9CE58EE170A5F021` FOREIGN KEY (`an_order_id`) REFERENCES `order` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `order_line` (`id`, `product_name`, `quantity`, `excl_taxes_unit_price`, `sales_tax`, `incl_taxes_unit_price`, `created_at`, `updated_at`, `an_order_id`) VALUES
(1,	'Câble HDMI 1 m',	1,	7.99,	20,	9.59,	'2021-08-05 04:37:14',	NULL,	1),
(2,	'2020 Apple MacBook Air',	1,	1199.99,	20,	1439.99,	'2021-08-05 04:37:53',	NULL,	1),
(3,	'Acer Swift 1',	1,	350,	20,	420,	'2021-08-05 04:42:36',	NULL,	2),
(4,	'Caméra de Surveillance WiFi',	2,	39.99,	20,	47.99,	'2021-08-05 04:43:19',	NULL,	2),
(5,	'JBL LIVE 500BT',	1,	72.5,	20,	87,	'2021-08-05 04:45:23',	NULL,	3),
(6,	'TP-Link Tapo Ampoule E27 Connectée Wifi',	1,	23.99,	20,	28.79,	'2021-08-05 04:45:56',	NULL,	3),
(7,	'Epson Expression Home XP 4100',	1,	69.5,	20,	83.4,	'2021-08-05 04:49:12',	NULL,	4),
(8,	'Toshiba Téléviseur LED 32W',	1,	299.99,	20,	359.99,	'2021-08-09 07:09:39',	'2021-08-09 07:09:39',	5),
(9,	'Cable HDMI 1 m',	1,	7.99,	20,	9.59,	'2021-08-09 07:55:22',	'2021-08-09 07:55:22',	6),
(10,	'SMARTPHONE NOKIA 1.4 32GO GRIS - mobile',	1,	99,	20,	118.8,	'2021-08-09 07:55:22',	'2021-08-09 07:55:22',	6);

DROP TABLE IF EXISTS `picture`;
CREATE TABLE `picture` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_16DB4F894584665A` (`product_id`),
  CONSTRAINT `FK_16DB4F894584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `picture` (`id`, `name`, `created_at`, `updated_at`, `product_id`) VALUES
(1,	'cables-hdmi-sony1-61093cb12673a.jpg',	'2021-08-03 14:55:13',	'2021-08-03 14:55:13',	2),
(2,	'acer-swift1-61093e1aa3e12.jpg',	'2021-08-03 15:01:14',	'2021-08-03 15:01:14',	3),
(3,	'acer-swift2-61093e1e7f929.jpg',	'2021-08-03 15:01:18',	'2021-08-03 15:01:18',	3),
(4,	'acer-swift3-61093e2313e6f.jpg',	'2021-08-03 15:01:23',	'2021-08-03 15:01:23',	3),
(5,	'acer-swift4-61093e2685b61.jpg',	'2021-08-03 15:01:26',	'2021-08-03 15:01:26',	3),
(6,	'toshibaled32-1-61093f075cf76.jpg',	'2021-08-03 15:05:11',	'2021-08-03 15:05:11',	4),
(7,	'toshibaled32-2-61093f0a56210.jpg',	'2021-08-03 15:05:14',	'2021-08-03 15:05:14',	4),
(8,	'toshibaled32-3-61093f0dbbd75.jpg',	'2021-08-03 15:05:17',	'2021-08-03 15:05:17',	4),
(9,	'Toshiba-55UA4B63DG-1-61093fda65056.jpg',	'2021-08-03 15:08:42',	'2021-08-03 15:08:42',	5),
(10,	'Toshiba-55UA4B63DG-2-61093fde2aea4.jpg',	'2021-08-03 15:08:46',	'2021-08-03 15:08:46',	5),
(11,	'Toshiba-55UA4B63DG-3-61093fe1adfb6.jpg',	'2021-08-03 15:08:49',	'2021-08-03 15:08:49',	5),
(12,	'camerasurveillance-6109409c5efc0.jpg',	'2021-08-03 15:11:56',	'2021-08-03 15:11:56',	6),
(13,	'homecinemalg-610b3472e186b.jpg',	'2021-08-05 02:44:34',	'2021-08-05 02:44:34',	7),
(19,	'JBL1-610b38a1bfee3.jpg',	'2021-08-05 03:02:25',	'2021-08-05 03:02:25',	10),
(20,	'JBL2-610b38a835073.jpg',	'2021-08-05 03:02:32',	'2021-08-05 03:02:32',	10),
(21,	'JBL3-610b39005319c.jpg',	'2021-08-05 03:04:00',	'2021-08-05 03:04:00',	10),
(22,	'JBL4-610b3905cbb6f.jpg',	'2021-08-05 03:04:05',	'2021-08-05 03:04:05',	10),
(23,	'ecphilips1-610b39d384f85.jpg',	'2021-08-05 03:07:31',	'2021-08-05 03:07:31',	11),
(24,	'ecphilips2-610b39d87e153.jpg',	'2021-08-05 03:07:36',	'2021-08-05 03:07:36',	11),
(25,	'ecphilips3-610b39dd43de0.jpg',	'2021-08-05 03:07:41',	'2021-08-05 03:07:41',	11),
(26,	'ecphilips4-610b39e105033.jpg',	'2021-08-05 03:07:44',	'2021-08-05 03:07:44',	11),
(27,	'delltour1-610b3b9923e9a.jpg',	'2021-08-05 03:15:05',	'2021-08-05 03:15:05',	12),
(28,	'delltour2-610b3bc0ee22d.jpg',	'2021-08-05 03:15:44',	'2021-08-05 03:15:44',	12),
(29,	'ryzen1-610b3c8458111.jpg',	'2021-08-05 03:19:00',	'2021-08-05 03:19:00',	13),
(31,	'nokia1-610b3eddb4091.jpg',	'2021-08-05 03:29:01',	'2021-08-05 03:29:01',	15),
(32,	'nokia2-610b3ee24812e.jpg',	'2021-08-05 03:29:06',	'2021-08-05 03:29:06',	15),
(33,	'xiaomi1-610b3f885858a.jpg',	'2021-08-05 03:31:52',	'2021-08-05 03:31:52',	16),
(34,	'xiaomi2-610b3f8cb1465.jpg',	'2021-08-05 03:31:56',	'2021-08-05 03:31:56',	16),
(35,	'xiaomi3-610b3f94a04a0.jpg',	'2021-08-05 03:32:04',	'2021-08-05 03:32:04',	16),
(36,	'xiaomi4-610b3f9c21def.jpg',	'2021-08-05 03:32:12',	'2021-08-05 03:32:12',	16),
(37,	'samsung1-610b4048895a7.jpg',	'2021-08-05 03:35:04',	'2021-08-05 03:35:04',	17),
(38,	'samsung2-610b404cda13a.jpg',	'2021-08-05 03:35:08',	'2021-08-05 03:35:08',	17),
(39,	'samsung3-610b40519b528.jpg',	'2021-08-05 03:35:13',	'2021-08-05 03:35:13',	17),
(40,	'samsun4-610b4056cfe44.jpg',	'2021-08-05 03:35:18',	'2021-08-05 03:35:18',	17),
(41,	'tplink1-610b41952b7d1.jpg',	'2021-08-05 03:40:37',	'2021-08-05 03:40:37',	18),
(42,	'tplink2-610b41991929f.jpg',	'2021-08-05 03:40:41',	'2021-08-05 03:40:41',	18),
(43,	'pa1-610b42700f394.jpg',	'2021-08-05 03:44:16',	'2021-08-05 03:44:16',	19),
(44,	'pa2-610b42751f09f.jpg',	'2021-08-05 03:44:21',	'2021-08-05 03:44:21',	19),
(45,	'epson1-610b43c443084.jpg',	'2021-08-05 03:49:56',	'2021-08-05 03:49:56',	20),
(46,	'epson2-610b43ca52af4.jpg',	'2021-08-05 03:50:02',	'2021-08-05 03:50:02',	20),
(47,	'samsung1-610b9992ba336.jpg',	'2021-08-05 09:56:02',	'2021-08-05 09:56:02',	21),
(48,	'samsung2-610b9995dab36.jpg',	'2021-08-05 09:56:05',	'2021-08-05 09:56:05',	21),
(49,	'samsung3-610b9999d7de3.jpg',	'2021-08-05 09:56:09',	'2021-08-05 09:56:09',	21),
(50,	'samsung4-610b999d5d95c.jpg',	'2021-08-05 09:56:13',	'2021-08-05 09:56:13',	21),
(51,	'1-610b9a79d4935.jpg',	'2021-08-05 09:59:53',	'2021-08-05 09:59:53',	22),
(52,	'2-610b9a7d7d134.jpg',	'2021-08-05 09:59:57',	'2021-08-05 09:59:57',	22),
(53,	'HP-62-1-610bbbdd120bc.jpg',	'2021-08-05 12:22:21',	'2021-08-05 12:22:21',	23),
(54,	'HP-62-2-610bbbe22a106.jpg',	'2021-08-05 12:22:26',	'2021-08-05 12:22:26',	23),
(55,	'macbook2-610dbc5a561c3.jpg',	'2021-08-07 00:48:58',	'2021-08-07 00:48:58',	14);

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `excl_taxes_price` double NOT NULL,
  `sales_tax` smallint NOT NULL,
  `incl_taxes_price` double NOT NULL,
  `reference` int NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `stock` int NOT NULL,
  `status_recent` smallint DEFAULT NULL,
  `status_promotion` smallint DEFAULT NULL,
  `percentage_promotion` smallint DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `brand_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D34A04AD44F5D008` (`brand_id`),
  CONSTRAINT `FK_D34A04AD44F5D008` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `product` (`id`, `name`, `excl_taxes_price`, `sales_tax`, `incl_taxes_price`, `reference`, `description`, `stock`, `status_recent`, `status_promotion`, `percentage_promotion`, `created_at`, `updated_at`, `brand_id`) VALUES
(2,	'Cable HDMI 1 m',	7.99,	20,	9.59,	14587456,	'Sony DLC-HE10C Câble HDMI Haute Vitesse avec Ethernet, 1 m',	300,	0,	0,	0,	'2021-08-03 14:54:56',	'2021-08-03 14:54:56',	10),
(3,	'Acer Swift 1 portable',	350,	20,	420,	24157487,	'Acer Swift 1 SF114-34-P8Q7 Ordinateur Portable Ultrafin 14\'\' FHD IPS, PC Portable (Intel Pentium Silver N6000, RAM 4 Go, SSD 128 Go, Intel UHD Graphics, Windows 10) - Clavier AZERTY, Laptop Gris',	39,	0,	0,	0,	'2021-08-03 15:01:03',	'2021-08-03 15:01:03',	1),
(4,	'Toshiba Téléviseur LED 32W',	299.99,	20,	359.99,	24157487,	'Toshiba Téléviseur LED 32W3863DA 32W3863DA 81 cm 32 Pouces EEC A+ (A++ - E) DVB-T2, DVB-C, DVB-S, HD Ready, Smart TV, Wi',	46,	1,	0,	0,	'2021-08-03 15:05:03',	'2021-08-03 15:05:03',	11),
(5,	'Toshiba 55UA4B63DG téléviseur',	429.99,	20,	515.99,	12457487,	'Toshiba 55UA4B63DG, Smart TV 55\\\" LED Ultra HD 4K, Alexa intégré, Wi-Fi, 3x Hdmi, Dolby Audio 2x10W, Ethernet (55\\\"/139 cm), noir',	84,	0,	0,	0,	'2021-08-03 15:08:35',	'2021-08-03 15:08:35',	11),
(6,	'Caméra de Surveillance WiFi',	39.99,	20,	47.99,	12474587,	'Caméra de Surveillance WiFi, 1080P Caméra WiFi sans Fil, Suivi de Mouvement de Détection de Son, Audio Bidirectionnel, Vision Nocturne Haute Définition, Carte SD/Stockage Cloud',	40,	1,	0,	0,	'2021-08-03 15:11:47',	'2021-08-03 15:11:47',	8),
(7,	'Home Cinéma 5.1 LG LHB625M',	237.55,	20,	285.06,	24157487,	'Système Home Cinema - Canal 5.1, Lecteur de disque Blu-ray. Alimentation en sortie / Total : 1000 Watt Fonction : Lecteur numérique, récepteur AV, enregistreur numérique, lecteur de disque Blu-ray, Lecteur réseau, récepteur audio Bluetooth',	21,	1,	0,	0,	'2021-08-05 02:44:20',	'2021-08-05 02:44:20',	5),
(10,	'JBL LIVE 500BT casque',	72.5,	20,	87,	14521457,	'Casque audio circum-auriculaire sans fil – Écouteurs Bluetooth avec commande pour appels – avec Amazon Alexa intégré – Autonomie jusqu\'à 30 heures – Bleu',	43,	0,	0,	0,	'2021-08-05 03:01:06',	'2021-08-05 03:01:06',	14),
(11,	'Philips T2205BK/00 - ecouteurs',	39.99,	20,	47.99,	14574648,	'Écouteurs Bluetooth (Écouteurs sans Fil, Commande vocale, 12 Heures d\'autonomie, Protection Contre Les éclaboussures IPX4, Petit boîtier de Charge) Noir - Modèle 2020/2021',	43,	0,	1,	10,	'2021-08-05 03:06:01',	'2021-08-05 03:06:01',	8),
(12,	'Dell OptiPlex 3010 SFF tour',	191.9,	20,	230.28,	45741254,	'OptiPlex 3010 SFF Intel Core i5 3.20 GHz 8 Go DDR3 240 Go SSD DVD Writer HDMI Windows 10 Pro 64 bit (reconditionné)',	56,	0,	0,	0,	'2021-08-05 03:14:21',	'2021-08-05 03:14:21',	4),
(13,	'Ryzen 8-Thread 4300GE tour',	435.5,	20,	522.6,	14567456,	'Ryzen 8-Thread 4300GE 4.00 GHz | 6-Core Radeon R7 DX12 4Go | 16Go DDR4 | 512Go SSD | DVD±RW | Windows 10 | WiFi | USB3.0 Unité Centrale Ordinateur de Bureau PC Gaming #6706',	34,	1,	0,	0,	'2021-08-05 03:18:27',	'2021-08-05 03:18:27',	15),
(14,	'2020 Apple MacBook Air portable',	1199.99,	20,	1439.99,	14574584,	'Apple MacBook Air avec Apple M1 Chip (13 Pouces, 8 Go RAM, 512 Go SSD) - Gris sidéral Puce M1 conçue par Apple pour un gain de performances spectaculaire au niveau du processeur central, du processeur graphique et de l’apprentissage automatique',	24,	0,	1,	10,	'2021-08-05 03:22:09',	'2021-08-05 03:22:09',	2),
(15,	'SMARTPHONE NOKIA 1.4 32GO GRIS - mobile',	99,	20,	118.8,	14574875,	'Nokia 1.4-Android 11Go-Mémoire vive (RAM):2Go-Mémoir interne:32Go-4G LTE-Dual SIM (2x nano)',	24,	0,	1,	20,	'2021-08-05 03:28:12',	'2021-08-05 03:28:12',	6),
(16,	'Xiaomi Mi 11 5G - mobile',	629.99,	20,	755.99,	14527458,	'Smartphone 8GB+128GB, Écran 6,81” WQHD+ AMOLED DotDisplay, Snapdragon 888, Triple Camera 108MP+13MP+5MP, 46000mAh, NFC, Gris de Minuit (Version officielle + 2 ans de garantie Xiaomi)',	134,	1,	0,	0,	'2021-08-05 03:30:34',	'2021-08-05 03:30:34',	12),
(17,	'Samsung Galaxy S21 Ultra 5G - mobile',	1199.99,	20,	1439.99,	14574678,	'Galaxy S21 Ultra 5G SM-G998 17,3 cm (6.8\") Double SIM Android 11 USB Type-C 12 Go 256 Go 5000 mAh Noir',	25,	0,	0,	0,	'2021-08-05 03:33:38',	'2021-08-05 03:33:38',	9),
(18,	'TP-Link Tapo Ampoule E27 Connectée Wifi',	23.99,	20,	28.79,	14574654,	'Ampoule Connectée Wifi, Ampoule E27 LED 8.7W 806Lm, RGBCW Multicouleur et Blanc Chaud, Smart Ampoule compatible avec Alexa et Google Home, 2PCS [Classe énergétique A+] (Tapo L530E)',	60,	0,	0,	0,	'2021-08-05 03:39:48',	'2021-08-05 03:39:48',	16),
(19,	'Philips Hue Ampoules LED Connectées E27',	24.99,	20,	29.99,	14574586,	'Philips Hue Ampoules LED Connectées Blanc Chaud E27 Compatible Bluetooth, Fonctionne avec Alexa Pack de 2 [Classe énergétique A+]',	63,	0,	0,	0,	'2021-08-05 03:43:29',	'2021-08-05 03:43:29',	8),
(20,	'Epson Expression Home XP 4100 imprimantes',	69.5,	20,	83.4,	14574875,	'Epson Expression Home XP 4100 Imprimante/Jet d\'encre/Noir Normal Jet d\'Encre Duplexage automatique',	43,	0,	0,	0,	'2021-08-05 03:49:13',	'2021-08-05 03:49:13',	17),
(21,	'Samsung Galaxy M11 - mobile',	115,	20,	138,	14564527,	'Samsung Galaxy M11 - Smartphone débloqué 4G - Noir - écran Infinity-O TFT HD+ de 6,4 pouces - 512 Go avec carte MicroSD',	24,	0,	0,	0,	'2021-08-05 09:55:02',	'2021-08-05 09:55:02',	9),
(22,	'Philips SHS3300BK/10 Écouteurs Sport',	14.99,	20,	17.99,	14547485,	'SHS3300BK/10 Écouteurs Sport (son puissant, son Bass-Beat, tour d\'oreille Flex Soft, ouvert, câble de 1,2 m) noir',	45,	0,	1,	10,	'2021-08-05 09:59:18',	'2021-08-05 09:59:18',	8),
(23,	'Encre pck de 2 cartouhe HP3200',	10,	20,	12,	154552155,	'description',	5,	0,	0,	0,	'2021-08-05 12:22:10',	'2021-08-05 12:22:10',	18);

DROP TABLE IF EXISTS `product_category`;
CREATE TABLE `product_category` (
  `product_id` int NOT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`product_id`,`category_id`),
  KEY `IDX_CDFC73564584665A` (`product_id`),
  KEY `IDX_CDFC735612469DE2` (`category_id`),
  CONSTRAINT `FK_CDFC735612469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_CDFC73564584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `product_category` (`product_id`, `category_id`) VALUES
(2,	16),
(2,	57),
(3,	17),
(3,	25),
(3,	31),
(4,	16),
(4,	61),
(4,	66),
(5,	16),
(5,	61),
(5,	66),
(6,	18),
(6,	40),
(6,	47),
(7,	16),
(7,	60),
(7,	62),
(10,	16),
(10,	60),
(10,	65),
(11,	16),
(11,	60),
(11,	65),
(12,	17),
(12,	26),
(12,	37),
(13,	17),
(13,	26),
(13,	37),
(14,	17),
(14,	25),
(14,	31),
(15,	19),
(15,	52),
(16,	19),
(16,	52),
(17,	19),
(17,	52),
(18,	18),
(18,	38),
(18,	41),
(19,	18),
(19,	38),
(19,	41),
(20,	17),
(20,	20),
(20,	30),
(21,	19),
(21,	52),
(22,	16),
(22,	60),
(22,	65),
(23,	17),
(23,	70);

DROP TABLE IF EXISTS `reset_password_request`;
CREATE TABLE `reset_password_request` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `selector` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashed_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_7CE748AA76ED395` (`user_id`),
  CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `status` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1,	'En cours (non envoyé)',	'2021-08-05 04:30:48',	NULL),
(2,	'En cours (envoyé, non livré)',	'2021-08-05 04:31:19',	NULL),
(3,	'Terminé',	'2021-08-05 04:31:41',	NULL),
(4,	'Annulé',	'2021-08-05 04:31:49',	NULL);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` int NOT NULL,
  `email` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_user` smallint NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user` (`id`, `firstname`, `lastname`, `gender`, `phone_number`, `email`, `status_user`, `password`, `birthdate`, `created_at`, `updated_at`, `roles`) VALUES
(1,	'Bernard',	'Legrand',	'Monsieur',	654245658,	'bernards@gmail.com',	1,	'$2y$13$5J00w3BSzBm7NP7oHjVbq.S89Z4EiuwV0C0s97BGxXF26U4hWD5Pa',	'1986-06-14',	'2021-07-31 12:02:41',	'2021-07-31 12:02:41',	'[\"ROLE_CATALOG_MANAGER\"]'),
(2,	'Frédéric',	'Guillon',	'Monsieur',	645756452,	'frederic-guillon@gmail.com',	1,	'$2y$13$QtsNMqjme0ZfYSvgT81Ns.a3XmNZDH92aMqpKAx1xmzKGr9aQMlJ6',	'1984-09-27',	'2021-07-31 12:05:57',	NULL,	'[\"ROLE_SUPER_ADMIN\"]'),
(3,	'Louis',	'Dupond',	'Monsieur',	674254565,	'Louis@gmail.com',	1,	'$2y$13$zqrsgKxpZTs0BspQgmWqGu4hpk1tOpvb0.G6qBCFruwoGV8NjlJL.',	'1990-05-27',	'2021-08-01 15:49:41',	'2021-08-01 15:49:41',	'[\"ROLE_ADMIN\"]'),
(4,	'Jean',	'Martin',	'Monsieur',	745854762,	'Jean-martin@gmail.com',	1,	'$2y$13$uRPw3YDjpP8./OPmtaHAdewpynZr9xTfFjLTB4lNx4I41Cf7va3fO',	'1984-06-15',	'2021-08-01 16:02:33',	'2021-08-01 16:02:33',	'[\"ROLE_ADMIN\"]'),
(5,	'Benoit',	'QUENTIN',	'Monsieur',	685457452,	'benoit@gmail.com',	1,	'$2y$13$QtsNMqjme0ZfYSvgT81Ns.a3XmNZDH92aMqpKAx1xmzKGr9aQMlJ6',	'1990-05-25',	'2021-08-02 08:54:54',	NULL,	'[\"ROLE_SUPER_ADMIN\"]'),
(6,	'Laetitia',	'Coffe',	'Madame',	645754856,	'laetitia-coffe@hotmail.com',	1,	'$2y$13$QtsNMqjme0ZfYSvgT81Ns.a3XmNZDH92aMqpKAx1xmzKGr9aQMlJ6',	'1990-05-24',	'2021-08-02 08:56:11',	NULL,	'[\"ROLE_SUPER_ADMIN\"]'),
(7,	'Mickael',	'GEERARDYN',	'Monsieur',	645745125,	'mickael.geerardyn@gmail.comm',	1,	'$2y$13$QtsNMqjme0ZfYSvgT81Ns.a3XmNZDH92aMqpKAx1xmzKGr9aQMlJ6',	'1990-05-05',	'2021-08-02 08:57:03',	NULL,	'[\"ROLE_SUPER_ADMIN\"]'),
(8,	'Carmen',	'Dalia',	'Madame',	645785462,	'carmen@hotmail.com',	1,	'$2y$13$o5A9/AN9Op2Is6EvYfEwHen1b.XK.lV13ILyKoQw.h7wVKC2szvOq',	'1990-04-15',	'2021-08-03 15:18:35',	'2021-08-03 15:18:35',	'[]'),
(9,	'Robert',	'Laval',	'Monsieur',	715426545,	'robert-laval@hotmail.com',	1,	'$2y$13$Sx9HvA2XNn7I0f8ZTUXiwOphM/UUt/zLw0rwXHAt7NDGjnsqnadoS',	'1985-04-15',	'2021-08-05 08:57:44',	'2021-08-05 08:57:44',	'[]'),
(10,	'Louis',	'Bardi',	'Monsieur',	745241546,	'Louis.bardi@gmail.com',	1,	'$2y$13$Prbs59QDpr/tUXEWkcZmzeQpmRdCI8RuvMUngWW962hYwhvVr/LDm',	'1984-04-15',	'2021-08-05 10:35:44',	'2021-08-05 10:35:44',	'[]'),
(11,	'Laurent',	'Michu',	'Monsieur',	674751245,	'laurent.michu@gmail.com',	1,	'$2y$13$7q9Kgb5YS6cLtM7jKTiZcu5EjTznyPOWPHnsOOa27hnYW69WK89Oq',	'1984-04-25',	'2021-08-05 12:16:52',	'2021-08-05 12:16:52',	'[]'),
(12,	'Frédéric',	'Guillon',	'Monsieur',	845745725,	'frdric.guillon@gmail.com',	1,	'$2y$13$zz1V03nGSWoA8eaKW8VISeMenHtXBAWRE0gh27Xloj6Aglfc93Rwe',	'1984-04-25',	'2021-08-09 08:25:55',	'2021-08-09 08:25:55',	'[]');

-- 2021-08-09 10:53:30
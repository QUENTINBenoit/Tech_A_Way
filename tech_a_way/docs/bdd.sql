-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` int(11) NOT NULL,
  `city` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `delivery` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D4E6F81A76ED395` (`user_id`),
  CONSTRAINT `FK_D4E6F81A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `brand`;
CREATE TABLE `brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
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
(31,	'Neuf',	NULL,	NULL,	'2021-08-01 16:26:45',	'2021-08-01 16:26:45',	25),
(32,	'Reconditionné',	NULL,	NULL,	'2021-08-01 16:26:59',	'2021-08-01 16:26:59',	25),
(33,	'Station d\'accueil',	NULL,	NULL,	'2021-08-01 16:27:15',	'2021-08-01 16:27:15',	25),
(34,	'Sacoches',	NULL,	NULL,	'2021-08-01 16:27:27',	'2021-08-01 16:27:27',	25),
(35,	'Neuf',	NULL,	NULL,	'2021-08-01 16:28:03',	'2021-08-01 16:28:03',	26),
(36,	'Reconditionné',	NULL,	NULL,	'2021-08-01 16:28:12',	'2021-08-01 16:28:12',	26),
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
(69,	'Photo',	NULL,	NULL,	'2021-08-01 16:42:58',	'2021-08-01 16:42:58',	61);

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
('DoctrineMigrations\\Version20210730131941',	'2021-07-31 11:59:54',	337);

DROP TABLE IF EXISTS `mode_of_payment`;
CREATE TABLE `mode_of_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_delivery` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street_delivery` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode_delivery` int(11) NOT NULL,
  `city_delivery` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street_bill` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode_bill` int(11) NOT NULL,
  `city_bill` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status_id` int(11) NOT NULL,
  `mode_of_payment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F52993986BF700BD` (`status_id`),
  KEY `IDX_F5299398C9A9CD82` (`mode_of_payment_id`),
  KEY `IDX_F5299398A76ED395` (`user_id`),
  CONSTRAINT `FK_F52993986BF700BD` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `FK_F5299398A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_F5299398C9A9CD82` FOREIGN KEY (`mode_of_payment_id`) REFERENCES `mode_of_payment` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `order_line`;
CREATE TABLE `order_line` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `excl_taxes_unit_price` double NOT NULL,
  `sales_tax` smallint(6) NOT NULL,
  `incl_taxes_unit_price` double NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `an_order_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9CE58EE170A5F021` (`an_order_id`),
  CONSTRAINT `FK_9CE58EE170A5F021` FOREIGN KEY (`an_order_id`) REFERENCES `order` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `picture`;
CREATE TABLE `picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_16DB4F894584665A` (`product_id`),
  CONSTRAINT `FK_16DB4F894584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excl_taxes_price` double NOT NULL,
  `sales_tax` smallint(6) NOT NULL,
  `incl_taxes_price` double NOT NULL,
  `reference` int(11) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `status_recent` smallint(6) DEFAULT NULL,
  `status_promotion` smallint(6) DEFAULT NULL,
  `percentage_promotion` smallint(6) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D34A04AD44F5D008` (`brand_id`),
  CONSTRAINT `FK_D34A04AD44F5D008` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `product_category`;
CREATE TABLE `product_category` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`category_id`),
  KEY `IDX_CDFC73564584665A` (`product_id`),
  KEY `IDX_CDFC735612469DE2` (`category_id`),
  CONSTRAINT `FK_CDFC735612469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_CDFC73564584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_user` smallint(6) NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user` (`id`, `firstname`, `lastname`, `gender`, `phone_number`, `email`, `status_user`, `password`, `birthdate`, `created_at`, `updated_at`, `roles`) VALUES
(1,	'Bernard',	'Legrand',	'Monsieur',	654245658,	'bernards@gmail.com',	1,	'$2y$13$5J00w3BSzBm7NP7oHjVbq.S89Z4EiuwV0C0s97BGxXF26U4hWD5Pa',	'1986-06-14',	'2021-07-31 12:02:41',	'2021-07-31 12:02:41',	'[]'),
(2,	'Frédéric',	'Guillon',	'Monsieur',	645756452,	'fred@gmail.com',	1,	'$2y$13$QtsNMqjme0ZfYSvgT81Ns.a3XmNZDH92aMqpKAx1xmzKGr9aQMlJ6',	'1984-09-27',	'2021-07-31 12:05:57',	NULL,	'[\"ROLE_SUPER_ADMIN\"]'),
(3,	'fff',	'fff',	'Monsieur',	454,	'test@gmail.com',	1,	'$2y$13$zqrsgKxpZTs0BspQgmWqGu4hpk1tOpvb0.G6qBCFruwoGV8NjlJL.',	'1990-05-27',	'2021-08-01 15:49:41',	'2021-08-01 15:49:41',	'[\"ROLE_CATALOG_MANAGER\"]'),
(4,	'dfdfd',	'fdfdf',	'Monsieur',	454,	'fddfdf@gmail.com',	1,	'$2y$13$uRPw3YDjpP8./OPmtaHAdewpynZr9xTfFjLTB4lNx4I41Cf7va3fO',	'1984-06-15',	'2021-08-01 16:02:33',	'2021-08-01 16:02:33',	'[\"ROLE_ADMIN\"]'),
(5,	'Benoit',	'QUENTIN',	'Monsieur',	685457452,	'benquel@gmail.com',	1,	'$2y$13$QtsNMqjme0ZfYSvgT81Ns.a3XmNZDH92aMqpKAx1xmzKGr9aQMlJ6',	'1990-05-25',	'2021-08-02 08:54:54',	NULL,	'[\"ROLE_SUPER_ADMIN\"]'),
(6,	'Jamal',	'lastname',	'Monsieur',	645754856,	'lastname',	1,	'$2y$13$QtsNMqjme0ZfYSvgT81Ns.a3XmNZDH92aMqpKAx1xmzKGr9aQMlJ6',	'1990-05-24',	'2021-08-02 08:56:11',	NULL,	'[\"ROLE_SUPER_ADMIN\"]'),
(7,	'Mickael',	'GEERARDYN',	'Monsieur',	645745125,	'mick@gmail.comm',	1,	'$2y$13$QtsNMqjme0ZfYSvgT81Ns.a3XmNZDH92aMqpKAx1xmzKGr9aQMlJ6',	'1990-05-05',	'2021-08-02 08:57:03',	NULL,	'[\"ROLE_SUPER_ADMIN\"]');

-- 2021-08-02 06:57:16
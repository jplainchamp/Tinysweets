-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `ts_avis`;
CREATE TABLE `ts_avis` (
  `id_avis` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `commentaire` text NOT NULL,
  `note` int(2) unsigned NOT NULL,
  `dateAvis` date NOT NULL,
  `id_client` int(5) unsigned DEFAULT NULL,
  `id_gateau` int(4) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_avis`),
  KEY `fk_avis_client` (`id_client`),
  KEY `fk_avis_gateau` (`id_gateau`),
  CONSTRAINT `fk_avis_client` FOREIGN KEY (`id_client`) REFERENCES `ts_client` (`id_client`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_avis_gateau` FOREIGN KEY (`id_gateau`) REFERENCES `ts_gateau` (`id_gateau`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ts_avis` (`id_avis`, `commentaire`, `note`, `dateAvis`, `id_client`, `id_gateau`) VALUES
(1,	'eu dui. Cum sociis natoque penatibus et magnis dis parturient',	5,	'2016-10-12',	6,	7),
(2,	'at, velit. Pellentesque ultricies dignissim lacus. Aliquam rutrum lorem ac',	3,	'2016-03-19',	10,	9),
(4,	'ipsum porta elit, a feugiat tellus lorem eu metus. In',	5,	'2017-07-19',	1,	3),
(6,	'at arcu. Vestibulum ante ipsum primis in faucibus orci luctus',	1,	'2017-02-25',	6,	3),
(7,	'eros turpis non enim. Mauris quis turpis vitae purus gravida',	5,	'2016-11-04',	5,	4),
(8,	'neque tellus, imperdiet non, vestibulum nec, euismod in, dolor. Fusce',	3,	'2016-01-13',	7,	4),
(9,	'odio sagittis semper. Nam tempor diam dictum sapien. Aenean massa.',	1,	'2016-05-02',	3,	9),
(10,	'eget mollis lectus pede et risus. Quisque libero lacus, varius',	2,	'2017-01-06',	4,	3),
(11,	'dictum ultricies ligula. Nullam enim. Sed nulla ante, iaculis nec,',	5,	'2016-10-28',	8,	3),
(12,	'adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis',	5,	'2016-10-06',	10,	3),
(13,	'felis. Donec tempor, est ac mattis semper, dui lectus rutrum',	4,	'2016-06-20',	3,	7),
(14,	'ligula. Aenean gravida nunc sed pede. Cum sociis natoque penatibus',	4,	'2015-09-16',	7,	3),
(15,	'elit, a feugiat tellus lorem eu metus. In lorem. Donec',	5,	'2016-04-30',	5,	4),
(16,	'Nulla eu neque pellentesque massa lobortis ultrices. Vivamus rhoncus. Donec',	3,	'2016-03-01',	7,	2),
(17,	'ornare egestas ligula. Nullam feugiat placerat velit. Quisque varius. Nam',	5,	'2016-11-12',	10,	9),
(18,	'semper rutrum. Fusce dolor quam, elementum at, egestas a, scelerisque',	2,	'2015-10-09',	2,	3),
(20,	'sit amet, faucibus ut, nulla. Cras eu tellus eu augue',	2,	'2016-10-06',	1,	6);

DROP TABLE IF EXISTS `ts_categorie`;
CREATE TABLE `ts_categorie` (
  `id_categorie` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ts_categorie` (`id_categorie`, `nom`) VALUES
(1,	'Mariage'),
(2,	'Anniversaire'),
(3,	'BabyShower'),
(4,	'Tiny'),
(5,	'Fruits'),
(6,	'Sweets');

DROP TABLE IF EXISTS `ts_client`;
CREATE TABLE `ts_client` (
  `id_client` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(15) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `genre` enum('m','f') NOT NULL,
  `ville` varchar(50) NOT NULL,
  `cp` varchar(5) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `statut` int(1) NOT NULL,
  `newsletter` int(1) NOT NULL,
  PRIMARY KEY (`id_client`),
  UNIQUE KEY `pseudo` (`pseudo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ts_client` (`id_client`, `pseudo`, `mdp`, `nom`, `prenom`, `email`, `genre`, `ville`, `cp`, `adresse`, `statut`, `newsletter`) VALUES
(1,	'admin',	'$2y$10$Lb89V3gJS.VnWyApc6WW2umBkMvpEO0zHiK7oLwWHPl/9Py68cS1O',	'admin',	'admin',	'admin@gmail.com',	'm',	'Paris',	'75008',	'10 rue de Rennes',	1,	0),
(2,	'user1',	'$2y$10$Lb89V3gJS.VnWyApc6WW2umBkMvpEO0zHiK7oLwWHPl/9Py68cS1O',	'Marchandier',	'Denise',	'denise.marchandier@gmail.com',	'f',	'Paris',	'75008',	'10 rue de Rennes',	1,	0),
(3,	'user2',	'$2y$10$e0B.yPufaLp/jnDanfFPjO8iftyuOVms0dZ87a50JQ7a1mV7canKG',	'Boli',	'Basile',	'basile.boli@mail.com',	'm',	'Marseille',	'13004',	'10 rue du Vel',	0,	0),
(4,	'user3',	'$2y$10$cUvzcrNGjJzKXit1My/IGeXi3FbKtAKphPcChNOOFHrRiXQIw4awS',	'Papin',	'Jean-Pierre',	'jpp@mail.com',	'm',	'Marseille',	'13006',	'168 avenue du Prado',	0,	0),
(5,	'Tarantio',	'$2y$10$Lb89V3gJS.VnWyApc6WW2umBkMvpEO0zHiK7oLwWHPl/9Py68cS1O',	'Plainchamp',	'Jeremy',	'jeremy.plainchamp@orange.fr',	'm',	'Montigny-Le-Bretonneux',	'78180',	'11 avenue Joseph Kessel',	0,	0),
(6,	'Ayesha',	'$2y$10$Rq9k938SK0joWMB4mR9xoO7Nb.6lvR6Rhas.ARWHVHmxOok1wNsYq',	'Plainchamp',	'Anne',	'aplainchamp@mail.fr',	'f',	'Montigny-Le-Bretonneux',	'78180',	'11 avenue Joseph Kessel',	0,	0),
(7,	'user4',	'$2y$10$e0B.yPufaLp/jnDanfFPjO8iftyuOVms0dZ87a50JQ7a1mV7canKG',	'Dupont',	'Jean',	'jean-dupont@mail.com',	'm',	'Marseille',	'13004',	'10 rue du Vel',	0,	0),
(8,	'user5',	'$2y$10$cUvzcrNGjJzKXit1My/IGeXi3FbKtAKphPcChNOOFHrRiXQIw4awS',	'Durand',	'Pierre',	'pierre.durand@mail.com',	'm',	'Marseille',	'13006',	'168 avenue du Prado',	0,	0),
(9,	'user6',	'$2y$10$e0B.yPufaLp/jnDanfFPjO8iftyuOVms0dZ87a50JQ7a1mV7canKG',	'Dumas',	'Eva',	'eva.dumas@mail.com',	'm',	'Paris',	'75006',	'10 rue des Vandales',	0,	0),
(10,	'user7',	'$2y$10$cUvzcrNGjJzKXit1My/IGeXi3FbKtAKphPcChNOOFHrRiXQIw4awS',	'Regatin',	'Mathieu',	'mregatin@mail.com',	'm',	'Paris',	'75015',	'248 avenue Gabetta',	0,	0);

DROP TABLE IF EXISTS `ts_commande`;
CREATE TABLE `ts_commande` (
  `id_commande` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `montant` int(5) unsigned NOT NULL,
  `dateCommande` datetime NOT NULL,
  `dateLivraison` datetime NOT NULL,
  `id_client` int(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_commande`),
  KEY `fk_commande_client` (`id_client`),
  CONSTRAINT `fk_commande_client` FOREIGN KEY (`id_client`) REFERENCES `ts_client` (`id_client`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ts_commande` (`id_commande`, `montant`, `dateCommande`, `dateLivraison`, `id_client`) VALUES
(3000,	58,	'2016-10-02 16:42:18',	'2016-10-01 17:00:00',	6),
(3001,	53,	'2016-10-02 16:57:39',	'2016-10-05 18:00:00',	6),
(3002,	174,	'2016-10-02 16:58:54',	'2016-10-01 17:00:00',	6),
(3003,	21,	'2016-10-02 18:08:25',	'2016-10-01 17:00:00',	6),
(3004,	37,	'2016-10-02 18:46:31',	'2016-10-11 20:46:00',	3);

DROP TABLE IF EXISTS `ts_details_commande`;
CREATE TABLE `ts_details_commande` (
  `id_details_commande` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `id_commande` int(6) unsigned NOT NULL,
  `id_produit` int(6) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_details_commande`),
  KEY `fk_details_commande` (`id_commande`),
  KEY `fk_details_produit` (`id_produit`),
  CONSTRAINT `fk_details_commande` FOREIGN KEY (`id_commande`) REFERENCES `ts_commande` (`id_commande`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_details_produit` FOREIGN KEY (`id_produit`) REFERENCES `ts_produit` (`id_produit`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ts_details_commande` (`id_details_commande`, `id_commande`, `id_produit`) VALUES
(3,	3000,	3),
(4,	3000,	4),
(5,	3001,	5),
(6,	3002,	6),
(7,	3003,	7),
(8,	3004,	8);

DROP TABLE IF EXISTS `ts_gateau`;
CREATE TABLE `ts_gateau` (
  `id_gateau` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prix` int(3) unsigned NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `id_categorie` int(3) unsigned NOT NULL,
  `id_promo` int(2) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_gateau`),
  KEY `fk_gateau_categorie` (`id_categorie`),
  KEY `fk_gateau_promo` (`id_promo`),
  CONSTRAINT `fk_gateau_categorie` FOREIGN KEY (`id_categorie`) REFERENCES `ts_categorie` (`id_categorie`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_gateau_promo` FOREIGN KEY (`id_promo`) REFERENCES `ts_promotion` (`id_promo`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ts_gateau` (`id_gateau`, `nom`, `prix`, `description`, `photo`, `id_categorie`, `id_promo`) VALUES
(2,	'FRAISES CHOCO',	20,	'12 Fraises au chocolat.',	'/tinysweets/Web/photos/FRAISES_CHOCO.jpg',	4,	1),
(3,	'MINI MILLEFEUILLES',	20,	'3 Minis Mille Feuilles.',	'/tinysweets/Web/photos/MINI_MILLEFEUILLES.jpg',	4,	1),
(4,	'RAINBOW_MERINGUES',	20,	'10 Rainbow meringues',	'/tinysweets/Web/photos/RAINBOW_MERINGUES.jpg',	4,	1),
(5,	'UNICORN_CAKE',	20,	'Gâteau multicouleur - Rainbow Cake.',	'/tinysweets/Web/photos/UNICORN_CAKE.jpg',	4,	3),
(6,	'UNICORN MERINGUES',	20,	'20 Rainbow meringues',	'/tinysweets/Web/photos/UNICORN_MERINGUES.jpg',	4,	1),
(7,	'CUPCAKES FRAMBOISE OREO',	20,	'Cupcakes par 9 à la framboise et Oreo.',	'/tinysweets/Web/photos/CUPCAKES_FRAMBOISE_ET_OREO.jpg',	4,	1),
(8,	'CHOCO BUENO',	20,	'Un gâteau d\'anniversaire avec thème Kinder BUENO.',	'/tinysweets/Web/photos/CHOCO_BUENO.jpg',	2,	2),
(9,	'CHOCO FRAMBOISE',	20,	'Un gâteau d\'anniversaire avec des framboises.',	'/tinysweets/Web/photos/CHOCO_FRAMBOISE.jpg',	2,	3),
(10,	'COCO VANILLE',	20,	'Un gâteau d\'anniversaire à la noix de coco et à la vanille.',	'/tinysweets/Web/photos/COCO_VANILLE.jpg',	2,	1),
(11,	'gateau_04',	20,	'Un gâteau d\'anniversaire entourés de biscuit à la cuillère.',	'/tinysweets/Web/photos/gateau_04.jpg',	2,	2),
(12,	'AVENGER',	20,	'Un gâteau d\'anniversaire au thème Avenger.',	'/tinysweets/Web/photos/AVENGER.jpg',	2,	1),
(13,	'PEPPA PIG',	20,	'Un gâteau d\'anniversaire au thème Peppa Pig.',	'/tinysweets/Web/photos/PEPPA_PIG.jpg',	2,	1),
(14,	'CERISE FRAISE',	20,	'Un gâteau d\'anniversaire avec des fraises et des cerises.',	'/tinysweets/Web/photos/CERISE_FRAISE.jpg',	5,	2),
(15,	'PSG',	20,	'Un gâteau d\'anniverssire aux couleurs du PSG.',	'/tinysweets/Web/photos/PSG.jpg',	2,	1),
(16,	'PAT PATROUILLE',	20,	'Un gâteau d\'anniversaire au thème Pat Patrouille.',	'/tinysweets/Web/photos/PAT_PATROUILLE.jpg',	2,	1),
(17,	'FRAISE VANILLE',	20,	'Un gâteau d\'anniversaire à la fraise et à la vanille.',	'/tinysweets/Web/photos/FRAISE_VANILLE.jpg',	2,	1),
(18,	'TOUT CHOCO',	20,	'Un gâteau d\'anniversaire tout chocolat.',	'/tinysweets/Web/photos/TOUT_CHOCO.jpg',	2,	1),
(19,	'FRAMBOISE GIRL',	20,	'Un gâteau pour fête Baby Shower, c\'est une fille, à la framboise.',	'/tinysweets/Web/photos/FRAMBOISE_GIRL.jpg',	3,	1),
(20,	'BABY BOY',	20,	'Un gâteau pour fête Baby Shower, c\'est un garçon.',	'/tinysweets/Web/photos/BABY_BOY.jpg',	3,	1),
(21,	'gateau_mariage_01',	20,	'Un gâteau de mariage à la noix de coco et à la vanille.',	'/tinysweets/Web/photos/gateau_mariage_01.jpg',	1,	2),
(22,	'gateau_mariage_02',	20,	'Un gâteau de mariage rectangulaire blanc et violet.',	'/tinysweets/Web/photos/gateau_mariage_02.jpg',	1,	2),
(23,	'gateau_mariage_03',	20,	'Un gâteau de mariage à la noix de coco',	'/tinysweets/Web/photos/gateau_mariage_03.jpg',	1,	2),
(24,	'gateau_mariage_04',	20,	'Un gâteau rectangulaire avec un coeur en étage.',	'/tinysweets/Web/photos/gateau_mariage_04.jpg',	1,	2),
(25,	'gateau_mariage_05',	20,	'Gâteau de mariage aux fruits rouges.',	'/tinysweets/Web/photos/gateau_mariage_05.jpg',	1,	3),
(26,	'GIRLY FRAISE',	20,	'Un gâteau très girly à la fraise.',	'/tinysweets/Web/photos/GIRLY_FRAISE.jpg',	4,	2),
(27,	'FRAISE KIWI',	20,	'Gâteau à étages à la Fraise et au Kiwi.',	'/tinysweets/Web/photos/FRAISE_KIWI.jpg',	5,	2),
(28,	'ROSE VIOLET',	20,	'Gâteau rose et violet.',	'/tinysweets/Web/photos/ROSE_VIOLET.jpg',	4,	1),
(29,	'CADRE',	20,	'Gâteau en forme de cadre pour photo.',	'/tinysweets/Web/photos/CADRE.jpg',	4,	1),
(30,	'FRAISE MANGUE KIWI',	20,	'Gâteau à la fraise, à la mangue et au kiwi.',	'/tinysweets/Web/photos/FRAISE_MANGUE_KIWI.jpg',	5,	2),
(31,	'FRAISE MANGUE KIWI 2',	20,	'Gâteau à la fraise, à la mangue et au kiwi.',	'/tinysweets/Web/photos/FRAISE_MANGUE_KIWI2.jpg',	5,	1),
(32,	'MANGUE',	20,	'Gâteau à la mangue.',	'/tinysweets/Web/photos/MANGUE.jpg',	5,	1),
(33,	'MINION',	20,	'Gâteau d\'anniversaire Minion.',	'/tinysweets/Web/photos/MINION.jpg',	2,	1),
(34,	'OREO',	20,	'Un gâteau d\'anniversaire à l\'Oréo.',	'/tinysweets/Web/photos/OREO.jpg',	6,	1),
(35,	'KINDER MMS',	20,	'Gâteau à base de Kinder et de M&Ms',	'/tinysweets/Web/photos/KINDER_MMS.jpg',	6,	2),
(36,	'NOUNOURS BALL',	20,	'Gâteau à base de Nounours et de Kit Kat Ball.',	'/tinysweets/Web/photos/NOUNOURS_BALL.jpg',	6,	1);

DROP TABLE IF EXISTS `ts_newsletter`;
CREATE TABLE `ts_newsletter` (
  `id_newsletter` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `sujet` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `date_news` datetime NOT NULL,
  PRIMARY KEY (`id_newsletter`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `ts_parfum`;
CREATE TABLE `ts_parfum` (
  `id_parfum` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prix` int(2) unsigned NOT NULL,
  PRIMARY KEY (`id_parfum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ts_parfum` (`id_parfum`, `nom`, `prix`) VALUES
(1,	'Nature',	0),
(2,	'Chocolat noir',	5),
(3,	'Chocolat au lait',	5),
(4,	'Chocolat blanc',	5),
(5,	'Vanille',	5),
(6,	'Fraise',	5),
(7,	'Citron',	5),
(8,	'Framboise',	5),
(9,	'Nutella',	10),
(10,	'Vanille - Fraise',	8);

DROP TABLE IF EXISTS `ts_produit`;
CREATE TABLE `ts_produit` (
  `id_produit` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `id_gateau` int(5) unsigned DEFAULT NULL,
  `id_parfum` int(2) unsigned DEFAULT NULL,
  `id_taille` int(2) unsigned DEFAULT NULL,
  `id_promo` int(2) unsigned DEFAULT NULL,
  `quantite` int(2) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_produit`),
  KEY `fk_produit_gateau` (`id_gateau`),
  KEY `fk_produit_parfum` (`id_parfum`),
  KEY `fk_produit_taille` (`id_taille`),
  KEY `fk_produit_promo` (`id_promo`),
  CONSTRAINT `fk_produit_gateau` FOREIGN KEY (`id_gateau`) REFERENCES `ts_gateau` (`id_gateau`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_produit_parfum` FOREIGN KEY (`id_parfum`) REFERENCES `ts_parfum` (`id_parfum`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_produit_promo` FOREIGN KEY (`id_promo`) REFERENCES `ts_promotion` (`id_promo`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_produit_taille` FOREIGN KEY (`id_taille`) REFERENCES `ts_taille` (`id_taille`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ts_produit` (`id_produit`, `id_gateau`, `id_parfum`, `id_taille`, `id_promo`, `quantite`) VALUES
(3,	2,	4,	2,	1,	1),
(4,	4,	1,	1,	1,	1),
(5,	3,	3,	1,	1,	2),
(6,	3,	4,	3,	1,	3),
(7,	3,	1,	1,	1,	1),
(8,	12,	6,	2,	1,	1);

DROP TABLE IF EXISTS `ts_promotion`;
CREATE TABLE `ts_promotion` (
  `id_promo` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `code_promo` varchar(6) NOT NULL,
  `reduction` int(5) unsigned NOT NULL,
  PRIMARY KEY (`id_promo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ts_promotion` (`id_promo`, `code_promo`, `reduction`) VALUES
(1,	'AUCUNE',	0),
(2,	'PROMO1',	5),
(3,	'PROMO2',	10),
(4,	'PROMO3',	15),
(5,	'PROMO4',	20);

DROP TABLE IF EXISTS `ts_taille`;
CREATE TABLE `ts_taille` (
  `id_taille` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(5) NOT NULL,
  `prix` int(3) unsigned NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id_taille`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ts_taille` (`id_taille`, `nom`, `prix`, `description`) VALUES
(1,	'S',	0,	'6 à 8 parts - 8 unités'),
(2,	'M',	10,	'10 à 12 parts - 10 unités'),
(3,	'L',	30,	'18 à 20 parts - 14 unités'),
(4,	'XL',	50,	'26 à 28 parts - 20 unités'),
(5,	'XXL',	90,	'40 à 42 parts - 30 unités');

-- 2016-10-02 19:06:09

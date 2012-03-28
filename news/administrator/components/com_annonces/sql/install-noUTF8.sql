CREATE TABLE IF NOT EXISTS `#__annonces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `etatneuf` tinyint(1) NOT NULL,
  `categorie` int(11) NOT NULL,
  `date` date NOT NULL,
  `constructeur` varchar(100) DEFAULT NULL,
  `objet` varchar(100) NOT NULL,
  `villeObjet` varchar(60) NOT NULL,
  `annee` int(11) DEFAULT NULL,
  `longueur` float DEFAULT NULL,
  `largeur` float DEFAULT NULL,
  `prix` int(11) DEFAULT NULL,
  `vendeurId` int(11) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `portable` varchar(20) NOT NULL,
  `approuved` tinyint(1) NOT NULL,
  `published` tinyint(1) NOT NULL,
  `description` mediumtext NOT NULL,
  `propriete1` varchar(50) NOT NULL,
  `propriete2` varchar(50) NOT NULL,
  `propriete3` varchar(50) NOT NULL,
  `propriete4` varchar(50) NOT NULL,
  `propriete5` varchar(50) NOT NULL,
  `hits` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) TYPE=MyISAM;


CREATE TABLE IF NOT EXISTS `#__annonces_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `catname` varchar(100) NOT NULL DEFAULT '',
  `alias` varchar(100) NOT NULL DEFAULT '',
  `catdescription` mediumtext NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `access` int(11) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `showYear` tinyint(1) NOT NULL,
  `showDimensions` tinyint(1) NOT NULL,
  `showConstructor` tinyint(1) NOT NULL,
  `property1` varchar(50) NOT NULL,
  `property2` varchar(50) NOT NULL,
  `property3` varchar(50) NOT NULL,
  `property4` varchar(50) NOT NULL,
  `property5` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) TYPE=MyISAM;


CREATE TABLE IF NOT EXISTS `#__annonces_parameters` (
  `id` int(11) NOT NULL,
  `published_days` int(11) NOT NULL,
  `currency` varchar(6) NOT NULL,
  `dateFormat` varchar(20) NOT NULL,
  `metric` varchar(20) NOT NULL,
  `headerBgColor` varchar(7) NOT NULL,
  `updateEmailNotification` tinyint(1) NOT NULL
) TYPE=MyISAM;

INSERT INTO `#__annonces_parameters` (`id`, `published_days`, `currency`, `dateFormat`, `metric`, `headerBgColor`, `updateEmailNotification`) VALUES
(1, 0, '&euro;', '%d/%m/%Y', 'm', '#FA3E4C', 0);
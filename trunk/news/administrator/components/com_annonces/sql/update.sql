
CREATE TABLE IF NOT EXISTS `#__annonces_parameters2` (
  `id` int(11) NOT NULL,
  `published_days` int(11) NOT NULL,
  `currency` varchar(6) NOT NULL,
  `dateFormat` varchar(20) NOT NULL,
  `metric` varchar(20) NOT NULL,
  `headerBgColor` varchar(7) NOT NULL,
  `updateEmailNotification` tinyint(1) NOT NULL
) TYPE=MyISAM;

ALTER TABLE `#__annonces` CHANGE `propriete1` `propriete1` VARCHAR( 50 ) NULL;
ALTER TABLE `#__annonces` CHANGE `propriete2` `propriete2` VARCHAR( 50 ) NULL;
ALTER TABLE `#__annonces` CHANGE `propriete3` `propriete3` VARCHAR( 50 ) NULL;
ALTER TABLE `#__annonces` CHANGE `propriete4` `propriete4` VARCHAR( 50 ) NULL;
ALTER TABLE `#__annonces` CHANGE `propriete5` `propriete5` VARCHAR( 50 ) NULL;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mensa_membres`
--

-- --------------------------------------------------------

--
-- Table structure for table `Competences`
--

CREATE TABLE `Competences` (
	`id_competence` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`id_membre` int(11) unsigned NOT NULL DEFAULT '0',
	`nom_competence` varchar(64) NOT NULL,
	`niveau_competence` tinyint(4) NOT NULL,
	`commentaires` text,
	PRIMARY KEY (`id_competence`),
	KEY `FK_Competence_membre` (`id_membre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `Configuration`
--

CREATE TABLE `Configuration` (
	`id_config` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`id_utilisateur` int(11) NOT NULL,
	`id_parametre` tinyint(4) NOT NULL,
	`valeur_parametre` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
	PRIMARY KEY (`id_config`),
	KEY `id_utilisateur` (`id_utilisateur`,`id_parametre`,`valeur_parametre`),
	KEY `id_parametre` (`id_parametre`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Coordonnees`
--

CREATE TABLE `Coordonnees` (
	`id_coordonnee` int(11) NOT NULL AUTO_INCREMENT,
	`id_membre` int(11) unsigned NOT NULL,
	`coordonnee` text NOT NULL,
	`type_coordonnee` enum('phone','address','email','website','im','picture') NOT NULL,
	`usage_coordonnee` enum('mobile','work','home','other','pref','fax','biper') NOT NULL DEFAULT 'pref',
	`reservee_gestion_asso` tinyint(1) NOT NULL,
	PRIMARY KEY (`id_coordonnee`,`id_membre`),
	KEY `id_membre` (`id_membre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Cotisations`
--

CREATE TABLE `Cotisations` (
	`id_membre` int(11) unsigned NOT NULL,
	`id_cotisation` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`id_cotisation_distant` double DEFAULT NULL,
	`tarif` varchar(4) NOT NULL,
	`montant` float NOT NULL,
	`date_debut` datetime NOT NULL,
	`date_fin` datetime NOT NULL,
	`region` varchar(4) NOT NULL,
	PRIMARY KEY (`id_cotisation`),
	KEY `id_membre` (`id_membre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Experiences`
--

CREATE TABLE `Experiences` (
	`id_membre` int(11) unsigned NOT NULL,
	`id_experience` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`titre_experience` varchar(64) NOT NULL,
	`date_debut` date NOT NULL,
	`date_fin` date DEFAULT NULL,
	`nom_organisation` varchar(128) NOT NULL,
	`precisions` text NOT NULL,
	PRIMARY KEY (`id_experience`),
	KEY `id_membre` (`id_membre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Formations`
--

CREATE TABLE `Formations` (
	`id_membre` int(11) unsigned NOT NULL,
	`id_formation` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`titre_formation` varchar(64) NOT NULL,
	`date_debut` date DEFAULT NULL,
	`date_fin` date DEFAULT NULL,
	`nom_ecole` varchar(128) NOT NULL,
	`precisions` text NOT NULL,
	PRIMARY KEY (`id_formation`),
	KEY `id_membre` (`id_membre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Langues`
--

CREATE TABLE `Langues` (
	`id_membre` int(11) unsigned NOT NULL DEFAULT '0',
	`nom_langue` varchar(64) NOT NULL,
	`niveau_langue` tinyint(4) NOT NULL,
	`commentaires` text,
	`id_langue` int(11) unsigned NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id_langue`),
	KEY `id_membre` (`id_membre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `Membres`
--

CREATE TABLE `Membres` (
	`id_membre` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`id_ancien_si` int(11) DEFAULT NULL,
	`pseudonyme` varchar(32) NOT NULL,
	`mot_de_passe` char(32) NOT NULL,
	`ancien_mot_de_passe` varchar(32) NOT NULL,
	`statut` enum('single','couple','deceased') DEFAULT NULL,
	`enfants` tinyint(2) unsigned DEFAULT NULL,
	`civilite` varchar(8) DEFAULT NULL,
	`genre` tinyint(1) DEFAULT NULL,
	`prenom` varchar(64) NOT NULL,
	`nom` varchar(64) NOT NULL,
	`date_naissance` datetime DEFAULT NULL,
	`lieu_naissance` varchar(128) DEFAULT '',
	`date_inscription` datetime DEFAULT NULL,
	`region` varchar(4) DEFAULT NULL,
	`aspirations` varchar(128) DEFAULT NULL,
	`devise` text NOT NULL,
	`note` text NOT NULL,
	PRIMARY KEY (`id_membre`),
	UNIQUE KEY `id_ancien_si` (`id_ancien_si`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Parametres`
--

CREATE TABLE `Parametres` (
	`id_parametre` int(11) NOT NULL AUTO_INCREMENT,
	`nom_parametre` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
	`slug_parametre` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
	`description_parametre` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
	PRIMARY KEY (`id_parametre`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Passions`
--

CREATE TABLE `Passions` (
	`id_passion` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`id_membre` int(11) unsigned NOT NULL,
	`nom_passion` varchar(64) NOT NULL,
	`niveau_passion` tinyint(4) NOT NULL,
	`commentaires` text,
	PRIMARY KEY (`id_passion`),
	KEY `id_membre` (`id_membre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `Statistiques`
--

CREATE TABLE `Statistiques` (
	`nom_stat` varchar(64) COLLATE utf8_bin NOT NULL,
	`id_stat` int(11) NOT NULL AUTO_INCREMENT,
	`valeur_stat` varchar(256) COLLATE utf8_bin NOT NULL,
	PRIMARY KEY (`id_stat`),
	UNIQUE KEY `nom_stat` (`nom_stat`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Competences`
--
ALTER TABLE `Competences`
	ADD CONSTRAINT `FK_Competence_membre` FOREIGN KEY (`id_membre`) REFERENCES `Membres` (`id_membre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Coordonnees`
--
ALTER TABLE `Coordonnees`
	ADD CONSTRAINT `FK_Coordonnee_membre` FOREIGN KEY (`id_membre`) REFERENCES `Membres` (`id_membre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Cotisations`
--
ALTER TABLE `Cotisations`
	ADD CONSTRAINT `FK_Cotisation_membre` FOREIGN KEY (`id_membre`) REFERENCES `Membres` (`id_membre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Experiences`
--
ALTER TABLE `Experiences`
	ADD CONSTRAINT `FK_Experience_membre` FOREIGN KEY (`id_membre`) REFERENCES `Membres` (`id_membre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Formations`
--
ALTER TABLE `Formations`
	ADD CONSTRAINT `FK_Formation_membre` FOREIGN KEY (`id_membre`) REFERENCES `Membres` (`id_membre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Langues`
--
ALTER TABLE `Langues`
	ADD CONSTRAINT `FK_Langue_membre` FOREIGN KEY (`id_membre`) REFERENCES `Membres` (`id_membre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Passions`
--
ALTER TABLE `Passions`
	ADD CONSTRAINT `FK_Passion_membre` FOREIGN KEY (`id_membre`) REFERENCES `Membres` (`id_membre`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 04 mars 2019 à 02:08
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `julien`
--

-- --------------------------------------------------------

--
-- Structure de la table `documents`
--

DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS `documents` (
  `ID_DOC` int(11) NOT NULL AUTO_INCREMENT,
  `TITRE` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `DOCUMENT` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID_DOC`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `documents`
--

INSERT INTO `documents` (`ID_DOC`, `TITRE`, `DOCUMENT`) VALUES
(1, 'VOTRE CHAT COMPTE SUR VOUS POUR ETRE PROTEGE', 'L\'un des meilleurs moyens de permettre à votre chat de vivre en santé pendant de nombreuses années est de le\r\nfaire vacciner contre les maladies félines les plus répandues. Au cours des premières semaines de son\r\nexistence, votre chat a reçu, par le lait de sa mère, des anticorps qui l\'ont immunisé contre certaines maladies.\r\nAprès cette période, c\'est à vous qu\'il revient de protéger votre compagnon, avec l\'aide et les conseils de votre\r\nvétérinaire.'),
(2, 'COMMENT UN VACCIN FONCTIONNE-T-IL ?', 'Un vaccin contient une petite quantité de virus, de bactéries ou d\'autres organismes causant des maladies. Ceuxci\r\nont été soit atténués soit « tués ». Lorsque ces organismes sont administrés à votre chat, ils stimulent son\r\nsystème immunitaire qui produit des cellules et des protéines qui combattent la maladie « les anticorps », et\r\nprotègent votre animal contre certaines maladies.'),
(3, 'QUAND DOIS-JE FAIRE VACCINER MON CHAT ?', 'En général, l\'immunité que reçoit un chaton à sa naissance commence à s\'estomper après neuf semaines. C\'est\r\nalors le moment, habituellement, de lui administrer ses premiers vaccins. Il doit recevoir un rappel de 3 à 4\r\nsemaines plus tard. Par la suite, votre chat devra se faire vacciner régulièrement toute sa vie. Bien sûr, ce ne\r\nsont que des lignes directrices. Votre vétérinaire sera en mesure de déterminer le programme de vaccination qui\r\nrépondra parfaitement aux besoins de votre compagnon félin.'),
(4, 'COMMENT FAIRE DE VOTRE MAISON UN ENDROIT SUR POUR VOS ANIMAUX?', 'Tout comme les parents rendent leur maison à l’épreuve de leurs enfants, les propriétaires d’animaux\r\ndomestiques devraient faire de même pour leur animal domestique. Nos compagnons à quatre pattes sont\r\ncomme les bébés et les bambins : curieux de nature, ils sont portés à explorer leur environnement avec\r\nleurs pattes et leurs griffes et à goûter à tout.'),
(5, 'LES COMPRIMES OU GELULES', 'C\'est certainement le seul médicament qu\'on puisse lui administrer sans problème. Contrairement à ce\r\nqu\'on croit, votre animal est parfaitement capable d\'avaler des gros comprimés'),
(6, 'LES LIQUIDES', 'Agitez le flacon si cela est demandé.'),
(7, 'CONSEILS PRATIQUES', 'Lisez attentivement l\'étiquette.\r\nDemandez à votre vétérinaire à quel moment du repas le médicament peut être donné.'),
(8, 'gggg', 'ggggg'),
(12, 'ooo12', 'WWW');

-- --------------------------------------------------------

--
-- Structure de la table `employer`
--

DROP TABLE IF EXISTS `employer`;
CREATE TABLE IF NOT EXISTS `employer` (
  `ID_EMPLOYER` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  PRIMARY KEY (`ID_EMPLOYER`)
) ENGINE=MyISAM AUTO_INCREMENT=205 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `employer`
--

INSERT INTO `employer` (`ID_EMPLOYER`, `nom`, `prenom`) VALUES
(1, 'Bertelootttt', ' alaintttt'),
(2, 'Besomb', 'Nicole'),
(197, 'k', 'k'),
(4, 'Suzanne', 'Xavier'),
(3, 'Aurignacttt', 'johann'),
(6, 'Bernard', ' Jtrtme'),
(7, 'Faliére', 'Fred'),
(179, 'grere', ' grere'),
(198, 'kg1', '  kg1'),
(196, 'k', 'k'),
(195, 'k', 'k'),
(199, '1', '1'),
(204, 'zz', 'zz'),
(201, '4', '4'),
(203, 'f', 'f');

-- --------------------------------------------------------

--
-- Structure de la table `fiches`
--

DROP TABLE IF EXISTS `fiches`;
CREATE TABLE IF NOT EXISTS `fiches` (
  `ID_FICHE` int(11) NOT NULL AUTO_INCREMENT,
  `FICHE_TITRE` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`ID_FICHE`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `fiches`
--

INSERT INTO `fiches` (`ID_FICHE`, `FICHE_TITRE`) VALUES
(1, 'Maladies et  vaccination'),
(2, 'Les dangers domestiques'),
(3, 'Administration des medicaments'),
(5, 'teste123478');

-- --------------------------------------------------------

--
-- Structure de la table `fiches_documents`
--

DROP TABLE IF EXISTS `fiches_documents`;
CREATE TABLE IF NOT EXISTS `fiches_documents` (
  `ID_FICHE` int(11) NOT NULL,
  `ID_DOC` int(11) NOT NULL,
  PRIMARY KEY (`ID_FICHE`,`ID_DOC`),
  KEY `FK_THEMES_DOCUMENTS_2` (`ID_DOC`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `fiches_documents`
--

INSERT INTO `fiches_documents` (`ID_FICHE`, `ID_DOC`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 4),
(3, 5),
(3, 6),
(3, 7),
(5, 12);

-- --------------------------------------------------------

--
-- Structure de la table `metiers`
--

DROP TABLE IF EXISTS `metiers`;
CREATE TABLE IF NOT EXISTS `metiers` (
  `ID_METIER` int(11) NOT NULL AUTO_INCREMENT,
  `METIER` varchar(25) NOT NULL,
  PRIMARY KEY (`ID_METIER`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `metiers`
--

INSERT INTO `metiers` (`ID_METIER`, `METIER`) VALUES
(1, 'Docteurs1234'),
(2, 'PLOMBIER'),
(49, 'teste');

-- --------------------------------------------------------

--
-- Structure de la table `metiers_employers`
--

DROP TABLE IF EXISTS `metiers_employers`;
CREATE TABLE IF NOT EXISTS `metiers_employers` (
  `ID_EMPLOYER` int(11) NOT NULL,
  `ID_METIER` int(11) NOT NULL,
  PRIMARY KEY (`ID_EMPLOYER`,`ID_METIER`),
  KEY `FK_THEMES_DOCUMENTS_2` (`ID_METIER`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `metiers_employers`
--

INSERT INTO `metiers_employers` (`ID_EMPLOYER`, `ID_METIER`) VALUES
(1, 1),
(2, 2),
(3, 1),
(4, 2),
(5, 1),
(6, 1),
(7, 2),
(187, 1),
(188, 1),
(189, 1),
(190, 1),
(191, 1),
(192, 1),
(193, 1),
(194, 1),
(195, 1),
(196, 1),
(197, 1),
(198, 1),
(201, 49);

-- --------------------------------------------------------

--
-- Structure de la table `specialites`
--

DROP TABLE IF EXISTS `specialites`;
CREATE TABLE IF NOT EXISTS `specialites` (
  `ID_SPECIALITES` int(11) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(25) NOT NULL,
  PRIMARY KEY (`ID_SPECIALITES`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `specialites`
--

INSERT INTO `specialites` (`ID_SPECIALITES`, `NOM`) VALUES
(1, 'Radiographie'),
(2, 'Echographie '),
(3, 'Analyses sanguines'),
(4, 'Laboratoire'),
(5, 'Dentisterie'),
(6, 'Chirurgie'),
(7, 'Hospitalisation'),
(8, 'Service de garde ');

-- --------------------------------------------------------

--
-- Structure de la table `themes`
--

DROP TABLE IF EXISTS `themes`;
CREATE TABLE IF NOT EXISTS `themes` (
  `ID_THEME` int(11) NOT NULL AUTO_INCREMENT,
  `THEME` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_THEME`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `themes`
--

INSERT INTO `themes` (`ID_THEME`, `THEME`) VALUES
(2, 'METIER223'),
(3, 'METIER3');

-- --------------------------------------------------------

--
-- Structure de la table `themes_documents`
--

DROP TABLE IF EXISTS `themes_documents`;
CREATE TABLE IF NOT EXISTS `themes_documents` (
  `ID_THEME` int(11) NOT NULL,
  `ID_DOC` int(11) NOT NULL,
  PRIMARY KEY (`ID_THEME`,`ID_DOC`),
  KEY `FK_THEMES_DOCUMENTS_2` (`ID_DOC`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `themes_documents`
--

INSERT INTO `themes_documents` (`ID_THEME`, `ID_DOC`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(3, 12),
(3, 13),
(3, 14),
(3, 15),
(3, 16),
(4, 17),
(4, 18),
(4, 20),
(5, 10),
(5, 11);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `ID_USER` int(11) NOT NULL AUTO_INCREMENT,
  `LOGIN` varchar(10) NOT NULL,
  `PASSWORD` varchar(10) NOT NULL,
  `NOM` varchar(100) NOT NULL,
  `PRENOM` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_USER`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`ID_USER`, `LOGIN`, `PASSWORD`, `NOM`, `PRENOM`) VALUES
(1, 'ju', 'ju', 'ju', 'ju');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

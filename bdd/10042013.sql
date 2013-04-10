-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 10 Avril 2013 à 08:29
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `udaf`
--

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE IF NOT EXISTS `evenement` (
  `evenement_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_event` varchar(10) DEFAULT NULL,
  `mode_contact` varchar(30) DEFAULT NULL,
  `raison_sociale` varchar(30) DEFAULT NULL,
  `traite` tinyint(1) DEFAULT NULL,
  `comm_event` text,
  `user_id` int(11) NOT NULL,
  `dossier_id` int(11) NOT NULL,
  PRIMARY KEY (`evenement_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `evenement`
--

INSERT INTO `evenement` (`evenement_id`, `date_event`, `mode_contact`, `raison_sociale`, `traite`, `comm_event`, `user_id`, `dossier_id`) VALUES
(1, '12/10/2012', 'T&eacute;l&eacute;phone', NULL, 0, 'test event non traite', 1, 20130003),
(2, '12/11/2012', 'Mail', NULL, 1, 'test event non traite', 1, 20130002),
(3, '12/01/2013', 'rdv', NULL, 1, 'test event traite', 1, 20130001),
(4, '20/102012', 'e-Mail', NULL, 0, 'Test 4 ', 3, 20130001),
(5, '03/04/2013', 'teledx', NULL, 0, NULL, 0, 20130004),
(6, '10/04/2013', 'rvferdvf', NULL, 0, NULL, 0, 20130004),
(7, '25/04/2013', 'teledx', NULL, 0, NULL, 0, 20130004),
(8, '14/04/2013', 'rvferdvf', NULL, 0, NULL, 0, 20130004),
(9, '14/04/2013', 'rvferdvf', NULL, 0, NULL, 0, 20130004),
(10, '11/04/2013', 'rvferdvf', NULL, 0, 'ghj', 0, 20130005),
(11, '11/04/2013', 'gfdesrz', NULL, 0, 'fdghjklmÃ¹', 0, 20130005),
(12, '14/04/2013', 'rgfdezf', NULL, 0, 'retgyhjik_uÃ§olp', 0, 20130005),
(13, '19/04/2013', 'TÃ©lÃ©phone', NULL, 1, 'dfghjklmjhgfds', 0, 20130005),
(14, '21/04/2013', 'gfdesrz', NULL, 0, 'dsedrtykujfhdgsf', 0, 20130005),
(15, '20/04/2013', 'teledx', NULL, 0, 'hgjklmÃ¹', 0, 20130005),
(16, '18/04/2013', 'gfdesrz', NULL, 0, 'tyhutgfrdgyhuygftrdtghj', 5, 20130005);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

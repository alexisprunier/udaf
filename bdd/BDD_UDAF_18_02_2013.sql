-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le : Jeu 21 Mars 2013 à 10:05
-- Version du serveur: 5.5.20
-- Version de PHP: 5.3.9

SET FOREIGN_KEY_CHECKS=0;
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
-- Structure de la table `dossier`
--

DROP TABLE IF EXISTS `dossier`;
CREATE TABLE IF NOT EXISTS `dossier` (
  `dossier_id` int(11) NOT NULL AUTO_INCREMENT,
  `dossier_ref` varchar(8) NOT NULL,
  `date_creation_d` varchar(10) NOT NULL DEFAULT '00/00/0000',
  `problematique` text,
  `cloture` tinyint(1) DEFAULT NULL,
  `raison_cloture` varchar(20) DEFAULT NULL,
  `comment_cloture` text,
  `date_cloture` varchar(10) NOT NULL DEFAULT '00/00/0000',
  `dossier_physique` tinyint(1) DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `theme_id` int(11) NOT NULL,
  `soustheme_id` int(11) NOT NULL,
  `fournisseur_id` int(11) NOT NULL,
  `personne_id` int(11) NOT NULL,
  PRIMARY KEY (`dossier_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `dossier`
--

INSERT INTO `dossier` (`dossier_id`, `dossier_ref`, `date_creation_d`, `problematique`, `cloture`, `raison_cloture`, `comment_cloture`, `date_cloture`, `dossier_physique`, `user_id`, `theme_id`, `soustheme_id`, `fournisseur_id`, `personne_id`) VALUES
(3, '20130003', '13/03/2013', 'azefzsf', NULL, NULL, NULL, '', NULL, 1, 3, 3, 3, 4),
(4, '20130004', '14/03/2013', 'exemple', NULL, NULL, NULL, '', NULL, 1, 14, 17, 4, 3),
(5, '20130005', '14/03/2013', 'exemple 2', NULL, NULL, NULL, '', 1, 1, 14, 21, 5, 5);

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `evenement`
--

INSERT INTO `evenement` (`evenement_id`, `date_event`, `mode_contact`, `raison_sociale`, `traite`, `comm_event`, `user_id`, `dossier_id`) VALUES
(1, '12/10/2012', 'Téléphone', NULL, 0, 'test event non traite', 1, 1),
(2, '12/11/2012', 'Mail', NULL, 1, 'test event non traite', 1, 2),
(3, '12/01/2013', 'rdv', NULL, 1, 'test event traite', 1, 3),
(4, '20/102012', 'e-Mail', NULL, 0, 'Test 4 ', 3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `fichier`
--

DROP TABLE IF EXISTS `fichier`;
CREATE TABLE IF NOT EXISTS `fichier` (
  `fichier_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) DEFAULT NULL,
  `type_fichier` varchar(5) DEFAULT NULL,
  `dossier_id` int(11) NOT NULL,
  PRIMARY KEY (`fichier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

DROP TABLE IF EXISTS `fournisseur`;
CREATE TABLE IF NOT EXISTS `fournisseur` (
  `fournisseur_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_creation_f` varchar(10) NOT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `raison_sociale` varchar(30) DEFAULT NULL,
  `adr_postale` varchar(50) DEFAULT NULL,
  `code_postal` int(5) DEFAULT NULL,
  `ville` varchar(30) DEFAULT NULL,
  `tel` int(10) DEFAULT NULL,
  `mail` varchar(30) DEFAULT NULL,
  `comment_fournisseur` text,
  PRIMARY KEY (`fournisseur_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `fournisseur`
--

INSERT INTO `fournisseur` (`fournisseur_id`, `date_creation_f`, `nom`, `prenom`, `raison_sociale`, `adr_postale`, `code_postal`, `ville`, `tel`, `mail`, `comment_fournisseur`) VALUES
(3, '13/03/2013', 'zzze', 'erfd', 'dzfds', 'dsfs', 1234, 'aloes', 0, 'zeoifdezf@reza.fr', 'zfgefgzze'),
(4, '14/03/2013', 'WILSIM', 'CORP', 'WILSIM CORP', '', 0, '', 0, '', ''),
(5, '14/03/2013', 'Tranquility', 'Server', 'NeoTarma', '', 0, '', 0, 'email@email.com', '');

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

DROP TABLE IF EXISTS `personne`;
CREATE TABLE IF NOT EXISTS `personne` (
  `personne_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_creation_p` varchar(10) NOT NULL,
  `sexe` int(1) NOT NULL DEFAULT '0',
  `nom` varchar(45) DEFAULT NULL,
  `prenom` varchar(45) DEFAULT NULL,
  `adr_postale` varchar(100) DEFAULT NULL,
  `code_postal` varchar(5) NOT NULL DEFAULT '00000',
  `ville` varchar(45) DEFAULT NULL,
  `tel_fixe` varchar(10) NOT NULL DEFAULT '0000000000',
  `tel_port` varchar(10) NOT NULL DEFAULT '0600000000',
  `mail` varchar(45) NOT NULL DEFAULT 'personne@personne.fr',
  PRIMARY KEY (`personne_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `personne`
--

INSERT INTO `personne` (`personne_id`, `date_creation_p`, `sexe`, `nom`, `prenom`, `adr_postale`, `code_postal`, `ville`, `tel_fixe`, `tel_port`, `mail`) VALUES
(3, '', 1, 'aze', 'ert', 'ert', '11111', 'gorob', '0321456963', '1234567890', 'poze@oio.com'),
(4, '14/03/2013', 1, 'Simon', 'Jocelyn', '', '', '', '0695323261', '', ''),
(5, '14/03/2013', 2, 'Kawie', 'Pearl', '', '', '', '0695323261', '', 'email@email.com');

-- --------------------------------------------------------

--
-- Structure de la table `siteweb`
--

DROP TABLE IF EXISTS `siteweb`;
CREATE TABLE IF NOT EXISTS `siteweb` (
  `site_id` int(11) NOT NULL AUTO_INCREMENT,
  `lien` varchar(30) DEFAULT NULL,
  `dossier_id` int(11) NOT NULL,
  PRIMARY KEY (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `soustheme`
--

DROP TABLE IF EXISTS `soustheme`;
CREATE TABLE IF NOT EXISTS `soustheme` (
  `soustheme_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(60) DEFAULT NULL,
  `theme_id` int(11) NOT NULL,
  PRIMARY KEY (`soustheme_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Contenu de la table `soustheme`
--

INSERT INTO `soustheme` (`soustheme_id`, `nom`, `theme_id`) VALUES
(1, 'Produits alimentaire', 1),
(2, 'Auto', 2),
(3, 'Habitation', 2),
(4, 'Responsabilit', 2),
(5, 'Santé', 2),
(6, 'Automobile', 3),
(7, 'Transports aérien', 3),
(8, 'Transports en commun', 3),
(9, 'Banque', 4),
(10, 'Budget familial', 4),
(11, 'Crédit', 4),
(12, 'Epargne', 4),
(13, 'Impôts', 4),
(14, 'Placement assurance vie', 4),
(15, 'Surendettement', 4),
(16, 'Pratiques commerciales', 5),
(17, 'Publicité', 5),
(18, 'Vente (Internet-magasin-à domicile)', 5),
(19, 'Consumérisme', 6),
(20, 'Médiation-Conciliation', 7),
(21, 'Recours-Procédures', 7),
(22, 'Démarches administratives', 8),
(23, 'Service à la personne', 8),
(24, 'Société', 8),
(25, 'Energie (Electricité-Gaz)', 9),
(26, 'Eau', 10),
(27, 'Internet', 11),
(28, 'Multimédia-Image-Son', 11),
(29, 'Téléphone', 11),
(30, 'Achat-Vente-Construction', 12),
(31, 'Copropriété', 12),
(32, 'Location', 12),
(33, 'Rénovation', 12),
(34, 'Voisinage', 12),
(35, 'Sports', 13),
(36, 'Vacances (location de vacances)', 13),
(37, 'Maladie', 14),
(38, 'Pratique médicales', 14),
(39, 'Produit de santé', 14),
(40, 'Sécurité domestique', 15);

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
  `theme_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`theme_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `theme`
--

INSERT INTO `theme` (`theme_id`, `nom`) VALUES
(1, 'Alimentation-Agriculture'),
(2, 'Assurance'),
(3, 'Automobile-Transport'),
(4, 'Banque-Argent'),
(5, 'Commerce'),
(6, 'Consumerisme'),
(7, 'Droit-Justice'),
(8, 'Economie'),
(9, 'Education-Société'),
(10, 'Energie (Electricité-Gaz)'),
(11, 'Environnement-Développement durable'),
(12, 'Internet-Image-Son'),
(13, 'Logement-Immobilier'),
(14, 'Loisir-Tourisme'),
(15, 'Santé'),
(16, 'Sécurité domestique');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `ident` varchar(30) DEFAULT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `administrateur` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`user_id`, `ident`, `nom`, `prenom`, `pass`, `administrateur`) VALUES
(1, 'admin', 'admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1),
(3, 'ahivert', 'Hivert', 'Anthony', 'd953d8aa4163fb91f8a3cf5e6f96fb6fdced2fe3', 1),
(4, 'jsimon', 'Simon', 'Jocelyn', '54fd1711209fb1c0781092374132c66e79e2241b', 1),
(5, 'aprunier', 'Prunier', 'Alexis', '75365c8bf652a0e26c6f27d2bbcf2cd9493c6027', 1),
(6, 'user1', 'user1', 'user1', 'b3daa77b4c04a9551b8781d03191fe098f325e67', 0),
(7, 'user2', 'user2', 'user2', 'a1881c06eec96db9901c7bbfe41c42a3f08e9cb4', 0);
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

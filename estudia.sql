-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 19 oct. 2021 à 07:16
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `estudia`
--

-- --------------------------------------------------------

--
-- Structure de la table `conversations`
--

DROP TABLE IF EXISTS `conversations`;
CREATE TABLE IF NOT EXISTS `conversations` (
  `idConversation` int(11) NOT NULL AUTO_INCREMENT,
  `idEnvoyeur` int(11) NOT NULL,
  `idReceveur` int(11) NOT NULL,
  PRIMARY KEY (`idConversation`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `conversations`
--

INSERT INTO `conversations` (`idConversation`, `idEnvoyeur`, `idReceveur`) VALUES
(1, 16, 2),
(2, 16, 3),
(3, 5, 3);

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

DROP TABLE IF EXISTS `cours`;
CREATE TABLE IF NOT EXISTS `cours` (
  `idUtilisateur` int(11) NOT NULL,
  `idEtude` int(11) NOT NULL,
  `matiere` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idUtilisateur`,`idEtude`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `devoirs`
--

DROP TABLE IF EXISTS `devoirs`;
CREATE TABLE IF NOT EXISTS `devoirs` (
  `idDevoir` int(11) NOT NULL AUTO_INCREMENT,
  `idEtude` int(11) NOT NULL,
  `idMatiere` int(11) NOT NULL,
  `Titre` varchar(100) NOT NULL,
  `Info` text,
  `laDate` date NOT NULL,
  PRIMARY KEY (`idDevoir`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `devoirs`
--

INSERT INTO `devoirs` (`idDevoir`, `idEtude`, `idMatiere`, `Titre`, `Info`, `laDate`) VALUES
(1, 2, 1, 'Controle', 'PHP, JS', '2021-03-26'),
(2, 2, 1, 'Controle', 'Matrice', '2021-03-26'),
(3, 2, 2, 'Controle', 'Ecriture perso', '2021-03-27'),
(4, 2, 2, 'test', 'test', '2021-03-27'),
(5, 2, 1, 'test', 'Ecriture perso', '2021-03-27'),
(6, 2, 2, 'DST: Suite arithmétique', 'Revoir le chapitre 1 et 2 sur les suites arithmétique', '2021-09-21'),
(7, 2, 1, 'Controle', '', '2021-10-19');

-- --------------------------------------------------------

--
-- Structure de la table `edt`
--

DROP TABLE IF EXISTS `edt`;
CREATE TABLE IF NOT EXISTS `edt` (
  `idCours` int(11) NOT NULL AUTO_INCREMENT,
  `idUtilisateur` int(11) NOT NULL,
  `idSalle` int(11) NOT NULL,
  `idClasse` int(11) NOT NULL,
  `matiere` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `horaireDebut` time NOT NULL,
  `horaireFin` time NOT NULL,
  `groupe` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`idCours`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `edt`
--

INSERT INTO `edt` (`idCours`, `idUtilisateur`, `idSalle`, `idClasse`, `matiere`, `date`, `horaireDebut`, `horaireFin`, `groupe`) VALUES
(1, 4, 1, 2, 'Histoire', '2021-10-19', '08:00:00', '10:00:00', NULL),
(2, 4, 2, 2, 'Mathématique', '2021-10-19', '10:00:00', '11:00:00', NULL),
(3, 4, 3, 2, 'Français', '2021-10-19', '12:00:00', '14:00:00', NULL),
(4, 4, 4, 2, 'Anglais', '2021-10-19', '14:00:00', '15:00:00', NULL),
(5, 4, 5, 2, 'Mathématique', '2021-10-19', '15:00:00', '16:00:00', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

DROP TABLE IF EXISTS `eleve`;
CREATE TABLE IF NOT EXISTS `eleve` (
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `IDfiliere` int(11) DEFAULT NULL,
  `idEtude` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `eleve`
--

INSERT INTO `eleve` (`nom`, `prenom`, `idUtilisateur`, `IDfiliere`, `idEtude`) VALUES
('Dupont', 'Gilbert', 2, NULL, 2),
('Dufour', 'Alexis', 3, NULL, 2),
('Macron', 'David', 16, NULL, 2),
('Vallée', 'Nicole', 19, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `enseignants`
--

DROP TABLE IF EXISTS `enseignants`;
CREATE TABLE IF NOT EXISTS `enseignants` (
  `Nom` varchar(100) NOT NULL,
  `Prenom` varchar(100) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `idFiliere` int(11) DEFAULT NULL,
  `matiere` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `enseignants`
--

INSERT INTO `enseignants` (`Nom`, `Prenom`, `idUtilisateur`, `idFiliere`, `matiere`) VALUES
('Laforest', 'Roxanne', 18, NULL, 'Francais'),
('Labossière', 'Didiane', 20, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `etudes`
--

DROP TABLE IF EXISTS `etudes`;
CREATE TABLE IF NOT EXISTS `etudes` (
  `idEtude` int(11) NOT NULL AUTO_INCREMENT,
  `classe` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  PRIMARY KEY (`idEtude`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etudes`
--

INSERT INTO `etudes` (`idEtude`, `classe`, `nom`) VALUES
(1, 1, 'Seconde'),
(2, 1, 'Première'),
(3, 1, 'Terminale'),
(4, 2, 'Seconde'),
(5, 2, 'Première'),
(6, 2, 'Terminale');

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

DROP TABLE IF EXISTS `filiere`;
CREATE TABLE IF NOT EXISTS `filiere` (
  `idFiliere` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  PRIMARY KEY (`idFiliere`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `matieres`
--

DROP TABLE IF EXISTS `matieres`;
CREATE TABLE IF NOT EXISTS `matieres` (
  `idMatiere` int(11) NOT NULL AUTO_INCREMENT,
  `matiere` varchar(100) NOT NULL,
  PRIMARY KEY (`idMatiere`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `matieres`
--

INSERT INTO `matieres` (`idMatiere`, `matiere`) VALUES
(1, 'Français'),
(2, 'Mathématiques'),
(3, 'Science'),
(4, 'Physique-Chimie'),
(5, 'Histoire-Géographie'),
(6, 'Anglais'),
(7, 'Espagnol');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `idMessage` int(11) NOT NULL AUTO_INCREMENT,
  `idConversation` int(11) NOT NULL,
  `idEnvoyeur` int(11) DEFAULT NULL,
  `idReceveur` int(11) DEFAULT NULL,
  `message` varchar(400) DEFAULT NULL,
  `date_envoie` date DEFAULT NULL,
  `heure_envoie` time DEFAULT NULL,
  PRIMARY KEY (`idMessage`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE IF NOT EXISTS `notes` (
  `idNote` int(11) NOT NULL AUTO_INCREMENT,
  `idUtilisateur` int(11) NOT NULL,
  `idProf` int(11) NOT NULL,
  `Note` float NOT NULL,
  `idMatiere` int(11) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `NoteMax` int(2) NOT NULL DEFAULT '20',
  `Commentaire` text,
  PRIMARY KEY (`idNote`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `notes`
--

INSERT INTO `notes` (`idNote`, `idUtilisateur`, `idProf`, `Note`, `idMatiere`, `designation`, `NoteMax`, `Commentaire`) VALUES
(1, 3, 0, 15, 1, 'TPE', 20, NULL),
(2, 2, 0, 16, 1, 'TPE', 20, NULL),
(3, 16, 0, 17, 1, 'TPE', 20, NULL),
(4, 3, 0, 9, 2, 'Addition et soustraction ', 10, NULL),
(5, 2, 0, 8, 2, 'Addition et soustraction ', 10, NULL),
(6, 16, 0, 3, 2, 'Addition et soustraction ', 10, NULL),
(7, 3, 0, 5, 2, 'TPE', 20, NULL),
(8, 2, 0, 9, 2, 'TPE', 20, NULL),
(9, 16, 0, 12, 2, 'TPE', 20, NULL),
(10, 3, 0, 10, 2, 'TPE', 20, NULL),
(11, 2, 0, 8, 2, 'TPE', 20, NULL),
(12, 16, 0, 12, 2, 'TPE', 20, NULL),
(13, 3, 5, 16, 6, 'controle anglais', 20, 'Commentaire 1'),
(14, 2, 5, 12, 6, 'controle anglais', 20, 'Commentaire 2'),
(15, 16, 5, 10, 6, 'controle anglais', 20, '');

-- --------------------------------------------------------

--
-- Structure de la table `punition`
--

DROP TABLE IF EXISTS `punition`;
CREATE TABLE IF NOT EXISTS `punition` (
  `idPunition` int(11) NOT NULL AUTO_INCREMENT,
  `idEleve` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `motif` text NOT NULL,
  `ladate` date NOT NULL,
  `punition` text NOT NULL,
  PRIMARY KEY (`idPunition`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `punition`
--

INSERT INTO `punition` (`idPunition`, `idEleve`, `idUtilisateur`, `motif`, `ladate`, `punition`) VALUES
(1, 16, 5, 'Manque de respect ', '2021-10-18', '2 heures de colles');

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

DROP TABLE IF EXISTS `salle`;
CREATE TABLE IF NOT EXISTS `salle` (
  `idSalle` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) NOT NULL,
  PRIMARY KEY (`idSalle`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`idSalle`, `numero`) VALUES
(1, 101),
(2, 102),
(3, 103),
(4, 104),
(5, 105),
(6, 106),
(7, 107),
(8, 108),
(9, 201),
(10, 202);

-- --------------------------------------------------------

--
-- Structure de la table `statuts`
--

DROP TABLE IF EXISTS `statuts`;
CREATE TABLE IF NOT EXISTS `statuts` (
  `idStatut` int(11) NOT NULL AUTO_INCREMENT,
  `statut` varchar(100) NOT NULL,
  PRIMARY KEY (`idStatut`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `statuts`
--

INSERT INTO `statuts` (`idStatut`, `statut`) VALUES
(1, 'root'),
(2, 'Administration'),
(3, 'Professeur'),
(4, 'Etudiant');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `identifiant` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `dateNaiss` date NOT NULL,
  `mdp` varchar(100) NOT NULL,
  `mdpTemp` varchar(100) NOT NULL,
  `statut` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idUtilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `email`, `identifiant`, `nom`, `prenom`, `dateNaiss`, `mdp`, `mdpTemp`, `statut`) VALUES
(1, NULL, 'ASuper05', 'Super', 'Admin', '2000-01-01', '$2y$10$W035IQJDEm3PPnPJ0Y22cuRDZp1iCU9A8jjl7Wux7ic97K0zkD7OW', 'iRS2KwDs', 'Administration'),
(2, NULL, 'GDupont41', 'Dupont', 'Gilbert', '2005-05-20', '$2y$10$/NZ8F25ol7q5Q0vyDT.FOuO6ZVbDrrs9o1hzLwCliUJs/r6R33/YC', 'o1vxHBM6', 'Etudiant'),
(3, NULL, 'ADufour39', 'Dufour', 'Alexis', '2006-06-05', '$2y$10$EZ9bn4sCVss9h.c1/lWiputYQfB014EtFalmmrKQfpp7p.cE9sqMi', 'mPj8kxFu', 'Etudiant'),
(4, NULL, 'ASuper71', 'Super', 'Admin2', '2000-02-23', '$2y$10$t/ouCBS48fg9ytkvpTP6N.quh/hio0ygfuJBrYxFDI5LxD5rg77Di', 'i6XZo7NL', 'Administration'),
(5, NULL, 'BLeraut72', 'Leraut', 'Bastien', '1986-05-15', '$2y$10$dKqY24l.dvt1RAcz3eo.bOxCjCQrvhgb01aIKJQCk/crf7r4Npium', '8mQqkJjS', 'Professeur'),
(6, NULL, 'ttest02', 'test', 'testtest', '2000-02-23', '$2y$10$wrlF4VBCNMooWdD83KM/PO2vCnFJT2d4lgkhiR777jxbvdGn.dMqu', '3t8KRNhW', 'Etudiant'),
(7, NULL, 'ttest57', 'test', 'testtest', '2000-02-23', '$2y$10$jNRvExY9kIRZH6QMPW5rGOYdsaA/kZatUvcWhr271O2EjMl6QzOXK', 'yzPkCEN3', 'Etudiant'),
(8, NULL, 'ttest05', 'test', 'testtest', '2000-02-23', '$2y$10$2E96niFSPJNe5hRhO1Dw6uSR0KwoRt/Ed3RU3KsPz0oidQqw81UTa', '7FUcdbn9', 'Etudiant'),
(9, NULL, 'ttest92', 'test', 'testtest', '2000-02-23', '$2y$10$Ye062OnkwQ3jgqq877Qya.Uoijknr0I7AjQHherR5o3gcu56JtoUW', 'cMmaVAu8', 'Etudiant'),
(10, NULL, 'ttest47', 'test', 'test2', '2000-02-23', '$2y$10$EaBEDKXLn21XtwBisjO6auLMIzal5uLpww1xRIenHYUGx6EgAssuW', '8gZDi5Oy', 'Etudiant'),
(11, NULL, 'ttest02', 'test', 'test3', '2000-02-23', '$2y$10$a9IhacAkPa7.CuBzeYDhfumynZ39BiK/uXNBA2avfersaBRVhnU5K', 'oaYKD4h9', 'Etudiant'),
(12, NULL, 'ttest57', 'test', 'test3', '2000-02-23', '$2y$10$BkHCljUPYvfG1tQNrR/7LuJUavGy1TDjvmULA.db0IoirjwiosAEe', 'ixKBE681', 'Etudiant'),
(13, NULL, 'ttest67', 'test', 'test4', '2000-02-23', '$2y$10$OKdmCY9wQjYhRILE6LQCF.np5GMHqkw3mbhlAiVIHaaaR1dqeGlXG', 'IpxHja96', 'Etudiant'),
(14, NULL, 'ttest42', 'test', 'test4', '2000-02-23', '$2y$10$gOKHz7kgmzeVLDnwTfkcvuVoMx/nH9kvUZDnVkCtk8eAmGcIfwrsi', '7ApWBXRw', 'Professeur'),
(15, NULL, 'ttest76', 'test', 'test4', '2000-02-23', '$2y$10$hGI6GSdhGs48rahVugm9wuykt86nacDdgO9.NLLft3Jp.BjKUTlKa', '1sTjoc82', 'Professeur'),
(16, 'd.carneiro@ecole-ipssi.net', 'DMacron74', 'Macron', 'David', '2000-05-23', '$2y$10$mljKBKDSamzw9C937vH.ruk2MZZC/0kjrlMSFSlWvFIfK5J/CEGau', 'NAMZeCwv', 'Etudiant'),
(17, 'CamilleAudet@armyspy.com', 'CAudet49', 'Audet', 'Camille', '1957-02-06', '$2y$10$Q8yQypg6IK3.LPqpH/Nvg.vslmmQ4.sNbFkXXOL.BxHXXcoiHJ2IS', 'L1P9op7l', 'Professeur'),
(18, 'RoxanneLaforest@armyspy.com', 'RLaforest68', 'Laforest', 'Roxanne', '1956-03-19', '$2y$10$Q8Hw48NHt2XxVokIouBgF.BCKo43eBUDe5PEjZ0fSowUx62wXZJJO', 't0hO6rng', 'Professeur'),
(19, 'NicoleVallee@jourrapide.com', 'NVallée96', 'Vallée', 'Nicole', '2003-07-01', '$2y$10$tUdLduBOhggSZWcH/VV0G.KjIQZKz42GmCaP9YCBrB10TK160zdzy', 'hZfKNia6', 'Etudiant'),
(20, 'DidianeLabossiere@jourrapide.com', 'DLabossière29', 'Labossière', 'Didiane', '1987-12-04', '$2y$10$q42R8X4ofdQ3u3X9igsDGOtzX99nR8A8WWRmDTOV.FQLVSrgf.suq', 'b5LUnBzj', 'Professeur');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

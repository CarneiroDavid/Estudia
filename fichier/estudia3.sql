-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 30 mars 2022 à 23:14
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `estudia3`
--

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`ipssisqestudia`@`%` PROCEDURE `recupConvUser` (IN `p_idUser` INT)  BEGIN 
    
    SELECT COUNT(*)
    FROM conversations
    WHERE idEnvoyeur = p_idUser OR idReceveur = p_idUser;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `absence`
--

CREATE TABLE `absence` (
  `idAbsence` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `idProf` int(11) NOT NULL,
  `justification` varchar(100) NOT NULL,
  `verifJustification` varchar(3) NOT NULL,
  `idCours` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `absence`
--

INSERT INTO `absence` (`idAbsence`, `idUtilisateur`, `idProf`, `justification`, `verifJustification`, `idCours`) VALUES
(1, 3, 5, 'transport', 'non', 0),
(2, 3, 4, '', 'non', 4),
(3, 3, 4, 'dqsdqdsqd', 'oui', 4),
(4, 3, 4, 'dqsdq', 'oui', 4),
(5, 3, 4, 'dqsdqssss', 'oui', 4),
(6, 16, 4, '', 'non', 3);

--
-- Déclencheurs `absence`
--
DELIMITER $$
CREATE TRIGGER `AppelDone` AFTER INSERT ON `absence` FOR EACH ROW UPDATE edt SET edt.appel = 1 WHERE edt.idCours = idCours
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `conversations`
--

CREATE TABLE `conversations` (
  `idConversation` int(11) NOT NULL,
  `idEnvoyeur` int(11) NOT NULL,
  `idReceveur` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `conversations`
--

INSERT INTO `conversations` (`idConversation`, `idEnvoyeur`, `idReceveur`) VALUES
(5, 4, 60),
(6, 4, 16);

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `idUtilisateur` int(11) NOT NULL,
  `idEtude` int(11) NOT NULL,
  `matiere` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `devoirs`
--

CREATE TABLE `devoirs` (
  `idDevoir` int(11) NOT NULL,
  `idEtude` int(11) NOT NULL,
  `idProf` int(11) NOT NULL,
  `idMatiere` int(11) NOT NULL,
  `Titre` varchar(100) NOT NULL,
  `Info` varchar(100) DEFAULT NULL,
  `laDate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `devoirs`
--

INSERT INTO `devoirs` (`idDevoir`, `idEtude`, `idProf`, `idMatiere`, `Titre`, `Info`, `laDate`) VALUES
(1, 2, 60, 2, 'testDevoir', 'Test Informations devoir', '2022-03-23');

-- --------------------------------------------------------

--
-- Structure de la table `edt`
--

CREATE TABLE `edt` (
  `idCours` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `idSalle` int(11) NOT NULL,
  `idClasse` int(11) NOT NULL,
  `matiere` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `horaireDebut` time NOT NULL,
  `horaireFin` time NOT NULL,
  `appel` tinyint(1) DEFAULT NULL,
  `resumeCours` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `edt`
--

INSERT INTO `edt` (`idCours`, `idUtilisateur`, `idSalle`, `idClasse`, `matiere`, `date`, `horaireDebut`, `horaireFin`, `appel`, `resumeCours`) VALUES
(1, 60, 1, 2, 'Histoire', '2022-03-14', '08:00:00', '10:00:00', 1, NULL),
(2, 61, 2, 2, 'Mathématique', '2022-03-14', '10:00:00', '11:00:00', 1, NULL),
(3, 59, 3, 2, 'Français', '2022-03-14', '12:00:00', '14:00:00', 1, NULL),
(4, 53, 4, 2, 'Anglais', '2022-03-14', '14:00:00', '15:00:00', 1, NULL),
(5, 61, 5, 2, 'Mathématique', '2022-03-14', '15:00:00', '16:00:00', 1, NULL),
(6, 17, 5, 2, 'Sport', '2022-03-14', '16:00:00', '17:00:00', 1, NULL),
(7, 17, 5, 2, 'Espagnol', '2022-03-14', '17:00:00', '18:00:00', 1, NULL),
(8, 59, 3, 2, 'Français', '2022-03-15', '08:00:00', '10:00:00', 1, NULL),
(9, 53, 3, 2, 'Anglais', '2022-03-15', '10:00:00', '12:00:00', 1, NULL),
(10, 59, 3, 2, 'Français', '2022-03-15', '13:00:00', '14:00:00', 1, NULL),
(13, 59, 3, 2, 'Français', '2022-03-15', '14:00:00', '16:00:00', 1, NULL),
(12, 61, 3, 2, 'Mathématique', '2022-03-15', '16:00:00', '17:00:00', 1, NULL),
(14, 59, 3, 2, 'Français', '2022-03-16', '08:00:00', '10:00:00', 1, NULL),
(15, 60, 3, 2, 'Histoire', '2022-03-16', '10:00:00', '11:00:00', 1, 0),
(16, 59, 3, 2, 'Français', '2022-03-16', '13:00:00', '14:00:00', 1, NULL),
(17, 60, 3, 2, 'Histoire', '2022-03-16', '14:00:00', '15:00:00', 1, NULL),
(18, 17, 3, 2, 'Sport', '2022-03-16', '15:00:00', '17:00:00', 1, NULL),
(19, 61, 3, 2, 'Mathématique', '2022-03-16', '17:00:00', '18:00:00', 1, NULL),
(20, 59, 3, 2, 'Français', '2022-03-17', '08:00:00', '09:00:00', 1, NULL),
(21, 53, 3, 2, 'Anglais', '2022-03-17', '09:00:00', '11:00:00', 1, NULL),
(22, 59, 3, 2, 'Français', '2022-03-17', '11:00:00', '12:00:00', 1, NULL),
(23, 61, 3, 2, 'Mathématique', '2022-03-17', '13:00:00', '14:00:00', 1, NULL),
(24, 59, 3, 2, 'Français', '2022-03-17', '15:00:00', '17:00:00', 1, NULL),
(25, 53, 3, 2, 'Anglais', '2022-03-18', '10:00:00', '12:00:00', 1, NULL),
(26, 59, 3, 2, 'Français', '2022-03-18', '12:00:00', '13:00:00', 1, NULL),
(27, 53, 3, 2, 'Anglais', '2022-03-18', '14:00:00', '15:00:00', 1, NULL),
(28, 59, 3, 2, 'Français', '2022-03-18', '15:00:00', '16:00:00', 1, NULL),
(29, 61, 3, 2, 'Mathématique', '2022-03-19', '08:00:00', '10:00:00', 0, NULL),
(30, 59, 3, 2, 'Français', '2022-03-19', '10:00:00', '12:00:00', 0, NULL),
(32, 59, 3, 2, 'Français', '2022-03-19', '13:00:00', '14:00:00', 0, NULL),
(33, 53, 3, 2, 'Anglais', '2022-03-19', '14:00:00', '16:00:00', 0, NULL),
(34, 59, 3, 2, 'Français', '2022-03-19', '16:00:00', '17:00:00', 0, NULL),
(35, 61, 3, 2, 'Mathématique', '2022-03-20', '09:00:00', '10:00:00', 0, NULL),
(36, 59, 3, 2, 'Français', '2022-03-20', '10:00:00', '12:00:00', 0, NULL),
(37, 59, 3, 2, 'Français', '2022-03-20', '12:00:00', '13:00:00', 0, NULL),
(38, 60, 3, 2, 'Histoire', '2022-03-20', '14:00:00', '15:00:00', 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

CREATE TABLE `eleve` (
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
('Dupont', 'Gilbert', 2, 2, 2),
('Dufour', 'Alexis', 3, 3, 2),
('Macron', 'David', 16, 1, 2),
('Vallée', 'Nicole', 19, NULL, 2),
('Rapahal', 'Tisba', 21, NULL, 2),
('Zouaviosfdlfk', 'Marcelino', 23, NULL, 2),
('Corriande', 'Bérénice', 50, NULL, 3),
('Fleuri', 'Hugo', 49, NULL, 3),
('le Moine', 'Antoine', 38, NULL, 2),
('Gondu', 'Maxime', 39, NULL, 2),
('Fleuri', 'Julie', 40, NULL, 2),
('Dupont', 'David', 41, NULL, 2),
('Noel', 'Alexis', 42, NULL, 2),
('Schnyder', 'Mathilde', 43, NULL, 3),
('Clair', 'Lucie', 44, NULL, 2),
('Miraille', 'Gabriel', 45, NULL, 3),
('Fourneille', 'Chloé', 46, NULL, 3),
('Palabras', 'Antonio', 47, NULL, 3),
('Henry', 'Mathieu', 48, NULL, 3),
('Arryson', 'Robert', 52, NULL, 3),
('Charrette', 'Arthur', 51, NULL, 3);

-- --------------------------------------------------------

--
-- Structure de la table `enseignants`
--

CREATE TABLE `enseignants` (
  `idEnseignant` int(11) NOT NULL,
  `Nom` varchar(100) NOT NULL,
  `Prenom` varchar(100) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `idFiliere` int(11) DEFAULT NULL,
  `idMatiere` int(11) NOT NULL,
  `matiere` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `enseignants`
--

INSERT INTO `enseignants` (`idEnseignant`, `Nom`, `Prenom`, `idUtilisateur`, `idFiliere`, `idMatiere`, `matiere`) VALUES
(5, 'Leraut', 'bastien', 53, NULL, 2, 'Mathématiques'),
(7, 'Lafonte', 'Julie', 59, NULL, 1, 'Anglais'),
(8, 'Lapuce', 'Marie', 60, NULL, 2, 'Français'),
(9, 'Laforet', 'Lucie', 61, NULL, 2, 'Sport'),
(10, 'Dupuis', 'Nicolas', 62, NULL, 3, 'Physique-Chimie'),
(11, 'test', 'tetst', 63, NULL, 0, 'Espagnol'),
(12, 'Tisbo', 'Rafael', 64, NULL, 7, 'Sport');

-- --------------------------------------------------------

--
-- Structure de la table `etudes`
--

CREATE TABLE `etudes` (
  `idEtude` int(11) NOT NULL,
  `classe` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etudes`
--

INSERT INTO `etudes` (`idEtude`, `classe`, `nom`) VALUES
(1, 1, 'Seconde'),
(2, 1, 'Première'),
(3, 1, 'Terminale'),
(4, 2, 'Seconde'),
(5, 2, 'Première'),
(6, 2, 'Terminale'),
(7, 3, 'Seconde'),
(8, 3, 'Terminale'),
(14, 3, 'Terminale'),
(15, 4, 'Terminale');

-- --------------------------------------------------------

--
-- Structure de la table `examen`
--

CREATE TABLE `examen` (
  `idExamen` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `idProf` int(11) NOT NULL,
  `matiere` varchar(100) NOT NULL,
  `idEtude` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `examen`
--

INSERT INTO `examen` (`idExamen`, `nom`, `idProf`, `matiere`, `idEtude`) VALUES
(13, 'Dictée', 4, '1', 2),
(12, 'DST de physique', 4, '4', 2),
(11, 'DST de physique', 4, '1', 2),
(10, 'DST de mathématique', 60, '2', 2),
(14, 'testDate', 4, '1', 2),
(15, 'DST de Francais', 4, '1', 3),
(16, 'DST de mathématique', 4, '2', 2);

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

CREATE TABLE `filiere` (
  `IDfiliere` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `filiere`
--

INSERT INTO `filiere` (`IDfiliere`, `nom`) VALUES
(1, 'Economique et sociale'),
(2, 'Littéraire'),
(3, 'Scientifique'),
(4, 'Sciences et Technologies du Management et de la Gestion '),
(5, 'Sciences et Technologies de l\'Industrie et du Développement Durable'),
(6, 'Générale'),
(8, 'Test');

-- --------------------------------------------------------

--
-- Structure de la table `ipadmin`
--

CREATE TABLE `ipadmin` (
  `idIpAllowed` int(11) NOT NULL,
  `ip` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ipadmin`
--

INSERT INTO `ipadmin` (`idIpAllowed`, `ip`) VALUES
(1, '127.0.0.1'),
(3, '::1');

-- --------------------------------------------------------

--
-- Structure de la table `ipbanned`
--

CREATE TABLE `ipbanned` (
  `idBanIp` int(11) NOT NULL,
  `ip` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `logs`
--

CREATE TABLE `logs` (
  `idLog` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `ip` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `logs`
--

INSERT INTO `logs` (`idLog`, `idUtilisateur`, `date`, `ip`) VALUES
(1, 60, '2022-03-17 10:17:47', '127.0.0.1'),
(3, 1, '2022-03-17 11:04:59', '::1'),
(4, 16, '2022-03-17 11:10:25', '::1'),
(5, 16, '2022-03-22 10:06:36', '::1'),
(6, 60, '2022-03-22 16:36:50', '::1'),
(7, 60, '2022-03-23 09:18:09', '::1'),
(8, 60, '2022-03-24 09:18:06', '::1'),
(9, 4, '2022-03-24 10:43:20', '::1'),
(10, 4, '2022-03-24 14:19:35', '::1'),
(11, 60, '2022-03-24 16:29:53', '::1'),
(12, 4, '2022-03-24 16:36:02', '::1'),
(13, 16, '2022-03-24 17:03:26', '::1'),
(14, 4, '2022-03-24 17:04:46', '::1'),
(15, 16, '2022-03-24 17:05:36', '::1'),
(16, 4, '2022-03-24 17:06:05', '::1'),
(17, 47, '2022-03-25 14:02:43', '::1'),
(18, 4, '2022-03-25 14:20:41', '::1'),
(19, 4, '2022-03-25 16:22:55', '::1'),
(20, 4, '2022-03-25 16:25:49', '::1'),
(21, 4, '2022-03-25 16:32:36', '::1'),
(22, 4, '2022-03-25 16:32:57', '::1'),
(23, 4, '2022-03-25 16:44:46', '::1'),
(24, 16, '2022-03-29 10:21:25', '::1'),
(25, 16, '2022-03-29 11:14:24', '::1'),
(26, 16, '2022-03-29 11:14:39', '::1'),
(27, 16, '2022-03-29 11:14:54', '::1'),
(28, 16, '2022-03-29 11:15:26', '::1'),
(29, 16, '2022-03-29 11:16:14', '::1'),
(30, 16, '2022-03-29 11:46:52', '::1'),
(31, 16, '2022-03-29 11:47:42', '::1'),
(32, 16, '2022-03-29 11:48:06', '::1'),
(33, 16, '2022-03-29 11:48:51', '::1'),
(34, 4, '2022-03-29 12:01:14', '::1'),
(35, 4, '2022-03-29 12:01:35', '::1'),
(36, 4, '2022-03-29 12:01:52', '::1'),
(37, 4, '2022-03-29 12:02:04', '::1'),
(38, 4, '2022-03-29 12:02:55', '::1'),
(39, 4, '2022-03-29 12:03:16', '::1'),
(40, 4, '2022-03-29 12:30:32', '::1'),
(41, 4, '2022-03-29 12:30:47', '::1'),
(42, 4, '2022-03-29 14:07:56', '::1'),
(43, 4, '2022-03-29 14:08:17', '::1'),
(44, 4, '2022-03-29 14:08:36', '::1'),
(45, 4, '2022-03-29 14:43:53', '::1');

-- --------------------------------------------------------

--
-- Structure de la table `matieres`
--

CREATE TABLE `matieres` (
  `idMatiere` int(11) NOT NULL,
  `matiere` varchar(100) NOT NULL,
  `CoefMatiere` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `matieres`
--

INSERT INTO `matieres` (`idMatiere`, `matiere`, `CoefMatiere`) VALUES
(1, 'Français', 5),
(2, 'Mathématiques', 7),
(3, 'Science', 8),
(4, 'Physique-Chimie', 6),
(5, 'Histoire-Géographie', 3),
(6, 'Anglais', 3),
(7, 'Espagnol', 2),
(9, 'Sport', 2);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `idMessage` int(11) NOT NULL,
  `idConversation` int(11) NOT NULL,
  `idEnvoyeur` int(11) DEFAULT NULL,
  `idReceveur` int(11) DEFAULT NULL,
  `message` varchar(400) DEFAULT NULL,
  `date_envoie` date DEFAULT NULL,
  `heure_envoie` time DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`idMessage`, `idConversation`, `idEnvoyeur`, `idReceveur`, `message`, `date_envoie`, `heure_envoie`) VALUES
(1, 5, 4, 60, 'test', '2022-03-25', '12:20:32'),
(2, 5, 4, 60, 'test', '2022-03-25', '12:21:39'),
(3, 5, 4, 60, 'DDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD', '2022-03-25', '13:48:08'),
(4, 5, 4, 60, 'Bonjour', '2022-03-25', '13:55:24'),
(5, 5, 4, 60, 'DDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD', '2022-03-25', '13:58:13'),
(6, 5, 4, 60, 'DDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD', '2022-03-25', '13:58:15'),
(7, 5, 4, 60, 'Bonjour', '2022-03-25', '14:00:00'),
(8, 5, 4, 60, 'zasczsfcz', '2022-03-29', '14:33:46');

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

CREATE TABLE `notes` (
  `idNote` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `idProf` int(11) NOT NULL,
  `Note` float NOT NULL,
  `idMatiere` int(11) NOT NULL,
  `idExamen` int(11) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `NoteMax` int(2) NOT NULL DEFAULT 20,
  `Coef` int(11) NOT NULL,
  `Commentaire` text DEFAULT NULL,
  `dateNote` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `notes`
--

INSERT INTO `notes` (`idNote`, `idUtilisateur`, `idProf`, `Note`, `idMatiere`, `idExamen`, `designation`, `NoteMax`, `Coef`, `Commentaire`, `dateNote`) VALUES
(1, 50, 4, 2, 1, 15, 'DST de mathématique', 20, 2, '', '2022-03-25'),
(2, 49, 4, 1, 1, 15, 'DST de Francais', 20, 2, '', '2022-03-25'),
(3, 43, 4, 1, 1, 15, 'DST de Francais', 20, 2, '', '2022-03-25'),
(4, 45, 4, 1, 1, 15, 'DST de Francais', 20, 2, '', '2022-03-25'),
(5, 46, 4, 1, 1, 15, 'DST de Francais', 20, 2, '', '2022-03-25'),
(6, 47, 4, 1, 1, 15, 'DST de Francais', 20, 2, '', '2022-03-25'),
(7, 48, 4, 1, 1, 15, 'DST de Francais', 20, 2, '', '2022-03-25'),
(8, 52, 4, 1, 1, 15, 'DST de Francais', 20, 2, '', '2022-03-25'),
(9, 51, 4, 1, 1, 15, 'DST de Francais', 20, 2, '', '2022-03-25'),
(10, 50, 4, 1, 1, 15, 'DST de Francais', 20, 2, '', '2022-03-25'),
(11, 2, 4, 2, 2, 10, 'DST de mathématique', 20, 2, '', '2022-03-25'),
(12, 3, 4, 2, 2, 10, 'DST de mathématique', 20, 2, '', '2022-03-25'),
(13, 16, 4, 13, 2, 10, 'DST de mathématique', 20, 2, '', '2022-03-25'),
(14, 19, 4, 2, 2, 10, 'DST de mathématique', 20, 2, '', '2022-03-25'),
(15, 21, 4, 2, 2, 10, 'DST de mathématique', 20, 2, '', '2022-03-25'),
(16, 23, 4, 2, 2, 10, 'DST de mathématique', 20, 2, '', '2022-03-25'),
(17, 38, 4, 2, 2, 10, 'DST de mathématique', 20, 2, '', '2022-03-25'),
(18, 39, 4, 2, 2, 10, 'DST de mathématique', 20, 2, '', '2022-03-25'),
(19, 40, 4, 2, 2, 10, 'DST de mathématique', 20, 2, '', '2022-03-25'),
(20, 41, 4, 2, 2, 10, 'DST de mathématique', 20, 2, '', '2022-03-25'),
(21, 42, 4, 2, 2, 10, 'DST de mathématique', 20, 2, '', '2022-03-25'),
(22, 44, 4, 2, 2, 10, 'DST de mathématique', 20, 2, '', '2022-03-25');

-- --------------------------------------------------------

--
-- Structure de la table `presence`
--

CREATE TABLE `presence` (
  `idPresence` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `idEtude` int(11) NOT NULL,
  `idProf` int(11) NOT NULL,
  `idMatiere` int(11) NOT NULL,
  `laDate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `presence`
--

INSERT INTO `presence` (`idPresence`, `idUtilisateur`, `idEtude`, `idProf`, `idMatiere`, `laDate`) VALUES
(1, 2, 2, 5, 2, '2021-11-26 23:20:50');

-- --------------------------------------------------------

--
-- Structure de la table `punition`
--

CREATE TABLE `punition` (
  `idPunition` int(11) NOT NULL,
  `idEleve` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `motif` text NOT NULL,
  `ladate` date NOT NULL,
  `punition` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `punition`
--

INSERT INTO `punition` (`idPunition`, `idEleve`, `idUtilisateur`, `motif`, `ladate`, `punition`) VALUES
(1, 16, 5, 'Manque de respect ', '2021-10-18', '2 heures de colles'),
(2, 16, 4, 'Manque de respect', '2022-01-01', '2 heures de colle'),
(4, 16, 4, 'Dégradation du matériel scolaire', '2022-03-01', 'Dissertation sur le sujet :\r\nLa musique est-elle un langage des émotions ?\r\n(4 pages)'),
(5, 16, 60, 'test ', '2000-03-23', 'te\r\n*'),
(6, 16, 4, 'test', '2022-03-24', 'test'),
(7, 16, 4, 'test', '2022-03-25', 'test'),
(8, 16, 4, 'dadadadadadadadadadadada', '2022-03-25', 'dadadadadadadadadadadada'),
(9, 16, 4, 'tEEEEEST', '2022-03-25', 'test'),
(10, 16, 4, 'Bagarre avec camarades', '2022-03-29', 'Exclusion de une semaine');

-- --------------------------------------------------------

--
-- Structure de la table `retards`
--

CREATE TABLE `retards` (
  `idRetard` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `idProf` int(11) NOT NULL,
  `justification` varchar(100) NOT NULL,
  `verifJustification` varchar(3) NOT NULL,
  `idCours` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `retards`
--

INSERT INTO `retards` (`idRetard`, `idUtilisateur`, `idProf`, `justification`, `verifJustification`, `idCours`) VALUES
(1, 16, 5, '25min / rdv medical', 'oui', 0),
(2, 3, 4, '', 'oui', 4),
(3, 3, 4, 'gfdgdfgg', 'non', 4),
(4, 3, 4, 'gfdgdfggsqdqsd', 'non', 4),
(5, 3, 4, '', 'non', 4);

--
-- Déclencheurs `retards`
--
DELIMITER $$
CREATE TRIGGER `AppelDoneBIS` AFTER INSERT ON `retards` FOR EACH ROW UPDATE edt SET edt.appel = 1 WHERE edt.idCours = idCours
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `idSalle` int(11) NOT NULL,
  `numero` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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

CREATE TABLE `statuts` (
  `idStatut` int(11) NOT NULL,
  `statut` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `utilisateur` (
  `idUtilisateur` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `identifiant` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `dateNaiss` date NOT NULL,
  `mdp` varchar(100) NOT NULL,
  `mdpTemp` varchar(100) NOT NULL,
  `statut` varchar(100) DEFAULT NULL,
  `token` varchar(30) DEFAULT NULL,
  `PremiereConnexion` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `email`, `identifiant`, `nom`, `prenom`, `dateNaiss`, `mdp`, `mdpTemp`, `statut`, `token`, `PremiereConnexion`) VALUES
(1, 'superadmin@gmail.com', 'ASuper05', 'Super', 'Admin', '2000-01-01', '$2y$10$W035IQJDEm3PPnPJ0Y22cuRDZp1iCU9A8jjl7Wux7ic97K0zkD7OW', 'iRS2KwDs', 'Administration', NULL, 1),
(2, NULL, 'GDupont41', 'Dupont', 'Gilbert', '2005-05-20', '$2y$10$/NZ8F25ol7q5Q0vyDT.FOuO6ZVbDrrs9o1hzLwCliUJs/r6R33/YC', 'o1vxHBM6', 'Etudiant', NULL, 0),
(3, NULL, 'ADufour39', 'Dufour', 'Alexis', '2006-06-05', '$2y$10$EZ9bn4sCVss9h.c1/lWiputYQfB014EtFalmmrKQfpp7p.cE9sqMi', 'mPj8kxFu', 'Etudiant', NULL, 1),
(4, NULL, 'ASuper71', 'Super', 'Admin2', '2000-02-23', '$2y$10$t/ouCBS48fg9ytkvpTP6N.quh/hio0ygfuJBrYxFDI5LxD5rg77Di', 'i6XZo7NL', 'Administration', 't3IHijxWY4fVnuDZw7MKzhycLN', 1),
(48, NULL, 'MHenry19', 'Henry', 'Mathieu', '2005-02-12', '$2y$10$oh.6/cPWBIQll8zB4WL6h.TC29l7FFgnar1ECyDF7KCw/b5Mn/JdS', 'JOQUAt4n', 'Etudiant', NULL, 0),
(47, NULL, 'APalabras14', 'Palabras', 'Antonio', '2005-09-17', '$2y$10$rG8M9bXKgOlm.ceeagV9lOCD2lhEJPuibC1luNxjQIV4H8i9q7pIC', 'j7qLuONP', 'Etudiant', NULL, 1),
(46, NULL, 'CFourneille85', 'Fourneille', 'Chloé', '2006-11-12', '$2y$10$w5WYZIzEF7BnWnwqjkrl8..xKh80bGVzyDbul1jZ9Zrj38piiujHS', 'aCVQ2LSo', 'Etudiant', NULL, 0),
(45, NULL, 'GMiraille72', 'Miraille', 'Gabriel', '2005-01-01', '$2y$10$66OXb1n/ar39h6adMeuD6OKHLPHA2SLCMySlBznn//Np/ER.mlqKO', 'bj2FmRfX', 'Etudiant', NULL, 1),
(44, NULL, 'LClair91', 'Clair', 'Lucie', '2004-10-03', '$2y$10$9TeHF9Q/kx66V2Sw2vsPDOnWpows5avMg5s4npt/97uOQtEe.zLmq', 'Umv3IBM4', 'Etudiant', NULL, 1),
(43, NULL, 'MSchnyder09', 'Schnyder', 'Mathilde', '2005-07-28', '$2y$10$nMnHUarHYkcJelR.SpPVUOOQCxF453qiEhMkCcB82F.m7VMWZ/rtO', '0n5KfiYE', 'Etudiant', NULL, 1),
(16, 'd.carneiro@ecole-ipssi.net', 'DMacron74', 'Macron', 'David', '2000-05-23', '$2y$10$mljKBKDSamzw9C937vH.ruk2MZZC/0kjrlMSFSlWvFIfK5J/CEGau', 'NAMZeCwv', 'Etudiant', 'KlAfGBubNmwO5v18C3LrjPHk6n', 1),
(17, 'CamilleAudet@armyspy.com', 'CAudet49', 'Audet', 'Camille', '1957-02-06', '$2y$10$Q8yQypg6IK3.LPqpH/Nvg.vslmmQ4.sNbFkXXOL.BxHXXcoiHJ2IS', 'L1P9op7l', 'Professeur', NULL, 1),
(18, 'RoxanneLaforest@armyspy.com', 'RLaforest68', 'Laforest', 'Roxanne', '1956-03-19', '$2y$10$Q8Hw48NHt2XxVokIouBgF.BCKo43eBUDe5PEjZ0fSowUx62wXZJJO', 't0hO6rng', 'Professeur', NULL, 0),
(19, 'NicoleVallee@jourrapide.com', 'NVallée96', 'Vallée', 'Nicole', '2003-07-01', '$2y$10$tUdLduBOhggSZWcH/VV0G.KjIQZKz42GmCaP9YCBrB10TK160zdzy', 'hZfKNia6', 'Etudiant', NULL, 0),
(20, 'DidianeLabossiere@jourrapide.com', 'DLabossière29', 'Labossière', 'Didiane', '1987-12-04', '$2y$10$q42R8X4ofdQ3u3X9igsDGOtzX99nR8A8WWRmDTOV.FQLVSrgf.suq', 'b5LUnBzj', 'Professeur', NULL, 0),
(40, NULL, 'JFleuri10', 'Fleuri', 'Julie', '2005-09-20', '$2y$10$04PFEOOWt3XByrhiI9SpxeGNvmywzsZjpuNcIqMCnNrnl03yJKpDy', 'NOA7ZovM', 'Etudiant', NULL, 0),
(41, NULL, 'DDupont56', 'Dupont', 'David', '2005-05-22', '$2y$10$Ex48XezJvInIXK9cPxFaIOazE7wy6GAFwb2hBGpeujy62BsccW5lu', 'MJD1yOYa', 'Etudiant', NULL, 0),
(39, NULL, 'MGondu96', 'Gondu', 'Maxime', '2005-12-09', '$2y$10$gKsIhjgtnQfd1yS084QGAujH6MPu7ttnoCGS7GYkCMHJHecKPG6rC', 'JLQhNl2k', 'Etudiant', NULL, 1),
(42, NULL, 'ANoel15', 'Noel', 'Alexis', '2005-08-08', '$2y$10$s/4dm4.tIoHpKnXYn69bqOkg2kxt309JcqNDMHRlSpK7XVdEwo9lO', 'PzsimaGu', 'Etudiant', NULL, 0),
(38, NULL, 'Ale Moine65', 'le Moine', 'Antoine', '2005-11-07', '$2y$10$GpsRecgClmusmcMSkoywYOLsz/MHtjKmlVvcGxdCpx5.KKQHTxA4O', 'EKWiCJ97', 'Etudiant', NULL, 0),
(55, 'test12.test12@test.ts', 'TTest1213', 'Test12', 'Test12', '1999-05-07', '$2a$11$al3F5IzT3bHmop0VT0rCBe2Y/iSUvrPkbi5lHETvtPlD5f.gXn/fG', 'JbR2WLvI', 'Professeur', NULL, 0),
(54, 'bastien.leraut@free.fr', 'BLeraut90', 'Leraut', 'Bastien', '2021-07-15', '$2y$10$1HoMnNY42SI4WZAsVaxQEOaqQXrkiih.kwyV4jHHxl.mXPB0mVbh6', 'P9MQfRTJ', 'Administration', NULL, 0),
(49, NULL, 'HFleuri97', 'Fleuri', 'Hugo', '2004-06-07', '$2y$10$NgHKfrMLylAQaf7rIw/9JuFP22IHLyMklX7ORk5.bDAiNXsWKVTG2', 'ofMKcIZ8', 'Etudiant', NULL, 0),
(50, NULL, 'BCorriande87', 'Corriande', 'Bérénice', '2004-12-14', '$2y$10$Bv3kKhUdTyjdvIx0HKxLXu//kiLDo/wLsI1DofgurOd.gcj3Z2jDy', 'yI8XAflS', 'Etudiant', NULL, 0),
(51, NULL, 'ACharrette60', 'Charrette', 'Arthur', '2004-01-11', '$2y$10$MrtWGvXEhHGrS9fR9/KTvOXQob2qzIVSg4aqHOFFO4icOXzJs0UI6', 'L1nVQ9ik', 'Etudiant', NULL, 0),
(52, NULL, 'RArryson36', 'Arryson', 'Robert', '2004-02-03', '$2y$10$j4CCESmONl7kFTQN2Qn63OFb9P3SrCk3ZZraWvp53ZmtjfH1VbVB2', 'mqPd0tAL', 'Etudiant', NULL, 0),
(53, 'bastien.leraut@rrrrr.fr', 'Lbastien81', 'Leraut', 'bastien', '2022-01-20', '$2a$11$1hn.WA8S0Nbo2bVUrvPFku7oiuSJ9wFDVerGn5z1VD9FLTnCMydBa', '7ZXdmjGS', 'Professeur', NULL, 1),
(59, NULL, 'JLafonte10', 'Lafonte', 'Julie', '2022-03-01', '$2a$11$3FKteC2Z82uYNYOBJEHBAeoWy.DoZI8SGHDzHGh9JV5r/mCgKrzci', 'ng2q6auw', 'Professeur', NULL, 1),
(60, NULL, 'MLapuce02', 'Lapuce', 'Marie', '2022-03-01', '$2a$11$0ziPD60bQ2b5pq0uuVEr5OmirDVXqwuTcBz/foKWkfcj/UBtMqvWO', 'zZVu8eo3', 'Professeur', 'byKBdOXlemsh6Et1Qkug093GoT', 1),
(61, NULL, 'LLaforet82', 'Laforet', 'Lucie', '2022-03-01', '$2a$11$Uf.C5V9Fnc4Um.a5rhmZJexXJHiFs2BG3.DnigPoKG5r/bZj.OErG', 'O2SJdwrC', 'Professeur', NULL, 0),
(62, NULL, 'NDupuis92', 'Dupuis', 'Nicolas', '2022-03-01', '$2a$11$Bs6csE6EvOWHexgLOx4cueY3XyH00Dxz31r9KAhqZdZvKKnxnvI9G', 'AsvjciyE', 'Professeur', NULL, 0),
(63, 'test@test.com', 'ttest10', 'test', 'tetst', '2022-03-24', '$2a$11$q8VCYaf0pT9eKpxZcI4/6OzQsa0Fkgsl22e81/VTc805D6ttG5W8W', 'V8axTtw3', 'Professeur', NULL, 0),
(64, NULL, 'RTisbo39', 'Tisbo', 'Rafael', '2022-03-29', '$2a$11$R3uFbweDHXwRaWmGriHHX.MiEQdV4Ik11cOowUbYK/eKfRsASSjOu', '8FNJhLoG', 'Professeur', NULL, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `absence`
--
ALTER TABLE `absence`
  ADD PRIMARY KEY (`idAbsence`);

--
-- Index pour la table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`idConversation`);

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`idUtilisateur`,`idEtude`);

--
-- Index pour la table `devoirs`
--
ALTER TABLE `devoirs`
  ADD PRIMARY KEY (`idDevoir`);

--
-- Index pour la table `edt`
--
ALTER TABLE `edt`
  ADD PRIMARY KEY (`idCours`);

--
-- Index pour la table `eleve`
--
ALTER TABLE `eleve`
  ADD UNIQUE KEY `idUtilisateur` (`idUtilisateur`);

--
-- Index pour la table `enseignants`
--
ALTER TABLE `enseignants`
  ADD PRIMARY KEY (`idEnseignant`);

--
-- Index pour la table `etudes`
--
ALTER TABLE `etudes`
  ADD PRIMARY KEY (`idEtude`);

--
-- Index pour la table `examen`
--
ALTER TABLE `examen`
  ADD PRIMARY KEY (`idExamen`);

--
-- Index pour la table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`IDfiliere`);

--
-- Index pour la table `ipadmin`
--
ALTER TABLE `ipadmin`
  ADD PRIMARY KEY (`idIpAllowed`);

--
-- Index pour la table `ipbanned`
--
ALTER TABLE `ipbanned`
  ADD PRIMARY KEY (`idBanIp`);

--
-- Index pour la table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`idLog`);

--
-- Index pour la table `matieres`
--
ALTER TABLE `matieres`
  ADD PRIMARY KEY (`idMatiere`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`idMessage`);

--
-- Index pour la table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`idNote`);

--
-- Index pour la table `presence`
--
ALTER TABLE `presence`
  ADD PRIMARY KEY (`idPresence`);

--
-- Index pour la table `punition`
--
ALTER TABLE `punition`
  ADD PRIMARY KEY (`idPunition`);

--
-- Index pour la table `retards`
--
ALTER TABLE `retards`
  ADD PRIMARY KEY (`idRetard`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`idSalle`);

--
-- Index pour la table `statuts`
--
ALTER TABLE `statuts`
  ADD PRIMARY KEY (`idStatut`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idUtilisateur`),
  ADD UNIQUE KEY `token` (`token`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `absence`
--
ALTER TABLE `absence`
  MODIFY `idAbsence` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `idConversation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `devoirs`
--
ALTER TABLE `devoirs`
  MODIFY `idDevoir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `edt`
--
ALTER TABLE `edt`
  MODIFY `idCours` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `enseignants`
--
ALTER TABLE `enseignants`
  MODIFY `idEnseignant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `etudes`
--
ALTER TABLE `etudes`
  MODIFY `idEtude` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `examen`
--
ALTER TABLE `examen`
  MODIFY `idExamen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `filiere`
--
ALTER TABLE `filiere`
  MODIFY `IDfiliere` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `ipadmin`
--
ALTER TABLE `ipadmin`
  MODIFY `idIpAllowed` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `ipbanned`
--
ALTER TABLE `ipbanned`
  MODIFY `idBanIp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `logs`
--
ALTER TABLE `logs`
  MODIFY `idLog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `matieres`
--
ALTER TABLE `matieres`
  MODIFY `idMatiere` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `idMessage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `notes`
--
ALTER TABLE `notes`
  MODIFY `idNote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `presence`
--
ALTER TABLE `presence`
  MODIFY `idPresence` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `punition`
--
ALTER TABLE `punition`
  MODIFY `idPunition` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `retards`
--
ALTER TABLE `retards`
  MODIFY `idRetard` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `salle`
--
ALTER TABLE `salle`
  MODIFY `idSalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `statuts`
--
ALTER TABLE `statuts`
  MODIFY `idStatut` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

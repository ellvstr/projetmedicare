-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 02 juin 2024 à 14:18
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `medicare`
--

-- --------------------------------------------------------

--
-- Structure de la table `achat`
--

CREATE TABLE `achat` (
  `ID_Achat` int(11) NOT NULL,
  `Nom_Client` varchar(50) NOT NULL,
  `Date_Achat` date NOT NULL,
  `TypeCarte_Used` varchar(20) NOT NULL,
  `NumeroCarte` varchar(20) NOT NULL,
  `ID_Client` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `ID_Admin` int(11) NOT NULL,
  `Nom_Admin` varchar(50) NOT NULL,
  `Prenom_Admin` varchar(50) NOT NULL,
  `Courriel_Admin` varchar(50) NOT NULL,
  `Mdp_Admin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`ID_Admin`, `Nom_Admin`, `Prenom_Admin`, `Courriel_Admin`, `Mdp_Admin`) VALUES
(1, 'Kankolongo', 'Gabriella', 'gabriella.kankolongo@edu.ece.fr', '$2y$10$tBCJ6qfjxPj.x//3kOkNJ.QDp9Oj0Is6FsT4YJCx3ncqjD5Tle7wa');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `ID_Client` int(11) NOT NULL,
  `Nom_Client` varchar(50) NOT NULL,
  `Prenom_Client` varchar(50) NOT NULL,
  `Sexe` varchar(10) DEFAULT NULL,
  `Adresse_Client` varchar(255) DEFAULT NULL,
  `Ville` varchar(50) DEFAULT NULL,
  `Code_Postal` varchar(20) DEFAULT NULL,
  `Pays` varchar(50) DEFAULT NULL,
  `Telephone_Client` varchar(20) DEFAULT NULL,
  `Carte_Vitale` varchar(50) DEFAULT NULL,
  `E_mail_Client` varchar(100) NOT NULL,
  `Mdp_Client` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `consultations`
--

CREATE TABLE `consultations` (
  `id` int(11) NOT NULL,
  `medecin_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `date_heure` datetime DEFAULT NULL,
  `details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `creneaux`
--

CREATE TABLE `creneaux` (
  `ID_Creneaux` int(11) NOT NULL,
  `Jour_semaine` varchar(20) NOT NULL,
  `Heure` time NOT NULL,
  `ID_Labo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `disponibilites`
--

CREATE TABLE `disponibilites` (
  `ID_Disponibilite` int(11) NOT NULL,
  `Jour_semaine` varchar(20) NOT NULL,
  `Heure` time NOT NULL,
  `ID_Medecin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `laboratoire_de_biologie_medicale`
--

CREATE TABLE `laboratoire_de_biologie_medicale` (
  `ID_Labo` int(11) NOT NULL,
  `E_mail` varchar(100) NOT NULL,
  `Telephone_Labo` varchar(20) NOT NULL,
  `Nom_Labo` varchar(100) NOT NULL,
  `Adresse_Labo` varchar(255) NOT NULL,
  `ID_Admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `medecin_et_professionnel_de_sante`
--

CREATE TABLE `medecin_et_professionnel_de_sante` (
  `ID_Medecin` int(11) NOT NULL,
  `Nom_M_PS` varchar(50) NOT NULL,
  `Prenom_M_PS` varchar(50) NOT NULL,
  `Specialite` varchar(50) NOT NULL,
  `CV` varchar(100) DEFAULT NULL,
  `E_mail_M_PS` varchar(100) NOT NULL,
  `Mdp_M_PS` varchar(255) NOT NULL,
  `Telephone_M_PS` varchar(20) DEFAULT NULL,
  `Photo` varchar(255) DEFAULT NULL,
  `Video` varchar(255) DEFAULT NULL,
  `Salle` varchar(50) DEFAULT NULL,
  `ID_Admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `medecin_et_professionnel_de_sante`
--

INSERT INTO `medecin_et_professionnel_de_sante` (`ID_Medecin`, `Nom_M_PS`, `Prenom_M_PS`, `Specialite`, `CV`, `E_mail_M_PS`, `Mdp_M_PS`, `Telephone_M_PS`, `Photo`, `Video`, `Salle`, `ID_Admin`) VALUES
(1, 'Keller', 'Anna', 'Addictologie', 'img/cvaddictologue.jpg', 'anna.keller@medicare.com', '$2y$10$.UTLp8AvDdQtNZJsGQlysuBP8QWMzZGsY8QAOrkGvD0a6T8Hz3Wg', '+33 1 56 87 09 34', 'img/addictologue.jpg', 'video/addictologue.mp4', 'D404', NULL),
(2, 'Duval', 'Claire', 'Cardiologie', 'img/cvcardiologue.jpg', 'claire.duval@medicare.com', '123', '+33 1 78 17 09 10', 'img/cardiologue.jpg', 'video/addictologue.mp4', 'F606', NULL),
(3, 'Martin', 'Paul', 'Andrologie', 'img/cvandrologue.jpg', 'paul.martin@medicare.com', '$2y$10$8MDwuhNScEUKu3M0VzGzm.v20LpXPwvGuXWuI9tC3uuzfTPYl0i3a', '+33 1 69 98 13 34 ', 'img/andrologue.jpg', 'video/addictologue.mp4', 'E505', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `consultation_id` int(11) DEFAULT NULL,
  `sender` enum('medecin','client') DEFAULT NULL,
  `message` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `rendez_vous`
--

CREATE TABLE `rendez_vous` (
  `ID_Rdv` int(11) NOT NULL,
  `Date_heure` datetime NOT NULL,
  `Statut` varchar(50) DEFAULT NULL,
  `ID_Labo` int(11) DEFAULT NULL,
  `ID_Medecin` int(11) DEFAULT NULL,
  `ID_Client` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `ID_Services` int(11) NOT NULL,
  `Nom_Service` varchar(100) NOT NULL,
  `Informations` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `achat`
--
ALTER TABLE `achat`
  ADD PRIMARY KEY (`ID_Achat`),
  ADD KEY `ID_Client` (`ID_Client`);

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`ID_Admin`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`ID_Client`);

--
-- Index pour la table `consultations`
--
ALTER TABLE `consultations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medecin_id` (`medecin_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Index pour la table `creneaux`
--
ALTER TABLE `creneaux`
  ADD PRIMARY KEY (`ID_Creneaux`),
  ADD KEY `ID_Labo` (`ID_Labo`);

--
-- Index pour la table `disponibilites`
--
ALTER TABLE `disponibilites`
  ADD PRIMARY KEY (`ID_Disponibilite`),
  ADD KEY `ID_Medecin` (`ID_Medecin`);

--
-- Index pour la table `laboratoire_de_biologie_medicale`
--
ALTER TABLE `laboratoire_de_biologie_medicale`
  ADD PRIMARY KEY (`ID_Labo`),
  ADD KEY `ID_Admin` (`ID_Admin`);

--
-- Index pour la table `medecin_et_professionnel_de_sante`
--
ALTER TABLE `medecin_et_professionnel_de_sante`
  ADD PRIMARY KEY (`ID_Medecin`),
  ADD KEY `ID_Admin` (`ID_Admin`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `consultation_id` (`consultation_id`);

--
-- Index pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  ADD PRIMARY KEY (`ID_Rdv`),
  ADD KEY `ID_Labo` (`ID_Labo`),
  ADD KEY `ID_Medecin` (`ID_Medecin`),
  ADD KEY `ID_Client` (`ID_Client`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`ID_Services`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `achat`
--
ALTER TABLE `achat`
  MODIFY `ID_Achat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `administrateur`
--
ALTER TABLE `administrateur`
  MODIFY `ID_Admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `ID_Client` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `creneaux`
--
ALTER TABLE `creneaux`
  MODIFY `ID_Creneaux` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `disponibilites`
--
ALTER TABLE `disponibilites`
  MODIFY `ID_Disponibilite` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `laboratoire_de_biologie_medicale`
--
ALTER TABLE `laboratoire_de_biologie_medicale`
  MODIFY `ID_Labo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `medecin_et_professionnel_de_sante`
--
ALTER TABLE `medecin_et_professionnel_de_sante`
  MODIFY `ID_Medecin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  MODIFY `ID_Rdv` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `ID_Services` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `achat`
--
ALTER TABLE `achat`
  ADD CONSTRAINT `achat_ibfk_1` FOREIGN KEY (`ID_Client`) REFERENCES `client` (`ID_Client`);

--
-- Contraintes pour la table `consultations`
--
ALTER TABLE `consultations`
  ADD CONSTRAINT `consultations_ibfk_1` FOREIGN KEY (`medecin_id`) REFERENCES `medecin_et_professionnel_de_sante` (`ID_Medecin`),
  ADD CONSTRAINT `consultations_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `client` (`ID_Client`);

--
-- Contraintes pour la table `creneaux`
--
ALTER TABLE `creneaux`
  ADD CONSTRAINT `creneaux_ibfk_1` FOREIGN KEY (`ID_Labo`) REFERENCES `laboratoire_de_biologie_medicale` (`ID_Labo`);

--
-- Contraintes pour la table `disponibilites`
--
ALTER TABLE `disponibilites`
  ADD CONSTRAINT `disponibilites_ibfk_1` FOREIGN KEY (`ID_Medecin`) REFERENCES `medecin_et_professionnel_de_sante` (`ID_Medecin`);

--
-- Contraintes pour la table `laboratoire_de_biologie_medicale`
--
ALTER TABLE `laboratoire_de_biologie_medicale`
  ADD CONSTRAINT `laboratoire_de_biologie_medicale_ibfk_1` FOREIGN KEY (`ID_Admin`) REFERENCES `administrateur` (`ID_Admin`);

--
-- Contraintes pour la table `medecin_et_professionnel_de_sante`
--
ALTER TABLE `medecin_et_professionnel_de_sante`
  ADD CONSTRAINT `medecin_et_professionnel_de_sante_ibfk_1` FOREIGN KEY (`ID_Admin`) REFERENCES `administrateur` (`ID_Admin`);

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`consultation_id`) REFERENCES `consultations` (`id`);

--
-- Contraintes pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  ADD CONSTRAINT `rendez_vous_ibfk_1` FOREIGN KEY (`ID_Labo`) REFERENCES `laboratoire_de_biologie_medicale` (`ID_Labo`),
  ADD CONSTRAINT `rendez_vous_ibfk_2` FOREIGN KEY (`ID_Medecin`) REFERENCES `medecin_et_professionnel_de_sante` (`ID_Medecin`),
  ADD CONSTRAINT `rendez_vous_ibfk_3` FOREIGN KEY (`ID_Client`) REFERENCES `client` (`ID_Client`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 27 mai 2024 à 16:52
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
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `ID_Admin` int(11) NOT NULL,
  `Nom_utilisateur` varchar(255) NOT NULL,
  `Nom_de_l_admin` varchar(255) NOT NULL,
  `Prenom_Admin` varchar(255) NOT NULL,
  `Date_de_naissance` date NOT NULL,
  `Adresse` varchar(255) NOT NULL,
  `Mot_de_passe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `carte_credit`
--

CREATE TABLE `carte_credit` (
  `Numero_carte` varchar(20) NOT NULL,
  `Type_carte` varchar(50) NOT NULL,
  `Nom_proprietaire` varchar(50) NOT NULL,
  `Date_expiration` date NOT NULL,
  `Code_securite` varchar(10) NOT NULL,
  `ID_Client` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `ID_Client` int(11) NOT NULL,
  `Nom_Utilisateur_Client` varchar(50) NOT NULL,
  `Mot_de_passe_Client` varchar(255) NOT NULL,
  `Nom_Client` varchar(50) NOT NULL,
  `Prenom_Client` varchar(50) NOT NULL,
  `Sexe` varchar(10) DEFAULT NULL,
  `Adresse` varchar(255) DEFAULT NULL,
  `Etat_de_sante` text DEFAULT NULL,
  `Ville` varchar(50) DEFAULT NULL,
  `Code_Postal` varchar(20) DEFAULT NULL,
  `Pays` varchar(50) DEFAULT NULL,
  `Telephone_Client` varchar(20) DEFAULT NULL,
  `Carte_Vitale` varchar(50) DEFAULT NULL,
  `E_mail_Client` varchar(100) NOT NULL
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
  `Telephone` varchar(20) NOT NULL,
  `Nom_Labo` varchar(100) NOT NULL,
  `Adresse` varchar(255) NOT NULL,
  `ID_Admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `medecin_et_professionnel_de_sante`
--

CREATE TABLE `medecin_et_professionnel_de_sante` (
  `ID_Medecin` int(11) NOT NULL,
  `Nom_utilisateur` varchar(255) NOT NULL,
  `Mot_de_passe` varchar(255) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Specialite` varchar(255) NOT NULL,
  `CV` text DEFAULT NULL,
  `E_mail` varchar(100) NOT NULL,
  `Telephone` varchar(20) DEFAULT NULL,
  `Photo` varchar(255) DEFAULT NULL,
  `Video` varchar(255) DEFAULT NULL,
  `Salle` varchar(50) DEFAULT NULL,
  `ID_Admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `proposer`
--

CREATE TABLE `proposer` (
  `ID_Labo` int(11) NOT NULL,
  `ID_Services` int(11) NOT NULL
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
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`ID_Admin`);

--
-- Index pour la table `carte_credit`
--
ALTER TABLE `carte_credit`
  ADD PRIMARY KEY (`Numero_carte`),
  ADD KEY `ID_Client` (`ID_Client`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`ID_Client`);

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
-- Index pour la table `proposer`
--
ALTER TABLE `proposer`
  ADD PRIMARY KEY (`ID_Labo`,`ID_Services`),
  ADD KEY `ID_Services` (`ID_Services`);

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
-- AUTO_INCREMENT pour la table `administrateur`
--
ALTER TABLE `administrateur`
  MODIFY `ID_Admin` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `ID_Medecin` int(11) NOT NULL AUTO_INCREMENT;

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
-- Contraintes pour la table `carte_credit`
--
ALTER TABLE `carte_credit`
  ADD CONSTRAINT `carte_credit_ibfk_1` FOREIGN KEY (`ID_Client`) REFERENCES `client` (`ID_Client`);

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
-- Contraintes pour la table `proposer`
--
ALTER TABLE `proposer`
  ADD CONSTRAINT `proposer_ibfk_1` FOREIGN KEY (`ID_Labo`) REFERENCES `laboratoire_de_biologie_medicale` (`ID_Labo`),
  ADD CONSTRAINT `proposer_ibfk_2` FOREIGN KEY (`ID_Services`) REFERENCES `services` (`ID_Services`);

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

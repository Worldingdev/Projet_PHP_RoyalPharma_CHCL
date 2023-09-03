-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mer. 30 août 2023 à 20:48
-- Version du serveur : 5.7.39
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestionPharmacie`
--

-- --------------------------------------------------------

--
-- Structure de la table `Client`
--

CREATE TABLE `Client` (
  `Id` varchar(15) NOT NULL,
  `Nom` varchar(20) NOT NULL,
  `Prenom` varchar(20) NOT NULL,
  `Sexe` varchar(15) NOT NULL,
  `Adresse` varchar(20) NOT NULL,
  `Telephone` varchar(50) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Dob` date NOT NULL,
  `etat` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Produit`
--

CREATE TABLE `Produit` (
  `Id` varchar(15) NOT NULL,
  `Nom` varchar(20) NOT NULL,
  `Prix` int(15) NOT NULL,
  `quantite` int(11) NOT NULL,
  `Type` varchar(20) NOT NULL,
  `etat` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Produit_Vente`
--

CREATE TABLE `Produit_Vente` (
  `id` int(11) NOT NULL,
  `idProduit` varchar(255) NOT NULL,
  `idVente` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `Id` varchar(255) NOT NULL,
  `Nom` varchar(20) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Telephone` varchar(15) NOT NULL,
  `NINU` int(20) NOT NULL,
  `motDePasse` varchar(255) NOT NULL,
  `Type` varchar(20) NOT NULL,
  `etat` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Utilisateur`
--

INSERT INTO `Utilisateur` (`Id`, `Nom`, `Username`, `Telephone`, `NINU`, `motDePasse`, `Type`, `etat`) VALUES
('User-Ju-761', 'Junior Fleuridor', 'jun.101', '50965788956', 18896621, '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Admin', 1);

-- --------------------------------------------------------

--
-- Structure de la table `Vente`
--

CREATE TABLE `Vente` (
  `Id` varchar(250) NOT NULL,
  `Produit` varchar(255) DEFAULT NULL,
  `Client` varchar(20) NOT NULL,
  `Type` varchar(20) NOT NULL,
  `Montant` double NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Client`
--
ALTER TABLE `Client`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `Produit`
--
ALTER TABLE `Produit`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `Produit_Vente`
--
ALTER TABLE `Produit_Vente`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `NINU` (`NINU`),
  ADD UNIQUE KEY `Telephone` (`Telephone`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Index pour la table `Vente`
--
ALTER TABLE `Vente`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Client` (`Client`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Produit_Vente`
--
ALTER TABLE `Produit_Vente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Vente`
--
ALTER TABLE `Vente`
  ADD CONSTRAINT `vente_ibfk_1` FOREIGN KEY (`Client`) REFERENCES `Client` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

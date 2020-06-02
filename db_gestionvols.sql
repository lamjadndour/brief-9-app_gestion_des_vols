-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_gestionvols`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `idClient` int(11) NOT NULL,
  `Nom` varchar(200) NOT NULL,
  `Prenom` varchar(200) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `CIN` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`idClient`, `Nom`, `Prenom`, `Email`, `tel`, `CIN`) VALUES
(1, 'premier', 'passager', 'test@gmail.com', 'SH6667', '0697546508'),
(2, 'next', 'passager', 'passager@espagne.es', 'SH221122', '+212776776');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `idreservation` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idClient` int(11) NOT NULL,
  `idVol` int(11) NOT NULL,
  `date_reseravtion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`idreservation`, `iduser`, `idClient`, `idVol`, `date_reseravtion`) VALUES
(1, 1, 1, 3, '2020-05-14 17:17:47'),
(2, 1, 2, 5, '2020-05-14 17:17:47');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `iduser` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `grade` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`iduser`, `username`, `password`, `Email`, `grade`) VALUES
(1, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user@localhost.com', 0),
(2, 'hello', '5d41402abc4b2a76b9719d911017c592', 'helloworld@home.ma', 1);

-- --------------------------------------------------------

--
-- Structure de la table `vols`
--

CREATE TABLE `vols` (
  `idVol` int(11) NOT NULL,
  `depart` varchar(200) NOT NULL,
  `destination` varchar(200) NOT NULL,
  `date_depart` date NOT NULL,
  `time` time NOT NULL,
  `prix` float NOT NULL,
  `place_disponible` int(11) NOT NULL,
  `status` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `vols`
--

INSERT INTO `vols` (`idVol`, `depart`, `destination`, `date_depart`, `time`, `prix`, `place_disponible`, `status`) VALUES
(1, 'Safi', 'casablanca', '2020-05-28', '12:00:00', 700, 19, 'Activer'),
(2, 'dakhla', 'fes', '2020-05-31', '00:00:00', 900, 10, 'Activer'),
(3, 'fes', 'dakhla', '2020-06-25', '17:30:00', 400, 10, 'Activer'),
(4, 'dakhla', 'fes', '2020-06-18', '17:30:00', 300, 8, 'Activer'),
(5, 'dakhla', 'fes', '2020-06-25', '17:30:00', 300, 10, 'Desactiver'),
(6, 'dakhla', 'fes', '2020-06-26', '17:30:00', 300, 10, 'Activer'),
(9, 'casablanca', 'dakhla', '2020-06-09', '12:00:00', 1000, 9, 'Activer'),
(10, 'safi', 'Salé', '2020-06-03', '12:00:00', 100, 12, 'Activer'),
(11, 'safi', 'Salé', '2020-06-03', '12:00:00', 100, 12, 'Activer'),
(12, 'safi', 'casablanca', '2020-09-17', '12:00:00', 1000, 8, 'Activer'),
(13, 'Salé', 'safi', '2020-06-16', '02:00:00', 300, 30, 'Activer');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`idClient`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`idreservation`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`iduser`);

--
-- Index pour la table `vols`
--
ALTER TABLE `vols`
  ADD PRIMARY KEY (`idVol`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `idClient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `idreservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `vols`
--
ALTER TABLE `vols`
  MODIFY `idVol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  jeu. 11 avr. 2019 à 17:12
-- Version du serveur :  10.1.32-MariaDB
-- Version de PHP :  7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `h2si3`
--
CREATE DATABASE IF NOT EXISTS `h2si3` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `h2si3`;

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `text` varchar(1024) NOT NULL,
  `answers` varchar(1024) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id`, `text`, `answers`, `type`) VALUES
(1, 'Question facile mdr', '[{\"content\": \"Oui\", \"right\": \"true\"}, {\"content\": \"Non\", \"right\": \"false\"}]', 1),
(2, 'Question difficile lol', '[{\"content\": \"Oui\", \"right\": \"false\"}, {\"content\": \"Non\", \"right\": \"true\"}]', 1),
(3, 'Question du type 2', '[{\"content\": \"Oui\", \"right\": \"true\"}, {\"content\": \"Non\", \"right\": \"false\"},\r\n{\"content\": \"Oui\", \"right\": \"false\"}, {\"content\": \"Non\", \"right\": \"false\"}]', 2),
(4, 'Question de quel type ??', '[{\"content\": \"Oui\", \"right\": \"false\"}, {\"content\": \"Non\", \"right\": \"false\"},\r\n{\"content\": \"Type 2\", \"right\": \"true\"}, {\"content\": \"Type 3\", \"right\": \"false\"}]', 2);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `progression` varchar(1024) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL,
  `unlocked_badges` varchar(1024) NOT NULL DEFAULT '[]'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `progression`, `password`, `unlocked_badges`) VALUES
(7, 'test', '0', '81dc9bdb52d04dc20036dbd8313ed055', '[0, 25, 50]');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

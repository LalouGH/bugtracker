-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 09 juin 2023 à 23:10
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sae203_adlaolal`
--

-- --------------------------------------------------------

--
-- Structure de la table `sae203_tickets`
--

CREATE TABLE `sae203_tickets` (
  `id` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `tag` varchar(50) NOT NULL,
  `ticket_desc` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ticket_status` text DEFAULT NULL COMMENT '0 : En attente\r\n\r\n1 : En cours de traitement\r\n\r\n2 : rejeté\r\n\r\n3 : résolu\r\n',
  `ticket_priority` tinyint(5) DEFAULT NULL,
  `dev_assign` int(11) DEFAULT NULL,
  `assign_date` datetime DEFAULT NULL,
  `resolution_date` datetime DEFAULT NULL,
  `dev_comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `sae203_tickets`
--

INSERT INTO `sae203_tickets` (`id`, `creation_date`, `user_id`, `title`, `tag`, `ticket_desc`, `ticket_status`, `ticket_priority`, `dev_assign`, `assign_date`, `resolution_date`, `dev_comment`) VALUES
(89, '2023-06-09 20:14:43', 5, 'Test Ticket avec Testeur 2', 'Problème d\'interface', 'Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum ', '', 5, 2, '2023-06-09 21:51:06', '0000-00-00 00:00:00', 'EFFEZEZFEFZEZFFEZ'),
(90, '2023-06-09 20:15:03', 5, 'test ticket avec Testeur2 - Changement de tagDDDDD', 'Crash', 'Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum ', 'Rejeté', NULL, NULL, '2023-06-09 20:18:33', '2023-06-09 20:18:33', 'Rejeté par l\'administrateur'),
(91, '2023-06-09 20:17:43', 4, 'Test Ticket avec Testeur1', 'Problème d\'interface', 'Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum ', 'Rejeté', 2, 3, '2023-06-09 20:18:51', '2023-06-09 20:36:54', 'Non solvable/cohérent'),
(92, '2023-06-09 20:17:59', 4, 'Test Ticket avec Testeur1 - Changement de tag', 'Crash', 'Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum &#13;&#10;', 'En cours de traitement', 4, 2, '2023-06-09 21:50:58', '0000-00-00 00:00:00', 'NZOJFHNIOZEJEZPIO¨ZP');

-- --------------------------------------------------------

--
-- Structure de la table `sae203_users`
--

CREATE TABLE `sae203_users` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 : admin, 1: dev, 2: testeur'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `sae203_users`
--

INSERT INTO `sae203_users` (`id`, `login`, `password`, `status`) VALUES
(1, 'admin', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 0),
(2, 'dev1', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1),
(3, 'dev2', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1),
(4, 'testeur1', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2),
(5, 'testeur2', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `sae203_tickets`
--
ALTER TABLE `sae203_tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dev_assign` (`dev_assign`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `sae203_users`
--
ALTER TABLE `sae203_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `sae203_tickets`
--
ALTER TABLE `sae203_tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT pour la table `sae203_users`
--
ALTER TABLE `sae203_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `sae203_tickets`
--
ALTER TABLE `sae203_tickets`
  ADD CONSTRAINT `sae203_tickets_ibfk_1` FOREIGN KEY (`dev_assign`) REFERENCES `sae203_users` (`id`),
  ADD CONSTRAINT `sae203_tickets_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `sae203_users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

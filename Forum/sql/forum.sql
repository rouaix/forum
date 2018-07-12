-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 12 Juillet 2018 à 15:01
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `forum`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `categorie_id` int(10) UNSIGNED NOT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`categorie_id`, `designation`, `user_id`) VALUES
(1, 'forum', 1),
(11, 'info', 1);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `message_id` int(10) UNSIGNED NOT NULL,
  `contenu` longtext,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `categorie_id` int(10) UNSIGNED DEFAULT NULL,
  `sujet_id` int(10) UNSIGNED DEFAULT NULL,
  `destinataire_id` int(10) UNSIGNED DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `pere_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `message`
--

INSERT INTO `message` (`message_id`, `contenu`, `user_id`, `categorie_id`, `sujet_id`, `destinataire_id`, `date`, `pere_id`) VALUES
(48, 'C&rsquo;est le devoir de chaque homme de rendre au monde au moins autant qu&rsquo;il en a re&ccedil;u.&lt;br /&gt;Albert Einstein', 1, 1, 1, 0, '2018-07-05 00:00:00', 0),
(49, 'Deux choses sont infinies : l&rsquo;Univers et la b&ecirc;tise humaine. Mais en ce qui concerne l&rsquo;Univers, je n&rsquo;en ai pas encore acquis la certitude absolue. &lt;br /&gt;Albert Einstein', 1, 1, 1, 0, '2018-07-05 00:00:00', 0),
(50, 'La connaissance s&rsquo;acquiert par l&rsquo;exp&eacute;rience, tout le reste n&rsquo;est que de l&rsquo;information. &lt;br /&gt;Albert Einstein', 1, 1, 1, 0, '2018-07-05 00:00:00', 0),
(51, 'La folie, c&rsquo;est de faire toujours la m&ecirc;me chose et de s&rsquo;attendre &agrave; un r&eacute;sultat diff&eacute;rent. &lt;br /&gt;Albert Einstein', 1, 1, 1, 0, '2018-07-05 00:00:00', 0),
(116, '&lt;p&gt;&lt;img src=&quot;js/tinymce/plugins/emoticons/img/yell.png&quot; alt=&quot;yell&quot; /&gt;&lt;/p&gt;', 1, 1, 1, 0, '2018-07-12 00:00:00', 0),
(117, '&lt;p&gt;Je suis un ALIEN !&lt;/p&gt;', 1, 1, 1, 0, '2018-07-12 00:00:00', 116);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `designation` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `role`
--

INSERT INTO `role` (`role_id`, `designation`) VALUES
(1, 'administrateur'),
(2, 'utilisateur'),
(3, 'moderateur'),
(4, 'banni');

-- --------------------------------------------------------

--
-- Structure de la table `sujet`
--

CREATE TABLE `sujet` (
  `sujet_id` int(100) UNSIGNED NOT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `user_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `sujet`
--

INSERT INTO `sujet` (`sujet_id`, `designation`, `categorie_id`, `user_id`) VALUES
(1, 'open bar', 1, 1),
(14, 'Open Bar', 11, 1),
(15, 'Open Bar', 12, 1),
(16, 'Open Bar', 13, 1),
(17, 'Open Bar', 13, 1),
(18, 'Open Bar', 15, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `mail` varchar(255) NOT NULL,
  `role_id` varchar(45) DEFAULT NULL,
  `motdepasse` varchar(255) DEFAULT NULL,
  `naissance` date DEFAULT NULL,
  `inscription` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`user_id`, `pseudo`, `prenom`, `nom`, `mail`, `role_id`, `motdepasse`, `naissance`, `inscription`) VALUES
(1, 'root', 'daniel', 'rouaix', 'daniel@rouaix.com', '1', '63a9f0ea7bb98050796b649e85481845', '1962-10-25', '2018-07-02'),
(7, 'rouaix', 'daniel', 'rouaix', 'daniel@rouaix.net', '3', '03248b3e7454bd1b2243bfd33c6980f3', '1962-10-25', '2018-07-03'),
(8, 'createur', 'daniel', 'rouaix', 'createur@free.fr', '2', '03248b3e7454bd1b2243bfd33c6980f3', '1962-10-25', '2018-07-12');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`categorie_id`),
  ADD UNIQUE KEY `categorie_id_UNIQUE` (`categorie_id`),
  ADD UNIQUE KEY `designation` (`designation`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`),
  ADD UNIQUE KEY `message_id_UNIQUE` (`message_id`),
  ADD KEY `pere_id` (`pere_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `categorie_id` (`categorie_id`),
  ADD KEY `sujet_id` (`sujet_id`),
  ADD KEY `destinataire_id` (`destinataire_id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_id_UNIQUE` (`role_id`);

--
-- Index pour la table `sujet`
--
ALTER TABLE `sujet`
  ADD PRIMARY KEY (`sujet_id`),
  ADD UNIQUE KEY `sujet_id_UNIQUE` (`sujet_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `pseudo_UNIQUE` (`pseudo`),
  ADD UNIQUE KEY `id_UNIQUE` (`user_id`),
  ADD UNIQUE KEY `mail_UNIQUE` (`mail`),
  ADD KEY `mail` (`mail`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `categorie_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;
--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `sujet`
--
ALTER TABLE `sujet`
  MODIFY `sujet_id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

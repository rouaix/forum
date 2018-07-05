-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 05 Juillet 2018 à 15:06
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
(1, 'Informatique', 1),
(2, 'Loisirs', 1);

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
(47, 'Celui qui ne peut plus &eacute;prouver ni &eacute;tonnement ni surprise, est pour ainsi dire mort : ses yeux sont &eacute;teints.&lt;br /&gt;Albert Einstein', 1, 1, 1, 0, '2018-07-05 00:00:00', 0),
(48, 'C&rsquo;est le devoir de chaque homme de rendre au monde au moins autant qu&rsquo;il en a re&ccedil;u.&lt;br /&gt;Albert Einstein', 1, 1, 1, 0, '2018-07-05 00:00:00', 0),
(49, 'Deux choses sont infinies : l&rsquo;Univers et la b&ecirc;tise humaine. Mais en ce qui concerne l&rsquo;Univers, je n&rsquo;en ai pas encore acquis la certitude absolue. &lt;br /&gt;Albert Einstein', 1, 1, 1, 0, '2018-07-05 00:00:00', 0),
(50, 'La connaissance s&rsquo;acquiert par l&rsquo;exp&eacute;rience, tout le reste n&rsquo;est que de l&rsquo;information. &lt;br /&gt;Albert Einstein', 1, 1, 1, 0, '2018-07-05 00:00:00', 0),
(51, 'La folie, c&rsquo;est de faire toujours la m&ecirc;me chose et de s&rsquo;attendre &agrave; un r&eacute;sultat diff&eacute;rent. &lt;br /&gt;Albert Einstein', 1, 1, 1, 0, '2018-07-05 00:00:00', 0),
(52, 'La th&eacute;orie, c&rsquo;est quand on sait tout et que rien ne fonctionne. La pratique, c&rsquo;est quand tout fonctionne et que personne ne sait pourquoi. Ici, nous avons r&eacute;uni th&eacute;orie et pratique : Rien ne fonctionne&hellip; et personne ne sait pourquoi ! &lt;br /&gt;Albert Einstein', 1, 1, 1, 0, '2018-07-05 00:00:00', 0),
(53, 'Ce qu&rsquo;on appelle le bon sens est en fait l&rsquo;ensemble des id&eacute;es re&ccedil;ues qu&rsquo;on nous a inculqu&eacute;es jusqu&rsquo;&agrave; 18 ans. &lt;br /&gt;Albert Einstein', 1, 1, 1, 0, '2018-07-05 00:00:00', 0),
(54, 'Rencontre entre Charlie Chaplin et Albert Einstein&lt;br /&gt;\r\n&lt;br /&gt;\r\n&lt;br /&gt;&mdash; Ce que j&rsquo;admire le plus dans votre art, dit Albert Eins&shy;tein c&rsquo;est son universalit&eacute;. Vous ne dites pas un mot, et pourtant le monde entier vous comprend.\r\n&lt;br /&gt;\r\n&lt;br /&gt;&mdash; C&rsquo;est vrai, r&eacute;plique Chaplin. Mais votre gloire est plus grande encore : le monde entier vous admire, alors que personne ne vous comprend.&raquo;', 1, 1, 1, 0, '2018-07-05 00:00:00', 0),
(66, '&lt;p&gt;lkjlkjlj&lt;/p&gt;', 1, 1, 1, 7, '2018-07-05 00:00:00', 0),
(67, '&lt;p&gt;lll&lt;/p&gt;', 1, 1, 1, 7, '2018-07-05 00:00:00', 0),
(72, '&lt;p&gt;&lt;img src=&quot;js/tinymce/plugins/emoticons/img/smiley-tongue-out.png&quot; alt=&quot;tongue-out&quot; /&gt;&lt;/p&gt;', 1, 1, 1, 1, '2018-07-05 00:00:00', 0);

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
(1, 'Open Bar', 2, 1),
(2, 'Les logiciels', 1, 1);

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
(7, 'rouaix', 'daniel', 'rouaix', 'daniel@rouaix.net', '2', '03248b3e7454bd1b2243bfd33c6980f3', '1962-10-25', '2018-07-03');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`categorie_id`),
  ADD UNIQUE KEY `categorie_id_UNIQUE` (`categorie_id`);

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
  MODIFY `categorie_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `sujet`
--
ALTER TABLE `sujet`
  MODIFY `sujet_id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

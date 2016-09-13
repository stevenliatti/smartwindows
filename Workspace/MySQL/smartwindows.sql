-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 12 Septembre 2016 à 13:07
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `smartwindows`
--

-- --------------------------------------------------------

--
-- Structure de la table `data`
--

CREATE TABLE `data` (
  `id` int(11) NOT NULL,
  `temp_int` double NOT NULL,
  `luminosity` double NOT NULL,
  `temp_ext` double NOT NULL,
  `wind_speed` double NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `data`
--

INSERT INTO `data` (`id`, `temp_int`, `luminosity`, `temp_ext`, `wind_speed`, `date`, `time`) VALUES
(391, 22.16, 26.23, 20.59, 0, '2016-09-09', '14:08:44'),
(392, 21.36, 116.92, 19.97, 0, '2016-09-09', '14:08:59'),
(393, 22.03, 120.14, 19.93, 0, '2016-09-09', '14:09:14'),
(394, 21.59, 121.6, 20, 0, '2016-09-09', '14:09:29'),
(395, 21.59, 121.12, 19.94, 0, '2016-09-09', '14:09:44'),
(396, 21.72, 120.85, 19.96, 0, '2016-09-09', '14:09:59'),
(397, 21.53, 120.8, 19.94, 0, '2016-09-09', '14:10:14'),
(398, 21.75, 120.96, 20.1, 0, '2016-09-09', '14:10:29'),
(399, 21.84, 120.8, 20.09, 0, '2016-09-09', '14:10:44'),
(400, 21.81, 120.8, 19.94, 0, '2016-09-09', '14:10:59'),
(401, 21.77, 120.8, 20.05, 0, '2016-09-09', '14:11:14'),
(402, 21.95, 120.64, 20.09, 0, '2016-09-09', '14:11:29'),
(403, 21.84, 120.64, 20.22, 0, '2016-09-09', '14:11:44'),
(404, 21.77, 120.64, 20.09, 0, '2016-09-09', '14:11:59'),
(405, 21.95, 120.75, 20.15, 0, '2016-09-09', '14:12:14'),
(406, 22.02, 121.12, 20.3, 0, '2016-09-09', '14:12:29'),
(407, 21.75, 120.96, 20.03, 0, '2016-09-09', '14:12:44'),
(408, 21.7, 120.8, 14.98, 0, '2016-09-09', '14:12:59'),
(409, 21.91, 121.44, 20.55, 0, '2016-09-09', '14:13:14'),
(410, 22.01, 95.05, 19.96, 0, '2016-09-09', '14:13:29'),
(411, 21.84, 117.24, 20, 0, '2016-09-09', '14:13:44'),
(412, 22.02, 116.6, 20.16, 0, '2016-09-09', '14:13:59'),
(413, 22.13, 117.68, 20.25, 0, '2016-09-09', '14:14:14'),
(414, 21.84, 116.96, 19.94, 0, '2016-09-09', '14:14:29'),
(415, 22.23, 117.56, 20.14, 0, '2016-09-09', '14:14:44'),
(416, 21.5, 117.88, 10.03, 0, '2016-09-09', '14:14:59'),
(417, 21.84, 116.76, 20.16, 0, '2016-09-09', '14:15:14'),
(418, 21.84, 117.24, 19.88, 0, '2016-09-09', '14:15:44'),
(419, 21.98, 117.44, 20.42, 0, '2016-09-09', '14:15:59'),
(420, 21.56, 117.57, 16.24, 0, '2016-09-09', '14:16:14'),
(421, 21.84, 118.22, 20.06, 0, '2016-09-09', '14:16:29'),
(422, 21.91, 118.22, 20.06, 0, '2016-09-09', '14:16:44'),
(423, 21.79, 118.09, 20.12, 0, '2016-09-09', '14:16:59'),
(424, 21.84, 117.58, 20.14, 0, '2016-09-09', '14:17:14'),
(425, 21.75, 116.92, 20.2, 0, '2016-09-09', '14:17:29'),
(426, 21.78, 117.44, 15.06, 0, '2016-09-09', '14:17:44'),
(427, 21.75, 117.6, 20.25, 0, '2016-09-09', '14:17:59'),
(428, 21.64, 117.28, 20, 0, '2016-09-09', '14:18:14'),
(429, 21.75, 118.22, 20.05, 0, '2016-09-09', '14:18:29'),
(430, 17.17, 117.81, 20.1, 0, '2016-09-09', '14:18:44'),
(431, 21.77, 117.12, 19.97, 0, '2016-09-09', '14:18:59'),
(432, 21.72, 117.49, 20.03, 0, '2016-09-09', '14:19:14'),
(433, 21.66, 118.22, 20.12, 0, '2016-09-09', '14:19:29'),
(434, 21.61, 118.86, 20.16, 0, '2016-09-09', '14:19:44'),
(435, 21.82, 119.48, 20.22, 0, '2016-09-09', '14:19:59'),
(436, 21.75, 119.16, 20.31, 0, '2016-09-09', '14:20:14'),
(437, 21.73, 119, 20.02, 0, '2016-09-09', '14:20:29'),
(438, 21.77, 118.86, 20.28, 0, '2016-09-09', '14:20:44'),
(439, 21.77, 119.83, 20.1, 0, '2016-09-09', '14:20:59'),
(440, 21.61, 118.2, 20.2, 0, '2016-09-09', '14:21:14'),
(441, 21.65, 117.56, 20.19, 0, '2016-09-09', '14:21:29'),
(442, 21.67, 118.04, 20.04, 0, '2016-09-09', '14:21:44'),
(443, 21.59, 119.71, 20.05, 0, '2016-09-09', '14:21:59'),
(444, 21.73, 120.16, 20.2, 0, '2016-09-09', '14:22:14'),
(445, 21.75, 121.12, 20.16, 0, '2016-09-09', '14:22:29'),
(446, 21.69, 123.04, 20.28, 0, '2016-09-09', '14:22:44'),
(447, 21.52, 119.84, 20, 0, '2016-09-09', '14:22:59'),
(448, 21.61, 121.12, 20.14, 0, '2016-09-09', '14:23:14'),
(449, 21.73, 120.37, 20.1, 0, '2016-09-09', '14:23:29'),
(450, 21.67, 119.36, 19.89, 0, '2016-09-09', '14:23:44'),
(451, 20.25, 119.2, 20.11, 0, '2016-09-09', '14:23:59'),
(452, 21.62, 120.27, 20.1, 0, '2016-09-09', '14:24:14'),
(453, 21.66, 119.84, 19.97, 0, '2016-09-09', '14:24:29'),
(454, 21.67, 120.16, 19.94, 0, '2016-09-09', '14:24:44'),
(455, 21.58, 120.16, 20.16, 0, '2016-09-09', '14:24:59'),
(456, 21.62, 120.41, 19.96, 0, '2016-09-09', '14:25:14'),
(457, 21.62, 119.24, 19.92, 0, '2016-09-09', '14:25:29'),
(458, 21.51, 119.35, 19.95, 0, '2016-09-09', '14:25:44'),
(459, 21.61, 119.4, 20.02, 0, '2016-09-09', '14:25:59'),
(460, 21.56, 119.56, 19.78, 0, '2016-09-09', '14:26:14'),
(461, 21.63, 120.52, 20, 0, '2016-09-09', '14:26:29'),
(462, 21.6, 119.45, 19.98, 0, '2016-09-09', '14:26:44'),
(463, 21.69, 119.13, 20.17, 0, '2016-09-09', '14:26:59'),
(464, 21.69, 119.56, 19.97, 0, '2016-09-09', '14:27:14'),
(465, 21.64, 119.56, 14.88, 0, '2016-09-09', '14:27:29'),
(466, 21.65, 118.71, 20.03, 0, '2016-09-09', '14:27:44'),
(467, 21.53, 118.92, 19.88, 0, '2016-09-09', '14:27:59'),
(468, 21.63, 120.52, 20.19, 0, '2016-09-09', '14:28:14'),
(469, 21.64, 119.88, 19.94, 0, '2016-09-09', '14:28:29'),
(470, 21.5, 119.77, 20.05, 0, '2016-09-09', '14:28:44'),
(471, 21.59, 120.52, 20.31, 0, '2016-09-09', '14:28:59'),
(472, 21.38, 117.64, 19.78, 0, '2016-09-09', '14:29:14'),
(473, 21.59, 119.24, 20.19, 0, '2016-09-09', '14:29:29'),
(474, 21.58, 120.04, 19.82, 0, '2016-09-09', '14:29:44'),
(475, 21.54, 115.17, 19.96, 0, '2016-09-09', '14:29:59'),
(476, 21.56, 115.68, 20.02, 0, '2016-09-09', '14:30:14'),
(477, 21.53, 116.25, 20.08, 0, '2016-09-09', '14:30:29'),
(478, 21.59, 119.4, 20.14, 0, '2016-09-09', '14:30:44'),
(479, 21.5, 121.16, 20.02, 0, '2016-09-09', '14:30:59'),
(480, 21.64, 120.31, 20.09, 0, '2016-09-09', '14:31:14'),
(481, 21.55, 120.52, 20.05, 0, '2016-09-09', '14:31:29'),
(482, 21.69, 122.44, 19.97, 0, '2016-09-09', '14:31:44'),
(483, 21.56, 122.76, 20.12, 0, '2016-09-09', '14:31:59'),
(484, 21.47, 122.44, 20.16, 0, '2016-09-09', '14:32:14'),
(485, 21.67, 121.96, 20.02, 0, '2016-09-09', '14:32:29'),
(486, 21.42, 121.8, 20.05, 0, '2016-09-09', '14:32:44'),
(487, 22, 121.8, 20.34, 0, '2016-09-09', '14:32:59'),
(488, 21.55, 121.96, 20.12, 0, '2016-09-09', '14:33:14'),
(489, 21.66, 122.44, 20, 0, '2016-09-09', '14:33:29'),
(490, 21.69, 119.88, 20.03, 0, '2016-09-09', '14:33:44'),
(491, 21.41, 116.36, 19.92, 0, '2016-09-09', '14:33:59'),
(492, 21.58, 121.48, 20, 0, '2016-09-09', '14:34:29'),
(493, 21.48, 120.68, 20.16, 0, '2016-09-09', '14:34:44'),
(494, 21.59, 121.32, 20.16, 0, '2016-09-09', '14:35:14'),
(495, 21.78, 121.48, 20.03, 0, '2016-09-09', '14:35:29'),
(496, 21.51, 121.91, 19.93, 0, '2016-09-09', '14:35:44'),
(497, 21.69, 121.8, 19.97, 0, '2016-09-09', '14:35:59'),
(498, 21.63, 121.16, 20.28, 0, '2016-09-09', '14:36:14'),
(499, 21.5, 121.8, 19.97, 0, '2016-09-09', '14:36:29'),
(500, 21.78, 122.12, 19.97, 0, '2016-09-09', '14:36:45'),
(501, 21.56, 121.48, 20.09, 0, '2016-09-09', '14:37:00'),
(502, 21.38, 119.96, 20.13, 0, '2016-09-09', '14:49:11'),
(503, 21.69, 119.64, 20.03, 0, '2016-09-09', '14:49:26'),
(504, 21.52, 119.32, 20.13, 0, '2016-09-09', '14:49:41'),
(505, 21.53, 117.36, 20.14, 0, '2016-09-09', '14:50:38'),
(506, 21.45, 117.36, 20.12, 0, '2016-09-09', '14:50:53'),
(507, 21.44, 117.2, 20.25, 0, '2016-09-09', '14:51:08'),
(508, 21.56, 119, 20.28, 0, '2016-09-09', '14:51:37'),
(509, 24.22, 110.8, 21.03, 0, '2016-09-09', '14:52:10'),
(510, 22.36, 129.48, 20.66, 0, '2016-09-09', '15:28:53'),
(511, 22.28, 125.32, 20.66, 0, '2016-09-09', '15:29:08'),
(512, 22.28, 71.42, 21.34, 1, '2016-09-09', '15:29:23'),
(513, 22.42, 72.3, 20.77, 0, '2016-09-09', '15:29:38'),
(514, 22.47, 0, 24.81, 0, '2016-09-09', '15:30:08'),
(515, 21.91, 6.19, 15.38, 0, '2016-09-09', '15:30:23'),
(516, 21.98, 0.24, 18.89, 0, '2016-09-09', '15:30:38'),
(517, 22.22, 0.24, 19.94, 0, '2016-09-09', '15:30:53'),
(518, 22.19, 64.28, 20.53, 0, '2016-09-09', '15:31:08'),
(519, 22.41, 3799.68, 20.61, 0, '2016-09-09', '15:31:23'),
(520, 22.25, 4097.28, 20.44, 0, '2016-09-09', '15:31:38'),
(521, 22.75, 276.54, 21.3, 0, '2016-09-09', '15:33:16'),
(522, 22.53, 1000.64, 21.16, 0, '2016-09-09', '15:33:31'),
(523, 22.84, 152.44, 21.47, 0, '2016-09-09', '15:36:54'),
(524, 23.14, 839.9, 21.62, 0, '2016-09-09', '15:37:09'),
(525, 23.66, 1707.84, 21.7, 0, '2016-09-09', '15:37:24'),
(526, 22.47, 155, 21.5, 0, '2016-09-09', '15:42:31'),
(527, 22.56, 153.36, 21.22, 0, '2016-09-09', '15:46:43'),
(528, 22.38, 153.72, 21.5, 0, '2016-09-09', '15:49:00'),
(529, 22.34, 162.4, 21.34, 0, '2016-09-09', '15:50:47'),
(530, 22.38, 162.08, 21.5, 0, '2016-09-09', '15:51:02'),
(531, 22.16, 161.44, 21.5, 0, '2016-09-09', '15:51:17'),
(532, 22.28, 161.55, 21.55, 0, '2016-09-09', '15:51:32'),
(533, 22.77, 1054.14, 21.48, 0, '2016-09-09', '15:51:47'),
(534, 22.53, 161.72, 21.28, 0, '2016-09-09', '15:52:02'),
(535, 22.06, 143.44, 10.03, 0, '2016-09-09', '15:54:54'),
(536, 22.25, 143.44, 21.22, 0, '2016-09-09', '15:55:09'),
(537, 22.41, 151.97, 21.57, 0, '2016-09-09', '15:57:32'),
(538, 22.28, 150.42, 21.31, 0, '2016-09-09', '15:57:47'),
(539, 22.67, 126.3, 21.47, 0, '2016-09-09', '15:58:02'),
(540, 22.66, 159.92, 21.25, 0, '2016-09-09', '16:06:26'),
(541, 22.44, 141.8, 20.69, 0, '2016-09-09', '16:22:33'),
(542, 22.66, 138.24, 20.75, 0, '2016-09-09', '16:22:48'),
(543, 22.64, 136.18, 20.7, 0, '2016-09-09', '16:23:03'),
(544, 22.47, 139.7, 20.84, 0, '2016-09-09', '16:23:19'),
(545, 22.65, 141.37, 20.83, 0, '2016-09-09', '16:23:34'),
(546, 22.62, 139.65, 20.78, 0, '2016-09-09', '16:23:49'),
(547, 22.55, 127.98, 20.97, 0, '2016-09-09', '16:24:04'),
(548, 21.38, 70.02, 19.28, 0, '2016-09-12', '10:22:07'),
(549, 21.59, 75.82, 19.13, 0, '2016-09-12', '10:22:23'),
(550, 21.53, 74.36, 19, 0, '2016-09-12', '10:23:23'),
(551, 21.56, 72.44, 19.28, 0, '2016-09-12', '10:23:38'),
(552, 21.47, 65.98, 19.25, 0, '2016-09-12', '10:23:53'),
(553, 21.44, 60.18, 18.81, 0, '2016-09-12', '10:24:08'),
(554, 21.44, 58.58, 19.16, 0, '2016-09-12', '10:24:53'),
(555, 21.28, 73.2, 19.09, 0, '2016-09-12', '10:25:08'),
(556, 21.44, 76.6, 19.31, 0, '2016-09-12', '10:25:23'),
(557, 21.5, 63.08, 19.22, 0, '2016-09-12', '10:27:24'),
(558, 21.31, 66.3, 19.22, 0, '2016-09-12', '10:27:54'),
(559, 21.5, 65.02, 19.22, 0, '2016-09-12', '10:28:09'),
(560, 21.75, 65.36, 19.06, 0, '2016-09-12', '10:28:24'),
(561, 21.47, 68.56, 19.06, 0, '2016-09-12', '10:28:39'),
(562, 21.25, 69.04, 19.13, 0, '2016-09-12', '10:35:56'),
(563, 21.19, 74.2, 19.44, 0, '2016-09-12', '10:36:42'),
(564, 21.31, 75.48, 19.28, 0, '2016-09-12', '10:36:57'),
(565, 21.34, 76.92, 19.09, 0, '2016-09-12', '10:37:12'),
(566, 21.69, 71.46, 19.25, 0, '2016-09-12', '10:37:42'),
(567, 21.13, 74.36, 19.16, 0, '2016-09-12', '10:38:12'),
(568, 21.44, 52.78, 19.44, 0, '2016-09-12', '10:41:30'),
(569, 21.53, 75.96, 19.56, 0, '2016-09-12', '10:42:00'),
(570, 21.47, 73.1, 19.44, 0, '2016-09-12', '10:45:42'),
(571, 21.63, 74.54, 19.41, 0, '2016-09-12', '10:47:16'),
(572, 21.16, 70.66, 19.44, 0, '2016-09-12', '10:48:16'),
(573, 21.47, 55.04, 19.38, 0, '2016-09-12', '10:50:06'),
(574, 21.41, 49.72, 19.34, 0, '2016-09-12', '10:51:51'),
(575, 21.69, 53.26, 19.56, 0, '2016-09-12', '10:52:51'),
(576, 21.28, 64.04, 19.78, 0, '2016-09-12', '10:53:51');

-- --------------------------------------------------------

--
-- Structure de la table `state`
--

CREATE TABLE `state` (
  `id` int(11) NOT NULL,
  `config_mode` varchar(1) NOT NULL,
  `window` varchar(1) NOT NULL,
  `blind` varchar(2) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `state`
--

INSERT INTO `state` (`id`, `config_mode`, `window`, `blind`, `date`, `time`, `users_id`) VALUES
(11, '0', '0', '5', '2016-09-09', '16:22:26', 3),
(12, '0', '0', '9', '2016-09-09', '16:22:46', 3),
(13, '0', '0', '10', '2016-09-09', '16:22:57', 3),
(14, '0', '0', '4', '2016-09-12', '10:35:50', 3),
(15, '0', '0', '2', '2016-09-12', '10:38:06', 3),
(16, '0', '0', '7', '2016-09-12', '10:45:35', 3),
(17, '0', '0', '5', '2016-09-12', '10:50:02', 3);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `role` varchar(20) CHARACTER SET latin1 NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `password`, `role`, `name`) VALUES
(3, '', 'waspmote', 'waspmote');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_state_users_idx` (`users_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `data`
--
ALTER TABLE `data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=577;
--
-- AUTO_INCREMENT pour la table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `state`
--
ALTER TABLE `state`
  ADD CONSTRAINT `fk_state_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
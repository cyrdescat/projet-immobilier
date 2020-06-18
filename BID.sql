-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  jeu. 18 juin 2020 à 22:32
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `testluis`
--

-- --------------------------------------------------------

--
-- Structure de la table `agence`
--

DROP TABLE IF EXISTS `agence`;
CREATE TABLE IF NOT EXISTS `agence` (
  `id_agence` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `adress` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `postal_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `contact` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_city` int(11) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  PRIMARY KEY (`id_agence`),
  KEY `AGENCE_CITY_FK` (`id_city`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `agence`
--

INSERT INTO `agence` (`id_agence`, `name`, `adress`, `postal_code`, `phone`, `contact`, `id_city`, `longitude`, `latitude`) VALUES
(1, 'Agende Nassau', '24 Pine Street', '2JJ+C80', '+1 242-361-3699', 'Jim Carrey', 1, '25.031259', '-77.399192'),
(2, 'Agende Freeport', '10 Balao Road', 'G9Q3+P5', '+1 242-374-6601', 'Elton John', 2, '26.532556', '-78.642292'),
(3, 'Agende Marsh Harbour', '26 S.C.Bootle Hwy', 'GWJM+XM', '+1 242-577-7373', 'Elvis Presley', 3, '26.546885', '-77.090167'),
(7, 'Agence Nicholls Town', '70 Swamp Street', '4XVW+4J', '+1 142-361-9199', 'Phil Collins', 1, '25.026637', '-77.515457'),
(8, 'Agence Freeport Sunrire', '176 Sunrise Hwy', 'G9J4+X5', '+1 102-361-9100', 'Fabien', 2, '26.637171', '-78.352546'),
(9, 'Agence Freeport Midshipman', '2 Midshipman Rd', 'G9GF+2J', '+1 102-301-3638', 'David Wild', 2, '26.652571', ' -77.943361'),
(10, 'Agence Marsh Harbour Abaco', '10 Great Abaco Hwy', 'A9GF+2J', '+1 178-301-3638', 'Pierre Cardin', 3, '26.349613', '-77.101426'),
(11, 'Agence Great Abaco', '1245 South Abaco', '6R63+HP', '+1 242-361-3699', 'Anne Belfort', 9, '26.211488', '-77.195641');

-- --------------------------------------------------------

--
-- Structure de la table `city`
--

DROP TABLE IF EXISTS `city`;
CREATE TABLE IF NOT EXISTS `city` (
  `id_city` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id_city`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `city`
--

INSERT INTO `city` (`id_city`, `name`) VALUES
(1, 'Nassau'),
(2, 'Freeport'),
(3, 'Marsh Harbour'),
(4, 'Dunmore Town'),
(9, 'Great Abaco');

-- --------------------------------------------------------

--
-- Structure de la table `picture`
--

DROP TABLE IF EXISTS `picture`;
CREATE TABLE IF NOT EXISTS `picture` (
  `id_picture` int(11) NOT NULL AUTO_INCREMENT,
  `picture` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_property` int(11) NOT NULL,
  `title_picture` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `alt` varchar(255) NOT NULL,
  `front` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_picture`),
  KEY `PICTURE_PROPERTY_FK` (`id_property`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `picture`
--

INSERT INTO `picture` (`id_picture`, `picture`, `id_property`, `title_picture`, `alt`, `front`) VALUES
(1, '/assets/images/metier-luxe1.jpg', 1, 'Metier  Luxe', 'Metier  Luxe', 1),
(2, '/assets/images/villa-1.jpeg', 2, 'Villa 1', 'Villa 1', 1),
(3, '/assets/images/villa-2.jpeg', 3, 'Villa 2', 'Villa 2', 1),
(4, '/assets/images/villa-3.jpg', 7, 'Villa Nassau Bahamas', 'alt4', 1),
(9, '/assets/images/chambre-1.jpg', 1, 'Chambre 1', 'Chambre 1', 0),
(10, '/assets/images/exterior-1.jpg', 1, 'Exterior 1', 'Exterior 1', 0),
(11, '/assets/images/chambre-2.jpg', 2, 'Chambre 2', 'Chambre 2', 0),
(12, '/assets/images/chambre-2.jpg', 2, 'Chambre 1', 'Chambre 1', 0),
(13, '/assets/images/chambre-1.jpg', 3, 'Chambre 1', 'Chambre 1', 0),
(14, '/assets/images/kitchen-1.jpg', 3, 'Cuisine', 'Cuisine', 0),
(15, '/assets/images/kitchen-2.jpg', 7, 'Cuisine', 'Cuisine', 0),
(16, '/assets/images/living-room-1.jpg', 7, 'Salon', 'Salon', 0),
(17, '/assets/images/villa-4.jpg', 8, 'Paradise Island, New Providence District.', 'Paradise Island, New Providence District.', 1),
(18, '/assets/images/terrace-1.jpg', 8, 'Terrace', 'Terrace', 0),
(19, '/assets/images/living-room-2.jpg', 8, 'Salon', 'Salon', 0),
(20, '/assets/images/maison-1.jpg', 9, 'Maison', 'Maison', 1),
(21, '/assets/images/kitchen-1.jpg', 9, 'Cuisine', 'Cuisine', 0),
(22, '/assets/images/living-room-4.jpg', 9, 'Salon', 'Salon', 0),
(23, '/assets/images/maison-2.jpg', 10, 'Maison', 'Maison', 1),
(24, '/assets/images/room-11.jpg', 10, 'Chambre 1', 'Chambre 1', 0),
(25, '/assets/images/kitchen-2.jpg', 11, 'Cuisine', 'Cuisine', 0),
(26, '/assets/images/appart-1.jpg', 11, 'Appartament', 'Appartament', 1),
(27, '/assets/images/plan-1.jpg', 11, 'Plan appartament', 'Plan appartament', 0),
(28, '/assets/images/salle-bains-1.jpg', 11, 'Salle Bains', 'Salle Bains', 0),
(29, '/assets/images/appart-2.jpg', 12, 'Appartament', 'Appartament', 1),
(30, '/assets/images/living-room-6.jpg', 12, 'Salon', 'Salon', 0),
(31, '/assets/images/piscine-1.jpg', 12, 'Piscine', 'Piscine', 0),
(32, '/assets/images/maison-3.jpg', 13, 'Maison', 'Maison', 1),
(33, '/assets/images/living-room-7.jpg', 13, 'Salon', 'Salon', 0),
(34, '/assets/images/kitchen-2.jpg', 13, 'Cuisine', 'Cuisine', 0),
(35, '/assets/images/villa-6.jpg', 14, 'Villa', 'Villa', 1),
(36, '/assets/images/living-room-8.jpg', 14, 'Salon', 'Salon', 0),
(37, '/assets/images/room-11.jpg', 14, 'Chambre', 'Chambre', 0),
(38, '/assets/images/villa-7.jpg', 15, 'Villa ', 'Villa', 1),
(39, '/assets/images/living-room-8.jpg', 15, 'Salon ', 'Salon', 0),
(40, '/assets/images/chambre-2.jpg', 15, 'Chambre', 'Chambre', 0);

-- --------------------------------------------------------

--
-- Structure de la table `property`
--

DROP TABLE IF EXISTS `property`;
CREATE TABLE IF NOT EXISTS `property` (
  `id_property` int(11) NOT NULL AUTO_INCREMENT,
  `surface` int(11) NOT NULL,
  `room` int(11) NOT NULL,
  `price` decimal(15,3) NOT NULL,
  `adress` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `postal_code` varchar(55) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `title_property` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_city` int(11) NOT NULL,
  `id_agence` int(11) NOT NULL,
  `id_property_type` int(11) NOT NULL,
  PRIMARY KEY (`id_property`),
  KEY `PROPERTY_CITY_FK` (`id_city`),
  KEY `PROPERTY_AGENCE0_FK` (`id_agence`),
  KEY `PROPERTY_PROPERTY_TYPE1_FK` (`id_property_type`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `property`
--

INSERT INTO `property` (`id_property`, `surface`, `room`, `price`, `adress`, `postal_code`, `title_property`, `description`, `created`, `id_city`, `id_agence`, `id_property_type`) VALUES
(1, 300, 5, '1500000.000', '24 Pine Street', '2JJ+C80', 'Appartement de luxe', 'Appartement de luxe, 300 m2, 5 chambres', '2020-05-15 08:00:36', 1, 1, 3),
(2, 500, 7, '13500000.000', '10 Balao Road', 'G9Q3+P5', 'Villa de luxe', 'Villa de luxe, 500 m2, 10 chambres', '2020-01-06 09:00:36', 2, 2, 2),
(3, 150, 2, '12000000.000', '26 S.C.Bootle Hwy', 'GWJM+XM', 'Loft de luxe', 'Loft de luxe, 150 m2, 2 chambres', '2020-04-02 08:00:36', 3, 3, 4),
(7, 789, 6, '17500000.000', '2 Pine Street', '2JJ+C80', 'Maison de prestige de 789 m2 en vente The Bahamas.', 'Maison surélevée balinaise surélevée avec 100 pieds de front de mer et un quai en eau profonde supplémentaire de 100 pieds dans le canal de l\'autre côté de la rue, cette maison a le meilleur des deux mondes; façade océanique et façade canal. La maison Bay Creek est pleine de charme insulaire, il y a amplement d\'espace pour les invités avec 6 chambres spacieuses et 7 salles de bains. La grande chambre dispose d\'un salon et salle à manger ouvert avec des fenêtres cintrées, des portes coulissantes en teck et des plafonds cathédrale en teck avec un sol en carrelage espagnol. Il y a un niveau mezzanine utilisé comme étude. La vie en plein air et de belles vues peuvent être appréciées en dînant en plein air sous le patio couvert, le gazebo au bord de la piscine ou le gazebo au bord de l\'eau ou vous détendre dans la piscine à débordement chauffée. La suite principale dispose d\'une terrasse privée, de plafonds voûtés et d\'une grande salle de bains carrelée en mosaïque avec douche à effet pluie séparée. Des allées couvertes de lierre vous mènent à l\'appartement 1 chambre avec kitchenette et terrasse privée avec jacuzzi extérieur.', '2020-02-18 10:24:22', 1, 1, 1),
(8, 1602, 10, '13265700.000', '102 Bayview Lane', '3MJQ+27', 'Maison de luxe de 1602 m2 en vente Paradise Island, The Bahamas, Paradise Island, New Providence District.', 'Situé dans la communauté fermée exclusive d\'Ocean Club Estates sur la bien nommée Paradise Island, Sea Level est une résidence impeccablement construite et entretenue sur un peu moins d\'un acre de front de mer sur le pittoresque port de Nassau. Cette résidence spectaculaire est offerte à seulement 14 900 000 $, bien en deçà de la valeur estimative de 20 000 000 $. Le niveau de la mer est une maison de six chambres et dix salles de bain mesurant 11 600 pieds carrés avec un total de 17 250 couverts et une vue sur le paradis de chaque endroit. Hautement conçu et bien conçu, cette propriété de deux étages offre des fonctionnalités de maison intelligente dans un cadre confortable et luxueux. ', '2020-06-18 14:49:58', 1, 1, 1),
(9, 900, 6, '8450000.000', '186 Eastern Rd', '3M7X+63', 'Maison de 6 pièces de luxe en vente The Bahamas, Nassau, New Providence District', 'Cette maison contemporaine exquise couvrant un total de 8869 pieds carrés est située sur un terrain enviable de 13 063 pieds carrés dans la communauté de renommée mondiale d\'Albany, dans le sud de New Providence, aux Bahamas. La maison sera terminée à la fin de 2020 et dispose d\'un total de 6 chambres, 6 salles de bain complètes et 3 demi-bains.', '2020-06-18 15:17:30', 1, 1, 9),
(10, 80, 2, '1424300.000', 'Great Abaco Hwy', '6R63+HP', 'Maison de luxe de 80 m2 en vente The Bahamas, Crossing Rocks.', 'Just under 1,000 square feet of perfect space (indoor & outdoors), Post House Cottage is nestled between the Coppice (broadleaf tropical forest) and the Bay Street waterfront at Schooner Bay Village, South Abaco. This 2 bedroom 2 en suite bath petite cottage has a uniquely styled porched living room that opens out to an expanded closed-in glass & sun-lit back porch leading directly to the Coppice walking trails. ', '2020-06-18 15:32:26', 3, 10, 9),
(11, 170, 4, '2361400.000', '67 Bay St', '3MH7+3R', 'Prestigieux appartement de rapport en vente à Nassau.', 'Le luxe à son meilleur absolu, une vue à couper le souffle sur les eaux cristallines des Bahamas est assis sur les plages immaculées de Paradise Island Bahamas. The Reef est un condo / hôtel de luxe de grande hauteur situé à l\'Atlantis Resort and Casino. Profitez de cette opportunité de propriété incroyable avec ce luxueux condominium de 2 chambres à coucher, 3 salles de bain avec vue sur l\'océan.', '2010-02-18 20:32:26', 1, 1, 3),
(12, 277, 7, '5305300.000', '677 Midshipman Rd', 'G9PW+H3', 'Prestigieux appartament de rapport en vente à Cable Beach.', 'Sur le sable blanc de Cable Beach à Nassau, la nouvelle ère du glamour bahamien est arrivée. Baha Mar est la seule destination résidentielle des Caraïbes dotée de résidences clés en main impeccables de deux marques hôtelières réputées: Rosewood Hotels & Resorts et SLS Hotels. Ces résidences sont entièrement intégrées dans les 1 000 acres, le complexe résidentiel et de style de vie le plus spectaculaire des Caraïbes.', '2020-06-18 19:49:11', 2, 9, 3),
(13, 642, 12, '12470300.000', 'Queen Hwy', 'F76X+M2', 'Maison de luxe de 642 m2 Yamacraw Beach Estate.', 'Située à l\'extrémité est de l\'île, dans l\'exclusive résidence de Port New Providence, cette superbe maison au bord d\'un canal est une offre de rêve pour une famille qui aime passer du temps sur l\'eau. Cette propriété idyllique de 141,67 mètres carrés de façade sur un canal dispose d’un quai pour bateaux pouvant accueillir un navire jusqu’à 80 pieds, avec un ascenseur à bateaux pouvant supporter jusqu’à 16 000 livres. Offrant cinq chambres à coucher et quatre salles de bain et demi, la maison est décorée dans un style alliant harmonieusement modernité et charme colonial.', '2020-06-18 20:00:12', 4, 10, 2),
(14, 516, 6, '19604000.000', '67 W Bay St', '3G66+WJ', 'Maison de luxe de 516 m2 en vente.', 'Time to go est situé dans le complexe exclusif Treasure Cay Resort, sur le prestigieux Ocean Boulevard. Situé sur environ 2,80 acres de jardins paysagers luxuriants tropicaux, cette maison principale en bord de mer se compose de 5,5 chambres, 5,5 salles de bains ainsi que d\'un garage détaché pour trois véhicules avec une chambre d\'hôtes 1 salle de bain et bénéficie d\'une façade exceptionnelle de 268 pieds composée de trois parcelles sur la plage immaculée de Treasure Cay connue pour son sable blanc et ses superbes eaux turquoises. ', '2020-06-18 20:14:35', 4, 10, 2),
(15, 520, 5, '11500000.000', '145 Tropic Road', '3G47+G3', 'PMaison de luxe de 520 m2 en vente The Bahamas, Old Fort Bay.', 'Dotée d\'une maison principale et d\'une maison d\'hôtes, cette résidence contemporaine magnifiquement aménagée est située sur un terrain sans issue sur l\'île Fincastle. Ce terrain de 29 000 pieds carrés offre 381 pieds de façade de canal avec mur de canal en béton coulé. Entourée d\'un paysage tropical luxuriant, cette résidence offre une intimité totale au sein de la communauté fermée exclusive d\'Old Fort Bay. La résidence principale de plain-pied de 5 600 pi2 à aire ouverte est lumineuse et aérée.', '2020-06-18 20:28:25', 3, 10, 2);

-- --------------------------------------------------------

--
-- Structure de la table `property_type`
--

DROP TABLE IF EXISTS `property_type`;
CREATE TABLE IF NOT EXISTS `property_type` (
  `id_property_type` int(11) NOT NULL AUTO_INCREMENT,
  `title_property_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id_property_type`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `property_type`
--

INSERT INTO `property_type` (`id_property_type`, `title_property_type`) VALUES
(1, 'Propriété'),
(2, 'Villa'),
(3, 'Appartement'),
(4, 'Loft'),
(9, 'Maison');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `agence`
--
ALTER TABLE `agence`
  ADD CONSTRAINT `AGENCE_CITY_FK` FOREIGN KEY (`id_city`) REFERENCES `city` (`id_city`);

--
-- Contraintes pour la table `picture`
--
ALTER TABLE `picture`
  ADD CONSTRAINT `PICTURE_PROPERTY_FK` FOREIGN KEY (`id_property`) REFERENCES `property` (`id_property`);

--
-- Contraintes pour la table `property`
--
ALTER TABLE `property`
  ADD CONSTRAINT `PROPERTY_AGENCE0_FK` FOREIGN KEY (`id_agence`) REFERENCES `agence` (`id_agence`),
  ADD CONSTRAINT `PROPERTY_CITY_FK` FOREIGN KEY (`id_city`) REFERENCES `city` (`id_city`),
  ADD CONSTRAINT `PROPERTY_PROPERTY_TYPE1_FK` FOREIGN KEY (`id_property_type`) REFERENCES `property_type` (`id_property_type`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

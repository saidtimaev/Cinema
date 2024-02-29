-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour cinemasaidtimaev
CREATE DATABASE IF NOT EXISTS `cinemasaidtimaev` /*!40100 DEFAULT CHARACTER SET latin1 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `cinemasaidtimaev`;

-- Listage de la structure de table cinemasaidtimaev. acteur
CREATE TABLE IF NOT EXISTS `acteur` (
  `id_acteur` int NOT NULL AUTO_INCREMENT,
  `id_personne` int NOT NULL,
  PRIMARY KEY (`id_acteur`),
  UNIQUE KEY `id_personne` (`id_personne`),
  CONSTRAINT `acteur_ibfk_1` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinemasaidtimaev.acteur : ~6 rows (environ)
INSERT INTO `acteur` (`id_acteur`, `id_personne`) VALUES
	(1, 1),
	(2, 2),
	(3, 3),
	(4, 4),
	(5, 5),
	(7, 6);

-- Listage de la structure de table cinemasaidtimaev. casting_film
CREATE TABLE IF NOT EXISTS `casting_film` (
  `id_film` int NOT NULL,
  `id_role` int NOT NULL,
  `id_acteur` int NOT NULL,
  PRIMARY KEY (`id_film`,`id_role`,`id_acteur`),
  KEY `id_role` (`id_role`),
  KEY `id_acteur` (`id_acteur`),
  CONSTRAINT `casting_film_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `casting_film_ibfk_2` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`),
  CONSTRAINT `casting_film_ibfk_3` FOREIGN KEY (`id_acteur`) REFERENCES `acteur` (`id_acteur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table cinemasaidtimaev.casting_film : ~4 rows (environ)
INSERT INTO `casting_film` (`id_film`, `id_role`, `id_acteur`) VALUES
	(1, 1, 2),
	(1, 2, 3),
	(1, 3, 7),
	(1, 5, 5);

-- Listage de la structure de table cinemasaidtimaev. film
CREATE TABLE IF NOT EXISTS `film` (
  `id_film` int NOT NULL AUTO_INCREMENT,
  `film_titre` varchar(50) NOT NULL,
  `film_duree` int DEFAULT NULL,
  `film_synopsis` text,
  `film_date_sortie` date DEFAULT NULL,
  `film_note` varchar(50) DEFAULT NULL,
  `film_affiche` varchar(255) DEFAULT NULL,
  `id_realisateur` int NOT NULL,
  PRIMARY KEY (`id_film`),
  KEY `id_realisateur` (`id_realisateur`),
  CONSTRAINT `film_ibfk_1` FOREIGN KEY (`id_realisateur`) REFERENCES `realisateur` (`id_realisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinemasaidtimaev.film : ~1 rows (environ)
INSERT INTO `film` (`id_film`, `film_titre`, `film_duree`, `film_synopsis`, `film_date_sortie`, `film_note`, `film_affiche`, `id_realisateur`) VALUES
	(1, 'Blade 1', 120, 'Blade Eric n\'est ni un homme ni un vampire, mais un hybride du Bien et du Mal, et ce depuis le jour de sa naissance, où sa mère fut mordue et y laissa la vie. Immortel, Blade a conservé la force des vampires, tout en éliminant leurs faiblesses. Avec l\'aide de son ami Abraham Whistler, il tente, depuis longtemps déjà, de mettre la main sur celui qui a causé la perte de sa mère.', '1998-11-18', '3', 'lien affiche blade', 1);

-- Listage de la structure de table cinemasaidtimaev. genre
CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int NOT NULL AUTO_INCREMENT,
  `genre_libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinemasaidtimaev.genre : ~0 rows (environ)
INSERT INTO `genre` (`id_genre`, `genre_libelle`) VALUES
	(1, 'Horreur'),
	(2, 'Action');

-- Listage de la structure de table cinemasaidtimaev. genre_film
CREATE TABLE IF NOT EXISTS `genre_film` (
  `id_film` int NOT NULL,
  `id_genre` int NOT NULL,
  PRIMARY KEY (`id_film`,`id_genre`),
  KEY `id_genre` (`id_genre`),
  CONSTRAINT `genre_film_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `genre_film_ibfk_2` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table cinemasaidtimaev.genre_film : ~0 rows (environ)
INSERT INTO `genre_film` (`id_film`, `id_genre`) VALUES
	(1, 1),
	(1, 2);

-- Listage de la structure de table cinemasaidtimaev. personne
CREATE TABLE IF NOT EXISTS `personne` (
  `id_personne` int NOT NULL AUTO_INCREMENT,
  `personne_nom` varchar(50) NOT NULL,
  `personne_prenom` varchar(50) NOT NULL,
  `personne_sexe` varchar(50) DEFAULT NULL,
  `personne_date_naissance` date DEFAULT NULL,
  PRIMARY KEY (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinemasaidtimaev.personne : ~6 rows (environ)
INSERT INTO `personne` (`id_personne`, `personne_nom`, `personne_prenom`, `personne_sexe`, `personne_date_naissance`) VALUES
	(1, 'Norrington', 'Stephen', 'M', '1964-02-01'),
	(2, 'Snipes', 'Wesley', 'M', '1962-07-31'),
	(3, 'Dorff', 'Stephen', 'M', '1973-07-29'),
	(4, 'Logue', 'Donal', 'M', '1966-02-27'),
	(5, 'Lathan', 'Sanaa', 'F', '1971-09-17'),
	(6, 'Kristofferson', 'Kris', 'M', '1936-06-22');

-- Listage de la structure de table cinemasaidtimaev. realisateur
CREATE TABLE IF NOT EXISTS `realisateur` (
  `id_realisateur` int NOT NULL AUTO_INCREMENT,
  `id_personne` int NOT NULL,
  PRIMARY KEY (`id_realisateur`),
  UNIQUE KEY `id_personne` (`id_personne`),
  CONSTRAINT `realisateur_ibfk_1` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinemasaidtimaev.realisateur : ~1 rows (environ)
INSERT INTO `realisateur` (`id_realisateur`, `id_personne`) VALUES
	(1, 1);

-- Listage de la structure de table cinemasaidtimaev. role
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int NOT NULL AUTO_INCREMENT,
  `role_nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinemasaidtimaev.role : ~0 rows (environ)
INSERT INTO `role` (`id_role`, `role_nom`) VALUES
	(1, 'Blade'),
	(2, 'Deacon Frost'),
	(3, 'Abraham Whistler'),
	(4, 'Quinn'),
	(5, 'Vanessa Brooks');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `rentmovies` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `rentmovies`;

--
-- Structure de la table `movies`
--

DROP TABLE IF EXISTS `movies`;
CREATE TABLE IF NOT EXISTS `movies` (
    `movie_id` INT AUTO_INCREMENT,
    `movie_name` VARCHAR(255) NOT NULL,
    `movie_title` VARCHAR(255) NOT NULL,
    `movie_image` VARCHAR(1000),
    `movie_summary` TEXT,
    `movie_link` VARCHAR(1000),
    `movie_artist` VARCHAR(255),
    `movie_category` VARCHAR(255),
    `movie_date` DATE,
    PRIMARY KEY (`movie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
    `user_id` INT AUTO_INCREMENT,
    `user_name` VARCHAR(255) NOT NULL,
    `user_email` VARCHAR(255) NOT NULL,
    `user_password` VARCHAR(1000) NOT NULL,
    `user_permission` TINYINT NOT NULL,
    PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Σύστημα: localhost
-- Χρόνος δημιουργίας: 09 Ιούλ 2018, στις 09:21 AM
-- Έκδοση Διακομιστή: 5.1.41
-- Έκδοση PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Βάση: `fifagenerator`
--

-- --------------------------------------------------------

--
-- Δομή Πίνακα για τον Πίνακα `head_to_head`
--

CREATE TABLE IF NOT EXISTS `head_to_head` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player1_name` varchar(50) NOT NULL,
  `player2_name` varchar(50) NOT NULL,
  `matches_played` int(11) NOT NULL DEFAULT '0',
  `player1_wins` int(11) NOT NULL DEFAULT '0',
  `draws` int(11) NOT NULL DEFAULT '0',
  `player2_wins` int(11) NOT NULL DEFAULT '0',
  `player1_goals` int(11) NOT NULL DEFAULT '0',
  `player2_goals` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`player1_name`,`player2_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- 'Αδειασμα δεδομένων του πίνακα `head_to_head`
--

INSERT INTO `head_to_head` (`id`, `player1_name`, `player2_name`, `matches_played`, `player1_wins`, `draws`, `player2_wins`, `player1_goals`, `player2_goals`) VALUES
(2, 'Gerakos', 'Makoman', 10, 3, 1, 6, 17, 33),
(4, 'Gerakos', 'Kemedor', 8, 1, 3, 4, 10, 20),
(5, 'Makoman', 'Tsori', 9, 5, 0, 4, 18, 15),
(6, 'Kemedor', 'Tsori', 8, 5, 0, 3, 11, 6),
(7, 'Kemedor', 'Makoman', 9, 1, 4, 4, 13, 18),
(8, 'Gerakos', 'Tsori', 7, 4, 1, 2, 16, 12),
(9, 'Louis', 'Prefionis', 2, 0, 1, 1, 1, 5),
(10, 'David', 'Gerakos', 2, 0, 1, 1, 2, 3),
(11, 'Giannis M.', 'Prefionis', 2, 0, 1, 1, 0, 2),
(12, 'Giannis M.', 'Louis', 2, 1, 0, 1, 3, 5),
(13, 'David', 'Makoman', 3, 0, 0, 3, 1, 6),
(14, 'David', 'Tsori', 3, 3, 0, 0, 5, 2),
(15, 'Giannis M.', 'Rambo', 2, 1, 0, 1, 2, 2),
(16, 'Prefionis', 'Rambo', 3, 2, 0, 1, 5, 1),
(17, 'David', 'Kemedor', 2, 0, 0, 2, 1, 7),
(18, 'Louis', 'Rambo', 2, 2, 0, 0, 3, 1),
(19, 'Kemedor', 'Rambo', 3, 3, 0, 0, 15, 0),
(20, 'Giannis M.', 'Makoman', 2, 0, 0, 2, 2, 6),
(21, 'Gerakos', 'Louis', 2, 1, 0, 1, 4, 1),
(22, 'Prefionis', 'Tsori', 2, 1, 1, 0, 2, 1),
(23, 'Makoman', 'Prefionis', 2, 1, 0, 1, 5, 4),
(24, 'Gerakos', 'Rambo', 1, 1, 0, 0, 4, 0),
(25, 'Erato', 'Makoman', 1, 0, 0, 1, 1, 3),
(26, 'David', 'Erato', 1, 1, 0, 0, 4, 0),
(27, 'Erato', 'Tsori', 1, 0, 0, 1, 1, 2),
(28, 'Gerakos', 'Prefionis', 1, 1, 0, 0, 4, 0),
(29, 'David', 'Prefionis', 1, 1, 0, 0, 1, 0),
(30, 'Makoman', 'Rambo', 1, 1, 0, 0, 3, 0),
(31, 'Erato', 'Gerakos', 1, 0, 0, 1, 0, 3);

-- --------------------------------------------------------

--
-- Δομή Πίνακα για τον Πίνακα `head_to_head_team`
--

CREATE TABLE IF NOT EXISTS `head_to_head_team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player1_name` varchar(50) NOT NULL,
  `team1_name` varchar(50) NOT NULL,
  `player2_name` varchar(50) NOT NULL,
  `team2_name` varchar(50) NOT NULL,
  `matches_played` int(11) NOT NULL DEFAULT '0',
  `player1_wins` int(11) NOT NULL DEFAULT '0',
  `draws` int(11) NOT NULL DEFAULT '0',
  `player2_wins` int(11) NOT NULL DEFAULT '0',
  `player1_goals` int(11) NOT NULL DEFAULT '0',
  `player2_goals` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`player1_name`,`team1_name`,`player2_name`,`team2_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

--
-- 'Αδειασμα δεδομένων του πίνακα `head_to_head_team`
--

INSERT INTO `head_to_head_team` (`id`, `player1_name`, `team1_name`, `player2_name`, `team2_name`, `matches_played`, `player1_wins`, `draws`, `player2_wins`, `player1_goals`, `player2_goals`) VALUES
(13, 'Makoman', 'Barcelona', 'Tsori', 'Arsenal', 2, 2, 0, 0, 6, 1),
(10, 'Gerakos', 'Egypt', 'Makoman', 'Mexico', 1, 0, 0, 1, 0, 6),
(9, 'Gerakos', 'Atletico Madrid', 'Makoman', 'Milan', 1, 1, 0, 0, 5, 4),
(12, 'Gerakos', 'Liverpool', 'Kemedor', 'Manchester United', 2, 0, 0, 2, 1, 9),
(7, 'Gerakos', 'Porto', 'Makoman', 'Napoli', 1, 1, 0, 0, 4, 3),
(14, 'Kemedor', 'Manchester United', 'Tsori', 'Arsenal', 6, 4, 0, 2, 8, 4),
(15, 'Gerakos', 'Liverpool', 'Makoman', 'Barcelona', 4, 1, 1, 2, 6, 12),
(16, 'Kemedor', 'Manchester United', 'Makoman', 'Barcelona', 3, 0, 1, 2, 2, 6),
(17, 'Gerakos', 'Liverpool', 'Tsori', 'Arsenal', 2, 1, 0, 1, 5, 3),
(18, 'Kemedor', 'Belgium', 'Tsori', 'England', 2, 1, 0, 1, 3, 2),
(19, 'Gerakos', 'Brazil', 'Makoman', 'France', 1, 0, 0, 1, 1, 2),
(20, 'Gerakos', 'Brazil', 'Tsori', 'England', 2, 2, 0, 0, 4, 2),
(21, 'Gerakos', 'Brazil', 'Kemedor', 'Belgium', 1, 1, 0, 0, 4, 2),
(22, 'Kemedor', 'Belgium', 'Makoman', 'France', 2, 0, 1, 1, 2, 3),
(23, 'Makoman', 'France', 'Tsori', 'England', 2, 0, 0, 2, 1, 5),
(24, 'Makoman', 'Japan', 'Tsori', 'Island', 1, 1, 0, 0, 3, 0),
(25, 'Kemedor', 'Manchester United', 'Makoman', 'Napoli', 4, 1, 2, 1, 9, 9),
(26, 'Makoman', 'Napoli', 'Tsori', 'Arsenal', 2, 0, 0, 2, 2, 6),
(27, 'Louis', 'Real Madrid', 'Prefionis', 'PSG', 2, 0, 1, 1, 1, 5),
(28, 'David', 'Bayern', 'Gerakos', 'Tottenham', 2, 0, 1, 1, 2, 3),
(29, 'Giannis M.', 'Manchester City', 'Prefionis', 'PSG', 2, 0, 1, 1, 0, 2),
(30, 'Gerakos', 'Tottenham', 'Tsori', 'Arsenal', 2, 1, 1, 0, 5, 4),
(31, 'Giannis M.', 'Manchester City', 'Louis', 'Real Madrid', 2, 1, 0, 1, 3, 5),
(32, 'David', 'Bayern', 'Makoman', 'Napoli', 2, 0, 0, 2, 1, 4),
(33, 'Gerakos', 'Tottenham', 'Kemedor', 'Manchester United', 4, 0, 2, 2, 3, 7),
(34, 'David', 'Bayern', 'Tsori', 'Arsenal', 2, 2, 0, 0, 3, 1),
(35, 'Giannis M.', 'Manchester City', 'Rambo', 'Chelsea', 2, 1, 0, 1, 2, 2),
(36, 'Gerakos', 'Tottenham', 'Makoman', 'Napoli', 2, 0, 0, 2, 1, 6),
(38, 'Prefionis', 'PSG', 'Rambo', 'Chelsea', 2, 1, 0, 1, 2, 1),
(39, 'David', 'Bayern', 'Kemedor', 'Manchester United', 2, 0, 0, 2, 1, 7),
(40, 'Louis', 'Read Madrid', 'Rambo', 'Chelsea', 2, 2, 0, 0, 3, 1),
(44, 'Gerakos', 'Tottenham', 'Louis', 'Real Madrid', 2, 1, 0, 1, 4, 1),
(42, 'Kemedor', 'Manchester United', 'Rambo', 'Chelsea', 2, 2, 0, 0, 11, 0),
(43, 'Giannis M.', 'Manchester City', 'Makoman', 'Napoli', 2, 0, 0, 2, 2, 6),
(45, 'Prefionis', 'PSG', 'Tsori', 'Arsenal', 2, 1, 1, 0, 2, 1),
(46, 'Makoman', 'Napoli', 'Prefionis', 'PSG', 2, 1, 0, 1, 5, 4),
(47, 'Gerakos', 'Spain', 'Rambo', 'Italy', 1, 1, 0, 0, 4, 0),
(48, 'David', 'France', 'Tsori', 'England', 1, 1, 0, 0, 2, 1),
(49, 'Erato', 'Argentina', 'Makoman', 'Brazil', 1, 0, 0, 1, 1, 3),
(50, 'Makoman', 'Brazil', 'Tsori', 'England', 2, 2, 0, 0, 6, 3),
(51, 'Gerakos', 'Spain', 'Kemedor', 'Belgium', 1, 0, 1, 0, 2, 2),
(52, 'David', 'France', 'Erato', 'Argentina', 1, 1, 0, 0, 4, 0),
(53, 'Prefionis', 'Germany', 'Rambo', 'Italy', 1, 1, 0, 0, 3, 0),
(54, 'Erato', 'Argentina', 'Tsori', 'England', 1, 0, 0, 1, 1, 2),
(55, 'Gerakos', 'Spain', 'Prefionis', 'Germany', 1, 1, 0, 0, 4, 0),
(56, 'Kemedor', 'Belgium', 'Rambo', 'Italy', 1, 1, 0, 0, 4, 0),
(57, 'David', 'France', 'Prefionis', 'Germany', 1, 1, 0, 0, 1, 0),
(58, 'Makoman', 'Brazil', 'Rambo', 'Italy', 1, 1, 0, 0, 3, 0),
(59, 'Erato', 'Argentina', 'Gerakos', 'Spain', 1, 0, 0, 1, 0, 3),
(60, 'David', 'France', 'Makoman', 'Brazil', 1, 0, 0, 1, 0, 2),
(61, 'Gerakos', 'Spain', 'Tsori', 'England', 1, 0, 0, 1, 2, 3);

-- --------------------------------------------------------

--
-- Δομή Πίνακα για τον Πίνακα `matches_history`
--

CREATE TABLE IF NOT EXISTS `matches_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player1_name` varchar(50) NOT NULL,
  `team1_name` varchar(50) NOT NULL,
  `player2_name` varchar(50) NOT NULL,
  `team2_name` varchar(50) NOT NULL,
  `player1_goals` int(11) NOT NULL,
  `player2_goals` int(11) NOT NULL,
  `overtime` tinyint(4) NOT NULL,
  `penalties` tinyint(4) NOT NULL,
  `penalties_score` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=95 ;

--
-- 'Αδειασμα δεδομένων του πίνακα `matches_history`
--

INSERT INTO `matches_history` (`id`, `player1_name`, `team1_name`, `player2_name`, `team2_name`, `player1_goals`, `player2_goals`, `overtime`, `penalties`, `penalties_score`) VALUES
(1, 'Gerakos', 'Porto', 'Makoman', 'Napoli', 4, 3, 1, 0, ''),
(2, 'Gerakos', 'Atletico Madrid', 'Makoman', 'Milan', 5, 4, 0, 0, ''),
(3, 'Gerakos', 'Egypt', 'Makoman', 'Mexico', 0, 6, 0, 0, ''),
(5, 'Gerakos', 'Liverpool', 'Kemedor', 'Manchester United', 0, 5, 0, 0, ''),
(6, 'Makoman', 'Barcelona', 'Tsori', 'Arsenal', 2, 1, 0, 0, ''),
(7, 'Kemedor', 'Manchester United', 'Tsori', 'Arsenal', 2, 0, 0, 0, ''),
(8, 'Gerakos', 'Liverpool', 'Makoman', 'Barcelona', 3, 3, 0, 0, ''),
(9, 'Gerakos', 'Liverpool', 'Makoman', 'Barcelona', 1, 4, 0, 0, ''),
(10, 'Makoman', 'Barcelona', 'Tsori', 'Arsenal', 4, 0, 0, 0, ''),
(11, 'Kemedor', 'Manchester United', 'Tsori', 'Arsenal', 0, 1, 0, 0, ''),
(12, 'Gerakos', 'Liverpool', 'Kemedor', 'Manchester United', 1, 4, 0, 0, ''),
(13, 'Kemedor', 'Manchester United', 'Makoman', 'Barchelona', 0, 3, 0, 0, ''),
(14, 'Kemedor', 'Manchester United', 'Makoman', 'Barchelona', 1, 1, 0, 0, ''),
(15, 'Gerakos', 'Liverpool', 'Tsori', 'Arsenal', 3, 0, 0, 0, ''),
(16, 'Gerakos', 'Liverpool', 'Tsori', 'Arsenal', 2, 3, 0, 0, ''),
(17, 'Gerakos', 'Liverpool', 'Makoman', 'Barcelona', 1, 0, 0, 0, ''),
(18, 'Gerakos', 'Liverpool', 'Makoman', 'Barcelona', 1, 5, 0, 0, ''),
(19, 'Kemedor', 'Manchester United', 'Tsori', 'Arsenal', 1, 0, 0, 0, ''),
(20, 'Kemedor', 'Manchester United', 'Tsori', 'Arsenal', 1, 2, 0, 0, ''),
(21, 'Kemedor', 'Manchester United', 'Makoman', 'Barcelona', 1, 2, 0, 0, ''),
(22, 'Kemedor', 'Belgium', 'Tsori', 'England', 2, 0, 0, 0, ''),
(23, 'Gerakos', 'Brazil', 'Makoman', 'France', 1, 2, 0, 0, ''),
(24, 'Gerakos', 'Brazil', 'Tsori', 'England', 2, 1, 0, 0, ''),
(25, 'Gerakos', 'Brazil', 'Kemedor', 'Belgium', 4, 2, 0, 0, ''),
(26, 'Kemedor', 'Belgium', 'Makoman', 'France', 0, 0, 0, 0, ''),
(27, 'Makoman', 'France', 'Tsori', 'England', 0, 3, 0, 0, ''),
(28, 'Gerakos', 'Brazil', 'Tsori', 'England', 2, 1, 0, 0, ''),
(29, 'Kemedor', 'Belgium', 'Makoman', 'France', 2, 3, 0, 0, ''),
(30, 'Makoman', 'France', 'Tsori', 'England', 1, 2, 0, 0, ''),
(31, 'Makoman', 'Japan', 'Tsori', 'Island', 3, 0, 0, 0, ''),
(32, 'Kemedor', 'Manchester United', 'Makoman', 'Napoli', 1, 2, 0, 0, ''),
(33, 'Kemedor', 'Manchester United', 'Tsori', 'Arsenal', 3, 1, 0, 0, ''),
(34, 'Makoman', 'Napoli', 'Tsori', 'Arsenal', 1, 3, 0, 0, ''),
(35, 'Kemedor', 'Manchester United', 'Makoman', 'Napoli', 3, 2, 0, 0, ''),
(36, 'Louis', 'Real Madrid', 'Prefionis', 'PSG', 0, 4, 0, 0, ''),
(37, 'David', 'Bayern', 'Gerakos', 'Tottenham', 0, 1, 0, 0, ''),
(38, 'Giannis M.', 'Manchester City', 'Prefionis', 'PSG', 0, 2, 0, 0, ''),
(39, 'Gerakos', 'Tottenham', 'Tsori', 'Arsenal', 2, 1, 0, 0, ''),
(40, 'Giannis M.', 'Manchester City', 'Louis', 'Real Madrid', 1, 4, 0, 0, ''),
(41, 'David', 'Bayern', 'Makoman', 'Napoli', 0, 2, 0, 0, ''),
(42, 'Louis', 'Real Madrid', 'Prefionis', 'PSG', 1, 1, 0, 0, ''),
(43, 'Gerakos', 'Tottenham', 'Kemedor', 'Manchester United', 2, 2, 0, 0, ''),
(44, 'Giannis M.', 'Manchester City', 'Prefionis', 'PSG', 0, 0, 0, 0, ''),
(45, 'David', 'Bayern', 'Tsori', 'Arsenal', 2, 1, 0, 0, ''),
(46, 'Giannis M.', 'Manchester City', 'Rambo', 'Chelsea', 2, 0, 0, 0, ''),
(47, 'Gerakos', 'Tottenham', 'Makoman', 'Napoli', 1, 3, 0, 0, ''),
(48, 'Giannis M.', 'Manchester City', 'Louis', 'Real Madrid', 2, 1, 0, 0, ''),
(49, 'Prefionis', 'PSG', 'Rambo', 'Chelsea', 0, 1, 0, 0, ''),
(50, 'David', 'Bayern', 'Kemedor', 'Manchester United', 0, 4, 0, 0, ''),
(51, 'Makoman', 'Napoli', 'Tsori', 'Arsenal', 1, 3, 0, 0, ''),
(52, 'Louis', 'Real Madrid', 'Rambo', 'Chelsea', 1, 0, 0, 0, ''),
(53, 'David', 'Bayern', 'Gerakos', 'Tottenham', 2, 2, 0, 0, ''),
(54, 'David', 'Bayern', 'Kemedor', 'Manchester United', 1, 3, 0, 0, ''),
(55, 'Prefionis', 'PSG', 'Rambo', 'Chelsea', 2, 0, 0, 0, ''),
(56, 'Giannis M.', 'Manchester City', 'Rambo', 'Chelsea', 0, 2, 0, 0, ''),
(57, 'Gerakos', 'Tottenham', 'Tsori', 'Arsenal', 3, 3, 0, 0, ''),
(58, 'Kemedor', 'Manchester United', 'Makoman', 'Napoli', 3, 3, 0, 0, ''),
(59, 'Louis', 'Real Madrid', 'Rambo', 'Chelsea', 2, 1, 0, 0, ''),
(60, 'David', 'Bayern', 'Tsori', 'Arsenal', 1, 0, 0, 0, ''),
(61, 'Kemedor', 'Manchester United', 'Tsori', 'Arsenal', 1, 0, 0, 0, ''),
(62, 'Gerakos', 'Tottenham', 'Makoman', 'Napoli', 0, 3, 0, 0, ''),
(63, 'Gerakos', 'Tottenham', 'Kemedor', 'Manchester United', 0, 3, 0, 0, ''),
(64, 'David', 'Bayern', 'Makoman', 'Napoli', 1, 2, 0, 0, ''),
(65, 'Kemedor', 'Manchester United', 'Rambo', 'Chelsea', 7, 0, 0, 0, ''),
(66, 'Kemedor', 'Manchester United', 'Rambo', 'Chelsea', 4, 0, 0, 0, ''),
(67, 'Giannis M.', 'Manchester City', 'Makoman', 'Napoli', 1, 4, 0, 0, ''),
(68, 'Giannis M.', 'Manchester City', 'Makoman', 'Napoli', 1, 2, 0, 0, ''),
(69, 'Gerakos', 'Tottenham', 'Louis', 'Real Madrid', 0, 1, 0, 0, ''),
(70, 'Prefionis', 'PSG', 'Tsori', 'Arsenal', 1, 0, 0, 0, ''),
(71, 'Gerakos', 'Tottenham', 'Louis', 'Real Madrid', 4, 0, 0, 0, ''),
(72, 'Prefionis', 'PSG', 'Tsori', 'Arsenal', 1, 1, 0, 0, ''),
(73, 'Makoman', 'Napoli', 'Prefionis', 'PSG', 2, 4, 0, 0, ''),
(74, 'Makoman', 'Napoli', 'Prefionis', 'PSG', 3, 0, 0, 0, ''),
(75, 'Gerakos', 'Tottenham', 'Kemedor', 'Manchester United', 1, 1, 0, 0, ''),
(76, 'Gerakos', 'Tottenham', 'Kemedor', 'Manchester United', 0, 1, 0, 0, ''),
(77, 'Kemedor', 'Manchester United', 'Makoman', 'Napoli', 2, 2, 0, 0, '2-4'),
(78, 'Gerakos', 'Spain', 'Rambo', 'Italy', 4, 0, 0, 0, ''),
(79, 'David', 'France', 'Tsori', 'England', 2, 1, 0, 0, ''),
(80, 'Erato', 'Argentina', 'Makoman', 'Brazil', 1, 3, 0, 0, ''),
(81, 'Makoman', 'Brazil', 'Tsori', 'England', 4, 2, 0, 0, ''),
(82, 'Gerakos', 'Spain', 'Kemedor', 'Belgium', 2, 2, 0, 0, ''),
(83, 'David', 'France', 'Erato', 'Argentina', 4, 0, 0, 0, ''),
(84, 'Prefionis', 'Germany', 'Rambo', 'Italy', 3, 0, 0, 0, ''),
(85, 'Erato', 'Argentina', 'Tsori', 'England', 1, 2, 0, 0, ''),
(86, 'Gerakos', 'Spain', 'Prefionis', 'Germany', 4, 0, 0, 0, ''),
(87, 'Kemedor', 'Belgium', 'Rambo', 'Italy', 4, 0, 0, 0, ''),
(88, 'Kemedor', 'Belgium', 'Tsori', 'England', 1, 2, 0, 0, ''),
(89, 'David', 'France', 'Prefionis', 'Germany', 1, 0, 0, 0, ''),
(90, 'Makoman', 'Brazil', 'Rambo', 'Italy', 3, 0, 0, 0, ''),
(91, 'Erato', 'Argentina', 'Gerakos', 'Spain', 0, 3, 0, 0, ''),
(92, 'David', 'France', 'Makoman', 'Brazil', 0, 2, 0, 0, ''),
(93, 'Gerakos', 'Spain', 'Tsori', 'England', 2, 3, 0, 0, ''),
(94, 'Makoman', 'Brazil', 'Tsori', 'England', 2, 1, 0, 0, '');

-- --------------------------------------------------------

--
-- Δομή Πίνακα για τον Πίνακα `players`
--

CREATE TABLE IF NOT EXISTS `players` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `matches_played` int(11) NOT NULL DEFAULT '0',
  `wins` int(11) NOT NULL DEFAULT '0',
  `draws` int(11) NOT NULL DEFAULT '0',
  `loses` int(11) NOT NULL DEFAULT '0',
  `goals_scored` int(11) NOT NULL DEFAULT '0',
  `goals_against` int(11) NOT NULL DEFAULT '0',
  `knockouts_played` int(11) NOT NULL DEFAULT '0',
  `knockouts_won` int(11) NOT NULL DEFAULT '0',
  `knockouts_finalist` int(11) NOT NULL DEFAULT '0',
  `league_and_knockout_played` int(11) NOT NULL DEFAULT '0',
  `league_and_knockout_won` int(11) NOT NULL DEFAULT '0',
  `league_and_knockout_finalist` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- 'Αδειασμα δεδομένων του πίνακα `players`
--

INSERT INTO `players` (`id`, `name`, `matches_played`, `wins`, `draws`, `loses`, `goals_scored`, `goals_against`, `knockouts_played`, `knockouts_won`, `knockouts_finalist`, `league_and_knockout_played`, `league_and_knockout_won`, `league_and_knockout_finalist`) VALUES
(1, 'Kemedor', 30, 15, 7, 8, 66, 35, 0, 0, 0, 4, 0, 2),
(13, 'Makoman', 37, 23, 5, 9, 92, 53, 0, 0, 0, 4, 3, 1),
(12, 'Gerakos', 32, 13, 6, 13, 61, 68, 0, 0, 0, 4, 0, 0),
(15, 'Tsori', 30, 10, 2, 18, 38, 53, 0, 0, 0, 4, 1, 1),
(16, 'Prefionis', 13, 6, 3, 4, 18, 13, 0, 0, 0, 2, 0, 0),
(17, 'Louis', 8, 4, 1, 3, 10, 13, 0, 0, 0, 1, 0, 0),
(18, 'Giannis M.', 8, 2, 1, 5, 7, 15, 0, 0, 0, 1, 0, 0),
(19, 'David', 12, 5, 1, 6, 14, 18, 0, 0, 0, 2, 0, 0),
(20, 'Rambo', 12, 2, 0, 10, 4, 32, 0, 0, 0, 2, 0, 0),
(21, 'Erato', 4, 0, 0, 4, 2, 12, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Δομή Πίνακα για τον Πίνακα `team_player`
--

CREATE TABLE IF NOT EXISTS `team_player` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player_name` varchar(50) NOT NULL,
  `team_name` varchar(50) NOT NULL,
  `matches_played` int(11) NOT NULL DEFAULT '0',
  `wins` int(11) NOT NULL DEFAULT '0',
  `draws` int(11) NOT NULL DEFAULT '0',
  `loses` int(11) NOT NULL DEFAULT '0',
  `goals_scored` int(11) NOT NULL DEFAULT '0',
  `goals_against` int(11) NOT NULL DEFAULT '0',
  `knockouts_played` int(11) NOT NULL DEFAULT '0',
  `knockouts_won` int(11) NOT NULL DEFAULT '0',
  `knockouts_finalist` int(11) NOT NULL DEFAULT '0',
  `league_and_knockout_played` int(11) NOT NULL DEFAULT '0',
  `league_and_knockout_won` int(11) NOT NULL DEFAULT '0',
  `league_and_knockout_finalist` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`player_name`,`team_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- 'Αδειασμα δεδομένων του πίνακα `team_player`
--

INSERT INTO `team_player` (`id`, `player_name`, `team_name`, `matches_played`, `wins`, `draws`, `loses`, `goals_scored`, `goals_against`, `knockouts_played`, `knockouts_won`, `knockouts_finalist`, `league_and_knockout_played`, `league_and_knockout_won`, `league_and_knockout_finalist`) VALUES
(1, 'Kemedor', 'Manchester United', 23, 13, 5, 5, 53, 24, 0, 0, 0, 2, 0, 2),
(5, 'Gerakos', 'Porto', 1, 1, 0, 0, 4, 3, 0, 0, 0, 0, 0, 0),
(4, 'Makoman', 'Napoli', 15, 8, 2, 5, 35, 27, 0, 0, 0, 1, 1, 0),
(6, 'Gerakos', 'Atletico Madrid', 1, 1, 0, 0, 5, 4, 0, 0, 0, 0, 0, 0),
(7, 'Makoman', 'Milan', 1, 0, 0, 1, 4, 5, 0, 0, 0, 0, 0, 0),
(8, 'Gerakos', 'Egypt', 1, 0, 0, 1, 0, 6, 0, 0, 0, 0, 0, 0),
(9, 'Makoman', 'Mexico', 1, 1, 0, 0, 6, 0, 0, 0, 0, 0, 0, 0),
(16, 'Makoman', 'Barcelona', 9, 6, 2, 1, 24, 9, 0, 0, 0, 1, 1, 0),
(15, 'Gerakos', 'Liverpool', 8, 2, 1, 5, 12, 24, 0, 0, 0, 1, 0, 0),
(17, 'Tsori', 'Arsenal', 18, 5, 2, 11, 20, 31, 0, 0, 0, 2, 0, 0),
(18, 'Kemedor', 'Belgium', 7, 2, 2, 3, 13, 11, 0, 0, 0, 2, 0, 0),
(19, 'Tsori', 'England', 11, 5, 0, 6, 18, 19, 0, 0, 0, 2, 1, 1),
(20, 'Gerakos', 'Brazil', 4, 3, 0, 1, 9, 6, 0, 0, 0, 1, 0, 0),
(21, 'Makoman', 'France', 5, 2, 1, 2, 6, 8, 0, 0, 0, 1, 0, 1),
(22, 'Makoman', 'Japan', 1, 1, 0, 0, 3, 0, 0, 0, 0, 0, 0, 0),
(23, 'Tsori', 'Island', 1, 0, 0, 1, 0, 3, 0, 0, 0, 0, 0, 0),
(24, 'Louis', 'Real Madrid', 8, 4, 1, 3, 10, 13, 0, 0, 0, 1, 0, 0),
(25, 'Prefionis', 'PSG', 10, 5, 3, 2, 15, 8, 0, 0, 0, 1, 0, 0),
(26, 'David', 'Bayern', 8, 2, 1, 5, 7, 15, 0, 0, 0, 1, 0, 0),
(27, 'Gerakos', 'Tottenham', 12, 3, 4, 5, 16, 20, 0, 0, 0, 1, 0, 0),
(28, 'Giannis M.', 'Manchester City', 8, 2, 1, 5, 7, 15, 0, 0, 0, 1, 0, 0),
(29, 'Rambo', 'Chelsea', 8, 2, 0, 6, 4, 18, 0, 0, 0, 1, 0, 0),
(33, 'Rambo', 'Italy', 4, 0, 0, 4, 0, 14, 0, 0, 0, 1, 0, 0),
(32, 'Gerakos', 'Spain', 5, 3, 1, 1, 15, 5, 0, 0, 0, 1, 0, 0),
(34, 'David', 'France', 4, 3, 0, 1, 7, 3, 0, 0, 0, 1, 0, 0),
(35, 'Erato', 'Argentina', 4, 0, 0, 4, 2, 12, 0, 0, 0, 1, 0, 0),
(36, 'Makoman', 'Brazil', 5, 5, 0, 0, 14, 4, 0, 0, 0, 1, 1, 0),
(37, 'Prefionis', 'Germany', 3, 1, 0, 2, 3, 5, 0, 0, 0, 1, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

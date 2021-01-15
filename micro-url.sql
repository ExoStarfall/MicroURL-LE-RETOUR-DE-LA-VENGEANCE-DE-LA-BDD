-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 15, 2021 at 12:56 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `micro-url`
--

-- --------------------------------------------------------

--
-- Table structure for table `assoc_mc_url`
--

CREATE TABLE `assoc_mc_url` (
  `id` int(11) NOT NULL,
  `assoc_mc_id` int(11) NOT NULL,
  `assoc_url_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `assoc_mc_url`
--

INSERT INTO `assoc_mc_url` (`id`, `assoc_mc_id`, `assoc_url_id`) VALUES
(2, 2, 1),
(3, 8, 4);

-- --------------------------------------------------------

--
-- Table structure for table `mc`
--

CREATE TABLE `mc` (
  `mc_id` int(11) NOT NULL,
  `mc_motcle` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `mc`
--

INSERT INTO `mc` (`mc_id`, `mc_motcle`) VALUES
(2, 'BDSM'),
(3, 'Sheitan'),
(8, 'Piratage'),
(60, 'BDSM');

-- --------------------------------------------------------

--
-- Table structure for table `url`
--

CREATE TABLE `url` (
  `url_id` int(11) NOT NULL,
  `url_name` mediumtext COLLATE utf8mb4_bin NOT NULL,
  `url_shortcut` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `url_datetime` datetime NOT NULL,
  `url_desc` mediumtext COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `url`
--

INSERT INTO `url` (`url_id`, `url_name`, `url_shortcut`, `url_datetime`, `url_desc`) VALUES
(1, 'www.jsaispaskwa.com', 'petit.com', '2021-01-07 10:54:16', 'test '),
(4, ' https://www.zataz.com/total-energie-direct-obligee-de-stopper-un-jeu-en-ligne-suite-a-une-fuite-de-donnees/', 'ztz7', '2021-01-15 08:42:32', 'L\'entreprise Total Energie Direct avait lancé un jeu en ligne. Le concours a dû être stoppé. Il était possible d\'accéder aux données des autres joueurs.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assoc_mc_url`
--
ALTER TABLE `assoc_mc_url`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mc_id` (`assoc_mc_id`),
  ADD KEY `url_id` (`assoc_url_id`);

--
-- Indexes for table `mc`
--
ALTER TABLE `mc`
  ADD PRIMARY KEY (`mc_id`);

--
-- Indexes for table `url`
--
ALTER TABLE `url`
  ADD PRIMARY KEY (`url_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assoc_mc_url`
--
ALTER TABLE `assoc_mc_url`
  ADD CONSTRAINT `assoc_mc_url_ibfk_1` FOREIGN KEY (`assoc_mc_id`) REFERENCES `mc` (`mc_id`),
  ADD CONSTRAINT `assoc_mc_url_ibfk_2` FOREIGN KEY (`assoc_url_id`) REFERENCES `url` (`url_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

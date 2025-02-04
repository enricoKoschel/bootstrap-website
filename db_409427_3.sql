-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: partnerundpartner.lima-db.de:3306
-- Generation Time: Feb 04, 2025 at 08:04 PM
-- Server version: 8.0.36-28
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_409427_3`
--

-- --------------------------------------------------------

--
-- Table structure for table `abteilung`
--

CREATE TABLE `abteilung` (
  `Abteilungsbezeichnung` text NOT NULL,
  `Abteilungsnummer` int NOT NULL,
  `Personanummer-Abteilungsleiter` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `abteilung`
--

INSERT INTO `abteilung` (`Abteilungsbezeichnung`, `Abteilungsnummer`, `Personanummer-Abteilungsleiter`) VALUES
('Vertrieb', 1, 3),
('Geschäftsführung', 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `Artikelnummer` int NOT NULL,
  `Bezeichnung` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`Artikelnummer`, `Bezeichnung`) VALUES
(1001, 'Noten Don Giovanni'),
(1003, 'Mozart T-Shirt'),
(1012, 'CD: Phil Collins'),
(1077, 'Cats-Plakat'),
(1078, 'Opernführer'),
(1081, 'Zauberstock'),
(1101, 'Don Giovanni'),
(1102, 'Don Giovanni'),
(1103, 'Don Giovanni'),
(1104, 'Don Giovanni'),
(1105, 'Don Giovanni'),
(1201, 'Don Giovanni'),
(1202, 'Don Giovanni'),
(1203, 'Don Giovanni'),
(1204, 'Don Giovanni'),
(1205, 'Don Giovanni'),
(4101, 'Konzert von Phil Collins'),
(4102, 'Konzert von Phil Collins'),
(4103, 'Konzert von Phil Collins'),
(4104, 'Konzert von Phil Collins'),
(4105, 'Konzert von Phil Collins'),
(4106, 'Konzert von Phil Collins');

-- --------------------------------------------------------

--
-- Table structure for table `bestellposten`
--

CREATE TABLE `bestellposten` (
  `Bestellnummer` int NOT NULL,
  `Positionsnummer` int NOT NULL,
  `Artikelnummer` int NOT NULL,
  `Menge` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bestellposten`
--

INSERT INTO `bestellposten` (`Bestellnummer`, `Positionsnummer`, `Artikelnummer`, `Menge`) VALUES
(1, 1, 1101, 1),
(1, 1, 1102, 1),
(1, 1, 1103, 1),
(1, 2, 1001, 2),
(1, 3, 1003, 3),
(8, 1, 4101, 1),
(8, 2, 1012, 2);

-- --------------------------------------------------------

--
-- Table structure for table `bestellung`
--

CREATE TABLE `bestellung` (
  `Bestellnummer` int NOT NULL,
  `Datum` date NOT NULL,
  `Kundennummer` int NOT NULL,
  `Personalnummer` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bestellung`
--

INSERT INTO `bestellung` (`Bestellnummer`, `Datum`, `Kundennummer`, `Personalnummer`) VALUES
(1, '2002-01-26', 1, NULL),
(3, '2002-02-08', 3, NULL),
(8, '2001-12-21', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kind`
--

CREATE TABLE `kind` (
  `Kundennummer` varchar(10) NOT NULL,
  `Vorname` varchar(10) NOT NULL,
  `Geburtsdatum` date NOT NULL,
  `Geschlecht` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kind`
--

INSERT INTO `kind` (`Kundennummer`, `Vorname`, `Geburtsdatum`, `Geschlecht`) VALUES
('1', 'Katja', '1988-12-31', 'W'),
('1', 'Ursula', '1990-05-08', 'W'),
('1', 'Karl', '2001-05-21', 'M'),
('3', 'Ursula', '1992-08-19', 'W'),
('3', 'Enzo', '1990-05-12', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `kunde`
--

CREATE TABLE `kunde` (
  `Kundennummer` int UNSIGNED NOT NULL,
  `Name` varchar(10) NOT NULL,
  `Vorname` varchar(10) NOT NULL,
  `Geschlecht` varchar(2) NOT NULL,
  `Strasse` varchar(30) NOT NULL,
  `Strassennummer` int DEFAULT NULL,
  `Plz` int NOT NULL,
  `Geburtsdatum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kunde`
--

INSERT INTO `kunde` (`Kundennummer`, `Name`, `Vorname`, `Geschlecht`, `Strasse`, `Strassennummer`, `Plz`, `Geburtsdatum`) VALUES
(1, 'Bolte', 'Bertram', 'M', 'Busweg', 12, 44444, '1945-12-02'),
(2, 'Muster', 'Hans', 'M', 'Musterweg', 12, 22222, '1953-02-21'),
(3, 'Wiegerich', 'Frieda', 'W', 'Wanderstr.', NULL, 33333, '1963-08-18'),
(4, 'Carlson', 'Peter', 'M', 'Petristr.', 201, 44444, '1971-09-26');

-- --------------------------------------------------------

--
-- Table structure for table `mitarbeiter`
--

CREATE TABLE `mitarbeiter` (
  `Personalnummer` int NOT NULL,
  `Name` text NOT NULL,
  `Vorname` text NOT NULL,
  `Geschlecht` text NOT NULL,
  `Strasse` text NOT NULL,
  `Hausnummer` int NOT NULL,
  `Plz` int NOT NULL,
  `Abteilungsbezeichnung` text NOT NULL,
  `Personalnummervorgestzter` int NOT NULL,
  `Gehalt` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mitarbeiter`
--

INSERT INTO `mitarbeiter` (`Personalnummer`, `Name`, `Vorname`, `Geschlecht`, `Strasse`, `Hausnummer`, `Plz`, `Abteilungsbezeichnung`, `Personalnummervorgestzter`, `Gehalt`) VALUES
(3, 'Kart', 'Karen', 'W', 'Pantherstr.', 12, 22222, 'Vertrieb', 6, 3000),
(5, 'Klein', 'Karl', 'M', 'Minimalweg', 1, 22222, 'Vertrieb', 3, 2050),
(6, 'Kowalski', 'Karsten', 'M', 'Blankeneser Weg', 2, 22287, 'Geschäftsführung', 0, 4000);

-- --------------------------------------------------------

--
-- Table structure for table `ort`
--

CREATE TABLE `ort` (
  `Plz` int NOT NULL,
  `Ort` varchar(30) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

--
-- Dumping data for table `ort`
--

INSERT INTO `ort` (`Plz`, `Ort`) VALUES
(44444, 'Kohlescheidt'),
(22222, 'Karlstadt'),
(33333, 'Rettrich'),
(22287, 'Hamburg'),
(25746, 'Heide');

-- --------------------------------------------------------

--
-- Table structure for table `sitzplatz`
--

CREATE TABLE `sitzplatz` (
  `Artikelnummer` int NOT NULL,
  `Bereich` varchar(50) NOT NULL,
  `Reihe` int NOT NULL,
  `Sitz` int NOT NULL,
  `Preis` float NOT NULL,
  `Zustand` varchar(50) NOT NULL,
  `Vorstellungsnummer` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sitzplatz`
--

INSERT INTO `sitzplatz` (`Artikelnummer`, `Bereich`, `Reihe`, `Sitz`, `Preis`, `Zustand`, `Vorstellungsnummer`) VALUES
(1101, 'Parkett', 2, 8, 89, 'belegt', 11),
(1102, 'Parkett', 4, 11, 89, 'frei', 11),
(1103, '1. Rang', 1, 12, 120, 'frei', 11),
(1104, '2. Rang', 3, 2, 75, 'belegt', 12),
(1105, '3. Rang', 7, 1, 60, 'reserviert', 11),
(1201, 'Parkett', 2, 8, 89, 'belegt', 12),
(1202, 'Parkett', 4, 11, 89, 'frei', 12),
(1203, '1. Rang', 1, 12, 120, 'frei', 12),
(1204, '2. Rang', 3, 2, 75, 'belegt', 12),
(1205, '3. Rang', 7, 1, 60, 'reserviert', 12),
(4101, 'Parkett', 1, 1, 120, 'frei', 41),
(4102, 'Parkett', 1, 2, 120, 'frei', 41),
(4103, 'Parkett', 1, 3, 120, 'frei', 41),
(4104, 'Parkett', 11, 14, 60, 'frei', 41),
(4105, 'Parkett', 3, 21, 90, 'frei', 41),
(4106, 'Parkett', 8, 26, 85.99, 'frei', 41);

-- --------------------------------------------------------

--
-- Table structure for table `spielstaette`
--

CREATE TABLE `spielstaette` (
  `Haus` varchar(50) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `Strasse` varchar(30) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `Hausnummer` int NOT NULL,
  `Plz` int NOT NULL,
  `Beschreibung` varchar(100) CHARACTER SET latin1 COLLATE latin1_german1_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

--
-- Dumping data for table `spielstaette`
--

INSERT INTO `spielstaette` (`Haus`, `Strasse`, `Hausnummer`, `Plz`, `Beschreibung`) VALUES
('Deutsche Staatsoper', 'Opernstr.', 1, 22287, ''),
('Operettenahus', 'Bahndamm', 88, 22287, ''),
('Sokratesbühne', 'Muserweg', 81, 22222, ''),
('Nordseehalle', 'Nordfeldweg', 200, 25746, ''),
('Kongresshalle', 'Hahndamm', 21, 33333, '');

-- --------------------------------------------------------

--
-- Table structure for table `veranstaltung`
--

CREATE TABLE `veranstaltung` (
  `Veranstaltungsnummer` int NOT NULL,
  `Bezeichnung` varchar(50) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `Autor` varchar(50) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `Beschreibung` varchar(100) CHARACTER SET latin1 COLLATE latin1_german1_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

--
-- Dumping data for table `veranstaltung`
--

INSERT INTO `veranstaltung` (`Veranstaltungsnummer`, `Bezeichnung`, `Autor`, `Beschreibung`) VALUES
(1, 'Don Giovanni', 'Amadeus Mozart', ''),
(4, 'Phil Collins LIVE', 'Phil Collins', ''),
(3, 'Zauberlehrling', 'Amadeus Mozart', ''),
(8, 'Mutter Courage', 'Brecht', ''),
(7, 'Cats', 'Webber', '');

-- --------------------------------------------------------

--
-- Table structure for table `vorstellung`
--

CREATE TABLE `vorstellung` (
  `Vorstellungsnummer` int NOT NULL,
  `Datum` date NOT NULL,
  `Uhrzeit` time NOT NULL,
  `Veranstaltungsnummer` int NOT NULL,
  `Haus` varchar(50) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

--
-- Dumping data for table `vorstellung`
--

INSERT INTO `vorstellung` (`Vorstellungsnummer`, `Datum`, `Uhrzeit`, `Veranstaltungsnummer`, `Haus`) VALUES
(11, '2002-07-21', '20:00:00', 1, 'Hamburg Opernhaus'),
(12, '2002-07-28', '19:30:00', 1, 'Hamburg Opernhaus'),
(13, '2002-08-04', '19:30:00', 1, 'Hamburg Opernhaus'),
(31, '2002-01-05', '21:30:00', 3, 'Operettenhaus'),
(32, '2002-01-06', '21:30:00', 3, 'Operettenhaus'),
(41, '2002-07-21', '18:45:00', 4, 'Nordseehalle'),
(42, '2002-08-01', '19:00:00', 4, 'Kongresshalle'),
(44, '2002-09-18', '19:15:00', 4, 'Hamburg Opernhaus'),
(81, '2002-01-31', '19:30:00', 8, 'Sokratesbühne'),
(82, '2002-02-28', '19:30:00', 8, 'Sokratesbühne'),
(85, '2002-03-31', '20:00:00', 8, 'Sokratesbühne'),
(86, '2002-04-30', '20:00:00', 8, 'Sokratesbühne'),
(87, '2002-05-31', '20:00:00', 8, 'Sokratesbühne');

-- --------------------------------------------------------

--
-- Table structure for table `werbeartikel`
--

CREATE TABLE `werbeartikel` (
  `Artikelnummer` int NOT NULL,
  `Bezeichnung` text NOT NULL,
  `Preis` float NOT NULL,
  `Lagerbestand` int NOT NULL,
  `Mindesbestand` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `werbeartikel`
--

INSERT INTO `werbeartikel` (`Artikelnummer`, `Bezeichnung`, `Preis`, `Lagerbestand`, `Mindesbestand`) VALUES
(1001, 'Noten f. Klavier', 89, 26, 10),
(1003, 'T-Shirt Farbe: rot', 29.99, 11, 5),
(1012, 'Phil Collins in Concert', 20, 21, 0),
(1077, 'Plakat mit den Musical-Katzen', 33.5, 89, 50),
(1078, 'Opernführer', 19.99, 9999, 250),
(1081, 'Schwarzer Zauberstock', 5.99, 32, 20);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abteilung`
--
ALTER TABLE `abteilung`
  ADD PRIMARY KEY (`Personanummer-Abteilungsleiter`);

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`Artikelnummer`);

--
-- Indexes for table `bestellung`
--
ALTER TABLE `bestellung`
  ADD PRIMARY KEY (`Bestellnummer`);

--
-- Indexes for table `kunde`
--
ALTER TABLE `kunde`
  ADD PRIMARY KEY (`Kundennummer`),
  ADD UNIQUE KEY `Kundennummer` (`Kundennummer`);

--
-- Indexes for table `mitarbeiter`
--
ALTER TABLE `mitarbeiter`
  ADD PRIMARY KEY (`Personalnummer`);

--
-- Indexes for table `ort`
--
ALTER TABLE `ort`
  ADD PRIMARY KEY (`Plz`);

--
-- Indexes for table `sitzplatz`
--
ALTER TABLE `sitzplatz`
  ADD PRIMARY KEY (`Artikelnummer`);

--
-- Indexes for table `spielstaette`
--
ALTER TABLE `spielstaette`
  ADD PRIMARY KEY (`Haus`);

--
-- Indexes for table `veranstaltung`
--
ALTER TABLE `veranstaltung`
  ADD PRIMARY KEY (`Veranstaltungsnummer`);

--
-- Indexes for table `vorstellung`
--
ALTER TABLE `vorstellung`
  ADD PRIMARY KEY (`Vorstellungsnummer`);

--
-- Indexes for table `werbeartikel`
--
ALTER TABLE `werbeartikel`
  ADD PRIMARY KEY (`Artikelnummer`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

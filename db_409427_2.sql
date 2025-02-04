-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: partnerundpartner.lima-db.de:3306
-- Generation Time: Feb 04, 2025 at 08:03 PM
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
-- Database: `db_409427_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `ArtikelNr` varchar(5) NOT NULL,
  `Bezeichnung` varchar(35) DEFAULT NULL,
  `WgNr` varchar(1) DEFAULT NULL,
  `TeileArt` varchar(1) DEFAULT NULL,
  `EkPreis` decimal(19,4) DEFAULT NULL,
  `VkPreis` decimal(19,4) DEFAULT NULL,
  `Bestand` smallint DEFAULT NULL,
  `MeldeBest` smallint DEFAULT NULL,
  `Aktiv` tinyint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`ArtikelNr`, `Bezeichnung`, `WgNr`, `TeileArt`, `EkPreis`, `VkPreis`, `Bestand`, `MeldeBest`, `Aktiv`) VALUES
('10004', 'Handlupe 90 mm', '4', 'E', '9.5900', '18.2210', 300, 200, 0),
('10005', 'Lupe 90 mm', '4', 'E', '4.5000', '8.5500', 1010, 500, 0),
('10028', 'Abgleichschraubendreher-Satz', '2', 'E', '12.9500', '24.6050', 680, 300, 0),
('10030', 'Schraubendreher: 1,5 mm ', '2', 'E', '1.0000', '1.9000', 290, 200, 0),
('10031', 'Schraubendreher: 1,8 mm', '2', 'E', '1.0000', '1.9000', 220, 200, 0),
('10034', 'Schraubendreher: 3,0 mm ', '2', 'E', '1.0000', '1.9000', 300, 200, 0),
('10044', 'Stahllaubsäge ', '3', 'E', '5.4500', '10.3550', 1250, 400, 0),
('10049', 'Laubsägeblätter (12er Set)', '3', 'E', '2.3500', '4.4650', 2400, 600, 0),
('10050', 'Universal-Hobby-Säge', '3', 'E', '5.9500', '11.3050', 1350, 200, 0),
('10056', 'Isolier-Abstreifzängleinchen', '1', 'E', '13.5700', '19.9500', 2400, 250, 0),
('10057', 'Adernendhülsen-Zängle', '1', 'E', '16.5000', '31.3500', 1750, 220, 0),
('10058', 'Universal-Kabelzange', '1', 'E', '6.4500', '12.2550', 1900, 300, 0),
('10059', 'Schraubendreher-Set', '2', 'E', '11.2000', '21.2800', 1800, 180, 0),
('10062', 'Pozidriv-Schraubendreher', '2', 'E', '2.8000', '5.3200', 2850, 200, 0),
('10068', 'Elektronik-Seitenschneider', '1', 'H', '3.6500', '6.9350', 750, 150, 0),
('10069', 'Elektronik-Flachzange', '1', 'H', '3.6500', '6.9350', 2800, 250, 0),
('10070', 'Elektronik-Halbrundzange', '1', 'H', '3.6500', '6.9350', 1950, 500, 0),
('10071', 'Loch- und Ösenzange', '1', 'E', '12.9500', '24.6050', 2540, 350, 0),
('10075', 'Edelstahlzange flach', '1', 'H', '6.5000', '12.3500', 150, 300, 0),
('10076', 'Automatik-Abisolierzange', '1', 'H', '4.9500', '9.4050', 100, 250, 0),
('10080', 'Telefonzange 200 mm', '1', 'H', '5.9000', '11.2100', 1950, 200, 0),
('10081', 'Mehrzweckzange', '1', 'H', '18.5000', '35.1500', 4500, 200, 0),
('10086', 'Multifunktions-Crimpzange', '1', 'E', '39.5000', '75.0500', 1150, 150, 0),
('11058', 'Spezial-Bauschubkarren', '4', 'E', '59.9000', '113.8100', 450, 250, 0),
('11062', 'Durchwurfsieb verzinkt 100x60 cm', '4', 'E', '39.9000', '75.8100', 550, 250, 0),
('12345', 'Zange', '1', 'E', '11.5900', '0.0000', 0, 0, 0),
('70001', 'Werkzeugkasten Universal', '4', 'E', '149.0000', '283.1000', 120, 50, 0),
('71001', 'Schlagbohrmaschine', '4', 'H', '63.0000', '119.7000', 155, 50, 0),
('71002', 'Bohrersatz für Holz/Metall/Stein', '4', 'H', '3.5000', '6.6500', 135, 50, 0),
('71003', 'Bit-Steckschlüsselsatz', '4', 'H', '3.2000', '6.0800', 124, 50, 0),
('71004', 'Schlosserhammer', '4', 'H', '3.5000', '6.6500', 90, 80, 0),
('72102', 'Wasserpumpenzange 240', '1', 'E', '3.6500', '6.9350', 122, 20, 0),
('72250', 'Wasserwaage 400 mm', '4', 'H', '4.4000', '8.3600', 90, 40, 0),
('72255', 'Universalsäge', '3', 'E', '5.2000', '9.8800', 95, 40, 0),
('72256', 'Sägeblatt Holz', '3', 'H', '0.5500', '1.0450', 124, 40, 0),
('72257', 'Sägeblatt Metall', '3', 'H', '1.5000', '2.8500', 132, 40, 0),
('74001', 'Kasten 75/45', '4', 'E', '6.9000', '13.1100', 105, 50, 0);

-- --------------------------------------------------------

--
-- Table structure for table `auftragskoepfe`
--

CREATE TABLE `auftragskoepfe` (
  `AufNr` varchar(5) NOT NULL DEFAULT '0',
  `AufDat` datetime DEFAULT NULL,
  `KdNr` varchar(5) DEFAULT NULL,
  `AufTermin` datetime DEFAULT NULL,
  `Gebucht` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auftragskoepfe`
--

INSERT INTO `auftragskoepfe` (`AufNr`, `AufDat`, `KdNr`, `AufTermin`, `Gebucht`) VALUES
('22334', '2009-01-26 00:00:00', '24001', '2009-02-18 00:00:00', 0),
('22335', '2009-01-27 00:00:00', '24004', '2009-02-27 00:00:00', 0),
('22336', '2009-01-31 00:00:00', '24003', '2009-03-02 00:00:00', 0),
('22337', '2009-02-12 00:00:00', '24005', '2009-03-11 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `auftragspositionen`
--

CREATE TABLE `auftragspositionen` (
  `AufPosNr` varchar(5) NOT NULL,
  `AufNr` varchar(5) NOT NULL,
  `ArtikelNr` varchar(5) DEFAULT NULL,
  `AufMenge` double(15,5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auftragspositionen`
--

INSERT INTO `auftragspositionen` (`AufPosNr`, `AufNr`, `ArtikelNr`, `AufMenge`) VALUES
('1', '22334', '10004', 20.00000),
('2', '22334', '10030', 3.00000),
('3', '22335', '10005', 15.00000),
('4', '22335', '10056', 10.00000),
('5', '22335', '10059', 35.00000),
('6', '22336', '10004', 40.00000),
('7', '22337', '10069', 5.00000),
('8', '22337', '10070', 5.00000);

-- --------------------------------------------------------

--
-- Table structure for table `kunden`
--

CREATE TABLE `kunden` (
  `KdNr` varchar(5) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Strasse` varchar(50) DEFAULT NULL,
  `PLZ` varchar(5) DEFAULT NULL,
  `Ort` varchar(50) DEFAULT NULL,
  `Passwort` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `kunden`
--

INSERT INTO `kunden` (`KdNr`, `Name`, `Strasse`, `PLZ`, `Ort`, `Passwort`) VALUES
('24001', 'Baumarkt Müller', 'Postfach 134', '85579', 'Neubiberg', '12345'),
('24002', 'Friedrich Kunst', 'Mausweg 24', '72510', 'Stetten a.k.M.', '23456'),
('24003', 'BAU MIT  GmbH', 'Im Grund 11', '86657', 'Bissingen', '34567'),
('24004', 'Otto Weber', 'Postfach 888', '78727', 'Oberndorf a.N.', '45678'),
('24005', 'Peter Helferich', 'Stuttgarter Str. 44', '75394', 'Oberreichenbach', '56789'),
('24006', 'Bau und Ausbau GmbH', 'Postfach 8573', '71106', 'Magstadt', '98765'),
('24007', 'Hahn & Widmann', 'Postfach 2112', '72336', 'Balingen', '87654'),
('24008', 'Otto Huber', 'Kaiserstr. 33', '78224', 'Singen', '11111'),
('24013', 'TOOM-Baumarkt', 'Im Lehen 20', '78315', 'Radolfzell', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `nachrichten`
--

CREATE TABLE `nachrichten` (
  `NachrichtNr` int NOT NULL,
  `KdNr` varchar(5) DEFAULT NULL,
  `EMail` varchar(50) DEFAULT NULL,
  `Nachricht` varchar(200) DEFAULT NULL,
  `erledigt` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `warengruppen`
--

CREATE TABLE `warengruppen` (
  `WgNr` varchar(1) NOT NULL,
  `Warengruppe` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `warengruppen`
--

INSERT INTO `warengruppen` (`WgNr`, `Warengruppe`) VALUES
('1', 'Zangen'),
('2', 'Schraubendreher'),
('3', 'Saegen'),
('4', 'Sonstige Artikel');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`ArtikelNr`),
  ADD KEY `FK_Warengruppen` (`WgNr`);

--
-- Indexes for table `auftragskoepfe`
--
ALTER TABLE `auftragskoepfe`
  ADD PRIMARY KEY (`AufNr`),
  ADD KEY `FK_Kunden` (`KdNr`);

--
-- Indexes for table `auftragspositionen`
--
ALTER TABLE `auftragspositionen`
  ADD PRIMARY KEY (`AufPosNr`),
  ADD KEY `FK_Auftragskoepfe_1` (`AufNr`),
  ADD KEY `FK_Artikel_1` (`ArtikelNr`);

--
-- Indexes for table `kunden`
--
ALTER TABLE `kunden`
  ADD PRIMARY KEY (`KdNr`);

--
-- Indexes for table `nachrichten`
--
ALTER TABLE `nachrichten`
  ADD PRIMARY KEY (`NachrichtNr`),
  ADD KEY `FK_Kunden_2` (`KdNr`);

--
-- Indexes for table `warengruppen`
--
ALTER TABLE `warengruppen`
  ADD PRIMARY KEY (`WgNr`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nachrichten`
--
ALTER TABLE `nachrichten`
  MODIFY `NachrichtNr` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artikel`
--
ALTER TABLE `artikel`
  ADD CONSTRAINT `FK_Warengruppen` FOREIGN KEY (`WgNr`) REFERENCES `warengruppen` (`WgNr`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `auftragskoepfe`
--
ALTER TABLE `auftragskoepfe`
  ADD CONSTRAINT `FK_Kunden` FOREIGN KEY (`KdNr`) REFERENCES `kunden` (`KdNr`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `auftragspositionen`
--
ALTER TABLE `auftragspositionen`
  ADD CONSTRAINT `FK_Artikel_1` FOREIGN KEY (`ArtikelNr`) REFERENCES `artikel` (`ArtikelNr`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_Auftragskoepfe_1` FOREIGN KEY (`AufNr`) REFERENCES `auftragskoepfe` (`AufNr`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `nachrichten`
--
ALTER TABLE `nachrichten`
  ADD CONSTRAINT `FK_Kunden_2` FOREIGN KEY (`KdNr`) REFERENCES `kunden` (`KdNr`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

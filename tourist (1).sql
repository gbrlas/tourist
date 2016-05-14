-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2016 at 07:31 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tourist`
--

-- --------------------------------------------------------

--
-- Table structure for table `akcija`
--

CREATE TABLE IF NOT EXISTS `akcija` (
  `idAkcija` int(11) NOT NULL AUTO_INCREMENT,
  `popust` decimal(10,2) NOT NULL,
  PRIMARY KEY (`idAkcija`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `akcija`
--

INSERT INTO `akcija` (`idAkcija`, `popust`) VALUES
(1, '0.90');

-- --------------------------------------------------------

--
-- Table structure for table `apartman`
--

CREATE TABLE IF NOT EXISTS `apartman` (
  `idSmjestaj` int(11) NOT NULL AUTO_INCREMENT,
  `brojOsoba` int(11) NOT NULL,
  `brojSoba` int(11) NOT NULL,
  `cijenaPoDanu` decimal(10,0) NOT NULL,
  `naziv` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`idSmjestaj`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=5 ;

--
-- Dumping data for table `apartman`
--

INSERT INTO `apartman` (`idSmjestaj`, `brojOsoba`, `brojSoba`, `cijenaPoDanu`, `naziv`) VALUES
(3, 4, 2, '50', 'Placa Espanya Apt'),
(4, 4, 2, '55', 'Diagonal Apartment');

-- --------------------------------------------------------

--
-- Table structure for table `drzava`
--

CREATE TABLE IF NOT EXISTS `drzava` (
  `idDrzava` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`idDrzava`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=5 ;

--
-- Dumping data for table `drzava`
--

INSERT INTO `drzava` (`idDrzava`, `naziv`) VALUES
(1, 'Spain'),
(2, 'Switzerland'),
(3, 'USA'),
(4, 'Italy');

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE IF NOT EXISTS `hotel` (
  `idSmjestaj` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `kapacitetHotela` int(11) NOT NULL,
  `brojObroka` int(11) NOT NULL,
  PRIMARY KEY (`idSmjestaj`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`idSmjestaj`, `naziv`, `kapacitetHotela`, `brojObroka`) VALUES
(1, 'Mercer Hotel Barcelona', 500, 3),
(2, 'Alma Hotel Barcelona', 600, 3);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_nudi`
--

CREATE TABLE IF NOT EXISTS `hotel_nudi` (
  `idSmjestaj` int(11) NOT NULL,
  `idSadrzaj` int(11) NOT NULL,
  PRIMARY KEY (`idSmjestaj`,`idSadrzaj`),
  KEY `idSadrzaj` (`idSadrzaj`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `hotel_nudi`
--

INSERT INTO `hotel_nudi` (`idSmjestaj`, `idSadrzaj`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `izlet`
--

CREATE TABLE IF NOT EXISTS `izlet` (
  `idIzlet` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `opis` varchar(1000) COLLATE utf8mb4_bin NOT NULL,
  `trajanje` int(11) NOT NULL,
  `cijenaPoOsobi` decimal(10,0) NOT NULL,
  `ukljucenVodic` tinyint(1) NOT NULL,
  `ukljucenObrok` tinyint(1) NOT NULL,
  `ukljuceneUlaznice` tinyint(1) NOT NULL,
  `nazivKompanije` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `idLokacija` int(11) NOT NULL,
  `idAkcija` int(11) DEFAULT NULL,
  PRIMARY KEY (`idIzlet`),
  KEY `idLokacija` (`idLokacija`,`idAkcija`),
  KEY `idLokacija_2` (`idLokacija`),
  KEY `idAkcija` (`idAkcija`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=4 ;

--
-- Dumping data for table `izlet`
--

INSERT INTO `izlet` (`idIzlet`, `naziv`, `opis`, `trajanje`, `cijenaPoOsobi`, `ukljucenVodic`, `ukljucenObrok`, `ukljuceneUlaznice`, `nazivKompanije`, `idLokacija`, `idAkcija`) VALUES
(1, 'Disney California Story Tour', 'Explore the Golden State’s vibrant history and see how its turn-of-the-century spirit influenced daring dreamers like Walt Disney. ', 8, '2000', 1, 1, 1, 'AmericaTours', 6, NULL),
(3, 'Cinque Terre Day Trip', 'Explore the Italian Riviera on this day trip to the beautiful Cinque Terre from Florence, with transport between each small town provided. Led by a local guide, discover each fishing village by coach, train and boat, from the beaches of Monterosso to the charming streets of Riomaggiore. Stop for a swim in the turquoise waters and upgrade to include a traditional Italian lunch. Soak up all the character of this UNESCO-listed region before heading back to Florence.', 13, '100', 1, 1, 2, 'Viator', 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `izlet_polazak`
--

CREATE TABLE IF NOT EXISTS `izlet_polazak` (
  `idIzletPolazak` int(11) NOT NULL AUTO_INCREMENT,
  `idIzlet` int(11) NOT NULL,
  `vrijemePolazak` datetime NOT NULL,
  `slobodnoMjesta` int(11) NOT NULL DEFAULT '30',
  PRIMARY KEY (`idIzletPolazak`),
  KEY `idIzlet` (`idIzlet`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=5 ;

--
-- Dumping data for table `izlet_polazak`
--

INSERT INTO `izlet_polazak` (`idIzletPolazak`, `idIzlet`, `vrijemePolazak`, `slobodnoMjesta`) VALUES
(1, 3, '2016-07-07 07:00:00', 28),
(2, 3, '2016-07-08 07:00:00', 21),
(3, 3, '2016-07-09 07:00:00', 30),
(4, 3, '2016-07-10 07:00:00', 30);

-- --------------------------------------------------------

--
-- Table structure for table `izlet_rezervacija`
--

CREATE TABLE IF NOT EXISTS `izlet_rezervacija` (
  `idIzletRezervacija` int(11) NOT NULL AUTO_INCREMENT,
  `brojOsoba` int(11) NOT NULL,
  `ukupnaCijena` decimal(10,2) NOT NULL,
  `idIzlet` int(11) NOT NULL,
  `idIzletPolazak` int(11) NOT NULL,
  `idKupac` int(11) NOT NULL,
  PRIMARY KEY (`idIzletRezervacija`),
  KEY `idIzlet` (`idIzlet`),
  KEY `idKupac` (`idKupac`),
  KEY `idIzletPolazak` (`idIzletPolazak`),
  KEY `idIzletPolazak_2` (`idIzletPolazak`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=5 ;

--
-- Dumping data for table `izlet_rezervacija`
--

INSERT INTO `izlet_rezervacija` (`idIzletRezervacija`, `brojOsoba`, `ukupnaCijena`, `idIzlet`, `idIzletPolazak`, `idKupac`) VALUES
(1, 2, '200.00', 3, 1, 1),
(2, 4, '400.00', 3, 2, 4),
(3, 3, '300.00', 3, 2, 6),
(4, 2, '180.00', 3, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kupac`
--

CREATE TABLE IF NOT EXISTS `kupac` (
  `idKupac` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `prezime` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `e_mail` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `godinaRodjenja` int(11) NOT NULL,
  `kontakt` int(11) NOT NULL,
  PRIMARY KEY (`idKupac`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=7 ;

--
-- Dumping data for table `kupac`
--

INSERT INTO `kupac` (`idKupac`, `ime`, `prezime`, `e_mail`, `godinaRodjenja`, `kontakt`) VALUES
(1, 'Goran', 'Brlas', 'goran.brlas@gmail.com', 1995, 996777919),
(4, 'Antonija', 'Vrdoljak', 'ata_os@hotmail.com', 1994, 998166372),
(5, 'Ivana', 'Vrdoljak', 'antonija.vrdoljak94@gmail.com', 1994, 996706433),
(6, 'Antonija', 'Vrdoljak', 'antonija.vrdoljak94@gmail.com', 1994, 996706433);

-- --------------------------------------------------------

--
-- Table structure for table `lokacija`
--

CREATE TABLE IF NOT EXISTS `lokacija` (
  `idLokacija` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `opis` varchar(1000) COLLATE utf8mb4_bin NOT NULL,
  `dugiOpis` varchar(10000) COLLATE utf8mb4_bin NOT NULL,
  `tip` int(11) NOT NULL,
  `idDrzava` int(11) NOT NULL,
  `pregledi` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idLokacija`),
  KEY `idDrzava` (`idDrzava`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=9 ;

--
-- Dumping data for table `lokacija`
--

INSERT INTO `lokacija` (`idLokacija`, `ime`, `opis`, `dugiOpis`, `tip`, `idDrzava`, `pregledi`) VALUES
(2, 'Barcelona, Spain', 'Founded as a Roman city, in the Middle Ages Barcelona became the capital of the County of Barcelona. After merging with the Kingdom of Aragon, Barcelona continued to be an important city in the Crown of Aragon as an economical and administrative center of this Crown and the capital of the Principality of Catalonia. Besieged several times during its history, Barcelona has a rich cultural heritage and is today an important cultural center and a major tourist destination. Particularly renowned are the architectural works of Antoni Gaudí and Lluís Domènech i Montaner, which have been designated UNESCO World Heritage Sites. The headquarters of the Union for the Mediterranean is located in Barcelona. The city is known for hosting the 1992 Summer Olympics as well as world-class conferences and expositions and also many international sport tournaments.', '', 3, 1, 18),
(3, 'Madrid, Spain', 'The city is located on the Manzanares River in the centre of both the country and the Community of Madrid (which comprises the city of Madrid, its conurbation and extended suburbs and villages); this community is bordered by the autonomous communities of Castile and León and Castile-La Mancha. As the capital city of Spain, seat of government, and residence of the Spanish monarch, Madrid is also the political, economic and cultural centre of Spain. The current mayor is Manuela Carmena from Ahora Madrid.', '', 3, 1, 4),
(4, 'Murren, Switzerland', 'Mürren is a traditional Walser mountain village in Bernese Oberland, Switzerland, at an elevation of 1,650 m (5,413 ft.) above sea level and unreachable by public road. Tourism is popular through the summer and winter; the village features a view of the three towering mountains: Eiger, Mönch, and Jungfrau. Mürren has a population of just 450, but has 2,000 hotel beds.\r\n\r\nMürren has its own school and two churches, one Reformed and one Roman Catholic.', '', 2, 2, 1),
(5, 'Santa Catalina Island, California', 'Santa Catalina Island, often called Catalina Island, or just Catalina, is a rocky island off the coast of the U.S. state of California in the Gulf of Santa Catalina. The island is 22 miles (35 km) long and 8 miles (13 km) across at its greatest width. The island is located about 22 miles (35 km) south-southwest of Los Angeles, California. The highest point on the island is 2,097 feet (639 m) Mt. Orizaba. Santa Catalina is part of the Channel Islands of California archipelago and lies within Los Angeles County.', '', 1, 3, 1),
(6, 'Disneyland Resort', 'Disneyland resort.', '', 5, 3, 0),
(7, 'New York City, USA', 'The City of New York, often called New York City or simply New York, is the most populous city in the United States. Located at the southern tip of the State of New York, the city is the center of the New York metropolitan area, one of the most populous urban agglomerations in the world. A global power city, New York City exerts a significant impact upon commerce, finance, media, art, fashion, research, technology, education, and entertainment, its fast pace defining the term New York minute. Home to the headquarters of the United Nations, New York is an important center for international diplomacy and has been described as the cultural and financial capital of the world.', '', 3, 3, 0),
(8, 'Italian Riviera', 'Italian Riviera', '', 5, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sadrzaj`
--

CREATE TABLE IF NOT EXISTS `sadrzaj` (
  `idSadrzaj` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`idSadrzaj`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=7 ;

--
-- Dumping data for table `sadrzaj`
--

INSERT INTO `sadrzaj` (`idSadrzaj`, `naziv`) VALUES
(1, 'Chic restaurant'),
(2, 'Cafe/bar'),
(3, 'Garden terace'),
(4, 'Spa'),
(5, 'Pool'),
(6, 'Gym');

-- --------------------------------------------------------

--
-- Table structure for table `slika`
--

CREATE TABLE IF NOT EXISTS `slika` (
  `idSlika` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(1000) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`idSlika`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=25 ;

--
-- Dumping data for table `slika`
--

INSERT INTO `slika` (`idSlika`, `url`) VALUES
(1, 'barcelona1.jpg'),
(7, 'madrid1.jpg'),
(8, 'murren1.jpg'),
(9, 'santacatalina1.jpg'),
(10, 'disneyland1.jpg'),
(11, 'ny1.jpg'),
(12, 'hotel1.jpg'),
(13, 'hotel2.jpg'),
(14, 'apartman1.jpg'),
(15, 'apartman2.jpg'),
(16, 'italiariviera1.jpg'),
(17, 'barcelona2.jpg'),
(18, 'barcelona3.jpg'),
(19, 'barcelona4.jpg'),
(20, 'hotel3.jpg'),
(21, 'italia2.jpg'),
(22, 'madrid2.jpg'),
(23, 'madrid3.jpg'),
(24, 'madrid4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `slike_izlet`
--

CREATE TABLE IF NOT EXISTS `slike_izlet` (
  `idIzlet` int(11) NOT NULL,
  `idSlika` int(11) NOT NULL,
  PRIMARY KEY (`idIzlet`,`idSlika`),
  KEY `idSlika` (`idSlika`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `slike_izlet`
--

INSERT INTO `slike_izlet` (`idIzlet`, `idSlika`) VALUES
(1, 10),
(3, 16),
(3, 21);

-- --------------------------------------------------------

--
-- Table structure for table `slike_lokacija`
--

CREATE TABLE IF NOT EXISTS `slike_lokacija` (
  `idLokacija` int(11) NOT NULL,
  `idSlika` int(11) NOT NULL,
  PRIMARY KEY (`idLokacija`,`idSlika`),
  KEY `idSlika` (`idSlika`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `slike_lokacija`
--

INSERT INTO `slike_lokacija` (`idLokacija`, `idSlika`) VALUES
(2, 1),
(3, 7),
(4, 8),
(5, 9),
(7, 11),
(2, 17),
(2, 18),
(2, 19),
(3, 22),
(3, 23),
(3, 24);

-- --------------------------------------------------------

--
-- Table structure for table `slike_smjestaj`
--

CREATE TABLE IF NOT EXISTS `slike_smjestaj` (
  `idSmjestaj` int(11) NOT NULL,
  `idSlika` int(11) NOT NULL,
  PRIMARY KEY (`idSmjestaj`,`idSlika`),
  KEY `idSlika` (`idSlika`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `slike_smjestaj`
--

INSERT INTO `slike_smjestaj` (`idSmjestaj`, `idSlika`) VALUES
(1, 12),
(2, 13),
(3, 14),
(4, 15),
(1, 20);

-- --------------------------------------------------------

--
-- Table structure for table `smjestaj`
--

CREATE TABLE IF NOT EXISTS `smjestaj` (
  `idSmjestaj` int(11) NOT NULL AUTO_INCREMENT,
  `tip` int(11) NOT NULL,
  `opis` varchar(1000) COLLATE utf8mb4_bin NOT NULL,
  `adresa` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `klasifikacija` int(11) NOT NULL,
  `idLokacija` int(11) NOT NULL,
  `idAkcija` int(11) DEFAULT NULL,
  PRIMARY KEY (`idSmjestaj`),
  KEY `idLokacija` (`idLokacija`),
  KEY `idAkcija` (`idAkcija`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=5 ;

--
-- Dumping data for table `smjestaj`
--

INSERT INTO `smjestaj` (`idSmjestaj`, `tip`, `opis`, `adresa`, `klasifikacija`, `idLokacija`, `idAkcija`) VALUES
(1, 1, 'In a historic building in Barcelona''s historic Gothic quarter, this upscale hotel is a 3-minute walk from the Jaume I metro station and 500 m from the Museu Picasso (art museum). \n\nOffering free Wi-Fi and minibars, the refined rooms also come with flat-screen TVs, designer toiletries and rainfall showerheads. Some have balconies and/or original wood beams or stone walls, while suites add amenities such as separate living rooms, bath tubs and desks. Room service is available.', 'Carrer dels Lledó', 5, 2, 1),
(2, 1, 'A 5-minute walk from Passeig de Gràcia metro station, this sophisticated hotel is a 3-minute walk from Gaudi''s Casa Milà and 1.5 km from Sagrada Família church. \n\nThe contemporary rooms come with free Wi-Fi, flat-screen TVs and minibars. Upgraded rooms with city views are individually decorated. Suites add separate living areas, and there''s 1 with a balcony. Room service is available.', 'Carrer de Mallorc', 5, 2, NULL),
(3, 2, 'This apartment "Placa Espanya Romantic apartment" offers Terrace y HVAC. \nThe accommodation is just 1.4 km to the center away from Barcelona.\n', 'Sants-Montjuïc, Barcelona', 3, 2, NULL),
(4, 2, 'This apartment "SAGRADA FAMILIA WIFI" offers HVAC y Lift. \nThe accommodation is just 1.3 km to the center away from Barcelona.', 'Sant Marti, Barcelona', 4, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `smjestaj_rezervacija`
--

CREATE TABLE IF NOT EXISTS `smjestaj_rezervacija` (
  `idSmjestajRezervacija` int(11) NOT NULL AUTO_INCREMENT,
  `tipRezervacije` int(11) NOT NULL,
  `idRezervirano` int(11) DEFAULT NULL,
  `datumOd` date NOT NULL,
  `brojDana` int(11) NOT NULL,
  `ukupnaCijena` decimal(10,2) NOT NULL,
  `idSmjestaj` int(11) NOT NULL,
  `idKupac` int(11) NOT NULL,
  PRIMARY KEY (`idSmjestajRezervacija`),
  KEY `idSmjestaj` (`idSmjestaj`),
  KEY `idKupac` (`idKupac`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=19 ;

--
-- Dumping data for table `smjestaj_rezervacija`
--

INSERT INTO `smjestaj_rezervacija` (`idSmjestajRezervacija`, `tipRezervacije`, `idRezervirano`, `datumOd`, `brojDana`, `ukupnaCijena`, `idSmjestaj`, `idKupac`) VALUES
(6, 1, 1, '2016-07-12', 2, '200.00', 1, 1),
(7, 1, 4, '2016-05-15', 4, '520.00', 1, 1),
(8, 2, 6, '2016-07-12', 5, '275.00', 4, 1),
(9, 1, 1, '2016-05-15', 8, '800.00', 1, 5),
(10, 2, 6, '2016-06-09', 4, '220.00', 4, 1),
(13, 2, 6, '2016-05-15', 5, '247.50', 4, 1),
(17, 2, 6, '2016-05-15', 5, '247.50', 4, 1),
(18, 1, 2, '2016-05-15', 2, '162.00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `soba`
--

CREATE TABLE IF NOT EXISTS `soba` (
  `idSoba` int(11) NOT NULL AUTO_INCREMENT,
  `velicina` float NOT NULL,
  `tip` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `cijenaPoDanu` float NOT NULL,
  `brojSlobodnih` tinyint(1) NOT NULL,
  `brojOsoba` int(11) NOT NULL,
  `idSmjestaj` int(11) NOT NULL,
  PRIMARY KEY (`idSoba`),
  KEY `idSmjestaj` (`idSmjestaj`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=7 ;

--
-- Dumping data for table `soba`
--

INSERT INTO `soba` (`idSoba`, `velicina`, `tip`, `cijenaPoDanu`, `brojSlobodnih`, `brojOsoba`, `idSmjestaj`) VALUES
(1, 30, 'Superior', 100, 40, 2, 1),
(2, 36, 'Deluxe', 90, 50, 3, 1),
(3, 43, 'Junior Suite', 120, 20, 3, 1),
(4, 95, 'Suite', 130, 10, 4, 1),
(5, 30, 'Apartment room', 50, 2, 2, 3),
(6, 35, 'Apartment room', 55, 2, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `soba_rezervacija`
--

CREATE TABLE IF NOT EXISTS `soba_rezervacija` (
  `idSobaRezervacija` int(11) NOT NULL AUTO_INCREMENT,
  `idSoba` int(11) NOT NULL,
  `datum` date NOT NULL,
  `slobodno` int(11) NOT NULL,
  PRIMARY KEY (`idSobaRezervacija`),
  KEY `idSoba` (`idSoba`),
  KEY `idSoba_2` (`idSoba`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=38 ;

--
-- Dumping data for table `soba_rezervacija`
--

INSERT INTO `soba_rezervacija` (`idSobaRezervacija`, `idSoba`, `datum`, `slobodno`) VALUES
(5, 1, '2016-07-12', 39),
(6, 1, '2016-07-13', 39),
(7, 4, '2016-05-15', 9),
(8, 4, '2016-05-16', 9),
(9, 4, '2016-05-17', 9),
(10, 4, '2016-05-18', 9),
(11, 6, '2016-07-12', 1),
(12, 6, '2016-07-13', 1),
(13, 6, '2016-07-14', 1),
(14, 6, '2016-07-15', 1),
(15, 6, '2016-07-16', 1),
(16, 1, '2016-05-15', 39),
(17, 1, '2016-05-16', 39),
(18, 1, '2016-05-17', 39),
(19, 1, '2016-05-18', 39),
(20, 1, '2016-05-19', 39),
(21, 1, '2016-05-20', 39),
(22, 1, '2016-05-21', 39),
(23, 1, '2016-05-22', 39),
(24, 6, '2016-06-09', 1),
(25, 6, '2016-06-10', 1),
(26, 6, '2016-06-11', 1),
(27, 6, '2016-06-12', 1),
(33, 6, '2016-05-15', 0),
(34, 6, '2016-05-16', 0),
(35, 6, '2016-05-18', 1),
(36, 2, '2016-05-15', 49),
(37, 2, '2016-05-16', 49);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `apartman`
--
ALTER TABLE `apartman`
  ADD CONSTRAINT `APARTMAN_ibfk_1` FOREIGN KEY (`idSmjestaj`) REFERENCES `smjestaj` (`idSmjestaj`);

--
-- Constraints for table `hotel`
--
ALTER TABLE `hotel`
  ADD CONSTRAINT `HOTEL_ibfk_1` FOREIGN KEY (`idSmjestaj`) REFERENCES `smjestaj` (`idSmjestaj`);

--
-- Constraints for table `hotel_nudi`
--
ALTER TABLE `hotel_nudi`
  ADD CONSTRAINT `HOTEL_NUDI_ibfk_1` FOREIGN KEY (`idSmjestaj`) REFERENCES `smjestaj` (`idSmjestaj`),
  ADD CONSTRAINT `HOTEL_NUDI_ibfk_2` FOREIGN KEY (`idSadrzaj`) REFERENCES `sadrzaj` (`idSadrzaj`);

--
-- Constraints for table `izlet`
--
ALTER TABLE `izlet`
  ADD CONSTRAINT `IZLET_ibfk_1` FOREIGN KEY (`idLokacija`) REFERENCES `lokacija` (`idLokacija`) ON UPDATE CASCADE,
  ADD CONSTRAINT `IZLET_ibfk_2` FOREIGN KEY (`idAkcija`) REFERENCES `akcija` (`idAkcija`) ON UPDATE CASCADE;

--
-- Constraints for table `izlet_polazak`
--
ALTER TABLE `izlet_polazak`
  ADD CONSTRAINT `IZLET_POLAZAK_ibfk_1` FOREIGN KEY (`idIzlet`) REFERENCES `izlet` (`idIzlet`);

--
-- Constraints for table `izlet_rezervacija`
--
ALTER TABLE `izlet_rezervacija`
  ADD CONSTRAINT `IZLET_REZERVACIJA_ibfk_1` FOREIGN KEY (`idIzlet`) REFERENCES `izlet` (`idIzlet`),
  ADD CONSTRAINT `IZLET_REZERVACIJA_ibfk_2` FOREIGN KEY (`idKupac`) REFERENCES `kupac` (`idKupac`),
  ADD CONSTRAINT `IZLET_REZERVACIJA_ibfk_3` FOREIGN KEY (`idIzletPolazak`) REFERENCES `izlet_polazak` (`idIzletPolazak`);

--
-- Constraints for table `lokacija`
--
ALTER TABLE `lokacija`
  ADD CONSTRAINT `LOKACIJA_ibfk_1` FOREIGN KEY (`idDrzava`) REFERENCES `drzava` (`idDrzava`);

--
-- Constraints for table `slike_izlet`
--
ALTER TABLE `slike_izlet`
  ADD CONSTRAINT `SLIKE_IZLET_ibfk_1` FOREIGN KEY (`idIzlet`) REFERENCES `izlet` (`idIzlet`),
  ADD CONSTRAINT `SLIKE_IZLET_ibfk_2` FOREIGN KEY (`idSlika`) REFERENCES `slika` (`idSlika`);

--
-- Constraints for table `slike_lokacija`
--
ALTER TABLE `slike_lokacija`
  ADD CONSTRAINT `SLIKE_LOKACIJA_ibfk_1` FOREIGN KEY (`idLokacija`) REFERENCES `lokacija` (`idLokacija`),
  ADD CONSTRAINT `SLIKE_LOKACIJA_ibfk_2` FOREIGN KEY (`idSlika`) REFERENCES `slika` (`idSlika`);

--
-- Constraints for table `slike_smjestaj`
--
ALTER TABLE `slike_smjestaj`
  ADD CONSTRAINT `SLIKE_SMJESTAJ_ibfk_1` FOREIGN KEY (`idSmjestaj`) REFERENCES `smjestaj` (`idSmjestaj`),
  ADD CONSTRAINT `SLIKE_SMJESTAJ_ibfk_2` FOREIGN KEY (`idSlika`) REFERENCES `slika` (`idSlika`);

--
-- Constraints for table `smjestaj`
--
ALTER TABLE `smjestaj`
  ADD CONSTRAINT `SMJESTAJ_ibfk_1` FOREIGN KEY (`idLokacija`) REFERENCES `lokacija` (`idLokacija`),
  ADD CONSTRAINT `SMJESTAJ_ibfk_2` FOREIGN KEY (`idAkcija`) REFERENCES `akcija` (`idAkcija`);

--
-- Constraints for table `smjestaj_rezervacija`
--
ALTER TABLE `smjestaj_rezervacija`
  ADD CONSTRAINT `SMJESTAJ_REZERVACIJA_ibfk_1` FOREIGN KEY (`idSmjestaj`) REFERENCES `smjestaj` (`idSmjestaj`),
  ADD CONSTRAINT `SMJESTAJ_REZERVACIJA_ibfk_2` FOREIGN KEY (`idKupac`) REFERENCES `kupac` (`idKupac`);

--
-- Constraints for table `soba`
--
ALTER TABLE `soba`
  ADD CONSTRAINT `SOBA_ibfk_1` FOREIGN KEY (`idSmjestaj`) REFERENCES `smjestaj` (`idSmjestaj`);

--
-- Constraints for table `soba_rezervacija`
--
ALTER TABLE `soba_rezervacija`
  ADD CONSTRAINT `SOBA_REZERVACIJA_ibfk_1` FOREIGN KEY (`idSoba`) REFERENCES `soba` (`idSoba`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

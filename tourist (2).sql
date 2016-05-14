-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Računalo: localhost
-- Vrijeme generiranja: May 11, 2016 u 10:19 AM
-- Verzija poslužitelja: 5.5.49-0ubuntu0.14.04.1
-- PHP verzija: 5.5.9-1ubuntu4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza podataka: `tourist`
--

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `AKCIJA`
--

CREATE TABLE IF NOT EXISTS `AKCIJA` (
  `idAkcija` int(11) NOT NULL AUTO_INCREMENT,
  `popust` decimal(10,0) NOT NULL,
  PRIMARY KEY (`idAkcija`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `APARTMAN`
--

CREATE TABLE IF NOT EXISTS `APARTMAN` (
  `idSmjestaj` int(11) NOT NULL AUTO_INCREMENT,
  `brojOsoba` int(11) NOT NULL,
  `brojApartmana` int(11) NOT NULL,
  `cijenaPoDanu` decimal(10,0) NOT NULL,
  `naziv` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`idSmjestaj`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=5 ;

--
-- Izbacivanje podataka za tablicu `APARTMAN`
--

INSERT INTO `APARTMAN` (`idSmjestaj`, `brojOsoba`, `brojApartmana`, `cijenaPoDanu`, `naziv`) VALUES
(3, 4, 1, 500, 'Placa Espanya Apt'),
(4, 4, 1, 200, 'Diagonal Apartment');

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `DRZAVA`
--

CREATE TABLE IF NOT EXISTS `DRZAVA` (
  `idDrzava` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`idDrzava`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=5 ;

--
-- Izbacivanje podataka za tablicu `DRZAVA`
--

INSERT INTO `DRZAVA` (`idDrzava`, `naziv`) VALUES
(1, 'Španjolska'),
(2, 'Švicarska'),
(3, 'USA'),
(4, 'Italija');

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `HOTEL`
--

CREATE TABLE IF NOT EXISTS `HOTEL` (
  `idSmjestaj` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `kapacitetHotela` int(11) NOT NULL,
  `brojObroka` int(11) NOT NULL,
  PRIMARY KEY (`idSmjestaj`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=3 ;

--
-- Izbacivanje podataka za tablicu `HOTEL`
--

INSERT INTO `HOTEL` (`idSmjestaj`, `naziv`, `kapacitetHotela`, `brojObroka`) VALUES
(1, 'Mercer Hotel Barcelona', 500, 3),
(2, 'Alma Hotel Barcelona', 600, 3);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `HOTEL_NUDI`
--

CREATE TABLE IF NOT EXISTS `HOTEL_NUDI` (
  `idSmjestaj` int(11) NOT NULL,
  `idSadrzaj` int(11) NOT NULL,
  PRIMARY KEY (`idSmjestaj`,`idSadrzaj`),
  KEY `idSadrzaj` (`idSadrzaj`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Izbacivanje podataka za tablicu `HOTEL_NUDI`
--

INSERT INTO `HOTEL_NUDI` (`idSmjestaj`, `idSadrzaj`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `IZLET`
--

CREATE TABLE IF NOT EXISTS `IZLET` (
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
-- Izbacivanje podataka za tablicu `IZLET`
--

INSERT INTO `IZLET` (`idIzlet`, `naziv`, `opis`, `trajanje`, `cijenaPoOsobi`, `ukljucenVodic`, `ukljucenObrok`, `ukljuceneUlaznice`, `nazivKompanije`, `idLokacija`, `idAkcija`) VALUES
(1, 'Disney California Story Tour', 'Explore the Golden State’s vibrant history and see how its turn-of-the-century spirit influenced daring dreamers like Walt Disney. ', 8, 2000, 1, 1, 1, 'AmericaTours', 6, NULL),
(3, 'Cinque Terre Day Trip', 'Explore the Italian Riviera on this day trip to the beautiful Cinque Terre from Florence, with transport between each small town provided. Led by a local guide, discover each fishing village by coach, train and boat, from the beaches of Monterosso to the charming streets of Riomaggiore. Stop for a swim in the turquoise waters and upgrade to include a traditional Italian lunch. Soak up all the character of this UNESCO-listed region before heading back to Florence.', 13, 100, 1, 1, 2, 'Viator', 8, NULL);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `IZLET_POLAZAK`
--

CREATE TABLE IF NOT EXISTS `IZLET_POLAZAK` (
  `idIzletPolazak` int(11) NOT NULL AUTO_INCREMENT,
  `idIzlet` int(11) NOT NULL,
  `vrijemePolazak` datetime NOT NULL,
  PRIMARY KEY (`idIzletPolazak`),
  KEY `idIzlet` (`idIzlet`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=5 ;

--
-- Izbacivanje podataka za tablicu `IZLET_POLAZAK`
--

INSERT INTO `IZLET_POLAZAK` (`idIzletPolazak`, `idIzlet`, `vrijemePolazak`) VALUES
(1, 3, '2016-07-07 07:00:00'),
(2, 3, '2016-07-08 07:00:00'),
(3, 3, '2016-07-09 07:00:00'),
(4, 3, '2016-07-10 07:00:00');

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `IZLET_REZERVACIJA`
--

CREATE TABLE IF NOT EXISTS `IZLET_REZERVACIJA` (
  `idIzletRezervacija` int(11) NOT NULL AUTO_INCREMENT,
  `brojOsoba` int(11) NOT NULL,
  `ukupnaCijena` decimal(10,0) NOT NULL,
  `idIzlet` int(11) NOT NULL,
  `idKupac` int(11) NOT NULL,
  PRIMARY KEY (`idIzletRezervacija`),
  KEY `idIzlet` (`idIzlet`),
  KEY `idKupac` (`idKupac`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `KUPAC`
--

CREATE TABLE IF NOT EXISTS `KUPAC` (
  `idKupac` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `prezime` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `e_mail` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `godinaRodjenja` int(11) NOT NULL,
  `kontakt` int(11) NOT NULL,
  PRIMARY KEY (`idKupac`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `LOKACIJA`
--

CREATE TABLE IF NOT EXISTS `LOKACIJA` (
  `idLokacija` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `opis` varchar(1000) COLLATE utf8mb4_bin NOT NULL,
  `dugiOpis` varchar(10000) COLLATE utf8mb4_bin NOT NULL,
  `tip` int(11) NOT NULL,
  `idDrzava` int(11) NOT NULL,
  PRIMARY KEY (`idLokacija`),
  KEY `idDrzava` (`idDrzava`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=9 ;

--
-- Izbacivanje podataka za tablicu `LOKACIJA`
--

INSERT INTO `LOKACIJA` (`idLokacija`, `ime`, `opis`, `dugiOpis`, `tip`, `idDrzava`) VALUES
(2, 'Barcelona, Spain', 'Founded as a Roman city, in the Middle Ages Barcelona became the capital of the County of Barcelona. After merging with the Kingdom of Aragon, Barcelona continued to be an important city in the Crown of Aragon as an economical and administrative center of this Crown and the capital of the Principality of Catalonia. Besieged several times during its history, Barcelona has a rich cultural heritage and is today an important cultural center and a major tourist destination. Particularly renowned are the architectural works of Antoni Gaudí and Lluís Domènech i Montaner, which have been designated UNESCO World Heritage Sites. The headquarters of the Union for the Mediterranean is located in Barcelona. The city is known for hosting the 1992 Summer Olympics as well as world-class conferences and expositions and also many international sport tournaments.', '', 3, 1),
(3, 'Madrid, Spain', 'The city is located on the Manzanares River in the centre of both the country and the Community of Madrid (which comprises the city of Madrid, its conurbation and extended suburbs and villages); this community is bordered by the autonomous communities of Castile and León and Castile-La Mancha. As the capital city of Spain, seat of government, and residence of the Spanish monarch, Madrid is also the political, economic and cultural centre of Spain. The current mayor is Manuela Carmena from Ahora Madrid.', '', 3, 1),
(4, 'Murren, Switzerland', 'Mürren is a traditional Walser mountain village in Bernese Oberland, Switzerland, at an elevation of 1,650 m (5,413 ft.) above sea level and unreachable by public road. Tourism is popular through the summer and winter; the village features a view of the three towering mountains: Eiger, Mönch, and Jungfrau. Mürren has a population of just 450, but has 2,000 hotel beds.\r\n\r\nMürren has its own school and two churches, one Reformed and one Roman Catholic.', '', 2, 2),
(5, 'Santa Catalina Island, California', 'Santa Catalina Island, often called Catalina Island, or just Catalina, is a rocky island off the coast of the U.S. state of California in the Gulf of Santa Catalina. The island is 22 miles (35 km) long and 8 miles (13 km) across at its greatest width. The island is located about 22 miles (35 km) south-southwest of Los Angeles, California. The highest point on the island is 2,097 feet (639 m) Mt. Orizaba. Santa Catalina is part of the Channel Islands of California archipelago and lies within Los Angeles County.', '', 1, 3),
(6, 'Disneyland Resort', 'Disneyland resort.', '', 5, 3),
(7, 'New York City, USA', 'The City of New York, often called New York City or simply New York, is the most populous city in the United States. Located at the southern tip of the State of New York, the city is the center of the New York metropolitan area, one of the most populous urban agglomerations in the world. A global power city, New York City exerts a significant impact upon commerce, finance, media, art, fashion, research, technology, education, and entertainment, its fast pace defining the term New York minute. Home to the headquarters of the United Nations, New York is an important center for international diplomacy and has been described as the cultural and financial capital of the world.', '', 3, 3),
(8, 'Italian Riviera', 'Italian Riviera', '', 5, 4);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `SADRZAJ`
--

CREATE TABLE IF NOT EXISTS `SADRZAJ` (
  `idSadrzaj` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`idSadrzaj`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=7 ;

--
-- Izbacivanje podataka za tablicu `SADRZAJ`
--

INSERT INTO `SADRZAJ` (`idSadrzaj`, `naziv`) VALUES
(1, 'Chic restaurant'),
(2, 'Cafe/bar'),
(3, 'Garden terace'),
(4, 'Spa'),
(5, 'Pool'),
(6, 'Gym');

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `SLIKA`
--

CREATE TABLE IF NOT EXISTS `SLIKA` (
  `idSlika` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(1000) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`idSlika`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=17 ;

--
-- Izbacivanje podataka za tablicu `SLIKA`
--

INSERT INTO `SLIKA` (`idSlika`, `url`) VALUES
(1, 'https://media.timeout.com/images/101851347/image.jpg'),
(6, 'http://bcnshop.barcelonaturisme.com/files/5445-8234-Imagen/Nit_Barcelona_h1.jpg'),
(7, 'http://madride.net/wp-content/uploads/2015/04/Madrid-City-at-Night.jpg'),
(8, 'http://40.media.tumblr.com/tumblr_mdus9sxqAn1qb0bzxo1_1280.jpg'),
(9, 'http://www.exploringthebluemarble.com/wp-content/uploads/2011/02/avalong-bay-night-from-cata.jpg'),
(10, 'https://secure.parksandresorts.wdpromedia.com/resize/mwImage/1/630/354/90/wdpromedia.disney.go.com/media/wdpro-assets/dlr/parks-and-tickets/tours-and-experiences/california-story-tour/california-story-tour-00.jpg?12092014141620'),
(11, 'http://travelnoire.com/wp-content/uploads/2014/12/o-NEW-YORK-CITY-WRITER-facebook.jpg'),
(12, 'http://o.homedsgn.com/wp-content/uploads/2012/12/mercer-19-800x533.jpg'),
(13, 'http://cdnx.jetcdn.com/static/images/product/properties/1784/src-76446-1318442000.jpg'),
(14, 'https://lh3.googleusercontent.com/iIhOhUL_15nNUfvc5T_QzSrRCMLm-f35fPUKL2hprFLbLnkAG8YhaXSi8lCV37AKzOU2jYnX9Iy-1LEp60E720fKZyLbq9PEkL0=s325-c'),
(15, 'https://lh3.googleusercontent.com/6oaggFT4SHUhyQOyGJXTmij1KAZ29UZagh8iCjreu6g2632Guu4roL3qq4-cRxbVRRKv60PlKWePZm7QFn9oTpI3WwR3309yDQ=s325-c'),
(16, 'https://bakersfieldblonde.files.wordpress.com/2015/07/goodwp-com_28495.jpg');

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `SLIKE_IZLET`
--

CREATE TABLE IF NOT EXISTS `SLIKE_IZLET` (
  `idIzlet` int(11) NOT NULL,
  `idSlika` int(11) NOT NULL,
  PRIMARY KEY (`idIzlet`,`idSlika`),
  KEY `idSlika` (`idSlika`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Izbacivanje podataka za tablicu `SLIKE_IZLET`
--

INSERT INTO `SLIKE_IZLET` (`idIzlet`, `idSlika`) VALUES
(1, 10),
(3, 16);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `SLIKE_LOKACIJA`
--

CREATE TABLE IF NOT EXISTS `SLIKE_LOKACIJA` (
  `idLokacija` int(11) NOT NULL,
  `idSlika` int(11) NOT NULL,
  PRIMARY KEY (`idLokacija`,`idSlika`),
  KEY `idSlika` (`idSlika`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Izbacivanje podataka za tablicu `SLIKE_LOKACIJA`
--

INSERT INTO `SLIKE_LOKACIJA` (`idLokacija`, `idSlika`) VALUES
(2, 1),
(3, 7),
(4, 8),
(5, 9),
(7, 11);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `SLIKE_SMJESTAJ`
--

CREATE TABLE IF NOT EXISTS `SLIKE_SMJESTAJ` (
  `idSmjestaj` int(11) NOT NULL,
  `idSlika` int(11) NOT NULL,
  PRIMARY KEY (`idSmjestaj`,`idSlika`),
  KEY `idSlika` (`idSlika`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Izbacivanje podataka za tablicu `SLIKE_SMJESTAJ`
--

INSERT INTO `SLIKE_SMJESTAJ` (`idSmjestaj`, `idSlika`) VALUES
(1, 12),
(2, 13),
(3, 14),
(4, 15);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `SMJESTAJ`
--

CREATE TABLE IF NOT EXISTS `SMJESTAJ` (
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
-- Izbacivanje podataka za tablicu `SMJESTAJ`
--

INSERT INTO `SMJESTAJ` (`idSmjestaj`, `tip`, `opis`, `adresa`, `klasifikacija`, `idLokacija`, `idAkcija`) VALUES
(1, 1, 'In a historic building in Barcelona''s historic Gothic quarter, this upscale hotel is a 3-minute walk from the Jaume I metro station and 500 m from the Museu Picasso (art museum). \n\nOffering free Wi-Fi and minibars, the refined rooms also come with flat-screen TVs, designer toiletries and rainfall showerheads. Some have balconies and/or original wood beams or stone walls, while suites add amenities such as separate living rooms, bath tubs and desks. Room service is available.', 'Carrer dels Lledó', 5, 2, NULL),
(2, 1, 'A 5-minute walk from Passeig de Gràcia metro station, this sophisticated hotel is a 3-minute walk from Gaudi''s Casa Milà and 1.5 km from Sagrada Família church. \n\nThe contemporary rooms come with free Wi-Fi, flat-screen TVs and minibars. Upgraded rooms with city views are individually decorated. Suites add separate living areas, and there''s 1 with a balcony. Room service is available.', 'Carrer de Mallorc', 5, 2, NULL),
(3, 2, 'This apartment "Placa Espanya Romantic apartment" offers Terrace y HVAC. \nThe accommodation is just 1.4 km to the center away from Barcelona.\n', 'Sants-Montjuïc, Barcelona', 3, 2, NULL),
(4, 2, 'This apartment "SAGRADA FAMILIA WIFI" offers HVAC y Lift. \nThe accommodation is just 1.3 km to the center away from Barcelona.', 'Sant Marti, Barcelona', 4, 2, NULL);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `SMJESTAJ_REZERVACIJA`
--

CREATE TABLE IF NOT EXISTS `SMJESTAJ_REZERVACIJA` (
  `idSmjestajRezervacija` int(11) NOT NULL AUTO_INCREMENT,
  `tipRezervacije` int(11) NOT NULL,
  `idRezervirano` int(11) NOT NULL,
  `datumOd` date NOT NULL,
  `brojDana` int(11) NOT NULL,
  `brojOsoba` int(11) NOT NULL,
  `ukupnaCijena` decimal(10,0) NOT NULL,
  `idSmjestaj` int(11) NOT NULL,
  `idKupac` int(11) NOT NULL,
  PRIMARY KEY (`idSmjestajRezervacija`),
  KEY `idSmjestaj` (`idSmjestaj`),
  KEY `idKupac` (`idKupac`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `SOBA`
--

CREATE TABLE IF NOT EXISTS `SOBA` (
  `idSoba` int(11) NOT NULL AUTO_INCREMENT,
  `broj` int(11) NOT NULL,
  `velicina` float NOT NULL,
  `tip` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `cijenaPoDanu` float NOT NULL,
  `slobodna` tinyint(1) NOT NULL,
  `idSmjestaj` int(11) NOT NULL,
  PRIMARY KEY (`idSoba`),
  KEY `idSmjestaj` (`idSmjestaj`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=5 ;

--
-- Izbacivanje podataka za tablicu `SOBA`
--

INSERT INTO `SOBA` (`idSoba`, `broj`, `velicina`, `tip`, `cijenaPoDanu`, `slobodna`, `idSmjestaj`) VALUES
(1, 1, 30, 'Superior', 100, 1, 1),
(2, 2, 36, 'Deluxe', 90, 1, 1),
(3, 3, 43, 'Junior Suite', 120, 1, 1),
(4, 4, 95, 'Suite', 130, 1, 1);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `SOBA_REZERVACIJA`
--

CREATE TABLE IF NOT EXISTS `SOBA_REZERVACIJA` (
  `idSobaRezervacija` int(11) NOT NULL AUTO_INCREMENT,
  `idSoba` int(11) NOT NULL,
  `datum` date NOT NULL,
  PRIMARY KEY (`idSobaRezervacija`),
  KEY `idSoba` (`idSoba`),
  KEY `idSoba_2` (`idSoba`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=1 ;

--
-- Ograničenja za izbačene tablice
--

--
-- Ograničenja za tablicu `APARTMAN`
--
ALTER TABLE `APARTMAN`
  ADD CONSTRAINT `APARTMAN_ibfk_1` FOREIGN KEY (`idSmjestaj`) REFERENCES `SMJESTAJ` (`idSmjestaj`);

--
-- Ograničenja za tablicu `HOTEL`
--
ALTER TABLE `HOTEL`
  ADD CONSTRAINT `HOTEL_ibfk_1` FOREIGN KEY (`idSmjestaj`) REFERENCES `SMJESTAJ` (`idSmjestaj`);

--
-- Ograničenja za tablicu `HOTEL_NUDI`
--
ALTER TABLE `HOTEL_NUDI`
  ADD CONSTRAINT `HOTEL_NUDI_ibfk_1` FOREIGN KEY (`idSmjestaj`) REFERENCES `SMJESTAJ` (`idSmjestaj`),
  ADD CONSTRAINT `HOTEL_NUDI_ibfk_2` FOREIGN KEY (`idSadrzaj`) REFERENCES `SADRZAJ` (`idSadrzaj`);

--
-- Ograničenja za tablicu `IZLET`
--
ALTER TABLE `IZLET`
  ADD CONSTRAINT `IZLET_ibfk_1` FOREIGN KEY (`idLokacija`) REFERENCES `LOKACIJA` (`idLokacija`),
  ADD CONSTRAINT `IZLET_ibfk_2` FOREIGN KEY (`idAkcija`) REFERENCES `AKCIJA` (`idAkcija`);

--
-- Ograničenja za tablicu `IZLET_POLAZAK`
--
ALTER TABLE `IZLET_POLAZAK`
  ADD CONSTRAINT `IZLET_POLAZAK_ibfk_1` FOREIGN KEY (`idIzlet`) REFERENCES `IZLET` (`idIzlet`);

--
-- Ograničenja za tablicu `IZLET_REZERVACIJA`
--
ALTER TABLE `IZLET_REZERVACIJA`
  ADD CONSTRAINT `IZLET_REZERVACIJA_ibfk_1` FOREIGN KEY (`idIzlet`) REFERENCES `IZLET` (`idIzlet`),
  ADD CONSTRAINT `IZLET_REZERVACIJA_ibfk_2` FOREIGN KEY (`idKupac`) REFERENCES `KUPAC` (`idKupac`);

--
-- Ograničenja za tablicu `LOKACIJA`
--
ALTER TABLE `LOKACIJA`
  ADD CONSTRAINT `LOKACIJA_ibfk_1` FOREIGN KEY (`idDrzava`) REFERENCES `DRZAVA` (`idDrzava`);

--
-- Ograničenja za tablicu `SLIKE_IZLET`
--
ALTER TABLE `SLIKE_IZLET`
  ADD CONSTRAINT `SLIKE_IZLET_ibfk_1` FOREIGN KEY (`idIzlet`) REFERENCES `IZLET` (`idIzlet`),
  ADD CONSTRAINT `SLIKE_IZLET_ibfk_2` FOREIGN KEY (`idSlika`) REFERENCES `SLIKA` (`idSlika`);

--
-- Ograničenja za tablicu `SLIKE_LOKACIJA`
--
ALTER TABLE `SLIKE_LOKACIJA`
  ADD CONSTRAINT `SLIKE_LOKACIJA_ibfk_1` FOREIGN KEY (`idLokacija`) REFERENCES `LOKACIJA` (`idLokacija`),
  ADD CONSTRAINT `SLIKE_LOKACIJA_ibfk_2` FOREIGN KEY (`idSlika`) REFERENCES `SLIKA` (`idSlika`);

--
-- Ograničenja za tablicu `SLIKE_SMJESTAJ`
--
ALTER TABLE `SLIKE_SMJESTAJ`
  ADD CONSTRAINT `SLIKE_SMJESTAJ_ibfk_1` FOREIGN KEY (`idSmjestaj`) REFERENCES `SMJESTAJ` (`idSmjestaj`),
  ADD CONSTRAINT `SLIKE_SMJESTAJ_ibfk_2` FOREIGN KEY (`idSlika`) REFERENCES `SLIKA` (`idSlika`);

--
-- Ograničenja za tablicu `SMJESTAJ`
--
ALTER TABLE `SMJESTAJ`
  ADD CONSTRAINT `SMJESTAJ_ibfk_1` FOREIGN KEY (`idLokacija`) REFERENCES `LOKACIJA` (`idLokacija`),
  ADD CONSTRAINT `SMJESTAJ_ibfk_2` FOREIGN KEY (`idAkcija`) REFERENCES `AKCIJA` (`idAkcija`);

--
-- Ograničenja za tablicu `SMJESTAJ_REZERVACIJA`
--
ALTER TABLE `SMJESTAJ_REZERVACIJA`
  ADD CONSTRAINT `SMJESTAJ_REZERVACIJA_ibfk_1` FOREIGN KEY (`idSmjestaj`) REFERENCES `SMJESTAJ` (`idSmjestaj`),
  ADD CONSTRAINT `SMJESTAJ_REZERVACIJA_ibfk_2` FOREIGN KEY (`idKupac`) REFERENCES `KUPAC` (`idKupac`);

--
-- Ograničenja za tablicu `SOBA`
--
ALTER TABLE `SOBA`
  ADD CONSTRAINT `SOBA_ibfk_1` FOREIGN KEY (`idSmjestaj`) REFERENCES `SMJESTAJ` (`idSmjestaj`);

--
-- Ograničenja za tablicu `SOBA_REZERVACIJA`
--
ALTER TABLE `SOBA_REZERVACIJA`
  ADD CONSTRAINT `SOBA_REZERVACIJA_ibfk_1` FOREIGN KEY (`idSoba`) REFERENCES `SOBA` (`idSoba`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

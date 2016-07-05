-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Računalo: localhost
-- Vrijeme generiranja: Srp 05, 2016 u 01:19 PM
-- Verzija poslužitelja: 5.5.49-0ubuntu0.14.04.1
-- PHP verzija: 5.5.9-1ubuntu4.17

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
-- Tablična struktura za tablicu `akcija`
--

CREATE TABLE IF NOT EXISTS `akcija` (
  `idAkcija` int(11) NOT NULL AUTO_INCREMENT,
  `popust` decimal(10,2) NOT NULL,
  PRIMARY KEY (`idAkcija`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=2 ;

--
-- Izbacivanje podataka za tablicu `akcija`
--

INSERT INTO `akcija` (`idAkcija`, `popust`) VALUES
(1, 0.90);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `apartman`
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
-- Izbacivanje podataka za tablicu `apartman`
--

INSERT INTO `apartman` (`idSmjestaj`, `brojOsoba`, `brojSoba`, `cijenaPoDanu`, `naziv`) VALUES
(3, 4, 2, 50, 'Placa Espanya Apartman'),
(4, 4, 2, 55, 'Diagonal Apartman');

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `drzava`
--

CREATE TABLE IF NOT EXISTS `drzava` (
  `idDrzava` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`idDrzava`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=11 ;

--
-- Izbacivanje podataka za tablicu `drzava`
--

INSERT INTO `drzava` (`idDrzava`, `naziv`) VALUES
(1, 'Spain'),
(2, 'Switzerland'),
(3, 'USA'),
(4, 'Italy'),
(5, 'Austria'),
(6, 'New Zaeland'),
(7, 'England'),
(8, 'France'),
(9, 'Cuba'),
(10, 'Maldives');

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `hotel`
--

CREATE TABLE IF NOT EXISTS `hotel` (
  `idSmjestaj` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `kapacitetHotela` int(11) NOT NULL,
  `brojObroka` int(11) NOT NULL,
  PRIMARY KEY (`idSmjestaj`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=7 ;

--
-- Izbacivanje podataka za tablicu `hotel`
--

INSERT INTO `hotel` (`idSmjestaj`, `naziv`, `kapacitetHotela`, `brojObroka`) VALUES
(1, 'Mercer Hotel Barcelona', 500, 3),
(2, 'Alma Hotel Barcelona', 600, 3),
(5, 'Anneheim Majestic Garden Hotel', 500, 2),
(6, 'Hotel Bel-Air', 600, 3);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `hotel_nudi`
--

CREATE TABLE IF NOT EXISTS `hotel_nudi` (
  `idSmjestaj` int(11) NOT NULL,
  `idSadrzaj` int(11) NOT NULL,
  PRIMARY KEY (`idSmjestaj`,`idSadrzaj`),
  KEY `idSadrzaj` (`idSadrzaj`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Izbacivanje podataka za tablicu `hotel_nudi`
--

INSERT INTO `hotel_nudi` (`idSmjestaj`, `idSadrzaj`) VALUES
(1, 1),
(5, 1),
(6, 1),
(1, 2),
(5, 2),
(1, 3),
(6, 3),
(1, 4),
(6, 4),
(1, 5),
(6, 5),
(1, 6),
(5, 6),
(6, 6),
(5, 7),
(6, 7),
(5, 8),
(5, 10),
(5, 11);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `izlet`
--

CREATE TABLE IF NOT EXISTS `izlet` (
  `idIzlet` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `opis` varchar(1000) COLLATE utf8mb4_bin NOT NULL,
  `trajanje` int(11) NOT NULL,
  `cijenaPoOsobi` decimal(10,0) NOT NULL,
  `ukljucenVodic` int(1) NOT NULL,
  `ukljucenObrok` int(1) NOT NULL,
  `ukljuceneUlaznice` int(1) NOT NULL,
  `nazivKompanije` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `idLokacija` int(11) NOT NULL,
  `idAkcija` int(11) DEFAULT NULL,
  PRIMARY KEY (`idIzlet`),
  KEY `idLokacija` (`idLokacija`,`idAkcija`),
  KEY `idLokacija_2` (`idLokacija`),
  KEY `idAkcija` (`idAkcija`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=7 ;

--
-- Izbacivanje podataka za tablicu `izlet`
--

INSERT INTO `izlet` (`idIzlet`, `naziv`, `opis`, `trajanje`, `cijenaPoOsobi`, `ukljucenVodic`, `ukljucenObrok`, `ukljuceneUlaznice`, `nazivKompanije`, `idLokacija`, `idAkcija`) VALUES
(1, 'Disney California', 'Explore the Golden State’s vibrant history and see how its turn-of-the-century spirit influenced daring dreamers like Walt Disney. ', 8, 2000, 1, 1, 1, 'AmericaTours', 6, NULL),
(3, 'Cinque Terre jednodnevni izlet', 'Istražite talijanske rivijere kroz ovaj jednodnevni izlet na prekrasnom Cinque Terre iz Firence, uz osiguran prijevoz između svakog malog mjesta. Predvođeni lokalnim vodičem, otkrijte svako ribarskom selo autobusom, vlakom i brodom, od plaže Monterosso do šarmantnih ulica Riomaggiore. Imat ćete priliku za kupanje u tirkiznom moru te uživanje u tradicionalnom talijanskom ručku. Uživajte u svim lokacijama uključenim u ovu UNESCO-regiju prije povratka natrag u Firencu.', 13, 100, 1, 1, 2, 'Viator', 8, 1),
(4, 'Barcelona - pogled na grad i obalu', 'Pogledajte predivni grad Barcelonu iz jedinstvene perspektive u 12 minuta leta u helikopteru. Lebdjeti nad legendarnim znamenitostima kao što su La Sagrada Familia i park Guell pruža jedinstvenu priliku koju jednostavno morate isprobati. Uživajte u pogledu iz ptičje perspektive na razne spomenike kao što su Olimpijske Prsten i Torre Agbar. Ovaj jedinstveni i nezaboravan izlet je primamljiva alternativa gužve i dugih linija konvencionalnog razgledavanja.', 1, 100, 1, 2, 2, 'Viator', 2, NULL),
(5, 'Hobbiton™ filmski set', 'Experience the real Middle-Earth with a visit to the Hobbiton™ Movie Set, the bucolic setting for The Shire™ that featured in the Peter Jackson directed films, The Lord of the Rings and The Hobbit Trilogies.\r\n\r\nYour tour starts with a drive through the picturesque 1,250 acre sheep farm with spectacular views across to the Kaimai Ranges. Your guide will escort you through the twelve acre site recounting fascinating details of how the Hobbiton Movie set was created.', 4, 50, 1, 1, 1, 'Hobbiton', 14, 1),
(6, 'Universal Studios Florida', 'Go behind the scenes, beyond the screen, and jump right into the action of your favorite movies at Universal Studios®, the world''s premier movie and TV based theme park. \r\n\r\nUnforgettable thrills and magical experiences await at The Wizarding World of Harry Potter™ - Diagon Alley™, at Universal Orlando® Resort. Dine at the Leaky Cauldron™, shop at Weasleys’ Wizard Wheezes, and get ready for an adventure on the multi-dimensional thrill ride, Harry Potter and the Escape from Gringotts™. Plus, travel to The Wizarding World of Harry Potter™ - Hogsmeade™ on the Hogwarts™ Express*. ', 6, 80, 1, 2, 1, 'Universal d.o.o.', 3, 1);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `izlet_polazak`
--

CREATE TABLE IF NOT EXISTS `izlet_polazak` (
  `idIzletPolazak` int(11) NOT NULL AUTO_INCREMENT,
  `idIzlet` int(11) NOT NULL,
  `vrijemePolazak` datetime NOT NULL,
  `slobodnoMjesta` int(11) NOT NULL DEFAULT '30',
  PRIMARY KEY (`idIzletPolazak`),
  KEY `idIzlet` (`idIzlet`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=13 ;

--
-- Izbacivanje podataka za tablicu `izlet_polazak`
--

INSERT INTO `izlet_polazak` (`idIzletPolazak`, `idIzlet`, `vrijemePolazak`, `slobodnoMjesta`) VALUES
(1, 3, '2016-07-07 07:00:00', 25),
(2, 3, '2016-07-08 07:00:00', 18),
(3, 3, '2016-07-09 07:00:00', 28),
(4, 3, '2016-07-10 07:00:00', 30),
(5, 4, '2016-06-20 11:00:00', 30),
(6, 4, '2016-06-21 11:00:00', 26),
(7, 5, '2016-06-15 08:00:00', 26),
(8, 5, '2016-06-16 08:00:00', 30),
(11, 6, '2016-06-20 08:00:00', 17),
(12, 6, '2016-06-21 08:00:00', 20);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `izlet_rezervacija`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=12 ;

--
-- Izbacivanje podataka za tablicu `izlet_rezervacija`
--

INSERT INTO `izlet_rezervacija` (`idIzletRezervacija`, `brojOsoba`, `ukupnaCijena`, `idIzlet`, `idIzletPolazak`, `idKupac`) VALUES
(1, 2, 200.00, 3, 1, 1),
(2, 4, 400.00, 3, 2, 4),
(3, 3, 300.00, 3, 2, 6),
(4, 2, 180.00, 3, 2, 1),
(5, 2, 180.00, 3, 3, 1),
(6, 3, 270.00, 3, 2, 1),
(7, 3, 216.00, 6, 11, 1),
(8, 2, 90.00, 5, 7, 1),
(9, 2, 90.00, 5, 7, 1),
(10, 3, 270.00, 3, 1, 1),
(11, 4, 400.00, 4, 6, 1);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `kupac`
--

CREATE TABLE IF NOT EXISTS `kupac` (
  `idKupac` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `prezime` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `e_mail` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `godinaRodjenja` int(11) NOT NULL,
  `kontakt` int(11) NOT NULL,
  PRIMARY KEY (`idKupac`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=9 ;

--
-- Izbacivanje podataka za tablicu `kupac`
--

INSERT INTO `kupac` (`idKupac`, `ime`, `prezime`, `e_mail`, `godinaRodjenja`, `kontakt`) VALUES
(1, 'Goran', 'Brlas', 'goran.brlas@gmail.com', 1995, 996777919),
(4, 'Antonija', 'Vrdoljak', 'ata_os@hotmail.com', 1994, 998166372),
(5, 'Ivana', 'Vrdoljak', 'antonija.vrdoljak94@gmail.com', 1994, 996706433),
(6, 'Antonija', 'Vrdoljak', 'antonija.vrdoljak94@gmail.com', 1994, 996706433),
(7, 'Klara', 'Horvat', 'klara.horvat90@gmail.com', 1990, 990456802),
(8, 'Goran', 'Brlas', 'goran.brlas@gmail.com', 1995, 1);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `lokacija`
--

CREATE TABLE IF NOT EXISTS `lokacija` (
  `idLokacija` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `opis` varchar(1000) COLLATE utf8mb4_bin NOT NULL,
  `tip` int(11) NOT NULL,
  `idDrzava` int(11) NOT NULL,
  `pregledi` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idLokacija`),
  KEY `idDrzava` (`idDrzava`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=22 ;

--
-- Izbacivanje podataka za tablicu `lokacija`
--

INSERT INTO `lokacija` (`idLokacija`, `ime`, `opis`, `tip`, `idDrzava`, `pregledi`) VALUES
(2, 'Barcelona, Španjolska', 'Osnovan kao rimski grad, u srednjem vijeku Barcelona je postala glavni grad županije Barcelone. Nakon spajanja s Kraljevinom Aragon, Barcelona i dalje ostaje ekonomski važan grad te administrativno središte i glavni grad kneževine Katalonije. Opkoljen nekoliko puta tijekom svoje povijesti, Barcelona ima bogatu kulturnu baštinu, a danas je važno kulturno središte i glavna turistička destinacija Španjolske. Posebno poznata su arhitektonska djela Antonia Gaudía i Lluisa Domènecha, koja su danas dio UNESCO-ve Svjetske baštine. Sjedište Unije za Mediteran nalazi se u Barceloni. Grad je poznat po održavanju Olimpijskih igara 1992., kao i  konferencijama i izložbama svjetske klase. Grad je također poznat i po mnogim međunarodnim sportskim natjecanjima, kao i po najboljem nogometnom klubu 21. stoljeća, FC Barceloni.', 3, 1, 58),
(3, 'Madrid, Španjolska', 'The city is located on the Manzanares River in the centre of both the country and the Community of Madrid (which comprises the city of Madrid, its conurbation and extended suburbs and villages); this community is bordered by the autonomous communities of Castile and León and Castile-La Mancha. As the capital city of Spain, seat of government, and residence of the Spanish monarch, Madrid is also the political, economic and cultural centre of Spain. The current mayor is Manuela Carmena from Ahora Madrid.', 3, 1, 5),
(4, 'Murren, Švicarska', 'Mürren is a traditional Walser mountain village in Bernese Oberland, Switzerland, at an elevation of 1,650 m (5,413 ft.) above sea level and unreachable by public road. Tourism is popular through the summer and winter; the village features a view of the three towering mountains: Eiger, Mönch, and Jungfrau. Mürren has a population of just 450, but has 2,000 hotel beds.\r\n\r\nMürren has its own school and two churches, one Reformed and one Roman Catholic.', 2, 2, 2),
(5, 'Santa Catalina Island, SAD', 'Santa Catalina Island, often called Catalina Island, or just Catalina, is a rocky island off the coast of the U.S. state of California in the Gulf of Santa Catalina. The island is 22 miles (35 km) long and 8 miles (13 km) across at its greatest width. The island is located about 22 miles (35 km) south-southwest of Los Angeles, California. The highest point on the island is 2,097 feet (639 m) Mt. Orizaba. Santa Catalina is part of the Channel Islands of California archipelago and lies within Los Angeles County.', 1, 3, 2),
(6, 'Disneyland Resort', 'Disneyland resort.', 5, 3, 0),
(7, 'New York City, SAD', 'The City of New York, often called New York City or simply New York, is the most populous city in the United States. Located at the southern tip of the State of New York, the city is the center of the New York metropolitan area, one of the most populous urban agglomerations in the world. A global power city, New York City exerts a significant impact upon commerce, finance, media, art, fashion, research, technology, education, and entertainment, its fast pace defining the term New York minute. Home to the headquarters of the United Nations, New York is an important center for international diplomacy and has been described as the cultural and financial capital of the world.', 3, 3, 1),
(8, 'Italian Riviera', 'Italian Riviera', 5, 4, 0),
(9, 'Schladming, Austrija', 'From Dachstein''s grand south walls all the way to Schladminger Tauern, seven tourism centres impress their visitors with a broad range of offers, famed Styrian hospitality, accommodation of every type and an original rustic charm.', 2, 5, 0),
(10, 'Obertauern, Austrija', 'The perfect holiday experience has never been so close: Unlimited fun on the slopes, rustic cosiness, breathtaking views and nights you don''t regret sleeping in after – with so much variety everyone will find their perfect place to always return to. Or in other words: their very personal Obertauern.', 2, 5, 7),
(11, 'Kronplatz, Italija', 'Smješten u prekrasnoj Pustertal dolini, Kronplatz mnogi smatraju skijalištem broj 1 u južnom Tirolu. Ono je također i popularna ljetna destinacija za obitelji, planre, bicikliste i sve one koji vole kulturu i opuštanje u prekrasnom ambijentu. Jedan dan na padinama u Kronplatzu stvarno nudi sve što bi čovjek mogao poželjeti na odmoru. Ova moćna planina između Bruneck-Brunica, St. Vigil-San Viglioa i Valdaora-Olang ima 32 vrhunska dizala posluživanje te 116 km staza prilagođenih za sve; od početnika do vrhunskih skijaša.', 2, 4, 3),
(12, 'St. Moritz, Švicarska', 'If you’re looking for a well-heeled ski vacation, few resorts can top St. Moritz’s famed prestige. The resort is truly the No. 1 winter playground of the international jet set. The St. Moritz village is situated at the center of the elongated Engadin valley, which the Inn River passes through. Like most resorts located in the Swiss Alps, you can bet that St. Moritz offers dizzying views of dramatic mountain peaks. The base area is divided into St. Moritz Bad, which is a better locale to access the lifts, and St. Moritz Dorf, which features an elegant shopping village.', 2, 2, 1),
(13, 'Aspen, SAD', 'Bilo gdje drugdje, ovakva lokacija bi se mogla smatrati kao odvojena 4 odmora, ali ne u Aspenu, gdje će skijaši moći uživati u preko 2100 hektara zemljišta između Snowmassa, Aspen planina (Ajax), Aspen Highlandsa te Buttermilka. Također valja spomenuti beskrajna blagovanja, noćni život te shopping po kojem je Aspen poznati. Ova zimska idila pruža i više nego dovoljno razloga da posjetite jedan od najpoznatijih svjetskih skijališta. Nema boljeg vremena za iskusiti tzv. "The Power of Four."', 2, 3, 0),
(14, 'Hobbiton', 'Hobbiton', 5, 6, 0),
(15, 'Los Angeles, SAD', 'Rastući grad Los Angeles, u južnoj Kaliforniji, jedan je od najpoznatijih gradova u SAD-u. Svijetu je uglavnom poznat po filmskoj i zabavnoj industriji Hollywood, koja postoji već gotovo cijelo stoljeće. Topla klima i plaže su još jedan od gradskih velikih prodajnih točki, uz obližnju Venice Beach koja nudi uživanje u moru i suncu kao nijedna druga plaža. LA također ima bogatstvo kulturnih atrakcija i važnih muzeja, uključujući i Jean Paul Getty Museum. Jedan od najvažnijih jedinstvenih lokacija je Le Brea Tar Pits, gdje se nalaze fosili stari od 10.000 do 40.000 godina. Bogatstvo stvari za vidjeti i raditi u LA čine ga savršenim za kratki bijeg iz svakodnevnog života, u bilo koje doba godine.', 3, 3, 31),
(16, 'London, UK', 'Britanski glavni grad je centar umjetnosti i zabave (njegove kazališta su uvijek ispunjena), i 50 godina nakon Beatlesa, glazbena scena i dalje rastura. London također ima jednu od najvećih koncentracija svjetskih kulturnih atrakcija. Iz kraljevske palače do Narodnog parlamenta, od rimskih ruševina tvrđava i katedrala, možete potrošiti beskrajne dane istražujući stranice koje je ispisivala londonska povijest bez da vam ponestane jedinstvenih stvari za vidjeti i učiniti.', 3, 7, 0),
(17, 'Paris, Francuska', 'Paris, France''s capital, is a major European city and a global center for art, fashion, gastronomy and culture. Its picturesque 19th-century cityscape is crisscrossed by wide boulevards and the River Seine. Beyond such landmarks as the Eiffel Tower and the 12th-century, Gothic Notre-Dame cathedral, the city is known for its cafe culture, and designer boutiques along the Rue du Faubourg Saint-Honoré.', 3, 8, 0),
(18, 'Hawaii, SAD', 'Havaji, jedna od država SAD-a, je izoliran vulkanski arhipelag u Srednjem Pacifiku. Njegovi otoci su poznati po svojim nepristupačnim krajolicima, stijenama, slapovima, tropskim lišćem te  plažama sa zlatnim, crvenim, crnim, pa čak i zelenim pijeskom. Od 6 glavnih otoka, Oahu ima jedini havajski veliki grad, Honolulu, dom plaže Waikiki i memorijala na Pearl Harbor.', 1, 3, 1),
(19, 'Havana, Kuba', 'Kuba, veliki karipski otok pod komunističkom vladavinom, poznat je po svojim bijelo-pješčanim plažama, cigarama i rumu. Njezin glavni grad, Havana, ima dobro očuvanu španjolsku kolonijalnu arhitekturu unutar svoje jezgre iz 16. stoljeća.\r\n\r\nZvukovi salse izlaze iz gradskih plesnih klubova i kabare predstave se izvode se svakodnevno u poznatoj Tropicani.', 1, 9, 3),
(20, 'Maldivi', 'The Maldives is a tropical nation in the Indian Ocean composed of 26 coral atolls, which are made up of hundreds of islands. It’s known for its beaches, blue lagoons and extensive reefs. The capital, Malé, has a busy fish market, restaurants and shops on Majeedhee Magu and 17th-century Hukuru Miskiy (also known as Old Friday Mosque) made of coral stone.', 1, 10, 1),
(21, 'Ibiza, Balearski otoci', 'Ibiza is one of the Balearic islands in the Mediterranean Sea. It''s well-known for the lively nightlife scene in Ibiza Town and Sant Antoni, where major European nightclubs have summer outposts. It’s also home to quiet villages, yoga retreats and beaches, from Platja d''en Bossa, lined with hotels, bars and shops, to quieter sandy coves backed by pine-clad hills found all around the coastline.', 1, 1, 0);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `sadrzaj`
--

CREATE TABLE IF NOT EXISTS `sadrzaj` (
  `idSadrzaj` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`idSadrzaj`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=12 ;

--
-- Izbacivanje podataka za tablicu `sadrzaj`
--

INSERT INTO `sadrzaj` (`idSadrzaj`, `naziv`) VALUES
(1, 'Chic restoran'),
(2, 'Kafić/bar'),
(3, 'Vrt i terasa'),
(4, 'Sauna'),
(5, 'Bazen'),
(6, 'Fitness centar'),
(7, 'Vrtovi sa dvorištem'),
(8, 'Fontane'),
(10, 'Obiteljska soba za igre'),
(11, 'Soba za biljar');

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `slika`
--

CREATE TABLE IF NOT EXISTS `slika` (
  `idSlika` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(1000) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`idSlika`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=69 ;

--
-- Izbacivanje podataka za tablicu `slika`
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
(24, 'madrid4.jpg'),
(25, 'barcelonatour.jpg'),
(26, 'schladming.jpg'),
(27, 'obertauern.jpg'),
(28, 'kronplatz.jpg'),
(29, 'kronplatz2.jpg'),
(30, 'moritz1.jpg'),
(31, 'moritz2.jpg'),
(32, 'aspen1.jpg'),
(33, 'aspen2.jpg'),
(34, 'hobbiton1.jpg'),
(35, 'hobbiton2.jpg'),
(36, 'hobbiton3.jpg'),
(37, 'universal1.jpg'),
(38, 'universal2.jpg'),
(39, 'universal3.jpg'),
(40, 'la1.jpg'),
(41, 'la2.jpg'),
(42, 'la3.jpg'),
(43, 'la4.jpg'),
(44, 'london1.jpg'),
(45, 'london2.jpg'),
(46, 'london3.jpg'),
(47, 'london4.jpg'),
(48, 'paris1.jpg'),
(49, 'paris2.jpg'),
(50, 'paris3.jpg'),
(51, 'paris4.jpg'),
(52, 'hawaii1.jpg'),
(53, 'hawaii2.jpg'),
(54, 'hawaii3.jpg'),
(55, 'havana1.jpg'),
(56, 'havana2.jpg'),
(57, 'maldivi1.jpg'),
(58, 'maldivi2.jpg'),
(59, 'maldivi3.jpg'),
(60, 'ibiza1.jpg'),
(61, 'ibiza2.jpg'),
(62, 'ibiza3.jpg'),
(63, 'ibiza4.jpg'),
(64, 'anneheim.jpg'),
(65, 'anneheim2.jpg'),
(66, 'belair.jpg'),
(67, 'belair2.jpg'),
(68, 'belair3.jpg');

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `slike_izlet`
--

CREATE TABLE IF NOT EXISTS `slike_izlet` (
  `idIzlet` int(11) NOT NULL,
  `idSlika` int(11) NOT NULL,
  PRIMARY KEY (`idIzlet`,`idSlika`),
  KEY `idSlika` (`idSlika`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Izbacivanje podataka za tablicu `slike_izlet`
--

INSERT INTO `slike_izlet` (`idIzlet`, `idSlika`) VALUES
(1, 10),
(3, 16),
(4, 19),
(3, 21),
(4, 25),
(5, 34),
(5, 35),
(5, 36),
(6, 37),
(6, 38),
(6, 39);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `slike_lokacija`
--

CREATE TABLE IF NOT EXISTS `slike_lokacija` (
  `idLokacija` int(11) NOT NULL,
  `idSlika` int(11) NOT NULL,
  PRIMARY KEY (`idLokacija`,`idSlika`),
  KEY `idSlika` (`idSlika`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Izbacivanje podataka za tablicu `slike_lokacija`
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
(3, 24),
(9, 26),
(10, 27),
(11, 28),
(11, 29),
(12, 30),
(12, 31),
(13, 32),
(13, 33),
(15, 40),
(15, 41),
(15, 42),
(15, 43),
(16, 44),
(16, 45),
(16, 46),
(16, 47),
(17, 48),
(17, 49),
(17, 50),
(17, 51),
(18, 52),
(18, 53),
(18, 54),
(19, 55),
(19, 56),
(20, 57),
(20, 58),
(20, 59),
(21, 60),
(21, 61),
(21, 62),
(21, 63);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `slike_smjestaj`
--

CREATE TABLE IF NOT EXISTS `slike_smjestaj` (
  `idSmjestaj` int(11) NOT NULL,
  `idSlika` int(11) NOT NULL,
  PRIMARY KEY (`idSmjestaj`,`idSlika`),
  KEY `idSlika` (`idSlika`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Izbacivanje podataka za tablicu `slike_smjestaj`
--

INSERT INTO `slike_smjestaj` (`idSmjestaj`, `idSlika`) VALUES
(1, 12),
(2, 13),
(3, 14),
(4, 15),
(1, 20),
(5, 64),
(5, 65),
(6, 66),
(6, 67),
(6, 68);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `smjestaj`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=7 ;

--
-- Izbacivanje podataka za tablicu `smjestaj`
--

INSERT INTO `smjestaj` (`idSmjestaj`, `tip`, `opis`, `adresa`, `klasifikacija`, `idLokacija`, `idAkcija`) VALUES
(1, 1, 'In a historic building in Barcelona''s historic Gothic quarter, this upscale hotel is a 3-minute walk from the Jaume I metro station and 500 m from the Museu Picasso (art museum). \n\nOffering free Wi-Fi and minibars, the refined rooms also come with flat-screen TVs, designer toiletries and rainfall showerheads. Some have balconies and/or original wood beams or stone walls, while suites add amenities such as separate living rooms, bath tubs and desks. Room service is available.', 'Carrer dels Lledó', 5, 2, 1),
(2, 1, 'A 5-minute walk from Passeig de Gràcia metro station, this sophisticated hotel is a 3-minute walk from Gaudi''s Casa Milà and 1.5 km from Sagrada Família church. \n\nThe contemporary rooms come with free Wi-Fi, flat-screen TVs and minibars. Upgraded rooms with city views are individually decorated. Suites add separate living areas, and there''s 1 with a balcony. Room service is available.', 'Carrer de Mallorc', 5, 2, NULL),
(3, 2, 'This apartment "Placa Espanya Romantic apartment" offers Terrace y HVAC. \nThe accommodation is just 1.4 km to the center away from Barcelona.\n', 'Sants-Montjuïc, Barcelona', 3, 2, NULL),
(4, 2, 'This apartment "SAGRADA FAMILIA WIFI" offers HVAC y Lift. \nThe accommodation is just 1.3 km to the center away from Barcelona.', 'Sant Marti, Barcelona', 4, 2, 1),
(5, 1, 'In the overwhelming world of Anaheim hotels, there’s one escape that’s the ideal base camp for your Disneyland® Resort adventures: the castle-themed Majestic Garden Hotel. The crown jewel of theme parks is just a half-mile away on our free Dream Machine shuttle and Disneyland® Resort Park Hopper®. Beyond the castle entry, you’ll find Anaheim’s largest rooms (averaging almost 500 square feet), a pool, bar, restaurant, and 13 acres of tranquil gardens, ideal havens for unwinding from a day of Disneyland® Park fun.', '900 South Disneyland Drive, Anaheim, CA 92802 ', 5, 15, NULL),
(6, 1, 'Smješten u 5 hektara uređenih vrtova nalazi se naš prekrasan hotel, gdje neke od svjetskih najslavnijih ličnosti dolaze na opuštanje i pomlađivanje u stilu. Samo nekoliko minuta od Beverly Hills i Los Angelesvih najpoznatijih atrakcija, Hotel Bel-Air slovi kao jedan od najljepših hotela na svijetu.Bit će tretirani kao kraljevi za vrijeme vašeg boravka i naše prelijepe sobe osigurat će vam pravu ekstravaganciju boravka u jednom od najboljih luksuznih hotela u Los Angelesu. Hotel Bel-Air osvojio je velik broj pohvala za besprijekornu uslugu, luksuzno opremljene sobe i šarmantan ugođaj. Naš stručni tim pobrinut će se da vaš boravak bude što ugodniji i nezaboravniji.', '701 Stone Canyon Road, CA', 5, 15, NULL);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `smjestaj_rezervacija`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=33 ;

--
-- Izbacivanje podataka za tablicu `smjestaj_rezervacija`
--

INSERT INTO `smjestaj_rezervacija` (`idSmjestajRezervacija`, `tipRezervacije`, `idRezervirano`, `datumOd`, `brojDana`, `ukupnaCijena`, `idSmjestaj`, `idKupac`) VALUES
(6, 1, 1, '2016-07-12', 2, 200.00, 1, 1),
(7, 1, 4, '2016-05-15', 4, 520.00, 1, 1),
(8, 2, 6, '2016-07-12', 5, 275.00, 4, 1),
(9, 1, 1, '2016-05-15', 8, 800.00, 1, 5),
(10, 2, 6, '2016-06-09', 4, 220.00, 4, 1),
(13, 2, 6, '2016-05-15', 5, 247.50, 4, 1),
(17, 2, 6, '2016-05-15', 5, 247.50, 4, 1),
(18, 1, 2, '2016-05-15', 2, 162.00, 1, 1),
(19, 1, 2, '2016-05-14', 1, 81.00, 1, 1),
(20, 1, 7, '2016-05-14', 7, 840.00, 5, 7),
(21, 1, 4, '2016-08-12', 8, 936.00, 1, 1),
(22, 1, 10, '2016-07-20', 4, 1200.00, 6, 1),
(23, 2, 5, '2016-07-13', 2, 100.00, 3, 1),
(24, 2, 5, '2016-07-13', 2, 100.00, 3, 1),
(25, 1, 14, '2016-08-15', 5, 2500.00, 6, 1),
(26, 1, 14, '2016-08-15', 5, 2500.00, 6, 1),
(27, 1, 14, '2016-08-15', 5, 2500.00, 6, 1),
(28, 1, 2, '2016-07-21', 9, 729.00, 1, 1),
(29, 1, 2, '2016-07-21', 9, 729.00, 1, 1),
(30, 1, 12, '2016-07-23', 4, 1600.00, 6, 1),
(31, 1, 2, '2016-07-26', 4, 324.00, 1, 1),
(32, 1, 1, '2016-06-26', 6, 540.00, 1, 1);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `soba`
--

CREATE TABLE IF NOT EXISTS `soba` (
  `idSoba` int(11) NOT NULL AUTO_INCREMENT,
  `velicina` float NOT NULL,
  `tip` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `cijenaPoDanu` float NOT NULL,
  `brojSlobodnih` int(1) NOT NULL,
  `brojOsoba` int(11) NOT NULL,
  `idSmjestaj` int(11) NOT NULL,
  PRIMARY KEY (`idSoba`),
  KEY `idSmjestaj` (`idSmjestaj`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=16 ;

--
-- Izbacivanje podataka za tablicu `soba`
--

INSERT INTO `soba` (`idSoba`, `velicina`, `tip`, `cijenaPoDanu`, `brojSlobodnih`, `brojOsoba`, `idSmjestaj`) VALUES
(1, 30, 'Superior soba', 100, 40, 2, 1),
(2, 36, 'Deluxe soba', 90, 50, 3, 1),
(3, 43, 'Junior soba', 120, 20, 3, 1),
(4, 95, 'Predsjednička soba', 130, 10, 4, 1),
(5, 30, 'Apartman soba', 50, 2, 2, 3),
(6, 35, 'Aparmtan soba', 55, 2, 2, 4),
(7, 40, 'Dvorac/bunker', 120, 100, 4, 5),
(8, 40, 'Standardna soba', 110, 350, 4, 5),
(9, 50, 'Dvorska soba', 140, 50, 5, 5),
(10, 42, 'Deluxe soba', 300, 200, 2, 6),
(11, 50, 'Canyon soba', 280, 50, 4, 6),
(12, 60, 'Loft soba', 400, 50, 4, 6),
(13, 61, 'Junior soba', 250, 200, 5, 6),
(14, 118, 'Dvokrevetna deluxe soba', 500, 50, 6, 6),
(15, 70, 'Swan Lake soba', 350, 50, 4, 6);

-- --------------------------------------------------------

--
-- Tablična struktura za tablicu `soba_rezervacija`
--

CREATE TABLE IF NOT EXISTS `soba_rezervacija` (
  `idSobaRezervacija` int(11) NOT NULL AUTO_INCREMENT,
  `idSoba` int(11) NOT NULL,
  `datum` date NOT NULL,
  `slobodno` int(11) NOT NULL,
  PRIMARY KEY (`idSobaRezervacija`),
  KEY `idSoba` (`idSoba`),
  KEY `idSoba_2` (`idSoba`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=84 ;

--
-- Izbacivanje podataka za tablicu `soba_rezervacija`
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
(37, 2, '2016-05-16', 49),
(38, 2, '2016-05-14', 49),
(39, 7, '2016-05-14', 99),
(40, 7, '2016-05-15', 99),
(41, 7, '2016-05-16', 99),
(42, 7, '2016-05-17', 99),
(43, 7, '2016-05-18', 99),
(44, 7, '2016-05-19', 99),
(45, 7, '2016-05-20', 99),
(46, 4, '2016-08-12', 9),
(47, 4, '2016-08-13', 9),
(48, 4, '2016-08-14', 9),
(49, 4, '2016-08-15', 9),
(50, 4, '2016-08-16', 9),
(51, 4, '2016-08-17', 9),
(52, 4, '2016-08-18', 9),
(53, 4, '2016-08-19', 9),
(54, 10, '2016-07-20', 199),
(55, 10, '2016-07-21', 199),
(56, 10, '2016-07-22', 199),
(57, 10, '2016-07-23', 199),
(58, 5, '2016-07-13', 0),
(59, 5, '2016-07-14', 0),
(60, 14, '2016-08-15', 47),
(61, 14, '2016-08-16', 47),
(62, 14, '2016-08-17', 47),
(63, 14, '2016-08-18', 47),
(64, 14, '2016-08-19', 47),
(65, 2, '2016-07-21', 48),
(66, 2, '2016-07-22', 48),
(67, 2, '2016-07-23', 48),
(68, 2, '2016-07-24', 48),
(69, 2, '2016-07-25', 48),
(70, 2, '2016-07-26', 47),
(71, 2, '2016-07-27', 47),
(72, 2, '2016-07-28', 47),
(73, 2, '2016-07-29', 47),
(74, 12, '2016-07-23', 49),
(75, 12, '2016-07-24', 49),
(76, 12, '2016-07-25', 49),
(77, 12, '2016-07-26', 49),
(78, 1, '2016-06-26', 39),
(79, 1, '2016-06-27', 39),
(80, 1, '2016-06-28', 39),
(81, 1, '2016-06-29', 39),
(82, 1, '2016-06-30', 39),
(83, 1, '2016-07-01', 39);

--
-- Ograničenja za izbačene tablice
--

--
-- Ograničenja za tablicu `apartman`
--
ALTER TABLE `apartman`
  ADD CONSTRAINT `APARTMAN_ibfk_1` FOREIGN KEY (`idSmjestaj`) REFERENCES `smjestaj` (`idSmjestaj`);

--
-- Ograničenja za tablicu `hotel`
--
ALTER TABLE `hotel`
  ADD CONSTRAINT `HOTEL_ibfk_1` FOREIGN KEY (`idSmjestaj`) REFERENCES `smjestaj` (`idSmjestaj`);

--
-- Ograničenja za tablicu `hotel_nudi`
--
ALTER TABLE `hotel_nudi`
  ADD CONSTRAINT `HOTEL_NUDI_ibfk_1` FOREIGN KEY (`idSmjestaj`) REFERENCES `smjestaj` (`idSmjestaj`),
  ADD CONSTRAINT `HOTEL_NUDI_ibfk_2` FOREIGN KEY (`idSadrzaj`) REFERENCES `sadrzaj` (`idSadrzaj`);

--
-- Ograničenja za tablicu `izlet`
--
ALTER TABLE `izlet`
  ADD CONSTRAINT `IZLET_ibfk_1` FOREIGN KEY (`idLokacija`) REFERENCES `lokacija` (`idLokacija`) ON UPDATE CASCADE,
  ADD CONSTRAINT `IZLET_ibfk_2` FOREIGN KEY (`idAkcija`) REFERENCES `akcija` (`idAkcija`) ON UPDATE CASCADE;

--
-- Ograničenja za tablicu `izlet_polazak`
--
ALTER TABLE `izlet_polazak`
  ADD CONSTRAINT `IZLET_POLAZAK_ibfk_1` FOREIGN KEY (`idIzlet`) REFERENCES `izlet` (`idIzlet`);

--
-- Ograničenja za tablicu `izlet_rezervacija`
--
ALTER TABLE `izlet_rezervacija`
  ADD CONSTRAINT `IZLET_REZERVACIJA_ibfk_1` FOREIGN KEY (`idIzlet`) REFERENCES `izlet` (`idIzlet`),
  ADD CONSTRAINT `IZLET_REZERVACIJA_ibfk_2` FOREIGN KEY (`idKupac`) REFERENCES `kupac` (`idKupac`),
  ADD CONSTRAINT `IZLET_REZERVACIJA_ibfk_3` FOREIGN KEY (`idIzletPolazak`) REFERENCES `izlet_polazak` (`idIzletPolazak`);

--
-- Ograničenja za tablicu `lokacija`
--
ALTER TABLE `lokacija`
  ADD CONSTRAINT `LOKACIJA_ibfk_1` FOREIGN KEY (`idDrzava`) REFERENCES `drzava` (`idDrzava`);

--
-- Ograničenja za tablicu `slike_izlet`
--
ALTER TABLE `slike_izlet`
  ADD CONSTRAINT `SLIKE_IZLET_ibfk_1` FOREIGN KEY (`idIzlet`) REFERENCES `izlet` (`idIzlet`),
  ADD CONSTRAINT `SLIKE_IZLET_ibfk_2` FOREIGN KEY (`idSlika`) REFERENCES `slika` (`idSlika`);

--
-- Ograničenja za tablicu `slike_lokacija`
--
ALTER TABLE `slike_lokacija`
  ADD CONSTRAINT `SLIKE_LOKACIJA_ibfk_1` FOREIGN KEY (`idLokacija`) REFERENCES `lokacija` (`idLokacija`),
  ADD CONSTRAINT `SLIKE_LOKACIJA_ibfk_2` FOREIGN KEY (`idSlika`) REFERENCES `slika` (`idSlika`);

--
-- Ograničenja za tablicu `slike_smjestaj`
--
ALTER TABLE `slike_smjestaj`
  ADD CONSTRAINT `SLIKE_SMJESTAJ_ibfk_1` FOREIGN KEY (`idSmjestaj`) REFERENCES `smjestaj` (`idSmjestaj`),
  ADD CONSTRAINT `SLIKE_SMJESTAJ_ibfk_2` FOREIGN KEY (`idSlika`) REFERENCES `slika` (`idSlika`);

--
-- Ograničenja za tablicu `smjestaj`
--
ALTER TABLE `smjestaj`
  ADD CONSTRAINT `SMJESTAJ_ibfk_1` FOREIGN KEY (`idLokacija`) REFERENCES `lokacija` (`idLokacija`),
  ADD CONSTRAINT `SMJESTAJ_ibfk_2` FOREIGN KEY (`idAkcija`) REFERENCES `akcija` (`idAkcija`);

--
-- Ograničenja za tablicu `smjestaj_rezervacija`
--
ALTER TABLE `smjestaj_rezervacija`
  ADD CONSTRAINT `SMJESTAJ_REZERVACIJA_ibfk_1` FOREIGN KEY (`idSmjestaj`) REFERENCES `smjestaj` (`idSmjestaj`),
  ADD CONSTRAINT `SMJESTAJ_REZERVACIJA_ibfk_2` FOREIGN KEY (`idKupac`) REFERENCES `kupac` (`idKupac`);

--
-- Ograničenja za tablicu `soba`
--
ALTER TABLE `soba`
  ADD CONSTRAINT `SOBA_ibfk_1` FOREIGN KEY (`idSmjestaj`) REFERENCES `smjestaj` (`idSmjestaj`);

--
-- Ograničenja za tablicu `soba_rezervacija`
--
ALTER TABLE `soba_rezervacija`
  ADD CONSTRAINT `SOBA_REZERVACIJA_ibfk_1` FOREIGN KEY (`idSoba`) REFERENCES `soba` (`idSoba`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

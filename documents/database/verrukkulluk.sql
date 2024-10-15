-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 15 okt 2024 om 14:03
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `verrukkulluk_db`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `artikel`
--

CREATE TABLE `artikel` (
  `id` int(11) NOT NULL,
  `naam` varchar(50) NOT NULL,
  `omschrijving` varchar(100) NOT NULL,
  `prijs` float NOT NULL,
  `eenheid` varchar(50) NOT NULL,
  `verpakking` varchar(50) NOT NULL,
  `calorieen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `artikel`
--

INSERT INTO `artikel` (`id`, `naam`, `omschrijving`, `prijs`, `eenheid`, `verpakking`, `calorieen`) VALUES
(1, 'grand italia fusilli tradizionali', 'pasta fusilli', 1.99, 'gr', '500', 345),
(2, 'wahid kipfilet', 'kipfilet', 5.99, 'gr', '400', 270),
(3, 'ah gele uien', 'uien', 1.09, 'stuks', '3', 40),
(4, 'campina room culinair', 'kookroom', 1.29, 'ml', '200', 575),
(5, 'ah cherrytomaten', 'cherrytomaten', 1.25, 'gr', '250', 10),
(6, 'ah geroosterde pijnboompitten', 'pijnboompitten', 2.09, 'gr', '30', 5),
(7, 'ah rucola', 'rucola', 1.09, 'gr', '85', 24),
(8, 'grand italia pesto rosso', 'rode pesto', 2.69, 'gr', '90', 130),
(9, 'ah keukenzout met jodium', 'keukenzout', 0.59, 'gr', '500', 4),
(10, 'catine pellegrino marsala fine', 'likeur', 10.49, 'ml', '750', 138),
(11, 'ah lange vingers', 'lange vingers', 1.29, 'gr', '200', 285),
(12, 'ah witte vrije uitloopeieren m', 'eieren', 1.69, 'stuks', '6', 160),
(13, 'van gilse kristalsuiker', 'kristalsuiker', 1.39, 'gr', '1000', 600),
(14, 'ah mascarpone 80+', 'mascarpone', 1.69, 'gr', '250', 230),
(15, 'blooker cacaopoeder', 'cacaopoeder', 3.09, 'gr', '250', 27),
(16, 'ah schenkel met been', 'schenkel met been', 3.24, 'gr', '270', 21),
(17, 'ah rundersoepvlees', 'soepvlees', 5.41, 'gr', '315', 329),
(18, 'ah bouillon rund', 'runder bouillon', 0.59, 'stuk', '12', 45),
(19, 'ah half-om-half gehakt', 'half-om-half gehakt', 3.95, 'gr', '500', 380),
(20, 'verstegen nootmuskaat gemalen', 'nootmuskaat', 3.99, 'gr', '40', 8),
(21, 'ah fijne soepgroenten grootverpakking', 'soepgroenten', 1.99, 'gr', '400', 90),
(22, 'ah bosui', 'bosui', 0.92, 'stuk', '1', 35),
(23, 'ah scharrel braadwort', 'braadworst', 3.99, 'stuk', '4', 390),
(24, 'ah gerookt ontbijtspek', 'ontbijtspek', 2.94, 'gr', '120', 280),
(25, 'ah biologisch ahornsiroop', 'ahornsiroop', 5.99, 'ml', '190', 145),
(26, 'ah tasty tom trostomaten', 'trostomaten', 2.99, 'gr', '380', 60),
(27, 'ah witte bonen in tomatensaus', 'witte bonen in tomatensaus', 0.85, 'gr', '400', 195),
(28, 'ah extra lang lekker tijger wit heel', 'wit tijgerbrood', 1.29, 'sneetjes', '22', 410);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gerecht`
--

CREATE TABLE `gerecht` (
  `id` int(11) NOT NULL,
  `keuken_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `datum_toegevoegd` date NOT NULL,
  `titel` varchar(100) NOT NULL,
  `korte_omschrijving` varchar(200) NOT NULL,
  `lange_omschrijving` varchar(1000) NOT NULL,
  `afbeelding` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `gerecht`
--

INSERT INTO `gerecht` (`id`, `keuken_id`, `type_id`, `user_id`, `datum_toegevoegd`, `titel`, `korte_omschrijving`, `lange_omschrijving`, `afbeelding`) VALUES
(1, 1, 4, 1, '2024-10-09', 'pasta pesto', 'Recept met pasta en kip in pestosaus.', 'Makkelijk recept met pasta en kip in een lekkere romige pestosaus moet je een keer geprobeerd hebben!', 'https://marleyspoon.com/media/recipes/97654/main_photos/large/schnelle_paprika_hahnchen_penne-f98452974c20266a94c5d0aa1a25e0c4.jpeg'),
(2, 1, 5, 1, '2024-10-02', 'tiramisu', 'Italiaans nagerecht met mascarpone en in koffie-gedompelde koekjes.', 'Tiramisu is een heel populair Italiaans dessert. De term ‘tira mi su’ betekent letterlijk vertaald ‘trek mij omhoog’, maar je kan het ook interpreteren als ‘maak me blij’ of ‘beur me op’. Het dessert is wereldwijd bekend, maar de oorsprong is onzeker. Er doen verschillende oorsprongsverhalen de ronde, maar ze hebben allemaal een ding gemeen: het toetje is ontstaan om kracht en energie te geven.', 'https://zininkoffie.nl/wp-content/uploads/2023/11/Tiramisu-maken.webp'),
(3, 2, 6, 2, '2024-09-10', 'omas groentesoep', 'Ouderwets lekkere groentesoep.', 'Ouderwets lekker: oma\'s groentesoep. Trek de schenkels en groenten langzaam op laag vuur en voeg later de fijngesneden groenten en gehaktballetjes toe voor extra smaak. Perfect als een heerlijk voor- of hoofdgerecht.', 'https://www.feelgoodbyfood.nl/wp-content/uploads/2020/10/IMG_4709-1320x880.jpg'),
(4, 3, 7, 3, '2024-08-12', 'english breakfast', 'Een typisch Engels ontbijt.', 'Ooit bedacht als stevig ontbijt voor Engelse mijnwerkers. Nu gewoon om van te genieten; of je nou zwaar werk doet of niet.', 'https://iamafoodblog.b-cdn.net/wp-content/uploads/2019/02/full-english-7355w-2-1536x1025.webp');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gerecht_info`
--

CREATE TABLE `gerecht_info` (
  `id` int(11) NOT NULL,
  `record_type` char(1) NOT NULL,
  `gerecht_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `datum` date NOT NULL,
  `nummeriekveld` int(11) DEFAULT NULL,
  `tekstveld` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `gerecht_info`
--

INSERT INTO `gerecht_info` (`id`, `record_type`, `gerecht_id`, `user_id`, `datum`, `nummeriekveld`, `tekstveld`) VALUES
(1, 'B', 1, NULL, '2024-10-09', 1, 'Snipper het uitje en fruit even aan in een scheutje olijfolie. Voeg de blokjes kip toe en bak ongeveer 5 minuten. Kook ondertussen de pasta gaar. Voeg de (zelfgemaakte) pesto en room toe aan de kip en roer goed door. Proef nog even of er nog peper of zout bij moet.'),
(2, 'B', 1, NULL, '2024-10-09', 2, 'Laat de pestosaus een paar minuutjes zachtjes pruttelen. Voeg dan de gekookte pasta toe en schep er doorheen. Halveer de tomaatjes en roer ook door de pasta pesto en verwarm nog een minuutje mee. Serveer de pasta pesto in de pan of op een bord met een handje rucola en de geroosterde pijnboompitten.'),
(3, 'B', 1, NULL, '2024-10-09', 3, 'Tip: deze pasta pesto is ook lekker met geraspte kaas. Gebruik ook eens stukjes vegetarische kip voor een vegetarische variant op de kip pesto.'),
(4, 'O', 1, 2, '2024-10-11', NULL, 'Heerlijk, zelfs mijn kinderen vonden het lekker!'),
(5, 'O', 1, 3, '2024-10-10', NULL, 'Volgende keer iets meer kruiden en dan is dit een perfect gerecht, een echte aanrader.'),
(6, 'W', 1, NULL, '2024-10-11', 4, NULL),
(7, 'F', 1, 2, '2024-10-10', NULL, NULL),
(8, 'F', 1, 3, '2024-10-09', NULL, NULL),
(9, 'B', 2, NULL, '2024-10-02', 1, 'Klop de eidooiers met de helft van de suiker met een (hand)mixer met garde(s) tot een zeer romig mengsel, dit duurt zeker 5 minuten. Voeg vervolgens de mascarpone toe aan het eidooiermengsel en klop dit tot een homogene massa.'),
(10, 'B', 2, NULL, '2024-10-02', 2, 'Doe de eiwitten met een snuf zout in een vetvrije kom en zorg dat de garde(s) van de mixer heel goed schoongemaakt zijn. Klop de eiwitten met een (hand)mixer met garde(s) stijf. Voeg lepel voor lepel de resterende suiker toe. Spatel het stijfgeklopte eiwit door het mascarponemengsel en meng dit tot een egale crème.'),
(11, 'B', 2, NULL, '2024-10-02', 3, 'Meng de espresso met de drank naar keuze. Doop hier de lange vingers één voor één kort in en bedek daarmee de bodem van een (oven)schaal van ongeveer 25×18 centimeter. Verdeel hier de helft van het tiramisumengsel overheen en strijk dit glad. Herhaal beide stappen en zet de tiramisu minimaal 4 uur in de koelkast om op te stijven.'),
(12, 'B', 2, NULL, '2024-10-02', 4, 'Bestuif voor het serveren met een dikke laag cacaopoeder.'),
(13, 'O', 2, 1, '2024-10-02', NULL, 'Dit is toch wel mijn best bedachte recept, al zeg ik het zelf ;)'),
(14, 'O', 2, 3, '2024-10-04', NULL, 'Voor mij veel te zoet! Geen geslaagd recept.'),
(15, 'W', 2, NULL, '2024-10-03', 2, NULL),
(16, 'F', 2, 1, '2024-10-03', NULL, NULL),
(17, 'B', 3, NULL, '2024-09-10', 1, 'Schenk het water in een soeppan. Voeg de schenkel, rundersoepblokjes en de bouillontabletten toe. Breng aan de kook, zet het vuur laag en laat 2 uur zachtjes koken. Schep regelmatig het schuim dat komt bovendrijven met een schuimspaan van de soep af.'),
(18, 'B', 3, NULL, '2024-09-10', 2, 'Maak de schone theedoek vochtig, leg in een zeef en zeef de bouillon boven een andere pan. Spoel het vlees af. Haal het vlees van de schenkel, snijd in kleine stukjes en voeg samen met de rest van het rundvlees toe aan de bouillon.'),
(19, 'B', 3, NULL, '2024-09-10', 3, 'Breng het gehakt op smaak met de nootmuskaat, peper en zout. Draai er kleine balletjes van en voeg samen met de soepgroente toe aan de soep. Breng de soep opnieuw aan de kook, zet het vuur laag en kook nog 8 min. door. Breng op smaak met peper en eventueel zout. Snijd de bosui in dunne ringetjes en roer vlak voor het serveren door de soep.'),
(20, 'O', 3, 3, '2024-10-10', NULL, 'Smaakt precies zoals mijn oma hem vroeger ook maakte, pure nostalgie.'),
(21, 'W', 3, NULL, '2024-10-10', 5, NULL),
(22, 'F', 3, 1, '2024-10-10', NULL, NULL),
(23, 'F', 3, 2, '2024-10-10', NULL, NULL),
(24, 'F', 3, 3, '2024-10-09', NULL, NULL),
(25, 'B', 4, NULL, '2024-08-12', 1, 'Verhit de olie in een koekenpan en bak de braadworsten in 20 min. op middelhoog vuur rondom gaar. Keer regelmatig. Verhit ondertussen een koekenpan zonder olie of boter en bak de ontbijtspek op middelhoog vuur in 5 min. goudbruin en krokant. Voeg de ahornsiroop toe, schep om en neem het spek uit de pan. Laat uitlekken op keukenpapier.'),
(26, 'B', 4, NULL, '2024-08-12', 2, 'Halveer ondertussen de tomaten overlangs. Bak met de snijkant naar beneden 4 min. op middelhoog vuur in het achtergebleven bakvet van het ontbijtspek.'),
(27, 'B', 4, NULL, '2024-08-12', 3, 'Verwarm ondertussen de bonen in een kleine pan op laag vuur en rooster het brood.'),
(28, 'B', 4, NULL, '2024-08-12', 4, 'Neem de braadworsten uit de pan en houd warm onder aluminiumfolie. Bak de eieren in het achtergebleven bakvet. Bestrooi met peper en eventueel zout.'),
(29, 'B', 4, NULL, '2024-08-12', 5, 'Snijd het brood schuin doormidden. Snijd elke braadworst schuin in 4 gelijke delen. Verdeel de braadworst, eieren, bonen, tomaat, het ontbijtspek en brood over de borden en serveer.'),
(30, 'O', 4, 1, '2024-09-27', NULL, 'Beetje flauw, verder een lekker gerecht.'),
(31, 'W', 4, NULL, '2024-09-19', 3, NULL),
(32, 'F', 4, 3, '2024-09-12', NULL, NULL),
(33, 'W', 1, NULL, '2024-10-10', 3, NULL),
(34, 'W', 1, NULL, '2024-10-09', 4, NULL),
(35, 'W', 1, NULL, '2024-10-09', 5, NULL),
(36, 'W', 1, NULL, '2024-10-10', 3, NULL),
(37, 'W', 1, NULL, '2024-10-09', 2, NULL),
(38, 'W', 1, NULL, '2024-10-09', 3, NULL),
(39, 'W', 2, NULL, '2024-10-10', 2, NULL),
(40, 'W', 2, NULL, '2024-10-17', 1, NULL),
(41, 'W', 2, NULL, '2024-10-18', 3, NULL),
(42, 'W', 2, NULL, '2024-10-09', 2, NULL),
(43, 'W', 2, NULL, '2024-10-12', 4, NULL),
(44, 'W', 2, NULL, '2024-10-23', 3, NULL),
(45, 'W', 3, NULL, '2024-10-22', 4, NULL),
(46, 'W', 3, NULL, '2024-10-25', 5, NULL),
(47, 'W', 3, NULL, '2024-10-17', 5, NULL),
(48, 'W', 3, NULL, '2024-10-16', 3, NULL),
(49, 'W', 3, NULL, '2024-10-12', 4, NULL),
(50, 'W', 3, NULL, '2024-10-22', 5, NULL),
(51, 'W', 3, NULL, '2024-10-29', 4, NULL),
(52, 'W', 4, NULL, '2024-10-30', 4, NULL),
(53, 'W', 4, NULL, '2024-10-26', 2, NULL),
(54, 'W', 4, NULL, '2024-10-27', 4, NULL),
(55, 'W', 4, NULL, '2024-10-22', 2, NULL),
(56, 'W', 4, NULL, '2024-10-11', 3, NULL),
(61, 'W', 1, NULL, '2024-10-10', 2, NULL),
(62, 'W', 1, NULL, '2024-10-09', 3, NULL),
(69, 'F', 1, 1, '0000-00-00', NULL, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `ingredient`
--

CREATE TABLE `ingredient` (
  `id` int(11) NOT NULL,
  `gerecht_id` int(11) NOT NULL,
  `artikel_id` int(11) NOT NULL,
  `aantal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `ingredient`
--

INSERT INTO `ingredient` (`id`, `gerecht_id`, `artikel_id`, `aantal`) VALUES
(1, 1, 1, 300),
(2, 1, 2, 400),
(3, 1, 3, 1),
(4, 1, 4, 250),
(5, 1, 5, 250),
(6, 1, 6, 60),
(7, 1, 7, 25),
(8, 1, 8, 80),
(9, 1, 9, 5),
(10, 2, 10, 50),
(11, 2, 11, 200),
(12, 2, 12, 4),
(13, 2, 13, 110),
(14, 2, 14, 500),
(15, 2, 15, 15),
(16, 3, 16, 255),
(17, 3, 17, 300),
(18, 3, 18, 2),
(19, 3, 19, 150),
(20, 3, 20, 2),
(21, 3, 21, 250),
(22, 3, 22, 3),
(23, 4, 12, 4),
(24, 4, 23, 2),
(25, 4, 24, 178),
(26, 4, 25, 12),
(27, 4, 26, 200),
(28, 4, 27, 415),
(29, 4, 28, 8);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `keuken_type`
--

CREATE TABLE `keuken_type` (
  `id` int(11) NOT NULL,
  `record_type` char(1) NOT NULL,
  `omschrijving` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `keuken_type`
--

INSERT INTO `keuken_type` (`id`, `record_type`, `omschrijving`) VALUES
(1, 'K', 'italiaans'),
(2, 'K', 'nederlands'),
(3, 'K', 'engels'),
(4, 'T', 'hoofdgerecht'),
(5, 'T', 'nagerecht'),
(6, 'T', 'voorgerecht'),
(7, 'T', 'ontbijt');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `afbeelding` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `user_name`, `password`, `email`, `afbeelding`) VALUES
(1, 'pieter_post', 'pieter_post123!', 'piet@post.nl', 'https://sin-in.nl/resources/a6195f9b4b886e/9530af8705.JPEG'),
(2, 'erika_terpstra', 'erika_terpstra123!', 'erika@terpstra.nl', 'https://image.margriet.nl/207039673/width/1280/erica-terpstra-ik-vind-reizen-prachtig-want-ik-ben-extreem'),
(3, 'mads_junker', 'mads_junker123!', 'mads@junker.nl', 'https://images0.persgroep.net/rcs/NR6IQIvk4iCno4GMbKrBeG5kMuA/diocontent/63571874/_crop/1/30/899/508/_fitwidth/694/?appId=21791a8992982cd8da851550a453bd7f&quality=0.8');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `gerecht`
--
ALTER TABLE `gerecht`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `keuken_id` (`keuken_id`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexen voor tabel `gerecht_info`
--
ALTER TABLE `gerecht_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gerecht_id` (`gerecht_id`);

--
-- Indexen voor tabel `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artikel_id` (`artikel_id`),
  ADD KEY `gerecht_id` (`gerecht_id`);

--
-- Indexen voor tabel `keuken_type`
--
ALTER TABLE `keuken_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT voor een tabel `gerecht`
--
ALTER TABLE `gerecht`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `gerecht_info`
--
ALTER TABLE `gerecht_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT voor een tabel `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT voor een tabel `keuken_type`
--
ALTER TABLE `keuken_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `gerecht`
--
ALTER TABLE `gerecht`
  ADD CONSTRAINT `gerecht_ibfk_1` FOREIGN KEY (`keuken_id`) REFERENCES `keuken_type` (`id`),
  ADD CONSTRAINT `gerecht_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `keuken_type` (`id`),
  ADD CONSTRAINT `gerecht_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Beperkingen voor tabel `gerecht_info`
--
ALTER TABLE `gerecht_info`
  ADD CONSTRAINT `gerecht_info_ibfk_1` FOREIGN KEY (`gerecht_id`) REFERENCES `gerecht` (`id`);

--
-- Beperkingen voor tabel `ingredient`
--
ALTER TABLE `ingredient`
  ADD CONSTRAINT `ingredient_ibfk_1` FOREIGN KEY (`artikel_id`) REFERENCES `artikel` (`id`),
  ADD CONSTRAINT `ingredient_ibfk_2` FOREIGN KEY (`gerecht_id`) REFERENCES `gerecht` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

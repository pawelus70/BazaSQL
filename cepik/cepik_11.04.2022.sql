-- phpMyAdmin SQL Dump
-- version 5.1.4-dev+20220402.3ab83d8201
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 11 Kwi 2022, 14:32
-- Wersja serwera: 10.4.24-MariaDB
-- Wersja PHP: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `cepik`
--

DELIMITER $$
--
-- Procedury
--
DROP PROCEDURE IF EXISTS `selectSamochod`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `selectSamochod` ()   SELECT * FROM samochod$$

DROP PROCEDURE IF EXISTS `selectSamochodAndMarka`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `selectSamochodAndMarka` ()   SELECT samochod.nr_rejestracyjny, model.marka, samochod.model, samochod.kolor, samochod.kategoria 
FROM samochod
INNER JOIN model
	ON (model.kod_modelu = samochod.model)$$

DROP PROCEDURE IF EXISTS `selectSamochodAndWlasciciel`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `selectSamochodAndWlasciciel` ()   SELECT osoba.imie, osoba.nazwisko, osoba.PESEL, 
samochod.nr_rejestracyjny
FROM osoba
INNER JOIN typ_wlasciciela
	ON (typ_wlasciciela.pesel_osoby = osoba.PESEL)
INNER JOIN samochod
	ON ( typ_wlasciciela.vin_pojazdu = samochod.VIN)
WHERE typ_wlasciciela.typ = "wlasciciel"$$

DROP PROCEDURE IF EXISTS `selectSamochodAndWlascicielByRej`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `selectSamochodAndWlascicielByRej` (IN `Rej` VARCHAR(8))   SELECT osoba.imie, osoba.nazwisko, osoba.PESEL, 
samochod.nr_rejestracyjny
FROM osoba
INNER JOIN typ_wlasciciela
	ON (typ_wlasciciela.pesel_osoby = osoba.PESEL)
INNER JOIN samochod
	ON ( typ_wlasciciela.vin_pojazdu = samochod.VIN)
WHERE typ_wlasciciela.typ = "wlasciciel" AND samochod.nr_rejestracyjny LIKE CONCAT("%",Rej,'%')$$

DROP PROCEDURE IF EXISTS `selectSamochodByRej`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `selectSamochodByRej` (IN `Rej` VARCHAR(8))  COMMENT 'Pobranie samochodu po numerze rejestracyjnym ' SELECT * FROM samochod
WHERE nr_rejestracyjny LIKE  CONCAT('%',Rej,'%')$$

DROP PROCEDURE IF EXISTS `selectSamochodByVin`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `selectSamochodByVin` (IN `Vin` VARCHAR(17))   SELECT * FROM samochod
WHERE VIN LIKE  CONCAT('%',Vin,'%')$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `badania`
--

DROP TABLE IF EXISTS `badania`;
CREATE TABLE `badania` (
  `vin_pojazdu` varchar(17) NOT NULL,
  `data_waznosci_badania` date NOT NULL,
  `data_ost_badania` date NOT NULL,
  `kod_usterki` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `badania`
--

INSERT INTO `badania` (`vin_pojazdu`, `data_waznosci_badania`, `data_ost_badania`, `kod_usterki`) VALUES
('12345678912345678', '2023-04-04', '2022-04-04', NULL),
('12345678912345678', '2024-04-03', '2023-04-04', NULL),
('12345678912345678', '2025-04-03', '2024-04-04', NULL);

--
-- Wyzwalacze `badania`
--
DROP TRIGGER IF EXISTS `zmienDatePrzegladu`;
DELIMITER $$
CREATE TRIGGER `zmienDatePrzegladu` AFTER INSERT ON `badania` FOR EACH ROW BEGIN

    UPDATE samochod SET samochod.data_waznosci_badania = NEW.data_waznosci_badania WHERE NEW.vin_pojazdu = samochod.VIN;

    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `historia_wlascicieli`
--

DROP TABLE IF EXISTS `historia_wlascicieli`;
CREATE TABLE `historia_wlascicieli` (
  `vin_pojazdu` varchar(17) NOT NULL,
  `pesel_wlasciciela` bigint(11) NOT NULL,
  `data_zmiany_wlasciciela` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `historia_wlascicieli`
--

INSERT INTO `historia_wlascicieli` (`vin_pojazdu`, `pesel_wlasciciela`, `data_zmiany_wlasciciela`) VALUES
('12345678912345678', 98262631452, '2022-04-04');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `marka`
--

DROP TABLE IF EXISTS `marka`;
CREATE TABLE `marka` (
  `nazwa_marki` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `marka`
--

INSERT INTO `marka` (`nazwa_marki`) VALUES
('Fiat'),
('Subaru');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `model`
--

DROP TABLE IF EXISTS `model`;
CREATE TABLE `model` (
  `kod_modelu` varchar(45) NOT NULL,
  `marka` varchar(45) NOT NULL,
  `dodatkowe_informacje` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `model`
--

INSERT INTO `model` (`kod_modelu`, `marka`, `dodatkowe_informacje`) VALUES
('ImprezaU3', 'Subaru', ''),
('UNO1', 'Fiat', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `osoba`
--

DROP TABLE IF EXISTS `osoba`;
CREATE TABLE `osoba` (
  `imie` varchar(45) NOT NULL,
  `nazwisko` varchar(45) NOT NULL,
  `PESEL` bigint(11) NOT NULL,
  `miejscowosc` varchar(45) NOT NULL,
  `adres` varchar(45) NOT NULL,
  `nr_blok` int(4) NOT NULL,
  `kod_pocztowy` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `osoba`
--

INSERT INTO `osoba` (`imie`, `nazwisko`, `PESEL`, `miejscowosc`, `adres`, `nr_blok`, `kod_pocztowy`) VALUES
('Ridley', 'Scott', 87456921321, 'warszawa', 'urzedowa', 5, 42651),
('Bojtek', 'Wadura', 98111014157, 'krakow', 'borek', 3, 34045),
('Quentin', 'Taratino', 98262631452, 'krakow', 'Wiejska', 10, 32505);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `przebieg`
--

DROP TABLE IF EXISTS `przebieg`;
CREATE TABLE `przebieg` (
  `vin_pojazdu` varchar(17) NOT NULL,
  `przebieg` int(12) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `samochod`
--

DROP TABLE IF EXISTS `samochod`;
CREATE TABLE `samochod` (
  `nr_rejestracyjny` varchar(8) NOT NULL,
  `VIN` varchar(17) NOT NULL,
  `pojemnosc` float NOT NULL,
  `data_pierwszej_rejestracji` date NOT NULL,
  `kategoria` varchar(45) NOT NULL,
  `model` varchar(45) NOT NULL,
  `kolor` varchar(45) NOT NULL,
  `data_waznosci_badania` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `samochod`
--

INSERT INTO `samochod` (`nr_rejestracyjny`, `VIN`, `pojemnosc`, `data_pierwszej_rejestracji`, `kategoria`, `model`, `kolor`, `data_waznosci_badania`) VALUES
('KRA78547', '12345678912345678', 1999, '2022-04-01', 'SUV', 'ImprezaU3', 'niebieski', '2025-04-03');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `typ_wlasciciela`
--

DROP TABLE IF EXISTS `typ_wlasciciela`;
CREATE TABLE `typ_wlasciciela` (
  `vin_pojazdu` varchar(17) NOT NULL,
  `typ` varchar(16) NOT NULL,
  `pesel_osoby` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `typ_wlasciciela`
--

INSERT INTO `typ_wlasciciela` (`vin_pojazdu`, `typ`, `pesel_osoby`) VALUES
('12345678912345678', 'wlasciciel', 98262631452),
('12345678912345678', 'wspolwlasciciel', 87456921321);

--
-- Wyzwalacze `typ_wlasciciela`
--
DROP TRIGGER IF EXISTS `sprawdzWlasciciela`;
DELIMITER $$
CREATE TRIGGER `sprawdzWlasciciela` BEFORE INSERT ON `typ_wlasciciela` FOR EACH ROW BEGIN
        IF NEW.typ in (
            select typ
            From typ_wlasciciela 
            where (NEW.vin_pojazdu = typ_wlasciciela.vin_pojazdu and NEW.typ = typ_wlasciciela.typ)
        ) THEN
           CALL `Wlasciciel juz istnieje.`;

        END IF;
    END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `zmianaWlasciciela`;
DELIMITER $$
CREATE TRIGGER `zmianaWlasciciela` BEFORE UPDATE ON `typ_wlasciciela` FOR EACH ROW BEGIN
    
	INSERT INTO historia_wlascicieli
    VALUES (NEW.vin_pojazdu, NEW.pesel_osoby, CURRENT_DATE);

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `usterki`
--

DROP TABLE IF EXISTS `usterki`;
CREATE TABLE `usterki` (
  `kod_usterki` int(9) NOT NULL,
  `opis_usterki` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `usterki`
--

INSERT INTO `usterki` (`kod_usterki`, `opis_usterki`) VALUES
(1, 'brak recznego'),
(2, 'migacz');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `badania`
--
ALTER TABLE `badania`
  ADD KEY `kod_usterki` (`kod_usterki`),
  ADD KEY `vin_pojazdu` (`vin_pojazdu`);

--
-- Indeksy dla tabeli `historia_wlascicieli`
--
ALTER TABLE `historia_wlascicieli`
  ADD KEY `vin_pojazdu` (`vin_pojazdu`),
  ADD KEY `pesel_wlasciciela` (`pesel_wlasciciela`);

--
-- Indeksy dla tabeli `marka`
--
ALTER TABLE `marka`
  ADD PRIMARY KEY (`nazwa_marki`);

--
-- Indeksy dla tabeli `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`kod_modelu`),
  ADD KEY `marka` (`marka`);

--
-- Indeksy dla tabeli `osoba`
--
ALTER TABLE `osoba`
  ADD PRIMARY KEY (`PESEL`);

--
-- Indeksy dla tabeli `przebieg`
--
ALTER TABLE `przebieg`
  ADD KEY `vin_pojazdu` (`vin_pojazdu`);

--
-- Indeksy dla tabeli `samochod`
--
ALTER TABLE `samochod`
  ADD PRIMARY KEY (`VIN`),
  ADD KEY `model` (`model`);

--
-- Indeksy dla tabeli `typ_wlasciciela`
--
ALTER TABLE `typ_wlasciciela`
  ADD KEY `vin_pojazdu` (`vin_pojazdu`),
  ADD KEY `pesel_osoby` (`pesel_osoby`);

--
-- Indeksy dla tabeli `usterki`
--
ALTER TABLE `usterki`
  ADD PRIMARY KEY (`kod_usterki`);

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `badania`
--
ALTER TABLE `badania`
  ADD CONSTRAINT `badania_ibfk_1` FOREIGN KEY (`kod_usterki`) REFERENCES `usterki` (`kod_usterki`),
  ADD CONSTRAINT `badania_ibfk_2` FOREIGN KEY (`vin_pojazdu`) REFERENCES `samochod` (`VIN`);

--
-- Ograniczenia dla tabeli `historia_wlascicieli`
--
ALTER TABLE `historia_wlascicieli`
  ADD CONSTRAINT `historia_wlascicieli_ibfk_1` FOREIGN KEY (`vin_pojazdu`) REFERENCES `samochod` (`VIN`),
  ADD CONSTRAINT `historia_wlascicieli_ibfk_2` FOREIGN KEY (`pesel_wlasciciela`) REFERENCES `osoba` (`PESEL`);

--
-- Ograniczenia dla tabeli `model`
--
ALTER TABLE `model`
  ADD CONSTRAINT `model_ibfk_1` FOREIGN KEY (`marka`) REFERENCES `marka` (`nazwa_marki`);

--
-- Ograniczenia dla tabeli `przebieg`
--
ALTER TABLE `przebieg`
  ADD CONSTRAINT `przebieg_ibfk_1` FOREIGN KEY (`vin_pojazdu`) REFERENCES `samochod` (`VIN`);

--
-- Ograniczenia dla tabeli `samochod`
--
ALTER TABLE `samochod`
  ADD CONSTRAINT `samochod_ibfk_1` FOREIGN KEY (`model`) REFERENCES `model` (`kod_modelu`);

--
-- Ograniczenia dla tabeli `typ_wlasciciela`
--
ALTER TABLE `typ_wlasciciela`
  ADD CONSTRAINT `typ_wlasciciela_ibfk_2` FOREIGN KEY (`vin_pojazdu`) REFERENCES `samochod` (`VIN`),
  ADD CONSTRAINT `typ_wlasciciela_ibfk_3` FOREIGN KEY (`pesel_osoby`) REFERENCES `osoba` (`PESEL`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 18 Cze 2018, 19:58
-- Wersja serwera: 10.1.30-MariaDB
-- Wersja PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `klinika_rehab`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lekarze`
--

CREATE TABLE `lekarze` (
  `ID` int(11) NOT NULL,
  `Nazwisko` text COLLATE utf8_polish_ci NOT NULL,
  `Imie` text COLLATE utf8_polish_ci NOT NULL,
  `Specjalizacja` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `lekarze`
--

INSERT INTO `lekarze` (`ID`, `Nazwisko`, `Imie`, `Specjalizacja`) VALUES
(1, 'House', 'George', 'Wszystko');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pacjenci`
--

CREATE TABLE `pacjenci` (
  `ID` int(11) NOT NULL,
  `Nazwisko` text COLLATE utf8_polish_ci NOT NULL,
  `Imie` text COLLATE utf8_polish_ci NOT NULL,
  `Data_ur` date NOT NULL,
  `Telefon` text COLLATE utf8_polish_ci NOT NULL,
  `Pesel` text COLLATE utf8_polish_ci NOT NULL,
  `login` text COLLATE utf8_polish_ci NOT NULL,
  `haslo` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `pacjenci`
--

INSERT INTO `pacjenci` (`ID`, `Nazwisko`, `Imie`, `Data_ur`, `Telefon`, `Pesel`, `login`, `haslo`) VALUES
(1, 'Kowalski', 'Jan', '2018-06-04', '829495753', '93539249234', 'janek', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(2, 'admin', 'admin', '2018-06-14', '8294792', '123', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sale`
--

CREATE TABLE `sale` (
  `ID` int(11) NOT NULL,
  `nr_sali` int(11) NOT NULL,
  `pietro` int(11) NOT NULL,
  `nr_budynku` int(11) NOT NULL,
  `specj_sali` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `sale`
--

INSERT INTO `sale` (`ID`, `nr_sali`, `pietro`, `nr_budynku`, `specj_sali`) VALUES
(1, 234, 2, 21, 'Rehabilitacja kolan');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zabiegi`
--

CREATE TABLE `zabiegi` (
  `ID` int(11) NOT NULL,
  `id_pacjent` int(11) NOT NULL,
  `id_lekarz` int(11) NOT NULL,
  `id_sala` int(11) NOT NULL,
  `Data_zabiegu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `zabiegi`
--

INSERT INTO `zabiegi` (`ID`, `id_pacjent`, `id_lekarz`, `id_sala`, `Data_zabiegu`) VALUES
(2, 1, 1, 1, '2018-06-13 04:14:00');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `lekarze`
--
ALTER TABLE `lekarze`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `pacjenci`
--
ALTER TABLE `pacjenci`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `zabiegi`
--
ALTER TABLE `zabiegi`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id_sala` (`id_sala`),
  ADD KEY `id_pacjent` (`id_pacjent`),
  ADD KEY `id_lekarz` (`id_lekarz`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `lekarze`
--
ALTER TABLE `lekarze`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `pacjenci`
--
ALTER TABLE `pacjenci`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `sale`
--
ALTER TABLE `sale`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `zabiegi`
--
ALTER TABLE `zabiegi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `zabiegi`
--
ALTER TABLE `zabiegi`
  ADD CONSTRAINT `zabiegi_ibfk_1` FOREIGN KEY (`id_sala`) REFERENCES `sale` (`ID`),
  ADD CONSTRAINT `zabiegi_ibfk_2` FOREIGN KEY (`id_pacjent`) REFERENCES `pacjenci` (`ID`),
  ADD CONSTRAINT `zabiegi_ibfk_3` FOREIGN KEY (`id_lekarz`) REFERENCES `lekarze` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

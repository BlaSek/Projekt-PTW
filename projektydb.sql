-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Wrz 03, 2024 at 04:24 AM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projektydb`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE `kategorie` (
  `id` int(10) UNSIGNED NOT NULL,
  `nazwa` varchar(50) NOT NULL,
  `opis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `kategorie`
--

INSERT INTO `kategorie` (`id`, `nazwa`, `opis`) VALUES
(1, 'Dom', ''),
(2, 'Mieszkanie', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `projekty`
--

CREATE TABLE `projekty` (
  `Id` int(10) UNSIGNED NOT NULL,
  `idKategorii` int(10) UNSIGNED NOT NULL,
  `nazwa` varchar(50) NOT NULL,
  `zdjecie` varchar(50) NOT NULL,
  `opis` text NOT NULL,
  `TypBudynku` varchar(50) NOT NULL,
  `StylArchitektoniczny` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `projekty`
--

INSERT INTO `projekty` (`Id`, `idKategorii`, `nazwa`, `zdjecie`, `opis`, `TypBudynku`, `StylArchitektoniczny`) VALUES
(2, 1, 'Bliźniak', 'blizniak.png', 'Dom jednorodzinny, który jest częścią większej zabudowy, zwykle połączony wspólną ścianą z drugim, identycznym budynkiem. Bliźniak pozwala na optymalne wykorzystanie działki przy zachowaniu komfortu i prywatności mieszkańców.', 'Bliźniak', 'Nowoczesny'),
(3, 1, 'Dom letniskowy', 'domLetniskowy.png', 'Niewielki, zazwyczaj sezonowy budynek przeznaczony do rekreacji i wypoczynku. Zwykle zlokalizowany w malowniczych okolicach, takich jak góry, jeziora czy lasy. Charakteryzuje się prostą konstrukcją, często wykonany z drewna, z tarasem lub werandą, idealny na wakacyjne wyjazdy i weekendowe wypady.', 'Dom letniskowy', 'Rustykalny'),
(4, 2, 'Mieszkanie dwupoziomowe', 'mieszkanieDwupietrowe.png', 'Nowoczesne mieszkanie z dwoma kondygnacjami, które łączy w sobie zalety mieszkania i domu jednorodzinnego. Dolny poziom zwykle obejmuje strefę dzienną, taką jak salon, kuchnia i jadalnia, natomiast górny poziom przeznaczony jest na część prywatną – sypialnie i łazienki. Tego typu projekty charakteryzują się przestronnością i funkcjonalnością, oferując mieszkańcom więcej prywatności oraz możliwości ciekawej aranżacji wnętrz, np. z antresolą lub dużymi przeszkleniami.', 'Mieszkanie dwukondygnacyjne', 'Nowoczesny'),
(5, 2, 'Kawalerka', 'kawalerka.png', 'Wizualizacja układu kawalerki (studio apartment). Przedstawia ona nowoczesne, przestronnie zaprojektowane mieszkanie z otwartą przestrzenią łączącą strefę dzienną i sypialnianą, małą kuchnią oraz osobną łazienką.', 'Mieszkanie', 'Nowoczesny');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `recenzje`
--

CREATE TABLE `recenzje` (
  `id` int(10) UNSIGNED NOT NULL,
  `idProjektu` int(10) UNSIGNED NOT NULL,
  `nick` varchar(50) NOT NULL,
  `ocena` int(11) NOT NULL,
  `tresc` text NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `recenzje`
--

INSERT INTO `recenzje` (`id`, `idProjektu`, `nick`, `ocena`, `tresc`, `data`) VALUES
(2, 5, 'test', 2, '', '2024-09-01 21:06:42'),
(5, 4, 'Andrzej', 4, 'Świetne mieszkanie!', '2024-09-03 01:59:20'),
(6, 5, 'Andrzej', 1, 'Trochę małe mieszkanie', '2024-09-03 01:59:39'),
(7, 2, 'blazej', 5, 'Świetny projekt!', '2024-09-03 02:17:35');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ulubione`
--

CREATE TABLE `ulubione` (
  `id` int(10) UNSIGNED NOT NULL,
  `idProjektu` int(10) UNSIGNED NOT NULL,
  `idUzytkownika` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `ulubione`
--

INSERT INTO `ulubione` (`id`, `idProjektu`, `idUzytkownika`) VALUES
(22, 4, 1),
(28, 5, 1),
(30, 5, 11),
(32, 4, 12);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(10) UNSIGNED NOT NULL,
  `login` varchar(50) NOT NULL,
  `haslo` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `rola` varchar(50) NOT NULL DEFAULT 'user',
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `login`, `haslo`, `email`, `rola`, `data`) VALUES
(1, 'test', '098f6bcd4621d373cade4e832627b4f6', 'test@test.pl', 'user', '2024-09-01 20:43:02'),
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.pl', 'user', '2024-09-02 00:05:53'),
(3, 'test2', 'ad0234829205b9033196ba818f7a872b', 'test', 'user', '2024-09-03 00:24:08'),
(4, 'test3', '098f6bcd4621d373cade4e832627b4f6', 'test', 'user', '2024-09-03 00:26:26'),
(5, 'test3', '098f6bcd4621d373cade4e832627b4f6', 'test', 'user', '2024-09-03 00:29:23'),
(6, 'test3', '098f6bcd4621d373cade4e832627b4f6', 'test', 'user', '2024-09-03 00:29:33'),
(7, 'test3', '098f6bcd4621d373cade4e832627b4f6', 'test', 'user', '2024-09-03 00:29:40'),
(8, 'test3', '098f6bcd4621d373cade4e832627b4f6', 'test', 'user', '2024-09-03 00:29:42'),
(9, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'user', '2024-09-03 01:55:18'),
(10, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.pl', 'user', '2024-09-03 01:55:37'),
(11, 'Andrzej', '098f6bcd4621d373cade4e832627b4f6', 'andrzej@andrzej.pl', 'user', '2024-09-03 01:59:02'),
(12, 'blazej', 'e2da22899dd7c0e1edccfddad345aaae', 'blazej@blazej.pl', 'user', '2024-09-03 02:10:43');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `projekty`
--
ALTER TABLE `projekty`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `idKategorii` (`idKategorii`);

--
-- Indeksy dla tabeli `recenzje`
--
ALTER TABLE `recenzje`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProjektu` (`idProjektu`);

--
-- Indeksy dla tabeli `ulubione`
--
ALTER TABLE `ulubione`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProjektu` (`idProjektu`),
  ADD KEY `idUzytkownika` (`idUzytkownika`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `projekty`
--
ALTER TABLE `projekty`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `recenzje`
--
ALTER TABLE `recenzje`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ulubione`
--
ALTER TABLE `ulubione`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `projekty`
--
ALTER TABLE `projekty`
  ADD CONSTRAINT `projekty_ibfk_1` FOREIGN KEY (`idKategorii`) REFERENCES `kategorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recenzje`
--
ALTER TABLE `recenzje`
  ADD CONSTRAINT `recenzje_ibfk_1` FOREIGN KEY (`idProjektu`) REFERENCES `projekty` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ulubione`
--
ALTER TABLE `ulubione`
  ADD CONSTRAINT `ulubione_ibfk_1` FOREIGN KEY (`idProjektu`) REFERENCES `projekty` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ulubione_ibfk_2` FOREIGN KEY (`idUzytkownika`) REFERENCES `uzytkownicy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

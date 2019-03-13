-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 05 Cze 2018, 11:43
-- Wersja serwera: 10.1.31-MariaDB
-- Wersja PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `fabryka`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `group`
--

CREATE TABLE `group` (
  `idGROUP` int(11) NOT NULL,
  `idLINE` int(11) NOT NULL,
  `zmiana` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `group`
--

INSERT INTO `group` (`idGROUP`, `idLINE`, `zmiana`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 1, 2),
(4, 2, 2),
(5, 1, 3),
(6, 2, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `line`
--

CREATE TABLE `line` (
  `idLINE` int(11) NOT NULL,
  `idGROUP` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `line`
--

INSERT INTO `line` (`idLINE`, `idGROUP`) VALUES
(1, 1),
(2, 2),
(3, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `product`
--

CREATE TABLE `product` (
  `id_produktu` int(11) NOT NULL,
  `nazwa` varchar(45) DEFAULT NULL,
  `cena` int(11) NOT NULL,
  `obrazek` text,
  `ilosc` int(11) NOT NULL,
  `opis` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `product`
--

INSERT INTO `product` (`id_produktu`, `nazwa`, `cena`, `obrazek`, `ilosc`, `opis`) VALUES
(1, 'Halbbitter', 50, 'ritter11.png', 95, 'przepyszna'),
(2, 'Kokos', 50, 'ritter12.jpg', 115, 'pyszna'),
(3, 'Nugat', 50, 'ritter13.jpg', 196, 'pyszna'),
(4, 'Vollmilch', 50, 'ritter14.png', 197, 'pyszna'),
(5, 'Voll-Nuss', 50, 'ritter15.png', 200, 'pyszna'),
(6, 'Mandelsplitter', 50, 'ritter16.jpg', 186, 'pyszna');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sprzedaz`
--

CREATE TABLE `sprzedaz` (
  `id_sprzedazy` int(11) NOT NULL,
  `id_zamowienia` int(11) NOT NULL,
  `id_uzytkownika` int(11) NOT NULL,
  `id_produktu` int(11) NOT NULL,
  `ilosc` int(11) NOT NULL,
  `data` date NOT NULL,
  `typ_wysylki` text NOT NULL,
  `potwierdzenie` text NOT NULL,
  `idWORKER` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `sprzedaz`
--

INSERT INTO `sprzedaz` (`id_sprzedazy`, `id_zamowienia`, `id_uzytkownika`, `id_produktu`, `ilosc`, `data`, `typ_wysylki`, `potwierdzenie`, `idWORKER`) VALUES
(50, 1527930316, 15, 1, 20, '2018-05-26', 'poczta polska', 'tak', 1),
(51, 1527930316, 15, 2, 14, '2018-05-26', 'poczta polska', 'tak', 1),
(52, 1527941640, 15, 2, 3, '2018-05-26', 'poczta polska', 'nowy', 1),
(53, 1527941640, 15, 3, 3, '2018-05-26', 'poczta polska', 'nowy', 1),
(54, 1527941640, 15, 4, 3, '2018-05-26', 'poczta polska', 'nowy', 1),
(55, 1528226321, 15, 1, 14, '2018-05-29', 'poczta polska', 'nowy', 1),
(56, 1528226321, 15, 2, 11, '2018-05-29', 'poczta polska', 'nowy', 1),
(57, 1528298179, 15, 1, 16, '2018-05-30', 'poczta polska', 'nowy', 1),
(58, 1528298179, 15, 3, 1, '2018-05-30', 'poczta polska', 'nowy', 1),
(59, 1528298179, 15, 6, 14, '2018-05-30', 'poczta polska', 'nowy', 1),
(60, 1528387806, 15, 2, 15, '2018-05-31', 'poczta polska', 'nowy', 0),
(61, 1528387806, 15, 6, 10, '2018-05-31', 'poczta polska', 'nowy', 0),
(62, 1528451859, 15, 2, 6, '2018-06-01', 'poczta polska', 'nowy', 0),
(63, 1528451859, 15, 4, 6, '2018-06-01', 'poczta polska', 'nowy', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `adres` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `adres`) VALUES
(1, 'admin', 'admin@admin.pl', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', ''),
(15, 'adrian', 'adrian@o2.pl', 'c23ad6f18412014673b2d04794ca038ef6767fe94afe408dffb775362fe07e68', 'Wroclaw'),
(16, 'bozena', 'bozena@o2.pl', '566fad16245eddc4f639e1c47188b8a3d5e9956324cf6fa65eae9f1d47393066', 'Poznan');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `worker`
--

CREATE TABLE `worker` (
  `idWORKER` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `surname` varchar(45) DEFAULT NULL,
  `state` tinyint(1) DEFAULT NULL,
  `haslo` varchar(255) DEFAULT NULL,
  `idGROUP` int(11) NOT NULL,
  `email` varchar(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `worker`
--

INSERT INTO `worker` (`idWORKER`, `name`, `surname`, `state`, `haslo`, `idGROUP`, `email`) VALUES
(1, 'Marek', 'Bocian', 1, '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 1, 'bocian@o2.pl'),
(2, 'Iwona', 'Lak', 1, 'reksio', 2, 'lak@o2.pl'),
(3, 'Marcin', 'Kruk', 1, 'reksio', 2, 'kruk@o2.pl'),
(4, 'Stefan', 'Mazur', 1, 'reksio', 1, 'mazur@o2.pl');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zmiana`
--

CREATE TABLE `zmiana` (
  `id_zmiany` int(11) NOT NULL,
  `start` time NOT NULL,
  `koniec` time NOT NULL,
  `star` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `zmiana`
--

INSERT INTO `zmiana` (`id_zmiany`, `start`, `koniec`, `star`) VALUES
(1, '06:00:00', '14:00:00', 6),
(2, '14:00:00', '22:00:00', 14),
(3, '22:00:00', '06:00:00', 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`idGROUP`),
  ADD KEY `idLINE` (`idLINE`);

--
-- Indeksy dla tabeli `line`
--
ALTER TABLE `line`
  ADD PRIMARY KEY (`idLINE`),
  ADD KEY `idGROUP` (`idGROUP`);

--
-- Indeksy dla tabeli `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_produktu`);

--
-- Indeksy dla tabeli `sprzedaz`
--
ALTER TABLE `sprzedaz`
  ADD PRIMARY KEY (`id_sprzedazy`),
  ADD KEY `id_uzytkownika` (`id_uzytkownika`),
  ADD KEY `id_produktu` (`id_produktu`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `worker`
--
ALTER TABLE `worker`
  ADD PRIMARY KEY (`idWORKER`),
  ADD KEY `idGROUP` (`idGROUP`);

--
-- Indeksy dla tabeli `zmiana`
--
ALTER TABLE `zmiana`
  ADD PRIMARY KEY (`id_zmiany`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `line`
--
ALTER TABLE `line`
  MODIFY `idLINE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `product`
--
ALTER TABLE `product`
  MODIFY `id_produktu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `sprzedaz`
--
ALTER TABLE `sprzedaz`
  MODIFY `id_sprzedazy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT dla tabeli `worker`
--
ALTER TABLE `worker`
  MODIFY `idWORKER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

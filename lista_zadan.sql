-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 03 Sty 2023, 20:10
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `lista_zadan`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `login` varchar(30) COLLATE utf8mb4_polish_ci NOT NULL,
  `haslo` varchar(8) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`login`, `haslo`) VALUES
('aaaa', '00000000'),
('ala', '12345678'),
('nowak', 'nowak123'),
('olaola', '@#$%^&*('),
('olenka', 'a@o()45l'),
('paula', 'kwiatek0'),
('paulinka27', '*&^hsj)0');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zadania`
--

CREATE TABLE `zadania` (
  `id` int(11) NOT NULL,
  `tytul` varchar(50) COLLATE utf8mb4_polish_ci NOT NULL,
  `deadline` date NOT NULL,
  `status` enum('do zrobienia','zakończone','w trakcie') COLLATE utf8mb4_polish_ci NOT NULL,
  `uz_login` varchar(30) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `zadania`
--

INSERT INTO `zadania` (`id`, `tytul`, `deadline`, `status`, `uz_login`) VALUES
(17, 'sadfjgaet', '2023-01-19', 'zakończone', 'ala'),
(20, 'rfykyuikl', '2022-12-31', 'w trakcie', 'nowak'),
(30, 'dgut,lyij', '2022-12-22', 'w trakcie', 'nowak'),
(35, 'ahsdrnvakler', '2023-02-18', 'do zrobienia', 'nowak'),
(40, 'uo;uodrfbh', '2023-02-21', 'do zrobienia', 'ala'),
(41, 'fhtukyril', '2022-12-29', 'w trakcie', 'nowak'),
(42, 'sdbfgyjtu', '2023-03-24', 'do zrobienia', 'nowak'),
(43, 'dfbrher', '2023-03-24', 'w trakcie', 'ala'),
(45, 'sdjncfdkrl', '2023-03-31', 'do zrobienia', 'ala'),
(46, 'dcjfnkdr', '2023-04-22', 'do zrobienia', 'aaaa'),
(47, 'sdfhnskde', '2023-02-24', 'w trakcie', 'aaaa'),
(48, 'sdchajs', '2023-01-02', 'zakończone', 'aaaa'),
(49, 'sggdhcbjaks', '2023-04-15', 'do zrobienia', 'olaola'),
(50, 'shchnjkd', '2023-01-01', 'zakończone', 'olaola'),
(51, 'shjnke', '2023-01-31', 'w trakcie', 'olaola'),
(52, 'ashbcnjk', '2023-01-29', 'w trakcie', 'olaola'),
(53, 'sghjk', '2023-03-23', 'do zrobienia', 'olaola');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`login`);

--
-- Indeksy dla tabeli `zadania`
--
ALTER TABLE `zadania`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uz_login` (`uz_login`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `zadania`
--
ALTER TABLE `zadania`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `zadania`
--
ALTER TABLE `zadania`
  ADD CONSTRAINT `zadania_ibfk_1` FOREIGN KEY (`uz_login`) REFERENCES `uzytkownicy` (`login`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

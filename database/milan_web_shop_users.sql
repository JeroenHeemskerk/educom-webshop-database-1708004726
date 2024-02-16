-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 16 feb 2024 om 11:29
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
-- Database: `milan_web_shop_users`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `milan_webshop`
--

CREATE TABLE `milan_webshop` (
  `email` varchar(50) NOT NULL,
  `user` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `milan_webshop`
--

INSERT INTO `milan_webshop` (`email`, `user`, `password`) VALUES
('email@test.nl', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'test'),
('test2@electricboogaloo.nl', '123456789012345678901234567890', 'test'),
('test@test.nl', 'Name', 'test'),
('test@tester.nl', 'Dickens', 'PutMeInCoach');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `milan_webshop`
--
ALTER TABLE `milan_webshop`
  ADD PRIMARY KEY (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

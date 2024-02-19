-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 19 feb 2024 om 09:10
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
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `milan_webshop`
--

INSERT INTO `milan_webshop` (`email`, `user`, `password`) VALUES
('again@email.nl', 'Again', '$2y$14$wZaqqM6mGuYiGabHjNLW4Oj'),
('e@mail.test', 'test', '$2y$14$8/QPCkQ6TOFXHA7SEEhmcuk/S25JtYIYJyE/YUtErjl1tG9SZkrem'),
('email@emailer.nl', 'test', '$2y$14$EDBxtFhwHpwLJVf6iJN7Le6MfeG5ZhXxiwgTr9iUCJK20MeGL9bYa'),
('email@test.nl', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'test'),
('t@est.nl', 'test', '$2y$14$1Mhns8K1EcqvAJZ.pAelDufw2z9eNovqhniOTlcZuX6GUqdVeReCO'),
('test2@electricboogaloo.nl', '123456789012345678901234567890', 'test'),
('test@email.nl', 'test', '$2y$14$jBZwlppXEZcCgevgBntcJuqlEMXBfhnoWddpKh5kZTx2wddWAUGIG'),
('test@test.nl', 'Name', 'test'),
('test@tester.nl', 'Dickens', 'PutMeInCoach'),
('tester@tester.nl', 'tester', '$2y$14$9sxutKwo7p4hM5CDVu1iruUMMuGlyvdLRx9e4mwW5t4/fQSoUmdo.'),
('testtest@email.com', 'test', '$2y$14$Sr77D6TpUYe0WRDbVBO0QOP'),
('twist@twister.nl', 'test', '$2y$14$Dor5TIjexAKdKuOFhvbi4e8KrRtpyeBwdgkR3z.jP0AuOLw8vAmi6');

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

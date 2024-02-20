-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 20 feb 2024 om 09:22
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

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orders_content`
--

CREATE TABLE `orders_content` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`) VALUES
(1, 'Ijsvogel', 'Haal een herinnering aan de wonderen van de natuur in huis of naar kantoor met dit gedetailleerde en kleurrijke displaymodel.', 49.99, 'lego_bird.png'),
(2, 'De insecten collectie', 'Breng buitengewone wezens tot leven met deze realistische, levensechte blikvangers van drie prachtige insecten.', 79.99, 'lego_bug.png'),
(3, 'Kersenbloemsels', 'Bouwbare bloesems – zaai de zaadjes van creativiteit met de Kersenbloesems, een leuk cadeau voor kinderen vanaf 8 jaar en volwassenen die van bloemen houden', 14.99, 'lego_cherryblossom.png'),
(4, 'Geluksdraak', 'Vier het jaar van de Draak!', 79.99, 'lego_dragon.png'),
(5, 'Dune Ornithopter', 'Bouw een gedetailleerd 1369-delig model van het legendarische Huis Atreides vliegtuig uit de film Dune: Part One uit 2021.', 164.99, 'lego_ornithoper.png');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `user` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `milan_webshop`
--
ALTER TABLE `milan_webshop`
  ADD PRIMARY KEY (`email`);

--
-- Indexen voor tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexen voor tabel `orders_content`
--
ALTER TABLE `orders_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexen voor tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `orders_content`
--
ALTER TABLE `orders_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Beperkingen voor tabel `orders_content`
--
ALTER TABLE `orders_content`
  ADD CONSTRAINT `orders_content_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `orders_content_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

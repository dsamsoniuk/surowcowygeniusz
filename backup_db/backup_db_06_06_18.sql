-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 06 Cze 2018, 21:43
-- Wersja serwera: 10.1.28-MariaDB
-- Wersja PHP: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `game`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `build`
--

CREATE TABLE `build` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wood` int(11) NOT NULL,
  `stone` int(11) NOT NULL,
  `gold` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `build`
--

INSERT INTO `build` (`id`, `name`, `wood`, `stone`, `gold`, `time`, `type`, `level`) VALUES
(1, 'Chata drwala', 33, 11, 11, 45, 'chata', 1),
(2, 'Tartak', 100, 111, 111, 111, 'chata', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `migration_versions`
--

INSERT INTO `migration_versions` (`version`) VALUES
('20180601190623'),
('20180601191404');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `date`, `username`, `email`) VALUES
(1, 'damian', 'aa', '2018-06-19 00:00:00', 'JacekPlace', 'place@gmail.com'),
(10, 'pawel', 'placek', '2018-06-06 21:33:25', 'PawelP', 'placki@gmail.com');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user2`
--

CREATE TABLE `user2` (
  `id` int(11) NOT NULL,
  `username` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `user2`
--

INSERT INTO `user2` (`id`, `username`, `password`, `email`, `is_active`) VALUES
(1, 'admin', 'aa', 'aa@aa.aa', 1),
(5, 'damian', '$2y$13$roxZnk7/Siq4ADkXkKgqtehF2h7fKGOn2GPTbOwKvpje.aUUgbQL6', 'costam_aa@aa.aa', 1),
(6, 'aa', '$2y$13$9xngWHpjBvJpQxBxN6NpT.oiYH6eTDumD.Dna/qNT5BjD7CAOlaEK', 'costam_aa22@aa.aa', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user2build`
--

CREATE TABLE `user2build` (
  `id` int(11) NOT NULL,
  `build_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `state` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:simple_array)',
  `datetime_start` datetime DEFAULT NULL,
  `datetime_end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `user2build`
--

INSERT INTO `user2build` (`id`, `build_id`, `user_id`, `state`, `datetime_start`, `datetime_end`) VALUES
(20, 1, 1, 'active', '2018-06-06 18:36:13', '2018-06-06 18:36:58'),
(21, 2, 1, 'active', '2018-06-06 19:16:22', '2018-06-06 19:11:13'),
(22, 1, 1, 'active', '2018-06-06 19:50:45', '2018-06-06 19:51:30'),
(23, 2, 1, 'active', '2018-06-06 20:07:03', '2018-06-06 20:08:54'),
(24, 1, 1, 'active', '2018-06-06 20:12:53', '2018-06-06 20:13:38'),
(25, 2, 1, 'active', '2018-06-06 20:13:29', '2018-06-06 20:15:20'),
(26, 1, 10, 'active', '2018-06-06 21:41:00', '2018-06-06 21:41:45'),
(27, 1, 10, 'active', '2018-06-06 21:41:13', '2018-06-06 21:41:58');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user2source`
--

CREATE TABLE `user2source` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `wood` int(11) NOT NULL,
  `stone` int(11) NOT NULL,
  `gold` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `user2source`
--

INSERT INTO `user2source` (`id`, `user_id`, `wood`, `stone`, `gold`) VALUES
(1, 1, 974, 4200, 1425),
(4, 10, 368, 3412, 321);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `build`
--
ALTER TABLE `build`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user2`
--
ALTER TABLE `user2`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_D499FBEBF85E0677` (`username`),
  ADD UNIQUE KEY `UNIQ_D499FBEBE7927C74` (`email`);

--
-- Indexes for table `user2build`
--
ALTER TABLE `user2build`
  ADD PRIMARY KEY (`id`),
  ADD KEY `build_id` (`build_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user2source`
--
ALTER TABLE `user2source`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `build`
--
ALTER TABLE `build`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `user2`
--
ALTER TABLE `user2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `user2build`
--
ALTER TABLE `user2build`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT dla tabeli `user2source`
--
ALTER TABLE `user2source`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `user2build`
--
ALTER TABLE `user2build`
  ADD CONSTRAINT `user2build_ibfk_1` FOREIGN KEY (`build_id`) REFERENCES `build` (`id`),
  ADD CONSTRAINT `user2build_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Ograniczenia dla tabeli `user2source`
--
ALTER TABLE `user2source`
  ADD CONSTRAINT `FK_D0B9496BA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

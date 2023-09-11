-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql01.kevinosd.beep.pl:3306
-- Czas generowania: 12 Wrz 2022, 14:59
-- Wersja serwera: 5.7.31-34-log
-- Wersja PHP: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `bazadomeny`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `answers`
--

CREATE TABLE `answers` (
  `ida` int(11) NOT NULL,
  `idr` int(11) NOT NULL DEFAULT '0',
  `a` int(11) NOT NULL DEFAULT '0',
  `b` int(11) NOT NULL DEFAULT '0',
  `c` int(11) NOT NULL DEFAULT '0',
  `d` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `logs`
--

CREATE TABLE `logs` (
  `idl` int(11) NOT NULL,
  `idu` int(11) NOT NULL DEFAULT '0',
  `browser` text COLLATE utf8_polish_ci NOT NULL,
  `ip` text COLLATE utf8_polish_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `kk` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `logs`
--

INSERT INTO `logs` (`idl`, `idu`, `browser`, `ip`, `date`, `kk`) VALUES
(1, 3, 'Chrome', '', '2022-05-10 21:26:34', 1),
(2, 3, 'Chrome', '188.47.70.207', '2022-05-10 21:31:40', 1),
(3, 3, 'Chrome', '188.47.70.207', '2022-05-10 21:31:51', 0),
(4, 3, 'Chrome', '188.47.70.207', '2022-05-10 21:45:56', 0),
(5, 3, 'Chrome', '188.47.70.207', '2022-05-10 21:46:03', 1),
(6, 0, 'Chrome', '188.47.70.207', '2022-05-10 21:47:38', 0),
(7, 3, 'Chrome', '188.47.70.207', '2022-05-10 21:49:26', 1),
(8, 0, 'Chrome', '188.47.70.207', '2022-05-10 21:49:30', 0),
(9, 3, 'Chrome', '188.47.70.207', '2022-05-10 21:50:24', 1),
(10, 3, 'Chrome', '188.47.71.149', '2022-05-13 15:50:07', 1),
(11, 3, 'Chrome', '188.47.71.149', '2022-05-13 15:51:52', 1),
(12, 3, 'Chrome', '188.47.71.149', '2022-05-13 15:51:56', 0),
(13, 0, 'Chrome', '188.47.71.149', '2022-05-13 15:51:59', 0),
(14, 0, 'Chrome', '188.47.71.149', '2022-05-13 15:51:59', 0),
(15, 0, 'Chrome', '188.47.71.149', '2022-05-13 15:52:00', 0),
(16, 3, 'Chrome', '188.47.71.149', '2022-05-13 16:03:06', 1),
(17, 3, 'Chrome', '188.47.71.149', '2022-05-13 16:03:36', 1),
(18, 3, 'Chrome', '188.47.71.149', '2022-05-13 16:08:47', 1),
(19, 3, 'Chrome', '188.47.71.149', '2022-05-13 16:09:22', 1),
(20, 3, 'Chrome', '188.47.71.149', '2022-05-13 16:10:58', 1),
(21, 3, 'Chrome', '188.47.71.149', '2022-05-13 16:11:42', 1),
(22, 3, 'Chrome', '188.47.71.149', '2022-05-13 16:12:14', 1),
(23, 3, 'Chrome', '188.47.71.149', '2022-05-13 16:13:22', 1),
(24, 3, 'Chrome', '188.47.71.149', '2022-05-13 16:13:44', 1),
(25, 3, 'Chrome', '188.47.71.149', '2022-05-13 16:18:22', 1),
(26, 3, 'Chrome', '188.47.71.149', '2022-05-13 16:19:36', 1),
(27, 3, 'Chrome', '188.47.71.149', '2022-05-13 16:25:47', 1),
(28, 3, 'Chrome', '188.47.71.149', '2022-05-13 16:27:11', 1),
(29, 3, 'Chrome', '188.47.71.149', '2022-05-13 16:27:59', 1),
(30, 3, 'Chrome', '188.47.71.149', '2022-05-13 16:28:58', 1),
(31, 3, 'Chrome', '188.47.71.149', '2022-05-13 16:31:35', 1),
(32, 3, 'Chrome', '188.47.71.149', '2022-05-13 16:32:01', 1),
(33, 3, 'Chrome', '188.47.71.149', '2022-05-13 16:34:38', 1),
(34, 3, 'Chrome', '188.47.71.149', '2022-05-13 16:37:17', 1),
(35, 3, 'Chrome', '188.47.71.149', '2022-05-13 16:51:18', 1),
(36, 3, 'Chrome', '188.47.71.149', '2022-05-13 16:57:06', 1),
(37, 3, 'Chrome', '188.47.71.149', '2022-05-13 17:25:13', 1),
(38, 3, 'Chrome', '188.47.71.149', '2022-05-14 10:11:57', 1),
(39, 3, 'Chrome', '188.47.71.149', '2022-05-14 10:41:23', 1),
(40, 3, 'Chrome', '188.47.71.149', '2022-05-14 10:41:51', 1),
(41, 3, 'Chrome', '31.0.22.229', '2022-05-14 13:26:58', 1),
(42, 3, 'Chrome', '188.47.71.149', '2022-05-14 15:44:06', 1),
(43, 3, 'Chrome', '188.47.71.149', '2022-05-14 15:59:57', 1),
(44, 3, 'Chrome', '188.47.71.149', '2022-05-14 18:07:34', 1),
(45, 3, 'Chrome', '188.47.71.149', '2022-05-14 18:30:53', 1),
(46, 3, 'Chrome', '188.47.71.149', '2022-05-14 18:49:15', 1),
(47, 3, 'Chrome', '188.47.71.149', '2022-05-14 18:53:28', 1),
(48, 3, 'Chrome', '188.47.71.149', '2022-05-14 19:54:23', 1),
(49, 3, 'Chrome', '188.47.71.149', '2022-05-15 10:43:38', 1),
(50, 5, 'Chrome', '188.47.71.149', '2022-05-15 11:23:12', 1),
(51, 3, 'Chrome', '188.47.71.149', '2022-05-15 11:23:35', 1),
(52, 5, 'Chrome', '188.47.71.149', '2022-05-15 11:26:35', 1),
(53, 3, 'Chrome', '188.47.71.149', '2022-05-15 11:26:42', 1),
(54, 3, 'Chrome', '188.47.71.149', '2022-05-15 12:29:57', 1),
(55, 3, 'Chrome', '188.47.71.149', '2022-05-15 14:16:58', 1),
(56, 3, 'Chrome', '188.47.71.149', '2022-05-15 14:21:50', 1),
(57, 3, 'Chrome', '188.47.71.149', '2022-05-15 15:10:20', 1),
(58, 3, 'Chrome', '188.47.71.149', '2022-05-15 17:56:13', 1),
(59, 3, 'Chrome', '188.47.71.149', '2022-05-15 19:58:28', 1),
(60, 3, 'Chrome', '188.47.71.149', '2022-05-16 10:03:54', 1),
(61, 3, 'Chrome', '188.47.71.149', '2022-05-16 10:13:08', 1),
(62, 5, 'Chrome', '188.47.71.149', '2022-05-16 10:26:24', 1),
(63, 5, 'Chrome', '188.47.71.149', '2022-05-16 10:29:13', 1),
(64, 5, 'Chrome', '188.47.71.149', '2022-05-16 10:29:17', 1),
(65, 3, 'Chrome', '188.47.71.149', '2022-05-16 10:47:12', 1),
(66, 3, 'Chrome', '31.0.22.242', '2022-05-16 12:37:05', 1),
(67, 3, 'Chrome', '188.47.71.149', '2022-05-16 13:50:08', 1),
(68, 3, 'Chrome', '188.47.71.149', '2022-05-16 13:55:38', 1),
(69, 3, 'Chrome', '188.47.71.149', '2022-05-16 15:02:14', 1),
(70, 3, 'Chrome', '188.47.71.149', '2022-05-16 15:52:51', 1),
(71, 5, 'Chrome', '188.47.71.149', '2022-05-16 15:53:31', 1),
(72, 3, 'Chrome', '188.47.71.149', '2022-05-16 15:54:09', 1),
(73, 3, 'Chrome', '188.47.71.149', '2022-05-16 16:16:12', 1),
(74, 3, 'Chrome', '188.47.71.149', '2022-05-16 17:38:52', 1),
(75, 3, 'Chrome', '188.47.71.149', '2022-05-16 18:20:55', 1),
(76, 3, 'Chrome', '188.47.71.149', '2022-05-16 18:24:23', 1),
(77, 3, 'Chrome', '188.47.71.149', '2022-05-16 18:38:00', 1),
(78, 3, 'Chrome', '188.47.71.149', '2022-05-16 18:38:46', 1),
(79, 3, 'Chrome', '188.47.71.149', '2022-05-16 18:49:36', 1),
(80, 3, 'Chrome', '188.47.71.149', '2022-05-16 19:39:03', 1),
(81, 3, 'Chrome', '188.47.61.48', '2022-06-10 12:39:48', 1),
(82, 5, 'Chrome', '188.47.61.48', '2022-06-10 12:42:28', 1),
(83, 3, 'Chrome', '83.25.64.77', '2022-06-30 15:19:46', 1),
(84, 3, 'Chrome', '83.25.63.139', '2022-07-08 19:53:29', 1),
(85, 3, 'Chrome', '37.248.202.137', '2022-07-13 17:58:45', 1),
(86, 3, 'Chrome', '83.25.55.70', '2022-07-21 21:13:59', 1),
(87, 3, 'Chrome', '83.25.61.170', '2022-09-06 19:20:44', 1),
(88, 3, 'Chrome', '83.25.58.103', '2022-09-08 15:49:27', 1),
(89, 3, 'Chrome', '83.25.58.103', '2022-09-08 16:18:16', 1),
(90, 5, 'Chrome', '83.25.58.103', '2022-09-08 16:20:54', 1),
(91, 5, 'Chrome', '83.25.58.103', '2022-09-08 16:27:14', 1),
(92, 5, 'Chrome', '83.25.58.103', '2022-09-08 16:35:21', 1),
(93, 5, 'Chrome', '83.25.58.103', '2022-09-08 19:18:29', 1),
(94, 3, 'Chrome', '83.25.58.103', '2022-09-09 14:59:10', 1),
(95, 3, 'Chrome', '83.25.58.103', '2022-09-09 15:20:33', 1),
(96, 3, 'Chrome', '83.25.58.103', '2022-09-10 14:49:34', 1),
(97, 3, 'Chrome', '83.25.58.103', '2022-09-11 21:49:38', 1),
(98, 0, 'Chrome', '83.25.58.103', '2022-09-12 14:55:39', 0),
(99, 3, 'Chrome', '83.25.58.103', '2022-09-12 14:55:53', 0),
(100, 0, 'Chrome', '83.25.58.103', '2022-09-12 14:55:55', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `quest`
--

CREATE TABLE `quest` (
  `idq` int(11) NOT NULL,
  `idu` int(11) NOT NULL DEFAULT '0',
  `idc` int(11) NOT NULL DEFAULT '0',
  `title` text COLLATE utf8_polish_ci NOT NULL,
  `text` text COLLATE utf8_polish_ci,
  `file` int(11) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `people` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `quest`
--

INSERT INTO `quest` (`idq`, `idu`, `idc`, `title`, `text`, `file`, `start_date`, `end_date`, `people`) VALUES
(1, 3, 0, 'Wystawienie faktur', 'WykonaÄ‡ naleÅ¼y grafiki do mediÃ³w spoÅ‚ecznoÅ›ciowych.', NULL, '2022-05-13 19:30:00', '2022-05-31 23:59:00', 1),
(8, 3, 0, 'Wykonanie grafik', 'WykonaÄ‡ naleÅ¼y grafiki do mediÃ³w \r\nspoÅ‚ecznoÅ›ciowych.', NULL, '2022-05-18 19:30:00', '2022-05-31 23:59:00', 1),
(9, 3, 0, 'Przygotowanie testu', 'fd', NULL, '2018-06-12 19:30:00', '2022-06-12 19:30:00', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `questions`
--

CREATE TABLE `questions` (
  `idquestion` int(11) NOT NULL,
  `idcategory` int(11) NOT NULL DEFAULT '0',
  `text` text COLLATE utf8_polish_ci NOT NULL,
  `answer_a` text COLLATE utf8_polish_ci NOT NULL,
  `answer_b` text COLLATE utf8_polish_ci NOT NULL,
  `answer_c` text COLLATE utf8_polish_ci NOT NULL,
  `answer_d` text COLLATE utf8_polish_ci NOT NULL,
  `value_a` int(11) NOT NULL DEFAULT '0',
  `value_b` int(11) NOT NULL DEFAULT '0',
  `value_c` int(11) NOT NULL DEFAULT '0',
  `value_d` int(11) NOT NULL DEFAULT '0',
  `file` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `quest_contractor`
--

CREATE TABLE `quest_contractor` (
  `idqc` int(11) NOT NULL,
  `idq` int(11) NOT NULL,
  `idu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `results`
--

CREATE TABLE `results` (
  `idr` int(11) NOT NULL,
  `idu` int(11) NOT NULL DEFAULT '0',
  `idt` int(11) NOT NULL DEFAULT '0',
  `result` int(11) NOT NULL DEFAULT '0',
  `max_points` int(11) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `subquest`
--

CREATE TABLE `subquest` (
  `idsq` int(11) NOT NULL,
  `idq` int(11) NOT NULL DEFAULT '0',
  `text` text COLLATE utf8_polish_ci NOT NULL,
  `notification` int(11) NOT NULL DEFAULT '0',
  `confirmed` int(11) NOT NULL DEFAULT '0',
  `file_confirm` int(11) NOT NULL DEFAULT '0',
  `file` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `subquest`
--

INSERT INTO `subquest` (`idsq`, `idq`, `text`, `notification`, `confirmed`, `file_confirm`, `file`) VALUES
(1, 1, 'tÅ‚o', 0, 1, 0, ''),
(2, 1, 'ikona', 0, 1, 0, ''),
(3, 1, 'grafika profilowa', 0, 1, 0, ''),
(4, 1, 'baner', 0, 1, 0, ''),
(35, 8, 'ikony', 0, 0, 0, ''),
(36, 8, 'baner', 0, 1, 0, ''),
(37, 8, 'tÅ‚o', 0, 1, 0, ''),
(38, 9, '2', 0, 0, 0, ''),
(39, 9, '1', 0, 0, 0, ''),
(40, 9, '2', 0, 0, 0, ''),
(41, 9, '3', 0, 1, 0, '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `test`
--

CREATE TABLE `test` (
  `idt` int(11) NOT NULL,
  `idu` int(11) NOT NULL DEFAULT '0',
  `name` text COLLATE utf8_polish_ci NOT NULL,
  `time` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `test_contractor`
--

CREATE TABLE `test_contractor` (
  `idtc` int(11) NOT NULL,
  `idquestion` int(11) NOT NULL DEFAULT '0',
  `idt` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `idu` int(11) NOT NULL,
  `name` text COLLATE utf8_polish_ci,
  `surname` text COLLATE utf8_polish_ci,
  `pass` text COLLATE utf8_polish_ci,
  `email` text COLLATE utf8_polish_ci,
  `sex` int(11) DEFAULT NULL,
  `bday` date DEFAULT NULL,
  `verify` int(11) DEFAULT NULL,
  `vkey` text COLLATE utf8_polish_ci,
  `rank` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`idu`, `name`, `surname`, `pass`, `email`, `sex`, `bday`, `verify`, `vkey`, `rank`) VALUES
(1, 'kevin', NULL, '123', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Kevin', 'Adamski', '$2y$10$w7Ugu3naYZI.T.d6ACFNCOWo2yyopPv8orSqe.PF82N9ZApOfSenG', 'kevinosd1998@gmail.com', 1, '2022-05-02', 2, 'dfbd3fe393c4c73843d330bc5f880d65', 2),
(4, 'fg', 'fgdfg', '$2y$10$bLUdlvPlo3ZvoH6VnojdKOSVMNk4j1X5t5SOZ.67RcVx7rSIHBBSK', 'krf', 1, '2022-05-02', 1, '13a3362a947f1a163bf5879fcfb71826', 0),
(5, 'Jacek', 'Sasin', '$2y$10$VLcVvBuWzzsrJLwxKK0uruzm/c5/hkU4ZEDpgHtvQ4sRPxkHH6UC2', 'kapifreon@wp.pl', 1, '2021-04-07', 2, '71a13486d9c70326641e8fb4fc3095de', 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`ida`);

--
-- Indeksy dla tabeli `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`idl`);

--
-- Indeksy dla tabeli `quest`
--
ALTER TABLE `quest`
  ADD PRIMARY KEY (`idq`);

--
-- Indeksy dla tabeli `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`idquestion`);

--
-- Indeksy dla tabeli `quest_contractor`
--
ALTER TABLE `quest_contractor`
  ADD PRIMARY KEY (`idqc`);

--
-- Indeksy dla tabeli `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`idr`);

--
-- Indeksy dla tabeli `subquest`
--
ALTER TABLE `subquest`
  ADD PRIMARY KEY (`idsq`);

--
-- Indeksy dla tabeli `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`idt`);

--
-- Indeksy dla tabeli `test_contractor`
--
ALTER TABLE `test_contractor`
  ADD PRIMARY KEY (`idtc`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idu`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `answers`
--
ALTER TABLE `answers`
  MODIFY `ida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `logs`
--
ALTER TABLE `logs`
  MODIFY `idl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT dla tabeli `quest`
--
ALTER TABLE `quest`
  MODIFY `idq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `questions`
--
ALTER TABLE `questions`
  MODIFY `idquestion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `results`
--
ALTER TABLE `results`
  MODIFY `idr` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `subquest`
--
ALTER TABLE `subquest`
  MODIFY `idsq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT dla tabeli `test`
--
ALTER TABLE `test`
  MODIFY `idt` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `test_contractor`
--
ALTER TABLE `test_contractor`
  MODIFY `idtc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `idu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

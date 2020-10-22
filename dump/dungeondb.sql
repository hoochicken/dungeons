-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: dungeon_mysql
-- Erstellungszeit: 22. Okt 2020 um 20:30
-- Server-Version: 8.0.21
-- PHP-Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `dungeondb`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `action`
--

CREATE TABLE `action` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `description` varchar(1023) NOT NULL,
  `attributes` varchar(1023) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `created_user` int NOT NULL DEFAULT '0',
  `updated` datetime DEFAULT NULL,
  `updated_user` int NOT NULL DEFAULT '0',
  `deleted` datetime DEFAULT NULL,
  `deleted_user` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `action`
--

INSERT INTO `action` (`id`, `name`, `label`, `description`, `attributes`, `state`, `created`, `created_user`, `updated`, `updated_user`, `deleted`, `deleted_user`) VALUES
(1, 'look', 'Look', '', '{}', 1, '2020-08-27 17:18:20', 0, NULL, 0, NULL, 0),
(2, 'chat', 'Chat', '', '{}', 1, '2020-08-27 17:18:20', 0, NULL, 0, NULL, 0),
(3, 'attack', 'Attack', '', '{}', 1, '2020-08-27 17:18:20', 0, NULL, 0, NULL, 0),
(4, 'walk', 'Walk', '', '{}', 1, '2020-08-27 17:18:20', 0, NULL, 0, NULL, 0),
(5, 'cheat', 'Cheat', '', '{}', 1, '2020-08-27 17:18:20', 0, NULL, 0, NULL, 0),
(6, 'spell', 'Spell', '', '{}', 1, '2020-08-27 17:18:20', 0, NULL, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `target` int NOT NULL,
  `attributes` varchar(1023) NOT NULL DEFAULT '{}',
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `created_user` int NOT NULL DEFAULT '0',
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_user` int NOT NULL DEFAULT '0',
  `deleted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_user` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `category`
--

INSERT INTO `category` (`id`, `name`, `target`, `attributes`, `state`, `created`, `created_user`, `updated`, `updated_user`, `deleted`, `deleted_user`) VALUES
(1, 'Item', 0, '{}', 1, '2020-08-27 17:20:06', 0, '2020-08-27 17:20:06', 0, '2020-08-27 17:20:06', 0),
(2, 'Weapon', 0, '{}', 1, '2020-08-27 17:20:06', 0, '2020-08-27 17:20:06', 0, '2020-08-27 17:20:06', 0),
(3, 'Immobile', 0, '{}', 1, '2020-08-27 17:20:06', 0, '2020-08-27 17:20:06', 0, '2020-08-27 17:20:06', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `demo`
--

CREATE TABLE `demo` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` smallint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `demo`
--

INSERT INTO `demo` (`id`, `title`, `description`, `state`) VALUES
(1, 'Custom Title', 'Custom Description', 1),
(2, 'Another Custom Title', 'Another Custom Description', 0),
(3, 'Yet Another Custom Title', 'Yet Another Custom Description', 1),
(4, 'Guess What!', 'Guess What This Is Description', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20201002172448', '2020-10-02 17:25:16', 604);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hero`
--

CREATE TABLE `hero` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` int NOT NULL,
  `class` int NOT NULL,
  `description` varchar(255) NOT NULL,
  `pic` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `le` int NOT NULL,
  `le_current` int NOT NULL,
  `ae` int NOT NULL DEFAULT '0',
  `ae_current` int NOT NULL DEFAULT '0',
  `inventory` varchar(1023) NOT NULL,
  `weapon` int NOT NULL,
  `at` int NOT NULL,
  `pa` int NOT NULL,
  `attributes` varchar(1023) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '{}',
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `created_user` int NOT NULL DEFAULT '0',
  `updated` datetime DEFAULT NULL,
  `updated_user` int NOT NULL DEFAULT '0',
  `deleted` datetime DEFAULT NULL,
  `deleted_user` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `hero`
--

INSERT INTO `hero` (`id`, `name`, `type`, `class`, `description`, `pic`, `le`, `le_current`, `ae`, `ae_current`, `inventory`, `weapon`, `at`, `pa`, `attributes`, `state`, `created`, `created_user`, `updated`, `updated_user`, `deleted`, `deleted_user`) VALUES
(1, 'Maryan', 1, 2, '', '', 20, 16, 3, 2, '', 1, 10, 10, '{}', 1, '2020-08-27 17:18:36', 0, NULL, 0, NULL, 0),
(2, 'Grump', 1, 2, '', '', 19, 17, 10, 8, '', 3, 15, 12, '{}', 1, '2020-08-27 17:18:36', 0, NULL, 0, NULL, 0),
(3, 'Thomi', 1, 2, '', '', 1, 1, 1, 1, '', 1, 1, 1, '{}', 1, '2020-08-27 17:18:36', 0, NULL, 0, NULL, 0),
(4, 'asd', 1, 1, '', '', 1, 1, 1, 1, '', 1, 1, 1, '{}', 1, '2020-08-27 17:18:36', 0, NULL, 0, NULL, 0),
(5, 'Mandela Tippy', 1, 4, '', '', 4, 3, 1, 1, '', 1, 1, 1, '{}', 1, '2020-08-27 17:18:36', 0, NULL, 0, NULL, 0),
(16, 'ERROR', 1, 1, '', '', 10000, 10000, 1000, 1000, '', 1, 21, 21, '{}', 1, '2020-08-27 17:18:36', 0, NULL, 0, NULL, 0),
(17, 'Hero of The Seventh Rye', 1, 2, '', '', 1, 1, 1, 1, '', 1, 1, 1, '{}', 1, '2020-08-27 17:18:36', 0, NULL, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hero_class`
--

CREATE TABLE `hero_class` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `attributes` varchar(1023) NOT NULL DEFAULT '{}',
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `created_user` int NOT NULL DEFAULT '0',
  `updated` datetime DEFAULT NULL,
  `updated_user` int NOT NULL DEFAULT '0',
  `deleted` datetime DEFAULT NULL,
  `deleted_user` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `hero_class`
--

INSERT INTO `hero_class` (`id`, `name`, `label`, `attributes`, `state`, `created`, `created_user`, `updated`, `updated_user`, `deleted`, `deleted_user`) VALUES
(1, 'human', 'Mensch', '{}', 1, '2020-08-27 17:19:00', 0, NULL, 0, NULL, 0),
(2, 'dwarf', 'Zwerg', '{}', 1, '2020-08-27 17:19:00', 0, NULL, 0, NULL, 0),
(3, 'elf', 'Elf', '{}', 1, '2020-08-27 17:19:00', 0, NULL, 0, NULL, 0),
(4, 'orc', 'Ork', '{}', 1, '2020-08-27 17:19:00', 0, NULL, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `item`
--

CREATE TABLE `item` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `decription` varchar(1023) NOT NULL,
  `itemtype` int NOT NULL,
  `pic` varchar(255) NOT NULL,
  `worth` float NOT NULL,
  `weight` float NOT NULL,
  `attributes` varchar(1023) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '{}',
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `created_user` int NOT NULL DEFAULT '0',
  `updated` datetime DEFAULT NULL,
  `updated_user` int NOT NULL DEFAULT '0',
  `deleted` datetime DEFAULT NULL,
  `deleted_user` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `item`
--

INSERT INTO `item` (`id`, `name`, `decription`, `itemtype`, `pic`, `worth`, `weight`, `attributes`, `state`, `created`, `created_user`, `updated`, `updated_user`, `deleted`, `deleted_user`) VALUES
(1, 'Schwert', 'Irgendein Schwert', 2, '', 2.3, 5.4, '{}', 1, '2020-08-27 17:20:05', 0, NULL, 0, NULL, 0),
(2, 'Truhe', '', 3, '', 100.3, 15.2, '{}', 1, '2020-08-27 17:20:05', 0, NULL, 0, NULL, 0),
(5, 'Bogen', '', 2, '', 10.2, 5.6, '{}', 1, '2020-08-27 17:20:05', 0, NULL, 0, NULL, 0),
(6, 'Karfunkelstein', '', 1, '', 5.5, 3.2, '{}', 1, '2020-08-27 17:20:05', 0, NULL, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `item2hero`
--

CREATE TABLE `item2hero` (
  `item_id` int NOT NULL,
  `hero_id` int NOT NULL,
  `attributes` varchar(1023) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '{}',
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `created_user` int NOT NULL DEFAULT '0',
  `updated` datetime DEFAULT NULL,
  `updated_user` int NOT NULL DEFAULT '0',
  `deleted` datetime DEFAULT NULL,
  `deleted_user` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `place`
--

CREATE TABLE `place` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(1023) NOT NULL,
  `pic` varchar(2000) NOT NULL,
  `misc` varchar(500) NOT NULL,
  `type` int DEFAULT '0',
  `attributes` varchar(1023) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '{}',
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `created_user` int NOT NULL DEFAULT '0',
  `updated` datetime DEFAULT NULL,
  `updated_user` int NOT NULL DEFAULT '0',
  `deleted` datetime DEFAULT NULL,
  `deleted_user` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `place`
--

INSERT INTO `place` (`id`, `name`, `description`, `pic`, `misc`, `type`, `attributes`, `state`, `created`, `created_user`, `updated`, `updated_user`, `deleted`, `deleted_user`) VALUES
(1, 'Waldeisens', 'This ist the forest description, yess!', 'C:\\fakepath\\download.png', 'NeOg8iCFfTA', 1, '{}', 0, '2020-08-27 17:20:06', 0, '2020-10-15 20:21:34', 0, NULL, 0),
(2, 'Sanddüne', '', '', '', 1, '{}', 1, '2020-08-27 17:20:06', 0, NULL, 0, NULL, 0),
(3, 'Steinkreis', '', '', '', 1, '{}', 1, '2020-08-27 17:20:06', 0, '2020-10-17 14:37:26', 0, NULL, 0),
(4, 'Hütte des Hellsehers', '', '', '', 1, '{}', 1, '2020-08-27 17:20:06', 0, NULL, 0, NULL, 0),
(5, 'Berghöhle', '', '', '', 1, '{}', 1, '2020-08-27 17:20:06', 0, NULL, 0, NULL, 0),
(6, 'Einhornwiese', '', '', '', 1, '{}', 1, '2020-08-27 17:20:06', 0, NULL, 0, NULL, 0),
(32, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 10:51:39', 0, NULL, 0, NULL, 0),
(33, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 10:52:44', 0, NULL, 0, NULL, 0),
(34, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 10:54:53', 0, NULL, 0, NULL, 0),
(35, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 11:13:24', 0, NULL, 0, NULL, 0),
(36, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 11:27:08', 0, NULL, 0, NULL, 0),
(37, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 11:28:07', 0, NULL, 0, NULL, 0),
(38, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 12:51:32', 0, NULL, 0, NULL, 0),
(39, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 12:52:37', 0, NULL, 0, NULL, 0),
(40, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 12:53:12', 0, NULL, 0, NULL, 0),
(41, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 12:54:08', 0, NULL, 0, NULL, 0),
(42, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 12:59:26', 0, NULL, 0, NULL, 0),
(43, 'Unicorn Meadow', 'You are standing on a wonderful green meadow, with flowers blooming and butterflies swarming about.', '', '', 0, '{}', 1, '2020-10-17 13:00:56', 0, '2020-10-17 13:03:52', 0, NULL, 0),
(44, 'Rotten Egg', 'Lorem Ipsum', '', '', 0, '{}', 1, '2020-10-17 13:04:02', 0, '2020-10-17 13:04:29', 0, NULL, 0),
(45, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 13:11:07', 0, NULL, 0, NULL, 0),
(46, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 13:11:49', 0, NULL, 0, NULL, 0),
(47, 'The witch house at the brim of the forest', 'In the shade of a wellknown tree is seated a small hut. Smoke is evading the chimney.', '', '', 0, '{}', 1, '2020-10-17 13:12:41', 0, '2020-10-17 13:14:08', 0, NULL, 0),
(48, 'Yes!', 'Lorem Ipsum II', '', '', 0, '{}', 1, '2020-10-17 13:14:47', 0, '2020-10-17 13:15:13', 0, NULL, 0),
(49, 'Whatever', '', '', '', 0, '{}', 1, '2020-10-17 13:25:31', 0, '2020-10-17 13:26:18', 0, NULL, 0),
(50, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 13:35:44', 0, NULL, 0, NULL, 0),
(51, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 13:36:25', 0, NULL, 0, NULL, 0),
(52, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 13:37:44', 0, NULL, 0, NULL, 0),
(53, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 13:38:39', 0, NULL, 0, NULL, 0),
(54, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 13:39:06', 0, NULL, 0, NULL, 0),
(55, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 13:39:10', 0, NULL, 0, NULL, 0),
(56, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 13:39:14', 0, NULL, 0, NULL, 0),
(69, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 16:22:33', 0, NULL, 0, NULL, 0),
(70, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 16:22:34', 0, NULL, 0, NULL, 0),
(71, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 16:22:53', 0, NULL, 0, NULL, 0),
(72, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 16:22:53', 0, NULL, 0, NULL, 0),
(73, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 16:23:41', 0, NULL, 0, NULL, 0),
(74, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 16:23:42', 0, NULL, 0, NULL, 0),
(75, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 16:25:00', 0, NULL, 0, NULL, 0),
(76, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 16:28:22', 0, NULL, 0, NULL, 0),
(77, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 16:35:18', 0, NULL, 0, NULL, 0),
(78, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 16:53:31', 0, NULL, 0, NULL, 0),
(79, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 16:57:11', 0, NULL, 0, NULL, 0),
(80, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 16:58:24', 0, NULL, 0, NULL, 0),
(81, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 16:59:36', 0, NULL, 0, NULL, 0),
(82, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 16:59:55', 0, NULL, 0, NULL, 0),
(83, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 17:00:54', 0, NULL, 0, NULL, 0),
(84, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 17:01:02', 0, NULL, 0, NULL, 0),
(85, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 17:01:26', 0, NULL, 0, NULL, 0),
(86, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 17:01:48', 0, NULL, 0, NULL, 0),
(87, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 17:02:10', 0, NULL, 0, NULL, 0),
(88, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 17:04:27', 0, NULL, 0, NULL, 0),
(89, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 17:04:35', 0, NULL, 0, NULL, 0),
(90, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 17:07:52', 0, NULL, 0, NULL, 0),
(91, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 17:30:22', 0, NULL, 0, NULL, 0),
(92, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 17:41:19', 0, NULL, 0, NULL, 0),
(93, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 17:43:37', 0, NULL, 0, NULL, 0),
(94, 'This is a new place', '', '', '', 0, '{}', 1, '2020-10-17 18:03:15', 0, '2020-10-17 18:03:27', 0, NULL, 0),
(95, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 20:45:01', 0, NULL, 0, NULL, 0),
(96, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 20:45:55', 0, NULL, 0, NULL, 0),
(97, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 20:47:29', 0, NULL, 0, NULL, 0),
(98, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 20:50:49', 0, NULL, 0, NULL, 0),
(99, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 20:51:47', 0, NULL, 0, NULL, 0),
(100, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 20:52:10', 0, NULL, 0, NULL, 0),
(101, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 20:53:27', 0, NULL, 0, NULL, 0),
(102, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 20:53:45', 0, NULL, 0, NULL, 0),
(103, 'Found a nice spot', '', '', '', 0, '{}', 1, '2020-10-17 20:54:11', 0, '2020-10-17 21:00:30', 0, NULL, 0),
(104, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 21:00:56', 0, NULL, 0, NULL, 0),
(105, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 21:20:40', 0, NULL, 0, NULL, 0),
(106, 'Here we go!', '', '', '', 0, '{}', 1, '2020-10-17 21:30:07', 0, '2020-10-17 21:30:19', 0, NULL, 0),
(107, 'New Place', '', '', '', 0, '{}', 1, '2020-10-18 09:07:20', 0, '2020-10-18 09:07:30', 0, NULL, 0),
(108, 'New Place', '', '', '', 0, '{}', 1, '2020-10-18 09:09:21', 0, NULL, 0, NULL, 0),
(109, 'New Place', '', '', '', 0, '{}', 1, '2020-10-18 09:10:25', 0, NULL, 0, NULL, 0),
(110, 'New Place', '', '', '', 0, '{}', 1, '2020-10-18 09:12:13', 0, NULL, 0, NULL, 0),
(111, 'New Place', '', '', '', 0, '{}', 1, '2020-10-18 09:12:47', 0, NULL, 0, NULL, 0),
(112, 'New Place', '', '', '', 0, '{}', 1, '2020-10-18 09:14:35', 0, NULL, 0, NULL, 0),
(113, 'New Place', '', '', '', 0, '{}', 1, '2020-10-18 09:15:57', 0, NULL, 0, NULL, 0),
(114, 'New Place', '', '', '', 0, '{}', 1, '2020-10-18 09:21:10', 0, NULL, 0, NULL, 0),
(115, 'New Place', '', '', '', 0, '{}', 1, '2020-10-18 09:23:03', 0, NULL, 0, NULL, 0),
(116, 'New Place', '', '', '', 0, '{}', 1, '2020-10-18 09:23:52', 0, NULL, 0, NULL, 0),
(117, 'New Place', '', '', '', 0, '{}', 1, '2020-10-18 09:24:39', 0, NULL, 0, NULL, 0),
(118, 'New Place', '', '', '', 0, '{}', 1, '2020-10-18 09:30:48', 0, NULL, 0, NULL, 0),
(119, 'New Place', '', '', '', 0, '{}', 1, '2020-10-18 09:33:42', 0, NULL, 0, NULL, 0),
(120, 'New Place', '', '', '', 0, '{}', 1, '2020-10-18 09:53:03', 0, NULL, 0, NULL, 0),
(121, 'Hell On Earth', '', '', '', 0, '{}', 1, '2020-10-18 10:25:21', 0, '2020-10-18 10:25:36', 0, NULL, 0),
(122, 'Fern wood', 'Green fern everywhere', '', '', 0, '{}', 1, '2020-10-18 10:27:20', 0, '2020-10-18 10:27:35', 0, NULL, 0),
(123, 'New Place', '', '', '', 0, '{}', 1, '2020-10-18 10:34:00', 0, NULL, 0, NULL, 0),
(124, 'New Place', '', '', '', 0, '{}', 1, '2020-10-18 12:04:32', 0, NULL, 0, NULL, 0),
(125, 'New Place', '', '', '', 0, '{}', 1, '2020-10-18 14:09:20', 0, NULL, 0, NULL, 0),
(126, 'New Place', '', '', '', 0, '{}', 1, '2020-10-18 14:22:22', 0, NULL, 0, NULL, 0),
(127, 'New Place', '', '', '', 0, '{}', 1, '2020-10-18 14:22:30', 0, NULL, 0, NULL, 0),
(128, 'New Place', '', '', '', 0, '{}', 1, '2020-10-22 18:13:22', 0, NULL, 0, NULL, 0),
(129, 'New Place', '', '', '', 0, '{}', 1, '2020-10-22 18:13:37', 0, NULL, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `route`
--

CREATE TABLE `route` (
  `id` int NOT NULL,
  `place_out` int NOT NULL,
  `place_in` int NOT NULL,
  `out_direction` int NOT NULL,
  `attributes` varchar(1023) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '{}',
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `created_user` int NOT NULL DEFAULT '0',
  `updated` datetime DEFAULT NULL,
  `updated_user` int NOT NULL DEFAULT '0',
  `deleted` datetime DEFAULT NULL,
  `deleted_user` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `route`
--

INSERT INTO `route` (`id`, `place_out`, `place_in`, `out_direction`, `attributes`, `state`, `created`, `created_user`, `updated`, `updated_user`, `deleted`, `deleted_user`) VALUES
(103, 127, 2, 8, '{}', 1, '2020-10-18 14:22:30', 0, NULL, 0, NULL, 0),
(104, 3, 128, 3, '{}', 1, '2020-10-22 18:13:23', 0, NULL, 0, NULL, 0),
(105, 0, 0, 3, '{}', 1, '2020-10-22 18:13:38', 0, NULL, 0, NULL, 0),
(108, 3, 2, 3, '{}', 1, '2020-10-22 18:13:23', 0, NULL, 0, NULL, 0),
(111, 0, 0, 3, '{}', 1, '2020-10-22 18:13:23', 0, NULL, 0, NULL, 0),
(112, 3, 2, 3, '{}', 1, '2020-10-22 18:13:23', 0, NULL, 0, NULL, 0);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `action`
--
ALTER TABLE `action`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `demo`
--
ALTER TABLE `demo`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indizes für die Tabelle `hero`
--
ALTER TABLE `hero`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `hero_class`
--
ALTER TABLE `hero_class`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `item2hero`
--
ALTER TABLE `item2hero`
  ADD PRIMARY KEY (`hero_id`,`item_id`) USING BTREE;

--
-- Indizes für die Tabelle `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `action`
--
ALTER TABLE `action`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `hero`
--
ALTER TABLE `hero`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT für Tabelle `hero_class`
--
ALTER TABLE `hero_class`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `item`
--
ALTER TABLE `item`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `place`
--
ALTER TABLE `place`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT für Tabelle `route`
--
ALTER TABLE `route`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

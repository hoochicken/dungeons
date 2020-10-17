-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: dungeon_mysql
-- Erstellungszeit: 17. Okt 2020 um 14:07
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
(3, 'Steinkreis', '', '', '', 1, '{}', 1, '2020-08-27 17:20:06', 0, '2020-10-10 18:25:24', 0, NULL, 0),
(4, 'Hütte des Hellsehers', '', '', '', 1, '{}', 1, '2020-08-27 17:20:06', 0, NULL, 0, NULL, 0),
(5, 'Berghöhle', '', '', '', 1, '{}', 1, '2020-08-27 17:20:06', 0, NULL, 0, NULL, 0),
(6, 'Einhornwiese', '', '', '', 1, '{}', 1, '2020-08-27 17:20:06', 0, NULL, 0, NULL, 0),
(13, 'A new Place', 'Holla die Waldfee', '', '', 0, '{}', 1, '2020-10-16 21:28:01', 0, NULL, 0, NULL, 0),
(14, 'A new Place', 'Holla die Waldfee', '', '', 0, '{}', 1, '2020-10-16 21:30:16', 0, NULL, 0, NULL, 0),
(15, 'A new Place', 'Holla die Waldfee', '', '', 0, '{}', 1, '2020-10-16 21:31:17', 0, NULL, 0, NULL, 0),
(16, 'A new Place', 'Holla die Waldfee', '', '', 0, '{}', 1, '2020-10-16 21:31:35', 0, NULL, 0, NULL, 0),
(17, 'A new Place', 'Holla die Waldfee', '', '', 0, '{}', 1, '2020-10-16 21:31:47', 0, NULL, 0, NULL, 0),
(18, 'A new Place', 'Holla die Waldfee', '', '', 0, '{}', 1, '2020-10-16 21:33:13', 0, NULL, 0, NULL, 0),
(19, 'aasdasd', 'Holla die Waldfee', '', '', 0, '{}', 1, '2020-10-17 09:17:57', 0, NULL, 0, NULL, 0),
(20, 'aasdasd', 'Holla die Waldfee', '', '', 0, '{}', 1, '2020-10-17 09:20:40', 0, NULL, 0, NULL, 0),
(21, 'aasdasd', 'Holla die Waldfee', '', '', 0, '{}', 1, '2020-10-17 09:30:40', 0, NULL, 0, NULL, 0),
(22, 'aasdasd', 'Holla die Waldfee', '', '', 0, '{}', 1, '2020-10-17 09:47:32', 0, NULL, 0, NULL, 0),
(23, 'aasdasd', 'Holla die Waldfee', '', '', 0, '{}', 1, '2020-10-17 09:48:54', 0, NULL, 0, NULL, 0),
(24, 'aasdasd', 'Holla die Waldfee', '', '', 0, '{}', 1, '2020-10-17 09:51:39', 0, NULL, 0, NULL, 0),
(25, 'aasdasd', 'Holla die Waldfee', '', '', 0, '{}', 1, '2020-10-17 09:55:33', 0, NULL, 0, NULL, 0),
(26, 'aasdasd', 'Holla die Waldfee', '', '', 0, '{}', 1, '2020-10-17 09:56:01', 0, NULL, 0, NULL, 0),
(27, 'aasdasd', 'Holla die Waldfee', '', '', 0, '{}', 1, '2020-10-17 09:57:41', 0, NULL, 0, NULL, 0),
(28, 'New Place', '', '', '', 0, '{}', 0, '2020-10-17 10:43:20', 0, NULL, 0, NULL, 0),
(29, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 10:46:28', 0, NULL, 0, NULL, 0),
(30, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 10:50:23', 0, NULL, 0, NULL, 0),
(31, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 10:51:37', 0, NULL, 0, NULL, 0),
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
(56, 'New Place', '', '', '', 0, '{}', 1, '2020-10-17 13:39:14', 0, NULL, 0, NULL, 0);

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
(1, 2, 1, 2, '{}', 1, '2020-08-27 17:20:06', 0, NULL, 0, NULL, 0),
(3, 2, 3, 2, '{}', 1, '2020-08-27 17:20:06', 0, NULL, 0, NULL, 0),
(4, 1, 2, 1, '{}', 1, '2020-08-27 17:20:06', 0, NULL, 0, NULL, 0),
(5, 4, 2, 3, '{}', 1, '2020-08-27 17:20:06', 0, NULL, 0, NULL, 0),
(8, 6, 4, 5, '{}', 1, '2020-08-27 17:20:06', 0, NULL, 0, NULL, 0),
(9, 6, 5, 6, '{}', 1, '2020-08-27 17:20:06', 0, NULL, 0, NULL, 0),
(10, 4, 6, 5, '{}', 1, '2020-08-27 17:20:06', 0, NULL, 0, NULL, 0),
(21, 4, 4, 6, '{}', 1, '2020-10-17 11:26:46', 0, NULL, 0, NULL, 0);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `in` (`place_in`,`out_direction`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT für Tabelle `route`
--
ALTER TABLE `route`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

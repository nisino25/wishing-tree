-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 24, 2022 at 12:00 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wishing_tree`
--

-- --------------------------------------------------------

--
-- Table structure for table `avatars`
--

CREATE TABLE `avatars` (
  `id` int(11) NOT NULL,
  `link` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `avatars`
--

INSERT INTO `avatars` (`id`, `link`) VALUES
(1, 'https://robohash.org/7NN.png?set=set1'),
(2, 'https://robohash.org/KSC.png?set=set2'),
(3, 'https://robohash.org/FZ4.png?set=set3'),
(4, 'https://robohash.org/VGT.png?set=set4');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trees`
--

CREATE TABLE `trees` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `wishes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT '[]',
  `isFull` tinyint(1) NOT NULL,
  `count` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trees`
--

INSERT INTO `trees` (`id`, `created_at`, `updated_at`, `wishes`, `isFull`, `count`) VALUES
(1, '2022-02-19 07:56:36', '2022-02-19 07:56:36', '[73,74,75,76,77,78,79,80,81,82]', 0, 10),
(2, '2022-02-19 07:56:31', '2022-02-19 07:56:31', '[111,112,113,114,115,116,117,118,119,120]', 0, 10),
(4, '2022-02-19 08:00:26', '2022-02-18 23:00:26', '[122,123,124,125,126,127,128,129,130,131]', 0, 10),
(5, '2022-02-20 02:27:59', '2022-02-19 17:27:59', '[132,133,134,135,136,137,138,139,140,141]', 0, 10),
(6, '2022-02-20 09:23:27', '2022-02-20 00:23:27', '[142,143,144,145,146,147]', 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `hashed_password` varchar(1024) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `wishes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `avatar_id` int(11) NOT NULL,
  `first_secret` varchar(1024) NOT NULL,
  `second_secret` varchar(1024) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `hashed_password`, `created_at`, `updated_at`, `wishes`, `avatar_id`, `first_secret`, `second_secret`, `isAdmin`) VALUES
(9, 'nisino25', '$2y$10$SdkC8TBtebmp8ftWQYV8Pe9m9cJTZ/sZbMxtIF8t3FcTb2n4N5gtS', '2022-02-20 07:23:00', '2022-02-19 22:23:00', '[75,76,77,78,133,134,135,136,137,138,139,140,141,142,143,144]', 4, '$2y$10$e1JBJMUPCmaSMAp4OR9h8eKTgNtMb8Q21SGPshoHXjlqiCdlfjT7m', '$2y$10$gyvu9jhTL7VmiEs5ktkSvOzT.EPrbt9R897Qjx/cC756doYi3sV8u', 1),
(10, 'cube', '$2y$10$sqX/6z2cTDVv/EhyM5DtFedNDxe45SpW5RPadEWeKgdk5S7gfWV/S', '2022-02-19 07:57:45', '2022-02-18 22:57:45', '[73,74,79,80,81,82,83,111,112,113,114,115,116,117,118,119,120,122,123,124,125,126,127,128,129]', 3, '$2y$10$Rmrpb/VLkycFRsA76JKvcOaJYKDH5yEcWo5jldsYd.pip/k4Lt7V2', '$2y$10$fTM4TDuFM1k8WHgA7m3Lb.ABvlMOvjWTNdOct36nM.5HOUN0dQOJy', 1),
(11, 'iphone', '$2y$10$MF7rEiNdcz45YJmzNyVRrO8JcN6PEAXkbvYyG2UtcQPzmRIMWiPJ.', '2022-02-19 08:00:26', '2022-02-18 23:00:26', '[130,131,132]', 2, '$2y$10$gfqxtLZWRxWukyS.5p4FB.XePMQw8whzqapN/BdasdVyqAearsy1e', '$2y$10$YpMAkDvFvauaFnjJE7zBt.32885wRjPO62bEAKcAFqfXOjP1q/KBS', 1),
(12, 'nozo', '$2y$10$vXa2D5DhflLupfuKmxus4.l399P.NiqSmZTTscM17AKGvWYyZEQ.2', '2022-02-19 23:42:01', '2022-02-20 08:42:01', NULL, 2, '$2y$10$.9VwkGJ2xYdOiqooRDTrA.ZCisM/Y.lFHYtCcAKH1BIqNMdrtp.yO', '$2y$10$YaVXpUAwGzZ0yjtboqzsqOf0eGq8YklDHFxOHyDQ3DkJ/JKupIEPK', 1),
(13, 'water', '$2y$10$s1v6Wrw.EHIZTByRIDKku.lczQNRALDJ.NXnZ59K0rnu4NLs9eoX.', '2022-02-20 08:52:47', '2022-02-19 23:52:47', '[145]', 4, '$2y$10$sSXD4qxKxEaVLsB.s9zAVODyRsUNG0FRVGrlKFzTxxKK7iMmSJy3a', '$2y$10$mj6wB/nMsBhgLR37bmTKq.7RiAfTBFt8kXbdX8/f5dS5elg8XwxFC', 1),
(14, 'abc', '$2y$10$6GsZbHMDha4zvp1LycwnH.2kVnANpVsSnUDFcyJ1audc5.Q9Ic6RK', '2022-02-20 08:57:58', '2022-02-19 23:57:58', '[146]', 4, '$2y$10$4qWJWhswQ7Icb/m4qHiyWOng3tQ/bxURbdG6skYhqpL8jaRunh.Jq', '$2y$10$me55D/AlYlRhduuuVZ9eWuvYBqk0.2IziXiFTusIh6AVvQDjdEt3S', 1),
(15, 'trees', '$2y$10$wGp/ANM/jviuKH5Q1kme2.xuztLGUlx5H3mPPcWY9yxm8m97qk0TG', '2022-02-20 09:50:20', '2022-02-20 00:23:27', '[147]', 4, '$2y$10$ou/fA/LQOJN8F0LrYU/Mdu9VFf/K113u1zKVkqqsAovwy.HvQUahK', '$2y$10$jsboyc0HSHs2CcbTdVDHp.l7bxMY8IgldLELFmB81urw.1xaat6GG', 1),
(16, 'ipad', '$2y$10$BYU5S6ChT/umhKqaZkJHceiM17VRqjEKEua0I4Szz5p15mMJrUMRu', '2022-02-20 00:45:09', '2022-02-20 09:45:09', NULL, 4, '$2y$10$TF2n0Zyz1plpArPhcDubD.ND6K4Mny3qFuS/sttXWmYcRB3R0QS9u', '$2y$10$KAOeBUbhNjYM41NSmzvg2OyUTuFJABfAHwU8p00IAX70B5x3JCAwC', 1),
(17, 'tree', '$2y$10$e69MkE7c8wGhqdN7D2m/bui6QwnAYW.IznYCzzlqt6Dd.cJ7VKLZe', '2022-02-20 00:50:57', '2022-02-20 09:50:57', NULL, 2, '$2y$10$nUK82OSX2JKZkNP4vHdvfukgg.xkMok19mBoVrkUgtFyjrXFpUP52', '$2y$10$InvUKrunXspC5wlzEYrK2.Ok6m31GSHYCzAx98H3lRR69BlHOHxCG', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wishes`
--

CREATE TABLE `wishes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_private` tinyint(1) NOT NULL,
  `is_deleted` int(1) NOT NULL DEFAULT 1,
  `content` varchar(10000) NOT NULL,
  `tree_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishes`
--

INSERT INTO `wishes` (`id`, `user_id`, `created_at`, `updated_at`, `is_private`, `is_deleted`, `content`, `tree_id`) VALUES
(73, 10, '2022-02-19 08:31:33', '0000-00-00 00:00:00', 1, 1, 'music', 1),
(74, 10, '2022-02-19 08:31:33', '0000-00-00 00:00:00', 1, 1, 'water', 1),
(75, 9, '2022-02-19 08:31:33', '0000-00-00 00:00:00', 1, 1, 'venti starbucks', 1),
(76, 9, '2022-02-23 14:22:55', '2022-02-23 05:22:55', 1, 0, 'new frapecino', 1),
(77, 9, '2022-02-23 14:24:21', '2022-02-23 05:24:21', 1, 0, 'new iphone', 1),
(78, 9, '2022-02-19 08:31:33', '2022-02-23 05:24:51', 1, 0, 'yorosiku', 1),
(79, 10, '2022-02-19 08:31:33', '0000-00-00 00:00:00', 1, 1, 'new cube', 1),
(80, 10, '2022-02-19 08:31:33', '0000-00-00 00:00:00', 1, 1, 'new pb', 1),
(81, 10, '2022-02-19 08:31:33', '0000-00-00 00:00:00', 1, 1, 'join the conmpetiton', 1),
(82, 10, '2022-02-19 08:31:33', '0000-00-00 00:00:00', 1, 1, 'pokemon', 1),
(111, 10, '2022-02-19 08:31:33', '0000-00-00 00:00:00', 1, 1, 'chociolate', 1),
(112, 10, '2022-02-19 08:31:33', '0000-00-00 00:00:00', 1, 1, 'yorosiku', 2),
(113, 10, '2022-02-19 08:31:33', '0000-00-00 00:00:00', 1, 1, 'what is going on', 2),
(114, 10, '2022-02-19 08:31:33', '0000-00-00 00:00:00', 1, 1, 'k', 2),
(115, 10, '2022-02-19 08:31:33', '0000-00-00 00:00:00', 1, 1, 'lol', 2),
(116, 10, '2022-02-19 08:31:33', '0000-00-00 00:00:00', 1, 1, 'one', 2),
(117, 10, '2022-02-19 08:31:33', '0000-00-00 00:00:00', 1, 1, 'two', 2),
(118, 10, '2022-02-19 08:31:33', '0000-00-00 00:00:00', 1, 1, 'three', 2),
(119, 10, '2022-02-19 08:31:33', '0000-00-00 00:00:00', 1, 1, 'four', 2),
(120, 10, '2022-02-19 08:31:33', '0000-00-00 00:00:00', 1, 1, 'five', 2),
(122, 10, '2022-02-19 08:31:33', '0000-00-00 00:00:00', 1, 1, 'please', 2),
(123, 10, '2022-02-19 08:31:33', '0000-00-00 00:00:00', 1, 1, 'i\'m trying out', 4),
(124, 10, '2022-02-19 08:31:33', '0000-00-00 00:00:00', 1, 1, 'is count cilumn actually gonna say that it is 10?', 4),
(125, 10, '2022-02-19 08:31:33', '0000-00-00 00:00:00', 1, 1, 'who knows', 4),
(126, 10, '2022-02-19 08:31:33', '0000-00-00 00:00:00', 1, 1, 'six more to go', 4),
(127, 10, '2022-02-19 08:31:33', '0000-00-00 00:00:00', 1, 1, 'im out of things to say', 4),
(128, 10, '2022-02-19 08:31:33', '0000-00-00 00:00:00', 1, 1, 'sup', 4),
(129, 10, '2022-02-19 08:31:33', '0000-00-00 00:00:00', 1, 1, 'yoro siku', 4),
(130, 11, '2022-02-19 08:31:33', '0000-00-00 00:00:00', 1, 1, 'new user', 4),
(131, 11, '2022-02-19 08:31:33', '0000-00-00 00:00:00', 1, 1, 'yorosiku', 4),
(132, 11, '2022-02-19 08:31:33', '0000-00-00 00:00:00', 1, 1, 'this is it', 4),
(133, 9, '2022-02-18 23:34:58', '0000-00-00 00:00:00', 1, 1, 'pikacyu', 5),
(134, 9, '2022-02-19 17:19:37', '0000-00-00 00:00:00', 1, 1, 'new cube', 5),
(135, 9, '2022-02-19 17:21:33', '0000-00-00 00:00:00', 1, 1, 'music', 5),
(136, 9, '2022-02-19 17:22:08', '0000-00-00 00:00:00', 1, 1, 'live', 5),
(137, 9, '2022-02-19 17:22:18', '0000-00-00 00:00:00', 1, 1, 'sup', 5),
(138, 9, '2022-02-19 17:23:41', '0000-00-00 00:00:00', 1, 1, 'tree', 5),
(139, 9, '2022-02-19 17:23:50', '0000-00-00 00:00:00', 1, 1, 'forest', 5),
(140, 9, '2022-02-19 17:25:57', '0000-00-00 00:00:00', 1, 1, 'new app', 5),
(141, 9, '2022-02-19 17:26:23', '0000-00-00 00:00:00', 0, 1, 'new game', 5),
(142, 9, '2022-02-19 17:27:59', '0000-00-00 00:00:00', 0, 1, 'new tree huh', 5),
(143, 9, '2022-02-19 22:18:40', '0000-00-00 00:00:00', 0, 1, 'avengers', 6),
(144, 9, '2022-02-19 22:23:00', '0000-00-00 00:00:00', 1, 1, 'new speakers', 6),
(145, 13, '2022-02-19 23:49:24', '0000-00-00 00:00:00', 1, 1, '雨がいっぱい降りますように', 6),
(146, 14, '2022-02-19 23:57:58', '0000-00-00 00:00:00', 1, 1, 'いい天気でありますように', 6),
(147, 15, '2022-02-20 00:23:27', '0000-00-00 00:00:00', 1, 1, '明日天気になりますように', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avatars`
--
ALTER TABLE `avatars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trees`
--
ALTER TABLE `trees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Test1` (`avatar_id`);

--
-- Indexes for table `wishes`
--
ALTER TABLE `wishes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Test2` (`user_id`),
  ADD KEY `Test3` (`tree_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avatars`
--
ALTER TABLE `avatars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `wishes`
--
ALTER TABLE `wishes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `Test1` FOREIGN KEY (`avatar_id`) REFERENCES `avatars` (`id`);

--
-- Constraints for table `wishes`
--
ALTER TABLE `wishes`
  ADD CONSTRAINT `Test2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `Test3` FOREIGN KEY (`tree_id`) REFERENCES `trees` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

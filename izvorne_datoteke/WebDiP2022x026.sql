-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2023 at 04:09 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webdip2022x026`
--

-- --------------------------------------------------------

--
-- Table structure for table `dnevnik_rada`
--

CREATE TABLE `dnevnik_rada` (
  `dnevnik_id` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `tip_radnje_id` int(11) NOT NULL,
  `datum_vrijeme_zapisa` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dnevnik_rada`
--

INSERT INTO `dnevnik_rada` (`dnevnik_id`, `email`, `tip_radnje_id`, `datum_vrijeme_zapisa`) VALUES
(1, 'patriklovrek007@gmail.com', 7, '2023-05-29 08:47:29'),
(2, 'plovrek@student.foi.hr', 7, '2023-05-29 09:01:13'),
(4, 'plovrek@student.foi.hr', 11, '2023-05-29 09:06:06'),
(6, 'plovrek@student.foi.hr', 7, '2023-05-29 09:23:17'),
(7, 'plovrek@student.foi.hr', 7, '2023-05-29 09:23:22'),
(9, 'plovrek@student.foi.hr', 14, '2023-05-29 09:31:12'),
(10, 'plovrek@student.foi.hr', 14, '2023-05-29 09:31:26'),
(11, 'plovrek@student.foi.hr', 14, '2023-05-29 09:40:59'),
(12, 'plovrek@student.foi.hr', 13, '2023-05-29 09:54:46'),
(13, 'pperic@gmail.com', 7, '2023-05-29 10:03:42'),
(14, 'patriklovrek007@gmail.com', 7, '2023-05-29 10:50:25'),
(15, 'patriklovrek007@gmail.com', 26, '2023-05-29 10:53:36'),
(16, 'patriklovrek007@gmail.com', 7, '2023-05-29 10:55:49'),
(17, 'patriklovrek007@gmail.com', 20, '2023-05-29 10:56:29'),
(18, 'patriklovrek007@gmail.com', 16, '2023-05-29 10:57:06'),
(19, 'patriklovrek007@gmail.com', 17, '2023-05-29 10:58:00'),
(20, 'patriklovrek007@gmail.com', 14, '2023-05-29 10:59:16'),
(21, 'patriklovrek007@gmail.com', 22, '2023-05-29 10:59:42'),
(22, 'patriklovrek007@gmail.com', 23, '2023-05-29 10:59:44'),
(23, 'patriklovrek007@gmail.com', 26, '2023-05-29 02:16:52'),
(24, 'atrivic@student.foi.hr', 2, '2023-05-29 02:17:38'),
(25, 'atrivic@student.foi.hr', 4, '2023-05-29 02:18:36'),
(26, 'atrivic@student.foi.hr', 11, '2023-05-29 02:18:42'),
(27, 'atrivic@student.foi.hr', 12, '2023-05-29 02:18:47'),
(28, 'atrivic@student.foi.hr', 26, '2023-05-29 02:19:11'),
(29, 'patriklovrek007@gmail.com', 7, '2023-05-29 02:19:18'),
(30, 'patriklovrek007@gmail.com', 23, '2023-05-29 05:32:52'),
(31, 'patriklovrek007@gmail.com', 26, '2023-05-29 05:35:16'),
(32, 'patriklovrek007@gmail.com', 7, '2023-05-29 05:37:14'),
(33, 'patriklovrek007@gmail.com', 26, '2023-05-29 07:03:25'),
(34, 'plovrek@student.foi.hr', 7, '2023-05-29 07:03:43'),
(35, 'plovrek@student.foi.hr', 26, '2023-05-29 07:04:23'),
(36, 'patriklovrek007@gmail.com', 7, '2023-05-29 07:04:33'),
(37, 'patriklovrek007@gmail.com', 14, '2023-05-29 07:23:19'),
(38, 'patriklovrek007@gmail.com', 13, '2023-05-29 07:23:21'),
(39, 'patriklovrek007@gmail.com', 13, '2023-05-29 07:23:28'),
(40, 'patriklovrek007@gmail.com', 15, '2023-05-29 07:23:28'),
(41, 'patriklovrek007@gmail.com', 18, '2023-05-29 08:07:31'),
(42, 'patriklovrek007@gmail.com', 18, '2023-05-29 08:09:05'),
(43, 'patriklovrek007@gmail.com', 19, '2023-05-29 08:09:05'),
(44, 'patriklovrek007@gmail.com', 14, '2023-05-29 08:09:24'),
(45, 'patriklovrek007@gmail.com', 14, '2023-05-29 08:09:28'),
(46, 'patriklovrek007@gmail.com', 14, '2023-05-29 08:09:30'),
(47, 'patriklovrek007@gmail.com', 14, '2023-05-29 08:09:31'),
(48, 'patriklovrek007@gmail.com', 18, '2023-05-29 08:09:38'),
(49, 'patriklovrek007@gmail.com', 18, '2023-05-29 08:10:34'),
(50, 'patriklovrek007@gmail.com', 18, '2023-05-29 08:10:35'),
(51, 'patriklovrek007@gmail.com', 18, '2023-05-29 08:10:40'),
(52, 'patriklovrek007@gmail.com', 21, '2023-05-29 08:11:42'),
(53, 'patriklovrek007@gmail.com', 21, '2023-05-29 08:11:53'),
(54, 'patriklovrek007@gmail.com', 21, '2023-05-29 08:12:18'),
(55, 'patriklovrek007@gmail.com', 18, '2023-05-29 08:12:21'),
(56, 'patriklovrek007@gmail.com', 26, '2023-05-29 08:12:38'),
(57, 'plovrek@student.foi.hr', 7, '2023-05-29 08:12:58'),
(58, 'plovrek@student.foi.hr', 14, '2023-05-29 08:13:14'),
(59, 'plovrek@student.foi.hr', 14, '2023-05-29 08:13:18'),
(60, 'plovrek@student.foi.hr', 14, '2023-05-29 08:13:20'),
(61, 'plovrek@student.foi.hr', 14, '2023-05-29 08:13:26'),
(62, 'plovrek@student.foi.hr', 14, '2023-05-29 08:13:27'),
(63, 'plovrek@student.foi.hr', 14, '2023-05-29 08:13:30'),
(64, 'plovrek@student.foi.hr', 14, '2023-05-29 08:13:34'),
(65, 'plovrek@student.foi.hr', 14, '2023-05-29 08:13:35'),
(66, 'plovrek@student.foi.hr', 14, '2023-05-29 08:13:37'),
(67, 'plovrek@student.foi.hr', 14, '2023-05-29 08:13:39'),
(68, 'plovrek@student.foi.hr', 14, '2023-05-29 08:13:41'),
(69, 'plovrek@student.foi.hr', 14, '2023-05-29 08:13:43'),
(70, 'plovrek@student.foi.hr', 14, '2023-05-29 08:13:44'),
(71, 'plovrek@student.foi.hr', 26, '2023-05-29 08:13:47'),
(72, 'patriklovrek007@gmail.com', 7, '2023-05-29 08:13:57'),
(73, 'patriklovrek007@gmail.com', 18, '2023-05-29 08:14:25'),
(74, 'patriklovrek007@gmail.com', 18, '2023-05-29 08:14:37'),
(75, 'patriklovrek007@gmail.com', 18, '2023-05-29 08:14:53'),
(76, 'patriklovrek007@gmail.com', 19, '2023-05-29 08:14:53'),
(77, 'patriklovrek007@gmail.com', 16, '2023-05-29 08:16:02'),
(78, 'patriklovrek007@gmail.com', 14, '2023-05-29 08:16:08'),
(79, 'patriklovrek007@gmail.com', 13, '2023-05-29 08:16:09'),
(80, 'patriklovrek007@gmail.com', 13, '2023-05-29 08:16:19'),
(81, 'patriklovrek007@gmail.com', 15, '2023-05-29 08:16:19'),
(82, 'patriklovrek007@gmail.com', 26, '2023-05-29 08:16:26'),
(83, 'plovrek@student.foi.hr', 7, '2023-05-29 08:16:36'),
(84, 'plovrek@student.foi.hr', 14, '2023-05-29 08:16:43'),
(85, 'plovrek@student.foi.hr', 13, '2023-05-29 08:16:44'),
(86, 'plovrek@student.foi.hr', 13, '2023-05-29 08:16:49'),
(87, 'plovrek@student.foi.hr', 15, '2023-05-29 08:16:49'),
(88, 'plovrek@student.foi.hr', 14, '2023-05-29 08:17:09'),
(89, 'plovrek@student.foi.hr', 13, '2023-05-29 08:17:15'),
(90, 'plovrek@student.foi.hr', 13, '2023-05-29 08:17:20'),
(91, 'plovrek@student.foi.hr', 15, '2023-05-29 08:17:20'),
(92, 'plovrek@student.foi.hr', 14, '2023-05-29 08:17:28'),
(93, 'plovrek@student.foi.hr', 13, '2023-05-29 08:17:30'),
(94, 'plovrek@student.foi.hr', 13, '2023-05-29 08:17:38'),
(95, 'plovrek@student.foi.hr', 15, '2023-05-29 08:17:38'),
(96, 'plovrek@student.foi.hr', 14, '2023-05-29 08:17:56'),
(97, 'plovrek@student.foi.hr', 13, '2023-05-29 08:17:58'),
(98, 'plovrek@student.foi.hr', 13, '2023-05-29 08:18:03'),
(99, 'plovrek@student.foi.hr', 15, '2023-05-29 08:18:03'),
(100, 'plovrek@student.foi.hr', 14, '2023-05-29 08:26:03'),
(101, 'plovrek@student.foi.hr', 14, '2023-05-29 08:26:05'),
(102, 'plovrek@student.foi.hr', 14, '2023-05-29 08:26:07'),
(103, 'plovrek@student.foi.hr', 14, '2023-05-29 08:26:09'),
(104, 'plovrek@student.foi.hr', 26, '2023-05-29 08:26:11'),
(105, 'patriklovrek007@gmail.com', 7, '2023-05-29 08:26:22'),
(106, 'patriklovrek007@gmail.com', 22, '2023-05-29 08:35:39'),
(107, 'patriklovrek007@gmail.com', 26, '2023-05-29 09:18:43'),
(108, 'plovrek@student.foi.hr', 7, '2023-05-29 09:19:27'),
(109, 'plovrek@student.foi.hr', 14, '2023-05-29 09:19:48'),
(110, 'plovrek@student.foi.hr', 14, '2023-05-29 09:19:50'),
(111, 'plovrek@student.foi.hr', 13, '2023-05-29 09:19:52'),
(112, 'plovrek@student.foi.hr', 13, '2023-05-29 09:21:16'),
(113, 'plovrek@student.foi.hr', 13, '2023-05-29 09:22:42'),
(114, 'plovrek@student.foi.hr', 13, '2023-05-29 09:23:26'),
(115, 'plovrek@student.foi.hr', 13, '2023-05-29 09:25:09'),
(116, 'plovrek@student.foi.hr', 13, '2023-05-29 09:25:13'),
(117, 'plovrek@student.foi.hr', 13, '2023-05-29 09:25:14'),
(118, 'plovrek@student.foi.hr', 13, '2023-05-29 09:25:41'),
(119, 'plovrek@student.foi.hr', 14, '2023-05-29 09:25:42'),
(120, 'plovrek@student.foi.hr', 14, '2023-05-29 09:25:43'),
(121, 'plovrek@student.foi.hr', 14, '2023-05-29 09:25:45'),
(122, 'plovrek@student.foi.hr', 14, '2023-05-29 09:26:07'),
(123, 'plovrek@student.foi.hr', 13, '2023-05-29 09:26:09'),
(124, 'plovrek@student.foi.hr', 13, '2023-05-29 09:26:15'),
(125, 'plovrek@student.foi.hr', 14, '2023-05-29 09:27:06'),
(126, 'plovrek@student.foi.hr', 14, '2023-05-29 09:29:27'),
(127, 'plovrek@student.foi.hr', 13, '2023-05-29 09:29:28'),
(128, 'plovrek@student.foi.hr', 13, '2023-05-29 09:29:37'),
(129, 'plovrek@student.foi.hr', 13, '2023-05-29 09:29:53'),
(130, 'plovrek@student.foi.hr', 15, '2023-05-29 09:29:53'),
(131, 'plovrek@student.foi.hr', 26, '2023-05-29 09:41:18'),
(132, 'plovrek@student.foi.hr', 7, '2023-05-29 09:45:17'),
(133, 'plovrek@student.foi.hr', 14, '2023-05-29 09:45:41'),
(134, 'plovrek@student.foi.hr', 14, '2023-05-29 09:45:46'),
(135, 'plovrek@student.foi.hr', 14, '2023-05-29 09:54:07'),
(136, 'plovrek@student.foi.hr', 13, '2023-05-29 09:54:08'),
(137, 'plovrek@student.foi.hr', 13, '2023-05-29 09:55:37'),
(138, 'plovrek@student.foi.hr', 13, '2023-05-29 09:55:39'),
(139, 'plovrek@student.foi.hr', 13, '2023-05-29 09:56:08'),
(140, 'plovrek@student.foi.hr', 13, '2023-05-29 09:57:21'),
(141, 'plovrek@student.foi.hr', 13, '2023-05-29 09:58:04'),
(142, 'plovrek@student.foi.hr', 13, '2023-05-29 09:58:38'),
(143, 'plovrek@student.foi.hr', 13, '2023-05-29 09:59:10'),
(144, 'plovrek@student.foi.hr', 13, '2023-05-29 10:00:58'),
(145, 'plovrek@student.foi.hr', 13, '2023-05-29 10:01:38'),
(146, 'plovrek@student.foi.hr', 13, '2023-05-29 10:02:10'),
(147, 'plovrek@student.foi.hr', 13, '2023-05-29 10:03:14'),
(148, 'plovrek@student.foi.hr', 13, '2023-05-29 10:04:06'),
(149, 'plovrek@student.foi.hr', 13, '2023-05-29 10:04:07'),
(150, 'plovrek@student.foi.hr', 13, '2023-05-29 10:04:44'),
(151, 'plovrek@student.foi.hr', 13, '2023-05-29 10:05:20'),
(152, 'plovrek@student.foi.hr', 13, '2023-05-29 10:06:21'),
(153, 'plovrek@student.foi.hr', 13, '2023-05-29 10:07:57'),
(154, 'plovrek@student.foi.hr', 13, '2023-05-29 10:08:50'),
(155, 'plovrek@student.foi.hr', 13, '2023-05-29 10:11:43'),
(156, 'plovrek@student.foi.hr', 13, '2023-05-29 10:12:20'),
(157, 'plovrek@student.foi.hr', 13, '2023-05-29 10:12:33'),
(158, 'plovrek@student.foi.hr', 13, '2023-05-29 10:14:27'),
(159, 'plovrek@student.foi.hr', 13, '2023-05-29 10:14:35'),
(160, 'plovrek@student.foi.hr', 13, '2023-05-29 10:15:17'),
(161, 'plovrek@student.foi.hr', 13, '2023-05-29 10:16:12'),
(162, 'plovrek@student.foi.hr', 13, '2023-05-29 10:18:29'),
(163, 'plovrek@student.foi.hr', 13, '2023-05-29 10:20:43'),
(164, 'plovrek@student.foi.hr', 13, '2023-05-29 10:21:48'),
(165, 'plovrek@student.foi.hr', 13, '2023-05-29 10:21:55'),
(166, 'plovrek@student.foi.hr', 13, '2023-05-29 10:22:03'),
(167, 'plovrek@student.foi.hr', 13, '2023-05-29 10:22:11'),
(168, 'plovrek@student.foi.hr', 13, '2023-05-29 10:22:30'),
(169, 'plovrek@student.foi.hr', 13, '2023-05-29 10:23:51'),
(170, 'plovrek@student.foi.hr', 13, '2023-05-29 10:24:22'),
(171, 'plovrek@student.foi.hr', 13, '2023-05-29 10:24:49'),
(172, 'plovrek@student.foi.hr', 13, '2023-05-29 10:25:55'),
(173, 'plovrek@student.foi.hr', 13, '2023-05-29 10:27:26'),
(174, 'plovrek@student.foi.hr', 13, '2023-05-29 10:29:16'),
(175, 'plovrek@student.foi.hr', 13, '2023-05-29 10:30:51'),
(176, 'plovrek@student.foi.hr', 13, '2023-05-29 10:32:06'),
(177, 'plovrek@student.foi.hr', 13, '2023-05-29 10:37:59'),
(178, 'plovrek@student.foi.hr', 13, '2023-05-29 10:39:24'),
(179, 'plovrek@student.foi.hr', 13, '2023-05-29 10:39:34'),
(180, 'plovrek@student.foi.hr', 13, '2023-05-29 10:39:41'),
(181, 'plovrek@student.foi.hr', 13, '2023-05-29 10:40:14'),
(182, 'plovrek@student.foi.hr', 13, '2023-05-29 10:40:48'),
(183, 'plovrek@student.foi.hr', 13, '2023-05-29 10:41:48'),
(184, 'plovrek@student.foi.hr', 14, '2023-05-30 11:15:52'),
(185, 'plovrek@student.foi.hr', 13, '2023-05-30 11:15:53'),
(186, 'plovrek@student.foi.hr', 13, '2023-05-30 11:16:50'),
(187, 'plovrek@student.foi.hr', 13, '2023-05-30 11:17:02'),
(188, 'plovrek@student.foi.hr', 13, '2023-05-30 11:18:37'),
(189, 'plovrek@student.foi.hr', 13, '2023-05-30 11:18:52'),
(190, 'plovrek@student.foi.hr', 13, '2023-05-30 11:19:15'),
(191, 'plovrek@student.foi.hr', 13, '2023-05-30 11:19:29'),
(192, 'plovrek@student.foi.hr', 13, '2023-05-30 11:19:37'),
(193, 'plovrek@student.foi.hr', 13, '2023-05-30 11:19:55'),
(194, 'plovrek@student.foi.hr', 13, '2023-05-30 11:19:56'),
(195, 'plovrek@student.foi.hr', 13, '2023-05-30 11:19:57'),
(196, 'plovrek@student.foi.hr', 13, '2023-05-30 11:20:18'),
(197, 'plovrek@student.foi.hr', 13, '2023-05-30 11:21:35'),
(198, 'plovrek@student.foi.hr', 13, '2023-05-30 11:21:37'),
(199, 'plovrek@student.foi.hr', 13, '2023-05-30 11:22:12'),
(200, 'plovrek@student.foi.hr', 13, '2023-05-30 11:25:35'),
(201, 'plovrek@student.foi.hr', 13, '2023-05-30 11:25:47'),
(202, 'plovrek@student.foi.hr', 13, '2023-05-30 11:26:24'),
(203, 'plovrek@student.foi.hr', 13, '2023-05-30 11:27:48'),
(204, 'plovrek@student.foi.hr', 13, '2023-05-30 11:30:17'),
(205, 'plovrek@student.foi.hr', 13, '2023-05-30 11:30:28'),
(206, 'plovrek@student.foi.hr', 13, '2023-05-30 11:31:55'),
(207, 'plovrek@student.foi.hr', 13, '2023-05-30 11:34:02'),
(208, 'plovrek@student.foi.hr', 13, '2023-05-30 11:34:55'),
(209, 'plovrek@student.foi.hr', 13, '2023-05-30 11:35:42'),
(210, 'plovrek@student.foi.hr', 13, '2023-05-30 11:35:55'),
(211, 'plovrek@student.foi.hr', 13, '2023-05-30 11:36:18'),
(212, 'plovrek@student.foi.hr', 13, '2023-05-30 11:36:46'),
(213, 'plovrek@student.foi.hr', 13, '2023-05-30 11:41:49'),
(214, 'plovrek@student.foi.hr', 13, '2023-05-30 11:42:49'),
(215, 'plovrek@student.foi.hr', 13, '2023-05-30 11:43:23'),
(216, 'plovrek@student.foi.hr', 13, '2023-05-30 11:45:55'),
(217, 'plovrek@student.foi.hr', 13, '2023-05-30 11:49:53'),
(218, 'plovrek@student.foi.hr', 13, '2023-05-30 11:51:30'),
(219, 'plovrek@student.foi.hr', 13, '2023-05-30 11:53:58'),
(220, 'plovrek@student.foi.hr', 13, '2023-05-30 11:58:19'),
(221, 'plovrek@student.foi.hr', 13, '2023-05-30 11:59:06'),
(222, 'plovrek@student.foi.hr', 13, '2023-05-30 12:02:07'),
(223, 'plovrek@student.foi.hr', 13, '2023-05-30 12:02:16'),
(224, 'plovrek@student.foi.hr', 13, '2023-05-30 12:02:25'),
(225, 'plovrek@student.foi.hr', 13, '2023-05-30 12:02:47'),
(226, 'plovrek@student.foi.hr', 13, '2023-05-30 12:03:28'),
(227, 'plovrek@student.foi.hr', 13, '2023-05-30 12:03:51'),
(228, 'plovrek@student.foi.hr', 13, '2023-05-30 12:04:04'),
(229, 'plovrek@student.foi.hr', 13, '2023-05-30 12:04:21'),
(230, 'plovrek@student.foi.hr', 13, '2023-05-30 12:04:44'),
(231, 'plovrek@student.foi.hr', 13, '2023-05-30 12:05:22'),
(232, 'plovrek@student.foi.hr', 13, '2023-05-30 12:06:34'),
(233, 'plovrek@student.foi.hr', 13, '2023-05-30 12:06:54'),
(234, 'plovrek@student.foi.hr', 13, '2023-05-30 12:16:53'),
(235, 'plovrek@student.foi.hr', 13, '2023-05-30 12:17:13'),
(236, 'plovrek@student.foi.hr', 13, '2023-05-30 12:17:41'),
(237, 'plovrek@student.foi.hr', 13, '2023-05-30 12:18:52'),
(238, 'plovrek@student.foi.hr', 13, '2023-05-30 12:21:48'),
(239, 'plovrek@student.foi.hr', 13, '2023-05-30 12:22:46'),
(240, 'plovrek@student.foi.hr', 13, '2023-05-30 12:23:07'),
(241, 'plovrek@student.foi.hr', 13, '2023-05-30 12:23:20'),
(242, 'plovrek@student.foi.hr', 13, '2023-05-30 12:25:20'),
(243, 'plovrek@student.foi.hr', 13, '2023-05-30 12:25:27'),
(244, 'plovrek@student.foi.hr', 13, '2023-05-30 12:25:29'),
(245, 'plovrek@student.foi.hr', 13, '2023-05-30 12:25:59'),
(246, 'plovrek@student.foi.hr', 13, '2023-05-30 12:26:29'),
(247, 'plovrek@student.foi.hr', 13, '2023-05-30 12:27:28'),
(248, 'plovrek@student.foi.hr', 13, '2023-05-30 12:27:59'),
(249, 'plovrek@student.foi.hr', 13, '2023-05-30 12:28:24'),
(250, 'plovrek@student.foi.hr', 13, '2023-05-30 12:30:19'),
(251, 'plovrek@student.foi.hr', 13, '2023-05-30 12:31:10'),
(252, 'plovrek@student.foi.hr', 13, '2023-05-30 12:31:29'),
(253, 'plovrek@student.foi.hr', 13, '2023-05-30 12:31:31'),
(254, 'plovrek@student.foi.hr', 13, '2023-05-30 12:31:52'),
(255, 'plovrek@student.foi.hr', 13, '2023-05-30 12:32:12'),
(256, 'plovrek@student.foi.hr', 13, '2023-05-30 12:32:46'),
(257, 'plovrek@student.foi.hr', 13, '2023-05-30 12:33:00'),
(258, 'plovrek@student.foi.hr', 13, '2023-05-30 12:33:20'),
(259, 'plovrek@student.foi.hr', 13, '2023-05-30 12:33:32'),
(260, 'plovrek@student.foi.hr', 13, '2023-05-30 12:34:47'),
(261, 'plovrek@student.foi.hr', 13, '2023-05-30 12:35:18'),
(262, 'plovrek@student.foi.hr', 13, '2023-05-30 12:40:07'),
(263, 'plovrek@student.foi.hr', 13, '2023-05-30 01:04:17'),
(264, 'plovrek@student.foi.hr', 13, '2023-05-30 01:04:51'),
(265, 'plovrek@student.foi.hr', 13, '2023-05-30 01:05:17'),
(266, 'plovrek@student.foi.hr', 13, '2023-05-30 01:05:49'),
(267, 'plovrek@student.foi.hr', 13, '2023-05-30 01:06:19'),
(268, 'plovrek@student.foi.hr', 13, '2023-05-30 01:07:12'),
(269, 'plovrek@student.foi.hr', 13, '2023-05-30 01:07:40'),
(270, 'plovrek@student.foi.hr', 13, '2023-05-30 01:09:06'),
(271, 'plovrek@student.foi.hr', 13, '2023-05-30 01:10:12'),
(272, 'plovrek@student.foi.hr', 13, '2023-05-30 01:10:27'),
(273, 'plovrek@student.foi.hr', 13, '2023-05-30 01:22:15'),
(274, 'plovrek@student.foi.hr', 15, '2023-05-30 01:22:15'),
(275, 'plovrek@student.foi.hr', 14, '2023-05-30 01:23:33'),
(276, 'plovrek@student.foi.hr', 13, '2023-05-30 01:23:35'),
(277, 'plovrek@student.foi.hr', 13, '2023-05-30 01:23:43'),
(278, 'plovrek@student.foi.hr', 13, '2023-05-30 01:24:10'),
(279, 'plovrek@student.foi.hr', 13, '2023-05-30 01:24:38'),
(280, 'plovrek@student.foi.hr', 13, '2023-05-30 01:24:42'),
(281, 'plovrek@student.foi.hr', 13, '2023-05-30 01:24:51'),
(282, 'plovrek@student.foi.hr', 13, '2023-05-30 01:25:26'),
(283, 'plovrek@student.foi.hr', 13, '2023-05-30 01:25:29'),
(284, 'plovrek@student.foi.hr', 14, '2023-05-30 01:25:33'),
(285, 'plovrek@student.foi.hr', 13, '2023-05-30 01:25:34'),
(286, 'plovrek@student.foi.hr', 13, '2023-05-30 01:25:38'),
(287, 'plovrek@student.foi.hr', 13, '2023-05-30 01:25:51'),
(288, 'plovrek@student.foi.hr', 13, '2023-05-30 01:25:56'),
(289, 'plovrek@student.foi.hr', 15, '2023-05-30 01:25:56'),
(290, 'plovrek@student.foi.hr', 14, '2023-05-30 01:26:25'),
(291, 'plovrek@student.foi.hr', 26, '2023-05-30 01:27:37'),
(313, 'domagoj.pu00@gmail.com', 2, '2023-05-30 08:33:13'),
(314, 'domagoj.pu00@gmail.com', 4, '2023-05-30 08:34:27'),
(315, 'domagoj.pu00@gmail.com', 12, '2023-05-30 08:40:03'),
(316, 'domagoj.pu00@gmail.com', 11, '2023-05-30 08:40:13'),
(317, 'domagoj.pu00@gmail.com', 14, '2023-05-30 08:40:20'),
(318, 'domagoj.pu00@gmail.com', 14, '2023-05-30 08:40:22'),
(319, 'domagoj.pu00@gmail.com', 14, '2023-05-30 08:40:36'),
(320, 'domagoj.pu00@gmail.com', 14, '2023-05-30 08:40:38'),
(321, 'domagoj.pu00@gmail.com', 14, '2023-05-30 08:40:41'),
(322, 'domagoj.pu00@gmail.com', 14, '2023-05-30 08:40:43'),
(323, 'domagoj.pu00@gmail.com', 14, '2023-05-30 08:40:44'),
(324, 'domagoj.pu00@gmail.com', 14, '2023-05-30 08:40:45'),
(325, 'domagoj.pu00@gmail.com', 13, '2023-05-30 08:40:59'),
(326, 'domagoj.pu00@gmail.com', 26, '2023-05-30 08:41:23'),
(327, 'mihael.brlecic@gmail.com', 2, '2023-05-30 08:43:38'),
(328, 'mihael.brlecic@gmail.com', 4, '2023-05-30 08:45:14'),
(329, 'mihael.brlecic@gmail.com', 11, '2023-05-30 08:46:05'),
(330, 'mihael.brlecic@gmail.com', 12, '2023-05-30 08:46:09'),
(331, 'mihael.brlecic@gmail.com', 26, '2023-05-30 08:49:46'),
(332, 'pperic@gmail.com', 7, '2023-05-30 08:52:35'),
(333, 'pperic@gmail.com', 26, '2023-05-30 08:52:38'),
(334, 'patriklovrek007@gmail.com', 7, '2023-05-30 08:53:18'),
(335, 'patriklovrek007@gmail.com', 26, '2023-05-30 08:53:21'),
(336, 'patriklovrek007@gmail.com', 7, '2023-05-30 08:53:51'),
(337, 'patriklovrek007@gmail.com', 21, '2023-05-30 08:54:50'),
(338, 'patriklovrek007@gmail.com', 18, '2023-05-30 08:57:09'),
(339, 'patriklovrek007@gmail.com', 26, '2023-05-30 08:57:28'),
(340, 'andrejlilek7@gmail.com', 2, '2023-05-30 08:59:52'),
(341, 'andrejlilek7@gmail.com', 4, '2023-05-30 09:00:31'),
(342, 'andrejlilek7@gmail.com', 11, '2023-05-30 09:00:39'),
(343, 'andrejlilek7@gmail.com', 12, '2023-05-30 09:00:46'),
(344, 'andrejlilek7@gmail.com', 14, '2023-05-30 09:00:52'),
(345, 'andrejlilek7@gmail.com', 14, '2023-05-30 09:00:54'),
(346, 'andrejlilek7@gmail.com', 14, '2023-05-30 09:00:56'),
(347, 'andrejlilek7@gmail.com', 14, '2023-05-30 09:00:57'),
(348, 'andrejlilek7@gmail.com', 14, '2023-05-30 09:00:58'),
(349, 'andrejlilek7@gmail.com', 13, '2023-05-30 09:01:00'),
(350, 'andrejlilek7@gmail.com', 13, '2023-05-30 09:01:20'),
(351, 'andrejlilek7@gmail.com', 15, '2023-05-30 09:01:20'),
(352, 'andrejlilek7@gmail.com', 26, '2023-05-30 09:02:38'),
(353, 'patriklovrek007@gmail.com', 7, '2023-05-30 09:02:55'),
(354, 'patriklovrek007@gmail.com', 26, '2023-05-30 09:03:11'),
(361, 'pperic@gmail.com', 7, '2023-05-30 09:38:35'),
(362, 'pperic@gmail.com', 14, '2023-05-30 09:40:00'),
(363, 'pperic@gmail.com', 14, '2023-05-30 09:40:02'),
(364, 'pperic@gmail.com', 14, '2023-05-30 09:40:04'),
(365, 'pperic@gmail.com', 14, '2023-05-30 09:40:07'),
(366, 'pperic@gmail.com', 26, '2023-05-30 09:40:27'),
(367, 'pperic@gmail.com', 7, '2023-05-30 09:40:34'),
(368, 'pperic@gmail.com', 26, '2023-05-30 09:40:35'),
(369, 'plovrek@student.foi.hr', 7, '2023-05-30 10:11:01'),
(370, 'plovrek@student.foi.hr', 26, '2023-05-30 10:25:33'),
(371, 'patriklovrek007@gmail.com', 7, '2023-05-30 10:33:51'),
(372, 'patriklovrek007@gmail.com', 26, '2023-05-30 10:37:12'),
(375, 'plovrek@student.foi.hr', 7, '2023-05-30 10:52:54'),
(376, 'plovrek@student.foi.hr', 14, '2023-05-30 11:07:40'),
(377, 'plovrek@student.foi.hr', 14, '2023-05-30 11:07:50'),
(378, 'plovrek@student.foi.hr', 13, '2023-05-30 11:07:54'),
(379, 'plovrek@student.foi.hr', 13, '2023-05-30 11:28:54'),
(380, 'plovrek@student.foi.hr', 13, '2023-05-30 11:29:03'),
(381, 'plovrek@student.foi.hr', 13, '2023-05-30 11:29:04'),
(382, 'plovrek@student.foi.hr', 13, '2023-05-30 11:29:17'),
(383, 'plovrek@student.foi.hr', 13, '2023-05-30 11:36:21'),
(384, 'plovrek@student.foi.hr', 13, '2023-05-30 11:36:42'),
(385, 'plovrek@student.foi.hr', 13, '2023-05-30 11:37:33'),
(386, 'plovrek@student.foi.hr', 13, '2023-05-30 11:37:51'),
(387, 'plovrek@student.foi.hr', 13, '2023-05-30 11:38:27'),
(388, 'plovrek@student.foi.hr', 13, '2023-05-30 11:38:43'),
(389, 'plovrek@student.foi.hr', 13, '2023-05-30 11:39:05'),
(390, 'plovrek@student.foi.hr', 13, '2023-05-30 11:40:09'),
(391, 'plovrek@student.foi.hr', 13, '2023-05-30 11:40:22'),
(392, 'plovrek@student.foi.hr', 13, '2023-05-30 11:40:31'),
(393, 'plovrek@student.foi.hr', 26, '2023-05-30 11:44:15'),
(394, 'pperic@gmail.com', 7, '2023-05-30 11:46:07'),
(395, 'pperic@gmail.com', 18, '2023-05-31 12:09:15'),
(396, 'pperic@gmail.com', 18, '2023-05-31 12:10:12'),
(397, 'pperic@gmail.com', 18, '2023-05-31 12:10:31'),
(398, 'pperic@gmail.com', 26, '2023-05-31 12:10:58'),
(399, 'patriklovrek007@gmail.com', 7, '2023-05-31 12:11:07'),
(400, 'patriklovrek007@gmail.com', 21, '2023-05-31 12:16:19'),
(401, 'patriklovrek007@gmail.com', 21, '2023-05-31 12:16:35'),
(402, 'patriklovrek007@gmail.com', 26, '2023-05-31 12:17:24'),
(403, 'pperic@gmail.com', 7, '2023-05-31 12:17:33'),
(404, 'pperic@gmail.com', 26, '2023-05-31 12:27:56'),
(405, 'patriklovrek007@gmail.com', 7, '2023-05-31 12:28:06'),
(406, 'patriklovrek007@gmail.com', 26, '2023-05-31 12:48:13'),
(407, 'patriklovrek007@gmail.com', 7, '2023-05-31 12:48:25'),
(408, 'patriklovrek007@gmail.com', 26, '2023-05-31 12:48:29'),
(410, 'plovrek@student.foi.hr', 7, '2023-05-31 12:58:30'),
(411, 'plovrek@student.foi.hr', 12, '2023-05-31 01:01:30'),
(412, 'plovrek@student.foi.hr', 12, '2023-05-31 01:01:32'),
(413, 'plovrek@student.foi.hr', 14, '2023-05-31 01:02:22'),
(414, 'plovrek@student.foi.hr', 13, '2023-05-31 01:02:28'),
(415, 'plovrek@student.foi.hr', 13, '2023-05-31 01:05:08'),
(416, 'plovrek@student.foi.hr', 14, '2023-05-31 01:05:30'),
(417, 'plovrek@student.foi.hr', 14, '2023-05-31 01:05:32'),
(418, 'plovrek@student.foi.hr', 13, '2023-05-31 01:05:33'),
(419, 'plovrek@student.foi.hr', 13, '2023-05-31 01:05:45'),
(420, 'plovrek@student.foi.hr', 14, '2023-05-31 01:13:08'),
(421, 'plovrek@student.foi.hr', 13, '2023-05-31 01:13:10'),
(422, 'plovrek@student.foi.hr', 14, '2023-05-31 01:13:20'),
(423, 'plovrek@student.foi.hr', 13, '2023-05-31 01:13:21'),
(424, 'plovrek@student.foi.hr', 13, '2023-05-31 01:13:27'),
(425, 'plovrek@student.foi.hr', 14, '2023-05-31 01:18:36'),
(426, 'plovrek@student.foi.hr', 13, '2023-05-31 01:18:37'),
(427, 'plovrek@student.foi.hr', 13, '2023-05-31 01:18:45'),
(428, 'plovrek@student.foi.hr', 13, '2023-05-31 01:18:52'),
(429, 'plovrek@student.foi.hr', 13, '2023-05-31 01:18:58'),
(430, 'plovrek@student.foi.hr', 14, '2023-05-31 01:19:27'),
(431, 'plovrek@student.foi.hr', 13, '2023-05-31 01:19:28'),
(432, 'plovrek@student.foi.hr', 13, '2023-05-31 01:19:33'),
(433, 'plovrek@student.foi.hr', 13, '2023-05-31 01:19:41'),
(434, 'plovrek@student.foi.hr', 26, '2023-05-31 01:26:07'),
(435, 'patriklovrek007@gmail.com', 7, '2023-05-31 01:26:16'),
(436, 'patriklovrek007@gmail.com', 26, '2023-05-31 01:28:04'),
(437, 'pperic@gmail.com', 7, '2023-05-31 01:28:12'),
(438, 'pperic@gmail.com', 26, '2023-05-31 01:35:39'),
(439, 'patriklovrek007@gmail.com', 7, '2023-05-31 01:35:57'),
(440, 'patriklovrek007@gmail.com', 20, '2023-05-31 01:39:41'),
(441, 'patriklovrek007@gmail.com', 26, '2023-05-31 01:50:11'),
(442, 'plovrek@student.foi.hr', 7, '2023-05-31 02:04:23'),
(443, 'plovrek@student.foi.hr', 26, '2023-05-31 02:05:29'),
(444, 'plovrek@student.foi.hr', 7, '2023-05-31 02:05:50'),
(445, 'plovrek@student.foi.hr', 14, '2023-05-31 02:06:07'),
(446, 'plovrek@student.foi.hr', 14, '2023-05-31 02:06:10'),
(447, 'plovrek@student.foi.hr', 14, '2023-05-31 02:06:12'),
(448, 'plovrek@student.foi.hr', 14, '2023-05-31 02:06:14'),
(449, 'plovrek@student.foi.hr', 14, '2023-05-31 02:06:28'),
(450, 'plovrek@student.foi.hr', 14, '2023-05-31 02:06:29'),
(451, 'plovrek@student.foi.hr', 14, '2023-05-31 02:06:31'),
(452, 'plovrek@student.foi.hr', 14, '2023-05-31 02:06:32'),
(453, 'plovrek@student.foi.hr', 14, '2023-05-31 02:06:34'),
(454, 'plovrek@student.foi.hr', 13, '2023-05-31 02:06:36'),
(455, 'plovrek@student.foi.hr', 26, '2023-05-31 02:08:37'),
(456, 'pperic@gmail.com', 7, '2023-05-31 02:08:46'),
(457, 'pperic@gmail.com', 26, '2023-05-31 02:26:21'),
(458, 'patriklovrek007@gmail.com', 7, '2023-05-31 02:26:37'),
(459, 'patriklovrek007@gmail.com', 26, '2023-05-31 02:26:45');

-- --------------------------------------------------------

--
-- Table structure for table `kampanja`
--

CREATE TABLE `kampanja` (
  `kampanja_id` int(11) NOT NULL,
  `korisnik_email` varchar(45) NOT NULL,
  `naziv_kampanje` varchar(45) NOT NULL,
  `opis_kampanje` longtext NOT NULL,
  `zbroj_kolicine_proizvoda` int(11) NOT NULL,
  `datum_vrijeme_pocetka` datetime NOT NULL,
  `datum_vrijeme_zavrsetka` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kampanja`
--

INSERT INTO `kampanja` (`kampanja_id`, `korisnik_email`, `naziv_kampanje`, `opis_kampanje`, `zbroj_kolicine_proizvoda`, `datum_vrijeme_pocetka`, `datum_vrijeme_zavrsetka`) VALUES
(3, 'pperic@gmail.com', 'Prodaja bend majice', 'Majica s bendom Led Zeppelin', 2, '2023-05-23 20:28:00', '2023-05-24 20:28:00'),
(4, 'pperic@gmail.com', 'Ploče', 'Novo u ponudi, stare ploče!', 2, '2023-05-26 21:23:00', '2023-05-29 21:23:00'),
(14, 'pperic@gmail.com', 'Ploče', 'Povoljnije', 2, '2023-06-04 10:50:00', '2023-06-05 10:50:00'),
(19, 'pperic@gmail.com', 'Probni', 'Opis1', 3, '2023-05-21 12:46:00', '2023-05-26 12:46:00'),
(20, 'pperic@gmail.com', 'više toga', 'dasdad', 1, '2023-06-04 15:06:00', '2023-06-07 15:06:00'),
(21, 'pperic@gmail.com', 'Kampanja', 'Opis', 1, '2023-05-31 15:25:00', '2023-06-09 15:25:00'),
(46, 'pperic@gmail.com', 'dsa', 'asdasd', 1, '2023-05-18 18:48:00', '2023-06-01 18:48:00'),
(48, 'dlovrek78@gmail.com', 'Dijanina kampanja', 'Svašta ponešto', 2, '2023-05-30 18:29:00', '2023-06-03 18:29:00'),
(49, 'pperic@gmail.com', 'Kampanjica', 'opisić', 1, '2023-05-31 19:52:00', '2023-06-01 19:52:00'),
(50, 'patriklovrek007@gmail.com', 'Old school rock', 'Old school ploče!', 6, '2023-05-31 10:57:00', '2023-06-01 10:57:00'),
(51, 'patriklovrek007@gmail.com', 'Maiden majca', 'Nova zaliha', 6, '2023-05-30 20:15:00', '2023-06-02 20:16:00');

-- --------------------------------------------------------

--
-- Table structure for table `kampanja_proizvod`
--

CREATE TABLE `kampanja_proizvod` (
  `kampanja_id` int(11) NOT NULL,
  `proizvod_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kampanja_proizvod`
--

INSERT INTO `kampanja_proizvod` (`kampanja_id`, `proizvod_id`) VALUES
(3, 58),
(4, 60),
(14, 60),
(19, 59),
(19, 60),
(20, 59),
(21, 59),
(46, 59),
(48, 54),
(48, 65),
(49, 59),
(50, 66),
(51, 8);

-- --------------------------------------------------------

--
-- Table structure for table `konfiguracija_aplikacje`
--

CREATE TABLE `konfiguracija_aplikacje` (
  `konfiguracija_id` int(11) NOT NULL,
  `korisnik_email` varchar(45) NOT NULL,
  `opis_konfiguracije` text NOT NULL,
  `status_konfiguracije` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `email` varchar(45) NOT NULL,
  `tip_id` int(11) NOT NULL,
  `ime` varchar(45) NOT NULL,
  `prezime` varchar(45) NOT NULL,
  `datum_rodenja` date NOT NULL,
  `spol` char(1) NOT NULL,
  `broj_telefona` varchar(45) NOT NULL,
  `adresa` varchar(45) NOT NULL,
  `korisnicko_ime` varchar(45) NOT NULL,
  `lozinka` varchar(45) NOT NULL,
  `lozinka_sha256` char(64) NOT NULL,
  `nadimak` varchar(45) NOT NULL,
  `slika_profila` varchar(65) NOT NULL,
  `datum_vrijeme_registracije` datetime NOT NULL,
  `broj_unosa` int(11) NOT NULL,
  `status_racuna` tinyint(4) NOT NULL,
  `uvjeti_koristenja` tinyint(4) NOT NULL,
  `aktivacijski_kod` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`email`, `tip_id`, `ime`, `prezime`, `datum_rodenja`, `spol`, `broj_telefona`, `adresa`, `korisnicko_ime`, `lozinka`, `lozinka_sha256`, `nadimak`, `slika_profila`, `datum_vrijeme_registracije`, `broj_unosa`, `status_racuna`, `uvjeti_koristenja`, `aktivacijski_kod`) VALUES
('andrejlilek7@gmail.com', 3, 'Andrej', 'Lilek', '2000-03-26', 'M', '53454354535', 'Kapela 2', 'alilek', 'asdfghjkloiuA2sjAs2', 'a05a75755391f1e145422f0d1dfc83e5f05f32a6', 'Lilek', '1300001019.jpg', '2023-05-30 08:59:52', 0, 1, 1, 'c458900141f5f3fe6a1561e9a6501840'),
('asd@asd.com', 3, 'asd', 'aadad', '2023-05-25', 'M', '0994168648', 'Adresa1', 'asd', 'asdfghjkloiuA2sjAs', '095676150ef37985c217f8ceb23114a6092091b6', '', '', '2023-05-25 11:25:55', 0, 0, 1, '34042727c9a907b98caf79c6d9d18b50'),
('atrivic@student.foi.hr', 3, 'Andreja', 'Trivić', '2023-05-29', 'Z', '+38592344', 'Adresa1', 'atrivic', 'N7uCFd11dbV8p9nKzR', '4e3edaaa55f12586aab03593ed65dbce9b47a73a', 'Andrejaaaaa', '1300001019.jpg', '2023-05-29 02:17:38', 0, 1, 1, 'b49dc39b9b2e716d54142e475993181e'),
('dlovrek78@gmail.com', 2, 'Dijana', 'Vrbančić', '1978-08-23', 'Z', '098471963', 'Varaždinska cesta 65a', 'dvrbancic', 'asdfghjkloiuA2sjAs2', 'a05a75755391f1e145422f0d1dfc83e5f05f32a6', 'Didi', 'zeppelin.jpeg', '2023-05-22 09:47:29', 0, 1, 1, '7e44f7c5c63e22cde812139f567ddeb4'),
('domagoj.pu00@gmail.com', 3, 'Domagoj', 'Puz', '2000-12-19', 'M', '4234234423', 'Gibanična 1', 'dpuz', 't21Xx5be4jCoDVEHcM', '6f84944e8074494462afcb5d9c414565b86e9ccb', 'Puž', 'cancel.png', '2023-05-30 08:33:13', 0, 1, 1, '829a9b789fb6294b7110bf3e97585db2'),
('dvuljak318@gmail.com', 3, 'Dominik', 'Vuljak', '2023-05-19', 'M', '0994168648', 'Adresa1', 'dvuljak', 'asdfghjkloiuA2sjAs', '095676150ef37985c217f8ceb23114a6092091b6', 'Vuljo', '1300001019.jpg', '2023-05-23 12:23:44', 0, 0, 1, '77f626c888c2547c9d8ce303f98c295e'),
('helenamartinaga@gmail.com', 3, 'Helena', 'Martinaga', '1999-01-27', 'Z', '0994168648', 'Adresa1', 'hmartinaga', 'asdfghjkloiuA2sjAs', '095676150ef37985c217f8ceb23114a6092091b6', 'Aida', 'Loki-slika.png', '2023-05-26 07:47:58', 0, 1, 1, 'a73cc17b2bb737445b899e5ed2f05086'),
('mihael.brlecic@gmail.com', 3, 'Mihael', 'Brlečić', '2000-05-30', 'M', '5545664', 'Ciglana 1', 'mbrlecic', 't21Xx5be4jCoDVEHcM', '6f84944e8074494462afcb5d9c414565b86e9ccb', 'Brki', 'search.png', '2023-05-30 08:43:38', 0, 1, 1, 'a927cac61149244fb54496b7b544331f'),
('patriklovrek007@gmail.com', 1, 'Patrik', 'Lovrek', '2000-02-09', 'M', '0994168648', 'Varaždinska cesta 65a', 'plovrek', 'N7uCFd11dbV8p9nKzR', '4e3edaaa55f12586aab03593ed65dbce9b47a73a', 'Loki', 'Patrik_Lovrek_slika-min.jpg', '2023-05-22 09:43:15', 0, 1, 1, 'd840d8c583c3c94eec1215f992431977'),
('petarmatisic8@gmail.com', 3, 'Petar', 'Matisic', '2001-04-24', 'M', '0994168648', 'Adresa1', 'pijetao', 'asdfghjkloiuA2sjAs3', 'd9ad445c94927620de7730ffaf7bac52858d13cb', 'Pijetao', 'gettyimages-74254327.jpg', '2023-05-24 08:41:39', 0, 1, 1, '3bf777be2e5ccd82e6dc6f9b2edc30e1'),
('plovrek@student.foi.hr', 3, 'Patrik', 'Lovrek', '2000-02-09', 'M', '0994168648', 'Varaždinska cesta 65a', 'ploki', 'asdfghjkloiuA2sjAs3', 'd9ad445c94927620de7730ffaf7bac52858d13cb', 'Loks', '128842-schermafbeelding-20220204-om-12.03.59.jpg', '2023-05-22 10:16:28', 0, 1, 1, 'da8ce373b0c6f2c9d8a282d9141297ba'),
('pperic@gmail.com', 2, 'Perica', 'Perić', '2000-01-01', 'M', '0994168649', 'Adresa1', 'pperic', 'asdfghjkloiuA2sjAs4', '345ed37a9d9b2c7f6af7abcc0e1fd58bbea14791', 'Perica123', 'gettyimages-74254327.jpg', '2023-05-23 11:12:43', 0, 1, 1, '106a5d9baad6cb40fe4d418e47d99c53');

-- --------------------------------------------------------

--
-- Table structure for table `kupnja`
--

CREATE TABLE `kupnja` (
  `kupnja_id` int(11) NOT NULL,
  `proizvod_id` int(11) NOT NULL,
  `korisnik_email` varchar(45) NOT NULL,
  `bodovi_iskoristeni_u_kupnji` float NOT NULL,
  `euri_iskoristeni_u_kupnji` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kupnja`
--

INSERT INTO `kupnja` (`kupnja_id`, `proizvod_id`, `korisnik_email`, `bodovi_iskoristeni_u_kupnji`, `euri_iskoristeni_u_kupnji`) VALUES
(1, 58, 'plovrek@student.foi.hr', 20, 0),
(2, 58, 'plovrek@student.foi.hr', 0, 30),
(3, 60, 'plovrek@student.foi.hr', 0, 20),
(4, 58, 'plovrek@student.foi.hr', 0, 30),
(5, 59, 'plovrek@student.foi.hr', 20, 0),
(6, 59, 'plovrek@student.foi.hr', 0, 20),
(7, 60, 'plovrek@student.foi.hr', 30, 0),
(8, 58, 'patriklovrek007@gmail.com', 0, 30),
(9, 58, 'plovrek@student.foi.hr', 0, 15),
(10, 66, 'patriklovrek007@gmail.com', 0, 120),
(11, 8, 'patriklovrek007@gmail.com', 0, 15),
(12, 8, 'plovrek@student.foi.hr', 0, 15),
(13, 8, 'plovrek@student.foi.hr', 0, 15),
(14, 8, 'plovrek@student.foi.hr', 0, 15),
(15, 8, 'plovrek@student.foi.hr', 0, 15),
(16, 8, 'plovrek@student.foi.hr', 0, 15),
(18, 8, 'plovrek@student.foi.hr', 0, 15),
(19, 58, 'andrejlilek7@gmail.com', 0, 15),
(20, 8, 'plovrek@student.foi.hr', 30, 0),
(21, 8, 'plovrek@student.foi.hr', 60, 0),
(22, 8, 'plovrek@student.foi.hr', 30, 0),
(23, 8, 'plovrek@student.foi.hr', 30, 0);

-- --------------------------------------------------------

--
-- Table structure for table `proizvod`
--

CREATE TABLE `proizvod` (
  `proizvod_id` int(11) NOT NULL,
  `moderator_email` varchar(45) NOT NULL,
  `naziv_proizvoda` varchar(45) NOT NULL,
  `opis_proizvoda` text NOT NULL,
  `slika_proizvoda` varchar(65) NOT NULL,
  `kolicina` int(11) NOT NULL,
  `cijena_proizvoda` float NOT NULL,
  `bodovi_kupac` float NOT NULL,
  `cijena_u_bodovima` float NOT NULL,
  `status_proizvoda` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `proizvod`
--

INSERT INTO `proizvod` (`proizvod_id`, `moderator_email`, `naziv_proizvoda`, `opis_proizvoda`, `slika_proizvoda`, `kolicina`, `cijena_proizvoda`, `bodovi_kupac`, `cijena_u_bodovima`, `status_proizvoda`) VALUES
(8, 'patriklovrek007@gmail.com', 'Majica Iron Maiden', 'Pamučna majica Iron Maiden', ' - 2023.05.22 - 12.19.11am.jpg', 5, 15, 7.5, 30, 1),
(54, 'patriklovrek007@gmail.com', 'Staropramen', 'Piće', '1300001019.jpg', 4, 5, 0, 0, 1),
(58, 'pperic@gmail.com', 'Led Zeppelin majica', 'Pamučna majica', '1zeppelin-KNEWBORTH-BLACK.jpg', 0, 15, 7.5, 20, 0),
(59, 'pperic@gmail.com', 'MCR majca', 'Pamučna majica', '200114CFD3049-1.jpg', 0, 20, 8, 20, 0),
(60, 'pperic@gmail.com', 'AC/DC ploča', 'rock ploča', 'acdcvinyl.jpg', 0, 20, 10, 30, 0),
(63, 'pperic@gmail.com', 'Pivo', 'Osvježavajuće piće', '1300001019.jpg', 4, 5, 3, 15, 0),
(65, 'dlovrek78@gmail.com', 'Doors ploča', 'Ploča', 'doors-6-7649.png.jpg', 1, 15, 0, 0, 1),
(66, 'patriklovrek007@gmail.com', 'Beatles ploča', 'Ploča', 'R-833736-1330126205.jpg', 0, 20, 0, 0, 0),
(67, 'patriklovrek007@gmail.com', 'Natpis', 'Old school natpis', '51+ECfqCDGL._UXNaN_FMjpg_QL85_.jpg', 3, 10, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `registar_bodova`
--

CREATE TABLE `registar_bodova` (
  `zapis_bodova_id` int(11) NOT NULL,
  `korisnik_email` varchar(45) NOT NULL,
  `broj_trenutnih_bodova` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `registar_bodova`
--

INSERT INTO `registar_bodova` (`zapis_bodova_id`, `korisnik_email`, `broj_trenutnih_bodova`) VALUES
(1, 'patriklovrek007@gmail.com', 22.5),
(2, 'dlovrek78@gmail.com', 0),
(3, 'dvuljak318@gmail.com', 0),
(4, 'petarmatisic8@gmail.com', 0),
(5, 'plovrek@student.foi.hr', 0),
(6, 'pperic@gmail.com', 0),
(8, 'asd@asd.com', 0),
(9, 'helenamartinaga@gmail.com', 0),
(10, 'atrivic@student.foi.hr', 0),
(15, 'domagoj.pu00@gmail.com', 0),
(16, 'mihael.brlecic@gmail.com', 0),
(17, 'andrejlilek7@gmail.com', 7.5);

-- --------------------------------------------------------

--
-- Table structure for table `tip_korisnika`
--

CREATE TABLE `tip_korisnika` (
  `tip_id` int(11) NOT NULL,
  `naziv_tipa` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tip_korisnika`
--

INSERT INTO `tip_korisnika` (`tip_id`, `naziv_tipa`) VALUES
(1, 'Administrator'),
(2, 'Moderator'),
(3, 'Registrirani korisnik');

-- --------------------------------------------------------

--
-- Table structure for table `tip_radnje`
--

CREATE TABLE `tip_radnje` (
  `tip_radnje_id` int(11) NOT NULL,
  `naziv_radnje` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tip_radnje`
--

INSERT INTO `tip_radnje` (`tip_radnje_id`, `naziv_radnje`) VALUES
(2, 'Uspješna registracija'),
(3, 'Neuspješna registracija'),
(4, 'Uspješna aktivacija'),
(5, 'Neuspješna aktivacija'),
(6, 'Blokiran račun'),
(7, 'Uspješna prijava'),
(8, 'Neuspješna prijava'),
(9, 'Neuspješna promjena lozinke'),
(10, 'Uspješna promjena lozinke'),
(11, 'Promjena slike profila'),
(12, 'Promjena nadimka'),
(13, 'Odlazak u kupovinu'),
(14, 'Pregled kampanje'),
(15, 'Kupnja proizvoda'),
(16, 'Kreiranje kampanje'),
(17, 'Ažuriranje kampanje'),
(18, 'Pregled proizvoda'),
(19, 'Dodjeljeni bodovi'),
(20, 'Kreiranje proizvoda'),
(21, 'Ažuriranje proizvoda'),
(22, 'Blokiranje korisnika'),
(23, 'Odblokiranje korisnika'),
(24, 'Pregled dnevnika'),
(25, 'Konfiguracija aplikacije'),
(26, 'Odjava');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dnevnik_rada`
--
ALTER TABLE `dnevnik_rada`
  ADD PRIMARY KEY (`dnevnik_id`,`tip_radnje_id`),
  ADD KEY `fk_dnevnik_rada_tip_radnje1_idx` (`tip_radnje_id`),
  ADD KEY `fk_dnevnik_rada_korisnik1_idx` (`email`);

--
-- Indexes for table `kampanja`
--
ALTER TABLE `kampanja`
  ADD PRIMARY KEY (`kampanja_id`),
  ADD KEY `fk_kampanja_korisnik1_idx` (`korisnik_email`);

--
-- Indexes for table `kampanja_proizvod`
--
ALTER TABLE `kampanja_proizvod`
  ADD PRIMARY KEY (`kampanja_id`,`proizvod_id`),
  ADD KEY `fk_kampanja_proizvod_proizvod1_idx` (`proizvod_id`);

--
-- Indexes for table `konfiguracija_aplikacje`
--
ALTER TABLE `konfiguracija_aplikacje`
  ADD PRIMARY KEY (`konfiguracija_id`),
  ADD KEY `fk_konfiguracija_aplikacje_korisnik1_idx` (`korisnik_email`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`email`),
  ADD KEY `fk_korisnik_tip_korisnika_idx` (`tip_id`);

--
-- Indexes for table `kupnja`
--
ALTER TABLE `kupnja`
  ADD PRIMARY KEY (`kupnja_id`) USING BTREE,
  ADD KEY `fk_kupnja_proizvod1_idx` (`proizvod_id`),
  ADD KEY `fk_kupnja_korisnik1_idx` (`korisnik_email`);

--
-- Indexes for table `proizvod`
--
ALTER TABLE `proizvod`
  ADD PRIMARY KEY (`proizvod_id`),
  ADD KEY `fk_proizvod_korisnik1_idx` (`moderator_email`);

--
-- Indexes for table `registar_bodova`
--
ALTER TABLE `registar_bodova`
  ADD PRIMARY KEY (`zapis_bodova_id`),
  ADD KEY `fk_registar_bodova_korisnik1_idx` (`korisnik_email`);

--
-- Indexes for table `tip_korisnika`
--
ALTER TABLE `tip_korisnika`
  ADD PRIMARY KEY (`tip_id`);

--
-- Indexes for table `tip_radnje`
--
ALTER TABLE `tip_radnje`
  ADD PRIMARY KEY (`tip_radnje_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dnevnik_rada`
--
ALTER TABLE `dnevnik_rada`
  MODIFY `dnevnik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=460;

--
-- AUTO_INCREMENT for table `kampanja`
--
ALTER TABLE `kampanja`
  MODIFY `kampanja_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `konfiguracija_aplikacje`
--
ALTER TABLE `konfiguracija_aplikacje`
  MODIFY `konfiguracija_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kupnja`
--
ALTER TABLE `kupnja`
  MODIFY `kupnja_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `proizvod`
--
ALTER TABLE `proizvod`
  MODIFY `proizvod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `registar_bodova`
--
ALTER TABLE `registar_bodova`
  MODIFY `zapis_bodova_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tip_korisnika`
--
ALTER TABLE `tip_korisnika`
  MODIFY `tip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tip_radnje`
--
ALTER TABLE `tip_radnje`
  MODIFY `tip_radnje_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dnevnik_rada`
--
ALTER TABLE `dnevnik_rada`
  ADD CONSTRAINT `fk_dnevnik_rada_korisnik1` FOREIGN KEY (`email`) REFERENCES `korisnik` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dnevnik_rada_tip_radnje1` FOREIGN KEY (`tip_radnje_id`) REFERENCES `tip_radnje` (`tip_radnje_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kampanja`
--
ALTER TABLE `kampanja`
  ADD CONSTRAINT `fk_kampanja_korisnik1` FOREIGN KEY (`korisnik_email`) REFERENCES `korisnik` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kampanja_proizvod`
--
ALTER TABLE `kampanja_proizvod`
  ADD CONSTRAINT `fk_kampanja_proizvod_kampanja1` FOREIGN KEY (`kampanja_id`) REFERENCES `kampanja` (`kampanja_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_kampanja_proizvod_proizvod1` FOREIGN KEY (`proizvod_id`) REFERENCES `proizvod` (`proizvod_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `konfiguracija_aplikacje`
--
ALTER TABLE `konfiguracija_aplikacje`
  ADD CONSTRAINT `fk_konfiguracija_aplikacje_korisnik1` FOREIGN KEY (`korisnik_email`) REFERENCES `korisnik` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `fk_korisnik_tip_korisnika` FOREIGN KEY (`tip_id`) REFERENCES `tip_korisnika` (`tip_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kupnja`
--
ALTER TABLE `kupnja`
  ADD CONSTRAINT `fk_kupnja_korisnik1` FOREIGN KEY (`korisnik_email`) REFERENCES `korisnik` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_kupnja_proizvod1` FOREIGN KEY (`proizvod_id`) REFERENCES `proizvod` (`proizvod_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `proizvod`
--
ALTER TABLE `proizvod`
  ADD CONSTRAINT `fk_proizvod_korisnik1` FOREIGN KEY (`moderator_email`) REFERENCES `korisnik` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `registar_bodova`
--
ALTER TABLE `registar_bodova`
  ADD CONSTRAINT `fk_registar_bodova_korisnik1` FOREIGN KEY (`korisnik_email`) REFERENCES `korisnik` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2018 at 06:37 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmacy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'anam', 'anamamer0@gmail.com', '$2y$10$y1gVoOSeyGbVn/95dA2TaOIMFESb08oL7UgzBdQcnhWpsgzO3LaUa', 'IrugtCrZYKrEasetPaFmzj8xy78fa6SQJwe6EB8RsrkDEdieYpMcpomfMP5s', '2018-05-28 11:44:22', '2018-05-28 11:44:22');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `created_at`, `updated_at`, `filename`, `title`, `description`, `status`) VALUES
(1, NULL, '2018-05-28 17:15:59', 'caca', '1', 'fsafa', 0),
(2, NULL, NULL, 'caca', '2', 'fsafa', 1),
(3, NULL, NULL, 'caca', '3', 'fsafa', 1),
(4, NULL, NULL, 'caca', '4', 'fsafa', 1),
(5, NULL, '2018-05-28 17:15:59', 'caca', '5', 'fsafa', 0),
(6, NULL, NULL, 'caca', '6', 'fsafa', 1),
(7, NULL, NULL, 'caca', '7', 'fsafa', 1),
(8, NULL, NULL, 'caca', '8', 'fsafa', 1),
(9, NULL, '2018-05-28 17:15:59', 'caca', '9', 'fsafa', 0),
(10, NULL, NULL, 'caca', '10', 'fsafa', 1),
(11, NULL, NULL, 'caca', '11', 'fsafa', 1),
(12, NULL, NULL, 'caca', '12', 'fsafa', 1),
(13, NULL, '2018-05-28 17:15:59', 'caca', '13', 'fsafa', 0),
(14, NULL, NULL, 'caca', '14', 'fsafa', 1),
(15, NULL, NULL, 'caca', '15', 'fsafa', 1),
(16, NULL, NULL, 'caca', '16', 'fsafa', 1),
(17, NULL, '2018-05-28 17:15:59', 'caca', '17', 'fsafa', 0),
(18, NULL, NULL, 'caca', '18', 'fsafa', 1),
(19, NULL, NULL, 'caca', '19', 'fsafa', 1),
(20, NULL, NULL, 'caca', '20', 'fsafa', 1),
(21, NULL, '2018-05-28 17:15:59', 'caca', '21', 'fsafa', 0),
(22, NULL, NULL, 'caca', '22', 'fsafa', 1),
(23, NULL, NULL, 'caca', '23', 'fsafa', 1),
(24, NULL, NULL, 'caca', '24', 'fsafa', 1),
(25, NULL, '2018-05-28 17:15:59', 'caca', '25', 'fsafa', 0),
(26, NULL, NULL, 'caca', 'fasf', 'fsafa', 1),
(27, NULL, NULL, 'caca', 'fasf', 'fsafa', 1),
(28, NULL, NULL, 'caca', 'fasf', 'fsafa', 1),
(29, NULL, '2018-05-28 17:15:59', 'caca', 'fasf', 'fsafa', 0),
(30, NULL, NULL, 'caca', 'fasf', 'fsafa', 1),
(31, NULL, NULL, 'caca', 'fasf', 'fsafa', 1),
(32, NULL, NULL, 'caca', 'fasf', 'fsafa', 1),
(33, NULL, '2018-05-28 17:15:59', 'caca', 'fasf', 'fsafa', 0),
(34, NULL, '2018-05-28 17:15:59', 'caca', 'fasf', 'fsafa', 0),
(35, NULL, '2018-05-28 17:15:59', 'caca', 'fasf', 'fsafa', 0),
(36, NULL, '2018-05-28 17:15:59', 'caca', 'fasf', 'fsafa', 0),
(37, NULL, '2018-05-28 17:15:59', 'caca', 'fasf', 'fsafa', 0),
(38, NULL, '2018-05-28 17:15:59', 'caca', 'fasf', 'fsafa', 0),
(39, NULL, '2018-05-28 17:15:59', 'caca', 'fasf', 'fsafa', 0),
(40, '2018-05-28 18:33:40', '2018-05-28 18:48:59', 'vT8WbptBaSJS7RTPa8mnlnDkhIsuOcpQVJ5pRNdE.docx', 'test 2', 'blah blah cat', 1),
(41, NULL, NULL, 'caca', 'fasf', 'fsafa', 1),
(42, NULL, NULL, 'caca', 'fasf', 'fsafa', 1),
(43, NULL, '2018-05-28 17:15:59', 'caca', 'fasf', 'fsafa', 0),
(44, NULL, NULL, 'caca', 'fasf', 'fsafa', 1),
(45, NULL, NULL, 'caca', 'fasf', 'fsafa', 1),
(46, NULL, NULL, 'caca', 'fasf', 'fsafa', 1),
(47, NULL, '2018-05-28 17:15:59', 'caca', 'fasf', 'fsafa', 0),
(48, NULL, '2018-05-28 17:15:59', 'caca', 'fasf', 'fsafa', 0),
(49, NULL, '2018-05-28 17:15:59', 'caca', 'fasf', 'fsafa', 0),
(50, NULL, '2018-05-28 17:15:59', 'caca', 'fasf', 'fsafa', 0),
(51, NULL, '2018-05-28 17:15:59', 'caca', 'fasf', 'fsafa', 0),
(52, NULL, '2018-05-28 17:15:59', 'caca', 'fasf', 'fsafa', 0),
(53, NULL, '2018-05-28 17:15:59', 'caca', 'fasf', 'fsafa', 0),
(54, '2018-05-28 18:33:40', '2018-05-28 18:48:59', 'vT8WbptBaSJS7RTPa8mnlnDkhIsuOcpQVJ5pRNdE.docx', 'test 2', 'blah blah cat', 1),
(55, NULL, '2018-05-28 17:15:59', 'caca', '1', 'fsafa', 0),
(56, NULL, NULL, 'caca', '2', 'fsafa', 1),
(57, NULL, NULL, 'caca', '3', 'fsafa', 1),
(58, NULL, NULL, 'caca', '4', 'fsafa', 1),
(59, NULL, '2018-05-28 17:15:59', 'caca', '5', 'fsafa', 0),
(60, NULL, NULL, 'caca', '6', 'fsafa', 1),
(61, NULL, NULL, 'caca', '7', 'fsafa', 1),
(62, NULL, NULL, 'caca', '8', 'fsafa', 1),
(63, NULL, '2018-05-28 17:15:59', 'caca', '9', 'fsafa', 0),
(64, NULL, NULL, 'caca', '10', 'fsafa', 1),
(65, NULL, NULL, 'caca', '11', 'fsafa', 1),
(66, NULL, NULL, 'caca', '12', 'fsafa', 1),
(67, NULL, '2018-05-28 17:15:59', 'caca', '13', 'fsafa', 0),
(68, NULL, NULL, 'caca', '14', 'fsafa', 1),
(69, NULL, NULL, 'caca', '15', 'fsafa', 1),
(70, NULL, NULL, 'caca', '16', 'fsafa', 1),
(71, NULL, '2018-05-28 17:15:59', 'caca', '17', 'fsafa', 0),
(72, NULL, '2018-05-28 17:15:59', 'caca', '1', 'fsafa', 0),
(73, NULL, NULL, 'caca', '2', 'fsafa', 1),
(74, NULL, NULL, 'caca', '3', 'fsafa', 1),
(75, NULL, NULL, 'caca', '4', 'fsafa', 1),
(76, NULL, '2018-05-28 17:15:59', 'caca', '5', 'fsafa', 0),
(77, NULL, NULL, 'caca', '6', 'fsafa', 1),
(78, NULL, NULL, 'caca', '7', 'fsafa', 1),
(79, NULL, NULL, 'caca', '8', 'fsafa', 1),
(80, NULL, '2018-05-28 17:15:59', 'caca', '9', 'fsafa', 0),
(81, NULL, NULL, 'caca', '10', 'fsafa', 1),
(82, NULL, NULL, 'caca', '11', 'fsafa', 1),
(83, NULL, NULL, 'caca', '12', 'fsafa', 1),
(84, NULL, '2018-05-28 17:15:59', 'caca', '13', 'fsafa', 0),
(85, NULL, NULL, 'caca', '14', 'fsafa', 1),
(86, NULL, NULL, 'caca', '15', 'fsafa', 1),
(87, NULL, NULL, 'caca', '16', 'fsafa', 1),
(88, NULL, '2018-05-28 17:15:59', 'caca', '1', 'fsafa', 0),
(89, NULL, NULL, 'caca', '10', 'fsafa', 1),
(90, NULL, NULL, 'caca', '11', 'fsafa', 1),
(91, NULL, NULL, 'caca', '12', 'fsafa', 1),
(92, NULL, '2018-05-28 17:15:59', 'caca', '13', 'fsafa', 0),
(93, NULL, NULL, 'caca', '14', 'fsafa', 1),
(94, NULL, NULL, 'caca', '15', 'fsafa', 1),
(95, NULL, NULL, 'caca', '16', 'fsafa', 1),
(96, NULL, '2018-05-28 17:15:59', 'caca', '17', 'fsafa', 0),
(97, NULL, NULL, 'caca', '18', 'fsafa', 1),
(98, NULL, NULL, 'caca', '19', 'fsafa', 1),
(99, NULL, NULL, 'caca', '20', 'fsafa', 1),
(100, NULL, '2018-05-28 17:15:59', 'caca', '1', 'fsafa', 0),
(101, NULL, NULL, 'caca', '10', 'fsafa', 1),
(102, NULL, NULL, 'caca', '11', 'fsafa', 1),
(103, NULL, NULL, 'caca', '12', 'fsafa', 1),
(104, NULL, '2018-05-28 17:15:59', 'caca', '13', 'fsafa', 0),
(105, NULL, NULL, 'caca', '14', 'fsafa', 1),
(106, NULL, NULL, 'caca', '15', 'fsafa', 1),
(107, NULL, NULL, 'caca', '16', 'fsafa', 1),
(108, NULL, '2018-05-28 17:15:59', 'caca', '17', 'fsafa', 0),
(109, NULL, NULL, 'caca', '18', 'fsafa', 1),
(110, NULL, NULL, 'caca', '19', 'fsafa', 1),
(111, NULL, '2018-05-28 17:15:59', 'caca', '1', 'fsafa', 0),
(112, NULL, NULL, 'caca', '10', 'fsafa', 1),
(113, NULL, NULL, 'caca', '11', 'fsafa', 1),
(114, NULL, NULL, 'caca', '12', 'fsafa', 1),
(115, NULL, '2018-05-28 17:15:59', 'caca', '13', 'fsafa', 0),
(116, NULL, NULL, 'caca', '14', 'fsafa', 1),
(117, NULL, NULL, 'caca', '15', 'fsafa', 1),
(118, NULL, NULL, 'caca', '16', 'fsafa', 1),
(119, NULL, '2018-05-28 17:15:59', 'caca', '17', 'fsafa', 0),
(120, NULL, NULL, 'caca', '18', 'fsafa', 1),
(121, NULL, NULL, 'caca', '19', 'fsafa', 1),
(122, NULL, NULL, 'caca', 'fasf', 'fsafa', 1),
(123, NULL, '2018-05-28 17:15:59', 'caca', 'fasf', 'fsafa', 0),
(124, NULL, '2018-05-28 17:15:59', 'caca', '1', 'fsafa', 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `repliedToId` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recipientEmail` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senderEmail` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `created_at`, `updated_at`, `repliedToId`, `name`, `recipientEmail`, `senderEmail`, `message`, `status`) VALUES
(1, '2018-05-28 19:15:13', '2018-05-29 18:54:17', NULL, 'Anum', '0', 'anamamer0@gmail.com', 'cat', 1),
(2, '2018-05-28 19:33:58', '2018-05-28 19:33:58', 1, 'Admin', 'anamamer0@gmail.com', '0', 'dog', 3),
(3, '2018-05-28 19:37:46', '2018-05-28 19:37:46', 1, 'Admin', 'anamamer0@gmail.com', '0', 'bat', 3),
(4, '2018-05-28 19:15:13', '2018-05-29 17:52:34', NULL, 'Anum', '0', 'anamamer0@gmail.com', 'cat', 1),
(5, '2018-05-28 19:33:58', '2018-05-28 19:33:58', 4, 'Admin', 'anamamer0@gmail.com', '0', 'dog', 3),
(6, '2018-05-28 19:37:46', '2018-05-28 19:37:46', 4, 'Admin', 'anamamer0@gmail.com', '0', 'bat', 3),
(7, '2018-05-28 19:15:13', '2018-05-29 17:48:01', NULL, 'Anum', '0', 'anamamer0@gmail.com', 'cat', 0),
(8, '2018-05-28 19:33:58', '2018-05-28 19:33:58', 1, 'Admin', 'anamamer0@gmail.com', '0', 'dog', 3),
(9, '2018-05-28 19:37:46', '2018-05-28 19:37:46', 1, 'Admin', 'anamamer0@gmail.com', '0', 'bat', 3),
(10, '2018-05-28 19:15:13', '2018-05-29 17:48:03', NULL, 'Anum', '0', 'anamamer0@gmail.com', 'cat', 0),
(11, '2018-05-28 19:33:58', '2018-05-28 19:33:58', 4, 'Admin', 'anamamer0@gmail.com', '0', 'dog', 3),
(12, '2018-05-28 19:37:46', '2018-05-28 19:37:46', 4, 'Admin', 'anamamer0@gmail.com', '0', 'bat', 3),
(13, '2018-05-28 19:15:13', '2018-05-29 17:48:05', NULL, 'Anum', '0', 'anamamer0@gmail.com', 'cat', 0),
(14, '2018-05-28 19:33:58', '2018-05-28 19:33:58', 1, 'Admin', 'anamamer0@gmail.com', '0', 'dog', 3),
(15, '2018-05-28 19:37:46', '2018-05-28 19:37:46', 1, 'Admin', 'anamamer0@gmail.com', '0', 'bat', 3),
(16, '2018-05-28 19:15:13', '2018-05-28 19:33:58', NULL, 'Anum', '0', 'anamamer0@gmail.com', 'cat', 2),
(17, '2018-05-28 19:33:58', '2018-05-28 19:33:58', 4, 'Admin', 'anamamer0@gmail.com', '0', 'dog', 3),
(18, '2018-05-28 19:37:46', '2018-05-28 19:37:46', 4, 'Admin', 'anamamer0@gmail.com', '0', 'bat', 3),
(19, '2018-05-28 19:15:13', '2018-05-29 17:47:54', NULL, 'Anum', '0', 'anamamer0@gmail.com', 'cat', 0),
(20, '2018-05-28 19:33:58', '2018-05-28 19:33:58', 1, 'Admin', 'anamamer0@gmail.com', '0', 'dog', 3),
(21, '2018-05-28 19:37:46', '2018-05-28 19:37:46', 1, 'Admin', 'anamamer0@gmail.com', '0', 'bat', 3),
(22, '2018-05-28 19:15:13', '2018-05-29 17:48:07', NULL, 'Anum', '0', 'anamamer0@gmail.com', 'cat', 0),
(23, '2018-05-28 19:33:58', '2018-05-28 19:33:58', 4, 'Admin', 'anamamer0@gmail.com', '0', 'dog', 3),
(24, '2018-05-28 19:37:46', '2018-05-28 19:37:46', 4, 'Admin', 'anamamer0@gmail.com', '0', 'bat', 3),
(25, '2018-05-28 19:15:13', '2018-05-28 19:33:58', NULL, 'Anum', '0', 'anamamer0@gmail.com', 'cat', 2),
(26, '2018-05-28 19:33:58', '2018-05-28 19:33:58', 1, 'Admin', 'anamamer0@gmail.com', '0', 'dog', 3),
(27, '2018-05-28 19:37:46', '2018-05-28 19:37:46', 1, 'Admin', 'anamamer0@gmail.com', '0', 'bat', 3),
(28, '2018-05-28 19:15:13', '2018-05-28 19:33:58', NULL, 'Anum', '0', 'anamamer0@gmail.com', 'cat', 2),
(29, '2018-05-28 19:33:58', '2018-05-28 19:33:58', 4, 'Admin', 'anamamer0@gmail.com', '0', 'dog', 3),
(30, '2018-05-28 19:37:46', '2018-05-28 19:37:46', 4, 'Admin', 'anamamer0@gmail.com', '0', 'bat', 3),
(31, '2018-05-28 19:15:13', '2018-05-28 19:33:58', NULL, 'Anum', '0', 'anamamer0@gmail.com', 'cat', 2),
(32, '2018-05-28 19:33:58', '2018-05-28 19:33:58', 1, 'Admin', 'anamamer0@gmail.com', '0', 'dog', 3),
(33, '2018-05-28 19:37:46', '2018-05-28 19:37:46', 1, 'Admin', 'anamamer0@gmail.com', '0', 'bat', 3),
(34, '2018-05-28 19:15:13', '2018-05-28 19:33:58', NULL, 'Anum', '0', 'anamamer0@gmail.com', 'cat', 2),
(35, '2018-05-28 19:33:58', '2018-05-28 19:33:58', 4, 'Admin', 'anamamer0@gmail.com', '0', 'dog', 3),
(36, '2018-05-28 19:37:46', '2018-05-28 19:37:46', 4, 'Admin', 'anamamer0@gmail.com', '0', 'bat', 3),
(37, '2018-05-28 19:15:13', '2018-05-28 19:33:58', NULL, 'Anum', '0', 'anamamer0@gmail.com', 'cat', 2),
(38, '2018-05-28 19:33:58', '2018-05-28 19:33:58', 1, 'Admin', 'anamamer0@gmail.com', '0', 'dog', 3),
(39, '2018-05-28 19:37:46', '2018-05-28 19:37:46', 1, 'Admin', 'anamamer0@gmail.com', '0', 'bat', 3),
(40, '2018-05-28 19:15:13', '2018-05-29 18:54:17', NULL, 'Anum', '0', 'anamamer0@gmail.com', 'cat', 1),
(41, '2018-05-28 19:33:58', '2018-05-28 19:33:58', 1, 'Admin', 'anamamer0@gmail.com', '0', 'dog', 3),
(42, '2018-05-28 19:37:46', '2018-05-28 19:37:46', 1, 'Admin', 'anamamer0@gmail.com', '0', 'bat', 3),
(43, '2018-05-28 19:15:13', '2018-05-29 17:52:34', NULL, 'Anum', '0', 'anamamer0@gmail.com', 'cat', 1),
(44, '2018-05-28 19:33:58', '2018-05-28 19:33:58', 4, 'Admin', 'anamamer0@gmail.com', '0', 'dog', 3),
(45, '2018-05-28 19:37:46', '2018-05-28 19:37:46', 4, 'Admin', 'anamamer0@gmail.com', '0', 'bat', 3),
(46, '2018-05-28 19:15:13', '2018-05-29 17:48:01', NULL, 'Anum', '0', 'anamamer0@gmail.com', 'cat', 0),
(47, '2018-05-28 19:33:58', '2018-05-28 19:33:58', 1, 'Admin', 'anamamer0@gmail.com', '0', 'dog', 3),
(48, '2018-05-28 19:37:46', '2018-05-28 19:37:46', 1, 'Admin', 'anamamer0@gmail.com', '0', 'bat', 3),
(49, '2018-05-28 19:15:13', '2018-05-29 17:48:03', NULL, 'Anum', '0', 'anamamer0@gmail.com', 'cat', 0),
(50, '2018-05-28 19:33:58', '2018-05-28 19:33:58', 4, 'Admin', 'anamamer0@gmail.com', '0', 'dog', 3),
(51, '2018-05-28 19:37:46', '2018-05-28 19:37:46', 4, 'Admin', 'anamamer0@gmail.com', '0', 'bat', 3),
(52, '2018-05-28 19:15:13', '2018-05-29 17:48:05', NULL, 'Anum', '0', 'anamamer0@gmail.com', 'cat', 0),
(53, '2018-05-28 19:33:58', '2018-05-28 19:33:58', 1, 'Admin', 'anamamer0@gmail.com', '0', 'dog', 3),
(54, '2018-05-28 19:37:46', '2018-05-28 19:37:46', 1, 'Admin', 'anamamer0@gmail.com', '0', 'bat', 3),
(55, '2018-05-28 19:15:13', '2018-05-28 19:33:58', NULL, 'Anum', '0', 'anamamer0@gmail.com', 'cat', 2);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_pharmacists_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2017_05_25_115803_create_admins_table', 1),
(5, '2018_02_17_121202_create_ratings_table', 1),
(6, '2018_03_26_104304_create_pharmacistproducts_table', 1),
(7, '2018_03_29_094732_create_messages_table', 1),
(8, '2018_03_31_132925_create_shoppingcart_table', 1),
(9, '2018_04_03_041059_create_orders_table', 1),
(10, '2018_04_03_041151_create_orderitems_table', 1),
(11, '2018_05_20_082826_create_files_table', 1),
(12, '2018_05_21_155005_create_prescriptions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `pharmacistId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`id`, `created_at`, `updated_at`, `orderId`, `productId`, `pharmacistId`, `quantity`) VALUES
(1, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, 3, 1, 1),
(3, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 2, 2, 1, 1),
(4, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 3, 4, 1, 1),
(5, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 4, 5, 1, 1),
(6, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 5, 3, 1, 1),
(7, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 6, 2, 1, 1),
(8, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 7, 4, 1, 1),
(9, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 8, 5, 1, 1),
(10, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 9, 3, 1, 1),
(11, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 10, 2, 1, 1),
(12, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 11, 4, 1, 1),
(13, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 12, 5, 1, 1),
(14, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 13, 3, 1, 1),
(15, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 14, 2, 1, 1),
(16, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 15, 4, 1, 1),
(17, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 16, 5, 1, 1),
(18, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 18, 3, 1, 1),
(19, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 19, 2, 1, 1),
(20, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 20, 4, 1, 1),
(27, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 17, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `userId` int(11) NOT NULL,
  `cost` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `prescription` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `created_at`, `updated_at`, `userId`, `cost`, `status`, `prescription`) VALUES
(1, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(2, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(3, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(4, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(5, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(6, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(7, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(8, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(9, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(10, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(11, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(12, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(13, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(14, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(15, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(16, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(17, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(18, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(19, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(20, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(21, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(22, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(23, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(24, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(25, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(26, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(27, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(28, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(29, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(30, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(31, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(32, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(33, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(34, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(35, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(36, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(37, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(38, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(39, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(40, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(41, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(42, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(43, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(44, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(45, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(46, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(47, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(48, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(49, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(50, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(51, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(52, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(53, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(54, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(55, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(56, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(57, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(58, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(59, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(60, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(61, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(62, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(63, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(64, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(65, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(66, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(67, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0),
(68, '2018-05-28 21:28:12', '2018-05-28 21:28:12', 1, '4.00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacistproducts`
--

CREATE TABLE `pharmacistproducts` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pharmacistId` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pharmacistName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dosage` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `prescription` int(11) NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pharmacistproducts`
--

INSERT INTO `pharmacistproducts` (`id`, `created_at`, `updated_at`, `pharmacistId`, `pharmacistName`, `name`, `dosage`, `type`, `prescription`, `price`, `quantity`) VALUES
(10, '2018-05-28 21:26:56', '2018-05-28 21:26:56', '1', 'ABC', 'regix', '3', 4, 0, '4', 3),
(11, '2018-05-28 21:26:56', '2018-05-28 21:26:56', '1', 'ABC', 'regix', '3', 2, 0, '4', 3),
(12, '2018-05-28 21:26:56', '2018-05-28 21:26:56', '1', 'ABC', 'regix', '3', 5, 0, '4', 3),
(13, '2018-05-29 01:25:27', '2018-05-29 01:25:27', '1', 'ABC', 'regix', '666', 1, 0, '564', 151),
(14, '2018-05-28 21:26:56', '2018-05-28 21:26:56', '1', 'ABC', 'regix', '3', 4, 0, '4', 3),
(15, '2018-05-28 21:26:56', '2018-05-28 21:26:56', '1', 'ABC', 'regix', '3', 2, 0, '4', 3),
(16, '2018-05-28 21:26:56', '2018-05-28 21:26:56', '1', 'ABC', 'regix', '3', 5, 0, '4', 3),
(17, '2018-05-29 01:25:27', '2018-05-29 01:25:27', '1', 'ABC', 'regix', '666', 1, 0, '564', 151),
(18, '2018-05-28 21:26:56', '2018-05-28 21:26:56', '1', 'ABC', 'regix', '3', 4, 0, '4', 3),
(19, '2018-05-28 21:26:56', '2018-05-28 21:26:56', '1', 'ABC', 'regix', '3', 2, 0, '4', 3),
(20, '2018-05-28 21:26:56', '2018-05-28 21:26:56', '1', 'ABC', 'regix', '3', 5, 0, '4', 3),
(21, '2018-05-29 01:25:27', '2018-05-29 01:25:27', '1', 'ABC', 'regix', '666', 1, 0, '564', 151),
(22, '2018-05-28 21:26:56', '2018-05-28 21:26:56', '1', 'ABC', 'regix', '3', 4, 0, '4', 3),
(23, '2018-05-28 21:26:56', '2018-05-28 21:26:56', '1', 'ABC', 'regix', '3', 2, 0, '4', 3),
(24, '2018-05-28 21:26:56', '2018-05-28 21:26:56', '1', 'ABC', 'regix', '3', 5, 0, '4', 3),
(25, '2018-05-29 01:25:27', '2018-05-29 01:25:27', '1', 'ABC', 'regix', '666', 1, 0, '564', 151),
(26, '2018-05-28 21:26:56', '2018-05-28 21:26:56', '1', 'ABC', 'regix', '3', 4, 0, '4', 3),
(27, '2018-05-28 21:26:56', '2018-05-28 21:26:56', '1', 'ABC', 'regix', '3', 4, 0, '4', 3),
(28, '2018-05-28 21:26:56', '2018-05-28 21:26:56', '1', 'ABC', 'regix', '3', 2, 0, '4', 3),
(29, '2018-05-28 21:26:56', '2018-05-28 21:26:56', '1', 'ABC', 'regix', '3', 5, 0, '4', 3),
(30, '2018-05-29 01:25:27', '2018-05-29 01:25:27', '1', 'ABC', 'regix', '666', 1, 0, '564', 151),
(31, '2018-05-28 21:26:56', '2018-05-28 21:26:56', '1', 'ABC', 'regix', '3', 4, 0, '4', 3),
(32, '2018-05-28 21:26:56', '2018-05-28 21:26:56', '1', 'ABC', 'regix', '3', 2, 0, '4', 3),
(33, '2018-05-28 21:26:56', '2018-05-28 21:26:56', '1', 'ABC', 'regix', '3', 5, 0, '4', 3),
(34, '2018-05-29 01:25:27', '2018-05-29 01:25:27', '1', 'ABC', 'regix', '666', 1, 0, '564', 151),
(35, '2018-05-28 21:26:56', '2018-05-28 21:26:56', '1', 'ABC', 'regix', '3', 4, 0, '4', 3),
(36, '2018-05-28 21:26:56', '2018-05-28 21:26:56', '1', 'ABC', 'regix', '3', 2, 0, '4', 3),
(37, '2018-05-28 21:26:56', '2018-05-28 21:26:56', '1', 'ABC', 'regix', '3', 5, 0, '4', 3),
(38, '2018-05-29 01:25:27', '2018-05-29 01:25:27', '1', 'ABC', 'regix', '666', 1, 0, '564', 151),
(39, '2018-05-28 21:26:56', '2018-05-28 21:26:56', '1', 'ABC', 'regix', '3', 4, 0, '4', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pharmacists`
--

CREATE TABLE `pharmacists` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `verificationToken` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verificationStatus` tinyint(1) NOT NULL DEFAULT '0',
  `pharmacistStatus` int(11) NOT NULL DEFAULT '1',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pharmacyName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `society` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` double(10,6) NOT NULL,
  `latitude` double(10,6) NOT NULL,
  `freeDeliveryPurchase` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dataSource` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `dbAPI` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pharmacists`
--

INSERT INTO `pharmacists` (`id`, `created_at`, `updated_at`, `verificationToken`, `verificationStatus`, `pharmacistStatus`, `name`, `email`, `contact`, `pharmacyName`, `address`, `society`, `city`, `longitude`, `latitude`, `freeDeliveryPurchase`, `dataSource`, `dbAPI`, `password`, `remember_token`) VALUES
(1, '2018-05-28 11:47:05', '2018-05-29 14:43:31', NULL, 1, 1, 'Anum Amir', 'anamamer0@gmail.com', '11111111111', 'ABC', '59 k1', 'valencia town', 'Lahore', 74.257217, 31.393272, '55', '2', NULL, '$2y$10$P383oJZ/OpeMn2VXJ86ws.XnT1LMT0YObFHPwOwqydstHBlOcpIXK', 'eFQEfSDSKC6kbefGumuZZM2QoFXESJrd0DMQ1BicwxJ0ly3FvMxEg6QoRWwE');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` int(10) UNSIGNED NOT NULL,
  `orderId` int(11) NOT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pharmacyId` int(11) NOT NULL,
  `pharmacyName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` double(5,1) NOT NULL DEFAULT '0.0',
  `noOfUserThatRated` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `created_at`, `updated_at`, `pharmacyId`, `pharmacyName`, `rating`, `noOfUserThatRated`) VALUES
(1, '2018-05-28 11:55:50', '2018-05-28 11:55:50', 1, 'ABC', 0.0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shoppingcart`
--

CREATE TABLE `shoppingcart` (
  `identifier` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instance` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `verificationToken` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verificationStatus` tinyint(1) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `society` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` double(10,6) NOT NULL,
  `latitude` double(10,6) NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `created_at`, `updated_at`, `verificationToken`, `verificationStatus`, `status`, `name`, `email`, `contact`, `address`, `society`, `city`, `longitude`, `latitude`, `password`, `remember_token`) VALUES
(1, '2018-05-23 15:59:47', '2018-05-29 02:57:12', NULL, 1, 1, 'Anum Am', 'anamamer0@gmail.com', '66666666666', '59 k1', 'wapda town', 'lahore', 74.257217, 31.393272, '$2y$10$GlPthKyRGtkzycUUWFq16uvE4BYJR2C9Af8uzKMr1YYaAuovYDNkC', 'hmLCVN2Crb5OJNYPp6oVNNmeMEIeiqoksgvMiGDsb3S2ZZs2JwEyvruQ2iYK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pharmacistproducts`
--
ALTER TABLE `pharmacistproducts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacists`
--
ALTER TABLE `pharmacists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pharmacists_email_unique` (`email`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`identifier`,`instance`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `pharmacistproducts`
--
ALTER TABLE `pharmacistproducts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `pharmacists`
--
ALTER TABLE `pharmacists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

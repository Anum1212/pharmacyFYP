-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2018 at 07:40 PM
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
(1, 'anam', 'anamamer0@gmail.com', '$2y$10$y1gVoOSeyGbVn/95dA2TaOIMFESb08oL7UgzBdQcnhWpsgzO3LaUa', 'XKmfPGJDa4eIpkoiOTUuLhGAIP1I34hPcTzpOD9P3FuKs2vDdtZV3aF5wty0', '2018-05-28 11:44:22', '2018-05-28 11:44:22');

-- --------------------------------------------------------

--
-- Table structure for table `chat_records`
--

CREATE TABLE `chat_records` (
  `id` int(10) UNSIGNED NOT NULL,
  `pharmicistName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senderName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `localfetchrecord`
--

CREATE TABLE `localfetchrecord` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `uniqueId` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `request` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pharmacyNames` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `traversedBy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'nothing',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `localfetchrecord`
--

INSERT INTO `localfetchrecord` (`id`, `user_id`, `uniqueId`, `request`, `pharmacyNames`, `traversedBy`, `created_at`, `updated_at`) VALUES
(37, 1, NULL, 'a:2:{s:23:\"localPharmacyNamesArray\";a:0:{}s:12:\"medicineName\";s:8:\"panadaol\";}', '', 'nothing', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `local_medicines_results`
--

CREATE TABLE `local_medicines_results` (
  `id` int(10) UNSIGNED NOT NULL,
  `pharmacyName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brandName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genericName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `strenghts` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `local_medicines_results`
--

INSERT INTO `local_medicines_results` (`id`, `pharmacyName`, `brandName`, `genericName`, `price`, `quantity`, `strenghts`, `type`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'C1', 'panadaol', 'paracetamol', 12, 300, 'table 300 mg, syrup 600 mg', 1, '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `medicine_names`
--

CREATE TABLE `medicine_names` (
  `id` int(11) NOT NULL,
  `brandName` varchar(255) NOT NULL,
  `genericName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicine_names`
--

INSERT INTO `medicine_names` (`id`, `brandName`, `genericName`) VALUES
(1, 'panadaol', 'paracetamol'),
(2, 'panadol', 'paracetamol'),
(0, 'regix', 'regix');

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
-- Table structure for table `mostsearch`
--

CREATE TABLE `mostsearch` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `userId` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mostsearch`
--

INSERT INTO `mostsearch` (`id`, `name`, `created_at`, `userId`) VALUES
(1, 'panadol', '2018-06-18', 1),
(2, 'panadol', '2018-06-18', 1),
(3, 'panadol', '2018-06-18', 1),
(5, 'panadaol', '2018-06-18', 1),
(6, 'panadol', '2018-06-18', 1),
(7, 'laravel', '2018-06-18', 1),
(8, 'laravel', '2018-06-18', 1);

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
  `prescription` int(11) NOT NULL DEFAULT '0',
  `ratingStatus` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `paths`
--

CREATE TABLE `paths` (
  `id` int(10) UNSIGNED NOT NULL,
  `lat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lng` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `typeOfStorage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pharmacyName` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paths`
--

INSERT INTO `paths` (`id`, `lat`, `lng`, `address`, `api`, `typeOfStorage`, `pharmacyName`, `created_at`, `updated_at`) VALUES
(1, '31.5006800', '74.3574530', '43-52 Industrial Area, Gulberg-III, Lahore 54660, Pakistan', 'http://keer.aua.net.pk/mediDetails', 'API', 'A1', NULL, NULL),
(2, '31.446754', '74.303695', '\r\n372 Block 1 Sector C-1, Lahore 54600, Pakistan', 'http://keer.aua.net.pk/mediDetails2', 'API', 'B1', NULL, NULL),
(3, '31.5006800', '74.3574530', '44-52 Industrial Area, Gulberg-III, Lahore 54660, Pakistan', NULL, 'desktop', 'C1', NULL, NULL),
(4, '31.5006800', '74.3574530', '45-52 Industrial Area, Gulberg-III, Lahore 54660, Pakistan', NULL, 'desktop', 'D1', NULL, NULL),
(5, '31.446754', '74.303695', '\r\n372 Block 1 Sector C-1, Lahore 54600, Pakistan', 'http://keer.aua.net.pk/mediDetails3', 'API', 'B2', NULL, NULL),
(6, '31.446752', '74.303691', '\r\n375 Block 1 Sector C-1, Lahore 54600, Pakistan', NULL, 'inventory', 'smartStore', NULL, NULL);

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
  `quantity` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `productSource` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pharmacistproducts`
--

INSERT INTO `pharmacistproducts` (`id`, `created_at`, `updated_at`, `pharmacistId`, `pharmacistName`, `name`, `dosage`, `type`, `prescription`, `price`, `quantity`, `status`, `productSource`) VALUES
(1, '2018-06-16 01:56:30', '2018-06-16 01:56:42', '1', 'Pharmacy 1', 'Pharmacy 1 Product 1', '1', 1, 0, '1', 1, 1, 1),
(2, '2018-06-16 01:57:09', '2018-06-16 01:57:09', '1', 'Pharmacy 1', 'Pharmacy 1 Product 2', '1', 2, 0, '1', 1, 1, 1),
(3, '2018-06-16 01:58:03', '2018-06-16 01:58:03', '3', 'Pharmacy 3', 'Pharmacy 3 Product 1', '3', 5, 0, '3', 3, 1, 1),
(4, '2018-06-16 01:58:23', '2018-06-16 01:58:23', '3', 'Pharmacy 3', 'Pharmacy 3 Product 2', '3', 6, 0, '3', 3, 1, 1),
(5, '2018-06-16 01:59:28', '2018-06-16 01:59:28', '2', 'Pharmacy 2', 'Pharmacy 2 Product 1', '2', 3, 0, '2', 2, 1, 1),
(6, '2018-06-16 01:59:50', '2018-06-16 01:59:50', '2', 'Pharmacy 2', 'Pharmacy 2 Product 2', '2', 4, 0, '2', 2, 1, 1);

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
(1, '2018-06-16 01:41:25', '2018-06-16 01:55:38', NULL, 1, 1, 'Pharmacy 1', 'anamamer0@gmail.com', '11111111111', 'Pharmacy 1', '59 K1', 'valencia town', 'lahore', 74.257217, 31.393272, '55', '1', NULL, '$2y$10$JrXFdHMvIZbDHhM8FrBYfOZduIpyv4dTEHdA7JQlGkHTUYnS/5zGe', 'pwWxFCo7bfdeuU67uE0CP6vI85YpO2YWw9ATxCeumTkxuJ8aMJzdF5mgLlg9'),
(2, '2018-06-16 01:43:50', '2018-06-16 01:58:53', NULL, 1, 1, 'Pharmacy 2', 'anumamir010@gmail.com', '22222222222', 'Pharmacy 2', '59 K1', 'wapda town', 'lahore', 74.257217, 31.393272, '55', '1', NULL, '$2y$10$TQpW6g1mwIbHIl53X/EeKeOp5i5/GP8jnKucRboDaBdAXHmb.yOxG', 'pTNT4wkvv2UdLwbpoC7WXmv6u17Hfk7JLCULk3v2k72Oh4Qy4uqRz0tW8ThL'),
(3, '2018-06-16 01:52:02', '2018-06-16 01:57:40', NULL, 1, 1, 'Pharmacy 3', 'anamamer010@gmail.com', '33333333333', 'Pharmacy 3', '50 A', 'johar town', 'lahore', 74.263872, 31.430885, '55', '2', NULL, '$2y$10$BsNnOeDNBmu4N1AKr44MkeaT5ZHw8xMG6hH8pzq1Wl1Lg.doPfLEm', 'RbZqeXkOIIxyM5DExO9GN12w5G3aSqHjS4tsex6I1zyqlo0eCn55ijR78Z30');

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
(1, '2018-06-16 01:41:43', '2018-06-18 00:29:03', 1, 'Pharmacy 1', 0.0, 0),
(2, '2018-06-16 01:50:26', '2018-06-18 00:29:03', 2, 'Pharmacy 2', 0.0, 0),
(3, '2018-06-16 01:55:19', '2018-06-18 00:29:03', 3, 'Pharmacy 3', 0.0, 0);

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
(1, '2018-05-23 15:59:47', '2018-06-12 06:18:35', NULL, 1, 1, 'Anum Am', 'anamamer0@gmail.com', '66666666666', '59 k1', 'wapda town', 'lahore', 74.257217, 31.393272, '$2y$10$GlPthKyRGtkzycUUWFq16uvE4BYJR2C9Af8uzKMr1YYaAuovYDNkC', 'tKbXg0dscjSNXnAYzPBcdvKbSVsA76ua8lTiG2SKqZONVErQVZ3aj3yn7TYX');

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
-- Indexes for table `chat_records`
--
ALTER TABLE `chat_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `localfetchrecord`
--
ALTER TABLE `localfetchrecord`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `localfetchrecord_user_id_unique` (`user_id`);

--
-- Indexes for table `local_medicines_results`
--
ALTER TABLE `local_medicines_results`
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
-- Indexes for table `mostsearch`
--
ALTER TABLE `mostsearch`
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
-- Indexes for table `paths`
--
ALTER TABLE `paths`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `chat_records`
--
ALTER TABLE `chat_records`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `localfetchrecord`
--
ALTER TABLE `localfetchrecord`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `local_medicines_results`
--
ALTER TABLE `local_medicines_results`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mostsearch`
--
ALTER TABLE `mostsearch`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paths`
--
ALTER TABLE `paths`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pharmacistproducts`
--
ALTER TABLE `pharmacistproducts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pharmacists`
--
ALTER TABLE `pharmacists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

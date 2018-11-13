-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2018 at 07:01 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `life_line`
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
(1, 'anam', 'anamamer0@gmail.com', '$2y$10$y1gVoOSeyGbVn/95dA2TaOIMFESb08oL7UgzBdQcnhWpsgzO3LaUa', 'Jy9jqw3Ko9LzxiEcSX9SYATtcx4nnRGlaFs9ChCJdounzNykzpht86xiH4K3', '2018-05-28 11:44:22', '2018-05-28 11:44:22');

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
(12, '2018_05_21_155005_create_prescriptions_table', 1),
(13, '2018_06_23_102308_create_reminder_table', 2);

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
  `deliverydate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `pharmacistproducts`
--

CREATE TABLE `pharmacistproducts` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pharmacistId` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pharmacistName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genericName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manufacturer` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tablets` int(191) DEFAULT NULL,
  `dosage` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `prescription` int(11) NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pharmacistproducts`
--

INSERT INTO `pharmacistproducts` (`id`, `created_at`, `updated_at`, `pharmacistId`, `pharmacistName`, `name`, `genericName`, `category`, `manufacturer`, `tablets`, `dosage`, `type`, `prescription`, `price`, `quantity`, `status`) VALUES
(1, '2018-06-26 22:43:27', '2018-07-04 10:25:06', '1', 'ishaq pharmacy', 'Amoxicillin', 'Amoxicillin', 'category1', 'AdamJee Pharmaceuticals', NULL, '10', 1, 0, '10', 18, 1),
(2, '2018-06-26 22:44:01', '2018-07-01 15:32:50', '1', 'ishaq pharmacy', 'Amoxicillin', 'generic name', 'category1', 'qdsfg', 0, '10', 5, 0, '10', 0, 1),
(3, '2018-06-26 22:44:59', '2018-07-01 15:29:53', '1', 'ishaq pharmacy', 'Amoxicillin', 'generic name', 'category1', 'ertrty', 0, '10', 3, 0, '10', 213, 0),
(4, '2018-06-26 22:43:27', '2018-07-04 05:13:46', '2', 'Health Mart', 'Amoxicillin', 'generic name', 'category1', 'yrtdg', 0, '20', 1, 0, '20', 997, 1),
(5, '2018-06-26 22:44:01', '2018-06-26 22:44:01', '2', 'Health Mart', 'Amoxicillin', 'generic name', 'category1', 'ebrs', 0, '20', 5, 0, '20', 452, 1),
(6, '2018-06-26 22:44:59', '2018-07-04 03:25:17', '2', 'Health Mart', 'Amoxicillin', 'generic name', 'category1', '2345', 0, '20', 3, 0, '20', 195, 1),
(7, '2018-06-26 22:48:03', '2018-07-01 15:29:50', '1', 'ishaq pharmacy', 'insulin', 'generic name', 'category1', 't45h', 0, '10', 6, 1, '10', 26, 1),
(8, '2018-06-26 22:48:03', '2018-06-26 22:48:03', '2', 'Health Mart', 'insulin', 'generic name', 'category1', 'rsdc', 0, '20', 6, 1, '20', 84, 1),
(9, '2018-07-01 15:45:58', '2018-07-01 15:45:58', '1', 'ishaq pharmacy', 'Panadol', 'Paracetamol', 'category1', 'AdamJee Pharmaceuticals', 100, '500', 1, 0, '100', 200, 1),
(10, '2018-07-01 15:47:33', '2018-07-01 15:47:33', '1', 'ishaq pharmacy', 'brufin', 'Ibuprofen', 'category1', 'AdamJee Pharmaceuticals', 200, '120', 1, 0, '89', 75, 1),
(11, '2018-07-01 15:49:09', '2018-07-01 15:49:09', '1', 'ishaq pharmacy', 'rigix', 'Chlorpheniramine-Phenylpropan', 'category1', 'AdamJee Pharmaceuticals', 200, '180', 1, 0, '97', 45, 1),
(12, '2018-07-01 15:52:57', '2018-07-01 15:52:57', '1', 'ishaq pharmacy', 'Meiji Fu', 'Meiji Fu', 'category3', 'Meiji Fu', NULL, '400', 8, 0, '600', 800, 1),
(13, '2018-07-01 15:54:25', '2018-07-01 15:54:25', '1', 'ishaq pharmacy', 'Farlin Baby Cart', 'Farlin Baby Cart', 'category3', 'Farlin', NULL, '800', 8, 0, '5000', 6, 1),
(14, '2018-07-01 15:55:07', '2018-07-01 15:55:07', '1', 'ishaq pharmacy', 'Green Tea Ultra', 'Green Tea', 'category2', 'Green Tea', NULL, '600', 8, 0, '2500', 46, 1),
(15, '2018-07-01 15:55:56', '2018-07-01 15:55:56', '1', 'ishaq pharmacy', 'Bio Alma Black Color', 'Bio Alma', 'category4', 'Bio Alma', NULL, '60', 8, 0, '120', 46, 1),
(16, '2018-07-01 15:56:42', '2018-07-01 15:56:57', '1', 'ishaq pharmacy', 'Fair n Lovely Men', 'Fair n Lovely', 'category4', 'Fair n Lovely', NULL, '60', 8, 0, '210', 246, 1),
(17, '2018-07-01 15:57:51', '2018-07-01 18:27:58', '1', 'ishaq pharmacy', 'Sensodyne Rapid Action', 'Sensodyne', 'category5', 'Sensodyne', NULL, '250', 8, 0, '130', 43, 1),
(18, '2018-07-01 15:58:30', '2018-07-01 15:58:30', '1', 'ishaq pharmacy', 'Medicam', 'Medicam', 'category4', 'Medicam', NULL, '180', 8, 0, '245', 65, 1),
(19, '2018-07-01 16:04:36', '2018-07-01 16:04:36', '1', 'ishaq pharmacy', 'Body Weight machine', 'Westpoint', 'category5', 'Westpoint', NULL, '600', 8, 0, '1200', 6, 1),
(20, '2018-07-01 16:06:33', '2018-07-01 16:06:33', '3', 'Servaid Pharmacy', 'brufen', 'Ibuprofen', 'category1', 'Ideal Pharmaceuticals Industries', NULL, '140', 3, 0, '65', 95, 1),
(21, '2018-07-01 16:09:05', '2018-07-01 16:09:05', '3', 'Servaid Pharmacy', 'Disprin', 'Aspirin', 'category1', 'Ideal Pharmaceuticals Industries', 200, '60', 1, 0, '210', 486, 1),
(22, '2018-07-01 16:12:10', '2018-07-01 16:12:10', '3', 'Servaid Pharmacy', 'Ponstan Forte', 'Mefenamic acid', 'category1', 'Ideal Pharmaceuticals Industries', 200, '500', 1, 0, '600', 65, 1),
(23, '2018-07-01 16:13:01', '2018-07-01 16:13:01', '3', 'Servaid Pharmacy', 'Farlin Soothing Gum soother', 'Farlin', 'category3', 'Farlin', NULL, '85', 8, 0, '220', 35, 1),
(24, '2018-07-01 16:14:21', '2018-07-01 16:14:21', '3', 'Servaid Pharmacy', 'Ultra Fish Oil', 'Ultra', 'category2', 'Ultra', NULL, '250', 8, 0, '2900', 15, 1),
(25, '2018-07-01 16:15:28', '2018-07-01 16:15:28', '3', 'Servaid Pharmacy', 'Nivea Cream', 'Nivea', 'category4', 'Nivea', NULL, '1000', 8, 0, '350', 49, 1),
(26, '2018-07-01 16:16:18', '2018-07-01 16:16:18', '3', 'Servaid Pharmacy', 'Clean And Clear Black Heads Scrub', 'Clean And Clear', 'category4', 'Clean And Clear', NULL, '120', 8, 0, '350', 67, 1),
(27, '2018-07-01 16:18:02', '2018-07-01 16:18:02', '3', 'Servaid Pharmacy', 'Colgate Sensitive Pro Relief', 'Colgate', 'category5', 'Colgate', NULL, '200', 8, 0, '250', 3, 1),
(28, '2018-07-01 16:21:44', '2018-07-01 16:21:44', '3', 'Servaid Pharmacy', 'Blood Glucose Test Machine', 'Westpoint', 'category6', 'Westpoint', 0, '650', 8, 0, '3500', 16, 1),
(30, '2018-06-26 22:44:59', '2018-06-26 22:44:59', '2', 'Health Mart', 'Cat', 'cat', 'category1', '2345', 0, '20', 3, 0, '20', 213, 1);

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
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pharmacists`
--

INSERT INTO `pharmacists` (`id`, `created_at`, `updated_at`, `verificationToken`, `verificationStatus`, `pharmacistStatus`, `name`, `email`, `contact`, `pharmacyName`, `address`, `society`, `city`, `longitude`, `latitude`, `password`, `remember_token`) VALUES
(1, '2018-06-16 01:41:25', '2018-06-26 22:42:37', NULL, 1, 1, 'Adil Rehman', 'anamamer0@gmail.com', '11111111111', 'ishaq pharmacy', '59 K1', 'valencia town', 'lahore', 74.256716, 31.402508, '$2y$10$JrXFdHMvIZbDHhM8FrBYfOZduIpyv4dTEHdA7JQlGkHTUYnS/5zGe', NULL),
(2, '2018-06-16 01:43:50', '2018-06-16 01:58:53', NULL, 1, 1, 'Abdul Saqib', 'test01@gmail.com', '22222222222', 'Health Mart', '59 K1', 'wapda town', 'lahore', 74.315836, 31.465340, '$2y$10$JrXFdHMvIZbDHhM8FrBYfOZduIpyv4dTEHdA7JQlGkHTUYnS/5zGe', NULL),
(3, '2018-06-16 01:52:02', '2018-06-16 01:57:40', NULL, 1, 1, 'Rashid Alam', 'test02@gmail.com', '33333333333', 'Servaid Pharmacy', '50 A', 'johar town', 'lahore', 74.320073, 31.500571, '$2y$10$JrXFdHMvIZbDHhM8FrBYfOZduIpyv4dTEHdA7JQlGkHTUYnS/5zGe', NULL),
(4, '2018-07-03 01:02:33', '2018-07-03 02:51:19', NULL, 1, 1, 'Fazal ul Din', 'test03@gmail.com', '926666666666', 'Fazal Dins Pharmacy', '59 K1', 'Valenica Town', 'Lahore', 74.256081, 31.404513, '$2y$10$JrXFdHMvIZbDHhM8FrBYfOZduIpyv4dTEHdA7JQlGkHTUYnS/5zGe', NULL),
(5, '2018-07-03 01:02:33', '2018-07-03 02:51:19', NULL, 1, 1, 'Hashim', 'test04@gmail.com', '926666666666', 'Sehat', '59 K1', 'Valenica Town', 'Lahore', 74.256081, 31.404513, '$2y$10$JrXFdHMvIZbDHhM8FrBYfOZduIpyv4dTEHdA7JQlGkHTUYnS/5zGe', NULL),
(6, '2018-07-03 01:02:33', '2018-07-03 02:51:19', NULL, 1, 1, 'xampp', 'xampp@gmail.com', '926666666666', 'xampp', '59 K1', 'Valenica Town', 'Lahore', 74.256081, 31.404513, '$2y$10$JrXFdHMvIZbDHhM8FrBYfOZduIpyv4dTEHdA7JQlGkHTUYnS/5zGe', NULL);

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
(1, '2018-06-16 01:41:43', '2018-06-18 00:29:03', 1, 'Pharmacy 1', 3.5, 1),
(2, '2018-06-16 01:50:26', '2018-06-18 00:29:03', 2, 'Pharmacy 2', 0.0, 0),
(3, '2018-06-16 01:55:19', '2018-06-18 00:29:03', 3, 'Pharmacy 3', 2.5, 1),
(4, '2018-07-03 01:03:04', '2018-07-03 01:03:04', 4, 'Fazal Dins Pharmacy', 0.0, 0),
(5, '2018-07-03 01:03:04', '2018-07-03 01:03:04', 5, 'sehat', 0.0, 0),
(6, '2018-07-03 01:03:04', '2018-07-03 01:03:04', 5, 'xampp', 0.0, 0);

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
  `contact` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(1, '2018-05-23 15:59:47', '2018-06-26 05:28:54', NULL, 1, 1, 'Anum Amir', 'anamamer0@gmail.com', '923208778084', '59 k1', 'wapda town', 'lahore', 74.257217, 31.393272, '$2y$10$GlPthKyRGtkzycUUWFq16uvE4BYJR2C9Af8uzKMr1YYaAuovYDNkC', 'hs6GtDJyUju0ZotRWqqrmcpUDm4E9NXSZiiVgBppQ99nleoGJ7ET8Dpn9cAb');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
-- AUTO_INCREMENT for table `pharmacistproducts`
--
ALTER TABLE `pharmacistproducts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pharmacists`
--
ALTER TABLE `pharmacists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

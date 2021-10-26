-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 14, 2021 at 11:31 AM
-- Server version: 10.3.29-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alfacode_jajbashop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sponsor_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `primary_setup` int(11) DEFAULT NULL,
  `vendor` int(11) DEFAULT NULL,
  `collection` int(11) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `rider` int(11) DEFAULT NULL,
  `shipment` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `sponsor_id`, `email_verified_at`, `password`, `primary_setup`, `vendor`, `collection`, `role`, `rider`, `shipment`, `image`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'JajbaShop', 'admin@jajbashop.com', 'js123456', '2021-07-31 10:26:34', '$2y$12$w1NRvZ.3uS5wJpGGvPrMrOvJf1WcTC1pdsT07DIkEnrWMjEermrBm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'upload/admin/1223710320admin.png', NULL, '2021-08-13 15:57:00');

-- --------------------------------------------------------

--
-- Table structure for table `deposites`
--

CREATE TABLE `deposites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_remark` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_remark` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `epins`
--

CREATE TABLE `epins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `epin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `used_at` timestamp NULL DEFAULT NULL,
  `usedBy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Unused',
  `package` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `epins`
--

INSERT INTO `epins` (`id`, `epin`, `used_at`, `usedBy`, `status`, `package`, `created_at`, `updated_at`) VALUES
(35, '6114e09a2c45080294831', '2021-08-12 14:35:16', 'js001', 'used', 1, '2021-08-12 14:34:30', '2021-08-12 14:35:16'),
(36, '6114e09a2df0959636001', NULL, NULL, 'Unused', 1, '2021-08-12 14:34:30', '2021-08-12 14:34:30'),
(37, '6114e09a2f55067200501', NULL, NULL, 'Unused', 1, '2021-08-12 14:34:30', '2021-08-12 14:34:30'),
(38, '6114e09a3078f4182351', NULL, NULL, 'Unused', 1, '2021-08-12 14:34:30', '2021-08-12 14:34:30'),
(39, '6114e09a327be19105011', '2021-08-12 17:14:21', 'js24443', 'used', 1, '2021-08-12 14:34:30', '2021-08-12 17:14:21'),
(40, '611504854c91f73591321', NULL, NULL, 'Unused', 1, '2021-08-12 17:07:45', '2021-08-12 17:07:45'),
(41, '611504854ed048821771', '2021-08-12 18:04:08', 'js123466', 'used', 1, '2021-08-12 17:07:45', '2021-08-12 18:04:08'),
(42, '6115048550ef763174971', '2021-08-12 18:26:41', 'js26536', 'used', 1, '2021-08-12 17:07:45', '2021-08-12 18:26:41'),
(43, '611504855327e44666151', NULL, NULL, 'Unused', 1, '2021-08-12 17:07:45', '2021-08-12 17:07:45'),
(44, '6115048554ab199793931', '2021-08-12 17:31:15', 'js002', 'used', 1, '2021-08-12 17:07:45', '2021-08-12 17:31:15'),
(45, '61150485564b740169091', NULL, NULL, 'Unused', 1, '2021-08-12 17:07:45', '2021-08-12 17:07:45'),
(46, '611504855792d62675911', NULL, NULL, 'Unused', 1, '2021-08-12 17:07:45', '2021-08-12 17:07:45'),
(47, '6115048558f4168984211', NULL, NULL, 'Unused', 1, '2021-08-12 17:07:45', '2021-08-12 17:07:45'),
(48, '611504855ae9737887171', NULL, NULL, 'Unused', 1, '2021-08-12 17:07:45', '2021-08-12 17:07:45'),
(49, '611504855ce9383037991', NULL, NULL, 'Unused', 1, '2021-08-12 17:07:45', '2021-08-12 17:07:45'),
(50, '6115049bdbcd113631710', '2021-08-12 18:03:05', 'js1234', 'used', 0, '2021-08-12 17:08:07', '2021-08-12 18:03:05'),
(51, '6115049bdd5055435080', NULL, NULL, 'Unused', 0, '2021-08-12 17:08:07', '2021-08-12 17:08:07'),
(52, '6115049bde7a842805810', NULL, NULL, 'Unused', 0, '2021-08-12 17:08:07', '2021-08-12 17:08:07'),
(53, '6115049bdfec643528880', NULL, NULL, 'Unused', 0, '2021-08-12 17:08:07', '2021-08-12 17:08:07'),
(54, '6115049be140631524380', NULL, NULL, 'Unused', 0, '2021-08-12 17:08:07', '2021-08-12 17:08:07'),
(55, '6115049be2e8722379720', NULL, NULL, 'Unused', 0, '2021-08-12 17:08:07', '2021-08-12 17:08:07'),
(56, '6115049be4a3e876680', NULL, NULL, 'Unused', 0, '2021-08-12 17:08:07', '2021-08-12 17:08:07'),
(57, '6115049be62fe13394270', '2021-08-12 18:28:23', 'js2622', 'used', 0, '2021-08-12 17:08:07', '2021-08-12 18:28:23'),
(58, '6115049be7b0c60379740', '2021-08-13 16:48:24', 'JS20210101', 'used', 0, '2021-08-12 17:08:07', '2021-08-13 16:48:24'),
(59, '6115049be91d817337420', '2021-08-12 17:34:56', 'JS165555', 'used', 0, '2021-08-12 17:08:07', '2021-08-12 17:34:56'),
(60, '61166f64d989630196560', NULL, NULL, 'Unused', 0, '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(61, '61166f64db0e831861740', NULL, NULL, 'Unused', 0, '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(62, '61166f64dc29518035930', NULL, NULL, 'Unused', 0, '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(63, '61166f64dd5e985299050', NULL, NULL, 'Unused', 0, '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(64, '61166f64debc761149670', NULL, NULL, 'Unused', 0, '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(65, '61166f64e01cb310950', NULL, NULL, 'Unused', 0, '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(66, '61166f64e163013654070', NULL, NULL, 'Unused', 0, '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(67, '61166f64e2a2a59957100', NULL, NULL, 'Unused', 0, '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(68, '61166f64e410c32460710', NULL, NULL, 'Unused', 0, '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(69, '61166f64e55d236420680', NULL, NULL, 'Unused', 0, '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(70, '61166f64e717380000060', NULL, NULL, 'Unused', 0, '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(71, '61166f64e861557322790', NULL, NULL, 'Unused', 0, '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(72, '61166f64e994026796560', NULL, NULL, 'Unused', 0, '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(73, '61166f64eb2db84096170', NULL, NULL, 'Unused', 0, '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(74, '61166f64ec8d815775000', NULL, NULL, 'Unused', 0, '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(75, '61166f64eeb2314367650', NULL, NULL, 'Unused', 0, '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(76, '61166f64f09ae50374850', NULL, NULL, 'Unused', 0, '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(77, '61166f64f225d91973690', NULL, NULL, 'Unused', 0, '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(78, '61166f64f361e53898910', NULL, NULL, 'Unused', 0, '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(79, '61166f65024e135856120', '2021-08-14 16:46:12', 'JS21083105', 'used', 0, '2021-08-13 18:56:01', '2021-08-14 16:46:12'),
(80, '61166f65037ae47463980', NULL, NULL, 'Unused', 0, '2021-08-13 18:56:01', '2021-08-13 18:56:01'),
(81, '61166f6504dc194778520', '2021-08-13 22:12:16', 'JS21087499', 'used', 0, '2021-08-13 18:56:01', '2021-08-13 22:12:16'),
(82, '61166f650782760616250', '2021-08-13 22:12:07', 'JS21087398', 'used', 0, '2021-08-13 18:56:01', '2021-08-13 22:12:07'),
(83, '61166f650ac0252836640', '2021-08-13 22:11:54', 'JS21084995', 'used', 0, '2021-08-13 18:56:01', '2021-08-13 22:11:54'),
(84, '61166f650c05227227500', '2021-08-13 19:04:11', 'JS21084693', 'used', 0, '2021-08-13 18:56:01', '2021-08-13 19:04:11'),
(85, '61166f650ddd413688970', '2021-08-13 19:05:06', 'JS21084294', 'used', 0, '2021-08-13 18:56:01', '2021-08-13 19:05:06'),
(86, '61166f650f2f545393110', '2021-08-13 20:17:51', 'JS21088996', 'used', 0, '2021-08-13 18:56:01', '2021-08-13 20:17:51'),
(87, '61166f6510e2a84713070', '2021-08-13 19:03:42', 'JS21083792', 'used', 0, '2021-08-13 18:56:01', '2021-08-13 19:03:42'),
(88, '61166f651260831639450', '2021-08-13 18:59:35', 'JS21083790', 'used', 0, '2021-08-13 18:56:01', '2021-08-13 18:59:35'),
(89, '61166f6513efd17881380', '2021-08-13 18:58:37', 'JS21084689', 'used', 0, '2021-08-13 18:56:01', '2021-08-13 18:58:37'),
(90, '61177d3a2fecf20051210', NULL, NULL, 'Unused', 0, '2021-08-14 14:07:18', '2021-08-14 14:07:18'),
(91, '61177d3a31d4281811350', NULL, NULL, 'Unused', 0, '2021-08-14 14:07:18', '2021-08-14 14:07:18'),
(92, '61177d3a3323794601280', NULL, NULL, 'Unused', 0, '2021-08-14 14:07:18', '2021-08-14 14:07:18'),
(93, '61177d3a3475a86925000', NULL, NULL, 'Unused', 0, '2021-08-14 14:07:18', '2021-08-14 14:07:18'),
(94, '61177d3a35ec294748340', '2021-08-14 14:07:51', 'JS21082100', 'used', 0, '2021-08-14 14:07:18', '2021-08-14 14:07:51'),
(95, '611782ad250b120970420', NULL, NULL, 'Unused', 0, '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(96, '611782ad26cb956760140', NULL, NULL, 'Unused', 0, '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(97, '611782ad27fcc36862830', NULL, NULL, 'Unused', 0, '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(98, '611782ad2988b21146760', NULL, NULL, 'Unused', 0, '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(99, '611782ad2ab5e95660070', NULL, NULL, 'Unused', 0, '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(100, '611782ad2c03215096210', NULL, NULL, 'Unused', 0, '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(101, '611782ad2d20946375730', NULL, NULL, 'Unused', 0, '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(102, '611782ad2f4f546080310', NULL, NULL, 'Unused', 0, '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(103, '611782ad30e9c31602690', NULL, NULL, 'Unused', 0, '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(104, '611782ad3285e38883490', NULL, NULL, 'Unused', 0, '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(105, '611782ad33e5822771320', NULL, NULL, 'Unused', 0, '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(106, '611782ad356d838190670', NULL, NULL, 'Unused', 0, '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(107, '611782ad3725e52078070', NULL, NULL, 'Unused', 0, '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(108, '611782ad3885717213570', NULL, NULL, 'Unused', 0, '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(109, '611782ad39e4d33727830', NULL, NULL, 'Unused', 0, '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(110, '611782ad3b0c945244450', NULL, NULL, 'Unused', 0, '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(111, '611782ad3c2ce47247360', NULL, NULL, 'Unused', 0, '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(112, '611782ad3d5cb46727220', NULL, NULL, 'Unused', 0, '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(113, '611782ad3e6e165375270', NULL, NULL, 'Unused', 0, '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(114, '611782ad3f7ae85950050', NULL, NULL, 'Unused', 0, '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(115, '611782ad408a34890', NULL, NULL, 'Unused', 0, '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(116, '611782ad419c286982140', NULL, NULL, 'Unused', 0, '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(117, '611782ad4329958287340', NULL, NULL, 'Unused', 0, '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(118, '611782ad4460825193210', '2021-08-14 14:32:02', 'JS21083101', 'used', 0, '2021-08-14 14:30:33', '2021-08-14 14:32:02'),
(119, '611782ad45bc947428420', NULL, NULL, 'Unused', 0, '2021-08-14 14:30:33', '2021-08-14 14:30:33');

-- --------------------------------------------------------

--
-- Table structure for table `epintransfers`
--

CREATE TABLE `epintransfers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `epin_id` int(11) NOT NULL,
  `transfer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiver` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `epintransfers`
--

INSERT INTO `epintransfers` (`id`, `epin_id`, `transfer`, `receiver`, `created_at`, `updated_at`) VALUES
(37, 35, 'Admin', 'Admin', '2021-08-12 14:34:30', '2021-08-12 14:34:30'),
(38, 36, 'Admin', 'Admin', '2021-08-12 14:34:30', '2021-08-12 14:34:30'),
(39, 37, 'Admin', 'Admin', '2021-08-12 14:34:30', '2021-08-12 14:34:30'),
(40, 38, 'Admin', 'Admin', '2021-08-12 14:34:30', '2021-08-12 14:34:30'),
(41, 39, 'Admin', 'Admin', '2021-08-12 14:34:30', '2021-08-12 14:34:30'),
(42, 40, 'Admin', 'js001', '2021-08-12 17:07:45', '2021-08-12 17:07:45'),
(43, 41, 'Admin', 'js001', '2021-08-12 17:07:45', '2021-08-12 17:07:45'),
(44, 42, 'Admin', 'js001', '2021-08-12 17:07:45', '2021-08-12 17:07:45'),
(45, 43, 'Admin', 'js001', '2021-08-12 17:07:45', '2021-08-12 17:07:45'),
(46, 44, 'Admin', 'js001', '2021-08-12 17:07:45', '2021-08-12 17:07:45'),
(47, 45, 'Admin', 'js001', '2021-08-12 17:07:45', '2021-08-12 17:07:45'),
(48, 46, 'Admin', 'js001', '2021-08-12 17:07:45', '2021-08-12 17:07:45'),
(49, 47, 'Admin', 'js001', '2021-08-12 17:07:45', '2021-08-12 17:07:45'),
(50, 48, 'Admin', 'js001', '2021-08-12 17:07:45', '2021-08-12 17:07:45'),
(51, 49, 'Admin', 'js001', '2021-08-12 17:07:45', '2021-08-12 17:07:45'),
(52, 50, 'Admin', 'js001', '2021-08-12 17:08:07', '2021-08-12 17:08:07'),
(53, 51, 'Admin', 'js001', '2021-08-12 17:08:07', '2021-08-12 17:08:07'),
(54, 52, 'Admin', 'js001', '2021-08-12 17:08:07', '2021-08-12 17:08:07'),
(55, 53, 'Admin', 'js001', '2021-08-12 17:08:07', '2021-08-12 17:08:07'),
(56, 54, 'Admin', 'js001', '2021-08-12 17:08:07', '2021-08-12 17:08:07'),
(57, 55, 'Admin', 'js001', '2021-08-12 17:08:07', '2021-08-12 17:08:07'),
(58, 56, 'Admin', 'js001', '2021-08-12 17:08:07', '2021-08-12 17:08:07'),
(59, 57, 'Admin', 'js001', '2021-08-12 17:08:07', '2021-08-12 17:08:07'),
(60, 58, 'Admin', 'js001', '2021-08-12 17:08:07', '2021-08-12 17:08:07'),
(61, 59, 'Admin', 'js001', '2021-08-12 17:08:07', '2021-08-12 17:08:07'),
(62, 60, 'Admin', 'js001', '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(63, 61, 'Admin', 'js001', '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(64, 62, 'Admin', 'js001', '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(65, 63, 'Admin', 'js001', '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(66, 64, 'Admin', 'js001', '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(67, 65, 'Admin', 'js001', '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(68, 66, 'Admin', 'js001', '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(69, 67, 'Admin', 'js001', '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(70, 68, 'Admin', 'js001', '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(71, 69, 'Admin', 'js001', '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(72, 70, 'Admin', 'js001', '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(73, 71, 'Admin', 'js001', '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(74, 72, 'Admin', 'js001', '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(75, 73, 'Admin', 'js001', '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(76, 74, 'Admin', 'js001', '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(77, 75, 'Admin', 'js001', '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(78, 76, 'Admin', 'js001', '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(79, 77, 'Admin', 'js001', '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(80, 78, 'Admin', 'js001', '2021-08-13 18:56:00', '2021-08-13 18:56:00'),
(81, 79, 'Admin', 'js001', '2021-08-13 18:56:01', '2021-08-13 18:56:01'),
(82, 80, 'Admin', 'js001', '2021-08-13 18:56:01', '2021-08-13 18:56:01'),
(83, 81, 'Admin', 'js001', '2021-08-13 18:56:01', '2021-08-13 18:56:01'),
(84, 82, 'Admin', 'js001', '2021-08-13 18:56:01', '2021-08-13 18:56:01'),
(85, 83, 'Admin', 'js001', '2021-08-13 18:56:01', '2021-08-13 18:56:01'),
(86, 84, 'Admin', 'js001', '2021-08-13 18:56:01', '2021-08-13 18:56:01'),
(87, 85, 'Admin', 'js001', '2021-08-13 18:56:01', '2021-08-13 18:56:01'),
(88, 86, 'Admin', 'js001', '2021-08-13 18:56:01', '2021-08-13 18:56:01'),
(89, 87, 'Admin', 'js001', '2021-08-13 18:56:01', '2021-08-13 18:56:01'),
(90, 88, 'Admin', 'js001', '2021-08-13 18:56:01', '2021-08-13 18:56:01'),
(91, 89, 'Admin', 'js001', '2021-08-13 18:56:01', '2021-08-13 18:56:01'),
(92, 90, 'Admin', 'admin', '2021-08-14 14:07:18', '2021-08-14 14:07:18'),
(93, 91, 'Admin', 'admin', '2021-08-14 14:07:18', '2021-08-14 14:07:18'),
(94, 92, 'Admin', 'admin', '2021-08-14 14:07:18', '2021-08-14 14:07:18'),
(95, 93, 'Admin', 'admin', '2021-08-14 14:07:18', '2021-08-14 14:07:18'),
(96, 94, 'Admin', 'admin', '2021-08-14 14:07:18', '2021-08-14 14:07:18'),
(97, 80, 'js001', 'Js20210101', '2021-08-14 14:13:01', '2021-08-14 14:13:01'),
(98, 79, 'js001', 'Js20210101', '2021-08-14 14:13:01', '2021-08-14 14:13:01'),
(99, 78, 'js001', 'Js20210101', '2021-08-14 14:13:01', '2021-08-14 14:13:01'),
(100, 77, 'js001', 'Js20210101', '2021-08-14 14:13:01', '2021-08-14 14:13:01'),
(101, 76, 'js001', 'Js20210101', '2021-08-14 14:13:01', '2021-08-14 14:13:01'),
(102, 76, 'JS20210101', 'Admin', '2021-08-14 14:28:18', '2021-08-14 14:28:18'),
(103, 77, 'JS20210101', 'Admin', '2021-08-14 14:28:18', '2021-08-14 14:28:18'),
(104, 78, 'JS20210101', 'Admin', '2021-08-14 14:28:18', '2021-08-14 14:28:18'),
(105, 79, 'JS20210101', 'Admin', '2021-08-14 14:28:18', '2021-08-14 14:28:18'),
(106, 80, 'JS20210101', 'Admin', '2021-08-14 14:28:18', '2021-08-14 14:28:18'),
(107, 95, 'Admin', 'JS20210101', '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(108, 96, 'Admin', 'JS20210101', '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(109, 97, 'Admin', 'JS20210101', '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(110, 98, 'Admin', 'JS20210101', '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(111, 99, 'Admin', 'JS20210101', '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(112, 100, 'Admin', 'JS20210101', '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(113, 101, 'Admin', 'JS20210101', '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(114, 102, 'Admin', 'JS20210101', '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(115, 103, 'Admin', 'JS20210101', '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(116, 104, 'Admin', 'JS20210101', '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(117, 105, 'Admin', 'JS20210101', '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(118, 106, 'Admin', 'JS20210101', '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(119, 107, 'Admin', 'JS20210101', '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(120, 108, 'Admin', 'JS20210101', '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(121, 109, 'Admin', 'JS20210101', '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(122, 110, 'Admin', 'JS20210101', '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(123, 111, 'Admin', 'JS20210101', '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(124, 112, 'Admin', 'JS20210101', '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(125, 113, 'Admin', 'JS20210101', '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(126, 114, 'Admin', 'JS20210101', '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(127, 115, 'Admin', 'JS20210101', '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(128, 116, 'Admin', 'JS20210101', '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(129, 117, 'Admin', 'JS20210101', '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(130, 118, 'Admin', 'JS20210101', '2021-08-14 14:30:33', '2021-08-14 14:30:33'),
(131, 119, 'Admin', 'JS20210101', '2021-08-14 14:30:33', '2021-08-14 14:30:33');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kycs`
--

CREATE TABLE `kycs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adhar_card_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ifsc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pan_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_pay_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_pay_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adhar_back` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adhar_front` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bankproof` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pancopy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kycs`
--

INSERT INTO `kycs` (`id`, `user_id`, `name`, `Bank_name`, `account_no`, `adhar_card_no`, `ifsc`, `pan_no`, `google_pay_id`, `phone_pay_id`, `adhar_back`, `adhar_front`, `bankproof`, `pancopy`, `status`, `created_at`, `updated_at`) VALUES
(3, '57', 'Ashok Mehta', 'Siddhartha', NULL, NULL, NULL, NULL, NULL, NULL, 'upload/kyc/1626488684kyc.png', 'upload/kyc/1988593537kyc.png', 'upload/kyc/492595371kyc.png', 'upload/kyc/2122927966kyc.png', 0, '2021-08-13 13:41:47', '2021-08-13 13:43:56');

-- --------------------------------------------------------

--
-- Table structure for table `levelearnings`
--

CREATE TABLE `levelearnings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `l1` int(11) DEFAULT NULL,
  `l2` int(11) DEFAULT NULL,
  `l3` int(11) DEFAULT NULL,
  `l4` int(11) DEFAULT NULL,
  `l5` int(11) DEFAULT NULL,
  `l6` int(11) DEFAULT NULL,
  `l7` int(11) DEFAULT NULL,
  `l8` int(11) DEFAULT NULL,
  `l9` int(11) DEFAULT NULL,
  `l10` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `levelearnings`
--

INSERT INTO `levelearnings` (`id`, `user_id`, `l1`, `l2`, `l3`, `l4`, `l5`, `l6`, `l7`, `l8`, `l9`, `l10`, `created_at`, `updated_at`) VALUES
(18, '57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-12 14:35:16', '2021-08-12 14:35:16'),
(19, '64', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-12 17:14:21', '2021-08-12 17:14:21'),
(20, '63', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-12 17:31:15', '2021-08-12 17:31:15'),
(21, '65', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-12 17:34:56', '2021-08-12 17:34:56'),
(22, '66', 100, 50, 25, 20, 10, 5, 5, 5, 5, 5, '2021-08-12 18:03:05', '2021-08-12 18:03:05'),
(23, '67', 200, 100, 50, 25, 20, 15, 10, 5, 5, 5, '2021-08-12 18:04:08', '2021-08-12 18:04:08'),
(24, '68', 200, 100, 50, 25, 20, 15, 10, 5, 5, 5, '2021-08-12 18:26:41', '2021-08-12 18:26:41'),
(25, '69', 100, 50, 25, 20, 10, 5, 5, 5, 5, 5, '2021-08-12 18:28:23', '2021-08-12 18:28:23'),
(26, '71', 175, 70, 30, 10, 10, 5, 5, 5, 5, 5, '2021-08-13 16:48:24', '2021-08-13 16:48:24'),
(27, '89', 175, 70, 30, 10, 10, 5, 5, 5, 5, 5, '2021-08-13 18:58:37', '2021-08-13 18:58:37'),
(28, '90', 175, 70, 30, 10, 10, 5, 5, 5, 5, 5, '2021-08-13 18:59:35', '2021-08-13 18:59:35'),
(29, '92', 175, 70, 30, 10, 10, 5, 5, 5, 5, 5, '2021-08-13 19:03:42', '2021-08-13 19:03:42'),
(30, '93', 175, 70, 30, 10, 10, 5, 5, 5, 5, 5, '2021-08-13 19:04:11', '2021-08-13 19:04:11'),
(31, '94', 175, 70, 30, 10, 10, 5, 5, 5, 5, 5, '2021-08-13 19:05:06', '2021-08-13 19:05:06'),
(32, '96', 175, 70, 30, 10, 10, 5, 5, 5, 5, 5, '2021-08-13 20:17:51', '2021-08-13 20:17:51'),
(33, '97', 175, 70, 30, 10, 10, 5, 5, 5, 5, 5, '2021-08-13 22:11:54', '2021-08-13 22:11:54'),
(34, '98', 175, 70, 30, 10, 10, 5, 5, 5, 5, 5, '2021-08-13 22:12:07', '2021-08-13 22:12:07'),
(35, '99', 175, 70, 30, 10, 10, 5, 5, 5, 5, 5, '2021-08-13 22:12:16', '2021-08-13 22:12:16'),
(36, '100', 175, 70, 30, 10, 10, 5, 5, 5, 5, 5, '2021-08-14 14:07:51', '2021-08-14 14:07:51'),
(37, '101', 175, 70, 30, 10, 10, 5, 5, 5, 5, 5, '2021-08-14 14:32:02', '2021-08-14 14:32:02'),
(38, '105', 175, 70, 30, 10, 10, 5, 5, 5, 5, 5, '2021-08-14 16:46:12', '2021-08-14 16:46:12');

-- --------------------------------------------------------

--
-- Table structure for table `levelprices`
--

CREATE TABLE `levelprices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `level` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `package` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `levelprices`
--

INSERT INTO `levelprices` (`id`, `level`, `price`, `package`, `created_at`, `updated_at`) VALUES
(1, 1, 200, 1, NULL, '2021-08-05 10:09:27'),
(2, 2, 70, 1, NULL, '2021-08-13 15:53:53'),
(3, 3, 30, 1, NULL, '2021-08-13 15:48:00'),
(4, 4, 10, 1, NULL, '2021-08-13 15:48:58'),
(5, 5, 10, 1, NULL, '2021-08-13 15:49:06'),
(6, 6, 5, 1, NULL, '2021-08-13 15:49:15'),
(7, 7, 5, 1, NULL, '2021-08-13 15:49:26'),
(8, 8, 5, 1, NULL, NULL),
(9, 9, 5, 1, NULL, NULL),
(10, 10, 5, 1, NULL, NULL),
(11, 1, 175, 0, NULL, '2021-08-13 15:49:47'),
(12, 2, 70, 0, NULL, '2021-08-13 15:50:05'),
(13, 3, 30, 0, NULL, '2021-08-13 15:50:19'),
(14, 4, 10, 0, NULL, '2021-08-13 15:50:39'),
(15, 5, 10, 0, NULL, NULL),
(16, 6, 5, 0, NULL, NULL),
(17, 7, 5, 0, NULL, NULL),
(18, 8, 5, 0, NULL, NULL),
(19, 9, 5, 0, NULL, NULL),
(20, 10, 5, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `l1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `l2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `l3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `l4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `l5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `l6` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `l7` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `l8` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `l9` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `l10` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `l11` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `l12` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `l13` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `l14` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `l15` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `user_id`, `l1`, `l2`, `l3`, `l4`, `l5`, `l6`, `l7`, `l8`, `l9`, `l10`, `l11`, `l12`, `l13`, `l14`, `l15`, `created_at`, `updated_at`) VALUES
(64, 70, 'js001', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(65, 71, 'JS20210001', 'JS001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-13 16:10:52', '2021-08-13 16:10:52'),
(66, 72, 'JS20210101', 'JS20210001', 'JS001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-13 16:13:48', '2021-08-13 16:13:48'),
(67, 73, 'JS20210102', 'JS20210101', 'JS20210001', 'JS001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-13 16:26:22', '2021-08-13 16:26:22'),
(69, 76, 'JS20219897', 'JS20210102', 'JS20210101', 'JS20210001', 'JS001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-13 17:01:46', '2021-08-13 17:01:46'),
(81, 88, 'JS99245976', 'JS20219897', 'JS20210102', 'JS20210101', 'JS20210001', 'JS001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-13 17:56:03', '2021-08-13 17:56:03'),
(82, 89, 'JS21089380', 'JS99245976', 'JS20219897', 'JS20210102', 'JS20210101', 'JS20210001', 'JS001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-13 18:11:03', '2021-08-13 18:11:03'),
(83, 90, 'JS21084689', 'JS21089380', 'JS99245976', 'JS20219897', 'JS20210102', 'JS20210101', 'JS20210001', 'JS001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-13 18:17:55', '2021-08-13 18:17:55'),
(84, 91, 'JS21083790', 'JS21084689', 'JS21089380', 'JS99245976', 'JS20219897', 'JS20210102', 'JS20210101', 'JS20210001', 'JS001', NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-13 18:23:18', '2021-08-13 18:23:18'),
(85, 92, 'JS21081291', 'JS21083790', 'JS21084689', 'JS21089380', 'JS99245976', 'JS20219897', 'JS20210102', 'JS20210101', 'JS20210001', 'JS001', NULL, NULL, NULL, NULL, NULL, '2021-08-13 18:26:46', '2021-08-13 18:26:46'),
(86, 93, 'JS21083792', 'JS21081291', 'JS21083790', 'JS21084689', 'JS21089380', 'JS99245976', 'JS20219897', 'JS20210102', 'JS20210101', 'JS20210001', 'JS001', NULL, NULL, NULL, NULL, '2021-08-13 18:31:35', '2021-08-13 18:31:35'),
(87, 94, 'JS21084693', 'JS21083792', 'JS21081291', 'JS21083790', 'JS21084689', 'JS21089380', 'JS99245976', 'JS20219897', 'JS20210102', 'JS20210101', 'JS20210001', 'JS001', NULL, NULL, NULL, '2021-08-13 18:39:05', '2021-08-13 18:39:05'),
(90, 97, 'JS21084294', 'JS21084693', 'JS21083792', 'JS21081291', 'JS21083790', 'JS21084689', 'JS21089380', 'JS99245976', 'JS20219897', 'JS20210102', 'JS20210101', 'JS20210001', 'JS001', NULL, NULL, '2021-08-13 22:02:37', '2021-08-13 22:02:37'),
(91, 98, 'JS21084995', 'JS21084294', 'JS21084693', 'JS21083792', 'JS21081291', 'JS21083790', 'JS21084689', 'JS21089380', 'JS99245976', 'JS20219897', 'JS20210102', 'JS20210101', 'JS20210001', 'JS001', NULL, '2021-08-13 22:05:12', '2021-08-13 22:05:12'),
(92, 99, 'JS21087398', 'JS21084995', 'JS21084294', 'JS21084693', 'JS21083792', 'JS21081291', 'JS21083790', 'JS21084689', 'JS21089380', 'JS99245976', 'JS20219897', 'JS20210102', 'JS20210101', 'JS20210001', 'JS001', '2021-08-13 22:08:26', '2021-08-13 22:08:26'),
(93, 100, 'JS21087499', 'JS21087398', 'JS21084995', 'JS21084294', 'JS21084693', 'JS21083792', 'JS21081291', 'JS21083790', 'JS21084689', 'JS21089380', 'JS99245976', 'JS20219897', 'JS20210102', 'JS20210101', 'JS20210001', '2021-08-13 22:56:20', '2021-08-13 22:56:20'),
(94, 101, 'JS21082100', 'JS21087499', 'JS21087398', 'JS21084995', 'JS21084294', 'JS21084693', 'JS21083792', 'JS21081291', 'JS21083790', 'JS21084689', 'JS21089380', 'JS99245976', 'JS20219897', 'JS20210102', 'JS20210101', '2021-08-14 14:03:07', '2021-08-14 14:03:07'),
(95, 102, 'JS21083101', 'JS21082100', 'JS21087499', 'JS21087398', 'JS21084995', 'JS21084294', 'JS21084693', 'JS21083792', 'JS21081291', 'JS21083790', 'JS21084689', 'JS21089380', 'JS99245976', 'JS20219897', 'JS20210102', '2021-08-14 14:28:40', '2021-08-14 14:28:40'),
(96, 103, 'JS21083101', 'JS21082100', 'JS21087499', 'JS21087398', 'JS21084995', 'JS21084294', 'JS21084693', 'JS21083792', 'JS21081291', 'JS21083790', 'JS21084689', 'JS21089380', 'JS99245976', 'JS20219897', 'JS20210102', '2021-08-14 14:48:53', '2021-08-14 14:48:53'),
(97, 104, 'JS21083101', 'JS21082100', 'JS21087499', 'JS21087398', 'JS21084995', 'JS21084294', 'JS21084693', 'JS21083792', 'JS21081291', 'JS21083790', 'JS21084689', 'JS21089380', 'JS99245976', 'JS20219897', 'JS20210102', '2021-08-14 14:55:46', '2021-08-14 14:55:46'),
(98, 105, 'JS20210101', 'JS20210001', 'JS001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-14 16:38:04', '2021-08-14 16:38:04');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(18, '2014_10_12_000000_create_users_table', 1),
(19, '2014_10_12_100000_create_password_resets_table', 1),
(20, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(21, '2019_08_19_000000_create_failed_jobs_table', 1),
(22, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(23, '2021_05_11_233951_create_sessions_table', 1),
(24, '2021_05_12_005932_create_admins_table', 1),
(27, '2021_07_31_192840_create_epins_table', 2),
(28, '2021_07_31_203530_create_tickets_table', 3),
(29, '2021_07_31_133559_create_levels_table', 4),
(31, '2021_07_31_164256_create_kycs_table', 5),
(33, '2021_08_02_080715_create_epintransfers_table', 7),
(34, '2021_08_02_120703_create_levelearnings_table', 8),
(35, '2021_08_03_175809_create_deposites_table', 9),
(36, '2021_08_03_181240_create_remarks_table', 9),
(38, '2021_08_03_203521_create_withdrawals_table', 10),
(39, '2021_08_01_161623_create_levelprices_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `remarks`
--

CREATE TABLE `remarks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deposite_id` int(11) NOT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentor` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0H6QixyDz6QE7cqenBGQqnRoYn0pwHldQ6SRFuMI', 57, '36.252.91.217', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.131 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSlhMbmZlc2M1VjdZU0daWklySUx1Tjc4bmF4RXJYV3pkdmRrWGhQSiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHBzOi8vamFqYmFzaG9wLmluL21lbWJlci9sZXZlbCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjU3O3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTIkdzFOUnZaLjN1UzV3SnBHR3ZQck1yT3ZKZjFXY1RDMXBkc1QwN0RJa0VucldNakVlcm1yQm0iO30=', 1628940632),
('a7WTGMYs5SBbgdK61yZUlNrZ3lsUGokRxDHnThaY', NULL, '49.44.84.104', 'Mozilla/5.0 (Linux; Android 11; SM-M315F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.120 Mobile Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicFdDVzlOVEZhcVVuMWM0b0N2MmRENDZBNThXa3d1RTlRVGl1SWxTTyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNzoiaHR0cHM6Ly9qYWpiYXNob3AuaW4vbWVtYmVyL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI2OiJodHRwczovL2phamJhc2hvcC5pbi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1628940398),
('bfrfQlqJTyOaNpRXZ1LbZRIQ9mrmCZKhwUSNWBkh', NULL, '49.44.122.10', 'Mozilla/5.0 (Linux; Android 8.1.0; vivo 1820 Build/O11019; wv) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.84 Mobile Safari/537.36 VivoBrowser/6.9.10.2', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibGx2SURRMlM2d3p0MmFkeXB1MjdaMmxBemptdXBaaXJpMllxMG5oNiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cHM6Ly9qYWpiYXNob3AuaW4vbWVtYmVyL2FsbCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI2OiJodHRwczovL2phamJhc2hvcC5pbi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1628940416),
('Fi0fLOH3sRDoQmkHWwvjYB4V4iNh0j0QUjLKRz7c', NULL, '157.42.91.223', 'Mozilla/5.0 (Linux; Android 9; RMX1833) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.81 Mobile Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiMlRrRmpKSHRvVXJJc3RRMWxpRDRZWEVFWFFJVG1Ub1FpbFF1dGxkVyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1628938691),
('hAeyDJpXqsrSSHBtoYLBR8qPZFi10xjN0lD2zQJK', NULL, '157.42.91.223', 'Mozilla/5.0 (Linux; Android 9; RMX1833) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.81 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZzI5aEc0dTFBYlIwYjdscXRsU0U3eVdXVzBXSW9rTEFsSjJyWmh5SSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9qYWpiYXNob3AuaW4vYWRtaW4vbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1628938675),
('jFtBZvACY8RwnckUqKySMJyqKyQ4cnC5bkOPLOm7', 101, '223.228.249.164', 'Mozilla/5.0 (Linux; Android 7.1.2; Redmi 5A) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.91 Mobile Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSGhOVU9VM0lXZ2dvZkIzaDF3NlhCeUY0eDgxWDRaWDVFNWExcDBGNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHBzOi8vamFqYmFzaG9wLmluIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTAxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTAkSWdwQkRtVGRaajY5R3g5dmg3MkxKLjFYbXhEVFlQWXM0NXRBMndFbW1NSDhFRzJ6UGx6cEsiO30=', 1628940413),
('nCCLuzGkKmJudZPuOGFo5Ei0RUYssWVJa75UKL1n', NULL, '157.35.86.198', 'Mozilla/5.0 (Linux; Android 10; SM-A705FN) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.181 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTTZHQmV2eUdpdEp3V0tjRzhjb3EzSkYyTVRLaHhRV2NRQ2dUMG1kbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHBzOi8vamFqYmFzaG9wLmluIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1628939894),
('NoQRgiZ2vOBfM23lVUvgPPWJroc71Ppoz7Is8vyx', NULL, '45.131.193.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN0FOMFNPSEV6ZUZtN3hDaFpwTHBNMktqRE10VGd5bVpzaEV5QmRuNCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHBzOi8vamFqYmFzaG9wLmluIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1628939920),
('qB1ZukGxKkcmlythYWR84wpR9BxB3aHaoLuuOF0t', 57, '157.42.91.223', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.81 Safari/537.36', 'YTo2OntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im5ldyI7YTowOnt9czozOiJvbGQiO2E6MDp7fX1zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0MDoiaHR0cHM6Ly9qYWpiYXNob3AuaW4vbWVtYmVyL2xldmVsL3Nob3cvMSI7fXM6NjoiX3Rva2VuIjtzOjQwOiJBUHFtd3lLSTRRRVdIckNyeGZaQm4wYmxlM3FlRDA3T0wxS2duTnB1IjtzOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjQxOiJodHRwczovL2phamJhc2hvcC5pbi9tZW1iZXIvZXBpbi90cmFuc2ZlciI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjU3O3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTIkdzFOUnZaLjN1UzV3SnBHR3ZQck1yT3ZKZjFXY1RDMXBkc1QwN0RJa0VucldNakVlcm1yQm0iO30=', 1628940700),
('RYbgitaQENZzWyxQhysuYdjkcOH45NE9LDMFEuEE', NULL, '157.42.91.223', 'Mozilla/5.0 (Linux; Android 9; RMX1833) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.81 Mobile Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiQkRYTU5oT0IycWpQbXBWWnFGR0x6d3dDdDR4MlFuWFhDNWxub2F2cyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1628938697),
('SIvamzqSxtjJE7PdKGtzGceYbSo1gW8sPneWBVPw', 71, '157.35.87.7', 'Mozilla/5.0 (Linux; Android 10; SAMSUNG SM-A705FN) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/14.2 Chrome/87.0.4280.141 Mobile Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiMXpKcjYzTGlJNHBPSzc5dTVVYWw4RXNWa0pqbk5PUFE2REZMMENOMCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cHM6Ly9qYWpiYXNob3AuaW4vbWVtYmVyL2luYWN0aXZlIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHBzOi8vamFqYmFzaG9wLmluL21lbWJlci9lcGluL3VudXNlZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjcxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTAka2pqemU3b0U4UG96SFFiaHBzdG9FLlNXbDJ4MzdSVzZGYmhLMDgzMzlXN0hFMkFheC9aOEsiO30=', 1628940638),
('wp98YhUnU9UlPOVtYWlcPMuGwlOiODAiBKqdrSqG', NULL, '157.42.91.223', 'Mozilla/5.0 (Linux; Android 9; RMX1833) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.81 Mobile Safari/537.36', 'YTozOntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im5ldyI7YTowOnt9czozOiJvbGQiO2E6MDp7fX1zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMjoiaHR0cHM6Ly9qYWpiYXNob3AuaW4vYWRtaW4vbG9naW4iO31zOjY6Il90b2tlbiI7czo0MDoiM2U0cnZtNVl2Y01hUldndW9EMVZYMXJsYkhUUnQ4cFFwRGV5MWxSdyI7fQ==', 1628938973);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `qty` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `user_id`, `title`, `status`, `qty`, `created_at`, `updated_at`) VALUES
(3, 'JS20210101', 'For E-pin Transferjs20210101', '1', 10, '2021-08-14 14:08:20', '2021-08-14 14:08:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sponsor_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adhar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package` int(11) DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userid`, `name`, `email`, `sponsor_id`, `phone`, `adhar`, `email_verified_at`, `password`, `status`, `package`, `state`, `district`, `city`, `address`, `pincode`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(57, 'js001', 'abc', 'abc@gmail.com', NULL, '777', '123456789012', NULL, '$2y$12$w1NRvZ.3uS5wJpGGvPrMrOvJf1WcTC1pdsT07DIkEnrWMjEermrBm', '6114e09a2c45080294831', 1, 'Pardesh-1', 'sunsari', 'Biratnagar', 'Dewanjung,sunsari', '2046', NULL, NULL, NULL, NULL, 'upload/admin/889533173admin.png', NULL, '2021-08-13 13:49:11'),
(70, 'JS20210001', 'A1', 'A1@GMAIL', 'JS001', '1111111111', NULL, NULL, '$2y$10$.S4lzcqKcWwI7Fn836wLde0IYq7tuN0EHzSbDaYPUsqjues/5mgHG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-13 16:05:54', '2021-08-13 16:05:54'),
(71, 'JS20210101', 'NAGESHWAR PRASAD MEHTA', 'dpmehta8969@gmail.com', 'JS20210001', '9334402576', NULL, NULL, '$2y$10$kjjze7oE8PozHQbhpstoE.SWl2x37RW6FbhK08339W7HE2Aax/Z8K', '6115049be7b0c60379740', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-13 16:10:52', '2021-08-13 21:06:07'),
(72, 'JS20210102', 'A2', 'A2@GMAIL', 'JS20210101', '1111111111', NULL, NULL, '$2y$10$9jY5L2TeUsjbM.FAln/hO.gRpJdmIwFuiwp757SAFgis8o.sviewW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-13 16:13:48', '2021-08-13 16:13:48'),
(73, 'JS20219897', 'RANJEET KUMAR PASWAN', 'R@GMAIL', 'JS20210102', '9939083833', NULL, NULL, '$2y$10$xtDUoNu1igJSWB7iPpHV/..cTmwa4YAIGzv6yC0TtPVLcsclGuT7W', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-13 16:26:22', '2021-08-13 16:26:22'),
(76, 'JS99245976', 'PRABHU PASWAN', 'PR@GMAIL', 'JS20219897', '9262970450', NULL, NULL, '$2y$10$YZlUPXTiZuVsfZ9Ti4VzgeDmpOnwRl/ZDRvUefN6ZvhjEYnYvXVbC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-13 17:01:46', '2021-08-13 17:01:46'),
(77, 'JS20213977', 'Ashok Mehta', 'ooashokmehta123y@gmail.com', 'js001', '9813519397', '123456789012', NULL, '$2y$10$c.oESyoDDCcwncf2g6oUAu3dWnpi2TMEiPkMZyMot1vZfpw2Qyase', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-13 17:07:56', '2021-08-13 17:07:56'),
(78, 'JS20219878', 'Ashok Mehta', 'ooashjjokmehta123y@gmail.com', 'js001', '9813519397', '123456789012', NULL, '$2y$10$xkVcUF3fRFwIo3.zXXUc5epbhb4GGMa9MYXE3St9RNZn/I4TfSMOy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-13 17:08:13', '2021-08-13 17:08:13'),
(79, 'JS20219379', 'SUNDAR PASWAAN', 'SUND@123', 'JS99245976', '8945612356', NULL, NULL, '$2y$10$PGP6kkNOYkG0PLc0MzkijObyzeQ9JDiOaCCeqzzGv6vxq/lLVEUfe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-13 17:08:23', '2021-08-13 17:08:23'),
(88, 'JS21089380', 'sundar', 'sd@dg', 'JS99245976', '5555555555', NULL, NULL, '$2y$10$kDrrxJh/2jboxeoaJxFs.u8k8OVmUWQUSa5n5n/xBqzEnGCsNC5j6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-13 17:56:03', '2021-08-13 21:04:29'),
(89, 'JS21084689', 'Suman paswan', 'afs@re', 'JS21089380', '8757589351', '458196948096', NULL, '$2y$10$Hf4nuD5VN.yVARrpuejiZuwx1E5aawpvoHuBlbdI6ZD8sqnsqTqGO', '61166f6513efd17881380', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-13 18:11:03', '2021-08-13 21:03:27'),
(90, 'JS21083790', 'Rajesh ranjan', 'ranjanrajesh438@gmail.com', 'JS21084689', '7250407677', '322717911048', NULL, '$2y$10$jN/pDfUzPc2AulFSr9G/nOAXTn1yGaYnSrX0Q9BhvSjtQlA2JzfQC', '61166f651260831639450', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-13 18:17:55', '2021-08-13 21:01:54'),
(91, 'JS21081291', 'Umesh kumar', 'umeshkumar993956@gmail.com', 'JS21083790', '9939569510', NULL, NULL, '$2y$10$VNWLvx6OZbpPcyjKQ83hIORmBT61qXzc1qsK1P/ZypdResGrrjcCO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-13 18:23:18', '2021-08-13 18:23:18'),
(92, 'JS21083792', 'Akhilesh kumar', 'akhileshkumar875736@gmail.com', 'JS21081291', '8757360092', NULL, NULL, '$2y$10$3uT2Q5tfTD5e.V9jPZxoueRviMjPz9nSxG.fLhUrb7JLw0EBI3Oy2', '61166f6510e2a84713070', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-13 18:26:46', '2021-08-13 20:58:08'),
(93, 'JS21084693', 'Pankaj kumar', 'pk0285534@gmail.com', 'JS21083792', '9162071151', '987436276073', NULL, '$2y$10$8DtEJXLn.j2WvrcGXeU0lOHC.4IO5SmqLtIvsNq4QCHqh31GL.8w.', '61166f650c05227227500', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-13 18:31:35', '2021-08-13 20:57:38'),
(94, 'JS21084294', 'Manoj yadav', 'kumarsaurabh62070@gmail.com', 'JS21084693', '7549920996', NULL, NULL, '$2y$10$HFfOPAA3VPIEwVYLoM7MoOz8SNQxZzuiJs/tiA14waPyYDs2oovUS', '61166f650ddd413688970', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-13 18:39:05', '2021-08-13 20:47:54'),
(97, 'JS21084995', 'Ranju devi', 'fg@gg', 'JS21084294', '6207054714', '578568461382', NULL, '$2y$10$YU2ZeF4OVNhcf2nqVulRw.Cj3vV/LdyTMtPO1VQF3D8jMncdhmAWW', '61166f650ac0252836640', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-13 22:02:37', '2021-08-13 22:11:54'),
(98, 'JS21087398', 'Mukesh kumar madhukar', 'fey@ty', 'JS21084995', '6299653927', NULL, NULL, '$2y$10$fNQEdvQ9wMx2Zkg1Dw.uJePSkh0SaDVvuJDciTa0P4Jt20lBEqIEG', '61166f650782760616250', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-13 22:05:12', '2021-08-13 22:12:07'),
(99, 'JS21087499', 'Rekha kumari', 'rekhakumarik393@gmail.com', 'JS21087398', '7808454477', NULL, NULL, '$2y$10$U4hGvj/c13mxg4.jwBj.a.qCJki.wSx2eiTRpPVZDes1ywJ7Vn1gm', '61166f6504dc194778520', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-13 22:08:26', '2021-08-13 22:12:16'),
(100, 'JS21082100', 'Ashok kumar', 'ak465097@gmail.com', 'JS21087499', '8252301321', '797867588449', NULL, '$2y$10$Jv/mLdbkQloOO9bhvRR53.D5jRpdIuAYTZ4D/1EErze/.9Q.IcEvu', '61177d3a35ec294748340', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-13 22:56:20', '2021-08-14 14:07:51'),
(101, 'JS21083101', 'Nitu kumari', 'nitu886322@gmail.com', 'JS21082100', '7667358775', '477371594513', NULL, '$2y$10$IgpBDmTdZj69Gx9vh72LJ.1XmxDTYPYs45tA2wEmmMH8EG2zPlzpK', '611782ad4460825193210', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-14 14:03:07', '2021-08-14 14:32:02'),
(102, 'JS21082102', 'Mantu rishi', 'mantu123@gmail.com', 'JS21083101', '8797330689', '214538745083', NULL, '$2y$10$BcFWJkvwV14bAAQjGoCTG.BQ3w9jBzNCugctbgMRNJgEYC0xobGCC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-14 14:28:40', '2021-08-14 14:28:40'),
(103, 'JS21086103', 'Mano rishi', 'manorishidev9973@gmail.com', 'JS21083101', '9973766852', '690466025343', NULL, '$2y$10$fAEX6NEwK5kxSv/hrOBLDuL0gm6BOq38dchrGrod/bWtqX94RCEAi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-14 14:48:53', '2021-08-14 14:48:53'),
(104, 'JS21086104', 'Ajay kumar', 'ajaykumarbarati8757@gmail.com', 'JS21083101', '8235734071', '409763583323', NULL, '$2y$10$SE841mbrd6Zcmiw3e.GR..LDQbh2tDjQtKSK7e117zHdnkBrOzegW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-14 14:55:46', '2021-08-14 14:55:46'),
(105, 'JS21083105', 'Bb', 'kumarsanu1995.sk@gmail.com', 'JS20210101', '8988888888', NULL, NULL, '$2y$10$foQ53Sfkx.JBSivC1WmBAekvp3sucSsum.d5XWnh4xx0a1Co9MJAS', '61166f65024e135856120', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-14 16:38:04', '2021-08-14 16:46:12');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `paying_amount` double(8,2) NOT NULL,
  `user_remark` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_remark` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Indexes for table `deposites`
--
ALTER TABLE `deposites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `epins`
--
ALTER TABLE `epins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `epintransfers`
--
ALTER TABLE `epintransfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kycs`
--
ALTER TABLE `kycs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `levelearnings`
--
ALTER TABLE `levelearnings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `levelprices`
--
ALTER TABLE `levelprices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `remarks`
--
ALTER TABLE `remarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deposites`
--
ALTER TABLE `deposites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `epins`
--
ALTER TABLE `epins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `epintransfers`
--
ALTER TABLE `epintransfers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kycs`
--
ALTER TABLE `kycs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `levelearnings`
--
ALTER TABLE `levelearnings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `levelprices`
--
ALTER TABLE `levelprices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `remarks`
--
ALTER TABLE `remarks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

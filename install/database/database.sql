-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2022 at 07:14 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `genius_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_processes`
--

CREATE TABLE `account_processes` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_processes`
--

INSERT INTO `account_processes` (`id`, `title`, `details`, `created_at`, `updated_at`) VALUES
(1, 'All Done', 'It is a secure way to authenticate whether the customer who is making an online purchase is the rightful owner of the debit card being used.', '2022-02-21 04:29:32', '2022-03-14 23:03:39'),
(2, 'Pay For Your Transfer', 'It is a secure way to authenticate whether the customer who is making an online purchase is the rightful owner of the debit card being used.', '2022-02-21 04:29:57', '2022-03-14 23:03:29'),
(3, 'Set Up A Transfer', 'It is a secure way to authenticate whether the customer who is making an online purchase is the rightful owner of the debit card being used.', '2022-02-21 04:30:19', '2022-03-14 23:03:18'),
(4, 'Tell Us About Your Business', 'It is a secure way to authenticate whether the customer who is making an online purchase is the rightful owner of the debit card being used.', '2022-02-21 04:30:39', '2022-03-14 23:03:07'),
(5, 'Register in Minutes', 'You can register this system within a few minutes. Go to Register page for registration.', '2022-02-21 04:30:56', '2022-03-14 23:02:14');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` tinyint(4) NOT NULL DEFAULT 0,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `phone`, `role_id`, `photo`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '01629552892', 0, '1639300861admin.jpg', '$2y$10$NSxBfIBeDdxRjisT83p/0uN4GN4LcbYvKzuazAfyekwPffExwBUpO', 1, 'nL2JkhiOxuTHj3UXgkaULKuDTC7e292XrNTeSkn8gjnulpc17HoYyw9Cp4hW', '2018-02-28 23:27:08', '2021-12-12 03:21:25');

-- --------------------------------------------------------

--
-- Table structure for table `admin_languages`
--

CREATE TABLE `admin_languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_default` tinyint(4) NOT NULL DEFAULT 0,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rtl` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_languages`
--

INSERT INTO `admin_languages` (`id`, `is_default`, `language`, `file`, `name`, `rtl`, `created_at`, `updated_at`) VALUES
(1, 1, 'En', '1603880510hWH6gk7S.json', '1603880510hWH6gk7S', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_user_conversations`
--

CREATE TABLE `admin_user_conversations` (
  `id` int(191) NOT NULL,
  `subject` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(191) NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_user_conversations`
--

INSERT INTO `admin_user_conversations` (`id`, `subject`, `user_id`, `message`, `created_at`, `updated_at`) VALUES
(16, 'dgdf', 76, 'dfgdfg', '2022-03-13 20:51:56', '2022-03-13 20:51:56'),
(17, 'sdagdd', 76, 'gsg', '2022-03-13 20:52:13', '2022-03-13 20:52:13'),
(18, 'dfdsf', 72, 'dsfdsf', '2022-03-13 20:53:03', '2022-03-13 20:53:03'),
(19, 'check new Update', 72, 'zxczxcxzc', '2022-03-13 21:18:14', '2022-03-13 21:18:14');

-- --------------------------------------------------------

--
-- Table structure for table `admin_user_messages`
--

CREATE TABLE `admin_user_messages` (
  `id` int(191) NOT NULL,
  `conversation_id` int(191) NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_user_messages`
--

INSERT INTO `admin_user_messages` (`id`, `conversation_id`, `message`, `user_id`, `created_at`, `updated_at`) VALUES
(41, 16, 'dfgdfg', 76, '2022-03-13 20:51:56', '2022-03-13 20:51:56'),
(42, 17, 'gsg', 76, '2022-03-13 20:52:13', '2022-03-13 20:52:13'),
(43, 18, 'dsfdsf', 72, '2022-03-13 20:53:03', '2022-03-13 20:53:03'),
(44, 18, 'asdadas', 72, '2022-03-13 20:56:04', '2022-03-13 20:56:04'),
(45, 18, 'asdasd', 72, '2022-03-13 20:56:07', '2022-03-13 20:56:07'),
(46, 18, 'adsads', 0, '2022-03-13 20:56:27', '2022-03-13 20:56:27'),
(47, 18, 'xcvxcvxc', 0, '2022-03-13 21:08:18', '2022-03-13 21:08:18'),
(48, 19, 'zxczxcxzc', 72, '2022-03-13 21:18:14', '2022-03-13 21:18:14'),
(49, 19, 'sdfsdfsdgd', 0, '2022-03-13 21:18:39', '2022-03-13 21:18:39');

-- --------------------------------------------------------

--
-- Table structure for table `balance_transfers`
--

CREATE TABLE `balance_transfers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `other_bank_id` int(11) DEFAULT NULL,
  `beneficiary_id` int(11) DEFAULT NULL,
  `transaction_no` varchar(255) DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `final_amount` double DEFAULT NULL,
  `type` enum('own','other') DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `balance_transfers`
--

INSERT INTO `balance_transfers` (`id`, `user_id`, `receiver_id`, `other_bank_id`, `beneficiary_id`, `transaction_no`, `cost`, `amount`, `final_amount`, `type`, `status`, `created_at`, `updated_at`) VALUES
(60, 122, 124, NULL, NULL, '6PA61666507971', 0, 1.3513513513514, NULL, 'own', 1, '2022-10-23 06:52:51', '2022-10-23 06:52:51'),
(61, 122, 123, NULL, NULL, 'HYMH1666782689', 0, 11.562431190223, NULL, 'own', 1, '2022-10-26 11:11:29', '2022-10-26 11:11:29'),
(62, 122, NULL, 6, 9, 'bhrP1666784344', 32.519178600841, 534.75926011458, 567.27843871542, 'other', 0, '2022-10-26 11:39:04', '2022-10-26 11:39:04'),
(63, 122, NULL, 6, 9, 'GMoH1666784700', 30.929503433847, 502.96575677471, 533.89526020855, 'other', 0, '2022-10-26 11:45:00', '2022-10-26 11:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `bank_plans`
--

CREATE TABLE `bank_plans` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `daily_send` double DEFAULT NULL,
  `monthly_send` double DEFAULT NULL,
  `daily_receive` double DEFAULT NULL,
  `monthly_receive` double DEFAULT NULL,
  `daily_withdraw` double DEFAULT NULL,
  `monthly_withdraw` double DEFAULT NULL,
  `loan_amount` double DEFAULT NULL,
  `attribute` longtext DEFAULT NULL,
  `days` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bank_plans`
--

INSERT INTO `bank_plans` (`id`, `title`, `amount`, `daily_send`, `monthly_send`, `daily_receive`, `monthly_receive`, `daily_withdraw`, `monthly_withdraw`, `loan_amount`, `attribute`, `days`, `created_at`, `updated_at`) VALUES
(1, 'Basic', 0, 1000, 10000, 100, 1000, 100, 1000, 50000, '[\"Max send Money 1000 USD\",\"Max loan amount 1000 USD\",\"Plan valid for 30 Days\"]', 30, '2022-02-14 00:41:13', '2022-03-14 21:50:03'),
(6, 'Premium', 100, 100000, 1500000, 50000, 1000000, 5000, 100000, 100000, '[\"Max send money 100000 USD\",\"Max loan amount 100000 USD\",\"Plan valid for 100 Days\"]', 100, '2022-02-15 00:14:28', '2022-03-14 21:43:51');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiaries`
--

CREATE TABLE `beneficiaries` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `other_bank_id` int(11) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `nick_name` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `beneficiaries`
--

INSERT INTO `beneficiaries` (`id`, `user_id`, `other_bank_id`, `account_number`, `account_name`, `nick_name`, `details`, `created_at`, `updated_at`) VALUES
(6, 50, 3, '199.152.0001472', 'Imtiaz Ahmed Afzal', 'Imtiaz', '{\"NID_No\":[\"24796325874156\",\"text\"],\"Driving_Lience\":[\"P71OSlsq1642407495.png\",\"file\"],\"Address\":[\"dhaka.uttara\",\"textarea\"]}', '2022-01-17 02:18:15', '2022-01-17 02:18:15'),
(7, 72, 3, '2132142354534', 'gdfgdf', 'dfgfg', '{\"NID_No\":[\"5345534343\",\"text\"],\"Driving_Lience\":[\"n9gbAEuu1647149331.png\",\"file\"],\"Address\":[\"gdfgdfg\",\"textarea\"]}', '2022-03-13 18:28:51', '2022-03-13 18:28:51'),
(8, 122, 6, 'GS22234231921096', 'bcvb', 'cvcvbcv', '{\"NID\":[\"cvbcvbc\",\"text\"]}', '2022-10-23 06:53:52', '2022-10-23 06:53:52'),
(9, 122, 6, 'GS22223138936923', 'rtgretre', 'ertre', '{\"NID\":[\"retretre\",\"text\"]}', '2022-10-26 11:12:13', '2022-10-26 11:12:13');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(191) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `meta_tag` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `category_id`, `title`, `slug`, `details`, `photo`, `source`, `views`, `status`, `meta_tag`, `meta_description`, `tags`, `created_at`) VALUES
(24, 7, 'Four steps for a cloud-ready talent system in banking', 'four-steps-for-a-cloud-ready-talent-system-in-banking', 'With cloud skills of all kinds in hot demand across many industries, banks are having to come to grips with an uncomfortable truth. Hiring, on its own, will not provide them with the skills they need to maximize the value of the cloud. \r\n<br><br><br>\r\nMy previous post looked at the specific must-have skills identified by Accenture analysis for cloud success. In this post, I’ll walk through our four-step framework for growing these skills within an organization. Here’s a high-level visualization: \r\n<br><br><br>\r\nThe second is that the first two steps in the framework focus on the organization as a whole and the market, while steps three and four zoom in on the people within the organization. Alternating between these two frames of analysis is no accident. \r\n<br><br><br>', 'yEVwvno41647249536.jpg', 'www.geniusocean.com', 62, 1, 'dhfghfg', NULL, 'hfhf,sfsg,fsg,qrw', '2019-01-03 06:03:37'),
(29, 4, 'Finance now! Opportunities for embedded lending and leasing', 'finance-now-opportunities-for-embedded-lending-and-leasing', 'When I was shopping online recently, a new option appeared on the checkout screen that presented me the opportunity to finance my purchase. This new offering is becoming pervasive across all asset types, from laptops to lift trucks, and including services such as vacation travel, on B2C, B2B and even P2P shopping sites. \r\n<br><br><br>\r\nThe goal is to make it easier for customers to access financial services as they go about their daily lives. Rather than having to arrange financing or defer purchasing, buyers can finance in the moment and businesses can receive payment quickly. \r\n<br><br><br>\r\nEmbedded specialty financing—lending and leasing—is coming. In fact, I think it’s a trend that’s likely to change the finance landscape within the next five years. So, auto and equipment finance companies need to start thinking now about how they can capitalize on it for the best advantage.', 'cgYNpliD1647249636.jpg', 'genius', 0, 1, NULL, NULL, NULL, '2022-03-14 22:20:36'),
(30, 5, 'What are “cloud skills” for banks, anyway?', 'what-are-cloud-skills-for-banks-anyway', 'Most banks are making significant investments in the cloud and planning to migrate core computing workloads in the coming years. Our research on “Mainframe Migration to the Cloud in Banking”—which we outline in the current issue of the Banking Cloud Altimeter—surveyed 150 banking executives across 16 countries and found that 82% of large banks that are planning to or are in the process of moving at least half of their mainframe workloads to the cloud. Of those aiming to move 75% or more of their workloads to the cloud, most plan to achieve that goal within the next five years.iv> \r\n<br><br><br>\r\nMore Accenture analysis has found that banking is ahead of most industries in its cloud adoption, which includes sourcing and training the skills needed to maximize the cloud’s potential. In terms of cloud adoption, banking leads industries like insurance, automotive and travel while trailing only a few high-tech industries like software.  \r\n<br><br><br>\r\nBut hiring, on its own, is not a viable solution to the talent problem. Demand for both cloud technologists and cloud fluency across the entire organization is rising in banking and beyond. There is not enough external cloud talent to meet the demand.', 'uqb6sKZm1647249780.jpg', 'genius', 0, 1, NULL, NULL, NULL, '2022-03-14 22:23:00');

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` int(191) NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `slug`) VALUES
(2, 'Tickets', 'tickets'),
(3, 'Support', 'support'),
(4, 'Transactions', 'transactions'),
(5, 'Withdraw', 'withdraw'),
(6, 'Deposit', 'deposit'),
(7, 'Banking', 'banking');

-- --------------------------------------------------------

--
-- Table structure for table `counters`
--

CREATE TABLE `counters` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `count` varchar(255) DEFAULT NULL,
  `is_money` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `counters`
--

INSERT INTO `counters` (`id`, `title`, `icon`, `count`, `is_money`, `created_at`, `updated_at`) VALUES
(1, 'Total Deposit', 'fas fa-dollar-sign', '890', 1, '2022-02-20 22:56:47', '2022-02-20 23:12:43'),
(2, 'Total Withdraw', 'fas fa-money-check-alt', '456', 1, '2022-02-20 23:13:58', '2022-02-20 23:13:58'),
(3, 'Total Transactions', 'fas fa-exchange-alt', '96', 0, '2022-02-20 23:15:03', '2022-02-20 23:15:03'),
(4, 'Happy Clients', 'fas fa-users', '890', 0, '2022-02-20 23:16:18', '2022-02-20 23:16:18');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso2` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso3` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_code` int(11) NOT NULL,
  `postcode_required` tinyint(4) NOT NULL DEFAULT 0,
  `is_eu` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `iso2`, `iso3`, `phone_code`, `postcode_required`, `is_eu`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Andorra', 'AD', 'AND', 376, 0, 0, 0, NULL, NULL),
(2, 'United Arab Emirates', 'AE', 'ARE', 971, 0, 0, 0, NULL, NULL),
(3, 'Afghanistan', 'AF', 'AFG', 93, 0, 0, 0, NULL, NULL),
(4, 'Antigua and Barbuda', 'AG', 'ATG', 1268, 0, 0, 0, NULL, NULL),
(5, 'Anguilla', 'AI', 'AIA', 1264, 0, 0, 0, NULL, NULL),
(6, 'Albania', 'AL', 'ALB', 355, 0, 0, 0, NULL, NULL),
(7, 'Armenia', 'AM', 'ARM', 374, 0, 0, 0, NULL, NULL),
(8, 'Angola', 'AO', 'AGO', 244, 0, 0, 0, NULL, NULL),
(9, 'Antarctica', 'AQ', 'ATA', 672, 0, 0, 0, NULL, NULL),
(10, 'Argentina', 'AR', 'ARG', 54, 0, 0, 0, NULL, NULL),
(11, 'American Samoa', 'AS', 'ASM', 1684, 0, 0, 0, NULL, NULL),
(12, 'Austria', 'AT', 'AUT', 43, 0, 0, 0, NULL, NULL),
(13, 'Australia', 'AU', 'AUS', 61, 0, 0, 0, NULL, NULL),
(14, 'Aruba', 'AW', 'ABW', 297, 0, 0, 0, NULL, NULL),
(15, 'Åland Islands', 'AX', 'ALA', 0, 0, 0, 0, NULL, NULL),
(16, 'Azerbaijan', 'AZ', 'AZE', 994, 0, 0, 0, NULL, NULL),
(17, 'Bosnia and Herzegovina', 'BA', 'BIH', 387, 0, 0, 0, NULL, NULL),
(18, 'Barbados', 'BB', 'BRB', 1246, 0, 0, 0, NULL, NULL),
(19, 'Bangladesh', 'BD', 'BGD', 880, 0, 0, 0, NULL, NULL),
(20, 'Belgium', 'BE', 'BEL', 32, 0, 0, 0, NULL, NULL),
(21, 'Burkina Faso', 'BF', 'BFA', 226, 0, 0, 0, NULL, NULL),
(22, 'Bulgaria', 'BG', 'BGR', 359, 0, 0, 0, NULL, NULL),
(23, 'Bahrain', 'BH', 'BHR', 973, 0, 0, 0, NULL, NULL),
(24, 'Burundi', 'BI', 'BDI', 257, 0, 0, 0, NULL, NULL),
(25, 'Benin', 'BJ', 'BEN', 229, 0, 0, 0, NULL, NULL),
(26, 'Saint Barthélemy', 'BL', 'BLM', 0, 0, 0, 0, NULL, NULL),
(27, 'Bermuda', 'BM', 'BMU', 1441, 0, 0, 0, NULL, NULL),
(28, 'Brunei Darussalam', 'BN', 'BRN', 673, 0, 0, 0, NULL, NULL),
(29, 'Bolivia', 'BO', 'BOL', 591, 0, 0, 0, NULL, NULL),
(30, 'Bonaire, Sint Eustatius and Saba', 'BQ', 'BES', 0, 0, 0, 0, NULL, NULL),
(31, 'Brazil', 'BR', 'BRA', 55, 0, 0, 0, NULL, NULL),
(32, 'Bahamas', 'BS', 'BHS', 1242, 0, 0, 0, NULL, NULL),
(33, 'Bhutan', 'BT', 'BTN', 975, 0, 0, 0, NULL, NULL),
(34, 'Bouvet Island', 'BV', 'BVT', 44, 0, 0, 0, NULL, NULL),
(35, 'Botswana', 'BW', 'BWA', 267, 0, 0, 0, NULL, NULL),
(36, 'Belarus', 'BY', 'BLR', 375, 0, 0, 0, NULL, NULL),
(37, 'Belize', 'BZ', 'BLZ', 501, 0, 0, 0, NULL, NULL),
(38, 'Canada', 'CA', 'CAN', 1, 0, 0, 0, NULL, NULL),
(39, 'Cocos (Keeling) Islands', 'CC', 'CCK', 61, 0, 0, 0, NULL, NULL),
(40, 'Congo (Democratic Republic of the)', 'CD', 'COD', 243, 0, 0, 0, NULL, NULL),
(41, 'Central African Republic', 'CF', 'CAF', 236, 0, 0, 0, NULL, NULL),
(42, 'Congo', 'CG', 'COG', 242, 0, 0, 0, NULL, NULL),
(43, 'Switzerland', 'CH', 'CHE', 41, 0, 0, 0, NULL, NULL),
(44, 'Ivory Coast', 'CI', 'CIV', 225, 0, 0, 0, NULL, NULL),
(45, 'Cook Islands', 'CK', 'COK', 682, 0, 0, 0, NULL, NULL),
(46, 'Chile', 'CL', 'CHL', 56, 0, 0, 0, NULL, NULL),
(47, 'Cameroon', 'CM', 'CMR', 237, 0, 0, 0, NULL, NULL),
(48, 'China', 'CN', 'CHN', 86, 0, 0, 0, NULL, NULL),
(49, 'Colombia', 'CO', 'COL', 57, 0, 0, 0, NULL, NULL),
(50, 'Costa Rica', 'CR', 'CRI', 506, 0, 0, 0, NULL, NULL),
(51, 'Cuba', 'CU', 'CUB', 53, 0, 0, 0, NULL, NULL),
(52, 'Cape Verde', 'CV', 'CPV', 238, 0, 0, 0, NULL, NULL),
(53, 'Curaçao', 'CW', 'CUW', 0, 0, 0, 0, NULL, NULL),
(54, 'Christmas Island', 'CX', 'CXR', 61, 0, 0, 0, NULL, NULL),
(55, 'Cyprus', 'CY', 'CYP', 357, 0, 0, 0, NULL, NULL),
(56, 'Czech Republic', 'CZ', 'CZE', 420, 0, 0, 0, NULL, NULL),
(57, 'Germany', 'DE', 'DEU', 49, 0, 0, 0, NULL, NULL),
(58, 'Djibouti', 'DJ', 'DJI', 253, 0, 0, 0, NULL, NULL),
(59, 'Denmark', 'DK', 'DNK', 45, 0, 0, 0, NULL, NULL),
(60, 'Dominica', 'DM', 'DMA', 1767, 0, 0, 0, NULL, NULL),
(61, 'Dominican Republic', 'DO', 'DOM', 1809, 0, 0, 0, NULL, NULL),
(62, 'Algeria', 'DZ', 'DZA', 213, 0, 0, 0, NULL, NULL),
(63, 'Ecuador', 'EC', 'ECU', 593, 0, 0, 0, NULL, NULL),
(64, 'Estonia', 'EE', 'EST', 372, 0, 0, 0, NULL, NULL),
(65, 'Egypt', 'EG', 'EGY', 20, 0, 0, 0, NULL, NULL),
(66, 'Western Sahara', 'EH', 'ESH', 0, 0, 0, 0, NULL, NULL),
(67, 'Eritrea', 'ER', 'ERI', 291, 0, 0, 0, NULL, NULL),
(68, 'Spain', 'ES', 'ESP', 34, 0, 0, 0, NULL, NULL),
(69, 'Ethiopia', 'ET', 'ETH', 251, 0, 0, 0, NULL, NULL),
(70, 'Finland', 'FI', 'FIN', 358, 0, 0, 0, NULL, NULL),
(71, 'Fiji', 'FJ', 'FJI', 679, 0, 0, 0, NULL, NULL),
(72, 'Falkland Islands (Malvinas)', 'FK', 'FLK', 500, 0, 0, 0, NULL, NULL),
(73, 'Micronesia (Federated States of)', 'FM', 'FSM', 691, 0, 0, 0, NULL, NULL),
(74, 'Faroe Islands', 'FO', 'FRO', 298, 0, 0, 0, NULL, NULL),
(75, 'France', 'FR', 'FRA', 33, 0, 0, 0, NULL, NULL),
(76, 'Gabon', 'GA', 'GAB', 241, 0, 0, 0, NULL, NULL),
(77, 'United Kingdom', 'GB', 'GBR', 44, 1, 0, 0, NULL, NULL),
(78, 'Grenada', 'GD', 'GRD', 1473, 0, 0, 0, NULL, NULL),
(79, 'Georgia', 'GE', 'GEO', 995, 0, 0, 0, NULL, NULL),
(80, 'French Guiana', 'GF', 'GUF', 594, 0, 0, 0, NULL, NULL),
(81, 'Guernsey', 'GG', 'GGY', 0, 0, 0, 0, NULL, NULL),
(82, 'Ghana', 'GH', 'GHA', 233, 0, 0, 0, NULL, NULL),
(83, 'Gibraltar', 'GI', 'GIB', 350, 0, 0, 0, NULL, NULL),
(84, 'Greenland', 'GL', 'GRL', 299, 0, 0, 0, NULL, NULL),
(85, 'Gambia', 'GM', 'GMB', 220, 0, 0, 0, NULL, NULL),
(86, 'Guinea', 'GN', 'GIN', 224, 0, 0, 0, NULL, NULL),
(87, 'Guadeloupe', 'GP', 'GLP', 590, 0, 0, 0, NULL, NULL),
(88, 'Equatorial Guinea', 'GQ', 'GNQ', 240, 0, 0, 0, NULL, NULL),
(89, 'Greece', 'GR', 'GRC', 30, 0, 0, 0, NULL, NULL),
(90, 'South Georgia and the South Sandwich Islands', 'GS', 'SGS', 44, 0, 0, 0, NULL, NULL),
(91, 'Guatemala', 'GT', 'GTM', 502, 0, 0, 0, NULL, NULL),
(92, 'Guam', 'GU', 'GUM', 1671, 0, 0, 0, NULL, NULL),
(93, 'Guinea-Bissau', 'GW', 'GNB', 245, 0, 0, 0, NULL, NULL),
(94, 'Guyana', 'GY', 'GUY', 592, 0, 0, 0, NULL, NULL),
(95, 'Hong Kong', 'HK', 'HKG', 852, 0, 0, 0, NULL, NULL),
(96, 'Heard Island and McDonald Islands', 'HM', 'HMD', 44, 0, 0, 0, NULL, NULL),
(97, 'Honduras', 'HN', 'HND', 504, 0, 0, 0, NULL, NULL),
(98, 'Croatia (Hrvatska)', 'HR', 'HRV', 385, 0, 0, 0, NULL, NULL),
(99, 'Haiti', 'HT', 'HTI', 509, 0, 0, 0, NULL, NULL),
(100, 'Hungary', 'HU', 'HUN', 36, 0, 0, 0, NULL, NULL),
(101, 'Indonesia', 'ID', 'IDN', 62, 0, 0, 0, NULL, NULL),
(102, 'Ireland', 'IE', 'IRL', 353, 0, 0, 0, NULL, NULL),
(103, 'Israel', 'IL', 'ISR', 972, 0, 0, 0, NULL, NULL),
(104, 'Isle of Man', 'IM', 'IMN', 0, 0, 0, 0, NULL, NULL),
(105, 'India', 'IN', 'IND', 91, 0, 0, 0, NULL, NULL),
(106, 'British Indian Ocean Territory', 'IO', 'IOT', 0, 0, 0, 0, NULL, NULL),
(107, 'Iraq', 'IQ', 'IRQ', 964, 0, 0, 0, NULL, NULL),
(108, 'Iran (Islamic Republic of)', 'IR', 'IRN', 98, 0, 0, 0, NULL, NULL),
(109, 'Iceland', 'IS', 'ISL', 354, 0, 0, 0, NULL, NULL),
(110, 'Italy', 'IT', 'ITA', 39, 0, 0, 0, NULL, NULL),
(111, 'Jersey', 'JE', 'JEY', 0, 0, 0, 0, NULL, NULL),
(112, 'Jamaica', 'JM', 'JAM', 1876, 0, 0, 0, NULL, NULL),
(113, 'Jordan', 'JO', 'JOR', 962, 0, 0, 0, NULL, NULL),
(114, 'Japan', 'JP', 'JPN', 81, 0, 0, 0, NULL, NULL),
(115, 'Kenya', 'KE', 'KEN', 254, 0, 0, 0, NULL, NULL),
(116, 'Kyrgyzstan', 'KG', 'KGZ', 996, 0, 0, 0, NULL, NULL),
(117, 'Cambodia', 'KH', 'KHM', 855, 0, 0, 0, NULL, NULL),
(118, 'Kiribati', 'KI', 'KIR', 686, 0, 0, 0, NULL, NULL),
(119, 'Comoros', 'KM', 'COM', 269, 0, 0, 0, NULL, NULL),
(120, 'Saint Kitts and Nevis', 'KN', 'KNA', 1869, 0, 0, 0, NULL, NULL),
(121, 'Korea (Democratic People\'s Republic of)', 'KP', 'PRK', 850, 0, 0, 0, NULL, NULL),
(122, 'Korea (Republic of)', 'KR', 'KOR', 82, 0, 0, 0, NULL, NULL),
(123, 'Kuwait', 'KW', 'KWT', 965, 0, 0, 0, NULL, NULL),
(124, 'Cayman Islands', 'KY', 'CYM', 1345, 0, 0, 0, NULL, NULL),
(125, 'Kazakhstan', 'KZ', 'KAZ', 7, 0, 0, 0, NULL, NULL),
(126, 'Lao People\'s Democratic Republic', 'LA', 'LAO', 856, 0, 0, 0, NULL, NULL),
(127, 'Lebanon', 'LB', 'LBN', 961, 0, 0, 0, NULL, NULL),
(128, 'Saint Lucia', 'LC', 'LCA', 1758, 0, 0, 0, NULL, NULL),
(129, 'Liechtenstein', 'LI', 'LIE', 423, 0, 0, 0, NULL, NULL),
(130, 'Sri Lanka', 'LK', 'LKA', 94, 0, 0, 0, NULL, NULL),
(131, 'Liberia', 'LR', 'LBR', 231, 0, 0, 0, NULL, NULL),
(132, 'Lesotho', 'LS', 'LSO', 266, 0, 0, 0, NULL, NULL),
(133, 'Lithuania', 'LT', 'LTU', 370, 0, 0, 0, NULL, NULL),
(134, 'Luxembourg', 'LU', 'LUX', 352, 0, 0, 0, NULL, NULL),
(135, 'Latvia', 'LV', 'LVA', 371, 0, 0, 0, NULL, NULL),
(136, 'Libya', 'LY', 'LBY', 218, 0, 0, 0, NULL, NULL),
(137, 'Morocco', 'MA', 'MAR', 212, 0, 0, 0, NULL, NULL),
(138, 'Monaco', 'MC', 'MCO', 377, 0, 0, 0, NULL, NULL),
(139, 'Moldova (Republic of)', 'MD', 'MDA', 373, 0, 0, 0, NULL, NULL),
(140, 'Montenegro', 'ME', 'MNE', 382, 0, 0, 0, NULL, NULL),
(141, 'Saint Martin (French part)', 'MF', 'MAF', 0, 0, 0, 0, NULL, NULL),
(142, 'Madagascar', 'MG', 'MDG', 261, 0, 0, 0, NULL, NULL),
(143, 'Marshall Islands', 'MH', 'MHL', 692, 0, 0, 0, NULL, NULL),
(144, 'Macedonia', 'MK', 'MKD', 389, 0, 0, 0, NULL, NULL),
(145, 'Mali', 'ML', 'MLI', 223, 0, 0, 0, NULL, NULL),
(146, 'Myanmar', 'MM', 'MMR', 95, 0, 0, 0, NULL, NULL),
(147, 'Mongolia', 'MN', 'MNG', 976, 0, 0, 0, NULL, NULL),
(148, 'Macau', 'MO', 'MAC', 853, 0, 0, 0, NULL, NULL),
(149, 'Northern Mariana Islands', 'MP', 'MNP', 1670, 0, 0, 0, NULL, NULL),
(150, 'Martinique', 'MQ', 'MTQ', 596, 0, 0, 0, NULL, NULL),
(151, 'Mauritania', 'MR', 'MRT', 222, 0, 0, 0, NULL, NULL),
(152, 'Montserrat', 'MS', 'MSR', 1664, 0, 0, 0, NULL, NULL),
(153, 'Malta', 'MT', 'MLT', 356, 0, 0, 0, NULL, NULL),
(154, 'Mauritius', 'MU', 'MUS', 230, 0, 0, 0, NULL, NULL),
(155, 'Maldives', 'MV', 'MDV', 960, 0, 0, 0, NULL, NULL),
(156, 'Malawi', 'MW', 'MWI', 265, 0, 0, 0, NULL, NULL),
(157, 'Mexico', 'MX', 'MEX', 52, 0, 0, 0, NULL, NULL),
(158, 'Malaysia', 'MY', 'MYS', 60, 0, 0, 0, NULL, NULL),
(159, 'Mozambique', 'MZ', 'MOZ', 258, 0, 0, 0, NULL, NULL),
(160, 'Namibia', 'NA', 'NAM', 264, 0, 0, 0, NULL, NULL),
(161, 'New Caledonia', 'NC', 'NCL', 687, 0, 0, 0, NULL, NULL),
(162, 'Niger', 'NE', 'NER', 227, 0, 0, 0, NULL, NULL),
(163, 'Norfolk Island', 'NF', 'NFK', 672, 0, 0, 0, NULL, NULL),
(164, 'Nigeria', 'NG', 'NGA', 234, 0, 0, 0, NULL, NULL),
(165, 'Nicaragua', 'NI', 'NIC', 505, 0, 0, 0, NULL, NULL),
(166, 'Netherlands', 'NL', 'NLD', 31, 0, 0, 0, NULL, NULL),
(167, 'Norway', 'NO', 'NOR', 47, 0, 0, 0, NULL, NULL),
(168, 'Nepal', 'NP', 'NPL', 977, 0, 0, 0, NULL, NULL),
(169, 'Nauru', 'NR', 'NRU', 674, 0, 0, 0, NULL, NULL),
(170, 'Niue', 'NU', 'NIU', 683, 0, 0, 0, NULL, NULL),
(171, 'New Zealand', 'NZ', 'NZL', 64, 0, 0, 0, NULL, NULL),
(172, 'Oman', 'OM', 'OMN', 968, 0, 0, 0, NULL, NULL),
(173, 'Panama', 'PA', 'PAN', 507, 0, 0, 0, NULL, NULL),
(174, 'Peru', 'PE', 'PER', 51, 0, 0, 0, NULL, NULL),
(175, 'French Polynesia', 'PF', 'PYF', 689, 0, 0, 0, NULL, NULL),
(176, 'Papua New Guinea', 'PG', 'PNG', 675, 0, 0, 0, NULL, NULL),
(177, 'Philippines', 'PH', 'PHL', 63, 0, 0, 0, NULL, NULL),
(178, 'Pakistan', 'PK', 'PAK', 92, 0, 0, 0, NULL, NULL),
(179, 'Poland', 'PL', 'POL', 48, 0, 0, 0, NULL, NULL),
(180, 'Saint Pierre and Miquelon', 'PM', 'SPM', 508, 0, 0, 0, NULL, NULL),
(181, 'Pitcairn', 'PN', 'PCN', 870, 0, 0, 0, NULL, NULL),
(182, 'Puerto Rico', 'PR', 'PRI', 1, 0, 0, 0, NULL, NULL),
(183, 'Palestine, State of', 'PS', 'PSE', 0, 0, 0, 0, NULL, NULL),
(184, 'Portugal', 'PT', 'PRT', 351, 0, 0, 0, NULL, NULL),
(185, 'Palau', 'PW', 'PLW', 680, 0, 0, 0, NULL, NULL),
(186, 'Paraguay', 'PY', 'PRY', 595, 0, 0, 0, NULL, NULL),
(187, 'Qatar', 'QA', 'QAT', 974, 0, 0, 0, NULL, NULL),
(188, 'Reunion', 'RE', 'REU', 262, 0, 0, 0, NULL, NULL),
(189, 'Romania', 'RO', 'ROU', 40, 0, 0, 0, NULL, NULL),
(190, 'Serbia', 'RS', 'SRB', 381, 0, 0, 0, NULL, NULL),
(191, 'Russian Federation', 'RU', 'RUS', 7, 0, 0, 0, NULL, NULL),
(192, 'Rwanda', 'RW', 'RWA', 250, 0, 0, 0, NULL, NULL),
(193, 'Saudi Arabia', 'SA', 'SAU', 966, 0, 0, 0, NULL, NULL),
(194, 'Solomon Islands', 'SB', 'SLB', 677, 0, 0, 0, NULL, NULL),
(195, 'Seychelles', 'SC', 'SYC', 248, 0, 0, 0, NULL, NULL),
(196, 'Sudan', 'SD', 'SDN', 249, 0, 0, 0, NULL, NULL),
(197, 'Sweden', 'SE', 'SWE', 46, 0, 0, 0, NULL, NULL),
(198, 'Singapore', 'SG', 'SGP', 65, 0, 0, 0, NULL, NULL),
(199, 'Saint Helena, Ascension and Tristan da Cunha', 'SH', 'SHN', 290, 0, 0, 0, NULL, NULL),
(200, 'Slovenia', 'SI', 'SVN', 386, 0, 0, 0, NULL, NULL),
(201, 'Svalbard and Jan Mayen', 'SJ', 'SJM', 0, 0, 0, 0, NULL, NULL),
(202, 'Slovakia', 'SK', 'SVK', 421, 0, 0, 0, NULL, NULL),
(203, 'Sierra Leone', 'SL', 'SLE', 232, 0, 0, 0, NULL, NULL),
(204, 'San Marino', 'SM', 'SMR', 378, 0, 0, 0, NULL, NULL),
(205, 'Senegal', 'SN', 'SEN', 221, 0, 0, 0, NULL, NULL),
(206, 'Somalia', 'SO', 'SOM', 252, 0, 0, 0, NULL, NULL),
(207, 'Suriname', 'SR', 'SUR', 597, 0, 0, 0, NULL, NULL),
(208, 'South Sudan', 'SS', 'SSD', 0, 0, 0, 0, NULL, NULL),
(209, 'Sao Tome and Principe', 'ST', 'STP', 239, 0, 0, 0, NULL, NULL),
(210, 'El Salvador', 'SV', 'SLV', 503, 0, 0, 0, NULL, NULL),
(211, 'Sint Maarten (Dutch part)', 'SX', 'SXM', 0, 0, 0, 0, NULL, NULL),
(212, 'Syrian Arab Republic', 'SY', 'SYR', 963, 0, 0, 0, NULL, NULL),
(213, 'Swaziland', 'SZ', 'SWZ', 268, 0, 0, 0, NULL, NULL),
(214, 'Turks and Caicos Islands', 'TC', 'TCA', 1649, 0, 0, 0, NULL, NULL),
(215, 'Chad', 'TD', 'TCD', 235, 0, 0, 0, NULL, NULL),
(216, 'French Southern Territories', 'TF', 'ATF', 44, 0, 0, 0, NULL, NULL),
(217, 'Togo', 'TG', 'TGO', 228, 0, 0, 0, NULL, NULL),
(218, 'Thailand', 'TH', 'THA', 66, 0, 0, 0, NULL, NULL),
(219, 'Tajikistan', 'TJ', 'TJK', 992, 0, 0, 0, NULL, NULL),
(220, 'Tokelau', 'TK', 'TKL', 690, 0, 0, 0, NULL, NULL),
(221, 'Timor-Leste', 'TL', 'TLS', 670, 0, 0, 0, NULL, NULL),
(222, 'Turkmenistan', 'TM', 'TKM', 993, 0, 0, 0, NULL, NULL),
(223, 'Tunisia', 'TN', 'TUN', 216, 0, 0, 0, NULL, NULL),
(224, 'Tonga', 'TO', 'TON', 676, 0, 0, 0, NULL, NULL),
(225, 'Turkey', 'TR', 'TUR', 90, 0, 0, 0, NULL, NULL),
(226, 'Trinidad and Tobago', 'TT', 'TTO', 1868, 0, 0, 0, NULL, NULL),
(227, 'Tuvalu', 'TV', 'TUV', 688, 0, 0, 0, NULL, NULL),
(228, 'Taiwan', 'TW', 'TWN', 886, 0, 0, 0, NULL, NULL),
(229, 'Tanzania, United Republic of', 'TZ', 'TZA', 255, 0, 0, 0, NULL, NULL),
(230, 'Ukraine', 'UA', 'UKR', 380, 0, 0, 0, NULL, NULL),
(231, 'Uganda', 'UG', 'UGA', 256, 0, 0, 0, NULL, NULL),
(232, 'United States Minor Outlying Islands', 'UM', 'UMI', 44, 0, 0, 0, NULL, NULL),
(233, 'United States of America', 'US', 'USA', 1, 0, 0, 0, NULL, NULL),
(234, 'Uruguay', 'UY', 'URY', 598, 0, 0, 0, NULL, NULL),
(235, 'Uzbekistan', 'UZ', 'UZB', 998, 0, 0, 0, NULL, NULL),
(236, 'Vatican City State', 'VA', 'VAT', 39, 0, 0, 0, NULL, NULL),
(237, 'Saint Vincent and the Grenadines', 'VC', 'VCT', 1784, 0, 0, 0, NULL, NULL),
(238, 'Venezuela', 'VE', 'VEN', 58, 0, 0, 0, NULL, NULL),
(239, 'Virgin Islands (British)', 'VG', 'VGB', 1284, 0, 0, 0, NULL, NULL),
(240, 'Virgin Islands (U.S.)', 'VI', 'VIR', 1340, 0, 0, 0, NULL, NULL),
(241, 'Viet Nam', 'VN', 'VNM', 84, 0, 0, 0, NULL, NULL),
(242, 'Vanuatu', 'VU', 'VUT', 678, 0, 0, 0, NULL, NULL),
(243, 'Wallis and Futuna', 'WF', 'WLF', 681, 0, 0, 0, NULL, NULL),
(244, 'Samoa', 'WS', 'WSM', 685, 0, 0, 0, NULL, NULL),
(245, 'Yemen', 'YE', 'YEM', 967, 0, 0, 0, NULL, NULL),
(246, 'Mayotte', 'YT', 'MYT', 262, 0, 0, 0, NULL, NULL),
(247, 'South Africa', 'ZA', 'ZAF', 27, 0, 0, 0, NULL, NULL),
(248, 'Zambia', 'ZM', 'ZMB', 260, 0, 0, 0, NULL, NULL),
(249, 'Zimbabwe', 'ZW', 'ZWE', 263, 0, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(191) NOT NULL,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sign` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` double NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `sign`, `value`, `is_default`) VALUES
(1, 'USD', '$', 1, 1),
(4, 'BDT', '৳', 82.92649841308594, 0),
(6, 'EUR', '€', 0.864870011806488, 0),
(8, 'NGN', '₦', 410.94, 0),
(9, 'INR', '₹', 74, 0);

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` int(11) NOT NULL,
  `deposit_number` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `txnid` varchar(255) DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  `charge_id` varchar(255) DEFAULT NULL,
  `status` enum('pending','complete') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deposits`
--

INSERT INTO `deposits` (`id`, `deposit_number`, `user_id`, `amount`, `currency_id`, `txnid`, `method`, `charge_id`, `status`, `created_at`, `updated_at`) VALUES
(144, 'NjIcVSO6l5Gb', 122, 0.024334452718158, 8, '7566956', 'paystack', NULL, 'complete', '2022-07-28 09:18:44', '2022-07-28 09:18:44');

-- --------------------------------------------------------

--
-- Table structure for table `dps_plans`
--

CREATE TABLE `dps_plans` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `per_installment` decimal(10,0) DEFAULT NULL,
  `installment_interval` int(11) DEFAULT NULL,
  `total_installment` int(11) NOT NULL,
  `interest_rate` decimal(10,0) NOT NULL,
  `final_amount` decimal(10,0) NOT NULL,
  `user_profit` decimal(10,0) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dps_plans`
--

INSERT INTO `dps_plans` (`id`, `title`, `per_installment`, `installment_interval`, `total_installment`, `interest_rate`, `final_amount`, `user_profit`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Standard', '9000', 30, 20, '9', '180000', '16200', 1, '2022-01-11 00:46:41', '2022-03-14 21:57:03'),
(4, 'Basic', '80', 30, 20, '20', '1600', '320', 1, '2022-01-25 04:27:06', '2022-03-14 21:56:49');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` int(11) NOT NULL,
  `email_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_subject` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_body` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `email_type`, `email_subject`, `email_body`, `status`) VALUES
(1, 'Welcome', 'Welcome to our website.', '<p>Hello {customer_name},<br>Your registration successfully completed.</p><p>Thank You<br></p>', 1),
(2, 'Credited', 'Your Account has been credited', '<p>Hello {customer_name},<br>Your account has been credited by admin.</p><p>Thank You<br></p>', 1),
(3, 'Debited', 'Your Account has been debited', '<p>Hello {customer_name},<br>Your account has been debited by admin.</p><p>Thank You<br></p>', 1),
(4, 'Withdraw', 'Your withdraw is completed successfully.', '<p>Hello {customer_name},<br>Your withdraw is completed successfully.</p><p>Thank You<br></p>', 1),
(5, 'Deposit', 'You have invested successfully.', '<p>Hello {customer_name},<br>You have deposited successfully.</p><p>Transaction ID:&nbsp;<span style=\"color: rgb(33, 37, 41);\">{order_number}.</span></p><p>Thank You.</p>', 1),
(6, 'Request money', 'Your request money is completed successfully.', '<p>Hello {customer_name},<br>Your request money is completed successfully.</p><p>Thank You<br></p>', 1),
(7, 'Send money', 'Your send money is completed successfully.', '<p>Hello {customer_name},<br>Your send money is completed successfully.</p><p>Thank You<br></p>', 1),
(8, 'Password Changed', 'Your password has been changed', '<p>Hello {customer_name},<br>Your password has been changed successfully.</p><p>Thank You<br></p>', 1),
(9, 'Profile Update', 'Your profile has been update', '<p>Hello {customer_name},<br>Your profile has been updated successfully.</p><p>Thank You<br></p>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `title`, `details`, `status`) VALUES
(1, 'Right my front it wound cause fully', 'Aut, expedita optio? Quis ab laudantium, facilis similique est alias, possimus expedita dolorum fugit mollitia, optio quo?\r\n \r\nFacilis similique est alias, possimus expedita dolorum fugit mollitia, optio quo? Dignissimos beatae officia repellat maiores!', 1),
(3, 'Man particular insensible celebrated', 'Aut, expedita optio? Quis ab laudantium, facilis similique est alias, possimus expedita dolorum fugit mollitia, optio quo?\r\n \r\nFacilis similique est alias, possimus expedita dolorum fugit mollitia, optio quo? Dignissimos beatae officia repellat maiores!', 1),
(4, 'Will I be charged a fee for receiving the OTP via SMS?', 'No. The OTP service is free of charge. The Bank shall notify customers if any charge is imposed in future for this service. You can find the latest tariff guide for services on the Genius Bank Bangladesh website.', 0),
(5, 'Can I choose not to use the OTP service for online purchases?', 'No. Bangladesh Bank regulation has mandated the use of OTP for every online purchase.', 0),
(6, 'Why is there a need for an One-Time-Password (OTP) to complete an online purchase?', 'An OTP helps to protect against online fraud. It is a secure way to authenticate whether the customer who is making an online purchase is the rightful owner of the debit card being used.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `fdr_plans`
--

CREATE TABLE `fdr_plans` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `min_amount` decimal(10,0) DEFAULT NULL,
  `max_amount` decimal(10,0) DEFAULT NULL,
  `interest_interval` int(11) DEFAULT NULL,
  `interval_type` varchar(255) DEFAULT NULL,
  `interest_rate` decimal(10,0) DEFAULT NULL,
  `matured_days` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fdr_plans`
--

INSERT INTO `fdr_plans` (`id`, `title`, `min_amount`, `max_amount`, `interest_interval`, `interval_type`, `interest_rate`, `matured_days`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Basic', '20', '200', NULL, 'fixed', '3', 30, 1, '2022-01-12 05:05:44', '2022-03-14 21:57:33'),
(3, 'Standard', '50', '100', 30, 'partial', '4', 365, 1, '2022-01-12 05:54:25', '2022-03-14 21:57:47');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(191) NOT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `title`, `details`, `photo`) VALUES
(8, 'Personal  Loans', 'Genius Bank offers a wide range of loans  to suit your needs.', '1639476553add-bitcoins.png'),
(9, 'SME Banking', 'For availing SME loan it is required to mortgage collateral/security.', '1639476522buy-sell-bitcoins.png'),
(10, 'Corporate Banking', 'Get it on PC or Mobile to create, send and receive bitcoins.', '1639476579download-bitcoin.png'),
(11, 'Personal Banking', 'Customer can enjoy the convenience of banking service.', '1647235824mobile-app.png');

-- --------------------------------------------------------

--
-- Table structure for table `fonts`
--

CREATE TABLE `fonts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `font_family` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `font_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fonts`
--

INSERT INTO `fonts` (`id`, `font_family`, `font_value`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'Rubik', 'Rubik', 0, '2021-09-07 22:34:28', '2022-03-03 09:24:36'),
(2, 'Roboto', 'Roboto', 0, '2021-09-07 22:35:10', '2022-03-03 09:24:36'),
(3, 'New Tegomin', 'New+Tegomin', 0, '2021-09-07 22:35:23', '2022-03-03 09:24:36'),
(5, 'Open Sans', 'Open+Sans', 0, '2021-09-07 22:44:49', '2022-03-03 09:24:36'),
(11, 'Manrope', 'Manrope', 1, '2022-03-03 09:24:26', '2022-03-03 09:24:36');

-- --------------------------------------------------------

--
-- Table structure for table `generalsettings`
--

CREATE TABLE `generalsettings` (
  `id` int(191) NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loader` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_loader` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_no_prefix` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_email` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_phone` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `copyright` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `colors` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_talkto` tinyint(1) NOT NULL DEFAULT 1,
  `talkto` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_language` tinyint(1) NOT NULL DEFAULT 1,
  `is_loader` tinyint(1) NOT NULL DEFAULT 1,
  `map_key` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_disqus` tinyint(1) NOT NULL DEFAULT 0,
  `disqus` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_contact` tinyint(1) NOT NULL DEFAULT 0,
  `is_faq` tinyint(1) NOT NULL DEFAULT 0,
  `withdraw_status` tinyint(4) NOT NULL DEFAULT 0,
  `smtp_host` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `smtp_port` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `smtp_encryption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_user` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `smtp_pass` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_smtp` tinyint(1) NOT NULL DEFAULT 0,
  `coupon_found` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `already_coupon` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_subtitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_currency` tinyint(1) NOT NULL DEFAULT 0,
  `currency_format` tinyint(1) NOT NULL DEFAULT 0,
  `price_bigtitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_subtitle` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subscribe_success` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subscribe_error` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `error_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `error_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `error_photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `breadcumb_banner` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin_loader` tinyint(1) NOT NULL DEFAULT 0,
  `currency_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_sign` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_verification_email` tinyint(1) NOT NULL DEFAULT 0,
  `withdraw_fee` double NOT NULL DEFAULT 0,
  `withdraw_charge` double NOT NULL DEFAULT 0,
  `is_affilate` tinyint(1) NOT NULL DEFAULT 1,
  `affilate_charge` double NOT NULL DEFAULT 0,
  `affilate_banner` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secret_string` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gap_limit` int(11) NOT NULL DEFAULT 300,
  `isWallet` tinyint(4) NOT NULL DEFAULT 0,
  `affilate_new_user` int(11) NOT NULL DEFAULT 0,
  `affilate_user` int(11) NOT NULL DEFAULT 0,
  `footer_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pm_account` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_pm` tinyint(4) DEFAULT 0,
  `cc_api_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance_transfer` tinyint(4) NOT NULL DEFAULT 0,
  `twilio_account_sid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twilio_auth_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twilio_default_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twilio_status` tinyint(4) NOT NULL DEFAULT 0,
  `nexmo_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nexmo_secret` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nexmo_default_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nexmo_status` tinyint(4) NOT NULL DEFAULT 0,
  `two_factor` tinyint(4) NOT NULL DEFAULT 0,
  `kyc` tinyint(4) NOT NULL DEFAULT 0,
  `menu` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_cookie` tinyint(4) NOT NULL DEFAULT 1,
  `cookie_button` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cookie_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transfer_fixed` double DEFAULT NULL,
  `transfer_percentage` double DEFAULT NULL,
  `transfer_min` double DEFAULT NULL,
  `transfer_max` double DEFAULT NULL,
  `fixed_request_charge` double DEFAULT NULL,
  `percentage_request_charge` double DEFAULT NULL,
  `minimum_request_money` double DEFAULT NULL,
  `maximum_request_money` double DEFAULT NULL,
  `module_section` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_module` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fiat_access_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `generalsettings`
--

INSERT INTO `generalsettings` (`id`, `logo`, `favicon`, `loader`, `admin_loader`, `banner`, `title`, `account_no_prefix`, `header_email`, `header_phone`, `footer`, `copyright`, `colors`, `is_talkto`, `talkto`, `is_language`, `is_loader`, `map_key`, `is_disqus`, `disqus`, `is_contact`, `is_faq`, `withdraw_status`, `smtp_host`, `smtp_port`, `smtp_encryption`, `smtp_user`, `smtp_pass`, `from_email`, `from_name`, `is_smtp`, `coupon_found`, `already_coupon`, `order_title`, `service_subtitle`, `service_title`, `service_text`, `service_image`, `order_text`, `is_currency`, `currency_format`, `price_bigtitle`, `price_title`, `price_subtitle`, `price_text`, `subscribe_success`, `subscribe_error`, `error_title`, `error_text`, `error_photo`, `breadcumb_banner`, `is_admin_loader`, `currency_code`, `currency_sign`, `is_verification_email`, `withdraw_fee`, `withdraw_charge`, `is_affilate`, `affilate_charge`, `affilate_banner`, `secret_string`, `gap_limit`, `isWallet`, `affilate_new_user`, `affilate_user`, `footer_logo`, `pm_account`, `is_pm`, `cc_api_key`, `balance_transfer`, `twilio_account_sid`, `twilio_auth_token`, `twilio_default_number`, `twilio_status`, `nexmo_key`, `nexmo_secret`, `nexmo_default_number`, `nexmo_status`, `two_factor`, `kyc`, `menu`, `is_cookie`, `cookie_button`, `cookie_text`, `transfer_fixed`, `transfer_percentage`, `transfer_min`, `transfer_max`, `fixed_request_charge`, `percentage_request_charge`, `minimum_request_money`, `maximum_request_money`, `module_section`, `user_module`, `fiat_access_key`) VALUES
(1, 'Stww4kQy1645001015.png', '16393007481563335660service-icon-1.png', '5monWltX1641808745.gif', '33CiUFaI1641808748.gif', '1563350277herobg.jpg', 'Genius Bank - All in One Banking System', 'GS', 'Info@example.com', '0123 456789', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae', 'COPYRIGHT © 2019. All Rights Reserved By <a href=\"http://geniusocean.com/\">GeniusOcean.com</a>', '#0ba026', 1, '5df4a5ef43be710e1d220e97/1gg9lujjl', 1, 1, 'AIzaSyB1GpE4qeoJ__70UZxvX9CTMUTZRZNHcu8', 1, 'newspaper-7', 1, 1, 1, 'smtp.gmail.com', '465', 'tls', 'ahmmedafzal4@gmail.com', 'ohzgxzxyaebarzop', 'ahmmedafzal4@gmail.com', 'GeniusOcean', 1, 'Coupon Found', 'Coupon Already Applied', 'THANK YOU FOR YOUR INVEST.', '<h5 class=\"sub-title\">A litter bit More&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</h5>', '<h2 class=\"title extra-padding\">About US&nbsp;</h2>', '<p>Our organization pursues several goals that can be \r\n											identified as our mission. Learn more about them below.\r\n											Auis nostrud exercitation ullamc laboris nisitm aliquip ex \r\nbea sed consequat duis autes ure dolor. dolore magna aliqua nim ad \r\nminim.</p>\r\n									<p>\r\n											Auis nostrud exercitation ullamc laboris nisitm aliquip ex \r\nbea sed consequat duis autes ure dolor. dolore magna aliqua nim ad \r\nminim.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', '1563350729about.png', 'We\'ll email you an order confirmation with details and tracking info.', 1, 1, 'PRICING', 'Choose Plans & Pricing', 'Choose the best for yourself', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'You are subscribed Successfully.', 'This email has already been taken.', 'OOPS ! ... PAGE NOT FOUND', 'THE PAGE YOU ARE LOOKING FOR MIGHT HAVE BEEN REMOVED, HAD ITS NAME CHANGED, OR IS TEMPORARILY UNAVAILABLE.', '16392899281561878540404.png', 'dKD1rR0h1645072121.jpg', 1, 'USD', '$', 0, 5, 5, 1, 5, '16406712051566471347add.jpg', 'ZzsMLGKe162CfA5EcG6j', 3000, 1, 5, 5, 'Qk6wE0dR1645001520.png', 'U36807958', 1, 'cdb2163c-91cc-4fa6-b3fc-7de11bdcdf1a', 1, 'ACb87cec0c7d04b80d78bf1647edf8f67f', 'ee60fb893d6e7a2db56e5748e5eab8a3', '01976814812', 1, 'ba9111b8', 'cgxbAg4KnE80bcKx', '01976814812', 1, 0, 1, '{\"Home\":{\"title\":\"Home\",\"dropdown\":\"no\",\"href\":\"\\/\",\"target\":\"self\"},\"Services\":{\"title\":\"Services\",\"dropdown\":\"no\",\"href\":\"\\/services\",\"target\":\"self\"},\"Blog\":{\"title\":\"Blog\",\"dropdown\":\"no\",\"href\":\"\\/blogs\",\"target\":\"self\"},\"About\":{\"title\":\"About\",\"dropdown\":\"no\",\"href\":\"\\/about\",\"target\":\"self\"}}', 1, 'Allow Cookie', '<p>Your experience on this site will be improved by allowing cookies.<br></p>', 1, 0.8, 10, 1000, 1, 0.3, 1000, 5000, '', '', 'e02535b70998cade1035fbe04e50b8dd');

-- --------------------------------------------------------

--
-- Table structure for table `installment_logs`
--

CREATE TABLE `installment_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `transaction_no` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `installment_logs`
--

INSERT INTO `installment_logs` (`id`, `user_id`, `transaction_no`, `type`, `amount`, `created_at`, `updated_at`) VALUES
(19, 122, 'WfSK1666781184', 'dps', 80, '2022-10-26 10:46:24', '2022-10-26 10:46:24');

-- --------------------------------------------------------

--
-- Table structure for table `kyc_forms`
--

CREATE TABLE `kyc_forms` (
  `id` int(11) NOT NULL,
  `user_type` tinyint(4) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `label` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `required` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kyc_forms`
--

INSERT INTO `kyc_forms` (`id`, `user_type`, `type`, `label`, `name`, `required`, `created_at`, `updated_at`) VALUES
(9, 1, 1, 'Full Name', 'full_name', 1, '2022-03-06 06:08:28', '2022-03-06 06:08:28'),
(10, 1, 2, 'NID', 'nid', 1, '2022-03-06 06:08:38', '2022-03-06 06:08:38'),
(11, 1, 3, 'Present Address', 'present_address', 1, '2022-03-06 06:08:51', '2022-03-06 06:08:51'),
(12, 1, 3, 'Parmanent Address', 'parmanent_address', 1, '2022-03-06 06:09:04', '2022-03-06 06:09:04');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rtl` tinyint(4) NOT NULL DEFAULT 0,
  `is_default` tinyint(4) NOT NULL DEFAULT 0,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `rtl`, `is_default`, `language`, `name`, `file`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'EN', '1636017050KyjRNauw', '1636017050KyjRNauw.json', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `loan_plans`
--

CREATE TABLE `loan_plans` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `min_amount` decimal(10,0) DEFAULT NULL,
  `max_amount` decimal(10,0) DEFAULT NULL,
  `per_installment` decimal(10,0) DEFAULT NULL,
  `installment_interval` int(11) DEFAULT NULL,
  `total_installment` int(11) DEFAULT NULL,
  `instruction` text DEFAULT NULL,
  `required_information` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan_plans`
--

INSERT INTO `loan_plans` (`id`, `title`, `min_amount`, `max_amount`, `per_installment`, `installment_interval`, `total_installment`, `instruction`, `required_information`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Agriculture Loan', '5000', '50000', '2', 30, 60, NULL, '{\"1\":{\"field_name\":\"NID\",\"type\":\"file\",\"validation\":\"required\"},\"2\":{\"field_name\":\"Father\'s Name\",\"type\":\"text\",\"validation\":\"required\"},\"3\":{\"field_name\":\"Details Information\",\"type\":\"textarea\",\"validation\":\"nullable\"}}', 1, '2022-01-12 21:35:12', '2022-03-14 21:51:54'),
(5, 'Education Loan', '5000', '50000', '2', 30, 55, NULL, NULL, 1, '2022-01-23 02:36:10', '2022-03-14 21:52:10'),
(6, 'House Loan', '3000', '100000', '10', 30, 15, NULL, NULL, 1, '2022-01-23 02:37:55', '2022-03-14 21:52:27');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(191) NOT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `title`, `subtitle`, `photo`, `facebook`, `twitter`, `linkedin`) VALUES
(2, 'Ervin Kim', 'CEO of Apple', '1561539258comment2.png', 'https://www.facebook.com', 'https://www.twitter.com', 'https://www.linkedin.com'),
(3, 'Ervin Kim', 'CEO of Apple', '1561539242comment2.png', 'https://www.facebook.com', 'https://www.twitter.com', 'https://www.linkedin.com'),
(4, 'Ervin Kim', 'CEO of Apple', '1561539231comment2.png', 'https://www.facebook.com', 'https://www.twitter.com', 'https://www.linkedin.com'),
(5, 'Ervin Kim', 'CEO of Apple', '1561539222comment2.png', NULL, 'https://www.twitter.com', 'https://www.linkedin.com'),
(6, 'Ervin Kim', 'CEO of Apple', '1561539213comment2.png', NULL, 'https://www.twitter.com', 'https://www.linkedin.com'),
(7, 'Ervin Kim', 'CEO of Apple', '1561539184comment2.png', 'https://www.facebook.com', NULL, 'https://www.linkedin.com'),
(8, 'Ervin Kim', 'CEO of Apple', '1561539197comment2.png', 'https://www.facebook.com', 'https://www.twitter.com', 'https://www.linkedin.com'),
(9, 'Ervin Kim', 'CEO of Apple', '1561539345comment2.png', 'https://www.facebook.com', 'https://www.twitter.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `money_requests`
--

CREATE TABLE `money_requests` (
  `id` int(11) NOT NULL,
  `transaction_no` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `receiver_name` varchar(255) DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1 == success\r\n0 == pending',
  `details` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `money_requests`
--

INSERT INTO `money_requests` (`id`, `transaction_no`, `user_id`, `receiver_id`, `receiver_name`, `cost`, `amount`, `status`, `details`, `created_at`, `updated_at`) VALUES
(5, 'ZeJm1661142728', 123, 122, 'Dark Loard', 1.3, 100, 0, NULL, '2022-08-22 04:32:08', '2022-08-22 04:32:08'),
(6, '9jf21666519217', 122, 124, 'Dark Loard', 1.0040540540541, 1.3513513513514, 0, NULL, '2022-10-23 10:00:17', '2022-10-23 10:00:17'),
(7, 'O3qq1666782478', 122, 123, 'Dark Loard', 1.0346872935707, 11.562431190223, 0, NULL, '2022-10-26 11:07:58', '2022-10-26 11:07:58');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(191) NOT NULL,
  `order_id` int(191) UNSIGNED DEFAULT NULL,
  `user_id` int(191) DEFAULT NULL,
  `vendor_id` int(191) DEFAULT NULL,
  `product_id` int(191) DEFAULT NULL,
  `conversation_id` int(191) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `order_id`, `user_id`, `vendor_id`, `product_id`, `conversation_id`, `is_read`, `created_at`, `updated_at`) VALUES
(124, NULL, 53, NULL, NULL, NULL, 0, '2022-03-01 03:08:46', '2022-03-01 03:08:46'),
(125, NULL, 54, NULL, NULL, NULL, 0, '2022-03-01 03:19:49', '2022-03-01 03:19:49'),
(126, NULL, 55, NULL, NULL, NULL, 0, '2022-03-01 03:21:00', '2022-03-01 03:21:00'),
(127, NULL, 56, NULL, NULL, NULL, 0, '2022-03-01 03:22:42', '2022-03-01 03:22:42'),
(128, NULL, 57, NULL, NULL, NULL, 0, '2022-03-01 03:26:18', '2022-03-01 03:26:18'),
(129, NULL, 58, NULL, NULL, NULL, 0, '2022-03-01 03:33:24', '2022-03-01 03:33:24'),
(130, NULL, 59, NULL, NULL, NULL, 0, '2022-03-01 03:36:19', '2022-03-01 03:36:19'),
(131, NULL, 60, NULL, NULL, NULL, 0, '2022-03-01 04:07:33', '2022-03-01 04:07:33'),
(132, NULL, 61, NULL, NULL, NULL, 0, '2022-03-01 04:09:59', '2022-03-01 04:09:59'),
(133, NULL, 62, NULL, NULL, NULL, 0, '2022-03-01 04:13:22', '2022-03-01 04:13:22'),
(134, NULL, 63, NULL, NULL, NULL, 0, '2022-03-02 04:26:52', '2022-03-02 04:26:52'),
(135, NULL, 66, NULL, NULL, NULL, 0, '2022-03-03 09:52:55', '2022-03-03 09:52:55'),
(136, NULL, 67, NULL, NULL, NULL, 0, '2022-03-03 10:16:29', '2022-03-03 10:16:29'),
(137, NULL, 68, NULL, NULL, NULL, 0, '2022-03-03 10:23:49', '2022-03-03 10:23:49'),
(138, NULL, 69, NULL, NULL, NULL, 0, '2022-03-03 10:29:45', '2022-03-03 10:29:45'),
(139, NULL, 71, NULL, NULL, NULL, 0, '2022-03-06 11:17:33', '2022-03-06 11:17:33'),
(140, NULL, 71, NULL, NULL, NULL, 0, '2022-03-06 11:17:33', '2022-03-06 11:17:33'),
(141, NULL, 73, NULL, NULL, NULL, 0, '2022-03-13 16:45:14', '2022-03-13 16:45:14'),
(142, NULL, 75, NULL, NULL, NULL, 0, '2022-03-13 20:48:51', '2022-03-13 20:48:51'),
(143, NULL, NULL, NULL, NULL, 18, 0, '2022-03-13 20:56:04', '2022-03-13 20:56:04'),
(144, NULL, NULL, NULL, NULL, 18, 0, '2022-03-13 20:56:07', '2022-03-13 20:56:07'),
(145, NULL, 122, NULL, NULL, NULL, 0, '2022-03-14 21:41:40', '2022-03-14 21:41:40'),
(146, NULL, 123, NULL, NULL, NULL, 0, '2022-08-22 04:31:38', '2022-08-22 04:31:38'),
(147, NULL, 124, NULL, NULL, NULL, 0, '2022-10-23 05:42:31', '2022-10-23 05:42:31');

-- --------------------------------------------------------

--
-- Table structure for table `other_banks`
--

CREATE TABLE `other_banks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_limit` decimal(18,8) NOT NULL,
  `max_limit` decimal(18,8) NOT NULL,
  `daily_maximum_limit` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `monthly_maximum_limit` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `monthly_total_transaction` int(11) NOT NULL DEFAULT 0 COMMENT 'Count',
  `daily_total_transaction` int(11) NOT NULL DEFAULT 0 COMMENT 'Count',
  `fixed_charge` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `percent_charge` decimal(18,2) NOT NULL DEFAULT 0.00,
  `processing_time` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instruction` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `required_information` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 == ''pending''\r\n1 == ''completed''\r\n2 == ''reject''',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `other_banks`
--

INSERT INTO `other_banks` (`id`, `title`, `min_limit`, `max_limit`, `daily_maximum_limit`, `monthly_maximum_limit`, `monthly_total_transaction`, `daily_total_transaction`, `fixed_charge`, `percent_charge`, `processing_time`, `instruction`, `required_information`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Brac Bank', '500.00000000', '5000.00000000', '1000.00000000', '100000.00000000', 100, 20, '5.00000000', '2.00', '24 hours', NULL, '[{\"field_name\":\"NID No\",\"type\":\"text\",\"validation\":\"required\"},{\"field_name\":\"Driving Lience\",\"type\":\"file\",\"validation\":\"required\"},{\"field_name\":\"Address\",\"type\":\"textarea\",\"validation\":\"required\"}]', 1, '2022-01-16 00:54:10', '2022-03-13 18:40:38'),
(6, 'Dutch Bangla Bank', '500.00000000', '5000.00000000', '500000.00000000', '10000000.00000000', 100, 20, '5.00000000', '5.00', '24 hours', NULL, '[{\"field_name\":\"NID\",\"type\":\"text\",\"validation\":\"required\"}]', 1, '2022-01-16 22:38:59', '2022-03-13 18:40:08');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(191) NOT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_tag` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header` tinyint(1) NOT NULL DEFAULT 0,
  `footer` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `details`, `meta_tag`, `meta_description`, `header`, `footer`, `status`) VALUES
(1, 'About Us', 'about', '<div helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" start;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" initial;\"=\"\"><h2><font size=\"6\">Title number 1</font><br></h2><p><span style=\"font-weight: 700;\">Lorem Ipsum</span>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p></div><div helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" start;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" initial;\"=\"\"><h2><font size=\"6\">Title number 2</font><br></h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p></div><br helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" start;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" initial;\"=\"\"><div helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" start;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" initial;\"=\"\"><h2><font size=\"6\">Title number 3</font><br></h2><p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p></div><h2 helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-weight:=\"\" 700;=\"\" line-height:=\"\" 1.1;=\"\" color:=\"\" rgb(51,=\"\" 51,=\"\" 51);=\"\" margin:=\"\" 0px=\"\" 15px;=\"\" font-size:=\"\" 30px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" start;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" initial;\"=\"\" style=\"font-family: \" 51);\"=\"\"><font size=\"6\">Title number 9</font><br></h2><p helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" start;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" initial;\"=\"\">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>', NULL, NULL, 1, 0, 1),
(2, 'Privacy & Policy', 'privacy', '<div helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" start;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" initial;\"=\"\"><h2>Title number 1</h2><p><span style=\"font-weight: 700;\">Lorem Ipsum</span>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p></div><div helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" start;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" initial;\"=\"\"><h2><font size=\"6\">Title number 2</font><br></h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p></div><br helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" start;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" initial;\"=\"\"><div helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" start;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" initial;\"=\"\"><h2><font size=\"6\">Title number 3</font><br></h2><p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p></div><h2 helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-weight:=\"\" 700;=\"\" line-height:=\"\" 1.1;=\"\" color:=\"\" rgb(51,=\"\" 51,=\"\" 51);=\"\" margin:=\"\" 0px=\"\" 15px;=\"\" font-size:=\"\" 30px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" start;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" initial;\"=\"\" 51);\"=\"\" style=\"font-family: \"><font size=\"6\">Title number 9</font><br></h2><p helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" start;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" initial;\"=\"\">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>', 'test,test1,test2,test3', 'Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pagesettings`
--

CREATE TABLE `pagesettings` (
  `id` int(10) UNSIGNED NOT NULL,
  `contact_success` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `side_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `side_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slider` tinyint(1) NOT NULL DEFAULT 1,
  `service` tinyint(1) NOT NULL DEFAULT 1,
  `featured` tinyint(1) NOT NULL DEFAULT 1,
  `small_banner` tinyint(1) NOT NULL DEFAULT 1,
  `best` tinyint(1) NOT NULL DEFAULT 1,
  `top_rated` tinyint(1) NOT NULL DEFAULT 1,
  `large_banner` tinyint(1) NOT NULL DEFAULT 1,
  `big` tinyint(1) NOT NULL DEFAULT 1,
  `hot_sale` tinyint(1) NOT NULL DEFAULT 1,
  `hero_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hero_subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hero_btn_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hero_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hero_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review_blog` tinyint(1) NOT NULL DEFAULT 1,
  `pricing_plan` tinyint(1) NOT NULL DEFAULT 0,
  `service_subtitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_subtitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review_subtitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quick_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quick_subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quick_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quick_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quick_background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blog_subtitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blog_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blog_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faq_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faq_subtitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_attributes` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_details` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_video` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `strategy_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `strategy_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `strategy_banner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_top_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_top_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_top_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_link1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_link2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_banner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_details` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_store_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_store_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_google_store` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_google_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_module` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pagesettings`
--

INSERT INTO `pagesettings` (`id`, `contact_success`, `contact_email`, `contact_title`, `contact_text`, `side_title`, `side_text`, `street`, `phone`, `fax`, `email`, `site`, `slider`, `service`, `featured`, `small_banner`, `best`, `top_rated`, `large_banner`, `big`, `hot_sale`, `hero_title`, `hero_subtitle`, `hero_btn_url`, `hero_link`, `hero_photo`, `review_blog`, `pricing_plan`, `service_subtitle`, `service_title`, `service_text`, `plan_title`, `plan_subtitle`, `review_subtitle`, `review_title`, `review_text`, `quick_title`, `quick_subtitle`, `quick_link`, `quick_photo`, `quick_background`, `blog_subtitle`, `blog_title`, `blog_text`, `faq_title`, `faq_subtitle`, `about_photo`, `about_title`, `about_text`, `about_attributes`, `about_link`, `about_details`, `service_photo`, `service_video`, `strategy_title`, `strategy_details`, `strategy_banner`, `footer_top_photo`, `footer_top_title`, `footer_top_text`, `banner_title`, `banner_text`, `banner_link1`, `banner_link2`, `app_banner`, `app_title`, `app_details`, `app_store_photo`, `app_store_link`, `app_google_store`, `app_google_link`, `home_module`) VALUES
(1, 'Success! Thanks for contacting us, we will get back to you shortly.', 'admin@geniusocean.com', '<h4 class=\"subtitle\" style=\"margin-bottom: 6px; font-weight: 600; line-height: 28px; font-size: 28px; text-transform: uppercase;\">WE\'D LOVE TO</h4><h2 class=\"title\" style=\"margin-bottom: 13px;font-weight: 600;line-height: 50px;font-size: 40px;color: #1f71d4;text-transform: uppercase;\">HEAR FROM YOU</h2>', '<span style=\"color: rgb(119, 119, 119);\">Send us a message and we\' ll respond as soon as possible</span><br>', 'FEEL FREE TO DROP US A MESSAGE', 'Need to speak to us? Do you have any queries or suggestions? Please contact us about all enquiries including membership and volunteer work using the form below.', '3584 Hickory Heights Drive ,Hanover MD 21076, USA', '+12 3456 7890 1234', '00 000 000 000', 'admin@geniusocean.com', 'https://geniusocean.com/', 1, 1, 0, 0, 0, 1, 1, 1, 1, 'Simple And Safe Digital Banking Mobile App', 'Genius Bank works around your schedule, offering innovative products that is better, faster and affordable', 'http://localhost/geniusbank/', 'https://www.youtube.com/watch?v=lG-J1QC8cKY&ab_channel=EsoGolpoKoriPrime', 'qN2bqitJ1645077354.jpg', 1, 1, 'The client perspective depends on Business first growth.', 'The Better Way to Save & Invest', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Simple Transparent Pricing', 'The best price we only can ask for you.', 'Testimonial', 'What customers say about us', 'The client perspective depends on Business first growth. How big business can be. We provide best service all area.', 'Need a Personalized Solution?', 'Explicabo repellat minus eaque velit unde nulla nobis veritatis labore dolore, necessitatibus harum laborum at, aut reprehenderit!', 'http://localhost/geniusbank/', '4TsFX1TA1645088780.png', 'uhzm3tT31645088780.jpg', 'Latest Blog', 'Latest News & Tips', 'Banking commodi explicabo aperiam unde maxime debitis.', 'Frequently Asked Questions', 'Though we have provided lots of information about us and how we serve what is our working process our terms and conditions our policies etc.', 'N7TNLIK31645005637.jpg', 'WE ARE Genius Bank', 'A place for everyone who wants to simply banking system. Deposit funds using payment gateway or bank transfer. A Bank at fair price is guaranteed. Nothing extra. Join over 700,000 users from all over the world satisfied with our services. A place for everyone who wants to simply loans and Dps. Even with a history of hefty technological investments and an even larger donations, consumer and investor confidence has never waned.', '[\"Get up to $15,000 Cash Fast\",\"15 Minute Online Application\",\"Coverage around the world\",\"Business without borders\",\"Affiliates and partnerships\",\"Bad Credit Considered2\"]', 'https://www.google.com/', '<h3>We are Secure and Stable</h3>\r\nGenius Bank has become one of the largest donors and the largest bank donor in Bangladesh. The bank has won numerous international awards because of its unique approach as a socially conscious bank\r\nAs a result it now provides unrivaled banking technology offerings to all its customers. Because of this mindset, most local banks have joined Genius Bank banking infrastructure instead of pursuing their own.\r\n<br><br><br>\r\n<h3>We are Secure and Stable</h3>\r\nGenius Bank has become one of the largest donors and the largest bank donor in Bangladesh. The bank has won numerous international awards because of its unique approach as a socially conscious bank\r\nAs a result it now provides unrivaled banking technology offerings to all its customers. Because of this mindset, most local banks have joined Genius Bank banking infrastructure instead of pursuing their own.\r\n<br><br><br>\r\n\r\n<h3>We are Secure and Stable</h3>\r\nGenius Bank has become one of the largest donors and the largest bank donor in Bangladesh. The bank has won numerous international awards because of its unique approach as a socially conscious bank\r\nAs a result it now provides unrivaled banking technology offerings to all its customers. Because of this mindset, most local banks have joined Genius Bank banking infrastructure instead of pursuing their own.\r\n<br><br><br>\r\n\r\n<h3>We are Secure and Stable</h3>\r\nGenius Bank has become one of the largest donors and the largest bank donor in Bangladesh. The bank has won numerous international awards because of its unique approach as a socially conscious bank\r\nAs a result it now provides unrivaled banking technology offerings to all its customers. Because of this mindset, most local banks have joined Genius Bank banking infrastructure instead of pursuing their own.\r\n<br><br><br>', '1639568953bg-banner.jpg', 'https://www.youtube.com/watch?v=0gv7OC9L2s8', 'How it Works', 'The strategy where user can use the banking system. The strategy is simple easier to use. This is the fewer step to follow to create a bank account.', 'cjER6eH01645442056.png', '1639561929call-to-action-bg.jpg', 'GET STARTED TODAY WITH BITCOIN', 'Open account for free and start trading Bitcoins!', '<h4 class=\"subtitle\" style=\"font-weight: 600; line-height: 1.2381; font-size: 24px; color: rgb(31, 113, 212);\">More convenient than others</h4>', '<h2 class=\"title\" style=\"font-weight: 600; line-height: 60px; font-size: 50px; color: rgb(23, 34, 44);\">Find Value &amp; Build confidence</h2>', 'https://www.google.com/', 'https://www.google.com/', 'gFNRbRDL1645425298.png', 'Your banking experience anytime, anywhere', 'Deserunt hic consequatur ex placeat! atque repellendus inventore quisquam, perferendis, eum reiciendis quia nesciunt fuga. Natus illum doloremque sed perferendis blanditiis maiores, voluptas ad quas beatae facilis totam officiis ratione, ab cumque libero. Ducimus molestias iusto facilis!\r\n\r\nNatus illum doloremque sed perferendis blanditiis maiores, voluptas ad quas beatae facilis totam officiis ratione, ab cumque libero. Ducimus molestias iusto facilis!', '9HX3cjLu1645425298.png', 'https://www.google.com/', 'zbT8VZef1645425298.png', NULL, '[\"Banner\",\"Feature\",\"About\",\"Service\",\"How It Works\",\"Plan\",\"Apps\",\"Testimonials\",\"Counter\",\"CTAs\",\"Blogs\",\"FAQs\"]');

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateways`
--

CREATE TABLE `payment_gateways` (
  `id` int(191) NOT NULL,
  `subtitle` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('manual','automatic') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'manual',
  `information` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keyword` varchar(191) DEFAULT NULL,
  `currency_id` varchar(191) NOT NULL DEFAULT '0',
  `status` int(191) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_gateways`
--

INSERT INTO `payment_gateways` (`id`, `subtitle`, `title`, `details`, `name`, `type`, `information`, `keyword`, `currency_id`, `status`) VALUES
(6, NULL, NULL, NULL, 'Flutter Wave', 'automatic', '{\"public_key\":\"FLWPUBK_TEST-299dc2c8bf4c7f14f7d7f48c32433393-X\",\"secret_key\":\"FLWSECK_TEST-afb1f2a4789002d7c0f2185b830450b7-X\",\"text\":\"Pay via your Flutter Wave account.\"}', 'flutterwave', '[\"1\"]', 1),
(8, NULL, NULL, NULL, 'Authorize.Net', 'automatic', '{\"login_id\":\"76zu9VgUSxrJ\",\"txn_key\":\"2Vj62a6skSrP5U3X\",\"sandbox_check\":1,\"text\":\"Pay Via Authorize.Net\"}', 'authorize.net', '[\"1\"]', 1),
(9, NULL, NULL, NULL, 'Razorpay', 'automatic', '{\"key\":\"rzp_test_xDH74d48cwl8DF\",\"secret\":\"cr0H1BiQ20hVzhpHfHuNbGri\",\"text\":\"Pay via your Razorpay account.\"}', 'razorpay', '[\"8\"]', 1),
(10, NULL, NULL, NULL, 'Mollie Payment', 'automatic', '{\"key\":\"test_jePgBjaRV5rUdzWc44rb2fUxgM2dM9\",\"text\":\"Pay with Mollie Payment.\"}', 'mollie', '[\"1\",\"6\"]', 1),
(11, NULL, NULL, NULL, 'Paytm', 'automatic', '{\"merchant\":\"tkogux49985047638244\",\"secret\":\"LhNGUUKE9xCQ9xY8\",\"website\":\"WEBSTAGING\",\"industry\":\"Retail\",\"sandbox_check\":1,\"text\":\"Pay via your Paytm account.\"}', 'paytm', '[\"8\"]', 1),
(12, NULL, NULL, NULL, 'Paystack', 'automatic', '{\"key\":\"pk_test_162a56d42131cbb01932ed0d2c48f9cb99d8e8e2\",\"email\":\"junnuns@gmail.com\",\"text\":\"Pay via your Paystack account.\"}', 'paystack', '[\"9\"]', 1),
(13, NULL, NULL, NULL, 'Instamojo', 'automatic', '{\"key\":\"test_172371aa837ae5cad6047dc3052\",\"token\":\"test_4ac5a785e25fc596b67dbc5c267\",\"sandbox_check\":1,\"text\":\"Pay via your Instamojo account.\"}', 'instamojo', '[\"8\"]', 1),
(14, NULL, NULL, NULL, 'Stripe', 'automatic', '{\"key\":\"pk_test_UnU1Coi1p5qFGwtpjZMRMgJM\",\"secret\":\"sk_test_QQcg3vGsKRPlW6T3dXcNJsor\",\"text\":\"Pay via your Credit Card.\"}', 'stripe', '[\"1\"]', 1),
(15, NULL, NULL, NULL, 'Paypal', 'automatic', '{\"client_id\":\"AcWYnysKa_elsQIAnlfsJXokR64Z31CeCbpis9G3msDC-BvgcbAwbacfDfEGSP-9Dp9fZaGgD05pX5Qi\",\"client_secret\":\"EGZXTq6d6vBPq8kysVx8WQA5NpavMpDzOLVOb9u75UfsJ-cFzn6aeBXIMyJW2lN1UZtJg5iDPNL9ocYE\",\"sandbox_check\":1,\"text\":\"Pay via your PayPal account.\"}', 'paypal', '[\"1\"]', 1),
(25, 'mobile money', 'Bkash', '<p><b>Please deposit through this number<br>0123456789</b></p>', NULL, 'manual', NULL, NULL, '0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` int(11) NOT NULL,
  `commission_type` varchar(255) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `percent` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `referrals`
--

INSERT INTO `referrals` (`id`, `commission_type`, `level`, `percent`, `created_at`, `updated_at`) VALUES
(10, 'invest', 1, 3, '2022-02-01 21:59:02', '2022-02-01 21:59:02'),
(11, 'invest', 2, 2, '2022-02-01 21:59:02', '2022-02-01 21:59:02'),
(12, 'invest', 3, 1, '2022-02-01 21:59:02', '2022-02-01 21:59:02');

-- --------------------------------------------------------

--
-- Table structure for table `referral_bonuses`
--

CREATE TABLE `referral_bonuses` (
  `id` int(11) NOT NULL,
  `from_user_id` int(11) DEFAULT NULL,
  `to_user_id` int(11) DEFAULT NULL,
  `percentage` double DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `amount` decimal(20,10) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `referral_bonuses`
--

INSERT INTO `referral_bonuses` (`id`, `from_user_id`, `to_user_id`, `percentage`, `level`, `amount`, `type`, `created_at`, `updated_at`) VALUES
(4, 69, 50, NULL, NULL, '5.0000000000', 'Register', '2022-03-03 10:29:45', '2022-03-03 10:29:45');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `photo`, `title`, `subtitle`, `details`) VALUES
(5, 'PME52yRz1645070778.png', 'Jhon Smith', 'CEO & Founder', 'The is just awesome,  best quality service ever I had. You can trust them and deposit your funds. Their Loan plans are really helpful. Easy to use their online banking system.'),
(6, 'AjOD94Yk1645070744.png', 'Jazmin Sultana', 'CEO & Founder', 'The is just awesome,  best quality service ever I had. You can trust them and deposit your funds. Their Loan plans are really helpful. Easy to use their online banking system.');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `section`, `created_at`, `updated_at`) VALUES
(9, 'Staff', 'Menu Builder , Manage Customers , Loan Management , DPS Management , FDR Management , Transactions , Manage Blog , General Setting , Message , Manage Roles , Manage Staff , Fonts , Menupage Setting , Subscribers', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `save_accounts`
--

CREATE TABLE `save_accounts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `save_accounts`
--

INSERT INTO `save_accounts` (`id`, `user_id`, `receiver_id`, `created_at`, `updated_at`) VALUES
(1, 50, 51, '2022-01-18 03:49:10', '2022-01-18 03:49:10'),
(2, 52, 50, '2022-01-22 23:06:51', '2022-01-22 23:06:51'),
(3, 50, 52, '2022-01-23 06:03:41', '2022-01-23 06:03:41');

-- --------------------------------------------------------

--
-- Table structure for table `seotools`
--

CREATE TABLE `seotools` (
  `id` int(10) UNSIGNED NOT NULL,
  `google_analytics` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keys` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seotools`
--

INSERT INTO `seotools` (`id`, `google_analytics`, `meta_keys`) VALUES
(1, '<script async src=\"https://www.googletagmanager.com/gtag/js?id=UA-137437974-1\"></script>  <script>    window.dataLayer = window.dataLayer || [];    function gtag(){dataLayer.push(arguments);}    gtag(\'js\', new Date());    gtag(\'config\', \'UA-137437974-1\');  </script>', 'Genius,Ocean,Sea,Etc,Genius,Ocean,SeaGenius,Ocean,Sea,Etc,Genius,Ocean,SeaGenius,Ocean,Sea,Etc,Genius,Ocean,Sea');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(191) NOT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text DEFAULT NULL,
  `photo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `details`, `photo`) VALUES
(15, 'HIGH LIQUIDITY', 'Fast access to high liquidity orderbook</br>\r\nfor top currency pairs', '1639476836high-liquidity.png'),
(16, 'COST EFFICIENCY', 'Reasonable trading fees for takers</br>\r\nand all market makers', '1639476885cost-efficiency.png'),
(17, 'MOBILE APP', 'Trading via our Mobile App, Available</br>\r\nin Play Store & App Store', '1639476911mobile-app.png'),
(18, 'PAYMENT OPTIONS', 'Popular methods: Visa, MasterCard,</br>\r\nbank transfer, cryptocurrency', '1639476937payment-options.png'),
(19, 'WORLD COVERAGE', 'Providing services in 99% countries</br>\r\naround all the globe', '1639476969world-coverage.png'),
(20, 'STRONG SECURITY', 'Protection against DDoS attacks,</br>\r\nfull data encryption', '1639476998strong-security.png');

-- --------------------------------------------------------

--
-- Table structure for table `sitemaps`
--

CREATE TABLE `sitemaps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sitemap_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(191) UNSIGNED NOT NULL,
  `subtitle_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle_size` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle_color` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle_anime` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_size` varchar(50) DEFAULT NULL,
  `title_color` varchar(50) DEFAULT NULL,
  `title_anime` varchar(50) DEFAULT NULL,
  `details_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details_size` varchar(50) DEFAULT NULL,
  `details_color` varchar(50) DEFAULT NULL,
  `details_anime` varchar(50) DEFAULT NULL,
  `photo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `subtitle_text`, `subtitle_size`, `subtitle_color`, `subtitle_anime`, `title_text`, `title_size`, `title_color`, `title_anime`, `details_text`, `details_size`, `details_color`, `details_anime`, `photo`, `position`, `link`) VALUES
(9, 'YOU CAN TRUST', '24', '#ffffff', 'slideInUp', 'BITCOIN EXCHANGE', '60', '#ffffff', 'slideInDown', 'Highlight your personality  and look with these fabulous and exquisite fashion.', '16', '#ffffff', 'slideInDown', '1639479478bg1.jpg', 'slide-one', 'https://www.google.com/'),
(10, 'TO BITCOIN', '24', '#c32d2d', 'slideInUp', 'SECURE AND EASY WAY', '60', '#bc2727', 'slideInDown', NULL, NULL, '#c51d1d', 'slideInLeft', '1639479394bg2.jpg', 'slide-one', 'https://www.google.com/');

-- --------------------------------------------------------

--
-- Table structure for table `socialsettings`
--

CREATE TABLE `socialsettings` (
  `id` int(10) UNSIGNED NOT NULL,
  `facebook` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gplus` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dribble` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f_status` tinyint(4) NOT NULL DEFAULT 1,
  `g_status` tinyint(4) NOT NULL DEFAULT 1,
  `t_status` tinyint(4) NOT NULL DEFAULT 1,
  `l_status` tinyint(4) NOT NULL DEFAULT 1,
  `d_status` tinyint(4) NOT NULL DEFAULT 1,
  `f_check` tinyint(10) DEFAULT NULL,
  `g_check` tinyint(10) DEFAULT NULL,
  `fclient_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fclient_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fredirect` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gclient_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gclient_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gredirect` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `socialsettings`
--

INSERT INTO `socialsettings` (`id`, `facebook`, `gplus`, `twitter`, `linkedin`, `dribble`, `f_status`, `g_status`, `t_status`, `l_status`, `d_status`, `f_check`, `g_check`, `fclient_id`, `fclient_secret`, `fredirect`, `gclient_id`, `gclient_secret`, `gredirect`) VALUES
(1, 'https://www.facebook.com/', 'https://plus.google.com/', 'https://twitter.com/', 'https://www.linkedin.com/', 'https://dribbble.com/', 1, 0, 1, 1, 0, 1, 1, '503140663460329', 'f66cd670ec43d14209a2728af26dcc43', 'https://localhost/crypto/auth/facebook/callback', '904681031719-sh1aolu42k7l93ik0bkiddcboghbpcfi.apps.googleusercontent.com', 'yGBWmUpPtn5yWhDAsXnswEX3', 'http://localhost/marketplace/auth/google/callback');

-- --------------------------------------------------------

--
-- Table structure for table `social_providers`
--

CREATE TABLE `social_providers` (
  `id` int(191) NOT NULL,
  `user_id` int(191) NOT NULL,
  `provider_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `social_providers`
--

INSERT INTO `social_providers` (`id`, `user_id`, `provider_id`, `provider`, `created_at`, `updated_at`) VALUES
(3, 17, '102485372716947456487', 'google', '2019-06-19 17:06:00', '2019-06-19 17:06:00'),
(4, 18, '109955884428371086401', 'google', '2019-06-19 17:17:04', '2019-06-19 17:17:04');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(191) NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`) VALUES
(1, 'ahmmedafzal4@gmail.com'),
(2, 'imtiaze93@yahoo.com');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(191) NOT NULL,
  `user_id` int(191) NOT NULL DEFAULT 0,
  `receiver_id` int(11) DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `type` enum('Deposit','Payout','Referral Bonus','Send Money','Request Money','Subscription','Loan','Dps','Fdr') NOT NULL,
  `profit` enum('plus','minus') DEFAULT NULL,
  `txnid` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `receiver_id`, `email`, `amount`, `type`, `profit`, `txnid`, `created_at`, `updated_at`) VALUES
(126, 122, NULL, 'user@gmail.com', 1.3513513513514, 'Send Money', 'minus', '6PA61666507971', '2022-10-23 06:52:51', '2022-10-23 06:52:51'),
(127, 124, NULL, 'user1@gmail.com', 1.3513513513514, 'Send Money', 'plus', '6PA61666507971', '2022-10-23 06:52:51', '2022-10-23 06:52:51'),
(128, 124, NULL, 'user1@gmail.com', 2.3554054054054, 'Request Money', 'plus', '9jf21666519217', '2022-10-23 10:00:17', '2022-10-23 10:00:17'),
(129, 122, NULL, 'user@gmail.com', 3468.7293570669, 'Loan', 'plus', 'A0AK1666779905', '2022-10-26 10:25:05', '2022-10-26 10:25:05'),
(130, 122, NULL, 'user@gmail.com', 3468.7293570669, 'Loan', 'plus', 'vrjy1666780328', '2022-10-26 10:32:08', '2022-10-26 10:32:08'),
(131, 122, NULL, 'user@gmail.com', 3468.7293570669, 'Loan', 'plus', 'gKRv1666780372', '2022-10-26 10:32:52', '2022-10-26 10:32:52'),
(132, 122, NULL, 'user@gmail.com', 92.499449521785, 'Dps', 'minus', 'Nk7q1666780896', '2022-10-26 10:41:36', '2022-10-26 10:41:36'),
(133, 122, NULL, 'user@gmail.com', 80, 'Dps', 'minus', 'WfSK1666781184', '2022-10-26 10:46:24', '2022-10-26 10:46:24'),
(134, 122, NULL, 'user@gmail.com', 100.00346736424, 'Fdr', 'minus', 'I7az1666781747', '2022-10-26 10:55:47', '2022-10-26 10:55:47'),
(135, 123, NULL, 'ahmmedafzal4@gmail.com', 12.597118483794, 'Request Money', 'plus', 'O3qq1666782478', '2022-10-26 11:07:58', '2022-10-26 11:07:58'),
(136, 122, NULL, 'user@gmail.com', 11.562431190223, 'Send Money', 'minus', 'HYMH1666782689', '2022-10-26 11:11:29', '2022-10-26 11:11:29'),
(137, 123, NULL, 'ahmmedafzal4@gmail.com', 11.562431190223, 'Send Money', 'plus', 'HYMH1666782689', '2022-10-26 11:11:29', '2022-10-26 11:11:29'),
(138, 122, NULL, 'user@gmail.com', 567.27843871542, 'Send Money', 'minus', 'bhrP1666784344', '2022-10-26 11:39:04', '2022-10-26 11:39:04'),
(139, 122, NULL, 'user@gmail.com', 533.89526020855, 'Send Money', 'minus', 'GMoH1666784700', '2022-10-26 11:45:00', '2022-10-26 11:45:00'),
(140, 122, NULL, 'user@gmail.com', 9.39, 'Payout', 'minus', 'sVu98GrPQ1Q3', '2022-10-26 11:47:40', '2022-10-26 11:47:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `bank_plan_id` int(11) DEFAULT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_provider` tinyint(10) NOT NULL DEFAULT 0,
  `status` tinyint(10) NOT NULL DEFAULT 0,
  `verification_link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `balance` double NOT NULL DEFAULT 0,
  `affilate_code` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_id` tinyint(1) NOT NULL DEFAULT 0,
  `twofa` tinyint(4) NOT NULL DEFAULT 0,
  `go` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified` tinyint(4) NOT NULL DEFAULT 0,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kyc_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 == ''pending''\r\n1 == ''approve''\r\n2 == ''rejected''',
  `kyc_info` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kyc_reject_reason` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_banned` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1 === banned\r\n0 === active',
  `plan_end_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `bank_plan_id`, `account_number`, `name`, `photo`, `zip`, `city`, `address`, `phone`, `fax`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `is_provider`, `status`, `verification_link`, `email_verified`, `balance`, `affilate_code`, `referral_id`, `twofa`, `go`, `verified`, `details`, `kyc_status`, `kyc_info`, `kyc_reject_reason`, `is_banned`, `plan_end_date`) VALUES
(122, 1, 'GS22144140284387', 'Dark Loard', '0eok5owv1650352502.jpg', '1230', 'Dhaka', 'road-04', '0123456789', '0900000', 'user@gmail.com', '$2y$10$rQvGSDBkluDP4Efg2cnqBucAJaNnjCktTmMtuRvNwjaUP1nkaYsne', NULL, '2022-03-14 21:41:40', '2022-10-26 11:47:40', 0, 0, 'a023aecc77412f01d46faa719c44d59c', 'Yes', 9036.0654588204, 'd44c35414e49fffc1e57ae7968dd56bf', 0, 0, NULL, 0, NULL, 0, NULL, NULL, 0, '2022-11-22 05:43:26'),
(123, 1, 'GS22223138936923', 'Dark Loard', NULL, NULL, NULL, NULL, '0123456789', NULL, 'ahmmedafzal4@gmail.com', '$2y$10$/eRbBq0Z8pIVnStlpfhadOOaNzWdUpklLU2Bv28BAcGSuSYV6m6ru', NULL, '2022-08-22 04:31:38', '2022-10-26 11:11:29', 0, 0, '332167648d035080fea522fe1a42fbd4', 'Yes', 11.562431190223, 'f73cc12f2c55e0ddefe71c17c2e8eb6e', 0, 0, NULL, 0, NULL, 0, NULL, NULL, 0, '2022-09-21 04:31:38'),
(124, 1, 'GS22234231921096', 'Dark Loard', NULL, NULL, NULL, NULL, '0123456789', NULL, 'user1@gmail.com', '$2y$10$IPwfuXDJ7gVQjghf4E9wZOioChdOGP.Jp/EODtLPgZ6k8fhoCRH3u', NULL, '2022-10-23 05:42:31', '2022-10-23 06:52:51', 0, 0, '9662ceb5c8ba9c0e421c5fb624b60b77', 'Yes', 3.1351351351351795, '4444889120ac44d45a6b835b3e07c752', 0, 0, NULL, 0, NULL, 0, NULL, NULL, 0, '2022-11-22 05:42:31');

-- --------------------------------------------------------

--
-- Table structure for table `user_dps`
--

CREATE TABLE `user_dps` (
  `id` int(11) NOT NULL,
  `transaction_no` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `dps_plan_id` int(11) DEFAULT NULL,
  `per_installment` decimal(10,0) DEFAULT NULL,
  `installment_interval` int(11) DEFAULT NULL,
  `total_installment` decimal(10,0) DEFAULT NULL,
  `given_installment` decimal(10,0) DEFAULT NULL,
  `deposit_amount` decimal(10,0) DEFAULT NULL,
  `matured_amount` decimal(10,0) DEFAULT NULL,
  `paid_amount` double NOT NULL DEFAULT 0,
  `interest_rate` decimal(10,0) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '1 == running, 2 == matured',
  `is_given` tinyint(4) NOT NULL DEFAULT 0,
  `next_installment` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_dps`
--

INSERT INTO `user_dps` (`id`, `transaction_no`, `user_id`, `dps_plan_id`, `per_installment`, `installment_interval`, `total_installment`, `given_installment`, `deposit_amount`, `matured_amount`, `paid_amount`, `interest_rate`, `status`, `is_given`, `next_installment`, `created_at`, `updated_at`) VALUES
(8, 'WfSK1666781184', 122, 4, '80', 30, '20', '1', '1600', '1920', 80, '20', 1, 0, '2022-11-25 10:46:24', '2022-10-26 10:46:24', '2022-10-26 10:46:24');

-- --------------------------------------------------------

--
-- Table structure for table `user_fdrs`
--

CREATE TABLE `user_fdrs` (
  `id` int(11) NOT NULL,
  `transaction_no` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `fdr_plan_id` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `profit_type` varchar(255) DEFAULT NULL,
  `profit_amount` double DEFAULT NULL,
  `interest_rate` double DEFAULT NULL,
  `next_profit_time` timestamp NULL DEFAULT NULL,
  `matured_time` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '1 == running, 2 == closed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_loans`
--

CREATE TABLE `user_loans` (
  `id` int(11) NOT NULL,
  `transaction_no` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `plan_id` int(11) NOT NULL,
  `loan_amount` decimal(20,10) DEFAULT NULL,
  `per_installment_amount` decimal(20,10) DEFAULT NULL,
  `total_installment` int(11) DEFAULT NULL,
  `given_installment` int(11) DEFAULT NULL,
  `paid_amount` decimal(20,10) DEFAULT NULL,
  `total_amount` decimal(20,10) DEFAULT NULL,
  `required_information` longtext DEFAULT NULL,
  `next_installment` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '0 == pending , 1 == approve , 2 == rejected, 3 == completed,',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_loans`
--

INSERT INTO `user_loans` (`id`, `transaction_no`, `user_id`, `plan_id`, `loan_amount`, `per_installment_amount`, `total_installment`, `given_installment`, `paid_amount`, `total_amount`, `required_information`, `next_installment`, `status`, `created_at`, `updated_at`) VALUES
(31, 'gKRv1666780372', 122, 6, '3468.7293570669', '346.8729357067', 15, 0, '0.0000000000', '5203.0940356004', NULL, NULL, 0, '2022-10-26 10:32:52', '2022-10-26 10:32:52');

-- --------------------------------------------------------

--
-- Table structure for table `user_notifications`
--

CREATE TABLE `user_notifications` (
  `id` int(191) NOT NULL,
  `user_id` int(191) NOT NULL,
  `order_id` int(191) NOT NULL DEFAULT 0,
  `withdraw_id` int(191) NOT NULL DEFAULT 0,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` enum('Invest','Payout','Withdraw') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_subscriptions`
--

CREATE TABLE `user_subscriptions` (
  `id` int(11) NOT NULL,
  `subscription_number` varchar(255) DEFAULT NULL,
  `txnid` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `bank_plan_id` int(11) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  `days` int(11) DEFAULT NULL,
  `status` enum('pending','completed') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_subscriptions`
--

INSERT INTO `user_subscriptions` (`id`, `subscription_number`, `txnid`, `user_id`, `bank_plan_id`, `currency_id`, `price`, `method`, `days`, `status`, `created_at`, `updated_at`) VALUES
(18, 'jIVw1644993862', '3137234', 50, 6, 1, 100, 'flutterwave', 100, 'completed', '2022-02-16 00:44:22', '2022-02-16 00:44:53'),
(19, 'vreF1646111014', NULL, 62, 6, 1, 100, 'paypal', 100, 'pending', '2022-03-01 05:03:34', '2022-03-01 05:03:34'),
(20, 'yeTi1646111315', '2adbacc97c6246998aa69d90aab5375e', 62, 6, 9, 1.3513513513514, 'instamojo', 100, 'completed', '2022-03-01 05:08:35', '2022-03-01 05:08:35'),
(21, 'ZII41646111557', 'txn_3KYO0qJlIV5dN9n71WhB4b5r', 62, 6, 9, 1.3513513513514, 'stripe', 100, 'pending', '2022-03-01 05:12:39', '2022-03-01 05:12:39'),
(22, 'pG6M1646111589', NULL, 62, 6, 9, 1.3513513513514, 'paypal', 100, 'pending', '2022-03-01 05:13:09', '2022-03-01 05:13:09'),
(23, 'vMpW1646111619', NULL, 62, 6, 9, 1.3513513513514, 'paypal', 100, 'pending', '2022-03-01 05:13:39', '2022-03-01 05:13:39'),
(24, 'bKo41646111907', '56004648YH063573D', 62, 6, 9, 1.3513513513514, 'paypal', 100, 'completed', '2022-03-01 05:18:27', '2022-03-01 05:19:38'),
(25, 'JKPP1646112310', '97P17095MP529492Y', 62, 6, 1, 100, 'paypal', 100, 'completed', '2022-03-01 05:25:10', '2022-03-01 05:25:24'),
(26, 'O65E1646112794', NULL, 62, 6, 9, 1.3513513513514, 'authorize.net', 100, 'pending', '2022-03-01 05:33:16', '2022-03-01 05:33:16'),
(27, 'AanR1646825572', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', '2022-03-09 11:32:53', '2022-03-09 11:32:53'),
(28, 'SIoo1646825881', NULL, 50, 6, 1, 100, 'mollie', 100, 'completed', '2022-03-09 11:38:02', '2022-03-09 11:38:02'),
(29, 'Rnkb1646826036', '26W28613JS034702K', 50, 6, 9, 1.3513513513514, 'paypal', 100, 'completed', '2022-03-09 11:40:36', '2022-03-09 11:41:06'),
(30, 'hGPy1646884602', NULL, 50, 6, 1, 100, 'mollie', 100, 'completed', '2022-03-10 03:56:43', '2022-03-10 03:56:43'),
(31, 'd9U61646885817', NULL, 50, 6, 9, 100, 'paypal', 100, 'pending', '2022-03-10 04:16:57', '2022-03-10 04:16:57'),
(32, '6qyx1646885923', NULL, 50, 6, 9, 100, 'paypal', 100, 'pending', '2022-03-10 04:18:43', '2022-03-10 04:18:43'),
(33, 'WMv71646885953', NULL, 50, 6, 1, 100, 'paypal', 100, 'pending', '2022-03-10 04:19:13', '2022-03-10 04:19:13'),
(34, 'FAU01646885997', NULL, 50, 6, 6, 100, 'paypal', 100, 'pending', '2022-03-10 04:19:57', '2022-03-10 04:19:57'),
(35, 'e5Jc1646886604', '20220310111212800110168503203512219', 50, 6, 9, 100, 'paytm', 100, 'completed', '2022-03-10 04:30:04', '2022-03-10 04:30:19'),
(36, 'GJhw1647143160', '5X30428265724942N', 72, 6, 1, 100, 'paypal', 100, 'completed', '2022-03-13 16:46:00', '2022-03-13 16:46:32'),
(37, 'Ixnj1647143227', '7GR99816HC461762T', 72, 6, 1, 100, 'paypal', 100, 'completed', '2022-03-13 16:47:07', '2022-03-13 16:47:17'),
(38, 'dIn31647143349', '1K984646SG758972E', 50, 6, 1, 100, 'paypal', 100, 'completed', '2022-03-13 16:49:09', '2022-03-13 16:49:59'),
(39, 'k5AM1647143691', '0V0048634V776132H', 72, 6, 1, 100, 'paypal', 100, 'completed', '2022-03-13 16:54:51', '2022-03-13 16:55:01'),
(40, 'vSMm1647143730', '9L599537RL016344E', 72, 6, 1, 100, 'paypal', 100, 'completed', '2022-03-13 16:55:30', '2022-03-13 16:55:40'),
(41, 'uL2z1647143769', 'txn_3KciXPJlIV5dN9n70Y6wP7q6', 72, 6, 1, 100, 'stripe', 100, 'pending', '2022-03-13 16:56:12', '2022-03-13 16:56:12'),
(42, 'Qn6n1647144166', 'txn_3KcidoJlIV5dN9n71sW7KiXs', 50, 6, 1, 100, 'stripe', 100, 'pending', '2022-03-13 17:02:48', '2022-03-13 17:02:48'),
(43, 'WeAK1647144188', '9CY544766H703262B', 72, 6, 1, 100, 'paypal', 100, 'completed', '2022-03-13 17:03:08', '2022-03-13 17:03:19'),
(44, 'IpcI1647144483', NULL, 72, 6, 1, 100, 'mollie', 100, 'completed', '2022-03-13 17:08:04', '2022-03-13 17:08:04'),
(45, 'k2W81647144688', NULL, 72, 6, 9, 100, 'paytm', 100, 'pending', '2022-03-13 17:11:28', '2022-03-13 17:11:28'),
(46, 'ZuzG1647144720', '20220313111212800110168581603506962', 72, 6, 9, 100, 'paytm', 100, 'completed', '2022-03-13 17:12:00', '2022-03-13 17:12:33'),
(47, 'a0Ie1647145474', 'order_J6RN0gLagRgC7j', 72, 6, 9, 100, 'razorpay', 100, 'completed', '2022-03-13 17:25:37', '2022-03-13 17:25:37');

-- --------------------------------------------------------

--
-- Table structure for table `wire_transfers`
--

CREATE TABLE `wire_transfers` (
  `id` int(11) NOT NULL,
  `transaction_no` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `wire_transfer_bank_id` int(11) DEFAULT NULL,
  `swift_code` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `routing_number` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `account_holder_name` varchar(255) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 == ''pending''\r\n\r\n1 == ''completed''\r\n\r\n2 == ''reject''',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wire_transfers`
--

INSERT INTO `wire_transfers` (`id`, `transaction_no`, `user_id`, `wire_transfer_bank_id`, `swift_code`, `currency`, `routing_number`, `country`, `account_number`, `account_holder_name`, `amount`, `note`, `status`, `created_at`, `updated_at`) VALUES
(6, 'FSKK1666782660', 122, 1, 'CIBLBDDH', 'USD', '987456123', 'Bangladesh', 'fthgffffffff', 'fghffffff', 11.562431190223, NULL, 0, '2022-10-26 11:11:00', '2022-10-26 11:11:00');

-- --------------------------------------------------------

--
-- Table structure for table `wire_transfer_banks`
--

CREATE TABLE `wire_transfer_banks` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `country_id` varchar(255) DEFAULT NULL,
  `swift_code` varchar(255) DEFAULT NULL,
  `routing_number` varchar(255) DEFAULT NULL,
  `min_amount` double DEFAULT NULL,
  `max_amount` double DEFAULT NULL,
  `fixed_charge` double DEFAULT NULL,
  `percentage_charge` double DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wire_transfer_banks`
--

INSERT INTO `wire_transfer_banks` (`id`, `title`, `currency_id`, `country_id`, `swift_code`, `routing_number`, `min_amount`, `max_amount`, `fixed_charge`, `percentage_charge`, `status`, `created_at`, `updated_at`) VALUES
(1, 'The City Bank Limited', 1, '19', 'CIBLBDDH', '987456123', 10, 10000, 2, 0.5, 1, '2022-02-06 03:46:51', '2022-03-10 04:55:39');

-- --------------------------------------------------------

--
-- Table structure for table `withdraws`
--

CREATE TABLE `withdraws` (
  `id` int(191) NOT NULL,
  `txnid` varchar(255) DEFAULT NULL,
  `user_id` int(191) DEFAULT NULL,
  `method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `fee` float DEFAULT 0,
  `details` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` enum('pending','completed','rejected') NOT NULL DEFAULT 'pending',
  `type` enum('user','vendor') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `withdraws`
--

INSERT INTO `withdraws` (`id`, `txnid`, `user_id`, `method`, `address`, `reference`, `amount`, `fee`, `details`, `created_at`, `updated_at`, `status`, `type`) VALUES
(22, 'sVu98GrPQ1Q3', 122, 'Paypal', NULL, NULL, 9.39, 2.17344, 'fghgf', '2022-10-26 17:47:40', '2022-10-26 17:47:40', 'pending', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_methods`
--

CREATE TABLE `withdraw_methods` (
  `id` int(11) NOT NULL,
  `method` varchar(255) DEFAULT NULL,
  `fixed` double DEFAULT 0,
  `percentage` double DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `withdraw_methods`
--

INSERT INTO `withdraw_methods` (`id`, `method`, `fixed`, `percentage`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Paypal', 2, 1.5, 1, '2021-12-06 23:47:28', '2022-03-10 04:56:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_processes`
--
ALTER TABLE `account_processes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admin_languages`
--
ALTER TABLE `admin_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_user_conversations`
--
ALTER TABLE `admin_user_conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_user_messages`
--
ALTER TABLE `admin_user_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `balance_transfers`
--
ALTER TABLE `balance_transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_plans`
--
ALTER TABLE `bank_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `counters`
--
ALTER TABLE `counters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `countries_name_unique` (`name`),
  ADD UNIQUE KEY `countries_iso2_unique` (`iso2`),
  ADD UNIQUE KEY `countries_iso3_unique` (`iso3`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dps_plans`
--
ALTER TABLE `dps_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fdr_plans`
--
ALTER TABLE `fdr_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fonts`
--
ALTER TABLE `fonts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `generalsettings`
--
ALTER TABLE `generalsettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `installment_logs`
--
ALTER TABLE `installment_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kyc_forms`
--
ALTER TABLE `kyc_forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_plans`
--
ALTER TABLE `loan_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `money_requests`
--
ALTER TABLE `money_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_banks`
--
ALTER TABLE `other_banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pagesettings`
--
ALTER TABLE `pagesettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referral_bonuses`
--
ALTER TABLE `referral_bonuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `save_accounts`
--
ALTER TABLE `save_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seotools`
--
ALTER TABLE `seotools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sitemaps`
--
ALTER TABLE `sitemaps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `socialsettings`
--
ALTER TABLE `socialsettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_providers`
--
ALTER TABLE `social_providers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_dps`
--
ALTER TABLE `user_dps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_fdrs`
--
ALTER TABLE `user_fdrs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_loans`
--
ALTER TABLE `user_loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_notifications`
--
ALTER TABLE `user_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wire_transfers`
--
ALTER TABLE `wire_transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wire_transfer_banks`
--
ALTER TABLE `wire_transfer_banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraws`
--
ALTER TABLE `withdraws`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_processes`
--
ALTER TABLE `account_processes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `admin_languages`
--
ALTER TABLE `admin_languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `admin_user_conversations`
--
ALTER TABLE `admin_user_conversations`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `admin_user_messages`
--
ALTER TABLE `admin_user_messages`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `balance_transfers`
--
ALTER TABLE `balance_transfers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `bank_plans`
--
ALTER TABLE `bank_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `counters`
--
ALTER TABLE `counters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `dps_plans`
--
ALTER TABLE `dps_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `fdr_plans`
--
ALTER TABLE `fdr_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `fonts`
--
ALTER TABLE `fonts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `generalsettings`
--
ALTER TABLE `generalsettings`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `installment_logs`
--
ALTER TABLE `installment_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `kyc_forms`
--
ALTER TABLE `kyc_forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `loan_plans`
--
ALTER TABLE `loan_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `money_requests`
--
ALTER TABLE `money_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `other_banks`
--
ALTER TABLE `other_banks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pagesettings`
--
ALTER TABLE `pagesettings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `referral_bonuses`
--
ALTER TABLE `referral_bonuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `save_accounts`
--
ALTER TABLE `save_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `seotools`
--
ALTER TABLE `seotools`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `sitemaps`
--
ALTER TABLE `sitemaps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(191) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `socialsettings`
--
ALTER TABLE `socialsettings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `social_providers`
--
ALTER TABLE `social_providers`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `user_dps`
--
ALTER TABLE `user_dps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_fdrs`
--
ALTER TABLE `user_fdrs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_loans`
--
ALTER TABLE `user_loans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user_notifications`
--
ALTER TABLE `user_notifications`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `wire_transfers`
--
ALTER TABLE `wire_transfers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wire_transfer_banks`
--
ALTER TABLE `wire_transfer_banks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `withdraws`
--
ALTER TABLE `withdraws`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

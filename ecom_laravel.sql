-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2021 at 11:24 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', '$2y$10$P/LFWTxZ0n4xEKBC3ds16OH/KnvZcq5snxA8fLEODeYcLY5QOEi3u', '2021-02-20 07:31:01', '2021-02-20 07:31:01');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `banner_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `banner_name`, `banner_image`, `banner_link`, `created_at`, `updated_at`) VALUES
(1, 'MEN COLLECTION', 'banner_img_1630479240.jpg', NULL, '2021-09-01 01:24:00', '2021-09-01 01:24:00'),
(2, 'WRISTWATCH COLLECTION', 'banner_img_1630479287.jpg', NULL, '2021-09-01 01:24:47', '2021-09-01 01:24:47'),
(3, 'JEANS COLLECTION', 'banner_img_1630479362.jpg', NULL, '2021-09-01 01:26:02', '2021-09-01 01:26:02'),
(4, 'EXCLUSIVE SHOES', 'banner_img_1630479396.jpg', NULL, '2021-09-01 01:26:36', '2021-09-01 01:26:36');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand`, `image`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Maruti', 'pro_brand_1630315010.png', 1, '2021-08-23 06:30:42', '2021-08-30 03:46:50'),
(4, 'Hyundai', 'pro_brand_1630315001.png', 1, '2021-08-24 05:46:14', '2021-08-30 03:46:41'),
(5, 'Honda', 'pro_brand_1630315023.png', 1, '2021-08-30 03:47:03', '2021-08-30 03:47:27'),
(6, 'KTM', 'pro_brand_1630315034.png', 1, '2021-08-30 03:47:14', '2021-08-30 03:47:40'),
(7, 'Suzuki', 'pro_brand_1630315392.png', 1, '2021-08-30 03:53:12', '2021-08-30 03:53:12'),
(8, 'BMW', 'pro_brand_1630315453.png', 1, '2021-08-30 03:54:13', '2021-08-30 03:54:13');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` enum('Reg','Not-Reg') COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_attr_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parent_category_id` int(11) DEFAULT NULL,
  `category_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_home` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_slug`, `status`, `created_at`, `updated_at`, `parent_category_id`, `category_image`, `is_home`) VALUES
(2, 'Women', 'women', 1, '2021-08-12 03:23:20', '2021-09-01 04:23:00', NULL, 'cat_img_1630236707.jpg', '1'),
(3, 'Kids', 'kids', 1, '2021-08-12 03:29:36', '2021-09-01 04:15:44', NULL, 'cat_img_1630236802.jpg', '1'),
(4, 'Men', 'men', 1, '2021-08-12 06:17:22', '2021-09-01 04:15:37', NULL, 'cat_img_1630236751.jpg', '1'),
(5, 'Sports', 'sports', 1, '2021-08-12 06:43:09', '2021-08-29 06:04:19', NULL, 'cat_img_1630236859.png', '1'),
(7, 'Electornics', 'electronics', 1, '2021-08-12 07:49:06', '2021-09-01 04:02:10', NULL, 'cat_img_1630236984.png', '1');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sequence` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `color`, `sequence`, `status`, `created_at`, `updated_at`) VALUES
(1, 'red', 1, 1, '2021-08-13 06:33:09', '2021-08-13 06:33:09'),
(2, 'green', 2, 1, '2021-08-13 06:33:36', '2021-08-13 06:33:36');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `value` int(11) NOT NULL,
  `coupon_type` enum('Percent','Amount') COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_min_value` int(11) NOT NULL,
  `expire_date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_one_time` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `title`, `code`, `value`, `coupon_type`, `coupon_min_value`, `expire_date`, `status`, `created_at`, `updated_at`, `is_one_time`) VALUES
(2, 'febcoupon', 'ddvvd', 2, 'Percent', 2000, '2021-08-27', 1, '2021-08-13 03:42:00', '2021-08-13 05:52:50', 0),
(3, 'jancoupon', 'vee', 45, 'Amount', 2000, '2021-08-17', 1, '2021-08-13 03:43:13', '2021-08-24 01:14:58', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gstin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_verify` tinyint(11) NOT NULL DEFAULT 0,
  `rand_num` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_forget_password` tinyint(11) NOT NULL DEFAULT 0,
  `rand_forget_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `mobile`, `password`, `address`, `city`, `state`, `zip`, `company`, `gstin`, `status`, `is_verify`, `rand_num`, `is_forget_password`, `rand_forget_id`, `created_at`, `updated_at`) VALUES
(1, 'test1', 'test1@gmail.com', '1234567898', '$2y$10$6SkHEKPwoAz3Neff787x0OzUm77IpjR/HiWAz/LfUbqtXGlWCI4Ei', 'Q.no,deksha bhumi nagpur', 'Nagpur', 'Maharashtra', '44009', NULL, NULL, 1, 1, NULL, 0, '', NULL, NULL),
(2, 'test2', 'test2@gmail.com', '1234567897', '$2y$10$Hf48DVfZI9R7wmC7564AieIW1qbISkFaMzMcfLqKVRTiP7ZnycaQy', 'Q.no:91, Chocks Colony Kamptee Road Nagpur', 'Nagpur', 'Maharashtra', '440017', NULL, NULL, 1, 1, NULL, 0, '', NULL, NULL);

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
(1, '2021_02_20_064356_create_admins_table', 1),
(3, '2021_08_12_053102_create_categories_table', 2),
(4, '2021_08_13_053835_create_coupons_table', 3),
(5, '2021_08_13_080315_alter_table_coupons_change_expire_date', 4),
(6, '2021_08_13_104023_create_sizes_table', 5),
(7, '2021_08_13_114205_create_colors_table', 6),
(8, '2021_08_16_071555_create_products_table', 7),
(9, '2021_08_16_082633_add_slug_to_products', 8),
(10, '2021_08_16_083420_add_image_to_products', 9),
(11, '2021_08_18_085516_create_product_attrs_table', 10),
(14, '2021_08_18_101803_rename_image_in_product_attrs', 11),
(15, '2021_08_23_055715_create_productmulti_images_table', 12),
(17, '2021_08_23_102314_create_brands_table', 13),
(19, '2021_08_24_053549_add_multiple_column_to_products', 14),
(20, '2021_08_24_063302_add_is_one_time_to_coupons', 15),
(21, '2021_08_24_065438_add_parent_category_id_to_categories', 16),
(23, '2021_08_24_080503_create_taxes_table', 17),
(24, '2021_08_24_084900_remove_tax_type_from_products', 18),
(25, '2021_08_24_085322_alter_tax_to_products', 19),
(26, '2021_08_24_085754_remove_tax_from_products', 20),
(27, '2021_08_24_122301_create_customers_table', 21),
(28, '2021_08_29_094447_add_category_image_and_is_home_to_categories', 22),
(29, '2021_09_01_054332_create_banners_table', 23),
(30, '2021_09_03_053659_create_carts_table', 24);

-- --------------------------------------------------------

--
-- Table structure for table `productmulti_images`
--

CREATE TABLE `productmulti_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `products_id` int(11) NOT NULL,
  `multi_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `productmulti_images`
--

INSERT INTO `productmulti_images` (`id`, `products_id`, `multi_image`, `created_at`, `updated_at`) VALUES
(1, 17, 'pro_multi_img_867723216.jpg', NULL, NULL),
(4, 18, 'pro_multi_img_626660821.png', NULL, NULL),
(6, 19, 'pro_multi_img_266130060.png', NULL, NULL),
(7, 20, 'pro_multi_img_379963402.png', NULL, NULL),
(8, 21, 'pro_multi_img_453665489.png', NULL, NULL),
(9, 22, 'pro_multi_img_283870240.png', NULL, NULL),
(10, 23, 'pro_multi_img_878556696.png', NULL, NULL),
(11, 24, 'pro_multi_img_456580452.png', NULL, NULL),
(12, 25, 'pro_multi_img_980791766.png', NULL, NULL),
(13, 26, 'pro_multi_img_839922544.png', NULL, NULL),
(14, 27, 'pro_multi_img_970380323.png', NULL, NULL),
(15, 28, 'pro_multi_img_695490133.png', NULL, NULL),
(16, 29, 'pro_multi_img_710961947.png', NULL, NULL),
(17, 30, 'pro_multi_img_474725602.png', NULL, NULL),
(18, 31, 'pro_multi_img_610539906.png', NULL, NULL),
(19, 32, 'pro_multi_img_896770890.png', NULL, NULL),
(20, 33, 'pro_multi_img_179614185.png', NULL, NULL),
(21, 18, 'pro_multi_img_166599342.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_desc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `technical_specification` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uses` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warranty` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lead_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_promo` tinyint(1) NOT NULL DEFAULT 0,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_discounted` tinyint(1) NOT NULL DEFAULT 0,
  `is_tranding` tinyint(1) NOT NULL DEFAULT 0,
  `tax_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `product_name`, `brand`, `model`, `short_desc`, `desc`, `keywords`, `technical_specification`, `uses`, `warranty`, `status`, `created_at`, `updated_at`, `slug`, `image`, `lead_time`, `is_promo`, `is_featured`, `is_discounted`, `is_tranding`, `tax_id`) VALUES
(17, 3, 'jacket', '3', 'dx', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</p>', 1, '2021-08-23 06:38:32', '2021-08-31 02:38:49', 'jacket', 'pro_1630310303.jpg', '5 days', 0, 0, 1, 1, 2),
(18, 4, 'polo shirts', '3', 'dx', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</p>', 1, '2021-08-24 05:30:24', '2021-08-31 01:10:28', 'polo-shirts', 'pro_1630308856.png', '4 days', 0, 1, 1, 0, 1),
(19, 4, 'cotton tshirt', '4', 'dx', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>', 1, '2021-08-31 01:16:34', '2021-08-31 01:17:26', 'cotton-tshirt', 'pro_1630392394.png', '4 days', 0, 1, 0, 0, 1),
(20, 2, 'Culotte dress', '4', 'dx', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</p>', 1, '2021-08-31 01:21:10', '2021-08-31 01:22:43', 'culotte-dress', 'pro_1630392670.png', NULL, 0, 0, 1, 1, 2),
(21, 2, 'Kimono dress', '4', 'dx', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</p>', 1, '2021-08-31 01:25:45', '2021-08-31 01:26:54', 'kimono-dress', 'pro_1630392945.png', NULL, 0, 0, 1, 0, 2),
(22, 5, 'Acorn Sportswear', '4', 'dx', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', 1, '2021-08-31 01:31:04', '2021-08-31 01:31:04', 'acorn-sportswear', 'pro_1630393264.png', NULL, 0, 0, 0, 1, 2),
(23, 5, 'Sportswear Premier', '6', 'dx', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', 1, '2021-08-31 01:33:02', '2021-08-31 01:33:02', 'sportswear-premier', 'pro_1630393382.png', NULL, 0, 0, 0, 1, 1),
(24, 7, 'Canon', '5', 'dx', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', 1, '2021-08-31 01:36:26', '2021-08-31 01:36:26', 'canon', 'pro_1630393586.png', NULL, 0, 0, 0, 0, 2),
(25, 7, 'Nikon', '5', 'dx', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', 1, '2021-08-31 01:39:14', '2021-08-31 01:39:14', 'nikon', 'pro_1630393754.png', NULL, 0, 1, 0, 0, 2),
(26, 2, 'Shirtdress', '6', 'dx', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', 1, '2021-08-31 01:41:21', '2021-08-31 01:41:21', 'shirt-dress', 'pro_1630393881.png', NULL, 0, 0, 0, 0, 2),
(27, 2, 'Tutu dress', '5', 's', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', 1, '2021-08-31 01:44:31', '2021-08-31 01:44:31', 'tutu-dress', 'pro_1630394071.png', NULL, 0, 0, 0, 0, NULL),
(28, 5, 'Sportivity', '5', 'dx', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', 1, '2021-08-31 01:46:56', '2021-08-31 01:46:56', 'sportivity', 'pro_1630394216.png', NULL, 0, 0, 0, 0, 1),
(29, 5, 'Adidas Men\'s Glenn M Sneakers', '6', 'dx', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', 1, '2021-08-31 01:50:19', '2021-08-31 01:50:19', 'adidas-men-glenn-sneakers', 'pro_1630394419.png', NULL, 0, 0, 0, 0, 1),
(30, 7, 'Mike', '6', 'dx', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</p>', 1, '2021-08-31 01:57:06', '2021-08-31 02:18:58', 'mike', 'pro_1630394826.png', NULL, 0, 1, 0, 0, 1),
(31, 7, 'Colorfull Printer', '4', 'dx', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', 1, '2021-08-31 01:59:11', '2021-08-31 01:59:11', 'printer', 'pro_1630394951.png', NULL, 0, 0, 0, 0, 2),
(32, 4, 'Striped T-Shirt', '8', 'dx', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', 1, '2021-08-31 02:42:25', '2021-08-31 02:42:25', 'striped-t-shirt', 'pro_1630397545.png', NULL, 0, 0, 0, 0, 1),
(33, 4, 'Hooded T-Shirt.', '5', 'dx', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, </p>', 1, '2021-08-31 02:47:00', '2021-08-31 02:47:00', 'hooded-t-shirt', 'pro_1630397820.png', NULL, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_attrs`
--

CREATE TABLE `product_attrs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `products_id` int(11) DEFAULT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attr_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mrp` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `size_id` int(11) DEFAULT NULL,
  `color_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attrs`
--

INSERT INTO `product_attrs` (`id`, `products_id`, `sku`, `attr_image`, `mrp`, `price`, `qty`, `size_id`, `color_id`, `created_at`, `updated_at`) VALUES
(1, 17, '3456', 'pro_attr_160313413.jpg', 900, 2000, 2000, 4, 2, NULL, NULL),
(4, 18, '12349', 'pro_attr_983815217.png', 999, 2000, 2000, 3, 2, NULL, NULL),
(5, 18, '123', 'pro_attr_540282621.png', 1000, 2000, 2000, 4, 1, NULL, NULL),
(9, 19, '123', 'pro_attr_266130060.jpg', 800, 2000, 2000, 0, 0, NULL, NULL),
(10, 20, '34562', 'pro_attr_843405047.png', 1200, 2000, 1, 4, 0, NULL, NULL),
(11, 21, '5678', 'pro_attr_756840964.png', 2000, 2000, 0, 0, 2, NULL, NULL),
(12, 22, '1258', 'pro_attr_283870240.png', 2000, 2000, 2000, 6, 2, NULL, NULL),
(13, 23, '34214', 'pro_attr_878556696.png', 3000, 2000, 2000, 4, 0, NULL, NULL),
(14, 24, '125678', 'pro_attr_456580452.png', 3000, 2000, 2000, 0, 0, NULL, NULL),
(15, 25, '2334567', 'pro_attr_980791766.png', 23000, 2000, 2000, 0, 0, NULL, NULL),
(16, 26, '3456782', 'pro_attr_839922544.png', 2000, 2000, 0, 4, 2, NULL, NULL),
(17, 27, '67543', 'pro_attr_970380323.png', 5000, 2000, 2000, 3, 1, NULL, NULL),
(18, 28, '98064', 'pro_attr_695490133.png', 1235, 2000, 2000, 0, 1, NULL, NULL),
(19, 29, '45780', 'pro_attr_710961947.png', 3000, 2000, 2000, 0, 1, NULL, NULL),
(20, 30, '2345674', 'pro_attr_474725602.png', 3500, 2000, 2000, 0, 0, NULL, NULL),
(21, 31, '34678', 'pro_attr_610539906.png', 4000, 2000, 2000, 0, 0, NULL, NULL),
(22, 32, '23456723', 'pro_attr_896770890.png', 2000, 2000, 2000, 5, 1, NULL, NULL),
(23, 33, '3421456', 'pro_attr_179614185.png', 2000, 2000, 2000, 5, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `sale_code` varchar(255) DEFAULT NULL,
  `customers_id` int(11) DEFAULT NULL,
  `name` varchar(80) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` bigint(11) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zip` varchar(30) NOT NULL,
  `coupon_code` varchar(100) DEFAULT NULL,
  `coupon_value` int(11) DEFAULT NULL,
  `order_status` varchar(100) DEFAULT NULL,
  `txn_id` varchar(255) DEFAULT NULL,
  `payment_id` varchar(255) DEFAULT NULL,
  `payment_type` enum('COD','Gateway') DEFAULT NULL,
  `payment_status` varchar(100) DEFAULT NULL,
  `grand_total` int(11) DEFAULT NULL,
  `added_on` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `sale_code`, `customers_id`, `name`, `email`, `mobile`, `address`, `city`, `state`, `zip`, `coupon_code`, `coupon_value`, `order_status`, `txn_id`, `payment_id`, `payment_type`, `payment_status`, `grand_total`, `added_on`) VALUES
(11, '#20211222520748569', 1, 'piyush shyam', 'piyush6686@gmail.com', 1234567898, 'Q.no,deksha bhumi nagpur', 'Nagpur', 'Maharashtra', '44009', NULL, 0, '1', NULL, NULL, 'COD', 'Pending', 4000, '2021-12-22 16:10:05'),
(12, '#20211222313474927', 1, 'piyush shyam', 'piyush6686@gmail.com', 1234567898, 'Q.no,deksha bhumi nagpur', 'Nagpur', 'Maharashtra', '44009', 'vee', 45, '1', NULL, NULL, 'COD', 'Pending', 2955, '2021-12-22 17:32:13'),
(13, '#20211222664287577', 1, 'piyush shyam', 'piyush6686@gmail.com', 1234567898, 'Q.no,deksha bhumi nagpur', 'Nagpur', 'Maharashtra', '44009', 'ddvvd', 2, '1', NULL, NULL, 'COD', 'Pending', 2940, '2021-12-22 17:35:32'),
(14, '#20211222774720942', 1, 'piyush shyam', 'piyush6686@gmail.com', 1234567898, 'Q.no,deksha bhumi nagpur', 'Nagpur', 'Maharashtra', '44009', NULL, 0, '1', '11f278627b6b4c7e8b11e778e81aec70', 'MOJO1c22805A37778341', 'Gateway', 'Success', 4500, '2021-12-22 17:36:58'),
(15, '#20211222968720105', 1, 'piyush shyam', 'piyush6686@gmail.com', 1234567898, 'Q.no,deksha bhumi nagpur', 'Nagpur', 'Maharashtra', '44009', 'vee', 45, '1', '11cc88ed2c88473cb8712249fcc96c9f', 'MOJO1c22305A37778343', 'Gateway', 'Success', 8955, '2021-12-22 17:41:52'),
(16, '#20211222805419917', 1, 'piyush shyam', 'piyush6686@gmail.com', 1234567898, 'Q.no,deksha bhumi nagpur', 'Nagpur', 'Maharashtra', '44009', 'ddvvd', 2, '3', '31d63d75e8bb4fdebe85122a90001e39', 'MOJO1c22Q05A37778344', 'Gateway', 'Success', 13230, '2021-12-22 17:54:44'),
(17, '#20211223816612474', 1, 'piyush shyam', 'piyush6686@gmail.com', 1234567898, 'Q.no,deksha bhumi nagpur', 'Nagpur', 'Maharashtra', '44009', NULL, 0, '1', NULL, NULL, 'COD', 'Pending', 30000, '2021-12-23 14:28:15'),
(18, '#20211223406180549', 1, 'piyush shyam', 'piyush6686@gmail.com', 1234567898, 'Q.no,deksha bhumi nagpur', 'Nagpur', 'Maharashtra', '44009', 'ddvvd', 2, '1', NULL, NULL, 'COD', 'Pending', 46060, '2021-12-23 15:07:54'),
(19, '#20211223799849142', 1, 'piyush shyam', 'piyush6686@gmail.com', 1234567898, 'Q.no,deksha bhumi nagpur', 'Nagpur', 'Maharashtra', '44009', NULL, 0, '1', NULL, NULL, 'COD', 'Pending', 1400, '2021-12-23 19:12:05'),
(20, '#20211224928078153', 2, 'Rohit Ghodeswar', 'rohit@gmail.com', 1234567897, 'Q.no:91, Chocks Colony Kamptee Road Nagpur', 'Nagpur', 'Maharashtra', '440017', NULL, 0, '3', NULL, NULL, 'COD', 'Success', 2000, '2021-12-24 19:01:21'),
(21, '#20211226332254674', 1, 'piyush shyam', 'piyush6686@gmail.com', 1234567898, 'Q.no,deksha bhumi nagpur', 'Nagpur', 'Maharashtra', '44009', NULL, 0, '1', NULL, NULL, 'COD', 'Pending', 6000, '2021-12-26 12:55:04');

-- --------------------------------------------------------

--
-- Table structure for table `sales_status`
--

CREATE TABLE `sales_status` (
  `id` int(11) NOT NULL,
  `sales_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_status`
--

INSERT INTO `sales_status` (`id`, `sales_status`) VALUES
(1, 'Placed'),
(2, 'On The Way'),
(3, 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `sale_details`
--

CREATE TABLE `sale_details` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_attr_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale_details`
--

INSERT INTO `sale_details` (`id`, `sale_id`, `product_id`, `product_attr_id`, `price`, `qty`) VALUES
(11, 11, 21, 11, 1000, 4),
(12, 12, 21, 11, 1000, 3),
(13, 13, 21, 11, 1000, 3),
(14, 14, 27, 17, 4500, 1),
(15, 15, 27, 17, 4500, 2),
(16, 16, 27, 17, 4500, 3),
(17, 17, 20, 10, 1000, 6),
(18, 17, 26, 16, 1800, 10),
(19, 17, 21, 11, 1000, 6),
(20, 18, 20, 10, 1000, 3),
(21, 18, 27, 17, 4500, 8),
(22, 18, 21, 11, 1000, 8),
(23, 19, 19, 9, 700, 2),
(24, 20, 20, 10, 1000, 2),
(25, 21, 20, 10, 2000, 1),
(26, 21, 26, 16, 2000, 1),
(27, 21, 21, 11, 2000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sequence` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `size`, `sequence`, `status`, `created_at`, `updated_at`) VALUES
(2, 'S', 1, 1, '2021-08-13 05:47:22', '2021-08-13 05:47:22'),
(3, 'M', 2, 1, '2021-08-13 05:47:30', '2021-08-13 05:47:30'),
(4, 'L', 3, 1, '2021-08-13 05:50:02', '2021-08-13 05:50:02'),
(5, 'XL', 4, 1, '2021-08-13 05:50:19', '2021-08-13 05:50:19'),
(6, 'XXL', 5, 1, '2021-08-13 05:50:33', '2021-08-13 05:50:33'),
(7, 'XXXL', 6, 1, '2021-08-13 05:50:59', '2021-08-13 05:50:59');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tax_value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `tax_value`, `tax_desc`, `status`, `created_at`, `updated_at`) VALUES
(1, '18', 'GST 18%', 1, '2021-08-24 03:13:59', '2021-08-24 03:13:59'),
(2, '12', 'GST 12%', 1, '2021-08-24 03:54:25', '2021-08-24 03:54:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productmulti_images`
--
ALTER TABLE `productmulti_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_attrs`
--
ALTER TABLE `product_attrs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_status`
--
ALTER TABLE `sales_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_details`
--
ALTER TABLE `sale_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
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
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `productmulti_images`
--
ALTER TABLE `productmulti_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `product_attrs`
--
ALTER TABLE `product_attrs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sales_status`
--
ALTER TABLE `sales_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sale_details`
--
ALTER TABLE `sale_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

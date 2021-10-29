-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 29 2021 г., 15:23
-- Версия сервера: 10.1.38-MariaDB
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `laravelx`
--

-- --------------------------------------------------------

--
-- Структура таблицы `appoint-room-list`
--

CREATE TABLE `appoint-room-list` (
  `r_id` int(10) UNSIGNED NOT NULL,
  `r_host_name` varchar(88) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Host name',
  `r_room` varchar(88) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Host room number',
  `r_address` varchar(88) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Host address',
  `r_phone` varchar(46) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Host phone'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `appoint-room-list`
--

INSERT INTO `appoint-room-list` (`r_id`, `r_host_name`, `r_room`, `r_address`, `r_phone`) VALUES
(1, 'Alex Perez', '1', 'Kobenhaven, Gothersgade 93', '+380978786565'),
(2, ' Milan Heyboer', '2', 'Kobenhaven, Gothersgade 94', '+380978786565'),
(3, 'Mark Calvert', '3', 'Kobenhaven, Gothersgade 95', '+380978744565'),
(4, 'Torgeir Byrknes', '4', 'Kobenhaven, Gothersgade 96', '+380978786599'),
(5, 'Mark Caro', '5', 'Kobenhaven, Gothersgade 97', '+380978786538'),
(6, 'Edward Stein', '6', 'Kobenhaven, Gothersgade 98', '+380978786564');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 2),
(3, '2020_09_14_094310_create_wpress_blog_post_table', 2),
(4, '2020_09_14_120851_create_wpress_category_table', 2),
(5, '2020_10_15_082454_entrust_setup_tables', 3),
(27, '2020_11_21_165616_create_shop_categories_table', 4),
(47, '2020_11_21_165700_create_shop_simple_table', 5),
(48, '2020_11_21_171640_add_2_columns_to_shop_simple_table', 5),
(49, '2020_11_22_134043_create_shop_order_item_table', 6),
(50, '2020_11_22_135811_create_shop_orders_main_table', 6),
(51, '2020_11_22_142841_create_shop_transactions_table', 6),
(53, '2020_12_18_185947_create_shop_quantity_table', 7),
(54, '2021_01_20_182428_create_appoint_room-list_table', 8),
(55, '2021_02_16_195421_create_wpressImage_category_table', 9),
(56, '2021_02_16_195648_create_wpressImages_blog_post_table', 9),
(57, '2021_02_16_200932_create_wpressImage_imagesStocks_table', 10),
(58, '2021_04_27_144812_add_fb_id_column_in_users_table', 11),
(71, '2021_10_11_135908_create_polymorphic_users_table', 12),
(72, '2021_10_11_135916_create_polymorphic_posts_table', 12),
(73, '2021_10_11_135937_create_polymorphic_images_table', 12);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `polymorphic_images`
--

CREATE TABLE `polymorphic_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `url` varchar(77) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'image url',
  `imageable_id` int(11) DEFAULT NULL COMMENT 'column will contain the ID value of the post or user',
  `imageable_type` varchar(77) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'column will contain the class name of the parent model'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `polymorphic_images`
--

INSERT INTO `polymorphic_images` (`id`, `url`, `imageable_id`, `imageable_type`) VALUES
(1, '/images/polymorphic/copenn.jpg', 1, 'App\\Models\\Polymorphic\\Polymorphic_Posts'),
(2, '/images/polymorphic/copenn2.jpg', 1, 'App\\Models\\Polymorphic\\Polymorphic_Users'),
(3, '/images/polymorphic/copenn2.jpg', 3, 'App\\Models\\Polymorphic\\Polymorphic_Posts');

-- --------------------------------------------------------

--
-- Структура таблицы `polymorphic_posts`
--

CREATE TABLE `polymorphic_posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_name` varchar(77) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'post name',
  `post_text` text COLLATE utf8mb4_unicode_ci COMMENT 'post text',
  `author_id` int(10) UNSIGNED NOT NULL COMMENT 'Author Id from table (polymorphic_users) (ForeignKey)',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `polymorphic_posts`
--

INSERT INTO `polymorphic_posts` (`id`, `post_name`, `post_text`, `author_id`, `created_at`, `updated_at`) VALUES
(1, 'Post 1', 'Some Post 1\"s text goes here..', 1, '2021-10-29 12:21:51', NULL),
(2, 'Post 2', 'Some Post 2\"s text goes here..', 1, '2021-10-29 12:21:51', NULL),
(3, 'Post 3', 'Some Post 3\"s text goes here..', 1, '2021-10-29 12:21:51', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `polymorphic_users`
--

CREATE TABLE `polymorphic_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(77) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'user name'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `polymorphic_users`
--

INSERT INTO `polymorphic_users` (`id`, `user_name`) VALUES
(1, 'Polymorph User 1'),
(2, 'Polymorph User 2'),
(3, 'Polymorph User 3');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(12, 'owner', 'Project Owner', 'User is the owner of a given project', '2021-10-29 12:21:44', NULL),
(13, 'admin', 'User Administrator', 'User is allowed to manage and edit other users', '2021-10-29 12:21:44', NULL),
(14, 'manager', 'Company Manager', 'User is a manager of a Department', '2021-10-29 12:21:44', NULL),
(15, 'commander', 'custom role', 'Wing Commander', '2021-10-29 12:21:44', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(2, 13);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_categories`
--

CREATE TABLE `shop_categories` (
  `categ_id` int(10) UNSIGNED NOT NULL,
  `categ_name` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `shop_categories`
--

INSERT INTO `shop_categories` (`categ_id`, `categ_name`) VALUES
(1, 'Desktop'),
(2, 'Mobile'),
(3, 'Tablet'),
(4, 'Audio Pro');

-- --------------------------------------------------------

--
-- Структура таблицы `shop_orders_main`
--

CREATE TABLE `shop_orders_main` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `ord_uuid` varchar(222) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Unique ID',
  `ord_status` enum('proceeded','not-proceeded','delivered') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not-proceeded',
  `ord_sum` decimal(6,2) NOT NULL COMMENT 'General Order sum',
  `items_in_order` int(11) DEFAULT NULL COMMENT 'Quantity of different products in order',
  `ord_placed` timestamp NOT NULL DEFAULT '2020-12-10 09:12:32',
  `ord_user_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'User/Buyer Id, 0 if unlogged',
  `ord_name` varchar(42) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ord_address` varchar(77) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ord_email` varchar(42) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ord_phone` varchar(42) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `if_paid` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT 'If user paid the order',
  `payment_id` int(11) DEFAULT NULL COMMENT 'If paid Paypal etc payment ID',
  `delivery` enum('mail','self-take') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'mail'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `shop_order_item`
--

CREATE TABLE `shop_order_item` (
  `id` int(10) UNSIGNED NOT NULL,
  `fk_order_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'product Id from table shop_simple (ForeignKey)',
  `items_quantity` int(11) DEFAULT NULL COMMENT 'Quantity of this productd in order',
  `item_price` decimal(6,2) NOT NULL,
  `currency` varchar(42) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_buyer_id` int(11) DEFAULT NULL COMMENT 'User who bought, if unlogged will be null',
  `uuid` varchar(222) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Unique ID of order',
  `order_placed` timestamp NOT NULL DEFAULT '2020-12-10 09:12:31'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `shop_quantity`
--

CREATE TABLE `shop_quantity` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'product Id from table shop_simple (ForeignKey)',
  `all_quantity` int(11) DEFAULT NULL COMMENT 'All Quantity balance of this product in stock (will be ++)',
  `left_quantity` int(11) DEFAULT NULL COMMENT 'Quantity of this productd that left (will be --)',
  `all_updated` timestamp NOT NULL DEFAULT '2020-12-22 16:25:28' COMMENT 'when new amount arrived',
  `left_updated` timestamp NULL DEFAULT NULL COMMENT 'updated when when someones buy an item'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `shop_quantity`
--

INSERT INTO `shop_quantity` (`id`, `product_id`, `all_quantity`, `left_quantity`, `all_updated`, `left_updated`) VALUES
(1, 1, 200, 200, '2020-12-22 16:25:28', NULL),
(2, 2, 20, 20, '2020-12-22 16:25:28', NULL),
(3, 3, 10, 10, '2020-12-22 16:25:28', NULL),
(4, 4, 10, 10, '2020-12-22 16:25:28', NULL),
(5, 5, 10, 10, '2020-12-22 16:25:28', NULL),
(6, 6, 10, 10, '2020-12-22 16:25:28', NULL),
(7, 7, 10, 10, '2020-12-22 16:25:28', NULL),
(8, 8, 10, 10, '2020-12-22 16:25:28', NULL),
(9, 9, 10, 10, '2020-12-22 16:25:28', NULL),
(10, 10, 3, 3, '2020-12-22 16:25:28', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_simple`
--

CREATE TABLE `shop_simple` (
  `shop_id` int(10) UNSIGNED NOT NULL,
  `shop_title` varchar(82) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_image` varchar(222) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_price` decimal(6,2) NOT NULL,
  `shop_currency` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_descr` text COLLATE utf8mb4_unicode_ci,
  `shop_categ` int(10) UNSIGNED DEFAULT NULL,
  `shop_created_at` timestamp NOT NULL DEFAULT '2020-12-03 12:57:15',
  `sh_device_type` varchar(77) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `shop_simple`
--

INSERT INTO `shop_simple` (`shop_id`, `shop_title`, `shop_image`, `shop_price`, `shop_currency`, `shop_descr`, `shop_categ`, `shop_created_at`, `sh_device_type`) VALUES
(1, 'Canon EOS R', 'canon.jpg', '2354.16', '$', 'CANON EOS R, 30 Mpx. The EOS R is Canon\'s first full-frame mirrorless camera. It features a 30.3MP CMOS sensor with Dual Pixel AF and an ISO range of 100-40000 (expandable to 50-102400). The EOS R can record both 14-bit (CRW) and compressed (C-RAW) formats. It can shoot continuously at 8 fps in single AF and 5 fps with continuous AF', 1, '2020-12-03 12:57:15', 'Camera'),
(2, 'HP notebook 4530S', 'hp.jpg', '287.36', '$', 'HP 4530S, 4Gb Ram, 320Gb HDD. Outfitted with a 2.3-GHz Intel Core i5-2410M processor and 4GB of RAM, the HP ProBook 4530s offers solid performance. Equipped with a large 500GB hard drive spinning at a quick 7,200 rpm, the ProBook 4530s managed to fire up Windows 7 Professional in 58 seconds, 8 seconds faster than the average 15-inch notebook', 1, '2020-12-03 12:57:15', 'Notebook'),
(3, 'Iphone 3', 'iphone_3.jpg', '60.55', '$', 'TFT capacitive touchscreen, 3.5 inches, 16M colors, 2 Mpx', 1, '2020-12-03 12:57:15', 'LCD'),
(4, 'Iphone 5', 'iphone_5.jpg', '112.39', '$', 'Iphone 5 description......', 2, '2020-12-03 12:57:15', 'mobile'),
(5, 'Ipod', 'ipod_classic_3.jpg', '273.34', '$', 'Ipod description....', 2, '2020-12-03 12:57:15', 'mobile'),
(6, 'Samsung C27R500', 'samsung_sync.jpg', '257.64', '$', 'Samsung C27R500 27\'. FHD Curved Monitor with 1800R curvature and 3-sided bezel-less screen.', 3, '2020-12-03 12:57:15', 'TV'),
(7, 'Audio-Tech AT-LP120', 'turntable.jpg', '472.91', '$', 'The best starter turntable with all the features you\'ll ever need. This professional stereo turntable features a high-torque direct-drive motor for quick start-ups and a USB output that connects directly to your computer. Other features include: forward and reverse play capability; cast aluminum platter with slip mat and a start/stop button; three speeds 33/45/78; selectable high-accuracy quartz-controlled pitch lock and pitch change slider control with +/-10% or +/-20% adjustment ranges; and removable hinged dust cover. Mac and PC compatible Audacity software digitizes your LPs Direct drive high-torque motor. Stroboscopic platter speed indicator', 4, '2020-12-03 12:57:15', 'Turntable'),
(8, 'Behringer Vmx200', 'mixer.jpg', '169.36', '$', 'Professional 2-channel ultra-low noise DJ mixer with state-of-the-art phono preamps. Super-smooth, long-life ULTRAGLIDE faders (up to 500,000 cycles). 3-band kill EQ (-32 dB) and precise level meters with peak hold function', 4, '2020-12-03 12:57:15', 'Mixer'),
(9, 'Kington 16GB Flash', 'kingston.jpg', '3.35', '$', '16 GB Flash Drive. Convenient - small, capless and pocket-sized for easy transportability. Durable - metal casing with sturdy ring. USB Specification: USB 2.0,Guaranteed - five-year warranty', 1, '2020-12-03 12:57:15', 'Flash'),
(10, 'Pioneer DDJ-WEGO-K', 'wego.jpg', '351.69', '$', 'Ultra-compact and affordable DJ controller. Plug & Play with bundled Virtual DJ LE software. Pulse Control Provides Visual Prompts via Various Types of Illuminations Directly on the Unit. Multi-colored LED for customization of lights to match the user\'s style', 4, '2020-12-03 12:57:15', 'Controller');

-- --------------------------------------------------------

--
-- Структура таблицы `shop_transactions`
--

CREATE TABLE `shop_transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(42) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gross` decimal(6,2) NOT NULL COMMENT 'Total sum of order/transaction',
  `currency` varchar(42) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `order_placed` timestamp NOT NULL DEFAULT '2020-12-10 09:12:33',
  `status` varchar(42) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orderId` int(10) UNSIGNED DEFAULT NULL COMMENT 'Order Id from table {shop_orders_main} (ForeihnKey)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `username`, `phone`, `dob`, `image`, `created_at`, `updated_at`) VALUES
(73, 'Johnathon Braun', 'anabel05@berge.com', 'maureen74', '1-350-364-3220', '2011-01-08', 'a73afd64d7bbc9828750a384d05e2d7a.png', NULL, NULL),
(74, 'Alexis Kozey', 'maude19@gmail.com', 'logan.rutherford', '+1 (947) 866-1242', '1989-10-28', '899fda2c6cdcbf7ff15fa02582357090.png', NULL, NULL),
(75, 'Christian Wiza', 'tmarks@yahoo.com', 'russell.ortiz', '1-901-423-7352', '2012-04-30', 'aed82712ac1627b25f535e057fbf8328.png', NULL, NULL),
(76, 'Aidan Gerlach', 'kkuvalis@yahoo.com', 'valentine.harvey', '(828) 835-3790', '2020-07-22', 'bec79f99e3b85be24493fdb8c20564c4.png', NULL, NULL),
(77, 'Kevin Ondricka', 'destiney08@schulist.biz', 'sstiedemann', '+1-584-415-1741', '2006-08-12', '87953e20426cdb9cbd8fbc004601ebe1.png', NULL, NULL),
(78, 'Mr. Jayson Lemke', 'chaim.ward@hotmail.com', 'predovic.erling', '1-325-890-2131', '1993-03-01', '0586ad7ac7b965ee0af93cd36d6da5e8.png', NULL, NULL),
(79, 'Stephon Hansen', 'zterry@brakus.biz', 'medhurst.missouri', '614-670-1603', '2017-05-27', '80e88486fda584654a9aa15f1ca29582.png', NULL, NULL),
(80, 'Torrance Mayer', 'eldred.rodriguez@hotmail.com', 'wrohan', '+1-986-469-5256', '1976-08-04', '31b5b755a13b808c13828579138ad115.png', NULL, NULL),
(81, 'Jaleel Hansen', 'bechtelar.luciano@crist.biz', 'kemmer.evalyn', '+1 (886) 408-5958', '2020-11-07', '2184de125449fcb4203d754806ca6653.png', NULL, NULL),
(82, 'Bud Thiel', 'asia.ruecker@yahoo.com', 'ldaugherty', '+1-540-649-7733', '1980-10-14', 'd32535b83b13653023b837db33761df6.png', NULL, NULL),
(83, 'Mr. Markus Muller', 'eli06@hotmail.com', 'gene.reinger', '+15828347808', '1987-01-02', '4f44a2b958c0ab63c4cc00d3e6225842.png', NULL, NULL),
(84, 'Sherwood Friesen', 'augustus.mayer@gmail.com', 'dewayne63', '1-365-300-7479', '1994-08-15', 'f9446c1a76c7cccd195cee4e9778557a.png', NULL, NULL),
(85, 'Dr. Hadley O\'Connell IV', 'zjerde@dooley.net', 'balistreri.ismael', '+1-975-855-2315', '2017-09-06', '43f81a3c388b41187bb3a4a14fbe4bfd.png', NULL, NULL),
(86, 'Prof. Edgardo Mohr Jr.', 'schneider.brown@vonrueden.com', 'king92', '1-486-838-0905', '1993-08-07', 'f3bd13470b0cb691d3172ea616d31322.png', NULL, NULL),
(87, 'Baylee Stoltenberg', 'kstokes@gmail.com', 'marvin.emmalee', '+1.201.234.6002', '2010-01-26', '8359025d633ff19b316778e8522e0fd2.png', NULL, NULL),
(88, 'Moises Walter IV', 'bcrooks@rempel.info', 'maximo.kerluke', '602-351-7588', '1986-06-24', 'e12e650caf43702ad8967d1d9f1250ad.png', NULL, NULL),
(89, 'Mr. Ethel Bins IV', 'beaulah71@cummerata.com', 'alvera07', '+1.446.766.0229', '1983-06-29', '282ea2195eec15a32acff73c46f6f391.png', NULL, NULL),
(90, 'Billy Schumm II', 'garrett.torp@jacobs.org', 'jesse18', '262-438-9686', '2016-11-21', '063b19b03011612759840662aebb566b.png', NULL, NULL),
(91, 'Troy Effertz Jr.', 'seamus.quigley@spencer.com', 'marjolaine02', '1-790-631-1083', '2007-11-09', 'db08baceb8ff6e1fc1a04dfaff119e4f.png', NULL, NULL),
(92, 'Mr. Percival Kris', 'emelia.ryan@keeling.info', 'foster67', '970-549-0005', '2019-04-18', 'ed57b7284276df6e2df741af4699ebec.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fb_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `fb_id`) VALUES
(1, 'Admin', 'admin@ukr.net', '$2y$10$P8SdnwbIzPmMs.U.cAb4Ye33yNN/BM9ROwKRpu30ilK.mfJdRgrLW', NULL, NULL, NULL, NULL),
(2, 'Dima', 'dimmm931@gmail.com', '$2y$10$A29odjxhG2wjkyf3Z5Isou1hoasvtSlK5mZOzTGNQfcMX6KvnYE3u', NULL, NULL, NULL, NULL),
(3, 'Olya', 'olya@gmail.com', '$2y$10$TlrPmK87sszdumKLB93K9uUdsBYSANOWJYH6yqu.Vfh4C0C6e5wjG', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `wpressimages_blog_post`
--

CREATE TABLE `wpressimages_blog_post` (
  `wpBlog_id` int(10) UNSIGNED NOT NULL,
  `wpBlog_title` varchar(222) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wpBlog_text` text COLLATE utf8mb4_unicode_ci,
  `wpBlog_author` int(11) DEFAULT NULL,
  `wpBlog_created_at` timestamp NULL DEFAULT NULL,
  `wpBlog_category` int(11) DEFAULT NULL,
  `wpBlog_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `wpressimages_blog_post`
--

INSERT INTO `wpressimages_blog_post` (`wpBlog_id`, `wpBlog_title`, `wpBlog_text`, `wpBlog_author`, `wpBlog_created_at`, `wpBlog_category`, `wpBlog_status`) VALUES
(1, 'Aglae Tillman', 'I\'ve finished.\' So they got thrown out to her feet, for it flashed across her mind that she hardly knew what she did, she picked up a little bit of mushroom, and raised herself to about two feet.', 1, NULL, 4, '1'),
(2, 'Jerrell Hilpert', 'Alice kept her eyes anxiously fixed on it, or at least one of the officers of the shelves as she could. The next witness was the BEST butter, you know.\' \'And what an ignorant little girl or a.', 1, NULL, 1, '1'),
(3, 'Maribel Reichert', 'I was going on, as she did not seem to see what was the King; and as it was a long tail, certainly,\' said Alice, \'a great girl like you,\' (she might well say that \"I see what was on the floor, as it.', 1, NULL, 1, '1'),
(4, 'Carmela Grady', 'Fish-Footman was gone, and the roof off.\' After a minute or two, which gave the Pigeon the opportunity of showing off a head unless there was a very grave voice, \'until all the while, till at last.', 1, NULL, 1, '1'),
(5, 'Pinkie Gerhold', 'In the very middle of the pack, she could remember about ravens and writing-desks, which wasn\'t much. The Hatter shook his grey locks, \'I kept all my life!\' Just as she could, and soon found out a.', 1, NULL, 1, '1'),
(6, 'Asia Marquardt', 'Mouse, getting up and beg for its dinner, and all dripping wet, cross, and uncomfortable. The moment Alice felt that this could not stand, and she sat on, with closed eyes, and half of fright and.', 1, NULL, 2, '1'),
(7, 'Viola Wiza', 'Next came the guests, mostly Kings and Queens, and among them Alice recognised the White Rabbit hurried by--the frightened Mouse splashed his way through the glass, and she tried another question.', 1, NULL, 4, '1'),
(8, 'Ayla Cruickshank', 'The poor little juror (it was Bill, I fancy--Who\'s to go with Edgar Atheling to meet William and offer him the crown. William\'s conduct at first was in March.\' As she said to Alice, very loudly and.', 1, NULL, 2, '1'),
(9, 'Howard Boehm', 'Who ever saw one that size? Why, it fills the whole thing very absurd, but they began running when they arrived, with a pair of the garden, where Alice could not help thinking there MUST be more to.', 1, NULL, 3, '1'),
(10, 'Kenya Stehr', 'Pigeon in a melancholy air, and, after folding his arms and frowning at the White Rabbit interrupted: \'UNimportant, your Majesty means, of course,\' said the Hatter: \'let\'s all move one place on.\' He.', 1, NULL, 5, '1'),
(11, 'Adela Prosacco', 'And she squeezed herself up and down, and the March Hare moved into the sky. Twinkle, twinkle--\"\' Here the Queen furiously, throwing an inkstand at the corners: next the ten courtiers; these were.', 1, NULL, 5, '1'),
(12, 'Miss Maryam Runte DDS', 'And how odd the directions will look! ALICE\'S RIGHT FOOT, ESQ. HEARTHRUG, NEAR THE FENDER, (WITH ALICE\'S LOVE). Oh dear, what nonsense I\'m talking!\' Just then she heard it say to this: so she went.', 1, NULL, 3, '1'),
(13, 'Lucas King', 'Alice called out to sea as you might do something better with the edge of her age knew the name \'Alice!\' CHAPTER XII. Alice\'s Evidence \'Here!\' cried Alice, quite forgetting that she did not at all.', 1, NULL, 3, '1'),
(14, 'Alvena Russel', 'Hatter, it woke up again as quickly as she went on just as she spoke. (The unfortunate little Bill had left off quarrelling with the game,\' the Queen ordering off her knowledge, as there seemed to.', 1, NULL, 2, '1'),
(15, 'Prof. Sydnie West Sr.', 'Alice: \'she\'s so extremely--\' Just then she noticed a curious dream!\' said Alice, whose thoughts were still running on the same as they would call after her: the last word with such a noise inside.', 1, NULL, 2, '1'),
(16, 'Mr. Milo Rohan', 'Mock Turtle interrupted, \'if you don\'t like them!\' When the procession came opposite to Alice, flinging the baby was howling so much frightened that she tipped over the edge with each hand. \'And now.', 1, NULL, 3, '1'),
(17, 'Ms. Aurelie Emmerich', 'NOT marked \'poison,\' so Alice went on, \'What HAVE you been doing here?\' \'May it please your Majesty,\' he began. \'You\'re a very difficult question. However, at last came a rumbling of little animals.', 1, NULL, 3, '1'),
(18, 'Amani Ortiz', 'Lobster; I heard him declare, \"You have baked me too brown, I must go by the Queen added to one of them with one finger pressed upon its forehead (the position in which case it would be of very.', 1, NULL, 2, '1'),
(19, 'Dr. Zion Hane', 'Hatter was the matter worse. You MUST have meant some mischief, or else you\'d have signed your name like an honest man.\' There was not here before,\' said Alice,) and round goes the clock in a very.', 1, NULL, 4, '1'),
(20, 'Mr. Emil Streich', 'Arithmetic--Ambition, Distraction, Uglification, and Derision.\' \'I never could abide figures!\' And with that she might as well be at school at once.\' However, she soon made out that part.\' \'Well, at.', 1, NULL, 5, '1');

-- --------------------------------------------------------

--
-- Структура таблицы `wpressimage_category`
--

CREATE TABLE `wpressimage_category` (
  `wpCategory_id` int(10) UNSIGNED NOT NULL,
  `wpCategory_name` varchar(77) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `wpressimage_category`
--

INSERT INTO `wpressimage_category` (`wpCategory_id`, `wpCategory_name`, `created_at`, `updated_at`) VALUES
(1, 'News', NULL, NULL),
(2, 'Art', NULL, NULL),
(3, 'Sport', NULL, NULL),
(4, 'Geeks', NULL, NULL),
(5, 'Drops', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `wpressimage_imagesstock`
--

CREATE TABLE `wpressimage_imagesstock` (
  `wpImStock_id` int(10) UNSIGNED NOT NULL,
  `wpImStock_name` varchar(77) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wpImStock_postID` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `wpressimage_imagesstock`
--

INSERT INTO `wpressimage_imagesstock` (`wpImStock_id`, `wpImStock_name`, `wpImStock_postID`, `created_at`, `updated_at`) VALUES
(277, 'e28eec601092dfc61aeaa2147966c776.png', 3, NULL, NULL),
(278, 'b96f753ebfe4311831f22d6832aa5775.png', 13, NULL, NULL),
(279, 'eec808fbfdcf43ef274489c99851c8da.png', 20, NULL, NULL),
(280, '0e68834c63ebae9560f14a7d50959706.png', 7, NULL, NULL),
(281, '2428b22c2a339a7e4b36edb4ba668458.png', 1, NULL, NULL),
(282, '4702a3eacea4045ac04108a3afd98c73.png', 10, NULL, NULL),
(283, 'b4ee595e24bab3cb6212a174f457b61b.png', 19, NULL, NULL),
(284, 'e613ca75fac691d13f80fc01f16cc4b1.png', 4, NULL, NULL),
(285, 'cb472baa272e41fb420c341103499bce.png', 5, NULL, NULL),
(286, '50bf95e7075af687810af1adc2cc5d82.png', 18, NULL, NULL),
(287, 'acb09350536b07bde4e28a579287ee1b.png', 2, NULL, NULL),
(288, 'f6f5e0644e4c94bcd6011c94730ebda2.png', 4, NULL, NULL),
(289, '2c3b9c8a2621e2ae8a9ce6eb71e76014.png', 3, NULL, NULL),
(290, 'd96cf9d35005b3b44d56aa6613b29f7b.png', 17, NULL, NULL),
(291, '4543160b3e5c48aca09325eb2ffb0ac4.png', 5, NULL, NULL),
(292, 'cf033f6c0fef3136d18be36d17cc7cca.png', 19, NULL, NULL),
(293, '42d70eeb6becb5cc53aa6f092eb1c341.png', 7, NULL, NULL),
(294, 'a47c611df2cc3c2f1726cd56de490408.png', 20, NULL, NULL),
(295, 'b98196e0530396fb98a4442606a5591e.png', 9, NULL, NULL),
(296, '9bf1d4e02f209ebcde3db2ab5066a95c.png', 18, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `wpress_blog_post`
--

CREATE TABLE `wpress_blog_post` (
  `wpBlog_id` int(10) UNSIGNED NOT NULL,
  `wpBlog_title` varchar(222) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wpBlog_text` text COLLATE utf8mb4_unicode_ci,
  `wpBlog_author` int(11) DEFAULT NULL,
  `wpBlog_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `wpBlog_category` int(11) DEFAULT NULL,
  `wpBlog_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `wpress_blog_post`
--

INSERT INTO `wpress_blog_post` (`wpBlog_id`, `wpBlog_title`, `wpBlog_text`, `wpBlog_author`, `wpBlog_created_at`, `wpBlog_category`, `wpBlog_status`) VALUES
(276, 'Setting  Enum in PhpMyAdmin', 'Setting  Enum in SQL\r\nunder your phpmyadmin\r\n\r\nchoose enum\r\n\r\nin Length/Values column put there : \'\'0\'\' ,\'\'1\'\'\r\n\r\nand your done ', 1, '2021-10-29 12:21:43', 1, '1'),
(277, 'Milgram experiment', 'The Milgram experiment on obedience to authority figures was a series of social psychology experiments conducted by Yale University psychologist Stanley Milgram. They measured the willingness of study participants, men from a diverse range of occupations with varying levels of education, to obey an authority figure who instructed them to perform acts conflicting with their personal conscience. Participants were led to believe that they were assisting an unrelated experiment, in which they had to administer electric shocks to a \"learner.\" These fake electric shocks gradually increased to levels that would have been fatal had they been real', 1, '2021-10-29 12:21:43', 3, '1'),
(278, 'Milgram results', 'The extreme willingness of adults to go to almost any lengths on the command of an authority constitutes the chief finding of the study and the fact most urgently demanding explanation.\\r\\n\\r\\nOrdinary people, simply doing their jobs, and without any particular hostility on their part, can become agents in a terrible destructive process. Moreover, even when the destructive effects of their work become patently clear, and they are asked to carry out actions incompatible with fundamental standards of morality, relatively few people have the resources needed to resist authority', 1, '2021-10-29 12:21:43', 1, '1'),
(279, 'Hygge', 'Hygge is a Danish and Norwegian word for a mood of coziness and comfortable conviviality with feelings of wellness and contentment. As a cultural category with its sets of associated practices hygge has more or less the same meanings in Danish and Norwegian, but the notion is more central in Denmark than in Norway. The emphasis on hygge as a core part of Danish culture is a recent phenomenon, dating to the late 20th century.', 1, '2021-10-29 12:21:43', 2, '1');

-- --------------------------------------------------------

--
-- Структура таблицы `wpress_category`
--

CREATE TABLE `wpress_category` (
  `wpCategory_id` int(10) UNSIGNED NOT NULL,
  `wpCategory_name` varchar(77) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `wpress_category`
--

INSERT INTO `wpress_category` (`wpCategory_id`, `wpCategory_name`, `created_at`, `updated_at`) VALUES
(1, 'General', NULL, NULL),
(2, 'Science', NULL, NULL),
(3, 'Tips and Tricks', NULL, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `appoint-room-list`
--
ALTER TABLE `appoint-room-list`
  ADD PRIMARY KEY (`r_id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Индексы таблицы `polymorphic_images`
--
ALTER TABLE `polymorphic_images`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `polymorphic_posts`
--
ALTER TABLE `polymorphic_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `polymorphic_posts_author_id_foreign` (`author_id`);

--
-- Индексы таблицы `polymorphic_users`
--
ALTER TABLE `polymorphic_users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Индексы таблицы `shop_categories`
--
ALTER TABLE `shop_categories`
  ADD PRIMARY KEY (`categ_id`);

--
-- Индексы таблицы `shop_orders_main`
--
ALTER TABLE `shop_orders_main`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `shop_orders_main_ord_user_id_foreign` (`ord_user_id`);

--
-- Индексы таблицы `shop_order_item`
--
ALTER TABLE `shop_order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shop_order_item_product_id_foreign` (`product_id`);

--
-- Индексы таблицы `shop_quantity`
--
ALTER TABLE `shop_quantity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shop_quantity_product_id_foreign` (`product_id`);

--
-- Индексы таблицы `shop_simple`
--
ALTER TABLE `shop_simple`
  ADD PRIMARY KEY (`shop_id`),
  ADD KEY `shop_simple_shop_categ_foreign` (`shop_categ`);

--
-- Индексы таблицы `shop_transactions`
--
ALTER TABLE `shop_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shop_transactions_orderid_foreign` (`orderId`);

--
-- Индексы таблицы `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `wpressimages_blog_post`
--
ALTER TABLE `wpressimages_blog_post`
  ADD PRIMARY KEY (`wpBlog_id`);

--
-- Индексы таблицы `wpressimage_category`
--
ALTER TABLE `wpressimage_category`
  ADD PRIMARY KEY (`wpCategory_id`);

--
-- Индексы таблицы `wpressimage_imagesstock`
--
ALTER TABLE `wpressimage_imagesstock`
  ADD PRIMARY KEY (`wpImStock_id`);

--
-- Индексы таблицы `wpress_blog_post`
--
ALTER TABLE `wpress_blog_post`
  ADD PRIMARY KEY (`wpBlog_id`);

--
-- Индексы таблицы `wpress_category`
--
ALTER TABLE `wpress_category`
  ADD PRIMARY KEY (`wpCategory_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `appoint-room-list`
--
ALTER TABLE `appoint-room-list`
  MODIFY `r_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT для таблицы `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `polymorphic_images`
--
ALTER TABLE `polymorphic_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `polymorphic_posts`
--
ALTER TABLE `polymorphic_posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `polymorphic_users`
--
ALTER TABLE `polymorphic_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `shop_categories`
--
ALTER TABLE `shop_categories`
  MODIFY `categ_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `shop_orders_main`
--
ALTER TABLE `shop_orders_main`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `shop_order_item`
--
ALTER TABLE `shop_order_item`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `shop_quantity`
--
ALTER TABLE `shop_quantity`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `shop_simple`
--
ALTER TABLE `shop_simple`
  MODIFY `shop_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `shop_transactions`
--
ALTER TABLE `shop_transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `wpressimages_blog_post`
--
ALTER TABLE `wpressimages_blog_post`
  MODIFY `wpBlog_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `wpressimage_category`
--
ALTER TABLE `wpressimage_category`
  MODIFY `wpCategory_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `wpressimage_imagesstock`
--
ALTER TABLE `wpressimage_imagesstock`
  MODIFY `wpImStock_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=297;

--
-- AUTO_INCREMENT для таблицы `wpress_blog_post`
--
ALTER TABLE `wpress_blog_post`
  MODIFY `wpBlog_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=280;

--
-- AUTO_INCREMENT для таблицы `wpress_category`
--
ALTER TABLE `wpress_category`
  MODIFY `wpCategory_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `polymorphic_posts`
--
ALTER TABLE `polymorphic_posts`
  ADD CONSTRAINT `polymorphic_posts_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `polymorphic_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `shop_orders_main`
--
ALTER TABLE `shop_orders_main`
  ADD CONSTRAINT `shop_orders_main_ord_user_id_foreign` FOREIGN KEY (`ord_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `shop_order_item`
--
ALTER TABLE `shop_order_item`
  ADD CONSTRAINT `shop_order_item_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `shop_simple` (`shop_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `shop_quantity`
--
ALTER TABLE `shop_quantity`
  ADD CONSTRAINT `shop_quantity_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `shop_simple` (`shop_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `shop_simple`
--
ALTER TABLE `shop_simple`
  ADD CONSTRAINT `shop_simple_shop_categ_foreign` FOREIGN KEY (`shop_categ`) REFERENCES `shop_categories` (`categ_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `shop_transactions`
--
ALTER TABLE `shop_transactions`
  ADD CONSTRAINT `shop_transactions_orderid_foreign` FOREIGN KEY (`orderId`) REFERENCES `shop_orders_main` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

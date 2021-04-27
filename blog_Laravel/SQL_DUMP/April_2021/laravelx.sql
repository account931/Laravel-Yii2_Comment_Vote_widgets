-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 27 2021 г., 16:29
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
(58, '2021_04_27_144812_add_fb_id_column_in_users_table', 11);

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
(12, 'owner', 'Project Owner', 'User is the owner of a given project', '2021-02-18 12:29:38', NULL),
(13, 'admin', 'User Administrator', 'User is allowed to manage and edit other users', '2021-02-18 12:29:38', NULL),
(14, 'manager', 'Company Manager', 'User is a manager of a Department', '2021-02-18 12:29:38', NULL),
(15, 'commander', 'custom role', 'Wing Commander', '2021-02-18 12:29:38', NULL);

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

--
-- Дамп данных таблицы `shop_orders_main`
--

INSERT INTO `shop_orders_main` (`order_id`, `ord_uuid`, `ord_status`, `ord_sum`, `items_in_order`, `ord_placed`, `ord_user_id`, `ord_name`, `ord_address`, `ord_email`, `ord_phone`, `if_paid`, `payment_id`, `delivery`) VALUES
(1, 'sh-1614533704-0707db', 'not-proceeded', '20.10', 1, '2021-02-28 16:35:34', 2, 'Dima', 'Kyiv Ukraine', 'dimmm931@gmail.com', '+3809766765', '0', NULL, 'mail'),
(2, 'sh-1614784785-e4a4b9', 'not-proceeded', '2384.65', 2, '2021-03-03 14:20:08', 2, 'Dima', 'Kyiv Ukraine', 'dimmm931@gmail.com', '+3809766765', '0', NULL, 'mail'),
(3, 'sh-1617034529-b58080', 'not-proceeded', '811.63', 2, '2021-03-29 16:16:20', 2, 'Dima', 'Copenhagen, Kombagergade', 'dimmm931@gmail.com', '+3809766765', '0', NULL, 'mail'),
(4, 'sh-1617034999-413834', 'not-proceeded', '811.63', 2, '2021-03-29 16:23:37', 2, 'Dima', 'Copenhagen, Kombagergade', 'dimmm931@gmail.com', '+3809766765', '0', NULL, 'mail');

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

--
-- Дамп данных таблицы `shop_order_item`
--

INSERT INTO `shop_order_item` (`id`, `fk_order_id`, `product_id`, `items_quantity`, `item_price`, `currency`, `user_buyer_id`, `uuid`, `order_placed`) VALUES
(1, 1, 9, 6, '3.35', '$', NULL, NULL, '2020-12-10 09:12:31'),
(2, 2, 9, 6, '3.35', '$', NULL, NULL, '2020-12-10 09:12:31'),
(3, 2, 7, 5, '472.91', '$', NULL, NULL, '2020-12-10 09:12:31'),
(4, 3, 7, 1, '472.91', '$', NULL, NULL, '2020-12-10 09:12:31'),
(5, 3, 8, 2, '169.36', '$', NULL, NULL, '2020-12-10 09:12:31'),
(6, 4, 7, 1, '472.91', '$', NULL, NULL, '2020-12-10 09:12:31'),
(7, 4, 8, 2, '169.36', '$', NULL, NULL, '2020-12-10 09:12:31');

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
(1, 'Admin', 'admin@ukr.net', '$2y$10$V0jWOjBsR9GRkVRhtYyzU.wKyFWHXckpBD.BTuOMbHa/I5IprO6NO', NULL, NULL, NULL, NULL),
(2, 'Dima', 'dimmm931@gmail.com', '$2y$10$UeSnJ9rx8/uWEawbbz9CY.rV7IIqpTLJoTbKSDDevKtWuXt6.ljHa', 'zCEOYBdmhvl55GKc9Kj6F2lTaoS3Vbm1VOR1joz4OXtgcUY9xyLEKc0MVVvM', NULL, NULL, NULL),
(3, 'Olya', 'olya@gmail.com', '$2y$10$MaJT.ur/b39JD7b420so7.zwy/lHEfCg034tPj112lACWFlYGx2qi', NULL, NULL, NULL, NULL),
(4, 'Николай Нестеров', 'account931@ukr.net', 'eyJpdiI6IkdKZTFKYjQ2RkRVMm9yeWRNWk1TNEE9PSIsInZhbHVlIjoiR3QxSHIxazlydCtZRHBOcVJoVjJRdENQRDlIcG5nSjQ3WW5YZURVSWorST0iLCJtYWMiOiIzZTU5MDFkYWJkODVlN2MzM2E3ZDI2MTZlMjc0NzE0N2FhZmRmMmM0MTM5ZWI3NmFjMzdmZjZmMzU2NjUzYzY4In0=', 'QsA0iIDj0Rwg3ffyAlTfWpLjnVNYwstRaNW7CQInDae2NDmia0kwjN9AYcRt', '2021-04-27 12:30:21', '2021-04-27 12:30:21', '531255411613763');

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
(1, 'Guadalupe Runolfsdottir', 'After a time there were a Duck and a large rabbit-hole under the sea,\' the Gryphon repeated impatiently: \'it begins \"I passed by his face only, she would catch a bad cold if she was quite pleased to.', 1, '2021-02-16 17:18:36', 1, '1'),
(3, 'Reed Parisian', 'Dormouse go on with the Queen,\' and she heard her voice sounded hoarse and strange, and the baby with some curiosity. \'What a curious feeling!\' said Alice; \'you needn\'t be so stingy about it, even.', 1, '2021-02-16 17:18:36', 2, '1'),
(4, 'Ms. Alisa Kuphal', 'The King looked anxiously at the end.\' \'If you please, sir--\' The Rabbit started violently, dropped the white kid gloves: she took up the fan and the Dormouse crossed the court, arm-in-arm with the.', 1, '2021-02-16 17:18:36', 4, '1'),
(5, 'Einar Wintheiser Sr.', 'Which way?\', holding her hand in her brother\'s Latin Grammar, \'A mouse--of a mouse--to a mouse--a mouse--O mouse!\') The Mouse gave a sudden burst of tears, but said nothing. \'This here young lady,\'.', 1, '2021-02-16 17:18:36', 4, '1'),
(6, 'Gordon Kiehn I', 'Alice indignantly. \'Let me alone!\' \'Serpent, I say again!\' repeated the Pigeon, but in a game of croquet she was looking for them, but they all quarrel so dreadfully one can\'t hear oneself.', 1, '2021-02-16 17:18:36', 3, '1'),
(7, 'Johan Mayert Sr.', 'Mock Turtle: \'nine the next, and so on.\' \'What a pity it wouldn\'t stay!\' sighed the Lory, with a whiting. Now you know.\' It was, no doubt: only Alice did not dare to laugh; and, as a drawing of a.', 1, '2021-02-16 17:18:36', 2, '1'),
(8, 'Prof. Leonardo Gleason', 'I\'ll have you executed.\' The miserable Hatter dropped his teacup instead of onions.\' Seven flung down his cheeks, he went on without attending to her; \'but those serpents! There\'s no pleasing them!\'.', 1, '2021-02-16 17:18:36', 3, '1'),
(9, 'Dr. Osbaldo Osinski', 'THIS size: why, I should have liked teaching it tricks very much, if--if I\'d only been the right size, that it made no mark; but he could go. Alice took up the fan and a large pigeon had flown into.', 1, '2021-02-16 17:18:36', 4, '1'),
(10, 'Dr. Willow Hettinger DDS', 'I can\'t show it you myself,\' the Mock Turtle with a large dish of tarts upon it: they looked so grave that she looked up, and there stood the Queen till she was as much right,\' said the Mouse. \'--I.', 1, '2021-02-16 17:18:36', 2, '1'),
(11, 'Lysanne Feeney', 'While the Panther were sharing a pie--\' [later editions continued as follows When the pie was all dark overhead; before her was another long passage, and the executioner went off like an arrow. The.', 1, '2021-02-16 17:18:36', 5, '1'),
(12, 'Mr. Keegan Willms I', 'Gryphon. \'It\'s all her life. Indeed, she had not gone (We know it to half-past one as long as it spoke. \'As wet as ever,\' said Alice thoughtfully: \'but then--I shouldn\'t be hungry for it, he was in.', 1, '2021-02-16 17:18:36', 4, '1'),
(13, 'Dr. Jerome Larkin', 'King. Here one of them didn\'t know it to his son, \'I feared it might end, you know,\' said Alice in a tone of great relief. \'Call the next moment a shower of little Alice was silent. The Dormouse.', 1, '2021-02-16 17:18:36', 3, '1'),
(14, 'Dr. Pearline Schaden II', 'I say,\' the Mock Turtle. \'Hold your tongue!\' added the March Hare. Visit either you like: they\'re both mad.\' \'But I don\'t remember where.\' \'Well, it must be getting home; the night-air doesn\'t suit.', 1, '2021-02-16 17:18:36', 4, '1'),
(15, 'Roel Cronin V', 'King. Here one of the sort. Next came an angry tone, \'Why, Mary Ann, and be turned out of the Nile On every golden scale! \'How cheerfully he seems to suit them!\' \'I haven\'t the slightest idea,\' said.', 1, '2021-02-16 17:18:36', 1, '1'),
(16, 'Lee Aufderhar I', 'March Hare,) \'--it was at the door-- Pray, what is the same age as herself, to see what this bottle was NOT marked \'poison,\' so Alice ventured to taste it, and very soon came upon a heap of sticks.', 1, '2021-02-16 17:18:36', 2, '1'),
(17, 'Tommie Hartmann', 'William\'s conduct at first she thought it must make me larger, it must be growing small again.\' She got up very carefully, with one eye; but to get her head in the morning, just time to go, for the.', 1, '2021-02-16 17:18:36', 5, '1'),
(18, 'Dr. Thaddeus Spinka DDS', 'Alice added as an explanation; \'I\'ve none of them at last, they must be a lesson to you to sit down without being invited,\' said the Queen, and Alice, were in custody and under sentence of.', 1, '2021-02-16 17:18:36', 1, '1'),
(19, 'Garland Steuber', 'Alice, and she had felt quite unhappy at the stick, running a very hopeful tone though), \'I won\'t interrupt again. I dare say you never tasted an egg!\' \'I HAVE tasted eggs, certainly,\' said Alice.', 1, '2021-02-16 17:18:36', 1, '1'),
(20, 'Leonard Rodriguez', 'I don\'t care which happens!\' She ate a little recovered from the roof. There were doors all round the court and got behind him, and very soon came upon a little before she gave one sharp kick, and.', 1, '2021-02-16 17:18:36', 4, '1'),
(21, 'Ricardo Dare', 'So you see, so many lessons to learn! No, I\'ve made up my mind about it; and while she was to get out again. Suddenly she came upon a little different. But if I\'m Mabel, I\'ll stay down here with me!.', 1, '2021-02-16 17:18:36', 5, '1'),
(29, 'Test 333', 'Testtttttttt', 2, '2021-02-16 17:18:36', 5, '1'),
(30, 'Testdfdfdf666', 'ccdcxcx', 2, '2021-02-16 17:18:36', 5, '1'),
(31, 'Final test', 'Final test', 2, NULL, 5, '1');

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
(21, '934e4fafdab6bd58c8637cfed4672dc5.png', 17, NULL, NULL),
(22, '9b99a27680322c2180dc124bda6748e5.png', 21, NULL, NULL),
(23, '3d7b3e0dd4cc3be35bcd3a4d64aa7d35.png', 19, NULL, NULL),
(24, 'b736dbfa4b39babac603d557d4f3fee2.png', 3, NULL, NULL),
(25, '2dd40cc4e30b70b5909611be0d8d4acf.png', 16, NULL, NULL),
(26, 'f241ec5275fee94b12c6587a3adfccd4.png', 11, NULL, NULL),
(27, '00240b198af3e9dd1828ec5d10094b18.png', 15, NULL, NULL),
(28, '6aff8f85ea9c006f00b738311c4c34fd.png', 14, NULL, NULL),
(29, '81853121746f4d7fd1969019ca780926.png', 12, NULL, NULL),
(30, 'e378bcb45f70abbe1259c4596a6e69fc.png', 4, NULL, NULL),
(31, '5a77182505c0975f30f871144b29a424.png', 16, NULL, NULL),
(32, '68ae41bd157ee2c53e2b05f46684f38c.png', 9, NULL, NULL),
(33, '495eeb8b4f5649462909073c0e6d2d19.png', 15, NULL, NULL),
(34, '052a689a16eb52a17c996541172507f1.png', 17, NULL, NULL),
(35, 'a3a1b31fc3d01305475814080d42f921.png', 12, NULL, NULL),
(36, 'fbd77c154d226afe9046c7ad1c7edb20.png', 21, NULL, NULL),
(37, 'aad348fc82b7169584004979abea8392.png', 21, NULL, NULL),
(38, 'b564efe992e1bc1c95db2e12f5aba5b5.png', 5, NULL, NULL),
(39, 'b5174421f408bd9e32061dcd7631f9c3.png', 12, NULL, NULL),
(40, '7fef5a3d674ca4a99a11a47fffc31bce.png', 15, NULL, NULL),
(51, '1614531194_2254.png', 29, '2021-02-28 15:53:14', '2021-02-28 15:53:14'),
(52, '1614602109_2254.png', 30, '2021-03-01 11:35:09', '2021-03-01 11:35:09'),
(53, '1614602109_bmw_logo_PNG19709.png', 30, '2021-03-01 11:35:09', '2021-03-01 11:35:09'),
(54, '1614602915_2254.png', 31, '2021-03-01 11:48:35', '2021-03-01 11:48:35'),
(55, '1614602915_cph.jpg', 31, '2021-03-01 11:48:35', '2021-03-01 11:48:35'),
(56, '1614602915_bmw_logo_PNG19709.png', 31, '2021-03-01 11:48:35', '2021-03-01 11:48:35');

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
(228, 'Setting  Enum in PhpMyAdmin', 'Setting  Enum in SQL\r\nunder your phpmyadmin\r\n\r\nchoose enum\r\n\r\nin Length/Values column put there : \'\'0\'\' ,\'\'1\'\'\r\n\r\nand your done ', 1, '2021-02-18 13:29:37', 1, '1'),
(229, 'Milgram experiment', 'The Milgram experiment on obedience to authority figures was a series of social psychology experiments conducted by Yale University psychologist Stanley Milgram. They measured the willingness of study participants, men from a diverse range of occupations with varying levels of education, to obey an authority figure who instructed them to perform acts conflicting with their personal conscience. Participants were led to believe that they were assisting an unrelated experiment, in which they had to administer electric shocks to a \"learner.\" These fake electric shocks gradually increased to levels that would have been fatal had they been real', 1, '2021-02-18 13:29:37', 3, '1'),
(230, 'Milgram results', 'The extreme willingness of adults to go to almost any lengths on the command of an authority constitutes the chief finding of the study and the fact most urgently demanding explanation.\\r\\n\\r\\nOrdinary people, simply doing their jobs, and without any particular hostility on their part, can become agents in a terrible destructive process. Moreover, even when the destructive effects of their work become patently clear, and they are asked to carry out actions incompatible with fundamental standards of morality, relatively few people have the resources needed to resist authority', 1, '2021-02-18 13:29:37', 1, '1'),
(231, 'Hygge', 'Hygge is a Danish and Norwegian word for a mood of coziness and comfortable conviviality with feelings of wellness and contentment. As a cultural category with its sets of associated practices hygge has more or less the same meanings in Danish and Norwegian, but the notion is more central in Denmark than in Norway. The emphasis on hygge as a core part of Danish culture is a recent phenomenon, dating to the late 20th century.', 1, '2021-02-18 13:29:37', 2, '1');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT для таблицы `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `shop_order_item`
--
ALTER TABLE `shop_order_item`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `wpressimages_blog_post`
--
ALTER TABLE `wpressimages_blog_post`
  MODIFY `wpBlog_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT для таблицы `wpressimage_category`
--
ALTER TABLE `wpressimage_category`
  MODIFY `wpCategory_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `wpressimage_imagesstock`
--
ALTER TABLE `wpressimage_imagesstock`
  MODIFY `wpImStock_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT для таблицы `wpress_blog_post`
--
ALTER TABLE `wpress_blog_post`
  MODIFY `wpBlog_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

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

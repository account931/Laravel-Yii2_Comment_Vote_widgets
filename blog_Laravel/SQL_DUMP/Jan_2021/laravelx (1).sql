-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 20 2021 г., 21:52
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
(54, '2021_01_20_182428_create_appoint_room-list_table', 8);

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
(12, 'owner', 'Project Owner', 'User is the owner of a given project', '2020-12-22 16:26:59', NULL),
(13, 'admin', 'User Administrator', 'User is allowed to manage and edit other users', '2020-12-22 16:26:59', NULL),
(14, 'manager', 'Company Manager', 'User is a manager of a Department', '2020-12-22 16:26:59', NULL),
(15, 'commander', 'custom role', 'Wing Commander', '2020-12-22 16:26:59', NULL);

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
(2, 2, 22, 22, '2020-12-22 16:25:28', NULL),
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
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@ukr.net', '$2y$10$.WZuPclsVxIzn6NZROKfeeKzCYrwZs65HD0ieZl3z4a1Fl9yVycYm', NULL, NULL, NULL),
(2, 'Dima', 'dimmm931@gmail.com', '$2y$10$P05BZocg4IQ9/.vlLmBN5uRRdTbL/TOWJ2b00vuQNDwltD/u7dyzi', 'HRjao1onpAeGWQhN8yzlxJRQ7CKEqFVy91sZ36QEprtBFE3X4qtBXSEkvOKW', NULL, NULL),
(3, 'Olya', 'olya@gmail.com', '$2y$10$fbxVSGofl.5TTIDQ2aF6UuADIDGwNcEeFud4vdmPDrPvnRk1EiRJq', NULL, NULL, NULL);

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
(141, 'Setting  Enum in PhpMyAdmin', 'Setting  Enum in SQL\r\nunder your phpmyadmin\r\n\r\nchoose enum\r\n\r\nin Length/Values column put there : \'\'0\'\' ,\'\'1\'\'\r\n\r\nand your done ', 1, '2020-10-04 07:54:50', 1, '1'),
(142, 'Milgram experiment', 'The Milgram experiment on obedience to authority figures was a series of social psychology experiments conducted by Yale University psychologist Stanley Milgram. They measured the willingness of study participants, men from a diverse range of occupations with varying levels of education, to obey an authority figure who instructed them to perform acts conflicting with their personal conscience. Participants were led to believe that they were assisting an unrelated experiment, in which they had to administer electric shocks to a \"learner.\" These fake electric shocks gradually increased to levels that would have been fatal had they been real', 1, '2020-10-04 07:54:50', 3, '1'),
(143, 'Milgram results', 'The extreme willingness of adults to go to almost any lengths on the command of an authority constitutes the chief finding of the study and the fact most urgently demanding explanation.\\r\\n\\r\\nOrdinary people, simply doing their jobs, and without any particular hostility on their part, can become agents in a terrible destructive process. Moreover, even when the destructive effects of their work become patently clear, and they are asked to carry out actions incompatible with fundamental standards of morality, relatively few people have the resources needed to resist authority', 1, '2020-10-04 07:54:50', 1, '1'),
(144, 'Hygge', 'Hygge is a Danish and Norwegian word for a mood of coziness and comfortable conviviality with feelings of wellness and contentment. As a cultural category with its sets of associated practices hygge has more or less the same meanings in Danish and Norwegian, but the notion is more central in Denmark than in Norway. The emphasis on hygge as a core part of Danish culture is a recent phenomenon, dating to the late 20th century.', 1, '2020-10-04 07:54:50', 2, '1'),
(148, 'Table Technics', 'Neww', 2, '2020-10-04 07:54:50', 3, '1'),
(149, 'TurntableZ', 'Semi', 2, '2020-10-04 07:54:50', 3, '1'),
(150, 'Technics Alt', 'sdsds', 2, '2021-01-08 15:29:02', 3, '1'),
(151, 'Collapsible Group', 'Collapsible Group', 2, '2020-10-04 07:54:50', 3, '1'),
(152, 'date(\'Y-m-d H:i:s\')', 'date(\'Y-m-d H:i:s\')', 2, '2020-10-04 07:54:50', 2, '1'),
(153, 'JavaScript Tutorial', 'JavaScript Tutorial', 2, '2020-10-04 07:54:50', 1, '1'),
(154, 'JavaScript Tutorial 2', 'wpBlog_created_at', 2, '2020-10-04 07:54:50', 2, '1'),
(155, 'Collapsible Group 33', 'wpBlog_created_at', 2, '2020-10-04 07:54:50', 2, '1');

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
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

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
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `wpress_blog_post`
--
ALTER TABLE `wpress_blog_post`
  MODIFY `wpBlog_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

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

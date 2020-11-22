-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 22 2020 г., 18:28
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
(28, '2020_11_21_165700_create_shop_simple_table', 4),
(29, '2020_11_21_171640_add_2_columns_to_shop_simple_table', 4),
(31, '2020_11_22_134043_create_shop_order_item_table', 5),
(32, '2020_11_22_135811_create_shop_orders_main_table', 5),
(33, '2020_11_22_142841_create_shop_transactions_table', 6);

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
(12, 'owner', 'Project Owner', 'User is the owner of a given project', '2020-11-21 14:50:07', NULL),
(13, 'admin', 'User Administrator', 'User is allowed to manage and edit other users', '2020-11-21 14:50:07', NULL),
(14, 'manager', 'Company Manager', 'User is a manager of a Department', '2020-11-21 14:50:07', NULL),
(15, 'commander', 'custom role', 'Wing Commander', '2020-11-21 14:50:07', NULL);

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
  `ord_uuid` varchar(222) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ord_status` enum('proceeded','not-proceeded','delivered') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not-proceeded',
  `ord_sum` decimal(6,2) NOT NULL,
  `items_in_order` int(11) DEFAULT NULL,
  `ord_placed` timestamp NOT NULL DEFAULT '2020-11-22 11:31:54',
  `ord_name` varchar(42) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ord_address` varchar(77) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ord_email` varchar(42) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ord_phone` varchar(42) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `if_paid` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `payment_id` int(11) DEFAULT NULL,
  `delivery` enum('mail','self-take') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'mail'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `shop_orders_main`
--

INSERT INTO `shop_orders_main` (`order_id`, `ord_uuid`, `ord_status`, `ord_sum`, `items_in_order`, `ord_placed`, `ord_name`, `ord_address`, `ord_email`, `ord_phone`, `if_paid`, `payment_id`, `delivery`) VALUES
(1, 'sh-1606058482-a3d369', 'not-proceeded', '16.64', 1, '2020-11-22 12:26:35', 'Dima', 'Kyiv Ukraine', 'dimmm@ukr.net', '+3809766765', '0', NULL, 'mail');

-- --------------------------------------------------------

--
-- Структура таблицы `shop_order_item`
--

CREATE TABLE `shop_order_item` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `items_quantity` int(11) DEFAULT NULL,
  `item_price` decimal(6,2) NOT NULL,
  `currency` varchar(42) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_buyer_id` int(11) DEFAULT NULL,
  `uuid` varchar(222) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_placed` timestamp NOT NULL DEFAULT '2020-11-22 11:29:43'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `shop_created_at` timestamp NOT NULL DEFAULT '2020-11-21 14:47:53',
  `sh_stock_quantity` int(11) DEFAULT NULL,
  `sh_device_type` varchar(77) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `shop_simple`
--

INSERT INTO `shop_simple` (`shop_id`, `shop_title`, `shop_image`, `shop_price`, `shop_currency`, `shop_descr`, `shop_categ`, `shop_created_at`, `sh_stock_quantity`, `sh_device_type`) VALUES
(2, 'Canon camera', 'canon.jpg', '16.64', '$', '30 Mpx, 5kg', 1, '2020-11-21 14:47:53', NULL, NULL),
(3, 'HP notebook', 'hp.jpg', '35.31', '$', '8Gb Ram, 500Gb SSD', 1, '2020-11-21 14:47:53', NULL, NULL),
(4, 'Iphone 3', 'iphone_3.jpg', '75.55', '$', 'TFT capacitive touchscreen, 3.5 inches, 16M colors, 2 Mpx', 1, '2020-11-21 14:47:53', NULL, NULL),
(5, 'Iphone 5', 'iphone_5.jpg', '45.00', '$', 'Iphone 5 description......', 2, '2020-11-21 14:47:53', NULL, NULL),
(6, 'Ipod', 'ipod_classic_3.jpg', '2.66', '$', 'Ipod description....', 2, '2020-11-21 14:47:53', NULL, NULL),
(7, 'Samsung Sync', 'samsung_sync.jpg', '18.96', '$', 'Samsung Sync description...', 3, '2020-11-21 14:47:53', NULL, NULL),
(8, 'Audio-Tech AT-LP120', 'turntable.jpg', '233.00', '$', 'The best starter turntable with all the features you\'ll ever need.', 4, '2020-11-21 14:47:53', NULL, NULL),
(9, 'Behringer Vmx200', 'mixer.jpg', '92.04', '$', 'Three channels mixer', 4, '2020-11-21 14:47:53', NULL, NULL),
(10, 'Kington 16GB Flash', 'kingston.jpg', '4.00', '$', '16 GB Falsh Drive', 1, '2020-11-21 14:47:53', NULL, NULL),
(11, 'Pioneer DDJ-WEGO-K', 'wego.jpg', '402.69', '$', 'Ultra-compact and affordable DJ controller. Plug & Play with bundled Virtual DJ LE software. Pulse Control Provides Visual Prompts via Various Types of Illuminations Directly on the Unit. Multi-colored LED for customization of lights to match the user\'s style', 4, '2020-11-21 14:47:53', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_transactions`
--

CREATE TABLE `shop_transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(42) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gross` decimal(6,2) NOT NULL,
  `currency` varchar(42) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `order_placed` timestamp NOT NULL DEFAULT '2020-11-22 11:31:54',
  `status` varchar(42) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orderId` int(11) DEFAULT NULL
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
(1, 'Admin', 'admin@ukr.net', '$2y$10$c84rKK1cYFnZ8vWqnzeCuO9YRa8xXi8VW7DP.nKrD.nVM2CRiuFgS', NULL, NULL, NULL),
(2, 'Dima', 'dimmm931@gmail.com', '$2y$10$PRlznmFXOF6shNaxGK8/ze/USSHcFpKVQtFGcRDZBgAygHla6HQOS', NULL, NULL, NULL),
(3, 'Olya', 'olya@gmail.com', '$2y$10$ydYim20.vY9etphFxB745.v2/qB633Jzg3TIjF5Gv1BXvtuwPXPhW', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `wpress_blog_post`
--

CREATE TABLE `wpress_blog_post` (
  `wpBlog_id` int(10) UNSIGNED NOT NULL,
  `wpBlog_title` varchar(222) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wpBlog_text` text COLLATE utf8mb4_unicode_ci,
  `wpBlog_author` int(11) DEFAULT NULL,
  `wpBlog_created_at` timestamp NOT NULL DEFAULT '2020-10-04 07:54:50',
  `wpBlog_category` int(11) DEFAULT NULL,
  `wpBlog_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `wpress_blog_post`
--

INSERT INTO `wpress_blog_post` (`wpBlog_id`, `wpBlog_title`, `wpBlog_text`, `wpBlog_author`, `wpBlog_created_at`, `wpBlog_category`, `wpBlog_status`) VALUES
(105, 'Setting  Enum in PhpMyAdmin', 'Setting  Enum in SQL\r\nunder your phpmyadmin\r\n\r\nchoose enum\r\n\r\nin Length/Values column put there : \'\'0\'\' ,\'\'1\'\'\r\n\r\nand your done ', 1, '2020-10-04 07:54:50', 1, '1'),
(106, 'Milgram experiment', 'The Milgram experiment on obedience to authority figures was a series of social psychology experiments conducted by Yale University psychologist Stanley Milgram. They measured the willingness of study participants, men from a diverse range of occupations with varying levels of education, to obey an authority figure who instructed them to perform acts conflicting with their personal conscience. Participants were led to believe that they were assisting an unrelated experiment, in which they had to administer electric shocks to a \"learner.\" These fake electric shocks gradually increased to levels that would have been fatal had they been real', 1, '2020-10-04 07:54:50', 3, '1'),
(107, 'Milgram results', 'The extreme willingness of adults to go to almost any lengths on the command of an authority constitutes the chief finding of the study and the fact most urgently demanding explanation.\\r\\n\\r\\nOrdinary people, simply doing their jobs, and without any particular hostility on their part, can become agents in a terrible destructive process. Moreover, even when the destructive effects of their work become patently clear, and they are asked to carry out actions incompatible with fundamental standards of morality, relatively few people have the resources needed to resist authority', 1, '2020-10-04 07:54:50', 1, '1'),
(108, 'Hygge', 'Hygge is a Danish and Norwegian word for a mood of coziness and comfortable conviviality with feelings of wellness and contentment. As a cultural category with its sets of associated practices hygge has more or less the same meanings in Danish and Norwegian, but the notion is more central in Denmark than in Norway. The emphasis on hygge as a core part of Danish culture is a recent phenomenon, dating to the late 20th century.', 1, '2020-10-04 07:54:50', 2, '1');

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
  ADD PRIMARY KEY (`order_id`);

--
-- Индексы таблицы `shop_order_item`
--
ALTER TABLE `shop_order_item`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `shop_order_item`
--
ALTER TABLE `shop_order_item`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `shop_simple`
--
ALTER TABLE `shop_simple`
  MODIFY `shop_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `wpBlog_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

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
-- Ограничения внешнего ключа таблицы `shop_simple`
--
ALTER TABLE `shop_simple`
  ADD CONSTRAINT `shop_simple_shop_categ_foreign` FOREIGN KEY (`shop_categ`) REFERENCES `shop_categories` (`categ_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

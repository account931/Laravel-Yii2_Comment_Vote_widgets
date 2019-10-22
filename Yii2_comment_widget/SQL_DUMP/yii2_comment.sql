-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 23 2019 г., 02:05
-- Версия сервера: 5.6.41
-- Версия PHP: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `yii2_comment`
--

-- --------------------------------------------------------

--
-- Структура таблицы `aggregate_rating`
--

CREATE TABLE `aggregate_rating` (
  `id` int(11) NOT NULL,
  `model_id` smallint(6) NOT NULL,
  `target_id` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `dislikes` int(11) NOT NULL,
  `rating` float UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `aggregate_rating`
--

INSERT INTO `aggregate_rating` (`id`, `model_id`, `target_id`, `likes`, `dislikes`, `rating`) VALUES
(1, 0, 1, 1, 0, 2.07),
(2, 0, 2, 0, 1, 0),
(3, 0, 3, 1, 0, 2.07);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1571690417),
('admin', '2', 1571785475);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, 'Админ', NULL, NULL, 1571690417, 1571690417),
('comments.create', 2, 'Can create own comments', NULL, NULL, 1570797604, 1570797604),
('comments.delete', 2, 'Can delete all comments', NULL, NULL, 1570797604, 1570797604),
('comments.delete.own', 2, 'Can delete own comments', 'comments.its-my-comment', NULL, 1570797604, 1570797604),
('comments.update', 2, 'Can update all comments', NULL, NULL, 1570797604, 1570797604),
('comments.update.own', 2, 'Can update own comments', 'comments.its-my-comment', NULL, 1570797604, 1570797604);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_rule`
--

INSERT INTO `auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
('comments.its-my-comment', 0x4f3a34353a22726d726576696e5c7969695c6d6f64756c655c436f6d6d656e74735c726261635c4974734d79436f6d6d656e74223a333a7b733a343a226e616d65223b733a32333a22636f6d6d656e74732e6974732d6d792d636f6d6d656e74223b733a393a22637265617465644174223b693a313537303739373630343b733a393a22757064617465644174223b693a313537303739373630343b7d, 1570797604, 1570797604);

-- --------------------------------------------------------

--
-- Структура таблицы `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `entity` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `from` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `text` text COLLATE utf8_unicode_ci,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `comment`
--

INSERT INTO `comment` (`id`, `entity`, `from`, `text`, `deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'photo-15', 'dima', 'Goodd', 0, 1570794898, 1570794898, 1570794898, 1570794898),
(2, '1', 'Dima', 'I like it', 0, 1570794898, 1570794898, 1570794898, 1570794898),
(3, '1', 'Oksana', 'New commnet', 0, 1570794898, 1570794898, 1570794898, 1570794898),
(4, '2', 'Tanya', 'my comment for item 2', 0, 1570794898, 1570794898, 1570794898, 1570794898),
(8, '1', 'dima', 'again......', 0, NULL, NULL, NULL, NULL),
(9, '2', 'dima', 'Finally', 0, 1586512191, NULL, NULL, NULL),
(10, '1', 'dima', 'Finally 2 ', 0, 1586512283, 1586512413, 1586512413, 1586512413),
(11, '1', 'dima', 'Finally 33', 0, NULL, NULL, 1586512413, 1586512413);

-- --------------------------------------------------------

--
-- Структура таблицы `itemx`
--

CREATE TABLE `itemx` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(77) NOT NULL,
  `item_description` varchar(77) NOT NULL,
  `item_image` varchar(77) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `itemx`
--

INSERT INTO `itemx` (`item_id`, `item_name`, `item_description`, `item_image`) VALUES
(1, 'Item 1', 'item 1 description', ''),
(2, 'Item 2', 'item 2 description', ''),
(3, 'Item 3', 'item 3 description', '');

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1570794241),
('m010101_100001_init_comment', 1571217575),
('m130524_201442_init', 1570794246),
('m140209_132017_init', 1571517735),
('m140403_174025_create_account_table', 1571517735),
('m140504_113157_update_tables', 1571517735),
('m140504_130429_create_token_table', 1571517735),
('m140506_102106_rbac_init', 1570794530),
('m140830_171933_fix_ip_field', 1571517735),
('m140830_172703_change_account_table_name', 1571517735),
('m141119_220432_comments', 1571133762),
('m141222_110026_update_ip_field', 1571517735),
('m141222_135246_alter_username_length', 1571517735),
('m150102_164631_create_rating_table', 1571135517),
('m150106_122229_comments', 1570794273),
('m150127_165542_update_rating_table', 1571135517),
('m150129_132124_add_indexes_for_rating_table', 1571135517),
('m150614_103145_update_social_account_table', 1571517735),
('m150623_212711_fix_username_notnull', 1571517735),
('m151005_165040_comment_from', 1570794273),
('m151218_234654_add_timezone_to_profile', 1571517735),
('m160126_140022_create_aggregate_rating_table', 1571135517),
('m160209_074651_add_indexes_for_aggregate_rating_table', 1571135517),
('m160629_121330_add_relatedTo_column_to_comment', 1571217575),
('m160929_103127_add_last_login_at_to_user_table', 1571517735),
('m161109_092304_rename_comment_table', 1571217575),
('m161114_094902_add_url_column_to_comment_table', 1571217575),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1570794530),
('m180523_151638_rbac_updates_indexes_without_prefix', 1570794530),
('m190124_110200_add_verification_token_column_to_user_table', 1570794246);

-- --------------------------------------------------------

--
-- Структура таблицы `profile`
--

CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `timezone` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `profile`
--

INSERT INTO `profile` (`user_id`, `name`, `public_email`, `gravatar_email`, `gravatar_id`, `location`, `website`, `bio`, `timezone`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `model_id` smallint(6) NOT NULL,
  `target_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_ip` varbinary(39) NOT NULL,
  `value` tinyint(1) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `rating`
--

INSERT INTO `rating` (`id`, `model_id`, `target_id`, `user_id`, `user_ip`, `value`, `date`) VALUES
(1, 0, 1, 3, 0x7f000001, 1, 1571221151),
(2, 0, 2, 3, 0x7f000001, 0, 1571142837),
(3, 0, 3, 3, 0x7f000001, 1, 1571137853);

-- --------------------------------------------------------

--
-- Структура таблицы `social_account`
--

CREATE TABLE `social_account` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `token`
--

CREATE TABLE `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `token`
--

INSERT INTO `token` (`user_id`, `code`, `created_at`, `type`) VALUES
(1, 'MHccJnDu3WDqycqwzUbzgmJVg7l3HFv8', 1571518360, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  `last_login_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `auth_key`, `confirmed_at`, `unconfirmed_email`, `blocked_at`, `registration_ip`, `created_at`, `updated_at`, `flags`, `last_login_at`) VALUES
(1, 'dima', 'account@ukr.net', '$2y$10$guY8s5yQn0jb2wbrM5yyi.7nPYgDVvbdn9S/6yZ9Kpd/T9QhoaICq', 'PUbnLuKBk5dTS_y1n8MxKXIulVW_P9cs', 1571518813, NULL, NULL, '127.0.0.1', 1571518360, 1571518360, 2, 1571783441),
(2, 'dima2', 'account2@ukr.net', '$2y$10$cGUGARdFBXwXKBTloYqTJ.tCxt7NkMfR8RHWoZkq2y3nQvsTrQOA6', 'wc6JzghI8RVOmvrtO5kRb_P_OLd58AFh', 1571519621, NULL, NULL, '127.0.0.1', 1571519462, 1571519462, 0, 1571691949),
(3, 'created_user', 'dd@ukr.net', '$2y$10$RjyMyQurr3pbcFboigWfTO2kiMEoWrE//13FIhbLfNrhEqyrwneBq', 'jpephIMYzmk6LN4itYd_ckHzwSv91YtK', 1571739680, NULL, NULL, '127.0.0.1', 1571739680, 1571739680, 0, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `userprev`
--

CREATE TABLE `userprev` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `userprev`
--

INSERT INTO `userprev` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(3, 'dima', 'JW6uzwRADGUjR2BEDccuNDGAFW6yFTve', '$2y$13$78a.iyjdUQ6QBKEPjCTOMuX72achPhoU9k1kFRt7qW7xyT7SvsQ7.', NULL, 'dima@ukr.net', 10, 1570797264, 1570797264, 'WkIBFC6XCsVmA4PwHF5uyuYLS7HrUZha_1570797264');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `aggregate_rating`
--
ALTER TABLE `aggregate_rating`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `aggregate_model_id_target_id` (`model_id`,`target_id`);

--
-- Индексы таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Индексы таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Индексы таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Индексы таблицы `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Индексы таблицы `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_entity` (`entity`),
  ADD KEY `idx_created_by` (`created_by`),
  ADD KEY `idx_created_at` (`created_at`);

--
-- Индексы таблицы `itemx`
--
ALTER TABLE `itemx`
  ADD PRIMARY KEY (`item_id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`user_id`);

--
-- Индексы таблицы `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rating_model_id_target_id` (`model_id`,`target_id`),
  ADD KEY `rating_user_id` (`user_id`),
  ADD KEY `rating_user_ip` (`user_ip`);

--
-- Индексы таблицы `social_account`
--
ALTER TABLE `social_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_unique` (`provider`,`client_id`),
  ADD UNIQUE KEY `account_unique_code` (`code`),
  ADD KEY `fk_user_account` (`user_id`);

--
-- Индексы таблицы `token`
--
ALTER TABLE `token`
  ADD UNIQUE KEY `token_unique` (`user_id`,`code`,`type`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_unique_username` (`username`),
  ADD UNIQUE KEY `user_unique_email` (`email`);

--
-- Индексы таблицы `userprev`
--
ALTER TABLE `userprev`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `aggregate_rating`
--
ALTER TABLE `aggregate_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `itemx`
--
ALTER TABLE `itemx`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `social_account`
--
ALTER TABLE `social_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `userprev`
--
ALTER TABLE `userprev`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `social_account`
--
ALTER TABLE `social_account`
  ADD CONSTRAINT `fk_user_account` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `fk_user_token` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

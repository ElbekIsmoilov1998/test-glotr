-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 03 2021 г., 16:04
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `glotr`
--

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1611947911),
('m130524_201442_init', 1611947917),
('m190124_110200_add_verification_token_column_to_user_table', 1611947917);

-- --------------------------------------------------------

--
-- Структура таблицы `to_do_list`
--

CREATE TABLE `to_do_list` (
  `id` int(11) NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) NOT NULL,
  `completed_by` int(10) NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completed_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `to_do_list`
--

INSERT INTO `to_do_list` (`id`, `title`, `created_by`, `completed_by`, `content`, `date`, `completed_date`, `status`) VALUES
(31, 'cteate name', 16, 2, 'Создать новую задачу', '25-Фев-2021', '18-Фев-2021', '0'),
(32, 'Список всех задач', 16, 2, 'Список всех задач', '11-Фев-2021', '25-Фев-2021', '1'),
(33, 'РАЗРАБОТКА МОБИЛЬНОГО ПРИЛОЖЕНИЯ1990', 16, 19, 'Пояснительная записка к курсовой работе\r\nпо курсу «Программные средства для мобильных устройств»\r\n', '10-Фев-2021', '25-Фев-2021', '2'),
(34, 'информацию о регионах Узбекистана3', 16, 19, 'Программа была написана в современной интегрированной среде разработки Android Studio 4.4.1  для работы с платформой Android. Приложение обеспечивает следующую функциональность: распредение имен областей в виде списки , фотки достопримечательносты областы , подробное описание о регионе , переключение между активностями .', '17-Фев-2021', '25-Фев-2021', '1'),
(35, 'Yii 2 dropDownList - Default value not being selected110', 19, 16, 'I\'m using Yii 2 ActiveForm, trying to make option 7 \"default\".\r\n\r\nTo do this, I have to use the options array, but when I do so, my html attribute \"selected\" is not being rendered at all when viewing the HTML source. I get no errors.', '18-Фев-2021', '25-Фев-2021', '0'),
(38, 'Yii2 AJAX', 19, 16, 'В современном вебе отправка и получение данных без перезагрузки страницы давно уже стала признаком хорошего тона. В этом случае страница не перегружается и все работает куда быстрее. Да и выглядит этот процесс достаточно привлекательно, сопровождаясь зачастую сопутствующими анимационными эффектами.', '18-Фев-2021', '25-Фев-2021', '1'),
(39, 'Yii2 PJAX перезагрузить', 19, 17, 'Я пытаюсь отправить форму через pjax, и после отправки я хочу обновить таблицу, но после отправки формы и попыток перезагрузки ($.pjax.reload({container:\'#products-table\'});) сценарии jquery больше не работают. Даже я добавил pjax:success но если я не перезаряжаю таблицу, все скрипты работают и отправляют запросы, а затем я должен перезагрузить вручную, чтобы увидеть изменения. Или я попытался отправить форму без pjax и перезагрузки страницы Yii, а затем снова проблокирует скрипты. Пожалуйста, ваши отзывы. благодаря', '25-Фев-2021', '04-Мар-2021', '0'),
(40, 'Automatically Login ', 21, 19, 'I have a registration form, then I want to do an automatic login after the registration is successful. I already tried it, but it doesn’t automatically login after a successful registration', '18-Фев-2021', '25-Фев-2021', '1'),
(41, 'I have a registration form', 22, 20, 'I have a registration form, then I want to do an automatic login after the registration is successful. I already tried it, but it doesn’t automatically login after a successful registration', '20-Фев-2021', '26-Фев-2021', '0');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(2, 'olikm', 'tDaoB_a4G76sOV3QpitR-wGh2saqI4ww', '$2y$13$h42znOqsohnq1JXQl0end.vE3KBD1khgdA3HXEFflmYKZT36BWhgC', NULL, 'jfkwehfkjwh@gmail.com', 10, 1611948080, 1611948080, 'TKDxMUeHq3NlNNDxe13v0C2nNr-Zu3EE_1611948080'),
(16, 'admin', 'qb7R5VQkzFOhhwDHjYdziRCify507T62', '$2y$13$gxQ7/q.X9/SDaiVw3jg8uOYQU3eyiokR1FAkNTfs7EokCP.XWRSSe', NULL, 'admin@gmail.com', 10, 1612258974, 1612258974, 'Z80o5uJYCaogRE96VZICNq0iES9OsBrg_1612258974'),
(17, 'abbos', 'mKwrUaMbz_Fzm7MpvlbZoAg2g76y_1ZI', '$2y$13$EtrbyYNebMqHg/9WZUozpuNTRaoJTzCoJsQEaOi/k4/ynch7V9uKW', NULL, 'abbos@gmail.com', 10, 1612260749, 1612260749, 'JcQDh_5sneciYTiwaBazsSa-NoP5u_vx_1612260749'),
(18, 'olim', 'X_V6J7wsjfh6E9SzNuA1Uc6ZRDTseEfn', '$2y$13$3d46BvH9.DjsKfnn.gG2auWs0qQny2Jr3p9sr7slDbJTHoNhpdCzK', NULL, 'olim@gmail.com', 10, 1612260882, 1612260882, 'R8PXl7reUErOLVWAxXzQBdvT4HKPCcXU_1612260882'),
(19, 'ilyas', 'Bs6V4aRWYO0M1mguP-LzKKdavoU3IuR5', '$2y$13$HXPv/V6mCBQF84H/8Ok1FeyHMzMsk6Z0IEZ8NbVSaEwEBvrsqVXDS', NULL, 'ilyas@gmail.com', 10, 1612260919, 1612260919, 'liLKMnUkqlWKJ-TpPkNB8YuTZrtdzT89_1612260919'),
(20, 'ilhom', 'r1cikyE688y9mbNqsXBUu-Oxir-BQl1C', '$2y$13$vX.uTkeldockoI.nbWNhU.TUG0QxcJHZLoxsOHGawQCJAVhC5koQG', NULL, 'ilhom@gmail.com', 10, 1612260930, 1612260930, 'nDgbgO59ilH_tRXNRioxDv84nBl4xtAz_1612260930'),
(21, 'yernazar', 'tDDP2usvHI3HkUyUaNza2BTqsoMHZxnG', '$2y$13$xYIBthQ3i6RwD45kamB1VOBPcCqMIY5q.K7lzmpRlVNWepi1ZyGCG', NULL, 'yerka@gmail.com', 10, 1612283763, 1612283763, 'e99I4twWV3Y8GXc7NlDo3heBFdnWEgIP_1612283763'),
(22, 'yernazar1', 'tjGqEi2aZAaQLERDYJKKbbwuNQRe2h_y', '$2y$13$j80dbBgm0P0ynsIndlp5sefHKcvC5Jr5wXe75YF7ojFLHklS9SWoy', NULL, 'yerka1@gmail.com', 10, 1612283836, 1612283836, 'YqpwN2VKhS25OTaDXpHRkHZ37Ts0azMq_1612283836'),
(23, 'yernazar2', 'yOMmf9oudhwoWnzd99gDnYdf9bEoUvf-', '$2y$13$aum0wC8cuQ2jIWR9PmCsXuXBgPV5qvAYN71NgUlqtWpto6DJFKive', NULL, 'yerka2@gmail.com', 10, 1612283972, 1612283972, 'W8fShM8rN5TZ9JjFht_vpLhMkes7TXTU_1612283972'),
(24, 'yernazar4', 'kj8LT0iVSDMy7uAp7_kPlX4HL5RTHyHS', '$2y$13$zXgP5eSwCMrjqE/d2zb.COsAKZBgrDraSVvAEQmJuktTm0YsNuuqS', NULL, 'yerka4@gmail.com', 10, 1612284143, 1612284143, 'TTUISQmPWMPro9SrLD1JlOIaBP0G6g8A_1612284143'),
(25, 'jalol', 'S-tj19ZIZW1G-kROLBwoGTIL5LoAF7EP', '$2y$13$DWmfSnu1Fh5hbYTe3Uz4Rei.6odB2TF02sqFQp1oF7Djb4raSGRmq', NULL, 'jalol@gmail.com', 10, 1612284256, 1612284256, 'qQBWdkh1KAQGct7RglL0nvjdp_0FeMWv_1612284256');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `to_do_list`
--
ALTER TABLE `to_do_list`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `to_do_list`
--
ALTER TABLE `to_do_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

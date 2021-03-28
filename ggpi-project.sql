-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 25 2021 г., 12:46
-- Версия сервера: 5.7.29
-- Версия PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ggpi-project`
--

-- --------------------------------------------------------

--
-- Структура таблицы `dashboard`
--

CREATE TABLE `dashboard` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `to_do` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `do` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `done` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bugs` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resources` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `dashboard`
--

INSERT INTO `dashboard` (`id`, `project_id`, `to_do`, `do`, `done`, `bugs`, `resources`) VALUES
(1, 1, 'Сделать 1', 'Делаю 1', 'Сделано 1', NULL, 'Php'),
(2, 1, NULL, 'В процессе', NULL, NULL, NULL);

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
('m000000_000000_base', 1612610826),
('m130524_201442_init', 1612610828),
('m190124_110200_add_verification_token_column_to_user_table', 1612610828),
('m201203_125919_create_projects_table', 1612610829),
('m201213_155847_add_avatar_column_to_user_table', 1612610830),
('m210206_104258_create_tag_table', 1612610830),
('m210206_112839_create_projects_tag_table', 1613110926),
('m210208_072823_create_project_user_table', 1613110928),
('m210218_073558_create_user_tag_table', 1613634846),
('m210219_091945_add_type_column_to_tag_table', 1613726431),
('m210219_115135_add_created_updated_column_to_projects_table', 1613735523),
('m210323_074527_create_dashboard_table', 1616505203);

-- --------------------------------------------------------

--
-- Структура таблицы `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_number` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `projects`
--

INSERT INTO `projects` (`id`, `title`, `description`, `image`, `max_number`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Проект 1', '1', '1612612603_LlCLDH.png', 2, 1, 1613735510, 1614583399),
(3, 'Телеграм-бот', 'Создание телеграм-бота, который в ответ на номер группы выдает расписание на день.\r\nВ команду нужен:\r\n1. Программист\r\n2. Дизайнер', '1614527911_Ivgulh.png', 2, 1, 1613735550, 1614583558),
(4, 'Игра в жанре Roguelike', 'Игра начинается с того, что главный герой встречает своего старого друга на нижних уровнях города. Друг - военный в отставке. От него вы узнаете про то, где на нижних уровнях можно достать припасы и подработку, о слухах про некое “нечеловеческое существо”, обитающее здесь, в катакомбах, о том, что на втором уровне города происходят повсеместные восстания против существующего строя и про его жену, которая работает на высших уровнях города в департаменте технологий и от которой уже давно не было вестей. После этого вы прощаетесь, и вашей главной задачей на все ближайшее прохождение становится свержение тоталитарной власти в этом городе, а побочной задачей - разузнать, куда пропала жена вашего друга. Для достижения основной цели, вам понадобиться преодолеть несколько фракций:\r\n1. Катакомбы - первый и второй уровни города, где живут, в основном, низшие слои общества и который патрулируется “Щитом свободы” - армией главного монарха.\r\n2. Сторожевой пост - третий и четвертый уровни города, где сосредоточена основная военная сила “Щита свободы”. Нужен для разделения бедного и более элитного районов города. \r\n3. Департамент технологий - пятый и шестой уровни города, в основном состоят из лабораторных комнат, охраняется специальным отделом “Щита свободы”, модифицированным с помощью научных достижений данной фракции. \r\n4. “Золотая башня” - седьмой и финальный уровень игры, где живет “элита” этого города и, собственно, сам монарх.\r\n\r\nИщу заинтересованных людей. Ключевые навыки - умение программировать на движке Unity или навыки в геймдизайне.', '1614584532_CQOnJK.png', 4, 2, 1613735585, 1614584565),
(5, 'Юные исследователи', 'Цель проекта: Практическое внедрение детского экспериментирования как средства развития познавательной активности.\r\nЭтот проект позволит:\r\n1) Узнавать о физических и химических явлениях окружающего мира;\r\n2) Исследовать свойства различных веществ;\r\n3) Изучать интересные явления в живой природе;\r\n4) Проводить опыты в «научной лаборатории».\r\nИщу заинтересованных участников только(!) среди жителей г. Глазова и от 14 лет.', '1614526728_xIL7is.jpg', 4, 1, 1613736117, 1614584409);

-- --------------------------------------------------------

--
-- Структура таблицы `projects_tag`
--

CREATE TABLE `projects_tag` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `projects_tag`
--

INSERT INTO `projects_tag` (`id`, `project_id`, `tag_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 15),
(8, 1, 16),
(9, 1, 17),
(10, 1, 18),
(11, 1, 19),
(12, 1, 20),
(13, 1, 21),
(14, 1, 23),
(35, 5, 24),
(36, 4, 25),
(37, 4, 26),
(38, 3, 3),
(39, 3, 5),
(40, 3, 16),
(41, 3, 19),
(42, 4, 28),
(43, 1, 24),
(44, 1, 25),
(45, 1, 26),
(46, 1, 27),
(47, 1, 28),
(48, 1, 29),
(49, 1, 30),
(50, 1, 31),
(51, 1, 32),
(52, 1, 33),
(53, 1, 34),
(54, 1, 35),
(55, 1, 36),
(56, 1, 37),
(57, 1, 38),
(58, 1, 39),
(59, 1, 40),
(60, 1, 41),
(61, 1, 42),
(62, 1, 43),
(63, 1, 44),
(64, 1, 45);

-- --------------------------------------------------------

--
-- Структура таблицы `projects_user`
--

CREATE TABLE `projects_user` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `projects_user`
--

INSERT INTO `projects_user` (`id`, `project_id`, `user_id`, `status`) VALUES
(27, 3, 2, 2),
(35, 4, 3, 1),
(37, 1, 2, 2),
(39, 4, 1, 1),
(41, 5, 4, 1),
(42, 5, 2, 1),
(47, 1, 3, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tag`
--

INSERT INTO `tag` (`id`, `title`, `type`) VALUES
(1, 'HTML', 0),
(2, 'CSS', 0),
(3, 'PHP', 0),
(4, 'SCSS', 0),
(5, 'JavaScript', 0),
(6, 'Yii2', 0),
(7, 'Программист', 1),
(8, 'Дизайнер', 1),
(9, 'Тестировщик', 1),
(10, 'Юрист', 1),
(11, 'Аналитик', 1),
(12, 'DevOps', 1),
(13, 'Технический писатель', 1),
(15, 'NodeJS', 0),
(16, 'Python', 0),
(17, 'VueJS', 0),
(18, 'Web-приложение', 0),
(19, 'Мобильное приложение', 0),
(20, 'Яндекс', 0),
(21, 'Google', 0),
(23, 'Angular', 0),
(24, 'Научное исследование', 0),
(25, 'Unity', 0),
(26, 'C#', 0),
(27, 'C/C++', 0),
(28, 'Игра', 0),
(29, 'Swift', 0),
(30, 'Go', 0),
(31, 'Java', 0),
(32, 'Basic', 0),
(33, 'Pascal', 0),
(34, 'Lua', 0),
(35, 'Prolog', 0),
(36, 'Mercury', 0),
(37, 'Delphi', 0),
(38, 'Perl', 0),
(39, 'Kotlin', 0),
(40, 'Rust', 0),
(41, '1С', 0),
(42, 'Game Editor', 0),
(43, 'Game Maker', 0),
(44, 'Unreal Engine', 0),
(45, 'Blender', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `patronymic` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` smallint(6) NOT NULL DEFAULT '10',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `surname`, `name`, `patronymic`, `role`, `email`, `auth_key`, `password_hash`, `password_reset_token`, `status`, `created_at`, `updated_at`, `verification_token`, `image`) VALUES
(1, 'Demo', 'Demo', 'Demo', '', 10, 'demo@mail.ru', 'DbMaM6RX8qrd_q4MNJDyfMW46Mgg-z7m', '$2y$13$LqIqKl6astz7wKJ301.toOYq2QpHhXAGLIDUnDRDJpNeLmKG9PTZu', NULL, 10, 1612610853, 1613652652, 'zBDn2jgDpCY1bDtY6aoGTtJv7fB1PmWb_1612610853', '1613652651_HVYPRV.png'),
(2, 'Admin', 'Admin', 'Admin', 'Admin', 10, 'admin@example.com', 'jmnrLu2PzEAOgcSXSIoTD6xXsAQgvV22', '$2y$13$MIjxrjGCrxxeoExpKxZ0.e8Z5cQIl3BnnS7afiwDtevlpkFmNS07K', NULL, 10, 1612613521, 1612613521, 'pXxZqRf7lSxugx6Ss7WObCGy8jbqtQ2d_1612613521', NULL),
(3, 'Sonya', 'Pozdeeva', 'Sofya', 'Dmitrievna', 10, 'sonya@mail.ru', 'RTu1XUT-LZ_W2tVCFGmT17sYAUuHzSJi', '$2y$13$jcIfD/3G4nVGTkNvNrjqgepTxw1ci2DSrHoN.es98OcxTScp3Mtea', NULL, 10, 1612947112, 1614673306, 'KaqbBw3badrA7Ic81U0nXvoyFxZsfuIc_1612947112', '1614673305_5R1QLk.jpg'),
(4, 'Tester', 'Test', 'Test', '', 10, 'test@mail.ru', 'fdjCSMfBQfpnEoY1SimoDurmlYsIiWqP', '$2y$13$Om6K2vrMYWtmTsvH1czWLOuPj9zqgu4xgjH1W5yDdsAV7lmtemzzC', NULL, 10, 1614247819, 1614247819, 'ss6OP8_Oc6C_xlhHnnDjuzspkH-w926N_1614247819', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `user_tag`
--

CREATE TABLE `user_tag` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user_tag`
--

INSERT INTO `user_tag` (`id`, `user_id`, `tag_id`) VALUES
(5, 1, 8),
(6, 1, 10),
(7, 3, 7),
(8, 3, 8),
(9, 3, 9);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `dashboard`
--
ALTER TABLE `dashboard`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-dashboard-project_id` (`project_id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-projects-user_id` (`user_id`);

--
-- Индексы таблицы `projects_tag`
--
ALTER TABLE `projects_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-projects_tag-tag_id` (`tag_id`),
  ADD KEY `idx-projects_tag-project_id` (`project_id`);

--
-- Индексы таблицы `projects_user`
--
ALTER TABLE `projects_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-projects_user-user_id` (`user_id`),
  ADD KEY `idx-projects_user-project_id` (`project_id`);

--
-- Индексы таблицы `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Индексы таблицы `user_tag`
--
ALTER TABLE `user_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-user_tag-tag_id` (`tag_id`),
  ADD KEY `idx-user_tag-project_id` (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `dashboard`
--
ALTER TABLE `dashboard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `projects_tag`
--
ALTER TABLE `projects_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT для таблицы `projects_user`
--
ALTER TABLE `projects_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT для таблицы `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `user_tag`
--
ALTER TABLE `user_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `dashboard`
--
ALTER TABLE `dashboard`
  ADD CONSTRAINT `fk-dashboard-project_id` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `fk-post-user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `projects_tag`
--
ALTER TABLE `projects_tag`
  ADD CONSTRAINT `fk-projects_tag-project_id` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-projects_tag-tag_id` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `projects_user`
--
ALTER TABLE `projects_user`
  ADD CONSTRAINT `fk-projects_user-project_id` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-projects_user-user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user_tag`
--
ALTER TABLE `user_tag`
  ADD CONSTRAINT `fk-user_tag-project_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-user_tag-tag_id` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

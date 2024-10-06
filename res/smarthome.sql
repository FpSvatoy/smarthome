-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 06 2024 г., 03:31
-- Версия сервера: 10.5.17-MariaDB
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `smarthome`
--

-- --------------------------------------------------------

--
-- Структура таблицы `condition_device`
--

CREATE TABLE `condition_device` (
  `id_param` int(11) NOT NULL,
  `id_device` int(11) NOT NULL,
  `status` text NOT NULL,
  `initalize` text NOT NULL,
  `date` date NOT NULL,
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `condition_device`
--

INSERT INTO `condition_device` (`id_param`, `id_device`, `status`, `initalize`, `date`, `comment`) VALUES
(1, 2, 'activated', 'Clara', '2024-06-01', 'normal'),
(2, 2, 'deactivated', 'device', '2024-06-05', 'normal'),
(3, 2, 'activated', 'Clara', '2024-06-07', 'normal'),
(4, 2, 'deactivated', 'sova', '2024-06-19', 'normal'),
(5, 2, 'activated', 'device', '2024-06-26', 'error'),
(26, 5, 'deactivated', 'TEvgen', '2024-06-02', 'normal'),
(27, 5, 'activated', 'TEvgen', '2024-06-03', 'normal'),
(34, 2, 'activated', 'admin', '2024-06-04', 'normal'),
(35, 2, 'activated', 'admin', '2024-09-09', 'normal'),
(36, 2, 'activated', 'admin', '2024-10-06', 'normal'),
(37, 2, 'activated', 'admin', '2024-10-06', 'normal'),
(38, 2, 'deactivated', 'admin', '2024-10-06', 'normal'),
(39, 2, 'activated', 'admin', '2024-10-06', 'normal');

-- --------------------------------------------------------

--
-- Структура таблицы `current_brightness`
--

CREATE TABLE `current_brightness` (
  `id_param` int(11) NOT NULL,
  `id_device` int(11) NOT NULL,
  `percent_value` int(3) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `current_color`
--

CREATE TABLE `current_color` (
  `id_param` int(11) NOT NULL,
  `id_device` int(11) NOT NULL,
  `RGB` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `device`
--

CREATE TABLE `device` (
  `ID_DEVICE` int(11) NOT NULL,
  `ALIAS` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parameters` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ID_ACCESS` int(11) NOT NULL DEFAULT 0,
  `PATH_IMAGE` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `device`
--

INSERT INTO `device` (`ID_DEVICE`, `ALIAS`, `parameters`, `ID_ACCESS`, `PATH_IMAGE`) VALUES
(2, 'Tuya Gas', NULL, 1, 'Датчик газа.png'),
(5, 'Kojima RGB', NULL, 0, 'Умная лампочка.png');

-- --------------------------------------------------------

--
-- Структура таблицы `energy_consumption`
--

CREATE TABLE `energy_consumption` (
  `id_param` int(11) NOT NULL,
  `id_device` int(11) NOT NULL,
  `energy_value` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `gas_concentration`
--

CREATE TABLE `gas_concentration` (
  `id_param` int(11) NOT NULL,
  `id_device` int(11) NOT NULL,
  `ppm_value` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `soc_battery`
--

CREATE TABLE `soc_battery` (
  `id_param` int(11) NOT NULL,
  `id_device` int(11) NOT NULL,
  `now_soc` int(3) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `soc_battery`
--

INSERT INTO `soc_battery` (`id_param`, `id_device`, `now_soc`, `date`) VALUES
(1, 2, 55, '2024-06-01'),
(2, 2, 57, '2024-06-02'),
(3, 2, 60, '2024-06-03'),
(4, 2, 69, '2024-06-04'),
(5, 2, 55, '2024-06-05'),
(6, 2, 60, '2024-06-06'),
(7, 2, 70, '2024-06-07'),
(8, 2, 80, '2024-06-08'),
(9, 2, 85, '2024-06-09'),
(10, 2, 95, '2024-06-10'),
(11, 2, 100, '2024-06-11'),
(12, 2, 100, '2024-06-12'),
(13, 2, 75, '2024-06-13'),
(14, 2, 100, '2024-06-14'),
(15, 2, 75, '2024-06-15');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `login` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patronymic` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_access` int(11) NOT NULL DEFAULT 1,
  `password` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id_user`, `login`, `surname`, `name`, `patronymic`, `mail`, `phone`, `id_access`, `password`) VALUES
(2, 'sova', 'Левихин', 'Денис', 'Евгеньевич', 'sova@mail.ru', '79992410542', 0, '$2y$10$7d33DNDGWl.RLdxGYS8obe4wbOEgpxCIO7fq8SLlu.7okLQNmP7n2'),
(5, 'admin', 'admin', 'admin', 'admin', 'admin@mail.ru', '79992224443', 0, '$2y$10$WgBn3KCGJiNPiAD2Abqy2.jyrysmtM7/Q4n4BAkOnkM20Y/lC8ziK'),
(19, 'Clara', 'Belobog', 'Clara', 'Svarogovna', 'clara@belobog.ya6', '+1 987 654 32 ', 1, '$2y$10$09ob6NeC1DjFFU7HipCZ7urNj6hUPm6PM0iytRW2kHClPdSsHpNr6'),
(20, 'TEvgen', 'Тятинин', 'Евгений', 'Юрьевич', 'tyatininevgeniy@gmail.com', '89112223344', 0, '$2y$10$FRq0FttPmHdJMzEyrEcFkOETrSwPYMCwmNQhBtOU/7WSjWhvQUjeu');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `condition_device`
--
ALTER TABLE `condition_device`
  ADD PRIMARY KEY (`id_param`);

--
-- Индексы таблицы `current_brightness`
--
ALTER TABLE `current_brightness`
  ADD PRIMARY KEY (`id_param`);

--
-- Индексы таблицы `current_color`
--
ALTER TABLE `current_color`
  ADD PRIMARY KEY (`id_param`);

--
-- Индексы таблицы `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`ID_DEVICE`),
  ADD UNIQUE KEY `ALIAS` (`ALIAS`);

--
-- Индексы таблицы `energy_consumption`
--
ALTER TABLE `energy_consumption`
  ADD PRIMARY KEY (`id_param`);

--
-- Индексы таблицы `gas_concentration`
--
ALTER TABLE `gas_concentration`
  ADD PRIMARY KEY (`id_param`);

--
-- Индексы таблицы `soc_battery`
--
ALTER TABLE `soc_battery`
  ADD PRIMARY KEY (`id_param`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `LOGIN` (`login`),
  ADD UNIQUE KEY `MAIL` (`mail`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `condition_device`
--
ALTER TABLE `condition_device`
  MODIFY `id_param` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT для таблицы `current_brightness`
--
ALTER TABLE `current_brightness`
  MODIFY `id_param` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `current_color`
--
ALTER TABLE `current_color`
  MODIFY `id_param` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `device`
--
ALTER TABLE `device`
  MODIFY `ID_DEVICE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `energy_consumption`
--
ALTER TABLE `energy_consumption`
  MODIFY `id_param` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `gas_concentration`
--
ALTER TABLE `gas_concentration`
  MODIFY `id_param` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `soc_battery`
--
ALTER TABLE `soc_battery`
  MODIFY `id_param` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

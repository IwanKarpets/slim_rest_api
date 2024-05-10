-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 10 2024 г., 16:40
-- Версия сервера: 5.6.51
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `rest_api`
--

-- --------------------------------------------------------

--
-- Структура таблицы `loans`
--

CREATE TABLE `loans` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `loans`
--

INSERT INTO `loans` (`id`, `name`, `amount`, `created_at`) VALUES
(2, 'Petya', '4000.00', '2024-05-07 12:05:20'),
(3, 'Алексей Смирнов', '20000.00', '2024-05-07 12:05:20'),
(5, 'Nick233', '200.00', '2024-05-07 16:25:05'),
(6, 'Max', '3000.00', '2024-05-09 13:49:32'),
(7, 'Vasya', '3000.00', '2024-05-09 18:47:21'),
(8, 'Vasya', '3000.00', '2024-05-10 11:15:04'),
(9, 'Vasya', '3000.00', '2024-05-10 11:17:36'),
(10, 'Vasya', '3000.00', '2024-05-10 11:50:21'),
(11, 'Vasya', '3000.00', '2024-05-10 11:51:11'),
(12, 'Vasya', '3000.00', '2024-05-10 11:52:04'),
(13, 'Vasya', '3000.00', '2024-05-10 11:52:50'),
(14, 'Vasya', '3000.00', '2024-05-10 11:53:04'),
(15, 'Vasya', '3000.00', '2024-05-10 11:53:19'),
(16, 'Vasya', '3000.00', '2024-05-10 11:56:01'),
(17, 'Vasya', '3000.00', '2024-05-10 11:59:04'),
(18, 'Vasya', '3000.00', '2024-05-10 12:00:22'),
(19, 'Vasya', '3000.00', '2024-05-10 12:00:36'),
(20, 'Vasya', '3000.00', '2024-05-10 12:04:18'),
(21, 'Vasya', '3000.00', '2024-05-10 12:05:16'),
(22, 'Vasya', '3000.00', '2024-05-10 12:08:29'),
(23, 'Vasya', '3000.00', '2024-05-10 12:08:52'),
(24, 'Vasya', '3000.00', '2024-05-10 12:11:26'),
(25, 'Vasya', '3000.00', '2024-05-10 12:11:52'),
(26, 'Vasya', '3000.00', '2024-05-10 12:25:19'),
(27, 'Vasya', '3000.00', '2024-05-10 12:26:00'),
(28, 'Vasya', '3000.00', '2024-05-10 12:50:37'),
(29, 'Vasya', '3000.00', '2024-05-10 13:12:45'),
(30, 'Vasya', '3000.00', '2024-05-10 13:14:31'),
(31, 'Vasya', '3000.00', '2024-05-10 13:21:31'),
(32, 'Vasya', '3000.00', '2024-05-10 13:22:15'),
(33, 'Vasya', '3000.00', '2024-05-10 13:26:53'),
(34, 'Vasya', '3000.00', '2024-05-10 13:36:54'),
(35, 'Vasya', '3000.00', '2024-05-10 13:38:41'),
(36, 'Vasya', '3000.00', '2024-05-10 13:40:42'),
(37, 'Vasya', '3000.00', '2024-05-10 13:41:05'),
(38, 'Vasya', '3000.00', '2024-05-10 13:41:26'),
(41, 'Vasya', '3000.00', '2024-05-10 13:49:12'),
(42, 'Vasya', '3000.00', '2024-05-10 13:50:28'),
(43, 'Vasya', '3000.00', '2024-05-10 13:51:12'),
(44, 'Vasya', '3000.00', '2024-05-10 13:51:24'),
(45, 'Vasya', '3000.00', '2024-05-10 13:53:19'),
(46, 'Vasya', '3000.00', '2024-05-10 13:58:37'),
(47, 'Vasya', '3000.00', '2024-05-10 14:28:36'),
(49, 'Vasya', '3000.00', '2024-05-10 14:34:09'),
(50, 'Vasya', '3000.00', '2024-05-10 14:34:31'),
(51, 'Vasya', '3000.00', '2024-05-10 16:01:56'),
(52, 'Vasya', '3000.00', '2024-05-10 16:02:09');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

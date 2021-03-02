-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Окт 03 2020 г., 13:22
-- Версия сервера: 10.4.6-MariaDB
-- Версия PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `dance_project`
--

-- --------------------------------------------------------

--
-- Структура таблицы `administrator`
--

CREATE TABLE `administrator` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `administrator`
--

INSERT INTO `administrator` (`id`, `name`, `password`) VALUES
(1, 'admin', 'admin123!');

-- --------------------------------------------------------

--
-- Структура таблицы `chat`
--

CREATE TABLE `chat` (
  `competition_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `data` datetime NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `chat`
--

INSERT INTO `chat` (`competition_id`, `user_name`, `data`, `message`) VALUES
(1, 'user123', '2020-10-03 13:10:24', 'Hello world'),
(1, 'user123', '2020-10-03 13:10:03', 'Hi'),
(1, 'Bexultan', '2020-10-03 13:10:56', 'Hi');

-- --------------------------------------------------------

--
-- Структура таблицы `competitions`
--

CREATE TABLE `competitions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `competitions`
--

INSERT INTO `competitions` (`id`, `name`, `description`, `status`) VALUES
(1, 'Dance Competition NIS', 'WE LOVE BEYOND THE STARS! BTS continues to be one our company\'s favorite competitions to attend. The staff is always so professional and the events consistent and organized. Every time we\'ve attended an event ALL of the judges have been so informative and clear in their critiques...it\'s obvious each of the judges is well versed in various forms of technique! We have nothing but amazing things to say and recommend attending!', 'still going'),
(2, 'WE LOVE BEYOND THE STARS!', 'Thank you for postponing your event. Our kids were absolutely devestated but your communication has been amazing. Definitely an industry standard for customer service which is why we attend BTS. Hopefully u can reschedule for a date that works for our kiddos! Stay safe everyone!!!', 'still going'),
(3, 'Thank you for postponing your event. Our kids were absolutely devestated but your communication has been amazing', 'Thank you for postponing your event. Our kids were absolutely devestated but your communication has been amazing. Definitely an industry standard for customer service which is why we attend BTS. Hopefully u can reschedule for a date that works for our kiddos! Stay safe everyone!!!', 'ended'),
(6, 'test', 'test', 'still going');

-- --------------------------------------------------------

--
-- Структура таблицы `contact`
--

CREATE TABLE `contact` (
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `participants`
--

CREATE TABLE `participants` (
  `competition_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `mark` int(3) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `participants`
--

INSERT INTO `participants` (`competition_id`, `user_name`, `phone`, `mark`, `category`) VALUES
(1, 'test', '2147483647', 15, 'Ballet'),
(1, 'admin', '87079600930', 101, 'Ballet'),
(2, 'admin', '87079600930', 55, 'National'),
(1, 'user123', '87079600930', 49, 'National'),
(1, 'Bexultan', '87079600930', 80, 'Hip-hop'),
(1, 'user', '', 0, 'Ballet'),
(3, 'user', '', 0, 'Ballet');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `age` int(3) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `age`, `password`) VALUES
(3, 'user', 'azhol@gmail.com', 18, 'test'),
(4, 'user123', 'jugdge678@gmail.com', 19, 'test'),
(5, 'Bexultan', 'jugdge678@gmail.com', 20, 'test');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `competitions`
--
ALTER TABLE `competitions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `competitions`
--
ALTER TABLE `competitions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

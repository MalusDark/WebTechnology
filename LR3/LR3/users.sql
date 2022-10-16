-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3305
-- Время создания: Окт 16 2022 г., 16:47
-- Версия сервера: 10.6.7-MariaDB
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `users`
--

-- --------------------------------------------------------

--
-- Структура таблицы `usersdata`
--

CREATE TABLE `usersdata` (
  `email` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userName` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdayDate` date NOT NULL,
  `Gender` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userAddress` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userInst` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `interests` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `usersdata`
--

INSERT INTO `usersdata` (`email`, `userName`, `password`, `birthdayDate`, `Gender`, `userAddress`, `userInst`, `interests`) VALUES
('', '', '', '1970-01-01', 'Male', '', '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3305
-- Время создания: Окт 02 2022 г., 19:58
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
-- База данных: `orders`
--

-- --------------------------------------------------------

--
-- Структура таблицы `customers`
--

CREATE TABLE `customers` (
  `customerId` int(11) NOT NULL,
  `customerName` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `customers`
--

INSERT INTO `customers` (`customerId`, `customerName`) VALUES
(1, 'Егоров'),
(2, 'Красилова'),
(3, 'Верын'),
(4, 'Масленинова'),
(5, 'Панков');

-- --------------------------------------------------------

--
-- Структура таблицы `transactions`
--

CREATE TABLE `transactions` (
  `invoiceId` int(11) NOT NULL,
  `invoiceScan` varchar(150) NOT NULL,
  `deliveryAdress` varchar(60) NOT NULL,
  `orderNote` text NOT NULL,
  `orderCost` decimal(10,2) NOT NULL,
  `customerId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `transactions`
--

INSERT INTO `transactions` (`invoiceId`, `invoiceScan`, `deliveryAdress`, `orderNote`, `orderCost`, `customerId`) VALUES
(1, '1_invoice.jpg', 'Волгоград, ул Санаторная, 12, 37', 'Домофон 9809#', '2400.00', 3),
(2, '2_invoice.jpg', 'Волгоград, ул 70-летия Победы, 7, 56', 'Предупредить за 30 минут', '1800.50', 1),
(3, '3_invoice.jpg', 'Волгоград, Университетский проспект, 100', 'Оставить у охраны', '26000.00', 5),
(4, '4_invoice.jpg', 'Волгоград, Университетский проспект, 107, ТЦ Акварель', 'LeroyMerlin', '140500.90', 1),
(5, '5_invoice.jpg', 'Волгоград, ул. Богданова, 32', 'Главный вход', '1200.50', 2),
(6, '6_invoice.jpg', 'Волгоград, улица Александра Беляева, 5, 16', 'Понедельник, после 18', '1752.00', 1),
(7, '7_invoice.jpg', 'Волгоград, Университетский проспект, 104, этаж 2', 'Вторая половина дня', '175000.00', 1),
(8, '8_invoice.jpg', 'Волгоград, улица 50 лет Октября, 15А', 'Вход ОфисМаг', '6762.04', 5),
(9, '9_invoice.jpg', 'Волгоград, просп. Героев Сталинграда, 8Г', 'При отсутствии Dosia заменить на Fairy', '2682.95', 4),
(10, '10_invoice.jpg', 'Волгоград, просп. Столетова, 8, этаж 1', '', '23750.00', 4),
(11, '11_invoice.jpg', 'Волгоградская область, рп Светлый Яр, 1-й микрорайон, 19', '', '5940.00', 3),
(12, '12_invoice.jpg', 'Волгоградская область, посёлок Краснофлотский, 11', '', '30718.00', 4),
(13, '13_invoice.jpg', 'Волгоградская область, Большие Чапурники, улица Ильина, 83', '', '5300.00', 3),
(14, '14_invoice.jpg', 'Волгоградская область, Дубовый Овраг, ул Октябрьская, 166А', '', '8506.15', 2),
(15, '15_invoice.jpg', 'Волжский, улица Горького, 25, 115', '', '7425.00', 3),
(16, '16_invoice.jpg', 'Волжский, Набережная улица, 27', '', '12163.99', 1),
(17, '17_invoice.jpg', 'Краснослободск, улица Чайковского, 7', '', '8599.80', 5),
(18, '18_invoice.jpg', 'Волгоград, улица Маяковского, 108', '', '1593.00', 2),
(19, '19_invonce.jpg', 'Волгоград, Школьный переулок, 1', '', '14500.00', 5),
(20, '20_invonce.jpg', 'Волгоград, ул. Кирова, 116', '', '528.60', 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerId`);

--
-- Индексы таблицы `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`invoiceId`),
  ADD KEY `customerId` (`customerId`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `customers`
--
ALTER TABLE `customers`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `transactions`
--
ALTER TABLE `transactions`
  MODIFY `invoiceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customers` (`customerId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

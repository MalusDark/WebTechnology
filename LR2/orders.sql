-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3305
-- Время создания: Окт 01 2022 г., 17:38
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
(1, 'https://ontask.ru/wp-content/uploads/2019/11/3-tovarnaja.jpg', 'Волгоград, ул Санаторная, 12, 37', 'Домофон 9809#', '2400.00', 3),
(2, 'https://vvs.ru/invoice1.gif', 'Волгоград, ул 70-летия Победы, 7, 56', 'Предупредить за 30 минут', '1800.50', 1),
(3, 'https://znatokprava.ru/wp-content/uploads/zapolnenie-nakladnoy-torg-12.png', 'Волгоград, Университетский проспект, 100', 'Оставить у охраны', '26000.00', 5),
(4, 'http://www.cirota.ru/forum/images/104/104976.jpeg', 'Волгоград, Университетский проспект, 107, ТЦ Акварель', 'LeroyMerlin', '140500.90', 1),
(5, 'https://infostart.ru/upload/iblock/57c/%D0%9F%D0%B5%D1%87%D0%B0%D1%82%D1%8C%20%D0%A2%D0%9D%203.JPG', 'Волгоград, ул. Богданова, 32', 'Главный вход', '1200.50', 2),
(6, 'http://xn--80aer5aza.xn----8sbcci0csf.xn--p1ai/images/NAKL30-03-07.jpg', 'Волгоград, улица Александра Беляева, 5, 16', 'Понедельник, после 18', '1752.00', 1),
(7, 'https://icqinfo.ru/800/600/https/infostart.ru/upload/iblock/4d2/%D1%82%D0%BE%D1%80%D0%B3-12.png', 'Волгоград, Университетский проспект, 104, этаж 2', 'Вторая половина дня', '175000.00', 1),
(8, 'https://icqinfo.ru/800/600/https/svalep.ru/blog/wp-content/uploads/2015/04/1011-%D0%B3%D1%80%D0%B5%D1%87%D0%B0.jpg', 'Волгоград, улица 50 лет Октября, 15А', 'Вход ОфисМаг', '6762.04', 5),
(9, 'https://stimul.kiev.ua/img/materialy_oformlenie-realizatsii/22004.png', 'Волгоград, просп. Героев Сталинграда, 8Г', 'При отсутствии Dosia заменить на Fairy', '2682.95', 4),
(10, 'https://otvet.imgsmail.ru/download/26271167_d6bb581a7a03c9e7a3ebe42a0633e474_800.png', 'Волгоград, просп. Столетова, 8, этаж 1', '', '23750.00', 4);

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
  MODIFY `invoiceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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

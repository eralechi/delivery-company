-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июл 28 2022 г., 17:43
-- Версия сервера: 10.4.24-MariaDB
-- Версия PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `delivery_company`
--

-- --------------------------------------------------------

--
-- Структура таблицы `courier`
--

CREATE TABLE `courier` (
  `id` int(11) UNSIGNED NOT NULL,
  `fio` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `courier`
--

INSERT INTO `courier` (`id`, `fio`) VALUES
(1, 'Бирюков Сергей Донатович'),
(2, 'Новиков Тимофей Ильяович'),
(3, 'Лаврентьев Юлиан Владимирович'),
(4, 'Вишняков Яков Рубенович'),
(5, 'Самойлов Варлаам Наумович'),
(6, 'Селиверстова Ульна Анатольевна'),
(7, 'Анисимова Марианна Анатольевна'),
(8, 'Коновалова Нина Вадимовна'),
(9, 'Горбачёва Лариса Игоревна'),
(10, 'Капустина Георгина Серапионовна');

-- --------------------------------------------------------

--
-- Структура таблицы `delivery`
--

CREATE TABLE `delivery` (
  `id` int(11) UNSIGNED NOT NULL,
  `courier_id` int(11) UNSIGNED NOT NULL,
  `region_id` int(11) UNSIGNED NOT NULL,
  `depart_date` date NOT NULL,
  `return_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `delivery`
--

INSERT INTO `delivery` (`id`, `courier_id`, `region_id`, `depart_date`, `return_date`) VALUES
(1, 1, 6, '2019-06-01', '2019-07-06'),
(2, 1, 9, '2019-07-07', '2019-08-24'),
(3, 1, 7, '2019-08-25', '2019-10-26'),
(4, 1, 10, '2019-10-27', '2020-01-28'),
(5, 1, 7, '2020-01-29', '2020-03-31'),
(6, 1, 2, '2020-04-01', '2020-07-01'),
(7, 1, 2, '2020-07-02', '2020-10-01'),
(8, 1, 8, '2020-10-02', '2020-12-22'),
(9, 1, 10, '2020-12-23', '2021-03-27'),
(10, 1, 2, '2021-03-28', '2021-06-27'),
(11, 1, 10, '2021-06-28', '2021-09-30'),
(12, 1, 2, '2021-10-01', '2021-12-30'),
(13, 1, 1, '2021-12-31', '2022-02-02'),
(14, 1, 7, '2022-02-03', '2022-04-06'),
(15, 1, 8, '2022-04-07', '2022-06-28'),
(16, 1, 8, '2022-06-29', '2022-09-19'),
(17, 2, 9, '2019-06-01', '2019-07-19'),
(18, 2, 6, '2019-07-20', '2019-08-24'),
(19, 2, 8, '2019-08-25', '2019-11-14'),
(20, 2, 1, '2019-11-15', '2019-12-18'),
(21, 2, 7, '2019-12-19', '2020-02-19'),
(22, 2, 9, '2020-02-20', '2020-04-08'),
(23, 2, 7, '2020-04-09', '2020-06-10'),
(24, 2, 1, '2020-06-11', '2020-07-14'),
(25, 2, 1, '2020-07-15', '2020-08-17'),
(26, 2, 2, '2020-08-18', '2020-11-16'),
(27, 2, 4, '2020-11-17', '2020-12-01'),
(28, 2, 4, '2020-12-02', '2020-12-16'),
(29, 2, 3, '2020-12-17', '2021-02-28'),
(30, 2, 8, '2021-03-01', '2021-05-22'),
(31, 2, 2, '2021-05-23', '2021-08-22'),
(32, 2, 1, '2021-08-23', '2021-09-25'),
(33, 2, 10, '2021-09-26', '2021-12-28'),
(34, 2, 8, '2021-12-29', '2022-03-21'),
(35, 2, 8, '2022-03-22', '2022-06-12'),
(36, 2, 10, '2022-06-13', '2022-09-15'),
(37, 3, 9, '2019-06-01', '2019-07-19'),
(38, 3, 7, '2019-07-20', '2019-09-20'),
(39, 3, 7, '2019-09-21', '2019-11-21'),
(40, 3, 2, '2019-11-22', '2020-02-21'),
(41, 3, 2, '2020-02-22', '2020-05-23'),
(42, 3, 1, '2020-05-24', '2020-06-26'),
(43, 3, 2, '2020-06-27', '2020-09-26'),
(44, 3, 1, '2020-09-27', '2020-10-29'),
(45, 3, 4, '2020-10-30', '2020-11-13'),
(46, 3, 3, '2020-11-14', '2021-01-26'),
(47, 3, 3, '2021-01-27', '2021-04-10'),
(48, 3, 8, '2021-04-11', '2021-07-02'),
(49, 3, 6, '2021-07-03', '2021-08-07'),
(50, 3, 4, '2021-08-08', '2021-08-22'),
(51, 3, 9, '2021-08-23', '2021-10-10'),
(52, 3, 4, '2021-10-11', '2021-10-25'),
(53, 3, 9, '2021-10-26', '2021-12-12'),
(54, 3, 2, '2021-12-13', '2022-03-14'),
(55, 3, 4, '2022-03-15', '2022-03-29'),
(56, 3, 1, '2022-03-30', '2022-05-02'),
(57, 3, 7, '2022-05-03', '2022-07-04'),
(58, 3, 3, '2022-07-05', '2022-09-16'),
(59, 4, 6, '2019-06-01', '2019-07-06'),
(60, 4, 10, '2019-07-07', '2019-10-09'),
(61, 4, 9, '2019-10-10', '2019-11-26'),
(62, 4, 7, '2019-11-27', '2020-01-28'),
(63, 4, 6, '2020-01-29', '2020-03-04'),
(64, 4, 1, '2020-03-05', '2020-04-07'),
(65, 4, 7, '2020-04-08', '2020-06-09'),
(66, 4, 10, '2020-06-10', '2020-09-12'),
(67, 4, 10, '2020-09-13', '2020-12-15'),
(68, 4, 9, '2020-12-16', '2021-02-02'),
(69, 4, 9, '2021-02-03', '2021-03-23'),
(70, 4, 8, '2021-03-24', '2021-06-14'),
(71, 4, 4, '2021-06-15', '2021-06-29'),
(72, 4, 2, '2021-06-30', '2021-09-29'),
(73, 4, 10, '2021-09-30', '2022-01-01'),
(74, 4, 6, '2022-01-02', '2022-02-06'),
(75, 4, 5, '2022-02-07', '2022-04-14'),
(76, 4, 8, '2022-04-15', '2022-07-06'),
(77, 4, 3, '2022-07-07', '2022-09-18'),
(78, 5, 4, '2019-06-01', '2019-06-15'),
(79, 5, 2, '2019-06-16', '2019-09-15'),
(80, 5, 7, '2019-09-16', '2019-11-16'),
(81, 5, 9, '2019-11-17', '2020-01-04'),
(82, 5, 8, '2020-01-05', '2020-03-27'),
(83, 5, 4, '2020-03-28', '2020-04-11'),
(84, 5, 8, '2020-04-12', '2020-07-03'),
(85, 5, 9, '2020-07-04', '2020-08-21'),
(86, 5, 9, '2020-08-22', '2020-10-09'),
(87, 5, 3, '2020-10-10', '2020-12-21'),
(88, 5, 2, '2020-12-22', '2021-03-23'),
(89, 5, 4, '2021-03-24', '2021-04-07'),
(90, 5, 10, '2021-04-08', '2021-07-11'),
(91, 5, 3, '2021-07-12', '2021-09-23'),
(92, 5, 4, '2021-09-24', '2021-10-08'),
(93, 5, 8, '2021-10-09', '2021-12-29'),
(94, 5, 7, '2021-12-30', '2022-03-02'),
(95, 5, 2, '2022-03-03', '2022-06-02'),
(96, 5, 1, '2022-06-03', '2022-07-06'),
(97, 5, 6, '2022-07-07', '2022-08-11'),
(98, 6, 10, '2019-06-01', '2019-09-03'),
(99, 6, 4, '2019-09-04', '2019-09-18'),
(100, 6, 8, '2019-09-19', '2019-12-09'),
(101, 6, 9, '2019-12-10', '2020-01-27'),
(102, 6, 3, '2020-01-28', '2020-04-10'),
(103, 6, 1, '2020-04-11', '2020-05-14'),
(104, 6, 1, '2020-05-15', '2020-06-17'),
(105, 6, 10, '2020-06-18', '2020-09-20'),
(106, 6, 7, '2020-09-21', '2020-11-21'),
(107, 6, 5, '2020-11-22', '2021-01-27'),
(108, 6, 3, '2021-01-28', '2021-04-11'),
(109, 6, 6, '2021-04-12', '2021-05-17'),
(110, 6, 10, '2021-05-18', '2021-08-20'),
(111, 6, 3, '2021-08-21', '2021-11-01'),
(112, 6, 10, '2021-11-02', '2022-02-04'),
(113, 6, 10, '2022-02-05', '2022-05-10'),
(114, 6, 1, '2022-05-11', '2022-06-13'),
(115, 6, 3, '2022-06-14', '2022-08-26'),
(116, 7, 2, '2019-06-01', '2019-08-31'),
(117, 7, 10, '2019-09-01', '2019-12-03'),
(118, 7, 6, '2019-12-04', '2020-01-08'),
(119, 7, 6, '2020-01-09', '2020-02-13'),
(120, 7, 8, '2020-02-14', '2020-05-06'),
(121, 7, 3, '2020-05-07', '2020-07-19'),
(122, 7, 1, '2020-07-20', '2020-08-22'),
(123, 7, 8, '2020-08-23', '2020-11-12'),
(124, 7, 10, '2020-11-13', '2021-02-15'),
(125, 7, 1, '2021-02-16', '2021-03-21'),
(126, 7, 10, '2021-03-22', '2021-06-24'),
(127, 7, 4, '2021-06-25', '2021-07-09'),
(128, 7, 7, '2021-07-10', '2021-09-10'),
(129, 7, 2, '2021-09-11', '2021-12-10'),
(130, 7, 8, '2021-12-11', '2022-03-03'),
(131, 7, 2, '2022-03-04', '2022-06-03'),
(132, 7, 8, '2022-06-04', '2022-08-25'),
(133, 8, 3, '2019-06-01', '2019-08-13'),
(134, 8, 2, '2019-08-14', '2019-11-12'),
(135, 8, 6, '2019-11-13', '2019-12-18'),
(136, 8, 4, '2019-12-19', '2020-01-02'),
(137, 8, 2, '2020-01-03', '2020-04-03'),
(138, 8, 10, '2020-04-04', '2020-07-07'),
(139, 8, 3, '2020-07-08', '2020-09-19'),
(140, 8, 2, '2020-09-20', '2020-12-19'),
(141, 8, 5, '2020-12-20', '2021-02-24'),
(142, 8, 10, '2021-02-25', '2021-05-30'),
(143, 8, 5, '2021-05-31', '2021-08-05'),
(144, 8, 4, '2021-08-06', '2021-08-20'),
(145, 8, 9, '2021-08-21', '2021-10-08'),
(146, 8, 4, '2021-10-09', '2021-10-23'),
(147, 8, 1, '2021-10-24', '2021-11-25'),
(148, 8, 2, '2021-11-26', '2022-02-25'),
(149, 8, 2, '2022-02-26', '2022-05-28'),
(150, 8, 2, '2022-05-29', '2022-08-28'),
(151, 9, 9, '2019-06-01', '2019-07-19'),
(152, 9, 7, '2019-07-20', '2019-09-20'),
(153, 9, 7, '2019-09-21', '2019-11-21'),
(154, 9, 10, '2019-11-22', '2020-02-24'),
(155, 9, 5, '2020-02-25', '2020-05-01'),
(156, 9, 6, '2020-05-02', '2020-06-06'),
(157, 9, 9, '2020-06-07', '2020-07-25'),
(158, 9, 7, '2020-07-26', '2020-09-26'),
(159, 9, 5, '2020-09-27', '2020-12-01'),
(160, 9, 2, '2020-12-02', '2021-03-03'),
(161, 9, 7, '2021-03-04', '2021-05-05'),
(162, 9, 1, '2021-05-06', '2021-06-08'),
(163, 9, 3, '2021-06-09', '2021-08-21'),
(164, 9, 8, '2021-08-22', '2021-11-11'),
(165, 9, 1, '2021-11-12', '2021-12-15'),
(166, 9, 7, '2021-12-16', '2022-02-16'),
(167, 9, 8, '2022-02-17', '2022-05-10'),
(168, 9, 3, '2022-05-11', '2022-07-23'),
(169, 9, 10, '2022-07-24', '2022-10-26'),
(170, 10, 4, '2019-06-01', '2019-06-15'),
(171, 10, 7, '2019-06-16', '2019-08-17'),
(172, 10, 2, '2019-08-18', '2019-11-16'),
(173, 10, 3, '2019-11-17', '2020-01-29'),
(174, 10, 10, '2020-01-30', '2020-05-03'),
(175, 10, 5, '2020-05-04', '2020-07-09'),
(176, 10, 3, '2020-07-10', '2020-09-21'),
(177, 10, 3, '2020-09-22', '2020-12-03'),
(178, 10, 9, '2020-12-04', '2021-01-21'),
(179, 10, 6, '2021-01-22', '2021-02-26'),
(180, 10, 1, '2021-02-27', '2021-04-01'),
(181, 10, 9, '2021-04-02', '2021-05-20'),
(182, 10, 7, '2021-05-21', '2021-07-22'),
(183, 10, 5, '2021-07-23', '2021-09-27'),
(184, 10, 6, '2021-09-28', '2021-11-01'),
(185, 10, 7, '2021-11-02', '2022-01-03'),
(186, 10, 2, '2022-01-04', '2022-04-05'),
(187, 10, 2, '2022-04-06', '2022-07-06'),
(188, 10, 2, '2022-07-07', '2022-10-06'),
(189, 9, 2, '2023-01-01', '2023-04-02'),
(190, 1, 1, '2023-04-02', '2023-05-05'),
(191, 1, 1, '2023-05-06', '2023-06-08');

-- --------------------------------------------------------

--
-- Структура таблицы `region`
--

CREATE TABLE `region` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `days_on_road` tinyint(4) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `region`
--

INSERT INTO `region` (`id`, `name`, `days_on_road`) VALUES
(1, 'Санкт-Петербург', 33),
(2, 'Уфа', 91),
(3, 'Нижний Новгород', 73),
(4, 'Владимир', 14),
(5, 'Кострома', 66),
(6, 'Екатеринбург', 35),
(7, 'Ковров', 62),
(8, 'Воронеж', 82),
(9, 'Самара', 48),
(10, 'Астрахань', 94);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `courier`
--
ALTER TABLE `courier`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `courier`
--
ALTER TABLE `courier`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT для таблицы `region`
--
ALTER TABLE `region`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

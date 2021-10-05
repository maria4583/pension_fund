-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 09 2021 г., 10:27
-- Версия сервера: 8.0.19
-- Версия PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `pension_fund`
--

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE `order` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `service_id` int NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`id`, `user_id`, `service_id`, `date`, `status`) VALUES
(1, 1, 2, '2021-03-09 07:21:18', '0');

-- --------------------------------------------------------

--
-- Структура таблицы `service`
--

CREATE TABLE `service` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` decimal(11,0) NOT NULL,
  `deadline` int NOT NULL,
  `description` varchar(500) NOT NULL,
  `icon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `service`
--

INSERT INTO `service` (`id`, `title`, `price`, `deadline`, `description`, `icon`) VALUES
(1, 'Извещение о состоянии лицевого счета в ПФР', '0', 1, 'Узнайте состояние лицевого счета в системе обязательного пенсионного страхования', 'https://gu-st.ru/content/catalog/pas/25.svg'),
(2, 'Установление пенсии', '0', 30, 'Подать заявление о назначении пенсии, о перерасчете размера пенсии, о переводе с одной пенсии на другую', 'https://gu-st.ru/content/Icons/pension.svg'),
(3, 'Выписка о предоставлении социальной помощи', '0', 1, 'Из федерального регистра лиц, имеющих право на получение социальной помощи', 'https://gu-st.ru/content/catalog/pas/27.svg'),
(4, 'Выплата страховых пенсий, накопительной пенсии и пенсий по государственному пенсионному обеспечению ', '0', 15, 'Подать заявление о доставке пенсии', 'https://gu-st.ru/content/catalog/pas/10002574289.svg'),
(5, 'Предоставление санаторно-курортного лечения', '0', 15, 'Заполните заявление на портале и получите путевку на санаторно-курортное лечение', 'https://gu-st.ru/content/catalog/pas/28.svg'),
(6, 'Справка об отнесении к категории предпенсионера', '0', 1, 'Получите справку онлайн ', 'https://gu-st.ru/content/Icons/predpens.svg'),
(7, 'Учет нуждающихся в жилье', '0', 21, 'Узнайте, как встать в очередь на получение жилья в вашем регионе', 'https://gu-st.ru/content/catalog/pas/need_home.svg'),
(8, 'Льготы на оплату жилищно-коммунальных услуг', '0', 10, 'Узнайте, какие льготы на оплату жилья и коммунальных услуг предоставляются в вашем регионе, оформите субсидию или компенсацию', 'https://gu-st.ru/content/catalog/pas/jku_subsidii.svg'),
(9, 'Льготы на проезд в общественном транспорте', '0', 10, 'Узнайте, какие льготы на проезд в общественном транспорте предоставляются в вашем регионе, оформите выплату или проездной документ', 'https://gu-st.ru/content/catalog/pas/proezd.svg');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `name` varchar(36) NOT NULL,
  `surname` varchar(36) NOT NULL,
  `middle_name` varchar(36) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `gender` enum('f','m') DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `passport` varchar(255) DEFAULT NULL,
  `snils` varchar(11) DEFAULT NULL,
  `oms` varchar(16) DEFAULT NULL,
  `inn` varchar(12) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `middle_name`, `email`, `phone`, `gender`, `birth`, `address`, `passport`, `snils`, `oms`, `inn`, `password`) VALUES
(1, 'admin', 'admin', NULL, NULL, 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$fseFT/SEgWVxw/akQxakgu9va9LxYqqnAU1.BaLw7crID1WQiHQdu');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `service`
--
ALTER TABLE `service`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 25 2018 г., 12:37
-- Версия сервера: 5.6.38
-- Версия PHP: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bd`
--

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `publish` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `publish`) VALUES
(1, 'Одежда', 'Фирменная одежда с символикой любимых спортивных команд.', 1),
(2, 'Аксессуары', 'Эксклюзивные брендовые аксессуары с символикой спортивных команд идеально подчеркивают тонкое чувство стиля преданного болельщика.', 1),
(3, 'Мебель', 'Тематическая мебель помогает создать в доме уютную атмосферу.', 1),
(4, 'Техника', 'Настоящий болельщик никогда не упустит возможность приобрести гаджет с эмблемой любимой команды.', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `phone` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `orders_to_products`
--

CREATE TABLE `orders_to_products` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `articul` varchar(12) NOT NULL,
  `brand` varchar(500) NOT NULL,
  `image_path` varchar(2000) NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL,
  `category_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `publish` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `articul`, `brand`, `image_path`, `description`, `price`, `category_id`, `created_at`, `updated_at`, `publish`) VALUES
(1, 'Форма', '0001', 'Ювентус', 'https://cdn1.savepice.ru/uploads/2018/3/14/f15055f0a76af3e7881f53b87611e965-full.png', 'Оригинальная форма футбольного клуба Ювентус.', 1800, 1, '2018-05-17 17:56:27', '2018-05-23 22:04:30', 1),
(2, 'Сумка', '0002', 'Ювентус', 'https://cdn1.savepice.ru/uploads/2018/3/14/7a3eff3c29e9c5abbe1a42967e7bce10-full.jpg', 'Сумка с логотипом Ювентуса из качественного материала.', 1400, 2, '2018-05-17 17:56:27', '2018-05-23 22:04:31', 1),
(3, 'Ремень', '0003', 'Ювентус', 'https://cdn1.savepice.ru/uploads/2018/3/14/365c80b14126628547572c22736fb0be-full.jpg', 'Отличный кожаный ремень с символикой футбольного клуба Ювентус.', 400, 1, '2018-05-17 17:59:57', '2018-05-23 22:04:31', 1),
(4, 'Кресло-мешок', '0004', 'Ювентус', 'https://cdn1.savepice.ru/uploads/2018/3/14/c0b2741d03799fa91359be0b6396a6ad-full.png', 'Мягкое кресло для комфортного просмотра футбольных матчей.', 2200, 3, '2018-05-17 17:59:57', '2018-05-23 22:04:31', 1),
(5, 'Геймпад', '0005', 'Ювентус', 'https://cdn1.savepice.ru/uploads/2018/3/14/a8def9f624ba863844433f15dd06853e-full.jpg', 'С этим великолепным геймпадом побеждать в Fifa станет намного легче и приятнее.', 900, 4, '2018-05-17 18:03:02', '2018-05-23 22:04:31', 1),
(6, 'Запанки', '0006', 'Ювентус', 'https://cdn1.savepice.ru/uploads/2018/3/14/3c60006ee55e20226ae625dada3deb15-full.jpg', 'Стильные запанки с логотипом Ювентуса станут отличным аксессуаром для самого преданного фаната.', 380, 2, '2018-05-17 18:03:02', '2018-05-23 22:04:31', 1),
(7, 'Кепка', '0007', 'Милан', 'https://cdn1.savepice.ru/uploads/2018/5/24/9ea3ec32b6fb1945fe32ac5416ea3a14-full.jpg', 'Кепка с эмблемой футбольного клуба Милан', 250, 1, '2018-05-23 21:50:27', '2018-05-23 21:50:27', 1),
(8, 'Рюкзак', '0008', 'Милан', 'https://cdn1.savepice.ru/uploads/2018/5/24/3cb23f485ad529aa8903da8964f25801-full.jpg', 'Рюкзак с логотипом футбольного клуба Милан', 1400, 2, '2018-05-23 21:51:58', '2018-05-23 21:51:58', 1),
(9, 'Форма', '0009', 'Милан', 'https://cdn1.savepice.ru/uploads/2018/5/24/82042c537ddd905f721a19dc83c83c39-full.jpg', 'Форма Милана', 1800, 1, '2018-05-23 21:53:09', '2018-05-23 21:53:09', 1),
(10, 'Мяч', '0010', 'Милан', 'https://cdn1.savepice.ru/uploads/2018/5/24/cc250cd12b37c1416408cfd48129b346-full.jpg', 'Сувенирный футбольный мяч с автографами игроков Милана', 3000, 2, '2018-05-23 21:54:07', '2018-05-23 21:54:07', 1),
(11, 'Наушники', '0011', 'Барселона', 'https://cdn1.savepice.ru/uploads/2018/5/24/abe3cad078e5d3ee37956db1cdbee8e1-full.jpg', 'Наушники с эмблемой Барселоны', 1100, 4, '2018-05-23 21:57:08', '2018-05-23 22:04:31', 1),
(12, 'Кепка', '0012', 'Барселона', 'https://cdn1.savepice.ru/uploads/2018/5/24/ffa041b021f28f89ea7b819cc2f42d1c-full.jpg', 'Кепка с эмблемой футбольного клуба Барселона', 250, 1, '2018-05-23 21:58:15', '2018-05-23 22:04:31', 1),
(13, 'Кресло-мешок', '0013', 'Барселона', 'https://cdn1.savepice.ru/uploads/2018/5/24/df36c8e11acab7de06afb528c0fcbe67-full.jpg', 'Кресло-мешок, декорированное в стиле футбольного клуба Барселона', 3500, 3, '2018-05-23 21:59:25', '2018-05-23 22:04:31', 1),
(14, 'Геймпад', '0014', 'Барселона', 'https://cdn1.savepice.ru/uploads/2018/5/24/c314e4bf4fd064e48f573b9540b87ee3-full.jpg', 'Джойстик с эмблемой футбольного клуба Барселона', 1750, 4, '2018-05-23 22:00:23', '2018-05-23 22:04:31', 1),
(15, 'Форма', '0015', 'Барселона', 'https://cdn1.savepice.ru/uploads/2018/5/24/9a4b2eeb8153232d23f78bd3535c0822-full.jpg', 'Футбольная форма Барселоны', 1800, 1, '2018-05-23 22:01:10', '2018-05-23 22:04:31', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Виталий Демидов', 'vitaliydemidov13@gmail.com', '380331313133', '12345678', '2018-05-17 18:36:15', '2018-05-17 18:36:15'),
(2, 'Анастасия Демидова', 'lamabro15@gmail.com', '0551355535', '12345678', '2018-05-17 18:36:15', '2018-05-17 18:36:15');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders_to_products`
--
ALTER TABLE `orders_to_products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
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
-- AUTO_INCREMENT для таблицы `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `orders_to_products`
--
ALTER TABLE `orders_to_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

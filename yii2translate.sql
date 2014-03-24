-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Мар 24 2014 г., 15:11
-- Версия сервера: 5.5.32
-- Версия PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `yii2translate`
--
CREATE DATABASE IF NOT EXISTS `yii2translate` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `yii2translate`;

-- --------------------------------------------------------

--
-- Структура таблицы `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `cat_id` int(11) NOT NULL COMMENT 'ID категории',
  `title` varchar(255) NOT NULL COMMENT 'заголовок',
  `text` text NOT NULL COMMENT 'текст',
  `img` varchar(4) DEFAULT NULL COMMENT 'изображение',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'статус',
  `views` int(11) DEFAULT '0' COMMENT 'просмотры',
  `author` int(11) NOT NULL COMMENT 'автор',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Дамп данных таблицы `article`
--

INSERT INTO `article` (`id`, `cat_id`, `title`, `text`, `img`, `status`, `views`, `author`, `created_at`, `updated_at`) VALUES
(1, 2, 'заголовок1', '<p>asdasdasd</p>\r\n', '', 1, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 'заголовок1asd', '<p>asdasd</p>\r\n', '', 0, 0, 1, '2014-03-21 16:05:31', '2014-03-21 16:09:00'),
(3, 3, 'asd', '<p>asdasd</p>\r\n', '', 1, 0, 1, '2014-03-21 16:09:35', '2014-03-21 16:09:52'),
(4, 2, 'sdf', '<p>sdfsdf</p>\r\n', 'isp ', 1, 0, 1, '2014-03-22 02:36:11', '2014-03-22 02:37:24'),
(5, 2, 'ыва', '<p>ыва</p>\r\n', 'cron', 1, 0, 1, '2014-03-22 02:47:35', '2014-03-22 02:47:49'),
(7, 2, 'ячс', '<p>ячс</p>\r\n', '', 1, 0, 1, '2014-03-22 03:34:59', '2014-03-22 03:45:49'),
(8, 2, 'заголовок1zxc', '<p>zxc</p>\r\n', '', 1, 0, 1, '2014-03-22 03:54:42', '2014-03-22 03:54:42'),
(9, 2, 'asdasdaxcv', '<p>xcvxcv</p>\r\n', '', 1, 0, 1, '2014-03-22 03:57:29', '2014-03-22 03:59:35'),
(10, 2, 'asdasd', '<p>vbnvbn</p>\r\n', '', 1, 0, 1, '2014-03-22 04:00:04', '2014-03-22 04:00:04'),
(11, 2, 'asdasd3', '<p>asd</p>\r\n', '', 1, 0, 1, '2014-03-23 03:15:24', '2014-03-23 03:15:24'),
(12, 2, 'sdfsdf', '<p>sdfsdf</p>\r\n', '', 1, 0, 1, '2014-03-23 03:24:18', '2014-03-23 03:57:15'),
(13, 2, 'sdfsdfsdf', '<p>sdf</p>\r\n', '', 1, 0, 1, '2014-03-23 06:06:15', '2014-03-23 06:06:15'),
(14, 2, 'sdfxcv', '<p>sdf</p>\r\n', '', 1, 0, 1, '2014-03-23 06:09:10', '2014-03-23 06:09:10'),
(15, 2, 'dfg', '<p>vbn</p>\r\n', '', 1, 0, 1, '2014-03-23 06:21:23', '2014-03-23 06:21:23'),
(16, 2, 'заголовок1fgh', '<p>asdsad</p>\r\n', '', 1, 0, 1, '2014-03-23 06:32:55', '2014-03-23 06:32:55'),
(17, 2, 'asdxcvxcv', '<p>asd</p>\r\n', 'crac', 1, 0, 1, '2014-03-23 06:36:30', '2014-03-23 06:36:30'),
(18, 2, 'fgh', '<p>fgh</p>\r\n', 'phps', 1, 0, 1, '2014-03-23 06:36:54', '2014-03-23 06:36:54');

-- --------------------------------------------------------

--
-- Структура таблицы `article_tag`
--

CREATE TABLE IF NOT EXISTS `article_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `article_id` int(11) NOT NULL COMMENT 'ID статьи',
  `tag_id` int(11) NOT NULL COMMENT 'ID тега',
  PRIMARY KEY (`id`),
  KEY `article_id_fk` (`article_id`),
  KEY `tag_id_fk` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `parent_id` int(11) DEFAULT NULL COMMENT 'ID родительской категории',
  `materialized_path` varchar(255) DEFAULT NULL COMMENT 'материализованный путь категории',
  `title` varchar(100) NOT NULL COMMENT 'заголовок',
  `description` varchar(255) DEFAULT NULL COMMENT 'описание',
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`),
  KEY `category_alfk_1` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `parent_id`, `materialized_path`, `title`, `description`) VALUES
(1, NULL, NULL, 'Category1 1', '<p>Category 1 описание1</p>\r\n'),
(2, 1, '1', 'asd', '<p>asdasd</p>\r\n'),
(3, 2, '1.2', 'фыв', '<p>ф<em>ыв</em>фы<strong>вфыв</strong></p>\r\n');

-- --------------------------------------------------------

--
-- Структура таблицы `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `tag`
--

INSERT INTO `tag` (`id`, `title`) VALUES
(1, 'asd'),
(2, 'asdasd');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_migration`
--

CREATE TABLE IF NOT EXISTS `tbl_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_migration`
--

INSERT INTO `tbl_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1392726963),
('m130524_201442_init', 1392727068);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `role` smallint(6) NOT NULL DEFAULT '10',
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'administrator', '6Ff07K2rEFJkDFNrUUltG3_svHKRRJfw', '$2y$13$Pyqm2kx8yTmb8dBeR3Yc5.yz5lp0YY/msGD1eSALx8xyWW/XXJ3cm', NULL, 'admin@admin.com', 10, 10, 1392727175, 1392727175);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `article_tag`
--
ALTER TABLE `article_tag`
  ADD CONSTRAINT `article_id_fk` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tag_id_fk` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_alfk_1` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

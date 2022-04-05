-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 05 Nis 2022, 18:20:00
-- Sunucu sürümü: 8.0.21
-- PHP Sürümü: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `artgallery`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `actions`
--

DROP TABLE IF EXISTS `actions`;
CREATE TABLE IF NOT EXISTS `actions` (
  `action_id` int NOT NULL AUTO_INCREMENT,
  `art_id` int NOT NULL,
  `member_id` int NOT NULL,
  `sales_price` int NOT NULL,
  `action_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`action_id`)
) ENGINE=InnoDB AUTO_INCREMENT=233 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `actions`
--

INSERT INTO `actions` (`action_id`, `art_id`, `member_id`, `sales_price`, `action_date`) VALUES
(193, 7, 1, 7000, '2020-06-09 02:54:36'),
(196, 1, 1, 18000, '2020-06-19 21:00:00'),
(199, 48, 1, 18000, '2020-07-01 16:02:39'),
(232, 0, 1, 5000, '2020-07-22 02:02:10');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `artists`
--

DROP TABLE IF EXISTS `artists`;
CREATE TABLE IF NOT EXISTS `artists` (
  `artist_id` int NOT NULL AUTO_INCREMENT,
  `artist_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `artist_lastname` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `artist_email` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `artist_mobile` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `record_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`artist_id`)
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `artists`
--

INSERT INTO `artists` (`artist_id`, `artist_name`, `artist_lastname`, `artist_email`, `artist_mobile`, `record_date`) VALUES
(1, 'Hüseyin', 'Sartaş', 'hsartas@gmail.com', '5305102764', '0000-00-00 00:00:00'),
(2, 'Abidin', 'Dino', '', '', '0000-00-00 00:00:00'),
(3, 'Salvador', 'Dali', '', '', '0000-00-00 00:00:00'),
(14, 'Pablo', 'Picasso', '', '', '0000-00-00 00:00:00'),
(103, 'Osman', 'Hamdi', '', '', '0000-00-00 00:00:00'),
(130, 'Emin', 'Kabacaoglu', '', '', '2020-04-21 20:30:07');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `arts`
--

DROP TABLE IF EXISTS `arts`;
CREATE TABLE IF NOT EXISTS `arts` (
  `art_id` int NOT NULL AUTO_INCREMENT,
  `art_no` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `art_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `art_year` varchar(4) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `arttype_id` int NOT NULL,
  `art_status` enum('1','2','3') CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL DEFAULT '1',
  `artist_id` int NOT NULL,
  `member_id` int NOT NULL,
  `art_size` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `art_detail` varchar(150) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `art_file` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `instagram_status` enum('0','1') CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL DEFAULT '0',
  `twitter_status` enum('0','1') CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL DEFAULT '0',
  `facebook_status` enum('0','1') CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL DEFAULT '0',
  `record_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`art_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `arts`
--

INSERT INTO `arts` (`art_id`, `art_no`, `art_name`, `art_year`, `arttype_id`, `art_status`, `artist_id`, `member_id`, `art_size`, `art_detail`, `art_file`, `instagram_status`, `twitter_status`, `facebook_status`, `record_date`) VALUES
(1, '', 'Kaplumbağa Terbiyecisi', '', 1, '3', 103, 0, '222x122', 'Tuval üzeri yağlı boya', '5ea3a43a4566b.jpg', '0', '0', '0', '2020-04-20 01:17:28'),
(7, '123', 'Yeni Eserim', '', 1, '3', 130, 0, '120x120', 'Canvas üzerine yağlı boya', '5ea3b62bd3b2b.jpg', '1', '0', '0', '2020-04-21 20:30:33'),
(22, '', 'Gece Rüyası', '', 1, '2', 3, 0, '120x140', 'Canvas yağlı boya', '5ea570a9b7815.jpg', '0', '1', '1', '2020-04-26 11:29:45'),
(23, '', 'Yeni Eserim', '', 1, '1', 2, 0, '120x1200', 'Canvas üzerine yağlı boya', '5eeda00259c4c.jpg', '0', '1', '0', '2020-04-26 11:51:25'),
(48, '', 'Kedi', '1111', 1, '3', 2, 0, '120x120', 'Tuval üzeri yağlı boya', '5efca2cfe64b5.jpg', '0', '1', '0', '2020-07-01 14:50:55'),
(49, '', 'Yeni Eserim3', '2012', 2, '1', 130, 0, '222x122', 'detay test', '5efef97d6751f.jpg', '0', '0', '0', '2020-07-03 09:25:17');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `artstatus`
--

DROP TABLE IF EXISTS `artstatus`;
CREATE TABLE IF NOT EXISTS `artstatus` (
  `artstatus_id` int NOT NULL AUTO_INCREMENT,
  `artstatus_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`artstatus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `arttype`
--

DROP TABLE IF EXISTS `arttype`;
CREATE TABLE IF NOT EXISTS `arttype` (
  `arttype_id` int NOT NULL AUTO_INCREMENT,
  `arttype_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`arttype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `arttype`
--

INSERT INTO `arttype` (`arttype_id`, `arttype_name`) VALUES
(1, 'Resim'),
(2, 'Heykel');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `art_consignment`
--

DROP TABLE IF EXISTS `art_consignment`;
CREATE TABLE IF NOT EXISTS `art_consignment` (
  `consignment_id` int NOT NULL AUTO_INCREMENT,
  `art_id` int NOT NULL,
  `consignment_price` int NOT NULL,
  `consignment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`consignment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `art_consignment`
--

INSERT INTO `art_consignment` (`consignment_id`, `art_id`, `consignment_price`, `consignment_date`) VALUES
(3, 22, 7500, '2020-06-14 07:22:14');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `art_list_price`
--

DROP TABLE IF EXISTS `art_list_price`;
CREATE TABLE IF NOT EXISTS `art_list_price` (
  `list_price_id` int NOT NULL AUTO_INCREMENT,
  `list_price_amount` int NOT NULL,
  `art_id` int NOT NULL,
  `list_price_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`list_price_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `art_list_price`
--

INSERT INTO `art_list_price` (`list_price_id`, `list_price_amount`, `art_id`, `list_price_date`) VALUES
(5, 5000, 7, '2020-05-16 23:49:47');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `art_payment`
--

DROP TABLE IF EXISTS `art_payment`;
CREATE TABLE IF NOT EXISTS `art_payment` (
  `payment_id` int NOT NULL AUTO_INCREMENT,
  `art_id` int NOT NULL,
  `member_id` int NOT NULL,
  `payment_price` int NOT NULL,
  `payment_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `art_payment`
--

INSERT INTO `art_payment` (`payment_id`, `art_id`, `member_id`, `payment_price`, `payment_date`) VALUES
(11, 1, 1, 5000, '2020-06-20 06:02:39');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `art_purchase`
--

DROP TABLE IF EXISTS `art_purchase`;
CREATE TABLE IF NOT EXISTS `art_purchase` (
  `purchase_id` int NOT NULL AUTO_INCREMENT,
  `art_id` int NOT NULL,
  `member_id` int NOT NULL,
  `purchase_price` int NOT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`purchase_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `art_purchase`
--

INSERT INTO `art_purchase` (`purchase_id`, `art_id`, `member_id`, `purchase_price`, `purchase_date`) VALUES
(4, 22, 1, 5000, '2020-06-04 20:21:24');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `art_reservation`
--

DROP TABLE IF EXISTS `art_reservation`;
CREATE TABLE IF NOT EXISTS `art_reservation` (
  `reservation_id` int NOT NULL AUTO_INCREMENT,
  `art_id` int NOT NULL,
  `member_id` int NOT NULL,
  `reservation_price` int NOT NULL,
  `reservation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`reservation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `art_reservation`
--

INSERT INTO `art_reservation` (`reservation_id`, `art_id`, `member_id`, `reservation_price`, `reservation_date`) VALUES
(8, 23, 2, 5500000, '2020-06-14 10:16:54'),
(12, 22, 1, 12000, '2021-05-16 14:15:11');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `expenses`
--

DROP TABLE IF EXISTS `expenses`;
CREATE TABLE IF NOT EXISTS `expenses` (
  `expense_id` int NOT NULL AUTO_INCREMENT,
  `expensetype_id` int NOT NULL,
  `expense_amount` float NOT NULL,
  `expense_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`expense_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `expenses`
--

INSERT INTO `expenses` (`expense_id`, `expensetype_id`, `expense_amount`, `expense_date`) VALUES
(2, 3, 123.34, '2020-06-11 23:40:04'),
(3, 3, 123.55, '2020-07-01 19:05:53'),
(11, 5, 123.77, '2020-07-01 19:34:51'),
(12, 5, 100.55, '2020-05-02 01:06:49');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `expensetype`
--

DROP TABLE IF EXISTS `expensetype`;
CREATE TABLE IF NOT EXISTS `expensetype` (
  `type_id` int NOT NULL AUTO_INCREMENT,
  `type_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `record_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `expensetype`
--

INSERT INTO `expensetype` (`type_id`, `type_name`, `record_date`) VALUES
(3, 'Elektrik', '2020-06-11 23:11:43'),
(5, 'Su', '2020-06-11 23:13:47'),
(6, 'İnternet', '2020-06-11 23:13:51');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `member_id` int NOT NULL AUTO_INCREMENT,
  `member_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `member_lastname` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `member_email` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `member_mobile` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `member_typeID` int NOT NULL,
  `member_address` varchar(250) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `member_recorddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `members`
--

INSERT INTO `members` (`member_id`, `member_name`, `member_lastname`, `member_email`, `member_mobile`, `member_typeID`, `member_address`, `member_recorddate`) VALUES
(1, 'Can', 'Çelebi', 'canceleb@hotmail.com', '555255556', 1, '', '2020-06-09 01:47:18'),
(2, 'Tolga', 'Küçükçınar', '', '', 1, '', '2020-06-09 01:47:18');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `user_lastname` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `user_username` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `user_password` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `user_photo` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `user_status` enum('0','1') CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL DEFAULT '1',
  `user_email` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `user_mobile` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_lastname`, `user_username`, `user_password`, `user_photo`, `user_status`, `user_email`, `user_mobile`) VALUES
(1, 'Emin', 'Kabacaoglu', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '5eeda0db2c7c0.jpg', '1', '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

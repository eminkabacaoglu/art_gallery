-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 14 Mar 2021, 23:56:22
-- Sunucu sürümü: 8.0.17
-- PHP Sürümü: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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

CREATE TABLE `actions` (
  `action_id` int(11) NOT NULL,
  `art_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `sales_price` int(11) NOT NULL,
  `action_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

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

CREATE TABLE `artists` (
  `artist_id` int(11) NOT NULL,
  `artist_name` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `artist_lastname` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `artist_email` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `artist_mobile` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `record_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

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

CREATE TABLE `arts` (
  `art_id` int(11) NOT NULL,
  `art_no` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `art_name` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `art_year` varchar(4) COLLATE utf8_turkish_ci NOT NULL,
  `arttype_id` int(11) NOT NULL,
  `art_status` enum('1','2','3') CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL DEFAULT '1',
  `artist_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `art_size` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `art_detail` varchar(150) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `art_file` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `instagram_status` enum('0','1') COLLATE utf8_turkish_ci NOT NULL DEFAULT '0',
  `twitter_status` enum('0','1') COLLATE utf8_turkish_ci NOT NULL DEFAULT '0',
  `facebook_status` enum('0','1') COLLATE utf8_turkish_ci NOT NULL DEFAULT '0',
  `record_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `arts`
--

INSERT INTO `arts` (`art_id`, `art_no`, `art_name`, `art_year`, `arttype_id`, `art_status`, `artist_id`, `member_id`, `art_size`, `art_detail`, `art_file`, `instagram_status`, `twitter_status`, `facebook_status`, `record_date`) VALUES
(1, '', 'Kaplumbağa Terbiyecisi', '', 1, '3', 103, 0, '222x122', 'Tuval üzeri yağlı boya', '5ea3a43a4566b.jpg', '0', '0', '0', '2020-04-20 01:17:28'),
(7, '123', 'Yeni Eserim', '', 1, '3', 130, 0, '120x120', 'Canvas üzerine yağlı boya', '5ea3b62bd3b2b.jpg', '1', '0', '0', '2020-04-21 20:30:33'),
(22, '', 'Gece Rüyası', '', 1, '1', 3, 0, '120x140', 'Canvas yağlı boya', '5ea570a9b7815.jpg', '0', '1', '1', '2020-04-26 11:29:45'),
(23, '', 'Yeni Eserim', '', 1, '1', 2, 0, '120x1200', 'Canvas üzerine yağlı boya', '5eeda00259c4c.jpg', '0', '1', '0', '2020-04-26 11:51:25'),
(48, '', 'Kedi', '1111', 1, '3', 2, 0, '120x120', 'Tuval üzeri yağlı boya', '5efca2cfe64b5.jpg', '0', '1', '0', '2020-07-01 14:50:55'),
(49, '', 'Yeni Eserim3', '2012', 2, '1', 130, 0, '222x122', 'detay test', '5efef97d6751f.jpg', '0', '0', '0', '2020-07-03 09:25:17');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `artstatus`
--

CREATE TABLE `artstatus` (
  `artstatus_id` int(11) NOT NULL,
  `artstatus_name` varchar(50) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `arttype`
--

CREATE TABLE `arttype` (
  `arttype_id` int(11) NOT NULL,
  `arttype_name` varchar(50) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

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

CREATE TABLE `art_consignment` (
  `consignment_id` int(11) NOT NULL,
  `art_id` int(11) NOT NULL,
  `consignment_price` int(11) NOT NULL,
  `consignment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `art_consignment`
--

INSERT INTO `art_consignment` (`consignment_id`, `art_id`, `consignment_price`, `consignment_date`) VALUES
(3, 22, 7500, '2020-06-14 07:22:14');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `art_list_price`
--

CREATE TABLE `art_list_price` (
  `list_price_id` int(11) NOT NULL,
  `list_price_amount` int(11) NOT NULL,
  `art_id` int(10) NOT NULL,
  `list_price_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `art_list_price`
--

INSERT INTO `art_list_price` (`list_price_id`, `list_price_amount`, `art_id`, `list_price_date`) VALUES
(1, 15000, 1, '2020-05-16 23:11:00'),
(5, 5000, 7, '2020-05-16 23:49:47'),
(43, 7000, 22, '2020-06-04 20:21:36');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `art_payment`
--

CREATE TABLE `art_payment` (
  `payment_id` int(11) NOT NULL,
  `art_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `payment_price` int(11) NOT NULL,
  `payment_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `art_payment`
--

INSERT INTO `art_payment` (`payment_id`, `art_id`, `member_id`, `payment_price`, `payment_date`) VALUES
(11, 1, 1, 5000, '2020-06-20 06:02:39');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `art_purchase`
--

CREATE TABLE `art_purchase` (
  `purchase_id` int(11) NOT NULL,
  `art_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `purchase_price` int(11) NOT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `art_purchase`
--

INSERT INTO `art_purchase` (`purchase_id`, `art_id`, `member_id`, `purchase_price`, `purchase_date`) VALUES
(4, 22, 1, 5000, '2020-06-04 20:21:24');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `art_reservation`
--

CREATE TABLE `art_reservation` (
  `reservation_id` int(11) NOT NULL,
  `art_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `reservation_price` int(11) NOT NULL,
  `reservation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `art_reservation`
--

INSERT INTO `art_reservation` (`reservation_id`, `art_id`, `member_id`, `reservation_price`, `reservation_date`) VALUES
(8, 23, 2, 5500000, '2020-06-14 10:16:54');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `expenses`
--

CREATE TABLE `expenses` (
  `expense_id` int(11) NOT NULL,
  `expensetype_id` int(11) NOT NULL,
  `expense_amount` float NOT NULL,
  `expense_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

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

CREATE TABLE `expensetype` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `record_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

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

CREATE TABLE `members` (
  `member_id` int(11) NOT NULL,
  `member_name` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `member_lastname` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `member_email` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `member_mobile` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `member_typeID` int(2) NOT NULL,
  `member_address` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `member_recorddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

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

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `user_lastname` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `user_username` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `user_password` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `user_photo` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `user_status` enum('0','1') COLLATE utf8_turkish_ci NOT NULL DEFAULT '1',
  `user_email` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `user_mobile` varchar(50) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_lastname`, `user_username`, `user_password`, `user_photo`, `user_status`, `user_email`, `user_mobile`) VALUES
(1, 'Emin', 'Kabacaoglu', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '5eeda0db2c7c0.jpg', '1', '', '');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`action_id`);

--
-- Tablo için indeksler `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`artist_id`);

--
-- Tablo için indeksler `arts`
--
ALTER TABLE `arts`
  ADD PRIMARY KEY (`art_id`);

--
-- Tablo için indeksler `artstatus`
--
ALTER TABLE `artstatus`
  ADD PRIMARY KEY (`artstatus_id`);

--
-- Tablo için indeksler `arttype`
--
ALTER TABLE `arttype`
  ADD PRIMARY KEY (`arttype_id`);

--
-- Tablo için indeksler `art_consignment`
--
ALTER TABLE `art_consignment`
  ADD PRIMARY KEY (`consignment_id`);

--
-- Tablo için indeksler `art_list_price`
--
ALTER TABLE `art_list_price`
  ADD PRIMARY KEY (`list_price_id`);

--
-- Tablo için indeksler `art_payment`
--
ALTER TABLE `art_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Tablo için indeksler `art_purchase`
--
ALTER TABLE `art_purchase`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Tablo için indeksler `art_reservation`
--
ALTER TABLE `art_reservation`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Tablo için indeksler `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expense_id`);

--
-- Tablo için indeksler `expensetype`
--
ALTER TABLE `expensetype`
  ADD PRIMARY KEY (`type_id`);

--
-- Tablo için indeksler `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `actions`
--
ALTER TABLE `actions`
  MODIFY `action_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;

--
-- Tablo için AUTO_INCREMENT değeri `artists`
--
ALTER TABLE `artists`
  MODIFY `artist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- Tablo için AUTO_INCREMENT değeri `arts`
--
ALTER TABLE `arts`
  MODIFY `art_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Tablo için AUTO_INCREMENT değeri `artstatus`
--
ALTER TABLE `artstatus`
  MODIFY `artstatus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `arttype`
--
ALTER TABLE `arttype`
  MODIFY `arttype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Tablo için AUTO_INCREMENT değeri `art_consignment`
--
ALTER TABLE `art_consignment`
  MODIFY `consignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `art_list_price`
--
ALTER TABLE `art_list_price`
  MODIFY `list_price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Tablo için AUTO_INCREMENT değeri `art_payment`
--
ALTER TABLE `art_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tablo için AUTO_INCREMENT değeri `art_purchase`
--
ALTER TABLE `art_purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `art_reservation`
--
ALTER TABLE `art_reservation`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tablo için AUTO_INCREMENT değeri `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `expensetype`
--
ALTER TABLE `expensetype`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

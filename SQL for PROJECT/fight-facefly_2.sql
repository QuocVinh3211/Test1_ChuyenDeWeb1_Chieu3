-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 10, 2019 lúc 03:37 AM
-- Phiên bản máy phục vụ: 10.1.38-MariaDB
-- Phiên bản PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `fight-facefly_2`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `airways`
--

CREATE TABLE `airways` (
  `airways_id` int(11) NOT NULL,
  `airways_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `airways`
--

INSERT INTO `airways` (`airways_id`, `airways_name`) VALUES
(1, 'Vietjet air'),
(2, 'Vietnam Airlines'),
(3, 'JetStar');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `flights`
--

CREATE TABLE `flights` (
  `flight_id` int(11) NOT NULL,
  `airways_id` int(11) NOT NULL,
  `flight_time_from` datetime NOT NULL,
  `flight_time_to` datetime NOT NULL,
  `flight_city_from_id` tinyint(4) NOT NULL,
  `flight_city_to_id` tinyint(4) NOT NULL,
  `flight_direction` int(11) NOT NULL,
  `flight_price` double NOT NULL,
  `flight_parent_id` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `flights`
--

INSERT INTO `flights` (`flight_id`, `airways_id`, `flight_time_from`, `flight_time_to`, `flight_city_from_id`, `flight_city_to_id`, `flight_direction`, `flight_price`, `flight_parent_id`) VALUES
(3, 2, '2019-02-22 18:45:00', '2019-02-22 19:50:00', 1, 2, 0, 823, 0),
(4, 2, '2019-02-22 18:00:00', '2019-02-22 02:55:00', 3, 4, 1, 431, 3),
(5, 3, '2019-02-22 17:45:00', '2019-02-22 03:00:00', 5, 6, 1, 4315, 0),
(6, 1, '2019-02-22 18:45:00', '2019-02-22 02:55:00', 2, 4, 0, 5000, 0),
(7, 2, '2019-02-22 14:30:00', '2019-02-22 02:55:00', 2, 3, 0, 5000, 5),
(8, 1, '2019-02-22 14:30:00', '2019-02-22 02:55:00', 2, 3, 0, 50000, 0),
(9, 3, '2019-02-22 18:45:00', '2019-02-22 19:50:00', 1, 2, 1, 823, 0),
(10, 1, '2019-02-22 17:45:00', '2019-02-22 02:50:00', 2, 1, 1, 1000, 0),
(11, 3, '2019-02-22 18:00:00', '2019-02-22 02:55:00', 2, 1, 1, 431, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `flights_booking`
--

CREATE TABLE `flights_booking` (
  `booking_id` int(11) NOT NULL,
  `user_id` tinyint(4) NOT NULL,
  `flight_id` int(11) NOT NULL,
  `total_price` double NOT NULL,
  `Payment_Method` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `card_number` int(3) DEFAULT NULL,
  `card_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ccv_code` int(3) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `flights_booking`
--

INSERT INTO `flights_booking` (`booking_id`, `user_id`, `flight_id`, `total_price`, `Payment_Method`, `card_number`, `card_name`, `ccv_code`, `updated_at`, `created_at`) VALUES
(1, 5, 3, 8230, 'transfer', 122, 'QuocVinh', 123, '2019-03-05 22:17:04', '2019-03-05 22:17:04'),
(2, 5, 3, 823, 'transfer', NULL, NULL, NULL, '2019-03-07 09:10:02', '2019-03-07 09:10:02'),
(3, 6, 1, 20000, 'transfer', NULL, NULL, NULL, '2019-03-09 17:37:39', '2019-03-09 17:37:39'),
(4, 5, 1, 20000, 'transfer', NULL, NULL, NULL, '2019-03-10 08:04:40', '2019-03-10 08:04:40'),
(5, 5, 1, 20000, 'transfer', NULL, NULL, NULL, '2019-03-10 08:05:09', '2019-03-10 08:05:09'),
(6, 5, 1, 20000, 'transfer', NULL, NULL, NULL, '2019-03-10 08:06:21', '2019-03-10 08:06:21'),
(7, 5, 1, 20000, 'transfer', NULL, NULL, NULL, '2019-03-10 08:10:22', '2019-03-10 08:10:22'),
(8, 5, 1, 20000, 'transfer', NULL, NULL, NULL, '2019-03-10 08:11:00', '2019-03-10 08:11:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `list_cities`
--

CREATE TABLE `list_cities` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `list_cities`
--

INSERT INTO `list_cities` (`city_id`, `city_name`, `city_code`) VALUES
(1, 'TP. Hồ Chí Minh', 'SNG'),
(2, 'Hà Nội', 'HAN'),
(3, 'Singapore', 'SIN'),
(4, 'PuSan', 'PUS'),
(5, 'Đà Nẵng', 'DAD'),
(6, 'Đà Lạt', 'DAL');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `passengers`
--

CREATE TABLE `passengers` (
  `passenger_id` int(11) NOT NULL,
  `passenger_title` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `passenger_first_name` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `passenger_last_name` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `passenger_user_id` tinyint(4) NOT NULL,
  `passenger_fl_id` tinyint(4) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `transit`
--

CREATE TABLE `transit` (
  `transit_id` int(11) NOT NULL,
  `transit_city_id` tinyint(4) NOT NULL,
  `transit_time` datetime NOT NULL,
  `flight_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_phone` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_gender` int(2) DEFAULT NULL,
  `user_bird` date DEFAULT NULL,
  `user_adress` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attempt` int(2) DEFAULT NULL,
  `last_access` datetime DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `user_phone`, `user_gender`, `user_bird`, `user_adress`, `attempt`, `last_access`, `remember_token`, `created_at`, `updated_at`) VALUES
(5, 'quocvinh', 'admin@gmail.com', NULL, '$2y$10$AS1nGOi/mtM/UXPtnHV.M.nmbSh4R.nA9GKF8XCojeyFO4dQ0jKea', '0123456789', 1, '1997-10-20', 'TP. Hồ Chí Minh', 0, '2019-03-10 08:04:24', NULL, '2019-03-05 09:07:43', '2019-03-10 01:04:25'),
(6, 'Vinh QUoc Duong', 'user@gmail.com', NULL, '$2y$10$C4xfNMTQB81ShKN1fyb8X.rQop.dFQ9Rh4vW2ZV5NdHWTSgKZYly6', NULL, NULL, NULL, NULL, 0, '2019-03-09 05:33:56', NULL, '2019-03-07 02:45:17', '2019-03-09 10:33:56'),
(7, 'Trieu tu Long', 'admin2@gmail.com', NULL, '$2y$10$xgy/tkKafKTDZYMv7k.49e6ZYe822H74cvyQ14ejglG4BFs4UXFOO', NULL, 1, '1997-10-20', 'TP. Hồ Chí Minh', NULL, NULL, NULL, '2019-03-07 02:47:54', '2019-03-07 02:48:31');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `airways`
--
ALTER TABLE `airways`
  ADD PRIMARY KEY (`airways_id`),
  ADD UNIQUE KEY `airways_id` (`airways_id`),
  ADD KEY `airways_id_2` (`airways_id`);

--
-- Chỉ mục cho bảng `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`flight_id`),
  ADD UNIQUE KEY `flight_id` (`flight_id`),
  ADD KEY `flight_id_2` (`flight_id`),
  ADD KEY `airways_id` (`airways_id`),
  ADD KEY `flight_city_to_id` (`flight_city_to_id`),
  ADD KEY `flight_city_from_id` (`flight_city_from_id`);

--
-- Chỉ mục cho bảng `flights_booking`
--
ALTER TABLE `flights_booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Chỉ mục cho bảng `list_cities`
--
ALTER TABLE `list_cities`
  ADD PRIMARY KEY (`city_id`),
  ADD KEY `city_id` (`city_id`);

--
-- Chỉ mục cho bảng `passengers`
--
ALTER TABLE `passengers`
  ADD PRIMARY KEY (`passenger_id`);

--
-- Chỉ mục cho bảng `transit`
--
ALTER TABLE `transit`
  ADD PRIMARY KEY (`transit_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `airways`
--
ALTER TABLE `airways`
  MODIFY `airways_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `flights`
--
ALTER TABLE `flights`
  MODIFY `flight_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `flights_booking`
--
ALTER TABLE `flights_booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `list_cities`
--
ALTER TABLE `list_cities`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `passengers`
--
ALTER TABLE `passengers`
  MODIFY `passenger_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `transit`
--
ALTER TABLE `transit`
  MODIFY `transit_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `flights`
--
ALTER TABLE `flights`
  ADD CONSTRAINT `flights_ibfk_1` FOREIGN KEY (`airways_id`) REFERENCES `airways` (`airways_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

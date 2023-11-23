-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 23-11-23 16:19
-- 서버 버전: 10.4.11-MariaDB
-- PHP 버전: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `laravel`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `json_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`json_data`)),
  `type` enum('complete','accept','cancel') COLLATE utf8_bin NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 테이블의 덤프 데이터 `orders`
--

INSERT INTO `orders` (`id`, `reservation_id`, `json_data`, `type`, `create_date`) VALUES
(1, 1, '{\"orderList\":[3,0,0,0,0],\"tool\":true}', 'cancel', '2023-03-29'),
(2, 5, '{\"orderList\":[2,0,0,0,0],\"tool\":true}', 'accept', '2023-03-29'),
(3, 5, '{\"orderList\":[0,0,0,0,0],\"tool\":false}', 'accept', '2023-03-29'),
(4, 5, '{\"orderList\":[0,0,0,0,0],\"tool\":false}', 'cancel', '2023-03-29'),
(5, 5, '{\"orderList\":[0,0,0,0,0],\"tool\":false}', 'cancel', '2023-03-29'),
(6, 5, '{\"orderList\":[3,0,0,0,0],\"tool\":true}', 'cancel', '2023-03-29'),
(7, 6, '{\"orderList\":[3,0,0,0,0],\"tool\":true}', 'cancel', '2023-03-29'),
(8, 7, '{\"orderList\":[0,0,0,0,0],\"tool\":false}', 'accept', '2023-03-30');

-- --------------------------------------------------------

--
-- 테이블 구조 `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_bin NOT NULL,
  `phone` varchar(20) COLLATE utf8_bin NOT NULL,
  `date` date NOT NULL,
  `place` varchar(20) COLLATE utf8_bin NOT NULL,
  `type` enum('ongoing','complete') COLLATE utf8_bin NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 테이블의 덤프 데이터 `reservations`
--

INSERT INTO `reservations` (`id`, `name`, `phone`, `date`, `place`, `type`, `create_date`) VALUES
(2, '박재형', '010-8907-5877', '2023-03-29', 'A01', 'ongoing', '2023-03-29'),
(3, '박재형', '010-8907-5877', '2023-03-30', 'A02', 'ongoing', '2023-03-29'),
(4, '박재형', '010-8907-5877', '2023-04-03', 'T09', 'ongoing', '2023-03-29'),
(5, '박재형', '010-8907-5877', '2023-03-31', 'A03', 'ongoing', '2023-03-29'),
(6, '박재형', '010-8907-5877', '2023-04-01', 'A04', 'ongoing', '2023-03-29'),
(7, '박동구', '010-5877-4981', '2023-04-04', 'A05', 'ongoing', '2023-03-30');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 테이블의 AUTO_INCREMENT `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

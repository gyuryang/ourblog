-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 19-07-26 06:46
-- 서버 버전: 10.1.37-MariaDB
-- PHP 버전: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `ourblog`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `board`
--

CREATE TABLE `board` (
  `idx` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `write_date` text NOT NULL,
  `category` text NOT NULL,
  `username` text NOT NULL,
  `img` text NOT NULL,
  `uidx` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `board`
--

INSERT INTO `board` (`idx`, `title`, `content`, `write_date`, `category`, `username`, `img`, `uidx`) VALUES
(19, '1', '1', '2019-07-26 01:54:28', 'life', 'ThirdUser', '', 3),
(20, 'dsaadcc', 'dasadsadasd', '2019-07-26 01:58:27', 'life', 'ThirdUser', 'char_bg.jpg', 3),
(28, '3123', '1', '2019-07-26 13:23:46', 'life', 'ThirdUser', '', 3),
(29, 'dasdad1', 'dsasda', '2019-07-26 13:23:50', 'life', 'ThirdUser', '', 3),
(30, 'ggggg', 'ggg1ggg', '2019-07-26 13:23:57', 'life', 'ThirdUser', '', 3),
(31, 'bbbbbbbbbbbbbbbb', 'bbbbbbbbbbbbb1', '2019-07-26 13:24:05', 'life', 'ThirdUser', '', 3),
(32, 'aaaaa1aaa', 'aaaa', '2019-07-26 13:25:26', 'life', 'SecondId', '', 2),
(33, 'aaaaavvvvv\'1\'', 'dasas', '2019-07-26 13:25:59', 'fashion', 'SecondId', '', 2);

-- --------------------------------------------------------

--
-- 테이블 구조 `coment`
--

CREATE TABLE `coment` (
  `idx` int(11) NOT NULL,
  `username` text NOT NULL,
  `id` text NOT NULL,
  `write_date` text NOT NULL,
  `content` text NOT NULL,
  `aidx` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `coment`
--

INSERT INTO `coment` (`idx`, `username`, `id`, `write_date`, `content`, `aidx`) VALUES
(1, 'ThirdUser', 'fff@fff.fff', '2019-07-26 03:05:17', '1', 20),
(6, 'ThirdUser', 'fff@fff.fff', '2019-07-26 11:30:23', '2', 19),
(7, 'ThirdUser', 'fff@fff.fff', '2019-07-26 12:05:24', '3', 20),
(9, 'SecondId', 'ddd@ddd.com', '2019-07-26 12:53:12', 'dd', 20);

-- --------------------------------------------------------

--
-- 테이블 구조 `user`
--

CREATE TABLE `user` (
  `idx` int(11) NOT NULL,
  `id` varchar(255) NOT NULL,
  `pw` text NOT NULL,
  `username` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `user`
--

INSERT INTO `user` (`idx`, `id`, `pw`, `username`) VALUES
(1, 'aaa@aaa.aaa', 'aa123', 'FirstId'),
(2, 'ddd@ddd.com', 'dd123', 'SecondId'),
(3, 'fff@fff.fff', 'ff123', 'ThirdUser');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `board`
--
ALTER TABLE `board`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `coment`
--
ALTER TABLE `coment`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idx`),
  ADD UNIQUE KEY `id` (`id`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `board`
--
ALTER TABLE `board`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- 테이블의 AUTO_INCREMENT `coment`
--
ALTER TABLE `coment`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 테이블의 AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

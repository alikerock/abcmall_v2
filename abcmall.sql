-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 23-08-18 09:45
-- 서버 버전: 10.4.28-MariaDB
-- PHP 버전: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `abcmall`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `admins`
--

CREATE TABLE `admins` (
  `idx` int(11) NOT NULL,
  `userid` varchar(10) NOT NULL,
  `email` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `passwd` varchar(200) NOT NULL,
  `regdate` datetime NOT NULL,
  `level` int(4) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `end_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `admins`
--

INSERT INTO `admins` (`idx`, `userid`, `email`, `username`, `passwd`, `regdate`, `level`, `last_login`, `end_login`) VALUES
(1, 'admin', 'admin@shop.com', '관리자', '33275a8aa48ea918bd53a9181aa975f15ab0d0645398f5918a006d08675c1cb27d5c645dbd084eee56e675e25ba4019f2ecea37ca9e2995b49fcb12c096a032e', '2023-01-01 17:12:32', 100, '2023-08-18 09:34:06', NULL);

-- --------------------------------------------------------

--
-- 테이블 구조 `category`
--

CREATE TABLE `category` (
  `cid` int(11) NOT NULL,
  `code` varchar(10) DEFAULT NULL,
  `pcode` varchar(10) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `step` tinyint(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `category`
--

INSERT INTO `category` (`cid`, `code`, `pcode`, `name`, `step`) VALUES
(1, 'A0001', NULL, '컴퓨터', 1),
(2, 'B0001', 'A0001', '노트북', 2),
(3, 'C0001', 'B0001', '게임용', 3),
(4, 'A0002', '', '핸드폰', 1),
(5, 'A0003', '', '태블릿', 1),
(6, 'A0004', '', '스마트기기', 1),
(7, 'B0002', 'A0001', '맥북', 2),
(8, 'C0002', 'B0001', '그램', 3);

-- --------------------------------------------------------

--
-- 테이블 구조 `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `cate` varchar(100) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `thumbnail` varchar(100) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `sale_price` double DEFAULT NULL,
  `sale_ratio` double DEFAULT NULL,
  `cnt` int(11) DEFAULT NULL,
  `sale_cnt` int(11) DEFAULT NULL,
  `isnew` tinyint(4) DEFAULT NULL,
  `isbest` tinyint(4) DEFAULT NULL,
  `isrecom` tinyint(4) DEFAULT NULL,
  `ismain` tinyint(4) DEFAULT NULL,
  `locate` tinyint(4) DEFAULT NULL,
  `userid` varchar(100) DEFAULT NULL,
  `sale_end_date` datetime DEFAULT NULL,
  `reg_date` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `delivery_fee` double DEFAULT NULL,
  `file_table_id` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `products`
--

INSERT INTO `products` (`pid`, `name`, `cate`, `content`, `thumbnail`, `price`, `sale_price`, `sale_ratio`, `cnt`, `sale_cnt`, `isnew`, `isbest`, `isrecom`, `ismain`, `locate`, `userid`, `sale_end_date`, `reg_date`, `status`, `delivery_fee`, `file_table_id`) VALUES
(4, '이도령', 'A0001B0001C0001', '<p>설명 테스트&nbsp;</p>', '/abcmall/pdata/20230817082025160738.jpg', 90000, 0, 0, 0, 0, 1, 1, 0, 1, 1, 'admin', '2024-02-17 00:00:00', '2023-08-17 15:20:25', 0, 0, '21,22,23'),
(5, '이도령', 'A0001B0001C0002', '<p><span style=\"font-weight: 700;\">상세설명 테스트</span><br></p>', '/abcmall/pdata/20230817083343471645.jpg', 100000, 0, 0, 0, 0, 1, 1, 1, 1, 2, 'admin', '2024-02-17 00:00:00', '2023-08-17 15:33:43', 0, 0, '24'),
(6, '글쓴이1', 'A0001B0002', '<p><span style=\"font-weight: 700;\">상세설명</span><br></p>', '/abcmall/pdata/20230817083612132442.jpg', 30000, 0, 0, 0, 0, 1, 1, 1, 1, 1, 'admin', '2024-02-17 00:00:00', '2023-08-17 15:36:12', 0, 0, '25,26'),
(7, '이도령', 'A0001B0001C0002', '<p>ㅇㅁㄴㅇㄻㄴㄹㅇ</p>', '/abcmall/pdata/20230817084520119710.jpg', 30000, 0, 0, 0, 0, 1, 0, 0, 0, 1, 'admin', '2024-02-17 00:00:00', '2023-08-17 15:45:20', 0, 0, '27'),
(8, '이도령', 'A0001B0001C0002', '<p>ㅇㅁㄴㅇㄻㄴㄹㅇ</p>', '/abcmall/pdata/20230817090250130090.jpg', 30000, 0, 0, 0, 0, 1, 0, 0, 0, 1, 'admin', '2024-02-17 00:00:00', '2023-08-17 16:02:50', 1, 0, '27');

-- --------------------------------------------------------

--
-- 테이블 구조 `product_image_table`
--

CREATE TABLE `product_image_table` (
  `imgid` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `userid` varchar(100) DEFAULT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `regdate` datetime DEFAULT current_timestamp(),
  `status` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `product_image_table`
--

INSERT INTO `product_image_table` (`imgid`, `pid`, `userid`, `filename`, `regdate`, `status`) VALUES
(1, NULL, 'admin', '20230817034134164244.jpg', '2023-08-17 10:41:34', 1),
(2, NULL, 'admin', '20230817034245220043.jpg', '2023-08-17 10:42:45', 1),
(3, NULL, 'admin', '20230817035053696627.jpg', '2023-08-17 10:50:53', 1),
(4, NULL, 'admin', '20230817035153148829.jpg', '2023-08-17 10:51:53', 1),
(5, NULL, 'admin', '20230817035539200404.jpg', '2023-08-17 10:55:39', 1),
(6, NULL, 'admin', '20230817035658770196.jpg', '2023-08-17 10:56:58', 1),
(7, NULL, 'admin', '20230817035735114824.jpg', '2023-08-17 10:57:35', 1),
(8, NULL, 'admin', '20230817035848159403.jpg', '2023-08-17 10:58:48', 1),
(9, NULL, 'admin', '20230817035932800886.jpg', '2023-08-17 10:59:33', 1),
(10, NULL, 'admin', '20230817040013107664.jpg', '2023-08-17 11:00:13', 1),
(11, NULL, 'admin', '20230817044206108977.jpg', '2023-08-17 11:42:06', 1),
(12, NULL, 'admin', '20230817044300742503.jpg', '2023-08-17 11:43:00', 1),
(13, NULL, 'admin', '20230817044314268398.jpg', '2023-08-17 11:43:14', 1),
(14, NULL, 'admin', '20230817044458647678.jpg', '2023-08-17 11:44:58', 1),
(15, NULL, 'admin', '20230817045142105164.jpg', '2023-08-17 11:51:42', 1),
(16, NULL, 'admin', '20230817050132127500.jpg', '2023-08-17 12:01:32', 0),
(17, NULL, 'admin', '20230817050447196825.jpg', '2023-08-17 12:04:47', 0),
(18, NULL, 'admin', '20230817055746205035.jpg', '2023-08-17 12:57:46', 1),
(19, NULL, 'admin', '20230817055849181196.jpg', '2023-08-17 12:58:49', 1),
(20, NULL, 'admin', '20230817060445110711.jpg', '2023-08-17 13:04:45', 1),
(21, NULL, 'admin', '20230817061802899625.jpg', '2023-08-17 13:18:02', 1),
(22, NULL, 'admin', '20230817061802132586.jpg', '2023-08-17 13:18:02', 1),
(23, NULL, 'admin', '20230817061802666893.jpg', '2023-08-17 13:18:02', 1),
(24, 5, 'admin', '20230817083337143963.jpg', '2023-08-17 15:33:37', 1),
(25, 6, 'admin', '20230817083601119538.jpg', '2023-08-17 15:36:01', 1),
(26, 6, 'admin', '20230817083601194547.jpg', '2023-08-17 15:36:01', 1),
(27, 8, 'admin', '20230817084517163358.jpg', '2023-08-17 15:45:18', 1);

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cid`);

--
-- 테이블의 인덱스 `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`);

--
-- 테이블의 인덱스 `product_image_table`
--
ALTER TABLE `product_image_table`
  ADD PRIMARY KEY (`imgid`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `admins`
--
ALTER TABLE `admins`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `category`
--
ALTER TABLE `category`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 테이블의 AUTO_INCREMENT `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 테이블의 AUTO_INCREMENT `product_image_table`
--
ALTER TABLE `product_image_table`
  MODIFY `imgid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

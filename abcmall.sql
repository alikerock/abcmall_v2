-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 23-08-30 08:36
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
(1, 'admin', 'admin@shop.com', '관리자', '33275a8aa48ea918bd53a9181aa975f15ab0d0645398f5918a006d08675c1cb27d5c645dbd084eee56e675e25ba4019f2ecea37ca9e2995b49fcb12c096a032e', '2023-01-01 17:12:32', 100, '2023-08-30 14:45:27', NULL);

-- --------------------------------------------------------

--
-- 테이블 구조 `cart`
--

CREATE TABLE `cart` (
  `cartid` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `userid` varchar(100) DEFAULT NULL,
  `ssid` varchar(100) DEFAULT NULL,
  `options` varchar(100) DEFAULT NULL,
  `cnt` int(11) DEFAULT NULL,
  `regdate` datetime DEFAULT NULL,
  `total` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `cart`
--

INSERT INTO `cart` (`cartid`, `pid`, `userid`, `ssid`, `options`, `cnt`, `regdate`, `total`) VALUES
(1, 16, '', '5mk3t3d48sqp38em639pb78hmb', '사이즈-대', 1, '2023-08-30 15:31:22', 21000),
(2, 16, 'alikerock', '', '사이즈-대', 1, '2023-08-30 15:34:14', 21000);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `category`
--

INSERT INTO `category` (`cid`, `code`, `pcode`, `name`, `step`) VALUES
(1, 'A0001', NULL, '컴퓨터', 1),
(2, 'B0001', '1', '노트북', 2),
(3, 'C0001', '2', '게임용', 3),
(4, 'A0002', '', '핸드폰', 1),
(5, 'A0003', '', '태블릿', 1),
(6, 'A0004', '', '스마트기기', 1),
(7, 'B0002', '1', '맥북', 2),
(8, 'C0002', '2', '그램', 3),
(9, '', '', '서버', 1),
(10, '', '9', '웹서버', 2),
(11, '', '10', '호스팅 서버', 3),
(12, NULL, '', '이도령', 1),
(13, NULL, '', '성춘향', 1),
(14, NULL, '4', '노트북', 2),
(15, NULL, '', '컴퓨터', 1),
(16, NULL, '', '그린', 1),
(17, NULL, '', '테스트1', 1),
(18, NULL, '', '테스트2', 1);

-- --------------------------------------------------------

--
-- 테이블 구조 `coupons`
--

CREATE TABLE `coupons` (
  `cid` int(11) NOT NULL,
  `coupon_name` varchar(100) DEFAULT NULL COMMENT '쿠폰명',
  `coupon_image` varchar(100) DEFAULT NULL COMMENT '쿠폰이미지',
  `coupon_type` varchar(10) DEFAULT NULL COMMENT '쿠폰타입',
  `coupon_price` double DEFAULT NULL COMMENT '할인금액',
  `coupon_ratio` double DEFAULT NULL COMMENT '할인비율',
  `status` tinyint(4) DEFAULT 0 COMMENT '상태',
  `regdate` datetime DEFAULT NULL COMMENT '등록일',
  `max_value` double DEFAULT NULL COMMENT '최대할인금액',
  `use_min_price` double DEFAULT NULL COMMENT '최소사용금액'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `coupons`
--

INSERT INTO `coupons` (`cid`, `coupon_name`, `coupon_image`, `coupon_type`, `coupon_price`, `coupon_ratio`, `status`, `regdate`, `max_value`, `use_min_price`) VALUES
(1, '회원가입 축하쿠폰', '/abcmall/pdata/coupon/20230824024400213435.jpg', '0', 10000, 0, 1, '2023-08-24 00:00:00', 100000, 30000),
(3, '쿠폰테스트', '/abcmall/pdata/coupon/20230824025640848282.jpg', '0', 10000, 10, 1, '2023-08-24 00:00:00', 100000, 10000),
(4, '쿠폰테스트', '/abcmall/pdata/coupon/20230824030816988546.jpg', '0', 20000, 0, 1, '2023-08-24 00:00:00', 90000, 10000),
(5, '쿠폰테스트', '/abcmall/pdata/coupon/20230824030921181117.jpg', '0', 10000, 0, 1, '2023-08-24 00:00:00', 10000, 10000),
(6, '쿠폰테스트', '/abcmall/pdata/coupon/20230824031449843495.jpg', '0', 50000, 0, 1, '2023-08-24 00:00:00', 100000, 10000),
(7, '쿠폰테스트2', '/abcmall/pdata/coupon/20230824031521673533.jpg', '0', 0, 15, 1, '2023-08-24 00:00:00', 100000, 20000),
(8, '쿠폰테스트3', '/abcmall/pdata/coupon/20230824031728600373.jpg', '0', 20000, 0, 1, '2023-08-24 00:00:00', 10000, 10000);

-- --------------------------------------------------------

--
-- 테이블 구조 `members`
--

CREATE TABLE `members` (
  `mid` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `userid` varchar(50) NOT NULL,
  `userpw` varchar(200) NOT NULL,
  `useremail` varchar(200) NOT NULL,
  `regdate` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `members`
--

INSERT INTO `members` (`mid`, `username`, `userid`, `userpw`, `useremail`, `regdate`) VALUES
(1, '아무개', 'alikerock', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', 'test@test.com', '0000-00-00 00:00:00'),
(2, '홍길동', 'hong', 'f76d554626e5eb4beae9feb8ec14737644a4c8db915e66381541fe97df82e6cbc37c5e98fa8356bd1fe5be4a2d6650b4728a066999882ce90d723844e91e4242', 'hong@test.com', '2023-08-24 11:54:01'),
(3, '이도령', 'dodo', 'ac94f165c526746256350c02e01a87e0b46f787494148382383b6b491b9e41587acc83a48aeb4f5e8ff627f14466f90b61acdadc2594c60b447494f306a853b3', 'dodo@test.com', '2023-08-24 12:35:58'),
(4, '월요일', 'monday', '9994fd49a7a16498f70b66dc3a25e4c6438fbeabe8cdb689c89893d0654555164e47ec561059165c0a2ae6eea54827923f0deff83d84c2b09ca0408d3d021d08', 'mon@mon.kr', '2023-08-28 09:48:50'),
(13, '아무개', 'monday2', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', 'asdf@test.com', '2023-08-28 10:36:32');

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
  `file_table_id` varchar(50) DEFAULT NULL,
  `option_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `products`
--

INSERT INTO `products` (`pid`, `name`, `cate`, `content`, `thumbnail`, `price`, `sale_price`, `sale_ratio`, `cnt`, `sale_cnt`, `isnew`, `isbest`, `isrecom`, `ismain`, `locate`, `userid`, `sale_end_date`, `reg_date`, `status`, `delivery_fee`, `file_table_id`, `option_id`) VALUES
(4, '이도령', 'A0001B0001C0001', '<p>설명 테스트&nbsp;</p>', '/abcmall/pdata/20230817082025160738.jpg', 90000, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'admin', '2024-02-17 00:00:00', '2023-08-17 15:20:25', 0, 0, '21,22,23', ''),
(5, '이도령', 'A0001B0001C0002', '<p><span style=\"font-weight: 700;\">상세설명 테스트</span><br></p>', '/abcmall/pdata/20230817083343471645.jpg', 100000, 0, 0, 0, 0, 0, 0, 0, 0, 2, 'admin', '2024-02-17 00:00:00', '2023-08-17 15:33:43', 0, 0, '24', ''),
(6, '글쓴이1', 'A0001B0002', '<p><span style=\"font-weight: 700;\">상세설명</span><br></p>', '/abcmall/pdata/20230817083612132442.jpg', 30000, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'admin', '2024-02-17 00:00:00', '2023-08-17 15:36:12', 1, 0, '25,26', ''),
(7, '이도령', 'A0001B0001C0002', '<p>ㅇㅁㄴㅇㄻㄴㄹㅇ</p>', '/abcmall/pdata/20230817084520119710.jpg', 30000, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'admin', '2024-02-17 00:00:00', '2023-08-17 15:45:20', -1, 0, '27', ''),
(8, '이도령', 'A0001B0001C0002', '<p>ㅇㅁㄴㅇㄻㄴㄹㅇ</p>', '/abcmall/pdata/20230817090250130090.jpg', 30000, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'admin', '2024-02-17 00:00:00', '2023-08-17 16:02:50', -1, 0, '27', ''),
(9, '이도령', 'A0001B0001C0001', '<p>abcmall<br></p>', '/abcmall/pdata/20230821051208620373.jpg', 40000, 0, 0, 0, 0, 1, 0, 0, 0, 1, 'admin', '2024-02-21 00:00:00', '2023-08-21 12:12:08', 0, 0, '', ''),
(10, '홍길동', 'A0001B0001C0001', '<p>abcmall<br></p>', '/abcmall/pdata/20230821051534265542.jpg', 30000, 0, 0, 0, 0, 0, 1, 1, 0, 1, 'admin', '2024-02-21 00:00:00', '2023-08-21 12:15:34', 0, 0, '28', ''),
(11, '홍길동', 'A0001B0002', '<p>test</p>', '/abcmall/pdata/20230821052921377593.jpg', 50000, 0, 0, 0, 0, 1, 1, 1, 1, 1, 'admin', '2024-02-21 00:00:00', '2023-08-21 12:29:21', 0, 0, '29,30,31', ''),
(13, '홍길동', 'A0001B0001C0001', '<p>ㅅㄷㄴㅅ</p>', '/abcmall/pdata/20230821084558198900.jpg', 40000, 0, 0, 0, 0, 0, 1, 0, 0, 1, 'admin', '2024-02-21 00:00:00', '2023-08-21 15:45:58', 0, 0, '34', ''),
(14, '이도령', 'A0001B0001C0001', '<p>본문 테스트</p>', '/abcmall/pdata/20230821101852151748.jpg', 20000, 0, 0, 0, 0, 1, 1, 0, 0, 1, 'admin', '2024-02-21 00:00:00', '2023-08-21 17:18:52', 0, 0, '35,36,37', ''),
(15, 'ㅅㄷㄴㅅ', 'A0001B0001C0001', '<p>ㅅㄷㄴㅅ</p>', '/abcmall/pdata/20230821102100773044.jpg', 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 'admin', '2024-02-21 00:00:00', '2023-08-21 17:21:00', 0, 0, '38,39', ''),
(16, 'TEST', 'A0001B0001C0001', '<div style=\"color: rgb(0, 0, 0); font-family: Consolas, &quot;Courier New&quot;, monospace; font-size: 14px; line-height: 19px; white-space: pre;\">test</div>', '/abcmall/pdata/20230821102303209771.jpg', 20000, 0, 0, 0, 0, 0, 1, 0, 0, 1, 'admin', '2024-02-21 00:00:00', '2023-08-21 17:23:03', 1, 0, '40,41', ''),
(17, 'ㅅㄷㄴㅅ', 'A0001B0001C0001', '<p>test</p>', '/abcmall/pdata/20230821102424964901.jpg', 30000, 0, 0, 0, 0, 1, 1, 0, 1, 0, 'admin', '2024-02-21 00:00:00', '2023-08-21 17:24:24', -1, 0, '', ''),
(20, '테스트18', '1/2/3', '<p>상품 설명 테스트&nbsp;</p><p>상품 설명 테스트&nbsp;</p><p>상품 설명 테스트&nbsp;</p><p>상품 설명 테스트&nbsp;</p><p>상품 설명 테스트&nbsp;<br></p>', '/abcmall/pdata/20230829051424892335.jpg', 60000, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'admin', '2024-02-29 00:00:00', '2023-08-29 12:14:24', 0, 0, '', NULL),
(22, '테스트21', '1/', '<p>상품 설명 테스트</p>', '/abcmall/pdata/20230829051811780454.jpg', 40000, 0, 0, 0, 0, 1, 0, 0, 0, 1, 'admin', '2024-02-29 00:00:00', '2023-08-29 12:18:11', 0, 0, '', NULL),
(23, '테스트23', '1/2/3', '<p>테스트23<br></p>', '/abcmall/pdata/20230830054502891234.jpg', 20000, 0, 0, 0, 0, 0, 1, 0, 0, 2, 'admin', '2024-03-01 00:00:00', '2023-08-30 12:45:02', 0, 0, '', NULL),
(24, '테스트24', '1/2/8', '<p>테스트24<br></p>', '/abcmall/pdata/20230830055454881917.jpg', 10000, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'admin', '2024-03-01 00:00:00', '2023-08-30 12:54:54', 0, 0, '', NULL);

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
(27, 8, 'admin', '20230817084517163358.jpg', '2023-08-17 15:45:18', 1),
(28, 10, 'admin', '20230821051531540572.jpg', '2023-08-21 12:15:31', 1),
(29, 11, 'admin', '20230821051933114800.jpg', '2023-08-21 12:19:33', 1),
(30, 11, 'admin', '20230821051933100949.jpg', '2023-08-21 12:19:33', 1),
(31, 11, 'admin', '20230821051933207918.jpg', '2023-08-21 12:19:33', 1),
(32, NULL, 'admin', '20230821054145502969.jpg', '2023-08-21 12:41:45', 1),
(33, NULL, 'admin', '20230821084105166880.jpg', '2023-08-21 15:41:05', 1),
(34, 13, 'admin', '20230821084518635899.jpg', '2023-08-21 15:45:18', 1),
(35, 14, 'admin', '20230821101819156475.jpg', '2023-08-21 17:18:19', 1),
(36, 14, 'admin', '20230821101819861329.jpg', '2023-08-21 17:18:19', 1),
(37, 14, 'admin', '20230821101819157714.jpg', '2023-08-21 17:18:19', 1),
(38, 15, 'admin', '20230821102032487989.jpg', '2023-08-21 17:20:32', 1),
(39, 15, 'admin', '20230821102032193740.jpg', '2023-08-21 17:20:32', 1),
(40, 16, 'admin', '20230821102231172717.jpg', '2023-08-21 17:22:32', 1),
(42, NULL, 'admin', '20230823044919451017.jpg', '2023-08-23 11:49:19', 1),
(43, NULL, 'admin', '20230823044919194238.jpg', '2023-08-23 11:49:19', 1),
(44, NULL, 'admin', '20230823055833158663.jpg', '2023-08-23 12:58:33', 1),
(45, NULL, 'admin', '20230823055833481955.jpg', '2023-08-23 12:58:33', 1);

-- --------------------------------------------------------

--
-- 테이블 구조 `product_options`
--

CREATE TABLE `product_options` (
  `poid` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `cate` varchar(100) DEFAULT NULL,
  `option_name` varchar(100) DEFAULT NULL,
  `option_cnt` int(11) DEFAULT NULL,
  `option_price` int(11) DEFAULT NULL,
  `image_url` varchar(300) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `product_options`
--

INSERT INTO `product_options` (`poid`, `pid`, `cate`, `option_name`, `option_cnt`, `option_price`, `image_url`, `status`) VALUES
(10, 15, '사이즈', '대', 10, 1000, '', 1),
(11, 15, '사이즈', '중', 20, 1500, '', 1),
(12, 16, '사이즈', '대', 10, 1000, '/abcmall/pdata/option/20230821102424252669.jpg\r\n', 1),
(13, 16, '사이즈', '중', 5, 500, '/abcmall/pdata/option/20230821102425244793.jpg\r\n', 1),
(14, 17, '사이즈', '대', 5, 1000, '/abcmall/pdata/option/20230821102424252669.jpg', 1),
(15, 17, '사이즈', '중', 2, 2000, '/abcmall/pdata/option/20230821102425244793.jpg', 1),
(16, 22, '사이즈', '대', 10, 1000, '/abcmall/pdata/option/20230829051811143743.jpg', 1),
(17, 22, '사이즈', '중', 5, 500, '/abcmall/pdata/option/20230829051811935269.jpg', 1);

-- --------------------------------------------------------

--
-- 테이블 구조 `user_coupons`
--

CREATE TABLE `user_coupons` (
  `ucid` int(11) NOT NULL,
  `couponid` int(11) DEFAULT NULL COMMENT '쿠폰아이디',
  `userid` varchar(100) DEFAULT NULL COMMENT '유저아이디',
  `status` int(11) DEFAULT 1 COMMENT '상태',
  `use_max_date` datetime DEFAULT NULL COMMENT '사용기한',
  `regdate` datetime DEFAULT NULL COMMENT '등록일',
  `reason` varchar(100) DEFAULT NULL COMMENT '쿠폰취득사유'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `user_coupons`
--

INSERT INTO `user_coupons` (`ucid`, `couponid`, `userid`, `status`, `use_max_date`, `regdate`, `reason`) VALUES
(1, 1, 'dodo', 1, '2023-09-23 23:59:59', '2023-08-24 12:35:58', '회원가입'),
(2, 1, 'monday', 1, '2023-09-27 23:59:59', '2023-08-28 09:57:20', '회원가입'),
(3, 1, 'monday2', 1, '2023-09-27 23:59:59', '2023-08-28 10:36:32', '회원가입');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartid`),
  ADD KEY `cart_pid_IDX` (`pid`),
  ADD KEY `cart_userid_IDX` (`userid`);

--
-- 테이블의 인덱스 `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cid`);

--
-- 테이블의 인덱스 `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`cid`);

--
-- 테이블의 인덱스 `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`mid`);

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
-- 테이블의 인덱스 `product_options`
--
ALTER TABLE `product_options`
  ADD PRIMARY KEY (`poid`),
  ADD KEY `newtable_pid_IDX` (`pid`) USING BTREE;

--
-- 테이블의 인덱스 `user_coupons`
--
ALTER TABLE `user_coupons`
  ADD PRIMARY KEY (`ucid`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `admins`
--
ALTER TABLE `admins`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `cart`
--
ALTER TABLE `cart`
  MODIFY `cartid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 테이블의 AUTO_INCREMENT `category`
--
ALTER TABLE `category`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- 테이블의 AUTO_INCREMENT `coupons`
--
ALTER TABLE `coupons`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 테이블의 AUTO_INCREMENT `members`
--
ALTER TABLE `members`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 테이블의 AUTO_INCREMENT `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- 테이블의 AUTO_INCREMENT `product_image_table`
--
ALTER TABLE `product_image_table`
  MODIFY `imgid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- 테이블의 AUTO_INCREMENT `product_options`
--
ALTER TABLE `product_options`
  MODIFY `poid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- 테이블의 AUTO_INCREMENT `user_coupons`
--
ALTER TABLE `user_coupons`
  MODIFY `ucid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

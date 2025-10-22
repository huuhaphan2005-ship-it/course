-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 15, 2025 at 09:06 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coursesmanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `ccode` smallint NOT NULL,
  `cname` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `avatar` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `duration` tinyint NOT NULL,
  `credits` tinyint(1) NOT NULL,
  `instructors` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `outline` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf16 COLLATE=utf16_vietnamese_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`ccode`, `cname`, `avatar`, `duration`, `credits`, `instructors`, `outline`) VALUES
(401, 'Lập trình web 2', '', 60, 3, 'Nguyễn Phương Nam, Phó Hải Đăng', 'Chương 1:Gioi thiệu lịch sử hình thành website,\r\n    Chương 2:Ngôn ngữ HTML,\r\n    Chương 3:Ngôn ngữ CSS\r\n    '),
(101, 'Thiết kế web 1', '', 20, 4, 'Phó Hải Đăng, Trần Việt Tâm', 'Chương 1:Gioi thiệu lịch sử hình thành website,\r\n    Chương 2:Ngôn ngữ HTML,\r\n    Chương 3:Ngôn ngữ CSS\r\n    '),
(301, 'Lập trình web 1', '', 100, 10, 'Nguyễn Phương Nam, Phó Hải Đăng', 'Chương 1:Gioi thiệu lịch sử hình thành website,\r\n    Chương 2:Ngôn ngữ HTML,\r\n    Chương 3:Ngôn ngữ CSS\r\n    '),
(201, 'Thiết kế web 2', '', 100, 10, 'Phó Hải Đăng', 'Chương 1:Gioi thiệu lịch sử hình thành website'),
(501, 'Phân tích mạng xã hội', '', 30, 1, 'Aliba HJ, John Ken', 'Updating...'),
(502, 'Phân tích mạng xã hội 2', '', 30, 1, 'Aliba HJ', 'Updating...'),
(103, 'Kinh tế lượng', '', 20, 3, 'Alex', 'Chương 1:Kinh tế thị trường'),
(102, 'Kinh tế vi mô', '', 100, 5, 'Nguyên', 'Updating....'),
(105, 'Kinh tế vĩ mô', '', 100, 5, 'Tài', 'Updating....'),
(109, 'Kinh tế thị trường', '', 50, 2, 'Tài', 'Updating....');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 30, 2021 lúc 05:02 AM
-- Phiên bản máy phục vụ: 10.4.20-MariaDB
-- Phiên bản PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `phpdemo`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `categoryID` int(100) NOT NULL,
  `categoryName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`categoryID`, `categoryName`) VALUES
(1, 'Thu Nhập'),
(2, 'Chi Tiêu');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `collect`
--

CREATE TABLE `collect` (
  `collectID` int(100) NOT NULL,
  `collectName` varchar(100) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `collectPrice` int(100) NOT NULL,
  `itemID` int(100) NOT NULL,
  `categoryID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `collect`
--

INSERT INTO `collect` (`collectID`, `collectName`, `comment`, `collectPrice`, `itemID`, `categoryID`) VALUES
(1, 'Tiết kiệm', 'Nhận lương', 10000000, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `expense`
--

CREATE TABLE `expense` (
  `expenseID` int(100) NOT NULL,
  `expenseName` varchar(100) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `itemID` int(100) NOT NULL,
  `expensePrice` int(100) NOT NULL,
  `categoryID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `expense`
--

INSERT INTO `expense` (`expenseID`, `expenseName`, `comment`, `itemID`, `expensePrice`, `categoryID`) VALUES
(1, 'Cá nhân', 'Mua áo quần', 3, 500000, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `item`
--

CREATE TABLE `item` (
  `ItemID` int(11) NOT NULL,
  `ItemName` varchar(100) NOT NULL,
  `categoryItem` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `item`
--

INSERT INTO `item` (`ItemID`, `ItemName`, `categoryItem`) VALUES
(1, 'Lương', 'Thu nhập'),
(2, 'Thưởng', 'Thu nhập'),
(3, 'Đi lại', 'Chi tiêu'),
(4, 'Trúng số ', 'Thu nhập'),
(6, 'Tiền bảo hiểm ', 'Thu nhập'),
(7, 'Đóng tiền học ', 'Chi tiêu'),
(8, 'Trả nợ ', 'Chi tiêu'),
(9, 'Mượn nợ ', 'Thu nhập'),
(10, 'Tiền cứu trợ ', 'Thu nhập'),
(11, 'Tiền lời ngân hàng ', 'Thu nhập'),
(12, ' ', ''),
(13, 'Tiền lời ngân hàng ', 'Thu nhập'),
(14, ' ', ''),
(15, 'Tiền mượn ', 'Thu nhập'),
(16, 'Trúng số ', ''),
(17, 'Trúng số ', 'Thu nhập'),
(18, 'Học bổng ', ''),
(19, 'Học bổng ', 'Thu nhập'),
(20, 'Trúng số ', 'Thu nhập'),
(21, ' ', 'Thu nhập');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`ItemID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `item`
--
ALTER TABLE `item`
  MODIFY `ItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

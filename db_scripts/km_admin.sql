-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2017 at 04:20 PM
-- Server version: 5.5.54-MariaDB
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `km_admin`
--

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `title`, `link`, `position`, `status`, `created`, `modified`) VALUES
(1, 0, 'দেশ - বিদেশ', NULL, 1, 'active', '2017-11-12 08:37:00', '2017-11-12 08:37:00'),
(2, 0, 'ভৰ্মণ', NULL, 4, 'active', '2017-11-12 09:50:00', '2017-11-12 09:50:00'),
(3, 0, 'খেলা', NULL, 5, 'active', '2017-11-12 11:40:00', '2017-11-12 11:40:00'),
(4, 0, 'এক্লুিসভ', NULL, 2, 'active', '2017-11-12 11:40:00', '2017-11-12 11:40:00'),
(5, 0, 'হযবরল', NULL, 3, 'active', '2017-11-12 11:40:00', '2017-11-12 11:40:00'),
(6, 0, 'বিনোদন', NULL, 6, 'active', '2017-11-12 11:45:00', '2017-11-12 11:45:00'),
(7, 0, 'নিয়মিত বিভাগ', NULL, 7, 'active', '2017-11-12 11:45:00', '2017-11-12 11:45:00'),
(8, 0, 'সাহিত্য', NULL, 8, 'active', '2017-11-12 11:45:00', '2017-11-12 11:45:00'),
(9, 0, 'জ্যোতিষ', NULL, 9, 'active', '2017-11-12 11:45:00', '2017-11-12 11:45:00'),
(10, 0, 'আর্কাইভ', NULL, 10, 'active', '2017-11-12 11:45:00', '2017-11-12 11:45:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

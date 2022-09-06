-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2019 at 05:13 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pfd_arsip`
--

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`id`, `empNbr`, `empRank`, `inputBy`, `formNbr`, `receivedDate`, `quantity`, `remark`, `signed`, `created_at`, `updated_at`) VALUES
(10, '517043', 'CP', 'ADMIN', '0080', '2019-01-18', 1, 'sonata', 'HARRY  SETIAWAN', '2019-01-18 04:23:44', '2019-01-22 08:19:49'),
(11, '517043', 'CP', 'ADMIN', '0081', '2019-01-18', 1, 'sonata', 'HARRY  SETIAWAN', '2019-01-18 04:24:10', '2019-01-18 04:24:10'),
(12, '517043', 'CP', 'ADMIN', '0082', '2019-01-18', 1, 'sonata', 'HARRY  SETIAWAN', '2019-01-18 04:24:16', '2019-01-18 04:24:16'),
(13, '517043', 'CP', 'ADMIN', '0083', '2019-01-18', 1, 'sonata', 'HARRY  SETIAWAN', '2019-01-18 04:24:21', '2019-01-18 04:24:21'),
(20, '517043', 'CP', 'ADMIN', '0090', '2019-01-18', 1, 'sonata', 'HARRY  SETIAWAN', '2019-01-18 04:25:50', '2019-01-18 04:25:50'),
(21, '517043', 'CP', 'ADMIN', '0091', '2019-01-18', 1, 'sonata', 'HARRY  SETIAWAN', '2019-01-18 04:25:57', '2019-01-18 04:25:57'),
(22, '517043', 'CP', 'ADMIN', '0092', '2019-01-18', 1, 'sonata', 'HARRY  SETIAWAN', '2019-01-18 04:26:04', '2019-01-18 04:26:04'),
(25, '517297', 'CP', 'ADMIN', '0093', '2019-01-21', 1, 'test', 'MOHAMMAD PERISDO  TARIGAN', '2019-01-21 02:47:44', '2019-01-21 02:47:44'),
(26, '523482', 'SR', 'ADMIN', '0094', '2019-01-21', 1, 'test', 'NOVA,HENNY  ', '2019-01-21 02:47:53', '2019-01-21 02:47:53'),
(28, '518348', 'CP', 'ADMIN', '0096', '2019-01-21', 1, 'test', 'LASIBUAN  GATTO', '2019-01-21 02:48:17', '2019-01-21 02:48:17');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

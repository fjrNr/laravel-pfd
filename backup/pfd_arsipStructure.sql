-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2019 at 04:48 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `borrowers`
--

CREATE TABLE `borrowers` (
  `id` int(10) UNSIGNED NOT NULL,
  `empName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `empUnit` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `empNbr` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_movements`
--

CREATE TABLE `detail_movements` (
  `id` int(10) UNSIGNED NOT NULL,
  `movementId` int(10) UNSIGNED NOT NULL,
  `barcodeNo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `aflNbr` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `submissionId` int(10) UNSIGNED NOT NULL,
  `flightPlan` tinyint(1) NOT NULL DEFAULT '0',
  `dispatchRelease` tinyint(1) NOT NULL DEFAULT '0',
  `weatherForecast` tinyint(1) NOT NULL DEFAULT '0',
  `notam` tinyint(1) NOT NULL DEFAULT '0',
  `toLdgDataCard` tinyint(1) NOT NULL DEFAULT '0',
  `loadSheet` tinyint(1) NOT NULL DEFAULT '0',
  `fuelReceipt` tinyint(1) NOT NULL DEFAULT '0',
  `paxManifest` tinyint(1) NOT NULL DEFAULT '0',
  `notoc` tinyint(1) NOT NULL DEFAULT '0',
  `startRetentionDate` date NOT NULL,
  `endRetentionDate` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_assignments`
--

CREATE TABLE `log_assignments` (
  `logId` int(10) UNSIGNED NOT NULL,
  `boxId` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_boxes`
--

CREATE TABLE `log_boxes` (
  `id` int(10) UNSIGNED NOT NULL,
  `locationId` int(10) UNSIGNED NOT NULL,
  `detailMovementId` int(10) UNSIGNED DEFAULT NULL,
  `packNbr` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `movements`
--

CREATE TABLE `movements` (
  `id` int(10) UNSIGNED NOT NULL,
  `shippingNo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `newsNo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `storageDate` date NOT NULL,
  `finishedDate` date DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `formFile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inputBy` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `empNbr` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `empRank` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inputBy` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `formNbr` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receivedDate` date NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signed` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `submission_assignments`
--

CREATE TABLE `submission_assignments` (
  `submissionId` int(10) UNSIGNED NOT NULL,
  `boxId` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `submission_borrowings`
--

CREATE TABLE `submission_borrowings` (
  `id` int(10) UNSIGNED NOT NULL,
  `borrowerId` int(10) UNSIGNED NOT NULL,
  `submissionId` int(10) UNSIGNED NOT NULL,
  `borrowedDate` date NOT NULL,
  `returnedDate` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `submission_boxes`
--

CREATE TABLE `submission_boxes` (
  `id` int(10) UNSIGNED NOT NULL,
  `locationId` int(10) UNSIGNED NOT NULL,
  `detailMovementId` int(10) UNSIGNED DEFAULT NULL,
  `boxNbr` int(11) NOT NULL,
  `classOfDate` date NOT NULL,
  `startRetentionDate` date NOT NULL,
  `endRetentionDate` date NOT NULL,
  `packNbr` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borrowers`
--
ALTER TABLE `borrowers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_movements`
--
ALTER TABLE `detail_movements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `detail_movements_barcodeno_unique` (`barcodeNo`),
  ADD KEY `detail_movements_movementid_foreign` (`movementId`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `logs_aflnbr_unique` (`aflNbr`),
  ADD KEY `logs_submissionid_foreign` (`submissionId`);

--
-- Indexes for table `log_assignments`
--
ALTER TABLE `log_assignments`
  ADD PRIMARY KEY (`logId`),
  ADD KEY `log_assignments_boxid_foreign` (`boxId`);

--
-- Indexes for table `log_boxes`
--
ALTER TABLE `log_boxes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `log_boxes_packnbr_unique` (`packNbr`),
  ADD KEY `log_boxes_locationid_foreign` (`locationId`),
  ADD KEY `log_boxes_detailmovementid_foreign` (`detailMovementId`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movements`
--
ALTER TABLE `movements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `movements_shippingno_unique` (`shippingNo`),
  ADD UNIQUE KEY `movements_newsno_unique` (`newsNo`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `submissions_formnbr_unique` (`formNbr`);

--
-- Indexes for table `submission_assignments`
--
ALTER TABLE `submission_assignments`
  ADD PRIMARY KEY (`submissionId`),
  ADD KEY `submission_assignments_boxid_foreign` (`boxId`);

--
-- Indexes for table `submission_borrowings`
--
ALTER TABLE `submission_borrowings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `submission_borrowings_borrowerid_foreign` (`borrowerId`),
  ADD KEY `submission_borrowings_submissionid_foreign` (`submissionId`);

--
-- Indexes for table `submission_boxes`
--
ALTER TABLE `submission_boxes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `submission_boxes_packnbr_unique` (`packNbr`),
  ADD KEY `submission_boxes_detailmovementid_foreign` (`detailMovementId`),
  ADD KEY `submission_boxes_locationid_foreign` (`locationId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borrowers`
--
ALTER TABLE `borrowers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_movements`
--
ALTER TABLE `detail_movements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `log_boxes`
--
ALTER TABLE `log_boxes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `movements`
--
ALTER TABLE `movements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `submission_borrowings`
--
ALTER TABLE `submission_borrowings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `submission_boxes`
--
ALTER TABLE `submission_boxes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_movements`
--
ALTER TABLE `detail_movements`
  ADD CONSTRAINT `detail_movements_movementid_foreign` FOREIGN KEY (`movementId`) REFERENCES `movements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_submissionid_foreign` FOREIGN KEY (`submissionId`) REFERENCES `submissions` (`id`);

--
-- Constraints for table `log_assignments`
--
ALTER TABLE `log_assignments`
  ADD CONSTRAINT `log_assignments_boxid_foreign` FOREIGN KEY (`boxId`) REFERENCES `log_boxes` (`id`),
  ADD CONSTRAINT `log_assignments_logid_foreign` FOREIGN KEY (`logId`) REFERENCES `logs` (`id`);

--
-- Constraints for table `log_boxes`
--
ALTER TABLE `log_boxes`
  ADD CONSTRAINT `log_boxes_detailmovementid_foreign` FOREIGN KEY (`detailMovementId`) REFERENCES `detail_movements` (`id`),
  ADD CONSTRAINT `log_boxes_locationid_foreign` FOREIGN KEY (`locationId`) REFERENCES `locations` (`id`);

--
-- Constraints for table `submission_assignments`
--
ALTER TABLE `submission_assignments`
  ADD CONSTRAINT `submission_assignments_boxid_foreign` FOREIGN KEY (`boxId`) REFERENCES `submission_boxes` (`id`),
  ADD CONSTRAINT `submission_assignments_submissionid_foreign` FOREIGN KEY (`submissionId`) REFERENCES `submissions` (`id`);

--
-- Constraints for table `submission_borrowings`
--
ALTER TABLE `submission_borrowings`
  ADD CONSTRAINT `submission_borrowings_borrowerid_foreign` FOREIGN KEY (`borrowerId`) REFERENCES `borrowers` (`id`),
  ADD CONSTRAINT `submission_borrowings_submissionid_foreign` FOREIGN KEY (`submissionId`) REFERENCES `submissions` (`id`);

--
-- Constraints for table `submission_boxes`
--
ALTER TABLE `submission_boxes`
  ADD CONSTRAINT `submission_boxes_detailmovementid_foreign` FOREIGN KEY (`detailMovementId`) REFERENCES `detail_movements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `submission_boxes_locationid_foreign` FOREIGN KEY (`locationId`) REFERENCES `locations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

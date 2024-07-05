-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2024 at 06:59 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizzeria`
--

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

CREATE TABLE `pedidos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_producto` bigint(20) UNSIGNED NOT NULL,
  `id_comprador` bigint(20) UNSIGNED NOT NULL,
  `cantidad_comprada` int(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_producto`, `id_comprador`, `cantidad_comprada`, `created_at`, `updated_at`) VALUES
(1, 12, 33, 0, '2023-11-17 10:34:04', '2023-11-17 10:34:04'),
(2, 13, 33, 0, '2023-11-17 10:35:35', '2023-11-17 10:35:35'),
(3, 20, 33, 0, '2023-11-17 10:59:23', '2023-11-17 10:59:23'),
(4, 20, 33, 0, '2023-11-17 10:59:58', '2023-11-17 10:59:58'),
(5, 16, 3, 0, '2023-11-17 11:49:52', '2023-11-17 11:49:52'),
(6, 15, 3, 0, '2023-11-17 11:49:58', '2023-11-17 11:49:58'),
(7, 19, 3, 0, '2023-11-17 12:10:44', '2023-11-17 12:10:44'),
(8, 19, 3, 0, '2023-11-17 12:11:31', '2023-11-17 12:11:31'),
(9, 19, 3, 0, '2023-11-17 12:12:31', '2023-11-17 12:12:31'),
(10, 19, 3, 0, '2023-11-17 12:12:32', '2023-11-17 12:12:32'),
(11, 19, 3, 0, '2023-11-17 12:12:40', '2023-11-17 12:12:40'),
(12, 19, 3, 0, '2023-11-17 12:12:41', '2023-11-17 12:12:41'),
(13, 19, 3, 0, '2023-11-17 12:14:58', '2023-11-17 12:14:58'),
(14, 19, 3, 0, '2023-11-17 12:20:05', '2023-11-17 12:20:05'),
(15, 19, 3, 0, '2023-11-17 12:20:22', '2023-11-17 12:20:22'),
(16, 19, 3, 0, '2023-11-17 12:22:43', '2023-11-17 12:22:43'),
(17, 19, 3, 0, '2023-11-17 12:22:44', '2023-11-17 12:22:44'),
(18, 19, 3, 0, '2023-11-17 12:22:45', '2023-11-17 12:22:45'),
(19, 19, 3, 0, '2023-11-17 12:22:45', '2023-11-17 12:22:45'),
(20, 19, 3, 0, '2023-11-17 12:22:46', '2023-11-17 12:22:46'),
(21, 19, 3, 0, '2023-11-17 12:22:46', '2023-11-17 12:22:46'),
(22, 19, 3, 0, '2023-11-17 12:22:46', '2023-11-17 12:22:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedidos_id_comprador_foreign` (`id_comprador`),
  ADD KEY `pedidos_id_producto_foreign` (`id_producto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_id_comprador_foreign` FOREIGN KEY (`id_comprador`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pedidos_id_producto_foreign` FOREIGN KEY (`id_producto`) REFERENCES `pizzeria` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

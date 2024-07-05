-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2023 at 09:44 AM
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
-- Table structure for table `producto_bebidas`
--

CREATE TABLE `producto_bebidas` (
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

INSERT INTO `producto_bebidas` (`id`, `id_producto`, `id_comprador`, `cantidad_comprada`, `created_at`, `updated_at`) VALUES
(1, 1, 31, 0, '2023-11-17 10:34:04', '2023-11-17 10:34:04'),
(2, 2, 31, 0, '2023-11-17 10:35:35', '2023-11-17 10:35:35');
--
-- Indexes for dumped tables
--

--
-- Indexes for table `pedidos`
--
ALTER TABLE `producto_bebidas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_bebidas_id_comprador_foreign` (`id_comprador`),
  ADD KEY `producto_bebidas_id_producto_foreign` (`id_producto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `producto_bebidas`
--
ALTER TABLE `producto_bebidas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `producto_bebidas`
--
ALTER TABLE `producto_bebidas`
  ADD CONSTRAINT `producto_bebidas_id_comprador_foreign` FOREIGN KEY (`id_comprador`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `producto_bebidas_id_producto_foreign` FOREIGN KEY (`id_producto`) REFERENCES `bebidas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

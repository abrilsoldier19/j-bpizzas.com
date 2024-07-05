-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2024 at 07:19 AM
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
-- Table structure for table `producto_postres`
--

CREATE TABLE `producto_postres` (
  `id_postre` bigint(20) UNSIGNED NOT NULL,
  `id_producto` bigint(20) UNSIGNED NOT NULL,
  `id_comprador` bigint(20) UNSIGNED NOT NULL,
  `cantidad_comprada` int(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `producto_postres`
--

INSERT INTO `producto_postres` (`id_postre`, `id_producto`, `id_comprador`, `cantidad_comprada`, `created_at`, `updated_at`) VALUES
(1, 1, 33, 0, '2023-11-17 10:34:04', '2023-11-17 10:34:04'),
(2, 2, 33, 0, '2023-11-17 10:35:35', '2023-11-17 10:35:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `producto_postres`
--
ALTER TABLE `producto_postres`
  ADD PRIMARY KEY (`id_postre`),
  ADD KEY `producto_postres_id_comprador_foreign` (`id_comprador`),
  ADD KEY `producto_postres_id_producto_foreign` (`id_producto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `producto_postres`
--
ALTER TABLE `producto_postres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `producto_postres`
--
ALTER TABLE `producto_postres`
  ADD CONSTRAINT `producto_postres_id_comprador_foreign` FOREIGN KEY (`id_comprador`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `producto_postres_id_producto_foreign` FOREIGN KEY (`id_producto`) REFERENCES `postres` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

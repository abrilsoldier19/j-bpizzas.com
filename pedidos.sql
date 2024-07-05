-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2023 at 09:22 PM
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
-- Database: `pizzas`
--

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

CREATE TABLE `pedidos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_producto` bigint(10) UNSIGNED NOT NULL,
  `id_bebida` bigint(20) UNSIGNED NOT NULL,
  `id_postre` bigint(20) UNSIGNED NOT NULL,
  `id_comprador` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cantidad_comprada` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_producto`, `id_bebida`, `id_postre`, `id_comprador`, `created_at`, `updated_at`, `cantidad_comprada`) VALUES
(5, 16, 0, 0, 3, '2023-11-17 17:49:52', '2023-11-17 17:49:52', 1),
(6, 15, 0, 0, 3, '2023-11-17 17:49:58', '2023-11-17 17:49:58', 1),
(40, 14, 0, 0, 2, '2023-11-18 08:01:05', '2023-11-18 08:01:05', 2),
(41, 12, 0, 0, 2, '2023-11-18 08:03:53', '2023-11-18 10:07:43', 4),
(53, 13, 0, 0, 2, '2023-11-18 11:55:02', '2023-11-18 11:55:02', 3),
(54, 21, 0, 0, 2, '2023-11-20 01:50:47', '2023-11-20 01:50:47', 3),
(56, 16, 0, 0, 2, '2023-11-20 02:15:29', '2023-11-20 02:15:29', 2),
(61, 22, 0, 0, 33, '2023-11-20 06:24:41', '2023-11-20 06:24:41', 1),
(62, 23, 0, 0, 33, '2023-11-20 06:24:47', '2023-11-20 06:24:47', 1),
(65, 26, 0, 0, 33, '2023-11-20 06:36:53', '2023-11-20 06:36:53', 1),
(66, 26, 0, 0, 33, '2023-11-20 06:43:37', '2023-11-20 06:43:37', 3),
(67, 13, 1, 1, 2, '2023-11-20 14:38:48', '2023-11-20 14:38:48', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedidos_id_comprador_foreign` (`id_comprador`),
  ADD KEY `pedidos_id_producto_foreign` (`id_producto`),
  ADD KEY `pedidos_id_postre_foreign` (`id_postre`),
  ADD KEY `pedidos_id_bebida_foreign` (`id_bebida`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_id_bebida_foreign` FOREIGN KEY (`id_bebida`) REFERENCES `bebidas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `pedidos_id_comprador_foreign` FOREIGN KEY (`id_comprador`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pedidos_id_postre_foreign` FOREIGN KEY (`id_postre`) REFERENCES `postres` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

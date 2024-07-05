-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2023 at 02:09 AM
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
-- Database: `sistemaalumnos9`
--

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'ver-rol', 'web', '2022-11-25 13:55:58', '2022-11-25 13:55:58'),
(2, 'crear-rol', 'web', '2022-11-25 13:55:58', '2022-11-25 13:55:58'),
(3, 'editar-rol', 'web', '2022-11-25 13:55:58', '2022-11-25 13:55:58'),
(4, 'borrar-rol', 'web', '2022-11-25 13:55:58', '2022-11-25 13:55:58'),
(5, 'ver-blog', 'web', '2022-11-25 13:55:58', '2022-11-25 13:55:58'),
(6, 'crear-blog', 'web', '2022-11-25 13:55:58', '2022-11-25 13:55:58'),
(7, 'editar-blog', 'web', '2022-11-25 13:55:58', '2022-11-25 13:55:58'),
(8, 'borrar-blog', 'web', '2022-11-25 13:55:58', '2022-11-25 13:55:58'),
(9, 'Alumno-rol', 'web', '2023-01-13 02:10:58', '2023-01-13 02:10:58'),
(10, 'Maestro-rol', 'web', '2023-01-15 05:26:58', '2023-01-15 05:26:58'),
(11, 'Administrador-rol', 'web', '2023-04-24 19:16:18', '2023-04-24 19:16:18'),
(12, 'gestionar-propia-calificacion', 'web', '2023-04-25 04:39:17', '2023-04-25 04:39:17'),
(13, 'ver-calificaciones', 'web', '2023-04-25 04:57:25', '2023-04-25 04:57:25'),
(14, 'ver-maestros', 'web', '2023-04-25 04:57:33', '2023-04-25 04:57:33'),
(15, 'ver-materias', 'web', '2023-04-25 04:57:46', '2023-04-25 04:57:46'),
(16, 'agregar-calificacion', 'web', '2023-04-25 05:00:57', '2023-04-25 05:00:57'),
(17, 'editar-calificacion', 'web', '2023-04-25 05:01:20', '2023-04-25 05:01:20'),
(18, 'borrar-calificacion', 'web', '2023-04-25 05:01:42', '2023-04-25 05:01:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

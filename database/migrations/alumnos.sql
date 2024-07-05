-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2023 at 01:56 AM
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
-- Table structure for table `alumnos`
--

CREATE TABLE `alumnos` (
  `IdAlumnos` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `correo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `materia` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `maestro` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `semestre` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `calificacion_final` double NOT NULL,
  `carrera` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alumnos`
--

INSERT INTO `alumnos` (`IdAlumnos`, `nombre`, `correo`, `materia`, `maestro`, `semestre`, `calificacion_final`, `carrera`) VALUES
(1, 'Abril Mejia Rangel', 'avril.rock1471@gmail.com', 'Redes', 'Aguilar Covarrubias Norma Aracely', '2do Semestre', 9, 'Ing. Informática'),
(2, 'Abril Mejia Rangel', 'avril.rock1471@gmail.com', 'Base De Datos', 'Aldape Suárez Miguel', '2do Semestre', 8.4166666666667, 'Ing. Informática'),
(4, 'Luis', 'luis19@outlook.com', 'Programación Orientada A Objetos', 'Aguilera Mancilla Héctor', '2do Semestre', 8, '	\r\nIng. Informática');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`IdAlumnos`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

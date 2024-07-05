-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2023 at 04:47 AM
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
-- Table structure for table `calificacions`
--

CREATE TABLE `calificacions` (
  `IdCalificacions` bigint(20) UNSIGNED NOT NULL,
  `Alumno_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `Materia` varchar(191) NOT NULL,
  `U1` double NOT NULL,
  `U2` double NOT NULL,
  `U3` double NOT NULL,
  `U4` double NOT NULL,
  `U5` double NOT NULL,
  `U6` double NOT NULL,
  `U7` double NOT NULL,
  `U8` double NOT NULL,
  `U9` double NOT NULL,
  `U10` double NOT NULL,
  `U11` double NOT NULL,
  `U12` double NOT NULL,
  `Calificacion_Final` double NOT NULL,
  `Semester` varchar(191) NOT NULL,
  `Maestro` varchar(191) NOT NULL,
  `Añosemestre` year(4) NOT NULL,
  `Carrera` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `calificacions`
--

INSERT INTO `calificacions` (`IdCalificacions`, `Alumno_id`, `name`, `Materia`, `U1`, `U2`, `U3`, `U4`, `U5`, `U6`, `U7`, `U8`, `U9`, `U10`, `U11`, `U12`, `Calificacion_Final`, `Semester`, `Maestro`, `Añosemestre`, `Carrera`) VALUES
(1, 1, 'Abril Mejia Rangel', 'Redes', 9, 9, 8, 8, 8, 8, 8, 9, 9, 9, 9, 9, 9, '2do Semestre', 'Aguilar Covarrubias Norma Aracely', '2022', 'Ing. Informática'),
(2, 4, 'Luis', 'Programación Orientada A Objetos', 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, '2do Semestre', 'Aguilera Mancilla Héctor', '2022', 'Ing. Informática'),
(34, 2, 'April Mejia Rangel', 'Base De Datos', 10, 8, 8, 8, 8, 8, 8, 8, 8, 8, 9, 10, 8.4166666666667, '2do Semestre', 'Aldape Suárez Miguel', '2022', 'Ing. Informática'),
(37, 1, 'Abril Mejia Rangel', 'Programación Orientada A Objetos', 9, 6, 7, 7, 6, 6, 8, 8, 6, 7, 6, 8, 7.25, '2do Semestre', 'Aguilar Covarrubias Norma Aracely', '2022', 'Ing. Informática'),
(38, 1, 'Abril Mejia Rangel', '2. Base De Datos', 6, 6, 7, 5, 6, 8, 9, 7, 7, 6, 7, 6, 6.6666666666667, '2do Semestre', 'Aranda Alarcón Graciela', '2022', 'Ing. Informática');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calificacions`
--
ALTER TABLE `calificacions`
  ADD PRIMARY KEY (`IdCalificacions`),
  ADD KEY `calificacions_alumno_id_foreign` (`Alumno_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `calificacions`
--
ALTER TABLE `calificacions`
  ADD CONSTRAINT `calificacions_alumno_id_foreign` FOREIGN KEY (`Alumno_id`) REFERENCES `alumnos` (`IdAlumnos`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

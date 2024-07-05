-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2024 at 09:36 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `orden_pedidos`
--

CREATE TABLE `orden_pedidos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_usuario` varchar(100) NOT NULL,
  `id_usuario` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `metodo_pago` varchar(50) NOT NULL,
  `productos` varchar(255) NOT NULL,
  `cantidad_productos` varchar(255) NOT NULL,
  `imagen_producto` text NOT NULL,
  `total_pago` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orden_pedidos`
--

INSERT INTO `orden_pedidos` (`id`, `nombre_usuario`, `id_usuario`, `email`, `telefono`, `direccion`, `metodo_pago`, `productos`, `cantidad_productos`, `imagen_producto`, `total_pago`, `created_at`, `updated_at`) VALUES
(1, 'Jonathan', 10, 'jonathan@tec.com.mx', '8447895566', 'Privada Monclova 150', 'cod', 'Fanta Uva(3), Coca Cola(4), Cherry Icecream(3)', '3,4,3', '', '425', '2024-02-17 15:00:11', '2024-02-17 15:00:11'),
(2, 'Jorge Juan Borges Boldano', 2, 'j.juanbaldanos@gmail.com', '8441898441', 'PRIVADA MONCLOVA 150', 'cod', 'Solo queso(3), Fanta Green Apple(2), Cherry Icecream(3)', '3,2,3', '', '700', '2024-02-18 07:29:56', '2024-02-18 07:29:56'),
(3, 'Jorge Juan Borges Boldanos', 2, 'j.juanbaldanos@gmail.com', '8443477347', 'Rios San Juan #238, Balcones de Santa Rosa', 'cod', 'Cherry Icecream, Pizza Hawaiina', '2,2', 'cherry.JPG, pizza_hawaiina.jpg ', '480', '2024-02-19 14:24:50', '2024-02-19 14:24:50'),
(4, 'Jorge Juan Borges Boldanos', 2, 'j.juanbaldanos@gmail.com', '8443477347', 'Rios San Juan #238, Balcones de Santa Rosa', 'cards', 'Sprite, Pepperoni', '4', 'sprite.JPG, peperonni.jpg, ', '470', '2024-02-19 14:34:07', '2024-02-19 14:34:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orden_pedidos`
--
ALTER TABLE `orden_pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orden_pedidos`
--
ALTER TABLE `orden_pedidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orden_pedidos`
--
ALTER TABLE `orden_pedidos`
  ADD CONSTRAINT `orden_pedidos_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

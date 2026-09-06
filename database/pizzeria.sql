-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2024 at 05:53 AM
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
-- Table structure for table `bebidas`
--

CREATE TABLE `bebidas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_bebida` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `bebida_precio` double NOT NULL,
  `bebida_imagen` text DEFAULT NULL,
  `vendido` tinyint(1) NOT NULL DEFAULT 0,
  `id_usuario` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bebidas`
--

INSERT INTO `bebidas` (`id`, `nombre_bebida`, `bebida_precio`, `bebida_imagen`, `vendido`, `id_usuario`) VALUES
(1, 'Fanta Green Apple', 35, 'fanta_greenapple.JPG', 0, 3),
(2, 'Coca Cola', 35, 'coca-cola.jpg', 0, 3),
(3, 'Sprite', 35, 'sprite.JPG', 0, 3),
(4, 'Fanta Fresa', 35, 'fantafresa.png', 0, 3),
(5, 'Fanta Naranja', 35, 'fanta.JPG', 0, 3),
(6, 'Fanta Uva', 35, 'fanta_uva.JPG', 0, 3),
(7, 'Fanta Manzana', 35, 'fanta_manzana.png', 1, 3),
(8, 'Fanta de piña', 35, 'fanta-de-pina.jpg', 0, 3),
(9, 'Fanta Limon', 35, 'lata-fanta-limon.jpg', 0, 3),
(10, 'Dr Pepper', 35, 'dr_pepper.JPG', 0, 3),
(11, 'Squirt', 35, 'squirt.JPG', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `carrito`
--

CREATE TABLE `carrito` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_producto` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `precio_producto` double NOT NULL,
  `cantidad_producto` int(11) NOT NULL,
  `imagen_producto` text DEFAULT NULL,
  `id_usuario` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carrito`
--

INSERT INTO `carrito` (`id`, `nombre_producto`, `precio_producto`, `cantidad_producto`, `imagen_producto`, `id_usuario`, `created_at`, `updated_at`) VALUES
(1, 'Veggie Lovers', 140, 1, 'vegetariana.jpg', 31, '2024-02-17 09:21:27', '2024-02-17 09:21:27'),
(2, 'Pizza Hawaiina', 180, 3, 'pizza_hawaiina.jpg', 31, '2024-02-17 09:27:26', '2024-02-17 09:27:26'),
(3, 'Pizza Hawaiina', 180, 3, 'pizza_hawaiina.jpg', 31, '2024-02-17 09:27:43', '2024-02-17 09:27:43'),
(4, 'Meat Lovers', 200, 2, 'meat_lovers.jpg', 31, '2024-02-17 09:28:53', '2024-02-17 09:28:53'),
(9, 'Veggie Lovers', 140, 2, 'vegetariana.jpg', 10, '2024-02-18 06:03:47', '2024-02-19 12:59:49'),
(10, 'Fanta Green Apple', 35, 2, 'fanta_greenapple.JPG', 10, '2024-02-18 06:03:47', '2024-02-19 12:59:53'),
(11, 'Vanilla Icecream', 60, 2, 'vanilla_icecream.JPG', 10, '2024-02-18 06:03:47', '2024-02-19 12:59:55'),
(12, 'Fanta Manzana', 35, 2, 'fanta_manzana.png', 10, '2024-02-18 06:21:05', '2024-02-19 12:59:59'),
(21, 'Dulce Delish Ice Cream', 75, 2, 'dulce-delish-ice-cream.JPG', 2, '2024-02-26 14:19:40', '2024-02-27 01:55:53'),
(22, 'Cherry Icecream', 60, 2, 'cherry.JPG', 2, '2024-02-27 06:21:51', '2024-02-27 06:21:51');

-- --------------------------------------------------------

--
-- Table structure for table `complementos`
--

CREATE TABLE `complementos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_complemento` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `complemento_precio` double NOT NULL,
  `complemento_imagen` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(11, '2014_10_12_000000_create_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Usuario', 2),
(1, 'App\\Models\\Usuario', 4),
(1, 'App\\Models\\Usuario', 5),
(1, 'App\\Models\\Usuario', 6),
(1, 'App\\Models\\Usuario', 7),
(1, 'App\\Models\\Usuario', 8),
(1, 'App\\Models\\Usuario', 9),
(1, 'App\\Models\\Usuario', 10),
(1, 'App\\Models\\Usuario', 11),
(1, 'App\\Models\\Usuario', 12),
(1, 'App\\Models\\Usuario', 13),
(1, 'App\\Models\\Usuario', 14),
(1, 'App\\Models\\Usuario', 15),
(1, 'App\\Models\\Usuario', 16),
(1, 'App\\Models\\Usuario', 17),
(1, 'App\\Models\\Usuario', 18),
(1, 'App\\Models\\Usuario', 19),
(1, 'App\\Models\\Usuario', 20),
(1, 'App\\Models\\Usuario', 21),
(1, 'App\\Models\\Usuario', 22),
(1, 'App\\Models\\Usuario', 23),
(1, 'App\\Models\\Usuario', 24),
(1, 'App\\Models\\Usuario', 25),
(1, 'App\\Models\\Usuario', 26),
(1, 'App\\Models\\Usuario', 27),
(1, 'App\\Models\\Usuario', 28),
(1, 'App\\Models\\Usuario', 29),
(1, 'App\\Models\\Usuario', 30),
(1, 'App\\Models\\Usuario', 31),
(1, 'App\\Models\\Usuario', 32),
(1, 'App\\Models\\Usuario', 33),
(2, 'App\\Models\\Usuario', 3);

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
(1, 'Jonathan', 10, 'jonathan@tec.com.mx', '8447895566', 'Privada Monclova 150', 'cod', 'Fanta Uva(3), Coca Cola(4), Cherry Icecream(3)', '3,4,3', 'fanta_uva.JPG,coca-cola.jpg,cherry.JPG', '425', '2024-02-17 15:00:11', '2024-02-17 15:00:11'),
(2, 'Jorge Juan Borges Boldano', 2, 'j.juanbaldanos@gmail.com', '8441898441', 'PRIVADA MONCLOVA 150', 'cod', 'Solo queso(3), Fanta Green Apple(2), Cherry Icecream(3)', '3,2,3', 'pizza_queso.jpg,fanta_greenapple.JPG,cherry.JPG', '700', '2024-02-18 07:29:56', '2024-02-18 07:29:56'),
(3, 'Jorge Juan Borges Boldanos', 2, 'j.juanbaldanos@gmail.com', '8443477347', 'Rios San Juan #238, Balcones de Santa Rosa', 'cod', 'Cherry Icecream, Pizza Hawaiina', '2,2', 'cherry.JPG, pizza_hawaiina.jpg ', '480', '2024-02-19 14:24:50', '2024-02-19 14:24:50'),
(4, 'Jorge Juan Borges Boldanos', 2, 'j.juanbaldanos@gmail.com', '8443477347', 'Rios San Juan #238, Balcones de Santa Rosa', 'cards', 'Sprite, Pepperoni', '4,4', 'sprite.JPG, peperonni.jpg', '470', '2024-02-19 14:34:07', '2024-02-19 14:34:07');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

CREATE TABLE `pedidos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_producto` bigint(20) UNSIGNED NOT NULL,
  `id_bebida` bigint(20) UNSIGNED NOT NULL,
  `id_postre` bigint(20) UNSIGNED NOT NULL,
  `id_comprador` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cantidad_comprada_pizza` int(11) NOT NULL DEFAULT 0,
  `cantidad_comprada_bebida` int(11) NOT NULL DEFAULT 0,
  `cantidad_comprada_postre` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_producto`, `id_bebida`, `id_postre`, `id_comprador`, `created_at`, `updated_at`, `cantidad_comprada_pizza`, `cantidad_comprada_bebida`, `cantidad_comprada_postre`) VALUES
(1, 14, 1, 1, 3, '2024-02-09 02:10:47', '2024-02-09 02:10:47', 1, 1, 1),
(9, 19, 7, 2, 31, '2024-02-16 09:08:07', '2024-02-16 09:08:07', 1, 1, 1),
(10, 16, 6, 3, 31, '2024-02-16 12:51:01', '2024-02-16 12:51:01', 2, 1, 1),
(11, 13, 1, 1, 31, '2024-02-16 20:47:47', '2024-02-16 20:47:47', 0, 0, 0),
(12, 13, 2, 2, 31, '2024-02-16 20:47:47', '2024-02-16 20:47:47', 0, 0, 0),
(13, 14, 3, 3, 31, '2024-02-16 20:47:47', '2024-02-16 20:47:47', 0, 0, 0),
(14, 15, 4, 4, 31, '2024-02-16 20:47:47', '2024-02-16 20:47:47', 0, 0, 0),
(15, 16, 5, 5, 31, '2024-02-16 20:47:47', '2024-02-16 20:47:47', 0, 0, 0),
(20, 14, 2, 2, 31, '2024-02-17 06:09:33', '2024-02-17 06:09:33', 1, 0, 0),
(21, 14, 2, 2, 31, '2024-02-17 06:09:58', '2024-02-17 06:09:58', 1, 0, 0),
(22, 14, 2, 2, 31, '2024-02-17 06:10:00', '2024-02-17 06:10:00', 1, 0, 0),
(23, 13, 2, 2, 31, '2024-02-17 06:10:20', '2024-02-17 06:10:20', 0, 0, 0),
(24, 14, 1, 5, 31, '2024-02-17 06:20:27', '2024-02-17 06:20:27', 0, 0, 2),
(25, 16, 5, 2, 31, '2024-02-17 06:21:38', '2024-02-17 06:21:38', 0, 0, 0),
(26, 13, 2, 2, 31, '2024-02-17 06:22:18', '2024-02-17 06:22:18', 0, 0, 0),
(28, 13, 2, 2, 31, '2024-02-17 06:27:38', '2024-02-17 06:27:38', 0, 0, 0),
(29, 16, 5, 3, 31, '2024-02-17 06:28:16', '2024-02-17 06:28:16', 0, 0, 0),
(30, 20, 7, 5, 31, '2024-02-17 06:29:01', '2024-02-17 06:29:01', 0, 2, 2),
(32, 13, 2, 2, 31, '2024-02-17 06:36:43', '2024-02-17 06:36:43', 4, 4, 4),
(33, 15, 4, 4, 31, '2024-02-17 06:38:30', '2024-02-17 06:38:30', 5, 7, 4),
(34, 13, 5, 2, 10, '2024-02-17 13:20:28', '2024-02-17 13:20:28', 4, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'ver-rol', 'web', NULL, '2022-11-26 01:55:58', '2022-11-26 01:55:58'),
(2, 'crear-rol', 'web', NULL, '2022-11-26 01:55:58', '2022-11-26 01:55:58'),
(3, 'editar-rol', 'web', NULL, '2022-11-26 01:55:58', '2022-11-26 01:55:58'),
(4, 'borrar-rol', 'web', NULL, '2022-11-26 01:55:58', '2022-11-26 01:55:58'),
(5, 'Usuario-rol', 'web', NULL, '2023-01-15 17:26:58', '2023-01-15 17:26:58'),
(6, 'Administrador-rol', 'web', NULL, '2023-04-25 13:16:18', '2023-04-25 13:16:18');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pizzeria`
--

CREATE TABLE `pizzeria` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_pizza` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `precio_pizza` double NOT NULL,
  `imagen_pizza` text DEFAULT NULL,
  `vendido` tinyint(1) NOT NULL DEFAULT 0,
  `id_usuario` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pizzeria`
--

INSERT INTO `pizzeria` (`id`, `nombre_pizza`, `precio_pizza`, `imagen_pizza`, `vendido`, `id_usuario`) VALUES
(12, 'Vegan Royal', 140, 'vegan_royal.JPG', 0, 3),
(13, 'Pizza Hawaiina', 180, 'pizza_hawaiina.jpg', 0, 3),
(14, 'Meat Lovers', 200, 'meat_lovers.jpg', 0, 3),
(15, 'Pepperoni', 200, 'peperonni.jpg', 0, 3),
(16, 'Solo queso', 150, 'pizza_queso.jpg', 0, 3),
(19, 'Pizza Veggie', 140, 'vegetariana.jpg', 0, 3),
(20, 'Pizza Pastor', 209, 'pizza_pastor.jpg', 0, 3),
(22, 'Pizza carnes frias', 239, 'Pizza_carnes_frias.jpg', 0, 3),
(23, 'PIZZA NORTEÑA', 239, 'Pizza_NORTEÑA.jpg', 0, 3),
(24, 'Pizza Honolulu', 239, 'Pizza_Honolulu.jpg', 0, 3),
(25, 'Pizza Mexicana', 229, 'pizza mexicana.jpg', 0, 3),
(26, 'Pizza Chicken Hawaiina', 229, 'Pizza_Chicken_Hawaiina.jpg', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `postres`
--

CREATE TABLE `postres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_postre` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `postre_precio` double NOT NULL,
  `postre_imagen` text DEFAULT NULL,
  `vendido` int(1) NOT NULL DEFAULT 0,
  `id_usuario` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `postres`
--

INSERT INTO `postres` (`id`, `nombre_postre`, `postre_precio`, `postre_imagen`, `vendido`, `id_usuario`) VALUES
(1, 'Vanilla Icecream', 60, 'vanilla_icecream.JPG', 0, 3),
(2, 'Cherry Icecream', 60, 'cherry.JPG', 0, 3),
(3, 'Vanilla Almond Chocolate Ice-cream', 70, 'helado-vainilla-chocolate-almendra-grande.jpg', 0, 3),
(4, 'Chocolate Icecream', 70, 'helado-chocolate-pequeno.jpg', 1, 3),
(5, 'Choco Fudge Brownie', 70, 'choco_fudge_brownie.JPG', 1, 3),
(6, 'Chunky Monkey Ice Cream', 75, 'banana-chunk-ice-cream.JPG', 0, 3),
(7, 'Dulce Delish Ice Cream', 75, 'dulce-delish-ice-cream.JPG', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `producto_bebidas`
--

CREATE TABLE `producto_bebidas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_bebida` bigint(20) UNSIGNED NOT NULL,
  `id_comprador` bigint(20) UNSIGNED NOT NULL,
  `cantidad_comprada` int(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `producto_bebidas`
--

INSERT INTO `producto_bebidas` (`id`, `id_bebida`, `id_comprador`, `cantidad_comprada`, `created_at`, `updated_at`) VALUES
(1, 1, 31, 2, '2023-11-17 10:34:04', '2023-11-17 10:34:04'),
(30, 2, 31, 1, '2024-02-17 06:58:31', '2024-02-17 06:58:31'),
(31, 5, 31, 1, '2024-02-17 06:59:02', '2024-02-17 06:59:02'),
(32, 6, 31, 1, '2024-02-17 06:59:05', '2024-02-17 06:59:05'),
(34, 6, 10, 2, '2024-02-17 10:21:22', '2024-02-17 10:21:22'),
(35, 2, 10, 1, '2024-02-17 10:22:08', '2024-02-17 10:22:08'),
(38, 7, 10, 1, '2024-02-18 06:21:05', '2024-02-18 06:21:05'),
(40, 1, 2, 2, '2024-02-18 07:29:06', '2024-02-18 07:29:06'),
(41, 3, 2, 2, '2024-02-19 14:33:47', '2024-02-19 14:33:47');

-- --------------------------------------------------------

--
-- Table structure for table `producto_pizzas`
--

CREATE TABLE `producto_pizzas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_producto` bigint(20) UNSIGNED NOT NULL,
  `id_comprador` bigint(20) UNSIGNED NOT NULL,
  `cantidad_comprada` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `producto_pizzas`
--

INSERT INTO `producto_pizzas` (`id`, `id_producto`, `id_comprador`, `cantidad_comprada`, `created_at`, `updated_at`) VALUES
(1, 13, 33, 1, '2023-11-17 10:34:04', '2023-11-17 10:34:04'),
(2, 13, 33, 1, '2023-11-17 10:35:35', '2023-11-17 10:35:35'),
(3, 20, 33, 1, '2023-11-17 10:59:23', '2023-11-17 10:59:23'),
(4, 20, 33, 1, '2023-11-17 10:59:58', '2023-11-17 10:59:58'),
(5, 16, 3, 1, '2023-11-17 11:49:52', '2023-11-17 11:49:52'),
(6, 15, 3, 1, '2023-11-17 11:49:58', '2023-11-17 11:49:58'),
(7, 19, 3, 1, '2023-11-17 12:10:44', '2023-11-17 12:10:44'),
(8, 19, 3, 1, '2023-11-17 12:11:31', '2023-11-17 12:11:31'),
(9, 19, 3, 1, '2023-11-17 12:12:31', '2023-11-17 12:12:31'),
(10, 19, 3, 1, '2023-11-17 12:12:32', '2023-11-17 12:12:32'),
(11, 19, 3, 1, '2023-11-17 12:12:40', '2023-11-17 12:12:40'),
(12, 19, 3, 1, '2023-11-17 12:12:41', '2023-11-17 12:12:41'),
(13, 19, 3, 1, '2023-11-17 12:14:58', '2023-11-17 12:14:58'),
(14, 19, 3, 1, '2023-11-17 12:20:05', '2023-11-17 12:20:05'),
(15, 19, 3, 1, '2023-11-17 12:20:22', '2023-11-17 12:20:22'),
(16, 19, 3, 1, '2023-11-17 12:22:43', '2023-11-17 12:22:43'),
(17, 19, 3, 1, '2023-11-17 12:22:44', '2023-11-17 12:22:44'),
(18, 19, 3, 1, '2023-11-17 12:22:45', '2023-11-17 12:22:45'),
(19, 19, 3, 1, '2023-11-17 12:22:45', '2023-11-17 12:22:45'),
(20, 19, 3, 1, '2023-11-17 12:22:46', '2023-11-17 12:22:46'),
(21, 19, 3, 1, '2023-11-17 12:22:46', '2023-11-17 12:22:46'),
(22, 19, 3, 1, '2023-11-17 12:22:46', '2023-11-17 12:22:46'),
(23, 13, 31, 2, '2024-02-14 06:24:40', '2024-02-14 06:24:40'),
(27, 13, 10, 2, '2024-02-15 05:42:58', '2024-02-15 05:42:58'),
(28, 14, 10, 1, '2024-02-15 06:11:31', '2024-02-15 06:11:31'),
(29, 13, 31, 3, '2024-02-17 09:27:43', '2024-02-17 09:27:43'),
(30, 14, 31, 2, '2024-02-17 09:28:53', '2024-02-17 09:28:53'),
(34, 13, 2, 2, '2024-02-19 13:00:54', '2024-02-19 13:00:54'),
(35, 15, 2, 2, '2024-02-19 14:33:54', '2024-02-19 14:33:54');

-- --------------------------------------------------------

--
-- Table structure for table `producto_postres`
--

CREATE TABLE `producto_postres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_postre` bigint(20) UNSIGNED NOT NULL,
  `id_comprador` bigint(20) UNSIGNED NOT NULL,
  `cantidad_comprada` int(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `producto_postres`
--

INSERT INTO `producto_postres` (`id`, `id_postre`, `id_comprador`, `cantidad_comprada`, `created_at`, `updated_at`) VALUES
(1, 1, 33, 2, '2023-11-17 10:34:04', '2023-11-17 10:34:04'),
(2, 2, 33, 2, '2023-11-17 10:35:35', '2024-02-17 09:56:25'),
(3, 3, 10, 2, '2024-02-15 06:26:13', '2024-02-17 09:56:31'),
(9, 2, 31, 1, '2024-02-17 06:54:36', '2024-02-17 06:54:36'),
(10, 2, 10, 3, '2024-02-17 10:24:51', '2024-02-17 10:24:51'),
(11, 2, 10, 2, '2024-02-17 10:39:09', '2024-02-17 10:39:09'),
(17, 2, 2, 3, '2024-02-18 07:29:16', '2024-02-18 07:29:16'),
(18, 2, 2, 2, '2024-02-19 13:00:47', '2024-02-19 13:00:47'),
(19, 3, 2, 2, '2024-02-21 08:30:54', '2024-02-21 08:30:54'),
(20, 7, 2, 2, '2024-02-26 14:19:40', '2024-02-26 14:19:40'),
(21, 2, 2, 2, '2024-02-27 06:21:51', '2024-02-27 06:21:51');

-- --------------------------------------------------------

--
-- Table structure for table `promociones`
--

CREATE TABLE `promociones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_promocion` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `promocion_precio` double NOT NULL,
  `promocion_imagen` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Usuario', 'web', '2023-01-16 18:52:53', '2023-01-16 18:52:53'),
(2, 'Administrador', 'web', '2023-01-16 18:53:59', '2023-01-16 18:53:59');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Jorge Juan Borges Boldanos', 'j.juanbaldanos@gmail.com', NULL, '$2y$10$oTFHGITikmKCkO3CP3WTDeemMXUC7RiF9nc00AUTJzBhmtkPICNbK', NULL, '2023-11-14 10:56:06', '2023-11-15 03:58:57'),
(3, 'admin', 'admin@admin.com', NULL, '$2y$10$2QS74GIbOAgw05UpuncAiOv.AuWHBkBdPgXpDGUOyRGniwqfSHQoy', NULL, '2023-11-14 13:25:00', '2023-11-15 03:09:57'),
(4, 'Abril Mejia Rangel', 'avril.rock1471@gmail.com', NULL, '$2y$10$pJ2pfff9kLEcgHAics9q2OubX0VK06PBJOtj.ax6u8XTnyWsUEq4y', NULL, '2023-11-15 03:09:36', '2023-11-15 03:09:36'),
(10, 'Jonathan', 'jonathan@tec.com.mx', NULL, '$2y$10$bnjTL4bLpOu7b0EvzOV4T.4U6/QEIpXf81yAExAJGwbxmUQEOzwxK', NULL, '2023-11-16 13:50:34', '2023-11-16 13:50:34'),
(31, 'Veronica Rangel Flores', 'graciela.aa@tec.com.mx', NULL, '$2y$10$singYUy0KHV3zFz5EtgpSuY7IXp2TZ8mFuhBEp9w2Q4vxPzDTO5sa', NULL, '2023-11-17 00:03:16', '2023-11-17 00:03:16'),
(32, 'graciela', 'graciela.aa@tec.com.mx', NULL, '$2y$10$vc5nVq0xn8T1EkoXLcfz1.Rr3L.AWUWOPpJ1zu0aUUeFpkD.QcHPG', NULL, '2023-11-17 04:12:18', '2023-11-17 04:12:18'),
(33, 'Victor Alfonso', 'victor.alfonso.gv@tec.com.mx', NULL, '$2y$10$qt6OnOfAQ.hNBgyA/7q2FOGRGNEFDcgfFkxeZ3UdZdEzfZnd640Pi', NULL, '2023-11-17 09:13:53', '2023-11-17 09:13:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bebidas`
--
ALTER TABLE `bebidas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `orden_pedidos`
--
ALTER TABLE `orden_pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_comprador` (`id_comprador`),
  ADD KEY `pedidos_ibfk_3` (`id_bebida`),
  ADD KEY `pedidos_ibfk_4` (`id_postre`),
  ADD KEY `pedidos_id_producto_foreign` (`id_producto`) USING BTREE;

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`),
  ADD KEY `permissions_roles` (`role_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pizzeria`
--
ALTER TABLE `pizzeria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pizzeria_id_usuario_foreign` (`id_usuario`);

--
-- Indexes for table `postres`
--
ALTER TABLE `postres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `producto_bebidas`
--
ALTER TABLE `producto_bebidas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_bebidas_id_comprador_foreign` (`id_comprador`),
  ADD KEY `producto_bebidas_id_producto_foreign` (`id_bebida`);

--
-- Indexes for table `producto_pizzas`
--
ALTER TABLE `producto_pizzas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`,`id_comprador`),
  ADD KEY `id_comprador` (`id_comprador`);

--
-- Indexes for table `producto_postres`
--
ALTER TABLE `producto_postres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_postres_id_comprador_foreign` (`id_comprador`),
  ADD KEY `producto_postres_id_producto_foreign` (`id_postre`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bebidas`
--
ALTER TABLE `bebidas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orden_pedidos`
--
ALTER TABLE `orden_pedidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pizzeria`
--
ALTER TABLE `pizzeria`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `postres`
--
ALTER TABLE `postres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `producto_bebidas`
--
ALTER TABLE `producto_bebidas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `producto_pizzas`
--
ALTER TABLE `producto_pizzas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `producto_postres`
--
ALTER TABLE `producto_postres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bebidas`
--
ALTER TABLE `bebidas`
  ADD CONSTRAINT `bebidas_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Constraints for table `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orden_pedidos`
--
ALTER TABLE `orden_pedidos`
  ADD CONSTRAINT `orden_pedidos_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`id_comprador`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `pedidos_ibfk_3` FOREIGN KEY (`id_bebida`) REFERENCES `bebidas` (`id`),
  ADD CONSTRAINT `pedidos_ibfk_4` FOREIGN KEY (`id_postre`) REFERENCES `postres` (`id`),
  ADD CONSTRAINT `pedidos_id_producto_foreign` FOREIGN KEY (`id_producto`) REFERENCES `pizzeria` (`id`);

--
-- Constraints for table `pizzeria`
--
ALTER TABLE `pizzeria`
  ADD CONSTRAINT `pizzeria_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Constraints for table `postres`
--
ALTER TABLE `postres`
  ADD CONSTRAINT `postres_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Constraints for table `producto_bebidas`
--
ALTER TABLE `producto_bebidas`
  ADD CONSTRAINT `producto_bebidas_id_comprador_foreign` FOREIGN KEY (`id_comprador`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `producto_bebidas_id_producto_foreign` FOREIGN KEY (`id_bebida`) REFERENCES `bebidas` (`id`);

--
-- Constraints for table `producto_pizzas`
--
ALTER TABLE `producto_pizzas`
  ADD CONSTRAINT `producto_pizzas_id_comprador_foreign` FOREIGN KEY (`id_comprador`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `producto_pizzas_id_producto_foreign` FOREIGN KEY (`id_producto`) REFERENCES `pizzeria` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `producto_postres`
--
ALTER TABLE `producto_postres`
  ADD CONSTRAINT `producto_postres_id_comprador_foreign` FOREIGN KEY (`id_comprador`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `producto_postres_id_producto_foreign` FOREIGN KEY (`id_postre`) REFERENCES `postres` (`id`);

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

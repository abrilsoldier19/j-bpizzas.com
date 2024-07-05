-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2023 at 07:31 AM
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
-- Table structure for table `bebidas`
--

CREATE TABLE `bebidas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_bebida` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `bebida_precio` double NOT NULL,
  `bebida_imagen` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
`id_postre` bigint(20) UNSIGNED NOT NULL,
`id_bebida` bigint(20) UNSIGNED NOT NULL,
  `id_comprador` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_producto`, `id_comprador`, `created_at`, `updated_at`) VALUES
(1, 12, 33, '2023-11-17 10:34:04', '2023-11-17 10:34:04'),
(2, 13, 33, '2023-11-17 10:35:35', '2023-11-17 10:35:35'),
(3, 20, 33, '2023-11-17 10:59:23', '2023-11-17 10:59:23'),
(4, 20, 33, '2023-11-17 10:59:58', '2023-11-17 10:59:58'),
(5, 16, 3, '2023-11-17 11:49:52', '2023-11-17 11:49:52'),
(6, 15, 3, '2023-11-17 11:49:58', '2023-11-17 11:49:58'),
(7, 19, 3, '2023-11-17 12:10:44', '2023-11-17 12:10:44'),
(8, 19, 3, '2023-11-17 12:11:31', '2023-11-17 12:11:31'),
(9, 19, 3, '2023-11-17 12:12:31', '2023-11-17 12:12:31'),
(10, 19, 3, '2023-11-17 12:12:32', '2023-11-17 12:12:32'),
(11, 19, 3, '2023-11-17 12:12:40', '2023-11-17 12:12:40'),
(12, 19, 3, '2023-11-17 12:12:41', '2023-11-17 12:12:41'),
(13, 19, 3, '2023-11-17 12:14:58', '2023-11-17 12:14:58'),
(14, 19, 3, '2023-11-17 12:20:05', '2023-11-17 12:20:05'),
(15, 19, 3, '2023-11-17 12:20:22', '2023-11-17 12:20:22'),
(16, 19, 3, '2023-11-17 12:22:43', '2023-11-17 12:22:43'),
(17, 19, 3, '2023-11-17 12:22:44', '2023-11-17 12:22:44'),
(18, 19, 3, '2023-11-17 12:22:45', '2023-11-17 12:22:45'),
(19, 19, 3, '2023-11-17 12:22:45', '2023-11-17 12:22:45'),
(20, 19, 3, '2023-11-17 12:22:46', '2023-11-17 12:22:46'),
(21, 19, 3, '2023-11-17 12:22:46', '2023-11-17 12:22:46'),
(22, 19, 3, '2023-11-17 12:22:46', '2023-11-17 12:22:46');

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
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_pizza` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `precio_pizza` double NOT NULL,
  `imagen_pizza` text DEFAULT NULL,
  `vendido` tinyint(1) NOT NULL DEFAULT 0,
  `id_usuario` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pizzeria`
--

INSERT INTO `pizzeria` (`id`, `nombre_pizza`, `precio_pizza`, `imagen_pizza`, `vendido`, `id_usuario`) VALUES
(12, 'Veggie Lovers', 140, 'vegetariana.jpg', 1, 0),
(13, 'Pizza Hawaiina', 180, 'pizza_hawaiina.jpg', 1, 0),
(14, 'Meat Lovers', 200, 'meat_lovers.jpg', 0, 0),
(15, 'Pepperoni', 200, 'peperonni.jpg', 1, 0),
(16, 'Solo queso', 150, 'pizza_queso.jpg', 1, 0),
(19, 'Pizza Veggie', 140, 'vegetariana.jpg', 1, 0),
(20, 'Pizza Pastor', 209, 'pizza_pastor.jpg', 1, 33),
(21, 'Pizza Pastor', 209, 'pizza_pastor.jpg', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `postres`
--

CREATE TABLE `postres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_postre` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `postre_precio` double NOT NULL,
  `postre_imagen` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`,`id_comprador`),
  ADD KEY `id_comprador` (`id_comprador`);

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
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

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



ALTER TABLE `pedidos` ADD  CONSTRAINT `pedidos_id_postre_foreign` FOREIGN KEY (`id_postre`) REFERENCES `postres`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `pedidos` ADD  CONSTRAINT `pedidos_id_bebida_foreign` FOREIGN KEY (`id_bebida`) REFERENCES `bebidas`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

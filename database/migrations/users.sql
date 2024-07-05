-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2023 at 01:51 AM
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

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Jesus', 'admin@admin.com', NULL, '$2y$10$3FdDPsR9suStXWkL0vUtn.ao1/gok.EPytZSFamNKVG7LFL2MfNrG', NULL, '2023-01-16 04:24:40', '2023-04-19 13:56:32'),
(2, 'jesus', 'jesus@tec.com.mx', NULL, '$2y$10$B9y/HrFxkRXdzwpW7ttPBumiBotIi6wicWu5pWnDpjwoCuGjaz1D6', NULL, '2023-01-16 06:08:55', '2023-01-16 06:08:55'),
(4, 'Pepito', 'pepito@tec.com.mx', NULL, '$2y$10$jbb4lGKVQm75CKAnoAQsQ.tYiEEZSUN.8BSR9/uyweM1azZkP9/Te', NULL, '2023-02-10 23:05:34', '2023-02-10 23:05:34'),
(5, 'Homero', 'homero@tec.com.mx', NULL, '$2y$10$Y5p4D1fBZIwOR1BkMaEzFOkGwTFkq0zAIc6muUSgaUKLu0LNquOmC', NULL, '2023-04-14 02:57:48', '2023-04-14 02:57:48'),
(6, 'Abril Mejia Rangel', 'avril.rock1471@gmail.com', NULL, '$2y$10$69.oEaVical94wTOiitZreLcogr9p2fsFCAs6mY3JKG03OjB8wkH.', NULL, '2023-04-18 08:12:53', '2023-04-18 08:12:53'),
(7, 'jesus ramos', 'lol@outlook.com', NULL, '$2y$10$bXqO4oaiPR2OUCYVTqAXROqbeb/W78tLVG.LomGl50IOdKuzrHbYy', NULL, '2023-04-18 08:59:07', '2023-04-18 08:59:07'),
(8, 'Luis', 'luis19@outlook.com', NULL, '$2y$10$JAW599bfQVaPUVQM80VPSei8T/udKCfu8nZn66AM48mPsSKbw3xwO', NULL, '2023-04-19 20:19:45', '2023-04-19 20:19:45'),
(9, 'Aguilar Covarrubias Norma Aracely', 'norma.ac@tec.com.mx', NULL, '$2y$10$yF83Nw24SfvfW1dijdDdDuXp1rHnLQrCsGNGbqchCFbzn6Rl9Bxw6', NULL, '2023-04-22 09:25:25', '2023-04-22 09:25:25'),
(10, 'Aguilera Mancilla Héctor', 'hector.am@tec.com.mx', NULL, '$2y$10$WpkOAmn18O3FkcEuYgOeZOPA8rNUJMUQKlkeVQ2VIHCExfQDjAYta', NULL, '2023-04-22 09:26:28', '2023-04-22 09:26:28'),
(11, 'Aldape Suárez Miguel', 'miguel.as@tec.com.mx', NULL, '$2y$10$sQHN0vr9S.4s2y4zF2TonObQO7fgxOy/3fEpfI5daQWa86Z2p6MJ.', NULL, '2023-04-22 09:27:54', '2023-04-22 09:27:54'),
(12, 'Aranda Alarcón Graciela', 'graciela.aa@tec.com.mx', NULL, '$2y$10$.rNycZ3X1JTli9NIlIrjouyBFeR0knp6jEVUZGMwO/vxvd524nYX2', NULL, '2023-04-22 09:28:44', '2023-04-22 09:28:44'),
(13, 'Asís Cipriano Karime', 'karime.ac@tec.com.mx', NULL, '$2y$10$D6J4/P.S/Ue8Ns6E57rf4.b40NHuPvs0s7JhyGdeyDrcS/K0L9tnC', NULL, '2023-04-22 09:29:37', '2023-04-22 09:29:37'),
(14, 'Baltierra Costeira Gabriela', 'gabriela.bc@tec.com.mx', NULL, '$2y$10$PIAJtgyC4h/Wlf4hMnx7J.OxNYh4fUHduui4vZbe0GN5qciaE/Rny', NULL, '2023-04-22 09:30:43', '2023-04-22 09:30:43'),
(15, 'Botello Reyes Mario Alan', 'mario.alan.br@tec.com.mx', NULL, '$2y$10$xSNVbi.VnHWrSpuD04oUs.hxV6TxJSY/dPrkbORKomK1uvt4dblOu', NULL, '2023-04-22 09:32:41', '2023-04-22 09:32:41'),
(16, 'Coronado Ríos Reyes', 'reyes.cr@tec.com.mx', NULL, '$2y$10$I/nqZk8Y9JzLoWRRrM2O7eiSzFzEiIPppdWCKvkY6Zjtr.j6G25gW', NULL, '2023-04-22 09:34:49', '2023-04-22 09:34:49'),
(17, 'Cortes Guerrero David', 'david.cg@tec.com.mx', NULL, '$2y$10$93Vw05zC.U8nX6QlIJmykO0KMBvWCb88LPrK6EPqtrm0Nn4kZpsUO', NULL, '2023-04-22 09:36:32', '2023-04-22 09:36:32'),
(18, 'Cortez Del Valle Homero', 'homero.cdelv@tec.com.mx', NULL, '$2y$10$qWOGdCDsJEcZh/6zFogeHexEOl13CBzRxd.qUfSNlDxDN9gs9LqWC', NULL, '2023-04-22 09:39:15', '2023-04-22 09:39:15'),
(19, 'De Hoyos Valdés Jaime', 'jaime.hv@tec.com.mx', NULL, '$2y$10$TubemhR7vuvEz2.5RD2V7eG2HO5GLbRulsgAILet3GfsxQLrDmwuG', NULL, '2023-04-22 09:41:12', '2023-04-22 09:41:12'),
(20, 'De Los Santos Flores Hugo Alberto', 'hugo.alberto.sf@tec.com.mx', NULL, '$2y$10$0IUwmcnr.64wC1Kpl8Vje.4DPCsXXnBvzNg/g.HvtBmmUNdBiHgf.', NULL, '2023-04-22 09:41:52', '2023-04-22 09:41:52'),
(21, 'Díaz Blanco Deniss Itzhel', 'itzhel.deniss.db@tec.com.mx', NULL, '$2y$10$UTJgLEQxNvBxP1l0GbVpI.TAa2MlZNyATxlOu/ERr32O80gJPoXc2', NULL, '2023-04-22 09:44:34', '2023-04-22 09:44:34'),
(22, 'Díaz Menchaca José Raúl', 'jose.raul.dm@tec.com.mx', NULL, '$2y$10$1F1T0lU3l/Oj2v6vGLpc0etLT36EogKigZAetz6Ohme3EoCdem836', NULL, '2023-04-22 09:45:12', '2023-04-22 09:45:12'),
(23, 'Duarte Sánchez Ricardo Fidel', 'fidel.ricardo.ds@tec.com.mx', NULL, '$2y$10$upICSoAO7yLKtf514yBPkOW4INLkgZmuRRHLvQDumpSmUgSzj0rvG', NULL, '2023-04-22 09:45:56', '2023-04-22 09:45:56'),
(24, 'Escoto Sánchez Héctor Javier', 'hector.javier.es@tec.com.mx', NULL, '$2y$10$.KPUyNvc2hDElxgVh1x8vOEYVKL9IudLDOM7ZR2fvaOiCcvOl8UX.', NULL, '2023-04-22 09:46:39', '2023-04-22 09:46:39'),
(25, 'Flores Flores Irasema', 'irasema.flores@tec.com.mx', NULL, '$2y$10$EhQfLTRUxwCOmoibDW/Exu62amQGLRTVi6Y.EFsOEWG8i.FOBfxjy', NULL, '2023-04-22 09:47:16', '2023-04-22 09:47:16'),
(26, 'Flores Peña Enrique', 'enrique.fp@tec.com.mx', NULL, '$2y$10$J08dc8CFYLE/MaCy.r4OEODm1a/af.D/MnQNQvJLl8Xsv7dAWKQlG', NULL, '2023-04-22 09:49:13', '2023-04-22 09:49:13'),
(27, 'Franco Cuellar Mónica Patricia', 'monica.patricia.fc@tec.com.mx', NULL, '$2y$10$g.67RtlxhGLM72Ehruo3M./rPWjlFT4uYkkGN7SjZDThG5MPFmoeO', NULL, '2023-04-22 09:50:24', '2023-04-22 09:50:24'),
(28, 'Fuentes Puente Edna Marcela', 'edna.marcela.fp@tec.com.mx', NULL, '$2y$10$GjRj3yjYVTfrBYcxvETPAO8x20TUQHLP1FoLwrjPGRYZ3bwTRU0Ja', NULL, '2023-04-22 09:51:23', '2023-04-22 09:51:23'),
(29, 'Garcia Vazquez Victor Alfonso', 'victor.alfonso.gv@tec.com.mx', NULL, '$2y$10$YvyarOdvsbT4eVVgWq1NKuIQMcP4PZ6q19SNQOVM3pDuG8MTUgLl.', NULL, '2023-04-22 09:52:04', '2023-04-22 09:52:04'),
(30, 'Garcia Plata Maria Antonieta', 'antonieta.maria.gp@tec.com.mx', NULL, '$2y$10$zCm10h41OxcRdeRCuNpDVexnLKqLa0KGUZADAKbNJX.S1dU0U0S.6', NULL, '2023-04-22 09:53:12', '2023-04-22 09:53:12'),
(31, 'González Escobedo Carmina', 'carmina.ge@tec.com.mx', NULL, '$2y$10$nR2n6OnLQO/0iEVyPyokb.sSKsCTP2ADN1cF1eh7jJ1jGA112f1qS', NULL, '2023-04-22 09:53:44', '2023-04-22 09:53:44'),
(32, 'González Puente Isaac', 'isaac.gp@tec.com.mx', NULL, '$2y$10$BfpjV6ipgUuJGg5BoWUcrO34G0u0qGHp7iMyIeMVhD1819SGzyPqa', NULL, '2023-04-22 09:54:49', '2023-04-22 09:54:49'),
(33, 'González Puente Zaida Aydeé', 'zaida.aydee.gp@tec.com.mx', NULL, '$2y$10$.zU6/MZhy1Rks5vrIm4.VuOWqqPi3rPlr3McEq6PS7.38rjeiY6CS', NULL, '2023-04-22 09:55:58', '2023-04-22 09:55:58'),
(34, 'Gonzalez Rodriguez Laura Elena', 'laura.elena.gr@tec.com.mx', NULL, '$2y$10$EfZZu53n4DZ6KPwQx6S70Op4tOOpN9hZU7wYie1kdCJsXGQtPQYyO', NULL, '2023-04-22 09:56:42', '2023-04-22 09:56:42'),
(35, 'González Treviño Gibran Jalil', 'gilbran.jalil.gt@tec.com.mx', NULL, '$2y$10$PFGM7X7IPU/SK8d.VNX6UOjibRxKUGj6rgTdznHnaV7TTvpCx64UC', NULL, '2023-04-22 09:57:17', '2023-04-22 09:57:17'),
(36, 'González Zamarripa Gregorio', 'gregorio.gz@tec.com.mx', NULL, '$2y$10$Z6wPX.4l50UQFoZA0KM/t.IKn/2TxRKZKNjgBj4RydMryd24vQnpS', NULL, '2023-04-22 10:00:29', '2023-04-22 10:00:29'),
(37, 'Hernández Córdova Adriana', 'adriana.hc@tec.com.mx', NULL, '$2y$10$PoCcQrAToUd9ASMRggW1xOSFiqerXYD.BvxJQyHlg3r3SI3WVC/jK', NULL, '2023-04-22 10:06:31', '2023-04-22 10:06:31'),
(38, 'Hernandez Rodriguez Héctor', 'hector.hr@tec.com.mx', NULL, '$2y$10$fP5eE6dTQ5LYLehaa1Bk3uT7PsnAeK35FJuDi/L.oNtRHgkhZF5YG', NULL, '2023-04-22 10:07:55', '2023-04-22 10:07:55'),
(39, 'Hernändez Treviño José Mario', 'jose.mario.ht@tec.com.mx', NULL, '$2y$10$rvVlLTMZkFLckpIRxfcAde5jTzIRhwXB0KqPLqdaz9pXcRMtyw2JS', NULL, '2023-04-22 10:14:51', '2023-04-22 10:14:51'),
(40, 'Herrera Valdez Ernesto', 'ernesto.hv@tec.com.mx', NULL, '$2y$10$6MO7cUJAlUMIIZDrrjyM4ugm6zwa4FnETt4JAepg6CPy8.u5JYJjq', NULL, '2023-04-22 10:15:30', '2023-04-22 10:15:30'),
(41, 'Jasso Ibarra Sandra Lilia', 'sandra.lilia.ji@tec.com.mx', NULL, '$2y$10$JJRq1TcXT7HLGUm7o4e3tuubIocPb8AwT.LV/OCRyBsz24dvw9Wbe', NULL, '2023-04-22 10:16:42', '2023-04-22 10:16:42'),
(42, 'Jiménez Zavala Felipe', 'felipe.jz@tec.com.mx', NULL, '$2y$10$pBd47WZRCN8vENv5FAvImOBRJTOPPErAy6m61lZzHTGcxlQo63PCe', NULL, '2023-04-22 10:17:26', '2023-04-22 10:17:26'),
(43, 'Jordán Marmolejo Luís Gerardo', 'luis.gerardo.jm@tec.com.mx', NULL, '$2y$10$6yvliydvrWLDLKyccKyGGO2PYjWVHmwDhIa/i8AlBjLb1/Pf60S1W', NULL, '2023-04-22 10:20:28', '2023-04-22 10:20:28'),
(44, 'López Cepeda Jonathan', 'joanathan.lc@tec.com.mx', NULL, '$2y$10$fnZVnibMyR6TcdgXy1FvOe5zJ1W1OQ0D0Ekbd2GKSqpNIC77Cdu3O', NULL, '2023-04-22 10:21:33', '2023-04-22 10:21:33'),
(45, 'Martínez Flores Rocío', 'rocio.mf@tec.com.mx', NULL, '$2y$10$JNb25tOgerFVB4bZAASTIeDmDPh2S4zbKAZOOxGdVGvs4/QOphpay', NULL, '2023-04-22 10:23:15', '2023-04-22 10:23:15'),
(46, 'Martínez García Ruth Margarita', 'ruth.margarita.mg@tec.com.mx', NULL, '$2y$10$4YTuv0O3p9RGomEwvbMvz.IHwUOUhg.IBJv3brzCicgY.h.0ZB/HG', NULL, '2023-04-22 10:28:03', '2023-04-22 10:28:03'),
(47, 'Martínez Narvaez Jorge Alberto', 'jorge.alberto.mn@tec.com.mx', NULL, '$2y$10$6el6CSYQ.o862URS9YPb4O/NQuI/PGQQdr/aswCppHzaSOfNDwE7y', NULL, '2023-04-22 10:28:50', '2023-04-22 10:28:50'),
(48, 'Martinez Campos Javier', 'javier.mc@tec.com.mx', NULL, '$2y$10$ZqETEmUjy0LyNo3kg7BTqek2t3tjVF.prg/9oVvjZhuDhGKxJ06Y6', NULL, '2023-04-22 10:29:43', '2023-04-22 10:29:43'),
(50, 'Martínez Vela Verónica', 'veronica.mv@tec.com.mx', NULL, '$2y$10$55Jeu.qrosgUL9EqQQWDXOUgyMij9ahdBiycoOTf9kqMX8UXzUYO6', NULL, '2023-04-22 10:30:56', '2023-04-22 10:30:56'),
(51, 'Medina Guzmán Laura', 'laura.mg@tec.com.mx', NULL, '$2y$10$fO9PsZ6V6t63T3Us8HLPVeYObWhqxiIzVglhwAjPVZ8gt0ZnAdt5K', NULL, '2023-04-22 10:31:55', '2023-04-22 10:31:55'),
(52, 'Meléndez López Edith Margot', 'edith.margot.ml@tec.com.mx', NULL, '$2y$10$7TNgNPvq8eXWzN5R1zHGv.9BzpuL1igKd3NRjQqMcrykYf0Gs1QQu', NULL, '2023-04-22 10:32:53', '2023-04-22 10:32:53'),
(53, 'Morales Medina José Luís', 'jose.luis.mm@tec.com.mx', NULL, '$2y$10$PRrW9xPwWFv0aedcCFwLHum7Q2gJoR91p.7MRCzZQASRHg84K7.Bi', NULL, '2023-04-22 10:35:47', '2023-04-22 10:35:47'),
(54, 'Morte Real Lorena', 'lorena.mr@tec.com.mx', NULL, '$2y$10$Q/t2nwE4gOE38Ix5TzwYmu6L6iOU6MQeQtHSGd8oniPecWKU09wL.', NULL, '2023-04-22 10:36:19', '2023-04-22 10:36:19'),
(55, 'Moreno Rodriguez Jairo Cristopher Hassan', 'cris.hassan.mrj@tec.com.mx', NULL, '$2y$10$pVklZewN3pC3RmmoZ3.1suj4/tSA.GMQTBLIl961rYTVzwkKlSFuK', NULL, '2023-04-22 10:37:38', '2023-04-22 10:37:38'),
(56, 'Narváez García Francisco Javier', 'francisco.javier.ng@tec.com.mx', NULL, '$2y$10$31lx9ipoiJW5vS6A5FkL4.npUwwFF/VCwP4LevUoTzKlQkLLW6E8y', NULL, '2023-04-22 10:38:36', '2023-04-22 10:38:36'),
(57, 'Olvera Pecina Ismael', 'ismael.op@tec.com.mx', NULL, '$2y$10$/I.1Tyry6yXbiOxOINZ7YeOR7PTe1Z59LjTwjP7VOvdXIP52cyorG', NULL, '2023-04-22 10:39:10', '2023-04-22 10:39:10'),
(58, 'Ortiz Valdez Andres Eduardo', 'andres.eduardo.ov@tec.com.mx', NULL, '$2y$10$85kncIodyY/HXEhbBeobd.wkhsn2uLli6W8iuwdaMIwZXBW3ME3PK', NULL, '2023-04-22 10:41:16', '2023-04-22 10:41:16'),
(59, 'Picazo Rodríguez Nallely Guadalupe', 'nallely.guadalupe.pr@tec.com.mx', NULL, '$2y$10$gSq1q2uLTFPCIPtx.VhiUeglyDZQRQEZ6C/LBRgl797L53DhcZ2Q2', NULL, '2023-04-22 10:42:07', '2023-04-22 10:42:07'),
(60, 'Ramos Arellano Juan de Dios', 'juan.ra@tec.com.mx', NULL, '$2y$10$S9Xn5/svzRkD.Pgz309dDeJ/eDDgNsuxpCedrdBaUzB8YGENQcaWq', NULL, '2023-04-22 10:42:49', '2023-04-22 10:42:49'),
(61, 'Razo Vazquez Axel Sebastian', 'ax.sebastian.rv@tec.com.mx', NULL, '$2y$10$B9UEubypUzs7PfC5x63Ose27RsiAquEM0r4r1rYsLUImDisrbJV16', NULL, '2023-04-22 10:44:49', '2023-04-22 10:44:49'),
(62, 'Renteria Avilez Martha Elena', 'martha.elena.ra@tec.com.mx', NULL, '$2y$10$d99Wk46VMUnSWHtCzmjPRu/er57TSMz1SGWUbLvX84n/1I02W0VyK', NULL, '2023-04-22 10:45:36', '2023-04-22 10:45:36'),
(63, 'Riojas Rodríguez Guillermo', 'guillermo.rdgz@tec.com.mx', NULL, '$2y$10$3qmNIlm/1iT12b8vllEdxuJ932Gnv0hnpXAng6LhL9tPPCRyI4Gmi', NULL, '2023-04-22 10:47:18', '2023-04-22 10:47:18'),
(64, 'Riojas Rodríguez Rubén Miguel', 'ruben.miguel.rdgz@tec.com.mx', NULL, '$2y$10$Jok/.lq1H1AmeeOBH1I3cewiPHLQGCw0TjsuQo5EqCA2H1eSS.qWS', NULL, '2023-04-22 10:48:05', '2023-04-22 10:48:05'),
(65, 'Rivas Aguilar Antonio', 'antonio.ra@tec.com.mx', NULL, '$2y$10$MRmPV9tqTGQQek1MbXJ6DuFIqDaaDhFRQlQFiD7hkTuWYeJ2M.Hki', NULL, '2023-04-22 10:49:50', '2023-04-22 10:49:50'),
(66, 'Rodríguez Campos Alejandro', 'alejandro.rc@tec.com.mx', NULL, '$2y$10$xCgzfvp4UkFzgAdpKROGaOzncl9DoqnD9DwJ6iiuQgr/V6tvPyiPe', NULL, '2023-04-22 10:50:35', '2023-04-22 10:50:35'),
(67, 'Rodríguez Campos Claudia', 'claudia.rc@tec.com.mx', NULL, '$2y$10$nyywI1a7ckV9r8RKxdKyjuxoPhN2thX9a.7fH/FemuQpkXXtSUyXK', NULL, '2023-04-22 10:51:20', '2023-04-22 10:51:20'),
(68, 'Romero Peña Jesús Manuel', 'manuel.jesus.rp@tec.com.mx', NULL, '$2y$10$Qrjk8JCKCBCAOb7lJWt5V.vzQ6FwLS8ArtjNXwaQteTwa3VsKLq7m', NULL, '2023-04-22 10:53:54', '2023-04-22 10:53:54'),
(69, 'Salas Torres Luis Horacio', 'luis.horacio.st@tec.com.mx', NULL, '$2y$10$fm5O8bPgtMHKlbnXWgS5C.1eoCwyHeTQNZ5ztq3wLXXPbxCllfCrG', NULL, '2023-04-22 10:54:38', '2023-04-22 10:54:38'),
(70, 'Sánchez Esquivel César', 'cesar.se@tec.com.mx', NULL, '$2y$10$Cd9QIUZmUBQNLSCZBYsuDuox/zrqEvMvUwLzpP.babSHZO3ns7uo.', NULL, '2023-04-22 10:58:05', '2023-04-22 10:58:05'),
(71, 'Sánchez Hernández Raúl de Jesús', 'raul.jesus.sh@tec.com.mx', NULL, '$2y$10$P.0qeZSvcAgxXyAtZm4wbeycXLVsJfhRZF8e4aOk/qK5/gFq8Cagy', NULL, '2023-04-22 10:58:45', '2023-04-22 10:58:45'),
(72, 'Sánchez Montemayor Jesús', 'jesus.sm@tec.com.mx', NULL, '$2y$10$I2gH3NFg39oHJgjtAqRIvewoIZeAdmjTOdKEjjHVwihxHEa.pKFei', NULL, '2023-04-22 10:59:20', '2023-04-22 10:59:20'),
(73, 'Sánchez Uribe Jesus Adolfo', 'jesus.adolf.su@tec.com.mx', NULL, '$2y$10$eeJm8MpAboK4jaVI.R.GcOMREDhZ2lsCj1/6AFc6XwohJGz/7lpJ2', NULL, '2023-04-22 11:00:02', '2023-04-22 11:00:02'),
(74, 'Valadez Zamarron Mayela del Carmen', 'maye.carmen.vz@tec.com.mx', NULL, '$2y$10$o4OfkaD.1AMsSGK7jaNcaOPjTNdq4e905LZHiVQuQVfzivnb4MRii', NULL, '2023-04-22 11:00:34', '2023-04-22 11:00:34'),
(75, 'Zertuche Zuñiga Homero', 'homero.z@tec.com.mx', NULL, '$2y$10$izvLOHkqGn0RIpe.r.J1TucBPZOvH2z5tDGbf80ShJVyUJm4KRSGK', NULL, '2023-04-22 11:01:20', '2023-04-22 11:01:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

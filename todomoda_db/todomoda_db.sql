-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-11-2026 a las 23:56:38
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `todomoda_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `etiqueta` varchar(50) DEFAULT 'NUEVO',
  `color` varchar(20) DEFAULT '#f8dce0',
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `etiqueta`, `color`, `imagen`) VALUES
(1, 'POLVO TRANSLÚCIDO ULTIMATTE POWDER', 18900.00, 'VEGAN', '#f8dce0', 'img/prod1.jpg'),
(2, 'MÁSCARA DE PESTAÑAS FUN PROOF', 12900.00, 'VEGAN', '#d5f0ea', 'img/prod2.jpg'),
(3, 'MÁSCARA DE PESTAÑAS TRANSPARENTE \"LIFELONG BESTIE\" (CLEAR)', 12900.00, 'VEGAN', '#f4d9e2', 'img/prod3.jpg'),
(4, 'MÁSCARA DE PESTAÑAS TRANSPARENTE \"LIFELONG BESTIE\" (PINK)', 12900.00, 'VEGAN', '#f7d6df', 'img/prod4.jpg'),
(5, 'HAIR AND BODY MIST CHERRY', 14900.00, 'JUST DROPPED!', '#fad4d8', 'img/prod5.jpg'),
(6, 'HAIR AND BODY MIST POCKET CHERRY', 12900.00, 'VEGAN', '#f9d6da', 'img/prod6.jpg'),
(7, 'BODY SPLASH SOFT GLAZE ERA', 18000.00, 'NUEVO', '#d4eaf7', 'img/prod7.jpg'),
(8, 'BODY SPLASH BLOOM YOUR OWN WAY', 18000.00, 'NUEVO', '#faf2cc', 'img/prod8.jpg'),
(9, 'LIP GLOSS JUICY SHINE CHERRY', 9900.00, 'VEGAN', '#f6d8e4', 'img/prod9.jpg'),
(10, 'SET DE BROCHAS PASTEL ESSENTIALS', 22500.00, 'BEST SELLER', '#e8def8', 'img/prod10.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `apellido` varchar(80) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `email` varchar(254) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `rol` varchar(20) NOT NULL DEFAULT 'usuario',
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp(),
  `archivado_en` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `dni`, `email`, `password_hash`, `rol`, `creado_en`, `archivado_en`) VALUES
(6, 'Admin', 'Todomoda', '99999999', 'admin@todomoda.com', '$2y$10$xMtdGrIBZxbmmQ5oojx.Vum8kdbtk5y.R4Lmd4jZGam29Z5DRCBAi', 'admin', '2026-11-17 03:26:57', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 25-02-2025 a las 15:16:18
-- Versión del servidor: 8.0.41-0ubuntu0.24.04.1
-- Versión de PHP: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `myweb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_events`
--

CREATE TABLE `tbl_events` (
  `id` int NOT NULL,
  `titol` varchar(255) NOT NULL,
  `descripcio` text NOT NULL,
  `fecha_ini` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `etiquetes` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_events`
--

INSERT INTO `tbl_events` (`id`, `titol`, `descripcio`, `fecha_ini`, `fecha_fin`, `etiquetes`) VALUES
(2, 'Taller de programación', 'Taller sobre nuevas tecnologías en desarrollo de software.', '2023-10-20 14:00:00', '2023-10-20 17:00:00', 'taller;programación;tecnología'),
(3, 'Presentación de resultados', 'Presentación de los resultados del último trimestre.', '2023-10-25 09:00:00', '2023-10-25 10:30:00', 'presentación;resultados;trimestre'),
(4, 'Conferencia de marketing', 'Conferencia sobre tendencias en marketing digital.', '2023-11-01 13:00:00', '2023-11-01 15:00:00', NULL),
(5, 'Fiesta de fin de año', 'Celebración de fin de año con todo el equipo.', '2023-12-15 18:00:00', '2023-12-15 23:59:59', 'fiesta;celebración;fin de año');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuaris`
--

CREATE TABLE `tbl_usuaris` (
  `id` bigint NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `numeroIdent` varchar(15) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `cognoms` varchar(30) NOT NULL,
  `sexe` varchar(4) NOT NULL,
  `naixement` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `adreca` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `codiPostal` varchar(5) DEFAULT NULL,
  `poblacio` varchar(40) DEFAULT NULL,
  `provincia` varchar(40) DEFAULT NULL,
  `telefon` varchar(12) DEFAULT NULL,
  `imatge` varchar(200) DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0' COMMENT ' 0: pendent 1:confirmat 2:administradors',
  `navegador` varchar(50) NOT NULL,
  `plataforma` varchar(50) NOT NULL,
  `dataCreacio` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dataDarrerAcces` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_usuaris`
--

INSERT INTO `tbl_usuaris` (`id`, `email`, `password`, `numeroIdent`, `nom`, `cognoms`, `sexe`, `naixement`, `adreca`, `codiPostal`, `poblacio`, `provincia`, `telefon`, `imatge`, `status`, `navegador`, `plataforma`, `dataCreacio`, `dataDarrerAcces`) VALUES
(6431, 'correo@inventado.com', '1234', 'y2964568c', 'Rafa', 'rafa2', 'Male', '09-09-2005', 'carrer aleatori', '08310', 'barcelona', 'barcelona', '666666666', NULL, 1, 'firefox', 'plataforma', '2025-01-19 21:25:57', '2025-01-19 22:05:29'),
(6433, 'jdds@klfjkf.com', '12345', '2964568', 'raf', '2', 'Male', '2005-09-09', '', '', '', '', '', '', 0, 'Firefox', 'plataforma', '2025-01-19 21:54:35', '2025-01-19 22:05:20'),
(6439, 'jdds@klfjk.com', '12345', 'y2964568c', 'raf', 'raf4', 'Male', '2005-09-09', '', '08310', 'barcelona', 'barcelona', '631725049', '', 0, 'Firefox', 'plataforma', '2025-01-19 22:31:26', '2025-01-19 22:31:26');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_events`
--
ALTER TABLE `tbl_events`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_usuaris`
--
ALTER TABLE `tbl_usuaris`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_events`
--
ALTER TABLE `tbl_events`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_usuaris`
--
ALTER TABLE `tbl_usuaris`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6441;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

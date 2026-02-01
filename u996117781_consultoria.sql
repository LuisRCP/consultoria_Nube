-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 01-02-2026 a las 05:14:20
-- Versión del servidor: 11.8.3-MariaDB-log
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u996117781_consultoria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consulta`
--

CREATE TABLE `consulta` (
  `consulta_id` int(11) NOT NULL,
  `nombre_remitente` varchar(150) NOT NULL,
  `email_remitente` varchar(255) NOT NULL,
  `asunto` varchar(255) DEFAULT NULL,
  `mensaje` text NOT NULL,
  `fecha_creado` datetime DEFAULT current_timestamp(),
  `estado` enum('nueva','revisada','respondida') DEFAULT 'nueva'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `consulta`
--

INSERT INTO `consulta` (`consulta_id`, `nombre_remitente`, `email_remitente`, `asunto`, `mensaje`, `fecha_creado`, `estado`) VALUES
(2, 'Luis PRUEBA', 'luisrobertocarrilloperez@gmail.com', 'PRUEBAS', 'Esto es un mensaje de prueba', '2026-02-01 04:16:49', 'nueva'),
(5, 'Luis Roberto Carrillo Pérez', 'luisrobertocarrilloperez@gmail.com', 'Revisión sobre proyecto en .NET 10', 'qazwsxererd', '2026-02-01 04:49:07', 'nueva'),
(6, 'José Pérez Hernández', 'luisrobertocarrilloperez@gmail.com', 'Revision de Proyecto en PHP', 'Solicito ayuda para revisar unos módulos de un proyecto en CodeIgniter 4 y MySQL', '2026-02-01 04:51:05', 'nueva'),
(7, 'Luis Roberto Carrillo Pérez', 'luisrobertocarrilloperez@gmail.com', 'Consulta sobre precios', 'Quiero saber los precios por consulta', '2026-02-01 04:59:21', 'nueva'),
(8, 'Roberto Carrillo Flores', 'luisrobertocarrilloperez@gmail.com', 'Consulta para ayuda en proyecto', 'Me interesa conocer sus precios para el desarrollo de una pagina web para mostrar información de mi negocio de comida', '2026-02-01 05:02:27', 'nueva');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario_Id` int(11) NOT NULL,
  `username` varchar(25) DEFAULT NULL,
  `clave` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_Id`, `username`, `clave`) VALUES
(1, 'admin', '$2y$10$gcYuagJaXk2m65QSrN27sO92SH/20kbkMd9fv3JRzmxWS34DLSHhK');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `consulta`
--
ALTER TABLE `consulta`
  ADD PRIMARY KEY (`consulta_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `consulta`
--
ALTER TABLE `consulta`
  MODIFY `consulta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

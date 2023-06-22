-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 21-06-2023 a las 00:25:26
-- Versión del servidor: 5.7.39
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `miguel_saime`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pasaportes`
--

CREATE TABLE `pasaportes` (
  `id` int(11) NOT NULL,
  `cedula` varchar(100) NOT NULL,
  `nombres` varchar(200) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `num_pasaporte` int(11) NOT NULL,
  `fecha_emision` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `sexo` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pasaportes`
--

INSERT INTO `pasaportes` (`id`, `cedula`, `nombres`, `fecha_nacimiento`, `num_pasaporte`, `fecha_emision`, `fecha_vencimiento`, `status`, `sexo`, `created_at`) VALUES
(9, '292929', '9292929', '2023-06-11', 1212, '2023-06-04', '2023-06-11', 2, 'Femenino Mayor de Edad', '2023-06-11 19:48:06'),
(10, '292929', '9292929', '2023-06-11', 1212, '2023-06-04', '2023-06-11', 2, 'Masculino Menor de Edad', '2023-06-11 19:48:06'),
(11, '292929', '9292929', '2023-06-11', 1212, '2023-06-04', '2023-06-11', 2, '', '2023-06-11 19:48:06'),
(12, '292929', '9292929', '2023-06-11', 1212, '2023-06-04', '2023-06-11', 3, '', '2023-06-11 19:48:06'),
(13, '292929', '9292929', '2023-06-11', 1212, '2023-06-04', '2023-06-11', 1, '', '2023-06-11 19:48:06'),
(14, '292929', '9292929', '2023-06-11', 1212, '2023-06-04', '2023-06-11', 1, '', '2023-06-11 19:48:06'),
(15, '292929', '9292929', '2023-06-11', 1212, '2023-06-04', '2023-06-11', 1, '', '2023-06-11 19:48:06'),
(16, '292929', '9292929', '2023-06-11', 1212, '2023-06-04', '2023-06-11', 1, '', '2023-06-11 19:48:06'),
(17, '292929', '9292929', '2023-06-11', 1212, '2023-06-04', '2023-06-11', 1, '', '2023-06-11 19:48:06'),
(18, '292929', '9292929', '2023-06-11', 1212, '2023-06-04', '2023-06-11', 1, '', '2023-06-11 19:48:06'),
(19, '292929', '9292929', '2023-06-11', 1212, '2023-06-04', '2023-06-11', 1, '', '2023-06-11 19:48:06'),
(20, '292929', '9292929', '2023-06-11', 1212, '2023-06-04', '2023-06-11', 1, '', '2023-06-11 19:48:06'),
(21, '292929', '9292929', '2023-06-11', 1212, '2023-06-04', '2023-06-11', 1, '', '2023-06-11 19:48:06'),
(22, '292929', '9292929', '2023-06-11', 1212, '2023-06-04', '2023-06-11', 1, '', '2023-06-11 19:48:06'),
(23, '292929', '9292929', '2023-06-11', 1212, '2023-06-04', '2023-06-11', 1, '', '2023-06-11 19:48:06'),
(24, '292929', '9292929', '2023-06-11', 1212, '2023-06-04', '2023-06-11', 1, '', '2023-06-11 19:48:06'),
(25, '292929', '9292929', '2023-06-11', 1212, '2023-06-04', '2023-06-11', 1, '', '2023-06-11 19:48:06'),
(26, '292929', '9292929', '2023-06-11', 1212, '2023-06-04', '2023-06-11', 1, '', '2023-06-11 19:48:06'),
(27, '292929', '9292929', '2023-06-11', 1212, '2023-06-04', '2023-06-11', 1, '', '2023-06-11 19:48:06'),
(28, '292929', '9292929', '2023-06-11', 1212, '2023-06-04', '2023-06-11', 1, '', '2023-06-11 19:48:06'),
(29, '292929', '9292929', '2023-06-11', 1212, '2023-06-04', '2023-06-11', 1, '', '2023-06-11 19:48:06'),
(30, '292929', '9292929', '2023-06-11', 1212, '2023-06-04', '2023-06-11', 1, '', '2023-06-11 19:48:06'),
(31, '292929', '9292929', '2023-06-11', 1212, '2023-06-04', '2023-06-11', 1, '', '2023-06-11 19:48:06'),
(32, '292929', '9292929', '2023-06-11', 1212, '2023-06-04', '2023-06-11', 1, '', '2023-06-11 19:48:06'),
(33, '292929', '9292929', '2023-06-11', 1212, '2023-06-04', '2023-06-11', 1, '', '2023-06-11 19:48:06'),
(34, '292929', '9292929', '2023-06-11', 1212, '2023-06-04', '2023-06-11', 1, '', '2023-06-11 19:48:06'),
(35, '292929', '9292929', '2023-06-11', 1212, '2023-06-04', '2023-06-11', 1, '', '2023-06-11 19:48:06'),
(36, '292929', '9292929', '2023-06-11', 1212, '2023-06-04', '2023-06-11', 1, '', '2023-06-11 19:48:06'),
(37, '292929', '9292929', '2023-06-11', 1212, '2023-06-04', '2023-06-11', 1, '', '2023-06-11 19:48:06'),
(38, '292929', '9292929', '2023-06-11', 1212, '2023-06-04', '2023-06-11', 1, '', '2023-06-11 19:48:06'),
(39, '292929', '9292929', '2023-06-11', 1212, '2023-06-04', '2023-06-11', 1, '', '2023-06-11 19:48:06'),
(40, '292929', '9292929', '2023-06-11', 1212, '2023-06-04', '2023-06-11', 1, '', '2023-06-11 19:48:06'),
(41, 'sasa', 'asasas', '0012-12-12', 212121, '1212-02-12', '0021-12-12', 1, 'Femenino Menor de Edad', '2023-06-17 01:21:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nombres` varchar(200) NOT NULL,
  `apellidos` varchar(200) NOT NULL,
  `usuario` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `pregunta_1` varchar(200) NOT NULL,
  `respuesta_1` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombres`, `apellidos`, `usuario`, `password`, `codigo`, `pregunta_1`, `respuesta_1`, `created_at`) VALUES
(1, 'admin', 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', '123456', 'eres admin?', 'si', '2023-06-10 23:49:40');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pasaportes`
--
ALTER TABLE `pasaportes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pasaportes`
--
ALTER TABLE `pasaportes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-11-2023 a las 03:15:06
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_tpe2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comment` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `id_player` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id_comment`, `comment`, `id_player`) VALUES
(1, 'Este jugador es muy crack', 8),
(2, 'Vino a ganar la copa libertadores', 2),
(3, 'vamoo', 1),
(9, 'Enzo gracias por existir', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id_team` int(11) NOT NULL,
  `name_team` varchar(45) NOT NULL,
  `league` varchar(45) NOT NULL,
  `technical_director` varchar(45) NOT NULL,
  `cups` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id_team`, `name_team`, `league`, `technical_director`, `cups`) VALUES
(1, 'River Plate', 'Argentina', 'Martin Demichelis', 70),
(3, 'Boca Juniors', 'Argentina', 'Jorge Almiron', 73),
(4, 'Independiente', 'Argentina', 'Carlos Tevez', 20),
(6, 'Santamarina', 'Argentina', 'Jorge Izquierdo', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores`
--

CREATE TABLE `jugadores` (
  `id_player` int(11) NOT NULL,
  `name_player` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `age` int(11) NOT NULL,
  `id_team` int(11) NOT NULL,
  `profile_player` varchar(45) NOT NULL,
  `position` varchar(45) NOT NULL,
  `goals` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `jugadores`
--

INSERT INTO `jugadores` (`id_player`, `name_player`, `lastname`, `age`, `id_team`, `profile_player`, `position`, `goals`) VALUES
(1, 'Enzo', 'Perez', 37, 1, 'Diestro', 'Volante', 47),
(2, 'Edison', 'Cavani', 36, 3, 'Derecho', 'Delantero', 381),
(3, 'Ivan', 'Marcone', 33, 4, 'Diestro', 'Centrocampista', 3),
(4, 'Franco', 'Armani', 36, 1, 'Diestro', 'Arquero', 1),
(6, 'Ramiro', 'Funes Mori', 32, 1, 'Izquierda', 'Defensor', 19),
(8, 'Enzo', 'Fernandez', 22, 1, 'Diestro', 'Volante', 0),
(9, 'Dario', 'Benedetto', 33, 3, 'Derecho', 'Delantero', 164),
(10, 'Frank', 'Fabra', 32, 3, 'Derecho', 'Defensor', 19),
(11, 'Alexis', 'Canelo', 31, 4, 'Izquierdo', 'Delantero', 40),
(12, 'Rodrigo', 'Marquez', 21, 4, 'Derecho', 'Extremo', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `user` varchar(25) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `user`, `password`) VALUES
(1, 'webadmin', '$2y$10$Un..KkCCbwRqySpa2hSqBuIwzEXUu9W5gwTJ7JjvY5/JsqO7GnFW.');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `FK_jugadores_comentarios` (`id_player`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id_team`);

--
-- Indices de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD PRIMARY KEY (`id_player`),
  ADD KEY `FK_jugadores_equipos` (`id_team`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id_team` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  MODIFY `id_player` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `FK_jugadores_comentarios` FOREIGN KEY (`id_player`) REFERENCES `jugadores` (`id_player`);

--
-- Filtros para la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD CONSTRAINT `FK_jugadores_equipos` FOREIGN KEY (`id_team`) REFERENCES `equipos` (`id_team`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

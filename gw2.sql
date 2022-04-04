-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-04-2022 a las 12:11:55
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gw2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guild`
--

CREATE TABLE `guild` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `api` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `modifed` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `guild`
--

INSERT INTO `guild` (`id`, `name`, `api`, `created`, `modifed`) VALUES
(1, 'Trolls De Arco Del León', 'C784C2E6-051D-EB11-81A8-CDE2AC1EED30', '2029-03-22 12:22:40', '2029-03-22 12:22:40'),
(2, 'Valkyries Of Orion', '40A4157F-613E-E811-81A1-02A368428674', '2029-03-22 12:22:40', '2029-03-22 12:22:40'),
(3, 'Alumnos De Hoeth', '916E77D9-E4A5-EB11-81A8-F161567B2263', '2029-03-22 12:22:41', '2029-03-22 12:22:41'),
(4, 'Maestro De Hoeth', 'D9BC6C8A-3288-E611-80D3-441EA14F1E40', '2029-03-22 12:22:41', '2029-03-22 12:22:41'),
(5, 'The Ratcave', '3BFC6FEE-9575-E811-81A8-83C7278578E0', '2022-04-01 14:01:30', '2022-04-01 14:01:30'),
(6, 'Wardens Of Destiny', '081E175C-5AF5-430E-AA2F-798226BBF4F7', '2022-04-01 14:01:31', '2022-04-01 14:01:31'),
(7, 'Sin Estabilidad', '3D0C58D0-4A7F-E911-81A8-83C7278578E0', '2022-04-01 14:01:31', '2022-04-01 14:01:31'),
(8, 'Cliffside Immortals', '95969F10-A983-EC11-81B7-AD7CCA945DAC', '2022-04-01 14:01:32', '2022-04-01 14:01:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guild_block`
--

CREATE TABLE `guild_block` (
  `id` int(11) NOT NULL,
  `guild` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `value` text NOT NULL,
  `row` int(11) NOT NULL,
  `column` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modifed` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `guild_block`
--

INSERT INTO `guild_block` (`id`, `guild`, `type`, `value`, `row`, `column`, `created`, `modifed`) VALUES
(1, 4, 'text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 1, 1, '2022-04-03 21:49:24', '2022-04-03 21:49:24'),
(2, 4, 'text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 3, 2, '2022-04-03 21:49:24', '2022-04-03 21:49:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `api` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `last_login` datetime NOT NULL,
  `modifed` datetime NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `name`, `api`, `password`, `last_login`, `modifed`, `created`) VALUES
(1, 'Albert', '688DFABB-B97B-3E42-B07E-640FF87CDF2F9CF33BBE-1E58-4AD7-A54C-CA093F80667C', '8eebc1f74a9966a0ac5b55ff9660a8891a040808618d70cdfd601564df8a0e6f', '2022-04-04 09:24:26', '2029-03-22 12:22:39', '2029-03-22 12:22:39'),
(2, 'Laura', '37F8BFF6-A343-7B41-8237-82C3F77DE3E1C4616424-AFF8-4579-9043-44F929909B91', '8eebc1f74a9966a0ac5b55ff9660a8891a040808618d70cdfd601564df8a0e6f', '2022-04-01 16:06:28', '2029-03-22 12:22:57', '2029-03-22 12:22:57'),
(4, 'Fer', 'FA9FE1E6-ACCB-BB4D-A35A-03180A901AE54281DE76-EB66-496D-9384-038DCB335698', '8eebc1f74a9966a0ac5b55ff9660a8891a040808618d70cdfd601564df8a0e6f', '2022-04-01 14:15:28', '2022-04-01 14:01:30', '2022-04-01 14:01:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_guild`
--

CREATE TABLE `user_guild` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `guild` int(11) NOT NULL,
  `leader` tinyint(4) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user_guild`
--

INSERT INTO `user_guild` (`id`, `user`, `guild`, `leader`, `created`) VALUES
(1, 1, 1, 0, '2029-03-22 12:22:40'),
(2, 1, 2, 0, '2029-03-22 12:22:40'),
(3, 1, 3, 1, '2029-03-22 12:22:41'),
(4, 1, 4, 1, '2029-03-22 12:22:41'),
(5, 2, 4, 1, '2029-03-22 12:22:57'),
(6, 2, 2, 1, '2029-03-22 12:22:57'),
(7, 2, 3, 1, '2029-03-22 12:22:57'),
(8, 4, 5, 0, '2022-04-01 14:01:30'),
(9, 4, 6, 0, '2022-04-01 14:01:31'),
(10, 4, 7, 0, '2022-04-01 14:01:31'),
(11, 4, 8, 0, '2022-04-01 14:01:32'),
(12, 4, 4, 0, '2022-04-01 14:01:32');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `guild`
--
ALTER TABLE `guild`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `guild_block`
--
ALTER TABLE `guild_block`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user_guild`
--
ALTER TABLE `user_guild`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `guild`
--
ALTER TABLE `guild`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `guild_block`
--
ALTER TABLE `guild_block`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `user_guild`
--
ALTER TABLE `user_guild`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

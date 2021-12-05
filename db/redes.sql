-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-12-2021 a las 23:19:25
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `redes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adminsevento`
--

CREATE TABLE `adminsevento` (
  `idAdmin` int(10) NOT NULL,
  `idEvento` int(10) DEFAULT NULL,
  `idUsuario` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `id_evento` int(10) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `fecha` date NOT NULL,
  `lugar` varchar(100) DEFAULT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `ubicacion_Media` varchar(150) DEFAULT NULL,
  `hashtag` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invitadosevento`
--

CREATE TABLE `invitadosevento` (
  `idInvitado` int(10) NOT NULL,
  `idEvento` int(10) DEFAULT NULL,
  `idUsuario` int(10) DEFAULT NULL,
  `boletos` int(10) DEFAULT NULL,
  `boletosConfirmados` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `fecha_nacimiento` varchar(30) DEFAULT NULL,
  `correo` varchar(30) DEFAULT NULL,
  `contrasena` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `fecha_nacimiento`, `correo`, `contrasena`) VALUES
(2, 'John', 'Benson', '2021-11-29', 'johnbenson@empresa.com', '4d186321c1a7f0f354'),
(3, 'Lisa', 'Anderson', '2021-11-29', 'lisa@hello.com', '4d186321c1a7f0f354'),
(4, 'Kyle', 'Green', '2021-12-21', 'green@empresa.com', '4d186321c1a7f0f354'),
(5, 'John', 'Adams', '2021-11-15', 'john@something.com', '4d186321c1a7f0f354'),
(6, 'Anthony', 'Bennett', '2021-08-11', 'tony@happy.com', '4d186321c1a7f0f354'),
(7, 'Luis', 'Lopez', '2021-12-06', 'luislopez@empresa.com', '4d186321c1a7f0f354'),
(8, 'Julio', 'Campos', '2021-12-01', 'julio@empresa.com', '6228e72c78f1a20ef3286f3c108be1'),
(10, 'Daniel', 'Mares Esparza', '2021-11-29', 'danielmares32@gmail.com', '4d186321c1a7f0f354b297e8914ab240');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adminsevento`
--
ALTER TABLE `adminsevento`
  ADD PRIMARY KEY (`idAdmin`),
  ADD KEY `FK_ADMINS_EVENTO` (`idEvento`),
  ADD KEY `FK_ADMINS_USUARIO` (`idUsuario`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id_evento`);

--
-- Indices de la tabla `invitadosevento`
--
ALTER TABLE `invitadosevento`
  ADD PRIMARY KEY (`idInvitado`),
  ADD KEY `FK_INVITADOS_EVENTOS` (`idEvento`),
  ADD KEY `FK_INVITADOS_USUARIO` (`idUsuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `adminsevento`
--
ALTER TABLE `adminsevento`
  MODIFY `idAdmin` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `id_evento` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `invitadosevento`
--
ALTER TABLE `invitadosevento`
  MODIFY `idInvitado` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `adminsevento`
--
ALTER TABLE `adminsevento`
  ADD CONSTRAINT `FK_ADMINS_EVENTO` FOREIGN KEY (`idEvento`) REFERENCES `evento` (`id_evento`),
  ADD CONSTRAINT `FK_ADMINS_USUARIO` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `invitadosevento`
--
ALTER TABLE `invitadosevento`
  ADD CONSTRAINT `FK_INVITADOS_EVENTOS` FOREIGN KEY (`idEvento`) REFERENCES `evento` (`id_evento`),
  ADD CONSTRAINT `FK_INVITADOS_USUARIO` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

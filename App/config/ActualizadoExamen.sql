-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-06-2023 a las 17:58:32
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `correo_electronico_practica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id` int(11) NOT NULL,
  `cuerpo` text DEFAULT NULL,
  `destinatario_id` int(11) NOT NULL,
  `propietario_id` int(11) NOT NULL,
  `asunto` varchar(255) NOT NULL DEFAULT '0',
  `fecha` datetime NOT NULL,
  `visto` bit(1) NOT NULL DEFAULT b'0',
  `Reference` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Mensajes que se enviaran los usuarios entre ellos.';

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id`, `cuerpo`, `destinatario_id`, `propietario_id`, `asunto`, `fecha`, `visto`, `Reference`, `type`) VALUES
(1, NULL, 7, 8, 'Primer mensaje', '2023-06-10 00:00:00', b'1', 1, 'sended'),
(2, NULL, 7, 8, 'Mensaje 2', '2023-06-13 00:00:00', b'0', NULL, 'sended'),
(3, NULL, 7, 7, 'Yo mismo', '2023-06-12 00:00:00', b'0', NULL, 'sended'),
(4, NULL, 8, 8, 'Hola de nuevo yo mismo', '2023-06-11 00:00:03', b'1', NULL, 'sended'),
(5, 'TExto 1', 8, 8, 'mensaje 2', '2023-06-11 00:00:00', b'1', NULL, 'sended'),
(6, 'Quiero que realizes la entrega de la tarea 1', 8, 7, 'Entrega Tarea 1', '2023-06-11 00:00:00', b'1', NULL, 'sended'),
(7, '<fhgth', 7, 7, '<ath<ateh', '2023-06-11 00:00:00', b'1', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL COMMENT 'Nombre del cominio a usar para el correo',
  `contraseña` varchar(255) NOT NULL,
  `edat` int(11) UNSIGNED NOT NULL,
  `nivel` int(11) UNSIGNED NOT NULL,
  `codigoFA` varchar(255) DEFAULT NULL,
  `activeFA` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Usuarios que estan autenticados o disponen de una cuenta para usar el correo electronico.';

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombre`, `apellido`, `mail`, `contraseña`, `edat`, `nivel`, `codigoFA`, `activeFA`) VALUES
(16, 'aa', 'aaa', 'aaa@dmail.com', '$2y$10$VD0fkHjxMek98Ad/4iqkSuwyLH6uHf6SpelbSNse6TgJLJABeqg1e', 0, 0, 'WKDINSMJ4OLY442C', b'0'),
(14, 'admin', 'inistrador', 'admin@dmail.com', '$2y$10$I30RJoiuSzf3aYNAO4wnJezvsD5.ZtIqt0d8OUm394uQmKds9GGmO', 32, 10, NULL, NULL),
(8, 'Denis22', 'Lazarian', 'denislaza22@dmail.com', '$2y$10$CTRLMKmNNA3yt3WNkW/uVOO85XjSTDSlWm/TTmkfvkHGT6m7H2XbW', 0, 0, NULL, NULL),
(7, 'Denis', 'lazarian', 'denislaza@dmail.com', '$2y$10$tWBAU/UrJtxTOKxB2ErLVelBVJ4aBxC3XtpCYvd.ht03Ci/Ey8O2u', 0, 5, NULL, NULL),
(11, 'Pedro', 'Picapiedra', 'PPicapiedra@dmail.com', '$2y$10$f7CDeFHzw2nNMGW.Y0MTme9lYyXp/OonEjQIk2RSqcjbSSbDrqs6K', 33, 8, NULL, NULL),
(15, 're', 'porter1', 'reporter1@dmail.com', '$2y$10$hWyrPzDU55AuYeEd7fjmZu6WUItFqjWHiaM04D8RU7OWYsaCAxT6C', 22, 6, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD KEY `FK_mensajes_users` (`destinatario_id`),
  ADD KEY `FK_mensajes_users_2` (`propietario_id`),
  ADD KEY `id` (`id`,`destinatario_id`,`propietario_id`,`Reference`) USING BTREE,
  ADD KEY `FK_mensajes_mensajes` (`Reference`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `mail` (`mail`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `FK_mensajes_mensajes` FOREIGN KEY (`Reference`) REFERENCES `mensajes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_mensajes_users` FOREIGN KEY (`destinatario_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_mensajes_users_2` FOREIGN KEY (`propietario_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

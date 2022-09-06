-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-06-2022 a las 19:41:15
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `websas_database`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `proname` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id`, `proname`, `amount`, `time`) VALUES
(108, 'PHP 7', '10', '2020-05-25 01:16:56'),
(110, 'Python', '10', '2020-05-25 01:46:15'),
(111, 'Vanilla Java Script', '12', '2020-07-13 19:33:49'),
(113, 'tp-r', '5', '2022-05-19 22:44:07'),
(114, 'tp-roter', '1', '2022-05-19 22:46:08'),
(115, 'modem', '10', '2022-05-19 22:47:50'),
(116, 'sidi', '5', '2022-05-19 23:41:40'),
(117, 'cables utp', '6', '2022-05-19 23:57:19'),
(118, 'conector', '2', '2022-05-20 00:08:38'),
(119, 'xbox', '2', '2022-05-20 01:32:18'),
(120, 'Switch cisco', '6', '2022-05-23 21:45:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`) VALUES
(1, 'sergio@prueba.com', 'Sergio', '$2y$10$6kmmVaH8b5FKdaQm8ReAgeyletKPnpB4yNgKy67jnyR2oBIMMO.cO'),
(2, 'sergio@prueba.com', 'Sergio', '$2y$10$Yh.LomYNIQX06Ask2hz.Wu1B/IjbowwgFfcwc6Vutx4DeCiJ5ZK62'),
(3, 'daniel@prueba.com', 'daniel', '$2y$10$XoxUfVyeRpN04J4NkJEoLeaN.eYrP9pxK5yUOMB2de1KEqYjQEeLC'),
(4, 'dan@hotmail.com', 'dan', '$2y$10$KMLPgFbZ7CBFjmo.OjojxuP.b9uiH/vsRXHTXx3XFybfmAnfUYe9m'),
(5, 'dann@hotmail.com', 'dann', '$2y$10$9aqrGLIly4kKFspghlgQ3OEBGE4BSNpb90bTpWxdaAautT3v7Y6ZW'),
(6, 'adrian@prueba.com', 'Adrian', '$2y$10$6WjXpy5tdBJwzxJIwl9OJumaoCzPrCGPillA/8hMzIxJkVDpawJQ.'),
(7, 'a@a.com', 'a', '$2y$10$lL3iw8fkRkMHXel60CEjN.piXUZYrLmsrfN0N7uUxhU8J.8gD5BWO'),
(8, 'correo', 'correo', '$2y$10$OtqCzqahQfHzfiLAqJAI1ukS5MWsC6HA4VTJBeuRILJKqNOlACv46'),
(9, 'usuario1@prueba.com', 'Usuario1', '$2y$10$EHSLMG79oHMJpFal.7S/4eyvWC7fcZkDPVWQaTODrKB.LzQcCU9LS');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
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
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

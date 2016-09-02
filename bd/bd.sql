-- phpMyAdmin SQL Dump
-- version 4.2.8
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 02-09-2016 a las 21:49:40
-- Versión del servidor: 10.0.23-MariaDB
-- Versión de PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `leash`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `slugs`
--

CREATE TABLE IF NOT EXISTS `slugs` (
`id` int(11) NOT NULL,
  `slug` varchar(9) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stats`
--

CREATE TABLE IF NOT EXISTS `stats` (
`id` int(11) NOT NULL,
  `browser` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `slugs`
--
ALTER TABLE `slugs`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `stats`
--
ALTER TABLE `stats`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `slugs`
--
ALTER TABLE `slugs`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT de la tabla `stats`
--
ALTER TABLE `stats`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

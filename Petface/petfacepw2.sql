-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-05-2017 a las 22:58:54
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `petfacepw2`
--
CREATE DATABASE IF NOT EXISTS `petfacepw2` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `petfacepw2`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id` int(11) NOT NULL,
  `idPublicacion` int(11) NOT NULL,
  `comentario` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id`, `estado`) VALUES
(1, 'ninguno'),
(2, 'perdido'),
(3, 'en adopcion'),
(4, 'preñada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascota`
--

CREATE TABLE `mascota` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `idTipo` int(11) NOT NULL,
  `idRaza` int(11) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `fechaNacimiento` varchar(10) NOT NULL,
  `edad` int(11) DEFAULT NULL,
  `imagen` varchar(100) NOT NULL,
  `idEstado` int(11) NOT NULL DEFAULT '1',
  `fechaRegistro` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mascota`
--

INSERT INTO `mascota` (`id`, `idUsuario`, `nombre`, `idTipo`, `idRaza`, `sexo`, `fechaNacimiento`, `edad`, `imagen`, `idEstado`, `fechaRegistro`) VALUES
(1, 12, 'pipo', 1, 6, 'H', '2017-05-04', 0, '', 1, '2017-05-26'),
(2, 12, 'fufu', 1, 5, 'M', '2015-10-15', 0, '', 1, '2017-05-26'),
(3, 12, 'mishu', 2, 10, 'H', '2011-11-18', 0, '', 1, '2017-05-26'),
(4, 13, 'ruperto', 3, 13, 'H', '2016-05-06', 0, '', 1, '2017-05-26'),
(10, 12, 'vvwww', 2, 9, 'H', '2017-05-06', 0, 'Imagen Mascota/', 1, '2017-05-27'),
(11, 12, 'pp', 2, 8, 'M', '2017-05-05', 0, 'Imagen Mascota/Chrysanthemum.jpg', 1, '2017-05-27'),
(12, 14, 'c', 2, 9, 'H', '2017-05-04', 0, 'Imagen Mascota/Desert.jpg', 1, '2017-05-27'),
(13, 15, 'chofa', 3, 13, 'M', '2017-05-06', 0, 'Imagen Mascota/Penguins.jpg', 1, '2017-05-27'),
(14, 17, 'pipo', 1, 4, 'M', '2017-05-11', 0, 'Imagen Mascota/Koala.jpg', 1, '2017-05-28'),
(15, 17, 'chofa', 2, 9, 'H', '2017-05-07', 0, 'Imagen Mascota/Desert.jpg', 1, '2017-05-28'),
(16, 14, 'pp', 2, 8, 'M', '2017-05-01', 0, 'Imagen Mascota/Lighthouse.jpg', 1, '2017-05-28'),
(17, 18, 'chofa', 2, 10, 'M', '2017-05-05', 0, 'Imagen Mascota/Chrysanthemum.jpg', 1, '2017-05-28'),
(18, 18, 'bcbhg', 3, 13, 'M', '2017-05-01', 0, 'Imagen Mascota/Penguins.jpg', 1, '2017-05-28'),
(19, 19, 'lili', 1, 5, 'H', '2010-11-11', 0, 'Imagen Mascota/18622518_528209870863821_4978525411435578634_n.png', 1, '2017-05-29'),
(20, 19, 'nacho', 1, 4, 'M', '2010-05-05', 0, 'Imagen Mascota/21565.png', 1, '2017-05-29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prueba`
--

CREATE TABLE `prueba` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `prueba`
--

INSERT INTO `prueba` (`id`, `date`) VALUES
(11, '2017-05-22'),
(12, '2017-04-05'),
(13, '2017-04-05'),
(14, '2014-03-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacion`
--

CREATE TABLE `publicacion` (
  `id` int(11) NOT NULL,
  `idMascota` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `texto` varchar(200) NOT NULL,
  `pathImagen` varchar(50) DEFAULT NULL,
  `pathVideo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `publicacion`
--

INSERT INTO `publicacion` (`id`, `idMascota`, `likes`, `texto`, `pathImagen`, `pathVideo`) VALUES
(5, 0, 0, 'lalala', 'Imagen Publicacion/Chrysanthemum.jpg', ''),
(6, 0, 0, 'ss', 'Imagen Publicacion/Koala.jpg', ''),
(7, 0, 0, 'qqq', 'Imagen Publicacion/Chrysanthemum.jpg', ''),
(8, 0, 0, 'fsd', 'Imagen Publicacion/Desert.jpg', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `raza`
--

CREATE TABLE `raza` (
  `id` int(11) NOT NULL,
  `idTipo` int(11) NOT NULL,
  `raza` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `raza`
--

INSERT INTO `raza` (`id`, `idTipo`, `raza`) VALUES
(1, 1, 'Afgano'),
(2, 1, 'Beagle'),
(3, 1, 'Bull Terrier'),
(4, 1, 'Corgi'),
(5, 1, 'Chihuahua'),
(6, 1, 'Golden Retriever	'),
(7, 1, 'Shiba'),
(8, 2, 'Abisinio'),
(9, 2, 'Burmes'),
(10, 2, 'Chausie'),
(11, 2, 'Persa'),
(12, 2, 'Siamese'),
(13, 3, 'canario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguidor`
--

CREATE TABLE `seguidor` (
  `idUsuario` int(11) NOT NULL,
  `idMascota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `id` int(11) NOT NULL,
  `tipo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`id`, `tipo`) VALUES
(1, 'perro'),
(2, 'gato'),
(3, 'pajaro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `password` varchar(30) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `localidad` varchar(30) DEFAULT NULL,
  `fechaNacimiento` date NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `fechaRegistro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `mail`, `password`, `nombre`, `localidad`, `fechaNacimiento`, `sexo`, `imagen`, `telefono`, `fechaRegistro`) VALUES
(12, 'karen@hotmail.com', 'k', 'karen', '', '1994-01-22', 'F', '', '44445555', '2017-05-25'),
(13, 'ariel_rando@hotmail.com.ar', 'yuyu', 'gabriel rando', '', '1992-03-29', 'M', '', '44444444', '2017-05-26'),
(14, 'karem1994@hotmail.com', '1', 'Lala', '', '2017-05-25', 'M', 'Imagen Usuario/Tulips.jpg', '324', '2017-05-27'),
(15, 'prueba@prueba', '1', 'Prueba', '', '2017-05-29', 'F', 'Imagen Usuario/Chrysanthemum.jpg', '2424', '2017-05-27'),
(16, 'prueba2@hotmail.com', '1', 'Prueba2', '', '2017-05-31', 'M', 'Imagen Usuario/Desert.jpg', '25', '2017-05-27'),
(17, 'ariel_rando@hotmail.com', 'g', 'gabriel', '', '1992-03-31', 'M', 'Imagen Usuario/Penguins.jpg', '44445555', '2017-05-28'),
(18, 'm@m', '1', 'kfds', '', '2017-05-31', 'M', 'Imagen Usuario/Hydrangeas.jpg', '235', '2017-05-28'),
(19, 'gr_reanimation@hotmail.com', '1', 'gr', '', '1995-02-16', 'M', 'Imagen Usuario/18813584_1343304145777518_862275814274565492_n.jpg', '55556666', '2017-05-29');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mascota_idUsuario-usuario_id` (`idUsuario`),
  ADD KEY `mascota_idTipo-tipo_id` (`idTipo`),
  ADD KEY `mascota_idRaza-raza_id` (`idRaza`);

--
-- Indices de la tabla `prueba`
--
ALTER TABLE `prueba`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `publicacion`
--
ALTER TABLE `publicacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `raza`
--
ALTER TABLE `raza`
  ADD PRIMARY KEY (`id`),
  ADD KEY `raza_idTipo-tipo_id` (`idTipo`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `mascota`
--
ALTER TABLE `mascota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `prueba`
--
ALTER TABLE `prueba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `publicacion`
--
ALTER TABLE `publicacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `raza`
--
ALTER TABLE `raza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD CONSTRAINT `mascota_idRaza-raza_id` FOREIGN KEY (`idRaza`) REFERENCES `raza` (`id`),
  ADD CONSTRAINT `mascota_idTipo-tipo_id` FOREIGN KEY (`idTipo`) REFERENCES `tipo` (`id`),
  ADD CONSTRAINT `mascota_idUsuario-usuario_id` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `raza`
--
ALTER TABLE `raza`
  ADD CONSTRAINT `raza_idTipo-tipo_id` FOREIGN KEY (`idTipo`) REFERENCES `tipo` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

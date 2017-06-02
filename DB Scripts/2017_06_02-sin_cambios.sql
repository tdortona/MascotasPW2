-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-06-2017 a las 08:25:17
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
(1, 1, 'tito', 1, 6, 'M', '2008-03-07', 0, 'Imagen Mascota/koala-windows-7-vista-and-xp-picks-27753235-500-375.jpg', 1, '2017-05-31'),
(2, 2, 'pipo', 1, 5, 'H', '2009-04-18', 0, 'Imagen Mascota/18622518_528209870863821_4978525411435578634_n.png', 1, '2017-05-31'),
(3, 1, 'adolfo', 3, 13, 'H', '2012-03-16', 0, 'Imagen Mascota/patitas 2.png', 1, '2017-06-02');

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
  `pathVideo` varchar(50) DEFAULT NULL,
  `fechaPublicacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `publicacion`
--

INSERT INTO `publicacion` (`id`, `idMascota`, `likes`, `texto`, `pathImagen`, `pathVideo`, `fechaPublicacion`) VALUES
(1, 2, 0, 'que linda es la vida!!!!', 'Imagen Publicacion/', '', '2017-05-31 15:25:44'),
(2, 2, 0, 'aguante river!!!!', 'Imagen Publicacion/', '', '2017-05-31 15:25:49'),
(3, 1, 0, 'lalilulelo', 'Imagen Publicacion/', '', '2017-05-31 15:26:40'),
(4, 1, 0, 'fuma faso', 'Imagen Publicacion/', '', '2017-05-31 15:26:47'),
(5, 2, 0, 'linda noche ', 'Imagen Publicacion/DArg0xSXUAEqpEI.jpg', '', '2017-06-02 03:07:49');

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

--
-- Volcado de datos para la tabla `seguidor`
--

INSERT INTO `seguidor` (`idUsuario`, `idMascota`) VALUES
(1, 2);

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
(1, 'ariel_rando@hotmail.com.ar', 'e', 'gabriel rando', '', '2003-04-04', 'M', 'Imagen Usuario/3E2.jpg', '44445555', '2017-05-31'),
(2, 'karen@hotmail.com', 'k', 'karen', '', '2011-05-04', 'F', 'Imagen Usuario/mqdefault.jpg', '44444444', '2017-05-31');

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
-- Indices de la tabla `seguidor`
--
ALTER TABLE `seguidor`
  ADD KEY `seguidor_idUsuario-usuario_id` (`idUsuario`),
  ADD KEY `seguidor_idMascota-mascota_id` (`idMascota`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `prueba`
--
ALTER TABLE `prueba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `publicacion`
--
ALTER TABLE `publicacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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

--
-- Filtros para la tabla `seguidor`
--
ALTER TABLE `seguidor`
  ADD CONSTRAINT `seguidor_idMascota-mascota_id` FOREIGN KEY (`idMascota`) REFERENCES `mascota` (`id`),
  ADD CONSTRAINT `seguidor_idUsuario-usuario_id` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

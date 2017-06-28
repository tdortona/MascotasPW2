-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-06-2017 a las 22:32:23
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
(1, 'en casa'),
(2, 'perdido'),
(3, 'en adopcion'),
(4, 'embarazada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_estado`
--

CREATE TABLE `historial_estado` (
  `id` int(30) NOT NULL,
  `idMascota` int(30) NOT NULL,
  `idEstado` int(30) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `fechaRegistro` varchar(10) NOT NULL,
  `busqueda_pareja` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mascota`
--

INSERT INTO `mascota` (`id`, `idUsuario`, `nombre`, `idTipo`, `idRaza`, `sexo`, `fechaNacimiento`, `edad`, `imagen`, `idEstado`, `fechaRegistro`, `busqueda_pareja`) VALUES
(1, 21, 'hdf', 3, 13, 'H', '2017-06-01', 0, 'Imagen Mascota/2017-06-26PerfilMascota59516149e08b48.54594973image.jpeg', 1, '2017-06-26', 0),
(2, 25, 'tygf', 2, 9, 'M', '2017-06-02', 0, 'Imagen Mascota/2017-06-26PerfilMascota595161663b4fc3.85597604image.jpeg', 1, '2017-06-26', 0),
(3, 27, 'vxvdfs', 1, 2, 'M', '2017-06-03', 0, 'Imagen Mascota/2017-06-26PerfilMascota595161938733d2.37570432image.jpeg', 1, '2017-06-26', 0),
(4, 28, 'rusia', 3, 13, 'H', '2000-06-02', 17, 'Imagen Mascota/2017-06-26PerfilMascota595162ba23ae28.04856270image.jpeg', 1, '2017-06-26', 0),
(5, 28, 'fffffff', 3, 13, 'H', '2017-06-02', 0, 'Imagen Mascota/2017-06-26PerfilMascota595162dacd9c53.13420790image.jpeg', 1, '2017-06-26', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `id` int(30) NOT NULL,
  `idUsuario` int(30) NOT NULL,
  `mensaje` varchar(300) NOT NULL,
  `idRemitente` int(30) DEFAULT NULL,
  `fechaMensaje` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacion`
--

CREATE TABLE `publicacion` (
  `id` int(11) NOT NULL,
  `idMascota` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `texto` varchar(200) NOT NULL,
  `pathImagen` varchar(200) DEFAULT NULL,
  `pathVideo` varchar(200) DEFAULT NULL,
  `fechaPublicacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `publicacion`
--

INSERT INTO `publicacion` (`id`, `idMascota`, `likes`, `texto`, `pathImagen`, `pathVideo`, `fechaPublicacion`) VALUES
(1, 1, 0, 'hdf se ha unido a PetFace!', '', '', '2017-06-26 16:32:26'),
(2, 2, 0, 'tygf se ha unido a PetFace!', '', '', '2017-06-26 16:32:54'),
(3, 3, 0, 'vxvdfs se ha unido a PetFace!', '', '', '2017-06-26 16:33:39'),
(4, 4, 0, 'rusia se ha unido a PetFace!', '', '', '2017-06-26 16:38:34'),
(5, 5, 0, 'fffffff se ha unido a PetFace!', '', '', '2017-06-26 16:39:06');

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
  `password` varchar(35) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `fechaRegistro` date NOT NULL,
  `mensaje` tinyint(1) NOT NULL,
  `Ubicacion` varchar(300) NOT NULL,
  `latitud` double NOT NULL,
  `longitud` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `mail`, `password`, `nombre`, `fechaNacimiento`, `sexo`, `imagen`, `telefono`, `fechaRegistro`, `mensaje`, `Ubicacion`, `latitud`, `longitud`) VALUES
(20, 'ariel_rando@hotmail.com.ar', '3a3ea00cfc35332cedf6e5e9a32e94da', 'Ariel Rando', '1998-06-04', 'F', 'Imagen Usuario/2017-06-26PerfilUsuario5950a664181eb9.75896297image.jpeg', '46904970', '2017-06-26', 0, 'ñé', -34.702529999691315, -58.616600185632706),
(21, 'karen@hotmail.com', '8ce4b16b22b58894aa86c421e8759df3', 'karen', '2009-06-04', 'M', 'Imagen Usuario/2017-06-26PerfilUsuario5950a7c47c8845.64637998image.jpeg', '66667777', '2017-06-26', 0, '', -34.603762467098434, -58.38299185037613),
(22, 'lula@hotmail.com', '2db95e8e1a9267b7a1188556b2013b33', 'lula', '2017-06-01', 'M', 'Imagen Usuario/2017-06-26PerfilUsuario5950a815c20765.81632661image.jpeg', '7777', '2017-06-26', 0, '', -34.60361344534096, -58.38251709938049),
(23, 'pepo@hotmail.com', '83878c91171338902e0fe0fb97a8c47a', 'lula', '2017-06-01', 'F', 'Imagen Usuario/2017-06-26PerfilUsuario5950a9ba1188f0.80371828image.jpeg', '888', '2017-06-26', 0, 'Av. Corrientes 1202-1204, C1043AAZ CABA, Argentina', -34.60386071047846, -58.38378310203552),
(24, 'fsdfsfd@hotmail.com', '8fa14cdd754f91cc6554c9e71929cce7', 'fernando', '2017-06-01', 'F', 'Imagen Usuario/2017-06-26PerfilUsuario59515b375d2311.83636490image.png', '46904970', '2017-06-26', 0, 'Nuevo Banco Italiano, Buenos Aires, Argentina', -34.6037724015853, -58.3824098110199),
(25, 'tito@hotmail.com', 'e358efa489f58062f10dd7316b65649e', 'tito', '2017-06-02', 'F', 'Imagen Usuario/2017-06-26PerfilUsuario59515b7b4a0724.59344108image.png', '66667777', '2017-06-26', 0, 'Av. MaipÃº 290-300, Vicente LÃ³pez, Buenos Aires, Argentina', -34.53543292759348, -58.4776496887207),
(26, 'hghg@hotmail.com', '2510c39011c5be704182423e3a695e91', 'hghg', '1999-06-04', 'F', 'Imagen Usuario/2017-06-26PerfilUsuario59515bce4067d1.53527210image.jpeg', '7777', '2017-06-26', 0, 'Augusto Roa Bastos 441, AsunciÃ³n, Paraguay', -25.283643879245876, -57.580493688583374),
(27, 'zaneputo@zaneputo.zane.puto', 'fbade9e36a3f36d3d676c1b808451dd7', 'zaneputo', '1999-06-04', 'F', 'Imagen Usuario/2017-06-26PerfilUsuario59515c55b42412.12092826image.jpeg', '66667777', '2017-06-26', 0, 'RamÃ³n Lista 1500-1598, B1755EJL Rafael Castillo, Buenos Aires, Argentina', -34.7033780377135, -58.61752152442932),
(28, 'm@m.m', '6f8f57715090da2632453988d9a1501b', 'm', '2017-06-01', 'F', 'Imagen Usuario/2017-06-26PerfilUsuario59516299b41df2.41140625image.png', '888', '2017-06-26', 0, 'Teatralnyy pr-d, Moskva, Rusia, 125009', 55.75858515633804, 37.61849641799927);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historial_estado`
--
ALTER TABLE `historial_estado`
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
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUsuario` (`idUsuario`);

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
-- AUTO_INCREMENT de la tabla `historial_estado`
--
ALTER TABLE `historial_estado`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `mascota`
--
ALTER TABLE `mascota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
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
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `mensaje_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `mensaje_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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

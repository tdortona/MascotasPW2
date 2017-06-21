-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-06-2017 a las 21:18:06
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `petfacepw2`
--

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
(3, 3, 'fufu', 2, 11, 'H', '2017-06-01', 0, 'Imagen Mascota/2017-06-15PerfilUsuario5941c7f75b6f51.24097582image.jpeg', 1, '2017-06-15'),
(4, 3, 'ermeregildo', 1, 7, 'M', '2015-06-04', 0, 'Imagen Mascota/2017-06-15PerfilUsuario5941f8f4cda9b5.67491819image.jpeg', 1, '2017-06-15'),
(5, 3, 'pepo', 1, 1, 'M', '2017-06-01', 0, 'Imagen Mascota/2017-06-15PerfilUsuario5942df768cf5f8.76781067image.jpeg', 1, '2017-06-15'),
(6, 4, 'pipo', 1, 2, 'M', '2017-06-01', 0, 'Imagen Mascota/2017-06-19PerfilMascota59485be3671112.89121633image.jpeg', 1, '2017-06-19'),
(7, 14, 'chofa', 1, 2, 'H', '2017-06-01', 0, 'Imagen Mascota/2017-06-20PerfilMascota5949598adb0520.53285515image.jpeg', 1, '2017-06-20'),
(8, 14, 'Coraje', 3, 13, 'M', '2017-06-01', 0, 'Imagen Mascota/2017-06-20PerfilMascota59498da26cda05.51933228image.jpeg', 1, '2017-06-20'),
(9, 15, 'Lolo', 3, 13, 'M', '2017-06-01', 0, 'Imagen Mascota/2017-06-21PerfilMascota594abd0594f764.92380223image.jpeg', 1, '2017-06-21');

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

--
-- Volcado de datos para la tabla `mensaje`
--

INSERT INTO `mensaje` (`id`, `idUsuario`, `mensaje`, `idRemitente`, `fechaMensaje`) VALUES
(26, 3, 'lalala', 14, '2017-06-21 02:41:56'),
(27, 3, 'p,lpkkmp\r\n', 14, '2017-06-21 04:37:38'),
(29, 15, 'Chau', 15, '2017-06-21 20:44:48');

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
(6, 3, 0, 'fe', '', '', '2017-06-14 20:43:58'),
(7, 4, 0, 'hghfgh', '', '', '2017-06-16 03:40:44'),
(8, 5, 0, 'kjgjjfhy', '', '', '2017-06-16 03:40:51'),
(9, 4, 0, 'hhhhhhhh', '', '', '2017-06-16 03:40:59'),
(10, 6, 0, 'pipo se ha unido a PetFace!', '', '', '2017-06-19 20:18:59'),
(11, 7, 0, 'chofa se ha unido a PetFace!', '', '', '2017-06-20 14:21:14'),
(12, 8, 0, 'Coraje se ha unido a PetFace!', '', '', '2017-06-20 18:03:30'),
(13, 9, 0, 'Lolo se ha unido a PetFace!', '', '', '2017-06-21 15:37:57');

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
(4, 5),
(4, 3),
(3, 6);

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
  `localidad` varchar(30) DEFAULT NULL,
  `fechaNacimiento` date NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `fechaRegistro` date NOT NULL,
  `mensaje` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `mail`, `password`, `nombre`, `localidad`, `fechaNacimiento`, `sexo`, `imagen`, `telefono`, `fechaRegistro`, `mensaje`) VALUES
(3, 'ariel_rando@hotmail.com.ar', 'e', 'Ariel Rando', '', '1979-06-08', 'M', 'Imagen Usuario/2017-06-15PerfilUsuario5941c7c76154f3.07946549image.jpeg', '46904970', '2017-06-15', 1),
(4, 'karen@hotmail.com', 'k', 'karen', '', '2010-06-03', 'F', 'Imagen Usuario/2017-06-16PerfilUsuario59438161d76388.99341331image.png', '44446666', '2017-06-16', 0),
(5, 'lala@lala', 'lala', 'lala', '', '2017-06-29', 'M', 'Imagen Usuario/2017-06-20PerfilUsuario5948913bd42c46.41448357image.png', '21', '2017-06-20', 0),
(6, 'ee@ee', '5a5740afef05491f7427f521761187', 'ee', '', '2017-06-28', 'M', 'Imagen Usuario/2017-06-20PerfilUsuario594891d9982bb4.53591817image.jpeg', '22', '2017-06-20', 0),
(7, 'a@a', 'd7afde3e7059cd0a0fe09eec4b0008', 'a@a', '', '2017-06-28', 'F', 'Imagen Usuario/2017-06-20PerfilUsuario5948946d4bc022.10715319image.jpeg', '23', '2017-06-20', 0),
(8, 'q@q', '66eee9ace7508c154d02022000e1cf', 'q', '', '2017-06-28', 'M', 'Imagen Usuario/2017-06-20PerfilUsuario59489501e358f1.43200553image.jpeg', '2323', '2017-06-20', 0),
(9, 'z@z', '839ad0a86347fe9f6b8d16123d0982', 'z@z', '', '2017-06-28', 'M', 'Imagen Usuario/2017-06-20PerfilUsuario5948968e2c8687.31664223image.jpeg', '3254', '2017-06-20', 0),
(10, 'ww@ww', '90a95738ba1ba41105b435092e13d1', 'ww@ww', '', '2017-06-29', 'M', 'Imagen Usuario/2017-06-20PerfilUsuario594897b2243e57.65261915image.jpeg', '2332', '2017-06-20', 0),
(11, 'd@d', '39abe4bca904bca5a11121955a2996', 'd', '', '2017-06-29', 'M', 'Imagen Usuario/2017-06-20PerfilUsuario594897d4a36323.70889417image.jpeg', '2332', '2017-06-20', 0),
(12, 'w@ww', '23e65a679105b85c5dc7034fded4fb', 'w', '', '2017-06-28', 'M', 'Imagen Usuario/2017-06-20PerfilUsuario594952f3860191.70245232image.jpeg', '32', '2017-06-20', 0),
(13, 'la@la', 'd0efe00ae6ce01bba5490277d1f6cf54', 'lala', '', '2017-06-28', 'M', 'Imagen Usuario/2017-06-20PerfilUsuario594953624e9656.60207825image.jpeg', '23423', '2017-06-20', 0),
(14, 'asd@asd', '7815696ecbf1c96e6894b779456d330e', 'sad', '', '2017-06-28', 'M', 'Imagen Usuario/2017-06-20PerfilUsuario594958bee03a82.20279024image.jpeg', '23', '2017-06-20', 0),
(15, 'k@k', '8ce4b16b22b58894aa86c421e8759df3', 'karen', '', '2017-06-28', 'F', 'Imagen Usuario/2017-06-21PerfilUsuario594abcdd2800c8.89118338image.png', '4546', '2017-06-21', 0);

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
-- AUTO_INCREMENT de la tabla `mascota`
--
ALTER TABLE `mascota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT de la tabla `publicacion`
--
ALTER TABLE `publicacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
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

-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-02-2017 a las 09:46:46
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `studiumpro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(11, 'Categoria Prueba'),
(15, 'Otra categoria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config`
--

CREATE TABLE `config` (
  `id` tinyint(1) NOT NULL,
  `timer` int(70) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `config`
--

INSERT INTO `config` (`id`, `timer`) VALUES
(1, 1486714891);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foros`
--

CREATE TABLE `foros` (
  `id` int(250) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descrip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cantidad_mensajes` int(250) NOT NULL DEFAULT '0',
  `cantidad_temas` int(250) NOT NULL DEFAULT '0',
  `id_categorias` int(70) NOT NULL DEFAULT '1',
  `estado` int(1) NOT NULL DEFAULT '1',
  `ultimo_tema` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_ultimo_tema` bigint(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `foros`
--

INSERT INTO `foros` (`id`, `nombre`, `descrip`, `cantidad_mensajes`, `cantidad_temas`, `id_categorias`, `estado`, `ultimo_tema`, `id_ultimo_tema`) VALUES
(1, 'BIGINT 250', 'Este es la descripcion del foro', 0, 0, 11, 0, '', 0),
(4, 'Vamos con el foro', 'papapa', 2, 1, 11, 1, 'TEMA 1 eeeeeeeeeeeeeeee', 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `id` bigint(255) NOT NULL,
  `id_dueno` int(255) NOT NULL,
  `id_tema` int(255) NOT NULL,
  `id_foro` int(255) NOT NULL,
  `contenido` longtext COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`id`, `id_dueno`, `id_tema`, `id_foro`, `contenido`) VALUES
(0, 1, 14, 4, '[b]Negrita[/b]\r\n[i]Italic[/i]\r\n[u]Subrayado[/u]\r\n[s]Tachado[/s]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temas`
--

CREATE TABLE `temas` (
  `id` bigint(255) NOT NULL,
  `titulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contenido` longtext COLLATE utf8_unicode_ci NOT NULL,
  `id_foro` int(255) NOT NULL,
  `id_dueno` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `tipo` tinyint(1) NOT NULL DEFAULT '1',
  `fecha` varchar(11) COLLATE utf8_unicode_ci NOT NULL DEFAULT '21/01/2017',
  `visitas` int(255) NOT NULL DEFAULT '0',
  `respuestas` int(255) NOT NULL DEFAULT '0',
  `id_ultimo` int(255) NOT NULL,
  `fecha_ultimo` varchar(21) COLLATE utf8_unicode_ci NOT NULL DEFAULT '21/01/2017 08:12 am '
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `temas`
--

INSERT INTO `temas` (`id`, `titulo`, `contenido`, `id_foro`, `id_dueno`, `estado`, `tipo`, `fecha`, `visitas`, `respuestas`, `id_ultimo`, `fecha_ultimo`) VALUES
(14, 'TEMA 1 eeeeeeeeeeeeeeee', '[b]Negrita[/b]\r\n[i]Italic[/i]\r\n[u]Subrayado[/u]\r\n[s]Tachado[/s]\r\n[img]URL image[/img]\r\n[center]Centrar[/center]\r\n[h1]Titulo gigante[/h1]\r\n[h2]Titulo medianamete grande[/h2]\r\n[h3]Titulo mediano[/h3]\r\n[h4]Titulo normal[/h4]', 4, 1, 1, 1, '09/02/2017 ', 21, 1, 1, '09/02/2017 11:51 pm');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(255) NOT NULL,
  `user` varchar(17) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `rol` int(1) NOT NULL DEFAULT '0',
  `activo` int(1) NOT NULL DEFAULT '0',
  `keyreg` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `keypass` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `new_pass` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `ultima_conexion` int(50) NOT NULL DEFAULT '1485693860',
  `no_leidos` text COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(70) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default.jpg',
  `firma` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rango` varchar(70) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Usuario',
  `edad` int(3) NOT NULL DEFAULT '18',
  `fecha_reg` varchar(11) COLLATE utf8_unicode_ci NOT NULL DEFAULT '26/01/2017',
  `biografia` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mensajes` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `user`, `pass`, `email`, `rol`, `activo`, `keyreg`, `keypass`, `new_pass`, `ultima_conexion`, `no_leidos`, `img`, `firma`, `rango`, `edad`, `fecha_reg`, `biografia`, `mensajes`) VALUES
(1, 'alexlopez9', 'c0784027b45aa11e848a38e890f8416c', 'alexlopezortiz9@gmail.com', 2, 1, '', '', '', 1486714891, '', 'default.jpg', '[center][img]cuerpo/vista/app/images/images/firmas/firma02.jpg[/img][/center]', 'Usuario', 18, '26/01/2017', 'Esta es mi biografía', 1),
(6, 'usuario2', 'c0784027b45aa11e848a38e890f8416c', 'usuario2@gmail.com', 0, 1, '', '', '', 1485945476, '', 'default.jpg', '[center][img]cuerpo/vista/app/images/images/firmas/firma03.png[/img][/center]', 'Usuario', 18, '26/01/2017', '', 0),
(7, 'AL96', 'c0784027b45aa11e848a38e890f8416c', 'alexlopezortiz@gmail.com', 0, 1, '', '', '', 1486637475, '', 'default.jpg', '[center][img]cuerpo/vista/app/images/images/firmas/firma01.png[/img][/center]', 'Usuario', 18, '26/01/2017', '', 0),
(9, 'usuario1', '65402f90ef3ceb04c9a50fe3b5aa895d', 'usuario1@gmail.com', 0, 1, '', '', '', 1485693860, '', 'default.jpg', '[center][img]http://i.imgur.com/iPDfSv8.png?1[/img][/center]ç', 'Usuario', 18, '26/01/2017', '', 0),
(10, 'usuario3', '65402f90ef3ceb04c9a50fe3b5aa895d', 'usuario3@gmail.com', 0, 1, '', '', '', 1485693860, '', 'default.jpg', '', 'Usuario', 18, '26/01/2017', '', 0),
(11, 'usuario4', 'c0784027b45aa11e848a38e890f8416c', 'usuario4@gmail.com', 0, 1, '', '', '', 1485888668, '', 'default.jpg', '', 'Usuario', 18, '26/01/2017', '', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `foros`
--
ALTER TABLE `foros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `temas`
--
ALTER TABLE `temas`
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
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `config`
--
ALTER TABLE `config`
  MODIFY `id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `foros`
--
ALTER TABLE `foros`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `temas`
--
ALTER TABLE `temas`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 05-06-2019 a las 08:49:36
-- Versión del servidor: 5.6.43-cll-lve
-- Versión de PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `estudio_contable`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` char(4) NOT NULL,
  `ingresos_brutos` varchar(100) NOT NULL DEFAULT '0.00',
  `actividad` varchar(100) DEFAULT NULL,
  `can_min_emp` varchar(100) DEFAULT NULL,
  `sup_afe` varchar(100) DEFAULT NULL,
  `ene_ele_con_anual` varchar(100) DEFAULT NULL,
  `alq_dev_anual` varchar(100) DEFAULT NULL,
  `pres_serv` varchar(100) DEFAULT NULL,
  `ven_cos_muebles` varchar(100) DEFAULT NULL,
  `aporte_sipa` varchar(100) DEFAULT NULL,
  `aporte_os` varchar(100) DEFAULT NULL,
  `t_pres_serv` varchar(100) DEFAULT NULL,
  `t_ven_cos_muebles` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`, `ingresos_brutos`, `actividad`, `can_min_emp`, `sup_afe`, `ene_ele_con_anual`, `alq_dev_anual`, `pres_serv`, `ven_cos_muebles`, `aporte_sipa`, `aporte_os`, `t_pres_serv`, `t_ven_cos_muebles`) VALUES
(204, 'A', '138127.99', 'No excluida', 'No requiere', 'Hasta 30 m2', 'Hasta 3330 Kw', '51798', '111.81', '111.81', '493.31', '689', '1294.12', '1294.12'),
(205, 'B', '207191.98', 'No excluida', 'No requiere', 'Hasta 45 m2', 'Hasta 5000 Kw', '51798', '215.42', '215.42', '542.64', '689', '1447.06', '1447.06'),
(206, 'C', '276255.98', 'No excluida', 'No requiere', 'Hasta 60 m2', 'Hasta 6700 Kw', '103595.99', '368.34', '340.38', '596.91', '689', '1654.25', '1626.29'),
(207, 'D', '414383.98', 'No excluida', 'No requiere', 'Hasta 85 m2', 'Hasta 10000 Kw', '103595.99', '605.13', '559.09', '656.6', '689', '1950.73', '1904.69'),
(208, 'E', '552511.95', 'No excluida', 'No requiere', 'Hasta 110 m2', 'Hasta 13000 Kw', '129083.89', '1151.06', '892.89', '722.26', '689', '2562.32', '2304.15'),
(209, 'F', '690639.95', 'No excluida', 'No requiere', 'Hasta 150 m2', 'Hasta 16500 Kw', '129494.98', '1583.54', '1165.86', '794.48', '689', '3067.02', '2649.34'),
(210, 'G', '828767.94', 'No excluida', 'No requiere', 'Hasta 200 m2', 'Hasta 20000 Kw', '155393.99', '2014.37', '1453.62', '873.93', '689', '3577.3', '3016.55'),
(211, 'H', '1151066.58', 'No excluida', 'No requiere', 'Hasta 200 m2', 'Hasta 20000 Kw', '207191.98', '4604.26', '3568.31', '961.32', '689', '6254.58', '5218.63'),
(212, 'I', '1352503.24', 'Venta de Bs. muebles', 'No requiere', 'Hasta 200 m2', 'Hasta 20000 Kw', '207191.98', '-', '5755.33', '1057.46', '689', '-', '7501.79'),
(213, 'J', '1553939.89', 'Venta de Bs. muebles', 'No requiere', 'Hasta 200 m2', 'Hasta 20000 Kw', '207191.98', '-', '6763.34', '1163.21', '689', '-', '8615.55'),
(214, 'K', '1726599.88', 'Venta de Bs. muebles', 'No requiere', 'Hasta 200 m2', 'Hasta 20000 Kw', '207191.98', '-', '7769.7', '1279.52', '689', '-', '9738.22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(255) NOT NULL,
  `telefono_cliente` char(30) NOT NULL,
  `email_cliente` varchar(64) NOT NULL,
  `direccion_cliente` varchar(255) NOT NULL,
  `status_cliente` tinyint(4) NOT NULL,
  `date_added` datetime NOT NULL,
  `cuit` varchar(11) NOT NULL,
  `categoria` char(1) NOT NULL DEFAULT '',
  `honorario` decimal(10,2) DEFAULT '0.00',
  `usuario` varchar(50) DEFAULT NULL,
  `clave` varchar(10) DEFAULT NULL,
  `condicion_iva` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre_cliente`, `telefono_cliente`, `email_cliente`, `direccion_cliente`, `status_cliente`, `date_added`, `cuit`, `categoria`, `honorario`, `usuario`, `clave`, `condicion_iva`) VALUES
(28, 'HORACIO ROMERO', '', '', '', 1, '2019-06-01 00:00:00', '20149124382', 'A', '2000.00', 'HROMERO', 'HORACIO01', 'Monotributo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `id_documento` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `ruta` varchar(500) NOT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`id_documento`, `cliente`, `tipo`, `ruta`, `fecha`) VALUES
(2, 28, 3, 'documentos/3_28.pdf', '2019-06-05'),
(3, 28, 4, 'documentos/4_28.pdf', '2019-06-05'),
(4, 28, 1, 'documentos/1_28.pdf', '2019-06-05'),
(5, 28, 2, 'documentos/2_28.pdf', '2019-06-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id_mensaje` int(11) NOT NULL,
  `destino` varchar(100) DEFAULT NULL,
  `cliente` int(11) DEFAULT NULL,
  `visto` varchar(50) DEFAULT NULL,
  `mensaje` text,
  `prioridad` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `asunto` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id_mensaje`, `destino`, `cliente`, `visto`, `mensaje`, `prioridad`, `estado`, `fecha`, `asunto`) VALUES
(23, 'contador', 28, '0', 'Che una duda, no es un poco caro el servicio?? EstÃ¡ un poco alto tus honorarios, no me estafÃ©s he !! Pedazo de garca', 0, 1, '2019-06-05 11:50:23', 'Sobre Honorarios'),
(24, 'cliente', 28, '2019-06-05 02:06:39', 'comunicarse con el contador\r\n', 3, 1, '2019-06-05 02:06:28', 'recategorizacion '),
(25, 'contador', 28, '0', 'TE LLAME Y NO CONTESTAS\r\n', 0, 1, '2019-06-05 02:12:57', 'recategorizacion ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `id` int(11) NOT NULL,
  `movimiento` varchar(20) NOT NULL,
  `cliente` int(11) NOT NULL,
  `anio` varchar(4) NOT NULL,
  `enero` decimal(10,2) DEFAULT '0.00',
  `febrero` decimal(10,2) DEFAULT '0.00',
  `marzo` decimal(10,2) DEFAULT '0.00',
  `abril` decimal(10,2) DEFAULT '0.00',
  `mayo` decimal(10,2) DEFAULT '0.00',
  `junio` decimal(10,2) DEFAULT '0.00',
  `julio` decimal(10,2) DEFAULT '0.00',
  `agosto` decimal(10,2) DEFAULT '0.00',
  `septiembre` decimal(10,2) DEFAULT '0.00',
  `octubre` decimal(10,2) DEFAULT '0.00',
  `noviembre` decimal(10,2) DEFAULT '0.00',
  `diciembre` decimal(10,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`id`, `movimiento`, `cliente`, `anio`, `enero`, `febrero`, `marzo`, `abril`, `mayo`, `junio`, `julio`, `agosto`, `septiembre`, `octubre`, `noviembre`, `diciembre`) VALUES
(17, 'ingresos', 26, '2019', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
(18, 'egresos', 26, '2019', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
(19, 'ingresos', 27, '2019', '20000.00', '30000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
(20, 'egresos', 27, '2019', '60000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
(21, 'ingresos', 28, '2019', '10.00', '10.00', '10.00', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
(22, 'egresos', 28, '2019', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
(23, 'ingresos', 28, '2018', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '30000.00', '20000.00', '15000.00', '1.00', '10.00', '10.00'),
(24, 'egresos', 28, '2018', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL COMMENT 'auto incrementing user_id of each user, unique index',
  `firstname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `user_name`, `user_password_hash`, `user_email`, `date_added`) VALUES
(1, 'Cristian', 'Schumacher', 'cristian', '$2y$10$XqfsgqNXA54j15eNK6BeY.Ke1oUhFJJ0I7Orj10DbccRSCMcLNEze', 'nosequeoner@asdasd.com', '2016-05-21 15:06:00'),
(2, 'Neo', 'Programador', 'admin', '$2y$10$safORw88BOQzeYanN62Ca.63nwf9DH6VZiuJthFlk6mbWmfhUpuUK', 'vazquezjluis@yahoo.com', '2019-05-21 19:20:04');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `codigo_producto` (`nombre_cliente`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id_documento`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id_mensaje`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index', AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

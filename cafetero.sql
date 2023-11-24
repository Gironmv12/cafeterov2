-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 20-11-2023 a las 23:39:37
-- Versión del servidor: 5.7.24
-- Versión de PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cafeteroo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `idCompras` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fechaCompras` date NOT NULL,
  `monto` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`idCompras`, `idUsuario`, `fechaCompras`, `monto`) VALUES
(157, 22, '2023-11-10', 252.72),
(158, 34, '2023-11-10', 165.24),
(159, 22, '2023-11-11', 178.2),
(160, 22, '2023-11-11', 165.24),
(161, 34, '2023-11-11', 194.4),
(162, 35, '2023-11-11', 356.4),
(163, 35, '2023-11-11', 103.68),
(164, 34, '2023-11-12', 172.8),
(165, 22, '2023-11-12', 658.8),
(166, 22, '2023-11-13', 252.72),
(167, 34, '2023-11-13', 165.24),
(168, 36, '2023-11-13', 513),
(169, 34, '2023-11-13', 91.8),
(170, 34, '2023-11-13', 388.8),
(171, 34, '2023-11-16', 252.72),
(172, 22, '2023-11-16', 165.24),
(173, 34, '2023-11-16', 165.24),
(174, 34, '2023-11-16', 87.48),
(175, 35, '2023-11-16', 165.24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `idDetalle` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `idCompras` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precioCompra` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_compra`
--

INSERT INTO `detalle_compra` (`idDetalle`, `idProducto`, `idCompras`, `cantidad`, `precioCompra`) VALUES
(298, 17, 157, 1, 153),
(299, 16, 157, 1, 81),
(300, 17, 158, 1, 153),
(301, 19, 159, 1, 165),
(302, 17, 160, 1, 153),
(303, 22, 161, 1, 180),
(304, 19, 162, 2, 165),
(305, 23, 163, 1, 96),
(306, 25, 164, 1, 160),
(307, 15, 165, 2, 305),
(308, 16, 166, 1, 81),
(309, 17, 166, 1, 153),
(310, 17, 167, 1, 153),
(311, 26, 168, 2, 85),
(312, 15, 168, 1, 305),
(313, 26, 169, 1, 85),
(314, 21, 170, 1, 360),
(315, 17, 171, 1, 153),
(316, 16, 171, 1, 81),
(317, 17, 172, 1, 153),
(318, 17, 173, 1, 153),
(319, 16, 174, 1, 81),
(320, 17, 175, 1, 153);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `idPago` int(11) NOT NULL,
  `monto` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProducto` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `image` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `activo` int(1) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `nombre`, `descripcion`, `image`, `precio`, `activo`, `stock`) VALUES
(15, 'Café tradicional 1000 gramos', 'Nuestro café orgánico tradicional es un prima lavado, hecho de granos 100% arábica.', 'tradicional-1000.png', '305.00', 1, 100),
(16, 'Café tradicional 250 gramos', 'Este café tiene una acidez media, lo que nos da una taza suave y balanceada en sabor y aroma, con notas a caramelo y frutos secos.', 'tradicional-250.png', '81.00', 1, 101),
(17, 'Café tradicional 500 gramos', 'Este café tiene una acidez media, lo que nos da una taza suave y balanceada en sabor y aroma, con notas a caramelo y frutos secos. Ideal para preparar en cafetera de goteo y cafetera percoladora para reuniones.', 'tradicional-500.png', '153.00', 1, 100),
(18, 'Café gourmet 1000 gramos', 'El café orgánico gourmet es una preparación americana (exportación), hecha de granos 100% arábica.', 'gourmet-1000.png', '330.00', 1, 100),
(19, 'Café gourmet 500 gramos', 'Tiene un aroma intenso y acidez alta, lo que nos da una taza de sabor más fuerte con notas achocolatadas y nuez.', 'gourmet-500.png', '165.00', 1, 100),
(20, 'Café gourmet 250 gramos', 'Ideal para preparar en cafetera con molino integrado, prensa francesa y cafetera expreso.', 'gourmet-250.png', '88.00', 1, 100),
(21, 'Café supremo 1000 gramos', 'El café orgánico supremo es una preparación de especialidad, hecha de granos 100% arábica.', 'supremo-1000.png', '360.00', 1, 100),
(22, 'Café supremo 500 gramos', 'Se denomina especialidad debido a que no presenta defectos en el grano verde y es cultivado bajo estrictos controles de calidad y cuidado ambiental.', 'supremo-500.png', '180.00', 1, 100),
(23, 'Café supremo 250 gramos.', 'Con aroma y cuerpo muy intensos y acidez media, este café nos da una taza muy equilibrada en sabor con notas en fragancia a nueces, chocolates y caramelo. Nuestra calidad supremo cumple con las expectativas de los paladares más exigentes.', 'supremo-250.png', '96.00', 1, 100),
(24, 'Café descafeinado 1000 gramos', 'Nuestro café descafeinado es un prima lavado sin cafeína, hecha de granos 100% arábica. La cafeína es retirada por proceso natural, es decir, no se utilizan químicos durante su elaboración.', 'descafeinado-1000.png', '320.00', 1, 100),
(25, 'Café descafeinado 500 gramos', 'Nuestro café descafeinado es un prima lavado sin cafeína, hecha de granos 100% arábica. La cafeína es retirada por proceso natural, es decir, no se utilizan químicos durante su elaboración.', 'descafeinado-500.png', '160.00', 1, 100),
(26, 'Café descafeinado 250 gramos', 'Este café tiene una acidez y cuerpo bajo, lo que nos da una taza suave. Recomendado para personas intolerantes a la cafeína.', 'descafeinado-250.png', '85.00', 1, 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idRol` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idRol`, `nombre`) VALUES
(1, 'administrador'),
(2, 'cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `idRol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombre`, `apellido`, `correo`, `clave`, `idRol`) VALUES
(22, 'Pablo Gamaliel', 'martinez Gonzales', 'pablo.martinez10@unach.mx', '123', 2),
(34, 'Francisco Javier', 'Lopez Giron', 'francisco.lopez64@unach.mx', '123', 1),
(35, 'Oliver de Jesus', 'Penagos', 'Neutrophoenix@gmail.com', '123', 2),
(36, 'Yuritzi ', 'Medina Ruiz', 'yuritzi.medina54@unach.mx', '12345', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`idCompras`),
  ADD KEY `compras` (`idUsuario`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`idDetalle`),
  ADD KEY `detalle_compra_ibfk_1` (`idProducto`),
  ADD KEY `detalle_compra_ibfk_2` (`idCompras`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`idPago`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProducto`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idRol` (`idRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `idCompras` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `idDetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=321;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `idPago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD CONSTRAINT `detalle_compra_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_compra_ibfk_2` FOREIGN KEY (`idCompras`) REFERENCES `compras` (`idCompras`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `roles` (`idRol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

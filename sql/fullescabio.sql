-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-02-2018 a las 13:50:58
-- Versión del servidor: 10.1.29-MariaDB
-- Versión de PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fullescabio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbclientes`
--

CREATE TABLE `dbclientes` (
  `idcliente` int(11) NOT NULL,
  `CodCliente` int(11) DEFAULT NULL,
  `Nombre` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Telefono` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `FechaAlta` datetime DEFAULT NULL,
  `Localidad` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Direccion` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Piso` varchar(4) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Depto` varchar(4) COLLATE utf8_spanish_ci DEFAULT NULL,
  `CodLocal` int(11) DEFAULT NULL,
  `EntreCalle1` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `EntreCalle2` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `reftipoclientes` int(11) NOT NULL,
  `Ubicacion` varchar(6) COLLATE utf8_spanish_ci DEFAULT NULL,
  `DireccionMail` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Facebook` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Estado` varchar(2) COLLATE utf8_spanish_ci DEFAULT NULL,
  `CodZona` int(11) DEFAULT NULL,
  `Numero` varchar(6) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbdetallelistaprecios`
--

CREATE TABLE `dbdetallelistaprecios` (
  `iddetallelistaprecio` int(11) NOT NULL,
  `reflistaprecios` int(11) NOT NULL,
  `refproductos` int(11) NOT NULL,
  `Precio` decimal(18,2) NOT NULL,
  `VigenciaDesde` date NOT NULL,
  `VigenciaHasta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `dbdetallelistaprecios`
--

INSERT INTO `dbdetallelistaprecios` (`iddetallelistaprecio`, `reflistaprecios`, `refproductos`, `Precio`, `VigenciaDesde`, `VigenciaHasta`) VALUES
(1, 1, 1, '44.00', '2011-10-31', '2012-03-13'),
(2, 1, 1, '44.00', '2011-11-02', '2012-03-13'),
(3, 1, 1, '44.00', '2012-03-14', '2100-12-31'),
(4, 1, 2, '21.00', '2011-10-31', '2011-11-08'),
(5, 1, 2, '21.00', '2011-11-09', '2012-03-13'),
(6, 1, 2, '23.00', '2012-03-14', '2100-12-31'),
(7, 1, 3, '25.00', '2011-10-31', '2011-11-08'),
(8, 1, 3, '25.00', '2011-11-09', '2012-03-13'),
(9, 1, 3, '35.00', '2012-03-14', '2100-12-31'),
(10, 1, 4, '29.00', '2011-10-31', '2011-11-08'),
(11, 1, 4, '29.00', '2011-11-09', '2012-03-13'),
(12, 1, 4, '35.00', '2012-03-14', '2100-12-31'),
(13, 1, 5, '42.00', '2011-10-30', '2011-10-30'),
(14, 1, 5, '50.00', '2012-03-14', '2100-12-31'),
(15, 1, 6, '27.00', '2011-10-31', '2012-03-13'),
(16, 1, 6, '33.00', '2012-03-14', '2100-12-31'),
(17, 1, 7, '18.00', '2011-10-30', '2011-10-30'),
(18, 1, 7, '21.00', '2012-03-14', '2100-12-31'),
(19, 1, 8, '25.00', '2011-10-31', '2012-03-13'),
(20, 1, 8, '27.00', '2012-03-14', '2012-04-12'),
(21, 1, 9, '41.00', '2011-10-31', '2012-03-13'),
(22, 1, 9, '41.00', '2012-03-14', '2012-03-25'),
(23, 1, 9, '41.00', '2012-03-26', '2012-04-04'),
(24, 1, 10, '52.00', '2011-10-31', '2012-03-07'),
(25, 1, 10, '54.00', '2012-03-08', '2012-04-06'),
(26, 1, 11, '20.00', '2011-10-31', '2012-03-13'),
(27, 1, 11, '21.00', '2012-03-14', '2100-12-31'),
(28, 2, 1, '44.00', '2011-10-31', '2011-11-07'),
(29, 2, 1, '44.00', '2011-11-02', '2011-11-07'),
(30, 2, 1, '39.00', '2011-11-08', '2100-12-31'),
(31, 2, 2, '21.00', '2011-10-31', '2011-11-07'),
(32, 2, 2, '18.00', '2011-11-08', '2011-11-08'),
(33, 2, 2, '18.00', '2011-11-09', '2100-12-31'),
(34, 2, 3, '25.00', '2011-10-31', '2011-11-07'),
(35, 2, 3, '22.00', '2011-11-08', '2011-11-08'),
(36, 2, 3, '22.00', '2011-11-09', '2100-12-31'),
(37, 2, 4, '29.00', '2011-10-31', '2011-11-07'),
(38, 2, 4, '26.00', '2011-11-08', '2011-11-08'),
(39, 2, 4, '26.00', '2011-11-09', '2100-12-31'),
(40, 2, 5, '42.00', '2011-10-31', '2011-10-30'),
(41, 2, 6, '27.00', '2011-10-31', '2011-11-07'),
(42, 2, 6, '24.00', '2011-11-08', '2100-12-31'),
(43, 2, 7, '18.00', '2011-10-31', '2011-10-30'),
(44, 2, 8, '25.00', '2011-10-31', '2011-11-07'),
(45, 2, 8, '22.00', '2011-11-08', '2100-12-31'),
(46, 2, 9, '41.00', '2011-10-31', '2011-11-07'),
(47, 2, 9, '36.00', '2011-11-08', '2012-03-25'),
(48, 2, 9, '36.00', '2012-03-26', '2012-04-04'),
(49, 2, 10, '52.00', '2011-10-31', '2011-11-07'),
(50, 2, 10, '46.00', '2011-11-08', '2012-03-07'),
(51, 2, 10, '54.00', '2012-03-08', '2012-04-06'),
(52, 2, 11, '20.00', '2011-10-31', '2011-11-07'),
(53, 2, 11, '18.00', '2011-11-08', '2100-12-31'),
(54, 3, 1, '44.00', '2011-10-31', '2011-11-07'),
(55, 3, 1, '44.00', '2011-11-02', '2011-11-07'),
(56, 3, 1, '63.00', '2011-11-08', '2012-03-13'),
(57, 3, 1, '70.00', '2012-03-14', '2100-12-31'),
(58, 3, 2, '21.00', '2011-10-31', '2011-11-07'),
(59, 3, 2, '30.00', '2011-11-08', '2011-11-08'),
(60, 3, 2, '30.00', '2011-11-09', '2012-03-13'),
(61, 3, 2, '38.00', '2012-03-14', '2100-12-31'),
(62, 3, 3, '25.00', '2011-10-31', '2011-11-07'),
(63, 3, 3, '36.00', '2011-11-08', '2011-11-08'),
(64, 3, 3, '36.00', '2011-11-09', '2012-03-13'),
(65, 3, 3, '65.00', '2012-03-14', '2100-12-31'),
(66, 3, 4, '29.00', '2011-10-31', '2011-11-07'),
(67, 3, 4, '42.00', '2011-11-08', '2011-11-08'),
(68, 3, 4, '42.00', '2011-11-09', '2012-03-13'),
(69, 3, 4, '65.00', '2012-03-14', '2100-12-31'),
(70, 3, 5, '42.00', '2011-10-30', '2011-10-30'),
(71, 3, 5, '85.00', '2012-03-14', '2100-12-31'),
(72, 3, 6, '27.00', '2011-10-31', '2011-11-07'),
(73, 3, 6, '39.00', '2011-11-08', '2012-03-13'),
(74, 3, 6, '52.00', '2012-03-14', '2100-12-31'),
(75, 3, 7, '18.00', '2011-10-30', '2011-10-30'),
(76, 3, 7, '27.00', '2012-03-14', '2100-12-31'),
(77, 3, 8, '25.00', '2011-10-31', '2011-11-07'),
(78, 3, 8, '36.00', '2011-11-08', '2012-03-13'),
(79, 3, 8, '40.00', '2012-03-14', '2012-04-12'),
(80, 3, 9, '41.00', '2011-10-31', '2011-11-07'),
(81, 3, 9, '59.00', '2011-11-08', '2012-03-13'),
(82, 3, 9, '67.00', '2012-03-14', '2012-03-25'),
(83, 3, 9, '67.00', '2012-03-26', '2012-04-04'),
(84, 3, 10, '52.00', '2011-10-31', '2011-11-07'),
(85, 3, 10, '75.00', '2011-11-08', '2012-03-07'),
(86, 3, 10, '83.00', '2012-03-08', '2012-04-06'),
(87, 3, 11, '20.00', '2011-10-31', '2011-11-07'),
(88, 3, 11, '29.00', '2011-11-08', '2012-03-13'),
(89, 3, 11, '40.00', '2012-03-14', '2100-12-31'),
(90, 1, 9, '41.00', '2012-04-05', '2012-04-11'),
(91, 2, 9, '36.00', '2012-04-05', '2100-12-31'),
(92, 3, 9, '72.00', '2012-04-05', '2012-04-11'),
(93, 1, 10, '59.00', '2012-04-07', '2100-12-31'),
(94, 2, 10, '54.00', '2012-04-07', '2100-12-31'),
(95, 3, 10, '89.00', '2012-04-07', '2100-12-31'),
(96, 1, 9, '45.00', '2012-04-12', '2100-12-31'),
(97, 3, 9, '72.00', '2012-04-12', '2100-12-31'),
(98, 1, 8, '30.00', '2012-04-13', '2100-12-31'),
(99, 3, 8, '45.00', '2012-04-13', '2100-12-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbdetallepedidos`
--

CREATE TABLE `dbdetallepedidos` (
  `iddetallepedido` int(11) NOT NULL,
  `refpedidos` int(11) NOT NULL,
  `refproductos` int(11) NOT NULL,
  `CodProducto` int(11) NOT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `Anulados` int(11) DEFAULT NULL,
  `EnvasesACobrar` int(11) DEFAULT NULL,
  `PrecioUnitario` decimal(18,2) DEFAULT NULL,
  `Descuento` decimal(18,2) DEFAULT NULL,
  `TotalEnvases` int(11) DEFAULT NULL,
  `PrecioEnvase` decimal(18,2) DEFAULT NULL,
  `CantidadOriginal` int(11) DEFAULT NULL,
  `EnvasesOriginal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dblistaprecios`
--

CREATE TABLE `dblistaprecios` (
  `idlistaprecio` int(11) NOT NULL,
  `Descripcion` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `Estado` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `dblistaprecios`
--

INSERT INTO `dblistaprecios` (`idlistaprecio`, `Descripcion`, `Estado`) VALUES
(1, 'Lista A', b'1'),
(2, 'Lista B', b'1'),
(3, 'Lista D', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbpedidos`
--

CREATE TABLE `dbpedidos` (
  `idpedido` int(11) NOT NULL,
  `NroPedido` int(11) DEFAULT NULL,
  `Fecha` datetime DEFAULT NULL,
  `Estado` varchar(2) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Usuario` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `NroLista` int(11) DEFAULT NULL,
  `HoraEntrega` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `TarjetaDelivery` varchar(22) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ImporteTotal` decimal(18,2) DEFAULT NULL,
  `ImportePagado` decimal(18,2) DEFAULT NULL,
  `Descuento` decimal(8,2) DEFAULT NULL,
  `HoraSalida` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `HoraCarga` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `NroDespacho` int(11) DEFAULT NULL,
  `Origen` bit(1) DEFAULT NULL,
  `GastosEnvio` decimal(10,2) DEFAULT NULL,
  `FechaCaja` datetime DEFAULT NULL,
  `Consignacion` bit(1) DEFAULT NULL,
  `ImportePagadoOriginal` decimal(18,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbproductos`
--

CREATE TABLE `dbproductos` (
  `idproducto` int(11) NOT NULL,
  `CodProducto` int(11) NOT NULL,
  `Descripcion` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `FechaAlta` datetime DEFAULT NULL,
  `Estado` varchar(2) COLLATE utf8_spanish_ci DEFAULT NULL,
  `StockCritico` decimal(18,2) DEFAULT NULL,
  `ControlaStock` bit(1) DEFAULT NULL,
  `AvisarStock` decimal(18,2) DEFAULT NULL,
  `refmarcas` int(11) NOT NULL,
  `Envase` bit(1) DEFAULT NULL,
  `refgrupoproductos` int(11) NOT NULL,
  `Stock` decimal(18,2) DEFAULT NULL,
  `TipoProducto` varchar(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `CodProductoBarra` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `StockComprometido` decimal(18,2) DEFAULT NULL,
  `PrecioEnvase` decimal(18,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `dbproductos`
--

INSERT INTO `dbproductos` (`idproducto`, `CodProducto`, `Descripcion`, `FechaAlta`, `Estado`, `StockCritico`, `ControlaStock`, `AvisarStock`, `refmarcas`, `Envase`, `refgrupoproductos`, `Stock`, `TipoProducto`, `CodProductoBarra`, `StockComprometido`, `PrecioEnvase`) VALUES
(1, 1, 'Campari', '0000-00-00 00:00:00', 'A', '12.00', b'1', '24.00', 7, b'1', 2, '12.00', 'U', '7891136052000', '0.00', '0.00'),
(2, 2, 'Gancia x 1L', '0000-00-00 00:00:00', 'A', '12.00', b'1', '24.00', 7, b'1', 2, '11.00', 'U', '7790950000160', '0.00', '0.00'),
(3, 3, 'Martini roso', '0000-00-00 00:00:00', 'A', '3.00', b'1', '6.00', 7, b'1', 2, '5.00', 'U', '7790950112894', '0.00', '0.00'),
(4, 4, 'Martini Bianco', '0000-00-00 00:00:00', 'A', '3.00', b'1', '6.00', 26, b'1', 2, '4.00', 'U', '7790950112917', '0.00', '0.00'),
(5, 5, 'Martini dry', '0000-00-00 00:00:00', 'A', '3.00', b'1', '6.00', 26, b'1', 2, '9.00', 'U', '7790950112924', '0.00', '0.00'),
(6, 6, 'fernet 1882', '0000-00-00 00:00:00', 'A', '12.00', b'1', '18.00', 7, b'1', 2, '8.00', 'U', '7790139002879', '0.00', '0.00'),
(7, 7, 'Frizze Evolution Blue', '0000-00-00 00:00:00', 'A', '6.00', b'1', '12.00', 27, b'1', 8, '15.00', 'U', '7791540042706', '0.00', '0.00'),
(8, 8, 'fernet branca x 450', '0000-00-00 00:00:00', 'A', '12.00', b'1', '0.00', 2, b'1', 2, '39.00', 'U', '7790290001179', '0.00', '0.00'),
(9, 9, 'fernet branca x 750', '0000-00-00 00:00:00', 'A', '18.00', b'1', '0.00', 2, b'1', 2, '148.00', 'U', '7790290001193', '0.00', '0.00'),
(10, 10, 'fernet branca x 1 L', '0000-00-00 00:00:00', 'A', '10.00', b'1', '0.00', 2, b'1', 2, '67.00', 'U', '7790290000523', '0.00', '0.00'),
(11, 11, 'Punt e mes', '0000-00-00 00:00:00', 'A', '3.00', b'1', '6.00', 2, b'1', 2, '6.00', 'U', '7790290007195', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `predio_menu`
--

CREATE TABLE `predio_menu` (
  `idmenu` int(11) NOT NULL,
  `url` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `icono` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `Orden` smallint(6) DEFAULT NULL,
  `hover` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `permiso` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `predio_menu`
--

INSERT INTO `predio_menu` (`idmenu`, `url`, `icono`, `nombre`, `Orden`, `hover`, `permiso`) VALUES
(1, '../index.php', 'icodashboard', 'Dashboard', 1, NULL, 'Empleado, Administrador, SuperAdmin'),
(5, '../pedidos/', 'icoproductos', 'Pedidos', 2, NULL, 'Empleado, Administrador, SuperAdmin'),
(8, '../logout.php', 'icosalir', 'Salir', 30, NULL, 'Empleado, Administrador, SuperAdmin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbgrupoproductos`
--

CREATE TABLE `tbgrupoproductos` (
  `idgrupoproducto` int(11) NOT NULL,
  `Descripcion` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `TipoProducto` varchar(1) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbgrupoproductos`
--

INSERT INTO `tbgrupoproductos` (`idgrupoproducto`, `Descripcion`, `TipoProducto`) VALUES
(1, 'Aguardientes', 'U'),
(2, 'Aperitivos', 'U'),
(3, 'Cerveza', 'U'),
(4, 'Champagnes', 'U'),
(5, 'Cognac', 'U'),
(6, 'Coolers', 'U'),
(7, 'Energizantes', 'U'),
(8, 'Espumante', 'U'),
(9, 'Gaseosas', 'U'),
(10, 'Gin', 'U'),
(11, 'Jugo y pulpas', 'U'),
(12, 'Licor', 'U'),
(13, 'Ron', 'U'),
(14, 'Vino Blanco', 'U'),
(15, 'Vino Tinto', 'U'),
(16, 'Vodka', 'U'),
(17, 'Whisky', 'U'),
(18, 'Otros', 'U'),
(19, 'Promos', 'P'),
(20, 'Tequila', 'U'),
(21, 'Otros', 'U'),
(22, 'Cigarrillos', 'U');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbmarcas`
--

CREATE TABLE `tbmarcas` (
  `idmarca` int(11) NOT NULL,
  `Descripcion` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbmarcas`
--

INSERT INTO `tbmarcas` (`idmarca`, `Descripcion`) VALUES
(1, 'Quilmes'),
(2, 'Branca'),
(3, 'San Telmo'),
(4, 'Terra'),
(5, 'Jameson'),
(6, 'Jack Daniel´s'),
(7, 'Otras Marcas'),
(8, 'Grant´s'),
(10, 'Hielo'),
(12, 'Absolut'),
(13, 'CAOL ILA'),
(14, 'bacardi'),
(15, 'Johnnie walker'),
(16, 'Stella Artois'),
(17, 'Smirnoff'),
(18, 'Finlandia'),
(19, 'Stolichnaya'),
(20, 'Skyy'),
(21, 'Ciroc'),
(22, 'Havana Club'),
(23, 'Pampero'),
(24, 'Captain Morgan'),
(25, 'Brahma'),
(26, 'Martini'),
(27, 'Frizze'),
(28, 'Trapiche'),
(29, 'JyB'),
(30, 'Chivas Regal'),
(31, 'Cocacola'),
(32, 'Trapiche'),
(33, 'Santa Julia'),
(34, 'Trumpeter'),
(35, 'cafayate'),
(36, 'Speed'),
(37, 'Red Bull'),
(38, 'Baileys'),
(39, 'Chandon'),
(40, 'Cusenier'),
(41, 'Bols'),
(42, 'Jose Cuervo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbtipoclientes`
--

CREATE TABLE `tbtipoclientes` (
  `idtipocliente` int(11) NOT NULL,
  `Descripcion` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `MontoMinimo` decimal(18,2) DEFAULT NULL,
  `activo` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `dbclientes`
--
ALTER TABLE `dbclientes`
  ADD PRIMARY KEY (`idcliente`),
  ADD KEY `fk_cliente_tipocliente_idx` (`reftipoclientes`);

--
-- Indices de la tabla `dbdetallelistaprecios`
--
ALTER TABLE `dbdetallelistaprecios`
  ADD PRIMARY KEY (`iddetallelistaprecio`),
  ADD KEY `fk_detlista_lista_idx` (`reflistaprecios`),
  ADD KEY `fk_detlista_prod_idx` (`refproductos`);

--
-- Indices de la tabla `dbdetallepedidos`
--
ALTER TABLE `dbdetallepedidos`
  ADD PRIMARY KEY (`iddetallepedido`),
  ADD KEY `fk_detpedido_pedido_idx` (`refpedidos`),
  ADD KEY `fk_detpedido_producto_idx` (`refproductos`);

--
-- Indices de la tabla `dblistaprecios`
--
ALTER TABLE `dblistaprecios`
  ADD PRIMARY KEY (`idlistaprecio`);

--
-- Indices de la tabla `dbpedidos`
--
ALTER TABLE `dbpedidos`
  ADD PRIMARY KEY (`idpedido`);

--
-- Indices de la tabla `dbproductos`
--
ALTER TABLE `dbproductos`
  ADD PRIMARY KEY (`idproducto`),
  ADD KEY `fk_productos_idx` (`refmarcas`),
  ADD KEY `fk_productos_grupo_idx` (`refgrupoproductos`);

--
-- Indices de la tabla `predio_menu`
--
ALTER TABLE `predio_menu`
  ADD PRIMARY KEY (`idmenu`);

--
-- Indices de la tabla `tbgrupoproductos`
--
ALTER TABLE `tbgrupoproductos`
  ADD PRIMARY KEY (`idgrupoproducto`);

--
-- Indices de la tabla `tbmarcas`
--
ALTER TABLE `tbmarcas`
  ADD PRIMARY KEY (`idmarca`);

--
-- Indices de la tabla `tbtipoclientes`
--
ALTER TABLE `tbtipoclientes`
  ADD PRIMARY KEY (`idtipocliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `dbclientes`
--
ALTER TABLE `dbclientes`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dbdetallelistaprecios`
--
ALTER TABLE `dbdetallelistaprecios`
  MODIFY `iddetallelistaprecio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT de la tabla `dbdetallepedidos`
--
ALTER TABLE `dbdetallepedidos`
  MODIFY `iddetallepedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dblistaprecios`
--
ALTER TABLE `dblistaprecios`
  MODIFY `idlistaprecio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `dbproductos`
--
ALTER TABLE `dbproductos`
  MODIFY `idproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `predio_menu`
--
ALTER TABLE `predio_menu`
  MODIFY `idmenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `tbgrupoproductos`
--
ALTER TABLE `tbgrupoproductos`
  MODIFY `idgrupoproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `tbmarcas`
--
ALTER TABLE `tbmarcas`
  MODIFY `idmarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `tbtipoclientes`
--
ALTER TABLE `tbtipoclientes`
  MODIFY `idtipocliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `dbclientes`
--
ALTER TABLE `dbclientes`
  ADD CONSTRAINT `fk_cliente_tipocliente` FOREIGN KEY (`reftipoclientes`) REFERENCES `tbtipoclientes` (`idtipocliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbdetallelistaprecios`
--
ALTER TABLE `dbdetallelistaprecios`
  ADD CONSTRAINT `fk_detlista_lista` FOREIGN KEY (`reflistaprecios`) REFERENCES `dblistaprecios` (`idlistaprecio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detlista_prod` FOREIGN KEY (`refproductos`) REFERENCES `dbproductos` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbdetallepedidos`
--
ALTER TABLE `dbdetallepedidos`
  ADD CONSTRAINT `fk_detpedido_pedido` FOREIGN KEY (`refpedidos`) REFERENCES `dbpedidos` (`idpedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detpedido_producto` FOREIGN KEY (`refproductos`) REFERENCES `dbproductos` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbproductos`
--
ALTER TABLE `dbproductos`
  ADD CONSTRAINT `fk_productos_grupo` FOREIGN KEY (`refgrupoproductos`) REFERENCES `tbgrupoproductos` (`idgrupoproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_productos_marca` FOREIGN KEY (`refmarcas`) REFERENCES `tbmarcas` (`idmarca`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

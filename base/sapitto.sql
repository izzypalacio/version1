-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-04-2021 a las 18:16:28
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `produccion`
--
CREATE DATABASE IF NOT EXISTS `produccion` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `produccion`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `batida`
--

DROP TABLE IF EXISTS `batida`;
CREATE TABLE `batida` (
  `id_Batida` int(11) NOT NULL,
  `fecha_Batida` date DEFAULT NULL,
  `numero_Batida` varchar(100) DEFAULT NULL,
  `numero_Dproducto` varchar(100) DEFAULT NULL,
  `productoc` varchar(100) DEFAULT NULL,
  `rinde` varchar(100) DEFAULT NULL,
  `costo` decimal(7,2) DEFAULT NULL,
  `margenu` decimal(11,6) DEFAULT NULL,
  `margenreal` decimal(7,2) DEFAULT NULL,
  `totalpro` decimal(7,2) DEFAULT NULL,
  `preciou` decimal(11,6) DEFAULT NULL,
  `preciout` decimal(7,2) DEFAULT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `moneda` varchar(100) DEFAULT NULL,
  `subtotal` decimal(7,2) DEFAULT NULL,
  `total` decimal(7,2) DEFAULT NULL,
  `estado` enum('0','1') DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `id_Dproducto` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `batida`
--

INSERT INTO `batida` (`id_Batida`, `fecha_Batida`, `numero_Batida`, `numero_Dproducto`, `productoc`, `rinde`, `costo`, `margenu`, `margenreal`, `totalpro`, `preciou`, `preciout`, `categoria`, `moneda`, `subtotal`, `total`, `estado`, `id_producto`, `id_Dproducto`, `id_usuario`) VALUES
(61, '2021-04-12', 'B00001', 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', '108', '25.92', '0.35', '63.66', '245.54', '0.30', '2.57', '26', 'USD$', '155.96', '181.88', '1', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `categoria`, `estado`, `id_usuario`) VALUES
(24, 'Pan Tostado', '1', 1),
(25, 'Pan de Levadura', '1', 1),
(26, 'Pan de Batida', '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cfabricacion`
--

DROP TABLE IF EXISTS `cfabricacion`;
CREATE TABLE `cfabricacion` (
  `id_Cfabricacion` int(11) NOT NULL,
  `servicios` text NOT NULL,
  `unidadm` enum('0','1') NOT NULL,
  `tiempo` time DEFAULT NULL,
  `porcentaje` float DEFAULT NULL,
  `costos` float NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cif`
--

DROP TABLE IF EXISTS `cif`;
CREATE TABLE `cif` (
  `id_cif` int(11) NOT NULL,
  `planta` varchar(100) DEFAULT NULL,
  `costo` decimal(11,6) DEFAULT NULL,
  `estado` enum('0','1') NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cif`
--

INSERT INTO `cif` (`id_cif`, `planta`, `costo`, `estado`, `id_usuario`) VALUES
(1, 'planta1', '0.24', '1', 1),
(2, 'planta2', '0.32', '1', 1),
(3, 'planta3', '0.06', '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_batida`
--

DROP TABLE IF EXISTS `detalle_batida`;
CREATE TABLE `detalle_batida` (
  `id_detalle_Batida` int(11) NOT NULL,
  `numero_Batida` varchar(100) DEFAULT NULL,
  `numero_Dproducto` varchar(100) DEFAULT NULL,
  `productoc` varchar(100) DEFAULT NULL,
  `id_Mprima` int(11) DEFAULT NULL,
  `materiales` varchar(100) DEFAULT NULL,
  `unidadm` enum('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14') NOT NULL,
  `moneda` varchar(100) DEFAULT NULL,
  `precio` decimal(11,6) DEFAULT NULL,
  `Nbatida` varchar(100) DEFAULT NULL,
  `cantidad` decimal(11,6) DEFAULT NULL,
  `importe` decimal(11,6) DEFAULT NULL,
  `fecha_Batida` date DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `id_detalle_Dproducto` int(11) DEFAULT NULL,
  `id_Dproducto` int(11) DEFAULT NULL,
  `estado` enum('0','1') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_batida`
--

INSERT INTO `detalle_batida` (`id_detalle_Batida`, `numero_Batida`, `numero_Dproducto`, `productoc`, `id_Mprima`, `materiales`, `unidadm`, `moneda`, `precio`, `Nbatida`, `cantidad`, `importe`, `fecha_Batida`, `id_usuario`, `id_producto`, `id_detalle_Dproducto`, `id_Dproducto`, `estado`) VALUES
(945, 'B00001', 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', NULL, 'HARINA ESPECIAL GUMARSAL BOLSA DE LBS ', '8', 'USD$', '0.19', '1', '31.38', '5.96', '2021-04-12', 1, NULL, NULL, NULL, '1'),
(946, 'B00001', 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', NULL, 'SINER BAKER DURANGO LBS', '8', 'USD$', '1.32', '1', '23.40', '30.89', '2021-04-12', 1, NULL, NULL, NULL, '1'),
(947, 'B00001', 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', NULL, 'AZUCAR BLANCA DIZUCAR SACO LBS. ', '8', 'USD$', '0.28', '1', '31.38', '8.79', '2021-04-12', 1, NULL, NULL, NULL, '1'),
(948, 'B00001', 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', NULL, 'ALMIDON DE MAIZ CARIBE. LBS. ', '8', 'USD$', '0.28', '1', '2.64', '0.74', '2021-04-12', 1, NULL, NULL, NULL, '1'),
(949, 'B00001', 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', NULL, 'POLVO DE HORNEAR ESQUIVEL LBS', '8', 'USD$', '0.34', '1', '1.26', '0.43', '2021-04-12', 1, NULL, NULL, NULL, '1'),
(950, 'B00001', 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', NULL, 'PLUS PAN DURANGO LBS. ', '8', 'USD$', '1.75', '1', '1.05', '1.84', '2021-04-12', 1, NULL, NULL, NULL, '1'),
(951, 'B00001', 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', NULL, 'MANTECA VEGETAL AMBAR. LBS.', '8', 'USD$', '0.62', '1', '8.70', '5.39', '2021-04-12', 1, NULL, NULL, NULL, '1'),
(952, 'B00001', 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', NULL, 'HUEVOS CATALANA U. 1700+ DE 57 GM ', '11', 'USD$', '0.07', '1', '283.00', '19.81', '2021-04-12', 1, NULL, NULL, NULL, '1'),
(953, 'B00001', 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', NULL, 'AGUA ', '8', 'USD$', '0.00', '1', '17.01', '0.00', '2021-04-12', 1, NULL, NULL, NULL, '1'),
(954, 'B00001', 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', NULL, 'BIDON DE ACEITE VEGETAL', '8', 'USD$', '0.77', '1', '17.55', '13.51', '2021-04-12', 1, NULL, NULL, NULL, '1'),
(955, 'B00001', 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', NULL, 'CONCENTRADO DE LECHE HERMEL LBS ', '8', 'USD$', '3.63', '1', '0.18', '0.66', '2021-04-12', 1, NULL, NULL, NULL, '1'),
(956, 'B00001', 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', NULL, 'PROPINATO DE SODIO DURANGO LBS. ', '8', 'USD$', '1.64', '1', '0.84', '1.38', '2021-04-12', 1, NULL, NULL, NULL, '1'),
(957, 'B00001', 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', NULL, 'ACIDO SORBICO DINQUISA', '8', 'USD$', '3.34', '1', '0.54', '1.80', '2021-04-12', 1, NULL, NULL, NULL, '1'),
(958, 'B00001', 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', NULL, 'HIELO', '8', 'USD$', '0.04', '1', '5.30', '0.21', '2021-04-12', 1, NULL, NULL, NULL, '1'),
(959, 'B00001', 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', NULL, 'HARINA FUERTE PANADERO LIBRAS', '8', 'USD$', '0.24', '1', '10.00', '2.40', '2021-04-12', 1, NULL, NULL, NULL, '1'),
(960, 'B00001', 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', NULL, 'AZUCAR GLASS LEVADURAS LBS. ', '8', 'USD$', '0.37', '1', '30.00', '11.10', '2021-04-12', 1, NULL, NULL, NULL, '1'),
(961, 'B00001', 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', NULL, 'CONCENTRADO DE VAINILLA OSCURA HERMEL LBS. ', '8', 'USD$', '0.52', '1', '0.06', '0.03', '2021-04-12', 1, NULL, NULL, NULL, '1'),
(962, 'B00001', 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', NULL, 'AGUA ', '8', 'USD$', '0.00', '1', '3.00', '0.00', '2021-04-12', 1, NULL, NULL, NULL, '1'),
(963, 'B00001', 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', NULL, 'PASAS', '8', 'USD$', '1.82', '1', '4.00', '7.28', '2021-04-12', 1, NULL, NULL, NULL, '1'),
(964, 'B00001', 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', NULL, 'ALMENDRA', '8', 'USD$', '5.66', '1', '3.00', '16.98', '2021-04-12', 1, NULL, NULL, NULL, '1'),
(965, 'B00001', 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', NULL, 'CAJA TRANSP. 241654 INIX UNDS. ', '11', 'USD$', '0.17', '1', '108.00', '18.36', '2021-04-12', 1, NULL, NULL, NULL, '1'),
(966, 'B00001', 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', NULL, 'MANO DE OBRA DIRECTA', '2', 'USD$', '0.04', '1', '210.00', '8.40', '2021-04-12', 1, NULL, NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_dproducto`
--

DROP TABLE IF EXISTS `detalle_dproducto`;
CREATE TABLE `detalle_dproducto` (
  `id_detalle_Dproducto` int(11),
  `numero_Dproducto` varchar(100),
  `productoc` varchar(100),
  `id_Mprima` int(11),
  `materiales` varchar(100),
  `unidadm` enum('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14'),
  `moneda` varchar(100),
  `precio` decimal(11,6),
  `cantidad` decimal(11,6),
  `importe` decimal(11,6),
  `fecha_Dproducto` date,
  `id_usuario` int(11),
  `id_producto` int(11),
  `estado` enum('0','1')
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_dproducto`
--

INSERT INTO `detalle_dproducto` (`id_detalle_Dproducto`, `numero_Dproducto`, `productoc`, `id_Mprima`, `materiales`, `unidadm`, `moneda`, `precio`, `cantidad`, `importe`, `fecha_Dproducto`, `id_usuario`, `id_producto`, `estado`) VALUES
(18, 'F00001', 'MUFFIN DE PASAS Y ALMENDRAS ', 90, 'HARINA SPECIAL GOLDEN CAKE (BATIDO) LBS', '8', 'USD$', '0.22', '31.380000', '6.83', '2021-04-09', 1, 14, '1'),
(19, 'F00001', 'MUFFIN DE PASAS Y ALMENDRAS ', 116, 'SINER BAKER DURANGO LBS', '8', 'USD$', '1.32', '23.400000', '30.89', '2021-04-09', 1, 14, '1'),
(20, 'F00001', 'MUFFIN DE PASAS Y ALMENDRAS ', 48, 'AZUCAR BLANCA DIZUCAR SACO LBS. ', '8', 'USD$', '0.28', '31.380000', '8.87', '2021-04-09', 1, 14, '1'),
(21, 'F00001', 'MUFFIN DE PASAS Y ALMENDRAS ', 46, 'ALMIDON DE MAIZ CARIBE. LBS. ', '8', 'USD$', '0.28', '2.640000', '0.73', '2021-04-09', 1, 14, '1'),
(22, 'F00001', 'MUFFIN DE PASAS Y ALMENDRAS ', 108, 'POLVO DE HORNEAR ESQUIVEL LBS', '8', 'USD$', '0.34', '1.260000', '0.42', '2021-04-09', 1, 14, '1'),
(23, 'F00001', 'MUFFIN DE PASAS Y ALMENDRAS ', 107, 'PLUS PAN DURANGO LBS. ', '8', 'USD$', '1.75', '1.050000', '1.84', '2021-04-09', 1, 14, '1'),
(24, 'F00001', 'MUFFIN DE PASAS Y ALMENDRAS ', 97, 'MANTECA VEGETAL AMBAR. LBS.', '8', 'USD$', '0.62', '8.700000', '5.39', '2021-04-09', 1, 14, '1'),
(25, 'F00001', 'MUFFIN DE PASAS Y ALMENDRAS ', 92, 'HUEVOS CATALANA U. 1700+ DE 57 GM ', '11', 'USD$', '0.07', '283.000000', '18.40', '2021-04-09', 1, 14, '1'),
(26, 'F00001', 'MUFFIN DE PASAS Y ALMENDRAS ', 125, 'AGUA ', '8', 'USD$', '0.00', '17.010000', '0.01', '2021-04-09', 1, 14, '1'),
(27, 'F00001', 'MUFFIN DE PASAS Y ALMENDRAS ', 174, 'BIDON DE ACEITE VEGETAL', '8', 'USD$', '0.77', '17.550000', '13.51', '2021-04-09', 1, 14, '1'),
(28, 'F00001', 'MUFFIN DE PASAS Y ALMENDRAS ', 66, 'CONCENTRADO DE LECHE HERMEL LBS ', '8', 'USD$', '3.63', '0.180500', '0.65', '2021-04-09', 1, 14, '1'),
(29, 'F00001', 'MUFFIN DE PASAS Y ALMENDRAS ', 110, 'PROPINATO DE SODIO DURANGO LBS. ', '8', 'USD$', '1.64', '0.840000', '1.37', '2021-04-09', 1, 14, '1'),
(30, 'F00001', 'MUFFIN DE PASAS Y ALMENDRAS ', 21, 'ACIDO SORBICO DINQUISA', '8', 'USD$', '3.34', '0.540000', '1.80', '2021-04-09', 1, 14, '1'),
(31, 'F00001', 'MUFFIN DE PASAS Y ALMENDRAS ', 124, 'HIELO', '8', 'USD$', '0.04', '5.300000', '0.21', '2021-04-09', 1, 14, '1'),
(32, 'F00001', 'MUFFIN DE PASAS Y ALMENDRAS ', 87, 'HARINA FUERTE PANADERO LIBRAS', '8', 'USD$', '0.24', '10.000000', '2.39', '2021-04-09', 1, 14, '1'),
(33, 'F00001', 'MUFFIN DE PASAS Y ALMENDRAS ', 49, 'AZUCAR GLASS LEVADURAS LBS. ', '8', 'USD$', '0.37', '30.000000', '11.15', '2021-04-09', 1, 14, '1'),
(34, 'F00001', 'MUFFIN DE PASAS Y ALMENDRAS ', 69, 'CONCENTRADO DE VAINILLA OSCURA HERMEL LBS. ', '8', 'USD$', '0.52', '0.062500', '0.03', '2021-04-09', 1, 14, '1'),
(35, 'F00001', 'MUFFIN DE PASAS Y ALMENDRAS ', 125, 'AGUA ', '8', 'USD$', '0.00', '3.000000', '0.00', '2021-04-09', 1, 14, '1'),
(36, 'F00001', 'MUFFIN DE PASAS Y ALMENDRAS ', 196, 'PASAS', '8', 'USD$', '1.82', '4.000000', '7.27', '2021-04-09', 1, 14, '1'),
(37, 'F00001', 'MUFFIN DE PASAS Y ALMENDRAS ', 197, 'ALMENDRA', '8', 'USD$', '5.66', '3.000000', '16.98', '2021-04-09', 1, 14, '1'),
(38, 'F00001', 'MUFFIN DE PASAS Y ALMENDRAS ', 37, 'CAJA TRANSP. 241654 INIX UNDS. ', '11', 'USD$', '0.17', '108.000000', '18.36', '2021-04-09', 1, 14, '1'),
(39, 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', 160, 'HARINA ESPECIAL GUMARSAL BOLSA DE LBS ', '8', 'USD$', '0.19', '31.380000', '5.97', '2021-04-09', 1, 14, '1'),
(40, 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', 116, 'SINER BAKER DURANGO LBS', '8', 'USD$', '1.32', '23.400000', '30.89', '2021-04-09', 1, 14, '1'),
(41, 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', 48, 'AZUCAR BLANCA DIZUCAR SACO LBS. ', '8', 'USD$', '0.28', '31.380000', '8.87', '2021-04-09', 1, 14, '1'),
(42, 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', 46, 'ALMIDON DE MAIZ CARIBE. LBS. ', '8', 'USD$', '0.28', '2.640000', '0.73', '2021-04-09', 1, 14, '1'),
(43, 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', 108, 'POLVO DE HORNEAR ESQUIVEL LBS', '8', 'USD$', '0.34', '1.260000', '0.42', '2021-04-09', 1, 14, '1'),
(44, 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', 107, 'PLUS PAN DURANGO LBS. ', '8', 'USD$', '1.75', '1.050000', '1.84', '2021-04-09', 1, 14, '1'),
(45, 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', 97, 'MANTECA VEGETAL AMBAR. LBS.', '8', 'USD$', '0.62', '8.700000', '5.39', '2021-04-09', 1, 14, '1'),
(46, 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', 92, 'HUEVOS CATALANA U. 1700+ DE 57 GM ', '11', 'USD$', '0.07', '283.000000', '18.40', '2021-04-09', 1, 14, '1'),
(47, 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', 125, 'AGUA ', '8', 'USD$', '0.00', '17.010000', '0.01', '2021-04-09', 1, 14, '1'),
(48, 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', 174, 'BIDON DE ACEITE VEGETAL', '8', 'USD$', '0.77', '17.550000', '13.51', '2021-04-09', 1, 14, '1'),
(49, 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', 66, 'CONCENTRADO DE LECHE HERMEL LBS ', '8', 'USD$', '3.63', '0.180500', '0.65', '2021-04-09', 1, 14, '1'),
(50, 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', 110, 'PROPINATO DE SODIO DURANGO LBS. ', '8', 'USD$', '1.64', '0.840000', '1.37', '2021-04-09', 1, 14, '1'),
(51, 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', 21, 'ACIDO SORBICO DINQUISA', '8', 'USD$', '3.34', '0.540000', '1.80', '2021-04-09', 1, 14, '1'),
(52, 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', 124, 'HIELO', '8', 'USD$', '0.04', '5.300000', '0.21', '2021-04-09', 1, 14, '1'),
(53, 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', 87, 'HARINA FUERTE PANADERO LIBRAS', '8', 'USD$', '0.24', '10.000000', '2.39', '2021-04-09', 1, 14, '1'),
(54, 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', 49, 'AZUCAR GLASS LEVADURAS LBS. ', '8', 'USD$', '0.37', '30.000000', '11.15', '2021-04-09', 1, 14, '1'),
(55, 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', 69, 'CONCENTRADO DE VAINILLA OSCURA HERMEL LBS. ', '8', 'USD$', '0.52', '0.062500', '0.03', '2021-04-09', 1, 14, '1'),
(56, 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', 125, 'AGUA ', '8', 'USD$', '0.00', '3.000000', '0.00', '2021-04-09', 1, 14, '1'),
(57, 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', 196, 'PASAS', '8', 'USD$', '1.82', '4.000000', '7.27', '2021-04-09', 1, 14, '1'),
(58, 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', 197, 'ALMENDRA', '8', 'USD$', '5.66', '3.000000', '16.98', '2021-04-09', 1, 14, '1'),
(59, 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', 37, 'CAJA TRANSP. 241654 INIX UNDS. ', '11', 'USD$', '0.17', '108.000000', '18.36', '2021-04-09', 1, 14, '1'),
(60, 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', 198, 'MANO DE OBRA DIRECTA', '2', 'USD$', '0.04', '210.000000', '8.02', '2021-04-09', 1, 14, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dproducto`
--

DROP TABLE IF EXISTS `dproducto`;
CREATE TABLE `dproducto` (
  `id_Dproducto` int(11),
  `fecha_Dproducto` date,
  `numero_Dproducto` varchar(100),
  `productoc` varchar(100),
  `rinde` varchar(100),
  `costo` decimal(11,6),
  `categoria` varchar(100),
  `moneda` varchar(100),
  `subtotal` decimal(7,2),
  `total` decimal(7,2),
  `estado` enum('0','1'),
  `id_producto` int(11),
  `id_usuario` int(11)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `dproducto`
--

INSERT INTO `dproducto` (`id_Dproducto`, `fecha_Dproducto`, `numero_Dproducto`, `productoc`, `rinde`, `costo`, `categoria`, `moneda`, `subtotal`, `total`, `estado`, `id_producto`, `id_usuario`) VALUES
(15, '2021-04-09', 'F00001', 'MUFFIN DE PASAS Y ALMENDRAS ', '108', '0.24', '26', 'USD$', '147.10', '147.10', '1', 14, 1),
(16, '2021-04-09', 'F00002', 'MUFFIN DE PASAS Y ALMENDRAS ', '108', '0.24', '26', 'USD$', '154.26', '154.26', '1', 14, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dproducto_cfabricacion`
--

DROP TABLE IF EXISTS `dproducto_cfabricacion`;
CREATE TABLE `dproducto_cfabricacion` (
  `id_Dproducto_Cfabricacion` int(11) NOT NULL,
  `id_Dproducto` int(11) NOT NULL,
  `id_Cfabricacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dproducto_mprima`
--

DROP TABLE IF EXISTS `dproducto_mprima`;
CREATE TABLE `dproducto_mprima` (
  `id_Dproducto_Mprima` int(11) NOT NULL,
  `id_Dproducto` int(11) NOT NULL,
  `id_Mprima` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mprima`
--

DROP TABLE IF EXISTS `mprima`;
CREATE TABLE `mprima` (
  `id_Mprima` int(11) NOT NULL,
  `materiales` text NOT NULL,
  `unidadm` enum('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14') NOT NULL,
  `moneda` varchar(45) NOT NULL,
  `precio` decimal(11,6) NOT NULL,
  `stock` varchar(45) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mprima`
--

INSERT INTO `mprima` (`id_Mprima`, `materiales`, `unidadm`, `moneda`, `precio`, `stock`, `estado`, `id_usuario`) VALUES
(16, 'HARINA GOLDEN CAKE CHAVARRIA LBS', '8', 'USD$', '0.199100', '300', '1', 1),
(17, 'MORADO LILA LIQ PASTELES ', '8', 'USD$', '7.760000', '0', '1', 1),
(18, 'SAL COCESAL', '8', 'USD$', '0.072900', '3.5', '1', 1),
(19, 'VAINILLA EN POLVO DURANGO', '8', 'USD$', '8.068100', '0.15', '1', 1),
(21, 'ACIDO SORBICO DINQUISA', '8', 'USD$', '3.340900', '1.08', '1', 1),
(22, 'AJONJOLI LEVADURA UNIVERSAL', '8', 'USD$', '1.769900', '0', '1', 1),
(23, 'AJONJOLI DISTRIBUIDORA CARIBE', '8', 'USD$', '0.276800', '0', '1', 1),
(24, 'VINAGRE DE PINA HERME', '8', 'USD$', '0.225000', '111', '1', 1),
(25, 'BOBINA PANQUESITO ', '11', 'USD$', '5.500000', '0', '1', 1),
(26, 'BOBINA PARA CONCHA TOTO', '11', 'USD$', '121.934600', '0', '1', 1),
(27, 'BOBINA PARA OREJA', '11', 'USD$', '121.934600', '0', '1', 1),
(28, 'BOBINA SECA CATORCE PULGADAS BOLPACK', '11', 'USD$', '85.930000', '0', '1', 1),
(29, 'BOBINA PARA SEMITA ALTA DOCE PULG TOTO', '11', 'USD$', '98.586900', '0', '1', 1),
(30, 'BOLSA 5X13 TOTO', '11', 'USD$', '0.013700', '0', '1', 1),
(31, 'BOLSA 6.50X16.75 TRANSPARENTE PARA QUEIQUITO UN. ', '11', 'USD$', '0.040400', '0', '1', 1),
(32, 'BOLSA 9X14X70 TOTO U. ', '11', 'USD$', '0.009100', '0', '1', 1),
(33, 'BOLSA DE 12X18 TAMOSA FARDOS Un. ', '11', 'USD$', '0.017300', '0', '1', 1),
(34, 'BOLSA DE GABACHA #3 (TOTO) PAQ 4000 UNI', '11', 'USD$', '0.018200', '0', '1', 1),
(35, 'BOLSA DE GABACHA #4 (TOTO) PAQ 2000 UNI', '11', 'USD$', '0.034100', '0', '1', 1),
(36, 'CAJA GP305P/PAN28.8x19x9.2.UNIDS BAJO', '11', 'USD$', '0.250000', '0', '1', 1),
(37, 'CAJA TRANSP. 241654 INIX UNDS. ', '11', 'USD$', '0.170000', '216', '1', 1),
(38, 'CORRUGADO # 9.DURANGO. UNDS. ', '4', 'USD$', '3.000000', '0', '1', 1),
(39, 'CORRUGADO BLANCO # 2. UND. ', '4', 'USD$', '1.236800', '0', '1', 1),
(40, 'CORRUGADO BLANCO # 6 . UNDS ', '4', 'USD$', '1.991300', '0', '1', 1),
(41, 'CORRUGADO BLANCO #4. UNDS. ', '4', 'USD$', '0.003000', '0', '1', 1),
(42, 'DOMO GP 200 UNDS', '11', 'USD$', '0.210000', '0', '1', 1),
(43, 'ROLLO FILL DIASA CAJA', '11', 'USD$', '13.382800', '0', '1', 1),
(44, 'ACEITE MAMA LILA LBS. ', '8', 'USD$', '0.618900', '0', '1', 1),
(45, 'ACIDO CITRICO DINQUISA LBS', '8', 'USD$', '0.522700', '0', '1', 1),
(46, 'ALMIDON DE MAIZ CARIBE. LBS. ', '8', 'USD$', '0.276800', '5.28', '1', 1),
(47, 'AMARILLO LIQ. PASTELES DE LBS. ', '8', 'USD$', '8.000000', '0', '1', 1),
(48, 'AZUCAR BLANCA DIZUCAR SACO LBS. ', '8', 'USD$', '0.282700', '212.76', '1', 1),
(49, 'AZUCAR GLASS LEVADURAS LBS. ', '8', 'USD$', '0.371800', '60', '1', 1),
(50, 'AZUL LIQ. P/PASTELES LBS. ', '8', 'USD$', '8.000000', '0', '1', 1),
(51, 'BENZOATO DINQUISA LBS. ', '8', 'USD$', '1.477300', '0', '1', 1),
(52, 'BLOQUES DE MASA HOJALDRE AISCO LBS.', '8', 'USD$', '0.516400', '0', '1', 1),
(53, 'CAFE LIQ.P/PASTELES HERMEL LBS', '8', 'USD$', '8.000000', '0', '1', 1),
(54, 'CANELA EN POLVO LGL LB. ', '8', 'USD$', '3.328900', '0', '1', 1),
(55, 'COCO RAYADO. ALEXAN LBS.', '8', 'USD$', '2.789900', '0', '1', 1),
(56, 'COCOA PURA DURANGO LBS', '8', 'USD$', '1.993400', '0', '1', 1),
(57, 'COLOR AMARILLO HUEVO LGL. LBS', '8', 'USD$', '1.875200', '0', '1', 1),
(58, 'COLOR BLANCO HERMEL LBS ', '8', 'USD$', '2.545500', '0', '1', 1),
(59, 'COLOR INGLES AMARILLO HUEVO. DEL CARIBE. LBS.', '8', 'USD$', '1.295200', '0', '1', 1),
(60, 'COLOR OREO DURANGO LBS. ', '8', 'USD$', '12.500000', '0', '1', 1),
(61, 'COLOR ROJO HERMEL LBS ', '8', 'USD$', '2.663400', '0', '1', 1),
(62, 'CONCENTRADO CHOCOLATE HERMEL LBS ', '8', 'USD$', '11.875000', '0.25', '1', 1),
(63, 'CONCENTRADO COCO HERMEL LBS ', '8', 'USD$', '6.375000', '0', '1', 1),
(64, 'CONCENTRADO DE CANELA HERMEL LBS ', '8', 'USD$', '7.373600', '0', '1', 1),
(65, 'CONCENTRADO DE FRESA HERMEL LBS. ', '8', 'USD$', '5.875000', '0', '1', 1),
(66, 'CONCENTRADO DE LECHE HERMEL LBS ', '8', 'USD$', '3.625000', '0.361', '1', 1),
(67, 'CONCENTRADO DE MANTEQUILLA HERNEL LBS. ', '8', 'USD$', '9.750000', '0', '1', 1),
(68, 'CONCENTRADO DE QUESO HERMEL LBS. ', '8', 'USD$', '9.312500', '0', '1', 1),
(69, 'CONCENTRADO DE VAINILLA OSCURA HERMEL LBS. ', '8', 'USD$', '0.524600', '0.25', '1', 1),
(70, 'CREMA BAVARA MANGA BACKEN LBS. ', '8', 'USD$', '1.681416', '0', '1', 1),
(71, 'DESMOLDANTE CARIBE CUBETA DE LBS. ', '8', 'USD$', '2.123000', '0', '1', 1),
(72, 'DUBOR AISO LBS', '8', 'USD$', '2.766700', '0', '1', 1),
(73, 'DULCE DE LECHE CUBETA DE LBS. ', '8', 'USD$', '1.455400', '0', '1', 1),
(74, 'FRUTA CRISTALIZADA. LBS ', '8', 'USD$', '43.310000', '0', '1', 1),
(75, 'GRANILLO DE CHOCOLATE DURANGO. LBS ', '8', 'USD$', '2.181800', '0', '1', 1),
(76, 'HORA MASERO OP01', '2', 'USD$', '1.670000', '0', '1', 1),
(77, 'HORA OPERARIO OP02', '2', 'USD$', '1.270000', '0', '1', 1),
(78, 'HORA HORNERO OP03', '2', 'USD$', '1.680000', '0', '1', 1),
(79, 'GRANILLO DE NARANJA DURANGO', '8', 'USD$', '1.977300', '0', '1', 1),
(80, 'GRANILLO DE VAINILLA', '8', 'USD$', '1.090900', '0', '1', 1),
(81, 'GRASA ESPECIALIZADA HOJALDRE . LBS ', '8', 'USD$', '0.619400', '0', '1', 1),
(82, 'HARINA SEMIFUERTE HARIMASA LBS. ', '8', 'USD$', '0.221200', '0', '1', 1),
(83, 'HARINA ALTA EN PROTEINAS LIBRA', '8', 'USD$', '0.216800', '0', '1', 1),
(84, 'HARINA DE ARROZ PROVAPAN SACO LB ', '8', 'USD$', '0.279800', '0', '1', 1),
(85, 'HARINA EL PANADERO FUERTE CHAVARRIA LBS. ', '8', 'USD$', '0.238900', '0', '1', 1),
(86, 'HARINA FUERTE HARIMASA', '8', 'USD$', '0.224200', '0', '1', 1),
(87, 'HARINA FUERTE PANADERO LIBRAS', '8', 'USD$', '0.238900', '20', '1', 1),
(88, 'HARINA GOLDEN CAKE CHAVARRIA LBS', '8', 'USD$', '0.199100', '0', '1', 1),
(89, 'HARINA SEMIFUERTE GUMARSAL LBS.', '8', 'USD$', '0.221200', '0', '1', 1),
(90, 'HARINA SPECIAL GOLDEN CAKE (BATIDO) LBS', '8', 'USD$', '0.217700', '31.38', '1', 1),
(91, 'HARINA SUAVE HARIMASA', '8', 'USD$', '0.194300', '0', '1', 1),
(92, 'HUEVOS CATALANA U. 1700+ DE 57 GM ', '11', 'USD$', '0.065000', '566', '1', 1),
(93, 'IMPRUVER AIS SACO LBS ', '8', 'USD$', '1.350000', '0', '1', 1),
(94, 'JALEA DE PINA CAJAS DE LBS', '8', 'USD$', '0.325600', '0', '1', 1),
(95, 'LEVADURA NEVADA DURANGO LBS. ', '8', 'USD$', '2.180000', '0', '1', 1),
(96, 'MANI A GRANEL LB ', '8', 'USD$', '1.463700', '0', '1', 1),
(97, 'MANTECA VEGETAL AMBAR. LBS.', '8', 'USD$', '0.619469', '17.4', '1', 1),
(98, 'MERENGO EN POLVO . ENCO LBS ', '8', 'USD$', '6.692300', '0', '1', 1),
(99, 'MERMELADA DE FRESA LOS PINOS LBS ', '8', 'USD$', '1.902000', '0', '1', 1),
(100, 'MERMELADA DE GUAYABA CUBETA 5.KG', '8', 'USD$', '1.045900', '0', '1', 1),
(101, 'MOLVAN EFCO GL(LEVADURAS UNIVERSAL) LBS ', '8', 'USD$', '72.000000', '0', '1', 1),
(102, 'MTCA. CAPULLO VEGETAL LBS. ', '8', 'USD$', '0.548700', '0', '1', 1),
(103, 'NARANJA LIQ. PASTELES HERMEL LBS ', '8', 'USD$', '7.988600', '0', '1', 1),
(104, 'NEGRO LIQ. PASTELES HERMEL LBS', '8', 'USD$', '7.760000', '0', '1', 1),
(105, 'PAPELILLO CHINO', '11', 'USD$', '0.010200', '0', '1', 1),
(106, 'PIXI FINO BAZZINI LB ', '8', 'USD$', '0.647400', '9', '1', 1),
(107, 'PLUS PAN DURANGO LBS. ', '8', 'USD$', '1.750100', '2.1', '1', 1),
(108, 'POLVO DE HORNEAR ESQUIVEL LBS', '8', 'USD$', '0.335600', '2.52', '1', 1),
(109, 'PROPINATO DE CALCIO DURANGO LBS. ', '8', 'USD$', '1.636400', '0', '1', 1),
(110, 'PROPINATO DE SODIO DURANGO LBS. ', '8', 'USD$', '1.636400', '1.68', '1', 1),
(111, 'QUESO DURO LB.', '8', 'USD$', '2.300000', '0', '1', 1),
(112, 'ROJO INTENSO LIQ. HERMEL. LBS', '8', 'USD$', '8.000000', '0', '1', 1),
(113, 'ROSADO FUCSIA HERMEL LBS.', '8', 'USD$', '8.000000', '0', '1', 1),
(114, 'ROSADO LIQ. PASTELEES LBS. ', '8', 'USD$', '8.000000', '0', '1', 1),
(115, 'SABOR DE PIÑA EN POLVO HERMEL LBS ', '8', 'USD$', '5.193500', '2', '1', 1),
(116, 'SINER BAKER DURANGO LBS', '8', 'USD$', '1.320000', '47.95', '1', 1),
(117, 'SORBATO DE POTASIO DINQUIZA LBS. ', '8', 'USD$', '2.500000', '0', '1', 1),
(118, 'SUERO DE LECHE DINQUISA LBS. ', '8', 'USD$', '0.491700', '1', '1', 1),
(119, 'SUPER AROMA DE PIÑA ESQ. LBS. ', '8', 'USD$', '4.876500', '0', '1', 1),
(120, 'SUPER AROMA DE VAINILLA ESQ. LBS. ', '8', 'USD$', '5.000000', '0', '1', 1),
(121, 'VERDE LIQ. PASTELES HERMEL. LBS', '8', 'USD$', '8.000000', '1', '1', 1),
(122, 'LEVADURA ROJA', '8', 'USD$', '2.180000', '0', '1', 1),
(123, 'CAJA INIXS 2212-53', '11', 'USD$', '0.190000', '0', '1', 1),
(124, 'HIELO', '8', 'USD$', '0.040000', '10.6', '1', 1),
(125, 'AGUA ', '8', 'USD$', '0.000870', '40.02', '1', 1),
(126, 'CANELA EN RAJA', '8', 'USD$', '8.390000', '0', '1', 1),
(127, 'AFRECHO', '8', 'USD$', '0.124700', '0', '1', 1),
(128, 'BOBINA DE CHOCOLATE 11PULG. KGS. ', '8', 'USD$', '85.930000', '0', '1', 1),
(129, 'BOBINA P/CHAPINA Y PANQ. 10 PULG. BOLPACK KGS. ', '8', 'USD$', '77.993600', '0', '1', 1),
(130, 'BOBINA PARA CANELA 11 PULG. KGS. ', '11', 'USD$', '85.930000', '0', '1', 1),
(131, 'BOBINA PARA COCO 11 PULG. BOLPACK KGS. ', '11', 'USD$', '85.930000', '0', '1', 1),
(132, 'BOBINA PARA MARG. MIXTA 11 PULG. BOLPACK KGS. ', '11', 'USD$', '85.930000', '0', '1', 1),
(133, 'BOBINA PARA MARGARITA LIDO DE 11 PULGADAS', '11', 'USD$', '87.950000', '0', '1', 1),
(134, 'BOBINA PARA SALPOR DE ARROZ KGS. ', '11', 'USD$', '85.930000', '0', '1', 1),
(135, 'BOBINA STRUDENT 12 PULGADAS BOLPACK ', '11', 'USD$', '85.847100', '0', '1', 1),
(136, 'BOLSA DE 9*14 THAMOSA FARDOS UN. ', '11', 'USD$', '0.008600', '0', '1', 1),
(137, 'BOLSA SAMSIL 8.75*14 THERMO PLAST. UN. ', '11', 'USD$', '0.009400', '306', '1', 1),
(138, 'CAJA 2020-43 8X8X3 UNDS. ', '11', 'USD$', '0.140000', '0', '1', 1),
(139, 'CAJA 2212-53 INIX UNDS. ', '11', 'USD$', '0.117900', '0', '1', 1),
(140, 'CORRUGADO #2 UNDS ESQUIVEL', '11', 'USD$', '0.010000', '0', '1', 1),
(141, 'DOMO 9*9 INIX UNDS', '11', 'USD$', '0.499000', '0', '1', 1),
(142, 'DOMO 9X9 PARA 8 UNIDS ', '11', 'USD$', '0.179800', '0', '1', 1),
(143, 'DOMO TRANSP. DE 9 A - UNDS', '11', 'USD$', '0.116000', '0', '1', 1),
(144, 'EMAQUE VP 757 PÂ´/ENSALADA 21.4*20.8*8.4. UNDS. ', '11', 'USD$', '0.225300', '0', '1', 1),
(145, 'EMPAQUE GP125 DE UNDS. ', '11', 'USD$', '0.154700', '0', '1', 1),
(146, 'MOLDE ALUM DE 9 - 516 - 4 UNIDS', '11', 'USD$', '0.196500', '0', '1', 1),
(147, 'AFRECHO LBS. ', '8', 'USD$', '0.132000', '0', '1', 1),
(148, 'BICARBONATO DE SODIO DINQUIZA LBS. ', '8', 'USD$', '0.250000', '0', '1', 1),
(149, 'BICARBONATO HERMEL LBS. ', '8', 'USD$', '0.565900', '0.625', '1', 1),
(150, 'CARAMELO LIQ. LGL. GL.', '8', 'USD$', '1.880500', '0', '1', 1),
(151, 'COCO R. NARANJA LBS. ', '8', 'USD$', '2.120000', '0', '1', 1),
(152, 'COLOR CAFE CHOCOLATE . LGL LBS', '8', 'USD$', '4.827300', '0', '1', 1),
(153, 'COLOR CARAMELO LIQ. DEL CARIBE. LBS. ', '8', 'USD$', '0.951400', '0.25', '1', 1),
(154, 'COLOR CHOCOLATE HERMEL LBS. ', '8', 'USD$', '5.206400', '1', '1', 1),
(155, 'CONCENTRADO DE BANANo HERMEL LBS ', '8', 'USD$', '5.875000', '0', '1', 1),
(156, 'CONCENTRADO DE NARANJA HERMEL LBS. ', '8', 'USD$', '6.125000', '0', '1', 1),
(157, 'GLAZE DE FRESA LEVADURAS LBS ', '8', 'USD$', '1.750000', '0', '1', 1),
(158, 'HARINA DE ARROZ CEMERSA LBS. ', '8', 'USD$', '0.274300', '0', '1', 1),
(159, 'HARINA DE MAIZ GUMARSAL LBS', '8', 'USD$', '0.283200', '0', '1', 1),
(160, 'HARINA ESPECIAL GUMARSAL BOLSA DE LBS ', '8', 'USD$', '0.190300', '31.38', '1', 1),
(161, 'HARINA FUERTE GUMARSAL BOLSA DE LBS', '8', 'USD$', '0.221200', '0', '1', 1),
(162, 'HARINA SUAVE GALLETA GUMARSAL LBS. ', '8', 'USD$', '0.198900', '0', '1', 1),
(163, 'HUEVO ANDELSA CUBETA LB. ', '8', 'USD$', '1.100000', '0', '1', 1),
(164, 'MANTECA IND. FREEMAN LBS', '8', 'USD$', '0.451300', '0', '1', 1),
(165, 'PIXI CASA BAZZINI GRANDE LB ', '8', 'USD$', '0.650000', '1', '1', 1),
(166, 'POLVO DE HORNEAR FLEISCHMANN SACO LBS. ', '8', 'USD$', '0.300900', '3.5', '1', 1),
(167, 'SABOR DE FRESA EN POLVO HERMEL LBS. ', '8', 'USD$', '5.227300', '0', '1', 1),
(168, 'MIGA BLANCA ', '8', 'USD$', '1.000000', '4', '1', 1),
(169, 'BOBINA PARA MARGARITA LIDO DE 10 PULGADA ', '11', 'USD$', '85.930000', '0', '1', 1),
(170, 'BOBINA TRANSPARENTE', '11', 'USD$', '85.930000', '0', '1', 1),
(171, 'BOBINA MI PAN', '11', 'USD$', '85.930000', '0', '1', 1),
(172, 'LEVADURA DORADA DURANGO', '8', 'USD$', '2.420000', '0', '1', 1),
(173, 'JALEA DE GUAYABA PROVAPAN 20 LB', '8', 'USD$', '0.884900', '0', '1', 1),
(174, 'BIDON DE ACEITE VEGETAL', '8', 'USD$', '0.769565', '35.1', '1', 1),
(175, 'GLAZE DE VAINILLA', '8', 'USD$', '0.764300', '0', '1', 1),
(176, 'MANTECA VITINA', '8', 'USD$', '0.433600', '0', '1', 1),
(177, 'MANTECA COSTEÑA', '8', 'USD$', '0.575200', '0', '1', 1),
(178, 'ACEITE CRISTALINO PLASTICAJA', '0', 'USD$', '19.911500', '0', '1', 1),
(179, 'DESMOLDANTE P/LATAS Y MOLDES PV-23', '0', 'USD$', '79.000000', '0', '1', 1),
(180, 'ROJO LIQUIDO PASTELES', '8', 'USD$', '8.000000', '0', '1', 1),
(181, 'CORRUGADO BLANCO #5', '11', 'USD$', '1.593000', '0', '1', 1),
(182, 'BOLSA DE GABACHA #5 (TOTO) PAQ 500 UNI', '11', 'USD$', '0.256000', '0', '1', 1),
(183, 'JALEA DE HIGO', '11', 'USD$', '1.902000', '0', '1', 1),
(184, 'BRILLO NEUTRO', '11', 'USD$', '1.682000', '0', '1', 1),
(185, 'MERMELADA DE MANZANA', '11', 'USD$', '1.902000', '0', '1', 1),
(186, 'MARGARINA PASTELERA', '8', 'USD$', '22.123800', '0', '1', 1),
(187, 'DOMO GP 106', '11', 'USD$', '0.189700', '0', '1', 1),
(188, 'COLOR BLANCO LIQUIDO PASTELES', '8', 'USD$', '8.000000', '0', '1', 1),
(189, 'ESENCIA DE FRESA', '8', 'USD$', '0.525000', '0', '1', 1),
(190, 'ESENCIA DE BANANO', '8', 'USD$', '0.525000', '0', '1', 1),
(191, 'ESENCIA DE CANELA', '8', 'USD$', '0.531300', '0', '1', 1),
(192, 'MANTECA LA PATRONA', '8', 'USD$', '0.412700', '0', '1', 1),
(193, 'DESMOLDANTE STELLA', '8', 'USD$', '1.136400', '0', '1', 1),
(194, 'ESENCIA DE NARANJA', '8', 'USD$', '0.525000', '0', '1', 1),
(195, 'MANTECA COSTEÑA BATIDO', '8', 'USD$', '0.575200', '0', '1', 1),
(196, 'PASAS', '8', 'USD$', '1.818181', '8', '1', 1),
(197, 'ALMENDRA', '8', 'USD$', '5.660000', '6', '1', 1),
(198, 'MANO DE OBRA DIRECTA', '2', 'USD$', '0.038194', '210', '1', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

DROP TABLE IF EXISTS `permisos`;
CREATE TABLE `permisos` (
  `id_permiso` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_permiso`, `nombre`) VALUES
(1, 'Categoria'),
(2, 'producto'),
(3, 'Produccion'),
(4, 'Reportes'),
(5, 'Formulas'),
(6, 'Mprima'),
(7, 'Batida'),
(8, 'cif'),
(9, 'Usuarios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `productoc` varchar(100) NOT NULL,
  `rinde` varchar(100) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_cif` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `productoc`, `rinde`, `id_categoria`, `id_cif`, `fecha`, `estado`, `id_usuario`) VALUES
(14, 'MUFFIN DE PASAS Y ALMENDRAS ', '108', 26, 1, '2021-04-09', '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `dui` varchar(100) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `cargo` enum('0','1','2','3') NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `password2` varchar(100) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombres`, `apellidos`, `dui`, `telefono`, `correo`, `direccion`, `cargo`, `usuario`, `password`, `password2`, `fecha_ingreso`, `estado`) VALUES
(1, 'Wilbert', 'Palacios', '066669.1', '77022837', 'izzypalacio@outlook.com', 'San Salvador', '1', 'Wilbert ', 'Vampiros', 'Vampiros0', '2020-04-01', '1'),
(3, 'Jorge', 'Figueroa', '04569038-7', '74055615', 'jorge.figueroa@gruposamsil.com', 'Arce', '1', 'jfigueroa', '1234', '1234', '2021-01-21', '1'),
(4, 'Samuel', 'Rivera', '001245-1', '45788956', 'samuel.rivera@gruposamsil.com', 'san salvador', '1', 'srivera', '1234', '1234', '2021-04-09', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_permiso`
--

DROP TABLE IF EXISTS `usuario_permiso`;
CREATE TABLE `usuario_permiso` (
  `id_usuario_permiso` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario_permiso`
--

INSERT INTO `usuario_permiso` (`id_usuario_permiso`, `id_usuario`, `id_permiso`) VALUES
(140, 1, 1),
(141, 1, 2),
(142, 1, 3),
(143, 1, 4),
(144, 1, 5),
(145, 1, 6),
(146, 1, 7),
(147, 1, 8),
(148, 1, 9),
(156, 3, 1),
(157, 3, 2),
(158, 3, 3),
(159, 3, 4),
(160, 3, 5),
(161, 3, 6),
(162, 3, 7),
(163, 3, 8),
(164, 3, 9),
(165, 4, 1),
(166, 4, 2),
(167, 4, 3),
(168, 4, 4),
(169, 4, 5),
(170, 4, 6),
(171, 4, 7),
(172, 4, 8),
(173, 4, 9);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `batida`
--
ALTER TABLE `batida`
  ADD PRIMARY KEY (`id_Batida`),
  ADD KEY `fk_Batida_usuarios_idx` (`id_usuario`),
  ADD KEY `fk_Batida_producto_idx` (`id_producto`),
  ADD KEY `fk_Batida_Dproducto_idx` (`id_Dproducto`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `fk_categoria_usuarios_idx` (`id_usuario`);

--
-- Indices de la tabla `cfabricacion`
--
ALTER TABLE `cfabricacion`
  ADD PRIMARY KEY (`id_Cfabricacion`),
  ADD KEY `fk_Cfabricacion_usuarios_idx` (`id_usuario`);

--
-- Indices de la tabla `cif`
--
ALTER TABLE `cif`
  ADD PRIMARY KEY (`id_cif`),
  ADD KEY `fk_cif_usuarios_idx` (`id_usuario`);

--
-- Indices de la tabla `detalle_batida`
--
ALTER TABLE `detalle_batida`
  ADD PRIMARY KEY (`id_detalle_Batida`),
  ADD KEY `fk_detalle_Batida_Mprima_idx` (`id_Mprima`),
  ADD KEY `fk_detalle_Batida_usuario_idx` (`id_usuario`),
  ADD KEY `fk_detalle_Batida_producto_idx` (`id_producto`),
  ADD KEY `fk_detalle_Batida_Dproducto_idx` (`id_Dproducto`),
  ADD KEY `fk_detalle_Batida_detalle_Dproducto_idx` (`id_detalle_Dproducto`);

--
-- Indices de la tabla `detalle_dproducto`
--
ALTER TABLE `detalle_dproducto`
  ADD PRIMARY KEY (`id_detalle_Dproducto`),
  ADD KEY `fk_detalle_Dproducto_Mprima_idx` (`id_Mprima`),
  ADD KEY `fk_detalle_Dproducto_usuario_idx` (`id_usuario`),
  ADD KEY `fk_detalle_Dproducto_producto_idx` (`id_producto`);

--
-- Indices de la tabla `dproducto`
--
ALTER TABLE `dproducto`
  ADD PRIMARY KEY (`id_Dproducto`),
  ADD KEY `fk_Dproducto_usuarios_idx` (`id_usuario`),
  ADD KEY `fk_Dproducto_producto_idx` (`id_producto`);

--
-- Indices de la tabla `dproducto_cfabricacion`
--
ALTER TABLE `dproducto_cfabricacion`
  ADD PRIMARY KEY (`id_Dproducto_Cfabricacion`),
  ADD KEY `fk_DProducto_Cfabricacion_Dproducto_idx` (`id_Dproducto`),
  ADD KEY `fk_Dproducto_Cfabricacion_Cfabricacion_idx` (`id_Cfabricacion`);

--
-- Indices de la tabla `dproducto_mprima`
--
ALTER TABLE `dproducto_mprima`
  ADD PRIMARY KEY (`id_Dproducto_Mprima`),
  ADD KEY `fk_DProducto_Mprima_Dproducto_idx` (`id_Dproducto`),
  ADD KEY `fk_Dproducto_Mprima_Mprima_idx` (`id_Mprima`);

--
-- Indices de la tabla `mprima`
--
ALTER TABLE `mprima`
  ADD PRIMARY KEY (`id_Mprima`),
  ADD KEY `fk_Mprima_usuarios_idx` (`id_usuario`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_permiso`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `fk_producto_usuarios_idx` (`id_usuario`),
  ADD KEY `fk_producto_categoria_idx` (`id_categoria`),
  ADD KEY `fk_producto_cif_idx` (`id_cif`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD PRIMARY KEY (`id_usuario_permiso`),
  ADD KEY `fk_usuario_permiso_usuario_idx` (`id_usuario`),
  ADD KEY `fk_usuario_permiso_permiso_idx` (`id_permiso`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `batida`
--
ALTER TABLE `batida`
  MODIFY `id_Batida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `cfabricacion`
--
ALTER TABLE `cfabricacion`
  MODIFY `id_Cfabricacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `cif`
--
ALTER TABLE `cif`
  MODIFY `id_cif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `detalle_batida`
--
ALTER TABLE `detalle_batida`
  MODIFY `id_detalle_Batida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=967;

--
-- AUTO_INCREMENT de la tabla `detalle_dproducto`
--
ALTER TABLE `detalle_dproducto`
  MODIFY `id_detalle_Dproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `dproducto`
--
ALTER TABLE `dproducto`
  MODIFY `id_Dproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `dproducto_cfabricacion`
--
ALTER TABLE `dproducto_cfabricacion`
  MODIFY `id_Dproducto_Cfabricacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT de la tabla `dproducto_mprima`
--
ALTER TABLE `dproducto_mprima`
  MODIFY `id_Dproducto_Mprima` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT de la tabla `mprima`
--
ALTER TABLE `mprima`
  MODIFY `id_Mprima` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  MODIFY `id_usuario_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `batida`
--
ALTER TABLE `batida`
  ADD CONSTRAINT `fk_Batida_Dproducto` FOREIGN KEY (`id_Dproducto`) REFERENCES `dproducto` (`id_Dproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Batida_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Batida_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `fk_categoria_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cfabricacion`
--
ALTER TABLE `cfabricacion`
  ADD CONSTRAINT `fk_Cfabricacion_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cif`
--
ALTER TABLE `cif`
  ADD CONSTRAINT `fk_cif_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_batida`
--
ALTER TABLE `detalle_batida`
  ADD CONSTRAINT `fk_detalle_Batida_Dproducto` FOREIGN KEY (`id_Dproducto`) REFERENCES `dproducto` (`id_Dproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_Batida_Mprima` FOREIGN KEY (`id_Mprima`) REFERENCES `mprima` (`id_Mprima`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_Batida_detalle_Dproducto` FOREIGN KEY (`id_detalle_Dproducto`) REFERENCES `detalle_dproducto` (`id_detalle_Dproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_Batida_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_Batida_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_dproducto`
--
ALTER TABLE `detalle_dproducto`
  ADD CONSTRAINT `fk_detalle_Dproducto_Mprima` FOREIGN KEY (`id_Mprima`) REFERENCES `mprima` (`id_Mprima`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_Dproducto_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_Dproducto_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dproducto`
--
ALTER TABLE `dproducto`
  ADD CONSTRAINT `fk_DProducto_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_DProducto_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dproducto_cfabricacion`
--
ALTER TABLE `dproducto_cfabricacion`
  ADD CONSTRAINT `fk_DProducto_Cfabricacion_Cfabricacion` FOREIGN KEY (`id_Cfabricacion`) REFERENCES `cfabricacion` (`id_Cfabricacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_DProducto_Cfabricacion_DProducto` FOREIGN KEY (`id_Dproducto`) REFERENCES `dproducto` (`id_Dproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dproducto_mprima`
--
ALTER TABLE `dproducto_mprima`
  ADD CONSTRAINT `fk_DProducto_Mprima_DProducto` FOREIGN KEY (`id_Dproducto`) REFERENCES `dproducto` (`id_Dproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_DProducto_Mprima_Mprima` FOREIGN KEY (`id_Mprima`) REFERENCES `mprima` (`id_Mprima`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `mprima`
--
ALTER TABLE `mprima`
  ADD CONSTRAINT `fk_Mprima_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_producto_cif` FOREIGN KEY (`id_cif`) REFERENCES `cif` (`id_cif`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_producto_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD CONSTRAINT `fk_usuario_permiso_permiso` FOREIGN KEY (`id_permiso`) REFERENCES `permisos` (`id_permiso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_permiso_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

create database produccion;
use produccion;

CREATE TABLE IF NOT EXISTS `categoria` (
`id_categoria` int(11) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `id_usuario` int(11) NOT NULL
  ) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

INSERT INTO `categoria` (`id_categoria`, `categoria`, `estado`, `id_usuario`) VALUES
(24, 'Pan Tostado', '1', 1),
(25, 'Pan de Levadura', '1', 1),
(26, 'Pan de Batida', '1', 1);

  CREATE TABLE IF NOT EXISTS `permisos` (
`id_permiso` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

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


CREATE TABLE IF NOT EXISTS `cif` (
`id_cif` int(11),
  `planta` varchar(100),
  `costo` varchar(100),
  `estado` enum('0','1') NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

INSERT INTO `cif` (`id_cif`, `planta`, `costo`, `estado`, `id_usuario`) VALUES
(1, 'planta1', '0.06', '1', 1),
(2, 'planta2', '0.07', '1', 1),
(3, 'planta3', '0.08', '1', 1);

CREATE TABLE IF NOT EXISTS `producto` (
`id_producto` int(11) NOT NULL,
  `productoc` varchar(100) NOT NULL,
  `rinde` varchar(100) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_cif` int(11),
  `fecha` date NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;



CREATE TABLE IF NOT EXISTS `DProducto` (
`id_Dproducto` int(11) NOT NULL,
  `fecha_Dproducto` date NOT NULL,
  `numero_Dproducto` varchar(100) NOT NULL,
  `productoc` varchar(100) NOT NULL,
  `rinde` varchar(100),
  `costo` decimal(7,2),
  `categoria` varchar(100) NOT NULL,
  `moneda` varchar(100) NOT NULL,
  `subtotal` decimal(7,2) NOT NULL,
  `total` decimal(7,2) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `detalle_DProducto` (
`id_detalle_Dproducto` int(11) NOT NULL,
  `numero_Dproducto` varchar(100) NOT NULL,
  `productoc` varchar(100) NOT NULL,
  `id_Mprima` int(11) NOT NULL,
  `materiales` varchar(100) NOT NULL,
  `unidadm` enum('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14') NOT NULL,
  `moneda` varchar(100) NOT NULL,
  `precio` decimal(7,2) NOT NULL,
  `cantidad` decimal(11,6) NOT NULL,
  `importe` decimal(7,2) NOT NULL,
  `fecha_Dproducto` date NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `Batida` (
`id_Batida` int(11),
  `fecha_Batida` date,
  `numero_Batida` varchar(100),
  `numero_Dproducto` varchar(100),
  `productoc` varchar(100),
  `rinde` varchar(100),
  `costo` decimal(7,2),
  `margenu` decimal(7,2),
  `margenreal` decimal(7,2),
  `totalpro` decimal(7,2),
  `preciou` decimal(7,2),
  `categoria` varchar(100),
  `moneda` varchar(100),
  `subtotal` decimal(7,2),
  `total` decimal(7,2),
  `estado` enum('0','1'),
  `id_producto` int(11),
  `id_Dproducto` int(11),
  `id_usuario` int(11)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `detalle_Batida` (
`id_detalle_Batida` int(11),
  `numero_Batida` varchar(100),
  `numero_Dproducto` varchar(100),
  `productoc` varchar(100),
  `id_Mprima` int(11),
  `materiales` varchar(100),
  `unidadm` enum('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14') NOT NULL,
  `moneda` varchar(100),
  `precio` decimal(7,2),
  `Nbatida` varchar(100),
  `cantidad` decimal(7,2),
  `importe` decimal(7,2),
  `fecha_Batida` date,
  `id_usuario` int(11),
  `id_producto` int(11),
  `id_detalle_Dproducto` int(11),
  `id_Dproducto` int(11),
  `estado` enum('0','1')
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `DProducto_Mprima` (
`id_Dproducto_Mprima` int(11) NOT NULL,
`id_Dproducto` int(11) NOT NULL,
`id_Mprima` int(11) NOT NULL
)ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `DProducto_Cfabricacion` (
`id_Dproducto_Cfabricacion` int(11) NOT NULL,
`id_Dproducto` int(11) NOT NULL,
`id_Cfabricacion` int(11) NOT NULL
)ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `Mprima` (
`id_Mprima` int(11) NOT NULL,
  `materiales` text NOT NULL,
  `unidadm` enum('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14') NOT NULL,
  `moneda` varchar(45) NOT NULL,
  `precio` decimal(11,6) NOT NULL,
  `stock` varchar(45) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

INSERT INTO `Mprima` (`id_Mprima`, `materiales`, `unidadm`, `moneda`, `precio`, `stock`, `estado`, `id_usuario`) VALUES
(16, 'HARINA GOLDEN CAKE CHAVARRIA LBS', '8', 'USD$', '0.1991', '300', '1', 1),
(17, 'MORADO LILA LIQ PASTELES ', '8', 'USD$', '7.7600', '0', '1', 1),
(18, 'SAL COCESAL', '8', 'USD$', '0.0729', '3.5', '1', 1),
(19, 'VAINILLA EN POLVO DURANGO', '8', 'USD$', '8.0681', '0.15', '1', 1),
(21, 'ACIDO SORBICO DINQUISA', '8', 'USD$', '3.3409', '0', '1', 1),
(22, 'AJONJOLI LEVADURA UNIVERSAL', '8', 'USD$', '1.7699', '0', '1', 1),
(23, 'AJONJOLI DISTRIBUIDORA CARIBE', '8', 'USD$', '0.2768', '0', '1', 1),
(24, 'VINAGRE DE PINA HERME', '8', 'USD$', '0.2250', '111', '1', 1),
(25, 'BOBINA PANQUESITO ', '11', 'USD$', '5.5000', '0', '1', 1),
(26, 'BOBINA PARA CONCHA TOTO', '11', 'USD$', '121.9346', '0', '1', 1),
(27, 'BOBINA PARA OREJA', '11', 'USD$', '121.9346', '0', '1', 1),
(28, 'BOBINA SECA CATORCE PULGADAS BOLPACK', '11', 'USD$', '85.9300', '0', '1', 1),
(29, 'BOBINA PARA SEMITA ALTA DOCE PULG TOTO', '11', 'USD$', '98.5869', '0', '1', 1),
(30, 'BOLSA 5X13 TOTO', '11', 'USD$', '0.0137', '0', '1', 1),
(31, 'BOLSA 6.50X16.75 TRANSPARENTE PARA QUEIQUITO UN. ', '11', 'USD$', '0.0404', '0', '1', 1),
(32, 'BOLSA 9X14X70 TOTO U. ', '11', 'USD$', '0.0091', '0', '1', 1),
(33, 'BOLSA DE 12X18 TAMOSA FARDOS Un. ', '11', 'USD$', '0.0173', '0', '1', 1),
(34, 'BOLSA DE GABACHA #3 (TOTO) PAQ 4000 UNI', '11', 'USD$', '0.0182', '0', '1', 1),
(35, 'BOLSA DE GABACHA #4 (TOTO) PAQ 2000 UNI', '11', 'USD$', '0.0341', '0', '1', 1),
(36, 'CAJA GP305P/PAN28.8x19x9.2.UNIDS', '11', 'USD$', '0.2566', '0', '1', 1),
(37, 'CAJA TRANSP. 241654 INIX UNDS. ', '11', 'USD$', '0.1700', '0', '1', 1),
(38, 'CORRUGADO # 9.DURANGO. UNDS. ', '4', 'USD$', '3.0000', '0', '1', 1),
(39, 'CORRUGADO BLANCO # 2. UND. ', '4', 'USD$', '1.2368', '0', '1', 1),
(40, 'CORRUGADO BLANCO # 6 . UNDS ', '4', 'USD$', '1.9913', '0', '1', 1),
(41, 'CORRUGADO BLANCO #4. UNDS. ', '4', 'USD$', '0.0030', '0', '1', 1),
(42, 'DOMO GP 200 UNDS', '11', 'USD$', '0.2100', '0', '1', 1),
(43, 'ROLLO FILL DIASA CAJA', '11', 'USD$', '13.3828', '0', '1', 1),
(44, 'ACEITE MAMA LILA LBS. ', '8', 'USD$', '0.6189', '0', '1', 1),
(45, 'ACIDO CITRICO DINQUISA LBS', '8', 'USD$', '0.5227', '0', '1', 1),
(46, 'ALMIDON DE MAIZ CARIBE. LBS. ', '8', 'USD$', '0.2768', '0', '1', 1),
(47, 'AMARILLO LIQ. PASTELES DE LBS. ', '8', 'USD$', '8.0000', '0', '1', 1),
(48, 'AZUCAR BLANCA DIZUCAR SACO LBS. ', '8', 'USD$', '0.2827', '150', '1', 1),
(49, 'AZUCAR GLASS LEVADURAS LBS. ', '8', 'USD$', '0.3718', '0', '1', 1),
(50, 'AZUL LIQ. P/PASTELES LBS. ', '8', 'USD$', '8.0000', '0', '1', 1),
(51, 'BENZOATO DINQUISA LBS. ', '8', 'USD$', '1.4773', '0', '1', 1),
(52, 'BLOQUES DE MASA HOJALDRE AISCO LBS.', '8', 'USD$', '0.5164', '0', '1', 1),
(53, 'CAFE LIQ.P/PASTELES HERMEL LBS', '8', 'USD$', '8.0000', '0', '1', 1),
(54, 'CANELA EN POLVO LGL LB. ', '8', 'USD$', '3.3289', '0', '1', 1),
(55, 'COCO RAYADO. ALEXAN LBS.', '8', 'USD$', '2.7899', '0', '1', 1),
(56, 'COCOA PURA DURANGO LBS', '8', 'USD$', '1.9934', '0', '1', 1),
(57, 'COLOR AMARILLO HUEVO LGL. LBS', '8', 'USD$', '1.8752', '0', '1', 1),
(58, 'COLOR BLANCO HERMEL LBS ', '8', 'USD$', '2.5455', '0', '1', 1),
(59, 'COLOR INGLES AMARILLO HUEVO. DEL CARIBE. LBS.', '8', 'USD$', '1.2952', '0', '1', 1),
(60, 'COLOR OREO DURANGO LBS. ', '8', 'USD$', '12.5000', '0', '1', 1),
(61, 'COLOR ROJO HERMEL LBS ', '8', 'USD$', '2.6634', '0', '1', 1),
(62, 'CONCENTRADO CHOCOLATE HERMEL LBS ', '8', 'USD$', '11.8750', '0.25', '1', 1),
(63, 'CONCENTRADO COCO HERMEL LBS ', '8', 'USD$', '6.3750', '0', '1', 1),
(64, 'CONCENTRADO DE CANELA HERMEL LBS ', '8', 'USD$', '7.3736', '0', '1', 1),
(65, 'CONCENTRADO DE FRESA HERMEL LBS. ', '8', 'USD$', '5.8750', '0', '1', 1),
(66, 'CONCENTRADO DE LECHE HERMEL LBS ', '8', 'USD$', '3.6250', '0', '1', 1),
(67, 'CONCENTRADO DE MANTEQUILLA HERNEL LBS. ', '8', 'USD$', '9.7500', '0', '1', 1),
(68, 'CONCENTRADO DE QUESO HERMEL LBS. ', '8', 'USD$', '9.3125', '0', '1', 1),
(69, 'CONCENTRADO DE VAINILLA OSCURA HERMEL LBS. ', '8', 'USD$', '0.5246', '0.125', '1', 1),
(70, 'CREMA BAVARA MANGA BACKEN LBS. ', '8', 'USD$', '2.3868', '0', '1', 1),
(71, 'DESMOLDANTE CARIBE CUBETA DE LBS. ', '8', 'USD$', '2.1230', '0', '1', 1),
(72, 'DUBOR AISO LBS', '8', 'USD$', '2.7667', '0', '1', 1),
(73, 'DULCE DE LECHE CUBETA DE LBS. ', '8', 'USD$', '1.4554', '0', '1', 1),
(74, 'FRUTA CRISTALIZADA. LBS ', '8', 'USD$', '43.3100', '0', '1', 1),
(75, 'GRANILLO DE CHOCOLATE DURANGO. LBS ', '8', 'USD$', '2.1818', '0', '1', 1),
(76, 'HORA MASERO OP01', '2', 'USD$', '1.6700', '0', '1', 1),
(77, 'HORA OPERARIO OP02', '2', 'USD$', '1.2700', '0', '1', 1),
(78, 'HORA HORNERO OP03', '2', 'USD$', '1.6800', '0', '1', 1),
(79, 'GRANILLO DE NARANJA DURANGO', '8', 'USD$', '1.9773', '0', '1', 1),
(80, 'GRANILLO DE VAINILLA', '8', 'USD$', '1.0909', '0', '1', 1),
(81, 'GRASA ESPECIALIZADA HOJALDRE . LBS ', '8', 'USD$', '0.6194', '0', '1', 1),
(82, 'HARINA SEMIFUERTE HARIMASA LBS. ', '8', 'USD$', '0.2212', '0', '1', 1),
(83, 'HARINA ALTA EN PROTEINAS LIBRA', '8', 'USD$', '0.2168', '0', '1', 1),
(84, 'HARINA DE ARROZ PROVAPAN SACO LB ', '8', 'USD$', '0.2798', '0', '1', 1),
(85, 'HARINA EL PANADERO FUERTE CHAVARRIA LBS. ', '8', 'USD$', '0.2389', '0', '1', 1),
(86, 'HARINA FUERTE HARIMASA', '8', 'USD$', '0.2242', '0', '1', 1),
(87, 'HARINA FUERTE PANADERO LIBRAS', '8', 'USD$', '0.2389', '0', '1', 1),
(88, 'HARINA GOLDEN CAKE CHAVARRIA LBS', '8', 'USD$', '0.1991', '0', '1', 1),
(89, 'HARINA SEMIFUERTE GUMARSAL LBS.', '8', 'USD$', '0.2212', '0', '1', 1),
(90, 'HARINA SPECIAL GOLDEN CAKE (BATIDO) LBS', '8', 'USD$', '0.2177', '0', '1', 1),
(91, 'HARINA SUAVE HARIMASA', '8', 'USD$', '0.1943', '0', '1', 1),
(92, 'HUEVOS CATALANA U. 1700+ DE 57 GM ', '11', 'USD$', '0.0650', '0', '1', 1),
(93, 'IMPRUVER AIS SACO LBS ', '8', 'USD$', '1.3500', '0', '1', 1),
(94, 'JALEA DE PINA CAJAS DE LBS', '8', 'USD$', '0.3256', '0', '1', 1),
(95, 'LEVADURA NEVADA DURANGO LBS. ', '8', 'USD$', '2.1800', '0', '1', 1),
(96, 'MANI A GRANEL LB ', '8', 'USD$', '1.4637', '0', '1', 1),
(97, 'MANTECA VEGETAL AMBAR. LBS.', '8', 'USD$', '0.5841', '84', '1', 1),
(98, 'MERENGO EN POLVO . ENCO LBS ', '8', 'USD$', '6.6923', '0', '1', 1),
(99, 'MERMELADA DE FRESA LOS PINOS LBS ', '8', 'USD$', '1.9020', '0', '1', 1),
(100, 'MERMELADA DE GUAYABA CUBETA 5.KG', '8', 'USD$', '1.0459', '0', '1', 1),
(101, 'MOLVAN EFCO GL(LEVADURAS UNIVERSAL) LBS ', '8', 'USD$', '72.0000', '0', '1', 1),
(102, 'MTCA. CAPULLO VEGETAL LBS. ', '8', 'USD$', '0.5487', '0', '1', 1),
(103, 'NARANJA LIQ. PASTELES HERMEL LBS ', '8', 'USD$', '7.9886', '0', '1', 1),
(104, 'NEGRO LIQ. PASTELES HERMEL LBS', '8', 'USD$', '7.7600', '0', '1', 1),
(105, 'PAPELILLO CHINO', '11', 'USD$', '0.0102', '0', '1', 1),
(106, 'PIXI FINO BAZZINI LB ', '8', 'USD$', '0.6474', '9', '1', 1),
(107, 'PLUS PAN DURANGO LBS. ', '8', 'USD$', '1.7501', '0', '1', 1),
(108, 'POLVO DE HORNEAR ESQUIVEL LBS', '8', 'USD$', '0.3356', '0', '1', 1),
(109, 'PROPINATO DE CALCIO DURANGO LBS. ', '8', 'USD$', '1.6364', '0', '1', 1),
(110, 'PROPINATO DE SODIO DURANGO LBS. ', '8', 'USD$', '1.6364', '0', '1', 1),
(111, 'QUESO DURO LB.', '8', 'USD$', '2.3000', '0', '1', 1),
(112, 'ROJO INTENSO LIQ. HERMEL. LBS', '8', 'USD$', '8.0000', '0', '1', 1),
(113, 'ROSADO FUCSIA HERMEL LBS.', '8', 'USD$', '8.0000', '0', '1', 1),
(114, 'ROSADO LIQ. PASTELEES LBS. ', '8', 'USD$', '8.0000', '0', '1', 1),
(115, 'SABOR DE PIÑA EN POLVO HERMEL LBS ', '8', 'USD$', '5.1935', '2', '1', 1),
(116, 'SINER BAKER DURANGO LBS', '8', 'USD$', '1.3200', '1.15', '1', 1),
(117, 'SORBATO DE POTASIO DINQUIZA LBS. ', '8', 'USD$', '2.5000', '0', '1', 1),
(118, 'SUERO DE LECHE DINQUISA LBS. ', '8', 'USD$', '0.4917', '1', '1', 1),
(119, 'SUPER AROMA DE PIÑA ESQ. LBS. ', '8', 'USD$', '4.8765', '0', '1', 1),
(120, 'SUPER AROMA DE VAINILLA ESQ. LBS. ', '8', 'USD$', '5.0000', '0', '1', 1),
(121, 'VERDE LIQ. PASTELES HERMEL. LBS', '8', 'USD$', '8.0000', '1', '1', 1),
(122, 'LEVADURA ROJA', '8', 'USD$', '2.1800', '0', '1', 1),
(123, 'CAJA INIXS 2212-53', '11', 'USD$', '0.1900', '0', '1', 1),
(124, 'HIELO', '8', 'USD$', '0.0400', '0', '1', 1),
(125, 'AGUA ', '8', 'USD$', '0.0400', '86', '1', 1),
(126, 'CANELA EN RAJA', '8', 'USD$', '8.3900', '0', '1', 1),
(127, 'AFRECHO', '8', 'USD$', '0.1247', '0', '1', 1),
(128, 'BOBINA DE CHOCOLATE 11PULG. KGS. ', '8', 'USD$', '85.9300', '0', '1', 1),
(129, 'BOBINA P/CHAPINA Y PANQ. 10 PULG. BOLPACK KGS. ', '8', 'USD$', '77.9936', '0', '1', 1),
(130, 'BOBINA PARA CANELA 11 PULG. KGS. ', '11', 'USD$', '85.9300', '0', '1', 1),
(131, 'BOBINA PARA COCO 11 PULG. BOLPACK KGS. ', '11', 'USD$', '85.9300', '0', '1', 1),
(132, 'BOBINA PARA MARG. MIXTA 11 PULG. BOLPACK KGS. ', '11', 'USD$', '85.9300', '0', '1', 1),
(133, 'BOBINA PARA MARGARITA LIDO DE 11 PULGADAS', '11', 'USD$', '87.9500', '0', '1', 1),
(134, 'BOBINA PARA SALPOR DE ARROZ KGS. ', '11', 'USD$', '85.9300', '0', '1', 1),
(135, 'BOBINA STRUDENT 12 PULGADAS BOLPACK ', '11', 'USD$', '85.8471', '0', '1', 1),
(136, 'BOLSA DE 9*14 THAMOSA FARDOS UN. ', '11', 'USD$', '0.0086', '0', '1', 1),
(137, 'BOLSA SAMSIL 8.75*14 THERMO PLAST. UN. ', '11', 'USD$', '0.0094', '306', '1', 1),
(138, 'CAJA 2020-43 8X8X3 UNDS. ', '11', 'USD$', '0.1400', '0', '1', 1),
(139, 'CAJA 2212-53 INIX UNDS. ', '11', 'USD$', '0.1179', '0', '1', 1),
(140, 'CORRUGADO #2 UNDS ESQUIVEL', '11', 'USD$', '0.0100', '0', '1', 1),
(141, 'DOMO 9*9 INIX UNDS', '11', 'USD$', '0.4990', '0', '1', 1),
(142, 'DOMO 9X9 PARA 8 UNIDS ', '11', 'USD$', '0.1798', '0', '1', 1),
(143, 'DOMO TRANSP. DE 9 A - UNDS', '11', 'USD$', '0.1160', '0', '1', 1),
(144, 'EMAQUE VP 757 PÂ´/ENSALADA 21.4*20.8*8.4. UNDS. ', '11', 'USD$', '0.2253', '0', '1', 1),
(145, 'EMPAQUE GP125 DE UNDS. ', '11', 'USD$', '0.1547', '0', '1', 1),
(146, 'MOLDE ALUM DE 9 - 516 - 4 UNIDS', '11', 'USD$', '0.1965', '0', '1', 1),
(147, 'AFRECHO LBS. ', '8', 'USD$', '0.1320', '0', '1', 1),
(148, 'BICARBONATO DE SODIO DINQUIZA LBS. ', '8', 'USD$', '0.2500', '0', '1', 1),
(149, 'BICARBONATO HERMEL LBS. ', '8', 'USD$', '0.5659', '0.625', '1', 1),
(150, 'CARAMELO LIQ. LGL. GL.', '8', 'USD$', '1.8805', '0', '1', 1),
(151, 'COCO R. NARANJA LBS. ', '8', 'USD$', '2.1200', '0', '1', 1),
(152, 'COLOR CAFE CHOCOLATE . LGL LBS', '8', 'USD$', '4.8273', '0', '1', 1),
(153, 'COLOR CARAMELO LIQ. DEL CARIBE. LBS. ', '8', 'USD$', '0.9514', '0.25', '1', 1),
(154, 'COLOR CHOCOLATE HERMEL LBS. ', '8', 'USD$', '5.2064', '1', '1', 1),
(155, 'CONCENTRADO DE BANANo HERMEL LBS ', '8', 'USD$', '5.8750', '0', '1', 1),
(156, 'CONCENTRADO DE NARANJA HERMEL LBS. ', '8', 'USD$', '6.1250', '0', '1', 1),
(157, 'GLAZE DE FRESA LEVADURAS LBS ', '8', 'USD$', '1.7500', '0', '1', 1),
(158, 'HARINA DE ARROZ CEMERSA LBS. ', '8', 'USD$', '0.2743', '0', '1', 1),
(159, 'HARINA DE MAIZ GUMARSAL LBS', '8', 'USD$', '0.2832', '0', '1', 1),
(160, 'HARINA ESPECIAL GUMARSAL BOLSA DE LBS ', '8', 'USD$', '0.1903', '0', '1', 1),
(161, 'HARINA FUERTE GUMARSAL BOLSA DE LBS', '8', 'USD$', '0.2212', '0', '1', 1),
(162, 'HARINA SUAVE GALLETA GUMARSAL LBS. ', '8', 'USD$', '0.1989', '0', '1', 1),
(163, 'HUEVO ANDELSA CUBETA LB. ', '8', 'USD$', '1.1000', '0', '1', 1),
(164, 'MANTECA IND. FREEMAN LBS', '8', 'USD$', '0.4513', '0', '1', 1),
(165, 'PIXI CASA BAZZINI GRANDE LB ', '8', 'USD$', '0.6500', '1', '1', 1),
(166, 'POLVO DE HORNEAR FLEISCHMANN SACO LBS. ', '8', 'USD$', '0.3009', '3.5', '1', 1),
(167, 'SABOR DE FRESA EN POLVO HERMEL LBS. ', '8', 'USD$', '5.2273', '0', '1', 1),
(168, 'MIGA BLANCA ', '8', 'USD$', '1.0000', '4', '1', 1),
(169, 'BOBINA PARA MARGARITA LIDO DE 10 PULGADA ', '11', 'USD$', '85.9300', '0', '1', 1),
(170, 'BOBINA TRANSPARENTE', '11', 'USD$', '85.9300', '0', '1', 1),
(171, 'BOBINA MI PAN', '11', 'USD$', '85.9300', '0', '1', 1),
(172, 'LEVADURA DORADA DURANGO', '8', 'USD$', '2.4200', '0', '1', 1),
(173, 'JALEA DE GUAYABA PROVAPAN 20 LB', '8', 'USD$', '0.8849', '0', '1', 1),
(174, 'BIDON DE ACEITE VEGETAL', '0', 'USD$', '23.8937', '0', '1', 1),
(175, 'GLAZE DE VAINILLA', '8', 'USD$', '0.7643', '0', '1', 1),
(176, 'MANTECA VITINA', '8', 'USD$', '0.4336', '0', '1', 1),
(177, 'MANTECA COSTEÑA', '8', 'USD$', '0.5752', '0', '1', 1),
(178, 'ACEITE CRISTALINO PLASTICAJA', '0', 'USD$', '19.9115', '0', '1', 1),
(179, 'DESMOLDANTE P/LATAS Y MOLDES PV-23', '0', 'USD$', '79.0000', '0', '1', 1),
(180, 'ROJO LIQUIDO PASTELES', '8', 'USD$', '8.0000', '0', '1', 1),
(181, 'CORRUGADO BLANCO #5', '11', 'USD$', '1.5930', '0', '1', 1),
(182, 'BOLSA DE GABACHA #5 (TOTO) PAQ 500 UNI', '11', 'USD$', '0.2560', '0', '1', 1),
(183, 'JALEA DE HIGO', '11', 'USD$', '1.9020', '0', '1', 1),
(184, 'BRILLO NEUTRO', '11', 'USD$', '1.6820', '0', '1', 1),
(185, 'MERMELADA DE MANZANA', '11', 'USD$', '1.9020', '0', '1', 1),
(186, 'MARGARINA PASTELERA', '8', 'USD$', '22.1238', '0', '1', 1),
(187, 'DOMO GP 106', '11', 'USD$', '0.1897', '0', '1', 1),
(188, 'COLOR BLANCO LIQUIDO PASTELES', '8', 'USD$', '8.0000', '0', '1', 1),
(189, 'ESENCIA DE FRESA', '8', 'USD$', '0.5250', '0', '1', 1),
(190, 'ESENCIA DE BANANO', '8', 'USD$', '0.5250', '0', '1', 1),
(191, 'ESENCIA DE CANELA', '8', 'USD$', '0.5313', '0', '1', 1),
(192, 'MANTECA LA PATRONA', '8', 'USD$', '0.4127', '0', '1', 1),
(193, 'DESMOLDANTE STELLA', '8', 'USD$', '1.1364', '0', '1', 1),
(194, 'ESENCIA DE NARANJA', '8', 'USD$', '0.5250', '0', '1', 1),
(195, 'MANTECA COSTEÑA BATIDO', '8', 'USD$', '0.5752', '0', '1', 1);

CREATE TABLE IF NOT EXISTS `Cfabricacion` (
`id_Cfabricacion` int(11) NOT NULL,
  `servicios` text NOT NULL,
  `unidadm` enum('0','1') NOT NULL,
  `tiempo` time,
  `porcentaje` float,
  `costos` float NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `usuarios` (
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombres`, `apellidos`, `dui`, `telefono`, `correo`, `direccion`, `cargo`, `usuario`, `password`, `password2`, `fecha_ingreso`, `estado`) VALUES
(1, 'Wilbert', 'Palacios', '066669.1', '77022837', 'izzypalacio@outlook.com', 'San Salvador', '1', 'Wilbert ', 'Vampiros', 'Vampiros0', '2020-04-01', '1'),
(3, 'Jorge', 'Figueroa', '04569038-7', '74055615', 'jorge.figueroa@gruposamsil.com', 'Arce', '1', 'jfigueroa', '1234', '1234', '2021-01-21', '1');



CREATE TABLE IF NOT EXISTS `usuario_permiso` (
`id_usuario_permiso` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=156 DEFAULT CHARSET=latin1;

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
(164, 3, 9);


--
ALTER TABLE `categoria`
 ADD PRIMARY KEY (`id_categoria`), ADD KEY `fk_categoria_usuarios_idx` (`id_usuario`);

 ALTER TABLE `cif`
 ADD PRIMARY KEY (`id_cif`), ADD KEY `fk_cif_usuarios_idx` (`id_usuario`);

 ALTER TABLE `permisos`
 ADD PRIMARY KEY (`id_permiso`);

 ALTER TABLE `producto`
 ADD PRIMARY KEY (`id_producto`), ADD KEY `fk_producto_usuarios_idx` (`id_usuario`),ADD KEY `fk_producto_categoria_idx` (`id_categoria`),ADD KEY `fk_producto_cif_idx` (`id_cif`);


ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`id_usuario`);

ALTER TABLE `DProducto`
 ADD PRIMARY KEY (`id_Dproducto`), ADD KEY `fk_Dproducto_usuarios_idx` (`id_usuario`), ADD KEY `fk_Dproducto_producto_idx` (`id_producto`);


ALTER TABLE `detalle_DProducto`
 ADD PRIMARY KEY (`id_detalle_Dproducto`), ADD KEY `fk_detalle_Dproducto_Mprima_idx` (`id_Mprima`), ADD KEY `fk_detalle_Dproducto_usuario_idx` (`id_usuario`), ADD KEY `fk_detalle_Dproducto_producto_idx` (`id_producto`);

ALTER TABLE `Batida`
 ADD PRIMARY KEY (`id_Batida`), ADD KEY `fk_Batida_usuarios_idx` (`id_usuario`), ADD KEY `fk_Batida_producto_idx` (`id_producto`), ADD KEY `fk_Batida_Dproducto_idx` (`id_Dproducto`);


ALTER TABLE `detalle_Batida`
 ADD PRIMARY KEY (`id_detalle_Batida`), ADD KEY `fk_detalle_Batida_Mprima_idx` (`id_Mprima`), ADD KEY `fk_detalle_Batida_usuario_idx` (`id_usuario`), ADD KEY `fk_detalle_Batida_producto_idx` (`id_producto`), ADD KEY `fk_detalle_Batida_Dproducto_idx` (`id_Dproducto`), ADD KEY `fk_detalle_Batida_detalle_Dproducto_idx` (`id_detalle_Dproducto`);



 ALTER TABLE `Mprima`
 ADD PRIMARY KEY (`id_Mprima`), ADD KEY `fk_Mprima_usuarios_idx` (`id_usuario`);

 ALTER TABLE `Cfabricacion`
 ADD PRIMARY KEY (`id_Cfabricacion`), ADD KEY `fk_Cfabricacion_usuarios_idx` (`id_usuario`);

ALTER TABLE `usuario_permiso`
 ADD PRIMARY KEY (`id_usuario_permiso`), ADD KEY `fk_usuario_permiso_usuario_idx` (`id_usuario`), ADD KEY `fk_usuario_permiso_permiso_idx` (`id_permiso`);

ALTER TABLE `DProducto_Mprima`
 ADD PRIMARY KEY (`id_Dproducto_Mprima`), ADD KEY `fk_DProducto_Mprima_Dproducto_idx` (`id_Dproducto`), ADD KEY `fk_Dproducto_Mprima_Mprima_idx` (`id_Mprima`);

ALTER TABLE `DProducto_Cfabricacion`
 ADD PRIMARY KEY (`id_Dproducto_Cfabricacion`), ADD KEY `fk_DProducto_Cfabricacion_Dproducto_idx` (`id_Dproducto`), ADD KEY `fk_Dproducto_Cfabricacion_Cfabricacion_idx` (`id_Cfabricacion`);


ALTER TABLE `Batida`
MODIFY `id_Batida` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;

ALTER TABLE `detalle_Batida`
MODIFY `id_detalle_Batida` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;

ALTER TABLE `categoria`
MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;

ALTER TABLE `cif`
MODIFY `id_cif` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;


ALTER TABLE `permisos`
MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;

ALTER TABLE `producto`
MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;

ALTER TABLE `usuarios`
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;

ALTER TABLE `DProducto`
MODIFY `id_Dproducto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;

ALTER TABLE `detalle_DProducto`
MODIFY `id_detalle_Dproducto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;

ALTER TABLE `Mprima`
MODIFY `id_Mprima` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;

ALTER TABLE `Cfabricacion`
MODIFY `id_Cfabricacion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;


ALTER TABLE `usuario_permiso`
MODIFY `id_usuario_permiso` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=156;

ALTER TABLE `DProducto_Mprima`
MODIFY `id_Dproducto_Mprima` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=159;

ALTER TABLE `DProducto_Cfabricacion`
MODIFY `id_Dproducto_Cfabricacion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=169;



ALTER TABLE `categoria`
ADD CONSTRAINT `fk_categoria_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `cif`
ADD CONSTRAINT `fk_cif_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;


ALTER TABLE `producto`
ADD CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_producto_cif` FOREIGN KEY (`id_cif`) REFERENCES `cif` (`id_cif`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_producto_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;


ALTER TABLE `usuario_permiso`
ADD CONSTRAINT `fk_usuario_permiso_permiso` FOREIGN KEY (`id_permiso`) REFERENCES `permisos` (`id_permiso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_usuario_permiso_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;


ALTER TABLE `DProducto`
ADD CONSTRAINT `fk_DProducto_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_DProducto_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `detalle_DProducto`
ADD CONSTRAINT `fk_detalle_Dproducto_Mprima` FOREIGN KEY (`id_Mprima`) REFERENCES `Mprima` (`id_Mprima`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_detalle_Dproducto_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_detalle_Dproducto_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `Batida`
ADD CONSTRAINT `fk_Batida_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Batida_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Batida_Dproducto` FOREIGN KEY (`id_Dproducto`) REFERENCES `Dproducto` (`id_Dproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `detalle_Batida`
ADD CONSTRAINT `fk_detalle_Batida_Mprima` FOREIGN KEY (`id_Mprima`) REFERENCES `Mprima` (`id_Mprima`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_detalle_Batida_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_detalle_Batida_Dproducto` FOREIGN KEY (`id_Dproducto`) REFERENCES `Dproducto` (`id_Dproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_detalle_Batida_detalle_Dproducto` FOREIGN KEY (`id_detalle_Dproducto`) REFERENCES `detalle_Dproducto` (`id_detalle_Dproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_detalle_Batida_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;


ALTER TABLE `Mprima`
ADD CONSTRAINT `fk_Mprima_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;


ALTER TABLE `Cfabricacion`
ADD CONSTRAINT `fk_Cfabricacion_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;



ALTER TABLE `DProducto_Mprima`
ADD CONSTRAINT `fk_DProducto_Mprima_Mprima` FOREIGN KEY (`id_Mprima`) REFERENCES `Mprima` (`id_Mprima`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_DProducto_Mprima_DProducto` FOREIGN KEY (`id_Dproducto`) REFERENCES `DProducto` (`id_Dproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;


ALTER TABLE `DProducto_Cfabricacion`
ADD CONSTRAINT `fk_DProducto_Cfabricacion_Cfabricacion` FOREIGN KEY (`id_Cfabricacion`) REFERENCES `Cfabricacion` (`id_Cfabricacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_DProducto_Cfabricacion_DProducto` FOREIGN KEY (`id_Dproducto`) REFERENCES `DProducto` (`id_Dproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

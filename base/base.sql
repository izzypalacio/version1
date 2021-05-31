create database inventarios;
use inventarios;

CREATE TABLE IF NOT EXISTS `categoria` (
`id_categoria` int(11) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `id_usuario` int(11) NOT NULL
  ) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

  CREATE TABLE IF NOT EXISTS `permisos` (
`id_permiso` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_permiso`, `nombre`) VALUES
(1, 'Categoria'),
(2, 'Productos'),
(3, 'Produccion'),
(4, 'Reportes'),
(5, 'Formulas'),
(6, 'Mprima'),
(7, 'Usuarios');


CREATE TABLE IF NOT EXISTS `producto` (
`id_producto` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `producto` varchar(100) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `id_Dproducto` int(11) NOT NULL,
  `id_Mprima` int(11) NOT NULL,
  `id_Cfabricacion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `DProducto` (
`id_Dproducto` int(11) NOT NULL,
  `formulas` text NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `Mprima` (
`id_Mprima` int(11) NOT NULL,
  `materiales` text NOT NULL,
  `costos` float NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `Cfabricacion` (
`id_Cfabricacion` int(11) NOT NULL,
  `servicios` text NOT NULL,
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
(1, 'Wilbert', 'Palacios', '066669.1', '77022837', 'izzypalacio@outlook.com', 'San Salvador', '1', 'Wilbert ', 'Vampiros', 'Vampiros0', '2020-04-01', '1');



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
(146, 1, 7);

--
ALTER TABLE `categoria`
 ADD PRIMARY KEY (`id_categoria`), ADD KEY `fk_categoria_usuarios_idx` (`id_usuario`);

 ALTER TABLE `permisos`
 ADD PRIMARY KEY (`id_permiso`);

 ALTER TABLE `producto`
 ADD PRIMARY KEY (`id_producto`), ADD KEY `fk_producto_categoria_idx` (`id_categoria`), ADD KEY `fk_producto_usuario_idx` (`id_usuario`);


ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`id_usuario`);

ALTER TABLE `DProducto`
 ADD PRIMARY KEY (`id_Dproducto`), ADD KEY `fk_Dproducto_usuarios_idx` (`id_usuario`);

 ALTER TABLE `Mprima`
 ADD PRIMARY KEY (`id_Mprima`), ADD KEY `fk_Mprima_usuarios_idx` (`id_usuario`);

 ALTER TABLE `Cfabricacion`
 ADD PRIMARY KEY (`id_Cfabricacion`), ADD KEY `fk_Cfabricacion_usuarios_idx` (`id_usuario`);

ALTER TABLE `usuario_permiso`
 ADD PRIMARY KEY (`id_usuario_permiso`), ADD KEY `fk_usuario_permiso_usuario_idx` (`id_usuario`), ADD KEY `fk_usuario_permiso_permiso_idx` (`id_permiso`);


ALTER TABLE `categoria`
MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;


ALTER TABLE `permisos`
MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;

ALTER TABLE `producto`
MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;

ALTER TABLE `usuarios`
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;

ALTER TABLE `DProducto`
MODIFY `id_Dproducto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;

ALTER TABLE `Mprima`
MODIFY `id_Mprima` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;

ALTER TABLE `Cfabricacion`
MODIFY `id_Cfabricacion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;


ALTER TABLE `usuario_permiso`
MODIFY `id_usuario_permiso` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=156;



ALTER TABLE `categoria`
ADD CONSTRAINT `fk_categoria_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;


ALTER TABLE `producto`
ADD CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_producto_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_producto_Dproducto` FOREIGN KEY (`id_Dproducto`) REFERENCES `DProducto` (`id_Dproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_producto_Mprima` FOREIGN KEY (`id_Mprima`) REFERENCES `Mprima` (`id_Mprima`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_producto_Cfabricacion` FOREIGN KEY (`id_Cfabricacion`) REFERENCES `Cfabricacion` (`id_Cfabricacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;


ALTER TABLE `usuario_permiso`
ADD CONSTRAINT `fk_usuario_permiso_permiso` FOREIGN KEY (`id_permiso`) REFERENCES `permisos` (`id_permiso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_usuario_permiso_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;


ALTER TABLE `DProducto`
ADD CONSTRAINT `fk_DProducto_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `Mprima`
ADD CONSTRAINT `fk_Mprima_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;


ALTER TABLE `Cfabricacion`
ADD CONSTRAINT `fk_Cfabricacion_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
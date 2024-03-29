-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 27-08-2014 a las 16:27:43
-- Versión del servidor: 5.5.20
-- Versión de PHP: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `db_laboratorios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_clasematerial`
--

CREATE TABLE IF NOT EXISTS `cat_clasematerial` (
  `pk_clasematerial` int(11) NOT NULL AUTO_INCREMENT,
  `descrip_clasematerial` varchar(45) DEFAULT NULL,
  `activo_clasematerial` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`pk_clasematerial`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `cat_clasematerial`
--

INSERT INTO `cat_clasematerial` (`pk_clasematerial`, `descrip_clasematerial`, `activo_clasematerial`) VALUES
(1, 'Material', 1),
(2, 'Reactivos', 1),
(3, 'Equipo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_estadomaterial`
--

CREATE TABLE IF NOT EXISTS `cat_estadomaterial` (
  `Pk_EstadoMaterial` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion_EstadoMaterial` varchar(45) DEFAULT NULL,
  `Activo_EstadoMaterial` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Pk_EstadoMaterial`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `cat_estadomaterial`
--

INSERT INTO `cat_estadomaterial` (`Pk_EstadoMaterial`, `Descripcion_EstadoMaterial`, `Activo_EstadoMaterial`) VALUES
(1, 'En Funcionamiento', '1'),
(2, 'No Funciona', '1'),
(3, 'Buen Estado', '1'),
(4, 'Regular', '1'),
(5, 'No Aplica', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_frecuenciauso`
--

CREATE TABLE IF NOT EXISTS `cat_frecuenciauso` (
  `pk_frecuenciauso` int(11) NOT NULL AUTO_INCREMENT,
  `descrip_frecuenciauso` varchar(45) DEFAULT NULL,
  `activo_frecuenciauso` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`pk_frecuenciauso`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `cat_frecuenciauso`
--

INSERT INTO `cat_frecuenciauso` (`pk_frecuenciauso`, `descrip_frecuenciauso`, `activo_frecuenciauso`) VALUES
(1, 'Continua', 1),
(2, 'Frecuente', 1),
(3, 'Ocasional', 1),
(4, 'Poco Usual', 1),
(5, 'Rara', 1),
(6, 'Muy Rara', 1),
(7, 'No Aplica', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_genero`
--

CREATE TABLE IF NOT EXISTS `cat_genero` (
  `pk_genero` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`pk_genero`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `cat_genero`
--

INSERT INTO `cat_genero` (`pk_genero`, `descripcion`, `estado`) VALUES
(1, 'Masculino', 1),
(2, 'Femenino', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_menu`
--

CREATE TABLE IF NOT EXISTS `cat_menu` (
  `idMenu` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(55) COLLATE utf8_swedish_ci NOT NULL,
  `Alias_Archivo` varchar(55) COLLATE utf8_swedish_ci NOT NULL,
  `Fk_Cat_Permiso` smallint(5) unsigned DEFAULT NULL,
  `Fk_Departamento` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`idMenu`),
  KEY `fk_Cat_Menu_Cat_Titulos_Menu1_idx` (`Fk_Departamento`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `cat_menu`
--

INSERT INTO `cat_menu` (`idMenu`, `Name`, `Alias_Archivo`, `Fk_Cat_Permiso`, `Fk_Departamento`) VALUES
(1, 'Materiales Alta', 'Materiales', 1, 1),
(2, 'Materiales Modificar', 'MaterialesModificar', 2, 1),
(3, 'Materiales Listar', 'MaterialesListar', 1, 1),
(4, 'Materiales Salidas', 'MaterialesSalidas', 1, 1),
(5, 'Reportes', 'ReporteLaboratorios', 1, 2),
(6, 'home2', 'home2', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_tipomaterial`
--

CREATE TABLE IF NOT EXISTS `cat_tipomaterial` (
  `Pk_TipoMaterial` int(11) NOT NULL AUTO_INCREMENT,
  `DescripcionTipoMaterial` varchar(45) DEFAULT NULL,
  `ActivoTipoMaterial` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`Pk_TipoMaterial`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `cat_tipomaterial`
--

INSERT INTO `cat_tipomaterial` (`Pk_TipoMaterial`, `DescripcionTipoMaterial`, `ActivoTipoMaterial`) VALUES
(1, 'Vidrio', 1),
(2, 'Metal', 1),
(3, 'Porcelana', 1),
(4, 'Acero Inoxidable', 1),
(5, 'Plastico', 1),
(6, 'Latex', 1),
(7, 'Asbesto', 1),
(8, 'Metal y Plastico', 1),
(9, 'Platino', 1),
(10, 'No Aplica', 1),
(11, 'Plastico Ambar', 1),
(12, 'Bolsa de Plastico', 1),
(13, 'Bolsa de Papel', 1),
(14, 'Vidrio Ambar', 1),
(15, 'Plastico y Vidrio color Ambar', 1),
(16, 'Plastico en Metal', 1),
(17, 'Vidrio y Plastico', 1),
(18, 'KIT', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_titulos_menu`
--

CREATE TABLE IF NOT EXISTS `cat_titulos_menu` (
  `idTituloMenu` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) COLLATE utf8_swedish_ci NOT NULL,
  `Activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`idTituloMenu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `cat_titulos_menu`
--

INSERT INTO `cat_titulos_menu` (`idTituloMenu`, `Nombre`, `Activo`) VALUES
(1, 'Materiales', 1),
(2, 'Reportes', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_unidadmedida`
--

CREATE TABLE IF NOT EXISTS `cat_unidadmedida` (
  `Pk_UnidadMedida` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion_UnidadMedida` varchar(100) DEFAULT NULL,
  `Activo_UnidadMedida` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`Pk_UnidadMedida`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `cat_unidadmedida`
--

INSERT INTO `cat_unidadmedida` (`Pk_UnidadMedida`, `Descripcion_UnidadMedida`, `Activo_UnidadMedida`) VALUES
(1, 'mL', 1),
(2, 'gr', 1),
(3, 'Lts', 1),
(4, 'kg', 1),
(5, 'Oz', 1),
(6, 'Pieza', 1),
(7, 'Caja', 1),
(8, 'Rollo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_login_permisos`
--

CREATE TABLE IF NOT EXISTS `rel_login_permisos` (
  `Pk_Login_Permisos` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador (Llave Primaria) del Login_Permisos.',
  `Fk_Usuario_Login` smallint(5) unsigned NOT NULL COMMENT 'Llave foranea para identificar a que cuenta de usuario pertenece.',
  `Fk_CatMenu` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`Pk_Login_Permisos`),
  KEY `fk_Rel_LoginPermisos_tbl_Usuario_Login1_idx` (`Fk_Usuario_Login`),
  KEY `fk_Rel_Login_Permisos_Cat_Menu1_idx` (`Fk_CatMenu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `rel_login_permisos`
--

INSERT INTO `rel_login_permisos` (`Pk_Login_Permisos`, `Fk_Usuario_Login`, `Fk_CatMenu`) VALUES
(1, 3, 2),
(2, 3, 3),
(3, 3, 4),
(4, 3, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_trabajadorecarreras`
--

CREATE TABLE IF NOT EXISTS `rel_trabajadorecarreras` (
  `pk_rel_trbajadorescarreras` int(11) NOT NULL AUTO_INCREMENT,
  `fk_Usuario_Login` smallint(5) unsigned NOT NULL,
  `fk_carreras` int(11) NOT NULL,
  `activoPersona` int(2) NOT NULL,
  PRIMARY KEY (`pk_rel_trbajadorescarreras`),
  KEY `fk_trabajadores_has_carreras_carreras1_idx` (`fk_carreras`),
  KEY `fk_rel_trabajadorecarreras_tbl_usuario_login1_idx` (`fk_Usuario_Login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_usuario_laboratorios`
--

CREATE TABLE IF NOT EXISTS `rel_usuario_laboratorios` (
  `pk_usuario_laboratorios` int(11) NOT NULL AUTO_INCREMENT,
  `fk_Usuario_Login` smallint(5) unsigned NOT NULL,
  `fk_laboratorios` int(11) NOT NULL,
  PRIMARY KEY (`pk_usuario_laboratorios`),
  KEY `fk_rel_usuario_laboratorios_tbl_usuario_login1_idx` (`fk_Usuario_Login`),
  KEY `fk_rel_usuario_laboratorios_tbl_laboratorios1_idx` (`fk_laboratorios`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `rel_usuario_laboratorios`
--

INSERT INTO `rel_usuario_laboratorios` (`pk_usuario_laboratorios`, `fk_Usuario_Login`, `fk_laboratorios`) VALUES
(1, 3, 1),
(2, 4, 1),
(3, 5, 2),
(4, 6, 2),
(5, 7, 3),
(6, 8, 3),
(7, 1, 1),
(8, 1, 2),
(9, 1, 3),
(10, 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_carreras`
--

CREATE TABLE IF NOT EXISTS `tbl_carreras` (
  `pk_carreras` int(11) NOT NULL AUTO_INCREMENT,
  `fk_dtgenerales` int(11) NOT NULL,
  `nombreCarrera` varchar(100) NOT NULL,
  `edificio` varchar(60) DEFAULT NULL,
  `estadoCarrera` int(2) DEFAULT NULL,
  PRIMARY KEY (`pk_carreras`),
  KEY `fk_tbl_carreras_tbl_datosgenerales1_idx` (`fk_dtgenerales`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tbl_carreras`
--

INSERT INTO `tbl_carreras` (`pk_carreras`, `fk_dtgenerales`, `nombreCarrera`, `edificio`, `estadoCarrera`) VALUES
(1, 1, 'Quimico Farmaceutico Biologo', '5', 1),
(2, 1, 'Medicina', '4', 1),
(3, 1, 'Odontologia', '7', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_escuela`
--

CREATE TABLE IF NOT EXISTS `tbl_escuela` (
  `pk_dtgenerales` int(11) NOT NULL AUTO_INCREMENT,
  `nombreInstitucion` varchar(300) NOT NULL,
  `apodoInstitucion` varchar(300) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `direccion` varchar(300) NOT NULL,
  `telefono` varchar(60) NOT NULL,
  `fechaIncorporacionSrecetaria` varchar(70) NOT NULL,
  `noOficio` varchar(100) NOT NULL,
  `registro` varchar(70) NOT NULL,
  `regimen` varchar(100) NOT NULL,
  `paginaInternet` varchar(100) NOT NULL,
  `lemaEscuela` varchar(100) NOT NULL,
  `escuelaActiva` tinyint(4) NOT NULL,
  PRIMARY KEY (`pk_dtgenerales`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tbl_escuela`
--

INSERT INTO `tbl_escuela` (`pk_dtgenerales`, `nombreInstitucion`, `apodoInstitucion`, `clave`, `direccion`, `telefono`, `fechaIncorporacionSrecetaria`, `noOficio`, `registro`, `regimen`, `paginaInternet`, `lemaEscuela`, `escuelaActiva`) VALUES
(1, 'Instituto de Estudios Superiores de Chiapas', 'UNIVERSIDAD SALAZAR', '07PSU0002D', 'BLVD. PASO LIMON No. 244', '(961) 614 1621 y 614 1626', '03 DE NOVIEMBRE DE 1983', '0233', 'SEP/PSA/2009/030', 'PARTICULAR', 'www.iesch.edu.mx', 'POR LA CULTURA Y SUPERACION DE MI PUEBLO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_historial_acceso`
--

CREATE TABLE IF NOT EXISTS `tbl_historial_acceso` (
  `Pk_Control` bigint(19) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador (Llave Primaria) del Control.',
  `Fk_Usuario_Login` smallint(5) unsigned NOT NULL COMMENT 'Llave Foranea para identificar al usuario que ingreso y saber su historial.',
  `Fecha` date NOT NULL COMMENT 'Fecha en el que ingreso al sistema.',
  `Hora` time NOT NULL COMMENT 'Hora en el que Ingreso al Sistema.',
  `Ip` varchar(15) COLLATE utf8_swedish_ci NOT NULL COMMENT 'La IP i saber de que maquina(PC) ingreso.',
  `Cat_o_Mod` varchar(100) COLLATE utf8_swedish_ci NOT NULL COMMENT 'Las acciones que realizo el usuario.',
  `Registro` text COLLATE utf8_swedish_ci NOT NULL COMMENT 'Descripcion de lo que realizo en el sistema ALTA, BAJA o MODIFICACION',
  PRIMARY KEY (`Pk_Control`),
  KEY `fk_tbl_HistorialAcceso_tbl_Usuario_Login1_idx` (`Fk_Usuario_Login`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=101 ;

--
-- Volcado de datos para la tabla `tbl_historial_acceso`
--

INSERT INTO `tbl_historial_acceso` (`Pk_Control`, `Fk_Usuario_Login`, `Fecha`, `Hora`, `Ip`, `Cat_o_Mod`, `Registro`) VALUES
(81, 1, '2014-08-16', '19:49:20', '127.0.0.1', 'Modificar alumnos', 'Se modificel material con ID: 1'),
(82, 1, '2014-08-16', '19:49:52', '127.0.0.1', 'Modificar alumnos', 'Se modificel material con ID: 1'),
(83, 1, '2014-08-16', '19:50:04', '127.0.0.1', 'Modificar alumnos', 'Se modificel material con ID: 1'),
(84, 1, '2014-08-16', '19:50:40', '127.0.0.1', 'Modificar alumnos', 'Se modificel material con ID: 1'),
(85, 1, '2014-08-16', '20:15:32', '127.0.0.1', 'Modificar alumnos', 'Se modificel material con ID: 1'),
(86, 1, '2014-08-16', '20:15:41', '127.0.0.1', 'Modificar alumnos', 'Se modificel material con ID: 1'),
(87, 1, '2014-08-16', '20:16:34', '127.0.0.1', 'Modificar alumnos', 'Se modificel material con ID: 1'),
(88, 1, '2014-08-16', '20:16:46', '127.0.0.1', 'Modificar alumnos', 'Se modificel material con ID: 1'),
(89, 1, '2014-08-16', '21:18:48', '127.0.0.1', 'Alta Material', 'Nuevo Material: Mouse Steren'),
(90, 1, '2014-08-16', '21:21:07', '127.0.0.1', 'Modificar alumnos', 'Se modificel material con ID: 956'),
(91, 1, '2014-08-16', '21:21:23', '127.0.0.1', 'Modificar alumnos', 'Se modificel material con ID: 956'),
(92, 1, '2014-08-16', '21:52:52', '127.0.0.1', 'Salida Material', 'Salida de material con ID: 1'),
(93, 1, '2014-08-16', '21:53:09', '127.0.0.1', 'Salida Material', 'Salida de material con ID: 1'),
(94, 1, '2014-08-16', '21:53:38', '127.0.0.1', 'Salida Material', 'Salida de material con ID: 1'),
(95, 1, '2014-08-17', '12:39:01', '127.0.0.1', 'Alta Material', 'Nuevo Material: asd'),
(96, 1, '2014-08-17', '13:46:45', '127.0.0.1', 'Modificar alumnos', 'Se modificel material con ID: 5'),
(97, 1, '2014-08-17', '13:54:35', '127.0.0.1', 'Salida Material', 'Salida de material con ID: 8'),
(98, 1, '2014-08-17', '13:59:53', '127.0.0.1', 'Modificar alumnos', 'Se modificel material con ID: 2'),
(99, 3, '2014-08-18', '10:12:50', '127.0.0.1', 'Modificar alumnos', 'Se modificel material con ID: 8'),
(100, 3, '2014-08-18', '10:55:21', '127.0.0.1', 'Salida Material', 'Salida de material con ID: 3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_laboratorios`
--

CREATE TABLE IF NOT EXISTS `tbl_laboratorios` (
  `Pk_laboratorios` int(11) NOT NULL AUTO_INCREMENT,
  `fk_carreras` int(11) NOT NULL,
  `DescripcionLaboratorios` varchar(200) DEFAULT NULL,
  `ActivoLaboratorios` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`Pk_laboratorios`),
  KEY `fk_tbl_laboratorios_tbl_carreras1_idx` (`fk_carreras`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tbl_laboratorios`
--

INSERT INTO `tbl_laboratorios` (`Pk_laboratorios`, `fk_carreras`, `DescripcionLaboratorios`, `ActivoLaboratorios`) VALUES
(1, 1, 'Laboratorio AB QFB', 1),
(2, 1, 'Laboratorio BC QFB', 1),
(3, 2, 'Laboratorio Medicina', 1),
(4, 3, 'Laboratorio Odontologia', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_material`
--

CREATE TABLE IF NOT EXISTS `tbl_material` (
  `Pk_material` int(11) NOT NULL AUTO_INCREMENT,
  `fk_laboratorios` int(11) NOT NULL,
  `fk_clasematerial` int(11) NOT NULL,
  `DescripcionMaterial` varchar(200) DEFAULT NULL,
  `CantidadMaterial` varchar(45) DEFAULT NULL,
  `Fk_UnidadMedida` int(11) NOT NULL,
  `MedidasMaterial` varchar(45) DEFAULT NULL,
  `Fk_TipoMaterial` int(11) NOT NULL,
  `MarcaMaterial` varchar(45) DEFAULT NULL,
  `Fk_EstadoMaterial` int(11) NOT NULL,
  `ObservacionesMaterial` text,
  `Almacenado` varchar(45) DEFAULT NULL,
  `Uso` varchar(45) DEFAULT NULL,
  `fk_frecuenciauso` int(11) NOT NULL,
  `NumeroInventario` varchar(45) DEFAULT NULL,
  `ActivoMaterial` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`Pk_material`),
  KEY `fk_tbl_material_Cat_TipoMaterial1_idx` (`Fk_TipoMaterial`),
  KEY `fk_tbl_material_Cat_EstadoMaterial1_idx` (`Fk_EstadoMaterial`),
  KEY `fk_tbl_material_cat_frecuenciauso1_idx` (`fk_frecuenciauso`),
  KEY `fk_tbl_material_tbl_laboratorios1_idx` (`fk_laboratorios`),
  KEY `fk_tbl_material_cat_clasematerial1_idx` (`fk_clasematerial`),
  KEY `fk_tbl_material_Cat_UnidadMedida1_idx` (`Fk_UnidadMedida`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=958 ;

--
-- Volcado de datos para la tabla `tbl_material`
--

INSERT INTO `tbl_material` (`Pk_material`, `fk_laboratorios`, `fk_clasematerial`, `DescripcionMaterial`, `CantidadMaterial`, `Fk_UnidadMedida`, `MedidasMaterial`, `Fk_TipoMaterial`, `MarcaMaterial`, `Fk_EstadoMaterial`, `ObservacionesMaterial`, `Almacenado`, `Uso`, `fk_frecuenciauso`, `NumeroInventario`, `ActivoMaterial`) VALUES
(1, 1, 1, 'Agitador', '5', 6, '30 cm', 1, 's/m', 1, '', '', '', 1, '', 0),
(2, 1, 1, 'Aro de metal', '11', 6, '5 cm diametro', 2, 's/m', 3, '', '', '', 3, '', 1),
(3, 1, 1, 'Asegurador doble (nuez)', '2', 6, '', 2, 's/m', 3, '', '', '', 3, '', 1),
(4, 1, 1, 'Bureta graduada', '13', 6, '25 mL', 1, 'Pyrex', 3, '2 en mal estado', '', '', 3, '', 1),
(5, 1, 2, 'Bureta graduada chida', '2', 6, '50 mL', 1, 'Kimax', 3, '', '', '', 3, '', 1),
(6, 1, 1, 'Capsula de porcelana', '10', 6, 'chica', 3, 's/m', 3, '', '', '', 3, '', 1),
(7, 1, 1, 'Capsula de porcelana', '3', 6, 'grande', 3, 's/m', 3, '', '', '', 3, '', 1),
(8, 1, 1, 'Embudo de separaciÃ³n squibb', '2', 6, '125 mL', 1, 'Pyrex', 5, '2 en mal estado', '', '', 3, '', 1),
(9, 1, 1, 'Embudo de separación squibb', '2', 6, '250 mL', 1, 'Pyrex', 3, '', '', '', 3, '', 1),
(10, 1, 1, 'Espátula ', '8', 6, 'medianas', 4, 'pastor aleman', 3, '', '', '', 3, '', 1),
(11, 1, 1, 'Estuche para disección', '4', 6, 'pequeño', 4, 's/m', 3, '', '', '', 3, '', 1),
(12, 1, 1, 'Gradilla metálica', '9', 6, '40 tubos', 2, 's/m', 3, '', '', '', 3, '', 1),
(13, 1, 1, 'Gradilla metálica', '7', 6, '72 tubos', 2, 's/m', 3, '', '', '', 3, '', 1),
(14, 1, 1, 'Gradilla metálica', '1', 6, '48 tubos', 2, 's/m', 3, '', '', '', 3, '', 1),
(15, 1, 1, 'Gradilla metálica', '5', 6, '90 tubos', 2, 's/m', 3, '', '', '', 3, '', 1),
(16, 1, 1, 'Matraz Erlenmeyer', '18', 6, '50 mL', 1, 'Kimax', 3, '', '', '', 3, '', 1),
(17, 1, 1, 'Matraz Erlenmeyer', '34', 6, '125 mL', 1, 'Kimax', 3, '', '', '', 3, '', 1),
(18, 1, 1, 'Matraz Erlenmeyer', '61', 6, '250 mL', 1, 'Kimax', 3, '', '', '', 3, '', 1),
(19, 1, 1, 'Matraz Erlenmeyer', '10', 6, '500 mL', 1, 'Kimax', 3, '', '', '', 3, '', 1),
(20, 1, 1, 'Matraz aforado', '9', 6, '50 mL', 1, 'Kimax', 3, '1 sin tapon ', '', '', 3, '', 1),
(21, 1, 1, 'Matraz aforado', '13', 6, '100 mL', 1, 'Kimax', 3, '2 con tapon de plastico', '', '', 3, '', 1),
(22, 1, 1, 'Matraz aforado', '15', 6, '250 mL', 1, 'Kimax', 3, '1 sin tapon ', '', '', 3, '', 1),
(23, 1, 1, 'Matraz aforado', '13', 6, '500 mL', 1, 'Kimax', 3, '', '', '', 3, '', 1),
(24, 1, 1, 'Matraz aforado', '9', 6, '1000 mL', 1, 'Kimax', 3, '', '', '', 3, '', 1),
(25, 1, 1, 'Matraz para destilación ', '3', 6, '500 mL', 1, 'Pyrex', 3, '', '', '', 3, '', 1),
(26, 1, 1, 'Matraz bola de fondo plano', '7', 6, '500 mL', 1, 'Pyrex', 3, '', '', '', 3, '', 1),
(27, 1, 1, 'Matraz bola de fondo plano', '8', 6, '1000 mL', 1, 'Kimax', 3, '', '', '', 3, '', 1),
(28, 1, 1, 'Matraz refrigerante', '4', 6, '500 mL', 1, 'Kimax', 3, 'sin tapones', '', '', 3, '', 1),
(29, 1, 1, 'Mechero fisher', '2', 6, '', 2, 's/m', 5, '', '', '', 3, '', 1),
(30, 1, 1, 'Mechero bunsen', '8', 6, '', 2, 's/m', 5, '', '', '', 3, '', 1),
(31, 1, 1, 'Mortero con pistilo', '19', 6, 'pequeño', 3, 's/m', 5, '17 pistilos', '', '', 3, '', 1),
(32, 1, 1, 'Perilla de hule', '10', 6, 'normal', 6, 's/m', 3, '', '', '', 3, '', 1),
(33, 1, 1, 'Pinza de tres dedos', '11', 6, 'normal', 2, 's/m', 3, '', '', '', 3, '', 1),
(34, 1, 1, 'Pinza para crisol', '10', 6, 'normal', 2, 's/m', 3, '', '', '', 3, '', 1),
(35, 1, 1, 'Pinza para tubo ', '14', 6, 'normal', 2, 's/m', 3, '', '', '', 3, '', 1),
(36, 1, 1, 'Pinza para bureta con doble agarre', '9', 6, '', 5, 's/m', 3, '', '', '', 3, '', 1),
(37, 1, 1, 'Pinza para bureta', '5', 6, '', 2, '', 5, '', '', '', 3, '', 1),
(38, 1, 1, 'Picnómetro', '4', 6, '25 mL', 1, 'Pyrex', 3, '', '', '', 3, '', 1),
(39, 1, 1, 'Pipeta serológica', '15', 6, '1 mL', 1, 'Kimax', 3, '', '', '', 3, '', 1),
(40, 1, 1, 'Pipeta serológica', '14', 6, '2 mL', 1, 'Kimax', 3, '', '', '', 3, '', 1),
(41, 1, 1, 'Pipeta serológica', '65', 6, '5 mL', 1, 'Kimax', 3, '', '', '', 3, '', 1),
(42, 1, 1, 'Pipeta serológica', '46', 6, '10 mL', 1, 'Kimax', 3, '', '', '', 3, '', 1),
(43, 1, 1, 'pipeta volumetrica', '10', 6, '1 ml', 1, 'Kimax', 3, '', '', '', 3, '', 1),
(44, 1, 1, 'pipeta volumetrica', '5', 6, '2 ml', 1, 'Kimax', 3, '', '', '', 3, '', 1),
(45, 1, 1, 'pipeta volumetrica', '5', 6, '5 ml', 1, 'Kimax', 3, '', '', '', 3, '', 1),
(46, 1, 1, 'pipeta volumetrica', '24', 6, '10 ml', 1, 'Kimax', 3, '', '', '', 3, '', 1),
(47, 1, 1, 'Probeta graduada', '14', 6, '10 mL', 1, 'Kimax', 3, '', '', '', 3, '', 1),
(48, 1, 1, 'Probeta graduada', '20', 6, '50 mL', 1, 'Brand', 3, '', '', '', 3, '', 1),
(49, 1, 1, 'Probeta graduada', '14', 6, '100 mL', 1, 'Kimax', 3, '1 con base de plastico', '', '', 3, '', 1),
(50, 1, 1, 'Probeta graduada', '27', 6, '250 mL', 1, 'Kimax', 3, '', '', '', 3, '', 1),
(51, 1, 1, 'Probeta graduada con tapón esmerilado', '10', 6, '100 mL', 1, 'Kimax', 3, '', '', '', 3, '', 1),
(52, 1, 1, 'Refrigerante de serpentín', '4', 6, '19/38', 1, 'Kimax', 3, '', '', '', 3, '', 1),
(53, 1, 1, 'Refrigerante recto', '2', 6, 'grande', 1, 'IVA y kima', 3, '1 con punta rota', '', '', 3, '', 1),
(54, 1, 1, 'Soporte universal ', '12', 6, '', 2, '', 5, '', '', '', 3, '', 1),
(55, 1, 1, 'Termómetro de mercurio', '7', 6, '20°C a 150 °C', 1, 'Brannan', 3, '', '', '', 3, '', 1),
(56, 1, 1, 'Tubo de ensaye con tapón de rosca', '57', 6, '16 X 150 mm', 1, 'Kimax', 3, '', '', '', 3, '', 1),
(57, 1, 1, 'Tubo de ensaye', '166', 6, '17 X 150 mm', 1, 'Kimax', 3, '', '', '', 3, '', 1),
(58, 1, 1, 'Tubo de ensaye con tapón de rosca', '2', 6, '13 x 100 mm', 1, 'Kimax', 3, '', '', '', 3, '', 1),
(59, 1, 1, 'Tubo de ensaye', '10', 6, '13 X 100 mm', 1, 'Kimax', 3, '', '', '', 3, '', 1),
(60, 1, 1, 'Tubo de ensaye', '34', 6, '15 x 130 mm', 1, 'Kimax', 3, '', '', '', 3, '', 1),
(61, 1, 1, 'Vaso de precipitado', '16', 6, '50 mL', 1, 'Kimax', 3, '', '', '', 3, '', 1),
(62, 1, 1, 'Vaso de precipitado', '35', 6, '100 mL', 1, 'Kimax', 3, '', '', '', 3, '', 1),
(63, 1, 1, 'Vaso de precipitado', '61', 6, '250 mL', 1, 'Kimax', 3, '', '', '', 3, '', 1),
(64, 1, 1, 'Vaso de precipitado', '11', 6, '500 mL', 1, 'Kimax', 3, '4 cuarteados', '', '', 3, '', 1),
(65, 1, 1, 'Vaso de precipitado', '25', 6, '1000 mL', 1, 'Kimax', 3, '', '', '', 3, '', 1),
(66, 1, 1, 'Vidrio de reloj', '14', 6, 'chico', 1, 'pyrex', 3, '', '', '', 3, '', 1),
(67, 1, 1, 'Vidrio de reloj', '11', 6, 'grande', 1, '', 3, '', '', '', 3, '', 1),
(68, 2, 1, 'Anillo para soporte', '70', 6, '', 2, 'sin marca ', 3, '', '', '', 3, '', 1),
(69, 2, 1, 'Asa bacteriológica', '179', 6, '', 9, 'sin marca ', 3, '', '', '', 3, '', 1),
(70, 2, 1, 'Base para desecador', '2', 6, '190 mm', 3, 'sin marca ', 3, '', '', '', 3, '', 1),
(71, 2, 1, 'Bureta graduada', '26', 6, '25 mL', 1, 'kimax,labessa,pyrex ', 3, '', '', '', 3, '', 1),
(72, 2, 1, 'Caja petri', '120', 6, 'sin división', 1, 'cover', 3, '', '', '', 3, '', 1),
(73, 2, 1, 'Campanas durham', '90', 6, '', 1, 'BECOMAR DE MEXICO', 3, '', '', '', 3, '', 1),
(74, 2, 1, 'Capsula de porcelana', '14', 6, '', 3, 'sin marca ', 3, '', '', '', 3, '', 1),
(75, 2, 1, 'Columna vigreaux', '5', 6, '', 1, '', 3, '', '', '', 3, '', 1),
(76, 2, 1, 'Crisol gooch', '7', 6, '', 3, 'lofivitrex', 3, '', '', '', 3, '', 1),
(77, 2, 1, 'Crisol', '11', 6, '', 3, 'lofivitrex', 3, '', '', '', 3, '', 1),
(78, 2, 1, 'Densímetro', '5', 6, '10 a 45', 1, 'gay-lussac', 3, '', '', '', 3, '', 1),
(79, 2, 1, 'Desecador con tapa', '4', 6, '', 1, 'glaswerk', 3, '2 no tienen bases', '', '', 3, '', 1),
(80, 2, 1, 'Dinamómetro ', '34', 6, '250 g', 2, 'apsa', 3, '', '', '', 3, '', 1),
(81, 2, 1, 'Dinamómetro ', '3', 6, '500 g', 2, 'labessa', 3, '', '', '', 3, '', 1),
(82, 2, 1, 'Embudo de seguridad', '69', 6, '', 1, 'sin marca ', 3, '', '', '', 3, '', 1),
(83, 2, 1, 'Embudo para filtración de membrana', '1', 6, '', 1, 'pyrex', 3, '', '', '', 3, '', 1),
(84, 2, 1, 'Embudo talle largo', '13', 6, '65 mL', 1, 'pyrex', 3, '', '', '', 3, '', 1),
(85, 2, 1, 'Embudo buchner', '9', 6, '', 3, '', 3, '', '', '', 3, '', 1),
(86, 2, 1, 'Embudo de separación squibb', '22', 6, '250 mL', 1, 'pyrex,schott', 4, '6 no estan disponibles ni tienen tapa ', '', '', 3, '', 1),
(87, 2, 1, 'Embudo de separación squibb', '6', 6, '125 mL', 1, 'pyrex', 3, '', '', '', 3, '', 1),
(88, 2, 1, 'Esmerilado conector recto mediano', '5', 6, '', 1, 'pyrex', 3, 'No. 7805-24', '', '', 3, '', 1),
(89, 2, 1, 'Esmerilado conector recto chico para termómetro', '4', 6, '', 1, 'pyrex', 3, '', '', '', 3, '', 1),
(90, 2, 1, 'Esmerilado tubo conector 3 vías abajo', '5', 6, '', 1, 'pyrex', 3, '', '', '', 3, '', 1),
(91, 2, 1, 'Esmerilado tubo conector 3 vías arriba', '10', 6, '', 1, 'pyrex', 3, '', '', '', 3, '', 1),
(92, 2, 1, 'Esmerilado tubo conector al vacío F', '4', 6, '', 1, 'pyrex', 3, '', '', '', 3, '', 1),
(93, 2, 1, 'Esmerilado tubo conector con tapa ', '5', 6, '', 1, 'pyrex', 3, 'No. 9420-24', '', '', 3, '', 1),
(94, 2, 1, 'Esmerilado tubo Y', '5', 6, '120 mL', 1, 'pyrex', 3, 'No. 9601-24', '', '', 3, '', 1),
(95, 2, 1, 'Esmerilado Bureta', '3', 6, '100 mL', 1, 'pyrex', 3, '', '', '', 3, '', 1),
(96, 2, 1, 'Esmerilado tapones', '5', 6, '', 1, 'pyrex', 3, '', '', '', 3, '', 1),
(97, 2, 1, 'Espátula chica', '18', 6, '10 cm', 2, 'pastor aleman ', 3, '', '', '', 3, '', 1),
(98, 2, 1, 'Espátula grande', '4', 6, '20 cm', 2, 'pastor aleman y vilma', 3, '', '', '', 3, '', 1),
(99, 2, 1, 'Gradillas para tubo  13 X 100', '9', 6, '40 tubos', 2, 'sin marca ', 3, '', '', '', 3, '', 1),
(100, 2, 1, 'Gradillas para tubo  15 X 150', '6', 6, '32 tubos', 2, 'sin marca ', 3, '', '', '', 3, '', 1),
(101, 2, 1, 'Gradillas para tubo  13 X 100', '4', 6, '50 tubos', 2, 'sin marca ', 3, '', '', '', 3, '', 1),
(102, 2, 1, 'Gradillas para tubo  15 X 150', '5', 6, '48 tubos', 2, 'sin marca ', 3, '', '', '', 3, '', 1),
(103, 2, 1, 'Gradillas para tubo  15 X 150', '12', 6, '72 tubos', 2, 'sin marca ', 3, '', '', '', 3, '', 1),
(104, 2, 1, 'Horadador ', '1 1/2', 6, '', 2, 'sin marca ', 3, '', '', '', 3, '', 1),
(105, 2, 1, 'Lentes de seguridad', '2', 6, '', 5, 'truper', 3, '', '', '', 3, '', 1),
(106, 2, 1, 'Equipo para destilación (maletín naranja)', '6', 6, '', 5, 'corning pyrex', 4, '1 euipo completo', '', '', 3, '', 1),
(107, 2, 1, 'Malla para soporte', '32', 6, '', 7, 'sin marca ', 4, 'Algunos deteriorados  ', '', '', 3, '', 1),
(108, 2, 1, 'Mascarilla con filtro', '1', 6, '', 6, 'infra', 3, '', '', '', 3, '', 1),
(109, 2, 1, 'Matraz Erlenmeyer', '15', 6, '50 mL', 1, 'kimax,pyrex ', 3, '', '', '', 3, '', 1),
(110, 2, 1, 'Matraz Erlenmeyer', '43', 6, '125 mL', 1, 'kimax,pyrex ', 3, '', '', '', 3, '', 1),
(111, 2, 1, 'Matraz Erlenmeyer', '64', 6, '250 mL', 1, 'kimax,pyrex ', 3, '', '', '', 3, '', 1),
(112, 2, 1, 'Matraz Erlenmeyer', '33', 6, '500 mL', 1, 'kimax,pyrex ', 3, '', '', '', 3, '', 1),
(113, 2, 1, 'Matraz Erlenmeyer', '3', 6, '750 mL', 1, 'kimax,pyrex ', 3, '', '', '', 3, '', 1),
(114, 2, 1, 'Matraz Erlenmeyer', '26', 6, '1000 mL', 1, 'kimax,schott', 3, '', '', '', 3, '', 1),
(115, 2, 1, 'Matraz aforado', '23', 6, '25 mL', 1, 'pyrex', 3, '', '', '', 3, '', 1),
(116, 2, 1, 'Matraz aforado', '36', 6, '50 mL', 1, 'kimax', 3, '', '', '', 3, '', 1),
(117, 2, 1, 'Matraz aforado', '50', 6, '100 mL', 1, 'kimax, schott', 3, '', '', '', 3, '', 1),
(118, 2, 1, 'Matraz aforado', '37', 6, '250 mL', 1, 'pyrex,kimax', 3, '', '', '', 3, '', 1),
(119, 2, 1, 'Matraz aforado', '10', 6, '500 mL', 1, 'tekk,apk', 3, '', '', '', 3, '', 1),
(120, 2, 1, 'Matraz aforado', '4', 6, '1000 mL', 1, 'kimax', 3, '', '', '', 3, '', 1),
(121, 2, 1, 'Matraz bola para destilación ', '4', 6, '250 mL', 1, 'pyrex,civeq', 3, '', '', '', 3, '', 1),
(122, 2, 1, 'Matraz bola para destilación ', '8', 6, '500 mL', 1, 'pyrex', 3, '', '', '', 3, '', 1),
(123, 2, 1, 'Matraz bola de fondo plano', '15', 6, '500 mL', 1, 'pyrex,kimax', 3, '', '', '', 3, '', 1),
(124, 2, 1, 'Matraz bola de fondo plano', '5', 6, '1000 mL', 1, 'pyrex,kimax', 3, '', '', '', 3, '', 1),
(125, 2, 1, 'Matraz bola de fondo redondo', '1', 6, '500 mL', 1, 'pyrex', 3, 'No. 4280', '', '', 3, '', 1),
(126, 2, 1, 'Matraz esmerilado de 2 bocas', '5', 6, '500 mL', 1, 'pyrex', 3, '', '', '', 3, '', 1),
(127, 2, 1, 'Matraz esmerilado fondo redondo', '5', 6, '100 mL', 1, 'pyrex', 3, '', '', '', 3, '', 1),
(128, 2, 1, 'Matraz esmerilado fondo redondo', '4', 6, '250 mL', 1, 'pyrex', 3, '', '', '', 3, '', 1),
(129, 2, 1, 'Matraz esmerilado fondo redondo', '4', 6, '500 mL', 1, 'pyrex', 3, '', '', '', 3, '', 1),
(130, 2, 1, 'Matraz Kitasato', '17', 6, '250 mL', 1, 'kimax', 3, '', '', '', 3, '', 1),
(131, 2, 1, 'Mechero fisher', '14', 6, '', 2, 'sin marca ', 3, '8 no sirven', '', '', 3, '', 1),
(132, 2, 1, 'Mechero bunsen', '32', 6, '', 2, 'sin marca ', 3, '', '', '', 3, '', 1),
(133, 2, 1, 'Mechero de alcohol', '5', 6, '', 1, 'sin marca ', 3, '', '', '', 3, '', 1),
(134, 2, 1, 'Membrana millipore', '1', 6, '25 mm', 1, 'millipore', 3, '', '', '', 3, '', 1),
(135, 2, 1, 'Mortero con pistilo', '11', 6, '', 3, 'sin marca ', 3, '', '', '', 3, '', 1),
(136, 2, 1, 'Placa excavada', '13', 6, '12 excavaciones', 3, 'sin marca ', 3, '', '', '', 3, '', 1),
(137, 2, 1, 'Nueces sujetador para pinza de 3 dedos', '13', 6, '', 2, 'sin marca ', 3, '', '', '', 3, '', 1),
(138, 2, 1, 'Perilla tipo alemana', '8', 6, '', 6, 'sin marca ', 3, '', '', '', 3, '', 1),
(139, 2, 1, 'Piseta ', '18', 6, '500 mL', 5, 'sin marca ', 3, '', '', '', 3, '', 1),
(140, 2, 1, 'Pinza para crisol', '43', 6, '', 2, 'sin marca ', 3, '2 no sirven', '', '', 3, '', 1),
(141, 2, 1, 'Pinza para soporte ', '18', 6, '2 dedos ', 8, 'sin marca ', 3, '10 no sirven', '', '', 3, '', 1),
(142, 2, 1, 'Pinza para soporte ', '49', 6, '3 dedos ', 8, 'aesa', 3, '', '', '', 3, '', 1),
(143, 2, 1, 'Pinza para tubo o de Moss', '15', 6, '', 2, 'sin marca ', 3, '', '', '', 3, '', 1),
(144, 2, 1, 'Pinza para disección', '35', 6, '', 2, 'pakistan', 3, '', '', '', 3, '', 1),
(145, 2, 1, 'Picnómetro', '9', 6, '25ml', 1, 'pyrex', 3, 'no calibrado', '', '', 3, '', 1),
(146, 2, 1, 'Pipeta pasteur', '620', 6, '', 1, 'Ip60#5PLAIN', 3, '', '', '', 3, '', 1),
(147, 2, 1, 'Pipeta volumétrica', '5', 6, '1 mL', 1, 'kimax', 3, '', '', '', 3, '', 1),
(148, 2, 1, 'Pipeta volumétrica', '25', 6, '2 mL', 1, 'kimax', 3, '', '', '', 3, '', 1),
(149, 2, 1, 'Pipeta volumétrica', '12', 6, '10 mL', 1, 'kimax', 3, '', '', '', 3, '', 1),
(150, 2, 1, 'Pipeta graduada', '50', 6, '1 mL', 1, 'pirex,iva,kimax', 3, '', '', '', 3, '', 1),
(151, 2, 1, 'Pipeta graduada', '30', 6, '2 mL', 1, 'kimax', 3, '', '', '', 3, '', 1),
(152, 2, 1, 'Pipeta graduada', '83', 6, '5 mL', 1, 'kimax', 3, '', '', '', 3, '', 1),
(153, 2, 1, 'Pipeta graduada', '45', 6, '10 mL', 1, 'kimax,din', 3, '', '', '', 3, '', 1),
(154, 2, 1, 'Pipeta semiautomática', '1', 6, '5 µL', 5, 'clinipet', 3, '', '', '', 3, '', 1),
(155, 2, 1, 'Pipeta semiautomática', '3', 6, '10 µL', 5, 'clinipet,human,epaplus', 3, '', '', '', 3, '', 1),
(156, 2, 1, 'Pipeta semiautomática', '3', 6, '20 µL', 5, 'human,epaplus', 3, '', '', '', 3, '', 1),
(157, 2, 1, 'Pipeta semiautomática', '3', 6, '25 µL', 5, 'human', 3, '', '', '', 3, '', 1),
(158, 2, 1, 'Pipeta semiautomática', '1', 6, '20-200 µL', 5, 'science', 3, '', '', '', 3, '', 1),
(159, 2, 1, 'Pipeta semiautomática', '3', 6, '50 µL', 5, 'clinipette,human', 3, '', '', '', 3, '', 1),
(160, 2, 1, 'Pipeta semiautomática', '4', 6, '100 µL', 5, 'clinipette,human', 3, '', '', '', 3, '', 1),
(161, 2, 1, 'Pipeta semiautomática', '1', 6, '1000 µL', 5, 'epaplus', 3, '', '', '', 3, '', 1),
(162, 2, 1, 'Pipeta semiautomática', '1', 6, '100-1000 µL', 5, 'human', 3, '', '', '', 3, '', 1),
(163, 2, 1, 'Placas para RF', '14', 6, '6 ovalos', 10, 'lafon', 3, '', '', '', 3, '', 1),
(164, 2, 1, 'Placas para RF', '16', 6, '30 ovalos', 10, 'cat:IM 5420', 3, '', '', '', 3, '', 1),
(165, 2, 1, 'Poleas', '36', 6, '', 5, 'sin marca ', 3, '', '', '', 3, '', 1),
(166, 2, 1, 'Probeta graduada', '9', 6, '10 mL', 1, 'pirex,simax', 3, '', '', '', 3, '', 1),
(167, 2, 1, 'Probeta graduada', '9', 6, '50 mL', 1, 'pirex ', 3, '', '', '', 3, '', 1),
(168, 2, 1, 'Probeta graduada', '19', 6, '100 mL', 1, 'kimax,brand', 3, '', '', '', 3, '', 1),
(169, 2, 1, 'Probeta graduada', '8', 6, '250 mL', 1, 'kimax,pyrex ', 3, '', '', '', 3, '', 1),
(170, 2, 1, 'Probeta graduada', '1', 6, '500 mL', 1, 'pyrex', 4, 'esta cuartiada', '', '', 3, '', 1),
(171, 2, 1, 'Recipiente para tinción vertical', '5', 6, '5 láminas', 1, 'bihemia', 3, '', '', '', 3, '', 1),
(172, 2, 1, 'Recipiente para tinción vertical', '1', 6, '8 láminas', 1, 'bihemia', 4, 'no tiene tapa', '', '', 3, '', 1),
(173, 2, 1, 'Recipiente para tinción vertical', '2', 6, '10 láminas', 1, 'bihemia', 3, '', '', '', 3, '', 1),
(174, 2, 1, 'Refrigerante de Liebig o condensador recto', '2', 6, 'Talle largo', 1, 'pyrex', 3, '', '', '', 3, '', 1),
(175, 2, 1, 'Refrigerante de Liebig o condensador recto esmerilado', '4', 6, 'Talle corto', 1, 'pyrex', 3, '', '', '', 3, '', 1),
(176, 2, 1, 'Soporte universal ', '26', 6, '', 2, 'aesa', 3, '', '', '', 3, '', 1),
(177, 2, 1, 'Termómetro', '11', 6, '', 1, 'brannan,duve', 3, '', '', '', 3, '', 1),
(178, 2, 1, 'Tubo para BH         *', '400', 6, '5 mL', 5, '*', 3, '', '', '', 3, '', 1),
(179, 2, 1, 'Tubo tapa roja      *', '150', 6, '8 mL', 5, '*', 3, '', '', '', 3, '', 1),
(180, 2, 1, 'Tubo cónico', '33', 6, '10 mL', 1, 'kimax', 3, '', '', '', 3, '', 1),
(181, 2, 1, 'Tubo de ensaye', '180', 6, '13 X 120', 1, 'kimax,pyrex ', 3, '', '', '', 3, '', 1),
(182, 2, 1, 'Tubo de ensaye', '829', 6, '7 x 120', 1, 'kimax,pyrex ', 3, '', '', '', 3, '', 1),
(183, 2, 1, 'Tubo de ensaye', '176', 6, '15 x 150', 1, 'kimax,pyrex ', 3, '', '', '', 3, '', 1),
(184, 2, 1, 'Tubo de rosca', '550', 6, '13 X 100', 1, 'kimax', 3, '', '', '', 3, '', 1),
(185, 2, 1, 'Tubo de rosca', '675', 6, '15 x 150', 1, 'kimax,pyrex ', 3, '', '', '', 3, '', 1),
(186, 2, 1, 'Triángulo', '5', 6, '', 3, 'sin marca ', 3, '', '', '', 3, '', 1),
(187, 2, 1, 'Tripié', '15', 6, '', 2, 'sin marca ', 3, '', '', '', 3, '', 1),
(188, 2, 1, 'Vaso de precipitado', '40', 6, '50 mL', 1, 'pyrex', 3, '', '', '', 3, '', 1),
(189, 2, 1, 'Vaso de precipitado', '41', 6, '100 mL', 1, 'kimax,pyrex ', 3, '', '', '', 3, '', 1),
(190, 2, 1, 'Vaso de precipitado', '70', 6, '250 mL', 1, 'pyrex,schott,kimax', 3, '', '', '', 3, '', 1),
(191, 2, 1, 'Vaso de precipitado', '14', 6, '400 mL', 1, 'kimax,schott', 3, '', '', '', 3, '', 1),
(192, 2, 1, 'Vaso de precipitado', '28', 6, '600 mL', 1, 'kimax,schott', 3, '', '', '', 3, '', 1),
(193, 2, 1, 'Vaso de precipitado', '21', 6, '1000 mL', 1, 'kimax,schott', 3, '', '', '', 3, '', 1),
(194, 2, 1, 'Vernier calibrador', '11', 6, '', 5, 'sin marca ', 3, '', '', '', 3, '', 1),
(195, 2, 1, 'Vidrio de reloj', '8', 6, '9 cm de diametro', 1, 'pyrex', 3, '', '', '', 3, '', 1),
(196, 2, 1, 'Vidrio de reloj', '7', 6, '7.5 cm de diametro', 1, 'pyrex', 3, '', '', '', 3, '', 1),
(197, 2, 1, 'Teclado para contador de colonias ', '4', 6, '', 2, 'economy counter', 3, '2 no sirven', '', '', 3, '', 1),
(198, 2, 1, 'Cámara de neubaver', '5', 6, '', 1, 'marienfeld', 3, '', '', '', 3, '', 1),
(199, 2, 1, 'Pipeta sally', '10', 6, '', 1, 'kimax', 3, '', '', '', 3, '', 1),
(200, 2, 1, 'Pipeta para glóbulos rojos', '8', 6, '', 1, 'kimax', 4, '3 no sirven', '', '', 3, '', 1),
(201, 2, 1, 'Tubos wintrobe', '8', 6, '', 1, 'pyrex', 3, '', '', '', 3, '', 1),
(202, 2, 1, 'Pipetas para glóbulos blancos', '15', 6, '', 1, 'lauka', 3, '', '', '', 3, '', 1),
(203, 2, 1, 'P/ de guantes térmicos', '10', 6, '', 10, 'sin marca ', 4, '3 pares rotos ', '', '', 3, '', 1),
(204, 2, 1, 'Mango para bisturí', '19', 6, '', 2, 'hergom,guttek', 3, '', '', '', 3, '', 1),
(205, 1, 2, 'Acetona', '2500', 1, '', 5, '', 5, 'medicina', '', 'preparacion de soluciones', 4, '', 1),
(206, 1, 2, 'Acetil acetona', '500', 1, '', 14, '', 5, 'se queda por falta de espacio', '', '', 7, '', 1),
(207, 1, 2, 'Alcohol etílico', '4500', 1, '', 5, '', 5, 'medicina ', '', 'preparacion de soluciones', 3, '', 1),
(208, 1, 2, 'Benceno', '1000', 1, '', 14, '', 5, 'prepa', '', 'disolvente', 4, '', 1),
(209, 1, 2, 'Calcio metalico ', '25', 2, '', 5, '', 5, 'se quedo por falta de espacio', '', '', 7, '', 1),
(210, 1, 2, 'Calcio purificado ', '500', 2, '', 14, '', 5, 'se quedo por falta de espacio', '', '', 7, '', 1),
(211, 1, 2, 'Calcio activado ', '300', 2, '', 5, '', 5, 'prepa', '', '', 5, '', 1),
(212, 1, 2, 'Carburo de calcio', '500', 2, '', 5, '', 5, 'se quedo por falta de espacio', '', '', 7, '', 1),
(213, 1, 2, 'Eter de petróleo', '2500', 1, '', 14, '', 5, 'prepa', '', 'preparacion de soluciones', 5, '', 1),
(214, 1, 2, 'Eter etílico', '1000', 1, '', 14, '', 5, 'prepa', '', 'preparacion de soluciones', 5, '', 1),
(215, 1, 2, 'Fenolftaleína', '250', 1, '', 14, '', 5, 'prepa', '', 'indicador', 5, '', 1),
(216, 1, 2, 'fierro limadura', '500', 2, '', 14, '', 5, 'prepa', '', '', 5, '', 1),
(218, 1, 2, 'formaldehido', '4000', 1, '', 15, '', 5, 'QFB y prepa', '', 'diseccion', 7, '', 1),
(219, 1, 2, 'Hexano', '4000', 1, '', 14, '', 5, 'se queda por falta de espacio', '', '', 7, '', 1),
(220, 1, 2, 'Magnesio cinta', '1/4', 8, '', 12, '', 5, 'prepa', '', '', 5, '', 1),
(221, 1, 2, 'Nitro benceno', '500', 1, '', 14, '', 5, 'se queda por falta de espacio', '', '', 7, '', 1),
(222, 1, 2, 'Tolueno', '1500', 1, '', 14, '', 5, 'medicina', '', 'disolvente', 4, '', 1),
(223, 1, 2, 'Xileno', '2500', 1, '', 14, '', 5, 'medicina', '', 'disolvente', 4, '', 1),
(224, 1, 2, 'Acetato de cobre', '250', 2, '', 5, '', 5, 'prepa', '', '', 5, '', 1),
(225, 1, 2, 'Ácido cítrico anhidro', '500', 2, '', 5, '', 5, 'prepa', '', 'preparacion de soluciones', 5, '', 1),
(226, 1, 2, 'Ácido benzoíco', '800', 2, '', 5, '', 5, 'prepa', '', '', 5, '', 1),
(227, 1, 2, 'Ácido salicílico', '250', 2, '', 5, '', 5, 'prepa', '', '', 5, '', 1),
(228, 1, 2, 'A´cido sulfanílico', '100', 2, '', 5, '', 5, 'prepa', '', '', 5, '', 1),
(229, 1, 2, 'Benzoato de sodio', '1500', 1, '', 5, '', 5, 'prepa', '', '', 5, '', 1),
(230, 1, 2, 'Bisulfito de sodio', '500', 1, '', 5, '', 5, 'prepa', '', '', 5, '', 1),
(231, 1, 2, 'carbonato de calcio', '10', 2, '', 5, '', 5, 'prepa', '', '', 5, '', 1),
(232, 1, 2, 'carbonato de sodio', '300', 2, '', 5, '', 5, 'prepa', '', '', 5, '', 1),
(233, 1, 2, 'Caseína anhidro', '500', 2, '', 5, '', 5, 'prepa', '', '', 5, '', 1),
(234, 1, 2, 'Citrato de sodio', '1000', 2, '', 5, '', 5, 'prepa', '', '', 5, '', 1),
(235, 1, 2, 'Cloruro de calcio', '500', 2, '', 5, '', 5, 'prepa', '', '', 5, '', 1),
(236, 1, 2, 'Cloruro de potasio', '800', 2, '', 5, '', 5, 'prepa', '', '', 5, '', 1),
(237, 1, 2, 'Cloruro de sodio', '500', 2, '', 5, '', 5, 'medicina, QFB y prepa', '', 'preparacion de soluciones', 5, '', 1),
(238, 1, 2, 'Estaño metal', '50', 2, '', 5, '', 5, 'prepa', '', '', 5, '', 1),
(239, 1, 2, 'Ferrocianuro de potasio', '500', 2, '', 5, '', 5, 'prepa', '', '', 5, '', 1),
(240, 1, 2, 'Fosfato de sodio dibasico anhidro', '500', 2, '', 5, '', 5, 'prepa', '', '', 5, '', 1),
(241, 1, 2, 'Fosfato de sodio dibasico heptahidratado', '500', 2, '', 5, '', 5, 'prepa', '', '', 5, '', 1),
(242, 1, 2, 'Óxido de magnesio', '500', 2, '', 5, '', 5, 'prepa', '', '', 5, '', 1),
(243, 1, 2, 'Sacarosa ', '500', 2, '', 5, '', 5, 'QFB', '', 'preparacion de soluciones', 5, '', 1),
(244, 1, 2, 'Sulfato de cobre', '500', 2, '', 5, '', 5, 'prepa', '', '', 5, '', 1),
(245, 1, 2, 'Sulfato cúprico', '1000', 2, '', 5, '', 5, 'prepa', '', '', 5, '', 1),
(246, 1, 2, 'Sulfato de magnesio', '500', 1, '', 14, '', 5, 'prepa', '', '', 5, '', 1),
(247, 1, 2, 'Sulfato de zinc', '1000', 2, '', 5, '', 5, 'prepa y medicina', '', '', 5, '', 1),
(248, 1, 2, 'Agua de bromo', '1000', 1, '', 14, '', 5, 'prepa', '', '', 5, '', 1),
(249, 1, 2, 'Cloroformo', '800', 1, '', 14, '', 5, 'prepa', '', '', 5, '', 1),
(250, 1, 2, 'Formol', '3000', 1, '', 5, '', 5, 'prepa y QFB', '', 'diseccion', 5, '', 1),
(251, 1, 2, 'Lugol', '1800', 1, '', 14, '', 5, 'prepa y medicina', '', '', 4, '', 1),
(252, 1, 2, 'Acetato de plomo ', '500', 2, '', 5, '', 5, 'prepa', '', '', 5, '', 1),
(253, 1, 2, 'Azufre de precipitado', '800', 2, '', 15, '', 5, 'prepa', '', '', 5, '', 1),
(254, 1, 2, 'Cafeína', '100', 2, '', 5, '', 5, 'QFB', '', '', 5, '', 1),
(255, 1, 2, 'EDTA', '500', 1, '', 5, '', 5, 'medicina y prepa', '', '', 5, '', 1),
(256, 1, 2, 'Mercurio', '200', 2, '', 1, '', 5, 'prepa', '', '', 5, '', 1),
(257, 1, 2, 'óxido de plomo ', '500', 2, '', 5, '', 5, 'prepa', '', '', 5, '', 1),
(258, 1, 2, 'óxido de plomo rojo', '100', 2, '', 14, '', 5, 'prepa', '', '', 5, '', 1),
(259, 1, 2, 'Solución de ringer', '1000', 1, '', 14, '', 5, 'QFB', '', '', 5, '', 1),
(260, 1, 2, 'Cloruro de cobalto', '500', 2, '', 14, '', 5, 'prepa', '', '', 5, '', 1),
(261, 1, 2, 'hidroxido de sodio', '100', 2, '', 5, '', 5, 'prepa', '', '', 5, '', 1),
(262, 1, 2, 'Tetraborato de sodio', '300', 2, '', 14, '', 5, 'prepa', '', '', 5, '', 1),
(263, 1, 2, 'Nitrato de potasio', '500', 2, '', 5, '', 5, 'prepa', '', '', 5, '', 1),
(264, 1, 2, 'Nitrato de zinc ', '500', 2, '', 11, '', 5, 'prepa', '', '', 5, '', 1),
(265, 1, 2, 'Persulfato de potasio', '1500', 2, '', 5, '', 5, 'prepa', '', '', 5, '', 1),
(266, 1, 2, 'Aceite de inmersión', '300', 1, '', 14, '', 5, 'medicina y QFB', '', '', 1, '', 1),
(267, 1, 2, 'Alcohol Ácido orth', '500', 1, '', 5, '', 5, 'medicina', '', '', 1, '', 1),
(268, 1, 2, 'Azul de toluidina', '1000', 1, '', 14, '', 5, 'medicina', '', '', 5, '', 1),
(269, 1, 2, 'Colorante de giemsa ', '1000', 1, '', 14, '', 5, 'medicina', '', '', 5, '', 1),
(270, 1, 2, 'Colorante de wright', '1000', 1, '', 14, '', 5, 'medicina', '', '', 5, '', 1),
(271, 1, 2, 'Fucsina fenicada', '1800', 1, '', 14, '', 5, 'medicina', '', '', 4, '', 1),
(272, 1, 2, 'Hematoxilina de harris', '1000', 1, '', 14, '', 5, 'medicina', '', '', 5, '', 1),
(273, 1, 2, 'Safranina', '1500', 1, '', 14, '', 5, 'medicina', '', '', 4, '', 1),
(274, 1, 2, 'Tinción de gram', '3', 6, '', 14, '', 5, 'medicina', '', '', 1, '', 1),
(275, 1, 2, 'Tinción de ziehl neelsen', '2', 6, '', 14, '', 5, 'medicina', '', '', 1, '', 1),
(276, 1, 2, 'Tintura yodo 5%', '250', 1, '', 14, '', 5, 'medicina', '', '', 5, '', 1),
(277, 1, 2, 'Ácido acético', '1300', 1, '', 15, '', 5, 'prepa', '', '', 5, '', 1),
(278, 1, 2, 'Ácido clorhídrico', '700', 1, '', 14, '', 5, 'prepa', '', '', 5, '', 1),
(279, 1, 2, 'Ácido nítrico', '2000', 1, '', 14, '', 5, 'prepa', '', '', 5, '', 1),
(280, 1, 2, 'Ácido sulfúrico', '1500', 1, '', 14, '', 5, 'prepa', '', '', 5, '', 1),
(281, 2, 2, 'Agar nutritivo', '1000', 2, '', 5, '', 5, 'Igroscópico', '', 'Medios de cultivo', 2, '', 1),
(282, 2, 2, 'Extracto de levadura', '500', 2, '', 5, '', 5, 'Igroscópico', '', 'Medios de cultivo', 4, '', 1),
(283, 2, 2, 'Agar citrato de simmons', '1000', 2, '', 5, '', 5, 'Igroscópico', '', 'Medios de cultivo', 4, '', 1),
(284, 2, 2, 'Agar de hierro y lisina', '500', 2, '', 5, '', 5, 'Igroscópico', '', 'Medios de cultivo', 4, '', 1),
(285, 2, 2, 'Agar de hierro y triple azúcar', '500', 2, '', 5, '', 5, 'Igroscópico', '', 'Medios de cultivo', 4, '', 1),
(286, 2, 2, 'Agar infusión cerebro corazón', '1000', 2, '', 5, '', 5, 'Igroscópico', '', 'Medios de cultivo', 4, '', 1),
(287, 2, 2, 'Caldo infusión cerebro corazón', '500', 2, '', 5, '', 5, 'Igroscópico', '', 'Medios de cultivo', 4, '', 1),
(288, 2, 2, 'Agar mueller hinton', '1000', 2, '', 5, '', 5, 'Igroscópico', '', 'Medios de cultivo', 4, '', 1),
(289, 2, 2, 'Agar sal y manitol', '500', 2, '', 5, '', 5, 'Igroscópico', '', 'Medios de cultivo', 2, '', 1),
(290, 2, 2, 'Base de agar sangre', '500', 2, '', 5, '', 5, 'Igroscópico', '', 'Medios de cultivo', 2, '', 1),
(291, 2, 2, 'Medio MIO', '1000', 2, '', 5, '', 5, 'Igroscópico', '', 'Medios de cultivo', 2, '', 1),
(292, 2, 2, 'Agar de hierro kliger', '500', 2, '', 5, '', 5, 'Igroscópico', '', 'Medios de cultivo', 4, '', 1),
(293, 2, 2, 'Agar biggy', '1000', 2, '', 5, '', 5, 'Igroscópico', '', 'Medios de cultivo', 4, '', 1),
(294, 2, 2, 'Peptona de caseína', '500', 2, '', 5, '', 5, 'Igroscópico', '', 'Medios de cultivo', 6, '', 1),
(295, 2, 2, 'Agar salmonella y shigella', '1500', 2, '', 5, '', 5, 'Igroscópico', '', 'Medios de cultivo', 2, '', 1),
(296, 2, 2, 'Agar eosina y azul de metileno', '500', 2, '', 5, '', 5, 'Igroscópico', '', 'Medios de cultivo', 2, '', 1),
(297, 2, 2, 'Agar Mac conkey', '1000', 2, '', 5, '', 5, 'Igroscópico', '', 'Medios de cultivo', 2, '', 1),
(298, 2, 2, 'Agar bacteriológico', '1000', 2, '', 5, '', 5, 'Igroscópico', '', 'Medios de cultivo', 2, '', 1),
(299, 2, 2, 'Agar mycosel', '500', 2, '', 5, '', 5, 'Igroscópico', '', 'Medios de cultivo', 2, '', 1),
(300, 2, 2, 'Medio Basl  OF', '500', 2, '', 5, '', 5, 'Igroscópico', '', 'Medios de cultivo', 4, '', 1),
(301, 2, 2, 'Medio MRVP', '500', 2, '', 5, '', 5, 'Igroscópico', '', 'Medios de cultivo', 4, '', 1),
(302, 2, 2, 'Caldo nutritivo', '2500', 2, '', 5, '', 5, 'Igroscópico', '', 'Medios de cultivo', 2, '', 1),
(303, 2, 2, 'Agar dextrosa saborau', '1000', 2, '', 5, '', 5, 'Igroscópico', '', 'Medios de cultivo', 2, '', 1),
(304, 2, 2, 'Cloro', '2 X 150', 1, '', 18, '', 5, 'Estable 60-D', '', 'Pruebas Bioquímicas', 4, '', 1),
(305, 2, 2, 'Fósforo', '2 X 150', 1, '', 18, '', 5, 'Estable 60-D', '', 'Pruebas Bioquímicas', 4, '', 1),
(306, 2, 2, 'Amylasa-LQ', '20 X 2', 1, '', 18, '', 5, 'Estable 60-D', '', 'Pruebas Bioquímicas', 4, '', 1),
(307, 2, 2, 'Ácido úrico', '10 X 20', 1, '', 18, '', 5, 'Vial-enzimas', '', 'Pruebas Bioquímicas', 3, '', 1),
(308, 2, 2, 'LDL', '1 x 30', 1, '', 18, '', 5, 'Vial-enzimas', '', 'Pruebas Bioquímicas', 4, '', 1),
(309, 2, 2, 'Bilirrubina Total y Directa', '1 X 150', 1, '', 18, '', 5, 'Estable 60-D', '', 'Pruebas Bioquímicas', 4, '', 1),
(310, 2, 2, 'Creatinina', '2 X 150', 1, '', 18, '', 5, 'Estable 10-D', '', 'Pruebas Bioquímicas', 4, '', 1),
(311, 2, 2, 'Hemoglobina', '4 X 5', 1, '', 18, '', 5, 'Estable 2 Mes', '', 'Pruebas Bioquímicas', 4, '', 1),
(312, 2, 2, 'Hemogloina glicocilada', '60 X 3', 1, '', 18, '', 5, 'Estable 60-D', '', 'Pruebas Bioquímicas', 4, '', 1),
(313, 2, 2, 'Fosfatasa alcalina', '40 X 3', 1, '', 18, '', 5, 'Estable 60-D', '', 'Pruebas Bioquímicas', 4, '', 1),
(314, 2, 2, 'Fosfatasa ácida', '41 X 3', 1, '', 18, '', 5, 'Estable 60-D', '', 'Pruebas Bioquímicas', 4, '', 1),
(315, 2, 2, 'GPT (ALT)', '20 X 2', 1, '', 18, '', 5, 'Comprimidos', '', 'Pruebas Bioquímicas', 3, '', 1),
(316, 2, 2, 'GOT (AST)', '21 X 2', 1, '', 18, '', 5, 'Comprimidos', '', 'Pruebas Bioquímicas', 3, '', 1),
(317, 2, 2, 'Hemoglobina', '4 X 5', 1, '', 18, '', 5, 'Estable 2 Mes', '', 'Pruebas Bioquímicas', 4, '', 1),
(318, 2, 2, 'Proteína C reactiva latex P.D.', '50', 6, '', 18, '', 5, 'Aglutinación', '', 'Prueba Directa', 4, '', 1),
(319, 2, 2, 'PT', '4 x 4', 1, '', 18, '', 5, 'Estable 7- D', '', 'Prueba Diagnóstica', 4, '', 1),
(320, 2, 2, 'APTT', '5 x 4', 1, '', 18, '', 5, 'Estable 1-Mes', '', 'Prueba Diagnóstica', 4, '', 1),
(321, 2, 2, 'VDRL', '1 X 0.5', 1, '', 18, '', 5, 'Estable/Refrig', '', 'Prueba Diagnóstica', 4, '', 1),
(322, 2, 2, 'Trigliceridos', '1 X 100', 1, '', 18, '', 5, 'Estable 60-D', '', 'Pruebas Bioquímicas', 3, '', 1),
(323, 2, 2, 'Colesterol', '2 X 250', 1, '', 18, '', 5, 'Estable 60-D', '', 'Pruebas Bioquímicas', 3, '', 1),
(324, 2, 2, 'Urea', '10 X 20', 1, '', 18, '', 5, 'Vial-enzimas', '', 'Pruebas Bioquímicas', 3, '', 1),
(325, 2, 2, 'Acetato cúprico', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 3, '', 1),
(326, 2, 2, 'Ácido benzoico', '250', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 6, '', 1),
(327, 2, 2, 'Ácido esteárico', '200', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(328, 2, 2, 'Ácido láctico al 80%', '250', 1, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 5, '', 1),
(329, 2, 2, 'Bicarbonato de sodio', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 3, '', 1),
(330, 2, 2, 'Borato de sodio', '500', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 5, '', 1),
(331, 2, 2, 'Bromuro de potasio', '500', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 5, '', 1),
(332, 2, 2, 'Bromuro de sodio', '500', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(333, 2, 2, 'Citrato de potacio', '500', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 5, '', 1),
(334, 2, 2, 'Citrato de sodio', '500', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(335, 2, 2, 'Cloruro de amonio', '500', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(336, 2, 2, 'Cloruro estañoso', '500', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(337, 2, 2, 'Cloruro de cobalto', '500', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 6, '', 1),
(338, 2, 2, 'Cloruro de zinc', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(339, 2, 2, 'Dioxido de manganeso (mineral)', '500', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(340, 2, 2, 'Dicromato de potasio', '500', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(341, 2, 2, 'Estaño', '500', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(342, 2, 2, 'Hidróxido de sodio', '500', 2, '', 5, '', 5, 'Igroscópico', '', 'Preparación de soluciones', 2, '', 1),
(343, 2, 2, 'Sulfato de amonio 0.1 N', '2', 3, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 3, '', 1),
(344, 2, 2, 'Sulfato ferroso', '500', 2, '', 5, '', 5, 'Igroscópico', '', 'Preparación de soluciones', 5, '', 1),
(345, 2, 2, 'Sulfato de amonio', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(346, 2, 2, 'Sulfato de bario', '500', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 6, '', 1),
(347, 2, 2, 'Sulfato de magnesio', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 3, '', 1),
(348, 2, 2, 'Tartrato de sodio', '500', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(349, 2, 2, 'Ácido sulfúrico', '1', 3, '', 14, '', 5, 'Corrosivo', '', 'Preparación de soluciones', 2, '', 1),
(350, 2, 2, 'Ácido sulfúrico 0.1 N', '1', 3, '', 14, '', 5, 'Corrosivo', '', 'Preparación de soluciones', 3, '', 1),
(351, 2, 2, 'Ácido tricloroacético', '250', 1, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(352, 2, 2, 'Hidróxido de amonio', '2', 3, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 3, '', 1),
(353, 2, 2, 'Hidróxido de sodio 1 N', '1', 3, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 3, '', 1),
(354, 2, 2, 'Hidróxido de sodio 0.1 N', '1', 3, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 3, '', 1),
(355, 2, 2, 'Hidróxido de potasio al 10%', '1', 3, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 1, '', 1),
(356, 2, 2, 'Resorcinol al 0.1%', '500', 1, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(357, 2, 2, 'Antimonio', '100', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(358, 2, 2, 'Acetato de plomo', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 3, '', 1),
(359, 2, 2, '1-Naftol', '50', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 0),
(360, 2, 2, 'Azufre', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(361, 2, 2, 'Bifftalato de ptasio', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(362, 2, 2, 'Bromuro de sodio', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 5, '', 1),
(363, 2, 2, 'Cafeína anhidra', '100', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 6, '', 1),
(364, 2, 2, 'Cianuro de potasio', '100', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 6, '', 1),
(365, 2, 2, 'Clorato de potasio', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 6, '', 1),
(366, 2, 2, 'Cloruro férrico', '500', 2, '', 5, '', 5, 'Igroscópico', '', 'Preparación de soluciones', 4, '', 1),
(367, 2, 2, 'Cloruro de cadmio', '500', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 6, '', 1),
(368, 2, 2, 'Cloruro de mercurio', '100', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 1, '', 1),
(369, 2, 2, 'Dióxido de bario', '500', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 5, '', 1),
(370, 2, 2, 'Dióxido de manganeso', '500', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(371, 2, 2, 'Ferricianuro de potasio', '250', 1, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(372, 2, 2, 'Ferrocianuro de potasio', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(373, 2, 2, 'Mercurio ', '100', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(374, 2, 2, 'Nitrato de potasio', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(375, 2, 2, 'Nitrato de sodio', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(376, 2, 2, 'Iodo', '100', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 3, '', 1),
(377, 2, 2, 'Oxalato de amonio', '500', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 5, '', 1),
(378, 2, 2, 'Oxido de mercurio rojo', '100', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 5, '', 1),
(379, 2, 2, 'Oxido de cobre', '250', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 5, '', 1),
(380, 2, 2, 'Oxalato de sodio', '500', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 5, '', 1),
(381, 2, 2, 'Oxido de plomo', '500', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 3, '', 1),
(382, 2, 2, 'Sulfato cúprico', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 1, '', 1),
(383, 2, 2, 'Sulfato de hidrazina anhidro cristal', '100', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 5, '', 1),
(384, 2, 2, 'Sulfato de cobre II', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(385, 2, 2, 'Tolueno', '1', 3, '', 14, '', 5, 'Volatil', '', 'Preparación de soluciones', 4, '', 1),
(386, 2, 2, 'Yodato de mercurio', '100', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 5, '', 1),
(387, 2, 2, 'Iodo ', '100', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 3, '', 1),
(388, 2, 2, 'Agua de bromo', '700', 1, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(389, 2, 2, 'Ácido fosfórico', '1', 3, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(390, 2, 2, 'Bromo', '100', 1, '', 14, '', 5, 'Volatil', '', 'Preparación de soluciones', 6, '', 1),
(391, 2, 2, 'Cloroformo', '1', 3, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 1, '', 1),
(392, 2, 2, 'Nitrobenceno', '2', 3, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(393, 2, 2, 'Aluminio polvo', '100', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 6, '', 1),
(394, 2, 2, 'Alumnio polvo', '250', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 6, '', 1),
(395, 2, 2, 'Acetyl cloride', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 6, '', 1),
(396, 2, 2, 'Ácido pícrico', '500', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(397, 2, 2, 'Calcio purificado', '500', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(398, 2, 2, 'Linadura de fierro', '500', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(399, 2, 2, 'Magnesio en viruta', '250', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 3, '', 1),
(400, 2, 2, 'Naftaleno en bolas', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 1, '', 1),
(401, 2, 2, 'Tartrato de sodio', '1000', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(402, 2, 2, 'Tetraborato de sodio', '500', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(403, 2, 2, 'Zinc', '500', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(404, 2, 2, 'Acetato de etilo', '1', 3, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(405, 2, 2, 'Ácido acético glacial', '1', 3, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 1, '', 1),
(406, 2, 2, 'Acetona', '500', 1, '', 5, '', 5, 'Volatil', '', 'Preparación de soluciones', 2, '', 1),
(407, 2, 2, 'Alcohol octílico', '500', 1, '', 14, '', 5, 'Volatil', '', 'Preparación de soluciones', 4, '', 1),
(408, 2, 2, 'Alcohol amílico', '500', 1, '', 14, '', 5, 'Volatil', '', 'Preparación de soluciones', 4, '', 1),
(409, 2, 2, 'Alcohol etílico al 96%', '2', 3, '', 5, '', 5, 'Volatil', '', 'Preparación de soluciones', 1, '', 1),
(410, 2, 2, 'Alcohol isopropílico', '1', 3, '', 14, '', 5, 'Volatil', '', 'Preparación de soluciones', 4, '', 1),
(411, 2, 2, 'Al cohol butílico', '500', 1, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 5, '', 1),
(412, 2, 2, 'Benceno', '1', 3, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 3, '', 1),
(413, 2, 2, 'Ciclo hexanol', '1', 3, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 5, '', 1),
(414, 2, 2, 'Dimetil sulforoxido', '250', 1, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 6, '', 1),
(415, 2, 2, 'Eter de petroleo', '2', 3, '', 14, '', 5, 'Volatil', '', 'Preparación de soluciones', 3, '', 1),
(416, 2, 2, 'Eter etílico anhídrido', '3', 3, '', 14, '', 5, 'Volatil', '', 'Preparación de soluciones', 3, '', 1),
(417, 2, 2, 'Formaldehido', '1', 3, '', 14, '', 5, 'Volatil', '', 'Preparación de soluciones', 4, '', 1),
(418, 2, 2, 'Formaldehido al 37%', '3', 3, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(419, 2, 2, 'Hexano', '2', 3, '', 14, '', 5, 'Volatil', '', 'Preparación de soluciones', 4, '', 1),
(420, 2, 2, 'Tolueno', '2', 3, '', 14, '', 5, 'Volatil', '', 'Preparación de soluciones', 4, '', 1),
(421, 2, 2, 'Xileno', '500', 1, '', 14, '', 5, 'Volatil', '', 'Preparación de soluciones', 5, '', 1),
(422, 2, 2, 'Aceite de algodón', '500', 1, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 1, '', 1),
(423, 2, 2, 'Aceite mineral', '500', 1, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 1, '', 1),
(424, 2, 2, 'Ácido cítrico', '100', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 3, '', 1),
(425, 2, 2, 'Acetato de sodio', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(426, 2, 2, 'Ácido salicílico', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(427, 2, 2, 'Ácido tánico', '500', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(428, 2, 2, 'Ácido aminoacético (glicina)', '25', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 3, '', 1),
(429, 2, 2, 'Almidón', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 1, '', 1),
(430, 2, 2, 'Ácido estéarico', '500', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(431, 2, 2, 'Ácido glutámico', '25', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 3, '', 1),
(432, 2, 2, 'Bromuro de sodio', '100', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(433, 2, 2, 'Carbón activado vegetal', '1000', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(434, 2, 2, 'Carbonato de calcio', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(435, 2, 2, 'Carbonato de potasio', '250', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(436, 2, 2, 'Carbonato de sodio', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(437, 2, 2, 'Caseína', '250', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(438, 2, 2, 'Cisteína', '25', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(439, 2, 2, 'Cloruro de calcio anhidro', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(440, 2, 2, 'Cloruro de potasio', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(441, 2, 2, 'Cloruro de sodio', '1000', 2, '', 5, '', 5, 'Igroscópico', '', 'Preparación de soluciones', 1, '', 1),
(442, 2, 2, 'Cloranfenicol', '15', 1, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(443, 2, 2, 'Dextrosa anhidra', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(444, 2, 2, 'Dimetil glioxina', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(445, 2, 2, 'Fosfato de sodio dibásico', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(446, 2, 2, 'Fosfato de sodio monobásico', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(447, 2, 2, 'Hexametafosfato de sodio', '500', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 6, '', 1),
(448, 2, 2, 'Hidróxido de calcio', '100', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(449, 2, 2, 'Metil celulosa Q.P.', '250', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(450, 2, 2, 'Ninhidrina', '100', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 3, '', 1),
(451, 2, 2, 'Metabisulfito de sodio', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(452, 2, 2, 'Resina cambiadora de cationes', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 5, '', 1),
(453, 2, 2, 'Sacarosa', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 1, '', 1),
(454, 2, 2, 'Salicilato de sodio', '200', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(455, 2, 2, 'Silica gel', '500', 2, '', 5, '', 5, 'Igroscópico', '', 'Indicadora  Humedad', 1, '', 1),
(456, 2, 2, 'Sulfato de amonio', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(457, 2, 2, 'Sulfato férrico', '250', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(458, 2, 2, 'Sulfato de manganeso', '100', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(459, 2, 2, 'Sulfato de magnesio', '500', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(460, 2, 2, 'Sulfato de zinc', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(461, 2, 2, 'Sulfato de zinc', '2.5', 4, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(462, 2, 2, 'Tiosulfato de sodio', '1000', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(463, 2, 2, 'Yoduro de potasio', '250', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(464, 2, 2, 'Azul de bromofenol', '10', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 3, '', 1),
(465, 2, 2, 'Lumninol', '10', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(466, 2, 2, 'Alfa-naftol en alcohol al 5%', '500', 1, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(467, 2, 2, 'Reactivo de benedict', '500', 1, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 3, '', 1),
(468, 2, 2, 'Solución de fehling B', '2', 3, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(469, 2, 2, 'Solución de fehling A', '2', 3, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(470, 2, 2, 'Solución buffer de fostatos pH 7', '500', 1, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 1, '', 1),
(471, 2, 2, 'Solución buffer biftalato pH 4', '1', 3, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 1, '', 1),
(472, 2, 2, 'Solución reguladora borato pH 10', '1', 3, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 3, '', 1),
(473, 2, 2, 'Solución ringer', '1', 3, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(474, 2, 2, 'Solución inyectable estéril', '1', 3, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(475, 2, 2, 'Glicerina', '100', 1, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(476, 2, 2, 'Tween', '300', 1, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(477, 2, 2, 'Nitrato de amonio', '250', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(478, 2, 2, 'Nitrato cúprico', '100', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(479, 2, 2, 'Nitrato férrico nonahidratado', '100', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(480, 2, 2, 'Nitrato de plata', '500', 2, '', 5, '', 5, 'Igroscópico', '', 'Preparación de soluciones', 4, '', 1),
(481, 2, 2, 'Nitrato de zinc', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(482, 2, 2, 'Nitrato de sodio', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(483, 2, 2, 'Nitrito de sodio', '100', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(484, 2, 2, 'Nitrato de plomo', '250', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(485, 2, 2, 'Nitrato de potasio', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(486, 2, 2, 'Nitropusiato sodio', '25', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(487, 2, 2, 'Nitrato de estroncio', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 5, '', 1),
(488, 2, 2, 'Persulfato de potasio', '500', 2, '', 5, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(489, 2, 2, 'Permanganato de potasio', '500', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 4, '', 1),
(490, 2, 2, 'Ácido nítrico', '1', 3, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 1, '', 1),
(491, 2, 2, 'Tinción de gram', '3 X 125', 1, '', 14, '', 5, 'Estable', '', 'Teñir Bacterias', 2, '', 1),
(492, 2, 2, 'Tinción de ziehl neelsen ', '1 X 125', 1, '', 14, '', 5, 'Estable', '', 'Teñir Bacterias', 2, '', 1),
(493, 2, 2, 'Alcohol acetona', '1', 3, '', 5, '', 5, 'Volatil', '', 'Teñir Bacterias', 2, '', 1),
(494, 2, 2, 'Alcohol ácido', '1', 3, '', 5, '', 5, 'Estable', '', 'Teñir Bacterias', 2, '', 1),
(495, 2, 2, 'Aceto carmín ', '125', 1, '', 14, '', 5, 'Estable', '', 'Teñir Bacterias', 4, '', 1),
(496, 2, 2, 'Aceite de inmersión', '800', 1, '', 14, '', 5, 'Estable', '', 'Observación-Microscopio', 1, '', 1);
INSERT INTO `tbl_material` (`Pk_material`, `fk_laboratorios`, `fk_clasematerial`, `DescripcionMaterial`, `CantidadMaterial`, `Fk_UnidadMedida`, `MedidasMaterial`, `Fk_TipoMaterial`, `MarcaMaterial`, `Fk_EstadoMaterial`, `ObservacionesMaterial`, `Almacenado`, `Uso`, `fk_frecuenciauso`, `NumeroInventario`, `ActivoMaterial`) VALUES
(497, 2, 2, 'Azul de cresil brillante', '500', 1, '', 14, '', 5, 'Estable', '', 'Teñir Celulas', 4, '', 1),
(498, 2, 2, 'Azul de metileno loefler', '500', 1, '', 14, '', 5, 'Estable', '', 'Teñir Bacterias', 1, '', 1),
(499, 2, 2, 'Azul de metileno 1%', '500', 1, '', 14, '', 5, 'Estable', '', 'Teñir Bacterias', 1, '', 1),
(500, 2, 2, 'Azul de algodón', '10', 2, '', 14, '', 5, 'Estable', '', 'Teñir Bacterias', 3, '', 1),
(501, 2, 2, 'Azul de algodón solución A', '250', 1, '', 14, '', 5, 'Estable', '', 'Teñir Bacterias', 1, '', 1),
(502, 2, 2, 'Colorante de wright', '1', 3, '', 14, '', 5, 'Estable', '', 'Teñir Celulas', 1, '', 1),
(503, 2, 2, 'Naranja de metilo', '25', 2, '', 14, '', 5, 'Estable', '', 'Indicador ', 1, '', 1),
(504, 2, 2, 'Lacto fenol solución B', '500', 1, '', 14, '', 5, 'Estable', '', 'Teñir Bacterias', 1, '', 1),
(505, 2, 2, 'Rojo fenol', '10', 2, '', 14, '', 5, 'Estable', '', 'Teñir Celulas', 1, '', 1),
(506, 2, 2, 'Rojo congo', '10', 2, '', 14, '', 5, 'Estable', '', 'Indicador', 1, '', 1),
(507, 2, 2, 'Rojo de metilo', '25', 2, '', 14, '', 5, 'Estable', '', 'Indicador', 1, '', 1),
(508, 2, 2, 'Rojo de fenol', '500', 1, '', 5, '', 5, 'Estable', '', 'Indicador ', 1, '', 1),
(509, 2, 2, 'Sudan III alcohólica al 0.02%', '500', 1, '', 5, '', 5, 'Estable', '', 'Teñir Celulas', 4, '', 1),
(510, 2, 2, 'Sudan IV', '5', 2, '', 14, '', 5, 'Estable', '', 'Teñir Celulas', 4, '', 1),
(511, 2, 2, 'Orceina Cintética', '5', 2, '', 14, '', 5, 'Estable', '', 'Preparación de soluciones', 3, '', 1),
(512, 2, 2, 'Verde malaquita 1%', '500', 1, '', 14, '', 5, 'Estable', '', 'Teñir Celulas', 1, '', 1),
(513, 2, 2, 'Cristal violeta ', '500', 1, '', 14, '', 5, 'Estable', '', 'Teñir Bacterias', 1, '', 1),
(514, 2, 2, 'Yodo lugol', '500', 1, '', 14, '', 5, 'Estable', '', 'Teñir Bacterias', 1, '', 1),
(515, 2, 2, 'Multidiscos combinados', '1', 7, '', 5, '', 5, 'Estable', '', 'Antibiograma', 1, '', 1),
(516, 2, 2, 'Anti-A', '10', 1, '', 1, '', 5, 'Estable', '', 'Grupos Sanguíneos', 3, '', 1),
(517, 2, 2, 'Anti-B', '10', 1, '', 1, '', 5, 'Estable', '', 'Grupos Sanguíneos', 3, '', 1),
(518, 2, 2, 'Anti-AB', '10', 1, '', 1, '', 5, 'Estable', '', 'Grupos Sanguíneos', 3, '', 1),
(519, 2, 2, 'Albúmina bobina', '40', 1, '', 1, '', 5, 'Estable', '', 'Grupos Sanguíneos', 3, '', 1),
(520, 2, 2, 'Suero de coms', '10', 1, '', 1, '', 5, 'Estable', '', 'Grupos Sanguíneos', 3, '', 1),
(521, 2, 2, 'Acetaldeido ', '500', 1, '', 5, '', 5, '', '', 'preparacion de soluciones', 4, '', 1),
(522, 2, 2, 'Acetato de etilo', '1000', 1, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(523, 2, 2, 'Ácido pícrico', '1000', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(524, 2, 2, 'Ácido propiónico', '1250', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(525, 2, 2, 'Alcohol amílico', '1000', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(526, 2, 2, 'Alcohol butílico', '3000', 1, '', 15, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(527, 2, 2, 'Alcohol metílico', '4000', 1, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(528, 2, 2, 'Alcohol terbutílico', '800', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(529, 2, 2, 'Alcohol isopropílico', '200', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(530, 2, 2, 'Anhídrido acético', '1300', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(531, 2, 2, 'Benceno', '1800', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(532, 2, 2, 'Benzaldehido', '1000', 1, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(533, 2, 2, 'Balsamo de canada', '150', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(534, 2, 2, 'Fenolftaleína', '50', 2, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(535, 2, 2, 'Formaldehido', '3000', 1, '', 17, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(536, 2, 2, 'Formalina', '1000', 1, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(537, 2, 2, 'Keroseno', '800', 1, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(538, 2, 2, 'Magnesio cinta', '01-abr', 8, '', 13, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(539, 2, 2, 'Nitrato de plata', '300', 2, '', 11, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(540, 2, 2, 'Permanganato de sodio', '100', 2, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(541, 2, 2, 'Salicilato de metilo', '1000', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(542, 2, 2, 'Aceite de algodón', '500', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 5, '', 1),
(543, 2, 2, 'Aceite mineral', '500', 1, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(544, 2, 2, 'Acetato de sodio', '800', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 4, '', 1),
(545, 2, 2, 'Ácido acetil salicilico', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 4, '', 1),
(546, 2, 2, 'Acido Benzoico', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(547, 2, 2, 'Ácido cítrico anhidro', '1000', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 4, '', 1),
(548, 2, 2, 'Ácido tánico', '800', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(549, 2, 2, 'Ácido tartárico', '400', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(550, 2, 2, 'Ácido salicílico', '250', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(551, 2, 2, 'Agar agar', '25', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(552, 2, 2, 'Benedict', '800', 1, '', 5, '', 5, '', '', 'identificacio de carbohidratos', 7, '', 1),
(553, 2, 2, 'Biuret', '500', 1, '', 14, '', 5, '', '', 'identificacio de carbohidratos', 7, '', 1),
(554, 2, 2, 'Buffer pH 7', '1000', 1, '', 5, '', 5, '', '', 'indicador de referencia', 7, '', 1),
(555, 2, 2, 'Buffer pH 6.4', '1000', 1, '', 5, '', 5, '', '', 'indicador de referencia', 7, '', 1),
(556, 2, 2, 'Carbonato de potasio', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(557, 2, 2, 'Caseína anhidro', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(558, 2, 2, 'Citrato de Sodio', '1000', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(559, 2, 2, 'Cloruro de benzalconio', '250', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(560, 2, 2, 'Dextrosa anhidra', '1000', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(561, 2, 2, 'Eosina amarillenta', '50', 2, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(562, 2, 2, 'Ferrocianuro de potasio', '600', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(563, 2, 2, 'Fosfato de sodio dibasico anhidro', '1000', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(564, 2, 2, 'Glicerina purificada', '3500', 1, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(565, 2, 2, 'Glucosa anhidra', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(566, 2, 2, 'Granalla de zinc', '400', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(567, 2, 2, 'Goma arabiga', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(568, 2, 2, 'Hidróxido de calcio', '2000', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(569, 2, 2, 'Kaolin', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(570, 2, 2, 'Lanolina anhidra', '250', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(571, 2, 2, 'L-Cisteina', '25', 2, '', 5, '', 5, '', '', 'aminoacido', 7, '', 1),
(572, 2, 2, 'Luminol', '10', 2, '', 14, '', 5, '', '', 'reaccion de Quimioluminiscencia', 7, '', 1),
(573, 2, 2, 'Mentol natural', '100', 2, '', 14, '', 5, '', '', '', 7, '', 1),
(574, 2, 2, 'Mercurio bicloruro', '100', 2, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(575, 2, 2, 'Metil celulosa', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(576, 2, 2, 'Ninhidrina', '10', 2, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(577, 2, 2, 'Nipagin', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(578, 2, 2, 'Orcinol monohidratado', '10', 2, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(579, 2, 2, 'Oxido de zinc', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(580, 2, 2, 'Pectina cítrica', '250', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(581, 2, 2, 'Reactivo de millón', '500', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(582, 2, 2, 'Reactivo de schiff', '1000', 1, '', 14, '', 5, '', '', 'identificacio de carbohidratos', 7, '', 1),
(583, 2, 2, 'Rodamina B', '5', 2, '', 5, '', 5, '', '', 'colorante de fluorecencia', 7, '', 1),
(584, 2, 2, 'Sacarina sódica', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(585, 2, 2, 'Salicilato de sodio', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(586, 2, 2, 'Silica gel con indicador', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(587, 2, 2, 'Silica gel sin indicador', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(588, 2, 2, 'Sulfato de amonio', '1500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(589, 2, 2, 'Sulfato de cobre', '1000', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(590, 2, 2, 'Sulfato férrico', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(591, 2, 2, 'Sulfato ferroso anhidro', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(592, 2, 2, 'Sulfato ferroso heptahidratado', '1000', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(593, 2, 2, 'Sulfato de hidracina', '25', 2, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(594, 2, 2, 'Sulfato de magnesio', '500', 1, '', 1, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(595, 2, 2, 'Sulfato de sodio', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(596, 2, 2, 'Tartrato de sodio y potasio', '500', 1, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(597, 2, 2, 'Timol', '250', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(598, 2, 2, 'Tionina', '10', 2, '', 14, '', 5, '', '', 'aminoacido', 7, '', 1),
(599, 2, 2, 'Trietanolamina', '1000', 1, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(600, 2, 2, 'Tritón 100 (SDS)', '400', 1, '', 5, '', 5, '', '', 'jabon', 7, '', 1),
(601, 2, 2, 'Tungstato de sodio', '100', 2, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(602, 2, 2, 'Verde de metilo', '1', 2, '', 14, '', 5, '', '', 'indicador', 7, '', 1),
(603, 2, 2, 'Yodio metálico sólido', '500', 2, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(604, 2, 2, 'Yoduro de potasio', '1000', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(605, 2, 2, 'Zinc metal', '750', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(606, 2, 2, 'Zinc metal granalla', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(607, 2, 2, 'Zincum pulvis', '10', 2, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(608, 2, 2, 'Acetato de plomo ', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 5, '', 1),
(609, 2, 2, 'Agua de bromo', '1500', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(610, 2, 2, 'Anilina', '400', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(611, 2, 2, 'Azul de anilina', '10', 2, '', 14, '', 5, '', '', 'indicador', 7, '', 1),
(612, 2, 2, 'Beta naftol', '500', 2, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(613, 2, 2, 'Cafeína', '100', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(614, 2, 2, 'Cloroformo', '1000', 1, '', 14, '', 5, '', '', 'diseccion', 7, '', 1),
(615, 2, 2, 'Cloruro de bario', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(616, 2, 2, 'Cloruro de mercurio', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(617, 2, 2, 'DL-Alanina', '125', 2, '', 15, '', 5, '', '', 'aminoacido', 7, '', 1),
(618, 2, 2, 'EDTA polvo', '100', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(619, 2, 2, 'Feling A', '1800', 1, '', 5, '', 5, '', '', 'identificacio de carbohidratos', 7, '', 1),
(620, 2, 2, 'Feling B', '700', 1, '', 15, '', 5, '', '', 'identificacio de carbohidratos', 7, '', 1),
(621, 2, 2, 'Fenol', '600', 2, '', 15, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(622, 2, 2, 'Guayacol', '250', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(623, 2, 2, 'Hidróxido de amonio', '3000', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(624, 2, 2, 'Hidróxido de bario ', '800', 2, '', 15, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(625, 2, 2, 'Hipoclorito de sodio al 6%', '2000', 1, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(626, 2, 2, 'Mercurio', '100', 2, '', 1, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(627, 2, 2, 'Naftaleno ', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(628, 2, 2, 'Peroxido de hidrógeno', '700', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(629, 2, 2, 'Plomo lámina', '100', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(630, 2, 2, 'Óxido de mercurio rojo', '100', 2, '', 11, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(631, 2, 2, 'Resorcina', '100', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(632, 2, 2, 'Rojo congo', '25', 2, '', 14, '', 5, '', '', 'indicador', 7, '', 1),
(633, 2, 2, 'Sodio', '500', 2, '', 16, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(634, 2, 2, 'Tetracloruro de carbono', '500', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(635, 2, 2, 'Tollens', '750', 1, '', 14, '', 5, '', '', 'identificacio de carbohidratos', 7, '', 1),
(636, 2, 2, 'Ácido esteárico', '400', 2, '', 15, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(637, 2, 2, 'Ácido oxálico', '1000', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(638, 2, 2, 'Bromuro de potasio', '800', 2, '', 15, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(639, 2, 2, 'Bromuro de sodio', '800', 2, '', 15, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(640, 2, 2, 'Cloruro de amonio', '500', 2, '', 1, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(641, 2, 2, 'Cloruro férrico', '1800', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(642, 2, 2, 'Cloruro de zinc', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(643, 2, 2, 'Lucas', '300', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(644, 2, 2, 'Oxalato de sodio', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(645, 2, 2, 'Tartrato de sodio', '600', 2, '', 15, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(646, 2, 2, 'Bioxido de manganeso', '300', 2, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(647, 2, 2, 'Dicromato de potasio', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(648, 2, 2, 'Naftol alfa (reactivo de molish)', '1500', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(649, 2, 2, 'Nitrato de sodio', '800', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(650, 2, 2, 'Nitrato de plomo', '1200', 2, '', 15, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(651, 2, 2, 'Nitrato férrico', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(652, 2, 2, 'Permanganato de potasio', '2000', 2, '', 15, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(653, 2, 2, 'Colorante de giemsa ', '500', 1, '', 14, '', 5, '', '', 'tinciones', 7, '', 1),
(654, 2, 2, 'Colorante de wright', '500', 1, '', 14, '', 5, '', '', 'tinciones', 7, '', 1),
(655, 2, 2, 'Eosina amarillenta', '1000', 1, '', 14, '', 5, '', '', 'tinciones', 7, '', 1),
(656, 2, 2, 'Hematoxilina de harris', '1500', 1, '', 14, '', 5, '', '', 'tinciones', 7, '', 1),
(657, 2, 2, 'Líquido de turk', '1000', 1, '', 14, '', 5, '', '', 'tinciones', 7, '', 1),
(658, 2, 2, 'Rojo congo 1%', '125', 1, '', 14, '', 5, '', '', 'tinciones', 7, '', 1),
(659, 2, 2, 'Sudan III', '1000', 1, '', 14, '', 5, '', '', 'tinciones', 7, '', 1),
(660, 2, 2, 'Sudan IV', '10', 2, '', 14, '', 5, '', '', 'tinciones', 7, '', 1),
(661, 2, 2, 'Verde de malaquita 1%', '1000', 1, '', 5, '', 5, '', '', 'tinciones', 7, '', 1),
(662, 2, 2, 'Verde de malaquita 0.1%', '500', 1, '', 14, '', 5, '', '', 'tinciones', 7, '', 1),
(663, 2, 2, 'Verde de malaquita ', '25', 2, '', 14, '', 5, '', '', 'tinciones', 7, '', 1),
(664, 2, 2, 'Ácido clorhídrico', '1000', 1, '', 5, '', 5, '', '', 'preparacion de soluciones', 1, '', 1),
(665, 2, 2, 'Acetaldeido ', '500', 1, '', 5, '', 5, '', '', 'preparacion de soluciones', 4, '', 1),
(666, 2, 2, 'Acetato de etilo', '1000', 1, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(667, 2, 2, 'Ácido pícrico', '1000', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(668, 2, 2, 'Ácido propiónico', '1250', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(669, 2, 2, 'Alcohol amílico', '1000', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(670, 2, 2, 'Alcohol butílico', '3000', 1, '', 15, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(671, 2, 2, 'Alcohol metílico', '4000', 1, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(672, 2, 2, 'Alcohol terbutílico', '800', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(673, 2, 2, 'Alcohol isopropílico', '200', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(674, 2, 2, 'Anhídrido acético', '1300', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(675, 2, 2, 'Benceno', '1800', 1, '', 4, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(676, 2, 2, 'Benzaldehido', '1000', 1, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(677, 2, 2, 'Balsamo de canada', '150', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(678, 2, 2, 'Fenolftaleína', '50', 2, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(679, 2, 2, 'Formaldehido', '3000', 1, '', 17, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(680, 2, 2, 'Formalina', '1000', 1, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(681, 2, 2, 'Keroseno', '800', 1, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(682, 2, 2, 'Magnesio cinta', '1/4', 8, '', 13, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(683, 2, 2, 'Nitrato de plata', '300', 2, '', 11, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(684, 2, 2, 'Permanganato de sodio', '100', 2, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(685, 2, 2, 'Salicilato de metilo', '1000', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(686, 2, 2, 'Aceite de algodón', '500', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 5, '', 1),
(687, 2, 2, 'Aceite mineral', '500', 1, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(688, 2, 2, 'Acetato de sodio', '800', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 4, '', 1),
(689, 2, 2, 'Ácido acetil salicilico', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 4, '', 1),
(690, 2, 2, 'Acido Benzoico', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(691, 2, 2, 'Ácido cítrico anhidro', '1000', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 4, '', 1),
(692, 2, 2, 'Ácido tánico', '800', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(693, 2, 2, 'Ácido tartárico', '400', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(694, 2, 2, 'Ácido salicílico', '250', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(695, 2, 2, 'Agar agar', '25', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(696, 2, 2, 'Benedict', '800', 1, '', 5, '', 5, '', '', 'identificacio de carbohidratos', 7, '', 1),
(697, 2, 2, 'Biuret', '500', 1, '', 14, '', 5, '', '', 'identificacio de carbohidratos', 7, '', 1),
(698, 2, 2, 'Buffer pH 7', '1000', 1, '', 5, '', 5, '', '', 'indicador de referencia', 7, '', 1),
(699, 2, 2, 'Buffer pH 6.4', '1000', 1, '', 5, '', 5, '', '', 'indicador de referencia', 7, '', 1),
(700, 2, 2, 'Carbonato de potasio', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(701, 2, 2, 'Caseína anhidro', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(702, 2, 2, 'Citrato de Sodio', '1000', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(703, 2, 2, 'Cloruro de benzalconio', '250', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(704, 2, 2, 'Dextrosa anhidra', '1000', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(705, 2, 2, 'Eosina amarillenta', '50', 2, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(706, 2, 2, 'Ferrocianuro de potasio', '600', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(707, 2, 2, 'Fosfato de sodio dibasico anhidro', '1000', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(708, 2, 2, 'Glicerina purificada', '3500', 1, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(709, 2, 2, 'Glucosa anhidra', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(710, 2, 2, 'Granalla de zinc', '400', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(711, 2, 2, 'Goma arabiga', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(712, 2, 2, 'Hidróxido de calcio', '2000', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(713, 2, 2, 'Kaolin', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(714, 2, 2, 'Lanolina anhidra', '250', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(715, 2, 2, 'L-Cisteina', '25', 2, '', 5, '', 5, '', '', 'aminoacido', 7, '', 1),
(716, 2, 2, 'Luminol', '10', 2, '', 14, '', 5, '', '', 'reaccion de Quimioluminiscencia', 7, '', 1),
(717, 2, 2, 'Mentol natural', '100', 2, '', 14, '', 5, '', '', '', 7, '', 1),
(718, 2, 2, 'Mercurio bicloruro', '100', 2, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(719, 2, 2, 'Metil celulosa', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(720, 2, 2, 'Ninhidrina', '10', 2, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(721, 2, 2, 'Nipagin', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(722, 2, 2, 'Orcinol monohidratado', '10', 2, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(723, 2, 2, 'Oxido de zinc', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(724, 2, 2, 'Pectina cítrica', '250', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(725, 2, 2, 'Reactivo de millón', '500', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(726, 2, 2, 'Reactivo de schiff', '1000', 1, '', 14, '', 5, '', '', 'identificacio de carbohidratos', 7, '', 1),
(727, 2, 2, 'Rodamina B', '5', 2, '', 5, '', 5, '', '', 'colorante de fluorecencia', 7, '', 1),
(728, 2, 2, 'Sacarina sódica', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(729, 2, 2, 'Salicilato de sodio', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(730, 2, 2, 'Silica gel con indicador', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(731, 2, 2, 'Silica gel sin indicador', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(732, 2, 2, 'Sulfato de amonio', '1500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(733, 2, 2, 'Sulfato de cobre', '1000', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(734, 2, 2, 'Sulfato férrico', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(735, 2, 2, 'Sulfato ferroso anhidro', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(736, 2, 2, 'Sulfato ferroso heptahidratado', '1000', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(737, 2, 2, 'Sulfato de hidracina', '25', 2, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(738, 2, 2, 'Sulfato de magnesio', '500', 1, '', 1, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(739, 2, 2, 'Sulfato de sodio', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(740, 2, 2, 'Tartrato de sodio y potasio', '500', 1, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(741, 2, 2, 'Timol', '250', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(742, 2, 2, 'Tionina', '10', 2, '', 14, '', 5, '', '', 'aminoacido', 7, '', 1),
(743, 2, 2, 'Trietanolamina', '1000', 1, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(744, 2, 2, 'Tritón 100 (SDS)', '400', 1, '', 5, '', 5, '', '', 'jabon', 7, '', 1),
(745, 2, 2, 'Tungstato de sodio', '100', 2, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(746, 2, 2, 'Verde de metilo', '1', 2, '', 14, '', 5, '', '', 'indicador', 7, '', 1),
(747, 2, 2, 'Yodio metálico sólido', '500', 2, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(748, 2, 2, 'Yoduro de potasio', '1000', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(749, 2, 2, 'Zinc metal', '750', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(750, 2, 2, 'Zinc metal granalla', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(751, 2, 2, 'Zincum pulvis', '10', 2, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(752, 2, 2, 'Acetato de plomo ', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 5, '', 1),
(753, 2, 2, 'Agua de bromo', '1500', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(754, 2, 2, 'Anilina', '400', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(755, 2, 2, 'Azul de anilina', '10', 2, '', 14, '', 5, '', '', 'indicador', 7, '', 1),
(756, 2, 2, 'Beta naftol', '500', 2, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(757, 2, 2, 'Cafeína', '100', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(758, 2, 2, 'Cloroformo', '1000', 1, '', 14, '', 5, '', '', 'diseccion', 7, '', 1),
(759, 2, 2, 'Cloruro de bario', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(760, 2, 2, 'Cloruro de mercurio', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(761, 2, 2, 'DL-Alanina', '125', 2, '', 14, '', 5, '', '', 'aminoacido', 7, '', 1),
(762, 2, 2, 'EDTA polvo', '100', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(763, 2, 2, 'Feling A', '1800', 1, '', 5, '', 5, '', '', 'identificacio de carbohidratos', 7, '', 1),
(764, 2, 2, 'Feling B', '700', 1, '', 15, '', 5, '', '', 'identificacio de carbohidratos', 7, '', 1),
(765, 2, 2, 'Fenol', '600', 2, '', 15, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(766, 2, 2, 'Guayacol', '250', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(767, 2, 2, 'Hidróxido de amonio', '3000', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(768, 2, 2, 'Hidróxido de bario ', '800', 2, '', 15, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(769, 2, 2, 'Hipoclorito de sodio al 6%', '2000', 1, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(770, 2, 2, 'Mercurio', '100', 2, '', 1, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(771, 2, 2, 'Naftaleno ', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(772, 2, 2, 'Peroxido de hidrógeno', '700', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(773, 2, 2, 'Plomo lámina', '100', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(774, 2, 2, 'Óxido de mercurio rojo', '100', 2, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(775, 2, 2, 'Resorcina', '100', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(776, 2, 2, 'Rojo congo', '25', 2, '', 14, '', 5, '', '', 'indicador', 7, '', 1),
(777, 2, 2, 'Sodio', '500', 2, '', 16, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(778, 2, 2, 'Tetracloruro de carbono', '500', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(779, 2, 2, 'Tollens', '750', 1, '', 14, '', 5, '', '', 'identificacio de carbohidratos', 7, '', 1),
(780, 2, 2, 'Ácido esteárico', '400', 2, '', 15, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(781, 2, 2, 'Ácido oxálico', '1000', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(782, 2, 2, 'Bromuro de potasio', '800', 2, '', 15, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(783, 2, 2, 'Bromuro de sodio', '800', 2, '', 15, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(784, 2, 2, 'Cloruro de amonio', '500', 2, '', 1, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(785, 2, 2, 'Cloruro férrico', '1800', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(786, 2, 2, 'Cloruro de zinc', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(787, 2, 2, 'Lucas', '300', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(788, 2, 2, 'Oxalato de sodio', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(789, 2, 2, 'Tartrato de sodio', '600', 2, '', 15, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(790, 2, 2, 'Bioxido de manganeso', '300', 2, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(791, 2, 2, 'Dicromato de potasio', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(792, 2, 2, 'Naftol alfa (reactivo de molish)', '1500', 1, '', 14, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(793, 2, 2, 'Nitrato de sodio', '800', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(794, 2, 2, 'Nitrato de plomo', '1200', 2, '', 15, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(795, 2, 2, 'Nitrato férrico', '500', 2, '', 5, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(796, 2, 2, 'Permanganato de potasio', '2000', 2, '', 15, '', 5, '', '', 'preparacion de soluciones', 7, '', 1),
(797, 2, 2, 'Colorante de giemsa ', '500', 1, '', 14, '', 5, '', '', 'tinciones', 7, '', 1),
(798, 2, 2, 'Colorante de wright', '500', 1, '', 14, '', 5, '', '', 'tinciones', 7, '', 1),
(799, 2, 2, 'Eosina amarillenta', '1000', 1, '', 14, '', 5, '', '', 'tinciones', 7, '', 1),
(800, 2, 2, 'Hematoxilina de harris', '1500', 1, '', 14, '', 5, '', '', 'tinciones', 7, '', 1),
(801, 2, 2, 'Líquido de turk', '1000', 1, '', 4, '', 5, '', '', 'tinciones', 7, '', 1),
(802, 2, 2, 'Rojo congo 1%', '125', 1, '', 14, '', 5, '', '', 'tinciones', 7, '', 1),
(803, 2, 2, 'Sudan III', '1000', 1, '', 14, '', 5, '', '', 'tinciones', 7, '', 1),
(804, 2, 2, 'Sudan IV', '10', 2, '', 14, '', 5, '', '', 'tinciones', 7, '', 1),
(805, 2, 2, 'Verde de malaquita 1%', '1000', 1, '', 5, '', 5, '', '', 'tinciones', 7, '', 1),
(806, 2, 2, 'Verde de malaquita 0.1%', '500', 1, '', 14, '', 5, '', '', 'tinciones', 7, '', 1),
(807, 2, 2, 'Verde de malaquita ', '25', 2, '', 14, '', 5, '', '', 'tinciones', 7, '', 1),
(808, 2, 2, 'Ácido clorhídrico', '1000', 1, '', 5, '', 5, '', '', 'preparacion de soluciones', 1, '', 1),
(810, 1, 3, 'Agitador magnético', '1', 6, '', 10, 'Labessa', 1, 'buen estado', '', '', 7, 'AG1510', 1),
(811, 1, 3, 'Agitador magnético (vibrador)', '1', 6, '', 10, 'Solbat', 1, 'buen estado', '', '', 7, '4550', 1),
(812, 1, 3, 'Autoclave ', '1', 6, '', 10, 'AESA', 1, 'buen estado', '', '', 7, 'CV-250 (No. Serie)', 1),
(813, 1, 3, 'Balanza analítica', '1', 6, '', 10, 'Sartorius', 2, 'fuera de uso (inservible)', '', '', 7, '4532', 0),
(814, 1, 3, 'Balanza analítica', '1', 6, '', 10, 'Velab quim', 1, 'mantenimiento preventivo', '', '', 7, '028373 (No. Serie)', 1),
(815, 1, 3, 'Balanza granataria', '1', 6, '', 10, 'Ohaus', 1, 'buen estado', '', '', 7, '4534', 1),
(816, 1, 3, 'Balanza granataria', '1', 6, '', 10, 'Velab', 2, 'no calibra', '', '', 7, 'VE-2610', 0),
(817, 1, 3, 'Balanza granataria', '1', 6, '', 10, 'Velab', 2, 'buen estado', '', '', 7, 'VE-2610 (No. Serie)', 0),
(818, 1, 3, 'Balanza granataria', '1', 6, '', 10, 'Irosa', 2, 'no calibra', '', '', 7, '406572 (No. Serie)', 0),
(819, 1, 3, 'Balanza granataria', '1', 6, '', 10, 'Irosa', 1, 'buen estado', '', '', 7, '406573 (No. Serie)', 1),
(820, 1, 3, 'Balanza granataria', '1', 6, '', 10, 'Ohaus', 2, 'no tiene tornillo para calibrar', '', '', 7, '4533', 0),
(821, 1, 3, 'Baño maría', '1', 6, '', 10, 'Riossa', 1, 'buen estado', '', '', 7, '4531', 1),
(822, 1, 3, 'Campana de extracción', '1', 6, '', 10, '', 1, 'buen estado', '', '', 7, 's/n', 1),
(823, 1, 3, 'Centrífuga', '1', 6, '', 10, 'Solbat', 1, 'descalicabrada', '', '', 7, '4600 (No. Serie)', 1),
(824, 1, 3, 'Centrífuga', '1', 6, '', 10, 'LW Scientific', 1, 'mantenimiento preventivo', '', '', 7, '13354', 1),
(825, 1, 3, 'CPU', '1', 6, '', 10, 'Acteck', 1, 'buen estado', '', '', 7, 's/n', 1),
(826, 1, 3, 'Espectrofotómetro', '1', 6, '', 10, 'Spectronic-20D', 1, 'buen estado', '', '', 7, '4530', 1),
(827, 1, 3, 'Horno de secado', '1', 6, '', 10, 'Rios rocha', 1, 'buen estado', '', '', 7, '4528', 1),
(828, 1, 3, 'Impresora', '1', 6, '', 10, 'HP', 1, 'buen estado', '', '', 7, '11960', 1),
(829, 1, 3, 'Lampara Ultravioleta', '1', 6, '', 10, 's/n', 1, 'buen estado', '', '', 7, 'UVGL-25 (No. Serie)', 1),
(830, 1, 3, 'Lampara Ultravioleta', '1', 6, '', 10, 's/n', 1, 'buen estado', '', '', 7, 'UVL-21 (No. Serie)', 1),
(831, 1, 3, 'Microlab', '1', 6, '', 10, 'Spin-Lab', 1, 'buen estado', '', '', 7, '116050', 1),
(832, 1, 3, 'Microscopio', '1', 6, '', 10, 'Optisum', 1, 'buen estado', '', '', 7, '8828', 1),
(833, 1, 3, 'Microscopio', '1', 6, '', 10, 'Optisum', 2, 'tornillo macro barrido', '', '', 7, '8823', 0),
(834, 1, 3, 'Microscopio', '1', 6, '', 10, 'Optisum', 1, 'buen estado', '', '', 7, '8824', 1),
(835, 1, 3, 'Microscopio', '1', 6, '', 10, 'Optisum', 2, 'le falta ocular', '', '', 7, '8825', 0),
(836, 1, 3, 'Microscopio', '1', 6, '', 10, 'Optisum', 1, 'buen estado', '', '', 7, '8826', 1),
(837, 1, 3, 'Microscopio', '1', 6, '', 10, 'Optisum', 2, 'tornillo macro barrido', '', '', 7, '8827', 0),
(838, 1, 3, 'Microscopio', '1', 6, '', 10, 'Optisum', 1, 'buen estado', '', '', 7, '8832', 1),
(839, 1, 3, 'Microscopio', '1', 6, '', 10, 'Optisum', 1, 'buen estado', '', '', 7, '8835', 1),
(840, 1, 3, 'Microscopio', '1', 6, '', 10, 'Optisum', 2, 'no enciende', '', '', 7, '8838', 0),
(841, 1, 3, 'Microscopio', '1', 6, '', 10, 'Optisum', 2, 'tornillo macro barrido', '', '', 7, '8839', 0),
(842, 1, 3, 'Microscopio c/foto tubo', '1', 6, '', 10, 'Carl zeizz axiostar', 1, 'buen estado', '', '', 7, '4621', 1),
(843, 1, 3, 'Microscopio c/foto tubo p/video camara', '1', 6, '', 10, 'Carl zeizz ', 1, 'buen estado', '', '', 7, '4108', 1),
(844, 1, 3, 'Microscopio de conservación', '1', 6, '', 10, 'Carl zeizz ', 1, 'buen estado', '', '', 7, '4539', 1),
(845, 1, 3, 'Microscopio de conservación', '1', 6, '', 10, 'Carl zeizz axiostar', 1, 'buen estado', '', '', 7, '4546', 1),
(846, 1, 3, 'Microscopio de conservación', '1', 6, '', 10, 'Carl zeizz axiostar', 1, 'buen estado', '', '', 7, '4535', 1),
(847, 1, 3, 'Microscopio de conservación', '1', 6, '', 10, 'Carl zeizz axiostar plus', 1, 'buen estado', '', '', 7, '6685', 1),
(848, 1, 3, 'Microscopio de conservación', '1', 6, '', 10, 'Carl zeizz axiostar plus', 1, 'buen estado', '', '', 7, '6684', 1),
(849, 1, 3, 'Microscopio de conservación', '1', 6, '', 10, 'Iroscope', 1, 'buen estado', '', '', 7, '032444 (No. Serie)', 1),
(850, 1, 3, 'Microscopio de conservación', '1', 6, '', 10, 'Iroscope', 1, 'buen estado', '', '', 7, 's/n', 1),
(851, 1, 3, 'Monitor', '1', 6, '', 10, 'Sony', 2, 'buen estado', '', '', 7, '4105', 0),
(852, 1, 3, 'Monitor LCD 17', '1', 6, '', 10, ' Acer', 1, 'buen estado', '', '', 7, '11952', 1),
(853, 1, 3, 'Mouse', '1', 6, '', 10, ' Acer', 1, 'buen estado', '', '', 7, '11953', 1),
(854, 1, 3, 'Lámpara de rayos UV', '1', 6, '', 10, 'GRIS', 1, 'buen estado', '', '', 7, 's/n', 1),
(855, 1, 3, 'Parrilla', '1', 6, '', 10, 'Civeq', 1, 'buen estado', '', '', 7, 's/n', 1),
(856, 1, 3, 'Parrilla', '1', 6, '', 10, 'Felisa', 1, 'buen estado', '', '', 7, '1009129 (No. Serie)', 1),
(857, 1, 3, 'Parrilla', '1', 6, '', 10, 'Felisa', 1, 'buen estado', '', '', 7, 's/n', 1),
(858, 1, 3, 'Parrilla con agitador', '1', 6, '', 10, 'GRIS', 1, 'buen estado', '', '', 7, 's/n', 1),
(859, 1, 3, 'Parrilla con agitador', '1', 6, '', 10, 'GRIS', 1, 'buen estado', '', '', 7, 's/n', 1),
(860, 1, 3, 'Refrigerador', '1', 6, '', 10, 'Acros', 1, 'buen estado', '', '', 7, '10175', 1),
(861, 1, 3, 'Teclado', '1', 6, '', 10, ' Acer', 1, 'buen estado', '', '', 7, '11954', 1),
(862, 1, 3, 'Televisión', '1', 6, '', 10, 'Philips', 1, 'buen estado', '', '', 7, '6201', 1),
(863, 1, 3, 'Televisión', '1', 6, '', 10, 'Dwdisplay', 1, 'buen estado', '', '', 7, 's/n', 1),
(864, 1, 3, 'Video cámara para microscópio', '1', 6, '', 10, 'Sony', 1, 'buen estado', '', '', 7, '103529 (No. Serie)', 1),
(865, 1, 3, 'Video cámara para microscópio', '1', 6, '', 10, 'Crema', 1, 'buen estado', '', '', 7, '2078 (No. Serie)', 1),
(866, 2, 3, 'Agitador magnético', '1', 6, '', 10, 'Labessa', 1, '', '', '', 7, 's/n', 1),
(867, 2, 3, 'Balanza analítica', '1', 6, '', 10, 'Velab quim', 1, '', '', '', 7, '028373 (No. Serie)', 1),
(868, 2, 3, 'bomba de vacio', '1', 6, '', 10, 'Felisa', 1, 'sin mangueras', '', '', 7, '12497', 1),
(869, 2, 3, 'Lampara Ultravioleta', '1', 6, '', 10, 's/n', 1, '', '', '', 7, 'UVGL-25 (No. Serie)', 1),
(870, 2, 3, 'Lampara Ultravioleta', '1', 6, '', 10, 's/n', 1, '', '', '', 7, 'UVL-21 (No. Serie)', 1),
(871, 2, 3, 'Parrilla con agitador', '1', 6, '', 10, 'GRIS', 1, '', '', '', 7, 's/n', 1),
(872, 2, 3, 'Parrilla con agitador', '1', 6, '', 10, 'GRIS', 1, '', '', '', 7, 's/n', 1),
(873, 2, 3, 'Mufla electrica Digital', '1', 6, '', 10, 'NOVATECH', 1, 'buen estado', '', '', 7, '13320', 1),
(874, 2, 3, 'Estufa de gas 2 hornillas', '1', 6, '', 10, 'DELHER', 1, 'buen estado', '', '', 7, '10261', 1),
(875, 2, 3, 'Parilla eléctrica', '1', 6, '', 10, 'S/N', 1, 'buen estado', '', '', 7, '12091', 1),
(876, 2, 3, 'Parilla eléctrica', '1', 6, '', 10, 'S/N', 1, 'buen estado', '', '', 7, '12092', 1),
(877, 2, 3, 'Parilla eléctrica', '1', 6, '', 10, 'S/N', 2, 'descompuesta', '', '', 7, '12093', 1),
(878, 2, 3, 'Parilla eléctrica', '1', 6, '', 10, 'S/N', 1, 'buen estado', '', '', 7, '12094', 1),
(879, 2, 3, 'Parrilla eléctrica', '1', 6, '', 10, 'S/N', 1, 'buen estado', '', '', 7, '12095', 1),
(880, 2, 3, 'Parrilla eléctrica', '1', 6, '', 10, 'S/N', 1, 'buen estado', '', '', 7, '12096', 1),
(881, 2, 3, 'Incubadora bacteriológica', '1', 6, '', 10, 'KITLAB', 1, 'buen estado', '', '', 7, '6677', 1),
(882, 2, 3, 'Incubadora bacteriológica', '1', 6, '', 10, 'ECOSHEL', 1, 'buen estado', '', '', 7, '9162', 1),
(883, 2, 3, 'Centrífuga par 8 tubos de ensaye', '1', 6, '', 10, 'VELAB', 1, 'buen estado', '', '', 7, 'VE - 400', 1),
(884, 2, 3, 'Centrífuga para 25 tubos de ensaye', '1', 6, '', 10, 'KITLAB', 1, 'buen estado', '', '', 7, '6678', 1),
(885, 2, 3, 'Baño maría', '1', 6, '', 10, 'RIOSSA', 1, 'buen estado', '', '', 7, '4603', 1),
(886, 2, 3, 'Potenciómetro con electrodo PH-210', '1', 6, '', 10, 'HANNA', 2, 'descompuesta', '', '', 7, '12097', 0),
(887, 2, 3, 'Medidor de PH/EC/TDS/°C', '1', 6, '', 10, 'HANNA', 1, 'buen estado', '', '', 7, 'HI - 98129', 1),
(888, 2, 3, 'Medidor de PH/EC/TDS/°C', '1', 6, '', 10, 'HANNA', 1, 'buen estado', '', '', 7, 'HI - 98129/2', 1),
(889, 2, 3, 'Microlab-300', '1', 6, '', 10, 'VITAL-SIENTIFIC', 1, 'buen estado', '', '', 7, '10191', 1),
(890, 2, 3, 'Microscopio Binocular', '1', 6, '', 10, 'OPTISUIN', 2, 'descompuesto', '', '', 7, '294262', 1),
(891, 2, 3, 'Microscopio Binocular', '1', 6, '', 10, 'OPTISUIN', 2, 'descompuesto', '', '', 7, '294246', 1),
(892, 2, 3, 'Microscopio Binocular', '1', 6, '', 10, 'OPTISUIN', 2, 'descompuesto', '', '', 7, '294203', 1),
(893, 2, 3, 'Microscopio Binocular', '1', 6, '', 10, 'OPTISUIN', 2, 'descompuesto', '', '', 7, '294260', 1),
(894, 2, 3, 'Microscopio Binocular', '1', 6, '', 10, 'CARL-ZEISS', 2, 'descompuesto', '', '', 7, '4537', 1),
(895, 2, 3, 'Microscopio Binocular', '1', 6, '', 10, 'OPTISUIN', 1, 'buen estado', '', '', 7, '294206', 1),
(896, 2, 3, 'Microscopio Binocular', '1', 6, '', 10, 'OPTISUIN', 1, 'buen estado', '', '', 7, '294224', 1),
(897, 2, 3, 'Microscopio Binocular', '1', 6, '', 10, 'OPTISUIN', 1, 'buen estado', '', '', 7, '294217', 1),
(898, 2, 3, 'Microscopio Binocular', '1', 6, '', 10, 'OPTISUIN', 1, 'buen estado', '', '', 7, '294310', 1),
(899, 2, 3, 'Microscopio Binocular', '1', 6, '', 10, 'OPTISUIN', 1, 'buen estado', '', '', 7, '294348', 1),
(900, 2, 3, 'Microscopio Binocular', '1', 6, '', 10, 'OPTISUIN', 1, 'buen estado', '', '', 7, '294259', 1),
(901, 2, 3, 'Microscopio Binocular', '1', 6, '', 10, 'CARL-ZEISS', 1, 'Regular estado', '', '', 7, '4538', 1),
(902, 2, 3, 'Microscopio Binocular', '1', 6, '', 10, 'CARL-ZEISS', 1, 'Regular estado', '', '', 7, '4545', 1),
(903, 2, 3, 'Microscopio Binocular', '1', 6, '', 10, 'CARL-ZEISS', 1, 'Regular estado', '', '', 7, '470402-9099', 1),
(904, 2, 3, 'Microscopio Esteroscopio', '1', 6, '', 10, 'S/M', 1, 'buen estado', '', '', 7, 'S/N', 1),
(905, 2, 3, 'Balanza analítica', '1', 6, '', 10, 'VELAB', 1, 'buen estado', '', '', 7, 'VE - 300', 1),
(906, 2, 3, 'Balanza analítica', '1', 6, '', 10, 'DEMVER INSTR', 1, 'buen estado', '', '', 7, 'ISO - 9001', 1),
(907, 2, 3, 'Balanza granataria', '1', 6, '', 10, 'IROSA', 1, 'buen estado', '', '', 7, '407,016', 1),
(908, 2, 3, 'Balanza granataria', '1', 6, '', 10, 'OHAUS', 1, 'buen estado', '', '', 7, '10257', 1),
(909, 2, 3, 'Balanza granataria', '1', 6, '', 10, 'OHAUS', 1, 'buen estado', '', '', 7, '10256', 1),
(910, 2, 3, 'Balanza granataria', '1', 6, '', 10, 'IROSA', 2, 'descompuesta', '', '', 7, '12,099', 1),
(911, 2, 3, 'Balanza granataria', '1', 6, '', 10, 'IROSA', 2, 'descompuesta', '', '', 7, '407,015', 1),
(912, 2, 3, 'Balanza granataria', '1', 6, '', 10, 'VELAB', 2, 'descompuesta', '', '', 7, 'VE - 2610', 1),
(913, 2, 3, 'Agitador de tubos', '1', 6, '', 10, 'MIXER-UNICO', 1, 'buen estado', '', '', 7, '7111088', 1),
(914, 2, 3, 'Autoclave vertical', '1', 6, '', 10, 'CORPO/SU-MI', 1, 'buen estado', '', '', 7, '11617', 1),
(915, 2, 3, 'Autoclave de mesa', '1', 6, '', 10, 'ALL AMERICAN', 1, 'buen estado', '', '', 7, 'MODLO 75X', 1),
(916, 2, 3, 'Bomba de vacio', '1', 6, '', 10, 'NOVATECH', 1, 'buen estado', '', '', 7, 'EV-40 058814', 1),
(917, 2, 3, 'Contador de colonias', '1', 6, '', 10, 'FELISSA', 1, 'No tiene lupa', '', '', 7, '12010', 1),
(918, 2, 3, 'Refrigerador ', '1', 6, '', 10, 'MABE', 1, 'buen estado', '', '', 7, '4526', 1),
(919, 2, 3, 'Refrigerador ', '1', 6, '', 10, 'MABE', 1, 'buen estado', '', '', 7, 'RMPO925V', 1),
(920, 2, 3, 'Refrigerador ', '1', 6, '', 10, 'MABE', 1, 'buen estado', '', '', 7, 'RML12XHM', 1),
(921, 2, 3, 'Refrigerador ', '1', 6, '', 10, 'ADMIRAL', 1, 'buen estado', '', '', 7, 'LRPO7JXSQ-1', 1),
(922, 2, 3, 'Refrigerador ', '1', 6, '', 10, 'ADMIRAL', 1, 'buen estado', '', '', 7, 'LRPO7JXSQ-2', 1),
(923, 2, 3, 'Refrigerador ', '1', 6, '', 10, 'AIRHO', 1, 'buen estado', '', '', 7, 'S TERMOGRAFICO', 1),
(924, 2, 3, 'Refrigeradores', '1', 6, '', 10, 'ACROS', 1, 'buen estado', '', '', 7, '10254', 1),
(925, 2, 3, 'Horno de esterilización', '1', 6, '', 10, 'KITLAB', 1, 'buen estado', '', '', 7, '6676/ S-306369', 1),
(926, 2, 3, 'Agitador magnético ', '1', 6, '', 10, 'HANNA', 1, 'buen estado', '', '', 7, '12098', 1),
(927, 2, 3, 'Desecador de cristal', '5', 6, '', 10, 'S/M', 1, 'buen estado', '', '', 7, 'S/N', 5),
(928, 2, 3, 'Campana de flujo laminar', '1', 6, '', 10, 'BECOMAR', 1, 'buen estado', '', '', 7, '12072', 1),
(929, 2, 3, 'Campana de extracción de gases', '1', 6, '', 10, 'BECOMAR', 1, 'buen estado', '', '', 7, '12076', 1),
(930, 2, 3, 'Centrífuga para 8 tubos de ensaye', '1', 6, '', 10, 'VELAB', 1, 'buen estado', '', '', 7, 'VE-4000 /20346', 1),
(931, 2, 3, 'Contador de Células Saguineas', '1', 6, '', 10, 'ECONOMY', 1, '', '', '', 7, 'S/N', 1),
(932, 2, 3, 'Contador de Células Saguineas', '1', 6, '', 10, 'ECONOMY', 1, '', '', '', 7, 'S/N', 1),
(933, 2, 3, 'Contador de células sanguíneas', '1', 6, '', 10, 'ECONOMY', 1, '', '', '', 7, 'S/N', 1),
(934, 2, 3, 'Contador de células sanguíneas', '1', 6, '', 10, 'ECONOMY', 1, 'buen estado', '', '', 7, 'S/N', 1),
(935, 2, 3, 'Multímetro digital de gancho', '1', 6, '', 10, 'STEREN', 1, 'buen estado', '', '', 7, '12102', 1),
(936, 2, 3, 'Multímetro digital de gancho', '1', 6, '', 10, 'STEREN', 1, 'buen estado', '', '', 7, '12105', 1),
(937, 2, 3, 'Multímetro digital de gancho', '1', 6, '', 10, 'STEREN', 1, 'buen estado', '', '', 7, '12103', 1),
(938, 2, 3, 'Multímetro digital de gancho', '1', 6, '', 10, 'STEREN', 1, 'buen estado', '', '', 7, '12104', 1),
(939, 2, 3, 'Multímetro digital de gancho', '1', 6, '', 10, 'STEREN', 1, 'Regular estado', '', '', 7, '12106', 1),
(940, 2, 3, 'Multímetro digital  200MV-1000MV', '1', 6, '', 10, 'STEREN', 1, 'Regular estado', '', '', 7, '12101', 1),
(941, 2, 3, 'Microcentrífuga', '1', 6, '', 10, 'ROLCO CH-24', 1, 'buen estado', '', '', 7, '61058', 1),
(942, 2, 3, 'Agitador magnético', '1', 6, '', 10, 'Labessa', 1, '', '', '', 7, 's/n', 1),
(943, 2, 3, 'Balanza analítica', '1', 6, '', 10, 'Velab quim', 1, '', '', '', 7, '028373 (No. Serie)', 1),
(944, 2, 3, 'bomba de vacio', '1', 6, '', 10, 'Felisa', 1, 'sin mangueras', '', '', 7, '12497', 1),
(945, 2, 3, 'Lampara Ultravioleta', '1', 6, '', 10, 's/n', 1, '', '', '', 7, 'UVGL-25 (No. Serie)', 1),
(946, 2, 3, 'Lampara Ultravioleta', '1', 6, '', 10, 's/n', 1, '', '', '', 7, 'UVL-21 (No. Serie)', 1),
(947, 2, 3, 'Parrilla con agitador', '1', 6, '', 10, 'GRIS', 1, '', '', '', 7, 's/n', 1),
(948, 2, 3, 'Parrilla con agitador', '1', 6, '', 10, 'GRIS', 1, '', '', '', 7, 's/n', 1),
(949, 2, 3, 'Agitador magnético', '1', 6, '', 10, 'Labessa', 1, '', '', '', 7, 's/n', 1),
(950, 2, 3, 'Balanza analítica', '1', 6, '', 10, 'Velab quim', 1, '', '', '', 7, '028373 (No. Serie)', 1),
(951, 2, 3, 'bomba de vacio', '1', 6, '', 10, 'Felisa', 1, 'sin mangueras', '', '', 7, '12497', 1),
(952, 2, 3, 'Lampara Ultravioleta', '1', 6, '', 10, 's/n', 1, '', '', '', 7, 'UVGL-25 (No. Serie)', 1),
(953, 2, 3, 'Lampara Ultravioleta', '1', 6, '', 10, 's/n', 1, '', '', '', 7, 'UVL-21 (No. Serie)', 1),
(954, 2, 3, 'Parrilla con agitador', '1', 6, '', 10, 'GRIS', 1, '', '', '', 7, 's/n', 1),
(955, 2, 3, 'Parrilla con agitador', '1', 6, '', 10, 'GRIS', 1, '', '', '', 7, 's/n', 1),
(956, 1, 1, 'Mouse Steren', '10', 6, '10cm', 5, 'GENIUS', 1, 'da lucesita', '', '', 1, '0000132', 1),
(957, 1, 1, 'asd', 'asd', 1, '', 2, '', 2, '', '', '', 1, '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario_login`
--

CREATE TABLE IF NOT EXISTS `tbl_usuario_login` (
  `Pk_Usuario_Login` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador (llave primaria) del usuario',
  `nombre` varchar(150) COLLATE utf8_swedish_ci NOT NULL,
  `apaterno` varchar(200) COLLATE utf8_swedish_ci DEFAULT NULL,
  `amaterno` varchar(200) COLLATE utf8_swedish_ci DEFAULT NULL,
  `fk_genero` int(11) NOT NULL,
  `telefono` varchar(45) COLLATE utf8_swedish_ci NOT NULL,
  `correo` varchar(150) COLLATE utf8_swedish_ci DEFAULT NULL,
  `Usuario` varchar(50) COLLATE utf8_swedish_ci NOT NULL COMMENT 'Nombre de Secion',
  `Password` tinytext COLLATE utf8_swedish_ci NOT NULL COMMENT 'Contraseña del Usuario',
  `Tipo_User` varchar(30) COLLATE utf8_swedish_ci NOT NULL COMMENT 'Llave foranea que pertenece al identificador del departamento',
  `Usuario_Online` tinyint(1) NOT NULL DEFAULT '0',
  `activo_usuario` tinyint(1) NOT NULL COMMENT 'Estado del usuario si esta deshabilitado o Habilitado',
  PRIMARY KEY (`Pk_Usuario_Login`),
  KEY `fk_tbl_usuario_login_cat_genero1_idx` (`fk_genero`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `tbl_usuario_login`
--

INSERT INTO `tbl_usuario_login` (`Pk_Usuario_Login`, `nombre`, `apaterno`, `amaterno`, `fk_genero`, `telefono`, `correo`, `Usuario`, `Password`, `Tipo_User`, `Usuario_Online`, `activo_usuario`) VALUES
(1, 'Ivan Mauricio', 'Meneses', 'Melo Granados', 1, '9611007410', 'melo1088@hotmail.com', 'melo', 'fe0e2fe499dba85ed54677a881e39d41', 'Administrador', 1, 1),
(2, 'Administrador', NULL, NULL, 1, '0', '0', 'admin', 'admin', 'Administrador', 0, 1),
(3, 'QFB1', NULL, NULL, 1, '0', NULL, 'qfb1', '3258c1eded64f9bc05ceada79c09a141', 'normal', 0, 1),
(4, 'QFB2', NULL, NULL, 1, '0', NULL, 'qfb2', 'qfb2', 'normal', 0, 1),
(5, 'ODON1', NULL, NULL, 1, '0', NULL, 'odon1', 'odon1', 'normal', 0, 1),
(6, 'ODON2', NULL, NULL, 1, '0', NULL, 'odon2', 'odon2', 'normal', 0, 1),
(7, 'MED1', NULL, NULL, 1, '0', NULL, 'med1', 'med1', 'normal', 0, 1),
(8, 'MED2', NULL, NULL, 1, '0', NULL, 'med2', 'med2', 'normal', 0, 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cat_menu`
--
ALTER TABLE `cat_menu`
  ADD CONSTRAINT `fk_Cat_Menu_Cat_Titulos_Menu1` FOREIGN KEY (`Fk_Departamento`) REFERENCES `cat_titulos_menu` (`idTituloMenu`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `rel_login_permisos`
--
ALTER TABLE `rel_login_permisos`
  ADD CONSTRAINT `fk_Rel_LoginPermisos_tbl_Usuario_Login1` FOREIGN KEY (`Fk_Usuario_Login`) REFERENCES `tbl_usuario_login` (`Pk_Usuario_Login`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Rel_Login_Permisos_Cat_Menu1` FOREIGN KEY (`Fk_CatMenu`) REFERENCES `cat_menu` (`idMenu`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `rel_trabajadorecarreras`
--
ALTER TABLE `rel_trabajadorecarreras`
  ADD CONSTRAINT `fk_rel_trabajadorecarreras_tbl_usuario_login1` FOREIGN KEY (`fk_Usuario_Login`) REFERENCES `tbl_usuario_login` (`Pk_Usuario_Login`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_trabajadores_has_carreras_carreras1` FOREIGN KEY (`fk_carreras`) REFERENCES `tbl_carreras` (`pk_carreras`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `rel_usuario_laboratorios`
--
ALTER TABLE `rel_usuario_laboratorios`
  ADD CONSTRAINT `fk_rel_usuario_laboratorios_tbl_laboratorios1` FOREIGN KEY (`fk_laboratorios`) REFERENCES `tbl_laboratorios` (`Pk_laboratorios`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rel_usuario_laboratorios_tbl_usuario_login1` FOREIGN KEY (`fk_Usuario_Login`) REFERENCES `tbl_usuario_login` (`Pk_Usuario_Login`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_carreras`
--
ALTER TABLE `tbl_carreras`
  ADD CONSTRAINT `fk_tbl_carreras_tbl_datosgenerales1` FOREIGN KEY (`fk_dtgenerales`) REFERENCES `tbl_escuela` (`pk_dtgenerales`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_historial_acceso`
--
ALTER TABLE `tbl_historial_acceso`
  ADD CONSTRAINT `fk_tbl_HistorialAcceso_tbl_Usuario_Login1` FOREIGN KEY (`Fk_Usuario_Login`) REFERENCES `tbl_usuario_login` (`Pk_Usuario_Login`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_laboratorios`
--
ALTER TABLE `tbl_laboratorios`
  ADD CONSTRAINT `fk_tbl_laboratorios_tbl_carreras1` FOREIGN KEY (`fk_carreras`) REFERENCES `tbl_carreras` (`pk_carreras`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_material`
--
ALTER TABLE `tbl_material`
  ADD CONSTRAINT `fk_tbl_material_cat_clasematerial1` FOREIGN KEY (`fk_clasematerial`) REFERENCES `cat_clasematerial` (`pk_clasematerial`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_material_Cat_EstadoMaterial1` FOREIGN KEY (`Fk_EstadoMaterial`) REFERENCES `cat_estadomaterial` (`Pk_EstadoMaterial`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_material_cat_frecuenciauso1` FOREIGN KEY (`fk_frecuenciauso`) REFERENCES `cat_frecuenciauso` (`pk_frecuenciauso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_material_Cat_TipoMaterial1` FOREIGN KEY (`Fk_TipoMaterial`) REFERENCES `cat_tipomaterial` (`Pk_TipoMaterial`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_material_Cat_UnidadMedida1` FOREIGN KEY (`Fk_UnidadMedida`) REFERENCES `cat_unidadmedida` (`Pk_UnidadMedida`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_material_tbl_laboratorios1` FOREIGN KEY (`fk_laboratorios`) REFERENCES `tbl_laboratorios` (`Pk_laboratorios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_usuario_login`
--
ALTER TABLE `tbl_usuario_login`
  ADD CONSTRAINT `fk_tbl_usuario_login_cat_genero1` FOREIGN KEY (`fk_genero`) REFERENCES `cat_genero` (`pk_genero`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

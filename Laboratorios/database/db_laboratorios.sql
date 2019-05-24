-- MySQL Script generated by MySQL Workbench
-- 08/16/14 11:27:25
-- Model: New Model    Version: 1.0
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema db_laboratorios
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_laboratorios` DEFAULT CHARACTER SET latin1 ;
USE `db_laboratorios` ;

-- -----------------------------------------------------
-- Table `db_laboratorios`.`cat_titulos_menu`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_laboratorios`.`cat_titulos_menu` ;

CREATE TABLE IF NOT EXISTS `db_laboratorios`.`cat_titulos_menu` (
  `idTituloMenu` TINYINT(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_swedish_ci' NOT NULL,
  `Activo` TINYINT(1) NOT NULL,
  PRIMARY KEY (`idTituloMenu`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_swedish_ci;


-- -----------------------------------------------------
-- Table `db_laboratorios`.`cat_menu`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_laboratorios`.`cat_menu` ;

CREATE TABLE IF NOT EXISTS `db_laboratorios`.`cat_menu` (
  `idMenu` MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(55) CHARACTER SET 'utf8' COLLATE 'utf8_swedish_ci' NOT NULL,
  `Alias_Archivo` VARCHAR(55) CHARACTER SET 'utf8' COLLATE 'utf8_swedish_ci' NOT NULL,
  `Fk_Cat_Permiso` SMALLINT(5) UNSIGNED NULL DEFAULT NULL,
  `Fk_Departamento` TINYINT(3) UNSIGNED NOT NULL,
  PRIMARY KEY (`idMenu`),
  INDEX `fk_Cat_Menu_Cat_Titulos_Menu1_idx` (`Fk_Departamento` ASC),
  CONSTRAINT `fk_Cat_Menu_Cat_Titulos_Menu1`
    FOREIGN KEY (`Fk_Departamento`)
    REFERENCES `db_laboratorios`.`cat_titulos_menu` (`idTituloMenu`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_swedish_ci;


-- -----------------------------------------------------
-- Table `db_laboratorios`.`cat_genero`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_laboratorios`.`cat_genero` ;

CREATE TABLE IF NOT EXISTS `db_laboratorios`.`cat_genero` (
  `pk_genero` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NULL,
  `estado` TINYINT(1) NOT NULL,
  PRIMARY KEY (`pk_genero`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_laboratorios`.`tbl_usuario_login`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_laboratorios`.`tbl_usuario_login` ;

CREATE TABLE IF NOT EXISTS `db_laboratorios`.`tbl_usuario_login` (
  `Pk_Usuario_Login` SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador (llave primaria) del usuario',
  `nombre` VARCHAR(150) NOT NULL,
  `apaterno` VARCHAR(200) NULL,
  `amaterno` VARCHAR(200) NULL,
  `fk_genero` INT NOT NULL,
  `telefono` VARCHAR(45) NOT NULL,
  `correo` VARCHAR(150) NULL,
  `Usuario` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_swedish_ci' NOT NULL COMMENT 'Nombre de Secion',
  `Password` TINYTEXT CHARACTER SET 'utf8' COLLATE 'utf8_swedish_ci' NOT NULL COMMENT 'Contraseña del Usuario',
  `Tipo_User` VARCHAR(30) CHARACTER SET 'utf8' COLLATE 'utf8_swedish_ci' NOT NULL COMMENT 'Llave foranea que pertenece al identificador del departamento' /* comment truncated */ /*en el que se encuentra el usuario.*/,
  `Usuario_Online` TINYINT(1) NOT NULL DEFAULT '0',
  `activo_usuario` TINYINT(1) NOT NULL COMMENT 'Estado del usuario si esta deshabilitado o Habilitado',
  PRIMARY KEY (`Pk_Usuario_Login`),
  INDEX `fk_tbl_usuario_login_cat_genero1_idx` (`fk_genero` ASC),
  CONSTRAINT `fk_tbl_usuario_login_cat_genero1`
    FOREIGN KEY (`fk_genero`)
    REFERENCES `db_laboratorios`.`cat_genero` (`pk_genero`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_swedish_ci;


-- -----------------------------------------------------
-- Table `db_laboratorios`.`rel_login_permisos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_laboratorios`.`rel_login_permisos` ;

CREATE TABLE IF NOT EXISTS `db_laboratorios`.`rel_login_permisos` (
  `Pk_Login_Permisos` SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador (Llave Primaria) del Login_Permisos.',
  `Fk_Usuario_Login` SMALLINT(5) UNSIGNED NOT NULL COMMENT 'Llave foranea para identificar a que cuenta de usuario pertenece.',
  `Fk_CatMenu` MEDIUMINT(8) UNSIGNED NOT NULL,
  PRIMARY KEY (`Pk_Login_Permisos`),
  INDEX `fk_Rel_LoginPermisos_tbl_Usuario_Login1_idx` (`Fk_Usuario_Login` ASC),
  INDEX `fk_Rel_Login_Permisos_Cat_Menu1_idx` (`Fk_CatMenu` ASC),
  CONSTRAINT `fk_Rel_LoginPermisos_tbl_Usuario_Login1`
    FOREIGN KEY (`Fk_Usuario_Login`)
    REFERENCES `db_laboratorios`.`tbl_usuario_login` (`Pk_Usuario_Login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Rel_Login_Permisos_Cat_Menu1`
    FOREIGN KEY (`Fk_CatMenu`)
    REFERENCES `db_laboratorios`.`cat_menu` (`idMenu`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_swedish_ci;


-- -----------------------------------------------------
-- Table `db_laboratorios`.`tbl_historial_acceso`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_laboratorios`.`tbl_historial_acceso` ;

CREATE TABLE IF NOT EXISTS `db_laboratorios`.`tbl_historial_acceso` (
  `Pk_Control` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador (Llave Primaria) del Control.',
  `Fk_Usuario_Login` SMALLINT(5) UNSIGNED NOT NULL COMMENT 'Llave Foranea para identificar al usuario que ingreso y saber su historial.',
  `Fecha` DATE NOT NULL COMMENT 'Fecha en el que ingreso al sistema.',
  `Hora` TIME NOT NULL COMMENT 'Hora en el que Ingreso al Sistema.',
  `Ip` VARCHAR(15) CHARACTER SET 'utf8' COLLATE 'utf8_swedish_ci' NOT NULL COMMENT 'La IP i saber de que maquina(PC) ingreso.',
  `Cat_o_Mod` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_swedish_ci' NOT NULL COMMENT 'Las acciones que realizo el usuario.',
  `Registro` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_swedish_ci' NOT NULL COMMENT 'Descripcion de lo que realizo en el sistema ALTA, BAJA o MODIFICACION',
  PRIMARY KEY (`Pk_Control`),
  INDEX `fk_tbl_HistorialAcceso_tbl_Usuario_Login1_idx` (`Fk_Usuario_Login` ASC),
  CONSTRAINT `fk_tbl_HistorialAcceso_tbl_Usuario_Login1`
    FOREIGN KEY (`Fk_Usuario_Login`)
    REFERENCES `db_laboratorios`.`tbl_usuario_login` (`Pk_Usuario_Login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 81
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_swedish_ci;


-- -----------------------------------------------------
-- Table `db_laboratorios`.`tbl_escuela`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_laboratorios`.`tbl_escuela` ;

CREATE TABLE IF NOT EXISTS `db_laboratorios`.`tbl_escuela` (
  `pk_dtgenerales` INT(11) NOT NULL AUTO_INCREMENT,
  `nombreInstitucion` VARCHAR(300) NOT NULL,
  `apodoInstitucion` VARCHAR(300) NOT NULL,
  `clave` VARCHAR(100) NOT NULL,
  `direccion` VARCHAR(300) NOT NULL,
  `telefono` VARCHAR(60) NOT NULL,
  `fechaIncorporacionSrecetaria` VARCHAR(70) NOT NULL,
  `noOficio` VARCHAR(100) NOT NULL,
  `registro` VARCHAR(70) NOT NULL,
  `regimen` VARCHAR(100) NOT NULL,
  `paginaInternet` VARCHAR(100) NOT NULL,
  `lemaEscuela` VARCHAR(100) NOT NULL,
  `escuelaActiva` TINYINT NOT NULL,
  PRIMARY KEY (`pk_dtgenerales`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_laboratorios`.`tbl_carreras`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_laboratorios`.`tbl_carreras` ;

CREATE TABLE IF NOT EXISTS `db_laboratorios`.`tbl_carreras` (
  `pk_carreras` INT(11) NOT NULL AUTO_INCREMENT,
  `fk_dtgenerales` INT(11) NOT NULL,
  `nombreCarrera` VARCHAR(100) NOT NULL,
  `edificio` VARCHAR(60) NULL,
  `estadoCarrera` INT(2) NULL DEFAULT NULL,
  PRIMARY KEY (`pk_carreras`),
  INDEX `fk_tbl_carreras_tbl_datosgenerales1_idx` (`fk_dtgenerales` ASC),
  CONSTRAINT `fk_tbl_carreras_tbl_datosgenerales1`
    FOREIGN KEY (`fk_dtgenerales`)
    REFERENCES `db_laboratorios`.`tbl_escuela` (`pk_dtgenerales`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_laboratorios`.`rel_trabajadorecarreras`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_laboratorios`.`rel_trabajadorecarreras` ;

CREATE TABLE IF NOT EXISTS `db_laboratorios`.`rel_trabajadorecarreras` (
  `pk_rel_trbajadorescarreras` INT NOT NULL AUTO_INCREMENT,
  `fk_Usuario_Login` SMALLINT(5) UNSIGNED NOT NULL,
  `fk_carreras` INT(11) NOT NULL,
  `activoPersona` INT(2) NOT NULL,
  INDEX `fk_trabajadores_has_carreras_carreras1_idx` (`fk_carreras` ASC),
  PRIMARY KEY (`pk_rel_trbajadorescarreras`),
  INDEX `fk_rel_trabajadorecarreras_tbl_usuario_login1_idx` (`fk_Usuario_Login` ASC),
  CONSTRAINT `fk_trabajadores_has_carreras_carreras1`
    FOREIGN KEY (`fk_carreras`)
    REFERENCES `db_laboratorios`.`tbl_carreras` (`pk_carreras`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_rel_trabajadorecarreras_tbl_usuario_login1`
    FOREIGN KEY (`fk_Usuario_Login`)
    REFERENCES `db_laboratorios`.`tbl_usuario_login` (`Pk_Usuario_Login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_laboratorios`.`tbl_laboratorios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_laboratorios`.`tbl_laboratorios` ;

CREATE TABLE IF NOT EXISTS `db_laboratorios`.`tbl_laboratorios` (
  `Pk_laboratorios` INT NOT NULL AUTO_INCREMENT,
  `fk_carreras` INT(11) NOT NULL,
  `DescripcionLaboratorios` VARCHAR(200) NULL,
  `ActivoLaboratorios` TINYINT(1) NULL,
  PRIMARY KEY (`Pk_laboratorios`),
  INDEX `fk_tbl_laboratorios_tbl_carreras1_idx` (`fk_carreras` ASC),
  CONSTRAINT `fk_tbl_laboratorios_tbl_carreras1`
    FOREIGN KEY (`fk_carreras`)
    REFERENCES `db_laboratorios`.`tbl_carreras` (`pk_carreras`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_laboratorios`.`Cat_TipoMaterial`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_laboratorios`.`Cat_TipoMaterial` ;

CREATE TABLE IF NOT EXISTS `db_laboratorios`.`Cat_TipoMaterial` (
  `Pk_TipoMaterial` INT NOT NULL AUTO_INCREMENT,
  `DescripcionTipoMaterial` VARCHAR(45) NULL,
  `ActivoTipoMaterial` TINYINT(1) NULL,
  PRIMARY KEY (`Pk_TipoMaterial`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_laboratorios`.`Cat_EstadoMaterial`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_laboratorios`.`Cat_EstadoMaterial` ;

CREATE TABLE IF NOT EXISTS `db_laboratorios`.`Cat_EstadoMaterial` (
  `Pk_EstadoMaterial` INT NOT NULL AUTO_INCREMENT,
  `Descripcion_EstadoMaterial` VARCHAR(45) NULL,
  `Activo_EstadoMaterial` VARCHAR(45) NULL,
  PRIMARY KEY (`Pk_EstadoMaterial`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_laboratorios`.`cat_frecuenciauso`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_laboratorios`.`cat_frecuenciauso` ;

CREATE TABLE IF NOT EXISTS `db_laboratorios`.`cat_frecuenciauso` (
  `pk_frecuenciauso` INT NOT NULL AUTO_INCREMENT,
  `descrip_frecuenciauso` VARCHAR(45) NULL,
  `activo_frecuenciauso` TINYINT(1) NULL,
  PRIMARY KEY (`pk_frecuenciauso`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_laboratorios`.`cat_clasematerial`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_laboratorios`.`cat_clasematerial` ;

CREATE TABLE IF NOT EXISTS `db_laboratorios`.`cat_clasematerial` (
  `pk_clasematerial` INT NOT NULL AUTO_INCREMENT,
  `descrip_clasematerial` VARCHAR(45) NULL,
  `activo_clasematerial` TINYINT(1) NULL,
  PRIMARY KEY (`pk_clasematerial`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_laboratorios`.`Cat_UnidadMedida`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_laboratorios`.`Cat_UnidadMedida` ;

CREATE TABLE IF NOT EXISTS `db_laboratorios`.`Cat_UnidadMedida` (
  `Pk_UnidadMedida` INT NOT NULL AUTO_INCREMENT,
  `Descripcion_UnidadMedida` VARCHAR(100) NULL,
  `Activo_UnidadMedida` TINYINT(1) NULL,
  PRIMARY KEY (`Pk_UnidadMedida`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_laboratorios`.`tbl_material`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_laboratorios`.`tbl_material` ;

CREATE TABLE IF NOT EXISTS `db_laboratorios`.`tbl_material` (
  `Pk_material` INT NOT NULL AUTO_INCREMENT,
  `fk_laboratorios` INT NOT NULL,
  `fk_clasematerial` INT NOT NULL,
  `DescripcionMaterial` VARCHAR(200) NULL,
  `CantidadMaterial` VARCHAR(45) NULL,
  `Fk_UnidadMedida` INT NOT NULL,
  `MedidasMaterial` VARCHAR(45) NULL,
  `Fk_TipoMaterial` INT NOT NULL,
  `MarcaMaterial` VARCHAR(45) NULL,
  `Fk_EstadoMaterial` INT NOT NULL,
  `ObservacionesMaterial` TEXT NULL,
  `Almacenado` VARCHAR(45) NULL,
  `Uso` VARCHAR(45) NULL,
  `fk_frecuenciauso` INT NOT NULL,
  `NumeroInventario` VARCHAR(45) NULL,
  `ActivoMaterial` TINYINT(1) NULL,
  PRIMARY KEY (`Pk_material`),
  INDEX `fk_tbl_material_Cat_TipoMaterial1_idx` (`Fk_TipoMaterial` ASC),
  INDEX `fk_tbl_material_Cat_EstadoMaterial1_idx` (`Fk_EstadoMaterial` ASC),
  INDEX `fk_tbl_material_cat_frecuenciauso1_idx` (`fk_frecuenciauso` ASC),
  INDEX `fk_tbl_material_tbl_laboratorios1_idx` (`fk_laboratorios` ASC),
  INDEX `fk_tbl_material_cat_clasematerial1_idx` (`fk_clasematerial` ASC),
  INDEX `fk_tbl_material_Cat_UnidadMedida1_idx` (`Fk_UnidadMedida` ASC),
  CONSTRAINT `fk_tbl_material_Cat_TipoMaterial1`
    FOREIGN KEY (`Fk_TipoMaterial`)
    REFERENCES `db_laboratorios`.`Cat_TipoMaterial` (`Pk_TipoMaterial`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_material_Cat_EstadoMaterial1`
    FOREIGN KEY (`Fk_EstadoMaterial`)
    REFERENCES `db_laboratorios`.`Cat_EstadoMaterial` (`Pk_EstadoMaterial`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_material_cat_frecuenciauso1`
    FOREIGN KEY (`fk_frecuenciauso`)
    REFERENCES `db_laboratorios`.`cat_frecuenciauso` (`pk_frecuenciauso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_material_tbl_laboratorios1`
    FOREIGN KEY (`fk_laboratorios`)
    REFERENCES `db_laboratorios`.`tbl_laboratorios` (`Pk_laboratorios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_material_cat_clasematerial1`
    FOREIGN KEY (`fk_clasematerial`)
    REFERENCES `db_laboratorios`.`cat_clasematerial` (`pk_clasematerial`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_material_Cat_UnidadMedida1`
    FOREIGN KEY (`Fk_UnidadMedida`)
    REFERENCES `db_laboratorios`.`Cat_UnidadMedida` (`Pk_UnidadMedida`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_laboratorios`.`rel_usuario_laboratorios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_laboratorios`.`rel_usuario_laboratorios` ;

CREATE TABLE IF NOT EXISTS `db_laboratorios`.`rel_usuario_laboratorios` (
  `pk_usuario_laboratorios` INT NOT NULL AUTO_INCREMENT,
  `fk_Usuario_Login` SMALLINT(5) UNSIGNED NOT NULL,
  `fk_laboratorios` INT NOT NULL,
  PRIMARY KEY (`pk_usuario_laboratorios`),
  INDEX `fk_rel_usuario_laboratorios_tbl_usuario_login1_idx` (`fk_Usuario_Login` ASC),
  INDEX `fk_rel_usuario_laboratorios_tbl_laboratorios1_idx` (`fk_laboratorios` ASC),
  CONSTRAINT `fk_rel_usuario_laboratorios_tbl_usuario_login1`
    FOREIGN KEY (`fk_Usuario_Login`)
    REFERENCES `db_laboratorios`.`tbl_usuario_login` (`Pk_Usuario_Login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_rel_usuario_laboratorios_tbl_laboratorios1`
    FOREIGN KEY (`fk_laboratorios`)
    REFERENCES `db_laboratorios`.`tbl_laboratorios` (`Pk_laboratorios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `db_laboratorios`.`cat_genero`
-- -----------------------------------------------------
START TRANSACTION;
USE `db_laboratorios`;
INSERT INTO `db_laboratorios`.`cat_genero` (`pk_genero`, `descripcion`, `estado`) VALUES (1, 'Masculino', 1);
INSERT INTO `db_laboratorios`.`cat_genero` (`pk_genero`, `descripcion`, `estado`) VALUES (2, 'Femenino', 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `db_laboratorios`.`tbl_usuario_login`
-- -----------------------------------------------------
START TRANSACTION;
USE `db_laboratorios`;
INSERT INTO `db_laboratorios`.`tbl_usuario_login` (`Pk_Usuario_Login`, `nombre`, `apaterno`, `amaterno`, `fk_genero`, `telefono`, `correo`, `Usuario`, `Password`, `Tipo_User`, `Usuario_Online`, `activo_usuario`) VALUES (1, 'Ivan Mauricio', 'Meneses', 'Melo Granados', 1, '9611007410', 'melo1088@hotmail.com', 'melo', '12345', 'Administrador', 0, 1);
INSERT INTO `db_laboratorios`.`tbl_usuario_login` (`Pk_Usuario_Login`, `nombre`, `apaterno`, `amaterno`, `fk_genero`, `telefono`, `correo`, `Usuario`, `Password`, `Tipo_User`, `Usuario_Online`, `activo_usuario`) VALUES (2, 'Administrador', NULL, NULL, 1, '0', '0', 'admin', 'admin', 'Administrador', 0, 1);
INSERT INTO `db_laboratorios`.`tbl_usuario_login` (`Pk_Usuario_Login`, `nombre`, `apaterno`, `amaterno`, `fk_genero`, `telefono`, `correo`, `Usuario`, `Password`, `Tipo_User`, `Usuario_Online`, `activo_usuario`) VALUES (3, 'QFB1', NULL, NULL, 1, '0', NULL, 'qfb1', 'qfb1', 'normal', 0, 1);
INSERT INTO `db_laboratorios`.`tbl_usuario_login` (`Pk_Usuario_Login`, `nombre`, `apaterno`, `amaterno`, `fk_genero`, `telefono`, `correo`, `Usuario`, `Password`, `Tipo_User`, `Usuario_Online`, `activo_usuario`) VALUES (4, 'QFB2', NULL, NULL, 1, '0', NULL, 'qfb2', 'qfb2', 'normal', 0, 1);
INSERT INTO `db_laboratorios`.`tbl_usuario_login` (`Pk_Usuario_Login`, `nombre`, `apaterno`, `amaterno`, `fk_genero`, `telefono`, `correo`, `Usuario`, `Password`, `Tipo_User`, `Usuario_Online`, `activo_usuario`) VALUES (5, 'ODON1', NULL, NULL, 1, '0', NULL, 'odon1', 'odon1', 'normal', 0, 1);
INSERT INTO `db_laboratorios`.`tbl_usuario_login` (`Pk_Usuario_Login`, `nombre`, `apaterno`, `amaterno`, `fk_genero`, `telefono`, `correo`, `Usuario`, `Password`, `Tipo_User`, `Usuario_Online`, `activo_usuario`) VALUES (6, 'ODON2', NULL, NULL, 1, '0', NULL, 'odon2', 'odon2', 'normal', 0, 1);
INSERT INTO `db_laboratorios`.`tbl_usuario_login` (`Pk_Usuario_Login`, `nombre`, `apaterno`, `amaterno`, `fk_genero`, `telefono`, `correo`, `Usuario`, `Password`, `Tipo_User`, `Usuario_Online`, `activo_usuario`) VALUES (7, 'MED1', NULL, NULL, 1, '0', NULL, 'med1', 'med1', 'normal', 0, 1);
INSERT INTO `db_laboratorios`.`tbl_usuario_login` (`Pk_Usuario_Login`, `nombre`, `apaterno`, `amaterno`, `fk_genero`, `telefono`, `correo`, `Usuario`, `Password`, `Tipo_User`, `Usuario_Online`, `activo_usuario`) VALUES (8, 'MED2', NULL, NULL, 1, '0', NULL, 'med2', 'med2', 'normal', 0, 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `db_laboratorios`.`tbl_escuela`
-- -----------------------------------------------------
START TRANSACTION;
USE `db_laboratorios`;
INSERT INTO `db_laboratorios`.`tbl_escuela` (`pk_dtgenerales`, `nombreInstitucion`, `apodoInstitucion`, `clave`, `direccion`, `telefono`, `fechaIncorporacionSrecetaria`, `noOficio`, `registro`, `regimen`, `paginaInternet`, `lemaEscuela`, `escuelaActiva`) VALUES (1, 'Instituto de Estudios Superiores de Chiapas', 'UNIVERSIDAD SALAZAR', '07PSU0002D', 'BLVD. PASO LIMON No. 244', '(961) 614 1621 y 614 1626', '03 DE NOVIEMBRE DE 1983', '0233', 'SEP/PSA/2009/030', 'PARTICULAR', 'www.iesch.edu.mx', 'POR LA CULTURA Y SUPERACION DE MI PUEBLO', 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `db_laboratorios`.`tbl_carreras`
-- -----------------------------------------------------
START TRANSACTION;
USE `db_laboratorios`;
INSERT INTO `db_laboratorios`.`tbl_carreras` (`pk_carreras`, `fk_dtgenerales`, `nombreCarrera`, `edificio`, `estadoCarrera`) VALUES (1, 1, 'Quimico Farmaceutico Biologo', '5', 1);
INSERT INTO `db_laboratorios`.`tbl_carreras` (`pk_carreras`, `fk_dtgenerales`, `nombreCarrera`, `edificio`, `estadoCarrera`) VALUES (2, 1, 'Medicina', '4', 1);
INSERT INTO `db_laboratorios`.`tbl_carreras` (`pk_carreras`, `fk_dtgenerales`, `nombreCarrera`, `edificio`, `estadoCarrera`) VALUES (3, 1, 'Odontologia', '7', 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `db_laboratorios`.`tbl_laboratorios`
-- -----------------------------------------------------
START TRANSACTION;
USE `db_laboratorios`;
INSERT INTO `db_laboratorios`.`tbl_laboratorios` (`Pk_laboratorios`, `fk_carreras`, `DescripcionLaboratorios`, `ActivoLaboratorios`) VALUES (1, 1, 'Laboratorio AB QFB', 1);
INSERT INTO `db_laboratorios`.`tbl_laboratorios` (`Pk_laboratorios`, `fk_carreras`, `DescripcionLaboratorios`, `ActivoLaboratorios`) VALUES (2, 1, 'Laboratorio BC QFB', 1);
INSERT INTO `db_laboratorios`.`tbl_laboratorios` (`Pk_laboratorios`, `fk_carreras`, `DescripcionLaboratorios`, `ActivoLaboratorios`) VALUES (3, 2, 'Laboratorio Medicina', 1);
INSERT INTO `db_laboratorios`.`tbl_laboratorios` (`Pk_laboratorios`, `fk_carreras`, `DescripcionLaboratorios`, `ActivoLaboratorios`) VALUES (4, 3, 'Laboratorio Odontologia', 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `db_laboratorios`.`Cat_TipoMaterial`
-- -----------------------------------------------------
START TRANSACTION;
USE `db_laboratorios`;
INSERT INTO `db_laboratorios`.`Cat_TipoMaterial` (`Pk_TipoMaterial`, `DescripcionTipoMaterial`, `ActivoTipoMaterial`) VALUES (1, 'Vidrio', 1);
INSERT INTO `db_laboratorios`.`Cat_TipoMaterial` (`Pk_TipoMaterial`, `DescripcionTipoMaterial`, `ActivoTipoMaterial`) VALUES (2, 'Metal', 1);
INSERT INTO `db_laboratorios`.`Cat_TipoMaterial` (`Pk_TipoMaterial`, `DescripcionTipoMaterial`, `ActivoTipoMaterial`) VALUES (3, 'Porcelana', 1);
INSERT INTO `db_laboratorios`.`Cat_TipoMaterial` (`Pk_TipoMaterial`, `DescripcionTipoMaterial`, `ActivoTipoMaterial`) VALUES (4, 'Acero Inoxidable', 1);
INSERT INTO `db_laboratorios`.`Cat_TipoMaterial` (`Pk_TipoMaterial`, `DescripcionTipoMaterial`, `ActivoTipoMaterial`) VALUES (5, 'Plastico', 1);
INSERT INTO `db_laboratorios`.`Cat_TipoMaterial` (`Pk_TipoMaterial`, `DescripcionTipoMaterial`, `ActivoTipoMaterial`) VALUES (6, 'Latex', 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `db_laboratorios`.`Cat_EstadoMaterial`
-- -----------------------------------------------------
START TRANSACTION;
USE `db_laboratorios`;
INSERT INTO `db_laboratorios`.`Cat_EstadoMaterial` (`Pk_EstadoMaterial`, `Descripcion_EstadoMaterial`, `Activo_EstadoMaterial`) VALUES (1, 'En Funcionamiento', '1');
INSERT INTO `db_laboratorios`.`Cat_EstadoMaterial` (`Pk_EstadoMaterial`, `Descripcion_EstadoMaterial`, `Activo_EstadoMaterial`) VALUES (2, 'No Funciona', '1');

COMMIT;


-- -----------------------------------------------------
-- Data for table `db_laboratorios`.`cat_frecuenciauso`
-- -----------------------------------------------------
START TRANSACTION;
USE `db_laboratorios`;
INSERT INTO `db_laboratorios`.`cat_frecuenciauso` (`pk_frecuenciauso`, `descrip_frecuenciauso`, `activo_frecuenciauso`) VALUES (1, 'Continua', 1);
INSERT INTO `db_laboratorios`.`cat_frecuenciauso` (`pk_frecuenciauso`, `descrip_frecuenciauso`, `activo_frecuenciauso`) VALUES (2, 'Frecuente', 1);
INSERT INTO `db_laboratorios`.`cat_frecuenciauso` (`pk_frecuenciauso`, `descrip_frecuenciauso`, `activo_frecuenciauso`) VALUES (3, 'Ocasional', 1);
INSERT INTO `db_laboratorios`.`cat_frecuenciauso` (`pk_frecuenciauso`, `descrip_frecuenciauso`, `activo_frecuenciauso`) VALUES (4, 'Poco Usual', 1);
INSERT INTO `db_laboratorios`.`cat_frecuenciauso` (`pk_frecuenciauso`, `descrip_frecuenciauso`, `activo_frecuenciauso`) VALUES (5, 'Rara', 1);
INSERT INTO `db_laboratorios`.`cat_frecuenciauso` (`pk_frecuenciauso`, `descrip_frecuenciauso`, `activo_frecuenciauso`) VALUES (6, 'Muy Rara', 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `db_laboratorios`.`cat_clasematerial`
-- -----------------------------------------------------
START TRANSACTION;
USE `db_laboratorios`;
INSERT INTO `db_laboratorios`.`cat_clasematerial` (`pk_clasematerial`, `descrip_clasematerial`, `activo_clasematerial`) VALUES (1, 'Material', 1);
INSERT INTO `db_laboratorios`.`cat_clasematerial` (`pk_clasematerial`, `descrip_clasematerial`, `activo_clasematerial`) VALUES (2, 'Reactivos', 1);
INSERT INTO `db_laboratorios`.`cat_clasematerial` (`pk_clasematerial`, `descrip_clasematerial`, `activo_clasematerial`) VALUES (3, 'Equipo', 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `db_laboratorios`.`Cat_UnidadMedida`
-- -----------------------------------------------------
START TRANSACTION;
USE `db_laboratorios`;
INSERT INTO `db_laboratorios`.`Cat_UnidadMedida` (`Pk_UnidadMedida`, `Descripcion_UnidadMedida`, `Activo_UnidadMedida`) VALUES (1, 'mL', 1);
INSERT INTO `db_laboratorios`.`Cat_UnidadMedida` (`Pk_UnidadMedida`, `Descripcion_UnidadMedida`, `Activo_UnidadMedida`) VALUES (2, 'gr', 1);
INSERT INTO `db_laboratorios`.`Cat_UnidadMedida` (`Pk_UnidadMedida`, `Descripcion_UnidadMedida`, `Activo_UnidadMedida`) VALUES (3, 'Lts', 1);
INSERT INTO `db_laboratorios`.`Cat_UnidadMedida` (`Pk_UnidadMedida`, `Descripcion_UnidadMedida`, `Activo_UnidadMedida`) VALUES (4, 'kg', 1);
INSERT INTO `db_laboratorios`.`Cat_UnidadMedida` (`Pk_UnidadMedida`, `Descripcion_UnidadMedida`, `Activo_UnidadMedida`) VALUES (5, 'Oz', 1);
INSERT INTO `db_laboratorios`.`Cat_UnidadMedida` (`Pk_UnidadMedida`, `Descripcion_UnidadMedida`, `Activo_UnidadMedida`) VALUES (6, 'Pieza', 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `db_laboratorios`.`rel_usuario_laboratorios`
-- -----------------------------------------------------
START TRANSACTION;
USE `db_laboratorios`;
INSERT INTO `db_laboratorios`.`rel_usuario_laboratorios` (`pk_usuario_laboratorios`, `fk_Usuario_Login`, `fk_laboratorios`) VALUES (1, 3, 1);
INSERT INTO `db_laboratorios`.`rel_usuario_laboratorios` (`pk_usuario_laboratorios`, `fk_Usuario_Login`, `fk_laboratorios`) VALUES (2, 4, 1);
INSERT INTO `db_laboratorios`.`rel_usuario_laboratorios` (`pk_usuario_laboratorios`, `fk_Usuario_Login`, `fk_laboratorios`) VALUES (3, 5, 2);
INSERT INTO `db_laboratorios`.`rel_usuario_laboratorios` (`pk_usuario_laboratorios`, `fk_Usuario_Login`, `fk_laboratorios`) VALUES (4, 6, 2);
INSERT INTO `db_laboratorios`.`rel_usuario_laboratorios` (`pk_usuario_laboratorios`, `fk_Usuario_Login`, `fk_laboratorios`) VALUES (5, 7, 3);
INSERT INTO `db_laboratorios`.`rel_usuario_laboratorios` (`pk_usuario_laboratorios`, `fk_Usuario_Login`, `fk_laboratorios`) VALUES (6, 8, 3);

COMMIT;

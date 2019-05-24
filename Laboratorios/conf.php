<?php
/*
 * Archivo de configuración para nuestra aplicación modularizada.
 * Definimos valores por defecto y datos para cada uno de nuestros módulos.
*/
define('MODULO_DEFECTO', 'home');
define('LAYOUT_DEFECTO', 'layout.php');
define('LAYOUT_IPAD', 'layout-ipad.php');
define('MODULO_PATH', realpath('./modulos/'));
define('LAYOUT_PATH', realpath('./layouts/'));

///************ Adonai Samai *********************/
$conf['home'] = array(
      			'archivo' => 'home.php',
      			'layout' => LAYOUT_DEFECTO ); 
$conf['home2'] = array(
      			'archivo' => 'home2.php' );
$conf['salir'] = array(
                'archivo' => 'salir.php' );

//PermisoDenegado
$conf['PermisoDenegado'] = array(
      			'archivo' => 'Sistema/usuario/PermisoDenegado.php' );


//Herramientas ->Datos Institucion
$conf['Alta_Institucion'] = array(
      			'archivo' => 'Herramientas/DatosInstitucion/Alta_Institucion.php' );


//datos institucion
$conf['DatosInstitucion']=array('archivo' => 'Herramientas/DatosInstitucion/vi_Institucion.php');

//carreras
$conf['Carreras']=array('archivo' => 'Herramientas/carreras/vi_Carreras.php');

$conf['Alta_Carreras']=array('archivo' => 'Herramientas/carreras/fa_carrera.php');


//carreras
$conf['DatosInstitucion']=array('archivo' => 'Herramientas/DatosInstitucion/vi_Institucion.php');

//USUARIOS
$conf['Usuarios']=array('archivo' => 'Herramientas/trabajadores/vi_usuarios.php');
$conf['AltaUser']=array('archivo' => 'Herramientas/trabajadores/fa_trabajadores.php');

//MATERIALES
$conf['Materiales']=array('archivo' => 'Materiales/vi_Materiales.php');
$conf['MaterialesModificar']=array('archivo' => 'Materiales/vi_MaterialesModificar.php');
$conf['MaterialesListar']=array('archivo' => 'Materiales/vi_MaterialesListado.php');
$conf['MaterialesSalidas']=array('archivo' => 'Materiales/vi_MaterialesSalidas.php');
$conf['ReporteLaboratorios']=array('archivo' => 'Materiales/vi_ReporteLaboratorios.php');


?>
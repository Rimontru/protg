<?php
/*
 * Archivo de configuración para nuestra aplicación modularizada.
 * Definimos valores por defecto y datos para cada uno de nuestros módulos.
*/
define('MODULO_DEFECTO', 'home');
define('MODULO_DEBUG', 'debug');
define('LAYOUT_DEFECTO', 'layout.php');
define('LAYOUT_IPAD', 'layout-ipad.php');
define('MODULO_PATH', realpath('./modulos/'));
define('LAYOUT_PATH', realpath('./layouts/'));

///******************Define Class*********************/
$conf['home'] = array(
      			'archivo' => 'home.php',
      			'layout' => LAYOUT_DEFECTO );
$conf['home2'] = array(
      			'archivo' => 'home2.php' );
$conf['salir'] = array(
                'archivo' => 'salir.php' );

$conf['debug'] = array(
                'archivo' => 'pageDebug.php' );

//PermisoDenegado
$conf['PermisoDenegado'] = array(
      			'archivo' => 'Sistema/usuario/PermisoDenegado.php' );


//Herramientas ->Datos Institucion
$conf['Alta_Institucion'] = array(
      			'archivo' => 'Herramientas/DatosInstitucion/Alta_Institucion.php' );


//datos institucion
$conf['DatosInstitucion']=array('archivo' => 'Herramientas/DatosInstitucion/vi_Institucion.php');

//Generaciones
$conf['Generaciones']=array('archivo' => 'Herramientas/Generaciones/vi_Generaciones.php');

//Sinodales
$conf['Sinodales']=array('archivo' => 'Sinodales/vi_Sinodales.php');
$conf['SinodalesModificar']=array('archivo' => 'Sinodales/vi_SinodalesModificar.php');
$conf['BajaRecuperacion']=array('archivo' => 'Sinodales/vi_SinodalesBajaRecuperar.php');
$conf['ReportesSinodales']=array('archivo' => 'Sinodales/vi_ReportesSinodales.php');


//carreras
$conf['Carreras']=array('archivo' => 'Herramientas/carreras/vi_Carreras.php');

$conf['Alta_Carreras']=array('archivo' => 'Herramientas/carreras/fa_carrera.php');


//carreras
$conf['DatosInstitucion']=array('archivo' => 'Herramientas/DatosInstitucion/vi_Institucion.php');

//USUARIOS
$conf['Usuarios']=array('archivo' => 'Herramientas/trabajadores/vi_usuarios.php');
$conf['AltaTrabajadores']=array('archivo' => 'Herramientas/trabajadores/fa_trabajadores.php');

//ALUMNOS
$conf['Alumnos']=array('archivo' => 'Alumnos/vi_Alumnos.php');
$conf['AlumnosModificar']=array('archivo' => 'Alumnos/vi_AlumnosModificar.php');


//EGRESADOS
$conf['vi_Egresados']=array('archivo' => 'Egresados/vi_Egresados.php');
$conf['EgresadosReportes']=array('archivo' => 'Egresados/vi_EgresadosReportes.php');
$conf['EncuestaEgresadosMedicina']=array('archivo' => 'Egresados/vi_EncuestaEgresadosMedicina.php');
$conf['EncuestaEgresadosMaestria']=array('archivo' => 'Egresados/vi_EncuestaEgresadosMaestria.php');
$conf['EncuestaEgresadosDoctorado']=array('archivo' => 'Egresados/vi_EncuestaEgresadosDoctorado.php');
$conf['EncuestaEmpleadores']=array('archivo'=>'Egresados/vi_EncuestaEmpleadores.php');
$conf['EncuestaEmpleadores2019']=array('archivo'=>'Egresados/vi_EncuestaEmpleadores2019.php');

$conf['rptCumplexcel'] = array('archivo'=>'Egresados/cumples.php');

//mio busqueda
$conf['Busqueda']=array('archivo' => 'Egresados/vi_Busqueda.php');


//EXAMEN INST
$conf['ExamenInstitucional']=array('archivo' => 'Tramites/ExamenInstitucional/vi_ExamenInstitucional.php');
$conf['ExamenInstitucionalReportes']=array('archivo' => 'Tramites/ExamenInstitucional/vi_ExamenInstitucionalReportes.php');
$conf['ReportesSecretaria']=array('archivo' => 'Tramites/ExamenInstitucional/vi_ExamenInstitucionalReportesSecretaria.php');



//toma protesta
$conf['TomaProtesta']=array('archivo' => 'Tramites/TomaProtesta/vi_TomaProtesta.php');
$conf['TomaProtestaReportes']=array('archivo' => 'Tramites/TomaProtesta/vi_TomaProtestaReportes.php');



//servicios escolares
$conf['SecretariaEducacion']=array('archivo' => 'ServiciosEscolares/SecretariaEducacion/vi_SecretariaEducacion.php');
$conf['AsignarFolios']=array('archivo' => 'ServiciosEscolares/AsignarFolios/vi_AsignarFolios.php');
$conf['ReportesExamenIns']=array('archivo' => 'ServiciosEscolares/RegistroAsistencia/vi_ReportesExamenIns.php');
$conf['CapturaResultados']=array('archivo' => 'ServiciosEscolares/CapturaResultados/vi_CapturaResultados.php');
$conf['TomaProtestaSabana']=array('archivo' => 'ServiciosEscolares/SecretariaEducacion/TomaProtestaSabana.php');

//verificacion documentos
$conf['CertificacionTitulo']=array('archivo' => 'VerificacionDoctos/Certificacion/vi_certificacionTitulos.php');
$conf['RegistroTimbres']=array('archivo' => 'VerificacionDoctos/Timbres/vi_registroTimbresSecretaria.php');


//claves de usuarios
$conf['Usuario_Alta']=array('archivo' => 'Sistema/usuario/Usuario_Alta.php');
$conf['Usuario_Modificar']=array('archivo' => 'Sistema/usuario/Usuario_Modificar.php');
$conf['Usuarios']=array('archivo' => 'Sistema/usuario/vi_usuarios.php');

//EMPLEADORES
$conf['Empleadores']=array('archivo' => 'Herramientas/empleadores/vi_Empleadores.php');
$conf['EmpleadoresReportes']=array('archivo' => 'Herramientas/empleadores/vi_EmpleadoresReportes.php');
$conf['EmpleadoresModificar']=array('archivo' => 'Herramientas/empleadores/vi_EmpleadoresModificar.php');


//Extras Mios
$conf['Full_titulos']=array('archivo'=>'Extras/Titulos/vi_cargaMasivadeTitulos.php');
$conf['Upload_Alumnos']=array('archivo'=>'Extras/Listas/vi_cargaMasivadeListasAlumnos.php');
$conf['Delete_prints']=array('archivo'=>'Extras/Titulos/creaArregloConSession.php');
$conf['uploadFileServer']=array('archivo'=>'Extras/Listas/vi_UploadServerFileExcell.php');
$conf['readAndViewExcell']=array('archivo'=>'Extras/Listas/vi_readAndviewFileExcell.php');
$conf['SolutionGroup'] = array(
      			'archivo' => 'Herramientas/Generaciones/vi_GroupGeneraciones.php' );

//Directorio
$conf['RegistroCertificados']=array('archivo'=>'Directorio/vi_directorios.php');


?>

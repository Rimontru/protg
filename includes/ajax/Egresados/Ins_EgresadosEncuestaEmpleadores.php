<?php
$Ruta = "../../";
require($Ruta . "Config.class.php");  # Cargar datos conexion y otras variables.
require($Ruta . "InsertarDB.class.php");
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisValidaciones.class.php");

session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);

$Consulta = new ConsultaDB;


$Registro = utf8_decode("Se agrego la encuesta Empleadores, al alumno: ". $pk_alumno);
$Insertar = new InsertarDB($_SESSION['usuario_id'], $_SESSION['IP'], "Alta Encuesta", $Registro);


if ( empty($_POST['pk_alumno']) || empty($_POST['pk_carreras']) ) {
    echo 0;    
}else {

    $result = $Insertar->InsEncuestaEmpleadoresByAlumno(
    	$pk_alumno, 
    	$pk_carreras,
        $empresaLabora,
    	$giroEmpresa,
    	$direccionEmpresa, 
    	$puestoEjerce, 
    	$mi_vi_va, 
    	$mi_vi_va_comment, 
    	$formaTrabajaEgresado, 
    	$realizaFunciones, 
    	$satisfaceTrabajoEgresado, 
    	$evaluaComportamientoEgresado, 
    	$contrataEgresado, 
    	$contrataEgresado_comment, 
    	$sugerenciasEmpleador, 
    	$nombreEmpleador,
    	$puestoEmpleador
    	);
    if ($result){        
               echo 1 ;
    } else {
        echo 0;
    }
   
    exit;
}//fin del else empty
?>
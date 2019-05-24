<?php
#AGREGADO: Ing. José Alberto Gómez Montejo
#FECHA: 03/05/2019 

$Ruta = "../../";
require($Ruta . "Config.class.php");  # Cargar datos conexion y otras variables.
require($Ruta . "InsertarDB.class.php");
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisValidaciones.class.php");

session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);

$Consulta = new ConsultaDB;


$Registro = utf8_decode("Se agrego la encuesta Empleadores, al alumno: ". $fk_alumno);
$Insertar = new InsertarDB($_SESSION['usuario_id'], $_SESSION['IP'], "Alta Encuesta", $Registro);

//var_dump($_POST);
//die;
if ( empty($_POST['fk_alumno']) || empty($_POST['fk_carreras']) ) {
    echo 0;    
}else {

    $result = $Insertar->InsEncuestaEmpleadoresByAlumno2019(
    	$fk_alumno, 
    	$fk_carreras,
        $empresaEmpleado,
    	$direccionEmpresa, 
    	$puestoEjerce, 
    	$P6,
        $P6C,
        $P7,
        $P7P,
        $P8,
        $P9,
        $P10,
        $P11,
        $comentariosEmpleador,
        $nombreEmpleador,
        $puestoEmpleador,
        $telefonoEmpleador,
        $correoEmpleador
    	);
    if ($result){        
               echo 1 ;
    } else {
        echo $result;
    }
   
    exit;
}//fin del else empty
?>
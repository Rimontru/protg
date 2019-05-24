<?php

$Ruta = "../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisFunciones.class.php");

$Funciones = new MisFunciones();
$Consulta = new ConsultaDB;
$jsondata = array();


if (isset($obtenerEdad)) {
    $jsondata['Error'] = "Error";
} else {
    extract($_POST);

  
            //obtener la edad del alumno            
//            $fecha_nacimiento=$row['FechaNacimiento'];
//
             $fechaSQL = explode("-",date("Y-m-d"));
            $fecha_control=$fechaSQL[2]."/".$fechaSQL[1]."/".$fechaSQL[0];


            $tiempo=$Funciones->tiempo_transcurrido($FechaNacimiento, $fecha_control);
//            $texto = "$tiempo[0] años con $tiempo[1] meses y $tiempo[2] días";
            $texto = "$tiempo[0] años";

            $jsondata['EdadAlumno'] = $texto;    

            
            
            
            
     echo json_encode($jsondata);
    exit;
}


?>
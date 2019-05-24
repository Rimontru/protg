<?php

$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisFunciones.class.php");

$Funciones = new MisFunciones();
$Consulta = new ConsultaDB;
$jsondata = array();

extract($_POST);
if (empty($id)) {
    $jsondata['Error'] = "Error al Consultar";
} else {

    $Result = $Consulta->obtenerEmpleadorId($id);
    $NumRow = mysql_num_rows($Result);

    if ($NumRow>=1) {
        $row = mysql_fetch_assoc($Result);
        
            $jsondata['fechaSolicitud'] = $Funciones->str_to_may($row['fechaSolicitud2']);
            $jsondata['empresa'] = $Funciones->str_to_may($row['empresa']);
            $jsondata['nombreSolicitante'] = $Funciones->str_to_may($row['nombreSolicitante']);
            $jsondata['puetoSolicitante'] = $Funciones->str_to_may($row['puetoSolicitante']);
            $jsondata['licenciatura'] = $Funciones->str_to_may($row['licenciatura']);
            $jsondata['puestoVacante'] = $Funciones->str_to_may($row['puestoVacante']);
            $jsondata['numVacantes'] = $Funciones->str_to_may($row['numVacantes']);
            $jsondata['telefono'] = $Funciones->str_to_may($row['telefono']);
            $jsondata['email'] = $Funciones->str_to_may($row['email']);
            $jsondata['direccion'] = $Funciones->str_to_may($row['direccion']);
            $jsondata['sexo'] = $Funciones->str_to_may($row['sexo']);
            $jsondata['error'] = "ok";
        mysql_free_result($Result);
    } else {
           $jsondata['error'] = "Error al Consultar";
    }
     echo json_encode($jsondata);
    exit;
}


?>
<?php

$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisFunciones.class.php");

$Funciones = new MisFunciones();
$Consulta = new ConsultaDB;
$jsondata = array();


if (empty($_POST['pk_trabajador'])) {
    $jsondata['Error'] = "Error al Consultar";
} else {
    extract($_POST);

    $Result = $Consulta->ConTrabajadoresLlavePrimaria($pk_trabajador);
    $NumRow = mysql_num_rows($Result);
    if ($NumRow>=1) {
        $row = mysql_fetch_assoc($Result);
        
            $jsondata['pk_trabajador'] = $row['pk_trabajador'];           
            $jsondata['claveTrabajador'] = $Funciones->str_to_may($row['claveTrabajador']);
            $jsondata['nombre'] = $Funciones->str_to_may($row['nombre']);
            $jsondata['apaterno'] = $Funciones->str_to_may($row['apaterno']);
            $jsondata['amaterno'] = $Funciones->str_to_may($row['amaterno']);
            $jsondata['telefono'] = $Funciones->str_to_may($row['telefono']);
            $jsondata['correo'] = $Funciones->str_to_may($row['correo']);
            $jsondata['puestoLaboral'] = $Funciones->str_to_may($row['puestoLaboral']);
            $jsondata['fk_genero'] = $Funciones->str_to_may($row['fk_genero']);
           
            
            
            $jsondata['error'] = "ok";
             
        mysql_free_result($Result);
    } else {
           $jsondata['error'] = "Error al Consultar";
    }
     echo json_encode($jsondata);
    exit;
}


?>
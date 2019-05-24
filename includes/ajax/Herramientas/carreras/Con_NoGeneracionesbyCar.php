<?php

$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisFunciones.class.php");

$Funciones = new MisFunciones();
$Consulta = new ConsultaDB;
$jsondata = array();
$Colonias=" <option value=''>--Elija hasta que generación a considerar--</option>";

extract($_POST);

if (isset($ObtenerGeneraciones)) {
    $Result = $Consulta->ConObtenerGeneracionesTodas($fk_nivelestudio, $fk_modalidad, $fk_carreras);
    $NumRow = mysql_num_rows($Result);
    if ($NumRow>=1) {
            while ($row = mysql_fetch_assoc($Result)) {
                $Colonias .= "<option value='$row[generacionNumero]'>"."No.".trim($row['generacionNumero'])."            Ciclo: ".trim($row['DescripcionGeneracion'])."</option>";
            }
        $jsondata['Generaciones'] = $Colonias;
        mysql_free_result($Result);
    } else {
           $jsondata['Generaciones'] = "Error";
    }
     echo json_encode($jsondata);
    exit;
    
}




?>
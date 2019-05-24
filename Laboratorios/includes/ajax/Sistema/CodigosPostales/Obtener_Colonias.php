<?php

$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisFunciones.class.php");

$Funciones = new MisFunciones();
$Consulta = new ConsultaDB;
$jsondata = array();
$Colonias=" <option value=''>-- Seleccione --</option>";

extract($_POST);
 
if (isset($ObtenerColonias)) {

    $Result = $Consulta->ConColonias($v_Municipio);
    $NumRow = mysql_num_rows($Result);
    if ($NumRow>=1) {
            while ($row = mysql_fetch_assoc($Result)) {
                $Colonias .= "<option value='$row[pk_colonia]'>".utf8_encode($row['descripcion'])."</option>";
            }

        $jsondata['Colonias'] = $Colonias;
        mysql_free_result($Result);
    } else {
           $jsondata['Colonias'] = "Error";
    }
     echo json_encode($jsondata);
    exit;
    
}






?>
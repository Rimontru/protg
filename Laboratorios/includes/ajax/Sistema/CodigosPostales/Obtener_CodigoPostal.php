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
 
if (isset($ObtenerCodigoPostal)) {

    $Result = $Consulta->ConCodigoPostal($v_coloniafracc);
    $NumRow = mysql_num_rows($Result);
    if ($NumRow>=1) {
        $row = mysql_fetch_assoc($Result);
              
          $jsondata['CodigoPostal'] = $row["cod_postal"];
        mysql_free_result($Result);
    } else {
           $jsondata['CodigoPostal'] = "Error";
    }
     echo json_encode($jsondata);
    exit;
    
}






?>
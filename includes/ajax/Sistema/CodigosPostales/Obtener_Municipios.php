<?php

$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisFunciones.class.php");

$Funciones = new MisFunciones();
$Consulta = new ConsultaDB;
$jsondata = array();
$Municipios=" <option value=''>-- Seleccione --</option>";

extract($_POST);
 
if (isset($ObtenerMunicipio)) {

    $Result = $Consulta->ConMunicipios($v_estado);
    $NumRow = mysql_num_rows($Result);
    if ($NumRow>=1) {
            while ($row = mysql_fetch_assoc($Result)) {
                $Municipios .= "<option value='$row[pk_ciudad]'>".utf8_encode($row['descripcion'])."</option>";
            }

        $jsondata['Municipios'] = $Municipios;
        mysql_free_result($Result);
    } else {
           $jsondata['Municipios'] = "Error";
    }
     echo json_encode($jsondata);
    exit;
    
}






?>
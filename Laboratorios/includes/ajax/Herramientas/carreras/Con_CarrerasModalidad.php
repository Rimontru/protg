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
 
if (isset($ObtenerModalidad)) {

    $Result = $Consulta->ConCarrerasporModalidadNivelEstudios($fk_modalidad, $fk_nivelestudio);
    $NumRow = mysql_num_rows($Result);
    if ($NumRow>=1) {
            while ($row = mysql_fetch_assoc($Result)) {
                $Colonias .= "<option value='$row[pk_carreras]'>".($row['nombreCarrera'])."</option>";
            }
        $jsondata['Carreras'] = $Colonias;
        mysql_free_result($Result);
    } else {
           $jsondata['Carreras'] = "Error";
    }
     echo json_encode($jsondata);
    exit;
    
}






?>
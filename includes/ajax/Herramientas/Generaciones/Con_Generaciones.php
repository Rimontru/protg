<?php

$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisFunciones.class.php");

$Funciones = new MisFunciones();
$Consulta = new ConsultaDB;
$jsondata = array();


if (empty($_POST['pk_generacion'])) {
    $jsondata['Error'] = "Error al Consultar";
} else {
    extract($_POST);

    $Result = $Consulta->ConsultaGeneracionesPorLLavePrimaria($pk_generacion);
    $NumRow = mysql_num_rows($Result);

    if ($NumRow>=1) {
        $row = mysql_fetch_assoc($Result);
        
            $jsondata['m_fk_inicioanios'] = $Funciones->str_to_may($row['AnioIniciopk_anios']);
            $jsondata['m_fk_iniciomes'] = $Funciones->str_to_may($row['MesIniciopk_meses']);
            $jsondata['m_fk_finanios'] = $Funciones->str_to_may($row['AnioFinpk_anios']);
            $jsondata['m_fk_finmeses'] = $Funciones->str_to_may($row['MesFinpk_meses']);            
            $jsondata['error'] = "ok";
            

        mysql_free_result($Result);
    } else {
           $jsondata['error'] = "Error al Consultar";
    }
     echo json_encode($jsondata);
    exit;
}


?>
<?php

$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisFunciones.class.php");

$consult = new ConsultaDB();
$funcion = new MisFunciones();
$jsondata = array();

if(empty($_POST['idCarrera'])){
    $jsondata['Error'] = "Error al consultar";
}else{
    extract($_POST);
    
    $result = $consult->obtenercarreras($idCarrera);
    $result_num_row = mysql_num_rows($result);
    
    if($result_num_row>=1){
        $result_row = mysql_fetch_assoc($result);
            
                $jsondata['pk_carreras'] = $result_row['pk_carreras'];               
                $jsondata['pk_dtgenerales'] = $result_row['pk_dtgenerales'];
                $jsondata['pk_modalidad'] = $result_row['pk_modalidad'];
                $jsondata['pk_nivelestudio'] = $result_row['pk_nivelestudio'];
                $jsondata['clvCarrera'] = $funcion->str_to_may($result_row['clvCarrera']);
                $jsondata['nombreCarrera'] = $funcion->str_to_may($result_row['nombreCarrera']);
                $jsondata['noacuerdo'] = $funcion->str_to_may($result_row['noacuerdo']);
                $jsondata['fechaExpedicion'] = $funcion->str_to_may($result_row['fechaExpedicion']);
                $jsondata['nombreTitulo'] = $funcion->str_to_may($result_row['nombreTitulo']);
                $jsondata['edificio'] = $funcion->str_to_may($result_row['edificio']);
                
                mysql_free_result($result);
    }else{
        $jsondata['Error'] = "Error al consultar";
    }
    echo json_encode($jsondata);
    exit;
}

?>

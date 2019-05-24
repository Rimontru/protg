<?php

$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisFunciones.class.php");

$Funciones = new MisFunciones();
$Consulta = new ConsultaDB;
$jsondata = array();


if (empty($_POST['pk_alumno'])) {
    $jsondata['Error'] = "Error al Consultar";
} else {
    extract($_POST);

    $Result = $Consulta->ConAlumnosporLlavePrimariaExamenInst($pk_alumno);
    $NumRow = mysql_num_rows($Result);
    if ($NumRow>=1) {
        $row = mysql_fetch_assoc($Result);
        
            $jsondata['pk_alumno'] = $row['pk_alumno'];           
            $jsondata['matricula'] = $Funciones->str_to_may($row['matricula']);
            $jsondata['nombre'] = $Funciones->str_to_may($row['nombre']);
            $jsondata['apaterno'] = $Funciones->str_to_may($row['apaterno']);
            $jsondata['amaterno'] = $Funciones->str_to_may($row['amaterno']);            
            $jsondata['fk_carreras'] = $Funciones->str_to_may($row['fk_carreras']);
          
            
            $jsondata['pk_egresados'] = $Funciones->str_to_may($row['pk_egresados']);
            
            //datos examen institucional
            $jsondata['Pk_ExamenInstitucional'] = $Funciones->str_to_may($row['Pk_ExamenInstitucional']);
            $jsondata['fechaaplicacion'] = $Funciones->str_to_may($row['fechaaplicacion']);
            $jsondata['hora'] = $Funciones->str_to_may($row['hora']);
            
            $jsondata['ActaOriginal'] = $Funciones->str_to_may($row['ActaOriginal']);
            $jsondata['ActaCopia'] = $Funciones->str_to_may($row['ActaCopia']);            
            $jsondata['cbOriginal'] = $Funciones->str_to_may($row['cbOriginal']);
            $jsondata['cbCopia'] = $Funciones->str_to_may($row['cbCopia']);
            $jsondata['clicOriginal'] = $Funciones->str_to_may($row['clicOriginal']);
            $jsondata['clicCopia'] = $Funciones->str_to_may($row['clicCopia']);
            $jsondata['curpOriginal'] = $Funciones->str_to_may($row['curpOriginal']);
            $jsondata['curpCopia'] = $Funciones->str_to_may($row['curpCopia']);
            $jsondata['consservicioOriginal'] = $Funciones->str_to_may($row['consservicioOriginal']);
            $jsondata['consservicioCopia'] = $Funciones->str_to_may($row['consservicioCopia']);
            
            $jsondata['reciboOriginal'] = $Funciones->str_to_may($row['reciboOriginal']);
            $jsondata['reciboCopia'] = $Funciones->str_to_may($row['reciboCopia']);
            $jsondata['recibofolio'] = $Funciones->str_to_may($row['recibofolio']);
            
            $jsondata['triniti'] = $Funciones->str_to_may($row['triniti']);
            $jsondata['trinitiCopia'] = $Funciones->str_to_may($row['trinitiCopia']);
            
            $jsondata['ObservacionesDoc'] = $Funciones->str_to_may($row['ObservacionesDoc']);
            
            
            
            $jsondata['error'] = "ok";
             
        mysql_free_result($Result);
    } else {
           $jsondata['error'] = "Error al Consultar";
    }
     echo json_encode($jsondata);
    exit;
}


?>
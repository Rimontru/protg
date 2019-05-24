<?php
error_reporting(E_ALL ^ E_DEPRECATED);
$Ruta = "../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisFunciones.class.php");

$Funciones = new MisFunciones();
$Consulta = new ConsultaDB;
$jsondata = array();


if (empty($_POST['Pk_material'])) {
    $jsondata['Error'] = "Error al Consultar";
} else {
    extract($_POST);

    $Result = $Consulta->ConsultaMaterialesLlavePrimaria($Pk_material);
    $NumRow = mysql_num_rows($Result);
    if ($NumRow>=1) {
        $row = mysql_fetch_assoc($Result);
        
            $jsondata['Pk_material'] = $row['Pk_material'];           
            $jsondata['fk_laboratorios'] = utf8_encode($row['fk_laboratorios']);
            $jsondata['fk_clasematerial'] = utf8_encode($row['fk_clasematerial']);
            $jsondata['DescripcionMaterial'] = utf8_encode($row['DescripcionMaterial']);
            $jsondata['CantidadMaterial'] = utf8_encode($row['CantidadMaterial']);
            $jsondata['MedidasMaterial'] = utf8_encode($row['MedidasMaterial']);
            $jsondata['Fk_TipoMaterial'] = utf8_encode($row['Fk_TipoMaterial']);
            $jsondata['MarcaMaterial'] = utf8_encode($row['MarcaMaterial']);
            $jsondata['Fk_EstadoMaterial'] = utf8_encode($row['Fk_EstadoMaterial']);
            $jsondata['ObservacionesMaterial'] = utf8_encode($row['ObservacionesMaterial']);
           
            $jsondata['Almacenado'] = utf8_encode($row['Almacenado']);
            $jsondata['Uso'] = utf8_encode($row['Uso']);
            $jsondata['fk_frecuenciauso'] = utf8_encode($row['fk_frecuenciauso']);
            $jsondata['NumeroInventario'] = utf8_encode($row['NumeroInventario']);
            $jsondata['ActivoMaterial'] = utf8_encode($row['ActivoMaterial']);
            
            $jsondata['Fk_UnidadMedida'] = utf8_encode($row['Fk_UnidadMedida']);
            
            
            
            $jsondata['fk_laboratorios'] = utf8_encode($row['fk_laboratorios']);
           
          
            
            
            
            
            
            
            
            
            
            
            $jsondata['error'] = "ok";
             
        mysql_free_result($Result);
    } else {
           $jsondata['error'] = "Error al Consultar";
    }
     echo json_encode($jsondata);
    exit;
}


?>
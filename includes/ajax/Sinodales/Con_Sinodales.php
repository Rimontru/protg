<?php

$Ruta = "../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisFunciones.class.php");

$Funciones = new MisFunciones();
$Consulta = new ConsultaDB;
$jsondata = array();


if (empty($_POST['pk_sinodal'])) {
    $jsondata['Error'] = "Error al Consultar";
} else {
    extract($_POST);

    $Result = $Consulta->ConsultaDatosSinodalesporLlavePrimaria($pk_sinodal, $pk_carreras);
    $NumRow = mysql_num_rows($Result);
    if ($NumRow>=1) {
        $row = mysql_fetch_assoc($Result);
        
            $jsondata['pk_sinodal'] = $row['pk_sinodal'];           
            $jsondata['nombre'] = $Funciones->str_to_may($row['nombre']);
            $jsondata['cedula'] = $Funciones->str_to_may($row['cedula']);
            $jsondata['fk_nivelestudio'] = $Funciones->str_to_may($row['fk_nivelestudio']);
            $jsondata['numEmpleado'] = $Funciones->str_to_may($row['numEmpleado']);
            $jsondata['cel'] = $Funciones->str_to_may($row['cel']);
            $jsondata['nss'] = $Funciones->str_to_may($row['nss']);
            $jsondata['direccion'] = $Funciones->str_to_may($row['direccion']);
            $jsondata['curp'] = $Funciones->str_to_may($row['curp']);
            $jsondata['rfc'] = $Funciones->str_to_may($row['rfc']);
           
            
            //obtenemos todas las carreras menos las del sinodal
            $pk_carreras = $row['pk_carreras'];
            $ResultMunicipio = $Consulta->ConsultaCarreras();        
            $Fila = "";
            while($RowCarreras1 = mysql_fetch_array($ResultMunicipio)){
                $Descrip = utf8_encode($RowCarreras1['clvCarrera']);
                if($RowCarreras1["pk_carreras"] == $pk_carreras){                
                    $Fila .= "<option value='$RowCarreras1[pk_carreras]' selected>$Descrip </option>";
                }else{
                    $Fila .= "<option value='$RowCarreras1[pk_carreras]'>$Descrip</option>";
                }
            }
            $jsondata['Lista1'] = $Fila;
            //FIN MUNICIPIOS 
             
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            $jsondata['error'] = "ok";
             
        mysql_free_result($Result);
    } else {
           $jsondata['error'] = "Error al Consultar";
    }
     echo json_encode($jsondata);
    exit;
}


?>
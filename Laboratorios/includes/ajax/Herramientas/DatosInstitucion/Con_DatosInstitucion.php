<?php

$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisFunciones.class.php");

$Funciones = new MisFunciones();
$Consulta = new ConsultaDB;
$jsondata = array();


if (empty($_POST['pk_dtgenerales'])) {
    $jsondata['Error'] = "Error al Consultar";
} else {
    extract($_POST);

    $Result = $Consulta->ConsultaDatosInstitucionPorLlavePrimaria($pk_dtgenerales);
    $NumRow = mysql_num_rows($Result);
    if ($NumRow>=1) {
        $row = mysql_fetch_assoc($Result);
        
            $jsondata['pk_dtgenerales'] = $row['pk_dtgenerales'];           
            $jsondata['fk_colonia'] = $Funciones->str_to_may($row['fk_colonia']);
            $jsondata['nombreInstitucion'] = $Funciones->str_to_may($row['nombreInstitucion']);
            $jsondata['apodoInstitucion'] = $Funciones->str_to_may($row['apodoInstitucion']);
            $jsondata['clave'] = $Funciones->str_to_may($row['clave']);
            $jsondata['direccion'] = $Funciones->str_to_may($row['direccion']);
            $jsondata['telefono'] = ($row['telefono']);
            $jsondata['fechaIncorporacionSrecetaria'] = $Funciones->str_to_may($row['fechaIncorporacionSrecetaria']);
            $jsondata['noOficio'] = $Funciones->str_to_may($row['noOficio']);
            $jsondata['registro'] = ($row['registro']);
            $jsondata['regimen'] = $row['regimen'];
            $jsondata['paginaInternet'] = ($row['paginaInternet']);
            $jsondata['lemaEscuela'] = ($row['lemaEscuela']);
            
            
            //
            $pk_estado = $row['pk_estado'];
             $jsondata['combo_estados'] = $pk_estado;
            //ciudad municipios
            $pk_ciudad = $row['pk_ciudad'];                  
            //estado municipuio colonia
            $ResultMunicipio = $Consulta->ConMunicipios($pk_estado);        
            $Fila = "";
            while($RowMunicipios = mysql_fetch_array($ResultMunicipio)){
                $Descrip = utf8_encode($RowMunicipios['descripcion']);
                if($RowMunicipios["pk_ciudad"] == $pk_ciudad){                
                    $Fila .= "<option value='$RowMunicipios[pk_ciudad]' selected>$Descrip </option>";
                }else{
                    $Fila .= "<option value='$RowMunicipios[pk_ciudad]'>$Descrip</option>";
                }
            }
            $jsondata['combo_municipios'] = $Fila;
            //FIN MUNICIPIOS 
             
            
             //colonias :D
            $pk_colonia = $row['pk_colonia'];      
            $ResultColonias = $Consulta->ConColonias($pk_ciudad);        
            $Fila2 = "";
            while($RowColonias = mysql_fetch_array($ResultColonias)){
                $Descrip = utf8_encode($RowColonias['descripcion']);
                if($RowColonias["pk_colonia"] == $pk_colonia){                
                    $Fila2 .= "<option value='$RowColonias[pk_colonia]' selected>$Descrip </option>";
                }else{
                    $Fila2 .= "<option value='$RowColonias[pk_colonia]'>$Descrip</option>";
                }
            }
            $jsondata['combo_colonias'] = $Fila2;
            //FIN MUNICIPIOS 
            
            
            

        mysql_free_result($Result);
    } else {
           $jsondata['Error'] = "Error al Consultar";
    }
     echo json_encode($jsondata);
    exit;
}


?>
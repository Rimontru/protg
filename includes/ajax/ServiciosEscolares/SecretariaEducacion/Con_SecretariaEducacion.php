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

    $Result = $Consulta->ConAlumnosporLlavePrimariaTomaProtesta($pk_alumno);
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
            $jsondata['fk_genero'] = $Funciones->str_to_may($row['fk_genero']);
            $jsondata['telefonofijo'] = $Funciones->str_to_may($row['telefonofijo']);
            $jsondata['telefonocelular'] = $Funciones->str_to_may($row['telefonocelular']);
            $jsondata['fk_carreras'] = $Funciones->str_to_may($row['fk_carreras']);
            $jsondata['fk_turnos'] = $Funciones->str_to_may($row['fk_turnos']);
            $jsondata['planEstudios'] = $Funciones->str_to_may($row['planEstudios']);
            $jsondata['fk_generacion'] = $Funciones->str_to_may($row['fk_generacion']);
            $jsondata['generacionSecre'] = $Funciones->str_to_may($row['generacionSecre']);
            $jsondata['letraPromedio'] = $Funciones->str_to_may($row['letraPromedio']);
            $jsondata['promedio'] = $Funciones->str_to_may($row['promedio']);
            $jsondata['curp'] = $Funciones->str_to_may($row['curp']);
            $jsondata['generacionNumero'] = $Funciones->str_to_may($row['generacionNumero']);
             $jsondata['fk_nivelestudio'] = $Funciones->str_to_may($row['fk_nivelestudio']);
            $jsondata['fk_modalidad'] = $Funciones->str_to_may($row['fk_modalidad']);
            
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
            $jsondata['folioInstitucional'] = $Funciones->str_to_may($row['folioInstitucional']);
            
            $jsondata['triniti'] = $Funciones->str_to_may($row['triniti']);
            $jsondata['trinitiCopia'] = $Funciones->str_to_may($row['trinitiCopia']);
            
            $jsondata['ObservacionesDoc'] = $Funciones->str_to_may($row['ObservacionesDoc']);
            
            //datos toma protesta
             $jsondata['pk_tramites'] = $Funciones->str_to_may($row['pk_tramites']);
             $jsondata['FechaTomaProtesta'] = $Funciones->str_to_may($row['FechaTomaProtesta']);
             $jsondata['horaTomaProtesta'] = $Funciones->str_to_may($row['horaTomaProtesta']);
             $jsondata['salon'] = $Funciones->str_to_may($row['salon']);
             $jsondata['fk_titulacion'] = $Funciones->str_to_may($row['fk_titulacion']);
             $jsondata['nombreTesis'] = $Funciones->str_to_may($row['nombreTesis']);
             $jsondata['Fk_Duracion'] = $Funciones->str_to_may($row['Fk_Duracion']);
             $jsondata['presidente'] = $Funciones->str_to_may($row['presidente']);
             $jsondata['secretario'] = $Funciones->str_to_may($row['secretario']);
             $jsondata['vocal'] = $Funciones->str_to_may($row['vocal']);
             $jsondata['suplente'] = $Funciones->str_to_may($row['suplente']);
             $jsondata['observacion'] = $Funciones->str_to_may($row['observacion']);
             
              $jsondata['TipoRevoe'] = $Funciones->str_to_may($row['TipoRevoe']);
               $jsondata['ExamenExtraOrdinario'] = $Funciones->str_to_may($row['ExamenExtraOrdinario']);
             
             //nuevos datos
             $jsondata['FechaSolicitud'] = $Funciones->str_to_may($row['FechaSolicitud']);
             $jsondata['noActaExamen'] = $Funciones->str_to_may($row['noActaExamen']);
             $jsondata['FechaExamen'] = $Funciones->str_to_may($row['FechaExamen']);
             $jsondata['NumeroAutorizacion'] = $Funciones->str_to_may($row['NumeroAutorizacion']);
             $jsondata['FolioActa'] = $Funciones->str_to_may($row['FolioActa']);
             
             
             
             
             
            $presidente = $row['presidente'];
            $ResultMunicipio = $Consulta->ConsultaTodosSinodales();        
            $Fila = "";
            while($RowCarreras1 = mysql_fetch_array($ResultMunicipio)){
                $Descrip = utf8_encode($RowCarreras1['nombre']);
                if($RowCarreras1["pk_sinodal"] == $presidente){                
                    $Fila .= "<option value='$RowCarreras1[pk_sinodal]' selected>$Descrip </option>";
                }else{
                    $Fila .= "<option value='$RowCarreras1[pk_sinodal]'>$Descrip</option>";
                }
            }
            $jsondata['Lista1'] = $Fila;
             
             
             
             
            
            $jsondata['error'] = "ok";
             
        mysql_free_result($Result);
    } else {
           $jsondata['error'] = "Error al Consultar";
    }
     echo json_encode($jsondata);
    exit;
}


?>
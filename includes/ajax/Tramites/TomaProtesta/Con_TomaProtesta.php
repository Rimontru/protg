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
            $jsondata['curp'] = $Funciones->str_to_may($row['curp']);
            $jsondata['nombre'] = $Funciones->str_to_may($row['nombre']);
            $jsondata['apaterno'] = $Funciones->str_to_may($row['apaterno']);
            $jsondata['amaterno'] = $Funciones->str_to_may($row['amaterno']);
            $jsondata['fk_carreras'] = $Funciones->str_to_may($row['fk_carreras']);
            $jsondata['f_inicio_car'] = $Funciones->str_to_may($row['f_inicio_car']);
            $jsondata['f_fin_car'] = $Funciones->str_to_may($row['f_fin_car']);
            $jsondata['institucionProcedencia'] = $Funciones->str_to_may($row['institucionProcedencia']);
            $jsondata['f_inicio_antecedente'] = $Funciones->str_to_may($row['f_inicio_antecedente']);
            $jsondata['f_fin_antecedente'] = $Funciones->str_to_may($row['f_fin_antecedente']);
            $jsondata['noCedula'] = $Funciones->str_to_may($row['noCedula']);
            $jsondata['entidad_federativa'] = $Funciones->str_to_may($row['entidad_federativa']);
            $jsondata['nivel_escolar'] = $Funciones->str_to_may($row['nivel_escolar']);


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
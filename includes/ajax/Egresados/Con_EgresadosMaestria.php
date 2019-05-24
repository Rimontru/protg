<?php

$Ruta = "../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisFunciones.class.php");

$Funciones = new MisFunciones();
$Consulta = new ConsultaDB;
$jsondata = array();
date_default_timezone_set('America/Mexico_City');

if (empty($_POST['pk_alumno'])) {
    $jsondata['Error'] = "Error al Consultar";
} else {
    extract($_POST);

    $Result = $Consulta->ConAlumnosporLlavePrimariaEncuestaMaestria($pk_alumno);
    $NumRow = mysql_num_rows($Result);
    if ($NumRow>=1) {
        $row = mysql_fetch_assoc($Result);
        
            $jsondata['pk_alumno'] = $row['pk_alumno'];           
            $jsondata['matricula'] = $Funciones->str_to_may($row['matricula']);
            $jsondata['nombre'] = $Funciones->str_to_may($row['nombre']);
            $jsondata['apaterno'] = $Funciones->str_to_may($row['apaterno']);
            $jsondata['amaterno'] = $Funciones->str_to_may($row['amaterno']);
            $jsondata['direccion'] = $Funciones->str_to_may($row['direccion']);
            $jsondata['codigopostal'] = $Funciones->str_to_may($row['codigopostal']);
            $jsondata['curp'] = $Funciones->str_to_may($row['curp']);
            $jsondata['correo'] = $Funciones->str_to_min($row['correo']);
          
            $jsondata['FechaNacimiento'] = $Funciones->str_to_may($row['FechaNacimiento']);
            
            
            $jsondata['fk_genero'] = $Funciones->str_to_may($row['fk_genero']);
            $jsondata['telefonofijo'] = $Funciones->str_to_may($row['telefonofijo']);
            $jsondata['telefonocelular'] = $Funciones->str_to_may($row['telefonocelular']);
            $jsondata['fk_carreras'] = $Funciones->str_to_may($row['fk_carreras']);
            $jsondata['fk_turnos'] = $Funciones->str_to_may($row['fk_turnos']);
            $jsondata['planEstudios'] = $Funciones->str_to_may($row['planEstudios']);
            $jsondata['fk_generacion'] = $Funciones->str_to_may($row['fk_generacion']);
            $jsondata['letraPromedio'] = $Funciones->str_to_may($row['letraPromedio']);
            $jsondata['promedio'] = $Funciones->str_to_may($row['promedio']);
            $jsondata['generacionNumero'] = $Funciones->str_to_may($row['generacionNumero']);
             $jsondata['fk_nivelestudio'] = $Funciones->str_to_may($row['fk_nivelestudio']);
            $jsondata['fk_modalidad'] = $Funciones->str_to_may($row['fk_modalidad']);
            
            
              //si hay datos del egresado
            $jsondata['fk_estadoTitulacion'] = $Funciones->str_to_may($row['fk_estadoTitulacion']);
            $jsondata['estatusTrabajo'] = $Funciones->str_to_may($row['estatusTrabajo']);
            $jsondata['correoTrabajo'] = ($row['correoTrabajo']);
            $jsondata['nombreJefeInmediato'] = $Funciones->str_to_may($row['nombreJefeInmediato']);
            $jsondata['mtriaNombre'] = $Funciones->str_to_may($row['mtriaNombre']);
            $jsondata['mtriaInstitucion'] = $Funciones->str_to_may($row['mtriaInstitucion']);
            $jsondata['doctoradoNombre'] = $Funciones->str_to_may($row['doctoradoNombre']);
            $jsondata['doctoradoInstitucion'] = $Funciones->str_to_may($row['doctoradoInstitucion']);
            $jsondata['especialidadNombre'] = $Funciones->str_to_may($row['especialidadNombre']);
            $jsondata['especialidadInstitucion'] = $Funciones->str_to_may($row['especialidadInstitucion']);
            $jsondata['estatusCredencial'] = $Funciones->str_to_may($row['estatusCredencial']);
            
            $jsondata['pk_egresados'] = $Funciones->str_to_may($row['pk_egresados']);
            $jsondata['noactatitulo'] = $Funciones->str_to_may($row['noactatitulo']);
            $jsondata['fechaexpediciontitulo'] = $Funciones->str_to_may($row['fechaexpediciontitulo']);
            $jsondata['quehacermejora'] = $Funciones->str_to_may($row['quehacermejora']);            
            
            $jsondata['TipoAcreditacion'] = $Funciones->str_to_may($row['TipoAcreditacion']);  
            $jsondata['fk_titulacion'] = $Funciones->str_to_may($row['fk_titulacion']);  
            $jsondata['FechaTomaProtesta'] = $Funciones->str_to_may($row['FechaTomaProtesta']);
            $jsondata['FolioActa'] = $Funciones->str_to_may($row['FolioActa']);
            
            
            //datos que faltaban de la empresa donde labora
            $jsondata['nombreEmpresaTrabajo'] = ($row['nombreEmpresaTrabajo']);
            $jsondata['puestoTrabajo'] = ($row['puestoTrabajo']);
            $jsondata['direccionTrabajo'] = ($row['direccionTrabajo']);
            $jsondata['telefonoTrabajo'] = ($row['telefonoTrabajo']);            
            $jsondata['telefonoTrabajo'] = ($row['telefonoTrabajo']);        
            
            
            //datos de la encuesta
if($row['pk_encuestamaestria']=="null" || $row['pk_encuestamaestria']=="" ){
$jsondata['pk_encuestamaestria'] = "";
}else{
            $jsondata['pk_encuestamaestria'] = $row['pk_encuestamaestria'];
	}   

            $jsondata['DA_Licenciatura'] = $Funciones->str_to_may($row['DA_Licenciatura']);
            $jsondata['DA_LicenciaturaInst'] = $Funciones->str_to_may($row['DA_LicenciaturaInst']);
            $jsondata['DA_Maestria'] = $Funciones->str_to_may($row['DA_Maestria']);
            $jsondata['DA_MaestriaInst'] = $Funciones->str_to_may($row['DA_MaestriaInst']);
            $jsondata['DA_Doctorado'] = $Funciones->str_to_may($row['DA_Doctorado']);
            $jsondata['DA_DoctoradoInst'] = $Funciones->str_to_may($row['DA_DoctoradoInst']);
            $jsondata['DA_Especialidad'] = $Funciones->str_to_may($row['DA_Especialidad']);
            $jsondata['DA_EspecialidadInst'] = $Funciones->str_to_may($row['DA_EspecialidadInst']);
            $jsondata['DL_TrabajaActualmente'] = $Funciones->str_to_may($row['DL_TrabajaActualmente']);
            $jsondata['DL_EmpresaColabora'] = $Funciones->str_to_may($row['DL_EmpresaColabora']);
            $jsondata['DL_PuestoDesempena'] = $Funciones->str_to_may($row['DL_PuestoDesempena']);
            $jsondata['DL_DireccionEmpresa'] = $Funciones->str_to_may($row['DL_DireccionEmpresa']);
            $jsondata['DL_TelefonoEmpresa'] = $Funciones->str_to_may($row['DL_TelefonoEmpresa']);
            $jsondata['DL_Mail'] = $Funciones->str_to_may($row['DL_Mail']);
            $jsondata['DL_JefeInmediato'] = $Funciones->str_to_may($row['DL_JefeInmediato']);
            $jsondata['DL_OpinionPlan'] = $Funciones->str_to_may($row['DL_OpinionPlan']);
            $jsondata['DL_CalifPlan'] = $Funciones->str_to_may($row['DL_CalifPlan']);
            $jsondata['DL_Satisfaccion'] = $Funciones->str_to_may($row['DL_Satisfaccion']);
          
            
                 //carreras
            $fk_carreras = $row['fk_carreras'];    
            $fk_modalidad = $row['fk_modalidad'];    
            $fk_nivelestudio = $row['fk_nivelestudio'];  
            $ResultCarreras = $Consulta->ConCarrerasporModalidadNivelEstudios($fk_modalidad, $fk_nivelestudio);        
            $Fila3 = "";
            while($RowCarr = mysql_fetch_array($ResultCarreras)){
                $Descrip = ($RowCarr['nombreCarrera']);
                if($RowCarr["pk_carreras"] == $fk_carreras){                
                    $Fila3 .= "<option value='$RowCarr[pk_carreras]' selected>$Descrip </option>";
                }else{
                    $Fila3 .= "<option value='$RowCarr[pk_carreras]'>$Descrip</option>";
                }
            }
            $jsondata['combo_carreras'] = $Fila3;
            //FIN carreras 
            
            
            
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
                    $Fila .= "<option value='$RowMunicipios[pk_ciudad]' selected>".  utf8_decode($Descrip)." </option>";
                }else{
                    $Fila .= "<option value='$RowMunicipios[pk_ciudad]'>".  utf8_decode($Descrip)."</option>";
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
            
            
            
         
          
            
            
            
            $jsondata['error'] = "ok";
             
        mysql_free_result($Result);
    } else {
           $jsondata['error'] = "Error al Consultar";
    }
     echo json_encode($jsondata);
    exit;
}


?>

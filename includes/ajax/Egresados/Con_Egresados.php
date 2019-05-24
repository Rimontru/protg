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

    $Result = $Consulta->ConAlumnosporLlavePrimaria($pk_alumno);
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
            
            $jsondata['f_inicio_car'] = $Funciones->str_to_may($row['f_inicio_car']); 
            $jsondata['f_fin_car'] = $Funciones->str_to_may($row['f_fin_car']); 
            $jsondata['institucionProcedencia'] = $Funciones->str_to_may($row['institucionProcedencia']); 
            $jsondata['f_inicio_antecedente'] = $Funciones->str_to_may($row['f_inicio_antecedente']); 
            $jsondata['f_fin_antecedente'] = $Funciones->str_to_may($row['f_fin_antecedente']); 
            $jsondata['noCedula'] = $Funciones->str_to_may($row['noCedula']); 
            $jsondata['entidad_federativa'] = $Funciones->str_to_may($row['entidad_federativa']); 
            $jsondata['nivel_escolar'] = $Funciones->str_to_may($row['nivel_escolar']);

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
            $jsondata['fk_estadoTitulacion'] = $row['fk_estadoTitulacion'];
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
            $jsondata['folioTimbreTitulo'] = $Funciones->str_to_may($row['folioTimbreTitulo']);
            $jsondata['fechaexpediciontitulo'] = $Funciones->str_to_may($row['fechaexpediciontitulo']);
            $jsondata['quehacermejora'] = $Funciones->str_to_may($row['quehacermejora']);            
            
            $jsondata['fk_titulacion'] = $row['fk_titulacion'];  
            $jsondata['FechaTomaProtesta'] = $Funciones->str_to_may($row['FechaTomaProtesta']);
            $jsondata['FolioActa'] = $Funciones->str_to_may($row['FolioActa']);
            $jsondata['folioTimbreActa'] = $Funciones->str_to_may($row['folioTimbreActa']);
            $jsondata['noActaExamen'] = $Funciones->str_to_may($row['noActaExamen']);
            $jsondata['TipoAcreditacion'] = $Funciones->str_to_may($row['TipoAcreditacion']); 
	       $jsondata['fk_ingresoactualegre'] = $Funciones->str_to_may($row['fk_ingresoactualegre']);
 
            $jsondata['empleoencontrar'] = $Funciones->str_to_may($row['empleoencontrar']);  
			$jsondata['plandeestudioscalificacion'] = $Funciones->str_to_may($row['plandeestudioscalificacion']);

            $jsondata['fk_gradosatisfaccionegre'] = $Funciones->str_to_may($row['fk_gradosatisfaccionegre']);            
            $jsondata['aspectodebilidad'] = $Funciones->str_to_may($row['aspectodebilidad']);
			$jsondata['sugerencias'] = $Funciones->str_to_may($row['sugerencias']);
			$jsondata['edadEgreso'] = $Funciones->str_to_may($row['edadEgreso']);
			$jsondata['Discapacidad'] = $Funciones->str_to_may($row['Discapacidad']);
			$jsondata['DiscapacidadCual'] = $Funciones->str_to_may($row['DiscapacidadCual']);
			$jsondata['fechaEntregaCredencial'] = $Funciones->str_to_may($row['fechaEntregaCredencial']);

            
            //datos que faltaban de la empresa donde labora
            $jsondata['nombreEmpresaTrabajo'] = ($row['nombreEmpresaTrabajo']);
            $jsondata['puestoTrabajo'] = ($row['puestoTrabajo']);
            $jsondata['direccionTrabajo'] = ($row['direccionTrabajo']);
            $jsondata['telefonoTrabajo'] = ($row['telefonoTrabajo']);            
            $jsondata['telefonoTrabajo'] = ($row['telefonoTrabajo']);        
                        
            //datos de la encuesta
            $jsondata['Pk_EncuestaMedicina'] = $Funciones->str_to_may($row['Pk_EncuestaMedicina']);
            $jsondata['EdadAlumno'] = $Funciones->str_to_may($row['EdadAlumno']);
            $jsondata['fk_estadocivil'] = $Funciones->str_to_may($row['fk_estadocivil']);
            $jsondata['AnoInicioLicenciatura'] = $Funciones->str_to_may($row['AnoInicioLicenciatura']);
            $jsondata['AnoFinLicenciatura'] = $Funciones->str_to_may($row['AnoFinLicenciatura']);
            $jsondata['fk_estudiosposgrado'] = $Funciones->str_to_may($row['fk_estudiosposgrado']);
            $jsondata['EstudioPosgradoMedicinaOtros'] = $Funciones->str_to_may($row['EstudioPosgradoMedicinaOtros']);
            $jsondata['fk_ramaposgrado'] = $Funciones->str_to_may($row['fk_ramaposgrado']);
            $jsondata['fk_institucioneslabora'] = $Funciones->str_to_may($row['fk_institucioneslabora']);
            $jsondata['InstitucionLaboraMedicinaOtros'] = $Funciones->str_to_may($row['InstitucionLaboraMedicinaOtros']);
            $jsondata['DireccionInstitucionLabora'] = $Funciones->str_to_may($row['DireccionInstitucionLabora']);
            $jsondata['fk_puestosmedicina'] = $Funciones->str_to_may($row['fk_puestosmedicina']);
            $jsondata['FuncionesDesempenaMedicina'] = $Funciones->str_to_may($row['FuncionesDesempenaMedicina']);
            $jsondata['fk_ingresoactual'] = $Funciones->str_to_may($row['fk_ingresoactual']);
            $jsondata['PuestoUno'] = $Funciones->str_to_may($row['PuestoUno']);
            $jsondata['InstitucionEmpresaUno'] = $Funciones->str_to_may($row['InstitucionEmpresaUno']);
            $jsondata['TiempoQueLaboroUno'] = $Funciones->str_to_may($row['TiempoQueLaboroUno']);
            $jsondata['PuestoDos'] = $Funciones->str_to_may($row['PuestoDos']);
            $jsondata['InstitucionEmpresaDos'] = $Funciones->str_to_may($row['InstitucionEmpresaDos']);
            $jsondata['TiempoQueLaboroDos'] = $Funciones->str_to_may($row['TiempoQueLaboroDos']);
            $jsondata['PuestoTres'] = $Funciones->str_to_may($row['PuestoTres']);
            $jsondata['InstitucionEmpresaTres'] = $Funciones->str_to_may($row['InstitucionEmpresaTres']);
            $jsondata['TiempoQueLaboroTres'] = $Funciones->str_to_may($row['TiempoQueLaboroTres']);
            
            $jsondata['PerteneceOrganizacionSocial'] = $Funciones->str_to_may($row['PerteneceOrganizacionSocial']);
            $jsondata['PerteneceOrganizacionSocialSi'] = $Funciones->str_to_may($row['PerteneceOrganizacionSocialSi']);
            $jsondata['CertificacionProfesional'] = $Funciones->str_to_may($row['CertificacionProfesional']);
            $jsondata['CertificacionProfesionalFecha'] = $Funciones->str_to_may($row['CertificacionProfesionalFecha']);
            $jsondata['CertificacionProfesionalOrganismo'] = $Funciones->str_to_may($row['CertificacionProfesionalOrganismo']);
            $jsondata['CapacitacionTrabajoActual'] = $Funciones->str_to_may($row['CapacitacionTrabajoActual']);
            $jsondata['GradoCienciasBasicas'] = $Funciones->str_to_may($row['GradoCienciasBasicas']);
            $jsondata['GradoCienciasClinicas'] = $Funciones->str_to_may($row['GradoCienciasClinicas']);
            $jsondata['fk_aspectodebilidad'] = $Funciones->str_to_may($row['fk_aspectodebilidad']);
            $jsondata['AspectoDebilidadOtros'] = $Funciones->str_to_may($row['AspectoDebilidadOtros']);
            $jsondata['ComentarioMejorarPerfil'] = $Funciones->str_to_may($row['ComentarioMejorarPerfil']);
            $jsondata['ComentarioMejorarPlanEstudios'] = $Funciones->str_to_may($row['ComentarioMejorarPlanEstudios']);
            $jsondata['fk_gradosatisfaccion'] = $Funciones->str_to_may($row['fk_gradosatisfaccion']);
            $jsondata['ElegirMismaInstitucion'] = $Funciones->str_to_may($row['ElegirMismaInstitucion']);
            $jsondata['estadocivil'] = $row['fk_estadocivil_egresados'];
            $jsondata['noCedulaProf'] = $row['noCedulaProf'];
            $jsondata['derechoPromedio'] = $row['derechoPromedio'];
            $jsondata['nuevaUno'] = $row['nuevaUno'];
            $jsondata['nuevaDos'] = $row['nuevaDos'];
            $jsondata['porqueUno'] = $row['porqueUno'];
            $jsondata['porqueDos'] = $row['porqueDos'];
            
            //fin datos encuesta
            
            
            //obtener la edad del alumno            
            $fecha_nacimiento=$row['FechaNacimiento'];

             $fechaSQL = explode("-",date("Y-m-d"));
            $fecha_control=$fechaSQL[2]."/".$fechaSQL[1]."/".$fechaSQL[0];


            $tiempo=$Funciones->tiempo_transcurrido($fecha_nacimiento, $fecha_control);
//            $texto = "$tiempo[0] años con $tiempo[1] meses y $tiempo[2] días";
            $texto = "$tiempo[0] años";

            $jsondata['EdadAlumno'] = $texto;    

            
            
   
             $jsondata['fk_modalidad'] = $Funciones->str_to_may($row['fk_modalidad']);
            $jsondata['fk_nivelestudio'] = $Funciones->str_to_may($row['fk_nivelestudio']);            
           //comprobamos si tiene foto
            $nombre_fichero = '../../../profile-photos/'.$row['matricula'];

            if (file_exists($nombre_fichero)) {
//                echo "El fichero $nombre_fichero existe";
                $RutaImagen='<img width="200" height="220" src="profile-photos/'.$row['matricula'].'/'.$row['matricula'].'.jpg">';
            } else {
//                echo "El fichero $nombre_fichero no existe";
                $RutaImagen='<img width="200" height="220" src="profile-photos/default-user.png">';
            }

            //creamos el div para la foto del perfil
            $x=' <center> 
                            '.$RutaImagen.'                                                             
                             <br><br>
                       
                </center>
                 <br>';
             $jsondata['RutaFotoPerfil'] = $x; 
	     
	     $jsondata['urlfoto'] ='<center> '.$RutaImagen.' </center>';
 
            
            
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

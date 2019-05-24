<?php
//Este Archivo contiene todas las consultas que usaremos en el sistema web del Guero
//Fecha: 24/Enero/2013 17:03 pm
require('InsertarDB.class.php');
#require("ModificacionM.class.php");

//class ModificacionDB extends ModificacionM {
class ModificacionDB extends InsertarDB {
    //constructor
    function ModificacionDB($IdUsuario, $Ip, $CatOMod, $Registro) {
        $this->IdUsuario = $IdUsuario;
        $this->Ip = $Ip;
        $this->CatOMdo = $CatOMod;
        $this->Registro = $Registro;
    }




    function ModDatosInstitucion($m_coloniafracc, $m_nombre, $m_apodoInstitucion, $m_clave, $m_direccion, $m_telefono, $m_fechaincorporacion, $m_nooficio, $m_registro, $m_regimen, $m_paginaweb, $m_lema, $pk_escuela) {
        $dbPeon = new database;
        if ($dbPeon->conectar() == true) {
            $query = "UPDATE tbl_escuela SET fk_colonia = '$m_coloniafracc', nombreInstitucion='$m_nombre', apodoInstitucion='$m_apodoInstitucion', clave='$m_clave', direccion='$m_direccion', telefono='$m_telefono', fechaIncorporacionSrecetaria='$m_fechaincorporacion', noOficio='$m_nooficio', registro='$m_registro', regimen='$m_regimen', paginaInternet='$m_paginaweb', lemaEscuela='$m_lema' WHERE pk_dtgenerales ='$pk_escuela'";

            $result = @mysql_query($query) or die(mysql_error());
            if (!$result) {
                return false;
            } else {
                if ($this->InsHistorialAcceso($this->IdUsuario, $this->Ip, $this->CatOMdo, $this->Registro))
                    return true;
                else
                    return false;
            }
        }
    }





    function ModDatosSinodales($v_nombre, $v_cedula, $fk_nivelestudio, $numEmpleado, $cel, $nss, $direccion, $curp, $rfc, $foto, $pk_sinodal, $pk_carreras_anterior, $pk_carreras) {
        $dbPeon = new database;
        if ($dbPeon->conectar() == true) {
            $query = "
  UPDATE tbl_profesores
  JOIN rel_profesorcarrera
  ON tbl_profesores.pk_sinodal=rel_profesorcarrera.fk_sinodal

SET nombre = '$v_nombre', cedula='$v_cedula', fk_nivelestudio='$fk_nivelestudio', numEmpleado='$numEmpleado',
cel='$cel', nss='$nss', direccion='$direccion', curp='$curp', rfc='$rfc', foto='$foto', rel_profesorcarrera.fk_carreras='$pk_carreras'

WHERE pk_sinodal ='$pk_sinodal' AND fk_carreras='$pk_carreras_anterior'";

            $result = @mysql_query($query) or die(mysql_error());
            if (!$result) {
                return false;
            } else {
                if ($this->InsHistorialAcceso($this->IdUsuario, $this->Ip, $this->CatOMdo, $this->Registro))
                    return true;
                else
                    return false;
            }
        }
    }


    function ModDatosGeneraciones($Descripcion, $m_fk_iniciomes, $m_fk_inicioanios, $m_fk_finmeses, $m_fk_finanios, $pk_generacion) {
        $dbPeon = new database;
        if ($dbPeon->conectar() == true) {
            $query = "UPDATE cat_generacion SET descripcion = '$Descripcion', fk_iniciomes='$m_fk_iniciomes', fk_inicioanios='$m_fk_inicioanios', fk_finmeses='$m_fk_finmeses', fk_finanios='$m_fk_finanios' WHERE pk_generacion ='$pk_generacion'";

            $result = @mysql_query($query) or die(mysql_error());
            if (!$result) {
                return false;
            } else {
                if ($this->InsHistorialAcceso($this->IdUsuario, $this->Ip, $this->CatOMdo, $this->Registro))
                    return true;
                else
                    return false;
            }
        }
    }





    function ModificarCarrera($idCarrera, $plantel, $clvCarrera, $nomCarrera, $revoe, $fechaExp, $modalidad, $nomTitulo, $academico,$edificio)
    {
        $dbPeon = new database();
        if ($dbPeon->conectar() == true) {
            $query = "UPDATE tbl_carreras SET fk_dtgenerales='$plantel',fk_modalidad='$modalidad',fk_nivelestudio='$academico',clvCarrera='$clvCarrera',nombreCarrera='$nomCarrera',noacuerdo='$revoe',fechaExpedicion='$fechaExp',nombreTitulo='$nomTitulo',edificio='$edificio' WHERE pk_carreras='$idCarrera'";

            $result = @mysql_query($query) or die(mysql_error());
            if (!$result) {
                return false;
            } else {
                if ($this->InsHistorialAcceso($this->IdUsuario, $this->Ip, $this->CatOMdo, $this->Registro))
                    return true;
                else
                    return false;
            }
        }

    }



       function ModificarDatosAlumnos($nombre, $apaterno, $amaterno, $direccion, $curp, $correo, $fk_genero, $telefonofijo, $telefonocelular, $v_coloniafracc, $codigopostal, $fk_carreras,  $fk_nivelestudio, $fk_modalidad, $fk_turnos, $planEstudios, $fk_generacion, $letraPromedio, $promedio, $generacionNumero, $FechaNacimientoLista, $matricula_desc, $pk_alumno, $f_inicio_car, $f_fin_car, $institucionProcedencia, $f_inicio_antecedente, $f_fin_antecedente, $noCedula, $entidad_federativa, $nivel_escolar)
    {
        $dbPeon = new database();
        if ($dbPeon->conectar() == true) {
            $query = "UPDATE tbl_alumnos SET nombre='$nombre', apaterno='$apaterno', amaterno='$amaterno', direccion='$direccion', curp='$curp', correo='$correo', fk_genero='$fk_genero', telefonofijo='$telefonofijo', telefonocelular='$telefonocelular', fk_colonia='$v_coloniafracc', codigopostal='$codigopostal', fk_carreras='$fk_carreras',  fk_nivelestudio='$fk_nivelestudio', fk_modalidad='$fk_modalidad', fk_turnos='$fk_turnos', planEstudios='$planEstudios', fk_generacion='$fk_generacion', letraPromedio='$letraPromedio', promedio='$promedio', generacionNumero='$generacionNumero', FechaNacimiento='$FechaNacimientoLista', matricula='$matricula_desc', f_inicio_car='$f_inicio_car', f_fin_car='$f_fin_car', institucionProcedencia='$institucionProcedencia', f_inicio_antecedente='$f_inicio_antecedente', f_fin_antecedente='$f_fin_antecedente', noCedula='$noCedula', entidad_federativa='$entidad_federativa', nivel_escolar='$nivel_escolar' WHERE pk_alumno='$pk_alumno'";

            $result = @mysql_query($query) or die(mysql_error());
            if (!$result) {
                return false;
            } else {
                if ($this->InsHistorialAcceso($this->IdUsuario, $this->Ip, $this->CatOMdo, $this->Registro))
                    return true;
                else
                    return false;
            }
        }

    }





          function ModificarDatosAlumnosEncuestaMedicina($nombre, $apaterno, $amaterno, $direccion,  $correo, $fk_genero, $telefonofijo, $telefonocelular, $v_coloniafracc, $codigopostal, $FechaNacimiento, $pk_alumno )
    {
        $dbPeon = new database();
        if ($dbPeon->conectar() == true) {
            $query = "UPDATE tbl_alumnos SET nombre='$nombre', apaterno='$apaterno', amaterno='$amaterno', direccion='$direccion', correo='$correo', fk_genero='$fk_genero', telefonofijo='$telefonofijo', telefonocelular='$telefonocelular', fk_colonia='$v_coloniafracc', codigopostal='$codigopostal', FechaNacimiento='$FechaNacimiento' WHERE pk_alumno='$pk_alumno'";

            $result = @mysql_query($query) or die(mysql_error());
            if (!$result) {
                return false;
            } else {
                if ($this->InsHistorialAcceso($this->IdUsuario, $this->Ip, $this->CatOMdo, $this->Registro))
                    return true;
                else
                    return false;
            }
        }

    }


          function ModificarDatosAlumnosSecretariaEducacion($curp, $generacionSecre, $planEstudios, $promedio, $letraPromedio, $pk_alumno)
    {
        $dbPeon = new database();
        if ($dbPeon->conectar() == true) {
            $query = "UPDATE tbl_alumnos SET curp='$curp', generacionSecre='$generacionSecre', planEstudios='$planEstudios', promedio='$promedio', letraPromedio='$letraPromedio' WHERE pk_alumno='$pk_alumno'";

            $result = @mysql_query($query) or die(mysql_error());
            if (!$result) {
                return false;
            } else {
                if ($this->InsHistorialAcceso($this->IdUsuario, $this->Ip, $this->CatOMdo, $this->Registro))
                    return true;
                else
                    return false;
            }
        }

    }



 function ModificarDatosEgresados($fk_estadoTitulacion, $estatusTrabajo, $correoTrabajo, $nombreJefeInmediato, $mtriaNombre, $mtriaInstitucion, $doctoradoNombre, $doctoradoInstitucion, $especialidadNombre, $especialidadInstitucion, $estatusCredencial, $fechaexpediciontituloLista, $noactatitulo, $quehacermejora, $nombreEmpresaTrabajo, $puestoTrabajo, $direccionTrabajo, $telefonoTrabajo, $noActaExamen, $TipoAcreditacion,$fk_ingresoactual,$empleoencontrar,$plandeestudioscalificacion,$fk_gradosatisfaccion,$aspectodebilidad,$sugerencias,$edadEgreso,$Discapacidad,$DiscapacidadCual,$fechaEntregaCredencialLista,$pk_alumno,$fk_estcivil,$folioTimbreTitulo,$noCedulaProf,$derechoPromedio,$nuevaUno,$nuevaDos,$porqueUno,$porqueDos)
    {
        $dbPeon = new database();
        if ($dbPeon->conectar() == true) {
            $query = "UPDATE tbl_egresados SET fk_estadoTitulacion='$fk_estadoTitulacion', estatusTrabajo='$estatusTrabajo', correoTrabajo='$correoTrabajo', nombreJefeInmediato='$nombreJefeInmediato', mtriaNombre='$mtriaNombre', mtriaInstitucion='$mtriaInstitucion', doctoradoNombre='$doctoradoNombre', doctoradoInstitucion='$doctoradoInstitucion', especialidadNombre='$especialidadNombre', especialidadInstitucion='$especialidadInstitucion', estatusCredencial='$estatusCredencial', fechaexpediciontitulo='$fechaexpediciontituloLista', noactatitulo='$noactatitulo', folioTimbreTitulo='$folioTimbreTitulo' ,quehacermejora='$quehacermejora', nombreEmpresaTrabajo='$nombreEmpresaTrabajo', puestoTrabajo='$puestoTrabajo', direccionTrabajo='$direccionTrabajo', telefonoTrabajo='$telefonoTrabajo', noActaExamen='$noActaExamen', TipoAcreditacion='$TipoAcreditacion', fk_ingresoactual='$fk_ingresoactual', empleoencontrar='$empleoencontrar',plandeestudioscalificacion='$plandeestudioscalificacion', fk_gradosatisfaccion='$fk_gradosatisfaccion',aspectodebilidad='$aspectodebilidad',sugerencias='$sugerencias',edadEgreso='$edadEgreso',Discapacidad='$Discapacidad',DiscapacidadCual='$DiscapacidadCual',fechaEntregaCredencial='$fechaEntregaCredencialLista',fk_estadocivil_egresados='$fk_estcivil',noCedulaProf='$noCedulaProf',derechoPromedio='$derechoPromedio',nuevaUno='$nuevaUno',nuevaDos='$nuevaDos',porqueUno='$porqueUno',porqueDos='$porqueDos'  WHERE fk_alumnos='$pk_alumno'";

            $result = @mysql_query($query) or die(mysql_error());
            if (!$result) {
                return false;
            } else {
                if ($this->InsHistorialAcceso($this->IdUsuario, $this->Ip, $this->CatOMdo, $this->Registro))
                    return true;
                else
                    return false;
            }
        }

    }




    function ModificarDatosEgresadosEncuestaMedicina($pk_alumno, $EdadAlumno, $fk_estadocivil, $AnoInicioLicenciatura, $AnoFinLicenciatura, $fk_estudiosposgrado, $EstudioPosgradoMedicinaOtros, $fk_ramaposgrado, $fk_institucioneslabora, $InstitucionLaboraMedicinaOtros, $DireccionInstitucionLabora, $fk_puestosmedicina, $FuncionesDesempenaMedicina, $fk_ingresoactual, $PuestoUno, $InstitucionEmpresaUno, $TiempoQueLaboroUno, $PuestoDos, $InstitucionEmpresaDos, $TiempoQueLaboroDos, $PuestoTres, $InstitucionEmpresaTres, $TiempoQueLaboroTres, $PerteneceOrganizacionSocial, $PerteneceOrganizacionSocialSi, $CertificacionProfesional, $CertificacionProfesionalFecha, $CertificacionProfesionalOrganismo, $CapacitacionTrabajoActual, $GradoCienciasBasicas, $GradoCienciasClinicas, $fk_aspectodebilidad, $AspectoDebilidadOtros, $ComentarioMejorarPerfil, $ComentarioMejorarPlanEstudios, $fk_gradosatisfaccion, $ElegirMismaInstitucion)
    {
        $dbPeon = new database();
        if ($dbPeon->conectar() == true) {
            $query = "UPDATE tbl_encuestamedicina SET EdadAlumno='$EdadAlumno', fk_estadocivil='$fk_estadocivil', AnoInicioLicenciatura='$AnoInicioLicenciatura', AnoFinLicenciatura='$AnoFinLicenciatura', fk_estudiosposgrado='$fk_estudiosposgrado', EstudioPosgradoMedicinaOtros='$EstudioPosgradoMedicinaOtros', fk_ramaposgrado='$fk_ramaposgrado', fk_institucioneslabora='$fk_institucioneslabora', InstitucionLaboraMedicinaOtros='$InstitucionLaboraMedicinaOtros', DireccionInstitucionLabora='$DireccionInstitucionLabora', fk_puestosmedicina='$fk_puestosmedicina', FuncionesDesempenaMedicina='$FuncionesDesempenaMedicina', fk_ingresoactual='$fk_ingresoactual', PuestoUno='$PuestoUno', InstitucionEmpresaUno='$InstitucionEmpresaUno', TiempoQueLaboroUno='$TiempoQueLaboroUno', PuestoDos='$PuestoDos', InstitucionEmpresaDos='$InstitucionEmpresaDos', TiempoQueLaboroDos='$TiempoQueLaboroDos', PuestoTres='$PuestoTres', InstitucionEmpresaTres='$InstitucionEmpresaTres', TiempoQueLaboroTres='$TiempoQueLaboroTres', PerteneceOrganizacionSocial='$PerteneceOrganizacionSocial', PerteneceOrganizacionSocialSi='$PerteneceOrganizacionSocialSi', CertificacionProfesional='$CertificacionProfesional', CertificacionProfesionalFecha='$CertificacionProfesionalFecha', CertificacionProfesionalOrganismo='$CertificacionProfesionalOrganismo', CapacitacionTrabajoActual='$CapacitacionTrabajoActual', GradoCienciasBasicas='$GradoCienciasBasicas', GradoCienciasClinicas='$GradoCienciasClinicas', fk_aspectodebilidad='$fk_aspectodebilidad', AspectoDebilidadOtros='$AspectoDebilidadOtros', ComentarioMejorarPerfil='$ComentarioMejorarPerfil', ComentarioMejorarPlanEstudios='$ComentarioMejorarPlanEstudios', fk_gradosatisfaccion='$fk_gradosatisfaccion', ElegirMismaInstitucion='$ElegirMismaInstitucion' WHERE fk_alumno='$pk_alumno'";

            $result = @mysql_query($query) or die(mysql_error());
            if (!$result) {
                return false;
            } else {
                if ($this->InsHistorialAcceso($this->IdUsuario, $this->Ip, $this->CatOMdo, $this->Registro))
                    return true;
                else
                    return false;
            }
        }

    }


       function ModificarDatosExamenInstitucional($Pk_ExamenInstitucional, $fechaaplicacion, $hora, $ActaOriginal, $ActaCopia, $cbOriginal, $cbCopia, $clicOriginal, $clicCopia, $curpOriginal, $curpCopia, $consservicioOriginal, $consservicioCopia, $reciboOriginal, $reciboCopia, $recibofolio, $triniti, $trinitiCopia, $ObservacionesDoc)
    {
        $dbPeon = new database();
        if ($dbPeon->conectar() == true) {
            $query = "UPDATE tbl_exainstitucional SET fechaaplicacion='$fechaaplicacion', hora='$hora', ActaOriginal='$ActaOriginal', ActaCopia='$ActaCopia', cbOriginal='$cbOriginal', cbCopia='$cbCopia', clicOriginal='$clicOriginal', clicCopia='$clicCopia', curpOriginal='$curpOriginal', curpCopia='$curpCopia', consservicioOriginal='$consservicioOriginal', consservicioCopia='$consservicioCopia', reciboOriginal='$reciboOriginal', reciboCopia='$reciboCopia', recibofolio='$recibofolio', triniti='$triniti', trinitiCopia='$trinitiCopia', ObservacionesDoc='$ObservacionesDoc' WHERE Pk_ExamenInstitucional='$Pk_ExamenInstitucional'";

            $result = @mysql_query($query) or die(mysql_error());
            if (!$result) {
                return false;
            } else {
                if ($this->InsHistorialAcceso($this->IdUsuario, $this->Ip, $this->CatOMdo, $this->Registro))
                    return true;
                else
                    return false;
            }
        }

    }



         function ModificarDatosTomaProtesta($pk_tramites, $FechaTomaProtestaLista, $hora, $salon, $fk_titulacion, $nombreTesis, $Fk_Duracion, $presidente, $secretario, $vocal, $suplente, $observacion, $FechaSolicitudLista, $FechaExamenLista, $NumeroAutorizacion, $FolioActa, $TipoRevoe, $ExamenExtraOrdinario)
    {
        $dbPeon = new database();
        if ($dbPeon->conectar() == true) {
            $query = "UPDATE tbl_tomadeprotesta SET FechaTomaProtesta='$FechaTomaProtestaLista', hora='$hora', salon='$salon', fk_titulacion='$fk_titulacion', nombreTesis='$nombreTesis', Fk_Duracion='$Fk_Duracion', presidente='$presidente', secretario='$secretario', vocal='$vocal', suplente='$suplente', observacion='$observacion', FechaSolicitud='$FechaSolicitudLista', FechaExamen='$FechaExamenLista', NumeroAutorizacion='$NumeroAutorizacion', FolioActa='$FolioActa', TipoRevoe='$TipoRevoe', ExamenExtraOrdinario='$ExamenExtraOrdinario' WHERE pk_tramites='$pk_tramites'";

            $result = @mysql_query($query) or die(mysql_error());
            if (!$result) {
                return false;
            } else {
                if ($this->InsHistorialAcceso($this->IdUsuario, $this->Ip, $this->CatOMdo, $this->Registro))
                    return true;
                else
                    return false;
            }
        }

    }



         function ModificarDatosTomaProtestaModuloNormalBueno($pk_tramites, $FechaTomaProtestaLista, $hora, $salon, $fk_titulacion, $nombreTesis, $Fk_Duracion, $presidente, $secretario, $vocal, $suplente, $observacion)
    {
        $dbPeon = new database();
        if ($dbPeon->conectar() == true) {
            $query = "UPDATE tbl_tomadeprotesta SET FechaTomaProtesta='$FechaTomaProtestaLista', hora='$hora', salon='$salon', fk_titulacion='$fk_titulacion', nombreTesis='$nombreTesis', Fk_Duracion='$Fk_Duracion', presidente='$presidente', secretario='$secretario', vocal='$vocal', suplente='$suplente', observacion='$observacion' WHERE pk_tramites='$pk_tramites'";

            $result = @mysql_query($query) or die(mysql_error());
            if (!$result) {
                return false;
            } else {
                if ($this->InsHistorialAcceso($this->IdUsuario, $this->Ip, $this->CatOMdo, $this->Registro))
                    return true;
                else
                    return false;
            }
        }

    }


    function ModificarDatosTomaProtestaEGRESADOS($pk_alumno, $FechaTomaProtesta, $fk_titulacion, $folioTimbreActa)
    {
        $dbPeon = new database();
        if ($dbPeon->conectar() == true) {
            $query = "UPDATE tbl_tomadeprotesta SET FechaTomaProtesta='$FechaTomaProtesta', fk_titulacion='$fk_titulacion', folioTimbreActa= '$folioTimbreActa'  WHERE fk_alumno='$pk_alumno'";

            $result = @mysql_query($query) or die(mysql_error());
            if (!$result) {
                return false;
            } else {
                if ($this->InsHistorialAcceso($this->IdUsuario, $this->Ip, $this->CatOMdo, $this->Registro))
                    return true;
                else
                    return false;
            }
        }

    }

	function ModificarDatosAlumnosEgresadosToma($pk_alumno,$noActaExamen)
    {
        $dbPeon = new database();
        if ($dbPeon->conectar() == true) {
            $query = "UPDATE tbl_egresados SET noActaExamen='$noActaExamen' WHERE fk_alumnos='$pk_alumno'";

            $result = @mysql_query($query) or die(mysql_error());
            if (!$result) {
                return false;
            } else {
                if ($this->InsHistorialAcceso($this->IdUsuario, $this->Ip, $this->CatOMdo, $this->Registro))
                    return true;
                else
                    return false;
            }
        }

    }





    #AGREGADO: Ivan Mauricio Meneses Melo Granados
#FECHA: 30/01/13 15:43 pm
#MODULO AFECTADO: includes/ajax/Sistema/Usuario/Mod_Usuario.php
#DESCRIPCION: Inserta un nuevo Registro en la Tabla Cat_Zona
# @params        $Zona
# @return        True o False en funcion de la consulta

    function ModUsuarios($Usuario, $Status_User, $Pk_Usuario_Login,$changePass) {
        $dbPeon = new database;
        if ($dbPeon->conectar() == true) {
            $query = "UPDATE tbl_usuario_login SET Usuario='$Usuario', activo_usuario='$Status_User' $changePass WHERE Pk_Usuario_Login='$Pk_Usuario_Login'";
            $result = @mysql_query($query) or die(mysql_error());
            if (!$result) {
                return false;
            } else {
                if ($this->InsHistorialAcceso($this->IdUsuario, $this->Ip, $this->CatOMdo, $this->Registro))
                    return true;
                else
                    return false;
            }
        }
    }



        #AGREGADO: Ivan Mauricio Meneses Melo Granados
#FECHA: 27/Mayo/2013
#MODULO AFECTADO: includes/ajax/Sistema/Usuario/Mod_Usuario.php,
#DESCRIPCION: Eliminamos todos los permisos en Rel_Login_Permisos
# @params        $UsuarioLogin_Id
# @return        True o False en funcion de la consulta
function Eli_Relacion_Usuarios($idUsuario){
	$dbGuero = new database;
	if($dbGuero->conectar()==true){
		$query = "DELETE FROM rel_login_permisos WHERE Fk_Usuario_Login='$idUsuario'";
		 $result = @mysql_query($query) or die (mysql_error());
		 if (!$result){
		   return false;
		 }else{
				return $result;
			}
	 	}
	}



  function ModificarDatosEgresadosEncuestaMaestria($pk_alumno, $DA_Licenciatura, $DA_LicenciaturaInst, $DA_Maestria, $DA_MaestriaInst, $DA_Doctorado, $DA_DoctoradoInst, $DA_Especialidad, $DA_EspecialidadInst, $DL_TrabajaActualmente, $DL_EmpresaColabora, $DL_PuestoDesempena, $DL_DireccionEmpresa, $DL_TelefonoEmpresa, $DL_Mail, $DL_JefeInmediato, $DL_OpinionPlan, $DL_CalifPlan, $DL_Satisfaccion)
    {
        $dbPeon = new database();
        if ($dbPeon->conectar() == true) {
            $query = "UPDATE tbl_encuestamaestria SET DA_Licenciatura='$DA_Licenciatura', DA_LicenciaturaInst='$DA_LicenciaturaInst', DA_Maestria='$DA_Maestria', DA_MaestriaInst='$DA_MaestriaInst', DA_Doctorado='$DA_Doctorado', DA_DoctoradoInst='$DA_DoctoradoInst', DA_Especialidad='$DA_Especialidad', DA_EspecialidadInst='$DA_EspecialidadInst', DL_TrabajaActualmente='$DL_TrabajaActualmente', DL_EmpresaColabora='$DL_EmpresaColabora', DL_PuestoDesempena='$DL_PuestoDesempena', DL_DireccionEmpresa='$DL_DireccionEmpresa', DL_TelefonoEmpresa='$DL_TelefonoEmpresa', DL_Mail='$DL_Mail', DL_JefeInmediato='$DL_JefeInmediato', DL_OpinionPlan='$DL_OpinionPlan', DL_CalifPlan='$DL_CalifPlan', DL_Satisfaccion='$DL_Satisfaccion' WHERE fk_alumno='$pk_alumno'";

            $result = @mysql_query($query) or die(mysql_error());
            if (!$result) {
                return false;
            } else {
                if ($this->InsHistorialAcceso($this->IdUsuario, $this->Ip, $this->CatOMdo, $this->Registro))
                    return true;
                else
                    return false;
            }
        }

    }




    function ModificarDatosEgresadosEncuestaDoctorado($pk_alumno, $DA_Licenciatura, $DA_LicenciaturaInst, $DA_Maestria, $DA_MaestriaInst, $DA_Doctorado, $DA_DoctoradoInst, $DA_Especialidad, $DA_EspecialidadInst, $DL_TrabajaActualmente, $DL_EmpresaColabora, $DL_PuestoDesempena, $DL_DireccionEmpresa, $DL_TelefonoEmpresa, $DL_Mail, $DL_JefeInmediato, $DL_OpinionPlan, $DL_CalifPlan, $DL_Satisfaccion)
    {
        $dbPeon = new database();
        if ($dbPeon->conectar() == true) {
            $query = "UPDATE tbl_encuestadoctorado SET DA_Licenciatura='$DA_Licenciatura', DA_LicenciaturaInst='$DA_LicenciaturaInst', DA_Maestria='$DA_Maestria', DA_MaestriaInst='$DA_MaestriaInst', DA_Doctorado='$DA_Doctorado', DA_DoctoradoInst='$DA_DoctoradoInst', DA_Especialidad='$DA_Especialidad', DA_EspecialidadInst='$DA_EspecialidadInst', DL_TrabajaActualmente='$DL_TrabajaActualmente', DL_EmpresaColabora='$DL_EmpresaColabora', DL_PuestoDesempena='$DL_PuestoDesempena', DL_DireccionEmpresa='$DL_DireccionEmpresa', DL_TelefonoEmpresa='$DL_TelefonoEmpresa', DL_Mail='$DL_Mail', DL_JefeInmediato='$DL_JefeInmediato', DL_OpinionPlan='$DL_OpinionPlan', DL_CalifPlan='$DL_CalifPlan', DL_Satisfaccion='$DL_Satisfaccion' WHERE fk_alumno='$pk_alumno'";

            $result = @mysql_query($query) or die(mysql_error());
            if (!$result) {
                return false;
            } else {
                if ($this->InsHistorialAcceso($this->IdUsuario, $this->Ip, $this->CatOMdo, $this->Registro))
                    return true;
                else
                    return false;
            }
        }

    }


    function updateEmpleador($pk_empleador, $fechaSolicitud, $empresa, $nomSolicitante, $puestoSolicitante, $licenciatura, $puestoVacante, $numVacantes, $telefono,$email,$direccion,$sexo){
        $dbPeon = new database();
        if ($dbPeon->conectar() == true) {
            $query = "UPDATE tbl_empleadores SET fechaSolicitud='$fechaSolicitud', empresa='$empresa', nombreSolicitante='$nomSolicitante', puetoSolicitante='$puestoSolicitante', licenciatura='$licenciatura', puestoVacante='$puestoVacante', numVacantes='$numVacantes', telefono='$telefono', email='$email', direccion='$direccion', sexo='$sexo' WHERE pk_empleador='$pk_empleador'";
            $result = @mysql_query($query) or die(mysql_error());
            if (!$result) {
                return false;
            } else {
                if ($this->InsHistorialAcceso($this->IdUsuario, $this->Ip, $this->CatOMdo, $this->Registro))
                    return true;
                else
                    return false;
            }
        }
    }


    function CerrarSesion($id){
        $db = new database();
        if($db->conectar() == true){
            $sql = "UPDATE tbl_usuario_login SET Usuario_Online='0' WHERE Pk_Usuario_Login='$id'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                if($this->InsHistorialAcceso($this->IdUsuario, $this->Ip, $this->CatOMdo, $this->Registro))
                    return true;
                else
                    return false;
            }
        }
    }


    function ModPreparatorias($pk_prepa, $nomb_prepa, $plantel, $turno, $ciudad, $direccion, $email, $telefonos, $persona_atiende, $cargo_persona)
    {
        $dbPeon = new database();
        if ($dbPeon->conectar() == true) {
            $query = "UPDATE cat_directorio_preparatorias
            SET
             nomb_prepa = '$nomb_prepa',
             plantel = '$plantel',
             turno = '$turno',
             ciudad = '$ciudad',
             direccion = '$direccion',
             email = '$email',
             telefonos = '$telefonos',
             persona_atiende = '$persona_atiende',
             cargo_persona = '$cargo_persona'
            WHERE pk_prepa ='$pk_prepa'
            ";
            $result = @mysql_query($query) or die(mysql_error());
                if (!$result) {
                    return false;
                }
                else{
                    return true;
                }
        }

    }

     function ModCurpInTomaProtestaDos( $pk_alumno, $curp, $f_inicio_car, $f_fin_car, $institucionProcedencia, $f_inicio_antecedente, $f_fin_antecedente, $noCedula, $entidad_federativa, $nivel_escolar) {
        $dbPeon = new database();
        if ($dbPeon->conectar() == true) {
            $query = "UPDATE tbl_alumnos
            SET
            curp = '$curp',
            f_inicio_car = '$f_inicio_car',
            f_fin_car = '$f_fin_car',
            institucionProcedencia = '$institucionProcedencia',
            f_inicio_antecedente = '$f_inicio_antecedente',
            f_fin_antecedente = '$f_fin_antecedente',
            noCedula = '$noCedula',
            entidad_federativa = $entidad_federativa,
            nivel_escolar = $nivel_escolar
            WHERE pk_alumno = $pk_alumno
            ";
            $result = @mysql_query($query) or die(mysql_error());
                if (!$result) {
                    return false;
                }
                else{
                    return true;
                }
        }
    }

}
/*
#mis funciones para ponerle un folio de concurso al peludo
    function ModificarFolioConcursoEgresados($pk_alumno, $folioconcurso)
    {
        $dbPeon = new database();
        if ($dbPeon->conectar() == true) {
            $query = "UPDATE tbl_egresados SET fol_rifa='$folioconcurso' WHERE fk_alumnos='$pk_alumno' AND fol_rifa=0";
            $result = @mysql_query($query) or die(mysql_error());
				if (!$result) {
					return false;
				}
				else{
					return true;
				}
        }

    }

	function ValidaFolioExistenteEgresado($pk_alumno){
		$dbPeon = new database();
        if ($dbPeon->conectar() == true) {
            $query = "SELECT fol_rifa FROM tbl_egresados WHERE fk_alumnos='$pk_alumno'";
            $result = @mysql_query($query) or die(mysql_error());
			if(!$result || empty($result)){
				return 0;
			}else{
				$row = @mysql_fetch_assoc($result);
				if ($row['fol_rifa']!=0 ){
					return 0; #por que ya ay un registro pos no lo dejamoz actualizar
				}
				else{
					return 1;
				}

			}
        }
	}
*/


?>

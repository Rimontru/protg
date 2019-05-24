<?php

//Este Archivo contiene todas los INSERT que usaremos en el sistema
require('DB.class.php');

class InsertarDB {
    /* Atributos publicos */

    public $IdUsuario = "";
    public $Ip = "";
    public $Registro = "";
    public $CatOMod = "";

    //constructor
    function InsertarDB($IdUsuario, $Ip, $CatOMod, $Registro) {

        $this->IdUsuario = $IdUsuario;
        $this->Ip = $Ip;
        $this->CatOMdo = $CatOMod;
        $this->Registro = $Registro;
    }

    function InsHistorialAcceso($IdUsuario, $IP, $CatOMod, $Registro) {
        $dbGuero = new database;
        if ($dbGuero->conectar() == true) {
            $query = "INSERT INTO tbl_historial_acceso  VALUES ('', '$IdUsuario', CURDATE(), CURTIME(), '$IP', '$CatOMod', '$Registro')";
            $result = @mysql_query($query) or die(mysql_error());
            if (!$result)
                return false;
            else
                return true;
        }
    }

    #AGREGADO: Ivan Mauricio Meneses Melo Granados
    #FECHA: 30/01/13 10:53 pm
    #MODULO AFECTADO: includes/ajax/Sistema/Usuario/Ins_Usuario.php
    #DESCRIPCION: Inserta un nuevo Registro en la Tabla Tbl_Usuario_Login
    # @params        $Zona
    # @return        True o False en funcion de la consulta
    function InsUsuarios($pk_trabajador, $NombreUsuario, $Password, $Tipo_User){
            $dbPeon = new database;
       if($dbPeon->conectar()==true){
            $query = "INSERT INTO tbl_usuario_login VALUES ('NULL', '$pk_trabajador', '$NombreUsuario', '$Password', '$Tipo_User', '0','1')";
            $result = @mysql_query($query);
            $Pk_Usuario_Login = mysql_insert_id();
            if (!$result) {
                return false;
            } else {
                if ($this->InsHistorialAcceso($this->IdUsuario, $this->Ip, $this->CatOMdo, $this->Registro))
                    return $Pk_Usuario_Login;
                else
                    return false;
            }
       }
     }

     #AGREGADO: Ivan Mauricio Meneses Melo Granados
    #FECHA: 30/01/13 10:53 pm
    #MODULO AFECTADO: includes/ajax/Sistema/Usuario/Ins_Usuario.php
    #DESCRIPCION: Inserta un nuevo Registro en la Tabla Tbl_Usuario_Login
    # @params        $Zona
    # @return        True o False en funcion de la consulta
    function InsRel_Login_Permisos($Fk_Usuario_Login,$Fk_CatMenu, $FkTituloMenu){
            $dbPeon = new database;
       if($dbPeon->conectar()==true){
            $query = "INSERT INTO rel_login_permisos VALUES ('NULL', '$Fk_Usuario_Login', '$Fk_CatMenu', '$FkTituloMenu')";
            $result = @mysql_query($query);
        if (!$result){
               return false;
        }else{
           if($this->InsHistorialAcceso($this->IdUsuario, $this->Ip, $this->CatOMdo, $this->Registro))
               return true;
           else
               return false;
        }
       }
     }








     function InsCarreras($plantel, $clvCarrera, $nomCarrera, $revoe, $fechaExp, $modalidad, $nomTitulo, $academico,$edificio) {
        $dbPeon = new database;
        if ($dbPeon->conectar() == true) {
            $query = "INSERT INTO tbl_carreras VALUES ('','$plantel','$modalidad', '$academico', '$clvCarrera','$nomCarrera','$revoe','$fechaExp','$nomTitulo','$edificio', 1)";
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
    #FECHA: 30/05/2014
    #MODULO AFECTADO: includes/ajax/herramientas/datosinsitucion/Ins_datosinsitucion.php
    #DESCRIPCION: Inserta un nuevo Registro en la Tabla Tbl_Escuelas
     function InsDatosInstitucion($v_coloniafracc, $v_nombre, $v_apodoInstitucion, $v_clave, $v_direccion, $v_telefono, $v_fechaincorporacion, $v_nooficio, $v_registro, $v_regimen, $v_paginaweb, $v_lema) {
        $dbPeon = new database;
        if ($dbPeon->conectar() == true) {
            $query = "INSERT INTO tbl_escuela VALUES ('','$v_coloniafracc', '$v_nombre', '$v_apodoInstitucion', '$v_clave', '$v_direccion', '$v_telefono', '$v_fechaincorporacion', '$v_nooficio', '$v_registro', '$v_regimen', '$v_paginaweb', '$v_lema', 1)";
            $result = @mysql_query($query);
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
    #FECHA: 04/06/2014
     function InsGeneraciones($Descripcion, $fk_iniciomes, $fk_inicioanios, $fk_finmeses, $fk_finanios, $fk_tipo) {
        $dbPeon = new database;
        if ($dbPeon->conectar() == true) {
            $query = "INSERT INTO cat_generacion VALUES ('','$Descripcion', '$fk_inicioanios', '$fk_iniciomes', '$fk_finanios', '$fk_finmeses','$fk_tipo', '1')";
            $result = @mysql_query($query);
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
    #FECHA: 06/06/2014
    #DESCRIPCION: Inserta un nuevo Registro
function InsSinodales($nombre, $cedula, $fk_nivelestudio,$numEmpleado, $cel, $nss, $direccion, $curp, $rfc, $foto) {
        $dbPeon = new database;
        if ($dbPeon->conectar() == true) {
            $query = "INSERT INTO tbl_profesores VALUES ('','$nombre', '$cedula', $fk_nivelestudio,'$numEmpleado', '$cel', '$nss', '$direccion', '$curp', '$rfc', '$foto', 1,1)";
            $result = @mysql_query($query) or die(mysql_error());
            $pk_sinodal=mysql_insert_id();
            if (!$result) {
                return false;
            } else {
                if ($this->InsHistorialAcceso($this->IdUsuario, $this->Ip, $this->CatOMdo, $this->Registro))
                    return $pk_sinodal;
                else
                    return false;
            }
        }
    }



    function InsUsuario($clvTrabajador, $nomUser, $apaterno, $amaterno, $telefono, $correo, $puesto, $fk_genero){
        $dbPeon = new database();
        if($dbPeon->conectar() == true){
            $sql = "INSERT INTO tbl_trabajadores VALUES ('','$clvTrabajador','$nomUser','$apaterno','$amaterno','$telefono','$correo','$puesto','$fk_genero',1)";
            $result = mysql_query($sql) or die(@mysql_error());
            $pk_trabajador = @mysql_insert_id();
            if(!$result){
                return false;
            }else{
                if ($this->InsHistorialAcceso($this->IdUsuario, $this->Ip, $this->CatOMdo, $this->Registro))
                    return $pk_trabajador;
                else
                    return false;
            }
        }
    }



        #AGREGADO: Ivan Mauricio Meneses Melo Granados
    #FECHA: 06/06/2014
    #DESCRIPCION: Inserta un nuevo Registro
function Insrel_profesorcarrera($fk_carreras, $fk_sinodal) {
        $dbPeon = new database;
        if ($dbPeon->conectar() == true) {
            $query = "INSERT INTO rel_profesorcarrera VALUES ('','$fk_carreras', '$fk_sinodal',1)";
            $result = @mysql_query($query) or die(mysql_error());
            $pk_sinodal=mysql_insert_id();
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






 function InsReltrabajadorcarrera($idTrabajador, $idCarrera){
        $dbPeon = new database();
        if($dbPeon->conectar()==true){
        $sql="INSERT INTO rel_trabajadorecarreras VALUES ('','$idTrabajador','$idCarrera',1)";
        $result=@mysql_query($sql) or die(@mysql_errno());
        $pk_trabajador = mysql_insert_id();
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
    #FECHA: 23/06/2014
    #DESCRIPCION: Inserta un nuevo Registro
    function InsAlumnos($matricula, $nombre, $apaterno, $amaterno, $direccion, $curp, $FechaNacimiento, $correo, $fk_genero, $telefonofijo, $telefonocelular, $v_coloniafracc, $codigopostal, $fk_carreras, $fk_nivelestudio, $fk_modalidad, $fk_turnos, $planEstudios, $fk_generacion, $letraPromedio, $promedio, $generacionSecre, $generacionNumero) {
        $dbPeon = new database;
        if ($dbPeon->conectar() == true) {
            $query = "INSERT INTO tbl_alumnos VALUES ('','$matricula', '$nombre', '$apaterno', '$amaterno', '$direccion', '$curp', '$FechaNacimiento','$correo', '$fk_genero', '$telefonofijo', '$telefonocelular', '$v_coloniafracc', '$codigopostal', '$fk_carreras', '$fk_nivelestudio', '$fk_modalidad', '$fk_turnos', '$planEstudios', '$fk_generacion', '$letraPromedio', '$promedio', '$generacionSecre', '$generacionNumero','','','','','','',0,0,'1')";
            $result = @mysql_query($query) or die(mysql_error());
            $pk_sinodal=mysql_insert_id();
            if (!$result) {
                return false;
            } else {
                if ($this->InsHistorialAcceso($this->IdUsuario, $this->Ip, $this->CatOMdo, $this->Registro))
                    return $pk_sinodal;
                else
                    return false;
            }
        }
    }


         #AGREGADO: Ivan Mauricio Meneses Melo Granados
    #FECHA: 30/06/2014
    #DESCRIPCION: Inserta un nuevo Registro
function InsTramiteExamen($pk_alumno, $fechaaplicacionLista, $timepicker1, $ActaOriginal, $ActaCopia, $cbOriginal, $cbCopia, $clicOriginal, $clicCopia, $curpOriginal, $curpCopia, $consservicioOriginal, $consservicioCopia, $reciboOriginal, $reciboCopia, $recibofolio, $triniti, $trinitiCopia, $ObservacionesDoc){
        $dbPeon = new database;
        if ($dbPeon->conectar() == true) {
            $query = "INSERT INTO tbl_exainstitucional VALUES ('','$pk_alumno', '$fechaaplicacionLista', '$timepicker1', '$ActaOriginal', '$ActaCopia', '$cbOriginal', '$cbCopia', '$clicOriginal', '$clicCopia', '$curpOriginal', '$curpCopia', '$consservicioOriginal', '$consservicioCopia', '$reciboOriginal', '$reciboCopia', '$recibofolio', '$triniti', '$trinitiCopia','','$ObservacionesDoc','1')";
            $result = @mysql_query($query) or die(mysql_error());
            $pk_sinodal=mysql_insert_id();
            if (!$result) {
                return false;
            } else {
                if ($this->InsHistorialAcceso($this->IdUsuario, $this->Ip, $this->CatOMdo, $this->Registro))
                    return $pk_sinodal;
                else
                    return false;
            }
        }
    }


     #AGREGADO: Ivan Mauricio Meneses Melo Granados
    #FECHA: 30/06/2014
    #DESCRIPCION: Inserta un nuevo Registro
function InsTramiteExamenCapturaResultados($pk_alumno) {
        $dbPeon = new database;
        if ($dbPeon->conectar() == true) {
            $query = "INSERT INTO tbl_resultadoexamen VALUES ('','$pk_alumno', '','','','','','','','','','','')";
            $result = @mysql_query($query) or die(mysql_error());
            $pk_sinodal=mysql_insert_id();
            if (!$result) {
                return false;
            } else {
                if ($this->InsHistorialAcceso($this->IdUsuario, $this->Ip, $this->CatOMdo, $this->Registro))
                    return $pk_sinodal;
                else
                    return false;
            }
        }
    }



      #AGREGADO: Ivan Mauricio Meneses Melo Granados
    #FECHA: 02/07/2014
    #DESCRIPCION: Inserta un nuevo Registro
   function InsTomaProtesta($pk_alumno, $FechaTomaProtestaLista, $hora, $salon, $fk_titulacion, $nombreTesis, $Fk_Duracion, $presidente, $secretario, $vocal, $suplente, $observacion) {
        $dbPeon = new database;
        if ($dbPeon->conectar() == true) {
            $query = "INSERT INTO tbl_tomadeprotesta VALUES ('','$pk_alumno', '$FechaTomaProtestaLista', '$hora', '$salon', '$fk_titulacion', '$nombreTesis', '$Fk_Duracion', '$presidente', '$secretario', '$vocal', '$suplente', '$observacion','','','','','','','','1')";
            $result = @mysql_query($query) or die(mysql_error());
            $pk_sinodal=mysql_insert_id();
            if (!$result) {
                return false;
            } else {
                if ($this->InsHistorialAcceso($this->IdUsuario, $this->Ip, $this->CatOMdo, $this->Registro))
                    return $pk_sinodal;
                else
                    return false;
            }
        }
    }


    #AGREGADO: Ivan Mauricio Meneses Melo Granados
    #FECHA: 26/06/2014
    #DESCRIPCION: Inserta un nuevo Registro
    function InsEgresados($pk_alumno, $fk_estadoTitulacion, $estatusTrabajo, $correoTrabajo, $nombreJefeInmediato, $mtriaNombre, $mtriaInstitucion, $doctoradoNombre, $doctoradoInstitucion, $especialidadNombre, $especialidadInstitucion, $estatusCredencial, $fechaexpediciontituloLista, $noactatitulo, $quehacermejora, $nombreEmpresaTrabajo, $puestoTrabajo,$direccionTrabajo,$telefonoTrabajo,$noActaExamen,$TipoAcreditacion,$fk_ingresoactual,$empleoencontrar,$plandeestudioscalificacion,$fk_gradosatisfaccion,$aspectodebilidad,$sugerencias,$edadEgreso,$Discapacidad,$DiscapacidadCual,$fechaEntregaCredencialLista,$folioTimbreTitulo,$fk_estcivil,$noCedulaProf,$derechoPromedio,$nuevaUno,$nuevaDos,$porqueUno,$porqueDos) {
        $dbPeon = new database;
        if ($dbPeon->conectar() == true) {
            $query = "INSERT INTO tbl_egresados VALUES ('','$pk_alumno', '$fk_estadoTitulacion', '$estatusTrabajo', '$correoTrabajo', '$nombreJefeInmediato', '$mtriaNombre', '$mtriaInstitucion', '$doctoradoNombre', '$doctoradoInstitucion', '$especialidadNombre', '$especialidadInstitucion', '$noactatitulo','$folioTimbreTitulo', '$fechaexpediciontituloLista', '$quehacermejora', '$estatusCredencial', '$nombreEmpresaTrabajo', '$puestoTrabajo','$direccionTrabajo','$telefonoTrabajo','$noActaExamen','$TipoAcreditacion','$fk_ingresoactual','$empleoencontrar','$plandeestudioscalificacion','$fk_gradosatisfaccion','$aspectodebilidad','$sugerencias','$edadEgreso','$Discapacidad','$DiscapacidadCual','$fechaEntregaCredencialLista','$fk_estcivil','NULL','$noCedulaProf','$derechoPromedio','$nuevaUno','$nuevaDos','$porqueUno','$porqueDos')";
            $result = @mysql_query($query) or die(mysql_error());
            $pk_sinodal=mysql_insert_id();
            if (!$result) {
                return false;
            } else {
                if ($this->InsHistorialAcceso($this->IdUsuario, $this->Ip, $this->CatOMdo, $this->Registro))
                    return $pk_sinodal;
                else
                    return false;
            }
        }
    }



      #AGREGADO: Ivan Mauricio Meneses Melo Granados
    #FECHA: 26/06/2014
    #DESCRIPCION: Inserta un nuevo Registro
    function InsEgresadosEncuestaMedicina($pk_alumno, $EdadAlumno, $fk_estadocivil, $AnoInicioLicenciatura, $AnoFinLicenciatura, $fk_estudiosposgrado, $EstudioPosgradoMedicinaOtros, $fk_ramaposgrado, $fk_institucioneslabora, $InstitucionLaboraMedicinaOtros, $DireccionInstitucionLabora, $fk_puestosmedicina, $FuncionesDesempenaMedicina, $fk_ingresoactual, $PuestoUno, $InstitucionEmpresaUno, $TiempoQueLaboroUno, $PuestoDos, $InstitucionEmpresaDos, $TiempoQueLaboroDos, $PuestoTres, $InstitucionEmpresaTres, $TiempoQueLaboroTres, $PerteneceOrganizacionSocial, $PerteneceOrganizacionSocialSi, $CertificacionProfesional, $CertificacionProfesionalFecha, $CertificacionProfesionalOrganismo, $CapacitacionTrabajoActual, $GradoCienciasBasicas, $GradoCienciasClinicas, $fk_aspectodebilidad, $AspectoDebilidadOtros, $ComentarioMejorarPerfil, $ComentarioMejorarPlanEstudios, $fk_gradosatisfaccion, $ElegirMismaInstitucion) {
        $dbPeon = new database;
        if ($dbPeon->conectar() == true) {
            $query = "INSERT INTO tbl_encuestamedicina VALUES ('','$pk_alumno', '$EdadAlumno', '$fk_estadocivil', '$AnoInicioLicenciatura', '$AnoFinLicenciatura', '$fk_estudiosposgrado', '$EstudioPosgradoMedicinaOtros', '$fk_ramaposgrado', '$fk_institucioneslabora', '$InstitucionLaboraMedicinaOtros', '$DireccionInstitucionLabora', '$fk_puestosmedicina', '$FuncionesDesempenaMedicina', '$fk_ingresoactual', '$PuestoUno', '$InstitucionEmpresaUno', '$TiempoQueLaboroUno', '$PuestoDos', '$InstitucionEmpresaDos', '$TiempoQueLaboroDos', '$PuestoTres', '$InstitucionEmpresaTres', '$TiempoQueLaboroTres', '$PerteneceOrganizacionSocial', '$PerteneceOrganizacionSocialSi', '$CertificacionProfesional', '$CertificacionProfesionalFecha', '$CertificacionProfesionalOrganismo', '$CapacitacionTrabajoActual', '$GradoCienciasBasicas', '$GradoCienciasClinicas', '$fk_aspectodebilidad', '$AspectoDebilidadOtros', '$ComentarioMejorarPerfil', '$ComentarioMejorarPlanEstudios', '$fk_gradosatisfaccion', '$ElegirMismaInstitucion')";
            $result = @mysql_query($query) or die(mysql_error());
            $pk_sinodal=mysql_insert_id();
            if (!$result) {
                return false;
            } else {
                if ($this->InsHistorialAcceso($this->IdUsuario, $this->Ip, $this->CatOMdo, $this->Registro))
                    return $pk_sinodal;
                else
                    return false;
            }
        }
    }


       #AGREGADO: Ivan Mauricio Meneses Melo Granados
    #FECHA: 26/06/2014
    #DESCRIPCION: Inserta un nuevo Registro
    function InsEgresadosEncuestaMaestria($pk_alumno, $DA_Licenciatura, $DA_LicenciaturaInst, $DA_Maestria, $DA_MaestriaInst, $DA_Doctorado, $DA_DoctoradoInst, $DA_Especialidad, $DA_EspecialidadInst, $DL_TrabajaActualmente, $DL_EmpresaColabora, $DL_PuestoDesempena, $DL_DireccionEmpresa, $DL_TelefonoEmpresa, $DL_Mail, $DL_JefeInmediato, $DL_OpinionPlan, $DL_CalifPlan, $DL_Satisfaccion) {
        $dbPeon = new database;
        if ($dbPeon->conectar() == true) {
            $query = "INSERT INTO tbl_encuestamaestria VALUES ('','$pk_alumno', '$DA_Licenciatura', '$DA_LicenciaturaInst', '$DA_Maestria', '$DA_MaestriaInst', '$DA_Doctorado', '$DA_DoctoradoInst', '$DA_Especialidad', '$DA_EspecialidadInst', '$DL_TrabajaActualmente', '$DL_EmpresaColabora', '$DL_PuestoDesempena', '$DL_DireccionEmpresa', '$DL_TelefonoEmpresa', '$DL_Mail', '$DL_JefeInmediato', '$DL_OpinionPlan', '$DL_CalifPlan', '$DL_Satisfaccion')";
            $result = @mysql_query($query) or die(mysql_error());
            $pk_sinodal=mysql_insert_id();
            if (!$result) {
                return false;
            } else {
                if ($this->InsHistorialAcceso($this->IdUsuario, $this->Ip, $this->CatOMdo, $this->Registro))
                    return $pk_sinodal;
                else
                    return false;
            }
        }
    }



             #AGREGADO: Ivan Mauricio Meneses Melo Granados
    #FECHA: 26/06/2014
    #DESCRIPCION: Inserta un nuevo Registro
    function InsEgresadosEncuestaDoctorado($pk_alumno, $DA_Licenciatura, $DA_LicenciaturaInst, $DA_Maestria, $DA_MaestriaInst, $DA_Doctorado, $DA_DoctoradoInst, $DA_Especialidad, $DA_EspecialidadInst, $DL_TrabajaActualmente, $DL_EmpresaColabora, $DL_PuestoDesempena, $DL_DireccionEmpresa, $DL_TelefonoEmpresa, $DL_Mail, $DL_JefeInmediato, $DL_OpinionPlan, $DL_CalifPlan, $DL_Satisfaccion) {
        $dbPeon = new database;
        if ($dbPeon->conectar() == true) {
            $query = "INSERT INTO tbl_encuestadoctorado VALUES ('','$pk_alumno', '$DA_Licenciatura', '$DA_LicenciaturaInst', '$DA_Maestria', '$DA_MaestriaInst', '$DA_Doctorado', '$DA_DoctoradoInst', '$DA_Especialidad', '$DA_EspecialidadInst', '$DL_TrabajaActualmente', '$DL_EmpresaColabora', '$DL_PuestoDesempena', '$DL_DireccionEmpresa', '$DL_TelefonoEmpresa', '$DL_Mail', '$DL_JefeInmediato', '$DL_OpinionPlan', '$DL_CalifPlan', '$DL_Satisfaccion')";
            $result = @mysql_query($query) or die(mysql_error());
            $pk_sinodal=mysql_insert_id();
            if (!$result) {
                return false;
            } else {
                if ($this->InsHistorialAcceso($this->IdUsuario, $this->Ip, $this->CatOMdo, $this->Registro))
                    return $pk_sinodal;
                else
                    return false;
            }
        }
    }

     function InsEmpleadores($fechaSolicitud, $empresa, $nomSolicitante, $puestoSolicitante, $licenciatura, $puestoVacante, $numVacantes, $telefono,$email,$direccion,$sexo) {
        $dbPeon = new database;
        if ($dbPeon->conectar() == true) {
            $query = "INSERT INTO tbl_empleadores VALUES ('','$fechaSolicitud','$empresa', '$nomSolicitante', '$puestoSolicitante','$licenciatura','$puestoVacante','$numVacantes','$telefono','$email','$direccion','$sexo')";
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


	function InsAlumnosByList($rMat,$rNom,$rPat,$rMtn,$rSex,$rCol,$rCod,$rCar,$rNve,$rMod,$rTur,$rPle,$rGen,$rGeN,$rCurp){
		$dbPeon = new database;
		if ($dbPeon->conectar() == true){
			$sql="INSERT INTO tbl_alumnos VALUES(
			'',
			'$rMat',
			'$rNom',
			'$rPat',
			'$rMtn',
			'',
			'$rCurp',
			'',
			'',
			'$rSex',
			'',
			'',
			'$rCol',
			'$rCod',
			'$rCar',
			'$rNve',
			'$rMod',
			'$rTur',
			'$rPle',
			'$rGen',
			'',
			'',
			'',
			'$rGeN',
            '',
            '',
            '',
            '',
            '',
            '',
            0,
            0,
			1
			)";
			$result = @mysql_query($sql) or die(mysql_error());
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

	function InsAlumnosTblEgreByList($rAlu,$rEdd){
		$dbPeon = new database;
		if ($dbPeon->conectar() == true){
			$sql="INSERT INTO tbl_egresados (pk_egresados,fk_alumnos,fk_estadoTitulacion,noactatitulo,fk_ingresoactual,fk_gradosatisfaccion,edadEgreso,fk_estadocivil_egresados,last_upd) VALUES (
			'',
			'$rAlu',
			'2',
			'00000',
			'2',
			'1',
			'$rEdd',
			'1',
			''
			)";
			$result = @mysql_query($sql) or die(mysql_error());
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



    function InsEncuestaEmpleadoresByAlumno($pk_alumno, $pk_carreras, $empresaLabora, $giroEmpresa, $direccionEmpresa, $puestoEjerce, $mi_vi_va, $mi_vi_va_comment, $formaTrabajaEgresado, $realizaFunciones, $satisfaceTrabajoEgresado, $evaluaComportamientoEgresado, $contrataEgresado, $contrataEgresado_comment, $sugerenciasEmpleador, $nombreEmpleador, $puestoEmpleador){
        $dbPeon = new database;
        if ($dbPeon->conectar() == true){
            $sql="INSERT INTO tbl_encuestaempleadores VALUES(
            'NULL',
            ".$pk_alumno.",
            ".$pk_carreras.",
            '".$empresaLabora."',
            '".$giroEmpresa."',
            '".$direccionEmpresa."',
            '".$puestoEjerce."',
            ".$mi_vi_va.",
            '".$mi_vi_va_comment."',
            ".$formaTrabajaEgresado.",
            ".$realizaFunciones.",
            ".$satisfaceTrabajoEgresado.",
            ".$evaluaComportamientoEgresado.",
            ".$contrataEgresado.",
            '".$contrataEgresado_comment."',
            '".$sugerenciasEmpleador."',
            '".$nombreEmpleador."',
            '".$puestoEmpleador."',
            '".date('Y-m-d')."'
            )";
            $result = @mysql_query($sql) or die(mysql_error());
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


    function InsEncuestaEmpleadoresByAlumno2019(
        $fk_alumno, 
        $fk_carrera,
        $empresaEmpleado,
        $direccionEmpresa, 
        $puestoEjerce, 
        $P6,
        $P6C,
        $P7,
        $P7P,
        $P8,
        $P9,
        $P10,
        $P11,
        $comentariosEmpleador,
        $nombreEmpleador,
        $puestoEmpleador,
        $telefonoEmpleador,
        $correoEmpleador

    ){
        $dbPeon = new database;
        if ($dbPeon->conectar() == true){
            $sql="INSERT INTO tbl_encuestaempleadores2019 VALUES(
            'NULL',
            ".$fk_alumno.",
            ".$fk_carrera.",
            '".$empresaEmpleado."',
            'NULL',
            '".$direccionEmpresa."',
            '".$puestoEjerce."',
            ".$P6.",
            '".$P6C."',
            ".$P7.",
            ".$P7P.",
            ".$P8.",
            ".$P9.",
            ".$P10.",
            ".$P11.",
            '".$comentariosEmpleador."',
            '".$nombreEmpleador."',
            '".$puestoEmpleador."',
            '".date('Y-m-d')."',
            '".$telefonoEmpleador."',
            '".$correoEmpleador."'           
            )";
            $result = @mysql_query($sql) or die(mysql_error());
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


    function InsRegistroDeTimbradoDeDocumentos($plantilla,$folio_timbre,$folio_doc,$observaciones,$fk_documento,$fk_alumno){
        $dbPeon = new database;
        if ($dbPeon->conectar() == true){
            $sql="INSERT INTO tbl_timbres_secretaria VALUES(
            'NULL',
            '".$plantilla."',
            '".$folio_timbre."',
            '".date('Y-m-d')."',
            '".$folio_doc."',
            '".$observaciones."',
            ".$fk_documento.",
            ".$fk_alumno.",
            1
            )";
            $result = @mysql_query($sql) or die(mysql_error());
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



    function InsSolutionGeneraciones($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fk_generacion, $desc_planestudios, $no_sem, $total_grupo){
        $dbPeon = new database;
        if ($dbPeon->conectar() == true){
            $sql="INSERT INTO tbl_gen_plan_group VALUES(
            'NULL',
            '$fk_nivelestudio',
            '$fk_modalidad',
            '$fk_carreras',
            '$fk_generacion',
            '$desc_planestudios',
            '$no_sem',
            '$total_grupo',
            1
            )";
            $result = @mysql_query($sql);
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


    function InsPreparatorias($nomb_prepa, $plantel, $turno, $ciudad, $direccion, $email, $telefonos, $persona_atiende, $cargo_persona){
        $dbPeon = new database;
        if ($dbPeon->conectar() == true){
            $sql="INSERT INTO cat_directorio_preparatorias VALUES(
            'NULL',
            '$nomb_prepa',
            '$plantel',
            '$turno',
            '$ciudad',
            '$direccion',
            '$email',
            '$telefonos',
            '$persona_atiende',
            '$cargo_persona',
            '".date('Y-m-d')."'
            )";
            $result = @mysql_query($sql);
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


    function ModCurpInTomaProtesta( $pk_alumno, $curp, $f_inicio_car, $f_fin_car, $institucionProcedencia, $f_inicio_antecedente, $f_fin_antecedente, $noCedula, $entidad_federativa, $nivel_escolar) {
        $dbPeon = new database();
        if ($dbPeon->conectar() == true) {
            $query = "INSERT INTO tbl_alumnos (pk_alumno, curp, f_inicio_car, f_fin_car, institucionProcedencia, f_inicio_antecedente, f_fin_antecedente, noCedula, entidad_federativa, nivel_escolar) VALUES ( $pk_alumno, '$curp', '$f_inicio_car', '$f_fin_car', '$institucionProcedencia', '$f_inicio_antecedente', '$f_fin_antecedente', '$noCedula', '$entidad_federativa', '$nivel_escolar' ) ON DUPLICATE KEY UPDATE
            curp = '$curp',
            f_inicio_car = '$f_inicio_car',
            f_fin_car = '$f_fin_car',
            institucionProcedencia = '$institucionProcedencia',
            f_inicio_antecedente = '$f_inicio_antecedente',
            f_fin_antecedente = '$f_fin_antecedente',
            noCedula = '$noCedula',
            entidad_federativa = $entidad_federativa,
            nivel_escolar = $nivel_escolar
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

?>

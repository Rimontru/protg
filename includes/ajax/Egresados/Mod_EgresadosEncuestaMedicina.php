<?php
$Ruta = "../../";
require($Ruta . "Config.class.php");
require($Ruta . "ModificacionDB.class.php");
require($Ruta . "ConsultaDB.class.php");


session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);

$Consulta = new ConsultaDB;


$Registro = utf8_decode("Se modificaron datos de la encuesta de medicna, matricula: ". $matricula);
$Modificar = new ModificacionDB($_SESSION['usuario_id'], $_SESSION['IP'], "Modificar Encuesta Medicina", $Registro);

if (empty($_POST['nombre']) || empty($_POST['apaterno']) || empty($_POST['amaterno'])) {
    echo "2|Usted no ha llenado todos los campos";    
}else {

     if($CertificacionProfesional<>"2"){
		 
		  $fechaSQL = explode("/", $CertificacionProfesionalFecha);
    $CertificacionProfesionalFechaLista = $fechaSQL[2] . "-" . $fechaSQL[1] . "-" . $fechaSQL[0];
	 }else
	 {
		$CertificacionProfesionalFechaLista = "0000-00-00";
	 }

    $result = $Modificar->ModificarDatosEgresadosEncuestaMedicina($pk_alumno, $EdadAlumno, $fk_estadocivil, $AnoInicioLicenciatura, $AnoFinLicenciatura, $fk_estudiosposgrado, $EstudioPosgradoMedicinaOtros, $fk_ramaposgrado, $fk_institucioneslabora, $InstitucionLaboraMedicinaOtros, $DireccionInstitucionLabora, $fk_puestosmedicina, $FuncionesDesempenaMedicina, $fk_ingresoactual, $PuestoUno, $InstitucionEmpresaUno, $TiempoQueLaboroUno, $PuestoDos, $InstitucionEmpresaDos, $TiempoQueLaboroDos, $PuestoTres, $InstitucionEmpresaTres, $TiempoQueLaboroTres, $PerteneceOrganizacionSocial, $PerteneceOrganizacionSocialSi, $CertificacionProfesional, $CertificacionProfesionalFechaLista, $CertificacionProfesionalOrganismo, $CapacitacionTrabajoActual, $GradoCienciasBasicas, $GradoCienciasClinicas, $fk_aspectodebilidad, $AspectoDebilidadOtros, $ComentarioMejorarPerfil, $ComentarioMejorarPlanEstudios, $fk_gradosatisfaccion, $ElegirMismaInstitucion);
    if ($result){        
        
        
            echo "1|Se Guardo Correctamente";
      
        

    } else {
        echo "2|Error al Guardar ";
    }
   
    exit;
}//fin del else empty
?>
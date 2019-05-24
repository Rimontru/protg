<?php
$Ruta = "../../";
require($Ruta . "Config.class.php");  # Cargar datos conexion y otras variables.
require($Ruta . "InsertarDB.class.php");
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisValidaciones.class.php");

session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);

$Consulta = new ConsultaDB;


$Registro = utf8_decode("Se agrego la encuesta Maestria, a la matricula: ". $matricula);
$Insertar = new InsertarDB($_SESSION['usuario_id'], $_SESSION['IP'], "Alta Encuesta", $Registro);


if (empty($_POST['nombre']) || empty($_POST['apaterno']) || empty($_POST['amaterno'])) {
    echo "2|Usted no ha llenado todos los campos";    
}else {

    $result = $Insertar->InsEgresadosEncuestaDoctorado($pk_alumno, $DA_Licenciatura, $DA_LicenciaturaInst, $DA_Maestria, $DA_MaestriaInst, $DA_Doctorado, $DA_DoctoradoInst, $DA_Especialidad, $DA_EspecialidadInst, $DL_TrabajaActualmente, $DL_EmpresaColabora, $DL_PuestoDesempena, $DL_DireccionEmpresa, $DL_TelefonoEmpresa, $DL_Mail, $DL_JefeInmediato, $DL_OpinionPlan, $DL_CalifPlan, $DL_Satisfaccion);
    if ($result){        
               echo "1|Se Guardo Correctamente";
    } else {
        echo "2|Error al Guardar ";
    }
   
    exit;
}//fin del else empty
?>
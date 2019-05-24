<?php
$Ruta = "../../";
require($Ruta . "Config.class.php");
require($Ruta . "ModificacionDB.class.php");
require($Ruta . "ConsultaDB.class.php");


session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);

$Consulta = new ConsultaDB;


$Registro = utf8_decode("Se modificaron datos de la encuesta de maestria, matricula: ". $matricula);
$Modificar = new ModificacionDB($_SESSION['usuario_id'], $_SESSION['IP'], "Modificar Encuesta maestria", $Registro);

if (empty($_POST['nombre']) || empty($_POST['apaterno']) || empty($_POST['amaterno'])) {
    echo "2|Usted no ha llenado todos los campos";    
}else {

   
    $result = $Modificar->ModificarDatosEgresadosEncuestaDoctorado($pk_alumno, $DA_Licenciatura, $DA_LicenciaturaInst, $DA_Maestria, $DA_MaestriaInst, $DA_Doctorado, $DA_DoctoradoInst, $DA_Especialidad, $DA_EspecialidadInst, $DL_TrabajaActualmente, $DL_EmpresaColabora, $DL_PuestoDesempena, $DL_DireccionEmpresa, $DL_TelefonoEmpresa, $DL_Mail, $DL_JefeInmediato, $DL_OpinionPlan, $DL_CalifPlan, $DL_Satisfaccion);
    if ($result){        
        
        
            echo "1|Se Guardo Correctamente";
      
        

    } else {
        echo "2|Error al Guardar ";
    }
   
    exit;
}//fin del else empty
?>
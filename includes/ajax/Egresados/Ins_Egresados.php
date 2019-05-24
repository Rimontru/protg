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


$Registro = utf8_decode("Se agregaron datos a egresado con matricula: ". $matricula);
$Insertar = new InsertarDB($_SESSION['usuario_id'], $_SESSION['IP'], "Alta Alumno", $Registro);
  
  if (empty($_POST['nombre']) || empty($_POST['apaterno']) || empty($_POST['amaterno']) || empty($_POST['fk_ingresoactual'])) {
    echo "2|Usted no ha llenado todos los campos";    
  }else {
     if($fechaexpediciontitulo==""){
           $fechaexpediciontituloLista = "0000-00-00";      
    }else{
          $fechaSQL = explode("/", $fechaexpediciontitulo);
            $fechaexpediciontituloLista = $fechaSQL[2] . "-" . $fechaSQL[1] . "-" . $fechaSQL[0];
  }
  if($fechaEntregaCredencial ==""){  
           $fechaEntregaCredencialLista = "0000-00-00";
  }else{
          $fechaSQL = explode("/", $fechaEntregaCredencial);
            $fechaEntregaCredencialLista = $fechaSQL[2] . "-" . $fechaSQL[1] . "-" . $fechaSQL[0];
  }
  $result = $Insertar->InsEgresados($pk_alumno, $fk_estadoTitulacion, $estatusTrabajo, $correoTrabajo, $nombreJefeInmediato, $mtriaNombre, $mtriaInstitucion, $doctoradoNombre, $doctoradoInstitucion, $especialidadNombre, $especialidadInstitucion, $estatusCredencial, $fechaexpediciontituloLista, $noactatitulo, $quehacermejora, $nombreEmpresaTrabajo, $puestoTrabajo,$direccionTrabajo,$telefonoTrabajo,$noActaExamen,$TipoAcreditacion,$fk_ingresoactual,$empleoencontrar,$plandeestudioscalificacion,$fk_gradosatisfaccion,$aspectodebilidad,$sugerencias,$edadEgreso,$Discapacidad,$DiscapacidadCual,$fechaEntregaCredencialLista,$folioTimbreTitulo,$fk_estcivil,$noCedulaProf,$derechoPromedio,$nuevaUno,$nuevaDos,$porqueUno,$porqueDos);
  if ($result){        
      echo "1|Se Guardo Correctamente";
  } else {
        echo "2|Error al Guardar ";
  }
   
    exit;
}//fin del else empty
?>

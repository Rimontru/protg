<?php
$Ruta = "../../";
require($Ruta . "Config.class.php");
require($Ruta . "ModificacionDB.class.php");
require($Ruta . "ConsultaDB.class.php");


session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);

$Consulta = new ConsultaDB;


$Registro = utf8_decode("Se modificaron datos a egresado con matricula: ". $matricula);
$Modificar = new ModificacionDB($_SESSION['usuario_id'], $_SESSION['IP'], "Modificar Datos Egresado", $Registro);

if (empty($_POST['nombre']) || empty($_POST['apaterno']) || empty($_POST['amaterno'])) {
    echo "2|Usted no ha llenado todos los campos";    
}else {
    if($fechaexpediciontitulo==""){
           $fechaexpediciontituloLista = "0000-00-00";      
    }else{
          $fechaSQL = explode("/", $fechaexpediciontitulo);
          $fechaexpediciontituloLista = $fechaSQL[2] . "-" . $fechaSQL[1] . "-" . $fechaSQL[0];
    }
    if($fechaEntregaCredencial==""){   
           $fechaEntregaCredencialLista = "0000-00-00";
    }else{
          $fechaSQL = explode("/", $fechaEntregaCredencial);
          $fechaEntregaCredencialLista = $fechaSQL[2] . "-" . $fechaSQL[1] . "-" . $fechaSQL[0];
    }
    
    $result = $Modificar->ModificarDatosEgresados($fk_estadoTitulacion, $estatusTrabajo, $correoTrabajo, $nombreJefeInmediato, $mtriaNombre, $mtriaInstitucion, $doctoradoNombre, $doctoradoInstitucion, $especialidadNombre, $especialidadInstitucion, $estatusCredencial, $fechaexpediciontituloLista, $noactatitulo,  $quehacermejora, $nombreEmpresaTrabajo, $puestoTrabajo, $direccionTrabajo, $telefonoTrabajo, $noActaExamen, $TipoAcreditacion,$fk_ingresoactual,$empleoencontrar,$plandeestudioscalificacion,$fk_gradosatisfaccion,$aspectodebilidad,$sugerencias,$edadEgreso,$Discapacidad,$DiscapacidadCual,$fechaEntregaCredencialLista,$pk_alumno,$fk_estcivil,$folioTimbreTitulo,$noCedulaProf,$derechoPromedio,$nuevaUno,$nuevaDos,$porqueUno,$porqueDos);
    if ($result){        
          if($FechaTomaProtesta==""){
              $FechaTomaProtesta = "0000-00-00";
          }else{
              $fechaSQL = explode("/", $FechaTomaProtesta);
              $FechaTomaProtesta = $fechaSQL[2] . "-" . $fechaSQL[1] . "-" . $fechaSQL[0];
         }
         $result = $Modificar->ModificarDatosTomaProtestaEGRESADOS($pk_alumno, $FechaTomaProtesta, $fk_titulacion, $folioTimbreActa);
          if ($result){        
              echo "1|Se Guardo Correctamente";
          } else {
              echo "2|Error al Guardar ";
          }
    } else {
        echo "2|Error al Guardar ";
    }   
    exit;
}//fin del else empty
?>

<?php
$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . "ModificacionDB.class.php");
require($Ruta . "ConsultaDB.class.php");

session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);

error_reporting(0);

$Consulta = new ConsultaDB;


$Registro = utf8_decode("Se modificaron los datos la toma de protesta, matricula: ". $matricula);
$Modificar = new ModificacionDB($_SESSION['usuario_id'], $_SESSION['IP'], "Toma Protesta", $Registro);


if (empty($_POST['pk_tramites']) || empty($_POST['FechaTomaProtesta']) || empty($_POST['hora']) || empty($_POST['salon'])) {
    echo "2|Usted no ha llenado todos los campos";    
}else {
    
    $fechaSQL = explode("/", $FechaTomaProtesta);
    $FechaTomaProtestaLista = $fechaSQL[2] . "-" . $fechaSQL[1] . "-" . $fechaSQL[0];

    
    
    //fechas ultimas
     $fechaSQL = explode("/", $FechaSolicitud);
    $FechaSolicitudLista = $fechaSQL[2] . "-" . $fechaSQL[1] . "-" . $fechaSQL[0];

     $fechaSQL = explode("/", $FechaExamen);
    $FechaExamenLista = $fechaSQL[2] . "-" . $fechaSQL[1] . "-" . $fechaSQL[0];

    
   
    $result = $Modificar->ModificarDatosTomaProtesta($pk_tramites, $FechaTomaProtestaLista, $hora, $salon, $fk_titulacion, $nombreTesis, $Fk_Duracion, $presidente, $secretario, $vocal, $suplente, $observacion, $FechaSolicitudLista, $FechaExamenLista, $NumeroAutorizacion, $FolioActa, $TipoRevoe, $ExamenExtraOrdinario);
    if ($result){        
        
        
          $result2 = $Modificar->ModificarDatosAlumnosSecretariaEducacion($curp, $generacionSecre, $planEstudios, $promedio, $letraPromedio, $pk_alumno);
            if ($result2){  
			
			$result3 = $Modificar->ModificarDatosAlumnosEgresadosToma($pk_alumno,$noActaExamen);
            if ($result3){         
            echo "1|Se Guardo Correctamente";
            } else {
                 echo "2|Error al Guardar, No se Actualizaron los datos del Alumno.";
             }
      
        

    } else {
        echo "2|Error al Guardar, No se Actualizaron los datos del Tramite de Examen Secretaria. ";
    }
   
	}
    exit;
}//fin del else empty
?>
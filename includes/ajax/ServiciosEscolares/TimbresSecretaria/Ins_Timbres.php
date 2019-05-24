<?php
$Ruta = "../../../";
require($Ruta . "Config.class.php");  # Cargar datos conexion y otras variables.
require($Ruta . "InsertarDB.class.php");
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisValidaciones.class.php");

session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);

$Consulta = new ConsultaDB;



$Registro = utf8_decode("Nuevo registro: ". $folio_timbre);
$Insertar = new InsertarDB($_SESSION['usuario_id'], $_SESSION['IP'], "Alta Timbre", $Registro);

if(empty($folio_timbre)){
   echo "2|Ingrese la Timbre.";    
   exit();
}



    $result = $Consulta->ConsultaTimbreQuemado(trim($folio_timbre));
    $NumRow = mysql_num_rows($result);
    if ($NumRow>=1) {
          echo "2|Error: El timbre ya esta registrado. <br> Timbre: ".$folio_timbre;    
          exit();
    }



if (empty($_POST['pk_alumno']) || empty($_POST['fk_documento']) || empty($_POST['folio_timbre'])) {
    echo "2|Usted no ha llenado todos los campos";    
}else {
   
    
    $result = $Insertar->InsRegistroDeTimbradoDeDocumentos($plantilla,$folio_timbre,$folio_doc,$observaciones,$fk_documento,$pk_alumno);
    if ($result){ 
      echo "1|Se Guardo Correctamente";

    } else {
        echo "2|Error al Guardar";
    }
   
    exit;
}//fin del else empty
?>
<?php
$Ruta = "../../";
require($Ruta . "Config.class.php");
require($Ruta . "ModificacionDB.class.php");
require($Ruta . "ConsultaDB.class.php");

session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);

$Registro = utf8_decode("Se modificaron los datos de la preparatoria: ". $nomb_prepa);
$Modificar = new ModificacionDB($_SESSION['usuario_id'], $_SESSION['IP'], "Modificar preparatoria", $Registro);

if ( isset($_POST) && ( !empty($_POST['nomb_prepa']) || !empty($_POST['pk_prepa']) ) ) {

extract($_POST);

$result = $Modificar->ModPreparatorias(
					trim($_POST['pk_prepa']),
					htmlentities(trim(strtolower($nomb_prepa))),
					htmlentities(trim(strtolower($plantel))),
					htmlentities(trim($turno)),
					htmlentities(trim(strtolower($ciudad))),
					htmlentities(trim(strtolower($direccion))),
					htmlentities(trim(strtolower($email))),
					htmlentities(trim($telefonos)),
					htmlentities(trim(strtolower($persona_atiende))),
					htmlentities(trim(strtolower($cargo_persona)))
					);

  if ($result){        
      echo "1|Se Modificó Correctamente";
  } else {
        echo "2|Error al Guardar ";
  }
   
    exit;

} else 
	die("No se pudo procesar la información:: parametros no recibidos...");
<?php
$Ruta = "../../";
require($Ruta . "Config.class.php");  
require($Ruta . "InsertarDB.class.php");
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisValidaciones.class.php");

session_name("PROTG2");
session_start();

$Consulta = new ConsultaDB;


$Registro = utf8_decode("Nueva preparatoria: ". $_POST['nomb_prepa']);
$Insertar = new InsertarDB($_SESSION['usuario_id'], $_SESSION['IP'], "Alta Prepa", $Registro);

if ( isset($_POST) && ( !empty($_POST['nomb_prepa']) || !empty($_POST['plantel']) ) ) {

extract($_POST);

$result = $Insertar->InsPreparatorias(
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
      echo "1|Se Guardo Correctamente";
  } else {
        echo "2|Error al Guardar ";
  }
   
    exit;

} else 
	die("No se pudo procesar la información:: parametros no recibidos...");
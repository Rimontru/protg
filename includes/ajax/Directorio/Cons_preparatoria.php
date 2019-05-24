<?php
$Ruta = "../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisFunciones.class.php");
date_default_timezone_set('America/Mexico_City');
$Funciones = new MisFunciones();
$Consulta = new ConsultaDB;


$jsondata = array();

if ( isset($_POST) && !empty($_POST['id_prepa']) ) {

$result = $Consulta->obtenerDirectorios($_POST['id_prepa']);

if ( $result ) {

	$row = mysql_fetch_assoc($result);

	$jsondata['pk_prepa'] = $row['pk_prepa'];
	$jsondata['nomb_prepa'] = $row['nomb_prepa'];
	$jsondata['plantel'] = $row['plantel'];
	$jsondata['turno'] = $row['turno'];
	$jsondata['ciudad'] = $row['ciudad'];
	$jsondata['direccion'] = $row['direccion'];
	$jsondata['email'] = $row['email'];
	$jsondata['telefonos'] = $row['telefonos'];
	$jsondata['persona_atiende'] = $row['persona_atiende'];
	$jsondata['cargo_persona'] = $row['cargo_persona'];
	$jsondata['msg'] = 1;

 	echo json_encode($jsondata);
} else
	echo 0;

} else {
	$jsondata['msg'] = 0;
	echo json_encode($jsondata);
}

<?php
require("../../../../conf.php");
require("../../../Config.class.php");
require("../../../InsertarDB.class.php");
require("../../../ConsultaDB.class.php");

session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones

$cons = new ConsultaDB;
$noAlu = $cons->MaxPrimarykeyTable();

if( isset($_POST) ){ extract($_POST);

	$rMat = explode("|",$mat);
	$rNom = explode("|",$nom);
	$rPat = explode("|",$pat);
	$rMtn = explode("|",$mtn);
	$rSex = explode("|",$sex);
	$rCol = explode("|",$col);
	$rCod = explode("|",$cod);
	$rCar = explode("|",$car);
	$rNve = explode("|",$nve);
	$rMod = explode("|",$mod);
	$rTur = explode("|",$tur);
	$rPle = explode("|",$ple);
	$rGen = explode("|",$gen);
	$rGeN = explode("|",$geN);
	$rEdd = explode("|",$edd);
	$rCur = explode("|",$curp);

	$noRows=count($rMat) - 1; #se le resta 1 xqe la cuenta la posicion 0;

	$i=1;

	while ($i <= $noRows){

		$insert = new InsertarDB($_SESSION['usuario_id'], $_SESSION['IP'], "Alta Alumno","Nuevo Alumno matricula: ".$rMat[$i]);

		$result = $insert->InsAlumnosByList($rMat[$i],$rNom[$i],$rPat[$i],$rMtn[$i],$rSex[$i],$rCol[$i],$rCod[$i],$rCar[$i],$rNve[$i],$rMod[$i],$rTur[$i],$rPle[$i],$rGen[$i],$rGeN[$i],$rCur[$i]);

		$result1 = $insert->InsAlumnosTblEgreByList($noAlu++,$rEdd[$i]);

	$i++;
	}
	if($result){
		unlink($unlink_url_file);
        echo "1|Se Guardo Correctamente";
	}
	else
        echo "2|Error al Guardar";

    exit;

}
?>
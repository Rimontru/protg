<?php
$real=('../');
include_once($real."clases/pathSistem/fullPaths.php"); #contiene tadas las urls php requeridas
require_once($real.$params_db);
require_once($real.$conexion_db);
$db= new conexion(); 

if(isset($_POST)){
	extract($_POST);
	$sql="INSERT INTO tbl_comentarios (fk_encuesta,comentario) 
	VALUES(".$fk_encuesta.",'".$comentarios."')";
	$db->executeQuery($sql);
	echo 1;
}
?>
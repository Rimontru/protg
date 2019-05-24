<?php
session_start();
$real=('../');
include_once($real."clases/pathSistem/fullPaths.php"); #contiene tadas las urls php requeridas
require_once($real.$params_db);
require_once($real.$conexion_db);

#llamadas MyClass Full
$db= new conexion(); 
$pk_encuestas=$db->genIndex('rel_encuestas',0);

if(isset($_POST)){ extract($_POST);
	if(empty($_SESSION['encuestas'])){
		$arreglo[]=array(
			'pk_encuestas'=>$pk_encuestas,
			'fk_pregunta'=>$pregunta,
			'fecha_registro'=>date('Y-m-d'),
			'fk_opcion'=>$option,
			'fk_estatus'=>1
		);
		$_SESSION['encuestas']=$arreglo;
		$pregunta++;

	echo $pregunta.'|0';
	}
	else{
		$arreglo=$_SESSION['encuestas'];
		$datosNuevos=array(
			'pk_encuestas'=>$pk_encuestas,
			'fk_pregunta'=>$pregunta,
			'fecha_registro'=>date('Y-m-d'),
			'fk_opcion'=>$option,
			'fk_estatus'=>1
		);
		array_push($arreglo,$datosNuevos);
		$_SESSION['encuestas']=$arreglo;
		$pregunta++;
			if($pregunta<=9)
				echo $pregunta.'|0';
			else{# cuando ya esten todas las preguntas en la variable sssio
				for($i=0; $i<count($arreglo); $i++){
					$pk_encuestas=$arreglo[$i]['pk_encuestas'];
					$fk_pregunta=$arreglo[$i]['fk_pregunta'];;
					$fecha_registro=$arreglo[$i]['fecha_registro'];;
					$fk_opcion=$arreglo[$i]['fk_opcion'];
					$fk_estatus=$arreglo[$i]['fk_estatus'];
						$sql="INSERT INTO rel_encuestas 
						VALUES(".$pk_encuestas.",".$fk_pregunta.",'".$fecha_registro."',".$fk_opcion.",".$fk_estatus.")";
						$db->executeQuery($sql);
				}
				unset($_SESSION['encuestas']);
				echo $pregunta.'|'.$pk_encuestas;
			}
	}
}
?>
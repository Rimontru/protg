<?php
/*Redireccionamos a la pagina principal del sistema
header("Location: Sistema.php"); */
if (!isset($_GET['render'])) {
	header('Location: Department/Requirement');

} else{
	switch ( $_GET['render'] ) {

		case 180420:
			header('Location: Sistema.php');
			break;
		default:
			die("Acceso incorrecto...");
			break;
	}
}
?>

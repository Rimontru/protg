<?php

$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "EliminarDB.class.php");

session_name("Guero");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);

$eliminarPermisos = new EliminarDB($_SESSION['usuario_id'], $_SESSION['IP'], "Modulo", "Eliminar Permisos al Usuario ".$Usuario);
//Borramos todos los permisos 
$eliminarPermisos->Eli_Relacion_Usuarios($Pk_Usuario_Login);
?>

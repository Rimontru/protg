<?php
$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . "ModificacionDB.class.php");
require($Ruta . "ConsultaDB.class.php");

session_name("PROTG2"); 
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);

$Obras = new ModificacionDB($_SESSION['usuario_id'], $_SESSION['IP'], "Usuarios", "Cerrado de Sesión " . $_SESSION['usuario_id']);

if (empty($_POST['id'])) {
    echo "2 | Ocurrio un error en la consulta, intente más tarde.";
} else {
    $Obras->CerrarSesion($id);
    echo "1| Se ha cerrado la sesión exitosamente";
    exit;
}//fin else comparacion cadenas
?>

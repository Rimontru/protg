<?php
$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . "EliminarDB.class.php");


session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);

$Registro = utf8_decode("Recuperar la eliminacion de la Generacion" . $pk_generacion);
$Eliminar = new EliminarDB($_SESSION['usuario_id'], $_SESSION['IP'], "Recuperar Generacion", $Registro);


if (isset($recuperar)) {
    $result = $Eliminar->RecuperarBajaGeneracion($pk_generacion);
    if ($result) {
        echo "1|Recuperación Exitosa";
    } else {
        echo "2||Error Al Recuperar";
    }

    exit;
}
?>

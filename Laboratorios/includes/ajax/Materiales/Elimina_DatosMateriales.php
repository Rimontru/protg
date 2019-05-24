<?php
$Ruta = "../../";
require($Ruta . "Config.class.php");
require($Ruta . "EliminarDB.class.php");


session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);

$Registro = utf8_decode("Eliminacion del Material con ID: " . $Pk_material);
$Eliminar = new EliminarDB($_SESSION['usuario_id'], $_SESSION['IP'], "Eliminar Material", $Registro);


if (isset($eliminar)) {
    $result = $Eliminar->EliminarMateriales($Pk_material);
    if ($result) {
        echo "1|Baja Exitosa";
    } else {
        echo "2||Error Al dar de Baja";
    }

    exit;
}
?>

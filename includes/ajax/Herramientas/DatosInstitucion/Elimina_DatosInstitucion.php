<?php
$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . "EliminarDB.class.php");


session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);

$Registro = utf8_decode("Eliminacion de la Institucion" . $pk_dtgenerales);
$Eliminar = new EliminarDB($_SESSION['usuario_id'], $_SESSION['IP'], "Eliminar Institucion", $Registro);


if (isset($eliminar)) {
    $result = $Eliminar->EliminarInstitucion($pk_dtgenerales);
    if ($result) {
        echo "1|Eliminación Exitosa";
    } else {
        echo "2||Error Al Eliminar";
    }

    exit;
}
?>

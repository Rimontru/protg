<?php
$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . "EliminarDB.class.php");

$Obras = new EliminarDB;

extract($_POST);

if (empty($UsuarioId)) {
    echo "2|Usted no a seleccionado un usuario";
} else {

    $result = $Obras->Eli_Usuarios($UsuarioId);
    if ($result) {
        echo "1|El Usuario fue Eliminado Exitosamente";
    } else {
        echo "2|Error Al Eliminar el Usuario seleccionado";
    }

    exit;
}
?>

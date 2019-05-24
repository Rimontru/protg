<?php

$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . "ModificacionDB.class.php");
require($Ruta . "ConsultaDB.class.php");

session_name("Guero");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);

$Obras = new ModificacionDB($_SESSION['usuario_id'], $_SESSION['IP'], "Modulo", "Cambio de Contraseña al Usuario " . $_SESSION['usuario_id']);

$Pk_Usuario_Login=$_SESSION['usuario_id'];

if (empty($_POST['Password']) || empty($_POST['PasswordRepite'])) {
    echo "2|Usted no a llenado todos los campos";
}else if (strcmp($_POST['Password'], $_POST['PasswordRepite']) != 0) {
    echo "2|Las Contrase&ntilde;as no coinciden";
} else {
    $Password=md5($Password);
    $Obras->ModChangePassword($Pk_Usuario_Login, $Password);
    echo "1|Registro Modificado Exitosamente, Deberá reingresar al sistema";
    exit;
}//fin else comparacion cadenas
?>

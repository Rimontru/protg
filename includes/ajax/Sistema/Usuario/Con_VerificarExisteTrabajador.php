<?php
$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");

$Obras = new ConsultaDB;
$Cadena = "";
$idPermisos="";
$idModulo="";


extract($_POST);

if (isset($pk_trabajador)) {
    $result = $Obras->ConExisteTrabajadorUsuario($pk_trabajador);
    if ($result) {
        $row = mysql_fetch_assoc($result);
        if ($row['existe'] >= 1) {
            echo "2|El Nombre de usuario ya esta registrado, verifique";
            mysql_free_result($result);
        }else{
             echo "1|ok";
        }
    }
} 
?>
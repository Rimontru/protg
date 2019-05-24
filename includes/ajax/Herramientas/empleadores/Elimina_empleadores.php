<?php

$Ruta = "../../../";
require($Ruta . "Config.class.php");  # Cargar datos conexion y otras variables.
require($Ruta . "EliminarDB.class.php");

session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);



$Registro = utf8_decode("Elimina Empleador " . $idEmpleador);
$Borrar = new EliminarDB($_SESSION['usuario_id'], $_SESSION['IP'], "Elimina Empleador ", $Registro);

$result = $Borrar->EliminarEmpleador($idEmpleador);

if ($result){        
       echo "1|Registro eliminado correctamente";

} else {
        echo "2|Error al tratar de eliminar" ;
}
   

?>

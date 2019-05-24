<?php
$Ruta = "../../../";
require($Ruta . "Config.class.php");  # Cargar datos conexion y otras variables.
require($Ruta . "InsertarDB.class.php");
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisValidaciones.class.php");

session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);



$Registro = utf8_decode("Nueva Generacion Creada");
$Insertar = new InsertarDB($_SESSION['usuario_id'], $_SESSION['IP'], "Alta Generacion", $Registro);


if (empty($_POST['fk_iniciomes']) || empty($_POST['fk_inicioanios']) || empty($_POST['fk_finmeses']) || empty($_POST['fk_tipo']) || empty($_POST['fk_finanios'])) {
    echo "2|Usted no ha llenado todos los campos";    
}else {
   
    $result = $Insertar->InsGeneraciones($Descripcion, $fk_iniciomes, $fk_inicioanios, $fk_finmeses, $fk_finanios, $fk_tipo);
	
    if ($result){        
       echo "1|La Generación se Guardo Correctamente";

    } else {
        echo "2|Error al Guardar ".$result;
    }
   
    exit;
}//fin del else empty
?>
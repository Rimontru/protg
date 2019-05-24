<?php
$Ruta = "../../../";
require($Ruta . "Config.class.php");  # Cargar datos conexion y otras variables.
require($Ruta . "InsertarDB.class.php");
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisValidaciones.class.php");

session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);



$Registro = utf8_decode("Nueva Solucion a Generacion Creada");
$Insertar = new InsertarDB($_SESSION['usuario_id'], $_SESSION['IP'], "Alta Generacion", $Registro);


if (empty($_POST['fk_nivelestudio']) || empty($_POST['fk_modalidad']) || empty($_POST['fk_carreras']) || empty($_POST['fk_generacion']) ) {
    echo "2|Usted no ha llenado todos los campos";    
}else {
   
    if ( (bool) $Insertar->InsSolutionGeneraciones($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fk_generacion, $desc_planestudios, $no_sem, $total_grupo) == true)
		 echo "1|Los Datos se Guardaron Correctamente";
	else 
		echo "2|Error al Guardar ".( mysql_error() );
    /*if ( bool($result) ){        
       echo "1|Los Datos se Guardaron Correctamente";

    } else {
        echo "2|Error al Guardar ".( mysql_error() );
    }*/
   
    exit;
}//fin del else empty
?>
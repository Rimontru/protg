<?php
$Ruta = "../../../";
require($Ruta . "Config.class.php");  # Cargar datos conexion y otras variables.
require($Ruta . "InsertarDB.class.php");
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisValidaciones.class.php");

session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);



$Registro = utf8_decode("Nueva Institucion Creada Clave: " . $v_clave);
$Insertar = new InsertarDB($_SESSION['usuario_id'], $_SESSION['IP'], "Alta Institucion", $Registro);


if (empty($_POST['v_nombre']) || empty($_POST['v_apodoInstitucion']) || empty($_POST['v_lema']) || empty($_POST['v_clave']) || empty($_POST['v_direccion']) || empty($_POST['v_coloniafracc']) || empty($_POST['v_telefono']) || empty($_POST['v_fechaincorporacion']) || empty($_POST['v_registro'])  || empty($_POST['v_regimen']) || empty($_POST['v_nooficio']) || empty($_POST['v_paginaweb'])) {
    echo "2|Usted no ha llenado todos los campos";    
}else {
    
    $result = $Insertar->InsDatosInstitucion($v_coloniafracc, $v_nombre, $v_apodoInstitucion, $v_clave, $v_direccion, $v_telefono, $v_fechaincorporacion, $v_nooficio, $v_registro, $v_regimen, $v_paginaweb, $v_lema);
	
    if ($result){        
       echo "1|La Institucion se Guardo Correctamente";

    } else {
        echo "2|Error al Guardar";
    }
   
    exit;
}//fin del else empty
?>
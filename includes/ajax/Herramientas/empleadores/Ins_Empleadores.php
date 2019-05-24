<?php
$Ruta = "../../../";
require($Ruta . "Config.class.php");  # Cargar datos conexion y otras variables.
require($Ruta . "InsertarDB.class.php");
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisValidaciones.class.php");

session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);



$Registro = utf8_decode("Nuevo Empleador " . $empresa);
$Insertar = new InsertarDB($_SESSION['usuario_id'], $_SESSION['IP'], "Alta Empleador", $Registro);


if (empty($_POST['fechaSolicitud']) || empty($_POST['empresa']) || empty($_POST['nomSolicitante']) || empty($_POST['puestoSolicitante']) || empty($_POST['licenciatura']) || empty($_POST['puestoVacante']) || empty($_POST['numVacantes']) || empty($_POST['telefono']) || empty($_POST['email'])|| empty($_POST['direccion'])|| empty($_POST['sexo']) ) {
    echo "2|Usted no ha llenado todos los campos";    
}else {
	
	$fechaSQL = explode("/", $fechaSolicitud);
    $fechaaplicacionLista = $fechaSQL[2] . "-" . $fechaSQL[1] . "-" . $fechaSQL[0];

    
//    if(empty($_POST['NumExterior'])){
//        $NumExterior="S/N";
//    }
//    
//    if(empty($_POST['NumInt'])){
//        $NumInt="S/N";
//    }
    
    
    //$Fk_Empresa=$_SESSION['Fk_Empresa']; //lo tomaremos de la session
    $result = $Insertar->InsEmpleadores($fechaaplicacionLista, $empresa, $nomSolicitante, $puestoSolicitante, $licenciatura, $puestoVacante, $numVacantes, $telefono, $email,$direccion,$sexo);
	
    if ($result){        
       echo "1|El Empleador se Guardado Correctamente";

    } else {
        echo "2|Error al Guardar";
    }
   
    exit;
}//fin del else empty
?>
<?php
$Ruta = "../../../";
require($Ruta . "Config.class.php");  # Cargar datos conexion y otras variables.
require($Ruta . "InsertarDB.class.php");
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisValidaciones.class.php");

session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);



$Registro = utf8_decode("Nuevo Carrera " . $clvCarrera);
$Insertar = new InsertarDB($_SESSION['usuario_id'], $_SESSION['IP'], "Alta Carrera", $Registro);


if (empty($_POST['plantel']) || empty($_POST['clvCarrera']) || empty($_POST['nomCarrera']) || empty($_POST['revoe']) || empty($_POST['fechaExp']) || empty($_POST['modalidad']) || empty($_POST['nomTitulo']) || empty($_POST['academico']) ) {
    echo "2|Usted no ha llenado todos los campos";    
}else {
    
//    if(empty($_POST['NumExterior'])){
//        $NumExterior="S/N";
//    }
//    
//    if(empty($_POST['NumInt'])){
//        $NumInt="S/N";
//    }
    
    
    //$Fk_Empresa=$_SESSION['Fk_Empresa']; //lo tomaremos de la session
    $result = $Insertar->InsCarreras($plantel, $clvCarrera, $nomCarrera, $revoe, $fechaExp, $modalidad, $nomTitulo, $academico,$edificio);
	
    if ($result){        
       echo "1|La Carrera se Guardado Correctamente";

    } else {
        echo "2|Error al Guardar";
    }
   
    exit;
}//fin del else empty
?>
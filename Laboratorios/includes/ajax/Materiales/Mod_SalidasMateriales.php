<?php
error_reporting(E_ALL ^ E_DEPRECATED);
$Ruta = "../../";
require($Ruta . "Config.class.php");
require($Ruta . "ModificacionDB.class.php");
require($Ruta . "ConsultaDB.class.php");

session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);
$fk_laboratorios = $_SESSION['fk_laboratorios'];

$Consulta = new ConsultaDB;


$Registro = utf8_decode("Salida de material con ID: ". $Pk_material);
$Modificar = new ModificacionDB($_SESSION['usuario_id'], $_SESSION['IP'], "Salida Material", $Registro);

if($CantidadSalida>$CantidadMaterial){
     echo "2|Error: La cantidad a dar de baja supera la existencia.";  
     exit();
}


if (empty($_POST['Pk_material']) || empty($_POST['CantidadSalida'])) {
    echo "2|Usted no ha llenado todos los campos";    
}else {

    $Stock=$CantidadMaterial-$CantidadSalida;
    $result = $Modificar->ModificarSalidasMateriales($Pk_material, $Stock);
    if ($result){        
        
        
            echo "1|Se Guardo Correctamente |".$result;
      
        

    } else {
        echo "2|Error al Guardar ".$result;
    }
   
    exit;
}//fin del else empty
?>
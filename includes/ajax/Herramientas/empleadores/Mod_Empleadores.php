<?php

$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . "ModificacionDB.class.php");
require($Ruta . "ConsultaDB.class.php");

session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);

$Registro = "Modificación del Empleador " . $empresa ." con ID: ". $empleador;
$Modificar = new ModificacionDB($_SESSION['usuario_id'], $_SESSION['IP'], "Modificacion de Empleador", $Registro);

if (empty($_POST['fechaSolicitud']) || empty($_POST['empresa']) || empty($_POST['nomSolicitante']) || empty($_POST['puestoSolicitante']) || empty($_POST['licenciatura']) || empty($_POST['puestoVacante']) || empty($_POST['numVacantes']) || empty($_POST['telefono']) || empty($_POST['email'])|| empty($_POST['direccion'])|| empty($_POST['sexo']) ) {
    echo "2|Usted no ha llenado todos los campos";    
}else {
      	
      	$fechaSQL = explode("/", $fechaSolicitud);
    	$fechaaplicacionLista = $fechaSQL[2] . "-" . $fechaSQL[1] . "-" . $fechaSQL[0];

        $resultModificar = $Modificar->updateEmpleador($empleador, $fechaaplicacionLista, $empresa, $nomSolicitante, $puestoSolicitante, $licenciatura, $puestoVacante, $numVacantes, $telefono,$email,$direccion,$sexo);
        if ($resultModificar){        
            echo "1|El Empleador se Actualizo Correctamente";
         } else {
             echo "2|Error al intentar editar el registro";
         }
    exit;
}
    

?>

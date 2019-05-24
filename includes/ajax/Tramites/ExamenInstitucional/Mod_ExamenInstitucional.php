<?php
$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . "ModificacionDB.class.php");
require($Ruta . "ConsultaDB.class.php");

session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);

error_reporting(0);

$Consulta = new ConsultaDB;


$Registro = utf8_decode("Se modificaron los datos del examen institucional matricula: ". $matricula);
$Modificar = new ModificacionDB($_SESSION['usuario_id'], $_SESSION['IP'], "Examen Institucional", $Registro);


if (empty($_POST['fechaaplicacion']) || empty($_POST['timepicker1']) || empty($_POST['pk_alumno'])) {
    echo "2|Usted no ha llenado todos los campos";    
}else {
 $fechaSQL = explode("/", $fechaaplicacion);
    $fechaaplicacionLista = $fechaSQL[2] . "-" . $fechaSQL[1] . "-" . $fechaSQL[0];

  
    
    $result = $Modificar->ModificarDatosExamenInstitucional($Pk_ExamenInstitucional, $fechaaplicacionLista, $timepicker1, $ActaOriginal, $ActaCopia, $cbOriginal, $cbCopia, $clicOriginal, $clicCopia, $curpOriginal, $curpCopia, $consservicioOriginal, $consservicioCopia, $reciboOriginal, $reciboCopia, $recibofolio, $triniti, $trinitiCopia, $ObservacionesDoc);
    if ($result){        
        
        
            echo "1|Se Guardo Correctamente";
      
        

    } else {
        echo "2|Error al Guardar ";
    }
   
    exit;
}//fin del else empty
?>
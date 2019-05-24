<?php
$Ruta = "../../../";
require($Ruta . "Config.class.php");  # Cargar datos conexion y otras variables.
require($Ruta . "InsertarDB.class.php");
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisValidaciones.class.php");

session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);
error_reporting(0);
$Consulta = new ConsultaDB;


$Registro = utf8_decode("Nuevo Tramite Examen Institucional, matricula: ". $matricula);
$Insertar = new InsertarDB($_SESSION['usuario_id'], $_SESSION['IP'], "Alta Examen Institucional", $Registro);

if(empty($matricula)){
   echo "2|Ingrese la Matricula.";    
   exit();
}

if (empty($_POST['fechaaplicacion']) || empty($_POST['timepicker1']) || empty($_POST['pk_alumno'])) {
    echo "2|Usted no ha llenado todos los campos";    
}else {

    //fechaaplicacion
    //DATE_FORMAT(fecha, '%d/%m/%y') AS fecha
    //convertir fechas a tipo date mysql
    $fechaSQL = explode("/", $fechaaplicacion);
    $fechaaplicacionLista = $fechaSQL[2] . "-" . $fechaSQL[1] . "-" . $fechaSQL[0];

    
    $result = $Insertar->InsTramiteExamen($pk_alumno, $fechaaplicacionLista, $timepicker1, $ActaOriginal, $ActaCopia, $cbOriginal, $cbCopia, $clicOriginal, $clicCopia, $curpOriginal, $curpCopia, $consservicioOriginal, $consservicioCopia, $reciboOriginal, $reciboCopia, $recibofolio, $triniti, $trinitiCopia, $ObservacionesDoc);
    if ($result){        
                //insetamos en la tabla de capturar resultados examen
                $result22 = $Insertar->InsTramiteExamenCapturaResultados($pk_alumno);
                if ($result22){        
                    echo "1|Se Guardo Correctamente";
                } else {
                    echo "2|Error al Guardar";
                }
    } else {
        echo "2|Error al Guardar";
    }
   
    exit;
}//fin del else empty
?>
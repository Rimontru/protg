<?php

$Ruta = "../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");
date_default_timezone_set('America/Mexico_City');
session_name("Lamparas");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);


$Consulta = new ConsultaDB;
$Cadena = "";
if (isset($Fechesita)) {
   $arrayMeses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
   'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
 
   $arrayDias = array( 'Domingo', 'Lunes', 'Martes',
       'Miercoles', 'Jueves', 'Viernes', 'Sabado');
     
    echo $arrayDias[date('w')].", ".date('d')." de ".$arrayMeses[date('m')-1]." de ".date('Y');
    
    
} 
exit;
?>

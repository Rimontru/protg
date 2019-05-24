<?php

$Ruta = "../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");
date_default_timezone_set('America/Mexico_City');
                      // Iniciamos el uso de sesiones
extract($_POST);


$Consulta = new ConsultaDB;
$Cadena = "";
if (isset($matricula)) {
             $nombre_fichero = '../../../../profile-photos/'.$matricula;

            if (file_exists($nombre_fichero)) {
//                echo "El fichero $nombre_fichero existe";
                $RutaImagen='<img id="fotito" width="200" height="220" src="profile-photos/'.$matricula.'/'.$matricula.'.jpg">';
            } else {
//                echo "El fichero $nombre_fichero no existe";
                $RutaImagen='<img id="fotito" width="200" height="220" src="profile-photos/default-user.jpg">';
            }

            //creamos el div para la foto del perfil
            echo ' <center> 
                            '.$RutaImagen.'                                                             
                             <br><br>
                       
                </center>
                 <br>';
             
    
} 
exit;
?>

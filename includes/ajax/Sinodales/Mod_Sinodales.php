<?php

$Ruta = "../../";
require($Ruta . "Config.class.php");
require($Ruta . "ModificacionDB.class.php");
require($Ruta . "ConsultaDB.class.php");

session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);

$Registro = utf8_decode("Modificación del Sinodal" . $pk_sinodal);
$Modificar = new ModificacionDB($_SESSION['usuario_id'], $_SESSION['IP'], "Modificar Sinodal", $Registro);

$Consulta = new ConsultaDB;

//verificamos que no exista duplicidad
$ResultCedula = $Consulta->ConsultaDatosSinodalesPkSinodal($pk_sinodal, $pk_carreras_anterior);
$NumRow = mysql_num_rows($ResultCedula);
if ($NumRow>=1) {
    while($row2 = mysql_fetch_array($ResultCedula)){
        
      if($pk_carreras != $pk_carreras_anterior){
               if($row2['pk_carreras']==$pk_carreras){
                echo "2|Error: El Sinodal ya existe en la base de datos con esa Carrera";    
                exit();
            
        }
          
      }
   
    
        
    }
      
}


    
    
if (empty($_POST['v_nombre']) || empty($_POST['v_cedula']) || empty($_POST['fk_nivelestudio'])) {
    echo "2|Usted no ha llenado todos los campos";    
}else {
          $foto="Not Found!";
    $result = $Modificar->ModDatosSinodales($v_nombre, $v_cedula, $fk_nivelestudio, $numEmpleado, $cel, $nss, $direccion, $curp, $rfc, $foto, $pk_sinodal, $pk_carreras_anterior, $pk_carreras);
        if ($result){        
            echo "1|Se Guardo Correctamente";

         } else {
             echo "2|Error al Guardar";
         }
    exit;
}
    

?>


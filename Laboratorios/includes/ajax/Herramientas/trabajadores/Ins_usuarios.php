<?php
$Ruta = '../../../';
require($Ruta.'Config.class.php');
require($Ruta.'ConsultaDB.class.php');
require($Ruta.'MisFunciones.class.php');
require($Ruta.'InsertarDB.class.php');


session_name("PROTG2");
session_start();
extract($_POST);


$Registro = utf8_decode("Nuevo usuario " . $v_clvTrabajador);
$Insertar = new InsertarDB($_SESSION['usuario_id'], $_SESSION['IP'], "Alta Carrera", $Registro);

if(empty($carreras)){
    echo "2|Seleccione almenos una Carrera.";    
    exit();
}


if(empty($_POST['v_clvTrabajador']) || empty($_POST['v_nombreUser']) || empty($_POST['v_apaterno']) || empty($_POST['v_amaterno']) || empty($_POST['v_tel']) || empty($_POST['v_correo']) || empty($_POST['v_puesto']) || empty($_POST['carreras']))
    {
        echo "2|Usted no ha llenado todos los campos";
    }
    else
        {

            $result = $Insertar->InsUsuario($v_clvTrabajador, $v_nombreUser, $v_apaterno, $v_amaterno, $v_tel, $v_correo, $v_puesto, $fk_genero);
            if($result){

                  $coma = array(',');
                  $carreras = str_replace($coma,'*',$carreras);
                  $carreras = str_replace(' ','',$carreras); // suprimiendo espacios
                  $arre = explode('*',$carreras);
                    
                  for($i=0;$i<count($arre);$i++)
                    $arre[$i] = str_replace('"','',$arre[$i]);
                    
                  foreach($arre as $valor){
                     $guardar = $Insertar->InsReltrabajadorcarrera($result, $valor);                                  
                  }   
 
                          echo "1|Usuario Guardado Correctamente" . $result;  
          
            } else {
                echo "2|Error al Guardar usuario";
            }
           exit; 
        }

?>

<?php

$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . "ModificacionDB.class.php");
require($Ruta . "ConsultaDB.class.php");

session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);

$Registro = utf8_decode("Modificación de la Generacion" . $Descripcion);
$Modificar = new ModificacionDB($_SESSION['usuario_id'], $_SESSION['IP'], "Modificar Generacion", $Registro);

if (empty($_POST['m_fk_iniciomes']) || empty($_POST['m_fk_inicioanios']) || empty($_POST['m_fk_finmeses']) || empty($_POST['m_fk_finanios']) ) {
    echo "2|Usted no ha llenado todos los campos";    
}else {
      
        $resultModificar = $Modificar->ModDatosGeneraciones($Descripcion, $m_fk_iniciomes, $m_fk_inicioanios, $m_fk_finmeses, $m_fk_finanios, $pk_generacion);
        if ($resultModificar){        
            echo "1|La Generacion se Guardo Correctamente";

         } else {
             echo "2|Error al Guardar";
         }
    exit;
}
    

?>


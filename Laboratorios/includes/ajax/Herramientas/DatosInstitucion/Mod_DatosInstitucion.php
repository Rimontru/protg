<?php

$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . "ModificacionDB.class.php");
require($Ruta . "ConsultaDB.class.php");

session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);

$Registro = utf8_decode("Modificación de la Institucion" . $m_clave);
$Modificar = new ModificacionDB($_SESSION['usuario_id'], $_SESSION['IP'], "Modificar Institucion", $Registro);

if (empty($_POST['m_nombre']) || empty($_POST['m_apodoInstitucion']) || empty($_POST['m_lema']) || empty($_POST['m_clave']) || empty($_POST['m_direccion']) || empty($_POST['m_coloniafracc']) || empty($_POST['m_telefono']) || empty($_POST['m_fechaincorporacion']) || empty($_POST['m_registro'])  || empty($_POST['m_regimen']) || empty($_POST['m_nooficio']) || empty($_POST['m_paginaweb'])) {
    echo "2|Usted no ha llenado todos los campos";    
}else {
      
        $resultModificar = $Modificar->ModDatosInstitucion($m_coloniafracc, $m_nombre, $m_apodoInstitucion, $m_clave, $m_direccion, $m_telefono, $m_fechaincorporacion, $m_nooficio, $m_registro, $m_regimen, $m_paginaweb, $m_lema, $pk_escuela);
        if ($resultModificar){        
            echo "1|La Institucion se Guardo Correctamente";

         } else {
             echo "2|Error al Guardar";
         }
    exit;
}
    

?>


<?php
$Ruta = "../../";
require($Ruta . "Config.class.php");
require($Ruta . "ModificacionDB.class.php");
require($Ruta . "ConsultaDB.class.php");

session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);
$fk_laboratorios = $_SESSION['fk_laboratorios'];

$Consulta = new ConsultaDB;


$Registro = utf8_decode("Se modificel material con ID: ". $Pk_material);
$Modificar = new ModificacionDB($_SESSION['usuario_id'], $_SESSION['IP'], "Modificar alumnos", $Registro);


if (empty($_POST['DescripcionMaterial']) || empty($_POST['Fk_TipoMaterial']) || empty($_POST['Fk_TipoMaterial'])) {
    echo "2|Usted no ha llenado todos los campos";    
}else {

    
    $result = $Modificar->ModificarMateriales($Pk_material, $fk_laboratorios, $fk_clasematerial, $DescripcionMaterial, $CantidadMaterial, $MedidasMaterial, $Fk_TipoMaterial, $MarcaMaterial, $Fk_EstadoMaterial, $ObservacionesMaterial, $Almacenado, $Uso, $fk_frecuenciauso, $NumeroInventario, $Fk_UnidadMedida);
    if ($result){        
        
        
            echo "1|Se Guardo Correctamente |".$result;
      
        

    } else {
        echo "2|Error al Guardar ".$result;
    }
   
    exit;
}//fin del else empty
?>
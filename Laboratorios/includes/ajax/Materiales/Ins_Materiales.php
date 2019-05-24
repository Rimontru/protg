<?php
$Ruta = "../../";
require($Ruta . "Config.class.php");  # Cargar datos conexion y otras variables.
require($Ruta . "InsertarDB.class.php");
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisValidaciones.class.php");

session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);
$fk_laboratorios = $_SESSION['fk_laboratorios'];

$Consulta = new ConsultaDB;


$Registro = utf8_decode("Nuevo Material: ". $DescripcionMaterial);
$Insertar = new InsertarDB($_SESSION['usuario_id'], $_SESSION['IP'], "Alta Material", $Registro);



if (empty($_POST['DescripcionMaterial']) || empty($_POST['Fk_TipoMaterial']) || empty($_POST['Fk_TipoMaterial'])) {
    echo "2|Usted no ha llenado todos los campos";    
}else {

    $result = $Insertar->InsMaterial($fk_laboratorios, $fk_clasematerial, $DescripcionMaterial, $CantidadMaterial, $MedidasMaterial, $Fk_TipoMaterial, $MarcaMaterial, $Fk_EstadoMaterial, $ObservacionesMaterial, $Almacenado, $Uso, $fk_frecuenciauso, $NumeroInventario, $Fk_UnidadMedida);
    if ($result){        
        
        
            echo "1|Se Guardo Correctamente";
      
        

    } else {
        echo "2|Error al Guardar";
    }
   
    exit;
}//fin del else empty
?>
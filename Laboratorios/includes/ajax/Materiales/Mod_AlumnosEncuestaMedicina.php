<?php
$Ruta = "../../";
require($Ruta . "Config.class.php");
require($Ruta . "ModificacionDB.class.php");
require($Ruta . "ConsultaDB.class.php");

session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);

$Consulta = new ConsultaDB;


$Registro = utf8_decode("Se modificaron los datos del alumno con matricula: ". $matricula);
$Modificar = new ModificacionDB($_SESSION['usuario_id'], $_SESSION['IP'], "Modificar alumnos", $Registro);


if (empty($_POST['nombre']) || empty($_POST['apaterno']) || empty($_POST['amaterno'])) {
    echo "2|Usted no ha llenado todos los campos";    
}else {

    
     $fechaSQL = explode("/", $FechaNacimiento);
    $FechaNacimiento = $fechaSQL[2] . "-" . $fechaSQL[1] . "-" . $fechaSQL[0];

    
    $result = $Modificar->ModificarDatosAlumnosEncuestaMedicina($nombre, $apaterno, $amaterno, $direccion, $correo, $fk_genero, $telefonofijo, $telefonocelular, $v_coloniafracc, $codigopostal, $FechaNacimiento,$pk_alumno);
    if ($result){        
        
        
            echo "1|Se Guardo Correctamente |".$result;
      
        

    } else {
        echo "2|Error al Guardar ".$result;
    }
   
    exit;
}//fin del else empty
?>
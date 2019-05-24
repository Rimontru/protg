<?php
$Ruta = "../../";
require($Ruta . "Config.class.php");  # Cargar datos conexion y otras variables.
require($Ruta . "InsertarDB.class.php");
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisValidaciones.class.php");

session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);

$Consulta = new ConsultaDB;


$Registro = utf8_decode("Nuevo Alumno matricula: ". $matricula);
$Insertar = new InsertarDB($_SESSION['usuario_id'], $_SESSION['IP'], "Alta Alumno", $Registro);

if(empty($matricula)){
   echo "2|Ingrese la Matricula.";    
   exit();
}



    $ResultCedula = $Consulta->ConsultaDatosAlumnosPorMatricula(trim($matricula));
    $NumRow = mysql_num_rows($ResultCedula);
    if ($NumRow>=1) {
          echo "2|Error: El Alumno ya existe en la base de datos. <br> Matricula: ".$matricula;    
          exit();
    }



if (empty($_POST['nombre']) || empty($_POST['apaterno']) || empty($_POST['amaterno'])) {
    echo "2|Usted no ha llenado todos los campos";    
}else {

    if($FechaNacimiento==""){
       
           $FechaNacimientoLista = "0000-00-00";

        
    }else{
          $fechaSQL = explode("/", $FechaNacimiento);
            $FechaNacimientoLista = $fechaSQL[2] . "-" . $fechaSQL[1] . "-" . $fechaSQL[0];

    }
  
    
    $result = $Insertar->InsAlumnos($matricula, $nombre, $apaterno, $amaterno, $direccion, $curp, $FechaNacimientoLista, $correo, $fk_genero, $telefonofijo, $telefonocelular, $v_coloniafracc, $codigopostal, $fk_carreras, $fk_nivelestudio, $fk_modalidad, $fk_turnos, $planEstudios, $fk_generacion, $letraPromedio, $promedio, $generacionSecre, $generacionNumero);
    if ($result){        
        
        
            echo "1|Se Guardo Correctamente";
      
        

    } else {
        echo "2|Error al Guardar";
    }
   
    exit;
}//fin del else empty
?>
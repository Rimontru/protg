<?php
$Ruta = "../../";
require($Ruta . "Config.class.php");
require($Ruta . "ModificacionDB.class.php");
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisValidaciones.class.php");


session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);

$Consulta = new ConsultaDB;
$Validator = new MisValidaciones;


$Registro = utf8_decode("Se modificaron los datos del alumno con matricula: ". $matricula);
$Modificar = new ModificacionDB($_SESSION['usuario_id'], $_SESSION['IP'], "Modificar alumnos", $Registro);


if (empty($_POST['nombre']) || empty($_POST['apaterno']) || empty($_POST['amaterno'])) {
    echo "2|Usted no ha llenado todos los campos";    
}else {

 if($FechaNacimiento==""){
       
           $FechaNacimientoLista = "0000-00-00";

        
    }else{
          $fechaSQL = explode("/", $FechaNacimiento);
            $FechaNacimientoLista = $fechaSQL[2] . "-" . $fechaSQL[1] . "-" . $fechaSQL[0];

    }



    if ( !empty($_POST['noCedula']) )
        if ( $Validator::is_cedula_prof(trim($_POST['noCedula'])) )
            true;
        else
            die("2|Error al validar el numero de cedula.");
    else
        true;
    if(
    !empty($_POST['institucionProcedencia']) ||
    !empty($_POST['f_inicio_antecedente']) ||
    !empty($_POST['f_fin_antecedente']) ||
    !empty($_POST['f_inicio_car']) ||
    !empty($_POST['f_fin_car'])
    )
    {
    if ( $Validator::is_procedencia(trim($_POST['institucionProcedencia'])) )
        if ( $Validator::is_mm_aaaa(trim($_POST['f_inicio_antecedente'])) )
            if ( $Validator::is_mm_aaaa(trim($_POST['f_fin_antecedente'])) )
                if ( $Validator::is_mm_aaaa(trim($_POST['f_inicio_car'])) )
                    if ( $Validator::is_mm_aaaa(trim($_POST['f_fin_car'])) )
                            true;
                    else
                        die("2|Error al validar el formato de fecha del fin de carrera.");
                else
                    die("2|Error al validar el formato de fecha del inicio de carrera.");
            else
                die("2|Error al validar el formato de fecha del fin del antecedente escolar.");
        else
            die("2|Error al validar el formato de fecha del inicio del antecedente escolar.");
    else
        die("2|Error al validar el nombre de la procedencia escolar.");
    }
// $matricula_desc=$matricula;
    
    $result = $Modificar->ModificarDatosAlumnos($nombre, $apaterno, $amaterno, $direccion, $curp, $correo, $fk_genero, $telefonofijo, $telefonocelular, $v_coloniafracc, $codigopostal, $fk_carreras, $fk_nivelestudio, $fk_modalidad, $fk_turnos, $planEstudios, $fk_generacion, $letraPromedio, $promedio, $generacionNumero, $FechaNacimientoLista, $matricula, $pk_alumno, $f_inicio_car, $f_fin_car, $institucionProcedencia, $f_inicio_antecedente, $f_fin_antecedente, $noCedula, $entidad_federativa, $nivel_escolar);
    if ($result){        
        
        
            echo "1|Se Guardo Correctamente |".$result;
      
        

    } else {
        echo "2|Error al Guardar ".$result;
    }
   
    exit;
}//fin del else empty
?>

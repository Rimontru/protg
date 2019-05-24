<?php
$Ruta = "../../../";
require($Ruta . "Config.class.php");  # Cargar datos conexion y otras variables.
require($Ruta . "InsertarDB.class.php");
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisValidaciones.class.php");

session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);

error_reporting(0);

$Consulta = new ConsultaDB;
$Validator = new MisValidaciones;


$Registro = utf8_decode("Nueva Toma de Protesta e Insertamos los datos del alumno mediante una actualizacion al registro (la curp y el apartado del antedente escolar) matricula: ". $matricula);
$Insertar = new InsertarDB($_SESSION['usuario_id'], $_SESSION['IP'], "Alta Toma de Protesta", $Registro);

/*$Registro2 = utf8_decode("Insertamos los datos del alumno mediante una actualizacion al registro (la curp y el apartado del antedente escolar) : ". $matricula);
$Modificar = new ModificacionDB($_SESSION['usuario_id'], $_SESSION['IP'], "Toma Protesta", $Registro2);
*/

if(empty($matricula)){
   echo "2|Ingrese la Matricula.";
   exit();
}



//    $ResultCedula = $Consulta->ConsultaDatosAlumnosPorMatricula(trim($matricula));
//    $NumRow = mysql_num_rows($ResultCedula);
//    if ($NumRow>=1) {
//          echo "2|Error: El Alumno ya existe en la base de datos. <br> Matricula: ".$matricula;
//          exit();
//    }

$resultset = $Consulta->ConDerechoPromPorAlumno($_POST['pk_alumno']);
$derecho = @mysql_fetch_assoc($resultset);




if (
    empty($_POST['FechaTomaProtesta'])
    && empty($_POST['hora'])
    && empty($_POST['curp'])
    && empty($_POST['f_inicio_car'])
    && empty($_POST['f_fin_car'])
    && empty($_POST['institucionProcedencia'])
    && empty($_POST['f_inicio_antecedente'])
    && empty($_POST['f_fin_antecedente'])
    && empty($_POST['entidad_federativa'])
    && empty($_POST['nivel_escolar'])

) {
    echo "2|Usted no ha llenado todos los campos";
} else {


    if ( isset($_POST['curp']) && !empty($_POST['curp']) )
        if ( $Validator::is_curp(trim($_POST['curp'])) )
            true;
        else
            die("2|Error al validar el curp del alumno.");
    else{
        $resultCurp = $Consulta->ConCheckTieneCURP($_POST['pk_alumno']);
        $curpDB = @mysql_fetch_assoc($resultCurp);
        $curp = $curpDB['curp'];
    }


    if ( !empty($_POST['noCedula']) )
        if ( $Validator::is_cedula_prof(trim($_POST['noCedula'])) )
            true;
        else
            die("2|Error al validar el numero de cedula.");
    else
        true;

    if ( ($_POST['entidad_federativa'])>0 &&  ($_POST['nivel_escolar'])>0 )
        true;
    else
        die("2|Error verifique los campos de seleccion.");


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


    //fechaaplicacion
    //DATE_FORMAT(fecha, '%d/%m/%y') AS fecha
    //convertir fechas a tipo date mysql
    $fechaSQL = explode("/", $FechaTomaProtesta);
    $FechaTomaProtestaLista = $fechaSQL[2] . "-" . $fechaSQL[1] . "-" . $fechaSQL[0];

    // Insertamos los datos del alumno mediante una actualizacion al registro (la curp y el apartado del antedente escolar).
    if ( $Insertar->ModCurpInTomaProtesta( $pk_alumno, $curp, $f_inicio_car, $f_fin_car, $institucionProcedencia, $f_inicio_antecedente, $f_fin_antecedente, $noCedula, $entidad_federativa, $nivel_escolar) ) :
        if ($derecho['derechoPromedio'] == 1 && $fk_titulacion==2){
            $result = $Insertar->InsTomaProtesta($pk_alumno, $FechaTomaProtestaLista, $hora, $salon, 2, $nombreTesis, $Fk_Duracion, $presidente, $secretario, $vocal, $suplente, $observacion);
            if ($result){
                echo "1|Se Guardo Correctamente";
            } else {
                echo "2|Error al Guardar";
            }

        } else if ( ($derecho['derechoPromedio'] == 3 || $derecho['derechoPromedio'] == 4 || $derecho['derechoPromedio'] == 5) && $fk_titulacion != 2){

            $result = $Insertar->InsTomaProtesta($pk_alumno, $FechaTomaProtestaLista, $hora, $salon, $fk_titulacion, $nombreTesis, $Fk_Duracion, $presidente, $secretario, $vocal, $suplente, $observacion);
            if ($result){
                echo "1|Se Guardo Correctamente";
            } else {
                echo "2|Error al Guardar";
            }

        }else
             echo "2|Error en la opción de titulación en referencia al derecho por promedio del alumno";
    else:
        echo "2|Error al Guardar";
    endif;

    exit;
}//fin del else empty
?>
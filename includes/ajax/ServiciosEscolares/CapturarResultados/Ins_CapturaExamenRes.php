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


$Registro = utf8_decode("Captura de Resultados del Examen Institucional ");
$Insertar = new InsertarDB($_SESSION['usuario_id'], $_SESSION['IP'], "Captura Examen Inst", $Registro);





$con = mysql_connect( 'localhost', 'root', 'iesch-red' );
$db = mysql_select_db( 'db_protgv3' , $con );
   
 foreach( $_POST["id"] AS $id ) {

        $a1 = mysql_real_escape_string( $_POST["a1"][$id] );
        $a2 = mysql_real_escape_string( $_POST["a2"][$id] );
        $a3 = mysql_real_escape_string( $_POST["a3"][$id] );
        $a4= mysql_real_escape_string( $_POST["a4"][$id] );
        $a5 = mysql_real_escape_string( $_POST["a5"][$id] );
        
        $a6 = mysql_real_escape_string( $_POST["a6"][$id] );
        $a7 = mysql_real_escape_string( $_POST["a7"][$id] );
        $a8 = mysql_real_escape_string( $_POST["a8"][$id] );
        $a9= mysql_real_escape_string( $_POST["a9"][$id] );
        $a10 = mysql_real_escape_string( $_POST["a10"][$id] );
        $a11 = mysql_real_escape_string( $_POST["a11"][$id] );
        $update = " UPDATE tbl_resultadoexamen SET a1='$a1', a2='$a2', a3='$a3', a4='$a4',  a5='$a5', a6='$a6', a7='$a7', a8='$a8', a9='$a9', a10='$a10', a11='$a11' WHERE fk_alumno='$id'";
        
        
        mysql_query( $update ) or die( mysql_error() );
         echo "1|Folios Guardados Correctamente";
       
       
    }





?>


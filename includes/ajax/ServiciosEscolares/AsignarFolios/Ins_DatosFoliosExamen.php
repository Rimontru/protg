<?php
$Ruta = "../../../";
require($Ruta . "Config.class.php");  # Cargar datos conexion y otras variables.
require($Ruta . "InsertarDB.class.php");
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisValidaciones.class.php");

session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);
//error_reporting(0);
$Consulta = new ConsultaDB;


$Registro = utf8_decode("Asignacion de Folios: ");
$Insertar = new InsertarDB($_SESSION['usuario_id'], $_SESSION['IP'], "Alta Folios", $Registro);





$con = mysql_connect( 'localhost', 'root', 'iesch-red' );
$db = mysql_select_db( 'db_protgv3' , $con );
   


    foreach( $_POST["id"] AS $id ) {

        $folioinstitucional = mysql_real_escape_string( $_POST["folioinstitucional"][$id] );
        $update = " UPDATE tbl_exainstitucional SET folioInstitucional = '$folioinstitucional' WHERE
				  Pk_ExamenInstitucional =$id";
        
        
        mysql_query( $update ) or die( mysql_error() );
         echo "1|Folios Guardados Correctamente";

    }





?>


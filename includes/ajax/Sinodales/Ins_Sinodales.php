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


$Registro = utf8_decode("Nuevo Sinodal Nombre: ". $v_nombre);
$Insertar = new InsertarDB($_SESSION['usuario_id'], $_SESSION['IP'], "Alta Sinodal", $Registro);

if(empty($Carreras)){
   echo "2|Seleccione almenos una Carrera.";    
   exit();
}



    //$ResultCedula = $Consulta->ConsultaDatosSinodalesporCedulaProfesional(trim($v_cedula));
    //$NumRow = mysql_num_rows($ResultCedula);
    //if ($NumRow>=1) {
      //    echo "2|Error: El Sinodal ya existe en la base de datos. <br> Cedula Profesional: ".$v_cedula;    
        //  exit();
    //}



if (empty($_POST['v_nombre']) || empty($_POST['v_cedula']) || empty($_POST['fk_nivelestudio'])) {
    echo "2|Usted no ha llenado todos los campos";    
}else {
    $foto="Not Found!";
    $result = $Insertar->InsSinodales($v_nombre, $v_cedula, $fk_nivelestudio, $numEmpleado, $cel, $nss, $direccion, $curp, $rfc, $foto);
    if ($result){        
        
        //validar antes si ya esta registrado el sinodal
        // <- 
        // carreras 1,2,
        //$count = substr_count($Carreras, ',');

        
        $separador = array(',');
        $Carreras = str_replace($separador,'*',$Carreras);
        $Carreras = str_replace(' ','',$Carreras); // suprimiendo espacios
        $ary = explode('*',$Carreras);
        for($i=0;$i<count($ary);$i++)
        $ary[$i] = str_replace('"','',$ary[$i]);
        //print_r($ary); 
        
        foreach ($ary as $Valor) {
           $resultRelacion = $Insertar->Insrel_profesorcarrera($Valor, $result);
          }//fin del foreach
        

            echo "1|Se Guardo Correctamente |".$result;
      
        

    } else {
        echo "2|Error al Guardar ".$result;
    }
   
    exit;
}//fin del else empty
?>
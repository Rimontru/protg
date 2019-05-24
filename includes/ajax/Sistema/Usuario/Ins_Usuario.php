<?php
$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . "InsertarDB.class.php");
require($Ruta . "ConsultaDB.class.php");


session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);

//error_reporting(0);

$Obras = new InsertarDB($_SESSION['usuario_id'], $_SESSION['IP'], "Modulo", "Alta Usuario ".$NombreUsuario);
$Verificar = new ConsultaDB;
$verificarUsuarios = new ConsultaDB;
extract($_POST);

$idModCat="";
$KeyPermiso="";
$KeyModulo="";   
$ArrayJuntado="";  
$Indice = "";
$Valor = "";

if(empty($Modulo)){
    echo "2|Error Debe tener asignado al menos un permiso";
    exit();
}


if(count(array_unique($Modulo))<count($Modulo))
{
    echo "2|Error tiene permisos asignados al mismo Menu";
    exit();
}

 
$res = $verificarUsuarios->ConExisteUsuario($NombreUsuario);
if ($res) {
    $row = mysql_fetch_assoc($res);
    if ($row['existe'] >= 1) {
        echo "2|El Nombre de usuario ya esta registrado, verifique";
        exit();
        mysql_free_result($res);
    }
}


if (empty($_POST['pk_trabajador']) || empty($_POST['NombreUsuario']) || empty($_POST['Password']) || empty($_POST['PasswordRepite'])) {
    echo "2|Usted no a llenado todos los campos";
     exit();
} else if (strcmp($_POST['Password'], $_POST['PasswordRepite']) != 0) {
    echo "2|Las Contrase&ntilde;as no coinciden";
    exit();
} else {
    $result = $Verificar->ConExisteUsuario(trim($NombreUsuario));
    if ($result) {
        $row = mysql_fetch_assoc($result);
        if ($row['existe'] >= 1) {
            echo "2|El usuario ya esta registrado, verifique";
            mysql_free_result($result);
        } else {
            $Password = md5($Password);
            $Tipo_User='Normal';
            $consultaInsertar = $Obras->InsUsuarios($pk_trabajador, trim($NombreUsuario), trim($Password), $Tipo_User);
            if ($consultaInsertar) {
                //insertamos los permisos
                $idUsuarioObtenido=$consultaInsertar;
                foreach ($Modulo as $Indice => $Valor) {
                   $KeyModulo= $Modulo[$Indice];
                   $KeyPermiso= $Permiso[$Indice];
                   
                   $resultLogPer=$Obras->InsRel_Login_Permisos($idUsuarioObtenido, $KeyPermiso,$KeyModulo);
              
                   
                  }//fin del foreach
                //home
                $resultLogPer=$Obras->InsRel_Login_Permisos($idUsuarioObtenido, "1",'1');

                echo "1|Registro Guardado Exitosamente ";
            } else {
           
                echo "2|Error al Guardar Registro";
            }
        }
    }//fin del if conExisteUsuario
    exit;
}//fin else comparacion cadenas
?>
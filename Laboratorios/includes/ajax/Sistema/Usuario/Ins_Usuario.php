<?php
$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . "InsertarDB.class.php");
require($Ruta . "ConsultaDB.class.php");

session_name("SAHE");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);

//error_reporting(0);

$Obras = new InsertarDB($_SESSION['usuario_id'], $_SESSION['IP'], "Modulo", "Alta Usuario ".$Usuario);
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
    echo "2|Error Debe tener asignado almenos un permiso";
    exit();
}


if(count(array_unique($Modulo))<count($Modulo))
{
    echo "2|Error tiene permisos asignados al mismo Menu";
    exit();
}

 
$res = $verificarUsuarios->ConExisteUsuario($Usuario);
if ($res) {
    $row = mysql_fetch_assoc($res);
    if ($row['existe'] >= 1) {
        echo "2|El Nombre de usuario ya esta registrado, verifique";
        exit();
        mysql_free_result($res);
    }
}


if (empty($_POST['Nombre']) || empty($_POST['Correo']) || empty($_POST['Fk_Empresa']) || empty($_POST['Usuario']) || empty($_POST['Password']) || empty($_POST['PasswordRepite'])) {
    echo "2|Usted no a llenado todos los campos";
     exit();
} else if (strcmp($_POST['Password'], $_POST['PasswordRepite']) != 0) {
    echo "2|Las Contrase&ntilde;as no coinciden";
    exit();
} else {
    $result = $Verificar->ConExisteUsuarioCompleto(trim($Nombre), trim($Fk_Empresa));
    if ($result) {
        $row = mysql_fetch_assoc($result);
        if ($row['existe'] >= 1) {
            echo "2|El usuario ya esta registrado, verifique";
            mysql_free_result($result);
        } else {
            $Password = md5($Password);
            $consultaInsertar = $Obras->InsUsuarios(trim($Usuario), trim($Password), trim($Nombre), $Fk_Empresa, $Correo);
            if ($consultaInsertar) {
                //insertamos los permisos
                $idUsuarioObtenido=$consultaInsertar;
                foreach ($Modulo as $Indice => $Valor) {
                   $KeyModulo= $Modulo[$Indice];
                   if($KeyModulo=="1"){
                       $resultLogPer=$Obras->InsRel_Login_Permisos($idUsuarioObtenido, "1",'1');
                       $resultLogPer=$Obras->InsRel_Login_Permisos($idUsuarioObtenido, "2",'1');
                   }
                    if($KeyModulo=="2"){
                       $resultLogPer=$Obras->InsRel_Login_Permisos($idUsuarioObtenido, "3",'2');
                       $resultLogPer=$Obras->InsRel_Login_Permisos($idUsuarioObtenido, "4",'2');
                   }
                    if($KeyModulo=="3"){
                       $resultLogPer=$Obras->InsRel_Login_Permisos($idUsuarioObtenido, "5",'3');
                   }
                   if($KeyModulo=="4"){
                       $resultLogPer=$Obras->InsRel_Login_Permisos($idUsuarioObtenido, "6",'4');
                   }
                   
                  }//fin del foreach
                //home
                $resultLogPer=$Obras->InsRel_Login_Permisos($idUsuarioObtenido, "7",'5');

                echo "1|Registro Guardado Exitosamente";
            } else {
           
                echo "2|Error al Guardar Registro";
            }
        }
    }//fin del if conExisteUsuario
    exit;
}//fin else comparacion cadenas
?>
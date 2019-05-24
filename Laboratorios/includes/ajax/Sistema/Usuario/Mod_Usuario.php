<?php
$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . "ModificacionDB.class.php");
require($Ruta . "ConsultaDB.class.php");

session_name("SAHE");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);


$Obras = new ModificacionDB($_SESSION['usuario_id'], $_SESSION['IP'], "Modulo", "Modificacion al Usuario ".$Usuario);
$Verificar = new ConsultaDB;
$verificarUsuarios = new ConsultaDB;

$Insertar = new InsertarDB($_SESSION['usuario_id'], $_SESSION['IP'], "Modulo", "Modificacion Permisos ".$Usuario);

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
}else if($banderita==1){

            if (empty($_POST['Nombre']) || empty($_POST['Fk_Empresa']) || empty($_POST['Usuario']) || empty($_POST['Password']) || empty($_POST['PasswordRepite'])) {
                echo "2|Usted no a llenado todos los campos";
            } else if (strcmp($_POST['Password'], $_POST['PasswordRepite']) != 0) {
                echo "2|Las Contrase&ntilde;as no coinciden";
                exit();
            } else {
                   $Password = md5($Password);
                   $changePass=", Password='$Password'";
                    $Obras->ModUsuarios($Usuario, $Nombre, $Fk_Empresa, $Correo, $Pk_Usuario_Login, $changePass, $Status_User);

                    $Obras->Eli_Relacion_Usuarios($Pk_Usuario_Login);
                     //insertamos los permisos
//                    $idUsuarioObtenido=$consultaInsertar;
                     foreach ($Modulo as $Indice => $Valor) {
                       $KeyModulo= $Modulo[$Indice];
                       if($KeyModulo=="1"){
                           $resultLogPer=$Insertar->InsRel_Login_Permisos($Pk_Usuario_Login, "1",'1');
                           $resultLogPer=$Insertar->InsRel_Login_Permisos($Pk_Usuario_Login, "2",'1');
                       }
                        if($KeyModulo=="2"){
                           $resultLogPer=$Insertar->InsRel_Login_Permisos($Pk_Usuario_Login, "3",'2');
                           $resultLogPer=$Insertar->InsRel_Login_Permisos($Pk_Usuario_Login, "4",'2');
                       }
                        if($KeyModulo=="3"){
                           $resultLogPer=$Insertar->InsRel_Login_Permisos($Pk_Usuario_Login, "5",'3');
                       }
                       if($KeyModulo=="4"){
                           $resultLogPer=$Insertar->InsRel_Login_Permisos($Pk_Usuario_Login, "6",'4');
                       }

                      }//fin del foreach
                    //home
                    $resultLogPer=$Insertar->InsRel_Login_Permisos($Pk_Usuario_Login, "7",'5');

                    echo "1|Registro Guardado Exitosamente ";

                exit;
            }//fin else comparacion cadenas

}


if(count(array_unique($Modulo))<count($Modulo))
{
    echo "2|Error tiene permisos asignados al mismo Menu";
    exit();
}else if($banderita==2){
            if (empty($_POST['Nombre']) || empty($_POST['Fk_Empresa']) || empty($_POST['Usuario'])) {
                echo "2|Usted no a llenado todos los campos";
            } else {
                    $changePass="";
                    $Obras->ModUsuarios($Usuario, $Nombre, $Fk_Empresa, $Correo, $Pk_Usuario_Login,$changePass, $Status_User);

                    $Obras->Eli_Relacion_Usuarios($Pk_Usuario_Login); 
                    
                    //insertamos los permisos
//                    $idUsuarioObtenido=$Pk_Usuario_Login;
                    foreach ($Modulo as $Indice => $Valor) {
                       $KeyModulo= $Modulo[$Indice];
                       if($KeyModulo=="1"){
                           $resultLogPer=$Insertar->InsRel_Login_Permisos($Pk_Usuario_Login, "1",'1');
                           $resultLogPer=$Insertar->InsRel_Login_Permisos($Pk_Usuario_Login, "2",'1');
                       }
                        if($KeyModulo=="2"){
                           $resultLogPer=$Insertar->InsRel_Login_Permisos($Pk_Usuario_Login, "3",'2');
                           $resultLogPer=$Insertar->InsRel_Login_Permisos($Pk_Usuario_Login, "4",'2');
                       }
                        if($KeyModulo=="3"){
                           $resultLogPer=$Insertar->InsRel_Login_Permisos($Pk_Usuario_Login, "5",'3');
                       }
                       if($KeyModulo=="4"){
                           $resultLogPer=$Insertar->InsRel_Login_Permisos($Pk_Usuario_Login, "6",'4');
                       }

                      }//fin del foreach
                    //home
                    $resultLogPer=$Insertar->InsRel_Login_Permisos($Pk_Usuario_Login, "7",'5');

                    echo "1|Registro Guardado Exitosamente ";


                exit;
            }//fin else comparacion cadenas
            
}
?>

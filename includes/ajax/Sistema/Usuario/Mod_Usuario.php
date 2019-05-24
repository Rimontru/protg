<?php
$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . "ModificacionDB.class.php");
require($Ruta . "ConsultaDB.class.php");

session_name("PROTG2");                     // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);


$Obras = new ModificacionDB($_SESSION['usuario_id'], $_SESSION['IP'], "Modulo", "Modificacion al Usuario ".$Nombre);
$Verificar = new ConsultaDB;
$verificarUsuarios = new ConsultaDB;

$Insertar = new InsertarDB($_SESSION['usuario_id'], $_SESSION['IP'], "Modulo", "Modificacion Permisos ".$Nombre);

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


if(count(array_unique($Permiso))<count($Permiso))
{
    echo "2|Error tiene permisos asignados al mismo Menu";
    exit();
}else if($banderita==1){

            if (empty($_POST['Nombre']) || empty($_POST['Pk_Usuario_Login'])) {
                echo "2|Usted no a llenado todos los campos";
            } else if (strcmp($_POST['Password'], $_POST['PasswordRepite']) != 0) {
                echo "2|Las Contrase&ntilde;as no coinciden";
                exit();
            } else {
                   $Password = md5($Password);
                   $changePass=", Password='$Password'";
                   $Obras->ModUsuarios($Nombre, $activo_usuario, $Pk_Usuario_Login, $changePass);

                    $Obras->Eli_Relacion_Usuarios($Pk_Usuario_Login);
                     //insertamos los permisos
                        foreach ($Modulo as $Indice => $Valor) {
                                $KeyModulo= $Modulo[$Indice];
                                $KeyPermiso= $Permiso[$Indice];

                                $resultLogPer=$Obras->InsRel_Login_Permisos($Pk_Usuario_Login, $KeyPermiso,$KeyModulo);


                               }//fin del foreach
                        //home
                        $resultLogPer=$Obras->InsRel_Login_Permisos($Pk_Usuario_Login, "1",'1');


                    echo "1|Registro Guardado Exitosamente ";

                exit;
            }//fin else comparacion cadenas

}


if(count(array_unique($Permiso))<count($Permiso))
{
    echo "2|Error tiene permisos asignados al mismo Menu";
    exit();
}else if($banderita==2){
            if (empty($_POST['Nombre']) || empty($_POST['Pk_Usuario_Login'])) {
                echo "2|Usted no a llenado todos los campos";
            } else {
                    $changePass="";
                    $Obras->ModUsuarios($Nombre, $activo_usuario, $Pk_Usuario_Login, $changePass);

                    $Obras->Eli_Relacion_Usuarios($Pk_Usuario_Login); 
                    
                    //insertamos los permisos
//                    $idUsuarioObtenido=$Pk_Usuario_Login;
                        foreach ($Modulo as $Indice => $Valor) {
                                $KeyModulo= $Modulo[$Indice];
                                $KeyPermiso= $Permiso[$Indice];

                                $resultLogPer=$Obras->InsRel_Login_Permisos($Pk_Usuario_Login, $KeyPermiso,$KeyModulo);


                               }//fin del foreach
                        //home
                        $resultLogPer=$Obras->InsRel_Login_Permisos($Pk_Usuario_Login, "1",'1');

                    echo "1|Registro Guardado Exitosamente ";


                exit;
            }//fin else comparacion cadenas
            
}
?>

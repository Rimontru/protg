<?php
$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");

$Obras = new ConsultaDB;
$Cadena = "";
$idPermisos="";
$idModulo="";


extract($_POST);


if (isset($verificar)) {
    $result = $Obras->ConExisteUsuario($nombreUsuario);
    if ($result) {
        $row = mysql_fetch_assoc($result);
        if ($row['existe'] >= 1) {
            echo "2|El Nombre de usuario ya esta registrado, verifique";
            mysql_free_result($result);
        }
    }
} else {


    if (empty($_POST['Usuario'])) {
        echo "2|Usted no ha seleccionado al usuario";
    } else {
         $result = $Obras->ConExisteUsuario($Usuario);
        if ($result) {
            $row = mysql_fetch_assoc($result);
            if ($row['existe'] < 1) {
                echo "2|El Nombre de usuario no Existe, verifique";
                exit();
                mysql_free_result($result);
            }
        }
        
        
        if ($Usuario=="Administrador") {
            echo "2|No es posible modificar el Administrador.";
            exit();
        } 
    
    
        
        $Result = $Obras->conUsuarioDatos($Usuario);
        if ($Result) {         
            
            while($row =  mysql_fetch_assoc($Result)){  
		$idPermisos.=$row["Fk_CatMenu"]."$";                 
            }
             mysql_free_result($Result);
            
            $ResultDatos = $Obras->conUsuarioDatos($Usuario);  
            $row = mysql_fetch_assoc($ResultDatos);
            echo $row['NombreUsuarioNormal'] . "|" . "x" . "|" . "y" . "|" . $row['Fk_Empresa'] . "|" . $row['Email'] . "|" . $row['Usuario'] . "|" . $row['Password'] ."|"."x"."|".$idPermisos. "|" . $row['Pk_Usuario_Login']. "|" . $row['Status_User'];
           
            mysql_free_result($ResultDatos);
            
            
        } else {
            echo "2|Error al Consultar";
        }
        echo $Cadena;
        exit;
    }
}
?>
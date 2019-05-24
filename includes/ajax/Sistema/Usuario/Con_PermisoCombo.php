<?php
$Ruta = "../../../";
require($Ruta."Config.class.php");  # Cargar datos conexion y otras variables.
require($Ruta."DB.class.php");
require($Ruta."ConsultaDB.class.php");
//creamos el objeto $objempleados de la clase cEmpleado
extract($_POST);

$Obras =new ConsultaDB;
$Activo = "1";
$Permisos = '';
$PermisosCombo=' <select id="Permiso" name="Permiso[]" tabindex="10" class=":required"><option value="">Elige un Permiso</option>';
$Permisos =' <select id="Permiso" name="Permiso[]"><option value="">Elige un Permiso</option>';

/*verificamos si las variables se envian*/

if(isset($llenarCombo)){
    
    
    $ResultCombo = $Obras->conCatMenu($Fk_Modulo);
    if ($ResultCombo) {
        while ($row = mysql_fetch_assoc($ResultCombo)) {
            $PermisosCombo .= "<option value='$row[idMenu]'>$row[Name]</option>";
        }
        mysql_free_result($ResultCombo);
    } else {
        $PermisosCombo = "Error en la Consulta";
    }
     $PermisosCombo .="</select>";
     echo utf8_encode($PermisosCombo);
    
}

if(isset($comboModificaciones)){
//    $consecutivo=1;
    
    $Permisos .= '<option value="">Elige un Permiso</option>';
    $ResultCombo = $Obras->conCatMenu($Fk_Modulo);
    if ($ResultCombo) {
        while ($row = mysql_fetch_assoc($ResultCombo)) {
            $Permisos .= "<option value='$row[idMenu]'>$row[Name]</option>";
        }
        mysql_free_result($ResultCombo);
    } else {
        $Permisos = "Error en la Consulta";
    }
     $Permisos .="</select>";
     echo utf8_encode($Permisos);   
    
     }
?>
         
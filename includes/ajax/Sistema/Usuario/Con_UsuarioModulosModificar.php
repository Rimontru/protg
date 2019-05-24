<?php

$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");

$Obras = new ConsultaDB;
$Cadena = "";
$idPermisos = "";
$idModulo = "";

extract($_POST);
/* Obtenemos los combos de los permisos asignados */
$Result = $Obras->conUsuarioDatos($Usuario);
$Fila = "";
$contador=2;
while ($RowCatObra = mysql_fetch_array($Result)) {

    $Fila .= "<tr id='Filas$contador'>";                      
    $Fila .= "<td><select id='Modulo$contador' name='Modulo[]'>";
    $Fila .= "<option value=''>Elige un Menu</option>";
    
    $CatPermisos = "";
    $ResultTEscuela = $Obras->ConTitulosMenus();
    while ($RowPermi = mysql_fetch_assoc($ResultTEscuela)) {
        $Alias_Archivo = utf8_encode($RowPermi['Nombre']);
       
        if ($RowCatObra['FkTituloMenu'] == $RowPermi['idTituloMenu']) {
            $CatPermisos .= '<option value="' . $RowPermi['idTituloMenu'] . '" selected>' . $Alias_Archivo . '</option>';
        } else {
            $CatPermisos .= '<option value="' . $RowPermi['idTituloMenu'] . '">' . $Alias_Archivo . '</option>';
        }
    }
    mysql_free_result($ResultTEscuela);

   $Fila .= "$CatPermisos</select></td>";
   $Fila .= "<td>";
   
   
   
    $Fila .= "<select id='Permiso$contador' name='Permiso[]'>";
    $Fila .= "<option value=''>Elige un permisukis</option>";
    
    $CatPermisos = "";
    $ResultMenucito = $Obras->conCatMenu($RowCatObra["idTituloMenu"]);
    while ($RowPermisos = mysql_fetch_assoc($ResultMenucito)) {
        $Alias_Archivo = utf8_encode($RowPermisos['Name']);
       
        if ($RowCatObra['Fk_CatMenu'] == $RowPermisos['idMenu']) {
            $CatPermisos .= '<option value="' . $RowPermisos['idMenu'] . '" selected>' . $Alias_Archivo . '</option>';
        } else {
            $CatPermisos .= '<option value="' . $RowPermisos['idMenu'] . '">' . $Alias_Archivo . '</option>';
        }
    }
    mysql_free_result($ResultMenucito);

   $Fila .="$CatPermisos</select></td>";   
   
  
   $Fila .= "  <td> <a href='' class='elimina' id='EliminarPermiso' title= 'Eliminar'><img src='assets/img/delete.png'></a></td>";
    $Fila .= "</tr>";  
   $contador=$contador+1;
}
mysql_free_result($Result);
echo $Fila;



?>
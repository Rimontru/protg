<?php
#AGREGADO: Ivan Mauricio Melo Granados
#FECHA: 21/02/13 14:02 pm         
#DESCRIPCION: Modulo que Genera el Alta de los usuarios  
$Activo = 1;
$Cadena = "";
$result = $ConsultaDB->conDepartamentos($Activo);
while ($row = mysql_fetch_assoc($result)) {
    $Cadena .= "<option value='$row[Pk_Departamento]'>$row[Departamento]</option>";
}
mysql_free_result($result);

$Permisos = "";
$resultPermisos = $ConsultaDB->ConTitulosMenus();
while ($row = mysql_fetch_assoc($resultPermisos)) {
    $Permisos .= "<option value='$row[idTituloMenu]'>".utf8_encode($row["Nombre"])."</option>";
}
mysql_free_result($resultPermisos);
?>
<script>
    $(document).ready(function(){
          $('#VerUsuariosOnlineOffline').click();        
    });
</script>
<div id="Form_Auto_Usuario">
    <h1>Usuarios Online</h1>

    <center><input style="display: none;" name='VerUsuariosOnlineOffline' id="VerUsuariosOnlineOffline" type='submit' value='ver' class='Btn_Enviar' tabindex="11"/></center>
        <br><br>
        <center>
            <div id="usuarios_online_off"></div>
        </center>
       	
</div> 
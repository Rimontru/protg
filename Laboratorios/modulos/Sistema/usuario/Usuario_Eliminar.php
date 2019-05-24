<?php
#AGREGADO: Ivan Mauricio Melo Granados
#FECHA: 21/02/13 15:03 pm         
#DESCRIPCION: Modulo que elimina las los usuarios.     
$Activo = 1;
$Cadena = "";
$result = $ConsultaDB->conUsuariosExistentes($Activo);
while ($row = mysql_fetch_assoc($result)) {
    $Cadena .= "<option value='$row[Pk_Usuario_Login]'>$row[Apellido_Paterno] $row[Apellido_Materno] $row[Nombre]</option>";
}
mysql_free_result($result);
?>
<div id="Form_Auto_Usuario">
    <h1>Eliminar Usuarios</h1>
    <form action="#" method='post' id="Usuario_Eliminar" accept-charset="utf-8">
        <label>Elija Usuario:</label>
        <select id="UsuarioId" name="UsuarioId" class=":required">
            <option value="">Elije</option>
            <?php
            echo $Cadena;
            ?>
        </select>                    
        <input name='Eliminar' type='submit' value='  Eliminar  ' class='Btn_Enviar' tabindex="2"/>
    </form> 	
</div>  <!-- Form_UnCampo -->

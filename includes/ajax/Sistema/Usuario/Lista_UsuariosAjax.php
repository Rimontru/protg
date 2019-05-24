<?php
$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisFunciones.class.php");

$Funciones = new MisFunciones();
$consult = new ConsultaDB();

session_name("SAHE");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);

//if($_SESSION['Tipo_User']=='administrador'){
////    $Fk_Empresa=$_SESSION['Fk_Empresa'];
//    $result = $consult->ConsultaClientes();
//   
//}else{
//    $Fk_Empresa=$_SESSION['Fk_Empresa'];
//    $result = $consult->ConsultaClientesxEmpresa($Fk_Empresa);
//    $clientes_row = @mysql_fetch_assoc($result);
//    $clientes_row_num = @mysql_num_rows($result);
//}



if($UsuarioDirecto=="2"){
    $Empresa_SelectUsuarios=$_SESSION['Fk_Empresa']; 
}

if($Empresa_SelectUsuarios=="1000"){
   $result = $consult->ConsultaUsuarios();
}else{
   $result = $consult->ConsultaUsuariosxEmpresa($Empresa_SelectUsuarios);
}


$clientes_row = @mysql_fetch_assoc($result);
$clientes_row_num = @mysql_num_rows($result);



if($clientes_row_num  == 0){
?>

<div class="box-content alerts">
	<div class="alert alert-error">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong></strong>No existen registros en la Base de Datos
	</div>
</div>	


<?php } else { ?>

<div class="box-content">
    <table id="Tbl_Clientes" class="table table-striped table-bordered bootstrap-datatable datatable">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Email</th>
                <th style="width: auto;">Status</th>
            </tr>
        </thead>  
		<tbody>
<?php do { ?>        
        <tr>
			<td class="center"><?php echo $Funciones->str_to_may($clientes_row['Usuario']); ?></td>
			<td class="center"><?php echo $Funciones->str_to_may($clientes_row['Nombre']); ?></td>
			<td class="center"><?php echo $Funciones->str_to_may($clientes_row['Email']); ?></td>
                        <td class="center" style="width: 170px;">               
                            <?php 
                                if($clientes_row['Status_User']=="1"){
                                    echo '<span class="label label-success">Activo</span>';
                                }else{
                                    echo '<span class="label label-important">Desactivado</span>';
                                }
                                

                            ?>
                        </td>
        </tr>
<?php } while($clientes_row = @mysql_fetch_assoc($result)); ?>	
	</tbody>
</table>      
    </div> 
<?php } ?>                      
                      
<script>
	$(document).ready(function() {
			$("#Tbl_Clientes").dataTable( { 
					"sDom": "<\'row\'<\'span8\'l><\'span8\'f>r>t<\'row\'<\'span8\'i><\'span8\'p>>", "sPaginationType": "bootstrap","oLanguage":{
						"sLengthMenu": "Mostrar _MENU_"
						}
					} );
 				} );
 </script>                
	
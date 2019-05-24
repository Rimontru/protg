<?php
$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisFunciones.class.php");

$funciones = new MisFunciones();
$consulta = new ConsultaDB();
//
//session_name("SAHE");                      // usamos la sesion de nombre definido.
//session_start();                            // Iniciamos el uso de sesiones
//extract($_POST);

//if($_SESSION['Tipo_User']=='Administrador'){
////    $Fk_Empresa=$_SESSION['Fk_Empresa'];
//    $result = $consult->ConsultaClientes();
//   
//}else{
//    $Fk_Empresa=$_SESSION['Fk_Empresa'];
//    $result = $consult->ConsultaClientesxEmpresa($Fk_Empresa);
//    $clientes_row = @mysql_fetch_assoc($result);
//    $clientes_row_num = @mysql_num_rows($result);
//}



//if($UsuarioDirecto=="2"){
//    $Empresa_SeleccionadaClientes=$_SESSION['Fk_Empresa']; 
//}
//
//if($Empresa_SeleccionadaClientes=="1000"){
//   $result = $consult->ConsultaClientes();
//}else{
//   $result = $consult->ConsultaClientesxEmpresa($Empresa_SeleccionadaClientes);
//}
//
//

 $result = $consulta->verTrabajadoresbaja();
 $user_row = @mysql_fetch_assoc($result);
 $user_row_num = @mysql_num_rows($result);

//
//
//
//
//
if($user_row_num  == 0){
?>

<div class="alert alert-dismissable alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <p>No existen registros enla base de datos.</p>
    <br />

</div>	


<?php  } else { ?>
 <div class="panel-heading">
                    <h4>Usuarios</h4>
                    <div class="options">
                        <a href="javascript:;"><i class="icon-cog"></i></a>
                        <a href="javascript:;"><i class="icon-wrench"></i></a> 
                        <a href="javascript:;" class="panel-collapse"><i class="icon-chevron-down"></i></a>
                    </div>
            </div>
 <div class="panel-body collapse in">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="exam2">
                                    <thead>
                                        <tr>
                                            <th>Clave de trabajador</th>
                                            <th>Nombre(s)</th>
                                            <th>A. Paterno</th>
                                            <th>A. Materno</th>
                                            <th>Tel/cel</th>
                                            <th>Puesto</th>
                                            <th>Area</th>
                                            <th>Edificio</th>
                                            <th style="width: 130px;">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php do { ?>        
        <tr>
            <td class="center"><?php echo $funciones->str_to_may($user_row['claveTrabajador']); ?></td>
            <td class="center"><?php echo $funciones->str_to_may($user_row['nombre']); ?></td>
            <td class="center"><?php echo $funciones->str_to_may($user_row['apaterno']); ?></td>
            <td class="center"><?php echo $funciones->str_to_may($user_row['amaterno']); ?></td>
            <td class="center"><?php echo $funciones->str_to_may($user_row['telefono']); ?></td>
            <td class="center"><?php echo $funciones->str_to_may($user_row['puestoLaboral']); ?></td>
            <td class="center"><?php echo $funciones->str_to_may($user_row['nombreCarrera']); ?></td>
            <td class="center"><?php echo $funciones->str_to_may($user_row['edificio']); ?></td>
            <td class="center" style="width: 100px;">               
                <a class="btn btn-green"  onclick="Recuperartrabajador('<?php echo $user_row['pk_rel_trbajadorescarreras'] ?>')"><i class="icon-upload-alt"></i></a>
            </td>
        </tr>
<?php  }while($user_row = @mysql_fetch_assoc($result)); 
}
?>	
           </tbody>
        </table>
    </div>
  
<script>
    $(document).ready(function() {
        $("#exam2").dataTable( { 
                "sDom": "<\'row\'<\'span8\'l><\'span8\'f>r>t<\'row\'<\'span8\'i><\'span8\'p>>", "sPaginationType": "bootstrap","oLanguage":{
                        "sLengthMenu": "Mostrar _MENU_"
                        }
        } );
   } );
 </script>      



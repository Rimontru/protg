<?php
$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisFunciones.class.php");

$Funciones = new MisFunciones();
$consult = new ConsultaDB();
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

 $result = $consult->ConsultaCarreras();
 $carrera_row = @mysql_fetch_assoc($result);
 $carrera_row_num = @mysql_num_rows($result);

//
//
//
//
//
if($carrera_row_num  == 0){
?>

<div class="alert alert-dismissable alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <p>No existen registros enla base de datos.</p>
    <br />

</div>	


<?php  } else { ?>
 <div class="panel-heading">
                    <h4>Carreras</h4>
                    <div class="options">
                        <a href="javascript:;"><i class="icon-cog"></i></a>
                        <a href="javascript:;"><i class="icon-wrench"></i></a> 
                        <a href="javascript:;" class="panel-collapse"><i class="icon-chevron-down"></i></a>
                    </div>
            </div>
 <div class="panel-body collapse in">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="example">
                                    <thead>
                                        <tr>
                                            <th>Clave</th>
                                            <th>Nombre de la Carrera</th>
                                            <th>REVOE</th>
                                            <th>Nivel Academico</th>
                                            <th>Fecha de Expedición</th>
                                            <th>Modalidad</th>
                                            <th>Edificio</th>
                                            <th style="width: 130px;">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php do { ?>        
        <tr>
            <td class="center"><?php echo $Funciones->str_to_may($carrera_row['clvCarrera']); ?></td>
            <td class="center"><?php echo $Funciones->str_to_may($carrera_row['nombreCarrera']); ?></td>
            <td class="center"><?php echo $Funciones->str_to_may($carrera_row['noacuerdo']); ?></td>
            <td class="center"><?php echo $Funciones->str_to_may($carrera_row['descripcion']); ?></td>
            <td class="center"><?php echo $Funciones->str_to_may($carrera_row['fechaExpedicion']); ?></td>
            <td class="center"><?php echo $Funciones->str_to_may($carrera_row['nombreMod']); ?></td>
            <td class="center"><?php echo $Funciones->str_to_may($carrera_row['edificio']); ?></td>
            <td class="center" style="width: 100px;">               
                <a data-toggle="modal" href="#EditCarreras" class="btn btn-info"  onClick="EditarCarrera('<?php echo $carrera_row['pk_carreras']?>')"><i class="icon-edit"></i></a>
                <a class="btn btn-danger"  onclick="BorrarCarrera('<?php echo $carrera_row['pk_carreras']?>')"><i class=" icon-trash"></i></a>
            </td>
        </tr>
<?php  }while($carrera_row = @mysql_fetch_assoc($result)); 
}
?>	
           </tbody>
        </table>
    </div>
  
<script>
    $(document).ready(function() {
        $("#example").dataTable( { 
                "sDom": "<\'row\'<\'span8\'l><\'span8\'f>r>t<\'row\'<\'span8\'i><\'span8\'p>>", "sPaginationType": "bootstrap","oLanguage":{
                        "sLengthMenu": "Mostrar _MENU_"
                        }
        } );
   } );
 </script>      
<?php
$Ruta = "../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisFunciones.class.php");

$Funciones = new MisFunciones();
$consult = new ConsultaDB();

session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start(); 
$fk_laboratorios = $_SESSION['fk_laboratorios'];


 $Tipo_User=$_SESSION['Tipo_User'];
 
 if($Tipo_User=="Administrador"){
      $result = $consult->ConsultaMaterialesListadoAdmin();
 }else{
     $fk_laboratorios = $_SESSION['fk_laboratorios'];
     $result = $consult->ConsultaMaterialesListado($fk_laboratorios);

 }
 
 
 $sinodales_row = @mysql_fetch_assoc($result);
 $materiales_row_num = @mysql_num_rows($result);


if($materiales_row_num  == 0){
?>

<div class="alert alert-dismissable alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <p>No existen registros enla base de datos.</p>
    <br />

</div>	


<?php  } else { ?>

 <div class="panel-body collapse in">
                                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="example">
                                    <thead>
                                        <tr>
                                            <th>Id.</th>
                                             <th>Número de Inventario</th>
                                            <th>Descripcion</th>
                                             <th>Cantidad</th>
                                               <th>Unidad de Medida</th>
                                            <th>Tipo Material</th>
                                            <th>frecuencia de uso</th>
                                            <th style="width: 130px;">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php do { ?>        
        <tr>
            <td class="center"><?php echo utf8_encode($sinodales_row['Pk_material']); ?></td>
            <td class="center"><?php echo utf8_encode($sinodales_row['NumeroInventario']); ?></td>
            <td class="center"><?php echo utf8_encode($sinodales_row['DescripcionMaterial']); ?></td>
             <td class="center"><?php echo utf8_encode($sinodales_row['CantidadMaterial']); ?></td>
             <td class="center"><?php echo utf8_encode($sinodales_row['Descripcion_UnidadMedida']); ?></td>
            <td class="center"><?php echo utf8_encode($sinodales_row['DescripcionTipoMaterial']); ?></td>
            <td class="center"><?php echo utf8_encode($sinodales_row['descrip_frecuenciauso']); ?></td>
            <td class="center" style="width: 100px;">               
                <a class="btn btn-inverse"data-toggle="modal" href="#EditSalidas" onclick="SalidasMateriales('<?php echo $sinodales_row['Pk_material']  ?>','<?php echo $sinodales_row['Pk_material']; ?>')"><i class=" icon-arrow-down"></i></a>
            </td>
        </tr>
<?php  }while($sinodales_row = @mysql_fetch_assoc($result)); 
}
?>	
           </tbody>
        </table>
    </div>
<!--         <script type='text/javascript' src='assets/plugins/datatables/jquery.dataTables.js'></script> 
        <script type='text/javascript' src='assets/plugins/datatables/dataTables.bootstrap.js'></script> 
        <script type='text/javascript' src='assets/demo/demo-datatables.js'></script>-->
        <script>
	$(document).ready(function() {
			$("#example").dataTable( { 
					"sDom": "<\'row\'<\'span8\'l><\'span8\'f>r>t<\'row\'<\'span8\'i><\'span8\'p>>", "sPaginationType": "bootstrap","oLanguage":{
						"sLengthMenu": "Mostrar _MENU_"
						}
					} );
 				} );
                                
                                 $('.dataTables_filter input').addClass('form-control').attr('placeholder','Busqueda...');
 </script>                
	
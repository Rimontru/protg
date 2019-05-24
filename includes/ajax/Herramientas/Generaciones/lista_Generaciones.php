<?php
$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisFunciones.class.php");

$Funciones = new MisFunciones();
$consult = new ConsultaDB();

$result = $consult->ConsultaGeneraciones();
 $generaciones_row = @mysql_fetch_assoc($result);
 $generaciones_row_num = @mysql_num_rows($result);


if($generaciones_row_num  == 0){
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
                                            <th>Descripción</th>
                                            <th>Mes Inicio</th>
                                            <th>Año Inicio</th>
                                            <th>Mes Fin</th>
                                            <th>Año Fin</th>
                                             <th>Tipo</th>
                                            <th style="width: 130px;">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php do { ?>        
        <tr>
            <td class="center"><?php echo $Funciones->str_to_may($generaciones_row['GeneracionDescripcion']); ?></td>
            <td class="center"><?php echo $Funciones->str_to_may($generaciones_row['MesIniciodescripcion']); ?></td>
            <td class="center"><?php echo $Funciones->str_to_may($generaciones_row['AnioInicioDescripcion']); ?></td>
            <td class="center"><?php echo $Funciones->str_to_may($generaciones_row['MesFindescripcion']); ?></td>
            <td class="center"><?php echo $Funciones->str_to_may($generaciones_row['AnioFinDescripcion']); ?></td>
            <td class="center"><?php echo $Funciones->str_to_may($generaciones_row['DescripcionTipoGeneracion']); ?></td>
            <td class="center" style="width: 100px;">               
                <a data-toggle="modal" href="#GeneracionEdit" class="btn btn-info"  onClick="ModificarGeneraciones('<?php echo $generaciones_row['pk_generacion']?>')"><i class="icon-edit"></i></a>
                <a class="btn btn-danger"  onclick="EliminarGeneraciones('<?php echo $generaciones_row['pk_generacion']?>')"><i class=" icon-trash"></i></a>
            </td>
        </tr>
<?php  }while($generaciones_row = @mysql_fetch_assoc($result)); 
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
 </script>                
	
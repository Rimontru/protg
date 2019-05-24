<?php
$Ruta = "../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisFunciones.class.php");

$Funciones = new MisFunciones();
$consult = new ConsultaDB();

$result = $consult->ConsultaDatosSinodales();
 $sinodales_row = @mysql_fetch_assoc($result);
 $sinodales_row_num = @mysql_num_rows($result);


if($sinodales_row_num  == 0){
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
                                            <th>Nombre</th>
                                            <th>cédula</th>
                                            <th>Carrera</th>
                                            <th>Modalidad</th>
                                            <th style="width: 130px;">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php do { ?>        
        <tr>
            <td class="center"><?php echo $Funciones->str_to_may($sinodales_row['nombre']); ?></td>
            <td class="center"><?php echo $Funciones->str_to_may($sinodales_row['cedula']); ?></td>
            <td class="center"><?php echo $Funciones->str_to_may($sinodales_row['nombreCarrera']); ?></td>
            <td class="center"><?php echo $Funciones->str_to_may($sinodales_row['nombreMod']); ?></td>
            <td class="center" style="width: 100px;">               
                <a class="btn btn-danger"  onclick="EliminarSinodales('<?php echo $sinodales_row['pk_sinodal']  ?>','<?php echo $sinodales_row['pk_carreras']; ?>')"><i class=" icon-trash"></i></a>
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
 </script>                
	
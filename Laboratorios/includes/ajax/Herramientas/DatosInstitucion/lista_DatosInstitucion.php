<?php
$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisFunciones.class.php");

$Funciones = new MisFunciones();
$consult = new ConsultaDB();

$result = $consult->ConsultaDatosInstitucion();
 $escuela_row = @mysql_fetch_assoc($result);
 $escuela_row_num = @mysql_num_rows($result);


if($escuela_row_num  == 0){
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
                                            <th>Clave</th>
                                            <th>Nombre de la Institución</th>
                                            <th>direccion</th>
                                            <th>registro</th>
                                            <th>telefono</th>
                                            <th style="width: 130px;">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php do { ?>        
        <tr>
            <td class="center"><?php echo $Funciones->str_to_may($escuela_row['clave']); ?></td>
            <td class="center"><?php echo $Funciones->str_to_may($escuela_row['nombreInstitucion']); ?></td>
            <td class="center"><?php echo $Funciones->str_to_may($escuela_row['direccion']); ?></td>
            <td class="center"><?php echo $Funciones->str_to_may($escuela_row['registro']); ?></td>
            <td class="center"><?php echo $Funciones->str_to_may($escuela_row['telefono']); ?></td>
            <td class="center" style="width: 100px;">               
                <a data-toggle="modal" href="#InstitucionEdit" class="btn btn-info"  onClick="ModificarInstitucion('<?php echo $escuela_row['pk_dtgenerales']?>')"><i class="icon-edit"></i></a>
                <a class="btn btn-danger"  onclick="EliminarInstitucion('<?php echo $escuela_row['pk_dtgenerales']?>')"><i class=" icon-trash"></i></a>
            </td>
        </tr>
<?php  }while($escuela_row = @mysql_fetch_assoc($result)); 
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
	
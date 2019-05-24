<?php
$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisFunciones.class.php");

$Funciones = new MisFunciones();
$consult = new ConsultaDB();

extract($_POST);

$result = $consult->ConTrabajadoresListar($matricula_buscar);
 $trabajadores_row = @mysql_fetch_assoc($result);
 $trabajadores_row_num = @mysql_num_rows($result);

 
 //matricula_buscar

if($trabajadores_row_num  == 0){
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
                                            <th>Telefono</th>
                                            <th>Correo</th>
                                            <th>Puesto Laboral</th>
                                            <th style="width: 130px;">Acci&oacute;n</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php do { ?>        
        <tr>
            <td class="center">
            <?php 
              $NombreCompleto = $trabajadores_row['apaterno']." ".$trabajadores_row['amaterno']." ".$trabajadores_row['nombre'];
               echo $Funciones->str_to_may($NombreCompleto); 
            
            ?>
            </td>         
            <td class="center"><?php echo $Funciones->str_to_may($trabajadores_row['telefono']); ?></td>
            <td class="center"><?php echo $Funciones->str_to_may($trabajadores_row['correo']); ?></td>
            <td class="center"><?php echo $Funciones->str_to_may($trabajadores_row['puestoLaboral']); ?></td>
            <td class="center" style="width: 100px;">               
                <a data-toggle="modal" href="#InstitucionEdit" class="btn btn-info"  onClick="ModificarDatosTrabajador('<?php echo $trabajadores_row['pk_trabajador']?>')"><i class="icon-edit"></i></a>
            </td>
        </tr>
<?php  }while($trabajadores_row = @mysql_fetch_assoc($result)); 
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
	
<?php
$Ruta = "../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisFunciones.class.php");

$Funciones = new MisFunciones();
$consult = new ConsultaDB();

extract($_POST);

$result = $consult->ConAlumnosporMatricula($matricula_buscar);
 $alumnos_row = @mysql_fetch_assoc($result);
 $alumnos_row_num = @mysql_num_rows($result);

 //matricula_buscar

if($alumnos_row_num  == 0){
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
                                            <th>Matricula</th>
                                            <th>Nombre</th>
                                            <th>Carrera</th>
                                            <th>Generaci&oacute;n</th>
                                            <th>Modificación</th>
                                            <th>Acci&oacute;n</th>
                                            <!--<th>F&oacute;lio</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
<?php do {
	
	$resFolio = showLastUpdateByUsers($alumnos_row['pk_alumno']);
	$array = explode('|',$resFolio);
	$showLastUpd = $array[1];
?> 
       
        <tr>
            <td class="center"><?php echo $Funciones->str_to_may($alumnos_row['matricula']); ?></td>
            <td class="center">
            <?php 
              $NombreCompleto = $alumnos_row['apaterno']." ".$alumnos_row['amaterno']." ".$alumnos_row['nombre'];
               echo $Funciones->str_to_may($NombreCompleto); 
            
            ?>
            </td>
            <td class="center"><?php echo $Funciones->str_to_may($alumnos_row['nombreCarrera']); ?></td>
            <td class="center"><?php echo $Funciones->str_to_may($alumnos_row['DescripcionGeneracion']); ?></td>
            <!--<td class="center"><?php echo $muestraresultadoFolio; ?></td>-->
            <td class="center" style="width: 65px;"><?php echo $showLastUpd; ?></td>
            <td class="center" style="width: 65px;">               
                <a data-toggle="modal" href="#InstitucionEdit" class="btn btn-info"  onClick="ModificarAlumnoEgresado('<?php echo $alumnos_row['pk_alumno']?>')"><i class="icon-edit" title="editar datos"></i></a>
            </td>
            <!--<td class="center" style="width: 65px;">               
                <a data-toggle="modal" href="#InstitucionEdit" class="btn btn-info"  onClick="AgregarFolioConcursoEgresado('<?php echo $alumnos_row['pk_alumno']?>,<?php echo $alumnos_row['matricula'] ?>')"><i class="icon-gift" title="folio concurso"></i></a>
            </td> boton del concurso para agregar el folio-->
        </tr>
<?php  }while($alumnos_row = @mysql_fetch_assoc($result)); 
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
	
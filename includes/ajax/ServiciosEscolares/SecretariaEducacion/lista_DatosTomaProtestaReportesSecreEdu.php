<?php
$Ruta = "../../../";
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
                                <table  align="center" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="example">
                                    <thead>
                                        <tr>
                                            <th>Matricula</th>
                                            <th>Nombre</th>
                                            <th>Carrera</th>
                                            <th style="width: 130px;">Autorizaciones</th>
                                            <th style="width: 130px;">Acta de Exámen</th>
                                            <th style="width: 130px;">Título</th>
                                            <th style="width: 130px;">Acta de Exámen (Prom)</th>
                                            <th style="width: 130px;">Constancia de Titulación</th>

                                        </tr>
                                    </thead>
                                    <tbody>
<?php do { ?>        
        <tr>
            <td class="center"><?php echo $Funciones->str_to_may($alumnos_row['matricula']); ?></td>
            <td class="center">
            <?php 
              $NombreCompleto = $alumnos_row['apaterno']." ".$alumnos_row['amaterno']." ".$alumnos_row['nombre'];
               echo $Funciones->str_to_may($NombreCompleto); 
            
            ?>
            </td>
            
            <td class="center"><?php echo $Funciones->str_to_may($alumnos_row['nombreCarrera']); ?></td>
            <td class="center" style="width: 100px;">               
                <a data-toggle="modal" href="#InstitucionEdit" title="asd" class="btn btn-green"  onClick="verPDFSecretaria('<?php echo $alumnos_row['pk_alumno']?>','<?php echo $alumnos_row['fk_nivelestudio']?>')"><i class="icon-ok-circle"></i></a>
            </td>
            <td class="center" style="width: 100px;">               
                <a data-toggle="modal" href="#InstitucionEdit" class="btn btn-primary"  onClick="verActaExamenFrente('<?php echo $alumnos_row['pk_alumno']?>','<?php echo $alumnos_row['fk_nivelestudio']?>')"><i class="icon-folder-open-alt"></i></a>
                <a data-toggle="modal" href="#InstitucionEdit" class="btn btn-primary"  onClick="verActaExamenAtras('<?php echo $alumnos_row['pk_alumno']?>','<?php echo $alumnos_row['fk_nivelestudio']?>')"><i class="icon-folder-open-alt"></i></a>
            </td>
            <td class="center" style="width: 100px;">               
                <a data-toggle="modal" href="#InstitucionEdit" class="btn btn-orange"  onClick="verTituloFrente('<?php echo $alumnos_row['pk_alumno']?>','<?php echo $alumnos_row['fk_nivelestudio']?>')"><i class="icon-trophy"></i></a>
                <a data-toggle="modal" href="#InstitucionEdit" class="btn btn-orange"  onClick="verTituloAtras('<?php echo $alumnos_row['pk_alumno']?>','<?php echo $alumnos_row['fk_nivelestudio']?>')"><i class="icon-trophy"></i></a>
            </td>
            <td class="center" style="width: 100px;">               
                <a data-toggle="modal" href="#InstitucionEdit" class="btn btn-danger"  onClick="ActaPromedioFrente('<?php echo $alumnos_row['pk_alumno']?>')"><i class="icon-folder-close-alt"></i></a>
                <a data-toggle="modal" href="#InstitucionEdit" class="btn btn-danger"  onClick="ActaPromedioAtras('<?php echo $alumnos_row['pk_alumno']?>')"><i class="icon-folder-close-alt"></i></a>
            </td>
            <td class="center" style="width: 100px;">               
                <a data-toggle="modal" href="#InstitucionEdit" class="btn btn-midnightblue"  onClick="verActaTitulacionFrente('<?php echo $alumnos_row['pk_alumno']?>','<?php echo $alumnos_row['fk_nivelestudio']?>')"><i class="icon-paste"></i></a>
                <a data-toggle="modal" href="#InstitucionEdit" class="btn btn-midnightblue"  onClick="verActaTitulacionAtras('<?php echo $alumnos_row['pk_alumno']?>','<?php echo $alumnos_row['fk_nivelestudio']?>')"><i class="icon-paste"></i></a>
            
</td>
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
	
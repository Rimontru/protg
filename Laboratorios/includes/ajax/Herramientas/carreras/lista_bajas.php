<?php

$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisFunciones.class.php");

$funcion = new MisFunciones();
$consulta = new ConsultaDB();

$result = $consulta->obtCarreras();
$carrera_row = @mysql_fetch_assoc($result);
$carrera_row_num = @mysql_num_rows($result);


if ($carrera_row_num == 0) {

?>

    <div class="alert alert-dismissable alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <p>No existen registros enla base de datos.</p>
        <br />

    </div>	


<?php } else { ?>


    <div class="col-md-12">
        <div class="panel gray">
            <div class="panel gray">
            <div class="panel-heading">
                    <h4>Licenciaturas desactivadas</h4>
                    <div class="options">
                        <a href="javascript:;"><i class="icon-cog"></i></a>
                        <a href="javascript:;"><i class="icon-wrench"></i></a> 
                        <a href="javascript:;" class="panel-collapse"><i class="icon-chevron-down"></i></a>
                    </div>
            </div>
            <div class="panel-body collapse in">
                <div class="table-responsive">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="example2">
                        <thead>
                            <tr>                                
                                <th>Clave</th>
                                <th>Nombre de la Carrera</th>
                                <th>REVOE</th>
                                <th>Nivel Academico</th>
                                <th>Fecha de Expedición</th>
                                <th>Modalidad</th>
                                <th>Edificio</th>
                                <th width="22%">Status</th>
                                <th width="22%">Recuperar</th>
                            </tr>
                        </thead>
                        <tbody class="selects">
                            <?php do { ?>        
                                    <tr>
                                        <td class="center"><?php echo $funcion->str_to_may($carrera_row['clvCarrera']); ?></td>
                                        <td class="center"><?php echo $funcion->str_to_may($carrera_row['nombreCarrera']); ?></td>
                                        <td class="center"><?php echo $funcion->str_to_may($carrera_row['noacuerdo']); ?></td>
                                        <td class="center"><?php echo $funcion->str_to_may($carrera_row['descripcion']); ?></td>
                                        <td class="center"><?php echo $funcion->str_to_may($carrera_row['fechaExpedicion']); ?></td>
                                        <td class="center"><?php echo $funcion->str_to_may($carrera_row['nombreMod']); ?></td>
                                        <td class="center"><?php echo $funcion->str_to_may($carrera_row['edificio']); ?></td>                                  
                                        <td class="center"><span class="label label-danger"> Baja </span></td>
                                        <td class="center" style="width: 100px;">               
                                            <a class="btn btn-green"  onclick="Recuperar('<?php echo $carrera_row['pk_carreras'] ?>')"><i class="icon-upload-alt"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                } while ($carrera_row = @mysql_fetch_assoc($result));
                            }
                            ?>	
                        </tbody>

                    </table>
                </div>
                
                
            </div>
        </div>
    </div>


<script>
    $(document).ready(function() {
        $("#example2").dataTable( { 
                "sDom": "<\'row\'<\'span8\'l><\'span8\'f>r>t<\'row\'<\'span8\'i><\'span8\'p>>", "sPaginationType": "bootstrap","oLanguage":{
                        "sLengthMenu": "Mostrar _MENU_"
                        }
        } );
   } );
 </script>   
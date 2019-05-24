<?php
$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisFunciones.class.php");

$Funciones = new MisFunciones();
$consult = new ConsultaDB();

$result = $consult->ConsultaGeneracionesCatalogo();
$generaciones_row = @mysql_fetch_assoc($result);
$generaciones_row_num = @mysql_num_rows($result);


if ($generaciones_row_num == 0) {
    ?>

    <div class="alert alert-dismissable alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <p>No existen registros enla base de datos.</p>
        <br />

    </div>	


<?php } else { ?>


<div class="col-md-12">
        <div class="panel gray">
 <div class="panel-heading"> 
            <h4>Generaciones desactivadas</h4> 
            <div class="options"> 
                <a href="javascript:;"><i class="icon-cog"></i></a> 
                <a href="javascript:;"><i class="icon-wrench"></i></a> 
                <a href="javascript:;" class="panel-collapse"><i class="icon-chevron-down"></i></a> 
            </div> 
        </div>
            <div class="panel-body collapse in">
                <div class="table-responsive">
                    <table class="table" class="table" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="example2">
                        <thead>
                            <tr>                                
                                <th width="50%">Descripcion</th>
                                <th width="22%">Status</th>
                                <th width="22%">Recuperar</th>
                            </tr>
                        </thead>
                        <tbody class="selects">
                            <?php do { ?>        
                                    <tr>
                                        <td class="center"><?php echo $Funciones->str_to_may($generaciones_row['descripcion']); ?></td>
                                        <td class="center">
                                       <?php 
                                       
                                           if($generaciones_row['activo']=="0"){
                                               echo '<span class="label label-danger">Baja</span>';
                                           }else if($generaciones_row['activo']=="1"){
                                               echo '<span class="label label-success">Activa</span>'; 
                                           }
                                       
                                       
                                       ?></td>
                                        <td class="center" style="width: 100px;">               
                                            <a class="btn btn-green"  onclick="RecuperarBajaGeneracion('<?php echo $generaciones_row['pk_generacion'] ?>')"><i class="icon-upload-alt"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                } while ($generaciones_row = @mysql_fetch_assoc($result));
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
	
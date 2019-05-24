<?php
$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisFunciones.class.php");

$Funciones = new MisFunciones();
$consult = new ConsultaDB();

$result = $consult->ConsultaDatosInstitucionBaja();
$escuela_row = @mysql_fetch_assoc($result);
$escuela_row_num = @mysql_num_rows($result);


if ($escuela_row_num == 0) {
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
            <h4>Insituciones desactivadas</h4> 
            <div class="options"> 
                <a href="javascript:;"><i class="icon-cog"></i></a> 
                <a href="javascript:;"><i class="icon-wrench"></i></a> 
                <a href="javascript:;" class="panel-collapse"><i class="icon-chevron-down"></i></a> 
            </div> 
        </div>
            
            
            
            <div class="panel-body collapse in">
                <div class="table-responsive" >
                    <table class="table" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="example2">
                        <thead>
                            <tr>                                
                                <th width="22%">Clave</th>
                                <th width="50%">Nombre</th>
                                <th width="22%">Status</th>
                                <th width="22%">Recuperar</th>
                            </tr>
                        </thead>
                        <tbody class="selects">
                            <?php do { ?>        
                                    <tr>
                                        <td class="center"><?php echo $Funciones->str_to_may($escuela_row['clave']); ?></td>
                                        <td class="center"><?php echo $Funciones->str_to_may($escuela_row['nombreInstitucion']); ?></td>
                                        <td class="center">
                                       <?php 
                                       
                                           if($escuela_row['escuelaActiva']=="0"){
                                               echo '<span class="label label-danger">Baja</span>';
                                           }else if($escuela_row['escuelaActiva']=="1"){
                                               echo '<span class="label label-success">Activa</span>'; 
                                           }
                                       
                                       
                                       ?></td>
                                        <td class="center" style="width: 100px;">               
                                            <a class="btn btn-green"  onclick="RecuperarBajaInstitucion('<?php echo $escuela_row['pk_dtgenerales'] ?>')"><i class="icon-upload-alt"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                } while ($escuela_row = @mysql_fetch_assoc($result));
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
	
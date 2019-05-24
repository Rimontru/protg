<?php
$Ruta = "../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisFunciones.class.php");

$Funciones = new MisFunciones();
$consult = new ConsultaDB();

$result = $consult->ConsultaSinodalesBaja();
$sinodales_row = @mysql_fetch_assoc($result);
$sinodales_row_num = @mysql_num_rows($result);


if ($sinodales_row_num == 0) {
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
            <h4>Sinodales desactivados</h4> 
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
                                <th>Nombre</th>
                                <th>cédula</th>
                                <th>Carrera</th>
                                <th>Modalidad</th>
                                <th style="width: 130px;">Acción</th>
                            </tr>
                        </thead>
                        <tbody class="selects">
                            <?php do { ?>        
                                    <tr>
                                        <td class="center"><?php echo $Funciones->str_to_may($sinodales_row['nombre']); ?></td>
                                        <td class="center"><?php echo $Funciones->str_to_may($sinodales_row['cedula']); ?></td>
                                        <td class="center"><?php echo $Funciones->str_to_may($sinodales_row['nombreCarrera']); ?></td>
                                        <td class="center"><?php echo $Funciones->str_to_may($sinodales_row['nombreMod']); ?></td>
                                        <td class="center" style="width: 100px;">               
                                            <a class="btn btn-green"  onclick="RecuperarBajaSinodal('<?php echo $sinodales_row['pk_sinodal']  ?>','<?php echo $sinodales_row['pk_carreras']; ?>')"><i class="icon-upload-alt"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                } while ($sinodales_row = @mysql_fetch_assoc($result));
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
	
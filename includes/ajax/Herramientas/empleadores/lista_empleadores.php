<?php
$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisFunciones.class.php");

$Funciones = new MisFunciones();
$consult = new ConsultaDB();

 $result = $consult->ConsultaEmpleadores();
 $empleadores_row = @mysql_fetch_assoc($result);
 $empleadores_row_num = @mysql_num_rows($result);

//
if($empleadores_row_num  == 0){
?>

<div class="alert alert-dismissable alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <p>No existen registros enla base de datos.</p>
    <br />

</div>	


<?php  } else { ?>
 <div class="panel-heading">
                    <h4>Lista de Empleadores</h4>
                    <div class="options">  
                        <div class="btn-group hidden-xs">
                            <a href="#" class="btn btn-muted dropdown-toggle" data-toggle="dropdown"><i class="icon-cloud-download"></i><span class="hidden-xs hidden-sm hidden-md"> Exportar como</span> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a style="cursor: pointer" onclick="rptExcelEmpleadores()">Archivo e Excel (*.xlsx)</a></li>
                                <li><a style="cursor: pointer" onclick="reporteExcel()">Archivo PDF (*.pdf)</a></li>
                            </ul>
                        </div>
                    </div>
            </div>
 <div class="panel-body collapse in">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="example">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center">#</th>
                                            <th style="text-align:center">Fecha de Solicitud</th>
                                            <th style="text-align:center">Empresa</th>
                                            <th style="text-align:center">Licenciatura</th>
                                            <th style="text-align:center">Puesto Vacante</th>
                                            <th style="text-align:center">No. de Vacantes</th>
                                            <th style="text-align:center; width:120px" colspan="0">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
          $contador="1";  
 do { ?>   

   
        <tr>
            <td class="center"><?php echo $contador++; ?></td>
            <td class="center"><?php echo $Funciones->str_to_may($empleadores_row['fechaSolicitud']); ?></td>
            <td class="center"><?php echo $Funciones->str_to_may($empleadores_row['empresa']); ?></td>
            <td class="center"><?php echo $Funciones->str_to_may($empleadores_row['licenciatura']); ?></td>
            <td class="center"><?php echo $Funciones->str_to_may($empleadores_row['puestoVacante']); ?></td>
            <td class="center"><?php echo $Funciones->str_to_may($empleadores_row['numVacantes']); ?></td>
           <td class="center">               
             <a data-toggle="modal" href="#EditEmpleadores" class="btn btn-sm btn-info" title="Editar"  onclick="ModificarEmpleadores('<?php echo $empleadores_row['pk_empleador']?>')"><i class=" icon-edit"></i></a>
             <a class="btn btn-sm btn-danger" title="Eliminar"  onclick="BorrarEmpleador('<?php echo $empleadores_row['pk_empleador']?>')"><i class=" icon-trash"></i></a>
            </td>
        </tr>
<?php  }while($empleadores_row = @mysql_fetch_assoc($result)); 
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
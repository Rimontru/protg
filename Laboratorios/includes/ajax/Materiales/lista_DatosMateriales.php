<?php
error_reporting(E_ALL ^ E_DEPRECATED);
$Ruta = "../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisFunciones.class.php");

$Funciones = new MisFunciones();
$consult = new ConsultaDB();

session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();
$fk_laboratorios = $_SESSION['fk_laboratorios'];

extract($_POST);

 $Tipo_User=$_SESSION['Tipo_User'];
 
 if($Tipo_User=="Administrador"){
     $result = $consult->ConsultaMaterialesListadoBusquedaAdmin($matricula_buscar);
 }else{
    $result = $consult->ConsultaMaterialesListadoBusqueda($fk_laboratorios, $matricula_buscar);
   
 }



 $materiales_row = @mysql_fetch_assoc($result);
    $materiales_row_num = @mysql_num_rows($result);



//matricula_buscar

if ($materiales_row_num == 0) {
    ?>
    <!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8">-->
    <div class="alert alert-dismissable alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <p>No existen registros enla base de datos.</p>
        <br />

    </div>	


<?php } else { ?>

    <div class="panel-body collapse in">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="example">
            <thead>
                <tr>
                     <th>Id.</th>
                    <th>No. Inventario</th>
                    <th>Cantidad</th>
                     <th>Unidad de Medida</th>
                    <th>DescripcionMaterial</th>                                           
                    <th>Marca</th>
                    <th>Frecuencia de Uso</th>
                  
                    <th>Observaciones</th>
                     <?php
                    if ($Tipo_User == "Administrador") {
                        echo "<th>Laboratorio</th>";
                    }
                    ?>   
                    <th style="width: 130px;">Acci&oacute;n</th>
                </tr>
            </thead>
            <tbody>
                <?php do { ?>        
                    <tr>
                        <td class="center"><?php echo utf8_encode($materiales_row['Pk_material']); ?></td>
                        <td class="center"><?php echo utf8_encode($materiales_row['NumeroInventario']); ?></td>
                        <td class="center"><?php echo utf8_encode($materiales_row['CantidadMaterial']); ?></td>
                        <td class="center"><?php echo utf8_encode($materiales_row['Descripcion_UnidadMedida']); ?></td>
                        <td class="center"><?php echo utf8_encode($materiales_row['DescripcionMaterial']); ?></td>
                        <td class="center"><?php echo $Funciones->str_to_may($materiales_row['MarcaMaterial']); ?> </td>
                        <td class="center"><?php echo utf8_encode($materiales_row['descrip_frecuenciauso']); ?></td>                      
                        <td class="center"><?php echo utf8_encode($materiales_row['ObservacionesMaterial']); ?></td>
                          <?php
                        if ($Tipo_User == "Administrador") {
                            echo "<td class='center'>" . utf8_encode($materiales_row['DescripcionLaboratorios']) . "</td>";
                        }
                        ?>   
                        <td class="center" style="width: 100px;">               
                            <a data-toggle="modal" href="#InstitucionEdit" class="btn btn-info"  onClick="ModificarMaterialesSolo('<?php echo $materiales_row['Pk_material'] ?>')"><i class="icon-edit"></i></a>
                        </td>
                    </tr>
                <?php
                } while ($materiales_row = @mysql_fetch_assoc($result));
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
        $("#example").dataTable({
            "sDom": "<\'row\'<\'span8\'l><\'span8\'f>r>t<\'row\'<\'span8\'i><\'span8\'p>>", "sPaginationType": "bootstrap", "oLanguage": {
                "sLengthMenu": "Mostrar _MENU_"
            }
        });
    });
</script>                

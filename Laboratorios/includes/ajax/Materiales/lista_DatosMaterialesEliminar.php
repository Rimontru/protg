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

//verificamos el tipo de usuario
 $Tipo_User=$_SESSION['Tipo_User'];
 
 if($Tipo_User=="Administrador"){
      $result = $consult->ConsultaMaterialesListadoAdmin();
 }else{
     $fk_laboratorios = $_SESSION['fk_laboratorios'];
     $result = $consult->ConsultaMaterialesListado($fk_laboratorios);

 }

 $sinodales_row = @mysql_fetch_assoc($result);
 $materiales_row_num = @mysql_num_rows($result);


if($materiales_row_num  == 0){
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
                                             <th>Id.</th>
                                            <th>Descripcion</th>
                                            <th>Medidas Material</th>
                                            <th>Tipo Material</th>
                                            
                                            <th>Laboratorio</th>
                                            <th>frecuencia de uso</th>
                                            <?php  
                                             if($Tipo_User=="Administrador"){
                                                   echo "<th>Laboratorio</th>";
                                               }
                                            ?>                                            
                                            <th style="width: 130px;">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php do { ?>        
        <tr>
             <td class="center"><?php echo utf8_encode($sinodales_row['Pk_material']); ?></td>
            <td class="center"><?php echo utf8_encode($sinodales_row['DescripcionMaterial']); ?></td>
            <td class="center"><?php echo utf8_encode($sinodales_row['MedidasMaterial']); ?></td>
            <td class="center"><?php echo utf8_encode($sinodales_row['DescripcionTipoMaterial']); ?></td>
            <td class="center"><?php echo utf8_encode($sinodales_row['DescripcionLaboratorios']); ?></td>
            <td class="center"><?php echo utf8_encode($sinodales_row['descrip_frecuenciauso']); ?></td>
             <?php  
             if($Tipo_User=="Administrador"){
                   echo "<td class='center'>".utf8_encode($sinodales_row['DescripcionLaboratorios'])."</td>";
               }
            ?>   
            <td class="center" style="width: 100px;">               
                <a class="btn btn-danger"  onclick="EliminarMateriales('<?php echo $sinodales_row['Pk_material']  ?>','<?php echo $sinodales_row['Pk_material']; ?>')"><i class=" icon-trash"></i></a>
            </td>
        </tr>
<?php  }while($sinodales_row = @mysql_fetch_assoc($result)); 
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
	
<?php
#AGREGADO: Ivan Mauricio Melo Granados
#FECHA: 29/05/2014 
$Fk_UnidadMedida = "";
$result = $ConsultaDB->Conunidadmedida();
while ($row = mysql_fetch_assoc($result)) {
    $Fk_UnidadMedida .= "<option value='$row[Pk_UnidadMedida]'>$row[Descripcion_UnidadMedida]</option>";
}
mysql_free_result($result);
?>
<script>
    $(function() {
        $.ajax({
            url: pathMateriales + 'lista_DatosMaterialesSalidas.php',
            type: 'post',
            data: "ListaSinodales=ListaSinodales",
            success: function(data) {
                if (data != "") {
                    $("#Lista").html(data);
                }
            }

        });//fin ajax 



    });


</script>  

<div class="row">      	
    <div class="span12">           		
        <div class="widget stacked ">      			
            <div class="widget-header">
                <i class="icon-pencil"></i>
                <h3>Materiales: Salidas.</h3>
            </div> <!-- /widget-header -->

            <div class="widget-content">					
                <br />					
                <section id="buttons">
                    
                   
                    
                    
                 <div id="Lista"></div>
 
                                         
                                         
                </section>
            </div> <!-- /widget-content -->

        </div> <!-- /widget -->

    </div> <!-- /span12 -->

</div> <!-- /row -->


    
<!--   //Editar Carrera -->
<div class="modal fade" role="dialog" id="EditSalidas">
    <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title"> <font color="white"> Salida de Material </font> </h4>
                    </div>
                    <div class="modal-body">
                        
                        <form action="#" class="form-horizontal" id="f_SalidasMateriales" name="f_SalidasMateriales" method="POST"/>   
                        <fieldset>
                            
                            
                            <input type="hidden" class="form-control :apostrofe"  name="Pk_material" id="Pk_material" autofocus/>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="NumeroInventario">Numero de Inventario</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control :apostrofe" disabled="" name="NumeroInventario" id="NumeroInventario" />
                                </div>
                            </div>

                                <div class="form-group">
                                <label class="col-sm-3 control-label" for="DescripcionMaterial">Descripción</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control :apostrofe" disabled="" name="DescripcionMaterial" id="DescripcionMaterial" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="CantidadMaterial">Existencia</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control :apostrofe" disabled="" name="CantidadMaterialDisabled" id="CantidadMaterialDisabled" />
                                    <input type="hidden" class="form-control :apostrofe"  name="CantidadMaterial" id="CantidadMaterial" />
                                </div>
                            </div>
                            
                                
                           <div class="form-group">
                            <label class="col-sm-3 control-label" for="Fk_UnidadMedida">Unidad de Medida</label>
                            <div class="col-sm-6">
                                <select class="form-control :required" disabled=""  name="Fk_UnidadMedida" id="Fk_UnidadMedida">
                                    <option value="">-- Seleccione --</option>
                                        <?php
                                        echo $Fk_UnidadMedida;
                                        ?>
                                </select>
                            </div>
                        </div>
                            
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="CantidadSalida">Salida</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control :required :integer :apostrofe" required name="CantidadSalida" id="CantidadSalida" autofocus />
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <div class="btn-toolbar">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <a data-toggle="modal" id="CerrarModalSalidas" class="btn-default btn">Cancelar</a>
                                </div>
                            </div>
                        </fieldset>    
                        </form>
                    </div>
            </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




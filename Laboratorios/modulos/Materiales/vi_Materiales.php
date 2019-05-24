<?php
#AGREGADO: Ivan Mauricio Melo Granados
#FECHA: 29/05/2014 
$Fk_TipoMaterial = "";
$result = $ConsultaDB->ConTipoMaterial();
while ($row = mysql_fetch_assoc($result)) {
    $Fk_TipoMaterial .= "<option value='$row[Pk_TipoMaterial]'>$row[DescripcionTipoMaterial]</option>";
}
mysql_free_result($result);

$Fk_EstadoMaterial = "";
$result = $ConsultaDB->ConEstadoMaterial();
while ($row = mysql_fetch_assoc($result)) {
    $Fk_EstadoMaterial .= "<option value='$row[Pk_EstadoMaterial]'>$row[Descripcion_EstadoMaterial]</option>";
}
mysql_free_result($result);


$fk_frecuenciauso = "";
$result = $ConsultaDB->Confrecuenciauso();
while ($row = mysql_fetch_assoc($result)) {
    $fk_frecuenciauso .= "<option value='$row[pk_frecuenciauso]'>$row[descrip_frecuenciauso]</option>";
}
mysql_free_result($result);



$fk_clasematerial = "";
$result = $ConsultaDB->Conclasematerial();
while ($row = mysql_fetch_assoc($result)) {
    $fk_clasematerial .= "<option value='$row[pk_clasematerial]'>$row[descrip_clasematerial]</option>";
}
mysql_free_result($result);

$Fk_UnidadMedida = "";
$result = $ConsultaDB->Conunidadmedida();
while ($row = mysql_fetch_assoc($result)) {
    $Fk_UnidadMedida .= "<option value='$row[Pk_UnidadMedida]'>$row[Descripcion_UnidadMedida]</option>";
}
mysql_free_result($result);
?>
<div class="row">      	
    <div class="span12">           		
        <div class="widget stacked ">      			
            <div class="widget-header">
                <i class="icon-pencil"></i>
                <h3>Alta de Materiales.</h3>
            </div> <!-- /widget-header -->

            <div class="widget-content">					
                <br />					
                <section id="buttons">
                    
                     <form action="#" class="form-horizontal" id="f_datosmateriales" name="f_datosmateriales"/>
                                             <fieldset>
                                                     <div class="form-group">
                                                                <label class="col-sm-3 control-label" for="fk_clasematerial">Clase de Material</label>
                                                                <div class="col-sm-6">
                                                                    <select class="form-control :required" name="fk_clasematerial" id="fk_clasematerial">
                                                                        <option value="">-- Seleccione --</option>
                                                                        <?php
                                                                        echo $fk_clasematerial;
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
								<br>	

                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label" for="NumeroInventario">No. de Inventario</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" class="form-control :apostrofe"  name="NumeroInventario" id="NumeroInventario" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                </div>
                                                            </div>
<br>

                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label" for="DescripcionMaterial">Descripción</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" class="form-control :required :apostrofe"  name="DescripcionMaterial" id="DescripcionMaterial" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                </div>
                                                            </div>  
<br>
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label" for="CantidadMaterial">Cantidad</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" class="form-control :required :apostrofe"  name="CantidadMaterial" id="CantidadMaterial" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                </div>
                                                            </div>
<br>

                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label" for="fk_frecuenciauso">Unidad de Medida</label>
                                                                <div class="col-sm-6">
                                                                    <select class="form-control :required" name="Fk_UnidadMedida" id="Fk_UnidadMedida">
                                                                        <option value="">-- Seleccione --</option>
                                                                        <?php
                                                                        echo $Fk_UnidadMedida;
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
<br>

                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label" for="MedidasMaterial">Medidas</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" class="form-control :apostrofe"  name="MedidasMaterial" id="MedidasMaterial" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                </div>
                                                            </div>


<br>


                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label" for="Fk_TipoMaterial">Tipo de Material</label>
                                                                <div class="col-sm-6">
                                                                    <select class="form-control :required" name="Fk_TipoMaterial" id="Fk_TipoMaterial">
                                                                        <option value="">-- Seleccione --</option>
                                                                        <?php
                                                                        echo $Fk_TipoMaterial;
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
<br>

                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label" for="MarcaMaterial">Marca</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" class="form-control :apostrofe"  name="MarcaMaterial" id="MarcaMaterial" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                </div>
                                                            </div>

                     <br>
                     
                     
                                                             <div class="form-group">
                                                                <label class="col-sm-3 control-label" for="Fk_EstadoMaterial">Estado de Material</label>
                                                                <div class="col-sm-6">
                                                                    <select class="form-control :required" name="Fk_EstadoMaterial" id="Fk_EstadoMaterial">
                                                                        <option value="">-- Seleccione --</option>
                                                                        <?php
                                                                        echo $Fk_EstadoMaterial;
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>

<br>


                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">Observaciones</label>
                                                                <div class="col-sm-6">
                                                                    <textarea style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 69px;"  name="ObservacionesMaterial" id="ObservacionesMaterial"  class="form-control autosize"></textarea>
                                                                </div>
                                                            </div>
<br>


                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label" for="Almacenado">Almacenado</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" class="form-control :apostrofe"  name="Almacenado" id="Almacenado" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                </div>
                                                            </div>
<br>
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label" for="Uso">Uso</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" class="form-control :apostrofe"  name="Uso" id="Uso" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                </div>
                                                            </div>


<br>

                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label" for="fk_frecuenciauso">Frecuencia de Uso</label>
                                                                <div class="col-sm-6">
                                                                    <select class="form-control :required" name="fk_frecuenciauso" id="fk_frecuenciauso">
                                                                        <option value="">-- Seleccione --</option>
                                                                        <?php
                                                                        echo $fk_frecuenciauso;
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
<br>

                                             <div class="form-group">
                                                    <div id="botonera" class="btn-toolbar">
                                                        <center>   
                                                            <button class="btn btn-primary start" type="submit">
                                                                <i class="fa fa-save"></i>
                                                                <span>Guardar</span>
                                                            </button>
                                                            <a data-toggle="modal"  onClick="window.location.reload()"  class="btn-default btn">Cancelar</a>                           
                                                        </center>
                                                    </div>
                                                    <div id="loading-data"></div>
                                                </div>


                                                        </div>
                                                    </div>
                                                </div>


                                               
                       </fieldset>
                    </form>
                    

                </section>
            </div> <!-- /widget-content -->

        </div> <!-- /widget -->

    </div> <!-- /span12 -->

</div> <!-- /row -->
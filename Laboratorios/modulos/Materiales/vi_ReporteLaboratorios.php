<?php
#AGREGADO: Ivan Mauricio Melo Granados
#FECHA: 29/05/2014 
$Laboratorios = "";
$result = $ConsultaDB->ConLaboratorios();
while ($row = mysql_fetch_assoc($result)) {
    $Laboratorios .= "<option value='$row[Pk_laboratorios]'>$row[DescripcionLaboratorios]</option>";
}
mysql_free_result($result);


$clasematerial = "";
$result = $ConsultaDB->Conclasematerial();
while ($row = mysql_fetch_assoc($result)) {
    $clasematerial .= "<option value='$row[pk_clasematerial]'>$row[descrip_clasematerial]</option>";
}
mysql_free_result($result);
?>

<div class="row">      	
    <div class="span12">           		
        <div class="widget stacked ">      			
            <div class="widget-header">
                <i class="icon-pencil"></i>
                <h3>Materiales: Reportes.</h3>
            </div> <!-- /widget-header -->

            <div class="widget-content">					
                <br />					
                <section id="buttons">
                    
                   
                    
                    
                                <form action="#" class="form-horizontal" id="f_datosmateriales" name="f_datosmateriales"/>   
                                        <fieldset>




                                          <div class="form-group">
                                                                <label class="col-sm-3 control-label" for="Pk_laboratorios">Laboratorios</label>
                                                                <div class="col-sm-6">
                                                                    <select class="form-control :required" name="Pk_laboratorios" id="Pk_laboratorios">
                                                                        <option value="">-- Seleccione --</option>
                                                                        <option value="10">Todos</option>
                                                                        
                                                                            <?php
                                                                            echo $Laboratorios;
                                                                            ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            
                                                            
                                                       

                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label" for="pk_clasematerial">Clase de Material</label>
                                                                <div class="col-sm-6">
                                                                    <select class="form-control :required" name="pk_clasematerial" id="pk_clasematerial">
                                                                        <option value="">-- Seleccione --</option>
                                                                            <?php
                                                                            echo $clasematerial;
                                                                            ?>
                                                                    </select>
                                                                </div>
                                                            </div>


                                                          
                                                


                                                  <button name="ReporteLaboratorios" id="ReporteLaboratorios" class="btn btn-primary start" type="submit">
                                                            <i class="fa fa-save"></i>
                                                            <span>Ver Reporte</span>
                                                        </button> 

                                        </fieldset>  
                                        </form>     

 
                                         
                                         
                </section>
            </div> <!-- /widget-content -->

        </div> <!-- /widget -->

    </div> <!-- /span12 -->

</div> <!-- /row -->



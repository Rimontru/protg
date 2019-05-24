<?php
#AGREGADO: Ivan Mauricio Melo Granados
#FECHA: 29/05/2014 
$Meses = "";
$result = $ConsultaDB->ConMeses();
while ($row = mysql_fetch_assoc($result)) {
    $Meses .= "<option value='$row[pk_meses]'>$row[descripcion]</option>";
}
mysql_free_result($result);

$Anios = "";
$result = $ConsultaDB->ConAnios();
while ($row = mysql_fetch_assoc($result)) {
    $Anios .= "<option value='$row[pk_anios]'>$row[descripcion]</option>";
}
mysql_free_result($result);



$TipoGeneracion = "";
$result = $ConsultaDB->ConTipoGeneracion();
while ($row = mysql_fetch_assoc($result)) {
    $TipoGeneracion .= "<option value='$row[Pk_TipoGeneracion]'>$row[DescripcionTipoGeneracion]</option>";
}
mysql_free_result($result);
?>

<script>
    $(function() {
        $.ajax({
            url: pathGeneraciones + 'lista_Generaciones.php',
            type: 'post',
            data: "ListaInstitucion=ListaInstitucion",
            success: function(data) {
                if (data != "") {
                    $("#Lista").html(data);
                }
            }

        });//fin ajax 
        
        
        //dados de baja
        $.ajax({
            url: pathGeneraciones + 'lista_GeneracionesBaja.php',
            type: 'post',
            data: "ListaInstitucion=ListaInstitucion",
            success: function(data) {
                if (data != "") {
                    $("#ListaBaja").html(data);
                }
            }

        });//fin ajax 
        
        
        
        
    });
    

</script>  

<div id="page-content">
    <div id='wrap'>
        <div id="page-heading">
            <ol class="breadcrumb">
                <li><a href="<?php echo Config::PAG_ADMIN . "?content=home2"; ?>">Inicio</a></li>
                <li>Herramientas</li>
                <li class="active">Generaciones</li>
            </ol>

            <h1>Generaciones</h1>
            <div class="options">
                <div class="btn-toolbar">
                    <div class="btn-group hidden-xs"></div>
                    <a href="#" class="btn btn-muted"><i class="icon-cog"></i></a>
                </div>
            </div>
        </div>

        <div class="container">




            <div class="panel">
                <div class="panel-heading">
                    <h4><i class="icon-cloud"></i> Generaciones</h4>
                    <div class="options">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#home1" data-toggle="tab">Generaciones</a>
                            </li>
                            <li>
                                <a href="#profile1" data-toggle="tab">Recuperar Baja</a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="home1">


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-sky">
                                    
                                        <br>
                                        <div>
            
                                            <a data-toggle="modal" href="#AltaGeneraciones" class="btn btn-primary"><i class="icon-plus"> Nuevo Registro</i></a>
                                        </div>  
                                        <br>
                                        <div id="Lista"></div>  

                                    </div>
                                </div>
                            </div>


                        </div>





                     <div class="tab-pane" id="profile1">
                      <div id="ListaBaja"></div>  

                                    
                     
                     
                     </div>

                     
                     
                    </div>
                    
                    
                    
                    
                    
                </div>
            </div>









        </div> <!-- container -->
    </div> <!--wrap -->
</div> <!-- page-content -->




<!--ALTA CARRERA-->
<div class="modal fade" role="dialog" id="AltaGeneraciones">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> Alta de Nueva Generaciones </h4>
            </div>
            <div class="modal-body">
                <form action="#" class="form-horizontal" id="f_altageneraciones" name="f_altageneraciones"/>   
                <fieldset>

                   
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="fk_iniciomes">Mes Inicio</label>
                        <div class="col-sm-6">
                            <select class="form-control :required" name="fk_iniciomes" id="fk_iniciomes">
                                <option value="">-- Seleccione --</option>
                                <?php
                                echo $Meses;
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="fk_inicioanios">Año Inicio</label>
                        <div class="col-sm-6">
                            <select class="form-control :required" name="fk_inicioanios" id="fk_inicioanios">
                                <option value="">-- Seleccione --</option>
                                <?php
                                echo $Anios;
                                ?>
                            </select>
                        </div>
                    </div>


                       <div class="form-group">
                        <label class="col-sm-3 control-label" for="fk_finmeses">Mes Fin</label>
                        <div class="col-sm-6">
                            <select class="form-control :required" name="fk_finmeses" id="fk_finmeses">
                                <option value="">-- Seleccione --</option>
                                <?php
                                echo $Meses;
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="fk_finanios">Año Fin</label>
                        <div class="col-sm-6">
                            <select class="form-control :required" name="fk_finanios" id="fk_finanios">
                                <option value="">-- Seleccione --</option>
                                <?php
                                echo $Anios;
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    
                     <div class="form-group">
                        <label class="col-sm-3 control-label" for="fk_tipo">Tipo</label>
                        <div class="col-sm-6">
                            <select class="form-control :required" name="fk_tipo" id="fk_tipo">
                                <option value="">-- Seleccione --</option>
                               <?php
                                echo $TipoGeneracion;
                                ?>
                            </select>
                        </div>
                    </div>





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


                </fieldset>    
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--   //editcliente -->
<div class="modal fade" role="dialog" id="GeneracionEdit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> Modificar Generación </h4>
            </div>
            <div class="modal-body">





          <form action="#" class="form-horizontal" id="f_modificargeneraciones" name="f_modificargeneraciones"/>   
                <fieldset>


                    <input type="hidden" name="pk_generacion" id="pk_generacion" />
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="m_fk_iniciomes">Mes Inicio</label>
                        <div class="col-sm-6">
                            <select class="form-control :required" name="m_fk_iniciomes" id="m_fk_iniciomes">
                                <option value="">-- Seleccione --</option>
                                <?php
                                echo $Meses;
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="m_fk_inicioanios">Año Inicio</label>
                        <div class="col-sm-6">
                            <select class="form-control :required" name="m_fk_inicioanios" id="m_fk_inicioanios">
                                <option value="">-- Seleccione --</option>
                                <?php
                                echo $Anios;
                                ?>
                            </select>
                        </div>
                    </div>


                       <div class="form-group">
                        <label class="col-sm-3 control-label" for="m_fk_finmeses">Mes Fin</label>
                        <div class="col-sm-6">
                            <select class="form-control :required" name="m_fk_finmeses" id="m_fk_finmeses">
                                <option value="">-- Seleccione --</option>
                                <?php
                                echo $Meses;
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="m_fk_finanios">Año Fin</label>
                        <div class="col-sm-6">
                            <select class="form-control :required" name="m_fk_finanios" id="m_fk_finanios">
                                <option value="">-- Seleccione --</option>
                                <?php
                                echo $Anios;
                                ?>
                            </select>
                        </div>
                    </div>





                    <div class="form-group">
                        <div id="botonera2" class="btn-toolbar">
                            <center>   
                                <button class="btn btn-primary start" type="submit">
                                    <i class="fa fa-save"></i>
                                    <span>Guardar</span>
                                </button>
                                <a data-toggle="modal" onClick="window.location.reload()" class="btn-default btn">Cancelar</a>                           
                            </center>
                        </div>
                        <div id="loading-data2"></div>
                    </div>


                </fieldset>    
                </form>




            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->














</div>

<link rel='stylesheet' type='text/css' href='assets/plugins/codeprettifier/prettify.css' /> 
<link rel='stylesheet' type='text/css' href='assets/plugins/form-toggle/toggles.css' /> 

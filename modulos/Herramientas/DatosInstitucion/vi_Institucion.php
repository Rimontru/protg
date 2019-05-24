<?php
#AGREGADO: Ivan Mauricio Melo Granados
#FECHA: 29/05/2014 
$Estados = "";
$result = $ConsultaDB->ConEstados();
while ($row = mysql_fetch_assoc($result)) {
    $Estados .= "<option value='$row[pk_estado]'>$row[descripcion]</option>";
}
mysql_free_result($result);
?>

<script>
    $(function() {
        $.ajax({
            url: pathDatosInstitucion + 'lista_DatosInstitucion.php',
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
            url: pathDatosInstitucion + 'lista_DatosInstitucionBaja.php',
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
                <li class="active">Datos de la Institución</li>
            </ol>

            <h1>Datos de la Institución</h1>
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
                    <h4><i class="icon-cloud"></i> Datos de la Institución</h4>
                    <div class="options">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#home1" data-toggle="tab">Datos Institución</a>
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
                                        <!--                          <div class="panel-heading">
                                                                        <h4>Datos de la Institución</h4>
                                                                        <div class="options">   	
                                                                            <a href="javascript:;"><i class="icon-cog"></i></a>
                                                                            <a href="javascript:;"><i class="icon-wrench"></i></a>
                                                                            <a href="javascript:;" class="panel-collapse"><i class="icon-chevron-down"></i></a>
                                                                     
                                                                        </div>
                                                                  </div>-->

                                        <br>
                                        <div>
            <!--                                <a data-toggle="modal" href="<?php // echo Config::PAG_ADMIN . "?content=Alta_Carreras";  ?>" class="btn btn-primary">Nuevo Registro</a>-->
                                            <a data-toggle="modal" href="#AltaInstitucion" class="btn btn-primary"><i class="icon-plus"> Nuevo Registro</i></a>
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
<div class="modal fade" role="dialog" id="AltaInstitucion">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> Alta de Nueva Institución </h4>
            </div>
            <div class="modal-body">
                <form action="#" class="form-horizontal" id="f_datosinstitucion" name="f_datosinstitucion"/>   
                <fieldset>


                    <div class="form-group">
                        <label class="col-md-3 control-label" for="v_nombre">Nombre</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control :required :apostrofe"  name="v_nombre" id="v_nombre" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="v_apodoInstitucion">Nombre Corto</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control :required :apostrofe"  name="v_apodoInstitucion" id="v_apodoInstitucion" title="ESTE CAMPO ES REQUERIDO"/>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="v_lema">Lema</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control :required :apostrofe"  name="v_lema" id="v_lema" title="ESTE CAMPO ES REQUERIDO"/>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="v_clave">Clave</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control :required :apostrofe"  name="v_clave" id="v_clave" title="ESTE CAMPO ES REQUERIDO"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="v_direccion">Dirección</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control :required :apostrofe"  name="v_direccion" id="v_direccion" title="ESTE CAMPO ES REQUERIDO"/>
                        </div>
                    </div>




                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="v_estado">Estado</label>
                        <div class="col-sm-6">
                            <select class="form-control :required" name="v_estado" id="v_estado">
                                <option value="">-- Seleccione --</option>
                                <?php
                                echo $Estados;
                                ?>
                            </select>
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="v_Municipio">Municipio</label>
                        <div class="col-sm-6">
                            <select class="form-control :required" name="v_Municipio" id="v_Municipio">
                                <option value="">-- Seleccione --</option>

                            </select>
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="v_coloniafracc">Colonia/Fraccionamiento</label>
                        <div class="col-sm-6">
                            <select class="form-control :required" name="v_coloniafracc" id="v_coloniafracc">
                                <option value="">-- Seleccione --</option>

                            </select>
                        </div>
                    </div>





                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="v_telefono">Teléfono</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control :required :apostrofe"  name="v_telefono" id="v_telefono" title="ESTE CAMPO ES REQUERIDO"/>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="v_fechaincorporacion">Fecha de Incorporación a Secretaría</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control"  name="v_fechaincorporacion" id="v_fechaincorporacion" title="ESTE CAMPO ES REQUERIDO"/>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="v_registro">Registro</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control"  name="v_registro" id="v_registro" title="ESTE CAMPO ES REQUERIDO"/>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="v_regimen">Regimen</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control"  name="v_regimen" id="v_regimen" title="ESTE CAMPO ES REQUERIDO"/>
                        </div>
                    </div> 


                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="v_nooficio">No. de Oficio</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control"  name="v_nooficio" id="v_nooficio" title="ESTE CAMPO ES REQUERIDO"/>
                        </div>
                    </div> 


                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="v_paginaweb">Página Web</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control"  name="v_paginaweb" id="v_paginaweb" title="ESTE CAMPO ES REQUERIDO"/>
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
<div class="modal fade" role="dialog" id="InstitucionEdit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> Modificar Institución </h4>
            </div>
            <div class="modal-body">





                <form action="#" class="form-horizontal" id="f_Modificardatosinstitucion" name="f_Modificardatosinstitucion" method="POST"/>   
                <fieldset>

                    <input type="hidden" name="pk_escuela" id="pk_escuela" />
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="m_nombre">Nombre</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control :required :apostrofe"  name="m_nombre" id="m_nombre" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="m_apodoInstitucion">Nombre Corto</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control :required :apostrofe"  name="m_apodoInstitucion" id="m_apodoInstitucion" title="ESTE CAMPO ES REQUERIDO"/>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="m_lema">Lema</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control :required :apostrofe"  name="m_lema" id="m_lema" title="ESTE CAMPO ES REQUERIDO"/>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="m_clave">Clave</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control :required :apostrofe"  name="m_clave" id="m_clave" title="ESTE CAMPO ES REQUERIDO"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="m_direccion">Dirección</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control :required :apostrofe"  name="m_direccion" id="m_direccion" title="ESTE CAMPO ES REQUERIDO"/>
                        </div>
                    </div>




                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="m_estado">Estado</label>
                        <div class="col-sm-6">
                            <select class="form-control :required" name="m_estado" id="m_estado">
                                <option value="">-- Seleccione --</option>
                                <?php
                                echo $Estados;
                                ?>
                            </select>
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="m_Municipio">Municipio</label>
                        <div class="col-sm-6">
                            <select class="form-control :required" name="m_Municipio" id="m_Municipio">
                                <option value="">-- Seleccione --</option>

                            </select>
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="m_coloniafracc">Colonia/Fraccionamiento</label>
                        <div class="col-sm-6">
                            <select class="form-control :required" name="m_coloniafracc" id="m_coloniafracc">
                                <option value="">-- Seleccione --</option>

                            </select>
                        </div>
                    </div>





                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="m_telefono">Teléfono</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control :required :apostrofe"  name="m_telefono" id="m_telefono" title="ESTE CAMPO ES REQUERIDO"/>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="m_fechaincorporacion">Fecha de Incorporación a Secretaría</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control"  name="m_fechaincorporacion" id="m_fechaincorporacion" title="ESTE CAMPO ES REQUERIDO"/>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="m_registro">Registro</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control"  name="m_registro" id="m_registro" title="ESTE CAMPO ES REQUERIDO"/>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="m_regimen">Regimen</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control"  name="m_regimen" id="m_regimen" title="ESTE CAMPO ES REQUERIDO"/>
                        </div>
                    </div> 


                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="m_nooficio">No. de Oficio</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control"  name="m_nooficio" id="m_nooficio" title="ESTE CAMPO ES REQUERIDO"/>
                        </div>
                    </div> 


                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="m_paginaweb">Página Web</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control"  name="m_paginaweb" id="m_paginaweb" title="ESTE CAMPO ES REQUERIDO"/>
                        </div>
                    </div> 




                    <div class="form-group">
                        <div id="botonera2" class="btn-toolbar">
                            <center>   
                                <button class="btn btn-primary start" type="submit">
                                    <i class="fa fa-save"></i>
                                    <span>Guardar</span>
                                </button>
                                <a data-toggle="modal"  onClick="window.location.reload()"  class="btn-default btn">Cancelar</a>                           
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

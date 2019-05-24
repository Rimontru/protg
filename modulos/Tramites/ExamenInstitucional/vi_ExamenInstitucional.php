<?php
#AGREGADO: Ivan Mauricio Melo Granados
#FECHA: 29/05/2014 
$Genero = "";
$result = $ConsultaDB->ConsultaGenero();
while ($row = mysql_fetch_assoc($result)) {
    $Genero .= "<option value='$row[pk_genero]'>$row[descripcion]</option>";
}
mysql_free_result($result);


$Carreras = "";
$result = $ConsultaDB->ConsultaCarreras();
while ($row = mysql_fetch_assoc($result)) {
    $Carreras .= "<option name='Pk_carreras[]' value='$row[pk_carreras]'>$row[clvCarrera]</option>";
}
mysql_free_result($result);


$Estados = "";
$result = $ConsultaDB->ConEstados();
while ($row = mysql_fetch_assoc($result)) {
    $Estados .= "<option value='$row[pk_estado]'>$row[descripcion]</option>";
}
mysql_free_result($result);



$Turnos = "";
$result = $ConsultaDB->ConTurnos();
while ($row = mysql_fetch_assoc($result)) {
    $Turnos .= "<option value='$row[pk_turnos]'>$row[descripcion]</option>";
}
mysql_free_result($result);


$Generacion = "";
$result = $ConsultaDB->ConsultaGeneraciones();
while ($row = mysql_fetch_assoc($result)) {
    $Generacion .= "<option value='$row[pk_generacion]'>$row[GeneracionDescripcion]</option>";
}
mysql_free_result($result);



$PlanEstudios = "";
$result = $ConsultaDB->ConAnios();
while ($row = mysql_fetch_assoc($result)) {
    $PlanEstudios .= "<option value='$row[pk_anios]'>$row[descripcion]</option>";
}
mysql_free_result($result);



$EstadoTitulacion = "";
$result = $ConsultaDB->ConEstadoTitulacion();
while ($row = mysql_fetch_assoc($result)) {
    $EstadoTitulacion .= "<option value='$row[pk_estadoTitulacion]'>$row[descripcion]</option>";
}
mysql_free_result($result);
?>
<script>
    $(function() {
        

    });


</script>  

<div id="page-content">
    <div id='wrap'>
        <div id="page-heading">
            <ol class="breadcrumb">
                <li><a href="<?php echo Config::PAG_ADMIN . "?content=home2"; ?>">Inicio</a></li>
                 <li><a href="#">Trámites</a></li>
                <li class="active">Exámen Institucional</li>
            </ol>

            <h1>Exámen Institucional</h1>
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
                    <h4><i class="icon-cloud"></i> Exámen Institucional</h4>
                    <div class="options">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#home1" data-toggle="tab"> Exámen Institucional</a>
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

                                            <div class="modal-body">
                                                <form action="#" class="form-horizontal" id="frm_busquedaExamenIns" name="frm_busquedaExamenIns"/>   
                                                <fieldset>

                                                   

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="panel panel-midnightblue">
                                                                <div class="panel-heading">
                                                                    <h4>Busqueda...</h4>
                                                                    <div class="options">
                                                                        <ul class="nav nav-tabs">
                                                                            <li class="active"><a href="#matriculabusqueda" data-toggle="tab">Buscar</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="panel-body">
                                                                    <div class="tab-content">
                                                                        <div class="tab-pane active" id="matriculabusqueda">
                                                                            
                                                                             <div class="form-group">
                                                                                <label class="col-md-3 control-label" for="matricula_buscar">Apellidos/Matricula</label>
                                                                                <div class="col-sm-6">
                                                                                    <input type="text" class="form-control :apostrofe"  name="matricula_buscar" id="matricula_buscar" autofocus required/>
                                                                                </div>
                                                                            </div>  
                                                                            
                                                                            
                                                                        </div>
                                                                      
                                                                    </div>
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    <div class="form-group">
                                                                        <div id="botonera" class="btn-toolbar">
                                                                            <center>   
                                                                                <button class="btn btn-primary start" type="submit">
                                                                                    <i class="fa fa-save"></i>
                                                                                    <span>Buscar</span>
                                                                                </button>
                                                                                <a data-toggle="modal"  onClick="window.location.reload()"  class="btn-default btn">Cancelar</a>                           
                                                                            </center>
                                                                        </div>
                                                                        <div id="loading-data"></div>
                                                                    </div>

                                                                    
                                                                    
                                                                    
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                       

                                                    


                                                </fieldset>  









                                                </form>
                                            </div>

                                        </div>  
                                        <br>
                                        
                                        
                                        <div id="ListaConsulta"></div>

                                        <!-- FORMULARIO EDITAR -->
                                        <div id="FormularioEditarAlumno" style="display: none;">
                                            
                                                    
                         <form action="#" class="form-horizontal" id="frm_AltaExamenInstitucional" name="frm_AltaExamenInstitucional"/>   
                                <fieldset>

                                                    
                                                    
                                                    
                                        <div class="row">
                                                <div class="col-md-12">
                                                        <div class="panel panel-midnightblue">
                                                          <div class="panel-heading">
                                                                        <h4>Datos Generales</h4>
                                                                        <div class="options"></div>
                                                          </div>
                                                          <div class="panel-body">
                                                                
                                                                    <input type="hidden" class="form-control :apostrofe" name="pk_alumno" id="pk_alumno" />
                                                                    <input type="hidden" class="form-control :apostrofe" name="Pk_ExamenInstitucional" id="Pk_ExamenInstitucional" />
                                                                    <input type="hidden" class="form-control :apostrofe" name="matricula" id="matricula"  />

                                                              
                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="matricula_desc">Matricula</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :required :apostrofe" disabled="" name="matricula_desc" id="matricula_desc" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                        </div>
                                                                    </div>
                                                               
                                                                    
                                                              
                                                              

                                                                      <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="nombre">Nombre</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :required :apostrofe"  disabled="" name="nombre" id="nombre" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                        </div>
                                                                    </div>

                                                                       <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="apaterno">apaterno</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :required :apostrofe"  disabled="" name="apaterno" id="apaterno" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                        </div>
                                                                    </div>

                                                                       <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="amaterno">amaterno</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :required :apostrofe" disabled=""  name="amaterno" id="amaterno" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                     <div class="form-group">
                                                                            <label class="col-sm-3 control-label">Carrera</label>
                                                                            <div class="col-sm-6">
                                                                                <select name="fk_carreras" id="fk_carreras" style="width:100%" disabled="" class="populate :required">
                                                                                     <option value="">-- Seleccione --</option>
                                                                                    <?php
                                                                                echo $Carreras;
                                                                                ?>
                                                                                </select>                   
                                                                            </div>
                                                                        </div>

                                                                    <div class="form-group">
                                                                          <label class="col-sm-3 control-label">Fecha de Aplicación</label>
                                                                          <div class="col-sm-6">
                                                                              <input type="text" class="form-control :apostrofe"  name="fechaaplicacion" id="fechaaplicacion" />
                                                                          </div>
                                                                      </div>
                                                                    
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label">Hora</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe " id="timepicker1" name="timepicker1"/>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                                                                             </div>
                                                        </div>
                                                </div>
                                                <div class="col-md-12">
                                                        <div class="panel panel-magenta">
                                                          <div class="panel-heading">
                                                                        <h4>Documentación</h4>
                                                                        <div class="options"></div>
                                                            </div>
                                                            <div class="panel-body">
                                                                     


           <div class="form-group">
                <label class="col-sm-3 control-label">Acta de Nacimiento</label>
                <div class="col-sm-6">
                    <div class="checkbox">
                      <label>
                          <input type="checkbox" value="1" id="ActaOriginal" name="ActaOriginal" />
                        Original
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" value="1"  id="ActaCopia" name="ActaCopia" />
                        Copia
                      </label>
                    </div>
                </div>
            </div>
                                                                
            <div class="form-group">
                <label class="col-sm-3 control-label">Certificado de Bachillerato</label>
                <div class="col-sm-6">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" value="1" id="cbOriginal" name="cbOriginal"/>
                        Original
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" value="1" id="cbCopia" name="cbCopia"/>
                        Copia
                      </label>
                    </div>
                </div>
            </div>
                                                                
           <div class="form-group">
                <label class="col-sm-3 control-label">Certificado de Licenciatura</label>
                <div class="col-sm-6">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" value="1"  id="clicOriginal" name="clicOriginal"/>
                        Original
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" value="1"  id="clicCopia" name="clicCopia"/>
                        Copia
                      </label>
                    </div>
                </div>
            </div>
                                                                
           <div class="form-group">
                <label class="col-sm-3 control-label">CURP</label>
                <div class="col-sm-6">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" value="1" id="curpOriginal" name="curpOriginal"/>
                        Original
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" value="1" id="curpCopia" name="curpCopia"/>
                        Copia
                      </label>
                    </div>
                </div>
            </div>
                                                                
           <div class="form-group">
                <label class="col-sm-3 control-label">Constancia de Servicio Social</label>
                <div class="col-sm-6">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" value="1" id="consservicioOriginal" name="consservicioOriginal"/>
                        Original
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" value="1" id="consservicioCopia" name="consservicioCopia"/>
                        Copia
                      </label>
                    </div>
                </div>
            </div>
                                                                
           <div class="form-group">
                <label class="col-sm-3 control-label">Recibo de Pago</label>
                <div class="col-sm-6">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" value="1" id="reciboOriginal" name="reciboOriginal"/>
                        Original
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" value="1" id="reciboCopia" name="reciboCopia"/>
                        Copia
                      </label>
                    </div>
                    <div >
                      <label>
                         <input type="text" class="form-control" id="recibofolio" name="recibofolio"/>
                        Folio
                      </label>
                    </div>
                  
                </div>
            </div>
                                                                
            <div class="form-group">
                <label class="col-sm-3 control-label">Certificación Internacional TRINITY (solo idiomas)</label>
                <div class="col-sm-6">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" value="1" id="triniti" name="triniti"/>
                        Original
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" value="1" id="trinitiCopia" name="trinitiCopia"/>
                        Copia
                      </label>
                    </div>
                </div>
            </div>
                                                                
           
            <div class="form-group">
                <label class="col-sm-3 control-label">Observaciones</label>
                <div class="col-sm-6">
                    <textarea class="form-control" id="ObservacionesDoc" name="ObservacionesDoc"></textarea>
                </div>
            </div>                                                   

                                                                
                                                                
                                                                
                                                                
                                                                   

                                                          </div>
                                                            
                                                           
                                                        </div>
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
                                         <!-- FIN FORMULARIO EDITAR -->
                                         
                                         
                                         
                                         
                                         
                                    </div>
                                </div>
                            </div>


                        </div>





                    </div>





                </div>
            </div>









        </div> <!-- container -->
    </div> <!--wrap -->
</div> <!-- page-content -->



</div>

<link rel='stylesheet' type='text/css' href='assets/plugins/codeprettifier/prettify.css' /> 
<link rel='stylesheet' type='text/css' href='assets/plugins/form-toggle/toggles.css' /> 

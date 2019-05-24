<?php
#AGREGADO: Ivan Mauricio Melo Granados
#FECHA: 29/05/2014 
$fk_Duracion = "";
$result = $ConsultaDB->ConDuracion();
while ($row = mysql_fetch_assoc($result)) {
    $fk_Duracion .= "<option value='$row[Pk_Duracion]'>$row[DescripcionDuracion]</option>";
}
mysql_free_result($result);

$Carreras = "";
$result = $ConsultaDB->ConsultaCarreras();
while ($row = mysql_fetch_assoc($result)) {
    $Carreras .= "<option name='Pk_carreras[]' value='$row[pk_carreras]'>$row[nombreCarrera]</option>";
}
mysql_free_result($result);



$fk_titulacion = "";
$result = $ConsultaDB->ConOpciontitulacion();
while ($row = mysql_fetch_assoc($result)) {
    $fk_titulacion .= "<option value='$row[pk_titulacion]'>$row[Nombre]</option>";
}
mysql_free_result($result);

//sinodales
$Sinodales = "";
$result = $ConsultaDB->ConsultaTodosSinodales();
while ($row = mysql_fetch_assoc($result)) {
    $Sinodales .= "<option value='$row[pk_sinodal]'>$row[nombre]</option>";
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
                <li class="active">Reportes: Toma de Protesta</li>
            </ol>

            <h1>Reportes: Toma de Protesta</h1>
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
                    <h4><i class="icon-cloud"></i> Reportes: Toma de Protesta</h4>
                    <div class="options">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#home1" data-toggle="tab"> Reportes: Toma de Protesta</a>
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
                                                <form action="#" class="form-horizontal" id="frm_busquedaTomaProtestaReportes" name="frm_busquedaTomaProtestaReportes"/>   
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
                                            
                                                    
                         <form action="#" class="form-horizontal" id="frm_AltaTomaProtesta" name="frm_AltaTomaProtesta"/>   
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
                                                                    <input type="hidden" class="form-control :apostrofe" name="pk_tramites" id="pk_tramites" />
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

                                                                   
                                                                    
                                                                                                                             </div>
                                                        </div>
                                                </div>
                                                <div class="col-md-12">
                                                        <div class="panel panel-magenta">
                                                          <div class="panel-heading">
                                                                        <h4>Toma de Protesta</h4>
                                                                        <div class="options"></div>
                                                            </div>
                                                            <div class="panel-body">
                                                                     

             <div class="form-group">
                  <label class="col-sm-3 control-label">Fecha de Aplicación</label>
                  <div class="col-sm-6">
                      <input type="text" class="form-control :apostrofe :required"  name="FechaTomaProtesta" id="FechaTomaProtesta" />
                  </div>
              </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Hora</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control :apostrofe :required" id="hora" name="hora"/>
                </div>
            </div>

             <div class="form-group">
                  <label class="col-sm-3 control-label">Salon</label>
                  <div class="col-sm-6">
                      <input type="text" class="form-control :apostrofe :required"  name="salon" id="salon" />
                  </div>
              </div>
                                                                
                                                                
           
                   <div class="form-group">
                        <label class="col-sm-3 control-label" for="fk_titulacion">Duracion</label>
                        <div class="col-sm-6">
                            <select class="form-control :required" name="fk_titulacion" id="fk_titulacion">
                                <option value="">-- Seleccione --</option>
                                <?php
                                echo $fk_titulacion;
                                ?>
                            </select>
                        </div>
                    </div>                                         
                             
                                                                
             <div class="form-group">
                  <label class="col-sm-3 control-label">Nombre de La Tesis</label>
                  <div class="col-sm-6">
                      <input type="text" class="form-control :apostrofe"  name="nombreTesis" id="nombreTesis" />
                  </div>
              </div>
           
                           
                   <div class="form-group">
                        <label class="col-sm-3 control-label" for="Fk_Duracion">Duracion</label>
                        <div class="col-sm-6">
                            <select class="form-control :required" name="Fk_Duracion" id="Fk_Duracion">
                                <option value="">-- Seleccione --</option>
                                <?php
                                echo $fk_Duracion;
                                ?>
                            </select>
                        </div>
                    </div>    
                                 
                                                                
              <!-- SINODALES  --->                                                  
           <div class="form-group">
                <label class="col-sm-3 control-label">Presidente</label>
                <div class="col-sm-6">
                    <select name="presidente" id="presidente" style="width:100%" class="populate :required">
                         <option value="">-- Seleccione --</option>
                        <?php
                        echo $Sinodales;
                        ?>
                    </select>                   
                </div>
            </div>     
              
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Secretario</label>
                <div class="col-sm-6">
                    <select name="secretario" id="secretario" style="width:100%" class="populate :required">
                         <option value="">-- Seleccione --</option>
                        <?php
                        echo $Sinodales;
                        ?>
                    </select>                   
                </div>
            </div>                 
              
              
              
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Vocal</label>
                <div class="col-sm-6">
                    <select name="vocal" id="vocal" style="width:100%" class="populate :required">
                         <option value="">-- Seleccione --</option>
                        <?php
                        echo $Sinodales;
                        ?>
                    </select>                   
                </div>
            </div>                 
              
              
               <div class="form-group">
                <label class="col-sm-3 control-label">Suplente</label>
                <div class="col-sm-6">
                    <select name="suplente" id="suplente" style="width:100%" class="populate">
                         <option value="">-- Seleccione --</option>
                        <?php
                        echo $Sinodales;
                        ?>
                    </select>                   
                </div>
            </div>                 
              
              
              
              
                                                                
            <div class="form-group">
                <label class="col-sm-3 control-label">Observaciones</label>
                <div class="col-sm-6">
                    <textarea class="form-control :apostrofe" id="observacion" name="observacion"></textarea>
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

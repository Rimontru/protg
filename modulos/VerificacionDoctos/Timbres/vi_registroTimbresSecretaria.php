<?php 
$db = new database();
if ($db->conectar() == true) {
$sql = "SELECT * FROM cat_doctos_oficiales WHERE estatus = 1";
$result = mysql_query($sql);
$opDoctos ="";
    while ($row = mysql_fetch_assoc($result)) {
        $opDoctos .= '<option value="'.$row['pk_docto'].'">'.$row['nomb_doc'].'</option>';
    }
}
mysql_free_result($result);


$NivelEstudios = "";
$result = $ConsultaDB->obtenerNivelestudio();
while ($row = mysql_fetch_assoc($result)) {
    $NivelEstudios .= "<option value='$row[pk_nivelestudio]'>$row[descripcion]</option>";
}
mysql_free_result($result);

?>
<div id="page-content">
    <div id='wrap'>
        <div id="page-heading">
            <ol class="breadcrumb">
                <li><a href="<?php echo Config::PAG_ADMIN . "?content=home2"; ?>">Inicio</a></li>
                <li class="active">Timbrado</li>
            </ol>

            <h1>Control de Timbres Registrados</h1>
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
                    <h4><i class="icon-cloud"></i> Registro de timbres</h4>
                    <div class="options">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#home1" data-toggle="tab"> Timbrado de documentos</a>
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
                                            <form action="#" class="form-horizontal" id="frm_busqueda_alumnos_timbres" name="frm_busqueda_alumnos_timbres"/>   
                                                <fieldset>                                         
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="panel panel-midnightblue">
                                                                <div class="panel-heading">
                                                                    <h4>Busqueda...</h4>
                                                                    <div class="options">
                                                                        <ul class="nav nav-tabs">
                                                                            <li class="active"><a href="#" data-toggle="tab">Buscar</a></li>
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
                                            
                                                    
                         <form action="#" class="form-horizontal" id="formulario_AlumnoModificar_RegistroTimbres" name="formulario_AlumnoModificar_RegistroTimbres"/>   
                                <fieldset>

                                                    
                                                    
                                                    
                                        <div class="row">
                                                <div class="col-md-12">
                                                        <div class="panel panel-midnightblue">
                                                          <div class="panel-heading">
                                                                        <h4>Datos del solicitante</h4>
                                                                        <div class="options"></div>
                                                          </div>
                                                          <div class="panel-body">                                                     

                                                              
 <div class="form-group">

 <input type="hidden" class="form-control :apostrofe" name="pk_alumno" id="pk_alumno" />
                                                                        <label class="col-md-3 control-label" for="matricula_desc">Matricula</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe" disabled="" name="matricula_desc" id="matricula_desc" title="ESTE CAMPO ES REQUERIDO" />
                                                                        </div>
                                                                    </div>
                                                               

                                                                      <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="nombre">Nombre</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="nombre" id="nombre" title="ESTE CAMPO ES REQUERIDO" />
                                                                        </div>
                                                                    </div>

                                                                       <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="apaterno">Apellido Paterno</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="apaterno" id="apaterno" title="ESTE CAMPO ES REQUERIDO" />
                                                                        </div>
                                                                    </div>

                                                                       <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="amaterno">Apellido Materno</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="amaterno" id="amaterno" title="ESTE CAMPO ES REQUERIDO" />
                                                                        </div>
                                                                    </div>

   <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="fk_nivelestudio">Nivel de Estudios</label>
                                                                        <div class="col-sm-6">
                                                                            <select class="form-control" name="fk_nivelestudio" id="fk_nivelestudio">
                                                                                <option value="">-- Seleccione --</option>
                                                                                <?php
                                                                                echo $NivelEstudios;
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                
                                                                
                                                                
                                                                      <div class="form-group">
                                                                            <label class="col-sm-3 control-label">Carrera</label>
                                                                            <div class="col-sm-6">
                                                                                <select class="form-control" name="fk_carreras" id="fk_carreras" style="width:100%" class="populate">
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
                                                                        <h4>Registrar timbre del documento</h4>
                                                                        <div class="options"></div>
                                                            </div>
                                                            <div class="panel-body">


                                                                <div class="form-group">
                                                                            <label class="col-sm-3 control-label">Tipo de documento</label>
                                                                            <div class="col-sm-6">
                                                                                <select class="form-control" name="fk_documento" id="fk_documento" style="width:100%" class="populate">
                                                                                    <option value="0">-- Seleccione --</option>
                                                                                    <?php echo $opDoctos; ?>
                                                                                </select>                   
                                                                            </div>
                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="folio">Folio del Documento</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="folio_doc" id="folio_doc" title="ESTE CAMPO ES REQUERIDO" />
                                                                        </div>
                                                                    </div>
                                                                    

                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="folio">Folio Timbre</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="folio_timbre" id="folio_timbre" title="ESTE CAMPO ES REQUERIDO" />
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="hora">Plantilla</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="plantilla" id="plantilla" title="ESTE CAMPO ES REQUERIDO" />
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                    <label class="col-sm-3 control-label">Observaciones</label>
                                                                    <div class="col-sm-6">
                                                                        <textarea class="form-control autosize" name="observaciones" id="observaciones" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 112.233px;"></textarea>
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









        </div> <!-- container -->
    </div> <!--wrap -->
</div> <!-- page-content -->



</div>
<link rel='stylesheet' type='text/css' href='assets/plugins/codeprettifier/prettify.css' /> 
<link rel='stylesheet' type='text/css' href='assets/plugins/form-toggle/toggles.css' /> 

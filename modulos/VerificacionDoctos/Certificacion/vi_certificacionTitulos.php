<?php 
$db = new database();
if ($db->conectar() == true) {
$sql = "SELECT * FROM cat_opciontitulacion WHERE estatusTitulacion=1 ORDER BY Nombre";
$result = mysql_query($sql);
$opciones ="";
    while ($row = mysql_fetch_assoc($result)) {
        $opciones .= '<option value="'.$row['Nombre'].'">'.$row['Nombre'].'</option>';
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
                <li class="active">Certificaci&oacute;n</li>
            </ol>

            <h1>Certificaci&oacute;n de titulos</h1>
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
                    <h4><i class="icon-cloud"></i> Certificaci&oacute;n a petici&oacute;n</h4>
                    <div class="options">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#home1" data-toggle="tab"> Certificaci&oacute;n</a>
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
                                            <form action="#" class="form-horizontal" id="frm_busqueda_alumnos_certificados" name="frm_busqueda_alumnos_certificados"/>   
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
                                            
                                                    
                         <form action="#" class="form-horizontal" id="formulario_AlumnoModificar_Certificacion" name="formulario_AlumnoModificar_Certificacion"/>   
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
                                                                        <h4>Generar Certificado a petici&oacute;n</h4>
                                                                        <div class="options"></div>
                                                            </div>
                                                            <div class="panel-body">


                                                                <div class="form-group">
                                                                            <label class="col-sm-3 control-label">Tipo de solicitud</label>
                                                                            <div class="col-sm-6">
                                                                                <select class="form-control" name="tipo_certificacion" id="tipo_certificacion" style="width:100%" class="populate">
                                                                                    <option value="NULL">-- Seleccione --</option>
                                                                                    <option value="EXLIC"> Certificado de Examen Licenciatura </option>
                                                                                    <option value="EXPOS"> Certificado de Examen Posgrado</option>
                                                                                    <option value="TILIC"> Certificado de Titulo Licenciatura</option>
                                                                                    <option value="TIPOS"> Certificado de  Posgrado</option>
                                                                                </select>                   
                                                                            </div>
                                                                    </div>
                                                                       



                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="folio">Folio Solicitud</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="folio" id="folio" title="ESTE CAMPO ES REQUERIDO" />
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="hora">Hora del documento</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="hora_certificado" id="hora_certificado" title="ESTE CAMPO ES REQUERIDO" />
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="fecha">Fecha del documento</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="fecha_certificado" id="fecha_certificado" title="ESTE CAMPO ES REQUERIDO" />
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="veredicto">Veredicto</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="veredicto" id="veredicto" title="ESTE CAMPO ES REQUERIDO" value="ACREDITADO" />
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="titulado por">Opcion de titulacion</label>
                                                                        <div class="col-sm-6">
                                                                            <select class="form-control :apostrofe populate"  id="opcion_titulacion" name="opcion_titulacion">
                                                                                <?php echo $opciones; ?>  
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="presidente">Presidente</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="presidente" id="presidente" title="ESTE CAMPO ES REQUERIDO" />
                                                                        </div>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="secretario">Secretario</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="secretario" id="secretario" title="ESTE CAMPO ES REQUERIDO" />
                                                                        </div>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="vocal">Vocal</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="vocal" id="vocal" title="ESTE CAMPO ES REQUERIDO" />
                                                                        </div>
                                                                    </div>
                                                          </div>
                                                        </div>
                                                </div>
                                                                                        <div class="row">
                                                <div class="col-md-12">
                                                        <div class="panel panel-midnightblue">
                                                          <div class="panel-heading">
                                                                        <h4>Llenado respecto a títulos</h4>
                                                                        <div class="options"></div>
                                                          </div>
                                                          <div class="panel-body">                                                     

                                                              
 <div class="form-group">

    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="legalizo">Legaliz&oacute;</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="legalizo" id="legalizo" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                    </div>


                                                                     <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="registro">Registr&oacute;</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="registro" id="registro" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="fecha_examen">Fecha de examen reglamentario</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="fecha_examen" id="fecha_examen" title="ESTE CAMPO ES REQUERIDO" />
                                                                        </div>
                                                                    </div>

                                                                     <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="no_registro">Número de registro</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="no_registro" id="no_registro" title="ESTE CAMPO ES REQUERIDO" />
                                                                        </div>
                                                                    </div>

                                                                     <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="holograma">Serie de Holograma</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="holograma" id="holograma" title="ESTE CAMPO ES REQUERIDO" />
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="foja_no">Número de foja título</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="foja_no" id="foja_no" title="ESTE CAMPO ES REQUERIDO" />
                                                                        </div>
                                                                    </div>


                                                                     <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="libro">Libro de registro</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="libro" id="libro" title="ESTE CAMPO ES REQUERIDO" />
                                                                        </div>
                                                                    </div>


                                                        </div>
                                                </div>
                                                

                                                   <div class="form-group">
                                                        <div id="botonera" class="btn-toolbar">
                                                            <center>   
                                                                <button class="btn btn-primary start" type="submit">
                                                                    <i class="fa fa-save"></i>
                                                                    <span>Generar</span>
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

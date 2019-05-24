<?php
#AGREGADO: Ivan Mauricio Melo Granados
#FECHA: 29/05/2014 
$Genero = "";
$result = $ConsultaDB->ConsultaGenero();
while ($row = mysql_fetch_assoc($result)) {
    $Genero .= "<option value='$row[pk_genero]'>$row[descripcion]</option>";
}
mysql_free_result($result);


//$Carreras = "";
//$result = $ConsultaDB->ConsultaCarreras();
//while ($row = mysql_fetch_assoc($result)) {
//    $Carreras .= "<option name='Pk_carreras[]' value='$row[pk_carreras]'>$row[nombreCarrera]</option>";
//}
//mysql_free_result($result);


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


$Modalidad = "";
$result = $ConsultaDB->obtenerModalidad();
while ($row = mysql_fetch_assoc($result)) {
    $Modalidad .= "<option value='$row[pk_modalidad]'>$row[nombreMod]</option>";
}
mysql_free_result($result);



$NivelEstudios = "";
$result = $ConsultaDB->obtenerNivelestudio();
while ($row = mysql_fetch_assoc($result)) {
    $NivelEstudios .= "<option value='$row[pk_nivelestudio]'>$row[descripcion]</option>";
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
                <li class="active">Alumnos</li>
            </ol>

            <h1>Alumnos</h1>
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
                    <h4><i class="icon-cloud"></i> Alumnos: Modificar</h4>
                    <div class="options">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#home1" data-toggle="tab"> Alumnos: Modificar</a>
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
                                                <form action="#" class="form-horizontal" id="frm_busqueda_alumnos_modificar" name="frm_busqueda_alumnos_modificar"/>   
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
                                            
                                                    
                         <form action="#" class="form-horizontal" id="formulario_AlumnoModificar" name="formulario_AlumnoModificar"/>   
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
                                                                    <input type="hidden" class="form-control :apostrofe" name="matricula" id="matricula"  />
                                                                    <input type="hidden" class="form-control :apostrofe" name="pk_egresados" id="pk_egresados" />

                                                              
                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="matricula_desc">Matricula</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe" disabled="" name="matricula_desc" id="matricula_desc" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                        </div>
                                                                    </div>
                                                               
                                                            
                                                              
                                                              

                                                                      <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="nombre">Nombre</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="nombre" id="nombre" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                        </div>
                                                                    </div>

                                                                       <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="apaterno">Apellido Paterno</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="apaterno" id="apaterno" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                        </div>
                                                                    </div>

                                                                       <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="amaterno">Apellido Materno</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="amaterno" id="amaterno" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                        </div>
                                                                    </div>




                                                                        <div class="form-group">
                                                                            <label class="col-sm-3 control-label">Estado</label>
                                                                            <div class="col-sm-6">
                                                                                <select name="v_estado" id="v_estado" style="width:100%" class="populate">
                                                                                     <option value="">-- Seleccione --</option>
                                                                                    <?php
                                                                                    echo $Estados;
                                                                                    ?>
                                                                                </select>                   
                                                                            </div>
                                                                        </div>


                                                                       <div class="form-group">
                                                                            <label class="col-sm-3 control-label">Municipio</label>
                                                                            <div class="col-sm-6">
                                                                                <select name="v_Municipio" id="v_Municipio" style="width:100%" class="populate">
                                                                                     <option value="">-- Seleccione --</option>

                                                                                </select>                   
                                                                            </div>
                                                                        </div>




                                                                        <div class="form-group">
                                                                            <label class="col-sm-3 control-label">Colonia/Fraccionamiento</label>
                                                                            <div class="col-sm-6">
                                                                                <select name="v_coloniafracc" id="v_coloniafracc" style="width:100%" class="populate">
                                                                                     <option value="">-- Seleccione --</option>

                                                                                </select>                   
                                                                            </div>
                                                                        </div>






                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="direccion">Dirección</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="direccion" id="direccion" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                    </div>



                                                                      <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="codigopostal">Codigo Postal</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="codigopostal" id="codigopostal" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                    </div>


                                                                     <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="curp">curp</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="curp" id="curp" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                          <label class="col-sm-3 control-label">Fecha de Nacimiento</label>
                                                                          <div class="col-sm-6">
                                                                              <input type="text" class="form-control :apostrofe"  name="FechaNacimiento" id="FechaNacimiento" />
                                                                          </div>
                                                                      </div>

                                                                     <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="correo">Correo</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe :email"  name="correo" id="correo" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="fk_genero">Genero</label>
                                                                        <div class="col-sm-6">
                                                                            <select class="form-control" name="fk_genero" id="fk_genero">
                                                                                <option value="">-- Seleccione --</option>
                                                                                <?php
                                                                                echo $Genero;
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>




                                                                     <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="telefonofijo">Teléfono Fijo</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="telefonofijo" id="telefonofijo" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                    </div>

                                                                      <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="telefonocelular">Teléfono Celular</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="telefonocelular" id="telefonocelular" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                    </div>

                                                          </div>
                                                        </div>
                                                </div>
                                                <div class="col-md-12">
                                                        <div class="panel panel-magenta">
                                                          <div class="panel-heading">
                                                                        <h4>Datos Escolares</h4>
                                                                        <div class="options"></div>
                                                            </div>
                                                            <div class="panel-body">
                                                                
                                                                
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
                                                                        <label class="col-sm-3 control-label" for="fk_modalidad">Modalidad</label>
                                                                        <div class="col-sm-6">
                                                                            <select class="form-control" name="fk_modalidad" id="fk_modalidad">
                                                                                <option value="">-- Seleccione --</option>
                                                                                <?php
                                                                                echo $Modalidad;
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                
                                                                
                                                                
                                                                      <div class="form-group">
                                                                            <label class="col-sm-3 control-label">Carrera</label>
                                                                            <div class="col-sm-6">
                                                                                <select name="fk_carreras" id="fk_carreras" style="width:100%" class="populate">
                                                                                     <option value="">-- Seleccione --</option>
                                                                                    <?php
                                                                                echo $Carreras;
                                                                                ?>
                                                                                </select>                   
                                                                            </div>
                                                                        </div>



                                                                     <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="fk_turnos">Turno</label>
                                                                        <div class="col-sm-6">
                                                                            <select class="form-control" name="fk_turnos" id="fk_turnos">
                                                                                <option value="">-- Seleccione --</option>
                                                                                <?php
                                                                                echo $Turnos;
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>



                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="planEstudios">Plan de Estudios</label>
                                                                        <div class="col-sm-6">
                                                                            <select class="form-control" name="planEstudios" id="planEstudios">
                                                                                <option value="">-- Seleccione --</option>
                                                                                <?php
                                                                                echo $PlanEstudios;
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>




                                                                     <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="fk_generacion">Generación</label>
                                                                        <div class="col-sm-6">
                                                                            <select class="form-control" name="fk_generacion" id="fk_generacion">
                                                                                <option value="">-- Seleccione --</option>
                                                                                <?php
                                                                                echo $Generacion;
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                     <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="generacionNumero">Generación Numero</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="generacionNumero" id="generacionNumero" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="promedio">Promedio</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="promedio" id="promedio" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="letraPromedio">Letra Promedio</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="letraPromedio" id="letraPromedio" title="ESTE CAMPO ES REQUERIDO"/>
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

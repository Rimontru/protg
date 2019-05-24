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




$Anios = "";
$result = $ConsultaDB->ConAnios();
while ($row = mysql_fetch_assoc($result)) {
    $Anios .= "<option value='$row[pk_anios]'>$row[descripcion]</option>";
}
mysql_free_result($result);




$EstadoTitulacion = "";
$result = $ConsultaDB->ConEstadoTitulacion();
while ($row = mysql_fetch_assoc($result)) {
    $EstadoTitulacion .= "<option value='$row[pk_estadoTitulacion]'>$row[descripcion]</option>";
}
mysql_free_result($result);


//querys para la encuesta
$EstadoCivil = "";
$result = $ConsultaDB->ConEstadoCivil();
while ($row = mysql_fetch_assoc($result)) {
    $EstadoCivil .= "<option value='$row[Pk_estadocivil]'>$row[descripcion_estadocivil]</option>";
}
mysql_free_result($result);



$fk_estudiosposgrado = "";
$result = $ConsultaDB->ConEstudiosposgrado();
while ($row = mysql_fetch_assoc($result)) {
    $fk_estudiosposgrado .= "<option value='$row[pk_estudiosposgrado]'>$row[descripcion_estudiosposgrado]</option>";
}
mysql_free_result($result);


$fk_ramaposgrado = "";
$result = $ConsultaDB->ConRamaPosgrado();
while ($row = mysql_fetch_assoc($result)) {
    $fk_ramaposgrado .= "<option value='$row[pk_ramaposgrado]'>$row[descripcion_ramaposgrado]</option>";
}
mysql_free_result($result);


$fk_institucioneslabora = "";
$result = $ConsultaDB->Coninstitucioneslabora();
while ($row = mysql_fetch_assoc($result)) {
    $fk_institucioneslabora .= "<option value='$row[pk_institucioneslabora]'>$row[descripcion_institucioneslabora]</option>";
}
mysql_free_result($result);


$fk_puestosmedicina = "";
$result = $ConsultaDB->ConaPuestosmedicina();
while ($row = mysql_fetch_assoc($result)) {
    $fk_puestosmedicina .= "<option value='$row[pk_puestosmedicina]'>$row[descripcion_puestosmedicina]</option>";
}
mysql_free_result($result);


$fk_ingresoactual = "";
$result = $ConsultaDB->Coningresoactual();
while ($row = mysql_fetch_assoc($result)) {
    $fk_ingresoactual .= "<option value='$row[pk_ingresoactual]'>$row[descripcion_ingresoactual]</option>";
}
mysql_free_result($result);


$GradoCienciasBasicas = "";
$result = $ConsultaDB->ConEncuesta_calif();
while ($row = mysql_fetch_assoc($result)) {
    $GradoCienciasBasicas .= "<option value='$row[pk_encuesta_calif]'>$row[descripcion_encuesta_calif]</option>";
}
mysql_free_result($result);


$fk_aspectodebilidad = "";
$result = $ConsultaDB->ConAspectoDebilidad();
while ($row = mysql_fetch_assoc($result)) {
    $fk_aspectodebilidad .= "<option value='$row[pk_aspectodebilidad]'>" . utf8_encode($row['descripcion_aspectodebilidad']) . "</option>";
}
mysql_free_result($result);




$fk_gradosatisfaccion = "";
$result = $ConsultaDB->ConGradoSatisfaccion();
while ($row = mysql_fetch_assoc($result)) {
    $fk_gradosatisfaccion .= "<option value='$row[pk_gradosatisfaccion]'>$row[descripcion_gradosatisfaccion]</option>";
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
                <li><a>Egresados</a></li>
                <li class="active">Encuesta Maestria</li>
            </ol>

            <h1>Encuesta Maestria</h1>
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
                    <h4><i class="icon-cloud"></i> Encuesta Maestria</h4>
                    <div class="options">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#home1" data-toggle="tab"> Encuesta Maestria</a>
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
                                                <form action="#" class="form-horizontal" id="frm_busqueda_encuestaEgresadosMaestria" name="frm_busqueda_encuestaEgresadosMaestria"/>   
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


                                            <form action="#" class="form-horizontal" id="frm_datosEncuestaMaestria" name="frm_datosEncuestaMaestria"/>   
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
                                                                <input type="hidden" class="form-control :apostrofe" name="pk_encuestamaestria" id="pk_encuestamaestria" />


                                                                <div class="form-group">
                                                                    <label class="col-md-3 control-label" for="matricula_desc">Matricula</label>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" class="form-control :required :apostrofe" disabled="" name="matricula_desc" id="matricula_desc" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                    </div>
                                                                </div>





                                                                <div class="form-group">
                                                                    <label class="col-md-3 control-label" for="nombre">Nombre</label>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" class="form-control :required :apostrofe"  name="nombre" id="nombre" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="col-md-3 control-label" for="apaterno">apaterno</label>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" class="form-control :required :apostrofe"  name="apaterno" id="apaterno" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="col-md-3 control-label" for="amaterno">amaterno</label>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" class="form-control :required :apostrofe"  name="amaterno" id="amaterno" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                    </div>
                                                                </div>




                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label">Fecha de Nacimiento</label>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" class="form-control :required :apostrofe"  name="FechaNacimiento" id="FechaNacimiento" />
                                                                    </div>
                                                                </div>





                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label" for="fk_genero">Genero</label>
                                                                    <div class="col-sm-6">
                                                                        <select class="form-control :required" name="fk_genero" id="fk_genero">
                                                                            <option value="">-- Seleccione --</option>
                                                                            <?php
                                                                            echo $Genero;
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>





                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label" for="telefonofijo">Telefono Fijo</label>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" class="form-control :apostrofe"  name="telefonofijo" id="telefonofijo" title="ESTE CAMPO ES REQUERIDO"/>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label" for="telefonocelular">Telefono Celular</label>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" class="form-control :apostrofe"  name="telefonocelular" id="telefonocelular" title="ESTE CAMPO ES REQUERIDO"/>
                                                                    </div>
                                                                </div>





                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label" for="correo">Correo</label>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" class="form-control :apostrofe :email"  name="correo" id="correo" title="ESTE CAMPO ES REQUERIDO"/>
                                                                    </div>
                                                                </div>



                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label">Estado</label>
                                                                    <div class="col-sm-6">
                                                                        <select name="v_estado" id="v_estado" style="width:100%" class="populate :required">
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
                                                                        <select name="v_Municipio" id="v_Municipio" style="width:100%" class="populate :required">
                                                                            <option value="">-- Seleccione --</option>

                                                                        </select>                   
                                                                    </div>
                                                                </div>




                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label">Colonia/Fraccionamiento</label>
                                                                    <div class="col-sm-6">
                                                                        <select name="v_coloniafracc" id="v_coloniafracc" style="width:100%" class="populate :required">
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
                                                                    <label class="col-sm-3 control-label" for="codigopostal">codigo postal</label>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" class="form-control :required :apostrofe"  name="codigopostal" id="codigopostal" title="ESTE CAMPO ES REQUERIDO"/>
                                                                    </div>
                                                                </div>












                                                            </div>
                                                        </div>
                                                    </div>





                                                    <div class="col-md-12">
                                                        <div class="panel panel-sky">
                                                            <div class="panel-heading">
                                                                <h4>Desarrollo Académico</h4>
                                                                <div class="options"></div>
                                                            </div>
                                                            <div class="panel-body">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>                                                     
                                                                            <th><center></center></th>
                                                                    <th><center></center></th>
                                                                    <th><center></center></th>
                                                                    <th><center></center></th>


                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                Licenciatura
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form-control :apostrofe"  name="DA_Licenciatura" id="DA_Licenciatura"/>
                                                                            </td>
                                                                            <td>
                                                                                Institución
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form-control :apostrofe"  name="DA_LicenciaturaInst" id="DA_LicenciaturaInst"/>
                                                                            </td>
                                                                        </tr>
                                                                    <td>
                                                                        Maestria
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control :apostrofe"  name="DA_Maestria" id="DA_Maestria"/>
                                                                    </td>
                                                                    <td>
                                                                        No. Control
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control :apostrofe"  name="DA_MaestriaInst" id="DA_MaestriaInst"/>
                                                                    </td>
                                                                    </tr>
                                                                    <td>
                                                                        Doctorado
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control :apostrofe"  name="DA_Doctorado" id="DA_Doctorado"/>
                                                                    </td>
                                                                    <td>
                                                                        Institución
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control :apostrofe"  name="DA_DoctoradoInst" id="DA_DoctoradoInst"/>
                                                                    </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            Especialidad
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" class="form-control :apostrofe"  name="DA_Especialidad" id="DA_Especialidad"/>
                                                                        </td>
                                                                        <td>
                                                                            Institución
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" class="form-control :apostrofe"  name="DA_EspecialidadInst" id="DA_EspecialidadInst"/>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    
                                                       <div class="col-md-12">
                                                        <div class="panel panel-sky">
                                                            <div class="panel-heading">
                                                                <h4>Desarrollo Laboral</h4>
                                                                <div class="options"></div>
                                                            </div>
                                                            <div class="panel-body">
                                                                
                                                                
                                                                 <div class="form-group">
                                                                    <label class="col-sm-3 control-label" for="DL_TrabajaActualmente">Trabaja Actualmente</label>
                                                                    <div class="col-sm-6">
                                                                        <select class="form-control :required" name="DL_TrabajaActualmente" id="DL_TrabajaActualmente">
                                                                            <option value="">-- Seleccione --</option>
                                                                            <option value="1">Si</option>
                                                                            <option value="2">No</option>
                                                                           
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                                   <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="DL_EmpresaColabora">Nombre de la Empresa donde colabora</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="DL_EmpresaColabora" id="DL_EmpresaColabora"/>
                                                                        </div>
                                                                    </div>          
                                                                <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="DL_PuestoDesempena">Puesto que desempeña:</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="DL_PuestoDesempena" id="DL_PuestoDesempena"/>
                                                                        </div>
                                                                    </div>      
                                                                   <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="DL_DireccionEmpresa">Dirección de la Empresa:</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="DL_DireccionEmpresa" id="DL_DireccionEmpresa"/>
                                                                        </div>
                                                                    </div>     
                                                                <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="DL_TelefonoEmpresa">Teléfono de la Empresa:</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="DL_TelefonoEmpresa" id="DL_TelefonoEmpresa"/>
                                                                        </div>
                                                                    </div>     
                                                                <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="DL_Mail">Mail:</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="DL_Mail" id="DL_Mail"/>
                                                                        </div>
                                                                    </div>     
                                                                 <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="DL_JefeInmediato">Nombre del Jefe Inmediato:</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="DL_JefeInmediato" id="DL_JefeInmediato"/>
                                                                        </div>
                                                                    </div>   
                                                                
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label">Opinión sobre el contenido del plan de Estudios.</label>
                                                                    <div class="col-sm-6">
                                                                        <textarea class="form-control autosize" name="DL_OpinionPlan" id="DL_OpinionPlan" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 112.233px;"></textarea>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label" for="DL_CalifPlan">Que le parecio el plan de estudio de su maestria</label>
                                                                    <div class="col-sm-6">
                                                                        <select class="form-control :required" name="DL_CalifPlan" id="DL_CalifPlan">
                                                                            <option value="">-- Seleccione --</option>
                                                                            <option value="1">Excelente</option>
                                                                            <option value="2">Bueno</option>
                                                                            <option value="2">Regular</option>
                                                                            <option value="2">Malo</option>
                                                                           
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                                 <div class="form-group">
                                                                    <label class="col-sm-3 control-label" for="DL_Satisfaccion">Grado de Satisfacción del (1 al 10) que te deja la formación recibida por la Institución</label>
                                                                    <div class="col-sm-6">
                                                                        <select class="form-control :required" name="DL_Satisfaccion" id="DL_Satisfaccion">
                                                                            <option value="">-- Seleccione --</option>
                                                                            <option value="1">1</option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                            <option value="4">4</option>
                                                                            <option value="5">5</option>
                                                                            <option value="6">6</option>
                                                                            <option value="7">7</option>
                                                                            <option value="8">8</option>
                                                                            <option value="9">9</option>
                                                                            <option value="10">10</option>
                                                                        </select>
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

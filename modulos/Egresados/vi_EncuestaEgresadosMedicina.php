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
    $fk_aspectodebilidad .= "<option value='$row[pk_aspectodebilidad]'>".utf8_encode($row['descripcion_aspectodebilidad'])."</option>";
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
                <li class="active">Encuesta Medicina</li>
            </ol>

            <h1>Encuesta Medicina</h1>
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
                    <h4><i class="icon-cloud"></i> Encuesta Medicina</h4>
                    <div class="options">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#home1" data-toggle="tab"> Encuesta Medicina</a>
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
                                                <form action="#" class="form-horizontal" id="frm_busqueda_encuestaEgresadosMedicina" name="frm_busqueda_encuestaEgresadosMedicina"/>   
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
                                        <div id="FormularioEditarAlumno" style="display:none ;">
												<div class="row">
                                                    <div class="col-md-12">
                                                        <div class="panel panel-midnightblue">
                                                            <div class="panel-heading">
                                                                <h4>Foto de Perfil  </h4>                                              
                                                            </div>
                                                            <form action="#" class="form-horizontal" name="fotoperfil" id="fotoperfil" />
                                                            <div class="panel-body collapse in"> 
                                                                <div id="foto" style="display:none ;">
                                                                       
                                                                    </div>  
 

                                                            </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!--End Row 1-->                                            
                                                    
                         <form action="#" class="form-horizontal" id="frm_datosEncuestaMedicina" name="frm_datosEncuestaMedicina"/>   
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
                                                                    <input type="hidden" class="form-control :apostrofe" name="Pk_EncuestaMedicina" id="Pk_EncuestaMedicina" />

                                                              
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
                                                                        <h4>Encuesta</h4>
                                                                        <div class="options"></div>
                                                            </div>
                                                         
                                                            
                                                            <div class="panel-body">
                                                                
                                                                
                                                              <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="EdadAlumno">Edad</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="EdadAlumno" id="EdadAlumno" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                        </div>
                                                                    </div>
                                                                
                                                                
                                                                 <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="fk_estadocivil">Estado Civil</label>
                                                                        <div class="col-sm-6">
                                                                            <select class="form-control" name="fk_estadocivil" id="fk_estadocivil">
                                                                                <option value="" selected>-- Seleccione --</option>
                                                                               <?php
                                                                                    echo $EstadoCivil;
                                                                                    ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                
                                                                
                                                                
                                                                 
                                                                
                                                                
                                                                

                                                                     <div class="form-group">
                                                                        <label class="col-sm-3 control-label">Año Inicio de la Licenciatura</label>
                                                                        <div class="col-sm-6">
                                                                            <select style="width:100%" class="populate" name="AnoInicioLicenciatura" id="AnoInicioLicenciatura">
                                                                                 <option value="">-- Seleccione --</option>
                                                                                 <?php
                                                                                    echo $Anios;
                                                                                 ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                
                                                                 
                                                                <div class="form-group">
                                                                        <label class="col-sm-3 control-label">Año Conclusión de la Licenciatura</label>
                                                                        <div class="col-sm-6">
                                                                            <select style="width:100%" class="populate" name="AnoFinLicenciatura" id="AnoFinLicenciatura">
                                                                                 <option value="">-- Seleccione --</option>
                                                                                 <?php
                                                                                    echo $Anios;
                                                                                 ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                
                                                                 
                                                                 
                                          
                                                                  
                                                                 <div class="form-group">
                                                                    <label class="col-sm-3 control-label" for="fk_estudiosposgrado">Estudios de Postgrado</label>
                                                                    <div class="col-sm-6">
                                                                        <select class="form-control" name="fk_estudiosposgrado" id="fk_estudiosposgrado">
                                                                            <option value="">-- Seleccione --</option>
                                                                             <?php
                                                                                 echo $fk_estudiosposgrado;
                                                                             ?>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                
                                                                   <div class="form-group" style="display: block;" id="DIVEstudioPosgradoMedicinaOtros">
                                                                        <label class="col-md-3 control-label" for="EstudioPosgradoMedicinaOtros">¿Cuál?</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="EstudioPosgradoMedicinaOtros" id="EstudioPosgradoMedicinaOtros" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                                       
                                                                
                                                                
                                          
                                                                  <div class="form-group">
                                                                    <label class="col-sm-3 control-label" for="fk_ramaposgrado">Rama de Posgrado</label>
                                                                    <div class="col-sm-6">
                                                                        <select class="form-control" name="fk_ramaposgrado" id="fk_ramaposgrado">
                                                                            <option value="">-- Seleccione --</option>
                                                                           <?php
                                                                                 echo $fk_ramaposgrado;
                                                                             ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                
                                                                                                               

                                                                
                                                                 <div class="form-group" style="">
                                                                    <label class="col-sm-3 control-label" for="fk_institucioneslabora">Institución en que Labora (Si es Sanatorio,Clinica Privada u Otros, Favor de colocar el Nombre de la Institucion)</label>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" class="form-control :apostrofe " name="fk_institucioneslabora" id="fk_institucioneslabora" autofocus/>
                                                                        
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                                 <div class="form-group" style="display:none;" id="">
                                                                        <label class="col-md-3 control-label" for="InstitucionLaboraMedicinaOtros"><strong>Escriba el Nombre de la Institución</strong></label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="InstitucionLaboraMedicinaOtros" id="InstitucionLaboraMedicinaOtros" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                        </div>
                                                                    </div>
                                                                
                                                                
                                                                
                                                                  <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="DireccionInstitucionLabora">Dirección de la Institución en que labora</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="DireccionInstitucionLabora" id="DireccionInstitucionLabora" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                    </div>

                                                                
                                                                
                                                                
                                                                 <div class="form-group">
                                                                    <label class="col-sm-3 control-label" for="fk_puestosmedicina">Puesto que Desempeña</label>
                                                                    <div class="col-sm-6">
                                                                        <select class="form-control" name="fk_puestosmedicina" id="fk_puestosmedicina">
                                                                            <option value="">-- Seleccione --</option>
                                                                            <?php
                                                                                 echo $fk_puestosmedicina;
                                                                             ?>                                                                    
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                                   <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="FuncionesDesempenaMedicina">Describa brevemente las funciones que desempeña</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="FuncionesDesempenaMedicina" id="FuncionesDesempenaMedicina" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                    </div>
                                                                
                                                                
                                                                
                                                                
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label" for="fk_ingresoactual">Ingreso Actual</label>
                                                                    <div class="col-sm-6">
                                                                        <select class="form-control " name="fk_ingresoactual" id="fk_ingresoactual">
                                                                            <option value="">-- Seleccione --</option>
                                                                            <?php
                                                                                 echo $fk_ingresoactual;
                                                                             ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                        
                                                                
                                                                
                                                                
                                                          <div class="form-group">
                                                                    <label class="col-sm-3 control-label" for="OrdenCrono">Mencione en orden Cronólogico, desde que egreso de la Escuela hasta la fecha, los puestos que ha desempeñado por lo menos durante un periodo de 6 meses:</label>
                                                                    <div class="col-sm-6">
                                                                      <table class="table">
                                                                            <thead>
                                                                              <tr>                                                     
                                                                                <th><center>PUESTO</center></th>
                                                                                <th><center>INSTITUCIÓN Ó EMPRESA</center></th>
                                                                                <th><center>TIEMPO QUE LABORÓ</center></th>
                                                                              </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                              <tr>
                                                                                <td>
                                                                                    <input type="text" class="form-control :apostrofe"  name="PuestoUno" id="PuestoUno" title="ESTE CAMPO ES REQUERIDO"/>
                                                                                </td>
                                                                                <td>
                                                                                    <input type="text" class="form-control :apostrofe"  name="InstitucionEmpresaUno" id="InstitucionEmpresaUno" title="ESTE CAMPO ES REQUERIDO"/>
                                                                                </td>
                                                                                <td>
                                                                                    <input type="text" class="form-control :apostrofe"  name="TiempoQueLaboroUno" id="TiempoQueLaboroUno" title="ESTE CAMPO ES REQUERIDO"/>
                                                                                </td>
                                                                              </tr>
                                                                                <td>
                                                                                    <input type="text" class="form-control :apostrofe"  name="PuestoDos" id="PuestoDos" title="ESTE CAMPO ES REQUERIDO"/>
                                                                                </td>
                                                                                <td>
                                                                                    <input type="text" class="form-control :apostrofe"  name="InstitucionEmpresaDos" id="InstitucionEmpresaDos" title="ESTE CAMPO ES REQUERIDO"/>
                                                                                </td>
                                                                                <td>
                                                                                    <input type="text" class="form-control :apostrofe"  name="TiempoQueLaboroDos" id="TiempoQueLaboroDos" title="ESTE CAMPO ES REQUERIDO"/>
                                                                                </td>
                                                                              </tr>
                                                                               <td>
                                                                                    <input type="text" class="form-control :apostrofe"  name="PuestoTres" id="PuestoTres" title="ESTE CAMPO ES REQUERIDO"/>
                                                                                </td>
                                                                                <td>
                                                                                    <input type="text" class="form-control :apostrofe"  name="InstitucionEmpresaTres" id="InstitucionEmpresaTres" title="ESTE CAMPO ES REQUERIDO"/>
                                                                                </td>
                                                                                <td>
                                                                                    <input type="text" class="form-control :apostrofe"  name="TiempoQueLaboroTres" id="TiempoQueLaboroTres" title="ESTE CAMPO ES REQUERIDO"/>
                                                                                </td>
                                                                              </tr>
                                                                            </tbody>
                                                                          </table>

                                                                    </div>
                                                                </div>      
                                                                
                                                                
                                                                
                                              
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                               
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                 <div class="form-group">
                                                                    <label class="col-sm-3 control-label" for="PerteneceOrganizacionSocial">Pertenece a alguna Organización Social ó Profesional</label>
                                                                    <div class="col-sm-6">
                                                                        <select class="form-control" name="PerteneceOrganizacionSocial" id="PerteneceOrganizacionSocial">
                                                                            <option value="">-- Seleccione --</option>
                                                                            <option value="1">Si</option>
                                                                            <option value="2">No</option>
                                                                           
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                
                                                               
                                                                     <div class="form-group" style="display: none;" id="DIVPerteneceOrganizacionSocialSi">
                                                                        <label class="col-md-3 control-label" for="PerteneceOrganizacionSocialSi"><strong>Escriba el Nombre de la Organización Social ó Profesional</strong></label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="PerteneceOrganizacionSocialSi" id="PerteneceOrganizacionSocialSi" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                        </div>
                                                                    </div>
                                                                
                                                                
                                                                
                                                                 <div class="form-group">
                                                                    <label class="col-sm-3 control-label" for="CertificacionProfesional">Cuenta con Alguna Certificación Profesional</label>
                                                                    <div class="col-sm-6">
                                                                        <select class="form-control " name="CertificacionProfesional" id="CertificacionProfesional">
                                                                            <option value="">-- Seleccione --</option>
                                                                            <option value="1">Si</option>
                                                                            <option value="2">No</option>
                                                                           
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                                <div id="DIVCertificacionProfesionalSi" style="display: none;">
                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="CertificacionProfesionalFecha"><strong>Fecha</strong></label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="CertificacionProfesionalFecha" id="CertificacionProfesionalFecha" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="CertificacionProfesionalOrganismo"><strong>Organismo que lo Otorga</strong></label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="CertificacionProfesionalOrganismo" id="CertificacionProfesionalOrganismo" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                        </div>
                                                                    </div>
                                                                 </div>                                                    
                                                                    
                                                                  <div class="form-group">
                                                                    <label class="col-sm-3 control-label" for="CapacitacionTrabajoActual">Ha recibido Capacitación en su Trabajo Actual</label>
                                                                    <div class="col-sm-6">
                                                                        <select class="form-control" name="CapacitacionTrabajoActual" id="CapacitacionTrabajoActual">
                                                                            <option value="">-- Seleccione --</option>
                                                                            <option value="1">Si</option>
                                                                            <option value="2">No</option>
                                                                           
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                
                                                                    

                                                                
                                                                <div class="alert alert-dismissable alert-success">
                                                                        <strong>Opiniones</strong> Sobre el Contenido del Plan de Estudios.
                                                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                                                </div>
                                                                
                                                                
                                                                 <div class="form-group">
                                                                    <label class="col-sm-3 control-label" for="GradoCienciasBasicas">En que Grado la Formación profesional y social Recibida en Ciencias Básicas (1° y 2° año) le ha servido para su desempeño profesional.</label>
                                                                    <div class="col-sm-6">
                                                                        <select class="form-control" name="GradoCienciasBasicas" id="GradoCienciasBasicas">
                                                                            <option value="">-- Seleccione --</option>
                                                                            <?php
                                                                                 echo $GradoCienciasBasicas;
                                                                             ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label" for="GradoCienciasClinicas">En que Grado la Formación profesional y social Recibida en Ciencias Clinicas (3° y 4° año) le ha servido para su desempeño profesional.</label>
                                                                    <div class="col-sm-6">
                                                                        <select class="form-control" name="GradoCienciasClinicas" id="GradoCienciasClinicas">
                                                                            <option value="">-- Seleccione --</option>
                                                                            <?php
                                                                                 echo $GradoCienciasBasicas;
                                                                             ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                                
                                                                  <div class="form-group">
                                                                    <label class="col-sm-3 control-label" for="fk_aspectodebilidad">En caso de haber contestado nada, poco ó regular, ¿En que aspecto detecta la debilidad?.</label>
                                                                    <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="fk_aspectodebilidad" id="fk_aspectodebilidad" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                 <div id="DIVAspectoDebilidadOtros" style="display: none;">
                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="AspectoDebilidadOtros"><strong>Escriba en que aspecto detecta la debilidad</strong></label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="AspectoDebilidadOtros" id="AspectoDebilidadOtros" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                        </div>
                                                                    </div>                                                                    
                                                                 </div>      
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label">Breve Comentario para mejorar el Perfil de Formación Profesional del Egresado.</label>
                                                                    <div class="col-sm-6">
                                                                        <textarea class="form-control autosize" name="ComentarioMejorarPerfil" id="ComentarioMejorarPerfil" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 112.233px;"></textarea>
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                                  <div class="form-group">
                                                                    <label class="col-sm-3 control-label">Exprese alguna Sugerencia o comentario para mejorar el Plan de Estudios.</label>
                                                                    <div class="col-sm-6">
                                                                        <textarea class="form-control autosize" name="ComentarioMejorarPlanEstudios" id="ComentarioMejorarPlanEstudios" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 112.233px;"></textarea>
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                                
                                                                  <div class="form-group">
                                                                        <label class="col-sm-3 control-label">Grado de Satisfacción (del 1 al 10) que te deja la formación recibida por la Escuela.</label>
                                                                        <div class="col-sm-6">
                                                                            <select style="width:100%" class="populate" name="fk_gradosatisfaccion" id="fk_gradosatisfaccion">
                                                                                 <option value="">-- Seleccione --</option>
                                                                                 <?php
                                                                                    echo $fk_gradosatisfaccion;
                                                                                 ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                
                                                                    
                                                                 <div class="form-group">
                                                                    <label class="col-sm-3 control-label" for="ElegirMismaInstitucion">Si Tuvieras que Cursar nuevamente tus estudios, eligirias la misma Institución.</label>
                                                                    <div class="col-sm-6">
                                                                        <select class="form-control" name="ElegirMismaInstitucion" id="ElegirMismaInstitucion">
                                                                            <option value="">-- Seleccione --</option>
                                                                            <option value="1">Si</option>
                                                                            <option value="2">No</option>
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

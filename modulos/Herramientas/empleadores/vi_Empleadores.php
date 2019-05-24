<div id="page-content">
    <div id='wrap'>
        <div id="page-heading">
            <ol class="breadcrumb">
                <li><a href="<?php echo Config::PAG_ADMIN . "?content=home2"; ?>">Inicio</a></li>
                <li class="active">Empleadores</li>
            </ol>

            <h1>Empleadores</h1>
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
                    <h4><i class="icon-cloud"></i> Alta Empleadores</h4>
                    <div class="options">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#home1" data-toggle="tab"> Alta Empleadores</a>
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
                            <form action="#" class="form-horizontal" id="f_datosempleadores" name="f_datosempleadores"/>   
                                <input type="hidden" id="v_empleador" name="v_empleador" value="0">
                                <fieldset>

                                                    
                                                    
                                                    
                                        <div class="row">
                                                <div class="col-md-12">
                                                        <div class="panel panel-midnightblue">
                                                          <div class="panel-heading">
                                                                        <h4>Datos Generales</h4>
                                                                        <div class="options"></div>
                                                          </div>
                                                          <div class="panel-body">

                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="matricula">Fecha de Solicitud</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :required :apostrofe"  name="v_fechaSolicitud" id="v_fechaSolicitud" title="ESTE CAMPO ES REQUERIDO" />
                                                                        </div>
                                                                    </div>  

                                                                      <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="nombre">Empresa</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :required :apostrofe"  name="v_empresa" id="v_empresa" title="ESTE CAMPO ES REQUERIDO" />
                                                                        </div>
                                                                    </div>

                                                                       <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="apaterno">Nombre del Solicitante</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :required :apostrofe"  name="v_nomSolicitante" id="v_nomSolicitante" title="ESTE CAMPO ES REQUERIDO" />
                                                                        </div>
                                                                    </div>

                                                                       <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="amaterno">Puesto del Solicitante</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :required :apostrofe"  name="v_puestoSolicitante" id="v_puestoSolicitante" title="ESTE CAMPO ES REQUERIDO" />
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="direccion">Licenciatura</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :required :apostrofe"  name="v_licenciatura" id="v_licenciatura"/>
                                                                        </div>
                                                                    </div>



                                                                      <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="codigopostal">Puesto Vacante</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :required :apostrofe"  name="v_puestoVacante" id="v_puestoVacante"/>
                                                                        </div>
                                                                    </div>


                       
                                                                    <div class="form-group">
                                                                          <label class="col-sm-3 control-label">Numero de Vacantes</label>
                                                                          <div class="col-sm-6">
                                                                              <input type="text" class="form-control :required :apostrofe"  name="v_numVacantes" id="v_numVacantes" />
                                                                          </div>
                                                                      </div>

                                                                     <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="v_telefono">Telefono</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :required :apostrofe "  name="v_telefono" id="v_telefono"/>
                                                                        </div>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="v_email">Email</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :required :apostrofe :email"  name="v_email" id="v_email" />
                                                                        </div>
                                                                    </div>

                                                                      <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="v_direccion">Dirección</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :required :apostrofe"  name="v_direccion" id="v_direccion" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="v_sexo">Sexo</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :required :apostrofe"  name="v_sexo" id="v_sexo" />
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
                                        
                                        
                                       
                                        <br>
                                        <!--<div id="Lista"></div>-->  

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





<div id="page-content">
    <div id='wrap'>
        <div id="page-heading">
            <ol class="breadcrumb">
                <li><a href="<?php echo Config::PAG_ADMIN . "?content=home2"; ?>">Inicio</a></li>
                <li class="active">Extras</li>
                <li class="active">Generar titulos</li>
            </ol>

            <h1>Generar titulos</h1>
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
                    <h4><i class="icon-cloud"></i> Extras: Titulos</h4>
                    <div class="options">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#home1" data-toggle="tab"> Extras: Titulos</a>
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
                                                <form action="#" class="form-horizontal" id="frm_cargarFull_titulos" name="frm_cargarFull_titulos"/>   
                                                <fieldset>

                                                   

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="panel panel-midnightblue">
                                                                <div class="panel-heading">
                                                                    <h4>Consultar...</h4>
                                                                    <div class="options">
                                                                        <ul class="nav nav-tabs">
                                                                            <li class="active"><a href="#" data-toggle="tab">Generar</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="panel-body">
                                                                    <div class="tab-content">
                                                                        <div class="tab-pane active" id="">
                                                                            
                                                                            <div class="form-group">
                                                                                <label class="col-md-3 control-label">Literal (All this Year, to modify on view)</label>
                                                                                <div class="col-sm-6">
                                                                                    <input type="text" class="form-control :apostrofe"  name="folio" id="folio" value="D-" readonly/>
                                                                                </div>
                                                                            </div>  
                                                                            
                                                                            
                                                                            
                                                                             <div class="form-group">
                                                                                <label class="col-md-3 control-label" >Tomo Libro registro (All this Year, to modify on view)</label>
                                                                                <div class="col-sm-6">
                                                                                    <input type="text" class="form-control :apostrofe"  name="libro" id="libro" value="4/2019" readonly/>
                                                                                </div>
                                                                            </div> 

                                                                            
                                                                            
                                                                             <div class="form-group">
                                                                                <label class="col-md-3 control-label">Fecha Frente</label>
                                                                                <div class="col-sm-6">
                                                                                    <input type="text" class="form-control :apostrofe"  name="fecha_frente" id="fecha_frente" required/>
                                                                                </div>
                                                                            </div> 
                                                                            
                                                                            
                                                                            <div class="form-group">
                                                                                <label class="col-md-3 control-label">Fecha atrás</label>
                                                                                <div class="col-sm-6">
                                                                                    <input type="text" class="form-control :apostrofe"  name="fecha_atras" id="fecha_atras" required/>
                                                                                </div>
                                                                            </div>   
                                                                            
                                                                            <div class="form-group">
                                                                                <label class="col-md-3 control-label">Matricula</label>
                                                                                <div class="col-sm-6">
                                                                                    <input type="text" class="form-control :apostrofe"  name="matricula" id="matricula" autofocus required/>
                                                                                </div>
                                                                            </div> 
                                                                            
                                                                             <div class="form-group">
                                                                                <label class="col-md-3 control-label">No. Foja acta</label>
                                                                                <div class="col-sm-6">
                                                                                    <input type="text" class="form-control :apostrofe"  name="foja" id="foja" required/>
                                                                                </div>
                                                                            </div> 
                                                                            
                                                                        </div>
                                                                      
                                                                    </div>                                                                    
                                                                    
                                                                    <div class="form-group">
                                                                        <div id="botonera" class="btn-toolbar">
                                                                            <center>   
                                                                                <button class="btn btn-primary start" type="button" id="frmTitu">
                                                                                    <i class="fa fa-save"></i>
                                                                                    <span>agregar</span>
                                                                                </button>
                                                                               <button class="btn btn-default start" type="button" id="cancelarTitulos">
                                                                                    <i class="fa fa-save"></i>
                                                                                    <span>cancelar</span>
                                                                                </button>                 
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
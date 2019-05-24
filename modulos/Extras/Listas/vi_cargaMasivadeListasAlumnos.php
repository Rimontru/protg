<div id="page-content">
    <div id='wrap'>
        <div id="page-heading">
            <ol class="breadcrumb">
                <li><a href="<?php echo Config::PAG_ADMIN . "?content=home2"; ?>">Inicio</a></li>
                <li class="active">Extras</li>
                <li class="active">Subir listas</li>
            </ol>
    
            <h1>Subir listas alumnos</h1>
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
                    <h4><i class="icon-cloud"></i> Extras: Subir listas</h4>
                    <div class="options">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#home1" data-toggle="tab"> Extras: Subir listas</a>
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
                                                <fieldset>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="panel panel-midnightblue">
                                                                <div class="panel-heading">
                                                                    <h4>Uploading list...</h4>
                                                                    <div class="options">
                                                                        <ul class="nav nav-tabs">
                                                                            <li class="active"><a href="#" data-toggle="tab">Cloud</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="panel-body">
                                                                    <div class="tab-content">
                                                                    	<div class="form-group">
                                                                        <div id="botonera" class="btn-toolbar">
                                                                            <center>   
 <form enctype='multipart/form-data' action='<?php echo Config::PAG_ADMIN . "?content=uploadFileServer"; ?>' method='POST'>
    <input name='uploadedfile' type='file' /> </p>
    <input type='submit' value='Read File'  class="btn btn-primary start"/>
    <input type='button' value='Cancelar'  class="btn btn-default start" onclick="javascipt: window.location.reload();"/>
 </form> 
                                                                                        
                                                                          </center>
                                                                        </div>
                                                                        </div>
                                                                        
                                                                        <div class="tab-pane active" id="">
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    
                                                                    <div id="loading-data"></div>

                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                       
                                                </fieldset>  
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
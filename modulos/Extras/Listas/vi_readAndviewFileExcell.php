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

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="panel panel-midnightblue">
                                                                <div class="panel-heading">
                                                                    <h4>Show content file...</h4>
                                                                    <div class="options">
                                                                        <ul class="nav nav-tabs">
                                                                            <li class="active"><a href="#" data-toggle="tab">Cloud</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="panel-body">
                                                                    <div class="tab-content">
                                                                        <div class="tab-pane active" id="">
																			<?php
                                                                            	echo $html1.$html4.$html5;
                                                                            ?>
                                                                        </div>
                                                                         <br>
                                                                        <div class="form-group">
                                                                            <div id="botonera" class="btn-toolbar">
                                                                                <center>   
<button class="btn btn-primary start" type="button" onclick="uploadDatasListsAlumnos('<?php echo $stringArrayDatas?>')" id="enviarLista">
    <i class="fa fa-save"></i>
    <span>GUARDAR</span>
</button>

<button class="btn btn-default start" type="button" onclick="javascipt: location.href='Sistema.php?content=Upload_Alumnos'">
    <i class="fa fa-save"></i>
    <span>DESCARTAR</span>
</button>
                                                                              </center>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    
                                                                    <div id="loading-data"></div>

                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                       
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
<style>
th {     font-size: 13px;     font-weight: normal;     padding: 8px;     background: #b9c9fe;
    border-top: 4px solid #aabcfe;    border-bottom: 1px solid #fff; color: #039; }

td {    padding: 8px;     background: #e8edff;     border-bottom: 1px solid #fff;
    color: #669;    border-top: 1px solid transparent; }
tr:hover td { background: #d0dafd; color: #339; cursor:cell;}

</style>
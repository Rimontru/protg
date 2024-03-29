<?php
#AGREGADO: Ivan Mauricio Melo Granados
#FECHA: 12/06/2014 
$fk_nivelestudio = "";
$result = $ConsultaDB->ConsultaNiveldeEstudios();
while ($row = mysql_fetch_assoc($result)) {
    $fk_nivelestudio .= "<option value='$row[pk_nivelestudio]'>$row[descripcion]</option>";
}
mysql_free_result($result);

$Modalidad = "";
$result = $ConsultaDB->obtenerModalidad();
while ($row = mysql_fetch_assoc($result)) {
    $Modalidad .= "<option value='$row[pk_modalidad]'>$row[nombreMod]</option>";
}
mysql_free_result($result);

$NivelEstudio = "";
$result = $ConsultaDB->obtenerNivelestudio();
while ($row = mysql_fetch_assoc($result)) {
    $NivelEstudio .= "<option value='$row[pk_nivelestudio]'>$row[descripcion]</option>";
}
mysql_free_result($result);

?>
<div id="page-content">
    <div id='wrap'>
        <div id="page-heading">
            <ol class="breadcrumb">
                <li><a href="<?php echo Config::PAG_ADMIN . "?content=home2"; ?>">Inicio</a></li>
                <li><a href="#">Servicios Escolares</a></li>
                <li class="active">Reportes Exámen Institucional </li>
            </ol>

            <h1>Reportes Exámen Institucional</h1>
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
                    <h4><i class="icon-cloud"></i> Reportes Exámen Institucional</h4>
                    <div class="options">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#home1" data-toggle="tab"> Reportes Exámen Institucional</a>
                            </li>


                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="home1">




                            <div class="col-md-12">

                                <!--start row 1-->		
                                <div class="row">
                                    

                                    <!--Inicia boxReporte sinodales porcarrera-->
                                    <div class="col-md-12">
                                        <div class="panel panel-midnightblue">
                                            <div class="panel-heading">
                                                <h4>Reportes Exámen Institucional  </h4>
                                                <div class="options">

                                                </div>
                                            </div>
                                              <form action="" class="form-horizontal" name="f_RegistroAsistencia" id="f_RegistroAsistencia" />
                                               <div class="panel-body collapse in"> 
                                                       <div class="form-group">
                                                            <label class="col-sm-3 control-label" for="fk_nivelestudio">Nivel de Estudios:</label>
                                                            <div class="col-sm-6">
                                                                <select class="form-control :required" name="fk_nivelestudio" id="fk_nivelestudio">
                                                                    <option value="">-- Seleccione --</option>
                                                                    <?php
                                                                    echo $NivelEstudio;
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div> 

                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label" for="fk_modalidad">Modalidad:</label>
                                                            <div class="col-sm-6">
                                                                <select class="form-control :required" name="fk_modalidad" id="fk_modalidad">
                                                                    <option value="">-- Seleccione --</option>
                                                                    <?php
                                                                    echo $Modalidad;
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div> 

                                                         <div class="form-group">
                                                            <label class="col-sm-3 control-label" for="fk_carreras">Carrera:</label>
                                                            <div class="col-sm-6">
                                                                <select class="form-control :required" name="fk_carreras" id="fk_carreras">
                                                                    <option value="">-- Seleccione --</option>
                                                                   
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                                <label class="col-sm-3 control-label">Rango de Fechas</label>
                                                                <div class="col-sm-6">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                                        <input type="text" class="form-control :required" id="rangoFechas" name="rangoFechas"/>
                                                                    </div>
                                                                </div>
                                                            </div>     
                                                        <!--Boton sinodal--> 
                                                        <center>
                                                         <button name="GuardarFolios" id="ReporteVerLista" class="btn btn-primary start" type="submit">
                                                            <i class="fa fa-save"></i>
                                                            <span>Ver Lista</span>
                                                        </button>  
                                                            
                                                        <button name="GuardarFolios" id="ReporteVerRecortables" class="btn btn-primary start" type="submit">
                                                            <i class="fa fa-save"></i>
                                                            <span>Ver Recortables</span>
                                                        </button>  
                                                            
                                                        <button name="GuardarFolios" id="ReporteVerConstancia" class="btn btn-primary start" type="submit">
                                                            <i class="fa fa-save"></i>
                                                            <span>Constancia</span>
                                                        </button>  
                                                            
                                                                
                                                        <button name="GuardarFolios" id="ReporteReporteCantidad" class="btn btn-primary start" type="submit">
                                                            <i class="fa fa-save"></i>
                                                            <span>Reporte Cantidad</span>
                                                        </button>  
                                                       
                                                                
                                                        <button name="GuardarFolios" id="ReporteServiciosEscolaresPDF" class="btn btn-primary start" type="submit">
                                                            <i class="fa fa-save"></i>
                                                            <span>Reporte Servicios Escolares</span>
                                                        </button>  
                                                            <br>  <br> 
                                                        <button name="ReporteResultadosExamenPDF" id="ReporteResultadosExamenPDF" class="btn btn-primary start" type="submit">
                                                            <i class="fa fa-save"></i>
                                                            <span>PDF Resultados Exámen</span>
                                                        </button> 
                                                            
                                                        <button name="ReporteResultadosExamenWORD" id="ReporteResultadosExamenWORD" class="btn btn-primary start" type="submit">
                                                            <i class="fa fa-save"></i>
                                                            <span>WORD Resultados Exámen</span>
                                                        </button> 
                                                            
                                                        <button name="PublicarResultadosExamen" id="PublicarResultadosExamen" class="btn btn-primary start" type="submit">
                                                            <i class="fa fa-save"></i>
                                                            <span>PDF Publicar Resultados Exámen</span>
                                                        </button>
                                                        <br>  <br> 

                                                        <button name="EstadisticasResultadosExamen" id="EstadisticasResultadosExamen" class="btn btn-info start" type="submit">
                                                            <i class="fa fa-save"></i>
                                                            <span>PDF Estadisticas Resultados Exámen</span>
                                                        </button>  
                                                        </center>
                                                        <!--End Boton Sinodal-->    
                                                </fieldset>  
                                                            
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div><!--End Row 1-->



                        <br>
                        
                        
                        
                        
                        
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

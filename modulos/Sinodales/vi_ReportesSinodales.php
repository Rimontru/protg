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

//sinodales
$Sinodales = "";
$result = $ConsultaDB->ConsultaTodosSinodales();
while ($row = mysql_fetch_assoc($result)) {
    $Sinodales .= "<option value='$row[pk_sinodal]'>$row[nombre]</option>";
}
mysql_free_result($result);
?>

<div id="page-content">
    <div id='wrap'>
        <div id="page-heading">
            <ol class="breadcrumb">
                <li><a href="<?php echo Config::PAG_ADMIN . "?content=home2"; ?>">Inicio</a></li>
                <li class="active">Sinodales</li>
            </ol>

            <h1>Reportes de Sinodales</h1>
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
                    <h4><i class="icon-cloud"></i> Reportes de Sinodales</h4>
                    <div class="options">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#home1" data-toggle="tab"> Reportes de Sinodales</a>
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
                                    
                                 <!--Inicia cuadro de reportes de todos los sinodales-->   
                                    <div class="col-md-12">
                                        <div class="panel panel-green">
                                            <div class="panel-heading">
                                                <h4 style="font-weight: bold">Reporte de Todos los Sinodales</h4>
                                                <div class="options">

                                                </div>
                                            </div>
                                            <div class="panel-body collapse in">
                                                Reporte de Sinodales: 
                                                <br /><br/><br/><br/>
                                                <!--Boton sinodal--> 
                                                <div class="form-group"><br/><br/><br/><br />
                                                    <div id="botonera" class="btn-toolbar">
                                                        <center>   
                                                                <a class="btn btn-midnightblue" href='Sistema.php?content=ReporteSinodalesTodos'>Generar Reporte</a>
                                                        </center>
                                                    </div>      
                                                    <div id="loading-data"></div>                                                  
                                                </div>                             
                                                <!--End Boton Sinodal-->                    
                                            </div>
                                        </div>
                                    </div><!--End Cuadro de reporte de sinodales todos-->

                                    <!--Inicia cuadro Reporte sinodales por carrera-->
                                    <div class="col-md-12">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <h4 style="font-weight: bold">Reporte Sinodales por Carrera </h4>
                                                <div class="options">

                                                </div>
                                            </div>

                                            <form action="#" class="form-horizontal" name="f_ReporteSinodalesCarrera" id="f_ReporteSinodalesCarrera">
                                                <fieldset>
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
                                                                <select class="populate :required" name="fk_carreras" id="fk_carreras" style="width:100%;">
                                                                    <option value="">-- Seleccione --</option>
                                                                   
                                                                </select>
                                                            </div>
                                                        </div>

                                                             
                                                        <!--Boton sinodal--> 
                                                        <div class="form-group"><!---->
                                                          <center>
                                                            <a class="btn btn-midnightblue" id="imprimirReporteSinodalesCarrera" title='Descargar'><span>Generar Reporte</span></a>
                                                          </center>
                                                        </div>                                
                                                        <!--End Boton Sinodal-->
                                                    </div>
                                                </fieldset>  
                                            </form>                                  
                                        </div>
                                    </div><!--End Cuadro de reporte de sinodales por carrera-->
                                </div><!--End Row 1-->



                            <!--start row 2-->		
                                <div class="row">
                                    
                                    <!--Inicia cuadro para generar reporte de pago de sinodales-->
                                    <div class="col-md-12">
                                        <div class="panel panel-orange">
                                            <div class="panel-heading">
                                                <h4 style="font-weight: bold">Generar Formato de Pago Sinodales </h4>
                                                <div class="options">

                                                </div>
                                            </div>
                                            
                                            <form action="#" class="form-horizontal" name="f_ReporteSinodalesPago" id="f_ReporteSinodalesPago" onsubmit="return validacion()">
                                                <fieldset>
                                           
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
                                                                <select class="populate :required" name="fk_carreras" id="fk_carreras" style="width:100%;">
                                                                    <option value="">-- Seleccione --</option>
                                                                   
                                                                </select>
                                                            </div>
                                                        </div>
                                                
                                                             <div class="form-group">
                                                                 <fieldset>
                                                                   <label class="col-sm-3 control-label">Desde:</label>
                                                                              <div class="col-sm-6">
                                                                                  <input type="text" class="form-control :required :apostrofe"  name="fechaUnoPago" id="fechaUnoPago"/>
                                                                              </div><br/><br/><br/>
                                                                   <label class="col-sm-3 control-label">Hasta:</label>
                                                                              <div class="col-sm-6">
                                                                                  <input type="text" class="form-control :required :apostrofe"  name="fechaDosPago" id="fechaDosPago"/>
                                                                              </div>           
                                                                              
                                                             </div><br/><br/><br/>
                                               
                                                        <!--Boton sinodal--> 
                                                        <div class="form-group">
                                                          <center>
                                                            <a class="btn btn-midnightblue" id="imprimirReporteSinodalesPago" title='Descargar'><span>Generar Reporte (Por Carrera)</span></a>
                                                            <a class="btn btn-midnightblue" id="imprimirReporteSinodalesPagoTodos" title='Descargar'><span>Generar Reporte (Todos)</span></a>
                                                            <a class="btn btn-midnightblue" id="imprimirReporteSinodalesPagoTodosXLS" title='Descargar'><span>Generar Reporte Todos(Excel)</span></a>                                                                    
                                                          </center>
                                                        </div>                                
                                                        <!--End Boton Sinodal-->
                                            </div>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div><!--End cuadro para generar reporte de pago de sinodales-->

                                        
                                        
                                    <!--INICIA CAJA PARA REPORTE DE OFICIO DE SINODALES INDIVIDUAL-->
                                    <div style="display:none" class="col-md-12">
                                        <div class="panel panel-danger">
                                            <div class="panel-heading">
                                                <h4 style="font-weight: bold">Generar oficio sinodales Individualmente  </h4>
                                                <div class="options">

                                                </div>
                                            </div>

                                            <form action="#" class="form-horizontal" name="f_ReporteSinodalesIndividual" id="f_ReporteSinodalesIndividual">
                                                <fieldset>

                                                    <div class="panel-body collapse in"> 
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label" for="">Nivel de Estudios:</label>
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
                                                            <label class="col-sm-3 control-label" for="">Modalidad:</label>
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
                                                            <label class="col-sm-3 control-label" for="">Carrera:</label>
                                                            <div class="col-sm-6">
                                                                <select class="populate :required" name="fk_carreras" id="fk_carreras" style="width:100%;">
                                                                    <option value="">-- Seleccione --</option>
                                                                   
                                                                </select>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label" for="">Sinodal:</label>
                                                            <div class="col-sm-6">
                                                                <select class="populate :required" name="fk_sinodal" id="fk_sinodal" style="width:100%;">
                                                                    <option value="">-- Seleccione --</option>
                                                                   
                                                                </select>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                                   <label class="col-sm-3 control-label">Desde:</label>
                                                                              <div class="col-sm-6">
                                                                                  <input type="text" class="form-control :required :apostrofe"  name="FechaUnoIndividual" id="FechaUnoIndividual"/>
                                                                              </div><br/><br/><br/>
                                                                   <label class="col-sm-3 control-label">Hasta:</label>
                                                                              <div class="col-sm-6">
                                                                                  <input type="text" class="form-control :required :apostrofe"  name="FechaDosIndividual" id="FechaDosIndividual"/>
                                                                              </div>           

                                                        </div>
                                                             
                                                        <!--Boton sinodal--> 
                                                        <div class="form-group">
                                                          <center>
                                                            <a class="btn btn-midnightblue" id="imprimirReporteSinodalesIndividual" title='Descargar'><span>Generar Reporte</span></a>                                                                    

                                                          </center>
                                                        </div>                                
                                                        <!--End Boton Sinodal-->
                                                    </div>
                                                </fieldset>
                                            </form>
                                           </div><!--panel panel-midnightblue-->
                                        </div><!--End REPORTE DE OFICIO DE SINODALES INDIVIDUALES-->
                                </div><!--End Row 2-->
                            



                                


                                  <!-- ###########################################         
                                  start row 2
                                  #######################################################-->        
                                <div class="row">
                                    
                                    <!--Inicia cuadro para generar reporte de pago de sinodales-->
                                    <div class="col-md-12">
                                        <div class="panel panel-success">
                                            <div class="panel-heading">
                                                <h4 style="font-weight: bold">Generar Invitación de Sinodal  </h4>
                                                <div class="options">

                                                </div>
                                            </div>
                                            
                                            <form action="#" class="form-horizontal" name="f_ReporteInvitacion" id="f_ReporteInvitacion" onsubmit="return validacion()">
                                            <fieldset>
                                           
                                                <div class="panel-body collapse in"> 
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Nivel de Estudios:</label>
                                                        <div class="col-sm-6">
                                                            <div class="radio">
                                                                <label>
                                                                    <input name="nivel" id="nivel" value="2" checked="" type="radio">
                                                                    Reporte de invitación para Licenciatura.
                                                                </label>
                                                            </div>
                                                            <div class="radio">
                                                                <label class="control-label">
                                                                    <input name="nivel" id="nivel" value="0" type="radio">
                                                                    Reporte de invitación para Maestria y Doctorado.
                                                                </label>
                                                            </div>
                                                        </div>  
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Cargo de Sinodal:</label>
                                                        <div class="col-sm-6">
                                                            <select name="cmb_cargosinodal" id="cmb_cargosinodal" style="width:100%" class="populate :required">
                                                                <option value=""> -- Seleccionar -- </option>
                                                                <option value="presidente"> Presidente </option>
                                                                <option value="secretario"> Secretario </option>
                                                                <option value="vocal"> Vocal </option>
                                                                <option value="suplente"> Suplente </option>
                                                            </select>
                                                        </div>  
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Sinodal</label>
                                                        <div class="col-sm-6">
                                                            <select name="cmb_sinodal" id="cmb_sinodal" style="width:100%" class="populate :required">
                                                                 <option value="">-- Seleccione --</option>
                                                                <?php
                                                                echo $Sinodales;
                                                                ?>
                                                            </select>                   
                                                        </div>
                                                    </div>
                                                
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Fecha Toma de Protesta:</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control :required :apostrofe"  name="txt_fechaToma" id="txt_fechaToma"/>
                                                        </div>   
                                                    </div>

                                       
                                                    <!--Boton sinodal--> 
                                                    <div class="form-group">
                                                        <center>
                                                            <button type="button" class="btn btn-midnightblue" title='Reporte de Invitación para el sinodal' onclick="invitacionSinodal()">
                                                                <span>Generar Invitacion (Por Sinodal)</span>
                                                            </button>
                                                        </center>
                                                    </div>                                
                                                    <!--End Boton Sinodal-->
                                                </div>
                                            </fieldset>
                                            </form>
                                        </div>
                                    </div><!--End cuadro para generar reporte de pago de sinodales-->

                                </div><!--End Row 2-->

                            </div><!--End col-12-->
                        </div>
                    </div>
                <!--<div id="Lista"></div>-->  
                
                </div><!--End panel-body-->
            </div><!--End Panel-->
        </div><!--End Container-->
    </div><!--End Wrap-->
</div><!--page-content-->
                        











<link rel='stylesheet' type='text/css' href='assets/plugins/codeprettifier/prettify.css' /> 
<link rel='stylesheet' type='text/css' href='assets/plugins/form-toggle/toggles.css' /> 

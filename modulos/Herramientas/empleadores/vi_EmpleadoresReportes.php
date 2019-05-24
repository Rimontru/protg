<?php
#AGREGADO: MONKY
#FECHA: 07/03/2017
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
                <li><a href="#">Empleadores</a></li>
                <li class="active">Reportes: Empleadores</li>
            </ol>

            <h1>Reportes: Empleadores</h1>
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
                    <h4><i class="icon-cloud"></i> Reportes: Empleadores</h4>
                    <div class="options">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#home1" data-toggle="tab"> Reportes: Empleadores</a>
                            </li>	
                        </ul>
                    </div>
                </div>
              </div> 
               
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-midnightblue">
                        <div class="panel-heading">
                        	<h4>Reporte Empleadores</h4>
                        	<div class="options"></div>
                        </div>
                        <div class="panel-body"> 
                        	<center>
                        	<button name="CantidadAlumnosTitulados" id="CantidadAlumnosTitulados" class="btn btn-primary start">
                            <i class="fa fa-save"></i>
                            <span>Reporte por Opcion de Titulacion</span>
                            </button>
                        	</center>
                        </div>
                    </div>
                </div>
            </div>
            
             <!--************************************************************************MONKY********************************************************-->
 <!--start row 1-->		
                                <div class="row">
                                    

                                    <!--Inicia boxReporte sinodales porcarrera-->
                                    <div class="col-md-12">
                                        <div class="panel panel-midnightblue">
                                            <div class="panel-heading">
                                                <h4>Egresados: Trabajadores  </h4>
                                                <div class="options">

                                                </div>
                                            </div>
                                              <form action="#" class="form-horizontal" name="f_ReporteEgresadosTrabajadoresActivos" id="f_ReporteEgresadosTrabajadoresActivos" />
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
                                                            <label class="col-sm-3 control-label" for="fk_modalidad">Carreras:</label>
                                                            <div class="col-sm-6">
                                                                <select class="form-control :required" name="fk_carreras" id="fk_carreras">
                                                                    <option value="">-- Seleccione --</option>
                                                                   
                                                                </select>
                                                            </div>
                                                        </div> 
<center> 
                                          
 <button name="ReporteEmpresasEmpleadorasEgresados" id="ReporteEmpresasEmpleadorasEgresados" class="btn btn-primary" type="button">
                                                            <i class="fa fa-save"></i>
                                                            <span>Reporte Empleadoras </span>
                                                        </button>
    
                                                            
</center>                                                      
                                                        <!--End Boton Sinodal-->    
                                                </fieldset>  
                                                            
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div><!--End Row 1-->

<!--************************************************************************MONKY********************************************************-->
                                 
		</div> <!-- container -->
	</div> <!--wrap -->
</div> <!-- page-content -->
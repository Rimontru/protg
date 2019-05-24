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


$Generacion = "";
$result = $ConsultaDB->ConsultaGeneraciones();
while ($row = mysql_fetch_assoc($result)) {
    $Generacion .= "<option value='$row[pk_generacion]'>$row[GeneracionDescripcion]</option>";
}
mysql_free_result($result);


?>
<div id="page-content">
    <div id='wrap'>
        <div id="page-heading">
            <ol class="breadcrumb">
                <li><a href="<?php echo Config::PAG_ADMIN . "?content=home2"; ?>">Inicio</a></li>
                <li><a href="#">Egresados</a></li>
                <li class="active">Reportes: Egresados</li>
            </ol>

            <h1>Reportes: Egresados</h1>
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
                    <h4><i class="icon-cloud"></i> Reportes: Egresados</h4>
                    <div class="options">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#home1" data-toggle="tab"> Reportes: Egresados</a>
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
                                                <h4>Reportes: Egresados  </h4>
                                                <div class="options">

                                                </div>
                                            </div>
                                              <form action="#" class="form-horizontal" name="f_ReporteEgresadosTitulacion" id="f_ReporteEgresadosTitulacion" />
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



                                                     <div class="form-group">
                                                            <label class="col-sm-3 control-label" for="fk_generacion">Generacion</label>
                                                            <div class="col-sm-6">
                                                                <select class="form-control :required" name="fk_generacion" id="fk_generacion">
                                                                    <option value="">-- Seleccione --</option>
                                                                    <?php
                                                                    echo $Generacion;
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label" for="fk_carreras">Estado de Titulación:</label>
                                                            <div class="col-sm-6">
                                                                <select class="form-control :required" name="fk_estadoTitulacion" id="fk_estadoTitulacion">
                                                                    <option value="">-- Seleccione --</option>
                                                                    <option value="1">Titulado</option>
                                                                    <option value="2">No Titulado</option>
                                                                    <option value="3">Ambos</option>

                                                                </select>
                                                            </div>
                                                        </div>
<center>
<div class="row">
  <div class="col-md-4">
    <ul class="nav">
      <li class="dropdown" id="menu1">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#menu1">
          BOTONES REPORTES ESTADÍSTICOS
          <b class="caret"></b>
        </a>
        <ul class="dropdown-menu col-md-12">
          <li>
            <button name="ReporteTablaGeneraciones" id="ReporteTablaGeneraciones" class="btn btn-primary start" type="submit">
                <i class="fa fa-save"></i>
                <span>Reporte de Generación por Carrera</span>
            </button>
          </li><li class="divider"></li>
          <li>
            <button name="imprimirReporteEgresadosTitulos" id="imprimirReporteEgresadosTitulos" class="btn btn-primary start" type="submit">
              <i class="fa fa-save"></i>
              <span>Reporte por Generación</span>
            </button>
          </li><li class="divider"></li>
          <li>
            <button name="ReporteTodaslasGeneraciones" id="ReporteTodaslasGeneraciones" class="btn btn-primary start" type="submit">
                <i class="fa fa-save"></i>
                <span>Reporte de Egresados</span>
            </button>
          </li><li class="divider"></li>
          <li>
            <button name="ReporteUltimasGeneraciones" id="ReporteUltimasGeneraciones" class="btn btn-primary start" type="submit">
               <i class="fa fa-save"></i>
               <span>Comparacion Generaciones</span>
            </button>
          </li><li class="divider"></li>
          <li>
            <button style="" name="alumnosNoTitulados" id="alumnosNoTitulados" class="btn btn-primary start" type="submit">
                <i class="fa fa-save"></i>
                <span>Egresados No Titulados</span>
            </button>
          </li><li class="divider"></li>
        </ul>
      </li>
    </ul>
  </div>


  <div class="col-md-4">
    <ul class="nav">
      <li class="dropdown" id="menu2">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#menu2">
          BOTONES REPORTES FIMPES
          <b class="caret"></b>
        </a>
        <ul class="dropdown-menu col-md-12">
          <li>
            <button name="ReporteGeneracionEdad" id="ReporteGeneracionEdad" class="btn btn-green start" type="submit">
                <i class="fa fa-save"></i>
                <span>Reporte Generación Edad y por Promedio</span>
            </button>
          </li><li class="divider"></li>
          <li>
            <button name="ReporteEgresadosTituladosPorEdad" id="ReporteEgresadosTituladosPorEdad" class="btn btn-green start" type="submit">
                <i class="fa fa-save"></i>
                <span>Reporte Titulados por Edad</span>
            </button>
          </li><li class="divider"></li>
          <li>
            <button name="ReporteGeneracionEgresadosLaborado" id="ReporteGeneracionEgresadosLaborado" class="btn btn-green start" type="submit">
                <i class="fa fa-save"></i>
                <span>Egresados Laborando	</span>
            </button>
          </li><li class="divider"></li>
          <li>
            <button name="ReporteAlumnosNoLaborando" id="ReporteAlumnosNoLaborando" class="btn btn-green start" type="submit">
                <i class="fa fa-save"></i>
                <span>Egresados No Laborando</span>
            </button>
          </li><li class="divider"></li>
          <li>
            <button name="ReporteContactoNoTitulados" id="ReporteContactoNoTitulados" class="btn btn-green start" type="submit">
                <i class="fa fa-save"></i>
                <span>Contacto Egresados</span>
            </button>
          </li><li class="divider"></li>
          <li>
            <button name="ReporteEgresadosTituladosEdadSex" id="ReporteEgresadosYTituladosEdadSex" class="btn btn-green start" type="submit">
                <i class="fa fa-save"></i>
                <span>Egresados y Titulados por edad</span>
            </button>
          </li>
          <li>
            <button style="display:none" name="ReporteGeneracionPromedio" id="ReporteGeneracionPromedio" class="btn btn-green start" type="submit">
                <i class="fa fa-save"></i>
                <span>Reporte Generación Promedio</span>
            </button>
          </li><li class="divider"></li>
        </ul>
      </li>
    </ul>
  </div>


  <div class="col-md-4">
    <ul class="nav">
      <li class="dropdown" id="menu3">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#menu3">
          BOTONES REPORTES NUEVOS
          <b class="caret"></b>
        </a>
        <ul class="dropdown-menu col-md-12">
          <li>
            <button name="ReporteGeneracionPlanEstudio" id="ReporteGeneracionPlanEstudio" class="btn btn-orange start">
                <span>Reporte Generación Plan Estudio</span>
            </button>
          </li><li class="divider"></li>
          <li>
            <button name="ReporteDesarrolloAcademico" id="ReporteDesarrolloAcademico" class="btn btn-orange start">
                <span>Reporte Desarrollo Acedemico</span>
            </button>
          </li><li class="divider"></li>
          <li>
            <button name="ReporteGraficaTituladosPorAnio" id="ReporteGraficaTituladosPorAnio" class="btn btn-orange start">
                <span>Gráfica Titulados por Año</span>
            </button>
          </li><li class="divider"></li>
        </ul>
      </li>
    </ul>
  </div>

</div> <!-- FIN 1 MOD BOTONES -->
</center>

                                                </fieldset>

                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div><!--End Row 1-->


                                <!--start row 1-->
                                <div class="row">


                                    <!--Inicia boxReporte sinodales porcarrera-->
                                    <div class="col-md-12">
                                        <div class="panel panel-midnightblue">
                                            <div class="panel-heading">
                                                <h4>Reportes: Egresados  </h4>
                                                <div class="options">

                                                </div>
                                            </div>
                                              <form action="#" class="form-horizontal" name="f_ReporteEgresadosTitulacionSegundaParte" id="f_ReporteEgresadosTitulacionSegundaParte" />
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

							<div class="form-group">
                                                            <label class="col-sm-3 control-label" for="fk_generacion">Generacion</label>
                                                            <div class="col-sm-6">
                                                                <select class="form-control :required" name="fk_generacion" id="fk_generacion">
                                                                    <option value="">-- Seleccione --</option>
                                                                    <?php
                                                                    echo $Generacion;
                                                                    ?>
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





<center>

                                                        <button name="ReporteAlumnosTituloExpedido" id="ReporteAlumnosTituloExpedido" class="btn btn-primary start" type="submit">
                                                            <i class="fa fa-save"></i>
                                                            <span>Alumnos con Titulo Expedido </span>
                                                        </button>

                                                        <button name="CantidadAlumnosTitulados" id="CantidadAlumnosTitulados" class="btn btn-primary start">
                                                            <i class="fa fa-save"></i>
                                                            <span>Reporte por Opcion de Titulacion  </span>
                                                        </button>

                                                         <button name="AlumnosTituladosEdad" id="AlumnosTituladosEdad" class="btn btn-primary start">
                                                            <i class="fa fa-save"></i>
                                                            <span>Alumnos con Titulo por Edad  </span>
                                                        </button>





</center>
                                                        <!--End Boton Sinodal-->
                                                </fieldset>

                                        </div>
                                        </form>

                                    </div>
                                </div>
                            </div><!--End Row 1-->

                                  <!--start row 1-->
                                <div class="row">


                                    <!--Inicia boxReporte sinodales porcarrera-->
                                    <div class="col-md-12">
                                        <div class="panel panel-midnightblue">
                                            <div class="panel-heading">
                                                <h4>Reportes: Egresados  </h4>
                                                <div class="options">

                                                </div>
                                            </div>
                                              <form action="#" class="form-horizontal" name="f_ReporteEgresadosTitulacionTerceraParte" id="f_ReporteEgresadosTitulacionTerceraParte" />
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


                                                     <div class="form-group">
                                                            <label class="col-sm-3 control-label" for="fk_generacion">Generacion</label>
                                                            <div class="col-sm-6">
                                                                <select class="form-control :required" name="fk_generacion" id="fk_generacion">
                                                                    <option value="">-- Seleccione --</option>
                                                                    <?php
                                                                    echo $Generacion;
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label" for="fk_carreras">Estado de Titulación:</label>
                                                            <div class="col-sm-6">
                                                               <select class="form-control :required" name="fk_estadoTitulacion" id="fk_estadoTitulacion">
                                                                    <option value="">-- Seleccione --</option>
                                                                    <option value="1">Titulado</option>
                                                                    <option value="2">No Titulado</option>
                                                                    <option value="3">No Aplica</option>
                                                                    <option value="">Ambos</option>


                                                                </select>
                                                            </div>
                                                        </div>



<center>


                                                        <button name="TablaGeneralAlumnosEgresadosTitulados" id="TablaGeneralAlumnosEgresadosTitulados" class="btn btn-primary start">
                                                            <i class="fa fa-save"></i>
                                                            <span>Tabla General de Alumnos Egresados y Titulados  </span>
                                                        </button>

                                                        <button name="reporteEdadTitulacion" id="reporteEdadTitulacion" class="btn btn-primary start">
                                                            <i class="fa fa-save"></i>
                                                            <span>Edad de Titulación   </span>
                                                        </button>

                                                        <button name="btnGrafica" id="btnGrafica" class="btn btn-primary start">
                                                            <i class="fa fa-save"></i>
                                                            <span>Mostrar Gráfica   </span>
                                                        </button>

                                                        <button name="reporteLaboralGeneracion" id="reporteLaboralGeneracion" class="btn btn-primary start">
                                                            <i class="fa fa-save"></i>
                                                            <span>Desarrollo Laboral por Generación   </span>
                                                        </button>


                    <br>
                     <br>
                                        <div class="alert alert-dismissable alert-info">
                                            <strong>Reportes:</strong>
                                            Datos Generales de los Alumnos.
                                            <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                       </div>

                                                           <table class="table">
                                                                <thead>
                                                                <tr>
                                                                <th>Información Personal</th>
                                                                <th>Desarrollo Academico</th>
                                                                <th>Desarrollo Laboral</th>
                                                                <th>Desarrollo Promedio</th>
                                                                <th>Credenciales Egresados</th>
                                                                <th>Entrega Credenciales</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <img src="assets/img/iconos/PDF-Mac.png" class="puntero_cursor" id="btnReporteInformacionPersonalPDF" name="btnReporteInformacionPersonalPDF">
                                                                        <img src="assets/img/iconos/Excel-Mac.png" class="puntero_cursor" id="btnReporteInformacionPersonalXLS" name="btnReporteInformacionPersonaXLS">
                                                                    </td>
                                                                    <td>
                                                                        <img src="assets/img/iconos/PDF-Mac.png" class="puntero_cursor" id="btnReporteAcademicoPDF" name="btnReporteAcademicoPDF">
                                                                        <img src="assets/img/iconos/Excel-Mac.png" class="puntero_cursor" id="btnReporteAcademicoXLS" name="btnReporteAcademicoXLS">
                                                                    </td>
                                                                    <td>
                                                                        <img src="assets/img/iconos/PDF-Mac.png" class="puntero_cursor" id="btnreporteLaboralPDF" name="btnreporteLaboralPDF">
                                                                        <img src="assets/img/iconos/Excel-Mac.png" class="puntero_cursor" id="btnreporteLaboralXLS" name="btnreporteLaboralXLS">
                                                                    </td>
                                                                    <td>
                                                                        <img src="assets/img/iconos/PDF-Mac.png" class="puntero_cursor" id="reportePromedioPDF" name="reportePromedioPDF">
                                                                    </td>
                                                                     <td>
                                                                        <img src="assets/img/iconos/PDF-Mac.png" class="puntero_cursor" id="ReporteCredencialesNoTramitadas" name="ReporteCredencialesNoTramitadas">
                                                                        <img src="assets/img/iconos/Excel-Mac.png" class="puntero_cursor" id="ReporteCredencialesNoTramitadasXLS" name="ReporteCredencialesNoTramitadasXLS">
                                                                    </td>
                                                                     <td>
                                                                        <img src="assets/img/iconos/PDF-Mac.png" class="puntero_cursor" id="ReporteCredencialesEntregadasAnuales" name="ReporteCredencialesEntregadasAnuales">
                                                                        <img src="assets/img/iconos/PDF-Mac.png" class="puntero_cursor" id="ReporteCredencialesEntregadasTodas" name="ReporteCredencialesEntregadasTodas">

                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                           </table>
</center>
                                                        <!--End Boton Reportes Egresados-->
                                                </fieldset>

                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div><!--End Row 1-->
<!------------------------------------------------------BOTONES ESPECIALES------------------------------------------------------->
 <div class="row">
                                     <form action="#" class="form-horizontal" name="botones_especiales" id="form_btn_especials" />

                                 <!--Inicia cuadro de reportes de las encuentas de medicina-->
                                    <div class="col-md-12">
                                        <div class="panel panel-green">
                                            <div class="panel-heading">
                                                <h4>Reportes: Botones Especiales Medicina, Enfermería y Odontología </h4>
                                                <div class="options">

                                                </div>
                                            </div>
                                            <div class="panel-body collapse in">
                                                <!--Boton -->
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
                                                     <div class="form-group">
                                                            <label class="col-sm-3 control-label" for="fk_generacion">No. de Generaciones:</label>
                                                            <div class="col-sm-6">
                                                                <select class="form-control :required" name="fk_generacion" id="fk_generacion">
                                                                    <option value="">-- Seleccione --</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                </br></br>
                                                    <div id="botonera" class="btn-toolbar">
                                                        <center>
                                                          <a class="btn btn-midnightblue" href="#" id="btnEspeciales">
                                                          	Eficiencia de titulacion Medicina
                                                          </a>
                                                        </center>
                                                    </div>
                                                    <div id="loading-data"></div>
                                                </div>
                                                <!--End Boton encuentas medicinas-->
                                            </div>
                                        </div>
                                    </div><!--Final del cuadro de reportes de encuentas medicina-->

                              </form>

<!-----------------------------------------------------FIN BOTONES ESPECIALES-------------------------------------------------------->

<!--***********************************REPORTES DE MEDICINA***************************************************************->

<!--start row 1-->
                                <div class="row">
                                     <form action="#" class="form-horizontal" name="grafica" id="grafica" />

                                 <!--Inicia cuadro de reportes de las encuentas de medicina-->
                                    <div class="col-md-12">
                                        <div class="panel panel-green">
                                            <div class="panel-heading">
                                                <h4>Reportes: Encuesta Medicina</h4>
                                                <div class="options">

                                                </div>
                                            </div>
                                            <div class="panel-body collapse in">
                                                <!--Boton -->
                                                <div class="form-group">
                                                            <label class="col-sm-3 control-label" for="">Seleccionar Opcion a Graficar</label>
                                                                <div class="col-sm-6">
                                                                <select class="form-control :required" name="grafica" id="grafica">
                                                                    <option value="">-- Seleccione --</option>
                                                                    <option value="1">Estudios de posgrado</option>
                                                                    <option value="2">Rama de posgrado</option>
                                                                    <option value="3">Puesto de desempeño</option>
                                                                    <option value="4">Ingreso actual</option>
                                                               <!--####################### MOONO #######################-->
                                                                    <option value="5">Institución en que labora</option>
                                                                    <option value="6">Pertenecen a organizaciones</option>
                                                                    <option value="7">Certificados profesionalmente</option>
                                                                    <option value="8">Capacitados laboralmente</option>
                                                                    <option value="9">Uso de las ciencias básicas</option>
                                                                    <option value="10">Uso de las ciencias clínicas</option>
                                                                    <option value="11">Aspectos donde detectan debilidades</option>
                                                                    <option value="12">Reelección institución</option>
                                                                    <option value="13">Grado de satisfacción</option>
                                                                </select>
                                                            </div>
                                                </div> </br></br>
                                                    <div id="botonera" class="btn-toolbar">
                                                        <center>
                                                        <button name="graf" id="graf" class="btn btn-danger start">
                                                            <i class="fa fa-save"></i>
                                                            <span>Grafica  </span>
                                                        </button>
                                                                <a class="btn btn-midnightblue" href="Sistema.php?content=ReporteMedicina">Datos Personales Alumnos Encuestados</a>
                                                                <a class="btn btn-midnightblue" href="Sistema.php?content=ReporteMedicinaDatosLaborales">Datos Laborales Alumnos Encuestados</a>
                                                                <a class="btn btn-midnightblue" href="Sistema.php?content=ReporteMedicinaOpinion">Opinion sobre el Plan de Estudios</a>
                                                        </center>
                                                    </div>
                                                    <div id="loading-data"></div>
                                                </div>
                                                <!--End Boton encuentas medicinas-->
                                            </div>
                                        </div>
                                    </div><!--Final del cuadro de reportes de encuentas medicina-->

                              </form>


                               <!--***********************************G R A F I C A S       E G R E S A D O S***************************************************************-->

<!-- start row 1 -->
                                <div class="row" style="">

                                 <!--Inicia cuadro de reportes de las encuentas de medicina-->
                                    <div class="col-md-12">
                                        <div class="panel panel-green">
                                            <div class="panel-heading">
                                                <h4>Graficas: Egresados</h4>
                                                <div class="options" style="border-bottom:">

                                                </div>
                                            </div>
                                            <form action="#" class="form-horizontal" name="f_GraficasEgresados" id="f_GraficasEgresados" />
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
                                                            <label class="col-sm-3 control-label" for="">Carreras:</label>
                                                            <div class="col-sm-6">
                                                                <select class="form-control :required" name="fk_carreras" id="fk_carreras">
                                                                    <option value="">-- Seleccione --</option>

                                                                </select>
                                                            </div>
                                                        </div>


                                                     <div class="form-group">
                                                            <label class="col-sm-3 control-label" for="">Generacion</label>
                                                            <div class="col-sm-6">
                                                                <select class="form-control :required" name="fk_generacion" id="fk_generacion">
                                                                    <option value="">-- Seleccione --</option>
                                                                    <?php
                                                                    echo $Generacion;
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                <div class="form-group">
                                                            <label class="col-sm-3 control-label" for="">Seleccionar Opcion a Graficar</label>
                                                                <div class="col-sm-6">
                                                                <select class="form-control :required" name="opcionGrafica" id="opcionGrafica">
                                                                    <option value="">-- Seleccione --</option>
                                                                    <option value="1">Desarrollo Laboral</option>
                                                                    <option value="2">Ingreso Actual</option>
                                                                    <option value="3">Tiempo en emplearse</option>
                                                                    <option value="4">Plan y Programas de Estudio</option>
                                                                    <option value="5">Grado de Satisfacción</option>
                                                                    <option value="6">Aspectos y debilidades</option>
                                                                    <option value="7">Elegir misma institución</option>
                                                                    <option value="8">Estudiar otro nivel profesional</option>
                                                                    <option value="9">Sugerencias</option>
                                                                </select>
                                                            </div>
                                                </div> </br>
                                                <center>
                                                    <div id="botonera" class="btn-toolbar">
                                                        <button name="GraficasEgresadosFimpes" id="GraficasEgresadosFimpes" class="btn btn-success start">
                                                            <i class="fa fa-save"></i>
                                                            <span>Grafica  </span>
                                                        </button>
						        <button style="" name="btnListaAlumnos" id="btnListaAlumnos" class="btn btn-green start" type="submit">
                                                            <i class="fa fa-save"></i>
                                                            <span>Relacion de Alumnos</span>
                                                        </button>

                                                         <button name="GraficasEgresadosFimpesExcell" id="GraficasEgresadosFimpesExcell" class="btn btn-primary start">
                                                            <i class="fa fa-save"></i>
                                                            <span>Grafica Excell</span>
                                                        </button>

                                                         <button name="DatosRespuestasAbiertas" id="DatosRespuestasAbiertas" class="btn btn-primary start">
                                                            <i class="fa fa-save"></i>
                                                            <span>Opiniones</span>
                                                        </button>
                                                    </div>
                                                </center>
                                                </div>
                                                <!--End Boton Graficas Egresados-->
                                            </div>
                                        </div>
                                    </div><!--Fin del cuadro de reportes de Graficas Egresados-->

                              </form>

<!--***********************************G R A F I C A S       E N C U E S T A S    2 0 1 9***************************************************************-->


                                     <div class="row" style="">

                                 <!--Inicia cuadro de reportes de encuestas-->
                                    <div class="col-md-12">
                                        <div class="panel panel-green">
                                            <div class="panel-heading">
                                                <h4>Grafica Encuesta 2 0 1 9 M O D U L O  E N  M A N T E N I M I E N T O</h4>
                                                <div class="options" style="border-bottom:">

                                                </div>
                                            </div>
                                            <form action="#" class="form-horizontal" name="f_GraficasEgresados" id="f_GraficasEgresados" />
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
                                                            <label class="col-sm-3 control-label" for="">Carreras:</label>
                                                            <div class="col-sm-6">
                                                                <select class="form-control :required" name="fk_carreras" id="fk_carreras">
                                                                    <option value="">-- Seleccione --</option>
                                                                    
                                                                </select>
                                                            </div>
                                                        </div>


                                                     <div class="form-group">
                                                            <label class="col-sm-3 control-label" for="">Generacion</label>
                                                            <div class="col-sm-6">
                                                                <select class="form-control :required" name="fk_generacion" id="fk_generacion">
                                                                    <option value="">-- Seleccione --</option>
                                                                    <?php
                                                                    echo $Generacion;
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                <div class="form-group">
                                                            <label class="col-sm-3 control-label" for="">Seleccionar Opcion a Graficar</label>
                                                                <div class="col-sm-6">
                                                                <select class="form-control :required" name="opt_GraficaEncuesta" id="opt_GraficaEncuesta">
                                                                    <option value="">-- Seleccione --</option>
                                                                    <option value="1">Misión, Visión y Valores</option>
                                                                    <option value="2">Actividad Desempeñada</option>
                                                                    <option value="3">Formación Académica</option>
                                                                    <option value="4">Capacitados laboralmente</option>
                                                                    <option value="5">Porcentaje de Satisfacción</option>
                                                                    <option value="6">Comportamiento y Valores</option>
                                                                    <option value="7">Contratación de Egresado</option>
                                                                </select>
                                                            </div>
                                                </div> </br>
                                                <center>
                                                    <div id="botonera" class="btn-toolbar">
                                                        <button name="btn_graficaEncuesta2019" id="btn_graficaEncuesta2019" class="btn btn-success start">
                                                            <i class="fa fa-save"></i>
                                                            <span>Grafica  </span>
                                                        </button>
                                                            <button style="" name="btn_relacionEmpleadores" id="btn_relacionEmpleadores" class="btn btn-green start" type="submit">
                                                            <i class="fa fa-save"></i>
                                                            <span>Relacion de Empleadores</span>
                                                        </button>

                                                         <!-- <button name="GraficasEgresadosFimpesExcell" id="GraficasEgresadosFimpesExcell" class="btn btn-primary start">
                                                            <i class="fa fa-save"></i>
                                                            <span>Grafica Excell</span>
                                                        </button> -->

                                                         <button name="OpnionesEncuesta" id="OpnionesEncuesta" class="btn btn-primary start">
                                                            <i class="fa fa-save"></i>
                                                            <span>Opiniones</span>
                                                        </button>
                                                    </div>
                                                </center>
                                                </div>
                                                <!--End Boton Graficas Egresados-->
                                            </div>
                                        </div>
                                    </div><!--Fin del cuadro de reportes de Graficas Egresados-->

                              </form>






                        <br>

                        <!--<div id="Lista"></div>-->
<!--ANTES DE ESTO PUEDES METER TODOS LOS CONTENEDORES QUE KIERAS-->
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

<?php
#AGREGADO: Ivan Mauricio Melo Granados
#FECHA: 29/05/2014
$fk_Duracion = "";
$result = $ConsultaDB->ConDuracion();
while ($row = mysql_fetch_assoc($result)) {
    $fk_Duracion .= "<option value='$row[Pk_Duracion]'>$row[DescripcionDuracion]</option>";
}
mysql_free_result($result);

$Carreras = "";
$result = $ConsultaDB->ConsultaCarreras();
while ($row = mysql_fetch_assoc($result)) {
    $Carreras .= "<option name='Pk_carreras[]' value='$row[pk_carreras]'>$row[nombreCarrera]</option>";
}
mysql_free_result($result);



$fk_titulacion = "";
$result = $ConsultaDB->ConOpciontitulacion();
while ($row = mysql_fetch_assoc($result)) {
    $fk_titulacion .= "<option value='$row[pk_titulacion]'>$row[Nombre]</option>";
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
<script>
    $(function() {


    });


</script>

<div id="page-content">
    <div id='wrap'>
        <div id="page-heading">
            <ol class="breadcrumb">
                <li><a href="<?php echo Config::PAG_ADMIN . "?content=home2"; ?>">Inicio</a></li>
                 <li><a href="#">Trámites</a></li>
                <li class="active">Toma de Protesta</li>
            </ol>

            <h1>Toma de Protesta</h1>
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

                    <h4><i class="icon-cloud"></i> Toma de Protesta</h4>
                    <div class="options">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#home1" data-toggle="tab"> Toma de Protesta</a>
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
                                                <form action="#" class="form-horizontal" id="frm_busquedaTomaProtesta" name="frm_busquedaTomaProtesta"/>
                                                <fieldset>



                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="panel panel-midnightblue">
                                                                <div class="panel-heading">
                                                                    <br>
                                                                    <h4><b>Busqueda...</b></h4>
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


                         <form action="#" class="form-horizontal" id="frm_AltaTomaProtesta" name="frm_AltaTomaProtesta"/>
                                <fieldset>




                                        <div class="row">
                                                <div class="col-md-12">
                                                        <div class="panel panel-midnightblue">
                                                          <!-- <div class="panel-heading">
                                                                      <h4><b>Datos del Alumno</b></h4>
                                                                      <div class="options"></div>
                                                          </div> -->
                                                          <div class="panel-body">

																<br>
																<h4><b>Del Alumno</b></h4>
																<hr>
                                                                    <input type="hidden" class="form-control :apostrofe" name="pk_alumno" id="pk_alumno" />
                                                                    <input type="hidden" class="form-control :apostrofe" name="pk_tramites" id="pk_tramites" />
                                                                    <input type="hidden" class="form-control :apostrofe" name="matricula" id="matricula"  />


                                                                    <div class="form-group">
                                                                    	<label class="col-md-3 control-label" for="curp">CURP</label>
                                                                        <div class="col-sm-3">
                                                                            <input type="text" class="form-control :required :apostrofe" name="curp" id="curp" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                        </div>

                                                                        <label class="col-md-1 control-label" for="matricula_desc">Matricula</label>
                                                                        <div class="col-sm-2">
                                                                            <input type="text" class="form-control :required :apostrofe" disabled="" name="matricula_desc" id="matricula_desc" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                        </div>


                                                                    </div>

                                                                      <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="nombre">Nombre</label>
                                                                        <div class="col-sm-2">
                                                                            <input type="text" class="form-control :required :apostrofe"  disabled="" name="nombre" id="nombre" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            <input type="text" class="form-control :required :apostrofe"  disabled="" name="apaterno" id="apaterno" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            <input type="text" class="form-control :required :apostrofe" disabled=""  name="amaterno" id="amaterno" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                        </div>
                                                                    </div>

																<br>
																<h4><b>Antecedente Escolar</b></h4>
                                                                <hr>

                                                                <div class="form-group">
                                                                <label class="col-md-3 control-label" for="nivel_escolar">Nivel Escolar Anterior</label>
                                                                <div class="col-sm-6">
                                                                  <select class="form-control :required :apostrofe" name="nivel_escolar" id="nivel_escolar" title="ESTE CAMPO ES REQUERIDO">
                                                                    <option value="0">SELECCIONAR</option>
                                                                    <option value="1">MAESTRIA</option>
                                                                    <option value="2">LICENCIATURA</option>
                                                                    <option value="3">TECNICO</option>
                                                                    <option value="4">BACHILLERATO</option>
                                                                    <option value="5">EQUIVALENTE A BACHILLERATO EDUCACIÓN MEDIA SUPERIOR</option>
                                                                    <option value="6">SECUNDARIA</option>
                                                                  </select>
                                                                </div>
                                                              </div>

                                                              <div class="form-group">
                                                                  <label class="col-md-3 control-label" for="institucionProcedencia">Nombre de la Institución</label>
                                                                  <div class="col-sm-6">
                                                                      <input type="text" class="form-control :required :apostrofe" name="institucionProcedencia" id="institucionProcedencia" title="ESTE CAMPO ES REQUERIDO" maxlength="255" />
                                                                  </div>
                                                              </div>

                                                              <div class="form-group">
                                                                <label class="col-md-2 col-md-offset-1 control-label" for="fechas">Fecha Inició</label>
                                                                <div class="col-md-2">
                                                                    <input type="text" class="form-control :required :apostrofe" name="f_inicio_antecedente" id="f_inicio_antecedente" title="ESTE CAMPO ES REQUERIDO" maxlength="7" placeholder="formato MM/AAAA" />
                                                                </div>
                                                                <label class="col-md-2 control-label" for="fechas">Fecha Teminó</label>
                                                                <div class="col-md-2">
                                                                    <input type="text" class="form-control :required :apostrofe" name="f_fin_antecedente" id="f_fin_antecedente" title="ESTE CAMPO ES REQUERIDO" maxlength="7" placeholder="formato MM/AAAA" />
                                                                </div>
                                                              </div>

                                                              <div class="form-group">
                                                                  <label class="col-md-3 control-label" for="noCedula">Cédula profesional (si tiene)</label>
                                                                  <div class="col-sm-6">
                                                                      <input type="text" class="form-control :apostrofe" name="noCedula" id="noCedula" title="ESTE CAMPO ES REQUERIDO" maxlength="255" />
                                                                  </div>
                                                              </div>

                                                               <div class="form-group">
                                                                <label class="col-md-3 control-label" for="entidad_federativa">Entidad Federativa donde Estudió</label>
                                                                <div class="col-sm-6">
                                                                  <select class="form-control :required :apostrofe" name="entidad_federativa" id="entidad_federativa" title="ESTE CAMPO ES REQUERIDO">
                                                                    <option value="0">SELECCIONAR</option>
                                                                    <option value="1">AGUASCALIENTES</option>
                                                                    <option value="2">BAJA CALIFORNIA</option>
                                                                    <option value="3">BAJA CALIFORNIA SUR</option>
                                                                    <option value="4">CAMPECHE</option>
                                                                    <option value="5">COAHUILA DE ZARAGOZA</option>
                                                                    <option value="6">COLIMA</option>
                                                                    <option value="7">CHIAPAS</option>
                                                                    <option value="8">CHIHUAHUA</option>
                                                                    <option value="9">CIUDAD DE MÉXICO</option>
                                                                    <option value="10">DURANGO</option>
                                                                    <option value="11">GUANAJUATO</option>
                                                                    <option value="12">GUERRERO</option>
                                                                    <option value="13">HIDALGO</option>
                                                                    <option value="14">JALISCO</option>
                                                                    <option value="15">MÉXICO</option>
                                                                    <option value="16">MICHOACÁN DE OCAMPO</option>
                                                                    <option value="17">MORELOS</option>
                                                                    <option value="18">NAYARIT</option>
                                                                    <option value="19">NUEVO LEÓN</option>
                                                                    <option value="20">OAXACA</option>
                                                                    <option value="21">PUEBLA</option>
                                                                    <option value="22">QUERÃ‰TARO</option>
                                                                    <option value="23">QUINTANA ROO</option>
                                                                    <option value="24">SAN LUIS POTOSÍ</option>
                                                                    <option value="25">SINALOA</option>
                                                                    <option value="26">SONORA</option>
                                                                    <option value="27">TABASCO</option>
                                                                    <option value="28">TAMAULIPAS</option>
                                                                    <option value="29">TLAXCALA</option>
                                                                    <option value="30">VERACRUZ DE IGNACIO DE LA LLAVE</option>
                                                                    <option value="31">YUCATÁN</option>
                                                                    <option value="32">ZACATECAS</option>
                                                                  </select>
                                                                </div>
                                                              </div>


                                                            <br>
                                                            <h4><b>Datos Escolares</b></h4>
                                                            <hr>

                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">Carrera</label>
                                                                <div class="col-sm-6">
                                                                    <select name="fk_carreras" id="fk_carreras" style="width:100%" disabled="" class="populate :required">
                                                                         <option value="">-- Seleccione --</option>
                                                                        <?php
                                                                    echo $Carreras;
                                                                    ?>
                                                                    </select>
                                                                </div>
                                                            </div>

															<div class="form-group">
																<label class="col-md-2 col-md-offset-1 control-label" for="fechas">Fecha Inició</label>
																<div class="col-md-2">
																    <input type="text" class="form-control :required :apostrofe" name="f_inicio_car" id="f_inicio_car" title="ESTE CAMPO ES REQUERIDO" maxlength="7" autofocus placeholder="formato requerido MM/AAAA" />
																</div>
																<label class="col-md-2 control-label" for="fechas">Fecha Terminó</label>
																<div class="col-md-2">
																    <input type="text" class="form-control :required :apostrofe" name="f_fin_car" id="f_fin_car" title="ESTE CAMPO ES REQUERIDO" maxlength="7" autofocus placeholder="formato requerido MM/AAAA" />
																</div>
															</div>

															<br>
															<h4><b>Toma de Protesta</b></h4>
                                                            <hr>

                                                            <div class="form-group">
											                  <label class="col-sm-3 control-label">Fecha Toma de Protesta</label>
											                  <div class="col-sm-6">
											                      <input type="text" class="form-control :apostrofe :required"  name="FechaTomaProtesta" id="FechaTomaProtesta" />
											                  </div>
											              </div>

											            <div class="form-group">
											                <label class="col-sm-3 control-label">Hora</label>
											                <div class="col-sm-6">
											                    <input type="text" class="form-control :apostrofe :required" id="hora" name="hora"/>
											                </div>
											            </div>

											             <div class="form-group">
											                  <label class="col-sm-3 control-label">Salon</label>
											                  <div class="col-sm-6">
											                      <input type="text" class="form-control :apostrofe"  name="salon" id="salon" />
											                  </div>
											              </div>



											                   <div class="form-group">
											                        <label class="col-sm-3 control-label" for="fk_titulacion">Opción de Titulación</label>
											                        <div class="col-sm-6">
											                            <select class="form-control :required" name="fk_titulacion" id="fk_titulacion">
											                                <option value="">-- Seleccione --</option>
											                                <?php
											                                echo $fk_titulacion;
											                                ?>
											                            </select>
											                        </div>
											                    </div>


											             <div class="form-group">
											                  <label class="col-sm-3 control-label">Nombre de La Tesis</label>
											                  <div class="col-sm-6">
											                      <input type="text" class="form-control :apostrofe"  name="nombreTesis" id="nombreTesis" />
											                  </div>
											              </div>


											                   <div class="form-group">
											                        <label class="col-sm-3 control-label" for="Fk_Duracion">Duracion</label>
											                        <div class="col-sm-6">
											                            <select class="form-control :required" name="Fk_Duracion" id="Fk_Duracion">
											                                <option value="">-- Seleccione --</option>
											                                <?php
											                                echo $fk_Duracion;
											                                ?>
											                            </select>
											                        </div>
											                    </div>


															<br>
															<h4><b>Sinodales</b></h4>
                                                            <hr>


                                                            <div class="form-group">
												                <label class="col-sm-3 control-label">Presidente</label>
												                <div class="col-sm-6">
												                    <select name="presidente" id="presidente" style="width:100%" class="populate :required">
												                         <option value="">-- Seleccione --</option>
												                        <?php
												                        echo $Sinodales;
												                        ?>
												                    </select>
												                </div>
												            </div>


												               <div class="form-group">
												                <label class="col-sm-3 control-label">Secretario</label>
												                <div class="col-sm-6">
												                    <select name="secretario" id="secretario" style="width:100%" class="populate :required">
												                         <option value="">-- Seleccione --</option>
												                        <?php
												                        echo $Sinodales;
												                        ?>
												                    </select>
												                </div>
												            </div>




												               <div class="form-group">
												                <label class="col-sm-3 control-label">Vocal</label>
												                <div class="col-sm-6">
												                    <select name="vocal" id="vocal" style="width:100%" class="populate :required">
												                         <option value="">-- Seleccione --</option>
												                        <?php
												                        echo $Sinodales;
												                        ?>
												                    </select>
												                </div>
												            </div>


												               <div class="form-group">
												                <label class="col-sm-3 control-label">Suplente</label>
												                <div class="col-sm-6">
												                    <select name="suplente" id="suplente" style="width:100%" class="populate">
												                         <option value="">-- Seleccione --</option>
												                        <?php
												                        echo $Sinodales;
												                        ?>
												                    </select>
												                </div>
												            </div>

												            <hr>


												            <div class="form-group">
												                <label class="col-sm-3 control-label">Observaciones</label>
												                <div class="col-sm-6">
												                    <textarea class="form-control :apostrofe" id="observacion" name="observacion"></textarea>
												                </div>
												            </div>


                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
<!--

                                                 <div class="col-md-12">
                                                   <div class="panel panel-midnightblue">
                                                            <div class="panel-heading">
                                                              <br>
                                                              <h4><b>Datos Antecedentes Excolares</b></h4>
                                                              <div class="options"></div>
                                                            </div>
                                                            <div class="panel-body">



                                                            </div>
                                                          </div>
                                                </div>

<div class="col-md-12">
                                                   <div class="panel panel-midnightblue">
                                                        <div class="panel-heading">
                                                          <br>
                                                          <h4><b>Datos Excolares</b></h4>
                                                          <div class="options"></div>
                                                        </div>
                                                        <div class="panel-body">

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                        <div class="panel panel-midnightblue">
                                                          <div class="panel-heading">
                                                                        <br>
                                                                        <h4><b>Toma de Protesta</b></h4>
                                                                        <div class="options"></div>
                                                            </div>
                                                            <div class="panel-body">





              SINODALES








                                                          </div>


                                                        </div>
                                               </div>


                                       </div>
 -->
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

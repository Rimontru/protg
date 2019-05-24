<?php 
include_once("includes/ConsultaDB.class.php");

$db = new database;   #referenciamos la clase de la base de datos
$db->conectar();
$queryDB = new ConsultaDB();

$result = $queryDB->ConsultaDatosAlumnosParaTablaDeBusqueda();

?>
<div id="page-content">
    <div id='wrap'>
        <div id="page-heading">
            <ol class="breadcrumb">
                <li><a href="<?php echo Config::PAG_ADMIN . "?content=home2"; ?>">Inicio</a></li>
                <li><a>Egresados</a></li>
                <li class="active">Encuesta Empleadores</li>
            </ol>

            <h1>Encuesta Empleadores</h1>
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
                    <h4><i class="icon-cloud"></i> Encuesta Empleadores</h4>
                    <div class="options">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#home1" data-toggle="tab"> Encuesta Empleadores</a>
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
                                                <form class="form-horizontal" id="frm_datos_encuestaEmpleadores" />   
<div class="row">
                                                    <div class="col-md-12">
                                                        <div class="panel panel-midnightblue">
                                                            <div class="panel-heading">
                                                                <h4>Encuesta Empleadores</h4>
                                                                <div class="options"></div>
                                                            </div>
                                                            <div class="panel-body">

                                                              
                                                                <div class="form-group">
                                                                    <label class="col-md-3 control-label">Nombre del Egresado</label>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" 
                                                                        class="form-control :required :apostrofe"  
                                                                        id="nombre" 
                                                                        title="ESTE CAMPO ES REQUERIDO"
                                                                        data-toggle="modal" 
                                                                        data-target="#modalTableAlumnos" 
                                                                        autofocus/>
                                                                        <input type="hidden" name="pk_alumno" id="pk_alumno">  
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="col-md-3 control-label">Carrera de Egreso</label>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" class="form-control :required :apostrofe" id="carrera" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                        <input type="hidden" name="pk_carreras" id="pk_carreras">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="col-md-3 control-label">Empresa o Institución en la que labora</label>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" class="form-control :required :apostrofe"  name="empresaLabora" id="empresaLabora" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                    </div>
                                                                </div>


                                                                <div class="form-group">
                                                                    <label class="col-md-3 control-label">Giro de la Organización en la que labora</label>
                                                                    <div class="col-sm-6"> 
                                                                        <input type="text" class="form-control :required :apostrofe"  name="giroEmpresa" id="giroEmpresa" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                    </div>
                                                                </div>



                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label">Domicilio de la empresa</label>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" class="form-control :apostrofe"  name="direccionEmpresa" id="direccionEmpresa" title="ESTE CAMPO ES REQUERIDO"/>
                                                                    </div>
                                                                </div>



                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label">Puesto que desempeña el egresado</label>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" class="form-control :apostrofe"  name="puestoEjerce" id="puestoEjerce" title="ESTE CAMPO ES REQUERIDO"/>
                                                                    </div>
                                                                </div>





                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label">¿Considera que se cumple con la Misión, Visión y Valores de la Institución?</label>
                                                                    <div class="col-sm-6">
                                                                        <input type="radio" name="mi_vi_va" id="mi_vi_va" value="1" />
                                                                        <label for="si">Si</label><br />
                                                                        <input type="radio" name="mi_vi_va" id="mi_vi_va" value="0"  />
                                                                        <label for="no">No</label><br />
                                                                       
                                                                    </div>
                                                                </div>


                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label">Sugerencias para su actualización:</label>
                                                                    <div class="col-sm-6">                    
                                                                        <textarea class="form-control autosize" name="mi_vi_va_comment" id="mi_vi_va_comment" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 112.233px;">Por que, </textarea>
                                                                    </div>
                                                                </div>



                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label">¿En que grado considera que las actividades que desempeña el egresado están relacionadas con su formación académica?</label>
                                                                    <div class="col-sm-6">
                                                                        <input type="radio" name="formaTrabajaEgresado" id="formaTrabajaEgresado" value="4" />
                                                                        <label for="si">Excelente</label><br />
                                                                        <input type="radio" name="formaTrabajaEgresado" id="formaTrabajaEgresado" value="3"  />
                                                                        <label for="no">Bueno</label><br />
                                                                        <input type="radio" name="formaTrabajaEgresado" id="formaTrabajaEgresado" value="2"  />
                                                                        <label for="no">Regular</label><br />
                                                                        <input type="radio" name="formaTrabajaEgresado" id="formaTrabajaEgresado" value="1"  />
                                                                        <label for="no">Malo</label><br />
                                                                       
                                                                    </div>
                                                                </div>



                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label">¿Cómo considera que la formación académica que se le proporcionó al egresado en la Universidad es la adecuada para realizar las funciones que su empresa o institución requiere?</label>
                                                                    <div class="col-sm-6">
                                                                        <input type="radio" name="realizaFunciones" id="realizaFunciones" value="4" />
                                                                        <label for="si">Excelente</label><br />
                                                                        <input type="radio" name="realizaFunciones" id="realizaFunciones" value="3"  />
                                                                        <label for="no">Bueno</label><br />
                                                                        <input type="radio" name="realizaFunciones" id="realizaFunciones" value="2"  />
                                                                        <label for="no">Regular</label><br />
                                                                        <input type="radio" name="realizaFunciones" id="realizaFunciones" value="1"  />
                                                                        <label for="no">Malo</label><br />
                                                                    </div>
                                                                </div>



                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label">¿Cómo considera el grado de satisfacción del desempeño del egresado con relación a los requerimientos de su organización?</label>
                                                                    <div class="col-sm-6">
                                                                        <input type="radio" name="satisfaceTrabajoEgresado" id="satisfaceTrabajoEgresado" value="4" />
                                                                        <label for="si">Excelente</label><br />
                                                                        <input type="radio" name="satisfaceTrabajoEgresado" id="satisfaceTrabajoEgresado" value="3"  />
                                                                        <label for="no">Bueno</label><br />
                                                                        <input type="radio" name="satisfaceTrabajoEgresado" id="satisfaceTrabajoEgresado" value="2"  />
                                                                        <label for="no">Regular</label><br />
                                                                        <input type="radio" name="satisfaceTrabajoEgresado" id="satisfaceTrabajoEgresado" value="1"  />
                                                                        <label for="no">Malo</label><br />
                                                                    </div>
                                                                </div>



                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label">¿Cómo evalúa el  comportamiento del egresado en cuestión a los siguientes valores: Disciplina, Honestidad, Lealtad, Liderazgo, REspeto, Tolerancia?</label>
                                                                    <div class="col-sm-6">
                                                                        <input type="radio" name="evaluaComportamientoEgresado" id="evaluaComportamientoEgresado" value="4" />
                                                                        <label for="si">Excelente</label><br />
                                                                        <input type="radio" name="evaluaComportamientoEgresado" id="evaluaComportamientoEgresado" value="3"  />
                                                                        <label for="no">Bueno</label><br />
                                                                        <input type="radio" name="evaluaComportamientoEgresado" id="evaluaComportamientoEgresado" value="2"  />
                                                                        <label for="no">Regular</label><br />
                                                                        <input type="radio" name="evaluaComportamientoEgresado" id="evaluaComportamientoEgresado" value="1"  />
                                                                        <label for="no">Malo</label><br />
                                                                    </div>
                                                                </div>


                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label">¿Contrataría usted nuevamente a un egresado de nuestra institución en caso de requerirlo?</label>
                                                                    <div class="col-sm-6">
                                                                        <input type="radio" name="contrataEgresado" id="contrataEgresado" value="1" />
                                                                        <label for="si">Si</label><br />
                                                                        <input type="radio" name="contrataEgresado" id="contrataEgresado" value="0"  />
                                                                        <label for="no">No</label><br />
                                                                        
                                                                    </div>
                                                                </div>


                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label">Por favor, nos comparte requerimientos de capacitación en su organización, con la finalidad de generar cursos que atiendan dichas necesidades:</label>
                                                                    <div class="col-sm-6">
                                                                        
                                                                        <textarea class="form-control autosize" name="contrataEgresado_comment" id="contrataEgresado_comment" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 112.233px;"> </textarea>

                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label">¿TIENE ALGUNA SUGERENCIA PARA ENRIQUECER AL PROGRAMA EDUCATIVO Y LA FORMACIÓN PROFESIONAL DE LOS EDUCANDOS?</label>
                                                                    <div class="col-sm-6">                                                          
                                                                        <textarea class="form-control autosize" name="sugerenciasEmpleador" id="sugerenciasEmpleador" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 112.233px;"></textarea>

                                                                    </div>
                                                                </div>



                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-12">
                                                        <div class="panel panel-sky">
                                                            <div class="panel-heading">
                                                                <h4>Datos empleador</h4>
                                                                <div class="options"></div>
                                                            </div>
                                                            <div class="panel-body">
                                                                

                                                                <div class="form-group">
                                                                    <label class="col-md-3 control-label">Nombre del empleador</label>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" class="form-control :required :apostrofe"  name="nombreEmpleador" id="nombreEmpleador" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                    </div>
                                                                </div>


                                                                <div class="form-group">
                                                                    <label class="col-md-3 control-label">Puesto o actividad que realiza</label>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" class="form-control :required :apostrofe"  name="puestoEmpleador" id="puestoEmpleador" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                    </div>
                                                                </div>



                                                            </div> 
                                                        </div>
                                                    </div>      


                                                      <div class="form-group">
                                                        <div id="botonera" class="btn-toolbar">
                                                            <center>   
                                                                <input class="btn btn-primary start" type="button" value="Guardar" onclick="getDatasOfEncuestaEmpleadores()">
                                                               
                                                                <a data-toggle="modal"  onClick="window.location.reload()"  class="btn-default btn">Cancelar</a>                           
                                                            </center>
                                                        </div>
                                                        <div id="loading-data"></div>
                                                    </div>    

                                                                      
                                                </form>
                                            </div>

                                        </div>  
                                      


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




<!-- Modal -->
<div id="modalTableAlumnos" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b>Buscar Alumnos</b></h4>
      </div>
      <div class="modal-body">
        <table id="searchAlumnos" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Matricula</th>
                <th>Nombre</th>
                <th>Carrera</th>
            </tr>
        </thead>
          <tbody>
          <?php 
            while ( $row = mysql_fetch_array($result)) : extract($row);
          ?>
            <tr onclick="getAndSetInputs('<?php echo $pk_alumno.'|'.$Alumno.'|'.$pk_carreras.'|'.$nombreCarrera ?>')">
                <td id="name"><?php echo $Alumno ?></td>
                <td id="name"><?php echo $Alumno ?></td>
                <td id="carrera"><?php echo $nombreCarrera ?></td>
            </tr>
          <?php 
            endwhile;
          ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>



<link rel='stylesheet' type='text/css' href='assets/plugins/codeprettifier/prettify.css' /> 
<link rel='stylesheet' type='text/css' href='assets/plugins/form-toggle/toggles.css' /> 

<script>
  $(document).ready(function() {
    $('#searchAlumnos').DataTable();
});

function getAndSetInputs(stringData){
  part = stringData.split("|");

  $("#pk_alumno").val(part[0]);
  $("#nombre").val(part[1]);
  $("#pk_carreras").val(part[2]);
  $("#carrera").val(part[3]);
  $('#modalTableAlumnos').modal('hide');
}


function getDatasOfEncuestaEmpleadores() {  
 var strDatas = $("#frm_datos_encuestaEmpleadores").serialize();
    $.ajax({
        url: pathEgresados +'Ins_EgresadosEncuestaEmpleadores.php',
        type: 'post',
        data: strDatas,
        beforeSend: function (){
                   $("#botonera").hide();
                   $("#loading-data").html("Procesando, espere por favor... <img src='assets/img/ajax-loaders/ajax-loader-1.gif'>");
                },
        success: function(data){
            //console.log(data);
            if(data==1){
                 alertify.alert('Los datos se registraron correctamente', function (e) {
                        if (e) {
                          
                            window.location.reload();
                        } 
                    });              

            }
            else{
                $("#botonera").show();
                $("#loading-data").hide();
                $("#example_filter").hide();
                alertify.alert('Error de datos');
            }
        }
    });

}
</script>
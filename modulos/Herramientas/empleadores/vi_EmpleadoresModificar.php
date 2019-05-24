  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-44426473-2', 'hmelius.com');
  ga('send', 'pageview');

    $(function(){
       $.ajax({
            url: pathEmpleadores + 'lista_empleadores.php',
            type: 'post',
            data: "ListaEmpleadores=ListaEmpleadores",
            success: function(data) {
                if (data != "") {
                    $("#Lista").html(data);
                }
            }
               
       });//fin ajax 
    });
    
  </script> 

<style>
.table-scroll{
	width: auto;
    height: 500px;
    overflow: scroll;
}
</style>


<div id="page-content">
    <div id='wrap'>
        <div id="page-heading">
            <ol class="breadcrumb">
                <li><a href="index.php">Inicio</a></li>
                <li>Empleadores</li>
                <li class="active">Todos los Empleadores</li>
            </ol>

            <h1>Empleadores</h1>
            
        </div>

        <div class="container">
            <div class="row">
              <div class="col-md-12">

                    <div class="panel gray" id="Lista" >
                        
                    </div>
                </div>
            </div>

        </div> <!-- container -->
    </div> <!--wrap -->
</div> <!-- page-content -->


<!--   //Editar Empleador -->
<div class="modal fade" role="dialog" id="EditEmpleadores">
    <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title"> Modificar Carrera </h4>
                    </div>
                    <div class="modal-body">
                            <form action="#" class="form-horizontal" id="f_datosempleadores" name="f_datosempleadores"/>   
                                <input type="hidden" id="v_empleador" name="v_empleador" value="0">
                                <fieldset>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="matricula">Fecha de Solicitud</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control :required :apostrofe"  name="v_fechaSolicitud" id="v_fechaSolicitud" title="ESTE CAMPO ES REQUERIDO" />
                                                </div>
                                            </div>  

                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="nombre">Empresa</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control :required :apostrofe"  name="v_empresa" id="v_empresa" title="ESTE CAMPO ES REQUERIDO" />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="apaterno">Nombre del Solicitante</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control :required :apostrofe"  name="v_nomSolicitante" id="v_nomSolicitante" title="ESTE CAMPO ES REQUERIDO" />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="amaterno">Puesto del Solicitante</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control :required :apostrofe"  name="v_puestoSolicitante" id="v_puestoSolicitante" title="ESTE CAMPO ES REQUERIDO" />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="direccion">Licenciatura</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control :required :apostrofe"  name="v_licenciatura" id="v_licenciatura"/>
                                                </div>
                                            </div>



                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="codigopostal">Puesto Vacante</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control :required :apostrofe"  name="v_puestoVacante" id="v_puestoVacante"/>
                                                </div>
                                            </div>



                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Numero de Vacantes</label>
                                                <div class="col-sm-2">
                                                    <input type="number" class="form-control :required :apostrofe"  name="v_numVacantes" id="v_numVacantes" />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="v_telefono">Telefono</label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control :required :apostrofe "  name="v_telefono" id="v_telefono" />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="v_email">Email</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control :required :apostrofe :email"  name="v_email" id="v_email" />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="v_direccion">Dirección</label>
                                                <div class="col-sm-7">
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
            </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    
</div> <!-- page-container -->

<!--
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

<script>!window.jQuery && document.write(unescape('%3Cscript src="assets/js/jquery-1.10.2.min.js"%3E%3C/script%3E'))</script>
<script type="text/javascript">!window.jQuery.ui && document.write(unescape('%3Cscript src="assets/js/jqueryui-1.10.3.min.js'))</script>
-->

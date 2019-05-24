<div id="page-content">
    <div id="wrap">
        <div id="page-heading">
            <ol class="breadcrumb">
                <li><a href="<?php echo Config::PAG_ADMIN . "?content=home2"; ?>">Inicio</a></li>
                <li class="active">Busqueda Avanzada de Alumnos Finados</li>
            </ol>

            <h1>Busqueda</h1>
           
        </div>

        <div class="container">

<div class="panel panel-midnightblue">
    <div class="panel-heading">
        <h4>Metodo de busqueda</h4>
    </div>
    <div class="panel-body collapse in">
        <form id="f_busqueda" class="form-horizontal row-border" style="border-radius: 0px;">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="cmb_search">Metodo de Busqueda</label>
                <div class="col-sm-4">
                    <select class="form-control" name="cmb_search" id="cmb_search">
                        <option value=""> :: Selecciona opcion de busqueda :: </option>
                        <option value="1">Nombre Completo</option>
                        <option value="2">Matrícula</option>
                        <option value="3">Por generacion</option>
                        <option value="4">Defunciones</option>
                    </select>    
                </div>
            </div>
            <div id="cont_search">
            </div>
            <div class="form-group">
                <div id="botonera">
                    <button class="btn btn-primary" disabled="" id="btn_busqueda">
                        <li class="icon icon-search"></li>&nbsp; Buscar
                    </button>
                </div>
                <div id="loading-data"></div>
            </div>
        </form>
    </div>
    
</div>

<div class="row">
    <div class="col-md-12" id="resul_busqueda">
        
    </div>

</div>


        <!-- Colorpicker Modal -->
          <div class="modal fade modals" id="myDetalles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title">Datos Generales</h4>
                </div>
                <div class="modal-body" id="content">
                    <div class="alert alert-dismissable alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h3>Panel: Detalles de Alumno : <span id="alumno"></span> !</h3> 

                                <p>En desarrollo.</p>
                                <br>
                                <p><a class="btn btn-success" href="#">Okay</a></p>

                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  <button type="button" class="btn btn-primary">Guardar Cambios</button>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

        </div> <!-- container -->

    </div> <!--wrap -->

</div>
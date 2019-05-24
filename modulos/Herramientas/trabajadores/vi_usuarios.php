<?php

require_once 'includes/Config.class.php';
require_once 'includes/DB.class.php';
require_once 'includes/ConsultaDB.class.php';
require_once 'includes/MisFunciones.class.php';

$db = new database();
$consulta = new ConsultaDB();
$fun = new MisFunciones();

$Genero = "";
$result = $ConsultaDB->ConsultaGenero();
while ($row = mysql_fetch_assoc($result)) {
    $Genero .= "<option value='$row[pk_genero]'>$row[descripcion]</option>";
}
mysql_free_result($result);

?>

  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-44426473-2', 'hmelius.com');
  ga('send', 'pageview');

    $(function(){
       $.ajax({
            url: pathTrabajadores + 'Lista_usuarios.php',
            type: 'post',
            data: "ListaUsuarios=ListaUsuarios",
            success: function(data) {
                if (data != "") {
                    $("#Lista").html(data);
                }
            }
               
       });//fin ajax 
    });
    
  </script>  
     
<div id="page-content">
    <div id='wrap'>
        <div id="page-heading">
            <ol class="breadcrumb">
                <li><a href="<?php echo Config::PAG_ADMIN . "?content=home2"; ?>">Inicio</a></li>
                <li>Carreras</li>
                <li class="active">Todas los Usuarios</li>
            </ol>

            
            <h1>Usuarios</h1>
            
            <div class="options">
                <div class="btn-toolbar">
                    <div class="btn-group hidden-xs">
<!--                        <a href='#' class="btn btn-muted dropdown-toggle" data-toggle='dropdown'><i class="icon-cloud-download"></i><span class="hidden-sm"> Exportar Como  </span><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Archivo de Texto (*.txt)</a></li>
                            <li><a href="#">Archivo Excel (*.xlsx)</a></li>
                            <li><a href="#">Archivo PDF (*.pdf)</a></li>
                        </ul>-->
                    </div>
                    <a href="#" class="btn btn-muted"><i class="icon-cog"></i></a>
                </div>
            </div>
        </div>

        <div class="container">

                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="panel">
                            <div class="panel-heading">
                                <h4><i class="icon-cloud"></i> Datos de usuarios </h4>
                                
                                <div class="options">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#home1" data-toggle="tab">Usuarios</a>
                                        </li>
                                        <li>
                                            <a href="#profile1" data-toggle="tab">Todos</a>
                                        </li>
                                        <li>
                                            <a href="#profile2" data-toggle="tab">Bajas</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <!--  TABLA DE CARRERAS-->
                                    <div class="tab-pane active" id="home1">
                                        <div class="panel panel-sky">

                                            <br>
                                            <div>
                                                <a data-toggle="modal" href="#Altauser" class="btn btn-primary"><i class="icon-plus"> Nuevo Registro</i></a>
                                            </div>  
                                            <br>
                                            <div id="Lista"></div>  

                                        </div>
                                    </div>
                                    
                                    <!--  TODOS LOS USUARIOS-->
                                    <div class="tab-pane" id="profile1">
                                        <div class="panel panel-sky">
                                            <div id="Todos"></div>
                                        
                                        </div>
                                    </div>
                                    
                                    <!-- BAJAS -->
                                    <div class="tab-pane" id="profile2">
                                        <div class="panel panel-sky">
                                            <div id="Bajas"></div>
                                        
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
   


<!--ALTA USUARIO-->
<div class="modal fade" role="dialog" id="Altauser">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Alta de usuarios</h4>
            </div>
            <div class="modal-body">
                <form action="#" class="form-horizontal" id="f_user" name="f_user"/>   
                <fieldset>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="v_clvCarrera">Clave de Trabajador</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control :required :apostrofe" required="" name="v_clvCarrera" id="v_clvCarrera" title="CLAVE DE IDENTIFICACIÓN DE LA CARREA" autofocus/>
                        </div>
                    </div>

                        <div class="form-group">
                        <label class="col-sm-3 control-label" for="v_nomCarrera">Nombre(s)</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control :required :apostrofe" required name="v_nomCarrera" id="v_nomCarrera" title="NOMBRE COMPLETO DE LA CARRERA"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="v_revoe">A. Paterno</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control :required :apostrofe" required name="v_revoe" id="v_revoe" title="NÚMERO DE ACUERDO"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="v_fechaexp">A. Materno</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control :required :apostrofe" required name="v_fechaexp" id="v_fechaexp" title="FECHA DE EXPEDICIÓN"/>
                        </div>
                    </div>                
                    
                       
  <div class="form-group">
                                                        <label class="col-sm-3 control-label" for="fk_genero">Genero</label>
                                                        <div class="col-sm-6">
                                                            <select class="form-control :required" name="fk_genero" id="fk_genero">
                                                                <option value="">-- Seleccione --</option>
                                                                <?php
                                                                echo $Genero;
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="v_nomTitulo">Telefono</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control :required :apostrofe" required name="v_nomTitulo" id="v_nomTitulo" title="NOMBRE DEL TITULO DE LA CARRERA"/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="v_nomTitulo">Correo</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control :required :apostrofe" required name="v_nomTitulo" id="v_nomTitulo" title="NOMBRE DEL TITULO DE LA CARRERA"/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="v_nomTitulo">Puesto</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control :required :apostrofe" required name="v_nomTitulo" id="v_nomTitulo" title="NOMBRE DEL TITULO DE LA CARRERA"/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="v_academico">Area</label>
                        <div class="col-sm-6">
                            <select class="form-control :required :apostrofe" name="v_academico" id="v_academico">
                                <option value="0"> -- Seleccionar -- </option>
                                <?php do { ?>
                                <option value="<?php echo $nivel_row['pk_nivelestudio'] ?>"><?php echo $nivel_row['descripcion']; ?></option>
                                <?php }while($nivel_row = @mysql_fetch_assoc($rs)); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label :required :apostrofe" for="v_edificio">Edificio</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" required name="v_edificio" id="v_edificio" title="UBICACION DE LA DIRECCION DE LA CARRERA"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="btn-toolbar">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a data-toggle="modal" onclick="window.location.reload();" class="btn-default btn">Cancelar</a>
                        </div>
                    </div>
                </fieldset>    
                </form>
            </div>
        </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




    
<!--   //Editar Carrera -->
<!--<div class="modal fade" role="dialog" id="Edituser">
    <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title"> Modificar Carrera </h4>
                    </div>
                    <div class="modal-body">
                        
                        <form action="#" class="form-horizontal" id="f_user" name="f_user" method="POST"/>   
                        <fieldset>
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="v_plantel">Plantel</label>
                                <div class="col-sm-6">
                                    <input type="hidden" class="form-control" name="v_pkCarrera" id="v_pkCarrera"/>
                                    
                                    <select class="form-control" name="v_plantel" id="v_plantel"> 
                                        <option value=""> -- Sleccionar -- </option>
                                         <?php 
                                              $school = $consulta->obtenerEscuelas();
                                              $school_row = @mysql_fetch_assoc($school);
                                              do { ?>
                                        <option value="<?php echo $school_row['pk_dtgenerales']; ?>"><?php echo $fun->str_to_may($school_row['apodoInstitucion']); ?></option>
                                        <?php }while($school_row = @mysql_fetch_assoc($school)); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="v_clvCarrera">Clave Carrera</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control :required :apostrofe" required="" name="v_clvCarrera" id="v_clvCarrera" title="CLAVE DE IDENTIFICACIÓN DE LA CARREA" autofocus/>
                                </div>
                            </div>

                                <div class="form-group">
                                <label class="col-sm-3 control-label" for="v_nomCarrera">Nombre de la Carrera</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control :required :apostrofe" required name="v_nomCarrera" id="v_nomCarrera" title="NOMBRE COMPLETO DE LA CARRERA"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="v_revoe">REVOE</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control :required :apostrofe" required name="v_revoe" id="v_revoe" title="NÚMERO DE ACUERDO"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="v_fechaexp">Fecha de Expedición</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control :required :apostrofe" required name="v_fechaexp" id="v_fechaexp" title="FECHA DE EXPEDICIÓN"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="v_modalidad">Modalidad</label>
                                <div class="col-sm-6">
                                    <select class="form-control :required" name="v_modalidad" id="v_modalidad">
                                        <option value=""> -- Seleccionar -- </option>
                                        <?php
                                              $mod = $consulta->obtenerModalidad();
                                              $rsmod_row = @mysql_fetch_assoc($mod);
                                              do { ?>
                                        <option value="<?php echo $rsmod_row['pk_modalidad']; ?>"><?php echo $fun->str_to_may($rsmod_row['nombreMod']); ?></option>
                                        <?php }while($rsmod_row = @mysql_fetch_assoc($mod)); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="v_nomTitulo">Nombre de Titulo</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control :required :apostrofe" required name="v_nomTitulo" id="v_nomTitulo" title="NOMBRE DEL TITULO DE LA CARRERA"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="v_academico">Nivel Academico</label>
                                <div class="col-sm-6">
                                    <select class="form-control :required" name="v_academico" id="v_academico">
                                        <option value=""> -- Seleccionar -- </option>
                                        <?php 
                                              $nivel = $consulta->obtenerNivelestudio();
                                              $acade_row  = @mysql_fetch_assoc($nivel);
                                              do { ?>
                                        <option value="<?php echo $acade_row['pk_nivelestudio'] ?>"><?php echo $fun->str_to_may($acade_row['descripcion']); ?></option>
                                        <?php }while($acade_row = @mysql_fetch_assoc($nivel)); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label :required :apostrofe" for="v_edificio">Edificio</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" required name="v_edificio" id="v_edificio" title="UBICACION DE LA DIRECCION DE LA CARRERA"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="btn-toolbar">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <a data-toggle="modal" onclick="window.location.reload();" class="btn-default btn">Cancelar</a>
                                </div>
                            </div>
                        </fieldset>    
                        </form>
                    </div>
            </div> /.modal-content 
    </div> /.modal-dialog 
</div> /.modal -->


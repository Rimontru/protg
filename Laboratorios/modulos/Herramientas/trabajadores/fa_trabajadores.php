<?php
//$Ruta = "../../../includes/";
//require($Ruta . 'Config.class.php');
//require_once($Ruta. 'DB.class.php');
//require_once($Ruta . 'ConsultaDB.class.php');
//require_once($Ruta . 'MisFunciones.class.php');

//$funciones = new MisFunciones();
$consulta = new ConsultaDB();
$carreras  = "";
$result = $consulta->TodasCarreras();
while ($row = @mysql_fetch_assoc($result)) {
    $carreras .= "<option value='$row[pk_carreras]'>$row[clvCarrera]</option>";
}
@mysql_free_result($result);

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
                    $("#Todos").html(data);
                }
            }
               
       });//fin ajax 
    });
    
    
    $(function(){
       $.ajax({
            url: pathTrabajadores + 'Lista_bajausuarios.php',
            type: 'post',
            data: "ListaUsuarios=ListaUsuarios",
            success: function(data) {
                if (data != "") {
                    $("#Bajas").html(data);
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
                                <h4><i class="icon-cloud"></i> Alta de usuarios </h4>
                                
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
                                
                                        <form action="#" class="form-horizontal" id="f_user" name="f_user"/>   
                                            <fieldset>
                                                <legend>Datos personales</legend>    
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label" for="v_clvTrabajador">Clave de Trabajador</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control :required :apostrofe" required="" name="v_clvTrabajador" id="v_clvTrabajador" title="CLAVE DE IDENTIFICACIÓN DEL TRABAJADOR" autofocus/>
                                                    </div>
                                                </div>

                                                    <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="v_nombreUser">Nombre(s)</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control :required :apostrofe" required name="v_nombreUser" id="v_nombreUser" title="NOMBRE COMPLETO DEL USUARIO"/>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="v_apaterno">A. Paterno</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control :required :apostrofe" required name="v_apaterno" id="v_apaterno" title="APELLIDO PATERNO"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="v_amaterno">A. Materno</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control :required :apostrofe" required name="v_amaterno" id="v_amaterno" title="APELLIDOS MATERNO"/>
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
                                                    <label class="col-sm-3 control-label" for="v_tel">Telefono</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control :required :apostrofe" required name="v_tel" id="v_tel" title="TELEFONO"/>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="v_correo">Correo</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control :required :apostrofe :email" required name="v_correo" id="v_correo" title="DIRECCION DE CORREO ELECTRONICO"/>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="v_puesto">Puesto</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control :required :apostrofe" required name="v_puesto" id="v_puesto" title="PUESTO LABORAL"/>
                                                    </div>
                                                </div>                                             
                                                
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Area Laboral</label>
                                                    <div class="col-sm-6">
                                                        <select multiple="multiple" id="multi-select">
                                                        <?php
                                                            echo $carreras;
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="panel-footer"> 
                                                    <div class="row">    
                                                        <div class="col-sm-6 col-sm-offset-3">
                                                            <div class="btn-toolbar">

                                                                <button type="submit" class="btn-primary btn">Guardar</button>
                                                                <a data-toggle="modal" onclick="window.location.reload();" class="btn-default btn">Cancelar</a>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>    
                                               </fieldset>                                        
                                            </form>  

                                        
                                   
                                    </div>
                                    
                                    
                                     <!--  TODOS LOS USUARIOS-->
                                    <div class="tab-pane" id="profile1">
                                        <div class="panel panel-sky">
                                            <div id="Todos"></div>
                                        
                                        </div>
                                    </div>
                                     
                                     
                                    <!--  TABLA DE BAJAS-->
                                    <div class="tab-pane" id="profile2">
                                        <div class="panel panel-sky">
                                            <div id="Bajas">
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



<!--   //Editar Trabajador -->
<div class="modal fade" role="dialog" id="Edituser">
    <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title"> Modificar Usuario </h4>
                    </div>
                    <div class="modal-body">
                        
                        <form action="#" class="form-horizontal" id="f_user" name="f_user" method="POST"/>   
                        <fieldset> 
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="v_clvTrabajador">Clave de Trabajador</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control :required :apostrofe" required="" name="v_clvTrabajador" id="v_clvTrabajador" title="CLAVE DE IDENTIFICACIÓN DEL TRABAJADOR" autofocus/>
                                    <input type="text" name="v_idTrabajador" id="v_idTrabajador"/>
                                </div>
                            </div>

                                <div class="form-group">
                                <label class="col-sm-3 control-label" for="v_nombreUser">Nombre(s)</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control :required :apostrofe" required name="v_nombreUser" id="v_nombreUser" title="NOMBRE COMPLETO DEL USUARIO"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="v_apaterno">A. Paterno</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control :required :apostrofe" required name="v_apaterno" id="v_apaterno" title="APELLIDO PATERNO"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="v_amaterno">A. Materno</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control :required :apostrofe" required name="v_amaterno" id="v_amaterno" title="APELLIDOS MATERNO"/>
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
                                <label class="col-sm-3 control-label" for="v_tel">Telefono</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control :required :apostrofe" required name="v_tel" id="v_tel" title="TELEFONO"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="v_correo">Correo</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control :required :apostrofe :email" required name="v_correo" id="v_correo" title="DIRECCION DE CORREO ELECTRONICO"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="v_puesto">Puesto</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control :required :apostrofe" required name="v_puesto" id="v_puesto" title="PUESTO LABORAL"/>
                                </div>
                            </div>                                             

                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="v_area">Area Laboral</label>
                                <div class="col-sm-6">
                                    <select class="form-control :required :apostrofe" name="v_area" id="v_area">
                                        <?php
                                            echo $carreras;
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="panel-footer"> 
                                <div class="row">    
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <div class="btn-toolbar">

                                            <button type="submit" class="btn-primary btn">Guardar</button>
                                            <a data-toggle="modal" onclick="window.location.reload();" class="btn-default btn">Cancelar</a>

                                        </div>
                                    </div>
                                </div>
                            </div>                      
                        </fieldset>    
                        </form>
                    </div>
            </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


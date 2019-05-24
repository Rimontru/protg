<?php
#AGREGADO: Ivan Mauricio Melo Granados
#FECHA: 29/05/2014 

$Permisos = "";
$resultPermisos = $ConsultaDB->ConTitulosMenus();
while ($row = mysql_fetch_assoc($resultPermisos)) {
    $Permisos .= "<option value='$row[idTituloMenu]'>".utf8_encode($row["Nombre"])."</option>";
}
mysql_free_result($resultPermisos);
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
                <li>Sistema</li>
                <li class="active">Usuarios</li>
            </ol>

            <h1>Usuarios</h1>
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
                    <h4><i class="icon-cloud"></i> Usuarios</h4>
                    <div class="options">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#home1" data-toggle="tab"> Usuarios</a>
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
                                                <form action="#" class="form-horizontal" id="frm_busqueda_trabajadores" name="frm_busqueda_trabajadores"/>   
                                                <fieldset>



                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="panel panel-midnightblue">
                                                                <div class="panel-heading">
                                                                    <h4>Busqueda...</h4>
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
                                                                                <label class="col-md-3 control-label" for="matricula_buscar">Apellidos del Trabajador</label>
                                                                                <div class="col-sm-6">
                                                                                    <input type="text" class="form-control :apostrofe"  name="matricula_buscar" id="matricula_buscar" autofocus/>
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


                                            <form action="#" class="form-horizontal" id="frm_TrabajadorModificar" name="frm_TrabajadorModificar"/>   
                                            <fieldset>




                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="panel panel-midnightblue">
                                                            <div class="panel-heading">
                                                                <h4>Datos Generales</h4>
                                                                <div class="options"></div>
                                                            </div>
                                                            <div class="panel-body">

                                                                <input type="hidden" class="form-control :apostrofe" name="pk_trabajador" id="pk_trabajador" />


                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="nombre">Nombre(s)</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control :apostrofe" disabled="" name="nombre" id="nombre" title="NOMBRE COMPLETO DEL USUARIO"/>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="apaterno">A. Paterno</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control :apostrofe" disabled="" name="apaterno" id="apaterno" title="APELLIDO PATERNO"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="amaterno">A. Materno</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control :apostrofe" disabled="" name="amaterno" id="amaterno" title="APELLIDOS MATERNO"/>
                                                    </div>
                                                </div>         
                                                                
                                                                
                                                                
                                                
                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="NombreUsuario">Usuario</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :required :apostrofe"  name="NombreUsuario" id="NombreUsuario" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                        </div>
                                                                    </div>  
                                                            
                                                                      <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="Password">Contraseña</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="password" class="form-control :required :apostrofe"  name="Password" id="Password" />
                                                                        </div>
                                                                    </div>
                                                              
                                                                       <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="PasswordRepite">Repite Contraseña</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="password" class="form-control :required :apostrofe"  name="PasswordRepite" id="PasswordRepite" />
                                                                        </div>
                                                                    </div>               
                                                                
                                                                
                                                                
                                                                


                                                            </div>


                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="panel panel-sky">
                                                            <div class="panel-heading">
                                                                <h4>Permisos de Usuario</h4>
                                                                <div class="options"></div>
                                                            </div>


                                                            <div class="panel-body">



                                                                   <div id= "Permisos-Usuario">
                                                                        <h1>Asignar Permisos</h1>                        
                                                                        <table width="800" border="0" id="asigna-permisos">
                                                                            <thead>
                                                                                <tr>                                    
                                                                                    <td><label>Titulo Menú</label></td>
                                                                                    <td><label>Nombre Archivo</label></td>

                                                                                    <td> 
                                                                                        <a href="" id="Agrega_Permiso" title="Agregar otro permiso al usuario" ><img src="assets/img/add.png"></a>
                                                                                    </td>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>                                    
                                                                                    <td>
                                                                                        <select id="Modulo" name="Modulo[]" tabindex="9" class=":required">
                                                                                            <option value="">Elige un Menu</option>
                                                                                            <?php
                                                                                            echo $Permisos;
                                                                                            ?>
                                                                                        </select>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div id="comboPermisos"></div>
                                                                                    </td>

                                                                                    <td></td>
                                                                                </tr>
                                                                            </tbody>                           
                                                                        </table>                                                
                                                                   </div>
                                                               


                                                            </div>
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

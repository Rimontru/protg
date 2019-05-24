<?php
#AGREGADO: Ivan Mauricio Melo Granados
#FECHA: 29/05/2014 

$Permisos = "";
$resultPermisos = $ConsultaDB->ConTitulosMenus();
while ($row = mysql_fetch_assoc($resultPermisos)) {
    $Permisos .= "<option value='$row[idTituloMenu]'>" . utf8_encode($row["Nombre"]) . "</option>";
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
                                                <form action="#" method='post' id="Usuario_Modificar_Consulta" accept-charset="utf-8">
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
                                                                                <label class="col-md-3 control-label" for="matricula_buscar">Nombre de Usuario</label>
                                                                                <div class="col-sm-6">
                                                                                    <input type="text" class="form-control :apostrofe" name='Usuario' id='Usuario' autofocus required/>
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


<form action="#" method='post' id="Usuario_Modificar" class="form-horizontal" accept-charset="utf-8">
 <input name='Pk_Usuario_Login' id="Pk_Usuario_Login" type='hidden'/>
                <div class="box-content" id="DatosUsuarioModificar" style="display: none;"> 
                    
                    
                    <div class="col-md-12">
                        <div class="panel panel-sky">
                            <div class="panel-heading">
                                <h4>Datos Personales</h4>
                                <div class="options"></div>
                            </div>


                            <div class="panel-body">


                                                <!--<input type="hidden" class="form-control :apostrofe" name="Pk_Usuario_Login" id="Pk_Usuario_Login" />-->


                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="Nombre">Nombre de Usuario</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control :apostrofe" name='Nombre' id="Nombre"/>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="apaterno">password</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control :apostrofe" name='Password' id="Password" type='password'/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="amaterno">password Repite</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control :apostrofe"name='PasswordRepite' id="PasswordRepite" type='password'/>
                                                    </div>
                                                </div>         
                                                                
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label" for="activo_usuario">Status Usuario</label>
                                                        <div class="col-sm-6">
                                                            <select class="form-control :required" name="activo_usuario" id="activo_usuario">
                                                                <option value="">-- Seleccione --</option>
                                                              <option selected="selected" value="">Elige</option>
                                                            <option value="1">Activo</option>
                                                            <option value="0">Baja</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                
                                                <label style="color: red">Nota: El Nombre de Usuario y La Contraseña se reemplazara con la actual</label>

                                        <input name='banderita' id="banderita" type='hidden' size='30' value="2" maxlength="45"/>
                                        
                                        
                                          <div class="control-group">
                                                <label class="control-label">Cambiar Contraseña</label>
                                                <div class="controls">
                                                  <label class="checkbox inline">
                                                        <input type="radio" id="Si_Cambiar_Pass" name="radio-2-set" class="regular-checkbox big-checkbox" /><label for="Si_Cambiar_Pass">SI</label>
                                                  </label>
                                                  <label class="checkbox inline">
                                                        <input type="radio" id="No_Cambiar_Pass" name="radio-2-set" class="regular-checkbox big-checkbox" checked="checked" /><label for="No_Cambiar_Pass">NO</label>
                                                  </label>
                                                </div>
                                          </div>
                                        
                                        



                            </div>
                        </div>
                    </div>
                    
                    
                  
                    
                    
                     <div class="col-md-12" id="permisosid" style="margin-left: -1px;">
                        <div class="panel panel-sky">
                            <div class="panel-heading">
                                <h4>Asignar Permisos</h4>
                                <div class="options"></div>
                            </div>


                            <div class="panel-body">


                                          <input name='verPermisos' id="verPermisos" type='button' value='Ver Permisos' class='Btn_Consulta' tabindex="10"/>
                        
                        
                        
                                        <div id= "Permisos-Usuario">

                                             <div id= "Permisos-Usuario-Modificar" style="display: none;">
                                                 <table width="600" border="0" id="asigna-permisos-modificar" >
                                                    <thead>
                                                    <tr>                                    
                                                        <td><label>Titulo Menú</label></td>
                                                     <td><label>Permisos</label></td>

                                                        <td> 
                                                            <a href="" id="Agrega_Permiso_Modificar" title="Agregar otro permiso al usuario" ><img src="assets/img/add.png"></a>
                                                        </td>
                                                    </tr>
                                                </thead>
                                                    <tbody>

                                                    </tbody>                           
                                                </table>
                                            </div>                                                         
                                        </div>


                            </div>
                        </div>
                    </div>
                       
                    
                    
                     <div class="form-group" >
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
                    
                    
                    
<!--                        <div class="form-actions" id='botonera'>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <button class="btn btn-danger" onclick="window.location.reload();">Cancelar</button>
                        </div>-->

                  


                </div>
      </form> 



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













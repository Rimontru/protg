<?php
#AGREGADO: Ivan Mauricio Melo Granados
#FECHA: 04/02/14     
$Activo = 1;
$Menus = "";
$result = $ConsultaDB->ConTitulosMenusAsignar();
while ($row = mysql_fetch_assoc($result)) {
    $Menus .= "<option value='$row[idMenu]'>$row[Name]</option>";
}
mysql_free_result($result);

$Empresas = "";
$result = $ConsultaDB->ConEmpresas();
while ($row = mysql_fetch_assoc($result)) {
    $Empresas .= "<option value='$row[Pk_Empresa]'>$row[Nombre]</option>";
}
mysql_free_result($result);
?>
<div class="row-fluid">



    <noscript>
    <div class="alert alert-block span10">
        <h4 class="alert-heading">Warning!</h4>
        <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
    </div>
    </noscript>

    <div id="content" class="span10">
        <!-- content starts -->


        <div>
            <ul class="breadcrumb">
                <li>
                    <a href="<?php echo Config::PAG_ADMIN . "?content=home2"; ?>">Inicio</a> <span class="divider">/</span>
                </li>
                <li>
                    <a href="<?php echo Config::PAG_ADMIN . "?content=Usuario_Modificar"; ?>"> Modificar Usuarios</a>
                </li>
            </ul>
        </div>

        <div class="row-fluid sortable">
            <div class="box span12">
                <div class="box-header well" data-original-title>
                    <h2><i class="icon-globe"></i> Modificar Usuarios</h2>
                    <div class="box-icon">
                        <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                        <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                    </div>
                </div>


                <div class="box-content" id="BuscarUsuarioModificar"> 
                        <div class="row-fluid sortable">
                            <div class="box-content">
                                <div class="row-fluid">
                                    <form action="#" method='post' id="Usuario_Modificar_Consulta" accept-charset="utf-8">
                                        <label>Nombre de Usuario:</label>
                                        <input name='Usuario' id='Usuario' type='text' class=":required" size='30' maxlength='100' tabindex='1' />
                                    
                                        <div id="loading-data">

                                        </div>
                                        <div class="form-actions" id='botonera'>
                                            <button type="submit" class="btn btn-primary">Buscar</button>
                                            <button class="btn btn-danger" id="CancelarAgregarProductoNuevo">Cancelar</button>
                                        </div>
                                    </form> 
                                </div>                   
                            </div>
                        </div><!--/row-->
                        
                </div>





<form action="#" method='post' id="Usuario_Modificar" accept-charset="utf-8">
 <input name='Pk_Usuario_Login' id="Pk_Usuario_Login" type='hidden'/>
                <div class="box-content" id="DatosUsuarioModificar" style="display: none;"> 
                    
                        <div class="row-fluid sortable">
                            <div class="box span6">
                                <div class="box-header well" data-original-title>
                                    <h2><i class="icon-th"></i> Datos Personales</h2>
                                    <div class="box-icon">
                                        <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                                        <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                                        <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                                    </div>
                                </div>
                                <div class="box-content">
                                    <div class="row-fluid">

                                        <label>Nombre:</label>
                                        <input name='Nombre' id="Nombre" type='text' class=":required :apostrofe" size='30' maxlength="45" tabindex="1"/>
                                        <label>Correo:</label>
                                        <input name='Correo' id="Correo" type='text' class=":email :required :apostrofe"  size='30' maxlength="45" tabindex="5"/>
                                        <label>Empresa:</label>
                                        <select id="Fk_Empresa" name="Fk_Empresa" class=":required" tabindex="4">
                                            <option selected="selected" value="">Elige</option>
                                            <?php
                                            echo $Empresas;
                                            ?>
                                        </select>

                                            <label>Status Usuario:</label>
                                        <select id="Status_User" name="Status_User" class=":required" tabindex="4">
                                            <option selected="selected" value="">Elige</option>
                                            <option value="1">Activo</option>
                                            <option value="2">Baja</option>
                                        </select>

                                            <br>
                                             <br>
                                              <br>
                                             
                                    </div>                   
                                </div>
                            </div><!--/span-->
                            <div class="box span6">
                                <div class="box-header well" data-original-title>
                                    <h2><i class="icon-th"></i> Login Sistema</h2>
                                    <div class="box-icon">
                                        <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                                        <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                                        <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                                    </div>
                                </div>
                                <div class="box-content">
                                    <div class="row-fluid">
 
                                        <label>Usuario:</label>
                                        <input name='Usuario' id="Usuario" type='text' class=':required :apostrofe' size='30' maxlength="45" tabindex="6"/>
                                        <label>Contrase&ntilde;a:</label>
                                        <input name='Password' id="Password" type='password' class=':required :min_length;6 :apostrofe' size='30' maxlength="45" tabindex="7"/>
                                        <label>Repite Contrase&ntilde;a:</label>
                                        <input name='PasswordRepite' id="PasswordRepite" type='password' class=':required :min_length;6 :apostrofe' size='30' maxlength="45" tabindex="8"/>        
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

                            </div><!--/span-->
                            <div id="permisosid" style="margin-left: -1px;" class="box span6">
                                <div class="box-header well" data-original-title>
                                    <h2><i class="icon-th"></i> Asignar Permisos</h2>
                                    <div class="box-icon">
                                        <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                                        <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                                        <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                                    </div>
                                </div>
                                <div class="box-content">
                                    <div class="row-fluid">
                                        
                                        
                        <input name='verPermisos' id="verPermisos" type='button' value='Ver Permisos' class='Btn_Consulta' tabindex="10"/>
                        
                        
                        
                                        <div id= "Permisos-Usuario">

                                             <div id= "Permisos-Usuario-Modificar" style="display: none;">
                                                 <table width="300" border="0" id="asigna-permisos-modificar" >
                                                    <thead>
                                                    <tr>                                    
                                                        <td><label>Titulo Menú</label></td>
                                                     

                                                        <td> 
                                                            <a href="" id="Agrega_Permiso_Modificar" title="Agregar otro permiso al usuario" ><img src="img/iconos/add.png"></a>
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

                            </div><!--/span-->

                        </div><!--/row-->

                        <div id="loading-data">

                        </div>

                        <div class="form-actions" id='botonera'>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <button class="btn btn-danger" onclick="window.location.reload();">Cancelar</button>
                        </div>

                  


                </div>
      </form> 
            </div><!--/span-->

        </div><!--/row-->



        <!-- content ends -->
    </div><!--/#content.span10-->
</div><!--/fluid-row-->

<hr>
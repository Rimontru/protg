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

$Empresas= "";
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
                    <a href="<?php echo Config::PAG_ADMIN . "?content=Usuario_Alta"; ?>"> Usuarios</a>
                </li>
            </ul>
        </div>

        <div class="row-fluid sortable">
            <div class="box span12">
                <div class="box-header well" data-original-title>
                    <h2><i class="icon-globe"></i> Usuarios</h2>
                    <div class="box-icon">
                        <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                        <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                    </div>
                </div>

                <div class="box-content">




                    <form action="#" method='post' id="Usuario_Alta" accept-charset="utf-8">

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

                                        <div id= "Permisos-Usuario">

                                            <table width="300" border="0" id="asigna-permisos">
                                                <thead>
                                                    <tr>                                    
                                                        <td><label>Titulo Menú</label></td>
                                                     

                                                        <td> 
                                                            <a href="" id="Agrega_Permiso" title="Agregar otro permiso al usuario" ><img src="img/iconos/add.png"></a>
                                                        </td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>                                    
                                                        <td>
                                                            <select id="Modulo" name="Modulo[]" tabindex="9" class=":required">
                                                                <option value="">Elige un Menu</option>
                                                                 <option value="1">Clientes</option>
                                                                 <option value="2">Productos</option>
                                                                 <option value="3">Facturaci&oacute;n</option>
                                                                 <option value="4">Listar Facturas</option>
                                                            </select>
                                                        </td>
                                                       
                                                        <td></td>
                                                    </tr>
                                                </tbody>                           
                                            </table>                                                
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

                    </form> 


                </div>
            </div><!--/span-->

        </div><!--/row-->



        <!-- content ends -->
    </div><!--/#content.span10-->
</div><!--/fluid-row-->

<hr>









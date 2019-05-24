<?php
#AGREGADO: Ivan Mauricio Melo Granados
#FECHA: 21/01/14     
$Empresas = "";
$result = $ConsultaDB->ConEmpresas();
while ($row = mysql_fetch_assoc($result)) {
    $Empresas .= "<option value='$row[Pk_Empresa]'>$row[Nombre]</option>";
}
mysql_free_result($result);
?>

<div class="container-fluid">
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
                        <a href="<?php echo Config::PAG_ADMIN . "?content=Listar_Usuarios"; ?>"> Listar Usuarios</a>
                    </li>
                </ul>
            </div>

            <div class="row-fluid sortable">		
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-globe"></i> Listar Usuarios</h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                       
                        <div id="NuevoRegistro">
                            <button type="submit"  onclick="location.href='<?php echo Config::PAG_ADMIN . "?content=Usuario_Alta"; ?>'" class="btn btn-primary">Nuevo Usuario</button>
                            <button type="submit"  onclick="location.href='<?php echo Config::PAG_ADMIN . "?content=Usuario_Modificar"; ?>'" class="btn btn-primary">Modificar Usuario</button>
                        </div> 
                        <br> 
                        
                        <?php
                            if($_SESSION['usuario_id']=="1"){
                                 ?>
                                     <div id="SelecEmpresa">
                                        <label>Seleccione Empresa:</label>
                                        <select id="Empresa_SelectUsuarios" name="Empresa_SelectUsuarios" class=":required" tabindex="4">
                                            <option selected="selected" value="">Elige</option>
                                            <option value="1000">Todos</option>
                                            <?php
                                              echo $Empresas;
                                            ?>
                                        </select>
                                    </div>
                                 <?php
                            }else{
                                 ?>
                                        <script>
                                            $(function() {

                                                $.ajax({
                                                    url: pathUsuarios + 'Lista_UsuariosAjax.php',
                                                    type: 'post',
                                                    data: "ListaUsuarios=ListaUsuarios&UsuarioDirecto=2",
                                                    success: function(data) {
                                                        if (data != "") {
                                                            $("#RespuestaClientesLista").html(data);
                                                        }
                                                    }
                                                });

                                            });
                                        </script>
                                <?php
                            }
                                    
                        ?>
                                
                                
                        <div id="RespuestaClientesLista"></div>

                    </div>
                </div><!--/span-->

            </div><!--/row-->


        </div><!--/#content.span10-->
    </div><!--/fluid-row-->

    <hr>
    
    
<div id="ProductosEditarModal" title="SAHE" class='puntero_cursor' style="display: none;">

 <form class="form-horizontal" id="ProductosEditarForm">            
                 <input id="idProducto" type="hidden">                                

                        <div class="row-fluid sortable">
                            <div class="box span6">
                                <div class="box-header well" data-original-title>
                                    <h2><i class="icon-th"></i> Productos</h2>
                                    <div class="box-icon">
                                        <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                                        <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                                        <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                                    </div>
                                </div>
                                <div class="box-content">
                                    <div class="row-fluid">

                                                  <fieldset>
                                                    <input id="idProducto" type="hidden">              
                                                    <div class="control-group">
                                                        <label class="control-label" for="focusedInput">Nombre</label>
                                                        <div class="controls">
                                                            <input class="input-xlarge focused :required :apostrofe" id="ProductoNombre" type="text">
                                                        </div>
                                                    </div>          
                                                    <div class="control-group">
                                                        <label class="control-label" for="textarea2">Descripci&oacute;n</label>
                                                        <div class="controls">
                                                            <textarea id="ProductoDescripcion" class=":required :apostrofe" rows="3"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <label class="control-label" for="focusedInput">Precio</label>
                                                        <div class="controls">
                                                            <input class="input-xlarge focused :required :monto :apostrofe" id="ProductoPreVenta" type="text">
                                                        </div>
                                                    </div> 
                                                      <div class="control-group">
                                                    <label class="control-label">Estatus</label>
                                                    <div class="controls">
                                                        <select name="StatusProducto" id="StatusProducto">
                                                            <option value="1">Activo</option>
                                                            <option value="2">Desactivado</option>
                                                        </select>
                                                    </div>       
              </div>
                                                </fieldset>
                                           


                                    </div>                   
                                </div>
                            </div><!--/span-->
                            <div class="box span6">
                                <div class="box-header well" data-original-title>
                                    <h2><i class="icon-th"></i> Impuestos</h2>
                                    <div class="box-icon">
                                        <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                                        <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                                        <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                                    </div>
                                </div>
                                
                                        
                               
                                                
                                <div class="box-content">
                                    <div class="row-fluid">      
                                      <div class="box-content">
                                          <div class="row-fluid">
                                              <div class="span6">
                                                  Exento:
                                                        <select id="ExentoImpuestos">
                                                            <option value="1">Si</option>
                                                            <option value="2">No</option>
                                                       </select>                                      								
                                              </div>
                                              
                                            </div>  
                                            <div class="row-fluid">
                                                <div class="span6"></div>
                                                <div class="span6 exentodeliva"><h6>Aplica</h6></div>
                                            </div>  
                                            
                                          <div class="row-fluid">
                                              <div class="span6">
                                                  <table>
                                                      <td style="width: 100px;"> I.V.A.</td>
                                                      <td>
                                                          <div class="">
                                                            <input type="text" size="16" id="ImpuestoIVA" name="ImpuestoIVA" class=":monto"><span class="add-on">%</span>
                                                          </div>
                                                      </td>
                                                  </table>                                        								
                                              </div>
                                                <div class="span6 exentodeliva">
                                                     <select id="Check_IVA">
                                                            <option value="1">Si</option>
                                                            <option value="2">No</option>
                                                       </select>
<!--                                                   <label class="checkbox inline">
							<span class="checked"><input type="radio" id="Si_Check_IVA" name="Check_IVA" class="regular-checkbox big-checkbox" checked="checked" /></span> Si
						   </label>
                                                    <label class="checkbox inline">
							<span class="checked"><input type="radio" id="No_Check_IVA" name="Check_IVA" class="regular-checkbox big-checkbox" /></span> No
						   </label>-->
                                                </div>
                                            </div>  
                                          
                                          
                                          <div class="row-fluid">
                                              <div class="span6">
                                                  <table>
                                                      <td style="width: 100px;"> IEPS</td>
                                                      <td>
                                                           <div class="">
                                                                <input type="text" size="16" id="ImpuestoIESPS" name="ImpuestoIESPS" class=":monto"><span class="add-on">%</span>
                                                            </div>
                                                      </td>
                                                  </table>
                                                  
                                                 								
                                              </div>
                                                <div class="span6 exentodeliva">
                                                       <select id="Check_IESPS">
                                                            <option value="1">Si</option>
                                                            <option value="2">No</option>
                                                       </select>
<!--                                                    <label class="checkbox inline">
							<span class="checked"><input type="radio" id="Si_Check_IESPS" name="Check_IESPS" class="regular-checkbox big-checkbox" checked="checked" /></span> Si
						   </label>
                                                    <label class="checkbox inline">
							<span class="checked"><input type="radio" id="No_Check_IESPS" name="Check_IESPS" class="regular-checkbox big-checkbox" /></span> No
						   </label>-->
                                                </div>
                                            </div>  
                                          
                                          <div class="row-fluid">
                                              <div class="span6">
                                                  <table>
                                                      <td style="width: 100px;"> <input type="text" id="TituloOtroImpuesto" class=":apostrofe" name="TituloOtroImpuesto"></td>
                                                      <td>
                                                           <div class="">
                                                                <input type="text" size="16" id="OtroImpuesto" name="OtroImpuesto" class=":monto"><span class="add-on">%</span>
                                                            </div>
                                                      </td>
                                                  </table>
                                                  
                                                  								
                                              </div>
                                                <div class="span6 exentodeliva">
                                                     <select id="Check_OtroImpuesto">
                                                            <option value="1">Si</option>
                                                            <option value="2">No</option>
                                                       </select>
<!--                                                    <label class="checkbox inline">
							<span class="checked"><input type="radio" id="Si_Check_OtroImpuesto" name="Check_OtroImpuesto" class="regular-checkbox big-checkbox" checked="checked" /></span> Si
						   </label>
                                                    <label class="checkbox inline">
							<span class="checked"><input type="radio" id="No_Check_OtroImpuesto" name="Check_OtroImpuesto" class="regular-checkbox big-checkbox" /></span> No
						   </label>-->
                                                </div>
                                            </div>  
                                          
                                          
                                          
                                          
                                          <div class="row-fluid">
                                              <div class="span6">
                                                  <table>
                                                      <td style="width: 100px;"> Retencion ISR</td>
                                                      <td>
                                                          <div class="">
                                                              <input type="text" size="16" id="RetencionISR" name="RetencionISR" class=":monto"><span class="add-on">%</span>
                                                        </div>
                                                      </td>
                                                  </table>
                                                 
                                                  								
                                              </div>
                                                <div class="span6 exentodeliva">
                                                       <select id="Check_RetencionISR">
                                                            <option value="1">Si</option>
                                                            <option value="2">No</option>
                                                       </select>
<!--                                                    <label class="checkbox inline">
							<span class="checked"><input type="radio" id="Si_Check_RetencionISR" name="Check_RetencionISR" class="regular-checkbox big-checkbox" checked="checked" /></span> Si
						   </label>
                                                    <label class="checkbox inline">
							<span class="checked"><input type="radio" id="No_Check_RetencionISR" name="Check_RetencionISR" class="regular-checkbox big-checkbox" /></span> No
						   </label>-->
                                                </div>
                                            </div>  
                                          
                                          
                                          
                                          
                                          <div class="row-fluid">
                                              <div class="span6">
                                                  <center>Retencion IVA</center>
                                              </div>
                                                <div class="span6 exentodeliva">
                                                       <select id="Check_RetencionIVA">
                                                            <option value="1">Si</option>
                                                            <option value="2">No</option>
                                                       </select>
<!--                                                    <label class="checkbox inline">
							<span class="checked"><input type="radio" id="Si_Check_RetencionIVA" name="Check_RetencionIVA" class="regular-checkbox big-checkbox" checked="checked" /></span> Si
						   </label>
                                                    <label class="checkbox inline">
							<span class="checked"><input type="radio" id="No_Check_RetencionIVA" name="Check_RetencionIVA" class="regular-checkbox big-checkbox" /></span> No
						   </label>-->
                                                </div>
                                            </div>  
                                          
                                          
                                          
                                          
                                          
                                          
                                          
                                          
                                          
                                          
                                      </div>


                                    </div>                   
                                </div>

                            </div><!--/span-->
                            

                        </div><!--/row-->

                        <div id="loading-data">
                                           
                        </div>

                       <div id="loading-data2">

                        </div>
                        <div id="botonera2" class="form-actions">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <button class="btn btn-danger" id="CancelarAccion">Cancelar</button>
                        </div>

                    </form> 
    </div>


    <!-- Nuevo Producto -->      
<!--    <div id="ProductosNuevoModal" title="SAHE" class='puntero_cursor' style="display: none;">
        <form class="form-horizontal" id="ProductosNuevoForm">            
            <fieldset>
                 <input id="idProducto" type="hidden">
                <legend>Productos: Nuevo</legend>
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Nombre</label>
                    <div class="controls">
                      <input class="input-xlarge focused :required :apostrofe" id="ProductoNuevoNombre" type="text">
                    </div>
              </div>          
                <div class="control-group">
                    <label class="control-label" for="textarea2">Descripci&oacute;n</label>
                    <div class="controls">
                        <textarea id="ProductoNuevoDescripcion" class=":required :apostrofe" rows="3"></textarea>
                    </div>
                </div>
               
                <div class="control-group">
                    <label class="control-label" for="focusedInput">Precio</label>
                    <div class="controls">
                      <input class="input-xlarge focused :required :monto :apostrofe" id="ProductoNuevoPreVenta" type="text">
                    </div>
                </div> 
                
                 <div id="loading-data2">
                                           
                 </div>
                <div id="botonera2" class="form-actions">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button class="btn btn-danger" id="CancelarAccionNuevo">Cancelar</button>
                </div>
            </fieldset>
        </form>   

    </div>-->

    
    
    
</div><!--/.fluid-container-->
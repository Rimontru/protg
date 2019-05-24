<?php
#AGREGADO: Ivan Mauricio Melo Granados
#FECHA: 21/02/13 14:02 pm         
#DESCRIPCION: Modulo que Genera el Alta de los usuarios  
//$Activo = 1;
//$Cadena = "";
//$result = $ConsultaDB->conDepartamentos($Activo);
//while ($row = mysql_fetch_assoc($result)) {
//    $Cadena .= "<option value='$row[Pk_Departamento]'>$row[Departamento]</option>";
//}
//mysql_free_result($result);

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
                 <li>Herramientas</li>
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
                    <h4><i class="icon-cloud"></i> Alta Usuarios</h4>
                    <div class="options">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#home1" data-toggle="tab"> Alta Usuarios</a>
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
                           <form action="#" method='post' id="Usuario_Alta" accept-charset="utf-8">   
                                <fieldset>

                                                    
                                                    
                                                    
                                        <div class="row">
                                                <div class="col-md-12">
                                                        <div class="panel panel-midnightblue">
                                                          <div class="panel-heading">
                                                                        <h4>Datos de Acceso</h4>
                                                                        <div class="options"></div>
                                                          </div>
                                                          <div class="panel-body">
                                                              
                                                              
                                                              <div class="form-group">
                                                                <label class="col-sm-3 control-label" for="fk_genero">Seleccione Usuario</label>
                                                                <div class="col-sm-6">
                                                                    <select class="form-control :required" name="fk_genero" id="fk_genero">
                                                                        <option value="">-- Seleccione --</option>
                                                                        <?php
                                                                        echo $Genero;
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                               <br>     
                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="matricula">Usuario</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :required :apostrofe"  name="matricula" id="matricula" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                        </div>
                                                                    </div>  
                                                              <br>
                                                                      <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="nombre">Contraseña</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :required :apostrofe"  name="nombre" id="nombre" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                        </div>
                                                                    </div>
                                                                <br>
                                                                       <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="apaterno">Repite Contraseña</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :required :apostrofe"  name="apaterno" id="apaterno" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                        </div>
                                                                    </div>

                                                                     
                                                          </div>
                                                        </div>
                                                </div>
                                                <div class="col-md-12">
                                                        <div class="panel panel-magenta">
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
                                                                 
                                                                        
                                                                        
                                                                   
<!--                                                                      <div class="col-md-2">
                                                                         
                                                                         sdfsd
                                                                         
                                                                     </div>-->
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
                                        
                                        
                                       
                                        <br>
                                        <!--<div id="Lista"></div>-->  

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

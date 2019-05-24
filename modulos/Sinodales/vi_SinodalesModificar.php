<?php
#AGREGADO: Ivan Mauricio Melo Granados
#FECHA: 12/06/2014 
$fk_nivelestudio = "";
$result = $ConsultaDB->ConsultaNiveldeEstudios();
while ($row = mysql_fetch_assoc($result)) {
    $fk_nivelestudio .= "<option value='$row[pk_nivelestudio]'>$row[descripcion]</option>";
}
mysql_free_result($result);


//$Carreras = "";
//$result = $ConsultaDB->ConsultaCarreras();
//while ($row = mysql_fetch_assoc($result)) {
//    $Carreras .= "<option name='Pk_carreras[]' value='$row[pk_carreras]'>$row[clvCarrera]</option>";
//}
//mysql_free_result($result);
?>

<script>
    $(function() {
        $.ajax({
            url: pathSinodales + 'lista_DatosSinodalesModificar.php',
            type: 'post',
            data: "ListaSinodales=ListaSinodales",
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
                <li class="active">Sinodales</li>
            </ol>

            <h1>Sinodales</h1>
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
                    <h4><i class="icon-cloud"></i> Modificar Sinodales</h4>
                    <div class="options">
                        <ul class="nav nav-tabs">
                
                            <li class="active">
                                <a href="#listadosinodales" data-toggle="tab">  Listado Sinodales</a>
                            </li>
                         
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="tab-content">

                       <div class="tab-pane active"  id="listadosinodales">
                            <div id="Lista"></div>  




                        </div>



                        <div id="modificarcontenidosinodal" style="display: none;">
                            
                            
                            <form action="#" class="form-horizontal" id="f_ModificarSinodales" name="f_ModificarSinodales"/>   
                                                <fieldset>


                                                 <input type="hidden"  name="pk_sinodal" id="pk_sinodal" />
    
                                                      <div class="form-group">
                                                        <label class="col-md-3 control-label" for="v_nombre">Nombre</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control :required :apostrofe"  name="v_nombre" id="v_nombre" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label" for="v_cedula">Cedula Profesional</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control :required :apostrofe"  name="v_cedula" id="v_cedula" title="ESTE CAMPO ES REQUERIDO"/>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label" for="fk_nivelestudio">Nivel de Estudios</label>
                                                        <div class="col-sm-6">
                                                            <select class="form-control :required" name="fk_nivelestudio" id="fk_nivelestudio">
                                                                <option value="">-- Seleccione --</option>
                                                                <?php
                                                                echo $fk_nivelestudio;
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                     <div class="form-group">
                                                        <label class="col-sm-3 control-label" for="numEmpleado">Número de Empleado</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control :apostrofe"  name="numEmpleado" id="numEmpleado" />
                                                        </div>
                                                    </div>
                                                    
                                                     <div class="form-group">
                                                        <label class="col-sm-3 control-label" for="cel">Celular</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control  :apostrofe"  name="cel" id="cel" />
                                                        </div>
                                                    </div>
                                                    
                                                     <div class="form-group">
                                                        <label class="col-sm-3 control-label" for="nss">NSS</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control  :apostrofe"  name="nss" id="nss" />
                                                        </div>
                                                    </div>
                                                    
                                                     <div class="form-group">
                                                        <label class="col-sm-3 control-label" for="direccion">Dirección</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control  :apostrofe"  name="direccion" id="direccion" />
                                                        </div>
                                                    </div>
                                                    
                                                     <div class="form-group">
                                                        <label class="col-sm-3 control-label" for="curp">CURP</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control  :apostrofe"  name="curp" id="curp" />
                                                        </div>
                                                    </div>
                                                    
                                                     <div class="form-group">
                                                        <label class="col-sm-3 control-label" for="rfc">RFC</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control :apostrofe"  name="rfc" id="rfc" />
                                                        </div>
                                                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="pk_carreras">Carreras</label>
                        <div class="col-sm-6">
                            <select class="form-control :required" name="pk_carreras" id="pk_carreras">
                                <option value="">-- Seleccione --</option>

                            </select>
                        </div>
                    </div>



                    <div class="form-group" style="display: none;">
                        <label class="col-sm-3 control-label" for="pk_carreras_anterior">Carreras</label>
                        <div class="col-sm-6">
                            <select class="form-control :required" name="pk_carreras_anterior" id="pk_carreras_anterior">
                                <option value="">-- Seleccione --</option>

                            </select>
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



                    </div>





                </div>
            </div>









        </div> <!-- container -->
    </div> <!--wrap -->
</div> <!-- page-content -->



</div>

<link rel='stylesheet' type='text/css' href='assets/plugins/codeprettifier/prettify.css' /> 
<link rel='stylesheet' type='text/css' href='assets/plugins/form-toggle/toggles.css' /> 

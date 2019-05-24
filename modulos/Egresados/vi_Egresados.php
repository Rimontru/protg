<?php
#AGREGADO: Ivan Mauricio Melo Granados
#FECHA: 29/05/2014 
$Genero = "";
$result = $ConsultaDB->ConsultaGenero();
while ($row = mysql_fetch_assoc($result)) {
    $Genero .= "<option value='$row[pk_genero]'>$row[descripcion]</option>";
}
mysql_free_result($result);


$Estados = "";
$result = $ConsultaDB->ConEstados();
while ($row = mysql_fetch_assoc($result)) {
    $Estados .= "<option value='$row[pk_estado]'>$row[descripcion]</option>";
}
mysql_free_result($result);



$Turnos = "";
$result = $ConsultaDB->ConTurnos();
while ($row = mysql_fetch_assoc($result)) {
    $Turnos .= "<option value='$row[pk_turnos]'>$row[descripcion]</option>";
}
mysql_free_result($result);


$Generacion = "";
$result = $ConsultaDB->ConsultaGeneraciones();
while ($row = mysql_fetch_assoc($result)) {
    $Generacion .= "<option value='$row[pk_generacion]'>$row[GeneracionDescripcion]</option>";
}
mysql_free_result($result);



$PlanEstudios = "";
$result = $ConsultaDB->ConAnios();
while ($row = mysql_fetch_assoc($result)) {
    $PlanEstudios .= "<option value='$row[pk_anios]'>$row[descripcion]</option>";
}
mysql_free_result($result);



$EstadoTitulacion = "";
$result = $ConsultaDB->ConEstadoTitulacion();
while ($row = mysql_fetch_assoc($result)) {
    $EstadoTitulacion .= "<option value='$row[pk_estadoTitulacion]'>$row[descripcion]</option>";
}
mysql_free_result($result);



$Modalidad = "";
$result = $ConsultaDB->obtenerModalidad();
while ($row = mysql_fetch_assoc($result)) {
    $Modalidad .= "<option value='$row[pk_modalidad]'>$row[nombreMod]</option>";
}
mysql_free_result($result);



$NivelEstudios = "";
$result = $ConsultaDB->obtenerNivelestudio();
while ($row = mysql_fetch_assoc($result)) {
    $NivelEstudios .= "<option value='$row[pk_nivelestudio]'>$row[descripcion]</option>";
}
mysql_free_result($result);


$fk_titulacion = "";
$result = $ConsultaDB->ConOpciontitulacion();
while ($row = mysql_fetch_assoc($result)) {
    $fk_titulacion .= "<option value='$row[pk_titulacion]'>$row[Nombre]</option>";
}
mysql_free_result($result);

$fk_titulacion = "";
$result = $ConsultaDB->ConOpciontitulacion();
while ($row = mysql_fetch_assoc($result)) {
    $fk_titulacion .= "<option value='$row[pk_titulacion]'>$row[Nombre]</option>";
}
mysql_free_result($result);


$fk_ingresoactual = "";
$result = $ConsultaDB->Coningresoactual();
while ($row = mysql_fetch_assoc($result)) {
    $fk_ingresoactual .= "<option value='$row[pk_ingresoactual]'>$row[descripcion_ingresoactual]</option>";
}
mysql_free_result($result);

$fk_gradosatisfaccion = "";
$result = $ConsultaDB->ConGradoSatisfaccion();
while ($row = mysql_fetch_assoc($result)) {
    $fk_gradosatisfaccion .= "<option value='$row[pk_gradosatisfaccion]'>$row[descripcion_gradosatisfaccion]</option>";
}
mysql_free_result($result);

$empleoencontrar = "";
$result = $ConsultaDB->Contiempoencuentrotrabajo();
while ($row = mysql_fetch_assoc($result)) {
    $empleoencontrar .= "<option value='$row[pk_tiempo]'>$row[descripcion_tiempo]</option>";
}
mysql_free_result($result);

$aspectodebilidad = "";
$result = $ConsultaDB->ConAspectoDebilidad();
while ($row = mysql_fetch_assoc($result)) {
    $aspectodebilidad .= "<option value='$row[pk_aspectodebilidad]'>$row[descripcion_aspectodebilidad]</option>";
}
mysql_free_result($result);

$estadoCivil = "";
$result = $ConsultaDB->ConEstadoCivil();
while($row = mysql_fetch_assoc($result)){
    $estadoCivil .= "<option value='$row[Pk_estadocivil]'>$row[descripcion_estadocivil]</option>"; 
}
?>
<!--<script>
    $(function() {


        setInterval(CalculoTotal, 1000);
    });
    
    function CalculoTotal() {
       var matricula = $("#matricula_desc").val();
       $.ajax({
                url: pathEgresados +'ObtenerFotoPerfil.php',
                type: 'post',
                data: "FotoPerfil=FotoPerfil&matricula="+matricula,  
                success: function(data){      
                    $("#MostrarFoto").html('');  
                    $("#MostrarFoto").html(data);     
                     $("#MostrarFoto").show();
                     
                     $("#fotito").removeAttr("src").attr("src", "../profile-photos/"+matricula+"/"+matricula+".jpg");
                }
            }); //fin del ajax   
    }
</script>-->
<div id="page-content">
    <div id='wrap'>
        <div id="page-heading">
            <ol class="breadcrumb">
                <li><a href="<?php echo Config::PAG_ADMIN . "?content=home2"; ?>">Inicio</a></li>
                <li class="active">Egresados</li>
            </ol>

            <h1>Egresados</h1>
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
                    <h4><i class="icon-cloud"></i> Completar Datos</h4>
                    <div class="options">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#home1" data-toggle="tab"> Completar Datos</a>
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
                                                <form action="#" class="form-horizontal" id="frm_busqueda_egresados" name="frm_busqueda_egresados"/>   
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
                                                                                <label class="col-md-3 control-label" for="matricula_buscar">Apellidos/Matricula</label>
                                                                                <div class="col-sm-6">
                                                                                    <input type="text" class="form-control :apostrofe"  name="matricula_buscar" id="matricula_buscar" autofocus required/>
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
                                       
                                            
                                            
                                                 <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="panel panel-midnightblue">
                                                            <div class="panel-heading">
                                                                <h4>Foto de Perfil  </h4>                                              
                                                            </div>
                                                            <form action="#" class="form-horizontal" name="F_fotoperfil" id="F_fotoperfil" />
                                                            <div class="panel-body collapse in"> 
                                                                <div id="MostrarFoto" style="display: none;">
                                                                       
                                                                    </div>  
 <div id="filelist">Su navegador no tiene soporte para Flash, Silverlight o HTML5.</div>
 <br />

 <div id="container">
     <a id="pickfiles" href="javascript:;">[Seleccionar Foto]</a> 
     <a id="uploadfiles" href="javascript:;">[Subir]</a>
 </div>

 <br />
 <pre id="console"></pre> <br />
   <div id="mensaje-foto"></div>
 <script type="text/javascript">
// Custom example logic

var uploader = new plupload.Uploader({
	runtimes : 'html5,flash,silverlight,html4',
	browse_button : 'pickfiles', // you can pass in id...
	container: document.getElementById('container'), // ... or DOM Element itself
	url : 'upload.php',
	flash_swf_url : 'js/plupload-2.1.2/js/Moxie.swf',
	silverlight_xap_url : 'js/plupload-2.1.2/js/Moxie.xap',
	
	filters : {
		max_file_size : '10mb',
		mime_types: [
			{title : "Image files", extensions : "jpg"}
		]
	},

	init: {
		PostInit: function() {
			document.getElementById('filelist').innerHTML = '';

			document.getElementById('uploadfiles').onclick = function() {
				uploader.start();
				return false;
			};
		},

		FilesAdded: function(up, files) {
			plupload.each(files, function(file) {
				document.getElementById('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
			});
		},

		UploadProgress: function(up, file) {
			document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
		},

		Error: function(up, err) {
			document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
		}
	}
});

uploader.init();

</script>

                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div><!--End Row 1-->

                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                 <form action="#" class="form-horizontal" id="frm_datosAlumnoModificar" name="frm_datosAlumnoModificar"/>            
                                                                           
                       
                                <fieldset>

                                                    
                                                    
                                                    
                                        <div class="row">
                                                <div class="col-md-12">
                                                        <div class="panel panel-midnightblue">
                                                          <div class="panel-heading">
                                                                        <h4>Datos Generales</h4>
                                                                        <div class="options"></div>
                                                          </div>
                                                          <div class="panel-body">
                                                              
                                                               
                                                              
                                                                     <input type="hidden" class="form-control :apostrofe" name="pk_alumno" id="pk_alumno" />

                                                                    <input type="hidden" class="form-control :apostrofe" name="pk_egresados" id="pk_egresados" />

                                                                    
                                                                  
                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="matricula_desc">Matricula</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :required :apostrofe"  name="matricula" id="matricula" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                        </div>&bull;
                                                                    </div>
                                                               
                                                            
                                                              
                                                                      <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="nombre">Nombre</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :required :apostrofe"  name="nombre" id="nombre" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                        </div>&bull;
                                                                    </div>

                                                                       <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="apaterno">Apellido Paterno</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :required :apostrofe"  name="apaterno" id="apaterno" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                        </div>&bull;
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="amaterno">Apellido Materno</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :required :apostrofe"  name="amaterno" id="amaterno" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                                        </div>&bull;
                                                                    </div>
                                                            
                                                         



                                                                        <div class="form-group">
                                                                            <label class="col-sm-3 control-label">Estado</label>
                                                                            <div class="col-sm-6">
                                                                                <select style="width:100%" name="v_estado" id="v_estado"  class="populate :required form-control ">
                                                                                     <option value="">-- Seleccione --</option>
                                                                                    <?php
                                                                                    echo $Estados;
                                                                                    ?>
                                                                                </select>                 
                                                                            </div>&bull;
                                                                        </div>


                                                                       <div class="form-group">
                                                                            <label class="col-sm-3 control-label">Municipio</label>
                                                                            <div class="col-sm-6">
                                                                                <select name="v_Municipio" id="v_Municipio" style="width:100%" class="populate :required form-control">
                                                                                     <option value="">-- Seleccione --</option>

                                                                                </select>                
                                                                            </div>&bull;
                                                                        </div>




                                                                        <div class="form-group">
                                                                            <label class="col-sm-3 control-label">Colonia/Fraccionamiento</label>
                                                                            <div class="col-sm-6">
                                                                                <select name="v_coloniafracc" id="v_coloniafracc" style="width:100%" class="populate :required form-control">
                                                                                     <option value="">-- Seleccione --</option>

                                                                                </select>             
                                                                            </div>&bull; 
                                                                        </div>






                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="direccion">Dirección</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="direccion" id="direccion" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                    </div>



                                                                      <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="codigopostal">codigo postal</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="codigopostal" id="codigopostal" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                    </div>


                                                                     <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="curp">curp</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="curp" id="curp" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                          <label class="col-sm-3 control-label">Fecha de Nacimiento</label>
                                                                          <div class="col-sm-6">
                                                                              <input type="text" class="form-control :apostrofe"  name="FechaNacimiento" id="FechaNacimiento" />
                                                                          </div>
                                                                      </div>

                                                                     <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="correo">Correo</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe :email"  name="correo" id="correo" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="fk_genero">Genero</label>
                                                                        <div class="col-sm-6">
                                                                            <select class="form-control" name="fk_genero" id="fk_genero">
                                                                                <option value="">-- Seleccione --</option>
                                                                                <?php
                                                                                echo $Genero;
                                                                                ?>
                                                                            </select>
                                                                        </div>&bull;
                                                                    </div>

                                                                    
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="fk_estcivil">Estado Civil</label>
                                                                        <div class="col-sm-6">
                                                                            <select class="form-control" name="fk_estcivil" id="fk_estcivil">
                                                                                <option value="">-- Seleccione --</option>
                                                                                <?php
                                                                                echo $estadoCivil;
                                                                                ?>
                                                                            </select>
                                                                        </div>&bull;
                                                                    </div>


                                                                     <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="telefonofijo">Telefono Fijo</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="telefonofijo" id="telefonofijo" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                    </div>

                                                                      <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="telefonocelular">Telefono Celular</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="telefonocelular" id="telefonocelular" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                    </div>

                                                          </div>
                                                        </div>
                                                </div>
                                                <div class="col-md-12">
                                                        <div class="panel panel-magenta">
                                                          <div class="panel-heading">
                                                                        <h4>Datos Escolares</h4>
                                                                        <div class="options"></div>
                                                            </div>
                                                            <div class="panel-body">

																<h4><b>Antecedente Escolar</b></h4>
                                                                <hr>

                                                                <div class="form-group">
                                                                <label class="col-md-3 control-label" for="nivel_escolar">Nivel Escolar Anterior</label>
                                                                <div class="col-sm-6">
                                                                  <select class="form-control :apostrofe" name="nivel_escolar" id="nivel_escolar">
                                                                    <option value="0">SELECCIONAR</option>
                                                                    <option value="1">MAESTRIA</option>
                                                                    <option value="2">LICENCIATURA</option>
                                                                    <option value="3">TECNICO</option>
                                                                    <option value="4">BACHILLERATO</option>
                                                                    <option value="5">EQUIVALENTE A BACHILLERATO EDUCACIÓN MEDIA SUPERIOR</option>
                                                                    <option value="6">SECUNDARIA</option>
                                                                  </select>
                                                                </div>
                                                              </div>

                                                              <div class="form-group">
                                                                  <label class="col-md-3 control-label" for="institucionProcedencia">Nombre de la Institución</label>
                                                                  <div class="col-sm-6">
                                                                      <input type="text" class="form-control :apostrofe" name="institucionProcedencia" id="institucionProcedencia"  maxlength="255" />
                                                                  </div>
                                                              </div>

                                                              <div class="form-group">
                                                                <label class="col-md-2 col-md-offset-1 control-label" for="fechas">Fecha Inició</label>
                                                                <div class="col-md-2">
                                                                    <input type="text" class="form-control :apostrofe" name="f_inicio_antecedente" id="f_inicio_antecedente"  maxlength="7" placeholder="formato MM/AAAA" />
                                                                </div>
                                                                <label class="col-md-2 control-label" for="fechas">Fecha Teminó</label>
                                                                <div class="col-md-2">
                                                                    <input type="text" class="form-control :apostrofe" name="f_fin_antecedente" id="f_fin_antecedente"  maxlength="7" placeholder="formato MM/AAAA" />
                                                                </div>
                                                              </div>

                                                              <div class="form-group">
                                                                  <label class="col-md-3 control-label" for="noCedula">Cédula profesional (si tiene)</label>
                                                                  <div class="col-sm-6">
                                                                      <input type="text" class="form-control :apostrofe" name="noCedula" id="noCedula"  maxlength="255" />
                                                                  </div>
                                                              </div>

                                                               <div class="form-group">
                                                                <label class="col-md-3 control-label" for="entidad_federativa">Entidad Federativa donde Estudió</label>
                                                                <div class="col-sm-6">
                                                                  <select class="form-control :apostrofe" name="entidad_federativa" id="entidad_federativa">
                                                                    <option value="0">SELECCIONAR</option>
                                                                    <option value="1">AGUASCALIENTES</option>
                                                                    <option value="2">BAJA CALIFORNIA</option>
                                                                    <option value="3">BAJA CALIFORNIA SUR</option>
                                                                    <option value="4">CAMPECHE</option>
                                                                    <option value="5">COAHUILA DE ZARAGOZA</option>
                                                                    <option value="6">COLIMA</option>
                                                                    <option value="7">CHIAPAS</option>
                                                                    <option value="8">CHIHUAHUA</option>
                                                                    <option value="9">CIUDAD DE MÉXICO</option>
                                                                    <option value="10">DURANGO</option>
                                                                    <option value="11">GUANAJUATO</option>
                                                                    <option value="12">GUERRERO</option>
                                                                    <option value="13">HIDALGO</option>
                                                                    <option value="14">JALISCO</option>
                                                                    <option value="15">MÉXICO</option>
                                                                    <option value="16">MICHOACÁN DE OCAMPO</option>
                                                                    <option value="17">MORELOS</option>
                                                                    <option value="18">NAYARIT</option>
                                                                    <option value="19">NUEVO LEÓN</option>
                                                                    <option value="20">OAXACA</option>
                                                                    <option value="21">PUEBLA</option>
                                                                    <option value="22">QUERÃ‰TARO</option>
                                                                    <option value="23">QUINTANA ROO</option>
                                                                    <option value="24">SAN LUIS POTOSÍ</option>
                                                                    <option value="25">SINALOA</option>
                                                                    <option value="26">SONORA</option>
                                                                    <option value="27">TABASCO</option>
                                                                    <option value="28">TAMAULIPAS</option>
                                                                    <option value="29">TLAXCALA</option>
                                                                    <option value="30">VERACRUZ DE IGNACIO DE LA LLAVE</option>
                                                                    <option value="31">YUCATÁN</option>
                                                                    <option value="32">ZACATECAS</option>
                                                                  </select>
                                                                </div>
                                                              </div>

																<hr>
																                                                                     <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="fk_nivelestudio_disabled">Nivel de Estudios</label>
                                                                        <div class="col-sm-6">
                                                                            <select class="form-control" disabled="" name="fk_nivelestudio_disabled" id="fk_nivelestudio_disabled">
                                                                                <option value="">-- Seleccione --</option>
                                                                                <?php
                                                                                echo $NivelEstudios;
                                                                                ?>
                                                                            </select>
                                                                        </div>&bull;
                                                                    </div>
                                                                
                                                                
                                                                  <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="fk_modalidad_disabled">Modalidad</label>
                                                                        <div class="col-sm-6">
                                                                            <select class="form-control :required" disabled="" name="fk_modalidad_disabled" id="fk_modalidad_disabled">
                                                                                <option value="">-- Seleccione --</option>
                                                                                <?php
                                                                                echo $Modalidad;
                                                                                ?>
                                                                            </select>
                                                                        </div>&bull;
                                                                    </div>
                                                                
                                                                
                                                                
                                                                    
                                                                   
                                                                
                                                                <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="fk_carreras_disabled">Carrera</label>
                                                                        <div class="col-sm-6">
                                                                            <select class="form-control :required" disabled="" name="fk_carreras_disabled" id="fk_carreras_disabled" >
                                                                                <option value="">-- Seleccione --</option>
                                                                              
                                                                            </select>
                                                                        </div>&bull;
                                                                    </div>
                                                                
                                                                
                                                                
                                                                
                                                                      <div class="form-group" style="display: none;">
                                                                        <label class="col-sm-3 control-label" for="fk_nivelestudio">Nivel de Estudios</label>
                                                                        <div class="col-sm-6">
                                                                            <select class="form-control :required" name="fk_nivelestudio" id="fk_nivelestudio">
                                                                                <option value="">-- Seleccione --</option>
                                                                                <?php
                                                                                echo $NivelEstudios;
                                                                                ?>
                                                                            </select>
                                                                        </div>&bull;
                                                                    </div>
                                                                
                                                                
                                                                 <div class="form-group" style="display: none;">
                                                                        <label class="col-sm-3 control-label" for="fk_modalidad">Modalidad</label>
                                                                        <div class="col-sm-6">
                                                                            <select class="form-control :required" name="fk_modalidad" id="fk_modalidad">
                                                                                <option value="">-- Seleccione --</option>
                                                                                <?php
                                                                                echo $Modalidad;
                                                                                ?>
                                                                            </select>
                                                                        </div>&bull;
                                                                    </div>
                                                                
                                                                
                                                                
                                                                    
                                                                  <div class="form-group" style="display: none;">
                                                                        <label class="col-sm-3 control-label" for="fk_carreras">Carrera</label>
                                                                        <div class="col-sm-6">
                                                                            <select class="form-control :required" name="fk_carreras" id="fk_carreras" >
                                                                                <option value="">-- Seleccione --</option>
                                                                              
                                                                            </select>
                                                                        </div>&bull;
                                                                    </div>
                                                                
                                                                
                                                                <div class="form-group">
																<label class="col-md-2 col-md-offset-1 control-label" for="fechas">Fecha Inició</label>
																<div class="col-md-2">
																    <input type="text" class="form-control :apostrofe" name="f_inicio_car" id="f_inicio_car" maxlength="7" autofocus placeholder="formato requerido MM/AAAA" />
																</div>
																<label class="col-md-2 control-label" for="fechas">Fecha Terminó</label>
																<div class="col-md-2">
																    <input type="text" class="form-control :apostrofe" name="f_fin_car" id="f_fin_car" maxlength="7" autofocus placeholder="formato requerido MM/AAAA" />
																</div>
															</div>

                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="fk_turnos">Turno</label>
                                                                        <div class="col-sm-6">
                                                                            <select class="form-control :required" name="fk_turnos" id="fk_turnos">
                                                                                <option value="">-- Seleccione --</option>
                                                                                <?php
                                                                                echo $Turnos;
                                                                                ?>
                                                                            </select>
                                                                        </div>&bull;
                                                                    </div>



                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="planEstudios">Plan de Estudios</label>
                                                                        <div class="col-sm-6">
                                                                            <select class="form-control" name="planEstudios" id="planEstudios">
                                                                                <option value="">-- Seleccione --</option>
                                                                                <?php
                                                                                echo $PlanEstudios;
                                                                                ?>
                                                                            </select>
                                                                        </div>&bull;
                                                                    </div>




                                                                     <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="fk_generacion">Generacion</label>
                                                                        <div class="col-sm-6">
                                                                            <select class="form-control" name="fk_generacion" id="fk_generacion">
                                                                                <option value="">-- Seleccione --</option>
                                                                                <?php
                                                                                echo $Generacion;
                                                                                ?>
                                                                            </select>
                                                                        </div>&bull;
                                                                    </div>

                                                                     <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="generacionNumero">Generacion Numero</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="generacionNumero" id="generacionNumero" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="promedio">Promedio</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="promedio" id="promedio" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="letraPromedio">Letra Promedio</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="letraPromedio" id="letraPromedio" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                    </div>

								    <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="edadEgreso">Edad de Egresado</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="edadEgreso" id="edadEgreso" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                            <label class="col-sm-3 control-label" for="Discapacidad">Discapacidad</label>
                                                                            <div class="col-sm-6">
                                                                                <select class="form-control " name="Discapacidad" id="Discapacidad">
                                                                                    <option value="">-- Seleccione --</option>
                                                                                    <option value="1">Si</option>
                                                                                    <option value="2">No</option>
                                                                                </select>
                                                                            </div>&bull;
                                                                        </div>
                                                                <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="DiscapacidadCual">Descripcion de Discapacidad</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="DiscapacidadCual" id="DiscapacidadCual" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="DiscapacidadCual">¿Derecho a titulacion por promedio?</label>
                                                                        <div class="col-sm-6">
                                                                            <select class="form-control " name="derechoPromedio" id="derechoPromedio">
                                                                                    <option value="">-- Seleccione --</option>
                                                                                    <option value="1">Si</option>
                                                                                    <option value="2">No</option>
                                                                                    <option value="3">Renuncia</option>
                                                                                    <option value="4">Irregular</option>
                                                                                    <option value="5">No aplica</option>
                                                                                </select>
                                                                        </div>
                                                                    </div>


                                                                     <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="letraPromedio">Cédula Profesional</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="noCedulaProf" id="noCedulaProf" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                    </div>
		

                                                          </div>
                                                            
                                                           
                                                        </div>
                                               </div>
                                            
                                             <div class="col-md-12">
                                                        <div class="panel panel-sky">
                                                          <div class="panel-heading">
                                                                        <h4>Departamento de Egresados</h4>
                                                                        <div class="options"></div>
                                                            </div>
                                                         
                                                            
                                                            <div class="panel-body">
                                                                
                                                                    <div class="alert alert-dismissable alert-info">
                                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                                    <p>Desarrollo Academico.</p>
                                                                    <br />
                                                                    </div>	

                                                            
                                                                   
                                                                
                                                                
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="mtriaNombre">Maestria</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="mtriaNombre" id="mtriaNombre" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="mtriaInstitucion">Institución Maestria</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="mtriaInstitucion" id="mtriaInstitucion" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    
                                                                     <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="doctoradoNombre">Doctorado</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="doctoradoNombre" id="doctoradoNombre" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                     </div>
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="doctoradoInstitucion">Institución Doctorado</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="doctoradoInstitucion" id="doctoradoInstitucion" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    
                                                                     <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="especialidadNombre">Especialidad</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="especialidadNombre" id="especialidadNombre" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                     </div>
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="especialidadInstitucion">Institución Especialidad</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="especialidadInstitucion" id="especialidadInstitucion" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                    </div>

                                                                    
                                                                       
                                                                
                                                                
                                                                
                                                                <div class="alert alert-dismissable alert-info">
                                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                                    <p>Desarrollo Laboral.</p>
                                                                    <br />

                                                                </div>	


                                                                
                                                                        <div class="form-group">
                                                                            <label class="col-sm-3 control-label" for="estatusTrabajo">Trabaja Actualmente</label>
                                                                            <div class="col-sm-6">
                                                                                <select class="form-control " name="estatusTrabajo" id="estatusTrabajo">
                                                                                    <option value="">-- Seleccione --</option>
                                                                                    <option value="1">Si</option>
                                                                                    <option value="2">No</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>



                                                                     <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="correoTrabajo">Correo del Trabajo</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control  :apostrofe :email"  name="correoTrabajo" id="correoTrabajo" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                    </div>



                                                                 <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="nombreEmpresaTrabajo">Nombre de la Empresa donde Trabaja</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="nombreEmpresaTrabajo" id="nombreEmpresaTrabajo" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                    </div>
                                                                
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="nombreJefeInmediato">Nombre Jefe Inmediato</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="nombreJefeInmediato" id="nombreJefeInmediato" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                    </div>
                                                                
                                                                 <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="puestoTrabajo">Puesto que ocupa en el Trabajo</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="puestoTrabajo" id="puestoTrabajo" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                    </div>
                                                                
                                                                 <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="direccionTrabajo">Dirección del Trabajo</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="direccionTrabajo" id="direccionTrabajo" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                    </div>
                                                                
                                                                 <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="telefonoTrabajo">Teléfono del Trabajo</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="telefonoTrabajo" id="telefonoTrabajo" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                    </div>
                                                                
                                                                
                                                                    <div class="form-group">
                                                                         <label class="col-sm-3 control-label">Que hacer para Mejorar</label>
                                                                        <div class="col-sm-6">
                                                                        <textarea class="form-control" id="quehacermejora" name="quehacermejora"></textarea>
                                                                        </div>
                                                                </div>

                                                                

                                                                
                                                                
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label" for="fk_ingresoactual">Ingreso Actual</label>
                                                                    <div class="col-sm-6">
                                                                        <select class="form-control " name="fk_ingresoactual" id="fk_ingresoactual">
                                                                            <option value="">-- Seleccione --</option>
                                                                            <?php
                                                                                 echo $fk_ingresoactual;
                                                                             ?>
                                                                        </select>
                                                                    </div>&bull;
                                                                </div>
                                                                    
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="empleoencontrar">Cuanto tiempo tardo en encontrar empleo</label>
                                                                        <div class="col-sm-6">
                                                                        <select class="form-control " name="empleoencontrar" id="empleoencontrar">
                                                                            <option value="">-- Seleccione --</option>
                                                                            <?php
                                                                                 echo $empleoencontrar;
                                                                             ?>
                                                                        </select>
                                                                    </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="plandeestudioscalificacion">¿Que le parecio el plan y programa de estudio de su licenciatura?</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="plandeestudioscalificacion" id="plandeestudioscalificacion" title="ESTE CAMPO ES REQUERIDO"/>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label">Grado de Satisfacción (del 1 al 10) que te deja la formación recibida por la Escuela.</label>
                                                                        <div class="col-sm-6">
                                                                            <select class="form-control :required" name="fk_gradosatisfaccion" id="fk_gradosatisfaccion">
                                                                                 <option value="0">-- Seleccione --</option>
                                                                                 <?php
                                                                                    echo $fk_gradosatisfaccion;
                                                                                 ?>
                                                                            </select>
                                                                        </div>&bull;
                                                                    </div>
                                                                                                          															<div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="aspectodebilidad">En qué aspecto detecta debilidad:</label>
                                                                        <div class="col-sm-6">
                                                                        <select class="form-control " name="aspectodebilidad" id="aspectodebilidad">
                                                                            <option value="">-- Seleccione --</option>
                                                                            <?php
                                                                                 echo $aspectodebilidad;
                                                                             ?>
                                                                        </select>
                                                                    </div>
                                                                    </div>
                                                                    


                                                                
                                                                <div class="form-group">
                                                                         <label class="col-sm-3 control-label">¿Tiene alguna sugerencia para enriquecer al programa educativo, su formación profesional y su desempeño laboral actual?</label>
                                                                        <div class="col-sm-6">
                                                                        <textarea class="form-control" id="sugerencias" name="sugerencias"></textarea>
                                                                        </div>
                                                                </div>

                                                                <div class="form-group">
                                                                         <label class="col-sm-3 control-label">¿Si tuvieras que cursar nuevamente tus estudios, eligirías la misma institución?</label>
                                                                        <div class="col-sm-6">
                                                                        <select class="form-control " name="nuevaUno" id="nuevaUno">
                                                                                <option value="">-- Seleccione --</option>
                                                                                <option value="1">Si</option>
                                                                                <option value="2">No</option>
                                                                            </select>
                                                                        <textarea  maxlength="500" class="form-control" id="porqueUno" name="porqueUno">Por qué, </textarea>
                                                                        </div>
                                                                </div>


                                                                <div class="form-group">
                                                                         <label class="col-sm-3 control-label">¿Estudiarías una Maestría en la misma institución?</label>
                                                                        <div class="col-sm-6">
                                                                        <select class="form-control " name="nuevaDos" id="nuevaDos">
                                                                                <option value="">-- Seleccione --</option>
                                                                                <option value="1">Si</option>
                                                                                <option value="2">No</option>
                                                                            </select>
                                                                        <textarea maxlength="500" class="form-control" id="porqueDos" name="porqueDos">Por qué, </textarea>
                                                                        </div>
                                                                </div>
                                                                
                                                                
                                                                 <div class="alert alert-dismissable alert-info">
                                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                                    <p>Otros Datos.</p>
                                                                    <br />

                                                                </div>	
                                                                
                                                                   <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="noActaExamen">No Acta: </label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="noActaExamen" id="noActaExamen"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label">No Folio Acta: </label>
                                                                        <div class="col-sm-2">
                                                                            <input type="text" class="form-control :apostrofe "  name="FolioActa" id="FolioActa" />
                                                                        </div>
                                                                        <label class="col-sm-2 control-label">No Folio de Timbre de Holograma de Acta: </label>
                                                                        <div class="col-sm-2">
                                                                            <input type="text" class="form-control :apostrofe "  name="folioTimbreActa" id="folioTimbreActa" />
                                                                        </div>
                                                                    </div>
                                                                
                                                                 <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="FechaTomaProtesta">Fecha de Toma de Protesta</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="FechaTomaProtesta" id="FechaTomaProtesta"/>
                                                                        </div>
                                                                    </div>
                                                                
                                                                
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label" for="fk_titulacion">Opción de Titulación</label>
                                                                    <div class="col-sm-6">
                                                                        <select class="form-control :required" name="fk_titulacion" id="fk_titulacion">
                                                                            <option value="">-- Seleccione --</option>
                                                                            <?php
                                                                            echo $fk_titulacion;
                                                                            ?>
                                                                        </select>
                                                                    </div>&bull;
                                                                </div>            
                                                                
                                                                <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="TipoAcreditacion">Tipo de Acreditación</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control :apostrofe"  name="TipoAcreditacion" id="TipoAcreditacion"/>
                                                                        </div>
                                                                    </div>
                                                                
                                                                   <div class="form-group">
                                                                        <label class="col-sm-3 control-label" for="noactatitulo">No. Folio Titulo</label>
                                                                        <div class="col-sm-2">
                                                                            <input type="text" class="form-control :apostrofe"  name="noactatitulo" id="noactatitulo"/>
                                                                        </div>
                                                                        <label class="col-sm-2 control-label" for="noactatitulo">No. Folio de Timbre de Holograma Titulo</label>
                                                                        <div class="col-sm-2">
                                                                            <input type="text" class="form-control :apostrofe"  name="folioTimbreTitulo" id="folioTimbreTitulo"/>
                                                                        </div>
                                                                    </div>
                                                                
                                                                 
                                                                     <div class="form-group">
                                                                          <label class="col-sm-3 control-label">Fecha de Expedición de Titulo</label>
                                                                          <div class="col-sm-6">
                                                                              <input type="text" class="form-control :required :apostrofe"  name="fechaexpediciontitulo" id="fechaexpediciontitulo" />
                                                                          </div>&bull;
                                                                      </div>
                                                                
                                                                    <div class="form-group">
                                                                            <label class="col-sm-3 control-label" for="fk_estadoTitulacion">Titulación</label>
                                                                            <div class="col-sm-5">
                                                                                <select class="form-control " name="fk_estadoTitulacion" id="fk_estadoTitulacion">
                                                                                    <option value="">-- Seleccione --</option>
                                                                                    <?php
                                                                                    echo $EstadoTitulacion;
                                                                                    ?>
                                                                                </select>
                                                                            </div>&bull;
                                                                        </div>
                                                                
                                                                
                                                                       <div class="form-group">
                                                                            <label class="col-sm-3 control-label" for="estatusCredencial">Entrego Credencial</label>
                                                                            <div class="col-sm-6">
                                                                                <select class="form-control" name="estatusCredencial" id="estatusCredencial">
                                                                                    <option value="">-- Seleccione --</option>
                                                                                    <option value="1">Si</option>
                                                                                    <option value="2">No</option>
                                                                                </select>
                                                                            </div>&bull;
                                                                        </div>

									                                   <div class="form-group">
                                                                            <label class="col-sm-3 control-label">Fecha de Entrega Credencial</label>
                                                                            <div class="col-sm-6">
                                                                            	<input type="text" class="form-control :required :apostrofe"  name="fechaEntregaCredencial" id="fechaEntregaCredencial" />
                                                                            </div>&bull;
                                                                        </div>

                                                                NOTA: <small>Todos los campos seleccionados "&bull;" son obligatorios.</small>
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

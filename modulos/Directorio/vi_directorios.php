<?php

require_once 'includes/Config.class.php';
require_once 'includes/DB.class.php';
require_once 'includes/ConsultaDB.class.php';
require_once 'includes/MisFunciones.class.php';

$db = new database();
$consulta = new ConsultaDB();
$fun = new MisFunciones();


$sql = "SELECT * FROM cat_directorio_preparatorias ORDER BY nomb_prepa ASC";
$result = @mysql_query($sql);
?>
     
<div id="page-content">
	<div id='wrap'>

		<div id="page-heading">
			<ol class="breadcrumb">
				<li><a href="<?php echo Config::PAG_ADMIN . "?content=home2"; ?>">Inicio</a></li>
				<li>Directorio</li>
				<li class="active">Directorios</li>
			</ol>

			<h1>Directorio</h1>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-md-12">

					<div class="panel">

						<div class="panel-heading">
							<h4><i class="icon-cloud"></i> Datos de las Preparatorias </h4>
							<div class="options">
								<ul class="nav nav-tabs">
									<li class="active">
										<a href="#home1" data-toggle="tab">Preparatorias</a>
									</li>
								</ul>
							</div>
						</div>

						<div class="panel-body">
							<div class="tab-content">
								<div class="tab-pane active" id="home1">
									<div class="panel panel-sky">
<!--###### tabla de directorios #######-->
									<div class="panel-heading"></div>
									<div class="panel-body collapse in">
									  <table class="table table-striped table-bordered datatables" id="example">
										  <thead>
										    <tr>
										      <th><center>Preparatoria</center></th>
										      <th><center>Plantel</center></th>
										      <th><center>Ciudad</center></th>
										      <th><center>Email</center></th>
										      <th><center>Telefono(s)</center></th>
										      <th><center>Personal</center></th>
										      <th><center>Acción</center></th>
										    </tr>
										  </thead>
										  <tbody>
										  	<?php 
										  	while ( $row = mysql_fetch_assoc($result) ) {
										  	    echo '
										  	    <tr>
												      <td><center>'.ucwords($row['nomb_prepa']).'</center></td>
												      <td><center>'.ucwords($row['plantel']).'</center></td>
												      <td><center>'.ucwords($row['ciudad']).'</center></td>
												      <td><center>'.$row['email'].'</center></td>
												      <td><center>'.$row['telefonos'].'</center></td>
												      <td><center>'.ucwords($row['persona_atiende']).'</center></td>
															<td><center>
											          <a data-toggle="modal" href="#EditaPrepa" class="btn btn-info" onClick="showEdit('.$row['pk_prepa'].')">
											          	<i class="icon-edit"></i>
											          </a></center>
												      </td>
											  		</tr>
										  	    ';
										  	} 
										  	?>
										  </tbody>
									  </table>
									  <a data-toggle="modal" href="#AltaPrepa" class="btn btn-success">
											<i class="icon-plus"></i> <b>Nuevo Registro</b>
										</a>
									</div>
<!--###### tabla de directorios #######-->
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


<!--ALTA-->
<div class="modal fade" role="dialog" id="AltaPrepa">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Guardar| Registro de Preparatoria </h4>
			</div>

			<div class="modal-body">
				<form action="#" class="form-horizontal" id="form_nueva_preparatoria" />   
				<fieldset>

					<div class="form-group">
						<label class="col-md-3 control-label">Nombre</label>
						<div class="col-sm-6">
							<input class="form-control :required :apostrofe" name="nomb_prepa" id="nomb_prepa" autofocus maxlength="255" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">Plantel</label>
						<div class="col-sm-6">
							<input class="form-control :required :apostrofe" name="plantel" id="plantel" autofocus maxlength="255"/>
						</div>
					</div>

					<div class="form-group">
            <label class="col-sm-3 control-label">Turno</label>
            <div class="col-sm-6">
              <select class="form-control :required :apostrofe" name="turno" id="turno">
                <option value="0"> -- Seleccionar -- </option>
                <option value="Matutino">Matutino</option>
                <option value="Vespertino">Vespertino</option>
                <option value="Mixto">Mixto</option>
              </select>
            </div>
          </div>


					<div class="form-group">
						<label class="col-md-3 control-label">Ciudad</label>
						<div class="col-sm-6">
							<input class="form-control :required :apostrofe" name="ciudad" id="ciudad" autofocus maxlength="255"/>
						</div>
					</div>


					<div class="form-group">
						<label class="col-md-3 control-label">Dirección</label>
						<div class="col-sm-6">
							<input class="form-control :required :apostrofe" name="direccion" id="direccion" autofocus maxlength="255"/>
						</div>
					</div>


					<div class="form-group">
						<label class="col-md-3 control-label">Email</label>
						<div class="col-sm-6">
							<input type="text" class="form-control :required :apostrofe" name="email" id="email" autofocus maxlength="255"/>
						</div>
					</div>


					<div class="form-group">
						<label class="col-md-3 control-label">Teléfonos</label>
						<div class="col-sm-6">
							<input class="form-control :required :apostrofe" name="telefonos" id="telefonos" autofocus maxlength="50"/>
						</div>
					</div>


					<div class="form-group">
						<label class="col-md-3 control-label">Persona que atiende</label>
						<div class="col-sm-6">
							<input class="form-control :required :apostrofe" name="persona_atiende" id="persona_atiende" autofocus maxlength="255"/>
						</div>
					</div>


					<div class="form-group">
						<label class="col-md-3 control-label">Cargo de la persona</label>
						<div class="col-sm-6">
							<input class="form-control :required :apostrofe" name="cargo_persona" id="cargo_persona" autofocus maxlength="50"/>
						</div>
					</div>


					<div class="form-group">
						<div class="btn-toolbar">
							<button type="submit" class="btn btn-primary" id="save">Guardar 
								<small style="display: none;">| Procesando, espere por favor... 
								<img src='assets/img/ajax-loaders/ajax-loader-1.gif'>
								</small>
							</button>					
						</div>
					</div>
				</fieldset>    
				</form>
			</div>

		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!--EDITAR-->
<div class="modal fade" role="dialog" id="EditaPrepa">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Editar| Registro de Preparatoria </h4>
			</div>

			<div class="modal-body">
				<form action="#" class="form-horizontal" id="form_editar_preparatoria" />   
				<fieldset>

					<div class="form-group">
						<label class="col-md-3 control-label">Nombre</label>
						<div class="col-sm-6">
							<input class="form-control :required :apostrofe" name="nomb_prepa" id="nomb_prepa" autofocus maxlength="255" />
							<input type="hidden" name="pk_prepa" id="pk_prepa">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">Plantel</label>
						<div class="col-sm-6">
							<input class="form-control :required :apostrofe" name="plantel" id="plantel" autofocus maxlength="255"/>
						</div>
					</div>

					<div class="form-group">
            <label class="col-sm-3 control-label">Turno</label>
            <div class="col-sm-6">
              <select class="form-control :required :apostrofe" name="turno" id="turno">
                <option value="0"> -- Seleccionar -- </option>
                <option value="Matutino">Matutino</option>
                <option value="Vespertino">Vespertino</option>
                <option value="Mixto">Mixto</option>
              </select>
            </div>
          </div>


					<div class="form-group">
						<label class="col-md-3 control-label">Ciudad</label>
						<div class="col-sm-6">
							<input class="form-control :required :apostrofe" name="ciudad" id="ciudad" autofocus maxlength="255"/>
						</div>
					</div>


					<div class="form-group">
						<label class="col-md-3 control-label">Dirección</label>
						<div class="col-sm-6">
							<input class="form-control :required :apostrofe" name="direccion" id="direccion" autofocus maxlength="255"/>
						</div>
					</div>


					<div class="form-group">
						<label class="col-md-3 control-label">Email</label>
						<div class="col-sm-6">
							<input type="text" class="form-control :required :apostrofe" name="email" id="email" autofocus maxlength="255"/>
						</div>
					</div>


					<div class="form-group">
						<label class="col-md-3 control-label">Teléfonos</label>
						<div class="col-sm-6">
							<input class="form-control :required :apostrofe" name="telefonos" id="telefonos" autofocus maxlength="50"/>
						</div>
					</div>


					<div class="form-group">
						<label class="col-md-3 control-label">Persona que atiende</label>
						<div class="col-sm-6">
							<input class="form-control :required :apostrofe" name="persona_atiende" id="persona_atiende" autofocus maxlength="255"/>
						</div>
					</div>


					<div class="form-group">
						<label class="col-md-3 control-label">Cargo de la persona</label>
						<div class="col-sm-6">
							<input class="form-control :required :apostrofe" name="cargo_persona" id="cargo_persona" autofocus maxlength="50"/>
						</div>
					</div>


					<div class="form-group">
						<div class="btn-toolbar">
							<button type="submit" class="btn btn-primary" id="save">Guardar 
								<small style="display: none;">| Procesando, espere por favor... 
								<img src='assets/img/ajax-loaders/ajax-loader-1.gif'>
								</small>
							</button>	
						</div>
					</div>
				</fieldset>    
				</form>
			</div>

		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

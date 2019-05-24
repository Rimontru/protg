<?php
include(PATH.sourcesPHP::_paramsDB);
include(PATH.sourcesPHP::_conexDB);

$objConex = new classConexionDB();
$openConx = $objConex::conexionDB();

$sql = "SELECT * FROM cat_preguntas WHERE activo = 1";
$result = @mysql_query( $sql, $openConx );

$sql = "SELECT * FROM cat_personal WHERE edo = 1 ORDER BY nombres ASC";
$resultSet = @mysql_query( $sql, $openConx );
?>
<div class="container-fluid">

	<!-- <div class="row back"><div class="col-12 col-md-12">&nbsp;</div></div>
	<div class="row back">
	   <div class="hidden-sm-down col-md-2"><center>
			<img src="<?php echo PATH ?>app/images/salazar/logo_uni.jpg" alt="..." class="rounded"></center>
	   </div>
	   <div class="col-12 col-md-8"><center>
			<img src="<?php echo PATH ?>app/images/salazar/letras_uni.png" alt="..." class="rounded" width="700"></center>
	   </div>
	   <div class="col-md-2 col-lg-2 hidden-md-down"><center>
	    	<img src="<?php echo PATH ?>app/images/salazar/cabeza_maya.png" alt="..." class="rounded">
	    	</center>
	  	</div>
	</div> -->

	<div class="row"><div class="col-12 col-md-12">&nbsp;</div></div>
	<div class="row">
		<div class="col-12 col-md-12 text-center">
			<h2 class="sub">INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS EN TUXTLA GUTIERREZ, S.C.</h2>
			<h2 class="sub">Dirección de Servicios escolares</h2>
			<h3 class="sub">Servicio al cliente</h3>
			<h5><p class="text-muted">Por favor, dedique unos minutos de su tiempo para rellenar el siguiente cuestionario!</p></h5>
         <hr>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<select class="form-control form-control-lg text-danger" id="fk_persona" name="fk_persona" style="font-size: 20px; border: 1px solid #c9302c;">
				<option value="1">Por favor seleccione, el nombre del personal que le atendió en la ventanilla de servicio</option>
				<?php
				while ( $row = @mysql_fetch_array($resultSet) ) {
		    	echo '<option value="'.$row['pk_persona'].'">'.ucwords($row['nombres']).'</option>';
		    }
				?>
			</select>
		</div>
		<div class="col-md-12"><hr>	</div>
		<?php
			while ( $row = @mysql_fetch_array($result) ) {
	    	echo '<div class="col-12"><legend>'.$row['pk_pregunta'].'.-'.utf8_encode($row['desc_pregunta']).'</legend></div>'
		?>
		<div class="table-responsive">
		<table class="col-12 col-md-12 text-center">
			<div class="btn-group btn-group-toggle" data-toggle="buttons">
				<tr>
					<td>
					  <label>
						  	<input type="radio" name="question<?php echo $row['pk_pregunta']?>" id="option<?php echo $row['pk_pregunta']?>" value="1" autocomplete="off"><br />
					    	<i class="em em-relaxed img-responsive"></i><br />
					     	EXCELENTE
					  </label>
					</td>
					<td>
				  		<label>
				  			<input type="radio" name="question<?php echo $row['pk_pregunta']?>" id="option<?php echo $row['pk_pregunta']?>" value="2" autocomplete="off"><br />
					    	<i class="em em-relieved img-responsive"></i><br />
					      	&nbsp;&nbsp;&nbsp;&nbsp;BUENO&nbsp;&nbsp;&nbsp;&nbsp;
					  </label>
					</td>
					<td>
			  			<label>
			  				<input type="radio" name="question<?php echo $row['pk_pregunta']?>" id="option<?php echo $row['pk_pregunta']?>" value="3" autocomplete="off"><br />
					    	<i class="em em-neutral_face img-responsive"></i><br />
					      	&nbsp;&nbsp;REGULAR&nbsp;&nbsp;
					  </label>
					</td>
					<td>
					  <label>

					     	<input type="radio" name="question<?php echo $row['pk_pregunta']?>" id="option<?php echo $row['pk_pregunta']?>" value="4" autocomplete="off"><br />
					    	<i class="em em-angry img-responsive"></i><br />
					     	&nbsp;&nbsp;&nbsp;&nbsp;MALO&nbsp;&nbsp;&nbsp;&nbsp;
					  </label>
					</td>
				</tr>
			</div>
		</table>
		</div>
		<div class="row"><div class="col-12 col-md-12">&nbsp;</div></div>
		<?php }?>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<hr>
			<center><legend class="text-danger">Para comentarios y/o sugerencias escribela, nos encantaría saberla</legend></center>
			<textarea class="form-control" id="comentario" name="comentarios" rows="3"></textarea>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-12 col-md-12"><center>
			<button id="sendEncuestaNew" type="button" class="btn btn-outline-success">ENVIAR</button>
		</div>
	</div>
	<div class="row"><div class="col-12 col-md-12">&nbsp;</div></div>

</div>
<!-- <footer>Al terminar de llenar la encuesta no se te, olvide darle click a l botón enviar.</footer>
 --><style type="text/css">
.back{
	background-color: #F8F8F8;
}
@font-face{
	font-family: 'RammettoOne-Regular';
	src: url("../apis/fonts/RammettoOne-Regular.ttf");
}
.sub{
	font-family: 'RammettoOne-Regular', cursive;
}
.em{
	width: 50px;
	height: 50px;
}
td{
    text-align: center;
}
.em:hover{cursor:pointer;}
.em:active{
	border-radius: 50%;
	-webkit-box-shadow: 0px 0px 10px rgba(74, 74, 74, 0.75);
	-moz-box-shadow:    0px 0px 10px rgba(74, 74, 74, 0.75);
	box-shadow:         0px 0px 10px rgba(74, 74, 74, 0.75);
	-webkit-transform: scale(1.2);
	-moz-transform: scale(1.2);
}
legend{
	font-size: 20px;
    color:#0066FF;
}
</style>
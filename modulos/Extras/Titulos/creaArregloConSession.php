<?php
session_start();
extract($_POST);
if(isset($_SESSION['Fulldatos'])){
	$datos=$_SESSION['Fulldatos'];
	if(isset($_POST)){
		$newDatos=array(
				'matricula'=>$matricula,
				'f_frente'=>$fecha_frente,
				'f_atras'=>$fecha_atras,
				'foja'=>$foja,
				'folio'=>$folio,
				'libro'=>$libro
		);
		array_push($datos, $newDatos);
		$_SESSION['Fulldatos']=$datos;
	}
}
else{
	if(isset($_POST)){
		$datos[]=array(
				'matricula'=>$matricula,
				'f_frente'=>$fecha_frente,
				'f_atras'=>$fecha_atras,
				'foja'=>$foja,
				'folio'=>$folio,
				'libro'=>$libro
		);
		$_SESSION['Fulldatos']=$datos;
	}
}
if(isset($_GET['Del'])){
	unset($_SESSION['Fulldatos']);
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-midnightblue">
        <div class="panel-heading">
                <h4>Matriculas agregadas</h4>
                <div class="options">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#" data-toggle="tab">Ver</a></li>
                    </ul>
                </div>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane active" id=""><center>
                    <table>
                    	<tr>
                        	<th>#</th>
                        	<th>Matricula</th>
                            <th>Fecha Frente</th>
                            <th>Fecha Atrás</th>
                            <th>No. de foja acta</th>
                            <th>Tomo del Libro</th>
                        </tr>
                        <?php
							$no=1;
							if(isset($_SESSION['Fulldatos'])){
								$datos=$_SESSION['Fulldatos'];
								for($i=0; $i<count($datos); $i++){
									echo'
										<tr>
											<td>'.$no.'</td>
											<td>'.$datos[$i]['matricula'].'</td>
											<td>'.$datos[$i]['f_frente'].'</td>
											<td>'.$datos[$i]['f_atras'].'</td>
											<td>'.$datos[$i]['foja'].'</td>
											<td>'.$datos[$i]['libro'].'</td>
										</tr>
									';
									$no++;
								}
							}
                        ?>
                   	</table>
                    <div class="form-group">
                                <div id="botonera" class="btn-toolbar">
                                    <center>   
                                        <button class="btn btn-success start" type="button" onclick="generarTitulosPDF(1)">
                                            <i class="fa fa-save"></i>
                                            <span>PDF Licenciatura</span>
                                        </button>
                                        
                                         <button class="btn btn-primary start" type="button" onclick="generarTitulosPDF(2)">
                                            <i class="fa fa-save"></i>
                                            <span>PDF Posgrado</span>
                                        </button>
                                  </center>
                                </div>
                            </div>
                   	</div>
               	</div>
           	</div>
        </div>
   </div>
</div>   
<style>
table {     font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
    font-size: 12px;    margin: 45px;     width: 480px; text-align: left;    border-collapse: collapse; width:80%; }

th {     font-size: 13px;     font-weight: normal;     padding: 8px;     background: #b9c9fe;
    border-top: 4px solid #aabcfe;    border-bottom: 1px solid #fff; color: #039; }

td {    padding: 8px;     background: #e8edff;     border-bottom: 1px solid #fff;
    color: #669;    border-top: 1px solid transparent; }

tr:hover td { background: #d0dafd; color: #339; }
</style>         

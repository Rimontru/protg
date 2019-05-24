<?php
require_once("../../../../includes/Config.class.php");  # Cargar datos conexion y otras variables.
require_once('../../../../includes/DB.class.php');
require_once('../../../../includes/ConsultaDB.class.php');
require_once('../../../../mpdf/mpdf.php');
require_once('../../../../includes/MisFunciones.class.php');

$Obras = new ConsultaDB;
$Funciones = new MisFunciones();
date_default_timezone_set('America/Mexico_City');
$today = date("d-m-Y");
$fecha = date("d/m/Y");

function escapeword($string){
	
}

$nom_archivo='ReporteTotalCredencialesEntregadas_'. $today.'.pdf';

if(isset($_GET['fk_nivelestudio'])) {#esto es correcto  
	$fk_nivelestudio  = $_GET['fk_nivelestudio'];
	$fk_modalidad	  = $_GET['fk_modalidad'];
	
	$Result32 = $Obras->ConsultaDatosInsitucionConEstados();
    if ($Result32) {
        $row333 = mysql_fetch_assoc($Result32);

        $nombreInstitucion = strtoupper($row333['nombreInstitucion']);
        $apodoInstitucion = $row333['apodoInstitucion'];
        $clave = $row333['clave'];
        $direccion = $row333['direccion'];
        $telefono = $row333['telefono'];
        $ciudad = $row333['CiudadEscuela'];
        $estado = $row333['EstadoEscuela'];
        $fechaIncorporacionsecretaria = $row333['fechaIncorporacionSrecetaria'];
        $numerooficio = $row333['noOficio'];
        $registro = $row333['registro'];
        $regimen = $row333['regimen'];
        $paginainternet = $row333['paginaInternet'];
        $lemaescuela = $row333['lemaEscuela'];
    }
	
	$mes=array("01" => 'Enero', "02" => 'Febrero', "03" => 'Marzo', "04" => 'Abril',
            "05" => 'Mayo', "06" => 'Junio', "07" => 'Julio', "08" => 'Agosto', "09" => 'Septiembre',
            "10" => 'Octubre', "11" => 'Noviembre', "12" => 'Diciembre');
	



$fk_car[0] = NULL; $i=1; 
$resultCar = $Obras->CarrerasActivasLicenciaturas($fk_nivelestudio, $fk_modalidad);
if($resultCar){
	while( $rows = mysql_fetch_array($resultCar) ){ $fk_car[$i] = $rows['pk_carreras'];  $i++;}
	$rowNumCar = mysql_num_rows($resultCar);

}  //fin consulta carreras
#fil=car col=mes

$car=NULL;
$mes=NULL; # es el numero de años solo la variable la ocupo como mes
$suMes=NULL;
$matrix[$car][$mes]=NULL;


#var_dump($fk_car);
#die();
for($car=1; $car<=$rowNumCar; $car++){
	for($mes=1; $mes<=7; $mes++){
		$result33 = $Obras->verCredencialesEgresadosTotalAnuales($mes+2011,$fk_car[$car]);
		$row33 = mysql_fetch_assoc($result33);
		$matrix[$car][$mes] = $row33['totalbycar'];
	}
}




for($car=1; $car<=$rowNumCar; $car++){
	$result29 = $Obras->verCredencialesEgresadosTotalAnuales($mes+2011,$fk_car[$car]);
		$row29=mysql_fetch_assoc($result29);
		$html3= '
				<tbody align="center">
					<tr>
						<td>'.$row29['nombreCarrera'].'</td>
						<td align="center">'.$matrix[$car][1].'</td>
						<td align="center">'.$matrix[$car][2].'</td>
						<td align="center">'.$matrix[$car][3].'</td>
						<td align="center">'.$matrix[$car][4].'</td>
						<td align="center">'.$matrix[$car][5].'</td>
						<td align="center">'.$matrix[$car][6].'</td>
						<td align="center">'.$matrix[$car][7].'</td>
						<td align="center"><b>'.$sum=$matrix[$car][1]+$matrix[$car][2]+$matrix[$car][3]+$matrix[$car][4]+$matrix[$car][5]+$matrix[$car][6]+$matrix[$car][7].'</td>
					</tr>';
				
			 $html4 = $html4.$html3;
			
        }


	if($fk_modalidad==1){
		$nomModalidad='SEMESTRAL';
	}
	elseif($fk_modalidad==2){
		$nomModalidad='CUATRIMESTRAL';
	}
	elseif($fk_modalidad==3){
		$nomModalidad='TRIMESTRAL';
	}
	else{
		$nomModalidad='PENTAMESTRAL';
	}

$html='
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
</head>
<style>
.tableDB{
	font-size:11px;
}
.center{
	text-aling:center;
}
</style>
<body>
<table width="990" border="0" align="center">
<tr>
    <td colspan="2" rowspan="6"><div align="center"><img src="../../../../assets/img/IESCH.png" width="117" height="121" /></div></td>
    <td colspan="8"><center><div align="center"><strong>' . $nombreInstitucion . '</strong></div></center></td>
    <td colspan="2" rowspan="6"><div align="center"><img src="../../../../assets/img/fimpes.png" width="107" height="109" /></div></td>
  </tr>
  <tr>
    <td colspan="8"><center><div align="center"><strong> </strong></div></center></td>
  </tr>
  <tr>
    <td colspan="8"><center><div align="center"><strong>INCORPORADO A LA  SECRETARIA DE EDUCACIÓN</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan="8"><center><div align="center"><strong>OFICIO No. ' . $numerooficio . ' DE FECHA ' . $fechaIncorporacionsecretaria . '</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan="8"><center><div align="center"><strong>RÉGIMEN: ' . $regimen . '    CLAVE: </strong><strong>' . $clave . '</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan="8"><center><div align="center"><strong>EXCELENCIA ACADÉMICA: REG. ' . $registro . '  </strong></div>
    </center></td>
  </tr>
  <tr>
    <td width="105">&nbsp;</td>
    <td width="39">&nbsp;</td>
    <td width="73">&nbsp;</td>
    <td width="44">&nbsp;</td>
    <td width="47">&nbsp;</td>
    <td width="68">&nbsp;</td>
    <td width="33">&nbsp;</td>
    <td width="103">&nbsp;</td>
    <td width="36">&nbsp;</td>
    <td width="55">&nbsp;</td>
    <td width="53">&nbsp;</td>
    <td width="79">&nbsp;</td>
  </tr>
  <tr>
   	<td colspan="4"><div align="left">FECHA DE REPORTE:<strong>' . $fecha . '</strong></div></td>
    <td colspan="5"><center><strong>CREDENCIALES DE EGRESADOS ENTREGADAS POR AÑO</strong></center></td>
    <td colspan="3" align="right"><div align="right"><strong>'.$nomModalidad.'</strong></div></td>
  </tr>
</table><p>
';

if($fk_nivelestudio==2){
	$nomNivel='LICENCIATURAS';
}
elseif($fk_nivelestudio==3){
	$nomNivel='MAESTRÌAS';
}
elseif($fk_nivelestudio==4){
	$nomNivel='DOCTORADOS';
}
else{
	$nomNivel='ESPECIALIDADES';
}

$html2=
'
<table border="1" width="1160" height="30" style="font-size:10px;">
				<thead>
					<tr>
						<td align="center"><b>'.$nomNivel.'</td>
						<td align="center"><b>2012</td>
						<td align="center"><b>2013</td>
						<td align="center"><b>2014</td>
						<td align="center"><b>2015</td>
						<td align="center"><b>2016</td>
						<td align="center"><b>2017</td>						
						<td align="center"><b>2018</td>						
						<td align="center"><b>TOTAL</td>
					</tr>
				</thead>

';

$sumCol[$mes]=0;

for($mes=1; $mes<=7; $mes++){
	for($car=1; $car<=$rowNumCar; $car++){
		$sumCol[$mes]=$sumCol[$mes]+$matrix[$car][$mes];

$html5='
  <tr>
	  <td align="center"><b><center>TOTAL</td>
		<td align="center"><b>'.$sumCol[1].'</td>
		<td align="center"><b>'.$sumCol[2].'</td>
		<td align="center"><b>'.$sumCol[3].'</td>
		<td align="center"><b>'.$sumCol[4].'</td>
		<td align="center"><b>'.$sumCol[5].'</td>
		<td align="center"><b>'.$sumCol[6].'</td>
		<td align="center"><b>'.$sumCol[7].'</td>
		<td align="center"><b>'.$total=$sumCol[1]+$sumCol[2]+$sumCol[3]+$sumCol[4]+$sumCol[5]+$sumCol[6]+$sumCol[7].'</td>
  </tr>';

$html6='
</tbody>
</table>
</body>
</html>
';	
	}
	
}


$res = $html.$html2.$html4.$html5.$html6;
}
else{
	$res = "Lo Sentimos No Se Pudo Realizar la Consulta";
}

$mpdf=new mPDF('','Letter','',''); 
$mpdf->AddPage('L','','','','','','','','','','');
$mpdf->WriteHTML($res);
$mpdf->Output($nom_archivo, 'I');
?>
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

$nom_archivo='ReporteAnualCredencialesEntregadas_'. $today.'.pdf';

if(isset($_GET['anhio'])) {#esto es correcto  
	$busquedaAnhio    = $_GET['anhio'];
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
$car=0;
$mes=0;
$suMes=1;
$matrix[$car][$mes]='';
$suFil[$car][$mes]=0;

#var_dump($fk_car);
#die();
for($car=1; $car<=$rowNumCar; $car++){
	for($mes=1; $mes<=12; $mes++){
		$result33 = $Obras->verCredencialesEgresadosAnuales($busquedaAnhio,$mes,$fk_car[$car]);
		$row33 = mysql_fetch_assoc($result33);
		$matrix[$car][$mes] = $row33['totalbycar'];
	}
}


for($car=1; $car<=$rowNumCar; $car++){
	$result29 = $Obras->verCredencialesEgresadosAnuales($busquedaAnhio,$mes,$fk_car[$car]);
		$row29=mysql_fetch_assoc($result29);
		$html3= '
		<table border="1" width="1160" height="30" align="center" style="font-size:8px;">
				<tbody>
					<tr>
						<td width="450">'.
						$row29['nombreCarrera']
						.'</td>
						<td width="45"><center>'.
						$matrix[$car][1]
						.'</td>
						<td width="45"><center>'.
						$matrix[$car][2]
						.'</td>
						<td width="45"><center>'.
						$matrix[$car][3]
						.'</td>
						<td width="45"><center>'.
						$matrix[$car][4]
						.'</td>
						<td width="45"><center>'.
						$matrix[$car][5]
						.'</td>
						<td width="45"><center>'.
						$matrix[$car][6]
						.'</td>
						<td width="45"><center>'.
						$matrix[$car][7]
						.'</td>
						<td width="45"><center>'.
						$matrix[$car][8]
						.'</td>
						<td width="45"><center>'.
						$matrix[$car][9]
						.'</td>
						<td width="45"><center>'.
						$matrix[$car][10]
						.'</td>
						<td width="45"><center>'.
						$matrix[$car][11]
						.'</td>
						<td width="45"><center>'.
						$matrix[$car][12]
						.'</td>
						<td width="45" align="right"><b>'.
							$sum=$matrix[$car][1]+$matrix[$car][2]+$matrix[$car][3]+$matrix[$car][4]+$matrix[$car][5]+$matrix[$car][6]+$matrix[$car][7]+$matrix[$car][8]+$matrix[$car][9]+$matrix[$car][10]+$matrix[$car][11]+$matrix[$car][12]
						.'</td>
						
					</tr>
				</tbody>
			 </table>';
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
    <td colspan="5"><center><strong>CREDENCIALES DE EGRESADOS ENTREGADAS EN EL '.$_GET['anhio'].'</strong></center></td>
    <td colspan="3" align="right"><div align="right"><strong>'.$nomModalidad.'</strong></div></td>
  </tr>
</table>
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
<table border="1" width="1160" height="30" align="center" style="font-size:8px;">
				<thead>
					<tr>
						<td width="450"><b>'.$nomNivel.'</td>
						<td width="45"><b>ENE</td>
						<td width="45"><b>FEB</td>
						<td width="45"><b>MAR</td>
						<td width="45"><b>ABR</td>
						<td width="45"><b>MAY</td>
						<td width="45"><b>JUN</td>
						<td width="45"><b>JUL</td>
						<td width="45"><b>AGO</td>
						<td width="45"><b>SEP</td>
						<td width="45"><b>OCT</td>
						<td width="45"><b>NOV</td>
						<td width="45"><b>DIC</td>
						<td width="45"><b>TOTAL</td>
					</tr>
				</thead>
		</table>
';

$sumCol[$mes]=0;

for($mes=1; $mes<=12; $mes++){
	for($car=1; $car<=$rowNumCar; $car++){
		$sumCol[$mes]=$sumCol[$mes]+$matrix[$car][$mes];

$html5='
<table width="210" border="1" style="font-size:8px;">
  <tr>
    <td width="450"><b><center>TOTAL</td>
	<td width="45"><b>'.$sumCol[1].'</td>
	<td width="45"><b>'.$sumCol[2].'</td>
	<td width="45"><b>'.$sumCol[3].'</td>
	<td width="45"><b>'.$sumCol[4].'</td>
	<td width="45"><b>'.$sumCol[5].'</td>
	<td width="45"><b>'.$sumCol[6].'</td>
	<td width="45"><b>'.$sumCol[7].'</td>
	<td width="45"><b>'.$sumCol[8].'</td>
	<td width="45"><b>'.$sumCol[9].'</td>
	<td width="45"><b>'.$sumCol[10].'</td>
	<td width="45"><b>'.$sumCol[11].'</td>
	<td width="45"><b>'.$sumCol[12].'</td>
	<td width="45"><b>'.
		$total=$sumCol[1]+$sumCol[2]+$sumCol[3]+$sumCol[4]+$sumCol[5]+$sumCol[6]+$sumCol[7]+$sumCol[8]+$sumCol[9]+$sumCol[10]+$sumCol[11]+$sumCol[12]
	.'</td>
  </tr>
</table>
</body>
</html>
';	
	}
	
}


$res = $html.$html2.$html4.$html5;
}
else{
	$res = "Lo Sentimos No Se Pudo Realizar la Consulta";
}

$mpdf=new mPDF('','Letter','',''); 
$mpdf->AddPage('L','','','','','','','','','','');
$mpdf->WriteHTML($res);
$mpdf->Output($nom_archivo, 'I');
?>
<?php
require_once("../../../../Config.class.php");  # Cargar datos conexion y otras variables.
require_once('../../../../DB.class.php');
require_once('../../../../ConsultaDB.class.php');
require_once('../../../../../mpdf/mpdf.php');
require_once('../../../../MisFunciones.class.php');

$Obras = new ConsultaDB;
$Funciones = new MisFunciones();
date_default_timezone_set('America/Mexico_City');
$today = date("d-m-Y");
$fecha = date("d/m/Y");

$nom_archivo='ReporteEgresadosEmpresasEmpleadoras_'. $today.'.pdf';

if(isset($_GET['fk_nivelestudio'])) {
	$fk_carreras      = $_GET['fk_carreras'];
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
	mysql_free_result($Result32);
	
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
	if($fk_nivelestudio==2){
	$nomNivel='LICENCIATURA';
	}
	elseif($fk_nivelestudio==3){
		$nomNivel='MAESTRÌA';
	}
	elseif($fk_nivelestudio==4){
		$nomNivel='DOCTORADO';
	}
	else{
		$nomNivel='ESPECIALIDADE';
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
    <td colspan="2" rowspan="6"><div align="center"><img src="../../../../../assets/img/IESCH.png" width="117" height="121" /></div></td>
    <td colspan="8"><center><div align="center"><strong>' . $nombreInstitucion . '</strong></div></center></td>
    <td colspan="2" rowspan="6"><div align="center"><img src="../../../../../assets/img/fimpes.png" width="107" height="109" /></div></td>
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
    <td colspan="5"><center><strong>EMPRESAS EMPLEADORAS</strong></center></td>
    <td colspan="3" align="right"><div align="right"><strong>'.$nomModalidad.'</strong></div></td>
  </tr>
</table>
';
$html2=
'
<table border="0" width="1160" height="30" align="center" style="font-size:10px;border-bottom:solid;">
	<thead>
		<tr>
			<td width="350"><b>&nbsp;</td>
			<td width="142"><b>ALUMNO</td>
			<td width="42"><b>SEXO</td>
			<td width="342"><b>EMPRESA LABORANDO</td>
			<td width="142"><b>PUESTO EMPRESA</td>
			<td width="142"><b>TELÈFONO EMPRESA</td>
		</tr>
	</thead>
</table>	
';
	$result=$Obras->EgresadosEmpresasEmpleadores($fk_nivelestudio,$fk_modalidad,$fk_carreras);
	if ($result) {
		while($row=mysql_fetch_assoc($result)){
			$nombreAlumno=$row['NombreCompleto'];
			$sexo=$row['Sexo'];
			$nombreCarrera=$row['nombreCarrera'];
			$empresaEmpleadora=$row['nombreEmpresaTrabajo'];
			$puestoEmpleado=$row['puestoTrabajo'];
			$telefonoempresa=$row['telefonoTrabajo'];
$html3='
	<table border="0" width="1160" height="30" align="center" style="font-size:8px;">
				<thead>
					<tr>
						<td width="350"><b>'.$nombreCarrera.'</td>
						<td width="142"><b>'.$nombreAlumno.'</td>
						<td width="42"><b>'.$sexo.'</td>
						<td width="342"><b>'.$empresaEmpleadora.'</td>
						<td width="142"><b>'.$puestoEmpleado.'</td>
						<td width="142"><b>'.$telefonoempresa.'</td>
					</tr>
				</thead>
		</table>
';	
$html4 = $html4.$html3;
	}
mysql_free_result($result);
}


	
$res=$html.$html2.$html4;	
}
else{
	$res = "Lo Sentimos No Se Pudo Realizar la Consulta";
}

$mpdf=new mPDF('','Letter','',''); 
$mpdf->AddPage('L','','','','','','','','','','');
$mpdf->WriteHTML($res);
$mpdf->Output($nom_archivo, 'I');

?>
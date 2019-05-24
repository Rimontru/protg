<?php
#®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®principales®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®
require_once("../../../../includes/Config.class.php");
require_once('../../../../includes/DB.class.php');
require_once('../../../../includes/ConsultaDB.class.php');
require_once('../../../../mpdf/mpdf.php');
require_once('../../../../includes/MisFunciones.class.php');
date_default_timezone_set('America/Mexico_City');

$querys = new ConsultaDB;
$metodos = new MisFunciones();

$today = date("d-m-Y");
$fecha=date("d/m/Y");
#®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®principales®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®

#®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®DATOS ESCOLARES®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®
if (isset($_GET['fk_nivelestudio'])){
    $fk_nivelestudio = $_GET['fk_nivelestudio'];
    $fk_modalidad = $_GET['fk_modalidad'];
    $fk_carreras = $_GET['fk_carreras'];
	$Generacioncorte = $_GET['Generacioncorte'];

    $Result22 = $querys->verTrabajadoresDirectoresReportes($fk_carreras);
    if ($Result22) {
        $row222 = mysql_fetch_assoc($Result22);
        $nombreDirector = ($row222[NombreCompletoDirector]);
        $carreraReporte = ($row222[nombreCarrera]);

        mysql_free_result($Result22);
    }

    $Result32 = $querys->ConsultaDatosInsitucionConEstados();
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
#®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®COVERTIR A LETRAS LA MODALIDAD®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®
if($fk_modalidad=="1"){
	$ModalidadReporte="SEMESTRAL";
	 }else	if($fk_modalidad=="2"){
	$ModalidadReporte="CUATRIMESTRAL";
	 }else if($fk_modalidad=="3"){
	$ModalidadReporte="TRIMESTRAL";
	 }else if($fk_modalidad=="4"){
	$ModalidadReporte="PENTAMESTRAL";
}
#®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®CREA EL CUERPO DE MI TABLA NUMEROS®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®
#VARIABLES DECLARADAS
$cantiTitu=0;

#TABLA CON INFORMACION ANTES DEL CORTE
$resultGeneracion=$querys->ObtieneTodasLasGeneracionesHaciendoCorte($fk_nivelestudio, $fk_modalidad, $fk_carreras, $Generacioncorte);
while($rowGene=mysql_fetch_assoc($resultGeneracion)){
	
	$resultTitulados=$querys->ConCantidadAlumnosTitulados($fk_nivelestudio, $fk_modalidad, $fk_carreras, $rowGene['fk_generacion']);
		while($rowTitu=mysql_fetch_assoc($resultTitulados)){
			$noTitulados = $rowGene['EgresadosByCarrera'] - $rowTitu['cantidadTotalEgresados'];
			$eficienciaByGene=($rowTitu['cantidadTotalEgresados'] / $rowGene['EgresadosByCarrera'])*100;
			
			$html3="
			  <tr>
				<td align='center' style='border-width: 1px;border: solid;' colspan='2'><div align='center'>".$rowGene['generacionNumero']."</div></td>
				<td align='center' style='border-width: 1px;border: solid;'  ><div align='center'>".$rowGene['DescripcionGeneracion']."</div></td>
				<td align='center'  style='border-width: 1px;border: solid;' ><div align='center'>".$rowGene['EgresadosByCarrera']."</div></td>
				<td align='center' style='border-width: 1px;border: solid;' ><div align='center'>".$rowTitu['cantidadTotalEgresados']."</div></td>
				<td align='center' style='border-width: 1px;border: solid;'  colspan='2'><div align='center'>".$noTitulados."</div></td>
				<td align='center' style='border-width: 1px;border: solid;' ><div align='center'>".round($eficienciaByGene)." %</div></td>				
			  </tr> 
			";
			
			#totales por tabla
			$EgresadosTotal += $rowGene['EgresadosByCarrera'];
			$TituladosTotal += $rowTitu['cantidadTotalEgresados'];
			$NoTituladosTotal += $noTitulados;
			$eficienciaTotalSuma += $eficienciaByGene;
			$eficienciaTotal = $eficienciaTotalSuma / $rowGene['generacionNumero'];
		}
		$html4 .= $html3;	
}#fin del while principal y de la consulta con la variable CorteGeneracion 
mysql_free_result($resultGeneracion);

#TABLA CON INFORMACION DESPUES DEL CORTE
$resultGeneracionD=$querys->ObtieneTodasLasGeneracionesDespuesDeCorte($fk_nivelestudio, $fk_modalidad, $fk_carreras, $Generacioncorte);
while($rowGeneD=mysql_fetch_assoc($resultGeneracionD)){
	
	$resultTituladosD=$querys->ConCantidadAlumnosTitulados($fk_nivelestudio, $fk_modalidad, $fk_carreras, $rowGeneD['fk_generacion']);
		while($rowTituD=mysql_fetch_assoc($resultTituladosD)){
			$noTituladosD = $rowGeneD['EgresadosByCarrera'] - $rowTituD['cantidadTotalEgresados'];
			$eficienciaByGeneD=($rowTituD['cantidadTotalEgresados'] / $rowGeneD['EgresadosByCarrera'])*100;
			
			$html6="
			  <tr>
				<td align='center' style='border-width: 1px;border: solid;' colspan='2'><div align='center'>".$rowGeneD['generacionNumero']."</div></td>
				<td align='center' style='border-width: 1px;border: solid;'  ><div align='center'>".$rowGeneD['DescripcionGeneracion']."</div></td>
				<td align='center'  style='border-width: 1px;border: solid;' ><div align='center'>".$rowGeneD['EgresadosByCarrera']."</div></td>
				<td align='center' style='border-width: 1px;border: solid;' ><div align='center'>".$rowTituD['cantidadTotalEgresados']."</div></td>
				<td align='center' style='border-width: 1px;border: solid;'  colspan='2'><div align='center'>".$noTituladosD."</div></td>
				<td align='center' style='border-width: 1px;border: solid;' ><div align='center'>".round($eficienciaByGeneD)." %</div></td>				
			  </tr> 
			";
			
			#totales por tabla
			$EgresadosTotalD += $rowGeneD['EgresadosByCarrera'];
			$TituladosTotalD += $rowTituD['cantidadTotalEgresados'];
			$NoTituladosTotalD += $noTituladosD;
			$eficienciaTotalSumaD += $eficienciaByGeneD;
			$eficienciaTotalD = $eficienciaTotalSumaD / $rowGeneD['generacionNumero'];
		}
		$html7 .= $html6;	
}#fin del while principal y de la consulta con la variable CorteGeneracion 
mysql_free_result($resultGeneracionD);#®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®CREA EL CUERPO DE MI TABLA NUMEROS®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®

#®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®CREA EL ENCABEZADO DE MI TABLA REPORTE®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®
$html='<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo1 {font-size: 11px}
.pie {font-size: 9px}
-->
</style>
</head>

<body>
<table width="785" border="0" align="center">
<tr>
    <td colspan="2" rowspan="6"><div align="center"><img src="../../../../assets/img/IESCH.png" width="117" height="121" /></div></td>
    <td colspan="8"><center><div align="center"><strong>'.$nombreInstitucion.'</strong></div></center></td>
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
    <td colspan="8"><center><div align="center"><strong>OFICIO No. '.$numerooficio.' DE FECHA '.$fechaIncorporacionsecretaria.'</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan="8"><center><div align="center"><strong>RÉGIMEN: '.$regimen.'    CLAVE: </strong><strong>'.$clave.'</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan="8"><center><div align="center"><strong>EXCELENCIA ACADÉMICA: REG. '.$registro.'  </strong></div>
    </center></td>
  </tr>
   <tr>
    <td colspan="13"><center><div align="center"><strong>FECHA DE REPORTE:'.$fecha.'<strong></div>
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
    <td colspan="12"><strong>CARRERA: </strong> ' . $carreraReporte .'</td>
  </tr>
  <tr>
    <td colspan="12"><strong>MODALIDAD: </strong> ' . $ModalidadReporte .'</td>
  </tr>
</table>
<table width="698" height="139" border="0" align="center" style="border-collapse: collapse;">
  <tr>
    <td colspan="8" align="center"><div align="center">'.$carreraTitulados.'</div></td>
  </tr>
  <tr>
    <td colspan="2"  style="border-width: 1px;border: solid;" bgcolor="#009933" align="center"><div align="center"><span class="Estilo1">GENERACI&Oacute;N</span></div></td>
    <td align="center" width="250" style="border-width: 1px;border: solid;" bgcolor="#009933"><div align="center"><span class="Estilo1">CICLO ESCOLAR</span></div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933"> <div align="center"><span class="Estilo1">ALUMNOS EGRESADOS</span></div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933"><div align="center"><span class="Estilo1">TITULADOS</span></div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933"><div align="center"><span class="Estilo1">NO TITULADOS</span></div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933" colspan="2"><div align="center"><span class="Estilo1">EFICIENCIA DE TITULACI&Oacute;N</span></div>      <div align="center"><span class="Estilo1"></span></div></td>
  </tr>
';
#®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®CREA EL FIN DE MI TABLA NUMEROS®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®
$htmlFin1='
  <tr>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#FFFF66" colspan="2"><div align="center" class="Estilo1">TOTAL</div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#FFFF66"><div align="center" class="Estilo1">EGRESADOS</div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#FFFF66"><div align="center">'.$EgresadosTotal.'</div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#FFFF66"><div align="center">'.$TituladosTotal.'</div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#FFFF66"><div align="center">'.$NoTituladosTotal.'</div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#FFFF66" colspan="2"><div align="center">'.round($eficienciaTotal).' %</div></td>
  </tr>
';

$htmlFin2='
  <tr>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#3399FF" colspan="2"><div align="center" class="Estilo1">TOTAL</div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#3399FF"><div align="center" class="Estilo1">EGRESADOS QUE REALIZAN SU SS.</div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#3399FF"><div align="center">'.$EgresadosTotalD.'</div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#3399FF"><div align="center">'.$TituladosTotalD.'</div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#3399FF"><div align="center">'.$NoTituladosTotalD.'</div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#3399FF" colspan="2"><div align="center">'.round($eficienciaTotalD).' %</div></td>
  </tr>
';

$htmlFin3='
  <tr>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933" colspan="3"><div align="center" class="Estilo1">TOTAL GLOBAL</div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933"><div align="center">'.($EgresadosTotal+$EgresadosTotalD).'</div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933"><div align="center">'.($TituladosTotal).'</div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933"><div align="center">'.($NoTituladosTotalD+$NoTituladosTotal).'</div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933" colspan="2"><div align="center">'.round($TituladosTotal/($EgresadosTotal+$EgresadosTotalD)*100).' %</div></td>
  </tr>
';



#®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®CREA EL PIE DE MI TABLA EN GENERAL®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®
$htmlPie='
  <tr>
    <td colspan="2">&nbsp;</div></td>
 </tr>
  <tr>
    <td colspan="2">&nbsp;</div></td>
 </tr>
  <tr>
    <td colspan="2">&nbsp;</div></td>
 </tr>
  <tr>
    <td colspan="2">&nbsp;</div></td>
 </tr>
 <tr>
    <td colspan="8" class="pie"><center><strong> FUENTE: DEPARTAMENTO DE SEGUIMIENTO DE EGRESADOS</strong></center></td>
 </tr>
</table>
</body>
</html>
';
#®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®FINALIZA MY CONSULTA Y CONCATENA EN UNA VARIABLE TODAS MIS TABLAS CREDAS®®®®®®®®®®®®®®®®®®®®®®®®®®®®
$res=$html.$html4.$htmlFin1.$html7.$htmlFin2.$htmlFin3.$htmlPie;
#®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®CONTRADICE LA CONDICION SE EXISTE Y CREA EL PDF®®®®®®®®®®®®®®®®®®®®®®®®®®®®
}#CIERRA EL IF SI EXISTE LA VARIABLE
else{
    $html = "Lo Sentimos No Se Pudo Realizar la Consulta";
}
$mpdf = new mPDF();
$mpdf->WriteHTML($res);
$mpdf->Output("ReporteEspecialporCarreras_". $today.'.pdf', 'I');
?> 

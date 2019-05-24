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

$fk_estadoTitulacion = $_GET['fk_estadoTitulacion'];

$nomb_arch="TablaUltimasGeneracionesCompara.xls";

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=".$nomb_arch);


if (isset($_GET['fk_nivelestudio'])) {
    $fk_nivelestudio = $_GET['fk_nivelestudio'];
    $fk_modalidad = $_GET['fk_modalidad'];
    $fk_carreras = $_GET['fk_carreras'];
    $fk_generacion = $_GET['fk_generacion'];


    $Result22 = $Obras->verTrabajadoresDirectoresReportes($fk_carreras);
    if ($Result22) {
        $row222 = mysql_fetch_assoc($Result22);
        $nombreDirector = ($row222[NombreCompletoDirector]);
        $carreraReporte = ($row222[nombreCarrera]);

        mysql_free_result($Result22);
    }






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


	if($fk_modalidad=="1"){
		$ModalidadReporte="SEMESTRAL";
	 }
	 elseif($fk_modalidad=="2"){
		$ModalidadReporte="CUATRIMESTRAL";
	 }
	 elseif($fk_modalidad=="3"){
		$ModalidadReporte="TRIMESTRAL";
	 }
	 elseif($fk_modalidad=="4"){
		$ModalidadReporte="PENTAMESTRAL";
	 }

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo1 {font-size: 13px}
.pie {font-size: 9px}
-->
</style>
</head>

<body>
<table width="1000" border="0" align="center">
<tr>
    <td colspan="2" rowspan="6" style="border:solid #000;"></td>
    <td colspan="8"><center><div align="center"><strong><?=$nombreInstitucion?></strong></div></center></td>
    <td colspan="2" rowspan="6" style="border:solid #000;"></td>
  </tr>
  <tr>
    <td colspan="8"><center><div align="center"><strong> </strong></div></center></td>
  </tr>
  <tr>
    <td colspan="8"><center><div align="center"><strong>INCORPORADO A LA  SECRETARIA DE EDUCACIÓN</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan="8"><center><div align="center"><strong><?= 'OFICIO No. '.$numerooficio.' DE FECHA '.$fechaIncorporacionsecretaria?></strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan="8"><center><div align="center"><strong><?= 'RÉGIMEN: '.$regimen.'    CLAVE: </strong>'.$clave.'<strong>'?></strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan="8"><center><div align="center"><strong><?= 'EXCELENCIA ACADÉMICA: REG. '.$registro?></strong></div>
    </center></td>
  </tr>
   <tr>
    <td colspan="2"><div align="center">&nbsp;</div></td>
    <td colspan="8"><center><div align="center"><strong><?= 'FECHA DE REPORTE:'.$today?><strong></div>
    <td colspan="2"><div align="center">&nbsp;</div></td>
    </center></td>
  </tr>
  <tr>
    <td width="105">&nbsp;</td>
  </tr>
  <tr>
  <td colspan="2"><div align="center">&nbsp;</div></td>
    <td colspan="8"><center><div align="center"><strong>DESARROLLO LABORAL<strong></div></center></td>
    <td colspan="2"><div align="center">&nbsp;</div></td>
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
    <td colspan="12"><strong>CARRERA: </strong><?= $carreraReporte?></td>
  </tr>
  <tr>
    <td colspan="12"><strong>MODALIDAD: </strong><?= $ModalidadReporte?></td>
  </tr>
</table>
<table width="698" height="139" border="0" align="center" style="border-collapse: collapse;">
  <tr>
    <td colspan="8" align="center"><div align="center"><?= $carreraTitulados?></div></td>
  </tr>
  <tr>
    <td colspan="2"  style="border-width: 1px;border: solid;" bgcolor="#009933" align="center">
    	<div align="center"><span class="Estilo1">GENERACI&Oacute;N</span></div>
    </td>
    
    <td align="center" width="250" style="border-width: 1px;border: solid;" bgcolor="#009933">
   		<div align="center"><span class="Estilo1">CICLO ESCOLAR</span></div>
    </td>
    
    <td align="center" width="250" style="border-width: 1px;border: solid;" bgcolor="#009933">
   		<div align="center"><span class="Estilo1">PLAN DE ESTUDIOS</span></div>
    </td>
    
    <td align="center" colspan="2" width="250" style="border-width: 1px;border: solid;" bgcolor="#009933">
   		<div align="center"><span class="Estilo1">PDI</span></div>
    </td>
    
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933">
    	<div align="center"><span class="Estilo1">EGRESADOS</span></div>
   	</td>
    
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933">
    	<div align="center"><span class="Estilo1">LABORANDO</span></div>
    </td>
    
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933">
    	<div align="center"><span class="Estilo1">PORCENTAJE</span></div>
    </td>
    
    <td align="center" width="250" style="border-width: 1px;border: solid;" colspan="3" bgcolor="#009933">
   		<div align="center"><span class="Estilo1">DIRECTOR</span></div>
    </td>
  </tr>


<?php

$request = $Obras->ConObtenerNoGeneracionesTodas($fk_nivelestudio, $fk_modalidad, $fk_carreras);
if ($request) {
    $row111 = mysql_fetch_assoc($request);
	$noTotalGeneraciones = $row111['Result'];
	
		if( ($row111['Result'] > 4) && $fk_carreras == 12)
			$empiezaCon = $noTotalGeneraciones - 8;
					
		elseif( ($row111['Result'] > 4) && $fk_carreras==16 || $fk_carreras==22 || $fk_carreras==32)
				$empiezaCon = $noTotalGeneraciones - 7;
				
		elseif($row111['Result'] <= 5)
			$empiezaCon = 0;
			
		else
			$empiezaCon = $noTotalGeneraciones - 6;
}


$result33 = $Obras->ConObtenerGeneracionesCinco($fk_nivelestudio, $fk_modalidad, $fk_carreras, $empiezaCon);
if ($result33) {
    while ($row33 = mysql_fetch_assoc($result33)) {
        
        
                    $Result = $Obras->ConCantidadAlumnosTituladosNoTitulados($fk_nivelestudio, $fk_modalidad, $fk_carreras, $row33['fk_generacion']);
                    if ($Result) {
                        while ($row2 = mysql_fetch_assoc($Result)) {
                            $cantidadLista = $row2['cantidadTotal'];
                            $cantidadListaxida=$cantidadLista+$cantidadListaxida;
                        }
                        mysql_free_result($Result);
                    }
										

                    //obtenemos la cantidad total de titulados
                    $Result3 = $Obras->ConCantidadAlumnosEgresadosTrabajando($fk_nivelestudio, $fk_modalidad, $fk_carreras, $row33['fk_generacion']);
                    if ($Result3) {
                        while ($row3 = mysql_fetch_assoc($Result3)) {
                            $cantidadTotalTrabajan += $row3['cantidadTotalTrabajan'];
                       
           
                        $eficiencia=($row3['cantidadTotalTrabajan'] / $cantidadLista)*100;

?>

<tr>
	<td align='center' style='border-width: 1px;border: solid;' colspan='2'>
    	<div align='center'><?=$row33['generacionNumero']?></div>
    </td>
	<td align='center' style='border-width: 1px;border: solid;'>
    	<div align='center'><?=$row33['DescripcionGeneracion']?></div>
   	</td>
    <td align='center' style='border-width: 1px;border: solid;'>
    	<div align='center'><?=$row33['desc_planestudios']?></div>
   	</td>
    <td align='center' colspan="2" style='border-width: 1px;border: solid;'>
    	<div align='center'>&nbsp;</div>
   	</td>
	<td align='center'  style='border-width: 1px;border: solid;'>
    	<div align='center'><?=$cantidadLista?></div>
    </td>
	<td align='center' style='border-width: 1px;border: solid;'>
    	<div align='center'><?=$row3['cantidadTotalTrabajan']?></div>
   	</td>
	<td align='center' style='border-width: 1px;border: solid;'>
    	<div align='center'><?=round($eficiencia)?> %</div>
    </td>
    <td align='center' colspan="3" style='border-width: 1px;border: solid;'>
    	<div align='center'>&nbsp;</div>
   	</td>
</tr> 

<?php
						}
						mysql_free_result($Result3);
					}
$cantidadLista="";
$eficienciaLista="";
$notituladosListo="";
                         $html4=$html4.$html2;
        $hombreT += $hombre;
		$mujerT += $mujer;
    }
    mysql_free_result($result33);
}

$eficienciaFinal=($cantidadTotalTrabajan/$cantidadListaxida)*100;
//$notituladosListo=round($notitulados,2);
  $eficienciaListaXida=substr($eficienciaFinal,0,5);
  $eficienciaExacta=round($eficienciaListaXida);
?>
  
  <tr>
    <td align="center" colspan="6" style="border-width: 1px;border: solid;" bgcolor="#009933"><div align="center">TOTALES: </div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933"><div align="center"><?=$cantidadListaxida?></div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933"><div align="center"><?=$cantidadTotalTrabajan?></div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933"><div align="center"><?=$eficienciaExacta?> %</div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933" colspan="3"><div align="center"></div></td>
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
    <td colspan="2">&nbsp;</div></td>
 </tr>
   <tr>
    <td colspan="12" class="pie"><center><strong> FUENTE: DEPARTAMENTO DE SEGUIMIENTO DE EGRESADOS</strong></center></td>
 </tr>
  
</table>
</body>
</html>
<?php
} else {
    echo "Lo Sentimos No Se Pudo Realizar la Consulta";
}
?>
?> 

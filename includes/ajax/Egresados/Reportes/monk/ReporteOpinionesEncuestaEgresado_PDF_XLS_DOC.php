<?php
date_default_timezone_set('America/Mexico_City');
$today = date("d-m-Y");
$print = date("d/m/Y");

if (isset($_GET['typeDoc'])):

require_once("../../../../../includes/Config.class.php");  # Cargar datos conexion y otras variables.
require_once('../../../../../includes/DB.class.php');
require_once('../../../../../includes/ConsultaDB.class.php');
require_once('../../../../../includes/MisFunciones.class.php');

switch ( $_GET['typeDoc'] ) { /*-- Definimos el encabezado --*/
  case 1: /*PDF*/
      require_once('../../../../../mpdf/mpdf.php');
      $nomb_arch="ReportesProtg_".(uniqid()).".pdf";
      $mpdf=new mPDF('','Letter','','');
      $mpdf->AddPage('P','','','','','','','','','','');
      $mpdf->SetFooter('Fuente: Departamento de Egresados||Fecha impresion '.$print);
      $style = "text-align:center;";
      $ext = 1;
    break;

  case 2: /*EXCEL*/
    $nomb_arch="ReportesProtg_".(uniqid()).".xls";
    header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=".$nomb_arch);
    $style = "border:solid #000";
    $ext = 2;
    break;
  case 3: /*WORD*/
      $nomb_arch="ReportesProtg_".(uniqid()).".doc";
    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment; filename=".$nomb_arch);
    $ext = 3;
    break;

  default:
        die("Extensión no encontrada...");
    break;
}

$Obras = new ConsultaDB;
$Funciones = new MisFunciones();

 $r1=0;
  $r2=0;
if ( isset($_GET['fk_nivelestudio']) ) {
if ( $_GET['fk_nivelestudio'] == 2 )
  $desc = "una Maestría";
elseif( $_GET['fk_nivelestudio'] == 3 )
  $desc = "un Doctorado";
elseif ( $_GET['fk_nivelestudio'] == 4 )
  $desc = "una Especialidad";
$opciones=array(
  7=>"¿Si tuvieras que cursar nuevamente tus estudios, eligirías la misma institución?",
  8=>"¿Estudiarías ".$desc." en la misma institución?",
  9=>"¿Tiene alguna sugerencia para enriquecer al programa educativo, su formación profesional y su desempeño laboral actual?",
  );

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
    $clave = $row333['clave'];
    $fechaIncorporacionsecretaria = $row333['fechaIncorporacionSrecetaria'];
    $numerooficio = $row333['noOficio'];
    $registro = $row333['registro'];
    $regimen = $row333['regimen'];
}

$result1 = $Obras->ConDatosCompletosCarreras($_GET['fk_modalidad'], $_GET['fk_carreras'], $_GET['fk_generacion']);
$row1 = mysql_fetch_array($result1);

$header = '
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
</style>
</head>

<body>
<table width="1000" border="0" align="center">
<tr>
    <td colspan="2" rowspan="6" style="'.$style.'">
      <img src="../../../../../assets/img/IESCH.png" width="100" height="100" />
    </td>
    <td colspan="8"><center><div align="center"><strong>'.$nombreInstitucion.' EN TUXTLA GUTIERREZ S.C.</strong></div></center></td>
    <td colspan="2" rowspan="6" style="'.$style.'">
      <img src="../../../../../assets/img/fimpes.png" width="100" height="100" />
    </td>
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
    <td colspan="8"><center><div align="center"><strong> RÉGIMEN: '.$regimen.' CLAVE: '.$clave.'</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan="8"><center><div align="center"><strong>EXCELENCIA ACADÉMICA: REG. '.$registro.'</strong></div>
    </center></td>
  </tr>
  <tr>
    <td width="105">&nbsp;</td>
  </tr>
  <tr>
  <td colspan="2"><div align="center">&nbsp;</div></td>
    <td colspan="8"><center><div align="center">'.$opciones[$_GET['opcionGrafica']].'</div></center></td>
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
    <td colspan="12"><strong>CARRERA: </strong>'.$row1['nombreCarrera'].' '.strtoupper($row1['nombreMod']).'</td>
  </tr>
  <tr>
    <td colspan="12"><strong>GENERACIÓN: </strong>'.$row1['descripcion'].'</td>
  </tr>
</table>
<br/>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td style="border: 1px solid;" bgcolor="#009933" align="center">
      R
    </td>

    <td align="center" style="border: 1px solid;" bgcolor="#009933">
      COMENTARIOS
    </td>
  </tr>
';

$tb1 ="";$tblX ="";

if ($_GET['opcionGrafica']==7){
$result33 = $Obras->ConOpinionAlumnosEgresadosElegirMismaInstitucion($_GET['fk_nivelestudio'], $_GET['fk_modalidad'], $_GET['fk_carreras'], $_GET['fk_generacion']);

/*$result11 = $Obras->ConCantidadAlumnosEgresadosElegirMismaInstitucion($_GET['fk_nivelestudio'], $_GET['fk_modalidad'], $_GET['fk_carreras'], $_GET['fk_generacion']);
$row11 = mysql_fetch_array($result11);*/

}elseif ($_GET['opcionGrafica']==8){
  $result33 = $Obras->ConOpinionAlumnosEgresadosEstudiarMaestriaMismaInstitucion($_GET['fk_nivelestudio'], $_GET['fk_modalidad'], $_GET['fk_carreras'], $_GET['fk_generacion']);
 /* $result121 = $Obras->ConCantidadAlumnosEgresadosEstudiarMaestriaMismaInstitucion($_GET['fk_nivelestudio'], $_GET['fk_modalidad'], $_GET['fk_carreras'], $_GET['fk_generacion']);
  $row121 = mysql_fetch_array($result121);*/
} else {
	$result33 = $Obras->ConOpinionAlumnosEgresadosSugerenciaProgramaEducativo($_GET['fk_nivelestudio'], $_GET['fk_modalidad'], $_GET['fk_carreras'], $_GET['fk_generacion']);
}

if ($result33) {

    while ($row33 = mysql_fetch_assoc($result33)) {

if( $_GET['opcionGrafica']==7 || $_GET['opcionGrafica']==8) {

if($row33['Legend']=='SI') $r1+=1; else $r2+=1;

$tb1 .= "
<tr>
  <td align='center' style='border-width: 1px;border: solid; font-size:10px;'>
    <div>".$row33['Legend']."</div>
  </td>
  <td style='border-width: 1px;border: solid; font-size:10px;'>
    <div align='center'>".$row33['porque']."</div>
  </td>
</tr>
";
}
else
$tb1 .= "
<tr>
  <td align='center' style='border-width: 1px;border: solid; font-size:10px;' width='7'>
    <div>NT</div>
  </td>
  <td style='border-width: 1px;border: solid; font-size:10px;'>
    <div align='center'>".$row33['sugerencias']."</div>
  </td>
</tr>
";
    }
    mysql_free_result($result33);
}

$footer = '</table>';
/*
if($row11['Legend']=='SI') $r1=$row11['cantidad']; else $r1=0;
if($row11['Legend']=='NO') $r2=$row11['cantidad']; else $r2=0;

if($row121['Legend']=='SI') $r1=$row121['cantidad']; else $r1=0;
if($row121['Legend']=='NO') $r2=$row121['cantidad']; else $r2=0;
*/
if( $_GET['opcionGrafica']==7 || $_GET['opcionGrafica']==8) {

$tblX = '<table style="font-size:10px;">
  <tr>
    <td colspan="2">Resultados</td>
  </tr>
  <tr>
    <td>SI</td>
    <td>'.$r1.'</td>
  </tr>
  <tr>
    <td>NO</td>
    <td>'.$r2.'</td>
  </tr>
</table>';
}

$DOC = $header.$tb1.$footer.$tblX.'</body></html>';

} else
    die("Lo sentimos, faltan parametros del reporte...");

if ($ext == 1){
      $mpdf->WriteHTML($DOC);
      $mpdf->Output($nomb_arch,'I');
} else
  echo $DOC;

else:
  die("No se definio el tipo de archivo a generar...");
endif;
/*
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
*/
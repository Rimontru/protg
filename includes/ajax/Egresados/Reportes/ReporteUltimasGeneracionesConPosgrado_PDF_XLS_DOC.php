<?php
date_default_timezone_set('America/Mexico_City');
$today = date("d-m-Y");
$print = date("d/m/Y");

if (isset($_GET['typeDoc'])):
require_once("../../../../includes/Config.class.php");  # Cargar datos conexion y otras variables.
require_once('../../../../includes/DB.class.php');
require_once('../../../../includes/ConsultaDB.class.php');
require_once('../../../../includes/MisFunciones.class.php');

switch ( $_GET['typeDoc'] ) { /*-- Definimos el encabezado --*/
  case 1: /*PDF*/
      require_once('../../../../mpdf/mpdf.php');
      $nomb_arch="ReportesProtg_".(uniqid()).".pdf";
      $mpdf=new mPDF('','Letter','',''); 
      $mpdf->AddPage('L','','','','','','','','','','');
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


if ( isset($_GET['fk_nivelestudio']) ) {

$fk_nivelestudio = $_GET['fk_nivelestudio'];
$fk_modalidad = $_GET['fk_modalidad'];
$fk_carreras = $_GET['fk_carreras'];


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


if($fk_modalidad=="1")
  $ModalidadReporte="SEMESTRAL";
else if($fk_modalidad=="2")
  $ModalidadReporte="CUATRIMESTRAL";
else if($fk_modalidad=="3")
  $ModalidadReporte="TRIMESTRAL";
elseif($fk_modalidad=="4")
  $ModalidadReporte="PENTAMESTRAL";


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
      <img src="../../../../assets/img/IESCH.png" width="100" height="100" />
    </td>
    <td colspan="8"><center><div align="center"><strong>'.$nombreInstitucion.'</strong></div></center></td>
    <td colspan="2" rowspan="6" style="'.$style.'">
      <img src="../../../../assets/img/fimpes.png" width="100" height="100" />
    </td>
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
    <td colspan="8"><center><div align="center"><strong> RÉGIMEN: '.$regimen.' CLAVE: </strong>'.$clave.'<strong></strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan="8"><center><div align="center"><strong>EXCELENCIA ACADÉMICA: REG. '.$registro.'</strong></div>
    </center></td>
  </tr>
   <tr>
    <td colspan="2"><div align="center">&nbsp;</div></td>
    <td colspan="8"><center><div align="center"><strong>FECHA DE REPORTE:'.$today.'<strong></div>
    <td colspan="2"><div align="center">&nbsp;</div></td>
    </center></td>
  </tr>
  <tr>
    <td width="105">&nbsp;</td>
  </tr>
  <tr>
  <td colspan="2"><div align="center">&nbsp;</div></td>
    <td colspan="8"><center><div align="center"><strong>DESARROLLO ACADEMICO<strong></div></center></td>
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
    <td colspan="12"><strong>CARRERA: </strong>'.$carreraReporte.'</td>
  </tr>
  <tr>
    <td colspan="12"><strong>MODALIDAD: </strong>'.$ModalidadReporte.'</td>
  </tr>
</table>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td style="border: 1px solid;" bgcolor="#009933" align="center">
      GENERACI&Oacute;N
    </td>
    
    <td align="center" style="border: 1px solid;" bgcolor="#009933">
      CICLO ESCOLAR
    </td>
    
    <td align="center" style="border: 1px solid;" bgcolor="#009933">
      EGRESADOS
    </td>
    
    <td colspan="3" align="center" style="border: 1px solid;" bgcolor="#009933">
      MAESTRIA
    </td> 
    
    <td colspan="3" align="center" style="border: 1px solid;" bgcolor="#009933">
      DOCTORADO
    </td>
    
    <td colspan="3" align="center" style="border: 1px solid;" bgcolor="#009933">
      ESPECIALIDAD
    </td>    

  </tr>
  <tr>
    <td style="border: 1px solid;" bgcolor="#009933"></td>
    <td style="border: 1px solid;" bgcolor="#009933"></td>
    <td style="border: 1px solid;" bgcolor="#009933"></td>
    <td style="border: 1px solid;" bgcolor="#009933" align="center">#</td>
    <td style="border: 1px solid;" bgcolor="#009933" align="center">%</td>
    <td style="border: 1px solid;" bgcolor="#009933" align="center">IESCH</td>

    <td style="border: 1px solid;" bgcolor="#009933" align="center">#</td>
    <td style="border: 1px solid;" bgcolor="#009933" align="center">%</td>
    <td style="border: 1px solid;" bgcolor="#009933" align="center">IESCH</td>

    <td style="border: 1px solid;" bgcolor="#009933" align="center">#</td>
    <td style="border: 1px solid;" bgcolor="#009933" align="center">%</td>
    <td style="border: 1px solid;" bgcolor="#009933" align="center">IESCH</td>

  </tr>
';

$tb1 ="";
$tb2 ="";

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

if($empiezaCon < 0)
	$empiezaCon = 0;

$result33 = $Obras->ConObtenerGeneracionesCinco($fk_nivelestudio, $fk_modalidad, $fk_carreras, $empiezaCon);
if ($result33) {
    while ($row33 = mysql_fetch_assoc($result33)) {
        
        
                    $Result = $Obras->ConCantidadAlumnosTituladosNoTitulados($fk_nivelestudio, $fk_modalidad, $fk_carreras, $row33['fk_generacion']);
                    if ($Result) {
                        while ($row2 = mysql_fetch_assoc($Result)) {
                            $cantidadLista = $row2['cantidadTotal'];
                            $cantidadListaxida += $cantidadLista;
                        }
                        mysql_free_result($Result);
                    }
                    

                    $Result3 = $Obras->ConCantidadAlumnosEgresadosConMaestria($fk_nivelestudio, $fk_modalidad, $fk_carreras, $row33['fk_generacion']);
                        while ($row3 = mysql_fetch_assoc($Result3)) {
                            $rst12 =  $Obras->ConCantidadAlumnosEgresadosConPosgradoIESCH($fk_nivelestudio, $fk_modalidad, $fk_carreras, $row33['fk_generacion'], 1);
                            $row12 = mysql_fetch_assoc($rst12);
                            $totalEstudianMaeIesch += $row12['cantidadPosgradoIesch'];
                            $cantidadTotalMae += $row3['cantidadTotalEnMaestria'];
                            $totMae += $cantidadTotalMae;
                        $eficienciaMae=($cantidadTotalMae / $cantidadLista)*100;
                        $totEfiMae = ($eficienciaMae+$totEfiMae)/5;


                    $Result4 = $Obras->ConCantidadAlumnosEgresadosConDoctorado($fk_nivelestudio, $fk_modalidad, $fk_carreras, $row33['fk_generacion']);
                        while ($row4 = mysql_fetch_assoc($Result4)) {
                            $rst13 =  $Obras->ConCantidadAlumnosEgresadosConPosgradoIESCH($fk_nivelestudio, $fk_modalidad, $fk_carreras, $row33['fk_generacion'], 2);
                            $row13 = mysql_fetch_assoc($rst13);
                            $totalEstudianDocIesch += $row13['cantidadPosgradoIesch'];
                            $cantidadTotalDoc += $row4['cantidadTotalEnDoctorado'];
                            $totDoc += $cantidadTotalDoc;
                        $eficienciaDoc=($cantidadTotalDoc / $cantidadLista)*100;
                        $totEfiDoc = ($eficienciaDoc+$totEfiDoc)/5;


                    $Result5 = $Obras->ConCantidadAlumnosEgresadosConEspecialidad($fk_nivelestudio, $fk_modalidad, $fk_carreras, $row33['fk_generacion']);
                        while ($row5 = mysql_fetch_assoc($Result5)) {
                          $rst14 =  $Obras->ConCantidadAlumnosEgresadosConPosgradoIESCH($fk_nivelestudio, $fk_modalidad, $fk_carreras, $row33['fk_generacion'], 3);
                            $row14 = mysql_fetch_assoc($rst14);
                            $totalEstudianEspIesch += $row14['cantidadPosgradoIesch'];
                            $cantidadTotalEsp += $row5['cantidadTotalEnEspecialidad'];
                            $totEsp += $cantidadTotalEsp;
                        $eficienciaEsp=($cantidadTotalEsp / $cantidadLista)*100;
                        $totEfiEsp = ($eficienciaEsp+$totEfiEsp)/5;


$tb1 .= "
<tr>
  <td align='center' style='border-width: 1px;border: solid;'>
    <div align='center'>".$row33['generacionNumero']."</div>
  </td>
  <td align='center' style='border-width: 1px;border: solid;'>
    <div align='center'>".$row33['DescripcionGeneracion']."</div>
  </td>
  <td align='center'  style='border-width: 1px;border: solid;'>
    <div align='center'>".$cantidadLista."</div>
  </td>
  <td align='center' style='border-width: 1px;border: solid;'>
    <div align='center'>".$cantidadTotalMae."</div>
  </td>
  <td align='center' style='border-width: 1px;border: solid;'>
    <div align='center'>".round($eficienciaMae)."%</div>
  </td>
  <td align='center' style='border-width: 1px;border: solid;'>
    <div align='center'>".$row12['cantidadPosgradoIesch']."</div>
  </td>
  <td align='center' style='border-width: 1px;border: solid;'>
    <div align='center'>".$cantidadTotalDoc."</div>
  </td>
  <td align='center' style='border-width: 1px;border: solid;'>
    <div align='center'>".round($eficienciaDoc)."%</div>
  </td>
  <td align='center' style='border-width: 1px;border: solid;'>
    <div align='center'>".$row13['cantidadPosgradoIesch']."</div>
  </td>
  <td align='center' style='border-width: 1px;border: solid;'>
    <div align='center'>".$cantidadTotalEsp."</div>
  </td>
  <td align='center' style='border-width: 1px;border: solid;'>
    <div align='center'>".round($eficienciaEsp)."%</div>
  </td>
  <td align='center' style='border-width: 1px;border: solid;'>
    <div align='center'>".$row14['cantidadPosgradoIesch']."</div>
  </td>
</tr> 
";
          }}}

    }
    mysql_free_result($result33);
}

 $tb2 .= "
<tr>
  <td colspan='2' align='center' style='border-width: 1px;border: solid;' bgcolor='#009933'>
    <div align='center'>Totales</div>
  </td>
  <td align='center' style='border-width: 1px;border: solid;' bgcolor='#009933'>
    <div align='center'>".$cantidadListaxida."</div>
  </td>
  <td align='center' style='border-width: 1px;border: solid;' bgcolor='#009933'>
    <div align='center'>".$totMae."</div>
  </td>
  <td align='center' style='border-width: 1px;border: solid;' bgcolor='#009933'>
    <div align='center'>".round($totEfiMae)."%</div>
  </td>
  <td align='center' style='border-width: 1px;border: solid;' bgcolor='#009933'>
    <div align='center'>".$totalEstudianMaeIesch."</div>
  </td>
  <td align='center' style='border-width: 1px;border: solid;' bgcolor='#009933'>
    <div align='center'>".$totDoc."</div>
  </td>
  <td align='center' style='border-width: 1px;border: solid;' bgcolor='#009933'>
    <div align='center'>".round($totEfiDoc)."%</div>
  </td>
  <td align='center' style='border-width: 1px;border: solid;' bgcolor='#009933'>
    <div align='center'>".$totalEstudianDocIesch."</div>
  </td>
  <td align='center' style='border-width: 1px;border: solid;' bgcolor='#009933'>
    <div align='center'>".$totEsp."</div>
  </td>
  <td align='center' style='border-width: 1px;border: solid;' bgcolor='#009933'>
    <div align='center'>".round($totEfiEsp)."%</div>
  </td>
  <td align='center' style='border-width: 1px;border: solid;' bgcolor='#009933'>
    <div align='center'>".$totalEstudianEspIesch."</div>
  </td>
</tr> 
";


$footer = '</table></body></html>';


$DOC = $header.$tb1.$tb2.$footer;

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
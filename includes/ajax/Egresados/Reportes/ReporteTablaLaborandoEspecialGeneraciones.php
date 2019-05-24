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
$fecha=date("d/m/Y");


if (isset($_GET['fk_nivelestudio'])) {
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

$tiempos = array(
          'de 1 a 3 meses',
          'de 3 a 6 meses',
          'de 6 meses a 1 año',
          'de 1 a 2 años',
          'de 2 años o más'
          );

if($fk_modalidad=="1"){
    $ModalidadReporte="SEMESTRAL";
         }else  if($fk_modalidad=="2"){
    $ModalidadReporte="CUATRIMESTRAL";
         }else if($fk_modalidad=="3"){
    $ModalidadReporte="TRIMESTRAL";
         }else if($fk_modalidad=="4"){
    $ModalidadReporte="PENTAMESTRAL";
}

$no = 0;
$result33 = $Obras->ConObtenerGeneracionesTodasTop2015($fk_nivelestudio, $fk_modalidad, $fk_carreras);
if ($result33) {
    while ( $row33 = mysql_fetch_assoc($result33) ) :
      ++$no;

      $result881 = $Obras->MioConCantidadTotalAlumnosByGenTramites($fk_nivelestudio, $fk_modalidad, $fk_carreras, $row33['fk_generacion']);
          if ($result881) {
            $egresados = 0;
            while ($row881 = mysql_fetch_assoc($result881)) {
               ++$egresados; 
            }
      
          mysql_free_result($result881);
          }

         //obtenemos la cantidad total de titulados
          $Result3 = $Obras->ConCantidadAlumnosEgresadosTrabajando($fk_nivelestudio, $fk_modalidad, $fk_carreras, $row33['fk_generacion']);
          if ($Result3) {
              $row3 = mysql_fetch_assoc($Result3);
              $trabajan = $row3['cantidadTotalTrabajan'];
              $porciento = ($trabajan * 100) / $egresados;

          }

          $times = array (1,2,3,4,5);

          foreach ($times as $value) {
            $result381 = $Obras->MioConCantidadTotalAlumnosByGenTramitesTimeJob($fk_nivelestudio, $fk_modalidad, $fk_carreras, $row33['fk_generacion'], $value);
            $row381 =  mysql_fetch_assoc($result381);
              $opciones[$value] = $row381['cuantosEncuentranJob'];
          }

          $mayorTiempo = array_search( max($opciones), $opciones );

     $html2='
      <tr>
        <td align="center" style="border:1px solid #000;color:black;font-size:12px;">
          <div align="center">'.$no.'</div>
        </td>
        <td align="center" style="border:1px solid #000;font-size:12px;">
          <div align="center">'.$row33['DescripcionGeneracion'].'</div>
        </td>
        <td align="center" style="border:1px solid #000;font-size:12px;">
          <div align="center">'.$egresados.'</div>
        </td>
        <td align="center" style="border:1px solid #000;font-size:12px;">
          <div align="center">'.$trabajan.'</div>
        </td>
        <td align="center" style="border:1px solid #000;font-size:12px;">
          <div align="center">'.(round($porciento)).'</div>
        </td>
        <td align="center" style="border:1px solid #000;font-size:12px;">
          <div align="center">'.$tiempos[$mayorTiempo].'</div>
        </td>
        <td align="center" style="border:1px solid #000;font-size:12px;">
          <div align="center"></div>
        </td>
        <td align="center" style="border:1px solid #000;font-size:12px;">
          <div align="center"></div>
        </td>
        <td align="center" style="border:1px solid #000;font-size:12px;">
          <div align="center"></div>
        </td>
        <td align="center" style="border:1px solid #000;font-size:12px;">
          <div align="center"></div>
        </td>    
      </tr>
      ';
      $html4 = $html4.$html2;
    endwhile;

mysql_free_result($result33);
}



//encabezado
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
    <td colspan="8"><center><div align="center"><strong> </strong></div></center></td>
  </tr>
  <tr>
    <td colspan="13"><center><div align="center"><strong>DESARROLLO LABORAL<strong></div>
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
<table width="785" height="139" border="0" align="center" style="border-collapse: collapse;">
  <tr>
    <td colspan="8" align="center"><div align="center">'.$carreraTitulados.'</div></td>
  </tr>
  <tr bgcolor="#104230">
    <td align="center" style="border-bottom:1px solid #fff;border-left:1px solid;">
      <div style="color:#fff;" align="center">&nbsp;</div>
    </td>
    <td align="center" style="border-bottom:1px solid #fff;">
      <div style="color:#fff;" align="center">&nbsp;</div>
    </td>
    <td align="center" style="border-bottom:1px solid #fff;">
      <div style="color:#fff;" align="center">&nbsp;</div>
    </td>
    <td align="center" style="border-left:1px solid #fff;font-size:9px;">
      <div style="color:#fff;" align="center">Trabajando</div>
    </td>
    <td align="center" style="border-right:1px solid #fff;font-size:9px;">
      <div style="color:#fff;" align="center">Actualmente</div>
    </td>
    <td align="center" style="border-bottom:1px solid #fff;">
      <div style="color:#fff;" align="center">&nbsp;</div>
    </td>
    <td align="center" style="border-bottom:1px solid #fff;">
      <div style="color:#fff;" align="center">&nbsp;</div>
    </td>
    <td align="center" style="border-bottom:1px solid #fff;">
      <div style="color:#fff;" align="center">&nbsp;</div>
    </td>
    <td align="center" style="border-bottom:1px solid #fff;">
      <div style="color:#fff;" align="center">&nbsp;</div>
    </td>
    <td align="center" style="border-bottom:1px solid #fff;border-right:1px solid;">
      <div style="color:#fff;" align="center">&nbsp;</div>
    </td>    
  </tr>

  <tr bgcolor="#104230">
    <td align="center" style="border-right:1px solid #fff;border-left:1px solid;font-size:12px;">
      <div style="color:#fff;" align="center">No</div>
    </td>
    <td align="center" style="border-right:1px solid #fff;font-size:12px;">
      <div style="color:#fff;" align="center">Generación</div>
    </td>
    <td align="center" style="border-right:1px solid #fff;font-size:12px;">
      <div style="color:#fff;" align="center">Egresados</div>
    </td>
    <td align="center" style="border-right:1px solid #fff;font-size:12px;">
      <div style="color:#fff;" align="center">#</div>
    </td>
    <td align="center" style="border-right:1px solid #fff;font-size:12px;">
      <div style="color:#fff;" align="center">%</div>
    </td>
    <td align="center" style="border-right:1px solid #fff;font-size:12px;">
      <div style="color:#fff;" align="center">Promedio de <br> Incorporación al <br> Mercado Laboral</div>
    </td>
    <td align="center" style="border-right:1px solid #fff;font-size:12px;">
      <div style="color:#fff;" align="center">Puestos</div>
    </td>
    <td align="center" style="border-right:1px solid #fff;font-size:12px;">
      <div style="color:#fff;" align="center">Giros</div>
    </td>
    <td align="center" style="border-right:1px solid #fff;font-size:12px;">
      <div style="color:#fff;" align="center">Empresas</div>
    </td>
    <td align="center" style="border-right:1px solid;font-size:12px;">
      <div style="color:#fff;" align="center">Porcentaje de <br> Alineación con <br> Perfil de Egresado</div>
    </td>    
  </tr>

  ';

$html3='
</table>
</body>
</html>
';






$res=$html.$html4.$html3;

    
} else {
    $html = "Lo Sentimos No Se Pudo Realizar la Consulta";
}
//echo $res;






$mpdf = new mPDF('','Letter','','');
$mpdf->AddPage('L','','','','','','','','','','');
$mpdf->WriteHTML($res);
$mpdf->Output("TablaGeneraciones_". $today.'.pdf', 'I');
?> 

<?php

require_once("../../../../../includes/Config.class.php");  # Cargar datos conexion y otras variables.
require_once('../../../../../includes/DB.class.php');
require_once('../../../../../includes/ConsultaDB.class.php');
require_once('../../../../../mpdf/mpdf.php');
require_once('../../../../../includes/MisFunciones.class.php');

$Obras = new ConsultaDB;
$Funciones = new MisFunciones();

$today = date("d-m-Y");

if (isset($_GET['fk_nivelestudio'])) {
    $fk_nivelestudio = $_GET['fk_nivelestudio'];
    $fk_modalidad = $_GET['fk_modalidad'];
    $fk_carreras = $_GET['fk_carreras'];
    $rangoFechas = $_GET['rangoFechas'];

    
      $Result22 = $Obras->verTrabajadoresDirectoresReportes($fk_carreras);
    if ($Result22) {
        $row222 = mysql_fetch_assoc($Result22);
        $nombreDirector=  ($row222[NombreCompletoDirector]);
        $carreraReporte=  ($row222[nombreCarrera]);
     
        mysql_free_result($Result22);
    }
    
    
    
    
    
    
    $Result32 = $Obras->ConsultaDatosInsitucionConEstados();
    if ($Result32) {
       $row333 = mysql_fetch_assoc($Result32);

        $nombreInstitucion=strtoupper($row333['nombreInstitucion']);
        $apodoInstitucion=$row333['apodoInstitucion'];
        $clave=$row333['clave'];
        $direccion=$row333['direccion'];
        $telefono=$row333['telefono'];
        $ciudad=strtoupper($row333['CiudadEscuela']);
        $estado=strtoupper($row333['EstadoEscuela']);
        $fechaIncorporacionsecretaria=$row333['fechaIncorporacionSrecetaria'];
        $numerooficio=$row333['noOficio'];
        $registro=$row333['registro'];
        $regimen=$row333['regimen'];
        $paginainternet=$row333['paginaInternet'];
        $lemaescuela=$row333['lemaEscuela'];
    }
    
    
    
    
    
    
    
if($fk_carreras=="6" || $fk_carreras=="7" || $fk_carreras=="11" || $fk_carreras=="13"  || $fk_carreras=="27"){
    
    $carreraAutorizacion=$carreraReporte;
}else{
    $carreraAutorizacion="".$carreraReporte;
    
}
    




    //convertimos fechas
    $fechaSQL = explode("-", $rangoFechas);
    $fechaInicio = trim($fechaSQL[0]);
    $fechaFin = trim($fechaSQL[1]);

    //  01/07/2014 - 31/07/2014
    $fechaSQL = explode("/", $fechaInicio);
    $fechaInicio = $fechaSQL[2] . "-" . $fechaSQL[1] . "-" . $fechaSQL[0];

    $fechaSQL = explode("/", $fechaFin);
    $fechaFin = $fechaSQL[2] . "-" . $fechaSQL[1] . "-" . $fechaSQL[0];


$contador=1;
    $Result = $Obras->ConReporteSabanaAutorizaciones($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fechaInicio, $fechaFin);
    if ($Result) {
        while ($row2 = mysql_fetch_assoc($Result)) {


                   $fechaSQL = explode("-",$row2['FechaTomaProtesta']);
                   $tomaprotestaLista=$fechaSQL[2]."/".$fechaSQL[1]."/".$fechaSQL[0]; 

                   $nombreCompletoListo=($row2['NombreCompleto']);

              $html1='
                <tr>
                  <td height="21" style="border-width: 1px;border: solid;"><span class="Estilo2">'.$contador++.'</span></td>
                  <td colspan="7" style="border-width: 1px;border: solid;"><span class="Estilo2">'.$nombreCompletoListo.'</span></td>
                  <td colspan="2" style="border-width: 1px;border: solid;"><span class="Estilo2">'.$tomaprotestaLista.'</span></td>
                  <td colspan="2" style="border-width: 1px;border: solid;"><span class="Estilo2">1ERA</span></td>
                  <td colspan="2" style="border-width: 1px;border: solid;"><span class="Estilo2">'.$row2['NumeroAutorizacion'].'</span></td>
                  <td style="border-width: 1px;border: solid;"><span class="Estilo2"></span></td>
                  <td style="border-width: 1px;border: solid;"><span class="Estilo2"></span></td>
                  <td style="border-width: 1px;border: solid;"><span class="Estilo2"></span></td>
                  <td style="border-width: 1px;border: solid;"><span class="Estilo2"></span></td>
                  <td style="border-width: 1px;border: solid;"><span class="Estilo2">'.$row2['matricula'].'</span></td>
                </tr>';


               $html3=$html3.$html1;    
            
            
            
            
            
            
        }
        mysql_free_result($Result);

        
        
        
        
        
        
        
        
        
        
        
        
$html='<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo1 {
	font-size: 12px;
	font-weight: bold;
}
.Estilo2 {font-size: 11px}
.Estilo3 {font-size: 11px; font-weight: bold; }
-->
</style>
</head>

<body>
<table width="1142" height="424" border="0" style="border-collapse: collapse;">
  <tr>
    <td colspan="2" rowspan="6"><div align="center"><img src="../../../../../assets/img/hechos.jpg" width="153" height="91" /></div></td>
    <td height="19" colspan="14"><center><div align="center" class="Estilo1">SECRETARIA DE EDUCACION</div></center></td>
    <td colspan="2" rowspan="6"><div align="left"><img src="../../../../../assets/img/secretaria.jpg" width="124" height="98" /></div></td>
  </tr>
  <tr>
    <td height="19" colspan="14"><center><div align="center" class="Estilo1">SUBSECRETARIA DE EDUCACION ESTATAL</div></center></td>
  </tr>
  <tr>
    <td height="19" colspan="14"><center><div align="center" class="Estilo1">DIRECCION DE EDUCACION SUPERIOR</div></center></td>
  </tr>
  <tr>
    <td height="19" colspan="14"><center><div align="center" class="Estilo1">DEPARTAMENTO DE SERVICIOS ESCOLARES Y BECAS</div></center></td>
  </tr>
  <tr>
    <td height="19" colspan="14"><center><div align="center" class="Estilo1">'.$nombreInstitucion.'</div></center></td>
  </tr>
  <tr>
    <td height="19" colspan="14"><center><div align="center" class="Estilo1">CONTROL DE NUMERO DE AUTORIZACIONES</div></center></td>
  </tr>
  <tr>
    <td height="21" colspan="14">&nbsp;</td>
  </tr>
  <tr>
    <td width="46" height="21">&nbsp;</td>
    <td width="106">&nbsp;</td>
    <td width="5">&nbsp;</td>
    <td width="2">&nbsp;</td>
    <td width="1">&nbsp;</td>
    <td width="2">&nbsp;</td>
    <td width="14">&nbsp;</td>
    <td width="184">&nbsp;</td>
    <td width="47">&nbsp;</td>
    <td width="36">&nbsp;</td>
    <td width="49">&nbsp;</td>
    <td width="57">&nbsp;</td>
    <td width="66">&nbsp;</td>
    <td width="47">&nbsp;</td>
    <td width="108">&nbsp;</td>
    <td width="93">&nbsp;</td>
    <td width="87">&nbsp;</td>
    <td width="118">&nbsp;</td>
  </tr>
  <tr>
    <td height="21" colspan="2" style="border-width: 1px;border: solid;"><div align="left"><strong>ESCUELA:</strong></div></td>
    <td colspan="10" style="border-width: 1px;border: solid;"><div align="center">'.$nombreInstitucion.'</div></td>
    <td style="border-width: 1px;border: solid;"><div align="right"><strong>AREA</strong>:</div></td>
    <td colspan="5" style="border-width: 1px;border: solid;"><div align="center">'.$carreraAutorizacion.'</div></td>
  </tr>
  <tr>
    <td height="21" colspan="2" style="border-width: 1px;border: solid;"><strong>UBICACION:</strong></td>
    <td colspan="16" style="border-width: 1px;border: solid;"><div align="center">'.$direccion.', '.$ciudad.', '.$estado.'.</div></td>
  </tr>
  <tr>
    <td height="21">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="19" colspan="14" style="border-width: 1px;border: solid;"><center><div align="center" class="Estilo3">LLENADO POR LA INSTITUCIÓN EDUCATIVA</div></center></td>
    <td colspan="4" style="border-width: 1px;border: solid;"><center><div align="center" class="Estilo3">EXCLUSIVO PARA LA SECRETARIA DE EDUCACIÓN</div><center></td>
  </tr>
  <tr>
    <td height="41" style="border-width: 1px;border: solid;"><center><div align="center"><strong><span class="Estilo2">No. PROG.</span></strong></div></center></td>
    <td colspan="7" style="border-width: 1px;border: solid;"><center><div align="center"><strong><span class="Estilo2">NOMBRE DEL SUSTENTANTE</span></strong></div></center></td>
    <td colspan="2" style="border-width: 1px;border: solid;"><center><div align="center"><strong><span class="Estilo2">FECHA DE EXAMEN</span></strong></div></center></td>
    <td colspan="2" style="border-width: 1px;border: solid;"><center><div align="center"><strong><span class="Estilo2">OPORTUNIDAD</span></strong></div></center></td>
    <td colspan="2" style="border-width: 1px;border: solid;"><center><div align="center"><strong><span class="Estilo2">No. DE AUTORIZACION</span></strong></div></center></td>
    <td style="border-width: 1px;border: solid;"><center><div align="center"><strong><span class="Estilo2">FECHA DE AUTORIZACIÓN</span></strong></div></center></td>
    <td style="border-width: 1px;border: solid;"><center><div align="center"><strong><span class="Estilo2">AUTORIZADO</span></strong></div></center></td>
    <td style="border-width: 1px;border: solid;"><center><div align="center"><strong><span class="Estilo2">CANCELADO</span></strong></div></center></td>
    <td style="border-width: 1px;border: solid;"><center><div align="center"><strong><span class="Estilo2">OBSERVACIONES</span></strong></div></center></td>
    <td style="border-width: 1px;border: solid;"><center><div align="center"><strong><span class="Estilo2">N.CONTROL</span></strong></div></center></td>
  </tr>';



$html4='
</table>

</body>
</html>';

$res=$html.$html3.$html4;

   
        
        
    }
} else {
    $html = "Lo Sentimos No Se Pudo Realizar la Consulta";
}
//echo $html;


$footer = '
  <center>  <table  width="1142" height="424" border="0" style="border-collapse: collapse;">
<tr>
    <td height="21">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="21">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="21">&nbsp;</td>
    <td colspan="8" align="center"><center><div align="center"><u>LAE. FLORIBEL MEGCHUN DE LA CRUZ</u></div></center></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4" align="center"><div align="center" style="padding-top: 17px;">
                      <div align="center"><img src="../../../../../assets/img/Untitled-4_clip_image002.png" alt="" width="300
                      " height="2" /></div>
    </div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="21">&nbsp;</td>
    <td colspan="8" align="center"><center><div align="center">ENTREGO</div></center></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4" align="center"><center><div align="center">REVISO</div></center></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="21">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table></center>


';     
        
$mpdf=new mPDF('','Legal','',''); 
$mpdf->AddPage('L','','','','','','','','','','');
$mpdf->WriteHTML($res);

$mpdf->SetHTMLFooter($footer);
$mpdf->Output("Reporte_Sabana_Autorizaciones" . $today.'.pdf', 'I');
?> 

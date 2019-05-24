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
    
     //convertimos fechas
    $fechaSQL = explode("-",$rangoFechas);
    $fechaInicio=trim($fechaSQL[0]);
    $fechaFin=trim($fechaSQL[1]);
    
  //  01/07/2014 - 31/07/2014
    $fechaSQL = explode("/",$fechaInicio);
    $fechaInicio=$fechaSQL[2]."-".$fechaSQL[1]."-".$fechaSQL[0];   

    $fechaSQL = explode("/",$fechaFin);
    $fechaFin=$fechaSQL[2]."-".$fechaSQL[1]."-".$fechaSQL[0];   

    
    
    $Result = $Obras->ConReporteDocumentacionAlumnos($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fechaInicio, $fechaFin);
    if ($Result) {
        while($row2 = mysql_fetch_assoc($Result)){
             $htmlCuerpo.= "<tr>
                        <td height='21'>&nbsp;</td>
                        <td  style='border-width: 1px;border: solid;'>$row2[folioInstitucional]</td>
                        <td  style='border-width: 1px;border: solid;'>$row2[nombreCarrera]</td>
                        <td colspan='7'  style='border-width: 1px;border: solid;'>$row2[NombreCompleto]</td>
                        <td  style='border-width: 1px;border: solid;'>&nbsp;</td>
                        <td  style='border-width: 1px;border: solid;'>&nbsp;</td>
                      </tr>";
            $fechaaplicacion=$row2[fechaaplicacionReporte];
        }
        
        //obtenemos la fecha de aplicacion
        $fechaLetras = $Funciones->Fecha2($fechaaplicacion);

                      
        mysql_free_result($Result);
         $html.= "</table>";
    }
    
    
$htmlCabecera.='<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<table width="1000" height="317" border="0" style="border-collapse: collapse;">
  <tr>
    <td height="110" colspan="12"><center><div align="center"><img src="../../../../../assets/img/banners/banner_iesch.png" width="767" height="128" /></div></center></td>
  </tr>
  
  <tr>
    <td width="26" height="21">&nbsp;</td>
    <td width="151">&nbsp;</td>
    <td width="131">&nbsp;</td>
    <td width="117">&nbsp;</td>
    <td width="28">&nbsp;</td>
    <td width="62">&nbsp;</td>
    <td width="62">&nbsp;</td>
    <td width="62">&nbsp;</td>
    <td width="15">&nbsp;</td>
    <td width="3">&nbsp;</td>
    <td width="146">&nbsp;</td>
    <td width="147">&nbsp;</td>
  </tr>
  <tr>
    <td height="21" colspan="12"><center>
      <strong>REGISTRO DE ASISTENCIA EXAMEN POR AREAS DE CONOCIMIENTO GENERAL</strong>
    </center></td>
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
    <td colspan="4"><strong>FECHA: '.$fechaLetras.'</strong></td>
  </tr>
  

  <tr>
    <td height="21">&nbsp;</td>
    <td  align="center" style="border-width: 1px;border: solid;"><strong>No. FOLIO</strong></td>
    <td align="center" style="border-width: 1px;border: solid;"><strong>CARRERA</strong></td>
    <td colspan="7" align="center"  style="border-width: 1px;border: solid;"><strong>NOMBRE DEL SUSTENTANTE</strong></td>
    <td  align="center" style="border-width: 1px;border: solid;"><strong>FIRMA ENTRADA</strong></td>
    <td  align="center" style="border-width: 1px;border: solid;"><strong>FIRMA SALIDA</strong></td>
  </tr>
  
  
  
  ';



$htmlCuerpo.='
</table>
</body>
</html>

';
    
    
$html = $htmlCabecera.$htmlCuerpo;







} else {
    $html = "Lo Sentimos No Se Pudo Realizar la Consulta";
}

ob_start();
$mpdf=new mPDF('','Letter','',''); 
$mpdf->AddPage('L','','','','','','','','','','');
$mpdf->WriteHTML($html);
$mpdf->Output("Reporte_Registro_Asistencia_".$today.'.pdf','I');

?> 
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
             $htmlCuerpo.= "
                        <tr>
                           <td width='100' rowspan='2'  style='border-width: 1px;border: solid;'  align='center'><div align='center' class='Estilo1'>$row2[folioInstitucional]</div></td>
                           <td width='204' height='23'  style='border-width: 1px;border: solid;' align='center' ><div align='center' class='Estilo6'>CARRERA</div></td>
                           <td width='482' align='center'  style='border-width: 1px;border: solid;' ><div align='center' class='Estilo6'>NOMBRE DEL SUSTENTANTE</div></td>
                         </tr>
                         <tr>
                           <td height='43' align='center' style='border-width: 1px;border: solid;' ><div align='center' class='Estilo3'>$row2[nombreCarrera]</div></td>
                           <td align='center' style='border-width: 1px;border: solid;' ><div align='center' class='Estilo4'>$row2[NombreCompleto]</div></td>

                         </tr>

";
            $fechaaplicacion=$row2[fechaaplicacionReporte];
        }
        
        //obtenemos la fecha de aplicacion
        $fechaLetras = $Funciones->Fecha2($fechaaplicacion);

                      
        mysql_free_result($Result);
         $html.= "</table>
</body>
</html>";
    }
    
    
$htmlCabecera.='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo1 {
	font-size: 28px;
	font-weight: bold;
}
.Estilo3 {
	font-size: 15px;
	font-weight: bold;
}
.Estilo4 {
	font-size: 18px;
	font-weight: bold;
}
.Estilo6 {font-size: 14px; }
-->
</style>
</head>

<body>
<table width="836" height="72" border="0"   style="border-collapse: collapse;">
  
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
$mpdf->Output("Reporte_Recotables".$today.'.pdf','I');

?> 
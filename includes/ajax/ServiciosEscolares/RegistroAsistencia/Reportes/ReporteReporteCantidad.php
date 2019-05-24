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
 
  
    
    //convertimos fechas
    $fechaSQL = explode("-", $rangoFechas);
    $fechaInicio = trim($fechaSQL[0]);
    $fechaFin = trim($fechaSQL[1]);

    //  01/07/2014 - 31/07/2014
    //$fechaSQL = explode("/", $fechaInicio);
    //$fechaInicio = $fechaSQL[2] . "-" . $fechaSQL[1] . "-" . $fechaSQL[0];

    //$fechaSQL = explode("/", $fechaFin);
    //$fechaFin = $fechaSQL[2] . "-" . $fechaSQL[1] . "-" . $fechaSQL[0];





  
    
    $result = $Obras->obtCarrerasActivas();
    while($rowCarr = mysql_fetch_assoc($result)){
     $resultCantidad = $Obras->ConReporteDocumentacionAlumnosContador($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fechaInicio, $fechaFin);
          while($rowCantidad = mysql_fetch_assoc($resultCantidad)){
                $cantidadAlumnos = $rowCantidad['cantidadAlumnos'];
                $granTotal=$granTotal+$cantidadAlumnos; 
$fechaaplicacion = $row[FechaExamen];
  
                           
           }
     
       
            $html2 = "<tr>
                       <td height='21'></td>
                       <td colspan='2'  style='border-width: 1px;border: solid;'>$cantidadAlumnos</td>
                       <td colspan='7'  style='border-width: 1px;border: solid;'>$rowCarr[nombreCarrera]</td>
                       <td align='center'  style='border-width: 1px;border: solid;' >$rowCarr[nombreMod]</td>
                       <td>&nbsp;</td>
                     </tr> ";

                        $html4 = $html4 . $html2;
       
    }


    
$html3 = '
</table></center>

Total de Alumnos: '.$granTotal.'
</body>
</html>

';




    $html = '<html>
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
    <td width="110" height="21">&nbsp;</td>
    <td width="67">&nbsp;</td>
    <td width="166">&nbsp;</td>
    <td width="82">&nbsp;</td>
    <td width="28">&nbsp;</td>
    <td width="62">&nbsp;</td>
    <td width="62">&nbsp;</td>
    <td width="62">&nbsp;</td>
    <td width="15">&nbsp;</td>
    <td width="191">&nbsp;</td>
    <td width="13">&nbsp;</td>
    <td width="92">&nbsp;</td>
  </tr>
  <tr>
    <td height="21" colspan="12"><center>
      <strong>CANTIDAD DE ALUMNOS PARA EL EXAMEN INSTITUCIONAL POR CARRERAS</strong>
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
    <td colspan="4"><strong>FECHA: ' . $fechaaplicacion  . '</strong></td>
  </tr>
  

   <tr>
    <td height="21">&nbsp;</td>
    <td colspan="2"  align="center" style="border-width: 1px;border: solid;"><strong>CANTIDAD</strong><strong></strong></td>
    <td colspan="7" align="center"  style="border-width: 1px;border: solid;"><strong>CARRERA</strong></td>
    <td align="center"  style="border-width: 1px;border: solid;"><strong>MODALIDAD</strong></td>
    <td  align="center">&nbsp;</td>
  </tr>
  
  
  ';



    $res = $html . $html4 . $html3;

    

	
    
  
    
} else {
    $html = "Lo Sentimos No Se Pudo Realizar la Consulta";
}

//echo $html;
ob_start();
$mpdf = new mPDF();
//$mpdf->AddPage('L', '', '', '', '', '', '', '', '', '', '');
$mpdf->WriteHTML($res);
$mpdf->Output("Reporte_CantidadAlumnos_" . $today.'.pdf', 'I');
?> 
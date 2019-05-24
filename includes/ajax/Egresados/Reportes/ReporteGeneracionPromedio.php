<?php

//$timeo_start = microtime(true);
//ini_set("memory_limit","4096M");

require_once('../../../../includes/Config.class.php');  # Cargar datos conexion y otras variables.
require_once('../../../../includes/DB.class.php');
require_once('../../../../includes/ConsultaDB.class.php');
require_once('../../../../mpdf/mpdf.php');


$Obras = new ConsultaDB;

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

        $nombreInstitucion =strtoupper( $row333['nombreInstitucion']);
        $apodoInstitucion = $row333['apodoInstitucion'];
        $clave = $row333['clave'];
        $direccion = $row333['direccion'];
        $telefono = $row333['telefono'];
        $fechaIncorporacionsecretaria = $row333['fechaIncorporacionSrecetaria'];
        $numerooficio = $row333['noOficio'];
        $registro = $row333['registro'];
        $regimen = $row333['regimen'];
        $paginainternet = $row333['paginaInternet'];
        $lemaescuela = $row333['lemaEscuela'];
    }
    
    
    $Result1 = $Obras->PromedioEgresados($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion);
    if ($Result1) {
        $row1 = mysql_fetch_assoc($Result1);
        $Promedio = $row1['Promedio'];
        $Promedio= number_format($Promedio, 1);
            $generacionLista = $row1['DescripcionGeneracion'];

        mysql_free_result($Result1);
    }
    
        $Result2 = $Obras->PromedioEgresadosHombres($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion);
    if ($Result2) {
        $row2 = mysql_fetch_assoc($Result2);
        $promedioTotalEgresadosHombres = $row2['promedioTotalEgresadosHombres'];
        $promedioTotalEgresadosHombres= number_format($promedioTotalEgresadosHombres, 1);


        mysql_free_result($Result2);
    }
    
        $Result3 = $Obras->PromedioEgresadosMujeres($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion);
    if ($Result3) {
        $row3 = mysql_fetch_assoc($Result3);
        $promedioTotalEgresadosMujeres = $row3['promedioTotalEgresadosMujeres'];
                $promedioTotalEgresadosMujeres= number_format($promedioTotalEgresadosMujeres, 1);


        mysql_free_result($Result3);
    }
	
        $Result4 = $Obras->PromedioEgresadosDiecinueve($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion);
    if ($Result4) {
        $row4 = mysql_fetch_assoc($Result4);
        $promedioTotalEgresadosDiecinueve = $row4['promedioTotalEgresadosDiecinueve'];
                        $promedioTotalEgresadosDiecinueve= number_format($promedioTotalEgresadosDiecinueve, 1);


        mysql_free_result($Result4);
    }	
    
    
         $Result5 = $Obras->PromedioEgresadosVeinte($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion);
    if ($Result5) {
        $row5 = mysql_fetch_assoc($Result5);
        $promedioTotalEgresadosVeinte = $row5['promedioTotalEgresadosVeinte'];
        $promedioTotalEgresadosVeinte= number_format($promedioTotalEgresadosVeinte, 1);


        mysql_free_result($Result5);
    }
    
        $Result6 = $Obras->PromedioEgresadosVeinticinco($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion);
    if ($Result6) {
        $row6 = mysql_fetch_assoc($Result6);
        $promedioTotalEgresadosVeinticinco = $row6['promedioTotalEgresadosVeinticinco'];
        $promedioTotalEgresadosVeinticinco= number_format($promedioTotalEgresadosVeinticinco, 1);


        mysql_free_result($Result6);
    }
           
    $Result7 = $Obras->PromedioEgresadosTreinta($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion);
    if ($Result7) {
        $row7 = mysql_fetch_assoc($Result7);
        $promedioTotalEgresadosTreinta = $row7['promedioTotalEgresadosTreinta'];
        $promedioTotalEgresadosTreinta= number_format($promedioTotalEgresadosTreinta, 1);


        mysql_free_result($Result7);
    }
    
    if($fk_modalidad == '1'){
        $modalidad="SEMESTRAL" ;      
    }elseif($fk_modalidad == '2' ){
        $modalidad="CUATRIMESTRAL";
    }elseif($fk_modalidad == '3' ){
        $modalidad="TRIMESTRAL";
    }elseif($fk_modalidad == '4' ){
        $modalidad="PENTAMESTRAL";
    }


    $html1 = '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo1 {font-size: 11px}
-->
</style>
</head>

<body>

<table width="960" border="0" style=" border-collapse: absolute; border-spacing:  0px;" align="center">
<tr>
    <td colspan="1" rowspan="5" align="center"><div><img src="../../../../assets/img/IESCH.png" width="100" height="100" /></div></td>
    <td colspan="4"><center><div align="center"><strong>'.$nombreInstitucion.'</strong></div></center></td>
    <td colspan="1" rowspan="5" align="center"><div align="center"><img src="../../../../assets/img/fimpes.png" width="100" height="100" /></div></td>
  </tr>
  <tr>
    <td colspan="4"><center><div align="center"><strong>INCORPORADO A LA  SECRETARIA DE EDUCACIÓN</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan="4"><center><div align="center"><strong>OFICIO No. ' . $numerooficio . ' DE FECHA ' . $fechaIncorporacionsecretaria . '</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan="4"><center><div align="center"><strong>RÉGIMEN: ' . $regimen . '    CLAVE: </strong><strong>' . $clave . '</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan="4"><center><div align="center"><strong>EXCELENCIA ACADÉMICA: REG. ' . $registro . '  </strong></div>
    </center></td>
  </tr> 
    <tr>
    <td width="">&nbsp;</td>
    <td width="">&nbsp;</td>
    <td width="">&nbsp;</td>
    <td width="">&nbsp;</td>
    <td width="">&nbsp;</td>
    <td width="">&nbsp;</td>
  </tr>
 <tr>
    <td colspan="6"><center><div align="center" style="font-size:14px;"><strong>CARRERA:</strong> ' . $carreraReporte . ' <strong>  MODALIDAD:</strong> '.$modalidad.'</div></center></td>
  </tr>
  <tr>
    <td width="">&nbsp;</td>
    <td width="">&nbsp;</td>
    <td width="">&nbsp;</td>
    <td width="">&nbsp;</td>
    <td width="">&nbsp;</td>
    <td width="">&nbsp;</td>
  </tr>
  <tr>
    <td width="">&nbsp;</td>
    <td width="">&nbsp;</td>
    <td width="">&nbsp;</td>
    <td width="">&nbsp;</td>
    <td width="">&nbsp;</td>
    <td width="">&nbsp;</td>
  </tr>  
  <tr>
    <td width="">&nbsp;</td>
    <td width="">&nbsp;</td>
    <td width="">&nbsp;</td>
    <td width="">&nbsp;</td>
    <td width="">&nbsp;</td>
    <td width="">&nbsp;</td>
  </tr>  
  <tr>
    <td width="">&nbsp;</td>
    <td width="">&nbsp;</td>
    <td width="">&nbsp;</td>
    <td width="">&nbsp;</td>
    <td width="">&nbsp;</td>
    <td width="">&nbsp;</td>
  </tr>
 
</table>

<table width="560" border="1" style=" border-collapse: absolute; border-spacing:  0px;" align="center"  cellpadding="5">
  
<tr>
    <td width="" height="30px" bgcolor="" align=""><span class="Estilo1">PROMEDIO DE CALIFICACIÓN DE LOS EGRESADOS</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$Promedio.'</span></td>
</tr>
<tr>
    <td width=""height="30px" bgcolor="" align=""><span class="Estilo1">PROMEDIO DE ALUMNOS HOMBRES</span></td>
    <td width=""height="20px" bgcolor="" align="center"><span class="Estilo1">'.$promedioTotalEgresadosHombres.'</span></td>
</tr>
<tr>
    <td width="" height="30px" bgcolor="" align=""><span class="Estilo1">PROMEDIO DE ALUMNOS MUJERES</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$promedioTotalEgresadosMujeres.'</span></td>
</tr>
<tr>
    <td width="" height="30px" bgcolor="" align=""><span class="Estilo1">PROMEDIO DE ALUMNOS DE 19 AÑOS Ó MENOS</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$promedioTotalEgresadosDiecinueve.'</span></td>
</tr>
<tr>
    <td width="" height="30px" bgcolor="" align=""><span class="Estilo1">PROMEDIO DE ALUMNOS DE 20 A 24 AÑOS</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$promedioTotalEgresadosVeinte.'</span></td>
</tr>
<tr>
    <td width="" height="30px" bgcolor="" align=""><span class="Estilo1">PROMEDIO DE ALUMNOS DE 25 A 29 AÑOS</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$promedioTotalEgresadosVeinticinco.'</span></td>

</tr>
<tr>
    <td width="" height="30px" bgcolor="" align=""><span class="Estilo1">PROMEDIO DE ALUMNOS DE 30 AÑOS Ó MAS</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$promedioTotalEgresadosTreinta.'</span></td>

</tr>
<tr>
    <td width="" height="20px" bgcolor="" align=""><span class="Estilo1">PROMEDIO DE ALUMNOS CON DISCAPACIDAD</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1"></span></td>

</tr>
  
  ';






         $html2.= "</table></div>
		 </body>
</html>";
    $res = $html1 . $html2 . $html3;

}


    

//echo $res;





$mpdf=new mPDF('','A4','',''); 
$mpdf->AddPage('A4','','','','','','','','','','');
$mpdf->SetFooter(''.$generacionLista.'   | Fuente: Departamento de Egresados | Pagina {PAGENO}');
$mpdf->WriteHTML($res);
$mpdf->Output("ReporteGeneracionPorPromedio".$today.'.pdf','I');

?> 

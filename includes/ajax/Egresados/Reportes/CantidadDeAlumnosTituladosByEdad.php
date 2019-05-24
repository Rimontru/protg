<?php 
require_once('../../../../includes/Config.class.php');  # Cargar datos conexion y otras variables.
require_once('../../../../includes/DB.class.php');
require_once('../../../../includes/ConsultaDB.class.php');
require_once('../../../../mpdf/mpdf.php');


$Obras = new ConsultaDB;

if (isset($_GET['fk_nivelestudio'])) {
    $fk_nivelestudio = $_GET['fk_nivelestudio'];
    $fk_modalidad = $_GET['fk_modalidad'];
    $fk_carreras = $_GET['fk_carreras'];


    $rangoFechas = $_GET['rangoFechas'];
   
    //convertimos fechas
    $fechaSQL = explode("-", $rangoFechas);
    $fechaInicio = trim($fechaSQL[0]);
    $fechaFin = trim($fechaSQL[1]);

    //  01/07/2014 - 31/07/2014
    $fechaSQL = explode("/", $fechaInicio);
    $fechaInicio = $fechaSQL[2] . "-" . $fechaSQL[1] . "-" . $fechaSQL[0];

    $fechaSQL = explode("/", $fechaFin);
    $fechaFin = $fechaSQL[2] . "-" . $fechaSQL[1] . "-" . $fechaSQL[0];
    
    
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
    



    
    $rango1 = 0; $rango2 = 0; $rango3 = 0; $rango4 = 0;
    $mujer =0;
    $hombre=0;
    $discapacidad=0;

$result33 = $Obras->ConReporteAlumnosTituladosByFecha($fk_nivelestudio, $fk_modalidad, $fk_carreras,$fechaInicio, $fechaFin);
if ($result33) {
    while ($row33 = mysql_fetch_assoc($result33)) {
        
        
    $FechaExpTitulo = $row33['fechaexpediciontitulo'];
    

        if(trim($row33['fk_genero'])=="1"){
            $hombre = $hombre+1;
        }
        else if(trim($row33['fk_genero'])=="2"){
            $mujer = $mujer+1;
        }


        if($row33['edadEgreso'] <= 19){
        	$rango1=$rango1+1;
        }

        else if($row33['edadEgreso'] > 19 && $row33['edadEgreso'] <= 24){
        	$rango2=$rango2+1;
        }

        else if($row33['edadEgreso'] > 24 && $row33['edadEgreso'] <= 29){
        	$rango3=$rango3+1;
        }

        else if($row33['edadEgreso'] > 29){
        	$rango4=$rango4+1;
        }

        else if($row33['Discapacidad'] == 1){
        	$discapacidad=$discapacidad+1;
        }


    }
    mysql_free_result($result33);
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
	<td colspan="6"><center><div align="center" style="font-size:;"><strong>EGRESADOS TITULADOS POR EDAD</strong></div></center></td>
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
</table>

<table width="560" border="1" style=" border-collapse: absolute; border-spacing:  0px;" align="center"  cellpadding="5">
<tr>
    <td width="" height="30px" bgcolor="" align=""><span class="Estilo1">EGRESADOS TITULADOS</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">TOTAL</span></td>
</tr>  
<tr>
    <td width="" height="30px" bgcolor="" align=""><span class="Estilo1">N°. ALUMNOS TITULADOS DEL PROGRAMA</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.($hombre + $mujer).'</span></td>
</tr>
<tr>
    <td width=""height="30px" bgcolor="" align=""><span class="Estilo1">N°. ALUMNOS HOMBRES</span></td>
    <td width=""height="20px" bgcolor="" align="center"><span class="Estilo1">'.$hombre.'</span></td>
</tr>
<tr>
    <td width="" height="30px" bgcolor="" align=""><span class="Estilo1">N°. ALUMNOS MUJERES</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$mujer.'</span></td>
</tr>
<tr>
    <td width="" height="30px" bgcolor="" align=""><span class="Estilo1">N°. ALUMNOS DE 19 AÑOS Ó MENOS</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$rango1.'</span></td>
</tr>
<tr>
    <td width="" height="30px" bgcolor="" align=""><span class="Estilo1">N°. ALUMNOS DE 20 A 24 AÑOS</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$rango2.'</span></td>
</tr>
<tr>
    <td width="" height="30px" bgcolor="" align=""><span class="Estilo1">N°. ALUMNOS DE 25 A 29 AÑOS</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$rango3.'</span></td>

</tr>
<tr>
    <td width="" height="30px" bgcolor="" align=""><span class="Estilo1">N°. ALUMNOS DE 30 AÑOS Ó MAS</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$rango4.'</span></td>

</tr>
<tr>
    <td width="" height="20px" bgcolor="" align=""><span class="Estilo1">N° ALUMNOS CON DISCAPACIDAD</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$discapacidad.'</span></td>

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
$mpdf->SetFooter('| Fuente: Departamento de Egresados | Pagina {PAGENO}');
$mpdf->WriteHTML($res);
$mpdf->Output("ReporteAlumnosTituladosPorEdad".$today.'.pdf','I');


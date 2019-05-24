<?php 
require_once('../../../../includes/Config.class.php');  # Cargar datos conexion y otras variables.
require_once('../../../../includes/DB.class.php');
require_once('../../../../includes/ConsultaDB.class.php');
require_once('../../../../mpdf/mpdf.php');


$Obras = new ConsultaDB;

if ( !isset($_GET['fk_nivelestudio']) ) 
    die('Parametros esperados...');


    $fk_nivelestudio = $_GET['fk_nivelestudio'];
    $fk_modalidad = $_GET['fk_modalidad'];
    $fk_carreras = $_GET['fk_carreras'];
    $fk_generacion = $_GET['fk_generacion'];
   
 
    $Result22 = $Obras->verTrabajadoresDirectoresReportes($fk_carreras);
    if ($Result22) {
        $row222 = mysql_fetch_assoc($Result22);
        $nombreDirector = ($row222['NombreCompletoDirector']);
        $carreraReporte = ($row222['nombreCarrera']);

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

    $Result_ge = $Obras->ConsultaGeneracionesPorLLavePrimaria($fk_generacion);
    if ($Result_ge) {
        $row_gen = mysql_fetch_assoc($Result_ge);

        $nombreGeneracion =strtoupper( $row_gen['GeneracionDescripcion']);
    }

    $edades = array('<=21', '=22', '=23', '=24', '=25', 'BETWEEN "26" AND "29"', '>=30');
    $egre_h = array();
    $egre_m = array();
    $titu_h = array();
    $titu_m = array();

    //HOMBRES EGRESADO POR RANGO DE EDAD
    foreach ($edades as $key => $edad) {
        $_result = $Obras->ConCantidadEgresadosEdadYGenero($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fk_generacion, $edad, 1);
        $_row = mysql_fetch_assoc($_result);
        $egre_h[$key] = $_row['cantidadTotal'];
    }

    //MUJERES EGRESADO POR RANGO DE EDAD
    foreach ($edades as $key => $edad) {
        $_result = $Obras->ConCantidadEgresadosEdadYGenero($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fk_generacion, $edad, 2);
        $_row = mysql_fetch_assoc($_result);
        $egre_m[$key] = $_row['cantidadTotal'];
    }

    //HOMBRES TITULADO POR RANGO DE EDAD
    foreach ($edades as $key => $edad) {
        $_result = $Obras->ConCantidadTituladosEdadYGenero($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fk_generacion, $edad, 1);
        $_row = mysql_fetch_assoc($_result);
        $titu_h[$key] = $_row['cantidadTotal'];
    }

    //MUJERES TITULADO POR RANGO DE EDAD
    foreach ($edades as $key => $edad) {
        $_result = $Obras->ConCantidadTituladosEdadYGenero($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fk_generacion, $edad, 2);
        $_row = mysql_fetch_assoc($_result);
        $titu_m[$key] = $_row['cantidadTotal'];
    }

    /*var_dump($egre_m);
    die;*/
    
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
    <td colspan="6"><center><div align="center" style="font-size:;"><strong>EGRESADOS Y TITULADOS POR EDAD</strong></div></center></td>
  </tr>
 <tr>
    <td colspan="6"><center><div align="center" style="font-size:14px;"><strong>CARRERA:</strong> ' . $carreraReporte . ' <strong>  MODALIDAD:</strong> '.$modalidad.'</div></center></td>
  </tr>
  <tr>
    <td colspan="6"><center><div align="center" style="font-size:14px;"><strong>GENERACIÓN:</strong> ' . $nombreGeneracion . ' <strong> </div></center></td>
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

<table width="1200" border="1" style=" border-collapse: absolute; border-spacing:  0px;" align="center"  cellpadding="5">
<tr>
    <td width="300" height="30px" bgcolor="" align=""><span class="Estilo1">&nbsp;</span></td>
    <td colspan="3" height="20px" bgcolor="" align="center"><span class="Estilo1"><b>EGRESADOS</b></span></td>
    <td colspan="3" height="20px" bgcolor="" align="center"><span class="Estilo1"><b>TITULADOS</b></span></td>
</tr>
<tr>
    <td width="300" height="30px" bgcolor="" align=""><span class="Estilo1">&nbsp;</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1"><b>HOMBRES</b></span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1"><b>MUJERES</b></span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1"><b>TOTAL</b></span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1"><b>HOMBRES</b></span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1"><b>MUJERES</b></span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1"><b>TOTAL</b></span></td>
</tr>
<tr>
    <td width="300" height="30px" bgcolor="" align=""><span class="Estilo1">N°. ALUMNOS DE 21 AÑOS Ó MENOS</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$egre_h[0].'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$egre_m[0].'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.($egre_h[0] + $egre_m[0]).'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$titu_h[0].'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$titu_m[0].'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.($titu_h[0] + $titu_m[0]).'</span></td>
</tr>
<tr>
    <td width="300" height="30px" bgcolor="" align=""><span class="Estilo1">N°. ALUMNOS DE 22 AÑOS</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$egre_h[1].'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$egre_m[1].'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.($egre_h[1] + $egre_m[1]).'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$titu_h[1].'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$titu_m[1].'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.($titu_h[1] + $titu_m[1]).'</span></td>
</tr>
<tr>
    <td width="300" height="30px" bgcolor="" align=""><span class="Estilo1">N°. ALUMNOS DE 23 AÑOS</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$egre_h[2].'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$egre_m[2].'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.($egre_h[2] + $egre_m[2]).'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$titu_h[2].'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$titu_m[2].'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.($titu_h[2] + $titu_m[2]).'</span></td>
</tr>
<tr>
    <td width="300" height="30px" bgcolor="" align=""><span class="Estilo1">N°. ALUMNOS DE 24 AÑOS</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$egre_h[3].'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$egre_m[3].'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.($egre_h[3] + $egre_m[3]).'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$titu_h[3].'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$titu_m[3].'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.($titu_h[3] + $titu_m[3]).'</span></td>
</tr>
<tr>
    <td width="300" height="30px" bgcolor="" align=""><span class="Estilo1">N°. ALUMNOS DE 25 AÑOS</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$egre_h[4].'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$egre_m[4].'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.($egre_h[4] + $egre_m[4]).'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$titu_h[4].'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$titu_m[4].'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.($titu_h[4] + $titu_m[4]).'</span></td>
</tr>
<tr>
    <td width="300" height="30px" bgcolor="" align=""><span class="Estilo1">N°. ALUMNOS DE 26 A 29 AÑOS</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$egre_h[5].'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$egre_m[5].'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.($egre_h[5] + $egre_m[5]).'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$titu_h[5].'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$titu_m[5].'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.($titu_h[5] + $titu_m[5]).'</span></td>
</tr>
<tr>
    <td width="300" height="30px" bgcolor="" align=""><span class="Estilo1">N°. ALUMNOS DE 30 AÑOS Ó MAS</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$egre_h[6].'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$egre_m[6].'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.($egre_h[6] + $egre_m[6]).'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$titu_h[6].'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.$titu_m[6].'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.($titu_h[6] + $titu_m[6]).'</span></td>
</tr> 

<tr>
    <td width="300" height="30px" bgcolor="" align=""><span class="Estilo1"><b>Total</b></span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.array_sum($egre_h).'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.array_sum($egre_m).'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.(array_sum($egre_h) + array_sum($egre_m)).'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.array_sum($titu_h).'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.array_sum($titu_m).'</span></td>
    <td width="" height="20px" bgcolor="" align="center"><span class="Estilo1">'.(array_sum($titu_h) + array_sum($titu_m)).'</span></td>
</tr> 
';

$html2.= "</table></div></body></html>";

$res = $html1 . $html2;

$mpdf=new mPDF('','A4','',''); 
$mpdf->AddPage('A4','','','','','','','','','','');
$mpdf->SetFooter('| Fuente: Departamento de Egresados | Pagina {PAGENO}');
$mpdf->WriteHTML($res);
$mpdf->Output("ReporteAlumnosTituladosPorEdad".$today.'.pdf','I');


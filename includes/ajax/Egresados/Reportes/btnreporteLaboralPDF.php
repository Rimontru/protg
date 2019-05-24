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
$fecha = date("d/m/Y");
$fk_estadoTitulacion = $_GET['fk_estadoTitulacion'];

error_reporting(0);

if (isset($_GET['fk_nivelestudio'])) {
    $fk_nivelestudio = $_GET['fk_nivelestudio'];
    $fk_modalidad = $_GET['fk_modalidad'];
    $fk_carreras = $_GET['fk_carreras'];
    $fk_generacion = $_GET['fk_generacion'];

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
        $ciudad = $row333['CiudadEscuela'];
        $estado = $row333['EstadoEscuela'];
        $fechaIncorporacionsecretaria = $row333['fechaIncorporacionSrecetaria'];
        $numerooficio = $row333['noOficio'];
        $registro = $row333['registro'];
        $regimen = $row333['regimen'];
        $paginainternet = $row333['paginaInternet'];
        $lemaescuela = $row333['lemaEscuela'];
    }


    
    
    
    


    $result33 = $Obras->ConReporteAlumnosInformacionBasica($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fk_generacion);
	$row33 = mysql_fetch_assoc($result33);
	$generacion=$row33['DescripcionGeneracion'];
	
	mysql_free_result($result33);
    $fechaSQL = explode("-", $fecha);
    
    $html = '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo1 {font-size: 10px;}
.Estilo2 {font-size: 12px; font-weight: bold;}
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
    <td colspan="8"><center><div align="center"><strong>RÉGIMEN: '.$regimen.'    CLAVE: </strong><strong>'.$clave.'</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan="8"><center><div align="center"><strong>EXCELENCIA ACADÉMICA: REG. '.$registro.'  </strong></div>
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
</table>


<table width="785" border="0" align="center">

  
  <tr>
 	<td colspan="6">DESARROLLO LABORAL</td>
 </tr>
 <tr>
    <td colspan="6">'.$carreraReporte.": ".$generacion.'</td>
 </tr>
</table>

<table width="988" height="48" border="0" align="center"  id="Exportar_a_Excel">
  <tr>
  <td width="48"   align="center" bgcolor="#999999"><span class="Estilo1">No.</span></td>
    <td width="48"   align="center" bgcolor="#999999"><span class="Estilo1">Matrícula</span></td>
    <td width="162"  align="center" bgcolor="#999999"><span class="Estilo1">Nombre</span></td>
    <td width="105"  align="center" bgcolor="#999999"><span class="Estilo1">Trabaja Actualmente</span></td>
    <td width="105"  align="center" bgcolor="#999999"><span class="Estilo1">Nombre Empresa</span></td>
    <td width="105"  align="center" bgcolor="#999999"><span class="Estilo1">Puesto </span></td>
    <td width="105"  align="center" bgcolor="#999999"><span class="Estilo1">Dirección Empresa</span></td>
    <td width="105"  align="center" bgcolor="#999999"><span class="Estilo1">Teléfono Empresa</span></td>
    <td width="105"  align="center" bgcolor="#999999"><span class="Estilo1">Mail</span></td>
    <td width="110"  align="center" bgcolor="#999999"><span class="Estilo1">jefe inmediato</span></td>
  </tr>
  
  
  ';
$trabajan = 0;  
$contador2=1;
$result33 = $Obras->ConReporteAlumnosInformacionBasica($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fk_generacion);
 if ($result33) {
        while ($row33 = mysql_fetch_assoc($result33)) {
            
		if($row33['estatusTrabajo']=="1"){
                        $estatusTrabajo="Si";
                        $trabajan++;
                    }else{
                        $estatusTrabajo="No";
                    }
                    
                    $html2 = "<tr class='Estilo1'>
                                <td class='Estilo1' width='24'><span class='Estilo1'>$contador2</span></td>
                                <td class='Estilo1'><span class='Estilo1'>".$row33['matricula']."</span></td>
                                <td class='Estilo1'><span class='Estilo1'>".$row33['NombreCompleto']."</span></td>
                                <td class='Estilo1'><span class='Estilo1'>".$estatusTrabajo."</span></td>
                                <td class='Estilo1'><span class='Estilo1'>".$row33['nombreEmpresaTrabajo']."</span></td>
                                <td class='Estilo1'><span class='Estilo1'>".$row33['puestoTrabajo']."</span></td>
                                <td class='Estilo1'><span class='Estilo1'>".$row33['direccionTrabajo']."</span></td>
                                <td class='Estilo1'><span class='Estilo1'>".$row33['telefonoTrabajo']."</span></td>
                                <td class='Estilo1'><span class='Estilo1'>".$row33['correoTrabajo']."</span></td>
                                <td class='Estilo1'><span class='Estilo1'>".$row33['nombreJefeInmediato']."</span></td>
                              </tr>
                                ";

        $html4 = $html4 . $html2;
        $contador2=$contador2+1;
        }
        mysql_free_result($result33);
    }

    
    $hmtl6 = '

        <tr>
            <td colspan="1"><span class="Estilo2" style="float:left;">&nbsp;</span></td>
            <td colspan="3">
                <span class="Estilo2" style="float:left;">ALUMNOS EGRESADOS: </span>
                <span class="Estilo2" style="float:right;">'.($contador2 - 1).'</span>
            </td>
            <td colspan="3">
                <span class="Estilo2" style="float:left;">LABORANDO: </span>
                <span class="Estilo2" style="float:right;">'.$trabajan.'</span>
            </td>
            <td colspan="3">
                <span class="Estilo2" style="float:left;">PORCENTAJE: </span>
                <span class="Estilo2" style="float:right;">'.round(($trabajan/$contador2)*100).'%</span>
            </td>
        </tr>
    ';

    $html3 = '</table>


</body>
</html>
';


    $res = $html . $html4 . $hmtl6. $html3;
    
    
    
    


} else {
    $html = "Lo Sentimos No Se Pudo Realizar la Consulta";
}
//echo $res;


$mpdf=new mPDF('','Letter','',''); 
$mpdf->AddPage('L','','','','','','','','','','');
$mpdf->WriteHTML($res);
$mpdf->Output("ReporteLaboral_" . $today.'.pdf', 'I');
?> 

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
    $fk_estadoTitulacion = $_GET['fk_estadoTitulacion'];


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

        $nombreInstitucion = strtoupper ($row333['nombreInstitucion']);
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

		
		$result= $Obras->ConReporteAlumnosInformacionBasicaGeneracion($fk_generacion);
    	if($result){
			$row=mysql_fetch_assoc($result);
			$DescripcionGeneracion=$row['DescripcionGeneracion'];
		}
    
    
    


   
    $html = '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo1 {font-size: 10px}
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
    <td colspan="6">'.$carreraReporte.' GENERACIÓN '.$DescripcionGeneracion.'</td>
  </tr>
</table>

<table width="1151" border="0" align="center"   id="Exportar_a_Excel">
  <tr>
    <td width="44"  align="center" bgcolor="#999999" rowspan="2"><p>No</p></td> 
    <td width="72"   align="center" bgcolor="#999999" rowspan="2"><p>Matrícula</p></td>
    <td width="208"  align="center" bgcolor="#999999" rowspan="2"><p>Nombre</p></td>
    <td width="219" rowspan="2"  align="center" bgcolor="#999999"><p>Domicilio</p></td>
    <td width="101"  align="center" bgcolor="#999999" rowspan="2"><p>Ciudad</p></td>
    <td width="44"  align="center" bgcolor="#999999" rowspan="2"><p>Código Postal</p></td>    
    <td  align="center" bgcolor="#999999" colspan="2"><p>Telefonos</p></td>
    <td align="center" bgcolor="#999999"  width="111" rowspan="2"><p>Correo</p></td>
    <td align="center" bgcolor="#999999"  width="111" rowspan="2"><p>Edad de Egreso</p></td>
    <td align="center" bgcolor="#999999"  width="" rowspan="2"><p>Genero</p></td>
    <td align="center" bgcolor="#999999"  width="" rowspan="2"><p>Curp</p></td>
    <td align="center" bgcolor="#999999"  width="" rowspan="2"><p>Nacimiento</p></td>
  </tr>
  <tr>
    <td width="68" height="21"  align="center" bgcolor="#999999"><p>Celular</p></td>
    <td width="73"  align="center" bgcolor="#999999"><p>Casa</p></td>
  </tr>
  
  
  ';
$contador2=1;
 $result33 = $Obras->ConReporteAlumnosInformacionBasica($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fk_generacion, $fk_estadoTitulacion);
    $fechaSQL = explode("-", $fecha);
//$row33 = mysql_fetch_assoc($result33);

 if ($result33) {
        while ($row33 = mysql_fetch_assoc($result33)) {
                    $html2 = "<tr class='Estilo1'>
                                <td height='24'>$contador2</td>
                                <td>".$row33['matricula']."</td>
                                <td>".$row33['NombreCompleto']."</td>
                                <td>".$row33['DescripcionColonia'].", ".$row33['DescripcionMunicipio'].", ".$row33['direccion']."</td>
                                <td>".$row33['DescripcionEstado']."</td>
                                <td height='24'>".$row33['cod_postal']."</td>
                                <td>".$row33['telefonocelular']."</td>
                                <td>".$row33['telefonofijo']."</td>
                                <td>".$row33['correo']."</td>
                                <td>".$row33['edadEgreso']."</td>
                                <td>".$row33['DescripcionGenero']."</td>
                                                   <td>".$row33['curp']."</td>
                                                   <td>".$row33['FechaNacimiento']."</td>

                              </tr>";

        $html4 = $html4 . $html2;
        $contador2=$contador2+1;
        }
        mysql_free_result($result33);
    }

    
    $html3 = '</table>


</body>
</html>
';


    $res = $html . $html4 . $html3;
    
    
    
    


} else {
    $html = "Lo Sentimos No Se Pudo Realizar la Consulta";
}
//echo $res;


$mpdf=new mPDF('','Letter','',''); 
$mpdf->AddPage('L','','','','','','','','','','');
$mpdf->WriteHTML($res);
$mpdf->Output("ReporteInformacionPersonal_" . $today.'.pdf', 'I');
?> 

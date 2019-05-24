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





if ( isset($_GET['type_search']) ) {
  


    $Result32 = $Obras->ConsultaDatosInsitucionConEstados();
    if ($Result32) {
        $row333 = mysql_fetch_assoc($Result32);

        $nombreInstitucion = $row333['nombreInstitucion'];
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


    
    
    

$html = '
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>

<table width="785" border="0" align="center">
<tr>
    <td colspan="2" rowspan="6"><div align="center"><img src="../../../../assets/img/IESCH.png" width="117" height="121" /></div></td>
    <td colspan="8"><center><div align="center"><strong>'.strtoupper($nombreInstitucion).'</strong></div></center></td>
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
  <tr>
    <td colspan="12">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="12"><center><b>Egresados en Paz Descanse</td>
  </tr>

</table>
';



$html10 ='
<table width="785" border="0" align="center">  
    <tr>
        <td><center>#</center></td>
        <td><center>Matricula</center></td>
        <td><center>Nombre</center></td>
        <td><center>E-mail</center></td>
        <td><center>Cel.</center></td>
        <td><center>Carrera</center></td>
        <td><center>Num. Generación</center></td>
    </tr>
';

$result423 = $Obras->busquedaPorParametrosMuertos();
$cont = 0;

if($result423){ 
    while ( $row = mysql_fetch_array($result423) ) { 
    	
        $cont++;

        $html10 .= '
	       	<tr>
	            <td>'.$cont.'</td>
	            <td align="left">'.$row['matricula'].'</td>
	            <td>'.$row['nombre'].' '.$row['apaterno'].' '.$row['amaterno'].'</td>
	            <td>'.$row['correo'].'</td>
	            <td>'.$row['telefonocelular'].'</td>
	            <td>'.$row['nombreCarrera'].'</td>
	            <td><center>'.$row['generacionNumero'].'</center></td>
	        </tr>';
	       
    } 
}   


    
$html3 = '
</table>
</body>
</html>
';



$res = $html.$html10.$html3;
    
    
    


} else {
    $res = "Lo Sentimos No Se Pudo Realizar la Consulta";
}



$mpdf=new mPDF('','Letter','',''); 
$mpdf->AddPage('P','','','','','','','','','','');
$mpdf->WriteHTML($res);
$mpdf->Output("ReporteEgresadosDifuntos_" . $today.'.pdf', 'I');
exit;
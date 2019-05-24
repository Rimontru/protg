<?php

require_once("../../../../../includes/Config.class.php");  # Cargar datos conexion y otras variables.
require_once('../../../../../includes/DB.class.php');
require_once('../../../../../includes/ConsultaDB.class.php');
require_once('../../../../../mpdf/mpdf.php');
require_once('../../../../../includes/MisFunciones.class.php');

$Obras = new ConsultaDB;
$Funciones = new MisFunciones();

$today = date("d-m-Y");

if ( isset($_GET) ) :

$fk_nivelestudio = $_GET['fk_nivelestudio'];
$fk_modalidad = $_GET['fk_modalidad'];
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



//obtenmos los datos de la institucion
$Result32 = $Obras->ConsultaDatosInsitucionConEstados();
if ($Result32) {
    $row333 = mysql_fetch_assoc($Result32);

    $nombreInstitucion=strtoupper($row333['nombreInstitucion']);
    $apodoInstitucion=strtoupper($row333['apodoInstitucion']);
    $clave=$row333['clave'];
    $direccion=$row333['direccion'];
    $telefono=$row333['telefono'];
    $ciudad=$row333['CiudadEscuela'];
    $estado=$row333['EstadoEscuela'];
    $fechaIncorporacionsecretaria=$row333['fechaIncorporacionSrecetaria'];
    $numerooficio=$row333['noOficio'];
    $registro=$row333['registro'];
    $regimen=$row333['regimen'];
    $paginainternet=$row333['paginaInternet'];
    $lemaescuela=strtoupper($row333['lemaEscuela']);
}



if($fk_modalidad=="1")
    $ModalidadReporte="SEMESTRAL";

else  if($fk_modalidad=="2")
    $ModalidadReporte="CUATRIMESTRAL";

else if($fk_modalidad=="3")
    $ModalidadReporte="TRIMESTRAL";

else if($fk_modalidad=="4")
    $ModalidadReporte="PENTAMESTRAL";

$i = 0;
$totalpresentancar[$i] = 0;
$totalacreditancar[$i] = 0;
$totalsobresalencar[$i] = 0;

$resultCarreras = $Obras->ConCarrerasporModalidadNivelEstudios($fk_modalidad, $fk_nivelestudio);
while ($rowCarreras = mysql_fetch_assoc($resultCarreras)) :
    ++$i;
    $totalpresentan = 0;
    $totalacreditan = 0;
    $totalsobresalen = 0;

    $resultPuntos = $Obras->ConReporteDocumentacionAlumnos($fk_nivelestudio, $fk_modalidad, $rowCarreras['pk_carreras'], $fechaInicio, $fechaFin);
    while ($rowPuntos = mysql_fetch_assoc($resultPuntos)) :

            ++$totalpresentan;

            $puntosTotales= $rowPuntos['a1']+ 
                            $rowPuntos['a2']+
                            $rowPuntos['a3']+
                            $rowPuntos['a4']+
                            $rowPuntos['a5']+
                            $rowPuntos['a6']+
                            $rowPuntos['a7']+
                            $rowPuntos['a8']+
                            $rowPuntos['a9']+
                            $rowPuntos['a10']+
                            $rowPuntos['a11'];

            $puntosTotalesIngles =  $rowPuntos['a1']+
                                    $rowPuntos['a2']+
                                    $rowPuntos['a3'];

            /*MEDICINA*/
            if($rowCarreras['pk_carreras'] == 12)
            {
                if ($puntosTotales >= 120)
                {
                    if ( $puntosTotales >= 150 )
                        ++$totalsobresalen;
                    else
                        ++$totalacreditan;
                }
            }
            /*INGLES*/
            else if ($fk_carreras==31)
            {
                if($puntosTotalesIngles >= 90)
                {
                    if ( $puntosTotales >= 150 ) 
                        ++$totalsobresalen;
                    else
                        ++$totalacreditan;   
                }
            }
            /*OTRAS CARRERAS*/
            else 
            { 
                if($puntosTotales >= 90)
                {
                    if ( $puntosTotales >= 150 )
                        ++$totalsobresalen;
                    else
                        ++$totalacreditan;
                }

            }
    endwhile;

    /*MOSTRAMOS SOLO LAS CARRERAS QUE HACEN EXAMEN*/
    if ($totalpresentan != 0) {
        $htmlBody = '
            <tr>
                <td><div>'.$rowCarreras['nombreCarrera'].'</div></td>
                <td  align="center"><div align="center">'.$totalpresentan.'</div></td>
                <td  align="center"><div align="center">'.($totalacreditan + $totalsobresalen).'</div></td>
                <td  align="center"><div align="center">'.$totalsobresalen.'</div></td>
            </tr>
        ';
        $htmlTable = $htmlTable . $htmlBody;

        $totalpresentancar[$i] = $totalpresentan;
        $totalacreditancar[$i] = ($totalacreditan + $totalsobresalen);
        $totalsobresalencar[$i] = $totalsobresalen;
    }

endwhile;




$html='<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
    <table width="100%" border="0" style="border-collapse: collapse;">
        <tr>
            <td rowspan="6"><div align="center"><img src="../../../../../assets/img/IESCH.png" width="100"/></div></td>
            <td align="center"><strong>'.$nombreInstitucion.'</strong></td>
            <td rowspan="6"><div align="center"><img src="../../../../../assets/img/fimpes.png" width="105"/></div></td>
        </tr>
        <tr>
            <td  align="center"><div align="center"><strong>EN TUXTLA GUTIERREZ, S.C.</strong></div></td>
        </tr>
        <tr>
            <td  align="center"><div align="center"><strong>INCORPORADO A LA SECRETARÍA DE EDUCACIÓN</strong></div></td>
        </tr>
        <tr>
            <td  align="center"><div align="center"><strong>OFICIO No. '.$numerooficio.' DE FECHA '.$fechaIncorporacionsecretaria.'</strong></div></td>
        </tr>
        <tr>
            <td  align="center"><div align="center"><strong>RÉGIMEN: '.$regimen.' CLAVE: '.$clave.' DE EXCELENCIA ACADEMICA: REG. '.$registro.'</strong></div></td>
        </tr>
        <tr>
            <td  align="center"><div align="center"><strong>SERVICIOS ESCOLARES</strong></div></td>
        </tr>
    </table>

    <table width="100%" border="0" style="border-collapse: collapse; margin-top:2%;">
        <tr>
            <td  align="center"><div align="center"><strong>NÚMERO DE ALUMNOS QUE REALIZAN EGEL O EQUIVALENTE</strong></div></td>
        </tr>
        <tr>
            <td  align="center"><div align="center"><strong>PERIODO '.$rangoFechas.' MODALIDAD '.$ModalidadReporte.'
            </strong></div></td>
        </tr>
    </table>
    
    <table width="100%" border="1" style="border-collapse: collapse; margin-top:2%;">
        <tr>
            <td><div><strong> CARRERAS </strong></div></td>
            <td  align="center"><div align="center"><strong> PRESENTARON </strong></div></td>
            <td  align="center"><div align="center"><strong> ACREDITARON </strong></div></td>
            <td  align="center"><div align="center"><strong> SOBRESALIENTES <br> (150 PUNTOS) </strong></div></td>
        </tr>
    
';

$htmlClose = '</table>';

$htmlTotales = '
        <tr>
            <td><div><strong> TOTAL </strong></div></td>
            <td  align="center"><div align="center"><strong> '.array_sum($totalpresentancar).' </strong></div></td>
            <td  align="center"><div align="center"><strong> '.array_sum($totalacreditancar).' </strong></div></td>
            <td  align="center"><div align="center"><strong> '.array_sum($totalsobresalencar).' </strong></div></td>
        </tr>
';


$res=$html. $htmlTable. $htmlTotales. $htmlClose. '</body></html>';

else :
    $html = "Lo Sentimos No Se Pudo Realizar la Consulta";
    $res = $html;

endif;

ob_start();
$mpdf = new mPDF();
$mpdf->AddPage('L', '', '', '', '', '', '', '', '', '', '');
$mpdf->WriteHTML($res);
$mpdf->Output("Reporte_Publicar_ResultadosExamen_". $today.".pdf", 'I');
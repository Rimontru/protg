<?php
//error_reporting(0);
require_once("../../../../../includes/Config.class.php");  # Cargar datos conexion y otras variables.
require_once('../../../../../includes/DB.class.php');
require_once('../../../../../includes/ConsultaDB.class.php');

date_default_timezone_set('America/Mexico_City');

$Obras = new ConsultaDB;

if ( isset($_GET['fk_nivelestudio']) ) {

    $fk_nivelestudio = $_GET['fk_nivelestudio'];
    $fk_modalidad = $_GET['fk_modalidad'];
    $fk_carreras = $_GET['fk_carreras'];

    if ( $Result22 = $Obras->verTrabajadoresDirectoresReportes($_GET['fk_carreras']) )
    {
        $row222 = mysql_fetch_assoc($Result22);
        $carreraReporte = ($row222['nombreCarrera']);

        mysql_free_result($Result22);
    }

    if( $fk_modalidad == "1" )
    {
        $ModalidadReporte="SEMESTRAL";
         }else  if($fk_modalidad=="2"){
        $ModalidadReporte="CUATRIMESTRAL";
         }else if($fk_modalidad=="3"){
        $ModalidadReporte="TRIMESTRAL";
         }else if($fk_modalidad=="4"){
        $ModalidadReporte="PENTAMESTRAL";
    }

}

$fullres[0] = '';
$totalTitulos[0] = 0;
$totalEgresados[0] = 0;
$hombresT[0] = 0;
$mujeresT[0] = 0;
$td_anios = '';
$td_titu = '';
$td_hom = '';
$td_muj = '';

$result_c = $Obras->ConCantidadAlumnosEgresadosPorCarrera($fk_nivelestudio, $fk_modalidad, $fk_carreras);
$row_c = mysql_fetch_assoc($result_c);
$totalEgresados[0] = $row_c['cantidadTotal'];



$result33 = $Obras->ConObtenerGeneracionesTodas($fk_nivelestudio, $fk_modalidad, $fk_carreras);
if ($result33) {
    $row33 = mysql_fetch_assoc($result33);
    //OBTENEMOS LA PRIMER GENERACION DE LA CARRERA
    $anio_inicio = (int)($row33['anioFinGen']);
    $anio_fin = (int)(date('Y'));
    //HACEMOS EL RECORRIDO DESDE LA PRIMERA GENERACION HASTA EL AÑO ACTUAL
    while($anio_inicio <= $anio_fin)
    {
        //OBTENEMOS LA CONTIDAD DE TTIULADOS POR AÑOS
        $_result = $Obras->ConCantidadEgresadosTituladosPorAnio($fk_nivelestudio, $fk_modalidad, $fk_carreras, $anio_inicio, '1,2');
        $_result_2 = $Obras->ConCantidadEgresadosTituladosPorAnio($fk_nivelestudio, $fk_modalidad, $fk_carreras, $anio_inicio, '1');
        $_result_3 = $Obras->ConCantidadEgresadosTituladosPorAnio($fk_nivelestudio, $fk_modalidad, $fk_carreras, $anio_inicio, '2');

        if ($_result && $_result_2 && $_result_3) {

            $_row = mysql_fetch_assoc($_result);
            $_row_2 = mysql_fetch_assoc($_result_2);
            $_row_3 = mysql_fetch_assoc($_result_3);

            array_push($totalTitulos, $_row['TotalTitu']);
            array_push($hombresT, (int)$_row_2['TotalTitu']);
            array_push($mujeresT, (int)$_row_3['TotalTitu']);
            array_push($fullres, "[ '" . $anio_inicio . "', " . $_row['TotalTitu'] . "],");

            $td_anios .= '<td style="border:1px solid black;">'.$anio_inicio.'</td>';
            $td_titu .= '<td style="border:1px solid black;">'.$_row['TotalTitu'].'</td>';
            $td_hom .= '<td style="border:1px solid black;">'.$_row_2['TotalTitu'].'</td>';
            $td_muj .= '<td style="border:1px solid black;">'.$_row_3['TotalTitu'].'</td>';

            ++$anio_inicio;
            mysql_free_result($_result);
        }

    }
    mysql_free_result($result33);
}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Graficas Egresados</title>
        <style type="text/css">
        html {
          font-family: sans-serif;
          -webkit-text-size-adjust: 100%;
              -ms-text-size-adjust: 100%;
        }
        body {
          margin: 0;
        }
        </style>
<script src="../../../../../assets/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'TITULADOS POR AÑO'
        },
        // subtitle: {
        //     text: 'Source: <a href="http://en.wikipedia.org/wiki/List_of_cities_proper_by_population">Wikipedia</a>'
        // },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -90,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            max: 200,
            title: {
                text: ''
            }
        },
        legend: {
            enabled: false
        },
        // tooltip: {
        //     pointFormat: 'Population in 2008: <b>{point.y:.1f} millions</b>'
        // },
        series: [{
            name: 'Titulados',
            data: [
               <?php echo implode($fullres) ?>
            ],
            dataLabels: {
                enabled: true,
                rotation: 0,
                color: '#000',
                align: 'center',
                format: '{point.y:.0f}', // one decimal
                y: 1, // 10 pixels down from the top
                style: {
                    fontSize: '10px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }],
        exporting: false, //desactiva el boton de la exportacion
    });
});
</script>
</head>
<body>
    <section id="graficas" style="margin-left: 2%;">
        </br>
        <table width="85%" align="center" cellSpacing="0" cellPadding="0">
            <tr>
                <td colspan="0" rowspan="5" width="100" class="Estilo1" align="center">
                    <img src="../../../../../assets/img/IESCH.png" width="90" height="90" />
                </td>
                <td colspan="8" width="400" class="Estilo1" align="center">
                    <strong>INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS EN TUXTLA GUTIÉRREZ S.C.</strong>
                </td>

                <td colspan="0" rowspan="5" width="100" class="Estilo1" align="center">
                    <img src="../../../../../assets/img/fimpes.png" width="100	" height="100" />
                </td>
            </tr>
            <tr>
                <td colspan="8" class="Estilo1" align="center"><strong>INCORPORADO A LA SECRETARIA DE EDUCACIÓN</strong></td>
            </tr>
            <tr>
                <td colspan="8" class="Estilo1" align="center"><strong>OFICIO No. 0233 DE FECHA 03 DE NOVIEMBRE DE 1983</strong></td>
            </tr>
            <tr>
                <td colspan="8" class="Estilo1" align="center"><strong>RÉGIMEN: PARTICULAR CLAVE: 07PSU0002D</strong></td>
            </tr>
            <tr>
                <td colspan="8" class="Estilo1" align="center"><strong>EXCELENCIA ACADÉMICA: REG. SEP/PSA/2009/030</strong></td>
            </tr>
            <tr>
                <td colspan="10" class="Estilo1" align="center">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="10" class="Estilo1">CARRERA: <?= $carreraReporte ?></td>
            </tr>
            <tr>
                <td colspan="10" class="Estilo1">MODALIDAD: <?= $ModalidadReporte ?></td>
            </tr>
        </table>
        <table width="85%" align="center" cellSpacing="0" cellPadding="0">
        <tr>
            <td align="center">
                <div id="container" style="margin: 0 auto"></div>
            </td>
        </tr>
        </table>
        <table  width="95%" align="center" cellSpacing="0" cellPadding="5" style="text-align: center; font-size: 10px; margin-top: 5%;">
            <tr>
                <td style="border:1px solid black;"><b>AÑO</b></td>
                <?php echo $td_anios ?>
                <td style="border:1px solid black;"><b>TOTAL</b></td>
            </tr>
            <tr>
                <td style="border:1px solid black;"><b>HOMBRES</b></td>
                <?php echo $td_hom ?>
                <td style="border:1px solid black;"><b><?php echo array_sum($hombresT) ?></b></td>
            </tr>
            <tr>
                <td style="border:1px solid black;"><b>MUJERES</b></td>
                <?php echo $td_muj ?>
                <td style="border:1px solid black;"><b><?php echo array_sum($mujeresT) ?></b></td>
            </tr>
            <tr>
                <td style="border:1px solid black;"><b>TITULADOS</b></td>
                <?php echo $td_titu ?>
                <td style="border:1px solid black;"><b><?php echo array_sum($totalTitulos) ?></b></td>
            </tr>
        </table>

        <table  width="95%" align="center" cellSpacing="0" cellPadding="5" style="text-align: center; font-size: 12px; margin-top: 5%;">
            <tr>
                <td><b>EGRESADOS</b></td>
                <td><b>TITULADOS</b></td>
                <td><b>NO TITULADOS</b></td>
                <td><b>EFICIENCIA</b></td>
            </tr>
            <tr>
                <td><?php echo $totalEgresados[0] ?></td>
                <td><?php echo array_sum($totalTitulos) ?></td>
                <td><?php echo ($totalEgresados[0] - array_sum($totalTitulos)) ?></td>
                <td><?php echo round(( array_sum($totalTitulos)/$totalEgresados[0])*100) ?>%</td>
            </tr>
        </table>
        <br>
        <br>
        <hr>
        <center>
            FUENTE: DEPARTAMENTO DE SEGUIMIENTO DE EGRESADOS
        </center>

    </section>
</body>
<script src="../../../../../Highcharts-4.1.5/js/highcharts.js"></script>
<script src="../../../../../Highcharts-4.1.5/js/modules/exporting.js"></script>
</html>

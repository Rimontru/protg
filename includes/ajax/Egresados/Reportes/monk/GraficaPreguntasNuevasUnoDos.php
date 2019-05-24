<?php

require_once("../../../../../includes/Config.class.php");  # Cargar datos conexion y otras variables.
require_once('../../../../../includes/DB.class.php');
require_once('../../../../../includes/ConsultaDB.class.php');
        
date_default_timezone_set('America/Mexico_City');   
   
$Obras = new ConsultaDB;

$opciones=array(
	7=>"¿Si tuvieras que cursar nuevamente tus estudios, eligirías la misma institución?",
	8=>"¿Estudiarías una Maestría en la misma institución?",
	);

$result1 = $Obras->ConDatosCompletosCarreras($_GET['fk_modalidad'], $_GET['fk_carreras'], $_GET['fk_generacion']);
$row1 = mysql_fetch_array($result1);
			

if( isset($_GET) ){ 
	$fullres=NULL; $totalCantiEncue=0;
	$nameReport = $opciones[$_GET['opcionGrafica']];
	switch($_GET['opcionGrafica']){
		case 7:
			$result = $Obras->ConCantidadAlumnosEgresadosElegirMismaInstitucion($_GET['fk_nivelestudio'], $_GET['fk_modalidad'], $_GET['fk_carreras'], $_GET['fk_generacion']);
					while($row = mysql_fetch_array($result)){ extract($row);
						$totalCantiEncue += $cantidad;
						$fullres .= "[ '".$Legend.':'.$cantidad." ', ".$cantidad."],";	
					} 
		break;
		case 8:
			$result = $Obras->ConCantidadAlumnosEgresadosEstudiarMaestriaMismaInstitucion($_GET['fk_nivelestudio'], $_GET['fk_modalidad'], $_GET['fk_carreras'], $_GET['fk_generacion']);
					while($row = mysql_fetch_array($result)){ extract($row);
						$totalCantiEncue += $cantidad;
						$fullres .= "[ '".$Legend.':'.$cantidad." ', ".$cantidad."],";	
					} 
		break;
		/*case 9:
			$result = $Obras->CantidadAlumnosEncuestaMedicinaGraficaUsoCienciasBasicas();
					while($row = mysql_fetch_array($result)){ extract($row);
						$totalCantiEncue += $cantidad;
						if($GradoCienciasBasicas==1)
							$Legend='NADA';
						elseif($GradoCienciasBasicas==2)
							$Legend='POCO';
						elseif($GradoCienciasBasicas==3)
							$Legend='REGULAR';
						else
							$Legend='MUCHO';
						$fullres .= "[ '".$Legend." ', ".$cantidad."],";	
					} 
		break;
		case 10:
			$result = $Obras->CantidadAlumnosEncuestaMedicinaGraficaUsoCienciasClinicas();
					while($row = mysql_fetch_array($result)){ extract($row);
						$totalCantiEncue += $cantidad;
						if($GradoCienciasClinicas==1)
							$Legend='NADA';
						elseif($GradoCienciasClinicas==2)
							$Legend='POCO';
						elseif($GradoCienciasClinicas==3)
							$Legend='REGULAR';
						else
							$Legend='MUCHO';
						$fullres .= "[ '".$Legend." ', ".$cantidad."],";	
					} 
		break;
		case 11:
				$result = $Obras->CantidadAlumnosEncuestaMedicinaGraficaAspectoDebilidad();
					while($row = mysql_fetch_array($result)){ extract($row);
						$totalCantiEncue += $cantidad;
						$fullres .= "[ '".$descripcion_aspectodebilidad." ', ".$cantidad."],";	
					}
					$diferencia = $const - $totalCantiEncue;
					$totalCantiEncue += $diferencia;
					#$fullres .= "['Prefiero No Decirlo',".$diferencia."]"; 
				$totalCantiEncue = 274;
		break;
		case 12:
			$result = $Obras->CantidadAlumnosEncuestaMedicinaGraficaReeleccionInstituto();
					while($row = mysql_fetch_array($result)){ extract($row);
						$totalCantiEncue += $cantidad;
						$fullres .= "[ '".$Legend." ', ".$cantidad."],";	
					} 
		break;
		case 13:
			$result = $Obras->CantidadAlumnosEncuestaMedicinaGraficaGradoSatisfaccion();
					while($row = mysql_fetch_array($result)){ extract($row);
						$totalCantiEncue += $cantidad;
						$fullres .= "[ '".$fk_gradosatisfaccion." ', ".$cantidad."],";	
					} 
		break;*/
	}
	
}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Graficas Egresados</title>
<!--
<style type="text/css">
${demo.css}
#graficas{font-family: 'Roboto', sans-serif;font-size: 18px;}
</style>

 <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> -->  
<script src="../../../../../assets/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript">

$(function () {
    $('#container').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: '<?=$nameReport?>'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Encuestados',
			data: [
				<?php echo $fullres;?>
			]
        }],
		exporting: false, //desactiva el boton de la exportacion       
    });
});


</script>
</head>
<body>
    <section id="graficas">
        </br></br></br>
        <table width="860" height="" border="0" align="center"  cellSpacing="0" cellPadding="0" >
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
                <td colspan="10" class="Estilo1" align="center">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="10" class="Estilo1">CARRERA: <?= $row1['nombreCarrera']?></td>
            </tr>
            <tr>
                <td colspan="10" class="Estilo1">MODALIDAD: <?= strtoupper($row1['nombreMod'])?></td>
            </tr>
            <tr>
                <td width="430" colspan="5">GENERACIÓN: <?= strtoupper($row1['descripcion'])?></td>
                <!--<td width="430" colspan="5" class="Estilo1" align="center"><strong><u><?= $totalCantiEncue?></u></strong></td>-->
            </tr>
             <tr>
                <td width="430" colspan="5">ECUESTADOS: <?=$totalCantiEncue?></td>
                <!--<td width="430" colspan="5" class="Estilo1" align="center"><strong><u><?= $totalCantiEncue?></u></strong></td>-->
            </tr>
            <!-- <tr><td>&nbsp;</td></tr> 
            <tr>
            	<td  width="430" colspan="10" class="Estilo1" align="center"><?php echo 'Gráfica de egresados encuestados '.$nameReport; ?></td>
            </tr>-->
        </table>
        <br> <br>
        
        <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>

       <!--  <div id="x" style="max-width: 830px; margin: 0 auto"> 
            <img src="especiales/debilidades.png" width="800" alt="...">
        </div> -->

    </section>
</body>
<script src="../../../../../Highcharts-4.1.5/js/highcharts.js"></script>
<script src="../../../../../Highcharts-4.1.5/js/modules/exporting.js"></script>
</html>

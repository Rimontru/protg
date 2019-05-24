<?php

require_once("../../../../includes/Config.class.php");  # Cargar datos conexion y otras variables.
require_once('../../../../includes/DB.class.php');
require_once('../../../../includes/ConsultaDB.class.php');
require_once('../../../../mpdf/mpdf.php');
require_once('../../../../includes/MisFunciones.class.php');


require_once ("../../../../includes/jpgraph/src/jpgraph.php");
require_once ("../../../../includes/jpgraph/src/jpgraph_pie.php");
        
   date_default_timezone_set('America/Mexico_City');      
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


    
    

    $result33 = $Obras->ConReporteAlumnosInformacionBasica($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fk_generacion);
    if ($result33) {
        while ($row33 = mysql_fetch_assoc($result33)) {
            
  
        }
        mysql_free_result($result33);
    }

    
    
    $consultaCantidad = $Obras->ConCantidadAlumnosTituladosNoTituladosGrafica($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fk_generacion);
    if ($consultaCantidad) {
        while ($row11 = mysql_fetch_assoc($consultaCantidad)) {
           $cantidadLista=$row11['cantidadTotal'];  
        }
        mysql_free_result($consultaCantidad);
    }
//echo $cantidadTotal."<br>";

 $consultaCantEgresados = $Obras->ConCantidadAlumnosTituladosGrafica($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fk_generacion);
    if ($consultaCantEgresados) {
        while ($row11 = mysql_fetch_assoc($consultaCantEgresados)) {
           $cantidadTotalEgresados=$row11['cantidadTotalEgresados'];  
        }
        mysql_free_result($consultaCantEgresados);
    }
//  
//    echo $cantidadTotal."<br>";
    


    
    
    $resultTitulados = $Obras->ConCantidadAlumnosTituladosGrafica($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fk_generacion);
           

    $fechaSQL = explode("-", $fecha);
    $fechaLista = $fechaSQL[2] . "/" . $fechaSQL[1] . "/" . $fechaSQL[0];


      while ($row22 = mysql_fetch_assoc($resultTitulados)) {

        $generacionListaNumero = $row22['generacionNumero'];
        $generacionLista = $row22['generacion'];
        $contador2 = $contador2 + 1;
        $fechaSQL = explode("-", $row22['']);
        $fechaListaTitulados = $fechaSQL[2] . "/" . $fechaSQL[1] . "/" . $fechaSQL[0];

        $fechaTitulo = explode("-", $row22['fechaexpediciontitulo']);
        $fechaListaTitulo = $fechaTitulo[2] . "/" . $fechaTitulo[1] . "/" . $fechaTitulo[0];

        $html8 = " ";

        $html9 = $html9 . $html8;
    }
//echo $cantidadTotal."<br>";

//no titulados
   $result = $Obras->ConCantidadAlumnosNooopTitulados($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fk_generacion);
     
//    $fechaSQL = explode("-", $fecha);
//    $fechaLista = $fechaSQL[2] . "/" . $fechaSQL[1] . "/" . $fechaSQL[0];

    $html = '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reporte Grafica</title>
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

  ';

     while ($row = mysql_fetch_assoc($result)) {

$cantidadTotalNopTitulados = $row['cantidadTotalNopTitulados'];
        $generacionListaNumero = $row['generacionNumero'];



        $generacionLista = $row['DescripcionGeneracion'];
        $contador2 = $contador2 + 1;
        $fechaSQL = explode("-", $row['FechaTomaProtesta']);
        $fechaLista = $fechaSQL[2] . "/" . $fechaSQL[1] . "/" . $fechaSQL[0];

        $fechaTitulo = explode("-", $$row['fechaexpediciontitulo']);
        $fechaListaTitulo = $fechaTitulo[2] . "/" . $fechaTitulo[1] . "/" . $fechaTitulo[0];

        $html2 = "
";

        $html4 = $html4 . $html2;
    }

//echo $cantidadTotalNopTitulados;


//    $eficiencia = $cantidadTotalEgresados / $cantidadLista * 100;
//    $notitulados = $cantidadLista - $cantidadTotalEgresados;
//    $notituladosListo = round($notitulados, 2);
//    

       $eficiencia = $cantidadTotalEgresados / $cantidadLista * 100;
    $notitulados = $cantidadLista - $cantidadTotalEgresados;
    $notituladosListo = round($notitulados, 2);
    
    
    $html3 = '

<table width="698" height="139" border="0" align="center">
  <tr>
    <td colspan="8" align="center"><div align="center">' . $carreraTitulados . '</div></td>
  </tr>
  <tr>
    <td width="71">&nbsp;</td>
    <td width="59">&nbsp;</td>
    <td width="96">&nbsp;</td>
    <td width="91">&nbsp;</td>
    <td width="93">&nbsp;</td>
    <td width="122">&nbsp;</td>
    <td width="38">&nbsp;</td>
    <td width="94">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center"><div align="center"><span class="Estilo1">GENERACIÓN</span></div></td>
    <td align="center"><div align="center"><span class="Estilo1">CICLO ESCOLAR</span></div></td>
    <td align="center"> <div align="center"><span class="Estilo1">ALUMNOS EGRESADOS</span></div></td>
    <td align="center"><div align="center"><span class="Estilo1">TITULADOS</span></div></td>
    <td align="center"><div align="center"><span class="Estilo1">EFICIENCIA DE TITULACIÓN</span></div></td>
    <td align="center" colspan="2"><div align="center"><span class="Estilo1">NO TITULADOS</span></div>      <div align="center"><span class="Estilo1"></span></div></td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" colspan="2"><div align="center">' . $generacionListaNumero . '</div></td>
    <td align="center" ><div align="center">' . $generacionLista . '</div></td>
    <td align="center" ><div align="center">' . $cantidadLista . '</div></td>
    <td align="center" ><div align="center">' . $cantidadTotalEgresados . '</div></td>
    <td align="center"><div align="center">' . $eficiencia . '</div></td>
    <td align="center" colspan="2"><div align="center">' . $notituladosListo . '</div></td>
  </tr>
</table>
<br><br>
 <center><img src="graficaCircular.php" /> </center>
</body>
</html>
';

   
    
         $extension = ".php";
    $nombre_archivo = "graficaCircular" . $extension;
    $carpeta_destino = dirname(__FILE__);
    $archivo = $carpeta_destino . "/" . $nombre_archivo;
    $f = fopen($archivo, "w");

	
	 
	 $grafica='<?php 
	require_once ("../../../../includes/jpgraph/src/jpgraph.php");
        require_once ("../../../../includes/jpgraph/src/jpgraph_pie.php");
	// Se define el array de valores y el array de la leyenda
	$datos = array('.$cantidadTotalEgresados.','.$notituladosListo.');
	$leyenda = array("Titulados","No titulados");
	
	//Se define el grafico
	$grafico = new PieGraph(450,300);
    

        
	//Definimos el titulo 
	$grafico->title->Set("Grafica de Alumnos Titulados y No Titulados");
	$grafico->title->SetFont(FF_FONT1,FS_BOLD);
	$grafico->title->SetColor("navy");
       

	//AÃ±adimos el titulo y la leyenda
	$p1 = new PiePlot($datos);
	$p1->SetLegends($leyenda);
	$p1->SetCenter(0.4);
	  $p1->SetSliceColors(array("green","red","blue")); 

	//Se muestra el grafico
	$grafico->Add($p1);
	$grafico->Stroke();
    ?>';

    
     fwrite($f, $grafica);
    fputs($f, "");
    fclose($f);
    
     
    $res = $html . $html9 . $html4 . $html3;
    


} else {
    $html = "Lo Sentimos No Se Pudo Realizar la Consulta";
}
echo $res;


//$mpdf=new mPDF('','Letter','',''); 
//$mpdf->AddPage('L','','','','','','','','','','');
//$mpdf->WriteHTML($res);
//$mpdf->Output("ReporteGrafica_" . $today, 'D');
?> 

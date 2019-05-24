<?php

require_once("../../../../../includes/Config.class.php");  # Cargar datos conexion y otras variables.
require_once('../../../../../includes/DB.class.php');
require_once('../../../../../includes/ConsultaDB.class.php');
require_once('../../../../../mpdf/mpdf.php');
require_once('../../../../../includes/MisFunciones.class.php');

$Obras = new ConsultaDB;
$Funciones = new MisFunciones();

$today = date("d-m-Y");

if (isset($_GET['fk_nivelestudio'])) {
    $fk_nivelestudio = $_GET['fk_nivelestudio'];
    $fk_modalidad = $_GET['fk_modalidad'];
    $fk_carreras = $_GET['fk_carreras'];
    $rangoFechas = $_GET['rangoFechas'];
	$duplicado = $_GET['cons_duplicado'];


      $Result22 = $Obras->verTrabajadoresDirectoresReportes($fk_carreras);
    if ($Result22) {
        $row222 = mysql_fetch_assoc($Result22);
        $nombreDirector=  ($row222[NombreCompletoDirector]);
        $carreraReporte=  ($row222[nombreCarrera]);

    if($fk_carreras==6
			|| $fk_carreras==7
			|| $fk_carreras==11
			|| $fk_carreras==13
			|| $fk_carreras==27
			|| $fk_carreras==95
			|| $fk_carreras==100)
				$dela=' DE ';
		else $dela=' DE LA ';

		if($row222[fk_genero]== "1") {
		     $GeneroReporte=" DIRECTOR ".$dela;

		}else{
		 $GeneroReporte=" DIRECTORA ".$dela;

		}


        mysql_free_result($Result22);
    }






    //convertimos fechas
    $fechaSQL = explode("-", $rangoFechas);
    $fechaInicio = trim($fechaSQL[0]);
    $fechaFin = trim($fechaSQL[1]);

    //  01/07/2014 - 31/07/2014
    $fechaSQL = explode("/", $fechaInicio);
    $fechaInicio = $fechaSQL[2] . "-" . $fechaSQL[1] . "-" . $fechaSQL[0];

    $fechaSQL = explode("/", $fechaFin);
    $fechaFin = $fechaSQL[2] . "-" . $fechaSQL[1] . "-" . $fechaSQL[0];


    $Result = $Obras->ConReporteDocumentacionAlumnos($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fechaInicio, $fechaFin);
$contadorfilas = mysql_num_rows($Result);
    if ($Result) {
        while ($row2 = mysql_fetch_assoc($Result)) {

		$fechaAplicacionLista=$row2[fechaaplicacion];
		$triniti=$row2[triniti];

                $puntosTotales = $row2['a1'] + $row2['a2'] + $row2['a3'] + $row2['a4'] + $row2['a5'] + $row2['a6'] + $row2['a7'] + $row2['a8'] + $row2['a9'] + $row2['a10'] + $row2['a11'];
                $puntosTotales = explode(".", $puntosTotales);
                $puntosTotales = $puntosTotales[0];
		/*
           	$puntosIngles=$row2['a1']+$row2['a2']+$row2['a3']+$row2['a4']+$row2['a5']+$row2['a6']+$row2['a7']+$row2['a8']+$row2['a9']+$row2['a10'];
           	$puntosMateriaIngles=$row2['a6'];

$triniti=$row2[triniti];
*/              $puntosIngles=$row2['a1']+$row2['a2']+$row2['a3'];


            if ($fk_carreras==12){#medicina

                if ($puntosTotales >= 120){
                    $resultado = "ACREDITADO";

                }else if($puntosTotales == 0){
                    $resultado = "NO PRESENTO";

                }else{
                    $resultado = "NO ACREDITADO";

                }

            }
            //se  quita la condicion el 2018/07/10
            // else if($fk_carreras==18){#psicologia 2017/10/10 modify

            //     if ($puntosTotales >= 101) {
            //           $resultado = "ACREDITADO";

            //     }else if ($puntosTotales == 0) {
            //         $resultado = "NO PRESENTO";

            //     }else {
            //         $resultado = "NO ACREDITADO";

            //     }

            // }
            else {

                if($puntosTotales >= 90){
                    $resultado = "ACREDITADO";

                }else if ($puntosTotales == 0) {
                    $resultado = "NO PRESENTO";

                }else {
                    $resultado = "NO ACREDITADO";

                }
            }//fin condicion
/*

$puntosTotalesIngles = $puntosIngles + $puntosMateriaIngles;



          if ($fk_carreras == 31){#ingles

            if($puntosTotalesIngles >= 90){
                $resultado = "ACREDITADO";

            }else{
                $resultado = "NO ACREDITADO";
            }

              if($puntosMateriaIngles < 60){
                $resultado="NO ACREDITADO";
              }
              else if($puntosMateriaIngles>=60 && $puntosTotalesIngles>=90){ //materia ingles 70 puntosd ingles 170
                $resultado="ACREDITADO";
              }
              else if ($triniti=="Si" || $puntosTotalesIngles>=90) {
                $resultado="ACREDITADO";
              }
              else{
                $resultado="NO ACREDITADO";
              }
        }
*/

/*<div align="center"><img src="../../../../../assets/img/banners/banner.png" width="100%" height="107"></div>*/
            $html .= '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
<!--
.Estilo8 {
	font-size: 24px;
	font-weight: bold;
}
.Estilo9 {
	font-size: 20px;
	font-weight: bold;
}
.Estilo11 {font-size: 24px}
.Estilo14 {font-size: 19px; font-weight: bold; }
.Estilo15 {font-size: 19px}
.Estilo16 {font-size: 26px}
-->
</style>
</head>
<body>
<br>
<div align="center"><img src="../../../../../assets/img/2018/banners/head.png" width="100%"></div>
<table width="1089"  border="0"  style="border-collapse: collapse;">

  <tr>
    <td height="11" width="100%" colspan="16" align="center"></td>
  </tr>

  <tr>
    <td width="122" height="21">&nbsp;</td>
    <td width="14">&nbsp;</td>
    <td width="57">&nbsp;</td>
    <td width="43">&nbsp;</td>
    <td width="42">&nbsp;</td>
    <td width="67">&nbsp;</td>
    <td width="29">&nbsp;</td>
    <td width="25">&nbsp;</td>
    <td width="114">&nbsp;</td>
    <td width="49">&nbsp;</td>
    <td width="46">&nbsp;</td>
    <td width="67">&nbsp;</td>
    <td width="19">&nbsp;</td>
    <td width="72">&nbsp;</td>
    <td width="26">&nbsp;</td>
    <td width="131">&nbsp;</td>
  </tr>
<tr>
    <td width="122" height="21">&nbsp;</td>
    <td width="14">&nbsp;</td>
    <td width="57">&nbsp;</td>
    <td width="43">&nbsp;</td>
    <td width="42">&nbsp;</td>
    <td width="67">&nbsp;</td>
    <td width="29">&nbsp;</td>
    <td width="25">&nbsp;</td>
    <td width="114">&nbsp;</td>
    <td width="49">&nbsp;</td>
    <td width="46">&nbsp;</td>
    <td width="67">&nbsp;</td>
    <td width="19">&nbsp;</td>
    <td width="72">&nbsp;</td>
	<td width="131">&nbsp;</td>
    <td align="right"><span class="Estilo14"><b>'.$duplicado.'</b></span></td>
  </tr>
  <tr>
    <td colspan="6"  align="left" ><span class="Estilo8">Tuxtla Gutiérrez, Chiapas</span></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="6" ><div align="left" class="Estilo8">Reporte Individual de Resultado</div></td>
  </tr>
  <tr>
    <td height="21">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="6"><div align="left" class="Estilo8">Para Efecto de Titulación</div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="14" align="center"><div align="center"><span class="Estilo16">SUSTENTACIÓN DE EXAMEN POR ÁREAS DE CONOCIMIENTO DE ';



	if($fk_carreras==7 || $fk_carreras==95){
        $html.="INGENIERO ZOOTECNISTA ADMINISTRADOR";
		// $html.="LICENCIATURA DE INGENIERO ZOOTECNISTA ADMINISTRADOR";
	}
	elseif($fk_carreras==13){
		 $html.="INGENIERÍA CIVIL";
	}
	else if($fk_carreras==11 || $fk_carreras==27){
		 $html.="INGENIERÍA EN SISTEMAS COMPUTACIONALES";
	}
    else if($fk_carreras==100){
         $html.="INGENIERÍA EN TELECOMUNICACIONES";
    }
	else if($fk_carreras==6){
		 $html.="INGENIERO CONSTRUCTOR";
	}
	else{
		 $html.='LA '.$carreraReporte;
	}





		$html.='</span></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="21">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

  ';
            $cadenaAlumno = $row2['NombreCompleto'];
            $cadena = strtoupper($cadenaAlumno);

            $html.= "


<tr>
    <td colspan='13'><span class='Estilo8'>Fecha de Aplicación: $row2[fechaaplicacion] </span></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height='21'>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='5'><div align='left'><span class='Estilo11'>Folio: <span class='Estilo8'>$row2[folioInstitucional]</span></span></div></td>
    <td colspan='5'>&nbsp;</td>
    <td height='21'>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='5'><div align='left'><span class='Estilo11'>Nombre del Sustentante:</span></div></td>
    <td colspan='11'><div align='left' class='Estilo8'>$cadena</div></td>
  </tr>
    <tr>
    <td height='21'>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='5'><div align='left'><span class='Estilo11'>Calificación Obtenida: </span></div>      <span class='Estilo11'></span></td>
    <td colspan='11'><div align='left' class='Estilo8'>$resultado</div></td>
  </tr>

  <tr>
    <td height='61'>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

</table>

<table width='987' height='72' border='0'  style='border-collapse: collapse;'>
  <tr>
    <td width='406' height='21'>&nbsp;</td>
    <td width='146'>&nbsp;</td>
    <td width='421'>&nbsp;</td>
  </tr>
  <tr>
    <td height='22' align='center'><span class='Estilo9'>$nombreDirector</span></td>
    <td>&nbsp;</td>
    <td align='center'><span class='Estilo9'>M.A. FLORIBEL MEGCHÙN DE LA CRUZ</span></td>
  </tr>
  <tr>
    <td height='21' align='center'>

                <span class='Estilo14'>
                ".$GeneroReporte;


	if($fk_carreras==7 || $fk_carreras==95){
		 $html.="INGENIERO ZOOTECNISTA ADMINISTRADOR";

	}else{
		 $html.=$carreraReporte;

	}

$html.="</span></td>


    <td>&nbsp;</td>
    <td align='center'><span class='Estilo14'>DIRECTORA DE SERVICIOS ESCOLARES</span></td>
  </tr>

   <tr>
    <td height='21'>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

  <tr>
    <td width='122'>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

</table>
<div align='center'><img src='../../../../../assets/img/2018/banners/pie.png' width='100%'></div>
";


 $resu=$resu.$html."|";

//            $fechaaplicacion = $row2[fechaaplicacionReporte];
        }
        mysql_free_result($Result);
        //obtenemos la fecha de aplicacion
//        $fechaLetras = $Funciones->Fecha2($fechaaplicacion);
    }
} else {
    $html = "Lo Sentimos No Se Pudo Realizar la Consulta";
}

//echo $html;
$timeo_start = microtime(true);
ini_set("memory_limit","280824M");
ini_set('max_execution_time', 400);
ob_start();
 $mpdf = new mPDF();
//$cantidad=substr_count($resu,"|");
//$parte = explode("|", $resu);
//
//
//  for($x=1;$x<$contadorfilas;$x++){
//
//      $parte1Lista = $parte[$x];
//      echo $parte1Lista;
////      $mpdf->WriteHTML($parte1Lista);
//
//  }

//  echo $contadorfilas;

//$mpdf->AddPage('L', '', '', '', '', '', '', '', '', '', '');
$mpdf->WriteHTML($html);
$mpdf->Output("Reporte_Constancia" . $today.'.pdf', 'I');
?>

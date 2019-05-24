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


      $Result22 = $Obras->verTrabajadoresDirectoresReportes($fk_carreras);
    if ($Result22) {
        $row222 = mysql_fetch_assoc($Result22);
        $nombreDirector=  ($row222[NombreCompletoDirector]);
        $carreraReporte=  ($row222[nombreCarrera]);

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




//obtenemos las areas ed formacion de la carrera
 $result = $Obras->ConDatosAreaFormacion($fk_carreras);
  if ($result) {
       $row222 = mysql_fetch_assoc($result);
      $areaUno=$row222['formacion1'];
      $areaDos=$row222['formacion2'];
      $areaTres=$row222['formacion3'];
      $areaCuatro=$row222['formacion4'];
      $areaCinco=$row222['formacion5'];
      $area6=$row222['formacion6'];
      $area7=$row222['formacion7'];
      $area8=$row222['formacion8'];
      $area9=$row222['formacion9'];
      $area10=$row222['formacion10'];
      $area11=$row222['formacion11'];


  }


if($fk_modalidad=="1"){
    $ModalidadReporte="SEMESTRAL";
         }else  if($fk_modalidad=="2"){
    $ModalidadReporte="CUATRIMESTRAL";
         }else if($fk_modalidad=="3"){
    $c="TRIMESTRAL";
         }else if($fk_modalidad=="4"){
    $ModalidadReporte="PENTAMESTRAL";
         }



$totalpresentan = 0;
$totalacreditan = 0;
$totalsobresalen = 0;

 $result = $Obras->ConReporteDocumentacionAlumnos($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fechaInicio, $fechaFin);
 while ($row = mysql_fetch_assoc($result)) {
    ++$totalpresentan;

//        $fechaActualModificar = explode("-", $value->fechaAplicacionInstitucional);
//        $fechaActualLista = $fechaActualModificar[0] . "-" . $fechaActualModificar[1] . "-" . $fechaActualModificar[2];
//
//        $fechaLetras = fechaATexto($fechaActualLista, 'u'); // Devuelve '10 DE AGOSTO DE 1981'
//
//        $fechaSQL = explode("-", $value->fecha);
//        $fechaLista = $fechaSQL[2] . "/" . $fechaSQL[1] . "/" . $fechaSQL[0];
//
//        $fechaTitulo = explode("-", $value->fechaexpediciontitulo);
//        $fechaListaTitulo = $fechaTitulo[2] . "/" . $fechaTitulo[1] . "/" . $fechaTitulo[0];
$fechaAplicacionLista=$row[fechaaplicacion];
#$triniti=$row[triniti];


        //if ($row['nombreCarrera']=="ENSEÑANZA DEL INGLES"){
           $puntosTotales=$row['a1']+$row['a2']+$row['a3']+$row['a4']+$row['a5']+$row['a6']+$row['a7']+$row['a8']+$row['a9']+$row['a10']+$row['a11'];
           $puntosTotalesIngles=$row['a1']+$row['a2']+$row['a3'];#+$row['a4']+$row['a5']+ $row2['a6']+$row['a7']+$row['a8']+$row['a9']+$row['a10'];
            #$puntosMateriaIngles=$row['a6'];
           // $puntosTotales = ($puntosTotales * .70) + 30;
         // //   $puntosTotales = explode(".",$puntosTotales);
         //    $puntosTotales = $puntosTotales[0];
       // } else {
        //    $puntosTotales=$row['a1']+$row['a2']+$row['a3']+$row['a4']+$row['a5']+$row['a6']+$row['a7']+$row['a8']+$row['a9']+$row['a10']+$row['a11'];
          //  $puntosTotales = explode(".",$puntosTotales);
        //    $puntosTotales = $puntosTotales[0];
          //  }//fin condicion

          if($fk_carreras == 12){#medicina

                if ($puntosTotales >= 120) {
                    if ( $puntosTotales >= 150 ){
                        ++$totalsobresalen;
                        $resultado = '<FONT COLOR="green">ACREDITADO</FONT>';
                    }else{
                        ++$totalacreditan;
                        $resultado = "ACREDITADO";
                    }
                }else if($puntosTotales == 0){
                  $resultado = "<FONT COLOR='red'>NO PRESENTO</FONT>";

                }else{
                  $resultado = "<FONT COLOR='red'>NO ACREDITADO</FONT>";

                }

          }
          //se  quita la condicion el 2018/07/10
          // else if($fk_carreras == 18){#psicologia 2017/10/10 modify

          //       if ($puntosTotales >= 101) {
          //             $resultado = "ACREDITADO";

          //       }else if ($puntosTotales == 0) {
          //         $resultado = "<FONT COLOR=red>NO PRESENTO</FONT>";

          //       }else {
          //         $resultado = "<FONT COLOR=red>NO ACREDITADO</FONT>";

          //       }

          // }
          else { #otras carreras

                if($puntosTotales >= 90){
                    if ( $puntosTotales >= 140 ){ 
                        ++$totalsobresalen;
                        $resultado = '<FONT COLOR="green">ACREDITADO</FONT>';
                    }else{
                        ++$totalacreditan;
                        $resultado = "ACREDITADO";
                    }

                }else if ($puntosTotales == 0) {
                  $resultado = "<FONT COLOR=red>NO PRESENTO</FONT>";

                }else {
                  $resultado = "<FONT COLOR=red>NO ACREDITADO</FONT>";

                }
          }//fin condicion


        #$puntosTotalesIngles = $puntosIngles + $puntosMateriaIngles;



         /* if ($fk_carreras==31){#ingles

              if($puntosTotales >= 90){ //materia ingles 70 totalesingels 170
                if ( $puntosTotales >= 150 ){ 
                    ++$totalsobresalen;
                    $resultado = '<FONT COLOR="green">ACREDITADO</FONT>';
                }else{
                    ++$totalacreditan;
                    $resultado = "ACREDITADO";
                }
              }
              else{
                $resultado="<FONT COLOR=red>NO ACREDITADO</FONT>";
              }
              /*if($puntosMateriaIngles<60){
                $resultado="<FONT COLOR=red>NO ACREDITADO</FONT>";
              }else if($puntosMateriaIngles>=60 && $puntosTotalesIngles>=90){ //materia ingles 70 totalesingels 170
                $resultado="ACREDITADO";
              }else if ($triniti=="Si" && $puntosTotalesIngles>=140) {
                $resultado="ACREDITADO";
              }else{
                $resultado="<FONT COLOR=red>".$puntosTotalesIngles."</FONT>";
              }
        }*/










        $html2 = "
}
}
  }

  <tr>
    <td height='21'>&nbsp;</td>
    <td  style='border-width: 1px;border: solid;' class='Estilo7' align='center'>".$row[folioInstitucional]."</td>
    <td colspan='8'  style='border-width: 1px;border: solid;' class='Estilo7' align='center'>".$row[NombreCompleto]."</td>
    <td colspan='2' style='border-width: 1px;border: solid;' class='Estilo7' align='center'>".$resultado."</td>
  </tr>


                ";




        $html4 = $html4 . $html2;





    }




    $html='<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo5 {font-size: 16px; font-weight: bold; }
.Estilo6 {
	font-size: 15px;
	font-weight: bold;
}
.Estilo7 {font-size: 15px}
-->
</style>
</head>

<body>
<table width="995" height="218" border="0">
                  <tr>
                    <td colspan="2" rowspan="6"  align="center"><div align="center"><img src="../../../../../assets/img/IESCH.png" width="120" height="122" /></div></td>
                    <td width="450"  align="center"><strong>'.$nombreInstitucion.'</strong></td>
                    <td colspan="2" rowspan="6"  align="center"><div align="center"><img src="../../../../../assets/img/fimpes.png" width="118" height="101" /></div></td>
                  </tr>
                  <tr>
                    <td  align="center"><div align="center"><strong>'.$apodoInstitucion.'</strong></div></td>
                  </tr>
                  <tr>
                    <td  align="center"><div align="center"><strong>INCORPORADO A LA SECRETARÍA DE EDUCACIÓN</strong></div></td>
                  </tr>
                  <tr>
                    <td  align="center"><div align="center"><strong>OFICIO No. '.$numerooficio.' DE FECHA '.$fechaIncorporacionsecretaria.'</strong></div></td>
                  </tr>
                  <tr>
                    <td  align="center"><div align="center"><strong>RÉGIMEN: '.$regimen.' CLAVE: '.$clave.' DE EXCELENCIA ACADEMICA: REG. </strong></div></td>
                  </tr>
                  <tr>
                    <td  align="center"><div align="center"><strong>'.$registro.'</strong></div></td>
                  </tr>
                  <tr>
                    <td width="55">&nbsp;</td>
                    <td width="98">&nbsp;</td>
                    <td  align="center"><div align="center"><strong>SERVICIOS ESCOLARES</strong></div></td>
                    <td width="95">&nbsp;</td>
                    <td width="78">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="23">&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                    <tr>
                    <td height="23">&nbsp;</td>
                    <td colspan="2"><span class="Estilo6">FECHA DE APLICACION: '.$fechaAplicacionLista.'<span class="Estilo7"></span><span class="Estilo7"></span><span class="Estilo7"></span><span class="Estilo7"></span></span></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="23">&nbsp;</td>
                    <td colspan="2"><span class="Estilo7"><strong>CARRERA: <strong>'.$carreraReporte.'</strong></strong></span></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                   <tr>
                    <td height="23">&nbsp;</td>
                    <td colspan="2"><span class="Estilo7"><strong>MODALIDAD: <strong>'.$ModalidadReporte.'</strong></strong></span></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
</table>
<table width="1000" height="317" border="0" style="border-collapse: collapse;">


  <tr>
    <td width="26" height="21">&nbsp;</td>
    <td width="151">&nbsp;</td>
    <td width="131">&nbsp;</td>
    <td width="117">&nbsp;</td>
    <td width="28">&nbsp;</td>
    <td width="62">&nbsp;</td>
    <td width="62">&nbsp;</td>
    <td width="62">&nbsp;</td>
    <td width="15">&nbsp;</td>
    <td width="3">&nbsp;</td>
    <td width="146">&nbsp;</td>
    <td width="147">&nbsp;</td>
  </tr>
  <tr>
    <td height="21" colspan="12"><center>
      <strong>RESULTADOS DEL EXAMEN POR AREAS DE CONOCIMIENTO</strong>
    </center></td>
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
    <td colspan="4"><strong></strong></td>
  </tr>


  <tr>
    <td height="21">&nbsp;</td>
    <td  align="center" style="border-width: 1px;border: solid;" class="Estilo7" ><strong>No.</strong></td>
    <td colspan="8" align="center" style="border-width: 1px;border: solid;" class="Estilo7"><strong>NOMBRE DEL SUSTENTANTE</strong></td>
    <td colspan="2"  align="center" style="border-width: 1px;border: solid;" class="Estilo7"><strong>RESULTADO</strong><strong></strong></td>
  </tr>

  ';


$html3 = '</table>';

$html11 = '
<tr><td colspan="11">&nbsp;</td></tr>
<tr><td colspan="11">&nbsp;</td></tr> 
<tr>
    <td height="21">&nbsp;</td>
    <td colspan="3" align="center" style="border-width: 1px;border: solid;" class="Estilo7" ><strong> PRESENTARON </strong></td>
    <td colspan="3" align="center" style="border-width: 1px;border: solid;" class="Estilo7"><strong> ACREDITARON </strong></td>
    <td colspan="5" align="center" style="border-width: 1px;border: solid;" class="Estilo7"><strong> SOBRESALIENTES (150 PUNTOS) </strong></td>
</tr>
<tr>
    <td height="21">&nbsp;</td>
    <td colspan="3" align="center" style="border-width: 1px;border: solid;" class="Estilo7" > '.$totalpresentan.'</td>
    <td colspan="3" align="center" style="border-width: 1px;border: solid;" class="Estilo7"> '.($totalacreditan + $totalsobresalen).'</td>
    <td colspan="5" align="center" style="border-width: 1px;border: solid;" class="Estilo7"> '.$totalsobresalen .'</td>
</tr>
';


$res=$html. $html4. $html11. $html3.  '</body></html>';





} else {
    $html = "Lo Sentimos No Se Pudo Realizar la Consulta";
}
//echo $res;
ob_start();
$mpdf = new mPDF();
//$mpdf->AddPage('L', '', '', '', '', '', '', '', '', '', '');
$mpdf->WriteHTML($res);
$mpdf->Output("Reporte_Publicar_ResultadosExamen_". $today.".pdf", 'I');
?>
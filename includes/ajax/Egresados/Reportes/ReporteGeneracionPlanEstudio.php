<?php
date_default_timezone_set('America/Mexico_City');

require_once("../../../../includes/Config.class.php");  # Cargar datos conexion y otras variables.
require_once('../../../../includes/DB.class.php');
require_once('../../../../includes/ConsultaDB.class.php');
require_once('../../../../mpdf/mpdf.php');
require_once('../../../../includes/MisFunciones.class.php');

$Obras = new ConsultaDB;
$Funciones = new MisFunciones();

$today = date("d-m-Y");


if (isset($_GET['fk_nivelestudio'])) {
    $fk_nivelestudio = $_GET['fk_nivelestudio'];
    $fk_modalidad = $_GET['fk_modalidad'];
    $fk_carreras = $_GET['fk_carreras'];


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

        $nombreInstitucion = strtoupper($row333['nombreInstitucion']);
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


if($fk_modalidad=="1"){
    $typeRpt = "SEMESTRES";
		$ModalidadReporte="SEMESTRAL";

}else	if($fk_modalidad=="2"){
    $typeRpt = "CUATRIMESTRES";
  $ModalidadReporte="CUATRIMESTRAL";

}else if($fk_modalidad=="3"){
  $typeRpt = "TRIMESTRES";
  $ModalidadReporte="TRIMESTRAL";

}else if($fk_modalidad=="4"){
  $typeRpt = "PENTAMESTRES";
  $ModalidadReporte="PENTAMESTRAL";
}




$result33 = $Obras->ConObtenerGeneracionesTodas($fk_nivelestudio, $fk_modalidad, $fk_carreras);
if ($result33) {
    while ($row33 = mysql_fetch_assoc($result33)) {


          $Result = $Obras->ConCantidadAlumnosTituladosNoTitulados($fk_nivelestudio, $fk_modalidad, $fk_carreras, $row33['fk_generacion']);
          if ($Result) {
              while ($row2 = mysql_fetch_assoc($Result)) {
                  $cantidadLista = $row2['cantidadTotal'];
                  $cantidadListaxida=$cantidadLista+$cantidadListaxida;
              }
              mysql_free_result($Result);
          }

					$result881 = $Obras->MioConCantidadTotalAlumnosByGenTramites($fk_nivelestudio, $fk_modalidad, $fk_carreras, $row33['fk_generacion']);
					if ($result881) {
						$hombre=0; $mujer=0;
						while ($row881 = mysql_fetch_assoc($result881)) {
							 switch($row881['fk_genero']){
								 case "1":
									$hombre +=1;
								 break;
								 case "2":
									$mujer += 1;
								 break;
							}

						}
						mysql_free_result($result881);
					}

          $result452 = $Obras->ConObtenerGeneracionPlanEstudios($fk_nivelestudio, $fk_modalidad, $fk_carreras, $row33['fk_generacion']);
          if ($result452) {
            $row452 = mysql_fetch_assoc($result452);
            $totalALU += $row452['total_grupo'];
            mysql_free_result($result881);
          }



              //obtenemos la cantidad total de titulados
              $Result3 = $Obras->ConCantidadAlumnosTitulados($fk_nivelestudio, $fk_modalidad, $fk_carreras, $row33['fk_generacion']);
              if ($Result3) {
                  while ($row3 = mysql_fetch_assoc($Result3)) {
                      $cantidadTotalEgresados = $row3['cantidadTotalEgresados'];
                      $cantidadTotalEgr=$cantidadTotalEgresados+$cantidadTotalEgr;



                  $eficiencia=$cantidadTotalEgresados/$cantidadLista*100;
                  $notitulados=$cantidadLista-$cantidadTotalEgresados;
                  $notituladosListo=round($notitulados,2);

                  //truncar decimales

                  $eficienciaLista=substr($eficiencia,0,5);
			$eficienciaListaok=round($eficienciaLista);

    $color = NULL;
    if ($eficienciaListaok <= 59)
      $color = 'red';
    

$html2='
<tr>
  <td style="border-width: 1px;border: solid;">'.$row33['generacionNumero'].'</td>
  <td style="border-width: 1px;border: solid;">'.$row452['desc_planestudios'].'</td>
  <td style="border-width: 1px;border: solid;">'.$row452['no_sem'].'</td>
  <td style="border-width: 1px;border: solid;">'.$row33['DescripcionGeneracion'].'</td>
  <td style="border-width: 1px;border: solid;">'.$row452['total_grupo'].'</td>
  <td style="border-width: 1px;border: solid;">'.$cantidadLista.'</td>
  <td style="border-width: 1px;border: solid;">'.($row452['total_grupo']-$cantidadLista).'</td>
  <td style="border-width: 1px;border: solid;">'.round((($cantidadLista*100) / $row452['total_grupo'])).'%</td>
  <td style="border-width: 1px;border: solid;">'.$cantidadTotalEgresados.'</td>
  <td style="border-width: 1px;border: solid;">'.$notituladosListo.'</td>
  <td style="border-width: 1px;border: solid;color:'.$color.';">'.$eficienciaListaok.'%</td>
</tr>
';

						}
						mysql_free_result($Result3);
					}
$cantidadLista="";
$eficienciaLista="";
$notituladosListo="";
                         $html4=$html4.$html2;
        $hombreT += $hombre;
		$mujerT += $mujer;
    }
    mysql_free_result($result33);
}


//encabezado
$html='<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<table width="1100" border="0" align="center">
<tr>
    <td colspan="2" rowspan="6"><div align="center"><img src="../../../../assets/img/IESCH.png" width="117" height="121" /></div></td>
    <td colspan="8"><center><div align="center"><strong>'.$nombreInstitucion.' EN TUXTLA GUTIÉRREZ S.C.</strong></div></center></td>
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
    <td colspan="12"><strong>CARRERA: </strong> ' . $carreraReporte .'</td>
  </tr>
  <tr>
    <td colspan="12"><strong>MODALIDAD: </strong> ' . $ModalidadReporte .'</td>
  </tr>
</table>
<table width="1200" border="0" style="text-align:center;border:solid 1px #000;">
  <tr style="background-color:rgb(36, 92, 77);color:#fff;">
    <td style="color:#fff;"><b>GENERACIÓN</td>
    <td style="color:#fff;"><b>PLAN DE <br> ESTUDIOS</td>
    <td style="color:#fff;"><b>'.$typeRpt.'</td>
    <td style="color:#fff;"><b>CICLO ESCOLAR</td>
    <td style="color:#fff;"><b>INGRESO</td>
    <td style="color:#fff;"><b>EGRESO</td>
    <td style="color:#fff;"><b>DESERCIÓN</td>
    <td style="color:#fff;"><b>EFICIENCIA <br> TERMINAL</td>
    <td style="color:#fff;"><b>TITULADOS</td>
    <td style="color:#fff;"><b>NO TITULADOS</td>
    <td style="color:#fff;"><b>EFICIENCIA DE <br> TITULACIÓN</td>
  </tr>
  ';


$eficienciaFinal=$cantidadTotalEgr/$cantidadListaxida*100;
$notituladosXido=$cantidadListaxida-$cantidadTotalEgr;
//$notituladosListo=round($notitulados,2);
  $eficienciaListaXida=substr($eficienciaFinal,0,5);
  $eficienciaExacta=round($eficienciaListaXida);


$html3='
<tr style="background-color:rgb(36, 92, 77);color:#fff;">
    <td style="color:#fff;" colspan="4"><b>TOTAL</td>
    <td style="color:#fff;"><b>'.$totalALU.'</td>
    <td style="color:#fff;"><b>'.$cantidadListaxida.'</td>
    <td style="color:#fff;"><b>'.($totalALU - $cantidadListaxida).'</td>
    <td style="color:#fff;"><b>'.round( ($cantidadListaxida *100) / $totalALU ).'%</td>
    <td style="color:#fff;"><b>'.$cantidadTotalEgr.'</td>
    <td style="color:#fff;"><b>'.$notituladosXido.'</td>
    <td style="color:#fff;"><b>'.$eficienciaExacta.'%</td>
  </tr>

</table>
</body>
</html>
';




$res=$html.$html4.$html3;




} else {
    $res = "Lo Sentimos No Se Pudo Realizar la Consulta";
}


$mpdf=new mPDF('','Legal','','');
$mpdf->AddPage('L','','','','','','','','','','');
$mpdf->SetFooter('Fuente: Departamento de Egresados | Pagina {PAGENO}');
$mpdf->WriteHTML($res);
$mpdf->Output("TablaGeneracionesPlanEstudio_". $today.'.pdf', 'I');
?>

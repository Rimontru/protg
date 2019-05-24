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
$fecha=date("d/m/Y");
$fk_estadoTitulacion = $_GET['fk_estadoTitulacion'];

//if ($fk_estadoTitulacion == "2") {
//    $NombreReportePDF = "_NoTitulados_";
//} else if ($fk_estadoTitulacion == "1") {
//    $NombreReportePDF = "_Titulados_";
//} else if ($fk_estadoTitulacion == "3") {
//    $NombreReportePDF = "_Titulados_Y_NoTitulados_";




if (isset($_GET['fk_nivelestudio'])) {
    $fk_nivelestudio = $_GET['fk_nivelestudio'];
    $fk_modalidad = $_GET['fk_modalidad'];
    $fk_carreras = $_GET['fk_carreras'];
    $fk_generacion = $_GET['fk_generacion'];


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



//    $Result = $Obras->ConCantidadAlumnosTituladosNoTitulados($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fk_generacion);
//    if ($Result) {
//        while ($row2 = mysql_fetch_assoc($Result)) {
//            $cantidadLista = $row2['cantidadTotal'];
//        }
//        mysql_free_result($Result);
//    }
//
//    //obtenemos la cantidad totoal de titulados
//    $Result3 = $Obras->ConCantidadAlumnosTitulados($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fk_generacion, $fk_estadoTitulacion);
//    if ($Result3) {
//        while ($row3 = mysql_fetch_assoc($Result3)) {
//            $cantidadTotalEgresados = $row3['cantidadTotalEgresados'];
//        }
//        mysql_free_result($Result3);
//    }





//
//
//
//    //empeiza el recorrido de alumnos
//        $Result = $Obras->ConCantidadAlumnosTituladosParaReporteTodasGen($fk_nivelestudio, $fk_modalidad, $fk_carreras);
//
//    if ($Result) {
//        while ($row = mysql_fetch_assoc($Result)) {
//            
//            $generacionListaNumero = $row['generacionNumero'];
//
//            $generacionLista = $row['DescripcionGeneracion'];
//            $contador2 = $contador2 + 1;
//            $fechaSQL = explode("-", $row['FechaTomaProtesta']);
//            $fechaLista = $fechaSQL[2] . "/" . $fechaSQL[1] . "/" . $fechaSQL[0];
//
////            $fechaTitulo = explode("-", $value->fechaexpediciontitulo);
////            $fechaListaTitulo = $fechaTitulo[2] . "/" . $fechaTitulo[1] . "/" . $fechaTitulo[0];
//
//          
//
//            $html4 = $html4 . $html2;
//        }
//        mysql_free_result($Result);
//    }
//    
//    
//    
    
if($fk_modalidad=="1"){
		$ModalidadReporte="SEMESTRAL";
         }else	if($fk_modalidad=="2"){
		$ModalidadReporte="CUATRIMESTRAL";
         }else if($fk_modalidad=="3"){
		$ModalidadReporte="TRIMESTRAL";
         }else if($fk_modalidad=="4"){
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

$html2="

<tr>
	<td align='center' style='border-width: 1px;border: solid;' colspan='2'><div align='center'>".$row33['generacionNumero']."</div></td>
	<td align='center' style='border-width: 1px;border: solid;'  ><div align='center'>".$row33['DescripcionGeneracion']."</div></td>
	<td class='Estilo2'  align='center' style='border-width: 1px;border: solid;'  colspan='1'><div align='center'>$hombre</div></td>
	<td class='Estilo2'  align='center' style='border-width: 1px;border: solid;'  colspan='1'><div align='center'>$mujer</div></td>
	<td align='center'  style='border-width: 1px;border: solid;' ><div align='center'>". $cantidadLista."</div></td>
	<td align='center' style='border-width: 1px;border: solid;' ><div align='center'>$cantidadTotalEgresados</div></td>
	<td align='center' style='border-width: 1px;border: solid;' ><div align='center'>$eficienciaListaok</div></td>
	<td align='center' style='border-width: 1px;border: solid;'  colspan='2'><div align='center'>$notituladosListo</div></td>
</tr> 

 ";
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



//
//$result=$consulta->selectbd(" Select DISTINCT generacion,generacionNumero,modalidad from tramites where carrera='".$carreraTitulados."' and modalidad='".$modalidadTitulados."'  order by generacion ASC");
//foreach ($result as $key => $value) {
//    
//    
//    
//    
//    
//    
//     $consultaCantidad = new Conexion();
//    $resultEgresados = $consultaCantidad->selectbd("select COUNT(*) as cantidadTotal from tramites where generacion='" . $value->generacion . "' and carrera='" . $carreraTitulados . "' and modalidad='".$modalidadTitulados."' ");
//    foreach ($resultEgresados as $key => $valueTotalEgresados) {
//        $cantidadLista = $valueTotalEgresados->cantidadTotal;
//        $cantidadListaxida=$cantidadLista+$cantidadListaxida;
//    }
//        
//    
//    
//    
//    
//    $consultaCantEgresados = new Conexion();
//    $resultcantidadTotalEgresados = $consultaCantEgresados->selectbd("select COUNT(*) as cantidadTotalEgresados from tramites where comboTitulacion='Titulado'  and generacion='" . $value->generacion . "' and carrera='" . $carreraTitulados . "' and modalidad='".$modalidadTitulados."'  ");
//    foreach ($resultcantidadTotalEgresados as $key => $valuecantidadTotalEgresados) {
//        $cantidadTotalEgresados = $valuecantidadTotalEgresados->cantidadTotalEgresados;
//        $cantidadTotalEgr=$cantidadTotalEgresados+$cantidadTotalEgr;
//    }
//
//    
//    
//    
//    
//    
//    
//   
//$eficiencia=$cantidadTotalEgresados/$cantidadLista*100;
//$notitulados=$cantidadLista-$cantidadTotalEgresados;
//$notituladosListo=round($notitulados,2);
//
////truncar decimales
//
//$eficienciaLista=substr($eficiencia,0,5);
//    
//        $html2="
//  <tr>
//    <td align='center' style='border-width: 1px;border: solid;' colspan='2'><div align='center'>$value->generacionNumero</div></td>
//    <td align='center' style='border-width: 1px;border: solid;'  ><div align='center'>$value->generacion</div></td>
//    <td align='center'  style='border-width: 1px;border: solid;' ><div align='center'>$valueTotalEgresados->cantidadTotal</div></td>
//    <td align='center' style='border-width: 1px;border: solid;' ><div align='center'>$cantidadTotalEgresados</div></td>
//    <td align='center' style='border-width: 1px;border: solid;' ><div align='center'>$eficienciaLista</div></td>
//    <td align='center' style='border-width: 1px;border: solid;'  colspan='2'><div align='center'>$notituladosListo</div></td>
//  </tr> 
//        
//        ";
//
// $html4=$html4.$html2;
//        }
//        
//  
//    
//    
//    
    
    
    
    
 


//encabezado
$html='<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo1 {font-size: 11px}
.pie {font-size: 9px}
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
    <td colspan="13"><center><div align="center"><strong>FECHA DE REPORTE:'.$fecha.'<strong></div>
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
<table width="698" height="139" border="0" align="center" style="border-collapse: collapse;">
  <tr>
    <td colspan="8" align="center"><div align="center">'.$carreraTitulados.'</div></td>
  </tr>
  <tr>
    <td colspan="2"  style="border-width: 1px;border: solid;" bgcolor="#009933" align="center"><div align="center"><span class="Estilo1">GENERACI&Oacute;N</span></div></td>
    <td align="center" width="250" style="border-width: 1px;border: solid;" bgcolor="#009933"><div align="center"><span class="Estilo1">CICLO ESCOLAR</span></div></td>
	 <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933" colspan="1"><div align="center"><span class="Estilo1">H</span></div><div align="center"><span class="Estilo1"></span></div></td>
	  <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933" colspan="1"><div align="center"><span class="Estilo1">M</span></div><div align="center"><span class="Estilo1"></span></div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933"> <div align="center"><span class="Estilo1">ALUMNOS EGRESADOS</span></div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933"><div align="center"><span class="Estilo1">TITULADOS</span></div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933"><div align="center"><span class="Estilo1">EFICIENCIA DE TITULACI&Oacute;N</span></div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933" colspan="2"><div align="center"><span class="Estilo1">NO TITULADOS</span></div>      <div align="center"><span class="Estilo1"></span></div></td>
  </tr>

  ';


$eficienciaFinal=$cantidadTotalEgr/$cantidadListaxida*100;
$notituladosXido=$cantidadListaxida-$cantidadTotalEgr;
//$notituladosListo=round($notitulados,2);
  $eficienciaListaXida=substr($eficienciaFinal,0,5);
  $eficienciaExacta=round($eficienciaListaXida);
  
  
$html3='
    
  <tr>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933" colspan="2"><div align="center"></div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933"><div align="center">TOTALES: </div></td>
	<td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933"  colspan="1"><div align="center"></div>'.$hombreT.'</td>
	<td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933" colspan="1"><div align="center"></div>'.$mujerT.'</td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933"><div align="center">'.$cantidadListaxida.'</div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933"><div align="center">'.$cantidadTotalEgr.'</div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933"><div align="center">'.$eficienciaExacta.'%'.'</div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933" colspan="2"><div align="center">'.$notituladosXido.'</div></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</div></td>
 </tr>
  <tr>
    <td colspan="2">&nbsp;</div></td>
 </tr>
  <tr>
    <td colspan="2">&nbsp;</div></td>
 </tr>
  <tr>
    <td colspan="2">&nbsp;</div></td>
 </tr>
   <tr>
    <td colspan="8" class="pie"><center><strong> FUENTE: DEPARTAMENTO DE SEGUIMIENTO DE EGRESADOS</strong></center></td>
 </tr>
  
</table>
</body>
</html>
';






$res=$html.$html4.$html3;






    
} else {
    $html = "Lo Sentimos No Se Pudo Realizar la Consulta";
}
//echo $res;






$mpdf = new mPDF();

$mpdf->WriteHTML($res);
$mpdf->Output("TablaGeneraciones_". $today.'.pdf', 'I');
?> 

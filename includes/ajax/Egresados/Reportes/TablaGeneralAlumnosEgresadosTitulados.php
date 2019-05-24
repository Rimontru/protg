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

    $result33 = $Obras->ConReporteAlumnosTituloExpedidoSoloTitulados($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fechaInicio, $fechaFin);
    if ($result33) {
        while ($row33 = mysql_fetch_assoc($result33)) {

            
        }
        mysql_free_result($result33);
    }





//obtenemos todas las carreras
//    $resultCarreras = $consultaCarreras->selectbd(" Select *  from carreras where  modalidad='" . $modalidadTitulados . "'  order by nombre ASC");
    $resultCarreras = $Obras->ConsultaCarrerasPorModalidad($fk_nivelestudio, $fk_modalidad);
    if ($resultCarreras) {
        while ($row33 = mysql_fetch_assoc($resultCarreras)) {
        // foreach ($resultCarreras as $key => $valueCarreras) {
        //$row33['pk_carreras']



            
        //obtenemos la generacion mas alta
//        $consultaGeneracionNumero = new Conexion();
//        $resultgeneracion = $consultaGeneracionNumero->selectbd("select generacionNumero from tramites where carrera='" . $valueCarreras->nombre . "' ");
//        foreach ($resultgeneracion as $key => $valueGeneracionNumero) {
//            $numero = $valueGeneracionNumero->generacionNumero;
//
//            if ($numero > $mayor) {
//                $mayor = $numero;
//            }
//        }

        //obtenemos la generacion mas alta
           $result56 = $Obras->ConGeneracionMasAltaPorCarrera($fk_nivelestudio, $fk_modalidad, $row33['pk_carreras']);
            if ($result56) {
                while ($row56 = mysql_fetch_assoc($result56)) {
                     $numero = $row56['generacionNumero'];
                        if ($numero > $mayor) {
                            $mayor = $numero;
                        }
                }
                mysql_free_result($result56);
            }






//        $consultaCantidad = new Conexion();
//        $resultEgresados = $consultaCantidad->selectbd("select COUNT(*) as cantidadTotal from tramites where carrera='" . $valueCarreras->nombre . "' and modalidad='" . $modalidadTitulados . "'");
//        foreach ($resultEgresados as $key => $valueTotalEgresados) {
//            $cantidadLista = $valueTotalEgresados->cantidadTotal;
//            $cantidadListaxida = $cantidadLista + $cantidadListaxida;
//            $cantidadT = $cantidadListaxida + $cantidadT;
//        }
         $result88 = $Obras->ConCantidadTotalAlumnosTramites($fk_nivelestudio, $fk_modalidad, $row33['pk_carreras']);
            if ($result88) {
                while ($row88 = mysql_fetch_assoc($result88)) {
                     
                            $cantidadLista = $row88['cantidadTotal'];
                            $cantidadListaxida = $cantidadLista + $cantidadListaxida;
                            $cantidadT = $cantidadListaxida + $cantidadT;
                     
                     
                }
                mysql_free_result($result88);
            }
			$i=1;
			 $result881 = $Obras->MioConCantidadTotalAlumnosTramites($fk_nivelestudio, $fk_modalidad, $row33['pk_carreras']);
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
//if($fk_nivelestudio=="2"){


//ingeniero constructor     INGENIERO ZOOTECNISTA ADMINISTRADOR            //sistemas                           civil                       ///medico
//if( $fk_carreras =="6" ||  $fk_carreras =="7"  ||  $fk_carreras =="11" ||  $fk_carreras =="27" ||  $fk_carreras =="13"  ||  $fk_carreras =="12"){
//    $carreraReporte=$carreraReporte;


//}else if( $fk_carreras =="2" ||  $fk_carreras =="29"){
	 $carreraReporte=$carreraReporte;
//}else{
//	$hola=explode(" ", $carreraReporte);
	
//     $carreraReporte=$hola[2]." ".$hola[3]." ".$hola[4]." ".$hola[5];
    
//}

// }



if($fk_modalidad=="1"){
		$ModalidadReporte="SEMESTRAL";
         }else	if($fk_modalidad=="2"){
		$ModalidadReporte="CUATRIMESTRAL";
         }else if($fk_modalidad=="3"){
		$ModalidadReporte="TRIMESTRAL";
         }else if($fk_modalidad=="4"){
		$ModalidadReporte="PENTAMESTRAL";
         }




        
        
//        $consultaCantEgresados = new Conexion();
//        $resultcantidadTotalEgresados = $consultaCantEgresados->selectbd("select COUNT(*) as cantidadTotalEgresados from tramites where comboTitulacion='Titulado' and carrera='" . $valueCarreras->nombre . "' and modalidad='" . $modalidadTitulados . "' ");
//        foreach ($resultcantidadTotalEgresados as $key => $valuecantidadTotalEgresados) {
//            $cantidadTotalEgresados = $valuecantidadTotalEgresados->cantidadTotalEgresados;
//            $cantidadTotalEgr = $cantidadTotalEgresados + $cantidadTotalEgr;
//            $cantidadTitulados = $cantidadTitulados + $cantidadTotalEgresados;
//        }

        
            $result99 = $Obras->ConCantidadTotalAlumnosEgresadosTit($fk_nivelestudio, $fk_modalidad, $row33['pk_carreras']);
            if ($result99) {
                while ($row99 = mysql_fetch_assoc($result99)) {
                     
                            $cantidadTotalEgresados = $row99['cantidadTotalEgresados'];
                            $cantidadTotalEgr = $cantidadTotalEgresados + $cantidadTotalEgr;
                            $cantidadTitulados = $cantidadTitulados + $cantidadTotalEgresados;
                     
                     
                }
                mysql_free_result($result99);
            }
            
            
	$porcentaje = $cantidadTotalEgresados / $cantidadLista * 100;
	$porcentajeListo = round($porcentaje,0);
            


        $eficiencia = $cantidadTotalEgresados / $cantidadLista * 100;
        $notitulados = $cantidadLista - $cantidadTotalEgresados;
        $notituladosListo = round($notitulados, 2);

       //truncar decimales 
        $eficienciaLista = substr($eficiencia, 0, 5);






        $eficienciaFinal = $cantidadTotalEgr / $cantidadListaxida * 100;
        $notituladosXido = $cantidadListaxida - $cantidadTotalEgr;
        //$notituladosListo=round($notitulados,2);
        $eficienciaListaXida = substr($eficienciaFinal, 0, 5);


        //igualamos variables a cero
        $cantidadListaxida = 0;
        //$cantidadTitulados=0;

        $html2 = "

  <tr>
    <td class='Estilo2' align='left' style='border-width: 1px;border: solid;' colspan='2'><div align='left'>".$row33[nombreCarrera]."</div></td>
    <td class='Estilo2'  align='center'  style='border-width: 1px;border: solid;' ><div align='center'></div>$mayor</td>
	<td class='Estilo2'  align='center' style='border-width: 1px;border: solid;'  colspan='1'><div align='center'>$hombre</div></td>
	<td class='Estilo2'  align='center' style='border-width: 1px;border: solid;'  colspan='1'><div align='center'>$mujer</div></td>
    <td class='Estilo2'  align='center' style='border-width: 1px;border: solid;' ><div align='center'>$cantidadLista</div></td>
    <td class='Estilo2'  align='center' style='border-width: 1px;border: solid;' ><div align='center'>$cantidadTotalEgresados</div></td>
    <td class='Estilo2'  align='center' style='border-width: 1px;border: solid;'  colspan='2'><div align='center'>$notituladosListo</div></td>
    <td class='Estilo2'  align='center' style='border-width: 1px;border: solid;'  colspan='2'><div align='center'>$porcentajeListo %</div></td>
  </tr> 
        
        ";
        $mayor = 0;
        $html4 = $html4 . $html2;
        
		$hombreT += $hombre;
		$mujerT += $mujer;
          }
        mysql_free_result($resultCarreras);
    
        
}  //fin consulta carreras

    
    
//encabezado
    $html = '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo1 {font-size: 12px}
.Estilo2 {font-size: 11px}
-->
</style>
</head>

<body>
<table width="785" border="0" align="center">
<tr>
    <td colspan="2" rowspan="6"><div align="center"><img src="../../../../assets/img/IESCH.png" width="117" height="121" /></div></td>
    <td colspan="8"><center><div align="center"><strong>' . $nombreInstitucion . '</strong></div></center></td>
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
    <td colspan="8"><center><div align="center"><strong>OFICIO No. ' . $numerooficio . ' DE FECHA ' . $fechaIncorporacionsecretaria . '</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan="8"><center><div align="center"><strong>RÉGIMEN: ' . $regimen . '    CLAVE: </strong><strong>' . $clave . '</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan="8"><center><div align="center"><strong>EXCELENCIA ACADÉMICA: REG. ' . $registro . '  </strong></div>
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
    <td colspan="12"><strong>MODALIDAD:</strong> ' . $ModalidadReporte. '</td>
  </tr>
</table>
<table width="698" height="139" border="0" align="center" style="border-collapse: collapse;">
  <tr>
    <td colspan="8" align="center"><div align="center">' . $carreraTitulados . '</div></td>
  </tr>

  <tr>
    <td colspan="2" style="border-width: 1px;border: solid;" bgcolor="#009933" align="center"><div align="center"><span class="Estilo1">';
	
	if($fk_nivelestudio=="3"){
	$html.="MAESTRIAS";
	}
	else
	{
	if($fk_nivelestudio=="2")
	$html.="LICENCIATURAS";
	}
	
	if($fk_nivelestudio=="4"){
	$html.="DOCTORADOS";
	}
	



$html.='</span></div></td>
      <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933"> <div align="center"><span class="Estilo1">GENERACIONES</span></div></td>
	  	 <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933" colspan="1"><div align="center"><span class="Estilo1">H</span></div><div align="center"><span class="Estilo1"></span></div></td>
	  <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933" colspan="1"><div align="center"><span class="Estilo1">M</span></div><div align="center"><span class="Estilo1"></span></div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933"><div align="center"><span class="Estilo1">EGRESADOS</span></div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933"><div align="center"><span class="Estilo1">TITULADOS</span></div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933" colspan="2"><div align="center"><span class="Estilo1">NO TITULADOS</span></div>      <div align="center"><span class="Estilo1"></span></div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933" colspan="2"><div align="center"><span class="Estilo1">TITULACION</span></div>      <div align="center"><span class="Estilo1"></span></div></td>
  </tr>
 
  ';
    $notituladosXido = $cantidadT - $cantidadTitulados;
    $porcentajeTotal = $cantidadTitulados / $cantidadT * 100;
    $porcentajeTotalListo = round($porcentajeTotal,0);




    $html3 = '
    
<tr>
    <td style="border-width: 1px;border: solid;" bgcolor="#009933" colspan="3">TOTALES: </td>
	<td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933"><div align="center">' .$hombreT. '</div></td>
	<td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933"><div align="center">' .$mujerT. '</div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933"><div align="center">' . $cantidadT . '</div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933"><div align="center">' . $cantidadTitulados . '</div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933" colspan="2"><div align="center">' . $notituladosXido . '</div></td>
    <td align="center" style="border-width: 1px;border: solid;" bgcolor="#009933" colspan="2"><div align="center">' . $porcentajeTotalListo . '%</div></td>
  </tr>

</table>
</body>
</html>
';






    $res = $html . $html4 . $html3;
} else {
    $html = "Lo Sentimos No Se Pudo Realizar la Consulta";
}
//echo $res;






 $mpdf = new mPDF();

$mpdf->WriteHTML($res);
$mpdf->Output("TablaGeneralAlumnosEgresadosyTitulados" . $today.'.pdf', 'I');
?> 

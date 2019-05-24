<?php

require_once("../../../../includes/Config.class.php");  # Cargar datos conexion y otras variables.
require_once('../../../../includes/DB.class.php');
require_once('../../../../includes/ConsultaDB.class.php');
require_once('../../../../mpdf/mpdf.php');
require_once('../../../../includes/MisFunciones.class.php');

$Obras = new ConsultaDB;
$Funciones = new MisFunciones();

$today = date("d-m-Y");

$fk_estadoTitulacion = $_GET['fk_estadoTitulacion'];

if ($fk_estadoTitulacion == "2") {
    $NombreReportePDF = "_NoTitulados_";
} else if ($fk_estadoTitulacion == "1") {
    $NombreReportePDF = "_Titulados_";
} else if ($fk_estadoTitulacion == "3") {
    $NombreReportePDF = "_Titulados_Y_NoTitulados_";
}



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




if($fk_nivelestudio=="2"){


//ingeniero constructor     INGENIERO ZOOTECNISTA ADMINISTRADOR            //sistemas                           civil                       ///medico
if( $fk_carreras =="6" ||  $fk_carreras =="7"  ||  $fk_carreras =="11" ||  $fk_carreras =="27" ||  $fk_carreras =="13"  ||  $fk_carreras =="12"){
    $carreraReporte=$carreraReporte;


}else if( $fk_carreras =="2" ||  $fk_carreras =="29"){
	 $carreraReporte=$carreraReporte;
}else{
	$hola=explode(" ", $carreraReporte);
	
     $carreraReporte=$hola[2]." ".$hola[3]." ".$hola[4]." ".$hola[5];
    
}

 }



	if($fk_modalidad=="1"){
		$ModalidadReporte="SEMESTRAL";
         }else	if($fk_modalidad=="2"){
		$ModalidadReporte="CUATRIMESTRAL";
         }else if($fk_modalidad=="3"){
		$ModalidadReporte="MIXTO";
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


$autorizacion = $row[NumeroAutorizacion];

 



    $Result = $Obras->ConCantidadAlumnosTituladosNoTitulados($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fk_generacion);
    if ($Result) {
        while ($row2 = mysql_fetch_assoc($Result)) {
            $cantidadLista = $row2['cantidadTotal'];


        }
        mysql_free_result($Result);
    }

    //obtenemos la cantidad totoal de titulados
    $Result3 = $Obras->ConCantidadAlumnosTitulados($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fk_generacion, $fk_estadoTitulacion);
    if ($Result3) {
        while ($row3 = mysql_fetch_assoc($Result3)) {
            $cantidadTotalEgresados = $row3['cantidadTotalEgresados'];

        }

        mysql_free_result($Result3);
    }


    //empeiza el recorrido de alumnos
//    $html = $cantidadLista . " Cantidad de egresados: " . $cantidadTotalEgresados;
if ($fk_estadoTitulacion == "2") {
    $NombreReportePDF = "_NoTitulados_";
    
        $Result = $Obras->ConCantidadAlumnosTituladosParaReporte($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fk_generacion, $fk_estadoTitulacion);

    
} else if ($fk_estadoTitulacion == "1") {
    $NombreReportePDF = "_Titulados_";
    
        $Result = $Obras->ConCantidadAlumnosTituladosParaReporte($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fk_generacion, $fk_estadoTitulacion);

    
} else if ($fk_estadoTitulacion == "3") {
    $NombreReportePDF = "_Titulados_Y_NoTitulados_";
    
         $Result = $Obras->ConCantidadAlumnosTituladosParaReporteAMBOS($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fk_generacion);

    
    
}

    //obtenemos la cantidad totoal de titulados
    if ($Result) {
        while ($row = mysql_fetch_assoc($Result)) {
$fechaListaTitulo=$row[fechaexpediciontitulo];

            $generacionListaNumero = $row['generacionNumero'];

            $generacionLista = $row['DescripcionGeneracion'];
            $contador2 = $contador2 + 1;
            $fechaSQL = explode("-", $row['FechaTomaProtesta']);
            $fechaLista = $fechaSQL[2] . "/" . $fechaSQL[1] . "/" . $fechaSQL[0];

$autorizacion=$row['NumeroAutorizacion'];
$NumAutorizacion=substr($autorizacion, -4);


//            $fechaTitulo = explode("-", $value->fechaexpediciontitulo);
//            $fechaListaTitulo = $fechaTitulo[2] . "/" . $fechaTitulo[1] . "/" . $fechaTitulo[0];


$noActaExamen=$row['noActaExamen'];

//$encabezado="HOLA";
//$mpdf->setheader($encabezado);


    $html = '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; " />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
.Estilo1 {font-size: 10px;text-aling:center;}
</style>
</head>

<body>

<table width="980" border="0" align="center">
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
    <td colspan="12"><center><strong>CARRERA: </strong> ' . $carreraReporte . ' <strong> MODALIDAD: </strong> ' . $ModalidadReporte  .   '  <strong>  CICLO ESCOLAR: </strong>  '  .  $generacionLista   .'</center></td>
  </tr>
</table>

<table width="980" border="0" align="center">
  
 <tr>
        <td width="18" bgcolor="#999999" align="center"><span class="Estilo1">No</span></td>
     <td width="10" bgcolor="#999999" align="center"><span class="Estilo1">Matrícula</span></td>
    <td width="150" bgcolor="#999999" align="center"><span class="Estilo1">Nombre</span></td>
    <td width="28" bgcolor="#999999" align="center"><span class="Estilo1">Turno</span></td>
    <td width="28" bgcolor="#999999" align="center"><span class="Estilo1">No Acta</span></td>
    <td width="28" bgcolor="#999999" align="center"><span class="Estilo1">Toma de Protesta</span></td>   
    <td width="120" bgcolor="#999999" align="center"><span class="Estilo1">Opción Titulación</span></td>
    <td width="150" bgcolor="#999999" align="center"><span class="Estilo1">Tipo de Acreditación</span></td>
    <td width="42" bgcolor="#999999" align="center"><span class="Estilo1">No Folio Título</span></td>
    <td width="28" bgcolor="#999999" align="center"><span class="Estilo1">Exp. de Título</span></td>
    
  </tr>
  
  ';





            if($row['fk_estadoTitulacion']=='2'){
                      $html2 = '<tr>
                                      <td width="18"  bgcolor="#CCFF66"><span class="Estilo1">'.$contador2.'</span></td>
                                      <td width="10" bgcolor="#CCFF66"><span class="Estilo1">'.$row['matricula'].'</span></td>
                                      <td width="150" bgcolor="#CCFF66"><span class="Estilo1">'.$row['NombreCompleto'].'</span></td>
                                      <td width="28" bgcolor="#CCFF66"><span class="Estilo1">'.$row['DescripcionTurnos'].'</span></td>
                                      <td width="28" bgcolor="#CCFF66" align="center"><span class="Estilo1">'.$row['noActaExamen'].'</span></td>
                                      <td width="28" bgcolor="#CCFF66" align="center"><span class="Estilo1">'.$fechaLista.' </span></td>   
                                      <td width="120" bgcolor="#CCFF66"><span class="Estilo1">'.$row['NombreOpcionTitulacion'].'</span></td>
                                      <td width="150" bgcolor="#CCFF66" align="center"><span class="Estilo1">'.$row['TipoAcreditacion'].'</span></td>
                                      <td width="42" bgcolor="#CCFF66" align="center"><span class="Estilo1">'.$row['noactatitulo'].'</span></td>
                                      <td width="28" bgcolor="#CCFF66"><span class="Estilo1">'.$fechaListaTitulo.'</span></td>

                                    </tr>';

                        $html4 = $html4 . $html2;
                
            }else  if($row['fk_estadoTitulacion']=='1'){
            
                        $html2 = '<tr>
                                    <td width="18"  ><span class="Estilo1">'.$contador2.'</span></td>
                                      <td width="10" ><span class="Estilo1">'.$row['matricula'].'</span></td>
                                      <td width="150" ><span class="Estilo1">'.$row['NombreCompleto'].'</span></td>
                                      <td width="28" ><span class="Estilo1">'.$row['DescripcionTurnos'].'</span></td>
                                      <td width="28"  align="center"><span class="Estilo1">'.$row['noActaExamen'].'</span></td>
                                      <td width="28"  align="center"><span class="Estilo1">'.$fechaLista.' </span></td>   
                                      <td width="120" ><span class="Estilo1">'.$row['NombreOpcionTitulacion'].'</span></td>
                                      <td width="150"  align="center"><span class="Estilo1">'.$row['TipoAcreditacion'].'</span></td>
                                      <td width="42"  align="center"><span class="Estilo1">'.$row['noactatitulo'].'</span></td>
                                      <td width="28" ><span class="Estilo1">'.$fechaListaTitulo.'</span></td>

                                    </tr>';

                        $html4 = $html4 . $html2;
                }else  if($row['fk_estadoTitulacion']=='3'){
            
                        $html2 = '<tr>
                                     <td width="18"  bgcolor="#CCFF66"><span class="Estilo1">'.$contador2.'</span></td>
                                      <td width="10" bgcolor="#CCFF66"><span class="Estilo1">'.$row['matricula'].'</span></td>
                                      <td width="150" bgcolor="#CCFF66"><span class="Estilo1">'.$row['NombreCompleto'].'</span></td>
                                      <td width="28" bgcolor="#CCFF66"><span class="Estilo1">'.$row['DescripcionTurnos'].'</span></td>
                                      <td width="28" bgcolor="#CCFF66" align="center"><span class="Estilo1">'.$row['noActaExamen'].'</span></td>
                                      <td width="28" bgcolor="#CCFF66" ><span class="Estilo1">'.$fechaLista.' </span></td>   
                                      <td width="120" bgcolor="#CCFF66"><span class="Estilo1">'.$row['NombreOpcionTitulacion'].'</span></td>
                                      <td width="150" bgcolor="#CCFF66" align="center"><span class="Estilo1">'.$row['TipoAcreditacion'].'</span></td>
                                      <td width="42" bgcolor="#CCFF66" align="center"><span class="Estilo1">'.$row['noactatitulo'].'</span></td>
                                      <td width="28" bgcolor="#CCFF66"><span class="Estilo1">'.$fechaListaTitulo.'</span></td>

                                    </tr>';

                        $html4 = $html4 . $html2;
                }
        }
        mysql_free_result($Result);
    }
    
    
    
    
    $efici=$cantidadTotalEgresados/$cantidadLista*100;
$eficiencia=number_format ($efici,1,'.','');
$notitulados=$cantidadLista-$cantidadTotalEgresados;

$notituladosListo=round($notitulados,2);


$html3='</table>

<br>
<table width="698" height="139" border="0" align="center">
  <tr>
    <td colspan="8" align="center"><div align="center">'.$carreraTitulados.'</div></td>
  </tr>

  <tr>
    <td colspan="8" align="center">TABLA REFERENCIAL</td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="8" align="center">'.$carreraReporte.'</td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" colspan="2"><div align="center"><span class="Estilo1">GENERACIÓN</span></div></td>
    <td align="center"><div align="center"><span class="Estilo1">CICLO ESCOLAR</span></div></td>
    <td align="center"><div align="center"><span class="Estilo1">ALUMNOS EGRESADOS</span></div></td>
    <td align="center"><div align="center"><span class="Estilo1">TITULADOS</span></div></td>
    <td align="center"><div align="center"><span class="Estilo1">EFICIENCIA DE TITULACIÓN</span></div></td>
    <td align="center" colspan="2"><div align="center"><span class="Estilo1">NO TITULADOS</span></div>      <div align="center"><span class="Estilo1"></span></div></td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" colspan="2"><div align="center">'.$generacionListaNumero.'</div></td>
    <td align="center"> <div align="center">'.$generacionLista.'</div></td>
    <td align="center"><div align="center">'.$cantidadLista.'</div></td>
    <td align="center"><div align="center">'.$cantidadTotalEgresados.'</div></td>
    <td align="center"><div align="center">'.$eficiencia.'</div></td>
    <td  align="center" colspan="2"><div align="center">'.$notituladosListo.'</div></td>
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
$timeo_start = microtime(true);
ini_set("memory_limit","4824M");
ini_set('max_execution_time', 400);
ob_start();




$mpdf=new mPDF('','', 0, '', 20, 10, 5, 9, 9, 9, 'L'); 
$mpdf->AddPage('A4','','','','','','','','','','');
$mpdf->SetFooter(''.$generacionLista.'   | Fuente: Departamento de Egresados | Pagina {PAGENO}');
$mpdf->WriteHTML($res);
$mpdf->Output("Reporte_Egresados".$NombreReportePDF."_". $today.'.pdf', 'I');
?> 

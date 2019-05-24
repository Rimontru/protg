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




if (empty($_GET['fk_generacion'])) {
    $fk_nivelestudio = $_GET['fk_nivelestudio'];
    $fk_modalidad = $_GET['fk_modalidad'];
    $fk_carreras = $_GET['fk_carreras'];
    $fk_generacion = $_GET['fk_generacion'];


if($fk_modalidad=="1"){
		$ModalidadReporte="SEMESTRAL";
         }else	if($fk_modalidad=="2"){
		$ModalidadReporte="CUATRIMESTRAL";
         }else if($fk_modalidad=="3"){
		$ModalidadReporte="TRIMESTRAL";
         }else if($fk_modalidad=="4"){
		$ModalidadReporte="PENTAMESTRAL";
         }


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

        $nombreInstitucion =strtoupper( $row333['nombreInstitucion']);
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

	$Result8 = $Obras->PromedioEgresados($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion);
    if ($Result8) {
        $row8 = mysql_fetch_assoc($Result8);
        $Promedio = $row8['Promedio'];
        $Promedio= number_format($Promedio, 1);
        $generacionLista = $row8['DescripcionGeneracion'];

        mysql_free_result($Result8);
    }


   	$especialidad = 0;
        $maestria = 0;
        $ceneval = 0;
        $institucional = 0;
        $promedio = 0;
        $titulacion = 0;
        $tesis = 0;
        $experiencia = 0;
	$tesisgrado = 0;
    	$estudioposgradodoctorado = 0;
    	$tesiscolectiva = 0;
    
    $html = '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo1 {font-size: 10px}
.ESTLOS {
	font-size: 12px;
}
.estilo {
	font-size: 12px;
}
}
.black {
    font-weight: bold;
}
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
    <td colspan="12"><center><div align="center"><strong>GENERACION: '.$generacionLista.'</strong></div>
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

<center><div align="center"><strong>CARRERA:</strong>  '.$carreraReporte.' <strong>MODALIDAD:</strong> <U>'.$ModalidadReporte.'</U> </div></center>
  </br>

  
  ';
    
    
     $mujer =0;
    $hombre=0;
    $totalSexo=0;
//    
//    $result44 = $Obras->ConReporteAlumnosTituloExpedidoSoloTitulados($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fechaInicio, $fechaFin);
//if ($result44) {
//    while ($row44 = mysql_fetch_assoc($result44)) {
//       
//      }
//    }
//      
  

$contador2=0;
    
$result33 = $Obras->ConReporteAlumnosTituloExpedidoSoloTitulados($fk_nivelestudio, $fk_modalidad, $fk_carreras,/*$fk_generacion,*/ $fechaInicio, $fechaFin);
if ($result33) {
    while ($row33 = mysql_fetch_assoc($result33)) {
        
        
    $FechaExpTitulo = $row33['fechaexpediciontitulo'];
    

        if(trim($row33['fk_genero'])=="1"){
            $hombre = $hombre+1;
        }else if(trim($row33['fk_genero'])=="2"){
            $mujer = $mujer+1;
        }
//        
//        echo $row33['pk_titulacion'];
//        
//                if($row33['pk_titulacion']=="1"){
                      $contador2=$contador2+1;
                                       //ESTUDIO DE POSGRADO (ESPECIALIDAD)
                                        if(trim($row33['pk_titulacion'])=="5"){
                                           $especialidad=$especialidad+1;
                                       }
                                       //ESTUDIOS DE POSGRADO (50% DE MAESTRIA)
                                       if(trim($row33['pk_titulacion'])=="1"){
                                           $maestria=$maestria+1;
                                       }
                                       //SUSTENTACION DE EXAMEN POR AREAS DE CONOCIMIENTO (CENEVAL)
                                        if(trim($row33['pk_titulacion'])=="4"){
                                           $ceneval=$ceneval+1;
                                       }
                                       //SUSTENTACION DE EXAMEN POR AREAS DE CONOCIMIENTO
                                       if(trim($row33['pk_titulacion'])=="3"){
                                           $institucional=$institucional+1;
                                         
                                       }
                                       //PROMEDIO GENERAL DE CALIFICACIONES
                                       if(trim($row33['pk_titulacion'])=="2"){
                                           $promedio=$promedio+1;
                                       }
                                       //CURSO DE TITULACION
                                        if(trim($row33['pk_titulacion'])=="6"){
                                           $titulacion=$titulacion+1;
                                       }
                                       //TESIS PROFESIONAL
                                       if(trim($row33['pk_titulacion'])=="7"){
                                           $tesis=$tesis+1;
                                       }
					//EXPERIENCIA PROFESIONAL
                                       if(trim($row33['pk_titulacion'])=="8"){
                                           $experiencia=$experiencia+1;
                                       }
					//TESIS DE GRADO
                                       if(trim($row33['pk_titulacion'])=="10"){
                                           $tesisgrado=$tesisgrado+1;
                                       }
                    		      //Estudios de Posgrado (50% Doctorado)
                                       if(trim($row33['pk_titulacion'])=="11"){
                                           $estudioposgradodoctorado=$estudioposgradodoctorado+1;
                                       }                   
					//TESIS COLECTIVA
                                       if(trim($row33['pk_titulacion'])=="12"){
                                           $tesiscolectiva=$tesiscolectiva+1;
                                       }
//               }
        
//        $html4 = $html4 . $html2;
      
        
          
    }
    mysql_free_result($result33);
}


  
    
     $totalSexo = $mujer + $hombre;

//PORCENTAJES OPCIONES DE TITULACION

	$maestriaporcentaje = $maestria/$contador2*100;
	$maestriaporcentaje = number_format($maestriaporcentaje,1);

	$promedioporcentaje = $promedio/$contador2*100;
	$promedioporcentaje = number_format($promedioporcentaje,1);

	$institucionalporcentaje = $institucional/$contador2*100;
	$institucionalporcentaje = number_format($institucionalporcentaje,1);

	$cenevalporcentaje = $ceneval/$contador2*100;
	$cenevalporcentaje = number_format($cenevalporcentaje,1);

	$especialidadporcentaje = $especialidad/$contador2*100;
	$especialidadporcentaje = number_format($especialidadporcentaje,1);

	$titulacionporcentaje = $titulacion/$contador2*100;
	$titulacionporcentaje = number_format($titulacionporcentaje,1);

	$tesisporcentaje = $tesis/$contador2*100;
	$tesisporcentaje = number_format($tesisporcentaje,1);

	$experienciaporcentaje = $experiencia/$contador2*100;
	$experienciaporcentaje = number_format($experienciaporcentaje,1);

	$tesisgradoporcentaje = $tesisgrado/$contador2*100;
	$tesisgradoporcentaje = number_format($tesisgradoporcentaje,1);
    
	$estudioposgradodoctoradoporcentaje = $estudioposgradodoctorado/$contador2*100;
	$estudioposgradodoctoradoporcentaje = number_format($estudioposgradodoctoradoporcentaje,1);

	$tesiscolectivaporcentaje = $tesiscolectiva/$contador2*100;
	$tesiscolectivaporcentaje = number_format($tesiscolectivaporcentaje,1);

	$totalOpciontitulacion=$maestria+$promedio+$institucional+$ceneval+$especialidad+$titulacion+$tesis+$experiencia+$tesisgrado+$estudioposgradodoctorado+$tesiscolectiva;
		
	$hombreporcentaje = $hombre/$totalSexo*100;
	$hombreporcentaje = number_format($hombreporcentaje,1);

	$mujerporcentaje = $mujer/$totalSexo*100;
	$mujerporcentaje = number_format($mujerporcentaje,1);

	$porcentaje = $maestriaporcentaje+$promedioporcentaje+$institucionalporcentaje+$cenevalporcentaje+$especialidadporcentaje+$titulacionporcentaje+$tesisporcentaje+$experienciaporcentaje+$tesisgradoporcentaje+$estudioposgradodoctoradoporcentaje;
	$porcentaje = number_format($porcentaje,1);

	$porcentajesexo = $hombreporcentaje+$mujerporcentaje;
	$porcentajesexo = number_format($porcentajesexo,1);



//si el nivel es doctorado mostras estas opciones de titulacion
if($fk_nivelestudio==4){
$html3 = '

    
<table width="100%" border="0" class="estilo">
<tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td></tr>
	<tr><td>OPCIÓN DE TITULACIÓN</td></tr>
	<tr><td>&nbsp;</td></tr>
<tr class="estilo">
	<td width="390px">TESIS DE GRADO</td>
	<td><strong>'.$tesisgrado.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$tesisgradoporcentaje.'%</td>
	<td width="100px">&nbsp;</td>
	<td>&nbsp;</td>
	<td>TOTAL DE HOMBRES</td>
	<td>&nbsp;</td>
	<td><strong>'.$hombre.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$hombreporcentaje.'%</td>
</tr>
<tr>
	<td>EXAMEN GENERAL DE CONOCIMIENTOS</td>
	<td><strong>'.$institucional.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$institucionalporcentaje.'%</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>TOTAL DE MUJERES</td>
	<td>&nbsp;</td>
	<td><strong>'.$mujer.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$mujerporcentaje.'%</td>
</tr>

<tr>
	<td>PROMEDIO GENERAL DE CALIFICACIONES</td>
	<td><strong>'.$promedio.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$promedioporcentaje.'%</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>

<tr>
	<td><strong>TOTAL DE TITULADOS</strong></td>
	<td><strong>'.$totalOpciontitulacion.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$porcentaje.'%</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td><strong>TOTAL</strong></td>
	<td>&nbsp;</td>
	<td><strong>'.$totalSexo.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$porcentajesexo.'%</td>

	
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
</tr>
<tr>
	<td colspan="11" align="center" style="font-size:16px;"><strong>FUENTE: DEPARTAMENTO DE SEGUIMIENTO DE EGRESADOS<strong/></td>	
</tr>



</table>
</body>


</html>
';
}

//si el nivel es Maestria mostrar estas opciones de titulacion
if($fk_nivelestudio==3){
$html3 = '

    
<table width="100%" border="0" class="estilo">
<tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td></tr>
	<tr><td>OPCIÓN DE TITULACIÓN</td></tr>
	<tr><td>&nbsp;</td></tr>
<tr class="estilo">
	<td width="390px">TESIS DE GRADO</td>
	<td><strong>'.$tesisgrado.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$tesisgradoporcentaje.'%</td>
	<td width="100px">&nbsp;</td>
	<td>&nbsp;</td>
	<td>TOTAL DE HOMBRES</td>
	<td>&nbsp;</td>
	<td><strong>'.$hombre.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$hombreporcentaje.'%</td>
</tr>
<tr>
	<td>EXAMEN GENERAL DE CONOCIMIENTOS</td>
	<td><strong>'.$institucional.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$institucionalporcentaje.'%</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>TOTAL DE MUJERES</td>
	<td>&nbsp;</td>
	<td><strong>'.$mujer.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$mujerporcentaje.'%</td>
</tr>

<tr>
	<td>PROMEDIO GENERAL DE CALIFICACIONES</td>
	<td><strong>'.$promedio.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$promedioporcentaje.'%</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>

<tr>
	<td>ESTUDIOS DE POSGRADO (50% DE DOCTORADO)</td>
	<td><strong>'.$estudioposgradodoctorado.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$estudioposgradodoctoradoporcentaje.'%</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
	<td><strong>TOTAL DE TITULADOS</strong></td>
	<td><strong>'.$totalOpciontitulacion.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$porcentaje.'%</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td><strong>TOTAL</strong></td>
	<td>&nbsp;</td>
	<td><strong>'.$totalSexo.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$porcentajesexo.'%</td>

	
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
</tr>
<tr>
	<td colspan="11" align="center" style="font-size:16px;"><strong>FUENTE: DEPARTAMENTO DE SEGUIMIENTO DE EGRESADOS<strong/></td>	
</tr>



</table>
</body>


</html>
';
}




if($fk_nivelestudio==2){
$html3 = '

    
<table width="100%" border="0" class="estilo">
<tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td></tr>
	<tr><td>OPCIÓN DE TITULACIÓN</td></tr>
	<tr><td>&nbsp;</td></tr>
<tr class="estilo">
	<td width="390px">ESTUDIOS DE POSGRADO (50% DE MAESTRÍA)</td>
	<td><strong>'.$maestria.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$maestriaporcentaje.'%</td>
	<td width="100px">&nbsp;</td>
	<td>&nbsp;</td>
	<td>TOTAL DE HOMBRES</td>
	<td>&nbsp;</td>
	<td><strong>'.$hombre.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$hombreporcentaje.'%</td>
</tr>
<tr>
	<td>SUSTENTACION DE EXAMEN POR AREAS DE CONOCIMIENTO</td>
	<td><strong>'.$institucional.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$institucionalporcentaje.'%</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>TOTAL DE MUJERES</td>
	<td>&nbsp;</td>
	<td><strong>'.$mujer.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$mujerporcentaje.'%</td>
</tr>

<tr>
	<td>PROMEDIO GENERAL DE CALIFICACIONES</td>
	<td><strong>'.$promedio.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$promedioporcentaje.'%</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>

<tr>
	<td>SUSTENTACIÓN DE EXAMEN POR AREAS DE CONOCIMIENTO (CENEVAL)</td>
	<td><strong>'.$ceneval.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$cenevalporcentaje.'%</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
		<td>&nbsp;</td>

</tr>
<tr>
	<td>ESTUDIO DE POSGRADO (ESPECIALIDAD)</td>
	<td><strong>'.$especialidad.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$especialidadporcentaje.'%</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
		<td>&nbsp;</td>

</tr>
<tr>
	<td>CURSO DE TITULACIÓN</td>
	<td><strong>'.$titulacion.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$titulacionporcentaje.'%</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>

</tr>
<tr>
	<td>TESIS PROFESIONAL</td>
	<td><strong>'.$tesis.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$tesisporcentaje.'%</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>

</tr>
<tr>
	<td>EXPERIENCIA PROFESIONAL</td>
	<td><strong>'.$experiencia.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$experienciaporcentaje.'%</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>

</tr>
<tr>
	<td>TESIS COLECTIVA</td>
	<td><strong>'.$tesiscolectiva.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$tesiscolectivaporcentaje.'%</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>

</tr>
<tr>
	<td><strong>TOTAL DE TITULADOS</strong></td>
	<td><strong>'.$totalOpciontitulacion.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$porcentaje.'%</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td><strong>TOTAL</strong></td>
	<td>&nbsp;</td>
	<td><strong>'.$totalSexo.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$porcentajesexo.'%</td>

	
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
</tr>
<tr>
	<td colspan="11" align="center" style="font-size:16px;"><strong>FUENTE: DEPARTAMENTO DE SEGUIMIENTO DE EGRESADOS<strong/></td>	
</tr>



</table>
</body>


</html>
';
}
    $res = $html . $html4 . $html3;

    
} else {
 $fk_nivelestudio = $_GET['fk_nivelestudio'];
    $fk_modalidad = $_GET['fk_modalidad'];
    $fk_carreras = $_GET['fk_carreras'];
    $fk_generacion = $_GET['fk_generacion'];


if($fk_modalidad=="1"){
		$ModalidadReporte="SEMESTRAL";
         }else	if($fk_modalidad=="2"){
		$ModalidadReporte="CUATRIMESTRAL";
         }else if($fk_modalidad=="3"){
		$ModalidadReporte="TRIMESTRAL";
         }else if($fk_modalidad=="4"){
		$ModalidadReporte="PENTAMESTRAL";
         }


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

        $nombreInstitucion =strtoupper( $row333['nombreInstitucion']);
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

	$Result8 = $Obras->PromedioEgresados($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion);
    if ($Result8) {
        $row8 = mysql_fetch_assoc($Result8);
        $Promedio = $row8['Promedio'];
        $Promedio= number_format($Promedio, 1);
        $generacionLista = $row8['DescripcionGeneracion'];

        mysql_free_result($Result8);
    }


   	$especialidad = 0;
        $maestria = 0;
        $ceneval = 0;
        $institucional = 0;
        $promedio = 0;
        $titulacion = 0;
        $tesis = 0;
        $experiencia = 0;
	$tesisgrado = 0;
    	$estudioposgradodoctorado = 0;
    	$tesiscolectiva = 0;
    
    $html = '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo1 {font-size: 10px}
.ESTLOS {
	font-size: 12px;
}
.estilo {
	font-size: 12px;
}
}
.black {
    font-weight: bold;
}
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
    <td colspan="12"><center><div align="center"><strong>GENERACION: '.$generacionLista.'</strong></div>
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

<center><div align="center"><strong>CARRERA:</strong>  '.$carreraReporte.' <strong>MODALIDAD:</strong> <U>'.$ModalidadReporte.'</U> </div></center>
  </br>

  
  ';
    
    
     $mujer =0;
    $hombre=0;
    $totalSexo=0;
//    
//    $result44 = $Obras->ConReporteAlumnosTituloExpedidoSoloTitulados($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fechaInicio, $fechaFin);
//if ($result44) {
//    while ($row44 = mysql_fetch_assoc($result44)) {
//       
//      }
//    }
//      
  

$contador2=0;
    
$result33 = $Obras->ConReporteAlumnosTituloExpedidoSoloTituladosGeneracion($fk_nivelestudio, $fk_modalidad, $fk_carreras,$fk_generacion);
if ($result33) {
    while ($row33 = mysql_fetch_assoc($result33)) {
        
        
    $FechaExpTitulo = $row33['fechaexpediciontitulo'];
    

        if(trim($row33['fk_genero'])=="1"){
            $hombre = $hombre+1;
        }else if(trim($row33['fk_genero'])=="2"){
            $mujer = $mujer+1;
        }
//        
//        echo $row33['pk_titulacion'];
//        
//                if($row33['pk_titulacion']=="1"){
                      $contador2=$contador2+1;
                                       //ESTUDIO DE POSGRADO (ESPECIALIDAD)
                                        if(trim($row33['pk_titulacion'])=="5"){
                                           $especialidad=$especialidad+1;
                                       }
                                       //ESTUDIOS DE POSGRADO (50% DE MAESTRIA)
                                       if(trim($row33['pk_titulacion'])=="1"){
                                           $maestria=$maestria+1;
                                       }
                                       //SUSTENTACION DE EXAMEN POR AREAS DE CONOCIMIENTO (CENEVAL)
                                        if(trim($row33['pk_titulacion'])=="4"){
                                           $ceneval=$ceneval+1;
                                       }
                                       //SUSTENTACION DE EXAMEN POR AREAS DE CONOCIMIENTO
                                       if(trim($row33['pk_titulacion'])=="3"){
                                           $institucional=$institucional+1;
                                         
                                       }
                                       //PROMEDIO GENERAL DE CALIFICACIONES
                                       if(trim($row33['pk_titulacion'])=="2"){
                                           $promedio=$promedio+1;
                                       }
                                       //CURSO DE TITULACION
                                        if(trim($row33['pk_titulacion'])=="6"){
                                           $titulacion=$titulacion+1;
                                       }
                                       //TESIS PROFESIONAL
                                       if(trim($row33['pk_titulacion'])=="7"){
                                           $tesis=$tesis+1;
                                       }
					//EXPERIENCIA PROFESIONAL
                                       if(trim($row33['pk_titulacion'])=="8"){
                                           $experiencia=$experiencia+1;
                                       }
					//TESIS DE GRADO
                                       if(trim($row33['pk_titulacion'])=="10"){
                                           $tesisgrado=$tesisgrado+1;
                                       }
                    		      //Estudios de Posgrado (50% Doctorado)
                                       if(trim($row33['pk_titulacion'])=="11"){
                                           $estudioposgradodoctorado=$estudioposgradodoctorado+1;
                                       }                   
					//TESIS COLECTIVA
                                       if(trim($row33['pk_titulacion'])=="12"){
                                           $tesiscolectiva=$tesiscolectiva+1;
                                       }
//               }
        
//        $html4 = $html4 . $html2;
      
        
          
    }
    mysql_free_result($result33);
}


  
    
     $totalSexo = $mujer + $hombre;

//PORCENTAJES OPCIONES DE TITULACION

	$maestriaporcentaje = $maestria/$contador2*100;
	$maestriaporcentaje = number_format($maestriaporcentaje,1);

	$promedioporcentaje = $promedio/$contador2*100;
	$promedioporcentaje = number_format($promedioporcentaje,1);

	$institucionalporcentaje = $institucional/$contador2*100;
	$institucionalporcentaje = number_format($institucionalporcentaje,1);

	$cenevalporcentaje = $ceneval/$contador2*100;
	$cenevalporcentaje = number_format($cenevalporcentaje,1);

	$especialidadporcentaje = $especialidad/$contador2*100;
	$especialidadporcentaje = number_format($especialidadporcentaje,1);

	$titulacionporcentaje = $titulacion/$contador2*100;
	$titulacionporcentaje = number_format($titulacionporcentaje,1);

	$tesisporcentaje = $tesis/$contador2*100;
	$tesisporcentaje = number_format($tesisporcentaje,1);

	$experienciaporcentaje = $experiencia/$contador2*100;
	$experienciaporcentaje = number_format($experienciaporcentaje,1);

	$tesisgradoporcentaje = $tesisgrado/$contador2*100;
	$tesisgradoporcentaje = number_format($tesisgradoporcentaje,1);
    
        $estudioposgradodoctoradoporcentaje = $estudioposgradodoctorado/$contador2*100;
        $estudioposgradodoctoradoporcentaje = number_format($estudioposgradodoctoradoporcentaje,1);

	$tesiscolectivaporcentaje = $tesiscolectiva/$contador2*100;
	$tesiscolectivaporcentaje = number_format($tesiscolectivaporcentaje,1);

	$totalOpciontitulacion=$maestria+$promedio+$institucional+$ceneval+$especialidad+$titulacion+$tesis+$experiencia+$tesisgrado+$estudioposgradodoctorado+$tesiscolectiva;

	$hombreporcentaje = $hombre/$totalSexo*100;
	$hombreporcentaje = number_format($hombreporcentaje,1);

	$mujerporcentaje = $mujer/$totalSexo*100;
	$mujerporcentaje = number_format($mujerporcentaje,1);

	$porcentaje = $maestriaporcentaje+$promedioporcentaje+$institucionalporcentaje+$cenevalporcentaje+$especialidadporcentaje+$titulacionporcentaje+$tesisporcentaje+$experienciaporcentaje+$tesisgradoporcentaje+$estudioposgradodoctoradoporcentaje;
	$porcentaje = number_format($porcentaje,1);

	$porcentajesexo = $hombreporcentaje+$mujerporcentaje;
	$porcentajesexo = number_format($porcentajesexo,1);



//si el nivel es doctorado mostras estas opciones de titulacion
if($fk_nivelestudio==4){
$html3 = '

    
<table width="100%" border="0" class="estilo">
<tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td></tr>
	<tr><td>OPCIÓN DE TITULACIÓN</td></tr>
	<tr><td>&nbsp;</td></tr>
<tr class="estilo">
	<td width="390px">TESIS DE GRADO</td>
	<td><strong>'.$tesisgrado.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$tesisgradoporcentaje.'%</td>
	<td width="100px">&nbsp;</td>
	<td>&nbsp;</td>
	<td>TOTAL DE HOMBRES</td>
	<td>&nbsp;</td>
	<td><strong>'.$hombre.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$hombreporcentaje.'%</td>
</tr>
<tr>
	<td>EXAMEN GENERAL DE CONOCIMIENTOS</td>
	<td><strong>'.$institucional.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$institucionalporcentaje.'%</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>TOTAL DE MUJERES</td>
	<td>&nbsp;</td>
	<td><strong>'.$mujer.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$mujerporcentaje.'%</td>
</tr>

<tr>
	<td>PROMEDIO GENERAL DE CALIFICACIONES</td>
	<td><strong>'.$promedio.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$promedioporcentaje.'%</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>

<tr>
	<td><strong>TOTAL DE TITULADOS</strong></td>
	<td><strong>'.$totalOpciontitulacion.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$porcentaje.'%</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td><strong>TOTAL</strong></td>
	<td>&nbsp;</td>
	<td><strong>'.$totalSexo.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$porcentajesexo.'%</td>

	
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
</tr>
<tr>
	<td colspan="11" align="center" style="font-size:16px;"><strong>FUENTE: DEPARTAMENTO DE SEGUIMIENTO DE EGRESADOS<strong/></td>	
</tr>



</table>
</body>


</html>
';
}

//si el nivel es Maestria mostrar estas opciones de titulacion
if($fk_nivelestudio==3){
$html3 = '

    
<table width="100%" border="0" class="estilo">
<tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td></tr>
	<tr><td>OPCIÓN DE TITULACIÓN</td></tr>
	<tr><td>&nbsp;</td></tr>
<tr class="estilo">
	<td width="390px">TESIS DE GRADO</td>
	<td><strong>'.$tesisgrado.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$tesisgradoporcentaje.'%</td>
	<td width="100px">&nbsp;</td>
	<td>&nbsp;</td>
	<td>TOTAL DE HOMBRES</td>
	<td>&nbsp;</td>
	<td><strong>'.$hombre.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$hombreporcentaje.'%</td>
</tr>
<tr>
	<td>EXAMEN GENERAL DE CONOCIMIENTOS</td>
	<td><strong>'.$institucional.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$institucionalporcentaje.'%</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>TOTAL DE MUJERES</td>
	<td>&nbsp;</td>
	<td><strong>'.$mujer.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$mujerporcentaje.'%</td>
</tr>

<tr>
	<td>PROMEDIO GENERAL DE CALIFICACIONES</td>
	<td><strong>'.$promedio.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$promedioporcentaje.'%</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>

<tr>
	<td>ESTUDIOS DE POSGRADO (50% DE DOCTORADO)</td>
	<td><strong>'.$estudioposgradodoctorado.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$estudioposgradodoctoradoporcentaje.'%</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
	<td><strong>TOTAL DE TITULADOS</strong></td>
	<td><strong>'.$totalOpciontitulacion.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$porcentaje.'%</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td><strong>TOTAL</strong></td>
	<td>&nbsp;</td>
	<td><strong>'.$totalSexo.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$porcentajesexo.'%</td>

	
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
</tr>
<tr>
	<td colspan="11" align="center" style="font-size:16px;"><strong>FUENTE: DEPARTAMENTO DE SEGUIMIENTO DE EGRESADOS<strong/></td>	
</tr>



</table>
</body>


</html>
';
}




if($fk_nivelestudio==2){
$html3 = '

    
<table width="100%" border="0" class="estilo">
<tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td></tr>
	<tr><td>OPCIÓN DE TITULACIÓN</td></tr>
	<tr><td>&nbsp;</td></tr>
<tr class="estilo">
	<td width="390px">ESTUDIOS DE POSGRADO (50% DE MAESTRÍA)</td>
	<td><strong>'.$maestria.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$maestriaporcentaje.'%</td>
	<td width="100px">&nbsp;</td>
	<td>&nbsp;</td>
	<td>TOTAL DE HOMBRES</td>
	<td>&nbsp;</td>
	<td><strong>'.$hombre.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$hombreporcentaje.'%</td>
</tr>
<tr>
	<td>SUSTENTACION DE EXAMEN POR AREAS DE CONOCIMIENTO</td>
	<td><strong>'.$institucional.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$institucionalporcentaje.'%</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>TOTAL DE MUJERES</td>
	<td>&nbsp;</td>
	<td><strong>'.$mujer.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$mujerporcentaje.'%</td>
</tr>

<tr>
	<td>PROMEDIO GENERAL DE CALIFICACIONES</td>
	<td><strong>'.$promedio.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$promedioporcentaje.'%</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>

<tr>
	<td>SUSTENTACIÓN DE EXAMEN POR AREAS DE CONOCIMIENTO (CENEVAL)</td>
	<td><strong>'.$ceneval.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$cenevalporcentaje.'%</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
		<td>&nbsp;</td>

</tr>
<tr>
	<td>ESTUDIO DE POSGRADO (ESPECIALIDAD)</td>
	<td><strong>'.$especialidad.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$especialidadporcentaje.'%</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
		<td>&nbsp;</td>

</tr>
<tr>
	<td>CURSO DE TITULACIÓN</td>
	<td><strong>'.$titulacion.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$titulacionporcentaje.'%</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>

</tr>
<tr>
	<td>TESIS PROFESIONAL</td>
	<td><strong>'.$tesis.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$tesisporcentaje.'%</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>

</tr>
<tr>
	<td>EXPERIENCIA PROFESIONAL</td>
	<td><strong>'.$experiencia.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$experienciaporcentaje.'%</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>

</tr>
<tr>
	<td>TESIS COLECTIVA</td>
	<td><strong>'.$tesiscolectiva.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$tesiscolectivaporcentaje.'%</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>

</tr>
<tr>
	<td><strong>TOTAL DE TITULADOS</strong></td>
	<td><strong>'.$totalOpciontitulacion.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$porcentaje.'%</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td><strong>TOTAL</strong></td>
	<td>&nbsp;</td>
	<td><strong>'.$totalSexo.'</strong></td>
	<td>&nbsp;</td>
	<td>'.$porcentajesexo.'%</td>

	
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
</tr>
<tr>
	<td colspan="11" align="center" style="font-size:16px;"><strong>FUENTE: DEPARTAMENTO DE SEGUIMIENTO DE EGRESADOS<strong/></td>	
</tr>



</table>
</body>


</html>
';
}
    $res = $html . $html4 . $html3;
  
  }
//echo $res;






$mpdf=new mPDF('','Letter','',''); 
$mpdf->AddPage('L','','','','','','','','','','');
$mpdf->WriteHTML($res);
$mpdf->Output("CantidadDeAlumnosOpcionTituladocion.pdf" ,'I');

?> 

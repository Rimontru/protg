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
	$nombreDirector=  ($row222[nombre]." ".$row222[apaterno]." ".$row222[amaterno]);
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


//
//    $Result = $Obras->ConReporteDocumentacionAlumnos($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fechaInicio, $fechaFin);
//    if ($Result) {
//        while ($row2 = mysql_fetch_assoc($Result)) {
//
//
//        }
//        mysql_free_result($Result);       
//    }
//    
//    
    
    if($row222[fk_genero]== "1") {
     $GeneroReporte=" DIRECTOR ";

}else{
 $GeneroReporte=" DIRECTORA ";

}
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
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
      
      
      //obtnemos la cantidad de areas de formacion
      
      if($areaUno!=""){
          $TotalAreas=$TotalAreas+1;
      }
      
      if($areaDos!=""){
          $TotalAreas=$TotalAreas+1;
      }
      
      
      if($areaTres!=""){
          $TotalAreas=$TotalAreas+1;
      }
      
      if($areaCuatro!=""){
          $TotalAreas=$TotalAreas+1;
      }
      
      
      if($areaCinco!=""){
          $TotalAreas=$TotalAreas+1;
      }
      
      if($area6!=""){
          $TotalAreas=$TotalAreas+1;
      }
      
      
      if($area7!=""){
          $TotalAreas=$TotalAreas+1;
      }
      
      if($area8!=""){
          $TotalAreas=$TotalAreas+1;
      }
      
      
      if($area9!=""){
          $TotalAreas=$TotalAreas+1;
      }
      
      
      if($area10!=""){
          $TotalAreas=$TotalAreas+1;
      }
      
      if($area11!=""){
          $TotalAreas=$TotalAreas+1;
      }
      
      
      
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
  
  

//$fechaActual=strftime( "%Y-%m-%d", time() );
//
//$fechaActualModificar = explode("-",$fechaActual);
//$fechaActualLista=$fechaActualModificar[0]."-".$fechaActualModificar[1]."-".$fechaActualModificar[2];

//$fechaLetras = fechaATexto($fechaActualLista, 'u'); // Devuelve '10 DE AGOSTO DE 1981'
//
//
//realizamos la consulta
//$result = $consulta->selectbd("select * from tramites where fechaAplicacionInstitucional BETWEEN '" . $fechaLista . "' and '" . $fechaListaDos . "' and carrera='" . $carreraCaptura . "' and modalidad='" . $modalidadCaptura . "' and institucionalStatus='1' order by apaterno");
      
$result = $Obras->ConReporteDocumentacionAlumnos($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fechaInicio, $fechaFin);

//$result = $Obras->ConReporteDocumentacionAlumnosPorLlavePrimaria($pk_alumno);

// esto, si kiesieras poner el 10 , seria $fecha[0] = 10, $fecha[1] = agosto, $fecha[2] = 1984
// 2012 - 07 - 03
//


 while ($row = mysql_fetch_assoc($result)) {
      
$nombre=strtoupper($row[NombreCompleto]);

//fecha de aplicacion examen    
//$fechaSQL = explode("/",$fechaaplicacion);
//$fechaAplicacionLista=$fechaSQL[0]."-".$fechaSQL[2]."-".$fechaSQL[1];
$fechaAplicacionLista=$row[fechaaplicacion];

//carreras y directores
//$fk_carreras=$row[fk_carreras];
//$Result22=$Obras->verTrabajadoresDirectoresReportes(fk_carreras);
//if($Result22){
//$row222=mysql_fetch_assoc($Result22);
//$nombreDirector=($row222[nombre]." ".$row222[apaterno]." ".$row222[amaterno]);
//$carreraReporte=($row222[nombreCarrera]);
//}





      
//        $fechaActualModificar = explode("-",$value->fechaaplicacion);
//$fechaActualLista=$fechaActualModificar[0]."-".$fechaActualModificar[1]."-".$fechaActualModificar[2];

//$fechaAplicacionLista = fechaATexto($row['fechaaplicacionReporte'], 'u'); // Devuelve '10 DE AGOSTO DE 1981'


//   $fechaSQL = explode("-",$value->fecha);
//   
//        $fechaLista=$fechaSQL[2]."/".$fechaSQL[1]."/".$fechaSQL[0];

//           $fechaTitulo = explode("-",$value->fechaexpediciontitulo);
//        $fechaListaTitulo=$fechaTitulo[2]."/".$fechaTitulo[1]."/".$fechaTitulo[0];
//      
  if ($row['nombreCarrera']=="LICENCIATURA EN ENSEÑANZA DEL INGLES"){
     
    $puntosTotales=$row['a1']+$row['a2']+$row['a3']+$row['a4']+$row['a5']+$row['a6']+$row['a7']+$row['a8']+$row['a9']+$row['a10']+$row['a11'];
    //$puntosTotales=($puntosTotales*.70)+30;
     $puntosTotales = explode(".",$puntosTotales);
      $puntosTotales = $puntosTotales[0];
     
 }else{     
         
       $puntosTotales=$row['a1']+$row['a2']+$row['a3']+$row['a4']+$row['a5']+$row['a6']+$row['a7']+$row['a8']+$row['a9']+$row['a10']+$row['a11'];
            if($puntosTotales==0){
                $puntosTotales = "NP";
            }else{
                $puntosTotales = explode(".",$puntosTotales);
                $puntosTotales = $puntosTotales[0];
            }
    }//fin condicion   
  
  
  //$puntosTotales=$value->a1+$value->a2+$value->a3+$value->a4+$value->a5+$value->a6+$value->a7+$value->a8+$value->a9+$value->a10+$value->a11;
        
        $html2=" 
        
   <tr>
    <td height='36'  align='center' style='border-width: 1px;border: solid;'><div align='center'><span class='Estilo7'>$row[folioInstitucional]</span></div></td>
    <td  align='center' style='border-width: 1px;border: solid;'><span class='Estilo7'>$nombre</span></td>
    <td  align='center' style='border-width: 1px;border: solid;'><span class='Estilo7'>$row[a1]</span></td>
    <td  align='center' style='border-width: 1px;border: solid;'><span class='Estilo7'>$row[a2]</span></td>
    <td  align='center' style='border-width: 1px;border: solid;'><span class='Estilo7'>$row[a3]</span></td>
                
                
      ";
  
        
  if($areaCuatro!=""){
     $html2.="<td  align='center' style='border-width: 1px;border: solid;'><span class='Estilo7'>$row[a4]</span></td>";
    
   }

   if($areaCinco!=""){
       $html2.="<td  align='center' style='border-width: 1px;border: solid;' ><span class='Estilo7'>$row[a5]</span></td>";
    
   }

     if($area6!=""){
       $html2.="<td  align='center' style='border-width: 1px;border: solid;'><span class='Estilo7'>$row[a6]</span></td>";
   }
   
     if($area7!=""){
       $html2.="<td  align='center' style='border-width: 1px;border: solid;'><span class='Estilo7'>$row[a7]</span></td>";
   }
   
     if($area8!=""){
      $html2.="<td  align='center' style='border-width: 1px;border: solid;'><span class='Estilo7'>$row[a8]</span></td>";
   }
   
        if($area9!=""){
       $html2.="<td  align='center' style='border-width: 1px;border: solid;'><span class='Estilo7'>$row[a9]</span></td>";
   }
   
     if($area10!=""){
       $html2.="<td  align='center' style='border-width: 1px;border: solid;' ><span class='Estilo7'>$row[a10]</span></td>";
   }
   
     if($area11!=""){
       $html2.="<td  align='center' style='border-width: 1px;border: solid;' ><span class='Estilo7'>$row[a11]</span></td>";
   }
   
   
   
      $html2.="     
   
               
    <td  align='center' style='border-width: 1px;border: solid;'><span class='Estilo7'>$puntosTotales</span></td>
  </tr>

                
                ";

 $html4=$html4.$html2;
        }

$html3='
</table>
<BR>
<center>
 <table width="1138" height="77" border="0">
  <tr>
      <td  align="center">Vo.Bo.</td>
    </tr> 
    <tr>
      <td   style="background: #FFF url(../images/Untitled-4_clip_image002.png) no-repeat center bottom"></td>
    </tr>
    <tr>
      <td align="center"><div align="center"><strong>'.$nombreDirector.'</strong></div></td>
    </tr>
    <tr>
      <td align="center"><div align="center"><strong>'.$GeneroReporte.' DE '.$carreraReporte.'</strong></div></td>
    </tr>
  </table>
</center>


</body>
</html>

';


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
<table width="1038" height="92" border="0"  style="border-collapse: collapse;">
  <tr>
    <td width="146" rowspan="2"  align="center" style="border-width: 1px;border: solid;"><div align="center"><span class="Estilo5">No. FOLIO</span></div></td>
    <td width="323" rowspan="2"  align="center" style="border-width: 1px;border: solid;"><div align="center"><span class="Estilo5">NOMBRE DEL ALUMNO</span></div></td>
    <td height="26" colspan="'.$TotalAreas.'"  align="center" style="border-width: 1px;border: solid;"><div align="center"><span class="Estilo5">AREAS DE FORMACION</span></div></td>
    <td width="88" rowspan="2"  align="center" style="border-width: 1px;border: solid;"><span class="Estilo5">PUNTOS</span></td>
  </tr>
  <tr>
    <td width="82" height="22" align="center" style="border-width: 1px;border: solid;"><span class="Estilo5">'.$areaUno.'</span></td>
    <td width="82" align="center" style="border-width: 1px;border: solid;"><span class="Estilo5">'.$areaDos.'</span></td>
    <td width="86" align="center" style="border-width: 1px;border: solid;"><span class="Estilo5">'.$areaTres.'</span></td>
        
';
    
    
     
      if($areaCuatro!=""){
     $html.=' <td width="101" align="center" style="border-width: 1px;border: solid;"><span class="Estilo5">'.$areaCuatro.'</span></td>';
    
   }
   
   
    
      if($areaCinco!=""){
     $html.=' <td width="96" align="center" style="border-width: 1px;border: solid;"><span class="Estilo5">'.$areaCinco.'</span></td>';
    
   }
   
   
    if($area6!=""){
     $html.=' <td width="106" height="48"  align="center"  style="border-width: 1px;border: solid;"><div align="center" class="Estilo5">'.$area6.'</div></td>';
    
   }
   
   
     if($area7!=""){
     $html.=' <td width="97"  align="center"  style="border-width: 1px;border: solid;"><div align="center" class="Estilo5">'.$area7.'</div></td>';
    
   }
   
       if($area8!=""){
     $html.=' <td width="109"  align="center"  style="border-width: 1px;border: solid;"><div align="center" class="Estilo5">'.$area8.'</div></td>';
    
   }
   
   
    if($area9!=""){
     $html.='    <td width="103"  align="center"  style="border-width: 1px;border: solid;"><div align="center" class="Estilo5">'.$area9.'</div></td>';
    
   }
   
   
     if($area10!=""){
     $html.='    <td width="87"  align="center"  style="border-width: 1px;border: solid;" ><div align="center" class="Estilo5">'.$area10.'</div></td>';
    
   }
   
   
        if($area11!=""){
     $html.='  <td width="87"  align="center"  style="border-width: 1px;border: solid;"><div align="center" class="Estilo5">'.$area11.'</div></td>';
    
   }
   
 
    $html.=' 
</tr>
  ';


$res=$html.$html4.$html3;

    
    
    
    
    
    
    
    
    
    
    
    
} else {
    $html = "Lo Sentimos No Se Pudo Realizar la Consulta";
}



$timeo_start = microtime(true);
ini_set("memory_limit","300824M");
ini_set('max_execution_time', 400);

//echo $res;
ob_start();
$mpdf = new mPDF();
//$mpdf->AddPage('L', '', '', '', '', '', '', '', '', '', '');
$mpdf->WriteHTML($res);
$mpdf->Output("Reporte_ResultadosExamen". $today.".pdf", 'I');
?> 

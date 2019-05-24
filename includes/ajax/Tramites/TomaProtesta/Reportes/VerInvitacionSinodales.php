<?php

require_once("../../../../../includes/Config.class.php");  # Cargar datos conexion y otras variables.
require_once('../../../../../includes/DB.class.php');
require_once('../../../../../includes/ConsultaDB.class.php');
require_once('../../../../../includes/MisFunciones.class.php');
require_once('../../../../../mpdf/mpdf.php');


$Obras = new ConsultaDB;
$Funciones = new MisFunciones;
$today = date("d-m-Y");

if (isset($_GET['pk_alumno'])) {


    $pk_alumno = $_GET['pk_alumno'];

    //DATOS DEL DIRECTOR
//    $Result22 = $Obras->verTrabajadoresDirectoresReportes($fk_carreras);
//    if ($Result22) {
//        $row222 = mysql_fetch_assoc($Result22);
//        $nombreDirector = ($row222[NombreCompletoDirector]);
//        $carreraReporte = ($row222[nombreCarrera]);
//        mysql_free_result($Result22);
//    }
    
    //DATOS DEL DIRECTOR
    $Result22 = $Obras->DirectoresCarreras($fk_carreras);
    if ($Result22) {
        $row222 = mysql_fetch_assoc($Result22);
        $nombreDirector = $row222[nombre];
        $carreraReporte = ($row222[nombreCarrera]);
        mysql_free_result($Result22);
    }

    //DATOS DE LA ESCUELA
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
        $lemaescuela = strtoupper($row333['lemaEscuela']);
    }





//
//    $Result = $Obras->ConReporteDocumentacionAlumnos($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fechaInicio, $fechaFin);
//    if ($Result) {
//        while ($row2 = mysql_fetch_assoc($Result)) {
//            $html.="<tr>
//                        <td height='28'>&nbsp;</td>
//                                <td  style='border-width: 1px;border: solid;'><span class='Estilo1'>$row2[ObservacionesDoc]</span></td>
//                      </tr>";
//        } //fin del while                  
//        mysql_free_result($Result);
//    }


$todayfechaLetrasModificar = explode("-", $today);
$FechaLista = $todayfechaLetrasModificar[2] . "-" . $todayfechaLetrasModificar[1] . "-" . $todayfechaLetrasModificar[0];
         $today = $Funciones->Fecha2($FechaLista );
   








    $result = $Obras->ConReporteDocumentacionAlumnosPorLlavePrimaria($pk_alumno);
    while ($row = mysql_fetch_assoc($result)) {
        
     

     $fk_carreras=$row[fk_carreras];
      $Result22 = $Obras->verTrabajadoresDirectoresReportes($fk_carreras);
    if ($Result22) {
        $row222 = mysql_fetch_assoc($Result22);
        $nombreDirector=  ($row222[nombre]." ".$row222[apaterno]." ".$row222[amaterno]);
        $carreraReporte=  ($row222[nombreCarrera]);
        $genero = $row222[fk_genero];
        mysql_free_result($Result22);
    }





        // esto, si kiesieras poner el 10 , seria $fecha[0] = 10, $fecha[1] = agosto, $fecha[2] = 1984
// 2012 - 07 - 03
//$carreraDirector=$value->carrera;
//        
//$consultaDirector=new Conexion();
//$resultDirector=$consultaDirector->selectbd("select * from directoresareas where carrera='".$carreraDirector."' and modalidad='" . $value->modalidad . "'");
//
//foreach ($resultDirector as $key => $valueDirector) {
//    $nombreDirectorListo=$valueDirector->nombre;
//}
//
//$fechaSQL = explode("-",$value->fecha);
//$fechaLista=$fechaSQL[2]."/".$fechaSQL[1]."/".$fechaSQL[0];

//
//        $tomaprotestaLetras = fechaATexto($value->fecha, 'u');
        $tomaprotestaLetras = $Funciones->Fecha2Mayusculas($row[FechaTomaProtesta]);
$fechaLista = ($row[FechaTomaProtestaReporte]);


        $html = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Documento sin t&iacute;tulo</title>
<style type='text/css'>
<!--
.Estilo1 {
	font-size: 12px;
	font-weight: bold;
}
.Estilo2 {
	font-size: 14px;
	font-weight: bold;
}
.Estilo3 {font-size: 14px}
.Estilo4 {font-size: 10px}
-->
</style>
</head>

<body>
<table width='785' border='0' >
<tr>
    <td colspan='2' rowspan='6'><div align='center'><img src='../../../../../assets/img/IESCH.png' width='117' height='121' /></div></td>
    <td colspan='8'><center><div align='center'><strong>$nombreInstitucion</strong></div></center></td>
    <td colspan='2' rowspan='6'><div align='center'><img src='../../../../../assets/img/fimpes.png' width='107' height='109' /></div></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong> </strong></div></center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>INCORPORADO A LA  SECRETARIA DE EDUCACION</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>OFICIO No. $numerooficio DE FECHA $fechaIncorporacionsecretaria</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>REGIMEN: $regimen    CLAVE: </strong><strong>$clave</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>EXCELENCIA ACADEMICA: $registro </strong></div>
    </center></td>
  </tr>
  <tr>
    <td width='105'>&nbsp;</td>
    <td width='39'>&nbsp;</td>
    <td width='73'>&nbsp;</td>
    <td width='44'>&nbsp;</td>
    <td width='47'>&nbsp;</td>
    <td width='68'>&nbsp;</td>
    <td width='33'>&nbsp;</td>
    <td width='103'>&nbsp;</td>
    <td width='36'>&nbsp;</td>
    <td width='55'>&nbsp;</td>
    <td width='53'>&nbsp;</td>
    <td width='79'>&nbsp;</td>
  </tr>
</table>
  
<table  width='785' border='0' style='border-collapse: collapse;'>

  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan='6' align='right' ><div align='right' class='Estilo2'>ASUNTO: SOLICITAMOS SU ASISTENCIA</div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align='right'><span class='Estilo3'></span></div></td>
    <td colspan='4' align='right'><div align='right' class='Estilo3'><strong>PARA LA TOMA DE PROTESTA</strong></div></td>
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
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan='8' align='right' ><div align='right' class='Estilo2'>$ciudad, $estado; " . $today . "</div></td>
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
  </tr>
  <tr>
    <td colspan='8'><div align='left' class='Estilo2'>" . $row[NombreAlumno]." ". $row[ApaternoAlumno]." ". $row[AmaternoAlumno]. "</div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='4'><div align='left' class='Estilo2'>SUSTENTANTE</div></td>
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
    <td colspan='4'><div align='left'><span class='Estilo3'><strong>PRESENTE</strong></span></div></td>
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
  </tr>
  <tr>
    <td height='105' colspan='12' align='justify'><span class='Estilo3'>POR ESTE CONDUCTO SE LE INFORMA A USTED, QUE SU EXAMEN PROFESIONAL Y/O TOMA DE PROTESTA ESTA PROGRAMADO PARA EL DIA <strong>$tomaprotestaLetras </strong>  ,A LAS <strong>" . $row[hora] . "</strong>, EN EL SALON <strong>" . $row[salon] . "</strong> DEL $nombreInstitucion, DEBIENDOSE PRESENTAR BIEN VESTIDO(A) (TRAJE REGLAMENTARIO) PARA ESA FECHA Y 15 MINUTOS ANTES DE LA HORA INDICADA. ASI MISMO SE LE COMUNICA QUE SUS SINODALES SON LOS QUE A CONTINUACION SE MENCIONAN.</span></td>
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
  </tr>
  <tr>
    <td><span class='Estilo3'>PRESIDENTE</span></td>
    <td colspan='11' class='Estilo3'><strong>$row[NombrePresidente]</strong></td>
  </tr>
  <tr>
    <td><span class='Estilo3'>SECRETARIO</span></td>
    <td colspan='11' class='Estilo3'><strong>$row[NombreSecretario]</strong></td>
  </tr>
  <tr>
    <td>VOCAL</td>
    <td colspan='11' class='Estilo3'><strong>$row[NombreVocal]</strong></td>
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
  </tr>
   <tr>
    <td colspan='12' class='Estilo3'>SIN MAS POR EL MOMENTO, QUEDO DE USTED.</td>
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
  </tr>
  <tr>
    <td colspan='12'><center><div align='center' class='Estilo2'>ATENTAMENTE</div></center></td>
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
  </tr>
  <tr>
    <td colspan='12'><center><div align='center' class='Estilo2'>$lemaescuela</div></center></td>
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
  </tr>
  <tr>
    <td colspan='12'><center><div align='center' class='Estilo3'><strong>$nombreDirector</strong></div></center></td>
  </tr>
  <tr>
    <td colspan='12'><center><div align='center' class='Estilo2'>DIRECTOR</div></center></td>
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
  </tr>
  <tr>
    <td height='32' colspan='3'><span class='Estilo4'>C.C.P AL ARCHIVO</span></td>
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
    <td colspan='12'><div align='center' class='Estilo1'>
      <p>$direccion. TELS. $telefono $ciudad, $estado</p>
      <p>$paginainternet</p>
    </div></td>
  </tr>
</table>
</body>
</html>";



        //FORMATO DE SINODALES PRESIDENTE

        $htmlPresidente = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Documento sin t&iacute;tulo</title>
<style type='text/css'>
<!--
.Estilo1 {
	font-size: 12px;
	font-weight: bold;
}
.Estilo2 {
	font-size: 14px;
	font-weight: bold;
}
.Estilo3 {font-size: 14px}
.Estilo4 {font-size: 10px}
-->
</style>
</head>

<body>
<table width='785' border='0' >
<tr>
    <td colspan='2' rowspan='6'><div align='center'><img src='../../../../../assets/img/IESCH.png' width='117' height='121' /></div></td>
    <td colspan='8'><center><div align='center'><strong>$nombreInstitucion</strong></div></center></td>
    <td colspan='2' rowspan='6'><div align='center'><img src='../../../../../assets/img/fimpes.png' width='107' height='109' /></div></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong> </strong></div></center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>INCORPORADO A LA  SECRETARIA DE EDUCACION</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>OFICIO No. $numerooficio DE FECHA $fechaIncorporacionsecretaria</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>REGIMEN: $regimen    CLAVE: </strong><strong>$clave</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>EXCELENCIA ACADEMICA: $registro </strong></div>
    </center></td>
  </tr>
  <tr>
    <td width='105'>&nbsp;</td>
    <td width='39'>&nbsp;</td>
    <td width='73'>&nbsp;</td>
    <td width='44'>&nbsp;</td>
    <td width='47'>&nbsp;</td>
    <td width='68'>&nbsp;</td>
    <td width='33'>&nbsp;</td>
    <td width='103'>&nbsp;</td>
    <td width='36'>&nbsp;</td>
    <td width='55'>&nbsp;</td>
    <td width='53'>&nbsp;</td>
    <td width='79'>&nbsp;</td>
  </tr>
</table>
  
  
<table  width='785' border='0' style='border-collapse: collapse;'>
  <tr>
    <td width='105'>&nbsp;</td>
    <td width='39'>&nbsp;</td>
    <td width='73'>&nbsp;</td>
    <td width='44'>&nbsp;</td>
    <td width='47'>&nbsp;</td>
    <td width='68'>&nbsp;</td>
    <td width='33'>&nbsp;</td>
    <td width='103'>&nbsp;</td>
    <td width='36'>&nbsp;</td>
    <td width='55'>&nbsp;</td>
    <td width='53'>&nbsp;</td>
    <td width='79'>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan='6' align='right' ><div align='right' class='Estilo2'>ASUNTO: SOLICITAMOS SU ASISTENCIA</div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align='right'><span class='Estilo3'></span></div></td>
    <td colspan='4' align='right'><div align='right' class='Estilo3'><strong>PARA LA TOMA DE PROTESTA</strong></div></td>
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
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan='8' align='right'><div align='right' class='Estilo2'>$ciudad, $estado; " . $today . "</div></td>
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
  </tr>
  <tr>
    <td colspan='8'><div align='left' class='Estilo2'>" . $row[NombrePresidente] . "</div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='4'><div align='left' class='Estilo2'>PRESENTE.</div></td>
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
  </tr>
  <tr>
    <td height='54' colspan='12'><span class='Estilo3'>POR ESTE CONDUCTO SOLICITO A USTED, SU PRESENCIA CON VESTIMENTA REGLAMENTARIA EN LA APLICACION DEL EXAMEN PROFESIONAL QUE SE LLEVARA ACABO EN LAS INSTALACIONES DE ESTE INSTITUTO.</span></td>
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
  </tr>
  <tr>
    <td><div align='center' class='Estilo3'><strong>HORA</strong></div></td>
    <td colspan='2'><div align='center' class='Estilo3'><strong>FECHA</strong></div></td>
    <td colspan='5'><div align='center' class='Estilo3'><strong>SUSTENTANTE</strong></div></td>
    <td colspan='2'><div align='center' class='Estilo3'><strong>LUGAR</strong></div></td>
    <td colspan='2'><div align='center' class='Estilo3'><strong>CARGO</strong></div></td>
  </tr>
  <tr>
    <td colspan='12'><div align='center'></div></td>
  </tr>
  <tr>
    <td><div align='center' class='Estilo3'>" . $row[hora] . "</div></td>
    <td colspan='2'><div align='center'><span class='Estilo3'>" . $fechaLista . "</span></div></td>
    <td colspan='5'><div align='center'><span class='Estilo3'>" . $row[ApaternoAlumno] . " " . $row[AmaternoAlumno] . " " . $row[NombreAlumno] . "</span></div></td>
    <td colspan='2'><div align='center'><span class='Estilo3'>" . $row[salon] . "</span></div></td>
    <td colspan='2'><div align='center'><span class='Estilo3'>PRESIDENTE</span></div></td>
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
  </tr>
  <tr>
    <td colspan='12'><span class='Estilo3'>EN ESPERA DE SU PUNTUAL ASISTENCIA, LE ANTICIPO LAS GRACIAS.</span></td>
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
  </tr>
  <tr>
    <td colspan='12'><center><div align='center' class='Estilo2'>ATENTAMENTE</div></center></td>
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
  </tr>
  <tr>
    <td colspan='12'><center><div align='center' class='Estilo2'>$lemaescuela</div></center></td>
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
  </tr>
  <tr>
    <td colspan='12'><center><div align='center' class='Estilo3'><strong>$nombreDirector</strong></div></center></td>
  </tr>
  <tr>
    <td colspan='12'><center><div align='center' class='Estilo2'>DIRECTOR</div></center></td>
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
  </tr>
<tr>
    <td colspan='3'><span class='Estilo4'>C.C.P AL ARCHIVO</span></td>
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
    <td colspan='12'><div align='center' class='Estilo1'>
      <p>$direccion. TELS. $telefono $ciudad, $estado</p>
      <p>$paginainternet</p>
    </div></td>
  </tr>
</table>
</body>
</html>";











        //FORMATO DE SINODALES PRESIDENTE

        $htmlSecretario = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Documento sin t&iacute;tulo</title>
<style type='text/css'>
<!--
.Estilo1 {
	font-size: 12px;
	font-weight: bold;
}
.Estilo2 {
	font-size: 14px;
	font-weight: bold;
}
.Estilo3 {font-size: 14px}
.Estilo4 {font-size: 10px}
-->
</style>
</head>

<body>
<table width='785' border='0' >
<tr>
    <td colspan='2' rowspan='6'><div align='center'><img src='../../../../../assets/img/IESCH.png' width='117' height='121' /></div></td>
    <td colspan='8'><center><div align='center'><strong>$nombreInstitucion</strong></div></center></td>
    <td colspan='2' rowspan='6'><div align='center'><img src='../../../../../assets/img/fimpes.png' width='107' height='109' /></div></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong> </strong></div></center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>INCORPORADO A LA  SECRETARIA DE EDUCACION</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>OFICIO No. $numerooficio DE FECHA $fechaIncorporacionsecretaria</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>REGIMEN: $regimen    CLAVE: </strong><strong>$clave</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>EXCELENCIA ACADEMICA: $registro </strong></div>
    </center></td>
  </tr>
  <tr>
    <td width='105'>&nbsp;</td>
    <td width='39'>&nbsp;</td>
    <td width='73'>&nbsp;</td>
    <td width='44'>&nbsp;</td>
    <td width='47'>&nbsp;</td>
    <td width='68'>&nbsp;</td>
    <td width='33'>&nbsp;</td>
    <td width='103'>&nbsp;</td>
    <td width='36'>&nbsp;</td>
    <td width='55'>&nbsp;</td>
    <td width='53'>&nbsp;</td>
    <td width='79'>&nbsp;</td>
  </tr>
</table>
  
  
<table  width='785' border='0' style='border-collapse: collapse;'>
  <tr>
    <td width='105'>&nbsp;</td>
    <td width='39'>&nbsp;</td>
    <td width='73'>&nbsp;</td>
    <td width='44'>&nbsp;</td>
    <td width='47'>&nbsp;</td>
    <td width='68'>&nbsp;</td>
    <td width='33'>&nbsp;</td>
    <td width='103'>&nbsp;</td>
    <td width='36'>&nbsp;</td>
    <td width='55'>&nbsp;</td>
    <td width='53'>&nbsp;</td>
    <td width='79'>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan='6' align='right' ><div align='right' class='Estilo2'>ASUNTO: SOLICITAMOS SU ASISTENCIA</div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align='right'><span class='Estilo3'></span></div></td>
    <td colspan='4' align='right'><div align='right' class='Estilo3'><strong>PARA LA TOMA DE PROTESTA</strong></div></td>
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
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan='8' align='right'><div align='right' class='Estilo2'>$ciudad, $estado; " . $today . "</div></td>
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
  </tr>
  <tr>
    <td colspan='8'><div align='left' class='Estilo2'>" . $row[NombreSecretario] . "</div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='4'><div align='left' class='Estilo2'>PRESENTE.</div></td>
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
  </tr>
  <tr>
    <td height='54' colspan='12'><span class='Estilo3'>POR ESTE CONDUCTO SOLICITO A USTED, SU PRESENCIA EN LA APLICACION DEL EXAMEN PROFESIONAL QUE SE LLEVARA ACABO EN LAS INSTALACIONES DE ESTE INSTITUTO.</span></td>
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
  </tr>
  <tr>
    <td><div align='center' class='Estilo3'><strong>HORA</strong></div></td>
    <td colspan='2'><div align='center' class='Estilo3'><strong>FECHA</strong></div></td>
    <td colspan='5'><div align='center' class='Estilo3'><strong>SUSTENTANTE</strong></div></td>
    <td colspan='2'><div align='center' class='Estilo3'><strong>LUGAR</strong></div></td>
    <td colspan='2'><div align='center' class='Estilo3'><strong>CARGO</strong></div></td>
  </tr>
  <tr>
    <td colspan='12'><div align='center'></div></td>
  </tr>
  <tr>
    <td><div align='center' class='Estilo3'>" . $row[hora] . "</div></td>
    <td colspan='2'><div align='center'><span class='Estilo3'>" . $fechaLista . "</span></div></td>
    <td colspan='5'><div align='center'><span class='Estilo3'>" . $row[ApaternoAlumno] . " " . $row[AmaternoAlumno] . " " . $row[NombreAlumno] . "</span></div></td>    <td colspan='2'><div align='center'><span class='Estilo3'>" . $row[salon] . "</span></div></td>
    <td colspan='2'><div align='center'><span class='Estilo3'>SECRETARIO</span></div></td>
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
  </tr>
  <tr>
    <td colspan='12'><span class='Estilo3'>EN ESPERA DE SU PUNTUAL ASISTENCIA, LE ANTICIPO LAS GRACIAS.</span></td>
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
  </tr>
  <tr>
    <td colspan='12'><center><div align='center' class='Estilo2'>ATENTAMENTE</div></center></td>
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
  </tr>
  <tr>
    <td colspan='12'><center><div align='center' class='Estilo2'>$lemaescuela</div></center></td>
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
  </tr>
  <tr>
    <td colspan='12'><center><div align='center' class='Estilo3'><strong>$nombreDirector</strong></div></center></td>
  </tr>
  <tr>
    <td colspan='12'><center><div align='center' class='Estilo2'>DIRECTOR</div></center></td>
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
  </tr>
<tr>
    <td colspan='3'><span class='Estilo4'>C.C.P AL ARCHIVO</span></td>
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
    <td colspan='12'><div align='center' class='Estilo1'>
      <p>$direccion. TELS. $telefono $ciudad, $estado</p>
      <p>$paginainternet</p>
    </div></td>
  </tr>
</table>
</body>
</html>";





        //FORMATO DE SINODALES PRESIDENTE

        $htmlVocal = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Documento sin t&iacute;tulo</title>
<style type='text/css'>
<!--
.Estilo1 {
	font-size: 12px;
	font-weight: bold;
}
.Estilo2 {
	font-size: 14px;
	font-weight: bold;
}
.Estilo3 {font-size: 14px}
.Estilo4 {font-size: 10px}
-->
</style>
</head>

<body>
<table width='785' border='0' >
<tr>
    <td colspan='2' rowspan='6'><div align='center'><img src='../../../../../assets/img/IESCH.png' width='117' height='121' /></div></td>
    <td colspan='8'><center><div align='center'><strong>$nombreInstitucion</strong></div></center></td>
    <td colspan='2' rowspan='6'><div align='center'><img src='../../../../../assets/img/fimpes.png' width='107' height='109' /></div></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong> </strong></div></center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>INCORPORADO A LA  SECRETARIA DE EDUCACION</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>OFICIO No. $numerooficio DE FECHA $fechaIncorporacionsecretaria</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>REGIMEN: $regimen    CLAVE: </strong><strong>$clave</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>EXCELENCIA ACADEMICA: $registro </strong></div>
    </center></td>
  </tr>
  <tr>
    <td width='105'>&nbsp;</td>
    <td width='39'>&nbsp;</td>
    <td width='73'>&nbsp;</td>
    <td width='44'>&nbsp;</td>
    <td width='47'>&nbsp;</td>
    <td width='68'>&nbsp;</td>
    <td width='33'>&nbsp;</td>
    <td width='103'>&nbsp;</td>
    <td width='36'>&nbsp;</td>
    <td width='55'>&nbsp;</td>
    <td width='53'>&nbsp;</td>
    <td width='79'>&nbsp;</td>
  </tr>
</table>
  
  
<table  width='785' border='0' style='border-collapse: collapse;'>
  <tr>
    <td width='105'>&nbsp;</td>
    <td width='39'>&nbsp;</td>
    <td width='73'>&nbsp;</td>
    <td width='44'>&nbsp;</td>
    <td width='47'>&nbsp;</td>
    <td width='68'>&nbsp;</td>
    <td width='33'>&nbsp;</td>
    <td width='103'>&nbsp;</td>
    <td width='36'>&nbsp;</td>
    <td width='55'>&nbsp;</td>
    <td width='53'>&nbsp;</td>
    <td width='79'>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan='6' align='right' ><div align='right' class='Estilo2'>ASUNTO: SOLICITAMOS SU ASISTENCIA</div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align='right'><span class='Estilo3'></span></div></td>
    <td colspan='4' align='right'><div align='right' class='Estilo3'><strong>PARA LA TOMA DE PROTESTA</strong></div></td>
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
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan='8' align='right'><div align='right' class='Estilo2'>$ciudad, $estado; " . $today . "</div></td>
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
  </tr>
  <tr>
    <td colspan='8'><div align='left' class='Estilo2'>" . $row[NombreVocal] . "</div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='4'><div align='left' class='Estilo2'>PRESENTE.</div></td>
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
  </tr>
  <tr>
    <td height='54' colspan='12'><span class='Estilo3'>POR ESTE CONDUCTO SOLICITO A USTED, SU PRESENCIA EN LA APLICACION DEL EXAMEN PROFESIONAL QUE SE LLEVARA ACABO EN LAS INSTALACIONES DE ESTE INSTITUTO.</span></td>
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
  </tr>
  <tr>
    <td><div align='center' class='Estilo3'><strong>HORA</strong></div></td>
    <td colspan='2'><div align='center' class='Estilo3'><strong>FECHA</strong></div></td>
    <td colspan='5'><div align='center' class='Estilo3'><strong>SUSTENTANTE</strong></div></td>
    <td colspan='2'><div align='center' class='Estilo3'><strong>LUGAR</strong></div></td>
    <td colspan='2'><div align='center' class='Estilo3'><strong>CARGO</strong></div></td>
  </tr>
  <tr>
    <td colspan='12'><div align='center'></div></td>
  </tr>
  <tr>
    <td><div align='center' class='Estilo3'>" . $row[hora] . "</div></td>
    <td colspan='2'><div align='center'><span class='Estilo3'>" . $fechaLista . "</span></div></td>
    <td colspan='5'><div align='center'><span class='Estilo3'>" . $row[ApaternoAlumno] . " " . $row[AmaternoAlumno] . " " . $row[NombreAlumno] . "</span></div></td>    <td colspan='2'><div align='center'><span class='Estilo3'>" . $row[salon] . "</span></div></td>
    <td colspan='2'><div align='center'><span class='Estilo3'>VOCAL</span></div></td>
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
  </tr>
  <tr>
    <td colspan='12'><span class='Estilo3'>EN ESPERA DE SU PUNTUAL ASISTENCIA, LE ANTICIPO LAS GRACIAS.</span></td>
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
  </tr>
  <tr>
    <td colspan='12'><center><div align='center' class='Estilo2'>ATENTAMENTE</div></center></td>
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
  </tr>
  <tr>
    <td colspan='12'><center><div align='center' class='Estilo2'>$lemaescuela</div></center></td>
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
  </tr>
  <tr>
    <td colspan='12'><center><div align='center' class='Estilo3'><strong>$nombreDirector</strong></div></center></td>
  </tr>
  <tr>
    <td colspan='12'><center><div align='center' class='Estilo2'>DIRECTOR</div></center></td>
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
  </tr>
<tr>
    <td colspan='3'><span class='Estilo4'>C.C.P AL ARCHIVO</span></td>
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
    <td colspan='12'><div align='center' class='Estilo1'>
     <p>$direccion. TELS. $telefono $ciudad, $estado</p>
      <p>$paginainternet</p>
    </div></td>
  </tr>
</table>
</body>
</html>";



if($row[pk_sinodal]!="1092"){


        $htmlSuplente = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Documento sin t&iacute;tulo</title>
<style type='text/css'>
<!--
.Estilo1 {
	font-size: 12px;
	font-weight: bold;
}
.Estilo2 {
	font-size: 14px;
	font-weight: bold;
}
.Estilo3 {font-size: 14px}
.Estilo4 {font-size: 10px}
-->
</style>
</head>

<body>
<table width='785' border='0' >
<tr>
    <td colspan='2' rowspan='6'><div align='center'><img src='../../../../../assets/img/IESCH.png' width='117' height='121' /></div></td>
    <td colspan='8'><center><div align='center'><strong>$nombreInstitucion</strong></div></center></td>
    <td colspan='2' rowspan='6'><div align='center'><img src='../../../../../assets/img/fimpes.png' width='107' height='109' /></div></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong> </strong></div></center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>INCORPORADO A LA  SECRETARIA DE EDUCACION</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>OFICIO No. $numerooficio DE FECHA $fechaIncorporacionsecretaria</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>REGIMEN: $regimen    CLAVE: </strong><strong>$clave</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>EXCELENCIA ACADEMICA: $registro </strong></div>
    </center></td>
  </tr>
  <tr>
    <td width='105'>&nbsp;</td>
    <td width='39'>&nbsp;</td>
    <td width='73'>&nbsp;</td>
    <td width='44'>&nbsp;</td>
    <td width='47'>&nbsp;</td>
    <td width='68'>&nbsp;</td>
    <td width='33'>&nbsp;</td>
    <td width='103'>&nbsp;</td>
    <td width='36'>&nbsp;</td>
    <td width='55'>&nbsp;</td>
    <td width='53'>&nbsp;</td>
    <td width='79'>&nbsp;</td>
  </tr>
</table>
  
  
<table  width='785' border='0' style='border-collapse: collapse;'>
  <tr>
    <td width='105'>&nbsp;</td>
    <td width='39'>&nbsp;</td>
    <td width='73'>&nbsp;</td>
    <td width='44'>&nbsp;</td>
    <td width='47'>&nbsp;</td>
    <td width='68'>&nbsp;</td>
    <td width='33'>&nbsp;</td>
    <td width='103'>&nbsp;</td>
    <td width='36'>&nbsp;</td>
    <td width='55'>&nbsp;</td>
    <td width='53'>&nbsp;</td>
    <td width='79'>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan='6' align='right' ><div align='right' class='Estilo2'>ASUNTO: SOLICITAMOS SU ASISTENCIA</div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align='right'><span class='Estilo3'></span></div></td>
    <td colspan='4' align='right'><div align='right' class='Estilo3'><strong>PARA LA TOMA DE PROTESTA</strong></div></td>
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
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan='8' align='right'><div align='right' class='Estilo2'>$ciudad, $estado; " . $today . "</div></td>
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
  </tr>
  <tr>
    <td colspan='8'><div align='left' class='Estilo2'>" . $row[NombreSuplente] . "</div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='4'><div align='left' class='Estilo2'>PRESENTE.</div></td>
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
  </tr>
  <tr>
    <td height='54' colspan='12'><span class='Estilo3'>POR ESTE CONDUCTO SOLICITO A USTED, SU PRESENCIA EN LA APLICACION DEL EXAMEN PROFESIONAL QUE SE LLEVARA ACABO EN LAS INSTALACIONES DE ESTE INSTITUTO.</span></td>
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
  </tr>
  <tr>
    <td><div align='center' class='Estilo3'><strong>HORA</strong></div></td>
    <td colspan='2'><div align='center' class='Estilo3'><strong>FECHA</strong></div></td>
    <td colspan='5'><div align='center' class='Estilo3'><strong>SUSTENTANTE</strong></div></td>
    <td colspan='2'><div align='center' class='Estilo3'><strong>LUGAR</strong></div></td>
    <td colspan='2'><div align='center' class='Estilo3'><strong>CARGO</strong></div></td>
  </tr>
  <tr>
    <td colspan='12'><div align='center'></div></td>
  </tr>
  <tr>
    <td><div align='center' class='Estilo3'>" . $row[hora] . "</div></td>
    <td colspan='2'><div align='center'><span class='Estilo3'>" . $fechaLista . "</span></div></td>
    <td colspan='5'><div align='center'><span class='Estilo3'>" . $row[ApaternoAlumno] . " " . $row[AmaternoAlumno] . " " . $row[NombreAlumno] . "</span></div></td>    <td colspan='2'><div align='center'><span class='Estilo3'>" . $row[salon] . "</span></div></td>
    <td colspan='2'><div align='center'><span class='Estilo3'>SUPLENTE</span></div></td>
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
  </tr>
  <tr>
    <td colspan='12'><span class='Estilo3'>EN ESPERA DE SU PUNTUAL ASISTENCIA, LE ANTICIPO LAS GRACIAS.</span></td>
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
  </tr>
  <tr>
    <td colspan='12'><center><div align='center' class='Estilo2'>ATENTAMENTE</div></center></td>
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
  </tr>
  <tr>
    <td colspan='12'><center><div align='center' class='Estilo2'>&quot;$lemaescuela&quot;</div></center></td>
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
  </tr>
  <tr>
    <td colspan='12'><center><div align='center' class='Estilo3'><strong>$nombreDirector</strong></div></center></td>
  </tr>
  <tr>
    <td colspan='12'><center><div align='center' class='Estilo2'>DIRECTOR</div></center></td>
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
  </tr>
<tr>
    <td colspan='3'><span class='Estilo4'>C.C.P AL ARCHIVO</span></td>
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
    <td colspan='12'><div align='center' class='Estilo1'>
      <p>$direccion. TELS. $telefono $ciudad, $estado</p>
      <p>$paginainternet</p>
    </div></td>
  </tr>
</table>
</body>
</html>";
   }      
        $res=$html.$htmlPresidente.$htmlSecretario.$htmlVocal.$htmlSuplente;

    
        
    }
} else {
    $html = "Lo Sentimos No Se Pudo Realizar la Consulta";
}

//ob_start();
//$mpdf = new mPDF();
//$mpdf->WriteHTML($res);
//$mpdf->Output("Reporte_InvitacionSinodales_" . $today, 'D');
$parte = explode("<html xmlns='http://www.w3.org/1999/xhtml'>", $res);
   $parte1Lista = $parte[0];
   $parte2Lista = $parte[1];
   $parte3Lista = $parte[2];
   $parte4Lista = $parte[3];
   $parte5Lista = $parte[4];
   $parte6Lista = $parte[5];
//$mpdf=new mPDF(); 

$mpdf=new mPDF(); 

$mpdf->WriteHTML($parte1Lista);
$mpdf->WriteHTML($parte2Lista);
$mpdf->WriteHTML($parte3Lista);
$mpdf->WriteHTML($parte4Lista);
$mpdf->WriteHTML($parte5Lista);
$mpdf->WriteHTML($parte6Lista);
$mpdf->Output("Invitacion_Sinodales_" . $today .".pdf", 'I');

?> 
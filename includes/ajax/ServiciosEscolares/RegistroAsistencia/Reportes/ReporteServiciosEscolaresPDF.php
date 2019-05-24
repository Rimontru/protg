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
    
    
    
    $Result32 = $Obras->ConsultaDatosInsitucionConEstados();
    if ($Result32) {
       $row333 = mysql_fetch_assoc($Result32);

        $nombreInstitucion=strtoupper($row333['nombreInstitucion']);
        $apodoInstitucion=$row333['apodoInstitucion'];
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
    if ($Result) {
        while ($row2 = mysql_fetch_assoc($Result)) {

            $fechaaplicacion = $row2[fechaaplicacionReporte];        
            $fechaExaLetras = $Funciones->Fecha2($fechaaplicacion);                  

            
            
            $html .= "
<div>
<html>
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
.Estilo5 {
	font-size: 18px;
	font-weight: bold;
}
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
    <td colspan='8'><center><div align='center'><strong>INCORPORADO A LA  SECRETARIA DE EDUCACION</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>OFICIO No. $numerooficio DE FECHA $fechaIncorporacionsecretaria</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>REGIMEN: $regimen  CLAVE: </strong><strong>$clave</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>EXCELENCIA ACADEMICA: REG. $registro  </strong></div>
    </center></td>
  </tr>
    <tr>
    <td colspan='8'><center><div align='center'><strong>SERVICIOS ESCOLARES </strong></div>
    </center></td>
  </tr>  
  <tr>
    <td width='105'>&nbsp;</td>
    <td width='39'>&nbsp;</td>
    <td colspan='8'><center><div align='center'></div>
    </center></td>
    <td width='53'>&nbsp;</td>
    <td width='79'>&nbsp;</td>
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
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
     <td colspan='8' align='right'><div align='right' class='Estilo2'>".$ciudad.", ".$estado."</div></td> 
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
    <td colspan='4'  align='right'><div align='right' class='Estilo2'>$fechaExaLetras</div></td>  
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
    <td colspan='6'><span class='Estilo3'><strong><span class='Estilo2'>C. $row2[NombreCompleto]</span></strong></span></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='12'><span class='Estilo2'>SUSTENTANTE DE LA "; 
    if($row2[fk_nivelestudio] == "3"){ //maestria
        
         $html.= "MAESTRIA DE <strong>$row2[nombreCarrera]</strong> ";
    }
    
     if($value->modalidad != "2"){
        
          $html.= "CARRERA DE <strong>$row2[nombreCarrera]</strong> ";
    }
        
    $html.=  "</span></td>            
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
    <td height='61' colspan='12' align='justify'><div align='justify'><span class='Estilo3'>EN ATENCION A SU SOLICITUD DE PRESENTAR EL EXAMEN POR AREAS DE CONOCIMIENTO, COMO </span><span class='Estilo3'>OPCION DE TITULACION, PARA EL DIA <strong>$fechaExaLetras</strong>, ME PERMITO HACER DE SU CONOCIMIENTO QUE DICHA PETICION QUEDA AUTORIZADA, SIEMPRE Y CUANDO CUMPLA CON LOS LINDAMIENTOS QUE SEÑALA LA SECRETARIA DE EDUCACION</span> </div></td>
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
    <td colspan='12'><div align='center' class='Estilo3'>ATENTAMENTE</div></td>
  </tr>

  <tr>
    <td colspan='12'><div align='center' class='Estilo2'>$lemaescuela</div></td>
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
    <td colspan='12'><div align='center' class='Estilo2'><strong>LAE. FLORIBEL MEGCHUN DE LA CRUZ</strong></div></td>
  </tr>
  <tr>
    <td colspan='12'><div align='center' class='Estilo2'>DIRECTORA</div></td>
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
    <td colspan='3'><span class='Estilo4'>C.C.P A EXPEDIENTE</span></td>
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
</html>
</div>
            ";
    
    
    
        }
        mysql_free_result($Result);
        //obtenemos la fecha de aplicacion

    }
} else {
    $html = "Lo Sentimos No Se Pudo Realizar la Consulta";
}
//echo $html;
ob_start();
$mpdf = new mPDF();
//$mpdf->AddPage('L', '', '', '', '', '', '', '', '', '', '');
$mpdf->WriteHTML($html);
$mpdf->Output("Reporte_Constancia" . $today.'.pdf', 'I');
?> 
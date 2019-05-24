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

        $nombreInstitucion = $row333['nombreInstitucion'];
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


   $especialidad=0;
        $maestria=0;
        $ceneval=0;
        $institucional=0;
        $promedio=0;
        $titulacion=0;
        $tesis=0;
    
    
    
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

<center><div align="center"><strong>CARRERA: '.$carreraReporte.'</strong></div></center>
  </br>
<table width="874" border="0">
  <tr>
    <td width="70"><span class="estilo">No.</span></td>
    <td width="108"><span class="estilo">Matrícula</span></td>
    <td colspan="3"><span class="estilo">Nombre</span></td>
    <td width="430"><span class="estilo">Opción de Titulacion</span></td>
  </tr>
  
  ';
    
    
    
    
    
    
    
    
//   $result = $consulta->selectbd("select  * from tramites where fechaexpediciontitulo BETWEEN '" . $fechaLista . "' and '" . $fechaListaDos . "' and carrera='" . $carreraReporte . "' and modalidad='" . $modalidadReporte . "' ORDER BY apaterno ASC");
    
    
$contador2=1;
    
$result33 = $Obras->ConReporteAlumnosTituloExpedido($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fechaInicio, $fechaFin);
if ($result33) {
    while ($row33 = mysql_fetch_assoc($result33)) {
        
        
//    $fechaNac = explode("-", $value->fechaNac);
   // $fechaActualLista = $fechaNac[0] . "-" . $fechaNac[1] . "-" . $fechaNac[2];
    $FechaExpTitulo = $row33['fechaexpediciontitulo'];
    

        $html2 = "
                        
<tr>
    <td><span class='estilo'>$contador2</span></td>
    <td><span class='estilo'>".$row33['matricula']."</span></td>
    <td colspan='3'><span class='estilo'>".$row33['NombreCompleto']."</span></td>
    <td><span class='estilo'>".$row33['NombreOpcionTitulacion']."</span></td>
  </tr>
           
                
     ";

     
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
        
        
        $html4 = $html4 . $html2;
        $contador2=$contador2+1;
        
          
    }
    mysql_free_result($result33);
}


  
    
    $html3 = '

</table>

<table width="569" border="0">
  <tr>
    <td width="428"><span class="estilo">ÁREA</span></td>
    <td width="131"><span class="estilo">TOTAL</span></td>
  </tr>
  
   <tr>
    <td width="428">&nbsp;</td>
    <td width="131">&nbsp;</td>
  </tr>
  
     <tr>
    <td class="estilo">ESTUDIOS DE POSGRADO (50% DE MAESTRIA)</td>
    <td class="estilo">'.$maestria.'</td>
  </tr>
   <tr>
    <td class="estilo">SUSTENTACION DE EXAMEN POR AREAS DE CONOCIMIENTO</td>
    <td class="estilo">'.$institucional.'</td>
  </tr>
           
  <tr>
    <td class="estilo">PROMEDIO GENERAL DE CALIFICACIONES</td>
    <td class="estilo">'.$promedio.'</td>
  </tr>
  
   <tr>
    <td class="estilo">SUSTENTACIÓN DE EXAMEN POR AREAS DE CONOCIMIENTO (CENEVAL)</td>
    <td class="estilo">'.$ceneval.'</td>
  </tr>
  
   <tr>
    <td class="estilo">ESTUDIO DE POSGRADO (ESPECIALIDAD)</td>
    <td class="estilo">'.$especialidad.'</td>
  </tr>
  
   <tr>
    <td class="estilo">CURSO DE TITULACIÓN</td>
    <td class="estilo">'.$titulacion.'</td>
  </tr>
  
    <tr>
    <td class="estilo">TESIS PROFESIONAL</td>
    <td class="estilo">'.$tesis.'</td>
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

$timeo_start = microtime(true);
ini_set("memory_limit","280824M");
ini_set('max_execution_time', 400);

ob_start();
//$timeo_start = microtime(true);




$mpdf=new mPDF('','Letter','',''); 
$mpdf->AddPage('L','','','','','','','','','','');
$mpdf->WriteHTML($res);
$mpdf->Output("AlumnosTituloExpedido_". $today.'.pdf', 'I');
?> 

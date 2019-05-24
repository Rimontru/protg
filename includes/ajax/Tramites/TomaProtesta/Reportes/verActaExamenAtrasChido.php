<?php

require_once("../../../../../includes/Config.class.php");  # Cargar datos conexion y otras variables.
require_once('../../../../../includes/DB.class.php');
require_once('../../../../../includes/ConsultaDB.class.php');
require_once('../../../../../includes/MisFunciones.class.php');
require_once('../../../../../mpdf/mpdf.php');


$Obras = new ConsultaDB;
$Funciones = new MisFunciones;
$today = date("d-m-Y");

//obtenemos fecha actual y cambiamos el formato de vista
$fechaActual = strftime("%Y-%m-%d", time());
$fechaActualModificar = explode("-", $fechaActual);
$fechaActualLista = $fechaActualModificar[0] . "-" . $fechaActualModificar[1] . "-" . $fechaActualModificar[2];
$fechaLetras = $Funciones->Fecha2Mayusculas($fechaActualLista);

$fechaDividir = explode("DE", $fechaLetras);
$fechaDia = $fechaDividir[0];
$fechaMes = $fechaDividir[1];
$fechaAnio = $fechaDividir[2];


if (isset($_GET['pk_alumno'])) {


    $pk_alumno = $_GET['pk_alumno'];
    $CicloEscolarPromt = $_GET['CicloEscolarPromt'];


    //DATOS DE LA ESCUELA
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

    
    




    $result = $Obras->ConReporteDocumentacionAlumnosPorLlavePrimaria($pk_alumno);
    while ($row = mysql_fetch_assoc($result)) {


        $tomaprotestaLetras = $Funciones->Fecha2Mayusculas($row[FechaTomaProtesta]);
        $fechaLista = ($row[FechaTomaProtestaReporte]);



        //DATOS DEL DIRECTOR
        $fk_carreras = $row[fk_carreras];
        $Result22 = $Obras->verTrabajadoresDirectoresReportes($fk_carreras);
        if ($Result22) {
            $row222 = mysql_fetch_assoc($Result22);
            $nombreDirector = ($row222[nombre] . " " . $row222[apaterno] . " " . $row222[amaterno]);
            $carreraReporte = ($row222[nombreCarrera]);
            $genero = $row222[fk_genero];
            mysql_free_result($Result22);
        }



       $noacuerdo = $row[noacuerdo];
       $fechaExpedicion = $row[fechaExpedicion];
     //  $fechaVigente
//saber si es fecha o vigente 1=fecha 2=vigente
        if($row[TipoRevoe]=='1'){
            
            $fechaVigente="FECHA ";
        }else if($row[TipoRevoe]=='2'){
            $fechaVigente="VIGENTE ";
        }
        
         $apaterno = $row[ApaternoAlumno];
         $amaterno= $row[AmaternoAlumno];
         $nombre= $row[NombreAlumno];
         $curp = $row[curp];
         $matricula = $row[matricula];
         $planestudio = $row[PlanEstudiosNombre];
         $promedio = $row[promedio];
         $letraPromedio = $row[letraPromedio];
        
        
         //sinodales
         $presidente = $row[NombrePresidente];
         $cedula1= $row[CedulaPresidente];
         
         $secretario= $row[NombreSecretario];
         $cedula2= $row[CedulaSecretario];
                 
         $vocal= $row[NombreVocal];
         $cedula3= $row[CedulaVocal];
                 
         $suplente= $row[NombreSuplente];
         $cedula4  = $row[CedulaSuplente];
         
         
         
         
//FECHA DE SOLICITUD $fechasolicitud
$fechasolicitud = $row[FechaSolicitud];
//FECHA EXAMEN 
$fechaListaProtesta= $row[FechaExamen];
//TOMA DE PROTESTA 
$fechaLista= $row[FechaTomaProtestaReporte];

$hora = $row[hora];
$duracion = $row[DescripcionDuracion];
$autorizacion = $row[NumeroAutorizacion];
            
            
            
//ExamenExtraOrdinario        
     
if($row[ExamenExtraOrdinario]=="1"){
    
    $opcionExtraSi="X";
     $opcionExtraNo="";
}
if($row[ExamenExtraOrdinario]=="2"){
     $opcionExtraNo="X";
    $opcionExtraSi="";
}

//fk_carreras
//ingeniero constructor     INGENIERO ZOOTECNISTA ADMINISTRADOR            //sistemas                           civil                       ///medico
if($row[fk_carreras]=="6" || $row[fk_carreras]=="7"  || $row[fk_carreras]=="11" || $row[fk_carreras]=="27" || $row[fk_carreras]=="13"  || $row[fk_carreras]=="12"){
    
    $carrera=$row[nombreCarrera];
}else if($row[fk_carreras]=="2" || $row[fk_carreras]=="29"){
	$carrera=$row[nombreCarrera];
}else{
    $carrera="LICENCIADO EN ".$carrera;
    
}
 

$opcionTitulacion=strtoupper($row[NombreOpcionTitulacion]);








//
//$horaDividir = explode(":",$hora);
//$horaHora=$horaDividir[0];
//$horaMinuto = $horaDividir[1];
//$horaListo = convertir($horaHora);
//$horaMinutoListo = convertir($horaMinuto);
//
//
//$fechaLetras = fechaATexto($tomaprotesta, 'u'); // Devuelve '10 DE AGOSTO DE 1981'
//
//
//$fechaDividir = explode("DE", $fechaLetras);
//$fechaDiaProtesta = convertir($fechaDividir[0]);
//$fechaMesProtesta=$fechaDividir[1];
//$fechaAnioProtesta=convertir($fechaDividir[2]);
//    $fechaAnioProtestaListo=substr($fechaAnioProtesta, -5); //Esto devuelve "ndo" 


    $html = '
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo{font-size: 17px}
.Estilo2 {font-size: 20px}
.Estilo5 {font-size: 17px}
.Estilo3 {
	font-size: 20px;
	font-weight: bold;
}
.Estilo4 {
	font-size: 14px;
	font-weight: bold;
}
.Estilo15 {
	font-size: 18px;
	font-weight: bold;
}
.Estilo16 {font-size: 18px}
.Estilo17 {font-size: 19px}
.Estilo19 {font-size: 15px}
.Estilo20 {font-size: 17px}

-->
</style>
</head>

<body>
<table width="1000" border="0"  style="border-collapse: collapse;">
<tr><center>
                    <td height="78" colspan="9"><center class="Estilo2"><div align="center" class="Estilo2"><strong>TERMINADO EL ACTO SE LEVANTA PARA CONSTANCIA LA PRESENTE ACTA </strong></div></center>                     <center> <div align="center" class="Estilo2"><strong>FIRMANDO DE CONFORMIDAD LOS INTEGRANTES DEL JURADO Y EL DIRECTOR DEL</strong></div></center><center>                      <div align="center" class="Estilo2"><strong>PLANTEL QUE DA FE</strong></div></center></td>
  </center></tr>
                  
                  <tr>
                    <td width="145" height="10">&nbsp;</td>
                    <td width="68">&nbsp;</td>
                    <td width="131">&nbsp;</td>
                    <td width="70">&nbsp;</td>
                    <td width="75">&nbsp;</td>
                    <td width="122">&nbsp;</td>
                    <td width="93">&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="21" colspan="9"><center><div align="center" class="Estilo2"><strong>JURADO DEL EXAMEN</strong></div>
                    </center></td>
  </tr>
                  <tr>
                    <td height="10">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td width="104">&nbsp;</td>
                    <td width="134">&nbsp;</td>
                  </tr>
  
  <tr>
                    <td height="10" colspan="4" align="center"><div align="center"><span class="Estilo2"><strong>NOMBRE:</strong></span></div></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td colspan="3" align="center"><div align="center"><span class="Estilo2"><strong>FIRMA:</strong></span></div></td>
  </tr>
                  <tr>
                    <td height="10">&nbsp;</td>
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
                    <td height="21" colspan="5"  align="left" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom"><span class="Estilo20">'.$presidente.'</span></td>
                    <td>&nbsp;</td>
                    <td colspan="3" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom">&nbsp;</td>
                  </tr>
                   <tr>
                    <td height="21" colspan="4"  align="center"><div align="center" class="Estilo2">PRESIDENTE</div></td>
                    <td>&nbsp;</td>
                    <td align="right">&nbsp;</td>
                    <td colspan="2" align="left"  >
                     <span class="Estilo2"></span><span class="Estilo2">CEDULA PROF. No.</span></td>
                    <td align="left"  style="background: #FFF url(../../../../../assets/img/Untitled-4_clip_image002.png) no-repeat left bottom"><span class="Estilo2">'.$cedula1.'</span></td>
                  </tr>
                   <tr>
                    <td height="10" colspan="4">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  
                      <tr>
                    <td height="10">&nbsp;</td>
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
                    <td height="10">&nbsp;</td>
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
    <td height="21" colspan="5"  align="left" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom"><span class="Estilo">'.$secretario.'</span></td>
                    <td>&nbsp;</td>
                    <td colspan="3" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom">&nbsp;</td>
  </tr>
                   <tr>
                    <td height="21" colspan="4"  align="center"><div align="center" class="Estilo2">SECRETARIO</div></td>
                    <td>&nbsp;</td>
                    <td align="right">&nbsp;</td>
                    <td colspan="2" align="left"  >
                     <span class="Estilo2"></span><span class="Estilo2">CEDULA PROF. No.</span></td>
                    <td align="left"  style="background: #FFF url(../../../../../assets/img/Untitled-4_clip_image002.png) no-repeat left bottom"><span class="Estilo2">'.$cedula2.'</span></td>
                  </tr>
                   <tr>
                    <td height="21" colspan="4">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    
  <tr>
                    <td height="21">&nbsp;</td>
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
                    <td height="21">&nbsp;</td>
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
                    <td height="21" colspan="5"  align="left" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom"><span class="Estilo5">'.$vocal.'</span></td>
                    <td>&nbsp;</td>
                    <td colspan="3" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom">&nbsp;</td>
                  </tr>
                    <tr>
                    <td height="21" colspan="4"  align="center"><div align="center" class="Estilo2">VOCAL</div></td>
                    <td>&nbsp;</td>
                    <td align="right">&nbsp;</td>
                    <td colspan="2" align="left"  >
                     <span class="Estilo2"></span><span class="Estilo2">CEDULA PROF. No.</span></td>
                    <td align="left"  style="background: #FFF url(../../../../../assets/img/Untitled-4_clip_image002.png) no-repeat left bottom"><span class="Estilo2">'.$cedula3.' </span></td>
  </tr>
                  <tr>
                    <td height="21">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td colspan="6">&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="21">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td colspan="6">&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="25" colspan="9"><center> <div align="center" class="Estilo2"><strong>EL DIRECTOR DEL PLANTEL</strong></div>
                    </center></td>
  </tr>
                  <tr>
                    <td height="21" colspan="9">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="21" colspan="9" style="background: #FFF url(../../../../../assets/img/Untitled-4_clip_image002.png) no-repeat center bottom"><center><div align="center" style="padding-top: 17px;"></div></center></td>
  </tr>
                  <tr>
                    <td height="21" colspan="9"><center><div align="center" class="Estilo2">'.$nombreDirector.'</div>
                    </center>
                    <div align="left"></div></td>
                  </tr>
                  <tr>
                    <td height="5">&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                    <td colspan="3"><div align="center"></div></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                 
</table>
<table width="1000" border="0"  style="border-collapse: collapse;">

<tr>
                    <td width="66" height="21">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
                    <td colspan="3">&nbsp;</td>
    <td width="85">&nbsp;</td>
    <td width="1">&nbsp;</td>
    <td width="149">&nbsp;</td>
  </tr>
<tr>
                    <td height="21">&nbsp;</td>
                    <td width="237">&nbsp;</td>
    <td width="92">&nbsp;</td>
    <td width="122">&nbsp;</td>
    <td width="110">&nbsp;</td>
    <td width="90">&nbsp;</td>
    <td>&nbsp;</td>
                    <td>&nbsp;</td>

                    <td>&nbsp;</td>
  </tr>
  
  <tr>
      <td height="21" colspan="3"  align="center"><div align="center"><span class="Estilo2"><strong>JEFE DEL DEPARTAMENTO DE</strong></span></div></td>
                    <td>&nbsp;</td>
                    <td colspan="5"  align="center"><div align="center"><span class="Estilo3">DIRECTOR DE EDUCACIÓN SUPERIOR</span></div></td>
  </tr>
                  
                   <tr>
                    <td height="21" colspan="3"  align="center"><div align="center"><span class="Estilo2"><strong>SERVICIOS ESCOLARES Y BECAS</strong></span></div></td>
                    <td>&nbsp;</td>
                    <td colspan="5"><div align="center"></div></td>
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
                    <td>&nbsp;</td>
                  </tr>
  <tr>
                    <td height="21" colspan="3" >&nbsp;</td>
                    <td>&nbsp;</td>
                    <td colspan="5">&nbsp;</td>
                  </tr>
                   <tr>
                    <td height="21" colspan="3" align="center"><span class="Estilo2"><strong>ING. JULIO MONTERO MEDEROS</strong></span></td>
                    <td>&nbsp;</td>
                    <td colspan="5" align="center" ><span class="Estilo3"><!--DR. LUIS MADRIGAL FRÍAS--></span></td>
                  </tr>
                 <tr>
                    <td height="21" colspan="9">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="5">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                 
                  <tr>
                    <td height="21">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td colspan="5" rowspan="4" align="justify">
                    <div align="justify" class="Estilo15">POR  ACUERDO  DEL SECRETARIO GENERAL DE        GOBIERNO Y CON  FUNDAMENTO EN EL ART.  28, FRACCIÓN X, DE   LA  LEY  ORGÁNICA   DE  LA ADMINISTRACIÓN PUBLICA DEL ESTADO DE CHIAPAS.</div></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td width="1">&nbsp;</td>
                    <td width="1">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="5">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2" rowspan="1" align="center" style="border-width: 1px;border: solid;" ><div align="center"><strong>REGISTRADO EN EL</strong></div>
                      <div align="center"><span class="Estilo4">DEPARTAMENTO DE SERVICIOS</span></div>
                      <div align="center"><strong>ESCOLARES Y BECAS</strong></div></td>
                  </tr>
                  <tr>
    <td colspan="2" rowspan="4"  style="border-width: 1px;border: solid;">
    <table width="301" border="0">
      <tr>
        <td width="69" ><span class="Estilo19"><strong>CON No. </strong></span></td>
        <td width="222" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom"><div align="center"><span class="Estilo16"><span class="Estilo19"></span></span></div></td>
      </tr>
      <tr>
        <td><span class="Estilo19"><strong>LIBRO: </strong></span></td>
        <td style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom"><div align="center"><span class="Estilo16"><span class="Estilo19"></span></span></div></td>
      </tr>
      <tr>
        <td><span class="Estilo19"><strong>A FOJAS: </strong></span></td>
        <td style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom"><div align="center"><span class="Estilo16"><span class="Estilo19"></span></span></div></td>
      </tr>
      <tr>
        <td height="22"><span class="Estilo19"><strong>FECHA:</strong></span></td>
        <td style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom"><div align="center"><span class="Estilo16"><span class="Estilo19"></span></span></div></td>
      </tr>
    </table></td>
                  <tr>
                  	<td height="21">&nbsp;</td>
                  <tr>
                    <td height="21">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                  	<td height="21">&nbsp;</td>
                    <td height="21">&nbsp;</td>
                    <td colspan="5" align="justify"><span class="Estilo2"><strong>SE LEGALIZA, previo cotejo con la que existe en el control    respectivo,    la    firma    que     antecede, corresponde al Director de Educación Superior.</strong></span></td>
                  <tr>
                    <td colspan="2"  align="center"  style="border-width: 1px;border: solid;" ><div align="center" class="Estilo2"><strong>COTEJO</strong></div></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                     <tr>
    <td colspan="2" rowspan="2"  style="border-width: 1px;border: solid;">&nbsp;</td>
    <td height="69">&nbsp;</td>
    <td>&nbsp;</td>
      <td colspan="7" align="center"><div align="center"><span class="Estilo2"><strong><!--DR. LUIS MADRIGAL FRÍAS--></strong></span></div></td>
 

                  </tr>
                  <tr><tr>
                     <td height="24" colspan="2"  style="border-width: 1px;border: solid;"  align="center" ><div align="center"><span class="Estilo2"><strong>JEFE DE LA OFICINA</strong></span></div></td>
    
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td colspan="4"  align="right" ><span class="Estilo2">Tuxtla Gutiérrez, Chiapas; a </span></td>
    				<td colspan="3" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom">&nbsp;</td>
  				</tr>
  <tr>
	<td colspan="2" rowspan="2" style="border-width: 1px;border: solid;">&nbsp;</td>
	  <td height="25">&nbsp;</td>
	  <td>&nbsp;</td>

	<td colspan="7"></td>
	
  </tr>
                  <tr>
                  	<td height="30">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  <tr>
                  	  
                    <td height="21" colspan="2">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                        <td colspan="7" align="center" ><span class="Estilo2"><strong>SUBSECRETARIO DE ASUNTOS JURÍDICOS</strong></span></td>
                  </tr>
                  <tr><tr>
                    <td height="21">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr><tr>
                    <td height="21">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td colspan="7" align="center" >&nbsp;</td>
                  </tr>
                  <tr><tr>
                    <td height="40">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td colspan="7"  align="center"   style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left top"><span><span class="Estilo2"><strong>LIC. JOSE RAMON CANCINO IBARRA</strong></span></span></td>
  
                  </tr>
                  <br>
                  <br>
                  <tr><tr>
                    <td height="21">&nbsp;</td>
                    <td colspan="7" align="center" class="Estilo2"><center>Este documento NO es válido si presenta raspaduras o enmendaduras.</center></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>

</table>
<div style="position: absolute; left: 470px; top: 730px;"><img src="../../../../../assets/img/linea_larga.png" width="245" height="2" /></div>
<div style="position: absolute; left: 70px; top: 730px;"><img src="../../../../../assets/img/linea_larga.png" width="260" height="2" /></div>
<div style="position: absolute; left: 470px; top: 1018px;"><img src="../../../../../assets/img/linea_larga.png" width="245" height="2" /></div>
</body>
</html>
';

    
    
    
        
        
        
        
        
    }
} else {
    $html = "Lo Sentimos No Se Pudo Realizar la Consulta";
}
//echo $html;
ob_start();
$mpdf=new mPDF('c','Legal','',''); 
//$mpdf->AddPage('L', '', '', '', '', '', '', '', '', '', '');
$mpdf->WriteHTML($html);
$mpdf->Output("Reporte_ActaExamen_Atras" . $today . ".pdf", 'I');

?> 
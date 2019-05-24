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
	$fk_modalidad=$_GET['fk_modalidad'];
	
    $modalidad =strtoupper( $_GET['modalidad']);


    //DATOS DE LA ESCUELA
    $Result32 = $Obras->ConsultaDatosInsitucionConEstados();
    if ($Result32) {
        $row333 = mysql_fetch_assoc($Result32);

        $nombreInstitucion = strtoupper($row333['nombreInstitucion']);
        $apodoInstitucion =strtoupper( $row333['apodoInstitucion']);
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

    
    




    $result = $Obras->ConReporteDocumentacionAlumnosPorLlavePrimaria($pk_alumno);
    while ($row = mysql_fetch_assoc($result)) {


        $tomaprotestaLetras = $Funciones->Fecha2Mayusculas($row[FechaTomaProtesta]);
        
        $fechaLista = ($row[FechaTomaProtestaReporte]);
        
        $fechaexamenLista = $row['FechaExamen'];
        $fechaexamenListaModificar = explode("-", $fechaexamenLista);
        $FechaExamenalcien = $fechaexamenListaModificar[0] . "-" . $fechaexamenListaModificar[1] . "-" . $fechaexamenListaModificar[2];
        $fechaExamenLetras = $Funciones->Fecha2Mayusculas($FechaExamenalcien);

        $curp = $row[CurpLista];
        if($curp!=""){
            $curp="------------------------------";
        } else {$curp="------------------------------";}   
        
        $planestudio = $row[PlanEstudiosNombre];
         if($planestudio==""){
            $planestudio="------------------------------";
        } else {$planestudio="------------------------------";}

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
            $fechaVigente="VIGENCIA ";
        }else if($row[TipoRevoe]=='0'){
            $fechaVigente="COLOCAR FECHA O VIGENTE ";
        }else if($row[TipoRevoe]=='3'){
	    $fechaVigente="VIGENTE";	
	}
        
         $apaterno = $row[ApaternoAlumno];
         $amaterno= $row[AmaternoAlumno];
         $nombre= $row[NombreAlumno];
         $matricula = $row[matricula];
         
      
         
         $promedio = $row[promedio];
         $letraPromedio = $row[letraPromedio];

        
         //sinodales
         $presidente = $row[NombrePresidente];
         $cedula1= $row[CedulaPresidente];
         
         $secretario= $row[NombreSecretario];
         $cedula2= $row[CedulaSecretario];
                 
         $vocal= $row[NombreVocal];
         $cedula3= $row[CedulaVocal];
                 
//         $suplente= $row[NombreSuplente];
//         $cedula4  = $row[CedulaSuplente];
         
         
//FECHA DE SOLICITUD $fechasolicitud
$fechasolicitud = $row[FechaSolicitudLista];
//FECHA EXAMEN 
$fechaexamen= $row[FechaExamen];
//TOMA DE PROTESTA 
$fechaprotesta= $row[FechaTomaProtesta];



$hora = strtoupper($row[hora]);
$duracion = $row[DescripcionDuracion];
$autorizacion =strtoupper($row[NumeroAutorizacion]);
            
            
            
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
////ingeniero constructor     INGENIERO ZOOTECNISTA ADMINISTRADOR            //sistemas                           civil                       ///medico
//if($row[fk_carreras]=="6" || $row[fk_carreras]=="7"  || $row[fk_carreras]=="11" || $row[fk_carreras]=="27" || $row[fk_carreras]=="13"  || $row[fk_carreras]=="12"){
//    
    $carrera = mb_strtoupper($row[nombreCarrera], 'UTF-8');
$titulo = mb_strtoupper($row[nombreTitulo],'UTF-8');
//}else if($row[fk_carreras]=="2" || $row[fk_carreras]=="29"){
//	$carrera=$row[nombreCarrera];
//}else{
//    $carrera="LICENCIADO EN ".$carrera;
//    
//}
 if($row[pk_sinodal]!="1092"){
        $suplente=$row[NombreSuplente];
        $cedulaSuplente=$row[CedulaSuplente];
    }else{
        $suplente="";
        $cedulaSuplente="";
        }

$opcionTitulacion=strtoupper($row[NombreOpcionTitulacion]);
$turno=strtoupper($row[NombreTurno]);
$generacion=$row[generacionSecre];
$nombreTesis=$row[nombreTesis];





$html.='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed, 
figure, figcaption, footer, header, hgroup, 
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
	margin: 0;
	padding: 0;
	border: 0;
	font-size: 100%;
	font: inherit;
	vertical-align: baseline;
}
/* HTML5 display-role reset for older browsers */
article, aside, details, figcaption, figure, 
footer, header, hgroup, menu, nav, section {
	display: block;
}
body {
	line-height: 1;
}
ol, ul {
	list-style: none;
}
blockquote, q {
	quotes: none;
}
blockquote:before, blockquote:after,
q:before, q:after {
	content:"";
	content: none;
}
table {
	border-spacing: 0px;
}
td{
	padding:1px;}

.Estilo4 {font-size: 15px;
font-family:arial;font-weight:900;}
.Estilo5 {font-size: 15px;
font-family:calibri;}

.Estilo6{
	font-family:dejavusanscondensed;
	font-size: 14px;}

td.borde{
	border:1px solid #000;}
-->
</style>
</head>

<body>
<div class="logo" style="position: absolute; left: 20px; top:45px;">
		<img src="../../../../../assets/img/logo_gobierno_chiapas.png" width="200" height="70" />
	</div>
	
<div class="logo" style="position: absolute; left:600px; top:42px;">
	<img src="../../../../../assets/img/secretaria.jpg" width="140" height="auto" />
</div>	



<table width="890px" border="0" style="border-collapse: collapse;" class="Estilo4">

	<tr>
		<td width="888px" colspan="8" align="center"><strong>SECRETARIA DE EDUCACIÓN</strong></td>
	</tr>
	<tr>
		<td width="888px" colspan="8" align="center"><strong>SUBSECRETARIA DE EDUCACION ESTATAL</strong></td>
	</tr>
	<tr>
		<td width="888px" colspan="8" align="center"><strong>DIRECCIÓN DE EDUCACIÓN SUPERIOR</strong></td>
	</tr>
	<tr>
		<td width="888px" colspan="8" align="center"><strong>DEPARTAMENTO DE SERVICIOS ESCOLARES Y BECAS</strong></td>
	</tr>
	<tr>
		<td width="888px" colspan="8" align="center"><strong>'.$nombreInstitucion.'</strong></td>
	</tr>


	
</table>

<table width="890px" border="0" class="Estilo5" style="">
	<tr>
		<td width="111px">&nbsp;</td>
		<td width="111px">&nbsp;</td>
		<td width="111px">&nbsp;</td>
		<td width="111px">&nbsp;</td>
		<td width="111px">&nbsp;</td>
		<td width="111px">&nbsp;</td>
		<td width="111px">&nbsp;</td>
		<td width="111px">&nbsp;</td>
	</tr>
	<tr>
		<td width="888px" colspan="8" align="center"><strong>SOLICITUD DE EXAMEN DE GRADO</strong></td>
	</tr>	
<tr style="background-color:#C0C0C0">
	<td width="888px" align="center" colspan="8" class="borde"><strong>DATOS DE LA INSTITUCION</strong></td>
</tr>
<tr>
	<td colspan="3" class="borde"><strong>NOMBRE DE LA INSTITUCION EDUCATIVA:</strong></td>
	<td colspan="5" class="borde" >'.$nombreInstitucion.'</td>
</tr>
<tr>
	<td colspan=""  class="borde"><strong>DIRECCION:</strong></td>
	<td colspan="4" class="borde">'.$direccion.' TUXTLA GUTIERREZ</td>	
	<td colspan=""  class="borde"><strong>CLAVE:</strong></td>
	<td colspan="2" class="borde">'.$clave.'</td>
</tr>

<tr>
	<td width="111px" colspan=""  class="borde"><strong>RVOE:</strong></td>
	<td width="222px" colspan="2" class="borde" style="font-size:12px">'.$noacuerdo.'</td>
	<td width="222px" colspan="2" class="borde" ><strong>FECHA DE OTORGAMIENTO:</strong></td>
	<td width="333px" colspan="3" class="borde" style="font-size:12px">'.$fechaVigente.': ' . $fechaExpedicion.'</td>
</tr>
<tr>
	<td width="111px" colspan="" class="borde"><strong>TURNO:</strong></td>
	<td width="222px" colspan="2" class="borde">'.$turno.'</td>
	<td width="222px" colspan="2" class="borde">REGIMEN: ' .$regimen.'</td>';

if($modalidad==""){
	$html.='<td width="333px" colspan="3" class="borde" ></td>
</tr>'; }else
$html.='<td width="333px" colspan="3" class="borde" >MODALIDAD: ' . $modalidad.'</td>
</tr>'; 

$html.='</table>

<table width="890px" border="0" class="Estilo5" style=" margin-top:20px;">

<tr style="background-color:#C0C0C0">
	<td width="888px" align="center" colspan="8" class="borde"><strong>DATOS DEL ALUMNO</strong></td>
</tr>
<tr>
	<td width="222px" colspan="2" align="center" class="borde"><strong>APELLIDO PATERNO</strong></td>
    <td width="333px" colspan="3" align="center" class="borde"><strong>APELLIDO MATERNO</strong></td>
<td width="333px" colspan="3" align="center" class="borde"><strong>NOMBRE(S)</strong></td>
</tr>
<tr>
	<td width="222px" colspan="2" align="center" class="borde">'.$apaterno.'</td>
    <td width="333px" colspan="3" align="center" class="borde">'.$amaterno.'</td>
<td width="333px" colspan="3" align="center" class="borde">'.$nombre.'</td>
</tr>
<tr>
	<td width="222px" colspan="2" class="borde"><strong>CURP:</strong></td>
	<td width="222px" colspan="2" class="borde">------------------------</td>
	<td width="222px" colspan="2" class="borde" align="center"><strong>MATRICULA</strong></td>
	<td width="222px" colspan="2" class="borde">'.$matricula.'</td>

</tr>
<tr>
	<td width="111px" colspan="1" class="borde"><strong>GRADO:</strong></td>
	<td width="444px" colspan="4" class="borde" style="font-size:12PX">'.$carrera.'</td>
	<td width="111px" colspan=""  class="borde"><strong>GENERACION:</strong></td>
	<td width="222px" colspan="2" class="borde" style="font-size:14px">'.$generacion.'</td>

</tr>
<tr>
	<td width="222px" colspan="2" class="borde"><strong>PLAN DE ESTUDIOS:</strong></td>
	<td width="222px" colspan="2" class="borde">-------------------------</td>
	<td width="222px" colspan="2" class="borde" align="center"><strong>PROMEDIO</strong></td>
	<td width="222px" colspan="2" class="borde">'.$promedio.'</td>

</tr>
	<tr>
		<td width="888px" height="50px" colspan="8" class="borde"><strong>OPCION DE TITULACION:</strong>';
			if($opcionTitulacion=="PROMEDIO GENERAL DE CALIFICACIONES"){
				
			  $html.=' POR PROMEDIO ';
				}else
			if($opcionTitulacion=="TESIS DE GRADO"){
				$html.=' ' .$opcionTitulacion.' ' . $nombreTesis.'';
				}else
				
				$html.=' ' .$opcionTitulacion.'';
		
		
		$html.='</td>
	</tr>
	<tr>
		<td width="444px" colspan="4" align="center" class="borde"><strong>PRESENTO EXAMEN EXTRAORDINARIO:</strong></td>
		<td width="222px" colspan="2" class="borde" align="center">SI ( ' .$opcionExtraSi . ' )</td>
		<td width="222px" colspan="2" class="borde" align="center">NO ( ' .$opcionExtraNo. ' )</td>
	</tr>	
	<tr>
		<td width="111px">&nbsp;</td>
		<td width="111px">&nbsp;</td>
		<td width="111px">&nbsp;</td>
		<td width="111px">&nbsp;</td>
		<td width="111px">&nbsp;</td>
		<td width="111px">&nbsp;</td>
		<td width="111px">&nbsp;</td>
		<td width="111px">&nbsp;</td>
	</tr>



</table>

<table width="890px" border="1" class="Estilo5" style=" margin-top:5px;">
<tr style="background-color:#C0C0C0">
	<td width="888px" align="center" colspan="10" class="borde"><strong>DATOS DEL JURADO</strong></td>
</tr>
<tr>
	<td width="0" colspan="2" class="borde">&nbsp;</td>
	<td width="0" colspan="5" align="center" class="borde"><strong>APELLIDOS, NOMBRE(S)</strong></td>
    	<td width="0" colspan="3" align="center" class="borde"><strong>No. DE CEDULA PROFESIONAL</strong></td>
</tr>
<tr>
	<td width=""  colspan="2" class="borde"><strong>PRESIDENTE:</strong></td>
	<td width=""  colspan="5" class="borde" >'.$presidente.'</td>
	<td width=""  colspan="3" class="borde" align="center">'.$cedula1.'</td>
</tr>
<tr>
	<td width=""  colspan="2" class="borde"><strong>SECRETARIO:</strong></td>
	<td width=""  colspan="5" class="borde" >'.$secretario.'</td>
	<td width=""  colspan="3" class="borde" align="center">'.$cedula2.'</td>
</tr>
<tr>
	<td width=""  colspan="2" class="borde"><strong>VOCAL:</strong></td>
	<td width=""  colspan="5" class="borde">'.$vocal.'</td>
	<td width=""  colspan="3" class="borde" align="center">'.$cedula3.'</strong></td>
</tr>
<tr>
	<td width=""  colspan="2" class="borde"><strong>SUPLENTE:</strong></td>
	<td width=""  colspan="5" class="borde">'.$suplente.'</td>
	<td width=""  colspan="3" class="borde" align="center">'.$cedulaSuplente.'</td>
</tr>

</table>

<table width="890px" border="0" class="Estilo5" style=" margin-top:20px;">
	<tr  style="background-color:#C0C0C0">
		<td align="center" width="888px" colspan="8" class="borde"><strong> DATOS DEL JURADO</strong></td>
	</tr>
	<tr>
		<td width="222px" colspan="2" class="borde"><strong>FECHA DE SOLICITUD</strong></td>
		<td width="222px" colspan="2" class="borde">'.$fechasolicitud.'</td>
		<td width="222px" colspan="2" class="borde"><strong>FECHA DEL EXAMEN</strong></td>
		<td width="222px" colspan="2" class="borde">'.$fechaExamenLetras.'</td>
	</tr>
	
	<tr>
		<td width="111px" colspan="" class="borde"><strong>HORA:</strong></td>
		<td width="111px" colspan="" class="borde">'.$hora.'</td>
		<td width="111px" colspan="" class="borde"><strong>DURACION:</strong></td>
		<td width="111px" colspan="" class="borde">'.$duracion.'</td>
		<td width="111px" colspan="" class="borde"><strong>OPORTUNIDAD:</strong></td>
		<td width="111px" colspan="" class="borde" align="center">1° ( X )</td>
		<td width="111px" colspan="" class="borde" align="center">2° (     )</td>
		<td width="111px" colspan="" class="borde" align="center">3° (     )</td>
	</tr>

</table>

<table width="890px" border="0" class="Estilo5" style=" margin-top:20px;">
	<tr  style="background-color:#C0C0C0">
		<td align="center" width="888px" colspan="8" class="borde"><strong>PARA USO EXCLUSIVO DE LA SECRETARIA DE EDUCACION <p>(DEPTO. DE SERVICIOS ESCOLARES Y BECAS)</p></strong></td>
	</tr>
	<tr>
		<td width="888px" class="Estilo6" colspan="8" class="borde"><em>(Documentos para efectos de tramite original y copia)</em></td>
	</tr>
	<tr>
		<td width="444px" colspan="4" class="borde">ACTA DE NACIMIENTO</td>
		<td width="444px" colspan="4" class="borde">GRADO DE MAESTRIA Y CEDULA (EN EL CASO DE DOCTORADO)</td>
	</tr>
	<tr>
		<td width="444px" colspan="4" class="borde">CEDULA PROFESIONAL</td>
		<td width="444px" colspan="4" class="borde">DICTAMEN DE LA OPCIÓN DE TITULACIÓN</td>
	</tr>
	
	<tr>
		<td width="444px" colspan="4" class="borde">CERTIFICADO DE LA MAESTRIA O DOCTORADO</td>
		<td width="444px" colspan="4" class="borde">REGISTRO DE FIRMAS DEL JURADO</td>
	</tr>
</table>

<table width="890px" border="0" class="Estilo5" style=" margin-top:20px;">
	<tr>
		<td width="444px" colspan="4" class="borde"><strong>No. DE AUTORIZACION DE EXAMEN PROFESIONAL:</strong></td>
		<td width="444px" colspan="4" align="center" class="borde">'.$autorizacion.'</td>
	</tr>
	<tr>
		<td width="444px" colspan="4" class="borde"><strong>FECHA DE AUTORIZACION:</strong></td>
		<td width="444px" colspan="4" align="center" class="borde">&nbsp;</td>
	</tr>
	
</table>

<table width="890px" border="0" class="Estilo5" style=" margin-top:20px;">
	<tr>
		<td width="444px" colspan="4" align="" class="borde"><strong>NOMBRE, FIRMA Y SELLO DEL DIRECTOR DE LA INSTITUCIÓN O DEL RESPONSABLE DE CONTROL ESCOLAR.</strong></td>
		<td width="444px" colspan="4" align="center" class="borde">LAE. FLORIBEL MEGCHUN DE LA CRUZ</td>
	</tr>

	
</table>	

<table width="890px" border="0" class="Estilo5" style="margin-top:30px;">
	<tr>
		<td width="111px"></td>
		<td width="111px"></td>
		<td width="111px"></td>
		<td width="111px"></td>
		<td width="111px"></td>
		<td width="111px"></td>
		<td width="111px"></td>
		<td width="111px"></td>
	</tr>
	<tr>
		<td align="center" width="444px" colspan="4"><strong>REVISO</strong></td>
		<td align="center" width="444px" colspan="4"><strong>AUTORIZO</strong></td>
	</tr>
	<tr>
		<td width="111px">&nbsp;</td>
		<td width="111px">&nbsp;</td>
		<td width="111px">&nbsp;</td>
		<td width="111px">&nbsp;</td>
		<td width="111px">&nbsp;</td>
		<td width="111px">&nbsp;</td>
		<td width="111px">&nbsp;</td>
		<td width="111px">&nbsp;</td>
	</tr>
	<tr>
		<td width="111px" >&nbsp;</td>
		<td align="center" width="222px" colspan="2" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom">&nbsp;</td>
		<td width="111px">&nbsp;</td>
		<td width="111px">&nbsp;</td>
		<td align="center" width="222px" colspan="2" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom">ING. JULIO MONTERO MEDEROS</td>
		<td width="111px">&nbsp;</td>
	</tr>
	<tr>
		<td align="center" width="444px" colspan="4"><strong>NOMBRE Y FIRMA</strong></td>
		<td align="center" width="444px" colspan="4"><strong>NOMBRE, FIRMA Y SELLO DE VALIDACION</strong></td>
	</tr>
	<tr>
		<td width="111px">&nbsp;</td>
		<td width="111px">&nbsp;</td>
		<td width="111px">&nbsp;</td>
		<td width="111px">&nbsp;</td>
		<td width="111px">&nbsp;</td>
		<td width="111px">&nbsp;</td>
		<td width="111px">&nbsp;</td>
		<td width="111px">&nbsp;</td>
	</tr>
		<tr>
		<td width="111px">&nbsp;</td>
		<td width="111px">&nbsp;</td>
		<td width="111px">&nbsp;</td>
		<td width="111px">&nbsp;</td>
		<td width="111px">&nbsp;</td>
		<td width="111px">&nbsp;</td>
		<td width="111px">&nbsp;</td>
		<td width="111px">&nbsp;</td>
	</tr>
	<tr>
		<td width="888px" colspan="8"><strong>NOTA:</strong> TODOS LOS DOCUMENTOS QUE SEAN DE OTRO ESTADO DEBERAN VENIR CERTIFICADOS POR LA SECRETARIA DE EDUCACION DEL MISMO ESTADO</td>
	</tr>	

</table>

</body>
</html>
</body>
</html>
';

       
        
        
        
        
    }
} else {
    $html = "Lo Sentimos No Se Pudo Realizar la Consulta";
}
//echo $html;
ob_start();
$mpdf=new mPDF('','','' , '','5', '5' , '5' , '5' , '5' , '5','P'); 
//$mpdf->AddPage('L', '', '', '', '', '', '', '', '', '', '');
$mpdf->WriteHTML($html);
$mpdf->Output("Reporte_VerPDFSecretaria_" . $today .".pdf" ,'I');

?> 

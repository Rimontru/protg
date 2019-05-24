<?php

require_once("../../../../../includes/Config.class.php");  # Cargar datos conexion y otras variables.
require_once('../../../../../includes/DB.class.php');
require_once('../../../../../includes/ConsultaDB.class.php');
require_once('../../../../../includes/MisFunciones.class.php');
require_once('../../../../../includes/ConvertirNumLetra.php');
require_once('../../../../../includes/DeNumero_a_Letras.php');
require_once('../../../../../mpdf/mpdf.php');


$Obras = new ConsultaDB;
$Funciones = new MisFunciones;
$today = date("d-m-Y");
$fechaServidor= date("Y");
//obtenemos fecha actual y cambiamos el formato de vista
//$fechaActual = strftime("%Y-%m-%d", time());
//$fechaActualModificar = explode("-", $fechaActual);
//$fechaActualLista = $fechaActualModificar[0] . "-" . $fechaActualModificar[1] . "-" . $fechaActualModificar[2];
//$fechaLetras = $Funciones->Fecha2Mayusculas($fechaActualLista);
//
//$fechaDividir = explode("DE", $fechaLetras);
//$fechaDia = $fechaDividir[0];
//$fechaMes = $fechaDividir[1];
//$fechaAnio = $fechaDividir[2];


if (isset($_GET['pk_alumno'])) {

    $fk_nivelestudio = $GET['fk_nivelestudio'];
    $pk_alumno = $_GET['pk_alumno'];
    $fk_modalidad=$_GET['fk_modalidad'];
	
    $modalidad =strtoupper( $_GET['modalidad']);

    //DATOS DE LA ESCUELA
    $Result32 = $Obras->ConsultaDatosInsitucionConEstados();
    if ($Result32) {
        $row333 = mysql_fetch_assoc($Result32);

        $nombreInstitucion = strtoupper($row333['nombreInstitucion']);
        $apodoInstitucion = strtoupper($row333['apodoInstitucion']);
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
        $lemaescuela =strtoupper( $row333['lemaEscuela']);
    }

    
    




    $result = $Obras->ConReporteDocumentacionAlumnosPorLlavePrimaria($pk_alumno);
    while ($row = mysql_fetch_assoc($result)) {


        $tomaprotestaLetras = $Funciones->Fecha2Mayusculas($row[FechaTomaProtesta]);
        $fechaLista = ($row[FechaTomaProtestaReporte]);

        //obtenemos fecha actual y cambiamos el formato de vista
        //$FechaTomaProtesta = strftime("%Y-%m-%d", time());
        $FechaTomaProtesta = $row['FechaTomaProtesta'];
        $FechaTomaProtestaModificar = explode("-", $FechaTomaProtesta);
        $FechaTomaProtestaLista = $FechaTomaProtestaModificar[0] . "-" . $FechaTomaProtestaModificar[1] . "-" . $FechaTomaProtestaModificar[2];
        $fechaLetras = $Funciones->Fecha2Mayusculas($FechaTomaProtestaLista);





        $fechaDividir = explode("DE", $fechaLetras);
        $fechaDia = convertir($fechaDividir[0]);
        $fechaMes = $fechaDividir[1];
        $fechaAnio = convertir($fechaDividir[2]);
        //$fechaAnioProtestaListo=substr($fechaAnio, -6); //Esto devuelve "ndo"
      // $fechaAnioProtestaListo=$fechaAnio;

$xxx = explode(" ", $fechaAnio);
$fechaAnioProtestaListo=$xxx[2];
 

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
        }else if ($row[TipoRevoe]=='3'){
            $fechaVigente="VIGENTE";
        }else if($row[TipoRevoe]=='0'){
           $fechaVigente="COLOCAR FECHA/VIGENTE";
	}
        
         $apaterno = strtoupper($row[ApaternoAlumno]);
         $amaterno=strtoupper($row[AmaternoAlumno]);
         $nombre= strtoupper($row[NombreAlumno]);
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
         
         
         
         
////FECHA DE SOLICITUD $fechasolicitud
//$fechasolicitud = $row[FechaSolicitud];
////FECHA EXAMEN 
$FechaExamen= $row[FechaExamen];
////TOMA DE PROTESTA 
//$fechaLista= $row[FechaTomaProtestaReporte];

$autorizacion = mb_strtoupper($row[NumeroAutorizacion]);
$folioActa = $row[FolioActa];
$titulo = mb_strtoupper($row[nombreTitulo],'UTF-8');         
$salonListo=$row[salon];
            


//HORA
$hora =$row[hora];
$horaDividir = explode(":",$hora);
$horaHora=$horaDividir[0];
$horaMinuto = $horaDividir[1];


$horaListo = convertir($horaHora);
$horaMinutoListo = convertir($horaMinuto);
$hora =$horaListo." ".$horaMinutoListo;

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
$turno=strtoupper($row[NombreTurno]);

$NumAutorizacion=substr($autorizacion, -4); //Esto devuelve "ndo"
$nombreTesis=$row[nombreTesis];

$xxx = explode(" ", $noacuerdo);
$rvoe0=$xxx[0];
$rvoe1=$xxx[1];
$rvoe2=$xxx[2];
$rvoe3=$xxx[3];
$rvoe4=$xxx[4];

 $noActaExamen=$row[noActaExamen];
	
		
  

$html = ' 
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">

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
	border-collapse: collapse;
	border-spacing: 0;
}
table tr td {
	padding-bottom:2px;
	padding-top:2px;}
.Estilo1{
	font-family:calibri;
	font-size:12px;
	font-weight:bold;}
.Estilo2{
	font-family:calibri;
	font-size:22px;}
.Estilo3{
	font-family:calibri;
	font-size:14px;
	font-weight:bold;}	
.Estilo4{
	font-family:calibri;
	font-size:18px;
	font-weight:bold;}	

</style>
</head>

<body>
<div class="logo" style="position: absolute; left:269px; top: 942px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="250" height="1" /></div></left>

<div class="logo" style="position: absolute; left: 65px; top: 70px;">

		<img src="../../../../../assets/img/escudo.gif" width="74" height="70" />
	</div>

	<div class="Estilo12" style="font-family:arial; position: absolute; left: 622px; top: 85px;">FOLIO:<strong class="Estilo3">&nbsp; <span  style="color:red;">'.$folioActa.'</span> 
	</div>

	<div class="logo" style="position: absolute; left: 50px; top: 320px;">
		<img src="../../../../../assets/img/foto_maestria.png" width="100" height="100" />
	</div>


<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td class="Estilo1" align="right">AEG-16-'.$fechaServidor.' </td>
	</tr>
</table>

<table width="100%" style="border:1px solid #000;" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="10" align="center" class="Estilo2">GOBIERNO DEL ESTADO DE CHIAPAS</td>
	</tr>
	<tr>
		<td colspan="10" align="center" class="Estilo3">SECRETARÍA DE EDUCACIÓN</td>
	</tr>
	<tr>
		<td colspan="10" align="center" class="Estilo3">SUBSECRETARÍA DE EDUCACIÓN ESTATAL</td>
	</tr>
	<tr>
		<td colspan="10" align="center" class="Estilo3">DIRECCIÓN DE EDUCACIÓN SUPERIOR</td>
	</tr>
	<tr>
		<td colspan="10" align="center" class="Estilo3">DEPARTAMENTO DE SERVICIOS ESCOLARES Y BECAS</td>
	</tr>
	<tr>
		<td colspan="10" align="center" class="Estilo3">INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS</td>
	</tr>
	<tr>
		<td colspan="5" width="" align="right" class="Estilo3" >RVOE: '. $noacuerdo  .  '  </td>
		<td colspan="5" width="" align="" style="padding-left:10px;"  class="Estilo3"> '  .  $fechaVigente.' : '.$fechaExpedicion.'</td>
	</tr>
	<tr>
		<td colspan="10" align="center" class="Estilo3">RÉGIMEN PARTICULAR</td>
	</tr>
	<tr style="border:1px solid #000;">
            <td  style="padding:7px; border-right:1px solid #000;" colspan="5" align="center" class="Estilo3">ACTA DE EXAMEN DE GRADO N°. '.  $noActaExamen.'</td>
	    <td style="padding:7px;" colspan="5" align="center" class="Estilo3">N° DE AUTORIZACIÓN: '  .  $autorizacion.'</td>
	</tr>

</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="Estilo4">
	<tr>
		<td width="90" height="0">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="90">&nbsp;</td>
		<td width="125">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
	</tr>
	<tr>
		<td width="70" height="0">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="165">EN LA CIUDAD DE:</td>
		<td width="" colspan="6" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom; padding-left:5px;">TUXTLA GUTI&Eacute;RREZ, CHIAPAS.</td>
	</tr>
	<tr>
		<td width="70" height="17">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">SIENDO LAS:</td>
		<td width="" colspan="2" width="50" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom">'.$hora.'</td>
		<td width="145">HORAS DEL DIA:</td>
		<td width="" colspan="3" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom;padding-left:5px">'.$fechaDia.'</td>
	</tr>
	<tr>
		<td width="70" height="17">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">DEL MES DE:</td>
		<td width="" colspan="2" width="50" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom">'.$fechaMes.'</td>
		<td width="100">DEL DOS MIL</td>
		<td width="" colspan="3" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom">'.$fechaAnioProtestaListo.'</td>
	</tr>
	<tr>
		<td width="70" height="0">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="125">EN EL SALÓN:</td>
		<td width="" colspan="6" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom">'.$salonListo.'</td>
	</tr>
	<tr>
		<td width="70" height="0">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td colspan="7" width="">DEL &nbsp;<span style="font-family:arial; font-weight:normal;">'.$nombreInstitucion.'</span></td>
	</tr>
	
	<tr>
		<td width="70" height="0">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		
		';
//Condiciones Para diferentes modalidades
 
		if($modalidad=="SEMIESCOLARIZADA"){
			
		$html.='<td colspan="7" width="125" style="font-size:16px">CON CLAVE: 07PSU0002D, TURNO:<u>'.$turno.',</u> MODALIDAD: '.$modalidad.', SE REUNIÓ EL JURADO</td>';

		}
		elseif($modalidad=="ESCOLAR"){

			
		$html.='<td colspan="7" width="125" style="font-size:16px">CON CLAVE: 07PSU0002D, TURNO:<u>'.$turno.',</u> MODALIDAD: '.$modalidad.', SE REUNIÓ EL JURADO</td>';
		
		}
		elseif($modalidad=="NO ESCOLARIZADA"){

			
		$html.='<td colspan="7" width="125" style="font-size:16px">CON CLAVE: 07PSU0002D, TURNO:<u>'.$turno.',</u> MODALIDAD: '.$modalidad.', SE REUNIÓ EL JURADO</td>';
		
		}elseif($modalidad=="ESCOLARIZADA"){

			
		$html.='<td colspan="7" width="125" style="font-size:16px">CON CLAVE: 07PSU0002D, TURNO:<u>'.$turno.',</u> MODALIDAD: '.$modalidad.', SE REUNIÓ EL JURADO</td>';
		
		}elseif($modalidad=="MIXTA"){

			
		$html.='<td colspan="7" width="125" style="font-size:16px">CON CLAVE: 07PSU0002D, TURNO:<u>'.$turno.',</u> MODALIDAD: '.$modalidad.', SE REUNIÓ EL JURADO</td>';
		
		}elseif($modalidad==""){

			
		$html.='<td colspan="7" width="125" style="font-size:18px">CON CLAVE: 07PSU0002D, TURNO:<u>'.$turno.',</u> SE REUNIÓ EL JURADO</td>';
		}


		
	$html.='</tr>
	<tr>
		<td width="70" height="0">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td colspan="7" width="125">INTEGRADO POR LOS C. C:</td>
		
	</tr>
	<tr>
		<td width="70" height="0">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="125">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
	</tr>
	<tr>
		<td width="70" height="0">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="125">PRESIDENTE:</td>
		<td width="" colspan="6" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom">&nbsp;'.$presidente.'</td>
	</tr>
	<tr>
		<td width="70" height="0">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="125">SECRETARIO:</td>
		<td width="" colspan="6" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom">&nbsp;'.$secretario.'</td>
	</tr>
	<tr>
		<td width="70" height="0">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="125">VOCAL:</td>
		<td width="" colspan="6" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom">&nbsp;'.$vocal.'</td>
	</tr>
	<tr>
		<td width="70" height="0">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td colspan="7" width="125">PARA REALIZAR EL EXAMEN DE GRADO DEL (DE LA) C.</td>
	</tr>
	<tr>
		<td width="70" height="0">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="125" align="center" colspan="7" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom;font-weight:normal;">&nbsp;'.$nombre.' '.$apaterno.' '.$amaterno.'</td>
	</tr>
	<tr>
		<td width="70" height="0">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="125">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3" width="80" height="0">CON NÚMERO DE CONTROL:</td>
		<td width="100" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom;font-weight:normal;" align="center">'.$matricula.'</td>
		<td width="250" colspan="6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A QUIEN SE EXAMINÓ CON BASE A LA OPCIÓN:</td>
	</tr>
	<tr>
		<td width="70" height="0">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="125">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
	</tr>
	<tr>
		<td width="" height="" align="center" colspan="10" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom;font-weight:normal;">';
		
		
		if($opcionTitulacion=="PROMEDIO GENERAL DE CALIFICACIONES")
	{
			
	$html.='POR PROMEDIO';
	}else{
		$html.=''.$opcionTitulacion.'';
		}
		
		$html.='</td>
	</tr>
	<tr>
		<td width="" height="" align="" colspan="10" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom;font-weight:normal;">';
		
	if($opcionTitulacion=="PROMEDIO GENERAL DE CALIFICACIONES")
	{
			
	$html.="&nbsp;";	}else
		
	if($opcionTitulacion=="ESTUDIOS DE POSGRADO (50% DE DOCTORADO)")
	{
			
	$html.="&nbsp;";
	}else{
		$html.=''.$nombreTesis.'';
		}
	
	$html.='</td>
	</tr>
	<tr>
		<td width="" colspan="4">PARA OBTENER EL GRADO ACADÉMICO DE:</td>
		<td colspan="6" align="" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom;font-weight:normal;">'.$titulo.'</td>
	</tr>
	<tr>
		<td colspan="10" align="center" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom;font-weight:normal;">&nbsp;</td>
	</tr>
	<tr>
		<td width="70" height="0">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="125">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
	</tr>
	<tr>
		<td align="justify" colspan="10" width="">SE PROCEDIÓ A EFECTUAR EL ACTO DE ACUERDO A LAS NORMAS ESTABLECIDAS POR LA DIRECCIÓN DE EDUCACIÓN SUPERIOR DE LA SUBSECRETARIA DE EDUCACIÓN ESTATAL, UNA VEZ CONCLUIDO EL EXAMEN, EL JURADO DELIBERÓ SOBRE LOS CONOCIMIENTOS Y APTITUDES DEMOSTRADAS Y DETERMINÓ:</td>
	</tr>
	<tr>
		<td width="70" height="0">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="125">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="10" align="center" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom;font-weight:normal;">APROBARLO</td>
	</tr>
	<tr>
		<td align="justify" colspan="10" width="">A CONTINUACIÓN EL PRESIDENTE DEL JURADO COMUNICÓ AL (A LA) C. SUSTENTANTE EL RESULTADO OBTENIDO Y LE TOMÓ LA PROTESTA DE LEY, EN LOS TÉRMINOS SIGUIENTES:</td>
	</tr>
	<tr>
		<td width="70" height="0">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="125">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
	</tr>
	<tr>
		<td align="justify" colspan="4" width="">¿PROTESTA USTED EJERCER SU GRADO DE</td>
		<td colspan="6" width="" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom;font-weight:normal;font-size:17px;">'.$titulo.'</td>
	</tr>
	<tr>
		<td colspan="10" align="justify">CON ENTUSIASMO Y HONRADEZ, VELAR SIEMPRE POR EL PRESTIGIO Y BUEN NOMBRE DE ESTA ESCUELA Y CONTINUAR ESFORZÁNDOSE POR MEJORAR SU PREPARACIÓN EN TODOS LOS ÓRDENES, PARA GARANTIZAR LOS INTERESES DEL PUEBLO Y DE LA PATRIA?</td>
	</tr>
	<tr>
		<td width="70" height="0">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="125">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
	</tr>

	<tr>
		<td width="70" height="0">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="125">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
	</tr>
	<tr>
		<td align="center" width="" colspan="10">¡SI PROTESTO!</td>
	</tr>
		<tr>
		<td width="70" height="0">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="125">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
	</tr>

	<tr>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="50">&nbsp;</td>
		<td width="310" colspan="2" style="">&nbsp;</td>
		<td width="20">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
	</tr>
	<tr>

		<td align="center" width="200" colspan="10" style="font-weight:normal;">'.$nombre.'  '.$apaterno.' '.$amaterno.'</td>
		
	</tr>
	<tr>
		<td width="70" height="0">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="125">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
	</tr>
	<tr>
		<td width="70" height="0">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="125">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
	</tr>

	<tr>
		<td width="" align="center" colspan="10">SI ASÍ LO HICIERE QUE LA SOCIEDAD Y LA NACIÓN SE LO PREMIEN Y SI NO, SE LO DEMANDEN.</td>
	</tr>
	
	
	
	
		
</table>





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
$mpdf->Output("Reporte_VerActaExamen_Frente_Maestria" . $today .".pdf", 'I');

?>

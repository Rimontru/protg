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


    $fk_nivelestudio = $GET['fk_nivelestudio'];
    $pk_alumno = $_GET['pk_alumno'];
	$fk_modalidad=$_GET['fk_modalidad'];
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

}
table tr td {
	padding-bottom:0px;
	padding-top:0px;}
.Estilo1{
	font-family:calibri;
	font-size:13px;
	font-weight:bold;
	text-align:justify;}
.Estilo2{
	font-family:calibri;
	font-size:22px;}
.Estilo3{
	font-family:calibri;
	font-size:14px;
	font-weight:bold;}	
.Estilo4{
	font-family:calibri;
	font-size:15px;
	font-weight:bold;}
.Estilo5{
	font-family:calibri;
	font-size:12px;
	text-align:center;
}
.Estilo6{
	font-family:calibri;
	font-size:12px;
	text-align:justify;
}
.Estilo7{
	font-family:calibri;
	font-size:13px;
	text-align:justify;
}
.Estilo8{
	font-family:calibri;
	font-size:12px;
	text-align:justify;
}

.Estilo9{
	font-family:calibri;
	font-size:11px;
	font-weight:bold;
	text-align:justify;}
	




</style>
</head>

<body>

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="Estilo4">
	<tr>
		<td class="Estilo1" colspan="10">TERMINADO EL ACTO, SE LEVANTA PARA CONSTANCIA, LA PRESENTE ACTA FIRMANDO DE CONFORMIDAD LOS INTEGRANTES DEL JURADO Y EL DIRECTOR DEL PLANTEL QUE DA FÉ.</td>
	</tr>
		<tr>
		<td width="70" height="0">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
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
		<td class="Estilo1" align="center" colspan="4" width="" height="0" style="font-weight:normal;"><u>JURADO DEL EXAMEN</u></td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
	</tr>
	<tr>
		<td width="70" height="0">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
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
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
	</tr>
	<tr>
		<td class="Estilo1" align="center" colspan="4" width="" height="0" style="font-weight:normal;"><u>NOMBRE:</u></td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td class="Estilo1" align="center" colspan="4" width="" height="0" style="font-weight:normal;"><u>FIRMA:</u></td>
	</tr>
	
	<tr>
		<td width="70" height="0">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
	</tr>
	<tr>
		<td class="Estilo9"  colspan="4" width="" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom; font-weight:normal;">'.$presidente.'</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td class="Estilo1" align="center" colspan="4" width="" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom">&nbsp;</td>
	</tr>
		<tr>
		<td class="Estilo1"  colspan="4" width="">PRESIDENTE.</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td class="Estilo1" align="right" colspan="4" width="">CÉDULA PROF. N°. '.$cedula1.'</td>
	</tr>
		<tr>
		<td width="70" height="0">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
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
		<td width="70">&nbsp;</td>
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
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
	</tr>
	<tr>
		<td class="Estilo9"  colspan="4" width="" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom; font-weight:normal;">'.$secretario.'</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td class="Estilo1" align="center" colspan="4" width="" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom">&nbsp;</td>
	</tr>
		<tr>
		<td class="Estilo1"  colspan="4" width="">SECRETARIO.</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td class="Estilo1" align="right" colspan="4" width="">CÉDULA PROF. N°. '.$cedula2.'</td>
	</tr>
			<tr>
		<td width="70" height="0">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
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
		<td width="70">&nbsp;</td>
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
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
	</tr>
	<tr>
		<td class="Estilo9"  colspan="4" width="" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom; font-weight:normal;">'.$vocal.'</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td class="Estilo1" align="center" colspan="4" width="" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom">&nbsp;</td>
	</tr>
		<tr>
		<td class="Estilo1"  colspan="4" width="">VOCAL.</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td class="Estilo1" align="right" colspan="4" width="">CÉDULA PROF. N°. '.$cedula3.'</td>
	</tr>
			<tr>
		<td width="70" height="0">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
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
		<td width="70">&nbsp;</td>
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
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
	</tr>
	<tr>
		<td class="Estilo1" align="center" colspan="10" width="" height="0">EL DIRECTOR DEL PLANTEL</td>
	</tr>
	<tr>
		<td width="70" height="0">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
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
		<td class="Estilo1" align="center" colspan="4" width="" height="0" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
	</tr>
	
	<tr>
		<td width="70" height="0">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td class="Estilo1" align="center" colspan="4" width="" height="0" >ING. Y MTRO. FILEMÓN CORZO NAÑEZ</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
	</tr>
	<tr>
		<td width="70" height="0">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
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
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
	</tr>
	<tr>
		<td class="Estilo1" align="center"  colspan="4" width="">JEFE DEL DEPARTAMENTO DE <br>SERVICIOS ESCOLARES Y BECAS</br></td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td class="Estilo1" align="center" colspan="4" width="">DIRECTOR DE EDUCACIÓN SUPERIOR</td>
	</tr>
	<tr>
		<td width="70" height="0">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
	</tr>
	<tr>
		<td class="Estilo1"  colspan="4" width="" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom;">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td class="Estilo1" align="center" colspan="4" width="" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom">&nbsp;</td>
	</tr>
	<tr>
		<td class="Estilo1" align="center"  colspan="4" width="">ING. JULIO MONTERO MEDEROS</br></td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td class="Estilo1" align="center" colspan="4" width="">MTRO. BISSAEL PIMENTEL AVENDAÑO</td>
	</tr>
	<tr>
		<td width="70" height="0">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
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
		<td width="70">&nbsp;</td>
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
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
	</tr>

    
    <tr>
		<td height="20px" rowspan="0" colspan="3" style="border-top:2px solid #000;border-left:2px solid #000; border-right:2px solid #000;font-weight:normal; line-weight:24px;" class="Estilo5">REGISTRADO EN EL</td>
		<td width="70">&nbsp;</td>
		<td class="Estilo7" style="font-weight:normal;text-align:justify;" width="70" rowspan="3" colspan="6">POR ACUERDO DEL SECRETARIO GENERAL DE GOBIERNO Y CON FUNDAMENTO EN EL ART. 28, FRACCIÓN X, DE LA LEY ORGÁNICA DE LA ADMINISTRACIÓN PÚBLICA DEL ESTADO DE CHIAPAS.</td>

    </tr>
	<tr>
		<td height="20px" rowspan="0" colspan="3" style="border-left:2px solid #000; border-right:2px solid #000; font-weight:normal;" class="Estilo5">DEPARTAMENTO DE SERVICIOS</td>
    </tr>
	<tr>
		<td rowspan="0" colspan="3" style="border-bottom:2px solid #000;border-left:2px solid #000; border-right:2px solid #000; font-weight:normal; line-weight:24px;" class="Estilo5">ESCOLARES Y BECAS</td>
    </tr>
	
	<tr>
		<td height="20px" rowspan=""colspan="" height="10px" style="border-left:2px solid #000;font-weight:normal;  text-align:left;" class="Estilo5">CON N°.
	    </td>
		<td width="70" colspan="2" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom; border-right:2px solid #000;">&nbsp;</td>

     </tr>
	<tr>
		<td rowspan=""colspan="" height="10px" style="border-left:2px solid #000;font-weight:normal;  text-align:left;" class="Estilo5">EN EL LIBRO:
	    </td>
		<td width="70" colspan="2" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom; border-right:2px solid #000;">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td class="Estilo7" style="font-weight:normal;text-align:justify;" width="70" rowspan="3" colspan="6">SE LEGALIZA, <span class="Estilo8">previo cotejo con la que existe en el control respectivo, la firma que antecede, corresponde al Director de Educación Superior.</span><br/><span class="Estilo8" style="font-weight:bold;">MTRO. BISSAEL PIMENTEL AVENDAÑO</span> </td>

     </tr>
	<tr>
		<td rowspan=""colspan="" height="10px" style="border-left:2px solid #000;font-weight:normal;  text-align:left;" class="Estilo5">FOJA:</td>
		<td width="70" colspan="2" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom; border-right:2px solid #000;">&nbsp;</td>

     </tr>
	<tr>
		<td rowspan=""colspan="" height="10px" style="border-left:2px solid #000;font-weight:normal;  text-align:left;  border-bottom:2px solid #000;" class="Estilo5">FECHA:</td>
		<td width="70" colspan="2" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom; border-right:2px solid #000; border-bottom:2px solid #000;">&nbsp;</td>

     </tr>
	  <tr>
		<td height="20px" rowspan="0" colspan="3" style="border-bottom:2px solid #000;border-left:2px solid #000; border-right:2px solid #000;" class="Estilo5"><center>COTEJO</center></td>
    </tr>
	
	<tr>
		<td rowspan="3" colspan="3"  style="border-bottom:2px solid #000;border-left:2px solid #000; border-right:2px solid #000;">&nbsp;</td>	
		<td width="70">&nbsp;</td>
		<td class="Estilo7" style="font-weight:normal;text-align:justify;" width="70" rowspan="0" colspan="3" >Tuxtla Gutiérrez, Chiapas; a</td>
		<td colspan="3" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom;">&nbsp;</td>

	</tr>
	<tr>
		<td width="70">&nbsp;</td>
	</tr>
	<tr>
		<td width="70">&nbsp;</td>
	</tr>	
	<tr>
		<td height="20px" rowspan="0" colspan="3" style="border-bottom:2px solid #000;border-left:2px solid #000; border-right:2px solid #000; font-weight:normal;" class="Estilo5"><center>JEFE DE LA OFICINA</center></td>
                <td width="70">&nbsp;</td>
		<td class="Estilo7" style="text-align:center;" width="70" rowspan="0" colspan="6" >SUBSECRETARIO DE ASUNTOS JURÍDICOS</td>
    </tr>
	
	<tr>
		<td rowspan="3" colspan="3"  style="border-bottom:2px solid #000;border-left:2px solid #000; border-right:2px solid #000;">&nbsp;</td>	
		<td width="70">&nbsp;</td>
		<td class="Estilo7" style="font-weight:normal;text-align:justify;" width="70" rowspan="0" colspan="3" >&nbsp;</td>
		<td colspan="3">&nbsp;</td>

	</tr>
	<tr>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70"colspan="4" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom;" >&nbsp;</td>
		<td width="70" colspan="" >&nbsp;</td>	
	</tr>
	<tr>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70"colspan="4"  class="Estilo5" align="center" >LIC. JOSE RAMON CANCINO IBARRA</td>
		<td width="70" colspan="" >&nbsp;</td>		
	</tr>
	<tr>
		<td width="70" height="0">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
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
		<td width="70">&nbsp;</td>
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
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="70">&nbsp;</td>
	</tr>	
	<tr>
		<td width="" align="center" style="font-weight:normal;" class="Estilo6" colspan="10" height="0">Este documento NO es válido si presenta raspaduras o enmendaduras</td>
		
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
$mpdf=new mPDF('','','' , '','5', '15' , '10' , '5' , '5' , '5','P'); 
//$mpdf->AddPage('L', '', '', '', '', '', '', '', '', '', '');
$mpdf->WriteHTML($html);
$mpdf->Output("ActaExamen_Atras_Maestria" . $today .".pdf", 'I');

?> 
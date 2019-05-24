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
   
   
           $fechaDividir = explode("DE", $fechaLetras);
        $fechaDia = convertir($fechaDividir[0]);
        $fechaMes = $fechaDividir[1];
        $fechaAnio = convertir($fechaDividir[2]);
        //$fechaAnioProtestaListo=substr($fechaAnio, -6); //Esto devuelve "ndo"
      // $fechaAnioProtestaListo=$fechaAnio;

$xxx = explode(" ", $fechaAnio);
$fechaAnioProtestaListo=$xxx[2];

$fechaanio=strtolower($fechaAnioProtestaListo);            
$fechaDia =strtolower($fechaDia);            
$fechaMes =strtolower($fechaMes);            
            
$expe=$row[fechaexpediciontitulo];            
            
            
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
 

//$opcionTitulacion=strtoupper($row[NombreOpcionTitulacion]);

$titulo=strtolower_ga($row[nombreTitulo]);
$titulo=explode(" ",$titulo);
$titulo0=$titulo[0];
$titulo1=$titulo[1];
$titulo2=$titulo[2];
$titulo3=$titulo[3];
$titulo4=$titulo[4];
$titulo5=$titulo[5];
$titulo6=$titulo[6];
$titulo7=$titulo[7];
$titulo8=$titulo[8];
$titulo9=$titulo[9];
$titulo10=$titulo[10];
$titulo11=$titulo[11];
$titulo12=$titulo[12];
$titulo13=$titulo[13];

$tituloCompemento=$titulo1 ." ". $titulo2 ." ". $titulo3 ." ". $titulo4 ." ". $titulo5 ." ". $titulo6 ." ". $titulo7 ." ". $titulo8 ." ". $titulo9 ." ". $titulo10 ." ". $titulo11 ." ". $titulo12 ." ". $titulo13;
//
//    $fechaActual = strftime("%Y-%m-%d", time());
//
//    $fechaActualModificar = explode("-", $fechaActual);
//    $fechaActualLista = $fechaActualModificar[0] . "-" . $fechaActualModificar[1] . "-" . $fechaActualModificar[2];
//
//    $fechaLetras = fechaATexto($fechaActualLista, 'u'); // Devuelve '10 DE AGOSTO DE 1981'
//
//        $fechaDividir = explode("DE", $fechaLetras);
//        $fechaDia = $fechaDividir[0];
//        $fechaMes = $fechaDividir[1];
//        $fechaAnio = $fechaDividir[2];
//        
//        
//
//        $fechaDia = strtolower(convertir($fechaDia));
//        $fechaMes = strtolower($fechaMes);
//        $fechaAnio = strtolower(convertir($fechaAnio));
//        
//
//$fechaDividir = explode("DE", $fechaLetras);
//$fechaDiaProtesta = convertir($fechaDividir[0]);
//$fechaMesProtesta=$fechaDividir[1];
//$fechaAnioProtesta=convertir($fechaDividir[2]);
//    $fechaAnioProtestaListo=substr($fechaAnioProtesta, -5); //Esto devuelve "ndo" 

//$NombreTituloShido = ucwords(strtolower($nombreTitulo));    
   
  //comparamos el salon

     if(is_numeric ($salon)==true){
         
         $salonListo=$salon;
     }else{
         $salonListo="DE ".$salon;
         
     }
    
    $html = ' 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" media="print,screen" />
<link href="../cssTitulo.css" rel="stylesheet" type="text/css"  />
<style type="text/css">

html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
caption, tbody, tfoot, thead, th, 
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
	font-family:Vladimir;
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

root { 
    display: block;
}

.Estilo5 {
	font-size: 20px
	}
.Estilo11 {
	font-size: 22px; 
	font-weight: bold; 
	}
.fuente_titulo {
	font-family: Vivaldi;
	font-size: 35px;
	
}
.fuente_titulo1 {
	font-family: Vivaldi;
	font-size: 37px;
}
.cuerpo_titulo {
	font-family: Vladimir Script;
	font-size: 34.5px;
	word-spacing:5px;
	line-height:40px;
}
.nombre_sustentante {
	font-family: Algerian;
	font-size: 30px; 
	font-weight: bold;
}
.grado {
	font-family: Brush Script MT;
	font-size: 34px; 
}

.firma {
	font-family: Vivaldi;
	font-size: 25px;
        text-align:left
}

.secret {
	font-family: Times New Roman, Times, serif;
}
.instituto {
	font-family: Times New Roman, Times, serif;
	font-size: 20px;
}
.registro_pie {
	font-family: Vladimir Script;
	font-size: 20px;
}
.folio_tit {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 20px;
}
.folio_tit strong {
	color: #F00;
}
.pie_pag {
	font-family: Freestyle Script;
	font-size: 10px;
}
</style>


</head>

<body>
<div class="logo" style="position: absolute; left: 15px; top: 340px;"><img src="../../../../../assets/img/foto.png" width="155" height="218" /></div>

<div class="logo" style="position: absolute; left: 350px; top: 382px; opacity:0.25;"><img src="../../../../../assets/img/EscudoMexicano.png" width="350" /></div>

<table width="960px" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td width="" height="" colspan="10"  >
      <center class="">
        <div align="" class=""><img src="../../../../../assets/img/escudo_chiapas_titulo.png" width="147" height="194" /></div>
      </center>
	</td>
  </tr>
  <tr>
  	<td width="175">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
  </tr>
  <tr>
  	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
  </tr>
  
  <tr style="font-weight:bold">
	<td width="">&nbsp;</td>
	<td width="" colspan="8" align="center" class="fuente_titulo">El Gobernador Constitucional <br/> del Estado Libre y Soberano de Chiapas</td>
	<td width="65">&nbsp;</td>

  </tr>
  <tr>
  	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
  </tr>
  <tr>
  	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
  </tr>
  <tr>
	<td width="0">&nbsp;</td>
	<td width="" style="padding-left:30px;" colspan="8" align="justify" class="cuerpo_titulo">en uso de las facultades que le confiere el Articulo 44, Fraccion <span style="font-family:Arial; font-size:24px;">XV</span> de la Constitucion Política local y el Articulo 12 de la Ley de Educación Pública del Estado, otorga a</td>
		<td width="0">&nbsp;</td>
  </tr>

</table>

<table width="960px" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
  	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
  </tr>
  <tr>
  	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
  </tr>
  <tr>
	<td width="">&nbsp;</td>
	<td width="" colspan="8" align="center" class="nombre_sustentante">'.$nombre.' '.$apaterno.' '.$amaterno.'</td>					
	<td width="65px">&nbsp;</td>
 </tr>
  <tr>
  	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
  </tr>
    <tr>
  	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
  </tr>
  <tr>
	<td width="">&nbsp;</td>
	<td width="" colspan="8" align="center" class="cuerpo_titulo">el <span class="grado">Grado</span> de</td>					
	<td width="65px">&nbsp;</td>
 </tr>
   <tr>
  	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
  </tr>
<tr style="font-weight:bold">
	<td width="">&nbsp;</td>
	<td width="" colspan="8" align="center" class="fuente_titulo1">'.$titulo0.' <br> '.$tituloCompemento.'</td>					
	<td width="65px">&nbsp;</td>
 </tr>
    <tr>
  	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
  <tr>
  
    <tr>
	<td width="0">&nbsp;</td>
	<td width="" style="padding-left:30px;" colspan="8" align="justify" class="cuerpo_titulo">En atención a que comprobo haber terminado los estudios requeridos conforme al plan de estudios y programas en vigor y haber sido aprobado ( a ) en el examén de grado reglamentario en el ( a )</td>
		<td width="0">&nbsp;</td>
  </tr>
     <tr>
  	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
  </tr>
  <tr style="font-weight:bold">
	<td width="">&nbsp;</td>
	<td width="" colspan="8" align="center" class="fuente_titulo"><strong>Instituto de Estudios Superiores de Chiapas </br>ubicado en esta ciudad.</strong></td>					
	<td width="65px">&nbsp;</td>
 </tr>
      <tr>
  	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
  </tr>
      <tr>
	<td width="175" colspan="" class="firma" style="border-top:1px solid #000;text-align:center;">Firma del interesado</td>
	<td width="" colspan="8" align="justify" class="cuerpo_titulo" style="padding-left:30px;">Dado en el Palacio del Poder Ejecutivo, en la ciudad de Tuxtla Gutierrez, Chiapas; a los '.$fechaDia.' días del mes de '.$fechaMes.' del año dos mil '.$fechaanio.'.</td>
		<td width="0">&nbsp;</td>
  </tr>
        <tr>
  	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
  </tr>        
  <tr>
  	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
  </tr>  <tr>
  	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
  </tr>
  
    <tr style="font-weight:bold">
	<td width="">&nbsp;</td>
	<td width="" colspan="8" align="center" class="fuente_titulo">Sufragio efectivo. No reelección</td>					
	<td width="65px">&nbsp;</td>
 </tr>
 
   </tr>
        <tr>
  	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
  </tr>        
  <tr>
  	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
  </tr>  <tr>
  	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
  </tr>
    <tr>
  	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
  </tr>
    <tr>
  	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
  </tr>
  
    <tr style="font-weight:bold">
	<td width="105px">&nbsp;</td>
	<td width="105px">&nbsp;</td>
	<td width="" colspan="5" align="center" class="fuente_titulo" style="border-top:1px solid #000;text-align:center;">Manuel Velasco Coello</td>					
	<td width="105px">&nbsp;</td>
 </tr>
 
  

</table>

 
</table>
</body>
</html>
';

    
        
        
        
        
    }
} else {
    $html = "Lo Sentimos No Se Pudo Realizar la Consulta";
}
echo $html;
//ob_start();
//$mpdf=new mPDF('c','Legal','',''); 
//$mpdf->AddPage('P', '', '', '', '', '', '', '', '', '', '');
//$mpdf->WriteHTML($html);
//$mpdf->Output("Reporte_VerTitulo_Frente_" . $today, 'D');

?> 
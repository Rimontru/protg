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

$NumAutorizacion=substr($autorizacion, -4); //Esto devuelve "ndo"







 $html = '
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
body{
	font-family:;
	}
.Estilo2 {font-size: 20px}
.Estilo3 {
	font-size: 20px;
	font-weight: bold;
}

.Estilo4 {
	font-size: 14px;
	font-weight: bold;
}
.Estilo41{
        font-size: 12px;
	font-weight: bold;
}
.Estilo51 {
	font-size: 15px;
}
.Estilo5 {
	font-size: 17px;
	font-weight: bold;
}
.Estilo15 {
	font-size: 18px;
	font-weight: bold;
}
.Estilo6 {
	font-size: 19px;
}

.Estilo16 {font-size: 18px}
.Estilo19 {font-size: 14px}
.fojas{font-size: 15px}
.estilo0{font-size: 15px}
-->
</style>
</head>

<body>

<table width="960" border="0"  cellpadding="-2" cellspacing="-2" style=" font-size:18px;border-collapse: collapse;">

<tr>
	<td colspan="10" style="text-align:justify">EL QUE SUSCRIBE <strong>DR. LUIS MADRIGAL FRÍAS,</strong> DIRECTOR DE EDUCACIÓN SUPERIOR, CERTIFICO QUE EL PRESENTE FORMATO QUE CONSTA EN EL ANVERSO Y REVERSO, ES EL QUE UTILIZARÁ PARA LA EXPEDICIÓN DEL ACTA DE EXAMEN PROFESIONAL POR EXCELENCIA ACADÉMICA, DEL INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS.</td>

</tr>

<tr>
	<td width="96">&nbsp;</td>
	<td width="96">&nbsp;</td>
        <td width="96">&nbsp;</td>
        <td width="96">&nbsp;</td>
        <td width="96">&nbsp;</td>
        <td width="96">&nbsp;</td>
        <td width="96">&nbsp;</td>
        <td width="96">&nbsp;</td>
        <td width="96">&nbsp;</td>
        <td width="96">&nbsp;</td>
</tr>
<tr>
	<td width="96">&nbsp;</td>
	<td width="96">&nbsp;</td>
        <td width="96">&nbsp;</td>
        <td width="96">&nbsp;</td>
        <td width="96">&nbsp;</td>
        <td width="96">&nbsp;</td>
        <td width="96">&nbsp;</td>
        <td width="96">&nbsp;</td>
        <td width="96">&nbsp;</td>
        <td width="96">&nbsp;</td>
</tr>
<tr>
	<td width="">&nbsp;</td>
	<td width="">&nbsp;</td>
        <td width="">&nbsp;</td>
        <td width="">&nbsp;</td>
		<td width="">&nbsp;</td>
        <td colspan="5" align="right" style=" border-top:2px solid #000;">TUXTLA GUTIERREZ, CHIAPAS JULIO DEL 2015</td>
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
</tr>
	<td colspan="10" style="text-align:justify">TERMINADO EL ACTO PROTOCOLARIO SE LEVANTA PARA CONSTANCIA LA PRESENTE ACTA, FIRMANDO DE CONFORMIDAD LOS QUE EN ÉL INTERVINIERON Y QUE DAN FE.</td>

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
</tr>	
<tr>
		<td colspan="4" align="center"><strong>DIRECTOR DEL PLANTEL</strong></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="4" align="center"><strong>RESPONSABLE DE SERVICIOS ESCOLARES DEL PLANTEL</strong></td>
        
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
</tr>
<tr>

        <td colspan="4" style=" border-bottom:2px solid #000;">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="4" style=" border-bottom:2px solid #000;">&nbsp;</td>
</tr>

<tr>
		<td colspan="4" align="center" style="font-size:16px">'.$nombreDirector.'</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="4" align="center" style="font-size:16px">LAE. FLORIBEL MEGCHUN DE LA CRUZ</td>

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
</tr>

<tr>
		<td colspan="4" align="center"><strong>JEFE DEL DEPARTAMENTO DE SERVICIOS ESCOLARES Y BECAS</strong></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="4" align="center"><strong>DIRECTOR DE EDUCACIÓN SUPERIOR</strong></td>
        
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
</tr>
<tr>

        <td colspan="4" style=" border-bottom:2px solid #000;">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="4" style=" border-bottom:2px solid #000;">&nbsp;</td>
</tr>
<tr>
		<td colspan="4" align="center" style="font-size:16px">ING. JULIO MONTERO MEDEROS</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="4" align="center" style="font-size:16px">DR. LUIS MADRIGAL FRÍAS</td>
        
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
</tr><tr>
	<td>&nbsp;</td>
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
</tr>
<tr style="">
	<td colspan="2" style="padding:5px;font-size:12px;border-top:2px solid #000;border-left:2px solid #000;border-right:2px solid #000;border-bottom:1px solid #000;" align="center">REGISTRADO EN EL DEPARTAMENTO DE SERVICIOS ESCOLARES Y BECAS</td>
		    <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="justify" rowspan="2" colspan="5" style="padding:5px;font-size:14px;">POR ACUERDO DEL SECRETARIO GENERAL DE GOBIERNO Y CON FUNDAMENTO EN EL ARTÍCULO 28, FRACCIÓN X DE LA LEY ORGÁNICA DE LA ADMINISTRACIÓN PÚBLICA DEL ESTADO DE CHIAPAS, SE LEGALIZA, PREVIO COTEJO CON LA QUE EXISTE EN EL CONTROL RESPECTIVO LA FIRMA QUE ANTECEDE, QUE CORRESPONDE AL DIRECTOR DE EDUCACIÓN SUPERIOR.</td>
        
</tr>
<tr>
	<td style="padding:5px;font-size:12px; border-left:2px solid #000;"> CON No.</td>
	<td style="border-right:2px solid #000;border-bottom:1px solid #000;">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>

</tr>
<tr>
	<td style="padding:5px;font-size:12px;border-left:2px solid #000;">LIBRO:</td>
	<td style="border-right:2px solid #000;border-bottom:1px solid #000;">&nbsp;</td>
 
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="5" align="center" style="padding:5px;font-size:16px;"><strong>DR. LUIS MADRIGAL FRÍAS</strong></td>
</tr>
<tr>
	<td style="padding:5px;font-size:12px;border-left:2px solid #000;">A FOJAS:</td>
	<td style="border-right:2px solid #000;border-bottom:1px solid #000;">&nbsp;</td>
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
	<td style="padding:5px;font-size:12px;border-left:2px solid #000;">FECHA:</td>
	<td style="border-right:2px solid #000;border-bottom:1px solid #000;">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="3">Tuxtla Gutiérrez, Chiapas, a</td>
		
        <td colspan="2" style="border-bottom:2px solid #000;">&nbsp;</td>
</tr>	
<tr>
	<td align="CENTER" colspan="2" style="padding:5px;font-size:15px;border-left:2px solid #000;border-right:2px solid #000;border-top:1px solid #000;border-bottom:1px solid #000;" ><strong>COTEJO</strong></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="5" style="border-bottom:2px solid #000;">&nbsp;</td>
</tr>
<tr>
	<td style="border-left:2px solid #000;">&nbsp;</td>
	<td style="border-right:2px solid #000;">&nbsp;</td>
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
	<td style="border-left:2px solid #000;">&nbsp;</td>
	<td style="border-right:2px solid #000;">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td><td>&nbsp;</td>
        <td>&nbsp;</td><td>&nbsp;</td>
        <td>&nbsp;</td><td>&nbsp;</td>

</tr>
<tr>
	<td align="CENTER" colspan="2" style="padding:5px;font-size:15px;border-left:2px solid #000;border-right:2px solid #000;border-top:1px solid #000;border-bottom:2px solid #000;" ><strong>JEFE DE OFICINA</strong></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
        <td>&nbsp;</td>

        <td colspan="5" align="center" style="font-size:14px;">SUBSECRETARIO DE ASUNTOS JURÍDICOS</td>
</tr>
<tr>
	<td style="border-left:2px solid #000;">&nbsp;</td>
	<td style="border-right:2px solid #000;">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>        <td>&nbsp;</td>
        <td>&nbsp;</td>

</tr>
<tr>
	<td style="border-bottom:2px solid #000;;border-left:2px solid #000;">&nbsp;</td>
	<td style="border-bottom:2px solid #000;;border-right:2px solid #000;">&nbsp;</td>
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


        <td colspan="5" align="center" style="font-size:14PX;border-top:2px solid #000;"><strong>LIC. JOSE RAMON CANCINO IBARRA<strong></td>
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
</tr><tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
</tr><tr>
	<td>&nbsp;</td>
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
	<td colspan="10" style="font-size:14px"><center>ESTE DOCUMENTO NO ES VÁLIDO SI PRESENTA RASPADURAS O ENMENDADURAS.</center></td>

</tr>
       
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
//$mpdf=new mPDF('c','Letter','',''); 
////$mpdf->AddPage('L', '', '', '', '', '', '', '', '', '', '');
//$mpdf->WriteHTML($html);
//$mpdf->Output("Reporte_VerActaPromedio_Atras_" . $today, 'D');

?> 
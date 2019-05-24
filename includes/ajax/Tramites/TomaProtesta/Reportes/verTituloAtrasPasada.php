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
//$fechaActual = strftime("%Y-%m-%d", time());
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
    $Fojanumero = $_GET['Fojanumero'];
    $nuRegistro= $_GET['nuRegistro'];


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



       //$noacuerdo = $row[noacuerdo];
       $fechaExpedicion = $row[fechaExpedicion];
 



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
//if($row[fk_carreras]=="6" || $row[fk_carreras]=="7"  || $row[fk_carreras]=="11" || $row[fk_carreras]=="27" || $row[fk_carreras]=="13"  || $row[fk_carreras]=="12"){
    
//    $carrera=$row[nombreCarrera];
//}else if($row[fk_carreras]=="2" || $row[fk_carreras]=="29"){
//	$carrera=$row[nombreCarrera];
//}else{
//    $carrera="LICENCIADO EN ".$carrera;
    
//}



$opcionTitulacion=strtoupper($row[NombreOpcionTitulacion]);

$noactaTitulo=$row[noactatitulo];
$autorizacion = $row[NumeroAutorizacion];
$NumAutorizacion=substr($autorizacion, -4); //Esto devuelve "ndo"
$fecha=$row[FechaTomaProtesta];
$fecha1 = $Funciones->Fecha3($fecha);
$noAcuerdo=$row[noacuerdo];

$letra=substr($noactaTitulo, -7,1);
$numero=substr($noactaTitulo, -5);


if( $fk_carreras =="1" ||  $fk_carreras =="2"  ||  $fk_carreras =="3" ||  $fk_carreras =="4" ||  $fk_carreras =="5"  ||  $fk_carreras =="6"||  $fk_carreras =="7"  ||  $fk_carreras =="9" ||  $fk_carreras =="10" ||  $fk_carreras =="11"  ||  $fk_carreras =="12"||  $fk_carreras =="13"||  $fk_carreras =="14"  ||  $fk_carreras =="15" ||  $fk_carreras =="20" ||  $fk_carreras =="22"  ||  $fk_carreras =="24" ||  $fk_carreras =="25"  ||  $fk_carreras =="27" ||  $fk_carreras =="29" ||  $fk_carreras =="30"){
	
$hola=explode(" ", $fechaExpedicion );

    $fechaExpedicion0=strtolower ($hola[0]);
    $fechaExpedicion2=$hola[2];
    $fechaExpedicion4=$hola[4];
    $fechaExpedicion1=$hola[1];
    $fechaExpedicion3=$hola[3];
    $fechaExpedicion5=$hola[5];
	

}else if( $fk_carreras =="16" ||  $fk_carreras =="18" ||  $fk_carreras =="19"  ||  $fk_carreras =="21" ||  $fk_carreras =="23" ||  $fk_carreras =="26"  ||  $fk_carreras =="28"){
	 $hola=explode(" ", $fechaExpedicion );
     
	 $fechaExpedicion5=$hola[5];

}else{
	$hola=explode(" ", $fechaExpedicion );
	
     $carreraReporte=$hola[2]." ".$hola[3];
    
}


$fechaVigente=strtolower($fechaVigente);
$fechaExpedicion1=strtolower($fechaExpedicion1);
$fechaExpedicion2=strtolower($fechaExpedicion2);



if( $fk_carreras =="11" ||  $fk_carreras =="12"  ||  $fk_carreras =="18" ||  $fk_carreras =="21"){
	
$hola=explode(" ", $noAcuerdo );

    $noAcuerdo0=$hola[0];
    $noAcuerdo1=$hola[1];
    $noAcuerdo2=$hola[2];
    $noAcuerdo3=$hola[3];
    $noAcuerdo4=$hola[4];
    $noAcuerdo5=$hola[5];


}else if( $fk_carreras =="1" ||  $fk_carreras =="2" ||  $fk_carreras =="7"  ||  $fk_carreras =="8"){
	 $hola=explode(" ", $noAcuerdo );
     
	 $fechaExpedicion5=$hola[5];

}else{
	$hola=explode(" ", $$noAcuerdo );
	
     $carreraReporte=$hola[2]." ".$hola[3];
    
}





//DE FECHA

if($row[TipoRevoe] == "1") {
$html = ' 
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" media="print,screen" />
<link href="cssTitulo.css" rel="stylesheet" type="text/css"  />
<style type="text/css">
root { 
    display: block;
}

.Estilo5 {font-size: 20px}
.Estilo11 {font-size: 22px; font-weight: bold; }
.fuente_titulo {
	font-family: Vivaldi;
	font-size: 35px;
}
.cuerpo_titulo {
	font-family:  SnellRoundhand Script;
	font-size: 25px;
	font-weight: bold;

}
.nombre_sustentante {
	font-family: Algerian;
	font-size: 40px; 
	font-weight: bold;
}
.grado {
	font-family: Brush Script MT;
	font-size: 34px; 
}

.firma {
	font-family: Vivaldi;
	font-size: 25px;
}

.secret {
	font-family: Arial, serif;
	letter-spacing: 2px;
	font-size:30px;

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
.
}
.td1{ 	font-family:Arial;
	letter-spacing: 8px;
	font-size:30px;
	font-weight: bold;
	padding:5px;
	border:2px solid #000;
	border-radius:10px 10px 0 0;



}
.td2{ 	font-family:  SnellRoundhand Script;
	font-size: 28px;
	font-weight: bold;
	padding:5px;
	border-bottom:2px solid #000;
	border-left:2px solid #000;
	border-right:2px solid #000;	
	border-radius:0 0 0 0;


}
.td3{ 	
	font-family:  SnellRoundhand Script;
	font-size: 28px;
	font-weight: bold;
	padding:5px;
	border-bottom:2px solid #000;
	border-right:2px solid #000;	
	border-radius:0 0 0 0;

}
.td4{	font-family:  SnellRoundhand Script;
	font-size: 22px;
	font-weight: bold;
	border-bottom:2px solid #000;
	border-left:2px solid #000;
	border-right:2px solid #000;	
	border-radius:0 0 0 0;
padding-top:15px;
padding-left:25px;

}

.td5{   font-family:  SnellRoundhand Script;
	font-size: 22px;
	font-weight: bold;
	border-bottom:2px solid #000;
	border-right:2px solid #000;	
	border-radius:0 0 0 0;
padding-top:15px;
padding-left:25px;

}

.td6{ 	font-family:SnellRoundhand Script;
	font-size:22px;
	font-weight: bold;
	padding:5px;
	border-left:2px solid #000;
	border-right:2px solid #000;
	border-bottom:2px solid #000;
	border-radius:0px 0px 10px 10px;
	padding-left:25px;
	letter-spacing: 1px;
}
.td7{ 	font-family:SnellRoundhand Script;
	font-size:22px;
	font-weight: bold;
margin-top:40px;
}
.td8{ 	font-family:SnellRoundhand Script;
	font-size:22px;
	font-weight: bold;
margin-top:20px;


}
.td7_1{ 	font-family:SnellRoundhand Script;
	font-size:22px;
	font-weight: bold;
margin-top:50px;
}
.td8_1{ 	font-family:SnellRoundhand Script;
	font-size:22px;
	font-weight: bold;
margin-top:30px;


}
.td11{ 	font-family:SnellRoundhand Script;
	font-size:20px;
	font-weight: bold;
padding-left:25px;


}
.td12{ 	font-family:SnellRoundhand Script;
	font-size:18pt;
	font-weight: bold;


}
.td13{ 	font-family:SnellRoundhand Script;
	font-size:16px;
	font-weight: bold;
border-radius:5px 5px 5px 5px;
border:1px solid #000;
padding:5px;
text-aling:justify;


}
.no_auto{
	font-family:Arial;
	font-weight: normal;
	font-size:20px;

}

.letraFolio{
font-family:Arial;
	font-weight: bold;
	font-size:20pt;
margin:0px;
padding:0px;
}
.no_folio{
font-family:Arial;
	font-weight: bold;
	font-size:20pt;
	color:#FF0000;
	letter-spacing: 0px;
margin:0px;
padding:0px;


}

br{line-height: 1.6em;

}


</style>

</head>

<body>

<table width="890" border="0" cellpadding="0" style="border-collapse: collapse;">

<left><div class="logo" style="position: absolute; left:120px; top: 133px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="300" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:110px; top: 170px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="310" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:170px; top: 200px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="250" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:37px; top: 234px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="383" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:37px; top: 265px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="383" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:120px; top: 304px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="300" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:37px; top: 335px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="383" height="2" /></div></left>






<left><div class="logo" style="position: absolute; left:630px; top: 133px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="160" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:775px; top: 170px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="85" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:630px; top:  240px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="130" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:600px; top: 275px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="260" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:470px; top: 304px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="390" height="2" /></div></left>

<left><div class="logo" style="position: absolute; left:495px; top:  336px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="45" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:580px; top:  336px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="150" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:785px; top:  336px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="75" height="2" /></div></left>

<left><div class="logo" style="position: absolute; left:222px; top: 407px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="135" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:449px; top: 407px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="40" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:520px; top: 407px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="120" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:740px; top: 407px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="60" height="2" /></div></left>

  <tr>
    <td colspan="2"><div class="td1"><center>SECRETAR&Iacute;A DE  EDUCACIÓN</center></div></td>
  </tr>

  <tr class="cuerpo_titulo" >
    <td width="440" align="center"><div class="td2"  align="center"><strong>Acta de Examen Profesional</strong></div></td>
    <td width="" align="center"><div class="td3"  align="center"><strong>Registro</strong></div></td>
  </tr> 

<table width="890" border="0" cellpadding="0" style="border-collapse: collapse;">
  <tr>
    <td  width="440">
	<div  class="td4">N&uacute;mero &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="no_auto">'.$NumAutorizacion.'</span><br/>
		Fecha &nbsp; &nbsp; &nbsp; <span style="letter-spacing: 1px;" class="no_auto">'.$fecha1 .'</span><br/>
		Expedida por &nbsp; &nbsp; <span style="letter-spacing: 1px;" class="no_auto">'.$nombreInstitucion .'</span><br/>
		<br/>
		Lugar &nbsp; &nbsp; &nbsp; <span style="letter-spacing: 1px;" class="no_auto">Tuxtla Guti&eacute;rrez, Chiapas.</span><br/>
<br/>
    	</div>


    </td>
    
    
    <td  width="450">
	<div  class="td5">El t&iacute;tulo &nbsp; No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="no_auto">'.$noactaTitulo.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>qued&oacute;<br/>
		registrado &nbsp; en &nbsp; la &nbsp; foja &nbsp;  n&uacute;mero &nbsp; &nbsp;&nbsp;&nbsp;  <span class="no_auto">'.$Fojanumero.'&nbsp;&nbsp;,</span><br/>
		frente y vuelta, del lubro de registro de t&iacute;tulos<br/>
		profesionales No. <span class="no_auto">&nbsp;&nbsp;'.$nuRegistro.',</span><br/>
		Expedida en &nbsp;&nbsp;&nbsp;<span style="letter-spacing: 1px;" class="no_auto">Tuxtla Guti&eacute;rrez, Chiapas.</span><br/>
		<br/>
		A &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; de &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; de		

    	</div>

    </td>
  </tr>
  
  <tr>
    <td colspan="2" style="line-height: 30px;";><div class="td6">Reconocimiento de validez oficial de estudios otorgado por la Secretar&iacute;a de Educaci&oacute;n, seg&uacute;n Acuerdo No. <span class="no_auto">'.$noAcuerdo.',</span> de fecha <span class="no_auto"> &nbsp;&nbsp;'.$fechaExpedicion1.'&nbsp;</span> de <span class="no_auto">&nbsp;&nbsp;&nbsp;&nbsp;'.$fechaExpedicion0.'&nbsp;&nbsp;&nbsp;&nbsp;</span> del a&ntilde;o <span class="no_auto">&nbsp;&nbsp;'.$fechaExpedicion3.'.&nbsp;</span></div></td>
  </tr>

</table>
     
</table>

<table width="890" border="0" cellpadding="0" style="border-collapse: collapse;">

<left><div class="logo" style="position: absolute; left:37px; top: 538px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="350" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:37px; top: 738px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="350" height="2" /></div></left>

<left><div class="logo" style="position: absolute; left:500px; top: 538px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="350" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:500px; top: 738px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="350" height="2" /></div></left>	

<tr>
		<td><div class="td7"><center>Secretario General de Gobierno</center></div></td>
		<td width="450"><center><div class="td7">Secretario de Educaci&oacute;n</div></center></td>
	</tr>
<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
<tr>
		<td><br/><div class="td8"><center>Juan Carlos G&oacute;mez Aranda</center></div></td>
		<td width="450"><br/><center><div class="td8">Ricardo Ara&oacute;n Aguilar Gordillo</div></center></td>
	</tr>

<tr>
		<td><div class=""><center></center></div></td>
		<td width="450"><center><div class=""></div></center></td>
	</tr>

	

<tr>
		<td><div class="td7_1"><center>El Director de Eduaci&oacute;n Superior</center></div></td>
		<td width="450"><center><div class="td7_1">El Jefe del Departamento de <br/>Servicios Escolares y Becas</div></center></td>
	</tr>
<tr>
		<td><br/><div class="td8_1"><center>Luis Madrigal Fr&iacute;as</center></div></td>
		<td width="450"><br/><center><div class="td8_1">Julio Montero Mederos</div></center></td>
	</tr>

</table>

<table width="890" border="0" cellpadding="0" style="border-collapse: collapse;">

	<tr>
		<td width="320">&nbsp;</td>
		<td>&nbsp;</td>
	</tr>

	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>

	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>

	<tr>
		<td><div class="td11"><center>Registro de la<br/>Secretar&iacute;a de Educaci&oacute;n</center></div></td>
		<td>&nbsp;</td>
	</tr>
<tr>
		<td><div class="td12"><center>Folio &nbsp;<span style="border-radius:8px 0px 0px 8px;border-left:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000;padding-right:0px;padding-left:10px;" class="letraFolio">'.$letra.'&nbsp;&nbsp;</span><span style="border-radius:0 8px 8px 0;border-right:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000;padding-right:10px;"  class="no_folio">'.$numero.'</span></center></div></td>
		<td>&nbsp;</td>
	</tr>
<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
<tr>
		<td align="justify"><div class="td13">La expedici&oacute;n del presente T&iacute;tulo queda sujeta
			al cumplimineto de las normas emitidas por la
			Secretar&iacute;a de Educaci&oacute;n P&uacute;blica y la Secretar&iacute;a
			de Educaci&oacute;n del Estado.</div></td>
		<td>&nbsp;</td>
	</tr>








</table>

</body>
</html>
';
}





//VIGENCIA

if($row[TipoRevoe] == "2") {
$html = ' 
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" media="print,screen" />
<link href="cssTitulo.css" rel="stylesheet" type="text/css"  />
<style type="text/css">
root { 
    display: block;
}

.Estilo5 {font-size: 20px}
.Estilo11 {font-size: 22px; font-weight: bold; }
.fuente_titulo {
	font-family: Vivaldi;
	font-size: 35px;
}
.cuerpo_titulo {
	font-family:  SnellRoundhand Script;
	font-size: 25px;
	font-weight: bold;

}
.nombre_sustentante {
	font-family: Algerian;
	font-size: 40px; 
	font-weight: bold;
}
.grado {
	font-family: Brush Script MT;
	font-size: 34px; 
}

.firma {
	font-family: Vivaldi;
	font-size: 25px;
}

.secret {
	font-family: Arial, serif;
	letter-spacing: 2px;
	font-size:30px;

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
.
}
.td1{ 	font-family:Arial;
	letter-spacing: 8px;
	font-size:30px;
	font-weight: bold;
	padding:5px;
	border:2px solid #000;
	border-radius:10px 10px 0 0;



}
.td2{ 	font-family:  SnellRoundhand Script;
	font-size: 28px;
	font-weight: bold;
	padding:5px;
	border-bottom:2px solid #000;
	border-left:2px solid #000;
	border-right:2px solid #000;	
	border-radius:0 0 0 0;


}
.td3{ 	
	font-family:  SnellRoundhand Script;
	font-size: 28px;
	font-weight: bold;
	padding:5px;
	border-bottom:2px solid #000;
	border-right:2px solid #000;	
	border-radius:0 0 0 0;

}
.td4{	font-family:  SnellRoundhand Script;
	font-size: 22px;
	font-weight: bold;
	border-bottom:2px solid #000;
	border-left:2px solid #000;
	border-right:2px solid #000;	
	border-radius:0 0 0 0;
padding-top:15px;
padding-left:25px;

}

.td5{   font-family:  SnellRoundhand Script;
	font-size: 22px;
	font-weight: bold;
	border-bottom:2px solid #000;
	border-right:2px solid #000;	
	border-radius:0 0 0 0;
padding-top:15px;
padding-left:20px;

}

.td6{ 	font-family:SnellRoundhand Script;
	font-size:22px;
	font-weight: bold;
	padding:5px;
	border-left:2px solid #000;
	border-right:2px solid #000;
	border-bottom:2px solid #000;
	border-radius:0px 0px 10px 10px;
	padding-left:25px;
	letter-spacing: 1px;
}
.td7{ 	font-family:SnellRoundhand Script;
	font-size:22px;
	font-weight: bold;
margin-top:40px;
}
.td8{ 	font-family:SnellRoundhand Script;
	font-size:22px;
	font-weight: bold;
margin-top:20px;


}
.td7_1{ 	font-family:SnellRoundhand Script;
	font-size:22px;
	font-weight: bold;
margin-top:50px;
}
.td8_1{ 	font-family:SnellRoundhand Script;
	font-size:22px;
	font-weight: bold;
margin-top:30px;


}
.td11{ 	font-family:SnellRoundhand Script;
	font-size:20px;
	font-weight: bold;
padding-left:25px;


}
.td12{ 	font-family:SnellRoundhand Script;
	font-size:30px;
	font-weight: bold;


}
.td13{ 	font-family:SnellRoundhand Script;
	font-size:16px;
	font-weight: bold;
border-radius:5px 5px 5px 5px;
border:1px solid #000;
padding:5px;
text-aling:justify;


}
.no_auto{
	font-family:Arial;
	font-weight: normal;
	font-size:20px;

}

.letraFolio{
font-family:Arial;
	font-weight: bold;
	font-size:24px;

}
.no_folio{
font-family:Arial;
	font-weight: bold;
	font-size:24px;
	color:#FF0000;
	letter-spacing: 2px;


}

br{line-height: 1.6em;

}


</style>

</head>

<body>


<table width="890" border="0" cellpadding="0" style="border-collapse: collapse;">

<left><div class="logo" style="position: absolute; left:120px; top: 133px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="300" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:110px; top: 170px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="310" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:170px; top: 200px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="250" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:37px; top: 234px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="383" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:37px; top: 265px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="383" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:120px; top: 304px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="300" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:37px; top: 335px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="383" height="2" /></div></left>






<left><div class="logo" style="position: absolute; left:630px; top: 133px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="160" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:775px; top: 170px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="100" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:630px; top:  240px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="85" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:600px; top: 275px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="275" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:470px; top: 304px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="405" height="2" /></div></left>

<left><div class="logo" style="position: absolute; left:508px; top:  336px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="45" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:600px; top:  336px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="150" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:800px; top:  336px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="75" height="2" /></div></left>

<left><div class="logo" style="position: absolute; left:225px; top: 401px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="138" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:449px; top: 401px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="40" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:520px; top: 401px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="120" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:730px; top: 401px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="60" height="2" /></div></left>

  <tr>
    <td colspan="2"><div class="td1"><center>SECRETAR&Iacute;A DE  EDUCACIÓN</center></div></td>
  </tr>

  <tr class="cuerpo_titulo" >
    <td width="440" align="center"><div class="td2"  align="center"><strong>Acta de Examen Profesional</strong></div></td>
    <td width="" align="center"><div class="td3"  align="center"><strong>Registro</strong></div></td>
  </tr> 

<table width="890" border="0" cellpadding="0" style="border-collapse: collapse;">
  <tr>
    <td  width="440">
	<div  class="td4">N&uacute;mero &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="no_auto">'.$NumAutorizacion.'</span><br/>
		Fecha &nbsp; &nbsp; &nbsp; <span style="letter-spacing: 1px;" class="no_auto">'.$fecha1 .'</span><br/>
		Expedida por &nbsp; &nbsp; <span style="letter-spacing: 1px;" class="no_auto">'.$nombreInstitucion .'</span><br/>
		<br/>
		Lugar &nbsp; &nbsp; &nbsp; <span style="letter-spacing: 1px;" class="no_auto">Tuxtla Guti&eacute;rrez, Chiapas.</span><br/>
<br/>
    	</div>

    </td>
    
    
   <td  width="450">
	<div  class="td5">El t&iacute;tulo &nbsp; No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="no_auto">'.$noactaTitulo.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>qued&oacute;<br/>
		registrado &nbsp; en &nbsp; la &nbsp; foja &nbsp;  n&uacute;mero &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;  <span class="no_auto">'.$Fojanumero.',</span><br/>
		frente y vuelta, del lubro de registro de t&iacute;tulos<br/>
		profesionales No. <span class="no_auto">'.$nuRegistro.',</span><br/>
		Expedida en &nbsp;&nbsp;&nbsp;<span style="letter-spacing: 1px;" class="no_auto">Tuxtla Guti&eacute;rrez, Chiapas.</span><br/>
		<br/>
		A &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; de &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; de		

    	</div>

    </td>

  </tr>
  
  <tr>
    <td colspan="2"><div class="td6">Reconocimiento de validez oficial de estudios otorgado por la Secretar&iacute;a de Educaci&oacute;n, seg&uacute;n Acuerdo No. &nbsp;<span class="no_auto">'.$noAcuerdo.',</span>'.$fechaVigente.'</div></td>
  </tr>

</table>
     
</table>

<table width="890" border="0" cellpadding="0" style="border-collapse: collapse;">

<left><div class="logo" style="position: absolute; left:37px; top: 540px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="350" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:37px; top: 740px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="350" height="2" /></div></left>

<left><div class="logo" style="position: absolute; left:500px; top: 540px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="350" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:500px; top: 740px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="350" height="2" /></div></left>

	<tr>
		<td><div class="td7"><center>Secretario General de Gobierno</center></div></td>
		<td width="450"><center><div class="td7">Secretario de Educaci&oacute;n</div></center></td>
	</tr>
<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
<tr>
		<td><br/><div class="td8"><center>Oscar Eduardo Ram&iacute;rez Aguilar</center></div></td>
		<td width="450"><br/><center><div class="td8">Ricardo Ara&oacute;n Aguilar Gordillo</div></center></td>
	</tr>

<tr>
		<td><div class=""><center></center></div></td>
		<td width="450"><center><div class=""></div></center></td>
	</tr>

	

<tr>
		<td><div class="td7_1"><center>El Director de Eduaci&oacute;n Superior</center></div></td>
		<td width="450"><center><div class="td7_1">El Jefe del Departamento de <br/>Servicios Escolares y Becas</div></center></td>
	</tr>
<tr>
		<td><br/><div class="td8_1"><center>Luis Madrigal Fr&iacute;as</center></div></td>
		<td width="450"><br/><center><div class="td8_1">Julio Montero Mederos</div></center></td>
	</tr>

</table>

<table width="890" border="0" cellpadding="0" style="border-collapse: collapse;">

	<tr>
		<td width="320">&nbsp;</td>
		<td>&nbsp;</td>
	</tr>

	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>

	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>

	<tr>
		<td><div class="td11"><center>Registro de la<br/>Secretar&iacute;a de Educaci&oacute;n</center></div></td>
		<td>&nbsp;</td>
	</tr>
<tr>
		<td><div class="td12"><center>Folio &nbsp; &nbsp;<span style="border-radius:10px 0px 0px 10px;border-left:2px solid #000;border-top:2px solid #000;border-bottom:2px solid #000;padding-right:10px;padding-left:20px;" class="letraFolio">'.$letra.'</span><span style="border-radius:0 5px 5px 0;border-right:2px solid #000;border-top:2px solid #000;border-bottom:2px solid #000;padding-right:20px;"  class="no_folio">&nbsp;'.$numero.'</span></center></div></td>
		<td>&nbsp;</td>
	</tr>
<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
<tr>
		<td align="justify"><div class="td13">La expedici&oacute;n del presente T&iacute;tulo queda sujeta
			al cumplimineto de las normas emitidas por la
			Secretar&iacute;a de Educaci&oacute;n P&uacute;blica y la Secretar&iacute;a
			de Educaci&oacute;n del Estado.</div></td>
		<td>&nbsp;</td>
	</tr>








</table>

</body>
</html>
';
}







//VIGENTE


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

if( $fk_carreras =="6" ||  $fk_carreras =="7"  ||  $fk_carreras =="11" ||  $fk_carreras =="27" ||  $fk_carreras =="14"  ||  $fk_carreras =="19"){
$hola=explode(" ", $fechaExpedicion );

    $fechaExpedicion1=$hola[0]." ".$hola[1]." ".$hola[2]." ".$hola[3]." ".$hola[4];
    $fechaExpedicion2=$hola[5];


}else if( $fk_carreras =="2" ||  $fk_carreras =="14"){
	 $fechaExpedicion =$fechaExpedicion ;
}else{
	$hola=explode(" ", $fechaExpedicion );
	
     $carreraReporte=$hola[2]." ".$hola[3];
    
}


$fechaVigente=strtolower($fechaVigente);
$fechaExpedicion1=strtolower($fechaExpedicion1);
$fechaExpedicion2=strtolower($fechaExpedicion2);

if($row[TipoRevoe] == "3") {
$html = ' 
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" media="print,screen" />
<link href="cssTitulo.css" rel="stylesheet" type="text/css"  />
<style type="text/css">
root { 
    display: block;
}

.Estilo5 {font-size: 20px}
.Estilo11 {font-size: 22px; font-weight: bold; }
.fuente_titulo {
	font-family: Vivaldi;
	font-size: 35px;
}
.cuerpo_titulo {
	font-family:  SnellRoundhand Script;
	font-size: 25px;
	font-weight: bold;

}
.nombre_sustentante {
	font-family: Algerian;
	font-size: 40px; 
	font-weight: bold;
}
.grado {
	font-family: Brush Script MT;
	font-size: 34px; 
}

.firma {
	font-family: Vivaldi;
	font-size: 25px;
}

.secret {
	font-family: Arial, serif;
	letter-spacing: 2px;
	font-size:30px;

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
.
}
.td1{ 	font-family:Arial;
	letter-spacing: 8px;
	font-size:30px;
	font-weight: bold;
	padding:5px;
	border:2px solid #000;
	border-radius:10px 10px 0 0;



}
.td2{ 	font-family:  SnellRoundhand Script;
	font-size: 28px;
	font-weight: bold;
	padding:5px;
	border-bottom:2px solid #000;
	border-left:2px solid #000;
	border-right:2px solid #000;	
	border-radius:0 0 0 0;


}
.td3{ 	
	font-family:  SnellRoundhand Script;
	font-size: 28px;
	font-weight: bold;
	padding:5px;
	border-bottom:2px solid #000;
	border-right:2px solid #000;	
	border-radius:0 0 0 0;

}
.td4{	font-family:  SnellRoundhand Script;
	font-size: 22px;
	font-weight: bold;
	border-bottom:2px solid #000;
	border-left:2px solid #000;
	border-right:2px solid #000;	
	border-radius:0 0 0 0;
padding-top:15px;
padding-left:25px;

}

.td5{   font-family:  SnellRoundhand Script;
	font-size: 22px;
	font-weight: bold;
	border-bottom:2px solid #000;
	border-right:2px solid #000;	
	border-radius:0 0 0 0;
padding-top:15px;
padding-left:20px;

}

.td6{ 	font-family:SnellRoundhand Script;
	font-size:22px;
	font-weight: bold;
	padding:5px;
	border-left:2px solid #000;
	border-right:2px solid #000;
	border-bottom:2px solid #000;
	border-radius:0px 0px 10px 10px;
	padding-left:25px;
	letter-spacing: 1px;
}
.td7{ 	font-family:SnellRoundhand Script;
	font-size:22px;
	font-weight: bold;
margin-top:40px;
}
.td8{ 	font-family:SnellRoundhand Script;
	font-size:22px;
	font-weight: bold;
margin-top:20px;


}
.td7_1{ 	font-family:SnellRoundhand Script;
	font-size:22px;
	font-weight: bold;
margin-top:50px;
}
.td8_1{ 	font-family:SnellRoundhand Script;
	font-size:22px;
	font-weight: bold;
margin-top:30px;


}
.td11{ 	font-family:SnellRoundhand Script;
	font-size:20px;
	font-weight: bold;
padding-left:25px;


}
.td12{ 	font-family:SnellRoundhand Script;
	font-size:30px;
	font-weight: bold;


}
.td13{ 	font-family:SnellRoundhand Script;
	font-size:16px;
	font-weight: bold;
border-radius:5px 5px 5px 5px;
border:1px solid #000;
padding:5px;
text-aling:justify;


}
.no_auto{
	font-family:Arial;
	font-weight: normal;
	font-size:20px;

}

.letraFolio{
font-family:Arial;
	font-weight: bold;
	font-size:24px;

}
.no_folio{
font-family:Arial;
	font-weight: bold;
	font-size:24px;
	color:#FF0000;
	letter-spacing: 2px;


}

br{line-height: 1.6em;

}


</style>

</head>

<body>


<table width="890" border="0" cellpadding="0" style="border-collapse: collapse;">

<left><div class="logo" style="position: absolute; left:120px; top: 133px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="300" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:110px; top: 170px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="310" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:170px; top: 200px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="250" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:37px; top: 234px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="383" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:37px; top: 265px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="383" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:120px; top: 304px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="300" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:37px; top: 335px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="383" height="2" /></div></left>






<left><div class="logo" style="position: absolute; left:630px; top: 133px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="160" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:775px; top: 170px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="85" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:630px; top:  240px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="85" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:600px; top: 275px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="260" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:470px; top: 304px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="390" height="2" /></div></left>

<left><div class="logo" style="position: absolute; left:495px; top:  336px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="45" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:580px; top:  336px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="150" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:785px; top:  336px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="75" height="2" /></div></left>

<left><div class="logo" style="position: absolute; left:225px; top: 401px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="150" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:700px; top: 401px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="120" height="2" /></div></left>

  <tr>
    <td colspan="2"><div class="td1"><center>SECRETAR&Iacute;A DE  EDUCACIÓN</center></div></td>
  </tr>

  <tr class="cuerpo_titulo" >
    <td width="440" align="center"><div class="td2"  align="center"><strong>Acta de Examen Profesional</strong></div></td>
    <td width="" align="center"><div class="td3"  align="center"><strong>Registro</strong></div></td>
  </tr> 

<table width="890" border="0" cellpadding="0" style="border-collapse: collapse;">
  <tr>
    <td  width="440">
	<div  class="td4">N&uacute;mero &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="no_auto">'.$NumAutorizacion.'</span><br/>
		Fecha &nbsp; &nbsp; &nbsp; <span style="letter-spacing: 1px;" class="no_auto">'.$fecha1 .'</span><br/>
		Expedida por &nbsp; &nbsp; <span style="letter-spacing: 1px;" class="no_auto">'.$nombreInstitucion .'</span><br/>
		<br/>
		Lugar &nbsp; &nbsp; &nbsp; <span style="letter-spacing: 1px;" class="no_auto">Tuxtla Guti&eacute;rrez, Chiapas.</span><br/>
<br/>
    	</div>

    </td>
    
    
    <td  width="450">
	<div  class="td5">El t&iacute;tulo &nbsp; No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="no_auto">'.$noactaTitulo.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>qued&oacute;<br/>
		registrado &nbsp; en &nbsp; la &nbsp; foja &nbsp;  n&uacute;mero &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;  <span class="no_auto">'.$Fojanumero.'&nbsp;&nbsp;,</span><br/>
		frente y vuelta, del lubro de registro de t&iacute;tulos<br/>
		profesionales No. <span class="no_auto">&nbsp;&nbsp;'.$nuRegistro.',</span><br/>
		Expedida en &nbsp;&nbsp;&nbsp;<span style="letter-spacing: 1px;" class="no_auto">Tuxtla Guti&eacute;rrez, Chiapas.</span><br/>
		<br/>
		A &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; de &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; de		

    	</div>

    </td>
  </tr>
  
  <tr>
    <td colspan="2"><div class="td6">Reconocimiento de validez oficial de estudios otorgado por la Secretar&iacute;a de Educaci&oacute;n, seg&uacute;n Acuerdo No. &nbsp;<span class="no_auto">'.$noAcuerdo2.''.$noAcuerdo3.''.$noAcuerdo4.',&nbsp;</span> vigente a partir del ciclo escolar &nbsp;<span class="no_auto">'.$fechaExpedicion5.'. </span></div></td>
  </tr>

</table>
     
</table>

<table width="890" border="0" cellpadding="0" style="border-collapse: collapse;">

<left><div class="logo" style="position: absolute; left:37px; top: 538px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="350" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:37px; top: 738px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="350" height="2" /></div></left>

<left><div class="logo" style="position: absolute; left:500px; top: 538px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="350" height="2" /></div></left>
<left><div class="logo" style="position: absolute; left:500px; top: 738px;"><img src="../../../../../assets/img/linea_larga_celda.png" width="350" height="2" /></div></left>

	<tr>
		<td><div class="td7"><center>Secretario General de Gobierno</center></div></td>
		<td width="450"><center><div class="td7">Secretario de Educaci&oacute;n</div></center></td>
	</tr>
<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
<tr>
		<td><br/><div class="td8"><center>Oscar Eduardo Ram&iacute;rez Aguilar</center></div></td>
		<td width="450"><br/><center><div class="td8">Ricardo Ara&oacute;n Aguilar Gordillo</div></center></td>
	</tr>

<tr>
		<td><div class=""><center></center></div></td>
		<td width="450"><center><div class=""></div></center></td>
	</tr>

	

<tr>
		<td><div class="td7_1"><center>El Director de Eduaci&oacute;n Superior</center></div></td>
		<td width="450"><center><div class="td7_1">El Jefe del Departamento de <br/>Servicios Escolares y Becas</div></center></td>
	</tr>
<tr>
		<td><br/><div class="td8_1"><center>Luis Madrigal Fr&iacute;as</center></div></td>
		<td width="450"><br/><center><div class="td8_1">Julio Montero Mederos</div></center></td>
	</tr>

</table>

<table width="890" border="0" cellpadding="0" style="border-collapse: collapse;">

	<tr>
		<td width="320">&nbsp;</td>
		<td>&nbsp;</td>
	</tr>

	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>

	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>

	<tr>
		<td><div class="td11"><center>Registro de la<br/>Secretar&iacute;a de Educaci&oacute;n</center></div></td>
		<td>&nbsp;</td>
	</tr>
<tr>
		<td><div class="td12"><center>Folio &nbsp; &nbsp;<span style="border-radius:5px 0px 0px 5px;border-left:2px solid #000;border-top:2px solid #000;border-bottom:2px solid #000;padding-right:10px;padding-left:20px;" class="letraFolio">'.$letra.'</span><span style="border-radius:0 5px 5px 0;border-right:2px solid #000;border-top:2px solid #000;border-bottom:2px solid #000;padding-right:20px;"  class="no_folio">&nbsp;'.$numero.'</span></center></div></td>
		<td>&nbsp;</td>
	</tr>
<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
<tr>
		<td align="justify"><div class="td13">La expedici&oacute;n del presente T&iacute;tulo queda sujeta
			al cumplimineto de las normas emitidas por la
			Secretar&iacute;a de Educaci&oacute;n P&uacute;blica y la Secretar&iacute;a
			de Educaci&oacute;n del Estado.</div></td>
		<td>&nbsp;</td>
	</tr>








</table>

</body>
</html>
';
}


 

   
        
        
        
        
        
        
    }
} else {
    $html = "Lo Sentimos No Se Pudo Realizar la Consulta";
}
echo $html;
//ob_start();
//$mpdf=new mPDF('c','Legal','',''); 
////$mpdf->AddPage('L', '', '', '', '', '', '', '', '', '', '');
//$mpdf->WriteHTML($html);
//$mpdf->Output("Reporte_VerTituloAtras_Frente_" . $today, 'D');

?> 
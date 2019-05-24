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
//        $fechaLista = ($row[FechaTomaProtesta]);


        
        

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
         
//         
         
////FECHA DE SOLICITUD $fechasolicitud
//$fechasolicitud = $row[FechaSolicitud];
//FECHA EXAMEN 
$FechaTomaProtesta= $row[FechaTomaProtesta];
////TOMA DE PROTESTA 
//$fechaLista= $row[FechaTomaProtestaReporte];


//HORARIO DEL ACTA DE EXAMEN
//$numletra= new DeNumero_a_Letras;
//$hora=num2letras($row[hora],false, false);


$hora =$row[hora];
$horaDividir = explode(":",$hora);
$horaHora=$horaDividir[0];
$horaMinuto = $horaDividir[1];


$horaListo = convertir($horaHora);
$horaMinutoListo = convertir($horaMinuto);
$hora =$horaListo." ".$horaMinutoListo;

//SALON

$salon=$row[salon];


//$autorizacion = $row[NumeroAutorizacion];
$titulo =mb_strtoupper( $row[nombreTitulo],'UTF-8');         
            
            
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
 

//$opcionTitulacion=strtoupper($row[aaa]);
$turno=strtoupper($row[NombreTurno]);

//folioActa
$folioActa=$row[FolioActa];

$autorizacion = $row[NumeroAutorizacion];
$NumAutorizacion=substr($autorizacion, -4); //Esto devuelve "ndo"



    if(is_numeric ($salon)==true){
         
         $salonListo=$salon;
     }else{
         $salonListo= $salon;
         
     }
    
    $html = ' 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">

.Estilo2 {
	font-size: 20px;
	font-weight: bold;
}

.Estilo3 {
	font-size: 15px;
	color: #FF0000;
}
.Estilo5 {font-size: 19px}
.Estilo11 {font-size: 20px; }
.Estilo12 {font-size: 17px;}
.Estilo13 {font-size: 18px}
.Estilo4 {font-size: 14.5px}
.EstiloA {font-size: 13.4px}
.Estilo14 {
	font-size: 24px;
	font-weight: bold;
}
.Estilo6 {font-size: 12px}
.Estilo7 {font-size: 11px}
.pie {font-size: 16px}
</style>
</head>

<body>
<left><div class="logo" style="position: absolute; left: 80px; top: 85px;"><img src="../../../../../assets/img/escudo.gif" width="100" height="98" /></div></left>
<left><div class="logo" style="position: absolute; left: 50px; top: 300px;"><img src="../../../../../assets/img/foto.png" width="125" height="428" /></div></left>
<div class="logo" style="position: absolute; left: 670px; top: 105px;"><span class="Estilo6">FOLIO:</span><span class="Estilo3"><u>&nbsp;' .$folioActa. '</u></span></div>
<table border="0" cellpadding="-2" cellspacing="-1">
    <tr>
    <td width="73">&nbsp;</td>
    <td width="88">&nbsp;</td>
    <td width="100">&nbsp;</td>
    <td width="130">&nbsp;</td>
    <td width="154">&nbsp;</td>
    <td width="130">&nbsp;</td>
    <td width="141">&nbsp;</td>
    <td width="8">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3"><center><div align="center" class="Estilo11">&nbsp;GOBIERNO DEL ESTADO DE CHIAPAS</div></center></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3"><center><div align="center" class="Estilo11">SECRETARÍA DE EDUCACIÓN</center></div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3"><center><div align="center" class="Estilo13">SUBSECRETARÍA DE EDUCACIÓN ESTATAL</div></center></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3"><center><div align="center" class="Estilo13">DIRECCIÓN DE EDUCACIÓN SUPERIOR</div></center></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3"><center><div align="center" class="Estilo4">DEPARTAMENTO DE SERVICIOS ESCOLARES</div></center></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3"><center><div align="center" class="Estilo12">INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS</div></center></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4"></td>
    <td>&nbsp;</td>
  </tr>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4"></td>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="865" height="601" border="0" cellpadding="1" cellspacing="0" class="Estilo6">
    <tr>
        <td width="60">&nbsp;</td>
        <td width="80">&nbsp;</td>
        <td width="129" colspan="6">
            <div align="center">
                <span class="Estilo6"> ACTA N°:<u>&nbsp; '.$NumAutorizacion.' &nbsp;</u> </span> <span class="Estilo6"> REGIMEN : <u>&nbsp;  PARTICULAR &nbsp;</u></span> <span class="Estilo6"> RVOE :<u>&nbsp; '.$noacuerdo.' &nbsp;</u>&nbsp; </span> <span class="Estilo6"><br> '.$fechaVigente.' :<u>&nbsp; '.$fechaExpedicion.'&nbsp;</u></span>        
            </div>
        </td>
    </tr>
</table>
<table width="865" height="601" border="0" cellpadding="-1" cellspacing="0" class="Estilo4">
  <tr>
    <td width="73">&nbsp;</td>
    <td width="88">&nbsp;</td>
    <td width="129">&nbsp;</td>
    <td width="92">&nbsp;</td>
    <td width="104">&nbsp;</td>
    <td width="90">&nbsp;</td>
    <td width="171">&nbsp;</td>
    <td width="8">&nbsp;</td>
  </tr>
   <tr>
    <td width="73">&nbsp;</td>
    <td width="128">&nbsp;</td>
    <td width="73" align="center" colspan="6" class="Estilo11"><strong>ACTA DE EXENCIÓN DE EXAMEN PROFESIONAL</strong></td>
  </tr>
   <tr>
    <td width="73">&nbsp;</td>
    <td width="108">&nbsp;</td>
    <td width="139">&nbsp;</td>
    <td width="90" align="center" colspan="3" class="Estilo11"><strong>Y TOMA DE PROTESTA</strong></td>
    <td width="171">&nbsp;</td>
    <td width="8">&nbsp;</td>
  </tr>
  </table>
  <table width="865" height="601" border="0" cellpadding="1" cellspacing="0" class="EstiloA">
  <tr>
    <td width="70">&nbsp;</td>
    <td width="73">&nbsp;</td>
    <td width="135">&nbsp;</td>
    <td width="102">&nbsp;</td>
    <td width="100">&nbsp;</td>
    <td width="70">&nbsp;</td>
    <td width="151">&nbsp;</td>
    <td width="8">&nbsp;</td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>EN LA CIUDAD DE  </td>
    <td colspan="5"  style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom">TUXTLA GUTIERREZ, CHIAPAS.</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>SIENDO LAS </td>
    <td colspan="2"  style="font-size:10px;background: #FFF url(../../../../../assets/img/linea_larga_celda.png) no-repeat left bottom">'.$hora.'&nbsp;HORAS</td>
    <td>DEL DÍA:</td>
    <td colspan="2"  style="background: #FFF url(../../../../../assets/img/linea_larga_celda.png) no-repeat left bottom">' .$fechaDia. '</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>DEL MES DE </td>
    <td colspan="2"  style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom">' .$fechaMes . '</td>
    <td>DEL AÑO</td>
    <td colspan="2"  style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom">' . $fechaAnio . '</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>EN EL SALÓN&nbsp; : </td>
    <td colspan="5"  style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom">'.$salon.'</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>DEL (A): </td>
    <td colspan="5"  style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom"> INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS.</td>
  </tr>
</table>

<table width="865" height="601" border="0" cellpadding="1" cellspacing="1" class="EstiloA">
   <tr>
    <td width="70">&nbsp;</td>
    <td width="75">&nbsp;</td>
    <td width="140">CON CLAVE:</td>
    <td width="102" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom"> 07PSU0002D </td>
    <td width="70"><center>TURNO:</center></td>
    <td width="90" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom">'.$turno.'</td>
    <td colspan="2" width="179"> SE REUNIERON LOS C.C.:</td>
  </tr> 
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3" style="font-size:12px; text-align: justify; background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom">'.$nombreDirector.'</td>
    <td colspan="3" style="text-align: justify;">DIRECTOR DEL PLANTEL </td>

  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3" style="text-align: justify; background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom">M.A. FLORIBEL MEGCHUN DE LA CRUZ</td>
    <td colspan="3" style="text-align: justify;">RESPONSABLE DE SERVICIOS ESCOLARES</td>
    
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="6" style="text-align: justify;">
        <div>
            DEL PLANTEL PARA QUE, DE ACUERDO A LAS NORMAS Y LINEAMIENTOS ESTABLECIDOS POR LA DIRECCIÓN  DE EDUCACIÓN
            SUPERIOR DE LA SUBSECRETARÍA DE EDUCACION ESTATAL, LLEVAR A CABO EL ACTO PROTOCOLARIO DE TOMA DE
            PROTESTA  DE LEY  AL (A) C. PASANTE:
        </div>    
    </td>
 </tr>

</table>
<table width="865" height="601" border="0" cellpadding="1" cellspacing="0" class="EstiloA">

 <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="6" align="center" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom"><div align="center"><strong>'.$nombre.' '.$apaterno.' '.$amaterno.'</strong></div></td>
  </tr>
  <tr>
    <td width="70">&nbsp;</td>
    <td width="75">&nbsp;</td>
    <td width="110" colspan="2">CON NÚMERO DE CONTROL</td>
    <td width="95" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom"><center><strong>'.$matricula.'</strong></center></td>  
    <td width="151" colspan="3" style="text-align: justify;"> &nbsp; PARA OTORGARLE EL TÍTULO DE</td>
  </tr>
  

  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="6"  style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom" align="center"><div align="center"><strong>'.$titulo.'</strong></div></td>
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
  </tr>

</table>
<table width="865" height="601" border="0" cellpadding="1" cellspacing="0" class="EstiloA">

  <tr>
    <td width="73">&nbsp;</td>
    <td width="88">&nbsp;</td>
    <td width="109" colspan="6" style="text-align: justify;">
        <div>
            UNA VEZ  VERIFICADO  QUE SE HAN CUMPLIDO ESTRICTAMENTE LOS REQUISITOS ESTABLECIDOS EN EL APARTADO IX.
            TITULACIÓN, ARTÍCULO 108, FRACCIÓN VI  DE LOS LINEAMIENTOS DE  ADMINISTRACIÓN  ESCOLAR PARA INSTITUCIONES
            EDUCATIVAS  DE RÉGIMEN PARTICULAR QUE IMPARTEN CARRERAS DE NIVEL LICENCIATURA, PARA TITULARSE  POR LA
            OPCIÓN <strong> PROMEDIO GENERAL DE CALIFICACIONES, QUE  NO EXIGE LA SUSTENTACIÓN DEL EXAMEN PROFESIONAL</strong>
            <strong>PARA LA OBTENCIÓN DEL TÍTULO,</strong> EL DIRECTOR DEL PLANTEL LE TOMÓ LA PROTESTA DE LEY EN LOS TÉRMINOS
            SIGUIENTES:
        </div>
    </td>
  </tr>
   <tr>
    <td width="73">&nbsp;</td>
    <td width="88">&nbsp;</td>
    <td width="129">&nbsp;</td>
    <td width="92">&nbsp;</td>
    <td width="124">&nbsp;</td>
    <td width="90">&nbsp;</td>
    <td width="171">&nbsp;</td>
    <td width="8">&nbsp;</td>
  </tr>
  
</table>

<table width="865" height="601" border="0" cellpadding="1" cellspacing="0" class="EstiloA">

  <tr>
    <td width="70">&nbsp;</td>
    <td width="75">&nbsp;</td>
    <td colspan="6" rowspan="3"  align="justify"><div align="justify">¿PROTESTA USTED EJERCER SU PROFESIÓN DE <strong><u>'.$titulo.'</u></strong> CON ENTUSIASMO Y HONRADEZ, VELAR SIEMPRE POR EL PRESTIGIO Y BUEN NOMBRE DE ESTA INSTITUCIÓN EDUCATIVA Y CONTINUAR  ESFORZÁNDOSE  POR  MEJORAR   SU   PREPARACIÓN   EN   TODOS   LOS   ORDENES,   PARA GARANTIZAR LOS INTERESES DEL PUEBLO Y DE LA PATRIA?</div></td>
  </tr>


</table>
<table width="865" border="0" cellpadding="0" cellspacing="0">
    <tr>
    <td width="31" height="21">&nbsp;</td>
    <td width="66">&nbsp;</td>
    <td width="132">&nbsp;</td>
    <td width="71">&nbsp;</td>
    <td width="193">&nbsp;</td>
    <td width="132">&nbsp;</td>
    <td width="145">&nbsp;</td>
    <td width="119">&nbsp;</td>
    <td width="131">&nbsp;</td>
  </tr>
   <tr>
    <td width="11" height="21">&nbsp;</td>
    <td width="66">&nbsp;</td>
    <td width="132">&nbsp;</td>
    <td width="71">&nbsp;</td>
    <td width="193">&nbsp;</td>
    <td width="132">&nbsp;</td>
    <td width="145">&nbsp;</td>
    <td width="119">&nbsp;</td>
    <td width="131">&nbsp;</td>
  </tr>
    <tr>
    <td width="11" height="21">&nbsp;</td>
    <td width="66">&nbsp;</td>
    <td width="132">&nbsp;</td>
    <td width="71">&nbsp;</td>
    <td colspan="4" align="center"><div align="center" class="Estilo5"><strong>¡Sí PROTESTO!</strong></div></td>
    <td width="131">&nbsp;</td>
  </tr>
    <tr>
    <td width="11" height="21">&nbsp;</td>
    <td width="66">&nbsp;</td>
    <td width="132">&nbsp;</td>
    <td width="71">&nbsp;</td>
    <td width="193">&nbsp;</td>
    <td width="132">&nbsp;</td>
    <td width="145">&nbsp;</td>
    <td width="119">&nbsp;</td>
    <td width="131">&nbsp;</td>
  </tr>

   <tr>
    <td height="19">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
 <tr>
    <td height="19">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4" align="center"><div align="center" class="Estilo5"><strong>'.$nombre.' '.$apaterno.' '.$amaterno.'</strong></div></td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td width="11" height="21">&nbsp;</td>
    <td width="66">&nbsp;</td>
    <td width="132">&nbsp;</td>
    <td width="71">&nbsp;</td>
    <td width="193">&nbsp;</td>
    <td width="132">&nbsp;</td>
    <td width="145">&nbsp;</td>
    <td width="119">&nbsp;</td>
    <td width="131">&nbsp;</td>
  </tr>
    <tr>
    <td width="11" height="21">&nbsp;</td>
    <td width="66">&nbsp;</td>
    <td width="132">&nbsp;</td>
    <td width="71">&nbsp;</td>
    <td width="193">&nbsp;</td>
    <td width="132">&nbsp;</td>
    <td width="145">&nbsp;</td>
    <td width="119">&nbsp;</td>
    <td width="131">&nbsp;</td>
  </tr>
   <tr>
    <td height="27">&nbsp;</td>
     <td width="66">&nbsp;</td>
     <td width="132">&nbsp;</td>
    <td colspan="6"><div class="pie"><strong><center>SI  ASÍ  LO  HICIERE,  QUE  LA  SOCIEDAD Y LA NACIÓN SE LO PREMIEN Y SI NO, SE LO DEMANDEN.</center><strong></div></td>
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
$mpdf=new mPDF('c','Letter','',''); 
//$mpdf->AddPage('L', '', '', '', '', '', '', '', '', '', '');
$mpdf->WriteHTML($html);
$mpdf->Output("Reporte_VerActaPromedio_Frente_" . $today.".pdf", 'I');

?> 

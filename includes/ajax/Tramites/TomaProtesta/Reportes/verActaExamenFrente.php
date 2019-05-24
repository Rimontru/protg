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


    $pk_alumno = $_GET['pk_alumno'];
    $CicloEscolarPromt = $_GET['CicloEscolarPromt'];


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

$autorizacion = $row[NumeroAutorizacion];
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








$html = ' 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo2 {
	font-size: 20px;
	font-weight: bold;
}

.Estilo3 {
	font-size: 28px;
	color: #FF0000;
}
.ESTILOREVOE{font-size: 17px}
.Estilo5 {font-size: 19px}
.Estilo11 {font-size: 22px; font-weight: bold; }
.Estilo13 {font-size: 18px}
.Estilo4 {font-size: 17px}
.Estilo14 {
	font-size: 24px;
	font-weight: bold;
}
.revoe {font-size: 0.96em;}
-->
</style>
</head>

<body>
<left><div class="logo" style="position: absolute; left: 71px; top: 94px;"><img src="../../../../../assets/img/escudo.gif" width="90" height="88" /></div></left>
<table width="1000" height="327" border="0">
  <tr>
    <td width="23" height="24">&nbsp;</td>
    <td width="106">&nbsp;</td>
    <td width="38">&nbsp;</td>
    <td width="322">&nbsp;</td>
    <td width="1">&nbsp;</td>
    <td width="4">&nbsp;</td>
    <td width="127">&nbsp;</td>
    <td colspan="2" align="right"><span class="Estilo5">AEP-16-'.$fechaServidor.'</span></td>
  </tr>

  <tr>
    <td colspan="2" rowspan="6"><left><div align="center"></div></left></td>
    <td height="21" colspan="6"><center class="fuente_titulo"><div align="center" class="Estilo14">GOBIERNO DEL ESTADO DE CHIAPAS</div>
    </center></td>
    <td width="151">&nbsp;</td>
  </tr>
  <tr>
    <td height="21" colspan="6"><center class="Estilo5">
      <div align="center" class="Estilo5"><strong>SECRETARÍA DE EDUCACIÓN</strong></div>
    </center></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="21" colspan="6"><center class="Estilo5">
      <div align="center" class="Estilo5"><strong>SUBSECRETARÍA DE EDUCACIÓN  ESTATAL</strong></div>
    </center></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="21" colspan="6"><center class="Estilo5"><div align="center" class="Estilo5"><strong>DIRECCIÓN DE EDUCACIÓN SUPERIOR</strong></div></center></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="21" colspan="6"><center class="Estilo5"><div align="center" class="Estilo5"><strong>DEPARTAMENTO DE SERVICIOS ESCOLARES Y BECAS</strong></div></center></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="21" colspan="6"><center class="Estilo5"><div align="center" class="Estilo5"><strong>'.$nombreInstitucion.'</strong></div></center></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="21">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="left" colspan="3"><span class="ESTILOREVOE"><strong>RVOE: '.$noacuerdo.'</strong></span></td>
    
    <td colspan="4" align="left"><span class="revoe"><strong>'.$fechaVigente.': '.$fechaExpedicion.'</strong></span></td>
    
 
 </tr>
  <tr>
    <td height="35">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4" align="center"><span class="Estilo5"><strong> REGIMEN: PARTICULAR</strong></span></td> 
    <td width="100" align="right"><div align="right" class="Estilo5">No.</div></td>
    <td style="background: #FFF url(../../../../../assets/img/Untitled-4_clip_image002.png) no-repeat left bottom"><center><div align="center" class="Estilo3">'.$folioActa.' </div>
    </center></td>
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
  </tr>
    <tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td> <td height="21">&nbsp;</td>
    <td height="21" colspan="2"><span class="Estilo13">ACTA DE EXAMEN PROFESIONAL No.</span></td>
   
    <td  align="center" style="background: #FFF url(../../assets/img/linea_larga.png) no-repeat left bottom"><span class="Estilo13">'.$NumAutorizacion.'</span></td>
   
    <td colspan="2"  align="right"><span class="Estilo13">AUTORIZACION No.</span></td>
    <td  style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom" align="center"><span class="Estilo13">'.$autorizacion.'</span></td>
  </tr>
  
  </table>
<table width="1000"  border="0" cellpadding="0" cellspacing="0">
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
    <td colspan="2" rowspan="6"><div align="center"><img src="../../../../../assets/img/foto.png" width="99" height="134" /></div></td>
    <td width="181" height="23"><span class="Estilo5">EN  LA  CIUDAD  DE:</span></td>
    <td colspan="6"  style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom"><div align="left" class="Estilo2">TUXTLA GUTIÉRREZ, CHIAPAS. 
      
    </div></td>
  </tr>
  
  
  <tr>

    <td height="25"><span class="Estilo5">SIENDO LAS :</span></td>
    <td colspan="2"  style="font-size:17px;background: #FFF url(../../../../../assets/img/Untitled-4_clip_image002.png) no-repeat left bottom"><div align="left">'.$hora.' </div>
  </td>
    <td width="169"><span class="Estilo5">HORAS DEL DIA : </span></td>
    <td colspan="7"  style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom"><div align="left" class="Estilo5"><div align="left" class="Estilo5">'.$fechaDia.'</div>
  </td>
  </tr>
  
  
  <tr>
    <td height="25" ><span class="Estilo5">DEL MES DE :</span></td>
    <td colspan="7"  style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom; height:2px;"><div align="left" class="Estilo5"><div align="left" class="Estilo5">' . $fechaMes. '</div></td>
  </tr>
  <tr>
    <td height="25"><span class="Estilo5">DEL DOS MIL</span></td>
    <td colspan="7"  style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom"><div align="left" class="Estilo5"><div align="left" class="Estilo5">' . $fechaAnioProtestaListo. '</div></td>
  </tr>
  <tr>
    <td height="22"><span class="Estilo5">EN EL SALÓN: </span></td>
    <td colspan="7"  style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom"><div align="left" class="Estilo5"><span class="Estilo5">'.$salonListo.'      </span></td>
  </tr>
  <tr>
    <td height="21" colspan="7" style="background: #FFF url(../../../../../assets/img/lineaespecial2.png) no-repeat right bottom"><div align="left" class="Estilo5">DEL<strong> '.$nombreInstitucion.'</strong></div></td>
  </tr>
  <tr>
    <td width="34" height="19">&nbsp;</td>
    <td width="152">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="45">&nbsp;</td>
    <td width="233">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="39">&nbsp;</td>
    <td width="70">&nbsp;</td>
    <td width="77">&nbsp;</td>
  </tr>
   <tr>
    <td width="34" height="19">&nbsp;</td>
    <td width="152">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="45">&nbsp;</td>
    <td width="233">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="39">&nbsp;</td>
    <td width="70">&nbsp;</td>
    <td width="77">&nbsp;</td>
  </tr>
 
   <tr>
    <td width="34" height="19">&nbsp;</td>
    <td width="152">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="45">&nbsp;</td>
    <td width="233">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="39">&nbsp;</td>
    <td width="70">&nbsp;</td>
    <td width="77">&nbsp;</td>
  </tr>
</table>
   
<table width="1000" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="5" height="25">&nbsp;</td>
    <td width="167"  align="left"><div align="left" class="Estilo5">CON CLAVE</div></td>
    <td width="186" align="left"  style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom"><div align="left" class="Estilo2">
      <div align="left" class="Estilo5">07PSU0002D</div>
    </div></td>
    <td width="77" align="right"><div align="right" class="Estilo5">TURNO:</div></td>
    <td width="93"  style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom"><div align="left" class="Estilo2">
      <div align="left" class="Estilo5"> '.$turno.'</div>
    </div></td>
    <td colspan="4"  align="right"><div align="center" class="Estilo5">
      <div align="right">SE REUNIÓ EL JURADO INTEGRADO POR LOS C.C.</div>
    </div></td>
  </tr>
  <tr>
    <td height="21">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="396">&nbsp;</td>
    <td width="27">&nbsp;</td>
    <td width="21">&nbsp;</td>
    <td width="28">&nbsp;</td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td><span class="Estilo5"><strong>PRESIDENTE:</strong></span></td>
    <td colspan="7"  style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom"><div align="left" class="Estilo2">
      <div align="left" class="Estilo5">'.$presidente.'</div>
    </div></td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td><span class="Estilo5"><strong>SECRETARIO :</strong></span></td>
    <td colspan="7"  style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom"><div align="left" class="Estilo2">
      <div align="left" class="Estilo5">'.$secretario.'</div>
    </div></td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td><span class="Estilo5"><strong>VOCAL: </strong></span></td>
    <td colspan="7"  style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom"><div align="left" class="Estilo2">
      <div align="left" class="Estilo5">'.$vocal.'</div>
    </div></td>
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
    <td height="22">&nbsp;</td>
    <td colspan="7"><span class="Estilo5">PARA REALIZAR EL EXAMEN PROFESIONAL AL (A) C. PASANTE: </span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td colspan="8" style="background: #FFF url(../../../../../assets/img/linea_larga_celda.png) no-repeat left bottom"><center>
      <div align="center" class="Estilo11">'.$nombre.' '.$apaterno.' '.$amaterno.'</div>
    </center></td>
  </tr>
  <tr>
    <td height="19">&nbsp;</td>
    <td colspan="2"><span class="Estilo5">CON NUMERO DE CONTROL:</span></td>
    <td colspan="2" align="center"  style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom"><span class="Estilo5">'.$matricula.'</span></td>
    <td colspan="4" align="right"><span class="Estilo5"></span><span class="Estilo5">A QUIEN SE EXAMINO CON BASE A LA OPCIÓN:</span></td>
  </tr>
  <tr>
    <td height="22">&nbsp;</td>
    <td colspan="8" class="Estilo5" style="background: #FFF url(../../../../../assets/img/linea_larga_celda.png) no-repeat left bottom"><center>
      <div align="center">';
          
if($opcionTitulacion=="PROMEDIO GENERAL DE CALIFICACIONES") {
$html .= "$opcionTitulacion $promedio ($letraPromedio)";
}else
{
    $html .= $opcionTitulacion;
}

$html .='
</div>
</center></td>
  </tr>
  <tr>
    <td height="22">&nbsp;</td>
    <td colspan="8" class="Estilo5" style="background: #FFF url(../../../../../assets/img/linea_larga_celda.png) no-repeat left bottom">
      <div>'.$nombreTesis.'</div>
    </center></td>
  </tr>
  <tr>
    <td height="19">&nbsp;</td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td colspan="2"><span class="Estilo5">PARA OBTENER EL TITULO DE:</span></td>
    <td colspan="6"  style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom"><div align="left" class="Estilo2">
      <center class="Estilo5">
        <div align="center" class="Estilo5">'.$titulo.'</div>
      
    </div></td>
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
    <td>&nbsp;</td>
    <td colspan="8" rowspan="3"  align="justify"><div align="justify" class="Estilo5">ACTO EFECTUADO DE ACUERDO A LAS NORMAS ESTABLECIDAS POR LA DIRECCIÓN DE  EDUCACIÓN SUPERIOR  DE  LA SUBSECRETARIA DE EDUCACIÓN ESTATAL,  UNA VEZ CONCLUIDO EL EXAMEN EL JURADO DELIBERO SOBRE LOS CONOCIMIENTOS  Y APTITUDES DEMOSTRADAS Y DETERMINO:</div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="21">&nbsp;</td>
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
    <td height="26">&nbsp;</td>
    <td colspan="8"  style="background: #FFF url(../../../../../assets/img/linea_larga_celda.png) no-repeat left bottom"><div align="left" class="Estilo2">
      <center>
      ';
        if($opcionTitulacion=="TESIS PROFESIONAL") {
$html .= '<div align="center" class="Estilo5"><strong> </strong></div>';
}else
{
    
    $html .= '<div align="center" class="Estilo5"><strong>APROBARLO</strong></div>';
}
     $html .=   '
      </center>
    </div></td>
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
    <td height="23">&nbsp;</td>
    <td colspan="8" rowspan="6"  align="justify"><p align="justify" class="Estilo5">A    CONTINUACIÓN    EL     PRESIDENTE    DEL    JURADO    COMUNICO   AL   (A)   C.   SUSTENTANTE EL RESULTADO  OBTENIDO  Y   LE   TOMO    LA  PROTESTA  DE   LEY  EN  LOS   TÉRMINOS    SIGUIENTES: ¿PROTESTA      USTED      EJERCER    SU  PROFESIÓN  DE<strong> '.$titulo.' </strong> CON    ENTUSIASMO Y   HONRADEZ. VELAR   SIEMPRE   POR  EL PRESTIGIO Y   BUEN NOMBRE DE  ESTA ESCUELA Y      CONTINUAR     ESFORZÁNDOSE     POR      MEJORAR  SU  PREPARACIÓN EN TODOS LOS ORDENES, PARA  GARANTIZAR LOS INTERESES DEL PUEBLO Y DE LA PATRIA?</p></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="21">&nbsp;</td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td colspan="6"><center>
      <div align="center" class="Estilo5"><strong>¡SI PROTESTO!</strong></div>
    </center></td>
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
</table>
<table width="1000" border="0" cellpadding="0" cellspacing="0">
  
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
    <td colspan="3" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
 
 
  <tr>
    <td height="23">&nbsp;</td>
    <td colspan="8"><center>
      <div align="center" class="Estilo5"><strong>'.$nombre.' '.$apaterno.' '.$amaterno.'</strong></div>
    </center></td>
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
    <td height="27">&nbsp;</td>
    <td colspan="8"  class="Estilo5"><center>SI  ASÍ  LO  HICIERE,  QUE  LA  SOCIEDAD Y LA NACIÓN SE LO PREMIEN Y SI NO, SE LO DEMANDEN.</center></td>
  </tr>
</table>
</body>
</html>';




   
        
        
        
        
        
        
    }
} else {
    $html = "Lo Sentimos No Se Pudo Realizar la Consulta";
}
//echo $html;
ob_start();
$mpdf=new mPDF('c','Legal','',''); 
//$mpdf->AddPage('L', '', '', '', '', '', '', '', '', '', '');
$mpdf->WriteHTML($html);
$mpdf->Output("Reporte_ActaExamen_Frente" . $today . ".pdf" , "I");

?> 

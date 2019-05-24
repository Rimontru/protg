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

<table width="1000" border="0"  cellpadding="-2" cellspacing="-2" style="border-collapse: collapse;">
                <tr>
                    <td width="145" height="21">&nbsp;</td>

                    <td height="78" colspan="9"  align="justify">
                    <div  class="Estilo6">
                      TERMINADO EL ACTO PROTOCOLARIO SE LEVANTA PARA CONSTANCIA LA PRESENTE ACTA, FIRMANDO DE CONFORMIDAD LOS QUE EN ÉL INTERVINIERON Y QUE DAN FE.
                    </div>
                    </td>   
                </tr>                
                  <tr>
                    <td width="145" height="21">&nbsp;</td>
             
                    <td width="131">&nbsp;</td>
                    <td width="80">&nbsp;</td>
                    <td width="100">&nbsp;</td>
                    <td width="80">&nbsp;</td>
					<td width="93">&nbsp;</td>	
                    <td width="93">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="21">&nbsp;</td>
                    
                    <td height="21" colspan="3"  align="center"><div align="center" class="Estilo5"><strong>DIRECTOR DEL PLANTEL</strong></div></td>
                    <td>&nbsp;</td>
                    <td height="21" colspan="4"  align="center"><div align="center" class="Estilo5"><strong>RESPONSABLE DE SERVICIOS<br>ESCOLARES DEL PLANTEL</strong></div></td>
                  </tr>
                  <tr>
                    <td height="21">&nbsp;</td>
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
                    <td height="21">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td height="21" colspan="3" align="center"><div align="center"></div></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td colspan="3" align="center"><div align="center"></div></td>
                  </tr>
                  <tr>
                    <td height="21">&nbsp;</td>
                    
                    <td height="21" colspan="3" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom"></td>
                    <td>&nbsp;</td>
                    <td class="Estilo19" colspan="4" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom"></center></td>
                  </tr>
                  <tr>
                   <tr>
                    <td height="21">&nbsp;</td>
                    
                    <td height="21" colspan="3"  align="center"><div align="center"><center><span class="Estilo19">'.$nombreDirector.'</span></center></div></td>
                    <td>&nbsp;</td>
                    <td height="21" colspan="4"  align="center"><div align="center" class="Estilo19"><center>LAE. FLORIBEL MEGCHUN DE LA CRUZ</div></td>
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
                                      <td height="21" colspan="4">&nbsp;</td>
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
                    
                    <td height="21" colspan="3"><div align="lefth" class="Estilo5"><center>JEFE DEL DEPARTAMENTO DE SERVICIOS ESCOLARES Y BECAS</center></div></td>
                    <td>&nbsp;</td>
                    <td height="21" colspan="4"><div align="lefth" class="Estilo5"><center>DIRECTOR DE EDUCACIÓN SUPERIOR<center></div></td>
                   </tr>

                  <tr>
                    <td height="21">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td height="21" colspan="3"></td>
                    <td>&nbsp;</td>
                    <td colspan="3">&nbsp;</td>
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
                    <td height="21">&nbsp;</td>
                    
                    <td height="21" colspan="3" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom"><span class="Estilo2"></span></td>
                    <td>&nbsp;</td>
                    <td colspan="4" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom">&nbsp;</td>
                  </tr>
                   <tr>
                    <td height="21">&nbsp;</td>
                   
                    <td height="21" colspan="3"  align="center"><div align="center" class="Estilo2">ING. JULIO MONTERO MEDEROS</div></td>
                    <td>&nbsp;</td>
                    <td height="21" colspan="4"  align="center"><div align="center" class="Estilo2">&nbsp;<!--DR. LUIS MADRIGAL FR&iacute;AS--></div></td>
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
                    <td width="145">&nbsp;</td>
                    <td width="68">&nbsp;</td>
                    <td width="131">&nbsp;</td>
                    <td width="80">&nbsp;</td>
                    <td width="100">&nbsp;</td>
                    <td width="80">&nbsp;</td>
                    <td width="93">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                 
</table>
<table width="1000" border="0" style="border-collapse: collapse;">

  <tr>
    <td width="57">&nbsp;</td>
    <td width="58">&nbsp;</td>
    <td width="53">&nbsp;</td>
    <td width="71">&nbsp;</td>
    <td width="12">&nbsp;</td>
    <td width="31">&nbsp;</td>
    <td width="210">&nbsp;</td>
    <td width="95">&nbsp;</td>
    <td width="8">&nbsp;</td>
    <td width="76">&nbsp;</td>
    <td width="106">&nbsp;</td>
    <td width="55">&nbsp;</td>
    <td width="25">&nbsp;</td>
    <td width="75">&nbsp;</td>
  </tr>
    <tr>
    <td width="57">&nbsp;</td>
    <td width="58">&nbsp;</td>
    <td width="53">&nbsp;</td>
    <td width="71">&nbsp;</td>
    <td width="22">&nbsp;</td>
    <td width="31">&nbsp;</td>
    <td width="210">&nbsp;</td>
    <td width="95">&nbsp;</td>
    <td width="8">&nbsp;</td>
    <td width="76">&nbsp;</td>
    <td width="106">&nbsp;</td>
    <td width="55">&nbsp;</td>
    <td width="25">&nbsp;</td>
    <td width="75">&nbsp;</td>
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
    <td colspan="5" rowspan="3" style="text-align: justify;" class="Estilo51">
            POR ACUERDO DEL SECRETARIO GENERAL DE GOBIERNO Y CON
            FUNDAMENTO EN  EL ARTÍCULO 28, FRACCIÓN  X  DE LA LEY  
            ORGÁNICA DE LA ADMINISTRACIÓN PÚBLICA  DEL ESTADO DE
            CHIAPAS, SE LEGALIZA, PREVIO COTEJO CON LA QUE EXISTE
            EN EL CONTROL RESPECTIVO LA FIRMA QUE ANTECEDE, QUE
            CORRESPONDE AL DIRECTOR DE EDUCACIÓN SUPERIOR.

    </td>
  </tr>
  <tr>
    <td colspan="4" rowspan="3" align="center" style="border-width: 1px;border: solid;" ><div align="center"><strong>REGISTRADO EN EL</strong></div>      <div align="center"><span class="Estilo4">DEPARTAMENTO DE SERVICIOS</span></div>      <div align="center"><strong>ESCOLARES Y BECAS</strong></div></td>
    <td height="22">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="21">&nbsp;</td>
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
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" rowspan="4"  style="border-width: 1px;border: solid;"><table width="249" border="0">
      <tr>
        <td width="77" ><span class="fojas"><strong>CON No. </strong></span></td>
        <td width="162" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom"><div align="center"><span class="Estilo16"><span class="Estilo19"></span></span></div></td>
      </tr>
      <tr>
        <td><span class="fojas"><strong>LIBRO: </strong></span></td>
        <td style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom"><div align="center"><span class="Estilo16"><span class="Estilo19"></span></span></div></td>
      </tr>
      <tr>
        <td><span class="fojas"><strong>A FOJAS: </strong></span></td>
        <td style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom"><div align="center"><span class="Estilo16"><span class="Estilo19"></span></span></div></td>
      </tr>
      <tr>
        <td height="22"><span class="fojas"><strong>FECHA:</strong></span></td>
        <td style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom"><div align="center"><span class="Estilo16"><span class="Estilo19"></span></span></div></td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="5" align="center"><div align="center"><span class="Estilo2"><strong>&nbsp;<!--DR. LUIS MADRIGAL FR&iacute;AS--></strong></span></div></td>
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
    <td colspan="3" class="estilo0" style="text-align: justify;">Tuxtla Gutiérrez, Chiapas, a </td>
    <td colspan="3" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom">&nbsp;</td>
  </tr>
  <tr>
    <td height="21">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="5" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left bottom"></td>
  </tr>
  <tr>
    <td colspan="4"  align="center"  style="border-width: 1px;border: solid;" ><div align="center" class="Estilo2"><strong>COTEJO</strong></div></td>
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
    <td colspan="4" rowspan="2"  style="border-width: 1px;border: solid;">&nbsp;</td>
    <td height="25">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="5" align="center" ><span class="estilo0">SUBSECRETARIO DE ASUNTOS JURÍDICOS</span></td>
  </tr>
    <tr>
    <td height="40">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="7" align="center" >&nbsp;</td>
  </tr>
  <tr>
    <td height="24" colspan="4"  style="border-width: 1px;border: solid;"  align="center" ><div align="center"><span class="Estilo2"><strong>JEFE DE LA OFICINA</strong></span></div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="5" class="estilo0" style="background: #FFF url(../../../../../assets/img/linea_larga.png) no-repeat left top"><center><strong>LIC. JOSE RAMON CANCINO IBARRA</strong></center></td>
  </tr>
  <tr>
    <td colspan="4" rowspan="2"  style="border-width: 1px;border: solid;">&nbsp;</td>
    <td height="25">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="7" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="7">&nbsp;</td>
  </tr>

</table>
<div style="position: absolute; left: 190px; top: 992px;" class="Estilo41"><center>ESTE DOCUMENTO NO ES VÁLIDO SI PRESENTA RASPADURAS O ENMENDADURAS.</center></div>
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
$mpdf->Output("Reporte_VerActaPromedio_Atras_" . $today.".pdf", 'I');

?> 
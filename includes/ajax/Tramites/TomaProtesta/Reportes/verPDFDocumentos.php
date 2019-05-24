<?php

require_once("../../../../../includes/Config.class.php");  # Cargar datos conexion y otras variables.
require_once('../../../../../includes/DB.class.php');
require_once('../../../../../includes/ConsultaDB.class.php');
require_once('../../../../../mpdf/mpdf.php');
require_once('../../../../../includes/MisFunciones.class.php');

$Obras = new ConsultaDB;
$Funciones = new MisFunciones();

$today = date("d-m-Y");
$todayMod = date("d/m/Y");
if (isset($_GET['pk_alumno'])) {
    $pk_alumno = $_GET['pk_alumno'];
    $FolioPago = $_GET['FolioPago'];


    

    
    
    
    
    
    
       //DATOS DE LA ESCUELA
    $Result32 = $Obras->ConsultaDatosInsitucionConEstados();
    if ($Result32) {
        $row333 = mysql_fetch_assoc($Result32);

        $nombreInstitucion = strtoupper($row333['nombreInstitucion']);
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
        $lemaescuela = strtoupper($row333['lemaEscuela']);
    }
    
    
    
    
    
    

    $result = $Obras->ConReporteDocumentacionAlumnosPorLlavePrimaria($pk_alumno);
    if ($result) {
        while ($row = mysql_fetch_assoc($result)) {

     $fk_carreras=$row[fk_carreras];
      $Result22 = $Obras->verTrabajadoresDirectoresReportes($fk_carreras);
    if ($Result22) {
        $row222 = mysql_fetch_assoc($Result22);
        $nombreDirector=  ($row222[nombre]." ".$row222[apaterno]." ".$row222[amaterno]);
        $carreraReporte=  ($row222[nombreCarrera]);
        $genero = $row222[fk_genero];
        mysql_free_result($Result22);
    }
    
    /*if($row[pk_sinodal]!="1092"){*/
        $suplente=$row[NombreSuplente];
        $cedulaSuplente=$row[CedulaSuplente];
    /*}else{
        $suplente="";
        $cedulaSuplente="";
        }*/

  if($row[TipoRevoe]=='1'){
            
            $fechaVigente="FECHA ";
        }else if($row[TipoRevoe]=='2'){
            $fechaVigente="VIGENTE ";
        }else if ($row[TipoRevoe]=='0'){
            $fechaVigente="COLOCAR FECHA O VIGENTE";
        }

//$FechaTomaProtesta = strftime("%Y-%m-%d", time());
$FechaTomaProtesta = $row['FechaTomaProtesta'];
$FechaTomaProtestaModificar = explode("-", $FechaTomaProtesta);
$FechaTomaProtestaLista = $FechaTomaProtestaModificar[2] . "-" . $FechaTomaProtestaModificar[1] . "-" . $FechaTomaProtestaModificar[0];
    
            
            
            $html.='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo15 {font-size: 9px}
-->
</style>
</head>

<style type="text/css">
<!--
.Estilo5 {font-size: 12px}
.Estilo7 {
	font-size: 10px;
	font-weight: bold;
}
.Estilo8 {
	font-size: 12px;
	font-weight: bold;
}
.Estilo10 {font-size: 9px}
.Estilo11 {font-size: 14px; font-weight: bold; }
.Estilo17 {font-size: 9px; font-weight: bold; }
.Estilo18 {
	font-size: 13px;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<table width="785" border="0" style="border-collapse: collapse;">
  <tr>
    <td colspan="12"><div align="center" class="Estilo18">'.$nombreInstitucion.'</div></td>
  </tr>
  <tr>
    <td colspan="12"><div align="center" class="Estilo18">LICENCIATURA EN: '.$carreraReporte.'</div></td>
  </tr>
  <tr>
    <td colspan="12"><div align="center" class="Estilo18">CLAVE: '.$clave.'</div></td>
  </tr>
  <tr>
    <td colspan="12" bgcolor="#CCCCCC"><div align="center" class="Estilo8">SOLICITUD PARA TRAMITE DE EXAMEN PROFESIONAL</div></td>
  </tr>
  
  <tr>
    <td colspan="5"><span class="Estilo5"><strong>LIC. FLORIBEL MEGCHUN DE LA CRUZ</strong></span></td>
    <td width="61"><span class="Estilo5"></span></td>
    <td width="61"><span class="Estilo5"></span></td>
    <td width="61"><span class="Estilo5"></span></td>
    <td colspan="2"><div align="right" class="Estilo5"><strong>FECHA</strong>:</div></td>
    <td colspan="2"><div align="left" class="Estilo5">'.$todayMod.'</div></td>
  </tr>
  <tr>
    <td colspan="5"><span class="Estilo7">DIRECTORA DE SERVICIOS ESCOLARES</span></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="44">&nbsp;</td>
    <td width="45">&nbsp;</td>
    <td width="61">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><span class="Estilo8">NOMBRE DEL SUSTENTANTE:</span></td>
    <td colspan="3"><div align="center" class="Estilo8">'.$row[NombreAlumno].'</div></td>
    <td colspan="3"><div align="center" class="Estilo8">'.$row[ApaternoAlumno].'</div></td>
    <td colspan="3"><div align="center" class="Estilo8">'.$row[AmaternoAlumno].'</div></td>
  </tr>
  <tr>
    <td width="37">&nbsp;</td>
    <td width="77">&nbsp;</td>
    <td width="80">&nbsp;</td>
    <td colspan="3"><div align="center"><strong><span class="Estilo10">NOMBRE(S)</span></strong></div></td>
    <td colspan="3"><div align="center"><strong><span class="Estilo10">APELLIDO PATERNO</span></strong></div></td>
    <td colspan="3"><div align="center"><strong><span class="Estilo10">APELLIDO MATERNO</span></strong></div></td>
  </tr>
  <tr>
    <td colspan="4"><span class="Estilo8">NOMBRE DEL DOCUMENTO RECEPCIONAL</span></td>
    <td colspan="8"><div align="center"><span class="Estilo11">'.$row[NombreOpcionTitulacion].'</span></div></td>
  </tr>
  <tr>
    <td colspan="5"><span class="Estilo8">FECHA DE EXAMEN PROFESIONAL: </span><span class="Estilo15">'.$FechaTomaProtestaLista.'</span></td>
    <td><div align="right"><span class="Estilo8">HORA:</span></div></td>
    <td><span class="Estilo15">'.$row[hora].'</span></td>
    <td>&nbsp;</td>
    <td colspan="4"><div align="right" class="Estilo8">
      <div align="left">SALON: '.$row[salon].'</div>
    </div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="71"><span class="Estilo7"> DD / MM /AA</span></td>
    <td width="73">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td colspan="12" bgcolor="#CCCCCC"><div align="center" class="Estilo5"><strong>JURADO</strong></div>
    <div align="center"></div></td>
  </tr>
 
  <tr>
    <td colspan="3"><div align="center" class="Estilo5"><strong>CARGO</strong></div></td>
    <td colspan="6"><div align="center" class="Estilo5"><strong>NOMBRE</strong></div></td>
    <td colspan="3"><div align="center" class="Estilo5"><strong>No. CEDULA</strong></div></td>
  </tr>
  <tr>
    <td colspan="3"><span class="Estilo15"><strong>PRESIDENTE:</strong></span></td>
    <td colspan="6"><div align="left" class="Estilo5">'.$row[NombrePresidente].'</div></td>
    <td colspan="3"><div align="center" class="Estilo5">'.$row[CedulaPresidente].'</div></td>
  </tr>
  <tr>
    <td colspan="3"><span class="Estilo15"><strong>SECRETARIO:</strong></span></td>
    <td colspan="6"><div align="left" class="Estilo5">'.$row[NombreSecretario].'</div></td>
    <td colspan="3"><div align="center" class="Estilo5">'.$row[CedulaSecretario].'</div></td>
  </tr>
  <tr>
    <td colspan="3"><span class="Estilo15"><strong>VOCAL:</strong></span></td>
    <td colspan="6"><div align="left" class="Estilo5">'.$row[NombreVocal].'</div></td>
    <td colspan="3"><div align="center" class="Estilo5">'.$row[CedulaVocal].'</div></td>
  </tr>
  <tr>
    <td colspan="3"><span class="Estilo15"><strong>SUPLENTE:</strong></span></td>
    <td colspan="6"><div align="left" class="Estilo5">'.$suplente.'</div></td>
    <td colspan="3"><div align="center" class="Estilo5">'.$cedulaSuplente.'</div></td>
  </tr>
  
  <tr>
    <td colspan="12" bgcolor="#CCCCCC"><div align="center" class="Estilo8">SE ANEXA LA SIGUIENTE DOCUMENTACION</div></td>
  </tr>
   
  
    <tr>
    <td><form id="form2" name="form1" method="post" action="">
      <label>
      <div align="center">
        <input type="checkbox" name="checkbox19" id="checkbox19" />
      </div>
      </label>
    </form></td>
    <td colspan="11"><div align="left"><span class="Estilo15">SOLICITUD DE EXPEDICION DE TITULO PROFESIONAL REQUISITADA (ORIGINAL Y COPIA)</span></div></td>
  </tr>
    <tr>
    <td><form id="form3" name="form1" method="post" action="">
      <label>
      <div align="center">
        <input type="checkbox" name="checkbox20" id="checkbox20" />
      </div>
      </label>
    </form></td>
    <td colspan="11"><div align="left"><span class="Estilo15">ACTA DE NACIMIENTO ACTUALIZADA (ORIGINAL Y COPIA)</span></div></td>
  </tr>
    <tr>
    <td><form id="form4" name="form1" method="post" action="">
      <label>
      <div align="center">
        <input type="checkbox" name="checkbox21" id="checkbox21" />
      </div>
      </label>
    </form></td>
    <td colspan="11"><div align="left"><span class="Estilo15">CERTIFICADO DE BACHILLERATO (<span class="Estilo10"> (ORIGINAL Y COPIA </span> EN REDUCCION T/ CARTA)</span></div></td>
  </tr>
    <tr>
    <td><form id="form5" name="form1" method="post" action="">
      <label>
      <div align="center">
        <input type="checkbox" name="checkbox22" id="checkbox22" />
      </div>
      </label>
    </form></td>
    <td colspan="11"><div align="left"><span class="Estilo15">CERTIFICADO PROFESIONAL <span class="Estilo10"> (ORIGINAL Y COPIA </span> EN REDUCCION T/ CARTA)</span></div></td>
  </tr>
  <tr>
    <td><form id="form6" name="form1" method="post" action="">
      <label>
      <div align="center">
        <input type="checkbox" name="checkbox23" id="checkbox23" />
      </div>
      </label>
    </form></td>
    <td colspan="11"><div align="left"><span class="Estilo15">CONSTANCIA DE SERVICIO SOCIAL<span class="Estilo10"> (ORIGINAL Y COPIA)</span></span></div></td>
  </tr>
  <tr>
    <td><form id="form7" name="form1" method="post" action="">
      <label>
      <div align="center">
        <input type="checkbox" name="checkbox24" id="checkbox24" />
      </div>
      </label>
    </form></td>
    <td colspan="11"><div align="left"><span class="Estilo15">04 FOTOGRAFIAS TAMAÑO CREDENCIAL</span></div></td>
  </tr>
  <tr>
    <td><form id="form8" name="form1" method="post" action="">
      <label>
      <div align="center">
        <input type="checkbox" name="checkbox25" id="checkbox25" />
      </div>
      </label>
    </form></td>
    <td colspan="11"><div align="left"><span class="Estilo15">04 FOTOGRAFIAS TAMANO DIPLOMA</span></div></td>
  </tr>
    <tr>


    <td><form id="form9" name="form1" method="post" action="">
      <label>
      <div align="center">
        <input type="checkbox" name="checkbox26" id="checkbox26" />
      </div>
      </label>
    </form></td>
    <td colspan="11"><div align="left"><span class="Estilo15">BOLETA DE PAGO DE HDA. POR EXPEDICION DE CERTIFICADOS DE GRADOS(ORIGINAL Y COPIA)</span></div></td>
  </tr>
    <tr>
    <td><form id="form10" name="form1" method="post" action="">
      <label>
      <div align="center">
        <input type="checkbox" name="checkbox27" id="checkbox27" />
      </div>
      </label>
    </form></td>
    <td colspan="11"><div align="left"><span class="Estilo15">BOLETA DE PAGO DE HDA. POR BUSQUEDA, COTEJO Y CERTIFICACION DE DOC DE ARCHIVO (ORIGINAL Y COPIA)</span></div></td>
  </tr>
  <tr>
    <td><form id="form11" name="form1" method="post" action="">
      <label>
      <div align="center">
        <input type="checkbox" name="checkbox28" id="checkbox28" />
      </div>
      </label>
    </form></td>
    <td colspan="11"><div align="left"><span class="Estilo15">BOLETA DE PAGO DE HDA.  POR EXP DE CERTIFICADOS DE GRADO, LEGALIZACION DE TITULOS (ORIGINAL Y COPIA)</span></div></td>
  </tr>
  <tr>
    <td><form id="form12" name="form1" method="post" action="">
      <label>
      <div align="center">
        <input type="checkbox" name="checkbox29" id="checkbox29" />
      </div>
      </label>
    </form></td>
    <td colspan="11"><div align="left"><span class="Estilo15">2 BOLETAS DE PAGOS DE HDA. DEL EDO. POR LEG. DE FIRMA DE DOC. OFIC. CON FIRMAS DE FUN. PUB. (ORIG. Y COPIA)</span></div></td>
  </tr>
  <tr>
    <td><form id="form13" name="form1" method="post" action="">
      <label>
      <div align="center">
        <input type="checkbox" name="checkbox30" id="checkbox30" />
      </div>
      </label>
    </form></td>
    <td colspan="11"><div align="left"><span class="Estilo15">BOLETA DE PAGO DE HDA. DEL EDO. POR CONF. EXPED. Y REG. DE TITULO PROF. (ORIGINAL Y COPIA)</span></div></td>
  </tr>
  <tr>
    <td><form id="form14" name="form1" method="post" action="">
      <label>
      <div align="center">
        <input type="checkbox" name="checkbox31" id="checkbox31" />
      </div>
      </label>
    </form></td>
    <td colspan="11"><div align="left"><span class="Estilo15">BOLETA DE PAGO IESCH POR TRAMITE DE EXAMEN PROF. ( ORIGINAL Y COPIA)<strong> No. FOLIO: '.$FolioPago .'<strong></span></div></td>
  </tr>
  
   <tr>
    <td><form id="form15" name="form1" method="post" action="">
      <label>
      <div align="center">
        <input type="checkbox" name="checkbox32" id="checkbox32" />
      </div>
      </label>
    </form></td>
    <td colspan="11"><div align="left"><span class="Estilo15">PAGO DEL CURSO DE TITULACION (EN SU CASO)</span></div></td>
  </tr>
  
  <tr>
    <td><form id="form15" name="form1" method="post" action="">
      <label>
      <div align="center">
        <input type="checkbox" name="checkbox32" id="checkbox32" />
      </div>
      </label>
    </form></td>
    <td colspan="11"><div align="left"><span class="Estilo15">BOLETA DE PAGO POR ASESORIA DE TESIS (EN SU CASO) (ORIGINAL Y COPIA)</span></div></td>
  </tr>
  
  
    <tr>
    <td><form id="form15" name="form1" method="post" action="">
      <label>
      <div align="center">
        <input type="checkbox" name="checkbox32" id="checkbox32" />
      </div>
      </label>
    </form></td>
    <td colspan="11"><div align="left"><span class="Estilo15">PAGO DE EXAMEN CENEVAL Y/O POR AREAS DE CONOCIMIENTO (INSTITUCIONAL) (EN SU CASO)</span></div></td>
  </tr>
  
  
  <tr>
    <td><form id="form15" name="form1" method="post" action="">
      <label>
      <div align="center">
        <input type="checkbox" name="checkbox32" id="checkbox32" />
      </div>
      </label>
    </form></td>
    <td colspan="11"><div align="left"><span class="Estilo15">CONSTANCIA DE NO ADEUDO DE COLEGIATURAS  Y CONSTANCIA DE NO ADEUDO DE BIBLIOTECA DE </span><span class="Estilo15">LICENCIATURA</span></div></td>
  </tr>
   <tr>
    <td><form id="form17" name="form1" method="post" action="">
      <label>
      <div align="center">
        <input type="checkbox" name="checkbox34" id="checkbox34" />
      </div>
      </label>
    </form></td>
    <td colspan="11"><div align="left"><span class="Estilo15">CONSTANCIA DE NO ADEUDO DEL CURSO DE TITULACION (EN SU CASO)(ORIGINAL Y COPIA)</span></div></td>
  </tr>
   
  
   <tr>
    <td><form id="form15" name="form1" method="post" action="">
      <label>
      <div align="center">
        <input type="checkbox" name="checkbox32" id="checkbox32" />
      </div>
      </label>
    </form></td>
    <td colspan="11"><div align="left"><span class="Estilo15">CONSTANCIA DE NO ADEUDO DE COLEGIATURAS  Y CONST. DE NO ADEUDO DE BIBLIOTECA DE </span><span class="Estilo15">MAESTRIA</span> <span class="Estilo15">(ORIGINAL Y COPIA)</span></div></td>
  </tr>
  
  
  
     <tr>
    <td><form id="form15" name="form1" method="post" action="">
      <label>
      <div align="center">
        <input type="checkbox" name="checkbox32" id="checkbox32" />
      </div>
      </label>
    </form></td>
    <td colspan="11"><div align="left"><span class="Estilo15">(EN SU CASO) CONSTANCIA DE LIBERACION DE TESIS O MEMORIA </span><span class="Estilo15">(ORIGINAL Y COPIA)</span></div></td>
  </tr>
  
  
    
  
     <tr>
    <td><form id="form15" name="form1" method="post" action="">
      <label>
      <div align="center">
        <input type="checkbox" name="checkbox32" id="checkbox32" />
      </div>
      </label>
    </form></td>
    <td colspan="11"><div align="left"><span class="Estilo15">ACREDITACION DE EXAMEN CENEVAL Y/O POR AREAS DE CONOCIMIENTO (INSTITUCIONAL)</span><span class="Estilo15"></span> <span class="Estilo15">(ORIGINAL Y COPIA)</span></div></td>
  </tr>
  
    <tr>
    <td><form id="form15" name="form1" method="post" action="">
      <label>
      <div align="center">
        <input type="checkbox" name="checkbox32" id="checkbox32" />
      </div>
      </label>
    </form></td>
    <td colspan="11"><div align="left"><span class="Estilo15">(EN SU CASO) CERTIFICADO PARCIAL DEL 50% DE MAESTRIA CURSADA EN OTRA INSTITUCION</span><span class="Estilo15"></span> <span class="Estilo15">(ORIGINAL Y COPIA)</span></div></td>
  </tr>
  
  
  
   <tr>
    <td><form id="form15" name="form1" method="post" action="">
      <label>
      <div align="center">
        <input type="checkbox" name="checkbox32" id="checkbox32" />
      </div>
      </label>
    </form></td>
    <td colspan="11"><div align="left"><span class="Estilo15">(EN SU CASO) CONSTANCIA LEGALIZADA DEL 50% DE MAESTRIA CURSADA EN EL IESCH</span><span class="Estilo15"></span> <span class="Estilo15">(ORIGINAL Y COPIA)</span></div></td>
  </tr>
  
  <tr>
    <td><form id="form15" name="form1" method="post" action="">
      <label>
      <div align="center">
        <input type="checkbox" name="checkbox32" id="checkbox32" />
      </div>
      </label>
    </form></td>
    <td colspan="11"><div align="left"><span class="Estilo15">(EN SU CASO) CERTIFICADO DEL 100% DE ESPECIALIDAD CURSADA EN OTRA INSTITUCION</span><span class="Estilo15"></span> <span class="Estilo15">(ORIGINAL Y COPIA)</span></div></td>
  </tr>
  
  <tr>
    <td><form id="form15" name="form1" method="post" action="">
      <label>
      <div align="center">
        <input type="checkbox" name="checkbox32" id="checkbox32" />
      </div>
      </label>
    </form></td>
    <td colspan="11"><div align="left"><span class="Estilo15">(EN SU CASO) CERTIFICADO DEL 100% DE ESPECIALIDAD CURSADA EN EL IESCH </span><span class="Estilo15"></span> <span class="Estilo15">(ORIGINAL Y COPIA)</span></div></td>
  </tr>
  
  
  
  
   <tr>
    <td><form id="form15" name="form1" method="post" action="">
      <label>
      <div align="center">
        <input type="checkbox" name="checkbox32" id="checkbox32" />
      </div>
      </label>
    </form></td>
    <td colspan="11"><div align="left"><span class="Estilo15">(EN SU CASO) POR PROMEDIO GENERAL, ANEXAR CONST.  EXP POR LA DIRECC DE LA CARRERA</span><span class="Estilo15"></span> <span class="Estilo15">(ORIGINAL Y COPIA)</span></div></td>
  </tr><tr>
    <td><form id="form19" name="form1" method="post" action="">
      <label>
      <div align="center">
        <input type="checkbox" name="checkbox36" id="checkbox36" />
      </div>
      </label>
    </form></td>
    <td colspan="11"><div align="left"><span class="Estilo15">CURP( COPIA)</span></div></td>
  </tr>
  <tr>
    <td><form id="form20" name="form1" method="post" action="">
      <label>
      <div align="center">
        <input type="checkbox" name="checkbox36" id="checkbox36" />
      </div>
      </label>
    </form></td>
    <td colspan="11"><div align="left"><span class="Estilo15">CONSTANCIA DE LOS 4 NIVELES DE INGLES</span></div></td>
  </tr>
  

    
  <tr>
    <td>&nbsp;</td>
    <td colspan="11"><span class="Estilo17">NOTA:EN CASO DE TITULACION POR PROMEDIO, CENEVAL, MAESTRIA O ESPECIALIDAD, ANEXAR COMPROBANTE CORRESPONDIENTE.</span></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td><span class="Estilo5"></span></td>
    <td><span class="Estilo5"></span></td>
    <td colspan="5"><div align="center" class="Estilo5">ATENTAMENTE</div></td>
    <td><span class="Estilo5"></span></td>
    <td><span class="Estilo5"></span></td>
    <td><span class="Estilo5"></span></td>
    <td><span class="Estilo5"></span></td>
  </tr>
    
  <tr>
    <td>&nbsp;</td>
    <td><span class="Estilo5"></span></td>
    <td><span class="Estilo5"></span></td>
    <td colspan="5"><div align="center" class="Estilo8">'.$nombreDirector.'</div></td>
    <td><span class="Estilo5"></span></td>
    <td><span class="Estilo5"></span></td>
    <td><span class="Estilo5"></span></td>
    <td><span class="Estilo5"></span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><span class="Estilo5"></span></td>
    <td colspan="8"><span class="Estilo5"></span>';
    
    if($genero== "2"){ //femenino
        
         $html .= '<div align="center" class="Estilo5">DIRECTORA DE '.$carreraReporte.'</div>';      
    }
    if($genero == "1"){ //masculino
        
         $html .= '<div align="center" class="Estilo5">DIRECTOR DE '.$carreraReporte.'</div>';  
    }
   
        
  $html .=  '<span class="Estilo5"></span><span class="Estilo5"></span></td>
    <td><span class="Estilo5"></span></td>
    <td><span class="Estilo5"></span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="5"><span class="Estilo15">REVISO: KARLA SHOMERLY PEREZ CORDOVA</span></td>
  </tr>
</table>


</body>
</html>


';

  
  
  
        }
        mysql_free_result($result);
        //obtenemos la fecha de aplicacion
//        $fechaLetras = $Funciones->Fecha2($fechaaplicacion);
    }
} else {
    $html = "Lo Sentimos No Se Pudo Realizar la Consulta";
}
echo $html;
//ob_start();
//$mpdf = new mPDF();
////$mpdf->AddPage('L', '', '', '', '', '', '', '', '', '', '');
//$mpdf->WriteHTML($html);
//$mpdf->Output("Reporte_Constancia_" . $today .".pdf",'D');
?> 
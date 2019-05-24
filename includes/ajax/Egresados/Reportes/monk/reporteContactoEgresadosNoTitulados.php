<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename= Contacto_Egresados_No_Titulados.xls");

require_once("../../../../../includes/Config.class.php");  # Cargar datos conexion y otras variables.
require_once('../../../../../includes/DB.class.php');
require_once('../../../../../includes/ConsultaDB.class.php');
require_once('../../../../../mpdf/mpdf.php');
require_once('../../../../../includes/MisFunciones.class.php');
date_default_timezone_set('America/Mexico_City');



$Obras = new ConsultaDB;
$Funciones = new MisFunciones();
$today = date("d-m-Y");
$fecha=date("d/m/Y"); 

if ( isset($_GET) && !empty($_GET) ) {

$fk_nivelestudio    = $_GET['fk_nivelestudio'];
$fk_modalidad       = $_GET['fk_modalidad'];
$fk_carreras        = $_GET['fk_carreras'];

    $Result22 = $Obras->verTrabajadoresDirectoresReportes($fk_carreras);
    if ($Result22) {
        $row222 = mysql_fetch_assoc($Result22);
        $nombreDirector = ($row222[NombreCompletoDirector]);
        $carreraReporte = ($row222[nombreCarrera]);

        mysql_free_result($Result22);
    }


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
        $lemaescuela = $row333['lemaEscuela'];
    }


    if($fk_modalidad=="1"){
        $ModalidadReporte="SEMESTRAL";
         }else  if($fk_modalidad=="2"){
        $ModalidadReporte="CUATRIMESTRAL";
         }else if($fk_modalidad=="3"){
        $ModalidadReporte="TRIMESTRAL";
         }else if($fk_modalidad=="4"){
        $ModalidadReporte="PENTAMESTRAL";
    }

   $arrayGen = NULL;

   if ( $result33 = $Obras->ConObtenerGeneracionesTodas($fk_nivelestudio, $fk_modalidad, $fk_carreras) ){
      while ( $row33 = mysql_fetch_assoc($result33) ){
         $gene33 = $row33['fk_generacion'];
         $arrayGen[$gene33] = $row33['DescripcionGeneracion'];

      }mysql_free_result($result33);

   }# se obtienen todas las generaciones de la carrera


echo 
'<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">

.Estilo1 {font-size: 11px;} 
.pie {font-size: 9px;}
.estilo7 {font-size: 18px; color: black;}

</style>
</head>

<body>
<table width="785" border="0" align="center">
<tr>
    <td colspan="2" rowspan="6"><div align="center"><img src="../../../../../assets/img/IESCH.png" width="117" height="121" /></div></td>
    <td colspan="8"><center><div align="center"><strong>'.$nombreInstitucion.'</strong></div></center></td>
    <td colspan="2" rowspan="6"><div align="center"><img src="../../../../../assets/img/fimpes.png" width="107" height="109" /></div></td>
  </tr>
  <tr>
    <td colspan="8"><center><div align="center"><strong> </strong></div></center></td>
  </tr>
  <tr>
    <td colspan="8"><center><div align="center"><strong>INCORPORADO A LA  SECRETARIA DE EDUCACIÓN</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan="8"><center><div align="center"><strong>OFICIO No. '.$numerooficio.' DE FECHA '.$fechaIncorporacionsecretaria.'</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan="8"><center><div align="center"><strong>RÉGIMEN: '.$regimen.'    CLAVE: </strong><strong>'.$clave.'</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan="8"><center><div align="center"><strong>EXCELENCIA ACADÉMICA: REG. '.$registro.'  </strong></div>
    </center></td>
  </tr>
   <tr>
    <td colspan="13"><center><div align="center"><strong>FECHA DE REPORTE:'.$fecha.'<strong></div>
    </center></td>
  </tr>
  <tr>
    <td width="105">&nbsp;</td>
    <td width="39">&nbsp;</td>
    <td width="73">&nbsp;</td>
    <td width="44">&nbsp;</td>
    <td width="47">&nbsp;</td>
    <td width="68">&nbsp;</td>
    <td width="33">&nbsp;</td>
    <td width="103">&nbsp;</td>
    <td width="36">&nbsp;</td>
    <td width="55">&nbsp;</td>
    <td width="53">&nbsp;</td>
    <td width="79">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="12"><strong>CARRERA: </strong> ' . $carreraReporte .'</td>
  </tr>
  <tr>
    <td colspan="12"><strong>MODALIDAD: </strong> ' . $ModalidadReporte .'</td>
  </tr>
</table>
'
;


foreach ( $arrayGen AS $valorGen => $nomGen ) {

echo '
<table width="805" align="center" style="border-collapse: collapse; color: #FFF; ">
   <tr>
    <td colspan="7">
        <div><span class="estilo7">Generación: '.$nomGen.'</span></div>
    </td>
  </tr>
  <tr style="border: solid 2px white" bgcolor="#305A45" align="center">
    <td width="50">
        <div>MATRICULA</div>
    </td>
    <td width="350">
        <div>NOMBRE</div>
    </td>
    <td> 
      <div>TELÉFONOS</div>
    </td>
    <td>
        <div></div>
    </td>
    <td width="150">
        <div>CORREO</div>
    </td>
    <td>
        <div>PROM</div>
    </td>
  </tr>
';
 
 echo "<br>";

if ( $res1234 = $Obras->ConCantidadAlumnosNoTituladosContacto($fk_nivelestudio, $fk_modalidad, $fk_carreras, $valorGen) ){
while ($row2 = mysql_fetch_assoc($res1234)) {
echo '
   <tr style="border-bottom: solid 1px; color: black;">
    <td class="Estilo1">
        <div style="text-align:left;">'.$row2['matricula'].'</div>
    </td>
    <td class="Estilo1">
        <div style="text-align:left;">'.$row2['NombreCompleto'].'</div>
    </td>
    <td class="Estilo1"> 
      <div>'.$row2['telefonofijo'].'</div>
    </td>
    <td class="Estilo1">
        <div>'.$row2['telefonocelular'].'</div>
    </td>
    <td class="Estilo1">
        <div>'.$row2['correo'].'</div>
    </td>
    <td class="Estilo1">
        <div align="center">'.$row2['promedio'].'</div>
    </td>
   </tr>
';
}
}


}// foreach

echo '</table></body></html>';

}

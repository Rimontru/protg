<?php
require_once("../../../../../includes/Config.class.php");  # Cargar datos conexion y otras variables.
require_once('../../../../../includes/DB.class.php');
require_once('../../../../../includes/ConsultaDB.class.php');
require_once('../../../../../mpdf/mpdf.php');


$Obras = new ConsultaDB;
$today = date("d-m-Y");    

if (isset($_GET['rangoFechas'])) {
    $fk_nivelestudio = $_GET['fk_nivelestudio'];    
    $fk_modalidad = $_GET['fk_modalidad'];  
    $fk_carreras = $_GET['fk_carreras'];
    $rangoFechas = $_GET['rangoFechas'];
    
    //convertimos fechas
    $fechaSQL = explode("-",$rangoFechas);
    $fechaInicio=trim($fechaSQL[0]);
    $fechaFin=trim($fechaSQL[1]);
    
  //  01/07/2014 - 31/07/2014
    $fechaSQL = explode("/",$fechaInicio);
    $fechaInicio=$fechaSQL[2]."-".$fechaSQL[1]."-".$fechaSQL[0];   

    $fechaSQL = explode("/",$fechaFin);
    $fechaFin=$fechaSQL[2]."-".$fechaSQL[1]."-".$fechaSQL[0];   

    
     $Result22 = $Obras->verTrabajadoresDirectoresReportes($fk_carreras);
    if ($Result22) {
        $row222 = mysql_fetch_assoc($Result22);
        $nombreDirector=  ($row222[NombreCompletoDirector]);
        $carreraReporte=  ($row222[nombreCarrera]);
     
        mysql_free_result($Result22);
    }
    
    if($row222[fk_genero]== "1") {
     $GeneroReporte=" DIRECTOR ";

}else{
 $GeneroReporte=" DIRECTORA ";

}

    
    
$html.='
<html>
<head>
<meta charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
body{
font-size: 10px;
}
.Estilo1 {font-size: 10px}
.Estilo2 {font-size: 14px}
-->
</style>
</head>

<body>
	<div class="logo" style="position: absolute; left: 60px; top: 15px;"><img src="../../../../../assets/img/IESCH.png" width="100" height="100" /></div>

<table width="100%" height="32" border="0" style="border-collapse: collapse;">
  <tr> 
    <td class="Estilo2" height="28" align="center"><strong>'.$carreraReporte.'</strong></td>
  </tr>
  <tr>
    <td class="Estilo2" height="28" align="center"><strong>RELACION DE DOCUMENTOS PARA TRAMITE DE EXAMEN INSTITUCIONAL</strong></td>
  </tr>
  <tr>
    <td class="Estilo2" height="28" align="center">&nbsp;</td>
  </tr>
  
</table>

<table width="100%" height="88" border="0" style="border-collapse: collapse;">
 
<tr>
<td width="28">&nbsp;</td>
    <td style="border-width: 1px;border: solid;" width="" align="center"><span class="Estilo1"><strong>No.</strong></span></td>
    <td style="border-width: 1px;border: solid;" width="" align="center"><span class="Estilo1"><strong>NOMBRE</strong></span></td>
    <td style="border-width: 1px;border: solid;" width="" align="center"><div align="center"><span class="Estilo1"><strong>No. CONTROL</strong></span></div></td>
    <td style="border-width: 1px;border: solid;" colspan="2" width="" align="center"><div align="center"><span class="Estilo1"><strong>ACTA DE NACIMIENTO</strong></span></div></td>
    <td style="border-width: 1px;border: solid;" colspan="2" align="center"><div align="center"><span class="Estilo1"><strong>CERTIFICADO DE BACHILLERATO</strong></span></div></td>
    <td style="border-width: 1px;border: solid;" colspan="2" align="center"><div align="center"><span class="Estilo1"></span><span class="Estilo1"></span><span class="Estilo1"></span><span class="Estilo1"><strong>CERTIFICADO DE LICENCIATURA</strong></span></div></td>
    <td style="border-width: 1px;border: solid;" colspan="2" align="center"><div align="center"><span class="Estilo1"></span><span class="Estilo1"></span><span class="Estilo1"></span><span class="Estilo1"><strong>CURP</strong></span></div></td>
    <td style="border-width: 1px;border: solid;" colspan="2" align="center"><div align="center"><span class="Estilo1"></span><span class="Estilo1"></span><span class="Estilo1"></span><span class="Estilo1"><strong>CONST. SERVICIO SOCIAL</strong></span></div></td>
    <td style="border-width: 1px;border: solid;"  height="23" colspan="3" align="center"><div align="center"><span class="Estilo1"></span><span class="Estilo1"></span><span class="Estilo1"></span><span class="Estilo1"><strong>RECIBO DE PAGO</strong></span></div>      <span class="Estilo1"></span><span class="Estilo1"></span></td>
    <td style="border-width: 1px;border: solid;" align="center"><span class="Estilo1"></span><span class="Estilo1"></span><span class="Estilo1"></span><span class="Estilo1"><strong>OBSERVACIONES</strong></span></td>
  </tr>
  <tr>
    <td height="">&nbsp;</td>
    <td  style="border-width: 1px;border: solid;">&nbsp;</td>
    <td  style="border-width: 1px;border: solid;">&nbsp;</td>
     <td  style="border-width: 1px;border: solid;">&nbsp;</td>
    <td width="58" style="border-width: 1px;border: solid;" align="center"><span class="Estilo1">original</span></td>
    <td width="59" style="border-width: 1px;border: solid;" align="center"><span class="Estilo1">copia</span></td>
    <td width="56" style="border-width: 1px;border: solid;" align="center"><span class="Estilo1">original</span></td>
    <td width="61" style="border-width: 1px;border: solid;" align="center"><span class="Estilo1">copia</span></td>
    <td width="57" style="border-width: 1px;border: solid;" align="center"><span class="Estilo1">original</span></td>
    <td width="56" style="border-width: 1px;border: solid;" align="center"><span class="Estilo1">copia</span></td>
    <td width="42" style="border-width: 1px;border: solid;" align="center"><span class="Estilo1">original</span></td>
    <td width="33" style="border-width: 1px;border: solid;" align="center"><span class="Estilo1">copia</span> </td>
    <td width="46" style="border-width: 1px;border: solid;" align="center"><span class="Estilo1">original</span></td>
    <td width="34" style="border-width: 1px;border: solid;" align="center"><span class="Estilo1">copia</span></td>
    <td width="30" style="border-width: 1px;border: solid;" align="center"><span class="Estilo1">original</span></td>
    <td width="30" style="border-width: 1px;border: solid;" align="center"><span class="Estilo1">copia</span></td>
    <td width="78" style="border-width: 1px;border: solid;" align="center"><span class="Estilo1">folio</span></td>
    <td  style="border-width: 1px;border: solid;">&nbsp;</td>
  </tr> 
  
  
  
  
  
  ';
                        $contador=1;


    $Result = $Obras->ConReporteDocumentacionAlumnos($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fechaInicio, $fechaFin);
    if ($Result) {

        while($row2 = mysql_fetch_assoc($Result)){

$comentario=strtolower($row2[ObservacionesDoc]);

             $html.='<tr style="text-align:center;">
                        <td height="28">&nbsp;</td>
                        <td  style="border-width: 1px;border: solid;" width="" align="center">'.$contador++.'</td>
                        <td  style="border-width: 1px;border: solid;" width="" ><span class="Estilo1">'.$row2[NombreCompleto].'</span></td>
                        <td style="border-width: 1px;border: solid;" align="center"><span class="Estilo1">'.$row2[matricula].'</span></td>
                        <td style="border-width: 1px;border: solid;" width=""><span class="Estilo1">'.$row2[ActaOriginal].'</span></td>
                        <td  style="border-width: 1px;border: solid;" width=""><span class="Estilo1">'.$row2[ActaCopia].'</span></td>
                        <td  style="border-width: 1px;border: solid;" width=""><span class="Estilo1">'.$row2[cbOriginal].'</span></td>
                        <td  style="border-width: 1px;border: solid;" width=""><span class="Estilo1">'.$row2[cbCopia].'</span></td>
                        <td  style="border-width: 1px;border: solid;" width=""><span class="Estilo1">'.$row2[clicOriginal].'</span></td>
                        <td  style="border-width: 1px;border: solid;" width=""><span class="Estilo1">'.$row2[clicCopia].'</span></td>
                        <td  style="border-width: 1px;border: solid;" width=""><span class="Estilo1">'.$row2[curpOriginal].'</span></td>
                        <td style="border-width: 1px;border: solid;" width=""><span class="Estilo1">'.$row2[curpCopia].'</span></td>
                        <td  style="border-width: 1px;border: solid;" width=""><span class="Estilo1">'.$row2[consservicioOriginal].'</span></td>
                        <td  style="border-width: 1px;border: solid;" width=""><span class="Estilo1">'.$row2[consservicioCopia].'</span></td>
                        <td  style="border-width: 1px;border: solid;" width=""><span class="Estilo1">'.$row2[reciboOriginal].'</span></td>
                        <td style="border-width: 1px;border: solid;" width=""><span class="Estilo1">'.$row2[reciboCopia].'</span></td>
                        <td style="border-width: 1px;border: solid;" width=""><span class="Estilo1">'.$row2[recibofolio].'</span></td>
                        <td  style="border-width: 1px;border: solid;" width="200"><span class="Estilo1">'.$comentario.'</span></td>
                      </tr>';
            
        } //find el while
                      
        mysql_free_result($Result);
         
    }
    

       

        

$html.='</table>
    <br><br>
<table width="1193" height="88" border="0">
  <tr>
    <td width="116"><span class="Estilo1"></span></td>
    <td  align="center" width="250"><div align="center" class="Estilo1">ENTREGA:</div>      <span class="Estilo1"></span><span class="Estilo1"></span></td>
    <td colspan="2"><span class="Estilo1"></span></td>
    <td colspan="2"><span class="Estilo1"></span></td>
    <td  align="center" width="328" height="23"><div align="center" class="Estilo1">RECIBE</div></td>
    <td width="199"><span class="Estilo1"></span></td>
  </tr>
  
  <tr>
    <td height="28"><span class="Estilo1"></span></td>
<td align="center"><div align="center" class="Estilo1">'.$nombreDirector.'</div>      <span class="Estilo1"></span><span class="Estilo1"></span><span class="Estilo1"></span><span class="Estilo1"></span></td>
    <td width="42"><span class="Estilo1"></span></td>
    <td width="33"><span class="Estilo1"></span></td>
    <td width="46"><span class="Estilo1"></span></td>
    <td width="145"><span class="Estilo1"></span></td>
  <td align="center"><div align="center" class="Estilo1">LIC. FLORIBEL MEGCHUN DE LA CRUZ</div>      
    <span class="Estilo1"></span><span class="Estilo1"></span><span class="Estilo1"></span><span class="Estilo1"></span></td>

    <td><span class="Estilo1"></span></td>
  </tr>
  <tr>
    <td height="28"><span class="Estilo1"></span></td>
    <td align="center" ><div align="center" class="Estilo1">'.$GeneroReporte.' '.$carreraReporte.'</div>      <span class="Estilo1"></span><span class="Estilo1"></span><span class="Estilo1"></span><span class="Estilo1"></span></td>
    <td width="42"><span class="Estilo1"></span></td>
    <td width="33"><span class="Estilo1"></span></td>
    <td width="46"><span class="Estilo1"></span></td>
    <td width="145"><span class="Estilo1"></span></td>
    <td align="center"><div align="center"><span class="Estilo1">DIRECTORA DE SERVICIOS ESCOLARES</span></div></td>
    <td><span class="Estilo1"></span></td>
  </tr>
</table>


</body>
</html>
';
    
    
} else {
    $html = "Lo Sentimos No Se Pudo Realizar la Consulta";
}

ob_start();
$mpdf=new mPDF('','','' , '','10', '10' , '10' , '10' , '10' , '10','P'); 
$mpdf->AddPage('L','','','','','','','','','','');
$mpdf->SetFooter('Pagina {PAGENO}');
$mpdf->WriteHTML($html);
$mpdf->Output("Reporte_DocumentacionAlumnos_".$today.".pdf",'D');

?> 
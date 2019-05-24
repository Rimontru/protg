<?php
//error_reporting(0);
require_once("../../../../includes/Config.class.php");  # Cargar datos conexion y otras variables.
require_once('../../../../includes/DB.class.php');
require_once('../../../../includes/ConsultaDB.class.php');
require_once('../../../../includes/MisFunciones.class.php');

$Obras = new ConsultaDB;
$Funciones = new MisFunciones();
date_default_timezone_set('America/Mexico_City');
$today = date("d-m-Y");
$fecha = date("d/m/Y");

$Result22 = $Obras->verTrabajadoresDirectoresReportes($fk_carreras);
if ($Result22) {
	$row222 = mysql_fetch_assoc($Result22);
	$nombreDirector = ($row222[NombreCompletoDirector]);
	$carreraReporte = ($row222[nombreCarrera]);

	mysql_free_result($Result22);
}

//error_reporting(0);
date_default_timezone_set("America/Mexico_City");
$today = date("d-m-Y");
$Nomb_Archivo = 'ReporteSinodalesPagosTodosXLS_' . $today . '.xls';

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=" . $Nomb_Archivo);

?>
<?php
if (isset($_GET['fk_nivelestudio'])) {
    $fk_nivelestudio = $_GET['fk_nivelestudio'];    
    $fechaUnoPago = $_GET['fechaUnoPago'];
    $fechaDosPago = $_GET['fechaDosPago'];
	
	$fechaSQL = explode("/",$fechaUnoPago);
	$fechaUnoPago=$fechaSQL[2]."-".$fechaSQL[1]."-".$fechaSQL[0];
	
	$fechaS = explode("/",$fechaDosPago);
	$fechaDosPago=$fechaS[2]."-".$fechaS[1]."-".$fechaS[0];

?>
<html>
    <head>
        <title>REPORTE</title>
    </head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <body>     
    <table border="0" align="center" width="950">
      <tr>
        <td colspan='5'><center><div align="center"><strong>INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS</strong></div></center></td>
      </tr>
      <tr>
        <td colspan='5'><center><div align="center"><strong> </strong></div></center></td>
      </tr>
      <tr>
        <td colspan='5'><center><div align="center"><strong>INCORPORADO A LA  SECRETARIA DE EDUCACIÓN</strong></div>
        </center></td>
      </tr>
      <tr>
        <td colspan='5'><center><div align="center"><strong>OFICIO No. 0233 DE FECHA 03 DE NOVIEMBRE DE 11183</strong></div>
        </center></td>
      </tr>
      <tr>
        <td colspan='5'><center><div align="center"><strong>RÉGIMEN: PARTICULAR    CLAVE: </strong><strong>011PSU0002D</strong></div>
        </center></td>
      </tr>
      <tr>
        <td colspan='5'><center><div align="center"><strong>EXCELENCIA ACADÉMICA: REG. SEP/PSA/2009/030  </strong></div>
        </center></td>
      </tr>
      <tr><td>&nbsp;</td></tr>
    </table>
<?php
	$Result = $Obras->ConReporteSinodalesPagoTodos($fk_nivelestudio, $fk_modalidad, $fechaUnoPago, $fechaDosPago);
    if ($Result) {
        while($row2 = mysql_fetch_assoc($Result)){
            
            //carrera MEDICO
            if ($row2['fk_carreras'] == "12") {
            $precio="$300";
        	} else {

            //Tesis Profecional
            if ($row2['pk_titulacion'] == "7") {
                $precio="$300";
            }
            //Curso de Titulacion
            if ($row2['pk_titulacion'] == "6") {
                $precio="$400";
            }
            
            //Estudios de Posgrado(50% de maestria)
            if ($row2['pk_titulacion'] == "1") {
                $precio="$200";
            }
            //Promedio de calificaciones
             if ($row2['pk_titulacion'] == "2") {
                $precio="$200";
            }
            //SUSTENTACION DE EXAMEN POR AREAS DE CONOCIMIENTO
             if ($row2['pk_titulacion'] == "3") {
                $precio="$200";
            }
            //SUSTENTACION DE EXAMEN POR AREAS DE CONOCIMIENTO (CENEVAL)
             if ($row2['pk_titulacion'] == "4") {
                $precio="$200";
            }
            //ESTUDIO DE POSGRADO (ESPECIALIDAD)
            if ($row2['pk_titulacion'] == "5") {
                $precio="$200";
            }
            //EXAMEN COLECTIVO
            if ($row2['pk_titulacion'] == "12") {
                $precio="$300";
            }
//MAESTRIA
            if ($fk_nivelestudio == "3") {
                $precio="$250";
            }

	if($suplente == $row2['NombreSuplente']){
		$suplente="";
		}else{ $suplente="";
            }
        }

if($row2['pk_sinodal']<="1091" || $row2['pk_sinodal']>="1093" ){
?>
<table>
    <tr>                        
    	<td colspan='5' align='center'  height='28'><div align='center'><strong><?php echo $row2['nombreCarrera']?></strong></div></td>
	</tr>
     <tr>
        <td align='center' style='border-width: 1px;border: solid;' width=''>
        	<span class='Estilo1'><strong>SIN0DALES</strong></span>
        </td>
        <td align='center' style='border-width: 1px;border: solid;'width='300px'>
        	<span class='Estilo1'><strong>NOMBRE</strong></span>
        </td>
        <td align='center' style='border-width: 1px;border: solid;' width='250'>
        	<div align='center'><span class='Estilo1'><strong>EXAMEN</strong></span></div>
        </td>
        <td align='center' style='border-width: 1px;border: solid;' width=''>
        	<div align='center'><span class='Estilo1'><strong>FECHA</strong></span></div>
        </td>
        <td align='center' style='border-width: 1px;border: solid;' width=''>
        	<div align='center'><span class='Estilo1'><strong>HORA</strong></span></div>
        </td>
    </tr>
    <tr> 
        <td style='border-width: 0px;border: solid;' width=''>Sustentante</td>
        <td style='border-width: 0px;border: solid;'><span class='Estilo1'><strong><?php echo $row2['NombreCompleto']?></strong></span></td>
        <td align='center' style='border-width: 0px;border: solid;'><span class='Estilo1'><?php echo $row2['NombreTitulacion']?></span></td>         
        <td align='center' style='border-width: 0px;border: solid;'><span class='Estilo1'><?php echo $row2['FechaTomaProtestareporte']?></span></td>
        <td align='center' style='border-width: 0px;border: solid;' width=''><span class='Estilo1'><?php echo $row2['hora']?></span></td>
      </tr>
    <tr>
        <td rowspan='3' style='border-width: 0px;border: solid;' width=''class='Estilo1'>&nbsp;</td>
        <td style='border-width: 0px;border: solid;'><span class='Estilo1'><?php echo $row2['NombrePresidente']?></span></td>
        <td align='center'><div align='center'><span class='Estilo1'><?php echo $precio?></span></div></td>
        <td style='border-width: 0px;border: solid;'><span class='Estilo1'></span></td>
        <td style='border-width: 0px;border: solid;' width=''><span class='Estilo1'></span></td>
      </tr>
    <tr>
        <td style='border-width: 0px;border: solid;'><span class='Estilo1'><?php echo $row2['NombreSecretario']?></span></td>
        <td align='center'><div align='center'><span class='Estilo1'><?php echo $precio?></span></div></td>
        <td style='border-width: 0px;border: solid;'><span class='Estilo1'></span></td>
        <td style='border-width: 0px;border: solid;' width=''><span class='Estilo1'></span></td>
      </tr>
    <tr>
        <td style='border-width: 0px;border: solid;'><span class='Estilo1'><?php echo $row2['NombreVocal']?></span></td>
        <td align='center'><div align='center'><span class='Estilo1'><?php echo $precio?></span></div></td>
        <td style='border-width: 0px;border: solid;'><span class='Estilo1'></span></td>
        <td style='border-width: 0px;border: solid;' width=''><span class='Estilo1'></span></td>
      </tr>
    <tr>
        <td style='border-width: 0px;border: solid;'><span class='Estilo1'><?php echo $suplente?></span></td>
        <td align='center'><div align='center'><span class='Estilo1'></span></div></td>
        <td style='border-width: 0px;border: solid;'><span class='Estilo1'></span></td>
        <td style='border-width: 0px;border: solid;' width=''><span class='Estilo1'></span></td>
      </tr>
    <tr>
        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>
        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>         
        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>
        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>
        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>
      </tr>
</table>
<?php 
}
}
mysql_free_result($Result);
}
}
?>
    </body>
</html>

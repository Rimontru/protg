<?php 




require_once("../../../../Config.class.php");  # Cargar datos conexion y otras variables.
require_once('../../../../DB.class.php');
require_once('../../../../ConsultaDB.class.php');
require_once('../../../../../mpdf/mpdf.php');
require_once('../../../../MisFunciones.class.php');


require_once ("../../../../jpgraph/src/jpgraph.php");
require_once ("../../../../jpgraph/src/jpgraph_pie.php");
        
date_default_timezone_set('America/Mexico_City');      
$Obras = new ConsultaDB;
$Funciones = new MisFunciones();
date_default_timezone_set('America/Mexico_City');
$today = date("d-m-Y");
$fecha = date("d/m/Y");

    $fk_nivelestudio = $_GET['fk_nivelestudio'];
    $fk_modalidad = $_GET['fk_modalidad'];
    $fk_carreras = $_GET['fk_carreras'];
    $fk_generacion = $_GET['fk_generacion'];
    $opcionGrafica = $_GET['opcionGrafica'];

 $Result1 = $Obras->GraficaEgresadosLaborando($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion);
    if ($Result1) {
        $row333 = mysql_fetch_assoc($Result1);

        $CantidadLaborando = $row333['CantidadEgresadosLaborando'];
       
    }

     $Result2 = $Obras->GraficaEgresadosNoLaborando($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion);
    if ($Result2) {
        $row222 = mysql_fetch_assoc($Result2);

        $CantidadNoLaborando = $row222['CantidadEgresadosNoLaborando'];
       
    }

    $GranTotal = $CantidadLaborando + $CantidadNoLaborando;



$html3 = '
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reporte Grafica</title>
<style type="text/css">
<!--

.Estilo1{
	font-family:arial;
	font size:14px;
	}
.Estilo2 {font-size: 10px}
-->
</style>
</head>

<body>

</br></br></br>
<table width="860" height="" border="0" align="center"  cellSpacing="0" cellPadding="0" >
  <tr>
      	<td colspan="0" rowspan="5" width="100" class="Estilo1" align="center"><img src="../../../../../assets/img/IESCH.png" width="90" height="90" /></td>
        
		<td colspan="8" width="400" class="Estilo1" align="center"><strong>INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS</strong></td>
		
		<td colspan="0" rowspan="5" width="100" class="Estilo1" align="center"><img src="../../../../../assets/img/fimpes.png" width="100	" height="100" />
  </tr>
  
  <tr><td colspan="8" class="Estilo1" align="center"><strong>INCORPORADO A LA SECRETARIA DE EDUCACIÓN</strong></td>
	  </tr>
  
  <tr>
      <td colspan="8" class="Estilo1" align="center"><strong>OFICIO No. 0233 DE FECHA 03 DE NOVIEMBRE DE 1983</strong></td>
	 </tr>
	 
	 <tr> 
	  <td colspan="8" class="Estilo1" align="center"><strong>RÉGIMEN: PARTICULAR CLAVE: 07PSU0002D</strong></td>
	  </tr>
	  
	  <tr>
	  <td colspan="8" class="Estilo1" align="center"><strong>EXCELENCIA ACADÉMICA: REG. SEP/PSA/2009/030</strong></td>
	  </tr>
	  
	    <tr><td colspan="10" class="Estilo1" align="center">&nbsp;</td></tr>
  <tr><td colspan="10" class="Estilo1" align="center">&nbsp;</td></tr>

  
  <tr>
    <td colspan="10" class="Estilo1" align="center"><strong></strong></td>
  </tr>
  <tr><td colspan="10" class="Estilo1" align="center">&nbsp;</td></tr>
  
  <tr><td width="430" colspan="5" class="Estilo1" align="center">Cantidad de Alumnos Encuestados</td><td width="430" colspan="5" class="Estilo1" align="center"><strong><u>'.$cantidadEncuestados.'</u></strong></td></tr>
  </table>
<br><br>
 <center><img src="GraficaEgresadosLaboral.php?fk_nivelestudio='.$fk_nivelestudio.'&fk_modalidad='.$fk_modalidad.'&fk_carreras='.$fk_carreras.'&fk_generacion='.$fk_generacion.'"  /> </center>
</body>
</html>
';
     fwrite($f, $grafica);
    fputs($f, "");
    fclose($f);

    $res =$html3;

echo $res;




?>
<?
//error_reporting(0);
require_once("../../../../includes/Config.class.php");  # Cargar datos conexion y otras variables.
require_once('../../../../includes/DB.class.php');
require_once('../../../../includes/ConsultaDB.class.php');
require_once('../../../../mpdf/mpdf.php');
require_once('../../../../includes/MisFunciones.class.php');

$Obras = new ConsultaDB;
$Funciones = new MisFunciones();
date_default_timezone_set('America/Mexico_City');
$today = date("d-m-Y");
$fecha = date("d/m/Y");
$fk_estadoTitulacion = $_GET['fk_estadoTitulacion'];

 $fk_nivelestudio = $_GET['fk_nivelestudio'];
    $fk_modalidad = $_GET['fk_modalidad'];
    $fk_carreras = $_GET['fk_carreras'];
    $fk_generacion = $_GET['fk_generacion'];

    $rangoFechas = $_GET['rangoFechas'];
    
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
$Nomb_Archivo = 'ReporteCredencialesTramitadas_' . $today . '.xls';

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=" . $Nomb_Archivo);

//Configuracion de la conexion a base de datos
$db = mysql_connect(Config::DB_HOST, Config::DB_USER, Config::DB_PASS) or die("Connection Error: " . mysql_error());
mysql_select_db(Config::DB_NAME) or die("Error conecting to db.");
//echo "conexion abierta";
?>
<?php
          $contador2=1;
          $result33 = $Obras->ConReporteAlumnosCredencialesTramitadasPorGeneracion($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fk_generacion);
          $fechaSQL = explode("-", $fecha);
          $row33 = mysql_fetch_assoc($result33);
?>
<html>
    <head>
        <title>REPORTE</title>
    </head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <body>     
       <table border="0" align="center">
<tr>
    <td colspan="5"><center><div align="center"><strong>INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS</strong></div></center></td>
  </tr>
  <tr>
    <td colspan="5"><center><div align="center"><strong> </strong></div></center></td>
  </tr>
  <tr>
    <td colspan="5"><center><div align="center"><strong>INCORPORADO A LA  SECRETARIA DE EDUCACIÓN</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan="5"><center><div align="center"><strong>OFICIO No. 0233 DE FECHA 03 DE NOVIEMBRE DE 1983</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan="5"><center><div align="center"><strong>RÉGIMEN: PARTICULAR    CLAVE: </strong><strong>07PSU0002D</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan="5"><center><div align="center"><strong>EXCELENCIA ACADÉMICA: REG. SEP/PSA/2009/030  </strong></div>
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
</table>

<table border="0" width="785" align="center">
    <tr>
    <td colspan="5" align="center"><?php echo 'Generaciòn: '.$row33['DescripcionGeneracion']; ?></td>
    </tr>
    <tr>
    <td colspan="6">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    </tr>
</table>

        
  <table height="48" border="0" align="center"  id="Exportar_a_Excel">
  <tr>
    <td colspan="5"><?php echo $carreraReporte ?></td>
  </tr>
  <tr>
    <td width="48"   align="center" bgcolor="#999999"><span class="Estilo1">No</span></td>
    <td width="162"  align="center" bgcolor="#999999"><span class="Estilo1">Matrícula</span></td>
    <td width="245"  align="center" bgcolor="#999999"><span class="Estilo1">Nombre</span></td>
	<td width="105"  align="center" bgcolor="#999999"><span class="Estilo1">Estatus</span></td>
    <td width="105"  align="center" bgcolor="#999999"><span class="Estilo1">Fecha de Entrega</span></td>
  </tr>
            <?php
#se hace una nueva consulta porque le esta robando un registro de buskeda en los primeros resultados esta es la manera correcta    
$result123 = $Obras->ConReporteAlumnosCredencialesTramitadasPorGeneracion($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fk_generacion);   

                            $contador2=1;
                             if ($result123) {
                                    while ($row123 = mysql_fetch_assoc($result123)) {

                                       if($row123['fk_estadoTitulacion']=='1') {
                                           $fk_estadoTitulacion="Titulado";
                                       }else{
                                           $fk_estadoTitulacion="No Titulado";
                                       }
									  	if($row123['estatusCred']==1){
											$estatus="Entregada";
										}else{
											$estatus="No Entregada";
										}

                                        echo "<tr>
                                                  <td><span class='Estilo1'>".$contador2."</span></td>
                                                   <td><span class='Estilo1'>".$row123['matricula']."</span></td>
                                                   <td><span class='Estilo1'>".$row123['NombreCompleto']."</span></td>
                                                   <td><span class='Estilo1'>".$estatus."</span></td>
                                                   <td align='left'><span class='Estilo1'>".$row123['fechEntregaCred']."</span></td>
                                                 </tr>                
                                                    ";

                                    $html4 = $html4 . $html2;
                                    $contador2=$contador2+1;



                                    }
                                    mysql_free_result($result33);
                                }


                       
            ?>
        </table>

    </body>
</html>


 
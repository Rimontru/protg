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
    
    

//error_reporting(0);
date_default_timezone_set("America/Mexico_City");
$today = date("d-m-Y");
$Nomb_Archivo = 'ReporteInformacionAcademicaXLS_' . $today . '.xls';

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=" . $Nomb_Archivo);

//Configuracion de la conexion a base de datos
$db = mysql_connect(Config::DB_HOST, Config::DB_USER, Config::DB_PASS) or die("Connection Error: " . mysql_error());
mysql_select_db(Config::DB_NAME) or die("Error conecting to db.");
//echo "conexion abierta";
?>

<html>
    <head>
        <title>REPORTE</title>
    </head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <body>     
       <table width="785" border="0" align="center">
<tr>
    <td colspan="2" rowspan="6"><div align="center"><img src="../../assets/img/IESCH.png" width="117" height="121" /></div></td>
    <td colspan="8"><center><div align="center"><strong>INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS</strong></div></center></td>
    <td colspan="2" rowspan="6"><div align="center"><img src="../../assets/img/fimpes.png" width="107" height="109" /></div></td>
  </tr>
  <tr>
    <td colspan="8"><center><div align="center"><strong> </strong></div></center></td>
  </tr>
  <tr>
    <td colspan="8"><center><div align="center"><strong>INCORPORADO A LA  SECRETARIA DE EDUCACIÓN</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan="8"><center><div align="center"><strong>OFICIO No. 0233 DE FECHA 03 DE NOVIEMBRE DE 1983</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan="8"><center><div align="center"><strong>RÉGIMEN: PARTICULAR    CLAVE: </strong><strong>07PSU0002D</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan="8"><center><div align="center"><strong>EXCELENCIA ACADÉMICA: REG. SEP/PSA/2009/030  </strong></div>
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

        <table border="0" width="100%" align="center">


         <tr>
            <td colspan="6"></td>
            <td colspan="3"></td>
          </tr>
        </table>

        
<table width="988" height="48" border="0" align="center"  id="Exportar_a_Excel">
  <tr>
    <td width="48"   align="center" bgcolor="#999999"><span class="Estilo1">No</span></td>
    <td width="75"  align="center" bgcolor="#999999"><span class="Estilo1">Matrícula</span></td>
    <td width="135"  align="center" bgcolor="#999999"><span class="Estilo1">Nombre</span></td>
    <td width="105"  align="center" bgcolor="#999999"><span class="Estilo1">Maestría</span></td>
    <td width="105"  align="center" bgcolor="#999999"><span class="Estilo1">Institución Maestría</span></td>
    <td width="105"  align="center" bgcolor="#999999"><span class="Estilo1">Doctorado</span></td>
    <td width="105"  align="center" bgcolor="#999999"><span class="Estilo1">Institución Doctorado</span></td>
    <td width="105"  align="center" bgcolor="#999999"><span class="Estilo1">Especialidad</span></td>
    <td width="110"  align="center" bgcolor="#999999"><span class="Estilo1">Institución Especialidad</span></td>
  </tr>
            <?
           $contador2=1;
            

           
                    $result33 = $Obras->ConReporteAlumnosInformacionBasica($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fk_generacion);
                    $fechaSQL = explode("-", $fecha);
//                $row33 = mysql_fetch_assoc($result33);

                   if ($result33) {
                            while ($row33 = mysql_fetch_assoc($result33)) {
                                        echo "<tr class='Estilo1'>
                                                    <td class='Estilo1' width='24'>$contador2</td>
                                                    <td class='Estilo1'>".$row33['matricula']."</td>
                                                    <td class='Estilo1'>".$row33['NombreCompleto']."</td>
                                                    <td class='Estilo1'>".$row33['mtriaNombre']."</td>
                                                    <td class='Estilo1'>".$row33['mtriaInstitucion']."</td>
                                                    <td class='Estilo1'>".$row33['doctoradoNombre']."</td>
                                                    <td class='Estilo1'>".$row33['doctoradoInstitucion']."</td>
                                                    <td class='Estilo1'>".$row33['especialidadNombre']."</td>
                                                    <td class='Estilo1'>".$row33['especialidadInstitucion']."</td>
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


 
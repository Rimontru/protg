<?
error_reporting(0);
date_default_timezone_set('America/Mexico_City');
require_once("../../../../includes/Config.class.php");  # Cargar datos conexion y otras variables.
require_once('../../../../includes/DB.class.php');
require_once('../../../../includes/ConsultaDB.class.php');
require_once('../../../../mpdf/mpdf.php');
require_once('../../../../includes/MisFunciones.class.php');


$Funciones = new MisFunciones();
$consult = new ConsultaDB();

  $result = $consult->ConsultaEmpleadores();
  $empleadores_row = @mysql_fetch_assoc($result);
  $empleadores_row_num = @mysql_num_rows($result);
  $today = date("d-m-Y");
// $fecha = date("d/m/Y");
//$fk_estadoTitulacion = $_GET['fk_estadoTitulacion'];

 // $fk_nivelestudio = $_GET['fk_nivelestudio'];
 //    $fk_modalidad = $_GET['fk_modalidad'];
 //    $fk_carreras = $_GET['fk_carreras'];
 //    $fk_generacion=$_GET['fk_generacion']; 
 //    $rangoFechas = $_GET['rangoFechas'];

  
//error_reporting(0);
date_default_timezone_set("America/Mexico_City");
$today = date("d-m-Y");
$Nomb_Archivo = 'cumpleanieros' . $today . '.xls';

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=" . $Nomb_Archivo);

//Configuracion de la conexion a base de datos
//$db = mysql_connect(Config::DB_HOST, Config::DB_USER, Config::DB_PASS) or die("Connection Error: " . mysql_error());
//mysql_select_db(Config::DB_NAME) or die("Error conecting to db.");
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
    <td colspan="6"><center><div align="center"><strong>INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS</strong></div></center></td>
  </tr>
  <tr>
    <td colspan="6"><center><div align="center"><strong>INCORPORADO A LA  SECRETARIA DE EDUCACIÓN</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan="6"><center><div align="center"><strong>OFICIO No. 0233 DE FECHA 03 DE NOVIEMBRE DE 1983</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan="6"><center><div align="center"><strong>RÉGIMEN: PARTICULAR    CLAVE: </strong><strong>07PSU0002D</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan="6"><center><div align="center"><strong>EXCELENCIA ACADÉMICA: REG. SEP/PSA/2009/030  </strong></div>
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

        <table width="1151" border="1" align="center"   id="Exportar_a_Excel">

          <tr>   
            <td width="68" height="21"  align="center" bgcolor="#999999"><p>#</p></td>
            <td width="68" height="21"  align="center" bgcolor="#999999"><p>Fecha de Solicitud</p></td>
            <td width="73"  align="center" bgcolor="#999999"><p>Empresa</p></td>
            <td align="center" bgcolor="#999999"  width="111"><p>Solicitante</p></td>
            <td align="center" bgcolor="#999999"  width="111"><p>Puesto</p></td>
            <td align="center" bgcolor="#999999"  width="111"><p>Licenciatura</p></td>
            <td align="center" bgcolor="#999999"  width="111"><p>Vacante</p></td>
            <td align="center" bgcolor="#999999"  width="111"><p>Num. Vacante</p></td>
            <td align="center" bgcolor="#999999"  width="111"><p>Teléfono</p></td>
            <td align="center" bgcolor="#999999"  width="111"><p>E-mail</p></td>
            <td align="center" bgcolor="#999999"  width="111"><p>Dirección</p></td>
            <td align="center" bgcolor="#999999"  width="111"><p>Género</p></td>
          </tr>
            <?php
          $contador="1";  
           do { ?>   

             
                  <tr>
                      <td class="center"><?php echo $contador++; ?></td>
                      <td class="center"><?php echo $Funciones->Fecha2($empleadores_row['fechaSolicitud']); ?></td>
                      <td class="center"><?php echo $Funciones->str_to_may($empleadores_row['empresa']); ?></td>
                      <td class="center"><?php echo $Funciones->str_to_may($empleadores_row['nombreSolicitante']); ?></td>
                      <td class="center"><?php echo $Funciones->str_to_may($empleadores_row['puetoSolicitante']); ?></td>
                      <td class="center"><?php echo $Funciones->str_to_may($empleadores_row['licenciatura']); ?></td>
                      <td class="center"><?php echo $Funciones->str_to_may($empleadores_row['puestoVacante']); ?></td>
                      <td class="center"><?php echo $Funciones->str_to_may($empleadores_row['numVacantes']); ?></td>
                      <td class="center"><?php echo $Funciones->str_to_may($empleadores_row['telefono']); ?></td>
                      <td class="center"><?php echo $Funciones->str_to_may($empleadores_row['email']); ?></td>
                      <td class="center"><?php echo $Funciones->str_to_may($empleadores_row['direccion']); ?></td>
                      <td class="center"><?php echo $Funciones->str_to_may($empleadores_row['sexo']); ?></td>
                  </tr>
          <?php  }while($empleadores_row = @mysql_fetch_assoc($result)); 

?>  
        </table>

    </body>
</html>


 
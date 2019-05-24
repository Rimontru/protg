<?
//error_reporting(0);
require_once("../../../../../includes/Config.class.php");  # Cargar datos conexion y otras variables.
require_once('../../../../../includes/DB.class.php');
require_once('../../../../../includes/ConsultaDB.class.php');
require_once('../../../../../mpdf/mpdf.php');
require_once('../../../../../includes/MisFunciones.class.php');


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
$Nomb_Archivo = 'ReporteResultadosExamenDOC_' . $today;


  header('Content-type: application/vnd.ms-word');
header("Content-Disposition: attachment; filename=$Nomb_Archivo.doc");
 header("Pragma: no-cache");
header("Expires: 0");       
  
     $Result22 = $Obras->verTrabajadoresDirectoresReportes($fk_carreras);
    if ($Result22) {
        $row222 = mysql_fetch_assoc($Result22);
        $nombreDirector=  ($row222[NombreCompletoDirector]);
        $carreraReporte=  ($row222[nombreCarrera]);
     
        mysql_free_result($Result22);
    }

     
     //convertimos fechas
    $fechaSQL = explode("-", $rangoFechas);
    $fechaInicio = trim($fechaSQL[0]);
    $fechaFin = trim($fechaSQL[1]);
    
    $fechaInicio22 = trim($fechaSQL[0]);
    $fechaFin22 = trim($fechaSQL[1]);

    //  01/07/2014 - 31/07/2014
    $fechaSQL = explode("/", $fechaInicio);
    $fechaInicio = $fechaSQL[2] . "-" . $fechaSQL[1] . "-" . $fechaSQL[0];

    $fechaSQL = explode("/", $fechaFin);
    $fechaFin = $fechaSQL[2] . "-" . $fechaSQL[1] . "-" . $fechaSQL[0];

    
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
       <table width="785" border="1" align="center">
<tr>
    <td colspan="2" rowspan="6"><div align="center"></div></td>
    <td colspan="8"><center><div align="center"><strong>INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS</strong></div></center></td>
    <td colspan="2" rowspan="6"><div align="center"></div></td>
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
                    <td width="55">&nbsp;</td>
                    <td width="98">&nbsp;</td>
                    <td  align="center"><div align="center"><strong>SERVICIOS ESCOLARES</strong></div></td>
                    <td width="95">&nbsp;</td>
                    <td width="78">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="23">&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                    <tr>
                    <td height="23">&nbsp;</td>
                    <td colspan="2"><span class="Estilo6">FECHA DE APLICACION: <?php echo $fechaInicio22." - ".$fechaInicio22; ?><span class="Estilo7"></span><span class="Estilo7"></span><span class="Estilo7"></span><span class="Estilo7"></span></span></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                    <tr>
                    <td height="23">&nbsp;</td>
                    <td colspan="2"><span class="Estilo7"><strong>CARRERA: <strong><?php echo $carreraReporte ?></strong></strong></span></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
</table>  

<table width="0" height="92" border="1"  aling="center">
  <tr>
    <td align="center" style="border-width: 0px;border: solid;"><div align="center"><span class="Estilo5">No. FOLIO</span></div></td>
    <td  align="center" style="border-width: 0px;border: solid;"><div align="center"><span class="Estilo5">NOMBRE DEL ALUMNO</span></div></td>
  </tr>
           <?
    
  

  
  $contador2=1;
  $result = $Obras->ConReporteDocumentacionAlumnos($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fechaInicio, $fechaFin);
 while ($row = mysql_fetch_assoc($result)) {


$nombre=strtoupper($row[NombreCompleto]);

  if ($row['nombreCarrera']=="ENSEÑANZA DEL INGLES"){
     
    $puntosTotales=$row['a1']+$row['a2']+$row['a3']+$row['a4']+$row['a5']+$row['a6']+$row['a7']+$row['a8']+$row['a9']+$row['a10']+$row['a11'];
    $puntosTotales=($puntosTotales*.70)+30;
     $puntosTotales = explode(".",$puntosTotales);
      $puntosTotales = $puntosTotales[0];
	
     
 }else{     
         
       $puntosTotales=$row['a1']+$row['a2']+$row['a3']+$row['a4']+$row['a5']+$row['a6']+$row['a7']+$row['a8']+$row['a9']+$row['a10']+$row['a11'];
            if($puntosTotales==0){
                $puntosTotales = "NP";
            }else{
                $puntosTotales = explode(".",$puntosTotales);
                $puntosTotales = $puntosTotales[0];
            }
    }//fin condicion   
  
  
  //$puntosTotales=$value->a1+$value->a2+$value->a3+$value->a4+$value->a5+$value->a6+$value->a7+$value->a8+$value->a9+$value->a10+$value->a11;
        
        $html2="        
   <tr>
    <td height='0'  align='center' style='border-width: 0px;border: solid;'><div align='center'><span class='Estilo7'>$contador2</span></div></td>
    <td  align='left' style='border-width: 0px;border: solid;'><span class='Estilo7'>$nombre</span></td>
  </tr>

                
                ";
$contador2=$contador2+1;
 $html4=$html4.$html2;
        }
      
        
        echo $html4;
            
            ?>
        </table>

    </body>
</html>


 
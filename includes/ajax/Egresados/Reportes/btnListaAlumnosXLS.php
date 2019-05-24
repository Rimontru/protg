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
	$opcionGrafica = $_GET['opcionGrafica'];

    $Result22 = $Obras->verTrabajadoresDirectoresReportes($fk_carreras);
    if ($Result22) {
        $row222 = mysql_fetch_assoc($Result22);
        $nombreDirector = ($row222[NombreCompletoDirector]);
        $carreraReporte = ($row222[nombreCarrera]);

        mysql_free_result($Result22);
    }


if($fk_modalidad=="1"){
		$ModalidadReporte="SEMESTRAL";
         }else	if($fk_modalidad=="2"){
		$ModalidadReporte="CUATRIMESTRAL";
         }else if($fk_modalidad=="3"){
		$ModalidadReporte="MIXTO";
         }

            $generacionLista = $row1['DescripcionGeneracion'];

//error_reporting(0);
date_default_timezone_set("America/Mexico_City");
$today = date("d-m-Y");
$Nomb_Archivo = 'ListaAlumnosDatosPrincipales_' . $today . '.xls';

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

<?
    $Result22 = $Obras->verTrabajadoresDirectoresReportes($fk_carreras);
    if ($Result22) {
        $row222 = mysql_fetch_assoc($Result22);
        $nombreDirector = ($row222[NombreCompletoDirector]);
        $carreraReporte = ($row222[nombreCarrera]);


echo "    <td colspan='12'><strong>CARRERA: </strong>".$row222['nombreCarrera']."<strong> .
				   MODALIDAD: </strong> ".$ModalidadReporte."
";

        mysql_free_result($Result22);
    }


$Result1 = $Obras->ConCantidadEgresados($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion);
    if ($Result1) {
        $row1 = mysql_fetch_assoc($Result1);
        $cantidadTotalEgresados = $row1['cantidadTotalEgresados'];
        $generacionLista = $row1['DescripcionGeneracion'];


			echo " <STRONG>GENERACION</STRONG> ".$generacionLista." </td>
";


        mysql_free_result($Result1);
    }

?>

  </tr>

         <tr>
            <td colspan="6"></td>
            <td colspan="3"></td>
          </tr>
        </table>


<table width="988" height="48" border="0" align="center"  id="Exportar_a_Excel">
  <tr>
    <td width="48"   align="center" bgcolor="#999999"><span class="Estilo1"><strong>No</strong></span></td>
    <td width="75"  align="center" bgcolor="#999999"><span class="Estilo1"><strong>Matrícula</strong></span></td>
    <td width="135"  align="center" bgcolor="#999999"><span class="Estilo1"><strong>Nombre</strong></span></td>
    <td width="105"  align="center" bgcolor="#999999"><span class="Estilo1"><strong>Labora</strong></span></td>
    <td width="105"  align="center" bgcolor="#999999"><span class="Estilo1"><strong>Ingreso Actual</strong></span></td>
    <td width="105"  align="center" bgcolor="#999999"><span class="Estilo1"><strong>Tiempo en emplearse</strong></span></td>
    <td width="105"  align="center" bgcolor="#999999"><span class="Estilo1"><strong>Plan de estudios</strong></span></td>
    <td width="105"  align="center" bgcolor="#999999"><span class="Estilo1"><strong>Grado de satisfacción</strong></span></td>
    <td width="105"  align="center" bgcolor="#999999"><span class="Estilo1"><strong>Aspecto y Debilidad</strong></span></td>
    <td width="105"  align="center" bgcolor="#999999"><span class="Estilo1"><strong>Reelegir Institución</strong></span></td>
    <td width="105"  align="center" bgcolor="#999999"><span class="Estilo1"><strong>Estudiar Maestría</strong></span></td>

  </tr>
            <?
           $contador2=0;



                    $result33 = $Obras->btnListaAlumnos($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fk_generacion);

					$fechaSQL = explode("-", $fecha);
					//$row33 = mysql_fetch_assoc($result33);
					$teleFijo=$row['telefonofijo'];
					$teleCelular=$row['telefonocelular'];
					$correo=$row['correo'];
					$generacionListaNumero = $row['generacionNumero'];
					$generacionLista = $row['DescripcionGeneracion'];
					$contador2 = $contador2 + 1;
					$fechaSQL = explode("-", $row['FechaTomaProtesta']);
					$fechaLista = $fechaSQL[2] . "/" . $fechaSQL[1] . "/" . $fechaSQL[0];


					$estatusTrabajo = $row33['estatusTrabajo'];

					if($estatusTrabajo == "1"){

						$estatusTrabajoLetra = "SI";
					}else{

						$estatusTrabajoLetra = "NO";

						}

                   if ($result33) {
                            while ($row33 = mysql_fetch_assoc($result33)) {

				                    /*Condicion para saber si trabaja o no*/
									if($row33['estatusTrabajo'] == "1"){
										$estatusTrabajoLetra = "SI";
									}else{
										$estatusTrabajoLetra = "NO";
										}

                                    ($row33['nuevaUno']==1) ? $rpt1='SI' : $rpt1='NO';
                                    ($row33['nuevaDos']==1) ? $rpt2='SI' : $rpt2='NO';

									$ingresoActual = $row33['descripcion_ingresoactual'];
									$tiempoEncontrar = $row33['descripcion_tiempo'];
									$gradoSatisfaccion = $row33['descripcion_gradosatisfaccion'];
                                    $aspectoDebilidad = $row33['descripcion_aspectodebilidad'];
									$aspectoDebilidad = $row33['descripcion_aspectodebilidad'];


										/*Impresion del contenido*/
                                        echo "<tr class='Estilo1' >
                                                    <td class='Estilo1' width='24'>$contador2</td>
                                                    <td class='Estilo1'>".$row33['matricula']."</td>
                                                    <td class='Estilo1'>".$row33['NombreCompleto']."</td>
                                                    <td class='Estilo1'>".$estatusTrabajoLetra."</td>
                                                    <td class='Estilo1'>".$ingresoActual."</td>
                                                    <td class='Estilo1'>".$tiempoEncontrar."</td>
                                                    <td class='Estilo1'>".$row33['plandeestudioscalificacion']."</td>
                                                    <td class='Estilo1'>".$gradoSatisfaccion."</td>
                                                    <td class='Estilo1'>".$aspectoDebilidad."</td>
                                                    <td class='Estilo1'>".$rpt1."</td>
                                                    <td class='Estilo1'>".$rpt2."</td>

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



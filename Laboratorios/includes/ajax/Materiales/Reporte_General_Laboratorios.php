<?
error_reporting(E_ALL ^ E_DEPRECATED);
$Ruta = "../../";
require($Ruta . "Config.class.php");  # Cargar datos conexion y otras variables.
require($Ruta . 'DB.class.php');
require($Ruta . 'ConsultaDB.class.php');
require($Ruta . "MisValidaciones.class.php");

extract($_POST);
extract($_GET);




$ConsultaIndi = new ConsultaDB;

date_default_timezone_set("America/Mexico_City");
$today = date("d-m-Y");
$Nomb_Archivo = 'Reporte_General_Contratos_' . $today . '.xls';

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
        <table border="0" width="100%">
            <tr>
                <th align="center" bgcolor="#CCCCCC">No:</th> 
                <th align="center" bgcolor="#CCCCCC">Laboratorio:</th>
                <th align="center" bgcolor="#CCCCCC">Descripcion:</th>
                <th align="center" bgcolor="#CCCCCC">Unidad de Medida:</th>
                <th align="center" bgcolor="#CCCCCC">Cantidad:</th>  
                <th align="center" bgcolor="#CCCCCC">Medidas:</th>  
                <th align="center" bgcolor="#CCCCCC">Tipo de Material:</th>  
                <th align="center" bgcolor="#CCCCCC">Marca</th>  
                <th align="center" bgcolor="#CCCCCC">Estado:</th>
                <th align="center" bgcolor="#CCCCCC">Observaciones:</th>
                <th align="center" bgcolor="#CCCCCC">Almacenado</th>
                <th align="center" bgcolor="#CCCCCC">Uso</th>
                <th align="center" bgcolor="#CCCCCC">Frecuencia de Uso:</th>
                <th align="center" bgcolor="#CCCCCC">Numero de Inventario:</th>
                <th align="center" bgcolor="#CCCCCC">Clase de Material:</th>
               
            <?
            $html = "";
            $Activo = 1;
            
           $Sentencias="";
           if ($Pk_laboratorios == 10) {                
                $Sentencias .= "";
            }else  if ($Pk_laboratorios != 0) {
                $Sentencias .= " AND tbl_material.fk_laboratorios='" . $Pk_laboratorios . "' ";
            }
           if ($pk_clasematerial != 0) {
                $Sentencias .= " AND tbl_material.fk_clasematerial='" . $pk_clasematerial . "' ";
            }


//            $Parametros = "
//                   AND Contratista_Ganador='1' $Sentencias GROUP BY Fk_LlaveObra"; 

            $ResultDireccion = $ConsultaIndi->ConsultaMaterialesListadoReporteExcel($Sentencias);
            while ($row = mysql_fetch_assoc($ResultDireccion)) {


                $html.= "<tr>
                             <td valign='top'>" . utf8_encode($row['Pk_material']) . "</td>
                             <td valign='top'>" . utf8_encode($row['DescripcionLaboratorios']) . "</td>
                             <td valign='top'>" . utf8_encode($row['DescripcionMaterial']) . "</td>
                             <td valign='top'>" . utf8_encode($row['Descripcion_UnidadMedida']) . "</td>
                             <td valign='top'>" . utf8_encode($row['CantidadMaterial']) . "</td>
                             <td valign='top'>" . utf8_encode($row['MedidasMaterial']) . "</td>
                             <td valign='top'>" . utf8_encode($row['DescripcionTipoMaterial']) . "</td>                
                             <td valign='top'>" . utf8_encode($row['MarcaMaterial']) . "</td>
                             <td valign='top'>" . utf8_encode($row['Descripcion_EstadoMaterial']) . "</td>
                             <td valign='top'>" . utf8_encode($row['ObservacionesMaterial']) . "</td>
                             <td valign='top'>" . utf8_encode($row['Almacenado']) . "</td>
                             <td valign='top'>" . utf8_encode($row['Uso']) . "</td>
                             <td valign='top'>" . utf8_encode($row['descrip_frecuenciauso']) . "</td>
                             <td valign='top'>" . utf8_encode($row['NumeroInventario']) . "</td>    
                                 <td valign='top'>" . utf8_encode($row['descrip_clasematerial']) . "</td>    
                                
                     </tr>";
            }
            mysql_free_result($ResultDireccion);
            echo ($html);
            ?>
        </table>

    </body>
</html>


 
<?php
require_once("../includes/Config.class.php");  # Cargar datos conexion y otras variables.
require_once('../includes/DB.class.php');
require_once('../includes/ConsultaDB.class.php');
require_once('../mpdf/mpdf.php');
require_once('../includes/MisFunciones.class.php');

$Obras = new ConsultaDB;
$Nomb_Archivo = 'ErrorAlumnosEgresados' . $today . '.xls';

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=" . $Nomb_Archivo);

?>
<html>
<head>
    <title>REPORTE</title>
</head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<body>     

<table border="1">
	<thead>
    <tr>
        <td>MATRICULA</td>
        <td>Nombre Generacion</td>
        <td>Estado Titulacion</td>
        <td>No.Acta Titulo</td>
        <td>Expedicion Titulo</td>
        <td>Tipo Acreditacion</td>
        <td>Toma Protesta</td>
        <td>Opcion de Titulacion</td>
        <td>Fecha Solicitud</td>
        <td>Fecha Examen</td>
    </tr>
    </thead>
</table>
<table>
<tbody>
<?php
	$result=$Obras->filtroAlumonosEgresadosError();
		if($result){
			while ($row = mysql_fetch_assoc($result)) {
				
				if($row['fk_estadoTitulacion']=='1') {
					$fk_estadoTitulacion="Titulado";
				}elseif($row['fk_estadoTitulacion']=='2'){
			 		$fk_estadoTitulacion="No Titulado";
				}elseif($row['fk_estadoTitulacion']=='3'){
					$fk_estadoTitulacion="No Aplica";
				}else{
					$fk_estadoTitulacion="No llenaron";
				}
					
				switch($row['fk_titulacion']){
					case 1:
						$opcion = 'Estudios de Posgrado (50% de Maestria)';
					break;
					
					case 2:
						$opcion = 'Promedio General de Calificaciones';
					break;
					
					case 3:
						$opcion = 'Sustentación de Examen por Areas de Conocimiento';
					break;
					
					case 4:
						$opcion = 'Sustentación de Examen por Areas de Conocimiento (CENEVAL)';
					break;
					
					case 5:
						$opcion = 'Estudios de Posgrado (100% de Especialidad)';
					break;
					
					case 6:
						$opcion = 'Curso de Titulación';
					break;
					
					case 7:
						$opcion = 'Tesis Profesional';
					break;
					
					case 8:
						$opcion = 'Experiencia Profesional';
					break;
				
					case 9:
						$opcion = 'No Aplica';
					break;
					
					case 10:
						$opcion = 'Tesis de Grado';
					break;
					
					case 11:
						$opcion = 'Estudios de Posgrado (50% de Doctorado)';
					break;
					
					case 12:
						$opcion = 'Tesis Profesional Colectiva';
					break;
					
					case '':
						$opcion = 'no llenaron';
					break;
					
					case 'Null':
						$opcion = 'mal llenado';
					break;
					
				}
					
				
				echo "
						<tr>
							<td>".$row['matricula']."</td>
							<td>".$row['generacionSecre']."</td>
							<td>".$fk_estadoTitulacion."</td>
							<td>".$row['noactatitulo']."</td>
							<td>".$row['fechaexpediciontitulo']."</td>
							<td>".$row['TipoAcreditacion']."</td>
							<td>".$row['FechaTomaProtesta']."</td>
							<td>".$opcion."</td>
							<td>".$row['FechaSolicitud']."</td>
							<td>".$row['FechaExamen']."</td>
						</tr>
					";
				$html4 = $html4 . $html2;
			}
			mysql_free_result($result);
		}
?>
</tbody>
</table>
</body>
</html>
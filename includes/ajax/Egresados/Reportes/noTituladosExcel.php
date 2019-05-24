<?php 
date_default_timezone_set('America/Mexico_City');
if (PHP_SAPI == 'cli')
		die('Este archivo solo se puede ver desde un navegador web');

require_once("../../../Config.class.php");  # Cargar datos conexion y otras variables.
require_once('../../../DB.class.php');
require_once('../../../ConsultaDB.class.php');
require_once('../../../MisFunciones.class.php');
require_once('../../../ConvertirNumLetra.php');
require_once('../../../DeNumero_a_Letras.php');
/** Se agrega la libreria PHPExcel */
require_once('../../../PHPExcel.php');

// Se crea el objeto PHPExcel
$objPHPExcel = new PHPExcel();

//creamo objeto de conexion para realizar consultas 
 $Obras = new ConsultaDB;
 $Funciones = new MisFunciones;
 
//recibimos parametros par4a la consulta 
$nivel = $_GET['nivel'];
$modalidad = $_GET['modalidad'];
$estadoTitulo = $_GET['estadoTitulo'];
			
////////////////////////////////////////////////////////////////////////
//traemos todas las licenciaturas que tenemos de acuerdo al plan 
$rs_carrera = $Obras->TodasCarreras();
$row_carrera = mysql_fetch_assoc($rs_carrera);

$position = 0;
do{
	$row_alumno = $Obras->consutaGenralTodasCarreras($nivel, $modalidad, $estadoTitulo, $row_carrera['pk_carreras']);
	if($row_alumno){		
			$nombreCarrera = utf8_decode($row_carrera['clvCarrera']);
		//===================================Un array de estilos para las cabezas de la tabla====================================
			$styleArray = array(
			'fill' => array(
		                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
		                    'color' => array('rgb'=>'BEC0BF'),
		            ),
			'font'  => array(
		        'bold'  => true,
		        'color' => array('rgb' => '000000'),
		        'size'  => 15,
		        'name'  => 'Lucida Sans Unicode'
			));
		//========================================================================================================================		

				// Se asignan las propiedades del libro
				$objPHPExcel->getProperties()->setCreator("INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS") //Autor
							->setLastModifiedBy("UNIVERSIDAD SALAZAR") //Ultimo usuario que lo modificó
							->setTitle("REPORTE DE EGRESADOS") 
							->setSubject("Reporte") 
							->setDescription("Reporte estadistico de egresados del IESCH.") 
							->setKeywords("IESCH") 
							->setCategory("Reportes");
				$objPHPExcel -> getDefaultStyle()->getAlignment()->setVertical(
					PHPExcel_Style_Alignment::VERTICAL_TOP
				);
				$objPHPExcel -> getDefaultStyle()->getAlignment()->setHorizontal(
					PHPExcel_Style_Alignment::HORIZONTAL_CENTER
				);
				$objPHPExcel -> getDefaultStyle()->getFont()->setName('Arial');
				$objPHPExcel -> getDefaultStyle()->getFont()->setSize(12);
				$objPHPExcel -> setActiveSheetIndex($position);
				$objPHPExcel -> getActiveSheet()->getPageSetup()->setOrientation(
					PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE
				)->setFitToWidth(1)
				 ->setFitToHeight(0);					
				//Se ponen la cabeza y pie de pagina (ver pag. 23 - 24 phpexcel develop doc).
				$objPHPExcel -> getActiveSheet()->getHeaderFooter()
					->setOddHeader('&C&B&16'.$objPHPExcel->getProperties()->getTitle())
					->setOddFooter('&CHOJA &p de &N');
				//Empieza el ingreso de datos (-:
				$objPHPExcel->setActiveSheetIndex($position)->mergeCells('A1:D1');		//con esto fusiono las celda A2:B2 :-)
				$objPHPExcel -> getActiveSheet()->setCellValue('A1', "INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS");
				$objPHPExcel->setActiveSheetIndex($position)->mergeCells('A2:D2');		//con esto fusiono las celda A2:B2 :-)
				$objPHPExcel -> getActiveSheet()->setCellValue('A2', "INCORPORADO A LA SECRETARIA DE EDUCACIoN");
				$objPHPExcel->setActiveSheetIndex($position)->mergeCells('A3:D3');
				$objPHPExcel -> getActiveSheet()->setCellValue('A3', "OFICIO No. 0233 DE FECHA 03 DE NOVIEMBRE DE 1983");
				$objPHPExcel->setActiveSheetIndex($position)->mergeCells('A4:D4');
				$objPHPExcel -> getActiveSheet()->setCellValue('A4', "ReGIMEN: PARTICULAR CLAVE: 07PSU0002D");
				$objPHPExcel->setActiveSheetIndex($position)->mergeCells('A5:D5');
				$objPHPExcel -> getActiveSheet()->setCellValue('A5', "EXCELENCIA ACADeMICA: REG. SEP/PSA/2009/030 ");
				$objPHPExcel->setActiveSheetIndex($position)->mergeCells('A6:D6');
				$objPHPExcel -> getActiveSheet($position)->setCellValue('A6', "SERVICIOS ESCOLARES DEPARTAMENTO DE EGRESADOS");
				$objPHPExcel -> getActiveSheet($position)->getStyle('A1:D8')->getAlignment()->setHorizontal(
					PHPExcel_Style_Alignment::HORIZONTAL_CENTER
				)->setWrapText(true);
				//Inserto una imagen eeeh!!
				// $objDrawing = new PHPExcel_Worksheet_Drawing();
				// $objDrawing->setName('Conalep logo');
				// $objDrawing->setDescription('Conalep logo');
				// $objDrawing->setPath('../../images/logoconalep.png');       // filesystem reference for the image file
				// //$objDrawing->setHeight(36);                 // sets the image height to 36px (overriding the actual image height); 
				// $objDrawing->setCoordinates('W1');    // pins the top-left corner of the image to cell D24
				// $objDrawing->setOffsetX(10);                // pins the top left corner of the image at an offset of 10 points horizontally to the right of the top-left corner of the cell
				// $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
				//poniendo lostitulos 
		
				$titulosColumnas = array('No','Matricula','Nombre','Ciclo Escolar');
				/*$objPHPExcel->setActiveSheetIndex(0)
							->mergeCells('A1:N1');*/		
				// Se agregan los titulos del reporte
				$objPHPExcel->setActiveSheetIndex($position)
							->setCellValue('A9',  utf8_decode($titulosColumnas[0]))
							->setCellValue('B9',  utf8_decode($titulosColumnas[1]))
							->setCellValue('C9',  utf8_decode($titulosColumnas[2]))
							->setCellValue('D9',  utf8_decode($titulosColumnas[3]));
				$inicia = $fila= 9;			
				foreach($row_alumno as $val){
					$fila++;
						$objPHPExcel->setActiveSheetIndex($position)
							->setCellValue('A'.$fila,  utf8_decode($val->pk_alumno))
							->setCellValue('B'.$fila,  utf8_decode($val->matricula))
							->setCellValue('C'.$fila,  utf8_decode($val->nombre.' '.$val->apaterno.' '.$val->amaterno))
							->setCellValue('D'.$fila,  utf8_decode($val->generacionSecre));	

				}//while($row_alumno = @mysql_fetch_assoc($rsult));		

				//se aplica estilo a la colimna de encabezados 
				$estiloInformacion = new PHPExcel_Style();
				$objPHPExcel->getActiveSheet()->getStyle('A9:D9')->applyFromArray($styleArray);
				
				for($i = 'A'; $i <= 'D'; $i++){
					$objPHPExcel->setActiveSheetIndex($position)
								->getColumnDimension($i)->setAutoSize(TRUE);
				}

				$objPHPExcel -> getActiveSheet($position)->getStyle('A'.$inicia.':D'.$fila)->getAlignment()->setHorizontal(
					PHPExcel_Style_Alignment::HORIZONTAL_LEFT
				)->setWrapText(true);
				// Rename second worksheet
				$objPHPExcel->getActiveSheet()->setTitle($nombreCarrera);
				//$objPHPExcel->getSheetCount();
		//========================================================================================================================		

		$position++;	
		$objPHPExcel->createSheet();//se crean las pestañas 
		$objPHPExcel->setActiveSheetIndex($position);
	}
}while($row_carrera = mysql_fetch_assoc($rs_carrera));//fin de foreach de carreras

// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
$objPHPExcel->setActiveSheetIndex(0);
//final de el libro de exel 
// Inmovilizar paneles 
//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
//$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="EgresadosDepto.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>
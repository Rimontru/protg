<?php
date_default_timezone_set('America/Mexico_City');
require_once("../clases/includes/params_DB.php");
require_once("../clases/includes/conexion_DB.php");
require_once("../clases/includes/consultas_DB.php");


require_once("../clases/fpdf/fpdf.php");
require_once("../clases/jpgraph-4.0.2/src/jpgraph.php");
require_once("../clases/jpgraph-4.0.2/src/jpgraph_pie.php");
require_once("../clases/jpgraph-4.0.2/src/jpgraph_pie3d.php");

class Reporte extends FPDF{
	
	public function __construct($orientation='L', $unit='cm', $format='letter'){
		parent::__construct($orientation, $unit, $format);
	} 
	
	public function gaficoPDF($datos = array(),$nombreGrafico = NULL,$ubicacionTamamo = array(),$titulo = NULL){ 
	 $legen= new Legend;
		//construccion de los arrays de los ejes x e y
		if(!is_array($datos) || !is_array($ubicacionTamamo)){
			echo "los datos del grafico y la ubicacion deben de ser arreglos";
		}
		elseif($nombreGrafico == NULL){
			echo "debe indicar el nombre del grafico a crear";
		}
		else{ 
			#obtenemos los datos del grafico  
			foreach ($datos as $key => $value){
				$data[] = $value[0];
				$nombres[] = $key; 
			} 
			$x = $ubicacionTamamo[0];
			$y = $ubicacionTamamo[1]; 
			$ancho = $ubicacionTamamo[2];  
			$altura = $ubicacionTamamo[3];  
			
			#Creamos un grafico vacio
			$graph = new PieGraph(600,400,'auto');
			
				#indicamos titulo del grafico si lo indicamos como parametro
				if(!empty($titulo)){
					$graph->title->Set($titulo);
				}   
				
			//Creamos el plot de tipo tarta
			$p1 = new PiePlot3D($data);
			
		/*indicamos la leyenda para cada porcion de la tarta
		$graph->legend->SetPos(0.05,0.99,'right','bottom');
		$p1->SetLegends($nombres);*/
		
		
		
		//Añadimos el plot al grafico
		$graph->Add($p1);
		
		//mostramos el grafico en pantalla
		$graph->Stroke($nombreGrafico); 
		$this->Image($nombreGrafico,$x,$y,$ancho,$altura);  
		} 
		
	} 
}

#############################################################################################################################
if(isset($_GET)){
	extract($_GET);
$db= new conexion();
$cons= new consultas();
$mes=array(01=>'ENERO',03=>'MARZO',04=>'ABRIL',06=>'JUNIO',07=>'JULIO',09=>'SEPTIEMBRE',10=>'OCTUBRE',12=>'DICIEMBRE');	

	if($periodo!=NULL){
		$periodo=str_replace('a',$anio,$periodo);
		$fech_periodo=substr($periodo,4,6);
		$result=$cons->verPeriodoPDF($fech_periodo);
		$row=$db->getRows($result);
			extract($row);
		$tipoReporte=$descripcion_periodo;
	}
	else{
		$periodo=$anio.'-01-01|'.$anio.'-12-31';
		$tipoReporte='ANUAL';
	}
	$result=$cons->CuentaEltotalDePersonasPorPeriodo($periodo);
		$row=$db->getRows($result);
			extract($row);
			
	$result=$cons->CuentaRespuestasPorNoDePregunta($pregunta,$periodo);
		$re=explode('|',$result);
			$MALO=$re[0]; $REGULAR=$re[1]; $BUENO=$re[2]; $EXCELENTE=$re[3];
	
	$result=$cons->verPreguntaPDF($pregunta);
	$row=$db->getRows($result);
		extract($row);
	
	$pdf=new Reporte();//creamos el documento pdf
	$pdf->AddPage();//agregamos la pagina
	
	$pdf->SetFont("Arial","B",14);
	$pdf->MultiCell(0,.7,utf8_decode("INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS"),0,'C');
	$pdf->MultiCell(0,.7,utf8_decode("INCORPORADO A LA SECRETARÍA DE EDUCACIÓN"),0,'C');
	$pdf->MultiCell(0,.7,utf8_decode("OFICIO No.0233 DE FECHA 03 DE NOVIEMBRE DE 1983"),0,'C');
	$pdf->MultiCell(0,.7,utf8_decode("REGIMEN: PARTICULAR   CLAVE: 07PSU0002D."),0,'C');
	$pdf->MultiCell(0,.7,utf8_decode("SERVICIOS ESCOLARES"),0,'C');
	
	$pdf->Ln(.7);
	$pdf->SetFont("Arial","B",11);
	$pdf->MultiCell(0,.7,utf8_decode("ENCUESTA DE CALIDAD EN EL SERVICIO APLICADA POR LA DIRECCIÓN DE SERVICIOS ESCOLARES"),0,'C');
	
	$pdf->Image('../images/EscudoIesch.png',2,1.1,3);
	$pdf->Image('../images/fimpes.png',23,1.1,3);	
	$pdf->Ln(1);
	$pdf->SetFont("Arial","B",11);
	$pdf->MultiCell(0,.7,utf8_decode("REPORTE ".$tipoReporte." ".$anio),0,'L');
	$pdf->Ln(.4);
	$pdf->SetFont("Arial","B",9);
	$pdf->MultiCell(0,.7,$pregunta.'. '.utf8_decode($desc_pregunta),0,'C');
	
	#ENCABEZADO LEYENDA
	$pdf->SetFont("Arial","I",9);	
	$pdf->SetXY(2,11.8);
	#$pdf->SetTextColor(000,000,000);
	$pdf->MultiCell(2.2,.7,"OPCIONES",1,'L');
	$pdf->SetXY(4.2,11.8);
	$pdf->MultiCell(2.2,.7,"PERSONAS",1,'L');
	$pdf->SetXY(6.4,11.8);
	$pdf->MultiCell(2.2,.7,"EFICIENCIA",1,'L');
	
	
	#LEYENDA PLOT HECHO A MI GUSTO PRIMER PARTE
	$pdf->SetFont("Arial","I",9);	
	$pdf->SetXY(2,12.5);
	#$pdf->SetTextColor(059,131,189);
	$pdf->MultiCell(2.2,.7,"EXCELENTE",1,'L');
	$pdf->SetX(2);
	#$pdf->SetTextColor(234,137,154);
	$pdf->MultiCell(2.2,.7,"BUENO",1,'L');
	$pdf->SetX(2);
	#$pdf->SetTextColor(0,255,127);
	$pdf->MultiCell(2.2,.7,"REGULAR",1,'L');
	$pdf->SetX(2);
	#$pdf->SetTextColor(231,037,018);
	$pdf->MultiCell(2.2,.7,"MALO",1,'l');
	$pdf->SetX(2);
	#$pdf->SetTextColor(000,000,000);
	$pdf->MultiCell(2.2,.7,"TOTAL",1,'C');
	
	
	#LEYENDA PLOT HECHO A MI GUSTO SEGUNDA PARTE
	$pdf->SetFont("Arial","I",9);	
	$pdf->SetXY(4.2,12.5);
	#$pdf->SetTextColor(059,131,189);
	$pdf->MultiCell(2.2,.7,$EXCELENTE,1,'C');
	$pdf->SetX(4.2);
	#$pdf->SetTextColor(234,137,154);
	$pdf->MultiCell(2.2,.7,$BUENO,1,'C');
	$pdf->SetX(4.2);
	#$pdf->SetTextColor(0,255,127);
	$pdf->MultiCell(2.2,.7,$REGULAR,1,'C');
	$pdf->SetX(4.2);
	#$pdf->SetTextColor(231,037,018);
	$pdf->MultiCell(2.2,.7,$MALO,1,'C');
	$pdf->SetX(4.2);
	#$pdf->SetTextColor(000,000,000);
	$pdf->MultiCell(2.2,.7,($EXCELENTE+$BUENO+$REGULAR+$MALO),1,'C');
		
		
	#LEYENDA PLOT HECHO A MI GUSTO TERCER PARTE COLUMNA
	$pdf->SetFont("Arial","I",9);	
	$pdf->SetXY(6.4,12.5);
	#$pdf->SetTextColor(059,131,189);
	$pdf->MultiCell(2.2,.7,$TE=round(($EXCELENTE/$TotalPersonas)*100).' %',1,'C');
	$pdf->SetX(6.4);
	#$pdf->SetTextColor(234,137,154);
	$pdf->MultiCell(2.2,.7,$TB=round(($BUENO/$TotalPersonas)*100).' %',1,'C');
	$pdf->SetX(6.4);
	#$pdf->SetTextColor(0,255,127);
	$pdf->MultiCell(2.2,.7,$TR=round(($REGULAR/$TotalPersonas)*100).' %',1,'C');
	$pdf->SetX(6.4);
	#$pdf->SetTextColor(231,037,018);
	$pdf->MultiCell(2.2,.7,$TM=round(($MALO/$TotalPersonas)*100).' %',1,'C');
	$pdf->SetX(6.4);
	#$pdf->SetTextColor(000,000,000);
	$pdf->MultiCell(2.2,.7,($TE+$TB+$TR+$TM).' %',1,'C');
	
	
	#PIE
	#$pdf->SetTextColor(0,0,0);	
	$pdf->SetFont("Arial","I",6);
	$pdf->SetY(18.5);
	$pdf->MultiCell(0,.7,utf8_decode('Fecha de impresión: ').date('d-m-Y'),0,'R');
	
	
	
	$caracteres='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	$longpalabra=3;
	for($clave='', $n=strlen($caracteres)-1; strlen($clave) < $longpalabra ; ) {
	  $x = rand(0,$n);
	  $clave.= $caracteres[$x];
	}
	$Nomgrafica='GraficaPDF_'.strtoupper($clave).'.png';
	$fecha = date("d/m/Y");
	$nom_archivo=$Nomgrafica.'_'.$fecha.'.pdf';
	
	$pdf->gaficoPDF(array('EXCELENTE'=>array($EXCELENTE),'BUENO'=>array($BUENO),'REGULAR'=>array($REGULAR),'MALO'=>array($MALO)),
	$Nomgrafica,
	array(10,9,15,9.5),'');
					
					
					
	$pdf->Output($nom_archivo, 'I');
	unlink($Nomgrafica); 
}
?>
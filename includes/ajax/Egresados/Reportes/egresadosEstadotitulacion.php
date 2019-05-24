<?php 
require_once("../../../../includes/Config.class.php");  # Cargar datos conexion y otras variables.
require_once('../../../../includes/DB.class.php');
require_once('../../../../includes/ConsultaDB.class.php');
require_once('../../../../includes/MisFunciones.class.php');
require_once('../../../../includes/ConvertirNumLetra.php');
require_once('../../../../includes/DeNumero_a_Letras.php');
require_once('../../../../fpdf/fpdf.php');

class PDF extends FPDF
{
	public $ruta;
	public $fecha;	 
    public $plantel;
    public $clave;
    public $anio;
    public $mes;
    public $nomFinan;
    public $cvlFinan;
    public $nombreUsuario;         
    private $widths;
    private $aligns;
    public $nombreReporte;   
    public $nombreCarrera;       

    //funciones para la tabla 
    function SetWidths($w){
        //Set the array of column widths
        $this->widths=$w;
    }
    function SetAligns($a){
        //Set the array of column alignments
        $this->aligns=$a;
    }
    function Row($data){
    //Calculate the height of the row
	    $nb=0;
	    for($i=0;$i<count($data);$i++)
	            $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
	    $h=5*$nb;
	    //Issue a page break first if needed
	    $this->CheckPageBreak($h);
	    //Draw the cells of the row
	    for($i=0;$i<count($data);$i++)
	    {
	            $w=$this->widths[$i];
	            $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
	            //Save the current position
	            $x=$this->GetX();
	            $y=$this->GetY();
	            //Draw the border
	            $this->Rect($x,$y,$w,$h);
	            //Print the text
	            $this->MultiCell($w,5,$data[$i],0,$a);
	            //Put the position to the right of the cell
	            $this->SetXY($x+$w,$y);
	    }
	    //Go to the next line
	    $this->Ln($h);
	}
    function CheckPageBreak($h){
        //If the height h would cause an overflow, add a new page immediately
        if($this->GetY()+$h>$this->PageBreakTrigger) $this->AddPage($this->CurOrientation);
    }
    function NbLines($w,$txt){
        //Computes the number of lines a MultiCell of width w will take
        $cw=&$this->CurrentFont['cw'];
        if($w==0)
                $w=$this->w-$this->rMargin-$this->x;
        $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
        $s=str_replace("\r",'',$txt);
        $nb=strlen($s);
        if($nb>0 and $s[$nb-1]=="\n")
                $nb--;
        $sep=-1;
        $i=0;
        $j=0;
        $l=0;
        $nl=1;
        while($i<$nb)
        {
                $c=$s[$i];
                if($c=="\n")
                {
                        $i++;
                        $sep=-1;
                        $j=$i;
                        $l=0;
                        $nl++;
                        continue;
                }
                if($c==' ')
                        $sep=$i;
                $l+=$cw[$c];
                if($l>$wmax)
                {
                        if($sep==-1)
                        {
                                if($i==$j)
                                        $i++;
                        }
                        else
                                $i=$sep+1;
                        $sep=-1;
                        $j=$i;
                        $l=0;
                        $nl++;
                }
                else
                        $i++;
        }
        return $nl;
    }
    // Cabecera de página	
	 function Header()
	 {
	 	//ENCABEZADO VACIO CALCULAMOS ESPACIO  
		$this->Image('../../../../assets/img/EscudoIesch.png',13,10,25,25);
		$this->Image('../../../../assets/img/fimpes.png',175,10,25,25);
		$this->SetFont('Arial','',9);
		$this->Cell(0,4,'INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS',0,0,'C');
		$this->Ln(4);

		$this->Cell(0,4,utf8_decode('INCORPORADO A LA SECRETARIA DE EDUCACIÓN'),0,0,'C');
		$this->Ln(4);
		
		$this->Cell(0,4,'OFICIO No. 0233 DE FECHA 03 DE NOVIEMBRE DE 1983',0,0,'C');
		$this->Ln(4);

		$this->Cell(0,4,utf8_decode('RÉGIMEN: PARTICULAR CLAVE: 07PSU0002D'),0,0,'C');
		$this->Ln(4);

		$this->Cell(0,4,utf8_decode('EXCELENCIA ACADÉMICA: REG. SEP/PSA/2009/030 '),0,0,'C');
		$this->Ln(4);

		$this->Cell(0,4,utf8_decode('SERVICIOS ESCOLARES DEPARTAMENTO DE EGRESADOS'),0,0,'C');
		$this->Ln(8);

		$this->SetFont('Arial','B',11);
		$this->Cell(0,4,utf8_decode($this->nombreReporte),0,0,'C');
		$this->Ln(10);

		$this->SetFont('Arial','',11);
		$this->Cell(0,5,$this->nombreCarrera,0,0,'L');
		$this->Ln(10);
	}

	// Page footer
	function Footer(){
	    // Position at 1.5 cm from bottom
	    $this->SetY(-15);
	    // Arial italic 8
	    $this->SetFont('Arial','I',8);
	    // Page number
	    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
	}
	
}//Fin de la clase
///TERMINA LA CLASE EXTENDIDA DE FPDF

 $Obras = new ConsultaDB;
 $Funciones = new MisFunciones;
 

 	//recibimos parametros par4a la consulta 
	$nivel = $_GET['nivel'];
	$modalidad = $_GET['modalidad'];
	$estadoTitulo = $_GET['estadoTitulo'];
	if($estadoTitulo == 1){
		$tipoReporte = 'TITULADOS';
	}else if($estadoTitulo == 2){
		$tipoReporte = 'NO TITULADOS';
	}else{
		$tipoReporte= 'NO APLICA';
	}	
	////////////////////////////////////////////////////////////////////////
	//traemos todas las licenciaturas que tenemos de acuerdo al plan 
	$rs_carrera = $Obras->TodasCarreras();
	$row_carrera = mysql_fetch_assoc($rs_carrera);


	/////////////////////////////////////////////////////////////////////////////
	//propiedades de la pagina 
	$pdf = new PDF('P','mm','Letter');
    $pdf->SetMargins(20, 10 , 20);    
	//colores de fondo y del texto para el titulo de la tabla 
	$fondox = '206';//274
	$fondoy = '236';//200
	$fondoz = '245';//60 COLORES 
	$texcolx = '3';
	$texcoly = '3';
	$texcolz = '3';
	$pdf->nombreReporte = $tipoReporte;


	
		
		///////////////////////////////////
		///empezamos a llenar nuestro PDF
		//////////////////////////////////
	$position = 0;
	do{

		$nombreCarrera = utf8_decode($row_carrera['nombreCarrera']);

		$row_alumno = $Obras->consutaGenralTodasCarreras($nivel, $modalidad, $estadoTitulo, $row_carrera['pk_carreras']);
		if($row_alumno){		
			$pdf->nombreCarrera = $nombreCarrera;
			$pdf->AliasNbPages();
			$pdf->AddPage();


			//ENCABEZADO VACIO CALCULAMOS ESPACIO  
		/*	$pdf->Image('../../../../assets/img/EscudoIesch.png',13,10,25,25);
			$pdf->Image('../../../../assets/img/fimpes.png',175,10,25,25);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(0,4,'INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS',0,0,'C');
			$pdf->Ln(4);

			$pdf->Cell(0,4,utf8_decode('INCORPORADO A LA SECRETARIA DE EDUCACIÓN'),0,0,'C');
			$pdf->Ln(4);
			
			$pdf->Cell(0,4,'OFICIO No. 0233 DE FECHA 03 DE NOVIEMBRE DE 1983',0,0,'C');
			$pdf->Ln(4);

			$pdf->Cell(0,4,utf8_decode('RÉGIMEN: PARTICULAR CLAVE: 07PSU0002D'),0,0,'C');
			$pdf->Ln(4);

			$pdf->Cell(0,4,utf8_decode('EXCELENCIA ACADÉMICA: REG. SEP/PSA/2009/030 '),0,0,'C');
			$pdf->Ln(4);

			$pdf->Cell(0,4,utf8_decode('SERVICIOS ESCOLARES DEPARTAMENTO DE EGRESADOS'),0,0,'C');
			$pdf->Ln(8);

			$pdf->SetFont('Arial','B',11);
			$pdf->Cell(0,4,utf8_decode($pdf->nombreReporte),0,0,'C');
			$pdf->Ln(14);

			$pdf->SetFont('Arial','',11);
			$pdf->Cell(0,5,$pdf->nombreCarrera,0,0,'L');
			$pdf->Ln(10);*/

			
			//$pdf->Image('../../../../assets/img/foto.png',20,100,20,25);
			//$pdf->addFont('Batang');
			$pdf->SetFont('Times','','12');
			//contenido o cuerpo
			 $pdf->SetFillColor(2,157,116);//Fondo verde de celda
       		 $pdf->SetTextColor(240, 255, 240); //Letra color blanco
		    $pdf->SetFont('Times','B','12');    
		    $pdf->Cell(20,6,"ID",1,0,'C',true);
		    $pdf->Cell(40,6,"Matricula",1,0,'C',true);
		    $pdf->Cell(76,6,"Nombre",1,0,'C',true);
		    $pdf->Cell(40,6,"Ciclo Escolar",1,0,'C',true);
		    $pdf->Ln(6);

		    $pdf ->SetTextColor(3, 3, 3); //Color del texto: Negro
			$pdf->SetFont('Times','','12'); 
			$pdf->SetWidths(array(20, 40, 76,40));
			$contador = 0;
		    foreach($row_alumno as $valor){
		    	$contador++;	
		    	$nombreAlumno = $Funciones->Capital(strtolower($valor->nombre.' '.$valor->apaterno.' '.$valor->amaterno));
                $datos = array($contador, $valor->matricula, utf8_decode($nombreAlumno), $valor->generacionSecre);
                $pdf->Row($datos);   	
		    } 

		}
	}while($row_carrera = mysql_fetch_assoc($rs_carrera));//fin de foreach de carreras
		        
	$pdf->Output('Estado_Egresados.pdf','I');


?> 
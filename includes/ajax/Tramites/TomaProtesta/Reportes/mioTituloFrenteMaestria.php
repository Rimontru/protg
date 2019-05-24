<?php

require_once("../../../../../includes/Config.class.php");  # Cargar datos conexion y otras variables.
require_once('../../../../../includes/DB.class.php');
require_once('../../../../../includes/ConsultaDB.class.php');
require_once('../../../../../includes/MisFunciones.class.php');
require_once('../../../../../includes/ConvertirNumLetra.php');
require_once('../../../../../includes/DeNumero_a_Letras.php');
require_once('../../../../../fpdf/fpdf.php');

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
		//$this->Image($this->ruta,13,8,35,25);
		$this->Ln(78);
	}
	
}//Fin de la clase
///TERMINA LA CLASE EXTENDIDA DE FPDF

 $Obras = new ConsultaDB;
 $Funciones = new MisFunciones;
 
	/////////////////////////////////////////////////////////////////////////////
	//propiedades de la pagina 
	$pdf = new PDF('P','mm','Legal');
       
	//colores de fondo y del texto para el titulo de la tabla 
	$fondox = '206';//274
	$fondoy = '236';//200
	$fondoz = '245';//60 COLORES 
	$texcolx = '3';
	$texcoly = '3';
	$texcolz = '3';
	
	$pdf->AliasNbPages();
	$pdf->AddPage();

	$conv = array("Á" => "A", "É" => "E", "Í" => "I", "Ó" => "O", "Ú" => "U");
	
	if(isset($_GET['pk_alumno'])){

		$pk_alumno = $_GET['pk_alumno']; 
	 	// 	//OBTENEMOS LOS DATOS DE LA ESCUELA
		$Result32 = $Obras->ConsultaDatosInsitucionConEstados();
		if ($Result32) {
		        $row333 = mysql_fetch_assoc($Result32);
		        $lemaescuela = $row333['lemaEscuela'];
		}
		//OBTENEMOS TODOS LOS DATOS DEL ALUMNO 
		$result = $Obras->ConReporteDocumentacionAlumnosPorLlavePrimaria($pk_alumno);
		//corroboramos que es verdadero nuestro resultado 
		if($result){
			$row = mysql_fetch_assoc($result);
			$nombreTitulo = $Funciones->str_to_min(utf8_decode($row['nombreTitulo']));
			$nombreTitulo = $Funciones->Capital($nombreTitulo);
			$salto = false;

			$pos = strpos($nombreTitulo, "Comunicación");
			if($pos !== false){
				$salto = true;
				$nomTitulo1 = substr($nombreTitulo, 0, 22);
				$nomTitulo2 = substr($nombreTitulo, -18);
			}else{
				$pos = strpos($nombreTitulo, "Turisticas");
				if($pos !== false){
					$salto = true;
					$nomTitulo1 = substr($nombreTitulo, 0, 29);
					$nomTitulo2 = substr($nombreTitulo, -22);
				}else{
					$pos = strpos($nombreTitulo, "Biologo");
					if($pos !== false){
						$salto = true;
						$nomTitulo1 = substr($nombreTitulo, 0, 21);
						$nomTitulo2 = substr($nombreTitulo, -20);
					}
				}
			}
			$nombre = strtr($row['NombreAlumno'], $conv);
			$apaterno = strtr($row['ApaternoAlumno'], $conv);
			$amaterno = strtr($row['AmaternoAlumno'], $conv);
			//$nombreAlumno = utf8_decode($row['NombreAlumno'].' '.$row['ApaternoAlumno'].' '.$row['AmaternoAlumno']);
			$nombreAlumno = utf8_decode($nombre.' '.$apaterno.' '.$amaterno);
			/*if(strlen($nombreAlumno) > 25){
				$tit = 123;
				$carr = 132;
				$carr2 = 140;
			}else{
				$tit = 116;
				$carr = 126;
				$carr2 = 134;
			}*/

			//COMPROBAMOS SI EL noacuerdo TRAE EL TEXTO "ACUERDO NUMERO" PARA PODER QUITARSELO
			$noacuerdo = ucwords(strtolower($row['noacuerdo']));
                  $noacuerdo = strtr($noacuerdo, "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
                  $noacuerdo = str_replace("Psu", "PSU", $noacuerdo);

			if($row['TipoRevoe']=='1'){            
		            $fechaVigente="de fecha ";
		        }else if($row['TipoRevoe']=='2'){
		            $fechaVigente="con vigencia ";
		        }else if ($row['TipoRevoe']=='3'){
		            $fechaVigente="vigente";
		        }else if($row['TipoRevoe']=='0'){
		           $fechaVigente="";
			}
			$fechaExpedicion = $Funciones->Capital($Funciones->str_to_min(utf8_decode($row['fechaExpedicion'])));
			$apartir = strpos($fechaExpedicion, "Partir");
			if ($apartir === false) {
				$fechaExpedicion = $fechaExpedicion;
			} else {
				$fechaExpedicion = substr(trim($fechaExpedicion), 13);
				$fechaExpedicion = 'a partir del '.$fechaExpedicion;	
			}

			//obtenemos fecha actual y cambiamos el formato de vista
	        $FechaTomaProtesta = $_GET['fecha'];
	        $FechaTomaProtestaModificar = explode("-", $FechaTomaProtesta);
	        $FechaTomaProtestaLista = $FechaTomaProtestaModificar[0] . "-" . $FechaTomaProtestaModificar[1] . "-" . $FechaTomaProtestaModificar[2];
	        $fechaLetras = $Funciones->Fecha2Mayusculas($FechaTomaProtestaLista);
	        $fechaDividir = explode("DE", $fechaLetras);
	        $fechaDiaProtesta = strtolower(convertir($fechaDividir[0]));
	        	$fechaDiaProtesta = strtr($fechaDiaProtesta, "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
	        $fechaMesProtesta =strtolower( $fechaDividir[1]);
	        $fechaAnioProtesta = strtolower(convertir($fechaDividir[2]));

			$xxx = explode(" ", $fechaAnioProtesta);
			$fechaAnioProtestaListo=$xxx[2];   
			$fechaAnioProtestaListo = strtr($fechaAnioProtestaListo, "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");

		///////////////////////////////////
		///empezamos a llenar nuestro PDF
		//////////////////////////////////
			$pdf->Image('../../../../../assets/img/foto.png',20,100,20,25);
			//$pdf->addFont('Batang');
			$pdf->SetFont('Times','','22');
			//contenido o cuerpo
				$pdf->SetTextColor($texcolx,$texcoly,$texcolz);  
		        $pdf->Cell(132,5,"Otorga a",0,1,'R');
		        $pdf->Ln(16);

		    $pdf->SetFont('Times','','20');    

		    $pdf->SetXY(64, 105);
		    $pdf->Cell(130,7,$nombreAlumno,0,0,'C');
		    $pdf->Ln(8);
		    
		    $pdf->SetFont('Times','','22');   
		    $pdf->SetXY(64, 120); 
			$pdf->Cell(130,5,utf8_decode("El Grado de"),0,1,'C');
			$pdf->Ln(5);   

		    $pdf->SetFont('Times','','20');    
			$pdf->SetXY(64, 133);
			$pdf->MultiCell(130,7,$nombreTitulo,0,'C');
			$pdf->Ln(5);   

		    $pdf->SetFont('Arial','', '12');
			$pdf->SetXY(63, 153);
			$pdf->MultiCell(130, 7, utf8_decode('Con Reconocimiento de Validez Oficial de Estudios, otorgado por la Secretaría   de   Educación   del   Estado   de   Chiapas,   según '.trim($noacuerdo).' '.trim($fechaVigente).' '. utf8_encode($fechaExpedicion).', en atención a que terminó los estudios correspondientes, de acuerdo al Plan y Programa de estudios vigente.'), 0, 'J');
			$pdf->Ln(20); 

			$pdf->Line(8, 210, 47, 210);
			$pdf->Line(8, 210, 47, 210);
			$pdf->SetFont('Arial','','12');
				$pdf->SetXY(10, 211);    
		        $pdf->Cell(0,5,utf8_decode("Firma del Alumno"),0,1,'L');
		        $pdf->Ln(5);

			$pdf->SetFont('Arial','','12');    
			$pdf->SetXY(63, 210);
		        $pdf->MultiCell(130,7,utf8_decode("Tuxtla Gutiérrez, Chiapas, a los ".$fechaDiaProtesta." días del mes de ".$fechaMesProtesta." del año dos mil ".$fechaAnioProtestaListo."."),0,'J');
		        $pdf->Ln(40);  

		     $pdf->SetFont('Arial','','12');    
		        $pdf->Cell(165,5,utf8_decode('"'.$lemaescuela.'"'),0,1,'R');
		        $pdf->Ln(34);    



		   	$pdf->Line(90, 301, 170, 301);
			$pdf->Line(90, 301, 170, 301);
			$pdf->SetFont('Arial','','12');    
		        $pdf->Cell(157,5,utf8_decode("Mtro. Emilio Enrique Salazar Narváez"),0,1,'R');
		        $pdf->Cell(123,7,utf8_decode("Rector"),0,1,'R');
		        $pdf->Ln(5);
		}else{
			//si nuestro resultado no es verdadero mandamos el mensaje de error
			$pdf->SetFont('Arial','','12');    
			$pdf->Cell(0,5,"Lo Sentimos No Se Pudo Realizar la Consulta",0,1,'C');
			$pdf->Ln(5);
		}

	}else{
		//mensaje de error por si en alguna circunstancia
		// no recibimos el parametro de pk_alumno
		$pdf->SetFont('Arial','','12');    
		$pdf->Cell(0,5,"Lo Sentimos No Se Pudo Realizar la Consulta",0,1,'C');
		$pdf->Ln(5);
	}

	
        

	$pdf->Output('Titulo_Frente.pdf','I');

	/*
	Pa cuando el nombre este muy grande aplicar esta configuracion
		$pdf->SetY(80); 
		        $pdf->Cell(132,5,"Otorga a",0,1,'R');
		        $pdf->Ln(10);

		    $pdf->SetFont('Times','','20');    

		    $pdf->SetXY(58, 95);
		    $pdf->MultiCell(150,7,$nombreAlumno,0,'C');
		    $pdf->Ln(8);
	*/
?> 
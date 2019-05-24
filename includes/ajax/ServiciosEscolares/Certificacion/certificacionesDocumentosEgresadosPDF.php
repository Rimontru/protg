<?php 
include("../../../../includes/Config.class.php");  # Cargar datos conexion y otras variables.
include('../../../../includes/DB.class.php');
include('../../../../includes/ConsultaDB.class.php');
include('../../../../includes/MisFunciones.class.php');
include('../../../../includes/ConvertirNumLetra.php');
include('../../../../includes/DeNumero_a_Letras.php');
include('../../../../fpdf/fpdf.php');

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
    $this->Ln(50);
  }

  function Footer(){
      $this->SetY(-15);
      $this->SetFont('Arial','',8);
      $this->Cell(0,10,utf8_decode('Este documento no es válido si presenta raspaduras o enmendaduras'),0,0,'C');
	  /*$this->SetFont('Arial','',13);
	  $this->SetX(173);
	  $this->Cell(0, 10, utf8_decode('Duplicado'), 0, 0,'C');*/
  }
  
}//Fin de la clase
///TERMINA LA CLASE EXTENDIDA DE FPDF
///
///
///
///
$Obras = new ConsultaDB;
$Funciones = new MisFunciones;
      //$today = date("d-m-Y");
      //$fechaServidor= date("Y");


  /////////////////////////////////////////////////////////////////////////////
  //propiedades de la pagina 
  $pdf = new PDF('P','mm','Letter');
       

  $pdf->AliasNbPages();
  $pdf->AddPage();

if(isset($_GET) && !empty($_GET)){  extract($_GET);


#-- examen licenciatura --#
if($tipo_certificacion == 'EXLIC'){
	//DATOS DE LA ESCUELA
	$Result32 = $Obras->ConsultaDatosInsitucionConEstados();
	if ($Result32) {
	    $row333 = mysql_fetch_assoc($Result32);
	    $nombreInstitucion = $Funciones->Capital($Funciones->str_to_min(utf8_decode($row333['nombreInstitucion'])));
	    $claveInstituto = $row333['clave'];
	}

	//obtenemos todos los datos del alumno
  	if($result = $Obras->ConReporteDocumentacionAlumnosPorLlavePrimaria($pk_alumno)){
      $row = mysql_fetch_array($result);
      // NOMBE DEL TITULO, VALIDAMOS LA CANTIDAD DE LOS CARACTERES PARA CONOCER SU TAMAÑO
      $nombreTitulo = $Funciones->str_to_min(utf8_decode($row['nombreTitulo']));
      $nombreTitulo = $Funciones->Capital($nombreTitulo);
      $salto = false;
      $pos = strpos($nombreTitulo, "Comunicación");
		if($pos !== false){
			$salto = true;
			$nomTitulo1 = substr($nombreTitulo, 0, 22);
			$nomTitulo2 = substr($nombreTitulo, -18);
		}
		else{
			$pos = strpos($nombreTitulo, "Turisticas");
			if($pos !== false){
			  $salto = true;
			  $nomTitulo1 = substr($nombreTitulo, 0, 29);
			  $nomTitulo2 = substr($nombreTitulo, -22);
			}
            else{
              $pos = strpos($nombreTitulo, "Biologo");
              	if($pos !== false){
	                $salto = true;
	                $nomTitulo1 = substr($nombreTitulo, 0, 21);
	                $nomTitulo2 = substr($nombreTitulo, -20);
             	}
        	}
      	}
    }
    else{
    	echo "No se puede continuar con el procedimiento";
    	exit;
    	die();
    }
    //////////////////////////////////////////////////////////////////////////////
    //NOMBE DEL ALUMNO, VALIDAMOS LA CANTIDAD DE LOS CARACTERES PARA CONOCER SU TAMAÑO
      $nombreAlumno = utf8_decode($row['NombreAlumno'].' '.$row['ApaternoAlumno'].' '.$row['AmaternoAlumno']);
        if(strlen($nombreAlumno) > 25){
          $tit = 123;
          $carr = 132;
          $carr2 = 140;
        }else{
          $tit = 116;
          $carr = 126;
          $carr2 = 134;
        }
      $nombreAlumno = $Funciones->str_to_min($nombreAlumno); 
      $nombreAlumno = $Funciones->Capital($nombreAlumno);
      $matricula =$row['matricula']; 
    //////////////////////////////////////////////////////////////////////////////
			$fechaDia = convertir(date('d'));
			$fechaDia = strtr($fechaDia, "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
			$mes = array ('01'=>'Enero','02'=>'Febrero','03'=>'Marzo','04'=>'Abril','05'=>'Mayo','06'=>"Junio",'07'=>'Julio','08'=>'Agosto','09'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre');
			$fechaAnio = convertir(date('Y'));
			$fechaAnio = strtr($fechaAnio, "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");

			$fec_cert = explode('-', $fecha_certificado);
			$fechaDiaCert = convertir($fec_cert[2]);
			$fechaDiaCert = strtr($fechaDia, "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
			$fechaDiaCert = $Funciones->str_to_min($fechaDia);
			$mesCert = $mes[$fec_cert[1]];
			$anioCert = $fechaAnio = convertir($fec_cert[0]);
			$fechaAnio = strtr($fechaAnio, "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
			$fechaAnio = $Funciones->str_to_min($fechaAnio);




        ################################################### - sKELEct PDF - ##########################################################
        #
        #
        $pdf->Image('../../../../assets/img/foto.png',11,59,20,25);
        $pdf->SetFont('Arial','B','16');
        
        //contenido o cuerpo 
        $pdf->SetY(31);
        $pdf->Cell(187,7,utf8_decode("CERTIFICACIÓN DE ACTA DE EXAMEN PROFESIONAL"),0,1,'R');
        

		$pdf->SetFont('Arial','', '12');
		$pdf->SetXY(48, 43);
		$pdf->MultiCell(147, 6,(utf8_decode('La Rectoria del '.trim($nombreInstitucion).', clave: '.$claveInstituto.', con reconocimiento de validez oficial de la Secretaría de Educación del Estado de Chiapas, Certifica que el (a) C. '.utf8_encode($nombreAlumno).' con número de control '.$matricula.', sustentó el examen profesional para obtener título de:')), 0, 'J');
		
		$pdf->Ln(10);
		$pdf->SetFont('Arial','B', '18');
		$pdf->MultiCell('', 6,$nombreTitulo, 0, 'C');

        $pdf->Ln(15);
        $pdf->SetFont('Arial','B', '12');
        $pdf->MultiCell('', 6, utf8_decode('HABIÉNDOSE EXPEDIDO EL ACTA RESPECTIVA CON LOS SIGUIENTES DATOS:'), 0, 'C');

        # constantes de alineacion
        $x = 25;		
		$y = 105;

		$string = array('','Escuela:', 'Ubicación:', '', 'Veredicto:', 'Opción de titulación:');
		$string1 = array('','Hora:','Día:', 'Mes:', 'Año:');
        $pdf->SetFont('Arial','', '12');
        for ($i=1; $i <= 5; $i++){ # acomodo en vertical las opciones
        	$y += 10; # aki esta el interruotor de espaciado
        	if ($i < 3) {
        		$pdf->SetXY($x, $y);
	        	$pdf->MultiCell('', 6, utf8_decode($string[$i]), 0, 'J');
        	}
        	if ($i > 2  && $i < 4) {
        		$a=1;
        		do{ #aki acomodo la linea 3
        			$pdf->SetXY($x, $y);
	        		$pdf->MultiCell('', 6, utf8_decode($string1[$a]), 0, 'J');
	        	$x += 38; # aki esta el interruotor de espaciado
	        	$a++;# aki esta el controlador del ciclo
        		}while($a <= 4);
        	}
        	elseif($i > 3) {
        	 	$x = 25;
        	 	$pdf->SetXY($x, $y);
	        	$pdf->MultiCell('', 6, utf8_decode($string[$i]), 0, 'J');
        	} 
        }    

        #aki $y toma el ultimo valor del ciclo y las reasignamos
        $pdf->SetXY($x, $y1 = $y + 15);
        $pdf->SetFont('Arial','B', '12');
        $pdf->MultiCell('', 6, utf8_decode('JURADO:'), 0, 'J');



        $string2 = array('','Presidente:','Secretario:', 'Vocal:');
        $pdf->SetFont('Arial','', '12');
        for ($n=1; $n <= 3; $n++){ # acomodo en vertical las opciones
        	$y1 += 10;# aki esta el interruotor de espaciado
        	$pdf->SetXY($x, $y1);
	        $pdf->MultiCell('', 6, utf8_decode($string2[$n]), 0, 'J');
        }

       
        $pdf->SetFont('Arial','', '12');
        $pdf->SetXY($x, $y2 = $y1+10);
        $pdf->MultiCell(170, 7, utf8_decode('Por el acuerdo del C. Rector del '.trim($nombreInstitucion).', se expide la presente, certificación en Tuxtla Gutiérrez Chiapas, a los '.trim(strtolower($fechaDia)).' días del mes de '.trim($mes[date('m')]).' del ').trim(strtolower($fechaAnio)).'.', 0, 'J');

        $pdf->SetFont('Arial','', '12');
		$pdf->SetY($y3 = $y2 + 20);
		$pdf->MultiCell('', 7, utf8_decode('RECTOR'), 0, 'C');

		$pdf->SetFont('Arial','', '12');
		$pdf->SetY($y3 + 22.2);
		$pdf->MultiCell('', 7, utf8_decode('MTRO. EMILIO ENRIQUE SALAZAR NARVAEZ'), 0, 'C');

		$pdf->SetFont('Arial','B', '10');
		$pdf->SetXY($x + 115, $y3 + 23);
		$pdf->MultiCell('', 5, utf8_decode('No. Folio. '.utf8_decode($folio)), 0, 'C');
		#
		#
		####################################################### - END sKELet - ##################################################

		#sintaxis de la linea (posicion inicio en columna, posicion inicio de fila, posicion fin en columna, posicion fin de fila,)
		#
		# escuela
		$pdf->Line(45, 120, 190, 120);
		# ubicacion
		$pdf->Line(48, 130, 190, 130);
		# hora
		$pdf->Line(38, 140, 62, 140);
		# dia
		$pdf->Line(73, 140, 100, 140);
		# mes
		$pdf->Line(112, 140, 138, 140);
		# año
		$pdf->Line(150, 140, 190, 140);
		# veredicto
		$pdf->Line(48, 150, 190, 150);
		# opcion titulo
		$pdf->Line(66, 160, 190, 160);
		# presidente
		$pdf->Line(50, 185, 190, 185);
		# secretario
		$pdf->Line(50, 195, 190, 195);
		# vocal
		$pdf->Line(50, 205, 190, 205);
		#rector
		$pdf->Line(60, 253, 156, 253);
		#folio
		$pdf->Line(178, 257, 194, 257);
		#nombre titulo
		$pdf->Line(50, 90, 193, 90);
		#
		#
		################################################################# - FIN - ####################################################

		$pdf->SetFont('Arial','', '12');

		# variables escuela
		$pdf->SetXY(45, 114);
		$pdf->MultiCell('', 7, utf8_decode(trim($nombreInstitucion)).'.', 0, 'J');
		# variables ubicacion
		$pdf->SetXY(47, 124);
		$pdf->MultiCell('', 7, utf8_decode(trim('Tuxtla Gutiérrez, Chiapas')).'.', 0, 'J');
		# variables hora
		$pdf->SetXY(40, 134);
		$pdf->MultiCell('', 7, trim($hora_certificado.' hrs').'.', 0, 'J');
		# variables dia
		$pdf->SetXY(73, 134);
		$pdf->MultiCell('', 7, trim(ucwords ($fechaDiaCert)).'.', 0, 'J');
		# variables mes
		$pdf->SetXY(112, 134);
		$pdf->MultiCell('', 7, trim($mesCert).'.', 0, 'J');
		# variables año
		$pdf->SetXY(150, 134);
		$pdf->MultiCell('', 7, trim(ucwords ($fechaAnio)).'.', 0, 'J');
		# variables Veredicto
		$pdf->SetFont('Arial', 'B', '12');
		$pdf->SetY(144);
		$pdf->MultiCell('', 7, trim($veredicto).'.', 0, 'C');
		# variables opcion titulo
		$pdf->SetFont('Arial', '', '12');
		$pdf->SetXY(65, 154);
		$pdf->MultiCell('', 7, utf8_decode(trim($opcion_titulacion)).'.', 0, 'J');
		# variables presidente
		$pdf->SetXY(50, 179);
		$pdf->MultiCell('', 7, utf8_decode(trim($presidente)).'.', 0, 'J');
		# variables secretario
		$pdf->SetXY(50, 189);
		$pdf->MultiCell('', 7, utf8_decode(trim($secretario)).'.', 0, 'J');
		# variables vocal
		$pdf->SetXY(50, 199);
		$pdf->MultiCell('', 7, utf8_decode(trim($vocal)).'.', 0, 'J');

    ###################################################### REVERSO CERTIFICADO #############################################################
    #
    #
    $pdf->AliasNbPages();
    $pdf->AddPage();


    #linea superior
    $pdf->Line(78, 48, 140, 48);
    #linea inferior
    $pdf->Line(78, 105, 140, 105);
    #linea izquierda
    $pdf->Line(78, 48, 78, 105);
    #linea derecha
    $pdf->Line(140, 48, 140, 105);
     #linea director
    $pdf->Line(78, 175, 140, 175);


    #leyenda recuadro holograma
    $pdf->SetFont('Arial', '', '6.5');
    $pdf->SetXY(78, 100);
    $pdf->MultiCell('', 7, utf8_decode(trim('*Este Documento no es válido sin el holograma Oficial S.E*')), 0, 'J');

    #leyenda debajo holograma
    $pdf->SetFont('Arial', '', '8');
    $pdf->SetXY(44, 125);
    $pdf->MultiCell(129, 3, utf8_decode(trim('El suscrito Dr. Luis Madrigal Frías, Director de Educación Superior, CERTIFICA que el presente formato de certificación de Acta de Examen Profesional, que consta en el anverso y reverso de esta hoja, es el que se utilizará en todas las Licenciaturas que imparta el '.trim($nombreInstitucion).', en la ciudad de Tuxtla Gutiérrez, Chiapas.')), 0, 'J');


    $pdf->SetFont('Arial', '', '8');
    $pdf->SetXY(44, 150);
    $pdf->MultiCell(129, 3, utf8_decode(trim('Tuxtla Gutiérrez Chiapas. 30 de Junio de 2017')), 0, 'R');

    #nombre director
    $pdf->SetFont('Arial', 'B', '10');
    $pdf->SetXY(44, 170);
    $pdf->MultiCell(129, 3, utf8_decode(trim('DR. LUIS MADRIGAL FRÍAS')), 0, 'C');

     #nombre director
    $pdf->SetFont('Arial', 'B', '10');
    $pdf->SetXY(74, 178);
    $pdf->MultiCell(70, 5, utf8_decode(trim('Director de Educación Superior de la Secretaría de Educación en el Estado')), 0, 'C');
    #
    #
    ###################################################### REVERSO CERTIFICADO #############################################################
   


  $pdf->Output('CertificacionExamenLic.pdf','I');	
}
#-- / fin examen licenciatura --#






#-- examen posgrado --#
else if($tipo_certificacion == 'EXPOS'){
//DATOS DE LA ESCUELA
	$Result32 = $Obras->ConsultaDatosInsitucionConEstados();
	if ($Result32) {
	    $row333 = mysql_fetch_assoc($Result32);
	    $nombreInstitucion = $Funciones->Capital($Funciones->str_to_min(utf8_decode($row333['nombreInstitucion'])));
	    $claveInstituto = $row333['clave'];
	}

	//obtenemos todos los datos del alumno
  	if($result = $Obras->ConReporteDocumentacionAlumnosPorLlavePrimaria($pk_alumno)){
      $row = mysql_fetch_array($result);
      // NOMBE DEL TITULO, VALIDAMOS LA CANTIDAD DE LOS CARACTERES PARA CONOCER SU TAMAÑO
      $nombreTitulo = $Funciones->str_to_min(utf8_decode($row['nombreTitulo']));
      $nombreTitulo = $Funciones->Capital($nombreTitulo);
      $salto = false;
      $pos = strpos($nombreTitulo, "Comunicación");
		if($pos !== false){
			$salto = true;
			$nomTitulo1 = substr($nombreTitulo, 0, 22);
			$nomTitulo2 = substr($nombreTitulo, -18);
		}
		else{
			$pos = strpos($nombreTitulo, "Turisticas");
			if($pos !== false){
			  $salto = true;
			  $nomTitulo1 = substr($nombreTitulo, 0, 29);
			  $nomTitulo2 = substr($nombreTitulo, -22);
			}
            else{
              $pos = strpos($nombreTitulo, "Biologo");
              	if($pos !== false){
	                $salto = true;
	                $nomTitulo1 = substr($nombreTitulo, 0, 21);
	                $nomTitulo2 = substr($nombreTitulo, -20);
             	}
        	}
      	}
    }
    else{
    	echo "No se puede continuar con el procedimiento";
    	exit;
    	die();
    }
    //////////////////////////////////////////////////////////////////////////////
    //NOMBE DEL ALUMNO, VALIDAMOS LA CANTIDAD DE LOS CARACTERES PARA CONOCER SU TAMAÑO
      $nombreAlumno = utf8_decode($row['NombreAlumno'].' '.$row['ApaternoAlumno'].' '.$row['AmaternoAlumno']);
        if(strlen($nombreAlumno) > 25){
          $tit = 123;
          $carr = 132;
          $carr2 = 140;
        }else{
          $tit = 116;
          $carr = 126;
          $carr2 = 134;
        }
      $nombreAlumno = $Funciones->str_to_min($nombreAlumno); 
      $nombreAlumno = $Funciones->Capital($nombreAlumno);
      $matricula =$row['matricula']; 
    //////////////////////////////////////////////////////////////////////////////
			$fechaDia = convertir(date('d'));
			$fechaDia = strtr($fechaDia, "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
			$mes = array ('01'=>'Enero','02'=>'Febrero','03'=>'Marzo','04'=>'Abril','05'=>'Mayo','06'=>"Junio",'07'=>'Julio','08'=>'Agosto','09'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre');
			$fechaAnio = convertir(date('Y'));
			$fechaAnio = strtr($fechaAnio, "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");

			$fec_cert = explode('-', $fecha_certificado);
			$fechaDiaCert = convertir($fec_cert[2]);
			$fechaDiaCert = strtr($fechaDia, "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
			$fechaDiaCert = $Funciones->str_to_min($fechaDia);
			$mesCert = $mes[$fec_cert[1]];
			$anioCert = $fechaAnio = convertir($fec_cert[0]);
			$fechaAnio = strtr($fechaAnio, "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
			$fechaAnio = $Funciones->str_to_min($fechaAnio);




         ################################################### - sKELEct PDF - ##########################################################
        #
        #
        $pdf->Image('../../../../assets/img/foto.png',11,59,20,25);
        $pdf->SetFont('Arial','B','16');
        
        //contenido o cuerpo 
        $pdf->SetY(31);
        $pdf->Cell('',7,utf8_decode("CERTIFICACIÓN DE ACTA DE EXAMEN DE GRADO"),0,1,'C');
        

		$pdf->SetFont('Arial','', '12');
		$pdf->SetXY(48, 43);
		$pdf->MultiCell(147, 6,(utf8_decode('La Rectoria del '.trim($nombreInstitucion).', clave: '.$claveInstituto.', con reconocimiento de validez oficial de la Secretaría de Educación del Estado de Chiapas, Certifica que el (a) C. '.utf8_encode($nombreAlumno).' con número de control '.$matricula.', sustentó el examen profesional para obtener el grado de:')), 0, 'J');
		
		$pdf->Ln(10);
		$pdf->SetFont('Arial','B', '18');
		$pdf->MultiCell('', 6,$nombreTitulo, 0, 'C');

        $pdf->Ln(15);
        $pdf->SetFont('Arial','B', '12');
        $pdf->MultiCell('', 6, utf8_decode('HABIÉNDOSE EXPEDIDO EL ACTA RESPECTIVA CON LOS SIGUIENTES DATOS:'), 0, 'C');

        # constantes de alineacion
        $x = 25;		
		$y = 105;

		$string = array('','Escuela:', 'Ubicación:', '', 'Veredicto:', 'Opción de titulación:');
		$string1 = array('','Hora:','Día:', 'Mes:', 'Año:');
        $pdf->SetFont('Arial','', '12');
        for ($i=1; $i <= 5; $i++){ # acomodo en vertical las opciones
        	$y += 10; # aki esta el interruotor de espaciado
        	if ($i < 3) {
        		$pdf->SetXY($x, $y);
	        	$pdf->MultiCell('', 6, utf8_decode($string[$i]), 0, 'J');
        	}
        	if ($i > 2  && $i < 4) {
        		$a=1;
        		do{ #aki acomodo la linea 3
        			$pdf->SetXY($x, $y);
	        		$pdf->MultiCell('', 6, utf8_decode($string1[$a]), 0, 'J');
	        	$x += 38; # aki esta el interruotor de espaciado
	        	$a++;# aki esta el controlador del ciclo
        		}while($a <= 4);
        	}
        	elseif($i > 3) {
        	 	$x = 25;
        	 	$pdf->SetXY($x, $y);
	        	$pdf->MultiCell('', 6, utf8_decode($string[$i]), 0, 'J');
        	} 
        }    

        #aki $y toma el ultimo valor del ciclo y las reasignamos
        $pdf->SetXY($x, $y1 = $y + 15);
        $pdf->SetFont('Arial','B', '12');
        $pdf->MultiCell('', 6, utf8_decode('JURADO:'), 0, 'J');



        $string2 = array('','Presidente:','Secretario:', 'Vocal:');
        $pdf->SetFont('Arial','', '12');
        for ($n=1; $n <= 3; $n++){ # acomodo en vertical las opciones
        	$y1 += 10;# aki esta el interruotor de espaciado
        	$pdf->SetXY($x, $y1);
	        $pdf->MultiCell('', 6, utf8_decode($string2[$n]), 0, 'J');
        }

       
        $pdf->SetFont('Arial','', '12');
        $pdf->SetXY($x, $y2 = $y1+10);
        $pdf->MultiCell(170, 7, utf8_decode('Por el acuerdo del C. Rector del '.trim($nombreInstitucion).', se expide la presente, certificación en Tuxtla Gutiérrez Chiapas, a los '.trim(strtolower($fechaDia)).' días del mes de '.trim($mes[date('m')]).' del '.trim(strtolower($fechaAnio))).'.', 0, 'J');

        $pdf->SetFont('Arial','', '12');
		$pdf->SetY($y3 = $y2 + 20);
		$pdf->MultiCell('', 7, utf8_decode('RECTOR'), 0, 'C');

		$pdf->SetFont('Arial','', '12');
		$pdf->SetY($y3 + 22.2);
		$pdf->MultiCell('', 7, utf8_decode('MTRO. EMILIO ENRIQUE SALAZAR NARVAEZ'), 0, 'C');

		$pdf->SetFont('Arial','B', '10');
		$pdf->SetXY($x + 115, $y3 + 23);
		$pdf->MultiCell('', 5, utf8_decode('No. Folio. '.utf8_decode($folio)), 0, 'C');
		#
		#
		####################################################### - END sKELet - ##################################################

		#sintaxis de la linea (posicion inicio en columna, posicion inicio de fila, posicion fin en columna, posicion fin de fila,)
		#
		# escuela
		$pdf->Line(45, 120, 190, 120);
		# ubicacion
		$pdf->Line(48, 130, 190, 130);
		# hora
		$pdf->Line(38, 140, 62, 140);
		# dia
		$pdf->Line(73, 140, 100, 140);
		# mes
		$pdf->Line(112, 140, 138, 140);
		# año
		$pdf->Line(150, 140, 190, 140);
		# veredicto
		$pdf->Line(48, 150, 190, 150);
		# opcion titulo
		$pdf->Line(66, 160, 190, 160);
		# presidente
		$pdf->Line(50, 185, 190, 185);
		# secretario
		$pdf->Line(50, 195, 190, 195);
		# vocal
		$pdf->Line(50, 205, 190, 205);
		#rector
		$pdf->Line(60, 253, 156, 253);
		#folio
		$pdf->Line(178, 257, 194, 257);
		#nombre titulo
		$pdf->Line(38, 90, 193, 90);
		#
		#
		################################################################# - FIN - ####################################################

		$pdf->SetFont('Arial','', '12');

		# variables escuela
		$pdf->SetXY(45, 114);
		$pdf->MultiCell('', 7, utf8_decode(trim($nombreInstitucion)).'.', 0, 'J');
		# variables ubicacion
		$pdf->SetXY(47, 124);
		$pdf->MultiCell('', 7, utf8_decode(trim('Tuxtla Gutiérrez, Chiapas')).'.', 0, 'J');
		# variables hora
		$pdf->SetXY(40, 134);
		$pdf->MultiCell('', 7, trim($hora_certificado.' hrs').'.', 0, 'J');
		# variables dia
		$pdf->SetXY(73, 134);
		$pdf->MultiCell('', 7, trim(ucwords ($fechaDiaCert)).'.', 0, 'J');
		# variables mes
		$pdf->SetXY(112, 134);
		$pdf->MultiCell('', 7, trim($mesCert).'.', 0, 'J');
		# variables año
		$pdf->SetXY(150, 134);
		$pdf->MultiCell('', 7, trim(ucwords ($fechaAnio)).'.', 0, 'J');
		# variables Veredicto
		$pdf->SetFont('Arial', 'B', '12');
		$pdf->SetY(144);
		$pdf->MultiCell('', 7, trim($veredicto).'.', 0, 'C');
		# variables opcion titulo
		$pdf->SetFont('Arial', '', '12');
		$pdf->SetXY(65, 154);
		$pdf->MultiCell('', 7, utf8_decode(trim($opcion_titulacion)).'.', 0, 'J');
		# variables presidente
		$pdf->SetXY(50, 179);
		$pdf->MultiCell('', 7, utf8_decode(trim($presidente)).'.', 0, 'J');
		# variables secretario
		$pdf->SetXY(50, 189);
		$pdf->MultiCell('', 7, utf8_decode(trim($secretario)).'.', 0, 'J');
		# variables vocal
		$pdf->SetXY(50, 199);
		$pdf->MultiCell('', 7, utf8_decode(trim($vocal)).'.', 0, 'J');


    ###################################################### REVERSO CERTIFICADO #############################################################
    #
    #
    $pdf->AliasNbPages();
    $pdf->AddPage();


    #linea superior
    $pdf->Line(78, 48, 140, 48);
    #linea inferior
    $pdf->Line(78, 105, 140, 105);
    #linea izquierda
    $pdf->Line(78, 48, 78, 105);
    #linea derecha
    $pdf->Line(140, 48, 140, 105);
     #linea director
    $pdf->Line(78, 175, 140, 175);


    #leyenda recuadro holograma
    $pdf->SetFont('Arial', '', '6.5');
    $pdf->SetXY(78, 100);
    $pdf->MultiCell('', 7, utf8_decode(trim('*Este Documento no es válido sin el holograma Oficial S.E*')), 0, 'J');

    #leyenda debajo holograma
    $pdf->SetFont('Arial', '', '8');
    $pdf->SetXY(44, 125);
    $pdf->MultiCell(129, 3, utf8_decode(trim('El suscrito Dr. Luis Madrigal Frías, Director de Educación Superior, CERTIFICA que el presente formato de certificación de Acta de Examen de Grado, que consta en el anverso y reverso de esta hoja, es el que se utilizará en todas las Maestrías, Doctorados y Especialidades que imparta el '.trim($nombreInstitucion).', en la ciudad de Tuxtla Gutiérrez, Chiapas.')), 0, 'J');


    $pdf->SetFont('Arial', '', '8');
    $pdf->SetXY(44, 150);
    $pdf->MultiCell(129, 3, utf8_decode(trim('Tuxtla Gutiérrez Chiapas. 30 de Junio de 2017')), 0, 'R');

    #nombre director
    $pdf->SetFont('Arial', 'B', '10');
    $pdf->SetXY(44, 170);
    $pdf->MultiCell(129, 3, utf8_decode(trim('DR. LUIS MADRIGAL FRÍAS')), 0, 'C');

     #nombre director
    $pdf->SetFont('Arial', 'B', '10');
    $pdf->SetXY(74, 178);
    $pdf->MultiCell(70, 5, utf8_decode(trim('Director de Educación Superior de la Secretaría de Educación en el Estado')), 0, 'C');
    #
    #
    ###################################################### REVERSO CERTIFICADO #############################################################


  $pdf->Output('CertificacionExamenPos.pdf','I');		
}
#-- / fin examen posgrado --#






#-- titulo licenciatura --#
else if($tipo_certificacion == 'TILIC'){
//DATOS DE LA ESCUELA
	$Result32 = $Obras->ConsultaDatosInsitucionConEstados();
	if ($Result32) {
	    $row333 = mysql_fetch_assoc($Result32);
	    $nombreInstitucion = $Funciones->Capital($Funciones->str_to_min(utf8_decode($row333['nombreInstitucion'])));
	    $claveInstituto = $row333['clave'];
	}

	//obtenemos todos los datos del alumno
  	if($result = $Obras->ConReporteDocumentacionAlumnosPorLlavePrimaria($pk_alumno)){
      $row = mysql_fetch_array($result);
      // NOMBE DEL TITULO, VALIDAMOS LA CANTIDAD DE LOS CARACTERES PARA CONOCER SU TAMAÑO
      $nombreTitulo = $Funciones->str_to_min(utf8_decode($row['nombreTitulo']));
      $nombreTitulo = $Funciones->Capital($nombreTitulo);
      $salto = false;
      $pos = strpos($nombreTitulo, "Comunicación");
		if($pos !== false){
			$salto = true;
			$nomTitulo1 = substr($nombreTitulo, 0, 22);
			$nomTitulo2 = substr($nombreTitulo, -18);
		}
		else{
			$pos = strpos($nombreTitulo, "Turisticas");
			if($pos !== false){
			  $salto = true;
			  $nomTitulo1 = substr($nombreTitulo, 0, 29);
			  $nomTitulo2 = substr($nombreTitulo, -22);
			}
            else{
              $pos = strpos($nombreTitulo, "Biologo");
              	if($pos !== false){
	                $salto = true;
	                $nomTitulo1 = substr($nombreTitulo, 0, 21);
	                $nomTitulo2 = substr($nombreTitulo, -20);
             	}
        	}
      	}
    }
    else{
    	echo "No se puede continuar con el procedimiento";
    	exit;
    	die();
    }
    //////////////////////////////////////////////////////////////////////////////
    //NOMBE DEL ALUMNO, VALIDAMOS LA CANTIDAD DE LOS CARACTERES PARA CONOCER SU TAMAÑO
      $nombreAlumno = utf8_decode($row['NombreAlumno'].' '.$row['ApaternoAlumno'].' '.$row['AmaternoAlumno']);
        if(strlen($nombreAlumno) > 25){
          $tit = 123;
          $carr = 132;
          $carr2 = 140;
        }else{
          $tit = 116;
          $carr = 126;
          $carr2 = 134;
        }
      $nombreAlumno = $Funciones->str_to_min($nombreAlumno); 
      $nombreAlumno = $Funciones->Capital($nombreAlumno);
      $matricula =$row['matricula']; 
    //////////////////////////////////////////////////////////////////////////////
			$fechaDia = convertir(date('d'));
			$fechaDia = strtr($fechaDia, "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
			$mes = array ('01'=>'Enero','02'=>'Febrero','03'=>'Marzo','04'=>'Abril','05'=>'Mayo','06'=>"Junio",'07'=>'Julio','08'=>'Agosto','09'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre');
			$fechaAnio = convertir(date('Y'));
			$fechaAnio = strtr($fechaAnio, "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");

			$fec_cert = explode('-', $fecha_certificado);
			$fechaDiaCert = convertir($fec_cert[2]);
			$fechaDiaCert = strtr($fechaDia, "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
			$fechaDiaCert = $Funciones->str_to_min($fechaDia);
			$mesCert = $mes[$fec_cert[1]];
			$anioCert = $fechaAnio = convertir($fec_cert[0]);
			$fechaAnio = strtr($fechaAnio, "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
			$fechaAnio = $Funciones->str_to_min($fechaAnio);

			$fecExa = explode('-', $fecha_examen);
			$fechaDiaExa = convertir($fecExa[2]);
			$fechaDiaExa = strtr($fechaDiaExa, "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
			$fechaDiaExa = ucwords($Funciones->str_to_min($fechaDiaExa));
			$fechaMesExa = $mes[$fecExa[1]];
			$fechaAnioExa = convertir($fecExa[0]);
			$fechaAnioExa = strtr($fechaAnioExa, "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
			$fechaAnioExa = $Funciones->str_to_min($fechaAnioExa);

        ################################################### - sKELEct - ##########################################################
        #
        #
        $pdf->Image('../../../../assets/img/foto.png',11,59,20,25);
        $pdf->SetFont('Arial','B','16');
        
        //contenido o cuerpo 
        $pdf->SetY(31);
        $pdf->MultiCell('',7,utf8_decode("CERTIFICACIÓN DE TITULO PROFESIONAL"), 0, 'C');
        

		$pdf->SetFont('Arial','', '12');
		$pdf->SetXY(48, 43);
		$pdf->MultiCell(147, 6,(utf8_decode('La Rectoria del '.trim($nombreInstitucion).', clave: '.$claveInstituto.', con reconocimiento de validez oficial de la Secretaría de Educación del Estado de Chiapas, Certifica que el (a) C. '.utf8_encode($nombreAlumno).' con número de control '.$matricula.', Egresado de este Instituto obtuvo su Título Profesional de:')), 0, 'J');
		
		$pdf->Ln(20);
		$pdf->SetFont('Arial','B', '18');
		$pdf->MultiCell('', 6,$nombreTitulo, 0, 'C');


		 # constantes de alineacion
        $x = 25;		
		$y = 130;



        $pdf->SetXY($x, $y);
        $pdf->SetFont('Arial','', '12');
        $pdf->MultiCell(170, 7, utf8_decode('Con fecha de expedición '.trim(ucwords($fechaDiaCert)).' de '.$mesCert.' de '.trim(ucwords($fechaAnio)).', Habiendo sustentado y aprobado el examen profesional reglamentario'.', El día '.trim($fechaDiaExa).' de '.trim($fechaMesExa).' de '.trim($fechaAnioExa).', En Tuxtla Gutiérrez Chiapas, Quedando registrado con el número '.$no_registro.', holograma '.trim($holograma).', en la foja número '.$foja_no.' del libro de registro de Títulos Profesionales '.$libro.'.' ), 0, 'J');

         $pdf->SetXY($x, $y+45);
         $pdf->MultiCell('',7,utf8_decode('Legalizó:'), 0, 'J');

         $pdf->SetXY($x, $y1=$y+65);
         $pdf->MultiCell('',7,utf8_decode('Registró:'), 0, 'J');

 		 $pdf->SetXY($x, $y2 = $y1+15);
        $pdf->MultiCell(170, 7, utf8_decode('Por el acuerdo del C. Rector del '.trim($nombreInstitucion).', se expide la presente, certificación en Tuxtla Gutiérrez Chiapas, a los '.trim(strtolower($fechaDia)).' días del mes de '.trim($mes[date('m')]).' del '.trim(strtolower($fechaAnio))).'.', 0, 'J');

        $pdf->SetFont('Arial','', '12');
		$pdf->SetY($y3 = $y2 + 20);
		$pdf->MultiCell('', 7, utf8_decode('RECTOR'), 0, 'C');

		$pdf->SetFont('Arial','', '12');
		$pdf->SetY($y3 + 22.2);
		$pdf->MultiCell('', 7, utf8_decode('MTRO. EMILIO ENRIQUE SALAZAR NARVAEZ'), 0, 'C');

		$pdf->SetFont('Arial','B', '10');
		$pdf->SetXY($x + 115, $y3 + 23);
		$pdf->MultiCell('', 5, utf8_decode('No. Folio. '.utf8_decode($folio)), 0, 'C');


		# nombre titulo
		$pdf->Line(49, 100, 193, 100);
		# legalizo
		$pdf->Line(49, 180, 193, 180);
		# realizo
		$pdf->Line(49, 200, 193, 200);
		#rector
		$pdf->Line(60, 253, 156, 253);
		#folio
		$pdf->Line(178, 257, 194, 257);


    $pdf->SetFont('Arial','', '12');
    $pdf->SetXY($x+25, $y+45);
    $pdf->MultiCell('',7,utf8_decode($legalizo), 0, 'J');

    $pdf->SetXY($x+25, $y1=$y+65);
    $pdf->MultiCell('',7,utf8_decode($registro), 0, 'J');



     ###################################################### REVERSO CERTIFICADO #############################################################
    #
    #
    $pdf->AliasNbPages();
    $pdf->AddPage();


    #linea superior
    $pdf->Line(78, 48, 140, 48);
    #linea inferior
    $pdf->Line(78, 105, 140, 105);
    #linea izquierda
    $pdf->Line(78, 48, 78, 105);
    #linea derecha
    $pdf->Line(140, 48, 140, 105);
     #linea director
    $pdf->Line(78, 175, 140, 175);


    #leyenda recuadro holograma
    $pdf->SetFont('Arial', '', '6.5');
    $pdf->SetXY(78, 100);
    $pdf->MultiCell('', 7, utf8_decode(trim('*Este Documento no es válido sin el holograma Oficial S.E*')), 0, 'J');

    #leyenda debajo holograma
    $pdf->SetFont('Arial', '', '8');
    $pdf->SetXY(44, 125);
    $pdf->MultiCell(129, 3, utf8_decode(trim('El suscrito Dr. Luis Madrigal Frías, Director de Educación Superior, CERTIFICA que el presente formato de certificación de Titulo Profesional, que consta en el anverso y reverso de esta hoja, es el que se utilizará en todas las Maestrías, Doctorados y Especialidades que imparta el '.trim($nombreInstitucion).', en la ciudad de Tuxtla Gutiérrez, Chiapas.')), 0, 'J');


    $pdf->SetFont('Arial', '', '8');
    $pdf->SetXY(44, 150);
    $pdf->MultiCell(129, 3, utf8_decode(trim('Tuxtla Gutiérrez Chiapas. 30 de Junio de 2017')), 0, 'R');

    #nombre director
    $pdf->SetFont('Arial', 'B', '10');
    $pdf->SetXY(44, 170);
    $pdf->MultiCell(129, 3, utf8_decode(trim('DR. LUIS MADRIGAL FRÍAS')), 0, 'C');

     #nombre director
    $pdf->SetFont('Arial', 'B', '10');
    $pdf->SetXY(74, 178);
    $pdf->MultiCell(70, 5, utf8_decode(trim('Director de Educación Superior de la Secretaría de Educación en el Estado')), 0, 'C');
    #
    #
    ###################################################### REVERSO CERTIFICADO #############################################################
   



  $pdf->Output('CertificacionTituloLic.pdf','I');	
}
#-- / fin titulo licenciatura--#




#-- titulo posgrado --#
else if($tipo_certificacion == 'TIPOS'){
	//DATOS DE LA ESCUELA
	$Result32 = $Obras->ConsultaDatosInsitucionConEstados();
	if ($Result32) {
	    $row333 = mysql_fetch_assoc($Result32);
	    $nombreInstitucion = $Funciones->Capital($Funciones->str_to_min(utf8_decode($row333['nombreInstitucion'])));
	    $claveInstituto = $row333['clave'];
	}

	//obtenemos todos los datos del alumno
  	if($result = $Obras->ConReporteDocumentacionAlumnosPorLlavePrimaria($pk_alumno)){
      $row = mysql_fetch_array($result);
      // NOMBE DEL TITULO, VALIDAMOS LA CANTIDAD DE LOS CARACTERES PARA CONOCER SU TAMAÑO
      $nombreTitulo = $Funciones->str_to_min(utf8_decode($row['nombreTitulo']));
      $nombreTitulo = $Funciones->Capital($nombreTitulo);
      $salto = false;
      $pos = strpos($nombreTitulo, "Comunicación");
		if($pos !== false){
			$salto = true;
			$nomTitulo1 = substr($nombreTitulo, 0, 22);
			$nomTitulo2 = substr($nombreTitulo, -18);
		}
		else{
			$pos = strpos($nombreTitulo, "Turisticas");
			if($pos !== false){
			  $salto = true;
			  $nomTitulo1 = substr($nombreTitulo, 0, 29);
			  $nomTitulo2 = substr($nombreTitulo, -22);
			}
            else{
              $pos = strpos($nombreTitulo, "Biologo");
              	if($pos !== false){
	                $salto = true;
	                $nomTitulo1 = substr($nombreTitulo, 0, 21);
	                $nomTitulo2 = substr($nombreTitulo, -20);
             	}
        	}
      	}
    }
    else{
    	echo "No se puede continuar con el procedimiento";
    	exit;
    	die();
    }
    //////////////////////////////////////////////////////////////////////////////
    //NOMBE DEL ALUMNO, VALIDAMOS LA CANTIDAD DE LOS CARACTERES PARA CONOCER SU TAMAÑO
      $nombreAlumno = utf8_decode($row['NombreAlumno'].' '.$row['ApaternoAlumno'].' '.$row['AmaternoAlumno']);
        if(strlen($nombreAlumno) > 25){
          $tit = 123;
          $carr = 132;
          $carr2 = 140;
        }else{
          $tit = 116;
          $carr = 126;
          $carr2 = 134;
        }
      $nombreAlumno = $Funciones->str_to_min($nombreAlumno); 
      $nombreAlumno = $Funciones->Capital($nombreAlumno);
      $matricula =$row['matricula']; 
    //////////////////////////////////////////////////////////////////////////////
			$fechaDia = convertir(date('d'));
			$fechaDia = strtr($fechaDia, "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
			$mes = array ('01'=>'Enero','02'=>'Febrero','03'=>'Marzo','04'=>'Abril','05'=>'Mayo','06'=>"Junio",'07'=>'Julio','08'=>'Agosto','09'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre');
			$fechaAnio = convertir(date('Y'));
			$fechaAnio = strtr($fechaAnio, "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");

			$fec_cert = explode('-', $fecha_certificado);
			$fechaDiaCert = convertir($fec_cert[2]);
			$fechaDiaCert = strtr($fechaDia, "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
			$fechaDiaCert = $Funciones->str_to_min($fechaDia);
			$mesCert = $mes[$fec_cert[1]];
			$anioCert = $fechaAnio = convertir($fec_cert[0]);
			$fechaAnio = strtr($fechaAnio, "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
			$fechaAnio = $Funciones->str_to_min($fechaAnio);

			$fecExa = explode('-', $fecha_examen);
			$fechaDiaExa = convertir($fecExa[2]);
			$fechaDiaExa = strtr($fechaDiaExa, "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
			$fechaDiaExa = ucwords($Funciones->str_to_min($fechaDiaExa));
			$fechaMesExa = $mes[$fecExa[1]];
			$fechaAnioExa = convertir($fecExa[0]);
			$fechaAnioExa = strtr($fechaAnioExa, "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
			$fechaAnioExa = $Funciones->str_to_min($fechaAnioExa);

        ################################################### - sKELEct - ##########################################################
        #
        #
        $pdf->Image('../../../../assets/img/foto.png',11,59,20,25);
        $pdf->SetFont('Arial','B','16');
        
        //contenido o cuerpo 
        $pdf->SetY(31);
        $pdf->MultiCell('',7,utf8_decode("CERTIFICACIÓN DE GRADO"), 0, 'C');
        

		$pdf->SetFont('Arial','', '12');
		$pdf->SetXY(48, 43);
		$pdf->MultiCell(147, 6,(utf8_decode('La Rectoria del '.trim($nombreInstitucion).', clave: '.$claveInstituto.', con reconocimiento de validez oficial de la Secretaría de Educación del Estado de Chiapas, Certifica que el (a) C. '.utf8_encode($nombreAlumno).' con número de control '.$matricula.', Egresado de este Instituto obtuvo su Grado de:')), 0, 'J');
		
		$pdf->Ln(20);
		$pdf->SetFont('Arial','B', '18');
		$pdf->MultiCell('', 6,$nombreTitulo, 0, 'C');


		 # constantes de alineacion
        $x = 25;		
		$y = 130;



        $pdf->SetXY($x, $y);
        $pdf->SetFont('Arial','', '12');
        $pdf->MultiCell(170, 7, utf8_decode('Con fecha de expedición '.trim(ucwords($fechaDiaCert)).' de '.$mesCert.' de '.trim(ucwords($fechaAnio)).', Habiendo sustentado y aprobado el examen profesional reglamentario'.', El día '.trim($fechaDiaExa).' de '.trim($fechaMesExa).' de '.trim($fechaAnioExa).', En Tuxtla Gutiérrez Chiapas, Quedando registrado con el número '.$no_registro.', holograma '.trim($holograma).', en la foja número '.$foja_no.' del libro de registro de Títulos Profesionales '.$libro.'.' ), 0, 'J');


         $pdf->SetXY($x, $y+45);
         $pdf->MultiCell('',7,utf8_decode('Legalizó:'), 0, 'J');

         $pdf->SetXY($x, $y1=$y+65);
         $pdf->MultiCell('',7,utf8_decode('Registró:'), 0, 'J');

 		 $pdf->SetXY($x, $y2 = $y1+20);
        $pdf->MultiCell(170, 7, utf8_decode('Por el acuerdo del C. Rector del '.trim($nombreInstitucion).', se expide la presente, certificación en Tuxtla Gutiérrez Chiapas, a los '.trim(strtolower($fechaDia)).' días del mes de '.trim($mes[date('m')]).' del '.trim(strtolower($fechaAnio))).'.', 0, 'J');

        $pdf->SetFont('Arial','', '12');
		$pdf->SetY($y3 = $y2 + 20);
		$pdf->MultiCell('', 7, utf8_decode('RECTOR'), 0, 'C');

		$pdf->SetFont('Arial','', '9');
		$pdf->SetY($y3 + 17.2);
		$pdf->MultiCell('', 7, utf8_decode('MTRO. EMILIO ENRIQUE SALAZAR NARVAEZ'), 0, 'C');

		$pdf->SetFont('Arial','B', '10');
		$pdf->SetXY($x + 110, $y3 + 18);
		$pdf->MultiCell('', 5, utf8_decode('No. Folio.'), 0, 'C');
		$pdf->SetXY($x + 140, $y3 + 18);
		$pdf->MultiCell('', 5, utf8_decode($folio), 0, 'C');


		# nombre titulo
		$pdf->Line(49, 100, 193, 100);
		# legalizo
		$pdf->Line(49, 180, 193, 180);
		# realizo
		$pdf->Line(49, 200, 193, 200);
		#rector
		$pdf->Line(70, 253, 146, 253);
		#folio
		$pdf->Line(178, 257, 194, 257);


     ###################################################### REVERSO CERTIFICADO #############################################################
    #
    #
    $pdf->AliasNbPages();
    $pdf->AddPage();


    #linea superior
    $pdf->Line(78, 48, 140, 48);
    #linea inferior
    $pdf->Line(78, 105, 140, 105);
    #linea izquierda
    $pdf->Line(78, 48, 78, 105);
    #linea derecha
    $pdf->Line(140, 48, 140, 105);
     #linea director
    $pdf->Line(78, 175, 140, 175);


    #leyenda recuadro holograma
    $pdf->SetFont('Arial', '', '6.5');
    $pdf->SetXY(78, 100);
    $pdf->MultiCell('', 7, utf8_decode(trim('*Este Documento no es válido sin el holograma Oficial S.E*')), 0, 'J');

    #leyenda debajo holograma
    $pdf->SetFont('Arial', '', '8');
    $pdf->SetXY(44, 125);
    $pdf->MultiCell(129, 3, utf8_decode(trim('El suscrito Dr. Luis Madrigal Frías, Director de Educación Superior, CERTIFICA que el presente formato de certificación Grado, que consta en el anverso y reverso de esta hoja, es el que se utilizará en todas las Maestrías, Doctorados y Especialidades que imparta el '.trim($nombreInstitucion).', en la ciudad de Tuxtla Gutiérrez, Chiapas.')), 0, 'J');


    $pdf->SetFont('Arial', '', '8');
    $pdf->SetXY(44, 150);
    $pdf->MultiCell(129, 3, utf8_decode(trim('Tuxtla Gutiérrez Chiapas. 30 de Junio de 2017')), 0, 'R');

    #nombre director
    $pdf->SetFont('Arial', 'B', '10');
    $pdf->SetXY(44, 170);
    $pdf->MultiCell(129, 3, utf8_decode(trim('DR. LUIS MADRIGAL FRÍAS')), 0, 'C');

     #nombre director
    $pdf->SetFont('Arial', 'B', '10');
    $pdf->SetXY(74, 178);
    $pdf->MultiCell(70, 5, utf8_decode(trim('Director de Educación Superior de la Secretaría de Educación en el Estado')), 0, 'C');
    #
    #
    ###################################################### REVERSO CERTIFICADO #############################################################


  $pdf->Output('CertificacionPosgrado.pdf','I');
}
#-- / fin titulo posgrado --#



#-- error --#
else {
	echo "Error de Consulta verifique los datos";
}
#-- / error --#


} #fin del isset
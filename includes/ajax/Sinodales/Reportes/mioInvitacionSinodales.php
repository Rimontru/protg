<?php
date_default_timezone_set('America/Monterrey');
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
  public $fecha="";   
  public $nivel="";
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
     	$this->SetFont('Arial','',12);
     	$this->Ln(20);
     	$this->Cell(185,5,utf8_decode('SOLICITANDO SU ASISTENCIA'),0,1,'R');
     	$this->Cell(185,5,utf8_decode('PARA EL EXAMEN '.$this->nivel),0,0,'R');
    	$this->Ln(10);

    	$this->Cell(185,5,utf8_decode('TUXTLA GUTIÉRREZ, CHIAPAS'),0,1,'R');
     	$this->Cell(185,5,$this->fecha,0,0,'R');
    	$this->Ln(12);
  }

  function Footer(){
      $this->SetY(-45);
      $this->SetFont('Arial','B',12);
      $this->Cell(0,5,utf8_decode('MTRO. FILEMON CORZO NAÑEZ'),0,1,'C');
      $this->SetFont('Arial','',12);
      $this->Cell(0,5,utf8_decode('DIRECTOR DE POSGRADO'),0,0,'C');
  }
  
}//Fin de la clase
///TERMINA LA CLASE EXTENDIDA DE FPDF
  extract($_GET);
 $Obras = new ConsultaDB;
 $Funciones = new MisFunciones;
 $fechaHoy = strtoupper($Funciones->Fecha3(date("Y-m-d")));

  /////////////////////////////////////////////////////////////////////////////
  //propiedades de la pagina 
  $pdf = new PDF('P','mm','Letter');
  $pdf->fecha = $fechaHoy;  
  if($nivel == 2){
      $pdf->nivel = 'PROFESIONAL';     
      $tituloCarrera = 'LICENCIATURA';  
      $option = " AND a.fk_nivelestudio LIKE '%$nivel%'";         
  }else if($nivel == 0){
      $pdf->nivel = 'DE GRADO';
       $tituloCarrera = 'MAESTRIA Y DOCTORADO';
       $option = " AND  (a.fk_nivelestudio LIKE '%4%' OR a.fk_nivelestudio LIKE '%3%')";
  }
  //colores de fondo y del texto para el titulo de la tabla 
  $fondox = '206';//274
  $fondoy = '236';//200
  $fondoz = '245';//60 COLORES 
  $texcolx = '3';
  $texcoly = '3';
  $texcolz = '3';
    
  $pdf->AliasNbPages();
  $pdf->AddPage();
  #Establecemos los márgenes izquierda, arriba y derecha: 
  $pdf->SetMargins(35, 25 , 20); 
  
  if(!empty($sinodal) && !empty($rangoFecha)){

       $result = $Obras->datosSinodalPk($sinodal);//obtenemos todos los datos del sinodal
       if($result){
           $row = mysql_fetch_assoc($result);
      //       //////////////////////////////////////////////////////////////////////////////
      //       //NOMBE DEL ALUMNO, VALIDAMOS LA CANTIDAD DE LOS CARACTERES PARA CONOCER SU TAMAÑO
               $nombreProfe = utf8_decode($row['nombre']);


                 $FechaTomaProtestaModificar = explode("/", $rangoFecha);
                 $FechaTomaProtestaLista = $FechaTomaProtestaModificar[0] . "-" . $FechaTomaProtestaModificar[1] . "-" . $FechaTomaProtestaModificar[2];
                 $fechaLetras = $Funciones->Fecha2Mayusculas($FechaTomaProtestaLista);

                 $fechaDividir = explode("DE", $fechaLetras);
                 //traer sustentantes 
                 $row_sustentantes = $Obras->obtenerSustentantesSinodal($sinodal, $rangoFecha, $option, $cargo); //obtenemos datos de los sustentantes
            ///////////////////////////////////
            ///empezamos a llenar nuestro PDF
            ////////////////////////////////// 
                //$pdf->image2wbmp(image)('../../../../../assets/img/foto.png',11,59,20,25);
                //contenido o cuerpo
                      $pdf->SetFont('Arial','B', '12');
                      $pdf->SetXY(20, 70);
                      $pdf->Cell(0, 5,$nombreProfe,0,0,'J');
                      $pdf->Ln(5);
                      $pdf->SetXY(20, 75);
                      $pdf->Cell(0, 5,"PRESENTE.",0,0,'J');
                      $pdf->Ln(15);
                      $pdf->SetXY(20, 90);
                      $pdf->SetFont('Arial','', '12');
                      $pdf->MultiCell(0, 5,utf8_decode("POR ESTE CONDUCTO SOLICITO A USTED, SU PRECENCIA, EN ESTA INSTITUCIÓN EDUCATIVA, PARA EL DIA ".trim($fechaDividir[2])." DE ".trim($fechaDividir[1])." DEL PRESENTE AÑO, YA QUE FUE DESIGNADO ".strtoupper($cargo)." EN LA APLICACION DEL EXÁMEN DE GRADO DE LOS SIGUIENTES SUSTENTANTES:"),0,'J');
                      $pdf->Ln(8);

                      $pdf->SetXY(35, 120);
                      $pdf->SetFont('Arial','B', '12');
                      $pdf->MultiCell(21, 6,'HORA SRIA',1,'C');
                      $pdf->SetXY(56, 120);
                      $pdf->SetFont('Arial','B', '12');
                      $pdf->MultiCell(63, 12,'SUSTENTANTE',1,'C');
                      $pdf->SetXY(119, 120);
                      $pdf->SetFont('Arial','B', '12');
                      $pdf->MultiCell(63, 12,$tituloCarrera,1,'C');

                      $pdf->SetFont('Arial','', '10');
                      if($row_sustentantes != false){
                       $pdf->SetWidths(array(21, 63, 63 ));
                      // srand(microtime()*1000000);
                            foreach ($row_sustentantes as $value) {
                              $nombreAlumno = $Funciones->Capital($value->nombreAlumno);
                              $nombreCarrera = $Funciones->Capital($value->nombreCarrera);
                              $datos = array($value->hora, utf8_decode($nombreAlumno), utf8_decode($nombreCarrera));
                              $pdf->Row($datos);
                            }
                      }else{
        
                              $pdf->SetXY(35, 132);
                              $pdf->SetFont('Arial','', '12');
                              $pdf->MultiCell(147, 10,'No existen sustentantes para este sinodal.',1,'J');
                              $pdf->Ln(5);
                      }
                      
                      
                      $pdf->SetFont('Arial','', '12');
                      $pdf->SetXY(20,216);
                      $pdf->Cell(0, 5, utf8_decode('EN ESPERA DE SU PUNTUAL ASISTENCIA, QUEDO DE USTED'),0, 0, 'J');

            ///////////////////////////////////
            ///empezamos a llenar nuestro PDF
            //////////////////////////////////


      }else{

          $pdf->SetFont('Times','','15');    
              $pdf->Cell(0,5,utf8_decode("No se pudo realizar la consulta."),0,1,'C');
              $pdf->Cell(0,5,utf8_decode("Ocurrio un error comunicate con el Admin. del sistema."),0,1,'C');
          $pdf->Ln(5);
      }

  }else{

      $pdf->SetFont('Times','','15');    
      $pdf->Cell(0,5,"Lo Sentimos No Se Pudo Realizar la Consulta",0,1,'C');
      $pdf->Cell(0,5,"Te faltan datos por indicar.",0,1,'C');
      $pdf->Ln(5);
  }    
        

  $pdf->Output('ActadeExamenFrente.pdf','D');



?> 

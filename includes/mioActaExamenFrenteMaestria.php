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
    $this->Ln(50);
  }

  function Footer(){
      $this->SetY(-15);
      $this->SetFont('Arial','',8);
      $this->Cell(0,10,utf8_decode('Este documento no es válido si presenta raspaduras o enmendaduras'),0,0,'C');
  }
  
}//Fin de la clase
///TERMINA LA CLASE EXTENDIDA DE FPDF

 $Obras = new ConsultaDB;
 $Funciones = new MisFunciones;
      //$today = date("d-m-Y");
      //$fechaServidor= date("Y");


  /////////////////////////////////////////////////////////////////////////////
  //propiedades de la pagina 
  $pdf = new PDF('P','mm','Letter');
       
  //colores de fondo y del texto para el titulo de la tabla 
  $fondox = '206';//274
  $fondoy = '236';//200
  $fondoz = '245';//60 COLORES 
  $texcolx = '3';
  $texcoly = '3';
  $texcolz = '3';
    
  $pdf->AliasNbPages();
  $pdf->AddPage();
  
  if(isset($_GET['pk_alumno'])){

          //DATOS DE LA ESCUELA
            $Result32 = $Obras->ConsultaDatosInsitucionConEstados();
            if ($Result32) {
                $row333 = mysql_fetch_assoc($Result32);
                $nombreInstitucion = $Funciones->Capital($Funciones->str_to_min(utf8_decode($row333['nombreInstitucion'])));
            }


      $pk_alumno = $_GET['pk_alumno'];//recibimos parametro del alumno
      $result = $Obras->ConReporteDocumentacionAlumnosPorLlavePrimaria($pk_alumno);//obtenemos todos los datos del alumno
      if($result){
          $row = mysql_fetch_assoc($result);
          // NOMBE DEL TITULO, VALIDAMOS LA CANTIDAD DE LOS CARACTERES PARA CONOCER SU TAMAÑO
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
            //////////////////////////////////////////////////////////////////////////////
            //COMPROBAMOS SI EL noacuerdo TRAE EL TEXTO "ACUERDO NUMERO" PARA PODER QUITARSELO
              $noacuerdo = ucwords(strtolower($row['noacuerdo']));
                  $noacuerdo = strtr($noacuerdo, "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
                  $noacuerdo = str_replace("Psu", "PSU", $noacuerdo);
              //if ($acuerdo === false) {
              //  $noacuerdo = $row['noacuerdo'];
              //} else {
              //  $noacuerdo = substr($row['noacuerdo'],15);  
              //}
            //TERMINA COMPROBACION DEL noacuerdo
            //saber si es fecha o vigente 1=fecha 2=vigente 3=Vigencia
              if($row['TipoRevoe']=='1'){            
                        $fechaVigente=" de fecha ";
                    }else if($row['TipoRevoe']=='2'){
                        $fechaVigente="vigencia ";
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
            //HORA
              $hora =$row['hora'];
              $horaDividir = explode(":",$hora);
              $horaHora=$horaDividir[0];
              $horaMinuto = $horaDividir[1];

              $horaListo = convertir($horaHora);
              $horaMinutoListo = convertir($horaMinuto);
              $hora =$horaListo." ".$horaMinutoListo;
                $hora = strtr($hora, "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
            //obtenemos fecha actual y cambiamos el formato de vista
                $FechaTomaProtesta = $row['FechaTomaProtesta'];
                $FechaTomaProtestaModificar = explode("-", $FechaTomaProtesta);
                $FechaTomaProtestaLista = $FechaTomaProtestaModificar[0] . "-" . $FechaTomaProtestaModificar[1] . "-" . $FechaTomaProtestaModificar[2];
                $fechaLetras = $Funciones->Fecha2Mayusculas($FechaTomaProtestaLista);

                $fechaDividir = explode("DE", $fechaLetras);
                $fechaDia = convertir($fechaDividir[0]);
                    $fechaDia = strtr($fechaDia, "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
                $fechaMes = $fechaDividir[1];
                    $fechaMes = strtr($fechaMes, "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
					 $fechMes = strtolower($fechaMes); #minuscula
					$Nmes = ucwords($fechMes);
                $fechaAnio = convertir($fechaDividir[2]);
                    $fechaAnio = strtr($fechaAnio, "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
                
				$tituladoPor= strtolower($row['NombreOpcionTitulacion']);
				$titulado=ucfirst($tituladoPor);
			
				if($row['fk_titulacion']==2){
					$opciondetitulo=$titulado.' ('.$row['Prome'].')';}
				else{
					$opciondetitulo=$titulado;}
				  
                 //sinodales
                 $presidente = $row['NombrePresidente'];
                 $secretario= $row['NombreSecretario'];
                 $vocal= $row['NombreVocal'];
         
                 if($row['fk_genero'] == 1){
                      $genero = "del ";
                 }else if($row['fk_genero'] == 2){
                      $genero = "de la ";
                 }

            ///////////////////////////////////
            ///empezamos a llenar nuestro PDF
            ////////////////////////////////// 
                $pdf->Image('../../../../../assets/img/foto.png',11,59,20,25);
                $pdf->SetFont('Arial','B','16');
                //contenido o cuerpo
                    $pdf->SetTextColor($texcolx,$texcoly,$texcolz);  
                    $pdf->SetXY(48, 31);
                    $pdf->Cell(147,7,"ACTA DE EXAMEN DE POSGRADO",0,1,'C');
                    $pdf->Ln(16);

                      $pdf->SetFont('Arial','', '12');
                      $pdf->SetXY(48, 43);
                      $pdf->MultiCell(147, 6, utf8_decode('En la ciudad de Tuxtla Gutiérrez, Chiapas siendo  las '.trim(strtolower($hora)).' horas del día '.trim(strtolower($fechaDia)).' del mes de '.trim($Nmes).' del '.trim(strtolower($fechaAnio)).' se reunieron los miembros del jurado para proceder a efectuar la evaluación '.$genero.' C. ').$nombreAlumno.utf8_decode(' con número de control ') .$row['matricula'].','.utf8_decode(' para obtener el título de ') .$nombreTitulo.utf8_decode(', en el '.$nombreInstitucion.', con base a la opción de titulación: '.$opciondetitulo.', con reconocimiento de validez oficial de la Secretaría de Educación del Estado de Chiapas, según '.trim($noacuerdo).' '.trim($fechaVigente).' '. utf8_encode($fechaExpedicion).'.'), 0, 'J');
                      $pdf->Ln(23); 

                      // $pdf->Line(64, 90, 170, 90);
                      // $pdf->Line(64, 90, 170, 90);

                      $pdf->SetFont('Arial','', '12');
                      $pdf->SetXY(48, 105);
                      $pdf->MultiCell(149, 5, utf8_decode('Una  vez  concluido  el   examen   el   jurado   deliberó   sobre   los  conocimientos  y  aptitudes  demostradas  y  determinó:'), 0, 'J');
                      $pdf->Ln(23);


                      $pdf->SetFont('Arial','', '12');
                      $pdf->SetXY(50, 115);
                      $pdf->MultiCell(136, 6, utf8_decode('APROBARLO'), 0, 'C');
                      $pdf->Ln(23);

                      $pdf->Line(64, 120, 170, 120);
                      $pdf->Line(64, 120, 170, 120);

                      $pdf->SetFont('Arial','', '12');
                      $pdf->SetXY(48, 121);
                      $pdf->MultiCell(147, 6, utf8_decode('El presidente del jurado le dió a conocer el resultado y procedió a tomar la protesta de Ley.'), 0, 'J');
                      $pdf->Ln(23);

                      $pdf->SetFont('Arial','', '12');
                      $pdf->SetXY(55, 145);
                      $pdf->MultiCell(147, 6, utf8_decode('Presidente'), 0, 'J');

                      $pdf->SetFont('Arial','', '9');
                      $pdf->SetXY(55, 170);
                      $pdf->Cell(15, 6, utf8_decode($presidente), 0, 0, 'C');
                      $pdf->SetXY(55, 175);
                      $pdf->Cell(15, 5, utf8_decode('No. CEDULA. '.$row['CedulaPresidente']), 0, 0, 'C');

                      $pdf->SetFont('Arial','', '12');
                      $pdf->SetXY(147, 145);
                      $pdf->MultiCell(147, 6, utf8_decode(' Secretario'), 0, 'J');

                      $pdf->SetFont('Arial','', '9');
                      $pdf->SetXY(153, 170);
                      $pdf->Cell(15, 6, utf8_decode($secretario), 0, 0, 'C');
                      $pdf->SetXY(153, 175);
                      $pdf->Cell(15, 5, utf8_decode('No. CEDULA. '.$row['CedulaSecretario']), 0, 0, 'C');
  
                      $pdf->SetFont('Arial','', '12');
                      $pdf->SetXY(103, 181);
                      $pdf->Cell(15, 6, utf8_decode('Vocal'), 0, 0, 'C');

                      $pdf->SetFont('Arial','', '9');
                      $pdf->SetXY(103, 208);
                      $pdf->Cell(15, 6, utf8_decode($vocal), 0, 0, 'C');
                       $pdf->SetXY(103, 213);
                      $pdf->Cell(15, 5, utf8_decode('No. CEDULA. '.$row['CedulaVocal']), 0, 0, 'C');

                      $pdf->SetFont('Arial','', '12');
                      //$pdf->SetXY(103, 223);
                      $pdf->SetXY(103, 231);
                      $pdf->MultiCell(147, 6, utf8_decode('Rector'), 0, 'J');

                      $pdf->SetFont('Arial','', '9');
                      //$pdf->SetXY(103, 244);
                      $pdf->SetXY(103, 252);
                      $pdf->Cell(15, 6, utf8_decode('MTRO. EMILIO ENRIQUE SALAZAR NARVAEZ'),0, 0, 'C');

                      $pdf->SetFont('Arial','', '9');
                      $pdf->SetXY(173, 252);
                      $pdf->Cell(15, 5, utf8_decode('No. Folio.'),0, 0, 'C');
                      $pdf->Cell(15, 5, utf8_decode($_GET['folio']),'B', 0, 'C');

                      //presidente
                      $pdf->Line(31, 170, 97, 170);
                      //secretaria
                      $pdf->Line(125, 170, 195, 170);
                      //vocal
                      $pdf->Line(75, 208, 150, 208);
                      //rector
                      $pdf->Line(75, 252, 146, 252);

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
      $pdf->Ln(5);
  }    
        

  $pdf->Output('ActadeExamenFrente.pdf','D');



?> 

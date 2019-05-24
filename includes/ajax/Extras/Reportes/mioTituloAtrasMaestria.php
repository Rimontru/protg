<?php
session_start();
date_default_timezone_set('America/Monterrey');

require_once("../../../../includes/Config.class.php");  # Cargar datos conexion y otras variables.
require_once('../../../../includes/DB.class.php');
require_once('../../../../includes/ConsultaDB.class.php');
require_once('../../../../includes/MisFunciones.class.php');
require_once('../../../../includes/ConvertirNumLetra.php');
require_once('../../../../includes/DeNumero_a_Letras.php');
require_once('../../../../fpdf/fpdf.php');
require_once('../../../../fpdf/class_pdf/classXtendsPDF.php');

$Obras = new ConsultaDB;
$Funciones = new MisFunciones;


////////////////////////////////////////////////////////////////////////////////
$pkAlu[]=NULL;
$foja[]=NULL;
$Registro[]=NULL;
$folioFin[]=NULL;


foreach($_SESSION['Fulldatos'] as $id => $valor){
	$request=$Obras->ObtieneLaPKdelAlumno($valor['matricula']);
	$rowAlu=mysql_fetch_assoc($request);
	$pkAlu[$id]=$rowAlu['pk_alumno'];
	$foja[$id]=$valor['foja'];
	$Registro[$id]=$valor['libro'];
	$folioFin[$id]=$valor['folio'];
}



//obtenemos fecha actual y cambiamos el formato de vista
$fechaActual = $valor['f_atras'];
$fechaActualModificar = explode("-", $fechaActual);
$fechaActualLista = $fechaActualModificar[0] . "-" . $fechaActualModificar[1] . "-" . $fechaActualModificar[2];
$fechaLetras = $Funciones->Fecha2Mayusculas($fechaActualLista);

$fechaDividir = explode("DE", $fechaLetras);
$fechaDia = $fechaDividir[0];
$fechaMes = $fechaDividir[1];
$fechaAnio = $fechaDividir[2];



if(!empty($pkAlu)){


//propiedades de la pagina 
$pdf = new PDF('P','mm','Legal');
   
//colores de fondo y del texto para el titulo de la tabla 
$fondox = '206';//274
$fondoy = '236';//200
$fondoz = '245';//60 COLORES 
$texcolx = '3';
$texcoly = '3';
$texcolz = '3';
    
	
	$prints=0;
	while($prints < count($pkAlu)){
		
		$pdf->AliasNbPages();
		$pdf->AddPage();
		
		$conv = array("Á" => "A", "É" => "E", "Í" => "I", "Ó" => "O", "Ú" => "U");
		#Establecemos los márgenes izquierda, arriba y derecha: 
		$pdf->SetMargins(20, 25 , 30); 

      	$pk_alumno = $pkAlu[$prints]; 
      	$fojanumero = $foja[$prints];
      	$nuRegistro = $Registro[$prints];
        $folio = $folioFin[$prints];
		
		
		
      	$result = $Obras->ConReporteDocumentacionAlumnosPorLlavePrimaria($pk_alumno);//obtenemos todos los datos del alumno
      	if($result){
          	$row = mysql_fetch_assoc($result);
          	// NOMBE DEL TITULO, VALIDAMOS LA CANTIDAD DE LOS CARACTERES PARA CONOCER SU TAMAÑO
              	$nombreTitulo = $Funciones->str_to_min(utf8_decode($row['nombreTitulo']));
              	$nombreTitulo = $Funciones->Capital($nombreTitulo);

	            //////////////////////////////////////////////////////////////////////////////
	            //NOMBE DEL ALUMNO, VALIDAMOS LA CANTIDAD DE LOS CARACTERES PARA CONOCER SU TAMAÑO
	            //$nombreAlumno = utf8_decode($row['NombreAlumno'].' '.$row['ApaternoAlumno'].' '.$row['AmaternoAlumno']);
               $nombre = strtr($row['NombreAlumno'], $conv);
                $apaterno = strtr($row['ApaternoAlumno'], $conv);
                $amaterno = strtr($row['AmaternoAlumno'], $conv);
                $nombreAlumno = utf8_decode($nombre.' '.$apaterno.' '.$amaterno);
              
            	//obtenemos fecha actual y cambiamos el formato de vista
                $FechaTomaProtesta = $row['FechaTomaProtesta'];
                $FechaTomaProtestaModificar = explode("-", $FechaTomaProtesta);
                $FechaTomaProtestaLista = $FechaTomaProtestaModificar[0] . "-" . $FechaTomaProtestaModificar[1] . "-" . $FechaTomaProtestaModificar[2];
                $fechaLetras = $Funciones->Fecha2Mayusculas($FechaTomaProtestaLista);

                $fechaDividir = explode("DE", $fechaLetras);
                $fechaDia = convertir($fechaDividir[0]);
                $fechaMes = $fechaDividir[1];
                $fechaAnio = convertir($fechaDividir[2]);

                $NombreOpcionTitulacion = $Funciones->Capital($row['NombreOpcionTitulacion']);
                $nomTesis = $row['nombreTesis'];
                $nomTesis = strtr(strtolower($nomTesis), "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
                $nomTesis = $Funciones->Capital($nomTesis);
                 if($NombreOpcionTitulacion == "Tesis de Grado") $NombreOpcionTitulacion = $NombreOpcionTitulacion." ".trim($nomTesis); 
            	///////////////////////////////////
            	///empezamos a llenar nuestro PDF
            	////////////////////////////////// 

                //contenido o cuerpo
  
                   
                      $pdf->SetFont('Arial','', '12');
                      $pdf->SetXY(20, 43);
                      $pdf->Cell(82, 6, utf8_decode('El presente Título fue expedido a favor de: '),0 , 0, 'J');
                      $pdf->SetFont('Arial','', '12');
                      $pdf->Cell(0, 6, $nombreAlumno,0 , 0, 'J');
                      $pdf->Ln(11); 

                      $pdf->SetFont('Arial','', '12');
                      $pdf->Cell(0, 6, utf8_decode('Quien cursó los estudios de: ').$nombreTitulo.'.',0 , 1, 'J');

                      $pdf->MultiCell(0,5,utf8_decode("Y aprobó conforme a la opción de titulación: ".$NombreOpcionTitulacion),0,'J');
                      //$pdf->Cell(85, 6, utf8_decode('Y aprobó conforme a la opción de titulación: '),0 , 0, 'J');
                      //$pdf->Cell(0,6,utf8_decode($NombreOpcionTitulacion),0,1,'L');

                      //$pdf->SetXY(20, 69);
                      $pdf->SetXY(20, 75);
                      $pdf->Cell(0,6,utf8_decode('El día '.$Funciones->FechaCero($row['FechaTomaProtesta']).'.'),0,0,'J');
                      $pdf->Ln(20);

                      //
                      $pdf->Cell(0, 8, utf8_decode('Quedó registrado en el Libro No. '. $nuRegistro. ' Foja No. '.$fojanumero),0 , 0, 'J');
                      $pdf->Ln(15);
                      $pdf->Cell(0, 8, utf8_decode('Tuxtla Gutiérrez, Chiapas, a  '. $Funciones->Fecha2($fechaActual)),0 , 1, 'J');
                      $pdf->Ln(10); 

                      //$pdf->SetFont('Times','', '12');
                      $pdf->Cell(0, 8, utf8_decode('Responsable de Servicios Escolares'),0 , 1, 'J');
                      

                      $pdf->Line(20, 155, 92, 155);
                      $pdf->SetXY(23, 155);
                      $pdf->SetFont('Arial','', '12');
                      $pdf->Cell(0, 8, utf8_decode('LAE. Floribel Megchún de la Cruz'),0 , 1, 'J');


                      $pdf->SetXY(104, 200);
                      $pdf->Cell(64, 30,' ',1 , 1, 'C');

                      $pdf->SetXY(127, 213);
                      $pdf->SetFont('Arial','', '5');
                      $pdf->Cell(15, 4,utf8_decode('* Este documento no es válido sin el Holograma Oficial S.E.*'),0, 0, 'C');

                     $pdf->SetXY(20, 300);
                      $pdf->SetFont('Arial','B', '12');
                      $pdf->Cell(15, 4,utf8_decode('Folio Nº '),0, 0, 'C');
                      $pdf->Cell(20, 4,utf8_decode($folio.$fojanumero),'B', 0, 'C');

            ///////////////////////////////////
            ///empezamos a llenar nuestro PDF
            //////////////////////////////////


      }else{

          $pdf->SetFont('Times','','15');    
              $pdf->Cell(0,5,utf8_decode("No se pudo realizar la consulta."),0,1,'C');
              $pdf->Cell(0,5,utf8_decode("Ocurrio un error comunicate con el Admin. del sistema."),0,1,'C');
          $pdf->Ln(5);
      }
	  
	$prints++;	
	}#fin del ciclo del total de matriculas


}
else{

  $pdf->SetFont('Times','','15');    
  $pdf->Cell(0,5,"Lo Sentimos No Se Pudo Realizar la Consulta",0,1,'C');
  $pdf->Ln(5);
}    
        

  $pdf->Output('Titulos_Atras_posgrado.pdf','I');



?> 
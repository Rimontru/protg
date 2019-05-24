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
foreach($_SESSION['Fulldatos'] as $id => $valor){
	$request=$Obras->ObtieneLaPKdelAlumno($valor['matricula']);
	$rowAlu=mysql_fetch_assoc($request);
	$pkAlu[$id]=$rowAlu['pk_alumno'];
}


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
		
		$pk_alumno = $pkAlu[$prints]; 
	
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

			$nombre = strtr($row['NombreAlumno'], $conv);
			$apaterno = strtr($row['ApaternoAlumno'], $conv);
			$amaterno = strtr($row['AmaternoAlumno'], $conv);
			$nombreAlumno = utf8_decode(trim($nombre).' '.trim($apaterno).' '.trim($amaterno));

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
	        $FechaTomaProtesta = $valor['f_frente'];
	        $FechaTomaProtestaModificar = explode("-", $FechaTomaProtesta);
	        $FechaTomaProtestaLista = $FechaTomaProtestaModificar[0] . "-" . $FechaTomaProtestaModificar[1] . "-" . $FechaTomaProtestaModificar[2];
	        $fechaLetras = $Funciones->Fecha2Mayusculas($FechaTomaProtestaLista);
	        $fechaDividir = explode("DE", $fechaLetras);
	        $fechaDiaProtesta = strtolower(convertir($fechaDividir[0]));
	        $fechaDiaProtesta = strtr($fechaDiaProtesta, "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
				
	        $fechaMesProtesta =strtolower( $fechaDividir[1]);
			$Letrames= substr($fechaMesProtesta,1,1);
			$mes=str_replace($Letrames,strtoupper($Letrames),$fechaMesProtesta);
			
	        $fechaAnioProtesta = strtolower(convertir($fechaDividir[2]));
			$xxx = explode(" ", $fechaAnioProtesta);
			$fechaAnioProtestaListo=$xxx[2];   
			$fechaAnioProtestaListo = strtr($fechaAnioProtestaListo, "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");

		///////////////////////////////////
		///empezamos a llenar nuestro PDF
		//////////////////////////////////
			$pdf->Image('../../../../assets/img/foto.png',20,100,20,25);
			//$pdf->addFont('Batang');
			$pdf->SetFont('Times','','22');
			//contenido o cuerpo
				$pdf->SetTextColor($texcolx,$texcoly,$texcolz);  
		        $pdf->Cell(132,5,"Otorga a",0,1,'R');
		        $pdf->Ln(16);

		    $pdf->SetFont('Times','','20');    
		    //$pdf->SetFont('Times','','18');
		    $pdf->SetXY(64, 105);
		    $pdf->Cell(130,7,$nombreAlumno,0,0,'C');
		    $pdf->Ln(8);
		    
		    $pdf->SetFont('Times','','22');   
		    $pdf->SetXY(64, 120); 
		        $pdf->Cell(130,5,utf8_decode("El Título de "),0,1,'C');
		        $pdf->Ln(5);   

		    $pdf->SetFont('Times','','20');    
		    	$pdf->SetXY(64, 133);
		    	$pdf->Cell(130,7,$nombreTitulo,0,0,'C');
		        $pdf->Ln(5);   

		    $pdf->SetFont('Arial','', '12');
			$pdf->SetXY(63, 153);
			$pdf->MultiCell(130, 7, utf8_decode('Con Reconocimiento de Validez Oficial de Estudios, otorgado por la Secretaría   de   Educación   del   Estado   de   Chiapas,   según '.trim($noacuerdo).' '.trim($fechaVigente).' '.utf8_encode($fechaExpedicion).', en atención a que terminó los estudios correspondientes, de acuerdo al Plan y Programa de estudios vigente.'), 0, 'J');
			$pdf->Ln(20); 

			$pdf->Line(8, 210, 47, 210);
			$pdf->Line(8, 210, 47, 210);
			$pdf->SetFont('Arial','','12');
				$pdf->SetXY(10, 211);    
		        $pdf->Cell(0,5,utf8_decode("Firma del Alumno"),0,1,'L');
		        $pdf->Ln(5);

			$pdf->SetFont('Arial','','12');    
			$pdf->SetXY(63, 210);
		        $pdf->MultiCell(130,7,utf8_decode("Tuxtla Gutiérrez, Chiapas, a los ".$fechaDiaProtesta." días del mes de ".$mes." del año dos mil ".$fechaAnioProtestaListo."."),0,'J');
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
		}//fin del resultado de la consulta
		else{
			//si nuestro resultado no es verdadero mandamos el mensaje de error
			$pdf->SetFont('Arial','','12');    
			$pdf->Cell(0,5,"Lo Sentimos No Se Pudo Realizar la Consulta",0,1,'C');
			$pdf->Ln(5);
		}

	$prints++;	
	}#fin del ciclo del total de matriculas

}#in de la comprobacion cuando mi arreglo de matriculas no esta vacio
else{
	//mensaje de error por si en alguna circunstancia
	// no recibimos el parametro de pk_alumno
	$pdf->SetFont('Arial','','12');    
	$pdf->Cell(0,5,"Lo Sentimos No Se Pudo Realizar la Consulta",0,1,'C');
	$pdf->Ln(5);
}

	
$pdf->Output('Titulos_Frente_licenciatura.pdf','I');
?>
<?php

require_once("../../../../Config.class.php");  # Cargar datos conexion y otras variables.
require_once('../../../../DB.class.php');
require_once('../../../../ConsultaDB.class.php');
require_once('../../../../../mpdf/mpdf.php');
require_once('../../../../MisFunciones.class.php');


require_once ("../../../../jpgraph/src/jpgraph.php");
require_once ("../../../../jpgraph/src/jpgraph_pie.php");
        
date_default_timezone_set('America/Mexico_City');      
$Obras = new ConsultaDB;
$Funciones = new MisFunciones();
date_default_timezone_set('America/Mexico_City');
$today = date("d-m-Y");
$fecha = date("d/m/Y");

$EncuestaMedicinaCertificacionProfesional=$Obras->CantidadAlumnosEncuestaMedicinaGraficaCertificacionProfesional($pk_alumno);

    if ($EncuestaMedicinaCertificacionProfesional) {
        while ($row = mysql_fetch_assoc($EncuestaMedicinaCertificacionProfesional)) {
			
			
	//ESTUDIO DE POSGRADO (ESPECIALIDAD)

     if(trim($row['CertificacionProfesional'])=="1"){
        $Si=$row['cantidad'];
    }
    
    if(trim($row['CertificacionProfesional'])=="2"){
        $No=$row['cantidad'];
    }
    
}
        mysql_free_result($EncuestaMedicinaCertificacionProfesional);
    }	




// Se define el array de valores y el array de la leyenda
	$datos = array($Si,$No);
	$leyenda = array("Si","No");
	
	//Se define el grafico
	$grafico = new PieGraph(600,400);
    

        
	//Definimos el titulo 
	$grafico->title->Set("¿CUENTA CON ALGUNA CERTIFICACÓN PROFESIONAL??");
	$grafico->title->SetFont(FF_FONT2,FS_BOLD);
	$grafico->title->SetColor("black");
	$grafico->legend->SetPos(0.01, 0.25,’center’,’right’);
		$grafico->legend -> SetLineWeight (0);
    $grafico->legend  -> SetFrameWeight (1);
       $grafico->legend->SetMarkAbsSize(6);




       

	//AÃ±adimos el titulo y la leyenda
	$p1 = new PiePlot($datos);
	$p1->SetLegends($leyenda);
	$p1->SetCenter(0.25);
	$p1->value->HideZero();
	$p1->SetSliceColors(array("#FF0000","#00FF49","#002FFF","#00FFF7","#FF00FC","#FCFF00","#FFAF00","#ABABAB","","","","","",""));
	  	$p1-> SetGuideLines (false);
	$p1->value->SetFormat('%.0f%%');

	//Se muestra el grafico
	$grafico->Add($p1);
	$grafico->Stroke();
	

    
    ?>
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

$EncuestaMedicinaEstudiosPos=$Obras->CantidadAlumnosEncuestaMedicinaGrafica($pk_alumno);

    if ($EncuestaMedicinaEstudiosPos) {
        while ($row = mysql_fetch_assoc($EncuestaMedicinaEstudiosPos)) {
			
			
	//ESTUDIO DE POSGRADO (ESPECIALIDAD)

     if(trim($row['descripcion_estudiosposgrado'])=="Doctorado"){
        $Doctorado=$row['cantidad'];
    }
    
    if(trim($row['descripcion_estudiosposgrado'])=="Especialidad"){
        $Especialidad=$row['cantidad'];
    }
    
    if(trim($row['descripcion_estudiosposgrado'])=="Maestria"){
        $Maestria=$row['cantidad'];
    }
    
    if(trim($row['descripcion_estudiosposgrado'])=="Ninguno"){
        $Ninguno=$row['cantidad'];
    }
    
    if(trim($row['descripcion_estudiosposgrado'])=="Otros"){
        $Otros=$row['cantidad'];
    }
    
    if(trim($row['descripcion_estudiosposgrado'])=="Especialidad y Maestria"){
        $EM=$row['cantidad'];
    }
    
      if(trim($row['descripcion_estudiosposgrado'])=="Especialidad y Doctorado"){
        $ED=$row['cantidad'];
    }
    
      if(trim($row['descripcion_estudiosposgrado'])=="Maestria y Doctorado"){
        $MD=$row['cantidad'];
    }
    
      if(trim($row['descripcion_estudiosposgrado'])=="Especialidad,Maestria y Doctorado"){
        $EMD=$row['cantidad'];
    }
    
	
		}
        mysql_free_result($EncuestaMedicinaEstudiosPos);
    }	




// Se define el array de valores y el array de la leyenda
	$datos = array($Doctorado,$Especialidad,$Maestria,$Ninguno,$Otros,$EM,$MD,$EMD);
	$leyenda = array("Doctorado","Especialidad","Maestria","Ninguno","Otros","Especialidad y Maestria","Maestria y Doctorado","especialidad, Maestria y Doctorado");
	
	//Se define el grafico
	$grafico = new PieGraph(600,400);
    

        
	//Definimos el titulo 
	$grafico->title->Set("GRAFICA DE ALUMNOS CON ESTUDIO DE POSGRADO");
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
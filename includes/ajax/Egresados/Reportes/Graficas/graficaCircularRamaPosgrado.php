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

	$EncuestaMedicinaRamaPosgrado=$Obras->CantidadAlumnosEncuestaMedicinaGraficaramaposgrado($pk_alumno);


    if ($EncuestaMedicinaRamaPosgrado) {
        while ($row = mysql_fetch_assoc($EncuestaMedicinaRamaPosgrado)) {
			
			
	//RAMA POSGRADO 
	
     if(trim($row['descripcion_ramaposgrado'])=="Salud"){
        $salud=$row['cantidad'];
    }
    
    if(trim($row['descripcion_ramaposgrado'])=="Docencia"){
        $docencia=$row['cantidad'];
    }
    
    if(trim($row['descripcion_ramaposgrado'])=="Administracion"){
        $administracion=$row['cantidad'];
    }
    
    if(trim($row['descripcion_ramaposgrado'])=="Otros"){
        $otros=$row['cantidad'];
    }
    
    if(trim($row['descripcion_ramaposgrado'])=="Ninguno"){
        $ninguno=$row['cantidad'];
    }
    
    if(trim($row['descripcion_ramaposgrado'])=="Salud,Docencia"){
        $sd=$row['cantidad'];
    }
    
      if(trim($row['descripcion_ramaposgrado'])=="Salud,Administracion"){
        $sa=$row['cantidad'];
    }
    
      if(trim($row['descripcion_ramaposgrado'])=="Salud,Docencia,Administracion"){
        $sda=$row['cantidad'];
    }
    
      if(trim($row['descripcion_ramaposgrado'])=="Docencia,Administracion"){
        $da=$row['cantidad'];
    }
	
	
$cantidadEncuestados=$salud+$docencia+$administracion+$otros+$ninguno+$sd+$sa+$sda+$da;

	
		}
        mysql_free_result($EncuestaMedicinaRamaPosgrado);
    }	





// Se define el array de valores y el array de la leyenda
	$datos = array($salud,$docencia,$administracion,$otros,$ninguno,$sd,$sa,$sda,$da);
	$leyenda = array("Salud","Docencia","Administracion","Otros","Ninguno","Salud,Docencia","Salud,Administracion","Salud,Docencia,Administracion","Docencia,Administracion");
	
	//Se define el grafico
	$grafico = new PieGraph(600,400);
    

        
	//Definimos el titulo 
	$grafico->title->Set("GRAFICA DE ALUMNOS CON RAMA POSGRADO");
	$grafico->title->SetFont(FF_FONT2,FS_BOLD);
	$grafico->title->SetColor("black");
	$grafico->legend->SetPos(0.01, 0.10,’center’,’right’);
	$grafico->legend -> SetLineWeight (0);
    $grafico->legend  -> SetFrameWeight (1);
       $grafico->legend->SetMarkAbsSize(6);

	//AÃ±adimos el titulo y la leyenda
	$p1 = new PiePlot($datos);
	$p1->SetLegends($leyenda);
	$p1->SetCenter(0.25);
	$p1->value->HideZero();
	$p1->SetSliceColors(array("#FF0000","#00FF49","#002FFF","#00FFF7","#FF00FC","#FCFF00","#FFAF00","#ABABAB","#FFA2FD","","","","",""));
	  	$p1-> SetGuideLines (false);
	$p1->value->SetFormat('%.0f%%');

	//Se muestra el grafico
	$grafico->Add($p1);
	$grafico->Stroke();
	

    
    ?>
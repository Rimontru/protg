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

	$EncuestaMedicinaIngreso=$Obras->CantidadAlumnosEncuestaMedicinaGraficaIngresoActual($pk_alumno);


    if ($EncuestaMedicinaIngreso) {
        while ($row = mysql_fetch_assoc($EncuestaMedicinaIngreso)) {
			
			
	//RAMA POSGRADO 
	
     if(trim($row['descripcion_ingresoactual'])=="Menos de $3,000"){
        $uno=$row['cantidad'];
    }
    
    if(trim($row['descripcion_ingresoactual'])=="De $3,001 A $6,000"){
        $dos=$row['cantidad'];
    }
    
    if(trim($row['descripcion_ingresoactual'])=="De $6,001 A $9,000"){
        $tres=$row['cantidad'];
    }
    
    if(trim($row['descripcion_ingresoactual'])=="De $9,001 A $12,000"){
        $cuatro=$row['cantidad'];
    }
    
    if(trim($row['descripcion_ingresoactual'])=="De $12,001 A $15,000"){
        $cinco=$row['cantidad'];
    }
    
    if(trim($row['descripcion_ingresoactual'])=="Mas de $15,000"){
        $seis=$row['cantidad'];
    }
    
      if(trim($row['descripcion_ingresoactual'])=="Ninguno"){
        $siete=$row['cantidad'];
    }
	
	
$cantidadEncuestados=$uno+$dos+$tres+$cuatro+$cinco+$seis+$siete;

	
		}
        mysql_free_result($EncuestaMedicinaIngreso);
    }	





// Se define el array de valores y el array de la leyenda
	$datos = array($uno,$dos,$tres,$cuatro,$cinco,$seis,$siete);
	$leyenda = array("Menos de $3,000","De $3,001 A $6,000","De $6,001 A $9,000","De $9,001 A $12,000","De $12,001 A $15,000","Mas de $15,000","Ninguno");
	
	//Se define el grafico
	$grafico = new PieGraph(550,350);
    

        
	//Definimos el titulo 
	$grafico->title->Set("GRAFICA DE ALUMNOS ENCUESTADOS INGRESO ACTUAL");
	$grafico->title->SetFont(FF_FONT2,FS_BOLD);
	$grafico->title->SetColor("black");
	$grafico->legend->SetPos(0.01, 0.20,’center’,’right’);
	$grafico->legend -> SetLineWeight (0);
    $grafico->legend  -> SetFrameWeight (1);
       $grafico->legend->SetMarkAbsSize(6);

	//AÃ±adimos el titulo y la leyenda
	$p1 = new PiePlot($datos);
	$p1->SetLegends($leyenda);
	$p1->SetCenter(0.30);
	$p1->value->HideZero();
	$p1->SetSliceColors(array("#FF0000","#00FF49","#002FFF","#00FFF7","#FF00FC","#FCFF00","#FFAF00","#ABABAB","#FFA2FD","","","","",""));
	  	$p1-> SetGuideLines (false);
	$p1->value->SetFormat('%.0f%%');

	//Se muestra el grafico
	$grafico->Add($p1);
	$grafico->Stroke();
	

    
    ?>
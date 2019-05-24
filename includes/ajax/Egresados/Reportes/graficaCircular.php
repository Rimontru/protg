<?php 
	require_once ("../../../../includes/jpgraph/src/jpgraph.php");
        require_once ("../../../../includes/jpgraph/src/jpgraph_pie.php");
	// Se define el array de valores y el array de la leyenda
	$datos = array(0,54);
	$leyenda = array("Titulados","No titulados");
	
	//Se define el grafico
	$grafico = new PieGraph(450,300);
    

        
	//Definimos el titulo 
	$grafico->title->Set("Grafica de Alumnos Titulados y No Titulados");
	$grafico->title->SetFont(FF_FONT1,FS_BOLD);
	$grafico->title->SetColor("navy");
       

	//AÃ±adimos el titulo y la leyenda
	$p1 = new PiePlot($datos);
	$p1->SetLegends($leyenda);
	$p1->SetCenter(0.4);
	  $p1->SetSliceColors(array("green","red","blue")); 

	//Se muestra el grafico
	$grafico->Add($p1);
	$grafico->Stroke();
    ?>
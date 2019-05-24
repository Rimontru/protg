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

    $fk_nivelestudio = $_GET['fk_nivelestudio'];
    $fk_modalidad = $_GET['fk_modalidad'];
    $fk_carreras = $_GET['fk_carreras'];
    $fk_generacion = $_GET['fk_generacion'];
    $opcionGrafica = $_GET['opcionGrafica'];
	

	
    $CantidadAlumnosEgresadosGraficaTiempoEnEmplearse=$Obras->CantidadAlumnosEgresadosGraficaTiempoEnEmplearse($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion);

    if ($CantidadAlumnosEgresadosGraficaTiempoEnEmplearse) {
        while ($row = mysql_fetch_assoc($CantidadAlumnosEgresadosGraficaTiempoEnEmplearse)) {
            
            
    //Tiempo en encontrar empleo 
	

        
     if(trim($row['descripcion_tiempo'])=="De 1 a 3 meses"){
        $uno=$row['cantidad'];
    }		
	
    if(trim($row['descripcion_tiempo'])=="De 3 a 6 meses"){
        $dos=$row['cantidad'];
	}
    
    if(trim($row['descripcion_tiempo'])=="De 6 meses a 1 aÃ±o"){
        $tres=$row['cantidad'];
    }
    
    if(trim($row['descripcion_tiempo'])=="De 1 a 2 aÃ±os"){
        $cuatro=$row['cantidad'];
    }
    
    if(trim($row['descripcion_tiempo'])=="De 2 aÃ±os o mÃ¡s"){
        $cinco=$row['cantidad'];
    }
    
        }

        mysql_free_result($CantidadAlumnosEgresadosGraficaTiempoEnEmplearse);
        /*$concantenacion.=$row['cantidad'] .",";
        $concantenacion = substr($concantenacion, 0, -1);*/
    }   



// Se define el array de valores y el array de la leyenda
    $datos = array($uno,$dos,$tres,$cuatro,$cinco);
    $leyenda = array("De 1 a 3 meses","De 3 a 6 meses","De 6 meses a 1 año","De 1 a 2 años","De 2 años o más");
    
 //Se define el grafico
    $grafico = new PieGraph(350 ,320 );
    

        



   //Definimos el titulo 
    $grafico->title -> Set();
    $grafico->title -> SetFont(FF_FONT2,FS_BOLD);
    $grafico->title -> SetColor("black");
    $grafico->legend->Hide(true); //Ocultar Cuadro de leyenda
    $grafico->legend -> SetPos(0.10, 0.0,’center’,’right’);
    $grafico->legend -> SetLineWeight (0);
    $grafico->legend -> SetFrameWeight (0);
    $grafico->legend -> SetMarkAbsSize(10);
    $grafico->legend -> SetColumns(2);
    $grafico->SetColor("");

//    $grafico ->legend -> SetFont (FF_FONT2,FS_BOLD);



    //AÃ±adimos el titulo y la leyenda
    $p1 = new PiePlot($datos);
    $p1 -> SetLegends($leyenda);
    $p1 -> SetCenter(0.5);//Centrar Grafica
    $p1 ->value -> HideZero();
    $p1->SetSliceColors(array("#FF0000","#00FF49","#002FFF","#00FFF7","#FF00FC","#FCFF00","#FFAF00","#ABABAB","#FFA2FD","","","","",""));
    $p1-> SetGuideLines (false);
    $p1 -> SetSize (0.35);//TamaÃ±o de la grafica Porcentaje
//$p1->value->SetFormat('%.0f%%');

    //Se muestra el grafico
    $grafico->Add($p1);
    $grafico->Stroke();
    

    
    ?>
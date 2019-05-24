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
	

	
    $CantidadAlumnosEgresadosGraficaAspectoDebilidad=$Obras->CantidadAlumnosEgresadosGraficaAspectoDebilidad($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion);

    if ($CantidadAlumnosEgresadosGraficaAspectoDebilidad) {
        while ($row = mysql_fetch_assoc($CantidadAlumnosEgresadosGraficaAspectoDebilidad)) {
            
            
    //Tiempo en encontrar empleo 
	

        
     if(trim($row['descripcion_aspectodebilidad'])=="Directivos"){
        $uno=$row['cantidad'];
    }		
	
    if(trim($row['descripcion_aspectodebilidad'])=="Docentes"){
        $dos=$row['cantidad'];
	}
    
    if(trim($row['descripcion_aspectodebilidad'])=="Metodologia EnseÃ±anza"){
        $tres=$row['cantidad'];
    }
    
    if(trim($row['descripcion_aspectodebilidad'])=="Programas Academicos"){
        $cuatro=$row['cantidad'];
    }
	if(trim($row['descripcion_aspectodebilidad'])=="Plan de Estudios"){
        $cinco=$row['cantidad'];
    }		
	
    if(trim($row['descripcion_aspectodebilidad'])=="Criterios de Evaluacion"){
        $seis=$row['cantidad'];
	}
    
    if(trim($row['descripcion_aspectodebilidad'])=="Aulas y Equipo Didactico"){
        $siete=$row['cantidad'];
    }
    
    if(trim($row['descripcion_aspectodebilidad'])=="Otros"){
        $ocho=$row['cantidad'];
    }
	
	if(trim($row['descripcion_aspectodebilidad'])=="No Aplica"){
        $nueve=$row['cantidad'];
    }
    

    
        }

        mysql_free_result($CantidadAlumnosEgresadosGraficaAspectoDebilidad);
        /*$concantenacion.=$row['cantidad'] .",";
        $concantenacion = substr($concantenacion, 0, -1);*/
    }   



// Se define el array de valores y el array de la leyenda
    $datos = array($uno,$dos,$tres,$cuatro,$cinco,$seis,$siete,$ocho,$nueve);
   // $leyenda = array("Menos de $3,000","De $3,000 A $6,000","De $6,001 A $9,000","De $9,001 A $12,000","De $12,001 A $15,000","Mas de $15,000","Ninguno");
    
 //Se define el grafico
    $grafico = new PieGraph(350 ,320 );
    

        



   //Definimos el titulo 
    $grafico->title -> Set();
    $grafico->title -> SetFont(FF_FONT2,FS_BOLD);
    $grafico->title -> SetColor("black");
    $grafico->legend->Hide(true); //Ocultar Cuadro de leyenda
    $grafico->legend -> SetPos(0.25, 0.10,’center’,’right’);
    $grafico->legend -> SetLineWeight (1);
    $grafico->legend -> SetFrameWeight (1);
    $grafico->legend -> SetMarkAbsSize(10);
    $grafico->legend -> SetColumns(1);
    $grafico->SetColor("");

    $grafico ->legend -> SetFont (FF_FONT2,FS_BOLD);



    //AÃ±adimos el titulo y la leyenda
    $p1 = new PiePlot($datos);
    $p1 -> SetLegends($leyenda);
    $p1 -> SetCenter(0.5);//Centrar Grafica
    $p1 ->value -> HideZero();
    $p1->SetSliceColors(array("#FF0000","#00FF49","#002FFF","#00FFF7","#FF00FC","#FCFF00","#FFAF00","#ABABAB","#FFA2FD","#D8D8D8","","","",""));
    $p1-> SetGuideLines (false);
    $p1 -> SetSize (0.35);//TamaÃ±o de la grafica Porcentaje
	//$p1->value->SetFormat('%.0f%%');

    //Se muestra el grafico
    $grafico->Add($p1);
    $grafico->Stroke();
    


    
    ?>
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

	$EncuestaMedicinaRamaPosgrado=$Obras->CantidadAlumnosEncuestaMedicinaGraficapuesto($pk_alumno);


    	$EncuestaMedicinaPuesto=$Obras->CantidadAlumnosEncuestaMedicinaGraficapuesto($pk_alumno);


    if ($EncuestaMedicinaPuesto) {
        while ($row = mysql_fetch_assoc($EncuestaMedicinaPuesto)) {
			
			
	//RAMA POSGRADO 
	
     if(trim($row['descripcion_puestosmedicina'])=="Medico"){
        $medico=$row['cantidad'];
    }
    
    if(trim($row['descripcion_puestosmedicina'])=="Directivo"){
        $directivo=$row['cantidad'];
    }
    
    if(trim($row['descripcion_puestosmedicina'])=="Administrativo"){
        $administrativo=$row['cantidad'];
    }
    
    if(trim($row['descripcion_puestosmedicina'])=="Docente"){
        $docente=$row['cantidad'];
    }
    
    if(trim($row['descripcion_puestosmedicina'])=="Ninguno"){
        $ninguno=$row['cantidad'];
    }
    
    if(trim($row['descripcion_puestosmedicina'])=="Medico,Directivo"){
        $mdi=$row['cantidad'];
    }
    
      if(trim($row['descripcion_puestosmedicina'])=="Medico,Administrativo"){
        $ma=$row['cantidad'];
    }
    
      if(trim($row['descripcion_puestosmedicina'])=="Medico,Docente"){
        $mdo=$row['cantidad'];
    }
    
      if(trim($row['descripcion_puestosmedicina'])=="Medico,Directivo,Administrativo"){
        $mdia=$row['cantidad'];
    }
	   if(trim($row['descripcion_puestosmedicina'])=="Medico,Administrativo,Docente"){
        $mado=$row['cantidad'];
    }
	
	      if(trim($row['descripcion_puestosmedicina'])=="Meidco,Directivo,Administrativo,Docente"){
        $mdiado=$row['cantidad'];
    }
	
	      if(trim($row['descripcion_puestosmedicina'])=="Directivo,Administrativo"){
        $da=$row['cantidad'];
    }
	
	      if(trim($row['descripcion_puestosmedicina'])=="Directivo,Docente"){
        $dido=$row['cantidad'];
    }
	
	      if(trim($row['descripcion_puestosmedicina'])=="Directivo,Administrativo,Docente"){
        $diado=$row['cantidad'];
    }
	
	      if(trim($row['descripcion_puestosmedicina'])=="Administrativo,Docente"){
        $ado=$row['cantidad'];
    }
	
	
	
	
	
	
$cantidadEncuestados=$medico+$directivo+$administrativo+$docente+$ninguno+$mdi+$ma+$mdo+$mdia+$mado+$mdiado+$dia+$dido+$diado+$ado;

	
		}
        mysql_free_result($EncuestaMedicinaPuesto);
    }	




// Se define el array de valores y el array de la leyenda
	$datos = array($medico,$directivo,$administrativo,$docente,$ninguno,$mdi,$ma,$mdo,$mdia,$mado,$mdiado,$dia,$dido,$diado,$ado);
	$leyenda = array("Medico","Directivo","Administrativo","Docente","Ninguno","Medico,Directivo","Medico,Administrativo","Medico,Docente","Medico,Directivo,Administrativo","Medico,Administrativo,Docente","Medico,Directivo,Administrativo,Docente","Directivo,Administrativo","Directivo,Docente","Directivo,Administrativo,Docente","Administrativo,Docente");
	
	//Se define el grafico
	$grafico = new PieGraph(630,450);
    
        
	//Definimos el titulo 
	$grafico->title->Set(utf8_decode("GRAFÍCA DE ALUMNOS PUESTO QUE DESEMPEÑAN"));
	$grafico->title->Show(false);
	$grafico->title->SetFont(FF_FONT2,FS_BOLD);
	$grafico->title->SetColor("black");
	$grafico->legend->SetPos(0.01, 0.10,’center’,’right’);
	$grafico->legend -> SetLineWeight (0);
    $grafico->legend  -> SetFrameWeight (1);
       $grafico->legend->SetMarkAbsSize(6);

	//AÃ±adimos el titulo y la leyenda
	$p1 = new PiePlot($datos);
	$p1->SetLegends($leyenda);
	$p1->SetCenter(0.25,0.40);
	$p1->value->HideZero();
	$p1-> SetGuideLines (false);
	$p1->ShowBorder();
	//$p1->Explode(array(10, 0, 0));
	//S$p1->ExplodeAll ();
	$p1->SetSliceColors(array("#FF0000","#00FF49","#002FFF","#00FFF7","#FF00FC","#FCFF00","#FFAF00","#ABABAB","#FFA2FD","#9ECFA0","#EAFF89","#C7AF4D","#C78A4D","#6E0037","#8F529B"));
	$p1->value->SetFormat('%.0f%%');
	  
	//Se muestra el grafico
	$grafico->Add($p1);
	$grafico->Stroke();
	

    
    ?>
<?php	 	
       
        if(($pcompleta=='ReporteSinodalesTodos')){
		include('includes/ajax/Sinodales/Reportes/ReporteSinodalesTodos.php');
                exit;
	}  
	
	        if(($pcompleta=='ReporteMedicina')){
		include('includes/ajax/Egresados/Reportes/ReporteMedicina.php');
                exit;
	}  
		        if(($pcompleta=='ReporteMedicinaDatosLaborales')){
		include('includes/ajax/Egresados/Reportes/ReporteMedicinaDatosLaborales.php');
                exit;
	}  
	
	if(($pcompleta=='ReporteMedicinaOpinion')){
		include('includes/ajax/Egresados/Reportes/ReporteMedicinaOpinion.php');
                exit;
	}                  	             

?>
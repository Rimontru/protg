<?php //

//$timeo_start = microtime(true);
//ini_set("memory_limit","4096M");

require_once("includes/Config.class.php");  # Cargar datos conexion y otras variables.
require_once('includes/DB.class.php');
require_once('includes/ConsultaDB.class.php');
require_once('mpdf/mpdf.php');

//ini_set("memory_limit", "4096M");


$Obras = new ConsultaDB;
$today = date("d-m-Y"); 

//DATOS DEL SINODAL
        $fk_carreras = $row[fk_carreras];
        $Result22 = $Obras->ConsultaDatosSinodalesNivelEstudioModalidad($fk_nivelestudio, $fk_modalidad, $fk_carreras);
        if ($Result22) {
            $row222 = mysql_fetch_assoc($Result22);
            $nombreDirector = ($row222[nombre] . " " . $row222[apaterno] . " " . $row222[amaterno]);
            $carreraReporte = ($row222[nombreCarrera]);
            $genero = $row222[fk_genero];
	    $modalidad =$row222[fk_modalidad];	
            mysql_free_result($Result22);
        }


   

//realizamos la consulta para obtener los sinodales
    $html.="
			<h1 align='center'>LISTA DE SINODALES</h1>
			 
			<table border='1' width='100%' style='border-collapse: collapse; font-size:12px;'>   
                <tr>        
     				<td id='colorHead' align='center' width='120px'><div align='center'><strong>No</strong></div></td>
     				<td id='colorHead' align='center' width='120px'><div align='center'><strong>CEDULA</strong></div></td>
                                <td id='colorHead'align='center' width='300px'><div align='center'><strong>NOMBRE</strong></div></td>
                                <td id='colorHead'align='center'><div align='center'><strong>CARRERA</strong></div></td>
                                <td id='colorHead'align='center'><div align='center'><strong>MODALIDAD</strong></div></td>
                        </tr>";
    
    
    $Result = $Obras->ConsultaDatosSinodales();
    if ($Result) {


        while($row2 = mysql_fetch_assoc($Result)){
            $contador2 = $contador2 + 1;

             $html.= "<tr>
                        <td align='center' width='70'><span class='Estilo1'>$contador2</span></td>
                        <td align='center' width='70'><span class='Estilo1'>$row2[cedula]</span></td>
                         <td id='colorBody'>$row2[nombre]</td>
                         <td id='colorBody'>$row2[nombreCarrera]</td>
                         <td id='colorBody'>$row2[nombreMod]</td>
                       </tr>
					  ";
            
        }
                      
        mysql_free_result($Result);
         $html.= "</table>";
    }
    
    
$html = "<html>
        <head></head>
        <body>
        <div id='contenido'>
      ".$html."
        </body>
        </html>";

$timeo_start = microtime(true);
ini_set("memory_limit","280824M");
ini_set('max_execution_time', 400);

ob_start();
//$timeo_start = microtime(true);


 $mpdf=new mPDF('utf-8', 'A4-L');
$mpdf->WriteHTML($html);
$mpdf->Output("Reporte_Sinodales_por_Carrera_".$today,'D');

?> 
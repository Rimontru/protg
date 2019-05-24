<?php
require_once("../../../../includes/Config.class.php");  # Cargar datos conexion y otras variables.
require_once('../../../../includes/DB.class.php');
require_once('../../../../includes/ConsultaDB.class.php');
require_once('../../../../mpdf/mpdf.php');


$Obras = new ConsultaDB;
$today = date("d-m-Y");    

if (isset($_GET['fk_nivelestudio'])) {
    $fk_nivelestudio = $_GET['fk_nivelestudio'];    
    $fk_modalidad = $_GET['fk_modalidad'];  
    $fk_carreras = $_GET['fk_carreras'];
    
//realizamos la consulta para obtener los sinodales
    $html.="
            <h1 align='center'>LISTA DE SINODALES POR CARRERA</h1>
		<table border='0' width='100%' style='border-collapse: collapse; font-size:12px; text-aling:center;'>                        
						
                    <tr>
                        <td align='center' style='border-width: 1px;border: solid;' width='80'><span class='Estilo1'><strong>CEDULA</strong></span></td>
                        <td align='center' style='border-width: 1px;border: solid;' width='300'><span class='Estilo1'><strong>NOMBRE</strong></span></td>
                        <td align='center' style='border-width: 1px;border: solid;' width=''><div align='center'><span class='Estilo1'><strong>CARRERA</strong></span></div></td>
                    </tr>";
    
    $Result = $Obras->ConsultaDatosSinodalesNivelEstudioModalidad($fk_nivelestudio, $fk_modalidad, $fk_carreras);
    if ($Result) {
        while($row2 = mysql_fetch_assoc($Result)){
             $html.= "<tr>
                        <td align='center' width='80'><span class='Estilo1'>$row2[cedula]</span></td>
                         <td id='colorBody'>$row2[nombre]</td>
                        <td align='center'><div align='center'><span class='Estilo1'>$row2[nombreCarrera]</span></div></td>
                       </tr>";
            
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
    
    
} else {
    $html = "Lo Sentimos No Se Pudo Realizar la Consulta";
}

ob_start();
$mpdf=new mPDF();
$mpdf->WriteHTML($html);
$mpdf->Output("Reporte_Sinodales_por_Carrera_".$today,'D');

?> 
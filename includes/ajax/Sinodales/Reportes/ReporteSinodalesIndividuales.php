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
            <h1>Sinodales</h1>
                <table border='0' width='700'>
                        <tr>
                                <td id='colorHead'>Nombre:</td>
                                <td id='colorHead'>Carrera:</td>
                                <td id='colorHead'>Fecha Inicio:</td>
                                <td id='colorHead'>FechaFinal:</td>
                        </tr>";
    
    
    $Result = $Obras->ConsultaDatosSinodalesNivelEstudioModalidadpago($fk_nivelestudio, $fk_modalidad, $fk_carreras);
    if ($Result) {
        while($row2 = mysql_fetch_assoc($Result)){
             $html.= "<tr>
                         <td id='colorBody'>$row2[nombre]</td>
                         <td id='colorBody'>$row2[nombreCarrera]</td>
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
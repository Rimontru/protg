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
    $fechaUnoPago = $_GET['fechaUnoPago'];
    $fechaDosPago = $_GET['fechaDosPago'];
    
    
    
//    //convertimos fechas
//    $fechaSQL = explode("-",$rangoFechas);
//    $fechaInicio=trim($fechaSQL[0]);
//    $fechaFin=trim($fechaSQL[1]);
    
$fechaSQL = explode("/",$fechaUnoPago);
$fechaUnoPago=$fechaSQL[2]."-".$fechaSQL[1]."-".$fechaSQL[0];

$fechaS = explode("/",$fechaDosPago);
$fechaDosPago=$fechaS[2]."-".$fechaS[1]."-".$fechaS[0];


//   $Result22 = $Obras->verTrabajadoresDirectoresReportes($fk_carreras);
//    if ($Result22) {
//        $row222 = mysql_fetch_assoc($Result22);
//        $nombreDirector=  ($row222[NombreCompletoDirector]);
//        $carreraReporte=  ($row222[nombreCarrera]);
//     
//        mysql_free_result($Result22);
//    }
    
//  //  01/07/2014 - 31/07/2014
//    $fechaSQL = explode("/",$fechaInicio);
//    $fechaInicio=$fechaSQL[2]."-".$fechaSQL[1]."-".$fechaSQL[0];   
//
//    $fechaSQL = explode("/",$fechaFin);
//    $fechaFin=$fechaSQL[2]."-".$fechaSQL[1]."-".$fechaSQL[0];   

    
     $Result22 = $Obras->ConsultaCarrerasSinodal($fk_carreras);
    if ($Result22) {
        $row222 = mysql_fetch_assoc($Result22);
        $carreraReporte=  ($row222[nombreCarrera]);
     
        mysql_free_result($Result22);
    }
    

    
$html.='
<html>
<head>
<meta charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo1 {font-size: 12px}
-->
</style>
</head>

<body>
<center><table width="100%" height="32" border="
" style="border-collapse: collapse;">
  <tr>
     <td rowspan="6" align="center" width="50" height="28"><div align="center"><img src="../../../../assets/img/IESCH.png" width="100" /></div></td>
     <td align="center" height="28"><div align="center"><strong>INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS</strong></div></td>
     <td rowspan="6" align="center" width="50" height="28"><div align="center"><img src="../../../../assets/img/fimpes.png" width="100"  /></div></td>
  </tr>
  <tr>
     <td align="center" height="20"><div align="center"><strong>INCORPORADO A LA SECRETARIA DE EDUCACION</strong></div></td>
  </tr>
  <tr>
     <td align="center" height="20"><div align="center"><strong>OFICIO No. 0233 DE FECHA 03 DE NOVIEMBRE DE 1983</strong></div></td>
  </tr>
  <tr>
     <td align="center" height="20"><div align="center"><strong>REGIMEN: PARTICULAR CLAVE:07PSU0002D DE EXCELENCIA ACADEMICA: REG.</strong></div></td>
  </tr>
  <tr>
     <td align="center" height="20"><div align="center"><strong>SEP/PSA/2009/030</strong></div></td>
  </tr>
  <tr>
     <td align="center" height="20"><div align="center"><strong>SERVICIOS ESCOLARES</strong></div></td>
  </tr>
  <tr>
     <td align="center" height="50"><div align="center"><strong>&nbsp;</strong></div></td>

  </tr>

</table></center>

<table width="100%" height="88" border="0" style="border-collapse: collapse;">


  ';

    $Result = $Obras->ConReporteSinodalesPago($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fechaUnoPago, $fechaDosPago);
    if ($Result) {
        while($row2 = mysql_fetch_assoc($Result)){

		
            
        if ($row2[fk_carreras] == "12") {
            $precio="$300";
        } else {

           
            //Tesis Profecional
            if ($row[pk_titulacion] == "7") {
                $precio="$300";
            }
            //Curso de Titulacion
            if ($row2[pk_titulacion] == "6") {
                $precio="$400";
            }
            
            //Estudios de Posgrado(50% de maestria)
            if ($row2[pk_titulacion] == "1") {
                $precio="$200";
            }
            //Promedio de calificaciones
             if ($row2[pk_titulacion] == "2") {
                $precio="$200";
            }
            //SUSTENTACION DE EXAMEN POR AREAS DE CONOCIMIENTO
             if ($row2[pk_titulacion] == "3") {
                $precio="$200";
            }
            //SUSTENTACION DE EXAMEN POR AREAS DE CONOCIMIENTO (CENEVAL)
             if ($row2[pk_titulacion] == "4") {
                $precio="$200";
            }
            //ESTUDIO DE POSGRADO (ESPECIALIDAD)
            if ($row2[pk_titulacion] == "5") {
                $precio="$200";
            }
            //EXAMEN COLECTIVO
            if ($row2[pk_titulacion] == "12") {
                $precio="$300";
            }
//MAESTRIA
            if ($fk_nivelestudio == "3") {
                $precio="$250";
            }
		
            
        }
                                $contador2 = $contador2 + 1;

if($row2[pk_sinodal]<="1091" || $row2[pk_sinodal]>="1093" ){      
  
             

            
             $html.="
                     <tr>                        
                        <td colspan='5' align='center'  height='28'><div align='center'><strong>$carreraReporte</strong></div></td>
                    </tr>  
                  <tr>
                        <td align='center' style='border-width: 1px;border: solid;' width=''><span class='Estilo1'><strong>&nbsp;</strong></span></td>
                        <td align='center' style='border-width: 1px;border: solid;'width='300px'><span class='Estilo1'><strong>NOMBRE</strong></span></td>
                        <td align='center' style='border-width: 1px;border: solid;' width='250'><div align='center'><span class='Estilo1'><strong>EXAMEN</strong></span></div></td>
                        <td align='center' style='border-width: 1px;border: solid;' width=''><div align='center'><span class='Estilo1'><strong>FECHA</strong></span></div></td>
                        <td align='center' style='border-width: 1px;border: solid;' width=''><div align='center'><span class='Estilo1'><strong>HORA</strong></span></div></td>
                    </tr>
            
                    <tr> 
                        <td style='border-width: 0px;border: solid;' width=''>&nbsp;</td>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>$row2[NombreCompleto]</span></td>
                        <td align='center' style='border-width: 0px;border: solid;'><span class='Estilo1'>$row2[NombreTitulacion]</span></td>         
                        <td align='center' style='border-width: 0px;border: solid;'><span class='Estilo1'>$row2[FechaTomaProtestareporte]</span></td>
                        <td align='center' style='border-width: 0px;border: solid;' width=''><span class='Estilo1'>$row2[hora]</span></td>
                      </tr>
                    <tr>
                        <td rowspan='4' style='border-width: 0px;border: solid;' width=''>Sinodales</td>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>$row2[NombrePresidente]</span></td>
                        <td align='center'><div align='center'><span class='Estilo1'>$precio</span></div></td>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'></span></td>
                        <td style='border-width: 0px;border: solid;' width=''><span class='Estilo1'></span></td>
                      </tr>
                    <tr>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>$row2[NombreSecretario]</span></td>
                        <td align='center'><div align='center'><span class='Estilo1'>$precio</span></div></td>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'></span></td>
                        <td style='border-width: 0px;border: solid;' width=''><span class='Estilo1'></span></td>
                      </tr>
                    <tr>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>$row2[NombreVocal]</span></td>
                        <td align='center'><div align='center'><span class='Estilo1'>$precio</span></div></td>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'></span></td>
                        <td style='border-width: 0px;border: solid;' width=''><span class='Estilo1'></span></td>
                      </tr>
                    <tr>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>$suplente</span></td>
                        <td align='center'><div align='center'><span class='Estilo1'></span></div></td>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'></span></td>
                        <td style='border-width: 0px;border: solid;' width=''><span class='Estilo1'></span></td>
                      </tr>
                       
                       
                    <tr>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>         
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>
                      </tr>
                       <tr>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>         
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>
                      </tr>
<tr>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>         
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>
                      </tr>

<tr>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>         
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>
                      </tr>

                       <tr>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>         
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>
                      </tr>
<tr>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>         
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>
                      </tr>
<tr>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>         
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>
                      </tr>
<tr>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>         
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>
                        <td style='border-width: 0px;border: solid;'><span class='Estilo1'>&nbsp;</span></td>
                      </tr>";
	}
            
        } //find el while
                      
        mysql_free_result($Result);
         
    }
    

       

        

$html.='</table>
    


</body>
</html>
';
    
    
} else {
    $html = "Lo Sentimos No Se Pudo Realizar la Consulta";
}
//echo $fk_nivelestudio, $fk_modalidad, $fk_carreras,$fechaUnoPago,$fechaDosPago;
$timeo_start = microtime(true);
ini_set("memory_limit","280824M");
ini_set('max_execution_time', 400);
ob_start();
$mpdf=new mPDF('','Letter','',''); 
$mpdf->AddPage('P','','','','','','','','','','');

$mpdf->WriteHTML($html);
$mpdf->Output("Reporte_Sinodales_por_Carrera_".$today,'D');

?> 
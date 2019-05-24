<?php 
require_once("../../../../includes/Config.class.php");  # Cargar datos conexion y otras variables.
require_once('../../../../includes/DB.class.php');
require_once('../../../../includes/ConsultaDB.class.php');
require_once('../../../../mpdf/mpdf.php');
require_once('../../../../includes/MisFunciones.class.php');


require_once ("../../../../includes/jpgraph/src/jpgraph.php");
require_once ("../../../../includes/jpgraph/src/jpgraph_pie.php");
        
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


    if($fk_modalidad=="1"){
    $ModalidadReporte="SEMESTRAL";
         }else  if($fk_modalidad=="2"){
    $ModalidadReporte="CUATRIMESTRAL";
         }else if($fk_modalidad=="3"){
    $ModalidadReporte="TRIMESTRAL";
         }else if($fk_modalidad=="4"){
    $ModalidadReporte="PENTAMESTRAL";
         }

    $Result22 = $Obras->verTrabajadoresDirectoresReportes($fk_carreras);
    if ($Result22) {
        $row222 = mysql_fetch_assoc($Result22);
        $nombreDirector = ($row222[NombreCompletoDirector]);
        $carreraReporte = ($row222[nombreCarrera]);

        mysql_free_result($Result22);
    }

    $Result8 = $Obras->PromedioEgresados($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion);
    if ($Result8) {
        $row8 = mysql_fetch_assoc($Result8);
        $Promedio = $row8['Promedio'];
        $Promedio= number_format($Promedio, 1);
        $generacionLista = $row8['DescripcionGeneracion'];

        mysql_free_result($Result8);
    }


if($opcionGrafica=="1"){


 $Result1 = $Obras->GraficaEgresadosLaborando($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion);
    if ($Result1) {
        $row333 = mysql_fetch_assoc($Result1);

        $CantidadLaborando = $row333['CantidadEgresadosLaborando'];
       
    }

     $Result2 = $Obras->GraficaEgresadosNoLaborando($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion);
    if ($Result2) {
        $row222 = mysql_fetch_assoc($Result2);

        $CantidadNoLaborando = $row222['CantidadEgresadosNoLaborando'];
       
    }



//Operacion para los Porcentajes

    $GranTotal = $CantidadLaborando + $CantidadNoLaborando;
   
    $CantidadLaborandoPorcentaje = $CantidadLaborando/$GranTotal*100;
    $CantidadLaborandoPorcentaje = number_format($CantidadLaborandoPorcentaje,1);

    $CantidadNoLaborandoPorcentaje = $CantidadNoLaborando/$GranTotal*100;
    $CantidadNoLaborandoPorcentaje = number_format($CantidadNoLaborandoPorcentaje,1);

    $GranTotalPorcentaje=$CantidadLaborandoPorcentaje+$CantidadNoLaborandoPorcentaje;

$html3 = '
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reporte Grafica</title>
<style type="text/css">
<!--
.cuadrado {
     width: 10px; 
     height: 5px; 
     background:;
}
.Estilo1{
	font-family:arial;
	font size:14px;
	}
.Estilo2 {  
  font-family:arial;
  font-size: 14px;
}
.footer{
  display:block;
}
#contenedor {
  width: 75%;
  height: 650;
  border: 0px solid blue;
  margin: 0 auto;
  padding:0px;
 }

 .costado {
  margin: 0px;
  padding: 0px;
  width: auto;
height:100px;
  font-family: Arial;
    border: 0px solid blue;

}

#derecha {
  height: auto;
  width: auto;
  float: right;
    border: 0px solid blue;

 
}

.post img {
     border: 0px;
}

.grafica{
  float:left;
}

td{
margin: 2px;
  padding: 2px;
}

caption{
  background-color: #CECE; margin: 5px; padding: 5px; 
}
-->
</style>
</head>

<body>

<div id = "contenedor">

  </br></br></br>
  <table width="100%" height="" border="0" align="center" style="border-collapse: collapse;"  cellSpacing="0" cellPadding="0" >
    <tr>
          <td colspan="0" rowspan="5" width="100" class="Estilo1" align="center"><img src="../../../../assets/img/IESCH.png" width="90" height="90" /></td>
          
      <td colspan="8" width="400" class="Estilo1" align="center"><strong>INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS EN TUXTLA GUTIÉRREZ, S.C.</strong></td>
      
      <td colspan="0" rowspan="5" width="100" class="Estilo1" align="center"><img src="../../../../assets/img/fimpes.png" width="100  " height="100" />
    </tr>
    
    <tr><td colspan="8" class="Estilo1" align="center"><strong>INCORPORADO A LA SECRETARIA DE EDUCACIÓN</strong></td>
      </tr>
    
    <tr>
        <td colspan="8" class="Estilo1" align="center"><strong>OFICIO No. 0233 DE FECHA 03 DE NOVIEMBRE DE 1983</strong></td>
     </tr>
     
     <tr> 
      <td colspan="8" class="Estilo1" align="center"><strong>RÉGIMEN: PARTICULAR CLAVE: 07PSU0002D</strong></td>
      </tr>
      
      <tr>
      <td colspan="8" class="Estilo1" align="center"><strong>EXCELENCIA ACADÉMICA: REG. SEP/PSA/2009/030</strong></td>
      </tr>
      
        <tr><td colspan="10" class="Estilo1" align="center">&nbsp;</td></tr>
        <tr><td colspan="10" class="Estilo2" align="center"><strong>CARRERA: '.$carreraReporte.'</strong></td></tr>
        <tr><td colspan="10" class="Estilo2" align="center"><strong>MODALIDAD: '.$ModalidadReporte.'</strong></td></tr>
        <tr><td colspan="10" class="Estilo2" align="center"><strong>GENERACIÓN: '.$generacionLista.'</strong></td></tr>
    

    </table>
  <br>
  <div id="derecha">
   <img style="border:0px solid red;" src="Graficas/GraficaEgresadosLaboral.php?fk_nivelestudio='.$fk_nivelestudio.'&fk_modalidad='.$fk_modalidad.'&fk_carreras='.$fk_carreras.'&fk_generacion='.$fk_generacion.'"  />
  </div>

  <div class="costado">
    <table  border=1 width"" height:50  style="border-collapse: collapse; font-size:12px;">
      <caption class="Estilo1"><strong>¿Trabaja actualmente?</strong></caption>
      <thead>
        <tr align="center">
          <td width="" >&nbsp;</td>
          <td width="90" style="background:green; color:white;">Alumnos</td>
          <td width="90" style="background:green; color:white;">Porcentaje</td>
        </tr>
      </thead>
      <tbody>
        <tr align="center" style="border-top:1px solid black; "  >
          <td width="">Si</td>
          <td width="">'.$CantidadLaborando.'</td>
          <td width="">'.$CantidadLaborandoPorcentaje.'%</td> 
          <td class="cuadrado" width="" bgcolor="#FF0000"  ></td> 
        </tr>
        <tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:white;" >
          <td width="">No</td> 
          <td width="">'.$CantidadNoLaborando.'</td>
          <td width="">'.$CantidadNoLaborandoPorcentaje.'%</td> 
          <td class="cuadrado" width="" bgcolor="#00FF49"></td> 

        </tr>
       
        <tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:green; color:white;" >
          <td width=""><strong>TOTAL</strong></td> 
          <td width=""><strong>'.$GranTotal.'</strong></td>
          <td width=""><strong>'.$GranTotalPorcentaje.'%</strong></td>
 
        </tr>
      </tbody>
    </table>
  </div>

<div style="clear: both"></div>     
<P>&nbsp;</P>

<footer style="text-align: center; FONT-FAMILY:ARIAL;">
      <p><STRONG>FUENTE: DEPARTAMENTO DE SEGUIMIENTO DE EGRESADOS</STRONG></p>
</footer>
</div>

</body>
</html>';
       fwrite($f, $grafica);
      fputs($f, "");
      fclose($f);

      $res =$html3;

  echo $res;

}


if($opcionGrafica=="2")
{


    $Result8 = $Obras->ConCantidadEgresados($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion);
    if ($Result8) {
        $row8 = mysql_fetch_assoc($Result8);
        $CantidadEgresadosTotal = $row8['cantidadTotalEgresados'];

        mysql_free_result($Result8);
    }


       

  $CantidadAlumnosEgresadosGraficaIngresoActual=$Obras->CantidadAlumnosEgresadosGraficaIngresoActual($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion);

    if ($CantidadAlumnosEgresadosGraficaIngresoActual) {
        while ($row = mysql_fetch_assoc($CantidadAlumnosEgresadosGraficaIngresoActual)) {
            
            
    //Ingreso Actual 
	

    
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

    $unoPorcentaje=$uno/$cantidadEncuestados*100;    
	$unoPorcentaje = number_format($unoPorcentaje,1);

    $dosPorcentaje=$dos/$cantidadEncuestados*100;
	$dosPorcentaje = number_format($dosPorcentaje,1);

    $tresPorcentaje=$tres/$cantidadEncuestados*100;
	$tresPorcentaje = number_format($tresPorcentaje,1);

    $cuatroPorcentaje=$cuatro/$cantidadEncuestados*100;
	$cuatroPorcentaje = number_format($cuatroPorcentaje,1);

    $cincoPorcentaje=$cinco/$cantidadEncuestados*100;
	$cincoPorcentaje = number_format($cincoPorcentaje,1);
	
    $seisPorcentaje=$seis/$cantidadEncuestados*100;
	$seisPorcentaje = number_format($seisPorcentaje,1);
	
    $sietePorcentaje=$siete/$cantidadEncuestados*100;
	$sietePorcentaje = number_format($sietePorcentaje,1);


    

$TotalPorcentaje=$cantidadEncuestados/$cantidadEncuestados*100;

   
        }
        mysql_free_result($CantidadAlumnosEgresadosGraficaIngresoActual);
    }   

if($uno==""){
	$uno=0;
	}


if($dos==""){
	$dos=0;
	}


if($tres==""){
	$tres=0;
	}


if($cuatro==""){
	$cuatro=0;
	}


if($cinco==""){
	$cinco=0;
	}


if($seis==""){
	$seis=0;
	}


if($siete==""){
	$siete=0;
	}



$html3 = '
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reporte Grafica</title>
<style type="text/css">
<!--
.cuadrado {
     width: 10px; 
     height: 5px; 
     background:;
}
.Estilo1{
  font-family:arial;
  font size:14px;
  }
.Estilo2 {  
  font-family:arial;
  font-size: 14px;
}
.footer{
  display:block;
}
#contenedor {
  width: 75%;
  height: 650;
  border: 0px solid blue;
  margin: 0 auto;
  padding:0px;
 }

 .costado {
  margin: 0px;
  padding: 0px;
  width: auto;
  font-family: Arial;
    border: 0px solid blue;

}

#derecha {
  height: auto;
  width: auto;
  float: right;
    border: 0px solid blue;

 
}

.post img {
     border: 0px;
}

.grafica{
  float:left;
}

td{
margin: 2px;
  padding: 2px;
}

caption{
  background-color: #CECE; margin: 5px; padding: 5px; 
}
-->
</style>
</head>

<body>

<div id = "contenedor">

  </br></br></br>
  <table width="100%" height="" border="0" align="center" style="border-collapse: collapse;"  cellSpacing="0" cellPadding="0" >
    <tr>
          <td colspan="0" rowspan="5" width="100" class="Estilo1" align="center"><img src="../../../../assets/img/IESCH.png" width="90" height="90" /></td>
          
      <td colspan="8" width="400" class="Estilo1" align="center"><strong>INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS EN TUXTLA GUTIÉRREZ, S.C.</strong></td>
      
      <td colspan="0" rowspan="5" width="100" class="Estilo1" align="center"><img src="../../../../assets/img/fimpes.png" width="100  " height="100" />
    </tr>
    
    <tr><td colspan="8" class="Estilo1" align="center"><strong>INCORPORADO A LA SECRETARIA DE EDUCACIÓN</strong></td>
      </tr>
    
    <tr>
        <td colspan="8" class="Estilo1" align="center"><strong>OFICIO No. 0233 DE FECHA 03 DE NOVIEMBRE DE 1983</strong></td>
     </tr>
     
     <tr> 
      <td colspan="8" class="Estilo1" align="center"><strong>RÉGIMEN: PARTICULAR CLAVE: 07PSU0002D</strong></td>
      </tr>
      
      <tr>
      <td colspan="8" class="Estilo1" align="center"><strong>EXCELENCIA ACADÉMICA: REG. SEP/PSA/2009/030</strong></td>
      </tr>
      
        <tr><td colspan="10" class="Estilo1" align="center">&nbsp;</td></tr>
        <tr><td colspan="10" class="Estilo2" align="center"><strong>CARRERA: '.$carreraReporte.'</strong></td></tr>
        <tr><td colspan="10" class="Estilo2" align="center"><strong>MODALIDAD: '.$ModalidadReporte.'</strong></td></tr>
        <tr><td colspan="10" class="Estilo2" align="center"><strong>GENERACIÓN: '.$generacionLista.'</strong></td></tr>
    

    </table>
  <br>
  <div id="derecha">
   <img style="border:0px solid red;" src="Graficas/GraficaEgresadosIngreso.php?fk_nivelestudio='.$fk_nivelestudio.'&fk_modalidad='.$fk_modalidad.'&fk_carreras='.$fk_carreras.'&fk_generacion='.$fk_generacion.'"  />
  </div>

  <div class="costado">
    <table  border=1 width""   style="border-collapse: collapse; font-size:12px;">
      <caption class="Estilo1"><strong>Ingreso Actual</strong></caption>
      <thead>
        <tr>
          <th width="80">&nbsp;</th>
          <th style="background:green; color:white;">Alumnos</th>
          <th style="background:green; color:white;">Porcentaje</th>
        </tr>
      </thead>
      <tbody>
        <tr align="center" style="border-top:1px solid black; "  >
          <td width="140">MENOS DE $3,000</td>
          <td width="80">'.$uno.'</td>
          <td width="80">'.$unoPorcentaje.'%</td> 
          <td class="cuadrado" width="" bgcolor="#FF0000"  ></td> 

        </tr>
        <tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:white;" >
          <td width="80">DE $3,001 A $6,000</td> 
          <td width="90">'.$dos.'</td>
          <td width="90">'.$dosPorcentaje.'%</td> 
          <td class="cuadrado" width="" bgcolor="#00FF49"></td> 

        </tr>
        <tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:white;" >
          <td width="80">DE $6,001 A $9,000</td> 
          <td width="90">'.$tres.'</td>
          <td width="90">'.$tresPorcentaje.'%</td> 
          <td class="cuadrado" width="" bgcolor="#002FFF"></td> 
	
        </tr>
        <tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:white;" >
          <td width="80">DE $9,001 A $12,000</td> 
          <td width="90">'.$cuatro.'</td>
          <td width="90">'.$cuatroPorcentaje.'%</td> 
          <td class="cuadrado" width="" bgcolor="#00FFF7"></td> 

        </tr>
        <tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:white;" >
          <td width="80">DE $12,001 A $15,000</td> 
          <td width="90">'.$cinco.'</td>
          <td width="90">'.$cincoPorcentaje.'%</td> 
          <td class="cuadrado" width="" bgcolor="#FF00FC"></td> 

        </tr>
        <tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:white;" >
          <td width="80">MAS DE $ 15,001</td> 
          <td width="90">'.$seis.'</td>
          <td width="90">'.$seisPorcentaje.'%</td> 
          <td class="cuadrado" width="" bgcolor="#FCFF00"></td> 

        </tr>
        <tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:white;" >
          <td width="80">NINGUNO</td> 
          <td width="90">'.$siete.'</td>
          <td width="90">'.$sietePorcentaje.'%</td>
          <td class="cuadrado" width="" bgcolor="#FFAF00"></td> 
 
        </tr>
        
        <tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:green; color:white;" >
          <td width="80"><strong>TOTAL</strong></td> 
          <td width="90"><strong>'.$cantidadEncuestados.'</strong></td>
          <td width="90"><strong>'.$TotalPorcentaje.'%</strong></td> 
        </tr>
      </tbody>
    </table>
  </div>

<div style="clear: both"></div>     
<P>&nbsp;</P>

<footer style="text-align: center; FONT-FAMILY:ARIAL;">
      <p><STRONG>FUENTE: DEPARTAMENTO DE SEGUIMIENTO DE EGRESADOS</STRONG></p>
</footer>
</div>

</body>
</html>';
       fwrite($f, $grafica);
      fputs($f, "");
      fclose($f);

      $res =$html3;

  echo $res;

}

if($opcionGrafica=="3")
{


    $Result8 = $Obras->ConCantidadEgresados($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion);
    if ($Result8) {
        $row8 = mysql_fetch_assoc($Result8);
        $CantidadEgresadosTotal = $row8['cantidadTotalEgresados'];

        mysql_free_result($Result8);
    }


       

	
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
    
    if(trim($row['descripcion_tiempo'])=="De 6 meses a 1 año"){
        $tres=$row['cantidad'];
    }
    
    if(trim($row['descripcion_tiempo'])=="De 1 a 2 años"){
        $cuatro=$row['cantidad'];
    }
    
    if(trim($row['descripcion_tiempo'])=="De 2 años o más"){
        $cinco=$row['cantidad'];
    }
    

   $cantidadEncuestados=$uno+$dos+$tres+$cuatro+$cinco;

    $unoPorcentaje=$uno/$cantidadEncuestados*100;
	$unoPorcentaje = number_format($unoPorcentaje,1);

    $dosPorcentaje=$dos/$cantidadEncuestados*100;
	$dosPorcentaje = number_format($dosPorcentaje,1);

    $tresPorcentaje=$tres/$cantidadEncuestados*100;
	$tresPorcentaje = number_format($tresPorcentaje,1);

    $cuatroPorcentaje=$cuatro/$cantidadEncuestados*100;
	$cuatroPorcentaje = number_format($cuatroPorcentaje,1);

    $cincoPorcentaje=$cinco/$cantidadEncuestados*100;
	$cincoPorcentaje = number_format($cincoPorcentaje,1);


    

$TotalPorcentaje=$cantidadEncuestados/$cantidadEncuestados*100;

   
        }
        mysql_free_result($EgresadosGraficaIngresoActual);
    }   

if($uno==""){
	$uno=0;
	}


if($dos==""){
	$dos=0;
	}


if($tres==""){
	$tres=0;
	}


if($cuatro==""){
	$cuatro=0;
	}


if($cinco==""){
	$cinco=0;
	}


if($seis==""){
	$seis=0;
	}


if($siete==""){
	$siete=0;
	}



$html3 = '
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reporte Grafica</title>
<style type="text/css">
<!--
.cuadrado {
     width: 10px; 
     height: 5px; 
     background:;
}
.Estilo1{
  font-family:arial;
  font size:14px;
  }
.Estilo2 {  
  font-family:arial;
  font-size: 14px;
}
.footer{
  display:block;
}
#contenedor {
  width: 75%;
  height: 650;
  border: 0px solid blue;
  margin: 0 auto;
  padding:0px;
 }

 .costado {
  margin: 0px;
  padding: 0px;
  width: auto;
  font-family: Arial;
    border: 0px solid blue;

}

#derecha {
  height: auto;
  width: auto;
  float: right;
    border: 0px solid blue;

 
}

.post img {
     border: 0px;
}

.grafica{
  float:left;
}

td{
margin: 2px;
  padding: 2px;
}

caption{
  background-color: #CECE; margin: 5px; padding: 5px; 
}
-->
</style>
</head>

<body>

<div id = "contenedor">

  </br></br></br>
  <table width="100%" height="" border="0" align="center" style="border-collapse: collapse;"  cellSpacing="0" cellPadding="0" >
    <tr>
          <td colspan="0" rowspan="5" width="100" class="Estilo1" align="center"><img src="../../../../assets/img/IESCH.png" width="90" height="90" /></td>
          
      <td colspan="8" width="400" class="Estilo1" align="center"><strong>INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS EN TUXTLA GUTIÉRREZ, S.C.</strong></td>
      
      <td colspan="0" rowspan="5" width="100" class="Estilo1" align="center"><img src="../../../../assets/img/fimpes.png" width="100  " height="100" />
    </tr>
    
    <tr><td colspan="8" class="Estilo1" align="center"><strong>INCORPORADO A LA SECRETARIA DE EDUCACIÓN</strong></td>
      </tr>
    
    <tr>
        <td colspan="8" class="Estilo1" align="center"><strong>OFICIO No. 0233 DE FECHA 03 DE NOVIEMBRE DE 1983</strong></td>
     </tr>
     
     <tr> 
      <td colspan="8" class="Estilo1" align="center"><strong>RÉGIMEN: PARTICULAR CLAVE: 07PSU0002D</strong></td>
      </tr>
      
      <tr>
      <td colspan="8" class="Estilo1" align="center"><strong>EXCELENCIA ACADÉMICA: REG. SEP/PSA/2009/030</strong></td>
      </tr>
      
        <tr><td colspan="10" class="Estilo1" align="center">&nbsp;</td></tr>
        <tr><td colspan="10" class="Estilo2" align="center"><strong>CARRERA: '.$carreraReporte.'</strong></td></tr>
        <tr><td colspan="10" class="Estilo2" align="center"><strong>MODALIDAD: '.$ModalidadReporte.'</strong></td></tr>
        <tr><td colspan="10" class="Estilo2" align="center"><strong>GENERACIÓN: '.$generacionLista.'</strong></td></tr>
    

    </table>
  <br>
  <div id="derecha">
   <img style="border:0px solid red;" src="Graficas/GraficaEgresadosTiempo.php?fk_nivelestudio='.$fk_nivelestudio.'&fk_modalidad='.$fk_modalidad.'&fk_carreras='.$fk_carreras.'&fk_generacion='.$fk_generacion.'"  />
  </div>

  <div class="costado">
    <table  border=1 width""   style="border-collapse: collapse; font-size:12px;">
      <caption class="Estilo1"><strong>¿Qué tiempo tardó en conseguir empleo?</strong></caption>
      <thead>
        <tr>
          <th width="80">&nbsp;</th>
          <th style="background:green; color:white;">Alumnos</th>
          <th style="background:green; color:white;">Porcentaje</th>
        </tr>
      </thead>
      <tbody>
        <tr align="center" style="border-top:1px solid black; "  >
          <td width="140">De 1 a 3 meses</td>
          <td width="80">'.$uno.'</td>
          <td width="80">'.$unoPorcentaje.'%</td> 
          <td class="cuadrado" width="" bgcolor="#FF0000"  ></td> 

        </tr>
        <tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:white;" >
          <td width="80">De 3 a 6 meses</td> 
          <td width="90">'.$dos.'</td>
          <td width="90">'.$dosPorcentaje.'%</td> 
          <td class="cuadrado" width="" bgcolor="#00FF49"></td> 

        </tr>
        <tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:white;" >
          <td width="80">De 6 meses a 1 año</td> 
          <td width="90">'.$tres.'</td>
          <td width="90">'.$tresPorcentaje.'%</td> 
          <td class="cuadrado" width="" bgcolor="#002FFF"></td> 

        </tr>
        <tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:white;" >
          <td width="80">De 1 a 2 años</td> 
          <td width="90">'.$cuatro.'</td>
          <td width="90">'.$cuatroPorcentaje.'%</td> 
          <td class="cuadrado" width="" bgcolor="#00FFF7"></td> 

        </tr>
        <tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:white;" >
          <td width="80">De 2 años o más</td> 
          <td width="90">'.$cinco.'</td>
          <td width="90">'.$cincoPorcentaje.'%</td> 
          <td class="cuadrado" width="" bgcolor="#FF00FC"></td> 

        </tr>
       
        <tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:green; color:white;" >
          <td width="80"><strong>TOTAL</strong></td> 
          <td width="90"><strong>'.$cantidadEncuestados.'</strong></td>
          <td width="90"><strong>'.$TotalPorcentaje.'%</strong></td> 
        </tr>
      </tbody>
    </table>
  </div>

<div style="clear: both"></div>     
<P>&nbsp;</P>

<footer style="text-align: center; FONT-FAMILY:ARIAL;">
      <p><STRONG>FUENTE: DEPARTAMENTO DE SEGUIMIENTO DE EGRESADOS</STRONG></p>
</footer>
</div>

</body>
</html>';
       fwrite($f, $grafica);
      fputs($f, "");
      fclose($f);

      $res =$html3;

  echo $res;

}


if($opcionGrafica=="4")
{


    $Result8 = $Obras->ConCantidadEgresados($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion);
    if ($Result8) {
        $row8 = mysql_fetch_assoc($Result8);
        $CantidadEgresadosTotal = $row8['cantidadTotalEgresados'];

        mysql_free_result($Result8);
    }


       

	
    $CantidadAlumnosEgresadosGraficaPlan=$Obras->CantidadAlumnosEgresadosGraficaPlan($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion);

    if ($CantidadAlumnosEgresadosGraficaPlan) {
        while ($row = mysql_fetch_assoc($CantidadAlumnosEgresadosGraficaPlan)) {
           
            
    //Tiempo en encontrar empleo

    
     if(trim($row['plandeestudioscalificacion'])=="EXCELENTE"){
        $uno=$row['cantidad'];
    }		
	
    if(trim($row['plandeestudioscalificacion'])=="BUENO"){
        $dos=$row['cantidad'];
	}
    
    if(trim($row['plandeestudioscalificacion'])=="REGULAR"){
        $tres=$row['cantidad'];
    }
    
    if(trim($row['plandeestudioscalificacion'])=="MALO"){
        $cuatro=$row['cantidad'];
    }
    
    


   $cantidadEncuestados=$uno+$dos+$tres+$cuatro;

    $unoPorcentaje=$uno/$cantidadEncuestados*100;
	$unoPorcentaje = number_format($unoPorcentaje,1);
	
    $dosPorcentaje=$dos/$cantidadEncuestados*100;
	$dosPorcentaje = number_format($dosPorcentaje,1);

    $tresPorcentaje=$tres/$cantidadEncuestados*100;
	$tresPorcentaje = number_format($tresPorcentaje,1);

    $cuatroPorcentaje=$cuatro/$cantidadEncuestados*100;
	$cuatroPorcentaje = number_format($cuatroPorcentaje,1);


    

$TotalPorcentaje=$cantidadEncuestados/$cantidadEncuestados*100;

   
        }
        mysql_free_result($CantidadAlumnosEgresadosGraficaPlan);
    }   

if($uno==""){
	$uno=0;
	}


if($dos==""){
	$dos=0;
	}


if($tres==""){
	$tres=0;
	}


if($cuatro==""){
	$cuatro=0;
	}


if($cinco==""){
	$cinco=0;
	}


if($seis==""){
	$seis=0;
	}


if($siete==""){
	$siete=0;
	}



$html3 = '
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reporte Grafica</title>
<style type="text/css">
<!--

.Estilo1{
  font-family:arial;
  font size:14px;
  }
.Estilo2 {  
  font-family:arial;
  font-size: 14px;
}
.footer{
  display:block;
}
#contenedor {
  width: 75%;
  height: 650;
  border: 0px solid blue;
  margin: 0 auto;
  padding:0px;
 }

 .costado {
  margin: 0px;
  padding: 0px;
  width: auto;
  font-family: Arial;
    border: 0px solid blue;

}

#derecha {
  height: auto;
  width: auto;
  float: right;
    border: 0px solid blue;

 
}

.post img {
     border: 0px;
}

.grafica{
  float:left;
}

td{
margin: 2px;
  padding: 2px;
}

caption{
  background-color: #CECE; margin: 5px; padding: 5px; 
}

.cuadrado {
     width: 10px; 
     height: 5px; 
     background:;
}
-->
</style>
</head>

<body>

<div id = "contenedor">

  </br></br></br>
  <table width="100%" height="" border="0" align="center" style="border-collapse: collapse;"  cellSpacing="0" cellPadding="0" >
    <tr>
          <td colspan="0" rowspan="5" width="100" class="Estilo1" align="center"><img src="../../../../assets/img/IESCH.png" width="90" height="90" /></td>
          
      <td colspan="8" width="400" class="Estilo1" align="center"><strong>INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS EN TUXTLA GUTIÉRREZ, S.C.</strong></td>
      
      <td colspan="0" rowspan="5" width="100" class="Estilo1" align="center"><img src="../../../../assets/img/fimpes.png" width="100  " height="100" />
    </tr>
    
    <tr><td colspan="8" class="Estilo1" align="center"><strong>INCORPORADO A LA SECRETARIA DE EDUCACIÓN</strong></td>
      </tr>
    
    <tr>
        <td colspan="8" class="Estilo1" align="center"><strong>OFICIO No. 0233 DE FECHA 03 DE NOVIEMBRE DE 1983</strong></td>
     </tr>
     
     <tr> 
      <td colspan="8" class="Estilo1" align="center"><strong>RÉGIMEN: PARTICULAR CLAVE: 07PSU0002D</strong></td>
      </tr>
      
      <tr>
      <td colspan="8" class="Estilo1" align="center"><strong>EXCELENCIA ACADÉMICA: REG. SEP/PSA/2009/030</strong></td>
      </tr>
      
        <tr><td colspan="10" class="Estilo1" align="center">&nbsp;</td></tr>
        <tr><td colspan="10" class="Estilo2" align="center"><strong>CARRERA: '.$carreraReporte.'</strong></td></tr>
        <tr><td colspan="10" class="Estilo2" align="center"><strong>MODALIDAD: '.$ModalidadReporte.'</strong></td></tr>
        <tr><td colspan="10" class="Estilo2" align="center"><strong>GENERACIÓN: '.$generacionLista.'</strong></td></tr>
    

    </table>
  <br>
  <div id="derecha">
   <img style="border:0px solid red;" src="Graficas/GraficaEgresadosPlandeEstudios.php?fk_nivelestudio='.$fk_nivelestudio.'&fk_modalidad='.$fk_modalidad.'&fk_carreras='.$fk_carreras.'&fk_generacion='.$fk_generacion.'"  />
  </div>

  <div class="costado">
    <table  border=1 width""   style="border-collapse: collapse; font-size:12px;">
      <caption class="Estilo1"><strong>¿Qué le parecio el plan y programa de estudios?</strong></caption>
      <thead>
        <tr>
          <th width="80">&nbsp;</th>
          <th style="background:green; color:white;">Alumnos</th>
          <th style="background:green; color:white;">Porcentaje</th>
        </tr>
      </thead>
      <tbody>
        <tr align="center" style="border-top:1px solid black; "  >
          <td width="140">EXCELENTE</td>
          <td width="80">'.$uno.'</td>
          <td width="80">'.$unoPorcentaje.'%</td> 
          <td class="cuadrado" width="" bgcolor="#FF0000"  ></td> 

        </tr>
        <tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:white;" >
          <td width="80">BUENO</td> 
          <td width="90">'.$dos.'</td>
          <td width="90">'.$dosPorcentaje.'%</td> 
          <td class="cuadrado" width="" bgcolor="#00FF49"></td> 

        </tr>
        <tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:white;" >
          <td width="80">REGULAR</td> 
          <td width="90">'.$tres.'</td>
          <td width="90">'.$tresPorcentaje.'%</td> 
          <td class="cuadrado" width="" bgcolor="#002FFF"></td> 

        </tr>
        <tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:white;" >
          <td width="80">MALO</td> 
          <td width="90">'.$cuatro.'</td>
          <td width="90">'.$cuatroPorcentaje.'%</td> 
          <td class="cuadrado" width="" bgcolor="#00FFF7"></td> 

        </tr>

       
        <tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:green; color:white;" >
          <td width="80"><strong>TOTAL</strong></td> 
          <td width="90"><strong>'.$cantidadEncuestados.'</strong></td>
          <td width="90"><strong>'.$TotalPorcentaje.'%</strong></td> 
        </tr>
      </tbody>
    </table>
  </div>

<div style="clear: both"></div>     
<P>&nbsp;</P>

<footer style="text-align: center; FONT-FAMILY:ARIAL;">
      <p><STRONG>FUENTE: DEPARTAMENTO DE SEGUIMIENTO DE EGRESADOS</STRONG></p>
</footer>
</div>

</body>
</html>';
       fwrite($f, $grafica);
      fputs($f, "");
      fclose($f);

      $res =$html3;

  echo $res;

}



if($opcionGrafica=="5")
{


    $Result8 = $Obras->ConCantidadEgresados($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion);
    if ($Result8) {
        $row8 = mysql_fetch_assoc($Result8);
        $CantidadEgresadosTotal = $row8['cantidadTotalEgresados'];

        mysql_free_result($Result8);
    }


       

	
    $CantidadAlumnosEgresadosGraficaGradodeSatisfaccion=$Obras->CantidadAlumnosEgresadosGraficaGradodeSatisfaccion($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion);

    if ($CantidadAlumnosEgresadosGraficaGradodeSatisfaccion) {
        while ($row = mysql_fetch_assoc($CantidadAlumnosEgresadosGraficaGradodeSatisfaccion)) {
           
            
    //Tiempo en encontrar empleo

    
    if(trim($row['descripcion_gradosatisfaccion'])=="1"){
        $uno=$row['cantidad'];
    }		
	
    if(trim($row['descripcion_gradosatisfaccion'])=="2"){
        $dos=$row['cantidad'];
	}
    
    if(trim($row['descripcion_gradosatisfaccion'])=="3"){
        $tres=$row['cantidad'];
    }
    
    if(trim($row['descripcion_gradosatisfaccion'])=="4"){
        $cuatro=$row['cantidad'];
    }
	if(trim($row['descripcion_gradosatisfaccion'])=="5"){
        $cinco=$row['cantidad'];
    }		
	
    if(trim($row['descripcion_gradosatisfaccion'])=="6"){
        $seis=$row['cantidad'];
	}
    
    if(trim($row['descripcion_gradosatisfaccion'])=="7"){
        $siete=$row['cantidad'];
    }
    
    if(trim($row['descripcion_gradosatisfaccion'])=="8"){
        $ocho=$row['cantidad'];
    }
	
	if(trim($row['descripcion_gradosatisfaccion'])=="9"){
        $nueve=$row['cantidad'];
    }
    
	if(trim($row['descripcion_gradosatisfaccion'])=="10"){
        $diez=$row['cantidad'];
    }
    
    


   $cantidadEncuestados=$uno+$dos+$tres+$cuatro+$cinco+$seis+$siete+$ocho+$nueve+$diez;

    $unoPorcentaje=$uno/$cantidadEncuestados*100;
	$unoPorcentaje = number_format($unoPorcentaje,1);
	
    $dosPorcentaje=$dos/$cantidadEncuestados*100;
	$dosPorcentaje = number_format($dosPorcentaje,1);

    $tresPorcentaje=$tres/$cantidadEncuestados*100;
	$tresPorcentaje = number_format($tresPorcentaje,1);

    $cuatroPorcentaje=$cuatro/$cantidadEncuestados*100;
	$cuatroPorcentaje = number_format($cuatroPorcentaje,1);

    $cincoPorcentaje=$cinco/$cantidadEncuestados*100;
	$cincoPorcentaje = number_format($cincoPorcentaje,1);

    $seisPorcentaje=$seis/$cantidadEncuestados*100;
	$seisPorcentaje = number_format($seisPorcentaje,1);

    $sietePorcentaje=$siete/$cantidadEncuestados*100;
	$sietePorcentaje = number_format($sietePorcentaje,1);

    $ochoPorcentaje=$ocho/$cantidadEncuestados*100;
	$ochoPorcentaje = number_format($ochoPorcentaje,1);

    $nuevePorcentaje=$nueve/$cantidadEncuestados*100;
	$nuevePorcentaje = number_format($nuevePorcentaje,1);

    $diezPorcentaje=$diez/$cantidadEncuestados*100;
	$diezPorcentaje = number_format($diezPorcentaje,1);



    

$TotalPorcentaje=$cantidadEncuestados/$cantidadEncuestados*100;

   
        }
        mysql_free_result($CantidadAlumnosEgresadosGraficaGradodeSatisfaccion);
    }   


if($uno==""){
	$uno=0;
	}


if($dos==""){
	$dos=0;
	}


if($tres==""){
	$tres=0;
	}


if($cuatro==""){
	$cuatro=0;
	}


if($cinco==""){
	$cinco=0;
	}


if($seis==""){
	$seis=0;
	}


if($siete==""){
	$siete=0;
	}

if($ocho==""){
	$ocho=0;
	}
	
	if($nueve==""){
	$nueve=0;
	}
	
	if($diez==""){
	$diez=0;
	}


$unoPromedio = 1 * $uno;
$dosPromedio = 2 * $dos;
$tresPromedio= 3 * $tres;
$cuatroPromedio = 4 * $cuatro;
$cincoPromedio = 5 * $cinco;
$seisPromedio = 6 * $seis;
$sietePromedio = 7 * $siete;
$ochoPromedio = 8 * $ocho;
$nuevePromedio = 9 * $nueve;
$diezPromedio = 10 * $diez;


$TotalPromedio = $unoPromedio+$dosPromedio+$tresPromedio+$cuatroPromedio+$cincoPromedio+$seisPromedio+$sietePromedio+$ochoPromedio+$nuevePromedio+$diezPromedio;

$promedioReal = $TotalPromedio/$cantidadEncuestados;
$promedioReal= number_format($promedioReal,1);



$html3 = '
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reporte Grafica</title>
<style type="text/css">
<!--

.Estilo1{
  font-family:arial;
  font size:14px;
  }
.Estilo2 {  
  font-family:arial;
  font-size: 14px;
}
.footer{
  display:block;
}
#contenedor {
  width: 75%;
  height: 650;
  border: 0px solid blue;
  margin: 0 auto;
  padding:0px;
 }

 .costado {
  margin: 0px;
  padding: 0px;
  width: auto;
  font-family: Arial;
    border: 0px solid blue;

}

#derecha {
  height: auto;
  width: auto;
  float: right;
    border: 0px solid blue;

 
}

.post img {
     border: 0px;
}

.grafica{
  float:left;
}

td{
margin: 2px;
  padding: 2px;
}

caption{
  background-color: #CECE; margin: 5px; padding: 5px; 
}

.cuadrado {
     width: 10px; 
     height: 5px; 
     background:;
}
-->
</style>
</head>

<body>

<div id = "contenedor">

  </br></br></br>
  <table width="100%" height="" border="0" align="center" style="border-collapse: collapse;"  cellSpacing="0" cellPadding="0" >
    <tr>
          <td colspan="0" rowspan="5" width="100" class="Estilo1" align="center"><img src="../../../../assets/img/IESCH.png" width="90" height="90" /></td>
          
      <td colspan="8" width="400" class="Estilo1" align="center"><strong>INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS EN TUXTLA GUTIÉRREZ, S.C.</strong></td>
      
      <td colspan="0" rowspan="5" width="100" class="Estilo1" align="center"><img src="../../../../assets/img/fimpes.png" width="100  " height="100" />
    </tr>
    
    <tr><td colspan="8" class="Estilo1" align="center"><strong>INCORPORADO A LA SECRETARIA DE EDUCACIÓN</strong></td>
      </tr>
    
    <tr>
        <td colspan="8" class="Estilo1" align="center"><strong>OFICIO No. 0233 DE FECHA 03 DE NOVIEMBRE DE 1983</strong></td>
     </tr>
     
     <tr> 
      <td colspan="8" class="Estilo1" align="center"><strong>RÉGIMEN: PARTICULAR CLAVE: 07PSU0002D</strong></td>
      </tr>
      
      <tr>
      <td colspan="8" class="Estilo1" align="center"><strong>EXCELENCIA ACADÉMICA: REG. SEP/PSA/2009/030</strong></td>
      </tr>
      
        <tr><td colspan="10" class="Estilo1" align="center">&nbsp;</td></tr>
        <tr><td colspan="10" class="Estilo2" align="center"><strong>CARRERA: '.$carreraReporte.'</strong></td></tr>
        <tr><td colspan="10" class="Estilo2" align="center"><strong>MODALIDAD: '.$ModalidadReporte.'</strong></td></tr>
        <tr><td colspan="10" class="Estilo2" align="center"><strong>GENERACIÓN: '.$generacionLista.'</strong></td></tr>
    

    </table>
  <br>
  <div id="derecha">
   <img style="border:0px solid red;" src="Graficas/GraficaEgresadosGradodeSatisfaccion.php?fk_nivelestudio='.$fk_nivelestudio.'&fk_modalidad='.$fk_modalidad.'&fk_carreras='.$fk_carreras.'&fk_generacion='.$fk_generacion.'"  />
  </div>

  <div class="costado">
    <table  border=1 width""   style="border-collapse: collapse; font-size:12px;">
      <caption class="Estilo1"><strong>Grado de satisfacción del (1 al 10) que te deja la formación recibida por la Institución</strong></caption>
      <thead>
        <tr>
          <th width="80">&nbsp;</th>
          <th style="background:green; color:white;">Alumnos</th>
          <th style="background:green; color:white;">Porcentaje</th>
        </tr>
      </thead>
      <tbody>
        <tr align="center" style="border-top:1px solid black; "  >
          <td width="140">1</td>
          <td width="80">'.$uno.'</td>
          <td width="80">'.$unoPorcentaje.'%</td>
          <td class="cuadrado" width="" bgcolor="#FF0000"  ></td> 
 
        </tr>
        <tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:white;" >
          <td width="80">2</td> 
          <td width="90">'.$dos.'</td>
          <td width="90">'.$dosPorcentaje.'%</td> 
          <td class="cuadrado" width="" bgcolor="#00FF49"></td> 

        </tr>
        <tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:white;" >
          <td width="80">3</td> 
          <td width="90">'.$tres.'</td>
          <td width="90">'.$tresPorcentaje.'%</td>
          <td class="cuadrado" width="" bgcolor="#002FFF"></td> 
 
        </tr>
        <tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:white;" >
          <td width="80">4</td> 
          <td width="90">'.$cuatro.'</td>
          <td width="90">'.$cuatroPorcentaje.'%</td> 
          <td class="cuadrado" width="" bgcolor="#00FFF7"></td> 

        </tr>
		        <tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:white;" >
          <td width="80">5</td> 
          <td width="90">'.$cinco.'</td>
          <td width="90">'.$cincoPorcentaje.'%</td> 
          <td class="cuadrado" width="" bgcolor="#FF00FC"></td> 

        </tr>
		        <tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:white;" >
          <td width="80">6</td> 
          <td width="90">'.$seis.'</td>
          <td width="90">'.$seisPorcentaje.'%</td>
          <td class="cuadrado" width="" bgcolor="#FCFF00"></td> 
 
        </tr>
        <tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:white;" >
          <td width="80">7</td> 
          <td width="90">'.$siete.'</td>
          <td width="90">'.$sietePorcentaje.'%</td> 
          <td class="cuadrado" width="" bgcolor="#FFAF00"></td> 

        </tr>
		        <tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:white;" >
          <td width="80">8</td> 
          <td width="90">'.$ocho.'</td>
          <td width="90">'.$ochoPorcentaje.'%</td> 
          <td class="cuadrado" width="" bgcolor="#ABABAB"></td> 

        </tr>
		        <tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:white;" >
          <td width="80">9</td> 
          <td width="90">'.$nueve.'</td>
          <td width="90">'.$nuevePorcentaje.'%</td> 
          <td class="cuadrado" width="" bgcolor="#FFA2FD"></td> 

        </tr>
		        <tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:white;" >
          <td width="80">10</td> 
          <td width="90">'.$diez.'</td>
          <td width="90">'.$diezPorcentaje.'%</td> 
          <td class="cuadrado" width="" bgcolor="#D8D8D8"></td> 

        </tr>
       
        <tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:green; color:white;" >
          <td width="80"><strong>TOTAL</strong></td> 
          <td width="90"><strong>'.$cantidadEncuestados.'</strong></td>
          <td width="90"><strong>'.$TotalPorcentaje.'%</strong></td> 
        </tr>

<tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:; color:;" >
          <td width="80"  style="font-size:14px;"><strong>PROMEDIO</strong></td> 
          <td width="90"  style="font-size:14px;"><strong>'.$promedioReal .'</strong></td>
          <td width="90"><strong>&nbsp;</strong></td> 
        </tr>
      </tbody>
    </table>
  </div>

<div style="clear: both"></div>     
<P>&nbsp;</P>

<footer style="text-align: center; FONT-FAMILY:ARIAL;">
      <p><STRONG>FUENTE: DEPARTAMENTO DE SEGUIMIENTO DE EGRESADOS</STRONG></p>
</footer>
</div>

</body>
</html>';
       fwrite($f, $grafica);
      fputs($f, "");
      fclose($f);

      $res =$html3;

  echo $res;

}



if($opcionGrafica=="6")
{


    $Result8 = $Obras->ConCantidadEgresados($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion);
    if ($Result8) {
        $row8 = mysql_fetch_assoc($Result8);
        $CantidadEgresadosTotal = $row8['cantidadTotalEgresados'];

        mysql_free_result($Result8);
    }


       

	
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
    
    if(trim($row['descripcion_aspectodebilidad'])=="Metodologia Enseñanza"){
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

    

    


   $cantidadEncuestados=$uno+$dos+$tres+$cuatro+$cinco+$seis+$siete+$ocho;

    $unoPorcentaje=$uno/$cantidadEncuestados*100;
	$unoPorcentaje = number_format($unoPorcentaje,1);
	
    $dosPorcentaje=$dos/$cantidadEncuestados*100;
	$dosPorcentaje = number_format($dosPorcentaje,1);

    $tresPorcentaje=$tres/$cantidadEncuestados*100;
	$tresPorcentaje = number_format($tresPorcentaje,1);

    $cuatroPorcentaje=$cuatro/$cantidadEncuestados*100;
	$cuatroPorcentaje = number_format($cuatroPorcentaje,1);

    $cincoPorcentaje=$cinco/$cantidadEncuestados*100;
	$cincoPorcentaje = number_format($cincoPorcentaje,1);

    $seisPorcentaje=$seis/$cantidadEncuestados*100;
	$seisPorcentaje = number_format($seisPorcentaje,1);

    $sietePorcentaje=$siete/$cantidadEncuestados*100;
	$sietePorcentaje = number_format($sietePorcentaje,1);

    $ochoPorcentaje=$ocho/$cantidadEncuestados*100;
	$ochoPorcentaje = number_format($ochoPorcentaje,1);


    

$TotalPorcentaje=$cantidadEncuestados/$cantidadEncuestados*100;

   
        }
        mysql_free_result($CantidadAlumnosEgresadosGraficaAspectoDebilidad);
    }   


if($uno==""){
	$uno=0;
	}


if($dos==""){
	$dos=0;
	}


if($tres==""){
	$tres=0;
	}


if($cuatro==""){
	$cuatro=0;
	}


if($cinco==""){
	$cinco=0;
	}


if($seis==""){
	$seis=0;
	}


if($siete==""){
	$siete=0;
	}

if($ocho==""){
	$ocho=0;
	}


$html3 = '
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reporte Grafica</title>
<style type="text/css">
<!--

.Estilo1{
  font-family:arial;
  font size:14px;
  }
.Estilo2 {  
  font-family:arial;
  font-size: 14px;
}
.footer{
  display:block;
}
#contenedor {
  width: 75%;
  height: 650;
  border: 0px solid blue;
  margin: 0 auto;
  padding:0px;
 }

 .costado {
  margin: 0px;
  padding: 0px;
  width: auto;
  font-family: Arial;
    border: 0px solid blue;

}

#derecha {
  height: auto;
  width: auto;
  float: right;
    border: 0px solid blue;

 
}

.post img {
     border: 0px;
}

.grafica{
  float:left;
}

td{
margin: 2px;
  padding: 2px;
}

caption{
  background-color: #CECE; margin: 5px; padding: 5px; 
}
.cuadrado {
     width: 10px; 
     height: 5px; 
     background:;
}
-->
</style>
</head>

<body>

<div id = "contenedor">

  </br></br></br>
  <table width="100%" height="" border="0" align="center" style="border-collapse: collapse;"  cellSpacing="0" cellPadding="0" >
    <tr>
          <td colspan="0" rowspan="5" width="100" class="Estilo1" align="center"><img src="../../../../assets/img/IESCH.png" width="90" height="90" /></td>
          
      <td colspan="8" width="400" class="Estilo1" align="center"><strong>INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS EN TUXTLA GUTIÉRREZ, S.C.</strong></td>
      
      <td colspan="0" rowspan="5" width="100" class="Estilo1" align="center"><img src="../../../../assets/img/fimpes.png" width="100  " height="100" />
    </tr>
    
    <tr><td colspan="8" class="Estilo1" align="center"><strong>INCORPORADO A LA SECRETARIA DE EDUCACIÓN</strong></td>
      </tr>
    
    <tr>
        <td colspan="8" class="Estilo1" align="center"><strong>OFICIO No. 0233 DE FECHA 03 DE NOVIEMBRE DE 1983</strong></td>
     </tr>
     
     <tr> 
      <td colspan="8" class="Estilo1" align="center"><strong>RÉGIMEN: PARTICULAR CLAVE: 07PSU0002D</strong></td>
      </tr>
      
      <tr>
      <td colspan="8" class="Estilo1" align="center"><strong>EXCELENCIA ACADÉMICA: REG. SEP/PSA/2009/030</strong></td>
      </tr>
      
        <tr><td colspan="10" class="Estilo1" align="center">&nbsp;</td></tr>
        <tr><td colspan="10" class="Estilo2" align="center"><strong>CARRERA: '.$carreraReporte.'</strong></td></tr>
        <tr><td colspan="10" class="Estilo2" align="center"><strong>MODALIDAD: '.$ModalidadReporte.'</strong></td></tr>
        <tr><td colspan="10" class="Estilo2" align="center"><strong>GENERACIÓN: '.$generacionLista.'</strong></td></tr>
    

    </table>
  <br>
  <div id="derecha">
   <img style="border:0px solid red;" src="Graficas/GraficaEgresadosAspectoDebilidad.php?fk_nivelestudio='.$fk_nivelestudio.'&fk_modalidad='.$fk_modalidad.'&fk_carreras='.$fk_carreras.'&fk_generacion='.$fk_generacion.'"  />
  </div>

  <div class="costado">
    <table  border=1 width""   style="border-collapse: collapse; font-size:12px;">
      <caption class="Estilo1"><strong>¿En qué aspecto detecta debilidad?</strong></caption>
      <thead>
        <tr>
          <th width="80">&nbsp;</th>
          <th style="background:green; color:white;">Alumnos</th>
          <th style="background:green; color:white;">Porcentaje</th>
        </tr>
      </thead>
      <tbody>
        <tr align="center" style="border-top:1px solid black; "  >
          <td width="140">Directivos</td>
          <td width="80">'.$uno.'</td>
          <td width="80">'.$unoPorcentaje.'%</td> 
          <td class="cuadrado" width="" bgcolor="#FF0000"  ></td> 

        </tr>
        <tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:white;" >
          <td width="80">Docentes</td> 
          <td width="90">'.$dos.'</td>
          <td width="90">'.$dosPorcentaje.'%</td> 
          <td class="cuadrado" width="" bgcolor="#00FF49"></td> 

        </tr>
        <tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:white;" >
          <td width="80">Metodología Enseñanza</td> 
          <td width="90">'.$tres.'</td>
          <td width="90">'.$tresPorcentaje.'%</td>
          <td class="cuadrado" width="" bgcolor="#002FFF"></td> 
 
        </tr>
        <tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:white;" >
          <td width="80">Programas Academicos</td> 
          <td width="90">'.$cuatro.'</td>
          <td width="90">'.$cuatroPorcentaje.'%</td> 
          <td class="cuadrado" width="" bgcolor="#00FFF7"></td> 

        </tr>
		        <tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:white;" >
          <td width="80">Plan de Estudios</td> 
          <td width="90">'.$cinco.'</td>
          <td width="90">'.$cincoPorcentaje.'%</td> 
          <td class="cuadrado" width="" bgcolor="#FF00FC"></td> 

        </tr>
		        <tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:white;" >
          <td width="80">Criterios de Evaluación</td> 
          <td width="90">'.$seis.'</td>
          <td width="90">'.$seisPorcentaje.'%</td> 
          <td class="cuadrado" width="" bgcolor="#FCFF00"></td> 

        </tr>
        <tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:white;" >
          <td width="80">Aulas y Equipo Didáctico</td> 
          <td width="90">'.$siete.'</td>
          <td width="90">'.$sietePorcentaje.'%</td> 
          <td class="cuadrado" width="" bgcolor="#FFAF00"></td> 

        </tr>
		
        <tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:white;" >
          <td width="80">Otros</td> 
          <td width="90">'.$ocho.'</td>
          <td width="90">'.$ochoPorcentaje.'%</td> 
          <td class="cuadrado" width="" bgcolor="#ABABAB"></td> 

        </tr>
       
        <tr align="center" style="border-top:2px solid black; border-bottom:2px solid black;background:green; color:white;" >
          <td width="80"><strong>TOTAL</strong></td> 
          <td width="90"><strong>'.$cantidadEncuestados.'</strong></td>
          <td width="90"><strong>'.$TotalPorcentaje.'%</strong></td> 
        </tr>
      </tbody>
    </table>
  </div>

<div style="clear: both"></div>     
<P>&nbsp;</P>

<footer style="text-align: center; FONT-FAMILY:ARIAL;">
      <p><STRONG>FUENTE: DEPARTAMENTO DE SEGUIMIENTO DE EGRESADOS</STRONG></p>
</footer>
</div>

</body>
</html>';
       fwrite($f, $grafica);
      fputs($f, "");
      fclose($f);

      $res =$html3;

  echo $res;

}


?>
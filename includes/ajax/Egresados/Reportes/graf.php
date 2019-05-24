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


$vr_grafica = $_GET['vr_grafica'];


if($vr_grafica=="1"){

$EncuestaMedicinaEstudiosPos=$Obras->CantidadAlumnosEncuestaMedicinaGrafica($pk_alumno);


    if ($EncuestaMedicinaEstudiosPos) {
        while ($row = mysql_fetch_assoc($EncuestaMedicinaEstudiosPos)) {
			
			
	//ESTUDIO DE POSGRADO (ESPECIALIDAD)

     if(trim($row['descripcion_estudiosposgrado'])=="Doctorado"){
        $Doctorado=$row['cantidad'];
    }
    
    if(trim($row['descripcion_estudiosposgrado'])=="Especialidad"){
        $Especialidad=$row['cantidad'];
    }
    
    if(trim($row['descripcion_estudiosposgrado'])=="Maestria"){
        $Maestria=$row['cantidad'];
    }
    
    if(trim($row['descripcion_estudiosposgrado'])=="Ninguno"){
        $Ninguno=$row['cantidad'];
    }
    
    if(trim($row['descripcion_estudiosposgrado'])=="Otros"){
        $Otros=$row['cantidad'];
    }
    
    if(trim($row['descripcion_estudiosposgrado'])=="Especialidad y Maestria"){
        $EM=$row['cantidad'];
    }
    
      if(trim($row['descripcion_estudiosposgrado'])=="Especialidad y Doctorado"){
        $ED=$row['cantidad'];
    }
    
      if(trim($row['descripcion_estudiosposgrado'])=="Maestria y Doctorado"){
        $MD=$row['cantidad'];
    }
    
      if(trim($row['descripcion_estudiosposgrado'])=="Especialidad,Maestria y Doctorado"){
        $EMD=$row['cantidad'];
    }
	
	
    $cantidadEncuestados=$Doctorado+$Especialidad+$Maestria+$Ninguno+$Otros+$EM+$ED+$MD+$EMD;;

	
		}
        mysql_free_result($EncuestaMedicinaEstudiosPos);
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
.Estilo2 {font-size: 10px}
-->
</style>
</head>

<body>

</br></br></br>
<table width="860" height="" border="0" align="center"  cellSpacing="0" cellPadding="0" >
  <tr>
      	<td colspan="0" rowspan="5" width="100" class="Estilo1" align="center"><img src="../../../../assets/img/IESCH.png" width="90" height="90" /></td>
        
		<td colspan="8" width="400" class="Estilo1" align="center"><strong>INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS</strong></td>
		
		<td colspan="0" rowspan="5" width="100" class="Estilo1" align="center"><img src="../../../../assets/img/fimpes.png" width="100	" height="100" />
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
  <tr><td colspan="10" class="Estilo1" align="center">&nbsp;</td></tr>

  
  <tr>
    <td colspan="10" class="Estilo1" align="center"><strong>CARRERA: MEDICINA</strong></td>
  </tr>
  <tr><td colspan="10" class="Estilo1" align="center">&nbsp;</td></tr>
  
  <tr><td width="430" colspan="5" class="Estilo1" align="center">Cantidad de Alumnos Encuestados</td><td width="430" colspan="5" class="Estilo1" align="center"><strong><u>'.$cantidadEncuestados.'</u></strong></td></tr>
  </table>
<br><br>
 <center><img src="Graficas/graficaCircularEstudioPosgrado.php" /> </center>
</body>
</html>
';
   

    
     fwrite($f, $grafica);
    fputs($f, "");
    fclose($f);
    
     
    $res =$html3;

echo $res;

}

if($vr_grafica=="2"){
	
	$EncuestaMedicinaRamaPosgrado=$Obras->CantidadAlumnosEncuestaMedicinaGraficaramaposgrado($pk_alumno);


    if ($EncuestaMedicinaRamaPosgrado) {
        while ($row = mysql_fetch_assoc($EncuestaMedicinaRamaPosgrado)) {
			
			
	//RAMA POSGRADO 
	
     if(trim($row['descripcion_ramaposgrado'])=="Salud"){
        $salud=$row['cantidad'];
    }
    
    if(trim($row['descripcion_ramaposgrado'])=="Docencia"){
        $docencia=$row['cantidad'];
    }
    
    if(trim($row['descripcion_ramaposgrado'])=="Administracion"){
        $administracion=$row['cantidad'];
    }
    
    if(trim($row['descripcion_ramaposgrado'])=="Otros"){
        $otros=$row['cantidad'];
    }
    
    if(trim($row['descripcion_ramaposgrado'])=="Ninguno"){
        $ninguno=$row['cantidad'];
    }
    
    if(trim($row['descripcion_ramaposgrado'])=="Salud,Docencia"){
        $sd=$row['cantidad'];
    }
    
      if(trim($row['descripcion_ramaposgrado'])=="Salud,Administracion"){
        $sa=$row['cantidad'];
    }
    
      if(trim($row['descripcion_ramaposgrado'])=="Salud,Docencia,Administracion"){
        $sda=$row['cantidad'];
    }
    
      if(trim($row['descripcion_ramaposgrado'])=="Docencia,Administracion"){
        $da=$row['cantidad'];
    }
	
	
$cantidadEncuestados=$salud+$docencia+$administracion+$otros+$ninguno+$sd+$sa+$sda+$da;

	
		}
        mysql_free_result($EncuestaMedicinaRamaPosgrado);
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
.Estilo2 {font-size: 10px}
-->
</style>
</head>

<body>
			
</br></br></br>
<table width="860" height="" border="0" align="center"  cellSpacing="0" cellPadding="0" >
  <tr>
      	<td colspan="0" rowspan="5" width="100" class="Estilo1" align="center"><img src="../../../../assets/img/IESCH.png" width="90" height="90" /></td>
        
		<td colspan="8" width="400" class="Estilo1" align="center"><strong>INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS</strong></td>
		
		<td colspan="0" rowspan="5" width="100" class="Estilo1" align="center"><img src="../../../../assets/img/fimpes.png" width="100	" height="100" /
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
  <tr><td colspan="10" class="Estilo1" align="center">&nbsp;</td></tr>

  
  <tr>
    <td colspan="10" class="Estilo1" align="center"><strong>CARRERA: MEDICINA</strong></td>
  </tr>
  <tr><td colspan="10" class="Estilo1" align="center">&nbsp;</td></tr>
  
  <tr><td width="430" colspan="5" class="Estilo1" align="center">Cantidad de Alumnos Encuestados</td><td width="430" colspan="5" class="Estilo1" align="center"><strong><u>'.$cantidadEncuestados.'</u></strong></td></tr>
  </table>
<br><br>
 <center><img src="Graficas/graficaCircularRamaPosgrado.php" /> </center>
</body>
</html>
';
   

    
     fwrite($f, $grafica);
    fputs($f, "");
    fclose($f);
    
     
    $res =$html3;

echo $res;

	
	}
	
	if($vr_grafica=="3"){
	
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
.Estilo2 {font-size: 10px}
-->
</style>
</head>

<body>
			
</br></br></br>
<table width="860" height="" border="0" align="center"  cellSpacing="0" cellPadding="0" >
  <tr>
      	<td colspan="0" rowspan="5" width="100" class="Estilo1" align="center"><img src="../../../../assets/img/IESCH.png" width="90" height="90" /></td>
        
		<td colspan="8" width="400" class="Estilo1" align="center"><strong>INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS</strong></td>
		
		<td colspan="0" rowspan="5" width="100" class="Estilo1" align="center"><img src="../../../../assets/img/fimpes.png" width="100	" height="100" /
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
  <tr><td colspan="10" class="Estilo1" align="center">&nbsp;</td></tr>

  
  <tr>
    <td colspan="10" class="Estilo1" align="center"><strong>CARRERA: MEDICINA</strong></td>
  </tr>
  <tr><td colspan="10" class="Estilo1" align="center">&nbsp;</td></tr>
  
  <tr><td width="430" colspan="5" class="Estilo1" align="center">Cantidad de Alumnos Encuestados</td><td width="430" colspan="5" class="Estilo1" align="center"><strong><u>'.$cantidadEncuestados.'</u></strong></td></tr>
  </table>
<br><br>
 <center><img src="Graficas/graficaCircularpuesto.php" /> </center>
</body>
</html>
';
   

    
     fwrite($f, $grafica);
    fputs($f, "");
    fclose($f);
    
     
    $res =$html3;

echo $res;

	
	}
	
		if($vr_grafica=="4"){
	
	$EncuestaMedicinaIngreso=$Obras->CantidadAlumnosEncuestaMedicinaGraficaIngresoActual($pk_alumno);


    if ($EncuestaMedicinaIngreso) {
        while ($row = mysql_fetch_assoc($EncuestaMedicinaIngreso)) {
			
			
	//RAMA POSGRADO 
	
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

	
		}
        mysql_free_result($EncuestaMedicinaIngreso);
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
.Estilo2 {font-size: 10px}
-->
</style>
</head>

<body>
			
</br></br></br>
<table width="860" height="" border="0" align="center"  cellSpacing="0" cellPadding="0" >
  <tr>
      	<td colspan="0" rowspan="5" width="100" class="Estilo1" align="center"><img src="../../../../assets/img/IESCH.png" width="90" height="90" /></td>
        
		<td colspan="8" width="400" class="Estilo1" align="center"><strong>INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS</strong></td>
		
		<td colspan="0" rowspan="5" width="100" class="Estilo1" align="center"><img src="../../../../assets/img/fimpes.png" width="100	" height="100" /
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
  <tr><td colspan="10" class="Estilo1" align="center">&nbsp;</td></tr>

  
  <tr>
    <td colspan="10" class="Estilo1" align="center"><strong>CARRERA: MEDICINA</strong></td>
  </tr>
  <tr><td colspan="10" class="Estilo1" align="center">&nbsp;</td></tr>
  
  <tr><td width="430" colspan="5" class="Estilo1" align="center">Cantidad de Alumnos Encuestados</td><td width="430" colspan="5" class="Estilo1" align="center"><strong><u>'.$cantidadEncuestados.'</u></strong></td></tr>
  </table>
<br><br>
 <center><img src="Graficas/graficaCircularIngreso.php" /> </center>
</body>
</html>
';
   

    
     fwrite($f, $grafica);
    fputs($f, "");
    fclose($f);
    
     
    $res =$html3;

echo $res;

	
	}

?> 

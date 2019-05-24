<?php
$Ruta = "../../../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisFunciones.class.php");

$Funciones = new MisFunciones();
$consult = new ConsultaDB();


session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();   

extract($_POST);


if(empty($fk_nivelestudio)){
   echo "<script type='text/javascript'>alertify.error('Seleccione el Nivel de Estudios');</script>";     
   exit();
}


if(empty($fk_modalidad)){
   echo "<script type='text/javascript'>alertify.error('Seleccione la Modalidad');</script>";    
   exit();
}


if(empty($fk_carreras)){
   echo "<script type='text/javascript'>alertify.error('Seleccione la Carrera');</script>";       
   exit();
}


if(empty($rangoFechas)){
   echo "<script type='text/javascript'>alertify.error('Seleccione un rango de fechas');</script>";  
   exit();
}


    $fechaSQL = explode("-",$rangoFechas);
    $fechaInicio=trim($fechaSQL[0]);
    $fechaFin=trim($fechaSQL[1]);
    
  //  01/07/2014 - 31/07/2014
    $fechaSQL = explode("/",$fechaInicio);
    $fechaInicio=$fechaSQL[2]."-".$fechaSQL[1]."-".$fechaSQL[0];   

    $fechaSQL = explode("/",$fechaFin);
    $fechaFin=$fechaSQL[2]."-".$fechaSQL[1]."-".$fechaSQL[0];   

    
    
 $result = $consult->ConDatosAreaFormacion($fk_carreras);
  if ($result) {
       $row222 = mysql_fetch_assoc($result);
      $areaUno=$row222['formacion1'];
      $areaDos=$row222['formacion2'];
      $areaTres=$row222['formacion3'];
      $areaCuatro=$row222['formacion4'];
      $areaCinco=$row222['formacion5'];
      $area6=$row222['formacion6'];
      $area7=$row222['formacion7'];
      $area8=$row222['formacion8'];
      $area9=$row222['formacion9'];
      $area10=$row222['formacion10'];
      $area11=$row222['formacion11'];
      
      //
  }
  
  echo $area11;
  
  
    
$res = $consult->ConReporteDocumentacionAlumnos($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fechaInicio, $fechaFin);


if ( mysql_num_rows( $res ) > 0 ) {
    echo '
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Servicios Escolares IESCH</title>

      
<script type="text/javascript">



window.onbeforeunload = function exitAlert()	    
{	 
     
    $.ajax({
        url: "../modules/modInstitucional.php",
        type: "post",
       data: "cambiarSession=cambiarSession",
        success: function(data)
        {
       
       
        }//suceess
    });//AJAX
    var textillo = "Los datos que no se han guardado se perderan.";   
    return textillo;

}




</script>

<style type="text/css">
<!--
.Estilo5 {font-size: 16px; font-weight: bold; }
.Estilo6 {
	font-size: 15px;
	font-weight: bold;
}
.Estilo7 {font-size: 15px}
-->
</style>

</head>

<body>







<h1>Captura de Resultados</h1>
         <br>
      <table width="997" border="0">
  <tr>
    <td colspan="2" rowspan="2"  align="center"><div align="center" class="Estilo5">No. FOLIO</div></td>
    <td colspan="6" rowspan="2"  align="center"><div align="center" class="Estilo5">NOMBRE DEL ALUMNO</div></td>
    <td colspan="5"  align="center"><div align="center" class="Estilo5">AREAS DE FORMACION</div></td>
  </tr>
  <tr>
    <td width="106" height="48"  align="center" bgcolor="#CCCCCC"><div align="center" class="Estilo5">'.$areaUno.'</div></td>
    <td width="97"  align="center"><div align="center" class="Estilo5">'.$areaDos.'</div></td>
    <td width="109"  align="center" bgcolor="#CCCCCC"><div align="center" class="Estilo5">'.$areaTres.'</div></td>
 
   ';
    
    
     
      if($areaCuatro!=""){
     echo   '<td width="103"  align="center"><div align="center" class="Estilo5">'.$areaCuatro.'</div></td>';
    
   }
   
   
    
      if($areaCinco!=""){
     echo   '<td width="87"  align="center" bgcolor="#CCCCCC"><div align="center" class="Estilo5">'.$areaCinco.'</div></td>';
    
   }
   
   
    if($area6!=""){
     echo   '<td width="106" height="48"  align="center" bgcolor="#CCCCCC"><div align="center" class="Estilo5">'.$area6.'</div></td>';
    
   }
   
   
     if($area7!=""){
     echo   '<td width="97"  align="center"><div align="center" class="Estilo5">'.$area7.'</div></td>';
    
   }
   
       if($area8!=""){
     echo   ' <td width="109"  align="center" bgcolor="#CCCCCC"><div align="center" class="Estilo5">'.$area8.'</div></td>';
    
   }
   
   
    if($area9!=""){
     echo   '<td width="103"  align="center"><div align="center" class="Estilo5">'.$area9.'</div></td>';
    
   }
   
   
     if($area10!=""){
     echo   ' <td width="87"  align="center" bgcolor="#CCCCCC"><div align="center" class="Estilo5">'.$area10.'</div></td>';
    
   }
   
   
        if($area10!=""){
     echo   '<td width="87"  align="center" bgcolor="#CCCCCC"><div align="center" class="Estilo5">'.$area11.'</div></td>';
    
   }
   
    echo ' 
  </tr>';
    
    while ( $row = mysql_fetch_assoc( $res ) ) {
    
        
        echo '        

<tr>
    <td colspan="2"><span class="Estilo7">' . $row['folioInstitucional'] . '</span></td>
    <td colspan="6"><span class="Estilo7">' . $row['NombreCompleto'] . '</span></td>
    <td bgcolor="#CCCCCC"><span class="Estilo7"><input type="text" size="10" maxlength="10" name="a1[' . $row["pk_alumno"] . ']" value="' . $row["a1"] . '"></span></td>
    <td><span class="Estilo7"><input type="text" size="10" maxlength="10" name="a2[' . $row["pk_alumno"] . ']" value="' . $row["a2"] . '"></span></td>
    <td bgcolor="#CCCCCC"><span class="Estilo7"><input type="text" size="10" maxlength="10" name="a3[' . $row["pk_alumno"] . ']" value="' . $row["a3"] . '"></span></td>
    ';
  
        
  if($areaCuatro!=""){
     echo '<td><span class="Estilo7"><input type="text" size="10" maxlength="10" name="a4[' . $row["pk_alumno"] . ']" value="' . $row["a4"] . '"></span></td>';
    
   }

   if($areaCinco!=""){
     echo '<td bgcolor="#CCCCCC"><span class="Estilo7"><input type="text" size="10" maxlength="10" name="a5[' . $row["pk_alumno"] . ']" value="' . $row["a5"] . '"></span></td>';
    
   }

     if($area6!=""){
     echo '<td class="Estilo7"><span class="Estilo7"><input type="text" size="10" maxlength="10" name="a6[' . $row["pk_alumno"] . ']" value="' . $row["a6"] . '"></span></td>';
    
   }
   
     if($area7!=""){
     echo '<td bgcolor="#CCCCCC"><span class="Estilo7"><input type="text" size="10" maxlength="10" name="a7[' . $row["pk_alumno"] . ']" value="' . $row["a7"] . '"></span></td>';
    
   }
   
     if($area8!=""){
     echo '<td class="Estilo7"><span class="Estilo7"><input type="text" size="10" maxlength="10" name="a8[' . $row["pk_alumno"] . ']" value="' . $row["a8"] . '"></span></td>';
    
   }
   
        if($area9!=""){
     echo '<td bgcolor="#CCCCCC"><span class="Estilo7"><input type="text" size="10" maxlength="10" name="a9[' . $row["pk_alumno"] . ']" value="' . $row["a9"] . '"></span></td>';
    
   }
   
     if($area10!=""){
     echo '<td bgcolor="#CCCCCC"><span class="Estilo7"><input type="text" size="10" maxlength="10" name="a10[' . $row["pk_alumno"] . ']" value="' . $row["a10"] . '"></span></td>';
    
   }
   
     if($area11!=""){
     echo '<td bgcolor="#CCCCCC"><span class="Estilo7"><input type="text" size="10" maxlength="10" name="a11[' . $row["pk_alumno"] . ']" value="' . $row["a11"] . '"></span></td>';
    
   }
   
   
   
    echo ' 
     
</tr>

  
  ';
   echo '<input type="hidden" name="id[]" value="' . $row["pk_alumno"] . '">  ' . "\n";
   echo '<input type="hidden" id="idDirector" name="idDirector" value="' . $_SESSION['usuario_id'] . '">  ' . "\n";
                                                                        //session del director
    }
    echo '</table> ';
   // echo '</table> <input type="submit" name="submit" id="submit" onClick="cerrar=2;" value="Guardar Resultados">';
     echo '<a haref>';
    echo '';
    
}
 
 ?>

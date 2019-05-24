<?php

require_once("../../../../../includes/Config.class.php");  # Cargar datos conexion y otras variables.
require_once('../../../../../includes/DB.class.php');
require_once('../../../../../includes/ConsultaDB.class.php');
require_once('../../../../../includes/MisFunciones.class.php');
require_once('../../../../../includes/ConvertirNumLetra.php');
require_once('../../../../../includes/DeNumero_a_Letras.php');
require_once('../../../../../mpdf/mpdf.php');


$Obras = new ConsultaDB;
$Funciones = new MisFunciones;
$today = date("h:i:sa");
$date = date("d-m-y");


//$fecha = date('d-m-y');
//$nuevafecha = strtotime ( '-2 day' , strtotime ( $fecha ) ) ;
//$nuevafecha = date ( 'd-m-y' , $nuevafecha );
 

if (isset($_GET['pk_alumno'])) {


    $pk_alumno = $_GET['pk_alumno'];
    $fk_nivelestudio = $GET['fk_nivelestudio'];
    $Generacion = $_GET['Generacion'];

  
    //DATOS DE LA ESCUELA
    $Result32 = $Obras->ConsultaDatosInsitucionConEstados();
    if ($Result32) {
        $row333 = mysql_fetch_assoc($Result32);

        $nombreInstitucion = strtoupper($row333['nombreInstitucion']);
        $apodoInstitucion = $row333['apodoInstitucion'];
        $clave = $row333['clave'];
        $direccion = $row333['direccion'];
        $telefono = $row333['telefono'];
        $ciudad = strtoupper($row333['CiudadEscuela']);
        $estado = strtoupper($row333['EstadoEscuela']);
        $fechaIncorporacionsecretaria = $row333['fechaIncorporacionSrecetaria'];
        $numerooficio = $row333['noOficio'];
        $registro = $row333['registro'];
        $regimen = $row333['regimen'];
        $paginainternet = $row333['paginaInternet'];
        $lemaescuela = strtoupper($row333['lemaEscuela']);
    }


//obtenemos fecha actual y cambiamos el formato de vista
$fechaActual = strftime("%Y-%m-%d", time());
$fechaActualModificar = explode("-", $fechaActual);
$fechaActualLista = $fechaActualModificar[0] . "-" . $fechaActualModificar[1] . "-" . $fechaActualModificar[2];
$fechaLetras = $Funciones->Fecha2Mayusculas($fechaActualLista);

$fechaDividir = explode("DE", $fechaLetras);
$fechaDiaActual = convertir($fechaDividir[0]);
$fechaMesActual = $fechaDividir[1];
$fechaAnioActual = convertir($fechaDividir[2]);

$xxx = explode(" ", $fechaAnio);
$fechaAnioProtestaListo=$xxx[2];


    $result = $Obras->ConReporteDocumentacionAlumnosPorLlavePrimaria($pk_alumno);
    while ($row = mysql_fetch_assoc($result)) {


      $tomaprotestaLetras = $Funciones->Fecha2Mayusculas($row[FechaTomaProtesta]);
        $fechaLista = ($row[FechaTomaProtestaReporte]);


 //obtenemos fecha toma de protesta y cambiamos el formato de vista
        //$FechaTomaProtesta = strftime("%Y-%m-%d", time());
        $FechaTomaProtesta = $row['FechaTomaProtesta'];
        $FechaTomaProtestaModificar = explode("-", $FechaTomaProtesta);
        $FechaTomaProtestaLista = $FechaTomaProtestaModificar[0] . "-" . $FechaTomaProtestaModificar[1] . "-" . $FechaTomaProtestaModificar[2];
        $fechaLetras = $Funciones->Fecha2Mayusculas($FechaTomaProtestaLista);

        $fechaDividir = explode("DE", $fechaLetras);
        $fechaDia = strtoupper  (convertir($fechaDividir[0]));
        $fechaMes = strtoupper  (  $fechaDividir[1]);
        $fechaAnio = strtoupper  (convertir($fechaDividir[2]));
        //$fechaAnioProtestaListo=substr($fechaAnio, -6); //Esto devuelve "ndo"
      // $fechaAnioProtestaListo=$fechaAnio;

$xxx = explode(" ", $fechaAnio);
$fechaAnioProtestaListo=$xxx[2];


        //DATOS DEL DIRECTOR
  $fk_carreras=$row[fk_carreras];
      $Result22 = $Obras->verTrabajadoresDirectoresReportes($fk_carreras);
    if ($Result22) {
        $row222 = mysql_fetch_assoc($Result22);
        $nombreDirector=  ($row222[nombre]." ".$row222[apaterno]." ".$row222[amaterno]);
       //$nombreDirector= $row222[NombreCompleto];
	 $carreraReporte=  ($row222[nombreCarrera]);
  $genero = $row[fk_genero];
      
        mysql_free_result($Result22);
    }


        
//$tomaprotestaLetras = $Funciones->Fecha2Mayusculas($row[FechaTomaProtesta]);
//$fechaLista = ($row[FechaTomaProtestaReporte]);
$FechaTomaProtesta = $row['FechaTomaProtesta'];
$FechaTomaProtestaModificar = explode("-", $FechaTomaProtesta);
$FechaTomaProtestaLista = $FechaTomaProtestaModificar[0] . "-" . $FechaTomaProtestaModificar[1] . "-" . $FechaTomaProtestaModificar[2];
$fechaProtestaLetras = $Funciones->Fecha2Mayusculas($FechaTomaProtestaLista);

$fechaDividir = explode("DE", $fechaProtestaLetras);
$fechaDiaProtesta = convertir($fechaDividir[0]);
$fechaMesProtesta = $fechaDividir[1];
$fechaAnioProtesta = convertir($fechaDividir[2]);


$hora = $row[hora];
$duracion = $row[DescripcionDuracion];
$autorizacion = $row[NumeroAutorizacion];
            
//HORA
$hora =$row[hora];
$horaDividir = explode(":",$hora);
$horaHora=$horaDividir[0];
$horaMinuto = $horaDividir[1];


$horaListo = convertir($horaHora);
$horaMinutoListo = convertir($horaMinuto);
$hora =strtolower($horaListo." ".$horaMinutoListo);
$hora=ucwords($hora);        

$titulo = mb_strtoupper($row[nombreTitulo],'UTF-8');         
 $apaterno = $row[ApaternoAlumno];
 $amaterno= $row[AmaternoAlumno];
 $nombre= $row[NombreAlumno];
 $curp = $row[curp];
 $matricula = $row[matricula];
 $planestudio = $row[PlanEstudiosNombre];
 $promedio = $row[promedio];
 $letraPromedio = $row[letraPromedio];

$opcionTitulacion=strtoupper($row[NombreOpcionTitulacion]);
$nombreTesis=$row[nombreTesis];


	
	$carrera=$row[nombreCarrera];
	
	$xxx = explode(" ", $carrera);
	
	$carreraLista=$car=$xxx[2] ." ".$car=$xxx[3] ." ".$car=$xxx[4] ." ". $car=$xxx[5] ." ". $car=$xxx[6] ." ". $car=$xxx[7] ." ". $car=$xxx[8] ." ". $car=$xxx[9] ." ". $car=$xxx[10];

$letraPromedio=strtoupper($row[letraPromedio]);

//fk_genero 1=HOMBRE
if($genero == "1"){

$html = "

<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Documento sin t&iacute;tulo</title>
<style type='text/css'>
<!--
.Estilo1 {
	font-size: 12px;
	font-weight: bold;
}
.Estilo2 {
	font-size: 14px;
	font-weight: bold;
}
.Estilo3 {font-size: 14px}
.Estilo4 {font-size: 10px}
.Estilo5 {
	font-size: 18px;
	font-weight: bold;
}
-->
</style>
</head>

<body>


<table width='785' border='0' >
<tr>
    <td colspan='2' rowspan='6'><div align='center'><img src='../../../../../assets/img/IESCH.png' width='117' height='121' /></div></td>
    <td colspan='8'><center><div align='center'><strong>&nbsp;</strong></div></center></td>
    <td colspan='2' rowspan='6'><div align='center'><img src='../../../../../assets/img/maestria.jpg' width='107' height='109' /></div></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS</strong></div></center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>UNIVERSIDAD SALAZAR</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>CLAVE: $clave</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>DIRECCIÓN DE MAESTRIAS</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>&nbsp;</strong></div>
    </center></td>
  </tr>
  <tr>
    <td width='105'>&nbsp;</td>
    <td width='39'>&nbsp;</td>
    <td colspan='8'><center><div align='center'></div>
    </center></td>
    <td width='53'>&nbsp;</td>
    <td width='79'>&nbsp;</td>
  </tr>

  <tr>
    <td width='105'>&nbsp;</td>
    <td width='39'>&nbsp;</td>
    <td width='73'>&nbsp;</td>
    <td width='44'>&nbsp;</td>
    <td width='47'>&nbsp;</td>
    <td width='68'>&nbsp;</td>
    <td width='33'>&nbsp;</td>
    <td width='103'>&nbsp;</td>
    <td width='36'>&nbsp;</td>
    <td width='55'>&nbsp;</td>
    <td width='53'>&nbsp;</td>
    <td width='79'>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan='8'  align='right'><div align='right' class='Estilo2'>ASUNTO: DICTAMEN</div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align='right'><span class='Estilo3'></span></div></td>
    <td colspan='4' align='right'><div align='right' class='Estilo2'>&nbsp;</div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
 
  <tr>
    <td colspan='6'><span class='Estilo3'><strong>A QUIEN CORRESPONDA</strong></span></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height='44' colspan='12' align='justify'><span class='Estilo3'>POR MEDIO DEL PRESENTE COMUNICAMOS A USTED </td>
  </tr>
  
  <tr>
    <td height='22'>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan='5'><center><div align='center' class='Estilo5'>&nbsp;</div></center></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height='52' colspan='12' align='justify'><div align='justify'><span class='Estilo3'>QUE EL <strong>C. $nombre $apaterno $amaterno</strong> CON NÚMERO DE CONTROL <strong>$matricula</strong> ACREDITÓ SU EXAMEN"; 
	
	if($opcionTitulacion=="TESIS DE GRADO"){
    $html.=' BAJO LA OPCIÓN DE TITULACIÓN POR<strong>';
    }else{
      $html.=' DE GRADO BAJO LA OPCIÓN DE TITULACIÓN POR<strong> ';
      }
    
  
  
   if($opcionTitulacion=="PROMEDIO GENERAL DE CALIFICACIONES"){
     
     $html.=' PROMEDIO ';

     } else if($opcionTitulacion=="TESIS DE GRADO"){

     $html.=' '.$opcionTitulacion.' '.$nombreTesis.' ';
         
       }else {
    
       $html.=' '. $opcionTitulacion.' ';
       
       }
 
		 
	 
	 
	 $html.=",</strong>DE <strong>$carrera </strong> GENERACIÓN <STRONG> $Generacion </STRONG>, EL DIA $fechaDia DE $fechaMes DEL $fechaAnio A LAS  $horaListo $horaMinutoListo HORAS.
</strong></span></div></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height='61' colspan='12' align='justify'><div align='justify'><span class='Estilo3'>A PETICIÓN DE LA PARTE INTERESADA Y PARA LOS FINES LEGALES QUE MEJOR CONVENGAN, SE EXTIENDE LA PRESENTE EN LA CIUDAD DE TUXTLA GUTIÉRREZ, CHIAPAS; A LOS $fechaDiaActual DIAS DEL MES DE $fechaMesActual DEL $fechaAnioActual </span> </div></td>
  </tr>
  
  
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='12'><center><div align='center' class='Estilo2'>ATENTAMENTE</div></center></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='12'><center><div align='center' class='Estilo2'>$lemaescuela</div></center></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='12'><center><div align='center' class='Estilo3'><strong>MTRO. FILEMON CORZO NAÑEZ</strong></div></center></td>
  </tr>
  <tr>
    <td colspan='12'><center><div align='center' class='Estilo2'>DIRECTOR DE POSGRADO</div></center></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

</table>
</body>
</html>";
}

//fk_genero 2=MUJER
if($genero == "2"){


$html = "

<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Documento sin t&iacute;tulo</title>
<style type='text/css'>
<!--
.Estilo1 {
	font-size: 12px;
	font-weight: bold;
}
.Estilo2 {
	font-size: 14px;
	font-weight: bold;
}
.Estilo3 {font-size: 14px}
.Estilo4 {font-size: 10px}
.Estilo5 {
	font-size: 18px;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<table width='785' border='0' >
<tr>
    <td colspan='2' rowspan='6'><div align='center'><img src='../../../../../assets/img/IESCH.png' width='117' height='121' /></div></td>
    <td colspan='8'><center><div align='center'><strong>&nbsp;</strong></div></center></td>
    <td colspan='2' rowspan='6'><div align='center'><img src='../../../../../assets/img/maestria.jpg' width='107' height='109' /></div></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS</strong></div></center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>UNIVERSIDAD SALAZAR</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>CLAVE: $clave</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>DIRECCION DE MAESTRIAS</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>&nbsp;</strong></div>
    </center></td>
  </tr>
  <tr>
    <td width='105'>&nbsp;</td>
    <td width='39'>&nbsp;</td>
    <td colspan='8'><center><div align='center'></div>
    </center></td>
    <td width='53'>&nbsp;</td>
    <td width='79'>&nbsp;</td>
  </tr>

  <tr>
    <td width='105'>&nbsp;</td>
    <td width='39'>&nbsp;</td>
    <td width='73'>&nbsp;</td>
    <td width='44'>&nbsp;</td>
    <td width='47'>&nbsp;</td>
    <td width='68'>&nbsp;</td>
    <td width='33'>&nbsp;</td>
    <td width='103'>&nbsp;</td>
    <td width='36'>&nbsp;</td>
    <td width='55'>&nbsp;</td>
    <td width='53'>&nbsp;</td>
    <td width='79'>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan='8'  align='right'><div align='right' class='Estilo2'>ASUNTO: DICTAMEN</div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align='right'><span class='Estilo3'></span></div></td>
    <td colspan='4' align='right'><div align='right' class='Estilo2'>&nbsp;</div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
 
  <tr>
    <td colspan='6'><span class='Estilo3'><strong>A QUIEN CORRESPONDA</strong></span></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height='44' colspan='12' align='justify'><span class='Estilo3'>POR MEDIO DEL PRESENTE COMUNICAMOS A USTED</tr>
  
  <tr>
    <td height='22'>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan='5'><center><div align='center' class='Estilo5'>&nbsp;</div></center></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height='52' colspan='12' align='justify'><div align='justify'><span class='Estilo3'>QUE LA <strong>C. $nombre $apaterno $amaterno</strong> CON NÚMERO DE CONTROL <strong>$matricula</strong> ACREDITÓ SU EXAMEN"; 
	
	if($opcionTitulacion=="TESIS DE GRADO"){
		$html.=' BAJO LA OPCIÓN DE TITULACIÓN POR<strong>';
		}else{
			$html.=' DE GRADO BAJO LA OPCIÓN DE TITULACIÓN POR<strong> ';
			}
		
	
	
	 if($opcionTitulacion=="PROMEDIO GENERAL DE CALIFICACIONES"){
		 
		 $html.=' PROMEDIO ';

		 } else if($opcionTitulacion=="TESIS DE GRADO"){

		 $html.=' '.$opcionTitulacion.' '.$nombreTesis.' ';
			 	 
			 }else {
		
			 $html.=' '. $opcionTitulacion.' ';
			 
			 }
 
		 
	 
	 
	 $html.=",</strong>DE <strong>$carrera </strong> GENERACIÓN <STRONG> $Generacion </STRONG>, EL DIA $fechaDia DE $fechaMes DEL $fechaAnio A LAS  $horaListo $horaMinutoListo HORAS;EN EL SALON DE USOS MULTIPLES, DEL INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS.
</strong></span></div></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height='61' colspan='12' align='justify'><div align='justify'><span class='Estilo3'>A PETICIÓN DE LA PARTE INTERESADA Y PARA LOS FINES LEGALES QUE MEJOR CONVENGAN, SE EXTIENDE LA PRESENTE EN LA CIUDAD DE TUXTLA GUTIÉRREZ, CHIAPAS; A LOS $fechaDiaActual DIAS DEL MES DE $fechaMesActual DEL $fechaAnioActual </span> </div></td>
  </tr>
  
  
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='12'><center><div align='center' class='Estilo2'>ATENTAMENTE</div></center></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='12'><center><div align='center' class='Estilo2'>$lemaescuela</div></center></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='12'><center><div align='center' class='Estilo3'><strong>MTRO. FILEMON CORZO NAÑEZ</strong></div></center></td>
  </tr>
  <tr>
    <td colspan='12'><center><div align='center' class='Estilo2'>DIRECTOR DE POSGRADO</div></center></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='3'><span class='Estilo4'>&nbsp;</span></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
 
  <tr>
    <td colspan='12'><div align='center' class='Estilo1'>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
    </div></td>
  </tr>

</table>
</body>
</html>";
}
       
        
        
    }
} else {
    $html = "Lo Sentimos No Se Pudo Realizar la Consulta";
}
ob_start();
$mpdf = new mPDF();
//$mpdf->AddPage('L', '', '', '', '', '', '', '', '', '', '');
$mpdf->WriteHTML($html);
$mpdf->Output("Dictamen_Maestria_" . $today .".pdf", 'D');

?> 

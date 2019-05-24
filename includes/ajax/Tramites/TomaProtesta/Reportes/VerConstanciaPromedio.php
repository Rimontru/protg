<?php

require_once("../../../../../includes/Config.class.php");  # Cargar datos conexion y otras variables.
require_once('../../../../../includes/DB.class.php');
require_once('../../../../../includes/ConsultaDB.class.php');
require_once('../../../../../includes/MisFunciones.class.php');
require_once('../../../../../mpdf/mpdf.php');


$Obras = new ConsultaDB;
$Funciones = new MisFunciones;
$today = date("d-m-Y");

//obtenemos fecha actual y cambiamos el formato de vista
$fechaActual =  strftime("%Y-%m-%d", time());
$fechaActualModificar = explode("-", $fechaActual);
$fechaActualLista = $fechaActualModificar[0] . "-" . $fechaActualModificar[1] . "-" . $fechaActualModificar[2];
$fechaLetras = $Funciones->Fecha2Mayusculas($fechaActualLista);

$fechaDividir = explode("DE", $fechaLetras);
$fechaDia = $fechaDividir[0];
$fechaMes = $fechaDividir[1];
$fechaAnio = $fechaDividir[2];


if (isset($_GET['pk_alumno'])) {


    $pk_alumno = $_GET['pk_alumno'];
    $CicloEscolarPromt =strtoupper($_GET['CicloEscolarPromt']);


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






    $result = $Obras->ConReporteDocumentacionAlumnosPorLlavePrimaria($pk_alumno);
    while ($row = mysql_fetch_assoc($result)) {


        $tomaprotestaLetras = $Funciones->Fecha2Mayusculas($row[FechaTomaProtesta]);
        $fechaLista = ($row[FechaTomaProtestaReporte]);
        $turno=strtoupper($row[NombreTurno]);


        $fk_carreras=$row[fk_carreras];
      $Result22 = $Obras->verTrabajadoresDirectoresReportes($fk_carreras);
    if ($Result22) {
        $row222 = mysql_fetch_assoc($Result22);
        $nombreDirector=  ($row222[nombre]." ".$row222[apaterno]." ".$row222[amaterno]);
        $carreraReporte=  ($row222[nombreCarrera]);
        $genero = $row222[fk_genero];
        mysql_free_result($Result22);
    }


$letraPromedio=strtoupper($row[letraPromedio]);

//fk_genero 2=MUJER
        if ($genero == "2") {


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
    <td colspan='8'><center><div align='center'><strong>$nombreInstitucion</strong></div></center></td>
    <td colspan='2' rowspan='6'><div align='center'><img src='../../../../../assets/img/fimpes.png' width='107' height='109' /></div></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong> </strong></div></center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>INCORPORADO A LA  SECRETARIA DE EDUCACION</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>OFICIO No. $numerooficio DE FECHA $fechaIncorporacionsecretaria</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>REGIMEN: $regimen  CLAVE: </strong><strong>$clave</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>EXCELENCIA ACADEMICA: REG. $registro  </strong></div>
    </center></td>
  </tr>
  <tr>
    <td width='105'>&nbsp;</td>
    <td width='39'>&nbsp;</td>
    <td colspan='8'><center>
      <div align='center'><span class='Estilo3'> <strong><span class='Estilo2'>$carreraReporte</span></strong></span></div>
    </center></td>
    <td width='53'>&nbsp;</td>
    <td width='79'>&nbsp;</td>
  </tr>

  <tr>
    <td width='105' height='103'>&nbsp;</td>
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
    <td colspan='8'  align='right'><div align='right' class='Estilo2'>ASUNTO: CONSTANCIA </div></td>
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
    <td colspan='4' align='right'><div align='right' class='Estilo2'></div></td>
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
    <td colspan='6'><span class='Estilo3'><strong>A QUIEN CORRESPONDA:</strong></span></td>
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
    <td height='70' colspan='12' align='justify'><span class='Estilo3'>LA SUSCRITA DIRECTORA DE LA ";

            if ($row[fk_nivelestudio] == "3") {

                $html.= " MAESTRIA DE <strong>$row[nombreCarrera]</strong> ";
            }

            if ($row[fk_nivelestudio] != "3") {

                $html.= " CARRERA DE <strong>$row[nombreCarrera]</strong> ";
            }



            $html.= "DEL $nombreInstitucion CON CLAVE $clave</span></td>
                
  </tr> 
         
  <tr>
    <td height='22'>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan='5'><center><div align='center' class='Estilo5'>HACE CONSTAR </div></center></td>
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
    <td height='52' colspan='12' align='justify'><div align='justify'>
      <p class='Estilo3'><span class='Estilo3'>QUE SEGUN DOCUMENTOS QUE OBRAN EN EL ARCHIVO DEL MISMO QUE LA ALUMNO(A) <span class='Estilo2'>$row[NombreAlumno] $row[ApaternoAlumno] $row[AmaternoAlumno]</span> ,CON NUMERO DE CONTROL <span class='Estilo2'> $row[matricula] </span> CURSO Y APROBO LA <span class='Estilo2'>$carreraReporte</span> EN EN EL TURNO <span class='Estilo2'>$turno, </span> EN EL CICLO ESCOLAR  <span class='Estilo2'>$CicloEscolarPromt</span>, NO SUSTENTO</span> NINGUN EXAMEN DE REGULARIZACION EN EL SEMESTRE, OBTENIENDO UN PROMEDIO GENERAL DE <strong>$row[promedio] ($letraPromedio).</strong></p>
      </div></td>
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
    <td height='61' colspan='12' align='justify'><div align='justify'><span class='Estilo3'>A PETICION DE LA PARTE INTERESADA Y PARA LOS USOS LEGALES QUE MEJOR CONVENGAN SE EXTIENDE LA </span><span class='Estilo3'>PRESENTE EN LA CIUDAD DE $ciudad., CAPITAL DEL ESTADO DE $estado A LOS<span class='Estilo2'> $fechaDia</span>DIAS DEL MES DE <span class='Estilo2'> $fechaMes</span>DEL AÑO </span><span class='Estilo2'> $fechaAnio</span> </div></td>
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
    <td colspan='12'><center><div align='center' class='Estilo3'><strong>$nombreDirector</strong></div></center></td>
  </tr>
  <tr>
    <td colspan='12'><center><div align='center' class='Estilo2'>DIRECTORA</div></center></td>
  </tr>
   
  <tr>
    <td colspan='3'>&nbsp;</td>
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
      <p>$direccion. TELS. $telefono $ciudad, $estado</p>
      <p>$paginainternet</p>
    </div></td>
  </tr>
</table>
</body>
</html>";
        }

        if ($genero == "1") {


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
    <td colspan='8'><center><div align='center'><strong>$nombreInstitucion</strong></div></center></td>
    <td colspan='2' rowspan='6'><div align='center'><img src='../../../../../assets/img/fimpes.png' width='107' height='109' /></div></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong> </strong></div></center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>INCORPORADO A LA  SECRETARIA DE EDUCACION</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>OFICIO No. $numerooficio DE FECHA $fechaIncorporacionsecretaria</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>REGIMEN: $regimen  CLAVE: </strong><strong>$clave</strong></div>
    </center></td>
  </tr>
  <tr>
    <td colspan='8'><center><div align='center'><strong>EXCELENCIA ACADEMICA: REG. $registro  </strong></div>
    </center></td>
  </tr>
  <tr>
    <td width='105'>&nbsp;</td>
    <td width='39'>&nbsp;</td>
    <td colspan='8'><center>
      <div align='center'><span class='Estilo3'> <strong><span class='Estilo2'>$carreraReporte</span></strong></span></div>
    </center></td>
    <td width='53'>&nbsp;</td>
    <td width='79'>&nbsp;</td>
  </tr>

  <tr>
    <td width='105' height='103'>&nbsp;</td>
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
    <td colspan='8'  align='right'><div align='right' class='Estilo2'>ASUNTO: CONSTANCIA </div></td>
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
    <td colspan='4' align='right'><div align='right' class='Estilo2'></div></td>
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
    <td colspan='6'><span class='Estilo3'><strong>A QUIEN CORRESPONDA:</strong></span></td>
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
    <td height='70' colspan='12' align='justify'><span class='Estilo3'>EL SUSCRITO DIRECTOR DE LA ";

            if ($row[fk_nivelestudio] == "3") {

                $html.= " MAESTRIA DE <strong>$row[nombreCarrera]</strong> ";
            }

            if ($row[fk_nivelestudio] != "3") {

                $html.= " CARRERA DE <strong>$row[nombreCarrera]</strong> ";
            }



            $html.= "DEL $nombreInstitucion CON CLAVE $clave</span></td>
                
  </tr> 
         
  <tr>
    <td height='22'>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan='5'><center><div align='center' class='Estilo5'>HACE CONSTAR </div></center></td>
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
    <td height='52' colspan='12' align='justify'><div align='justify'>
      <p class='Estilo3'><span class='Estilo3'>QUE SEGUN DOCUMENTOS QUE OBRAN EN EL ARCHIVO DEL MISMO QUE LA ALUMNO(A) <span class='Estilo2'>$row[NombreAlumno] $row[ApaternoAlumno] $row[AmaternoAlumno]</span> ,CON NUMERO DE CONTROL <span class='Estilo2'> $row[matricula] </span> CURSO Y APROBO LA LICENCIATURA <span class='Estilo2'>$carreraReporte</span> EN EN EL TURNO <span class='Estilo2'>$turno, </span> EN EL CICLO ESCOLAR  <span class='Estilo2'>$CicloEscolarPromt</span>, NO SUSTENTO</span> NINGUN EXAMEN DE REGULARIZACION EN EL SEMESTRE, OBTENIENDO UN PROMEDIO GENERAL DE <strong>$row[promedio] ($letraPromedio).</strong></p>
      </div></td>
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
    <td height='61' colspan='12' align='justify'><div align='justify'><span class='Estilo3'>A PETICION DE LA PARTE INTERESADA Y PARA LOS USOS LEGALES QUE MEJOR CONVENGAN SE EXTIENDE LA </span><span class='Estilo3'>PRESENTE EN LA CIUDAD DE $ciudad., CAPITAL DEL ESTADO DE $estado A LOS<span class='Estilo2'> $fechaDia</span>DIAS DEL MES DE <span class='Estilo2'> $fechaMes</span>DEL AÑO </span><span class='Estilo2'> $fechaAnio</span> </div></td>
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
    <td colspan='12'><center><div align='center' class='Estilo3'><strong>$nombreDirector</strong></div></center></td>
  </tr>
  <tr>
    <td colspan='12'><center><div align='center' class='Estilo2'>DIRECTOR</div></center></td>
  </tr>
   
  <tr>
    <td colspan='3'>&nbsp;</td>
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
      <p>$direccion. TELS. $telefono $ciudad, $estado</p>
      <p>$paginainternet</p>
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
$mpdf->Output("Reporte_VerConstanciaPromedio_" . $today.".pdf", 'I');

?> 
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
$today = date("d-m-Y");

if (isset($_GET['pk_alumno'])) {


    $pk_alumno = $_GET['pk_alumno'];
    $fk_nivelestudio = $GET['fk_nivelestudio'];

  
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
$fechaDia = convertir($fechaDividir[0]);
$fechaMes = $fechaDividir[1];
$fechaAnio = convertir($fechaDividir[2]);

$xxx = explode(" ", $fechaAnio);
$fechaAnioProtestaListo=$xxx[2];


    $result = $Obras->ConReporteDocumentacionAlumnosPorLlavePrimaria($pk_alumno);
    while ($row = mysql_fetch_assoc($result)) {

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

//fk_genero 2=MUJER
if($genero == "2"){
	


$html = '

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo1 {
	font-size: 12px;
	font-weight: bold;
	font-family:"Times New Roman", Georgia, Serif;
	line-height: 2.0; 
	font-size: 18px;
	text-align:justify;
	
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



<div class="Estilo1">DISTINGUIDO JURADO<br/>
			SUSTENTANTE PÚBLICO EN GENERAL<br/><br/>

		CON EL AFECTUOSO SALUDO DE NUESTRO RECTOR EL CONTADOR PÚBLICO Y MAESTRO EN EDUCACIÓN, EMILIO ENRIQUE SALAZAR NARVÁEZ, EL INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS, A TRAVES DE SU DIRECCIÓN DE POSGRADO, LES DA LA MAS CORDIAL BIENVENIDA.
		<br/><br/>
		
		AGRADEZCO LA OPORTUNIDAD QUE ME BRINDAN PARA ESTAR PRESENTE EN ESTE EXAMEN DE GRADO QUE PRESENTA ______________________________________________________________________________________________________________________________________________________________________________ PARA OBTENER EL GRADO DE MAESTRO <u>EN LA MAESTRÍA EN '.$carreraLista.'</u> CON LA OPCIÓN DE PROMEDIO GENERAL DE CALIFICACIONES. <br/><br/>
		
		COMO ES SABIDO POR TODOS LA EDUCACIÓN ES UNA NECESIDAD URGENTE EN NUESTROS DÍAS, YA NO ES AQUELLA QUE INFORMA, SINO QUE, INVITA A PENSAR, IMAGINAR Y CREAR NUEVAS FORMAS DE CONCEBIR EL MUNDO QUE INCLUYE NUEVAS ESTRATEGIAS PARA LOS ESCENARIOS FUTUROS DE LA EDUCACIÓN EN NUESTRO PAÍS. A ELLO LA ESCUELA RESPONDE CON DESAFÍOS, PARA FOMENTAR LA CALIDAD, PORQUE ES UNA PREOCUPACIÓN Y COMPROMISO CONTINÚO VELAR POR LA FORMACIÓN DE SERES PENSANTES Y LIBRES, CAPACES DE ASUMIR UNA RESPONSABILIDAD PROPIA, EN CONDICIONES DE TENER NUEVAS OPCIONES, PARA DIRIGIR EL DESTINO DE SU ENTORNO PROFESIONAL.
				<br/><br/>
				<br/><br/>
				<br/><br/>
				
		POR ELLO LO EXHORTO A CONTINUAR PREPARÁNDOSE EN TODOS LOS ÓRDENES DE SU VIDA, Y TRABAJAR CON AHINCO Y ÉTICA, PONIENDO EN ALTO LA IMAGEN Y PRESTIGIO MDE ESTA INSTITUCIÓN.		
		<br/><br/>
		
		EN HORA BUENA Y ÉXITO EN EL PRESENTE EXAMEN.
		<br/><br/>
		
		A CONTINUACIÓN ME PERMITO PRESENTAR AL JURADO, EL CUAL ESTA INTEGRADO POR
				<br/><br/>
		
		<u>PRESIDENTE:</u> _______________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________

		<br/><br/>

		<u>SECRETARIO:</u>  _______________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________
		
		<br/><br/>

		<u>VOCAL:</u>  ______________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________


</div>
</body>
</html>';
}
$res=$html;
       
    }    
        
    
} else {
    $html = "Lo Sentimos No Se Pudo Realizar la Consulta";
}
ob_start();
$mpdf=new mPDF('','','' , '','10', '10' , '10' , '10' , '10' , '10','P'); 
 $mpdf->WriteHTML($res);

$mpdf->Output("LecturaMaestria_" . $today, 'I');

?> 

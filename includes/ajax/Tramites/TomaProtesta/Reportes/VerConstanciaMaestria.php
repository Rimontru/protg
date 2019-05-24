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

//obtenemos fecha actual y cambiamos el formato de vista
//$fechaActual = strftime("%Y-%m-%d", time());
//$fechaActual = strftime("%Y-%m-%d", time());
//$fechaActualModificar = explode("-", $fechaActual);
//$fechaActualLista = $fechaActualModificar[0] . "-" . $fechaActualModificar[1] . "-" . $fechaActualModificar[2];
//$fechaLetras = $Funciones->Fecha2Mayusculas($fechaActualLista);

//$fechaDividir = explode("DE", $fechaLetras);
//$fechaDia = $fechaDividir[0];
//$fechaMes = $fechaDividir[1];
//$fechaAnio = $fechaDividir[2];

//$fechaDividir = explode("DE", $fechaLetras);
        //$fechaDia = convertir($fechaDividir[0]);
		//$fechaDia=strtolower($fechaDia);
		//$fechaDia =ucwords($fechaDia);
		
        //$fechaMes = $fechaDividir[1];
		//$fechaMes=strtolower($fechaMes);
		//$fechaMes = ucwords($fechaMes);
		
        //$fechaAnio = convertir($fechaDividir[2]);
		//$fechaAnio=strtolower($fechaAnio);
		//$fechaAnio=ucwords($fechaAnio);

if (isset($_GET['pk_alumno'])) {


    $pk_alumno = $_GET['pk_alumno'];
    $Fojanumero = $_GET['Fojanumero'];
    $nuRegistro= $_GET['nuRegistro'];


    //DATOS DE LA ESCUELA
    $Result32 = $Obras->ConsultaDatosInsitucionConEstados();
    if ($Result32) {
        $row333 = mysql_fetch_assoc($Result32);

        $nombreInstitucion = $row333['nombreInstitucion'];
        $apodoInstitucion = $row333['apodoInstitucion'];
        $clave = $row333['clave'];
        $direccion = $row333['direccion'];
        $telefono = $row333['telefono'];
        $ciudad = $row333['CiudadEscuela'];
        $estado = $row333['EstadoEscuela'];
        $fechaIncorporacionsecretaria = $row333['fechaIncorporacionSrecetaria'];
        $numerooficio = $row333['noOficio'];
        $registro = $row333['registro'];
        $regimen = $row333['regimen'];
        $paginainternet = $row333['paginaInternet'];
        $lemaescuela = $row333['lemaEscuela'];
    }

    
    
 $fechaExpedicion = $row[fechaExpedicion];
     //  $fechaVigente
//saber si es fecha o vigente 1=fecha 2=vigente
        if($row[TipoRevoe]=='1'){
            
            $fechaVigente="FECHA ";
        }else if($row[TipoRevoe]=='2'){
            $fechaVigente="VIGENCIA ";
        }else if ($row[TipoRevoe]=='3'){
            $fechaVigente="VIGENTE";
        }else if($row[TipoRevoe]=='0'){
           $fechaVigente="COLOCAR FECHA/VIGENTE";
	}





    $result = $Obras->ConReporteDocumentacionAlumnosPorLlavePrimaria($pk_alumno);
    while ($row = mysql_fetch_assoc($result)) {


        $tomaprotestaLetras = $Funciones->Fecha2Mayusculas($row[FechaTomaProtesta]);
        $fechaLista = ($row[FechaTomaProtestaReporte]);


 //obtenemos fecha actual y cambiamos el formato de vista
        //$FechaTomaProtesta = strftime("%Y-%m-%d", time());
        $FechaTomaProtesta = $row['FechaTomaProtesta'];
        $FechaTomaProtestaModificar = explode("-", $FechaTomaProtesta);
        $FechaTomaProtestaLista = $FechaTomaProtestaModificar[0] . "-" . $FechaTomaProtestaModificar[1] . "-" . $FechaTomaProtestaModificar[2];
        $fechaLetras = $Funciones->Fecha2Mayusculas($FechaTomaProtestaLista);





        $fechaDividir = explode("DE", $fechaLetras);
        $fechaDia = strtolower (convertir($fechaDividir[0]));
        $fechaMes = strtolower (  $fechaDividir[1]);
        $fechaAnio = strtolower (convertir($fechaDividir[2]));
        //$fechaAnioProtestaListo=substr($fechaAnio, -6); //Esto devuelve "ndo"
      // $fechaAnioProtestaListo=$fechaAnio;

$xxx = explode(" ", $fechaAnio);
$fechaAnioProtestaListo=$xxx[2];




        //DATOS DEL DIRECTOR
        $fk_carreras = $row[fk_carreras];
        $Result22 = $Obras->verTrabajadoresDirectoresReportes($fk_carreras);
        if ($Result22) {
            $row222 = mysql_fetch_assoc($Result22);
            $nombreDirector = ($row222[nombre] . " " . $row222[apaterno] . " " . $row222[amaterno]);
            $carreraReporte = ($row222[nombreCarrera]);
            $genero = $row222[fk_genero];
            mysql_free_result($Result22);
        }



       //$noacuerdo = $row[noacuerdo];
       $fechaExpedicion = $row[fechaExpedicion];
 



         $apaterno = mb_strtolower($row[ApaternoAlumno],'UTF-8');
		 $apaterno = ucwords($apaterno);

         $amaterno = mb_strtolower($row[AmaternoAlumno],'UTF-8');
		 $amaterno = ucwords($amaterno);
		 
         $nombre = mb_strtolower($row[NombreAlumno],'UTF-8');
		 $nombre = ucwords($nombre);
		 
         $curp = $row[curp];
         $matricula = $row[matricula];
         $planestudio = $row[PlanEstudiosNombre];
         $promedio = $row[promedio];
         $letraPromedio = $row[letraPromedio];
        
        
         //sinodales
         $presidente = mb_strtolower( $row[NombrePresidente],'UTF-8');
		 $presidente = ucwords($presidente);
         $cedula1 = $row[CedulaPresidente];
         
         $secretario = mb_strtolower($row[NombreSecretario],'UTF-8');
		 $secretario = ucwords($secretario);
         $cedula2 = $row[CedulaSecretario];
                 
         $vocal = mb_strtolower( $row[NombreVocal],'UTF-8');
		 $vocal = ucwords($vocal);
         $cedula3 = $row[CedulaVocal];
                 
         $suplente = mb_strtolower($row[NombreSuplente],'UTF-8');
		 $suplente = ucwords($suplente);
         $cedula4  = $row[CedulaSuplente];
         
         
         
         
//FECHA DE SOLICITUD $fechasolicitud
$fechasolicitud = $row[FechaSolicitud];
//FECHA EXAMEN 
$fechaListaProtesta= $row[FechaExamen];
//TOMA DE PROTESTA 
$fechaLista= $row[FechaTomaProtestaReporte];

$hora = $row[hora];
$duracion = $row[DescripcionDuracion];
$autorizacion = $row[NumeroAutorizacion];
            
//HORA
$hora =$row[hora];
$horaDividir = explode(":",$hora);
$horaHora=$horaDividir[0];
$horaMinuto = $horaDividir[1];


$horaListo =strtolower ( convertir($horaHora));
$horaMinutoListo = strtolower (convertir($horaMinuto));
$hora =strtolower($horaListo." ".$horaMinutoListo);
$hora=strtolower ($hora);        
            
//ExamenExtraOrdinario        
     
if($row[ExamenExtraOrdinario]=="1"){
    
    $opcionExtraSi="X";
     $opcionExtraNo="";
}
if($row[ExamenExtraOrdinario]=="2"){
     $opcionExtraNo="X";
    $opcionExtraSi="";
}

//fk_carreras
//ingeniero constructor     INGENIERO ZOOTECNISTA ADMINISTRADOR            //sistemas                           civil                       ///medico
//if($row[fk_carreras]=="6" || $row[fk_carreras]=="7"  || $row[fk_carreras]=="11" || $row[fk_carreras]=="27" || $row[fk_carreras]=="13"  || $row[fk_carreras]=="12"){
    
//    $carrera=$row[nombreCarrera];
//}else if($row[fk_carreras]=="2" || $row[fk_carreras]=="29"){
//	$carrera=$row[nombreCarrera];
//}else{
//    $carrera="LICENCIADO EN ".$carrera;
    
//}



$opcionTitulacion=strtoupper($row[NombreOpcionTitulacion]);
$folioActa = $row[FolioActa];
$noActaExamen=$row[noActaExamen];
$noactaTitulo=$row[noactatitulo];
$autorizacion = $row[NumeroAutorizacion];
$NumAutorizacion=substr($autorizacion, -4); //Esto devuelve "ndo"
$fecha=$row[FechaTomaProtesta];
$fecha1 = $Funciones->Fecha3($fecha);
$noAcuerdo=$row[noacuerdo];
$salonListo=strtolower($row[salon]);

$turno=strtolower($row[NombreTurno]);



$letra=substr($noactaTitulo, -7,1);
$numero=substr($noactaTitulo, -5);


if( $fk_carreras =="1" ||  $fk_carreras =="2"  ||  $fk_carreras =="3" ||  $fk_carreras =="4" ||  $fk_carreras =="5"  ||  $fk_carreras =="6"||  $fk_carreras =="7"  ||  $fk_carreras =="9" ||  $fk_carreras =="10" ||  $fk_carreras =="11"  ||  $fk_carreras =="12"||  $fk_carreras =="13"||  $fk_carreras =="14"  ||  $fk_carreras =="15" ||  $fk_carreras =="20" ||  $fk_carreras =="22"  ||  $fk_carreras =="24" ||  $fk_carreras =="25"  ||  $fk_carreras =="27" ||  $fk_carreras =="29" ||  $fk_carreras =="30"){
	
$hola=explode(" ", $fechaExpedicion );

    $fechaExpedicion0=$hola[0];
    $fechaExpedicion2=$hola[2];
    $fechaExpedicion4=$hola[4];
    $fechaExpedicion1=$hola[1];
    $fechaExpedicion3=$hola[3];
    $fechaExpedicion5=$hola[5];
	

}else if( $fk_carreras =="16" ||  $fk_carreras =="12" ||  $fk_carreras =="19"  ||  $fk_carreras =="21" ||  $fk_carreras =="23" ||  $fk_carreras =="26"  ||  $fk_carreras =="22"){
	 $hola=explode(" ", $fechaExpedicion );
     
	 $fechaExpedicion5=$hola[5];

}else{
	$hola=explode(" ", $fechaExpedicion );
	
     $carreraReporte=$hola[2]." ".$hola[3];
    
}


$fechaVigente=strtolower($fechaVigente);
$fechaExpedicion1=strtolower($fechaExpedicion1);
$fechaExpedicion2=strtolower($fechaExpedicion2);



if( $fk_carreras =="11" ||  $fk_carreras =="12"  ||  $fk_carreras =="12" ||  $fk_carreras =="21"){
	
$hola=explode(" ", $noAcuerdo );

    $noAcuerdo0=$hola[0];
    $noAcuerdo1=$hola[1];
    $noAcuerdo2=$hola[2];
    $noAcuerdo3=$hola[3];
    $noAcuerdo4=$hola[4];
    $noAcuerdo5=$hola[5];


}else if( $fk_carreras =="1" ||  $fk_carreras =="2" ||  $fk_carreras =="7"  ||  $fk_carreras =="2"){
	 $hola=explode(" ", $noAcuerdo );
     
	 $fechaExpedicion5=$hola[5];

}else{
	$hola=explode(" ", $$noAcuerdo );
	
     $carreraReporte=$hola[2]." ".$hola[3];
    
}

$titulo = strtolower_ga($row[nombreTitulo],'UTF-8');         


	$carrera=$row[nombreCarrera];
	
	$xxx = explode(" ", $carrera);
	
	$carreraLista=strtolower_ga($car=$xxx[2] ." ".$car=$xxx[3] ." ".$car=$xxx[4] ." ". $car=$xxx[5] ." ". $car=$xxx[6] ." ". $car=$xxx[7] ." ". $car=$xxx[8] ." ". $car=$xxx[9] ." ". $car=$xxx[10]);



            $html = '
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo1 {
	font-size: 20px;
	font-family:Arial ;
		font-weight:900;

}
.Estilo2 {
	font-size: 18px;
	font-family:Arial ;
	font-weight:900;
}
.Estilo3 {font-size: 16px;
	font-family:Arial ;
	font-weight:900;}
.Estilo4 {
	font-size: 18px;
	font-family:Arial;
	font-weight: bold;
}
.Estilo5 {
	font-size: 12px;
	font-weight: bold;
}
.Estilo6 {
	font-size: 12px;
	font-weight:;
}
.Estilo7 {
	font-size: 12px;
	font-weight:;
	font-family:Arial;
}
-->
</style>
</head>

<body>

	<div class="logo" style="position: absolute; left: 40px; top: 100px;"><img src="../../../../../assets/img/IESCH.png" width="115" height="115" /></div>

	<div class="logo" style="position: absolute; left: 640px; top: 100px;"><img src="../../../../../assets/img/maestria.jpg" width="115" height="115" /></div>
	
		<div class="Estilo7" style="position: absolute; left: 40px; top: 215px; ">CLAVE: '.$clave.'</div>

<table width="100%" height="1050" border="0" cellSpacing="0" cellPadding="0" align="" >
	<tr><td align="center" colspan="2" class="Estilo1">SECRETARIA DE EDUCACIÓN</td></tr>
	<tr><td align="center" colspan="2" class="Estilo2">SUBSECRETARÍA DE EDUCACIÓN ESTATAL</td></tr>
	<tr><td align="center" colspan="2" class="Estilo3">DIRECCIÓN DE EDUCACIÓN SUPERIOR</td></tr>
	<tr><td align="center" colspan="2" class="Estilo3">DEPARTAMENTO DE SERVICIOS ESCOLARES Y BECAS</td></tr>
	<tr><td align="center" colspan="2" class="Estilo3">INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS</td></tr>
	<tr><td align="center" colspan="2" class="Estilo3">DIRECCIÓN DE POSGRADO</td></tr>
	<tr><td align="center" colspan="2" class="Estilo4"><strong>CONSTANCIA</strong></td></tr>
	<tr><td align="center" colspan="2">&nbsp;</td></tr>
	<tr><td align="center">Acta de examen de grado No. <strong>'.$noActaExamen.'</strong></td><td align="center">No. De autorización: <strong>'.$autorizacion.'</strong></td></tr>
	<tr><td align="center" colspan="2">&nbsp;</td></tr>
	<tr><td align="justify" colspan="2">En la ciudad de Tuxtla Gutiérrez, Chiapas, siendo las '.$hora.' horas del día '.$fechaDia.' del mes de ' . $fechaMes. ' del ' . $fechaAnio. ', en el salón de '.$salonListo.' del Instituto de Estudios Superiores de Chiapas, con clave 07PSU0002D, turno '.$turno.', se reunió el jurado integrado por los cc:</td></tr>
	<tr><td align="center" colspan="2">&nbsp;</td></tr>
	<tr><td align="center">Presidente:<strong> '.$presidente.'</strong></td><td align="center"> Secretario: <strong>'.$secretario.'</strong></td></tr>
	<tr><td align="center" colspan="2">&nbsp;</td></tr>
	<tr><td align="center" colspan="2">Vocal:<strong> '.$vocal.'</strong></td></tr>
	<tr><td align="center" colspan="2">&nbsp;</td></tr>
	<tr><td align="justify" colspan="2">Para realizar el examen de grado del (de la) c. <u><strong>'.$nombre.' '.$apaterno.' '.$amaterno.'</strong></u> con número de control <strong>'.$matricula.'</strong> a quien se examinó con base a la opción de promedio general de calificaciones <strong>('.$promedio.')</strong> Para obtener el grado académico de: <strong>'.$titulo.'.</strong></td></tr>
	<tr><td align="center" colspan="2">&nbsp;</td></tr>
	<tr><td align="justify" colspan="2">Se procedió a efectuar el acto de acuerdo a las normas establecidas por la dirección de Educación Superior de la Subsecretaría de Educación Estatal, una vez concluido el examen el jurado deliberó sobre los conocimientos y aptitudes demostradas y determinó:</td></tr>
	<tr><td align="center" colspan="2">&nbsp;</td></tr>
	<tr><td align="center" colspan="2"><strong><u>APROBARLO</u></strong></td></tr>
	<tr><td align="center" colspan="2">&nbsp;</td></tr>
	<tr><td align="justify" colspan="2">A continuación el presidente del jurado comunico al (a la) C. sustentante el resultado obtenido y le tomo la protesta de ley, en los términos siguientes:</td></tr>
	<tr><td align="center" colspan="2">&nbsp;</td></tr>
	<tr><td align="justify" colspan="2" style="font-style:"><strong><i>¿Protesta usted ejercer su profesión de Maestro (a) en '.$carreraLista.' con entusiasmo y honradez, velar siempre por el prestigio y buen nombre de esta escuela y continuar esforzándose por mejorar su preparación en todos los órdenes, para garantizar los intereses del pueblo y la patria?</i></strong></td></tr>
	<tr><td align="center" colspan="2">&nbsp;</td></tr>
	<tr><td align="center" colspan="2"><strong>¡SI PROTESTO!</strong></td></tr>
	<tr><td align="center" colspan="2">&nbsp;</td></tr>
	<tr><td align="center" colspan="2"><strong>'.$nombre.' '.$apaterno.' '.$amaterno.'</strong></td></tr>
	<tr><td align="center" colspan="2">&nbsp;</td></tr>
</table>

<table width="100%" height="1050" border="0" cellSpacing="0" cellPadding="0" align="" style="border-bottom:1px solid #000;" >
	<tr><td align="center" colspan="0">&nbsp;</td><td align="center" colspan="0">&nbsp;</td><td align="center" colspan="0">&nbsp;</td></tr>
	<tr><td align="center" colspan="0"><strong>Presidente</strong></td><td align="center" colspan="0"><strong>Secretario</strong></td><td align="center" colspan="0"><strong>Vocal</strong></td></tr>
		<tr><td align="center" colspan="3">&nbsp;</td></tr>
	<tr ><td align="center" colspan="0" class="Estilo5"><strong>'.$presidente.'</strong></td><td align="center" colspan="0" class="Estilo5"><strong>'.$secretario.'</strong></td><td align="center" colspan="0" class="Estilo5"><strong>'.$vocal.'</strong></td></tr>
</table>

<table width="100%" height="1050" border="0" cellSpacing="0" cellPadding="0" align="">
	<tr><td align="center" colspan="2">&nbsp;</td></tr>
	<tr><td align="center" colspan="2" class="Estilo6">BLVD.PASÓ LIMON N° 244 TELS. 614-04-18, 614-16-21 Y 614-04-19 TUXTLA GUTIERREZ, CHIAPAS</td></tr>
	<tr><td align="center" colspan="2">www.iesch.edu.mx</td></tr>
	
	</table>
	


</body>
</html>';
        }
    
} else {
    $html = "Lo Sentimos No Se Pudo Realizar la Consulta";
}
ob_start();
$mpdf=new mPDF('','','' , '','10', '10' , '15' , '10' , '10' , '10','P'); 
 $mpdf->WriteHTML($html);

$mpdf->Output("ConstanciaMaestria_" . $today .".pdf", 'I');

?> 
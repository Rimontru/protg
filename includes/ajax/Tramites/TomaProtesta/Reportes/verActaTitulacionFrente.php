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
$fechaActual = strftime("%Y-%m-%d", time());
$fechaActualModificar = explode("-", $fechaActual);
$fechaActualLista = $fechaActualModificar[0] . "-" . $fechaActualModificar[1] . "-" . $fechaActualModificar[2];
$fechaLetras = $Funciones->Fecha2Mayusculas($fechaActualLista);

$fechaDividir = explode("DE", $fechaLetras);
$fechaDia = $fechaDividir[0];
$fechaMes = $fechaDividir[1];
$fechaAnio = $fechaDividir[2];


if (isset($_GET['pk_alumno'])) {


    $pk_alumno = $_GET['pk_alumno'];
    $CicloEscolarPromt = $_GET['CicloEscolarPromt'];


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

    
    




    $result = $Obras->ConReporteDocumentacionAlumnosPorLlavePrimaria($pk_alumno);
    while ($row = mysql_fetch_assoc($result)) {


        //$tomaprotestaLetras = $Funciones->Fecha2Mayusculas($row[FechaTomaProtesta]);
        //$fechaLista = ($row[FechaTomaProtestaReporte]);



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



       $noacuerdo = $row[noacuerdo];
       $fechaExpedicion = $row[fechaExpedicion];
     //  $fechaVigente
//saber si es fecha o vigente 1=fecha 2=vigente
        if($row[TipoRevoe]=='1'){
            
            $fechaVigente="FECHA ";
        }else if($row[TipoRevoe]=='2'){
            $fechaVigente="VIGENTE ";
        }
        
         $apaterno = $row[ApaternoAlumno];
         $amaterno= $row[AmaternoAlumno];
         $nombre= $row[NombreAlumno];
         $curp = $row[curp];
         $matricula = $row[matricula];
         $planestudio = $row[PlanEstudiosNombre];
         $promedio = $row[promedio];
         $letraPromedio = $row[letraPromedio];
        
        
         //sinodales
         $presidente = $row[NombrePresidente];
         $cedula1= $row[CedulaPresidente];
         
         $secretario= $row[NombreSecretario];
         $cedula2= $row[CedulaSecretario];
                 
         $vocal= $row[NombreVocal];
         $cedula3= $row[CedulaVocal];
                 
         $suplente= $row[NombreSuplente];
         $cedula4  = $row[CedulaSuplente];
         
         
         
         
//FECHA DE SOLICITUD $fechasolicitud
//$fechasolicitud = $row[FechaSolicitud];
//FECHA EXAMEN 
//$fechaListaProtesta= $row[FechaExamen];
//TOMA DE PROTESTA 
//$fechaLista= $row[FechaTomaProtestaReporte];

$hora = $row[hora];
$duracion = $row[DescripcionDuracion];
$autorizacion = $row[NumeroAutorizacion];


 //$tomaprotestaLetras = $Funciones->Fecha2Mayusculas($row[FechaTomaProtesta]);
        //$fechaLista = ($row[FechaTomaProtestaReporte]);

        //obtenemos fecha actual y cambiamos el formato de vista
        //$FechaTomaProtesta = strftime("%Y-%m-%d", time());
        $FechaExpedicionTitulo = $row['fechaexpediciontitulo'];
        $FechaExpedicionTituloModificar = explode("-", $FechaExpedicionTitulo);
        $FechaExpedicionTituloLista = $FechaExpedicionTituloModificar [0] . "-" . $FechaExpedicionTituloModificar [1] . "-" . $FechaExpedicionTituloModificar [2];
        $fechaLetras = $Funciones->Fecha2Mayusculas($FechaExpedicionTituloLista );





        $fechaDividir = explode("DE", $fechaLetras);
        $fechaDia = convertir($fechaDividir[0]);
        $fechaMes = $fechaDividir[1];
        $fechaAnio = convertir($fechaDividir[2]);
        //$fechaAnioProtestaListo=substr($fechaAnio, -6); //Esto devuelve "ndo"
      // $fechaAnioProtestaListo=$fechaAnio;

$xxx = explode(" ", $fechaAnio);
$fechaAnioProtestaListo=$xxx[2];

$fechaanio=strtolower($fechaAnioProtestaListo);            
$fechaDia =strtolower($fechaDia);            
$fechaMes =strtolower($fechaMes);            
            
$expe=$row[fechaexpediciontitulo];   

         
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
if($row[fk_carreras]=="6" || $row[fk_carreras]=="7"  || $row[fk_carreras]=="11" || $row[fk_carreras]=="27" || $row[fk_carreras]=="13"  || $row[fk_carreras]=="12"){
    
    $carrera=$row[nombreCarrera];
}else if($row[fk_carreras]=="2" || $row[fk_carreras]=="29"){
	$carrera=$row[nombreCarrera];
}else{
    $carrera="LICENCIADO EN ".$carrera;
    
}
 

$opcionTitulacion=$row[NombreOpcionTitulacion];
//$opcionTitulacion=$row[NombreOpcionTitulacion];

//$titulo=row[nombreTitulo];
//$titulo=$row[nombreTitulo];

$titulo=strtolower_ga($row[nombreTitulo]);



$titulo2 =strtolower($titulo);
$titulo2 =ucwords($titulo2);


//
//    $fechaActual = strftime("%Y-%m-%d", time());
//
//    $fechaActualModificar = explode("-", $fechaActual);
//    $fechaActualLista = $fechaActualModificar[0] . "-" . $fechaActualModificar[1] . "-" . $fechaActualModificar[2];
//
//    $fechaLetras = fechaATexto($fechaActualLista, 'u'); // Devuelve '10 DE AGOSTO DE 1981'
//
//        $fechaDividir = explode("DE", $fechaLetras);
//        $fechaDia = $fechaDividir[0];
//        $fechaMes = $fechaDividir[1];
//        $fechaAnio = $fechaDividir[2];
//        
//        
//
//        $fechaDia = strtolower(convertir($fechaDia));
//        $fechaMes = strtolower($fechaMes);
//        $fechaAnio = strtolower(convertir($fechaAnio));
//        
//
//$fechaDividir = explode("DE", $fechaLetras);
//$fechaDiaProtesta = convertir($fechaDividir[0]);
//$fechaMesProtesta=$fechaDividir[1];
//$fechaAnioProtesta=convertir($fechaDividir[2]);
//    $fechaAnioProtestaListo=substr($fechaAnioProtesta, -5); //Esto devuelve "ndo" 
//
//$NombreTituloShido = ucwords(strtolower($nombreTitulo));    
   
  //comparamos el salon

     if(is_numeric ($salon)==true){
         
         $salonListo=$salon;
     }else{
         $salonListo="DE ".$salon;
         
     }
    
    $html = ' 
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" media="print,screen" />
<link href="../cssTitulo.css" rel="stylesheet" type="text/css"  />
<style type="text/css">


root { 
    display: block;
}

.Estilo1 {font-size: 24px; font-weight:bold; font-family: Arial;
}
.Estilo2 {font-size: 22px; font-weight:bold; font-family: Arial;
}
.Estilo3 {font-size: 16px; font-weight:; font-family: Arial;
}
.Estilo4{font-size: 18x; word-spacing: -1.5pt;

}
.Estilo5{font-size: 18x; 
}

.Estilo11 {font-size: 16px; font-weight: ; font-family: Vladimir Script;
}
.fuente_titulo {
	font-family: Arial;
	font-size: 35px;
}
.fuente_titulo1 {
	font-family: Vivaldi;
	font-size: 30px;
}
.cuerpo_titulo {
	font-family: Arial;
	font-size: 16px;
	font-weight: ;
	word-spacing:;
letter-spacing: ;

}
.cuerpo_titulo3 {
	font-family: SnellRoundhand Script;
	font-size:24px;
	letter-spacing:;
	word-spacing: -0.8pt;


}
.nombre_sustentante {
	font-family:Bodoni MT Condensed,Bodoni MT;
	font-size: 22px; 
}
.nombre_gober {
	font-family:Bodoni MT Condensed,Bodoni MT;
	font-size: 50px; 
}
.nombre_institucion{
	font-family: Bodoni MT Condensed,Bodoni MT;
	letter-spacing: .5px;
	font-size: 31px;
}
.nombre_titulo{
	font-family:Bodoni MT Condensed,Bodoni MT;
	letter-spacing: 5pt;
	font-size: 40px;

}

.grado {
	font-family: Old English Text MT;
	font-size: 35px;
 
}

.pie_firma {
	font-family: Old English Text MT;
	font-size: 25px;
	letter-spacing: 4px;
        text-align:left
}
.fraccion{
	font-family:Maiandra GD;
	font-size: 20px;
}

.secret {
	font-family: Times New Roman, Times, serif;
}
.instituto {
	font-family: Times New Roman, Times, serif;
	font-size: 20px;
}
.registro_pie {
	font-family: Vladimir Script;
	font-size: 20px;
}
.folio_tit {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 20px;
}
.folio_tit strong {
	color: #F00;
}
.pie_pag {
	font-family: Freestyle Script;
	font-size: 10px;
}
</style>



</head>

<body>
	<header id="header">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<center class="">
							<div align="center" class="" colspan="2" rowspan="3"><img src="../../../../../assets/img/EscudoIesch.png" width="130" height="" /></div>
					  </center>

			  		</td>
					<td>
						<center class="Estilo1" colspan="8">
							<div align="center" class="">INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS</div>
					  </center>
			  		</td>

		  		</tr>
		  		
		  		
		  	</table>
	 	</header> <!-- end of header bar -->
	 	
			<table width="100%" border="0" cellpadding="0" cellspacing="0">

		  		
		  		<tr>
					<td width="0">&nbsp;</td>
								  	
				</tr>

		  		<tr>
					<td width="0">&nbsp;</td>
								  	
				</tr>

		  		<tr>
					<td width="0" class="Estilo2" align="center">ACTA DE EXAMEN PROFESIONAL</td>
								  	
				</tr>
				<tr>
					<td width="0">&nbsp;</td>
								  	
				</tr>
				<tr>
					<td width="0">&nbsp;</td>
								  	
				</tr>
				<tr>
					<td width="0" class="Estilo3" align="Justify">En la ciudad de Tuxtla Gutiérrez, Chiapas siendo las <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
													horas del día <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
								  					del mes de <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
								  					del <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
								  					se reunieron los miembros del jurado para proceder a efectuar la evaluación del C <U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
								  					para obtener el título de <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>,
								  					en el Instituto de Estudios Superiores de Chiapas con reconocimiento de validez oficial de la Secretaría de Educación del Estado de Chiapas, según Acuerdo Nº <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
								  					de fecha <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>.</td>
				</tr>
				<tr>
					<td width="0">&nbsp;</td>
								  	
				</tr>
				<tr>
					<td width="0">&nbsp;</td>
								  	
				</tr>
				<tr>
					<td width="0" class="Estilo3" align="Justify">
					Una vez concluido el examen el jurado delibero sobre los conocimientos y aptitudes demostradas y determino <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
					</td>

			  	
			  	<tr>
			  	
				<tr>
					<td width="0" class="Estilo3" align="Justify">
					El presidente del jurado le dio a conocer el resultado y procedió a tomar la protesta de Ley.
					</td>

			  	
			  	<tr>
			  	<tr>
					<td width="0">&nbsp;</td>
								  	
				</tr>
				<tr>
					<td width="0">&nbsp;</td>
								  	
				</tr>

				</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="Estilo3">
<tr>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
								  	
				<tr>

				<tr class="">
					<td width="0" colspan="3"  align="center">Presidente</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0" colspan="3"  align="center">Secretario</td>
					
								  	
				<tr>
				<tr>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
								  	
				<tr>
				<tr>
					<td width="0" colspan="3" align="center"><img src="../../../../../assets/img/linea_peq.png" width="300" height="1" /></td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0" colspan="3" align="center"><img src="../../../../../assets/img/linea_peq.png" width="300" height="1" /></td>
					
								  	
				<tr>
				<tr>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
								  	
				<tr>
				<tr>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
								  	
				<tr>
				<tr>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
								  	
				<tr>
				
				<tr class="">
					<td width="0" colspan="10"  align="center">Vocal</td>								  	
				<tr>
				<tr>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
								  	
				<tr>
				<tr>
					<td width="0" colspan="10" align="center"><img src="../../../../../assets/img/linea_peq.png" width="300" height="1" /></td>				  	
				<tr>
				<tr>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
								  	
				<tr>
				<tr>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
								  	
				<tr>
				<tr>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
								  	
				<tr>
				<tr>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
								  	
				<tr>
				<tr>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
								  	
				<tr>
				
				
				
				<tr>
					<td width="0" colspan="10" align="center" class="Estilo3">V° B° <p>Rector</p></td>
				<tr>
				<tr>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
								  	
				<tr>
				<tr>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
								  	
				<tr>
				
				<tr>
					<td width="0" colspan="10" align="center"><img src="../../../../../assets/img/linea_larga1.png" width="300" height="1" /></td>				  	
				<tr>


			</table>



</body>
</html>
';


    
        
        
        
        
    }
} else {
    $html = "Lo Sentimos No Se Pudo Realizar la Consulta";
}
//echo $html;
ob_start();
$mpdf=new mPDF('c','','',''); 
$mpdf->AddPage('p', 15, '', 15, 15, 15, 15, 15, 15);
$mpdf->WriteHTML($html);
$mpdf->Output("Reporte_VerTitulo_Frente_" . $today.".pdf", 'I');

?> 